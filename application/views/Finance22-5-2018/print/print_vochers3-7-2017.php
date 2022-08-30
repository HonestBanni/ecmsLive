<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
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
    <div class="page-content">
      <div class="row">
          <h2 align="left"><span  style="float:right">
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
              </span></h2>
        <div id="div_print">  
            
        
                
        <article class="contact-form col-md-12 col-sm-12">
            <h3 align="center">EDWARDES COLLEGE PESHAWAR <br/><?php echo $voucher_info->voch_name?><hr/></h3>
            
    <div class="table-responsive">
            
        <table class="table table-boxed table-hover">
           <tbody>
                <tr>
                    <td>Process Date</td>
                    <td><?php echo date('d-m-Y', strtotime($voucher_info->gl_at_date));?></td>
                    <td>Process NO</td>
                    <td><?php echo $voucher_info->gl_at_id;?></td>
                    <td>Voucher No</td>    
                    <td><?php echo $voucher_info->gl_at_vocher;?></td>    
                    <td>Payment date</td>    
                    <td><?php 
                    
                    if($voucher_info->status == 1):
                        else:
                        echo date('d-m-Y', strtotime($voucher_info->payment_date));
                    endif;
                    
                    
                    
                    ?></td>    
                  </tr>
                <tr>
                    <td style="height: 60px">Payee </td>
                    <td colspan="7"><?php echo $voucher_info->gl_at_payeeId;?></td>
                  
                  </tr>
                <tr>
                    <td style="height: 60px">Brief Description of the payment</td>
                    <td colspan="7"><?php echo $voucher_info->gl_at_description;?></td>
                  
                  </tr>
                    <td>Attachments</td>
                    <td colspan="7">
                        
                        <?php 
                        
                        if($attachment_details):
                            foreach($attachment_details as $attRow):
                                echo $attRow->attach_name.', ';
                            endforeach;
                        endif;
                      
                        ?>
                        
                        
                    </td>
                  
                  </tr>
                   <tr>
                       
                    <td style="height: 60px">Prepared & Paid by (Cashier)
                       </td>
                    <td></td>
                    <td>Name</td>
                    <td> jan wali</td>
                    <td>Signed</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td></td>    
                          
          </tbody>
            </table>
        <table class="table table-boxed table-hover">
           <tbody>
                 
                   <tr style=" font-size:16px; font-weight: 700;">
                       <td>Account<br/>Code</td>
                    <td>Chart Of Account</td>
                    <td>Debit</td>
                    <td>Credit</td>
                       <?php 
                       
                       if($chart_of_acct):
                           $credit = '';
                           $depit = '';
                           foreach($chart_of_acct as $chrRow):
                           echo '
                               <tr style=" font-size:16px; font-weight: 600;">
                                <td>'.$chrRow->fn_coa_mc_code.'</td>
                                    <td>'.$chrRow->fn_coa_mc_title.'</td>
                                    <td>'.$chrRow->gl_ad_depit.'</td>
                                    <td>'.$chrRow->gl_ad_credit.'</td>
                                </tr> ';
                           $credit +=$chrRow->gl_ad_credit;
                           $depit +=$chrRow->gl_ad_depit;
                           endforeach;
                       endif;
                       
                      
                       
                       echo ' </tr>        
                          
                   <tr style=" font-size:16px; font-weight: 600;">
                       <td>(In Words)</td>
                        <td>'.$this->CRUDModel->money_convert($credit).'</td>
                        <td>'.$credit.'</td>
                        <td>'.$credit.'</td>
                       
                  </tr> ';
                       
                       ?>
                        
          </tbody>
            </table>
       <table class="table table-boxed table-hover">
           <tbody>
                <tr>
                    <td>Checked by (Account Officer)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td><?php echo date('d-M-Y', strtotime($voucher_info->gl_at_date));?></td>    
                  </tr>
                <tr>
                    <td>Checked by (Finance Officer)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td><?php echo date('d-M-Y', strtotime($voucher_info->gl_at_date));?></td>    
                  </tr>
                <tr>
                    <td>Audited by (Internal Auditor)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td><?php echo date('d-M-Y', strtotime($voucher_info->gl_at_date));?></td>    
                  </tr>
                <tr>
                    <td>Verified by (Director Finance)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td><?php echo date('d-M-Y', strtotime($voucher_info->gl_at_date));?></td>    
                  </tr>
                <tr>
                    <td>Approved by (Principal)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td><?php echo date('d-M-Y', strtotime($voucher_info->gl_at_date));?></td>    
                  </tr>
                <tr>
                    <td>Approved by (Vice Principal-1)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td><?php echo date('d-M-Y', strtotime($voucher_info->gl_at_date));?></td>    
                  </tr>
                <tr>
                    <td>Approved by (Vice Principal-2)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td><?php echo date('d-M-Y', strtotime($voucher_info->gl_at_date));?></td>    
                  </tr>
        
          </tbody>
            </table>    
       <table class="table table-boxed table-hover">
           <tbody>
                <tr>
                    <td>Payment Details</td>
                      <td></td>   
                      <td></td>   
                      <td></td>   
                      <td></td>   
                      <td></td>   
                      <td></td>   
                      <td></td>   
                  </tr>
                <tr>
                    <td>Paid vide Cheque#</td>
                    <td></td>
                    <td>Date</td>
                    <td></td>
                    <td>Rs:</td>    
                    <td><?php if($voucher_info->print_cheque_value):
                        echo $voucher_info->print_cheque_value;
                    
                    endif;
                    ?></td>    
                    
                    <td>Payee Signature</td>    
                    <td></td>    
                  </tr>
 
        
          </tbody>
            </table>    
         </div>
            </article>
           </div>
            </div>    
          </div>
          </div>
        <!--//page-row-->
      </div>
 
 