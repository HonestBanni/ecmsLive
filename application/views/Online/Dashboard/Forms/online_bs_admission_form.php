
<style>
    a.btn-cta, .btn-cta{
    background: #f12b24;
    color: #fff;
    padding: 10px 20px;
    font-size: 18px;
    line-height: 1.33;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    -o-border-radius: 0;
    border-radius: 0;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #f12b24;
    
    }
</style>

<!-- ******CONTENT****** --> 
        <div class="content container">
              
            <div class="row cols-wrapper">
               
                <div class="col-md-12">
                    
                    <section class="course-finder" style="background-color: #fcfcfc; border: none;">
                    <h1 class="section-heading text-highlight"><strong><span class="line">ADMISSION FORM</span></strong></h1>
                        
                        <div class="section-content">
                            <form class="course-finder-form" action="SaveOnlineAdmissionForm" id="saveAppForm" name="saveAppForm" method="post" enctype="multipart/form-data" >
                                <div class="row">
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Program <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('programe_id', $program, '',  'class="form-control" id="programe_id" autocomplete="off" required="required"'); ?>
                                        <input type="hidden" name="batch" id="batch" class="form-control" value="">
                                        <br>
                                    </div>
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Sub Program <span style="color:red">*</span></label>
                                         <?php echo form_dropdown('sub_pro_id', '', '',  'class="form-control" id="sub_pro_id" autocomplete="off" required="required"'); ?>
                                        <br>
                                    </div>
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Comments (If Any)</label>
                                        <input type="text" name="comments" id="comments" class="form-control" autocomplete="off" maxlength="150">
                                        <br>
                                    </div>
                                    
                                    <div id="artsubjectlist"> </div>  
                                    
                                    <div class="col-md-12">
                                        <p style="text-indent: 3px; font-weight: bold">Select specified quota (if any) otherwise application will not be considered against the quota</p>
                                    </div>
                                    
                                    <div class="form-group col-md-3">
                                        <input type="checkbox" name="open_merit" value="1" id="open_merit" checked="checked" onclick="return false">&nbsp;&nbsp;
                                        <span style=""><strong>Open Merit</strong></span>
                                    </div>
                                    
                                    <?php
                                    if($reserved_seat):
                                        foreach($reserved_seat as $rsRow): ?>
                                            <div class="form-group col-md-3">
                                                <input type="checkbox" name="rs_seats[]" value="<?php echo $rsRow->rseat_id; ?>" id="rs_seats" class="rs_seats" autocomplete="off" >&nbsp;&nbsp;
                                                <span><strong><?php echo $rsRow->name; ?></strong></span>
                                            </div>
                                        <?php endforeach;
                                    endif;
                                    ?>
                                    
                                </div>
                                <hr style="border: 1px solid #208e4c;">
                                
                                <h1 class="section-heading text-highlight"><strong>Applicant Information </strong></h1><br>
                                <div class="row">
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Applicant Name <span style="color:red">*</span> (As in HSSC DMC)</label>
                                        <input type="text" id="student_name"  name="student_name" class="form-control" autocomplete="off" maxlength="40" required="required">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Applicant Mobile No. <span style="color:red">*</span></label>
                                        <input type="text" id="student_mobile"  name="student_mobile" class="form-control mphone"  autocomplete="off" required="required">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Mobile Network <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('student_network', $mobile_network, '',  'class="form-control" id="student_network" autocomplete="off" required="required"'); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Applicant CNIC (00000-0000000-0)</label>
                                        <input type="text" id="student_cnic"  name="student_cnic" class="form-control nic"  autocomplete="off">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Gender <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('gender', $gender, '',  'class="form-control" id="gender" autocomplete="off" required="required"'); ?>
                                        <br>
                                    </div>    
                                    
<!--                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Date of Birth <span style="color:red">*</span></label>
                                        <input type="text" name="dob" id="dob" class="form-control datepicker" autocomplete="off">
                                        <br>
                                    </div>    -->
                                    
                                    <div class="col-md-4 subject">
                                        <label style="text-indent: 3px">Date of Birth <span style="color:red">*</span></label>
                                        <div>
                                            <div style="width: 33%; float: left" class=" form-group">
                                                <select class="form-control" name="dob_day" id="dob_day" autocomplete="off" required="required" >
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
                                                <select class="form-control" name="dob_month" id="dob_month" required="required">
                                                    <option value="">Month</option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group">
                                                <select class="form-control" name="dob_year" id="dob_year" autocomplete="off"  required="required">
                                                    <option value="">Year</option>
                                                    <?php
                                                    for($y=1985; $y<=date('Y')-15; $y++):
                                                        echo '<option value="'.$y.'">'.$y.'</option>';
                                                    endfor;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                    </div>   
                                    <div class="clearfix"></div>
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Blood Group</label>
                                        <?php echo form_dropdown('bld_group', $bgroup, '',  'class="form-control" id="bld_group" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
<!--                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Country <span style="color:red">*</span></label>
                                        <?php// echo form_dropdown('country', $countries, '',  'class="form-control" id="country" autocomplete="off" '); ?>
                                        <br>
                                    </div>    -->
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Domicile <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('domicile', $domicile, '',  'class="form-control" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">District <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('district', $district, '',  'class="form-control"  autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Religion <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('religion', $religion, '',  'class="form-control" id="religion" autocomplete="off"  required="required"'); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Hostel Required <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('hostel', $hostelReq, '',  'class="form-control" id="hostel" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                       
                                    
                                </div>
                                <hr style="border: 1px solid #208e4c;">
                                
                                <h1 class="section-heading text-highlight"><strong>Father/Guardian Information </strong></h1><br>
                                <div class="row">
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Name <span style="color:red">*</span></label>
                                        <input type="text" id="father_name"  name="father_name" class="form-control"  autocomplete="off" maxlength="40" required="required">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father / Guardian CNIC <span style="color:red">*</span> (00000-0000000-0)</label>
                                        <input type="text" id="father_cnic"  name="father_cnic" class="form-control nic"  autocomplete="off" required="required">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Landline No.</label>
                                        <input type="text" id="landline"  name="landline" class="form-control" autocomplete="off" maxlength="15">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Mobile No. <span style="color:red">*</span></label>
                                        <input type="text" id="father_mobile"  name="father_mobile" class="form-control mphone" autocomplete="off" required="required">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Mobile Network <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('father_network', $mobile_network, '',  'class="form-control" id="father_network" autocomplete="off" required="required"'); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Occupation <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('occupation', $father_occ, '',  'class="form-control" id="" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Annual Income <span style="color:red">*</span></label>
                                        <input type="text" id="income"  name="income" class="form-control number" autocomplete="off">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Email</label>
                                        <input type="text" id="email"  name="email" class="form-control" autocomplete="off" maxlength="40">
                                        <br>
                                    </div>    
                                    
<!--                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Applicant's Picture <span style="color:red">*</span> (Must be in WHITE background)</label>
                                        <input type="file" id="image_file"  name="image_file" class="form-control" autocomplete="off">
                                        <br>
                                    </div>    -->
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Postal Address <span style="color:red">*</span></label>
                                        <input type="text" id="postal"  name="postal" class="form-control" autocomplete="off" maxlength="80">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Permanent Address <span style="color:red">*</span></label>
                                        <input type="text" id="permanent"  name="permanent" class="form-control" autocomplete="off" maxlength="80" required="required">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Guardian's Name</label>
                                        <input type="text" name="guardian_name" id="guardian_name"  class="form-control" autocomplete="off" maxlength="40">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Guardian's CNIC  (00000-0000000-0)</label>
                                        <input type="text" name="guardian_cnic" id="guardian_cnic"  class="form-control nic" autocomplete="off">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Guardian's Mobile No. </label>
                                        <input type="text" name="guardian_mobile" id="guardian_mobile" class="form-control mphone" autocomplete="off">
                                        <br>
                                    </div>    
                                    
                                </div>
                                <hr style="border: 1px solid #208e4c;">
                                
                                <h1 class="section-heading text-highlight"><strong>Academic Information </strong></h1><br>
                                <div class="row">
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Degree <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('degree', $degree, '',  'class="form-control" id="" autocomplete="off" required="required"'); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Board/University <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('board_univ', $board_univ, '',  'class="form-control" id="board_univ" autocomplete="off" required="required"'); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Institute/School Name <span style="color:red">*</span></label>
                                        <input type="text" name="school" id="school" class="form-control" autocomplete="off"  maxlength="50">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Last attended school located in FATA? <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('fata', $hostelReq, '',  'class="form-control" id="fata" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Passing Year <span style="color:red">*</span></label>
                                        <select name="p_year" class="form-control" id="p_year" autocomplete="off">
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                        </select>
                                        <?php //echo form_dropdown('p_year', $passing_year, '',  'class="form-control" id="p_year" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Exam Passed <span style="color:red">*</span></label>
                                        <select class="form-control" name="exam" id="exam" autocomplete="off" >
                                            <option value="Annual">Annual</option>
                                            <option value="Supply">Supply</option>
                                        </select>
                                        <br>
                                    </div>    
                                    
                                    <input type="hidden" name="percentage_9th" id="percentage_9th" class="form-control" value="">
                                    <input type="hidden" name="total_marks_9th" id="total_marks_9th" class="form-control" value="">
                                    <input type="hidden" name="obt_marks_9th" id="obt_marks_9th" class="form-control" value="">
                                     
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Obtained Marks</label>
                                        <input type="text" id="obt_marks"  name="obt_marks" class="form-control" autocomplete="off" pattern="\d*" maxlength="4" required="required" placeholder="If marks are not available, specify reason">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Total Marks</label>
                                        <select id="total_marks"  name="total_marks" class="form-control" autocomplete="off">
                                            <option value="1100">1100</option>
                                            <option value="1050">1050</option>
                                            <option value="1200">1200</option>
                                            <option value="3350">3350</option>
                                        </select>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Percentage</label>
                                        <input type="text" id="percentage"  name="percentage" class="form-control" readonly="readonly" >
                                        <br>
                                    </div>
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Board Roll No.</label>
                                        <input type="text" id="board_roll"  name="board_roll" class="form-control" autocomplete="off" pattern="\d*" maxlength="20">
                                        <br>
                                    </div>    
                                     
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Board Registration No. / Enrollment No.</label>
                                        <input type="text" id="board_reg"  name="board_reg" class="form-control" autocomplete="off" maxlength="20">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">If marks not available, please state reason</label>
                                        <input type="text" id="acad_comments"  name="acad_comments" class="form-control" autocomplete="off"  maxlength="150">
                                        <br>
                                    </div>
                                   
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">LAT Test Marks <span style="color:#c00;">(Required for BS Law)</span></label>
                                        <input type="text" id="lat_marks"  name="lat_marks" class="form-control" autocomplete="off" pattern="\d*" maxlength="3">
                                        <br>
                                    </div>    
                                     
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">LAT Test Date <span style="color:#c00;">(Required for BS Law)</span></label>
                                        <input type="text" id="lat_date"  name="lat_date" class="form-control date" autocomplete="off" maxlength="10" placeholder="(DD-MM-YYYY)">
                                        <br>
                                    </div>    
                                     
                                </div>
                                <hr style="border: 1px solid #208e4c;">
                                 
                                <div class="row">
                                     <div class="col-md-12 form-group">
                                         <button type="submit" class="btn btn-lg btn-success" id="ApplicationSave" style="float:right"><strong>Add Student</strong></button>
                                        <!--<button type="button" class="btn btn-success" id="save_button">Apply for Admission</button>-->
                                        <br>
                                    </div> 
                                </div>
                                
                                <div class="modal fade" id="adding" role="dialog" style="z-index:9999">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Admission Form</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                                <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                                <p style="margin:0">&nbsp;</p>
                                                 
                                                <h4 style="text-align:center"><strong>Data once saved are not possible to edit or modify. <br>Are you sure to save the record?</strong></h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-lg btn-default" data-dismiss="modal" id="ApplicationSNo">No I want to review again</button>
                                                <button type="submit" class="btn btn-lg btn-success" id="ApplicationSave" ><strong>Yes save it.</strong></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </section>
                    
                    <div class="modal fade" id="validating" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong>Duplicate record not allowed in same program, please track your online application using Father CNIC</strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="marks_validation" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong>Please insert valid marks.</strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="image_validation" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong>Please select valid Image format. <br>(Only JPG, JPEG, BMP, PNG are allowed)</strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="image_size_validation" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong>Please select image having size less than 1MB.</strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="obtained_marks_validation" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong>Please insert HSSC obtained marks. <br>If marks are not available please state the reason.</strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="art_subject_validation" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong>Please select minimum 6 subjects including compulsory subjects.</strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="lat_marks_validation" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"> <strong>LAT Test marks are required for admission in BS Law. Please insert marks and test date.</strong> </h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="image_not_valid" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong>Invalid or unsupported picture format.</strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div><!--//cols-wrapper-->

        </div><!--//content-->
   
    <!--<script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script>-->
    <!--<script type="text/javascript" src="assets/plugins/jquery.mask.min.js"></script>-->
<script>
jQuery(document).ready(function(){
    
//    jQuery('#ApplicationSave').on('click',function(){
//        jQuery(this).hide();
//        jQuery('#ApplicationSNo').hide();
//    });
    
    
    
    $('#obt_marks').keypress(function (e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else
        {
        e.preventDefault();
        return false;
        }
    });
    
    
    $('#board_roll').keypress(function (e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else
        {
        e.preventDefault();
        return false;
        }
    });
    
    $('#lat_marks').keypress(function (e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else
        {
        e.preventDefault();
        return false;
        }
    });
    
    $('#lat_date').keypress(function (e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else
        {
        e.preventDefault();
        return false;
        }
    });
    
    
    jQuery("#obt_marks").on('change', function(){
        var obt = jQuery("#obt_marks").val();
        if(obt > 0 && obt < parseInt(jQuery('#total_marks').val())){
            var total = obt / jQuery('#total_marks').val() * 100;
            jQuery('#percentage').val(total.toFixed(2));
        } 
        else {
            jQuery('#marks_validation').modal('toggle');
//            jQuery('#marks_button').trigger('click');
            jQuery('#percentage').val('');
            jQuery('#obt_marks').val('');
        }
    });
    
    jQuery("#total_marks").on('change', function(){
        jQuery('#percentage').val('');
        jQuery('#obt_marks').val('');
    });
    
    
    $('.rs_seats').on('change', function() {
        if($('.rs_seats:checked').length > 2) {
            this.checked = false;
        }
     });

    jQuery(document).ready(function(){
        jQuery(function() {
            jQuery('.date').mask('99-99-9999');
            jQuery('.date_time').mask('9999-99-99 99:99:99');
            jQuery('.number').mask('9999999999');
            jQuery('.year').mask('9999');
            jQuery('.mphone').mask('9999-9999999');
            jQuery('.nic').mask('99999-9999999-9');
            jQuery('.reg').mask('SSS-999999999');
            
        });
    });
    
    jQuery(function() {
        jQuery('.datepicker').datepicker( {
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'

        });
    });
    
    
    $('#student_name').keyup(function (e) {
        
        var lengths = jQuery('#student_name').val().length;
        var student_name = jQuery('#student_name').val();
        var fieldPlaceHolder = 'Student Name';
         
          jQuery.ajax({
                type   :'post',
                url    :'SiteController/check_textbox_details',
                data   :{'check_text':student_name,'fieldPlaceHolder':fieldPlaceHolder},
                success :function(result){
                    
                    if(result != ''){
                        jQuery('#student_name').val('');
                        return false;
                    }
             
               }
            });
    });
    
    $('#father_name').keyup(function (e) {
        var lengths = jQuery('#father_name').val().length;
        var student_name = jQuery('#father_name').val();
        var fieldPlaceHolder = 'Father Name';
         
          jQuery.ajax({
                type   :'post',
                url    :'SiteController/check_textbox_details',
                data   :{'check_text':student_name,'fieldPlaceHolder':fieldPlaceHolder},
                success :function(result){
                    
                    if(result != ''){
                        jQuery('#father_name').val('');
                        return false;
                    }
                
               }
            });
        
        
//        var regex = new RegExp("^[A-Za-z -]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        else
//        {
//        e.preventDefault();
//        return false;
//        }
    });
    
    $('#guardian_name').keyup(function (e) {
            
            var lengths = jQuery('#guardian_name').val().length;
            var student_name = jQuery('#guardian_name').val();
            var fieldPlaceHolder = 'Guardian Name';

              jQuery.ajax({
                    type   :'post',
                    url    :'SiteController/check_textbox_details',
                    data   :{'check_text':student_name,'fieldPlaceHolder':fieldPlaceHolder},
                    success :function(result){

                        if(result != ''){
                            jQuery('#guardian_name').val('');
                            return false;
                        }

                   }
                });
            
//        var regex = new RegExp("^[A-Za-z -]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        else
//        {
//        e.preventDefault();
//        return false;
//        }
    });

    $('#landline').keypress(function (e) {
        var regex = new RegExp("^[0-9-]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else
        {
        e.preventDefault();
        return false;
        }
    });
    
    jQuery('#programe_id').on('change',function(){
            var programId = jQuery('#programe_id').val();
            //get sub program
            jQuery.ajax({
                type   :'post',
                url    :'OnlineController/getSubProgram',
                data   :{'programId':programId},
                success :function(result){
                    jQuery('#sub_pro_id').html(result);
                },
                complete:function(){
                    var programId = jQuery('#programe_id').val();
                    //Get Batch 
                    jQuery.ajax({
                        type   :'post',
                        url    :'OnlineController/getBatchId',
                        data   :{'programId':programId},
                        success :function(result){
                           console.log(result);
                          jQuery('#batch').val(result);
                       }
                    });    
                }
            });
        });
    
    
    $('html').bind('keypress', function(e)
        {
           if(e.keyCode == 13)
           {
              return false;
           }
        });

 });
 
 
</script>