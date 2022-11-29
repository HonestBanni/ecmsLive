        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $ReportName?><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form')); ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php echo form_dropdown('batch', $batch, $batch_id,  'class="form-control" id="batchId"'); ?>
                                    </div>
                                </div>
                         
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'class="form-control" id="subProgId"'); ?>
                                    </div>
                                </div> 
                                
                                <div class="col-md-6">
                                    <label for="name" style="visibility: hidden;">Sub Program</label>
                                    <div class="form-group ">
                                        <button type="button" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button> &nbsp;
                                        <button type="button" class="btn btn-theme hidden" name="generateList" id="generateList" value="generateList" ><i class="fa fa-send"></i> Generate Merit List</button>
                                    </div>
                                </div> 
                            </div>    
                        </div><!--//section-content-->
                          
                        <?php echo form_close(); ?>
                                
                    </section>
                    
                    <div id="ResultGrid"></div>
                                   
                </div><!--//col-md-3-->
                <div class="modal fade" id="FeeVerficationUpdatePopUp" role="dialog" style="z-index:9999">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="section-content" id="dataVerificationResult" >
                                </div>
                            </div>
                        </div>
                    </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
        <script>
            
            jQuery(document).ready(function(){
                jQuery('#filter').on('click', function(){
                    if(jQuery('#subProgId').val() == ''){
                        jQuery('#subProgId').focus();
                        return false;
                    }
                    var data = {
                        'batchId'   : jQuery('#batchId').val(),
                        'subProgId' : jQuery('#subProgId').val()
                    };
                    jQuery.ajax({
                        type    :'post',
                        url     :'SearchMeritList',
                        data    : data,
                        success : function(result){
                            jQuery('#ResultGrid').html(result);
                            jQuery('#generateList').removeClass('hidden');
                        }
                    });
                });
                jQuery('#generateList').on('click', function(){
                    if(jQuery('#subProgId').val() == ''){
                        jQuery('#subProgId').focus();
                        return false;
                    }
                    jQuery(this).addClass('hidden');
                    var data = {
                        'batchId'   : jQuery('#batchId').val(),
                        'subProgId' : jQuery('#subProgId').val()
                    };
                    jQuery.ajax({
                        type    :'post',
                        url     :'GenerateMeritList',
                        data    : data,
                        success : function(result){
                            jQuery('#ResultGrid').html(result);
                        }
                    });
                });
            });
 
        </script>