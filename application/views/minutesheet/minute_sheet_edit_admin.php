<!-- ******CONTENT****** --> 
<div class="content container">
    
    <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
            
            <?php
            
        $cm = $this->CRUDModel->money_convert($msv->msr_cost);
//        echo '<pre>'; print_r($this->input->post()); die;
        echo '<div class="modal-header">
            <p style="text-align:center">
                <strong>EDWARDES COLLEGE PESHAWAR<br>
                <span style="font-size:18px;"><u>PURCHASE REQUISITION</u></span></strong>
            </p>
        </div>
        <div class="modal-body">
            <div style="border: 1px solid #000;margin-bottom: 5px; ">
                <table>
                    <tr>
                        <td width="10%" style="padding-left: 5px;">FROM:</td>
                        <th width="30%">'.$msv->emp_name.'</th>
                        <td width="10%" style="border-left: 1px solid #000; padding-left: 5px;">DEPARTMENT: </td>
                        <th width="30%">'.$msv->deptt_name.'</th>
                        <td width="10%" style="border-left: 1px solid #000; padding-left: 5px;">DATE:</td>
                        <th width="10%">'.date('d-m-Y', strtotime($msv->msr_date)).'</th>
                    </tr>
                </table>
                <table class="table" cellspacing="0" width="100%">
                    <tr>
                        <td width="25%" style="vertical-align: top;">Detail of Requisition Item:</td>
                        <td width="75%" style="vertical-align: top;"><span><strong>'.$msv->msr_detail.'</strong></span></td>
                    </tr>
                </table>
                <table class="table">
                    <tr style="text-align:left;">
                        <td width="16%">Estimated Cost:</td>
                        <th width="17%">Rs. '.$msv->msr_cost.'/-</th>
                        <td width="12%">(In Words):</td>
                        <th width="50%">'.$cm.'</th>
                        <th width="5%">
                            <button class="btn btn-sm btn-primary" id="'.$msv->msr_id.'">EDIT</button>
                        </th>
                    </tr>
                </table>
            </div>';

            if($hod_rm_ado || $ao_remarks || $fwd_rm_ado):
                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                    <table class="table" width="100%" cellspacing="0">
                        <tr>
                            <th colspan="4" style="border: 1px solid #000; background-color: #000; color: #fff;">ADMINISTRATIVE DEPARTMENT</th>
                        </tr>';
                        if($fwd_rm_ado):
                            echo '<tr>
                                <td colspan="2"><strong>Forwarded to '.$fwd_rm_ado->emp_name.' ('.$fwd_rm_ado->designation.') for '.$fwd_rm_ado->msd_forwarded_for.'</strong></td>
                                <td>Date: '.date('d-m-Y', strtotime($fwd_rm_ado->msd_date)).'</td>
                                <th width="5%">
                                    <button class="btn btn-sm btn-primary" id="'.$fwd_rm_ado->msd_id.'">EDIT</button>
                                </th>
                            </tr>';
                        endif;
                        if($hod_rm_ado):
                            echo '<tr>
                                <td><strong>Remarks by '.$hod_rm_ado->emp_name.':</strong></td>
                                <td>'.$hod_rm_ado->msd_comments.'</td>
                                <td width="25%" style="border-bottom: 1px solid #000;">Date: '.date('d-m-Y', strtotime($hod_rm_ado->msd_date)).'</td>
                                <th width="5%">
                                    <button class="btn btn-sm btn-primary" id="'.$hod_rm_ado->msd_id.'">EDIT</button>
                                </th>
                            </tr>';
                        endif;
                        if($ao_remarks):
                            if($ao_remarks->msd_recommend == 1):
                                $rec_des = 'RECOMMENDED';
                            elseif($ao_remarks->msd_recommend == 2):
                                $rec_des = 'NOT RECOMMENDED';
                            else:
                                $rec_des = '';
                            endif;
                            echo '<tr>
                                <td width="25%" style="vertical-align: top;" height="50">Remarks by Administrative Officer:</td>
                                <td width="50%" style="vertical-align: top;">'.$ao_remarks->msd_comments.'</td>
                                <td width="25%" style="vertical-align: top;">Date: '.date( 'd-m-Y', strtotime($ao_remarks->msd_date)).'</td>
                                <th width="5%">
                                    <button class="btn btn-sm btn-primary" id="'.$ao_remarks->msd_id.'">EDIT</button>
                                </th>
                            <tr>
                                <td colspan="4" style="vertical-align: top;text-align: center;"><strong><i>'.$rec_des.'</i></strong></td>
                            </tr>
                            </tr>';
                        endif;
                    echo '</table>
                </div>';
            endif;

            if($fo_remarks):
                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                    <table class="table" width="100%" cellspacing="0">
                        <tr>
                            <th colspan="4" style="border: 1px solid #000; background-color: #000; color: #fff;">BUDGET SECTION FOR ALLOCATION OF BUDGET</th>
                        </tr>
                        <tr>
                            <td width="18%" style="border-bottom: 1px solid #000;">Chart of Account:</td>
                            <td width="35%" style="border-bottom: 1px solid #000;"><strong>'.$fo_remarks->fn_coa_mc_title.' ('.$fo_remarks->fn_coa_mc_code.')</strong></td>
                            <td width="19%" style="border-bottom: 1px solid #000;">Budget Allocation:</td>
                            <td width="28%" style="border-bottom: 1px solid #000;"><strong>'.$fo_remarks->msbg_budget.'</strong></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Budget Report:</td>
                            <td style="vertical-align: top;" colspan="2"><strong>'.$fo_remarks->msbg_comments.'</strong></td>
                            <th width="5%">
                                <button class="btn btn-sm btn-primary pull-right" id="'.$fo_remarks->msbg_id.'">EDIT</button>
                            </th>
                        </tr>
                    </table>
                </div>';
            endif;

            if($hod_rm_dfn || $df_remarks || $fwd_rm_dfn):
                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                    <table class="table" width="100%" cellspacing="0">
                        <tr>
                            <th colspan="4" style="border: 1px solid #000; background-color: #000; color: #fff;">FINANCE DEPARTMENT</th>
                        </tr>';
                        if($fwd_rm_dfn):
                            echo '<tr>
                                <td colspan="2"><strong>Forwarded to '.$fwd_rm_dfn->emp_name.' ('.$fwd_rm_dfn->designation.') for '.$fwd_rm_dfn->msd_forwarded_for.'</strong></td>
                                <td>Date: '.date('d-m-Y', strtotime($fwd_rm_dfn->msd_date)).'</td>
                                <th width="5%">
                                    <button class="btn btn-sm btn-primary" id="'.$fwd_rm_dfn->msd_id.'">EDIT</button>
                                </th>
                            </tr>';
                        endif;
                        if($hod_rm_dfn):
                            echo '<tr>
                                <td><strong>Remarks by '.$hod_rm_dfn->emp_name.':</strong> </td>
                                <td>'.$hod_rm_dfn->msd_comments.'</td>
                                <td width="25%" style="border-bottom: 1px solid #000;">Date: '.date('d-m-Y', strtotime($hod_rm_dfn->msd_date)).'</td>
                                <th width="5%">
                                    <button class="btn btn-sm btn-primary" id="'.$hod_rm_dfn->msd_id.'">EDIT</button>
                                </th>
                            </tr>';
                        endif;
                        if($df_remarks):
                            if($df_remarks->msd_recommend == 1):
                                $rec_des = 'RECOMMENDED';
                            elseif($df_remarks->msd_recommend == 2):
                                $rec_des = 'NOT RECOMMENDED';
                            else:
                                $rec_des = '';
                            endif;
//                                    $vp_status = $df_remarks->msd_status;
                            echo '<tr>
                                <td width="25%" style="vertical-align: top;">Director Finance Remarks:</td>
                                <td style="vertical-align: top;">'.$df_remarks->msd_comments.'</td>
                                <td width="25%" style="vertical-align: top;">Date: '.date( 'd-m-Y', strtotime($df_remarks->msd_date)).'</td>
                                <th>
                                    <button class="btn btn-sm btn-primary pull-right" id="'.$df_remarks->msd_id.'">EDIT</button>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="4" style="vertical-align: top; text-align: center;"><strong><i>'.$rec_des.'</i></strong></td>
                            </tr>';
                        endif;
                    echo '</table>
                </div>';
            endif;

            if($hod_rm_vp || $vp_remarks || $hod_rm_vp):
                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                    <table class="table" width="100%" cellspacing="0">
                        <tr>
                            <th colspan="4" style="border: 1px solid #000; background-color: #000; color: #fff;">VICE PRINCIPAL OFFICE</th>
                        </tr>';
                        if($fwd_rm_vp):
                            echo '<tr>
                                <td colspan="2"><strong>Forwarded to '.$fwd_rm_vp->emp_name.' ('.$fwd_rm_vp->designation.') for '.$fwd_rm_vp->msd_forwarded_for.'</strong></td>
                                <td>Date: '.date('d-m-Y', strtotime($fwd_rm_vp->msd_date)).'</td>
                                <th width="5%">
                                    <button class="btn btn-sm btn-primary" id="'.$fwd_rm_vp->msd_id.'">EDIT</button>
                                </th>
                            </tr>';
                        endif;
                        if($hod_rm_vp):
                            echo '<tr>
                                <td colspan="2" style="border-bottom: 1px solid #000;"><strong>Remarks by '.$hod_rm_vp->emp_name.':</strong> '.$hod_rm_vp->msd_comments.'</td>
                                <td width="25%" style="border-bottom: 1px solid #000;">Date: '.date('d-m-Y', strtotime($hod_rm_vp->msd_date)).'</td>
                                <th width="5%">
                                    <button class="btn btn-sm btn-primary" id="'.$hod_rm_vp->msd_id.'">EDIT</button>
                                </th>
                            </tr>';
                        endif;
                        if($vp_remarks):
                            if($vp_remarks->msd_recommend == 1):
                                $rec_des = 'RECOMMENDED';
                            elseif($vp_remarks->msd_recommend == 2):
                                $rec_des = 'NOT RECOMMENDED';
                            else:
                                $rec_des = '';
                            endif;
                        echo '<tr>
                            <td width="25%" style="border-top: none;">Purchase Type:</td>
                            <td colspan="2" style="border-top: none;">'.$vp_remarks->mspt_type.'</td>
                            <th>
                                <button class="btn btn-sm btn-primary pull-right" id="'.$vp_remarks->msd_id.'">EDIT</button>
                            </th>
                        </tr>
                        <tr>
                            <td width="25%" style="vertical-align: top;">Remarks:</td>
                            <td style="vertical-align: top;">'.$vp_remarks->msd_comments.'</td>
                            <td colspan="2" style="vertical-align: bottom;">Dated: '.date( 'd-m-Y', strtotime($vp_remarks->msd_date)).'</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="vertical-align: bottom; text-align: center;"><strong><i>'.$rec_des.'</i></strong></td>
                        </tr>';
                        endif;
                    echo '</table>
                </div>';
            endif;

            if($pr_remarks):
                switch ($pr_remarks->msd_status):
                    case 15: $color = 'green';  break;
                    case 16: $color = 'red';    break;
                    case 17: $color = 'blue';   break;
                endswitch;
                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                    <table class="table" width="100%" cellspacing="0">
                        <tr>
                            <th colspan="3" style="border: 1px solid #000; background-color: #000; color: #fff;">PRINCIPAL FOR APPROVAL</th>
                        </tr>
                        <tr>
                            <td width="25%" style="border-top: none;">Status:</td>
                            <td style="border-top: none; color: '.$color.'; font-size: 14px;"><strong>'.strtoupper($pr_remarks->mss_title).'</strong></td>
                            <th>
                                <button class="btn btn-sm btn-primary pull-right" id="'.$pr_remarks->msd_id.'">EDIT</button>
                            </th>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;" height="70">Principal Remarks:</td>
                            <td colspan="2" style="vertical-align: top;"><strong>'.$pr_remarks->msd_comments.'</strong></td>
                        </tr>
                    </table>
                </div>';
            endif;
        echo '</div>';
     
            
            ?>
        </div><!--//col-md-12-->       
    </div><!--//cols-wrapper-->
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
        $.ajax({
            type   : 'post',
            url    : 'MinuteSheetController/minute_sheet_attch_edit_grid',
            data   : { 'min_id' : $('#min_id').val() },
            success: function(result){
                 jQuery('#result_grid').html(result);
            }
        });
        
        $('#cost_num').on('keyup change', function(){
            if($(this).val() < 1){
                $(this).val('');
                $('#cost_alph').val('');
                return false;
            }
            $.ajax({
                type   :'post',
                url    :'MinuteSheetController/convert_money',
                data   :{ 'cost': $('#cost_num').val() },
                success :function(result){ 
                   $('#cost_alph').val(result);    
                }
            });
        });
        
        $('#update_ms').on('click', function(){
            if($('#details').val() === ''){
                $(this).focus();
                return false;
            }
            if($('#cost_num').val() === ''){
                $(this).focus();
                return false;
            }
            var data = {
                'details'   : $('#details').val(),
                'cost_num'  : $('#cost_num').val(),
                'status_id' : $('#curr_status_id').val(),
                'min_id'    : $('#min_id').val()
            };
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/update_minute_sheet',
                data    : data,
                success :function(result){ 
                    window.location.href = 'MinuteSheetRecord';
                }
            });
        });
        
        $("#image_file").on("change", function() {
            $("#submit_image").click();
        });
        
        $("#submit_image").on('click', function(e){
            e.preventDefault();
            var formData = new FormData($("#image_form")[0]);
            $.ajax({
                url         : $("#image_form").attr('action'),
                type        : 'POST',
                dataType    : 'json',
                data        : formData,
                contentType : false,
                processData : false,
                success: function(result) {
                    if(result['insert'] == true){
                        $.ajax({
                            type   : 'post',
                            url    : 'MinuteSheetController/minute_sheet_attch_edit_grid',
                            data   : { 'min_id' : $('#min_id').val() },
                            success: function(result){
                                 $('#result_grid').html(result);
                            }
                        });
                    }
                    else {
                        alert('Test');
                    }
                }
            });
        });
        
    });
 
</script>