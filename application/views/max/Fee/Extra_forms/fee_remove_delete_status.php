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
                                                'required'      => 'required',
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
                             
                        <?php
                        
                           endif;
                        ?>
                               </div> 
                      
                            
                            
                          <div style="padding-top:1%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="payment_challan_search" id="payment_challan_search"  value="payment_challan_search" ><i class="fa fa-search"></i> Search</button>
                                     
                                   
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
                                                          <th>Update</th>
                                                          <!--<th>Delete</th>-->
                                                    

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
                                                                
                                                                    echo '<td><a href="UpdateRemoveHead/'.$row->challan_detail_id.'/'.$row->challan_id.'" class="btn btn-theme btn-xs">Update</a></td>';
                                                                      '<td><a href="FeeHeadDelete/'.$row->challan_detail_id.'/'.$row->challan_id.'" class="btn btn-danger btn-xs">Delete</a></td>';
                                                                   
                                                            
                                                                
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
   
  
 