 
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
              <section class="course-finder" >
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                    
                                    
                                <div class="col-md-3 col-sm-5">
                                        <label for="name">College #</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'value'         => $studentInfo->college_no,
                                                                'class'         => 'form-control',
                                                                 'readonly'      => 'readonly',
                                                                'placeholder'   => 'College #')
                                                             );
                                                      ?>
                                               
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'stdName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->student_name,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                'readonly'      => 'readonly',
                                                                 )
                                                             );
                                                      ?>
                                             
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Class</label>
                                        
                                          
                                                    
                                                <?php
                                                    echo  form_input(
                                                             array(
//                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->sub_proram,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                            <label for="name">Batch</label>
                                           
                                                    
                                                <?php
                                                    echo  form_input(
                                                             array(
//                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->batch_name,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                              
                                            
                                     </div>
                           
                           
                              
                           </div><!--//section-content-->
                            
                           <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                              <label for="name">Fee Head</label>
                                              
                                                  <?php 
                                            
                                               echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_name',
                                                           'value'         => $challan_head_info->title,
                                                           'class'         => 'form-control',
                                                           'placeholder'   => 'Payment Category',
                                                            )
                                                        );
                                               echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_id',
                                                           'value'         => $challan_head_info->hostel_head_id,
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'           => 'hostel_info_id',
                                                           'value'          => $challan_head_info->id,
                                                           'class'          => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'           => 'hostel_id',
                                                           'value'          => $this->uri->segment(2),
                                                           'class'          => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'challan_id',
                                                            'value'          => $this->uri->segment(3),
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'batch_id',
                                                            'value'        => $studentInfo->batch_id,
                                                           'class'         => 'form-control',
                                                           'type'          => 'hidden',
                                                           
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'hostel_challan_type',
                                                            'value'        => $studentInfo->head_type,
                                                           'class'         => 'form-control',
                                                           'type'          => 'hidden',
                                                           
                                                            )
                                                        );
//                                             
                                            ?>
                                              
                                          
                                    </div>
                                     <?php 
                                     if($studentInfo->head_type == 1):
                                       ?>
                                        <div class="col-md-3 col-sm-5">
                                          <label for="name">Account</label>
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                'id'            => 'fee_head_amount',
                                                                'type'          => 'number',
                                                                'value'         => $challan_head_info->amount,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Amount',
                                                                 )
                                                             );
                                                    
                                                      ?>
                                            
                                            
                                        </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Balance Type</label>
                                        
                                           
                                                <?php
                                                    $default_value = '';
                                                    if($challan_head_info->old_challan_id == 0):
                                                        $default_value = '0';
                                                        else:
                                                        $default_value = '1';
                                                    endif;
  
                                                
                                                    echo form_dropdown('balance_type', $balance_type, $default_value,  'class="form-control"');
                                                      ?>
                                            
                                            
                                     </div>
                               
                               
                               <div class="col-md-6">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'comments',
                                                'required'          => 'required',
                                                'value'       => $challan_head_info->comments,
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                'class'         => 'form-control',
                                                  
                                                ));
                                           
                                         ?>
                                    </div>
 
                                         
                                           <?php
                                           
                                           else:
                                            ?>
                                        <div class="col-md-3 col-sm-5">
                                          <label for="name">Total Days</label>
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'total_days',
                                                                'id'            => 'total_days',
                                                                'type'          => 'number',
                                                                'value'       => $challan_head_info->total_days,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Amount',
                                                                 )
                                                             );
                                                      ?>
                                         </div>        
                                        <div class="col-md-3 col-sm-5">
                                          <label for="name">Per Days</label>
                                                <?php
                                                    echo form_input(array(
                                                    'name'          => 'per_day',
                                                    'id'            => 'per_day',
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
                                          <label for="name">Account</label>
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                'id'            => 'total_amount',
                                                                'type'          => 'number',
                                                                'value'       => $challan_head_info->amount,
                                                                'class'         => 'form-control',
                                                                  
                                                                'placeholder'   => 'Amount',
                                                                 )
                                                             );
                                                      ?>
                                         </div>   
                                          <div class="col-md-3 col-sm-5">
                                          <label for="name">Balance Type</label>
                                        
                                           
                                                <?php
                                                    $default_value = '';
                                                    if($challan_head_info->old_challan_id == 0):
                                                        $default_value = '0';
                                                        else:
                                                        $default_value = '1';
                                                    endif;
  
                                                
                                                    echo form_dropdown('balance_type', $balance_type, $default_value,  'class="form-control"');
                                                      ?>
                                            
                                            
                                     </div>
                                    <div class="col-md-6">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'comments',
                                                'required'          => 'required',
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                 'value'       => $challan_head_info->comments,
                                                'class'         => 'form-control',
                                                  
                                                ));
                                           
                                         ?>
                                    </div>
                                                
                                                   
                                            <?php
                                     endif;
                                     
                                     ?>
                                      
                                 
                                     
                                </div> 
                           <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                     <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-book"></i>Update Head</button>
                                     
     
                                </div>
                            </div>
                           <br/>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        </div>  
                        
                        
                    </section>
            
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
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
  
  
  
  
  if(jQuery('#total_days').val() >0){
      
      var total_day1s    = jQuery('#total_days').val();
      var per_day1       = jQuery('#per_day').val();
      
     jQuery('#total_amount').val(total_day1s*per_day1); 
  }
  
  </script>    
     
  
 