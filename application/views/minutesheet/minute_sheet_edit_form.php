<!-- ******CONTENT****** --> 
<div class="content container">
    
    <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
            
            <?php
            if(!empty($revert_cmnts)):
            echo '<section class="course-finder" style="background-color: #fff; border: 1px solid #eee; padding-top: 15px;">
                <div class="section-content" >
                    <h3 class="text-center" style="color:#c00; font-family: Arial; font-weight: bold;">
                        <i>'.strtoupper($revert_cmnts->mss_title).' FOR '.strtoupper($revert_cmnts->msd_comments).'</i>
                    </h3>
                </div>
            </section>';
            endif;
            ?>
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line"><?php echo $ReportName?> Form</span>
                </h1>
                <div class="section-content" >
                    <div class="row">
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="name">From</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'      => 'initiator_name',
                                        'type'      => 'text',
                                        'value'     => $ms_detail->emp_name,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                    )
                                );
                                echo form_input(
                                    array(
                                        'name'      => 'initiator_id',
                                        'id'        => 'initiator_id',
                                        'type'      => 'hidden',
                                        'value'     => $ms_detail->msr_emp_id,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                    )
                                );
                            ?>
                        </div>
 
                        <div class="col-md-4 col-sm-12 col-md-offset-4 form-group">
                            <label for="name">Department</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'      => 'department',
                                        'type'      => 'text',
                                        'value'     => $ms_detail->deptt_name,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                    )
                                );
                                echo form_input(
                                    array(
                                        'name'      => 'department_id',
                                        'id'        => 'department_id',
                                        'type'      => 'hidden',
                                        'value'     => $ms_detail->msr_init_deptt,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                    )
                                );
                                echo form_input(
                                    array(
                                        'name'      => 'curr_status_id',
                                        'id'        => 'curr_status_id',
                                        'type'      => 'hidden',
                                        'value'     => $ms_detail->msr_curr_status,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                    )
                                );
                            ?>
                        </div>
 
                        <div class="col-md-12 form-group">
                            <label for="name">Details / Description:</label>
                            <textarea type="text" class="form-control notes" maxlength="250" rows="2" name="details" id="details" style="resize: none;" required="required"><?php echo $ms_detail->msr_detail; ?></textarea>
                        </div> 
                        
                        <div class="col-md-4 col-sm-12">
                            <label for="name">Estimated Cost Rs.</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'      => 'cost_num',
                                        'id'        => 'cost_num',
                                        'type'      => 'number',
                                        'value'     => $ms_detail->msr_cost,
                                        'class'     => 'form-control',
                                        'required'     => 'required',
                                    )
                                );
                            ?>
                        </div>
                        
                        <div class="col-md-8 col-sm-12">
                            <label for="name">(In Words)</label>
                            <?php
                            $in_words = $this->CRUDModel->money_convert($ms_detail->msr_cost);
                                echo form_input(
                                    array(
                                        'name'      => 'cost_alph',
                                        'id'        => 'cost_alph',
                                        'type'      => 'text',
                                        'value'     => strtoupper($in_words),
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly'
                                    )
                                );
                            ?>
                        </div>
                        
                    </div>
                </div><!--//section-content-->
                                 
                    <div class="col-md-8 right">
                        <?php echo form_open_multipart('MinuteSheetController/add_minute_sheet_attachment_edit',array('class'=>'course-finder-form','method'=>'post', 'id'=>'image_form')); ?>
                        
                        <label for="name">Attachment</label>
                        <?php
                            echo form_input(
                                array(
                                    'name'      => 'image_file[]',
                                    'id'        => 'image_file',
                                    'type'      => 'file',
                                    'value'     => '',
                                    'class'     => 'form-control',
                                    'multiple'  => '',
                                )
                            );
                            echo form_input(
                                array(
                                    'name'      => 'min_id',
                                    'id'        => 'min_id',
                                    'type'      => 'hidden',
                                    'value'     => $ms_detail->msr_id,
                                    'class'     => 'form-control',
                                    'readonly'  => 'readonly',
                                )
                            );
                        ?>
                        <button type="submit" class="btn btn-theme pull-right hidden" name="submit_image" id="submit_image"  value="submit_image" ></button>
                        <?php echo form_close(); ?>
                    </div>
                
                    <div class="col-md-4 right">
                        <label for="name" style="visibility: hidden">Add Attachments Add Attachments</label>
                        <button type="button" class="btn btn-theme pull-right" name="update_ms" id="update_ms"  value="update_ms" style="margin-left: 3px;"> Update Requisition</button>  &nbsp;
                        <a href="MinuteSheetRecord"><button type="button" class="btn btn-danger pull-right" name="back_btn" id="back_btn" value="back_btn" style="margin-left: 3px;">Cancel</button></a> &nbsp;
                    </div>
                
            </section>    
            
            <div id="result_grid"></div>
        </div><!--//col-md-12-->       
    </div><!--//cols-wrapper-->
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
        $.ajax({
            type   : 'post',
            url    : 'MinuteSheetController/minute_sheet_attch_edit_grid',
            data   : { 'min_id' : $('#min_id').val() },
            success: function(result){
                 jQuery('#result_grid').html(result);
            }
        });
        
        $('#cost_num').on('keyup change', function(){
            if($(this).val() < 1){
                $(this).val('');
                $('#cost_alph').val('');
                return false;
            }
            $.ajax({
                type   :'post',
                url    :'MinuteSheetController/convert_money',
                data   :{ 'cost': $('#cost_num').val() },
                success :function(result){ 
                   $('#cost_alph').val(result);    
                }
            });
        });
        
        $('#update_ms').on('click', function(){
            if($('#details').val() === ''){
                $(this).focus();
                return false;
            }
            if($('#cost_num').val() === ''){
                $(this).focus();
                return false;
            }
            var data = {
                'details'   : $('#details').val(),
                'cost_num'  : $('#cost_num').val(),
                'status_id' : $('#curr_status_id').val(),
                'min_id'    : $('#min_id').val()
            };
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/update_minute_sheet',
                data    : data,
                success :function(result){ 
                    window.location.href = 'MinuteSheetRecord';
                }
            });
        });
        
        $("#image_file").on("change", function() {
            $("#submit_image").click();
        });
        
        $("#submit_image").on('click', function(e){
            e.preventDefault();
            var formData = new FormData($("#image_form")[0]);
            $.ajax({
                url         : $("#image_form").attr('action'),
                type        : 'POST',
                dataType    : 'json',
                data        : formData,
                contentType : false,
                processData : false,
                success: function(result) {
                    if(result['insert'] == true){
                        $.ajax({
                            type   : 'post',
                            url    : 'MinuteSheetController/minute_sheet_attch_edit_grid',
                            data   : { 'min_id' : $('#min_id').val() },
                            success: function(result){
                                 $('#result_grid').html(result);
                            }
                        });
                    }
                    else {
                        alert('Test');
                    }
                }
            });
        });
        
    });
 
</script>