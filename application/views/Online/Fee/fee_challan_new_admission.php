 
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
// 
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
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control required="required" feeProgrameId" id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
                                                 echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" required="required"  id="showFeeSubPro"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Batch</label>
                                        <?php
                                             
                                            echo form_dropdown('batch_id', $batch,$batch_id,'class="form-control"  required="required" id="batch_id"');
                                        ?>
                                </div>    
                                <div class="col-md-2">
                                    <label for="name">Payment Category</label>
                                        <?php
                                            
                                            echo form_dropdown('pc_id',$pay_categ ,$pc_id,'class="form-control payment_cat" required="required" id="pc_id"');
                                        ?>
                                </div>
                                
                                    <div class="col-md-2">
                                              <label for="name">Bank</label>
                                            <?php 
                                              echo form_dropdown('bank_id',$bank,$default_bank,  'class="form-control" id="bank_id"');
                                         ?>
                                    </div>
                                    <div class="col-md-2">
                                              <label for="name">Gender</label>
                                            <?php 
                                              echo form_dropdown('gender',$gender,$gender_id,  'class="form-control"');
                                         ?>
                                    </div>
                                
                                    
                           
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                              <label for="name">Financial Year</label>
                                            <?php 
                                              echo form_dropdown('year_id', $year,$default_year_fy,  'class="form-control" id="year"');
                                         ?>
                                    </div>
                                    <div class="col-md-2">
                                    <label for="name">From Date</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'fromDate',
                                                'id'            => 'fromDate',
                                                'value'         => $fromDate,
                                                'rows'          => '2',
                                                'class'         => 'form-control datepicker',
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name">Up To Date</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'uptoDate',
                                                'id'            => 'uptoDate',
                                                'value'         => $uptoDate,
                                                 'rows'          => '2',
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                     
                                    <div class="col-md-2">
                                        <label for="name">Valid till</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'dueDate',
                                                'id'            => 'dueDate',
                                                'value'         => $dueDate,
                                                 'rows'          => '2',
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name">Issue Date</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'issuDate',
                                                'id'            => 'issuDate',
                                                'value'         => $issuDate,
                                                 'rows'          => '2',
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Student Number From</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'std_no_from',
                                                                'type'          => 'text',
                                                                'value'         => $std_no_from,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Numbers From',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                 <div class="col-md-2 col-sm-5">
                                          <label for="name">Student Number to</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'std_no_to',
                                                                'type'          => 'text',
                                                                'value'         => $std_no_to,
                                                                'class'         => 'form-control',
                                                                'require'       => 'require',
                                                                'placeholder'   => 'Student Numbers To',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
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
                                         
                                         
                                        ?>
                                       
                                        
                                     </div>
                                     
                                      
                                </div>
                           
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="GenerateChallanNewAdmission" id="GenerateChallanNewAdmission"  value="GenerateChallanNewAdmission" ><i class="fa fa-search"></i> Search</button>
                                   
                                    
                                    <button type="submit" class="btn btn-theme" name="fee_save_challan"  value="fee_save_challan" ><i class="fa fa-save"></i> Generate</button>
                                    
     
                                </div>
                            </div>
                                    
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                    <?php
                    
                     echo '<div class="row">
              <div class="col-md-12">';
                                        
                      
                                      if(!empty($result)):
                                        echo '  <div id="div_print">
                                                <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                                    <div class="table-responsive">
                                                    <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th><input type="checkbox" id="checkAll" checked="checked"></th>
                                                          <th>#</th>
                                                          <th>Form#</th>
                                                          <th>College#</th>
                                                          <th>Student Name</th>
                                                          <th>Father Name</th>
                                                          <th>Batch Name</th>
                                                          <th>Section</th>
                                                          <th>Marks Details</th>
                                                          <th>Status</th>
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';
                                                            $sn = "";
                                                            foreach($result as $row):
                                                            $sn++;
                                                                echo '<tr">
                                                                <th><input type="checkbox" name="studentIds[]" value="'.$row->student_id.'"   id="checkItem" checked="checked"></th>
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->form_no.'</th>
                                                                <th>'.$row->college_no.'</th>
                                                                <th>'.$row->student_name.'</th>
                                                                <th>'.$row->father_name.'</th>
                                                                <th>'.$row->batch_name.'</th>
                                                                <th>'.$row->sectionsName.'</th>
                                                                <th>'.$row->obtained_marks.' / '.$row->total_marks.'</th>
                                                                <th>'.$row->current_status.'</th>
                                                                </tr>';
                                                            endforeach;      
                                                            echo'</tbody>
                                            </table>
                                        </div>';
                                          
                                      endif;
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
                    
                     
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
  
 