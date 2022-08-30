        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $ReportName?><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <form action="ExportMeritList" id="exportForm" name="exportForm" method="post" >
                    <section class="course-finder">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName?> Panel</span>
                        </h1>
                        <div class="section-content" >
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php echo form_dropdown('sub_pro_id', $sub_program, $applied_for,  'class="form-control" id="subProgId"'); ?>
                                    </div>
                                </div> 
                                
                                <div class="col-md-3">
                                    <label for="name">Quota</label>
                                    <div class="form-group ">
                                        <?php echo form_dropdown('r_seat', $reserved, $quota,  'class="form-control" id="r_seat"'); ?>
                                    </div>
                                </div> 
                                
                                <div class="col-md-3">
                                    <label for="name">Number of Records</label>
                                    <div class="form-group ">
                                        <input type="number" class="form-control" name="norec" id="norec">
                                    </div>
                                </div> 
                                
                                <div class="col-md-3">
                                    <label for="name" style="visibility: hidden">Number of Records</label>
                                    <div class="form-group ">
                                        <input type="checkbox" style="zoom: 1.2" name="allRecord" id="allRecord"> &nbsp; 
                                        <span style="font-size: 15px; font-weight: bold">Show All Records</span>
                                    </div>
                                </div> 
                                
                                <div class="col-md-12">
                                    <label for="name" style="visibility: hidden;">Sub Program</label>
                                    <div class="form-group ">
                                        <input type="submit" class="btn btn-theme" name="f_hostel" id="f_hostel"  value="Hostel Merit List" >  &nbsp;
                                        <input type="submit" class="btn btn-theme" name="f_quota" id="f_quota"  value="Export Merit List" >&nbsp;
                                        <button type="button" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button> &nbsp;
                                    </div>
                                </div> 
                            </div>    
                        </div><!--//section-content-->  
                    </section>
                    
                    <section class="course-finder">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Update Merit List</span>
                        </h1>
                        <div class="section-content" >
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <label for="name">Fee Submission Date</label>
                                    <div class="form-group ">
                                        <input type="text" class="form-control" name="fee_date" id="fee_date" autocomplete="off">
                                    </div>
                                </div> 
                              
                                <div class="col-md-3">
                                    <label for="name">Shift / Session</label>
                                    <div class="form-group ">
                                        <select class="form-control" name="shift" id="shift" autocomplete="off">
                                            <option value="Morning">Morning</option>
                                            <option value="Evening">Evening</option>
                                        </select>
                                    </div>
                                </div> 
                              
                                <div class="col-md-6">
                                    <label for="name">Comments</label>
                                    <div class="form-group ">
                                        <input type="text" class="form-control" name="coments" id="coments" autocomplete="off">
                                    </div>
                                </div> 
                               
                                <div class="col-md-3">
                                    <label for="name" style="visibility: hidden;">Sub Program</label>
                                    <div class="form-group ">
                                        <button type="button" class="btn btn-theme hidden" name="generateList" id="generateList" value="generateList" ><i class="fa fa-send"></i> Update Interview Details</button>
                                    </div>
                                </div> 
                            </div>    
                        </div><!--//section-content-->  
                    </section>
                    </form>
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
                    if(jQuery('#r_seat').val() == ''){
                        jQuery('#r_seat').focus();
                        return false;
                    }
                    var all_rec = '';
                    if($('#allRecord').prop("checked") == true){
                        all_rec = '';
                    }
                    else {
                        all_rec = 1;
                    }
                    var data = {
                        'rSeat'     : jQuery('#r_seat').val(),
                        'subProgId' : jQuery('#subProgId').val(),
                        'allRecord' : all_rec,
                        'noRec'     : jQuery('#norec').val()
                    };
                    jQuery.ajax({
                        type    :'post',
                        url     :'SearchFinalMeritList',
                        data    : data,
                        success : function(result){
                            jQuery('#ResultGrid').html(result);
                            jQuery('#generateList').removeClass('hidden');
                        }
                    });
                });
                
                jQuery('#generateList').on('click', function(){
                    if(jQuery('#fee_date').val() == ''){
                        jQuery('#fee_date').focus();
                        return false;
                    }
                    if(jQuery('#shift').val() == ''){
                        jQuery('#shift').focus();
                        return false;
                    }
                    var ids = [];
                    $('#checkItem:checked').each(function(i, e) {
                        ids.push($(this).val());
                    });
                    jQuery(this).addClass('hidden');
                    var data = {
                        'stdId'     : ids,
                        'comments'  : jQuery('#coments').val(),
                        'fee_date'  : jQuery('#fee_date').val(),
                        'shift'     : jQuery('#shift').val()
                    };
                    jQuery.ajax({
                        type    :'post',
                        url     :'GenerateFinalMeritList',
                        data    : data,
                        success : function(response){
                            var all_rec = '';
                            if($('#allRecord').prop("checked") == true){
                                all_rec = '';
                            }
                            else {
                                all_rec = 1;
                            }
                            var data = {
                                'rSeat'     : jQuery('#r_seat').val(),
                                'subProgId' : jQuery('#subProgId').val(),
                                'allRecord' : all_rec,
                                'noRec'     : jQuery('#norec').val()
                            };
                            jQuery.ajax({
                                type    :'post',
                                url     :'SearchFinalMeritList',
                                data    : data,
                                success : function(result){
                                    jQuery('#ResultGrid').html(result);
//                                    jQuery('#generateList').removeClass('hidden');
                                }
                            });
                        }
                    });
                });
            });
            
            $(function() {
                $('.datepicker').datepicker( {
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd-mm-yy'
                });
            });
 
        </script>