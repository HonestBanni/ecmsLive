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
                        $med1 = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.sub_pro_id = 2 AND sections.status LIKE 'On' order by sections.name asc");
                        $eng1 = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.sub_pro_id = 1 AND sections.status LIKE 'On' order by sections.name asc");
                        $ics1 = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.sub_pro_id = 4 AND sections.status LIKE 'On' order by sections.name asc");
                        $art1 = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.sub_pro_id = 5 AND sections.status LIKE 'On' order by sections.name asc");
                        $med2 = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.sub_pro_id = 25 AND sections.status LIKE 'On' order by sections.name asc");
                        $eng2 = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.sub_pro_id = 24 AND sections.status LIKE 'On' order by sections.name asc");
                        $ics2 = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.sub_pro_id = 26 AND sections.status LIKE 'On' order by sections.name asc");
                        $art2 = $this->db->query("SELECT DISTINCT sections.name as section,sections.status,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.sub_pro_id = 27 AND sections.status LIKE 'On' order by sections.name asc");
                        if(!empty($med1)):
                           echo '<div class="col-md-12">
                               <header class="page-heading clearfix">
                                   <h3 class="heading-title pull-left">Pre Medical Part - I</h3>
                               </header>
                           </div>';
                           foreach($med1->result() as $row):
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
                        
                        if(!empty($eng1)):
                           echo '<div class="col-md-12">
                               <header class="page-heading clearfix">
                                   <h3 class="heading-title pull-left">Pre Engineering Part - I</h3>
                               </header>
                           </div>';
                           foreach($eng1->result() as $row):
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
                        
                        if(!empty($ics1)):
                           echo '<div class="col-md-12">
                               <header class="page-heading clearfix">
                                   <h3 class="heading-title pull-left">Computer Science Part - I</h3>
                               </header>
                           </div>';
                           foreach($ics1->result() as $row):
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
                        
                        if(!empty($art1)):
                           echo '<div class="col-md-12">
                               <header class="page-heading clearfix">
                                   <h3 class="heading-title pull-left">FA Arts Part - I</h3>
                               </header>
                           </div>';
                           foreach($art1->result() as $row):
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
                        
                        if(!empty($med2)):
                           echo '<div class="col-md-12">
                               <header class="page-heading clearfix">
                                   <h3 class="heading-title pull-left">Pre Medical Part - II</h3>
                               </header>
                           </div>';
                           foreach($med2->result() as $row):
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
                        
                        if(!empty($eng2)):
                           echo '<div class="col-md-12">
                               <header class="page-heading clearfix">
                                   <h3 class="heading-title pull-left">Pre Engineering Part - II</h3>
                               </header>
                           </div>';
                           foreach($eng2->result() as $row):
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
                        
                        if(!empty($ics2)):
                           echo '<div class="col-md-12">
                               <header class="page-heading clearfix">
                                   <h3 class="heading-title pull-left">Computer Science Part - II</h3>
                               </header>
                           </div>';
                           foreach($ics2->result() as $row):
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
                        
                        if(!empty($art2)):
                           echo '<div class="col-md-12">
                               <header class="page-heading clearfix">
                                   <h3 class="heading-title pull-left">FA Arts Part - II</h3>
                               </header>
                           </div>';
                           foreach($art2->result() as $row):
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
 
 