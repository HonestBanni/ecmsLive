<!DOCTYPE HTML>
<html>
<head>
<title><?php  echo isset($page_title) ? $page_title : 'ECMS'; ?></title>
<meta charset="utf-8">
    <base href="<?php echo base_url()?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!-- Bootstrap Core CSS -->
<link href="student_portal/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="student_portal/css/style.css" rel='stylesheet' type='text/css' />
<link href="student_portal/css/jquery-ui.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="student_portal/css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="student_portal/css/font-awesome.css" rel="stylesheet"> 

<script src="student_portal/js/jquery-2.1.4.min.js"></script>
    
<link rel="stylesheet" type="text/css" href="student_portal/css/table-style.css" />
<link rel="stylesheet" type="text/css" href="student_portal/css/basictable.css" />
<script type="text/javascript" src="student_portal/js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>    
    
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="student_portal/css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
           
    <div class="header-main">
        <div class="logo-w3-agile">
                <a href="StudentController/student_home">
                    <img src="assets/images/logo.png">
                    </a>
        </div>
       
            <div class="profile_std w3l">		
                <ul>
                    <li class="dropdown profile_details_drop">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <div class="profile_img">
                                 <?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->CRUDModel->get_where_row('student_record',$where);       
        $section = $this->CRUDModel->get_where_row('student_group_allotment',$where);       
          $picture = $studentinfo->applicant_image;
                                ?>
                    <span class="prfil-img">
                       <img src="assets/images/students/<?php echo $picture;?>" alt=""></span> 
                    <div class="user-name">
                        <p><?php echo $studentinfo->student_name;?></p>
                    </div>
                    <div class="clearfix"></div>	
                </div>	
                        </a>
                        <ul class="dropdown-menu drp-mnu">
                            <li><a href="StudentController/view_profile">View Profile</a></li> 
                            <li><a href="student_logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>		
        <div class="clearfix"> </div>	
    </div>
          