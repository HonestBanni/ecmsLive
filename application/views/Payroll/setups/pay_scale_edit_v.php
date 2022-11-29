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
                                    <?php   echo form_open('',array('id'=>'RecordForm'))?>
                                    
                                        <div class="row">
                                             <div class="col-md-3">
                                                <label for="name">Pay Scale Financial Year</label>
                                                <?php echo form_dropdown('Fy',$Fy,$result->ps_fy_id,'class="form-control" id="Fy"');?>
                                            </div>
                                            <div class="col-md-3">
                                                    <label style="text-indent: 3px">Pay Scale Date</label>
                                                    <div>
                                                        <div style="width: 33%; float: left" class=" form-group">
                                                            <?php 

                                                            $dob_day = array();
                                                            $dob_day['']    = 'Day';
                                                            for($d=1; $d<32; $d++):
                                                                if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                                $dob_day[$v]= $d; 
                                                            endfor;  
                                                            echo form_dropdown('ps_day',$dob_day,date('d',strtotime($result->ps_date)),array('class'=>'form-control','id'=>'ps_day'));
                                                            ?> 
                                                        </div>
                                                        <div style="width: 33%; float: left" class="form-group" autocomplete="off" >

                                                            <?php
                                                             $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                            echo form_dropdown('ps_month',$month,date('m',strtotime($result->ps_date)),array('class'=>'form-control','id'=>'ps_month'));
                                                            ?>

                                                        </div>
                                                        <div style="width: 33%; float: left" class="form-group">
                                                              <?php
                                                                 $dob_year = array();
                                                                  $dob_year['']    = 'Year';
                                                                  for($y=date('Y')-20; $y<=date('Y')+20; $y++):
                                                                 $dob_year[$y] = $y;
                                                                endfor;
                                                                echo form_dropdown('ps_year',$dob_year,date('Y',strtotime($result->ps_date)),array('class'=>'form-control','id'=>'ps_year'));

                                                                ?>

                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                             <div class="col-md-3">
                                                <label for="name">Status</label>
                                                <?php echo form_dropdown('status',$status,$result->ps_status,'class="form-control" id="status"');?>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                      <label for="name">Remarks</label>
                                                     <textarea name="remarks" cols="40" rows="2" class="form-control" placeholder="Pay scale Remarks"  id="remarks"><?php echo $result->ps_remarks?></textarea>
                                                 </div>
                                             <div class="col-md-3 form-group">
                                                <label for="name">Scale</label>
                                                <?php echo form_dropdown('bps',$BPS, '','class="form-control" id="bps"');?>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label for="name">Minimum</label>
                                                <input type="text" id="minimum" name="minimum" value="" placeholder="Minimum" class="form-control">
                                                 <input type="hidden" name="pk_id" id="pk_id" value="<?php echo $this->uri->segment(2)?>">
                                                 <input type="hidden" name="pk_sd_id" id="pk_sd_id">
                                                
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label for="name">Rate of Increase</label>
                                                <input type="text" id="roi" name="roi" value="" placeholder="Rate of Increase" class="form-control">
                                                
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label for="name">Maximum</label>
                                                <input type="text" id="maximum" name="maximum" value="" placeholder="Maximum" class="form-control">
                                                
                                            </div>
                                           
                                           
                                            <div class="col-md-4 col-md-offset-1 pull-right">
                                                <label for="name" style="visibility: hidden">Statsdsdsdus dffsf sfqwqwqw ssfsf sdfsfsd</label>
                                                <button type="button" class="btn btn-theme" name="PayScaleDetailsEdit" id="PayScaleDetailsEdit" value="PayScaleDetailsEdit"><i class="fa fa-book"></i>Update Record</button>
                                                <button type="button" class="btn btn-theme" name="PayScaleDetails" id="PayScaleDetails" value="PayScaleDetails"><i class="fa fa-plus"></i> Add Record</button>
                                                <button type="button" class="btn btn-theme" name="SavePayScale" id="SavePayScale" value="SavePayScale"><i class="fa fa-save"></i> Save</button>
                                                <!--<button type="button" class="btn btn-theme" name="UpdateRecord" id="UpdateRecord" value="UpdateRecord"><i class="fa fa-book"></i> Update Record</button>-->
                                                <button type="reset" class="btn btn-theme" name="resetbtn" id="resetbtn"><i class="fa fa-refresh"></i> Reset</button>
                                            </div>
                                            
                                        </div>
                                   <?php echo form_close();?>
                                </div><!--//section-content-->
                            </section>
                             <div class="alert alert-success" id="entry_success">
                                <strong style="text-align:center; font-size: 20px; color: #0e7a44;" id="succ_icon"></strong> &nbsp;&nbsp;&nbsp; <span style="text-align:center; font-size: 20px; "><strong id="succ_text"></strong></span>.
                              </div>
                            <div id="result_show_demo">
                                
                            </div>
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



    <script type="text/javascript">
        jQuery(document).ready(function(){
            //By Default show record
             
             show_record_grid();
            //Save Record
            jQuery('#resetbtn').on('click',function(){
                show_categories();
            });
            jQuery('#PayScaleDetails').on('click',function(){
                 var    formData = new FormData($("#RecordForm")[0]);
                        formData.set("pk_id", jQuery('#pk_id').val());
                        formData.set("request", 'PayScaleDetails');
                jQuery.ajax({
                            type        : "POST",
                            url         : 'Pay-Scale-Details-Edit',
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
//                                $('#RecordForm')[0].reset();
                                jQuery('#minimum').val('');
                                jQuery('#roi').val('');
                                jQuery('#maximum').val('');
//                                $('#entry_success').modal('toggle');
                                  show_record_grid();
                                setTimeout(function(){
                                   
//                                    $('#entry_success').modal('toggle');
                                        jQuery('#entry_success').hide('slow');
                                    
                                 }, 1000);
                                
                            }
                           
                       }
                   });
            });
            jQuery('#SavePayScale').on('click',function(){
                 var    formData = new FormData($("#RecordForm")[0]);
                        formData.set("request", 'SavePayScale');
                jQuery.ajax({
                            type        : "POST",
                            url         : 'Pay-Scale-Details-Edit',
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
//                                $('#entry_success').modal('toggle');
                                setTimeout(function(){
                                   
//                                    $('#entry_success').modal('toggle');
//                                        jQuery('#entry_success').hide('slow');
                                        jQuery('#result_show_demo').hide('slow');
                                        window.location.href = 'PayScale';
                                    
                                 }, 1000);
                               
                            }
                           
                       }
                   });
            });
           
            
            //Show Categoryies Function 
             function show_record_grid(){
                 jQuery('#PayScaleDetailsEdit').hide();
                 jQuery('#entry_success').hide();
                 
                    jQuery.ajax({
                        type   : 'post',
                        url    : 'Pay-Scale-Details-Edit',
                        data    : {'request':'showEditGrid',"pk_id": jQuery('#pk_id').val()},
                        success :function(result){
                            $('#result_show_demo').html(result);
                            
                            
                            
                       }
                   });
             }
         
        });
    </script>





<!-- ******CONTENT****** --> 
        