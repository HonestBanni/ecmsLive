 

<style>

.report_header{
    display: none !important;
}
 
</style>

<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
//    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                <div class="col-md-2">
                                    <label for="name">Form#</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'form_no',
                                                'id'            => 'form_no',
                                                'value'         => $form_no,
                                                'placeholder'   => 'Enter Form No',
                                                'class'         => 'form-control',
                                                ));
                                         
                                         ?>
                                    </div>
                               <div class="col-md-2">
                                    <label for="name">Challan No</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'challan_no',
                                                'id'            => 'challan_no',
                                                'value'         => $challan_no,
                                                'placeholder'   => 'Enter Challan No',
                                                'class'         => 'form-control',
                                                ));
                                           
                                         ?>
                                    </div>
                                    
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">College #</label>
                                        
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'value'         => $collegeNo,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'College #',
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'stdName',
                                                                'type'          => 'text',
                                                                'value'         => $stdName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Father Name</label>
                                        
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $fatherName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                            
                                            
                                     </div>
                                    
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Section</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
                                        ?>
                                    </div>
                                </div> 
                                 
                                <div class="col-md-2">
                                    <label for="name">From</label>
                                    <div class="form-group ">
                                        <?php 
                                             echo  form_input(
                                                             array(
                                                                'name'          => 'from',
                                                                'type'          => 'text',
                                                                'value'         => $from,
                                                                'class'         => 'form-control datepicker',
                                                                
                                                                 )
                                                             );
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">To</label>
                                    <div class="form-group ">
                                        <?php 
                                                echo  form_input(
                                                        array(
                                                           'name'          => 'to',
                                                           'value'         => $to,
                                                           'class'         => 'form-control datepicker',

                                                            )
                                                             );?>
                                    </div>
                                </div> 
                                    <div class="col-md-2">
                                    <label for="name">Challan Status</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('challan_status', $challan_status,$status_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-8 pull-right">
                                     <button type="submit" class="btn btn-theme" name="refund_std_wise" id="refund_std_wise"  value="refund_std_wise" ><i class="fa fa-search"></i> Student Wise</button>
                                    <button type="submit" class="btn btn-theme" name="refund_head_wise" id="refund_head_wise"  value="refund_head_wise" ><i class="fa fa-search"></i> Student Head Wise</button>
                                    <button type="submit" class="btn btn-theme" name="refund_std_head_wise" id="refund_std_head_wise"  value="refund_std_head_wise" ><i class="fa fa-search"></i> Student Wise Head Wise</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
           
                             <?php
                             
                             
                   if(!empty($result)):  
                       
        ?>
                <div id="div_print">
                <div class="row">
                <div class="col-md-10 col-md-offset-1"> 
                    
                       <?php
                  // Student Wise Report
                  if($report_type == 'conce_std_wise'): ?>
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center">Fee Concession Report</h3>
                    </div>
                        <h4 class="text-highlight" style=" text-align: center"><?=$report_name?></h4>
                        <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                    <hr/>
                    <h4>Total Result :<?php echo count($result)?></h4>
                  <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Form#</th>
                                    <th>Challan#</th>
                                    <th>Collage#</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Challan Status</th>
                                    
                                     <th>Refund</th>
                                     <th>Payment Date</th>
                                     <th>Refund Date</th>
                                  
                                  
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
                             
                                  $sn = "";
                                  $grandTotal = '';
                                    foreach($result as $row):
                                    $sn++;
                                         
//                                    echo '<pre>';print_r($result);  
                                    echo '<tr>
                                            <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                            <td>'.$row->form_no.'</td>
                                            <td>'.$row->fc_challan_id.'</td>
                                            <td>'.$row->college_no.'</td>
                                            <td>'.$row->student_name.'</td>
                                            <td>'.$row->sub_program_name.'&nbsp;&nbsp;'.$row->sessionName.'&nbsp;&nbsp;'.$row->batch_name.'</td>';
                                
                                          $where['fc_student_id'] = $row->student_id;
                                       $cons =   $this->FeeModel->refund_std_wise($where); 
                                     
                                       
                                     
                                      echo '<td><button class="btn btn-warning btn-xs">'.$cons->fcs_title.'</button></td>
                                          <td>'.$cons->total_refund_amount.'</td>
                                              ';
                                   $grandTotal +=   $cons->total_refund_amount;
                                   echo '
                                   <td>'.date('d-m-Y',strtotime($row->fc_paiddate)).'</td>
                                   <td>'.date('d-m-Y',strtotime($row->refund_date)).'</td></tr>
                                 '
                                           ;
                                    endforeach;      
                                  
                                    ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Grand Total</td>
                                     
                                    <td><?=$grandTotal?></td>
                                     <td></td> <td></td>
                               
                                    
                                  

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                   <?php  endif; ?>
                  
                           <?php
                  // Student Wise Report
                  if($report_type == 'refund_head_wise'): ?>
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center">Fee Concession Report</h3>
                    </div>
                        <h4 class="text-highlight" style=" text-align: center"><?=$report_name?></h4>
                        <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                    <hr/>
                    <h4>Total Result :<?php echo count($result)?></h4>
                  <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fee Head#</th>
                                    <th>Refund Amount</th>
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  $grandTotal = '';
                                    foreach($result as $row):
                                    $sn++;
                                    echo '<tr>
                                          <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                      
                                          <td>'.$row->fh_head.'</td>
                                          <td >'.$row->total_refund.'</td>
                                        </tr>';
                                   
                                    $grandTotal +=   $row->total_refund;
                                    endforeach;      
                                    ?>

                                <tr class="info">
                                    
                                    <td></td>
                                    <td >Grand Total</td>
                                     
                                    <td><?=$grandTotal?></td>
                                  </tr>

                              </tbody>
                      </table>
                  </div> 
                   <?php  endif;
                   ?> 
                           <?php
                  // Student Wise Report
                  if($report_type == 'refund_std_head_wise'): ?>
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center">Fee Concession Report</h3>
                    </div>
                        <h4 class="text-highlight" style=" text-align: center"><?=$report_name?></h4>
                        <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                    <hr/>
                    <h4>Total Result :<?php echo count($result)?></h4>
                  <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fee Head#</th>
                                    <th>College No</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Refund Amount</th>
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  $grandTotal = '';
                                    foreach($result as $row):
                                    $sn++;
                                    echo '<tr>
                                          <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                      
                                          <td>'.$row->fh_head.'</td>
                                          <td ></td>
                                          <td ></td>
                                          <td ></td>
                                          <td ></td>
                                        </tr>';
                                    $sn1    = '';
                                    $total  = '';
                                    foreach($row->student_det as $stdDetails):
                                        
                                        if($stdDetails->refund_amount > 0):
                                        $sn1 ++;
                                            echo '<tr>
                                            <td ></td> 
                                            <td>'.$sn1.'&nbsp;&nbsp;&nbsp;</td>
                                                
                                            <td>'.$stdDetails->college_no.'</td>
                                            <td>'.$stdDetails->student_name.'</td>
                                            <td>'.$stdDetails->father_name.'</td>
                                            <td>'.$stdDetails->refund_amount.'</td>
                                            
                                        </tr>';  
                                        endif;
                                        
                                      $total += $stdDetails->refund_amount; 
                                    endforeach;
                                    echo '<tr>
                                        <td ></td> 
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td>Total : </td>
                                        <td>'.$total.'</td>

                                    </tr>';
                                    $grandTotal +=$total;
                                    endforeach;  
                                      echo '<tr>
                                        <td ></td> 
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td>Grand Total : </td>
                                        <td>'.$grandTotal.'</td>

                                    </tr>';
                                    ?>

                                

                              </tbody>
                      </table>
                  </div> 
                   <?php  endif;
                   ?> 
                    
                  
                </div>
                </div>
                      <?php echo $print_log;?>            
                                </div>
                <?php  endif ?>
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
   
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 5;
      }
  </style>     
  
 