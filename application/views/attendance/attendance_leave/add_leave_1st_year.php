<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Add Student Leave</h1>
            <div class="breadcrumbs pull-right">
                <ul class="breadcrumbs-list">
                <li class="breadcrumbs-label">You are here:</li>
                <li> <?php echo anchor('admin/admin_home', 'Home');?> <i class="fa fa-angle-right"></i></li>
                <li class="current">Add Student Leave</li>
                </ul>
            </div>
            <!--//breadcrumbs-->
        </header> 
        
        <div class="page-content">
            <div class="row">
                <div class="form-group col-md-3">
                    <label>College #</label>
                    <input type="text" name="student_name" class="form-control" placeholder="College #" id="student_name_leave">
                </div>
                
                <div class="col-md-12" id="student_div_leave"></div>
                    
<!--                <form action="AttendanceController/add_disc_attachments" id="attachment_form" method="POST" role="form">
                    <div class="form-group col-md-4">
                        <label>Upload Attachments</label>
                        <input type="file" id="large_file" name="large_file" class="form-control" accept=".jpg,.jpeg,.png,.bmp">
                        <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label style="visibility: hidden">Upload Attachments</label>
                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-30" id="update_bnr_button">Add Images</button>
                    </div>
                </form>-->
                
                <div class="col-md-12" id="attachment_result"></div>
                
                <form method="post">
                    <div class="form-group col-md-3">
                        <label>Application No.</label>
                        <input type="text" name="app_no" class="form-control" placeholder="Application No.">
                        <input type="hidden" name="student_id" id="student_id" >
                        <input type="hidden" name="pro_form_code" id="pro_form_code" >
                    </div>
                    <div class="form-group col-md-3">
                        <label>Application Date</label>
                        <input type="text" name="app_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy" readonly="readonly">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Leave From Date</label>
                        <input type="text" name="from_date" value="<?php echo date('d-m-Y',strtotime("-1 days"));?>" class="form-control date_format_d_m_yy_l" readonly="readonly">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Leave to Date</label>
                        <input type="text" name="to_date" value="<?php echo date('d-m-Y',strtotime("-1 days"));?>" class="form-control date_format_d_m_yy_l" readonly="readonly">
                    </div>
                    <div class="form-group col-md-9">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control" placeholder="Remarks" required="required">
                    </div>
                    <div class="form-group col-md-2">
                        <input style="margin-top:23px" type="submit" name="submit" class="btn-theme btn" value="Save Record">
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
    </div>
    <!--//page-wrapper--> 
</div>
<!--//content-->
<script>
    $(document).ready(function(){
        $("#student_name_leave").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_student_leave_1st_year/"+$("#student_name_leave").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            $("#student_name_leave").val(ui.item.contactPerson);
            $("#student_id").val(ui.item.id);
            $("#college_no").val(ui.item.college_no);
            var std_id = $('#student_id').val();
            $.ajax({
                type    : 'post',
                url     : 'AttendanceController/get_student_record_leave',
                data    : { 'stdId' : std_id },
                success : function(rslt){
                    $('#student_div_leave').html(rslt);
                    $('#pro_form_code').val($('#form_Code').val());
                }
            });
        }
        }).focus(function() {  $(this).autocomplete("search", "");  });
        
        jQuery(function() {
            jQuery( ".date_format_d_m_yy_l").datepicker({
                maxDate: -1,
                dateFormat: 'dd-mm-yy'
            });
        });
        
//        $("#attachment_form").submit(function(e){
//            e.preventDefault();
//            var formData = new FormData($("#attachment_form")[0]);
//            $.ajax({
//                url   : $("#attachment_form").attr('action'),
//                type  : 'POST',
//                data  : formData,
//                contentType : false,
//                processData : false,
//                success: function(resp) {
//                    var formCode = $('#form_Code').val();
//                    console.log(resp);
//                    $.ajax({
//                        url : 'AttendanceController/get_disc_attachments',
//                        type : 'post',
//                        data : {'formCode' : formCode},
//                        success : function(response){      
//                            $('#attachment_result').html(response);
//                            $('#large_file').val('');
//                        }
//                    });
//                }
//            });
//        });
    
     });
</script>