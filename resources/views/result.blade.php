<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="css/style.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>    <!-- FA-Icons -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<script type="text/javascript" src="js/DL.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script language="javascript">
	      google.load("visualization", "1", {packages:["corechart","wordtree"]});
		  google.setOnLoadCallback(drawCharts);
	
		
	function  drawCharts() {
		<? if($language=="en"){ ?>
		// drawing Greek translation chart
        var dataGrc = google.visualization.arrayToDataTable([<?=$FirstChart?>]);
        var optionsGrc = { title: 'Greek Translations of ({{$word}})'};
        var chartGrc = new google.visualization.PieChart(document.getElementById('FirstChart'));
        chartGrc.draw(dataGrc, optionsGrc);
		// drawing Latin translation chart
        var dataLt = google.visualization.arrayToDataTable([<?=$SecondChart?>]);
        var optionsLt = { title: 'Latin Translations of ({{$word}})'};
        var chartLt = new google.visualization.PieChart(document.getElementById('SecondChart'));
        chartLt.draw(dataLt, optionsLt); 
        <? }else{ ?>
        var dataGrc = google.visualization.arrayToDataTable([<?=$FirstChart?>]);
        var optionsGrc = { title: 'English Translations of (<?=$word?>)'};
        var chartGrc = new google.visualization.PieChart(document.getElementById('FirstChart'));
        chartGrc.draw(dataGrc, optionsGrc);
        <?} ?>
	}
	
	</script>
	
	<title>GL Dynamic Lexicon</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">     
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
  </head>
  <body style="font-family: Roboto Condensed, sans-serif;">
    <div class="wrapper left">          
	<nav class="navbar navbar-default">
  		<div class="container-fluid">
    	<div class="navbar-header" style="height:100px; width:320px">
			<a class="navbar-brand" href="index.php">
			<p style="padding-top:5px;font-size:1٥px">GL Dynamic Lexicon</p>
			</a>
    	</div>
        <div class="col-sm-4" style="padding-top:25px;">
			<form class="res-form" role="form" method="get" name="frm" action="res">
				<div class="input-group">
				
					<input id="searchfield" type="text" class="form-control" value="{{$word}}" name="word" autocomplete="off" value="" >
					<span class="input-group-btn">
						<button class="btn btn-primary" type="submit" value="Submit">
							<i class="fa fa-search"></i>
						</button>
					
					</span> 
					
				</div>
				<label class="radio-inline">
				  <input type="radio" name="language" id="english" value="en" <? if($language=='en') echo 'checked';?> > English
				</label>
				<label class="radio-inline">
				  <input type="radio" name="language" id="latin" value="lat" <? if($language=='lat') echo 'checked';?>> Latin
				</label>
				<label class="radio-inline">
				  <input type="radio" name="language" id="greek" value="grc" <? if($language=='grc') echo 'checked';?>> Greek
				</label>
			</form>  <a class ="navbar-btn btn btn-sm"  data-toggle="modal" data-target="#myModal2">
			<i class="fa fa-keyboard-o"></i>  Greek Keyboard </a>
		</div>
  		</div>
	</nav>

<!-- Start The English Layout -->
    <div class="panel panel-default" style="margin-left:1%;margin-right:1%">
      <div class="panel-heading" data-toggle="collapse" data-target="#demo">
        <div class="panel-title">{{$word}} </div>
      </div>
      <div class="panel-body" id="demo">
      <div style="width:100%;margin-left:2%;margin-right:2%;overflow: hidden;">
		<div id="FirstChart" class="col-md-6" style="display: inline-block;width: 650px; height:400px">{{$FirstChart}}</div>
	    <div id="SecondChart" class="col-md-6" style="display: inline-block;width: 650px; height:400px">{{$SecondChart}}</div>
	   </div> 
	</div>
    </div>  
<!-- End The English Layout -->

<!-- Start The example box -->
    <div class="panel panel-default" style="margin-left:1%;margin-right:1%">
      <div class="panel-heading" data-toggle="collapse" data-target="#demo">
        <div class="panel-title">Sentence Examples of <font size="6">{{$word}}</font> </div>
      </div>
      <div class="panel-body" >
      <? if($language=="en" || $language==""){ ?>
      <table style="width:100%;margin-left:2%;margin-right:2%;overflow: hidden;"><tr>
       	<td id="GreekExamples" 	class="col-md-6" style="margin:10px"><?=$GreekExamples?></td>
       	<td id="LatinExamples"  class="col-md-6" style="margin:10px"><?=$LatinExamples?></td>
	   </tr>
	  </table> 
	  <? }else{ ?>
			<div id="examples"><?=$Examples?></div>	  
	  <? }?>
	</div>
    </div>  
<!-- End The example Box -->
   <div class="push"> </div>
</div> <!-- Warper -->
   <div id="footer">
   		<font size="2" color="#888">Alexander von Humboldt-Lehrstuhl f&uuml;r Digital Humanities - All rights reserved &#169;	2015 </font>            
   	</div>
	  <!-- Bootstrap core JavaScript
    	================================================== -->
    	<? include("keyboardLayout.php");?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                <script language="javascript">
				$(document).ready(function(){
					//$("#GreekChart").load("GreekChart?word={{$word}}");
					//$("#GreekChart").load("LatinChart?word={{$word}}");
				});
                function addText(a)
                {
                 document.getElementById("searchfield").value=document.getElementById("searchfield").value+a;
                }
                </script>
  
  </body>
</html>