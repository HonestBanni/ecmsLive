 
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
               <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
               <section class="course-finder" >
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                          
                 
                           <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                              <label for="name">Head</label>
                                              
                                                  <?php 
                                            
                                               echo  form_input(
                                                        array(
                                                            'name'          => 'fee_head_name',
                                                            'id'            => 'fee_head_name',
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Payment Category',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_id',
                                                           'id'            => 'fee_head',
                                                           'class'         => 'form-control',
                                                           'type'          => 'hidden',
                                                            )
                                                        );
                                            
                                            $rand = rand(1,10000000); $date = date('YmdHis');
                                            echo  form_input(
                                                             array(
                                                                'name'          => 'form_code',
                                                                'id'            => 'form_code',
                                                                'type'          => 'hidden',
                                                                'value'         => md5($rand.$date),
                                                                 )
                                                             );
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
                                    
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Comment</label>
                                        <?php
                                            
                                            echo form_textarea(array(
                                                'name'          => 'comment',
                                                'id'            => 'comment',
                                                'rows'          => '2',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Comment',    
                                                ));
                                         
                                        ?>
                                       
                                        
                                     </div>
                               <div class="col-md-2 col-sm-5">
                                          <label for="name">Last Date</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'last_date',
                                                                'id'            => 'last_date',
                                                                'type'          => 'text',
                                                                'class'         => 'form-control datepicker',
                                                                'placeholder'   => 'Date',
                                                                 )
                                                             );
                                                      ?>
                                            
                                            
                                     </div>
                                </div> 
                           
                           
                           <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                     <button type="button" class="btn btn-theme" name="add_head" id="add_head"  value="add_head" ><i class="fa fa-plus"></i> Add Head</button>
                                      
     
                                </div>
                            </div>
                           <br/>
                           <br/>
                                  
                                
                             
                            
                        </div>  
                        
                        
                    </section>
              
              <div id="show_new_heads">
                  
              </div>
              <section class="course-finder" >
                        <h1 class="section-heading text-highlight">
                            <span class="line">Student Information</span>
                        </h1>
                        <div class="section-content" >
                             
                                <div class="row">
                                    
                                    
                                <div class="col-md-5 col-sm-5">
                                        <label for="name">College #</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'id'            => 'add_new_head_students',
                                                                'type'          => 'text',
                                                                
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Enter College#, Name, Form#')
                                                             );
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'student_id',
                                                                'id'            => 'student_id',
                                                                'type'          => 'hidden',
                                                                'class'         => 'form-control',
                                                                
                                                             )
                                                             );
                                                      ?>
                                               
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'stdName',
                                                                'id'            => 'stdName',
                                                                'type'          => 'text',
                                                                
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                
                                                      ?>
                                             
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Father Name</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'fName',
                                                                'id'            => 'fName',
                                                                'type'          => 'text',
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                
                                                      ?>
                                             
                                            
                                     </div>
                                 
                                 
                           
                           
                              
                           </div><!--//section-content-->
                            <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    <button type="button" class="btn btn-theme" name="add_student" id="add_student"  value="add_student" ><i class="fa fa-plus"></i> Add Student</button>
                                    <button type="submit" class="btn btn-theme" name="generateChallan" id="generateChallan"  value="generateChallan"><i class="fa fa-print"></i>Generate Challan</button>
                                    
     
                                </div>
                            </div>
                           <br/>
                           <br/>
                        </div>  
                        
                        
                    </section>
             
            <?php
                echo form_close();
            ?>
                <div id="show_new_heads_students">
                  
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
        //Add New Heads
        jQuery('#add_head').on('click',function(){
             var fee_head           = jQuery('#fee_head').val();
             var fee_head_amount    = jQuery('#fee_head_amount').val();
             var form_code          = jQuery('#form_code').val();
             var last_date          = jQuery('#last_date').val();
             var comments           = jQuery('#comment').val();
             
       
        if(fee_head === ''){
            alert('Enter Heads');
            jQuery('#fee_head_name').focus();
            return false;
        }
            
        if(fee_head_amount === ''){
            alert('Enter Head Amount');
            jQuery('#fee_head_amount').focus();
            return false;
        }
        if(last_date === ''){
            alert('Enter Date');
            jQuery('#last_date').focus();
            return false;
        }
        
        
        var data = {
                 'fee_head'     : fee_head,
                 'amount'       : fee_head_amount,
                 'last_date'    : last_date,
                 'comment'      : comments,
                 'form_code'    : form_code,
             };
             jQuery.ajax({
                 type   :'POST',
                 url    :'ajaxAddHead',
                 data   :data,
                 success:function(result){
                    console.log(result);
                    jQuery('#show_new_heads').html(result);
                    jQuery('#fee_head_name').val('');
                    jQuery('#fee_head_amount').val('');
//                    jQuery('#last_date').val('');
                    jQuery('#comment').val(''); 
//                    jQuery('#fee_head_name').focus();
                 }
             });
        });
      
        //Add Students
         jQuery('#add_student').on('click',function(){
             var student_id           = jQuery('#student_id').val();
             var form_code          = jQuery('#form_code').val(); 
             
       
        if(student_id === ''){
            alert('Please Student a Student .... !');
            jQuery('#add_new_head_students').focus();
            return false;
        }
         var data = {
                    'student_id'    : student_id,
                    'formCode'      : form_code
                  };
             jQuery.ajax({
                 type   :'POST',
                 url    :'ajaxAddNewHeadStudents',
                 data   :data,
                 success:function(result){
                     console.log(result);
                     jQuery('#show_new_heads_students').html(result);
                jQuery('#add_new_head_students').val('');     
                jQuery('#stdName').val('');     
                jQuery('#fName').val('');     
                jQuery('#student_id').val('');     
                jQuery('#add_new_head_students').focus();   
                 }
             });
        });
    });      
          
          
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>