        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
   <h3 align="left">Fee Clearance Inter<hr></h3>          
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <form method="post">
                        <div class="form-group col-md-2">
                            <input type="text" name="college_no"  placeholder="College No." value="<?php if($college_no): echo $college_no;endif; ?>" class="form-control" required>
                      </div>
                       
                <input type="submit" name="search" class="btn btn-theme" value="Search">
            </form>
        </div>
    <?php if(@$result):?>
         <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
        <table class="table table-boxed table-bordered table-striped">
        <thead>
            <tr>
                <th>Picture</th>
                <th>Student Name</th>
                <th>F-Name</th>
                <th>College No.</th>
                <th>Sub Program</th>
                <th>Section</th>
                <th>Batch</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
<?php
foreach($result as $rec)  
{
    $student_id = $rec->student_id;
    $applicant_image = $rec->applicant_image;         
        $section = $rec->section;                           
                        ?>
                        <tr class="gradeA">
                            <td>
                            <?php
                    if($applicant_image == "")
                 {?>
        <img src="assets/images/students/user.png" width="80" height="60">
                    <?php
                    }else
                    {?>
  <img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="80" height="60">
                <?php 
                   }
                    ?>
</td>
                    <td><strong><?php echo $rec->student_name;?></strong></td>
                    <td><strong><?php echo $rec->father_name;?></strong></td>
                    <td><strong><?php echo $rec->college_no;?></strong></td>
                    <td><strong><?php echo $rec->sub_program;?></strong></td>
                    <td><strong><?php echo $rec->section;?></strong></td>
                    <td><strong><?php echo $rec->batch;?></strong></td>
                    <td><strong><?php echo $rec->student_status;?></strong></td>
    
            <?php 
    $query = $this->CRUDModel->get_where_row('student_character_issued',array('student_id'=>$rec->student_id));?>              
    
                        </tr>
            <tr>
            <td colspan="9" align="center"><strong class="red" style="font-size:26px;">
                   
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
                            
                        
                       <br/> 
                        <?php
                            $grand_mess_actual += $bill_total_actual;
                            $grand_mess_paid += $bill_total_paid;
                            $grand_mess_balance += $bill_total_balance;
                            
                            endforeach;
                        endif;
                  
                        ?> 
                     
                <?php $hoste_balance = $hostel_grand_total-$grand_hostel_paid;
                  ?>
                <?php  
                    $mess_g_total = $grand_mess_paid+$grand_mess_balance; 

                        $totl           = @$total_balance+$hoste_balance+$grand_mess_balance;
                        $securty_issue  = $this->db->get_where('student_security',array('student_id'=>$student_id))->row();

                        if($totl == 0 || !empty($securty_issue)):
                            echo "<strong style='color:Green'>Dues Clear</strong>";
                        else:
                            echo "<strong style='color:red'>Dues Remaining</strong>";
                        endif;
                        ?> 
                </strong>                     
            </td>
            </tr>
<?php
}
            else:
            echo '<h3 style="color:red">Record Not Found..</h3>';
            endif;
            ?>
    
       
            </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           