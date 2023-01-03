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
                        
                        <?php
                                  $this->db->order_by('msr_approve_id', 'desc');
                        $number = $this->db->get('min_sheet')->row();
//                        echo '<pre>'; print_r($number); die;
                        if(!empty($number->msr_approve_id)): $apId = $number->msr_approve_id+1; else: $apId = 1101; endif;
                        ?>
                        
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="name">Approve ID</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'      => 'approve_id',
                                        'id'        => 'approve_id',
                                        'type'      => 'text',
                                        'value'     => $apId,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                        'style'     => 'font-size:20px; font-weight: bolder; color:#c00;',
                                    )
                                );
                            ?>
                        </div>
 
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="name">Change Status</label>
                            <?php echo form_dropdown('status_id', $ms_status,'',  'class="form-control" id="status_id"'); ?>
                            <input type="hidden" name="curr_status" id="curr_status" class="form-control" value="<?php echo $ms_detail->msr_curr_status?>">
                            <input type="hidden" name="min_sht_id" id="min_sht_id" class="form-control" value="<?php echo $ms_detail->msr_id?>">
                        </div>
                        
                        <div class="col-md-4 col-sm-12form-group">
                            <label for="name">Date</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'      => 'ms_date',
                                        'id'        => 'ms_date',
                                        'type'      => 'text',
                                        'value'     => date('d-m-Y'),
                                        'class'     => 'form-control datepicker',
                                        'readonly'  => 'readonly',
                                    )
                                );
                            ?>
                        </div>
 
                        <div class="col-md-12 form-group">
                            <label for="name">Principal Comments:</label>
                            <textarea type="text" class="form-control notes" maxlength="250" rows="2" name="details" id="details" style="resize: none;"></textarea>
                        </div> 
                        
                    </div>
                </div><!--//section-content-->
                           
                    <div class="col-md-12 right">
                        <button type="button" class="btn btn-theme pull-right mt-2" name="update_prn_ms" id="update_prn_ms"  value="update_prn_ms" >Submit</button>
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
    <? endif; ?>
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
        $('#update_prn_ms').on('click', function(){
            if($('#status_id').val() === ''){
                $('#status_id').focus();
                return false;
            }
            if($('#ms_date').val() === ''){
                $('#ms_date').focus();
                return false;
            }
//            if($('#details').val() === ''){
//                $('#details').focus();
//                return false;
//            }
            var data = {
                'min_sht_id'    : $('#min_sht_id').val(),
                'status_id'     : $('#status_id').val(),
                'details'       : $('#details').val(),
                'approve_id'    : $('#approve_id').val(),
                'ms_date'       : $('#ms_date').val()
            };
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/prn_update_minute_sheet',
                data    : data,
                success :function(result){ 
                    window.location.href = 'MinuteSheetRecordPrincipal';
                    
                }
            });
        });
        
        $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
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