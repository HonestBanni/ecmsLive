<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style> 
 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
     <div class="row">
          <div class="col-md-12">
                     <?php echo form_open('',array('class'=>'course-finder-form','id'=>'EntryForm','name'=>'EntryForm')); ?>
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                    
                                <div class="row">
                                 
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                    <?php  echo form_dropdown('program', $program,'',  'class="form-control" id="feeProgrameId"');?>
                                   
                                </div>    
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                     <?php  echo form_dropdown('sub_program', $sub_program,'',  'class="form-control" id="showFeeSubPro"');?>
                                </div>    
                                 <div class="col-md-3">
                                    <label for="name">Batch</label>
                                        <?php  echo form_dropdown('batch', $batch,'',  'class="form-control" id="batch_id"');?>
                                    
                                 </div>
                                   
                                <div class="col-md-3">
                                    <label for="name">Gender</label>
                                        <?php  echo form_dropdown('gender', $gender,'',  'class="form-control" id="gender"');?>
                                    
                                </div>
                               <div class="col-md-3">
                                    <label for="name">Shift</label>
                                     <?php  echo form_dropdown('shift', $shift,'',  'class="form-control" id="shift"');?>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Status</label>
                                        <?php  echo form_dropdown('status', $status,'',  'class="form-control" id="status"'); ?>
                                    
                                </div>    
                                <div class="col-md-3 col-sm-12">
                                          <label for="name">Marks From</label>
                                          <input name="start"  id="start" type="text" class="form-control number" placeholder="Marks from">
                                          <input name="pk_id"  id="pk_id"  type="hidden" class="form-control number" placeholder="Marks from">
                                </div> 
                                <div class="col-md-3 col-sm-12">
                                          <label for="name">Marks To</label>
                                          <input name="end"  id="end" type="text" class="form-control number" placeholder="Marks to">
                                </div> 
                                <div class="col-md-12 col-sm-12">
                                          <label for="name">Remarks</label>
                                          <textarea name="Remarks" cols="150" rows="3" id="Remarks" type="text" class="form-control"></textarea>
                                </div> 
                                 
                            </div>
                              
                           </div><!--//section-content-->
                                     
                              <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right" id="search-btns">
                                    <button type="button" class="btn btn-theme" name="save" id="save"  value="save" ><i class="fa fa-save"></i> Save</button>
                                    <button type="button" class="btn btn-theme" name="update_grid" id="update_grid"  value="update_grid" ><i class="fa fa-save"></i> Update</button>
                                </div>
                            </div>    
                           
                                   
                     </section>
               <div class="alert alert-success" id="entry_success">
                    <strong style="text-align:center; font-size: 20px; color: #0e7a44;" id="succ_icons"></strong>
                    <span style="text-align:center; font-size: 20px; ">
                    <strong id="succ_texts"></strong>
                    <strong id="d_msg"></strong>
                        </span>
              </div>
              <div id="search_grid">
                  
              </div>
                  <?php  echo form_close();  ?>                 
                                </div>
 
            </div>
            </div>
        </div>
                
    
      
        <!--//page-row-->
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
 
 
     <script type="text/javascript">
        jQuery(document).ready(function(){
            //By Default show record
             grid_show();
             
            jQuery('#save').on('click',function(){
                     
                   var  formData = new FormData($("#EntryForm")[0]);
                        formData.set("request", 'store');
                    $.ajax({
                        type     : "POST",
                        url      : 'Fee/Admisson/MertiList/Marks/ChangeShif/Grid',
                        data     : formData,
                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        success  : function(response){
                            
                            if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }
                            else {
                                grid_show();
                                jQuery('#entry_success').show();
                                $('#EntryForm')[0].reset();
                                $('#d_msg').html(response['d_msg']);
                            }
                            console.log(response);  
                        }
                    });
                   
               });
            jQuery('#update_grid').on('click',function(){
                     
                   var  formData = new FormData($("#EntryForm")[0]);
                        formData.set("request", 'update');
                    $.ajax({
                        type     : "POST",
                        url      : 'Fee/Admisson/MertiList/Marks/ChangeShif/Grid',
                        data     : formData,
                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        success  : function(response){
                            
                            if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }
                            else {
                                grid_show();
                                jQuery('#entry_success').show();
                                $('#EntryForm')[0].reset();
                                $('#d_msg').html(response['d_msg']);
                            }
                            console.log(response);  
                        }
                    });
                   
               });
            
            function grid_show(){
                 jQuery('#entry_success').hide();
                 jQuery('#update_grid').hide();
                 jQuery('#save').show();
                    jQuery.ajax({
                        type    : 'post',
                        url     : 'Fee/Admisson/MertiList/Marks/ChangeShif/Grid',
//                        dataType: 'json',
                         data    : {'request':'show'},
                        success  : function(data){
                           $('#search_grid').html(data);
//                            jQuery('#search_grid').html(response);
//                            
                       }
                   });
             }
         
        });
    </script>
   
 
     
  
 
    
    
    