<div class="content container">
            <div class="page-wrapper">
                <header class="page-heading clearfix">
                        <h1 class="heading-title pull-left"><?php echo $page_headr?></h1>
                            <div class="breadcrumbs pull-right">
                                <ul class="breadcrumbs-list">
                                    <li class="breadcrumbs-label">You are here:</li>
                                    <li><a href="admin/admin_home">Home</a><i class="fa fa-angle-right"></i></li>
                                    <li class="current"><?php echo $page_headr?></li>
                                </ul>
                            </div>
                  <!--//breadcrumbs-->
                </header>
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="course-finder" style="padding-bottom: 2%;">
                                <h1 class="section-heading text-highlight">
                                    <span class="line"><?php echo $page_headr?> Forms</span>
                                </h1>
                                <div class="section-content">
                                    <form action="" class="course-finder-form" method="post" accept-charset="utf-8" id="saveRecordForm">
                                        <div class="row">
                                            <div class="col-md-3">
                                             <label for="name">Category</label>
                                                <?php echo form_dropdown('category',$Category,'',array('class'=>'form-control','id'=>'category_id'));?>
                                            </div>
                                            <div class="col-md-3">
                                             <label for="name">Department Name</label>
                                             <input type="text" id="department_name" name="department_name" value="" placeholder="Department Name" class="form-control">
                                             <input type="hidden" id="department_id"  name="department_id" >
                                            </div>
                                            
                                            <div class="col-md-3 pull-right">
                                                <label for="name" style="visibility: hidden">Status dffsf sdfsdfsdfdsf</label>
                                                <button type="button" class="btn btn-theme" name="SaveRecord" id="SaveRecord" value="SaveRecord"><i class="fa fa-plus"></i> Save Record</button>
                                                <button type="button" class="btn btn-theme" name="SaveUpdate" id="SaveUpdate" value="SaveUpdate"><i class="fa fa-book"></i> Update Record</button>
                                            </div>
                                            
                                        </div>
                                     </form>
                                </div><!--//section-content-->
                            </section>
                            
                            <div id="categories_result_show">
                                
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
            jQuery('#category_id').on('change',function(){
                 jQuery.ajax({
                        type        : 'post',
                        url         : 'Departments-Rst',
                        data        : {'category_id':jQuery("#category_id").val()},
                        success     :function(response){
                          $('#category_type_id').html(response);
                       }
                   });
            });
            jQuery('#SaveRecord').on('click',function(){
                
                var send_payload = {
                        'department_name'   : jQuery('#department_name').val(),
                        'category_id'       : jQuery('#category_id').val(),
                        'request'           : 'SaveRecord'
                    };
                jQuery.ajax({
                        type   : 'post',
                        url    : 'Departments-Rst',
                        dataType : 'json',
                        data    : send_payload,
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
                                $('#saveRecordForm')[0].reset();
                                $('#entry_success').modal('toggle');
                            }
                            show_categories();
                       }
                   });
            });
            //Update Record
            jQuery('#SaveUpdate').on('click',function(){
                
                var send_payload = {
                            'department_name'   : jQuery('#department_name').val(),
                            'category_id'       : jQuery('#category_id').val(),
                            'department_id'     : jQuery('#department_id').val(),
                            'request'           : 'UpdateRecord'
                    };
                jQuery.ajax({
                        type        : 'post',
                        url         : 'Departments-Rst',
                        dataType    : 'json',
                        data        : send_payload,
                        success     :function(response){
                            
                        if(response['e_status'] == false){
                             $('#resp_icon').html(response['e_icon']);
                             $('#resp_type').html(response['e_type']);
                             $('#resp_text').html(response['e_text']);
                             $('#entry_validation').modal('toggle');
                            
                             
                         }else {
                             $('#succ_icon').html(response['e_icon']);
                             $('#succ_type').html(response['e_type']);
                             $('#succ_text').html(response['e_text']);
                             $('#saveRecordForm')[0].reset();
                             $('#entry_success').modal('toggle');
                             show_categories(); 
                         }
                        
                       }
                   });
            });
            
            //Show Categoryies Function 
             function show_categories(){
                 jQuery('#SaveRecord').show();
                 jQuery('#SaveUpdate').hide();
                 jQuery.ajax({
                        type   : 'post',
                        url    : 'Departments-Rst',
                        data    : {'request':'showRecords'},
                        success :function(result){
                            $('#categories_result_show').html(result);
                       }
                   });
             }
        });
    </script>





<!-- ******CONTENT****** --> 
        