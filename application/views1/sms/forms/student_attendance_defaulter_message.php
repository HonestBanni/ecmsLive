<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style> 
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
                   <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));   ?>
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                      
                                <div class="row">
                                <div class="col-md-3 col-sm-5">
                                      <label for="name">Form #</label>

                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'form_no',
                                                            'type'          => 'text',
                                                            'value'         => $form_no,
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Form No #',
                                                             )
                                                         );
                                                  ?>
                                        

                                 </div>
                                 
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">College #</label>
                                        <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'value'         => $college_no,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'College #',
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
                                                                'type'          => 'text',
                                                                'value'         => $stdName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                      ?>
                                     </div>
                                     <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                     
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Father Name</label>
                                        <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $fatherName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                            
                                            
                                     </div>
                                    <div class="col-md-3">
                                    <label for="name">Gender</label>
                                    <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('gender', $gender,$gender_id,  'class="form-control" ');
                                        ?>
                                    
                                </div> 
                                 
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                    
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                        ?>
                                   
                                </div>
                                
                         
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                                        ?>
                                   
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Batch</label>
                                    
                                        <?php 
                                            echo form_dropdown('batch', $batch,$batch_id,  'class="form-control" id="batch_id"');
                                        ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Section</label>
                                    
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
                                        ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Student Status</label>
                                
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('student_status', $student_status,$status_id,  'class="form-control" ');
                                        ?>
                                </div>
                                 
                                
                                 
                                <div class="col-md-3">
                                    <label for="name">Date From</label>
                                    <?php
                                      echo  form_input(
                                        array(
                                           'name'          => 'dateFrom',
                                           'type'          => 'text',
                                           'value'         => $dateFrom,
                                           'class'         => 'form-control datepicker',
                                           'placeholder'   => 'Date From',
                                            )
                                        );
                                        ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Date To</label>
                                    <?php
                                      echo  form_input(
                                               array(
                                                  'name'          => 'dateTo',
                                                  'type'          => 'text',
                                                  'value'         => $dateTo,
                                                  'class'         => 'form-control datepicker',
                                                  'placeholder'   => 'Date To',
                                                   )
                                               );
                                        ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Percentage Less Then</label>
                                    <?php
                                      echo  form_input(
                                               array(
                                                  'name'          => 'Percentage',
                                                  'type'          => 'text',
                                                  'value'         => $Percentage,
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Enter Percentage',
                                                   )
                                               );
                                        ?>
                                </div>
                                 
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                          <label for="name">Message</label>
                                         <?php
                                                     echo form_textarea(
                                                             array(
                                                                'name'          => 'message',
                                                                'id'            => 'message',
                                                                'value'         => $message,
                                                                'type'          => 'text',
                                                                'cols'          => '150',
                                                                'rows'          => '3',
                                                                 
                                                             
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Type Message',
                                                                
                                                                 )
                                                             );
                                                      ?>
                                             
                                          <p><span id="remaining">160 characters remaining</span> <span id="messages">1 message(s)</span></p>                                           
                                     </div>
                                 
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-5 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="submit" class="btn btn-theme" name="sendSMS" id="sendSMS"   value="sendSMS" ><i class="fa fa-search"></i> Send SMS</button>
                                     
     
                                </div>
                            </div>
                                 
                                
                             
                            
                        
                        
                        
                    </section>
           
                             <?php
                           
                          
                   if(!empty($result)):                      
        
        echo '<div class="row">
              <div class="col-md-12 ">';
                                        
                        
                                echo '<div id="div_print">
                                        <h3 class="has-divider text-highlight">Result :'; echo count($result); 
                                        echo '</h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:11px;">
                                                    <thead>
                                                      <tr>

                                                            <th>#</th>
                                                            <th><input type="checkbox" id="checkAll" checked="checked"></th> 
                                                            
                                                            <th>College#</th>
                                                            <th>Student Name</th>
                                                            <th>Father Name</th>
                                                            <th>Section</th>
                                                            <th>Guardian Phone no </th>
                                                            <th>Absent</th>
                                                            <th>Present</th>
                                                            <th>Total</th>
                                                            <th>Percentage</th>
                                                             
                                                           
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';
  
                                                        $sn = "";
                                                          foreach($result as $row):
                                                               $message = '';
//                                                              echo '<pre>';print_r($row);die;
                                                            $sn++;  
                                                              echo ' <tr>
                                                                  <td>'.$sn.'</td>
                                                                <td><input type="checkbox" name="checked[]" value="'.$row->student_id.'"   id="checkItem" checked="checked">
                                                                    
                                                                 </td>';
                                                                
//                                                          
                                                            echo '<td>'.$row->college_no.'</td>';
                                                           
                                                            echo '<td>'.substr($row->student_name, 0, 30).' </td>';
                                                            echo '<td>'.substr($row->father_name, 0, 30).' </td>';
                                                              echo '<td>'.$row->sessionName.'</td>';     
                                                              echo '<td>'.$row->mobile_no.'</td>';     
                                                              echo '<td>'.$row->Absent.'</td>';     
                                                              echo '<td>'.$row->Present.'</td>';
                                                              echo '<td>'.$row->Total.'</td>';     
                                                              echo '<td>'.$row->Persantage.' %</td>';     
                                                                  
                                                             
                                                               
                                                              echo '  </tr>';
                                                         
                                                          endforeach;      
                                               

                                                    echo'</tbody>
                                            </table>
                                        </div>';
                                          
                                 
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
                                    else:
                                        
                                    echo '<div class="row">
                                            <div class="col-md-12 ">
                                            <h2>Result not found</h2>
                                            </div>
                                  </div>';  
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
 $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
      .form-group_inputs{
          z-index: 0;
      }
  </style>    
    <script>
    var $remaining = $('#remaining'),
    $messages = $remaining.next();

$('#message').keyup(function(){
    
     var chk_msg = jQuery(this).val();
    var msg = chk_msg.includes("'");
    if(msg){
       alert('Please remove special character....');
        jQuery('#sendSMS').hide();
    }else{
        jQuery('#sendSMS').show();
    }
    
    var chars = this.value.length,
        messages = Math.ceil(chars / 160),
        remaining = messages * 160 - (chars % (messages * 160) || messages * 160);

    $remaining.text(remaining + ' characters remaining');
    $messages.text(messages + ' message(s)');
});
    </script>
 
  
  
   