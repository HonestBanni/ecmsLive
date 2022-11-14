
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $ReportName?>
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current"><?php echo $ReportName?>
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7  page-row">                            
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName?> Panel</span>
                        </h1>
                  <div class="section-content" >
                      
                      <div class="row">
                              <div class="col-md-2">
                                      <label for="name">College #</label>
                                      <div class="input-group" id="adv-search">
                                          <input name="college_no" value="<?php echo $college_no;?>"type="number" class="form-control" placeholder="College No">
                                      </div>
                                </div>
                               
                                <div class="col-md-2">
                                      <label for="name">Student Name</label>
                                      <div class="input-group" id="adv-search">
                                         <input name="student_name" type="text" value="<?php echo $student_name;?>" class="form-control" placeholder="Name">
                                      </div>
                                </div>
                               
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Father Name</label>
                                      <div class="input-group" id="adv-search">
                                         <input name="father_name" type="text" value="<?php echo $father_name; ?>"  class="form-control" placeholder="Father name">
                                      </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Program</label>
                                      <div class="input-group" id="adv-search">
                                          <?php  echo form_dropdown('program', $program, $programId,  'class="form-control" id="ProgramWhiteCard"');   ?>
                                      </div>
                                </div>
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Batch</label>
                                      <div class="input-group" id="adv-search">
                                          <?php 
                                                echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="batch_id"');
                                            ?>
                                      </div>
                                </div>
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Sub Program</label>
                                      <div class="input-group" id="adv-search">
                                          <?php 
                                                echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" id="SubProgramWC"');
                                            ?>
                                      </div>
                                </div>
                        </div>
                        <div class="row">
                                 
                                 
                                
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Sections</label>
                                      <div class="input-group" id="adv-search">
                                          <?php 
                                                echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="SectionsWC"');
                                            ?>
                                      </div>
                                </div>
                                </div>
                                <div class="row">
                          
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search" value="search"><i class="fa fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-theme" id="stdPrint" value="Print"><i class="fa fa-print"></i> Print</button>
                                   
                                    
     
                                </div>
                            </div>
                          
                      </div>
              
                  </div>
              </section>

         <?php echo form_close(); ?>     
            <?php
            if(@$result):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo $countResult?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>College #</th>
                  <th>Name</th>
                  <th>Father Name</th>
                  <!--<th>Program</th>-->
                  <th>Sub Program</th>
                  <th>Batch</th>
                  <th>Section</th>
                  <th>Status</th>
                  <th colspan="3">Attendance Details</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                          
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$resRow->college_no.'</td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->father_name.'</td>
                                <td>'.$resRow->subprogram.'</td>
                                <td>'.$resRow->batch_name.'</td>
                                <td>'.$resRow->sectionName.'</td>
                                <td>'.$resRow->studentStatus.'</td>
                                <td>';
                                echo '<a class="btn btn-success" target="_blank" href="whiteCardPrint/'.$resRow->student_id.'/'.$resRow->sec_id.'">White Card</a>';
                                echo '</td>
                                <td>
                                    <a class="btn btn-success" target="_blank" href="whiteCardTeacher/'.$resRow->student_id.'/'.$resRow->sec_id.'">T. White Card</a>
                                </td>
                                <td>
                                    <a class="btn btn-success" target="_blank" href="SARDRI/'.$resRow->student_id.'/'.$resRow->sec_id.'">Daily Attd</a>
                                </td>
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
 
  <script>
      jQuery(document).ready(function(){
  
       jQuery('#ProgramWhiteCard').on('click',function(){
    
     var programId = jQuery('#ProgramWhiteCard').val();
     
        //get sub program
        jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getSubProgram',
         data   :{'programId':programId},
         success :function(result){
            jQuery('#SubProgramWC').html(result);
        },
        complete:function(){
//           

//           
            //Get Batch 
            jQuery.ajax({
                type   :'post',
                url    :'feeController/getBatch',
                data   :{'programId':programId},
               success :function(result){
                   console.log(result);
                  jQuery('#batch_id').html(result);
               }
            });
            
              
        }
        
     });
     
 });
 
 jQuery('#SubProgramWC').on('change',function(){
        
  
            var programId           = jQuery('#ProgramWhiteCard').val();
            var sub_program_id      = jQuery('#SubProgramWC').val();
            var batch_id            = jQuery('#batch_id').val();
            // get Section 
            jQuery.ajax({
                type   :'post',
                url    :'feeController/getSectionsWhiteCard',
                data   :{'sub_program_id':sub_program_id,'programId':programId,'batch_id':batch_id},
               success :function(result){
                   console.log(result);
                  jQuery('#SectionsWC').html(result);
               }
            });
  
  
  
//     jQuery.ajax({
//         type   :'post',
//         url    :'feeController/getBatch',
//         data   :{'programId':programId},
//        success :function(result){
//            console.log(result);
//           jQuery('#batch_id').html(result);
//        }
//     });
     
     
     
     
 });
 
 });
      </script>