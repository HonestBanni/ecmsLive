
<div class="content-wrapper col-md-6 col-sm-9">
<div class="page-row">
    <?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where); 
        $section = $this->CRUDModel->get_where_row('student_group_allotment',$where);
        
//        $this->db->SELECT('*');
//        $this->db->FROM('student_record');
//        $this->db->join('proctors','proctors.student_id=student_record.student_id');
//        $this->db->where('student_record.student_id',$student_id);
//        $query =  $this->db->get()->row();  
    ?>
    <div class="row box">
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="whiteCardShow/<?php echo $student_id;?>/<?php echo $section->section_id;?>" target="_blank">
            <span class="desc">White Card</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Monthly Test Marks</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Paid Fee Details</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Remaining Fee Details</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Courses Details</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Time Table</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Exam Details</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Books Issued Details</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Pending Books Details</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Fine</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Curriculam Activity</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Student Behaviour Details</span>
            </a>
            </p>
        </div>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="RedDamask" href="#">
            <span class="desc">Assignment &amp; Notes</span>
            </a>
            </p>
        </div>
        <?php if($studentinfo->student_type == 2): 
        ?>
        <div class="col-md-4 col-sm-4">
            <p class="promo-badge">
            <a class="Mojo" href="ProctorController/proctor">
            <span class="desc">Proctor</span>
            </a>
            </p>
        </div>
        <?php
        endif;
        ?>
    
</div>

</div>
</div><!--//content-wrapper-->
