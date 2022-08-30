<?php
    $session = $this->session->all_userdata();
    $student_id =  $session['studentData']['student_id'];
    $student_name      = $session['studentData']['student_name'];
    $where = array('student_id'=>$student_id);
    $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where); 
    $section = $this->CRUDModel->get_where_row('student_group_allotment',$where);
    ?>
    
		<div class="four-grids">
            
        <div class="col-md-2 four-grid">
            <a href="whiteCardShow/<?php echo $student_id;?>/<?php echo $section->section_id;?>" target="_blank" title="Student Progress Reports">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>SPR</h3>
                    </div>	
                </div>
            </a>
        </div>
<!--
        <div class="col-md-2 four-grid">
            <a href="StudentController/monthly_test_marks">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>Monthly Test Marks</h3>
                    </div>
                </div>
            </a>    
        </div>
                    <div class="col-md-2 four-grid">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Paid Fee details</h3>
							</div>
						</div>
					</div>
                <div class="col-md-2 four-grid">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Remaining Fee</h3>
							</div>
						</div>
					</div>  
-->
            <?php
          //  if($studentinfo->sub_pro_flag == 2):
            ?>
<!--
                    <div class="col-md-2 four-grid">
                        <a href="StudentController/course_details">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Course Details</h3>
							</div>	
						</div>
                        </a>    
					</div>
-->
            <?php // else: ?>
<!--
                    <div class="col-md-2 four-grid">
                        <a href="StudentController/course_detail">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Course Details</h3>
							</div>	
						</div>
                        </a>    
					</div>
-->
            <?php // endif;?>
                    <div class="col-md-2 four-grid">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Time Table</h3>
							</div>
						</div>
					</div>
                    <div class="col-md-2 four-grid">
                        <a href="StudentController/books_issued_details">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Books Issuance</h3>
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
								<h3>Fee Details</h3>
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
					<div class="clearfix"></div>
				</div>
           <div class="four-grids">
									
					<div class="clearfix"></div>
				</div>
           