<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>

<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Student Practical Groups Inter Level</h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('#', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Student Practical Groups Inter Level
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
        $q = $this->db->query("SELECT DISTINCT practical_group.group_name,practical_group.prac_group_id,practical_group.status,practical_group.sub_pro_id from practical_group,student_prac_group_allottment where student_prac_group_allottment.group_id = practical_group.prac_group_id AND status LIKE 'On' order by practical_group.prac_group_id asc");
                            foreach($q->result() as $row)
                            {
                                $group_id = $row->prac_group_id;
                            $s = $this->db->query("SELECT `student_record`.`student_name` FROM `student_record`,`student_prac_group_allottment` WHERE `student_prac_group_allottment`.student_id = student_record.student_id AND `group_id`='$group_id'");    
                            ?>
                        <div class="col-md-2">
                <div class="form-group">  
        <a href="#">
        <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->group_name;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly></a> 
                </div>
                        </div>
                         <?php } ?>
                 </div>
                </div>
            </div>
                        </form>  
                
        <?php echo form_open('admin/student_group_practical_inter'); ?>
            <div class="row">
                <h2>Assign Students to Practical Group</h2><hr>
             <div class="col-md-12" style="min-height:70px;">
                 <div class="row">
                     <div class="col-md-3">
                         <div class="form-group">
    <input type="text" class="form-control" name="student_id" id="std_names_prac" placeholder="Student Name">
    <input type="hidden" name="student_id" id="student_id">
                        </div>
                     </div>
                     <div class="col-md-3">
                    <div class="form-group">
                      <input type="button" name="submit" id="add_student_practical" value="Add Student" class="btn btn-theme">
                        </div>
                     </div>
                      <div class="col-md-3">
                         <div class="form-group">
                            <input type="text" name="group_id" class="form-control" id="groupName">
                            <input type="hidden" name="group_id" id="group_id">
                        </div>
                     </div>
                       <div class="col-md-3">
                            <div class="form-group">
                              <button type="submit" name="save_students" value="Assign Section" class="btn btn-theme">
                                  <i class="fa fa-save">
                                </i> Assign Section
                              </button>
                            </div>
                        
                     </div>
                     
                 </div>
              <?php echo form_close(); ?>  
            </div>
                <div id="student_practical_Record">
              
            </div>
          </div>
            
            </article>
          
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 