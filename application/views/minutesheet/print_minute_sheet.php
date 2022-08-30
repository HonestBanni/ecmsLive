<script language="javascript">
    function printdiv(printpage){
        var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
        var footstr = "</body>";
        var newstr = document.all.item(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr+newstr+footstr;
//        window.print();
        document.body.innerHTML = oldstr;
        return false;
    }
//    window.onload = printdiv('div_print');
        window.print();
</script>

<style>
    table tr td { padding-left: 4px; }
    table tr th { padding-left: 4px; }
</style>
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div id="div_print" style="font-family: calibri;"> 
                    <?php
                    
                    $ms_detail  = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$ms_id));
                    $conv_money = $this->CRUDModel->money_convert($ms_detail->msr_cost);
                    $hod_rm_ado = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 4));
                    $ao_remarks = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 5));
                    $fo_remarks = $this->MinuteSheetModel->get_fno_remarks(array('msbg_msr_id'=>$ms_id));
                    $hod_rm_dfn = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 7));
                    $df_remarks = $this->MinuteSheetModel->get_dir_finance_remarks(array('msd_msr_id'=>$ms_id), 'msd_status', array(9,10));
                    $vp_remarks = $this->MinuteSheetModel->get_vp_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 12));
                    $pr_remarks = $this->MinuteSheetModel->get_principal_remarks(array('msd_msr_id'=>$ms_id), 'msd_status', array(13,14,15));
                    
                    echo '<table width="100%">
                        <tr>
                            <td width="11%"><img src="'.base_url().'assets/images/monogram.png" alt="Edwardes College Peshawar"></td>
                            <td width="75%" style="text-align: center; vertical-align: top;">
                                <h1 style="padding-bottom: 0px; margin-bottom: 0px;">EDWARDES COLLEGE PESHAWAR</h1>
                                <h2 style="padding: 0px; margin: 0px;">MINUTE SHEET / REQUISITION FORM</h2>
                            </td>
                            <td width="14%" style="text-align: right; vertical-align: top;">'.$ms_detail->msr_diary_no.'</td>
                        </tr>
                    </table>
                    <div style="border: 1px solid #000; margin-bottom: 5px;">
                        <table>
                            <tr>
                                <td width="5%">FROM:</td>
                                <th width="35%">'.$ms_detail->emp_name.'</th>
                                <td width="5%" style="border-left: 1px solid #000;">DEPARTMENT:</td>
                                <th width="35%">'.$ms_detail->deptt_name.'</th>
                                <td width="5%" style="border-left: 1px solid #000;">DATE:</td>
                                <th width="15%">'.date('d-m-Y', strtotime($ms_detail->msr_date)).'</th>
                            </tr>
                        </table>
                        <table cellspacing="0" width="100%" height="75" style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                            <tr>
                                <td width="25%" style="vertical-align: top;">Detail of Requisition Item:</td>
                                <td width="75%" style="vertical-align: top;"><span><strong>'.$ms_detail->msr_detail.'</strong></span></td>
                            </tr>
                        </table>
                        <table>
                            <tr style="text-align:left;">
                                <td width="16%">Estimated Cost:</td>
                                <th width="17%">Rs. '.$ms_detail->msr_cost.'/-</th>
                                <td width="12%">(In Words):</td>
                                <th width="55%">'.$conv_money.'</th>
                            </tr>
                        </table>
                    </div>';
                    
                    if($hod_rm_ado || $ao_remarks):
                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position: relative">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <th colspan="2" style="border: 1px solid #000; background-color: #000; color: #fff;">ADMINISTRATIVE DEPARTMENT</th>
                                </tr>';
                                if($hod_rm_ado):
                                    echo '<tr>
                                        <td style="border-bottom: 1px solid #000;" width="25%">Forwarded for endorsement of Remarks:</td>
                                        <td style="border-bottom: 1px solid #000;"><strong>'.$hod_rm_ado->msd_comments.'</strong><br> Remarks by: <strong>'.$hod_rm_ado->emp_name.'</strong> ('.$hod_rm_ado->deptt_name.')</td>
                                    </tr>';
                                endif;
                                if($ao_remarks):
                                    echo '<tr>
                                        <td style="vertical-align: top;" height="70">Admin Officer Remarks:</td>
                                        <td style="vertical-align: top;"><strong>'.$ao_remarks->msd_comments.'</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="vertical-align: bottom; text-align: right; padding-right: 10px;">Administrative Officer</td>
                                    </tr>';
                                endif;
                            echo '</table>';
                            if(@$ao_remarks->msd_status == 5):
                                echo '<span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
                                    <img src="'.base_url().'assets/images/signatures/'.$ao_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                                </span>';
                            endif;
                        echo '</div>';
                    endif;
                    
                    if($fo_remarks):
                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position: relative">
                            <table width="100%" cellspacing="0">
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
                                    <td style="vertical-align: top;" height="70">Budget Report:</td>
                                    <td style="vertical-align: top;" colspan="3"><strong>'.$fo_remarks->msbg_comments.'</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="vertical-align: bottom; text-align: right; padding-right: 10px;">Finance Officer</td>
                                </tr>
                            </table>
                            <span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
                                <img src="'.base_url().'assets/images/signatures/'.$fo_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                            </span>
                        </div>';
                    endif;
                    
                    if($hod_rm_dfn || $df_remarks):
                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position: relative">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <th colspan="2" style="border: 1px solid #000; background-color: #000; color: #fff;">FINANCE DEPARTMENT</th>
                                </tr>';
                                if($hod_rm_dfn):
                                    echo '<tr>
                                        <td style="border-bottom: 1px solid #000;" width="25%">Forwarded for endorsement of Remarks:</td>
                                        <td style="border-bottom: 1px solid #000;"><strong>'.$hod_rm_dfn->msd_comments.'</strong><br> Remarks by: <strong>'.$hod_rm_dfn->emp_name.'</strong> ('.$hod_rm_ado->deptt_name.')</td>
                                    </tr>';
                                endif;
                                if($df_remarks):
                                    $vp_status = $df_remarks->msd_status;
                                    echo '<tr>
                                        <td style="vertical-align: top;" height="70">Director Finance Remarks:</td>
                                        <td style="vertical-align: top;"><strong>'.$df_remarks->msd_comments.'</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="vertical-align: bottom; text-align: right; padding-right: 10px;">Director Finance</td>
                                    </tr>';
                                endif;
                            echo '</table>';
                            if($vp_status == 9 || $vp_status == 10):
                                echo '<span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
                                    <img src="'.base_url().'assets/images/signatures/'.$df_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                                </span>';
                            endif;
                        echo '</div>';
                        if($vp_status == 9):
                            $vpt = 'Vice Principal-1';
                        else:
                            $vpt = 'Vice Principal-2';
                        endif;
                    endif;
                    
                    if($vp_remarks):
                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position:relative">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <th colspan="2" style="border: 1px solid #000; background-color: #000; color: #fff;">VICE PRINCIPAL OFFICE</th>
                                </tr>
                                <tr>
                                    <td width="25%" style="border-top: none;">Purchase Type:</td>
                                    <td style="border-top: none;"><strong>'.$vp_remarks->mspt_type.'</strong></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;" height="70">'.$vpt.' Remarks:</td>
                                    <td style="vertical-align: top;"><strong>'.$vp_remarks->msd_comments.'</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="vertical-align: bottom; text-align: right; padding-right: 10px;">Vice Principal</td>
                                </tr>
                            </table>';
                            if($vp_status == 9):
                                echo '<span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
                                    <img src="'.base_url().'assets/images/signatures/'.$vp_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                                </span>';
                            else:
                                echo '<span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
                                    <img src="'.base_url().'assets/images/signatures/'.$vp_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                                </span>';
                            endif;
                        echo '</div>';
                    endif;
                    
                    if($pr_remarks):
                        switch ($pr_remarks->msd_status):
                            case 13: $color = 'green';  break;
                            case 14: $color = 'red';    break;
                            case 15: $color = 'blue';   break;
                        endswitch;
                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position:relative">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <th colspan="2" style="border: 1px solid #000; background-color: #000; color: #fff;">PRINCIPAL FOR APPROVAL</th>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;" height="70">Principal Remarks:</td>
                                    <td style="vertical-align: top;"><strong>'.$pr_remarks->msd_comments.'</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-top: none; color: '.$color.'; font-size: 28px; text-align:center;"><strong>'.strtoupper($pr_remarks->mss_title).'</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="vertical-align: bottom; text-align: right; padding-right: 10px;">Principal</td>
                                </tr>
                            </table>
                            <span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
                                <img src="'.base_url().'assets/images/signatures/'.$pr_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                            </span>
                        </div>';
                    endif;
                    
                    ?>
                </div>
            </div>
          <!--//page-row-->
        </div>
        <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
</div>
<!--//content-->
 
 