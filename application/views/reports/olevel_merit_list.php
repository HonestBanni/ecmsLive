
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">O Level Merit List
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
          <li class="current">O Level Merit list
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
              
              <div class="form-group ">
                <?php
                    $student_id = array(
                    'name'	=> 'student_id',
                    'value'	=> $studentId,
                    'class' =>'form-control',
                    'placeholder'=>'Student id'
                    );
                    echo form_input($student_id);
                    ?>
              </div>
              <!--//form-group-->
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
              
              <!--//form-group-->
 
              <div class="form-group">
            <?php 
                echo form_dropdown('reserved_seat', $reserved_seat, $reserved_seatId,  'class="form-control" id="my_id"');
            ?>
              </div>
              <div class="form-group">
                <?php 
               echo form_dropdown('application_status', $student_status,$application_statusId,  'class="form-control" id="my_id"');
                ?>
              </div>
              <div class="form-group">
                <?php 
               echo form_dropdown('batch_id', $batch,$batch_id,  'class="form-control"');
                ?>
              </div>    
              <div class="form-group">
                <?php 
                echo form_dropdown('limit',$limit,$limitId,  'class="form-control" id="my_id"');
                ?>
              </div>
              <div class="form-group">
                <button type="submit" name="search" value="search" class="btn btn-theme">
                  <i class="fa fa-search">
                      Search
                  </i>  
                </button>
              </div>
              <div class="form-group">
                <button type="submit" name="export" value="export" class="btn btn-theme">
                    <i class="fa fa-download">
                  </i> Export
                </button>
              </div>
              
             
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
                  <th>S.no</th>
                  <th>F.No</th>
                  <th>Img</th>
                  <th>Name</th>
                  <th>Father name</th>
                  <th>Gender</th>
                  <th>Program</th>
                  <th>Sub program</th>
                  <th>Reserved Seats</th>
                  <th>Batch no</th>
                  <th>Subjects Wise Grade</th>
                  <th>Percentage</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                $timestamp = strtotime($resRow->admission_date);
                $admission_date = date('d-m-y', $timestamp);
                $student_id = $resRow->student_id;
                $where = array('student_grades.student_id'=>$student_id);
                $qry = $this->ReportsModel->get_where_grades('student_grades',$where);
                
                ?>
                <tr>
                        <td><?php echo $sn;?></td>
                        <td><?php echo $resRow->form_no;?></td>
                        <td><img src="assets/images/students/<?php echo $resRow->applicant_image;?>" style="height: 50px; width:50px;"></td>
                        <td><?php echo $resRow->student_name;?></td>
                        <td><?php echo $resRow->father_name;?></td>
                        <td><?php echo $resRow->genderName;?></td>
                        <td><?php echo $resRow->programe_name;?></td>
                        <td><?php echo $resRow->subprogram;?></td>
                        <td><?php echo $resRow->reservedName;?></td>
                        <td><?php echo $resRow->batch_name;?></td>
                        <td><?php
                            $res = "";
                            if($qry):
                            $count = count($qry)*100;
                            if($count == ""):
                                echo "0";
                            else:
                            $grade = "";
                            
                            foreach($qry as $rec):
                                echo $rec->ol_subject_name;
                                echo '(';
                                echo $rec->grade_name;
                                echo '),';
                                $grade += $rec->grade_value;
                            endforeach;
                           // $res = ($grade/$count)*100;
                            $res = round(($grade/$count)*100,3); 
                            endif;
                            endif;
                            
                            ?></td>
                        <td><?php echo $res;?> %</td>
    <td><span class="label label-success"><?php echo $resRow->student_statusName;?></span></td>
                      </tr>
                    <?php
                   $sn++;
                  $res = "0";
                  endforeach;
                ?>
              </tbody>
            </table>
             <?php echo $print_log;?>
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
 
 