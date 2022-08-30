<style>

.report_header{
    display: none !important;
}
.red{
font-weight: 900;
color:red;
}
 
</style>
        <div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="left">Update Student Provisional Certificate<hr></h3>
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
             
                           $grand_hostel_actual     = 0;
                            $grand_hostel_paid      = 0;
                            $hostel_grand_total     = '';
                        if($hostel_information):
                             
                            foreach($hostel_information as $hostel_row):
                         
                                $payment_date = '';
                                if($hostel_row->payment_date == '0000-00-00'):
                                    $payment_date = '';
                                    else:
                                    $payment_date = date('d-m-Y',strtotime($hostel_row->payment_date));
                                endif;
                         
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
                          
                           endif; 
                            $grand_hostel_actual    += $bill_total_actual;
                            $grand_hostel_paid      += $bill_total_paid;
                            $hostel_grand_total     += $gBillPaid;
                            endforeach;
                            
                            
                        endif;
                         
                            $grand_mess_actual  = 0;
                            $grand_mess_paid    = 0;
                            $grand_mess_balance    = 0;
                        if($mess_information):

                            echo '<p style="font-size: 20px; text-align: center; font-weight: bold;">MESS FEE DETAILS</p>';
                            foreach($mess_information as $mess_row):
                         
                                $payment_date = '';
                                if($mess_row->payment_date == '0000-00-00'):
                                    $payment_date = 'Not Paid';
                                    else:
                                    $payment_date = date('d-m-Y',strtotime($mess_row->payment_date));
                                endif;
                           
                            $sn = '';
                            $bill_total_current     = '';
                            $bill_total_arrears     = '';
                            $bill_total_actual      = '';
                            $bill_total_paid        = '';
                            $bill_total_balance     = '';

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
                     
                     
                                <table class="table table-hover" id="table" style="margin-bottom: 5px;font-size: 12px;width: 100%;float: left;border: 1px solid;">
                                   
                                    <?php $hoste_balance = $hostel_grand_total-$grand_hostel_paid;
                                      ?>
                                    <?php  
                                        $mess_g_total = $grand_mess_paid+$grand_mess_balance; 
                                      ?>
                                           
                                     <tr class="info">
                                        <td align="center"><strong class="red" style="font-size:16px;"><?php
                                            $totl = @$total_balance+$hoste_balance+$grand_mess_balance;
                                            $securty_issue = $this->db->get_where('student_security',array('student_id'=>$result->student_id))->row();
        
                                            if($totl == 0 || !empty($securty_issue)):
                                                echo "Dues Clear";
                                            else:
                                                echo "Dues Remaining";
                                            endif;
                                            ?> </strong></td>
                                    </tr>
                                    
                               </table> <br> <br>
            <hr>
            
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line">Student Academic Record Panel</span>
                </h1>
                  <div class="section-content">
                      <form method="post" enctype="multipart/form-data">
               
                        <input type="hidden" value="<?php echo $result->student_id;?>" name="student_id">
                         <div class="form-group col-md-3">
                                <label for="usr">Program:</label>
                                <?php echo form_dropdown('program_std', $program,'',  'class="form-control"');?>
                       </div>
                        <div class="form-group col-md-3">
                                <label for="usr">Sub Program:</label>
                                <?php echo form_dropdown('sub_pro_id', $sub_program,$result->sub_pro_id,  'class="form-control"');?>
                       </div>
                        <div class="form-group col-md-3">
                                <label for="usr">Institute:</label>
                                <input type="text" name="inst_id" value="Edwardes College Peshawar" class="form-control" readonly> 
                       </div>
                        <div class="form-group col-md-3">
                                <label for="usr">Degree </label>
                                <select class="form-control" name="degree_id">
                                    <?php 
                            $d = $this->db->query('SELECT * FROM degree WHERE degree_id in(40,3) ORDER BY degree_id desc');
                            foreach($d->result() as $drow):        
                                    ?>
                                    <option value="<?php echo $drow->degree_id;?>"><?php echo $drow->title;?></option>
                                    <?php endforeach;?>
                                </select>
                           </div>
                        <div class="form-group col-md-3">
                                <label for="usr">University</label>
                                <select class="form-control" name="bu_id">
                                    <?php 
                            $d = $this->db->query('SELECT * FROM board_university WHERE bu_id=35');
                            foreach($d->result() as $drow):        
                                    ?>
                                    <option value="<?php echo $drow->bu_id;?>"><?php echo $drow->title;?></option>
                                    <?php endforeach;?>
                                </select>
                        </div>
                        <div class="form-group col-md-3">
                                <label for="usr">Year of Passing:</label>
                                <input type="text" name="year_of_passing" class="form-control"> 
                       </div>
                      <div class="form-group col-md-3">
                                <label for="usr">Roll No.:</label>
                                <input type="text" name="roll_no" class="form-control"> 
                       </div> 
                        <div class="form-group col-md-3">
                                <label for="usr">Total Marks:</label>
                                <input type="text" name="total_marks" value="550" class="form-control" readonly> 
                       </div> 
                        <div class="form-group col-md-3">
                                <label for="usr">Obtained Marks:</label>
                                <input type="text" name="obtained_marks" class="form-control" required> 
                       </div> 
                        <div class="form-group col-md-3">
                                <label for="usr">Division:</label>
                            <?php
                             echo form_dropdown('div_id', $division, '',  'class="form-control"');
                            ?>
                       </div> 
                        <div class="form-group col-md-3">
                        <label for="usr">Exam Type:</label>
                         <select name="exam_type" class="form-control">
                                <option value="annual">Annual</option>
                                <option value="supply">Supply</option>
                            </select> 
                       </div>
                        <div class="form-group col-md-3">
                            <input style="margin-top:23px;" type="submit" class="btn btn-theme" name="submit" value="Add Record">
                            <?php 
                             $securty_issue = $this->db->get_where('student_security',array('student_id'=>$result->student_id))->row();

                            if($totl == 0 || !empty($securty_issue)):      
                            ?>
                            <a style="margin-top:23px;" href="AdminDeptController/Print_provisional_certificate_degree/<?php echo $result->student_id;?>" class="btn btn-theme">Print</a>
                            <?php endif;?>
                        </div>

                        </form> 
                      
                  </div>
            </section>
                  
            
           
                </div>
                </div>
            
          
                    </div>
            </div>
        
       
<br>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Sub Program</th>
                            <th>Degree</th>
                            <th>Board/University</th>
                            <th>Institute</th>
                            <th>Roll No</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>%age</th>
                            <th>Division</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                 <?php
                        if($student_records):
                        foreach($student_records as $rec):
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->sub_program;?></td>
                            <td><?php echo $rec->Degreetitle;?></td>
                            <td><?php echo $rec->bordTitle;?></td>
                            <td><?php echo $rec->inst_id;?></td>
                            <td><?php echo $rec->rollno;?></td>
                            <td><?php echo $rec->total_marks;?></td>
                            <td><?php echo $rec->obtained_marks;?></td>
                            <td><?php echo $rec->percentage;?> %</td>
                            <td><?php echo $rec->division;?> </td>
                            <td><a href="AdminDeptController/deleteAcademicDegree/<?php echo $rec->serial_no;?>/<?php echo $rec->student_id;?>" onclick="return confirm('Are You Want to Delete This..?')">Delete</a></td>
                        </tr>
                        <?php
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>

</div></div>
                
                