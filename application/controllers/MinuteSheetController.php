<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
//require_once APPPATH."third_party\PHPExcel.php"; 

class MinuteSheetController extends AdminController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct() {
        parent::__construct();
        $this->load->model('CRUDModel');
        $this->load->model('MinuteSheetModel');
        $this->load->library("pagination");
        $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
    }
    
    public function notification_in_header(){
        
        //HOD Notification
        $hod_notify = count($this->CRUDModel->get_ms_info_where_in(array('msr_user_id' => $this->input->post('user_id')), 'msr_curr_status', array(6,11)));
        $hod_recmnd = count($this->CRUDModel->get_ms_detail_where_in(array('msd_fwd_hod_id' => $this->input->post('emp_id')), 'msr_curr_status', array(3,8)));
        $thod       = $hod_recmnd + $hod_notify;

        //Admin Officer Notification
        $ado_notify = count($this->CRUDModel->get_ms_info(array('msr_curr_status' => 1)));
        $ado_recmnd = count($this->CRUDModel->get_ms_info(array('msr_curr_status' => 4)));
        $tado       = $ado_notify + $ado_recmnd;

        //Finance Officer Notification
        $fno_notify = count($this->CRUDModel->get_ms_info(array('msr_curr_status' => 5)));

        //Director Finance Notification
        $df_notify = count($this->CRUDModel->get_ms_info(array('msr_curr_status' => 7)));

        //VP Acadmeic Notification
        $vpac_notify = count($this->CRUDModel->get_ms_info(array('msr_curr_status' => 9)));

        //VP Admin Notification
        $vpad_notify = count($this->CRUDModel->get_ms_info(array('msr_curr_status' => 10)));

        //Principal Notification
        $pr_notify = count($this->CRUDModel->get_ms_info(array('msr_curr_status' => 12)));

        switch ($this->input->post('grp_id')):
            case 24:
                if($tado > 0):
                    echo '<a href="MinuteSheetRecordADO">
                        <button type="button" class="btn btn-danger blinking">Notifications ('.$tado.')</button>
                    </a>';
                endif;
            break;
            case 35:
                if($fno_notify > 0):
                    echo '<a href="MinuteSheetRecordFNO">
                        <button type="button" class="btn btn-danger blinking">Notifications ('.$fno_notify.')</button>
                    </a>';
                endif;
            break;
            case 31:
                if($df_notify > 0):
                    echo '<a href="MinuteSheetRecordDFN">
                        <button type="button" class="btn btn-danger blinking">Notifications ('.$df_notify.')</button>
                    </a>';
                endif;
            break;
            case 33:
                if($vpac_notify > 0):
                    echo '<a href="MinuteSheetRecordVPAC">
                        <button type="button" class="btn btn-danger blinking">Notifications ('.$vpac_notify.')</button>
                    </a>';
                endif;
            break;
            case 36:
                if($vpad_notify > 0):
                    echo '<a href="MinuteSheetRecordVPAD">
                        <button type="button" class="btn btn-danger blinking">Notifications ('.$vpad_notify.')</button>
                    </a>';
                endif;
            break;
            case 43:
                if($pr_notify > 0):
                    echo '<a href="MinuteSheetRecordPrincipal">
                        <button type="button" class="btn btn-danger blinking">Notifications ('.$pr_notify.')</button>
                    </a>';
                endif;
            break;
            default :
                if($thod > 0):
                    echo '<a href="MinuteSheetRecord">
                        <button type="button" class="btn btn-danger blinking">Notifications ('.$thod.')</button>
                    </a>';
                endif;
        endswitch;
        
    }
    
    public function minute_sheet_record(){
        
//        $hod = $this->CRUDModel->get_where_row('hr_emp_record', array('emp_id' => $this->userInfo->emp_id, 'hod_ms_flag' => 1));
//        if(!empty($hod)):
            $this->data['ReportName']   = 'Minute Sheet HOD Panel';
            $this->data['page_title']   = 'Minute Sheet | ECP';
            $this->data['page']         = 'minutesheet/minute_sheet_record';
            $this->load->view('common/common',$this->data);
//        else:
//            redirect('restricted');
//        endif;
        
    }
    
    public function minute_sheet_grid(){
        
        
        $detail = $this->input->post('detail');
        $like   = '';
        $where  = array('msr_user_id' => $this->userInfo->user_id);
        
        $notify = $this->MinuteSheetModel->get_ms_info_where_in($where, $like, 'msr_curr_status', array(1,6,11));
        $recmnd = $this->MinuteSheetModel->get_ms_detail_where_in(array('msd_fwd_hod_id'=>$this->userInfo->emp_id), $like, 'msr_curr_status', array(3,8));
        
        if(empty($detail)):
            $result = $this->MinuteSheetModel->get_ms_info_where_in_limit($where, $like, 'msr_curr_status', array(2,3,4,5,7,8,9,10,12,13,14,15));
        else:
            $like['msr_detail'] = $detail;
            $this->data['msr_detail'] = $detail;
            $result = $this->MinuteSheetModel->get_ms_info_where_in($where, $like, 'msr_curr_status', array(2,3,4,5,7,8,9,10,12,13,14,15));
        endif;
        
//        echo '<pre>'; print_r($result); die;
        if(!empty($result) || !empty($notify) || !empty($recmnd)):    
            echo '<table class="table table-bordered table-boxed display" width="100%" cellspacing="0" cellpadding="0" border="0">
                <thead>
                    <tr>
                        <th width="5%">S No.</th>
                        <th width="5%">Diary No.</th>
                        <th width="10%">Minute Sheet by</th>
                        <th width="10%">Department</th>
                        <th width="35%">Details</th>
                        <th width="10%">Estimated Cost</th>
                        <th width="15%">Status</th>
                        <th width="5%">Attachment</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>';
                 
                $sno = '';
                if($recmnd):   
                    foreach($recmnd as $recrow):
                        $sno++;
                        echo '<tr style="background-color: #ffffe9">
                            <th>'.$sno.'</th>
                            <th>'.$recrow->msr_diary_no.'</th>
                            <th>'.$recrow->emp_name.'</th>
                            <th>'.$recrow->deptt_name.'</th>
                            <th>'.$recrow->msr_detail.'</th>
                            <th>'.$recrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$recrow->msr_curr_status));
                                if(!empty($cs)):
                                    echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endif;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$recrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$recrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                                <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$recrow->msr_id.'">
                                    <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                </a> 
                                <a href="MinureSheetPrint/'.$recrow->msr_id.'" target="_blank" class="view_ms_btn">
                                    <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                </a> 
                                <a href="MinuteSheetHODComments/'.$recrow->msr_id.'"><button type="button" class="btn btn-warning form-control" style="margin:1px;" id="edit_ms">REVIEW</button></a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                
                if($notify):    
//                    $sno = '';
                    foreach($notify as $msnfrow):
                        $sno++;
                        echo '<tr style="background-color: #fffafa ">
                            <th>'.$sno.'</th>
                            <th>'.$msnfrow->msr_diary_no.'</th>
                            <th>'.$msnfrow->emp_name.'</th>
                            <th>'.$msnfrow->deptt_name.'</th>
                            <th>'.$msnfrow->msr_detail.'</th>
                            <th>'.$msnfrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msnfrow->msr_curr_status));
                                if(!empty($cs)):
                                    echo '<strong style="color: #C00; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endif;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msnfrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msnfrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                                <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msnfrow->msr_id.'">
                                    <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                </a> 
                                <a href="MinureSheetPrint/'.$msnfrow->msr_id.'" target="_blank" class="view_ms_btn">
                                    <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                </a> 
                                <a href="MinuteSheetEdit/'.$msnfrow->msr_id.'"><button type="button" class="btn btn-warning form-control" style="margin:1px;" id="edit_ms">EDIT</button></a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                
                if($result):   
                    foreach($result as $msrow):
                        $sno++;
                        echo '<tr style="background-color:  #f3fbff  ">
                            <th>'.$sno.'</th>
                            <th>'.$msrow->msr_diary_no.'</th>
                            <th>'.$msrow->emp_name.'</th>
                            <th>'.$msrow->deptt_name.'</th>
                            <th>'.$msrow->msr_detail.'</th>
                            <th>'.$msrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msrow->msr_curr_status));
                                switch ($cs->mss_id):
                                    case 2:  echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 13: echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 14: echo '<strong style="color: #c00; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 15: echo '<strong style="color: #ff7400; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    default: echo '<strong style="color: #428bca; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endswitch;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                            <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msrow->msr_id.'">
                                <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                            </a> 
                            <a href="MinureSheetPrint/'.$msrow->msr_id.'" target="_blank" class="view_ms_btn">
                                <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                            </a> 
                            </th>
                        </tr>';
                    endforeach;
                endif;
                echo '</tbody>
            </table>';
        else:
            echo '<h3 class="has-divider text-highlight" style="color:#c00;">No Result Found</h3>';  
        endif;
        
        ?><script>
        
        $(document).ready(function(){
            $('.view_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_preview',
                   data   : data,
                   success: function(result){
                       $('#view_modal_content').html(result);
                   }
               });
            });
            $('.att_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_att_view',
                   data   : data,
                   success: function(result){
                       $('#att_modal_content').html(result);
                   }
               });
            });
        });
        
        </script><?php
        
    }
     
    public function minute_sheet_preview(){
        
        $minsht_id = $this->input->post('min_id');
        
        $msv        = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$minsht_id));
        $hod_rm_ado = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$minsht_id, 'msd_status'=> 4));
        $ao_remarks = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$minsht_id, 'msd_status'=> 5));
        $fo_remarks = $this->MinuteSheetModel->get_fno_remarks(array('msbg_msr_id'=>$minsht_id));
        $hod_rm_dfn = $this->MinuteSheetModel->get_hod_remarks(array('msd_msr_id'=>$minsht_id, 'msd_status'=> 7));
        $df_remarks = $this->CRUDModel->get_wherein_row('min_sheet_details', array('msd_msr_id'=>$minsht_id), 'msd_status', array(9,10));
        $vp_remarks = $this->MinuteSheetModel->get_vp_remarks(array('msd_msr_id'=>$minsht_id, 'msd_status'=> 12));
        $pr_remarks = $this->MinuteSheetModel->get_principal_remarks(array('msd_msr_id'=>$minsht_id), 'msd_status', array(13,14,15));
        
        $cm = $this->CRUDModel->money_convert($msv->msr_cost);
        
        echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            <p style="text-align:center">
                <strong>EDWARDES COLLEGE PESHAWAR<br>
                <span style="font-size:18px;"><u>MINUTE SHEET</u></span></strong>
            </p>
        </div>
        <div class="modal-body">
            <div style="border: 1px solid #000;margin-bottom: 5px; ">
                <table>
                    <tr>
                        <td width="10%" style="padding-left: 5px;">FROM:</td>
                        <th width="30%">'.$msv->emp_name.'</th>
                        <td width="10%" style="border-left: 1px solid #000; padding-left: 5px;">DEPARTMENT:</td>
                        <th width="30%">'.$msv->deptt_name.'</th>
                        <td width="10%" style="border-left: 1px solid #000; padding-left: 5px;">DATE:</td>
                        <th width="10%">'.date('d-m-Y', strtotime($msv->msr_date)).'</th>
                    </tr>
                </table>
                <table class="table" cellspacing="0" width="100%" height="75" >
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
                        <th width="55%">'.$cm.'</th>
                    </tr>
                </table>
            </div>';

            if($hod_rm_ado || $ao_remarks):
                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                    <table class="table" width="100%" cellspacing="0">
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
                            <td style="vertical-align: top;" height="70">Budget Report:</td>
                            <td style="vertical-align: top;" colspan="3"><strong>'.$fo_remarks->msbg_comments.'</strong></td>
                        </tr>
                    </table>
                </div>';
            endif;

            if($hod_rm_dfn || $df_remarks):
                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                    <table class="table" width="100%" cellspacing="0">
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
                            echo '<tr>
                                <td style="vertical-align: top;" height="70" width="25%">Director Finance Remarks:</td>
                                <td style="vertical-align: top; text-align:left;"><strong>'.$df_remarks->msd_comments.'</strong></td>
                            </tr>';
                        endif;
                    echo '</table>
                </div>';
                if($df_remarks->msd_status == 9):
                    $vpt = 'Vice Principal-1';
                else:
                    $vpt = 'Vice Principal-2';
                endif;
            endif;

            if($vp_remarks):
                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                    <table class="table" width="100%" cellspacing="0">
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
                    </table>
                </div>';
            endif;

            if($pr_remarks):
                switch ($pr_remarks->msd_status):
                    case 13: $color = 'green';  break;
                    case 14: $color = 'red';    break;
                    case 15: $color = 'blue';   break;
                endswitch;
                echo '<div style="border: 1px solid #000; margin-bottom: 5px;">
                    <table class="table" width="100%" cellspacing="0">
                        <tr>
                            <th colspan="2" style="border: 1px solid #000; background-color: #000; color: #fff;">PRINCIPAL FOR APPROVAL</th>
                        </tr>
                        <tr>
                            <td width="25%" style="border-top: none;">Status:</td>
                            <td style="border-top: none; color: '.$color.'; font-size: 14px;"><strong>'.strtoupper($pr_remarks->mss_title).'</strong></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;" height="70">Principal Remarks:</td>
                            <td style="vertical-align: top;"><strong>'.$pr_remarks->msd_comments.'</strong></td>
                        </tr>
                    </table>
                </div>';
            endif;
        echo '</div>';
        
    }
    
    public function minute_sheet_att_view(){
        
        $minsht_id = $this->input->post('min_id');
        $msav = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$minsht_id));
        echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            <h4 style="text-align:center"><strong>Attachment List</strong></h4>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th width="10%">S No.</th>
                    <th width="75%">Attachment</th>
                    <th width="15%">Download</th>
                </tr>';
                $sn = '';
                foreach($msav as $attch):
                    $sn++;
                    echo '<tr>
                    <td>'.$sn.'</td>
                    <td>'.$attch->msa_file.'</td>
                    <td>
                        <a href="assets/images/min_sheet_attach/'.$attch->msa_file.'" target="_blank"><button type="button" class="btn btn-danger">Download</button></a>
                    </td>
                </tr>';
                endforeach;
            echo '</table>
        </div>';
            
    }    
    
    public function minute_sheet_initiate(){
        
//        $hod = $this->CRUDModel->get_where_row('hr_emp_record', array('emp_id' => $this->userInfo->emp_id, 'hod_ms_flag' => 1));
//        if(!empty($hod)):
            $this->data['emp_detail']   = $this->MinuteSheetModel->get_user_info(array('id'=>$this->userInfo->user_id));
            $this->data['ReportName']   = 'Minute Sheet';
            $this->data['page_title']   = 'Minute Sheet | ECP';
            $this->data['page']         = 'minutesheet/minute_sheet_form';
            $this->load->view('common/common',$this->data);
//        else:
//            redirect('restricted');
//        endif;
      
    }
     
    public function convert_money(){
        
        $cm = $this->CRUDModel->money_convert($this->input->post('cost'));
        echo strtoupper($cm);
        
    }
    
    public function minute_sheet_save(){
        
        $return_json = '';
        if(!empty($this->input->post('details'))):
            $ins_arr = array(
                'msr_emp_id'        => $this->input->post('initiator_id'),
                'msr_init_deptt'    => $this->input->post('department_id'),
                'msr_detail'        => strtoupper($this->input->post('details')),
                'msr_cost'          => $this->input->post('cost_num'),
                'msr_curr_status'   => 1,
                'msr_date'          => date('Y-m-d'),
                'msr_datetime'      => date('Y-m-d H:i:s'),
                'msr_user_id'       => $this->userInfo->user_id
            );
            $id = $this->CRUDModel->insert('min_sheet', $ins_arr);
            $fy = $this->CRUDModel->get_where_row('financial_year', array('fn_account_type_id' => 1, 'status' => 1));
            $upd_arr = array(
                'msr_diary_no' => $fy->year.'/'.sprintf("%03d", $id)
            );
            $this->CRUDModel->update('min_sheet', $upd_arr, array('msr_id'=>$id));
            
            $this->CRUDModel->update('min_sheet_attachments', array('msa_msr_id'=>$id), array('msa_form_code'=>$this->input->post('form_code')));
            
            $return_json = array(
                'save'  => true,
                'ms_id' => $id
            );
        endif;
        
        echo json_encode($return_json);
        
    }
    
    public function add_minute_sheet_attachment(){
    
        $return_json    = '';
        
        // Upload Multiple Images
        $config['upload_path']   = "assets/images/min_sheet_attach";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|tif|doc|docx|xls|xlsx|pdf|ppt|pptx';
        $this->load->library('upload',$config);


        $dataInfo = array();
        $files    = $_FILES;
        $cpt      = count($_FILES['image_file']['name']);
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['image_file']['name']= $files['image_file']['name'][$i];
            $_FILES['image_file']['type']= $files['image_file']['type'][$i];
            $_FILES['image_file']['tmp_name']= $files['image_file']['tmp_name'][$i];
            $_FILES['image_file']['error']= $files['image_file']['error'][$i];
            $_FILES['image_file']['size']= $files['image_file']['size'][$i];    

            if($this->upload->do_upload("image_file")){
                $dataInfo[] = $this->upload->data();
                $return_json['insert'] = true;
            }
            else {
                $return_json['insert'] = false;
            }
        }
        
        foreach ($dataInfo as $value):
            $img_data = array(
                'msa_form_code' => $this->input->post('form_code'), 
                'msa_file'      => $value['file_name']
                );
            $this->CRUDModel->insert('min_sheet_attachments', $img_data);
        endforeach;
            
        echo json_encode($return_json);
    }
    
    public function add_minute_sheet_attachment_edit(){
    
//        echo '<pre>'; print_r($this->input->post()); die;
        $return_json    = '';
        
        // Upload Multiple Images
        $config['upload_path']   = "assets/images/min_sheet_attach";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|tif|doc|docx|xls|xlsx|pdf|ppt|pptx';
        $this->load->library('upload',$config);


        $dataInfo = array();
        $files    = $_FILES;
        $cpt      = count($_FILES['image_file']['name']);
        for($i=0; $i<$cpt; $i++) {      
            
            $_FILES['image_file']['name']       = $files['image_file']['name'][$i];
            $_FILES['image_file']['type']       = $files['image_file']['type'][$i];
            $_FILES['image_file']['tmp_name']   = $files['image_file']['tmp_name'][$i];
            $_FILES['image_file']['error']      = $files['image_file']['error'][$i];
            $_FILES['image_file']['size']       = $files['image_file']['size'][$i];    

            if($this->upload->do_upload("image_file")){
                $dataInfo[] = $this->upload->data();
                $return_json['insert'] = true;
            }
            else {
                $return_json['insert'] = false;
            }
        }
        
        foreach ($dataInfo as $value):
            $img_data = array(
                'msa_msr_id' => $this->input->post('min_id'), 
                'msa_file'   => $value['file_name']
            );
            $this->CRUDModel->insert('min_sheet_attachments', $img_data);
        endforeach;
            
        echo json_encode($return_json);
    }
    
//    public function add_minute_sheet_attachment(){
//    
//        $ms_id = $this->input->post('ms_id');
//        
//        $config['upload_path']   = "assets/images/min_sheet_attach";
//        $config['allowed_types'] = 'bmp|jpg|png|jpeg|JPG';
//        $config['file_name']     = $ms_id.'_MSA_'.date('ymd');
//        $this->load->library('upload',$config);
//        
//        if($this->upload->do_upload("image_file")){
//            
//            $data       = array('upload_data' => $this->upload->data());
//            $ins_arr    = array(
//                'msa_msr_id'    => $ms_id,
//                'msa_file'      => $data['upload_data']['file_name'],
//                'msa_datetime'  => date('Y-m-d H:i:s'),
//            );  
//            $newPic = $data['upload_data']['file_name'];
//            if(!empty($newPic)):
//                $this->CRUDModel->insert('min_sheet_attachments', $ins_arr);
//            endif;
//       
//        }
//    }
//    
    public function minute_sheet_attch_grid(){
        
        $formCode   = $this->input->post('form_code');
        
        $result = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_form_code'=>$formCode));
        if($result):
            echo '<div class="section">
                <div class="col-md-12">
                    <div class="row">';
                    foreach($result as $rec):
                        $f_ext = pathinfo($rec->msa_file); 
                        echo '<div class="col-md-3 col-sm-6" style="border: 1px solid #ccc; padding: 10px;">
                            <div style="text-align: center">';
                        
                            switch ($f_ext['extension']):
                                case 'doc':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'docx':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'xls':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'xlsx':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'ppt':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/ppt.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'pptx':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/pptx.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'pdf':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/pdf.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                default:
                                    echo '<img src="assets/images/min_sheet_attach/'.$rec->msa_file.'" style="max-width: 200px; max-height:200px;">';
                            endswitch;
                            
                                echo '<div class="col-12" style="padding: 10px;">
                                    <button type="button" class="btn btn-danger dlt_attch" name="dlt_attch" id="'.$rec->msa_id.'">Remove</button>
                                </div>
                            </div>
                        </div>';
                    endforeach;
                    echo '</div>
                </div>
            </div>';
                  
        endif;
        
        ?>
        <script>
            $(document).ready(function(){
                $('.dlt_attch').on('click',function(){
                    var data = { 'dlt_id' : $(this).attr('id') };
                    $.ajax({
                        type   :'post',
                        url    :'MinuteSheetController/delete_attachment',
                        data   : data,
                        success :function(result){
                           window.location.reload();
                        }
                    });
                });
            });
            
        </script>
        <?php
        
    }
    
    public function minute_sheet_attch_edit_grid(){
        
        $min_id   = $this->input->post('min_id');
        
        $result = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$min_id));
        if($result):    
            echo '<div class="section">
                <div class="col-md-12">
                    <div class="row">';
                    foreach($result as $rec):
                        $f_ext = pathinfo($rec->msa_file); 
                        echo '<div class="col-md-3 col-sm-6" style="border: 1px solid #ccc; padding: 10px;">
                            <div style="text-align: center">';
                        
                            switch ($f_ext['extension']):
                                case 'doc':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'docx':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'xls':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'xlsx':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'ppt':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/ppt.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'pptx':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/pptx.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                case 'pdf':
                                    echo '<div style="height: 200px;text-align:center">
                                        <img src="assets/images/file_icons/pdf.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                        <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                    </div>';
                                    break;
                                default:
                                    echo '<img src="assets/images/min_sheet_attach/'.$rec->msa_file.'" style="max-width: 200px; max-height:200px;">';
                            endswitch;
                            
                                echo '<div class="col-12" style="padding: 10px;">
                                    <button type="button" class="btn btn-danger dlt_attch" name="dlt_attch" id="'.$rec->msa_id.'">Remove</button>
                                </div>
                            </div>
                        </div>';
                    endforeach;
                    echo '</div>
                </div>
            </div>';
                  
        endif;
        
        ?>
        <script>
            $(document).ready(function(){
                $('.dlt_attch').on('click',function(){
                    var data = { 'dlt_id' : $(this).attr('id') };
                    $.ajax({
                        type   :'post',
                        url    :'MinuteSheetController/delete_attachment',
                        data   : data,
                        success :function(result){
                           window.location.reload();
                        }
                    });
                });
            });
            
        </script>
        <?php
        
    }
    
    public function delete_attachment(){
    
        $id     = $this->input->post('dlt_id');
        $where  = array( 'msa_id' => $id );

        $dlt    = $this->CRUDModel->get_where_row('min_sheet_attachments', $where);
        $this->CRUDModel->deleteid('min_sheet_attachments', $where);
        
        $path   = 'assets/images/min_sheet_attach/'.$dlt->msa_file;
        
        if(file_exists($path)):
            unlink($path);
        endif;
        
    }
    
    public function edit_minute_sheet(){
        
        $ms_id = $this->uri->segment(2);
        
        $this->data['ms_detail']    = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$ms_id));
//        echo '<pre>'; print_r($this->data['ms_detail']); die;
        
        $this->data['ReportName']   = 'Minute Sheet Edit';
        $this->data['page_title']   = 'Minute Sheet Edit | ECP';
        $this->data['page']         = 'minutesheet/minute_sheet_edit_form';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function update_minute_sheet(){
        
        $m_id   = $this->input->post('min_id');
        $detail = $this->input->post('details');
        $cost   = $this->input->post('cost_num');
        $status = $this->input->post('status_id');
        
        $where  = array('msr_id' => $m_id);
        $o_ms   = $this->CRUDModel->get_where_row('min_sheet', $where);
        
        $upd_arr = array(
            'msr_detail'    => strtoupper($this->input->post('details')),
            'msr_cost'      => $this->input->post('cost_num'),
            'msr_user_id'   => $this->userInfo->user_id
        );
        $this->CRUDModel->update('min_sheet', $upd_arr, $where);
        
        if($detail != $o_ms->msr_detail || $cost != $o_ms->msr_cost):
            if($status == 1):
                $log_arr = array(
                    'msr_id'            => $o_ms->msr_id,
                    'msr_diary_no'      => $o_ms->msr_diary_no,
                    'msr_emp_id'        => $o_ms->msr_emp_id,
                    'msr_init_deptt'    => $o_ms->msr_init_deptt,
                    'msr_detail'        => $o_ms->msr_detail,
                    'msr_cost'          => $o_ms->msr_cost,
                    'msr_curr_status'   => $o_ms->msr_curr_status,
                    'msr_date'          => $o_ms->msr_date,
                    'msr_datetime'      => $o_ms->msr_datetime,
                    'log_timestamp'     => date('Y-m-d H:i:s'),
                    'msr_user_id'       => $o_ms->msr_user_id,
                );
            else:
                $log_arr = array(
                    'msr_id'            => $o_ms->msr_id,
                    'msr_diary_no'      => $o_ms->msr_diary_no,
                    'msr_emp_id'        => $o_ms->msr_emp_id,
                    'msr_init_deptt'    => $o_ms->msr_init_deptt,
                    'msr_detail'        => $o_ms->msr_detail,
                    'msr_cost'          => $o_ms->msr_cost,
                    'msr_curr_status'   => $o_ms->msr_curr_status,
                    'msr_date'          => $o_ms->msr_date,
                    'msr_datetime'      => $o_ms->msr_datetime,
                    'log_timestamp'     => date('Y-m-d H:i:s'),
                    'msr_user_id'       => $o_ms->msr_user_id,
                    'msr_revert_flag'   => 1,
                    'msr_revert_status' => $status,
                );
                
                if($status == 6):
                    $this->CRUDModel->update('min_sheet', array('msr_curr_status' => 1), array('msr_id' => $m_id));
                else:
                    $this->CRUDModel->update('min_sheet', array('msr_curr_status' => 7), array('msr_id' => $m_id));
                endif;
            
            endif;
            $this->CRUDModel->insert('min_sheet_log', $log_arr);
        endif;
        redirect('MinuteSheetRecord');
            
    }
    
    public function ado_minute_sheet_record(){
        
            $this->data['department']   = $this->CRUDModel->dropDown_asc_title('department', 'Select', 'department_id', 'title');
            $this->data['min_sheet_by'] = $this->CRUDModel->dropDown_asc_title('hr_emp_record', 'Select', 'emp_id', 'emp_name');
            $this->data['ms_status']    = $this->CRUDModel->dropDown_where_not_in('min_sheet_status', 'Select', 'mss_id', 'mss_title', 'mss_id', array(1,4), '');
            $this->data['ReportName']   = 'Minute Sheet Admin Officer Panel';
            $this->data['page_title']   = 'Minute Sheet | ECP';
            $this->data['page']         = 'minutesheet/ado_minute_sheet_record';
            $this->load->view('common/common',$this->data);
        
    }
    
    public function ado_minute_sheet_grid(){
        
        $m_diary_no = $this->input->post('ms_diary_no');
        $dept_id    = $this->input->post('dept_id');
        $ms_by_id   = $this->input->post('ms_by_id');
        $detail     = $this->input->post('detail');
        $stts_id    = $this->input->post('stts_id');
        
        $like   = '';
        $where  = '';
        
        $notify = $this->MinuteSheetModel->get_ms_info(array('msr_curr_status'=>1), $like);
        $recmnd = $this->MinuteSheetModel->get_ms_info(array('msr_curr_status'=>4), $like);
        
        $empty  = $m_diary_no.$dept_id.$ms_by_id.$detail.$stts_id;
        if(empty($empty)):
            $result = $this->MinuteSheetModel->get_ms_info_where_in_limit($where, $like, 'msr_curr_status', array(2,3,5,6,7,8,9,10,11,12,13,14,15));
        else:
            if(!empty($m_diary_no)): $where['msr_diary_no']     = $m_diary_no;  endif;
            if(!empty($dept_id)):    $where['msr_init_deptt']   = $dept_id;     endif;
            if(!empty($ms_by_id)):   $where['msr_emp_id']       = $ms_by_id;    endif;
            if(!empty($detail)):     $like['msr_detail']        = $detail;      endif;
            if(!empty($stts_id)):    $where['msr_curr_status']  = $stts_id;     endif;
            $result = $this->MinuteSheetModel->get_ms_info_where_in($where, $like, 'msr_curr_status', array(2,3,5,6,7,8,9,10,11,12,13,14,15));
        endif;
//        echo '<pre>'; print_r($result); die;
        if(!empty($result) || !empty($notify) || !empty($recmnd)):    
            echo '<table class="table table-bordered table-boxed display" width="100%" cellspacing="0" cellpadding="0" border="0">
                <thead>
                    <tr>
                        <th width="5%">S No.</th>
                        <th width="5%">Diary No.</th>
                        <th width="10%">Minute Sheet by</th>
                        <th width="10%">Department</th>
                        <th width="35%">Details</th>
                        <th width="10%">Estimated Cost</th>
                        <th width="15%">Status</th>
                        <th width="5%">Attachment</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>';
                $sno = '';
                if($recmnd):
                    foreach($recmnd as $recrow):
                        $sno++;
                        echo '<tr style="background-color: #ffffe9 ">
                            <th>'.$sno.'</th>
                            <th>'.$recrow->msr_diary_no.'</th>
                            <th>'.$recrow->emp_name.'</th>
                            <th>'.$recrow->deptt_name.'</th>
                            <th>'.$recrow->msr_detail.'</th>
                            <th>'.$recrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$recrow->msr_curr_status));
                                if(!empty($cs)):
                                    echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endif;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$recrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$recrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                                <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$recrow->msr_id.'">
                                    <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                </a> 
                                <a href="MinureSheetPrint/'.$recrow->msr_id.'" target="_blank" class="view_ms_btn">
                                    <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                </a> 
                                <a href="MinuteSheetProcessADO/'.$recrow->msr_id.'">
                                    <button type="button" class="btn btn-warning form-control" style="margin:1px;" id="edit_ms">PROCESS</button>
                                </a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                
                if($notify):    
//                    $sno = '';
                    foreach($notify as $msnfrow):
                        $sno++;
                        echo '<tr style="background-color: #fffafa ">
                            <th>'.$sno.'</th>
                            <th>'.$msnfrow->msr_diary_no.'</th>
                            <th>'.$msnfrow->emp_name.'</th>
                            <th>'.$msnfrow->deptt_name.'</th>
                            <th>'.$msnfrow->msr_detail.'</th>
                            <th>'.$msnfrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msnfrow->msr_curr_status));
                                if(!empty($cs)):
                                    echo '<strong style="color: #C00; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endif;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msnfrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msnfrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                                <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msnfrow->msr_id.'">
                                    <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                </a> 
                                <a href="MinureSheetPrint/'.$msnfrow->msr_id.'" target="_blank" class="view_ms_btn">
                                    <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                </a> 
                                <a href="MinuteSheetProcessADO/'.$msnfrow->msr_id.'">
                                    <button type="button" class="btn btn-warning form-control" style="margin:1px;" id="edit_ms">PROCESS</button>
                                </a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                
                if($result):   
                    foreach($result as $msrow):
                        $sno++;
                        echo '<tr style="background-color:  #f3fbff  ">
                            <th>'.$sno.'</th>
                            <th>'.$msrow->msr_diary_no.'</th>
                            <th>'.$msrow->emp_name.'</th>
                            <th>'.$msrow->deptt_name.'</th>
                            <th>'.$msrow->msr_detail.'</th>
                            <th>'.$msrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msrow->msr_curr_status));
                                switch ($cs->mss_id):
                                    case 2:  echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 13: echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 14: echo '<strong style="color: #c00; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 15: echo '<strong style="color: #ff7400; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    default: echo '<strong style="color: #428bca; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endswitch; 
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                            <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msrow->msr_id.'">
                                <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                            </a> 
                            <a href="MinureSheetPrint/'.$msrow->msr_id.'" target="_blank" class="view_ms_btn">
                                <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                            </a> 
                            </th>
                        </tr>';
                    endforeach;
                endif;
                echo '</tbody>
            </table>';
        else:
            echo '<h3 class="has-divider text-highlight" style="color:#c00;">No Result Found</h3>';  
        endif;
        
        ?><script>
        
        $(document).ready(function(){
            $('.view_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_preview',
                   data   : data,
                   success: function(result){
                       $('#view_modal_content').html(result);
                   }
               });
            });
            $('.att_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_att_view',
                   data   : data,
                   success: function(result){
                       $('#att_modal_content').html(result);
                   }
               });
            });
        });
        
        </script><?php
        
    }
    
    public function ado_process_minute_sheet(){
        
        $ms_id = $this->uri->segment(2);
        
        $this->data['ms_detail']    = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$ms_id));
        $this->data['att_result']   = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$ms_id));
        $this->data['hod']          = $this->CRUDModel->employee_dropdown('hr_emp_record', 'Select', 'emp_id', 'emp_name', array('hod_ms_flag'=>1, 'emp_id !='=>$this->data['ms_detail']->msr_emp_id));
//        echo '<pre>'; print_r($this->data['ms_detail']); die;
        
        $this->data['ReportName']   = 'Minute Sheet';
        $this->data['page_title']   = 'Minute Sheet | ECP';
        $this->data['page']         = 'minutesheet/ado_minute_sheet_form';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function get_department(){
        
        $return_json = '';
        
        $e_id = $this->input->post('empId');
        
        $result = $this->MinuteSheetModel->get_curr_deptt(array('emp_id' => $e_id));
        
        $return_json = array(
            'deptt_id'      => $result->deptt_id,
            'deptt_name'   => $result->deptt_name
        );
        
        echo json_encode($return_json);
    }
    
    public function ado_update_minute_sheet(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $case   = $this->input->post('case_id');
        $msid   = $this->input->post('min_sht_id');
        $detail = $this->input->post('details');
        $deptt  = $this->input->post('deptt_id');
        $hod    = $this->input->post('hod_id');
        $ao_arr = '';
        
        if(!empty($case)):
            
            switch($case):
                case '3':
                    $ao_arr = array(
                        'msd_msr_id'        => $msid,
                        'msd_status'        => $case,
                        'msd_fwd_hod_id'    => $hod,
                        'msd_fwd_deptt_id'  => $deptt,
                        'msd_step'          => 2,
                        'msd_date'          => date('Y-m-d'),
                        'msd_datetime'      => date('Y-m-d H:i:s'),
                        'msd_user_id'       => $this->userInfo->user_id,
                    );
                    $this->CRUDModel->insert('min_sheet_details', $ao_arr);
                    break;
                case '5':
                    $ao_arr = array(
                        'msd_msr_id'    => $msid,
                        'msd_status'    => $case,
                        'msd_comments'  => strtoupper($detail),
                        'msd_step'      => 2,
                        'msd_date'      => date('Y-m-d'),
                        'msd_datetime'  => date('Y-m-d H:i:s'),
                        'msd_user_id'   => $this->userInfo->user_id,
                    );
                    $this->CRUDModel->insert('min_sheet_details', $ao_arr);
                    break;
                case '6':
                    $ao_arr = array(
                        'msd_msr_id'    => $msid,
                        'msd_status'    => $case,
                        'msd_step'      => 2,
                        'msd_date'      => date('Y-m-d'),
                        'msd_datetime'  => date('Y-m-d H:i:s'),
                        'msd_user_id'   => $this->userInfo->user_id,
                    );
                    $this->CRUDModel->insert('min_sheet_details', $ao_arr);
                    break;
            endswitch;
            $this->CRUDModel->update('min_sheet', array('msr_curr_status'=>$case), array('msr_id' => $msid));
            
        endif;
        
    }
    
    public function fno_minute_sheet_record(){
        
            $this->data['ReportName']   = 'Minute Sheet Finance Officer Panel';
            $this->data['page_title']   = 'Minute Sheet | ECP';
            $this->data['page']         = 'minutesheet/fno_minute_sheet_record';
            $this->load->view('common/common',$this->data);
        
    }
    
    public function fno_minute_sheet_grid(){
        
        $detail = $this->input->post('detail');
        $like   = '';
        $where  = '';
        
        $notify = $this->MinuteSheetModel->get_ms_info(array('msr_curr_status' => 5), $like);
        
        if(empty($detail)):
            $result = $this->MinuteSheetModel->get_ms_info_where_in_limit($where, $like, 'msr_curr_status', array(7,8,9,10,11,12,13,14,15));
        else:
            $like['msr_detail'] = $detail;
            $this->data['msr_detail'] = $detail;
            $result = $this->MinuteSheetModel->get_ms_info_where_in($where, $like, 'msr_curr_status', array(7,8,9,10,11,12,13,14,15));
        endif;
//        echo '<pre>'; print_r($result); die;
        if(!empty($result) || !empty($notify)):    
            echo '<table class="table table-bordered table-boxed display" width="100%" cellspacing="0" cellpadding="0" border="0">
                <thead>
                    <tr>
                        <th width="5%">S No.</th>
                        <th width="5%">Diary No.</th>
                        <th width="10%">Minute Sheet by</th>
                        <th width="10%">Department</th>
                        <th width="35%">Details</th>
                        <th width="10%">Estimated Cost</th>
                        <th width="15%">Status</th>
                        <th width="5%">Attachment</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>';
                 
                $sno = '';
                if($notify):   
                    foreach($notify as $msnfrow):
                        $sno++;
                        echo '<tr style="background-color: #fffafa ">
                            <th>'.$sno.'</th>
                            <th>'.$msnfrow->msr_diary_no.'</th>
                            <th>'.$msnfrow->emp_name.'</th>
                            <th>'.$msnfrow->deptt_name.'</th>
                            <th>'.$msnfrow->msr_detail.'</th>
                            <th>'.$msnfrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msnfrow->msr_curr_status));
                                if(!empty($cs)):
                                    echo '<strong style="color: #C00; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endif;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msnfrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msnfrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                                <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msnfrow->msr_id.'">
                                    <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                </a> 
                                <a href="MinureSheetPrint/'.$msnfrow->msr_id.'" target="_blank" class="view_ms_btn">
                                    <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                </a> 
                                <a href="MinuteSheetProcessFNO/'.$msnfrow->msr_id.'"><button type="button" class="btn btn-warning form-control" style="margin:1px;">PROCESS</button></a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                
                if($result):   
                    foreach($result as $msrow):
                        $sno++;
                        echo '<tr style="background-color:  #f3fbff  ">
                            <th>'.$sno.'</th>
                            <th>'.$msrow->msr_diary_no.'</th>
                            <th>'.$msrow->emp_name.'</th>
                            <th>'.$msrow->deptt_name.'</th>
                            <th>'.$msrow->msr_detail.'</th>
                            <th>'.$msrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msrow->msr_curr_status));
                                switch ($cs->mss_id):
                                    case 13: echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 14: echo '<strong style="color: #c00; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 15: echo '<strong style="color: #ff7400; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    default: echo '<strong style="color: #428bca; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endswitch; 
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                            <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msrow->msr_id.'">
                                <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                            </a> 
                            <a href="MinureSheetPrint/'.$msrow->msr_id.'" target="_blank" class="view_ms_btn">
                                <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                            </a> 
                            </th>
                        </tr>';
                    endforeach;
                endif;
                echo '</tbody>
            </table>';
        else:
            echo '<h3 class="has-divider text-highlight" style="color:#c00;">No Result Found</h3>';  
        endif;
        
        ?><script>
        
        $(document).ready(function(){
            $('.view_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_preview',
                   data   : data,
                   success: function(result){
                       $('#view_modal_content').html(result);
                   }
               });
            });
            $('.att_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_att_view',
                   data   : data,
                   success: function(result){
                       $('#att_modal_content').html(result);
                   }
               });
            });
        });
        
        </script><?php
        
    }
    
    public function fno_process_minute_sheet(){
        
        $ms_id = $this->uri->segment(2);
        
        $this->data['ms_detail']    = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$ms_id));
        $this->data['att_result']   = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$ms_id));
        $this->data['COAP']         = $this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>1));
        $this->data['itemType']     = $this->CRUDModel->dropDown('invt_assets_type','Select', 'at_id', 'at_name'); 
        $this->data['itemCategory'] = $this->CRUDModel->dropDown('invt_category','Select', 'cat_id', 'cat_name'); 
//        echo '<pre>'; print_r($this->data['ms_detail']); die;
        
        $this->data['ReportName']   = 'Minute Sheet';
        $this->data['page_title']   = 'Minute Sheet | ECP';
        $this->data['page']         = 'minutesheet/fno_minute_sheet_form';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function fno_update_minute_sheet(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $msid = $this->input->post('min_sht_id');
        $ins_arr = array(
            'msbg_msr_id'           => $msid,
            'msbg_budget'           => strtoupper($this->input->post('budget')),
            'msbg_chart_of_account' => $this->input->post('coa_id'),
            'msbg_asset_type'       => $this->input->post('asset_type'),
            'msbg_item_type'        => $this->input->post('item_type'),
            'msbg_comments'         => strtoupper($this->input->post('details')),
            'msbg_date'             => date('Y-m-d'),
            'msbg_datetime'         => date('Y-m-d H:i:s'),
            'msbg_user_id'          => $this->userInfo->user_id,
        );
        $this->CRUDModel->insert('min_sheet_budget', $ins_arr);
        $this->CRUDModel->update('min_sheet', array('msr_curr_status' => 7), array('msr_id' => $msid));
            
        
    }
    
    public function dfn_minute_sheet_record(){
        
            $this->data['ReportName']   = 'Minute Sheet Director Finance Panel';
            $this->data['page_title']   = 'Minute Sheet | ECP';
            $this->data['page']         = 'minutesheet/dfn_minute_sheet_record';
            $this->load->view('common/common',$this->data);
        
    }
    
    public function dfn_minute_sheet_grid(){
        
        $detail = $this->input->post('detail');
        $like   = '';
        $where  = '';
        
        $notify = $this->MinuteSheetModel->get_ms_info(array('msr_curr_status' => 7), $like);
        
        if(empty($detail)):
            $result = $this->MinuteSheetModel->get_ms_info_where_in_limit($where, $like, 'msr_curr_status', array(8,9,10,11,12,13,14,15));
        else:
            $like['msr_detail'] = $detail;
            $this->data['msr_detail'] = $detail;
            $result = $this->MinuteSheetModel->get_ms_info_where_in($where, $like, 'msr_curr_status', array(8,9,10,11,12,13,14,15));
        endif;
//        echo '<pre>'; print_r($result); die;
        if(!empty($result) || !empty($notify)):    
            echo '<table class="table table-bordered table-boxed display" width="100%" cellspacing="0" cellpadding="0" border="0">
                <thead>
                    <tr>
                        <th width="5%">S No.</th>
                        <th width="5%">Diary No.</th>
                        <th width="10%">Minute Sheet by</th>
                        <th width="10%">Department</th>
                        <th width="35%">Details</th>
                        <th width="10%">Estimated Cost</th>
                        <th width="15%">Status</th>
                        <th width="5%">Attachment</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>';
                 
                $sno = '';
                if($notify):   
                    foreach($notify as $msnfrow):
                        $sno++;
                        echo '<tr style="background-color: #fffafa ">
                            <th>'.$sno.'</th>
                            <th>'.$msnfrow->msr_diary_no.'</th>
                            <th>'.$msnfrow->emp_name.'</th>
                            <th>'.$msnfrow->deptt_name.'</th>
                            <th>'.$msnfrow->msr_detail.'</th>
                            <th>'.$msnfrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msnfrow->msr_curr_status));
                                if(!empty($cs)):
                                    echo '<strong style="color: #C00; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endif;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msnfrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msnfrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                                <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msnfrow->msr_id.'">
                                    <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                </a> 
                                <a href="MinureSheetPrint/'.$msnfrow->msr_id.'" target="_blank" class="view_ms_btn">
                                    <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                </a> 
                                <a href="MinuteSheetProcessDFN/'.$msnfrow->msr_id.'"><button type="button" class="btn btn-warning form-control" style="margin:1px;" id="edit_ms">PROCESS</button></a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                
                if($result):   
                    foreach($result as $msrow):
                        $sno++;
                        echo '<tr style="background-color:  #f3fbff  ">
                            <th>'.$sno.'</th>
                            <th>'.$msrow->msr_diary_no.'</th>
                            <th>'.$msrow->emp_name.'</th>
                            <th>'.$msrow->deptt_name.'</th>
                            <th>'.$msrow->msr_detail.'</th>
                            <th>'.$msrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msrow->msr_curr_status));
                                switch ($cs->mss_id):
                                    case 13: echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 14: echo '<strong style="color: #c00; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 15: echo '<strong style="color: #ff7400; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    default: echo '<strong style="color: #428bca; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endswitch; 
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                            <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msrow->msr_id.'">
                                <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                            </a> 
                            <a href="MinureSheetPrint/'.$msrow->msr_id.'" target="_blank" class="view_ms_btn">
                                <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                            </a> 
                            </th>
                        </tr>';
                    endforeach;
                endif;
                echo '</tbody>
            </table>';
        else:
            echo '<h3 class="has-divider text-highlight" style="color:#c00;">No Result Found</h3>';  
        endif;
        
        ?><script>
        
        $(document).ready(function(){
            $('.view_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_preview',
                   data   : data,
                   success: function(result){
                       $('#view_modal_content').html(result);
                   }
               });
            });
            $('.att_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_att_view',
                   data   : data,
                   success: function(result){
                       $('#att_modal_content').html(result);
                   }
               });
            });
        });
        
        </script><?php
        
    }
    
    public function dfn_process_minute_sheet(){
        
        $ms_id = $this->uri->segment(2);
        
        $this->data['ms_detail']    = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$ms_id));
        $this->data['att_result']   = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$ms_id));
        $this->data['vp_academic']  = $this->CRUDModel->employee_dropdown_where_in('hr_emp_record', '', 'emp_id', 'emp_name', 'current_designation', array(35,80), array('emp_status_id'=>1));
        $this->data['vp_admin']     = $this->CRUDModel->employee_dropdown_where_in('hr_emp_record', '', 'emp_id', 'emp_name', 'current_designation', array(54,72), array('emp_status_id'=>1));
        $this->data['hod']          = $this->CRUDModel->employee_dropdown('hr_emp_record', 'Select', 'emp_id', 'emp_name', array('hod_ms_flag'=>1, 'emp_id !='=>$this->data['ms_detail']->msr_emp_id));
//        echo '<pre>'; print_r($this->data['ms_detail']); die;
        
        $this->data['ReportName']   = 'Minute Sheet';
        $this->data['page_title']   = 'Minute Sheet | ECP';
        $this->data['page']         = 'minutesheet/dfn_minute_sheet_form';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function dfn_update_minute_sheet(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $case   = $this->input->post('case_id');
        $msid   = $this->input->post('min_sht_id');
        $detail = $this->input->post('details');
        $deptt  = $this->input->post('deptt_id');
        $hod    = $this->input->post('hod_id');
        $vp1    = $this->input->post('vpac_id');
        $vp2    = $this->input->post('vpad_id');
        $ao_arr = '';
        
        $vp1_design = $this->CRUDModel->get_where_row('hr_emp_record', array('emp_id'=>$vp1));
        $vp2_design = $this->CRUDModel->get_where_row('hr_emp_record', array('emp_id'=>$vp2));
        
        if(!empty($case)):
            
            switch($case):
                case '8':
                    $ao_arr = array(
                        'msd_msr_id'        => $msid,
                        'msd_status'        => $case,
                        'msd_fwd_hod_id'    => $hod,
                        'msd_fwd_deptt_id'  => $deptt,
                        'msd_step'          => 3,
                        'msd_date'          => date('Y-m-d'),
                        'msd_datetime'      => date('Y-m-d H:i:s'),
                        'msd_user_id'       => $this->userInfo->user_id,
                    );
                    $this->CRUDModel->insert('min_sheet_details', $ao_arr);
                    break;
                case '9':
                    $ao_arr = array(
                        'msd_msr_id'    => $msid,
                        'msd_status'    => $case,
                        'msd_vp_id'     => $vp1,
                        'msd_vp_desig'  => $vp1_design->current_designation,
                        'msd_comments'  => strtoupper($detail),
                        'msd_step'      => 3,
                        'msd_date'      => date('Y-m-d'),
                        'msd_datetime'  => date('Y-m-d H:i:s'),
                        'msd_user_id'   => $this->userInfo->user_id,
                    );
                    $this->CRUDModel->insert('min_sheet_details', $ao_arr);
                    break;
                case '10':
                    $ao_arr = array(
                        'msd_msr_id'    => $msid,
                        'msd_status'    => $case,
                        'msd_vp_id'     => $vp2,
                        'msd_vp_desig'  => $vp2_design->current_designation,
                        'msd_comments'  => strtoupper($detail),
                        'msd_step'      => 3,
                        'msd_date'      => date('Y-m-d'),
                        'msd_datetime'  => date('Y-m-d H:i:s'),
                        'msd_user_id'   => $this->userInfo->user_id,
                    );
                    $this->CRUDModel->insert('min_sheet_details', $ao_arr);
                    break;
                case '11':
                    $ao_arr = array(
                        'msd_msr_id'    => $msid,
                        'msd_status'    => $case,
                        'msd_step'      => 3,
                        'msd_date'      => date('Y-m-d'),
                        'msd_datetime'  => date('Y-m-d H:i:s'),
                        'msd_user_id'   => $this->userInfo->user_id,
                    );
                    $this->CRUDModel->insert('min_sheet_details', $ao_arr);
                    break;
            endswitch;
            $this->CRUDModel->update('min_sheet', array('msr_curr_status'=>$case), array('msr_id' => $msid));
            
        endif;
        
    }
    
    public function vpac_minute_sheet_record(){
        
            $this->data['ReportName']   = 'Minute Sheet Vice Principal Panel';
            $this->data['page_title']   = 'Minute Sheet | ECP';
            $this->data['page']         = 'minutesheet/vpac_minute_sheet_record';
            $this->load->view('common/common',$this->data);
        
    }
    
    public function vpac_minute_sheet_grid(){
        
        $detail = $this->input->post('detail');
        $like   = '';
        $where   = '';
//        $where  = array('msd_vp_id' => $this->userInfo->emp_id);
        
        $notify = $this->MinuteSheetModel->get_ms_info(array('msr_curr_status' => 9), $like);
        
        if(empty($detail)):
            $result = $this->MinuteSheetModel->get_ms_detail_where_in_limit($where, $like, 'msr_curr_status', array(12,13,14,15));
        else:
            $like['msr_detail'] = $detail;
            $this->data['msr_detail'] = $detail;
            $result = $this->MinuteSheetModel->get_ms_detail_where_in($where, $like, 'msr_curr_status', array(12,13,14,15));
        endif;
//        echo '<pre>'; print_r($result); die;
        if(!empty($result) || !empty($notify)):    
            echo '<table class="table table-bordered table-boxed display" width="100%" cellspacing="0" cellpadding="0" border="0">
                <thead>
                    <tr>
                        <th width="5%">S No.</th>
                        <th width="5%">Diary No.</th>
                        <th width="10%">Minute Sheet by</th>
                        <th width="10%">Department</th>
                        <th width="35%">Details</th>
                        <th width="10%">Estimated Cost</th>
                        <th width="15%">Status</th>
                        <th width="5%">Attachment</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>';
                
                $sno = '';
                if($notify):    
                    foreach($notify as $msnfrow):
                        $sno++;
                        echo '<tr style="background-color: #fffafa ">
                            <th>'.$sno.'</th>
                            <th>'.$msnfrow->msr_diary_no.'</th>
                            <th>'.$msnfrow->emp_name.'</th>
                            <th>'.$msnfrow->deptt_name.'</th>
                            <th>'.$msnfrow->msr_detail.'</th>
                            <th>'.$msnfrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msnfrow->msr_curr_status));
                                if(!empty($cs)):
                                    echo '<strong style="color: #C00; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endif;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msnfrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msnfrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                                <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msnfrow->msr_id.'">
                                    <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                </a> 
                                <a href="MinureSheetPrint/'.$msnfrow->msr_id.'" target="_blank" class="view_ms_btn">
                                    <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                </a> 
                                <a href="MinuteSheetProcessVP/'.$msnfrow->msr_id.'"><button type="button" class="btn btn-warning form-control" style="margin:1px;" id="edit_ms">PROCESS</button></a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                
                if($result):   
                    foreach($result as $msrow):
                        $sno++;
                        echo '<tr style="background-color:  #f3fbff  ">
                            <th>'.$sno.'</th>
                            <th>'.$msrow->msr_diary_no.'</th>
                            <th>'.$msrow->emp_name.'</th>
                            <th>'.$msrow->deptt_name.'</th>
                            <th>'.$msrow->msr_detail.'</th>
                            <th>'.$msrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msrow->msr_curr_status));
                                switch ($cs->mss_id):
                                    case 13: echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 14: echo '<strong style="color: #c00; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 15: echo '<strong style="color: #ff7400; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    default: echo '<strong style="color: #428bca; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endswitch; 
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                            <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msrow->msr_id.'">
                                <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                            </a> 
                            <a href="MinureSheetPrint/'.$msrow->msr_id.'" target="_blank" class="view_ms_btn">
                                <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                            </a> 
                            </th>
                        </tr>';
                    endforeach;
                endif;
                echo '</tbody>
            </table>';
        else:
            echo '<h3 class="has-divider text-highlight" style="color:#c00;">No Result Found</h3>';  
        endif;
        
        ?><script>
        
        $(document).ready(function(){
            $('.view_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_preview',
                   data   : data,
                   success: function(result){
                       $('#view_modal_content').html(result);
                   }
               });
            });
            $('.att_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_att_view',
                   data   : data,
                   success: function(result){
                       $('#att_modal_content').html(result);
                   }
               });
            });
        });
        
        </script><?php
        
    }
    
    public function vpad_minute_sheet_record(){
        
            $this->data['ReportName']   = 'Minute Sheet Vice Principal Panel';
            $this->data['page_title']   = 'Minute Sheet | ECP';
            $this->data['page']         = 'minutesheet/vpad_minute_sheet_record';
            $this->load->view('common/common',$this->data);
        
    }
    
    public function vpad_minute_sheet_grid(){
        
        $detail = $this->input->post('detail');
        $like   = '';
        $where   = '';
//        $where  = array('msd_vp_id' => $this->userInfo->emp_id);
        
        $notify = $this->MinuteSheetModel->get_ms_info(array('msr_curr_status' => 10), $like);
        
        if(empty($detail)):
            $result = $this->MinuteSheetModel->get_ms_detail_where_in_limit($where, $like, 'msr_curr_status', array(12,13,14,15));
        else:
            $like['msr_detail'] = $detail;
            $this->data['msr_detail'] = $detail;
            $result = $this->MinuteSheetModel->get_ms_detail_where_in($where, $like, 'msr_curr_status', array(12,13,14,15));
        endif;
//        echo '<pre>'; print_r($result); die;
        if(!empty($result) || !empty($notify)):    
            echo '<table class="table table-bordered table-boxed display" width="100%" cellspacing="0" cellpadding="0" border="0">
                <thead>
                    <tr>
                        <th width="5%">S No.</th>
                        <th width="5%">Diary No.</th>
                        <th width="10%">Minute Sheet by</th>
                        <th width="10%">Department</th>
                        <th width="35%">Details</th>
                        <th width="10%">Estimated Cost</th>
                        <th width="15%">Status</th>
                        <th width="5%">Attachment</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>';
                 
                $sno = '';
                if($notify):   
                    foreach($notify as $msnfrow):
                        $sno++;
                        echo '<tr style="background-color: #fffafa ">
                            <th>'.$sno.'</th>
                            <th>'.$msnfrow->msr_diary_no.'</th>
                            <th>'.$msnfrow->emp_name.'</th>
                            <th>'.$msnfrow->deptt_name.'</th>
                            <th>'.$msnfrow->msr_detail.'</th>
                            <th>'.$msnfrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msnfrow->msr_curr_status));
                                if(!empty($cs)):
                                    echo '<strong style="color: #C00; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endif;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msnfrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msnfrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                                <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msnfrow->msr_id.'">
                                    <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                </a> 
                                <a href="MinureSheetPrint/'.$msnfrow->msr_id.'" target="_blank" class="view_ms_btn">
                                    <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                </a> 
                                <a href="MinuteSheetProcessVP/'.$msnfrow->msr_id.'"><button type="button" class="btn btn-warning form-control" style="margin:1px;" id="edit_ms">PROCESS</button></a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                
                if($result):   
                    foreach($result as $msrow):
                        $sno++;
                        echo '<tr style="background-color:  #f3fbff  ">
                            <th>'.$sno.'</th>
                            <th>'.$msrow->msr_diary_no.'</th>
                            <th>'.$msrow->emp_name.'</th>
                            <th>'.$msrow->deptt_name.'</th>
                            <th>'.$msrow->msr_detail.'</th>
                            <th>'.$msrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msrow->msr_curr_status));
                                switch ($cs->mss_id):
                                    case 13: echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 14: echo '<strong style="color: #c00; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 15: echo '<strong style="color: #ff7400; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    default: echo '<strong style="color: #428bca; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endswitch; 
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                            <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msrow->msr_id.'">
                                <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                            </a> 
                            <a href="MinureSheetPrint/'.$msrow->msr_id.'" target="_blank" class="view_ms_btn">
                                <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                            </a> 
                            </th>
                        </tr>';
                    endforeach;
                endif;
                echo '</tbody>
            </table>';
        else:
            echo '<h3 class="has-divider text-highlight" style="color:#c00;">No Result Found</h3>';  
        endif;
        
        ?><script>
        
        $(document).ready(function(){
            $('.view_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_preview',
                   data   : data,
                   success: function(result){
                       $('#view_modal_content').html(result);
                   }
               });
            });
            $('.att_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_att_view',
                   data   : data,
                   success: function(result){
                       $('#att_modal_content').html(result);
                   }
               });
            });
        });
        
        </script><?php
        
    }
    
    public function vp_process_minute_sheet(){
        
        $ms_id = $this->uri->segment(2);
        
        $this->data['ms_detail']    = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$ms_id));
        $this->data['att_result']   = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$ms_id));
        $this->data['purchaseType'] = $this->CRUDModel->dropDown('min_sheet_purchase_type','Select', 'mspt_id', 'mspt_type'); 
//        echo '<pre>'; print_r($this->data['ms_detail']); die;
        
        $this->data['ReportName']   = 'Minute Sheet';
        $this->data['page_title']   = 'Minute Sheet | ECP';
        $this->data['page']         = 'minutesheet/vp_minute_sheet_form';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function vp_update_minute_sheet(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $min_sht_id     = $this->input->post('min_sht_id');
        
        $ao_arr = array(
            'msd_msr_id'    => $min_sht_id,
            'msd_status'    => 12,
            'msd_comments'  => strtoupper($this->input->post('details')),
            'msd_step'      => 4,
            'msd_date'      => date('Y-m-d'),
            'msd_datetime'  => date('Y-m-d H:i:s'),
            'msd_user_id'   => $this->userInfo->user_id,
        );
        $this->CRUDModel->insert('min_sheet_details', $ao_arr);
        $this->CRUDModel->update('min_sheet', array('msr_curr_status' => 12, 'msr_purchase_type' => $this->input->post('purchase_type')), array('msr_id' => $min_sht_id));
        $this->CRUDModel->update('min_sheet_details', array('msd_vp_id' => $this->userInfo->emp_id), array('msd_msr_id' => $min_sht_id, 'msd_status' => 9));
        
    }
    
    public function principal_minute_sheet_record(){
        
            $this->data['ReportName']   = 'Minute Sheet Principal Panel';
            $this->data['page_title']   = 'Minute Sheet | ECP';
            $this->data['page']         = 'minutesheet/principal_minute_sheet_record';
            $this->load->view('common/common',$this->data);
        
    }
    
    public function prn_minute_sheet_grid(){
        
        $detail = $this->input->post('detail');
        $like   = '';
        $where  = '';
        
        $notify = $this->MinuteSheetModel->get_ms_info(array('msr_curr_status' => 12), $like);
        
        if(empty($detail)):
            $result = $this->MinuteSheetModel->get_ms_info_where_in_limit($where, $like, 'msr_curr_status', array(13,14,15));
        else:
            $like['msr_detail'] = $detail;
            $this->data['msr_detail'] = $detail;
            $result = $this->MinuteSheetModel->get_ms_info_where_in($where, $like, 'msr_curr_status', array(13,14,15));
        endif;
//        echo '<pre>'; print_r($result); die;
        if(!empty($result) || !empty($notify)):    
            echo '<table class="table table-bordered table-boxed display" width="100%" cellspacing="0" cellpadding="0" border="0">
                <thead>
                    <tr>
                        <th width="5%">S No.</th>
                        <th width="5%">Diary No.</th>
                        <th width="10%">Minute Sheet by</th>
                        <th width="10%">Department</th>
                        <th width="35%">Details</th>
                        <th width="10%">Estimated Cost</th>
                        <th width="15%">Status</th>
                        <th width="5%">Attachment</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>';
                 
                $sno = '';
                if($notify):   
                    foreach($notify as $msnfrow):
                        $sno++;
                        echo '<tr style="background-color: #fffafa ">
                            <th>'.$sno.'</th>
                            <th>'.$msnfrow->msr_diary_no.'</th>
                            <th>'.$msnfrow->emp_name.'</th>
                            <th>'.$msnfrow->deptt_name.'</th>
                            <th>'.$msnfrow->msr_detail.'</th>
                            <th>'.$msnfrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msnfrow->msr_curr_status));
                                if(!empty($cs)):
                                    echo '<strong style="color: #C00; font-size:16px;">'.$cs->mss_title.'</strong>';
                                endif;
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msnfrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msnfrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                                <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msnfrow->msr_id.'">
                                    <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                </a> 
                                <a href="MinureSheetPrint/'.$msnfrow->msr_id.'" target="_blank" class="view_ms_btn">
                                    <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                </a> 
                                <a href="MinuteSheetProcessPrincipal/'.$msnfrow->msr_id.'"><button type="button" class="btn btn-warning form-control" style="margin:1px;" id="edit_ms">UPDATE</button></a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                
                if($result):   
                    foreach($result as $msrow):
                        $sno++;
                        echo '<tr style="background-color:  #f3fbff  ">
                            <th>'.$sno.'</th>
                            <th>'.$msrow->msr_diary_no.'</th>
                            <th>'.$msrow->emp_name.'</th>
                            <th>'.$msrow->deptt_name.'</th>
                            <th>'.$msrow->msr_detail.'</th>
                            <th>'.$msrow->msr_cost.'</th>
                            <th>';
                                $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msrow->msr_curr_status));
                                switch ($cs->mss_id):
                                    case 13: echo '<strong style="color: #5cb85c; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 14: echo '<strong style="color: #c00; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                    case 15: echo '<strong style="color: #ff7400; font-size:16px;">'.$cs->mss_title.'</strong>'; break;
                                endswitch; 
                            echo '</th>
                            <th>';
                                $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msrow->msr_id));
                                if(empty($att)):
                                    echo '';
                                else:
                                    echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msrow->msr_id.'">'.count($att).' File(s)</a>';
                                endif;
                            echo '</th>
                            <th>
                            <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msrow->msr_id.'">
                                <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                            </a> 
                            <a href="MinureSheetPrint/'.$msrow->msr_id.'" target="_blank">
                                <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                            </a>
                            </th>
                        </tr>';
                    endforeach;
                endif;
                echo '</tbody>
            </table>';
        else:
            echo '<h3 class="has-divider text-highlight" style="color:#c00;">No Result Found</h3>';  
        endif;
        
        ?><script>
        
        $(document).ready(function(){
            $('.view_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_preview',
                   data   : data,
                   success: function(result){
                       $('#view_modal_content').html(result);
                   }
               });
            });
            $('.att_ms_btn').on('click', function(){
                var data = {
                   'min_id' : $(this).attr('id')
               };
               $.ajax({
                   type   : 'post',
                   url    : 'MinuteSheetController/minute_sheet_att_view',
                   data   : data,
                   success: function(result){
                       $('#att_modal_content').html(result);
                   }
               });
            });
        });
        
        </script><?php
        
    }
    
    public function prn_process_minute_sheet(){
        
        $ms_id = $this->uri->segment(2);
        
        $this->data['ms_detail']    = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$ms_id));
        $this->data['att_result']   = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$ms_id));
        $this->data['Status']       = $this->CRUDModel->dropDown_where_in('min_sheet_status','Select', 'mss_id', 'mss_title', 'mss_id', array(13,14,15)); 
//        echo '<pre>'; print_r($this->data['ms_detail']); die;
        
        $this->data['ReportName']   = 'Minute Sheet';
        $this->data['page_title']   = 'Minute Sheet | ECP';
        $this->data['page']         = 'minutesheet/principal_minute_sheet_form';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function prn_update_minute_sheet(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $min_sht_id     = $this->input->post('min_sht_id');
        $status_id      = $this->input->post('status_id');
        $min_sht_date   = $this->input->post('ms_date');
        
        if(empty($min_sht_date)):
            $min_sht_date = date('d-m-Y');
        endif;
        
        $ao_arr = array(
            'msd_msr_id'    => $min_sht_id,
            'msd_status'    => $status_id,
            'msd_comments'  => strtoupper($this->input->post('details')),
            'msd_step'      => 5,
            'msd_date'      => date('Y-m-d', strtotime($min_sht_date)),
            'msd_datetime'  => date('Y-m-d H:i:s'),
            'msd_user_id'   => $this->userInfo->user_id,
        );
        $this->CRUDModel->insert('min_sheet_details', $ao_arr);
        $this->CRUDModel->update('min_sheet', array('msr_curr_status' => $status_id), array('msr_id' => $min_sht_id));
        
    }
    
    public function minute_sheet_hod_comments(){
        
        $ms_id = $this->uri->segment(2);
        
        $this->data['ms_detail']    = $this->MinuteSheetModel->get_ms_info_edit(array('msr_id'=>$ms_id));
        $this->data['att_result']   = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$ms_id));
//        echo '<pre>'; print_r($this->data['ms_detail']); die;
        
        $this->data['ReportName']   = 'Minute Sheet';
        $this->data['page_title']   = 'Minute Sheet | ECP';
        $this->data['page']         = 'minutesheet/recmnd_minute_sheet_form';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function update_minute_sheet_hod_comments(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $min_sht_id     = $this->input->post('min_sht_id');
        $status_id      = $this->input->post('curr_status');
        
        if($status_id == 3):
            $up_status  = 4;
            $step       = 2;
        else:
            $up_status  = 7;
            $step       = 3;
        endif;
        
        $ao_arr = array(
            'msd_msr_id'    => $min_sht_id,
            'msd_status'    => $up_status,
            'msd_comments'  => strtoupper($this->input->post('details')),
            'msd_step'      => $step,
            'msd_date'      => date('Y-m-d'),
            'msd_datetime'  => date('Y-m-d H:i:s'),
            'msd_user_id'   => $this->userInfo->user_id,
        );
        $this->CRUDModel->insert('min_sheet_details', $ao_arr);
        $this->CRUDModel->update('min_sheet', array('msr_curr_status' => $up_status), array('msr_id' => $min_sht_id));
        
    }
    
    public function print_minute_sheet(){
        
        $this->data['ms_id']        = $this->uri->segment(2);
//        $this->data['page_title']   = 'Print Minute Sheet | ECMS';
//        $this->data['page']         = 'minutesheet/print_minute_sheet';
//        $this->load->view('common/common',$this->data); 
        
        $this->load->view('minutesheet/print_minute_sheet', $this->data);
    }
    
    public function get_employ(){
        
        $order['column']    = 'emp_name';
        $order['order']     = 'asc';
        $result = $this->CRUDModel->get_where_result_order('hr_emp_record', array('department_id'=>$this->input->post('dept_id'), 'emp_status_id'=>1), $order);
        echo '<option value="">Select</option>';
        foreach ($result as $row):
            echo '<option value="'.$row->emp_id.'">'.$row->emp_name.'</option>';
        endforeach;
        
    }
    
    
}   
