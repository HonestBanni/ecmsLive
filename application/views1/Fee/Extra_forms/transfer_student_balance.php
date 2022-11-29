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
          <div class="col-md-12">
              
               <?php echo form_open('',array('class'=>'course-finder-form'));?>
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Student Transfer From</span>
                        </h1>
                        <div class="section-content" >
                            <div class="row">
                                <?php
                                 if($studentInfo):
                                
                                ?>
                               <div class="col-md-3">
                                 <?php 
                                       echo '<label for="name">Challan# </label>';
                                        
                                            echo form_input(array(
                                                 
                                                'value'         => $challandId,
                                                'name'          => 'challan_no_from',
                                                'placeholder'   => 'Enter Challan Number',
                                                'class'         => 'form-control',
                                                'readonly'         => 'readonly',
                                                ));
                                            ?>
                                    </div>
                                     
                                  
                            <?php
                           
                                  echo '<div class="col-md-3"><label for="name">College No</label>';
                                 echo form_input(array(
                                       'readonly'       => 'readonly', 
                                        'value'         => $studentInfo->college_no,
                                        'name'          => 'college_no_from',
                                         'class'        => 'form-control',
                                    ));
                                
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Student Name</label>';
                                 echo form_input(array(
                                        'readonly'  => 'readonly',
                                        'value'         => $studentInfo->student_name,
                                     'name'          => 'student_name_from',
                                        'class'         => 'form-control',
                                    ));
                                 
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Father Name</label>';
                                 echo form_input(array(
                                       'readonly'         => 'readonly',
                                    'value'         => $studentInfo->father_name,
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">This Program Status</label>';
                                 echo form_input(array(
                                       'readonly'         => 'readonly',
                                    'value'         => $studentInfo->studentStatus,
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                          
                              
                           
                                echo '<div class="col-md-3"><label for="name">Program</label>';
                                 echo form_input(array(
                                      'readonly'         => 'readonly',
                                    'value'         => $studentInfo->programe_name,
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Sub Program</label>';
                                 echo form_input(array(
                                    'readonly'         => 'readonly',
                                    'value'         => $studentInfo->sub_proram,
                                     'class'        => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Batch</label>';
                                 echo form_input(array(
                                    'readonly'      => 'readonly',
                                    'value'         => $studentInfo->batch_name,
                                     'class'        => 'form-control',
                                    ));
                                echo '</div>';
                                
                                
                                
                                
                                
                            else:
                            echo '<div class="col-md-12">';
                               echo  '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>FEE TRANSFER STUDENT ! <br/>Record Not Found </strong></div></div>'; 
                            endif;
                            ?>
                               </div> 
                             
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                    <?php
                    
                      if($studentInfo):
                                      
                                 
                    ?>
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Student Transfer To</span>
                        </h1>
                        <div class="section-content" >
                          
                                <div class="row">
                                    
                                    <?php
                                    
                                  $error_message = $this->session->flashdata('fee_transfer_error');  
                                  if($error_message):
                                        echo '<div class="col-md-12">';
                                        echo  '<div class="alert alert-danger alert-dismissable">
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                         <strong>FEE TRANSFER STUDENT ERROR! <br/>Student Name and College No not matched please try again.</strong></div></div>';

                                  endif;
                                 
                                    ?>
                                    
                                    
                               <div class="col-md-3">
                                   <label for="name">Search Transfer to Challan No</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'challan_no_to',
                                                'id'            => 'challan_no_to',
                                                'value'         => '',
                                                'placeholder'   => 'Enter Tranfer to Challan No',
                                                'class'         => 'form-control',
                                                'required'         => 'required',
                                                 
                                                ));
                                            echo form_input(array(
                                                'name'          => 'student_id_to',
                                                'id'            => 'student_id_to',
                                               'class'         => 'form-control',
                                                'type'          =>'hidden'
                                                
                                                 
                                                ));
                                       ?>
                                    </div>
                                     
                                  
                            <?php
                           
                                echo '<div class="col-md-3"><label for="name">College No</label>';
                                 echo form_input(array(
                                       'readonly'       => 'readonly', 
                                        'name'          => 'college_no_to',
                                        'class'         => 'form-control',
                                        'id'            => 'college_no',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Student Name</label>';
                                 echo form_input(array(
                                       'readonly'       => 'readonly',
                                       'id'             => 'student_name',
                                       'name'           => 'student_name_to',
                                       'class'          => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Father Name</label>';
                                 echo form_input(array(
                                    'readonly'         => 'readonly',
                                    'id'             => 'father_name',
                                     'class'         => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Student Status</label>';
                                 echo form_input(array(
                                    'readonly'         => 'readonly',
                                    'id'             => 'studentStatus',
                                    'class'         => 'form-control',
                                    ));
                                echo '</div>';
                          
                              
                           
                                echo '<div class="col-md-3"><label for="name">Program</label>';
                                 echo form_input(array(
                                    'readonly'         => 'readonly',
                                    'id'             => 'program_name',
                                    'class'         => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Sub program</label>';
                                 echo form_input(array(
                                    'readonly'         => 'readonly',
                                    'id'             => 'sub_proram', 
                                    'class'        => 'form-control',
                                    ));
                                echo '</div>';
                                echo '<div class="col-md-3"><label for="name">Batch</label>';
                                 echo form_input(array(
                                    'readonly'      => 'readonly',
                                    'id'             => 'batch_name',
                                    'class'        => 'form-control',
                                    ));
                                echo '</div>';
                                
                            
                            
                            ?>
                               </div> 
                            
                          <div style="padding-top:1%;">
                                <div class="col-md-2 col-md-offset-1 pull-right">
                                   <?php
               
                                    if(!empty($studentInfo)):
                                               
                                        echo '<button type="submit" class="btn btn-theme" name="transfer_challan" id="transfer_challan"  value="transfer_challan" ><i class="fa fa-save"></i> Transfer Balance</button>';


                                    endif;
                                    
                                    ?>
                                   
                                </div>
                            </div>
                            
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                     <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <?php
                                   
                                
                                      if(!empty($result)):
                                         
                                        ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Transfer Challan Details</h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Actual</th>
                                                          <th>Payable</th>
                                                          <th>Balance</th>
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $Actual_amount      = 0;
                                                        $Payable            = 0;
                                                        $Balance            = 0;
                                                         
                                                  
                                                          foreach($result as $row):
                                                           $sn++;
                                                            echo '<tr">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->fh_head.'</th>
                                                                <th>'.$row->actual_amount.'</th>
                                                                <th>'.$row->paid_amount.'</th>
                                                                <th>'.$row->balance.'</th>
                                                                
                                                         
                                                                 </tr>';
                                                            $Actual_amount     += $row->actual_amount;
                                                            $Payable           += $row->paid_amount;
                                                            $Balance           += $row->balance;
                                                            
                                                            
                                                           
                                                          endforeach;      
                                                          
                                                          echo '<tr">
                                                                
                                                                <th> </th>
                                                                <th>Total Amount</th>
                                                                <th>'.$Actual_amount.'</th>
                                                                <th>'.$Payable.'</th>
                                                                
                                                                <th>'.$Balance.'</th>
                                                                
                                                         
                                                                 </tr>'; 
                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
                                      endif;
                                    ?> 
                                    </div>
                                    </div>
                                  
                                </div>           
                                
                      <?php
                    
                       
                                      
                                  endif;
                    ?> 
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
    
 jQuery("#challan_no_to").autocomplete({  
    minLength: 0,
    source: "DropdownController/auto_transfer_to_student/"+$("#challan_no_to").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#challan_no_to").val(ui.item.challan_id);
    jQuery("#college_no").val(ui.item.college_no);
    jQuery("#student_id_to").val(ui.item.code);
    jQuery("#student_name").val(ui.item.student_name);
    jQuery("#father_name").val(ui.item.father_name);
    jQuery("#studentStatus").val(ui.item.studentStatus);
    jQuery("#program_name").val(ui.item.program_name);
    jQuery("#sub_proram").val(ui.item.sub_proram);
    jQuery("#batch_name").val(ui.item.batch_name);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
  
  
 });
  </script>
   
  
 