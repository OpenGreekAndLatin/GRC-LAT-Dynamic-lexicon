<?

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
class ResultController extends Controller
{

	public function ShowResult()
	{
		$in=Input::all();
		//print_r($in);
		if($in['language']=="en" || $in['language']=="")
		{
			$in['FirstChart']=$this::GreekChart($in['word']);
			$in['SecondChart']=$this::LatinChart($in['word']);
			$in['LatinExamples']=$this::get_example($in['word'],"en","WN_sentences_lat");
			$in['GreekExamples']=$this::get_example($in['word'],"en","WN_sentences_grc");
		}else if($in['language']=="grc") {
			$in['FirstChart']=$this::getEnglishTranslation($in['word'],'WN_grc_stat_mod');
			$in['SecondChart']=$this::getTranslation($in['word'],'greek','latin','Latin Translation of '.$in['word']);
			$in['Examples']=$this::get_example($in['word'],"gr","WN_sentences_grc");
		}else{
			$in['FirstChart']=$this::getEnglishTranslation($in['word'],'WN_lat_stat_mod');
			$in['SecondChart']=$this::getTranslation($in['word'],'latin','greek','Greek Translation of '.$in['word']);
			$in['Examples']=$this::get_example($in['word'],"gr","WN_sentences_lat");
		}
		return view("result",$in);
	}
	
	private function getEnglishTranslation($word,$table)
	{
	 try{
		 $q="select * from $table where gr='".$word."' order by freq DESC limit 0,10";
		 $translations=DB::select($q);
		 $ENarr[]="['".$word."','Translations']"; 
		 foreach($translations as $k=>$w)
		 {
		   $word=$w->en;
		   $freq=$w->freq;
		   $ENarr[]="['".$word."',".$freq."]"; 
		 }
		 return implode(",",$ENarr);
		 }catch(Exception $e){
		 return "";
		 }
	}
	
	public function GreekChart($word)
	{
	 try{
		 $in=Input::all();
		 $q="select * from WN_grc_stat_mod where en='".$word."' order by freq DESC limit 0,10";
		 $lt=DB::select($q);	 
		 $ltarr[]="['".$word."','Translations']";   //
		 $lemmas=array();
		 foreach($lt as $k=>$w)
		 {
		   $word=$w->gr;
		   $freq=$w->freq;
		   $lemma=$this::getLemma_grc($word);
		   if($lemma=="") $lemma[0]=$word;
		   if(array_key_exists($lemma[0],$lemmas)) 
				$lemmas[$lemma[0]]+=$freq;
			else
				$lemmas[$lemma[0]]=$freq;
	   
		  $tr[$lemma[0]][]=$word;   
		 }
		  arsort($lemmas);
		
		 foreach($lemmas as $lem=>$freq)
		 {
		  $ltarr[]="[ '".$lem." (".implode(", ",$tr[$lem]).")',".$freq."]";
		 }
		 return $ltarr=implode(",",$ltarr);
	}catch(Exception $e){
		 return "";
		 }
	}  
	
	private function LatinChart($word)
	{
	try{ 
		 $in=Input::all();
		 $q="select * from WN_lat_stat_mod where en='".$word."' order by freq DESC limit 0,10";
		 $lt=DB::select($q);	 
		 $ltarr[]="['".$word."','Translations']";   //
		 $lemmas=array();
		 foreach($lt as $k=>$w)
		 {
		   $word=$w->gr;
		   $freq=$w->freq;
		   $lemma=$this::getLemma_lat($word);
		   if($lemma=="") $lemma[0]=$word;
		   if(array_key_exists($lemma[0],$lemmas)) 
				$lemmas[$lemma[0]]+=$freq;
			else
				$lemmas[$lemma[0]]=$freq;
	   
		  $tr[$lemma[0]][]=$word;   
		 }
		  arsort($lemmas);
		
		 foreach($lemmas as $lem=>$freq)
		 {
		  $ltarr[]="[ '".$lem." (".implode(", ",$tr[$lem]).")',".$freq."]";
		 }
		 return $ltarr=implode(",",$ltarr);
	 }catch(Exception $e){
		 return "";
		 }
	}
	
	
	private function highlight($wort,$text)
	{
	$pattern = '/(\W|^)'.$wort.'(\W|$)/';
	$replacement = '\1<span style="background-color:#FFFF00">'.$wort.'</span>\2';
	return preg_replace($pattern, $replacement, $text);
	}
	
	// Get lemma of a Latin word
	function getLemma_lat($w)
	{
	 $q="select hdwd,pofs from WN_lemmas_lat where word='".$w."'";
	 $res=DB::select($q); 
	 if(sizeof($res) > 0) // TODO: deal with the case when the word has multi lemma
	 	return array($res[0]->hdwd,$res[0]->pofs);
	 else 
		return "";   //TODO: call_Morpheus($w,"lat");
	}
	
	// Get lemma of a Greek word
	function getLemma_grc($w)
	{
	 $q="select hdwd,pofs from WN_lemmas_grc where word='".$w."'";
	 $res=DB::select($q); 
	 if(sizeof($res) > 0) // TODO: deal with the case when the word has multi lemma
	 	return array($res[0]->hdwd,$res[0]->pofs);
	 else 
		return "";   //TODO: call_Morpheus($w,"lat");
	}
	
	
	function get_example($word,$lan,$table)
	{
	 $q="select * from ".$table." where $lan rlike'[[:<:]]".$word."[[:>:]]' limit 0,12";
	 $lt=DB::select($q);
	 $sentences=array();
	 $i=0;
	 foreach($lt as $k=>$w)
	 { $i++;
	  $sentences[]=$this::style_parallel_text($word,$w->xml,$i);//"<div>".highLight($word,$w[4])."<br><font color='blue'>".highLight($word,$w[5])."</font></div>";
	 }
	  return  "<ul><li>".implode("</li><li>",$sentences)."</li></ul>";
 
	}
	
	
	
	function style_parallel_text($word,$xml,$num)
	{
	  $punc=array("·",",",".");
	  $xml=simplexml_load_string($xml);
	  if(!$xml) $err++;
	  else
	  {
		$wds=$xml->wds;
		$gree=$wds[0];
		$english=$wds[1];
		$translation=array();
		$greek=array();
		$english_sentence="";
		$greek_sentence="";
		$i=1;
		$alignedOR=array();
		$alignedTr=array();	

		foreach($gree->w as $k) {
		   $id=$k->attributes()->n;
		   $ref=$k->refs->attributes()->nrefs;
		   if($ref!="") $ref=" onmouseout=\"reset('".$id."','".$ref."',$num)\" onmouseover=\"highlight('".$id."','".$ref."',$num)\"";
		   $greek_sentence.="<span id='A_".$num."_".$id."'  $ref >".$k->text."</span>";
		   if(!in_array($k->text,$punc))  $greek_sentence.=" ";  
		}    
  
	   foreach($english->w as $k) {
		   $id=$k->attributes()->n;
		   $ref=$k->refs->attributes()->nrefs;
		   if($ref!="")
		   {
			 $ref=" onmouseout=\"reset('".$ref."','".$id."',$num)\" onmouseover=\"highlight('".$ref."','".$id."',$num)\"";
			} 
		   $english_sentence.="<span id='B_".$num."_".$id."'  $ref >".$k->text."</span>";
		   if(!in_array($k->text,$punc))  $english_sentence.=" ";  

		   }
	   
		   return "<div>".$this::highLight($word,$greek_sentence)."<br /><font color='blue'>".$this::highLight($word,$english_sentence)."</font></div><br />";   
		}
	
	}
	
	
	function getTranslation($word,$col1,$col2,$title)
	{
	 $q="select * from lexicon_simple where ($col1='".addslashes($word)."') and 
	 (gr_freq/gr) > 0.1 and (lat_freq/lat) >0.1 and abs(((gr_freq/gr) - (lat_freq/lat))/((gr_freq/gr) + (lat_freq/lat)) ) < 0.6  
	 order by jaccard DESC limit 0,20";
	 $result=DB::select($q);
	 foreach($result as $k=>$w)
	 {
	   $word=$w->$col2;
	   $freq=$w->jaccard;
	   $ENarr[]="<li>".$word." [".$w->english."] (".$freq.")</li>"; 
	 }
	 return "<h2>$title</h2><ul>".implode(" ",$ENarr)."</ul>";	
	 }
}

?>