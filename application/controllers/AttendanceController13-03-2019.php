<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class AttendanceController extends AdminController {

     public function __construct() {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('AttendanceModel');
             $this->load->library("pagination");     
        }
    
    public function languages_attendance_report()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $emp_id =$session['userData']['emp_id'];
        $this->data['result'] = $this->AttendanceModel->get_alloted_languages('prospectus_batch');
        
        $this->data['page_title']   = 'Languages Monthly Attendance Report| ECMS';
        $this->data['page']         = 'attendance/languages_attendance_report';
        $this->load->view('common/common',$this->data);
    }
    
    public function students_total_classes_report()
        {
            $session = $this->session->all_userdata();
            $user_id =$session['userData']['user_id'];
            $emp_id =$session['userData']['emp_id'];
            $where = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'1');
            $subwhere = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'2');
            $this->data['result'] = $this->AttendanceModel->get_alloted_sections('class_alloted',$where);
            $this->data['subjectbase'] = $this->AttendanceModel->get_alloted_subjects('class_alloted',$subwhere);
        
            $this->data['page_title']       = 'Students Total Classes Report | ECMS';
            $this->data['page']             =  'attendance/students_total_classes_report';
            $this->load->view('common/common',$this->data); 
        }
    
    public function students_total_classes_history_report(){
 
            $uri2 = $this->uri->segment(2);
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $uri5 = $this->uri->segment(5);
            
            $this->data['empyee_name']      = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$uri4));
            $this->data['sections']         = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$uri2));
            $this->data['subject']          = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$uri3));
            if($uri5==1):
                $where = array(
                    'sec_id'=>$uri2 
                );
                $this->data['result'] = $this->AttendanceModel->get_teacher_subjects_student_degree_section($where);
            else:
                $where = array(
                     'student_subject_alloted.section_id'=>$uri2,
                     'student_subject_alloted.subject_id'=>$uri3
                    );
              $this->data['result'] = $this->AttendanceModel->get_teacher_subjects_student_degree_subjects($where);
            endif;
            $this->data['page_title']       = 'Students Total Classes History Report| ECMS';
            $this->data['page']             =  'attendance/students_total_classes_history_report';
            $this->load->view('common/common',$this->data); 
        }
    
    public function pre_board_test_report_ALevel()
    {
        $this->data['sections'] = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('program_id'=>5,'status'=>'On'));
		$like = '';
        $where = '';
        $this->data['college_no'] = "";
        $this->data['student_name'] = "";
        $this->data['sectionId']    = '';
		if($this->input->post('search')):
			$college_no   =  $this->input->post('college_no');
            $student_name =  $this->input->post('student_name');
            $section      =  $this->input->post('sections_name');
        
			if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id'] = $section;
                $this->data['sectionId']   = $section;
            endif;
           $this->data['group'] = $this->AttendanceModel->getclass_alloted('class_alloted',$where);
           $this->data['result'] = $this->AttendanceModel->get_classData($where,$like);
		 endif;
		$this->data['page']     =   "attendance/pre_board_test_marks";
		$this->data['title']    =   'Pre Board Test Marks A Level | ECMS';
		$this->load->view('common/common',$this->data);        
    }
    
    
    public function student_attendance_history_hnd()
    {          
        if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $where1['student_comulative_attendance.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            
        $this->data['std'] = $this->AttendanceModel->student_Datainfo('student_record',$where);
        $this->data['sub_program'] = $this->AttendanceModel->student_subProgram('student_comulative_attendance',$where1);
        endif;        
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'attendance/student_attendance_history_hnd';
        $this->load->view('common/common',$this->data);
    }
    
    public function student_attendance_bba_report(){
         
//            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>6));
//            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>6));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>6));
        
            $section                        =  $this->input->post('sections_name');
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            $like = '';
            $where = '';
            $this->data['sectionId']        = '';
      
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
        
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($section)):
                 $where1['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
            $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->AttendanceModel->position_report($field,'student_record', $where,$like);
                $this->data['subject'] = $this->AttendanceModel->getsubject_alloted('class_alloted',$where1);
                $this->data['ReportName']   = 'Student Attendance Report (BBA)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "attendance/student_attendance_report_bba";
                $this->data['title']        = 'Student Attendance Report (BBA) | ECMS';
                $this->load->view('common/common',$this->data);      
            else:
            $this->data['sectionId']        = '';
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
            $this->data['ReportName']   = 'Student Attendance Report (BBA)';
            $this->data['page']         = "attendance/student_attendance_report_bba";
            $this->data['title']        = 'Student Attendance Report (BBA) | ECMS';
            $this->load->view('common/common',$this->data);     
           endif; 
        }
    
    public function student_attendance_hnd_report(){
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>3));
        
            $section                        =  $this->input->post('sections_name');
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            $like = '';
            $where = '';
            $this->data['sectionId']        = '';
      
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
        
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($section)):
                 $where1['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
            $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->AttendanceModel->position_report($field,'student_record', $where,$like);
                $this->data['subject'] = $this->AttendanceModel->getsubject_alloted('class_alloted',$where1);
                $this->data['ReportName']   = 'Student Attendance Report (HND)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "attendance/student_attendance_report_bba";
                $this->data['title']        = 'Student Attendance Report (HND) | ECMS';
                $this->load->view('common/common',$this->data);      
            else:
            $this->data['sectionId']        = '';
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
            $this->data['ReportName']   = 'Student Attendance Report (HND)';
            $this->data['page']         = "attendance/student_attendance_report_bba";
            $this->data['title']        = 'Student Attendance Report (HND) | ECMS';
            $this->load->view('common/common',$this->data);     
           endif; 
        }
    
    
     public function student_attendance_law_report(){
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>9));
        
            $section                        =  $this->input->post('sections_name');
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            $like = '';
            $where = '';
            $this->data['sectionId']        = '';
      
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
        
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($section)):
                 $where1['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
            $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->AttendanceModel->position_report($field,'student_record', $where,$like);
                $this->data['subject'] = $this->AttendanceModel->getsubject_alloted('class_alloted',$where1);
                $this->data['ReportName']   = 'Student Attendance Report (BS Law)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "attendance/student_attendance_report_law";
                $this->data['title']        = 'Student Attendance Report (BS Law) | ECMS';
                $this->load->view('common/common',$this->data);      
            else:
            $this->data['studentId'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']       = '';
            $this->data['programId']  = '';
            $this->data['subprogramId']  = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            $this->data['ReportName']   = 'Student Attendance Report (BS Law)';
            $this->data['page']         = "attendance/student_attendance_report_law";
            $this->data['title']        = 'Student Attendance Report (BS Law) | ECMS';
            $this->load->view('common/common',$this->data);     
           endif; 
        }
    
    public function student_attendance_bs_english_report(){
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>8));
        
            $section                        =  $this->input->post('sections_name');
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            $like = '';
            $where = '';
            $this->data['sectionId']        = '';
      
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
        
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($section)):
                 $where1['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
            $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->AttendanceModel->position_report($field,'student_record', $where,$like);
                $this->data['subject'] = $this->AttendanceModel->getsubject_alloted('class_alloted',$where1);
                $this->data['ReportName']   = 'Student Attendance Report (BS English)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "attendance/student_attendance_report_bs_english";
                $this->data['title']        = 'Student Attendance Report (BS English) | ECMS';
                $this->load->view('common/common',$this->data);      
            else:
            $this->data['studentId'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']       = '';
            $this->data['programId']  = '';
            $this->data['subprogramId']  = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            $this->data['ReportName']   = 'Student Attendance Report (BS English)';
            $this->data['page']         = "attendance/student_attendance_report_bs_english";
            $this->data['title']        = 'Student Attendance Report (BS English) | ECMS';
            $this->load->view('common/common',$this->data);     
           endif; 
        }
    
    public function student_attendance_economics_report(){
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>14));
        
            $section                        =  $this->input->post('sections_name');
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            $like = '';
            $where = '';
            $this->data['sectionId']        = '';
      
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
        
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($section)):
                 $where1['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
            $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->AttendanceModel->position_report($field,'student_record', $where,$like);
                $this->data['subject'] = $this->AttendanceModel->getsubject_alloted('class_alloted',$where1);
                $this->data['ReportName']   = 'Student Attendance Report (BS Economics)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "attendance/student_attendance_report_economics";
                $this->data['title']        = 'Student Attendance Report (BS Economics) | ECMS';
                $this->load->view('common/common',$this->data);      
            else:
            $this->data['studentId'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']       = '';
            $this->data['programId']  = '';
            $this->data['subprogramId']  = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            $this->data['ReportName']   = 'Student Attendance Report (BS Economics)';
            $this->data['page']         = "attendance/student_attendance_report_economics";
            $this->data['title']        = 'Student Attendance Report (BS Economics) | ECMS';
            $this->load->view('common/common',$this->data);     
           endif; 
        }
    
    public function student_attendance_bs_programs_report(){
           $this->data['sections'] = $this->DropdownModel->bs_sec_dropDown('sections', '', 'sec_id','name',array('status'=>'On'));
        
            $section                        =  $this->input->post('sections_name');
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            $like = '';
            $where = '';
            $this->data['sectionId']        = '';
      
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
        
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($section)):
                 $where1['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
            $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->AttendanceModel->position_report($field,'student_record', $where,$like);
                $this->data['subject'] = $this->AttendanceModel->getsubject_alloted('class_alloted',$where1);
                $this->data['ReportName']   = 'Student Attendance Report (BS Programs)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "attendance/student_attendance_report_bs_programs";
                $this->data['title']        = 'Student Attendance Report (BS Programs) | ECMS';
                $this->load->view('common/common',$this->data);      
            else:
            $this->data['studentId'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']       = '';
            $this->data['programId']  = '';
            $this->data['subprogramId']  = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            $this->data['ReportName']   = 'Student Attendance Report (BS Programs)';
            $this->data['page']         = "attendance/student_attendance_report_bs_programs";
            $this->data['title']        = 'Student Attendance Report (BS Programs) | ECMS';
            $this->load->view('common/common',$this->data);     
           endif; 
        }
   
    
    public function student_security_record(){ 
            $this->data['from_date'] = ""; 
            $this->data['to_date'] = "";
        
            if($this->input->post('search')):
                $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
                $to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
                if(!empty($from_date)):
                    $this->data['from_date'] =$from_date;
                endif;
                if(!empty($to_date)):
                        $this->data['to_date'] =$to_date;
                endif;
        $this->data['result'] = $this->AttendanceModel->get_stdsecurityrecord('student_security',$this->data['from_date'],$this->data['to_date']);
            endif;
         $this->data['page']         = "admission/students_security_record";
                $this->data['title']        = 'Students Security List | ECMS';
                $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):
                
                 $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Students Security List');
        
                $this->excel->getActiveSheet()->setCellValue('A1', 'College#');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('D1', 'Section');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Gen. Security');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Hostel Security');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('G1','Exam Fee');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Fines');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Others');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Deduction');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Refund');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Remarks');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(12);
                
                for($col = ord('A'); $col <= ord('L'); $col++)
                {
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }              
            
            $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
                $to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
                
                if(!empty($from_date)):
                    $this->data['from_date'] =$from_date;
                endif;
                if(!empty($to_date)):
                        $this->data['to_date'] =$to_date;
                endif;
        
            $result = $this->AttendanceModel->get_stdsecurityExport('student_security',$this->data['from_date'],$this->data['to_date']);
           // echo '<pre>';print_r($result);die;    
        foreach ($result as $row){
                $exceldata[] = $row;   
            }
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='Security_'.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif; 
                    
        }
	
   public function subject_report_a_level(){
        
            $this->data['college_number']   = ''; 
            $this->data['std_name']         = ''; 
            $this->data['std_fname']        = ''; 
            if($this->input->post()):
                
            $college_number = $this->input->post('college_number');
            $section        = $this->input->post('section');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');

            $where['student_record.s_status_id'] = 5;
            $where['student_record.programe_id'] = 5;
            $like = '';
                if($college_number):
                   $where['student_record.college_no'] = $college_number;  
                   $this->data['college_number'] = $college_number; 
                endif;
                if($section):
                   $where['sections.sec_id'] = $section;  
                   $this->data['sectionId'] = $section;  
                endif;
               if($std_name):
                   $like['student_record.student_name'] = $std_name;  
                   $this->data['std_name'] = $std_name;  
                endif;
                if($std_fname):
                   $like['student_record.father_name'] = $std_fname;  
                   $this->data['std_fname'] = $std_fname;  
                endif;
                if($this->input->post('search')):
                    $this->data['subject_record'] = $this->AttendanceModel->subject_inter_record($where,$like);
                endif;
            endif;
            $whereSubPrg = array('programe_id'=>5);
            $this->data['subPrograme'] = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',$whereSubPrg);
            $this->data['HeaderPage']       = 'Students Subject Report (A Level)';
            $this->data['page_title']       = 'Students Allotted Subjects Report | ECMS';
            $this->data['page']             = 'attendance/student_a_level_report';
            $this->load->view('common/common',$this->data);
    }

public function sub_program_a_level(){
        $subProId   =  $this->input->post('subPro'); 
        $result     = $this->CRUDModel->get_where_result('sections',array('sub_pro_id'=>$subProId,'program_id'=>5,'status'=>'On'));
      foreach($result as $subRow):
          echo '<option value="'.$subRow->sec_id.'">'.$subRow->name.'</option>';
      endforeach;
  }	
    
    public function timetable()
    {       
        $session = $this->session->all_userdata();
        $emp_id =$session['userData']['emp_id'];
        $where = array('class_alloted.emp_id'=>$emp_id);
        $this->data['result_mon'] = $this->AttendanceModel->getClassDaym('class_alloted',$where);
        $this->data['result_tue'] = $this->AttendanceModel->getClassDaytu('class_alloted',$where);
        $this->data['result_wed'] = $this->AttendanceModel->getClassDayw('class_alloted',$where);
        $this->data['result_thu'] = $this->AttendanceModel->getClassDayth('class_alloted',$where);
        $this->data['result_fri'] = $this->AttendanceModel->getClassDayf('class_alloted',$where);
        $this->data['page_title']   = 'Employee Time Table | ECMS';
        $this->data['page']         = 'attendance/timetable';
        $this->load->view('common/common',$this->data);
    }
    
    public function section_base_timetable()
    {       
        $sec_id = $this->uri->segment(3);
        $where = array('class_alloted.sec_id'=>$sec_id);
        $this->data['result_mon'] = $this->AttendanceModel->getClassDaym('class_alloted',$where);
        $this->data['result_tue'] = $this->AttendanceModel->getClassDaytu('class_alloted',$where);
        $this->data['result_wed'] = $this->AttendanceModel->getClassDayw('class_alloted',$where);
        $this->data['result_thu'] = $this->AttendanceModel->getClassDayth('class_alloted',$where);
        $this->data['result_fri'] = $this->AttendanceModel->getClassDayf('class_alloted',$where);
        $this->data['page_title']   = 'Section Base Time Table | ECMS';
        $this->data['page']         = 'attendance/section_base_timetable';
        $this->load->view('common/common',$this->data);
    }
        public function add_timeTable(){
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
              
            $building_block     = $this->input->post('building_block');
            $rooms              = $this->input->post('rooms');
            $day_id             = $this->input->post('day_id');
            $sec_id             = $this->input->post('sec_id');
            $emp_id             = $this->input->post('emp_id');
            $subject_id         = $this->input->post('subject_id');
            $stime_id           = $this->input->post('stime_id');
            $etime_id           = $this->input->post('etime_id');
            $form_Code          = $this->input->post('form_Code');
            
            $check = array(
                'class_alloted.sec_id'              => $sec_id,
                'timetable.day_id'                  => $day_id,
                'timetable.stime_id'                => $stime_id,
				);
            $q = $this->AttendanceModel->getTimeTablerow('class_alloted',$check);
            $chk = array(
                
                'class_alloted.sec_id'              => $sec_id,
                'class_alloted.emp_id'              => $emp_id,
                'timetable.day_id'                  => $day_id,
                'timetable.stime_id'                => $stime_id,
				);
            $qy = $this->AttendanceModel->getTimeTablerow('class_alloted',$chk);
            $ms = '';
            $m = '';
            if($q):
            $ms = '<p style="color:red">Sorry! This Time for Class Dedicated to Other One ... <p/>'; 
            echo $ms;
            elseif($qy):
            $m = '<p style="color:red">Sorry! This Time Teacher Class Already Exist ... <p/>'; 
            echo $m;
            else:
            $checked = array(
                'day_id'        => $day_id,
                'stime_id'      => $stime_id,
                'etime_id'      => $etime_id,
                'form_Code'     => $form_Code,
                    );
            $qry = $this->CRUDModel->get_where_row('timetable_demo',$checked);
            $msg = '';
            if($qry):
             $msg = '<p style="color:red">Sorry! Double Entry Not Allowed. <p/>';  
            echo $msg;
            else:
            $data = array(
                'building_block_id' => $building_block,
                'room_id'           => $rooms,
                'day_id'            => $day_id,
                'stime_id'          => $stime_id,
                'etime_id'          => $etime_id,
                'form_Code'         => $form_Code,
                'date'              => date('Y-m-d'),
                'user_id'           => $user_id
            );
    $this->CRUDModel->insert('timetable_demo',$data);
     endif;
    $result = $this->AttendanceModel->getTimeTableDemo('timetable_demo',array('form_Code'=>$form_Code));    
       echo '<table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Block</th>
                            <th>Room</th>
                            <th>Day Name</th>
                            <th>Starting Time </th>
                            <th>Ending Time</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';         
                        foreach($result as $eRow):
                        echo '<tr id="'.$eRow->timetable_id.'Delete">
                                <td>'.$eRow->bb_name.'</td>
                                <td>'.$eRow->rm_name.'</td>
                                <td>'.$eRow->day_name.'</td>
                                <td>'.$eRow->class_stime.'</td>
                                <td>'.$eRow->class_etime.'</td>
                        <td><a href="javascript:void(0)" id="'.$eRow->timetable_id.'" class="deleteTimeTable"><i class="fa fa-trash"></i></a></td>        
                           </tr>';                      
                        endforeach;
                        endif;
                    echo '</tbody>
                </table> ';
       
        endif;
        ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deleteTimeTable').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'AttendanceController/delete_TimeTable',
                     data: {'deletId':deletId},
                     success : function(result){
                        var del = deletId+'Delete';
                        jQuery('#'+del).hide(); 
                     }
                 });

             });

            });

            </script>
<?php       
}
    public function add_timeTable_before_bulding_block(){
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $day_id   = $this->input->post('day_id');
            $sec_id   = $this->input->post('sec_id');
            $emp_id   = $this->input->post('emp_id');
            $subject_id   = $this->input->post('subject_id');
            $stime_id   = $this->input->post('stime_id');
            $etime_id   = $this->input->post('etime_id');
            $form_Code  = $this->input->post('form_Code');
            $check = array(
                'class_alloted.sec_id' => $sec_id,
                'timetable.day_id' => $day_id,
                'timetable.stime_id' => $stime_id,
				);
            $q = $this->AttendanceModel->getTimeTablerow('class_alloted',$check);
            $chk = array(
                'class_alloted.emp_id' => $emp_id,
                'timetable.day_id' => $day_id,
                'timetable.stime_id' => $stime_id,
				);
            $qy = $this->AttendanceModel->getTimeTablerow('class_alloted',$chk);
            $ms = '';
            $m = '';
            if($q):
            $ms = '<p style="color:red">Sorry! This Time for Class Dadicated to Other One ... <p/>'; 
            echo $ms;
            elseif($qy):
            $m = '<p style="color:red">Sorry! This Time Teacher Class Already Exist ... <p/>'; 
            echo $m;
            else:
            $checked = array(
                'day_id' => $day_id,
                'stime_id' => $stime_id,
                'etime_id' => $etime_id,
                'form_Code' => $form_Code,
				);
            $qry = $this->CRUDModel->get_where_row('timetable_demo',$checked);
            $msg = '';
            if($qry):
             $msg = '<p style="color:red">Sorry! Double Entry Not Allowed. <p/>';  
        echo $msg;
            else:
            $data = array(
                'day_id' => $day_id,
                'stime_id' =>$stime_id,
                'etime_id' =>$etime_id,
                'form_Code' =>$form_Code,
                'date' => date('Y-m-d'),
                'user_id' => $user_id
            );
    $this->CRUDModel->insert('timetable_demo',$data);
    
    $result = $this->AttendanceModel->getTimeTableDemo('timetable_demo');    
       echo '<table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Day Name</th>
                            <th>Starting Time </th>
                            <th>Ending Time</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';         
                        foreach($result as $eRow):
                        echo '<tr id="'.$eRow->timetable_id.'Delete">
                                <td>'.$eRow->day_name.'</td>
                                <td>'.$eRow->class_stime.'</td>
                                <td>'.$eRow->class_etime.'</td>
                        <td><a href="javascript:void(0)" id="'.$eRow->timetable_id.'" class="deleteTimeTable"><i class="fa fa-trash"></i></a></td>        
                           </tr>';                      
                        endforeach;
                        endif;
                    echo '</tbody>
                </table> ';
        endif;
        endif;
        ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deleteTimeTable').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'AttendanceController/delete_TimeTable',
                     data: {'deletId':deletId},
                     success : function(result){
                        var del = deletId+'Delete';
                        jQuery('#'+del).hide(); 
                     }
                 });

             });

            });

            </script>
<?php       
}
    
    public function delete_TimeTable(){
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('timetable_demo',array('timetable_id'=>$deletId));
    }
    
    public function class_alloted_delete()
    {          
        $this->data['emp_id'] = "";
        $this->data['sec_id'] = "";
        $this->data['subject_id'] = "";
        if($this->input->post()):
            $emp_id         = $this->input->post('emp_id');
            $sec_id         = $this->input->post('sec_id');
            $subject_id     = $this->input->post('subject_id');
            $where = "";
            if($emp_id):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if($sec_id):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if($subject_id):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
        $this->data['result'] = $this->AttendanceModel->getclass_alloted('class_alloted',$where);
        endif;
        if($this->input->post('delete')):
            
            $ides       = $this->input->post('checked');
            $class_id = $this->input->post('class_id');
         if(!empty($ides)):
             
            foreach($ides as $row=>$value):
                $this->CRUDModel->deleteid('
                class_alloted',
                 array(
                       'class_id'=>$value
                 ));
            endforeach;   
         endif;
         $this->session->set_flashdata('del_msg', 'Successfully Deleted');
         redirect('AttendanceController/class_alloted_delete');
         endif;
        $this->data['page_title']   = 'Class Alloted Delete| ECMS';
        $this->data['page']         = 'attendance/class_alloted_delete';
        $this->load->view('common/common',$this->data);
    }
    
    public function student_attendance_BsLaw_report(){
         
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>9));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>9));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>9));
        
            $section                        =  $this->input->post('sections_name');
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            $like = '';
            $where = '';
            $this->data['sectionId']        = '';
      
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
        
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($section)):
                 $where1['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
            $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->AttendanceModel->position_report($field,'student_record', $where,$like);
                $this->data['subject'] = $this->AttendanceModel->getsubject_alloted('class_alloted',$where1);
                $this->data['ReportName']   = 'Student Attendance Report (BS-Law)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "attendance/student_attendance_BsLaw_report";
                $this->data['title']        = 'Student Attendance Report (BS-Law) | ECMS';
                $this->load->view('common/common',$this->data);      
            else:
            $this->data['studentId'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']       = '';
            $this->data['programId']  = '';
            $this->data['subprogramId']  = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            $this->data['ReportName']   = 'Student Attendance Report (BS-Law)';
            $this->data['page']         = "attendance/student_attendance_BsLaw_report";
            $this->data['title']        = 'Student Attendance Report (BS-Law) | ECMS';
            $this->load->view('common/common',$this->data);     
           endif; 
        }
    
//    public function students_comulative_monthly_marks()
//    {
//        $session    = $this->session->all_userdata();
//        $user_id    = $session['userData']['user_id'];
//       if($this->input->post('search')):
//            $emp_id       =  $this->input->post('emp_id');
//            $sec_id             =  $this->input->post('sec_id');
//            $subject_id            =  $this->input->post('subject_id');
//          
//            //like Array
//            $like = '';
//            $where = '';
//            $this->data['emp_id'] = '';
//            $this->data['sec_id'] = '';
//            $this->data['subject_id'] = '';
//            
//        
//            if(!empty($emp_id)):
//                $where['hr_emp_record.emp_id'] = $emp_id;
//                $this->data['emp_id'] =$emp_id;
//            endif;
//            if(!empty($sec_id)):
//                $where['sections.sec_id'] = $sec_id;
//                $this->data['sec_id'] =$sec_id;
//            endif;
//            if(!empty($subject_id)):
//                $where['subject.subject_id'] = $subject_id;
//                $this->data['subject_id'] =$subject_id;
//            endif;
//            $this->data['result'] = $this->AttendanceModel->admin_test_history('monthly_test',$where);
//            endif;
//        
//        if($this->input->post('search_sub')):
//            
//            $emp_id       =  $this->input->post('emp_id');
//            $sec_id             =  $this->input->post('sec_id');
//            $subject_id            =  $this->input->post('subject_id');
//            $end_date            =  $this->input->post('end_date');
//          
//            //like Array
//            $like = '';
//            $where = '';
//            $this->data['emp_id'] = '';
//            $this->data['sec_id'] = '';
//            $this->data['subject_id'] = '';
//            
//        
//            if(!empty($emp_id)):
//                $where['hr_emp_record.emp_id'] = $emp_id;
//                $this->data['emp_id'] =$emp_id;
//            endif;
//            if(!empty($sec_id)):
//                $where['sections.sec_id'] = $sec_id;
//                $this->data['sec_id'] =$sec_id;
//            endif;
//            if(!empty($subject_id)):
//                $where['subject.subject_id'] = $subject_id;
//                $this->data['subject_id'] =$subject_id;
//            endif;
//            $result = $this->AttendanceModel->admin_test_history('monthly_test',$where);
//           
//            $insert = array();  
//        foreach($result as $rec)  
//        {
//            $test_id = $rec->test_id;
//            $sec_id = $rec->sec_id;
//            $subject_id = $rec->subject_id;  
//            $sub_pro_id = $rec->sub_pro_id;
//            $flag = $rec->flag;
//            if($flag == 1):
//            $where = array('section_id'=>$sec_id); 
//            $this->db->select('*');
//            $this->db->from('student_group_allotment');
//            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
//            $this->db->where($where);
//            $qry = $this->db->get();
//            else:
//            $where = array('section_id'=>$sec_id,'subject_id'=>$subject_id);
//            $this->db->select('*');
//            $this->db->from('student_subject_alloted');
//            $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id', 'left outer');
//            $this->db->where($where);
//            $qry = $this->db->get();
//            endif;
//        }
//            $i = 1;
//            foreach($qry->result() as $row):
//            $where = array(
//            'student_id'=>$row->student_id,
//            'class_alloted.class_id'=>$rec->class_id
//                       );
//            $this->db->select('*');
//            $this->db->from('class_alloted');
//            $this->db->join('monthly_test','monthly_test.class_id=class_alloted.class_id');
//            $this->db->join('monthly_test_details','monthly_test_details.test_id=monthly_test.test_id');
//            $q = $this->db->where($where)->get()->result(); 
//            $count_tm = "";
//            $count_om  = "";            
//            foreach($q as $qrow):
//                $count_tm += $qrow->tmarks;        
//                $count_om += $qrow->omarks;        
//            endforeach;  
//              $insert[] = array( 
//              'emp_id'=>$rec->emp_id,  
//              'sec_id'=>$sec_id,  
//              'subject_id'=>$subject_id,
//              'sub_pro_id'=>$sub_pro_id,
//              'student_id'=>$row->student_id,        
//              'total_test'=>count($result),        
//              'omarks'=>$count_om,        
//              'tmarks'=>$count_tm      
//                  ); 
//              endforeach;
//              $result = json_decode(json_encode($insert),False);
//            // echo '<pre>';print_r($result);die;
//       foreach($result as $inserRow):
//           $emp_id =  $inserRow->emp_id;
//           $sec_id =  $inserRow->sec_id;
//           $subject_id = $inserRow->subject_id;
//           $sub_pro_id = $inserRow->sub_pro_id;
//           $student_id = $inserRow->student_id;
//           $total_test = $inserRow->total_test;
//           $om         = $inserRow->omarks;
//           $tm         = $inserRow->tmarks;
//           $insert_dataxx = array
//                   (
//                   'emp_id'=>$emp_id,
//                   'sec_id'=>$sec_id,
//                   'subject_id'=>$subject_id,
//                   'sub_pro_id'=>$sub_pro_id,
//                   'student_id'=>$student_id,
//                   'total_test'=>$total_test,
//                   'omarks'=>$om,
//                   'tmarks'=>$tm,   
//                   'user_id'=>$user_id       
//                   );
//           $this->CRUDModel->insert('student_comulative_monthly_marks',$insert_dataxx);  
//        
//       endforeach;
//        $class_id = $rec->class_id;
//        $where = array('monthly_test.class_id'=>$class_id);
//        $attend = $this->CRUDModel->get_where_result('monthly_test',$where);
//        foreach($attend as $rowAttend):
//            $test_id = $rowAttend->test_id;
//            $where1 = array('monthly_test_details.test_id'=>$test_id);
//            $this->CRUDModel->deleteid('monthly_test_details',$where1);
//        endforeach;
//               $this->CRUDModel->deleteid('monthly_test',array('class_id'=>$class_id));
//          endif;
//            $this->data['page_title']   = 'Students Comulative Monthly Marks | ECMS';
//            $this->data['page']         = 'attendance/students_comulative_monthly_marks';
//            $this->load->view('common/common',$this->data);    
//    }
    
    
    
     public function students_comulative_monthly_marks()
    {
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
       if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $this->data['result'] = $this->AttendanceModel->admin_test_historyn('class_alloted',$where);
            endif;
        
        if($this->input->post('search_sub')):
            
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
            $end_date            =  $this->input->post('end_date');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $result = $this->AttendanceModel->admin_test_historyn('class_alloted',$where);
           
            $insert = array();  
        foreach($result as $rec)  
        {
            $sec_id = $rec->sec_id;
            $subject_id = $rec->subject_id;  
            $sub_pro_id = $rec->sub_pro_id;
            $flag = $rec->flag;
            if($flag == 1):
            $where = array('section_id'=>$sec_id); 
            $this->db->select('*');
            $this->db->from('student_group_allotment');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
            $this->db->where($where);
            $this->db->where('student_record.s_status_id','5');
            $qry = $this->db->get();
            else:
            $where = array('section_id'=>$sec_id,'subject_id'=>$subject_id);
            $this->db->select('*');
            $this->db->from('student_subject_alloted');
            $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id', 'left outer');
            $this->db->where($where);
            $this->db->where('student_record.s_status_id','5');
            $qry = $this->db->get();
            endif;
        
            $i = 1;
            foreach($qry->result() as $row):
            $where = array(
            'student_id'=>$row->student_id,
            'class_alloted.class_id'=>$rec->class_id
                       );
            $this->db->select('*');
            $this->db->from('class_alloted');
            $this->db->join('monthly_test','monthly_test.class_id=class_alloted.class_id');
            $this->db->join('monthly_test_details','monthly_test_details.test_id=monthly_test.test_id');
            $q = $this->db->where($where)->get()->result(); 
            $count_tm = "";
            $count_om  = "";            
            foreach($q as $qrow):
                $count_tm += $qrow->tmarks;        
                $count_om += $qrow->omarks;        
            endforeach;  
              $insert[] = array( 
              'emp_id'=>$rec->emp_id,  
              'sec_id'=>$sec_id,  
              'subject_id'=>$subject_id,
              'sub_pro_id'=>$sub_pro_id,
              'student_id'=>$row->student_id,        
              'total_test'=>count($q),        
              'omarks'=>$count_om,        
              'tmarks'=>$count_tm      
                  ); 
              endforeach;
        }
              $result = json_decode(json_encode($insert),False);
            // echo '<pre>';print_r($result);die;
       foreach($result as $inserRow):
           $emp_id =  $inserRow->emp_id;
           $sec_id =  $inserRow->sec_id;
           $subject_id = $inserRow->subject_id;
           $sub_pro_id = $inserRow->sub_pro_id;
           $student_id = $inserRow->student_id;
           $total_test = $inserRow->total_test;
           $om         = $inserRow->omarks;
           $tm         = $inserRow->tmarks;
           $insert_dataxx = array
                   (
                   'emp_id'=>$emp_id,
                   'sec_id'=>$sec_id,
                   'subject_id'=>$subject_id,
                   'sub_pro_id'=>$sub_pro_id,
                   'student_id'=>$student_id,
                   'total_test'=>$total_test,
                   'omarks'=>$om,
                   'tmarks'=>$tm,   
                   'user_id'=>$user_id       
                   );
           $this->CRUDModel->insert('student_comulative_monthly_marks',$insert_dataxx);  
       endforeach;
        $where = array('class_alloted.sec_id'=>$sec_id);
        $this->db->select('class_alloted.*,monthly_test.*');
        $this->db->from('class_alloted');
        $this->db->join('monthly_test','monthly_test.class_id=class_alloted.class_id');
        $test = $this->db->where($where)->get()->result();
        foreach($test as $rowTest):
            $test_id = $rowTest->test_id;
            $class_id = $rowTest->class_id;
            $where1 = array('monthly_test_details.test_id'=>$test_id);
            $this->CRUDModel->deleteid('monthly_test_details',$where1);
        endforeach;
        $this->CRUDModel->deleteid('monthly_test',array('class_id'=>$class_id));
          endif;
            $this->data['page_title']   = 'Students Comulative Monthly Marks | ECMS';
            $this->data['page']         = 'attendance/students_comulative_monthly_marks';
            $this->load->view('common/common',$this->data);    
    }
    
    public function language_monthly_attendance_report(){

                $programe_id = $this->uri->segment(3);
                $batch_id = $this->uri->segment(4);
                if($this->input->post()):
                    $monthNum  =  $this->input->post('month');
                    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                    $monthName = $dateObj->format('F'); // March
                    $this->data['month_name']       =  $monthName;
                    $this->data['current_month']    =  $this->input->post('month');
                    $this->data['current_year']     =  $this->input->post('year');
                else:
                    $this->data['current_month']    =  date("m",strtotime(date('d-m-y')));
                    $this->data['month_name']       =  date("F",strtotime(date('d-m-y')));
                    $this->data['current_year']     =  date("Y",strtotime(date('d-m-Y')));  
                endif;
                    $this->data['month']            = $this->CRUDModel->dropDown('month', 'Month', 'mth_id', 'mth_title');
                    $this->data['year']             = $this->CRUDModel->dropDown('year', 'Year', 'yr_id', 'yr_title');
                    $this->data['program']  = $this->CRUDModel->get_where_row('programes_info',array('programe_id'=>$programe_id));
                    $this->data['batch']    = $this->CRUDModel->get_where_row('prospectus_batch',array('batch_id'=>$batch_id));
                    $where = array(
                        'student_record.programe_id'=>$programe_id,
                        'student_record.batch_id'=>$batch_id
                        );
                    $this->data['result'] = $this->AttendanceModel->get_language_students($where);
                
                $this->data['page_title']       = 'Language Monthly Attendance Report | ECMS';
                $this->data['page']             =  'attendance/language_monthly_attendance_report';
                $this->load->view('common/common',$this->data); 
            }
    
    public function student_change_status_inter()
    {   
        $where = '';
        $this->data['college_no']       = '';
        $this->data['student_id']     = '';
        if($this->input->post()):
            $college_no                     =  $this->input->post('college_no');
            $student_id                   =  $this->input->post('student_id');
        if(!empty($student_id)):
            $where['student_record.student_id']       = $student_id;
            $this->data['student_id'] = $student_id;
        endif;
        if(!empty($college_no)):
            $where['student_record.college_no']        = $college_no;
            $this->data['college_no']   = $college_no;
        endif;                 

        $this->data['result'] = $this->AttendanceModel->student_status_change_inter('student_record', $where);
        endif;
           $this->data['page_title']   = 'Inter Student Change Status | ECMS';
           $this->data['page']         = 'attendance/student_change_status_inter';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function student_change_status_degree()
    {   
        $where = '';
        $this->data['college_no']       = '';
        $this->data['student_id']     = '';
        if($this->input->post()):
            $college_no                     =  $this->input->post('college_no');
            $student_id                   =  $this->input->post('student_id');
        if(!empty($student_id)):
            $where['student_record.student_id']       = $student_id;
            $this->data['student_id'] = $student_id;
        endif;
        if(!empty($college_no)):
            $where['student_record.college_no']        = $college_no;
            $this->data['college_no']   = $college_no;
        endif;                 

        $this->data['result'] = $this->AttendanceModel->student_status_change_degree('student_record', $where);
        endif;
           $this->data['page_title']   = 'Degree Student Change Status | ECMS';
           $this->data['page']         = 'attendance/student_change_status_degree';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function student_change_status_bcs()
    {   
        $where = '';
        $this->data['college_no']       = '';
        $this->data['student_id']     = '';
        if($this->input->post()):
            $college_no                     =  $this->input->post('college_no');
            $student_id                   =  $this->input->post('student_id');
        if(!empty($student_id)):
            $where['student_record.student_id']       = $student_id;
            $this->data['student_id'] = $student_id;
        endif;
        if(!empty($college_no)):
            $where['student_record.college_no']        = $college_no;
            $this->data['college_no']   = $college_no;
        endif;                 

        $this->data['result'] = $this->AttendanceModel->student_status_change_bcs('student_record', $where);
        endif;
           $this->data['page_title']   = 'BCS Student Change Status | ECMS';
           $this->data['page']         = 'attendance/student_change_status_bcs';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function student_change_status_hnd()
    {   
        $where = '';
        $this->data['college_no']       = '';
        $this->data['student_id']     = '';
        if($this->input->post()):
            $college_no                     =  $this->input->post('college_no');
            $student_id                   =  $this->input->post('student_id');
        if(!empty($student_id)):
            $where['student_record.student_id']       = $student_id;
            $this->data['student_id'] = $student_id;
        endif;
        if(!empty($college_no)):
            $where['student_record.college_no']        = $college_no;
            $this->data['college_no']   = $college_no;
        endif;                 

        $this->data['result'] = $this->AttendanceModel->student_status_change_hnd('student_record', $where);
        endif;
           $this->data['page_title']   = 'HND Student Change Status | ECMS';
           $this->data['page']         = 'attendance/student_change_status_hnd';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function change_attendance_status_inter()
    {
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $attendance_date  =  $this->input->post('attendance_date');
            $status           =  $this->input->post('status');
            $student_id       =  $this->input->post('student_id');
            $date_1 = date('Y-m-d', strtotime($attendance_date));
            $where = array('student_attendance_details.student_id'=>$student_id);
            $where1 = array('student_attendance.attendance_date'=>$date_1);
            $q = $this->AttendanceModel->get_Student_Attendance($where,$where1);
           //  echo '<pre>';print_r($q);die;
            foreach($q as $isRow):
            $where2 = array('student_id'=>$isRow->student_id, 'attend_id'=>$isRow->attend_id);
            $data = array(
                'status' =>$status,
                'updated_user_id' =>$user_id,
              );
            $this->CRUDModel->update('student_attendance_details',$data,$where2);
            endforeach;
        endif;
        redirect('AttendanceController/student_change_status_inter');
    }
    
    public function change_attendance_status_degree()
    {
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $attendance_date  =  $this->input->post('attendance_date');
            $status           =  $this->input->post('status');
            $student_id       =  $this->input->post('student_id');
            $date_1 = date('Y-m-d', strtotime($attendance_date));
            $where = array('student_attendance_details.student_id'=>$student_id);
            $where1 = array('student_attendance.attendance_date'=>$date_1);
            $q = $this->AttendanceModel->get_Student_Attendance($where,$where1);
           //  echo '<pre>';print_r($q);die;
            foreach($q as $isRow):
            $where2 = array('student_id'=>$isRow->student_id, 'attend_id'=>$isRow->attend_id);
            $data = array(
                'status' =>$status,
                'updated_user_id' =>$user_id,
              );
            $this->CRUDModel->update('student_attendance_details',$data,$where2);
            endforeach;
        endif;
        redirect('AttendanceController/student_change_status_degree');
    }
    
    public function change_attendance_status_bcs()
    {
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $attendance_date  =  $this->input->post('attendance_date');
            $status           =  $this->input->post('status');
            $student_id       =  $this->input->post('student_id');
            $date_1 = date('Y-m-d', strtotime($attendance_date));
            $where = array('student_attendance_details.student_id'=>$student_id);
            $where1 = array('student_attendance.attendance_date'=>$date_1);
            $q = $this->AttendanceModel->get_Student_Attendance($where,$where1);
           //  echo '<pre>';print_r($q);die;
            foreach($q as $isRow):
            $where2 = array('student_id'=>$isRow->student_id, 'attend_id'=>$isRow->attend_id);
            $data = array(
                'status' =>$status,
                'updated_user_id' =>$user_id,
              );
            $this->CRUDModel->update('student_attendance_details',$data,$where2);
            endforeach;
        endif;
        redirect('AttendanceController/student_change_status_bcs');
    }
    
    public function change_attendance_status_hnd()
    {
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $attendance_date  =  $this->input->post('attendance_date');
            $status           =  $this->input->post('status');
            $student_id       =  $this->input->post('student_id');
            $date_1 = date('Y-m-d', strtotime($attendance_date));
            $where = array('student_attendance_details.student_id'=>$student_id);
            $where1 = array('student_attendance.attendance_date'=>$date_1);
            $q = $this->AttendanceModel->get_Student_Attendance($where,$where1);
           //  echo '<pre>';print_r($q);die;
            foreach($q as $isRow):
            $where2 = array('student_id'=>$isRow->student_id, 'attend_id'=>$isRow->attend_id);
            $data = array(
                'status' =>$status,
                'updated_user_id' =>$user_id,
              );
            $this->CRUDModel->update('student_attendance_details',$data,$where2);
            endforeach;
        endif;
        redirect('AttendanceController/student_change_status_hnd');
    }
    
    public function pre_board_test_report()
    {
        $this->data['sections'] = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('program_id'=>1,'status'=>'On'));
		$like = '';
        $where = '';
        $this->data['college_no'] = "";
        $this->data['student_name'] = "";
        $this->data['sectionId']    = '';
		if($this->input->post('search')):
			$college_no   =  $this->input->post('college_no');
            $student_name =  $this->input->post('student_name');
            $section =  $this->input->post('sections_name');
        
			if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id'] = $section;
                $this->data['sectionId']   = $section;
            endif;
           $this->data['group'] = $this->AttendanceModel->getclass_alloted('class_alloted',$where);
           $this->data['result'] = $this->AttendanceModel->get_classData($where,$like);
		 endif;
		$this->data['page']     =   "attendance/pre_board_test_marks";
		$this->data['title']    =   'Pre Board Test Marks | ECMS';
		$this->load->view('common/common',$this->data);        
    }
    
    public function pre_board_test_report_degree()
    {
        $this->data['sections'] = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('program_id'=>4,'status'=>'On'));
		$like = '';
        $where = '';
        $this->data['college_no'] = "";
        $this->data['student_name'] = "";
        $this->data['sectionId']    = '';
		if($this->input->post('search')):
			$college_no   =  $this->input->post('college_no');
            $student_name =  $this->input->post('student_name');
            $section =  $this->input->post('sections_name');
        
			if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id'] = $section;
                $this->data['sectionId']   = $section;
            endif;
           $this->data['group'] = $this->AttendanceModel->getclass_alloted('class_alloted',$where);
           $this->data['result'] = $this->AttendanceModel->get_classData($where,$like);
		 endif;
		$this->data['page']     =   "attendance/pre_board_test_marks";
		$this->data['title']    =   'Pre Board Test Marks | ECMS';
		$this->load->view('common/common',$this->data);        
    }
    
    public function student_attendance_bcs_report(){
         
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>2));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>2));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>2));
        
            $section                        =  $this->input->post('sections_name');
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            $like = '';
            $where = '';
            $this->data['sectionId']        = '';
      
            $this->data['fromDate']  = "";
            $this->data['toDate']    = "";
        
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($section)):
                 $where1['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
            $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->AttendanceModel->position_report($field,'student_record', $where,$like);
                $this->data['subject'] = $this->AttendanceModel->getsubject_alloted('class_alloted',$where1);
                $this->data['ReportName']   = 'Student Attendance Report (BCS)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "attendance/student_attendance_report_bcs";
                $this->data['title']        = 'Student Attendance Report (BCS) | ECMS';
                $this->load->view('common/common',$this->data);      
            else:
            $this->data['studentId'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']       = '';
            $this->data['programId']  = '';
            $this->data['subprogramId']  = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            $this->data['ReportName']   = 'Student Attendance Report (BCS)';
            $this->data['page']         = "attendance/student_attendance_report_bcs";
            $this->data['title']        = 'Student Attendance Report (BCS) | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
    
    public function subject_report_inter(){
        
            $this->data['college_number']   = ''; 
            $this->data['std_name']         = ''; 
            $this->data['std_fname']        = ''; 
            if($this->input->post()):
                
            $college_number = $this->input->post('college_number');
            $section        = $this->input->post('section');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');

            $where['student_record.s_status_id'] = 5;
            $where['student_record.programe_id'] = 1;
            $like = '';
                if($college_number):
                   $where['student_record.college_no'] = $college_number;  
                   $this->data['college_number'] = $college_number; 
                endif;
                if($section):
                   $where['sections.sec_id'] = $section;  
                   $this->data['sectionId'] = $section;  
                endif;
               if($std_name):
                   $like['student_record.student_name'] = $std_name;  
                   $this->data['std_name'] = $std_name;  
                endif;
               
                if($std_fname):
                   $like['student_record.father_name'] = $std_fname;  
                   $this->data['std_fname'] = $std_fname;  
                endif;
                if($this->input->post('search')):
                    $this->data['subject_record'] = $this->AttendanceModel->subject_inter_record($where,$like);
                endif;

                
               
            endif;
         
            $whereSubPrg                       = array('programe_id'=>1);
            $this->data['subPrograme']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',$whereSubPrg);
           
            $this->data['HeaderPage']       = 'Student Subject Report (Inter)';
            $this->data['page_title']       = 'Student Attendance Report | ECMS';
            $this->data['page']             = 'attendance/student_wise_inter_report';
            $this->load->view('common/common',$this->data);
    }
    public function sub_program_inter(){
    
        $subProId   =  $this->input->post('subPro'); 
        $result     = $this->CRUDModel->get_where_result('sections',array('sub_pro_id'=>$subProId,'program_id'=>1,'status'=>'On'));
      
      foreach($result as $subRow):
          echo '<option value="'.$subRow->sec_id.'">'.$subRow->name.'</option>';
      endforeach;
  }
  
  public function sub_program_alevel(){
    
        $subProId   =  $this->input->post('subPro'); 
        $result     = $this->CRUDModel->get_where_result('sections',array('sub_pro_id'=>$subProId,'program_id'=>5,'status'=>'On'));
      
      foreach($result as $subRow):
          echo '<option value="'.$subRow->sec_id.'">'.$subRow->name.'</option>';
      endforeach;
  }

  
    public function subject_report_degree(){
        
            $this->data['college_number']   = ''; 
            $this->data['std_name']         = ''; 
            $this->data['std_fname']        = ''; 
            if($this->input->post()):
                
                $college_number = $this->input->post('college_number');
                $section        = $this->input->post('section');
                $std_name       = $this->input->post('std_name');
                $std_fname      = $this->input->post('std_fname');
                
                $where['student_record.s_status_id'] = 5;
                $where['student_record.programe_id'] = 4;
                $like = '';
                if($college_number):
                   $where['student_record.college_no'] = $college_number;  
                   $this->data['college_number'] = $college_number; 
                endif;
                if($section):
                   $where['sections.sec_id'] = $section;  
                   $this->data['sectionId'] = $section;  
                endif;
               if($std_name):
                   $like['student_record.student_name'] = $std_name;  
                   $this->data['std_name'] = $std_name;  
                endif;
               
                if($std_fname):
                   $like['student_record.father_name'] = $std_fname;  
                   $this->data['std_fname'] = $std_fname;  
                endif;
                if($this->input->post('search')):
                    $this->data['subject_record'] = $this->AttendanceModel->subject_inter_record($where,$like);
                endif;

                
               
            endif;
         
            $whereSubPrg                       = array('programe_id'=>4);
            $this->data['subPrograme']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',$whereSubPrg);
           
            $this->data['HeaderPage']       = 'Student Subject Report (Degree)';
            $this->data['page_title']       = 'Student Attendance Report | ECMS';
            $this->data['page']             = 'attendance/student_wise_degree_report';
            $this->load->view('common/common',$this->data);
    }
    public function get_session_degree(){
    
        $subProId   =  $this->input->post('subPro'); 
        $result     = $this->CRUDModel->get_where_result('sections',array('status'=>'On','sub_pro_id'=>$subProId,'program_id'=>4));
      
      foreach($result as $subRow):
          echo '<option value="'.$subRow->sec_id.'">'.$subRow->name.'</option>';
      endforeach;
  }      
        
    public function get_by_id($table,$id){
    $query = $this->db->select('*')
            ->from($table)
            ->where($id)
            ->get();
      return $query->result();
    }
    
    public function class_slots()
    {       
        $this->data['result']       = $this->AttendanceModel->getslots();
        $this->data['page_title']   = 'Class SLots | ECMS';
        $this->data['page']         = 'attendance/class_slots';
        $this->load->view('common/common',$this->data);
    }
    
    public function delete_slots()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('slot_id'=>$id);
        $this->CRUDModel->deleteid('class_slots',$where);
        redirect('AttendanceController/class_slots');
	}
    
    public function add_class_slot()
    {       
        if($this->input->post()):
            $class_start_time      = $this->input->post('class_start_time');
            $class_end_time      = $this->input->post('class_end_time');
            $data       = array(
                'class_start_time' =>$class_start_time,
                'class_end_time' =>$class_end_time
            );
            $this->CRUDModel->insert('class_slots',$data);
            $this->data['page_title']   = 'Class SLots | ECMS';
            $this->data['page']         = 'attendance/class_slots';
            $this->load->view('common/common',$this->data);
            redirect('AttendanceController/class_slots');
          else:
              redirect('/');
        endif;
    }
    
    public function subjects()
    {       
   
        if($this->input->post()):
            
            $subject_id     = $this->input->post('subject_id');
            $program_id     = $this->input->post('program_id');
            $sub_id         = $this->input->post('sub_proId');
              $where = '';
            if($subject_id):
                $where['subject.subject_id'] = $subject_id;
            endif;
            
            if($program_id):
                $where['programes_info.programe_id'] = $program_id;
            endif;
            
            if($sub_id):
                $where['sub_programes.sub_pro_id'] = $sub_id;
            endif;
            
            $this->data['result']       = $this->AttendanceModel->getsubjects('subject',$where);
            else:
             $this->data['result']       = $this->AttendanceModel->getsubjects('subject');
        endif;
        
        $this->data['page_title']   = 'Subjects | ECMS';
        $this->data['page']         = 'attendance/subjects';
        $this->load->view('common/common',$this->data);
    }
    
    public function delete_subject()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('subject_id'=>$id);
        $this->CRUDModel->deleteid('subject',$where);
        redirect('AttendanceController/subjects');
	}
    
    public function add_subject()
    {       
        if($this->input->post()):
            $title      = $this->input->post('title');
            $programe_id      = $this->input->post('programe_id');
            $sub_pro_id      = $this->input->post('sub_pro_id');
            $data       = array(
                'title' =>$title,
                'programe_id' =>$programe_id,
                'sub_pro_id' =>$sub_pro_id
            );
            endif;
            $this->CRUDModel->insert('subject',$data);
            $this->data['page_title']   = 'Subjects | ECMS';
            $this->data['page']         = 'attendance/subjects';
            $this->load->view('common/common',$this->data);
            redirect('AttendanceController/subjects');
         
    }
    
    public function update_subject($id)
    {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $title      = $this->input->post('title');
            $programe_id      = $this->input->post('programe_id');
            $sub_pro_id      = $this->input->post('sub_pro_id');
            $data       = array(
                'title' =>$title,
                'programe_id' =>$programe_id,
                'sub_pro_id' =>$sub_pro_id
            );
            $where = array('subject_id'=>$id);
            $this->CRUDModel->update('subject',$data, $where);
            $this->data['page_title']   = 'Subjects | ECMS';
            $this->data['page']         = 'attendance/subjects';
            $this->load->view('common/common',$this->data);
            redirect('AttendanceController/subjects');
        endif;
        if($id):
                $where = array('subject.subject_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('subject',$where);
                $this->data['page_title']        = 'Update Subject | ECMS';
                $this->data['page']        =  'attendance/update_subject';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
//    public function class_alloted()
//    {          
//        
//        if($this->input->post()):
//            $emp_idCode     = $this->input->post('emp_idCode');
//            $sec_id         = $this->input->post('sec_id');
//            $subject_id     = $this->input->post('subject_id');
//            $where = "";
//        if($emp_idCode):
//            $where['class_alloted.emp_id'] = $emp_idCode;
//        endif;
//         
//        if($sec_id):
//            $where['sections.sec_id'] = $sec_id;
//        endif;
//           
//        if($subject_id):
//            $where['subject.subject_id'] = $subject_id;
//        endif;
//            $this->data['result']       = $this->AttendanceModel->getclass_alloted('class_alloted',$where);
//        else:
////            $this->data['result']       = $this->AttendanceModel->getclass_alloted('class_alloted');
//        endif;
//        
//        $this->data['page_title']   = 'Class Alloted | ECMS';
//        $this->data['page']         = 'attendance/class_alloted';
//        $this->load->view('common/common',$this->data);
//    }
    
    public function student_attendance()
    {       
        $session = $this->session->all_userdata();
        $emp_id =$session['userData']['emp_id'];
        $where = array('class_alloted.emp_id'=>$emp_id);
        $this->data['result']       = $this->AttendanceModel->getstudent_attendance('student_attendance',$where);
        $this->data['page_title']   = 'Student Attendance | ECMS';
        $this->data['page']         = 'attendance/students_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function class_alloted()
    {          
        $this->data['emp_id'] = "";
        $this->data['sec_id'] = "";
        $this->data['subject_id'] = "";
        if($this->input->post()):
       // echo '<pre>';print_r($this->input->post());die;
            $emp_id         = $this->input->post('emp_id');
            $sec_id         = $this->input->post('sec_id');
            $subject_id     = $this->input->post('subject_id');
            
            $where = "";
        
        if($emp_id):
            $where['hr_emp_record.emp_id'] = $emp_id;
            $this->data['emp_id'] =$emp_id;
        endif;
         
        if($sec_id):
            $where['sections.sec_id'] = $sec_id;
            $this->data['sec_id'] =$sec_id;
        endif;
           
        if($subject_id):
            $where['subject.subject_id'] = $subject_id;
            $this->data['subject_id'] =$subject_id;
        endif;
        
            $this->data['result'] = $this->AttendanceModel->getclass_alloted('class_alloted',$where);
        endif;
        
        if($this->input->post('export')):
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Employee Class Allotted List');
                $this->excel->getActiveSheet()->setCellValue('A1', 'Employee Name');          
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1','Section Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                           
                $this->excel->getActiveSheet()->setCellValue('C1', 'Subject Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
    
            for($col = ord('A'); $col <= ord('C'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);               
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                }
                
                    
            $emp_id         = $this->input->post('emp_id');
            $sec_id         = $this->input->post('sec_id');
            $subject_id     = $this->input->post('subject_id');
        
            $where = "";
            $this->data['emp_id'] = "";
            $this->data['sec_id'] = "";
            $this->data['subject_id'] = "";

            if($emp_id):
            $where['hr_emp_record.emp_id'] = $emp_id;
            $this->data['emp_id'] =$emp_id;
            endif;

            if($sec_id):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;

            if($subject_id):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
        
                $result = $this->AttendanceModel->class_alloted_excel('class_alloted',$where);
    
                $exceldata="";
                foreach ($result as $row)
                {
                    $exceldata[] = $row;
                }              
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Employee_Class_Allotted_List.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif;    
        
        $this->data['page_title']   = 'Class Alloted | ECMS';
        $this->data['page']         = 'attendance/class_alloted';
        $this->load->view('common/common',$this->data);
    }
    
    public function monthly_test()
    {       
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        $emp_id     = $session['userData']['emp_id'];
        $where      = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'1');
        $subwhere   = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'2');
        
        $this->data['result']       = $this->AttendanceModel->get_alloted_sections('class_alloted',$where);
        $this->data['subjectbase']  = $this->AttendanceModel->get_alloted_subjects('class_alloted',$subwhere);
        
        $this->data['page_title']   = 'Monthly Test | ECMS';
        $this->data['page']         = 'attendance/monthly_test';
        $this->load->view('common/common',$this->data);
    }
    
    public function monthly_test_history()
    {       
        $session = $this->session->all_userdata();
        $emp_id =$session['userData']['emp_id'];
        $where = array('class_alloted.emp_id'=>$emp_id);
        $this->data['result']       = $this->AttendanceModel->getstudent_test('monthly_test',$where);
        $this->data['page_title']   = 'Monthly Test History | ECMS';
        $this->data['page']         = 'attendance/monthly_test_history';
        $this->load->view('common/common',$this->data);
    }
    
    public function print_test_marks_list()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('monthly_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        $this->data['count']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        $this->data['page_title']   = 'Print Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/print_test_marks_list';
        $this->load->view('common/common',$this->data);
    }
    
    public function pre_board_test_history()
    {       
        $session = $this->session->all_userdata();
        $emp_id =$session['userData']['emp_id'];
        $where = array('class_alloted.emp_id'=>$emp_id);
        $this->data['result']       = $this->AttendanceModel->getpreboard_test('pre_board_test',$where);
        $this->data['page_title']   = 'Pre Board Test History | ECMS';
        $this->data['page']         = 'attendance/pre_board_test_history';
        $this->load->view('common/common',$this->data);
    }
    
    public function pre_board_subjectbasetest()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $where = array('student_subject_alloted.subject_id'=>$subject_id,'student_subject_alloted.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where);
         $this->data['monthId']  = date("m",strtotime(date('d-m-y')));
        $this->data['yearId']  = date("Y",strtotime(date('d-m-Y')));
        
        $this->data['month']     = $this->CRUDModel->dropDown('month', '', 'mth_num', 'mth_title');
        $this->data['year']      = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_title');
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $sub_pro_id     = $this->input->post('sub_pro_id');
        $test_date  = $this->input->post('year').'-'.$this->input->post('month').'-'.date("d",strtotime(date('d-m-Y')));
        $tdate = $this->input->post('test_date');
        $student_id = $this->input->post('student_id');
        $tmarks = $this->input->post('tmarks');
        $omarks = $this->input->post('omarks');
        $month = $this->input->post('month');
        $year =  $this->input->post('year');   
        $checked     = array
                (
                    'class_id'=>$class_id,
                    'month(test_date)'=>$month,
                    'year(test_date)'=>$year
                );
            $qry = $this->CRUDModel->get_where_row('pre_board_test',$checked);
            if(!empty($qry)):
            $this->session->set_flashdata('msg', 'Sorry! Test Record Already Exist, if you want to update then go to "Monthly Test History" page');
            redirect('AttendanceController/pre_board_test');
            else:                    
            $data  = array
                     (
                         'class_id' =>$class_id,
                         'sub_pro_id' =>$sub_pro_id,
                         'test_date' =>$test_date,
                         'user_id' =>$user_id
                      );
                $test_id = $this->CRUDModel->insert('pre_board_test',$data);


                 $combine = array_combine($student_id, $omarks);

                foreach($combine as $key=>$row):

                    $test_data = array
                    (
                        'test_id'=>$test_id,
                        'student_id'=>$key,
                        'tmarks'=>$tmarks,
                        'omarks'=>$row
                    );
                    $this->CRUDModel->insert('pre_board_test_details',$test_data);
                endforeach;

                $this->session->set_flashdata('msg', 'Successfully Submitted.');
                redirect('AttendanceController/pre_board_test'); 
        endif;
     endif;
        $this->data['page_title']   = 'Subject Base Pre Board Test | ECMS';
        $this->data['page']         = 'attendance/pre_board_subjectbasetest';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_monthly_test()
    {       
//        $where = array('class_alloted.flag'=>'1');
//        $subwhere = array('class_alloted.flag'=>'2');
//        $this->data['result'] = $this->AttendanceModel->get_alloted_sections('class_alloted',$where);
//        $this->data['subjectbase'] = $this->AttendanceModel->get_alloted_subjects('class_alloted',$subwhere);
        
        $this->data['page_title']   = 'Admin Monthly Test | ECMS';
        $this->data['page']         = 'attendance/admin_monthly_test';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_sectionbasetest()
    {       
        $session        = $this->session->all_userdata();
        $user_id        = $session['userData']['user_id'];
        $class_id       = $this->uri->segment(3);
        $sec_id         = $this->uri->segment(4);
        $where          = array('student_group_allotment.section_id'=>$sec_id);
        $this->data['monthId']  = date("m",strtotime(date('d-m-y')));
        $this->data['yearId']  = date("Y",strtotime(date('d-m-Y')));
        $this->data['month']     = $this->CRUDModel->dropDown('month', '', 'mth_num', 'mth_title');
        $this->data['year']      = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_title');
        $this->data['result']   = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
        $this->data['secclass'] = $this->AttendanceModel->getallotedsections('class_alloted');
        
        if($this->input->post()):
            $class_id   = $this->input->post('class_id');
            $sec_id     = $this->input->post('sec_id');
            $test_date  = $this->input->post('year').'-'.$this->input->post('month').'-'.date("d",strtotime(date('d-m-Y')));
            $student_id = $this->input->post('student_id');
            $month = $this->input->post('month');
            $year = $this->input->post('year');
            $tmarks     = $this->input->post('tmarks');
            $omarks     = $this->input->post('omarks');
            $checked     = array
                (
                    'class_id'=>$class_id,
                    'month(test_date)'=>$month,
                    'year(test_date)'=>$year
                );
            $qry = $this->CRUDModel->get_where_row('monthly_test',$checked);
            if(!empty($qry)):
            $this->session->set_flashdata('msg', 'Sorry! Test Record Already Exist, if you want to update then go to "Admin Monthly Test History" page');
            redirect('AttendanceController/admin_monthly_test');
            else:
            $data  = array(
                'class_id'  =>$class_id,
                'test_date' =>$test_date,
                'user_id'   =>$user_id
                );
            $test_id        = $this->CRUDModel->insert('monthly_test',$data);
            $combine        = array_combine($student_id,$omarks);
            foreach($combine as $key=>$row):
                $test_data  = array(
                'test_id'   =>$test_id,
                'student_id'=>$key,
                'tmarks'    =>$tmarks,
                'omarks'    =>$row
                );
                $this->CRUDModel->insert('monthly_test_details',$test_data);
                endforeach;
            $this->session->set_flashdata('msg', 'Monthly Test Successfully Submitted.');
            redirect('AttendanceController/admin_monthly_test');     
        endif;
        endif;
        $this->data['page_title']   = 'Admin Section Base Monthly Test | ECMS';
        $this->data['page']         = 'attendance/admin_sectionbasetest';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_subjectbasetest()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        
        $this->data['monthId']  = date("m",strtotime(date('d-m-y')));
        $this->data['yearId']  = date("Y",strtotime(date('d-m-Y')));
        $this->data['month']     = $this->CRUDModel->dropDown('month', '', 'mth_num', 'mth_title');
        $this->data['year']      = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_title');
        $where = array('student_subject_alloted.subject_id'=>$subject_id,'student_subject_alloted.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where);
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $test_date  = $this->input->post('year').'-'.$this->input->post('month').'-'.date("d",strtotime(date('d-m-Y')));
        $student_id = $this->input->post('student_id');
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $tmarks = $this->input->post('tmarks');
        $omarks = $this->input->post('omarks');
         $checked     = array
                (
                    'class_id'=>$class_id,
                    'month(test_date)'=>$month,
                    'year(test_date)'=>$year
                );
            $qry = $this->CRUDModel->get_where_row('monthly_test',$checked);
            if(!empty($qry)):
            $this->session->set_flashdata('msg', 'Sorry! Test Record Already Exist, if you want to update then go to "Admin Monthly Test History" page');
            redirect('AttendanceController/admin_monthly_test');
            else:   
        $data  = array
         (
             'class_id' =>$class_id,
             'test_date' =>$test_date,
             'user_id' =>$user_id
          );
            $test_id = $this->CRUDModel->insert('monthly_test',$data);


             $combine = array_combine($student_id, $omarks);

            foreach($combine as $key=>$row):

                $test_data = array
                (
                    'test_id'=>$test_id,
                    'student_id'=>$key,
                    'tmarks'=>$tmarks,
                    'omarks'=>$row
                );
                $this->CRUDModel->insert('monthly_test_details',$test_data);
            endforeach;

            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/admin_monthly_test'); 
        endif;
        endif;
        $this->data['page_title']   = 'Admin Subject Base Test | ECMS';
        $this->data['page']         = 'attendance/admin_subjectbasetest';
        $this->load->view('common/common',$this->data);
    }
    
    public function subjectbasetest()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $where = array('student_subject_alloted.subject_id'=>$subject_id,'student_subject_alloted.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where);
         $this->data['monthId']  = date("m",strtotime(date('d-m-y')));
        $this->data['yearId']  = date("Y",strtotime(date('d-m-Y')));
        
        $this->data['month']     = $this->CRUDModel->dropDown('month', 'Select Month', 'mth_num', 'mth_title');
        $this->data['year']      = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_title');
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $test_date  = $this->input->post('year').'-'.$this->input->post('month').'-'.date("d",strtotime(date('d-m-Y')));
        $tdate = $this->input->post('test_date');
        $student_id = $this->input->post('student_id');
        $tmarks = $this->input->post('tmarks');
        $omarks = $this->input->post('omarks');
        $month = $this->input->post('month');
        $year =  $this->input->post('year');   
        $checked     = array
                (
                    'class_id'=>$class_id,
                    'month(test_date)'=>$month,
                    'year(test_date)'=>$year
                );
            $qry = $this->CRUDModel->get_where_row('monthly_test',$checked);
            if(!empty($qry)):
            $this->session->set_flashdata('msg', 'Sorry! Test Record Already Exist, if you want to update then go to "Monthly Test History" page');
            redirect('AttendanceController/monthly_test');
            else:                    
$data  = array
                     (
                         'class_id' =>$class_id,
                         'test_date' =>$test_date,
                         'user_id' =>$user_id
                      );
                $test_id = $this->CRUDModel->insert('monthly_test',$data);


                 $combine = array_combine($student_id, $omarks);

                foreach($combine as $key=>$row):

                    $test_data = array
                    (
                        'test_id'=>$test_id,
                        'student_id'=>$key,
                        'tmarks'=>$tmarks,
                        'omarks'=>$row
                    );
                    $this->CRUDModel->insert('monthly_test_details',$test_data);
                endforeach;

                $this->session->set_flashdata('msg', 'Successfully Submitted.');
                redirect('AttendanceController/monthly_test_history'); 
        endif;
     endif;
        $this->data['page_title']   = 'Subject Base Test | ECMS';
        $this->data['page']         = 'attendance/subjectbasetest';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_monthly_test_history()
    {       
        $this->data['current_month']    =  date("m",strtotime(date('d-m-y')));
          $this->data['current_year']     =  date("Y",strtotime(date('d-m-Y')));  
        $this->data['month']           = $this->CRUDModel->dropDown('month', 'Month', 'mth_id', 'mth_title');
        $this->data['year']           = $this->CRUDModel->dropDown('year', 'Year', 'yr_id', 'yr_title');
        $this->data['result']       = $this->AttendanceModel->admin_getstudent_test('monthly_test');
        $this->data['page_title']   = 'Admin Monthly Test History | ECMS';
        $this->data['page']         = 'attendance/admin_monthly_test_history';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_pre_board_test_history()
    {       
        $this->data['current_month']    =  date("m",strtotime(date('d-m-y')));
        $this->data['current_year']     =  date("Y",strtotime(date('d-m-Y')));  
        $this->data['month']           = $this->CRUDModel->dropDown('month', 'Month', 'mth_id', 'mth_title');
        $this->data['year']           = $this->CRUDModel->dropDown('year', 'Year', 'yr_id', 'yr_title');
        $this->data['result']       = $this->AttendanceModel->admin_getpre_board_test('pre_board_test');
        $this->data['page_title']   = 'Admin Pre Board Test History | ECMS';
        $this->data['page']         = 'attendance/admin_pre_board_test_history';
        $this->load->view('common/common',$this->data);
    }
    
    public function search_admin_pre_board_test()
    {       
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id       =  $this->input->post('sec_id');
            $subject_id   =  $this->input->post('subject_id');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
           
            $this->data['result'] = $this->AttendanceModel->admin_pre_board_test_history('pre_board_test',$where);
            $this->data['page_title']   = 'Admin Pre Board Test History| ECMS';
            $this->data['page']         = 'attendance/search_admin_pre_board_test_history';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function admin_view_pre_board_test_marks()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('pre_board_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result'] = $this->AttendanceModel->view_pre_board_test_marks_list('pre_board_test_details',$where);
        $this->data['count'] = $this->AttendanceModel->view_pre_board_test_marks_list('pre_board_test_details',$where);
        $this->data['page_title']   = 'View Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/admin_view_pre_board_test_marks';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_print_pre_board_test_marks()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('pre_board_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result'] = $this->AttendanceModel->view_pre_board_test_marks_list('pre_board_test_details',$where);
        $this->data['count'] = $this->AttendanceModel->view_pre_board_test_marks_list('pre_board_test_details',$where);
        $this->data['page_title']   = 'View Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/admin_print_pre_board_test_marks';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_update_pre_board_marks()
    {
       $id = $this->uri->segment(3);
        if($this->input->post()):
            $data = array(
                'omarks'=>$this->input->post('omarks')
            );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('pre_board_test_details',$data,$where);
              redirect('AttendanceController/admin_pre_board_test_history'); 
              endif;
            if($id):
                $where = array('pre_board_test_details.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('pre_board_test_details',$where);
                $this->data['page_title'] = 'Update Student Pre Board Marks | ECMS';
                $this->data['page']       =  'attendance/admin_update_pre_board_marks';
                $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function search_employee_test()
    {       
        $session = $this->session->all_userdata();
        $emp_id =$session['userData']['emp_id'];
        if($this->input->post('search')):
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
            $test_date            =  $this->input->post('test_date');
          
            $like = '';
            $where = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            $this->data['test_date'] = '';
            $where = array('hr_emp_record.emp_id'=>$emp_id);
        
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if(!empty($test_date)):
                $where['monthly_test.test_date'] = $test_date;
                $this->data['test_date'] =$test_date;
            endif;
            $this->data['result'] = $this->AttendanceModel->employee_search_test('monthly_test',$where);
            $this->data['page_title']   = 'Employee Test History | ECMS';
            $this->data['page']         = 'attendance/search_employee_test';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function admin_print_test_marks_list()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('monthly_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        $this->data['count']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        $this->data['page_title']   = 'Print Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/admin_print_test_marks_list';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_view_test_marks_list()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('monthly_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        $this->data['count']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        $this->data['page_title']   = 'View Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/admin_view_test_marks_list';
        $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Monthly Test');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'College No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'Father Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Obtained Marks'); 
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Total Marks');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                for($col = ord('A'); $col <= ord('E'); $col++)
                {
                    //set column dimension
                    $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                     //change the font size
                    $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                    $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                }
                
                $id = $this->uri->segment(3);
                $emp_id = $this->uri->segment(4);
                $subject_id = $this->uri->segment(5);
                $sec_id = $this->uri->segment(6);
                $where = array('monthly_test_details.test_id'=>$id);
                $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
                $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
                $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
                
                $this->db->select('
                student_record.college_no as college_no,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                monthly_test_details.omarks as omarks,
                monthly_test_details.tmarks as tmarks,
                
               '); 
                $this->db->FROM('monthly_test_details');
                $this->db->join('student_record','student_record.student_id=monthly_test_details.student_id', 'left outer');
                $this->db->where($where);
                $this->db->order_by('college_no','asc');
                $rs =  $this->db->get();
                $exceldata="";
                foreach ($rs->result_array() as $row)
                {
                $exceldata[] = $row;
                }      
        
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Monthly Test.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
    }
    
    public function admin_update_marks()
    {
       $id = $this->uri->segment(3);
        if($this->input->post()):
            $data = array(
                'omarks'=>$this->input->post('omarks')
            );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('monthly_test_details',$data,$where);
              redirect('AttendanceController/admin_monthly_test_history'); 
              endif;
            if($id):
                $where = array('monthly_test_details.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('monthly_test_details',$where);

                $this->data['page_title']        = 'Update Student Marks | ECMS';
                $this->data['page']        =  'attendance/admin_update_marks';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
    public function update_marks()
    {
       $id = $this->uri->segment(3);
        if($this->input->post()):
            $data = array(
                'omarks'=>$this->input->post('omarks')
            );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('monthly_test_details',$data,$where);
                $this->session->set_flashdata('msg', 'Marks updated successfully');
              redirect('AttendanceController/monthly_test_history'); 
              endif;
            if($id):
                $where = array('monthly_test_details.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('monthly_test_details',$where);

                $this->data['page_title']        = 'Update Student Marks | ECMS';
                $this->data['page']        =  'attendance/update_marks';
                $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function update_pre_boardMarks()
    {
       $id = $this->uri->segment(3);
        if($this->input->post()):
            $data = array(
                'omarks'=>$this->input->post('omarks')
            );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('pre_board_test_details',$data,$where);
            $this->session->set_flashdata('msg', 'Marks updated successfully');
              redirect('AttendanceController/pre_board_test_history'); 
              endif;
            if($id):
                $where = array('pre_board_test_details.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('pre_board_test_details',$where);
                $this->data['page_title']        = 'Update Student Marks Pre Board| ECMS';
                $this->data['page']        =  'attendance/update_pre_boardMarks';
                $this->load->view('common/common',$this->data);
            endif;
    }
    
    
     public function sectionbasetest()
    {       
       $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $where      = array('student_group_allotment.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where); 
        $this->data['monthId']  = date("m",strtotime(date('d-m-y')));
        $this->data['yearId']  = date("Y",strtotime(date('d-m-Y')));
        $this->data['month']     = $this->CRUDModel->dropDown('month', 'Select Month', 'mth_num', 'mth_title');
        $this->data['year']      = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_title');
        $this->data['secclass'] = $this->AttendanceModel->getallotedsections('class_alloted');
        
        if($this->input->post()):
            $class_id   = $this->input->post('class_id');
            $sec_id     = $this->input->post('sec_id');
            $test_date  = $this->input->post('year').'-'.$this->input->post('month').'-'.date("d",strtotime(date('d-m-Y')));
            $student_id = $this->input->post('student_id');
            $month = $this->input->post('month');
            $year = $this->input->post('year');
            $tmarks     = $this->input->post('tmarks');
            $omarks     = $this->input->post('omarks');
            $checked     = array
                (
                    'class_id'=>$class_id,
                    'month(test_date)'=>$month,
                    'year(test_date)'=>$year
                );
            $qry = $this->CRUDModel->get_where_row('monthly_test',$checked);
            if(!empty($qry)):
            $this->session->set_flashdata('msg', 'Sorry! Test Record Already Exist, if you want to update then go to "Monthly Test History" page');
            redirect('AttendanceController/monthly_test');
            else:
            $data  = array
                (
                    'class_id' =>$class_id,
                    'test_date' =>$test_date,
                    'user_id' =>$user_id
                 );
            $test_id = $this->CRUDModel->insert('monthly_test',$data);
            $combine = array_combine($student_id, $omarks);
                foreach($combine as $key=>$row):
                $test_data = array
                (
                    'test_id'=>$test_id,
                    'student_id'=>$key,
                    'tmarks'=>$tmarks,
                    'omarks'=>$row
                );
                $this->CRUDModel->insert('monthly_test_details',$test_data);
                endforeach;
                        $this->session->set_flashdata('msg', 'Monthly Test Successfully Submitted.');
                        redirect('AttendanceController/monthly_test_history');    
         
   endif;
        endif;
        $this->data['page_title']   = 'Section Base Students Monthly Test | ECMS';
        $this->data['page']         = 'attendance/sectionbasetest';
        $this->load->view('common/common',$this->data);
    }
    
    public function pre_board_sectionbasetest()
    {       
       $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $where      = array('student_group_allotment.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where); 
        $this->data['monthId']  = date("m",strtotime(date('d-m-y')));
        $this->data['yearId']  = date("Y",strtotime(date('d-m-Y')));
        $this->data['month']     = $this->CRUDModel->dropDown('month', '', 'mth_num', 'mth_title');
        $this->data['year']      = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_title');
        $this->data['secclass'] = $this->AttendanceModel->getallotedsections('class_alloted');
        
        if($this->input->post()):
            $class_id   = $this->input->post('class_id');
            $sec_id     = $this->input->post('sec_id');
            $sub_pro_id     = $this->input->post('sub_pro_id');
            $test_date  = $this->input->post('year').'-'.$this->input->post('month').'-'.date("d",strtotime(date('d-m-Y')));;
            $student_id = $this->input->post('student_id');
            $month = $this->input->post('month');
            $year = $this->input->post('year');
            $tmarks     = $this->input->post('tmarks');
            $omarks     = $this->input->post('omarks');
            $checked     = array
                (
                    'class_id'=>$class_id,
                    'month(test_date)'=>$month,
                    'year(test_date)'=>$year
                );
            $qry = $this->CRUDModel->get_where_row('pre_board_test',$checked);
            if(!empty($qry)):
            $this->session->set_flashdata('msg', 'Sorry! Test Record Already Exist, if you want to update then go to "Monthly Test History" page');
            redirect('AttendanceController/pre_board_test');
            else:
            $data  = array
                    (
                        'class_id' =>$class_id,
                        'sub_pro_id' =>$sub_pro_id,
                        'test_date' =>$test_date,
                        'user_id' =>$user_id
                    );
                $test_id = $this->CRUDModel->insert('pre_board_test',$data);
                    $combine = array_combine($student_id, $omarks);
                    foreach($combine as $key=>$row):
                    $test_data = array
                    (
                        'test_id'=>$test_id,
                        'student_id'=>$key,
                        'tmarks'=>$tmarks,
                        'omarks'=>$row
                    );
                    $this->CRUDModel->insert('pre_board_test_details',$test_data);
                    endforeach;
                $this->session->set_flashdata('msg', 'Pre Board Test Successfully Submitted.');
                redirect('AttendanceController/pre_board_test');    
            endif;
        endif;
        $this->data['page_title']   = 'Section Base Pre Board Test | ECMS';
        $this->data['page']         = 'attendance/pre_board_sectionbasetest';
        $this->load->view('common/common',$this->data);
    }
    
    public function view_test_marks_list()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('monthly_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        $this->data['count']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        $this->data['page_title']   = 'VIew Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/view_test_marks_list';
        $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Monthly Test');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'College No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'Father Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Obtained Marks'); 
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Total Marks');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                for($col = ord('A'); $col <= ord('E'); $col++)
                {
                    //set column dimension
                    $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                     //change the font size
                    $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                    $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                }
                
                $id = $this->uri->segment(3);
                $emp_id = $this->uri->segment(4);
                $subject_id = $this->uri->segment(5);
                $sec_id = $this->uri->segment(6);
                $where = array('monthly_test_details.test_id'=>$id);
                $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
                $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
                $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
                
                $this->db->select('
                student_record.college_no as college_no,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                monthly_test_details.omarks as omarks,
                monthly_test_details.tmarks as tmarks,
                
               '); 
                $this->db->FROM('monthly_test_details');
                $this->db->join('student_record','student_record.student_id=monthly_test_details.student_id', 'left outer');
                $this->db->where($where);
                $this->db->order_by('college_no','asc');
                $rs =  $this->db->get();
                $exceldata="";
                foreach ($rs->result_array() as $row)
                {
                $exceldata[] = $row;
                }      
        
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Monthly Test.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
                
                endif;
    }
    
    public function view_pre_board_test_marks()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('pre_board_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_pre_board_test_marks('pre_board_test_details',$where);
        $this->data['count']       = $this->AttendanceModel->view_pre_board_test_marks('pre_board_test_details',$where);
        $this->data['page_title']   = 'VIew Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/view_pre_board_test_marks';
        $this->load->view('common/common',$this->data);
    }
    
    public function print_pre_board_test_marks()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('pre_board_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_pre_board_test_marks('pre_board_test_details',$where);
        $this->data['count']       = $this->AttendanceModel->view_pre_board_test_marks('pre_board_test_details',$where);
        $this->data['page_title']   = 'Print Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/print_pre_board_test_marks';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_pre_board_test_marks_list()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('pre_board_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result'] = $this->AttendanceModel->view_pre_board_test_marks_list('pre_board_test_details',$where);
        $this->data['count'] = $this->AttendanceModel->view_pre_board_test_marks_list('pre_board_test_details',$where);
        
        if($this->input->post('update')):
            
            $test_id = $this->input->post('test_id');
            $student_id = $this->input->post('student_id');
            $tmarks     = $this->input->post('tmarks');
            $omarks     = $this->input->post('omarks');
           
            $where = array('pre_board_test_details.test_id'=>$test_id);
            $this->CRUDModel->deleteid('pre_board_test_details',$where);
            $combine = array_combine($student_id, $omarks);
            foreach($combine as $key=>$row):
            $test_data = array
            (
                'test_id'=>$test_id,
                'student_id'=>$key,
                'tmarks'=>$tmarks,
                'omarks'=>$row
            );           
            $this->CRUDModel->insert('pre_board_test_details',$test_data);
            endforeach;
        $this->session->set_flashdata('msg', 'Pre Board Test Marks Successfully Updated.');
        redirect('AttendanceController/pre_board_test_history');    
        endif;
        $this->data['page_title']   = 'Update Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/update_pre_board_test_marks_list';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_student_attendance()
    {       
        $this->data['result']       = $this->AttendanceModel->adminstudent_attendance('student_attendance');
        $this->data['page_title']   = 'Student Attendance | ECMS';
        $this->data['page']         = 'attendance/admin_students_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function student_attendance_daily()
    {       
        $this->data['result']       = $this->AttendanceModel->adminstudent_attendance('student_attendance');
        $this->data['present'] = $this->AttendanceModel->present_daily_students();
        $this->data['absent'] = $this->AttendanceModel->absent_daily_students();
        $this->data['total'] = $this->AttendanceModel->total_daily_students();
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'attendance/student_attendance_daily';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_studentsSubjectsAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $where      = array('student_subject_alloted.subject_id'=>$subject_id,'student_subject_alloted.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where);
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $subject_id     = $this->input->post('subject_id');
        $attendance_date = $this->input->post('attendance_date');
        $checked = array
            (
               'class_id'=>$class_id,
               'attendance_date'=>$attendance_date
            );
        $qry = $this->CRUDModel->get_where_row('student_attendance',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! Students Attendance for this Section and Date Already Exist');
        redirect('AttendanceController/admin_studentsAtts/'.$class_id.'/'.$sec_id.'/'.$subject_id);       
        else:
            $checked = $this->input->post('checked');
            $where      = array('student_subject_alloted.subject_id'=>$subject_id);
            $all_students = $this->AttendanceModel->get_students_studentAtts('student_subject_alloted',$where);
            if(!empty($checked)):
            $date_required = $attendance_date;
            $date_required = str_replace('/', '-', $date_required);
            $day = date('l', strtotime( $date_required));
            if ($day == 'Sunday' || $day == 'Saturday')
            {
              $this->session->set_flashdata('msg', 'Sorry! Off Day Attendance Not Allowed');
                redirect('AttendanceController/admin_attendance');
            }
            $data  = array
            (
                'class_id' =>$class_id,
                'attendance_date' =>$attendance_date,
                'user_id' =>$user_id
             );
            $attend_id = $this->CRUDModel->insert('student_attendance',$data);
        
            
            $allStd = array();
            $sn = 0;
            foreach($all_students as $row)
            {
                $allStd[$sn] = $row->student_id ;
                    $sn++;
            }
            $diff = array_diff($allStd,$checked);
            foreach($diff as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'student_id'=>$value,
                'status'=>0
            );
            $this->CRUDModel->insert('student_attendance_details',$attend_data);
            endforeach;
        
            foreach($checked as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'student_id'=>$value,
                'status'=>1
            );
        $this->CRUDModel->insert('student_attendance_details',$attend_data);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/admin_attendance');
            else:
                $data  = array
                        (
                            'class_id' =>$class_id,
                            'attendance_date' =>$attendance_date,
                            'user_id' =>$user_id
                         );
                    $attend_id = $this->CRUDModel->insert('student_attendance',$data);

                foreach($all_students as $asrow):
                    $asdata = array(
                    'attend_id'=>$attend_id,
                        'student_id'=>$asrow->student_id,
                        'status'=>0
                    );
                    $this->CRUDModel->insert('student_attendance_details',$asdata);
                endforeach;
                $this->session->set_flashdata('msg', 'Successfully Submitted.');
                redirect('AttendanceController/admin_attendance');
        endif;
        
        endif;
        endif;
        $this->data['page_title']   = 'Admin Students Attendance | ECMS';
        $this->data['page']         = 'attendance/admin_student_SubjectAtts';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_attendance()
    {       
        $where = array('class_alloted.flag'=>'1');
        $subwhere = array('class_alloted.flag'=>'2');
        $this->data['page_title']   = 'Admin Sections List | ECMS';
        $this->data['page']         = 'attendance/admin_sections_list';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_search_section()
    {       
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if(!empty($emp_id)):
                $where2['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where2['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where2['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $where['class_alloted.flag']='1';
            $where2['class_alloted.flag']='2';
            $this->data['result'] = $this->AttendanceModel->admin_getsections_list('class_alloted',$where);
            $this->data['subjectbase'] = $this->AttendanceModel->get_alloted_subjectss('class_alloted',$where2);
            $this->data['page_title']   = 'Admin Sections List | ECMS';
            $this->data['page']         = 'attendance/admin_search_sections_list';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function search_employee_attendance()
    {       
        $session = $this->session->all_userdata();
        $emp_id =$session['userData']['emp_id'];
        if($this->input->post('search')):
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
            $attendance_date            =  $this->input->post('attendance_date');
          
            $like = '';
            $where = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            $this->data['attendance_date'] = '';
            $where = array('hr_emp_record.emp_id'=>$emp_id);
        
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if(!empty($attendance_date)):
                $where['student_attendance.attendance_date'] = $attendance_date;
                $this->data['attendance_date'] =$attendance_date;
            endif;
            $this->data['result'] = $this->AttendanceModel->admin_search_history('student_attendance',$where);
            $this->data['page_title']   = 'Employee Attendance History | ECMS';
            $this->data['page']         = 'attendance/search_employee_attendance';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
public function search_attendance_history()
    {       
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
            $attendance_date            =  $this->input->post('attendance_date');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            $this->data['attendance_date'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if(!empty($attendance_date)):
                $where['student_attendance.attendance_date'] = $attendance_date;
                $this->data['attendance_date'] =$attendance_date;
            endif;
            $this->data['result'] = $this->AttendanceModel->admin_search_history('student_attendance',$where);
            $this->data['page_title']   = 'Admin Sections List | ECMS';
            $this->data['page']         = 'attendance/search_attendance_history';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function admin_view_attendance()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('student_attendance_details.attend_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $wherePrsent = array('student_attendance_details.attend_id'=>$id,'status'=>1);
        $whereLeave = array('student_attendance_details.attend_id'=>$id,'status'=>2);
        $whereAbsent = array('student_attendance_details.attend_id'=>$id,'status'=>0);
        $this->data['present']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$wherePrsent));
        $this->data['leave']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereLeave));
        $this->data['Absent']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereAbsent));
        
        $this->data['count']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $this->data['page_title']   = 'Admin VIew Student Attendance | ECMS';
        $this->data['page']         = 'attendance/admin_view_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_students_attendance()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $data = array(
                'status'=>$this->input->post('status')
            );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('student_attendance_details',$data,$where);
              redirect('AttendanceController/admin_student_attendance'); 
              endif;
            if($id):
                $where = array('student_attendance_details.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('student_attendance_details',$where);

                $this->data['page_title']        = 'Update Student Attendance | ECMS';
                $this->data['page']        =  'attendance/update_student_attendance';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
    public function view_attendance()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('student_attendance_details.attend_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $wherePrsent = array('student_attendance_details.attend_id'=>$id,'status'=>1);
        $whereLeave = array('student_attendance_details.attend_id'=>$id,'status'=>2);
        $whereAbsent = array('student_attendance_details.attend_id'=>$id,'status'=>0);
        $this->data['present']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$wherePrsent));
        $this->data['leave']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereLeave));
        $this->data['Absent']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereAbsent));
        
        $this->data['count']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $this->data['page_title']   = 'VIew Student Attendance | ECMS';
        $this->data['page']         = 'attendance/view_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function student_update_attendance()
    {       
        $session = $this->session->all_userdata();
        $emp_id =$session['userData']['emp_id'];
        $where = array('class_alloted.emp_id'=>$emp_id);
        $this->data['result']       = $this->AttendanceModel->getupd_student_attendance('student_attendance',$where);
        $this->data['page_title']   = 'Update Student Attendance | ECMS';
        $this->data['page']         = 'attendance/students_update_attendance';
        $this->load->view('common/common',$this->data);
    }
    
   public function teacher_view_attendance()
    {       
        $id = $this->uri->segment(3);
        $q = $this->CRUDModel->get_where_row('student_attendance',array('attend_id'=>$id)); 
        $qry = $this->CRUDModel->get_where_row('class_alloted',array('class_id'=>$q->class_id));
        $emp_id = $qry->emp_id;
        $subject_id = $qry->subject_id;
        $sec_id = $qry->sec_id;
        $where = array('student_attendance_details.attend_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        $this->data['attend'] = $this->CRUDModel->get_where_row('student_attendance',array('attend_id'=>$id));
        
        $this->data['result'] = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $wherePrsent = array('student_attendance_details.attend_id'=>$id,'status'=>1);
        $whereLeave = array('student_attendance_details.attend_id'=>$id,'status'=>2);
        $whereAbsent = array('student_attendance_details.attend_id'=>$id,'status'=>0);
        $this->data['present'] = count($this->AttendanceModel->view_attendance('student_attendance_details',$wherePrsent));
        $this->data['leave'] = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereLeave));
        $this->data['Absent'] = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereAbsent));
        $this->data['count']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $this->data['page_title']   = 'View Student Attendance | ECMS';
        $this->data['page']         = 'attendance/teacher_view_attendance';
        $this->load->view('common/common',$this->data);
    }

public function update_studentsAtts()
    {       
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
        $attend_id   = $this->input->post('attend_id');
        $sec_id   = $this->input->post('sec_id');
        $checked = $this->input->post('checked');
        $where1      = array('attend_id'=>$attend_id);
        $this->CRUDModel->deleteid('student_attendance_details',$where1);
        $where = array('student_group_allotment.section_id'=>$sec_id);
                $all_students = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
         if(!empty($checked)):   
             $allStd = array();
                $sn = 0;
                foreach($all_students as $row)
                {
                    $allStd[$sn] = $row->student_id ;
                        $sn++;
                }
                $diff = array_diff($allStd,$checked);
                foreach($diff as $row=>$value):
                $attend_data = array
                (
                    'attend_id'=>$attend_id,
                    'student_id'=>$value,
                    'status'=>0
                );
                $this->CRUDModel->insert('student_attendance_details',$attend_data);
                endforeach;
                foreach($checked as $row=>$value):
                $attend_data = array
                (
                    'attend_id'=>$attend_id,
                    'student_id'=>$value,
                    'status'=>1
                );
            $this->CRUDModel->insert('student_attendance_details',$attend_data);
            endforeach;
            $this->session->set_flashdata('msg', 'Updated Successfully');
            redirect('AttendanceController/student_update_attendance');    
            else:    
            foreach($all_students as $asrow):
            $asdata = array(
            'attend_id'=>$attend_id,
                'student_id'=>$asrow->student_id,
                'status'=>0
            );
            $this->CRUDModel->insert('student_attendance_details',$asdata);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/student_update_attendance'); 
        endif;
            
        endif;
        $this->data['page_title']   = 'Update Students Attendance | ECMS';
        $this->data['page']         = 'attendance/teacher_view_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function teacher_update_attendance()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
        $data = array(
            'status'=>$this->input->post('status')
        );
          $where = array('serial_no'=>$id);
          $this->CRUDModel->update('student_attendance_details',$data,$where);
          redirect('AttendanceController/student_update_attendance'); 
          endif;
        if($id):
            $where = array('student_attendance_details.serial_no'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_attendance_details',$where);

            $this->data['page_title']        = 'Teacher Update Student Attendance | ECMS';
            $this->data['page']        =  'attendance/teacher_update_attendance';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
     public function employee_alloted_sections()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $emp_id =$session['userData']['emp_id'];
        $where = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'1');
        $subwhere = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'2');
        $this->data['result'] = $this->AttendanceModel->get_alloted_sections('class_alloted',$where);
        $this->data['subjectbase'] = $this->AttendanceModel->get_alloted_subjects('class_alloted',$subwhere);
        
        $this->data['page_title']   = 'Employee Alloted Sections | ECMS';
        $this->data['page']         = 'attendance/employee_alloted_sections';
        $this->load->view('common/common',$this->data);
    }
    
public function studentsAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $where      = array('student_group_allotment.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
        $this->data['secclass'] = $this->AttendanceModel->getallotedsections('class_alloted');
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $attendance_date = $this->input->post('attendance_date');
        $checked = array(
               'class_id'=>$class_id,
               'attendance_date'=>$attendance_date
            );
        $qry = $this->CRUDModel->get_where_row('student_attendance',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! Students Attendance for this Section and Date Already Exist');
        redirect('AttendanceController/studentsAtts/'.$class_id.'/'.$sec_id);       
        else:
                $checked = $this->input->post('checked');
               
                $where      = array('student_group_allotment.section_id'=>$sec_id);
                $all_students = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
           
                    if(!empty($checked)):
                    
                        $date_required = $attendance_date;
                        $date_required = str_replace('/', '-', $date_required);
                        $day = date('l', strtotime( $date_required));
                        if ($day == 'Sunday' || $day == 'Saturday')
                        {
                          $this->session->set_flashdata('msg', 'Sorry! Off Day Attendance Not Allowed');
                            redirect('AttendanceController/employee_alloted_sections');
                        }
                        $data  = array
                            (
                                'class_id' =>$class_id,
                                'attendance_date' =>$attendance_date,
                                'user_id' =>$user_id
                             );
                        $attend_id = $this->CRUDModel->insert('student_attendance',$data);
            
               
                            $allStd = array();
                            $sn = 0;
                            foreach($all_students as $row)
                            {
                                $allStd[$sn] = $row->student_id ;
                                    $sn++;
                            }
                            $diff = array_diff($allStd,$checked);
                            foreach($diff as $row=>$value):
                            $attend_data = array
                            (
                                'attend_id'=>$attend_id,
                                'student_id'=>$value,
                                'status'=>0
                            );
                            $this->CRUDModel->insert('student_attendance_details',$attend_data);
                            endforeach;

                            foreach($checked as $row=>$value):
                            $attend_data = array
                            (
                                'attend_id'=>$attend_id,
                                'student_id'=>$value,
                                'status'=>1
                            );
                        $this->CRUDModel->insert('student_attendance_details',$attend_data);
                        endforeach;
                        $this->session->set_flashdata('msg', 'Successfully Submitted.');
                        redirect('AttendanceController/student_attendance');    
                    else:
                    
                    $data  = array
                                (
                                    'class_id' =>$class_id,
                                    'attendance_date' =>$attendance_date,
                                    'user_id' =>$user_id
                                 );
            $attend_id = $this->CRUDModel->insert('student_attendance',$data);
            
        foreach($all_students as $asrow):
            $asdata = array(
            'attend_id'=>$attend_id,
                'student_id'=>$asrow->student_id,
                'status'=>0
            );
            $this->CRUDModel->insert('student_attendance_details',$asdata);
        endforeach;
            
        
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/student_attendance'); 
        endif;
            
        endif;
        endif;
        $this->data['page_title']   = 'Students Attendance | ECMS';
        $this->data['page']         = 'attendance/studentAtts';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_studentsAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $where      = array('student_group_allotment.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
        $this->data['secclass'] = $this->AttendanceModel->getallotedsections('class_alloted');
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $attendance_date = $this->input->post('attendance_date');
        $checked = array
            (
               'class_id'=>$class_id,
               'attendance_date'=>$attendance_date
            );
        $qry = $this->CRUDModel->get_where_row('student_attendance',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! Students Attendance for this Section and Date Already Exist');
        redirect('AttendanceController/admin_studentsAtts/'.$class_id.'/'.$sec_id);       
        else:
            $checked = $this->input->post('checked');
            $where      = array('student_group_allotment.section_id'=>$sec_id);
            $all_students = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
            if(!empty($checked)):
                $date_required = $attendance_date;
            $date_required = str_replace('/', '-', $date_required);
            $day = date('l', strtotime( $date_required));
            if ($day == 'Sunday' || $day == 'Saturday')
            {
              $this->session->set_flashdata('msg', 'Sorry! Off Day Attendance Not Allowed');
                redirect('AttendanceController/admin_attendance');
            }
    
            $data  = array
            (
                'class_id' =>$class_id,
                'attendance_date' =>$attendance_date,
                'user_id' =>$user_id
             );
            $attend_id = $this->CRUDModel->insert('student_attendance',$data);
            
            $allStd = array();
            $sn = 0;
            foreach($all_students as $row)
            {
                $allStd[$sn] = $row->student_id ;
                    $sn++;
            }
            $diff = array_diff($allStd,$checked);
            foreach($diff as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'student_id'=>$value,
                'status'=>0
            );
            $this->CRUDModel->insert('student_attendance_details',$attend_data);
            endforeach;
            foreach($checked as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'student_id'=>$value,
                'status'=>1
            );
        $this->CRUDModel->insert('student_attendance_details',$attend_data);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/admin_attendance');
            else:
                $data  = array
                                (
                                    'class_id' =>$class_id,
                                    'attendance_date' =>$attendance_date,
                                    'user_id' =>$user_id
                                 );
            $attend_id = $this->CRUDModel->insert('student_attendance',$data);
            
        foreach($all_students as $asrow):
            $asdata = array(
            'attend_id'=>$attend_id,
                'student_id'=>$asrow->student_id,
                'status'=>0
            );
            $this->CRUDModel->insert('student_attendance_details',$asdata);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/admin_attendance');
            endif;
            
        endif;
        endif;
        $this->data['page_title']   = 'Admin Students Attendance | ECMS';
        $this->data['page']         = 'attendance/admin_studentAtts';
        $this->load->view('common/common',$this->data);
    }
    
    public function studentsSubjectsAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
    $where = array('student_subject_alloted.subject_id'=>$subject_id,'student_subject_alloted.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where);
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $subject_id     = $this->input->post('subject_id');
        $attendance_date = $this->input->post('attendance_date');
        $checked = array
            (
               'class_id'=>$class_id,
               'attendance_date'=>$attendance_date
            );
        $qry = $this->CRUDModel->get_where_row('student_attendance',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! Students Attendance for this Section and Date Already Exist');
        redirect('AttendanceController/studentsSubjectsAtts/'.$class_id.'/'.$sec_id.'/'.$subject_id);       
        else:
            $checked = $this->input->post('checked');
            $where      = array('student_subject_alloted.subject_id'=>$subject_id,'student_subject_alloted.section_id'=>$sec_id);
            $all_students = $this->AttendanceModel->get_students_studentAtts('student_subject_alloted',$where);
            if(!empty($checked)):
        
                $date_required = $attendance_date;
                $date_required = str_replace('/', '-', $date_required);
                $day = date('l', strtotime( $date_required));
                if ($day == 'Sunday' || $day == 'Saturday')
                {
                  $this->session->set_flashdata('msg', 'Sorry! Off Day Attendance Not Allowed');
                    redirect('AttendanceController/employee_alloted_subjects');
                }
                $data  = array
                (
                    'class_id' =>$class_id,
                    'attendance_date' =>$attendance_date,
                    'user_id' =>$user_id
                 );
                $attend_id = $this->CRUDModel->insert('student_attendance',$data);

                $allStd = array();
                $sn = 0;
                foreach($all_students as $row)
                {
                    $allStd[$sn] = $row->student_id ;
                        $sn++;
                }
                $diff = array_diff($allStd,$checked);
                foreach($diff as $row=>$value):
                $attend_data = array
                (
                    'attend_id'=>$attend_id,
                    'student_id'=>$value,
                    'status'=>0
                );
                $this->CRUDModel->insert('student_attendance_details',$attend_data);
                endforeach;

                foreach($checked as $row=>$value):
                $attend_data = array
                (
                    'attend_id'=>$attend_id,
                    'student_id'=>$value,
                    'status'=>1
                );
            $this->CRUDModel->insert('student_attendance_details',$attend_data);
            endforeach;
                $this->session->set_flashdata('msg', 'Successfully Submitted.');
                redirect('AttendanceController/student_attendance'); 
            else:
                $data  = array
                (
                    'class_id' =>$class_id,
                    'attendance_date' =>$attendance_date,
                    'user_id' =>$user_id
                 );
                $attend_id = $this->CRUDModel->insert('student_attendance',$data);
                
                foreach($all_students as $asrow):
                    $asdata = array(
                        'attend_id'=>$attend_id,
                        'student_id'=>$asrow->student_id,
                        'status'=>0
                                    );
            $this->CRUDModel->insert('student_attendance_details',$asdata);
                endforeach;
            
        
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/student_attendance'); 
            endif;
            
        endif;
        endif;
        $this->data['page_title']   = 'Students Attendance | ECMS';
        $this->data['page']         = 'attendance/student_subjectAtts';
        $this->load->view('common/common',$this->data);
    }
    
    public function delete_class_alloted()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('class_id'=>$id);
        $this->CRUDModel->deleteid('class_alloted',$where);
        $this->CRUDModel->deleteid('timetable',$where);
        redirect('AttendanceController/class_alloted');
	}
    
    public function delete_practical_alloted()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('practical_class_id'=>$id);
        $this->CRUDModel->deleteid('practical_alloted',$where);
        $this->CRUDModel->deleteid('practical_timetable',$where);
        redirect('AttendanceController/practical_alloted');
	}
  
    
public function add_class_alloted_before_bulding_block(){
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('submit_timetable')):  
            $emp_id         = $this->input->post('emp_id');
            $sec_id         = $this->input->post('sec_id');
            $subject_id     = $this->input->post('subject_id');
            $subject_flag   = $this->input->post('subject_flag');
            $form_Code      = $this->input->post('form_Code');
            $whereEDCheck   = array(
                'sec_id'    => $sec_id,
                'subject_id'=> $subject_id
            );
            $query  = $this->CRUDModel->get_where_row('class_alloted',$whereEDCheck);
            if($query):
            $this->session->set_flashdata('msg', 'Sorry, This Record Already Exist');
            redirect('AttendanceController/add_class_alloted');
            else:
           $data = array(
                'emp_id'        => $emp_id,
                'sec_id'        => $sec_id,
                'subject_id'    => $subject_id,
                'flag'          => $subject_flag
            );
           
            $class_id = $this->CRUDModel->insert('class_alloted',$data);
            $where  = array(
            'user_id'   => $user_id,
            'form_Code' => $form_Code,
            'date'      => date('Y-m-d')    
        ); 
       $res =  $this->CRUDModel->get_where_result('timetable_demo', $where);
       // echo '<pre>';print_r($res);die;    
       foreach($res as $isRow):
        $data = array(   
            'day_id'    => $isRow->day_id,
            'class_id'  => $class_id,
            'stime_id'  => $isRow->stime_id,
            'etime_id'  => $isRow->etime_id,
            'form_Code' => $isRow->form_Code,
            'date'      => $isRow->date,
            'user_id'   => $isRow->user_id,
          );
      //  echo '<pre>';print_r($data);die;
         $this->CRUDModel->insert('timetable',$data);
        $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('timetable_demo',$whereDelete);
        endforeach; 
            redirect('AttendanceController/class_alloted');
            endif;
            endif;
        $this->data['page_title']   = 'Add New Record | ECMS';
        $this->data['page']         = 'attendance/add_class_alloted';
        $this->load->view('common/common',$this->data);
    }
    
    public function add_class_alloted(){
        $session = $this->session->all_userdata();
        $user_id = $session['userData']['user_id'];
        
        $this->data['building_block_id']    = '';
        $this->data['rooms_id']             = '';
        $this->data['building_block']       = $this->CRUDModel->dropDownName('invt_building_block', 'Building Block', 'bb_id', 'bb_name',array('bb_status'=>1)); 
        $this->data['rooms']                = $this->CRUDModel->dropDownName('invt_rooms', 'Rooms', 'rm_id', 'rm_name'); 
        
        
        if($this->input->post('submit_timetable')):  
            $emp_id         = $this->input->post('emp_id');
            $sec_id         = $this->input->post('sec_id');
            $subject_id     = $this->input->post('subject_id');
            $subject_flag   = $this->input->post('subject_flag');
            $form_Code      = $this->input->post('form_Code');
            $whereEDCheck = array(
            
                'sec_id'            => $sec_id,
                'subject_id'        => $subject_id
            );
            $query = $this->CRUDModel->get_where_row('class_alloted',$whereEDCheck);
            if($query):
            $this->session->set_flashdata('msg', 'Sorry, This Record Already Exist');
            redirect('AttendanceController/add_class_alloted');
            else:
           $data = array(
                
                'emp_id'            => $emp_id,
                'sec_id'            => $sec_id,
                'subject_id'        => $subject_id,
                'flag'              => $subject_flag
            );
           // echo '<pre>';print_r($data);
            $class_id = $this->CRUDModel->insert('class_alloted',$data);
            $where = array(
            'user_id'=>$user_id,
            'form_Code'=>$form_Code,
            'date' => date('Y-m-d')    
        ); 
       $res =  $this->CRUDModel->get_where_result('timetable_demo', $where);
       // echo '<pre>';print_r($res);die;    
       foreach($res as $isRow):
        $data = array(   
            'day_id'            => $isRow->day_id,
            'class_id'          => $class_id,
            'stime_id'          => $isRow->stime_id,
            'etime_id'          => $isRow->etime_id,
            'building_block_id' => $isRow->building_block_id,
            'room_id'           => $isRow->room_id,
            'form_Code'         => $isRow->form_Code,
            'date'              => $isRow->date,
            'user_id'           => $isRow->user_id,
          );
      //  echo '<pre>';print_r($data);die;
         $this->CRUDModel->insert('timetable',$data);
        $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('timetable_demo',$whereDelete);
        endforeach; 
            redirect('AttendanceController/class_alloted');
            endif;
            endif;
        $this->data['page_title']   = 'Alloted New Class | ECMS';
        $this->data['page_header']  = 'Alloted New Class';
        $this->data['page']         = 'attendance/add_class_alloted';
        $this->load->view('common/common',$this->data);
    }
    public function get_teacher_sectimetable_before_bulding_block(){
            
                
            $class_id = $this->input->post('class_id');
                $where = array(
                   'class_id'=>$class_id, 
                 );
            $emp_q = $this->AttendanceModel->getsecEmp_Data('class_alloted',$where);
            $result = $this->AttendanceModel->section_Timetable('timetable',$where);
            if($result):
            echo '<strong style="color:red">Teacher: '.$emp_q->emp_name.', '.'</strong>';
            echo '<strong style="color:red">Group: '.$emp_q->name.', '.'</strong>';
            echo '<strong style="color:red;">Subject: '.$emp_q->title.'</strong><br/><br/>';
            echo '<table class="table table-boxed table-hover">
                <thead>
                  <tr>
                    <th>S.N </th>
                    <th>Day </th>
                    <th>Star Time</th>
                    <th>End Time</th>
                  </tr>
                </thead>
                <tbody>';
            $sn = 1;
             foreach($result as $row):
             
                 echo '<tr>
                        <td>'.$sn.'</td>
                        <td>'.$row->day_name.'</td>
                        <td>'.$row->class_stime.'</td>
                        <td>'.$row->class_etime.'</td>
                    </tr>';
                $sn++;
            endforeach;
                echo '</tbody>
              </table>';
            endif;
        }
        public function get_teacher_sectimetable(){
            
                
            $class_id = $this->input->post('class_id');
                $where = array(
                   'class_id'=>$class_id, 
                 );
            $emp_q = $this->AttendanceModel->getsecEmp_Data('class_alloted',$where);
            $result = $this->AttendanceModel->section_Timetable($where);
            if($result):
            echo '<strong style="color:red">Teacher: '.$emp_q->emp_name.', '.'</strong>';
            echo '<strong style="color:red">Group: '.$emp_q->name.', '.'</strong>';
            echo '<strong style="color:red;">Subject: '.$emp_q->title.'</strong><br/><br/>';
            echo '<table class="table table-boxed table-hover">
                <thead>
                  <tr>
                    <th>S.N </th>
                    <th>Block</th>
                    <th>Room</th>
                    <th>Day </th>
                    <th>Star Time</th>
                    <th>End Time</th>
                  </tr>
                </thead>
                <tbody>';
            $sn = 1;
             foreach($result as $row):
             
                 echo '<tr>
                        <td>'.$sn.'</td>
                        <td>'.$row->bb_name.'</td>
                        <td>'.$row->rm_name.'</td>
                        <td>'.$row->day_name.'</td>
                        <td>'.$row->class_stime.'</td>
                        <td>'.$row->class_etime.'</td>
                    </tr>';
                $sn++;
            endforeach;
                echo '</tbody>
              </table>';
            endif;
        }
    public function employee_timetable()
    {       
        $emp_id = $this->uri->segment(3);
        $where = array('class_alloted.emp_id'=>$emp_id);
        $this->data['result_mon'] = $this->AttendanceModel->getClassDaym('class_alloted',$where);
        $this->data['result_tue'] = $this->AttendanceModel->getClassDaytu('class_alloted',$where);
        $this->data['result_wed'] = $this->AttendanceModel->getClassDayw('class_alloted',$where);
        $this->data['result_thu'] = $this->AttendanceModel->getClassDayth('class_alloted',$where);
        $this->data['result_fri'] = $this->AttendanceModel->getClassDayf('class_alloted',$where);
        $this->data['page_title']   = 'Employee Time Table | ECMS';
        $this->data['page']         = 'attendance/employee_timetable';
        $this->load->view('common/common',$this->data);
    }
        public function get_classTimeTable(){
            
                
            $timetable_id = $this->input->post('timetable_id');
            $class = explode(',',$timetable_id);
             $building_block       = $this->CRUDModel->dropDownName('invt_building_block', 'Building Block', 'bb_id', 'bb_name',array('bb_status'=>1)); 
             $rooms                = $this->CRUDModel->dropDownName('invt_rooms', 'Rooms', 'rm_id', 'rm_name'); 
            
                $where = array(
                   'timetable_id'=>$class[0], 
                 );
            $result = $this->AttendanceModel->class_timetablerow('timetable',$where);
//            echo '<pre>';print_r($result);die;
            if($result):
            echo '<form class="form-horizontal row-fluid" method="post" action="AttendanceController/update_timeTableRow/'.$class[0].'/'.$class[1].'">
                <div class="control-group">
                        <label class="control-label" for="basicinput">Day Name</label>
                        <div class="controls">
                        <select name="day_id" class=" form-control span6 tip">
                                <option value="'.$result->day_id.'">'.$result->day_name.'</option>
                                <option>Select Start Time</option>';
                                    $d = $this->CRUDModel->getResults('days');
                                    foreach($d as $rec):
                                    echo '<option value="'.$rec->day_id.'">'.$rec->day_name.'</option>';
                                    endforeach;
                        echo '</select>                          
                        </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="basicinput">Start Time</label>
                                                    <div class="controls">
                                                    <select name="stime_id" class=" form-control span6 tip">
                                                            <option value="'.$result->stime_id.'">'.$result->class_stime.'</option>
                                                            <option>Select Start Time</option>';
                                    $st = $this->CRUDModel->getResults('class_starting_time');
                                    foreach($st as $rec):
                                    echo '<option value="'.$rec->stime_id.'">'.$rec->class_stime.'</option>';
                                    endforeach;
                                    echo '</select>              
                                                    </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">End Time</label>
                        <div class="controls">
                        <select name="etime_id" class=" form-control span6 tip">
                                <option value="'.$result->etime_id.'">'.$result->class_etime.'</option>
                                <option>Select Start Time</option>';
                                $et = $this->CRUDModel->getResults('class_ending_time');
                                foreach($et as $rec):
                                echo '<option value="'.$rec->etime_id.'">'.$rec->class_etime.'</option>';
                                endforeach;
                                echo '</select> 
                        </div>
                         </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Building Block</lable></label>
                        <div class="controls">';
                            echo form_dropdown('building_block', $building_block,$result->building_block_id,  'class="form-control required="required" id="building_blockUp"');
                        echo '</div>
                         </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Rooms</lable></label>
                        <div class="controls">';
                            echo form_dropdown('rooms', $rooms,$result->room_id,  'class="form-control required="required" id="roomsUp"');
                        echo '</div>
                         </div>
                    
                    
                   
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" value="Update" class="btn btn-primary pull-center">
                        </div>
                    </div>
                </form>';
            ?>
                     <script>
            jQuery(document).ready(function(){
                
                jQuery('#building_blockUp').on('change',function(){
                    var building_block = jQuery('#building_blockUp').val();
                    
                    jQuery.ajax({
                        type    : 'post',
                        url     : 'GetInvtRooms',
                        data    : {'building_block':building_block},
                        success : function(result){
                            jQuery('#roomsUp').html(result);
                        }
                    });
                });
                
                
         
                
                
                
            });
        </script> 
                
                <?php
            endif;
        }
    public function get_classTimeTable_before_bulding_blog(){
            
                
            $timetable_id = $this->input->post('timetable_id');
            $class = explode(',',$timetable_id);
            
                $where = array(
                   'timetable_id'=>$class[0], 
                 );
            $result = $this->AttendanceModel->class_timetablerow('timetable',$where);
            if($result):
            echo '<form class="form-horizontal row-fluid" method="post" action="AttendanceController/update_timeTableRow/'.$class[0].'/'.$class[1].'">
                <div class="control-group">
                        <label class="control-label" for="basicinput">Day Name</label>
                        <div class="controls">
                        <select name="day_id" class=" form-control span6 tip">
                                <option value="'.$result->day_id.'">'.$result->day_name.'</option>
                                <option>Select Start Time</option>';
        $d = $this->CRUDModel->getResults('days');
        foreach($d as $rec):
        echo '<option value="'.$rec->day_id.'">'.$rec->day_name.'</option>';
        endforeach;
        echo '</select>                          
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Start Time</label>
                        <div class="controls">
                        <select name="stime_id" class=" form-control span6 tip">
                                <option value="'.$result->stime_id.'">'.$result->class_stime.'</option>
                                <option>Select Start Time</option>';
        $st = $this->CRUDModel->getResults('class_starting_time');
        foreach($st as $rec):
        echo '<option value="'.$rec->stime_id.'">'.$rec->class_stime.'</option>';
        endforeach;
        echo '</select>              
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">End Time</label>
                        <div class="controls">
                        <select name="etime_id" class=" form-control span6 tip">
                                <option value="'.$result->etime_id.'">'.$result->class_etime.'</option>
                                <option>Select Start Time</option>';
        $et = $this->CRUDModel->getResults('class_ending_time');
        foreach($et as $rec):
        echo '<option value="'.$rec->etime_id.'">'.$rec->class_etime.'</option>';
        endforeach;
        echo '</select>              
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" value="Update" class="btn btn-primary pull-center">
                        </div>
                    </div>
                </form>';
            
            endif;
        }
     public function update_timeTableRow($timetable_id,$class_id)
    {
        $whereEDCheck = array(
            'class_id'=>$class_id,
            'day_id'=>$this->input->post('day_id'),
            'stime_id'=>$this->input->post('stime_id'),
            'etime_id'=>$this->input->post('etime_id')
            );
        $query = $this->CRUDModel->get_where_row('timetable',$whereEDCheck);
        if($query):
            $this->session->set_flashdata('msg', 'Sorry, This Record Already Exist');
            redirect('AttendanceController/update_class_alloted/'.$class_id);
        else:
            $where = array('timetable_id'=>$timetable_id);
            $upd_data = array(
            'day_id' => $this->input->post('day_id'),
            'stime_id' => $this->input->post('stime_id'),
            'etime_id' => $this->input->post('etime_id'),
            'building_block_id' => $this->input->post('building_block'),
            'room_id' => $this->input->post('rooms')
            );
            $this->CRUDModel->update('timetable',$upd_data,$where);
            redirect('AttendanceController/update_class_alloted/'.$class_id);
        endif;
    }
    public function update_timeTableRow_before_bulding_block($timetable_id,$class_id)
    {
        $whereEDCheck = array(
            'class_id'=>$class_id,
            'day_id'=>$this->input->post('day_id'),
            'stime_id'=>$this->input->post('stime_id'),
            'etime_id'=>$this->input->post('etime_id')
            );
        $query = $this->CRUDModel->get_where_row('timetable',$whereEDCheck);
        if($query):
            $this->session->set_flashdata('msg', 'Sorry, This Record Already Exist');
            redirect('AttendanceController/update_class_alloted/'.$class_id);
        else:
            $where = array('timetable_id'=>$timetable_id);
            $upd_data = array(
            'day_id' => $this->input->post('day_id'),
            'stime_id' => $this->input->post('stime_id'),
            'etime_id' => $this->input->post('etime_id')
            );
            $this->CRUDModel->update('timetable',$upd_data,$where);
            redirect('AttendanceController/update_class_alloted/'.$class_id);
        endif;
    }
    
    public function deletepractimetable()
    {
        $timetable_id = $this->uri->segment(3);
        $class_id = $this->uri->segment(4);
        $where = array('ptimetable_id'=>$timetable_id);
        $this->CRUDModel->deleteid('practical_timetable',$where);
        redirect('AttendanceController/update_practical_alloted/'.$class_id);
    }
    
    public function addPracTimeTable()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $practical_class_id = $this->uri->segment(3);
        $day_id = $this->input->post('day_id');
        $stime_id = $this->input->post('stime_id');
        $etime_id = $this->input->post('etime_id');
        $whereEDCheck = array(
            'practical_class_id'=>$practical_class_id,
            'day_id'=>$day_id,
            'stime_id'=>$stime_id,
            'etime_id'=>$etime_id
            );
            $query = $this->CRUDModel->get_where_row('practical_timetable',$whereEDCheck);
            if($query):
            $this->session->set_flashdata('msg', 'Sorry, This Record Already Exist');
            redirect('AttendanceController/update_practical_alloted/'.$practical_class_id);
            else:
        $data = array(
        'practical_class_id' => $practical_class_id,
        'day_id' => $day_id,
        'stime_id' => $stime_id,
        'etime_id' => $etime_id,
        'date' => date('Y-m-d'),
        'user_id' => $user_id,
        );
        $this->CRUDModel->insert('practical_timetable',$data);
        redirect('AttendanceController/update_practical_alloted/'.$practical_class_id);
        endif;
    }
    
    public function addTimeTable_before_log()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $day_id = $this->input->post('day_id');
        $stime_id = $this->input->post('stime_id');
        $etime_id = $this->input->post('etime_id');
        $whereEDCheck = array(
            'class_id'=>$class_id,
            'day_id'=>$day_id,
            'stime_id'=>$stime_id,
            'etime_id'=>$etime_id
            );
            $query = $this->CRUDModel->get_where_row('timetable',$whereEDCheck);
            if($query):
            $this->session->set_flashdata('msg', 'Sorry, This Record Already Exist');
            redirect('AttendanceController/update_class_alloted/'.$class_id);
            else:
        $data = array(
        'class_id' => $class_id,
        'day_id' => $day_id,
        'stime_id' => $stime_id,
        'etime_id' => $etime_id,
        'date' => date('Y-m-d'),
        'user_id' => $user_id,
        );
        $this->CRUDModel->insert('timetable',$data);
        redirect('AttendanceController/update_class_alloted/'.$class_id);
        endif;
    }
     public function addTimeTable(){
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        $class_id   = $this->uri->segment(3);
        
        $class_alloted_details = $this->db->get_where('class_alloted',array('class_id'=>$class_id))->row();
        $day_id     = $this->input->post('day_id');
        $stime_id   = $this->input->post('stime_id');
        $etime_id   = $this->input->post('etime_id');
        $building_block   = $this->input->post('building_block');
        $rooms      = $this->input->post('rooms');

        
          $check = array(
                'class_alloted.sec_id'              => $class_alloted_details->sec_id,
                'timetable.day_id'                  => $day_id,
                'timetable.stime_id'                => $stime_id,
				);
            $q = $this->AttendanceModel->getTimeTablerow('class_alloted',$check);
            $chk = array(
                
                'class_alloted.sec_id'              => $class_alloted_details->sec_id,
                'class_alloted.emp_id'              => $class_alloted_details->emp_id,
                'timetable.day_id'                  => $day_id,
                'timetable.stime_id'                => $stime_id,
				);
            $qy = $this->AttendanceModel->getTimeTablerow('class_alloted',$chk);
            $ms = '';
            $m = '';
            $error_message = '';
            if($q):
            $error_message = '<p style="color:red">Sorry! This Time for Class Dedicated to Other One ... <p/>'; 
             $this->session->set_flashdata('msg', $error_message);
            redirect('AttendanceController/update_class_alloted/'.$class_id);
            elseif($qy):
             $error_message .= '<p style="color:red">Sorry! This Time Teacher Class Already Exist ... <p/>'; 
            
            
            $this->session->set_flashdata('msg', $error_message);
            redirect('AttendanceController/update_class_alloted/'.$class_id);
            
            else:

        $data = array(
        'class_id'          => $class_id,
        'building_block_id' => $building_block,
        'room_id'           => $rooms,
        'day_id'            => $day_id,
        'stime_id'          => $stime_id,
        'etime_id'          => $etime_id,
        'date'              => date('Y-m-d'),
        'user_id'           => $user_id,
        );
        $this->CRUDModel->insert('timetable',$data);
        redirect('AttendanceController/update_class_alloted/'.$class_id);
        endif;
    }
    public function deletetimetable()
    {
        $timetable_id = $this->uri->segment(3);
        $class_id = $this->uri->segment(4);
        $where = array('timetable_id'=>$timetable_id);
        $this->CRUDModel->deleteid('timetable',$where);
        redirect('AttendanceController/update_class_alloted/'.$class_id);
    }    
      public function update_class_alloted($id){   
        $this->data['building_block']       = $this->CRUDModel->dropDownName('invt_building_block', 'Building Block', 'bb_id', 'bb_name',array('bb_status'=>1)); 
        $this->data['rooms']                = $this->CRUDModel->dropDownName('invt_rooms', 'Rooms', 'rm_id', 'rm_name');
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $emp_id             = $this->input->post('emp_id');
            $sec_id             = $this->input->post('sec_id');
            $subject_id         = $this->input->post('subject_id');
            $data       = array(
                'emp_id' =>$emp_id,
                'sec_id' =>$sec_id,
                'subject_id' =>$subject_id
            );
            $where = array('class_id'=>$id);
            $this->CRUDModel->update('class_alloted',$data, $where);
            redirect('AttendanceController/class_alloted');
        endif;
        if($id):
            $where = array('class_alloted.class_id'=>$id);
            $where_t = array('timetable.class_id'=>$id);
            $this->data['result'] = $this->AttendanceModel->getclass_byid('class_alloted',$where);
            $this->data['ttable'] = $this->AttendanceModel->getclassTimeTable('timetable',$where_t);
                $this->data['page_title']        = 'Update Record | ECMS';
                $this->data['page']        =  'attendance/update_class_alloted';
                $this->load->view('common/common',$this->data);
            
            endif;
    }
    
    public function update_class_allotedxyz($id)
    {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $emp_id      = $this->input->post('emp_id');
            $sec_id      = $this->input->post('sec_id');
            $subject_id      = $this->input->post('subject_id');
            $data       = array(
                'emp_id' =>$emp_id,
                'sec_id' =>$sec_id,
                'subject_id' =>$subject_id
            );
            $where = array('class_id'=>$id);
            $this->CRUDModel->update('class_alloted',$data, $where);
            redirect('AttendanceController/class_alloted');
        endif;
        if($id):
            $where = array('class_alloted.class_id'=>$id);
            $where_t = array('timetable.class_id'=>$id);
            $this->data['result'] = $this->AttendanceModel->getclass_byid('class_alloted',$where);
            $this->data['ttable'] = $this->AttendanceModel->getclassTimeTable('timetable',$where_t);
                $this->data['page_title']        = 'Update Record | ECMS';
                $this->data['page']        =  'attendance/update_class_alloted';
                $this->load->view('common/common',$this->data);
            
            endif;
    }
    
    public function auto_empname()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->AttendanceModel->getempnames('hr_emp_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('emp_name'=>$term);
            
            $result_set             = $this->AttendanceModel->getempnames('hr_emp_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_sub()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->AttendanceModel->getsub('subject');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->title.'('.$row_set->sub_program.')',
                    'label'=>$row_set->title.'('.$row_set->sub_program.')',
                    'id'=>$row_set->subject_id,
                    'flag'=>$row_set->flag
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['subject_id']  = $makkah_hotel['id'];
            $makkah_hotel['flag']  = $makkah_hotel['flag'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 20);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('title'=>$term);
            
            $result_set             = $this->AttendanceModel->getsub('subject',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->title.'('.$row_set->sub_program.')',
                    'label'=>$row_set->title.'('.$row_set->sub_program.')',
                    'id'=>$row_set->subject_id,
                    'flag'=>$row_set->flag
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['subject_id']  = $makkah_hotel['id'];
            $makkah_hotel['flag']  = $makkah_hotel['flag'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 20);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_emp()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->AttendanceModel->getdesig('hr_emp_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('emp_name'=>$term);
            
            $result_set             = $this->AttendanceModel->getdesig('hr_emp_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_section(){ 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->AttendanceModel->get_SectionList('sections');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->sec_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['sec_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 20);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('name'=>$term);
            
            $result_set             = $this->AttendanceModel->get_SectionList('sections',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->name,
                  'label'=>$row_set->name,
                  'id'=>$row_set->sec_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['sec_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 20);
            echo  json_encode($matches); 
            }
    }
    public function auto_section_arts(){ 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->AttendanceModel->get_SectionInterList('sections');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->sec_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['sec_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('name'=>$term);
            
            $result_set             = $this->AttendanceModel->get_SectionInterList('sections',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->name,
                  'label'=>$row_set->name,
                  'id'=>$row_set->sec_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['sec_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_subject()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->AttendanceModel->getsubj('subject');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->title.' ('.$row_set->sub_program.')',
                    'label'=>$row_set->title.' ('.$row_set->sub_program.')',
                    'id'=>$row_set->subject_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['subject_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('title'=>$term);
            
            $result_set             = $this->AttendanceModel->getsubj('subject',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->title.' ('.$row_set->sub_program.')',
                  'label'=>$row_set->title.' ('.$row_set->sub_program.')',
                  'id'=>$row_set->subject_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['subject_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    
      public function auto_program(){
      
        
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
              
                $result_set     = $this->CRUDModel->get_where_result('programes_info',array('status'=>'yes'));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->programe_name, 
                            'code'     =>$row_set->programe_id, 
                            'value'     =>$row_set->programe_name, 
                             
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                
                $result_set             = $this->CRUDModel->get_where_like('programes_info',array('status'=>'yes'),array('programe_name'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                           'label'     =>$row_set->programe_name, 
                            'code'     =>$row_set->programe_id, 
                            'value'     =>$row_set->programe_name, 
                            
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
        
    }
    
            }
   
            
    public function auto_sub_program(){
      
        
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
              
                $result_set     = $this->CRUDModel->get_where_result('sub_programes',array('status'=>'yes'));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->name, 
                            'code'     =>$row_set->sub_pro_id, 
                            'value'     =>$row_set->name, 
                             
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                
                $result_set             = $this->CRUDModel->get_where_like('sub_programes',array('status'=>'yes'),array('name'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                           'label'     =>$row_set->name, 
                            'code'     =>$row_set->sub_pro_id, 
                            'value'     =>$row_set->name, 
                            
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
        
    }
    
            }
    public function auto_subject_program(){
      
        
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
              
                $result_set     = $this->AttendanceModel->get_program_subject('subject',array('programes_info.programe_id'=>'1'));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'value'     =>$row_set->title.'==>'.$row_set->program.'==>'.$row_set->sub_program, 
                            'code'     =>$row_set->subject_id, 
                           'label'     =>$row_set->title.'==>'.$row_set->program.'==>'.$row_set->sub_program, 
                             
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                
                $result_set             = $this->AttendanceModel->get_program_subject('subject',array('programes_info.programe_id'=>'1'),array('title'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                            'value'     =>$row_set->title.'==>'.$row_set->program.'==>'.$row_set->sub_program, 
                            'code'     =>$row_set->subject_id, 
                           'label'     =>$row_set->title.'==>'.$row_set->program.'==>'.$row_set->sub_program, 
                             
                            
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
        
    }
    
            }
    
            
//          
//        public function subject_wise_report_inter(){
//
//            if($this->input->post()):
//                $subject_id = $this->input->post('subjectNameId');
//                $where = array('subject.subject_id'=>$subject_id,'student_record.programe_id'=>1);
//               
//                if($this->input->post('search')):
//                $this->data['subjectResult'] = $this->AttendanceModel->get_subject_results('student_subject_alloted',$where);
//                endif;
//                
//                if($this->input->post('export')):
//                     
//                $this->load->library('excel');
//                $this->excel->setActiveSheetIndex(0);
//                //name the worksheet
//                $this->excel->getActiveSheet()->setTitle('Year Head Reprot');
//                //set cell A1 content with some text
//                $this->excel->getActiveSheet()->setCellValue('A1', 'College');
//                
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
//                
//                $this->excel->getActiveSheet()->setCellValue('B1', 'Name');
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
//                
//                $this->excel->getActiveSheet()->setCellValue('C1','Father Name');
//                
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
//                
//               
//                $this->excel->getActiveSheet()->setCellValue('D1', 'Subject');
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
//                 
//               
//                
//       for($col = ord('A'); $col <= ord('D'); $col++){
//                //set column dimension
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
//                 //change the font size
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
//                 
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//        }
//
//         
//            $result   = $this->AttendanceModel->get_subject_resultsExcel('student_subject_alloted',$where);
//           
//        foreach ($result as $row){
//               
//                $exceldata[] = $row;
//                
//        }
//                 
//                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
//                  
//                $filename='meritList2016.xls'; //save our workbook as this file name
//                header('Content-Type: application/vnd.ms-excel'); //mime type
//                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
//                header('Cache-Control: max-age=0'); //no cache
// 
//                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//                //if you want to save it as .XLSX Excel 2007 format
//                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//                //force user to download the Excel file without writing it to server's HD
//                $objWriter->save('php://output');
//                    
//                endif;
//                endif;
//
//
//        $this->data['HeaderPage']       = 'Subject wise Report (Inter)';
//        $this->data['page_title']       = 'Subject wise Report | ECMS';
//        $this->data['page']             = 'attendance/sudent_subject_wise_report';
//        $this->load->view('common/common',$this->data);
//    }
//            
//    public function subject_wise_report_degree(){
//
//            if($this->input->post()):
//                $subject_id = $this->input->post('subjectNameId');
//                $where = array('subject.subject_id'=>$subject_id,'student_record.programe_id'=>1);
//               
//                if($this->input->post('search')):
//                $this->data['subjectResult'] = $this->AttendanceModel->get_subject_results('student_subject_alloted',$where);
//                endif;
//                
//                if($this->input->post('export')):
//                     
//                $this->load->library('excel');
//                $this->excel->setActiveSheetIndex(0);
//                //name the worksheet
//                $this->excel->getActiveSheet()->setTitle('Year Head Reprot');
//                //set cell A1 content with some text
//                $this->excel->getActiveSheet()->setCellValue('A1', 'College');
//                
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
//                
//                $this->excel->getActiveSheet()->setCellValue('B1', 'Name');
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
//                
//                $this->excel->getActiveSheet()->setCellValue('C1','Father Name');
//                
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
//                
//               
//                $this->excel->getActiveSheet()->setCellValue('D1', 'Subject');
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
//                 
//               
//                
//       for($col = ord('A'); $col <= ord('D'); $col++){
//                //set column dimension
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
//                 //change the font size
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
//                 
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//        }
//
//         
//            $result   = $this->AttendanceModel->get_subject_resultsExcel('student_subject_alloted',$where);
//           
//        foreach ($result as $row){
//               
//                $exceldata[] = $row;
//                
//        }
//                 
//                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
//                  
//                $filename='meritList2016.xls'; //save our workbook as this file name
//                header('Content-Type: application/vnd.ms-excel'); //mime type
//                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
//                header('Cache-Control: max-age=0'); //no cache
// 
//                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//                //if you want to save it as .XLSX Excel 2007 format
//                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//                //force user to download the Excel file without writing it to server's HD
//                $objWriter->save('php://output');
//                    
//                endif;
//                endif;
//
//
//        $this->data['HeaderPage']       = 'Subject wise Report (Degree)';
//        $this->data['page_title']       = 'Subject wise Report Degree | ECMS';
//        $this->data['page']             = 'attendance/sudent_subject_wise_degree';
//        $this->load->view('common/common',$this->data);
//    }
     public function auto_subject_program_degree(){
      
        
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
              
                $result_set     = $this->AttendanceModel->get_program_subject('subject',array('programes_info.programe_id'=>'4'));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            
                            'value'     =>$row_set->title.'==>'.$row_set->program.'==>'.$row_set->sub_program, 
                            'code'     =>$row_set->subject_id, 
                            
                            'label'     =>$row_set->title.'==>'.$row_set->program.'==>'.$row_set->sub_program, 
                             
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                
                $result_set             = $this->AttendanceModel->get_program_subject('subject',array('programes_info.programe_id'=>'4'),array('title'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                          'value'     =>$row_set->title.'==>'.$row_set->program.'==>'.$row_set->sub_program, 
                            'code'     =>$row_set->subject_id, 
                            
                            'label'     =>$row_set->title.'==>'.$row_set->program.'==>'.$row_set->sub_program, 
                             
                            
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
        
    }
    
            }
            
  public function cs_attendance()
    {       
        $where = array('class_alloted.flag'=>'1');
        $subwhere = array('class_alloted.flag'=>'2');
        $this->data['result'] = $this->AttendanceModel->cs_alloted_sections('class_alloted',$where);
        $this->data['subjectbase'] = $this->AttendanceModel->cs_alloted_subjects('class_alloted',$subwhere);
        $this->data['page_title']   = 'Admin Sections List | ECMS';
        $this->data['page']         = 'attendance/cs_sections_list';
        $this->load->view('common/common',$this->data);
    }
    
    public function cs_studentsAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $where      = array('student_group_allotment.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
        $this->data['secclass'] = $this->AttendanceModel->getallotedsections('class_alloted');
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $attendance_date = $this->input->post('attendance_date');
        $checked = array
            (
               'class_id'=>$class_id,
               'attendance_date'=>$attendance_date
            );
        $qry = $this->CRUDModel->get_where_row('student_attendance',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! Students Attendance for this Section and Date Already Exist');
        redirect('AttendanceController/cs_studentsAtts/'.$class_id.'/'.$sec_id);       
        else:
            $checked = $this->input->post('checked');
            $where      = array('student_group_allotment.section_id'=>$sec_id);
            $all_students = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
            if(!empty($checked)):
                $date_required = $attendance_date;
            $date_required = str_replace('/', '-', $date_required);
            $day = date('l', strtotime( $date_required));
            if ($day == 'Sunday' || $day == 'Saturday')
            {
              $this->session->set_flashdata('msg', 'Sorry! Off Day Attendance Not Allowed');
                redirect('AttendanceController/cs_attendance');
            }
    
            $data  = array
            (
                'class_id' =>$class_id,
                'attendance_date' =>$attendance_date,
                'user_id' =>$user_id
             );
            $attend_id = $this->CRUDModel->insert('student_attendance',$data);
            
            $allStd = array();
            $sn = 0;
            foreach($all_students as $row)
            {
                $allStd[$sn] = $row->student_id ;
                    $sn++;
            }
            $diff = array_diff($allStd,$checked);
            foreach($diff as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'student_id'=>$value,
                'status'=>0
            );
            $this->CRUDModel->insert('student_attendance_details',$attend_data);
            endforeach;
            foreach($checked as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'student_id'=>$value,
                'status'=>1
            );
        $this->CRUDModel->insert('student_attendance_details',$attend_data);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/cs_attendance');
            else:
                $data  = array
                                (
                                    'class_id' =>$class_id,
                                    'attendance_date' =>$attendance_date,
                                    'user_id' =>$user_id
                                 );
            $attend_id = $this->CRUDModel->insert('student_attendance',$data);
            
        foreach($all_students as $asrow):
            $asdata = array(
            'attend_id'=>$attend_id,
                'student_id'=>$asrow->student_id,
                'status'=>0
            );
            $this->CRUDModel->insert('student_attendance_details',$asdata);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/cs_attendance');
            endif;
            
        endif;
        endif;
        $this->data['page_title']   = 'Students Attendance | ECMS';
        $this->data['page']         = 'attendance/cs_studentAtts';
        $this->load->view('common/common',$this->data);
    }
    
    public function cs_studentsSubjectsAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
    $where =array('student_subject_alloted.subject_id'=>$subject_id,'student_subject_alloted.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where);
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $subject_id     = $this->input->post('subject_id');
        $attendance_date = $this->input->post('attendance_date');
        $checked = array
            (
               'class_id'=>$class_id,
               'attendance_date'=>$attendance_date
            );
        $qry = $this->CRUDModel->get_where_row('student_attendance',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! Students Attendance for this Section and Date Already Exist');
        redirect('AttendanceController/cs_studentsSubjectsAtts/'.$class_id.'/'.$sec_id.'/'.$subject_id);       
        else:
            $checked = $this->input->post('checked');
            $where      = array('student_subject_alloted.subject_id'=>$subject_id);
            $all_students = $this->AttendanceModel->get_students_studentAtts('student_subject_alloted',$where);
            if(!empty($checked)):
            $date_required = $attendance_date;
            $date_required = str_replace('/', '-', $date_required);
            $day = date('l', strtotime( $date_required));
            if ($day == 'Sunday' || $day == 'Saturday')
            {
              $this->session->set_flashdata('msg', 'Sorry! Off Day Attendance Not Allowed');
                redirect('AttendanceController/cs_attendance');
            }
            $data  = array
            (
                'class_id' =>$class_id,
                'attendance_date' =>$attendance_date,
                'user_id' =>$user_id
             );
            $attend_id = $this->CRUDModel->insert('student_attendance',$data);
        
            
            $allStd = array();
            $sn = 0;
            foreach($all_students as $row)
            {
                $allStd[$sn] = $row->student_id ;
                    $sn++;
            }
            $diff = array_diff($allStd,$checked);
            foreach($diff as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'student_id'=>$value,
                'status'=>0
            );
            $this->CRUDModel->insert('student_attendance_details',$attend_data);
            endforeach;
        
            foreach($checked as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'student_id'=>$value,
                'status'=>1
            );
        $this->CRUDModel->insert('student_attendance_details',$attend_data);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/cs_attendance');
            else:
                $data  = array
                        (
                            'class_id' =>$class_id,
                            'attendance_date' =>$attendance_date,
                            'user_id' =>$user_id
                         );
                    $attend_id = $this->CRUDModel->insert('student_attendance',$data);

                foreach($all_students as $asrow):
                    $asdata = array(
                    'attend_id'=>$attend_id,
                        'student_id'=>$asrow->student_id,
                        'status'=>0
                    );
                    $this->CRUDModel->insert('student_attendance_details',$asdata);
                endforeach;
                $this->session->set_flashdata('msg', 'Successfully Submitted.');
                redirect('AttendanceController/cs_attendance');
        endif;
        
        endif;
        endif;
        $this->data['page_title']   = 'Students Attendance | ECMS';
        $this->data['page']         = 'attendance/cs_student_SubjectAtts';
        $this->load->view('common/common',$this->data);
    }
    
    public function cs_attendance_history()
    {       
        $this->data['result']       = $this->AttendanceModel->csstudent_attendance('student_attendance');
        $this->data['page_title']   = 'Student Attendance | ECMS';
        $this->data['page']         = 'attendance/cs_students_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function cs_view_attendance()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('student_attendance_details.attend_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
$this->data['result']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $wherePrsent = array('student_attendance_details.attend_id'=>$id,'status'=>1);
        $whereAbsent = array('student_attendance_details.attend_id'=>$id,'status'=>0);
        $this->data['present']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$wherePrsent));
        $this->data['Absent']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereAbsent));
        
        $this->data['count']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $this->data['page_title']   = 'HOD VIew Student Attendance | ECMS';
        $this->data['page']         = 'attendance/cs_view_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function cs_search_section()
    {       
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
            
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if(!empty($emp_id)):
                $where2['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where2['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where2['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $where['class_alloted.flag']='1';
            $where2['class_alloted.flag']='2';
            $this->data['result'] = $this->AttendanceModel->cs_getsections_list('class_alloted',$where);
            $this->data['subjectbase'] = $this->AttendanceModel->cs_alloted_subjectss('class_alloted',$where2);
            $this->data['page_title']   = 'HOD Search Sections List | ECMS';
            $this->data['page']         = 'attendance/cs_search_sections_list';
            $this->load->view('common/common',$this->data);
            endif;
    }
            
        public function subject_wise_report_inter(){

            if($this->input->post()):
                $subject_id = $this->input->post('subjectNameId');
                $where = array('class_alloted.subject_id'=>$subject_id);
         
                if($this->input->post('search')):
                    
                $this->data['subjectResult'] = $this->AttendanceModel->get_subject_results($where);
               
                endif;
                
               
                endif;


        $this->data['HeaderPage']       = 'Subject wise Report (Inter)';
        $this->data['page_title']       = 'Subject wise Report | ECMS';
        $this->data['page']             = 'attendance/sudent_subject_wise_report';
        $this->load->view('common/common',$this->data);
    }
    
    public function subject_wise_sub_report_inter(){
         
        $subject_id = $this->uri->segment(3);
        $section_id = $this->uri->segment(4);
        $flag       = $this->uri->segment(5);
        if($flag ==1):
            $where = array(
                'student_group_allotment.section_id'=>$section_id
            );
            $this->data['subject_list']= $this->AttendanceModel->sub_report_inter_session($where);
        else:
            $where = array(
                'student_subject_alloted.subject_id'=>$subject_id,
                'student_subject_alloted.section_id'=>$section_id
                );
        $this->data['subject_list']  = $this->AttendanceModel->sub_report_inter_subject($where);
        endif;
        
        if($this->input->post('export')):
            
            $flag           = $this->input->post('flag');
            $section_id     = $this->input->post('sec_id');
            $subject_id     = $this->input->post('subject_id');
            
            if($flag == 1):
                
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Subject Result');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'College');
                
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Father Name');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Section');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                 
               
                
       for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
 
                
                 $where = array(
                'student_group_allotment.section_id'=>$section_id
            );
            $subject_list= $this->AttendanceModel->sub_report_inter_sessionExcel($where);
           
        foreach ($subject_list as $row){
               
                $exceldata[] = $row;
                
        }
                 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                  
                $date = date('Y-m-s H:i:s');
                $name = 'section_wise_report_'.$date;
                $filename=$name.'.xls'; //save our workbook as this file name
             
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                
               
            
           
            endif;
            
            if($flag == 2):
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Subject Result');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'College');
                
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Father Name');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Section');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                 
               
                
       for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
                 $where = array(
                    'student_subject_alloted.subject_id'=>$subject_id,
                    'student_subject_alloted.section_id'=>$section_id
                    );
            $subject_list  = $this->AttendanceModel->sub_report_inter_subjectExcel($where);
           
        foreach ($subject_list as $row){
               
                $exceldata[] = $row;
                
        }
                 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                  
                $date = date('Y-m-s H:i:s');
                $name = 'subject_wise_report_'.$date;
                $filename=$name.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
      
          
            endif;
          
            
            $where = array(
                'student_group_allotment.section_id'=>$section_id
            );
            $this->data['subject_list']= $this->AttendanceModel->sub_report_inter_session($where);
        endif;
        
        $this->data['HeaderPage']       = 'Subject Result';
        $this->data['page_title']       = 'Subject Result | ECMS';
        $this->data['page']             = 'attendance/sudent_subject_wise_report_result';
        $this->load->view('common/common',$this->data);
       
        
        
    }
    
  
     public function subject_wise_report_degree(){

            if($this->input->post()):
//                $subject_id = $this->input->post('subjectNameId');
//                $where = array('subject.subject_id'=>$subject_id,'student_record.programe_id'=>1);
//               
//                if($this->input->post('search')):
//                $this->data['subjectResult'] = $this->AttendanceModel->get_subject_results('student_subject_alloted',$where);
//                endif;
             $subject_id = $this->input->post('subjectNameDegreeId');
                $where = array('class_alloted.subject_id'=>$subject_id);
         
                if($this->input->post('search')):
                    
                $this->data['subjectResult'] = $this->AttendanceModel->get_subject_results($where);
               
                endif;
                
               
                
                
                endif;


        $this->data['HeaderPage']       = 'Subject wise Report (Degree)';
        $this->data['page_title']       = 'Subject wise Report Degree | ECMS';
        $this->data['page']             = 'attendance/sudent_subject_wise_degree';
        $this->load->view('common/common',$this->data);
    }
    
    public function search_test_history()
    {       
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
            
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if(!empty($emp_id)):
                $where2['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where2['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where2['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $where['class_alloted.flag']='1';
            $where2['class_alloted.flag']='2';
            $this->data['result'] = $this->AttendanceModel->admin_getsections_list('class_alloted',$where);
            $this->data['subjectbase'] = $this->AttendanceModel->get_alloted_subjectss('class_alloted',$where2);
            $this->data['page_title']   = 'HOD Search Sections List | ECMS';
            $this->data['page']         = 'attendance/search_test_history';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function auto_sub_pro_program()
     { 
        $term = trim(strip_tags($_GET['term']));       
            if( $term == ''){   
            $result_set             = $this->AttendanceModel->getsub_pro_program('sub_programes');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->name.'('.$row_set->program.')',
                    'label'=>$row_set->name.'('.$row_set->program.')',
                    'code'=>$row_set->sub_pro_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['code']  = $makkah_hotel['code'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('name'=>$term);
            
            $result_set             = $this->AttendanceModel->getsub_pro_program('sub_programes',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->name.'('.$row_set->program.')',
                    'label'=>$row_set->name.'('.$row_set->program.')',
                    'code'=>$row_set->sub_pro_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['code']  = $makkah_hotel['code'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function labs()
    {       
        $this->data['result']       = $this->AttendanceModel->getlabs();
        $this->data['page_title']   = 'Labs List | ECMS';
        $this->data['page']         = 'attendance/labs';
        $this->load->view('common/common',$this->data);
    }
    
    public function add_lab()
    {       
        if($this->input->post()):
            $lab_name      = $this->input->post('lab_name');
            $data       = array(
                'lab_name' =>$lab_name
            );
            $this->CRUDModel->insert('labs',$data);
            $this->data['page_title']   = 'Add New Lab | ECMS';
            $this->data['page']         = 'attendance/labs';
            $this->load->view('common/common',$this->data);
            redirect('AttendanceController/labs');
          else:
              redirect('/');
        endif;
    }
    
    public function update_lab($id)
    {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $lab_name      = $this->input->post('lab_name');
            $data       = array(
                'lab_name' =>$lab_name
            );
            $where = array('lab_id'=>$id);
            $this->CRUDModel->update('labs',$data, $where);
            $this->data['page_title']   = 'Update Lab | ECMS';
            $this->data['page']         = 'attendance/update_lab';
            $this->load->view('common/common',$this->data);
            redirect('AttendanceController/labs');
        endif;
        if($id):
                $where = array('labs.lab_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('labs',$where);
                $this->data['page_title']        = 'Update Lab | ECMS';
                $this->data['page']        =  'attendance/update_lab';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
    public function delete_lab()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('lab_id'=>$id);
        $this->CRUDModel->deleteid('labs',$where);
        redirect('AttendanceController/labs');
    }
    
    public function practical_groups()
    {       
       if($this->input->post()):
            $lab_id     = $this->input->post('lab_id');
            $prac_group_id         = $this->input->post('group_id');
            $subject_id     = $this->input->post('subject_id');
        if($lab_id):
            $where['labs.lab_id'] = $lab_id;
        endif;  
        if($prac_group_id):
            $where['practical_group.prac_group_id'] = $prac_group_id;
        endif;
        if($subject_id):
            $where['practical_subject.prac_subject_id'] = $subject_id;
        endif;
            $this->data['result']       = $this->AttendanceModel->getpracticalgroups('practical_group',$where);
        else:
            $this->data['result']       = $this->AttendanceModel->getpracticalgroups('practical_group');
        endif;
        $this->data['page_title']   = 'Practical Groups List | ECMS';
        $this->data['page']         = 'attendance/practical_groups';
        $this->load->view('common/common',$this->data);
    }
        
    public function delete_practical_group()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('prac_group_id'=>$id);
        $this->CRUDModel->deleteid('practical_group',$where);
        redirect('AttendanceController/practical_groups');
	}
    
    public function add_practical_group()
    {       
        if($this->input->post()):
            $group_name      = $this->input->post('group_name');
            $lab_id      = $this->input->post('lab_id');
            $subject_id      = $this->input->post('subject_id');
            $data       = array(
                'group_name' =>$group_name,
                'lab_id' =>$lab_id,
                'subject_id' =>$subject_id
            );
            $this->CRUDModel->insert('practical_group',$data);
            redirect('AttendanceController/practical_groups');
            endif;
            $this->data['page_title']   = 'Add New Group | ECMS';
            $this->data['page']         = 'attendance/add_practical_group';
            $this->load->view('common/common',$this->data);
       
    }
    
    public function update_practical_group()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
        $data = array(
            'group_name'=>$this->input->post('group_name'),
            'lab_id'=>$this->input->post('lab_id'),
            'subject_id'=>$this->input->post('subject_id'),
        );
          $where = array('prac_group_id'=>$id);
          $this->CRUDModel->update('practical_group',$data,$where);
          redirect('AttendanceController/practical_groups'); 
          endif;
        if($id):
            $where = array('practical_group.prac_group_id'=>$id);
            $this->data['result'] = $this->AttendanceModel->getgroup_byid('practical_group',$where);
            $this->data['page_title']        = 'Update Practical Group | ECMS';
            $this->data['page']        =  'attendance/update_practical_group';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function practical_group_allottment()
    {       
       // $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name'); 
        $this->data['practStudents']  = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>'1'));
            $college_no       =  $this->input->post('college_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['sub_pro_id']  = '';
            
    if($this->input->post('search')):
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
        $this->data['result']   = $this->AttendanceModel->search_student_group('student_record',$where,$like);
        endif;
        $this->data['page_title']   = 'Practical Group Allottment | ECMS';
        $this->data['page']         = 'attendance/practical_group_allottment';
        $this->load->view('common/common',$this->data);
    }
    
    public function assign_practical_groups()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id         = $this->uri->segment(3);
        $sub_pro_id         = $this->uri->segment(4);
        $where      = array('student_id'=>$id);
        $subpro_where      = array('sub_pro_id'=>$sub_pro_id);
        
        if($this->input->post()):  
            $ides = $this->input->post('checked');
            $student_id = $this->input->post('student_id');
            if(!empty($ides)):
            foreach($ides as $row=>$value):
                $data_array = array(
                       'group_id'=>$value,
                       'student_id'=>$student_id,
                       'user_id'=>$user_id
                 );
                $this->CRUDModel->insert('student_prac_group_allottment',$data_array);
            endforeach; 
            endif;
       
            redirect('AttendanceController/practical_group_allottment');
            endif;
        
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['subjects'] = $this->CRUDModel->getResults('practical_subject');
        
       $this->data['page_title']   = 'Student Assign Practical | ECMS';
       $this->data['page']         = 'attendance/assign_practical';
       $this->load->view('common/common',$this->data);
    }
    
public function update_assign_practical_groups()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id         = $this->uri->segment(3);
        $sub_pro_id         = $this->uri->segment(4);
        $where      = array('student_id'=>$id);
        $subpro_where      = array('sub_pro_id'=>$sub_pro_id);
        
        if($this->input->post()):  
            $ides = $this->input->post('checked');
            $student_id = $this->input->post('student_id');
            $ids        = $this->CRUDModel->deleteid('student_prac_group_allottment', array('student_id'=>$student_id));
    if(!empty($ides)):
            foreach($ides as $row=>$value):
                $data_array = array(
                       'group_id'=>$value,
                       'student_id'=>$student_id,
                       'user_id'=>$user_id
                 );
                $this->CRUDModel->insert('student_prac_group_allottment',$data_array);
            endforeach;
            endif;
            redirect('AttendanceController/practical_group_allottment');
            endif;
        
    $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
    $this->data['subjects'] = $this->CRUDModel->getResults('practical_subject');
    $this->data['selectsubjects'] = $this->CRUDModel->get_where_result('student_prac_group_allottment', $where);
        
       $this->data['page_title']   = 'Update Student Assign Practical | ECMS';
       $this->data['page']         = 'attendance/update_assign_practical';
       $this->load->view('common/common',$this->data);
    }
    
    
    public function practical_alloted()
    {          
        
       if($this->input->post()):
            $where='';
            $emp_idCode     = $this->input->post('emp_id');
            $prac_group_id         = $this->input->post('group_id');
            $subject_id     = $this->input->post('subject_id');
        if($emp_idCode):
            $where['practical_alloted.emp_id'] = $emp_idCode;
        endif;  
        if($prac_group_id):
            $where['practical_group.prac_group_id'] = $prac_group_id;
        endif;
        if($subject_id):
            $where['practical_subject.prac_subject_id'] = $subject_id;
        endif;
            $this->data['result']       = $this->AttendanceModel->getpractical_alloted('practical_alloted',$where);
        endif;
        
        $this->data['page_title']   = 'Practical Alloted | ECMS';
        $this->data['page']         = 'attendance/practical_alloted';
        $this->load->view('common/common',$this->data);
    }
    
    public function get_teacher_practimetable(){
            
                
            $prac_class_id = $this->input->post('practical_class_id');
                $where = array(
                   'practical_class_id'=>$prac_class_id, 
                 );
            $emp_q = $this->AttendanceModel->getpracEmp_Data('practical_alloted',$where);
            $result = $this->AttendanceModel->pracgroup_Timetable('practical_timetable',$where);
            if($result):
            echo '<strong style="color:red">Teacher: '.$emp_q->emp_name.', '.'</strong>';
            echo '<strong style="color:red">Group: '.$emp_q->group_name.', '.'</strong>';
            echo '<strong style="color:red;">Subject: '.$emp_q->title.'</strong><br/><br/>';
            echo '<table class="table table-boxed table-hover">
                <thead>
                  <tr>
                    <th>S.N </th>
                    <th>Day </th>
                    <th>Star Time</th>
                    <th>End Time</th>
                  </tr>
                </thead>
                <tbody>';
            $sn = 1;
             foreach($result as $row):
             
                 echo '<tr>
                        <td>'.$sn.'</td>
                        <td>'.$row->day_name.'</td>
                        <td>'.$row->class_stime.'</td>
                        <td>'.$row->class_etime.'</td>
                    </tr>';
                $sn++;
            endforeach;
                echo '</tbody>
              </table>';
            endif;
        }
    
    public function add_Practical_timeTable()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $day_id   = $this->input->post('day_id');
            $group_id   = $this->input->post('group_id');
            $emp_id   = $this->input->post('emp_id');
            $subject_id   = $this->input->post('subject_id');
            $stime_id   = $this->input->post('stime_id');
            $etime_id   = $this->input->post('etime_id');
            $form_Code  = $this->input->post('form_Code');
            $check = array(
                'practical_alloted.group_id' => $group_id,
                'practical_timetable.day_id' => $day_id,
                'practical_timetable.stime_id' => $stime_id,
				);
            $q = $this->AttendanceModel->getPrac_TimeTablerow('practical_alloted',$check);
            $chk = array(
                'practical_alloted.emp_id' => $emp_id,
                'practical_timetable.day_id' => $day_id,
                'practical_timetable.stime_id' => $stime_id,
				);
            $qy = $this->AttendanceModel->getPrac_TimeTablerow('practical_alloted',$chk);
            $ms = '';
            $m = '';
            if($q):
            $ms = '<p style="color:red">Sorry! This Time for Class Dadicated to Other One ... <p/>'; 
            echo $ms;
            elseif($qy):
            $m = '<p style="color:red">Sorry! This Time Teacher Class Already Exist ... <p/>'; 
            echo $m;
            else:
            $checked = array(
                'day_id' => $day_id,
                'stime_id' => $stime_id,
                'etime_id' => $etime_id,
                'form_Code' => $form_Code,
				);
            $qry = $this->CRUDModel->get_where_row('practical_timetable_demo',$checked);
            $msg = '';
            if($qry):
             $msg = '<p style="color:red">Sorry! Double Entry Not Allowed. <p/>';  
        echo $msg;
            else:
            $data = array(
                'day_id' => $day_id,
                'stime_id' =>$stime_id,
                'etime_id' =>$etime_id,
                'form_Code' =>$form_Code,
                'date' => date('Y-m-d'),
                'user_id' => $user_id
            );
    $this->CRUDModel->insert('practical_timetable_demo',$data);
    
    $result = $this->AttendanceModel->getPract_TimeTableDemo('practical_timetable_demo');    
       echo '<table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Day Name</th>
                            <th>Starting Time </th>
                            <th>Ending Time</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';         
                        foreach($result as $eRow):
                        echo '<tr id="'.$eRow->ptimetable_id.'Delete">
                                <td>'.$eRow->day_name.'</td>
                                <td>'.$eRow->class_stime.'</td>
                                <td>'.$eRow->class_etime.'</td>
                        <td><a href="javascript:void(0)" id="'.$eRow->ptimetable_id.'" class="delete_Prac_TimeTable"><i class="fa fa-trash"></i></a></td>        
                           </tr>';                      
                        endforeach;
                        endif;
                    echo '</tbody>
                </table> ';
        endif;
        endif;
        ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.delete_Prac_TimeTable').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'AttendanceController/delete_Prac_TimeTable',
                     data: {'deletId':deletId},
                     success : function(result){
                        var del = deletId+'Delete';
                        jQuery('#'+del).hide(); 
                     }
                 });

             });

            });

            </script>
<?php       
}
    
    public function delete_Prac_TimeTable(){
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('practical_timetable_demo',array('ptimetable_id'=>$deletId));
    }
    
    public function employee_prac_timetable()
    {       
        $emp_id = $this->uri->segment(3);
        $where = array('practical_alloted.emp_id'=>$emp_id);
        $this->data['prac_mon'] = $this->AttendanceModel->getPracDaym('practical_alloted',$where);
        $this->data['prac_tue'] = $this->AttendanceModel->getPracDaytu('practical_alloted',$where);
        $this->data['prac_wed'] = $this->AttendanceModel->getPracDayw('practical_alloted',$where);
        $this->data['prac_thu'] = $this->AttendanceModel->getPracDayth('practical_alloted',$where);
        $this->data['prac_fri'] = $this->AttendanceModel->getPracDayf('practical_alloted',$where);
        $this->data['page_title']   = 'Employee Practical Time Table | ECMS';
        $this->data['page']         = 'attendance/employee_practical_timetable';
        $this->load->view('common/common',$this->data);
    }
    
    public function section_base_Prac_timetable()
    {       
        $group_id = $this->uri->segment(3);
        $where = array('practical_alloted.group_id'=>$group_id);
        $this->data['prac_mon'] = $this->AttendanceModel->getPracDaym('practical_alloted',$where);
        $this->data['prac_tue'] = $this->AttendanceModel->getPracDaytu('practical_alloted',$where);
        $this->data['prac_wed'] = $this->AttendanceModel->getPracDayw('practical_alloted',$where);
        $this->data['prac_thu'] = $this->AttendanceModel->getPracDayth('practical_alloted',$where);
        $this->data['prac_fri'] = $this->AttendanceModel->getPracDayf('practical_alloted',$where);
        $this->data['page_title']   = 'Section Base Time Table | ECMS';
        $this->data['page']         = 'attendance/section_base_Prac_timetable';
        $this->load->view('common/common',$this->data);
    }
    
    public function add_practical_alloted()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('submit_timetable')):  
            $emp_id      = $this->input->post('emp_id');
            $group_id      = $this->input->post('group_id');
            $subject_id      = $this->input->post('subject_id');
            $form_Code      = $this->input->post('form_Code');
            $whereEDCheck = array(
            'group_id'=>$this->input->post('group_id'),
            'subject_id'=>$this->input->post('subject_id')
        );
        $query = $this->CRUDModel->get_where_row('practical_alloted',$whereEDCheck);
        if($query):
        $this->session->set_flashdata('msg', 'Sorry, This Record Already Exist');
        redirect('AttendanceController/add_practical_alloted');
        else:
           $data = array(
                'emp_id' =>$emp_id,
                'group_id' =>$group_id,
                'subject_id' =>$subject_id
            );
            $class_id = $this->CRUDModel->insert('practical_alloted',$data);
            $where = array(
            'user_id'=>$user_id,
            'form_Code'=>$form_Code,
            'date' => date('Y-m-d')    
        ); 
       $res =  $this->CRUDModel->get_where_result('practical_timetable_demo', $where);
       // echo '<pre>';print_r($res);die;    
       foreach($res as $isRow):
        $data = array(   
            'day_id'              =>$isRow->day_id,
            'practical_class_id'  =>$class_id,
            'stime_id'            =>$isRow->stime_id,
            'etime_id'   =>$isRow->etime_id,
            'form_Code'  =>$isRow->form_Code,
            'date'       =>$isRow->date,
            'user_id'    =>$isRow->user_id,
          );
      //  echo '<pre>';print_r($data);die;
         $this->CRUDModel->insert('practical_timetable',$data);
        $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('practical_timetable_demo',$whereDelete);
        endforeach; 
            redirect('AttendanceController/practical_alloted');
            endif;
            endif;
        $this->data['page_title']   = 'Add Practical Allotted | ECMS';
        $this->data['page']         = 'attendance/add_practical_alloted';
        $this->load->view('common/common',$this->data);
    }
    
    public function get_pracTimeTable(){
            
                
            $ptimetable_id = $this->input->post('ptimetable_id');
            $class = explode(',',$ptimetable_id);
            
                $where = array(
                   'ptimetable_id'=>$class[0], 
                 );
            $result = $this->AttendanceModel->practical_timetablerow('practical_timetable',$where);
            if($result):
            echo '<form class="form-horizontal row-fluid" method="post" action="AttendanceController/update_practimeTableRow/'.$class[0].'/'.$class[1].'">
                <div class="control-group">
                        <label class="control-label" for="basicinput">Day Name</label>
                        <div class="controls">
                        <select name="day_id" class=" form-control span6 tip">
                                <option value="'.$result->day_id.'">'.$result->day_name.'</option>
                                <option>Select Start Time</option>';
        $d = $this->CRUDModel->getResults('days');
        foreach($d as $rec):
        echo '<option value="'.$rec->day_id.'">'.$rec->day_name.'</option>';
        endforeach;
        echo '</select>                          
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Start Time</label>
                        <div class="controls">
                        <select name="stime_id" class=" form-control span6 tip">
                                <option value="'.$result->stime_id.'">'.$result->class_stime.'</option>
                                <option>Select Start Time</option>';
        $st = $this->CRUDModel->getResults('class_starting_time');
        foreach($st as $rec):
        echo '<option value="'.$rec->stime_id.'">'.$rec->class_stime.'</option>';
        endforeach;
        echo '</select>              
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">End Time</label>
                        <div class="controls">
                        <select name="etime_id" class=" form-control span6 tip">
                                <option value="'.$result->etime_id.'">'.$result->class_etime.'</option>
                                <option>Select Start Time</option>';
        $et = $this->CRUDModel->getResults('class_ending_time');
        foreach($et as $rec):
        echo '<option value="'.$rec->etime_id.'">'.$rec->class_etime.'</option>';
        endforeach;
        echo '</select>              
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" value="Update" class="btn btn-primary pull-center">
                        </div>
                    </div>
                </form>';
            
            endif;
        }
    
    public function update_practimeTableRow($ptimetable_id,$practical_class_id)
    {
        $whereEDCheck = array(
            'practical_class_id'=>$practical_class_id,
            'day_id'=>$this->input->post('day_id'),
            'stime_id'=>$this->input->post('stime_id'),
            'etime_id'=>$this->input->post('etime_id')
            );
        $query = $this->CRUDModel->get_where_row('practical_timetable',$whereEDCheck);
        if($query):
            $this->session->set_flashdata('msg', 'Sorry, This Record Already Exist');
            redirect('AttendanceController/update_practical_alloted/'.$practical_class_id);
        else:
            $where = array('ptimetable_id'=>$ptimetable_id);
            $upd_data = array(
            'day_id' => $this->input->post('day_id'),
            'stime_id' => $this->input->post('stime_id'),
            'etime_id' => $this->input->post('etime_id')
            );
            $this->CRUDModel->update('practical_timetable',$upd_data,$where);
            redirect('AttendanceController/update_practical_alloted/'.$practical_class_id);
        endif;
    }
    
    public function auto_practicalgroup()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('practical_group');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->group_name,
                    'label'=>$row_set->group_name,
                    'prcId'=>$row_set->prac_group_id
                );  
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['prcId']  = $makkah_hotel['prcId'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('group_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('practical_group',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->group_name,
                    'label'=>$row_set->group_name,
                    'prcId'=>$row_set->prac_group_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['prcId']  = $makkah_hotel['prcId'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_subjects()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->AttendanceModel->getsubjecs('subject');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->title.'('.$row_set->sub_program.')',
                    'label'=>$row_set->title.'('.$row_set->sub_program.')',
                    'id'=>$row_set->subject_id,
                    'sub_pro_id'=>$row_set->sub_pro_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['subject_id']  = $makkah_hotel['id'];
            $makkah_hotel['sub_pro_id']  = $makkah_hotel['sub_pro_id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('title'=>$term);
            
            $result_set             = $this->AttendanceModel->getsubjecs('subject',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->title.'('.$row_set->sub_program.')',
                    'label'=>$row_set->title.'('.$row_set->sub_program.')',
                    'id'=>$row_set->subject_id,
                    'sub_pro_id'=>$row_set->sub_pro_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['subject_id']  = $makkah_hotel['id'];
            $makkah_hotel['sub_pro_id']  = $makkah_hotel['sub_pro_id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function practical_studentsAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $prac_class_id = $this->uri->segment(3);
        $group_id = $this->uri->segment(4);
        $where      = array('student_prac_group_allottment.group_id'=>$group_id);
        $this->data['result'] = $this->AttendanceModel->prac_studentsAtts('student_prac_group_allottment',$where);
        $this->data['secclass'] = $this->AttendanceModel->getallotedgroups('practical_alloted');
        if($this->input->post()):
        $prac_class_id   = $this->input->post('prac_class_id');
        $group_id     = $this->input->post('group_id');
        $attendance_date = $this->input->post('attendance_date');
        $checked = array(
               'prac_class_id'=>$prac_class_id,
               'attendance_date'=>$attendance_date
            );
        $qry = $this->CRUDModel->get_where_row('practical_attendance',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! Students Attendance for this Group and Date Already Exist');
        redirect('AttendanceController/practical_studentsAtts/'.$prac_class_id.'/'.$group_id);       
        else:
                $checked = $this->input->post('checked');
               
                $where      = array('student_prac_group_allottment.group_id'=>$group_id);
                $all_students = $this->AttendanceModel->prac_studentsAtts('student_prac_group_allottment',$where);  
                    if(!empty($checked)):
                        $date_required = $attendance_date;
                        $date_required = str_replace('/', '-', $date_required);
                        $day = date('l', strtotime( $date_required));
                        if ($day == 'Sunday' || $day == 'Saturday')
                        {
                          $this->session->set_flashdata('msg', 'Sorry! Off Day Attendance Not Allowed');
                            redirect('AttendanceController/employee_alloted_groups');
                        }
                        $data  = array
                            (
                                'prac_class_id' =>$prac_class_id,
                                'attendance_date' =>$attendance_date,
                                'user_id' =>$user_id
                             );
                        $attend_id = $this->CRUDModel->insert('practical_attendance',$data);
            
               
                            $allStd = array();
                            $sn = 0;
                            foreach($all_students as $row)
                            {
                                $allStd[$sn] = $row->college_no ;
                                    $sn++;
                            }
                            $diff = array_diff($allStd,$checked);
                            foreach($diff as $row=>$value):
                            $attend_data = array
                            (
                                'attend_id'=>$attend_id,
                                'college_no'=>$value,
                                'status'=>0
                            );
                            $this->CRUDModel->insert('practical_attendance_details',$attend_data);
                            endforeach;

                            foreach($checked as $row=>$value):
                            $attend_data = array
                            (
                                'attend_id'=>$attend_id,
                                'college_no'=>$value,
                                'status'=>1
                            );
                        $this->CRUDModel->insert('practical_attendance_details',$attend_data);
                        endforeach;
                        $this->session->set_flashdata('msg', 'Successfully Submitted.');
                        redirect('AttendanceController/practical_attendance');    
                    else:
                    
                    $data  = array
                                (
                                    'prac_class_id' =>$prac_class_id,
                                    'attendance_date' =>$attendance_date,
                                    'user_id' =>$user_id
                                 );
            $attend_id = $this->CRUDModel->insert('practical_attendance',$data);
            
        foreach($all_students as $asrow):
            $asdata = array(
            'attend_id'=>$attend_id,
                'college_no'=>$asrow->college_no,
                'status'=>0
            );
            $this->CRUDModel->insert('practical_attendance_details',$asdata);
        endforeach;
            
        
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/practical_attendance'); 
        endif;
            
        endif;
        endif;
        $this->data['page_title']   = 'Students Practical Attendance | ECMS';
        $this->data['page']         = 'attendance/practical_studentAtts';
        $this->load->view('common/common',$this->data);
    }
    
    public function employee_alloted_groups()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $emp_id =$session['userData']['emp_id'];
        $where = array('practical_alloted.emp_id'=>$emp_id);
        $this->data['result'] = $this->AttendanceModel->get_alloted_groups('practical_alloted',$where);
        
        $this->data['page_title']   = 'Employee Alloted Groups | ECMS';
        $this->data['page']         = 'attendance/employee_alloted_groups';
        $this->load->view('common/common',$this->data);
    }
    
    public function practical_attendance()
    {       
        $session = $this->session->all_userdata();
        $emp_id =$session['userData']['emp_id'];
        $where = array('practical_alloted.emp_id'=>$emp_id);
        $this->data['result']       = $this->AttendanceModel->getpractical_attendance('practical_attendance',$where);
        $this->data['page_title']   = 'Student Practical Attendance | ECMS';
        $this->data['page']         = 'attendance/practical_attendance';
        $this->load->view('common/common',$this->data);
    }
    
     public function view_practical_attendance()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('practical_attendance_details.attend_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('practical_subject',array('prac_subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('practical_group',array('prac_group_id'=>$sec_id));

        $this->data['result']       = $this->AttendanceModel->view_prac_attendance('practical_attendance_details',$where);
        $wherePrsent = array('practical_attendance_details.attend_id'=>$id,'status'=>1);
        $whereAbsent = array('practical_attendance_details.attend_id'=>$id,'status'=>0);
        $this->data['present']       = count($this->AttendanceModel->view_prac_attendance('practical_attendance_details',$wherePrsent));
        $this->data['Absent']       = count($this->AttendanceModel->view_prac_attendance('practical_attendance_details',$whereAbsent));

        $this->data['count']       = $this->AttendanceModel->view_prac_attendance('practical_attendance_details',$where);
        $this->data['page_title']   = 'VIew Student Attendance | ECMS';
        $this->data['page']         = 'attendance/view_practical_attendance';
        $this->load->view('common/common',$this->data);
    }
    
   public function admin_practical_attendance()
    {    
        if($this->input->post()):
            $emp_id       =  $this->input->post('emp_id');
            $group_id             =  $this->input->post('group_id');
            $subject_id            =  $this->input->post('subject_id');
          
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = ''; 
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($group_id)):
                $where['practical_group.prac_group_id'] = $group_id;
                $this->data['group_id'] =$group_id;
            endif;
            if(!empty($subject_id)):
                $where['practical_subject.prac_subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $this->data['result'] = $this->AttendanceModel->adminget_alloted_groups('practical_alloted', $where);
        endif; 
        $this->data['page_title']   = 'Admin Practical Attendance | ECMS';
        $this->data['page']         = 'attendance/admin_practical_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_practical_studentsAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $prac_class_id = $this->uri->segment(3);
        $group_id = $this->uri->segment(4);
        $where      = array('student_prac_group_allottment.group_id'=>$group_id);
        $this->data['result'] = $this->AttendanceModel->prac_studentsAtts('student_prac_group_allottment',$where);
        $this->data['secclass'] = $this->AttendanceModel->getallotedgroups('practical_alloted');
        if($this->input->post()):
        $prac_class_id   = $this->input->post('prac_class_id');
        $group_id     = $this->input->post('group_id');
        $attendance_date = $this->input->post('attendance_date');
        $checked = array(
               'prac_class_id'=>$prac_class_id,
               'attendance_date'=>$attendance_date
            );
        $qry = $this->CRUDModel->get_where_row('practical_attendance',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! Students Attendance for this Group and Date Already Exist');
        redirect('AttendanceController/admin_practical_studentsAtts/'.$prac_class_id.'/'.$group_id);       
        else:
                $checked = $this->input->post('checked');
               
                $where      = array('student_prac_group_allottment.group_id'=>$group_id);
                $all_students = $this->AttendanceModel->prac_studentsAtts('student_prac_group_allottment',$where);  
                    if(!empty($checked)):
                        $date_required = $attendance_date;
                        $date_required = str_replace('/', '-', $date_required);
                        $day = date('l', strtotime( $date_required));
                        if ($day == 'Sunday' || $day == 'Saturday')
                        {
                          $this->session->set_flashdata('msg', 'Sorry! Off Day Attendance Not Allowed');
                            redirect('AttendanceController/admin_practical_attendance');
                        }
                        $data  = array
                            (
                                'prac_class_id' =>$prac_class_id,
                                'attendance_date' =>$attendance_date,
                                'user_id' =>$user_id
                             );
                        $attend_id = $this->CRUDModel->insert('practical_attendance',$data);
                            $allStd = array();
                            $sn = 0;
                            foreach($all_students as $row)
                            {
                                $allStd[$sn] = $row->college_no ;
                                    $sn++;
                            }
                            $diff = array_diff($allStd,$checked);
                            foreach($diff as $row=>$value):
                            $attend_data = array
                            (
                                'attend_id'=>$attend_id,
                                'college_no'=>$value,
                                'status'=>0
                            );
                            $this->CRUDModel->insert('practical_attendance_details',$attend_data);
                            endforeach;

                            foreach($checked as $row=>$value):
                            $attend_data = array
                            (
                                'attend_id'=>$attend_id,
                                'college_no'=>$value,
                                'status'=>1
                            );
                        $this->CRUDModel->insert('practical_attendance_details',$attend_data);
                        endforeach;
                        $this->session->set_flashdata('msg', 'Successfully Submitted.');
                        redirect('AttendanceController/admin_practical_attendance');    
                    else:
                    
                    $data  = array
                                (
                                    'prac_class_id' =>$prac_class_id,
                                    'attendance_date' =>$attendance_date,
                                    'user_id' =>$user_id
                                 );
            $attend_id = $this->CRUDModel->insert('practical_attendance',$data);
            
        foreach($all_students as $asrow):
            $asdata = array(
            'attend_id'=>$attend_id,
                'college_no'=>$asrow->college_no,
                'status'=>0
            );
            $this->CRUDModel->insert('practical_attendance_details',$asdata);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/admin_practical_attendance'); 
        endif;
            
        endif;
        endif;
        $this->data['page_title']   = 'Admin Students Practical Attendance | ECMS';
        $this->data['page']         = 'attendance/admin_practical_studentAtts';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_practical_attendance_history()
    {  
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['group_id'] = '';
            $this->data['subject_id'] = '';
            $this->data['attendance_date'] = '';
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $group_id             =  $this->input->post('group_id');
            $subject_id            =  $this->input->post('subject_id');
            $attendance_date            =  $this->input->post('attendance_date');
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =  $emp_id;
            endif;
            if(!empty($group_id)):
                $where['practical_group.prac_group_id'] = $group_id;
                $this->data['group_id'] = $group_id;
            endif;
            if(!empty($subject_id)):
                $where['practical_subject.prac_subject_id'] = $subject_id;
                $this->data['subject_id'] = $subject_id;
            endif;
            if(!empty($attendance_date)):
                $where['practical_attendance.attendance_date'] = $attendance_date;
                $this->data['attendance_date'] =$attendance_date;
            endif;
            $this->data['result'] = $this->AttendanceModel->admin_practical_attendance_history('practical_attendance',$where);
        else:
        $this->data['result']       = $this->AttendanceModel->get_adminpractical_attendance('practical_attendance');
        endif;
        $this->data['page_title']   = 'Admin Student Practical Attendance | ECMS';
        $this->data['page']         = 'attendance/admin_practical_attendance_history';
        $this->load->view('common/common',$this->data);
    }
    
        public function year_head_practical()
    {
    $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
    $this->data['subject']           = $this->CRUDModel->dropDown('practical_subject', 'Select Subject', 'prac_subject_id', 'title');
        
            $gender_id     = $this->input->post('gender_id');
            $prac_subject_id     = $this->input->post('prac_subject_id');
            $group_id     = $this->input->post('group_id');
            
            $like = '';
            $where = '';
            $this->data['gender_id'] = '';
            $this->data['prac_subject_id'] = '';
            $this->data['group_id'] = '';
        
        if($this->input->post('search')):
            $gender_id     = $this->input->post('gender_id');
            $prac_subject_id     = $this->input->post('prac_subject_id');
            $group_id     = $this->input->post('group_id');
        $this->data['group']  = $this->CRUDModel->get_where_row('practical_group',array('prac_group_id'=>$group_id));
        if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id'] =$gender_id;
            endif;
        if($prac_subject_id):
            $where['practical_subject.prac_subject_id'] = $prac_subject_id;
            $this->data['prac_subject_id'] = $prac_subject_id;
        endif;
        if($group_id):
            $where['practical_group.prac_group_id'] = $group_id;
            $this->data['prac_group_id'] = $group_id;
        endif;
            $this->data['result']       = $this->AttendanceModel->getpracticalstudents('practical_subject',$where);
        endif;
            
        $this->data['page_title']   = 'Year Head Practical Students| ECMS';
        $this->data['page']         = 'attendance/year_head_practical';
        $this->load->view('common/common',$this->data);
        
                if($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Students Practical Group');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Section');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Practical Group'); 
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                for($col = ord('A'); $col <= ord('E'); $col++)
                {
                    //set column dimension
                    $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                     //change the font size
                    $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                    $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                }
                $like = '';
                    $where = '';
                    $this->data['gender_id'] = '';
                    $this->data['prac_subject_id'] = '';
                    $this->data['group_id'] = '';
                    $gender_id     = $this->input->post('gender_id');
                    $prac_subject_id     = $this->input->post('prac_subject_id');
                    $group_id     = $this->input->post('group_id');
                    if(!empty($gender_id)):
                        $where['gender.gender_id'] = $gender_id;
                        $this->data['gender_id'] =$gender_id;
                    endif;
                    if($prac_subject_id):
                        $where['practical_subject.prac_subject_id'] = $prac_subject_id;
                        $this->data['prac_subject_id'] = $prac_subject_id;
                    endif;
                    if($group_id):
                        $where['practical_group.prac_group_id'] = $group_id;
                        $this->data['prac_group_id'] = $group_id;
                    endif;
                $this->db->select('
                sections.name,
                student_record.college_no,
                student_record.student_name,
                practical_group.group_name,
                gender.title as gender
                ');
                $this->db->from('practical_subject');
                $this->db->join('practical_group','practical_group.subject_id=practical_subject.prac_subject_id');
            $this->db->join('student_prac_group_allottment','student_prac_group_allottment.group_id=practical_group.prac_group_id');
            $this->db->join('student_record','student_record.student_id=student_prac_group_allottment.student_id');
            $this->db->join('gender','gender.gender_id=student_record.gender_id');
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
                $this->db->where($where);
                $this->db->order_by('practical_group.prac_group_id','asc');
                $rs =  $this->db->get();
                $exceldata="";
                foreach ($rs->result_array() as $row)
                {
                $exceldata[] = $row;
                }      
        
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='PracticalGroupList.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
                else:
                    $this->data['gender_id'] = '';
                    $this->data['prac_subject_id'] = '';
        endif;

    }
public function search_admin_test_history()
    {       
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id       =  $this->input->post('sec_id');
            $subject_id   =  $this->input->post('subject_id');
    
          
             $test_date    =  $this->input->post('year').'-'.$this->input->post('month');
            $this->data['month']           = $this->CRUDModel->dropDown('month', 'Month', 'mth_id', 'mth_title');
            $this->data['year']           = $this->CRUDModel->dropDown('year', 'Year', 'yr_id', 'yr_title');
            $this->data['current_month']    =  $this->input->post('month');
            $this->data['current_year']     =  $this->input->post('year');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            $this->data['test_date'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if(!empty($test_date)):
                $where['month(monthly_test.test_date)'] = $this->input->post('month');
                $where['year(monthly_test.test_date)'] = $this->input->post('year');
                  
            endif;
            $this->data['result'] = $this->AttendanceModel->admin_test_history('monthly_test',$where);
            $this->data['page_title']   = 'Admin Search Test History| ECMS';
            $this->data['page']         = 'attendance/search_admin_test_history';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function auto_emp_name()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->AttendanceModel->getemp_name('hr_emp_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['prepared_by']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('emp_name'=>$term);
            
            $result_set             = $this->AttendanceModel->getemp_name('hr_emp_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['prepared_by']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_pemp_name()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->AttendanceModel->getemp_name('hr_emp_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['authorized_by']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('emp_name'=>$term);
            
            $result_set             = $this->AttendanceModel->getemp_name('hr_emp_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['authorized_by']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_desg()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->CRUDModel->getResults('hr_emp_designation');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->emp_desg_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_desg_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('tit;e'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('hr_emp_designation',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->emp_desg_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_desg_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
public function auto_dept()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->CRUDModel->getResults('department');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->department_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['department_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('title'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('department',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->department_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['department_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
//    public function students_comulative_attendance()
//    {
//        $session    = $this->session->all_userdata();
//        $user_id    = $session['userData']['user_id'];
//       if($this->input->post('search')):
//            $emp_id       =  $this->input->post('emp_id');
//            $sec_id             =  $this->input->post('sec_id');
//            $subject_id            =  $this->input->post('subject_id');
//          
//            //like Array
//            $like = '';
//            $where = '';
//            $this->data['emp_id'] = '';
//            $this->data['sec_id'] = '';
//            $this->data['subject_id'] = '';
//            
//        
//            if(!empty($emp_id)):
//                $where['hr_emp_record.emp_id'] = $emp_id;
//                $this->data['emp_id'] =$emp_id;
//            endif;
//            if(!empty($sec_id)):
//                $where['sections.sec_id'] = $sec_id;
//                $this->data['sec_id'] =$sec_id;
//            endif;
//            if(!empty($subject_id)):
//                $where['subject.subject_id'] = $subject_id;
//                $this->data['subject_id'] =$subject_id;
//            endif;
//            $this->data['result'] = $this->AttendanceModel->admin_search_history('student_attendance',$where);
//            endif;
//        
//        if($this->input->post('search_submit')):
//            
//            $emp_id       =  $this->input->post('emp_id');
//            $sec_id             =  $this->input->post('sec_id');
//            $subject_id            =  $this->input->post('subject_id');
//            $end_date            =  $this->input->post('end_date');
//          
//            //like Array
//            $like = '';
//            $where = '';
//            $this->data['emp_id'] = '';
//            $this->data['sec_id'] = '';
//            $this->data['subject_id'] = '';
//            
//        
//            if(!empty($emp_id)):
//                $where['hr_emp_record.emp_id'] = $emp_id;
//                $this->data['emp_id'] =$emp_id;
//            endif;
//            if(!empty($sec_id)):
//                $where['sections.sec_id'] = $sec_id;
//                $this->data['sec_id'] =$sec_id;
//            endif;
//            if(!empty($subject_id)):
//                $where['subject.subject_id'] = $subject_id;
//                $this->data['subject_id'] =$subject_id;
//            endif;
//            $result = $this->AttendanceModel->admin_search_history('student_attendance',$where);
//           
//            $insert = array();  
//        foreach($result as $rec)  
//        {
//            $attend_id = $rec->attend_id;
//            $sec_id = $rec->sec_id;
//            $subject_id = $rec->subject_id;
//            $flag = $rec->flag;
//            $start_date = date('Y-m-d', strtotime($rec->timestamp));            
//            if($flag == 1):
//            $where = array('section_id'=>$sec_id); 
//            $this->db->select('*');
//            $this->db->from('student_group_allotment');
//            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
//            $this->db->where($where);
//            $qry = $this->db->get();
//            else:
//            $where = array('section_id'=>$sec_id,'subject_id'=>$subject_id);
//            $this->db->select('*');
//            $this->db->from('student_subject_alloted');
//            $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id', 'left outer');
//            $this->db->where($where);
//            $qry = $this->db->get();
//            endif;
//        }
//            $i = 1;
//            foreach($qry->result() as $row):
//            $where = array(
//            'student_id'=>$row->student_id,
//            'class_alloted.class_id'=>$rec->class_id,
//                            
//                        );
//            $this->db->select('*');
//            $this->db->from('class_alloted');
//            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
//    $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
//            $q = $this->db->where($where)->get()->result(); 
//            $a = '';            
//            $p = '';            
//            $l = '';            
//            foreach($q as $qrow):
//                       
//                if($qrow->status == 1):
//                    $p++;
//                endif;  
//            if($qrow->status == 0):
//                    $a++;
//                endif;  
//            if($qrow->status == 2):
//                    $l++;
//                endif;        
//            endforeach;  
//              $insert[] = array( 
//              'emp_id'=>$rec->emp_id,  
//              'sec_id'=>$sec_id,  
//              'subject_id'=>$subject_id,
//              'student_id'=>$row->student_id,        
//              'total_attend'=>count($result),        
//              'p_attend'=>$p,        
//              'a_attend'=>$a,
//              'l_attend'=>$l,
//              'start_date'=>$start_date,      
//              'end_date'=>date('Y-m-d', strtotime($end_date))      
//                  ); 
//              endforeach;
//              
//              
//              $result = json_decode(json_encode($insert),False);
//            // echo '<pre>';print_r($result);die;
//       foreach($result as $inserRow):
//           $emp_id =  $inserRow->emp_id;
//           $sec_id =  $inserRow->sec_id;
//           $subject_id =  $inserRow->subject_id;
//           $student_id = $inserRow->student_id;
//           $total_attend =  $inserRow->total_attend;
//           $p_attend =  $inserRow->p_attend;
//           $a_attend =  $inserRow->a_attend;
//           $l_attend =  $inserRow->l_attend;
//           $start_date =  $inserRow->start_date;
//           $end_date =  $inserRow->end_date;
//           $insert_dataxx = array
//                   (
//                   'emp_id'=>$emp_id,
//                   'sec_id'=>$sec_id,
//                   'subject_id'=>$subject_id,
//                   'student_id'=>$student_id,
//                   'total_attend'=>$total_attend,
//                   'p_attend'=>$p_attend,
//                   'a_attend'=>$a_attend,
//                   'l_attend'=>$l_attend,
//                    'start_date'=>$start_date,   
//                    'end_date'=>$end_date,   
//                   'user_id'=>$user_id       
//                   );
//        
//           $this->CRUDModel->insert('student_comulative_attendance',$insert_dataxx);  
//        
//       endforeach;
//        $class_id = $rec->class_id;
//        $where = array('student_attendance.class_id'=>$class_id);
//        $attend = $this->CRUDModel->get_where_result('student_attendance',$where);
//        foreach($attend as $rowAttend):
//            $attend_id = $rowAttend->attend_id;
//            $where1 = array('student_attendance_details.attend_id'=>$attend_id);
//            $this->CRUDModel->deleteid('student_attendance_details',$where1);
//        endforeach;
//               $this->CRUDModel->deleteid('student_attendance',array('class_id'=>$class_id));
//          endif;
//        
//        
//            $this->data['page_title']   = 'Students Comulative Attendance | ECMS';
//            $this->data['page']         = 'attendance/students_comulative_attendance';
//            $this->load->view('common/common',$this->data);    
//    }
//    
    
    
        public function students_comulative_attendance()
    {
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
       if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
          
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            
            $this->data['result'] = $this->AttendanceModel->admin_search_historyn('class_alloted',$where);
            endif;
        if($this->input->post('search_submit')):
            
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
            $end_date            =  $this->input->post('end_date');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $result = $this->AttendanceModel->admin_search_historyn('class_alloted',$where);
            $insert = array(); 
        foreach($result as $rec)  
        {
            $sec_id = $rec->sec_id;  
            $subject_id = $rec->subject_id;  
            $sub_pro_id = $rec->sub_pro_id;  
            $flag = $rec->flag;
            $start_date = date('Y-m-d', strtotime($rec->timestamp));
            if($flag == 1):
                $where = array('section_id'=>$sec_id);
                $this->db->select('*');
                $this->db->from('student_group_allotment');
                $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
                $this->db->where($where);
                $this->db->where('student_record.s_status_id','5');
                $qry = $this->db->get();
            else:
            $where = array('section_id'=>$sec_id,'subject_id'=>$subject_id);
            $this->db->select('*');
            $this->db->from('student_subject_alloted');
            $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id', 'left outer');
            $this->db->where($where);
            $this->db->where('student_record.s_status_id','5');
            $qry = $this->db->get();
            endif;
        
        
            $i = 1;
            foreach($qry->result() as $row):
            $where = array(
                'student_id'=>$row->student_id,
                'class_alloted.class_id'=>$rec->class_id,
                        );
            $this->db->select('*');
            $this->db->from('class_alloted');
            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
            $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
            $q = $this->db->where($where)->get()->result(); 
            $a = '';            
            $p = '';            
            $l = '';  
            
            foreach($q as $qrow):
                if($qrow->status == 1):
                    $p++;
                endif;  
                if($qrow->status == 0):
                        $a++;
                    endif;  
                if($qrow->status == 2):
                        $l++;
                    endif;        
            endforeach;  
              $insert[] = array( 
              'emp_id'=>$rec->emp_id,  
              'sec_id'=>$sec_id,    
              'subject_id'=>$subject_id,
              'sub_pro_id'=>$sub_pro_id,
              'student_id'=>$row->student_id,        
              'total_attend'=>count($q),        
              'p_attend'=>$p,        
              'a_attend'=>$a,
              'l_attend'=>$l,
              'start_date'=>$start_date,      
              'end_date'=>date('Y-m-d', strtotime($end_date))      
                  ); 
              endforeach;
        }
        
        $result = json_decode(json_encode($insert),False);
       foreach($result as $inserRow):
           $emp_id =  $inserRow->emp_id;
           $sec_id =  $inserRow->sec_id;
           $subject_id =  $inserRow->subject_id;
           $sub_pro_id =  $inserRow->sub_pro_id;
           $student_id = $inserRow->student_id;
           $total_attend =  $inserRow->total_attend;
           $p_attend =  $inserRow->p_attend;
           $a_attend =  $inserRow->a_attend;
           $l_attend =  $inserRow->l_attend;
           $start_date =  $inserRow->start_date;
           $end_date =  $inserRow->end_date;
           $insert_dataxx = array
                   (
                   'emp_id'=>$emp_id,
                   'sec_id'=>$sec_id,
                   'subject_id'=>$subject_id,
                   'sub_pro_id'=>$sub_pro_id,
                   'student_id'=>$student_id,
                   'total_attend'=>$total_attend,
                   'p_attend'=>$p_attend,
                   'a_attend'=>$a_attend,
                   'l_attend'=>$l_attend,
                    'start_date'=>$start_date,   
                    'end_date'=>$end_date,   
                   'user_id'=>$user_id       
                   );
        $this->CRUDModel->insert('student_comulative_attendance',$insert_dataxx); 
        endforeach;
        $where = array('class_alloted.sec_id'=>$sec_id);
        $this->db->select('class_alloted.*,student_attendance.*');
        $this->db->from('class_alloted');
        $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
        $attend = $this->db->where($where)->get()->result();
        foreach($attend as $rowAttend):
            $attend_id = $rowAttend->attend_id;
            $class_id = $rowAttend->class_id;
            $where1 = array('student_attendance_details.attend_id'=>$attend_id);
            $this->CRUDModel->deleteid('student_attendance_details',$where1);
        endforeach;
        $this->CRUDModel->deleteid('student_attendance',array('class_id'=>$class_id));
        endif;
        $this->data['page_title']   = 'Students Comulative Attendance | ECMS';
        $this->data['page']         = 'attendance/students_comulative_attendance';
        $this->load->view('common/common',$this->data);    
    }
    
    
   public function students_comulative_practical_attendance()
    {
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
       if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $group_id             =  $this->input->post('group_id');
            $subject_id            =  $this->input->post('subject_id');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['group_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($group_id)):
                $where['practical_group.prac_group_id'] = $group_id;
                $this->data['group_id'] =$group_id;
            endif;
            if(!empty($subject_id)):
                $where['practical_subject.prac_subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $this->data['result'] = $this->AttendanceModel->practical_history_comulative('practical_alloted',$where);
            endif;
        
        if($this->input->post('search_submit')):
            
            $emp_id       =  $this->input->post('emp_id');
            $group_id             =  $this->input->post('group_id');
            $subject_id            =  $this->input->post('subject_id');
            $end_date            =  $this->input->post('end_date');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['group_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($group_id)):
                $where['practical_group.prac_group_id'] = $group_id;
                $this->data['group_id'] =$group_id;
            endif;
            if(!empty($subject_id)):
                $where['practical_subject.prac_subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $result = $this->AttendanceModel->practical_history_comulative('practical_alloted',$where);
           
            $insert = array();  
        foreach($result as $rec)  
        {
            $class_id = $rec->class_id;
            $sec_id = $rec->sec_id;
            $subject_id = $rec->subject_id;
            $where = array('group_id'=>$sec_id);
            $this->db->select('*');
            $this->db->from('student_prac_group_allottment');
            $this->db->join('student_record','student_record.college_no=student_prac_group_allottment.college_no', 'left outer');
            $this->db->where($where);
            $this->db->where('student_record.s_status_id','5');
            $qry = $this->db->get();
        
            $i = 1;
            foreach($qry->result() as $row):
            $where = array(
            'college_no'=>$row->college_no,
            'practical_alloted.practical_class_id'=>$rec->class_id      
                        );
            $this->db->select('*');
            $this->db->from('practical_alloted');
    $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
    $this->db->join('practical_attendance_details','practical_attendance_details.attend_id=practical_attendance.attend_id');
            $q = $this->db->where($where)->get()->result(); 
            $a = '';            
            $p = '';            
            foreach($q as $qrow):       
                if($qrow->status == 1):
                    $p++;
                endif;  
            if($qrow->status == 0):
                    $a++;
                endif;        
            endforeach;  
              $insert[] = array( 
              'emp_id'=>$rec->emp_id,  
              'sec_id'=>$sec_id,  
              'subject_id'=>$subject_id,
              'student_id'=>$row->student_id,        
              'college_no'=>$row->college_no,        
              'total_attend'=>count($q),        
              'p_attend'=>$p,        
              'a_attend'=>$a,
              'start_date'=>date('Y-m-d', strtotime($end_date))   
                  ); 
              endforeach;
        }
       $result = json_decode(json_encode($insert),False);
       foreach($result as $inserRow):
           $emp_id =  $inserRow->emp_id;
           $sec_id =  $inserRow->sec_id;
           $subject_id =  $inserRow->subject_id;
           $student_id = $inserRow->student_id;
           $college_no = $inserRow->college_no;
           $total_attend =  $inserRow->total_attend;
           $p_attend =  $inserRow->p_attend;
           $a_attend =  $inserRow->a_attend;
           $start_date =  $inserRow->start_date;
           $insert_dataxx = array
           (
           'emp_id'=>$emp_id,
           'sec_id'=>$sec_id,
           'subject_id'=>$subject_id,
           'student_id'=>$student_id,
           'college_no'=>$college_no,
           'total_attend'=>$total_attend,
           'p_attend'=>$p_attend,
           'a_attend'=>$a_attend,
            'start_date'=>$start_date, 
           'user_id'=>$user_id       
           );
    $this->CRUDModel->insert('student_comulative_practical_attendance',$insert_dataxx);  
       endforeach;
        $where = array('practical_alloted.group_id'=>$sec_id);
        $this->db->select('practical_alloted.*,practical_attendance.*');
        $this->db->from('practical_alloted');
        $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
        $attend = $this->db->where($where)->get()->result();
        foreach($attend as $rowAttend):
            $attend_id = $rowAttend->attend_id;
            $class_id = $rowAttend->prac_class_id;
            $where1 = array('practical_attendance_details.attend_id'=>$attend_id);
            $this->CRUDModel->deleteid('practical_attendance_details',$where1);
        endforeach;
        $this->CRUDModel->deleteid('practical_attendance',array('prac_class_id'=>$class_id));
        
        $this->CRUDModel->deleteid('practical_alloted',array('practical_alloted.group_id'=>$sec_id));
        
     endif;
    $this->data['page_title']   = 'Students Comulative Practical Attendance | ECMS';
    $this->data['page']         = 'attendance/students_comulative_practical_attendance';
    $this->load->view('common/common',$this->data);
    }
    public function teacher_base_subject_allotted_report()
    {          
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
    
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
        $this->data['result'] = $this->AttendanceModel->teacher_base_subject_allotted('class_alloted',$where);
        endif;
        
        if($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Teacher Base Subject');
               
                $this->excel->getActiveSheet()->setCellValue('A1', 'Employee Name');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('B1', 'Program Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('C1', 'Sub Program Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('D1', 'Section Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1', 'Subject Name');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
        
         for($col = ord('A'); $col <= ord('E'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
    
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
        $result = $this->AttendanceModel->teacher_base_subject_excel('class_alloted',$where);
                
                $exceldata="";
                foreach ($result as $row)
                {
                $exceldata[] = $row;
                }      
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='teacher_base_subject_allotted_report.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
        
        $this->data['page_title']   = 'Teacher Base Subject Allotted Report | ECMS';
        $this->data['page']         = 'attendance/teacher_base_subject_allotted_report';
        $this->load->view('common/common',$this->data);
    }
    
//    public function student_attendance_history()
//    {          
//        if($this->input->post('search')):
//            $student_id       =  $this->input->post('student_id');
//            $sec_id             =  $this->input->post('sec_id');
//            $subject_id            =  $this->input->post('subject_id');
//    
//            $like = '';
//            $where = '';
//            $this->data['student_id'] = '';
//            $this->data['sec_id'] = '';
//            $this->data['subject_id'] = '';
//            
//        
//            if(!empty($student_id)):
//                $where['student_record.student_id'] = $student_id;
//                $this->data['student_id'] =$student_id;
//            endif;
//            if(!empty($sec_id)):
//                $where['sections.sec_id'] = $sec_id;
//                $this->data['sec_id'] =$sec_id;
//            endif;
//            if(!empty($subject_id)):
//                $where['subject.subject_id'] = $subject_id;
//                $this->data['subject_id'] =$subject_id;
//            endif;
//        $this->data['result'] = $this->AttendanceModel->student_attend_history('student_comulative_attendance',$where);
//        endif;        
//        if($this->input->post('export')):    
//                $this->load->library('excel');
//                $this->excel->setActiveSheetIndex(0);
//                $this->excel->getActiveSheet()->setTitle('Teacher Base Subject');
//               
//                $this->excel->getActiveSheet()->setCellValue('A1', 'Student Name');
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('B1', 'Program Name');
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('C1', 'Sub Program Name');
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('D1', 'Section Name');
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('E1', 'Subject Name');
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('F1', 'Total Attendance');
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('G1', 'Present');
//                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('H1', 'Absent');
//                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
//        
//         for($col = ord('A'); $col <= ord('H'); $col++){
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
//                  
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//        }
//        
//           $student_id       =  $this->input->post('student_id');
//            $sec_id             =  $this->input->post('sec_id');
//            $subject_id            =  $this->input->post('subject_id');
//    
//            $like = '';
//            $where = '';
//            $this->data['student_id'] = '';
//            $this->data['sec_id'] = '';
//            $this->data['subject_id'] = '';
//            
//        
//            if(!empty($student_id)):
//                $where['student_record.student_id'] = $student_id;
//                $this->data['student_id'] =$student_id;
//            endif;
//            if(!empty($sec_id)):
//                $where['sections.sec_id'] = $sec_id;
//                $this->data['sec_id'] =$sec_id;
//            endif;
//            if(!empty($subject_id)):
//                $where['subject.subject_id'] = $subject_id;
//                $this->data['subject_id'] =$subject_id;
//            endif;
//        $result = $this->AttendanceModel->student_attend_history_excel('student_comulative_attendance',$where);
//                
//                $exceldata="";
//                foreach ($result as $row)
//                {
//                $exceldata[] = $row;
//                }      
//                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
//                $filename='student_attend_history.xls'; 
//                header('Content-Type: application/vnd.ms-excel');
//                header('Content-Disposition: attachment;filename="'.$filename.'"');
//                header('Cache-Control: max-age=0'); 
//                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//                $objWriter->save('php://output');
//        endif;
//        $this->data['page_title']   = 'Student Attendance History | ECMS';
//        $this->data['page']         = 'attendance/student_attendance_history';
//        $this->load->view('common/common',$this->data);
//    }
    
    public function student_attendance_history()
    {          
        if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $where1['student_comulative_attendance.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            
        $this->data['std'] = $this->AttendanceModel->student_Datainfo('student_record',$where);
        $this->data['sub_program'] = $this->AttendanceModel->student_subProgram('student_comulative_attendance',$where1);
        endif;        
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'attendance/student_attendance_history';
        $this->load->view('common/common',$this->data);
    }
    
    public function student_group_practical_inter()
    {
		$like = '';
        $where = '';
        $this->data['college_no'] = "";
        $this->data['student_name'] = "";
        $this->data['group_id'] = "";
		if($this->input->post('search')):
			$college_no   =  $this->input->post('college_no');
            $student_name =  $this->input->post('student_name');
            $group_id =  $this->input->post('group_id');
        
			if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($group_id)):
                $where['group_id'] = $group_id;
                $this->data['group_id'] =$group_id;
            endif;
           $this->data['result'] = $this->AttendanceModel->get_practicalData($where,$like);
		 endif;
        if($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Teacher Base Subject');
               
                $this->excel->getActiveSheet()->setCellValue('A1', 'College #');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('C1', 'Group Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
        
         for($col = ord('A'); $col <= ord('C'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
            $student_id       =  $this->input->post('student_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
    
            $like = '';
            $where = '';
            $this->data['college_no'] = "";
            $this->data['student_name'] = "";
            $this->data['group_id'] = "";
        
			$college_no   =  $this->input->post('college_no');
            $student_name =  $this->input->post('student_name');
            $group_id =  $this->input->post('group_id');
        
			if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($group_id)):
                $where['group_id'] = $group_id;
                $this->data['group_id'] =$group_id;
            endif;
        $result = $this->AttendanceModel->get_practicalData_excel($where,$like);
                
                $exceldata="";
                foreach ($result as $row)
                {
                $exceldata[] = $row;
                }      
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='student_Practical_group.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
		$this->data['page']     =   "attendance/student_group_practical_inter";
		$this->data['title']    =   'Students Practical Group Inter Level| ECMS';
		$this->load->view('common/common',$this->data);        
       
    }
    
    public function delete_prac_group()
    {	    
        $id    = $this->uri->segment(3);
        $where = array('serial_no'=>$id);
        $this->CRUDModel->deleteid('student_prac_group_allottment',$where);
        redirect('AttendanceController/student_group_practical_inter');
	}
    
    public function add_prac_group()
    {   
        if($this->input->post()):
            $college_no      = $this->input->post('college_no');
            $student_name      = $this->input->post('student_name');
            $group_id      = $this->input->post('group_id');
            $checked = array
            (
               'college_no' =>$college_no
            );
        $qry = $this->CRUDModel->get_where_row('student_prac_group_allottment',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! This College Number Already Exist');
        redirect('AttendanceController/add_prac_group');       
        else:
            $data       = array(
                'college_no' =>$college_no,
                'student_name' =>$student_name,
                'group_id' =>$group_id
            );
            $this->CRUDModel->insert('student_prac_group_allottment',$data);
            redirect('AttendanceController/student_group_practical_inter');
        endif;
        endif;
        $this->data['page_title']  = 'Add Student Group | ECMS';
        $this->data['page']        =  'attendance/add_student_group_practical';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_prac_group($id)
    {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $college_no      = $this->input->post('college_no');
            $student_name      = $this->input->post('student_name');
            $group_id      = $this->input->post('group_id');
            $data       = array(
                'college_no' =>$college_no,
                'student_name' =>$student_name,
                'group_id' =>$group_id
            );
            $where = array('student_prac_group_allottment.serial_no'=>$id);
            $this->CRUDModel->update('student_prac_group_allottment',$data,$where);
            $this->data['page_title']   = 'Update Student Group | ECMS';
            redirect('AttendanceController/student_group_practical_inter');
        endif;
        if($id):
                $where = array('student_prac_group_allottment.serial_no'=>$id);
                $this->data['result'] = $this->AttendanceModel->get_PracDataRow($where);
                $this->data['page_title']  = 'Update Student Group | ECMS';
                $this->data['page']        =  'attendance/update_student_group_practical';
                $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function auto_section_comulative()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('sections');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->sec_id
                );  
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['sec_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like = array('name'=>$term);
            
            $result_set             = $this->CRUDModel->getResults('sections',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->name,
                  'label'=>$row_set->name,
                  'id'=>$row_set->sec_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['sec_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function degree_student_attendance_history()
    {          
        if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
    
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
        
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
        $this->data['result'] = $this->AttendanceModel->degree_student_attend_history('student_comulative_attendance',$where);
        endif;        
        if($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Teacher Base Subject');
               
                $this->excel->getActiveSheet()->setCellValue('A1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('B1', 'Program Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('C1', 'Sub Program Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('D1', 'Section Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1', 'Subject Name');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('F1', 'Total Attendance');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1', 'Present');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('H1', 'Absent');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
        
         for($col = ord('A'); $col <= ord('H'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
           $student_id       =  $this->input->post('student_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
    
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
        $result = $this->AttendanceModel->degree_student_attend_history_excel('student_comulative_attendance',$where);
                
                $exceldata="";
                foreach ($result as $row)
                {
                $exceldata[] = $row;
                }      
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='student_attend_history.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
        $this->data['page_title']   = 'Degree Student Attendance History | ECMS';
        $this->data['page']         = 'attendance/degree_student_attendance_history';
        $this->load->view('common/common',$this->data);
    }
    
    public function practical_White_card_inter()
    {
		$like = '';
        $where = '';
        $this->data['college_no'] = "";
        $this->data['student_name'] = "";
        $this->data['group_id'] = "";
		if($this->input->post('search')):
			$college_no   =  $this->input->post('college_no');
            $student_name =  $this->input->post('student_name');
            $group_id =  $this->input->post('group_id');
			if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($group_id)):
                $where['group_id'] = $group_id;
                $this->data['group_id'] =$group_id;
            endif;
           $this->data['result'] = $this->AttendanceModel->get_practicalData($where,$like);
		 endif;
		$this->data['page']     =   "attendance/practical_White_card_inter";
		$this->data['title']    =   'Students Practical White Card Inter| ECMS';
		$this->load->view('common/common',$this->data);         
    }
    
    public function practical_attendance_white_card(){
            
            $college_no = $this->uri->segment(3);
            $group_id = $this->uri->segment(4);
            
            $this->data['result']           = $this->AttendanceModel->get_whiteCard_practical(array('student_prac_group_allottment.college_no'=>$college_no,'student_prac_group_allottment.group_id'=>$group_id)); 
             
            $this->data['program']          = 'Practical White card';
            $this->data['page_title']       = 'Student Practical white card | ECMS';
            $this->data['page']             =  'attendance/whiteCardPractical';
            $this->load->view('common/common',$this->data); 
        }
    
    public function update_test_marks_list()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('monthly_test_details.test_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        $this->data['count']       = $this->AttendanceModel->view_test_marks_list('monthly_test_details',$where);
        
        if($this->input->post('update')):
            
            $test_id = $this->input->post('test_id');
            $student_id = $this->input->post('student_id');
            $tmarks     = $this->input->post('tmarks');
            $omarks     = $this->input->post('omarks');
           
            $where = array('monthly_test_details.test_id'=>$test_id);
            $this->CRUDModel->deleteid('monthly_test_details',$where);
            $combine = array_combine($student_id, $omarks);
            foreach($combine as $key=>$row):
            $test_data = array
            (
                'test_id'=>$test_id,
                'student_id'=>$key,
                'tmarks'=>$tmarks,
                'omarks'=>$row
            );           
            $this->CRUDModel->insert('monthly_test_details',$test_data);
            endforeach;
        $this->session->set_flashdata('msg', 'Monthly Test Successfully Updated.');
        redirect('AttendanceController/monthly_test_history');    
        endif;
        $this->data['page_title']   = 'Update Student Test Marks List | ECMS';
        $this->data['page']         = 'attendance/update_test_marks_list';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_practical_alloted($id)
    {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $emp_id      = $this->input->post('emp_id');
            $group_id      = $this->input->post('group_id');
            $subject_id      = $this->input->post('subject_id');
            $data       = array(
                'emp_id' =>$emp_id,
                'group_id' =>$group_id,
                'subject_id' =>$subject_id
            );
            $where = array('practical_class_id'=>$id);
            $this->CRUDModel->update('practical_alloted',$data, $where);
            redirect('AttendanceController/practical_alloted');
        endif;
        if($id):
        $where = array('practical_alloted.practical_class_id'=>$id);
        $where_p = array('practical_timetable.practical_class_id'=>$id);
        $this->data['result'] = $this->AttendanceModel->getprac_class_byid('practical_alloted',$where);
        $this->data['ptable'] = $this->AttendanceModel->getclassPracTimeTable('practical_timetable',$where_p);
        $this->data['page_title']        = 'Update Practical Alloted Record | ECMS';
        $this->data['page']        =  'attendance/update_practical_alloted';
        $this->load->view('common/common',$this->data);
            endif;
    }
    
       public function change_practical_attendance()
    {       
        $id = $this->uri->segment(3);
        
        $q = $this->CRUDModel->get_where_row('practical_attendance',array('attend_id'=>$id)); 
        $qry = $this->CRUDModel->get_where_row('practical_alloted',array('practical_class_id'=>$q->prac_class_id));
        $emp_id = $qry->emp_id;
        $subject_id = $qry->subject_id;
        $group_id = $qry->group_id;
        $where = array('practical_attendance_details.attend_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('practical_subject',array('prac_subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('practical_group',array('prac_group_id'=>$group_id));
        $this->data['attend'] = $this->CRUDModel->get_where_row('practical_attendance',array('attend_id'=>$id));

        $this->data['result'] = $this->AttendanceModel->view_change_prac_attendance('practical_attendance_details',$where);
        $wherePrsent = array('practical_attendance_details.attend_id'=>$id,'status'=>1);
        $whereAbsent = array('practical_attendance_details.attend_id'=>$id,'status'=>0);
        $this->data['present']       = count($this->AttendanceModel->view_prac_attendance('practical_attendance_details',$wherePrsent));
        $this->data['Absent']       = count($this->AttendanceModel->view_prac_attendance('practical_attendance_details',$whereAbsent));
        $this->data['count'] = $this->AttendanceModel->view_prac_attendance('practical_attendance_details',$where);
        $this->data['page_title']   = 'Change Student Attendance | ECMS';
        $this->data['page']         = 'attendance/change_practical_attendance';
        $this->load->view('common/common',$this->data);
    }

 public function update_practical_studentsAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $prac_class_id = $this->uri->segment(3);
        $group_id = $this->uri->segment(4);
        $where      = array('student_prac_group_allottment.group_id'=>$group_id);
        $this->data['result'] = $this->AttendanceModel->prac_studentsAtts('student_prac_group_allottment',$where);
        $this->data['secclass'] = $this->AttendanceModel->getallotedgroups('practical_alloted');
        if($this->input->post()):
        $attend_id     = $this->input->post('attend_id');
        $group_id     = $this->input->post('group_id');
        $checked = $this->input->post('checked');
        $where1 = array('attend_id'=>$attend_id);
        $this->CRUDModel->deleteid('practical_attendance_details',$where1);
        $where = array('student_prac_group_allottment.group_id'=>$group_id);
        $all_students = $this->AttendanceModel->prac_studentsAtts('student_prac_group_allottment',$where);  
       // echo '<pre>';print_r($all_students);die;
        if(!empty($checked)):                
            $allStd = array();
            $sn = 0;
            foreach($all_students as $row)
            {
                $allStd[$sn] = $row->college_no;
                    $sn++;
            }
            $diff = array_diff($allStd,$checked);
            foreach($diff as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'college_no'=>$value,
                'status'=>0
            );
            $this->CRUDModel->insert('practical_attendance_details',$attend_data);
            endforeach;
            foreach($checked as $row=>$value):
            $attend_data = array
            (
                'attend_id'=>$attend_id,
                'college_no'=>$value,
                'status'=>1
            );
        $this->CRUDModel->insert('practical_attendance_details',$attend_data);
        endforeach;
        $this->session->set_flashdata('msg', 'Successfully Submitted.');
        redirect('AttendanceController/student_upd_prac_attendance');    
         else:
        foreach($all_students as $asrow):
            $asdata = array(
            'attend_id'=>$attend_id,
                'college_no'=>$asrow->college_no,
                'status'=>0
            );
            $this->CRUDModel->insert('practical_attendance_details',$asdata);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/student_upd_prac_attendance');    
        endif;
        endif;
        $this->data['page_title']   = 'Update Practical Attendance | ECMS';
        $this->data['page']         = 'attendance/change_practical_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function teacher_update_prac_attendance()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
        $data = array(
            'status'=>$this->input->post('status')
        );
          $where = array('serial_no'=>$id);
          $this->CRUDModel->update('practical_attendance_details',$data,$where);
          redirect('AttendanceController/student_upd_prac_attendance'); 
          endif;
        if($id):
            $where = array('practical_attendance_details.serial_no'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('practical_attendance_details',$where);
            $this->data['page_title']        = 'Teacher Update Student Attendance | ECMS';
            $this->data['page']        =  'attendance/teacher_update_practical_attendance';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function student_upd_prac_attendance()
    {       
        $session = $this->session->all_userdata();
        $emp_id =$session['userData']['emp_id'];
        $where = array('practical_alloted.emp_id'=>$emp_id);
        $this->data['result'] = $this->AttendanceModel->getpracticalchange_attendance('practical_attendance',$where);
        $this->data['page_title']   = 'Update Student Practical Attendance | ECMS';
        $this->data['page']         = 'attendance/students_update_practical_attendance';
        $this->load->view('common/common',$this->data);
    }

public function teacher_monthly_attendance_history_report(){
 
            $uri2 = $this->uri->segment(2);
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $uri5 = $this->uri->segment(5);
            
            if($this->input->post()):
                $monthNum  =  $this->input->post('month');
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('F'); // March
                $this->data['month_name']       =  $monthName;
                
                $this->data['current_month']    =  $this->input->post('month');
                $this->data['current_year']     =  $this->input->post('year');
                
            else:
                $this->data['current_month']    =  date("m",strtotime(date('d-m-y')));
                $this->data['month_name']       =  date("F",strtotime(date('d-m-y')));
                $this->data['current_year']     =  date("Y",strtotime(date('d-m-Y')));  
            endif;
                $this->data['month']            = $this->CRUDModel->dropDown('month', 'Month', 'mth_id', 'mth_title');
                $this->data['year']             = $this->CRUDModel->dropDown('year', 'Year', 'yr_id', 'yr_title');
                
                $this->data['empyee_name']      = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$uri4));
                $this->data['sections']         = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$uri2));
                $this->data['subject']          = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$uri3));
            if($uri5==1):
                $where = array(
                    'sec_id'=>$uri2 
                );
                $this->data['result'] = $this->AttendanceModel->get_teacher_subjects_student_degree_section($where);
            else:
                $where = array(
                     'student_subject_alloted.section_id'=>$uri2,
                     'student_subject_alloted.subject_id'=>$uri3
                    );
              $this->data['result'] = $this->AttendanceModel->get_teacher_subjects_student_degree_subjects($where);
            endif;
            $this->data['page_title']       = 'Teacher Monthly Attendance Report | ECMS';
            $this->data['page']             =  'attendance/TMAR';
            $this->load->view('common/common',$this->data); 
        }

public function teacher_monthly_attendance_report(){
            $session = $this->session->all_userdata();
            $user_id =$session['userData']['user_id'];
            $emp_id =$session['userData']['emp_id'];
            $where = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'1');
            $subwhere = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'2');
            $this->data['result'] = $this->AttendanceModel->get_alloted_sections('class_alloted',$where);
            $this->data['subjectbase'] = $this->AttendanceModel->get_alloted_subjects('class_alloted',$subwhere);
        
            $this->data['page_title']       = 'Teacher Monthly Attendance Report | ECMS';
            $this->data['page']             =  'attendance/teacher_monthly_attendance_report';
            $this->load->view('common/common',$this->data); 
        }

public function practical_monthly_attendance()
    {
		$like = '';
        $where = '';
        $this->data['college_no'] = "";
        $this->data['student_name'] = "";
        $this->data['group_id'] = "";
		if($this->input->post('search')):
			$college_no   =  $this->input->post('college_no');
            $student_name =  $this->input->post('student_name');
            $group_id =  $this->input->post('group_id');
			if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($group_id)):
                $where['group_id'] = $group_id;
                $this->data['group_id'] =$group_id;
            endif;
           $this->data['group'] = $this->AttendanceModel->getpractical_alloted('practical_alloted',$where);
           $this->data['result'] = $this->AttendanceModel->get_practicalData($where,$like);
		 endif;
		$this->data['page']     =   "attendance/practical_monthly_attendance";
		$this->data['title']    =   'Students Practical Monthly Attendance | ECMS';
		$this->load->view('common/common',$this->data);        
    }
    
    public function law_attendance_history()
    {       
        $this->data['result']       = $this->AttendanceModel->law_student_attendance('student_attendance');
        $this->data['page_title']   = 'Student Attendance | ECMS';
        $this->data['page']         = 'attendance/law_students_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function law_view_attendance()
    {       
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('student_attendance_details.attend_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
$this->data['result']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $wherePrsent = array('student_attendance_details.attend_id'=>$id,'status'=>1);
        $whereAbsent = array('student_attendance_details.attend_id'=>$id,'status'=>0);
        $whereLeave = array('student_attendance_details.attend_id'=>$id,'status'=>2);
        $this->data['present']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$wherePrsent));
        $this->data['Absent']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereAbsent));
        $this->data['Leave']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereLeave));
        
        $this->data['count']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $this->data['page_title']   = 'HOD View Student Attendance | ECMS';
        $this->data['page']         = 'attendance/law_view_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_law_students_attendance()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $data = array
                (
                  'status'=>$this->input->post('status')
                );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('student_attendance_details',$data,$where);
              redirect('AttendanceController/law_attendance_history'); 
              endif;
            if($id):
                $where = array('student_attendance_details.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('student_attendance_details',$where);

                $this->data['page_title']        = 'Update Law Student Attendance | ECMS';
                $this->data['page']        =  'attendance/update_law_students_attendance';
                $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function pre_board_test()
    {       
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        $emp_id     = $session['userData']['emp_id'];
        $where      = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'1');
        $subwhere   = array('class_alloted.emp_id'=>$emp_id, 'class_alloted.flag'=>'2');
        
        $this->data['result']       = $this->AttendanceModel->get_alloted_sections('class_alloted',$where);
        $this->data['subjectbase']  = $this->AttendanceModel->get_alloted_subjects('class_alloted',$subwhere);
        
        $this->data['page_title']   = 'Pre Board Test | ECMS';
        $this->data['page']         = 'attendance/pre_board_test';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_pre_board_test()
    {       
        $this->data['page_title']   = 'Admin Pre Board Test | ECMS';
        $this->data['page']         = 'attendance/admin_pre_board_test';
        $this->load->view('common/common',$this->data);
    }
    
    public function admin_sectionbase_preboard()
    {       
        $session        = $this->session->all_userdata();
        $user_id        = $session['userData']['user_id'];
        $class_id       = $this->uri->segment(3);
        $sec_id         = $this->uri->segment(4);
        $where          = array('student_group_allotment.section_id'=>$sec_id);
        $this->data['result']   = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
        $this->data['secclass'] = $this->AttendanceModel->getallotedsections('class_alloted');
        
        if($this->input->post()):
            $class_id   = $this->input->post('class_id');
            $sec_id     = $this->input->post('sec_id');
            $sub_pro_id = $this->input->post('sub_pro_id');
            $test_date  = $this->input->post('test_date');
            $student_id = $this->input->post('student_id');
            $tmarks     = $this->input->post('tmarks');
            $omarks     = $this->input->post('omarks');
            
            $data  = array(
                'class_id'  =>$class_id,
                'sub_pro_id' =>$sub_pro_id,
                'test_date' =>$test_date,
                'user_id'   =>$user_id
                );
            $test_id        = $this->CRUDModel->insert('pre_board_test',$data);
            $combine        = array_combine($student_id,$omarks);
            foreach($combine as $key=>$row):
                $test_data  = array(
                'test_id'   =>$test_id,
                'student_id'=>$key,
                'tmarks'    =>$tmarks,
                'omarks'    =>$row
                );
                $this->CRUDModel->insert('pre_board_test_details',$test_data);
                endforeach;
            $this->session->set_flashdata('msg', 'Pre Board Test Successfully Submitted.');
            redirect('AttendanceController/admin_pre_board_test');    
            
        endif;
        $this->data['page_title']   = 'Admin Pre Board Test | ECMS';
        $this->data['page']         = 'attendance/admin_sectionbase_preboard';
        $this->load->view('common/common',$this->data);
    }
    
   public function admin_subjectbase_preboard()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $class_id = $this->uri->segment(3);
        $sec_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $where = array('student_subject_alloted.subject_id'=>$subject_id,'student_subject_alloted.section_id'=>$sec_id);
        $this->data['result'] = $this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where);
        if($this->input->post()):
        $class_id   = $this->input->post('class_id');
        $sec_id     = $this->input->post('sec_id');
        $sub_pro_id = $this->input->post('sub_pro_id');
        $test_date = $this->input->post('test_date');
        $student_id = $this->input->post('student_id');
        $tmarks = $this->input->post('tmarks');
        $omarks = $this->input->post('omarks');
            
        $data  = array
         (
             'class_id' =>$class_id,
             'sub_pro_id' =>$sub_pro_id,
             'test_date' =>$test_date,
             'user_id' =>$user_id
          );
            $test_id = $this->CRUDModel->insert('pre_board_test',$data);


             $combine = array_combine($student_id, $omarks);

            foreach($combine as $key=>$row):

                $test_data = array
                (
                    'test_id'=>$test_id,
                    'student_id'=>$key,
                    'tmarks'=>$tmarks,
                    'omarks'=>$row
                );
                $this->CRUDModel->insert('pre_board_test_details',$test_data);
            endforeach;

            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/admin_pre_board_test'); 
        endif;
        $this->data['page_title']   = 'Admin Subject Base Test | ECMS';
        $this->data['page']         = 'attendance/admin_subjectbase_preboard';
        $this->load->view('common/common',$this->data);
    }
    
    public function search_pre_board_test()
    {       
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $sec_id             =  $this->input->post('sec_id');
            $subject_id            =  $this->input->post('subject_id');
          
            $like = '';
            $where = '';
            $this->data['emp_id'] = '';
            $this->data['sec_id'] = '';
            $this->data['subject_id'] = '';
            
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if(!empty($emp_id)):
                $where2['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($sec_id)):
                $where2['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($subject_id)):
                $where2['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            $where['class_alloted.flag']='1';
            $where2['class_alloted.flag']='2';
            $this->data['result'] = $this->AttendanceModel->admin_getsections_list('class_alloted',$where);
            $this->data['subjectbase'] = $this->AttendanceModel->get_alloted_subjectss('class_alloted',$where2);
            $this->data['page_title']   = 'Admin Pre Board Test| ECMS';
            $this->data['page']         = 'attendance/search_pre_board_test';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function hod_monthly_test_report()
    {       
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $where = '';
            $this->data['emp_id'] = '';
            
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            $this->data['result'] = $this->AttendanceModel->hod_test_history('monthly_test',$where);
            endif;
        $this->data['page_title']   = 'Hod Monthly Test History | ECMS';
        $this->data['page']         = 'attendance/hod_monthly_test_report';
        $this->load->view('common/common',$this->data);
    }
    
    public function hod_pre_board_test_report()
    {       
        if($this->input->post('search')):
            $emp_id       =  $this->input->post('emp_id');
            $where = '';
            $this->data['emp_id'] = '';
            
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            $this->data['result'] = $this->AttendanceModel->hod_pre_board_test_history('pre_board_test',$where);
            endif;
        $this->data['page_title']   = 'Hod Pre Board Test History | ECMS';
        $this->data['page']         = 'attendance/hod_pre_board_test_report';
        $this->load->view('common/common',$this->data);
    }
    
    public function auto_employee()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->AttendanceModel->getemployee_Data('hr_emp_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->emp_name.' (Scale: '.$row_set->scale.', Designation: '.$row_set->designation.', Department: '.$row_set->department.', Category: '.$row_set->category.')',
                    'label'=>$row_set->emp_name.' (Scale: '.$row_set->scale.', Designation: '.$row_set->designation.', Department: '.$row_set->department.', Category: '.$row_set->category.')',
                    'id'=>$row_set->emp_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('emp_name'=>$term);
            
            $result_set             = $this->AttendanceModel->getemployee_Data('hr_emp_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->emp_name.' (Scale: '.$row_set->scale.', Designation: '.$row_set->designation.', Department: '.$row_set->department.', Category: '.$row_set->category.')',
                  'label'=>$row_set->emp_name.' (Scale: '.$row_set->scale.', Designation: '.$row_set->designation.', Department: '.$row_set->department.', Category: '.$row_set->category.')',
                  'id'=>$row_set->emp_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function employee_alloted_languages()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $emp_id =$session['userData']['emp_id'];
        $this->data['result'] = $this->AttendanceModel->get_alloted_languages('prospectus_batch');
        
        $this->data['page_title']   = 'Employee Alloted Languages | ECMS';
        $this->data['page']         = 'attendance/employee_alloted_languages';
        $this->load->view('common/common',$this->data);
    }
    
    public function studentslanguageAtts()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $programe_id = $this->uri->segment(3);
        $batch_id = $this->uri->segment(4);
        $where1 = array('batch_id'=>$batch_id);
        $where2 = array('programe_id'=>$programe_id);
        $this->data['batch'] = $this->CRUDModel->get_where_row('prospectus_batch',$where1);
        $this->data['program'] = $this->CRUDModel->get_where_row('programes_info',$where2);
        $where      = array('student_record.programe_id'=>$programe_id,'student_record.batch_id'=>$batch_id);
        $this->data['result'] = $this->AttendanceModel->get_studentsLangAtts('student_record',$where);
        if($this->input->post()):
        $programe_id   = $this->input->post('programe_id');
        $batch_id     = $this->input->post('batch_id');
        $attendance_date = $this->input->post('attendance_date');
        $date1 = date('Y-m-d', strtotime($attendance_date));
        $checked = array(
               'programe_id'=>$programe_id,
               'batch_id'=>$batch_id,
               'attendance_date'=>$date1
            );
        $qry = $this->CRUDModel->get_where_row('student_attendance_languages',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! Students Attendance of this Date Already Exist');
        redirect('AttendanceController/studentslanguageAtts/'.$programe_id.'/'.$batch_id);       
        else:
        $checked = $this->input->post('checked');
        $where = array('student_record.programe_id'=>$programe_id,'student_record.batch_id'=>$batch_id);
        $all_students = $this->AttendanceModel->get_studentsLangAtts('student_record',$where);
        if(!empty($checked)):
            $date_required = $date1;
            $date_required = str_replace('/', '-', $date_required);
            $day = date('l', strtotime( $date_required));
            if ($day == 'Sunday' || $day == 'Saturday')
            {
              $this->session->set_flashdata('msg', 'Sorry! Off Day Attendance Not Allowed');
                redirect('AttendanceController/employee_alloted_languages');
            }
        $data  = array
            (
                'programe_id'=>$programe_id,
                'batch_id'=>$batch_id,
                'attendance_date' =>$date1,
                'user_id' =>$user_id
             );
        $attend_id = $this->CRUDModel->insert('student_attendance_languages',$data);
                $allStd = array();
                $sn = 0;
                foreach($all_students as $row)
                {
                    $allStd[$sn] = $row->student_id ;
                        $sn++;
                }
                $diff = array_diff($allStd,$checked);
                foreach($diff as $row=>$value):
                $attend_data = array
                (
                    'attend_id'=>$attend_id,
                    'student_id'=>$value,
                    'status'=>0
                );
                $this->CRUDModel->insert('student_attendance_lang_details',$attend_data);
                endforeach;

                foreach($checked as $row=>$value):
                $attend_data = array
                (
                    'attend_id'=>$attend_id,
                    'student_id'=>$value,
                    'status'=>1
                );
            $this->CRUDModel->insert('student_attendance_lang_details',$attend_data);
            endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/employee_alloted_languages');    
            else:

            $data  = array
            (
                'class_id' =>$class_id,
                'attendance_date' =>$date1,
                'user_id' =>$user_id
             );
            $attend_id = $this->CRUDModel->insert('student_attendance_languages',$data);
        foreach($all_students as $asrow):
            $asdata = array(
            'attend_id'=>$attend_id,
                'student_id'=>$asrow->student_id,
                'status'=>0
            );
            $this->CRUDModel->insert('student_attendance_lang_details',$asdata);
        endforeach;
            $this->session->set_flashdata('msg', 'Successfully Submitted.');
            redirect('AttendanceController/employee_alloted_languages'); 
        endif;
            
        endif;
        endif;
        $this->data['page_title']   = 'Language Students Attendance | ECMS';
        $this->data['page']         = 'attendance/studentslanguageAtts';
        $this->load->view('common/common',$this->data);
    }
    
    public function view_language_attendance()
    {       
        $id = $this->uri->segment(3);
        $programe_id = $this->uri->segment(4);
        $batch_id = $this->uri->segment(5);
        $where = array('student_attendance_lang_details.attend_id'=>$id);
        $this->data['program'] = $this->CRUDModel->get_where_row('programes_info',array('programe_id'=>$programe_id));
        $this->data['batch'] = $this->CRUDModel->get_where_row('prospectus_batch',array('batch_id'=>$batch_id));
       
        $this->data['result'] = $this->AttendanceModel->view_langues_attendance('student_attendance_lang_details',$where);
        $wherePrsent = array('student_attendance_lang_details.attend_id'=>$id,'status'=>1);
        $whereLeave = array('student_attendance_lang_details.attend_id'=>$id,'status'=>2);
        $whereAbsent = array('student_attendance_lang_details.attend_id'=>$id,'status'=>0);
        $this->data['present']       = count($this->AttendanceModel->view_langues_attendance('student_attendance_lang_details',$wherePrsent));
        $this->data['leave']       = count($this->AttendanceModel->view_langues_attendance('student_attendance_lang_details',$whereLeave));
        $this->data['Absent']       = count($this->AttendanceModel->view_langues_attendance('student_attendance_lang_details',$whereAbsent));
        
        $this->data['count'] = $this->AttendanceModel->view_langues_attendance('student_attendance_lang_details',$where);
        $this->data['page_title']   = 'VIew Student Attendance | ECMS';
        $this->data['page']         = 'attendance/view_language_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function student_language_attendance()
    {   
            $this->data['batch_id'] = '';
            $this->data['programe_id'] = '';
            $this->data['attendance_date'] = '';
        if($this->input->post('search')):
            $programe_id             =  $this->input->post('programe_id');
            $batch_id            =  $this->input->post('batch_id');
            $attendance_date            =  $this->input->post('attendance_date');
          
            $like = '';
            $where = '';
        
            if(!empty($programe_id)):
                $where['student_attendance_languages.programe_id'] = $programe_id;
                $this->data['programe_id'] =$programe_id;
            endif;
            if(!empty($batch_id)):
                $where['student_attendance_languages.batch_id'] = $batch_id;
                $this->data['batch_id'] =$batch_id;
            endif;
            if(!empty($attendance_date)):
                $where['student_attendance_languages.attendance_date'] = $attendance_date;
                $this->data['attendance_date'] =$attendance_date;
            endif;
            $this->data['result'] = $this->AttendanceModel->student_lan_attendance('student_attendance_languages',$where);
        else:
        $this->data['result'] = $this->AttendanceModel->student_languageattendance('student_attendance_languages');
        endif;
        $this->data['page_title']   = 'Student Attendance (Languages) | ECMS';
        $this->data['page']         = 'attendance/students_language_attendance';
        $this->load->view('common/common',$this->data);
    }
    
    public function auto_std_hnd()
     { 
        $term = $this->input->get('term');
            if( $term == ''){
                
            $result_set             = $this->AttendanceModel->getStdhnd('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
                );  
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->AttendanceModel->getStdhnd('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
                    );
            }
            $matches = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
     public function subject_log_report_inter(){
        
            $this->data['college_number']   = ''; 
            $this->data['std_name']         = ''; 
            $this->data['std_fname']        = ''; 
        
        if($this->input->post('search_log')):
        
            $college_number = $this->input->post('college_number');
            $section        = $this->input->post('section');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');

            $where['student_record.s_status_id'] = 5;
            $where['student_record.programe_id'] = 1;
            $like = '';
                if($college_number):
                   $where['student_record.college_no'] = $college_number;  
                   $this->data['college_number'] = $college_number; 
                endif;
                if($section):
                   $where['sections.sec_id'] = $section;  
                   $this->data['sectionId'] = $section;  
                endif;
               if($std_name):
                   $like['student_record.student_name'] = $std_name;  
                   $this->data['std_name'] = $std_name;  
                endif;
               
                if($std_fname):
                   $like['student_record.father_name'] = $std_fname;  
                   $this->data['std_fname'] = $std_fname;  
                endif;
               
                    $this->data['subject_record'] = $this->AttendanceModel->subject_inter_record_logs($where,$like);
//                    echo '<pre>'; print_r($this->data['subject_record']); die;
              
            endif;
            
        if($this->input->post('export_log')):
            
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('aa');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No.');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Student Name');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Father Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Section');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            
                
       for($col = ord('A'); $col <= ord('E'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_number = $this->input->post('college_number');
            $section        = $this->input->post('section');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');

            $where['student_record.s_status_id'] = 5;
            $where['student_record.programe_id'] = 1;
            $like = '';
                if($college_number):
                   $where['student_record.college_no'] = $college_number;  
                   $this->data['college_number'] = $college_number; 
                endif;
                if($section):
                   $where['sections.sec_id'] = $section;  
                   $this->data['sectionId'] = $section;  
                endif;
               if($std_name):
                   $like['student_record.student_name'] = $std_name;  
                   $this->data['std_name'] = $std_name;  
                endif;
               
                if($std_fname):
                   $like['student_record.father_name'] = $std_fname;  
                   $this->data['std_fname'] = $std_fname;  
                endif;
            
        $subject_record     = $this->AttendanceModel->subject_inter_record_logs($where,$like);
         
        if($subject_record):
            
            $return_array = '';
            $sn = '';
            foreach($subject_record as $srRow):
                $subjects = $this->AttendanceModel->get_subject_group_list('student_subject_alloted_logs',array('student_id'=>$srRow->student_id));
                 if(!empty($subjects)):
                     $sn++;
                     $return_array[] = array(
                         'sn' =>  $sn,
                         'colleg_no' =>  $srRow->college_no,
                         'student_name' =>  $srRow->student_name,
                         'father_name' =>  $srRow->father_name,
                         'section_name' =>  $srRow->section_name,
                         
                     );
                     $return_array[] = array(
                         'sn' =>  '',
                         'colleg_no' =>  'Date Time',
                         'student_name' =>  'Log Subjects',
                         'father_name' =>  '',
                         'section_name' =>  'Username',
                         
                     );
                      foreach($subjects as $subjects):
                          
                                             $this->db->join('subject','subject.subject_id=student_subject_alloted_logs.subject_id');
                             $subjectsList =    $this->db->get_where('student_subject_alloted_logs',array('timestamp'=>$subjects->timestamp,'student_id'=>$srRow->student_id))->result();
                             $subject_titles = '';
                             if($subjectsList):
                                 
                               foreach($subjectsList as $rowList):
                                 $subject_titles .= $rowList->title.', ';
                             endforeach;  
                             endif;
                          
                          $return_array[] = array(
                         'sn' =>  '',
                         'colleg_no' =>  date('d-m-Y H:i:s',strtotime($subjects->timestamp)),
                         'student_name' =>  $subject_titles,
                         'father_name' =>  '',
                         'section_name' =>  $subjects->email,
                         
                     ); 
                      endforeach;
                      $return_array[] = array(
                         'sn' =>  '',
                         'colleg_no' =>  '',
                         'student_name' =>  '',
                         'father_name' =>  '',
                         'section_name' =>  '',
                         
                     );
                 endif;
            endforeach;
            
//            echo '<pre>'; print_r($return_array); die;
        endif;
        $exceldata="";
        foreach ($return_array as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='Subject_Alloted_Logs.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
            
        endif;
               
         
            $whereSubPrg                       = array('programe_id'=>1);
            $this->data['subPrograme']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',$whereSubPrg);
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Select Section', 'sec_id', 'name',array('program_id'=>1));
           
            $this->data['HeaderPage']       = 'Student Subject Alloted History (Inter)';
            $this->data['page_title']       = 'Student Log Report | ECMS';
            $this->data['page']             = 'attendance/student_wise_logs_report';
            $this->load->view('common/common',$this->data);
    }
    
    public function subject_log_report_a_level(){
        
            $this->data['college_number']   = ''; 
            $this->data['std_name']         = ''; 
            $this->data['std_fname']        = ''; 
        
        if($this->input->post('search_log')):
        
            $college_number = $this->input->post('college_number');
            $section        = $this->input->post('section');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');

            $where['student_record.s_status_id'] = 5;
            $where['student_record.programe_id'] = 5;
            $like = '';
                if($college_number):
                   $where['student_record.college_no'] = $college_number;  
                   $this->data['college_number'] = $college_number; 
                endif;
                if($section):
                   $where['sections.sec_id'] = $section;  
                   $this->data['sectionId'] = $section;  
                endif;
               if($std_name):
                   $like['student_record.student_name'] = $std_name;  
                   $this->data['std_name'] = $std_name;  
                endif;
               
                if($std_fname):
                   $like['student_record.father_name'] = $std_fname;  
                   $this->data['std_fname'] = $std_fname;  
                endif;
               
                    $this->data['subject_record'] = $this->AttendanceModel->subject_a_level_record_logs($where,$like);
//                    echo '<pre>'; print_r($this->data['subject_record']); die;
              
            endif;
            
        if($this->input->post('export_log')):
            
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('aa');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No.');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Student Name');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Father Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Section');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            
                
       for($col = ord('A'); $col <= ord('E'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_number = $this->input->post('college_number');
            $section        = $this->input->post('section');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');

            $where['student_record.s_status_id'] = 5;
            $where['student_record.programe_id'] = 5;
            $like = '';
                if($college_number):
                   $where['student_record.college_no'] = $college_number;  
                   $this->data['college_number'] = $college_number; 
                endif;
                if($section):
                   $where['sections.sec_id'] = $section;  
                   $this->data['sectionId'] = $section;  
                endif;
               if($std_name):
                   $like['student_record.student_name'] = $std_name;  
                   $this->data['std_name'] = $std_name;  
                endif;
               
                if($std_fname):
                   $like['student_record.father_name'] = $std_fname;  
                   $this->data['std_fname'] = $std_fname;  
                endif;
            
        $subject_record     = $this->AttendanceModel->subject_a_level_record_logs($where,$like);
         
        if($subject_record):
            
            $return_array = '';
            $sn = '';
            foreach($subject_record as $srRow):
                $subjects = $this->AttendanceModel->get_subject_group_list('student_subject_alloted_logs',array('student_id'=>$srRow->student_id));
                 if(!empty($subjects)):
                     $sn++;
                     $return_array[] = array(
                         'sn' =>  $sn,
                         'colleg_no' =>  $srRow->college_no,
                         'student_name' =>  $srRow->student_name,
                         'father_name' =>  $srRow->father_name,
                         'section_name' =>  $srRow->section_name,
                         
                     );
                     $return_array[] = array(
                         'sn' =>  '',
                         'colleg_no' =>  'Date Time',
                         'student_name' =>  'Log Subjects',
                         'father_name' =>  '',
                         'section_name' =>  'Username',
                         
                     );
                      foreach($subjects as $subjects):
                          
                                             $this->db->join('subject','subject.subject_id=student_subject_alloted_logs.subject_id');
                             $subjectsList =    $this->db->get_where('student_subject_alloted_logs',array('timestamp'=>$subjects->timestamp,'student_id'=>$srRow->student_id))->result();
                             $subject_titles = '';
                             if($subjectsList):
                                 
                               foreach($subjectsList as $rowList):
                                 $subject_titles .= $rowList->title.', ';
                             endforeach;  
                             endif;
                          
                          $return_array[] = array(
                         'sn' =>  '',
                         'colleg_no' =>  date('d-m-Y H:i:s',strtotime($subjects->timestamp)),
                         'student_name' =>  $subject_titles,
                         'father_name' =>  '',
                         'section_name' =>  $subjects->email,
                         
                     ); 
                      endforeach;
                      $return_array[] = array(
                         'sn' =>  '',
                         'colleg_no' =>  '',
                         'student_name' =>  '',
                         'father_name' =>  '',
                         'section_name' =>  '',
                         
                     );
                 endif;
            endforeach;
            
//            echo '<pre>'; print_r($return_array); die;
        endif;
        $exceldata="";
        foreach ($return_array as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='Subject_Alloted_Logs.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
            
        endif;
               
         
            $whereSubPrg                       = array('programe_id'=>5);
            $this->data['subPrograme']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',$whereSubPrg);
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Select Section', 'sec_id', 'name',array('program_id'=>5));
           
            $this->data['HeaderPage']       = 'Student Subject Alloted History (A Level)';
            $this->data['page_title']       = 'Student Log Report | ECMS';
            $this->data['page']             = 'attendance/student_wise_logs_report_a_level';
            $this->load->view('common/common',$this->data);
    }
    
    public function student_promotions_history(){
      
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name'); 
        $this->data['date_pro']         = date('d-m-Y');
        
        $this->data['programe_id']  = '';
        $this->data['sub_pro_id']   = '';
        $this->data['date_prog']    = '';
        
        
        
        if($this->input->post('add_pro')):
            
            $program_id     = $this->input->post('programe_id');
            $sub_prog_id    = $this->input->post('sub_pro_id');
            $date_pro       = $this->input->post('date_pro');
            $comment        = $this->input->post('comments');
            
            $data       = array(
                'programme'       => $program_id,
                'sub_program'   => $sub_prog_id,
                'date'          => date("Y-m-d", strtotime($date_pro)),
                'comments'      => $comment,
            );
            $book_id = $this->CRUDModel->insert('student_promotions_date_history',$data);
            redirect('AttendanceController/student_promotions_history');
        endif;
        
        $this->data['result']       = $this->AttendanceModel->getPromotionHistory('student_promotions_date_history');
        
        $this->data['page']         = 'attendance/promotions/student_promotion_log';
        $this->data['page_header']  = 'Student Promotions History';
        $this->data['page_title']   = 'Student Promotions History | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_promotion_history()
        {   
        $serial = $this->uri->segment(3);
        
        $this->data['result'] = $this->CRUDModel->get_where_row('student_promotions_date_history', array('serial_no'=>$serial));
        
         $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name'); 
        
        if($this->input->post('update_pro')):
        
        $data = array(
            'programme'     => $this->input->post('programe_id'),
            'sub_program'   => $this->input->post('sub_pro_id'),
            'date'          => date('Y-m-d',strtotime($this->input->post('date_pro'))),
            'comments'      => $this->input->post('comments'),    
            );
        
        $where = array('serial_no' => $this->input->post('serial_pro'));
        
        $this->CRUDModel->update('student_promotions_date_history', $data, $where );
        redirect('AttendanceController/student_promotions_history');
        
        endif;
        
        $this->data['page']         = 'attendance/promotions/update_student_promotion_log';
        $this->data['page_header']  = 'Update Student Promotions History';
        $this->data['page_title']   = 'Update Student Promotions History | ECMS';
        $this->load->view('common/common',$this->data);

        }
    
}
