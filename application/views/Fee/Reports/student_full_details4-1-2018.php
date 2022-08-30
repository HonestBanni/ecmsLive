 

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
         
       <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button> 
       <a href="Clearence/<?php echo $studentInfo->student_id?>" target="_blank"><button type="button" name="print_clearance" value="print_clearance"  class="btn btn-theme"><i class="fa fa-print"></i> Print Clearance</button></a> 
        
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

                      </table>
                       
                    <br/>
                    <br/>
                    <p style="font-size: 20px; text-align: center; font-weight: bold;">COLLEGE FEE DETAILS</p>
                     
                          <?php
             if($fee_information):
//                  echo '<pre>';print_r($fee_information);
                        $total_actual= '';
                        $total_paid= '';
                        $total_balance= '';
                        $total_conssions= '';
                        $gFee_balance = 0;
               foreach($fee_information as $challan_info):
                 
                 ?> 
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                        <tr class="danger">
                                <td style="border: 1px solid #000000;">Challan No  :<strong><?php echo $challan_info->challan_id?></strong></td>
                                <td style="border: 1px solid #000000;">Challan      : <strong><?php echo $challan_info->challan_status?></strong></td>
                                <td style="border: 1px solid #000000;">Paid  :<strong><?php 
                                $paid_date = '';
                                if($challan_info->fc_paiddate == '0000-00-00'):
                                    $paid_date = '0';
                                    else:
                                        $paid_date = date('d-m-Y',strtotime($challan_info->fc_paiddate));
                                endif;
                                
                                echo $paid_date ?></strong></td>
                                <td style="border: 1px solid #000000;">From  :<strong><?php echo date('d-m-Y',strtotime($challan_info->fc_paid_form))?></strong></td>
                                <td style="border: 1px solid #000000;">To  :<strong><?php echo date('d-m-Y',strtotime($challan_info->fc_paid_upto))?></strong></td>
                                <td style="border: 1px solid #000000;">Issue Date :<strong><?php echo date('d-m-Y',strtotime($challan_info->fc_issue_date))?></strong></td>
                                
                            
                         </tr>
                        <tr class="danger">
                            <td colspan="2" style="border: 1px solid #000000;">Payment Cat:<strong><?php echo $challan_info->pc_name?></strong></td>
                            <td colspan="1" style="border: 1px solid #000000;">Credit Amount  :<strong><?php echo $challan_info->credit_amount?></strong></td>
                            <td colspan="1" style="border: 1px solid #000000;">Credit Status  :<strong><?php echo $challan_info->fine_title?></strong></td>
                            <td colspan="3" style="border: 1px solid #000000;">Challan Comments  :<strong><?php echo $challan_info->fc_comments?></strong></td>
                              
                            
                         </tr>
                    </table>
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                        <thead>
                            <tr class="danger">

                                <th>#</th>
                                <th>Heads</th>
                                <th>Actual</th>
                                <th>Arrears</th>
                                <th>Concession</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Head Comments</th>
                                
                            </tr>
                          </thead>
                        <?php
                        $sn         = '';
                        $actual     = '';
                        $paid       = '';
                        $gbalance    = '';
                        $balance    = '';
                        $conssions  = '';
                        $arrAmount  = '';
                        
                    foreach($challan_info->payment_details as $payment_info):
                            $sn++;
                             $chall_con_where  = array(
                                        'fee_concession_challan.challan_id'  => $challan_info->challan_id,    
                                         'fee_concession_detail.fh_id'       => $payment_info->fee_id,    
                                    );
                           
                                        $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id');
                  $challan_conssion =   $this->db->where($chall_con_where)->get('fee_concession_challan')->row();
//              
                  
                  $con_amount = '';
                  if($challan_conssion == ''):
                     $con_amount = '';
                 else:
                   $con_amount =   $challan_conssion->concession_amount;
                 endif;
                 $conssions += $con_amount;
                 
                 
                
                 
                        ?>
                        <tr class="danger">
                                
                                <td style="border: 1px solid #000000; width: 5%;"><strong><?php echo $sn?></strong></td>
                            
                                <td style="border: 1px solid #000000; width: 17%;"><strong><?php echo $payment_info->fh_head?></strong></td>
                                <td style="border: 1px solid #000000; width: 12%; "><strong><?php echo $payment_info->current_amount?></strong></td>
                                
                                <td style="border: 1px solid #000000; width: 12%;"><strong><?php echo $payment_info->arrears_amount?></strong></td>
                                <td style="border: 1px solid #000000; width: 12%;"><strong><?php echo $con_amount?></strong></td>
                                <td style="border: 1px solid #000000; width: 12%;"><strong><?php
                                $paidAmount = '';
                                
                                if($challan_info->ch_status_id == 2):
                                    echo $payment_info->paid_amount;
                                    $paidAmount += $payment_info->paid_amount;
                                    else:
                                        $paidAmount = 0;
                                    echo 0;
                                endif;
                                 $balance = $payment_info->actual_amount-$paidAmount - $con_amount;
                               ?></strong></td>
                                <td style="border: 1px solid #000000; width: 12%;"><strong><?php echo $balance?></strong></td>
                                <td style="border: 1px solid #000000;  width: 12%;"><strong><?php echo $payment_info->head_comments;?></strong></td>
                    </tr>
                        <?php
                        
                    
                        
                        if($payment_info->old_balance_pc_id == 0):
                            $actual += $payment_info->actual_amount; 
                        endif;
                        
                         
                          $paid += $paidAmount;
                          $gbalance+= $balance;
                          $arrAmount+= $payment_info->arrears_amount;
                        
                        endforeach;
                        
                      
                        
                        
                        ?>
                                <tr class="danger">
                                    <td style="border: 1px solid #000000;" colspan="2"><strong>Total</strong></td>
                                  
                                    <td style="border: 1px solid #000000; "><strong><?php echo $actual?></strong></td>
                                      <td style="border: 1px solid #000000;"><strong><?php echo $arrAmount?></strong></td>
                                    <td style="border: 1px solid #000000;"><strong><?php echo $conssions?></strong></td>
                                    <td style="border: 1px solid #000000;"><strong><?php echo $paid?></strong></td>
                                    <td style="border: 1px solid #000000;"><strong><?php
                                    
                                    if($challan_info->challan_id_lock == 0):
                                        $gFee_balance += $gbalance;
                                    endif;
                                    echo $gbalance;?></strong></td>
                                    <td style="border: 1px solid #000000;" colspan="1"></td>
                                </tr>
                        
                    </table>
                         <br/> 
                          <?php 
                            
                        $total_actual       += $actual;
                        $total_conssions    += $conssions;
                        $total_paid         += $paid;
                        $total_balance      += $balance;
                     endforeach;
             endif;
             ?>
                         <br/>
                      <?php
                           $grand_hostel_actual= 0;
                            $grand_hostel_paid      = 0;
                            $hostel_grand_total = '';
                        if($hostel_information):
                            
                             echo ' <p style="font-size: 20px; text-align: center; font-weight: bold;">HOSTEL FEE DETAILS</p>';
                            foreach($hostel_information as $hostel_row):
                         
                                $payment_date = '';
                                if($hostel_row->payment_date == '0000-00-00'):
                                    $payment_date = 'Not Paid';
                                    else:
                                    $payment_date = date('d-m-Y',strtotime($hostel_row->payment_date));
                                endif;
                        ?> 
                            <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                                <tr class="info">
                                       <td style="border: 1px solid #000000;">Challan: <strong><?php echo $hostel_row->hostel_bill_id?></strong></td>
                                       <td style="border: 1px solid #000000;">Hostel: <strong><?php echo $hostel_row->hostel_status?></strong></td>
                                       <td style="border: 1px solid #000000;">Challan: <strong><?php echo $hostel_row->challan_status?></strong></td>
                                       <td style="border: 1px solid #000000;">Paid Date: <strong><?php echo $payment_date?></strong></td>
                                       <td style="border: 1px solid #000000;">From       : <strong><?php echo date('d-m-Y',strtotime($hostel_row->date_from));?></strong></td>
                                       <td style="border: 1px solid #000000;">To       : <strong><?php echo date('d-m-Y',strtotime($hostel_row->date_to));?></strong></td>
                                       <td style="border: 1px solid #000000;">Issue Date       : <strong><?php echo date('d-m-Y',strtotime($hostel_row->issue_date));?></strong></td>
                                </tr>
                            </table>
                         
                       
                              <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                        <thead>
                            <tr class="info">
                                <th>#</th>
                                <th>Heads</th>
                                <th>Actual</th>
                                <th>Arrears</th>
                                <th>Concession Amount</th>
                                <th>Paid Amount</th>
                                <th>Balance</th>
                                <th>Comments</th>
                                
                            </tr>
                            
                            <?php
                            $sn = '';
                            $bill_total_actual  = '';
                            $hos_current_amt    = '';
                            $hos_arrears_amt    = '';
                            $bill_total_paid    = '';
                            
                            
                            $gBalance   = '';
                            $gPaid      = '';
                            $gBillPaid      = '';
                            foreach($hostel_row->bill_details as $bill_row):
                              
                             $sn++;
                            ?>
                            <tr class="info">
                                
                                <td style="border: 1px solid #000000; width: 5%;"><strong><?php echo  $sn?></strong></td>
                                <td style="border: 1px solid #000000;width: 17%;"><strong><?php echo $bill_row->title?></strong></td>
                                <td style="border: 1px solid #000000;width: 12%;"><strong><?php echo $bill_row->current_amt?></strong></td>
                                <td style="border: 1px solid #000000;width: 12%;"><strong><?php echo $bill_row->arrears_amt?></strong></td>
                                <td style="border: 1px solid #000000;width: 12%;"><strong><?php echo '0'; ?></strong></td>
                                <td style="border: 1px solid #000000;width: 12%;"><strong><?php echo $bill_row->paid_amount?></strong></td>
                                <td style="border: 1px solid #000000;width: 12%;"><strong><?php echo $bill_row->amount-$bill_row->paid_amount?></strong></td>
                                <td style="border: 1px solid #000000;width: 17%;"><strong></strong></td>
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
                                
                                <td style="border: 1px solid #000000;"><strong> </strong></td>
                                <td style="border: 1px solid #000000;"><strong>Total</strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $hos_current_amt?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $hos_arrears_amt?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo '0'; ?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_paid; ?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_actual-$bill_total_paid; ?></strong></td>
                                <td style="border: 1px solid #000000;"><strong></strong></td>
                            </tr>
                         </thead>
                         
                    </table>
                         <br/> 
                        
                        <?php
                           
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
                                        <td style="border: 1px solid #000000;">Challan No: <strong><?php echo $mess_row->hostel_bill_id?></strong></td>
                                       <td style="border: 1px solid #000000;">Challan: <strong><?php echo $mess_row->challan_status?></strong></td>
                                       <td style="border: 1px solid #000000;">Paid Date: <strong><?php echo $payment_date?></strong></td>
                                       <td style="border: 1px solid #000000;">Issue Date       : <strong><?php echo date('d-m-Y',strtotime($mess_row->issue_date));?></strong></td>
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
                                
                                <td style="border: 1px solid #000000; width: 5%;"><strong><?php echo  $sn?></strong></td>
                                <td style="border: 1px solid #000000;width: 17%;"><strong><?php echo $mess_bill_row->title?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $mess_bill_row->per_day?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $mess_bill_row->total_days?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $mess_bill_row->current_amt?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $mess_bill_row->arrears_amt?></strong></td>
                                 <td style="border: 1px solid #000000;"><strong></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $mess_bill_row->paid_amount?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $mess_bill_row->amount-$mess_bill_row->paid_amount?></strong></td>
                                 <td style="border: 1px solid #000000; width: 5%;"><strong></strong></td>
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
                                        <td><?php echo  $total_actual?></strong></td>
                                    </tr>
                                    <tr class="danger">
                                        <td>Concession</td>
                                        <td><?php echo $total_conssions; ?></td>
                                    </tr>
                                    <tr class="danger">
                                        <td>Paid</td>
                                        <td><?php echo  $total_paid ?></td>
                                    </tr>
                                    <tr class="danger">
                                        <td><strong class="red">Balance</strong></td>
                                        <td><strong><?php
                                        
                                        echo $gFee_balance;
                                        
                                        
//                                        $gBalance = $total_actual-$total_paid-$total_conssions;
//                                         echo '</br>'.$gBalance;
//                                        echo $total_balance 
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
                                        
                                        echo $hostel_grand_total;  ?></td>
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
                                        <td><strong><?php  echo $total_actual+$hostel_grand_total+$mess_g_total ?></strong></td>
                                    </tr>
                                     <tr class="info">
                                        <td><strong>Concession</strong></td>
                                        <td><strong><?php echo  $total_conssions  ?></strong></td>
                                    </tr>
                                    
                                     <tr class="info">
                                        <td><strong>Net Pay</strong></td>
                                        <td><strong><?php echo $total_paid +$grand_hostel_paid +$grand_mess_paid?></strong></td>
                                    </tr>
                                     <tr class="info">
                                        <td><strong>Paid</strong></td>
                                        <td><strong><?php    ?></strong></td>
                                    </tr>
                                     <tr class="info">
                                        <td><strong class="red">Balance</strong></td>
                                        <td><strong><?php echo $gFee_balance+$hoste_balance+$grand_mess_balance ?></strong></td>
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
 
   
   
     
 