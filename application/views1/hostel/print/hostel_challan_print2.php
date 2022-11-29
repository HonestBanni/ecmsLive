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
            <?php
            
           
            echo anchor('admin/admin_home', 'Home');?> 
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
      <br/>
      <div class="row">
        <div id="div_print">
        
          <div style="width:100%;">
            <div style="margin-top: 2px;width:32%;height:710px;border-right:2px dotted #000;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
              <div style="width:100%; float:left; height:138px; padding:20px;">
                <table class="table table-hover" id="table" style="margin-bottom: 1px;">
                    <tr>
                    <td style="border-top: 0px solid #000000;"> <img class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                    <td style="border-top: 0px solid #000000;"><img class="img-responsive pull-right" src="assets/RQ/hostel_rq/<?php echo $this->uri->segment(3)?>.png" alt="Studetn RQ" width="80px;"  ></td> 
                 
                    </tr>
                  </table> 
                   <?php
                       
                      if($extra_info->head_type == 2):
                          echo '<h2 style="font-size: 22px; text-align: center; ">Mess Bill</h2>';
                      else:
                          echo '<h2 style="font-size: 22px; text-align: center; ">Hostel Bill</h2>';
                      endif;
                      ?>
                  
                  <p style="font-size: 11px; text-align: center; ">
                   <strong>EDWARDES COLLEGE PESHAWAR</strong><br/><?php echo $extra_info->bank_name?>-<?php echo $extra_info->address?>
                  <br/>ACCOUNT NUMBER : <?php echo $extra_info->account_no?>
                </p>
                 
                  
                <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                        <th colspan="4"  style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Particulars Of Student</th>
                     </tr>
                     <tr>
                      
                         <td  colspan="4" style="border: 1px solid #000000;font-size: 18px;"><strong>Challan # &nbsp;&nbsp;<?php echo $extra_info->challan_id?></td>
<!--                        <td  colspan="2" style="border: 1px solid #000000;font-size: 18px;"></strong></td>-->
                        
                     </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>Issue</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->issue_date))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>Valid</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->valid_date))?></strong></td>
                      
                    </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>From</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->date_from))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>To</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->date_to))?></strong></td>
                      
                    </tr>
                    
                    <tr>
                      
                        <td colspan="4" style="border: 1px solid #000000;">Student Name &nbsp;&nbsp;<strong><?php echo $studentInfo->student_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"></td>-->
                     </tr>
                    <tr>
                      
                      <td colspan="4" style="border: 1px solid #000000;">Father Name &nbsp;&nbsp;<strong><?php echo $studentInfo->father_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"><strong><?php // echo $studentInfo->father_name?></strong></td>-->
                     </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #000000;">College # &nbsp;&nbsp;<strong><?php echo $studentInfo->college_no?></strong></td>
                         
                       <td  colspan="2" style="border: 1px solid #000000;">Group &nbsp;&nbsp; <strong><?php echo $studentInfo->name?></strong></td> 
                      <!--<td  style="border: 1px solid #000000;"></td>-->
                    
                    
                     </tr>
                    
                      
                  </table>
                <br/>
                <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 12px;">    
                     <tr>
                      
                        <th colspan="3" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Detail Of Hostel Fee</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Arrears</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Current</th>
                     </tr>
                          
                     <?php
                     $total = '';
                     if($extra_info->head_type == 2):
                         
                         
                         
                         foreach($challan_info as $ch_Row):
                         
                         
                             
                         echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                         //Balance amount
                         $balance_where = array(
                           'hostel_student_bill.id'                     => $extra_info->challan_id,  
                           'hostel_head_title.id'                       => $ch_Row->head_id,  
                           'hostel_student_bill_info.old_challan_id !=' => 0
                         );
                         
                         
                         $balace_info = $this->HostelModel->hostel_challan_info_row($balance_where);
//                        echo '<pre>';print_r($balace_info);
                         $balance = '';
                         if(empty($balace_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$balace_info->amount.'</td>';
                            $balance =  $balace_info->amount;
                         endif;
                         
                         
                         //Current amount
                         $current_where = array(
                            'hostel_student_bill.id'                    => $extra_info->challan_id,  
                              'hostel_head_title.id'                    => $ch_Row->head_id,   
                           'hostel_student_bill_info.old_challan_id '   => 0
                         );
                         
                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
                         
                         
//                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
//                         echo '<pre>';print_r($current_info);
                         $current = '';
                         if(empty($current_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$current_info->amount.'</td>';
                            $current =  $current_info->amount;
                         endif;
                         
//                         echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$ch_Row->amount.'</td> ';
                       echo '</tr>';
                         $total += $balance; 
                         $total += $current; 
                       
                          
                         endforeach;
                         else:
                           
                        foreach($challan_info as $ch_Row):
                             
                         echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                         //Balance amount
                         $balance_where = array(
                           'hostel_student_bill.id'                     => $extra_info->challan_id,  
                           'hostel_head_title.id'                       => $ch_Row->head_id,  
                           'hostel_student_bill_info.old_challan_id !=' => 0
                         );
                         
                         
                         $balace_info = $this->HostelModel->hostel_challan_info_row($balance_where);
//                        echo '<pre>';print_r($balace_info);
                         $balance = '';
                         if(empty($balace_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$balace_info->amount.'</td>';
                            $balance =  $balace_info->amount;
                         endif;
                         
                         
                         //Current amount
                         $current_where = array(
                            'hostel_student_bill.id'                    => $extra_info->challan_id,  
                              'hostel_head_title.id'                    => $ch_Row->head_id,   
                           'hostel_student_bill_info.old_challan_id '   => 0
                         );
                         
                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
                         
                         
//                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
//                         echo '<pre>';print_r($current_info);
                         $current = '';
                         if(empty($current_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$current_info->amount.'</td>';
                            $current =  $current_info->amount;
                         endif;
                         
//                         echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$ch_Row->amount.'</td> ';
                       echo '</tr>';
                         $total += $balance; 
                         $total += $current; 
                       
                         endforeach;
                       
                     endif;
                     
                   
                     
                     ?>
                </table>
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                    <tr>
                     
                      <td style="border-top: 0px solid #000000; text-align: left;"><strong>TOTAL AMOUNT FEE[PKR]</strong></td>
                      <td style="border-top: 0px solid #000000;     border-bottom: 2px solid #000000; text-align: right;"><strong><?php echo $total?></strong></td>
                    </tr>
                  </table>  
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody>
                    <tr>
                      <td style="border-top: 0px solid #000000;">Comments:</td>
                        
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #000000;"><?php echo $extra_info->comments?></td>
                        
                    </tr>
                      </table>
                
                <div class="table-responsive">
                         
                        
                  
               <br/>
               <br/>
               
               
               
               <h6 align="center">For Bank</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">F# (<strong><?php echo $studentInfo->form_no.','.$studentInfo->batch_name; ?></strong>)Banker's stamp & signature</h6>
      
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
                    <td style="border-top: 0px solid #000000;"><img class="img-responsive pull-right" src="assets/RQ/hostel_rq/<?php echo $this->uri->segment(3)?>.png" alt="Studetn RQ" width="80px;"  ></td> 
                 
                    </tr>
                  </table> 
                   <?php
                       
                      if($extra_info->head_type == 2):
                          echo '<h2 style="font-size: 22px; text-align: center; ">Mess Bill</h2>';
                      else:
                          echo '<h2 style="font-size: 22px; text-align: center; ">Hostel Bill</h2>';
                      endif;
                      ?>
                  
                  <p style="font-size: 11px; text-align: center; ">
                   <strong>EDWARDES COLLEGE PESHAWAR</strong><br/><?php echo $extra_info->bank_name?>-<?php echo $extra_info->address?>
                  <br/>ACCOUNT NUMBER : <?php echo $extra_info->account_no?>
                </p>
                 
                   
                 <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                        <th colspan="4"  style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Particulars Of Student</th>
                     </tr>
                     <tr>
                      
                         <td  colspan="4" style="border: 1px solid #000000;font-size: 18px;"><strong>Challan # &nbsp;&nbsp;<?php echo $extra_info->challan_id?></td>
<!--                        <td  colspan="2" style="border: 1px solid #000000;font-size: 18px;"></strong></td>-->
                        
                     </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>Issue</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->issue_date))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>Valid</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->valid_date))?></strong></td>
                      
                    </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>From</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->date_from))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>To</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->date_to))?></strong></td>
                      
                    </tr>
                    
                    <tr>
                      
                        <td colspan="4" style="border: 1px solid #000000;">Student Name &nbsp;&nbsp;<strong><?php echo $studentInfo->student_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"></td>-->
                     </tr>
                    <tr>
                      
                      <td colspan="4" style="border: 1px solid #000000;">Father Name &nbsp;&nbsp;<strong><?php echo $studentInfo->father_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"><strong><?php // echo $studentInfo->father_name?></strong></td>-->
                     </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #000000;">College # &nbsp;&nbsp;<strong><?php echo $studentInfo->college_no?></strong></td>
                         
                       <td  colspan="2" style="border: 1px solid #000000;">Group &nbsp;&nbsp; <strong><?php echo $studentInfo->name?></strong></td> 
                      <!--<td  style="border: 1px solid #000000;"></td>-->
                    
                    
                     </tr>
                    
                      
                  </table>
                <br/>
                <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                        <th colspan="3" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Detail Of Hostel Fee</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Arrears</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Current</th>
                     </tr>
                          
                     <?php
                     $total = '';
                     if($extra_info->head_type == 2):
                         foreach($challan_info as $ch_Row):
                         echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                         //Balance amount
                         $balance_where = array(
                           'hostel_student_bill.id'                     => $extra_info->challan_id,  
                           'hostel_head_title.id'                       => $ch_Row->head_id,  
                           'hostel_student_bill_info.old_challan_id !=' => 0
                         );
                         
                         
                         $balace_info = $this->HostelModel->hostel_challan_info_row($balance_where);
//                        echo '<pre>';print_r($balace_info);
                         $balance = '';
                         if(empty($balace_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$balace_info->amount.'</td>';
                            $balance =  $balace_info->amount;
                         endif;
                         
                         
                         //Current amount
                         $current_where = array(
                            'hostel_student_bill.id'                    => $extra_info->challan_id,  
                              'hostel_head_title.id'                    => $ch_Row->head_id,   
                           'hostel_student_bill_info.old_challan_id '   => 0
                         );
                         
                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
                         
                         
//                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
//                         echo '<pre>';print_r($current_info);
                         $current = '';
                         if(empty($current_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$current_info->amount.'</td>';
                            $current =  $current_info->amount;
                         endif;
                         
//                         echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$ch_Row->amount.'</td> ';
                       echo '</tr>';
                         $total += $balance; 
                         $total += $current; 
                       
                         endforeach;
                         else:
                           
                        foreach($challan_info as $ch_Row):
                             
                         echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                         //Balance amount
                         $balance_where = array(
                           'hostel_student_bill.id'                     => $extra_info->challan_id,  
                           'hostel_head_title.id'                       => $ch_Row->head_id,  
                           'hostel_student_bill_info.old_challan_id !=' => 0
                         );
                         
                         
                         $balace_info = $this->HostelModel->hostel_challan_info_row($balance_where);
//                        echo '<pre>';print_r($balace_info);
                         $balance = '';
                         if(empty($balace_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$balace_info->amount.'</td>';
                            $balance =  $balace_info->amount;
                         endif;
                         
                         
                         //Current amount
                         $current_where = array(
                            'hostel_student_bill.id'                    => $extra_info->challan_id,  
                              'hostel_head_title.id'                    => $ch_Row->head_id,   
                           'hostel_student_bill_info.old_challan_id '   => 0
                         );
                         
                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
                         
                         
//                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
//                         echo '<pre>';print_r($current_info);
                         $current = '';
                         if(empty($current_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$current_info->amount.'</td>';
                            $current =  $current_info->amount;
                         endif;
                         
//                         echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$ch_Row->amount.'</td> ';
                       echo '</tr>';
                         $total += $balance; 
                         $total += $current; 
                       
                         endforeach;
                     endif;
                     
                   
                     
                     ?>
                </table>
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                    <tr>
                     
                      <td style="border-top: 0px solid #000000; text-align: left;"><strong>TOTAL AMOUNT FEE[PKR]</strong></td>
                      <td style="border-top: 0px solid #000000;     border-bottom: 2px solid #000000; text-align: right;"><strong><?php echo $total?></strong></td>
                    </tr>
                  </table>  
                
               <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody>
                    <tr>
                      <td style="border-top: 0px solid #000000;">Comments:</td>
                        
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #000000;"><?php echo $extra_info->comments?></td>
                        
                    </tr>
                      </table> 
                <div class="table-responsive">
                         
                        
                  
               <br/>
               <br/>
             
               
               
               <h6 align="center">For College</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">F# (<strong><?php echo $studentInfo->form_no.','.$studentInfo->batch_name; ?></strong>)Banker's stamp & signature</h6>
      
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
                    <td style="border-top: 0px solid #000000;"><img class="img-responsive pull-right" src="assets/RQ/hostel_rq/<?php echo $this->uri->segment(3)?>.png" alt="Studetn RQ" width="80px;"  ></td> 
                 
                    </tr>
                  </table> 
                    <?php
                       
                      if($extra_info->head_type == 2):
                          echo '<h2 style="font-size: 22px; text-align: center; ">Mess Bill</h2>';
                      else:
                          echo '<h2 style="font-size: 22px; text-align: center; ">Hostel Bill</h2>';
                      endif;
                      ?>
                  <p style="font-size: 11px; text-align: center; ">
                   <strong>EDWARDES COLLEGE PESHAWAR</strong><br/><?php echo $extra_info->bank_name?>-<?php echo $extra_info->address?>
                  <br/>ACCOUNT NUMBER : <?php echo $extra_info->account_no?>
                </p>
                 
                 <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 12px;">    
                    <tr>
                      
                        <th colspan="4"  style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Particulars Of Student</th>
                     </tr>
                     <tr>
                      
                         <td  colspan="4" style="border: 1px solid #000000;font-size: 18px;"><strong>Challan # &nbsp;&nbsp;<?php echo $extra_info->challan_id?></td>
<!--                        <td  colspan="2" style="border: 1px solid #000000;font-size: 18px;"></strong></td>-->
                        
                     </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>Issue</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->issue_date))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>Valid</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->valid_date))?></strong></td>
                      
                    </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>From</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->date_from))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>To</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($extra_info->date_to))?></strong></td>
                      
                    </tr>
                    
                    <tr>
                      
                        <td colspan="4" style="border: 1px solid #000000;">Student Name &nbsp;&nbsp;<strong><?php echo $studentInfo->student_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"></td>-->
                     </tr>
                    <tr>
                      
                      <td colspan="4" style="border: 1px solid #000000;">Father Name &nbsp;&nbsp;<strong><?php echo $studentInfo->father_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"><strong><?php // echo $studentInfo->father_name?></strong></td>-->
                     </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #000000;">College # &nbsp;&nbsp;<strong><?php echo $studentInfo->college_no?></strong></td>
                         
                       <td  colspan="2" style="border: 1px solid #000000;">Group &nbsp;&nbsp; <strong><?php echo $studentInfo->name?></strong></td> 
                      <!--<td  style="border: 1px solid #000000;"></td>-->
                    
                    
                     </tr>
                    
                      
                  </table>
                <br/>
                <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 12px;">    
                     <tr>
                      
                        <th colspan="3" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Detail Of Hostel Fee</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Arrears</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Current</th>
                     </tr>
                          
                     <?php
                     $total = '';
                     if($extra_info->head_type == 2):
                         foreach($challan_info as $ch_Row):
                        echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                         //Balance amount
                         $balance_where = array(
                           'hostel_student_bill.id'                     => $extra_info->challan_id,  
                           'hostel_head_title.id'                       => $ch_Row->head_id,  
                           'hostel_student_bill_info.old_challan_id !=' => 0
                         );
                         
                         
                         $balace_info = $this->HostelModel->hostel_challan_info_row($balance_where);
//                        echo '<pre>';print_r($balace_info);
                         $balance = '';
                         if(empty($balace_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$balace_info->amount.'</td>';
                            $balance =  $balace_info->amount;
                         endif;
                         
                         
                         //Current amount
                         $current_where = array(
                            'hostel_student_bill.id'                    => $extra_info->challan_id,  
                              'hostel_head_title.id'                    => $ch_Row->head_id,   
                           'hostel_student_bill_info.old_challan_id '   => 0
                         );
                         
                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
                         
                         
//                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
//                         echo '<pre>';print_r($current_info);
                         $current = '';
                         if(empty($current_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$current_info->amount.'</td>';
                            $current =  $current_info->amount;
                         endif;
                         
//                         echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$ch_Row->amount.'</td> ';
                       echo '</tr>';
                         $total += $balance; 
                         $total += $current; 
                       
                         endforeach;
                         else:
                                 
                        foreach($challan_info as $ch_Row):
                             
                         echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                         //Balance amount
                         $balance_where = array(
                           'hostel_student_bill.id'                     => $extra_info->challan_id,  
                           'hostel_head_title.id'                       => $ch_Row->head_id,  
                           'hostel_student_bill_info.old_challan_id !=' => 0
                         );
                         
                         
                         $balace_info = $this->HostelModel->hostel_challan_info_row($balance_where);
//                        echo '<pre>';print_r($balace_info);
                         $balance = '';
                         if(empty($balace_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$balace_info->amount.'</td>';
                            $balance =  $balace_info->amount;
                         endif;
                         
                         
                         //Current amount
                         $current_where = array(
                            'hostel_student_bill.id'                    => $extra_info->challan_id,  
                              'hostel_head_title.id'                    => $ch_Row->head_id,   
                           'hostel_student_bill_info.old_challan_id '   => 0
                         );
                         
                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
                         
                         
//                         $current_info = $this->HostelModel->hostel_challan_info_row($current_where);
//                         echo '<pre>';print_r($current_info);
                         $current = '';
                         if(empty($current_info)):
                             echo '<td colspan="2" style="border: 1px solid #000000;"></td>';
                             else:
                             echo '<td colspan="2" style="border: 1px solid #000000;">'.$current_info->amount.'</td>';
                            $current =  $current_info->amount;
                         endif;
                         
//                         echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$ch_Row->amount.'</td> ';
                       echo '</tr>';
                         $total += $balance; 
                         $total += $current; 
                       
                         endforeach;
                     endif;
                     
                   
                     
                     ?>
                </table>
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                    <tr>
                     
                      <td style="border-top: 0px solid #000000; text-align: left;"><strong>TOTAL AMOUNT FEE[PKR]</strong></td>
                      <td style="border-top: 0px solid #000000;     border-bottom: 2px solid #000000; text-align: right;"><strong><?php echo $total?></strong></td>
                    </tr>
                  </table>  
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody>
                    <tr>
                      <td style="border-top: 0px solid #000000;">Comments:</td>
                        
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #000000;"><?php echo $extra_info->comments?></td>
                        
                    </tr>
                      </table>
                <div class="table-responsive">
                         
                        
                
               <br/>
               <br/>
               
               
               <h6 align="center">For Student</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">F# (<strong><?php echo $studentInfo->form_no.','.$studentInfo->batch_name; ?></strong>)Banker's stamp & signature</h6>
      
                </div>
              </div>
            </div>
          </div>
           
          
 
        
 
        </div>
      </div>
    </div>
  </div>
</div>
<!--//page-row-->
</div>
