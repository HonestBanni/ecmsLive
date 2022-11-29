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
                                 $challan_balance_amount += $row->balance;
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
                                         
                                         ?>
                                    </div>
                                   <?php 
                                   
                                                if(!empty($studentInfo)):
                                               
                                   ?>
                               <div class="col-md-3">
                                    <label for="name">Concession Type</label>
                                        <?php 
                                        
                                           echo form_dropdown('concession_type_id', $concession_type,'', ' class="form-control" ');
                                        
                                         
                                         ?>
                                    </div>
                               <div class="col-md-4">
                                    <label for="name">Concession Comments</label>
                                        <?php 
                                           echo form_textarea(array(
                                    'name'          => 'concession_comment',
                                    'cols'          => '40',
                                    'rows'          => '2',
                                    'class'         => 'form-control ',
                                    ));
                                           
                                         
                                         ?>
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
                                                'name'          => 'student_id',
                                                'value'         => $studentInfo->student_id,
                                                'type'          => 'hidden'
                             
                                                ));
                                 echo form_input(array(
                                     
                                     'value'         => $studentInfo->student_name,
                                     'readonly'      =>'readonly',
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                          
                                echo '<div class="col-md-3"><label for="name">Father Name</label>';
                                 echo form_input(array(
                                    
                                    'value'         => $studentInfo->father_name,
                                     'class'         => 'form-control ',
                                     'readonly'      =>'readonly',
                                    ));
                                echo '</div>';
                           
                                echo '<div class="col-md-2"><label for="name">Class</label>';
                                 echo form_input(array(
                                  
                                    'value'         => $studentInfo->sectionsName,
                                     'class'         => 'form-control',
                                     'readonly'      =>'readonly',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-2"><label for="name">Program</label>';
                                 echo form_input(array(
                                
                                    'value'         => $studentInfo->sub_proram,
                                     'class'        => 'form-control',
                                     'readonly'      =>'readonly',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-2"><label for="name">Batch</label>';
                                 echo form_input(array(
                                     
                                    'value'         => $studentInfo->batch_name,
                                     'class'        => 'form-control',
                                     'readonly'      =>'readonly',
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
                                    'readonly'      =>'readonly',
                                    'value'         => $challan_balance_amount,
                                    'class'         => 'form-control installment_update',
                                    ));
                                 echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Challan Comments</label>';
                                
                                $challand_comments = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
                                echo form_textarea(array(
                                    'name'          => 'challan_comment',
                                    'id'            => 'challan_comment',
                                    'readonly'      =>'readonly',
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
                                   
                                    if(@$challand_comments->fc_ch_status_id != 2):
                                        echo '<button type="submit" class="btn btn-theme" name="concession_challan" id="concession_challan"  value="concession_challan" ><i class="fa fa-upload"></i>Concession Update</button>';
                                    endif;
                                    ?>
                                </div>
                            </div>
                          </div><!--//section-content-->
           
                        
                    </section>
                           <?php
                        
                                $messge = $this->session->flashdata('refun_message'); 
                            if(!empty($messge)):
                                         echo '<div class="alert alert-danger alert-dismissable center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>'.$messge.'</div>';
                            endif;
                   

                        
                        ?>
           <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                
                               
                                      if(!empty($result)):
                                        if($result[0]->challan_status ==1):
                                        ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Challan Details </h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Challan Detail</th>
                                                          <th>Concession Amount</th>
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $grand_actual_amount = '';
                                                        $grand_paid_amount = '';
                                                      
                                                          foreach($result as $row):
                                                            
                                                            
                                                            $sn++;
                                                            echo '<tr ">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->fh_head.'</th>
                                                                <th>'.$row->actual_amount.'</th>
                                                                <th><input name="update_installment[]" class="update_installment"></th>
                                                                <th><input type="hidden" value="'.$row->challan_detail_id.'" name="challan_concess_id[]"></th>
                                                         
                                                                 </tr>';
                                                            $grand_actual_amount  += $row->actual_amount;
                                                            $grand_paid_amount    += $row->paid_amount;
                                                     
                                                              
                                                           
                                                           
                                                          endforeach;      
                                               
                                                          echo '<tr">
                                                                <th> </th>
                                                                <th>Total Amount</th>
                                                                <th>'.$grand_actual_amount.'</th>
                                                              
                                                               <input readonly="readonly" type="hidden" class="total_amount" value="'.$grand_actual_amount.'">
                                                                <th><input readonly="readonly" type="text" class="total" value=" "></th>
                                                         
                                                                 </tr>'; 
                                                          echo '<tr">
                                                                <th> </th>
                                                                <th>Concession Amount</th>
                                                                <th> </th>
                                                                <th><input readonly="readonly" type="text" name="concession_amount" class="concession_amount" value=""></th>
                                                         
                                                                 </tr>'; 
                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
                                                 else:
                                                                         
                                                                echo '<div class="alert alert-danger alert-dismissable">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                    <strong>Challan Information  !</strong>Challan Status is Paid or Contact To Fee Department</div>';
                                                           endif;
                                      endif;
                                    ?> 
                                 
                                        
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
    var sum = 0;
    jQuery(".update_installment").each(function(){
        sum += +$(this).val();
    });
    
    var concession = 0;
    concession = jQuery(".total_amount").val()-sum;
    jQuery(".concession_amount").val(sum);
    jQuery(".total").val(concession);
});

 });
  </script>
 
   
  
 