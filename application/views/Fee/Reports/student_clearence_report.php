 

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

           <div class="row">
                <div class="col-md-12">
                    <div style="margin-top: 2px;width:100%;height:710px;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
                         <div id="div_print">
                        

                                  <?php
                                  error_reporting(0);
                      if($fee_information):
                   
                $total_actual       = '';
                $total_paid         = '';
                $total_balance      = '';    
                $total_conssions    = '';    
               foreach($fee_information as $challan_info):
                 
                  
                        
                        
                        $actual_amount = '';
                        $credit_amount = '';
                        $current_amount = '';
                        $arrears_amount = '';
                        $concession_amount = '';
                        $paid_amount = '';
                        $balance_amount = '';
                     
                            
                  
                    foreach($challan_info->payment_details as $payment_info):
                         
                         if($payment_info->delete_head == 0):
                             
                             else:
                        $actual_amount          += $payment_info->Actual_Amount;
                        $credit_amount          += $payment_info->Credit_Amount;
                        $current_amount         += $payment_info->Current_Amount;
                        $arrears_amount         += $payment_info->Arrears_Amount;
                        $concession_amount      += $payment_info->Concession;
                        $paid_amount            += $payment_info->Paid_Amount;
                        $balance_amount         += $payment_info->Balance;
                          
                        $total_actual           += $payment_info->Current_Amount;
                        $total_paid             += $payment_info->Paid_Amount;
                        $total_balance          += $payment_info->Current_Amount-$payment_info->Paid_Amount-$payment_info->Concession;
                        $total_conssions        += $payment_info->Concession;
                         endif;
                        
                        
                    
                        
                        endforeach;
                               
                         
                     endforeach;
             endif;
                     
                                   $grand_hostel_actual= 0;
                                    $grand_hostel_paid      = 0;
                                    $hostel_grand_total = '';
                                if($hostel_information):
 
                                    foreach($hostel_information as $hostel_row):

                                        $payment_date = '';
                                        if($hostel_row->payment_date == '0000-00-00'):
                                            $payment_date = 'Not Paid';
                                            else:
                                            $payment_date = date('d-m-Y',strtotime($hostel_row->payment_date));
                                        endif;
                                
                                    $sn = '';
                                    $bill_total_actual  = '';
                                    $hos_current_amt    = '';
                                    $hos_arrears_amt    = '';
                                    $bill_total_paid    = '';


                                    $gBalance   = '';
                                    $gPaid      = '';
                                    $gBillPaid      = '';
                                    if($hostel_row->bill_details):
                                       foreach($hostel_row->bill_details as $bill_row):

                                     $sn++;
                                     
                                    $hos_current_amt    += $bill_row->current_amt;
                                    $hos_arrears_amt    += $bill_row->arrears_amt;

                                    $bill_total_actual  += $bill_row->amount;
                                    $bill_total_paid    += $bill_row->paid_amount;

                                    $gBalance           += $bill_row->balance;

                                    if($hostel_row->challan_status_id == 2):
                                    $gPaid              += $bill_row->paid_amount;  
                                    endif;
                                    endforeach;  
                                    endif;
                                   
                                        $gBillPaid += $gBalance+$gPaid;

                                    

                                    $grand_hostel_actual    += $bill_total_actual;
                                    $grand_hostel_paid      += $bill_total_paid;
                                    $hostel_grand_total     += $gBillPaid;
                                    endforeach;


                                endif;
                                 
                                    $grand_mess_actual  = 0;
                                    $grand_mess_paid    = 0;
                                    $grand_mess_balance    = 0;
                                if($mess_information):

                                    
                                    foreach($mess_information as $mess_row):

                                        $payment_date = '';
                                        if($mess_row->payment_date == '0000-00-00'):
                                            $payment_date = 'Not Paid';
                                            else:
                                            $payment_date = date('d-m-Y',strtotime($mess_row->payment_date));
                                        endif;

 
                                    $sn = '';
                                    $bill_total_current     = '';
                                    $bill_total_arrears     = '';
                                    $bill_total_actual      = '';
                                    $bill_total_paid        = '';
                                    $bill_total_balance     = '';
        //                            echo '<pre>';print_r($mess_row);die;
                                    foreach($mess_row->bill_details as $mess_bill_row):
                                     $sn++;
                                     
                                   $bill_total_current   += $mess_bill_row->current_amt;
                                   $bill_total_actual    += $mess_bill_row->amount;
                                   $bill_total_arrears   += $mess_bill_row->arrears_amt;
                                   $bill_total_paid      += $mess_bill_row->paid_amount;
                                   $bill_total_balance   += $mess_bill_row->balance;

                                    endforeach;
                                    
                                    $grand_mess_actual += $bill_total_actual;
                                    $grand_mess_paid += $bill_total_paid;
                                    $grand_mess_balance += $bill_total_balance;

                                    endforeach;
                                endif;
                                
                                
                                                 $hoste_balance = $hostel_grand_total-$grand_hostel_paid;
                                                 $mess_g_total = $grand_mess_paid+$grand_mess_balance; 
                                ?> 

 
   <p style="font-size: 20px; text-align: center; font-weight: bold;">DUES CLEARANCE CERTIFICATE</p>
                       <p style="font-size: 16px; text-align: center; font-weight: bold;">Provisional</p>
                    <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 16px; border:1px solid #000000">
                        <tr>
                          
                            <td colspan="2" style="border:1px solid #000"><strong>Clearance for : </strong><?php echo $c_for?></td>
                            <td colspan="2" style="border:1px solid #000"><strong>Issue Date :</strong><?php echo date('d-M-Y')?></td>
                         </tr>
                        <tr>
                          
                            <td colspan="2" style="border:1px solid #000"><strong>College No :</strong><?php echo $studentInfo->college_no?></td>
                            <td colspan="2" style="border:1px solid #000"><strong>Ref No:</strong> </td>
                         </tr>
                        <tr>
                          
                            <td colspan="4" style="border:1px solid #000"><strong>Name : </strong><?php echo $studentInfo->student_name?></td>
                            
                         </tr>
                        <tr>
                          
                            <td colspan="4" style="border:1px solid #000"><strong>Class : </strong><?php echo $studentInfo->sub_proram.' - '.$studentInfo->sectionsName?></td>
                            
                         </tr>
                        <tr>
                          
                            <td colspan="4" style="border:1px solid #000; "><strong>Balance : 
                                <?php 
                                $balance_t =  $total_balance+$hoste_balance+$grand_mess_balance;
                                
                                if($balance_t >0):
                                    echo $balance_t;
                                
                                
                                echo '/-   In words ('.$this->CRUDModel->money_convert($balance_t).')';
                                    else:
                                   echo 0; 
                                endif;
                                
                            ?></strong></td>
                            
                         </tr>
                        <tr>
                          
                            <td colspan="4" style="border:1px solid #000;"><strong>Last Date Payment : <?php 
                            
                            $where_date = array(
                                'fc_student_id'     => $student_id,
                                'fc_ch_status_id'   => 2
                                    );
                                      $this->db->order_by('fc_challan_id','desc');
                                      $this->db->limit(1,0);
                            $result = $this->db->get_where('fee_challan',$where_date)->row();
                            
                            if(!empty($result)):
                               echo date('l,F, j Y',strtotime($result->fc_paiddate)); 
                            endif;
                            ?></strong></td>
                            
                         </tr>
                        <tr>
                          
                            <td colspan="4" style="border:1px solid #000"><strong>Comments: <?php echo $comments?></strong></td>
                            
                         </tr>
                        
                        <tr>
                          
                            <td colspan="2" style="border:1px solid #000; padding-top:50px; text-align: center; text-decoration:overline"><strong>Cleared By</strong></td>
                            <td colspan="2" style="border:1px solid #000; padding-top:50px;text-align: center; text-decoration:overline"><strong>Finance Officer</strong></td>
                            
                         </tr>
                         

                      </table>
                        <br/>
                        <br/>
                       <p style="margin-bottom: 1px; font-size: 16px; ">Note: Final certificate shall be issued on full payment of dues at the end of session.</p>
                        
                        </div>
                    
                   
                    
                    </div>
                   
                        
                       
                    </div>

                </div>
                </div>
        </div>
    </div>
</div>
 
    <!--//page-wrapper--> 
 
   
   
     
 