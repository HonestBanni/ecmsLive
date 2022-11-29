<?php // error_reporting(0)?>

<!-- ******CONTENT****** --> 
        <div class="content container">
            <div class="page-wrapper">
                <header class="page-heading clearfix">
                        <h1 class="heading-title pull-left"><?php echo $page_heading?></h1>
                            <div class="breadcrumbs pull-right">
                                <ul class="breadcrumbs-list">
                                    <li class="breadcrumbs-label">You are here:</li>
                                    <li><a href="admin/admin_home">Home</a> 
                                      <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li class="current"><?php echo $page_heading?></li>
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
                                             <label for="name">Department</label>
                                                 <?php echo form_dropdown('department_id', $department, $department_id,  'class="form-control"');?>
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Designation</label>
                                                 <?php echo form_dropdown('current_designation', $designation, $designation_id,  'class="form-control"');?>
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Select Scale</label>
                                                 <?php echo form_dropdown('c_emp_scale_id', $scale, $scale_id,  'class="form-control"');?>
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Category</label>
                                                 <?php echo form_dropdown('hr_category', $category, $category_id,  'class="form-control" id="hr_category"');?>
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Contract Type</label>
                                                 <?php echo form_dropdown('hr_contract', $contract_tp, $contract_id,  'class="form-control" id="hr_contract"');?>
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Status</label>
                                                 <?php echo form_dropdown('status', $status, $status_id,  'class="form-control"');?>
                                            </div>
                                            <div class="col-md-3 col-md-offset-1 pull-right">
                                                <label for="name" style="visibility: hidden">Status dffsf sf ssfsf sdfsfsd sdfsdf</label>
                                                <button type="submit" class="btn btn-theme" name="Search" id="Search" value="Search"><i class="fa fa-search"></i> Search</button>
                                                <a href="EmployeeForm"><button type="button" class="btn btn-theme" name="AddEmployee" id="AddEmployee" value="AddEmployee"><i class="fa fa-plus"></i> Add Employee</button></a>
                                                
                                            </div>
                                            
                                        </div>
                                     </form>
                                </div><!--//section-content-->
                            </section>
                            <?php  if(!empty($result)):?>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-striped" style="font-size:11px">
                                
                                    <?php 
                                    foreach($result as $rec):
//                                        echo '<pre>';print_r($rec);
                                        
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
                                        
                                        echo '<tr>';
                                        $picture = $rec->picture;
                                            if(!empty($picture)):
                                                echo '<td colspan="2"><img src="assets/images/employee/'.$rec->picture.'" style="border-radius:10px;" width="80" height="80"></td>';
                                            else:
                                               echo '<td colspan="2"><img src="assets/images/employee/user.png" width="80" height="80"></td>'; 
                                            endif;
                                            echo '<td><a href="EmployeeProfile/'.$rec->emp_id.'" style="text-transform:capitalize;" target="_blank">'.$rec->emp_name.'</a>';
                                             
//                                                                $this->db->order_by('contract_id','desc');
//                                                                $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_contract_reneval.c_renewal_designation_id');
//                                            $contract_date =    $this->db->get_where('hr_contract_reneval',array('c_renwal_emp_id'=>$rec->emp_id))->row();
                                            $contract_date =    $this->HrModel->get_employee_letter(array('c_renwal_emp_id'=>$rec->emp_id));
                                            
//                                              echo '<pre>';print_r($contract_date);
//                                            if($rec->contract_type_id == '2' || $rec->contract_type_id == '5' || $rec->contract_type_id == '12'):
                                                //echo  '<br/> Ret-Date : '.$this->CRUDModel->date_convert($rec->retirement_date).'</td>';
//                                            else:
//                                                if(!empty($contract_date)):
                                                  //  echo  '<br/> Expiry-Date : '.$this->CRUDModel->date_convert($contract_date->c_renwal_from_date).'</td>';
//                                                endif;
                                                
//                                            endif;
                                             
                                            
                                           
                                                
                                                echo '<td>'.$rec->father_name.'</td>
                                                <td>'.@$contract_date->ctgy_type_name.'</td>
                                                <td>'.@$contract_date->emp_desg_name.'</td>
                                                <td>'.@$contract_date->scale_name.'</td>
                                                <td>'.@$contract_date->category_name.'</td>';
                                                 $department =    $this->HrModel->get_employee_designation(array('emp_staff_emp_id'=>$rec->emp_id));
                                            if($department):
                                                echo '<td colspan="3">'.$department->emp_deprt_name.'</td>';
                                                else:
                                                echo '<td colspan="3"></td>';
                                            endif;
                                                
                                        echo '</tr>';
 
                                            $contract_details =                $this->HrModel->get_employee_letters(array('c_renwal_emp_id'=>$rec->emp_id));
//                                         $contract_details = $this->db->get_where('hr_contract_reneval',array('c_renwal_emp_id'=>$rec->emp_id))->result();
//                                         echo '<pre>';print_r($contract_date);
                                        if($contract_details):
                                            $sn = '';
                                            echo '
                                                <thead>
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th>Letter#</th>
                                                        <th>Letter Date</th>
                                                        <th>Date From</th>
                                                        <th>Date To</th>
                                                        <th>Designation</th>
                                                        <th>Scale</th>
                                                        <th>Contract Type</th>
                                                        <th>Details</th>
                                                        <th>Remarks</th>
                                                        <th>View</th>
                                                    </tr>
                                                </thead>';
                                            foreach($contract_details as $row):
                                             $sn++;
                                              echo '<tr>
                                                    <td>'.$sn.'</td>
                                                    <td>'.$row->c_renwal_letter_no.'</td>
                                                    <td>'.$this->CRUDModel->date_convert($row->c_renwal_contract_date).'</td>
                                                    <td>'.$this->CRUDModel->date_convert($row->c_renwal_from_date).'</td>
                                                    <td>'.$this->CRUDModel->date_convert($row->c_renwal_to_date).'</td>
                                                     <td>[ '.$row->emp_desg_code.' ] '.$row->emp_desg_name.'</td>
                                                    <td>'.$row->scale_name.'</td>
                                                    <td>'.$row->contract_status_title.'</td>
                                                    <td>'.$row->c_renwal_details.'</td>
                                                    <td>'.$row->c_renwal_remarks.'</td>
                                                    <td><a href="javascript:void(0)" id="'.$row->contract_id.'" class="contract_id" data-toggle="modal" data-target="#ModeDetails" style="color: blue;text-decoration: underline;">View</a></td>
                                                    
                                                </tr>';
                                            endforeach;
                                        endif;
                                        
                                       echo  '<tr> 
                                                     
                                                    <td colspan="11">
                                                        <div class="pull-right">
                                                            <a class="btn btn-theme btn-sm "  href="UpdateEmployee/'.$rec->emp_id.'"><i class="fa fa-book"></i>Update Record</a> 
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="11"><p></p></td>
                                                </tr>';
                                        
                                         '<tr> 
                                                     
                                                    <td colspan="11">
                                                        <div class="pull-right">
                                                            <a class="btn btn-theme btn-sm EmpBankDetails"  data-toggle="modal" data-target="#EmpBankDetails" id="'.$rec->emp_id.'" ><i class="fa fa-plus"></i>Add Bank</a>
                                                            <a class="btn btn-theme btn-sm" href="EmployeePicture/'.$rec->emp_id.'"><i class="fa fa-plus"></i>Add Pic</a>
                                                            <a class="btn btn-theme btn-sm "  href="UpdateEmployee/'.$rec->emp_id.'"><i class="fa fa-book"></i>Update</a> 
                                                            <a class="btn btn-theme btn-sm" href="ContractDetails/'.$rec->emp_id.'"><i class="fa fa-plus"></i>Add New Record</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="11"><p></p></td>
                                                </tr>';
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
            
       
           
        