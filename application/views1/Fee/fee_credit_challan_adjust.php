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
            $actual_amount    = '';
            $paid_amount_ch      = '';
            $paid_amount      = '';
            $old_credit_amount      = '';
             if(!empty($result)):
                  foreach($result as $row):

                       $actual_amount          += $row->actual_amount;
                       $paid_amount_ch            += $row->paid_amount;
                       $challan_balance_amount += $row->balance;
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
                        <?php echo form_open('',array('class'=>'course-finder-form'));?>
                            <div class="row">
                               <div class="col-md-3">
                                    <label for="name">Challan #</label>
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
                                    <label for="name">Credit adjust date</label>
                                        <?php
                                        $date_adjust = '';
                                        if($challan_details->credit_adjust_date == '01-01-1970' || $challan_details->credit_adjust_date == '0000-00-00'):
                                           $date_adjust  = date('d-m-Y');
                                                else:
                                            $date_adjust =date('d-m-Y',strtotime($challan_details->credit_adjust_date));
                                        endif;
//                                        
                                            echo form_input(array(
                                                'name'          => 'adjust_amount_date',
                                                'value'         => $date_adjust,
                                                'class'         => 'form-control datepicker',
                                                'required'      => 'required',
                                                
                                                ));
                                             
                                            
                                         ?>
                                
                                    </div>
                                
                                 
                                    <?php
                                           if(!empty($studentInfo)):
                                echo '<div class="col-md-2"><label for="name">Total Challan amount</label>';
                              
                                 echo form_input(array(
                                    'value'         => $paid_amount,
                                    'class'         => 'form-control grand_challan_amount',
                                    'readonly'         => 'readonly',
                                    ));
                              
                                echo '</div>';
                                echo '<div class="col-md-4"><label for="name">Challan Comments</label>';
                               
                                 echo form_textarea(array(
                                    'name'          => 'challan_comment',
                                    'value'         => @$challan_details->fc_comments,
                                    'rows'          => '2',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Comment', 
                                    'required'      => 'required',
                                ));
                                echo '</div>';
                             endif;
                                             
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
                                  
                           
                            
                            
                            ?>
                            </div>          
                            <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                              <label for="name">Fee Head</label>
                                              
                                                  <?php 
                                            
                                               echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_name',
                                                           'id'            => 'fee_head_name',
                                                           'required'       => 'required',
                                                           'class'         => 'form-control',
                                                           'placeholder'   => 'Payment Category',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head',
                                                           'id'            => 'fee_head',
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                             
//                                             
                                            ?>
                                              
                                          
                                    </div>
                                     
                                      
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Account</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                'id'            => 'fee_head_amount',
                                                                'type'          => 'number',
//                                                                'value'       => $recordFrom,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Amount',
                                                                 )
                                                             );
                                                      ?>
                                            
                                            
                                     </div>
                                      
                                    <div class="col-md-6 col-sm-5">
                                          <label for="name">Head Comments</label>
                                        <?php
                                            
                                            echo form_textarea(array(
                                                'name'          => 'head_comment',
                                                'rows'          => '2',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Comment', 
                                                'required'      => 'required',
                                                ));
                                         
                                        ?>
                                       
                                        
                                     </div>
                                     
                                    
                                     
                                
                                     
                                     
                                      
                                </div> 
                        <?php
                        
                           endif;
                        ?>
                               </div> 
                      
                            
                            
                          <div style="padding-top:1%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="payment_challan_search" id="payment_challan_search"  value="payment_challan_search" ><i class="fa fa-search"></i> Search</button>
                                    
                                    <?php
                                    
//                                     fc_ch_status_id
                                    if(!empty($studentInfo)):
                                       
                                         if($challan_details->fc_ch_status_id ==2):
                                        echo '<button type="submit" class="btn btn-theme" name="add_credit_adjust" id="add_credit_adjust"  value="add_credit_adjust" ><i class="fa fa-plus"></i>Add Head</button>&nbsp;&nbsp;';
                                          '<button type="submit" class="btn btn-theme" name="save_credit_adjust" id="save_credit_adjust"  value="save_credit_adjust" ><i class="fa fa-save"></i>Save</button>';

                                    endif;
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
                                    if($challan_details->fc_ch_status_id ==1):
                                                    echo '<div class="alert alert-danger alert-dismissable center">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <strong>Sorry! Challan Not Paid </strong> </div>';
                                          endif; 
                                 
                                         
                                    
                                        ?>
                                     <div id="challan_bill_amount_info">
              
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
                                                          
                                                          <th>Balance</th>
                                                          <th>Delete</th>
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $upchallan_amount       = '';
                                                        $paidchallan_amount_c   = '';
                                                        $paidchallan_amount     = '';
                                                        $balance                = '';
                                                        $rem_balance_g          = '';
                                                  
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
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->fh_head.'</td>
                                                                <td>'.$paid_amount_c.'</td>
                                                                <td>'.$paid_amount.'</td>
                                                                <td>'.@$rem_balance.'</td>';
                                                                if($row->credit_adjust_flag == 1):
                                                                    echo '<td><a href="DeleteCreditAdj/'.$row->challan_detail_id.'/'.$row->challan_id.'" class="btn btn-danger btn-xs">Delete</a></td>';
                                                                    else:
                                                                    echo '<td></td>';
                                                                endif;
                                                            
                                                                
                                                                 echo '</tr>';
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
                                                                <td>'.$rem_balance_g.'</th>
                                                                <th></th>
                                                                <th></th>
                                                                
                                                         
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
$(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });

  
  
 });
  </script>
   
  
 