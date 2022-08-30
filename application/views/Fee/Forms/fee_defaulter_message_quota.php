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
                     <?php echo form_open('',array('class'=>'course-finder-form','id'=>'saveMessage','name'=>'saveMessage')); ?>
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                    
                                <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Quota Date</label>
                                    <div class="form-group ">
                                        <?php echo form_input(array(
                                            
                                            'name'      => 'quota_date',
                                            'value'     => date('d-m-Y'),
                                            'id'        => 'quota_date',
                                            'readonly'  => 'readonly',
                                            'class'     => 'form-control date_format_d_m_yy'
                                            
                                            )); ?>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Number of sms</label>
                                      <div class="input-group" id="adv-search">
                                          <?php
                                               echo  form_input(
                                                       array(
                                                          'name'        => 'number_of_sms',
                                                          'type'        => 'number',
                                                          'id'          => 'number_of_sms',
                                                          'class'       => 'form-control ',

                                                           )
                                                       );
                                               echo  form_input(
                                                       array(   'name'   => 'fee_msgq_id',
                                                                'id'     => 'fee_msgq_id',
                                                                'type'   => 'hidden',
                                                          )
                                                       );
                                               echo  form_input(
                                                       array(   'name'   => 'send_message',
                                                                'id'     => 'send_message',
                                                                'type'   => 'hidden',
                                                          )
                                                       );
                                               echo  form_input(
                                                       array(   'name'  => 'r_message',
                                                                'id'    => 'r_message',
                                                                'type'  => 'hidden',
                                                          )
                                                       );
                                                ?>
                                      </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Department</label>
                                    <div class="form-group ">
                                        <?php 
                                         
                                            echo form_dropdown('quota_dept', $quota_dept,'',  'class="form-control" id="quota_dept"');
                                        ?>
                                    </div>
                                </div>    
                                <div class="col-md-2">
                                    <label for="name">Status</label>
                                    <div class="form-group ">
                                        <?php 
                                        $Status = array(
                                           '' =>'Select', 
                                           'active' =>'active', 
                                           'de-active' =>'de-active' 
                                        );
                                            echo form_dropdown('Status', $Status,'',  'class="form-control" id="Status"');
                                        ?>
                                    </div>
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
                                    <button type="button" class="btn btn-theme" name="update" id="update"  value="update" ><i class="fa fa-save"></i> Update</button>
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
             quota_sms_grid();
             
            jQuery('#save').on('click',function(){
                     
                   var  formData = new FormData($("#saveMessage")[0]);
                        formData.set("quota_date", jQuery('#quota_date').val());
                        formData.set("request", 'store');
                    $.ajax({
                        type     : "POST",
                        url      : 'Fee-Message-Quota-Details',
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
                                quota_sms_grid();
                                jQuery('#entry_success').show();
                                $('#saveMessage')[0].reset();
                                $('#d_msg').html(response['d_msg']);
                            }
                            console.log(response);  
                        }
                    });
                   
               });
            jQuery('#update').on('click',function(){
                     
                   var  formData = new FormData($("#saveMessage")[0]);
                        formData.set("quota_date", jQuery('#quota_date').val());
                        formData.set("request", 'update');
                    $.ajax({
                        type     : "POST",
                        url      : 'Fee-Message-Quota-Details',
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
                                quota_sms_grid();
                                jQuery('#entry_success').show();
                                $('#saveMessage')[0].reset();
                                $('#d_msg').html(response['d_msg']);
                            }
                            console.log(response);  
                        }
                    });
                   
               });
             function quota_sms_grid(){
                 jQuery('#entry_success').hide();
                 jQuery('#update').hide();
                    jQuery.ajax({
                        type    : 'post',
                        url     : 'Fee-Message-Quota-Details',
//                        dataType: 'json',
                         data    : {'request':'quota_grid'},
                        success  : function(data){
                           $('#search_grid').html(data);
//                            jQuery('#search_grid').html(response);
//                            
                       }
                   });
             }
         
        });
    </script>
   
 
     
  
 
    
    
    