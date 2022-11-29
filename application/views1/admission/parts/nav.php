 <!-- ******HEADER****** --> 
        <header class="header">  
            <div class="header-main container">
                <h1 class="logo col-md-4 col-sm-4">
                    <a href="admin/admin_home"><img id="logo" src="assets/images/logo.png" alt="Logo"></a>
                </h1><!--//logo-->           
 
            </div><!--//header-main-->
        </header><!--//header-->
        
        <!-- ******NAV****** -->
        <nav class="main-nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->            
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class=" nav navbar-nav">
                        <li class="nav-item">
        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">ADMIN <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
    <li><a href="AdminDeptController/add_alumni">Add Alumni</a></li>
    <li><a href="AdminDeptController/alumni_record">Alumni Records</a></li>   
                        </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">ADMISSION <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
        <li class="dropdown-submenu">
        <a tabindex="-1" href="#">Setup<i class="fa fa-angle-right"></i></a>
            <ul class="dropdown-menu" style="display: none;">             
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/board_university">Board / University</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/institute">Institutes</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/district">Districts</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/domicile">Domiciles</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/country">Countries</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/degree">Degrees</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/degree_type">Degree Types</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/relation">Relations</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/occupation">Occupations</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/programes">Programs</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/sub_programes">Sub Programs</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/physical_status">Physical Status</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/religion">Religion</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/section">Sections</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/reserved_seats">Reserved Seats</a></li>
<li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/reserved_seats_detail">Reserved Seats Detail</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/prospectus_batch">Prospectus Batch</a></li>
        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/prospectus_sale">Prospectus Sale</a></li>
            </ul>
        </li>                        
        <li><a href="<?php echo base_url();?>admin/add_student_record">Add Student (Inter level)</a></li>
        <li><a href="<?php echo base_url();?>admin/student_record">Student Records (Inter Level)</a></li>
        <li><a href="<?php echo base_url();?>admin/add_cs_student">Add Student (CS)</a></li>
        <li><a href="<?php echo base_url();?>admin/cs_student_record">Student Records (CS)</a></li>
        <li><a href="<?php echo base_url();?>admin/add_degree_student">Add Student (Degree)</a></li>
        <li><a href="<?php echo base_url();?>admin/degree_student_record">Student Records (Degree)</a></li>
        <li><a href="<?php echo base_url();?>admin/add_hnd_student">Add Student (HND)</a></li>
        <li><a href="<?php echo base_url();?>admin/hnd_student_record">Student Records (HND)</a></li>            
                             </ul>
                        </li> 
                        <li class="active nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="javascript:void(0)">HR <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Setup<i class="fa fa-angle-right"></i></a>
                                    <ul class="dropdown-menu" style="display: none;">             
    <li class="dropdown-submenu"><a href="<?php echo base_url();?>HrController/bank">All Banks</a></li>
    <li class="dropdown-submenu"><a href="<?php echo base_url();?>HrController/department">Departments</a></li>
    <li class="dropdown-submenu"><a href="<?php echo base_url();?>HrController/head_of_dept">Head of Departments</a></li>
    <li class="dropdown-submenu"><a href="<?php echo base_url();?>HrController/category">Employee Category</a></li>
    <li class="dropdown-submenu"><a href="<?php echo base_url();?>HrController/designation">Employee Designation</a></li>
    <li class="dropdown-submenu"><a href="<?php echo base_url();?>HrController/division">Employee Division</a></li>
    <li class="dropdown-submenu"><a href="<?php echo base_url();?>HrController/employee_scale">Employee Scale</a></li>
    <li class="dropdown-submenu"><a href="<?php echo base_url();?>HrController/employee_status">Employee Status</a></li>
    <li class="dropdown-submenu"><a href="<?php echo base_url();?>HrController/contract_type">Employee Contract Type</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url();?>HrController/add_employee_record">Add New Employee</a></li>
                                <li><a href="<?php echo base_url();?>HrController/employee_reocrd">Employee Records</a></li>  
                               </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">FINANCE <i class="fa fa-angle-down"></i></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Examination <i class="fa fa-angle-down"></i></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Hostel <i class="fa fa-angle-down"></i></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Library <i class="fa fa-angle-down"></i></a>
                        </li> 
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Reports <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="interMerit">Merit List (Inter level)</a></li>
                                            
                             </ul>
                        </li> 
                        <li class="nav-item dropdown" style="float:right">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#"> User <i class="fa fa-user"></i></a>
                            <ul class="dropdown-menu">
                            <?php

                               $session = $this->session->all_userdata();
                                $email =  $session['userData']['Email'];
                                $where =array('email'=>$email);
                                $userInfo = $this->CRUDModel->get_where_row('users',$where);
                             ?>
                        <li><a href="admin/update_user/<?php echo $userInfo->id; ?>">Change Password</a></li>
                        <li><a href="logout">Logout</a></li>
                             </ul>
                        </li> 
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </div><!--//container-->
        </nav><!--//main-nav-->
        