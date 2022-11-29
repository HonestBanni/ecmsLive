<html><head></head><body>
<style>
    .removeBorder {
        
        border-top : 1px solid #ffffff !important;
        text-decoration: underline;
    }
    
</style>
  <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">   
    <?php if(!empty($studentInfo)): ?>
             <div style="margin: 2px 4px 2px; width:32%;height:auto;border-right:2px dotted #000; float: left; position: relative">
                <div style="text-align: center">
                    <img  src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="25%;">
                </div>
                    <!--<p style="font-size: 14px; text-align: center; font-weight: bold;">EDWARDES COLLEGE PESHAWAR</p>-->
                 <p style="font-size: 12px; text-align: center;"><strong>EDWARDES COLLEGE PESHAWAR <br/>HABIB BANK LIMITED POLICE ROAD, PESHAWAR</strong> <br><strong style="font-size: 15px;">Acc No :(0898-00162501-03)</strong></p>
                    <table class="table ">
                        <tr  style="font-size: 18px;">
                            <td class="removeBorder"><strong>Challan# :</strong></td>
                            <td class="removeBorder"><strong><?php echo  $feeComments->fc_challan_id    ?></strong></td>
                        </tr>
                        <tr  style="font-size: 12px;">
                           <td class="removeBorder">Name : </td>
                           <td class="removeBorder"><?php $newtext = wordwrap($studentInfo->student_name, 8, "\n", true); echo     substr("$newtext\n", 0, 37); ?></td>
                        </tr>
                        <tr style="font-size: 12px;">
                           <td class="removeBorder"> Father Name : </td>
                           <td class="removeBorder"><?php $newtext = wordwrap($studentInfo->father_name, 8, "\n", true); echo      substr("$newtext\n", 0, 37);?> </td>
                        </tr>
                        <tr>
                           <td style="font-size: 12px;" class="removeBorder"> Program : </td>
                           <td style="font-size: 12px;"class="removeBorder"><?php echo  $studentInfo->sub_proram ;?> </td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;" class="removeBorder"> <strong>Installment: </strong></td>
                           <td style="font-size: 12px;" class="removeBorder"><strong><?php
                         $hoste_status = '';
                            $where =array(
                                          'sub_programes.sub_pro_id'    => $studentInfo->sub_pro_id,
                                          'batch_id'                    => $studentInfo->batch_id,
                                          'fee_payment_category.pc_id'  => $feeComments->fc_pay_cat_id
                                      );
                                                 $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $pc_id = $this->db->where($where)->get('fee_payment_category')->row();
                                        
                                        if($feeComments->fc_pay_cat_id == 0):
                                            echo '<strong>Other Challan'.$hoste_status.'</strong>';
                                        else:
                                            if(!empty($pc_id)):
                                        echo '<strong>'.$pc_id->title.''.$hoste_status.'</strong>';   
                                           else:
                                               
                                           '<h1 style="color:red">Wrong Parameter selected Please Contact IT Department</h1>';       
                                        endif;
                                        endif;
                                       
                                        
                                    
                                        ?></strong></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;" class="removeBorder"><strong>Valid Till:</strong></td>
                           <td style="font-size: 12px;" class="removeBorder"><strong><?php echo  date('d-m-Y',strtotime($feeComments->fc_dueDate));?></strong></td>
                        </tr>
                    </table>
                    
                    <table class="table">    
                    <tr style="background-color:black; color: white;">
                            <td style="font-size: 12px;" >Description</td>
                            <td style="font-size: 12px; text-align: center;" style="text-align: center;">Amount</td>
                        </tr>
                        
                        <?php
                       $grand_total = '';
                            if(!empty($FeeHeads)):
                                    foreach($FeeHeads as $FRow):
                                        echo '<tr>
                                                <td style="font-size: 13px;" class="removeBorder">'.$FRow->fh_head.'</td> 
                                                <td style="font-size: 13px; text-align: center;" class="removeBorder">'.$FRow->paid_amount.'</td> 
                                            </tr>';
                            $grand_total += $FRow->paid_amount;
                                    endforeach;
                                
                            endif;
                        
                        
                        ?>
                        
                         
                        <tr>
                            <td style="padding-top:10px;  font-size: 13px;" class="removeBorder"><strong>Total</strong></td> 
                            <td style="padding-top:10px; text-align: center; font-size: 13px;" class="removeBorder" ><strong><?php echo  $grand_total?>/-</strong></td> 
                        </tr> 
                        <tr>
                            <td colspan="2" style="font-size: 10px;" class="removeBorder">Comments :&nbsp;&nbsp;<?php echo $feeComments->fc_comments?></td>
                        
                    </tr>
                </table>
                <h6 align="center"><strong>For Bank</strong></h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;"><strong>[<?php echo  $studentInfo->batch_name ?> ]</strong> Banker's stamp &amp; signature</h6>
               <h5 align="left" style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif !important;"><strong>Instructions For Bank</strong></h5> 
               <ol class="custom-list-style">
                    <li> <strong>Fee can be paid at any HBL-Branch</strong></li>
                    <li> <strong>Please mention Challan# as "Mandatory" while depositing the fee, so that it can easily be traced in bank statement.</strong></li>
                    <li><strong>Admission shall be cancelled, if fee is not deposited within due date.</strong></li>
                </ol>
              </div>
             <div style="margin: 2px 4px 2px; width:32%;height:auto;border-right:2px dotted #000; float: left; position: relative">
                <div style="text-align: center">
                    <img  src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="25%;">
                </div>
                 <p style="font-size: 12px; text-align: center;"><strong>EDWARDES COLLEGE PESHAWAR </strong>  <strong><br/>HABIB BANK LIMITED POLICE ROAD, PESHAWAR</strong> <br><strong style="font-size: 15px;">Acc No :(0898-00162501-03)</strong></p>
                    <table class="table ">
                        <tr  style="font-size: 18px;">
                            <td class="removeBorder"><strong>Challan# :</strong></td>
                            <td class="removeBorder"><strong><?php echo  $feeComments->fc_challan_id    ?></strong></td>
                        </tr>
                        <tr  style="font-size: 12px;">
                           <td class="removeBorder">Name : </td>
                           <td class="removeBorder"><?php $newtext = wordwrap($studentInfo->student_name, 8, "\n", true); echo     substr("$newtext\n", 0, 37); ?></td>
                        </tr>
                        <tr style="font-size: 12px;">
                           <td class="removeBorder"> Father Name : </td>
                           <td class="removeBorder"><?php $newtext = wordwrap($studentInfo->father_name, 8, "\n", true); echo      substr("$newtext\n", 0, 37);?> </td>
                        </tr>
                        <tr>
                           <td style="font-size: 12px;" class="removeBorder"> Program : </td>
                           <td style="font-size: 12px;"class="removeBorder"><?php echo  $studentInfo->sub_proram ;?> </td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;" class="removeBorder"> <strong>Installment: </strong></td>
                           <td style="font-size: 12px;" class="removeBorder"><strong><?php
                         $hoste_status = '';
                            $where =array(
                                          'sub_programes.sub_pro_id'    => $studentInfo->sub_pro_id,
                                          'batch_id'                    => $studentInfo->batch_id,
                                          'fee_payment_category.pc_id'  => $feeComments->fc_pay_cat_id
                                      );
                                                 $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $pc_id = $this->db->where($where)->get('fee_payment_category')->row();
                                        
                                        if($feeComments->fc_pay_cat_id == 0):
                                            echo '<strong>Other Challan'.$hoste_status.'</strong>';
                                        else:
                                            if(!empty($pc_id)):
                                        echo '<strong>'.$pc_id->title.''.$hoste_status.'</strong>';   
                                           else:
                                               
                                           '<h1 style="color:red">Wrong Parameter selected Please Contact IT Department</h1>';       
                                        endif;
                                        endif;
                                       
                                        
                                    
                                        ?></strong></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;" class="removeBorder"><strong>Valid Till :</strong></td>
                           <td style="font-size: 12px;" class="removeBorder"><strong><?php echo  date('d-m-Y',strtotime($feeComments->fc_dueDate));?></strong></td>
                        </tr>
                    </table>
                    
                    <table class="table">    
                    <tr style="background-color:black; color: white;">
                            <td style="font-size: 12px;" >Description</td>
                            <td style="font-size: 12px; text-align: center;" style="text-align: center;">Amount</td>
                        </tr>
                        
                        <?php
                       $grand_total = '';
                            if(!empty($FeeHeads)):
                                    foreach($FeeHeads as $FRow):
                                        echo '<tr>
                                                <td style="font-size: 13px;" class="removeBorder">'.$FRow->fh_head.'</td> 
                                                <td style="font-size: 13px; text-align: center;" class="removeBorder">'.$FRow->paid_amount.'</td> 
                                            </tr>';
                            $grand_total += $FRow->paid_amount;
                                    endforeach;
                                
                            endif;
                        
                        
                        ?>
                        
                         
                        <tr>
                            <td style="padding-top:10px;  font-size: 13px;" class="removeBorder"><strong>Total</strong></td> 
                            <td style="padding-top:10px; text-align: center; font-size: 13px;" class="removeBorder" ><strong><?php echo  $grand_total?>/-</strong></td> 
                        </tr> 
                        <tr>
                            <td colspan="2" style="font-size: 10px;" class="removeBorder">Comments :&nbsp;&nbsp;<?php echo $feeComments->fc_comments?></td>
                        
                    </tr>
                </table>
                <h6 align="center"><strong>For College</strong></h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;"><strong>[<?php echo  $studentInfo->batch_name ?> ]</strong> Banker's stamp &amp; signature</h6>
               <h5 align="left" style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif !important;"><strong>Instructions For Bank</strong></h5> 
               <ol class="custom-list-style">
                    <li> <strong>Fee can be paid at any HBL-Branch</strong></li>
                    <li> <strong>Please mention Challan# as "Mandatory" while depositing the fee, so that it can easily be traced in bank statement.</strong></li>
                    <!--<li><strong>No Fee shall be deposited after due date.</strong></li>-->
                    <li><strong>Admission shall be cancelled, if fee is not deposited within due date.</strong></li>
               </ol>
              </div>
             <div style="margin: 2px 4px 2px; width:32%;height:auto; float: left; position: relative">
                <div style="text-align: center">
                    <img  src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="25%;">
                </div>
                    <p style="font-size: 12px; text-align: center;"><strong>EDWARDES COLLEGE PESHAWAR <br/>HABIB BANK LIMITED POLICE ROAD, PESHAWAR</strong> <br><strong style="font-size: 15px;">Acc No :(0898-00162501-03)</strong></p>
                    <table class="table ">
                        <tr  style="font-size: 18px;">
                            <td class="removeBorder"><strong>Challan# :</strong></td>
                            <td class="removeBorder"><strong><?php echo  $feeComments->fc_challan_id    ?></strong></td>
                        </tr>
                        <tr  style="font-size: 12px;">
                           <td class="removeBorder">Name : </td>
                           <td class="removeBorder"><?php $newtext = wordwrap($studentInfo->student_name, 8, "\n", true); echo     substr("$newtext\n", 0, 37); ?></td>
                        </tr>
                        <tr style="font-size: 12px;">
                           <td class="removeBorder"> Father Name : </td>
                           <td class="removeBorder"><?php $newtext = wordwrap($studentInfo->father_name, 8, "\n", true); echo      substr("$newtext\n", 0, 37);?> </td>
                        </tr>
                        <tr>
                           <td style="font-size: 12px;" class="removeBorder"> Program : </td>
                           <td style="font-size: 12px;"class="removeBorder"><?php echo  $studentInfo->sub_proram ;?> </td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;" class="removeBorder"> <strong>Installment: </strong></td>
                           <td style="font-size: 12px;" class="removeBorder"><strong><?php
                         $hoste_status = '';
                            $where =array(
                                          'sub_programes.sub_pro_id'    => $studentInfo->sub_pro_id,
                                          'batch_id'                    => $studentInfo->batch_id,
                                          'fee_payment_category.pc_id'  => $feeComments->fc_pay_cat_id
                                      );
                                                 $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $pc_id = $this->db->where($where)->get('fee_payment_category')->row();
                                        
                                        if($feeComments->fc_pay_cat_id == 0):
                                            echo '<strong>Other Challan'.$hoste_status.'</strong>';
                                        else:
                                            if(!empty($pc_id)):
                                        echo '<strong>'.$pc_id->title.''.$hoste_status.'</strong>';   
                                           else:
                                               
                                           '<h1 style="color:red">Wrong Parameter selected Please Contact IT Department</h1>';       
                                        endif;
                                        endif;
                                       
                                        
                                    
                                        ?></strong></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;" class="removeBorder"><strong>Valid Till :</strong></td>
                           <td style="font-size: 12px;" class="removeBorder"><strong><?php echo  date('d-m-Y',strtotime($feeComments->fc_dueDate));?></strong></td>
                        </tr>
                    </table>
                    
                    <table class="table">    
                    <tr style="background-color:black; color: white;">
                            <td style="font-size: 12px;" >Description</td>
                            <td style="font-size: 12px; text-align: center;" style="text-align: center;">Amount</td>
                        </tr>
                        
                        <?php
                       $grand_total = '';
                            if(!empty($FeeHeads)):
                                    foreach($FeeHeads as $FRow):
                                        echo '<tr>
                                                <td style="font-size: 13px;" class="removeBorder">'.$FRow->fh_head.'</td> 
                                                <td style="font-size: 13px; text-align: center;" class="removeBorder">'.$FRow->paid_amount.'</td> 
                                            </tr>';
                            $grand_total += $FRow->paid_amount;
                                    endforeach;
                                
                            endif;
                        
                        
                        ?>
                        
                         
                        <tr>
                            <td style="padding-top:10px;  font-size: 13px;" class="removeBorder"><strong>Total</strong></td> 
                            <td style="padding-top:10px; text-align: center; font-size: 13px;" class="removeBorder" ><strong><?php echo  $grand_total?>/-</strong></td> 
                        </tr> 
                        <tr>
                            <td colspan="2" style="font-size: 10px;" class="removeBorder">Comments : &nbsp;&nbsp;<?php echo $feeComments->fc_comments?></td>
                        
                    </tr>
                </table>
                <h6 align="center"><strong>Student Copy</strong></h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;"><strong>[<?php echo  $studentInfo->batch_name ?> ]</strong> Banker's stamp &amp; signature</h6>
               <h5 align="left" style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif !important;"><strong>Instructions For Bank</strong></h5> 
               <ol class="custom-list-style">
                    <li> <strong>Fee can be paid at any HBL-Branch</strong></li>
                    <li> <strong>Please mention Challan# as "Mandatory" while depositing the fee, so that it can easily be traced in bank statement.</strong></li>
                    <!--<li><strong>No Fee shall be deposited after due date.</strong></li>-->
                    <li><strong>Admission shall be cancelled, if fee is not deposited within due date.</strong></li>
                </ol>
              </div>
           
              
         <?php  endif; ?>      
 </body></html>          
            
         
 