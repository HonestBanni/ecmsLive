
<style>
    a.btn-cta, .btn-cta{
    background: #f12b24;
    color: #fff;
    padding: 10px 20px;
    font-size: 18px;
    line-height: 1.33;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    -o-border-radius: 0;
    border-radius: 0;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #f12b24;
    
    }
</style>

<!-- ******CONTENT****** --> 
        <div class="content container">
              
            <div class="row cols-wrapper">
               
                <div class="col-md-7">
                    
                    <section class="course-finder" style="background-color: #fcfcfc; border: none;">
                    <h1 class="section-heading text-highlight"><strong><span class="line">ID Card Credentials</span></strong></h1>
                        
                        <div class="section-content">
                            <form class="course-finder-form" action="PrintAndSaveIDCard" id="saveForm" name="saveForm" method="post" target="_blank">
                                <div class="row">
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Student Name:</label>
                                        <input type="text" class="form-control" name="student_name" id="student_name" autocomplete="off" value="<?php echo strtoupper($student_rec->student_name); ?>">
                                        <input type="hidden" readonly="readonly" name="std_image"  id="std_image" value="<?php echo $student_rec->applicant_image?>">
                                        <input type="hidden" readonly="readonly" name="student_id" id="student_id" value="<?php echo $student_rec->student_id?>">
                                        <input type="hidden" readonly="readonly" name="program_id" value="<?php echo $student_rec->programe_id?>">
                                        <input type="hidden" readonly="readonly" name="sub_pro_id" value="<?php echo $student_rec->sub_pro_id?>">
                                    </div>
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Father Name:</label>
                                        <input type="text" class="form-control" name="father_name" id="father_name" autocomplete="off" value="<?php echo strtoupper($student_rec->father_name); ?>" required="required">
                                    </div>
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">College No.</label>
                                        <input type="text" class="form-control" name="college_no" id="college_no" autocomplete="off" readonly="readonly" value="<?php echo $student_rec->college_no; ?>" required="required">
                                    </div>
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Program:</label>
                                        <input type="text" class="form-control" name="program" id="program" autocomplete="off" value="<?php if($student_rec->programe_id == 1): echo ' '.$student_rec->title_for_idcards; else: echo $student_rec->programe_name; endif; ?>" required="required">
                                    </div>
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Issue Date:</label>
                                        <input type="text" class="form-control" name="issue_date" id="issue_date" autocomplete="off" readonly="readonly" value="<?php echo date('d-m-Y', strtotime($student_rec->admission_date)); ?>" required="required">
                                    </div>
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Expiry Date:</label>
                                        <input type="text" class="form-control date datepicker" name="expiry_date" id="expiry_date" autocomplete="off" value="<?php echo $expiry_date; ?>" required="required">
                                    </div>
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Residence Contact:</label>
                                        <input type="text" class="form-control mphone" name="contact" id="contact" autocomplete="off" value="<?php echo $student_rec->mobile_no; ?>" required="required">
                                    </div>
                                    
                                    <div class="col-md-6 subject form-group">
                                        <label style="text-indent: 3px">Blood Group:</label>
                                         <?php echo form_dropdown('bg_id', $blood_group, $student_rec->bg_id,  'class="form-control bg_id" id="bg_id"'); ?>
                                    </div>
                                    
                                    <div class="col-md-12 subject form-group">
                                        <label style="text-indent: 3px">Address:</label>
                                        <input type="text" class="form-control" name="address" id="address" autocomplete="off" value="<?php echo strtoupper($student_rec->app_postal_address); ?>" required="required">
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                     <div class="col-md-12 form-group">
                                         <button type="submit" class="btn btn-danger" id="ApplicationSave" style="float:right; margin-left:5px">
                                             <strong><i class="fa fa-print"></i> PRINT</strong>
                                         </button>
                                         <button type="button" class="btn btn-success" id="prev_button" style="float:right; margin-left:5px">
                                             <strong><i class="fa fa-paste"></i> PREVIEW</strong>
                                         </button>
                                        <!--<button type="button" class="btn btn-success" id="save_button">Apply for Admission</button>-->
                                        <br>
                                    </div> 
                                </div>
                                
                            </form>
                        </div>
                    </section>
                    
                </div>
                
                <div class="col-md-5">
                    <div id="card_preview"></div>
                </div>
                
                <div class="col-md-12">
                    <div id="card_history"></div>
                </div>
                
            </div><!--//cols-wrapper-->

        </div><!--//content-->
   
    <!--<script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script>-->
    <!--<script type="text/javascript" src="assets/plugins/jquery.mask.min.js"></script>-->
<script>
jQuery(document).ready(function(){
    
    var card_data = {
        'picture'       : $('#std_image').val(),
        'student_name'  : $('#student_name').val(),
        'father_name'   : $('#father_name').val(),
        'college_no'    : $('#college_no').val(),
        'program'       : $('#program').val(),
        'issue_date'    : $('#issue_date').val(),
        'expiry_date'   : $('#expiry_date').val(),
        'contact'       : $('#contact').val(),
        'bg_id'         : $('.bg_id').val(),
        'address'       : $('#address').val()
    };
    $.ajax({
        type   : 'post',
        url    : 'IDCardController/idcard_preview',
        data   : card_data,
        success :function(result){
            $('#card_preview').html(result);
        }
    });
    
    $.ajax({
        type   : 'post',
        url    : 'IDCardController/idcard_histroy',
        data   : {'id' : $('#student_id').val() },
        success :function(res){
            $('#card_history').html(res);
        }
    });
    
    $('#ApplicationSave').on('click', function(){
        setTimeout(function() { 
            $.ajax({
                type   : 'post',
                url    : 'IDCardController/idcard_histroy',
                data   : {'id' : $('#student_id').val() },
                success :function(res){
                    $('#card_history').html(res);
                }
            });
        }, 3000);
    });
    
    $('#prev_button').on('click', function(){
        var card_data = {
            'picture'       : $('#std_image').val(),
            'student_name'  : $('#student_name').val(),
            'father_name'   : $('#father_name').val(),
            'college_no'    : $('#college_no').val(),
            'program'       : $('#program').val(),
            'issue_date'    : $('#issue_date').val(),
            'expiry_date'   : $('#expiry_date').val(),
            'contact'       : $('#contact').val(),
            'bg_id'         : $('.bg_id').val(),
            'address'       : $('#address').val()
        };
        $.ajax({
            type   : 'post',
            url    : 'IDCardController/idcard_preview',
            data   : card_data,
            success :function(result){
                $('#card_preview').html(result);
            }
        });
    });
    
    jQuery(document).ready(function(){
        jQuery(function() {
            jQuery('.date').mask('99-99-9999');
            jQuery('.date_time').mask('9999-99-99 99:99:99');
            jQuery('.number').mask('9999999999');
            jQuery('.year').mask('9999');
            jQuery('.mphone').mask('9999-9999999');
            jQuery('.nic').mask('99999-9999999-9');
            jQuery('.reg').mask('SSS-999999999');
            
        });
    });
    
    jQuery(function() {
        jQuery('.datepicker').datepicker( {
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'

        });
    });
    
    jQuery('#programe_id').on('change',function(){
        var programId = jQuery('#programe_id').val();
        //get sub program
        jQuery.ajax({
            type   :'post',
            url    :'OnlineController/getSubProgram',
            data   :{'programId':programId},
            success :function(result){
                jQuery('#sub_pro_id').html(result);
            },
            complete:function(){
                var programId = jQuery('#programe_id').val();
                //Get Batch 
                jQuery.ajax({
                    type   :'post',
                    url    :'OnlineController/getBatchId',
                    data   :{'programId':programId},
                    success :function(result){
                       console.log(result);
                      jQuery('#batch').val(result);
                   }
                });    
            }
        });
    });
    
    $('html').bind('keypress', function(e){
        if(e.keyCode == 13){
           return false;
        }
     });

 });
 
 
</script>