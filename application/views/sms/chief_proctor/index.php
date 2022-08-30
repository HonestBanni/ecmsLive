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
                     <?php echo form_open('',array('class'=>'course-finder-form','id'=>'DefaulterMessage')); ?>
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                    
                                <div class="row">
                                <div class="col-md-2">
                                    <label for="name">Date</label>
                                    <div class="form-group ">
                                        <?php echo form_input(array(
                                            
                                            'name'      => 'due_date',
                                            'id'        => 'due_date',
                                            'value'     => date('d-m-Y'),
                                            'readonly'  => 'readonly',
                                            'class'     => 'form-control date_picker_sms'
                                            
                                            )); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Fine</label>
                                    <div class="form-group ">
                                        <?php echo form_input(array(
                                            
                                            'name'          => 'Fine',
                                            'id'            => 'Fine',
                                            'Placeholder'   => 'Enter Student Fine',
                                            'class'         => 'form-control number'
                                            
                                            )); ?>
                                    </div>
                                </div>
                                    
                                <div class="col-md-2">
                                    <label for="name">Stage</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('stage_id', $stage_id,'',  'class="form-control" id="stage_id"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Label</label>
                                    <div class="form-group ">
                                        <?php echo form_input(array(
                                            
                                            'name'      => 'stage_label',
                                            'readonly'  => 'readonly',
                                            'id'        => 'stage_label',
                                            'class'     => 'form-control'
                                            
                                            )); ?>
                                    </div>
                                </div>
                                 
                                    <div class="col-md-1">
                                        <label for="name">Total</label>
                                        <input type="button" class="btn btn-theme" name="Total" id="Total">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="name"> Sent </label>
                                        <input type="button" class="btn btn-theme" name="Send" id="Send">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="name"> Remaining</label>
                                        <input type="button" class="btn btn-theme" name="Remaining" id="Remaining"> 
                                    </div>
                                   <div class="col-md-12 col-sm-12">
                                          <label for="name">Message</label>
                                          <textarea name="message" disabled="disabled" cols="150" rows="3" id="message" type="text" class="form-control"></textarea>
                                   </div> 
                                </div>
                            
                                    <hr/>
                                 <div class="row">    
                                    <div class="col-md-3" id="college_no_textbox">
                                        <label for="name" >College No</label>
                                        <div class="form-group ">
                                            <?php echo form_input(array(

                                                'name'          => 'college_no',
                                             
                                                'placeholder'   => 'College No',
                                                'class'         => 'form-control'

                                                )); ?>
                                        </div>
                                    </div>
                                     
                                    <div class="col-md-2">
                                        <label for="name" style="visibility:hidden">College N dsfsdfsdo</label>
                                        <button type="button" class="btn btn-theme" name="filterSearch" id="filterSearch"  value="filterSearch" ><i class="fa fa-search"></i> Search</button>
                                    </div>
                                    <div class="col-md-2 pull-right" id="search-btns">
                                        <label for="name" style="visibility:hidden">College dsfdsfsdfsdf N </label>
                                        <button type="button" class="btn btn-theme" name="ParentsMsg"  id="ParentsMsg"   value="ParentsMsg" ><i class="fa fa-send"></i> Send Message</button>
                                        <!--<button type="button" class="btn btn-danger" name="TestMessage" id="TestMessage"   value="TestMessage" ><i class="fa fa-send"></i> Test Message</button>-->
                                        <div class="col-md-5 pull-right"  id="loading-btns">
                                            <button type="button" class="btn btn-danger"><i class="fa fa-spinner "></i> Please wait...</button>
                                        </div>
                                    </div>
                                </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <!--<div style="padding-top:1%;">-->
<!--                                <div class="col-md-5 pull-right" id="search-btns">
                                    
                                    <button type="button" class="btn btn-theme" name="StudentMsg"  id="StudentMsg"   value="StudentMsg" ><i class="fa fa-send"></i> Student Message</button>
                                    <button type="button" class="btn btn-theme" name="ParentsMsg"  id="ParentsMsg"   value="ParentsMsg" ><i class="fa fa-send"></i> Send Message</button>
                                    <button type="button" class="btn btn-danger" name="TestMessage" id="TestMessage"   value="TestMessage" ><i class="fa fa-send"></i> Test Message</button>
                                </div>-->
<!--                                <div class="col-md-5 pull-right"  id="loading-btns">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-spinner "></i> Please wait...</button>
                                </div>-->
                              
                            <!--</div>-->
                                   
                     </section>
              
              <div class="alert alert-success" id="entry_success">
                    <strong style="text-align:center; font-size: 20px; color: #0e7a44;" id="succ_icons"></strong>
                    <span style="text-align:center; font-size: 20px; ">
                    <strong id="succ_texts"></strong>
                    <strong id="d_msg"></strong>
                        </span>
              </div>
              <div id="search_grid"></div>
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

<!--    <div class="modal fade" id="entry_success" role="dialog" style="z-index:9999">
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
    </div>-->
    <!--//page-wrapper--> 
 
     <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#loading-btns').hide();
            //By Default show record
             check_fee_message();
            
             
            jQuery('#stage_id').on('change',function(){
                 check_fee_message();
                 var due_date = jQuery('#due_date').val();
                 var Fine = jQuery('#Fine').val();
                 jQuery.ajax({
                        type    : 'post',
                        url     : 'Messages/Chief-Proctor/Details',
                        dataType: 'json',
                         data    : {'request':'stage-label','stage_id':jQuery(this).val(),'due_date':due_date,'Fine':Fine},
                        success :function(response){
                            $('#search_grid').html('');
                             if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                                $('#stage_id').val('');
                                jQuery('#college_no_textbox').hide();
                                jQuery('#filterSearch').hide();
                            }else{
                                jQuery('#stage_label').val(response['fee_stage_label']);
                                var message = '';
                                if(response['fee_stage_msg_end'] == ''){
                                        message = response['fee_stage_msg_start'];
                                }else{
                                    message = response['fee_stage_msg_start']+' '+Fine+' '+response['fee_stage_msg_end'];
                                }
                                    jQuery('#college_no_textbox').show();
                                    jQuery('#filterSearch').show();
                                  
                                 jQuery('#message').val(message);
                                 jQuery('#TestMessage').show();
//                                jQuery('#SendMessage').hide();
                                
                            }
                       }
                   });
             });
            jQuery('#TestMessage').on('click',function(){
                
                jQuery('#search-btns').hide();
                jQuery('#loading-btns').show();
                
                    check_fee_message();
                    jQuery('#TestMessage').show();
                   var  formData = new FormData($("#DefaulterMessage")[0]);
                        formData.set("std_status", jQuery('#std_status').val());
                        formData.set("message", jQuery('#message').val());
                        formData.set("request", 'test-message');
                    $.ajax({
                        type     : "POST",
                        url      : 'Messages/Chief-Proctor/Details',
                        data     : formData,
                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        success  : function(response){
//                            
                            jQuery('#search-btns').show();
                            jQuery('#loading-btns').hide(); 
                            
                            if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }
                            else {
                                
                                jQuery('#Total').val(response['m_tt']);   
                                jQuery('#Send').val(response['m_snd']);   
                                jQuery('#Remaining').val(response['m_rmng']); 
                                jQuery('#entry_success').show();
                                $('#succ_type').html(response['e_type']);
                                $('#d_msg').html(response['d_msg']);
                                
                                 jQuery('#college_no_textbox').show();
                                 jQuery('#filterSearch').show();
                                
                            }
                            console.log(response);  
                        }
                    });
                   
               });
            jQuery('#filterSearch').on('click',function(){
                    jQuery('#search-btns').hide();
                    jQuery('#loading-btns').show();
                    check_fee_message();
                    jQuery('#college_no_textbox').show();
                    jQuery('#filterSearch').show();
                   var formData = new FormData($("#DefaulterMessage")[0]);
                   formData.set("std_status", jQuery('#std_status').val());
                   formData.set("request", 'SearchStudents');
                    $.ajax({
                        type     : "POST",
                        url      : 'Messages/Chief-Proctor/Details',
                        data     : formData,
//                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        success  : function(response){
                            jQuery('#search-btns').show();
                            jQuery('#loading-btns').hide();
                            if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }
                            else{
                                $('#search_grid').html(response);
                                 var count_record = jQuery('#count_record').val();
                                 if(count_record>0){
                                    jQuery('#StudentMsg').show();
                                    jQuery('#ParentsMsg').show();
                                }else{
                                    jQuery('#StudentMsg').hide();
                                    jQuery('#ParentsMsg').hide();
                                };
                            }
                            console.log(response);  
                        }
                    });
                   
               });
            jQuery('#StudentMsg').on('click',function(){
                
                jQuery('#search-btns').hide();
                jQuery('#loading-btns').show();
                    jQuery('#StudentMsg').show();
                    jQuery('#ParentsMsg').show();
                    check_fee_message();
                   var formData = new FormData($("#DefaulterMessage")[0]);
                   formData.set("std_status", jQuery('#std_status').val());
                   formData.set("message", jQuery('#message').val());
                   formData.set("due_date", jQuery('#due_date').val());
                   formData.set("request", 'SendMessage');
                   formData.set("type", 'StudentMsg');
                    $.ajax({
                        type     : "POST",
                        url      : 'Messages/Chief-Proctor/Details',
                        data     : formData,
//                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        success  : function(response){
                            jQuery('#search-btns').show();
                            jQuery('#loading-btns').hide();
                            if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }
                            else {
                                jQuery('#Total').val(response['m_tt']);   
                                jQuery('#Send').val(response['m_snd']);   
                                jQuery('#Remaining').val(response['m_rmng']); 
                                jQuery('#entry_success').show();
                                $('#succ_type').html(response['e_type']);
                                $('#d_msg').html(response['d_msg']);
                                $('#search_grid').html('');
                            }
                            console.log(response);  
                        }
                    });
                   
               });
            jQuery('#ParentsMsg').on('click',function(){
                jQuery('#search-btns').hide();
                jQuery('#loading-btns').show();
                    jQuery('#ParentsMsg').show();
                    check_fee_message();
                   var formData = new FormData($("#DefaulterMessage")[0]);
                   formData.set("std_status", jQuery('#std_status').val());
                    formData.set("message", jQuery('#message').val());
                    formData.set("due_date", jQuery('#due_date').val());
                   formData.set("request", 'SendMessage');
                   formData.set("type", 'ParentMsg');
                    $.ajax({
                        type     : "POST",
                        url      : 'Messages/Chief-Proctor/Details',
                        data     : formData,
//                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        success  : function(response){
                            jQuery('#search-btns').show();
                            jQuery('#loading-btns').hide();
                            if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }
                            else {
                                jQuery('#Total').val(response['m_tt']);   
                                jQuery('#Send').val(response['m_snd']);   
                                jQuery('#Remaining').val(response['m_rmng']); 
                                jQuery('#entry_success').show();
                                $('#succ_type').html(response['e_type']);
                                $('#d_msg').html(response['d_msg']);
                                $('#search_grid').html('');
                            }
                            console.log(response);  
                        }
                    });
                   
               });
            
            
            
            
            //Show Categoryies Function 
             function check_fee_message(){
                  jQuery("#entry_pr_loader").hide();
                        jQuery(document).ajaxStart(function() {
                            jQuery("#entry_pr_loader").show();
                            $('#entry_pr_loader').modal('toggle');
                          });

                          jQuery(document).ajaxStop(function() {
                              $('#entry_pr_loader').modal('toggle');
                            jQuery("#entry_pr_loader").hide();
                //            $("#st-tree-container").show();
                          });
             }
             function check_fee_message(){
                jQuery('#TestMessage').hide();
                jQuery('#StudentMsg').hide();
                jQuery('#ParentsMsg').hide();
                jQuery('#entry_success').hide();
                jQuery('#college_no_textbox').hide();
                jQuery('#filterSearch').hide();
               
                
                    jQuery.ajax({
                        type    : 'post',
                        url     : 'Messages/Chief-Proctor/Details',
                        dataType: 'json',
                         data    : {'request':'check-message'},
                        success :function(response){
                             jQuery('#Total').val(response['m_tt']);   
                             jQuery('#Send').val(response['m_snd']);   
                             jQuery('#Remaining').val(response['m_rmng']);   
                            
                            
                             if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }else {
                                $('#succ_icon').html(response['e_icon']);
                                $('#succ_type').html(response['e_type']);
                                $('#succ_text').html(response['e_text']);
                                
                                
                            }
                            
                            
                       }
                   });
             }
         
        });
    </script>
    <script>
    jQuery(function() {
      jQuery( ".date_picker_sms").datepicker({
          dateFormat: 'dd-mm-yy',
           minDate: 0
      });
    });
    </script> 
 
     
  
 
    
    
    