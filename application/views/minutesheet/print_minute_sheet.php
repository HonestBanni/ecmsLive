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
<div class="content container" style="padding-left: 15px;">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div id="div_print" style="font-family: calibri;"> 
                    <?php
                    
                    $ms_detail  = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$ms_id));
                    $conv_money = $this->CRUDModel->money_convert($ms_detail->msr_cost);
                    $fwd_rm_ado = $this->MinuteSheetModel->get_hod_rec_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 3));
                    $hod_rm_ado = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 4));
                    $ao_remarks = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 5));
                    $fo_remarks = $this->MinuteSheetModel->get_fno_remarks(array('msbg_msr_id'=>$ms_id));
                    $hod_rm_dfn = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 7));
                    $fwd_rm_dfn = $this->MinuteSheetModel->get_hod_rec_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 8));
                    $df_remarks = $this->MinuteSheetModel->get_dir_finance_remarks(array('msd_msr_id'=>$ms_id), 'msd_status', array(9,10));
                    $fwd_rm_vp  = $this->MinuteSheetModel->get_hod_rec_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 13));
                    $hod_rm_vp  = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 9, 'msd_fwd_hod_id !=' => 0));
                    $vp_remarks = $this->MinuteSheetModel->get_vp_remarks(array('msd_msr_id'=>$ms_id, 'msd_status'=> 12));
                    $pr_remarks = $this->MinuteSheetModel->get_principal_remarks(array('msd_msr_id'=>$ms_id), 'msd_status', array(15,16));
                    
                    echo '<table width="100%">
                        <tr>
                            <td rowspan="2" width="10%"><img src="'.base_url().'assets/images/monogram-ms.png" alt="Edwardes College Peshawar"></td>
                            <td width="80%" style="text-align: center; vertical-align: top;">
                                <h1 style="font-size: 26px; padding-bottom: 0px; margin-bottom: 0px; font-family:Cambria;">EDWARDES COLLEGE PESHAWAR</h1>
                                <h2 style="padding: 0px; margin: 0px; font-family:Cambria;">PURCHASE REQUISITION FORM</h2>
                            </td>
                            <td width="10%"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right; vertical-align: top; font-size:16px;">Process No. <u>'.$ms_detail->msr_id.'</u></td>
                        </tr>
                    </table>
                    <div style="border: 1px solid #000; margin-bottom: 5px; position:relative;">
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
                        <table cellspacing="0" width="100%" height="65" style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                            <tr>
                                <td width="25%" style="vertical-align: top;">Detail of Requisition Item:</td>
                                <td width="60%" style="vertical-align: top;"><span><strong>'.$ms_detail->msr_detail.'</strong></span></td>
                                <td width="15%" style="vertical-align: top;"></td>
                            </tr>
                        </table>
                        <table>
                            <tr style="text-align:left;">
                                <td width="17%">Estimated Cost:</td>
                                <th width="17%">Rs. '.$ms_detail->msr_cost.'/-</th>
                                <td width="12%">(In Words):</td>
                                <th width="54%">'.$conv_money.'</th>
                            </tr>
                        </table>
                        <span style="position:absolute; bottom: 30px; right: 15px; z-index:99999">
                            <img src="'.base_url().'assets/images/signatures/'.$ms_detail->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                        </span> 
                    </div>';
                    
                    if($hod_rm_ado || $ao_remarks || $fwd_rm_ado):
                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position: relative">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <th colspan="4" style="border: 1px solid #000; background-color: #000; color: #fff;">ADMINISTRATIVE DEPARTMENT</th>
                                </tr>';
                                if($fwd_rm_ado):
                                    echo '<tr>
                                        <td colspan="4"><strong>Forwarded to '.$fwd_rm_ado->emp_name.' ('.$fwd_rm_ado->designation.') for '.$fwd_rm_ado->msd_forwarded_for.'</strong>
                                        <br>Date: '.date('d-m-Y', strtotime($fwd_rm_ado->msd_date)).'</td>
                                    </tr>';
                                endif;
                                if($hod_rm_ado):
                                    echo '<tr>
                                        <td colspan="3"><strong>Remarks by '.$hod_rm_ado->emp_name.':</strong> '.$hod_rm_ado->msd_comments.'</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="border-bottom: 1px solid #000;">Date: '.$hod_rm_ado->msd_date.'</td>
                                        <td width="50%" style="border-bottom: 1px solid #000;"></td>
                                        <td width="10%" style="border-bottom: 1px solid #000;"></td>
                                        <td width="15%" style="border-bottom: 1px solid #000; text-align: right; padding-right: 10px; position:relative">Signature
                                        <span style="position:absolute; bottom: 15px; right: 10px; z-index:99999">
                                            <img src="'.base_url().'assets/images/signatures/'.$hod_rm_ado->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                                        </span>
                                        </td>
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
                                        <td width="25%" style="vertical-align: top;" height="50">Remarks:</td>
                                        <td colspan="2" style="vertical-align: top;">'.$ao_remarks->msd_comments.'</td>
                                        <td width="15%"></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="vertical-align: bottom;">Dated: '.date( 'd-m-Y', strtotime($ao_remarks->msd_date)).'</td>
                                        <td width="50%" style="vertical-align: bottom; font-size: 18px;"><strong><i>'.$rec_des.'</i></strong></td>
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
                                    <td width="38%" style="border-bottom: 1px solid #000;"><strong>'.$fo_remarks->fn_coa_mc_title.' ('.$fo_remarks->fn_coa_mc_code.')</strong></td>
                                    <td width="19%" style="border-bottom: 1px solid #000;">Budget Allocation:</td>
                                    <td width="25%" style="border-bottom: 1px solid #000;"><strong>'.$fo_remarks->msbg_budget.'</strong></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;" height="45">Remarks:</td>
                                    <td style="vertical-align: top;" colspan="2">'.$fo_remarks->msbg_comments.'</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="vertical-align: bottom;">Dated: '.date( 'd-m-Y', strtotime($fo_remarks->msbg_date)).'</td>
                                    <td style="vertical-align: bottom; text-align: right; padding-right: 10px;">Finance Officer</td>
                                </tr>
                            </table>
                            <span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
                                <img src="'.base_url().'assets/images/signatures/'.$fo_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                            </span>
                        </div>';
                    endif;
                    
                    if($hod_rm_dfn || $df_remarks || $fwd_rm_ado):
                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position: relative">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <th colspan="4" style="border: 1px solid #000; background-color: #000; color: #fff;">FINANCE DEPARTMENT</th>
                                </tr>';
                                if($fwd_rm_dfn):
                                    echo '<tr>
                                        <td colspan="4"><strong>Forwarded to '.$fwd_rm_dfn->emp_name.' ('.$fwd_rm_dfn->designation.') for '.$fwd_rm_dfn->msd_forwarded_for.'</strong>
                                        <br>Date: '.date('d-m-Y', strtotime($fwd_rm_dfn->msd_date)).'</td>
                                    </tr>';
                                endif;
                                if($hod_rm_dfn):
                                    echo '<tr>
                                        <td colspan="3"><strong>Remarks by '.$hod_rm_dfn->emp_name.':</strong> '.$hod_rm_dfn->msd_comments.'</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="border-bottom: 1px solid #000;">Date: '.$hod_rm_dfn->msd_date.'</td>
                                        <td width="50%" style="border-bottom: 1px solid #000;"></td>
                                        <td width="10%" style="border-bottom: 1px solid #000;"></td>
                                        <td width="15%" style="border-bottom: 1px solid #000; text-align: right; padding-right: 10px; position:relative">Signature
                                        <span style="position:absolute; bottom: 15px; right: 10px; z-index:99999">
                                            <img src="'.base_url().'assets/images/signatures/'.$hod_rm_dfn->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                                        </span>
                                        </td>
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
                                        <td width="25%" style="vertical-align: top;" height="50">Remarks:</td>
                                        <td colspan="2" style="vertical-align: top;">'.$df_remarks->msd_comments.'</td>
                                        <td width="15%"></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="vertical-align: bottom;">Dated: '.date( 'd-m-Y', strtotime($df_remarks->msd_date)).'</td>
                                        <td width="50%" style="vertical-align: bottom; font-size: 18px;"><strong><i>'.$rec_des.'</i></strong></td>
                                        <td colspan="2" style="vertical-align: bottom; text-align: right; padding-right: 10px;">Director Finance</td>
                                    </tr>';
                                endif;
                            echo '</table>';
                            if(@$df_remarks->msd_status == 9):
                                echo '<span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
                                    <img src="'.base_url().'assets/images/signatures/'.@$df_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                                </span>';
                            endif;
                        echo '</div>';
                    endif;
                    
                    if($fwd_rm_vp || $vp_remarks || $hod_rm_vp):
                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position:relative">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <th colspan="4" style="border: 1px solid #000; background-color: #000; color: #fff;">CONEVENER PURCHASE COMMITTEE</th>
                                </tr>';
                                if($fwd_rm_vp):
                                    echo '<tr>
                                        <td colspan="4"><strong>Forwarded to '.$fwd_rm_vp->emp_name.' ('.$fwd_rm_vp->designation.') for '.$fwd_rm_vp->msd_forwarded_for.'</strong>
                                        <br>Date: '.date('d-m-Y', strtotime($fwd_rm_vp->msd_date)).'</td>
                                    </tr>';
                                endif;
                                if($hod_rm_vp):
                                    echo '<tr>
                                        <td colspan="3"><strong>Remarks by '.$hod_rm_vp->emp_name.':</strong> '.$hod_rm_vp->msd_comments.'</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="border-bottom: 1px solid #000;">Date: '.$hod_rm_vp->msd_date.'</td>
                                        <td width="50%" style="border-bottom: 1px solid #000;"></td>
                                        <td width="10%" style="border-bottom: 1px solid #000;"></td>
                                        <td width="15%" style="border-bottom: 1px solid #000; text-align: right; padding-right: 10px; position:relative">Signature
                                        <span style="position:absolute; bottom: 15px; right: 10px; z-index:99999">
                                            <img src="'.base_url().'assets/images/signatures/'.$hod_rm_vp->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                                        </span>
                                        </td>
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
                                    <td width="50%" style="border-top: none;">'.$vp_remarks->mspt_type.'</td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td width="25%" style="vertical-align: top;" height="40">Remarks:</td>
                                    <td colspan="2" style="vertical-align: top;">'.$vp_remarks->msd_comments.'</td>
                                    <td width="15%"></td>
                                </tr>
                                <tr>
                                    <td width="25%" style="vertical-align: bottom;">Dated: '.date( 'd-m-Y', strtotime($vp_remarks->msd_date)).'</td>
                                    <td colspan="3" style="vertical-align: bottom;">
                                        <strong style="font-size:18px;"><i>'.$rec_des.'</i></strong><span style="float: right; padding-right: 10px;">Convener Purchase Committiee</span>
                                    </td>
                                </tr>';
                                endif;
                            echo '</table>';
                            if($vp_remarks):
                                echo '<span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
                                    <img src="'.base_url().'assets/images/signatures/'.$vp_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
                                </span>';
                            endif;
                        echo '</div>';
                    endif;
                    
                    if($vp_remarks):
                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position:relative">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <th colspan="4" style="border: 1px solid #000; background-color: #000; color: #fff;">PRINCIPAL FOR APPROVAL</th>
                                </tr>
                                <tr>
                                    <td width="25%" style="vertical-align: top;" height="60">Principal Remarks:</td>
                                    <td colspan="3" style="vertical-align: top;"><strong></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Date: ___________________</td>
                                    <td colspan="2" style="vertical-align: bottom; text-align: right; padding-right: 10px;">Signature: __________________</td>
                                </tr>
                            </table>
                        </div>
                        <p>Approve ID: ________________</p>  
                        <p>&nbsp;</p><hr>';  
                    endif;
//                    if($pr_remarks):
//                        switch ($pr_remarks->msd_status):
//                            case 13: $color = 'green';  break;
//                            case 14: $color = 'red';    break;
//                            case 15: $color = 'blue';   break;
//                        endswitch;
//                        echo '<div style="border: 1px solid #000; margin-bottom: 5px; position:relative">
//                            <table width="100%" cellspacing="0">
//                                <tr>
//                                    <th colspan="2" style="border: 1px solid #000; background-color: #000; color: #fff;">PRINCIPAL FOR APPROVAL</th>
//                                </tr>
//                                <tr>
//                                    <td style="vertical-align: top;" height="70">Principal Remarks:</td>
//                                    <td style="vertical-align: top;"><strong>'.$pr_remarks->msd_comments.'</strong></td>
//                                </tr>
//                                <tr>
//                                    <td colspan="2" style="border-top: none; color: '.$color.'; font-size: 28px; text-align:center;"><strong>'.strtoupper($pr_remarks->mss_title).'</strong></td>
//                                </tr>
//                                <tr>
//                                    <td colspan="2" style="vertical-align: bottom; text-align: right; padding-right: 10px;">Principal</td>
//                                </tr>
//                            </table>
//                            <span style="position:absolute; bottom: 10px; right: 25px; z-index:99999">
//                                <img src="'.base_url().'assets/images/signatures/'.$pr_remarks->hod_ms_signature.'" style="max-width:80px; max-height:75px;">
//                            </span>
//                        </div>';
//                    endif;
                    
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
 
 