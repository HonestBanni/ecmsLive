<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Edit Student Fine</h1>
            <div class="breadcrumbs pull-right">
                <ul class="breadcrumbs-list">
                <li class="breadcrumbs-label">You are here:</li>
                <li> <?php echo anchor('admin/admin_home', 'Home');?> <i class="fa fa-angle-right"></i></li>
                <li class="current">Edit Student Fine</li>
                </ul>
            </div>
            <!--//breadcrumbs-->
        </header> 
        <?php //echo '<pre>'; print_r($fine_info); die; ?>
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <?php
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
                                    if(!empty($fine_info->applicant_image)):
                                        echo '<img src="assets/images/students/'.$fine_info->applicant_image.'" style=" height: 100px;  margin-left: 24px;">';
                                    else:
                                        echo '<img src="assets/images/students/user.png" style=" height: 100px;  margin-left: 24px;">';
                                    endif;
                                echo '</td>
                                <td>'.$fine_info->college_no.'</td>
                                <td>'.$fine_info->student_name.'<br>'.$fine_info->applicant_mob_no1.'</td>
                                <td>'.$fine_info->father_name.'<br>'.$fine_info->mobile_no.'</td>
                                <td>'.$fine_info->sub_program.'</td>
                                <td>'.$fine_info->std_section.'</td>
                                <td>'.$fine_info->std_status.'</td>
                            </tr>
                        </tbody>
                    </table>';
                    ?>
                </div>
                    
                <form action="AttendanceController/add_disc_attachments_in_edit" id="attachment_form" method="POST" role="form">
                    <div class="form-group col-md-4">
                        <label>Upload Attachments</label>
                        <input type="file" id="large_file" name="large_file" class="form-control" accept=".jpg,.jpeg,.png,.bmp">
                        <input type="hidden" name="pfa_fine" id="pfa_fine" value="<?php echo $fine_info->proc_id; ?>" >
                    </div>
                    <div class="form-group col-md-2">
                        <label style="visibility: hidden">Upload Attachments</label>
                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-30" id="update_bnr_button">Add Images</button>
                    </div>
                </form>
                
                <div class="col-md-12" id="attachment_result"></div>
                
                <form action="AttendanceController/update_disc_action" id="update_form" method="POST" role="form">
                    <div class="form-group col-md-3">
                        <label>Fine Type</label>
                        <input type="text" name="proc_type_id" class="form-control" value="<?php echo $fine_info->proc_type_title; ?>" readonly="readonly">
                        <input type="hidden" name="fine_id" id="fine_id" value="<?php echo $fine_info->proc_id; ?>" >
                    </div>
                    <div class="form-group col-md-3">
                        <label>Date</label>
                        <input type="text" name="date" value="<?php echo date('d-m-Y', strtotime($fine_info->date));?>" class="form-control date_format_d_m_yy" readonly="readonly">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" value="<?php echo $fine_info->amount; ?>" readonly="readonly">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Recovered Assets</label>
                        <input type="text" name="recover_assets" class="form-control" value="<?php echo $fine_info->recover_assets; ?>"" readonly="readonly">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control" value="<?php echo $fine_info->remarks; ?>" readonly="readonly">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="name">Action Taken:</label>
                        <textarea type="text" class="form-control notes" maxlength="250" rows="2" name="action_taken" id="action_taken" style="resize: none;" readonly="readonly"><?php echo $fine_info->action_taken; ?></textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="name">White Card Remarks:</label>
                        <textarea type="text" class="form-control notes" maxlength="250" rows="3" name="wc_remarks" id="wc_remarks" style="resize: none;"><?php echo $fine_info->other_remarks; ?></textarea>
                    </div>
                    <div class="form-group col-md-2 pull-right">
                        <input style="margin-top:23px" type="submit" name="submit" class="btn-theme btn" value="Save Record">
                    </div>        
                </form>
            </div>
            <!--//page-row-->
        </div>
        <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
</div>
<!--//content-->
<script>
    jQuery(document).ready(function(){
        var fineId = $('#fine_id').val();
        $.ajax({
            url : 'AttendanceController/get_edit_disc_attachments',
            type : 'post',
            data : {'fineId' : fineId},
            success : function(response){      
                $('#attachment_result').html(response);
            }
        });
        $("#attachment_form").submit(function(e){
            e.preventDefault();
            var formData = new FormData($("#attachment_form")[0]);
            $.ajax({
                url   : $("#attachment_form").attr('action'),
                type  : 'POST',
                data  : formData,
                contentType : false,
                processData : false,
                success: function(resp) {
                    var formCode = $('#form_Code').val();
                    console.log(resp);
                    $.ajax({
                        url : 'AttendanceController/get_edit_disc_attachments',
                        type : 'post',
                        data : {'fineId' : fineId},
                        success : function(response){      
                            $('#attachment_result').html(response);
                            $('#large_file').val('');
                        }
                    });
                }
            });
        });
    
     });
</script>