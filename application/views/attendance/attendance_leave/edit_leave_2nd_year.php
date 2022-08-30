<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Edit Student Leave</h1>
            <div class="breadcrumbs pull-right">
                <ul class="breadcrumbs-list">
                <li class="breadcrumbs-label">You are here:</li>
                <li> <?php echo anchor('admin/admin_home', 'Home');?> <i class="fa fa-angle-right"></i></li>
                <li class="current">Edit Student Leave</li>
                </ul>
            </div>
            <!--//breadcrumbs-->
        </header> 
        <?php if($result_set): ?>
        <div class="page-content">
            <div class="row">

                <div class="col-md-12">
                    <?php
                    $st_res = $this->AttendanceModel->get_single_std_disc(array('student_record.student_id' => $this->input->post('stdId')));
                    echo '<table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Image</th>
                                <th>College #</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Program</th>
                                <th>Section</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>';
                                    if(!empty($result_set->applicant_image)):
                                        echo '<img src="assets/images/students/'.$result_set->applicant_image.'" style=" height: 100px;  margin-left: 24px;">';
                                    else:
                                        echo '<img src="assets/images/students/user.png" style=" height: 100px;  margin-left: 24px;">';
                                    endif;
                                echo '</td>
                                <td>'.$result_set->college_no.'</td>
                                <td>'.$result_set->student_name.'</td>
                                <td>'.$result_set->father_name.'</td>
                                <td>'.$result_set->sub_program.'</td>
                                <td>'.$result_set->std_section.'</td>
                                <td>'.$result_set->student_status.'</td>
                            </tr>
                        </tbody>
                    </table>';
                    ?>
                </div>
                    
                
                <div class="col-md-12" id="attachment_result"></div>
                
                <form method="post" action="AttendanceController/update_leave_1st_year">
                    <div class="form-group col-md-3">
                        <label>Application No.</label>
                        <input type="text" name="app_no" class="form-control" placeholder="Application No." value="<?php echo $result_set->salr_application_id ?>">
                        <input type="hidden" name="leave_id" id="leave_id" value="<?php echo $result_set->salr_id ?>">
                        <input type="hidden" name="student_id" id="student_id" value="<?php echo $result_set->salr_student_id ?>">
                        <!--<input type="hidden" name="pro_form_code" id="pro_form_code" >-->
                    </div>
                    <div class="form-group col-md-3">
                        <label>Application Date</label>
                        <input type="text" name="app_date" value="<?php echo date('d-m-Y', strtotime($result_set->salr_application_date));?>" class="form-control date_format_d_m_yy" readonly="readonly">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Leave From Date</label>
                        <input type="text" name="from_date" value="<?php echo date('d-m-Y',strtotime($result_set->salr_leave_from_date));?>" class="form-control date_format_d_m_yy_l" readonly="readonly">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Leave to Date</label>
                        <input type="text" name="to_date" value="<?php echo date('d-m-Y',strtotime($result_set->salr_leave_to_date));?>" class="form-control date_format_d_m_yy_l" readonly="readonly">
                    </div>
                    <div class="form-group col-md-9">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control" placeholder="Remarks" required="required" value="<?php echo $result_set->salr_remarks ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <input style="margin-top:23px" type="submit" name="submit" class="btn-theme btn" value="Update Record">
                        <a href="AttendanceController/leave_record_first_year"><button style="margin-top:23px" class="btn btn-default">Cancel</button></a>
                    </div>        
                </form>
                
                <?php
                $error_message = $this->session->flashdata('err_msg');
                if($error_message):
                    echo '<div class="col-md-12"><h3 style="color:#e00;" align="center">'.$error_message.'</h3></div>';
                endif;
                ?>
                
            </div>
            <!--//page-row-->
        </div>
        <!--//page-content-->
        <?php endif; ?>
    </div>
    <!--//page-wrapper--> 
</div>
<!--//content-->
<script>
    $(document).ready(function(){
        $(function() {
            $( ".date_format_d_m_yy_l").datepicker({
                maxDate: -1,
                dateFormat: 'dd-mm-yy'
            });
        });
     });
</script>
