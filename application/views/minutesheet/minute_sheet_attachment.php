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
                    <?php echo form_open('MinuteSheetController/add_minute_sheet_attachment',array('class'=>'course-finder-form','method'=>'post', 'id'=>'image_form')); ?>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="name">Attachment</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'  => 'image_file',
                                        'id'    => 'image_file',
                                        'type'  => 'file',
                                        'value' => '',
                                        'class' => 'form-control',
                                    )
                                );
                                echo form_input(
                                    array(
                                        'name'  => 'ms_id',
                                        'id'    => 'ms_id',
                                        'type'  => 'hidden',
                                        'value' => $min_sht_id,
                                        'class' => 'form-control',
                                    )
                                );
                            ?>
                        </div>
 
                        <div class="col-md-2 col-sm-12 form-group">
                            <label for="name" style="visibility: hidden">Attachment</label>
                            <button type="submit" class="btn btn-theme pull-right" name="add_img" id="add_img"  value="add_img" >Add Attachment</button>
                        </div>
 
                    </div>
                </div><!--//section-content-->
                  
                <?php echo form_close(); ?>
            </section>     
            
            <div id="result_grid"></div>
            
            <div style="padding-top:1%;">
                <div class="col-md-12 right">
                    <a href="MinuteSheetRecord"><button type="button" class="btn btn-theme pull-right" value="save_ms" >Save All Record</button></a>
                </div>
            </div>
            
        </div><!--//col-md-12-->       
    </div><!--//cols-wrapper-->
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
        $.ajax({
            type   : 'post',
            url    : 'MinuteSheetController/minute_sheet_attch_grid',
            data   : { 'msId' : jQuery('#ms_id').val() },
            success: function(result){
                 jQuery('#result_grid').html(result);
            }
        });
        
        $("#image_form").submit(function(e){
            if($('#image_file').val() == ''){
                $('#image_file').focus();
                return false;
            }
            e.preventDefault();
            var formData = new FormData($("#image_form")[0]);
            $.ajax({
                url : $("#image_form").attr('action'),
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,
                success: function(resp) {
                    console.log(resp); 
                    $.ajax({
                        type   : 'post',
                        url    : 'MinuteSheetController/minute_sheet_attch_grid',
                        data   : { 'msId' : jQuery('#ms_id').val() },
                        success: function(result){
                             jQuery('#result_grid').html(result);
                        }
                    });
                }
            });
        });
        
    });
 
</script>