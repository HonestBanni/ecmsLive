
<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
    //var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
  }
</script>
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
          <?php echo form_open('',array('class'=>'course-finder')); ?>
            <div class="row">
            <div class="col-md-12 ">
                
                <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName?> Panel</span>
                        </h1>
                        <div class="section-content" >
                          
                                <div class="row">
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">College #</label>
                                        
                                            <?php
                                            echo  form_input( array( 
                                                    'name'          => 'college_no',
                                                    'value'         => $college_no,
                                                    'class'         =>'form-control',
                                                    'placeholder'   =>'College No'
                                                             ));
                                                  ?>
                                        
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Form #</label>
                                        
                                            <?php
                                            echo  form_input( array( 
                                                    'name'          => 'form_no',
                                                    'value'         => $form_no,
                                                    'class'         =>'form-control',
                                                    'placeholder'   =>'Form No'
                                                             ));
                                                  ?>
                                        
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Student Name</label>
                                        
                                            <?php
                                            echo  form_input( array( 
                                                    'name'          => 'student_name',
                                                    'value'         => $student_name,
                                                    'class'         =>'form-control',
                                                    'placeholder'   =>'Student Name'
                                                             ));
                                                  ?>
                                        
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Father Name</label>
                                        
                                            <?php
                                            echo  form_input( array( 
                                                    'name'          => 'father_name',
                                                    'value'         => $father_name,
                                                    'class'         =>'form-control',
                                                    'placeholder'   =>'Father Name'
                                                             ));
                                                  ?>
                                       
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Gender</label>
                                        
                                            <?php
                                            echo form_dropdown('gender', $gender, $genderId,  'class="form-control" id="my_id"');
                                                  ?>
                                        
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Program</label>
                                        
                                            <?php
                                            echo form_dropdown('program', $program, $programId,  'class="form-control feeProgrameId" id="feeProgrameId"');
                                                  ?>
                                        
                                </div>
                           
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Sub Program</label>
                                        
                                            <?php
                                          echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" id="my_id"');
                                                  ?>
                                        
                                </div>
                                  <div class="col-md-3 col-sm-5">
                                    <label for="name">Batch</label>
                                         
                                            <?php
                                                echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="my_id"');
                                            ?>
                                        
                                    </div>
                                   
                                  <div class="col-md-3 col-sm-5">
                                    <label for="name">Sections</label>
                                         
                                            <?php
                                                 echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="my_id"');
                                            ?>
                                      
                                    </div>
                                     
                            </div>
                            
                                <div class="col-md-5 col-md-offset-1 pull-right">
                                
                                        <button type="submit" name="search" value="search" class="btn btn-theme">
                                            <i class="fa fa-search">
                                          </i> Search
                                        </button>
                                
                                
                                        <button type="submit" name="export" value="export" class="btn btn-theme">
                                            <i class="fa fa-download">
                                          </i> Export
                                        </button>
                                            <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme">
                                        <i class="fa fa-print">
                                        </i> Print 
                                      </button>
                                    </div>
                                    </div>
                            
                            </div>
                            
                   </section>
             
               
            </div>
          </div>

         <?php echo form_close(); ?>     
            <?php
            if(@$result):
            ?>
            <div id="div_print">
            <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  
                  <th>Form  #</th>
                  <th>College #</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>F-name</th>
                  <th>Group</th>
                  <th>Section</th>  
                  <th>T.No</th>
                  <th>O.No</th>
                  <th>%</th>
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                      $image = '';
                       if(empty($resRow->applicant_image)):
                           $image =  'user1_thumb.png';
                       else:
                           $image =  $resRow->applicant_image;
                       endif;
                       
                    ?>
                      <tr>
                                <td><?php echo $sn; ?></td>
                                 <td><?php echo $resRow->form_no; ?></td>
                                <td><?php echo $resRow->college_no; ?></td>
                               
                                <td><img src="assets/images/students/<?php echo $image; ?>" style="height: 50px;border-radius: 20%;"></td>
                                <td><?php echo $resRow->student_name; ?></td>
                                <td><?php echo $resRow->father_name; ?></td>
                                
                                <td><?php echo $resRow->subprogram; ?></td>
                                <td><?php echo $resRow->sectionName; ?></td>
                                
                                <td><?php echo $resRow->total_marks; ?></td>
                                <td><?php echo $resRow->obtained_marks; ?></td>
                                <td><?php echo substr($resRow->percentage, 0,6); ?></td>
                                
                              </tr>
                  <?php
                   $sn++;
                  endforeach;
                ?>
              </tbody>
            </table>
            
            <?php
            echo $print_log;
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
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
 
 