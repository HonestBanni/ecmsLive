
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
                    <?php //echo '<pre>'; print_r($st_data); die; ?>
                    <section class="course-finder">
                    <h1 class="section-heading text-highlight"><strong><span class="line">ADMISSION FORM</span></strong></h1>
                        
                        <div class="section-content">
                            <form class="course-finder-form" action="UpdateApplicantRecord" id="saveAppForm" name="saveAppForm" method="post" enctype="multipart/form-data" >
                                <div class="row">
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Program <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('programe_id', $program, $st_data->programe_id,  'class="form-control" id="programe_id" autocomplete="off" '); ?>
                                        <input type="hidden" name="std_id" id="std_id" class="form-control" value="<?php echo $st_data->student_id; ?>">
                                        
                                        <br>
                                    </div>
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Sub Program <span style="color:red">*</span></label>
                                        
                                         <?php echo form_dropdown('sub_pro_id', $sub_program, $st_data->sub_pro_id,  'class="form-control" id="sub_pro_id" autocomplete="off" '); ?>
                                        <br>
                                    </div>
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Comments (If Any)</label>
                                        <?php $batch_titie = $this->CRUDModel->get_where_row('prospectus_batch', array('batch_id'=>$st_data->batch_id)); ?>
                                        <input type="text" name="batchName" id="batchName" class="form-control" value="<?php echo $batch_titie->batch_name; ?>">
                                        <input type="hidden" name="batch" id="batch" class="form-control" value="<?php echo $batch_titie->batch_id; ?>">
                                        <input type="hidden" name="comments" id="comments" class="form-control" autocomplete="off" maxlength="150" value="<?php echo $st_data->comment; ?>">
                                        <br>
                                    </div>
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">College No</label>
                                        <input type="text" id="student_name"  name="college_no" class="form-control" autocomplete="off" maxlength="40" value="<?php echo $st_data->college_no; ?>" readonly="readonly">
                                        <br>
                                    </div> 
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Form No</label>
                                        <input type="text" id="student_name"  name="college_no" class="form-control" autocomplete="off" maxlength="40" value="<?php echo $st_data->form_no;?>" readonly="readonly">
                                        <br>
                                    </div> 
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Student Current Status</label>
                                        <input type="text" id="student_name"  name="college_no" class="form-control" autocomplete="off" maxlength="40" value="<?php echo $st_data->curr_status;?>" readonly="readonly">
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
                                        foreach($reserved_seat as $rsRow): 
                                            if($rsRow->rseat_id == $st_data->rseats_id1 || $rsRow->rseat_id == $st_data->rseats_id3):
                                                echo '<div class="form-group col-md-3">
                                                    <input type="checkbox" name="rs_seats[]" value="'.$rsRow->rseat_id.'" id="rs_seats" class="rs_seats" autocomplete="off" checked>&nbsp;&nbsp;
                                                    <span><strong>'.$rsRow->name.'</strong></span>
                                                </div>';
                                            else:
                                                echo '<div class="form-group col-md-3">
                                                    <input type="checkbox" name="rs_seats[]" value="'.$rsRow->rseat_id.'" id="rs_seats" class="rs_seats" autocomplete="off" >&nbsp;&nbsp;
                                                    <span><strong>'.$rsRow->name.'</strong></span>
                                                </div>';
                                            endif;
                                        ?>
                                    
                                        <?php endforeach;
                                    endif;
                                    ?>
                                    
                                </div>
                                <hr style="border: 1px solid #208e4c;">
                                
                                <h1 class="section-heading text-highlight"><strong>Applicant Information </strong></h1><br>
                                <div class="row">
                                    
                                      
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Applicant Name <span style="color:red">*</span> (As in SSC DMC)</label>
                                        <input type="text" id="student_name"  name="student_name" class="form-control" autocomplete="off" maxlength="40" value="<?php echo $st_data->student_name; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Applicant Mobile No. <span style="color:red">*</span></label>
                                        <input type="text" id="student_mobile"  name="student_mobile" class="form-control mphone" autocomplete="off" value="<?php echo $st_data->applicant_mob_no1; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Mobile Network <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('student_network', $mobile_network, $st_data->std_mobile_network,  'class="form-control" id="student_network" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Applicant CNIC (00000-0000000-0)</label>
                                        <input type="text" id="student_cnic"  name="student_cnic" class="form-control nic"  autocomplete="off" value="<?php echo $st_data->student_cnic; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Gender <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('gender', $gender, $st_data->gender_id,  'class="form-control" id="gender" autocomplete="off" '); ?>
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
                                                <select class="form-control" name="dob_day" id="dob_day" autocomplete="off" >
                                                    <option value="<?php echo date('d', strtotime($st_data->dob)); ?>"><?php echo date('d', strtotime($st_data->dob)); ?></option>
                                                    <?php
                                                    for($d=1; $d<32; $d++):
                                                        if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                        echo '<option value="'.$v.'">'.$d.'</option>';
                                                    endfor;
                                                    
                                                    ?>
                                                </select>
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group" autocomplete="off" >
                                                <select class="form-control" name="dob_month" id="dob_month">
                                                    <option value="<?php echo date('m', strtotime($st_data->dob)); ?>">
                                                        <?php
                                                        switch (date('m', strtotime($st_data->dob))):
                                                            case "01": echo "January"; break;
                                                            case "02": echo "February"; break;
                                                            case "03": echo "March"; break;
                                                            case "04": echo "April"; break;
                                                            case "05": echo "May"; break;
                                                            case "06": echo "June"; break;
                                                            case "07": echo "July"; break;
                                                            case "08": echo "August"; break;
                                                            case "09": echo "September"; break;
                                                            case "10": echo "October"; break;
                                                            case "11": echo "November"; break;
                                                            case "12": echo "December"; break;
                                                        endswitch;
                                                        ?>
                                                    </option>
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
                                                <select class="form-control" name="dob_year" id="dob_year" autocomplete="off" >
                                                    <option value="<?php echo date('Y', strtotime($st_data->dob)); ?>"><?php echo date('Y', strtotime($st_data->dob)); ?></option>
                                                    <?php
                                                    for($y=1990; $y<=date('Y')-10; $y++):
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
                                        <?php echo form_dropdown('bld_group', $bgroup, $st_data->bg_id,  'class="form-control" id="bld_group" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Domicile <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('domicile', $domicile, $st_data->domicile_id,  'class="form-control" id="domicile" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">District <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('district', $district, $st_data->district_id,  'class="form-control" id="district" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Religion <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('religion', $religion, $st_data->religion_id,  'class="form-control" id="religion" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Hostel Required <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('hostel', $hostelReq, $st_data->hostel_required,  'class="form-control" id="hostel" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                </div>
                                <hr style="border: 1px solid #208e4c;">
                                
                                <h1 class="section-heading text-highlight"><strong>Father/Guardian Information </strong></h1><br>
                                <div class="row">
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Name <span style="color:red">*</span></label>
                                        <input type="text" id="father_name"  name="father_name" class="form-control"  autocomplete="off" maxlength="40" value="<?php echo $st_data->father_name; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father / Guardian CNIC <span style="color:red">*</span> (00000-0000000-0)</label>
                                        <input type="text" id="father_cnic"  name="father_cnic" class="form-control nic"  autocomplete="off" value="<?php echo $st_data->father_cnic; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Landline No.</label>
                                        <input type="text" id="landline"  name="landline" class="form-control" autocomplete="off" maxlength="15" value="<?php echo $st_data->land_line_no; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Mobile No. <span style="color:red">*</span></label>
                                        <input type="text" id="father_mobile"  name="father_mobile" class="form-control mphone" autocomplete="off" value="<?php echo $st_data->mobile_no; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Mobile Network <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('father_network', $mobile_network, $st_data->net_id,  'class="form-control" id="father_network" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Occupation <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('occupation', $father_occ, $st_data->occ_id,  'class="form-control" id="occupation" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Annual Income <span style="color:red">*</span></label>
                                        <input type="text" id="income"  name="income" class="form-control number" autocomplete="off" value="<?php echo $st_data->annual_income; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Father's Email</label>
                                        <input type="email" id="email"  name="email" class="form-control" autocomplete="off" maxlength="40" value="<?php echo $st_data->father_email; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Postal Address <span style="color:red">*</span></label>
                                        <input type="text" id="postal"  name="postal" class="form-control" autocomplete="off" maxlength="80" value="<?php echo $st_data->app_postal_address; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Permanent Address <span style="color:red">*</span></label>
                                        <input type="text" id="permanent"  name="permanent" class="form-control" autocomplete="off" maxlength="80" value="<?php echo $st_data->parmanent_address; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Guardian's Name</label>
                                        <input type="text" name="guardian_name" id="guardian_name"  class="form-control" autocomplete="off" maxlength="40" value="<?php echo $st_data->guardian_name; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Guardian's CNIC  (00000-0000000-0)</label>
                                        <input type="text" name="guardian_cnic" id="guardian_cnic"  class="form-control nic" autocomplete="off" value="<?php echo $st_data->guardian_cnic; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Guardian's Mobile No. </label>
                                        <input type="text" name="guardian_mobile" id="guardian_mobile" class="form-control mphone" autocomplete="off" value="<?php echo $st_data->g_mobile_no; ?>">
                                        <br>
                                    </div>    
                                    
                                </div>
                                <hr style="border: 1px solid #208e4c;">
                                <?php foreach($st_acad_data as $acad_row): ?>
                                <h1 class="section-heading text-highlight"><strong>Academic Information </strong></h1><br>
                                <div class="row">
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Degree <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('degree', $degree, $acad_row->aed_degree,  'class="form-control" id="degree" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Board/University <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('board_univ', $board_univ, $acad_row->board_id,  'class="form-control" id="board_univ" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Institute/School Name <span style="color:red">*</span></label>
                                        <input type="text" name="school" id="school" class="form-control" autocomplete="off"  maxlength="50" value="<?php echo $acad_row->inst_id; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Last attended school located in FATA? <span style="color:red">*</span></label>
                                        <?php echo form_dropdown('fata', $hostelReq, $st_data->fata_school,  'class="form-control" id="fata" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Passing Year <span style="color:red">*</span></label>
                                        <select name="p_year" class="form-control" id="p_year" autocomplete="off">
                                            <option value="2020">2020</option>
                                        </select>
                                        <?php //echo form_dropdown('p_year', $passing_year, '',  'class="form-control" id="p_year" autocomplete="off" '); ?>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Exam Passed <span style="color:red">*</span></label>
                                        <select class="form-control" name="exam" id="exam" autocomplete="off" >
                                            <?php echo '<option value="'.$acad_row->exam_type.'">'.$acad_row->exam_type.'</option>'; ?>
                                            <option value="Annual">Annual</option>
                                            <option value="Supply">Supply</option>
                                        </select>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Obtained Marks in 9th Class</label>
                                        <input type="text" id="obt_marks_9th"  name="obt_marks_9th" class="form-control" autocomplete="off" pattern="\d*" maxlength="4" value="<?php echo $acad_row->obtained_marks_9th; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Total Marks in 9th Class</label>
                                        <select id="total_marks_9th"  name="total_marks_9th" class="form-control" autocomplete="off" >
                                            <?php echo '<option value="'.$acad_row->total_marks_9th.'">'.$acad_row->total_marks_9th.'</option>'; ?>
                                            <option value="510">510</option>
                                            <option value="500">500</option>
                                            <option value="520">520</option>
                                            <option value="525">525</option>
                                            <option value="550">550</option>
                                            <option value="495">495</option>
                                            <option value="505">505</option>
                                        </select>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Percentage in 9th Class</label>
                                        <input type="text" id="percentage_9th"  name="percentage_9th" class="form-control" readonly="readonly" value="<?php echo $acad_row->percentage_9th; ?>">
                                        <br>
                                    </div>
                                     
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Obtained Marks in DMC</label>
                                        <input type="text" id="obt_marks"  name="obt_marks" class="form-control" autocomplete="off" pattern="\d*" maxlength="4" value="<?php echo $acad_row->obtained_marks; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Total Marks in DMC</label>
                                        <select id="total_marks"  name="total_marks" class="form-control" autocomplete="off">
                                             
                                            <option value="1100" <?php if($acad_row->total_marks == '1100'): echo 'selected'; endif; ?>>1100</option>
                                            <option value="1050" <?php if($acad_row->total_marks == '1050'): echo 'selected'; endif; ?>>1050</option>
                                            <option value="850" <?php if($acad_row->total_marks == '850'): echo 'selected'; endif; ?>>850</option>
                                         
                                        </select>
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Percentage</label>
                                        <input type="text" id="percentage"  name="percentage" class="form-control" readonly="readonly" value="<?php echo $acad_row->percentage; ?>" >
                                        <br>
                                    </div>
                                     
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Board Roll No. <span style="color:red">*</span></label>
                                        <input type="text" id="board_roll"  name="board_roll" class="form-control" autocomplete="off" pattern="\d*" maxlength="20" value="<?php echo $acad_row->rollno; ?>">
                                        <br>
                                    </div>    
                                     
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Board Registration No. <span style="color:red">*</span></label>
                                        <input type="text" id="board_reg"  name="board_reg" class="form-control" autocomplete="off" maxlength="20" value="<?php echo $acad_row->board_reg_no; ?>">
                                        <br>
                                    </div>    
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">If marks not available, please state reason</label>
                                        <input type="text" id="acad_comments"  name="acad_comments" class="form-control" autocomplete="off"  maxlength="150" value="<?php echo $acad_row->academic_comments; ?>">
                                        <br>
                                    </div>
                                  
                                </div>
                                
                                 <?php endforeach; ?>
                                <div class="row">
                                     <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn-success" id="save_button">Update</button>
                                        <br>
                                    </div> 
                                    
                                </div>
                                
                                <hr style="border: 1px solid #208e4c;">
                                <div class="row">
                                     <div class="col-md-12">
                                        <?php
                                        $docs_data = $this->CRUDModel->get_where_result('student_documents', array('sd_student_id'=>$st_data->student_id));
                                        if($docs_data):
                                            echo '<table class="table table-hover">
                                                <tr>
                                                    <th>Document Image</th>
                                                    <th>Document Type</th>
                                                    <th>Uploaded Image Name</th>
                                                    <th>Upload Date Time</th>
                                                    <th>Delete</th>
                                                </tr>';
                                                foreach($docs_data as $i):
                                                    if($i->sd_flag == 1):
                                                        $type = 'Prospectus Challan';
                                                    else:
                                                        $type = 'Latest SSC DMC';
                                                    endif;
                                                echo '<tr>
                                                    <td><img src="assets/images/applicant_docs/'.$i->sd_image.'" style="max-width: 100px; max-height: 150px;"></td>
                                                    <td>'.$type.'</td>
                                                    <td>'.$i->sd_image.'</td>
                                                    <td>'.date('d-m-Y h:i:s a', strtotime($i->sd_datetime)).'</td>
                                                    <td><button class="btn- btn-sm btn-danger delete_doc" id="'.$i->sd_id.'">Delete</button></td>
                                                </tr>';
                                                endforeach;
                                            echo '</table>';
                                        endif;
                                        ?>
                                    </div>
                                    
                                </div>
                                
                            </form>
                        </div>
                    </section>
                    
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
                    
                    <div class="modal fade" id="obtained_marks_validation" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;"><i class="fa fa-exclamation-triangle"></i></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong>WARNING</strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong>Please insert obtained marks. <br>If marks are not available please state the reason.</strong></h4>
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
        
<script>
jQuery(document).ready(function(){
    
    var subProId    = jQuery('#sub_pro_id').val();
        var stdId       = jQuery('#std_id').val();
//        alert(subProId);
        if(subProId == 5){
            jQuery.ajax({
                type   :'post',
                url    :'OnlineController/getCheckSubjects',
                data   :{'subId':subProId, 'stdId':stdId},
                success :function(result){
                   jQuery('#artsubjectlist').show();
                   jQuery('#artsubjectlist').html(result);
               }
            });
        }
        else{
            jQuery('#artsubjectlist').hide();
        }
    
    
    
    jQuery("#obt_marks_9th").on('change', function(){
        var obt = jQuery("#obt_marks_9th").val();
        if(obt > 0 && obt < parseInt(jQuery('#total_marks_9th').val())){
            var total = obt / jQuery('#total_marks_9th').val() * 100;
            jQuery('#percentage_9th').val(total.toFixed(2));
        } 
        else {
            jQuery('#marks_validation').modal('toggle');
//            jQuery('#marks_button').trigger('click');
            jQuery('#percentage').val('');
            jQuery('#obt_marks').val('');
        }
    });
    
    jQuery("#total_marks_9th").on('change', function(){
         var obt = jQuery("#obt_marks_9th").val();
        if(obt > 0 && obt < parseInt(jQuery('#total_marks_9th').val())){
            var total = obt / jQuery('#total_marks_9th').val() * 100;
            jQuery('#percentage_9th').val(total.toFixed(2));
            jQuery('obt_marks').val();
        } 
        else {
            jQuery('#marks_validation').modal('toggle');
//            jQuery('#marks_button').trigger('click');
            jQuery('#percentage').val('');
            jQuery('#obt_marks').val('');
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
    
    jQuery('#sub_pro_id').on('change',function(){
        var subProId    = jQuery('#sub_pro_id').val();
        var stdId       = jQuery('#std_id').val();
//        alert(subProId);
        if(subProId == 5){
            jQuery.ajax({
                type   :'post',
                url    :'OnlineController/getCheckSubjects',
                data   :{'subId':subProId, 'stdId':stdId},
                success :function(result){
                   jQuery('#artsubjectlist').show();
                   jQuery('#artsubjectlist').html(result);
               }
            });
        }
        else{
            jQuery('#artsubjectlist').hide();
        }
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
                    jQuery.ajax({
                        type   :'post',
                        url    :'OnlineController/getBatchName',
                        data   :{'programId':programId},
                        success :function(result){
                           console.log(result);
                          jQuery('#batchName').val(result);
                       }
                    });    
                }
            });
        });
    
        jQuery('.delete_doc').on('click',function(){
            var doc_id = jQuery(this).attr('id');
            jQuery.ajax({
                type   :'post',
                url    :'DashboardController/delete_documents',
                data   :{'doc_id': doc_id},
                success :function(result){
                    location.reload();
                }
            });
        });
    });
 
 
</script>