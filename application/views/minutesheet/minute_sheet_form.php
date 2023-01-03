<!-- ******CONTENT****** --> 
<div class="content container">
    
    <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
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
                                        'value'     => $emp_detail->emp_name,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                    )
                                );
                                echo form_input(
                                    array(
                                        'name'      => 'initiator_id',
                                        'id'        => 'initiator_id',
                                        'type'      => 'hidden',
                                        'value'     => $emp_detail->emp_id,
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
                                        'value'     => $emp_detail->title,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                    )
                                );
                                echo form_input(
                                    array(
                                        'name'      => 'department_id',
                                        'id'        => 'department_id',
                                        'type'      => 'hidden',
                                        'value'     => $emp_detail->department_id,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                    )
                                );
                            ?>
                        </div>
 
                        <div class="col-md-12 form-group">
                            <label for="name">Details / Description:</label>
                            <textarea type="text" class="form-control notes" maxlength="200" rows="2" name="details" id="details" style="resize: none;" required="required"></textarea>
                        </div> 
                        
                        <div class="col-md-4 col-sm-12">
                            <label for="name">Estimated Cost Rs.</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'      => 'cost_num',
                                        'id'        => 'cost_num',
                                        'type'      => 'number',
                                        'value'     => '',
                                        'class'     => 'form-control',
                                        'required'     => 'required',
                                    )
                                );
                            ?>
                        </div>
                        
                        <div class="col-md-8 col-sm-12">
                            <label for="name">(In Words)</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'      => 'cost_alph',
                                        'id'        => 'cost_alph',
                                        'type'      => 'text',
                                        'value'     => '',
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly'
                                    )
                                );
                            ?>
                        </div>
                        
                    </div>
                </div><!--//section-content-->
                                 
                    <div class="col-md-10 right">
                        <?php echo form_open_multipart('MinuteSheetController/add_minute_sheet_attachment',array('class'=>'course-finder-form','method'=>'post', 'id'=>'image_form')); ?>
                        
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
                                    'name'      => 'form_code',
                                    'id'        => 'form_code',
                                    'type'      => 'hidden',
                                    'value'     => rand(100000000000, 999999999999),
                                    'class'     => 'form-control',
                                    'readonly'  => 'readonly',
                                )
                            );
                        ?>
                        <button type="submit" class="btn btn-theme pull-right hidden" name="submit_image" id="submit_image"  value="submit_image" ></button>
                        <?php echo form_close(); ?>
                    </div>
                
                    <div class="col-md-2 right">
                        <label for="name" style="visibility: hidden">Add Attachments</label>
                        <button type="button" class="btn btn-theme pull-right" name="save_ms" id="save_ms"  value="save_ms" > Submit Requisition</button>
                    </div>
                
            </section>    
            
            <div id="result_grid"></div>
        </div><!--//col-md-12-->       
    </div><!--//cols-wrapper-->
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
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
        
        $('#save_ms').on('click', function(){
            if($('#details').val() === ''){
                $(this).focus();
                return false;
            }
            if($('#cost_num').val() === ''){
                $(this).focus();
                return false;
            }
            var data = {
                'initiator_id'  : $('#initiator_id').val(),
                'department_id' : $('#department_id').val(),
                'details'       : $('#details').val(),
                'cost_num'      : $('#cost_num').val(),
                'form_code'     : $('#form_code').val()
            };
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/minute_sheet_save',
                dataType : 'json',
                data    : data,
                success :function(result){ 
                   if(result['save'] == true){
                       window.location.href = 'MinuteSheetRecord';
                   }    
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
                            url    : 'MinuteSheetController/minute_sheet_attch_grid',
                            data   : { 'form_code' : jQuery('#form_code').val() },
                            success: function(result){
                                 jQuery('#result_grid').html(result);
                            }
                        });
                    }
                }
            });
        });
        
    });
 
</script>