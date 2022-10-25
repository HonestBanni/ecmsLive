<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class ReportsController extends AdminController {

     public function __construct() {
             parent::__construct();
                $this->load->model('AttendanceModel');
                $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
        }
    public function teacher_alloted_groups(){       
         
//        echo '<pre>';print_r($this->userInfo);die;
        $session        = $this->session->all_userdata();
        $emp_id         = $this->userInfo->emp_id;
   
//        $emp_id         = 145;
//        $emp_id         = $session['userData']['emp_id'];
        
        $where          = array('class_alloted.emp_id' => $emp_id, 'class_alloted.flag' => '1');
//        $where          = array('class_alloted.emp_id' => $emp_id, 'class_alloted.flag' => '1', 'class_alloted.ca_merge_id' => '0');
        $subwhere       = array('class_alloted.emp_id' => $emp_id, 'class_alloted.flag' => '2');
//        $subwhere       = array('class_alloted.emp_id' => $emp_id, 'class_alloted.flag' => '2', 'class_alloted.ca_merge_id' => '0');
        
//        $merge_where    = array('class_alloted.emp_id' => $emp_id, 'class_alloted.ca_merge_id !=' => '0');
        
        $this->data['result']       = $this->AttendanceModel->get_alloted_sections('class_alloted',$where);
        $this->data['subjectbase']  = $this->AttendanceModel->get_alloted_subjects('class_alloted',$subwhere);
//        $this->data['merged_grps']  = $this->AttendanceModel->get_alloted_merged('class_alloted',$merge_where);
        $this->data['emp_merg_ids'] = $this->CRUDModel->get_where_result('class_alloted', array('class_alloted.emp_id' => $emp_id));
//        $this->data['merged_show']  = $this->AttendanceModel->get_alloted_merged_group_by('class_alloted',$merge_where);
        
        $this->data['page_title']   = 'Employee Alloted Sections | ECMS';
        $this->data['page']         = 'attendance/Allotted/Groups/allotted_groups_v';
        $this->load->view('common/common',$this->data);
    }
    public function teacher_alloted_groups_details() {
        
        $report_type        = $this->uri->segment(4); 
        $class_alloted_id   = $this->uri->segment(5); 
        $section_id         = $this->uri->segment(6); 
        $subject_id         = $this->uri->segment(7); 
        
        
        //Report Variables 
        $section                        = $this->db->get_where('sections',array('sec_id'=>$section_id))->row();
        $this->data['section_name']     = $section->name;
        $this->data['sp_title']         = $this->db->get_where('sub_programes',array('sub_pro_id'=>$section->sub_pro_id))->row()->sp_title;
        $date['fromDate']               = $this->data['attendance_from']  = '';
        $date['toDate']                 = $this->data['attendance_to']    =  date('Y-m-d');
        $att_between['per_from']        = $this->data['percentage_from']  = '0';
        $att_between['per_to']          = $this->data['percentage_to']    = '100';
//        echo '<pre>';print_r($this->data);die;
        $where['student_status.s_status_id']    = 5;
        $where['sections.sec_id']               = $section_id;
        $like                                   = array();
         $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'sp_title',array('status'=>'yes'));
        $this->data['sections']          = $this->CRUDModel->dropDown('sections', ' Select Section ', 'sec_id', 'name',array('status'=>'On'));
        
        if($report_type == 'Subject'):
         $where['student_subject_alloted.subject_id']    = $subject_id;   
        
            $this->data['result']       = $this->ReportsModel->attendance_group_percentage_subject_report($where,$like,$date,$att_between);
        else:
            $this->data['result']       = $this->ReportsModel->student_attendance_percentage_wise($where,$like,$date,$att_between);
        endif;
        
       
         $this->data['ReportName']   = 'Attendance Percentage Report ( Enrolled Students )';
        $this->data['page']         = "attendance/Allotted/Groups/percentage_report_v";
        $this->data['page_title']   = 'Attendance Percentage Report ( Enrolled Students )| ECMS';
        $this->load->view('common/common',$this->data);
        
//           echo '<pre>';print_r($this->data['result']);die;
         
    }
    public function student_attendance_percentage_wise(){
        
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programe_id'=>1));
        $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>1));
        $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Select Section ', 'sec_id', 'name',array('status'=>'On','program_id'=>1));
        $order["column"]                = 'batch_order';
        $order["order"]                 = 'asc';
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch ', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>1),$order);
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');

        $program                        =  $this->input->post('program');
        $sub_program                    =  $this->input->post('sub_program');
        $section                        =  $this->input->post('sections_name');
        $batch                          =  $this->input->post('batch');
        $from_date                      =  $this->input->post('attendance_from');
        $to_date                        =  $this->input->post('attendance_to');

        $to_per                         =  $this->input->post('percentage_to');
        $from_per                       =  $this->input->post('percentage_from');
        $gender                         =  $this->input->post('gender');
        //like Array
        $like = '';
        $where = '';
        $att_between                        = '';

        $this->data['programId']            = '';
        $this->data['genderId']            = '';
        $this->data['programId']            = '';
        $this->data['sectionId']            = '';
        $this->data['subprogramId']         = '';
        $this->data['batchId']              = '';
        $this->data['attendance_from']      = '';
        $this->data['attendance_to']        = date('d-m-Y');
        $this->data['percentage_from']      = '0';
        $this->data['percentage_to']        = '100';

        if(!empty($to_date)):
            $date['toDate']                 = $to_date;
            $date['fromDate']               = $from_date;
            $this->data['attendance_from']  = $from_date;
            $this->data['attendance_to']    = $to_date;
        endif;
        if(!empty($to_per)):
            $att_between['per_to']          = $to_per;
            $att_between['per_from']        = $from_per;
            $this->data['percentage_from']  = $from_per;
            $this->data['percentage_to']    = $to_per;
        else:
             $att_between['per_to']          = '1';
//                $att_between['per_from']        = '';
            $this->data['percentage_from']  = '0';
            $this->data['percentage_to']    = '0';   
        endif;

            $where['student_record.programe_id'] = $program;
            $this->data['programId']    = $program;

        if(!empty($sub_program)):
             $where['sub_programes.sub_pro_id'] = $sub_program;
            $this->data['subprogramId'] = $sub_program;
        endif;
         if(!empty($batch)):
             $where['student_record.batch_id'] = $batch;
            $this->data['batchId'] = $batch;
        endif;
        if(!empty($section)):
             $where['sections.sec_id']  = $section;
            $this->data['sectionId']    = $section;
        endif;
        if(!empty($gender)):
             $where['student_record.gender_id']  = $gender;
            $this->data['genderId']    = $gender;
        endif;
         $where['student_status.s_status_id'] = 5;
        if($this->input->post('search')):
          $this->data['result']       = $this->ReportsModel->student_attendance_percentage_wise($where,$like,$date,$att_between);
//            echo '<pre>';print_r($this->data['result']);die;
         endif;


        $this->data['ReportName']   = 'Attendance Percentage Report ( Enrolled Students )';
        $this->data['page']         = "attendance/Allotted/Groups/percentage_report_v";
        $this->data['page_title']   = 'Attendance Percentage Report ( Enrolled Students )| ECMS';
        $this->load->view('common/common',$this->data); 
    }
}
