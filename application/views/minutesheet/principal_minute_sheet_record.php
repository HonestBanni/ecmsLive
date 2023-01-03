<!-- ******CONTENT****** -->  
<div class="content container">
    <h2 align="left"><?php echo $ReportName?>
        <hr>
    </h2>
    <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line">Search Form</span>
                </h1>
                <?php echo form_open('',array('class'=>'course-finder-form','method'=>'post')); ?>
                <div class="section-content" >
                    <div class="row">
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Process No</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'  => 'ms_diary_no',
                                        'id'    => 'ms_diary_no',
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                    )
                                );
                            ?>
                        </div>
 
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Initiator</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'  => 'msb_name',
                                        'id'    => 'msb_name',
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                    )
                                );
                                echo form_input(
                                    array(
                                        'name'  => 'msb_id',
                                        'id'    => 'msb_id',
                                        'type'  => 'hidden',
                                        'class' => 'form-control',
                                    )
                                );
                            ?>
                        </div>
 
<!--                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Department</label>
                            <?php // echo form_dropdown('dept_id', $department,'',  'class="form-control" id="dept_id"'); ?>
                        </div>
 
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Initiator</label>
                            <?php // echo form_dropdown('msb_id', $min_sheet_by,'',  'class="form-control" id="msb_id"'); ?>
                        </div>-->
 
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Description</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'  => 'detail_search',
                                        'id'    => 'detail_search',
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                    )
                                );
                            ?>
                        </div>
                        
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Status</label>
                            <?php echo form_dropdown('stts_id', $ms_status,'',  'class="form-control" id="stts_id"'); ?>
                        </div>
                        
                        <div class="col-md-2 col-sm-12 form-group">
                            <label for="name" style="visibility: hidden">Search Button</label>
                            <button type="button" class="btn btn-theme" name="search_ms" id="search_ms"  value="search_ms" > Search</button>
                        </div>
                        
                    </div>
                </div><!--//section-content-->
                              
                <?php echo form_close(); ?>            
            </section>    
            <div id="result_grid"></div>
            
            
            <div class="modal fade" id="view_modal" role="dialog" style="z-index:9999">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div id="view_modal_content"></div>
                    </div>
                </div>
            </div>
                    
            <div class="modal fade" id="att_modal" role="dialog" style="z-index:9999">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div id="att_modal_content"></div>
                    </div>
                </div>
            </div>
                    
             
        </div><!--//col-md-12-->  
    </div><!--//cols-wrapper-->
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
        $.ajax({
            type    : 'post',
            url     : 'MinuteSheetController/prn_minute_sheet_grid',
            success :function(result){ 
               $('#result_grid').html(result);    
            }
        });
            
//        setInterval(function(){
//            $.ajax({
//                type    : 'post',
//                url     : 'MinuteSheetController/prn_minute_sheet_grid',
//                data    : data,
//                success :function(result){ 
//                   $('#result_grid').html(result);    
//                }
//            });
//        }, 60000);
//        
//        $('#detail_search').on('keyup', function(){
//            var data = { 'detail': $('#detail_search').val() };
//            $.ajax({
//                type    : 'post',
//                url     : 'MinuteSheetController/prn_minute_sheet_grid',
//                data    : data,
//                success :function(result){ 
//                   $('#result_grid').html(result);    
//                }
//            });
//        });
        
        $('#dept_id').on('change', function(){
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/get_employ',
                data    : { 'dept_id': $('#dept_id').val() },
                success :function(result){ 
                   $('#msb_id').html(result);    
                }
            });
        });
        
        $('#search_ms').on('click', function(){
            var data = { 
                'ms_diary_no'   : $('#ms_diary_no').val(),
                'dept_id'       : $('#dept_id').val(),
                'ms_by_id'      : $('#msb_id').val(),
                'detail'        : $('#detail_search').val(),
                'stts_id'       : $('#stts_id').val()
            };
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/prn_minute_sheet_grid',
                data    : data,
                success :function(result){ 
                   $('#result_grid').html(result);    
                }
            });
        });
        
        $("#msb_name").autocomplete({  
            minLength   : 0,
            source      : "MinuteSheetController/initiator_autocomplete/"+$("#msb_name").val(),
            autoFocus   : true,
            scroll      : true,
            dataType    : 'jsonp',
            select      : function(event, ui){
                $("#msb_name").val(ui.item.contactPerson);
                $("#msb_id").val(ui.item.id);
        }
        }).focus(function() {  $(this).autocomplete("search", "");  }); 
        
    });
 
</script>