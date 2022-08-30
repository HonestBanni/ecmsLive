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
                                 
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,'',  'class="form-control" id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>
                                
                         
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,'',  'class="form-control" id="showFeeSubPro"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php
                                            
                                            echo form_dropdown('batch_id', $batch_name,'','class="form-control  " id="batch_id"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Section</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('section', $section,'',  'class="form-control" id="showSections"');
                                        ?>
                                    </div>
                                </div>
                                    
                                <div class="col-md-3">
                                    <label for="name">Student Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('std_status', $student_status,'',  'class="form-control" id="std_status" ');
                                        ?>
                                    </div>
                                </div> 
                              
                                  
                                <div class="col-md-3 ">
                                          <label for="name">Amount</label>
                                            <?php
                                                echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                'type'          => 'number',
                                                                'id'          => 'amount',
                                                                'value'         => '0',
                                                                'class'         => 'form-control ',
                                                                
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                 <div class="col-md-3">
                                    <label for="name">Due Date</label>
                                    <div class="form-group ">
                                        <?php echo form_input(array(
                                            
                                            'name'      => 'due_date',
                                            'id'        => 'due_date',
                                            'value'     => date('d-m-Y'),
                                            'readonly'  => 'readonly',
                                            'class'     => 'form-control datepicker'
                                            
                                            )); ?>
                                    </div>
                                </div>
                                 
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-5 pull-right" id="search-btns">
                                    <button type="button" class="btn btn-theme" name="filterSearch" id="filterSearch"  value="filterSearch" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-theme" name="updateDate"  id="updateDate"   value="updateDate" ><i class="fa fa-send"></i> Update Date</button>
                                </div>
                                <div class="col-md-5 pull-right"  id="loading-btns">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-spinner "></i> Please wait...</button>
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
            jQuery('#loading-btns').hide();
            jQuery('#entry_success').hide();
           
       
            jQuery('#filterSearch').on('click',function(){
                    jQuery('#search-btns').hide();
                    jQuery('#loading-btns').show();
                      jQuery('#entry_success').hide();
                   
                   var formData = new FormData($("#DefaulterMessage")[0]);
                   formData.set("std_status", jQuery('#std_status').val());
                   formData.set("request", 'SearchStudents');
                    $.ajax({
                        type     : "POST",
                        url      : 'Challan-Change-Date-Grid',
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
                                jQuery('#StudentMsg').show();
                                jQuery('#ParentsMsg').show();
                               $('#search_grid').html(response);
                            }
                            console.log(response);  
                        }
                    });
                   
               });
        jQuery('#updateDate').on('click',function(){
            
              
                   var formData = new FormData($("#DefaulterMessage")[0]);
                   formData.set("std_status", jQuery('#std_status').val());
                   formData.set("request", 'UpdateChallans');
                    $.ajax({
                        type     : "POST",
                        url      : 'Challan-Change-Date-Grid',
                        data     : formData,
//                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        success  : function(response){
//                         window.location.reload(); 
                         
                         jQuery('#entry_success').show();
                        $('#succ_type').html(response['e_type']);
                        $('#d_msg').html(response['d_msg']);
                        $('#search_grid').html('');
                         
                        }
                    });
        });
         
        });
    </script>
  <script type="text/javascript"> 
       $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
    </script>
 
  <style>
      .datepicker{
          z-index: 1;
      }
  </style> 
     
  
 
    
    
    