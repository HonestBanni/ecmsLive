<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class IDCardController extends AdminController {
    function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url'); ;
        $this->load->library("pagination");
        $this->load->model("CRUDModel");
        $this->load->model("IDCardModel");
        $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
    }
    public function index(){
        $this->admin_home();
    }

    public function students_for_idcards(){

        $this->data['sub_program']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
        $this->data['program']              = $this->CRUDModel->dropDown('programes_info', 'Select Program', 'programe_id', 'programe_name',array('program_type_id'=>1));
        $this->data['gender']               = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']                = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));

        $this->data['ReportName']           = 'Student Records for ID Card';
        $this->data['page_title']           = 'Student Records for ID Card | ECP';
        $this->data['page']                 = 'id_cards/student_records';
        $this->load->view('common/common',$this->data);
    }

    public function student_records_grid($rowno=0){
//        echo '<pre>'; print_r($this->input->post()); die;
        $formNo     =  $this->input->post('form_no');
        $collegeNo  =  $this->input->post('college_no');
        $stdName    =  $this->input->post('student_name');
        $fName      =  $this->input->post('father_name');
        $gender     =  $this->input->post('gender');
        $programId  =  $this->input->post('programe_id');
        $subProId   =  $this->input->post('sub_pro_id');
        $batchId    =  $this->input->post('batch');

        // where condition for searching
        $like   = '';
        $where['student_record.s_status_id']  = '5';

        if(!empty($formNo)):        $like['form_no']                    = $formNo;      endif;
        if(!empty($collegeNo)):     $where['college_no']                = $collegeNo;   endif;
        if(!empty($gender)):        $where['student_record.gender_id']  = $gender;      endif;
        if(!empty($programId)):     $where['student_record.programe_id'] = $programId;  endif;
        if(!empty($subProId)):      $where['student_record.sub_pro_id'] = $subProId;    endif;
        if(!empty($batchId)):       $where['student_record.batch_id']   = $batchId;     endif;
        if(!empty($stdName)):       $like['student_name']               = $stdName;     endif;
        if(!empty($fName)):         $like['father_name']                = $fName;       endif;

        // Row per page
        $rowperpage = 50;

        // Row position
        if($rowno != 0):
          $rowno = ($rowno-1) * $rowperpage;
        endif;

        // All records count
        $allcount = $this->IDCardModel->student_records_count($where, $like);

        // Get records
        $users_record = $this->IDCardModel->student_records_result($rowno,$rowperpage, $where, $like);

        // Pagination Configuration
        $config['base_url']         = 'IDCardController/student_records_grid';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows']       = $allcount;
        $config['per_page']         = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links_new();
        $data['result']     = $users_record;
        $data['row']        = $rowno;
        $data['total']      = $allcount;
//        echo '<pre>'; print_r($data); die;
        echo json_encode($data);

    }

    public function idcard_expiry(){

        $this->data['program']  = $this->CRUDModel->dropDown('programes_info', 'Select', 'programe_id', 'programe_name', '', array('column'=>'programe_name', 'order'=>'asc'));

        $this->data['ReportName']   = 'ID Card Expiry Date';
        $this->data['page_title']   = 'ID Card Expiry Date | ECP';
        $this->data['page']         = 'id_cards/idcard_expiry';
        $this->load->view('common/common',$this->data);
    }
 
    public function save_dates(){
//        echo '<pre>';print_r($this->input->post());die;
        $return_json = array();
        
        
        $this->form_validation->set_rules('programe_id', '', 'required', array('required'=>'1'));
        $this->form_validation->set_rules('ex_date', '', 'required', array('required' => '2'));
        
        if ($this->form_validation->run() == FALSE):
            $this->form_validation->set_error_delimiters('', '');
            $fve =  validation_errors();
            switch ($fve):
                case 1: $return_json = array('e_title'=>'Error', 'e_text'=>'Please select the Program'); break;
                case 2: $return_json = array('e_title'=>'Error', 'e_text'=>'Expiry Date is required'); break;
            endswitch;
            
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle" style="color: #c00;"></i>';
            $return_json['e_type']     = 'WARNING';
            
        else:
            
            $check  = array();
            $prog   = $this->input->post('programe_id');
            $date   = $this->input->post('ex_date');
            
            if(!empty($prog)):
                $check = $this->CRUDModel->get_where_row('idcard_exipry_dates', array('iced_program_id' => $prog));
            endif;
            
            if(!empty($check)):
                $return_json = array(
                    'e_icon'    => '<i class="fa fa-exclamation-triangle" style="color: #c00;"></i>',
                    'e_title'   => 'Error',
                    'e_text'    => 'Entry for selected program already exist.'
                );
            else:

                $ins_array = array(
                    'iced_expiry'       => $date,
                    'iced_program_id'   => $prog,
                );
                $this->CRUDModel->insert('idcard_exipry_dates', $ins_array);
                
                $return_json = array(
                    'e_status'  => true,
                    'e_icon'    => '<i class="fa fa-check-circle" style="color: #208e4c;"></i>',
                    'e_type'   => 'SUCCESS',
                    'e_text'    => 'Student record saved successfully.'
                );

            endif;
            
        endif;
        
        echo json_encode($return_json);
        
    }
    public function change_ex_date(){
             
        $id  = $this->input->post('id');
        $rec = $this->CRUDModel->get_where_row('idcard_exipry_dates',array('iced_id'=>$id));
            
           echo '<div class="modal-body">
                <div class="col-md-12 subject form-group">
                 <p>&nbsp;</p>
                <label style="text-indent: 3px">Applicant Status<span style="color:red">*</span></label> 
                <input type="date" name="edate" id="edate" class="form-control" value="'.$rec->iced_expiry.'">
                <input type="hidden" name="rec_id" id="rec_id" class="form-control" value="'.$id.'">
                <br>
            </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                        <button type="button" class="btn btn-success saveStatus" >Save</button>
                    </div>';
            
        ?>
              
        <script>
            jQuery(document).ready(function(){
                jQuery('.saveStatus').on('click',function(){
                    var rec_id  = jQuery('#rec_id').val();
                    var edate   = jQuery('#edate').val();
                    jQuery.ajax({
                        type   :'post',
                        url    :'IDCardController/update_ex_date',
                        data   :{'rec_id':rec_id,'edate':edate},
                        success :function(result){
                            jQuery('#ChangeStatusModal').modal('toggle');
                            location.reload();
                        }
                    });
                });
                });
        </script>
        <?php   
           
    } 
    
    public function update_ex_date(){
        $this->CRUDModel->update('idcard_exipry_dates', array('iced_expiry' => $this->input->post('edate')), array('iced_id' => $this->input->post('rec_id')));
    }
       
    public function idcard_credentials(){

        $this->data['student_rec']  = $this->IDCardModel->get_student_data(array('student_id' => $this->uri->segment(2)));
        $this->data['blood_group']  = $this->CRUDModel->dropDown('blood_group', 'Select', 'b_group_id', 'title', '', array('column'=>'title', 'order'=>'asc'));
        
        // Expiry Date
        $expiry_date  = $this->CRUDModel->get_where_row('idcard_exipry_dates', array('iced_program_id' => $this->data['student_rec']->programe_id));
        if(!empty($expiry_date->iced_expiry)): 
            $this->data['expiry_date'] = date('d-m-Y', strtotime($expiry_date->iced_expiry));
        else:
            $this->data['expiry_date'] = '';
        endif;

        $this->data['ReportName']   = 'Student Records for ID Card';
        $this->data['page_title']   = 'Student Records for ID Card | ECP';
        $this->data['page']         = 'id_cards/idcard_form';
        $this->load->view('common/common',$this->data);
    }

    public function idcard_save_and_print(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $student_id     = $this->input->post('student_id');
        $student_name   = $this->input->post('student_name');
        $father_name    = $this->input->post('father_name');
        $college_no     = $this->input->post('college_no');
        $program        = $this->input->post('program');
        $programe_id    = $this->input->post('program_id');
        $sub_pro_id     = $this->input->post('sub_pro_id');
        $issue_date     = $this->input->post('issue_date');
        $expiry_date    = $this->input->post('expiry_date');
        $contact        = $this->input->post('contact');
        $address        = $this->input->post('address');
        $bg_id          = $this->input->post('bg_id');
        $student_data   = $this->CRUDModel->get_where_row('student_record', array('student_id' => $student_id));
        
        $blood_group    = $this->CRUDModel->get_where_row('blood_group', array('b_group_id' => $bg_id));
        if(!empty($blood_group)): $this->data['blood_group']  = $blood_group->title; else: $this->data['blood_group'] = ''; endif;
        
        $this->CRUDModel->deleteid('idcard_print_details', array('idc_student_id' => $student_id, 'idc_print_date' => date('Y-m-d')));
        $this->CRUDModel->update('idcard_print_details', array('idc_card_status' => 0), array('idc_student_id' => $student_id));
        
        $insert_arr = array(
            'idc_student_id'    => $student_id,
            'idc_student_name'  => $student_name,
            'idc_father_name'   => $father_name,
            'idc_college_no'    => $college_no,
            'idc_program'       => $program,
            'idc_program_id'    => $programe_id,
            'idc_sub_pro_id'    => $sub_pro_id,
            'idc_issue_date'    => date('Y-m-d', strtotime($issue_date)),
            'idc_expiry_date'   => date('Y-m-d', strtotime($expiry_date)),
            'idc_contact'       => $contact,
            'idc_address'       => $address,
            'idc_bg_id'         => $bg_id,
            'idc_card_status'   => 1,
            'idc_print_date'    => date('Y-m-d'),
            'idc_datetime'      => date('Y-m-d H:i:s'),
            'idc_user_id'       => $this->userInfo->user_id,
        );
        $this->CRUDModel->insert('idcard_print_details', $insert_arr);
        
       
        $this->data['student_name'] = $student_name;
        $this->data['father_name']  = $father_name;
        $this->data['college_no']   = $college_no;
        $this->data['program']      = $program;
        $this->data['issue_date']   = $issue_date;
        $this->data['expiry_date']  = $expiry_date;
        $this->data['contact']      = $contact;
        $this->data['address']      = $address;
        $this->data['picture']      = $student_data->applicant_image;
        
        $this->load->view('id_cards/idcard_single_print', $this->data);
    }
    
    public function idcard_preview(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $this->data['picture']      = $this->input->post('picture');
        $this->data['student_name'] = $this->input->post('student_name');
        $this->data['father_name']  = $this->input->post('father_name');
        $this->data['college_no']   = $this->input->post('college_no');
        $this->data['program']      = $this->input->post('program');
        $this->data['issue_date']   = $this->input->post('issue_date');
        $this->data['expiry_date']  = $this->input->post('expiry_date');
        $this->data['contact']      = $this->input->post('contact');
        $this->data['address']      = $this->input->post('address');
        $bg_id          = $this->input->post('bg_id');
        $blood_group    = $this->CRUDModel->get_where_row('blood_group', array('b_group_id' => $bg_id));
        
        if(!empty($blood_group)): $this->data['blood_group']  = $blood_group->title; else: $this->data['blood_group'] = ''; endif;
        
        $this->load->view('id_cards/idcard_preview', $this->data);
    }
    
    public function idcard_histroy(){
        $recs = $this->IDCardModel->get_idcard_print_data(array('idc_student_id' => $this->input->post('id')));
        if($recs):
            $serial = 0;
            echo '<table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th width="3%">S#</th>
                        <th width="14%">Student Name</th>
                        <th width="12%">Father Name</th>
                        <th width="10%">Program</th>
                        <th width="9%">Contact</th>
                        <th width="27%">Address</th>
                        <th width="7%">Blood Grp</th>
                        <th width="8%">Print Date</th>
                        <th width="10%">Print By</th>
                    </tr>
                </thead>
                <tbody>';
                    foreach($recs as $row):
                    echo '<tr>
                        <td>'.++$serial.'</td>
                        <td>'.$row->idc_student_name.'</td>
                        <td>'.$row->idc_father_name.'</td>
                        <td>'.$row->idc_program.'</td>
                        <td>'.$row->idc_contact.'</td>
                        <td>'.$row->idc_address.'</td>
                        <td>'.$row->title.'</td>
                        <td>'.$row->idc_print_date.'</td>
                        <td>'.$row->emp_name.'</td>
                    </tr>';
                    endforeach;
                echo '</tbody>
                <tbody></tbody>
            </table>';
        endif;
    }
    
    public function rfid_form(){
        
        $id = $this->uri->segment(2);
        
        $this->data['student_rec']  = $this->IDCardModel->get_student_data(array('student_id' => $id));
        $this->data['blood_group']  = $this->CRUDModel->dropDown('blood_group', 'Select', 'b_group_id', 'title', '', array('column'=>'title', 'order'=>'asc'));
        $this->data['idcard_active'] = $this->IDCardModel->get_single_idcard_data(array('idc_student_id' => $id, 'idc_card_status' => 1));
        $this->data['idcard_all']   = $this->IDCardModel->get_idcard_print_data(array('idc_student_id' => $id));
        
        $this->data['ReportName']   = 'Student Records for ID Card';
        $this->data['page_title']   = 'Student Records for ID Card | ECP';
        $this->data['page']         = 'id_cards/rfid_form';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function update_rfid(){
        $this->CRUDModel->update('idcard_print_details', array('idc_rfid' => $this->input->post('rfid')), array('idc_id' => $this->input->post('idcid')));
        redirect('StudentsForIDCards');
    }
    
    public function printed_student_idcards(){

        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Select Program', 'programe_id', 'programe_name',array('program_type_id'=>1));
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['status']       = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));

        $this->data['ReportName']   = 'Students ID Cards Record';
        $this->data['page_title']   = 'Students ID Cards Record | ECP';
        $this->data['page']         = 'id_cards/printed_student_idcards';
        $this->load->view('common/common',$this->data);
    }
    
    public function student_idcard_grid(){

        $rfid       =  $this->input->post('rfid');
        $collegeNo  =  $this->input->post('college_no');
        $stdName    =  $this->input->post('student_name');
        $fName      =  $this->input->post('father_name');
        $gender     =  $this->input->post('gender');
        $programId  =  $this->input->post('programe_id');
        $subProId   =  $this->input->post('sub_pro_id');
        $batchId    =  $this->input->post('batch');
        $status     =  $this->input->post('status');
        $start      =  $this->input->post('from_date');
        $end        =  $this->input->post('to_date');

        // where condition for searching
        $like   = '';
        $where  = '';

        if(!empty($stdName)):       $like['student_record.student_name']    = $stdName;     endif;
        if(!empty($fName)):         $like['student_record.father_name']     = $fName;       endif;
        if(!empty($collegeNo)):     $where['idcard_print_details.idc_college_no'] = $collegeNo;   endif;
        if(!empty($gender)):        $where['student_record.gender_id']      = $gender;      endif;
        if(!empty($programId)):     $where['student_record.programe_id']    = $programId;  endif;
        if(!empty($subProId)):      $where['student_record.sub_pro_id']     = $subProId;    endif;
        if(!empty($batchId)):       $where['student_record.batch_id']       = $batchId;     endif;
        if(!empty($rfid)):          $where['idcard_print_details.idc_rfid'] = $rfid;        endif;
        if(!empty($status)):        $where['student_record.s_status_id']    = $status;     endif;

        $this->data['result'] = $this->IDCardModel->student_idcard_result($where, $like, $start, $end);
        $this->load->view('id_cards/student_idcard_grid', $this->data);
    }
    
    public function print_student_idcards_list(){

        $rfid       =  $this->input->post('rfid');
        $collegeNo  =  $this->input->post('college_no');
        $stdName    =  $this->input->post('student_name');
        $fName      =  $this->input->post('father_name');
        $gender     =  $this->input->post('gender');
        $programId  =  $this->input->post('programe_id');
        $subProId   =  $this->input->post('sub_pro_id');
        $batchId    =  $this->input->post('batch');
        $status     =  $this->input->post('status');
        $start      =  $this->input->post('from_date');
        $end        =  $this->input->post('to_date');

        // where condition for searching
        $like   = '';
        $where  = '';

        if(!empty($stdName)):       $like['student_record.student_name']    = $stdName;     endif;
        if(!empty($fName)):         $like['student_record.father_name']     = $fName;       endif;
        if(!empty($collegeNo)):     $where['idcard_print_details.idc_college_no'] = $collegeNo;   endif;
        if(!empty($gender)):        $where['student_record.gender_id']      = $gender;      endif;
        if(!empty($programId)):     $where['student_record.programe_id']    = $programId;  endif;
        if(!empty($subProId)):      $where['student_record.sub_pro_id']     = $subProId;    endif;
        if(!empty($batchId)):       $where['student_record.batch_id']       = $batchId;     endif;
        if(!empty($rfid)):          $where['idcard_print_details.idc_rfid'] = $rfid;        endif;
        if(!empty($status)):        $where['student_record.s_status_id']    = $status;     endif;

        $this->data['result'] = $this->IDCardModel->student_idcard_result($where, $like, $start, $end);
        $this->load->view('id_cards/student_idcard_grid_print', $this->data);
    }
    
    public function employs_for_idcards(){

        $this->data['department']   = $this->CRUDModel->dropDown('department', 'Department', 'department_id', 'title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
        $this->data['designation']  = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'title');
        $this->data['contract']     = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Contract Type', 'contract_type_id', 'title');
        $this->data['category']     = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'cat_id', 'title');

        $this->data['ReportName']           = 'Employs for ID Card';
        $this->data['page_title']           = 'Employs for ID Card | ECP';
        $this->data['page']                 = 'id_cards/employ_records';
        $this->load->view('common/common',$this->data);
    }

    public function employ_records_grid($rowno=0){
//        echo '<pre>'; print_r($this->input->post()); die;
        $empName    =  $this->input->post('emp_name');
        $fName      =  $this->input->post('father_name');
        $gender     =  $this->input->post('gender');
        $deptt      =  $this->input->post('deptt');
        $design     =  $this->input->post('design');
        $category   =  $this->input->post('category');
        $contract   =  $this->input->post('contract');

        // where condition for searching
        $like   = array();
        $where['hr_emp_record.emp_status_id']  = '1';

        if(!empty($empName)):   $like['hr_emp_record.emp_name']             = $empName;     endif;
        if(!empty($fName)):     $like['hr_emp_record.father_name']          = $fName;       endif;
        if(!empty($deptt)):     $where['hr_emp_record.department_id']       = $deptt;       endif;
        if(!empty($gender)):    $where['hr_emp_record.gender_id']           = $gender;      endif;
        if(!empty($design)):    $where['hr_emp_record.current_designation'] = $design;      endif;
        if(!empty($category)):  $where['hr_emp_record.cat_id']              = $category;    endif;
        if(!empty($contract)):  $where['hr_emp_record.contract_type_id']    = $contract;    endif;

        // Row per page
        $rowperpage = 50;

        // Row position
        if($rowno != 0):
          $rowno = ($rowno-1) * $rowperpage;
        endif;

        // All records count
        $allcount = $this->IDCardModel->employ_records_count($where, $like);

        // Get records
        $users_record = $this->IDCardModel->employ_records_result($rowno,$rowperpage, $where, $like);

        // Pagination Configuration
        $config['base_url']         = 'IDCardController/employ_records_grid';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows']       = $allcount;
        $config['per_page']         = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links_new();
        $data['result']     = $users_record;
        $data['row']        = $rowno;
        $data['total']      = $allcount;
//        echo '<pre>'; print_r($data); die;
        echo json_encode($data);

    }
    
    public function upload_employee_pic()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('file','assets/images/employee');
            $file_name = $image['file_name'];
            $data = array('picture'=>$file_name);
            $where = array('emp_id'=>$id); 
            $this->CRUDModel->update('hr_emp_record',$data,$where);
            redirect('EmploysForIDCards'); 
        endif;
        if($id):
            $where = array('emp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_record',$where);

            $this->data['page_title']  = 'Upload Employee Picture | ECP';
            $this->data['page']        = 'id_cards/upload_employee_pic';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
       
    public function employ_idcard_credentials(){

        $this->data['emp_rec']      = $this->IDCardModel->single_employ_data(array('emp_id' => $this->uri->segment(2)));
        $this->data['blood_group']  = $this->CRUDModel->dropDown('blood_group', 'Select', 'b_group_id', 'title', '', array('column'=>'title', 'order'=>'asc'));
        
        $this->data['ReportName']   = 'Employ Data for ID Card';
        $this->data['page_title']   = 'Employ Data for ID Card | ECP';
        $this->data['page']         = 'id_cards/employ_idcard_form';
        $this->load->view('common/common',$this->data);
    }

    public function employ_idcard_save_and_print(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $employ_id      = $this->input->post('emp_id');
        $employ_name    = $this->input->post('employ_name');
        $father_name    = $this->input->post('father_name');
        $cnic           = $this->input->post('cnic');
        $designation    = $this->input->post('designation');
        $issue_date     = $this->input->post('issue_date');
        $expiry_date    = $this->input->post('expiry_date');
        $contact        = $this->input->post('contact');
        $address        = $this->input->post('address');
        $bg_id          = $this->input->post('bg_id');
        $employ_data    = $this->CRUDModel->get_where_row('hr_emp_record', array('emp_id' => $employ_id));
        
        $blood_group    = $this->CRUDModel->get_where_row('blood_group', array('b_group_id' => $bg_id));
        if(!empty($blood_group)): $this->data['blood_group']  = $blood_group->title; else: $this->data['blood_group'] = ''; endif;
        
        $this->CRUDModel->deleteid('idcard_emp_print_details', array('idce_emp_id' => $employ_id, 'idce_print_date' => date('Y-m-d')));
        $this->CRUDModel->update('idcard_emp_print_details', array('idce_card_status' => 0), array('idce_emp_id' => $employ_id));
        
        $insert_arr = array(
            'idce_emp_id'       => $employ_id,
            'idce_emp_name'     => $employ_name,
            'idce_father_name'  => $father_name,
            'idce_cnic'         => $cnic,
            'idce_designation'  => $designation,
            'idce_issue_date'   => date('Y-m-d', strtotime($issue_date)),
            'idce_expiry_date'  => date('Y-m-d', strtotime($expiry_date)),
            'idce_contact'      => $contact,
            'idce_address'      => $address,
            'idce_bg_id'        => $bg_id,
            'idce_card_status'  => 1,
            'idce_print_date'   => date('Y-m-d'),
            'idce_datetime'     => date('Y-m-d H:i:s'),
            'idce_user_id'      => $this->userInfo->user_id,
        );
        $this->CRUDModel->insert('idcard_emp_print_details', $insert_arr);
        
       
        $this->data['employ_name']  = $employ_name;
        $this->data['father_name']  = $father_name;
        $this->data['emp_cnic']     = $cnic;
        $this->data['emp_design']   = $designation;
        $this->data['issue_date']   = $issue_date;
        $this->data['expiry_date']  = $expiry_date;
        $this->data['contact']      = $contact;
        $this->data['address']      = $address;
        $this->data['picture']      = $employ_data->picture;
        
        $this->load->view('id_cards/employ_idcard_single_print', $this->data);
    }
    
    public function employ_idcard_preview(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $this->data['picture']      = $this->input->post('picture');
        $this->data['emp_name']     = $this->input->post('emp_name');
        $this->data['father_name']  = $this->input->post('father_name');
        $this->data['cnic']         = $this->input->post('cnic');
        $this->data['designation']  = $this->input->post('designation');
        $this->data['issue_date']   = $this->input->post('issue_date');
        $this->data['expiry_date']  = $this->input->post('expiry_date');
        $this->data['contact']      = $this->input->post('contact');
        $this->data['address']      = $this->input->post('address');
        $bg_id          = $this->input->post('bg_id');
        $blood_group    = $this->CRUDModel->get_where_row('blood_group', array('b_group_id' => $bg_id));
        
        if(!empty($blood_group)): $this->data['blood_group']  = $blood_group->title; else: $this->data['blood_group'] = ''; endif;
        
        $this->load->view('id_cards/employ_idcard_preview', $this->data);
    }
    
    public function employ_idcard_histroy(){
        $recs = $this->IDCardModel->get_emp_idcard_print_data(array('idce_emp_id' => $this->input->post('id')));
        if($recs):
            $serial = 0;
            echo '<table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th width="3%">S#</th>
                        <th width="14%">Employ Name</th>
                        <th width="12%">Father Name</th>
                        <th width="10%">Designation</th>
                        <th width="9%">Contact</th>
                        <th width="27%">Address</th>
                        <th width="7%">Blood Grp</th>
                        <th width="8%">Print Date</th>
                        <th width="10%">Print By</th>
                    </tr>
                </thead>
                <tbody>';
                    foreach($recs as $row):
                    echo '<tr>
                        <td>'.++$serial.'</td>
                        <td>'.$row->idce_emp_name.'</td>
                        <td>'.$row->idce_father_name.'</td>
                        <td>'.$row->idce_designation.'</td>
                        <td>'.$row->idce_contact.'</td>
                        <td>'.$row->idce_address.'</td>
                        <td>'.$row->title.'</td>
                        <td>'.$row->idce_print_date.'</td>
                        <td>'.$row->emp_name.'</td>
                    </tr>';
                    endforeach;
                echo '</tbody>
                <tbody></tbody>
            </table>';
        endif;
    }
    
    public function employ_rfid_form(){
        
        $id = $this->uri->segment(2);
        
        $this->data['emp_rec']      = $this->IDCardModel->single_employ_data(array('emp_id' => $id));
        $this->data['blood_group']  = $this->CRUDModel->dropDown('blood_group', 'Select', 'b_group_id', 'title', '', array('column'=>'title', 'order'=>'asc'));
        $this->data['idcard_active'] = $this->IDCardModel->get_single_employ_idcard(array('idce_emp_id' => $id, 'idce_card_status' => 1));
        $this->data['idcard_all']   = $this->IDCardModel->get_employ_idcard_print(array('idce_emp_id' => $id));
        
        $this->data['ReportName']   = 'Employee Record for ID Card';
        $this->data['page_title']   = 'Employee Record for ID Card | ECP';
        $this->data['page']         = 'id_cards/employ_rfid_form';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function update_employ_rfid(){
        $this->CRUDModel->update('idcard_emp_print_details', array('idce_rfid' => $this->input->post('rfid')), array('idce_id' => $this->input->post('idceid')));
        redirect('EmploysForIDCards');
    }
    
    public function printed_employ_idcards(){

        $this->data['department']   = $this->CRUDModel->dropDown('department', 'Department', 'department_id', 'title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
        $this->data['designation']  = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'title');
        $this->data['contract']     = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Contract Type', 'contract_type_id', 'title');
        $this->data['category']     = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'cat_id', 'title');
        $this->data['status']       = $this->CRUDModel->dropDown('hr_emp_status', 'Status', 'emp_status_id', 'title');

        $this->data['ReportName']   = 'Students ID Cards Record';
        $this->data['page_title']   = 'Students ID Cards Record | ECP';
        $this->data['page']         = 'id_cards/printed_employ_idcards';
        $this->load->view('common/common',$this->data);
    }
    
    public function employ_idcard_grid(){

        $rfid       =  $this->input->post('rfid');
        $name       =  $this->input->post('employ_name');
        $fname      =  $this->input->post('father_name');
        $gender     =  $this->input->post('gender');
        $deptt      =  $this->input->post('deptt');
        $design     =  $this->input->post('design');
        $contract   =  $this->input->post('contract');
        $category   =  $this->input->post('category');
        $status     =  $this->input->post('status');
        $start      =  $this->input->post('from_date');
        $end        =  $this->input->post('to_date');

        // where condition for searching
        $like   = array();
        $where  = array();

        if(!empty($name)):      $like['hr_emp_record.emp_name']             = $name;        endif;
        if(!empty($fname)):     $like['hr_emp_record.father_name']          = $fname;       endif;
        if(!empty($category)):  $where['hr_emp_record.cat_id']              = $category;    endif;
        if(!empty($gender)):    $where['hr_emp_record.gender_id']           = $gender;      endif;
        if(!empty($deptt)):     $where['hr_emp_record.programe_id']         = $deptt;       endif;
        if(!empty($design)):    $where['hr_emp_record.current_designation'] = $design;      endif;
        if(!empty($contract)):  $where['hr_emp_record.contract_type_id']    = $contract;    endif;
        if(!empty($rfid)):      $where['idcard_emp_print_details.idce_rfid'] = $rfid;       endif;
        if(!empty($status)):    $where['hr_emp_record.emp_status_id']       = $status;      endif;

        $this->data['result'] = $this->IDCardModel->employ_idcard_result($where, $like, $start, $end);
        $this->load->view('id_cards/employ_idcard_grid', $this->data);
    }
    
    public function print_employ_idcards_list(){

        $rfid       =  $this->input->post('rfid');
        $name       =  $this->input->post('employ_name');
        $fname      =  $this->input->post('father_name');
        $gender     =  $this->input->post('gender');
        $deptt      =  $this->input->post('deptt');
        $design     =  $this->input->post('design');
        $contract   =  $this->input->post('contract');
        $category   =  $this->input->post('category');
        $status     =  $this->input->post('status');
        $start      =  $this->input->post('from_date');
        $end        =  $this->input->post('to_date');

        // where condition for searching
        $like   = array();
        $where  = array();

        if(!empty($name)):      $like['hr_emp_record.emp_name']             = $name;        endif;
        if(!empty($fname)):     $like['hr_emp_record.father_name']          = $fname;       endif;
        if(!empty($category)):  $where['hr_emp_record.cat_id']              = $category;    endif;
        if(!empty($gender)):    $where['hr_emp_record.gender_id']           = $gender;      endif;
        if(!empty($deptt)):     $where['hr_emp_record.programe_id']         = $deptt;       endif;
        if(!empty($design)):    $where['hr_emp_record.current_designation'] = $design;      endif;
        if(!empty($contract)):  $where['hr_emp_record.contract_type_id']    = $contract;    endif;
        if(!empty($rfid)):      $where['idcard_emp_print_details.idce_rfid'] = $rfid;       endif;
        if(!empty($status)):    $where['hr_emp_record.emp_status_id']       = $status;      endif;

        $this->data['result'] = $this->IDCardModel->employ_idcard_result($where, $like, $start, $end);
        $this->load->view('id_cards/employ_idcard_grid_print', $this->data);
    }
    
}