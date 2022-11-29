<?php
    $session = $this->session->all_userdata();
    $student_id =  $session['studentData']['student_id'];
    $student_name      = $session['studentData']['student_name'];
    $where = array('student_id'=>$student_id);
    $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where); 
    $section = $this->CRUDModel->get_where_row('student_group_allotment',$where);
    ?>
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="#">Home</a> <i class="fa fa-angle-right"></i> 
              <a href="StudentController/proctor_home">Dashboard</a> 
            </li>
        </ol>
		<div class="four-grids">
            
        <div class="col-md-2 four-grid">
            <a href="StudentController/proctor_profile">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>View Profile</h3>
                    </div>	
                </div>
            </a>
        </div>
        <div class="col-md-2 four-grid">
            <a href="ProctorController/proctor">
            <div class="four-wthree">
                <div class="four-text">
                    <h3>Proctor</h3>
                </div>	
            </div>
            </a>    
        </div>
        <div class="col-md-2 four-grid">
            <a href="StudentController/update_ppassword">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Change Password</h3>
                    </div>
                </div>
            </a>    
        </div>
        <div class="col-md-2 four-grid">
            <a href="proctor_logout">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Logout</h3>
                    </div>
                </div>
            </a>    
        </div> 
           
            <div class="clearfix"></div>
        </div>
           
   