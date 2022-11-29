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
                    <div id="Employee_Wedget"></div>
                  
                    <div class="row">
                       <div class="courses-wrapper col-lg-12 col-md-7 col-12">           
                            <div class="featured-courses tabbed-info page-row">             
                                <ul class="nav nav-tabs">
                                    <li class="nav-item active"><a class="nav-link " href="#PersonalInfoTab" data-toggle="tab"><h4>Personal Info</h4></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#AcademicTab" data-toggle="tab"><h4 id="Academic-tab">Academic</h4></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#ExperienceTab" data-toggle="tab"><h4 id="Experience-tab">Experience</h4></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#DepartmentTab" data-toggle="tab"><h4 id="Department-tab">Department</h4></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#FundTaB" data-toggle="tab"><h4 id="Fund-tab">Fund</h4></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#ShiftTaB" data-toggle="tab"><h4 id="Shift-tab">Shift</h4></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#BankTaB" data-toggle="tab"><h4 id="Bank-tab">Bank</h4></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#AllowanceTaB" data-toggle="tab"><h4 id="Allowance-tab">Allowance</h4></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#ResponsibilityTaB" data-toggle="tab"><h4 id="Responsibility-tab">Responsibility</h4></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#LetterTaB "data-toggle="tab"><h4 id="Letter-tab">Add Record</h4></a></li>
                                </ul>
                                <div class="tab-content">
                                    <input type="hidden" id="employee_id"  value="<?php echo $employee_id?>">
                                  <div class="tab-pane active" id="PersonalInfoTab">
                                       <div class="row">
                                           <h1 class="section-heading text-highlight"><span class="line">Employee Personal Infomation </span></h1>
                                            <form name="student" method="post" id="RegEmployee"  name="RegEmployee" enctype="multipart/form-data" >
                                                <div class="form-group col-md-3">
                                                   <label for="usr">Employee Name: <span style="color:red">*</span></label>
                                                   <input type="text" name="emp_name" class="form-control">        
                                                   <input type="hidden" name="old_picture"  class="form-control old_picture">        
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="usr">Father Name:</label>
                                                    <input type="text" name="father_name" class="form-control" required="required">        
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="usr">Husband Name:</label>
                                                    <input type="text" name="emp_husband_name" class="form-control">        
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="usr">NIC :</label>
                                                    <input type="text" name="emp_cnic"  class="form-control nic" required="required">        
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="usr">Gender: <span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('gender_id',$gender,'',array('class'=>'form-control','id'=>'gender_id'))?>
                                                </div>

                                                <div class="col-md-3">
                                                            <label style="text-indent: 3px">Date of Birth <span style="color:red">*</span></label>
                                                            <div>
                                                                <div style="width: 33%; float: left" class=" form-group">
                                                                    <select class="form-control" name="dob_day" id="dob_day" autocomplete="off" >
                                                                        <option value="">Day</option>
                                                                        <?php
                                                                        for($d=1; $d<32; $d++):
                                                                            if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                            echo '<option value="'.$v.'">'.$d.'</option>';
                                                                        endfor;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                                       <?php
                                                                            $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                                        echo form_dropdown('dob_month',$month,'',array('class'=>'form-control','id'=>"dob_month"));
                                                                    ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group">
                                                                    <select class="form-control" name="dob_year" id="dob_year" autocomplete="off" >
                                                                        <option value="">Year</option>
                                                                        <?php
                                                                        for($y=1950; $y<=date('Y')-15; $y++):
                                                                            echo '<option value="'.$y.'">'.$y.'</option>';
                                                                        endfor;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div> 


                                                <div class="form-group col-md-3">
                                                    <label for="usr">Postal Address:</label>
                                                    <input type="text" name="postal_address" class="form-control">        
                                                </div>     
                                                <div class="form-group col-md-3">
                                                    <label for="usr">Permanent Address:</label>
                                                    <input type="text" name="permanent_address" class="form-control">        
                                                </div>     
                                                <div class="form-group col-md-3">
                                                    <label for="usr">District:</label>
                                                    <input type="text" name="district" class="form-control" id="district" required="required">
                                                    <input type="hidden" name="district_id" id="district_id">
                                                </div>  
                                                <div class="form-group col-md-3">
                                                    <label for="usr">Post Office:</label>
                                                    <input type="text" name="post_office" class="form-control">        
                                                </div>
                                                    <div class="form-group col-md-3">
                                                            <label for="usr">Country:</label>
                                                           <input type="text" name="country" class="form-control" id="country" required="required">
                                                            <input type="hidden" name="country_id" id="country_id">
                                                        </div>

                                                    <div class="form-group col-md-3">
                                                        <label for="usr">PTCL No.:</label>
                                                        <input type="text" name="ptcl_number" class="form-control">        
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="usr">Mobile No 1:</label>
                                                        <input type="text" name="contact1" class="form-control phone">        
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="usr">Network:</label>
                                                         <?php echo form_dropdown('net_id',$network,'',array('class'=>'form-control','id'=>'net_id'))?>
                                                    </div>            
                                                    <div class="form-group col-md-3">
                                                        <label for="usr">Religion:</label>
                                                            <?php echo form_dropdown('religion_id',$religion,'',array('class'=>'form-control','id'=>'religion_id'))?>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="usr">Marital Status:</label>
                                                         <?php echo form_dropdown('marital_status_id',$m_status,'',array('class'=>'form-control','id'=>'marital_status_id'))?>
                                                    </div> 
                                                    <div class="form-group col-md-3">
                                                        <label for="usr">Email:</label>
                                                        <input type="text" name="email" class="form-control email">        
                                                    </div>

                                                   <div class="form-group col-md-3">
                                                        <label for="usr">Employee Status:</label>
                                                         <?php echo form_dropdown('emp_status_id',$status,'',array('class'=>'form-control','id'=>'emp_status_id'))?>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="usr">Picture</label>
                                                        <input type="file" name="file" class="form-control">        
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="usr">Remarks.:</label>
                                                        <textarea name="emp_remarks" id="emp_remarks" cols="40" rows="2" class="form-control" placeholder="Remarks" ></textarea>

                                                    </div>

                                                    <div class="form-group col-md-2 pull-right">
                                                        <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                            <button type="button" class="btn btn-theme form-control" id="UpdateRecord" ><i class="fa fa-book"></i>Update Record </button>
                                                    </div>

                                                </form> 
                                            <input type="hidden" id="new_emp_id" name="new_emp_id">
                                        </div>
                                  </div>
                                    
                                    <!--Academic Record-->
                                    
                                    
                                  <div class="tab-pane " id="AcademicTab">
                                      <div class="row">
                                           <h1 class="section-heading text-highlight"><span class="line">Employee Academic Qualification </span></h1>
                                           <form name="student" method="post" id="AcademicForm"  name="AcademicForm">
                                                <div class="form-group col-md-4">
                                                   <label for="usr">Degree / Certificate: <span style="color:red">*</span></label>
                                                    <input type="text" name="degree" class="form-control" placeholder="Type Degree" id="degree" required>
                                                    <input type="hidden" name="degree_id" class="degree_id" id="degree_id">       
                                                    <input type="hidden" name="emp_academic_id" class="emp_academic_id" id="emp_academic_id">       
                                                </div>
                                               <div class="form-group col-md-4">
                                                    <label for="usr">Board / University:</label>
                                                    <input type="text" name="board_university" class="form-control" placeholder="Type University" id="bord_univty">
                                                          <input type="hidden" name="board_university_id" id="bord_univty_id">

                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="usr">Year of Passing:</label>
                                                    <input type="text" name="passing_year" class="form-control" id="year"> 
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                    <label for="usr">CGPA:</label>
                                                    <input type="text" name="cgpa" class="form-control"> 
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                    <label for="usr">Division</label>
                                                    <?php 
                                                      echo form_dropdown('div_id', $division, '',  'class="form-control" id="div_id"');
                                                  ?> 
                                                </div>
                                              <div class="form-group col-md-4">
                                                    <label for="usr">HEC Verified:</label>
                                                    <select name="hec_verified" class="form-control" id="hec_verified">
                                                        <option value="No">No</option>  
                                                        <option value="Yes">Yes</option>
                                                    </select>    
                                                </div>
                                               <div class="form-group col-md-12">
                                                    <label for="usr">Remarks.:</label>
                                                    <textarea name="edu_remarks" id="edu_remarks" cols="40" rows="2" class="form-control" placeholder="Remarks" ></textarea>

                                                </div>
                                                  <div class="form-group col-md-2 pull-right">
                                                        <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                        <button type="button" class="btn btn-theme form-control" id="saveAcademic" value="saveAcademic"><i class="fa fa-save"></i>Save Academic</button>
                                                        <button type="button" class="btn btn-theme form-control" id="updateAcademic" value="updateAcademic"><i class="fa fa-book"></i>Update Academic</button>
                                                    </div> 
                                            </form>
                                      </div><!--//row-->
                                      <div id="AcademicGrid">
                                          
                                      </div>
                                      
                                  </div>
                                  <div class="tab-pane " id="ExperienceTab">
                                      <div class="row">
                                          <h1 class="section-heading text-highlight"><span class="line">Employee Experience</span></h1>
                                            <form name="student" method="post" id="ExperienceForm"  name="ExperienceForm" >
                                                <div class="form-group col-md-3">
                                                   <label for="usr">Compay Name  <span style="color:red">*</span></label>
                                                    <input type="text" name="Department" class="form-control" placeholder="Department" id="Department">
                                                    <input type="hidden" name="experience_id" class="experience_id">
                                                </div>
                                                <div class="form-group col-md-3">
                                                   <label for="usr">Job Title<span style="color:red">*</span></label>
                                                    <input type="text" name="jb_title" class="form-control" placeholder="Job Title" id="jb_title">
                                                    
                                                </div>
                                                 
                                                <div class="col-md-3">
                                                            <label style="text-indent: 3px">From Date<span style="color:red">*</span></label>
                                                            <div>
                                                                <div style="width: 33%; float: left" class=" form-group">
                                                                    <select class="form-control" name="from_exp_day" id="from_exp_day" autocomplete="off" >
                                                                        <option value="">Day</option>
                                                                        <?php
                                                                        for($d=1; $d<32; $d++):
                                                                            if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                            echo '<option value="'.$v.'">'.$d.'</option>';
                                                                        endfor;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                                       <?php
                                                                            $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                                        echo form_dropdown('from_exp_month',$month,'',array('class'=>'form-control','id'=>"from_exp_month"));
                                                                    ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group">
                                                                    <select class="form-control" name="from_exp_year" id="from_exp_year" autocomplete="off" >
                                                                        <option value="">Year</option>
                                                                        <?php
                                                                        for($y=1980; $y<=date('Y'); $y++):
                                                                            echo '<option value="'.$y.'">'.$y.'</option>';
                                                                        endfor;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div> 
                                                    <div class="col-md-3">
                                                            <label style="text-indent: 3px">To Date <span style="color:red">*</span></label>
                                                            <div>
                                                                <div style="width: 33%; float: left" class=" form-group">
                                                                    <select class="form-control" name="to_exp_day" id="to_exp_day" autocomplete="off" >
                                                                        <option value="">Day</option>
                                                                        <?php
                                                                        for($d=1; $d<32; $d++):
                                                                            if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                            echo '<option value="'.$v.'">'.$d.'</option>';
                                                                        endfor;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                                       <?php
                                                                            $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                                        echo form_dropdown('to_exp_month',$month,'',array('class'=>'form-control','id'=>"to_exp_month"));
                                                                    ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group">
                                                                    <select class="form-control" name="to_exp_year" id="to_exp_year" autocomplete="off" >
                                                                        <option value="">Year</option>
                                                                        <?php
                                                                        for($y=1980; $y<=date('Y'); $y++):
                                                                            echo '<option value="'.$y.'">'.$y.'</option>';
                                                                        endfor;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div> 

                                                    <div class="form-group col-md-12">
                                                        <label for="usr">Remarks.:</label>
                                                        <textarea name="exp_remarks" cols="40" rows="2" class="form-control exp_remarks" placeholder="Remarks" ></textarea>

                                                    </div>
                                                
                                                  <div class="form-group col-md-2 pull-right">
                                                        <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                        <button type="button" class="btn btn-theme form-control" id="saveExperience" value="saveExperience"><i class="fa fa-plus"></i>Save Experience</button>
                                                        <button type="button" class="btn btn-theme form-control" id="updateExperience" value="updateExperience"><i class="fa fa-book"></i>Update Experience</button>
                                                    </div> 
                                            </form>
                                      </div><!--//row-->
                                      <div id="ExperienceGrid">
                                          
                                      </div>
                                  </div>
                                  
                                  <div class="tab-pane" id="DepartmentTab">
                                      <div class="row">
                                          <h1 class="section-heading text-highlight"><span class="line">Employee Department Status</span></h1>
                                           <form name="student" method="post" id="EmpDepartmentForm"  name="EmpDepartmentForm">
                                                 
                                                <div class="form-group col-md-3">
                                                    <label for="usr">Category:  <span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('category_id',$Category,'',array('class'=>'form-control','id'=>'category_id'))?>
                                                     <input type="hidden" name="emp_staff_design_id" class="emp_staff_design_id">
                                                </div>
<!--                                                <div class="form-group col-md-3">
                                                    <label for="usr">Category Type:</label>
                                                    <?php echo form_dropdown('category_type_id',$CategoryType,'',array('class'=>'form-control','id'=>'category_type_id'))?>
                                                </div>-->
<!--                                                <div class="form-group col-md-3">
                                                    <label for="usr">Designation:</label>
                                                    <?php echo form_dropdown('designation_id',$Designation,'',array('class'=>'form-control','id'=>'designation_id'))?>
                                                </div>-->
                                                <div class="form-group col-md-3">
                                                    <label for="usr">Department:  <span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('department_id',$department,'',array('class'=>'form-control','id'=>'department_id'))?>
                                                </div>
                                               <div class="form-group col-md-12">
                                                        <label for="usr">Remarks.:</label>
                                                        <textarea name="dep_remarks" cols="40" rows="2" class="form-control dep_remarks" placeholder="Remarks" ></textarea>

                                                    </div>
                                               <div class="form-group col-md-2 pull-right">
                                                        <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                        <button type="button" class="btn btn-theme form-control" id="saveDesignation" value="saveDesignation"><i class="fa fa-plus"></i>Save Department</button>
                                                        <button type="button" class="btn btn-theme form-control" id="updateDesignation" value="updateDesignation"><i class="fa fa-book"></i>Update Department</button>
                                                    </div> 
                                           </form>
                                      </div><!--//row-->
                                      <div id="DesignationGrid">
                                          
                                      </div>
                                  </div>
                                  <div class="tab-pane" id="FundTaB">
                                      <div class="row">
                                          <h1 class="section-heading text-highlight"><span class="line">Employee Fund Status</span></h1>
                                          <form name="student" method="post" id="EmpFundForm"  name="EmpFundForm">
                                           <div class="form-group col-md-3">
                                                    <label for="usr">Fund:<span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('fund',$funds,'',array('class'=>'form-control','id'=>'fund'))?>
                                                    <input type="hidden" name="fund_pk_id" class="fund_pk_id">
                                            </div>
                                            <div class="col-md-3">
                                                            <label style="text-indent: 3px">Fund Date <span style="color:red">*</span></label>
                                                            <div>
                                                                
                                                                <div style="width: 33%; float: left" class=" form-group">

                                                                <?php 

                                                                $dob_day = array();
                                                                for($d=1; $d<32; $d++):
                                                                    if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                    $dob_day[$v]= $d; 
                                                                endfor;
                                                                $dob_d =date('d'); 
                                                                echo form_dropdown('fund_day',$dob_day,$dob_d,array('class'=>'form-control','id'=>"fund_day"));
                                                                ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                                       <?php
                                                                            $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                                            $dob_m =date('m');
                                                                        echo form_dropdown('fund_month',$month,$dob_m,array('class'=>'form-control','id'=>"fund_month"));
                                                                    ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group">
                                                                    <?php
                                                                         $dob_year = array();
                                                                        for($y=date('Y')-20; $y<=date('Y'); $y++):
                                                                         $dob_year[$y] = $y;
                                                                        endfor;

                                                                          $dob_y =date('Y'); 
                                                                        echo form_dropdown('fund_year',$dob_year,$dob_y,array('class'=>'form-control','id'=>"fund_year"));

                                                                        ?>

                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div> 
                                              <div class="form-group col-md-12">
                                                        <label for="usr">Remarks.:</label>
                                                        <textarea name="fund_remarks" cols="40" rows="2" class="form-control fund_remarks" placeholder="Remarks" ></textarea>

                                                    </div>
                                            <div class="form-group col-md-2 pull-right">
                                                <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                <button type="button" class="btn btn-theme form-control" id="saveFund" value="saveFund"><i class="fa fa-plus"></i>Save Fund</button>
                                                <button type="button" class="btn btn-theme form-control" id="updateFund" value="updateFund"><i class="fa fa-book"></i>Update Fund</button>
                                            </div> 
                                              </form>
                                      </div><!--//row-->
                                      <div id="FundGrid">
                                          
                                      </div>
                                  </div>
                                  <div class="tab-pane" id="ShiftTaB">
                                      <div class="row">
                                          <h1 class="section-heading text-highlight"><span class="line">Employee Shift</span></h1>
                                          <form name="student" method="post" id="EmpShiftForm"  name="EmpShiftForm">
                                           <div class="form-group col-md-3">
                                                    <label for="usr">Shift: <span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('shift',$Shift,'',array('class'=>'form-control','id'=>'shift'))?>
                                                    <input type="hidden" name="shift_pk_id" class="shift_pk_id">
                                            </div>
                                            <div class="col-md-3">
                                                            <label style="text-indent: 3px">Shift Date:</label>
                                                            <div>
                                                                
                                                                <div style="width: 33%; float: left" class=" form-group">

                                                                <?php 

                                                                $dob_day = array();
                                                                for($d=1; $d<32; $d++):
                                                                    if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                    $dob_day[$v]= $d; 
                                                                endfor;
                                                                $dob_d =date('d'); 
                                                                echo form_dropdown('shift_day',$dob_day,$dob_d,array('class'=>'form-control','id'=>"shift_day"));
                                                                ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                                       <?php
                                                                            $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                                            $dob_m =date('m');
                                                                        echo form_dropdown('shift_month',$month,$dob_m,array('class'=>'form-control','id'=>"shift_month"));
                                                                    ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group">
                                                                    <?php
                                                                         $dob_year = array();
                                                                        for($y=date('Y')-20; $y<=date('Y'); $y++):
                                                                         $dob_year[$y] = $y;
                                                                        endfor;

                                                                          $dob_y =date('Y'); 
                                                                        echo form_dropdown('shift_year',$dob_year,$dob_y,array('class'=>'form-control','id'=>"shift_year"));

                                                                        ?>

                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="usr">Remarks.:</label>
                                                        <textarea name="shif_remarks" cols="40" rows="2" class="form-control shif_remarks" placeholder="Remarks" ></textarea>
                                                    </div>
                                            <div class="form-group col-md-2 pull-right">
                                                <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                <button type="button" class="btn btn-theme form-control" id="saveShift" value="saveShift"><i class="fa fa-plus"></i>Save Shift</button>
                                                <button type="button" class="btn btn-theme form-control" id="updateShift" value="updateShift"><i class="fa fa-book"></i>Update Shift</button>
                                            </div> 
                                              </form>
                                           
                                      </div><!--//row-->
                                      <div id="ShiftGrid">
                                          
                                      </div>
                                  </div>
                                  <div class="tab-pane" id="BankTaB">
                                      <div class="row">
                                          <h1 class="section-heading text-highlight"><span class="line">Employee Bank</span></h1>
                                           <form name="student" method="post" id="EmpBankForm"  name="EmpBankForm">
                                           <div class="form-group col-md-3">
                                                    <label for="usr">Bank Name <span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('bank',$bank,'',array('class'=>'form-control','id'=>'bank'))?>
                                                    <input type="hidden" name="bank_emp_id" class="bank_emp_id">
                                            </div>
                                           <div class="form-group col-md-3">
                                                    <label for="usr">Bank Branch <span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('branch',$branch,'',array('class'=>'form-control','id'=>'branch'))?>
                                            </div>
                                            <div class="form-group col-md-3">
                                                   <label for="usr">Account # <span style="color:red">*</span></label>
                                                    <input type="text" name="account_no" class="form-control" placeholder="Account #" id="account_no">
                                            </div>
                                            <div class="form-group col-md-3">
                                                   <label for="usr">Default Account </label>
                                                   <?php echo form_dropdown('default_acct',$commonStatus,'',array('class'=>'form-control','id'=>'default_acct'))?>
                                            </div>
                                            
                                                    <div class="form-group col-md-12">
                                                        <label for="usr">Remarks.</label>
                                                        <textarea name="bank_remarks" cols="40" rows="2" class="form-control bank_remarks" placeholder="Remarks" ></textarea>
                                                    </div>
                                            <div class="form-group col-md-2 pull-right">
                                                <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                <button type="button" class="btn btn-theme form-control" id="saveBank" value="saveBank"><i class="fa fa-plus"></i>Save Bank</button>
                                                <button type="button" class="btn btn-theme form-control" id="updateBank" value="updateBank"><i class="fa fa-book"></i>Update Bank</button>
                                            </div> 
                                              </form>
                                      </div><!--//row-->
                                        <div id="BankGrid">
                                          
                                      </div>
                                  </div>
                                  <div class="tab-pane" id="AllowanceTaB">
                                       <div class="row">
                                          <h1 class="section-heading text-highlight"><span class="line">Allowance for Higher Qualifications </span></h1>
                                           <form name="student" method="post" id="EmpAllowanceForm"  name="EmpAllowanceForm">
                                           <div class="form-group col-md-3">
                                                    <label for="usr">Allowance <span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('allowance',$allowance,'',array('class'=>'form-control','id'=>'allowance'))?>
                                                    <input type="hidden" name="allowance_id" class="allowance_id">
                                            </div>
                                               <div class="col-md-4">
                                                            <label style="text-indent: 3px">Allowance Date:</label>
                                                            <div>
                                                                
                                                                <div style="width: 33%; float: left" class=" form-group">

                                                                <?php 

                                                                $dob_day = array();
                                                                for($d=1; $d<32; $d++):
                                                                    if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                    $dob_day[$v]= $d; 
                                                                endfor;
                                                                $dob_d =''; 
//                                                                $dob_d =date('d'); 
                                                                echo form_dropdown('allowance_day',$dob_day,$dob_d,array('class'=>'form-control','id'=>"allowance_day"));
                                                                ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                                       <?php
                                                                            $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                                            $dob_m ='';
//                                                                            $dob_m =date('m');
                                                                        echo form_dropdown('allowance_month',$month,$dob_m,array('class'=>'form-control','id'=>"allowance_month"));
                                                                    ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group">
                                                                    <?php
                                                                         $dob_year = array();
                                                                        for($y=date('Y')-20; $y<=date('Y'); $y++):
                                                                         $dob_year[$y] = $y;
                                                                        endfor;

                                                                          $dob_y =''; 
//                                                                          $dob_y =date('Y'); 
                                                                        echo form_dropdown('allowance_year',$dob_year,$dob_y,array('class'=>'form-control','id'=>"allowance_year"));

                                                                        ?>

                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                         <div class="form-group col-md-3">
                                                                <label for="usr">Default Allowance</label>
                                                                <?php echo form_dropdown('default_allowance',$commonStatus,'',array('class'=>'form-control','id'=>'default_allowance'))?>
                                                         </div>
                                            
                                                    <div class="form-group col-md-12">
                                                        <label for="usr">Remarks.:</label>
                                                        <textarea name="allowance_remarks" cols="40" rows="2" class="form-control allowance_remarks" placeholder="Remarks" ></textarea>
                                                    </div>
                                            <div class="form-group col-md-2 pull-right">
                                                <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                <button type="button" class="btn btn-theme form-control" id="saveAllowance" value="saveAllowance"><i class="fa fa-plus"></i>Save Allowance</button>
                                                <button type="button" class="btn btn-theme form-control" id="updateAllowance" value="updateAllowance"><i class="fa fa-book"></i>Update Allowance</button>
                                            </div> 
                                              </form>
                                      </div><!--//row-->
                                        <div id="AllowanceGrid">
                                          
                                      </div>
                                  </div>
                                  <div class="tab-pane" id="ResponsibilityTaB">
                                       <div class="row">
                                          <h1 class="section-heading text-highlight"><span class="line">Extra Responsibility </span></h1>
                                           <form name="student" method="post" id="EmpResponsibilityForm"  name="EmpResponsibilityForm">
                                               <div class="form-group col-md-12">
                                                        <label for="usr">Responsibility Details <span style="color:red">*</span></label>
                                                        <textarea name="responsibility" cols="40" rows="2" class="form-control responsibility" placeholder="Responsibility" ></textarea>
                                                        <input type="hidden" name="Resp_id" class="Resp_id">
                                                    </div>
                                                <div class="col-md-4">
                                                            <label style="text-indent: 3px">Responsibility From : <span style="color:red">*</span></label>
                                                            <div>
                                                                
                                                                <div style="width: 33%; float: left" class=" form-group">

                                                                <?php 

                                                                $dob_day = array();
                                                                for($d=1; $d<32; $d++):
                                                                    if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                    $dob_day[$v]= $d; 
                                                                endfor;
                                                                $dob_d =date('d'); 
                                                                echo form_dropdown('Resp_from_day',$dob_day,$dob_d,array('class'=>'form-control','id'=>"Resp_from_day"));
                                                                ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                                       <?php
                                                                            $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                                            $dob_m =date('m');
                                                                        echo form_dropdown('Resp_from_month',$month,$dob_m,array('class'=>'form-control','id'=>"Resp_from_month"));
                                                                    ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group">
                                                                    <?php
                                                                         $dob_year = array();
                                                                        for($y=date('Y')-30; $y<=date('Y')+10; $y++):
                                                                         $dob_year[$y] = $y;
                                                                        endfor;

                                                                          $dob_y =date('Y'); 
                                                                        echo form_dropdown('Resp_from_year',$dob_year,$dob_y,array('class'=>'form-control','id'=>"Resp_from_year"));

                                                                        ?>

                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                
                                                <div class="col-md-4">
                                                            <label style="text-indent: 3px">Responsibility To : <span style="color:red">*</span></label>
                                                            <div>
                                                                
                                                                <div style="width: 33%; float: left" class=" form-group">

                                                                <?php 

                                                                $dob_day = array();
                                                                for($d=1; $d<32; $d++):
                                                                    if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                    $dob_day[$v]= $d; 
                                                                endfor;
                                                                $dob_d =date('d'); 
                                                                echo form_dropdown('Resp_to_day',$dob_day,$dob_d,array('class'=>'form-control','id'=>"Resp_to_day"));
                                                                ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                                       <?php
                                                                            $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                                            $dob_m =date('m');
                                                                        echo form_dropdown('Resp_to_month',$month,$dob_m,array('class'=>'form-control','id'=>"Resp_to_month"));
                                                                    ?> 
                                                                </div>
                                                                <div style="width: 33%; float: left" class="form-group">
                                                                    <?php
                                                                         $dob_year = array();
                                                                         for($y=date('Y')-30; $y<=date('Y')+10; $y++):
                                                                         $dob_year[$y] = $y;
                                                                        endfor;

                                                                          $dob_y =date('Y'); 
                                                                        echo form_dropdown('Resp_to_year',$dob_year,$dob_y,array('class'=>'form-control','id'=>"Resp_to_year"));

                                                                        ?>

                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                                <label for="usr">Responsibility Status</label>
                                                                <?php echo form_dropdown('Resp_status',$RespStatus,'',array('class'=>'form-control','id'=>'Resp_status'))?>
                                                         </div>  
                                            
                                                    <div class="form-group col-md-12">
                                                        <label for="usr">Remarks.:</label>
                                                        <textarea name="Resp_remarks" cols="40" rows="2" class="form-control Resp_remarks" placeholder="Remarks" ></textarea>
                                                    </div>
                                            <div class="form-group col-md-2 pull-right">
                                                <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                <button type="button" class="btn btn-theme form-control" id="saveResponsibility" value="saveResponsibility"><i class="fa fa-plus"></i>Save Responsibility</button>
                                                <button type="button" class="btn btn-theme form-control" id="updateResponsibility" value="updateResponsibility"><i class="fa fa-book"></i>Update Responsibility</button>
                                            </div> 
                                              </form>
                                      </div><!--//row-->
                                        <div id="ResponsibilityGrid">
                                          
                                      </div>
                                  </div>
                                  <div class="tab-pane" id="LetterTaB">
                                       <div class="row">
                                          <h1 class="section-heading text-highlight"><span class="line">New Record</span></h1>
                                            <?php echo form_open_multipart('',array('id'=>'EmpLetterForm')) ?>
                                                <div class="col-md-3">
                                                    <label class="control-label" for="basicinput">Letter No</label>
                                                    <input type="text" name="c_renwal_letter_no" placeholder="Letter No"  value="" class="form-control">
                                                    <input type="hidden" name="Letter_id" class="Letter_id" value="">
                                                    <input type="hidden" name="old_image" class="old_image" >
                                                </div>
                                                <div class="col-md-3">
                                                    <label style="text-indent: 3px">Letter Date <span style="color:red">*</span></label>
                                                    <div>
                                                        <div style="width: 33%; float: left" class=" form-group">
                                                            
                                                            <?php 

                                                            $dob_day = array();
                                                            for($d=1; $d<32; $d++):
                                                                if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                $dob_day[$v]= $d; 
                                                            endfor;
            //                                                $dob_d =date('d',strtotime($result->dob)); 
                                                            $dob_d =date('d'); 
                                                            echo form_dropdown('letter_day',$dob_day,$dob_d,array('class'=>'form-control','id'=>"letter_day"));
                                                            ?> 
                                                        </div>
                                                        <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                            <?php
                                                             $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                             $dob_m =date('m'); 
            //                                                 $dob_m =date('m',strtotime($result->dob)); 
                                                            echo form_dropdown('letter_month',$month,$dob_m,array('class'=>'form-control','id'=>"letter_month"));
                                                            ?>

                                                        </div>
                                                        <div style="width: 33%; float: left" class="form-group">
                                                              <?php
                                                                 $dob_year = array();
                                                                for($y=date('Y')-50; $y<=date('Y')+2; $y++):
                                                                 $dob_year[$y] = $y;
                                                                endfor;

            //                                                      $dob_y =date('Y',strtotime($result->dob)); 
                                                                  $dob_y =date('Y'); 
                                                                echo form_dropdown('letter_year',$dob_year,$dob_y,array('class'=>'form-control','id'=>"letter_year"));

                                                                ?>

                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="col-md-3">
                                                    <label style="text-indent: 3px">Contract From Date</label>
                                                    <div>
                                                        <div style="width: 33%; float: left" class=" form-group">
                                                            <?php 

                                                            $dob_day = array();
                                                            $dob_day['']    = 'Day';
                                                            for($d=1; $d<32; $d++):
                                                                if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                $dob_day[$v]= $d; 
                                                            endfor;  
                                                            echo form_dropdown('c_f_day',$dob_day,'',array('class'=>'form-control','id'=>'c_f_day'));
                                                            ?> 
                                                        </div>
                                                        <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                            <?php
                                                             $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                            echo form_dropdown('c_f_month',$month,'',array('class'=>'form-control','id'=>'c_f_month'));
                                                            ?>

                                                        </div>
                                                        <div style="width: 33%; float: left" class="form-group">
                                                              <?php
                                                                 $dob_year = array();
                                                                  $dob_year['']    = 'Year';
                                                                  for($y=date('Y')-50; $y<=date('Y')+2; $y++):
                                                                 $dob_year[$y] = $y;
                                                                endfor;
                                                                echo form_dropdown('c_f_year',$dob_year,'',array('class'=>'form-control','id'=>'c_f_year'));

                                                                ?>

                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="col-md-3">
                                                    <label style="text-indent: 3px">Contract To Date</label>
                                                    <div>
                                                        <div style="width: 33%; float: left" class=" form-group">
                                                            <?php 

                                                            $dob_day = array();
                                                            $dob_day['']    = 'Day';
                                                            for($d=1; $d<32; $d++):
                                                                if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                $dob_day[$v]= $d; 
                                                            endfor;  
                                                            echo form_dropdown('c_t_day',$dob_day,'',array('class'=>'form-control','id'=>'c_t_day'));
                                                            ?> 
                                                        </div>
                                                        <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                            <?php
                                                             $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                            echo form_dropdown('c_t_month',$month,'',array('class'=>'form-control','id'=>'c_t_month'));
                                                            ?>

                                                        </div>
                                                        <div style="width: 33%; float: left" class="form-group">
                                                              <?php
                                                                 $dob_year = array();
                                                                  $dob_year['']    = 'Year';
                                                                  for($y=date('Y')-50; $y<=date('Y')+2; $y++):
                                                                 $dob_year[$y] = $y;
                                                                endfor;
                                                                echo form_dropdown('c_t_year',$dob_year,'',array('class'=>'form-control','id'=>'c_t_year'));

                                                                ?>

                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                                 <div class="form-group col-md-3">
                                                    <label for="usr">Category <span style="color:red">*</span></label>
                                                    <?php
                                                    
//                                                            $this->db->order_by('emp_staff_design_id','desc'); 
//                                                            $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_staff_designation.emp_staff_designation_id');
                                                $desi_dtl = $this->db->get_where('hr_emp_staff_designation',array('emp_staff_emp_id'=>$employee_id))->row();
                                                
//                                                $CategoryLtr= $this->CRUDModel->DropDown_Code('hr_emp_category', '', 'category_id', 'category_name','category_code',array('category_id'=>$desi_dtl->emp_desg_cat_id));
                                                echo form_dropdown('ltr_category_id',$Category,'',array('class'=>'form-control','id'=>'ltr_category_id'))?>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="usr">Category Type <span style="color:red">*</span></label>
                                                    <?php
//                                                    $CategoryTypeLtr = $this->CRUDModel->DropDown_Code('hr_emp_category_type', '', 'category_type_id', 'ctgy_type_name','ctgy_type_code',array('ctgy_type_cat_id'=>$desi_dtl->emp_desg_cat_id));
                                                    echo form_dropdown('ltr_category_type_id',$CategoryType,'',array('class'=>'form-control','id'=>'ltr_category_type_id'))?>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="usr">Designation <span style="color:red">*</span></label>
                                                    <?php 
//                                                        $DesignationLtr  = $this->CRUDModel->DropDown_Code('hr_emp_designation', '', 'emp_desg_id', 'emp_desg_name','emp_desg_code',array('emp_desg_cat_id'=>$desi_dtl->emp_desg_cat_id,'emp_desg_cat_type_id'=>$desi_dtl->emp_desg_cat_type_id));
                                                    echo form_dropdown('ltr_designation_id',$Designation,'',array('class'=>'form-control','id'=>'ltr_designation_id'))?>
                                                </div>
                                                  <div class="form-group col-md-3">
                                                    <label for="usr">Scale <span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('scale_id',$scale,'',array('class'=>'form-control','id'=>'scale_id'))?>
                                                </div>
                                                  
                                                 <div class="form-group col-md-3">
                                                    <label for="usr">Contract Status <span style="color:red">*</span></label>
                                                    <?php echo form_dropdown('contract_status',$contract_status,'',array('class'=>'form-control','id'=>'contract_status'))?> 
                                                </div>
                                                 <div class="col-md-3">
                                                    <label class="control-label" for="basicinput">Contract Picture</label>
                                                    <input type="file" name="file"  class="form-control">
                                                </div>
                                                <div class="col-md-12">
                                                      <label for="name">Renewal Details</label>
                                                     <textarea name="renewal_details" cols="40" rows="2" class="form-control" placeholder="Renewal Details"  id="renewal_details"></textarea>
                                                 </div>     

                                                <div class="col-md-12">
                                                      <label for="name">Renewal Remarks</label>
                                                     <textarea name="renewal_remarks" cols="40" rows="2" class="form-control" placeholder="Renewal Remarks"  id="renewal_remarks"></textarea>
                                                 </div>
                                          
                                          <div class="col-md-12 image_div" style="text-align: center">
                                                    </br>
                                                    <div id="image" ></div>
                                                     <button type="button" class="btn btn-danger btn-sm DeleteFile">Delete file</button>
                                                </div>
                                          
                                          
                                               
                                             <div class="form-group col-md-2 pull-right">
                                                <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                                <button type="button" class="btn btn-theme form-control" id="saveLetter" value="saveLetter"><i class="fa fa-plus"></i>Save Record</button>
                                                <button type="button" class="btn btn-theme form-control" id="updateLetter" value="updateLetter"><i class="fa fa-book"></i>Update Record</button>
                                            </div>
                                             <?php echo form_close();?>
                                      </div><!--//row-->
                                        <div id="LetterGrid">
                                          
                                      </div>
                                  </div>
                                </div>
                            </div><!--//featured-courses-->
                        </div>
                    </div>
                </div>
             </div>
        </div><!--//col-md-3-->
        
        
           <div class="modal fade" id="entry_validation" role="dialog" style="z-index:9999">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h1 style="text-align:center; font-size: 80px; color: #c00;" id="resp_icon"></h1>
                            <h4 style="text-align:center; color: #c00; margin: 0px;"><strong id="resp_type"></strong></h4>
                            <p style="margin:0">&nbsp;</p>
                            <h4 style="text-align:center"><strong id="resp_text"></strong></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="entry_success" role="dialog" style="z-index:9999">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h1 style="text-align:center; font-size: 80px; color: #0e7a44;" id="succ_icon"></h1>
                            <h4 style="text-align:center; color: #0e7a44; margin: 0px;"><strong id="succ_type"></strong></h4>
                            <p style="margin:0">&nbsp;</p>
                            <h4 style="text-align:center"><strong id="succ_text"></strong></h4>
                            
                        </div>
                        <div class="modal-footer">
                             <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        
        
        <script>
            jQuery(document).ready(function(){
               
               //Show Records
               refresh_page();
                
                function refresh_page(){
                    Employee_Wedget();
                    Employee_Basic_Info();
                    Academic_Grid();
                    Experience_Grid();
                    Designation_Grid();
                    Fund_Grid();
                    Shift_Grid();
                    Bank_Grid();
                    Allowance_Grid();
                    Responsibility_Grid();
                    Letter_Grid();
                }
                function Employee_Wedget(){
                     $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'wedget_PersonalInfo','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#Employee_Wedget").html(response); 
                        }
                    });
               };
                function Employee_Basic_Info(){
                     $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        dataType : 'json',
                        data     : {'request':'basic_Info','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                            $('input:text[name=emp_name]').val(response['emp_name']); 
                            $('input:text[name=father_name]').val(response['father_name']); 
                            $('input:text[name=emp_husband_name]').val(response['emp_husband_name']); 
                            $('input:text[name=emp_cnic]').val(response['nic']); 
                            $('#gender_id').val(response['gender_id']); 
                            
                                var dob = response['dob'];
                                var sp_dob = dob.split("-");
                            $('#dob_year').val(Number(sp_dob[0]).toString()); 
                            $('#dob_month').val(Number(sp_dob[1]).toString()); 
                            $('#dob_day').val(sp_dob[2]); 
                            $('input:text[name=postal_address]').val(response['postal_address']); 
                            $('input:text[name=permanent_address]').val(response['permanent_address']); 
                            $('input:text[name=district]').val(response['distric_name']); 
                            $('#district_id').val(response['district_id']); 
                            $('input:text[name=post_office]').val(response['post_office']); 
                            $('input:text[name=country]').val(response['country_name']); 
                            $('#country_id').val(response['country_id']); 
                            $('input:text[name=ptcl_number]').val(response['ptcl_number']); 
                            $('input:text[name=contact1]').val(response['contact1']);
                            $('.old_picture').val(response['picture']);
                            $('.email').val(response['email']);
                            $('#net_id').val(response['net_id']);
                            $('#emp_remarks').val(response['comment']);
                            $('#religion_id').val(response['religion_id']);
                            $('#marital_status_id').val(response['marital_status_id']);
                            
                            $('input:text[name=marital_status_id]').val(response['marital_status_id']); 
                            
                        }
                    });
               };
                function Academic_Grid(){
                    $('#emp_academic_id').val(''); 
                    var Pk_ID = jQuery('#emp_academic_id').val();
                    
                    if(Pk_ID == ''){
                        jQuery('#updateAcademic').hide();
                        jQuery('#saveAcademic').show();
                    }else{
                       jQuery('#updateAcademic').show();
                       jQuery('#saveAcademic').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'academic_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                            jQuery("#AcademicGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'academic','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Academic-tab').css('color','red');
                                 }else{
                                     jQuery('#Academic-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
                function Experience_Grid(){
                     jQuery('.experience_id').val(''); 
                    var Pk_ID = jQuery('.experience_id').val();
                    
                    if(Pk_ID == ''){
                        jQuery('#updateExperience').hide();
                        jQuery('#saveExperience').show();
                    }else{
                       jQuery('#updateExperience').show();
                       jQuery('#saveExperience').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'experience_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                            jQuery("#ExperienceGrid").html(response);
                         },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'experience','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Experience-tab').css('color','red');
                                 }else{
                                     jQuery('#Experience-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
                function Designation_Grid(){
                     jQuery('.emp_staff_design_id').val('');
                    var designation_id = jQuery('.emp_staff_design_id').val();
                    
                    if(designation_id == ''){
                        
                        jQuery('#updateDesignation').hide();
                        jQuery('#saveDesignation').show();
                    }else{
                       jQuery('#updateDesignation').show();
                       jQuery('#saveDesignation').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'designation_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#DesignationGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'department','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Department-tab').css('color','red');
                                 }else{
                                     jQuery('#Department-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
                function Fund_Grid(){
                    jQuery('.fund_pk_id').val('');
                   if(jQuery('.fund_pk_id').val() == ''){
                        
                        jQuery('#updateFund').hide();
                        jQuery('#saveFund').show();
                    }else{
                       jQuery('#updateFund').show();
                       jQuery('#saveFund').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'fund_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#FundGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'fund','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Fund-tab').css('color','red');
                                 }else{
                                     jQuery('#Fund-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
                function Shift_Grid(){
                    jQuery('.shift_pk_id').val('');
                   if(jQuery('.shift_pk_id').val() == ''){
                        
                        jQuery('#updateShift').hide();
                        jQuery('#saveShift').show();
                    }else{
                       jQuery('#updateShift').show();
                       jQuery('#saveShift').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'shift_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#ShiftGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'shift','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Shift-tab').css('color','red');
                                 }else{
                                     jQuery('#Shift-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
                function Bank_Grid(){
                    jQuery('.bank_emp_id').val('');
                   if(jQuery('.bank_emp_id').val() == ''){
                        
                        jQuery('#updateBank').hide();
                        jQuery('#saveBank').show();
                    }else{
                       jQuery('#updateBank').show();
                       jQuery('#saveBank').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'bank_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#BankGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'bank','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Bank-tab').css('color','red');
                                 }else{
                                     jQuery('#Bank-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
                function Allowance_Grid(){
                    jQuery('.allowance_id').val('');
                   if(jQuery('.allowance_id').val() == ''){
                        jQuery('#updateAllowance').hide();
                        jQuery('#saveAllowance').show();
                    }else{
                       jQuery('#updateAllowance').show();
                       jQuery('#saveAllowance').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'allowance_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#AllowanceGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'allowance','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Allowance-tab').css('color','red');
                                 }else{
                                     jQuery('#Allowance-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
                function Responsibility_Grid(){
                    jQuery('.Resp_id').val('');
                   if(jQuery('.Resp_id').val() == ''){
                        jQuery('#updateResponsibility').hide();
                        jQuery('#saveResponsibility').show();
                    }else{
                       jQuery('#updateResponsibility').show();
                       jQuery('#saveResponsibility').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'responsibility_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#ResponsibilityGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'responsibility','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Responsibility-tab').css('color','red');
                                 }else{
                                     jQuery('#Responsibility-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
                function Letter_Grid(){
                    jQuery('.Letter_id').val('');
                     jQuery('.image_div').hide();
                   if(jQuery('.Letter_id').val() == ''){
                        jQuery('#updateLetter').hide();
                        jQuery('#saveLetter').show();
                       
                    }else{
                       jQuery('#updateLetter').show();
                       jQuery('#saveLetter').hide(); 
                       
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'letter_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#LetterGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'letter','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Letter-tab').css('color','red');
                                 }else{
                                     jQuery('#Letter-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
                jQuery('#UpdateRecord').on('click',function(){
                        var formData = new FormData($("#RegEmployee")[0]);
                            formData.set("UpdateEmployee", 'UpdateEmployee');
                            formData.set("employee_id", jQuery('#employee_id').val());
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#entry_success').modal('toggle');
                                    var URL = 'UpdateEmployee/'+response['emp_id'];
                                    setTimeout(function(){
                                        window.location.href = URL;
                                    }, 2000);
                                     
                                 }
                                console.log(response);  
                            }
                        });

                   });
                jQuery('#saveAcademic').on('click',function(){
                       var  formData = new FormData($("#AcademicForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("SaveAcademic", 'SaveAcademic');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {

                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#AcademicForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Academic_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });
                jQuery('#updateAcademic').on('click',function(){
                   var  formData = new FormData($("#AcademicForm")[0]);
                        formData.set("employee_id", jQuery('#employee_id').val());
                        formData.set("emp_academic_id", jQuery('#emp_academic_id').val());
                        formData.set("UpdateAcademic", 'UpdateAcademic');
                    $.ajax({
                        type     : "POST",
                        url      : 'RegisterEmployee',
                        data     : formData,
                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        success  : function(response){
                          console.log(response);   
                            if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }
                            else {
                                
                                $('#succ_icon').html(response['e_icon']);
                                $('#succ_type').html(response['e_type']);
                                $('#succ_text').html(response['e_text']);
                                $('#AcademicForm')[0].reset();
                                $('#entry_success').modal('toggle');
                                Academic_Grid();
                            }
                            console.log(response);  
                        }
                    });
                   
               });
                jQuery('#saveExperience').on('click',function(){
                       var  formData = new FormData($("#ExperienceForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("saveExperience", 'saveExperience');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {

                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#ExperienceForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Experience_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });
                jQuery('#updateExperience').on('click',function(){
                       var  formData = new FormData($("#ExperienceForm")[0]);
                            formData.set("experience_id", jQuery('.experience_id').val());
                            formData.set("updateExperience", 'updateExperience');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#ExperienceForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Experience_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });
                jQuery('#category_id').on('change',function(){
                    jQuery.ajax({
                        type        : 'post',
                        url         : 'Get-Category-Type',
                        data        : {'category_id':jQuery("#category_id").val()},
                        success     :function(response){
                          $('#category_type_id').html(response);
                          jQuery.ajax({
                            type        : 'post',
                            url         : 'Get-Department',
                            data        : {'category_id':jQuery("#category_id").val()},
                            success     :function(response){
                              $('#department_id').html(response);
                                }
                               });
                            }
                           });
                    });
                jQuery('#category_type_id').on('click',function(){
                    jQuery.ajax({
                        type        : 'post',
                        url         : 'Get-Designation-Type',
                        data        : {'category_type_id':jQuery("#category_type_id").val()},
                        success     :function(response){
                          $('#designation_id').html(response);
                               }
                           });
                    });
                jQuery('#saveDesignation').on('click',function(){
                       var  formData = new FormData($("#EmpDepartmentForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("saveDesignation", 'saveDesignation');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {

                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpDepartmentForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Designation_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });
                jQuery('#updateDesignation').on('click',function(){
                       var  formData = new FormData($("#EmpDepartmentForm")[0]);
                            formData.set("designation_id", jQuery('#designation_id').val());
                            formData.set("updateDesignation", 'updateDesignation');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {

                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpDepartmentForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Designation_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });
                jQuery('#saveFund').on('click',function(){
                       var  formData = new FormData($("#EmpFundForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("saveFund", 'saveFund');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpFundForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Fund_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });   
                jQuery('#updateFund').on('click',function(){
                       var  formData = new FormData($("#EmpFundForm")[0]);
                            formData.set("fund_pk_id", jQuery('.fund_pk_id').val());
                            formData.set("updateFund", 'updateFund');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {

                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpFundForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Fund_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });   
                jQuery('#saveShift').on('click',function(){
                       var  formData = new FormData($("#EmpShiftForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("saveShift", 'saveShift');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpShiftForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Shift_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });   
                jQuery('#updateShift').on('click',function(){
                       var  formData = new FormData($("#EmpShiftForm")[0]);
                            formData.set("shift_pk_id", jQuery('.shift_pk_id').val());
                            formData.set("updateShift", 'updateShift');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {

                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpShiftForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Shift_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   }); 
                jQuery('#bank').on('change',function(){
                    jQuery.ajax({
                        type        : 'post',
                        url         : 'Get-Branch',
                        data        : {'bank':jQuery("#bank").val()},
                        success     :function(response){
                          $('#branch').html(response);
                           
                            }
                           });
                    });
                jQuery('#saveBank').on('click',function(){
                       var  formData = new FormData($("#EmpBankForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("saveBank", 'saveBank');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpBankForm')[0].reset();
//                                    $('#branch').empty();
//                                    $("#branch").prepend('<option selected="selected" value="">SELECT BRANCH</option>');    
                                    
                                    $('#entry_success').modal('toggle');
                                    Bank_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });   
                jQuery('#updateBank').on('click',function(){
                       var  formData = new FormData($("#EmpBankForm")[0]);
                            formData.set("bank_id", jQuery('.bank_emp_id').val());
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("updateBank", 'updateBank');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpBankForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Bank_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });    
                jQuery('#saveAllowance').on('click',function(){
                       var  formData = new FormData($("#EmpAllowanceForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("saveAllowance", 'saveAllowance');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpAllowanceForm')[0].reset();
//                                    $('#branch').empty();
//                                    $("#branch").prepend('<option selected="selected" value="">SELECT BRANCH</option>');    
                                    
                                    $('#entry_success').modal('toggle');
                                    Allowance_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });   
                jQuery('#updateAllowance').on('click',function(){
                       var  formData = new FormData($("#EmpAllowanceForm")[0]);
                            formData.set("allowance_id", jQuery('.allowance_id').val());
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("updateAllownance", 'updateAllownance');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpAllowanceForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Allowance_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });    
                jQuery('#saveResponsibility').on('click',function(){
                       var  formData = new FormData($("#EmpResponsibilityForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("saveResponsibility", 'saveResponsibility');
                        $.ajax({
                            type        : "POST",
                            url         : 'RegisterEmployee',
                            data        : formData,
                            dataType    : 'json',
                            contentType : false,
                            processData : false,
                            success     : function(response){
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpResponsibilityForm')[0].reset();
//                                    $('#branch').empty();
//                                    $("#branch").prepend('<option selected="selected" value="">SELECT BRANCH</option>');    
                                    
                                    $('#entry_success').modal('toggle');
                                    Responsibility_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });   
                jQuery('#updateResponsibility').on('click',function(){
                       var  formData = new FormData($("#EmpResponsibilityForm")[0]);
                            formData.set("Resp_id", jQuery('.Resp_id').val());
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("updateResponsibility", 'updateResponsibility');
                        $.ajax({
                            type     : "POST",
                            url      : 'RegisterEmployee',
                            data     : formData,
                            dataType : 'json',
                            contentType : false,
                            processData : false,
                            success  : function(response){
                              console.log(response);   
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpResponsibilityForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Responsibility_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   });    
               
                jQuery('#ltr_category_id').on('change',function(){
                    jQuery.ajax({
                        type        : 'post',
                        url         : 'Get-Category-Type',
                        data        : {'category_id':jQuery("#ltr_category_id").val()},
                        success     :function(response){
                          $('#ltr_category_type_id').html(response);
                          jQuery.ajax({
                            type        : 'post',
                            url         : 'Get-Department',
                            data        : {'category_id':jQuery("#ltr_category_id").val()},
                            success     :function(response){
                              $('#department_id').html(response);
                                }
                               });
                            }
                           });
                    });
                jQuery('#ltr_category_type_id').on('click',function(){
                    jQuery.ajax({
                        type        : 'post',
                        url         : 'Get-Designation-Type',
                        data        : {'category_type_id':jQuery("#ltr_category_type_id").val()},
                        success     :function(response){
                          $('#ltr_designation_id').html(response);
                               }
                           });
                    });
                jQuery('#saveLetter').on('click',function(){
                       var  formData = new FormData($("#EmpLetterForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("saveLetter", 'saveLetter');
                        $.ajax({
                            type        : "POST",
                            url         : 'RegisterEmployee',
                            data        : formData,
                            dataType    : 'json',
                            contentType : false,
                            processData : false,
                            success     : function(response){
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpLetterForm')[0].reset();
//                                    $('#branch').empty();
//                                    $("#branch").prepend('<option selected="selected" value="">SELECT BRANCH</option>');    
                                    
                                    $('#entry_success').modal('toggle');
                                    Letter_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   }); 
                jQuery('#updateLetter').on('click',function(){
                       var  formData = new FormData($("#EmpLetterForm")[0]);
                            formData.set("employee_id", jQuery('#employee_id').val());
                            formData.set("updateLetter", 'updateLetter');
                        $.ajax({
                            type        : "POST",
                            url         : 'RegisterEmployee',
                            data        : formData,
                            dataType    : 'json',
                            contentType : false,
                            processData : false,
                            success     : function(response){
                                if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }
                                else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#EmpLetterForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                    Letter_Grid();
                                }
                                console.log(response);  
                            }
                        });

                   }); 
              jQuery('.DeleteFile').on('click',function(){
           
//                    if (!confirm("Are you sure to delete this..?")){ return false;} 
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'letter_file_delete','Letter_id':jQuery('.Letter_id').val(),'old_image':jQuery('.old_image').val()},
                        success  : function(response){
                        jQuery('.image_div').hide();
                        }
                    });

        });
            $('html').bind('keypress', function(e){
                if(e.keyCode == 13){ return false; }
            });
               
            });
        </script>  