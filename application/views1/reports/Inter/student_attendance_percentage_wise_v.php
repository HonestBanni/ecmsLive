
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
    window.location.href = 'AttendancePercentageWise';
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
                                  
                                <div class="col-md-3 col-sm-5">
                                    <div class="input-group" id="adv-search">
                                    <label for="name">Program</label>
                                        
                                            <?php
                                            echo form_dropdown('program', $program, $programId,  'class="form-control" id="feeProgrameId"');
                                                  ?>
                                        </div>
                                </div>
                           
                                <div class="col-md-3 col-sm-5">
                                   
                                        <div class="input-group" id="adv-search">
                                             <label for="name">Sub Program</label>
                                            <?php
                                          echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" id="showFeeSubPro" required="required"');
                                                  ?>
                                        </div>
                                </div>
                                  <div class="col-md-3 col-sm-5">
                                   
                                        <div class="input-group" id="adv-search">
                                             <label for="name">Batch</label>
                                            <?php
                                                echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="batch_id"');
                                            ?>
                                        </div>
                                    </div>
                                   
                                  <div class="col-md-3 col-sm-5">
                                    
                                        <div class="input-group" id="adv-search">
                                            <label for="name">Sections</label>
                                            <?php
                                                 echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="showSections"');
                                            ?>
                                        </div>
                                    </div> 
                                
                            </div>
                          
                                <div class="row">
                                  
                                <div class="col-md-3 col-sm-5">
                                   
                                        <div class="input-group" id="adv-search">
                                             <label for="name">Attendance From</label>
                                            <?php
                                              echo  form_input( array( 
                                                    'name'          => 'attendance_from',
                                                    'value'         => $attendance_from,
                                                    'class'         =>'form-control datepicker',
                                                    'placeholder'   =>'Attendance From'
                                                             ));
                                            ?>
                                        </div>
                                </div>
                           
                                <div class="col-md-3 col-sm-5">
                                    
                                        <div class="input-group" id="adv-search">
                                             <label for="name">Attendance To</label>
                                                 <?php
                                              echo  form_input( array( 
                                                    'name'          => 'attendance_to',
                                                    'value'         => $attendance_to,
                                                    'class'         =>'form-control datepicker',
                                                    'placeholder'   =>'Attendance To'
                                                             ));
                                            ?>
                                        </div>
                                </div>
                                  <div class="col-md-3 col-sm-5">
                                   
                                        <div class="input-group" id="adv-search">
                                         
                                            <label for="name">Percentage From (%)</label>   
                                                <?php
                                                 echo  form_input( array( 
                                                    'name'          => 'percentage_from',
                                                    'value'         => $percentage_from,
                                                    'class'         => 'form-control',
                                                    'type'          => 'number',
                                                    'min'           => '0',
                                                    'max'           => '100',
                                                    'placeholder'   => 'Percentage From'
                                                             ));
                                            ?>
                                        </div>
                                    </div>
                                   
                                  <div class="col-md-3 col-sm-5">
                                    
                                        <div class="input-group" id="adv-search">
                                            <label for="name">Percentage To (%)</label>
                                            <?php
                                                  
                                                 echo  form_input( array( 
                                                    'name'          => 'percentage_to',
                                                    'value'         => $percentage_to,
                                                    'class'         => 'form-control',
                                                    'type'          => 'number',
                                                    'min'           => '0',
                                                    'max'           => '100',
                                                    'placeholder'   => 'Percentage To'
                                                             ));
                                            ?>
                                        </div>
                                    </div> 
                                
                            </div>
                            <div style="padding-top:1%;">
                                <div class="col-md-3 col-md-offset-1 pull-right">
                                <div class="form-group">
                                        <button type="submit" name="search" value="search" class="btn btn-theme">
                                            <i class="fa fa-search">
                                          </i> Search
                                        </button>
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
                <table class="table table-boxed table-hover" style="font-size:14px;">
              <thead>
                   <tr>
                    <th colspan="4"><?php echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" disabled="disabled" ');?></th>
                    <th colspan="4"><?php echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" disabled="disabled" ');?></th>
                </tr>
                <tr>
         
                  <th colspan="2"><?php echo  form_input( array( 'disabled'          => 'disabled','value'         => $attendance_from,));?></th>
                  <th colspan="2"><?php echo  form_input( array( 'disabled'          => 'disabled','value'         => $attendance_to,));?></th>
                  <th colspan="2"><?php echo  form_input( array( 'disabled'          => 'disabled','value'         => $percentage_from));?></th>
                  <th colspan="2"><?php echo  form_input( array( 'disabled'          => 'disabled','value'         => $percentage_to));?></th>
                  
                </tr>
                <tr>
                  
                  <th>#</th>
                  <th>College #</th>
                  <th>Name</th>
                  <th>F-name</th>
                  <th>Attd(A + P = T)</th>
                  <th>Attd %</th>
                  <th>Marks %</th>
                  <th>Status</th>
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                      $defaulter = '';
                          if($resRow->Percentage >0):
                            if($resRow->Percentage <=75):
                              $defaulter = 'Defaulter';
                            endif;
                        
                          if($resRow->marks <=39):
                              $defaulter = 'Defaulter';
                          endif;
                             
                         else:
                             $defaulter = 'Defaulter';
                          endif;
                    ?>
                      <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $resRow->college_no; ?></td>
                                <td><?php echo $resRow->student_name; ?></td>
                                <td><?php echo $resRow->father_name; ?></td>
                                <td><?php echo $resRow->Total_Classes; ?></td>
                                <td><?php echo $resRow->Percentage; ?> %</td>
                                <td><?php echo $resRow->marks; ?> %</td>
                                <td><?php echo $defaulter; ?></td>
                                
                                
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
 
        <script>
        $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
    </script>
   <style>
      .datepicker{
          z-index: 1;
      }
  </style>  