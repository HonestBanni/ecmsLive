<ol class="breadcrumb">
  <li class="breadcrumb-item">
      <a href="StudentController/proctor_home">Home</a> <i class="fa fa-angle-right"></i> 
      <a href="#">View Profile</a> 
    </li>
</ol>
<div class="agile3-grids">
		<?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where);       
        $section = $this->StudentModel->get_where_sec('student_group_allotment',$where);       
          $picture = $studentinfo->applicant_image;
                                ?>
        
			<div class="gallery-grids">
                <div class="col-md-1"></div>
				<div class="col-md-3 gallery-grids-left">
					<div class="gallery-grid">
            <?php
                if($picture == ''){
            ?>
						<a class="example-image-link" href="assets/images/students/user.png" data-lightbox="example-set" data-title="">
				        <img src="assets/images/students/user.png" alt="">
						</a>
                <?php
                }else{
                ?>
                        <a class="example-image-link" href="assets/images/students/<?php echo $picture;?>" data-lightbox="example-set" data-title="">
                        <img src="assets/images/students/<?php echo $picture;?>" alt="">
						</a>        
                <?php
                }
                    ?>        
                    </div>
				</div>
                <div class="col-md-2"></div>
                <div class="col-md-5 compose w3layouts">
		
            <h2>Information</h2>
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
                Batch Name: <?php echo $studentinfo->batch;?> 
                <div class="clearfix"></div>
              </a>
          </li><li class="active">
              <a href="#">
                Program: <?php echo $studentinfo->program;?> 
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
		
	</div>
