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
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Employee Name</label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'employee_name',
                                                            'type'          => 'text',
                                                            'value'         => $employee_name,
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'employee_name',
                                                             )
                                                         );
                                                  ?>
                                          </div>

                                 </div>
                                  
                                <input type="hidden" name="smsPassword" id="smsPassword" value="<?php echo $smsPassword;?>">
                                 
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Father Name</label>
                                        
                                           <div class="input-group" id="adv-search">
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
                                            
                                     </div>
                                    <div class="col-md-2">
                                    <label for="name">Gender</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('gender', $gender,$gender_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div>
                                    <div class="col-md-2">
                                    <label for="name">Designation</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('designation', $designation,$designation_id,  'class="form-control"');
                                        ?>
                                    </div>
                                    </div>
                                    <div class="col-md-2">
                                    <label for="name">Department</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('department', $department,$department_id,  'class="form-control"');
                                        ?>
                                    </div>
                                    </div>
                                    <div class="col-md-2">
                                    <label for="name">Scale</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('emp_scale', $emp_scale,$emp_scale_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div>
                                    </div>
                            <div class="row"> 
                                    <div class="col-md-2">
                                    <label for="name">Category</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('category', $category,$category_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Subject</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('subject', $subject,$subject_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Status</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('status', $status,$status_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div>
                                          
                                
                                
                         
                                 
                                  
                                 
                                
                                     </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                          <label for="name">Message</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                     echo form_textarea(
                                                             array(
                                                                'name'          => 'message',
                                                                'value'         => $message,
                                                                'type'          => 'text',
                                                                'cols'          => '150',
                                                                'rows'          => '3',
                                                                'id'            => 'message',
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Type Message',
                                                                
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                          <p><span id="remaining">148 characters remaining</span> <span id="messages">1 message(s)</span></p>
                                            
                                     </div>
                                 
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-5 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="submit" class="btn btn-theme" name="sendSMS" id="sendSMS"  value="sendSMS" ><i class="fa fa-search"></i> Send SMS</button>
                                     
     
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
                                                            <th>Picture</th>
                                                            <th>Name</th>
                                                            <th>Designation</th>
                                                            <th>Department</th>
                                                            <th>Contact No</th>
                                                           
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';
  
                                                        $sn = "";
                                                          foreach($result as $row):
                                                            $sn++;  
                                                              echo ' <tr>
                                                                  <td>'.$sn.'</td>
                                                                <td><input type="checkbox" name="checked[]" value="'.$row->emp_id.'"   id="checkItem" checked="checked">
                                                                    <input type="hidden"      id="student_id" >
                                                                 </td>';
                                                              
                                                              
//                                                          
                                                            echo '<td><img src="assets/images/employee/'.$row->picture.'" width="80" height="80" style="border-radius:10%"></td>';
                                                            echo '<td>'.$row->emp_name.'</td>';
                                                            echo '<td>'.$row->designation.'</td>';
                                                            
                                                              echo '<td>'.$row->department.'</td>';     
                                                              echo '<td>'.$row->contact1.'</td>';     
                                                             
                                                                 
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
    jQuery(document).ready(function(){

//   var fieldPassword =jQuery('#smsPassword').val();
//   if(fieldPassword == ''){
//       var password =  window.prompt("Please Enter SMS Password..", "");
//       if(password == ''){
//           window.location.reload();
//       }
//       if(password ==  null){
//           window.location.reload();
//       }
//       if(password !=  ''){
//           
//          jQuery.ajax({
//              type      : 'post',
//              url       : 'checkSMSPassword',
//              data      : {'password':password},
//              dataType  : 'json',
//              success   : function(result){
//                 if(result ==  1){
//                     alert('Please enter vallid password...');
//                     window.location.href="admin/admin_home";
//                 }
//                 if(result ==  2){
////                     alert(password);
//                     jQuery('#smsPassword').val(password);
//                 } 
//              }
//              
//              
//          });
//       }
//   }
   
    jQuery('#sendSMS').on('click',function(){
        jQuery('#sendSMS').hide();
    });
   
   
   });
    </script>   

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
        messages = Math.ceil(chars / 148),
        remaining = messages * 148 - (chars % (messages * 148) || messages * 148);

    $remaining.text(remaining + ' characters remaining');
    $messages.text(messages + ' message(s)');
});
    </script>


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
  </style>     
  
 
  
  
   