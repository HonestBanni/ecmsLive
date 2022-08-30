<!DOCTYPE html>
<html lang="en"> 
<head>

     <title><?php  
     
     if(empty($page_title)):
         echo 'ECMS';
         else:
        echo $page_title;
     endif;
     
     
//     echo isset($page_title) ? $page_title : 'ECMS';
     
     
     ?></title>
    <!-- Meta -->
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
    <meta charset="utf-8">
    <base href="<?php echo base_url()?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    
    
    <link rel="shortcut icon" href="assets/images/logo.ico">
    
<!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>   -->
<!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>   -->
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">   
    <link rel="stylesheet" href="assets/css/google-fonts.css">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="assets/plugins/flexslider/flexslider.css">
    <link rel="stylesheet" href="assets/plugins/pretty-photo/css/prettyPhoto.css">
      <link href="assets/css/jquery-ui.css" rel="Stylesheet">
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script>
    <script src="assets/js/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="assets/js/sweetalert2.min.css">    
</head>
 
<body class="home-page">
      <div class="wrapper">