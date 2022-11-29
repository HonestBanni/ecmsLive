<!-- ******CONTENT****** --> 
<div class="content container">
    <? if($ms_detail): ?>
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
                                    <th width="15%">Diary No.</th>
                                    <td width="35%">'.$ms_detail->msr_diary_no.'</td>
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
                            </table>
                        </div>';
                        
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
                                <option value="3">Forwarded to HOD for Recommendation</option>
                                <option value="5">Recommended</option>
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
                        </div>
 
                        <div id="case_recomnd" class="hidden">
                            <div class="col-md-12 form-group">
                                <label for="name">Details / Description:</label>
                                <textarea type="text" class="form-control notes" maxlength="250" rows="2" name="details" id="details" style="resize: none;" required="required"></textarea>
                            </div> 
                        </div> 
                        
                    </div>
                </div><!--//section-content-->
                           
                    <div class="col-md-12 right">
                        <button type="button" class="btn btn-theme pull-right mt-2" name="update_ado_ms" id="update_ado_ms"  value="update_ado_ms" >Submit Minute Sheet</button>
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
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'docx':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'xls':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'xlsx':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'ppt':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/ppt.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'pptx':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/pptx.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'pdf':
                                        echo '<div style="height: 200px;text-align:center">
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
    <? endif; ?>
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
        $('#case_id').on('change', function(){
            if($('#case_id').val() == 3){
                $('#case_recomnd').addClass('hidden');
                $('#case_hod').removeClass('hidden');
            }
            else if($('#case_id').val() == 5){
                $('#case_recomnd').removeClass('hidden');
                $('#case_hod').addClass('hidden');
            }
            else {
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
            }
            if($('#case_id').val() == 5){
                if($('#details').val() === ''){
                    $('#details').focus();
                    return false;
                }
            }
            var data = {
                'min_sht_id': $('#min_sht_id').val(),
                'case_id'   : $('#case_id').val(),
                'details'   : $('#details').val(),
                'hod_id'    : $('#hod_id').val(),
                'deptt_id'  : $('#department_id').val()
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