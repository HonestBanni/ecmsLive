 

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
                                <div class="col-md-3">
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
                               <div class="col-md-3">
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
                                    
                                    <div class="col-md-3 col-sm-5">
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
                                <div class="col-md-3 col-sm-5">
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
                                <div class="col-md-3 col-sm-5">
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
                                    
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                    
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                        ?>
                                    
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                                        ?>
                                    
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Section</label>
                                    
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
                                        ?>
                                    
                                </div> 
                                 
                                <div class="col-md-3">
                                    <label for="name">From</label>
                                    
                                        <?php 
                                             echo  form_input(
                                                             array(
                                                                'name'          => 'from',
                                                                'autocomplete'  => 'off',
                                                                'type'          => 'text',
                                                                'value'         => $from,
                                                                'class'         => 'form-control datepicker',
                                                                
                                                                 )
                                                             );
                                        ?>
                                    
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">To</label>
                                    
                                        <?php 
                                                echo  form_input(
                                                        array(
                                                           'name'          => 'to',
                                                            'autocomplete'  => 'off',
                                                           'value'         => $to,
                                                           'class'         => 'form-control datepicker',

                                                            )
                                                             );?>
                                    
                                </div> 
                                    <div class="col-md-3">
                                    <label for="name">Challan Status</label>
                                    
                                        <?php 
                                            echo form_dropdown('hostel_head_type', $hostel_head_type,$hotel_type_id,  'class="form-control" ');
                                        ?>
                                    
                                </div>
                                    <div class="col-md-3">
                                    <label for="name">Batch</label>
                                    
                                        <?php 
                                            echo form_dropdown('batch', $batch,$batch_id,  'class="form-control" id="batch_id"');
                                        ?>
                                    
                                    
                                    </div>    
                                    <div class="col-md-6">
                                    <label for="name">Bank</label>
                                    
                                        <?php 
                                            echo form_dropdown('bank', $bank,$bank_id,  'class="form-control" id="batch_id"');
                                        ?>
                                    
                                    
                                    </div>    
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-9 pull-right">
                                    <button type="submit" class="btn btn-theme" name="hostel_std_wise" id="hostel_std_wise"  value="hostel_std_wise" ><i class="fa fa-book"></i>Student Wise</button>
                                    <button type="submit" class="btn btn-theme" name="hostel_date_wise" id="hostel_date_wise"  value="hostel_date_wise" ><i class="fa fa-book"></i>Date Wise</button>
                                    <button type="submit" class="btn btn-theme" name="hostel_head_wise" id="hostel_head_wise"  value="hostel_head_wise" ><i class="fa fa-book"></i>Group Wise Heads</button>
                                    <!--<button type="submit" class="btn btn-theme" name="hostel_head_student_wise" id="hostel_head_student_wise"  value="hostel_head_student_wise" ><i class="fa fa-book"></i>Group Wise Heads Report</button>-->
                                    <button type="submit" class="btn btn-theme" name="hostel_std_wise_group" id="hostel_std_wise_group"  value="hostel_std_wise_group" ><i class="fa fa-book"></i>Student Wise Heads</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                         </div>
                        
                    </section>
           
                             <?php
                             
                             
                   if(!empty($result)):  
                       
        ?>
                <div id="div_print">
                <div class="row">
                <div class="col-md-12"> 
                    
                       <?php
                  // Student Wise Report
                  if($report_type == 'hostel_std_wise'): ?>
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                       <h3 class="text-highlight" style=" text-align: center"><?php echo $report_head?> Fee Report</h3>
                    </div>
                        <h4 class="text-highlight" style=" text-align: center"><?php echo $report_name?></h4>
                        <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                        <?php
                        
                        if($bank_id):
                            
                        ?> <h5 style=" text-align: center">Account# : <?php echo $bank_name->account_no?></h5>
                        <?php
                        
                        endif;
                            
                        ?>
                       
                    <hr/>
                    <h4>Total Result :<?php echo count($result)?></h4>
                  <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Form#</th>
                                    
                                    <th>Collage#</th>
                                    <th>Student Name</th>
                                    <th>Bill Type</th>
                                    <th>Class</th>
                                    <th>Batch</th>
                                    <th>Hostel Status</th>
                                    <th>Challan#</th>
                                    <th>Paid Amount</th>
                                    <th>Paid Date</th>
                                  
                                  
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
 
                                  $sn = "";
                                  $grandTotal = '';
                                    foreach($result as $row):
                                         
                                    $sn++;
 
                                    echo '<tr">
                                            <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                            <td>'.$row->form_no.'</td>
                                            
                                            <td>'.$row->college_no.'</td>
                                            <td>'.$row->student_name.'</td>
                                            <td>'.$row->hotel_type.'</td>';
                                            echo '<td>'.$row->sub_program_name.'</td>';
                                            echo '<td>'.$row->batch_name.'</td>';
                                            echo '<td>'.$row->status_name.'</td>';
                                            echo '<td>'.$row->challan_id.'</td><td>'.number_format($row->paid_amount, 0, ',', ',').'</td>';
                                            echo '<td>'.date('d-m-Y',strtotime($row->payment_date)).'</td>
                                                  </tr>';
                                          $grandTotal +=$row->paid_amount;
                                          
                                          
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
                                      <td></td>
                                    <td><?php echo number_format($grandTotal, 0, ',', ',')?></td>
                                    
                               
                                    
                                  

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                   <?php  endif; ?>
                  
                           <?php
                  // Group wise  Heads wise Prport
                  if($report_type == 'hostel_date_wise'): ?>
                   
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center"><?php echo $report_head?> Fee Report</h3>
                    </div>
                        <h4 class="text-highlight" style=" text-align: center"><?php echo $report_name?></h4>
                        <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                        <?php
                        
                        if($bank_id):
                            
                        ?> <h5 style=" text-align: center">Account# : <?php echo $bank_name->account_no?></h5>
                        <?php
                        
                        endif;
                            
                        ?>
                    <hr/>
                    <h4>Total Result :<?php echo count($result)?></h4>
                  <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Amount</th>
                                    <th>Date </th>
                                     
                                  
                                  
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  
                                  $grand_total = '';
                                    foreach($result as $row):
                                    $sn++;
                                    echo '
                                        <tr>
                                            <td>'.$sn.'</td>
                                            
                                            <td>'.number_format($row->paid_amount, 0, ',', ',').'</td>
                                            <td>'.date('l, d-m-Y',strtotime($row->payment_date)).'</td>    
                                         
                                         
                                        </tr>';
                                   $grand_total +=$row->paid_amount;
                                    endforeach;      
                                    ?>

                                <tr class="info">
                                    
                                     <td>Grand Total</td>
                                    <td><?php echo number_format($grand_total, 0, ',', ',');?></td>
                                    <td></td>
                                </tr>

                              </tbody>
                      </table>
                  </div> 
                   <?php  endif; ?> 
                           <?php
                  // Group wise  Heads wise Prport
                  if($report_type == 'hostel_head_wise'): ?>
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center"><?php echo $report_head?> Fee Report</h3>
                    </div>
                        <h4 class="text-highlight" style=" text-align: center"><?php echo $report_name?></h4>
                        <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                        <?php
                        
                        if($bank_id):
                            
                        ?> <h5 style=" text-align: center">Account# : <?php echo $bank_name->account_no?></h5>
                        <?php
                        
                        endif;
                            
                        ?>
                    <hr/>
                    <h4>Total Result :<?php echo count($result)?></h4>
                  <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>Head</th>
                                     <th>Group</th>
                                    <th>Amount</th>
                                  
                                  
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  
                                   
                                  $program_wise_grand = '';
                                    foreach($result as $row):
                                       $sn++;
                                    echo '
                                        <tr>
                                            <td>'.$row->head_name.'</td>
                                           <td></td>
                                           <td></td>
                                        </tr>';
                                    
                                    $grand_total        = '';
                                   foreach($row->group as $row_group):
                                       
                               
                                        
                                        echo '<tr>
                                            <td></td>
                                            <td>'.$row_group->programe_name.'  '.$row_group->batch_name.'</td>
                                            <td>'.number_format($row_group->total_amount, 0, ',', ',').'</td>
                                            </tr>';
                              
                                       $grand_total         += $row_group->total_amount;
                                       $program_wise_grand  += $row_group->total_amount;
                                    endforeach;
                                    
                                       
                                    
                                    echo '<tr>
                                            <td></td>
                                            <td></td>
                                            <td>'.number_format($grand_total, 0, ',', ',').'</td>
                                            </tr>
                                          
                                        ';
                                    endforeach;      
                                    ?>

                                <tr class="info">
                                    <td></td>
                                     <td>Grand Total</td>
                                    <td><?php echo number_format($program_wise_grand, 0, ',', ',')?></td>
                                </tr>

                              </tbody>
                      </table>
                  </div> 
                   <?php  endif; ?> 
                           <?php
                  // Group wise  Heads wise Prport
                  if($report_type == 'hostel_std_wise_group'): ?>
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center"><?php echo $report_head?> Fee Report</h3>
                    </div>
                        <h4 class="text-highlight" style=" text-align: center"><?php echo $report_name?></h4>
                        <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                        <?php
                        
                        if($bank_id):
                            
                        ?> <h5 style=" text-align: center">Account# : <?php echo $bank_name->account_no?></h5>
                        <?php
                        
                        endif;
                            
                        ?>
                    <hr/>
                    <h4>Total Result :<?php echo count($result)?></h4>
                  <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>Head</th>
                                     <th>College No</th>
                                     <th>Name</th>
                                     <th>Father Name</th>
                                    <th>Batch</th>
                                     <th>Section</th>
                                    <th>Amount</th>
                                  
                                  
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  
                                   
                                  $program_wise_grand = '';
                                    foreach($result as $row):
                                       $sn++;
                                    echo '
                                        <tr>
                                            <td>'.$row->head_name.'</td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                        </tr>';
                                    
                                    $grand_total        = '';
                                   foreach($row->group as $row_group):
                                       
                               
                                        
                                        echo '<tr>
                                            <td></td>
                                            <td>'.$row_group->college_no.'</td>
                                            <td>'.$row_group->student_name.'</td>
                                            <td>'.$row_group->father_name.'</td>
                                            <td>'.$row_group->batch_name.'</td>
                                            <td>'.$row_group->name.'</td>
                                            <td>'.number_format($row_group->total_amount, 0, ',', ',').'</td>
                                            </tr>';
                              
                                       $grand_total         += $row_group->total_amount;
                                       $program_wise_grand  += $row_group->total_amount;
                                    endforeach;
                                    
                                       
                                    
                                    echo '<tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total</td>
                                            <td></td>
                                            <td>'.number_format($grand_total, 0, ',', ',').'</td>
                                            </tr>
                                          
                                        ';
                                    endforeach;      
                                    ?>

                                <tr class="info">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Grand Total</td>
                                    <td></td>
                                    <td><?php echo number_format($program_wise_grand, 0, ',', ',')?></td>
                                </tr>

                              </tbody>
                      </table>
                  </div> 
                   <?php  endif;
                    echo $print_log;
                   ?> 
                 
                    
                  
                </div>
                </div>
                                  
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
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 5;
      }
  </style>     
  
 