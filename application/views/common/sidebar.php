<style>
    .promo-badge a{
        border-radius: 5%;
        width: 165px;
        height: 77px;
    }
    .page-wrapper .page-sidebar .widget .nav li a:hover
    {
       color: #208e4c;
    font-size: 16px;
    background: #fff;
 
    }
    .active_class
    {
       color: #208e4c !important;
    font-size: 16px;
    background: #fff;
 
    }  .page-wrapper .page-sidebar .widget .nav li a
    {
 
    color: #fff;
    font-size: 14px;
    }
    .home-page section
    {
            background: #208e4c;
    }

</style><div class="content container">
<div class="page-wrapper">

<div class="page-content">
<div class="row page-row">
    
    
<aside class="page-sidebar col-md-3 col-sm-3 affix-top">
   
<section class="widget">
<ul class="nav">
    <?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where);       
        $section = $this->CRUDModel->get_where_row('student_group_allotment',$where);  
    ?>
<li><a href="StudentController/student_home">Dashboard</a></li>
<li>
<a href="whiteCardShow/<?php echo $student_id;?>/<?php echo $section->section_id;?>" target="_blank">White Card</a></li>
<li><a href="StudentController/student_home">Time Table</a></li>
<li><a href="StudentController/student_home">Books Issued Details</a></li>
<li><a href="StudentController/student_home">disciplinary Actions</a></li>
</ul>
</section><!--//widget-->
    
</aside><!--//page-sidebar-->
    
    