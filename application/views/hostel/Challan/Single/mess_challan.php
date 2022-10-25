 
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
                                         <label for="name">Student name,College No or Form No</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'h_student_name',
                                                    'id'            => 'h_student_name',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Student Name',
                                                    'type'          => 'text',
                                                    'required'      => 'required',
//                                                    'value'         => $feehead,
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'h_student_id',
                                                    'id'            => 'h_student_id',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'student_id',
                                                    'type'          => 'hidden',
//                                                    'value'         => $id,
                                                    ));
                                                 echo form_input(array(
                                                    'name'          => 'batch_id',
                                                    'id'            => 'batch_id',
                                                    'type'          => 'hidden',
//                                                    'value'         => $id,
                                                    ));
                                              
                                             
                                            ?>
                                     
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Installment Type </label>
                                         <?php

                                           echo form_dropdown('installment_type',$installment_type,'1',  'class="form-control" id="installmentNo" required="required"');
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Total Days</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'total_days',
                                                    'id'          => 'total_days',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Total Days',
                                                    'type'          => 'number',
                                                    'required'      => 'required',
//                                                    'value'         => $amount,
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Per Day</label>
                                         <?php
                                            
                                         
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
                                                    'id'          => 'per_day_id',
                                                    'class'         => 'form-control',
                                                    'value'         => $per_day->id,
                                                    'type'          => 'hidden',
                                                      
                                                    ));
                                                
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                    </div>
                           
                                      
                                        <div class="row">
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date From</label>
                                         <?php
                                                $from_date = '';
                                                if(!empty($default_date)):
                                                    $from_date = $default_date->fromDate;
                                                    else:
                                                   $from_date = ''; 
                                                endif;
                                                
                                                echo form_input(array(
                                                    'name'          => 'date_from',
                                                    'id'            => 'fromDate',
                                                    
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From Date',
                                                    'type'          => 'text',
                                                    'required'      => 'required',
//                                                    'value'         => '01-09-2020'
                                                    'value'         => date('d-m-Y')
//                                                    'value'         => date('d-m-Y',  strtotime($from_date))
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date To</label>
                                         <?php

                                                $to_date = '';
                                                if(!empty($default_date)):
                                                    $to_date = $default_date->toDate;
                                                    else:
                                                   $to_date = ''; 
                                                endif;
                                                echo form_input(array(
                                                    'name'          => 'date_to',
                                                    'id'            => 'toDate',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From To',
                                                    'type'          => 'text',
                                                    'required'      => 'required',
//                                                    'value'         => '30-09-2020'
                                                    'value'         => date('d-m-Y')
//                                                    'value'         => date('d-m-Y',  strtotime($to_date))
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Issue Date</label>
                                         <?php

                                                echo form_input(array(
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

                                               $valid_date = '';
                                                if(!empty($default_date)):
                                                    $valid_date = $default_date->validDate;
                                                    else:
                                                   $valid_date = ''; 
                                                endif;
                                         
                                                    echo form_input(array(
                                                    'name'          => 'valid_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Valid Date',
                                                    'type'          => 'text',
                                                    'required'      => 'required',
                                                    'value'         => date('d-m-Y')
//                                                    'value'         => date('d-m-Y',  strtotime($valid_date))
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                
                            </div>
                                
                                
                                   
                            <div class="row">
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
                                     <div class="col-md-6 col-sm-5">
                                         <label for="name">Bank</label>
                                         <?php
//                                            echo '<pre>';print_r($bank);die;
                                               echo form_dropdown('bank', $bank,13,  'class="form-control"');
                                                 
                                             
                                            ?>
                                     
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
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                             
 
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
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
    });
  } );
  jQuery('#total_days').keyup(function(){
      var total_days    = jQuery('#total_days').val();
      var per_day       = jQuery('#per_day').val();
      jQuery('#total_amount').val(total_days*per_day);
  });
  </script>        
   