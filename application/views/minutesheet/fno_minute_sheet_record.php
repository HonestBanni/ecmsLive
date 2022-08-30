<!-- ******CONTENT****** -->  
<div class="content container">
    <h2 align="left">Minute Sheet Finance Officer Panel
        <hr>
    </h2>
    <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line">Search in Minute Sheet</span>
                </h1>
                <div class="section-content" >
                    <?php echo form_open('',array('class'=>'course-finder-form','method'=>'post')); ?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 form-group">
                            <!--<label for="name">Search in Minute Sheet</label>-->
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
 
                    </div>
                </div><!--//section-content-->
                                 
<!--                <div style="padding-top:1%;">
                    <div class="col-md-12 right">
                        <button type="button" class="btn btn-theme pull-right" name="search_ms" id="search_ms"  value="search_ms" > Search Minute Sheet</button>
                    </div>
                </div>-->
                
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
        
        var data = { 'detail': $('#detail_search').val() };
        $.ajax({
            type    : 'post',
            url     : 'MinuteSheetController/fno_minute_sheet_grid',
            data    : data,
            success :function(result){ 
               $('#result_grid').html(result);    
            }
        });
        
        setInterval(function(){
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/fno_minute_sheet_grid',
                data    : data,
                success :function(result){ 
                   $('#result_grid').html(result);    
                }
            });
        }, 60000);
        
        $('#detail_search').on('keyup', function(){
            var data = { 'detail': $('#detail_search').val() };
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/fno_minute_sheet_grid',
                data    : data,
                success :function(result){ 
                   $('#result_grid').html(result);    
                }
            });
        });
        
    });
 
</script>