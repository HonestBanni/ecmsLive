<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>

<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Student Groups</h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/add_group_student', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Student Groups Chart
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
            <article class="contact-form col-md-12 col-sm-7"> 
        <form>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php
                        $fsc = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 1 AND sections.status LIKE 'On' order by sections.name asc");
                        $bcs = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 2 AND sections.status LIKE 'On' order by sections.name asc");
                        $bba = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 6 AND sections.status LIKE 'On' order by sections.name asc");
                        $eng = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 8 AND sections.status LIKE 'On' order by sections.name asc");
                        $law = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 9 AND sections.status LIKE 'On' order by sections.name asc");
                        $eco = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 14 AND sections.status LIKE 'On' order by sections.name asc");
                        $pol = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 17 AND sections.status LIKE 'On' order by sections.name asc");
                        $hnb = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 3 AND sections.status LIKE 'On' order by sections.name asc");
                        $dsm = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 7 AND sections.status LIKE 'On' order by sections.name asc");
//                        $hnc = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id = 18 AND sections.status LIKE 'On' order by sections.name asc");
                        if(!empty($fsc)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">FA / FSc</h3>
                                </header>
                            </div>';
                            foreach($fsc->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        if(!empty($bcs)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">BS Computer Science</h3>
                                </header>
                            </div>';
                            foreach($bcs->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        if(!empty($bba)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">BBA</h3>
                                </header>
                            </div>';
                            foreach($bba->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        if(!empty($eng)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">BS English</h3>
                                </header>
                            </div>';
                            foreach($eng->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        if(!empty($law)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">BS Law</h3>
                                </header>
                            </div>';
                            foreach($law->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        if(!empty($eco)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">BS Economics</h3>
                                </header>
                            </div>';
                            foreach($eco->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        if(!empty($pol)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">BS Political Science</h3>
                                </header>
                            </div>';
                            foreach($pol->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        if(!empty($hnb)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">HND Business</h3>
                                </header>
                            </div>';
                            foreach($hnb->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        if(!empty($dsm)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">EDSML</h3>
                                </header>
                            </div>';
                            foreach($dsm->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        if(!empty($hnc)):
                            echo '<div class="col-md-12">
                                <header class="page-heading clearfix">
                                    <h3 class="heading-title pull-left">HND Computing</h3>
                                </header>
                            </div>';
                            foreach($hnc->result() as $row):
                                $sec_id = $row->sec_id;
                                $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                if($s->num_rows()>0):
                                ?>
                                <div class="col-md-3">
                                   <div class="form-group">   
                                   <a href="admin/view_student_group/<?php echo $sec_id;?>">
                                       <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly>
                                   </a> 
                                   </div>
                                </div>
                                <?php
                                endif; 
                            endforeach;
                        endif;
                        
                        ?>
                   </div>
                </div>
            </div>
        </form>  
                 
        
            
          </div>
  
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    
  <!--//content-->
 
 