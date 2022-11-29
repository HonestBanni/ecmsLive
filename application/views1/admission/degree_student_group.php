<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>

<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Degree Student Groups</h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('#', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Degree Student Groups
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
                    $q = $this->db->query("SELECT DISTINCT sections.name as section,sections.sec_id as sec_id,sections.status,sections.program_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id='4' AND status LIKE 'On' order by sections.name asc");
                            foreach($q->result() as $row)
                            {
                                $sec_id = $row->sec_id;
                            $s = $this->db->query("SELECT `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                            ?>
                        <div class="col-md-2">
                <div class="form-group">  
        <a href="admin/view_student_group/<?php echo $sec_id;?>">
        <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly></a> 
                </div>
                        </div>
                         <?php } ?>
                 </div>
                </div>
            </div>
                        </form>  
                <hr>
        <?php echo form_open('admin/degree_student_group'); ?>
            <div class="row">
             <div class="col-md-12">
                 <div class="row">
                     <div class="col-md-2">
                         <div class="form-group">
    <input type="text" class="form-control" name="student_name" placeholder="Student Name" value="<?php if($student_name): echo $student_name;endif; ?>">
                        </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group ">
    <input type="text" class="form-control" name="father_name" placeholder="Father Name" value="<?php if($father_name): echo $father_name;endif; ?>">
                        </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group ">
<input type="text" class="form-control" name="college_no" placeholder="College No." value="<?php if($college_no): echo $college_no;endif; ?>">
                        </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group">
                            <?php 
                              echo form_dropdown('batch_id', $batch,'',  'class="form-control" id="programId"');
                          ?>
                        </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group ">
                            <?php 
                              echo form_dropdown('programe_id', $program,'',  'class="form-control" id="alumiProgrameId"');
                          ?>
                        </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group ">
                            <?php 
                              echo form_dropdown('sub_pro_id', $sub_program,'',  'class="form-control" id="showAlumiSubPro"');
                          ?>
                        </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group ">
                            <?php 
                              echo form_dropdown('gender_id', $gender,'',  'class="form-control" id="programId"');
                          ?>
                        </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group ">
    <input type="text" name="limit" value="" class="form-control" placeholder="Limit eg 35">
                        </div>
                     </div>
                     
                     <div class="col-md-10">
                           <input type="hidden" name="student_id" value="">
                            <div class="form-group">
                              <button type="submit" name="search" value="Search" class="btn btn-theme">
                                  <i class="fa fa-search">
                                </i> Search 
                              </button>
                            </div>
                        
                     </div>
                     
                      <div class="col-md-3">
                         <div class="form-group ">
                            <?php 
                              echo form_dropdown('sec_id', $section,'',  'class="form-control" id="programId"');
                          ?>
                        </div>
                     </div>
                       <div class="col-md-3">
                          
                           <input type="hidden" name="student_id" value="">
                            <div class="form-group">
                              <button type="submit" name="save" value="save" class="btn btn-theme">
                                  <i class="fa fa-save">
                                </i> Save
                              </button>
                            </div>
                        
                     </div>
                     
                 </div>
            
              <!--//form-group-->
              
                  <?php
            if(@$result):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count($result);?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkAll"></th>    
                  <th>S.no</th>
                  <th>Picture</th>
                  <th>Name</th>
                  <th>Father name</th>
                  <th>College No</th>
                  <th>Program</th>
                  <th>Sub program</th>
                  <th>Batch no</th>
                  <th>Gender</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                      echo '<tr>
                                    
                                
                                <td><input type="checkbox" name="checked[]" value="'.$resRow->student_id.'" id="checkItem">
                                <input type="hidden" name="student_id" >
                                </td>
                                <td>'.$sn.'</td>
                                <td><img src="assets/images/students/'.$resRow->applicant_image.'" width="60" height="50"></td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->father_name.'</td>
                                <td>'.$resRow->college_no.'</td>
                                <td>'.$resRow->program.'</td>
                                <td>'.$resRow->sub_program.'</td>
                                <td>'.$resRow->batch.'</td>
                                <td>'.$resRow->gender.'</td>
                               
                                
                              </tr>';
                   $sn++;
                  endforeach;
                ?>
                
              </tbody>
            </table>
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
              <?php echo form_close(); ?>   
              <!--//form-group-->
               
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
 
 