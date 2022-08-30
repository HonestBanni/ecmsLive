
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
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12 ">
                
                <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName?> Panel</span>
                        </h1>
                        <div class="section-content" >
                          
                                <div class="row">
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">College #</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                            echo  form_input( array( 
                                                    'name'          => 'college_no',
                                                    'value'         => $college_no,
                                                    'class'         =>'form-control',
                                                    'placeholder'   =>'College No'
                                                             ));
                                                  ?>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Form #</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                            echo  form_input( array( 
                                                    'name'          => 'form_no',
                                                    'value'         => $form_no,
                                                    'class'         =>'form-control',
                                                    'placeholder'   =>'Form No'
                                                             ));
                                                  ?>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Student Name</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                            echo  form_input( array( 
                                                    'name'          => 'student_name',
                                                    'value'         => $student_name,
                                                    'class'         =>'form-control',
                                                    'placeholder'   =>'Student Name'
                                                             ));
                                                  ?>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Father Name</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                            echo  form_input( array( 
                                                    'name'          => 'father_name',
                                                    'value'         => $father_name,
                                                    'class'         =>'form-control',
                                                    'placeholder'   =>'Father Name'
                                                             ));
                                                  ?>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Gender</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                            echo form_dropdown('gender', $gender, $genderId,  'class="form-control" id="my_id"');
                                                  ?>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Program</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                            echo form_dropdown('program', $program, $programId,  'class="form-control programe_id" id="feeProgrameId"');
                                                  ?>
                                        </div>
                                </div>
                           
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Sub Program</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                                             ?>
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
                                    <label for="name">Sections</label><br>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                 echo form_dropdown('sections_name', $sections, $sectionId, 'class="form-control section" id="showSections"');
                                            ?>
                                        </div>
                                    </div>
                                  <div class="col-md-2 col-sm-5">
                                    <label for="name">Select Shift</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                 echo form_dropdown('shift', $shift, $shift_id,  'class="form-control" id="shift"');
                                            ?>
                                        </div>
                                    </div>
                                  <div class="col-md-2 col-sm-5">
                                    <label for="name">Reserved</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                 echo form_dropdown('reserved_seat', $reserved_seat, $reserved_seatId,  'class="form-control" id="my_id"');
           
                                            ?>
                                        </div>
                                    </div>
                                  <div class="col-md-2 col-sm-5">
                                    <label for="name">Admission In</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                 echo form_dropdown('reserved_seat3', $reserved_seat3, $reserved_seatId3,  'class="form-control" id="my_id"');
           
                                            ?>
                                        </div>
                                    </div>
                            
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Status</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                echo form_dropdown('application_status', $student_status,$application_statusId,  'class="form-control" id="my_id"');
           
                                            ?>
                                        </div>
                                    </div>
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Picture</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                    $picture = array(
                                                '2'=>' Picture Status ',
                                                '1'=>'Have Picture',
                                                '0'=>'No Picture'
                                                );
                                            echo  form_dropdown('picture',$picture,$pictureId,  'class="form-control" id="my_id"');
                                            ?>
                                        </div>
                                    </div>
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Hostel</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                    $hostel = array(
                                                    '0'=>' Hostel Status ',
                                                    '1'=>'Yes',
                                                    '2'=>'No'
                                                    );
                                            echo  form_dropdown('hostel',$hostel,$hostelId,  'class="form-control" id="my_id"');
                                            ?>
                                        </div>
                                    </div>
                                     <div class="col-md-2 col-sm-5">
                                    <label for="name">Religion</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                             echo form_dropdown('religion', $religion,$religionId,  'class="form-control" id="my_id"');
                                            ?>
                                        </div>
                                    </div>
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Admission From Date</label>
                                    <div class="input-group" id="adv-search"> <?php
                                         
                                         echo  form_input( array( 
                                                    'name'          => 'fromDate',
                                                    'value'         => $fromDate,
                                                    'class'         =>'form-control datepicker',
                                                    'placeholder'   =>'Admission From Date'
                                                             ));
                                                  
                                         
                                         ?>
                                    </div>
                                    </div>
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Admission To Date</label>
                                        <div class="input-group" id="adv-search"> <?php
                                         
                                         echo  form_input( array( 
                                                    'name'          => 'toDate',
                                                    'required'          => 'required',
                                                    'value'         => $toDate,
                                                    'class'         =>'form-control datepicker',
                                                    'placeholder'   =>'Admission To Date'
                                                             ));
                                             
                                         
                                         ?>
                                    </div>
                                    </div>
                                
                            </div>
                            <div style="padding-top:1%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
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
                                            <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme">
                                        <i class="fa fa-print">
                                        </i> Print 
                                      </button>
                                    </div>
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
            <table class="table table-boxed table-hover" style="font-size:9px">
              <thead>
                <tr>
                  <th>#</th>
                  
                  <th>Form  #</th>
                  <th>College #</th>
                  <th>Img</th>
                  <th>Name</th>
                  <th>F-name</th>
                  <th>Gender</th>
                  <th>Shift</th>
                  <th>Program</th>
                  <th>Sub program</th>
                  <th>section</th>
                  <th>R-Seat 1</th>
                  <th>R-Seat 2</th>
                  <th>R-Seat 3</th>
                  <th>Batch no</th>   
                  <th>T.No</th>
                  <th>O.No</th>
                  <th>%</th>
                  
                  <th>Hostel</th>
                  <th>Adm Date</th>
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
                            
                            $std_name = '';
                            if (strlen($resRow->student_name) >= 17) {
                                    $std_name = substr($resRow->student_name, 0, 17).'...';
                                }
                                else {
                                    $std_name = $resRow->student_name;
                                }
    
                ?>
                      <tr>
                                <td><?php echo $sn; ?></td>
                                 <td><?php echo $resRow->form_no; ?></td>
                                <td><?php echo $resRow->college_no; ?></td>
                               
                                <td><img src="assets/images/students/<?php echo $resRow->applicant_image; ?>" style="height: 50px;"></td>
                                <td><?php echo $std_name; ?></td>
                                <td><?php echo $resRow->father_name; ?></td>
                                <td><?php echo $resRow->genderName; ?></td>
                                <td><?php echo $resRow->shift_name; ?></td>
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
                                <td><?php echo $resRow->hostelRecord;?></td>
                                <td><?php echo date('d-m-Y',strtotime($resRow->admission_date));?></td>
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
 
  <script>
  
     $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
    </script>
 