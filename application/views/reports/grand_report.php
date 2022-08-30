
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
              
              <!--//form-group-->
 
              <div class="form-group">
            <?php 
                echo form_dropdown('reserved_seat', $reserved_seat, $reserved_seatId,  'class="form-control" id="my_id"');
            ?>
              </div>
              <div class="form-group">
            <?php 
                echo form_dropdown('reserved_seat3', $reserved_seat3, $reserved_seatId3,  'class="form-control" id="my_id"');
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
            <table class="table table-boxed table-hover" style="font-size:8px;">
              <thead>
                <tr>
                  <th>#</th>
                  
                  <th>Form#</th>
                  <th>College#</th>
                  <th>Img</th>
                  <th>Name</th>
                  <th>F-name</th>
                  <th>Gender</th>
                  <th>Program</th>
                  <th>Sub program</th>
                  <th>Section</th>
                  <th>R-Seat 1</th>
                  <th>R-Seat 2</th>
                  <th>R-Seat 3</th>
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
                        
                        $rseat_id1 = $resRow->rseats_id1;
                        $result1 = $this->ReportsModel->get_by_id('reserved_seat',array('rseat_id'=>$rseat_id1));
                        
                        $rseat_id2 = $resRow->rseats_id2;
                        $result2 = $this->ReportsModel->get_by_id('reserved_seat',array('rseat_id'=>$rseat_id2));
    
                ?>
                      <tr>
                                <td><?php echo $sn; ?></td>
                              
                                <td><?php echo $resRow->form_no; ?></td>
                                  <td><?php echo $resRow->college_no; ?></td>
                                <td><img src="assets/images/students/<?php echo $resRow->applicant_image; ?>" style="height: 50px;"></td>
                                <td><?php echo $resRow->student_name; ?></td>
                                <td><?php echo $resRow->father_name; ?></td>
                                <td><?php echo $resRow->genderName; ?></td>
                                <td><?php echo $resRow->programe_name; ?></td>
                                <td><?php echo $resRow->subprogram; ?></td>
                                <td><?php echo @$resRow->sectionName; ?></td>
                                <td><?php echo $resRow->reservedName; ?></td>
                                <td><?php foreach($result1 as $orec){ echo $orec->name; }?></td> 
                                <td><?php foreach($result2 as $orec2){ echo $orec2->name; }?></td> 
                                <td><?php echo $resRow->batch_name; ?></td>
                                <td><?php echo $resRow->total_marks; ?></td>
                                <td><?php echo $resRow->obtained_marks; ?></td>
                                <td><?php echo substr($resRow->percentage, 0,6); ?></td>
                                <td><span class="label label-success"><?php echo $resRow->student_statusName; ?>
                                  </span>
                                </td>
                              </tr>
                  <?php
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
 
 