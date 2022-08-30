<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Add Student Fine</h1>
            <div class="breadcrumbs pull-right">
                <ul class="breadcrumbs-list">
                <li class="breadcrumbs-label">You are here:</li>
                <li> <?php echo anchor('admin/admin_home', 'Home');?> <i class="fa fa-angle-right"></i></li>
                <li class="current">Add Student Fine</li>
                </ul>
            </div>
            <!--//breadcrumbs-->
        </header> 
        
        <div class="page-content">
            <div class="row">
                <div class="form-group col-md-3">
                    <label>College #</label>
                    <input type="text" name="student_name" class="form-control" placeholder="College #" id="student_name_disc">
                </div>

                <div class="col-md-12" id="student_div_disc"></div>
                    
                <form action="AttendanceController/add_disc_attachments" id="attachment_form" method="POST" role="form">
                    <div class="form-group col-md-4">
                        <label>Upload Attachments</label>
                        <input type="file" id="large_file" name="large_file" class="form-control" accept=".jpg,.jpeg,.png,.bmp">
                        <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label style="visibility: hidden">Upload Attachments</label>
                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-30" id="update_bnr_button">Add Images</button>
                    </div>
                </form>
                
                <div class="col-md-12" id="attachment_result"></div>
                
                <form method="post">
                    <div class="form-group col-md-3">
                        <label>Fine Type</label>
                        <?php  echo form_dropdown('proc_type_id', $fine_type, '', 'class="form-control" id="proc_type_id" required="required"');  ?>
                        <input type="hidden" name="student_id" id="student_id" >
                        <input type="hidden" name="pro_form_code" id="pro_form_code" >
                    </div>
                    <div class="form-group col-md-3">
                        <label>Date</label>
                        <input type="text" name="date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Fine Amount</label>
                        <input type="number" name="amount" class="form-control" placeholder="Fine Amount" required="required">
                    </div>
<!--                    <div class="form-group col-md-3">
                        <label>Fine By Proctor</label>
                        <input type="text" name="proctor_id" class="form-control" placeholder="Proctor Name" id="proctor_record">
                        <input type="hidden" name="proctor_id" id="proctor_id">
                    </div>-->
                    <div class="form-group col-md-6">
                        <label>Recovered Assets</label>
                        <input type="text" name="recover_assets" class="form-control" placeholder="Recovered Assets">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control" placeholder="Remarks" required="required">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="name">Action Taken <strong style="color:#f00;">*</strong></label>
                        <textarea type="text" class="form-control notes" maxlength="250" rows="3" name="action_taken" id="action_taken" style="resize: none;" required="required"></textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="name">White Card Remarks:</label>
                        <textarea type="text" class="form-control notes" maxlength="250" rows="3" name="wc_remarks" id="wc_remarks" style="resize: none;"></textarea>
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
        jQuery("#student_name_disc").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_student_record_get/"+$("#student_name_disc").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#student_name_disc").val(ui.item.contactPerson);
            jQuery("#student_id").val(ui.item.id);
            jQuery("#college_no").val(ui.item.college_no);
            var std_id = jQuery('#student_id').val();
            jQuery.ajax({
                type    : 'post',
                url     : 'AttendanceController/get_student_record_disc',
                data    : { 'stdId' : std_id },
                success : function(rslt){
                    jQuery('#student_div_disc').html(rslt);
                    jQuery('#pro_form_code').val($('#form_Code').val());
                }
            });
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
        
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
                        url : 'AttendanceController/get_disc_attachments',
                        type : 'post',
                        data : {'formCode' : formCode},
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