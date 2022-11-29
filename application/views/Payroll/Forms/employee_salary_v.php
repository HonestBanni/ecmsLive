<?php // error_reporting(0)?>

<!-- ******CONTENT****** --> 
        <div class="content container">
            <div class="page-wrapper">
                <header class="page-heading clearfix">
                        <h1 class="heading-title pull-left"><?php echo $breadcrumbs?></h1>
                            <div class="breadcrumbs pull-right">
                                <ul class="breadcrumbs-list">
                                    <li class="breadcrumbs-label">You are here:</li>
                                    <li><a href="admin/admin_home">Home</a> 
                                      <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li class="current"><?php echo $breadcrumbs?></li>
                                </ul>
                            </div>
                  <!--//breadcrumbs-->
                </header>
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="course-finder" style="padding-bottom: 2%;">
                                <h1 class="section-heading text-highlight">
                                    <span class="line"><?php echo $page_heading?> Search</span>
                                </h1>
                                <div class="section-content">
                                    <form action="" class="course-finder-form" method="post" accept-charset="utf-8">
                                        <div class="row">
                                            <div class="col-md-3">
                                             <label for="name">Personal No / Payroll Code</label>
                                             <input type="text" name="payroll_code" value="<?php echo $payroll_code ?>"  placeholder="Personal No / Payroll Code" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Employee Name</label>
                                             <input type="text" name="emp_name" value="<?php echo $emp_name ?>"  placeholder="Employee Name" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Father Name</label>
                                                 <input type="text" name="father_name"  value="<?php echo $father_name ?>" placeholder="Father Name" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Gender</label>
                                                 <?php echo form_dropdown('gender_id', $gender, $gender_id,  'class="form-control"');?>
                                            </div>
                                             
                                             <div class="col-md-3">
                                             <label for="name">Status</label>
                                                 <?php echo form_dropdown('status', $status, $status_id,  'class="form-control"');?>
                                            </div>
                                            <div class="col-md-3 col-md-offset-1 pull-right">
                                                <label for="name" style="visibility: hidden">Status dffsf sf ssfsf sdfsfsd sdfsdf</label>
                                                <button type="submit" class="btn btn-theme" name="Search" id="Search" value="Search"><i class="fa fa-search"></i> Search</button>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                     </form>
                                </div><!--//section-content-->
                            </section>
                            <?php  if(!empty($result)):?>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-striped" style="font-size:11px">
                                
                                    <?php 
                                    echo '<thead>
                                                <tr>
                                                    <th colspan="2">Image</th>
                                                    <th>Emp-Name</th>
                                                    <th>Father Name</th>
                                                    <th>Contract Type</th>
                                                    <th>Designation</th>
                                                    <th>BPS</th>
                                                    <th>Category</th>
                                                    <th colspan="3">Department</th>

                                                </tr>
                                            </thead>
                                            <tbody>';
                                    foreach($result as $rec):
                                       $contract_date =    $this->HrModel->get_employee_letter(array('c_renwal_emp_id'=>$rec->emp_id));
//                                        
                                        
                                    echo '<tr>';
                                        
                                        $picture = $rec->picture;
                                            if(!empty($picture)):
                                                if(file_exists('assets/images/employee/'.$rec->picture)):
                                                    echo '<td colspan="2"><img src="assets/images/employee/'.$rec->picture.'" style="border-radius:10px;" width="50" height="50"></td>';
                                                else:
                                                    echo '<td colspan="2"><img src="assets/images/employee/user.png" width="50" height="50"></td>';
                                                endif;
                                                
                                            else:
                                               echo '<td colspan="2"><img src="assets/images/employee/user.png" width="50" height="50"></td>'; 
                                            endif;
                                            echo '<td><a href="EmployeeProfile/'.$rec->emp_id.'" style="text-transform:capitalize;" target="_blank">'.$rec->emp_name.'</a>';
                                             
                                                echo '<td>'.$rec->father_name.'</td>
                                                <td>'.@$contract_date->ctgy_type_name.'</td>
                                                <td>'.@$contract_date->emp_desg_name.'</td>
                                                <td>'.@$contract_date->scale_name.'</td>
                                                <td>'.@$contract_date->category_name.'</td>';
                                                 $department =    $this->HrModel->get_employee_designation(array('emp_staff_emp_id'=>$rec->emp_id));
                                            if($department):
                                                echo '<td colspan="2">'.$department->emp_deprt_name.'</td>';
                                                else:
                                                echo '<td colspan="2"></td>';
                                            endif;
                                              echo '<td><a class="btn btn-theme btn-sm"  href="SalarySetting/'.$rec->emp_id.'"><i class="fa fa-calculator"></i>Salary Setting</a></td>';  
                                        echo '</tr>';
  
                                         
                                        endforeach;
                                      ?>
                                </tbody>
                            </table>
                            
                             <?php    endif;?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            <div class="modal fade" id="ModeDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      
                       <div id="hr_contract_show"> 

                        </div>
                   
                    
                  </div>
                </div>
            </div>
            
          <div class="modal fade" id="EditContract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      
                       <div id="hr_contract_edit">

                        </div>
                   
                    
                  </div>
                </div>
              </div>
        <div class="modal fade" id="EmpBankDetails" tabindex="-1" role="dialog" aria-labelledby="EmpBankDetails">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      
                       <div id="emp_bank_details_show">

                        </div>
                   
                    
                  </div>
                </div>
            </div>
        
        
        <script>
            jQuery(document).ready(function(){
               jQuery('#hr_category').on('change',function(){
                   var hr_category = jQuery(this).val();
                   
                   jQuery.ajax({
                        type   : 'post',
                        url    : 'DropdownController/hr_contract_type',
                        data   : {'hr_category':hr_category},
                        success :function(result){
                            $('#hr_contract').html(result);
                       }
                   });
                   
               });
               jQuery('.contract_id').on('click',function(){
                   var contract_id = jQuery(this).attr('id');
                    jQuery.ajax({
                        type   : 'post',
                        url    : 'HrController/contract_popup_details',
                        data   : {'contract_id':contract_id},
                        success :function(result){
                            $('#hr_contract_show').html(result);
                       }
                   });
                   
               });
               jQuery('.EditContract').on('click',function(){
                   var contract_id = jQuery(this).attr('id');
                    jQuery.ajax({
                        type   : 'post',
                        url    : 'EditContract',
                        data   : {'contract_id':contract_id,'request':'fethRcd'},
                        success :function(result){
                            $('#hr_contract_edit').html(result);
                       }
                   });
                   
               });
               jQuery('.EmpBankDetails').on('click',function(){
                   var emp_id = jQuery(this).attr('id');
                    jQuery.ajax({
                        type   : 'post',
                        url    : 'EmployeeBank',
                        data   : {'emp_id':emp_id,'request':'getRecord'},
                        success :function(result){
                            $('#emp_bank_details_show').html(result);
                       }
                   });
                   
               });
            });
        </script>        
            
       
           
        