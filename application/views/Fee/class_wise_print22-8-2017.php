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
                <p  style="font-size: 12px;"><strong><?php echo $stdInfo->BankName?><br>Acc No :(<?php echo $stdInfo->Bank_account_no?>)
                </strong></p>
                <div class="table-responsive">
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;"  >
                    <tbody><tr>
                        <td style="border-top: 0px solid #000000;">College #</td>
                      <td style="border-top: 0px solid #000000;"><strong><?php echo $stdInfo->college_no?></strong></td>
                                
                      <td style="border-top: 0px solid #000000;">Challan# </td>
                      <td style="border-top: 0px solid #000000;"> <strong><?php echo $stdInfo->fc_challan_id?></strong> </td>  
                    </tr>
                  </tbody></table>       
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                        <td style="border-top: 0px solid #000000;">Name</td>
                        <td style="border-top: 0px solid #000000;"><strong><?php echo $stdInfo->student_name?></strong></td>
                    </tr>
                  </tbody></table>       
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                      <td style="border-top: 0px solid #000000;">Class </td>
                      <td style="border-top: 0px solid #000000;"> <strong><?php echo $stdInfo->sectionName?> (<?php echo $stdInfo->subProName?>) </strong> </td>
                    </tr>
                  </tbody></table>       
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                      <td style="border-top: 0px solid #000000;">Issue Date </td>
                      <td style="border-top: 0px solid #000000;"> <strong><?=date_format(date_create($stdInfo->fc_paid_form),"d-M-Y")?></strong> </td>
                        <td style="border-top: 0px solid #000000;">Due Date</td>
                      <td style="border-top: 0px solid #000000;"><strong><?=date_format(date_create($stdInfo->fc_paid_upto),"d-M-Y")?></strong></td>
            
                    </tr>
                  </tbody></table>
               <br>
                 
          
                 <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                      <td ><strong>Description</strong></td>
                      <td><strong>Arrears</strong></td>
                      <td><strong>Current</strong></td>
                      
                    </tr>
                    
                    
                    <?php
 
                    $where = array(
                       'fc_student_id '=> $stdInfo->student_id,
                       'fc_paid_form <='=> $stdInfo ->fc_paid_form,
                       
                   );
     
                 $result        = $this->FeeModel->feeDetails_head_print($where);
                    
                    
                    
                    if($result):
                         $total_arrears  = 0;
                        $total_paid     = 0;
                        $current_amount     = 0;
                        
                        foreach($result as $resRow):
                             $where_arrears = array(
                                'fc_student_id '    => $stdInfo->student_id,
                                'fee_heads.fh_Id '  => $resRow ->fh_Id,
                                'fc_paid_form <'    => $stdInfo ->fc_paid_form,
//                                'balance !='      =>0,
                            );
                              $Arrears_head_wise = $this->FeeModel->feeDetails_arrears_print($where_arrears); 
                              $arrears_amount = $Arrears_head_wise->arrears_balance;
                                      
                    
                        $where_current = array(
                                'fc_student_id'         => $stdInfo->student_id,
                                'fee_heads.fh_Id '       => $resRow ->fh_Id,
                                'fc_paid_form '         => $stdInfo ->fc_paid_form,
 
                            );
                       
                       $Arrears_current_wise = $this->FeeModel->feeDetails_arrears_print($where_current);
                        $current_amount = $Arrears_current_wise->sum_paid_amount;
                        
                        
                    if($current_amount==0 && $arrears_amount == 0):
                       else:
                           echo '<tr>
                            <td>'.$resRow->fh_head.'</td> ';
                        echo '<td>'.$arrears_amount.'  </td>';
                          echo '<td>'.$current_amount.'  </td>';
                       echo '  
                      
                    </tr>';
                     endif;
                 
                        
                        $total_arrears += $current_amount;
                        $total_arrears += $arrears_amount;
                        $total_paid    += $resRow->paid_amount;
                        
                        endforeach;
              
                        echo '
                     
                        </table>
                      
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                       <tr>
                        <td><strong>Within due Date</strong></td>
                      <td>'.$total_arrears.'</td>
                      <td> </td>
                      </tr>
      
                      <tr>
                
                      <td><strong>After due Date</strong></td>
                      <td>'.$total_arrears.'</td>
                      <td> </td>
                      </tr>';
                         
                             if($stdInfo->fc_challan_type == 4):
                             echo '
                     
                        </table>
                      
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                            
                 
      
                      <tr>
                
                      <td><strong>Installment Challan</strong></td>
                      <td>'.$total_paid.'</td>
                      <td> </td>
                      </tr>';
                        endif;
                       
                    endif;
                    ?>
                    
                  </table>
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
                  </tbody></table>
               
               <h6 align="center" >For Bank</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">Banker's stamp &amp; signature</h6>
      
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
                <p  style="font-size: 12px;"><strong><?php echo $stdInfo->BankName?><br>Acc No :(<?php echo $stdInfo->Bank_account_no?>)
                </strong></p>
                <div class="table-responsive">
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;"  >
                    <tbody><tr>
                        <td style="border-top: 0px solid #000000;">College #</td>
                      <td style="border-top: 0px solid #000000;"><strong><?php echo $stdInfo->college_no?></strong></td>
                                
                      <td style="border-top: 0px solid #000000;">Challan# </td>
                      <td style="border-top: 0px solid #000000;"> <strong><?php echo $stdInfo->fc_challan_id?></strong> </td>  
                    </tr>
                  </tbody></table>       
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                        <td style="border-top: 0px solid #000000;">Name</td>
                        <td style="border-top: 0px solid #000000;"><strong><?php echo $stdInfo->student_name?></strong></td>
                    </tr>
                  </tbody></table>       
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                      <td style="border-top: 0px solid #000000;">Class </td>
                      <td style="border-top: 0px solid #000000;"> <strong><?php echo $stdInfo->sectionName?> (<?php echo $stdInfo->subProName?>) </strong> </td>
                    </tr>
                  </tbody></table>       
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                      <td style="border-top: 0px solid #000000;">Issue Date </td>
                      <td style="border-top: 0px solid #000000;"> <strong><?=date_format(date_create($stdInfo->fc_paid_form),"d-M-Y")?></strong> </td>
                        <td style="border-top: 0px solid #000000;">Due Date</td>
                      <td style="border-top: 0px solid #000000;"><strong><?=date_format(date_create($stdInfo->fc_paid_upto),"d-M-Y")?></strong></td>
            
                    </tr>
                  </tbody></table>
               <br>
                 
          
                 <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                      <td ><strong>Description</strong></td>
                      <td><strong>Arrears</strong></td>
                      <td><strong>Current</strong></td>
                      
                    </tr>
                    
                    
                    <?php
 
                    $where = array(
                       'fc_student_id '=> $stdInfo->student_id,
                       'fc_paid_form <='=> $stdInfo ->fc_paid_form,
                       
                   );
     
                 $result        = $this->FeeModel->feeDetails_head_print($where);
                    
                    
                    
                    if($result):
                         $total_arrears  = 0;
                        $total_paid     = 0;
                        $current_amount     = 0;
                        
                        foreach($result as $resRow):
                             $where_arrears = array(
                                'fc_student_id '    => $stdInfo->student_id,
                                'fee_heads.fh_Id '  => $resRow ->fh_Id,
                                'fc_paid_form <'    => $stdInfo ->fc_paid_form,
//                                'balance !='      =>0,
                            );
                              $Arrears_head_wise = $this->FeeModel->feeDetails_arrears_print($where_arrears); 
                              $arrears_amount = $Arrears_head_wise->arrears_balance;
                                      
                    
                        $where_current = array(
                                'fc_student_id'         => $stdInfo->student_id,
                                'fee_heads.fh_Id '       => $resRow ->fh_Id,
                                'fc_paid_form '         => $stdInfo ->fc_paid_form,
 
                            );
                       
                       $Arrears_current_wise = $this->FeeModel->feeDetails_arrears_print($where_current);
                        $current_amount = $Arrears_current_wise->sum_paid_amount;
                        
                      if($current_amount==0 && $arrears_amount == 0):
                       else:
                           echo '<tr>
                            <td>'.$resRow->fh_head.'</td> ';
                        echo '<td>'.$arrears_amount.'  </td>';
                          echo '<td>'.$current_amount.'  </td>';
                       echo '  
                      
                    </tr>';
                     endif;
                        
                        $total_arrears += $current_amount;
                        $total_arrears += $arrears_amount;
                        $total_paid    += $resRow->paid_amount;
                        
                        endforeach;
              
                        echo '
                     
                        </table>
                      
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                       <tr>
                        <td><strong>Within due Date</strong></td>
                      <td>'.$total_arrears.'</td>
                      <td> </td>
                      </tr>
      
                      <tr>
                
                      <td><strong>After due Date</strong></td>
                      <td>'.$total_arrears.'</td>
                      <td> </td>
                      </tr>';
                         
                             if($stdInfo->fc_challan_type == 4):
                             echo '
                     
                        </table>
                      
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                            
                 
      
                      <tr>
                
                      <td><strong>Installment Challan</strong></td>
                      <td>'.$total_paid.'</td>
                      <td> </td>
                      </tr>';
                        endif;
                       
                    endif;
                    ?>
                    
                  </table>
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
                  </tbody></table>
               
               <h6 align="center" >For Bank</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">Banker's stamp &amp; signature</h6>
      
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
                <p  style="font-size: 12px;"><strong><?php echo $stdInfo->BankName?><br>Acc No :(<?php echo $stdInfo->Bank_account_no?>)
                </strong></p>
                <div class="table-responsive">
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;"  >
                    <tbody><tr>
                        <td style="border-top: 0px solid #000000;">College #</td>
                      <td style="border-top: 0px solid #000000;"><strong><?php echo $stdInfo->college_no?></strong></td>
                                
                      <td style="border-top: 0px solid #000000;">Challan# </td>
                      <td style="border-top: 0px solid #000000;"> <strong><?php echo $stdInfo->fc_challan_id?></strong> </td>  
                    </tr>
                  </tbody></table>       
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                        <td style="border-top: 0px solid #000000;">Name</td>
                        <td style="border-top: 0px solid #000000;"><strong><?php echo $stdInfo->student_name?></strong></td>
                    </tr>
                  </tbody></table>       
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                      <td style="border-top: 0px solid #000000;">Class </td>
                      <td style="border-top: 0px solid #000000;"> <strong><?php echo $stdInfo->sectionName?> (<?php echo $stdInfo->subProName?>) </strong> </td>
                    </tr>
                  </tbody></table>       
                  <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody><tr>
                      <td style="border-top: 0px solid #000000;">Issue Date </td>
                      <td style="border-top: 0px solid #000000;"> <strong><?=date_format(date_create($stdInfo->fc_paid_form),"d-M-Y")?></strong> </td>
                        <td style="border-top: 0px solid #000000;">Due Date</td>
                      <td style="border-top: 0px solid #000000;"><strong><?=date_format(date_create($stdInfo->fc_paid_upto),"d-M-Y")?></strong></td>
            
                    </tr>
                  </tbody></table>
               <br>
                 
          
                 <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                      <td ><strong>Description</strong></td>
                      <td><strong>Arrears</strong></td>
                      <td><strong>Current</strong></td>
                      
                    </tr>
                    
                    
                    <?php
 
                    $where = array(
                       'fc_student_id '=> $stdInfo->student_id,
                       'fc_paid_form <='=> $stdInfo ->fc_paid_form,
                       
                   );
     
                 $result        = $this->FeeModel->feeDetails_head_print($where);
                    
                    
                    
                    if($result):
                         $total_arrears  = 0;
                        $total_paid     = 0;
                        $current_amount     = 0;
                        
                        foreach($result as $resRow):
                             $where_arrears = array(
                                'fc_student_id '    => $stdInfo->student_id,
                                'fee_heads.fh_Id '  => $resRow ->fh_Id,
                                'fc_paid_form <'    => $stdInfo ->fc_paid_form,
//                                'balance !='      =>0,
                            );
                              $Arrears_head_wise = $this->FeeModel->feeDetails_arrears_print($where_arrears); 
                              $arrears_amount = $Arrears_head_wise->arrears_balance;
                                      
                    
                        $where_current = array(
                                'fc_student_id'         => $stdInfo->student_id,
                                'fee_heads.fh_Id '       => $resRow ->fh_Id,
                                'fc_paid_form '         => $stdInfo ->fc_paid_form,
 
                            );
                       
                       $Arrears_current_wise = $this->FeeModel->feeDetails_arrears_print($where_current);
                        $current_amount = $Arrears_current_wise->sum_paid_amount;
                        
                    if($current_amount==0 && $arrears_amount == 0):
                       else:
                           echo '<tr>
                            <td>'.$resRow->fh_head.'</td> ';
                        echo '<td>'.$arrears_amount.'  </td>';
                          echo '<td>'.$current_amount.'  </td>';
                       echo '  
                      
                    </tr>';
                     endif;
                        
                        $total_arrears += $current_amount;
                        $total_arrears += $arrears_amount;
                        $total_paid    += $resRow->paid_amount;
                        
                        endforeach;
              
                        echo '
                     
                        </table>
                      
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                       <tr>
                        <td><strong>Within due Date</strong></td>
                      <td>'.$total_arrears.'</td>
                      <td> </td>
                      </tr>
      
                      <tr>
                
                      <td><strong>After due Date</strong></td>
                      <td>'.$total_arrears.'</td>
                      <td> </td>
                      </tr>';
                         
                             if($stdInfo->fc_challan_type == 4):
                             echo '
                     
                        </table>
                      
                        <table class="table table-hover" id="table" style="margin-bottom: 1px; border: 1px solid;">    
                            
                 
      
                      <tr>
                
                      <td><strong>Installment Challan</strong></td>
                      <td>'.$total_paid.'</td>
                      <td> </td>
                      </tr>';
                        endif;
                       
                    endif;
                    ?>
                    
                  </table>
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
                  </tbody></table>
               
               <h6 align="center" >For Bank</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">Banker's stamp &amp; signature</h6>
      
                </div>
              </div>
            </div>
          </div>
            
 
            
    
                 
                 <?php
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
