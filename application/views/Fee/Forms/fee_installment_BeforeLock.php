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
                                                  $paid_amount      = '';
                                                   if(!empty($result)):
                                                        foreach($result as $row):
                                                            $actual_amount  += $row->actual_amount;
                                                             $paid_amount    += $row->paid_amount;
                                                             $challan_balance_amount += $row->paid_amount;
                                                        endforeach;  
                                                          
                                                       
                                                 
                                                   endif;   
                                                      
                                                              
                                                          
                                                        ?>
        
        
      <div class="row">
           <?php echo form_open('',array('class'=>'course-finder-form')); ?>
          <div class="col-md-12">
              
                                    
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                               <div class="col-md-3">
                                    <label for="name">Challan#</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'challan_no',
                                                'id'            => 'challan_no',
                                                'value'         => $challandId,
                                                'placeholder'   => 'Enter Challan Number',
                                                'class'         => 'form-control datepicker',
                                                ));
                                            echo form_input(array(
                                                'name'          => 'challan_Id',
                                                'value'         => $challandId,
                                                'type'          => 'hidden'
                             
                                                ));
                                            echo form_input(array(
                                                'name'          => 'pc_id',
                                                'value'         => $fc_pay_cat_id,
                                                'type'          => 'hidden'
                             
                                                ));
                                      
                                         ?>
                                    </div>
                                     
                                     
                                </div>
                            <div class="row">
                            <?php
                            if(!empty($studentInfo)):
                                      echo form_input(array(
                                                'name'          => 'student_id',
                                                'value'         => $studentInfo->student_id,
                                                'type'          => 'hidden'
                             
                                                ));
                                echo '<div class="col-md-3"><label for="name">Student Name</label>';
                                 echo form_input(array(
                                   
                                    'value'         => $studentInfo->student_name,
                                     'class'         => 'form-control datepicker',
                                    ));
                                echo '</div>';
                          
                                echo '<div class="col-md-3"><label for="name">Father Name</label>';
                                 echo form_input(array(
                                    
                                    'value'         => $studentInfo->father_name,
                                     'class'         => 'form-control datepicker',
                                    ));
                                echo '</div>';
                           
                                echo '<div class="col-md-2"><label for="name">Class</label>';
                                 echo form_input(array(
                                  
                                    'value'         => $studentInfo->sectionsName,
                                     'class'         => 'form-control datepicker',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-2"><label for="name">Program</label>';
                                 echo form_input(array(
                                
                                    'value'         => $studentInfo->sub_proram,
                                     'class'        => 'form-control datepicker',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-2"><label for="name">Batch</label>';
                                 echo form_input(array(
                                     
                                    'value'         => $studentInfo->batch_name,
                                     'class'        => 'form-control datepicker',
                                    ));
                                echo '</div>';
                                
                            endif;
                            
                            ?>
                               </div> 
                            <div class="row">
                            <?php
                            if(!empty($studentInfo)):
                                echo '<div class="col-md-3"><label for="name">Challan amount</label>';
                                echo form_input(array(
                                    'name'          => 'challan_amount',
                                     
                                    'value'         => $challan_balance_amount,
                                    'class'         => 'form-control installment_update total',
                                    ));
                                 echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Challan Comments</label>';
                                
                                $challand_comments = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
                                echo form_textarea(array(
                                    'name'          => 'challan_comment',
                                    'id'            => 'challan_comment',
                                    'cols'          => '40',
                                    'rows'          => '2',
                                    'value'         => $challand_comments->fc_comments ,
                                    'class'         => 'form-control ',
                                    ));
                                 echo '</div>';
                            
                                
                            endif;
                            
                            ?>
                               </div> 
                          <div style="padding-top:1%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="payment_challan_search" id="payment_challan_search"  value="payment_challan_search" ><i class="fa fa-search"></i> Search</button>
                                    <?php
                                    
                                    
                                    
                                    
                                        if($challan_lock == 0):
                                            
                                            //echo '<button type="submit" class="btn btn-theme" name="update_challan" id="update_challan"  value="update_challan" ><i class="fa fa-upload"></i> Update Challan</button>';
                                        //First Installment then concession
                                        $consionChln =  $this->db->get_where('fee_concession_challan',array('challan_id'=>$challandId))->row();
                                           if(empty($consionChln)):
                                               echo '<button type="submit" class="btn btn-theme" name="update_challan" id="update_challan"  value="update_challan" ><i class="fa fa-upload"></i> Update Challan</button>';
                                            else:
                                               echo '<button type="button"  class="btn btn-danger"> Please Remove Concession</button>';
                                           endif; 
                                        else:
                                            
                                            echo '<a href="feeConcession" class="btn btn-danger" target="_blank">  Fee Challan locked</a>';
                                        
                                    endif;
                                    
                                    
                                    ?>
                     
     
                                </div>
                            </div>
                                
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
           <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                    
                                      if(!empty($result)):
                                           
                                        if($challan_lock == 0 && $challan_status ==1):
//                                        if($challan_status ==1 || $challan_lock == 1):
                                        ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Challan Details </h3>
                                        <div class="table-responsive">
                                              <table class="table  " id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Actual Amount</th>
                                                          <th>Concession</th>
                                                          <th>Payable</th>
                                                          <th>Update Amount</th>
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $grand_actual_amount = '';
                                                        $grand_paid_amount = '';
                                                        $grand_concession_amount= '';
                                                      
                                                          foreach($result as $row):
                                                                                   $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id'); 
                                                               $check_concession = $this->db->get_where('fee_concession_challan',array('fee_concession_challan.challan_id'=>$challandId,'fh_id'=>$row->fee_id))->row();
                                                               $concession_amount = '';
                                                               $check_amount_grater = '';
                                                               if($check_concession):
                                                                   $concession_amount = $check_concession->concession_amount;
                                                                   $check_amount_grater = $row->actual_amount -$check_concession->concession_amount;
                                                                   else:
                                                                   $concession_amount = '';
                                                                   $check_amount_grater =$row->actual_amount;
                                                               endif;
                                                            $sn++;
                                                            echo '<tr">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->fh_head.'</th>
                                                                <th>'.$row->actual_amount.'</th>
                                                                <th>'.$concession_amount.'</th>
                                                                <th>'.$row->paid_amount.'</th>
                                                               
                                                                <th><input value="'.$row->paid_amount.'" id="'.$check_amount_grater.'"  name="update_installment[]" class="update_installment"></th>
                               
                                                                <th><input type="hidden" value="'.$row->challan_detail_id.'" name="challan_det_id[]"></th>
                                                         
                                                                 </tr>';
                                                            $grand_actual_amount  += $row->actual_amount;
                                                            $grand_paid_amount    += $row->paid_amount;
                                                            $grand_concession_amount    += $concession_amount;
                                                            
                                                              
                                                           
                                                           
                                                          endforeach;      
                                               
                                                          echo '<tr">
                                                                <th> </th>
                                                               
                                                               
                                                                <th>Total Amount</th>
                                                                <th>'.$grand_actual_amount.'</th>
                                                                <th>'.$grand_concession_amount.'</th>
                                                                    
                                                                     <th>'.$grand_paid_amount.'</th> 
                                                                <th><input readonly="readonly" type="text" class="total" value="'.$grand_paid_amount.'"></th>
                                                         
                                                                 </tr>'; 
                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
                                                 else:
                                                                         
                                                                echo '<div class="alert alert-danger alert-dismissable">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                    <strong>Challan Info  !</strong> Current Challan are Paid OR Lock</div>';
                                                           endif;
                                      endif;
                                    ?> 
                                    </div>
                                        
                                    </div>
                                  
                                </div>
                             
                    <?php
                                    echo form_close();
                                    ?>                 
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
    var grand_amount = jQuery('.installment_update').val();
    if(grand_amount== 0){
      jQuery('#update_challan').hide();
   }
 
 
 
 
    
    jQuery(document).on("change", ".update_installment", function() {
        
         var concession      = parseInt(jQuery(this).val());
        var install_head    = parseInt(this.id);
        
           if(concession > install_head){
            alert('Installment Is greater then Installment Head');
            jQuery(this).val('');
            jQuery(this).focus();
            return false;
     }
        
        
    var sum = 0;
    jQuery(".update_installment").each(function(){
        sum += +$(this).val();
    });
    jQuery(".total").val(sum);
});
    
    });
 
  </script>
   
  
 