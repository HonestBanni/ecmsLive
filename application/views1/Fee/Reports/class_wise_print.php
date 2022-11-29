<style>
  .form-control{
    /*height: 26px;*/
    font-size: 12px;
  }
 
</style> 
<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
    //var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
      <h1 class="heading-title pull-left">
        <?php echo $page_header?>
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li>
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">
            <?php echo $page_header?>
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <div class="col-md-1">
          <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme">
            <i class="fa fa-print">
            </i> Print 
          </button>
        </div>
      </div>
      <br>
      <div class="row">
        <div id="div_print">
        
         <?php
         
         
         if($student_info):
             foreach($student_info as $stdInfo):
                $where_check = array(
                    'challan_id'=>$stdInfo->fc_challan_id
                );
                $check = $this->db->get_where('fee_actual_challan_detail',$where_check)->result();
                $balance = '';
                foreach($check as $chRwo):
                    
                    $balance += $chRwo->balance;
                endforeach;
                if($balance>0):
                    
               
                
             $hostel =  $this->CRUDModel->get_where_row('hostel_student_record',array('student_id'=>$stdInfo->student_id,'hostel_status_id'=>1));
                        $hoste_status = '';
                        if($hostel):
                            $hoste_status = ' - Hostel';

                        endif;
             ?>
            <div style="width:100%;">
            <div style="margin-top: 2px;width:32%;height:710px;border-right:2px dotted #000;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
              <div style="width:100%; float:left; height:138px; padding:20px;">
                <table class="table table-hover" id="table" style="margin-bottom: 1px;">
                    <tr>
                    <td style="border-top: 0px solid #000000;"> <img class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                    <td style="border-top: 0px solid #000000;"><img class="img-responsive pull-right" src="assets/RQ/challan_rq/<?=$stdInfo->fc_challan_rq?>" alt="Edwardes College Peshawar" width="80px;"  ></td> 
                 
                    </tr>
                  </table> 
                  <p style="font-size: 14px; text-align: center; font-weight: bold;">EDWARDES COLLEGE PESHAWAR</p>
                <p  style="font-size: 12px; text-align: center;"><strong><?php echo $stdInfo->BankName?><br>Acc No :(<?php echo $stdInfo->Bank_account_no?>)
                </strong></p>
                <div class="table-responsive">
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;"  >
                    <tr>
                        <td style="border-top: 0px solid #000000; font-size: 15px;">Challan# </td>
                        <td style="border-top: 0px solid #000000; font-size: 15px;"> <strong><?php echo $stdInfo->fc_challan_id?></strong> </td>  
                        <td style="border-top: 0px solid #000000; text-align: right"> <strong><?php  echo $stdInfo->subProName;?></strong> </td>  
<!--                        <td style="border-top: 0px solid #000000;">College #</td>
                        <td style="border-top: 0px solid #000000;"></td>-->
                     </tr>
                    <tr>
                        <td colspan="4" style="border-top: 0px solid #000000;">Name : <strong><?php echo $stdInfo->student_name?> &nbsp; &nbsp;C#<?php echo $stdInfo->college_no;?></strong></td>
<!--                        <td  style="border-top: 0px solid #000000;"></td>-->
                    </tr>
                    <tr>
                        <td colspan="4" style="border-top: 0px solid #000000;">Class :  <strong><?php echo $stdInfo->sectionName;?> </strong> </td>
                      <!--<td colspan="3" style="border-top: 0px solid #000000;"> </td>-->
                    </tr>
                    <tr>
                       <td colspan="2" style="border-top: 0px solid #000000;">Issue: <strong><?php echo date_format(date_create($stdInfo->fc_issue_date),"d-M-Y")?> </strong> </td>
                       <td colspan="2"style="border-top: 0px solid #000000; text-align: right;">Valid: <strong><?php echo date_format(date_create($stdInfo->fc_dueDate),"d-M-Y")?></strong></td>
                    </tr>
 
                  
                  </table>
                    
                    <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tr>
                        <td style="border-top: 0px solid #000000;">Instl:<strong><?php
//                         echo "<pre>";print_r($studentInfo);
                            $where =array(
                                          'sub_programes.sub_pro_id'=>$stdInfo->sub_pro_id,
                                          'batch_id'=>$stdInfo->batch_id,
                                          'fee_payment_category.pc_id'=>$stdInfo->fc_pay_cat_id,
                                      );
                                                 $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $pc_id = $this->db->where($where)->get('fee_payment_category')->row();
                                       
                                       if(!empty($pc_id)):
                                       echo $pc_id->title.''.$hoste_status;   
                                    endif; 
//                                     echo $pc_id->title.'   ('.$pc_id->name.')'; 
                                     
                                        
                        
                        
                        ?></strong></td>
                      
                    </tr>
                  </table> 
                    
                    
                  
              <br/>
              <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                      <td ><strong>Description</strong></td>
                      <td style="text-align: right;"><strong>Arrears</strong></td>
                      <td style="text-align: right;"><strong>Current</strong></td>
                      
                    </tr>
                    
                    
                    <?php
 
                    $where_heads = array(
                       'fc_student_id '=> $stdInfo->student_id,
                       'fc_paid_form <='=> $stdInfo ->fc_paid_form,
                       
                   );
     
                 $result        = $this->FeeModel->feeDetails_head_print($where_heads);
//                     echo '<pre>';print_r($result);die;      
                            
                      if($result):
                          
//                        $total_arrears      = '';
//                        $total_paid         = '';
//                        $current_amount     = '';
                        
                        
                        $current_amount = '';
                        $total_paid     = '';
                        
                        $total_current  = '';
                        $total_arrears  = '';
                        $gtotal          = '';
                        $g_total          = '';
                        $credit_amount = '';
                         
                        foreach($result as $resRow):
                             $where_arrears = array(
                                'fc_student_id '    => $stdInfo->student_id,
                                'fee_heads.fh_Id '  => $resRow ->fh_Id,
                                 'fc_challan_id'         => $stdInfo->fc_challan_id,
                                 'fc_paid_form <='  => $stdInfo ->fc_paid_form,
                                'old_balance_pc_id !='    => 0,
                                 'delete_head_flag'      => 1,
//                                'balance >'        =>0,
                            );
                              $Arrears_head_wise = $this->FeeModel->feeDetails_arrears_print($where_arrears); 
                              $arrears_amount = $Arrears_head_wise->sum_paid_amount;
                                      
                    
                        $where_current = array(
                                'fc_student_id'         => $stdInfo->student_id,
                                'fc_challan_id'         => $stdInfo->fc_challan_id,
                                'fee_heads.fh_Id '      => $resRow ->fh_Id,
                                'old_balance_pc_id '    => 0,
                                'delete_head_flag'      => 1,
 
                            );
                       
                       $Arrears_current_wise = $this->FeeModel->feeDetails_arrears_print($where_current);
                        $current_amount = $Arrears_current_wise->sum_paid_amount;
                        
                        
                    if($current_amount == 0 && $arrears_amount == 0):
                       else:
                        echo '<tr>
                                <td>'.$resRow->fh_head.'</td> ';
                        echo '<td style="text-align: right;">'.$arrears_amount.'</td>';
                          echo '<td style="text-align: right;">'.$current_amount.'</td>';
                       echo '  
                      
                    </tr>';
                     endif;
                 
                        
                        $total_current  += $current_amount;
                        $total_arrears  += $arrears_amount;
                        $credit_amount  += $resRow->old_credit_amount;
                        
                        endforeach;
                        
                                        $this->db->select('sum(concession_amount) as tota_conc_sum');
                                        $this->db->join("fee_concession_detail",'fee_concession_detail.concession_id=fee_concession_challan.concession_id');
                        $concession =   $this->db->where('fee_concession_detail.challan_id',$stdInfo->fc_challan_id)->get('fee_concession_challan')->row();                
 
                           $concession_amount = '';
                        if(!empty($concession->tota_conc_sum)):
                                echo '</table>';
                                echo '<table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">
                             <tr>
                                <td><strong>Concession Amount</strong></td>
                                <td style="text-align: right;">'.$concession->tota_conc_sum.'</td>

                            </tr>
                            </table>
                        ';
                                $concession_amount = $concession->tota_conc_sum;
                                else:
                                    $concession_amount = '';
                        endif;
                        
                        $gtotal = $total_current+$total_arrears;
//                        $g_total = $gtotal- $concession_amount;
              
                         if($credit_amount > 0):
                            
                             echo '<table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                                <tr>
                                 <td><strong>Old Credit Amount</strong></td>
                               <td style="text-align: right;"> '.$credit_amount.'</td>

                               </tr></table>';
                      $gtotal =  $gtotal-$credit_amount;
                        endif;
                        echo '
                     
                        </table>
                      
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                       <tr>
                        <td ><strong>Within due Date</strong></td>
                      <td style="text-align: right;">'.$gtotal.'</td>
                      
                      </tr>
      
                       ';
                     
                       
                    endif;
                    ?>
                    
                  </table>
               <br>
               <br>
               <br>
               <br>
               <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                      <td style="border-top: 0px solid #000000;">Comments:</td>
                        
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #000000;"><strong><?php echo $stdInfo->fc_comments?></strong></td>
                        
                    </tr>
                     <?php
                    
                if(!empty($concession->tota_conc_sum)):
                     
               ?>
               
               <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tr>
                        <td style="border: 1px solid #000000;">
                            
                                
                                <?php

                                
                                    echo '  <h6 align="center" ><strong>CONCESSION CHALLAN</strong></h6>';
                          

                                ?>
                            
                        </td>
                        
                    </tr>
                     
              </table>
               <?php
                   endif; 
                    
                    ?>
                  </tbody></table>
               
               <h6 align="center" >For Bank</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">(F#<strong><?php echo $stdInfo->form_no?>,<?php echo $stdInfo->batch_name?></strong> )Banker's stamp &amp; signature</strong></h6>
      
                </div>
              </div>
            </div>
          </div>
          
            <div style="width:100%;">
            <div style="margin-top: 2px;width:32%;height:710px;border-right:2px dotted #000;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
              <div style="width:100%; float:left; height:138px; padding:20px;">
                <table class="table table-hover" id="table" style="margin-bottom: 1px;">
                    <tr>
                    <td style="border-top: 0px solid #000000;"> <img class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                    <td style="border-top: 0px solid #000000;"><img class="img-responsive pull-right" src="assets/RQ/challan_rq/<?=$stdInfo->fc_challan_rq?>" alt="Edwardes College Peshawar" width="80px;"  ></td> 
                 
                    </tr>
                  </table> 
                  <p style="font-size: 14px; text-align: center; font-weight: bold;">EDWARDES COLLEGE PESHAWAR</p>
                <p  style="font-size: 12px; text-align: center;"><strong><?php echo $stdInfo->BankName?><br>Acc No :(<?php echo $stdInfo->Bank_account_no?>)
                </strong></p>
                <div class="table-responsive">
                   <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;"  >
                    <tr>
                        <td style="border-top: 0px solid #000000; font-size: 15px;">Challan# </td>
                        <td style="border-top: 0px solid #000000; font-size: 15px;"> <strong><?php echo $stdInfo->fc_challan_id?></strong> </td>  
                        <td style="border-top: 0px solid #000000; text-align: right"> <strong><?php  echo $stdInfo->subProName;?></strong> </td>  
<!--                        <td style="border-top: 0px solid #000000;">College #</td>
                        <td style="border-top: 0px solid #000000;"></td>-->
                     </tr>
                    <tr>
                        <td colspan="4" style="border-top: 0px solid #000000;">Name : <strong><?php echo $stdInfo->student_name?> &nbsp; &nbsp;C#<?php echo $stdInfo->college_no;?></strong></td>
<!--                        <td  style="border-top: 0px solid #000000;"></td>-->
                    </tr>
                    <tr>
                        <td colspan="4" style="border-top: 0px solid #000000;">Class :  <strong><?php echo $stdInfo->sectionName;?> </strong> </td>
                      <!--<td colspan="3" style="border-top: 0px solid #000000;"> </td>-->
                    </tr>
                    <tr>
                       <td colspan="2" style="border-top: 0px solid #000000;">Issue: <strong><?php echo date_format(date_create($stdInfo->fc_issue_date),"d-M-Y")?> </strong> </td>
                       <td colspan="2"style="border-top: 0px solid #000000; text-align: right;">Valid: <strong><?php echo date_format(date_create($stdInfo->fc_dueDate),"d-M-Y")?></strong></td>
                    </tr>
 
                  
                  </table>
                    
                    <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tr>
                        <td style="border-top: 0px solid #000000;">Instl:<strong><?php
//                         echo "<pre>";print_r($studentInfo);
                            $where =array(
                                          'sub_programes.sub_pro_id'=>$stdInfo->sub_pro_id,
                                          'batch_id'=>$stdInfo->batch_id,
                                          'fee_payment_category.pc_id'=>$stdInfo->fc_pay_cat_id,
                                      );
                                                 $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $pc_id = $this->db->where($where)->get('fee_payment_category')->row();
                                       
                                       if(!empty($pc_id)):
                                       echo $pc_id->title.''.$hoste_status;   
                                    endif; 
//                                     echo $pc_id->title.'   ('.$pc_id->name.')'; 
                                     
                                        
                        
                        
                        ?></strong></td>
                      
                    </tr>
                  </table> 
                    
              <br/>
                 <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                      <td ><strong>Description</strong></td>
                      <td style="text-align: right;"><strong>Arrears</strong></td>
                      <td style="text-align: right;"><strong>Current</strong></td>
                      
                    </tr>
                    
                    
                    <?php
 
                    $where_heads = array(
                       'fc_student_id '=> $stdInfo->student_id,
                       'fc_paid_form <='=> $stdInfo ->fc_paid_form,
                       
                   );
     
                 $result        = $this->FeeModel->feeDetails_head_print($where_heads);
//                     echo '<pre>';print_r($result);die;      
                            
                      if($result):
                          
//                        $total_arrears      = '';
//                        $total_paid         = '';
//                        $current_amount     = '';
                        
                        
                        $current_amount = '';
                        $total_paid     = '';
                        
                        $total_current  = '';
                        $total_arrears  = '';
                        $gtotal          = '';
                        $g_total          = '';
                        $credit_amount = '';
                         
                        foreach($result as $resRow):
                             $where_arrears = array(
                                'fc_student_id '    => $stdInfo->student_id,
                                'fee_heads.fh_Id '  => $resRow ->fh_Id,
                                 'fc_challan_id'         => $stdInfo->fc_challan_id,
                                 'fc_paid_form <='  => $stdInfo ->fc_paid_form,
                                'old_balance_pc_id !='    => 0,
                                 'delete_head_flag'      => 1,
//                                'balance >'        =>0,
                            );
                              $Arrears_head_wise = $this->FeeModel->feeDetails_arrears_print($where_arrears); 
                              $arrears_amount = $Arrears_head_wise->sum_paid_amount;
                                      
                    
                        $where_current = array(
                                'fc_student_id'         => $stdInfo->student_id,
                                'fc_challan_id'         => $stdInfo->fc_challan_id,
                                'fee_heads.fh_Id '      => $resRow ->fh_Id,
                                'old_balance_pc_id '    => 0,
                            'delete_head_flag'      => 1,
 
                            );
                       
                       $Arrears_current_wise = $this->FeeModel->feeDetails_arrears_print($where_current);
                        $current_amount = $Arrears_current_wise->sum_paid_amount;
                        
                        
                    if($current_amount == 0 && $arrears_amount == 0):
                       else:
                        echo '<tr>
                                <td>'.$resRow->fh_head.'</td> ';
                        echo '<td style="text-align: right;">'.$arrears_amount.'</td>';
                          echo '<td style="text-align: right;">'.$current_amount.'</td>';
                       echo '  
                      
                    </tr>';
                     endif;
                 
                        
                        $total_current  += $current_amount;
                        $total_arrears  += $arrears_amount;
                        $credit_amount  += $resRow->old_credit_amount;
                        
                        endforeach;
                        
                                        $this->db->select('sum(concession_amount) as tota_conc_sum');
                                        $this->db->join("fee_concession_detail",'fee_concession_detail.concession_id=fee_concession_challan.concession_id');
                        $concession =   $this->db->where('fee_concession_detail.challan_id',$stdInfo->fc_challan_id)->get('fee_concession_challan')->row();                
 
                           $concession_amount = '';
                        if(!empty($concession->tota_conc_sum)):
                                echo '</table>';
                                echo '<table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">
                             <tr>
                                <td><strong>Concession Amount</strong></td>
                                <td style="text-align: right;">'.$concession->tota_conc_sum.'</td>

                            </tr>
                            </table>
                        ';
                                $concession_amount = $concession->tota_conc_sum;
                                else:
                                    $concession_amount = '';
                        endif;
                        
                        $gtotal = $total_current+$total_arrears;
//                        $g_total = $gtotal- $concession_amount;
              
                         if($credit_amount > 0):
                            
                             echo '<table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                                <tr>
                                 <td><strong>Old Credit Amount</strong></td>
                               <td style="text-align: right;"> '.$credit_amount.'</td>

                               </tr></table>';
                      $gtotal =  $gtotal-$credit_amount;
                        endif;
                        echo '
                     
                        </table>
                      
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                       <tr>
                        <td ><strong>Within due Date</strong></td>
                      <td style="text-align: right;">'.$gtotal.'</td>
                      
                      </tr>
      
                       ';
                     
                       
                    endif;
                    ?>
                    
                  </table>
               <br>
               <br>
               <br>
               <br>
               <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                      <td style="border-top: 0px solid #000000;">Comments:</td>
                        
                    </tr>
                    
                    <tr>
                      <td style="border-top: 0px solid #000000;"><strong><?php echo $stdInfo->fc_comments?></strong></td>
                        
                    </tr>
                     <?php
                    
                if(!empty($concession->tota_conc_sum)):
                     
               ?>
               
               <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tr>
                        <td style="border: 1px solid #000000;">
                            
                                
                                <?php

                                
                                    echo '  <h6 align="center" ><strong>CONCESSION CHALLAN</strong></h6>';
                          

                                ?>
                            
                        </td>
                        
                    </tr>
                     
              </table>
               <?php
                   endif; 
                    
                    ?>
                  </tbody></table>
               
               <h6 align="center" >For College</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">(F#<strong><?php echo $stdInfo->form_no?>,<?php echo $stdInfo->batch_name?></strong>)Banker's stamp &amp; signature</strong></h6>
      
                </div>
              </div>
            </div>
          </div>
          
            <div style="width:100%;">
            <div style="margin-top: 2px;width:32%;height:710px;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
              <div style="width:100%; float:left; height:138px; padding:20px;">
                <table class="table table-hover" id="table" style="margin-bottom: 1px;">
                    <tr>
                    <td style="border-top: 0px solid #000000;"> <img class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                    <td style="border-top: 0px solid #000000;"><img class="img-responsive pull-right" src="assets/RQ/challan_rq/<?=$stdInfo->fc_challan_rq?>" alt="Edwardes College Peshawar" width="80px;"  ></td> 
                 
                    </tr>
                  </table> 
                  <p style="font-size: 14px; text-align: center; font-weight: bold;">EDWARDES COLLEGE PESHAWAR</p>
                <p  style="font-size: 12px; text-align: center;"><strong><?php echo $stdInfo->BankName?><br>Acc No :(<?php echo $stdInfo->Bank_account_no?>)
                </strong></p>
                <div class="table-responsive">
                   <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;"  >
                    <tr>
                        <td style="border-top: 0px solid #000000; font-size: 15px;">Challan# </td>
                        <td style="border-top: 0px solid #000000; font-size: 15px;"> <strong><?php echo $stdInfo->fc_challan_id?></strong> </td>  
                        <td style="border-top: 0px solid #000000; text-align: right"> <strong><?php  echo $stdInfo->subProName;?></strong> </td>  
<!--                        <td style="border-top: 0px solid #000000;">College #</td>
                        <td style="border-top: 0px solid #000000;"></td>-->
                     </tr>
                    <tr>
                        <td colspan="4" style="border-top: 0px solid #000000;">Name : <strong><?php echo $stdInfo->student_name?> &nbsp; &nbsp;C#<?php echo $stdInfo->college_no;?></strong></td>
<!--                        <td  style="border-top: 0px solid #000000;"></td>-->
                    </tr>
                    <tr>
                        <td colspan="4" style="border-top: 0px solid #000000;">Class :  <strong><?php echo $stdInfo->sectionName;?> </strong> </td>
                      <!--<td colspan="3" style="border-top: 0px solid #000000;"> </td>-->
                    </tr>
                    <tr>
                       <td colspan="2" style="border-top: 0px solid #000000;">Issue: <strong><?php echo date_format(date_create($stdInfo->fc_issue_date),"d-M-Y")?> </strong> </td>
                       <td colspan="2"style="border-top: 0px solid #000000; text-align: right;">Valid: <strong><?php echo date_format(date_create($stdInfo->fc_dueDate),"d-M-Y")?></strong></td>
                    </tr>
 
                  
                  </table>
                    
                    <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tr>
                        <td style="border-top: 0px solid #000000;">Instl:<strong><?php
//                         echo "<pre>";print_r($studentInfo);
                            $where =array(
                                          'sub_programes.sub_pro_id'=>$stdInfo->sub_pro_id,
                                          'batch_id'=>$stdInfo->batch_id,
                                          'fee_payment_category.pc_id'=>$stdInfo->fc_pay_cat_id,
                                      );
                                                 $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $pc_id = $this->db->where($where)->get('fee_payment_category')->row();
                                       
                                       if(!empty($pc_id)):
                                       echo $pc_id->title.''.$hoste_status;   
                                    endif; 
//                                     echo $pc_id->title.'   ('.$pc_id->name.')'; 
                                     
                                        
                        
                        
                        ?></strong></td>
                      
                    </tr>
                  </table> 
                    
                    
                  
              <br/>
                 <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                      <td ><strong>Description</strong></td>
                      <td style="text-align: right;"><strong>Arrears</strong></td>
                      <td style="text-align: right;"><strong>Current</strong></td>
                      
                    </tr>
                    
                    
                    <?php
 
                    $where_heads = array(
                       'fc_student_id '=> $stdInfo->student_id,
                       'fc_paid_form <='=> $stdInfo ->fc_paid_form,
                       
                   );
     
                 $result        = $this->FeeModel->feeDetails_head_print($where_heads);
//                     echo '<pre>';print_r($result);die;      
                            
                      if($result):
                          
//                        $total_arrears      = '';
//                        $total_paid         = '';
//                        $current_amount     = '';
                        
                        
                        $current_amount = '';
                        $total_paid     = '';
                        
                        $total_current  = '';
                        $total_arrears  = '';
                        $gtotal          = '';
                        $g_total          = '';
                        $credit_amount = '';
                         
                        foreach($result as $resRow):
                             $where_arrears = array(
                                'fc_student_id '    => $stdInfo->student_id,
                                'fee_heads.fh_Id '  => $resRow ->fh_Id,
                                 'fc_challan_id'         => $stdInfo->fc_challan_id,
                                 'fc_paid_form <='  => $stdInfo ->fc_paid_form,
                                'old_balance_pc_id !='    => 0,
                                 'delete_head_flag'      => 1,
//                                'balance >'        =>0,
                            );
                              $Arrears_head_wise = $this->FeeModel->feeDetails_arrears_print($where_arrears); 
                              $arrears_amount = $Arrears_head_wise->sum_paid_amount;
                                      
                    
                        $where_current = array(
                                'fc_student_id'         => $stdInfo->student_id,
                                'fc_challan_id'         => $stdInfo->fc_challan_id,
                                'fee_heads.fh_Id '      => $resRow ->fh_Id,
                                'old_balance_pc_id '    => 0,
                            'delete_head_flag'      => 1,
 
                            );
                       
                       $Arrears_current_wise = $this->FeeModel->feeDetails_arrears_print($where_current);
                        $current_amount = $Arrears_current_wise->sum_paid_amount;
                        
                        
                    if($current_amount == 0 && $arrears_amount == 0):
                       else:
                        echo '<tr>
                                <td>'.$resRow->fh_head.'</td> ';
                        echo '<td style="text-align: right;">'.$arrears_amount.'</td>';
                          echo '<td style="text-align: right;">'.$current_amount.'</td>';
                       echo '  
                      
                    </tr>';
                     endif;
                 
                        
                        $total_current  += $current_amount;
                        $total_arrears  += $arrears_amount;
                        $credit_amount  += $resRow->old_credit_amount;
                        
                        endforeach;
                        
                                        $this->db->select('sum(concession_amount) as tota_conc_sum');
                                        $this->db->join("fee_concession_detail",'fee_concession_detail.concession_id=fee_concession_challan.concession_id');
                        $concession =   $this->db->where('fee_concession_detail.challan_id',$stdInfo->fc_challan_id)->get('fee_concession_challan')->row();                
 
                           $concession_amount = '';
                        if(!empty($concession->tota_conc_sum)):
                                echo '</table>';
                                echo '<table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">
                             <tr>
                                <td><strong>Concession Amount</strong></td>
                                <td style="text-align: right;">'.$concession->tota_conc_sum.'</td>

                            </tr>
                            </table>
                        ';
                                $concession_amount = $concession->tota_conc_sum;
                                else:
                                    $concession_amount = '';
                        endif;
                        
                        $gtotal = $total_current+$total_arrears;
//                        $g_total = $gtotal- $concession_amount;
              
                         if($credit_amount > 0):
                            
                             echo '<table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                                <tr>
                                 <td><strong>Old Credit Amount</strong></td>
                               <td style="text-align: right;"> '.$credit_amount.'</td>

                               </tr></table>';
                      $gtotal =  $gtotal-$credit_amount;
                        endif;
                        echo '
                     
                        </table>
                      
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                       <tr>
                        <td ><strong>Within due Date</strong></td>
                      <td style="text-align: right;">'.$gtotal.'</td>
                      
                      </tr>
      
                       ';
                     
                       
                    endif;
                    ?>
                    
                  </table>
               <br>
               <br>
               <br>
               <br>
               <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                      <td style="border-top: 0px solid #000000;">Comments:</td>
                        
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #000000;"><strong><?php echo $stdInfo->fc_comments?></strong></td>
                        
                    </tr>
                    <?php
                    
                if(!empty($concession->tota_conc_sum)):
                     
               ?>
               
               <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tr>
                        <td style="border: 1px solid #000000;">
                            
                                
                                <?php

                                
                                    echo '  <h6 align="center" ><strong>CONCESSION CHALLAN</strong></h6>';
                          

                                ?>
                            
                        </td>
                        
                    </tr>
                     
              </table>
               <?php
                   endif; 
                    
                    ?>
                  </tbody></table>
               
               <h6 align="center" >For Student</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">(F#<strong><?php echo $stdInfo->form_no?>,<?php echo $stdInfo->batch_name?></strong>)Banker's stamp &amp; signature</strong></h6>
      
                </div>
              </div>
            </div>
          </div>
          
            
    
                 
                 <?php
                  endif;
             endforeach;
         endif;
         ?>   
            
            
       
           
  
 
        </div>
      </div>
    </div>
  </div>
</div>
<!--//page-row-->
</div>
