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
            
            
            <table align="center">
                <tr style="height: 45px">
                    <td>
                        
                        <?php
                        
                        if(!empty($voucher_info->vocher_rq)):
                            ?>
                                <img  class="img-responsive" src="assets/RQ/vocher_rq/<?php echo $voucher_info->vocher_rq; ?>" alt="<?php echo $voucher_info->gl_at_id?>" width="80px;"> </td><td width='10px'>
                                <?php
                            else:
                            
                        endif;
                        ?>
                        
                        </td>
                    
                    <td><h3 align="center">EDWARDES COLLEGE PESHAWAR <br/><?php echo @$voucher_info->voch_name?></h3></td>
                 <td ><img  class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                        
                  </tr>
            </table>
            
         
            
            
    <div class="table-responsive">
            
        <table class="table table-boxed table-hover" align="right">
           <tbody>
                <tr style="height: 45px">
                    <td width="100px">Process Date</td>
                    <td width="100px"><?php echo date('d-m-Y', strtotime($voucher_info->gl_at_date));?></td>
                    <td width="100px">Process No</td>
                    <td width="100px"><?php echo $voucher_info->gl_at_id;?></td>
                    <td width="100px">Voucher No</td>    
                    <td width="100px"><?php echo $voucher_info->gl_at_vocher;?></td>    
                    <td width="100px">Payment Date</td>    
                    <td width="100px"><?php 
                    
                    if($voucher_info->vocher_status == 2):
                      echo date('d-m-Y', strtotime($voucher_info->payment_date));
                    endif;
                    
                    
                    
                    ?></td>    
                  </tr>
                <tr>
                    <td width="10px" colspan="8" style="height: 60px">Payee : <strong><?php echo $voucher_info->gl_at_payeeId;?></strong></td>
                    
                  
                  </tr>
                <tr>
                    <td width="10px" colspan="8" style="height: 60px">Brief Description of the payment : <strong><?php echo $voucher_info->gl_at_description;?></strong></td>
                   
                  
                  </tr>
                    <td>Attachments</td>
                    <td colspan="7">
                        
                        <?php 
                        
                        
                        $all_attac = $this->db->where('status',1)->get('fn_attachments')->result();
                        if($all_attac):
                            foreach($all_attac as $allRow):
                            $key_where = array(
                                'attach_id'=>$allRow->id,
                                'amount_tra_id'=>$this->uri->segment(2),
                            );
                                $key = $this->CRUDModel->get_where_row('fn_voucher_attachment',$key_where);
                            if($key):
                               echo '<i size="" class="fa fa-check-square-o" aria-hidden="true"></i> '.$allRow->attach_name.'&nbsp;&nbsp;&nbsp;';
                                else:
                                 echo '<i class="fa fa-square-o " aria-hidden="true"></i> '.$allRow->attach_name.'&nbsp;&nbsp;&nbsp;';
                            endif;
                        endforeach;
                        endif;
           ?>
            </td>
                  
                  </tr>
                   <tr>
                       
                       <td colspan="4" style="height: 60px">Prepared & Paid by (Cashier) :
                        <?php
                    
                    $cashier = $this->db->where('status',1)->get('fn_cashier')->row();
                     
                        echo $cashier->name;
                 
                    
                    ?>
                       </td>
                   
                    <td>Signed</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td></td>    
                          
          </tbody>
            </table>
        <table class="table table-boxed table-hover">
           <tbody>
                 
                   <tr style=" font-size:12px; font-weight: 600; border-bottom: 1px solid #000000;">
                       <th width="200px">Account<br/>Code</th>
                    <th>Chart Of Account</th>
                    <th>Debit</th>
                    <th>Credit</th>
                       <?php 
                       
                       if($chart_of_acct):
                           $credit = '';
                           $depit = '';
                           foreach($chart_of_acct as $chrRow):
                           echo '
                               <tr style=" font-size:12px; font-weight: 400; border-top: 0px solid #000000;">
                                <td style="border-top: 0px solid #000000;">'.$chrRow->fn_coa_mc_code.'</td>
                                    <td style="border-top: 0px solid #000000;">'.$chrRow->fn_coa_mc_title.'</td>
                                    <td style="border-top: 0px solid #000000;">'.$chrRow->gl_ad_depit.'</td>
                                    <td style="border-top: 0px solid #000000;">'.$chrRow->gl_ad_credit.'</td>
                                </tr> ';
                           $credit +=$chrRow->gl_ad_credit;
                           $depit +=$chrRow->gl_ad_depit;
                           endforeach;
                       endif;
                       
                      
                       
                       echo ' </tr>        
                          
                   <tr style=" font-size:12px; font-weight: 400;">
                       <td>(In Words)</td>
                        <td><strong>'.$this->CRUDModel->money_convert($credit).'   only</strong></td>
                        <td>'.$credit.'</td>
                        <td>'.$credit.'</td>
                       
                  </tr> ';
                       
                       ?>
                        
          </tbody>
            </table>
       <table class="table table-boxed table-hover">
           <tbody>
               
               <?php
               
               if($approval):
                   foreach($approval as $aprRow):
                   echo '<tr style="height: 45px">
                            <td width="200px">'.$aprRow->designation.'</td>
                               
                            <td>'.$aprRow->name.'</td>
                           
                            <td>Signed</td>    
                            <td></td>    
                            <td>Date</td>    
                            <td> </td>    
                          </tr>';
                   endforeach;
               endif;
             
               
               ?>
                
                
        
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
                <tr style="height: 45px">
                    <td width="150px" colspan="2">Paid vide Cheque#  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $voucher_info->gl_at_cheque;?></td>
                    <td width="100px" colspan="2">Dated : &nbsp;<?php 
                    
                    if($voucher_info->vocher_status == 2):
                      echo date('d-m-Y', strtotime($voucher_info->payment_date));
                    endif;
                    
                    
                    
                    ?></td>
                    <td  colspan="2">Rs: &nbsp;<?php if($voucher_info->print_cheque_value):
                        echo $voucher_info->print_cheque_value;
                    
                    endif;
                    ?></td>    
                    
                    <td>Payee Signature</td>    
                    <td ></td>    
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
 
 