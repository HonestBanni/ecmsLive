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
                                             <label for="name">Employee Name</label>
                                                 <input type="text" name="emp_name"  placeholder="Employee Name" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Father Name</label>
                                                 <input type="text" name="father_name" placeholder="Father Name" class="form-control">
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
                                                 <?php echo form_dropdown('cat_id', $category, $category_id,  'class="form-control" id="hr_category"');?>
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Contract Type</label>
                                                 <?php echo form_dropdown('contract_type_id', $contract_tp, $contract_tp_id,  'class="form-control" id="hr_contract"');?>
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Status</label>
                                                 <?php echo form_dropdown('status_id', $status, $status_id,  'class="form-control"');?>
                                            </div>
                                            <div class="col-md-3 col-md-offset-1 pull-right">
                                                <label for="name" style="visibility: hidden">Status dffsf sf ssfsf sdfsfsd sdfsdf</label>
                                                <button type="submit" class="btn btn-theme" name="Search" id="Search" value="Search"><i class="fa fa-search"></i> Search</button>
                                                <a href="HrController/add_employee_record"><button type="button" class="btn btn-theme" name="AddEmployee" id="AddEmployee" value="AddEmployee"><i class="fa fa-plus"></i> Add Employee</button></a>
                                                
                                            </div>
                                            
                                        </div>
                                     </form>
                                </div><!--//section-content-->
                            </section>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Picture</th>
                                        <th>Emp-Name</th>
                                        <th>F-Name</th>
                                        <th>Designation</th>
                                        <th>Contract Type</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($result):
                                        foreach($result as $rec):
                                        echo '<tr>';
                                        $picture = $rec->picture;
                                            if(!empty($picture)):
                                                echo '<td><img src="assets/images/employee/'.$rec->picture.'" style="border-radius:10px;" width="80" height="80"></td>';
                                            else:
                                               echo '<td><img src="assets/images/employee/user.png" width="80" height="80"></td>'; 
                                            endif;
                                        
                                        echo '  <td><a href="HrController/employee_profile/'.$rec->emp_id.'" style="text-transform:capitalize;" target="_blank">'.$rec->emp_name.'</a></td>
                                                <td>'.$rec->father_name.'</td>
                                                <td>'.$rec->cdesignation.'</td>
                                                <td>'.$rec->contracttitle.'</td>
                                                <td>'.$rec->categorytitle.'</td>
                                                <td>'.$rec->title.'</td>
                                                <td><a class="btn btn-success btn-sm form-control" style="margin:1px;" href="HrController/update_employee/>'.$rec->emp_id.'">Update</a><br/>
                                                <a class="btn btn-primary btn-sm form-control" href="HrController/upload_employee_pic/>'.$rec->emp_id.'">Add Pic</a></td>';
                                        
                                        
                                        echo '</tr>';
                                        endforeach;
                                    endif;
                                        ?>
                                </tbody>
                            </table>
                            <h4> <span style="margin-right:30px;color:#208e4c"><?php echo $pagination_links;?></span> </h4>
                            
                        </div>
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
            });
        </script>        
            
       
           
        