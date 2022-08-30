 
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
                                                                'value'         => $studentInfo->sub_proram.'('.$studentInfo->sectionsName.')',
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
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'challan_id_lock',
                                                                'type'          => 'text',
                                                                'value'         => $feeComments->challan_id_lock,
                                                                'class'         => 'form-control',
                                                                'type'          => 'hidden',
                                                                 
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
                                                           
                                                           'required'       => 'required',
                                                           'class'         => 'form-control',
                                                           'placeholder'   => 'Payment Category',
                                                           'value'          => $challan_info->fh_head,
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_id',
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            'value'          => $challan_info->challan_detail_id,
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'           => 'challan_id',
                                                           'value'          => $this->uri->segment(2),
                                                           'id'             => 'challan_id',
                                                           'class'          => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'student_id',
                                                            'value'          => $this->uri->segment(3),
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
//                                             
                                            ?>
                                              
                                          
                                    </div>
                                     
                                      
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Amount</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                
                                                                'type'          => 'number',
                                                                'value'       => $challan_info->actual_amount,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Amount',
                                                                 )
                                                             );
                                                    
                                                    
                                               
                                                      ?>
                                            
                                            
                                     </div>
                               <div class="col-md-3 col-sm-5">
                                          <label for="name">Balance Type</label>
                                        
                                           
                                                <?php
                                                    echo form_dropdown('balance_type', $balance_type, $challan_info->old_balance_pc_id,  'class="form-control"');
                                                      ?>
                                            
                                            
                                     </div>
                                    <div class="col-md-6 col-sm-5">
                                          <label for="name">Comment</label>
                                        <?php
                                            
                                            echo form_textarea(array(
                                                'name'          => 'comment',
                                                'rows'          => '2',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Comment', 
                                                'required'      => 'required',
                                                'value'         => $challan_info->comment,
                                                ));
                                         
                                        ?>
                                       
                                        
                                     </div>
                                     
                                    
                                     
                                
                                     
                                     
                                      
                                </div> 
                           
                           
                           <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                     <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-book"></i> Update</button>
                                     
     
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
    jQuery(document).ready(function(){
        
        jQuery('#update_comment').on('click',function(){
            
            var update_comment = jQuery('#challan_comnt').val();
            var challan_id      = jQuery('#challan_id').val();
            jQuery.ajax({
                    type    :'post',
                    url     :'ChallanCommentUpdate',
                    data    :{'comment':update_comment,'challan_id':challan_id},
                    success : function(result){
                        location.reload();
                    }
                    
            });
        });
    });
    </script>    
  
 