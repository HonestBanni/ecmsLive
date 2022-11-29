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
                                                'class'         => 'form-control',
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
                                    <label for="name">Paid Date</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'challan_new_paid',
                                                'value'         => date('d-m-Y',strtotime($challan_paid_date)),
                                                'placeholder'   => 'Change Date',
                                                'class'         => 'form-control datepicker',
                                                ));
                                            echo form_input(array(
                                                'name'          => 'challan_old_paid',
                                                'value'         => $challan_paid_date,
                                                'type'          => 'hidden',
                                                'class'         => 'form-control',
                                                ));
                                         ?>
                                    </div>
                                   <?php
                                   
                                    echo '<div class="col-md-3"><label for="name">Date Change Comments</label>';
                                      
                                                            $this->db->where(array('challan_id'=>$challandId));
                                                            $this->db->order_by('chaln_chage_id','desc');
                                                            $this->db->limit(1);
                                     $challand_comments =   $this->db->get('fee_challan_date_change')->row();
//                                $this->CRUDModel->get_where_row('fee_challan_date_change',);
                               $comment = '';
                               if(!empty($challand_comments->comment)):
                                   $comment = $challand_comments->comment;
                             
                               endif;
                               
                                echo form_textarea(array(
                                    'name'          => 'change_date_challan_comment',
                                    
                                     
                                    'cols'          => '40',
                                    'rows'          => '2',
                                    'required'          => 'required',
                                    'value'         => $comment ,
                                    'class'         => 'form-control ',
                                    ));
                                 echo '</div>';
                                   
                                   ?>  
                                   <?php 
                                      
                                    endif;
                                    
                                    ?>   
                                </div>
                            <div class="row">
                            <?php
                            if(!empty($studentInfo)):
                                      echo form_input(array(
                                                'name'          => 'student_id',
                                                'value'         => $studentInfo->student_id,
                                          'readonly'            => 'readonly',
                                                'type'          => 'hidden'
                             
                                                ));
                                echo '<div class="col-md-3"><label for="name">Student Name</label>';
                                 echo form_input(array(
                                   'readonly'            => 'readonly',
                                    'value'         => $studentInfo->student_name,
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                          
                                echo '<div class="col-md-3"><label for="name">Father Name</label>';
                                 echo form_input(array(
                                    'readonly'            => 'readonly',
                                    'value'         => $studentInfo->father_name,
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                           
                                echo '<div class="col-md-2"><label for="name">Class</label>';
                                 echo form_input(array(
                                  'readonly'            => 'readonly',
                                    'value'         => $studentInfo->sectionsName,
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-2"><label for="name">Program</label>';
                                 echo form_input(array(
                                'readonly'            => 'readonly',
                                    'value'         => $studentInfo->sub_proram,
                                     'class'        => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-2"><label for="name">Batch</label>';
                                 echo form_input(array(
                                     'readonly'            => 'readonly',
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
                                echo '<div class="col-md-3"><label for="name">Challan amount</label>';
                                echo form_input(array(
                                    'name'          => 'challan_amount',
                                    'readonly'      => 'readonly', 
                                    'value'         => $challan_balance_amount,
                                    'class'         => 'form-control installment_update total',
                                    ));
                                 echo '</div>';
                                
                                 echo '<div class="col-md-3"><label for="name">Challan Comments</label>';
                                $challand_comments = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
                                echo form_textarea(array(
                                    'name'          => 'challan_comment',
                                    'id'            => 'challan_comment',
                                     'readonly'            => 'readonly',
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
                                    
                                    if(!empty($studentInfo)):
                                        echo '<button type="submit" class="btn btn-theme" name="change_date" id="change_date"  value="change_date" ><i class="fa fa-check"></i> Change Date</button>';
                                    endif;
                                    ?>
                     
     
                                </div>
                            </div>
                                
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              <?php
              
              if(!empty($error_msg)):
                  echo $error_msg['date'];
              endif;
                   

              
              ?>
              
                        <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                      
                                      if(!empty($result)):
                                        if($result[0]->challan_status ==2):
                                        ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Challan Details </h3>
                                        <div class="table-responsive">
                                              <table class="table  " id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Challan Detail</th>
                                                          <th>Paid Amount</th>
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $grand_actual_amount = '';
                                                        $grand_paid_amount = '';
                                                      
                                                          foreach($result as $row):
                                                               
                                                            
                                                            $sn++;
                                                            echo '<tr">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->fh_head.'</th>
                                                                <th>'.$row->actual_amount.'</th>
                                                                <th>'.$row->paid_amount.'</th>
                                                                </tr>';
                                                            $grand_actual_amount  += $row->actual_amount;
                                                            $grand_paid_amount    += $row->paid_amount;
                                                     
                                                              
                                                           
                                                           
                                                          endforeach;      
                                               
                                                          echo '<tr">
                                                                <th> </th>
                                                                <th>Total Amount</th>
                                                                <th>'.$grand_actual_amount.'</th>
                                                                <th>'.$grand_paid_amount.'</th>
                                                                
                                                         
                                                                 </tr>'; 
                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
                                                 else:
                                                                         
                                                                echo '<div class="alert alert-danger alert-dismissable">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                    <strong>Challan No Paid  !</strong> Contact to Head Of department</div>';
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
    var sum = 0;
    jQuery(".update_installment").each(function(){
        sum += +$(this).val();
    });
    jQuery(".total").val(sum);
});
    
    });
 
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
   
  
 