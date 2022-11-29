

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
                                        <label for="name">Program</label>
                                        <div class="form-group ">
                                            <?php 
    //                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" ');
                                                echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Sub Program</label>
                                        <div class="form-group ">
                                            <?php 

                                                    echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
    //                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control"');
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">
                                        <label for="name">Section</label>
                                        <div class="form-group ">
                                            <?php 

                                                    echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
    //                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control"');
                                            ?>
                                        </div>
                                    </div> 
                              </div> 
                            <div class="row">
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">COA From</label>
                                        
                                         
                                                <?php
                                                    echo form_dropdown('fee_head_from', $fee_head_from,$fee_id_to,  'class="form-control"');
                                          
                                                      ?>
                                           
                                            
                                </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">COA To</label>
                                        
                                         
                                                <?php
                                                    echo form_dropdown('fee_head_to', $fee_head_to,$fee_id_from,  'class="form-control"');
                                          
                                                ?>
                                           
                                            
                                </div>
                            </div>
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-5 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="student_wise" id="student_wise"  value="student_wise" ><i class="fa fa-search"></i> Paid Amount</button>
                                    <button type="submit" class="btn btn-theme" name="fee_head" id="fee_head"  value="fee_head" ><i class="fa fa-search"></i> Paid Amount Head Wise</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                     
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
           
                             <?php
                             
                             
                   if(!empty($result)): 
//                       echo '<pre>';print_r($result);die;
        ?>
                <div id="div_print">
                <div class="row">
                <div class="col-md-12"> 
                    <div class="report_header">
                      <img style="float: right;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <!--<img style="float: right; position: absolute;    right: 25px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>-->
                      <!--<h3 class="text-highlight" style=" text-align: center">Paid Amount Result</h3>-->
                     
                    </div>
                 
                  
                      <h4 class="text-highlight" style=" text-align: center"><?php echo $report_name?></h4>
                       
                      <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                  <hr/>
                 
                                      
                  
                                       
                  <?php
                  // Student Wise Report
                  if($report_type == 'student_wise'):
            
                  
                  ?>
                  
                 
                  <div class="table-responsive">
                      <p class="text-highlight" style=" text-align: left"><strong>College Fee Details</strong></p>
                      
                      <table class="table table-hover" >
                              <thead>
                                <tr>
                                     
                                    
                                    <th>Sn#</th>
                                    <th>Program</th>
                                    <th>Paid Amount</th>
                                   
                                    </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                 
                                    
                                  $sn = "";
                                   $paid_amount = "";
                                  
                                    foreach($result->college_fee as $row):
                                      $sn++; 
                                    echo '
                                        <tr>
                                            <td>'.$sn.'</td>
                                            <td>'.$row->program_name.'</td>
                                            <td>'.number_format($row->paid_amount, 0, ',', ',').'</td>
                                              
                                        </tr>';
                                    
                                   $paid_amount            += $row->paid_amount;
                                    endforeach;    
                                    ?>

                                <tr>
                                    <td></td>
                                    <td><strong>Fee Total</strong></td>
                                    <td><strong><?php 
                                    
                                    if($paid_amount):
                                         echo number_format($paid_amount, 0, ',', ',');
                                        else:
                                        echo $paid_amount;
                                    endif;
                                   ?></strong></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="3">  <p class="text-highlight" style=" text-align: left"><strong>Hostel Fee Details</strong></p></td>
                                </tr>
                                
                                
                                <tr>
                                    <td></td>
                                    <td><strong>Hostel Total</strong></td>
                                    <td><strong><?php 
                                    
                                    if($result->hostel_fee):
                                        $hostel_amount = '';
                                        foreach($result->hostel_fee as $hf_row):
                                        
                                            
                                            $hostel_amount += $hf_row->hostel_amount; 
                                        endforeach;
                                        
                                    endif;
                                    
                                      echo number_format($hostel_amount, 0, ',', ',')
                                   
                                     
                                   ?></strong></td>
                                </tr>
                                  <tr>
                                    <td colspan="3">  <p class="text-highlight" style=" text-align: left"><strong>Mess Fee Details</strong></p></td>
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td><strong>Mess Total</strong></td>
                                    <td><strong><?php 
                                    
                                    if($result->mess_fee):
                                        $mess_amount = '';
                                        foreach($result->mess_fee as $hf_row):
                                        
                                            
                                            $mess_amount += $hf_row->mess_amount; 
                                        endforeach;
                                        
                                    endif;
                                    
                                    echo number_format($mess_amount, 0, ',', ',');
                                    
                                     
                                   ?></strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><strong>Grand Total</strong></td>
                                    <td><strong><?php 
                                    $grand_total = $paid_amount+$mess_amount+$hostel_amount;
                                    
                                    echo number_format($grand_total, 0, ',', ',');
                                    
                                     
                                     
                                   ?></strong></td>
                                </tr>
                            </tbody>
                      </table>
                  </div> 
                  
                    <?php
                  
                  endif;
                    if($report_type == 'date_wise'):
                    ?>
                    
                    <div class="table-responsive">
                        <div class="col-md-10 col-md-offset-1">
                            
                        
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Credit</th>
                                    
                                    
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  $grandTotal = '';
                                  $total_credit = '';
                                    foreach($result as $row):
                                    $sn++;
                                    echo '
                                        <tr">
                                          <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                          <td>'.date('d-m-Y', strtotime($row->challan_paid_date)).'</td>
                                          <td>'.number_format($row->total_sum, 0, ',', ',').'</td>
                                          <td>'.number_format($row->credit, 0, ',', ',').'</td>
                                        </tr>';
                                   $grandTotal  += $row->total_sum;
                                   $total_credit += $row->credit;
                                    endforeach;      
                                    ?>

                               
                                <tr>
                                    
                                    <td></td>
                                   
                                   
                                    <td> </td>
                                    <td><strong><?php echo number_format($grandTotal, 0, ',', ',')?></strong></td>
                                     <td><strong><?php echo number_format($total_credit, 0, ',', ',')?></strong></td>
                                    

                                </tr>
                                <tr>
                                    
                                    <td></td>
                                   
                                   
                                    <td><strong>Total</strong></td>
                                    
                                    <td colspan="2"><strong><?php echo number_format($grandTotal + $total_credit, 0, ',', ',')?></strong></td>
                                    

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                    </div>
                    <?php 
                    endif;
                    // Head Wise Section report 
                    if($report_type == 'head_wise'):
                    ?>
                    
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>Fee Head</th>
                                    <th></th>
                                    <th>Amount</th>
                                 </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  $grandTotal = '';
                                 
                                    foreach($result as $row):
                                        
                                       $where2['fee_heads.fh_Id'] = $row->fh_Id;
                                        
                                         
                                    $date = array(
                                            'from'=>$from,
                                            'to'=>$to,
                                        ); 
                                   
                                    
                                       
                                    $fee_amount = $this->FeeModel->fee_bank_reconcilition_head_wise_section($where2,$where_head,$date);  
                                     
                                    echo '
                                        <tr">
                                            <td>'.$row->fh_head.'</td>
                                            <td> </td>
                                            <td> </td>
                                        </tr>';
                                    $Total = '';
                                    foreach($fee_amount as $feeRow):
                                        
                                   
                                    echo '<tr">
                                          
                                          <td> </td>
                                          <td>'.$feeRow->programe_name.'&nbsp;&nbsp;'.$feeRow->sessionName.'&nbsp;&nbsp;'.$feeRow->batch_name.'</td>
                                          <td>'.$feeRow->paid_amount.'</td>
                                          
                                       </tr>';
                                    $Total +=$feeRow->paid_amount;
                                    endforeach;
                                    echo '   <tr>
                                    
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td><strong>'.number_format($Total, 0, ',', ',').'</strong></td>
                                    

                                </tr>';
                                    $grandTotal +=$Total;
                      
                                    endforeach;      
                                    ?>

                              <tr>
                                    
                                    <td></td>
                                    <td><strong>Total Credit </strong></td>
                                    <td><strong>
                                        <?php 
                                     
                                        $this->db->select('sum(fee_challan.fc_challan_credit_amount) as credit_amount');
                                        
//                                            $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
//                                            $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
//                                            $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  
                                            $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                                            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                                            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                                            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                                            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                                            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                                            $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
                                        
                                        
                                        
                                        
                                        $this->db->where('fee_challan.fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($from)).'" and "'.date('Y-m-d', strtotime($to)).'"');
                                        if($where):
                                            $this->db->where($where);
                                        endif;
                                        $this->db->group_by('fc_challan_id');
                                        $credit_amount =      $this->db->get('fee_challan')->result();
                                        
                                        
                                        
                                        $grandCredit = '';
                                        foreach($credit_amount as $CRrow):
                                            $grandCredit +=$CRrow->credit_amount;
                                        endforeach;
                                     
                                   
                                  echo  number_format($grandCredit, 0, ',', ',');
                                    ?></strong></td>
                                    

                                </tr>
                              <tr>
                                    
                                    <td></td>
                                    <td><strong>Grand Total</strong></td>
                                    <td><strong><?php echo number_format($grandTotal + $grandCredit, 0, ',', ',')?></strong></td>
                                    

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                    
                    <?php 
                    endif;
                    
                     if($report_type == 'head_wise_student'):
                    ?>
                    
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>Fee Head</th>
                                    <th>College No</th>
                                    <th>Student Name</th>
                                    <th>Group</th>
                                    <th>Amount</th>
                                 </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  $grandTotal = '';
                                    foreach($result as $row):
                                           $date = array(
                                            'from'=>$from,
                                            'to'=>$to,
                                        ); 
                                       
//                                        $where['student_record.student_id'] = $row->fc_student_id;
                                        
                                        
                                        $where['fee_heads.fh_Id'] = $row->fh_Id;
//                                        $where['fee_actual_challan_detail.fee_id']  = $fee_id;
                                       
                                    $fee_amount = $this->FeeModel->fee_bank_reconcilition_head_wise_student($where,$like,$date);  
                                    
                                      
                                  
                                    echo '
                                        <tr">
                                            <td>'.$row->fh_head.'</td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                        </tr>';
                                    $Total = '';
                                    foreach($fee_amount as $feeRow):
                                        
                                   
                                    echo '<tr">
                                          
                                          <td> </td>
                                           <td>'.$feeRow->college_no.'</td>
                                          <td>'.$feeRow->student_name.'</td>
                                          <td>'.$feeRow->sessionName.'&nbsp;&nbsp;'.$feeRow->batch_name.'</td>
                                          <td>'.$feeRow->paid_amount.'</td>
                                           
                                          
                                       </tr>';
                                    $Total +=$feeRow->paid_amount;
                                    endforeach;
                                    
                                    
                                    
                                    echo '   <tr>
                                    
                                    <td></td>
                                    <td> </td>
                                    <td> </td>
                                    <td><strong>Total</strong></td>
                                    <td><strong>'.number_format($Total, 0, ',', ',').'</strong></td>
                                    

                                </tr>';
                                    $grandTotal +=$Total;
                                    endforeach; 
                                    
                                    
                                    $fee_amount_credit = $this->FeeModel->fee_bank_reconcilition_head_wise_student_credit($where2,$like,$date);  
                                   
                                    ?>

                              <tr>
                                    
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total Credit </strong></td>
                                    <td><strong><?php echo number_format($fee_amount_credit->fc_challan_credit_amount, 0, ',', ',')?></strong></td>
                                    

                                </tr>
                              <tr>
                                    
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Grand Total</strong></td>
                                    <td><strong><?php echo number_format($grandTotal+$fee_amount_credit->fc_challan_credit_amount, 0, ',', ',')?></strong></td>
                                    

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                    
                    <?php 
                    endif;
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
  
 