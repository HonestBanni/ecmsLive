<?php
    $session = $this->session->all_userdata();
    $student_id =  $session['studentData']['student_id'];
    $student_name      = $session['studentData']['student_name'];
    $where = array('student_id'=>$student_id);
    $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where); 
    $section = $this->CRUDModel->get_where_row('student_group_allotment',$where);
    $college_no =  $studentinfo->college_no;  
    $pgroup = $this->CRUDModel->get_where_row('student_prac_group_allottment',array('college_no'=>$college_no));       
    ?>

    <div class="four-grids">

        <div class="col-md-2 four-grid">
            <a href="whiteCardShow/<?php echo $student_id;?>/<?php echo $section->section_id;?>" target="_blank" title="Student Progress Reports">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Progress Report</h3>
                    </div>
                </div>
            </a>
        </div>
        <?php if(!empty($pgroup)):?>
        <div class="col-md-2 four-grid">
            <a href="PracticalwhiteCardShow/<?php echo $college_no;?>/<?php echo $pgroup->group_id;?>" target="_blank" title="Practical White Card">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Practical Attendance</h3>
                    </div>
                </div>
            </a>
        </div>
        <?php else:?>
        <div class="col-md-2 four-grid">
            <a href="StudentController/student_home" target="_blank" title="Practical White Card">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Practical Attendance</h3>
                    </div>
                </div>
            </a>
        </div>
        <?php endif;?>
        
        <div class="col-md-2 four-grid">
            <a href="StudentController/books_issued_details">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Library Details</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2 four-grid">
            <a href="StudentController/fine">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Disciplinary Actions</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2 four-grid">
            <a href="StudentController/student_fee">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>College Fee Details</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2 four-grid">
            <a href="StudentController/student_hostel_details">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Hostel Fee Details</h3>
                    </div>
                </div>
            </a>
        </div>
       
        
        <div class="clearfix"></div>
    </div>
    <div class="four-grids">
         <div class="col-md-2 four-grid">
            <a href="StudentController/student_mess_details">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Mess Fee Details</h3>
                    </div>
                </div>
            </a>
        </div>
          
        <div class="col-md-2 four-grid">
            <div class="four-wthree">
                <div class="four-text">
                    <h3>Examination</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 four-grid">
            <div class="four-wthree">
                <div class="four-text">
                    <h3>Time Table</h3>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="four-grids">

        <div class="clearfix"></div>
    </div>