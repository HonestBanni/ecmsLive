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
//                        error_reporting(0);
                        
                        if(!empty($voucher_info->vocher_rq)):
                            ?>
                                <img  class="img-responsive" src="assets/RQ/vocher_rq/<?php echo $voucher_info->vocher_rq; ?>" alt="<?php echo $voucher_info->gl_at_id?>" width="80px;"> </td><td width='10px'>
                                <?php
                            else:
                            
                        endif;
                        ?>
                        
                        </td>
                    
                        <td><h3 align="center">EDWARDES COLLEGE PESHAWAR<br/><?php echo $voucher_info->voch_name?><br/><strong><?php echo $voucher_info->title?></strong></h3></td>
                    
                 <td ><img  class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                        
                  </tr>
            </table>
            
         
            
            
    <div class="table-responsive">
            
        <table class="table table-boxed table-hover" align="right">
           <tbody>
                <tr >
                    <td width="100px">Process Date</td>
                    <td width="100px" style="text-decoration: underline;font-weight: bold;"><?php echo date('d-m-Y', strtotime($voucher_info->gl_at_date));?></td>
                    <td width="100px">Process No</td>
                    <td width="100px" style="text-decoration: underline;font-weight: bold;"><?php echo $voucher_info->gl_at_id;?></td>
                    <td width="100px">Voucher No</td>    
                    <td width="100px"><?php echo $voucher_info->gl_at_vocher;?></td>    
                    <td width="100px">Payment Date </td>    
                    <td width="100px"><?php 
                    
                    if($voucher_info->vocher_status == 2):
                      echo date('d-m-Y', strtotime($voucher_info->payment_date));
                    endif;
                    
                      
                    
                    ?></td>    
                  </tr>
                <tr>
                    <td width="10px" colspan="4" style="height: 60px">
                        
                        <?php
                        
                        if($voucher_info->vocher_type == 4 || $voucher_info->vocher_type == 3 ):
                            echo 'Received :';
                            else:
                            echo 'Payee :';
                        endif;
                        ?>
                        
                        
                         <strong><?php echo $voucher_info->gl_at_payeeId;?></strong></td>
                    <td width="10px" colspan="4" style="height: 60px">
                        <?php 
                    
                    
                        
                      if(!empty($voucher_info->supplier_id)):
                        
                       $supplier_name =    $this->CRUDModel->get_where_row("fn_supplier",array('fn_supp_id'=>$voucher_info->supplier_id));
                      echo 'Company : <strong>'.$supplier_name->company_name.'<br/>'.$supplier_name->address.'</strong>';
                      endif;
                    
                    
                    ?>
                   </td> 
                  
                  </tr>
                <tr>
                    
                    <td width="10px" colspan="8" style="height: 60px">
                        
                         <?php
                        
                        if($voucher_info->vocher_type == 4 || $voucher_info->vocher_type == 3 ):
                            echo 'Brief Description :';
                            else:
                            echo 'Brief Description of the payment :';
                        endif;
                        ?>
                        
                         <strong><?php echo $voucher_info->gl_at_description;?></strong></td>
                   
                  
                  </tr>
           <td colspan="2">Attachments :</td>
                    <td colspan="6">
                        
                        <?php 
                        
                        
                        $all_attac = $this->db->where('status',1)->get('fn_attachments')->result();
                        if($all_attac):
                            
                          $all_attac2 =  array_chunk($all_attac, 3);
//                            echo '<pre>';print_r($all_attac2);die;
                            foreach($all_attac2 as $allRow2):
                                 
                                foreach($allRow2 as $allRow):
                                        $key_where = array(
                                        'attach_id'=>$allRow->id,
                                        'amount_tra_id'=>$this->uri->segment(2),
                                    );
                            
                                $key = $this->CRUDModel->get_where_row('fn_voucher_attachment',$key_where);
                            if($key):
                               echo '<i class="fa fa-check-square-o" aria-hidden="true"  style="font-size: 18px;"></i> '.$allRow->attach_name.'&nbsp;&nbsp;&nbsp;';
                                else:
                                 echo '<i class="fa fa-square-o " aria-hidden="true"  style="font-size: 18px;"></i> '.$allRow->attach_name.'&nbsp;&nbsp;&nbsp;';
                            endif;
                                endforeach;
                                
                                echo '<br/>';
                            
                            
                        endforeach;
                        endif;
           ?>
            </td>
                  
                  </tr>
                   <tr>
                       
                       <td colspan="4" style="height: 60px; padding-top: 22px;"  >Prepared &   <?php
                        
                        if($voucher_info->vocher_type == 4 || $voucher_info->vocher_type == 3 ):
                            echo 'Received';
                            else:
                            echo 'Paid';
                        endif;
                        ?> by (Cashier) :
                        <?php
                    
                        $cashier = $this->db->where('status',1)->get('fn_cashier')->row();
                     
                        echo $cashier->name;
                 
                    
                    ?>
                       </td>
                   
                    <td style=" padding-top: 22px;">Signed</td>    
                    <td style=" padding-top: 22px;"></td>    
                    <td style=" padding-top: 22px;">Date</td>    
                    <td style=" padding-top: 22px;"></td>    
                          
          </tbody>
            </table>
        <table class="table table-boxed table-hover">
           <tbody>
                 
                   <tr style=" font-size:12px; font-weight: 600; border-bottom: 1px solid #000000;">
                       <th width="200px">Account Code</th>
                    <th>Chart of Account</th>
                    <th>Debit</th>
                    <th>Credit</th>
                       <?php 
                       
                       if($chart_of_acct):
                           
                           $creditGrant = 0;
                        
                           $depitGrant = 0;
                           foreach($chart_of_acct as $chrRow):
                                  $depit = 0;
                                  $credit = 0;
                               if($chrRow->gl_ad_depit>0):
                                   $depit = number_format($chrRow->gl_ad_depit, 0, ',', ',');
                               endif;
                               if($chrRow->gl_ad_credit>0):
                                   $credit = number_format($chrRow->gl_ad_credit, 0, ',', ',');
                               endif;
                           echo '
                               <tr style=" font-size:12px; font-weight: 400; border-top: 0px solid #000000;">
                                <td style="border-top: 0px solid #000000;">'.$chrRow->fn_coa_mc_code.'</td>
                                    <td style="border-top: 0px solid #000000;">'.$chrRow->fn_coa_mc_title.'</td>
                                    <td style="border-top: 0px solid #000000;">'.$depit.'</td>
                                    <td style="border-top: 0px solid #000000;">'.$credit.'</td>
                                </tr> ';
                           $creditGrant +=$chrRow->gl_ad_credit;
                           $depitGrant  +=$chrRow->gl_ad_depit;
                           endforeach;
                       endif;
                        $word_crdit = '';
                        if($creditGrant> 0):
                            $creditGrant = number_format($creditGrant, 0, ',', ',');
                        endif;
                        if($depitGrant>0):
                            $word_crdit = $depitGrant;
                            $depitGrant = number_format($depitGrant, 0, ',', ',');
                        endif;
                       
                      
                       
                       echo ' </tr>        
                          
                   <tr style=" font-size:12px; font-weight: 400; ">
                       <td></td>
                        <td><strong style="float: right;">Total :</strong></td>
                        <td>'.$depitGrant.'</td>
                        <td>'.$creditGrant.'</td>
                       
                  </tr>
                   <tr style=" font-size:12px; font-weight: 400;">
                       <td colspan="4"><strong> (In Words)  :'.$this->CRUDModel->money_convert($voucher_info->print_cheque_value).'only</strong></td>
                        
                       
                  </tr>
                  ';
                       
                       ?>
                        
          </tbody>
            </table>
       <table class="table table-boxed table-hover">
           <tbody>
               
               <?php
               
               if($approval):
                   foreach($approval as $aprRow):
                   echo '<tr style="height: 45px">
                            <td width="220px" style=" padding-top: 22px;">'.$aprRow->designation.'</td>
                            <td style=" padding-top: 22px;">'.$aprRow->name.'</td>
                            <td width="150px" style=" padding-top: 22px;">Signed</td>    
                            <td style=" padding-top: 22px;"></td>    
                            <td width="150px" style=" padding-top: 22px;">Date</td>    
                            <td style=" padding-top: 22px;"> </td>    
                          </tr>';
                   endforeach;
               endif;
             
               
               ?>
                
                
        
          </tbody>
            </table>    
       
        <?php
        
        if($voucher_info->vocher_type == 1):
            
            ?>
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
                    <td width="100px" colspan="2" style=" padding-top: 22px;">Paid vide Cheque#  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $voucher_info->gl_at_cheque;?></td>
                    <td width="100px" colspan="2" style=" padding-top: 22px;">Dated : &nbsp;<?php 
                    
                    if($voucher_info->vocher_status == 2):
                      echo date('d-m-Y', strtotime($voucher_info->payment_date));
                    endif;
                    
                    
                    
                    ?></td>
                    <td  colspan="2" style=" padding-top: 22px;">Rs: &nbsp;<?php if($voucher_info->print_cheque_value):
                        echo number_format($voucher_info->print_cheque_value, 0, ',', ',');
                    
                    endif;
                    ?></td>    
                    
                    <td style=" padding-top: 22px;">Payee Signature</td>    
                    <td style=" padding-top: 22px;"></td>    
                  </tr>
 
        
          </tbody>
            </table>    
               <?php
            
         endif;
        if($voucher_info->vocher_type == 2):
           
         endif;
        if($voucher_info->vocher_type == 3):
           
         endif;
        if($voucher_info->vocher_type == 4):
           
         endif;
        
        
        
        if($voucher_info->vocher_type == 5):
           
//        else:
            
           ?>
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
                    <td width="100px" colspan="2" style=" padding-top: 22px;">Paid to:  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $voucher_info->gl_at_cheque;?></td>
                    <td width="100px" colspan="2" style=" padding-top: 22px;">Dated : &nbsp;<?php 
                    
                    if($voucher_info->vocher_status == 2):
                      echo date('d-m-Y', strtotime($voucher_info->payment_date));
                    endif;
                    
                    
                    
                    ?></td>
                    <td  colspan="2" style=" padding-top: 22px;">Rs: &nbsp;<?php if($voucher_info->print_cheque_value):
                        echo number_format($voucher_info->print_cheque_value, 0, ',', ',');
                    
                    endif;
                    ?></td>    
                    
                    <td style=" padding-top: 22px;">Payee Signature</td>    
                    <td style=" padding-top: 22px;"></td>    
                  </tr>
 
        
          </tbody>
            </table>    
               <?php 
        endif;
        
        
        
        
     
        
        ?>
        
      
         </div>
             <?php echo $print_log;?>
            </article>
           
           </div>
            </div>    
          </div>
          </div>
        <!--//page-row-->
      </div>
 
 