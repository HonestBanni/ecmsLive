

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
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                    <div class="col-md-2">
                                    <label for="name">From</label>
                                        <div class="form-group ">
                                        <?php 
                                             echo  form_input(
                                                             array(
                                                                'name'          => 'from',
                                                                'type'          => 'text',
                                                                'value'         => $from,
                                                                'class'         => 'form-control datepicker',
                                                                
                                                                 )
                                                             );
                                        ?>
                                    </div>
                                    </div> 
                                    <div class="col-md-2">
                                    <label for="name">To</label>
                                    <div class="form-group ">
                                        <?php 
                                                echo  form_input(
                                                        array(
                                                           'name'          => 'to',
                                                           'value'         => $to,
                                                           'class'         => 'form-control datepicker',

                                                            )
                                                             );?>
                                    </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name">Program</label>
                                        <div class="form-group ">
                                            <?php 
    
                                                echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                            ?>
                                        </div>
                                    </div>
                                     
                                    <div class="col-md-2">
                                        <label for="name">Sub Program</label>
                                        <div class="form-group ">
                                            <?php 

                                                    echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
    
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-2">
                                    <label for="name">Batch</label>
                                            <div class="form-group ">
                                                <?php

                                                    echo form_dropdown('batch_name', $batch_name,$batch_id,'class="form-control  " id="batch_id"');
                                                ?>
                                            </div>
                                        </div>
                                    <div class="col-md-2">
                                        <label for="name">Section</label>
                                        <div class="form-group ">
                                            <?php 

                                                    echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
    //                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control"');
                                            ?>
                                        </div>
                                    </div> 
                              </div> 
                            <div class="row">
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">COA From</label>
                                        
                                         
                                                <?php
                                                    echo form_dropdown('fee_head_from', $fee_head_from,$fee_id_to,  'class="form-control"');
                                          
                                                      ?>
                                           
                                            
                                </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">COA To</label>
                                        
                                         
                                                <?php
                                                    echo form_dropdown('fee_head_to', $fee_head_to,$fee_id_from,  'class="form-control"');
                                          
                                                ?>
                                           
                                            
                                </div>
                            </div>
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-7 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="paid_amount_report" id="paid_amount_report"  value="paid_amount_report" ><i class="fa fa-search"></i> Paid</button>
                                    <button type="submit" class="btn btn-theme" name="paid_amount_report_split" id="paid_amount_report_split"  value="paid_amount_report_split" ><i class="fa fa-search"></i> Paid Split</button>
                                    <button type="submit" class="btn btn-theme" name="paid_fee_head" id="paid_fee_head"  value="paid_fee_head" ><i class="fa fa-search"></i> Head Wise</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                     
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
           
                             <?php
                             
                             
                   if(!empty($result)): 
//                       echo '<pre>';print_r($result);die;
        ?>
                <div id="div_print">
                <div class="row">
                <div class="col-md-12"> 
                    <div class="report_header">
                      <img style="float: right;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <!--<img style="float: right; position: absolute;    right: 25px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>-->
                      <!--<h3 class="text-highlight" style=" text-align: center">Paid Amount Result</h3>-->
                     
                    </div>
                 
                  
                      <h4 class="text-highlight" style=" text-align: center"><?php echo $report_name?></h4>
                       
                      <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                  <hr/>
                 
                                      
                  
                                       
                  <?php
                  // Student Wise Report
                  if($report_type == 'paid_amount_report'):
            
                  
                  ?>
                  
                 
                  <div class="table-responsive">
                      <p class="text-highlight" style=" text-align: left"><strong>College Fee Details</strong></p>
                      
                      <table class="table table-hover" >
                              <thead>
                                <tr>
                                     
                                    
                                    <th>Sn#</th>
                                    <th>Department</th>
                                    <th>Paid Amount</th>
                                     
                                   
                                    </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                 
                                    
                                    $sn = "";
                                   $paid_amount = "";
                                  if($result->college_fee):
                                      
                                 
                                    foreach($result->college_fee as $row):
                                      $sn++; 
                                    echo '
                                        <tr>
                                            <td>'.$sn.'</td>
                                            <td>'.$row->program_name.'</td>
                                            <td>'.number_format($row->paid_amount, 0, ',', ',').'</td>
                                              
                                        </tr>';
                                    
                                   $paid_amount            += $row->paid_amount;
                                    endforeach;    
                                    ?>

                                <tr>
                                    <td></td>
                                    <td><strong>Fee Total</strong></td>
                                    <td><strong><?php 
                                    
                                    if($paid_amount):
                                         echo number_format($paid_amount, 0, ',', ',');
                                        else:
                                        echo $paid_amount;
                                    endif;
                                     endif;
                                   ?></strong></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="3">  <p class="text-highlight" style=" text-align: left"><strong>Hostel Fee Details</strong></p></td>
                                </tr>
                                
                                
                                <tr>
                                    <td></td>
                                    <td><strong>Hostel Total</strong></td>
                                    <td><strong><?php 
                                    
                                    if($result->hostel_fee):
                                        $hostel_amount = '';
                                        foreach($result->hostel_fee as $hf_row):
                                        
                                            
                                            $hostel_amount += $hf_row->hostel_amount; 
                                        endforeach;
                                        
                                    endif;
                                    
                                      echo number_format($hostel_amount, 0, ',', ',')
                                   
                                     
                                   ?></strong></td>
                                </tr>
                                  <tr>
                                    <td colspan="3">  <p class="text-highlight" style=" text-align: left"><strong>Mess Fee Details</strong></p></td>
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td><strong>Mess Total</strong></td>
                                    <td><strong><?php 
                                    
                                    if($result->mess_fee):
                                        $mess_amount = '';
                                        foreach($result->mess_fee as $hf_row):
                                        
                                            
                                            $mess_amount += $hf_row->mess_amount; 
                                        endforeach;
                                        
                                    endif;
                                    
                                    echo number_format($mess_amount, 0, ',', ',');
                                    
                                     
                                   ?></strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><strong>Grand Total</strong></td>
                                    <td><strong><?php 
                                    $grand_total = $paid_amount+$mess_amount+$hostel_amount;
                                    
                                    echo number_format($grand_total, 0, ',', ',');
                                    
                                     
                                     
                                   ?></strong></td>
                                </tr>
                            </tbody>
                      </table>
                  </div> 
                  
                    <?php
                  
                  endif;
                    
                  
                  if($report_type == 'paid_amount_report_split'):
            
                  
                  ?>
                  
                 
                  <div class="table-responsive">
                    
                      
                      <table class="table table-hover" >
                              <thead>
                                <tr>
                                     
                                    
                                    <th>Sn#</th>
                                    <th>Department</th>
                                    <th>College Fee</th>
                                    <th>Hostel Fee</th>
                                    <th>Mess Fee</th>
                                    <th>Total</th>
                                   
                                    </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                 
                                    
                                    $sn = "";
                                   $total_college_fee = "";
                                   $total_hostel_fee = "";
                                   $total_mess_fee = "";
                                   $total = "";
                                   $gtotal = "";
                                  if($result):
                                      
                                 
                                    foreach($result as $row):
                                      $sn++; 
                                   $total = $row->college_fee+$row->hostel_fee+$row->mess_fee;
                                    echo '<tr>
                                            <td>'.$sn.'</td>
                                            <td>'.$row->program_name.'</td>';
                                           
                                            if($row->college_fee>0):
                                                echo '<td>'.number_format($row->college_fee, 0, ',', ',').'</td>';
                                                else:
                                                echo '<td>0</td>';
                                            endif;
                                            if($row->hostel_fee>0):
                                                echo '<td>'.number_format($row->hostel_fee, 0, ',', ',').'</td>';
                                                else:
                                                echo '<td>0</td>';
                                            endif;
                                           
                                            if($row->mess_fee>0):
                                                echo '<td>'.number_format($row->mess_fee, 0, ',', ',').'</td>';
                                                else:
                                                echo '<td>0</td>';
                                            endif;
                                           
                                            if($total>0):
                                                echo '<td>'.$total.'</td>';
                                                else:
                                                echo '<td>0</td>';
                                            endif;
                                           
                                            $total_college_fee  += $row->college_fee;
                                            $total_hostel_fee   += $row->hostel_fee;
                                            $total_mess_fee   += $row->mess_fee;
                                            $gtotal             += $total;
                                            
                                            
                                        echo '</tr>';
                                    
                                    
                                    endforeach;    
                                    ?>
                                
                                <tr>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td><strong><?php echo number_format($total_college_fee, 0, ',', ',')?></strong></td>
                                    <td><strong><?php echo number_format($total_hostel_fee, 0, ',', ',')?></strong></td>
                                    <td><strong><?php echo number_format($total_mess_fee, 0, ',', ',')?></strong></td>
                                    <td><strong><?php echo number_format($gtotal, 0, ',', ',')?></strong></td>
                                     
                                    
                                </tr>
                                
                          <?php endif;?>
                                
                            </tbody>
                      </table>
                  </div> 
                  
                    <?php
                  
                  endif;
                  
                    // Head Wise Section report 
                    if($report_type == 'paid_fee_head'):
                    ?>
                    
                    <div class="table-responsive">
                        <p class="text-highlight" style=" text-align: left"><strong>College Fee Details</strong></p>
                      
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>Program</th>
                                    <th>Head</th>
                                    <th>Amount</th>
                                     
                                 </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                    
                                  if($result):
                                      $gTotal = '';
                                      foreach($result as $res_head):
                                      echo '<tr>';
                                      echo '<td>'.$res_head->program_name.'</td>';
                                      echo '<td></td>';
                                      echo '<td></td>';
                                      echo '</tr>';
                                      
                                      if(!empty($res_head)):
                                           $Total = '';
                                          foreach($res_head->head_details as $head_det):
                                            echo '<tr>';
                                            echo '<td></td>';
                                            echo '<td>'.$head_det->fh_head.'</td>';
                                            echo '<td>'.$head_det->paid_amount+$head_det->fc_challan_credit_amount.'</td>';
                                            echo '</tr>';
                                              $Total +=$head_det->paid_amount+$head_det->fc_challan_credit_amount;
                                           
                                        
                                            endforeach;
                                            if(!empty($Total)):
                                                echo '<tr>

                                                <td></td>
                                                <td><strong>Total</strong></td>
                                                <td>'.number_format($Total, 0, ',', ',').'</td>


                                            </tr>';
                                            endif;
                                              
                                      endif;
                                      
                                      $gTotal+=$Total;
                                      endforeach;
                                      if(!empty($gTotal)):
                                                echo '<tr>

                                                <td></td>
                                                <td><strong>Grand Total</strong></td>
                                                <td>'.number_format($gTotal, 0, ',', ',').'</td>


                                            </tr>';
                                            endif;
                                  endif;
                                  
                                    ?>

                               
                              

                              </tbody>
                      </table>
                  </div> 
                    
                    <?php 
                    endif;
                   
                  ?>
                  
                  
                </div>
                </div>
                                  
                                </div>
                <?php  endif ?>
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
   
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 5;
      }
  </style>     
  
 