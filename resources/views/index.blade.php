<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ancient Greek - Latin Dynamic Lexicon</title>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>    <!-- FA-Icons -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">    
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">    
		<link href="css/style.css" rel="stylesheet">            
	</head>
	<body style="font-family: 'Roboto Condensed', sans-serif;background-color:#1D375E">
      <!-- Wrapper Class for Responsive Footer -->
        <div class="wrapper center">                    
            <div class="container" id="header">
                <h1></h1>
            </div>
            <h3 style="color:#FFF">The Ancient Greek - Latin Dynamic Lexicon</h3>       
            <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
                <div class ="form-group">                  
                    <form role ="form" method="get" name="frm" action="res">
                        <div class="input-group">
     
                            <input id="searchfield" type="text" class="form-control" name="word" autocomplete="off">
                           <div class="input-group-btn"> 
                           		<button class="btn search-btn btn-default" id="submit-search" type="submit" > 
                           		<i class="fa fa-search" id="searchIcon"></i> 
                           		
                           		</button> 

						 </div>
                        </div><!-- /input-group -->
                        <label class="radio-inline" style="color:#FFFFFF">
						  <input type="radio" name="language" id="english" value="en" checked> English
						</label>
						<label class="radio-inline" style="color:#FFFFFF">
						  <input type="radio" name="language" id="latin" value="lat"> Latin
						</label>
						<label class="radio-inline" style="color:#FFFFFF">
						  <input type="radio" name="language" id="greek" value="grc"> Greek
						</label>
            				<a class ="navbar-btn btn btn-sm"  data-toggle="modal" data-target="#myModal2">
                    <i class="fa fa-keyboard-o"></i>  Greek Keyboard </a>
                    </form>     
                    

            </div>
         
                 <!-- /Panel Desc-->
        

                
                </div> 
            
                 <div class="push">
                </div>
            </div> <!-- /Wrapper -->    
                               
            <div id="footer">
				<ul id="footerlist">
					<li><a href="http://www.dh.uni-leipzig.de/"> Digital Humanities Uni Leipzig</a></li>
				</ul>
				<font size="2" color="#888">Alexander von Humboldt-Lehrstuhl f&uuml;r Digital Humanities 
						- Creative Commons Attribution-ShareAlike 4.0 International License	2015</font>            
			</div>

            <!-- Bootstrap core JavaScript
                ================================================== -->
                <!-- Placed at the end of the document so the pages load faster -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                <script language=javascript>
                $( document ).ready(function() {
                //$("#header").addClass("load");
                	$("#header").fadeIn("slow");});
                </script>
                <script language="javascript">
                function addText(a)
                {
                 document.getElementById("searchfield").value=document.getElementById("searchfield").value+a;
                }
                </script>
    <? include("keyboardLayout.php"); ?>
  
	</body>
</html>
