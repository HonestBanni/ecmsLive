<!--
<ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="#">Home</a> <i class="fa fa-angle-right"></i> 
              <a href="StudentController/student_home">Dashboard</a> 
            </li>
        </ol>
-->
<hr>

                <?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where);       
        $section = $this->StudentModel->get_where_sec('student_group_allotment',$where);       
          $picture = $studentinfo->applicant_image;
                                ?>
<div class="header-main">
        <div class="profile_stdt w3l" style="margin-left:5px;">		
                <ul>
                    <li class="dropdown profile_details_drop">
                        <a href="StudentController/student_home">
                            <div class="profile_img">	
                                <div class="user-name">
                                    <p>Parent Portal (Edwardes College Peshawar)</p>
                                </div>
                                <div class="clearfix"></div>	
                            </div>	
                        </a>
                    </li>
                </ul> 
        </div>
        
     
    <div class="profile_details w3l" style="margin-left:5px;">	
        
        <h2 style="color:#fff;margin-top:10px;margin-bottom:10px;font-size:18px;font-weight:bold">Student Profile</h2>
    <nav class="nav-sidebar">
		<ul class="nav tabs">
          <li class="active">
              <a href="#">
                Father Name: <?php echo $studentinfo->father_name;?> 
                <div class="clearfix"></div>
              </a>
          </li>
         <li class="active">
              <a href="#">
                College Number: <?php echo $studentinfo->college_no;?> 
                <div class="clearfix"></div>
              </a>
          </li>
         <li class="active">
              <a href="#">
                Section Name: <?php echo $section->name;?> 
                <div class="clearfix"></div>
              </a>
          </li><li class="active">
              <a href="#">
                Sub Program: <?php echo $studentinfo->sub_program;?> 
                <div class="clearfix"></div>
              </a>
          </li>                           
		</ul>
	</nav>
            </div>
       		
        <div class="clearfix"> </div>	
    </div> 
