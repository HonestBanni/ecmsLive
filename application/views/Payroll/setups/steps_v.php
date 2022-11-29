<div class="content container">
            <div class="page-wrapper">
                <header class="page-heading clearfix">
                        <h1 class="heading-title pull-left"><?php echo $breadcrumbs?></h1>
                            <div class="breadcrumbs pull-right">
                                <ul class="breadcrumbs-list">
                                    <li class="breadcrumbs-label">You are here:</li>
                                    <li><a href="admin/admin_home">Home</a><i class="fa fa-angle-right"></i></li>
                                    <li class="current"><?php echo $breadcrumbs?></li>
                                </ul>
                            </div>
                  <!--//breadcrumbs-->
                </header>
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="course-finder" style="padding-bottom: 2%;">
                                <h1 class="section-heading text-highlight">
                                    <span class="line"><?php echo $breadcrumbs?> Forms</span>
                                </h1>
                                <div class="section-content">
                                    <?php   echo form_open('',array('id'=>'RecordForm')) ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="name">Step </label>
                                                <input type="text" id="step" name="step" value="" placeholder="Step" class="form-control">
                                                <input type="hidden" class='pk_id' id="pk_id" name="pk_id">
                                            </div>
                                             
                                           
                                            <div class="col-md-3 col-md-offset-1 pull-right">
                                                <label for="name" style="visibility: hidden">Status dffsf sf ssfsf sdfsfsd sdfsdf</label>
                                                <button type="button" class="btn btn-theme" name="SaveRecord" id="SaveRecord" value="SaveRecord"><i class="fa fa-plus"></i> Save Record</button>
                                                <button type="button" class="btn btn-theme" name="UpdateRecord" id="UpdateRecord" value="UpdateRecord"><i class="fa fa-book"></i> Update Record</button>
                                                <button type="reset" class="btn btn-theme" name="resetbtn" id="resetbtn"><i class="fa fa-refresh"></i> Reset</button>
                                            </div>
                                            
                                        </div>
                                     </form>
                                </div><!--//section-content-->
                            </section>
                            
                            <div id="result_show">
                                
                            </div>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <div class="modal fade" id="entry_validation" role="dialog" style="z-index:9999">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 style="text-align:center; font-size: 80px; color: #c00;" id="resp_icon"></h1>
                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong id="resp_type"></strong></h4>
                    <p style="margin:0">&nbsp;</p>
                    <h4 style="text-align:center"><strong id="resp_text"></strong></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="entry_success" role="dialog" style="z-index:9999">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 style="text-align:center; font-size: 80px; color: #0e7a44;" id="succ_icon"></h1>
                    <h4 style="text-align:center; color: #0e7a44; margin: 0px;"><strong id="succ_type"></strong></h4>
                    <p style="margin:0">&nbsp;</p>
                    <h4 style="text-align:center"><strong id="succ_text"></strong></h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        jQuery(document).ready(function(){
            //By Default show record
            show_categories();
            //Save Record
            jQuery('#resetbtn').on('click',function(){
                show_categories();
            });
            jQuery('#SaveRecord').on('click',function(){
                 var    formData = new FormData($("#RecordForm")[0]);
                        formData.set("request", 'SaveRecord');
                jQuery.ajax({
                            type        : "POST",
                            url         : 'Payroll-Steps-Grid',
                            data        : formData,
                            dataType    : 'json',
                            contentType : false,
                            processData : false,
       
                        success :function(response){
                           if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }else {
                                $('#succ_icon').html(response['e_icon']);
                                $('#succ_type').html(response['e_type']);
                                $('#succ_text').html(response['e_text']);
                                $('#RecordForm')[0].reset();
                                $('#entry_success').modal('toggle');
                                 show_categories();
                            }
                           
                       }
                   });
            });
            //Update Record
            jQuery('#UpdateRecord').on('click',function(){
                
                        var formData = new FormData($("#RecordForm")[0]);
                            formData.set("request", 'UpdateRecord');
                            formData.set("pk_id", jQuery('.pk_id').val());
                    jQuery.ajax({
                            type        : 'post',
                            url         : 'Payroll-Steps-Grid',
                            data        : formData,
                            dataType    : 'json',
                            contentType : false,
                            processData : false, 
                            success     : function(response){
                               if(response['e_status'] == false){
                                    $('#resp_icon').html(response['e_icon']);
                                    $('#resp_type').html(response['e_type']);
                                    $('#resp_text').html(response['e_text']);
                                    $('#entry_validation').modal('toggle');
                                }else {
                                    $('#succ_icon').html(response['e_icon']);
                                    $('#succ_type').html(response['e_type']);
                                    $('#succ_text').html(response['e_text']);
                                    $('#RecordForm')[0].reset();
                                    $('#entry_success').modal('toggle');
                                     show_categories();
                                }

                           }
                       });
            });
            
            //Show Categoryies Function 
             function show_categories(){
                 jQuery('#SaveRecord').show();
                 jQuery('#UpdateRecord').hide();
                 jQuery.ajax({
                        type   : 'post',
                        url    : 'Payroll-Steps-Grid',
                        data    : {'request':'ShowRecords'},
                        success :function(result){
                            $('#result_show').html(result);
                       }
                   });
             }
        });
    </script>





<!-- ******CONTENT****** --> 
        