	function highlight(gr,en,id)
	{
	  //console.log("gr: "+gr+"   en:"+en);
	  if(gr.indexOf(" ")==-1){ id1="A_"+id+"_"+gr; document.getElementById(id1).className="highlighted ";}  
	  else {
	   w=gr.split(" ");
       for(i=0;i < w.length;i++)
       {
        idd="A_"+id+"_"+w[i];
        //console.log(idd);
        document.getElementById(id).className="highlighted ";
       }
	  }
	  if(en.indexOf(" ")==-1){ id1="B_"+id+"_"+en; document.getElementById(id1).className="highlighted";}  
      else{
       w=en.split(" ");
       for(i=0;i < w.length;i++)
       {
        idd="B_"+id+"_"+w[i];
        //console.log(":::"+idd);
        document.getElementById(idd).className="highlighted ";
       }
      }
	  
	}
	
	function reset(gr,en,id)
	{
	  if(gr.indexOf(" ")==-1){ id1="A_"+id+"_"+gr; document.getElementById(id1).className="";}  
	  else {
	   w=gr.split(" ");
       for(i=0;i < w.length;i++)
       {
        idd="A_"+id+"_"+w[i];
        //console.log(idd);
        document.getElementById(id).className="";
       }
	  }
	  if(en.indexOf(" ")==-1){ id1="B_"+id+"_"+en; document.getElementById(id1).className="";}  
      else{
       w=en.split(" ");
       for(i=0;i < w.length;i++)
       {
        idd="B_"+id+"_"+w[i];
        //console.log(idd);
        document.getElementById(idd).className="";
       }
      }	
	}
	
	
		
	function  drawCharts() {

		// drawing Greek translation chart
        var dataGrc = google.visualization.arrayToDataTable([<?=$GreekChart?>]);
        var optionsGrc = { title: 'Greek Translation of ({{$word}})'};
        var chartGrc = new google.visualization.PieChart(document.getElementById('GreekChart'));
        chartGrc.draw(dataGrc, optionsGrc);
        
		// drawing Latin translation chart
        var dataLt = google.visualization.arrayToDataTable([<?=$LatinChart?>]);
        var optionsLt = { title: 'Latin Translation of ({{$word}})'};
        var chartLt = new google.visualization.PieChart(document.getElementById('LatinChart'));
        chartLt.draw(dataLt, optionsLt);
	}
	