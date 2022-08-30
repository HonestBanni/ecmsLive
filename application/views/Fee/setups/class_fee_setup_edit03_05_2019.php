 
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
                                              <label for="name">Fee Head</label>
                                            <?php 
                                                echo form_dropdown('fee_head', $fee_head,$fee_headId,  'class="form-control" id="fee_head"');
                                            ?>
                                    </div>
                                <div class="col-md-3 col-sm-5">
                                              <label for="name">Sub Program</label>
                                            <?php 
                                             echo form_dropdown('sub_pro_name', $sub_pro_name, $sub_pro_id,  'class="form-control" id="pc_array"');
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'classSetupId',
                                                           'id'            => 'classSetupId',
                                                           'value'         => $fcs_id,
                                                           'class'         => 'form-control',
                                                           'type'         => 'hidden',
                                                          
                                                            )
                                                        );
 
                                            ?>
                                    </div>
                                <div class="col-md-4 col-sm-5">
                                              <label for="name">Payment Category</label>
                                            <?php 
                                                echo form_dropdown('pc_id', $pc_array, $pc_id,  'class="form-control" id="pc_id"');
                                            ?>
                                    </div>
                                
                            </div>
                                <div class="row">
                                   <div class="col-md-3 col-sm-5">
                                              <label for="name">Batch Name</label>
                                            <?php 
                                                echo form_dropdown('batch_id',$batch_name, $batch_id,  'class="form-control" required="required"');
                                            ?>
                                    </div>  
                                     
                                     <div class="col-md-3 col-sm-5">
                                              <label for="name">Shift</label>
                                            <?php 
                                                echo form_dropdown('shift_id',$shift_name, $shift_id,  'class="form-control" required="required"');
                                            ?>
                                    </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Amount</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                'type'          => 'number',
                                                                'value'         => $fcs_amount,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Account',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                    </div>
                                        
                                    <div class="row">
                                       
                                        <div class="col-md-3 col-sm-5">
                                          <label for="name">From Date</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'fee_from',
                                                                 
                                                                'value'         => $fee_from,
                                                                'class'         => 'form-control datepicker',
                                                                'placeholder'   => 'Account',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                        <div class="col-md-3 col-sm-5">
                                              <label for="name">To Date</label>

                                               <div class="input-group" id="adv-search">
                                                    <?php
                                                        echo  form_input(
                                                                 array(
                                                                    'name'          => 'fee_to',

                                                                    'value'         => $fee_to,
                                                                    'class'         => 'form-control datepicker',
                                                                    'placeholder'   => 'Account',
                                                                     )
                                                                 );
                                                          ?>
                                                  </div>

                                         </div>
                                        <div class="col-md-3 col-sm-5">
                                                  <label for="name">Valid Till</label>


                                                <?php 

                                                   echo  form_input(
                                                            array(
                                                                'name'          => 'valid_till',

                                                               'class'         => 'form-control datepicker',
                                                               'placeholder'   => 'Paymetn Valid',
                                                               'required'       => 'required',
                                                                'value'         => $valid_till,
                                                                ));
                                               ?>
                                    </div>
                                    </div>
                            <div class="row">

                                
                                     <div class="col-md-6 col-sm-5">
                                          <label for="name">Comment</label>
                                        <?php
                                            
                                            echo form_textarea(array(
                                                'name'          => 'comment',
                                                'value'         => $fcs_comments,
                                                'rows'          => '2',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Comment',    
                                                ));
                                         
                                        ?>
                                       
                                        
                                     </div>
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="add" id="add"  value="add" ><i class="fa fa-plus"></i> Save</button>
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
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
      #fee_head_amount{
          
            z-index: 1;

      }
  </style> 