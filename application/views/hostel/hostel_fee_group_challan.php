 
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
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                             
                                     ?>
                                <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Session </label>
                                         <?php

                                           echo form_dropdown('batch',$batch,'',  'class="form-control" id="hostel_group_challan" required="required"');
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Installment Type </label>
                                         <?php

                                           echo form_dropdown('installment_type','','',  'class="form-control" id="installment_types" required="required"');
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Challan Type</label>
                                         <?php

                                           echo form_dropdown('challan_type',$challan_type,'',  'class="form-control" required="required" id="hostel_type"');
                                             
                                            ?>
                                     
                                     </div>
                                </div>
                            <div class="row">
                                <div id="type">
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Total Days</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'total_days',
                                                    'id'          => 'total_days',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Total Days',
                                                    'type'          => 'number',
                                                    
//                                                    'value'         => $amount,
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Per Day</label>
                                         <?php
                                          $per_day =  $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
                                         
                                                echo form_input(array(
                                                    'name'          => 'per_day',
                                                    'id'          => 'per_day',
                                                    'class'         => 'form-control',
                                                    'value'         => $per_day->amount,
                                                    'type'          => 'text',
                                                    'readonly'      =>'readonly'    
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'per_day_id',
                                                    'id'            => 'per_day_id',
                                                    'class'         => 'form-control',
                                                    'value'         => $per_day->id,
                                                    'type'          => 'hidden',
                                                      
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Total Amount</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'total_amount',
                                                    'id'          => 'total_amount',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Total Amount',
                                                    'type'          => 'text',
                                                    'readonly'      => 'readonly',
                                                            
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     
                                </div>
                            </div>
                            <div class="row">
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date From</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'date_from',
                                                    'id'          => 'date_from',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From Date',
                                                    'type'          => 'text',
                                                    'required'      => 'required',
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date To</label>
                                         <?php

                                                echo form_input(array(
                                                    'id'          => 'date_to',
                                                    'name'          => 'date_to',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From To',
                                                    'type'          => 'text',
                                                   'required'      => 'required',
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Issue Date</label>
                                         <?php

                                                echo form_input(array(
                                                    'id'          => 'issue_date',
                                                    'name'          => 'issue_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Issue Date',
                                                    'type'          => 'text',
                                                    'value'         => date('d-m-Y'),
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Valid Date</label>
                                         <?php

                                                echo form_input(array(
                                                    'id'          => 'valid_date',
                                                    'name'          => 'valid_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Valid Date',
                                                    'type'          => 'text',
                                                    'required'      => 'required',
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                
                                
                            </div><div class="row">
                               
                                <div id="bank_hostel">
                                     
                                <div class="col-md-6 col-sm-5">
                                         <label for="name">Bank</label>
                                         <?php

                                               echo form_dropdown('bank_hostel', $bank_hostel,$default_bank,  'class="form-control"');
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                </div>
                                <div id="bank_mess">
                                     
                                <div class="col-md-6 col-sm-5">
                                         <label for="name">Bank</label>
                                         <?php

                                               echo form_dropdown('bank_mess', $bank_mess,16,  'class="form-control"');
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                </div>
                                
                               
                                <div class="col-md-6">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'comments',
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                'class'         => 'form-control',
                                                  
                                                ));
                                           
                                         ?>
                                    </div>
                                     
                                      
                                     
                                
                                      
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="add" id="add"  value="add" ><i class="fa fa-plus"></i> Generate Bill</button>
                                    
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                            <div class="row">
                                    <div class="col-md-12">
                                      
                                     <div id="showAllStudents">
              
                                        <!--<h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>-->
                                        
                                     
                                    </div>
                                    </div>
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
     
   
     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'dd-mm-yy'
    });
  } );
    jQuery('#total_days').keyup(function(){
      var total_days    = jQuery('#total_days').val();
      var per_day       = jQuery('#per_day').val();
      jQuery('#total_amount').val(total_days*per_day);
  });
 
  
  
    jQuery('#type').hide();
    jQuery('#bank_hostel').hide();
    jQuery('#bank_mess').hide();
    jQuery('#hostel_type').on('change',function(){
      
      var type              = jQuery('#hostel_type').val();
      var batch_id          = jQuery('#hostel_group_challan').val();
      var installment_types = jQuery('#installment_types').val();
        jQuery('#date_from').val('');
        jQuery('#date_to').val('');
      
      if(type == 1){
                 
         jQuery('#type').hide();
         jQuery('#bank_hostel').show();
         jQuery('#bank_mess').hide();
      }
      if(type == 2){
         jQuery('#type').show();
         jQuery('#bank_hostel').hide();
         jQuery('#bank_mess').show();
      }
      
            
         jQuery.ajax({
            type    : 'post',
            url     : 'hostelController/hostel_challan_setup_dates',
            data    : {'batch_id':batch_id,'type':type,'installment_types':installment_types},
             dataType    : 'json',
            success : function(result){
            console.log(result);
            jQuery('#date_from').val(result['fromDate']);
            jQuery('#date_to').val(result['toDate']);
            }   

        });
      
  });  
  
    
   //Get All Student For Group wise challan generation 
    jQuery('#hostel_group_challan').on('change',function(){
          var batch_id = jQuery(this).val();
            jQuery.ajax({
                type    :'post',
                url     :'hostelController/get_batch_wise_students',
                data    :{'batch_id':batch_id},
                success :function(result){
                   console.log(result);
                   jQuery('#showAllStudents').html(result);
                   
                   
                   
                jQuery.ajax({
                    type    :'post',
                    url     :'hostelController/get_installment_type',
                    data    :{'batch_id':batch_id},
                    success :function(result){
                    console.log(result);
                    jQuery('#installment_types').html(result);
                    }   
                
                });
                   
               },
                
            });
      }); 
  
  </script>        
   