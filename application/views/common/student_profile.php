<aside class="page-sidebar col-md-3 col-sm-3 affix-top">
<section class="widget row-divider">
<h3 class="title" style="color:#fff">Student Information<hr></h3>
<div id="testimonials-carousel" class="testimonials-carousel carousel slide">
<div class="carousel-inner">
    <div class="item active">
    <div class="row">
        <?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where);      
        $picture = $studentinfo->applicant_image;
                                ?>
        <p class="people col-md-12 col-md-push-1"> 
    <span class="name" style="color:#fff">Name: <?php echo $studentinfo->student_name;?></span>
        <br>
    <span class="title" style="color:#fff">F/Name: <?php echo $studentinfo->father_name;?></span>
        <br>
    <span class="title" style="color:#fff">College #: <?php echo $studentinfo->college_no;?></span>
            <br>
    <span class="title" style="color:#fff">Prog: <?php echo $studentinfo->program;?></span>
            <br>
    <span class="title" style="color:#fff">Sub Prog:<?php echo $studentinfo->sub_program;?></span>
            <br>
    <span class="title" style="color:#fff">Batch: <?php echo $studentinfo->batch;?></span>
           
        </p>
    </div>
</div><!--//item-->
</div><!--//carousel-inner-->
</div><!--//testimonials-carousel-->
</section> 
    </aside>    
    
    
</div><!--//page-row-->
</div><!--//page-content-->
</div><!--//page-->
</div>