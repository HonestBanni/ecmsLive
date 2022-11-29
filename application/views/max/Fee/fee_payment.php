 <?php
// error_reporting(0);
 ?>
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
        
        
                                                <?php
                                            $challan_balance_amount = '';
                                            $actual_amount          = '';
                                            $paid_amount_ch         = '';
                                            $paid_amount            = '';
                                            $old_credit_amount      = '';
                                            
                                             if(!empty($result)):
                                                  foreach($result as $row):

                                                       $actual_amount               += $row->actual_amount;
                                                       $paid_amount_ch              += $row->paid_amount;
                                                       $challan_balance_amount      += $row->balance;
                                                       $old_credit_amount           += $row->old_credit_amount;
                                                  endforeach;  

                                             $paid_amount  =$paid_amount_ch-$old_credit_amount;     
                                             endif;   
                                                      
                                                              
                                                          
                                                        ?>
        
        
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
                               <div class="col-md-3">
                                    <label for="name">Challan#</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'challan_no',
                                                'id'            => 'challan_no',
                                                'value'         => $challandId,
                                                'placeholder'   => 'Enter Challan Number',
                                                'class'         => 'form-control',
                                                ));
                                            echo form_input(array(
                                                'name'          => 'challan_Id',
                                                'value'         => $challandId,
                                                'type'          => 'hidden'
                             
                                                ));
                                             
                                            echo form_input(array(
                                                'name'          => 'challan_id_lock',
                                                'value'         => @$challan_details->challan_id_lock,
                                                'type'          => 'hidden'
                             
                                                ));
                                            echo form_input(array(
                                                'name'          => 'student_id',
                                                'value'         => @$studentInfo->student_id,
                                                'type'          => 'hidden'
                             
                                                ));
                                         ?>
                                    </div>
                                    <?php
                                         if(!empty($studentInfo)):
                                       
                                    ?>
                               <div class="col-md-3">
                                    <label for="name">Paid date</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'challan_date',
                                                 'value'         => date('d-m-Y',strtotime($challan_date->print_date)),
                                                'class'         => 'form-control datepicker',
                                                ));
                                            echo form_input(array(
                                                'name'          => 'pdate_id',
                                                 'value'        => $challan_date->printDate_id,
                                                'type'          => 'hidden',
                                                ));
                                            
                                         ?>
                                
                                    </div>
                               <div class="col-md-1">
                                    <label for="name">Date fix</label>
                                        <label class="checkbox-inline"><input type="checkbox" name="date_fix" ></label>
                                
                                    </div>
                                 
                                    <?php
                                         
                                             
                                         endif;
                                    ?>   
                                     
                                </div>
                            <div class="row">
                            <?php
                            if(!empty($studentInfo)):
                                echo '<div class="col-md-3"><label for="name">Student Name</label>';
                                 echo form_input(array(
                                       'readonly'         => 'readonly',
                                    'value'         => $studentInfo->student_name,
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                          
                                echo '<div class="col-md-3"><label for="name">Father Name</label>';
                                 echo form_input(array(
                                       'readonly'         => 'readonly', 
                                    'value'         => $studentInfo->father_name,
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                           
                                echo '<div class="col-md-2"><label for="name">Class</label>';
                                 echo form_input(array(
                                      'readonly'         => 'readonly',
                                    'value'         => $studentInfo->sectionsName,
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-2"><label for="name">Program</label>';
                                 echo form_input(array(
                                    'readonly'         => 'readonly',
                                    'value'         => $studentInfo->sub_proram,
                                     'class'        => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-2"><label for="name">Batch</label>';
                                 echo form_input(array(
                                    'readonly'      => 'readonly',
                                    'value'         => $studentInfo->batch_name,
                                     'class'        => 'form-control',
                                    ));
                                echo '</div>';
                                
                            endif;
                            
                            ?>
                               </div> 
                            <div class="row">
                            <?php
                            if(!empty($studentInfo)):
                                echo '<div class="col-md-3"><label for="name">Total Challan amount</label>';
                              
                                 echo form_input(array(
                                    'name'          => 'challan_amount',
                                    'value'         => $paid_amount,
                                    'class'         => 'form-control grand_challan_amount',
                                    'readonly'      => 'readonly',
                                    'style'         => 'font-size: 34px;color: red; font-weight: 900;',
                                    
                                   
                                     
                                     ));
                              
                                echo '</div>';
                            
                                echo '<div class="col-md-3"><label for="name">Challan Comment</label>';
                              
                                 echo form_input(array(
                                    'name'          => 'challan_comments',
                                    'value'         => $challan_details->fc_comments,
                                    'class'         => 'form-control grand_challan_amount',
                                    ));
                                echo '</div>';
                                
                                if($challan_details->challan_id_lock ==1):
                                    
                              
                                
                                  echo '<div style="padding-top:2%;">';
                              
                                  echo '<button type="button" class="btn btn-danger" style="font-size: 25px;"><i class="fa fa-lock"></i>FEE BILL LOCKED</button>';
                                echo '</div>';
                                  endif;
                                
                             echo '</div>';
                                
                            endif;
                            
                            
                            
                            ?>
                               </div> 
                          <div style="padding-top:1%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="payment_challan_search" id="payment_challan_search"  value="payment_challan_search" ><i class="fa fa-search"></i> Search</button>
                                    <?php
                                    
//                                     fc_ch_status_id
                                    if(!empty($studentInfo)):
                                       
                                         if($challan_details->fc_ch_status_id ==1):
                                             //If Bill Lock then button no show
                                            if($challan_details->challan_id_lock ==1):
                                             echo '<button type="button" class="btn btn-danger"   ><i class="fa fa-save"></i> Bill Lock</button>';
                                                else:
                                                
                                        echo '<button type="submit" class="btn btn-theme" name="payment_challan_paid" id="payment_challan_paid"  value="payment_challan_paid" ><i class="fa fa-save"></i> Paid</button>';
                                        endif;
                                    endif;
                                    else:
                                             echo '<button type="button" class="btn btn-danger"   ><i class="fa fa-save"></i> Student Status Pending..</button>';
                                    endif;
                                    
                                    ?>
                                   
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
           <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <?php
                                   
                                
                                      if(!empty($result)):
                                         
                                          if(!empty($error_msg)):
                                                    echo '<div class="alert alert-danger alert-dismissable center">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <strong>Sorry! Date is Reconcile '.date('d-m-Y',strtotime($error_msg['date'])).' ! This date is locked </strong> </div>';
                                          endif; 
                                          
                                          
                                          
                                          
                                          if($challan_details->fc_ch_status_id ==2):
                                                    echo '<div class="alert alert-danger alert-dismissable center">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <strong>Sorry! Challan Already Paid on '.date('d-m-Y',strtotime($challan_details->fc_paiddate)).'</strong> </div>';
                                          endif; 
                                         
                                    
                                        ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Challan Details </h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <!--<th>Actual Challan</th>-->
                                                          <th>Calculated</th>
                                                          <th>Paid</th>
                                                          <th>Old Credit</th>
                                                          <th>Balance</th>
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $upchallan_amount = '';
                                                        $paidchallan_amount_c = '';
                                                        $paidchallan_amount = '';
                                                        $balance = '';
                                                        $rem_balance_g= '';
                                                  
                                                          foreach($result as $row):
                                                            $paid_amount    = 0;
                                                            $paid_amount_c  = 0;
                                                            $unpaid_amount  = 0;
//                                                             if($row->challan_status == 1):
//                                                                   $unpaid_amount  += $row->paid_amount;
//                                                             endif;
                                                            $unpaid_amount  += $row->actual_amount;
                                                            $paid_amount_c  += $row->paid_amount;
                                                            $balance        += $row->balance;
                                                            $rem_balance_g     += $row->old_credit_amount;
                                                             if($row->challan_status == 2):
                                                                   $paid_amount  += $row->paid_amount;
                                                             endif;
                                                            
                                                           $sn++;
                                                           
                                                           $rem_balance = $row->balance-$row->old_credit_amount;
                                                            echo '<tr">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->fh_head.'</th>
                                                                
                                                                <th>'.$paid_amount_c.'</th>
                                                                <th>'.$paid_amount.'</th>
                                                                <th>'.$row->old_credit_amount.'</th>
                                                                <th>'.@$rem_balance.'</th>
                                                         
                                                                 </tr>';
                                                            $upchallan_amount       += $unpaid_amount;
                                                            $paidchallan_amount     += $paid_amount;
                                                            $paidchallan_amount_c   += $paid_amount_c;
                                                            
                                                           
                                                          endforeach;      
                                                          $r_balance = $balance-$rem_balance_g;
                                                          echo '<tr">
                                                                
                                                                <th> </th>
                                                                <th>Total Amount</th>
                                                                <th>'.$paidchallan_amount_c.'</th>
                                                                <th>'.$paidchallan_amount.'</th>
                                                                <th>'.$rem_balance_g.'</th>
                                                                <th>'.$r_balance.'</th>
                                                                
                                                         
                                                                 </tr>'; 
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
                             
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
   
     <script>
jQuery(document).ready(function(){
   jQuery('#challan_no').focus();
   
   var grand_amount = jQuery('.grand_challan_amount').val();
   
//   if(grand_amount== 0){
//      jQuery('#payment_challan_paid').hide();
//   }
//  
   
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  
  
 });
  </script>
   
  
 