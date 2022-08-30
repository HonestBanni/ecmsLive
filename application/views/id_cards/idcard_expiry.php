
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
               
                <div class="col-md-12">
                    
                    <section class="course-finder" style="background-color: #fcfcfc; border: none;">
                    <h1 class="section-heading text-highlight"><strong><span class="line">ID Card Expiry Date</span></strong></h1>
                        
                        <div class="section-content">
                            <form class="course-finder-form" action="IDCardController/save_dates" id="save_form" name="save_form" method="post">
                                <div class="row">
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Program:</label>
                                        <?php echo form_dropdown('programe_id', $program, '', 'class="form-control" id="programe_id"'); ?>
                                    </div>
                                    
                                    <div class="col-md-4 subject form-group">
                                        <label style="text-indent: 3px">Expiry:</label>
                                        <input type="text" class="form-control datepicker" autocomplete="off" name="ex_date" id="ex_date" placeholder="(DD-MM-YYYY)">
                                    </div>
                                    
                                     <div class="col-md-2 form-group">
                                         `<label style="text-indent: 3px; visibility: hidden">Sub Programme:</label>
                                         <button type="submit" class="btn btn-success" id="ApplicationSave"><strong>Save</strong></button>
                                        <!--<button type="button" class="btn btn-success" id="save_button">Apply for Admission</button>-->
                                        <br>
                                    </div> 
                                </div>
                                
                            </form>
                        </div>
                    </section>
                    
                    <table class="table table-hover table-bordered" id="student_table">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Program</th>
                                <th>ID Card Expiry Date</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                        $this->db->join('programes_info','programes_info.programe_id=idcard_exipry_dates.iced_program_id', 'left outer');
                            $ex_dates = $this->db->get('idcard_exipry_dates')->result();
                            if($ex_dates):
                                $serial = 0;
                                foreach($ex_dates as $exrows):
                                    if(!empty($exrows->iced_expiry)): $date = date('d-m-Y', strtotime($exrows->iced_expiry)); else: $date = ''; endif;
                                    echo '<tr>
                                        <td>'.++$serial.'</td>
                                        <td>'.$exrows->programe_name.'</td>
                                        <td>'.$date.'</td>
                                        <td><button data-toggle="modal" data-target="#ChangeStatusModal" id="'.$exrows->iced_id.'" class="btn btn-sm btn-primary change_date">Update</button></td>
                                    </tr>';
                                endforeach;
                            endif;
                            
                            ?>
                        </tbody>
                    </table>

                    <div class="modal fade" id="entry_validation" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px;" id="resp_icon"></h1>
                                    <h4 style="text-align:center; margin: 0px;"><strong id="resp_type"></strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong id="resp_text"></strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="ChangeStatusModal" role="dialog" style="z-index:9999">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="section-content" id="ChangeStatusResult" >
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div><!--//cols-wrapper-->

        </div><!--//content-->
   
    <!--<script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script>-->
    <!--<script type="text/javascript" src="assets/plugins/jquery.mask.min.js"></script>-->
<script>
jQuery(document).ready(function(){
    
    $("#save_form").submit(function(h){
        h.preventDefault();
        var formData = new FormData($("#save_form")[0]);
        $.ajax({
            url   : $("#save_form").attr('action'),
            type  : 'POST',
            data  : formData,
            dataType  : 'json',
            contentType : false,
            processData : false,
            success: function(response) {
                if(response['e_status'] == true){
                    window.location.reload();
                } else {
                   $('#resp_icon').html(response['e_icon']);
                    $('#resp_type').html(response['e_type']);
                    $('#resp_text').html(response['e_text']);
                    $('#entry_validation').modal('toggle'); 
                }
                console.log(response);
            }
        });
    });

    jQuery('.change_date').on('click',function(){
        var id = jQuery(this).prop('id');
        jQuery.ajax({
            type   :'post',
            url    :'IDCardController/change_ex_date',
            data   :{'id' : id},
            success :function(result){
                jQuery('#ChangeStatusResult').html(result);
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
    
    $('html').bind('keypress', function(e)
        {
           if(e.keyCode == 13)
           {
              return false;
           }
        });

 });
 
 
</script>