 
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
                 
                $messge = $this->session->flashdata('error_payment');
                
                if(!empty($messge)):
                    '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Fee ERROR !</strong> <br/>'.$messge.'</strong></div>'; 
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
                                    <label for="name">Program</label>
                                    
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control required="required" feeProgrameId" id="feeProgrameId"');
                                        ?>
                                    
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    
                                        <?php 
                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" required="required"  id="showFeeSubPro"');
                                        ?>
                                    
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Batch</label>
                                        <?php
                                            $batch_id = array(
                                                ''=>"Select Batch"
                                            );
                                            echo form_dropdown('batch_id', $batch_id, '','class="form-control"  required="required" id="batch_id"');
                                        ?>
                                </div>    
                                <div class="col-md-3">
                                    <label for="name">Section</label>
                                    
                                        <?php 
                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('section', $Section,$sec_id,  'class="form-control section" id="showSections"');
//                                                echo form_dropdown('section', $Section,$sec_id,  'class="form-control section" required="required" id="showSections"');
                                        ?>
                                    
                                </div>
                                    
                                <div class="col-md-3">
                                    <label for="name">Payment Category</label>
                                        <?php
                                            $pc_id = array(
                                                ''=>"Payment Category"
                                            );
                                            echo form_dropdown('pc_id', $pc_id, '','class="form-control payment_cat" required="required" id="pc_id"');
                                        ?>
                                </div>
                                
                                    <div class="col-md-6">
                                              <label for="name">Bank</label>
                                            <?php 
                                              echo form_dropdown('bank_id',$bank,$default_bank,  'class="form-control" id="bank_id"');
                                         ?>
                                    </div>
                               
                                         <div class="col-md-3">
                                    <label for="name">From Date</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'fromDate',
                                                'id'            => 'fromDate',
                                                'value'         => date('d-m-Y'),
                                                'rows'          => '2',
                                                'class'         => 'form-control datepicker',
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Up To Date</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'uptoDate',
                                                'id'            => 'uptoDate',
                                                'value'         => date('d-m-Y'),
                                                 'rows'          => '2',
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                     
                                    <div class="col-md-3">
                                        <label for="name">Valid till</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'dueDate',
                                                'id'            => 'dueDate',
                                                'value'         => date('d-m-Y'),
                                                 'rows'          => '2',
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Issue Date</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'issuDate',
                                                'id'            => 'issuDate',
                                                'value'         => date('d-m-Y'),
                                                 'rows'          => '2',
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                              <label for="name">Financial Year</label>
                                            <?php 
                                              echo form_dropdown('year_id', $year,$default_year_fy,  'class="form-control" id="year"');
                                         ?>
                                    </div>
                                      
                                    
                                     <div class="col-md-12">
                                          <label for="name">Comment</label>
                                        <?php
                                            
                                        
                                         echo form_textarea(array(
                                                'name'          => 'challan_comment',
                                                'id'            => 'challan_comment',
                                                'cols'          => '40',
                                                'rows'          => '2',
                                                'value'         => '',
                                                'class'         => 'form-control ',
                                                'placeholder'   => 'Comment',
                                                ));
                                        
//                                            echo form_input(array(
//                                                'name'          => 'comment',
//                                                'id'            => 'challan_comment',
//                                                'class'         => 'form-control',
//                                                'placeholder'   => 'Comment',    
//                                                ));
                                         
                                        ?>
                                       
                                        
                                     </div>
                                     
                                      
                                </div>
                           
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    
                                    <button type="button" class="btn btn-theme" name="fee_challan_search" id="fee_challan_search"  value="fee_challan_search" ><i class="fa fa-search"></i> Search</button>
                                   
                                    
                                    <button type="submit" class="btn btn-theme" name="fee_save_challan" id="fee_save_challan"  value="fee_save_challan" ><i class="fa fa-save"></i> Generate</button>
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              <div id="show_fee_students">
                  
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
     
     jQuery('#batch_id').on('change',function(){
         var showFeeSubPro = jQuery('#showFeeSubPro').val();
         var batch_id = jQuery('#batch_id').val();
         jQuery.ajax({
             type:'post',
             url:  'FeeController/getPaymentCategoryBatchWise', 
             data:  {'sub_program_id':showFeeSubPro,'batch_id':batch_id},
             success: function(result){
                 jQuery('#pc_id').html(result);
             }
         });
         
     });
     
 });
    
    
    
    $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>     
  
 