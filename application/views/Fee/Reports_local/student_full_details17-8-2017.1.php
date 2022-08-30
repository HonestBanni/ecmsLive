 

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
       <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button> 
       <div class="row">
          <div class="col-md-12">
               
              <div id="div_print">
                  
                  
                <div style="margin-top: 2px;width:100%;height:710px;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
               
                       <p style="font-size: 14px; text-align: left; font-weight: bold;">Student Informations</p>
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

                      </table>
                       
                    <br/>
                    <br/>
                    <p style="font-size: 14px; text-align: left; font-weight: bold;">Fee Details</p>
                     
                          <?php
             if($fee_information):
//                 echo '<pre>';print_r($fee_information);die;
               foreach($fee_information as $challan_info):
                 
                 
                 ?> 
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                        <tr>
                                <td style="border: 1px solid #000000;">Challan No  :<strong><?php echo $challan_info->challan_id?></strong></td>
                                <td style="border: 1px solid #000000;">Challan Status      : <strong><?php echo $challan_info->challan_status?></strong></td>
                                <td style="border: 1px solid #000000;">Paid  :<strong><?php 
                                $paid_date = '';
                                if($challan_info->fc_paiddate == '0000-00-00'):
                                    $paid_date = 'Not Paid';
                                    else:
                                        $paid_date = date('d-m-Y',strtotime($challan_info->fc_paiddate));
                                endif;
                                
                                echo $paid_date ?></strong></td>
                                <td style="border: 1px solid #000000;">From  :<strong><?php echo date('d-m-Y',strtotime($challan_info->fc_paid_form))?></strong></td>
                                <td style="border: 1px solid #000000;">To  :<strong><?php echo date('d-m-Y',strtotime($challan_info->fc_paid_upto))?></strong></td>
                                
                                <td style="border: 1px solid #000000;">comments  :<strong><?php echo $challan_info->fc_comments?></strong></td>
                            
                         </tr>
                    </table>
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>Head</th>
                                <th>Actual Amount</th>
                                <th>Paid Amount</th>
                                
                            </tr>
                          </thead>
                        <?php
                        $sn = '';
                        $actual_grand = '';
                        $paid_grand = '';
                        
                        foreach($challan_info->payment_details as $payment_info):
                            $sn++;
                        
                        ?>
                        <tr>
                                
                                <td style="border: 1px solid #000000;"><strong><?php echo $sn?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $payment_info->fh_head?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $payment_info->actual_amount?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $payment_info->paid_amount?></strong></td>
      
                                
                                
                         </tr>
                        <?php
                          $actual_grand += $payment_info->actual_amount;
                          $paid_grand += $payment_info->paid_amount;
                        endforeach;
                        
                        ?>
                         <tr>
                                
                                <td style="border: 1px solid #000000;"></td>
                                <td style="border: 1px solid #000000;"></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $actual_grand?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $paid_grand?></strong></td>
                                
                                
                         </tr>
                        
                    </table>
                       <br/>   
                          <?php  
                     endforeach;
             endif;
             ?>
                             <br/>
                    <br/>
                       
                         <?php
                        if($hostel_information):
                            echo ' <p style="font-size: 14px; text-align: left; font-weight: bold;">Hostel Details</p>';
                            foreach($hostel_information as $hostel_row):
                         
                                $payment_date = '';
                                if($hostel_row->payment_date == '0000-00-00'):
                                    $payment_date = 'Not Paid';
                                    else:
                                    $payment_date = date('d-m-Y',strtotime($hostel_row->payment_date));
                                endif;
                            
                            
                        ?> 
                            <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                                <tr>
                                       <td style="border: 1px solid #000000;">Hostel Status: <strong><?php echo $hostel_row->hostel_status?></strong></td>
                                       <td style="border: 1px solid #000000;">Challan Status: <strong><?php echo $hostel_row->challan_status?></strong></td>
                                       <td style="border: 1px solid #000000;">Paid Date: <strong><?php echo $payment_date?></strong></td>
                                       <td style="border: 1px solid #000000;">From       : <strong><?php echo date('d-m-Y',strtotime($hostel_row->date_from));?></strong></td>
                                       <td style="border: 1px solid #000000;">To       : <strong><?php echo date('d-m-Y',strtotime($hostel_row->date_to));?></strong></td>
                                       <td style="border: 1px solid #000000;">Issue Date       : <strong><?php echo date('d-m-Y',strtotime($hostel_row->issue_date));?></strong></td>
                                </tr>
                            </table>
                        <br/>
                              <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>Head</th>
                                  <th>Actual Amount</th>
                                <th>Paid</th>
                                
                            </tr>
                            
                            <?php
                            $sn = '';
                            $bill_total_actual = '';
                            $bill_total_paid = '';
                            
                            foreach($hostel_row->bill_details as $bill_row):
                             $sn++;
                            ?>
                            <tr>
                                
                                <td style="border: 1px solid #000000;"><strong><?php echo  $sn?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_row->title?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_row->amount?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_row->paid_amount?></strong></td>
                            </tr>
                         
                          <?php
                           $bill_total_actual += $bill_row->amount;
                            $bill_total_paid += $bill_row->paid_amount;
                                
                            endforeach;
                            ?>
                            
                            <tr>
                                
                                <td style="border: 1px solid #000000;"><strong></strong></td>
                                <td style="border: 1px solid #000000;"><strong>Total</strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_actual?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_paid?></strong></td>
                            </tr>
                         </thead>
                         
                    </table>
                        
                        
                        <?php
              
                            
                            endforeach;
                        endif;
                        ?> 
                        
                    <br/>
                    <br/>
                   

                    <?php
                        if($mess_information):
                            echo '<p style="font-size: 14px; text-align: left; font-weight: bold;">Mess Details</p>';
                            foreach($mess_information as $mess_row):
                         
                                $payment_date = '';
                                if($mess_row->payment_date == '0000-00-00'):
                                    $payment_date = 'Not Paid';
                                    else:
                                    $payment_date = date('d-m-Y',strtotime($mess_row->payment_date));
                                endif;
                            
                            
                        ?> 
                            <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                                <tr>
                                       
                                       <td style="border: 1px solid #000000;">Mess Status: <strong><?php echo $mess_row->challan_status?></strong></td>
                                       <td style="border: 1px solid #000000;">Paid Date: <strong><?php echo $payment_date?></strong></td>
                                       <td style="border: 1px solid #000000;">Issue Date       : <strong><?php echo date('d-m-Y',strtotime($mess_row->issue_date));?></strong></td>
                                </tr>
                            </table>
                        <br/>
                              <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>Head</th>
                                <th>Per Day</th>
                                <th>Total Days</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                
                            </tr>
                            
                            <?php
                            $sn = '';
                            $bill_total_actual = '';
                            $bill_total_paid = '';
                            
                            foreach($mess_row->bill_details as $bill_row):
                             $sn++;
                            ?>
                            <tr>
                                
                                <td style="border: 1px solid #000000;"><strong><?php echo  $sn?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_row->title?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_row->per_day?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_row->total_days?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_row->amount?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_row->paid_amount?></strong></td>
                            </tr>
                         
                          <?php
                           $bill_total_actual += $bill_row->amount;
                            $bill_total_paid += $bill_row->paid_amount;
                                
                            endforeach;
                            ?>
                            
                            <tr>
                                
                                <td style="border: 1px solid #000000;"><strong></strong></td>
                                <td style="border: 1px solid #000000;"><strong></strong></td>
                                <td style="border: 1px solid #000000;"><strong></strong></td>
                                <td style="border: 1px solid #000000;"><strong>Total</strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_actual?></strong></td>
                                <td style="border: 1px solid #000000;"><strong><?php echo $bill_total_paid?></strong></td>
                            </tr>
                         </thead>
                         
                    </table>
                        
                        
                        <?php
              
                            
                            endforeach;
                        endif;
                        ?> 
                        <br/>
                        <br/>
                        <br/>
                        
                       
                </div>
               
                </div>
          
                    </div>
            </div>
 
          </div>
          
      
      </div>
                
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
   
     
 