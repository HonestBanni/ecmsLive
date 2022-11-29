 
<!DOCTYPE html>
<html lang="en">
  
 <head>
    <meta charset="utf-8">
   <title><?php  echo isset($page_title) ? $page_title : 'ECMS'; ?></title>
    <base href="<?php echo base_url()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="assets/gui/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/gui/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!--New Dashobard-->
    <link rel="stylesheet" type="text/css" href="assets/gui/css/keen-dashboards.css" />
     <script src="assets/gui/js/holder.js"></script>
    <script src="assets/gui/js/keen.min.js"></script>
    <script src="assets/gui/js/meta.js"></script>
    <script src="assets/gui/js/keen.dashboard.js"></script>
    <script src="assets/gui/js/keen-tracking.js"></script>
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="assets/gui/css/font-awesome.css" rel="stylesheet">
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <link href="assets/gui/css/style.css" rel="stylesheet">
       <!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
    <link href="assets/gui/css/pages/reports.css" rel="stylesheet">
    <link href="assets/gui/css/pages/dashboard.css" rel="stylesheet">
    <script src="assets/gui/js/jquery-1.7.2.min.js"></script>
    <script src="assets/gui/js/excanvas.min.js"></script>
    <script src="assets/gui/js/chart.min.js" type="text/javascript"></script>
    <script src="assets/gui/js/bootstrap.js"></script>
    <script src="assets/gui/js/base.js"></script>
    <script src="assets/gui/js/common.js"></script>
    <script src="assets/gui/js/loader.js"></script>
    <script src="assets/gui/js/gui.js"></script>
    <!--New Dashobard-->
  
    

  </head>

<body>

<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
<!--			<a class="brand" href="index.html">
				Bootstrap Admin Template				
			</a>		-->
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
<!--					<li class="dropdown">						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog"></i>
							Account
							<b class="caret"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li><a href="javascript:;">Settings</a></li>
							<li><a href="javascript:;">Help</a></li>
						</ul>						
					</li>-->
			
					<li class="dropdown">						
						<a href="logout" class="dropdown-toggles" data-toggle="dropdowns">
							<i class="icon-user"></i> 
							Logout
							<b class="carets"></b>
						</a>
						
<!--						<ul class="dropdown-menu">
							<li><a href="javascript:;">Profile</a></li>
							<li><a href="logout">Logout</a></li>
						</ul>						-->
					</li>
				</ul>
			
<!--				<form class="navbar-search pull-right">
					<input type="text" class="search-query" placeholder="Search">
				</form>-->
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->
    

