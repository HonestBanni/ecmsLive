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
                        
                 
                        <?php
                        
                        
                        $session        = $this->session->all_userdata();
                        $userEmail= $session['userData'];
                     // echo '<pre>';print_r($userEmail);
                        $whereUsers          = array('id'=>$userEmail['user_id']);
                       
                        $userInfo = $this->CRUDModel->get_where_row('users',$whereUsers);
                        
                       //echo '<pre>';print_r($userInfo);
                        $whereUR          = array('ur_id'=>$userInfo->user_roleId);
                        $userInfo = $this->CRUDModel->get_where_row('users_role',$whereUR);
                   // echo '<pre>';print_r($userInfo);
                        // User Leve1 menu
                        $whereUPl1 = array('upl1_urId'=>$userInfo->ur_id);
                        $UPL1 = $this->CRUDModel->UPL1($whereUPl1);
                        
                        
                          //Check URL if register 
                                  $uri1 = $this->uri->segment(1);
                                  $uri2 = $this->uri->segment(2);
                                  $check = '';
                                  if(empty($uri2)):
                                        $check = $uri1; 
                                    else:
                                        $check = $uri1.'/'.$uri2;
                                    endif;
                                
//                                   echo $uri1;
//                                      $check;die;
                                    
                                    if(!empty($uri1)):
                                        $menul2 = $this->CRUDModel->get_where_row('menul2',array('m2_function'=>$check));
                                    
                                        if(empty($menul2)):
                                                $menul3 = $this->CRUDModel->get_where_row('menul3',array('m3_function'=>$check));
                                                $checkURL = $this->CRUDModel->get_where_row('user_policyl3',array('upl3_m3Id'=>$menul3->m3_id,'upl3_urId'=>$userEmail['user_roleId']));
                                                if(empty($checkURL)):
                                                    redirect('/');
                                                else:
                                                    
                                                endif;
                                            else:
                                                
                                        endif;
                                        
                                    
//                                        if($query->m2_name == 'Desktop'):
//                                        else:
//                                             $checkURL = $this->CRUDModel->get_where_row('user_policyl2',array('up2_m2Id'=>$menul2->m2_id,'upl2_urId'=>$userEmail['user_roleId']));
//                                              //echo '<pre>';print_r($checkURL); 
//                                            if(empty($checkURL)):
//                                                redirect('/');
//                                            endif;
//                                        endif;
                                    endif;

                    //  echo '<pre>';print_r($UPL1);
                       
                        if($UPL1):
                             
                            foreach($UPL1 as $l1Row):
                                echo '<li class="nav-item">';
                                echo '<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">'.$l1Row->m1_name.'<i class="fa fa-angle-down"></i></a>';
                                    
                                    $whereUPl2 = array('upl2_urId'=>$userInfo->ur_id,'up2_m1Id'=>$l1Row->m1_id,'m2_status'=>1);
                                    $UPL2 = $this->CRUDModel->UPL2($whereUPl2);
                         
                                           
                                        echo '<ul class="dropdown-menu">';
                                      if($UPL2):
                                         foreach($UPL2 as $l2Row):
                                              $whereUPl3 = array(
                                                        'upl3_urId' =>$userInfo->ur_id,
                                                        'upl3_m1Id' =>$l1Row->m1_id,
                                                        'upl3_m2Id' =>$l2Row->m2_id,
                                                         );
                                                     $UPL3 = $this->CRUDModel->UPL3($whereUPl3);
                                                    //echo '<pre>';print_r($UPL3);
                                                     if($UPL3):
                                                        echo '<li class="dropdown-submenu">
                                                              <a tabindex="-1" href="#">Setup<i class="fa fa-angle-right"></i></a>
                                                              <ul class="dropdown-menu" style="display: none;"> ';
                                                     foreach($UPL3 as $l3Row):
                                                         echo '<li class="dropdown-submenu"><a href="'.$l3Row->m3_function.'">'.$l3Row->m3_name.'</a></li>';
                                                        
                                                    endforeach; 
                                                        echo '</ul></li>';
                                                    else:
                                                             echo '<li><a href="'.$l2Row->m2_function.'">'.$l2Row->m2_name.'</a></li>';
                                                         
                                                    endif;
                                             endforeach;
                                         endif;    
                                        echo ' </ul>';
                                
                                echo '</li>';
                          
                            endforeach;
                        endif;
                        
                        ?>
                        
<!--                        <li class="nav-item dropdown">
                             <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">ADMIN <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="AdminDeptController/add_alumni">Add Alumni</a></li>    
                                        <li><a href="AdminDeptController/Alumni_record">Alumni Records</a></li>    
                                    </ul>
                        </li>-->
<!--                        
                           if($UPL3):
                                             foreach($UPL3 as $l3row):
                                                
                                             
                                          echo '<li class="dropdown-submenu">
                                                        
                                                            <ul class="dropdown-menu" style="display: none;"> 
                                                        <li class="dropdown-submenu"><a href="<?php echo base_url();?>admin/prospectus_sale">Prospectus Sale</a></li>    
                                                        ';
                                            echo '</ul>
                                                        </li>';
                                            endforeach;
                                         endif; -->
              
                        
<!--                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">ADMISSION <i class="fa fa-angle-down"></i>
                            </a>
    <ul class="dropdown-menu">
        <li class="dropdown-submenu">
        <a tabindex="-1" href="#">Setup<i class="fa fa-angle-right"></i>
        </a>
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
        <li><a href="<?php echo base_url();?>admin/add_cs_student">Add Student (BCS)</a></li>
        <li><a href="<?php echo base_url();?>admin/cs_student_record">Student Records (BCS)</a></li>
        <li><a href="<?php echo base_url();?>admin/add_degree_student">Add Student (Degree)</a></li>
        <li><a href="<?php echo base_url();?>admin/degree_student_record">Student Records (Degree)</a></li>
        <li><a href="<?php echo base_url();?>admin/add_hnd_student">Add Student (HND)</a></li>
        <li><a href="<?php echo base_url();?>admin/hnd_student_record">Student Records (HND)</a></li>
          <li class="dropdown-submenu"><a href="admin/student_group">Student Group</a></li>
                             </ul>
                        </li> -->
<!--                        <li class="nav-item dropdown">
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
                        </li>-->
<!--                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">FINANCE <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Setup<i class="fa fa-angle-right"></i></a>
                                    <ul class="dropdown-menu" style="display: none;">             
                                        <li class="dropdown-submenu"><a href="COA">Chart of Account</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url();?>HrController/add_employee_record">Add New Employee</a></li>
                                <li><a href="<?php echo base_url();?>HrController/employee_reocrd">Employee Records</a></li>  
                               </ul>
                        </li>-->
<!--                        <li class="nav-item dropdown">
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
                        </li>-->
<!--                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">App Setting <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Setup<i class="fa fa-angle-right"></i></a>
                                    <ul class="dropdown-menu" style="display: none;">             
                                        <li class="dropdown-submenu">
                                            <a href="userRole">User Role</a>
                                            <a href="dbUser">Database User</a>
                                            <a href="groupPolicy">Group Policy</a>
                                        </li>
                           
                                    </ul>
                                </li>
                                <li><a href="interMerit">Merit List (Inter level)</a></li>
                                <li><a href="adminRecord">Admin Record</a></li>
                                            
                             </ul>
                        </li> -->
<!--                        <li class="nav-item dropdown" style="float:right">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#"> User <i class="fa fa-user"></i></a>
                            <ul class="dropdown-menu">
                        
                        <li><a href="javascript:void(0)"><?php echo $userEmail['Email'];?></a></li>
                        <li><a href="admin/update_user/<?php echo $userEmail['user_id']; ?>">Change Password</a></li>
                        <li><a href="logout">Logout</a></li>
                             </ul>
                        </li>-->
                        
                        
                        
<!--                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">App Setting <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Setup<i class="fa fa-angle-right"></i></a>
                                    <ul class="dropdown-menu" style="display: none;">             
                                        <li class="dropdown-submenu">
                                            <a href="userRole">User Role</a>
                                            <a href="dbUser">Database User</a>
                                            <a href="groupPolicy">Group Policy</a>
                                        </li>
                           
                                    </ul>
                                </li>
                                <li><a href="interMerit">Merit List (Inter level)</a></li>
                                <li><a href="adminRecord">Admin Record</a></li>
                                            
                             </ul>
                        </li>-->
                        
                        
                        
                        
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </div><!--//container-->
        </nav><!--//main-nav-->
        