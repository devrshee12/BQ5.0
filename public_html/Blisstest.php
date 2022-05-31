<!doctype html>
<?php

error_reporting(0);
//echo $_SESSION['user_id'];

?>
 <html>
  <head>
    <title> BlissQuants - Delta Hedging | Fund Management </title>
     <script>
   /* $(function() 
{  
   showdata_daily_vol('TVSMOTOR','chartdiv_vol');
   showdata_daily_vol('ICICIBANK','chartdiv_vol1');
   showdata_daily_vol('ASHOKLEY','chartdiv_vol2');
   showdata_daily_vol('RELIANCE','chartdiv_vol3');
   showdata_daily_vol('COALINDIA','chartdiv_vol4');
   showdata_daily_vol('LICHSGFIN','chartdiv_vol5');
   showdata_daily_vol('HDFCBANK','chartdiv_vol6');
   showdata_daily_vol('POWERGRID','chartdiv_vol7');
   showdata_daily_vol('ADANIENT','chartdiv_vol8');
   alert("dsf");
});*/
    </script>
   
       <script src="js/jquery-1.9.1.js"></script> <!-- for changing scripts(slides)--> 

        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/bootstrap.min.css" />
        <script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>

   
    

     <style>
        
       
.dropdown-large {
  position: static !important;
}
.dropdown-menu-large {
  margin-left: 16px;
  margin-right: 16px;
  padding: 20px 0px;
  
  width : 100%;
}

.dropdown-menu-large > li > ul > li {
  list-style: none;
}
.dropdown-menu-large > li > ul > li > a {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight:300;
  line-height: 1.428571429;
  color: #333333;
  white-space: normal;
}
.dropdown-menu-large > li ul > li > a:hover,
.dropdown-menu-large > li ul > li > a:focus {
  text-decoration: none;
  color: #262626;
  background-color: #f5f5f5;
}
.dropdown-menu-large .disabled > a,
.dropdown-menu-large .disabled > a:hover,
.dropdown-menu-large .disabled > a:focus {
  color: #999999;
}
.dropdown-menu-large .disabled > a:hover,
.dropdown-menu-large .disabled > a:focus {
  text-decoration: none;
  background-color: transparent;
  background-image: none;
  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
  cursor: not-allowed;
}
.dropdown-menu-large .dropdown-header {
  color: #428bca;
  font-size: 18px;
}


     </style>  
  </head>
   <body  onload="run_onload()">   <!-- by default load 1 day data );--> 
       
<nav class="navbar navbar-default navbar-static">
    <div class="navbar-header">
		<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	
	</div>
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav">
      <li class="dropdown dropdown-large">
				<a href="#">Some link</a>
      </li>
			<li class="dropdown dropdown-large">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
				
				<ul class="dropdown-menu dropdown-menu-large row">
					<li class="col-sm-6">
						<ul>
							<li class="dropdown-header">Sword of Truth</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
              <li class="divider"></li>
              <li><img class"img-responsive" src="http://placehold.it/200x150"/></li>
						</ul>
					</li>
					<li class="col-sm-6">
						<ul>
							<li class="dropdown-header">Panda</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Button dropdowns</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
						</ul>
					</li>

					
				</ul>
				
			</li>
      <li class="dropdown dropdown-large">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
				
				<ul class="dropdown-menu dropdown-menu-large row">
					<li class="col-sm-6">
						<ul>
							<li class="dropdown-header">Sword of Truths</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Theme/Character</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
					
						</ul>
					</li>
					<li class="col-sm-6">
						<ul>
							<li class="dropdown-header">by brand</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li class="divider"></li>
              <li><img class"img-responsive" src="http://placehold.it/200x150"/></li>
						</ul>
					</li>

					
				</ul>
				
			</li>
      
      <li class="dropdown dropdown-large">
				<a href="#">Some link</a>
      </li>
      <li class="dropdown dropdown-large">
				<a href="#">Some link</a>
      </li>
      
      <li class="dropdown dropdown-large">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
				
				<ul class="dropdown-menu dropdown-menu-large row">
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Sword of Truths</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Theme/Character</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
					
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">by brand</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li class="divider"></li>
              <li><img class"img-responsive" src="http://placehold.it/200x150"/></li>
						</ul>
					</li>
<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Sword of Truths</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Theme/Character</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
					
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">by brand</li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li><a href="#">Example</a></li>
							<li class="divider"></li>
              <li><img class"img-responsive" src="http://placehold.it/200x150"/></li>
						</ul>
					</li>
					
				</ul>
				
			</li>
      
      
      
		</ul>
		
	</div><!-- /.nav-collapse -->
</nav>

        </body>
        
</html>  
          <?php
include("html/footer.html");    
 
?>
       