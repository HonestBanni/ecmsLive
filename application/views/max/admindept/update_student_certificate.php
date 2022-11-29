<style>

.report_header{
    display: none !important;
}
.red{
font-weight: 900;
color:red;
}
 
</style>

<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="left">Update Student Character Certificate<hr></h3>
            <div class="row cols-wrapper">
                <div class="col-md-12">
   <div class="row">
               
              <div id="div_print">
                  
                  
                <div style="margin-top: 2px;width:100%;min-height:170px;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
               
                   
                          <?php
             if($fee_information):
                   
                $total_actual       = 0;
                $total_paid         = 0;
                $total_balance      = 0;    
                $total_conssions    = 0;    
               foreach($fee_information as $challan_info):
                 
                
                   
                   
                 ?>
                       
                        <?php
                        
                        $sn='';
                        $actual_amount = '';
                        $credit_amount = '';
                        $current_amount = '';
                        $arrears_amount = '';
                        $concession_amount = '';
                        $paid_amount = '';
                        $balance_amount = '';
                        if(!empty($challan_info->payment_details)):
                            
                       
                    foreach($challan_info->payment_details as $payment_info):
                        $sn++;
                       ?>
                        
                        <?php
                        
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
                         endif;
                          ?>
                        
                       <?php 
                            
                            $section_name = $this->db->get_where('sections',array('sec_id'=>$challan_info->section_id))->row();
                           
                            ?>
                            
                          <?php 
                         
                     endforeach;
             endif;
             ?>
                         <br/>
                      <?php
                           $grand_hostel_actual     = 0;
                            $grand_hostel_paid      = 0;
                            $hostel_grand_total     = '';
                        if($hostel_information):
                            
                             echo ' <p style="font-size: 20px; text-align: center; font-weight: bold;">HOSTEL FEE DETAILS</p>';
                            foreach($hostel_information as $hostel_row):
                         
                                $payment_date = '';
                                if($hostel_row->payment_date == '0000-00-00'):
                                    $payment_date = '';
                                    else:
                                    $payment_date = date('d-m-Y',strtotime($hostel_row->payment_date));
                                endif;
                        ?> 
                            
                            <?php
                            
                            $bill_total_actual  = '';
                            $hos_current_amt    = '';
                            $hos_arrears_amt    = '';
                            $bill_total_paid    = '';
                            
                            
                            $gBalance   = '';
                            $gPaid      = '';
                            $gBillPaid      = '';
                            $sn = '';
                            
                            if($hostel_row->bill_details):
                                
                           
                            foreach($hostel_row->bill_details as $bill_row):
                              $sn++;
                            ?>
                            
                          <?php
                            $hos_current_amt    += $bill_row->current_amt;
                            $hos_arrears_amt    += $bill_row->arrears_amt;
                           
                            $bill_total_actual  += $bill_row->amount;
                            $bill_total_paid    += $bill_row->paid_amount;
                             
                            $gBalance           += $bill_row->balance;
                           
                            if($hostel_row->challan_status_id == 2):
                            $gPaid              += $bill_row->paid_amount;  
                            endif;
                            endforeach;
                                   $gBillPaid += $gBalance+$gPaid;
                                    
                            ?>
                            
        
                        
                        <?php
                           endif; 
                            $grand_hostel_actual    += $bill_total_actual;
                            $grand_hostel_paid      += $bill_total_paid;
                            $hostel_grand_total     += $gBillPaid;
                            endforeach;
                            
                            
                        endif;
                        ?> 
                        
                  
                    <?php
                            $grand_mess_actual  = 0;
                            $grand_mess_paid    = 0;
                            $grand_mess_balance    = 0;
                        if($mess_information):
//                            echo '<pre>';print_r($mess_information);die;
                            echo '<p style="font-size: 20px; text-align: center; font-weight: bold;">MESS FEE DETAILS</p>';
                            foreach($mess_information as $mess_row):
                         
                                $payment_date = '';
                                if($mess_row->payment_date == '0000-00-00'):
                                    $payment_date = 'Not Paid';
                                    else:
                                    $payment_date = date('d-m-Y',strtotime($mess_row->payment_date));
                                endif;
                            
                            
                        ?> 
         
                           
                             
                            <?php
                            $sn = '';
                            $bill_total_current     = '';
                            $bill_total_arrears     = '';
                            $bill_total_actual      = '';
                            $bill_total_paid        = '';
                            $bill_total_balance     = '';
//                            echo '<pre>';print_r($mess_row);die;
                            foreach($mess_row->bill_details as $mess_bill_row):
                             $sn++;
                            ?>
                            
                         
                          <?php
                           $bill_total_current   += $mess_bill_row->current_amt;
                           $bill_total_actual    += $mess_bill_row->amount;
                           $bill_total_arrears   += $mess_bill_row->arrears_amt;
                           $bill_total_paid      += $mess_bill_row->paid_amount;
                           $bill_total_balance   += $mess_bill_row->balance;
                                
                            endforeach;
                            ?>
                            
            
                         </thead>
                         
                    </table>
                        
                       <br/> 
                        <?php
                            $grand_mess_actual += $bill_total_actual;
                            $grand_mess_paid += $bill_total_paid;
                            $grand_mess_balance += $bill_total_balance;
                            
                            endforeach;
                        endif;
                  
                        
                        
                        ?> 
                     
                                <table class="table table-hover" id="table" style="margin-bottom: 5px;font-size: 12px;width: 60%;float: left;border: 1px solid;">
                                   
                                    <?php $hoste_balance = $hostel_grand_total-$grand_hostel_paid;
                                      ?>
                                    <?php  
                                        $mess_g_total = $grand_mess_paid+$grand_mess_balance; 
                                      ?>
                                           
                                     <tr class="info">
                                        <td align="center"><strong class="red" style="font-size:16px;"><?php
                                        
//                                            echo $total_balance;
                                        
                                            $totl           = @$total_balance+$hoste_balance+$grand_mess_balance;
                                            $securty_issue  = $this->db->get_where('student_security',array('student_id'=>$result->student_id))->row();
        
                                            if($totl == 0 || !empty($securty_issue)):
                                                echo "Dues Clear";
                                            else:
                                                echo "Dues Remaining";
                                            endif;
                                            ?> </strong></td>
                                    </tr>
                                    
                               </table> 
                          
                </div>
                </div>
          
                    </div>
            </div>
        
          
       <form name="student" method="post">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group col-md-3">
                    <label for="usr">College No.:</label>
             <input type="text" value="<?php echo $result->college_no;?>" class="form-control">
                </div>
              <div class="form-group col-md-3">
                    <label for="usr">Student Name:</label>
                    <input type="text" value="<?php echo $result->student_name;?>" class="form-control">        
                    <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>">        
              </div>
             <div class="form-group col-md-3">
                    <label for="usr">Father Name:</label>
                    <input type="text" name="father_name" value="<?php echo $result->father_name;?>" class="form-control">
              </div>
              <div class="form-group col-md-3">
                <label for="usr">Date of Admission (<small>DD-MM-YYYY</small>):</label>
                <?php
                $date = $result->admission_date;
                if($date === '0000-00-00' || $date == '1970-01-01'){
                    $date = '';
                    } else {
                    $date = date("d-m-Y", strtotime($date));
                    }
            ?>
                <input type="text" name="admission_date" value="<?php echo $date;?>" class="form-control date_format_d_m_yy">      
                </div>
                <div class="form-group col-md-3">
                <label for="usr">Leaving Date (<small>DD-MM-YYYY</small>):</label>
                <?php
                $ldate = $result->leaving_date;
                if($ldate === '0000-00-00' || $ldate == '1970-01-01' || $ldate == 'NULL'){
                    $ldate = '';
                    } else {
                    $ldate = date("d-m-Y", strtotime($ldate));
                    }
            ?>
                <input type="text" name="leaving_date" value="30-04-<?php echo date('Y'); ?>" class="form-control date_format_d_m_yy">      
                </div>    
    <div class="form-group col-md-8">
        <?php
            if($ldate === '0000-00-00' || $ldate == '' || $ldate == '01-01-1970' || $ldate == 'NULL'):
        ?>
        <input style="margin-top:23px;" type="submit" name="submit" value="Save" class="btn btn-theme">
        <?php else:?>
        <input style="margin-top:23px;" type="submit" name="submit" value="Save" class="btn btn-theme disabled">
        <?php endif;
         $securty_issue = $this->db->get_where('student_security',array('student_id'=>$result->student_id))->row();
        
        if($totl == 0 || !empty($securty_issue)):?>
        <a style="margin-top:23px;" href="AdminDeptController/Print_Character/<?php echo $result->student_id;?>" class="btn btn-theme">Print</a>
        <?php 
        endif;
 
        
        ?>
        
        
    </div>    
              </div>
            </div>
    </form>    
</div></div>
                
                