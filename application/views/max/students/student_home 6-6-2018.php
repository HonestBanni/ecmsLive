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
              <a href="StudentController/student_home">Dashboard</a> 
            </li>
        </ol>
		<div class="four-grids">
            
        <div class="col-md-2 four-grid">
            <a href="whiteCardShow/<?php echo $student_id;?>/<?php echo $section->section_id;?>" target="_blank">
                <div class="four-wthree">
                    <div class="four-text">
                        <h3>White Card</h3>
                    </div>	
                </div>
            </a>
        </div>
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
            <?php
            if($studentinfo->sub_pro_flag == 2):
            ?>
                    <div class="col-md-2 four-grid">
                        <a href="StudentController/course_details">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Course Details</h3>
							</div>	
						</div>
                        </a>    
					</div>
            <?php else: ?>
                    <div class="col-md-2 four-grid">
                        <a href="StudentController/course_detail">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Course Details</h3>
							</div>	
						</div>
                        </a>    
					</div>
            <?php endif;?>
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
					
                    <div class="col-md-2 four-grid">
						<div class="four-agileinfo">
							<div class="four-text">
								<h3>Exam Details</h3>
							</div>
						</div>
					</div>
					<div class="col-md-2 four-grid">
                        <a href="StudentController/books_issued_details">
						<div class="four-agileinfo">
							<div class="four-text">
								<h3>Books Issued Details</h3>
							</div>
						</div>
                        </a>    
					</div>
                    <div class="col-md-2 four-grid">
                        <a href="StudentController/pending_books_details">
						<div class="four-agileinfo">
							<div class="four-text">
								<h3>Pending Books</h3>
							</div>	
						</div>
                        </a>    
					</div>
                    <div class="col-md-2 four-grid">
                        <a href="StudentController/assignment_And_notes">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Assignment &amp; Notes</h3>
							</div>	
						</div>
                        </a>    
					</div>
                    
                    <div class="col-md-2 four-grid">
						<div class="four-agileinfo">
							<div class="four-text">
								<h3>Curricular Activities</h3>
							</div>
						</div>
					</div>
					<div class="col-md-2 four-grid">
						<div class="four-agileinfo">
							<div class="four-text">
								<h3>Student Behaviour</h3>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
           <div class="four-grids">
                    <?php
                        if($studentinfo->student_type == 2):
                        ?>
                        <div class="col-md-3 four-grid">
                            <a href="ProctorController/proctor">
                            <div class="four-wthree">
                                <div class="four-text">
                                    <h3>Proctor Fine Students</h3>
                                </div>	
                            </div>
                            </a>    
                        </div>
                    <?php else: ?> 
                        <div class="col-md-2 four-grid">
                        <a href="StudentController/fine">
						<div class="four-wthree">
							<div class="four-text">
								<h3>Fine</h3>
							</div>
						</div>
                        </a>    
					</div>
                    <?php endif;?>
					<div class="clearfix"></div>
				</div>