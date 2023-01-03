<!-- ******CONTENT****** --> 
<div class="content container">
    <?php if($ms_detail): ?>
    <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
            <section class="course-finder" style="background-color: #fff; border: 1px solid #eee; padding-top: 15px;">
                <div class="section-content" >
                    <div class="row">
                        <?php
                        $cm = $this->CRUDModel->money_convert($ms_detail->msr_cost);
                        echo '<div class="col-md-12">
                            <table class="table" style="font-size: 15px;">
                                <tr>
                                    <th width="15%">Process No.</th>
                                    <td width="35%">'.$ms_detail->msr_id.'</td>
                                    <th width="15%">Date</th>
                                    <td width="35%">'.date('d-m-Y', strtotime($ms_detail->msr_date)).'</td>
                                </tr>
                                <tr>
                                    <th>From</th>
                                    <td>'.$ms_detail->emp_name.'</td>
                                    <th>Department</th>
                                    <td>'.$ms_detail->deptt_name.'</td>
                                </tr>
                                <tr>
                                    <th>Detail:</th>
                                    <td colspan="3">'.$ms_detail->msr_detail.'</td>
                                </tr>
                                <tr>
                                    <th>Estimated Cost Rs.</th>
                                    <td>'.$ms_detail->msr_cost.'</td>
                                    <th>(In Words)</th>
                                    <td>'. strtoupper($cm).'</td>
                                </tr>
                            </table>';
                        
                            if($hod_rm_ado || $fwd_rm_ado):
                                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                                    <table class="table" width="100%" cellspacing="0">
                                        <tr>
                                            <th colspan="3" style="border: 1px solid #000; background-color: #000; color: #fff; text-align:center">ADMINISTRATIVE DEPARTMENT</th>
                                        </tr>';
                                        if($fwd_rm_ado):
                                            echo '<tr>
                                                <td colspan="2"><strong>Forwarded to '.$fwd_rm_ado->emp_name.' ('.$fwd_rm_ado->designation.') for '.$fwd_rm_ado->msd_forwarded_for.'</strong></td>
                                                <td>Date: '.date('d-m-Y', strtotime($fwd_rm_ado->msd_date)).'</td>
                                            </tr>';
                                        endif;
                                        if($hod_rm_ado):
                                            echo '<tr>
                                                <td colspan="2" style="border-bottom: 1px solid #000;"><strong>Remarks by '.$hod_rm_ado->emp_name.': </strong>'.$hod_rm_ado->msd_comments.'</td>
                                                <td width="25%" style="border-bottom: 1px solid #000;">Date: '.date('d-m-Y', strtotime($hod_rm_ado->msd_date)).'</td>
                                            </tr>';
                                        endif;
                                    echo '</table>
                                </div>';
                            endif;
                            
                        echo '</div>';
                        
                        ?>
                    </div>
                </div>
            </section>
            
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line"><?php echo $ReportName?> Form</span>
                </h1>
                <div class="section-content" >
                    <div class="row">
                        
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="name">Case</label>
                            <select class="form-control" name="case_id" id="case_id">
                                <option value="">Select Case</option>
                                <option value="2">Items Available in Store</option>
                                <option value="3">Forward to Department for Recommendation</option>
                                <option value="5">Forward to Finance Department</option>
                                <option value="6">Reverted Back</option>
                            </select>
                        </div>
                        
                        <div id="case_hod" class="hidden">
                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="name">Select HOD</label>
                                <?php echo form_dropdown('hod_id', $hod,'',  'class="form-control" id="hod_id"'); ?>
                            </div>

                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="name">Department</label>
                                <?php
                                    echo form_input(
                                        array(
                                            'name'      => 'department',
                                            'id'        => 'department',
                                            'type'      => 'text',
                                            'value'     => '',
                                            'class'     => 'form-control',
                                            'readonly'  => 'readonly',
                                        )
                                    );
                                    echo form_input(
                                        array(
                                            'name'      => 'department_id',
                                            'id'        => 'department_id',
                                            'type'      => 'hidden',
                                            'value'     => '',
                                            'class'     => 'form-control',
                                            'readonly'  => 'readonly',
                                        )
                                    );
                                    echo form_input(
                                        array(
                                            'name'      => 'min_sht_id',
                                            'id'        => 'min_sht_id',
                                            'type'      => 'hidden',
                                            'value'     => $ms_detail->msr_id,
                                            'class'     => 'form-control',
                                            'readonly'  => 'readonly',
                                        )
                                    );
                                ?>
                            </div>
                            
                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="name">Designation</label>
                                <?php
                                    echo form_input(
                                        array(
                                            'name'      => 'curr_design',
                                            'id'        => 'curr_design',
                                            'type'      => 'text',
                                            'value'     => '',
                                            'class'     => 'form-control',
                                            'readonly'  => 'readonly',
                                        )
                                    );
                                    echo form_input(
                                        array(
                                            'name'      => 'curr_des_id',
                                            'id'        => 'curr_des_id',
                                            'type'      => 'hidden',
                                            'value'     => '',
                                            'class'     => 'form-control',
                                            'readonly'  => 'readonly',
                                        )
                                    );
                                ?>
                            </div>
                            
                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="name">Forward to Deptt for</label>
                                <input type="text" class="form-control" name="forw_for" id="forw_for">
                            </div>
                        </div>
 
                        <div id="case_recomnd" class="hidden">
                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="name">Decision</label>
                                <select class="form-control" name="decision" id="decision">
                                    <option value="">Decision</option>
                                    <option value="1">Recommended</option>
                                    <option value="2">Not Recommended</option>
                                </select>
                            </div>
                        </div>
                        <div id="case_revert" class="hidden">
                            <div class="col-md-12 form-group">
                                <label for="name">Details / Description:</label>
                                <textarea type="text" class="form-control notes" maxlength="250" rows="2" name="details" id="details" style="resize: none;" required="required"></textarea>
                            </div> 
                        </div> 
                        
                    </div>
                </div><!--//section-content-->
                           
                <div class="col-md-12 right">
                    <button type="button" class="btn btn-theme pull-right mt-2" name="update_ado_ms" id="update_ado_ms"  value="update_ado_ms" >Submit</button>
                </div>
                
            </section>    
            
            <?php
            if($att_result):    
                echo '<div class="section">
                    <div class="col-md-12">
                        <div class="row">';
                        foreach($att_result as $rec):
                            $f_ext = pathinfo($rec->msa_file); 
                            echo '<div class="col-md-3 col-sm-6" style="border: 1px solid #ccc; padding: 10px;">
                                <div style="text-align: center">';

                                switch ($f_ext['extension']):
                                    case 'doc':
                                        echo '<div style="height: 200px;text-align:center; overflow-wrap: break-word;">
                                            <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'docx':
                                        echo '<div style="height: 200px;text-align:center; overflow-wrap: break-word;">
                                            <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'xls':
                                        echo '<div style="height: 200px;text-align:center; overflow-wrap: break-word;">
                                            <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'xlsx':
                                        echo '<div style="height: 200px;text-align:center; overflow-wrap: break-word;">
                                            <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'ppt':
                                        echo '<div style="height: 200px;text-align:center; overflow-wrap: break-word;">
                                            <img src="assets/images/file_icons/ppt.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'pptx':
                                        echo '<div style="height: 200px;text-align:center; overflow-wrap: break-word;">
                                            <img src="assets/images/file_icons/pptx.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'pdf':
                                        echo '<div style="height: 200px;text-align:center; overflow-wrap: break-word;">
                                            <img src="assets/images/file_icons/pdf.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    default:
                                        echo '<img src="assets/images/min_sheet_attach/'.$rec->msa_file.'" style="max-width: 200px; max-height:200px;">';
                                endswitch;

                                    echo '<div class="col-12" style="padding: 10px;">
                                        <a href="assets/images/min_sheet_attach/'.$rec->msa_file.'" target="_blank"><button type="button" class="btn btn-danger">Download</button></a>
                                    </div>
                                </div>
                            </div>';
                        endforeach;
                        echo '</div>
                    </div>
                </div>';
            endif;
            ?>
            
        </div><!--//col-md-12-->       
    </div><!--//cols-wrapper-->
    <?php endif; ?>
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
        $('#case_id').on('change', function(){
            if($('#case_id').val() == 3){
                $('#case_recomnd').addClass('hidden');
                $('#case_hod').removeClass('hidden');
                $('#case_revert').addClass('hidden');
            }
            else if($('#case_id').val() == 5){
                $('#case_recomnd').removeClass('hidden');
                $('#case_revert').removeClass('hidden');
                $('#case_hod').addClass('hidden');
            }
            else if($('#case_id').val() == 6) {
                $('#case_recomnd').addClass('hidden');
                $('#case_revert').removeClass('hidden');
                $('#case_hod').addClass('hidden');
            }
            else {
                $('#case_revert').addClass('hidden');
                $('#case_recomnd').addClass('hidden');
                $('#case_hod').addClass('hidden');
            }
        });
        
        $('#hod_id').on('change',function(){
            //get sub program
            $.ajax({
                type   :'post',
                url    :'MinuteSheetController/get_department',
                dataType : 'json',
                data   :{'empId' : $('#hod_id').val()},
                success :function(result){
                    $('#department_id').val(result['deptt_id']);
                    $('#department').val(result['deptt_name']);
                    $('#curr_design').val(result['designation']);
                    $('#curr_des_id').val(result['design_id']);
                }
            });
        });
        
        $('#update_ado_ms').on('click', function(){
            if($('#case_id').val() === ''){
                $('#case_id').focus();
                return false;
            }
            if($('#case_id').val() == 3){
                if($('#hod_id').val() === ''){
                    $('#hod_id').focus();
                    return false;
                }
                if($('#forw_for').val() === ''){
                    $('#forw_for').focus();
                    return false;
                }
            }
            if($('#case_id').val() == 5 || $('#case_id').val() == 6){
                if($('#details').val() === ''){
                    $('#details').focus();
                    alert('Please insert remarks');
                    return false;
                }
            }
            var data = {
                'min_sht_id': $('#min_sht_id').val(),
                'decision'  : $('#decision').val(),
                'case_id'   : $('#case_id').val(),
                'details'   : $('#details').val(),
                'hod_id'    : $('#hod_id').val(),
                'deptt_id'  : $('#department_id').val(),
                'design_id' : $('#curr_des_id').val(),
                'forw_for'  : $('#forw_for').val()
            };
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/ado_update_minute_sheet',
                data    : data,
                success :function(result){ 
                    window.location.href = 'MinuteSheetRecordADO';
                }
            });
        });
        
//        $("#image_file").on("change", function() {
//            $("#submit_image").click();
//        });
//        
//        $("#submit_image").on('click', function(e){
//            e.preventDefault();
//            var formData = new FormData($("#image_form")[0]);
//            $.ajax({
//                url         : $("#image_form").attr('action'),
//                type        : 'POST',
//                dataType    : 'json',
//                data        : formData,
//                contentType : false,
//                processData : false,
//                success: function(result) {
//                    if(result['insert'] == true){
//                        $.ajax({
//                            type   : 'post',
//                            url    : 'MinuteSheetController/minute_sheet_attch_edit_grid',
//                            data   : { 'min_id' : $('#min_id').val() },
//                            success: function(result){
//                                 $('#result_grid').html(result);
//                            }
//                        });
//                    }
//                    else {
//                        alert('Test');
//                    }
//                }
//            });
//        });
        
    });
 
</script>