
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
            <div class="row">
            <div class="col-md-12 ">
              
<!--              <div class="form-group">
                <?php
                    $student_id = array(
                    'name'	=> 'college_no',
                    'value'	=> $college_no,
                    'class'     =>'form-control',
                    'placeholder'=>'College No'
                    );
                    echo form_input($college_no);
                    ?>
              </div>-->
              <!--//form-group-->
              <div class="form-group ">
                  <input name="college_no" value="<?php if($college_no): echo $college_no;endif; ?>"type="number" class="form-control" placeholder="College No">
              </div>
              <div class="form-group ">
                  <input name="form_no" value="<?php if($form_no): echo $form_no;endif; ?>"type="number" class="form-control" placeholder="Form no">
              </div>
              <!--//form-group-->     
              <div class="form-group">
                  <input name="student_name" type="text" value="<?php if($student_name): echo $student_name;endif; ?>" class="form-control" placeholder="Name">
              </div>
              <!--//form-group-->
              <div class="form-group ">
                <input name="father_name" type="text" value="<?php if($father_name): echo $father_name;endif; ?>"  class="form-control" placeholder="Father name">
              </div>
              <!--//form-group-->
              <div class="form-group">
                <?php 
                echo form_dropdown('gender', $gender, $genderId,  'class="form-control" id="my_id"');
                ?>
              </div>
              <div class="form-group">
                <?php 
                    //$slctdCategory = (isset($product->category) ? $product->category : '');
                    echo form_dropdown('program', $program, $programId,  'class="form-control" id="programId"');
                ?>
              </div>
              <!--//form-group-->
              <div class="form-group">
                <?php 
                echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" id="my_id"');
                ?>
              </div>
              <div class="form-group">
                <?php 
                echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="my_id"');
                ?>
              </div>
              <div class="form-group">
                <?php 
                echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="my_id"');
                ?>
              </div>
              <div class="form-group">
                <?php 
               echo form_dropdown('application_status', $student_status,$application_statusId,  'class="form-control" id="my_id"');
                ?>
              </div>
              <!--//form-group-->
              <div class="form-group">
                 
                  
            
                <?php 
                  $limit = array(
                    '2'=>'â†? Picture Status  â†’',
                    '1'=>'Have Picture',
                    '0'=>'No Picture'
                    );
                echo  form_dropdown('picture',$limit,$pictureId,  'class="form-control" id="my_id"');
                ?>
 
              </div>
               
                  
                     <div class="form-group">
                        <button type="submit" name="search" value="search" class="btn btn-theme">
                            <i class="fa fa-search">
                          </i> Search
                        </button>
                      </div>
                      <div class="form-group">
                        <button type="submit" name="export" value="export" class="btn btn-theme">
                            <i class="fa fa-download">
                          </i> Export
                        </button>
                      </div>
<!--                      <div class="form-group">
                        <button type="submit" name="print" value="print" class="btn btn-theme">
                            <i class="fa fa-print">
                          </i> print
                        </button>
                      </div> -->
               
             
              <!--//form-group-->
               
            </div>
          </div>

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
                  <th>Form  #</th>
                  <th>Img</th>
                  <th>Name</th>
                  <th>Father name</th>
                  <th>Gender</th>
                  <th>Program</th>
                  <th>Sub program</th>
                  <th>section</th>
                  <th>Reserved Seats</th>
                  <th>Batch no</th>
                   
                  <th>T.No</th>
                  <th>O.No</th>
                  <th>%</th>
                   
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                         $timestamp = strtotime($resRow->admission_date);
                          $admission_date = date('d-m-y', $timestamp);
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$resRow->college_no.'</td>
                                <td>'.$resRow->form_no.'</td>
                                <td><img src="assets/images/students/'.$resRow->applicant_image.'" style="height: 50px;"></td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->father_name.'</td>
                                <td>'.$resRow->genderName.'</td>
                                <td>'.$resRow->programe_name.'</td>
                                <td>'.$resRow->subprogram.'</td>
                                <td>'.@$resRow->sectionName.'</td>
                                <td>'.$resRow->reservedName.'</td>
                                <td>'.$resRow->batch_name.'</td>
                                
                                <td>'.$resRow->total_marks.'</td>
                                <td>'.$resRow->obtained_marks.'</td>
                                <td>'.substr($resRow->percentage, 0,6).'</td>
                               
                                <td><span class="label label-success">'.$resRow->student_statusName.'
                                  </span>
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
 
 