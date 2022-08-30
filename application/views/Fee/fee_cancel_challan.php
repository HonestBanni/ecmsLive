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
         
           <?php 
           
            
           echo form_open('',array('class'=>'course-finder-form')); ?>
          <div class="col-md-12">
               <?php
          
              
                if($this->session->flashdata('error_payment')):
                    
                      echo '<div class="alert alert-danger alert-dismissable center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Sorry! '.$this->session->flashdata('error_payment').'</strong> </div>';
              
                endif; 
          
          ?>
              
                  <section class="course-finder" style="padding-bottom: 2%;">                    
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                    <div class="col-md-3">
                                    <label for="name">Challan No </label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'challan_id',
                                                'id'            => 'challan_id',
                                                'value'         => $challan_id,
                                                 'placeholder'  => 'Enter Challan No',
                                                'class'         => 'form-control',
                                                
                                                ));
                                         
                                         ?>
                                    </div>
                                </div>
                            <?php
                            
                            if($update_form ==2):
                                
                            
                            
                            ?>
                                <div class="row">
                                    
                               <div class="col-md-3">
                                    <label for="name">Form#</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'form_no',
                                                'id'            => 'form_no',
                                                'value'         => $student_info->form_no,
                                                 
                                                'class'         => 'form-control',
                                                'disabled'      => 'disabled',
                                                ));
                                         
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">College No</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'student_name',
                                                'id'            => 'student_name',
                                                'value'         => $student_info->college_no,
                                                'placeholder'   => 'College No',
                                                'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                           
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Student Name</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'student_name',
                                                'id'            => 'student_name',
                                                'value'         => $student_info->student_name,
                                                 'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                           
                                            echo form_input(array(
                                                'name'          => 'student_id',
                                                 'value'         => $student_info->student_id,
                                                 'class'         => 'form-control',
                                                  'type'        =>'hidden'
                                                 
                                                ));
                                           
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Father Name</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'value'         => $student_info->father_name,
                                                
                                                'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                           
                                         ?>
                                    </div>
                               
                                                  
                                </div>
                            <div class="row">
                                
                         
                               <div class="col-md-3">
                                    <label for="name">Program</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'value'         => $student_info->programe_name,
                                                
                                                'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                           
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                        <?php 
                                         
                                            $sub_pro_name = $this->CRUDModel->sub_proDropDown('sub_programes', '', 'sub_pro_id', 'name',array('sub_pro_id'=>$student_info->sub_pro_id));
                                             echo form_dropdown('sub_pro_name', $sub_pro_name,$student_info->sub_pro_id,  'class="form-control" id="install_type" readonly="readonly"');
                                              form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'value'         => $student_info->sub_proram,
                                                 'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
 
                                       
                                           
                                         ?>
                                    </div>
<!--                                <div class="col-md-3">
                                              <label for="name">Bank</label>
                                            <?php 
                                                form_dropdown('bank_id', $bank, 8,  'class="form-control" id="bank_id" ');
                                         ?>
                                    </div>-->
                                
                                <div class="col-md-3">
                                    <label for="name">Installment </label>
                                    
                                    <?php 
                                        
                                    $pc_array     = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', '', 'pc_id', 'title',array('pc_id'=>$challan_info->fc_pay_cat_id));
                                    
                                    
                                    echo form_dropdown('pc_array', $pc_array, $challan_info->fc_pay_cat_id,'id="payment_challan" class="form-control" readonly="readonly"');
                                    
                                     
                                           
                                         ?>
                                    </div>
                                <div class="col-md-3">
                                    <label for="name">Installment Type</label>
                                        <?php 
                                        
                                        $installment_type = $this->db->get_where('fee_installment_type',array('id'=>$challan_info->installment_type))->row();
                                              echo form_input(array(
                                              
                                                'id'            => 'install_type_name',
                                                'value'         => $installment_type->installment_title,
                                                 'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                              echo form_input(array(
                                                'name'          => 'install_type',
                                                'id'            => 'install_type_id',
                                                'value'         => $installment_type->id,
                                                 'class'        => 'form-control',
                                                 'type'         => 'hidden'
                                                ));
                                        
 
                                       
                                           
                                         ?>
                                    </div>
                               
                                     
                          </div>
                            <div class="row">
                                  <div class="col-md-3">
                                    <label for="name">From Date</label>
                                        <?php 
                                        $from_date = '';
 
                                       
                                            echo form_input(array(
                                                 "readonly"=>"readonly",
                                                'value'         => date('d-m-Y',strtotime($challan_info->fc_paid_form)),
                                                 'name'         => 'fromDate',
                                                'class'         => 'form-control',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Up To Date</label>
                                            <?php  
                                            echo form_input(array(
                                                   "readonly"=>"readonly",
                                                'name'          => 'uptoDate',
                                                'id'            => 'uptoDate',
                                                'value'         => date('d-m-Y',strtotime(@$challan_info->fc_paid_upto)),
                                                 
                                                'class'         => 'form-control',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Valid till</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'dueDate',
                                                'id'            => 'dueDate',
                                                'value'         => date('d-m-Y',strtotime($challan_info->fc_dueDate)),
                                                "readonly"=>"readonly", 
                                            
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Issue Date</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'issueDate',
                                                'id'            => 'v',
                                                'value'         => date('d-m-Y',strtotime($challan_info->fc_issue_date)),
                                                 "readonly"=>"readonly",
                                                
                                                'class'         => 'form-control ',
                                                
                                                ));
                                         ?>
                                    </div>
                                    
                             
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                        <label for="name">Cancel Date</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'cancel_date',
                                                'required'      => 'required',
                                                'value'         => date('d-m-Y'),
                                                 'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>   
                                     
                                         
                            <div class="col-md-6">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'fee_comments',
                                                'id'            => 'challan_comment',
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                'class'         => 'form-control',
                                                'required'      => 'required',  
                                                ));
                                           
                                         ?>
                                    </div>
                            </div>
                              <?php
                            
                    
                         
                             
                            endif;
                            
                            ?>
                          <div style="padding-top:2%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                   
                                    <?php
                                  
                                    if(@$challan_info->fc_ch_status_id == 1):
                                        echo '<button type="submit" class="btn btn-theme" name="updateChallan" id="updateChallan"  value="updateChallan" ><i class="fa fa-book"></i>Cancel Challan</button>';
                                   
                                    endif;
                                    
                                    ?>
                                    
                                    
                                    
                     
     
                                </div>
                            </div>
                                
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
              <?php
                                    
                                    if(@$challan_info->fc_ch_status_id == 2):
                                        echo '<div class="alert alert-danger alert-dismissable center">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <strong>Sorry! Challan Already Paid</strong> </div>';
                                   
                                    endif;
                                    
                                    ?>
              
                  <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <?php
                                  
                                
                                      if(!empty($result)):
                                        
                                        ?>
                                
              
                                        <h3 class="has-divider text-highlight">Challan Details </h3>
                                        <div class="table-responsive">
                                            <div id="default_record">
                                               <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Challan Detail</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $grand_actual_amount = '';
                                                        $grand_paid_amount = '';
                                                      
                                                          foreach($result as $row):
//                                                             echo '<pre>';print_r($row);die;  
                                                          
                                                            $sn++;
                                                            echo '<tr>
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->fh_head.'</th>
                                                                 <th>'.$row->actual_amount.'</th>
                                                                 
                                                                 </tr>';
                                                            $grand_actual_amount  += $row->actual_amount;
                                                            $grand_paid_amount    += $row->actual_amount;
                                                        endforeach;      
                                               
                                                          echo '<tr>
                                                                 
                                                                <th></th>
                                                                <th>Total Amount</th>
                                                                <th>'.$grand_actual_amount.'</th>
                                                                 </tr>'; 
                                                        ?>

                                                    </tbody>
                                            </table>  
                                            </div>
                                        
                                             
                                        </div>
                                          <?php
                                        endif;
                                  
                                    ?> 
                                 
                                     
                                       
                                             
                                            <div id="fetch_result">
                                               
                                            </div>
                                             
                                   
                                        
                                        
                                    </div>
                                  
                                </div>
                             
                   
                  
                </div>
           <?php
                                    echo form_close();
                                    ?>  
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
 
   
  
      <script>
  jQuery(document).ready(function(){
              jQuery('#fetch_result').show(); 
    
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });

     
    jQuery(document).on("change", ".update_installment", function() {
    var sum = 0;
    jQuery(".update_installment").each(function(){
        sum += +$(this).val();
    });
    jQuery(".total").val(sum);
  } );
   
   
    jQuery('#payment_challan').on('change',function(){
        var pc_id = jQuery('#payment_challan').val();
          var challan_id = jQuery('#challan_id').val();     
            jQuery.ajax({
                            type   :'post',
                            url    :'feeController/get_payment_date',
                            data   :{'pc_id':pc_id,'challan_id':challan_id},
                            success :function(result){
                               var date = jQuery.parseJSON(result);
                                jQuery('#fromDate').val(date.fee_from);
                                jQuery('#uptoDate').val(date.fee_to); 
                                jQuery('#dueDate').val(date.valid_till); 
                                jQuery('#install_type_name').val(date.install_type_name); 
                                jQuery('#install_type_id').val(date.install_type_id); 
                            },
                            complete:function(){
                                
                                
                                jQuery('#fetch_result').show();    
                                jQuery('#default_record').remove();    
                             
                              
                                
                        jQuery.ajax({
                            type   :'post',
                            url    :'feeController/updat_fee_record',
                            data   :{'pc_id':pc_id},
                            success :function(result){
//                               var date = jQuery.parseJSON(result);
//                                jQuery('#fromDate').val(date.fee_from);
//                                
                                  jQuery('#fetch_result').html(result);
                                 
                            }
                         });
                                
                         }
                            
                        });
        
    });
   
   
  
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>  