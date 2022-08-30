 

<style>

.report_header{
    display: none !important;
}
.red{
font-weight: 900;
color:red;
}
 
</style>

<script language="javascript">
  function printdiv(printpage)
  {
   
//    var headstr = "<html><head><title></title></head><body>";
    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
                  <?php 
       echo form_open('Clearence',array('class'=>'course-finder-form'));
                                  
        ?>
                                    <div class="col-md-3 col-sm-5">
                                      <label for="name">Certificate for </label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'c_for',
                                                            'type'          => 'text',
                                                            'value'         => '',
                                                             'required'      => 'required',
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Certificate for..',
                                                             )
                                                         );
                                                  ?>
                                          </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                      <label for="name">Comments</label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'comments',
                                                            'type'          => 'text',
                                                            'value'         => '',
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Comments...',
                                                             )
                                                         );
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'student_id',
                                                            'type'          => 'hidden',
                                                            'value'         => $studentInfo->student_id,
                                                            'class'         => 'form-control',
                                                             
                                                             )
                                                         );
                                                  ?>
                                          </div>
                                    </div>
                    
                    
                     <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    
                                    <!--<button type="button" class="btn btn-theme"   id="printChallan"  value="printChallan" ><i class="fa fa-print"></i> Print</button>-->
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button> 
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-print"></i> Print Certificate</button>
                                    <!--<button type="reset" class="btn btn-theme"  id="save"> Reset</button>--> 
     
                                </div>
                            </div>
       
         <!--<button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-print"></i> Print Clearance</button>-->
       
        <?php
            echo form_close();
        ?>  
                 
                </div>
            </div>
         
            <hr/>
         
       <!--<a href="Clearence/<?php echo $studentInfo->student_id?>" target="_blank"><button type="button" name="print_clearance" value="print_clearance"  class="btn btn-theme"><i class="fa fa-print"></i> Print Clearance</button></a>--> 
        
       <div class="row">
          <div class="col-md-12">
               
              <div id="div_print">
                  
                  
                <div style="margin-top: 2px;width:100%;height:710px;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
               
                       <p style="font-size: 20px; text-align: center; font-weight: bold;">STUDENT INFORMATION</p>
                    <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                        <tr>
                          <td style="border: 1px solid #000000;">Student Name</td>
                          <td style="border: 1px solid #000000;"><strong><?php echo $studentInfo->student_name?></strong></td>
                          <td style="border: 1px solid #000000;">Father Name</td>
                          <td style="border: 1px solid #000000;"><strong><?php echo $studentInfo->father_name?></strong></td>
                         </tr>
                        <tr>
                          <td style="border: 1px solid #000000;">Form No</td>
                          <td style="border: 1px solid #000000;"><strong><?php echo $studentInfo->form_no?></strong></td>
                          <td style="border: 1px solid #000000;">College No</td>
                          <td style="border: 1px solid #000000;"><strong><?php echo $studentInfo->college_no?></strong></td>
                         </tr>
                         <tr>
                          <td style="border: 1px solid #000000;">Session</td>
                          <td style="border: 1px solid #000000;"><strong><?php echo $studentInfo->batch_name?></strong></td>
                          <td style="border: 1px solid #000000;">Group</td>
                          <td style="border: 1px solid #000000;"><strong><?php echo $studentInfo->sectionsName?></strong></td>

                        </tr>
                         <tr>
                          <td style="border: 1px solid #000000;">Program </td>
                          <td style="border: 1px solid #000000;"><strong><?php echo $studentInfo->programe_name?></strong></td>
                          <td style="border: 1px solid #000000;">Sub Program</td>
                          <td style="border: 1px solid #000000;"><strong><?php echo $studentInfo->sub_proram?></strong></td>

                        </tr>
                         <tr>
                          <td style="border: 1px solid #000000;">Student Status </td>
                          <td style="border: 1px solid #000000;"><strong><?php echo $studentInfo->studentStatus?></strong></td>
                          <td colspan="2" style="border: 1px solid #000000;"><strong>Comments:</strong> <?php echo $studentInfo->admission_comment?></td>
                          

                        </tr>
                         <tr>
                          <td style="border: 1px solid #000000;">Hostel Current Status </td>
                          <td style="border: 1px solid #000000;"><strong><?php 
                          
                                            $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
                          $hostel_status =  $this->db->get_where('hostel_student_record',array('student_id'=>$studentInfo->student_id))->row();
                          if($hostel_status):
                            echo $hostel_status->status_name;  
                          endif;
                          ?></strong></td>
                          <td colspan="2" style="border: 1px solid #000000;"><strong>Comments:</strong> <?php 
                           if($hostel_status):
                            echo $hostel_status->reason;  
                          endif;
                           ?></td>
                          

                        </tr>

                      </table>
                       
                    <br/>
                    <br/>
                    <p style="font-size: 20px; text-align: center; font-weight: bold;">COLLEGE FEE DETAILS</p>
                     
                          <?php
             if($fee_information):
                   
                $total_actual       = 0;
                $total_credit       = 0;
                $total_paid         = 0;
                $total_balance      = 0;    
                $total_conssions    = 0;    
               foreach($fee_information as $challan_info):
                 
                
                   
                   
                 ?>
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                            <tr class="danger">
                                
                                 <td colspan="1" style="border: 1px solid #000000; width: 11%;"><strong><?php echo $challan_info->installment_no?></strong></td>
                                
                                 <td style="border: 1px solid #000000; width: 10%;">From  :<strong><?php echo date('d-m-Y',strtotime($challan_info->fc_paid_form))?></strong></td>
                                <td style="border: 1px solid #000000; width: 10%;">To  :<strong><?php echo date('d-m-Y',strtotime($challan_info->fc_paid_upto))?></strong></td>
                                <td style="border: 1px solid #000000; width: 7%;">Challan No  :<strong><?php echo $challan_info->challan_id?></strong></td>
                                
                                <td style="border: 1px solid #000000; width: 7%;">Status : <strong><?php echo $challan_info->challan_status?></strong></td>
                                <td style="border: 1px solid #000000; width: 7%;">Paid  :<strong><?php 
                                $paid_date = '';
                                if($challan_info->fc_paiddate == '0000-00-00'):
                                    $paid_date = '';
                                    else:
                                        $paid_date = date('d-m-Y',strtotime($challan_info->fc_paiddate));
                                endif;
                                
                                echo $paid_date ?></strong></td>
                                <td style="border: 1px solid #000000; width: 8;">Issue :<strong><?php echo date('d-m-Y',strtotime($challan_info->fc_issue_date))?></strong></td>
                                <td style="border: 1px solid #000000; width: 10%;"><strong>Remarks</strong></td>
                                
                            
                         </tr>
                   
                            <tr class="danger">

                                <th style="border: 1px solid #000000; width: 11%;">Heads</th>
                                <th style="border: 1px solid #000000; width: 10%;">Current Amount</th>
                                <th style="border: 1px solid #000000; width: 10%;">Credit</th>
                                <th style="border: 1px solid #000000; width: 7%;">Arrears</th>
                                <th style="border: 1px solid #000000; width: 7%;">Concession</th>
                                <th style="border: 1px solid #000000; width: 7%;">Paid</th>
                                <th style="border: 1px solid #000000; width: 7%;">Balance</th>
                                <th style="border: 1px solid #000000; width: 10%;"></th>
                                
                            </tr>
                    
                        <?php
                        
                        $sn='';
                        $actual_amount = '';
                        $credit_amount = '';
                        $current_amount = '';
                        $arrears_amount = '';
                        $concession_amount = '';
                        $paid_amount = '';
                        $balance_amount = '';
                        if(!empty($challan_info->payment_details)):
                            
                       
                    foreach($challan_info->payment_details as $payment_info):
                        $sn++;
                       ?>
                        <tr class="danger">
                                
                                <td style="border: 1px solid #000000; width: 11%;"><?php echo $payment_info->Fee_heads?></td>
                                <td style="border: 1px solid #000000; width: 10%; "><?php echo $payment_info->Current_Amount?></td>
                                <td style="border: 1px solid #000000; width: 10%; "><?php echo $payment_info->Credit_Amount?></td>
                                <td style="border: 1px solid #000000; width: 7%;"><?php echo $payment_info->Arrears_Amount?></td>
                                <td style="border: 1px solid #000000; width: 7%;"><?php echo $payment_info->Concession?></td>
                                <td style="border: 1px solid #000000; width: 7%;"><?php echo $payment_info->Paid_Amount?></td>
                                <td style="border: 1px solid #000000; width: 7%;"><?php echo $payment_info->Balance?></td>
                                <td style="border: 1px solid #000000;  width: 10%;"><?php echo $payment_info->head_comments;?>  </td>
                        </tr>
                        <?php
                        
                        $actual_amount          += $payment_info->Actual_Amount;
                        $credit_amount          += $payment_info->Credit_Amount;
                        $current_amount         += $payment_info->Current_Amount;
                        $arrears_amount         += $payment_info->Arrears_Amount;
                        $concession_amount      += $payment_info->Concession;
                        $paid_amount            += $payment_info->Paid_Amount;
                        $balance_amount         += $payment_info->Balance;
                        
                        
                        
                        
                         
                        $total_actual       += $payment_info->Current_Amount;
                        $total_credit       += $payment_info->Credit_Amount;
                        $total_paid         += $payment_info->Paid_Amount;
                        $total_balance      += $payment_info->Current_Amount-$payment_info->Paid_Amount-$payment_info->Concession - $payment_info->Credit_Amount;
                        $total_conssions    += $payment_info->Concession;
                        
                        endforeach;
                         endif;
                          ?>
                        <tr class="danger">
                                <td style="border: 1px solid #000000; width: 11%;"><strong>Total</strong></td>
                                <td style="border: 1px solid #000000; width: 10%; "><strong><?php echo $current_amount?></strong></td>
                                <td style="border: 1px solid #000000; width: 10%; "><strong><?php echo $credit_amount?></strong></td>
                                <td style="border: 1px solid #000000; width: 7%;"><strong><?php echo $arrears_amount?></strong></td>
                                <td style="border: 1px solid #000000; width: 7%;"><strong><?php echo $concession_amount?></strong></td>
                                <td style="border: 1px solid #000000; width: 7%;"><strong><?php echo $paid_amount?> </strong></td>
                                <td style="border: 1px solid #000000; width: 7%;"><strong><?php echo $balance_amount?></strong></td>
                                <td style="border: 1px solid #000000;  width: 10%;"><strong></strong></td>
                        </tr>
                        <tr class="danger">
                           
                            <td colspan="1" style="border: 1px solid #000000; width: 11%;">Credit Amount  :<strong><?php echo $challan_info->credit_amount?></strong></td>
                            <td colspan="1" style="border: 1px solid #000000; width: 10%;">Credit Status  :<strong><?php echo $challan_info->fine_title?></strong></td>
                            
                            <td colspan="1" style="border: 1px solid #000000; width: 10%;">GROUP:<strong><?php 
                            
                            $section_name = $this->db->get_where('sections',array('sec_id'=>$challan_info->section_id))->row();
                            if(!empty($section_name)):
                               echo $section_name->name; 
                            endif;
                            ?></strong></td>
                            <td colspan="1" style="border: 1px solid #000000; width: 7%;"><strong></strong></td>
                            <td colspan="1" style="border: 1px solid #000000; width: 7%;"><strong></strong></td>
                            <td colspan="1" style="border: 1px solid #000000; width: 7%;"><strong></strong></td>
                            <td colspan="1" style="border: 1px solid #000000; width: 7%;"><strong></strong></td>
                            <td colspan="1" style="border: 1px solid #000000; width: 10%;"><strong></strong></td>
                            
                        </tr>
                        <tr class="danger">
                            <td colspan="8" style="border: 1px solid #000000;">Challan Comments  :<strong><?php echo $challan_info->fc_comments?></strong></td>
                        </tr>
                                 
                        
                    </table>
                         <br/> 
                          <?php 
                         
                     endforeach;
             endif;
             ?>
                         <br/>
                      <?php
                           $grand_hostel_actual     = 0;
                            $grand_hostel_paid      = 0;
                            $hostel_grand_total     = '';
                        if($hostel_information):
                            
                             echo ' <p style="font-size: 20px; text-align: center; font-weight: bold;">HOSTEL FEE DETAILS</p>';
                            foreach($hostel_information as $hostel_row):
                         
                                $payment_date = '';
                                if($hostel_row->payment_date == '0000-00-00'):
                                    $payment_date = '';
                                    else:
                                    $payment_date = date('d-m-Y',strtotime($hostel_row->payment_date));
                                endif;
                        ?> 
                            <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                                <tr class="info">
                                    <td style="border: 1px solid #000000; width: 11%">Hostel: <strong><?php echo $hostel_row->hostel_status?></strong></td>
                                        <td style="border: 1px solid #000000; width: 10%">From : <strong><?php echo date('d-m-Y',strtotime($hostel_row->date_from));?></strong></td>
                                       <td style="border: 1px solid #000000; width: 10%;">To: <strong><?php echo date('d-m-Y',strtotime($hostel_row->date_to));?></strong></td>
                                      
                                       <td style="border: 1px solid #000000; width: 7%;">Challan: <strong><?php echo $hostel_row->hostel_bill_id?></strong></td>
                                       
                                       <td style="border: 1px solid #000000; width: 7%">Challan: <strong><?php echo $hostel_row->challan_status?></strong></td>
                                       <td style="border: 1px solid #000000; width: 7%">Paid: <strong><?php echo $payment_date?></strong></td>
                                       <td style="border: 1px solid #000000; width: 7%">Issue : <strong><?php echo date('d-m-Y',strtotime($hostel_row->issue_date));?></strong></td>
                                       <td style="border: 1px solid #000000; width: 10%"><strong>Remarks:</strong></td>
                                </tr>
                       
                     
                            <tr class="info">
                               
                                <th style="border: 1px solid #000000;width: 11%;">Heads</th>
                                <th style="border: 1px solid #000000;width: 10%;">Actual</th>
                                <th style="border: 1px solid #000000;width: 10%;">Arrears</th>
                                <th style="border: 1px solid #000000;width: 7%;"Concession Amount</th>
                                <th style="border: 1px solid #000000;width: 7%;">Paid Amount</th>
                                <th style="border: 1px solid #000000;width: 7%;">Balance</th>
                                <th colspan="2" style="border: 1px solid #000000;width: 10%;"></th>
                                
                            </tr>
                            
                            <?php
                            
                            $bill_total_actual  = '';
                            $hos_current_amt    = '';
                            $hos_arrears_amt    = '';
                            $bill_total_paid    = '';
                            
                            
                            $gBalance   = '';
                            $gPaid      = '';
                            $gBillPaid      = '';
                            $sn = '';
                            
                            if($hostel_row->bill_details):
                                
                           
                            foreach($hostel_row->bill_details as $bill_row):
                              $sn++;
                            ?>
                            <tr class="info">
                                
                                
                                <td style="border: 1px solid #000000;width: 11%;"><?php echo $bill_row->title?></td>
                                <td style="border: 1px solid #000000;width: 10%;"><?php echo $bill_row->current_amt?></td>
                                <td style="border: 1px solid #000000;width: 10%;"><?php echo $bill_row->arrears_amt?></td>
                                <td style="border: 1px solid #000000;width: 7%;"><?php echo '0'; ?></td>
                                <td style="border: 1px solid #000000;width: 7%;"><?php echo $bill_row->paid_amount?></td>
                                <td style="border: 1px solid #000000;width: 7%;"><?php echo $bill_row->amount-$bill_row->paid_amount?></td>
                                <td colspan="2" style="border: 1px solid #000000;width: 10%;"><?php echo $bill_row->head_comments?></td>
                               
                            </tr>
                             
                         
                          <?php
                            $hos_current_amt    += $bill_row->current_amt;
                            $hos_arrears_amt    += $bill_row->arrears_amt;
                           
                            $bill_total_actual  += $bill_row->amount;
                            $bill_total_paid    += $bill_row->paid_amount;
                             
                            $gBalance           += $bill_row->balance;
                           
                            if($hostel_row->challan_status_id == 2):
                            $gPaid              += $bill_row->paid_amount;  
                            endif;
                            endforeach;
                                   $gBillPaid += $gBalance+$gPaid;
                                    
                            ?>
                            
                            <tr class="info">
                                
                                
                                <td style="border: 1px solid #000000; width: 11%"><strong>Total</strong></td>
                                <td style="border: 1px solid #000000; width: 10%"><strong><?php echo $hos_current_amt?></strong></td>
                                <td style="border: 1px solid #000000; width: 10%"><strong><?php echo $hos_arrears_amt?></strong></td>
                                <td style="border: 1px solid #000000; width: 7%"><strong><?php echo '0'; ?></strong></td>
                                <td style="border: 1px solid #000000; width: 7%"><strong><?php echo $bill_total_paid; ?></strong></td>
                                <td style="border: 1px solid #000000; width: 7%"><strong><?php echo $bill_total_actual-$bill_total_paid; ?></strong></td>
                                <td colspan="2" style="border: 1px solid #000000; width: 1%" ><strong></strong></td>
                            </tr>
                               <tr class="info">
                                    <td   colspan="8" style="border: 1px solid #000000;">Comments: <strong><?php echo $hostel_row->hostel_comments?></strong></td>
                                   </tr>
                         </thead>
                         
                    </table>
                         <br/> 
                        
                        <?php
                           endif; 
                            $grand_hostel_actual    += $bill_total_actual;
                            $grand_hostel_paid      += $bill_total_paid;
                            $hostel_grand_total     += $gBillPaid;
                            endforeach;
                            
                            
                        endif;
                        ?> 
                        
                    <br/>
                    <br/>
                   

                    <?php
                            $grand_mess_actual  = 0;
                            $grand_mess_paid    = 0;
                            $grand_mess_balance    = 0;
                        if($mess_information):
//                            echo '<pre>';print_r($mess_information);die;
                            echo '<p style="font-size: 20px; text-align: center; font-weight: bold;">MESS FEE DETAILS</p>';
                            foreach($mess_information as $mess_row):
                         
                                $payment_date = '';
                                if($mess_row->payment_date == '0000-00-00'):
                                    $payment_date = 'Not Paid';
                                    else:
                                    $payment_date = date('d-m-Y',strtotime($mess_row->payment_date));
                                endif;
                            
                            
                        ?> 
         
                            <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                                <tr class="warning">
                                        <td style="border: 1px solid #000000; width: 11%">Mess: <strong><?php echo $mess_row->mess_status?></strong></td>
                                        <td style="border: 1px solid #000000;">Challan No: <strong><?php echo $mess_row->hostel_bill_id?></strong></td>
                                       <td style="border: 1px solid #000000;">Challan: <strong><?php echo $mess_row->challan_status?></strong></td>
                                       <td style="border: 1px solid #000000;">Paid Date: <strong><?php echo $payment_date?></strong></td>
                                       <td style="border: 1px solid #000000;">From: <strong><?php echo date('d-m-Y',strtotime($mess_row->date_from))?></strong></td>
                                       <td style="border: 1px solid #000000;">To: <strong><?php echo date('d-m-Y',strtotime($mess_row->date_to))?></strong></td>
                                       <td style="border: 1px solid #000000;">Issue Date       : <strong><?php echo date('d-m-Y',strtotime($mess_row->issue_date));?></strong></td>
                                </tr>
                                <tr class="warning">
                                <td  style="border: 1px solid #000000;">Comments: </td>
                                <td colspan="6" style="border: 1px solid #000000;"><strong><?php echo $mess_row->mess_comments?></strong></td>
                               </tr>
                            </table>
                        
                              <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                        <thead>
                            <tr class="warning">
                                
                                

                                <th>#</th>
                                <th>Heads</th>
                                <th>Per Day</th>
                                <th>Total Days</th>
                                <th>Actual</th>
                                <th>Arrears</th>
                                <th>Concession</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Comments</th>
                                
                            </tr>
                            
                            <?php
                            $sn = '';
                            $bill_total_current     = '';
                            $bill_total_arrears     = '';
                            $bill_total_actual      = '';
                            $bill_total_paid        = '';
                            $bill_total_balance     = '';
//                            echo '<pre>';print_r($mess_row);die;
                            foreach($mess_row->bill_details as $mess_bill_row):
                             $sn++;
                            ?>
                            <tr class="warning">
                                
                                <td style="border: 1px solid #000000; width: 5%;"><?php echo  $sn?></td>
                                <td style="border: 1px solid #000000;width: 17%;"><?php echo $mess_bill_row->title?></td>
                                <td style="border: 1px solid #000000;"><?php echo $mess_bill_row->per_day?></td>
                                <td style="border: 1px solid #000000;"><?php echo $mess_bill_row->total_days?></td>
                                <td style="border: 1px solid #000000;"><?php echo $mess_bill_row->current_amt?></td>
                                <td style="border: 1px solid #000000;"><?php echo $mess_bill_row->arrears_amt?></td>
                                 <td style="border: 1px solid #000000;">0</td>
                                <td style="border: 1px solid #000000;"><?php echo $mess_bill_row->paid_amount?></td>
                                <td style="border: 1px solid #000000;"><?php echo $mess_bill_row->amount-$mess_bill_row->paid_amount?></td>
                                 <td style="border: 1px solid #000000; width: 5%;"><?php echo $mess_bill_row->head_comments?></td>
                            </tr>
                         
                          <?php
                           $bill_total_current   += $mess_bill_row->current_amt;
                           $bill_total_actual    += $mess_bill_row->amount;
                           $bill_total_arrears   += $mess_bill_row->arrears_amt;
                           $bill_total_paid      += $mess_bill_row->paid_amount;
                           $bill_total_balance   += $mess_bill_row->balance;
                                
                            endforeach;
                            ?>
                            
                            <tr class="warning">
                                
                                
                                <td style="border: 1px solid #000000;" colspan="3"><strong></strong></td>
                                <td style="border: 1px solid #000000;"><strong>Total</strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_current?></strong></td>
                                 <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_arrears?></strong></td>
                                <td style="border: 1px solid #000000;"><strong></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_paid?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_actual-$bill_total_paid?></strong></td>
                                 <td style="border: 1px solid #000000;"><strong></strong></td>
                            </tr>
                         </thead>
                         
                    </table>
                        
                       <br/> 
                        <?php
                            $grand_mess_actual += $bill_total_actual;
                            $grand_mess_paid += $bill_total_paid;
                            $grand_mess_balance += $bill_total_balance;
                            
                            endforeach;
                        endif;
                  
                        
                        
                        ?> 
                     
                        
                        <p style="font-size: 15px; padding-right:25%; text-align: left; font-weight: bold;" class="red" >SUMMERY DETAILS</p>
                 
                                <table class="table table-hover"   id="table" style="margin-bottom: 5px;font-size: 12px;width: 60%;float: left;border: 1px solid;">
                                     <tr class="danger">
                                        <td><strong class="red">FEE DETAILS</strong></td>
                                        <td><strong></strong></td>
                                    </tr>
                                    
                                    <tr class="danger">
                                        <td>Total</td>
                                        <td><?php  
                                        if(@$total_actual):
                                            echo  $total_actual;
                                        else:
                                            echo 0;
                                        endif;
                                        
                                      ?></strong></td>
                                    </tr>
                                    <tr class="danger">
                                        <td>Concession</td>
                                        <td><?php echo @$total_conssions; ?></td>
                                    </tr>
                                    <tr class="danger">
                                        <td>Paid</td>
                                        <td><?php echo  @$total_paid ?></td>
                                    </tr>
                                    <tr class="danger">
                                        <td>Credit Amount</td>
                                        <td><?php echo  @$total_credit ?></td>
                                    </tr>
                                    <tr class="danger">
                                        <td><strong class="red">Balance</strong></td>
                                        <td><strong><?php
                                        
                                        echo @$total_balance;
       
                                                ?></strong></td>
                                    </tr>
                                   
                                    <tr>
                                        <td><strong>&nbsp;</strong></td>
                                        <td><strong>&nbsp;</strong></td>
                                    </tr>
                                    
                                    <tr class="info">
                                        <td><strong class="red">HOSTEL DETAILS</strong></td>
                                        <td><strong></strong></td>
                                    </tr>
                                    <tr class="info">
                                        <td>Total</td>
                                        <td><?php 
                                        
                                        echo @$hostel_grand_total;  ?></td>
                                    </tr>
                                      <tr class="info">
                                        <td>Paid</td>
                                        <td><?php 
                                        
                                         echo $grand_hostel_paid?></td>
                                    </tr>
                                      <tr class="info">
                                        <td><strong class="red">Balance</strong></td>
                                        <td><strong><?php 
                                        
                                         $hoste_balance = $hostel_grand_total-$grand_hostel_paid;
                                        echo  $hoste_balance; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>&nbsp;</strong></td>
                                        <td><strong>&nbsp;</strong></td>
                                    </tr>
                                    
                                    <tr class="warning">
                                        <td><strong class="red">MESS DETAILS</strong></td>
                                        <td><strong></strong></td>
                                    </tr>
                                    <tr class="warning">
                                        <td>Mess</td>
                                        <td><?php  
                                        $mess_g_total = $grand_mess_paid+$grand_mess_balance; 
                                        echo $mess_g_total;?></td>
                                    </tr>
                                      <tr class="warning">
                                        <td>Paid</td>
                                        <td><strong><?php    echo $grand_mess_paid?></strong></td>
                                    </tr >
                                      <tr class="warning">
                                        <td><strong class="red">Balance</strong></td>
                                        <td><strong><?php 
                                         echo $grand_mess_balance; ?></strong></td>
                                    </tr>
                                    
                                    
                                     <tr>
                                        <td><strong>&nbsp;</strong></td>
                                        <td><strong>&nbsp;</strong></td>
                                    </tr>
                                    <tr class="info">
                                        <td><strong class="red">GRAND TOTAL INFORMATION</strong></td>
                                        <td><strong></strong></td>
                                    </tr>
                                    
                                     <tr class="info">
                                        <td><strong>Total Payable </strong></td>
                                        <td><strong><?php  echo @$total_actual+$hostel_grand_total+$mess_g_total ?></strong></td>
                                    </tr>
                                     <tr class="info">
                                        <td><strong>Concession</strong></td>
                                        <td><strong><?php echo  @$total_conssions  ?></strong></td>
                                    </tr>
                                    
                                     <tr class="info">
                                        <td><strong>Net Pay</strong></td>
                                        <td><strong><?php echo @$total_paid +$grand_hostel_paid +$grand_mess_paid?></strong></td>
                                    </tr>
                                     <tr class="info">
                                        <td><strong>Total Credit Adjust</strong></td>
                                        <td><strong><?php echo   @$total_credit  ?></strong></td>
                                    </tr>
                                     <tr class="info">
                                        <td><strong class="red">Balance</strong></td>
                                        <td><strong><?php echo @$total_balance+$hoste_balance+$grand_mess_balance ?></strong></td>
                                    </tr>
                                    
                                    
                               </table> 
                         
                               
                      
                     
                        
                       
                </div>
                   
                </div>
          
                    </div>
            </div>
 
          </div>
          
      
      </div>
                
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
   
     
 