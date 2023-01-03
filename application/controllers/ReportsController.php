<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
//require_once APPPATH."third_party\PHPExcel.php"; 

class ReportsController extends AdminController {

     public function __construct() {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('ReportsModel');
             $this->load->model('AttendanceModel');
             $this->load->model('SmsModel');
             $this->load->model('dropdownModel');
             $this->load->library("pagination");
             $this->load->Model('WhiteCardModel');
             $this->userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            
             
        }
    
     public function fee_students_search(){
            $college_no     =  $this->input->post('college_no');
            $gender         =  $this->input->post('gender');
            $student_name   =  $this->input->post('student_name');
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $batch          = $this->input->post("batch_id");
            $s_status_id    = $this->input->post("s_status_id");
            $fromDate       = $this->input->post("date_from");
            $toDate         = $this->input->post("date_to");
            $shift         = $this->input->post("shift");
         
            $where = '';
            $like = '';
            
             $date       = '';
            if(empty($fromDate)):
                
                $date['toDate']             = $toDate;
            else:
                $date['fromDate']           = $fromDate;
                $date['toDate']             = $toDate;
            endif;
            
             if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id']        = $gender;
                $this->data['gender_id']   = $gender;
            endif;
            if($programe_id):
                $where['programes_info.programe_id']= $programe_id;
                $this->data['programe_id']          = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($shift)):
                 $where['student_record.shift_id'] = $shift;
                
            endif;
            if(!empty($section)):
                $where['sections.sec_id']           = $section;
                $this->data['sec_id']               = $section;
            endif;
            if(!empty($batch)):
                $where['prospectus_batch.batch_id']  = $batch;
                $this->data['batchId']              = $batch;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id']  = $s_status_id;
                $this->data['application_statusId']   = $s_status_id;
            endif;
            
            if($this->input->post('Search')):
                $result = $this->ReportsModel->grand_finance_report($where,$like,$date);
                echo json_encode($result);
            endif;
            if($this->input->post('Excel')):
                
               
                
                 $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Merit list');
                
                $this->excel->getActiveSheet()->setCellValue('A1', 'Form #');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('B1', 'College #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Student name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('F1','Shift');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('G1','Batch');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(11);
    
                $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Section');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('K1','T.Marks');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('L1','%age');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('M1','Admission Date');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('N1','Student Status');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(11);
                
                
       for($col = ord('A'); $col <= ord('N1'); $col++){
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }              
            $result = $this->ReportsModel->grand_finance_report_excel($where,$like,$date);
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($result, null, 'A2');
                $filename='Grand Report Finance Excel '.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif;
    }

    
    public function student_attendance_report_grand(){
        if($this->input->post()):
            $emp_id     = $this->input->post('emp_idCode_report');
            $empname    = $this->input->post('emp_id_report');
            $where = array(
                'hr_emp_record.emp_id'  =>$emp_id,
                    );
            $this->data['empname']      = $empname;
            $this->data['empId']        = $emp_id;
            $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
            $this->data['prac_result']       = $this->ReportsModel->get_teacher_pracsubjects($where);
        endif;
        $this->data['program']          = 'Teacher Attendance Report Grand';
        $this->data['page_title']       = 'Student Attendance Report Grand | ECMS';
        $this->data['page']             =  'reports/SARG';
        $this->load->view('common/common',$this->data); 
    }
    
    public function student_attendance_report_grand_teacherwise(){
//        echo '<pre>'; print_r($this->userInfo); die;
            
//            $emp_id     = $this->input->post('emp_idCode_report');
//            $empname    = $this->input->post('emp_id_report');
            $where = array(
                'hr_emp_record.emp_id'  =>$this->userInfo->emp_id,
                    );
//            $this->data['empname']      = $empname;
//            $this->data['empId']        = $emp_id;
            $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
            $this->data['prac_result']       = $this->ReportsModel->get_teacher_pracsubjects($where);
        
        $this->data['program']          = 'Teacher Attendance Report Grand';
        $this->data['page_title']       = 'Student Attendance Report Grand | ECMS';
        $this->data['page']             =  'reports/SARGTW';
        $this->load->view('common/common',$this->data); 
    }
    
    public function grand_report_merit_List(){
         
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat 1', 'rseat_id', 'name');
            $this->data['reserved_seat2']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat 2', 'rseat_id', 'name');
            $this->data['reserved_seat3']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat 3', 'rseat_id', 'name');
            $this->data['reserved_seat4']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat 4', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['shift']            = $this->CRUDModel->dropDown('shift', 'Select Shift ', 'shift_id', 'name');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('status'=>'On'));
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
            
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $college_no                     =  $this->input->post('college_no');
            $shift                          =  $this->input->post('shift');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $reserved_seat2                  =  $this->input->post('reserved_seat2');
            $reserved_seat3                  =  $this->input->post('reserved_seat3');
            $reserved_seat4                  =  $this->input->post('reserved_seat4');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
            $year_of_passing                =  $this->input->post('year_of_passing');
            $limit                          =  $this->input->post('limit');
            $batch                          =  $this->input->post('batch');
            //like Array
            $like = '';
            $where = '';
            $where_in = '';
            $this->data['college_no']           = '';
            $this->data['shift_id']             = '';
            $this->data['form_no']              = '';
            $this->data['student_name']         = '';
            $this->data['father_name']          = '';
            $this->data['genderId']             = '';
            $this->data['programId']            = '';
            $this->data['sectionId']            = '';
            $this->data['subprogramId']         = '';
            $this->data['reserved_seatId']      = '';
            $this->data['reserved_seatId2']      = '';
            $this->data['reserved_seatId3']      = '';
            $this->data['reserved_seatId4']      = '';
            $this->data['application_statusId'] = '';
            $this->data['pictureId']            = '';
            $this->data['passingYear']          = '';
            $this->data['batchId']              = '';
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($reserved_seat2)):
                $where['rseats_id1']           = $reserved_seat2;
                $this->data['reserved_seatId2']   = $reserved_seat2;
            endif;
            if(!empty($reserved_seat3)):
                $where['rseats_id3']           = $reserved_seat3;
                $this->data['reserved_seatId3']   = $reserved_seat3;
            endif;
            if(!empty($reserved_seat4)):
                $where['rseats_id2']           = $reserved_seat4;
                $this->data['reserved_seatId4']   = $reserved_seat4;
            endif;
            if(!empty($shift)):
                $where['shift.shift_id']        = $shift;
                $this->data['shift_id']   = $shift;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']     = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']          = $form_no;
                $this->data['form_no']      = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
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
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
                 if($picture == 0):
                     $where['student_record.applicant_image ='] = '';
                     $this->data['pictureId']  = $picture;
                endif;
                if($picture == 1):
                     $where['student_record.applicant_image !='] = '';
                     $this->data['pictureId']  = $picture;    
                endif;
                if($picture == 2):
                    $this->data['pictureId']  = $picture;    
                endif;
                
                if($year_of_passing):
                    if($year_of_passing == 2018):    
                     $where_in['applicant_edu_detail.year_of_passing ='] = $year_of_passing;
                     $this->data['passingYear']  = $year_of_passing;
                    else:   
                     $where['applicant_edu_detail.year_of_passing ='] = $year_of_passing;
                     $this->data['passingYear']  = $year_of_passing;
                    endif;
            endif;        
        
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
 
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_record.rseats_id3,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    sections.sec_id,
                    sections.name as sectionName,
                    domicile.name,
                    admission_date,
                    college_no,
                    shift.name as shift_name,
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report_new($field,'student_record', $where,$like,$custom,$where_in);
 
             endif;
             
             
             
            if($this->input->post('export')):
                
                 $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Merit list');
                
                $this->excel->getActiveSheet()->setCellValue('A1', 'S#');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('B1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Student name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Res. Seat 1');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('F1','Res. seat 2');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('G1','Res. seat 3');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(11);
    
                $this->excel->getActiveSheet()->setCellValue('H1','Admission In');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Comments');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Gender');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('K1','T.Marks');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('L1','O.Marks');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(11);
               
                $this->excel->getActiveSheet()->setCellValue('M1','%age');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('N1','FATA School');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(11);
               
                $this->excel->getActiveSheet()->setCellValue('O1','Shift');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(11);
        
                $this->excel->getActiveSheet()->setCellValue('P1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(11);
               
                $this->excel->getActiveSheet()->setCellValue('Q1','Passing Year');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(11);
               
                $this->excel->getActiveSheet()->setCellValue('R1','Missing Documents');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('S1','General Remarks');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('T1','Religion');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('U1','Last Institute Address');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(11);
        
                $this->excel->getActiveSheet()->setCellValue('V1','Mobile #');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(11);  
                
       for($col = ord('A'); $col <= ord('V1'); $col++){
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }              
            
            $result   = $this->ReportsModel->grand_reportExportn('student_record',$where,$like,$custom,$where_in);
                
        foreach ($result as $row){
                $exceldata[] = $row;
                
            }
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='GrandReport_'.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif; 
           
           
            $this->data['ReportName']   = 'Grand Report Merit List';
            $this->data['page']         = "reports/grand_report_merit_List";
            $this->data['title']        = 'Grand Report Merit List | ECMS';
            $this->load->view('common/common',$this->data); 
 
        }
    

    
    public function student_position_wise_fine_degree(){
         
            $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>4));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>4));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>4));
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            
      
            $this->data['fromDate']  = date('Y-m-d');
            $this->data['toDate']    = date('Y-m-d');
        
           
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $where['student_record.s_status_id'] = 5;
        
        if($this->input->post('export')):
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Students Fine Report');
                $this->excel->getActiveSheet()->setCellValue('A1', 'College #');          
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1','Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                           
                $this->excel->getActiveSheet()->setCellValue('C1', 'Section');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('D1', 'Presents');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1', 'Absents');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('F1', 'Total');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1', 'Fine');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
    
            for($col = ord('A'); $col <= ord('G'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);               
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                }
        
                $result = $this->ReportsModel->getPositionResults('student_position');
                $exceldata="";
                foreach ($result as $row)
                {
                    $exceldata[] = $row;
                }              
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Degree_Fine_Report.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName
                    ';
                $this->data['result'] = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['sectionNames'] = $this->ReportsModel->position_report_std($field,'student_record', array('sections.sec_id'=>$section));
                
                $this->data['ReportName']   = 'Position wise Fine (Degree)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/marksWisefinedegree";
                $this->data['title']        = 'Position wise Fine (Degree) | ECMS';
                $this->load->view('common/common',$this->data);      
            else:
            $this->data['studentId']    = '';
            $this->data['form_no']      = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']     = '';
            $this->data['programId']    = '';
            $this->data['subprogramId'] = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            $this->data['ReportName']   = 'Position Marks wise Fine (Degree)';
            $this->data['page']         = "reports/marksWisefinedegree";
            $this->data['title']        = 'Position wise Fine (Degree) | ECMS';
            $this->load->view('common/common',$this->data); 
           endif; 
            
        }
 
        public function students_quota_report(){
           $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['status'] = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['batch']  = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
                $program                        =  $this->input->post('program');
                $status                    =  $this->input->post('s_status_id');
                $batch                          =  $this->input->post('batch');

                $like = '';
                $where = '';
                $this->data['programId']        = '';
                $this->data['sectionId']        = '';
                $this->data['subprogramId']     = '';
                $this->data['application_statusId']  = '';
                $this->data['reserved_seatId']  = '';
                $this->data['batchId']          = '';
            if($this->input->post()):
                if(!empty($program)):
                     $where['student_record.programe_id'] = $program;
                    $this->data['programId']  = $program;
                endif;
                if(!empty($batch)):
                     $where['student_record.batch_id'] = $batch;
                    $this->data['batchId'] = $batch;
                endif;
                if(!empty($status)):
                     $where['student_record.s_status_id'] = $status;
                    $this->data['application_statusId'] = $status;
                endif;
               $this->data['result'] = $this->ReportsModel->get_studentsQuota('student_record', $where);
             endif;
                $this->data['ReportName']   = 'Students Quota Wise Report';
                $this->data['page']         = "reports/students_quota_report";
                $this->data['title']        = 'Students Quota Wise Report | ECMS';
                $this->load->view('common/common',$this->data);
        }
        Public function inter_merit_list(){
         
              //dropdown lists
            $wherePrg                       = array('status'=>'yes');
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',$wherePrg);
            $wheresPrg                      = array('status'=>'yes');
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',$wheresPrg);
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender Status ', 'gender_id', 'title');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
              
            $student_id         =  $this->input->post('student_id');
            $batch_id =  $this->input->post('batch_id');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender             =  $this->input->post('gender');
            $program            =  $this->input->post('program');
            $sub_program        =  $this->input->post('sub_program');
            $reserved_seat      =  $this->input->post('reserved_seat');
            $application_status =  $this->input->post('application_status');
            $limit              =  $this->input->post('limit');
            
            
            //like Array
            $like = '';
            $where = '';
            $this->data['studentId'] = '';
            $this->data['batch_id'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']  = '';
            $this->data['programId']  = '';
            $this->data['subprogramId']  = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
                $this->data['father_name'] =$father_name;
            endif;
 
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['studentId']  = $student_id;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']  = $gender;
            endif;
            if(!empty($batch_id)):
                 $where['student_record.batch_id'] = $batch_id;
                $this->data['batch_id']  = $batch_id;
            endif;
            if(!empty($form_no)):
                 $where['form_no'] = $form_no;
                $this->data['form_no']  = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']  = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId']  = $sub_program;
            endif;
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id'] = $reserved_seat;
                $this->data['reserved_seatId']  = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
            $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
              
                if($limitVale):
                    $limitD = $limitVale->limit_value;
                else:
                    $limitD = 50;
                endif;
//                $custom['limit']        = $limitD;
//                $custom['start']        = 0;
               
//                $custom['column']       = 'applicant_edu_detail.percentage';
//                $custom['order']        = 'desc';
//                $this->data['limitId']  = $limit;
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    domicile.name,
                    admission_date,
                    college_no
                    ';
                $this->data['result']       = $this->ReportsModel->get_meritlist($field,'student_record', $where,$like);
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/merit_list";
                $this->data['title']        = 'Merit List 2016 | ECP';
                $this->load->view('common/common',$this->data); 
             
            elseif($this->input->post('export')):
                
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Student.ID');
                
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Name');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Program');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Batch no');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Hostel');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Fata School');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Domicile');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','T.M');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','O.M');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('O1','%');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('P1','Remarks 1');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Remarks 2');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Application status');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('S1','Admission Date');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('T1','College no');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('U1','Minority');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('V1','Address');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
              
                $this->excel->getActiveSheet()->setCellValue('W1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
               
                
       for($col = ord('A'); $col <= ord('W'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }


                
        $field = ' 
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as reservedName,
                prospectus_batch.batch_name,
                student_record.hostel_required,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.admission_comment,
                student_record.comment,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                religion.title as religion,
                student_record.parmanent_address as Address,
                blood_group.title,
                '
                ;
        
            //$result       = $this->ReportsModel->get_meritlist($field,'student_record', $where,$like,$custom);
            
            $result   = $this->ReportsModel->get_meritlistExport($field,'student_record',$where,$like,$custom);
                
               // echo '<pre>';print_r($result);die;
                
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                  
                $filename='meritList2016.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
            elseif($this->input->post('print')):
          
                  $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    domicile.name
                    ';
            
                 
                $this->data['result']   = $this->ReportsModel->get_meritlist($field,'student_record', $where,$like,$custom);
                
//                $this->data['page']     = "reports/merit_list";
//                $this->data['title']    = 'Merit List 2016 | ECP';
                $this->load->view('reports/print',$this->data); 
                    
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
            
            $this->data['page']         = "reports/merit_list";
            $this->data['title']        = 'Societies Admin | ECP';
            $this->load->view('common/common',$this->data); 
                // echo '<pre>';print_r($this->data['result']);die;
           endif; 
 
        }
    public function grand_report_new(){
         
              //dropdown lists
            
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['reserved_seat3']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['shift']            = $this->CRUDModel->dropDown('shift', 'Select Shift ', 'shift_id', 'name');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('status'=>'On'));
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['religion']         = $this->CRUDModel->dropDown('religion', 'Religion ', 'religion_id', 'title');
            
            
            
            $college_no                     =  $this->input->post('college_no');
            $shift                          =  $this->input->post('shift');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $reserved_seat3                 =  $this->input->post('reserved_seat3');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
            $hostel                         =  $this->input->post('hostel');
            $limit                          =  $this->input->post('limit');
            $religion                          =  $this->input->post('religion');
            $batch                          =  $this->input->post('batch');
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']           = '';
            $this->data['shift_id']             = '';
            $this->data['form_no']              = '';
            $this->data['student_name']         = '';
            $this->data['father_name']          = '';
            $this->data['genderId']             = '';
            $this->data['programId']            = '';
            $this->data['sectionId']            = '';
            $this->data['subprogramId']         = '';
            $this->data['reserved_seatId']      = '';
            $this->data['reserved_seatId3']     = '';
            $this->data['application_statusId'] = '';
            $this->data['pictureId']            = '';
            $this->data['hostelId']             = '';
            $this->data['batchId']              = '';
            $this->data['fromDate']             = '';
            $this->data['religionId']             = '';
            $this->data['toDate']               = date('d-m-Y');
           
           if($this->input->post('search')):
             $date       = '';
            if(empty($fromDate)):
                
                    $date['toDate']             = $toDate;
                    $this->data['toDate']       = $toDate;
                     $this->data['fromDate']     = '';
                else:
                    $this->data['fromDate']     = $fromDate;
                    $this->data['toDate']       = $toDate;
                    $date['fromDate']           = $fromDate;
                    $date['toDate']             = $toDate;
            endif;
           
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($reserved_seat3)):
                $where['rseats_id2']           = $reserved_seat3;
                $this->data['reserved_seatId3']   = $reserved_seat3;
            endif;
            if(!empty($shift)):
                $where['shift.shift_id']        = $shift;
                $this->data['shift_id']   = $shift;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']     = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']          = $form_no;
                $this->data['form_no']      = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
            endif;
             if(!empty($religion)):
                 $where['student_record.religion_id']   = $religion;
                $this->data['religionId']               = $religion;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
                 if($picture == 0):
                     $where['student_record.applicant_image ='] = '';
                     $this->data['pictureId']  = $picture;
                endif;
                if($picture == 1):
                     $where['student_record.applicant_image !='] = '';
                     $this->data['pictureId']  = $picture;    
                endif;
                if($picture == 2):
                    $this->data['pictureId']  = $picture;    
                endif;
                
                if($hostel == 0):
                    $this->data['hostelId']  = $hostel;    
                    $custom['hostel']           = $hostel;
                endif;
                if($hostel == 1):
                    $this->data['hostelId']     = $hostel;    
                    $custom['hostel']           = $hostel;
                endif;
                
                if($hostel == 2):
                    $this->data['hostelId']     = $hostel;    
                    $custom['hostel']           = $hostel;
                endif;
                
                
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
  
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    sections.sec_id,
                    sections.name as sectionName,
                    domicile.name,
                    admission_date,
                    college_no,
                    shift.name as shift_name,
                    hostel_student_record.hostel_id as hostelRecord,
                    ';
//            echo '<pre>';print_r($date);die;
                $this->data['result']       = $this->ReportsModel->grand_report_new_hostel_check($field,'student_record', $where,$like,$custom,'',$date);
//                echo '<pre>';print_r($this->data['result'] );die;
            endif;
            if($this->input->post('export')):
                
                
                 $date       = '';
            if(empty($fromDate)):
                
                    $date['toDate']             = $toDate;
                    $this->data['toDate']       = $toDate;
                     $this->data['fromDate']     = '';
                else:
                    $this->data['fromDate']     = $fromDate;
                    $this->data['toDate']       = $toDate;
                    $date['fromDate']           = $fromDate;
                    $date['toDate']             = $toDate;
            endif;
            if(!empty($religion)):
                 $where['student_record.religion_id']   = $religion;
                $this->data['religionId']               = $religion;
            endif;
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($reserved_seat3)):
                $where['rseats_id2']           = $reserved_seat3;
                $this->data['reserved_seatId3']   = $reserved_seat3;
            endif;
            if(!empty($shift)):
                $where['shift.shift_id']        = $shift;
                $this->data['shift_id']   = $shift;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']     = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']          = $form_no;
                $this->data['form_no']      = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
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
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
                 if($picture == 0):
                     $where['student_record.applicant_image ='] = '';
                     $this->data['pictureId']  = $picture;
                endif;
                if($picture == 1):
                     $where['student_record.applicant_image !='] = '';
                     $this->data['pictureId']  = $picture;    
                endif;
                if($picture == 2):
                    $this->data['pictureId']  = $picture;    
                endif;
                
                if($hostel == 0):
                    $this->data['hostelId']  = $hostel;    
                    $custom['hostel']           = $hostel;
                endif;
                if($hostel == 1):
                    $this->data['hostelId']     = $hostel;    
                    $custom['hostel']           = $hostel;
                endif;
                
                if($hostel == 2):
                    $this->data['hostelId']     = $hostel;    
                    $custom['hostel']           = $hostel;
                endif;
                
                
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                
                
                
                 $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'S#');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1','C No');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Student name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Father name');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Gender');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                
                
                $this->excel->getActiveSheet()->setCellValue('G1','Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Reserved Seat 1');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Reserved seat 2');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Admission In');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Batch no');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('M1','Section');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('N1','Fata School');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('O1','Domicile');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('P1','T.Marks');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','O.Marks');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Percentage');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('S1','LAT Test Marks');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('T1','Admission Comment');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('U1','Seat Comment');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('V1','Application status');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('W1','Admission Date');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('X1','Religion');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('Y1','Address');
                $this->excel->getActiveSheet()->getStyle('Y1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Y1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('Z1','Father Mob#');
                $this->excel->getActiveSheet()->getStyle('Z1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Z1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AA1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('AA1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AA1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AB1','Father CNIC');
                $this->excel->getActiveSheet()->getStyle('AB1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AB1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AC1','Last School Address');
                $this->excel->getActiveSheet()->getStyle('AC1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AC1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AD1','Remarks 1');
                $this->excel->getActiveSheet()->getStyle('AD1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AD1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('AE1','Remarks 2');
                $this->excel->getActiveSheet()->getStyle('AE1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AE1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('AF1','Country');
                $this->excel->getActiveSheet()->getStyle('AF1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AF1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AG1','Shift');
                $this->excel->getActiveSheet()->getStyle('AG1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AG1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('AH1','Hostel');
                $this->excel->getActiveSheet()->getStyle('AH1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AH1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('AI1','Applicant Mobile#');
                $this->excel->getActiveSheet()->getStyle('AI1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AI1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('AJ1','Student CNIC');
                $this->excel->getActiveSheet()->getStyle('AJ1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AJ1')->getFont()->setSize(12);
               
                
               
                
       for($col = ord('A'); $col <= ord('AJ1'); $col++){
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }              
            
            $result   = $this->ReportsModel->grand_reportExport_new_hostel_check('student_record',$where,$like,$custom,$date);
           
        foreach ($result as $row){
                $exceldata[] = $row;
                
            }
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='GrandReport_'.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif; 
            
            $this->data['ReportName']   = 'Grand Report';
            $this->data['page']         = "reports/admin/grand_report_new";
            $this->data['title']        = 'Grand Report | ECMS';
            $this->load->view('common/common',$this->data); 
 
        }
        public function grand_report_new1(){
         
              //dropdown lists
            
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['reserved_seat3']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['shift']            = $this->CRUDModel->dropDown('shift', 'Select Shift ', 'shift_id', 'name');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('status'=>'On'));
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
            
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $college_no                     =  $this->input->post('college_no');
            $shift                          =  $this->input->post('shift');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $reserved_seat3                  =  $this->input->post('reserved_seat3');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
            $limit                          =  $this->input->post('limit');
            $batch                          =  $this->input->post('batch');
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']           = '';
            $this->data['shift_id']             = '';
            $this->data['form_no']              = '';
            $this->data['student_name']         = '';
            $this->data['father_name']          = '';
            $this->data['genderId']             = '';
            $this->data['programId']            = '';
            $this->data['sectionId']            = '';
            $this->data['subprogramId']         = '';
            $this->data['reserved_seatId']      = '';
            $this->data['reserved_seatId3']      = '';
            $this->data['application_statusId'] = '';
            $this->data['pictureId']            = '';
            $this->data['batchId']              = '';
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($reserved_seat3)):
                $where['rseats_id2']           = $reserved_seat3;
                $this->data['reserved_seatId3']   = $reserved_seat3;
            endif;
            if(!empty($shift)):
                $where['shift.shift_id']        = $shift;
                $this->data['shift_id']   = $shift;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']     = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']          = $form_no;
                $this->data['form_no']      = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
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
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
                 if($picture == 0):
                     $where['student_record.applicant_image ='] = '';
                     $this->data['pictureId']  = $picture;
                endif;
                if($picture == 1):
                     $where['student_record.applicant_image !='] = '';
                     $this->data['pictureId']  = $picture;    
                endif;
                if($picture == 2):
                    $this->data['pictureId']  = $picture;    
                endif;
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
 
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    sections.sec_id,
                    sections.name as sectionName,
                    domicile.name,
                    admission_date,
                    college_no,
                    shift.name as shift_name,
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report_new($field,'student_record', $where,$like,$custom);
 
             endif;
             
             
             
            if($this->input->post('export')):
                
                 $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'S#');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1','C No');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Student name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Father name');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Gender');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                
                
                $this->excel->getActiveSheet()->setCellValue('G1','Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Reserved Seat 1');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Reserved seat 2');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Admission In');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Batch no');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('M1','Section');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('N1','Fata School');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('O1','Domicile');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('P1','T.Marks');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','O.Marks');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Percentage');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('S1','LAT Test Marks');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('T1','Admission Comment');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('U1','Seat Comment');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('V1','Application status');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('W1','Admission Date');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('X1','Religion');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('Y1','Address');
                $this->excel->getActiveSheet()->getStyle('Y1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Y1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('Z1','Mobile');
                $this->excel->getActiveSheet()->getStyle('Z1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Z1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AA1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('AA1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AA1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AB1','CNIC');
                $this->excel->getActiveSheet()->getStyle('AB1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AB1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AC1','Last School Address');
                $this->excel->getActiveSheet()->getStyle('AC1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AC1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AD1','Remarks 1');
                $this->excel->getActiveSheet()->getStyle('AD1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AD1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('AE1','Remarks 2');
                $this->excel->getActiveSheet()->getStyle('AE1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AE1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('AF1','Country');
                $this->excel->getActiveSheet()->getStyle('AF1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AF1')->getFont()->setSize(12);
            
                $this->excel->getActiveSheet()->setCellValue('AG1','Shift');
                $this->excel->getActiveSheet()->getStyle('AG1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AG1')->getFont()->setSize(12);
               
                
               
                
       for($col = ord('A'); $col <= ord('AG1'); $col++){
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }              
            
            $result   = $this->ReportsModel->grand_reportExport_new('student_record',$where,$like,$custom);
           
        foreach ($result as $row){
                $exceldata[] = $row;
                
            }
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='GrandReport_'.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif; 
           
           
            $this->data['ReportName']   = 'Grand Report';
            $this->data['page']         = "reports/grand_report_new";
            $this->data['title']        = 'Grand Report | ECMS';
            $this->load->view('common/common',$this->data); 
 
        }
        public function grand_report(){
         
              //dropdown lists
            
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['reserved_seat3']    = $this->CRUDModel->dropDown('reserved_seat', 'Admission in Seat', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender Status ', 'gender_id', 'title');
            $this->data['shift']            = $this->CRUDModel->dropDown('shift', ' Shift ', 'shift_id', 'name');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name');
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
            
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            
           
            
            $college_no                     =  $this->input->post('college_no');
            $shift                          =  $this->input->post('shift');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $reserved_seat3                  =  $this->input->post('reserved_seat3');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
            $limit                          =  $this->input->post('limit');
            $batch                          =  $this->input->post('batch');
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
            $this->data['shift_id']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['genderId']         = '';
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['reserved_seatId']  = '';
            $this->data['reserved_seatId3']  = '';
            $this->data['application_statusId']  = '';
            $this->data['pictureId']          = '';
            $this->data['batchId']          = '';
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($reserved_seat3)):
                $where['rseats_id2']        = $reserved_seat3;
                $this->data['reserved_seatId3']   = $reserved_seat3;
            endif;
            if(!empty($shift)):
                $where['shift_id']        = $shift;
                $this->data['shift_id']   = $shift;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']     = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']          = $form_no;
                $this->data['form_no']      = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
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
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
                 if($picture == 0):
                     $where['student_record.applicant_image ='] = '';
                     $this->data['pictureId']  = $picture;
                endif;
                if($picture == 1):
                     $where['student_record.applicant_image !='] = '';
                     $this->data['pictureId']  = $picture;    
                endif;
                if($picture == 2):
                    $this->data['pictureId']  = $picture;    
                endif;
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
 
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    sections.sec_id,
                    sections.name as sectionName,
                    domicile.name,
                    admission_date,
                    college_no
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'Grand Report';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/grand_report";
                $this->data['title']        = 'Grand Report | ECMS';
                $this->load->view('common/common',$this->data); 
             
            elseif($this->input->post('export')):
                
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Student.ID');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Name');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Program');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Reserved Seat 1');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Reserved Seat 2');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Reserved seat 3');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Batch no');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Section');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','Fata School');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','Domicile');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('O1','T.Marks');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('P1','O.Marks');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Percentage');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Admission Comment');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('S1','Seat Comment');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('T1','Application status');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('U1','Admission Date');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('V1','College no');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('W1','Religion');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('X1','Address');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Y1','Mobile');
                $this->excel->getActiveSheet()->getStyle('Y1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Y1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('Z1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('Z1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Z1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('AA1','CNIC');
                $this->excel->getActiveSheet()->getStyle('AA1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AA1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('AB1','Last School Address');
                $this->excel->getActiveSheet()->getStyle('AB1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AB1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('AC1','Remarks 1');
                $this->excel->getActiveSheet()->getStyle('AC1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AC1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('AD1','Remarks 2');
                $this->excel->getActiveSheet()->getStyle('AD1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AD1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('AE1','Country');
                $this->excel->getActiveSheet()->getStyle('AE1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AE1')->getFont()->setSize(16);
               
                
               
                
       for($col = ord('A'); $col <= ord('AE1'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }                
            
            $result   = $this->ReportsModel->grand_reportExport('student_record',$where,$like,$custom);
                
        foreach ($result as $row){
                $exceldata[] = $row;
                
            }
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='GrandReport_'.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
             elseif($this->input->post('print')):
          
                  $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    domicile.name
                    ';
            
                 
                $this->data['result']   = $this->ReportsModel->get_meritlist($field,'student_record', $where,$like,$custom);
                
//                $this->data['page']     = "reports/merit_list";
//                $this->data['title']    = 'Merit List 2016 | ECP';
                $this->load->view('reports/print',$this->data); 
                    
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
            
            $this->data['ReportName']   = 'Grand Report';
            $this->data['page']         = "reports/grand_report";
            $this->data['title']        = 'Grand Report | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
 
        }
        public function year_head_report(){
         
              //dropdown lists
            
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes','programe_id'=>'1'));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'1'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>'1'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender Status ', 'gender_id', 'title');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('program_id'=>'1'));
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
              
            $college_no                     =  $this->input->post('college_no');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
//            $limit                          =  $this->input->post('limit');
            $batch                          =  $this->input->post('batch');
            
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']               = '';
            $this->data['form_no']                  = '';
            $this->data['student_name']             = '';
            $this->data['father_name']              = '';
            $this->data['genderId']                 = '';
            $this->data['programId']                = '';
            $this->data['sectionId']                = '';
            $this->data['subprogramId']             = '';
            $this->data['reserved_seatId']          = '';
            $this->data['application_statusId']     = '';
            $this->data['pictureId']                = '';
            $this->data['batchId']                  = '';
          
        if($this->input->post()):
            $where['programes_info.programe_id']    = 1;
            if(!empty($student_name)):
                $like['student_name']               = $student_name;
                $this->data['student_name']         = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']                = $father_name;
                $this->data['father_name']          = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']                = $college_no;
                $this->data['college_no']           = $college_no;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id']  = $gender;
                $this->data['genderId']             = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']                  = $form_no;
                $this->data['form_no']              = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']            = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId']         = $sub_program;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id']  = $batch;
                $this->data['batchId']              = $batch;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']          = $section;
                $this->data['sectionId']            = $section;
            endif;
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
            if($picture == 0):
                $where['student_record.applicant_image ='] = '';
                $this->data['pictureId']            = $picture;
           endif;
           if($picture == 1):
                $where['student_record.applicant_image !='] = '';
                $this->data['pictureId']            = $picture;    
           endif;
           if($picture == 2):
               $this->data['pictureId']             = $picture;    
           endif;
                $custom['column']                   = 'applicant_edu_detail.percentage';
                $custom['order']                    = 'desc';
 
            
        if($this->input->post('search')):
               
            $field = '
                student_record.student_id,
                student_record.college_no,
                student_record.applicant_image,
                student_record.student_name,
                student_status.name as student_statusName,
                gender.title as genderName,
                reserved_seat.name as reservedName,
                student_record.admission_comment,
                student_record.hostel_required,
                student_record.comment,
                student_record.father_name,
                student_record.form_no,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                board_university.title as bu_title,
                prospectus_batch.batch_name,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                sections.sec_id,
                sections.name as sectionName,
                domicile.name,
                admission_date,
                college_no
            ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['countResult']  = count($this->data['result']);
              
        endif;    
        if($this->input->post('export')):

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Merit list');
            //set cell A1 content with some text
            $this->excel->getActiveSheet()->setCellValue('A1', 'Student.ID');

            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'F.No');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Name');

            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);


            $this->excel->getActiveSheet()->setCellValue('D1', 'Father name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Gender');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Program');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);


            $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Reserved Seats');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','Batch no');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','Section');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','Fata School');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Domicile');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','T.M');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','O.M');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','%');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Remarks 1');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Remarks 2');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Application status');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Admission Date');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('T1','College no');
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('U1','Minority');
            $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('V1','Address');
            $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('W1','Mobile');
            $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('X1','Blood Group');
            $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);


        for($col = ord('A'); $col <= ord('X'); $col++){
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
             //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);

            $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }



        $field = ' 
            student_record.student_id,
            student_record.form_no,
            student_record.student_name,
            student_record.father_name,
            gender.title as genderName,
            programes_info.programe_name,
            sub_programes.name as subprogram,
            reserved_seat.name as reservedName,
            prospectus_batch.batch_name,
            sections.name,
            student_record.fata_school,
            domicile.name as domicileName,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.percentage,
            student_record.admission_comment,
            student_record.comment,
            student_status.name as student_statusName,
            student_record.admission_date,
            student_record.college_no,
            religion.title as religion,
            student_record.parmanent_address as Address,
            student_record.mobile_no as Mobile,
             blood_group.title,
            ';

        //$result       = $this->ReportsModel->get_meritlist($field,'student_record', $where,$like,$custom);

        $result   = $this->ReportsModel->grand_reportExport($field,'student_record',$where,$like,$custom);

           // echo '<pre>';print_r($result);die;

        foreach ($result as $row){
            $exceldata[] = $row;
            }
           $date = date('d-m-Y H:i:s');
            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');

            $filename='YearHead_'.$date.'.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache

            //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
            //if you want to save it as .XLSX Excel 2007 format
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            //force user to download the Excel file without writing it to server's HD
            $objWriter->save('php://output');
        endif;     
    endif;   
       
//            $this->data['studentId']        = '';
//            $this->data['form_no']          = '';
//            $this->data['student_name']     = '';
//            $this->data['father_name']      = '';
//            $this->data['genderId']         = '';
//            $this->data['programId']        = '';
//            $this->data['subprogramId']     = '';
//            $this->data['reserved_seatId']  = '';
//            $this->data['application_statusId']  = '';
//            $this->data['limitId']          = '';
            
            
            $this->data['ReportName']   = 'Year Head Report';
            $this->data['page']         = "reports/grand_report";
            $this->data['title']        = 'Year Head Report | ECMS';
            $this->load->view('common/common',$this->data); 
  
           
 
        }
        public function degree_report(){
         
              //dropdown lists
            
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes','programe_id'=>'4'));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'4'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>'4'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender Status ', 'gender_id', 'title');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('program_id'=>'4','status'=>'On'));
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
              
            $college_no                     =  $this->input->post('college_no');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
//            $limit                          =  $this->input->post('limit');
            $batch                          =  $this->input->post('batch');
            
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']               = '';
            $this->data['form_no']                  = '';
            $this->data['student_name']             = '';
            $this->data['father_name']              = '';
            $this->data['genderId']                 = '';
            $this->data['programId']                = '';
            $this->data['sectionId']                = '';
            $this->data['subprogramId']             = '';
            $this->data['reserved_seatId']          = '';
            $this->data['application_statusId']     = '';
            $this->data['pictureId']                = '';
            $this->data['batchId']                  = '';
          
        if($this->input->post()):
            $where['programes_info.programe_id']    = 4;
            if(!empty($student_name)):
                $like['student_name']               = $student_name;
                $this->data['student_name']         = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']                = $father_name;
                $this->data['father_name']          = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']                = $college_no;
                $this->data['college_no']           = $college_no;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id']  = $gender;
                $this->data['genderId']             = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']                  = $form_no;
                $this->data['form_no']              = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']            = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId']         = $sub_program;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id']  = $batch;
                $this->data['batchId']              = $batch;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']          = $section;
                $this->data['sectionId']            = $section;
            endif;
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
            if($picture == 0):
                $where['student_record.applicant_image ='] = '';
                $this->data['pictureId']            = $picture;
           endif;
           if($picture == 1):
                $where['student_record.applicant_image !='] = '';
                $this->data['pictureId']            = $picture;    
           endif;
           if($picture == 2):
               $this->data['pictureId']             = $picture;    
           endif;
                $custom['column']                   = 'applicant_edu_detail.percentage';
                $custom['order']                    = 'desc';
 
            
        if($this->input->post('search')):
               
            $field = '
                student_record.student_id,
                student_record.college_no,
                student_record.applicant_image,
                student_record.student_name,
                student_status.name as student_statusName,
                gender.title as genderName,
                reserved_seat.name as reservedName,
                student_record.admission_comment,
                student_record.hostel_required,
                student_record.comment,
                student_record.father_name,
                student_record.form_no,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                board_university.title as bu_title,
                prospectus_batch.batch_name,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                sections.sec_id,
                sections.name as sectionName,
                domicile.name,
                admission_date,
                college_no
            ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['countResult']  = count($this->data['result']);
              
        endif;    
        if($this->input->post('export')):    
			$college_no                     =  $this->input->post('college_no');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
            $batch                          =  $this->input->post('batch');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $where['form_no'] = $form_no;
                $this->data['form_no'] =$form_no;
            endif;
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
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
				
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Degree Grand Report');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'ID');
                
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Student Name');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Program');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Batch #');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Section');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Fata School');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Domicile');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','T.M');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','O.M');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('O1','%');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('P1','Remarks 1');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Remarks 2');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Application status');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('S1','Admission Date');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('T1','College no');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('U1','Minority');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('V1','Address');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
              
                $this->excel->getActiveSheet()->setCellValue('W1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
       for($col = ord('A'); $col <= ord('W'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
		$field = ' 
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as reservedName,
                prospectus_batch.batch_name,
                sections.name,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.admission_comment,
                student_record.comment,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                religion.title as religion,
                student_record.parmanent_address as Address,
                blood_group.title,
                '
                ;
            $result   = $this->ReportsModel->get_Degree_Export($field,'student_record',$where,$like,$custom);
			foreach ($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='Degree_GrandReport.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
			endif;	    
        endif;  
       
            $this->data['ReportName']   = 'Degree Report';
            $this->data['page']         = "reports/degree_report";
            $this->data['title']        = 'Degree Report | ECMS';
            $this->load->view('common/common',$this->data); 
      }
        public function adminRecord(){
            
 
            
            $this->load->library('Pdf');
            
            
            $where = array('sub_pro_id'=>'1','s_status_id'=>'5');
            $data = $this->CRUDModel->get_where_result('student_record',$where);
            //echo '<pre>';print_r($data);die;
            // create new PDF document
            $pdf = new TCPDF('L', 'mm', 'A5', true, 'UTF-8', false);
            // set default font subsetting mode
            $pdf->setFontSubsetting(true);
            
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 9, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


        $footer_image_file = 'assets/images/students/0300.jpg';
        $footer_logo_html = '<div><img height="100px" src="' . $footer_image_file . '" /></div>';
      //  $pdf->writeHTML($footer_logo_html, true, 0, true, 0);
       // $pdf->Output ( 'image_and_html.pdf', 'I' );
        


        $tbl_header = '<br/><table style="width: 638px;" cellspacing="0">';
        $tbl_footer = '</table>';
        $tbl = '';

        foreach($data as $query2){
        $college_no = $query2->college_no;
        $img = $query2->applicant_image;
        $name = $query2->student_name;
        $fname = $query2->father_name;
         
       
//$pdf->Image('@' . $imgs);
        
        //$pdf->Image ( "assets/images/students/'.$img.'" );   
        $tbl .= '
             
            <tr>
                <td style="border: 1px solid #000000; width: 50px;">'.$college_no.'</td>
                <td style="border: 1px solid #000000; width: 120px; text-align:left">'.$name.'</td>
                <td style="border: 1px solid #000000; width: 120px; text-align:left">'.$fname.'</td>
            </tr>
        ';}

        $pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');


        $pdf->Output('test.pdf');
        
        }
        public function adminRecordx(){
            '<td style="border: 1px solid #000000; width: 100px;"><img src="assets/images/students/'.$img.'" height="42" width="42" ></td>';
             $this->load->library('Pdf');
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Pdf Example');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->Write(5, 'CodeIgniter TCPDF Integration');
            $pdf->Output('pdfexample.pdf', 'I');
            
             
        }
        public function imageResize(){
            
            
            $this->db->select('student_id,applicant_image');
            $this->db->from('student_record');
            $this->db->where('s_status_id',5);
           $query = $this->db->get()->result(); 
           
             
           foreach($query as $queryRow):
               
               $oldRecord =  $queryRow->applicant_image;
           echo base_url('assets/images/students/').$oldRecord;
               if(!empty($oldRecord)):
                    $explode = explode(".",$oldRecord);
              
                    $newName =  $explode[0].'_thumb.'.$explode[1];
                    $where = array('student_id'=>$queryRow->student_id);
                    $data = array('applicant_image'=>$newName);
                   // $this->CRUDModel->update('student_record',$data,$where);
                    $path = base_url('assets/images/students/').$oldRecord;
                    
                    //unlink($path);
               endif;
           
           
           endforeach;
           die;
           
            echo '<pre>';print_r($query);die;
            
            $this->load->library('image_lib');
            $directory = "D:/xampp/htdocs/ECMS/assets/images/students/";
            $images = glob($directory."*.jpg");
            
             echo '<pre>';print_r($images);die;
             
             foreach($images as $path){
                 //echo '<pre>'.$path;
                $this->CRUDModel->do_resize($path);
             }
            
            die;
            $where = array('s_status_id'=>5);
            $query =$this->CRUDModel->get_where_result('student_record',$where);
             
                    //$config['source_image']     = base_url('assets/images/students/0035.jpg');
               
                    
                    
                    //$filename = $this->input->post('new_val');
                 echo    $source_path = base_url('assets/images/students/0133.jpg');
                 echo    $target_path = base_url('assets/images/students/thum/');
                    $config_manip = array(
                        'image_library' => 'gd2',
                        'source_image' => $source_path,
                        'new_image' => $target_path,
                        'maintain_ratio' => TRUE,
                        'create_thumb' => TRUE,
                        'thumb_marker' => '_thumb',
                        'width' => 150,
                        'height' => 150
                    );
                    $this->load->library('image_lib', $config_manip);
                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    }
                    // clear //
                    $this->image_lib->clear();
             die;
            echo '<pre>';print_r($query);die;
        }
        public function searchByDate(){
       
             $where = array('s_status_id'=>'5');
            $datewise = $this->ReportsModel->datewise('student_record',$where);
            
            echo '<pre>';print_r($datewise);die;
             
            
        }
        public function uploadimage(){
            if($this->input->post()):
            $upload_conf = array(
            'upload_path'   => realpath('assets/test/'),
            'allowed_types' => 'gif|jpg|jpeg|png',
            'max_size'      => '300000',
            'encrypt_name'  => true,
            );

            $this->load->library('upload');
            $this->upload->initialize( $upload_conf );
            $field_name =  $this->input->post('imageName'); 
            
            echo '<pre>';print_r($field_name);die;

            if ( !$this->upload->do_upload($field_name,'')){
                $error['upload']= $this->upload->display_errors();				
            }else{
                $upload_data = $this->upload->data();
                $resize_conf = array(
                    'upload_path'  => realpath('./assets/test/'),
                    'source_image' => $upload_data['full_path'], 
                    'new_image'    => $upload_data['file_path'].'/thumb/'.$upload_data['file_name'],
                    'width'        => 250,
                    'height'       => 250);

                $this->load->library('image_lib'); 
                $this->image_lib->initialize($resize_conf);

                // do it!
                if ( ! $this->image_lib->resize()){
                    // if got fail.
                    $error['resize'] = $this->image_lib->display_errors();						
                }else{
                    $data_to_store['ProfilePic'] = $upload_data['file_name'];						
                    $data1['ProfilePic'] = $upload_data['file_name'];
                    $this->session->set_userdata($data1);
                }	
            }
                else:
            $this->load->view('addimage');
             endif;
        }
        public function uplodImg(){
           
            $file_name =$this->input->post('imageName'); 
            $config = array(
            'upload_path'=> 'assets/test/',
            'allowed_types'=>'jpg|jpeg|png|gif|mp4|3gp|flv|mp3|doc|docx|rar',
            'max_size'=>'900000000000'
        );

        $this->load->library('upload', $config);
        $this->upload->do_upload($file_name);
        

            if ( !$this->upload->do_upload($file_name)){
                $error['upload']= $this->upload->display_errors();
                
            }else{
                
                $upload_data = $this->upload->data();
                 
             
                $resize_conf = array(
                    'upload_path'  => realpath('./assets/test/'),
                    'source_image' => $upload_data['full_path'], 
                    'new_image'    => $upload_data['file_path'].'/thumb/'.$upload_data['file_name'],
                    'width'        => 250,
                    'height'       => 250);
   echo '<pre>';print_r($resize_conf);die;
                $this->load->library('image_lib'); 
                $this->image_lib->initialize($resize_conf);

                // do it!
                if ( ! $this->image_lib->resize()){
                    // if got fail.
                    $error['resize'] = $this->image_lib->display_errors();						
                }else{
                    $data_to_store['ProfilePic'] = $upload_data['file_name'];						
                    $data1['ProfilePic'] = $upload_data['file_name'];
                    $this->session->set_userdata($data1);
                }	
            }
        }
        public function teacher_subject_wise_report_degree_graphic(){
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode');
                $empname    = $this->input->post('emp_id');
                $where      = array(
                                'hr_emp_record.emp_id'=>$emp_id,
                                'programe_id'=>4,
                            );
                $this->data['empname']  = $empname;
                $this->data['empId']    = $emp_id;
                $this->data['result']   = $this->ReportsModel->get_teacher_subjects($where);
            endif;
            
        $this->data['page_title']       = 'Teacher Subject Wise Report Inter | ECMS';
        $this->data['page']             =  'reports/TSWRDG';
        $this->load->view('common/common',$this->data); 
        }
        public function teacher_subject_wise_report_degree_students(){
  
            $uri2       = $this->uri->segment(2);
            $uri3       = $this->uri->segment(3);
            $uri4       = $this->uri->segment(4);
            if($uri3    == 1):
                else:
                 $where = array(
                     'sec_id'=>$uri2
                    );
                $this->data['result'] = $this->ReportsModel->get_teacher_subjects_student($where);
            endif;
            
            $this->data['page_title']       = 'Teacher Subject Wise Report Degree Students | ECMS';
            $this->data['page']             =  'reports/TSWRDS';
            $this->load->view('common/common',$this->data); 
        }
        public function student_attendance_report_inter(){
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                $where = array(
                    'hr_emp_record.emp_id'  =>$emp_id,
                    'programe_id'           =>1,
                        );
                $this->data['empname']      = $empname;
                $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
               
            endif;
            $this->data['program']          = 'Inter';
            $this->data['page_title']       = 'Student Attendance Report Inter | ECMS';
            $this->data['page']             =  'reports/SARD';
            $this->load->view('common/common',$this->data); 
        }
        public function student_attendance_report_degree(){
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                $where = array(
                    'hr_emp_record.emp_id'  =>$emp_id,
                    'programe_id'           =>4,
                        );
                $this->data['empname']      = $empname;
                $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
               
            endif;

            $this->data['page_title']       = 'Student Attendance Report Degree | ECMS';
            $this->data['program']          = 'Degree';
            $this->data['page']             =  'reports/SARD';
            $this->load->view('common/common',$this->data); 
        }
        public function student_attendance_report_bcs(){
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                $where = array(
                    'hr_emp_record.emp_id'  =>$emp_id,
                    'programe_id'           =>2,
                        );
                $this->data['empname']      = $empname;
                $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
               
            endif;

            $this->data['page_title']       = 'Student Attendance Report BCS | ECMS';
            $this->data['program']          = 'BCS';
            $this->data['page']             =  'reports/SARD';
            $this->load->view('common/common',$this->data); 
        }
        public function student_attendance_report_hnd(){
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                $where = array(
                    'hr_emp_record.emp_id'  =>$emp_id,
                    'programe_id'           =>3,
                        );
                $this->data['empname']      = $empname;
                $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
               
            endif;

            $this->data['page_title']       = 'Student Attendance Report HND | ECMS';
            $this->data['program']          = 'HND';
            $this->data['page']             =  'reports/SARD';
            $this->load->view('common/common',$this->data); 
        }
        public function student_attendance_report_alevel(){
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                $where = array(
                    'hr_emp_record.emp_id'  =>$emp_id,
                    'programe_id'           =>5,
                        );
                $this->data['empname']      = $empname;
                $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
               
            endif;

            $this->data['page_title']       = 'Student Attendance Report A-level | ECMS';
            $this->data['program']          = 'A-level';
            $this->data['page']             =  'reports/SARD';
            $this->load->view('common/common',$this->data); 
        }
        public function student_attendance_report_degree_result(){
 
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
                $this->data['result'] = $this->ReportsModel->get_teacher_subjects_student_degree_section($where);
            else:
                $where = array(
                     'student_subject_alloted.section_id'=>$uri2,
                     'student_subject_alloted.subject_id'=>$uri3
                    );
              $this->data['result'] = $this->ReportsModel->get_teacher_subjects_student_degree_subjects($where);
            endif;
             $this->data['program']          = 'Degree';
            $this->data['page_title']       = 'Student Attendance Report Degree Result | ECMS';
            $this->data['page']             =  'reports/SARDR';
            $this->load->view('common/common',$this->data); 
        }
    
    public function student_attendance_report_grand_practical(){
 
            $uri2 = $this->uri->segment(2);
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            
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
                $this->data['group'] = $this->CRUDModel->get_where_row('practical_group',array('prac_group_id'=>$uri2));
                $this->data['subject'] = $this->CRUDModel->get_where_row('practical_subject',array('prac_subject_id'=>$uri3));
                $where = array('group_id'=>$uri2);
                $this->data['result'] = $this->ReportsModel->get_teacher_subjects_student_practical($where);
             $this->data['program']          = 'Degree';
            $this->data['page_title']       = 'Student Attendance Report Practical | ECMS';
            $this->data['page']             =  'reports/SARGP';
            $this->load->view('common/common',$this->data); 
        }
    
    
        public function student_attendance_white_card_grand_gui(){
            
    
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes'));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name');
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
//            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
//                $where = '';
                $where['student_record.s_status_id !='] = 1;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    student_status.name as studentStatus,
                    college_no
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'White Card (GUI)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/whiteCard_GUI";
                $this->data['title']        = 'White Card (GUI) | ECMS';
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
            
            $this->data['ReportName']   = 'White Card (GUI)';
            $this->data['page']         = "reports/admin/whiteCard_GUI";
            $this->data['title']        = 'White Card  (GUI)| ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
        public function student_attendance_white_card_grand(){
            
    
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes'));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('status'=>'On'));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            $batch                          =  $this->input->post('batch');
       
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
            $this->data['student_name']     = '';
            $this->data['batchId']         = '';
            $this->data['father_name']      = '';
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($batch)):
                 $where['prospectus_batch.batch_id']  = $batch;
                $this->data['batchId']    = $batch;
            endif;
        
                
                $custom['column']       = 'student_record.college_no';
                $custom['order']        = 'asc';
                $where['student_record.s_status_id !='] = 1;
//                $where['student_record.s_status_id !='] = 1;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    student_record.programe_id,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    student_status.name as studentStatus,
                    college_no,
                    prospectus_batch.batch_name,
                    ';

                $this->data['result']       = $this->ReportsModel->admin_grand_report($field,'student_record', $where,$like,$custom);
//                $this->data['ReportName']   = 'White Card (Grand)';
                $this->data['countResult']  = count($this->data['result']);
//                $this->data['page']         = "reports/whiteCard";
//                $this->data['title']        = 'White Card (Grand) | ECMS';
//                $this->load->view('common/common',$this->data); 
//         
//                    
//            else:
       
         
            
           
                
           endif; 
            
            $this->data['ReportName']   = 'White Card (Grand)';
            $this->data['page']         = "reports/admin/whiteCard";
            $this->data['title']        = 'White Card  (Grand)| ECMS';
            $this->load->view('common/common',$this->data); 
            
        }
        public function student_attendance_white_card_hnd(){
            
    
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>3));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>3));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('program_id'=>3));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>3));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']     = '';
           
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
//                $where['student_record.s_status_id'] = 5;
           
                
                
                
                
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    student_status.name as studentStatus,
                    college_no,batch_name,
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'White Card (HND)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/admin/whiteCard";
                $this->data['title']        = 'White Card (HND) | ECMS';
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
            
            $this->data['ReportName']   = 'White Card (HND)';
            $this->data['page']         = "reports/admin/whiteCard";
            $this->data['title']        = 'White Card  (HND)| ECMS';
            $this->load->view('common/common',$this->data); 
            endif; 
            
            
            
            
        }
        public function student_attendance_white_card_bba(){
            
    
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>6));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>6));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('program_id'=>6));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>6));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']     = '';
           
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
//                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    student_status.name as studentStatus,
                    college_no,batch_name
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'White Card (BBA)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/admin/whiteCard";
                $this->data['title']        = 'White Card (BBA) | ECMS';
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
            
            $this->data['ReportName']   = 'White Card (BBA)';
            $this->data['page']         = "reports/admin/whiteCard";
            $this->data['title']        = 'White Card  (BBA)| ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
        public function student_attendance_white_card_inter(){
            
    
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>1));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>1));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('program_id'=>1,'status'=>'On'));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>1));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']     = '';
           
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
//                $where['student_record.s_status_id !='] = 1;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    student_status.name as studentStatus,
                    college_no,batch_name
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'White Card (Inter)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/admin/whiteCard";
                $this->data['title']        = 'White Card (Inter) | ECMS';
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
            
            $this->data['ReportName']   = 'White Card (Inter)';
            $this->data['page']         = "reports/admin/whiteCard";
            $this->data['title']        = 'White Card  (Inter)| ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
        public function student_attendance_white_card_degree(){
            
    
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>4));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>4));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('program_id'=>4,'status'=>'On'));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
//            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
//                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    student_status.name as studentStatus,
                    college_no
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'White Card (Degree)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/whiteCard";
                $this->data['title']        = 'White Card (Degree) | ECMS';
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
            
            $this->data['ReportName']   = 'White Card (Degree)';
            $this->data['page']         = "reports/whiteCard";
            $this->data['title']        = 'White Card (Degree) | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
        public function student_attendance_white_card_law(){
            
    
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>9));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>9));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('program_id'=>9));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>9));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']     = '';
           
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
//                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    student_status.name as studentStatus,
                    college_no,batch_name,
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'White Card (Law)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/admin/whiteCard";
                $this->data['title']        = 'White Card (Law) | ECMS';
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
            
            $this->data['ReportName']   = 'White Card (Law)';
            $this->data['page']         = "reports/admin/whiteCard";
            $this->data['title']        = 'White Card (Law) | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
        
        public function student_attendance_white_card_print_old(){
            
            $studentId = $this->uri->segment(2);
            $sectionId = $this->uri->segment(3);
            
            $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId));
            if($CheckStd):
                $this->data['class_id'] =  $CheckStd->class_id;
                $this->data['flag']     =  $CheckStd->flag;
//            echo '<pre>';print_r($CheckStd);die;
            //flag == 1 group_allot
            //flag == 2 subject allot
            if($CheckStd->flag==1):
               $this->data['result']           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$studentId,'student_group_allotment.section_id'=>$sectionId)); 
            else:
                $this->data['result']           = $this->ReportsModel->get_whiteCard_section(
                        array(
                            'student_subject_alloted.student_id'=>$studentId,
                            'student_subject_alloted.section_id'=>$sectionId
                        )); 
           endif;
          
            endif; 
            
          
            $this->data['program']          = 'White card Print';
            $this->data['page_title']       = 'Student white card | ECMS';
            $this->data['page']             =  'reports/whiteCardPrint';
            $this->load->view('common/common',$this->data); 
        }
        public function student_attendance_white_card_print(){
            $studentId                      = $this->uri->segment(2);
            $this->data                     = $this->WhiteCardModel->StudentWhiteCard($studentId);
            $this->data['program']          = 'White card Print';
            $this->data['page_title']       = 'Student white card | ECMS';
            $this->data['page']             =  'reports/whitecards/gernal_white_print';
            $this->load->view('common/common',$this->data); 
        }
        public function student_attendance_white_card_print_2(){
            

            $studentId                      = $this->uri->segment(2);
            $this->data                     = $this->WhiteCardModel->StudentWhiteCard($studentId);
            // echo '<pre>';print_r($this->data);die;
            $this->data['program']          = 'White card Print';
            $this->data['page_title']       = 'Student white card | ECMS';
            $this->data['page']             =  'reports/whitecards/gernal_white_print2';
            $this->load->view('common/common',$this->data); 
        }
        public function student_attendance_white_card_print_A(){
            $studentId = $this->uri->segment(2);
             $sectionId = $this->uri->segment(3);
            
            $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId));
            if($CheckStd):
                // $this->data['class_id'] =  $CheckStd->class_id;
                // $this->data['flag']     =  $CheckStd->flag;
//            echo '<pre>';print_r($CheckStd);die;
                //flag == 1 group_allot
                //flag == 2 subject allot
                if($CheckStd->flag==1):
                        $result           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$studentId,'student_group_allotment.section_id'=>$sectionId)); 
                else:
                        $result           = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$studentId,'student_subject_alloted.section_id'=>$sectionId)); 
                endif;
                $return_array = array(); // final return array
                if(isset($result) && !empty($result)):
                    $fy_id          = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
            // Create Array for Months $month_array
                    $montts_array   = array();
                    $time           = strtotime($fy_id->year_start);
                        $montts_array[] = 'Subject';
                            for($i=1;$i<=12;$i++):
                                $monthi = '+'.$i.'month';
                                $month  = date("M-y", strtotime($monthi, $time));
                                $montts_array[] = $month;
                            endfor;
                        $montts_array[] = 'Total';    
                        $return_array[] = $montts_array;    

            // Get student subjects 
                    if($CheckStd->flag ==1):
                        $this->data['classSubjects'] =  $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$result->sec_id)); //Class wise ( Medical , Engi CS , all BS)
                     endif;
                     if($CheckStd->flag == 2):
                        $this->data['classSubjects'] = $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id)); // Subject Wise (Arts ,A-level)
                     endif;
                     if(isset($classSubjects) && !empty($classSubjects)):
                        $netPresent = '';
                        $netTotal   = '';
            // Create Subject Array $subject_array  with attendance
                        foreach($classSubjects as $rowCS):
                            $GrandTotal = 0;
                            $granPresent = 0;
                            $subject_array = array();
                            $subject_array[] = substr($rowCS->title,0,20); // Subject Name.
                            for($i=1;$i<=12;$i++):
                                $monthi     = '+'.$i.'month';
                                $month      = date("m", strtotime($monthi, $time));
                                $year       = date("Y", strtotime($monthi, $time));
                                $where      = array(
                                    'subject_id'                => $rowCS->subject_id,
                                    'student_id'                =>$result->student_id,
                                    'month(attendance_date)'    =>$month,
                                    'year(attendance_date)'     =>$year,
                                );
                                $stdAtts = $this->ReportsModel->get_student_att($where);
                                $p=0;
                                $a=0;
                            // Each Subject Attendance count, Absent and Present
                                foreach($stdAtts as $stdAtt):
                                    if($stdAtt->status == 1):
                                        if($stdAtt->ca_classcount ==2):
                                            $p++; $p++;
                                        else:
                                            $p++;
                                        endif;
                                    else:
                                        if($stdAtt->ca_classcount ==2):
                                            $a++; $a++;
                                        else:
                                            $a++;
                                        endif;
                                    endif;
                                endforeach;
                                $total = $a+$p;
                                if($total):
                                    $subject_array[]    = $p.'/'.$total;
                                    $granPresent        += $p; 
                                    $GrandTotal         += $total;
                                else:
                                    $subject_array[]   = '';
                                endif;
                                
                                $per             = 0; 
                                 if(isset($GrandTotal) && !empty($GrandTotal)):
                                  $per = ($granPresent/$GrandTotal)*100;
                                 endif;
 
                            endfor;
                            $netPresent += $granPresent;
                            $netTotal   += $GrandTotal;
 
                            $subject_array[]    = $granPresent.'/'.$GrandTotal.'='.round($per,1)  ;
                            $return_array[]     = $subject_array;
                        endforeach;
                        
                     endif;
            // Create Final Array for Each Month and Grand Total 

                    $total_array[]     = '% age';
                    $final_total       = 0;
                    $final_total_a     = 0;
                    $final_total_p     = 0;

                    for($ti=1;$ti<=12;$ti++):
                        $monthti     = '+'.$ti.'month';
                        $month      = date("m", strtotime($monthti, $time));
                        $year       = date("Y", strtotime($monthti, $time));
                        $gfoter_total  = 0 ; 
                        if(isset($classSubjects) && !empty($classSubjects)):
                            $foter_p = 0;
                            $foter_a = 0;
                            $foter_total = 0;
                            foreach($classSubjects as $ta_row):
                                $where_ta= array(
                                    'subject_id'                => $ta_row->subject_id,
                                    'student_id'                =>$result->student_id,
                                    'month(attendance_date)'    =>$month,
                                    'year(attendance_date)'     =>$year,
                                );
                                
                                $QueryTotal = $this->ReportsModel->get_student_att($where_ta);
                                
                                if(isset($QueryTotal) && !empty($QueryTotal)):
                                    $tp=0;
                                    $ta=0;
                                    
                                    foreach($QueryTotal as $TTRow):
                                        if($TTRow->status == 1):
                                            if($TTRow->ca_classcount ==2):
                                                $tp++;
                                                $tp++;
                                            else:
                                                $tp++;
                                            endif;
                                        else:
                                            if($TTRow->ca_classcount ==2):
                                                $ta++;
                                                $ta++;
                                            else:
                                                $ta++;
                                            endif;
                                        endif;
                                    endforeach;
                                    $foter_p += $tp;
                                    $foter_a += $ta;
                                endif;
                            endforeach;
                            $foter_total = $foter_a+$foter_p;                           //Each Month Total
                            if(isset($foter_total) && !empty($foter_total)):            
                                $gfoter_total = round(($foter_p/$foter_total)*100,1).' %';   //Each Month Per%
                            else:
                                $gfoter_total = '';
                            endif;
                            $final_total_a     += $foter_a;
                            $final_total_p     += $foter_p;
                         endif;  
                        $total_array[]     = $gfoter_total;
                    endfor;
                    $final_total = $final_total_a+$final_total_p;                       //Final Total 
                    if(isset($final_total) && !empty($final_total)):
                        $total_array[]     = $final_total_p.'/'.$final_total.' = '.round(($final_total_p/$final_total)*100,1).' %'; // Final Total Result
                    else:
                        $total_array[]     = ''; 
                    endif;
                    $return_array[] = $total_array;
                endif;
            endif; 
            $this->data['result']       = $result;
            $this->data['Attendance']   = $return_array;
          
            $this->data['program']          = 'White card Print';
            $this->data['page_title']       = 'Student white card | ECMS';
            $this->data['page']             =  'reports/whitecards/gernal_white_print';
            $this->load->view('common/common',$this->data); 
        }
        
      

        public function student_attendance_white_card_teacher(){
            
            $studentId = $this->uri->segment(2);
            $sectionId = $this->uri->segment(3);
            
            $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId));
            if($CheckStd):
                $this->data['class_id'] =  $CheckStd->class_id;
                $this->data['flag']     =  $CheckStd->flag;
//            echo '<pre>';print_r($CheckStd);die;
            //flag == 1 group_allot
            //flag == 2 subject allot
            $this->data['fines'] = $this->ReportsModel->get_disciplinary_actions(array('student_id' => $studentId));
                
            if($CheckStd->flag==1):
               $this->data['result']           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$studentId,'student_group_allotment.section_id'=>$sectionId)); 
                
                else:
                    
                $this->data['result']           = $this->ReportsModel->get_whiteCard_section(
                        array(
                            'student_subject_alloted.student_id'=>$studentId,
                            'student_subject_alloted.section_id'=>$sectionId
                        )); 
           
            endif;
          
            endif; 
            
          
            $this->data['program']          = 'White card Print';
            $this->data['page_title']       = 'Student white card | ECMS';
            $this->data['page']             =  'reports/whiteCardTeacherwise';
            $this->load->view('common/common',$this->data); 
        }
        
        public function teacher_missing_test_inter(){
            
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                
                $where['programe_id']    = 1;
                if(!empty($emp_id)):
                    $where['hr_emp_record.emp_id'] = $emp_id;
                endif;
                
               // $this->data['empname']      = $empname;
            //    $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_intteacher_subjects($where);
               
            endif;
            
            $this->data['page_title']       = 'Teacher Missing Test Inter | ECMS';
            $this->data['program']          = 'Teacher Test Attendance Inter';
            $this->data['page']             =  'reports/TMSI';
            $this->load->view('common/common',$this->data); 
        }
        public function teacher_missing_test_degree(){
            
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                $where = array(
                                'hr_emp_record.emp_id'  =>$emp_id,
                                 'programe_id'           =>4,
                        );
                $this->data['empname']      = $empname;
                $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
               
            endif;
            
            $this->data['page_title']       = 'Teacher Missing Test Degree | ECMS';
            $this->data['program']          = 'Teacher Test Attendance Degree';
            $this->data['page']             =  'reports/TMSI';
            $this->load->view('common/common',$this->data); 
        }
        public function teacher_missing_test_hnd(){
            
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                $where = array(
                                'hr_emp_record.emp_id'  =>$emp_id,
                                 'programe_id'           =>3,
                        );
                $this->data['empname']      = $empname;
                $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
               
            endif;
            
            $this->data['page_title']       = 'Teacher Missing Test HND | ECMS';
            $this->data['program']          = 'Teacher Test Attendance HND';
            $this->data['page']             =  'reports/TMSI';
            $this->load->view('common/common',$this->data); 
        }
        public function teacher_missing_test_bcs(){
            
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                $where = array(
                                'hr_emp_record.emp_id'  =>$emp_id,
                                 'programe_id'           =>2,
                        );
                $this->data['empname']      = $empname;
                $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
               
            endif;
            
            $this->data['page_title']       = 'Teacher Missing Test bcs | ECMS';
            $this->data['program']          = 'Teacher Test Attendance BCS';
            $this->data['page']             =  'reports/TMSI';
            $this->load->view('common/common',$this->data); 
        }
        public function teacher_missing_test_alevel(){
            
            if($this->input->post()):
                $emp_id     = $this->input->post('emp_idCode_report');
                $empname    = $this->input->post('emp_id_report');
                $where = array(
                                'hr_emp_record.emp_id'  =>$emp_id,
                                 'programe_id'           =>5,
                        );
                $this->data['empname']      = $empname;
                $this->data['empId']        = $emp_id;
                $this->data['result']       = $this->ReportsModel->get_teacher_subjects($where);
               
            endif;
            
            $this->data['page_title']       = 'Teacher Missing Test A-level | ECMS';
            $this->data['program']          = 'Teacher Test Attendance A-level';
            $this->data['page']             =  'reports/TMSI';
            $this->load->view('common/common',$this->data); 
        }
        public function teacher_missing_test_result(){
            
            $uri2 = $this->uri->segment(2);
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $uri5 = $this->uri->segment(5);
            $uri6 = $this->uri->segment(6);
     
                $this->data['month_name'] = date_format(date_create($this->uri->segment(7)),'M-Y');
       
            $month =  date_format(date_create($this->uri->segment(7)),'m');
            $year =  date_format(date_create($this->uri->segment(7)),'Y');
            
            $this->data['empyee_name']      = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$uri4));
            $this->data['sections']         = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$uri2));
            $this->data['subject']          = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$uri3));
         
               if($uri5==1):
                    
                   $where = array(
                        'sec_id'=>$uri2,
                        's_status_id'=>5,
                       
                    );
                 $section_result  = $this->ReportsModel->section_wise_students($where);
//              echo '<pre>';print_r($section_result);die;
                if(@$section_result):
                     $result = array();
                 foreach(@$section_result as $secRow):

                     $where = array(
                         'monthly_test.test_id'         =>$uri6,
                         'student_id'                   =>$secRow->student_id,
                         'month(monthly_test.test_date)'=>$month,
                         'year(monthly_test.test_date)' =>$year
                         );
                      $stdMarks = $this->ReportsModel->get_student_result_month_wise($where);
                
                 if(@$stdMarks->omarks):
                     $per = (@$stdMarks->omarks/@$stdMarks->tmarks)*100;
                 else:
                     $per = '';
                 endif;     
                 
                      
                 $result[]=array(
                         'student_id'   =>$secRow->student_id,
                         'student_name' =>$secRow->student_name,
                         'father_name'  =>$secRow->father_name,
                         'college_no'   =>$secRow->college_no,
                         'sectionName'  =>$secRow->sectionName,
                         'obmarks'      =>@$stdMarks->omarks,
                         'totlmarks'    =>@$stdMarks->tmarks,
                         'pre'          =>round($per,1),
                         );
                     
                 endforeach;
                endif;
             
                
            else:
                
                $where = array(
                     'student_subject_alloted.section_id'=>$uri2,
                     'student_subject_alloted.subject_id'=>$uri3
                    );
              $subject_result = $this->ReportsModel->subject_wise_students($where);
              if($subject_result):
                  $result = array();
                 foreach($subject_result as $secRow):

                     $where = array(
                         'monthly_test.test_id'         =>$uri6,
                         'student_id'                   =>$secRow->student_id,
                         'month(monthly_test.test_date)'=>$month,
                         'year(monthly_test.test_date)' =>$year
                         );
                      $stdMarks = $this->ReportsModel->get_student_result_month_wise($where);
                
                 if(@$stdMarks->omarks):
                     $per = (@$stdMarks->omarks/@$stdMarks->tmarks)*100;
                 else:
                     $per = '';
                 endif;     
                 
                      
                 $result[]=array(
                         'student_id'   =>$secRow->student_id,
                         'student_name' =>$secRow->student_name,
                         'father_name'  =>$secRow->father_name,
                         'college_no'   =>$secRow->college_no,
                         'sectionName'  =>$secRow->sectionName,
                         'obmarks'      =>@$stdMarks->omarks,
                         'totlmarks'    =>@$stdMarks->tmarks,
                         'pre'          =>round($per,1),
                         );
                     
                 endforeach; 
              endif;
                
            endif;
            
            $this->data['result']           = json_decode(json_encode($result), false) ;
            $this->data['program']          = 'Inter';
            $this->data['page_title']       = 'Teacher Missing Test| ECMS';
            $this->data['page']             =  'reports/TMSR';
            $this->load->view('common/common',$this->data); 
        }
        public function student_position_wise_inter(){
         
                $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>1));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>1));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('program_id'=>1,'status'=>'On'));
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            $this->data['fromDate']  = date('Y-m-d');
            $this->data['toDate']    = date('Y-m-d');
        
           
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    college_no
                    ';

//                $result       = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['result']           = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['sectionNames']     = $this->ReportsModel->position_report_std($field,'student_record', array('sections.sec_id'=>$section));
                
//                echo '<pre>';print_r($result);die;
                $this->data['ReportName']   = 'Position Marks wise (Inter)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/Inter/reports/marksWise";
                $this->data['title']        = 'Position Marks wise (Inter) | ECMS';
                $this->load->view('common/common',$this->data); 
         
                    
            else:
       
            $this->data['studentId']        = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['genderId']         = '';
            $this->data['programId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']          = '';
            $this->data['ReportName']       = 'Position Marks wise (Inter)';
            $this->data['page']             = "reports/Inter/reports/marksWise";
            $this->data['title']            = 'Position Marks wise (Inter) | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
        public function student_position_wise_degree(){
         
            $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>4));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>4));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('program_id'=>4));
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            
      
            $this->data['fromDate']  = date('Y-m-d');
            $this->data['toDate']    = date('Y-m-d');
        
           
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'student_record.college_no';
                $custom['order']        = 'asc';
                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    college_no
                    ';

//                $result       = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['result']       = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['sectionNames']       = $this->ReportsModel->position_report_std($field,'student_record', array('sections.sec_id'=>$section));
                
//                echo '<pre>';print_r($result);die;
                $this->data['ReportName']   = 'Position Marks wise ( Degree )';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/Inter/reports/marksWise";
                $this->data['title']        = 'Position Marks wise ( Degree ) | ECMS';
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
            $this->data['ReportName']   = 'Position Marks wise ( Degree )';
            $this->data['page']         = "reports/Inter/reports/marksWise";
            $this->data['title']        = 'Position Marks wise ( Degree ) | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
        public function students_allotted_username_password(){
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
        $this->data['newsubprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender Status ', 'gender_id', 'title');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name');
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
            
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $college_no                     =  $this->input->post('college_no');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
            $limit                          =  $this->input->post('limit');
            $batch                          =  $this->input->post('batch');
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['genderId']         = '';
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['pictureId']          = '';
            $this->data['batchId']          = '';
            $where['student_status.s_status_id'] = 5;
           // $where['student_record.promotion_flag'] = 1;
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']     = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']          = $form_no;
                $this->data['form_no']      = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
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
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if($this->input->post('search')):          
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.student_password,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.sub_pro_id as sub_pro_id,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    sections.sec_id,
                    sections.name as sectionName,
                    domicile.name,
                    admission_date,
                    college_no
                    ';

        $this->data['result'] = $this->ReportsModel->grand_report($field,'student_record', $where,$like);
            endif;
        
        $this->data['ReportName']   = 'Student Allotted Username and Password';
        $this->data['page']        =  'reports/students_allotted_username_password';
        $this->data['title']        = 'Admin Student Lock Unlock Status | ECMS';
        $this->load->view('common/common',$this->data);  
    }
        Public function olevel_merit_list(){ 
            $wherePrg = array('status'=>'yes','programe_id'=>'1');
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',$wherePrg);
            $wheresPrg                      = array('status'=>'yes','programe_id'=>'1');
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',$wheresPrg);
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender Status ', 'gender_id', 'title');
            $this->data['batch']  = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'1'));
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
              
            $student_id =  $this->input->post('student_id');
            $batch_id =  $this->input->post('batch_id');
            $form_no    =  $this->input->post('form_no');
            $student_name =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender             =  $this->input->post('gender');
            $program            =  $this->input->post('program');
            $sub_program        =  $this->input->post('sub_program');
            $reserved_seat      =  $this->input->post('reserved_seat');
            $application_status =  $this->input->post('application_status');
            $limit              =  $this->input->post('limit');
            
            
            //like Array
            $like = '';
            $where = '';
            $this->data['studentId'] = '';
            $this->data['batch_id'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']  = '';
            $this->data['programId']  = '';
            $this->data['subprogramId']  = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
                $this->data['father_name'] =$father_name;
            endif;
 
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['studentId']  = $student_id;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']  = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no'] = $form_no;
                $this->data['form_no']  = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']  = $program;
            endif;
            if(!empty($batch_id)):
                 $where['student_record.batch_id'] = $batch_id;
                $this->data['batch_id']  = $batch_id;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId']  = $sub_program;
            endif;
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id'] = $reserved_seat;
                $this->data['reserved_seatId']  = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
            $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
              
                if($limitVale):
                    $limitD = $limitVale->limit_value;
                else:
                    $limitD = 50;
                endif;
                $custom['limit']        = $limitD;
                $custom['start']        = 0;
               
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $this->data['limitId']  = $limit;
              
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    domicile.name,
                    admission_date,
                    ';
                $this->data['result'] = $this->ReportsModel->get_olevel_meritlist($field,'student_record', $where,$like,$custom);
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/olevel_merit_list";
                $this->data['title']        = 'O Level Merit List 2017 | ECMS';
                $this->load->view('common/common',$this->data); 
            
            elseif($this->input->post('export')):
                
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('O Level Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Student.ID');
                
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Student Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Program');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Batch no');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                
                $this->excel->getActiveSheet()->setCellValue('J1','Fata School');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Domicile');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Remarks 1');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','Remarks 2');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','Application status');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('O1','Religion');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
              
                $this->excel->getActiveSheet()->setCellValue('P1','Address');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('Q1','Grade Wise Subjects');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Percentage');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
               
                
       for($col = ord('A'); $col <= ord('R'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
    
            $result   = $this->ReportsModel->get_olevel_meritlistExport('student_record',$where,$like,$custom);
         
        foreach($result as $row){
                $exceldata[] = $row;               
        }
            
            
            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');

            $filename='olevel_meritList2017.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            $objWriter->save('php://output');
            
            elseif($this->input->post('print')):
          
                  $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    domicile.name
                    ';
                $this->data['result']   = $this->ReportsModel->get_meritlist($field,'student_record', $where,$like,$custom);
                $this->load->view('reports/print',$this->data); 
                    
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
            
            $this->data['page']         = "reports/olevel_merit_list";
            $this->data['title']        = 'O Level Report | ECMS';
            $this->load->view('common/common',$this->data); 
           endif; 
 
        }
        
       public function enrolled_student_record(){       
            
            $this->data['programe_id'] = '';
            $this->data['sub_pro_id'] = '';
            $this->data['batchId'] = '';
            $this->data['sec_id'] = '';
            $this->data['shft_id'] = '';
            $this->data['seat_id'] = '';
            $this->data['st_status_id'] = '';
            
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['seat']         = $this->CRUDModel->dropDown('reserved_seat', 'Admission Alloted in', 'rseat_id', 'name');
            $this->data['shift']        = $this->CRUDModel->dropDown('shift', 'Select Shift', 'shift_id', 'name');
            $this->data['s_status']     = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name');
            $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $where = array('student_record.s_status_id'=>'5');
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', '?? Select Limit  ?', 'limitId', 'limit_value');
            $config['base_url']         = base_url('ReportsController/enrolled_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            
            $config['per_page']         = 50;
            $config["num_links"]        = 3;
            $config['uri_segment']      = 3;
            
             //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the ?Digit?? Link
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            //For PREVIOUS PAGE Setup
            $config['prev_link']        = "<i class='fa fa-angle-left'></i>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
                        
            //For NEXT PAGE Setup
            $config['next_link']        = "<i class='fa fa-angle-right'></i>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            
            //For LAST PAGE Setup
            $config['last_link']        = "<i class='fa fa-angle-double-right'></i>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            
            //For CURRENT page on which you are
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            
            
            
            
//            $config['per_page']         = 50;
//            $config["num_links"]        = 3;
//            $config['uri_segment']      = 3;
//            $config['full_tag_open']    = "<ul class='pagination'>";
//            $config['full_tag_close']   = "</ul>";
//            $config['num_tag_open']     = '<li>';
//            $config['num_tag_close']    = '</li>';
//            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
//            $config['cur_tag_close']    = "</a></li>";
//            $config['next_tag_open']    = "<li>";
//            $config['next_tag_close']   = "</li>";
//            $config['prev_tag_open']    = "<li>";
//            $config['prev_tag_close']   = "</li>";
//            $config['first_tag_open']   = "<li>";
//            $config['first_tag_close']  = "</li>";
//            $config['last_tag_open']    = "<li>";
//            $config['last_tag_close']   = "</li>";
//            $config['first_link']       = "<i class='fa fa-angle-left'></i>";
//            $config['last_link']        = "<i class='fa fa-angle-right'></i>";

            $this->pagination->initialize($config);
            $page                       = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
            $this->data['pages']        = $this->pagination->create_links();
            $custom['column']    ='college_no';
            $custom['order']     ='asc';          
            $this->data['result']    = $this->ReportsModel->admin_stdData($config['per_page'], $page,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Students Record | ECMS';
           $this->data['page']         = 'reports/all_student_record';
           $this->load->view('common/common',$this->data);
    }
    
        public function enrolled_student_record_admission(){       
            
            $this->data['programe_id'] = '';
            $this->data['sub_pro_id'] = '';
            $this->data['batchId'] = '';
            $this->data['sec_id'] = '';
            $this->data['shft_id'] = '';
            $this->data['seat_id'] = '';
            $this->data['st_status_id'] = '';
            
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['shift']        = $this->CRUDModel->dropDown('shift', 'Select Shift', 'shift_id', 'name');
            $this->data['seat']         = $this->CRUDModel->dropDown('reserved_seat', 'Admission Alloted in', 'rseat_id', 'name');
            $this->data['s_status']     = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name');
            $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name',array('status'=>'on'));
            
		   $where = array('student_record.s_status_id'=>'5');
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', '?? Select Limit  ?', 'limitId', 'limit_value');
            $config['base_url']         = base_url('ReportsController/enrolled_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            
            $config['per_page']         = 50;
            $config["num_links"]        = 6;
            $config['uri_segment']      = 2;
            
             //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the ?Digit?? Link
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            //For PREVIOUS PAGE Setup
            $config['prev_link']        = "<i class='fa fa-angle-left'></i>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
                        
            //For NEXT PAGE Setup
            $config['next_link']        = "<i class='fa fa-angle-right'></i>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            
            //For LAST PAGE Setup
            $config['last_link']        = "<i class='fa fa-angle-double-right'></i>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            
            //For CURRENT page on which you are
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            
            
            
            
//            $config['per_page']         = 50;
//            $config["num_links"]        = 3;
//            $config['uri_segment']      = 3;
//            $config['full_tag_open']    = "<ul class='pagination'>";
//            $config['full_tag_close']   = "</ul>";
//            $config['num_tag_open']     = '<li>';
//            $config['num_tag_close']    = '</li>';
//            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
//            $config['cur_tag_close']    = "</a></li>";
//            $config['next_tag_open']    = "<li>";
//            $config['next_tag_close']   = "</li>";
//            $config['prev_tag_open']    = "<li>";
//            $config['prev_tag_close']   = "</li>";
//            $config['first_tag_open']   = "<li>";
//            $config['first_tag_close']  = "</li>";
//            $config['last_tag_open']    = "<li>";
//            $config['last_tag_close']   = "</li>";
//            $config['first_link']       = "<i class='fa fa-angle-left'></i>";
//            $config['last_link']        = "<i class='fa fa-angle-right'></i>";

            $this->pagination->initialize($config);
            $page                       = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
            $this->data['pages']        = $this->pagination->create_links();
            $custom['column']    ='college_no';
            $custom['order']     ='asc';          
            $this->data['result']    = $this->ReportsModel->admin_stdData($config['per_page'], $page,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Students Record | ECMS';
           $this->data['page']         = 'reports/all_student_record';
           $this->load->view('common/common',$this->data);
    }
    
         public function search_enrolled_student(){
            
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['status']           = $this->CRUDModel->dropDown('student_status', 'Student Status', 's_status_id', 'name');
            $this->data['shift']            = $this->CRUDModel->dropDown('shift', 'Select Shift', 'shift_id', 'name');
            $this->data['seat']             = $this->CRUDModel->dropDown('reserved_seat', 'Admission Alloted in', 'rseat_id', 'name');
            $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Select Section', 'sec_id', 'name',array('status'=>'On'));
            if($this->input->post('search')):
                $college_no     =  $this->input->post('college_no');
                $form_no        =  $this->input->post('form_no');
                $student_name   =  $this->input->post('student_name');
                $father_name    =  $this->input->post('father_name');
                $gender_id      =  $this->input->post('gender_id');
                $programe_id    =  $this->input->post('programe_id');
                $sub_pro_id     =  $this->input->post('sub_pro_id');
                $admission_in   =  $this->input->post('admission_in');
                $batch          =  $this->input->post('batch');
                $shift          =  $this->input->post('shift');
                $status         =  $this->input->post('status');
                $section        =  $this->input->post('section');
                $limit          =  $this->input->post('limit');

                //like Array
                $like = '';
                $where = '';
                $this->data['college_no']       = '';
                $this->data['batchId']          = '';
                $this->data['sectionId']        = '';
                $this->data['statusId']         = '';
                $this->data['form_no'] = '';
                $this->data['student_name'] = '';
                $this->data['father_name']  = '';
                $this->data['gender_id']  = '';
                $this->data['shft_id']  = '';
                $this->data['programe_id']  = '';
                $this->data['sub_pro_id']  = '';
                $this->data['seat_id']  = '';
                $this->data['limitId']  = '';


                if(!empty($college_no)):
                    $where['student_record.college_no'] = $college_no;
                    $this->data['college_no'] = $college_no;
                endif;
                if(!empty($batch)):
                     $where['student_record.batch_id'] = $batch;
                    $this->data['batchId'] = $batch;
                endif;
               if(!empty($status)):
                     $where['student_status.s_status_id'] = $status;
                    $this->data['statusId'] = $status;
                endif;
               if(!empty($section)):
                     $where['sections.sec_id']  = $section;
                    $this->data['sectionId']    = $section;
                endif;
                if(!empty($form_no)):
                    $where['student_record.form_no'] = $form_no;
                    $this->data['form_no'] =$form_no;
                endif;
                if(!empty($student_name)):
                    $like['student_record.student_name'] = $student_name;
                    $this->data['student_name'] =$student_name;
                endif;
                if(!empty($father_name)):
                    $like['student_record.father_name'] = $father_name;
                $this->data['father_name'] =$father_name;
                endif;
                if(!empty($gender_id)):
                    $where['gender.gender_id'] = $gender_id;
                    $this->data['gender_id']  = $gender_id;
                endif;
                if(!empty($shift)):
                    $where['shift.shift_id'] = $shift;
                    $this->data['shft_id']  = $shift;
                endif;
                if(!empty($admission_in)):
                    $where['reserved_seat.rseat_id'] = $admission_in;
                    $this->data['seat_id']  = $admission_in;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id'] = $programe_id;
                    $this->data['programe_id']  = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                    $this->data['sub_pro_id']  = $sub_pro_id;
                endif;
                $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));

                    if($limitVale):
                        $limitD = $limitVale->limit_value;
                    else:
                        $limitD = 50;
                    endif;
                    $custom['limit']        = $limitD;
                    $custom['start']        = 0;
                    $custom['column']       = 'student_record.college_no';
                    $custom['order']        = 'asc'; 
                    $this->data['limitId']  = $limit;

                    $this->data['result']   = $this->ReportsModel->get_admin_stdData('student_record',$where,$like);    
                    $this->data['page']     = "reports/search_enrolled_student_record";
                    $this->data['title']    = ' Student List | ECMS';
                    $this->load->view('common/common',$this->data);  
                    endif;
                    if($this->input->post('export')):    
                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    //name the worksheet
                    $this->excel->getActiveSheet()->setTitle('All Students');
                    //set cell A1 content with some text

                    $this->excel->getActiveSheet()->setCellValue('A1', 'F.No');
                    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

                    $this->excel->getActiveSheet()->setCellValue('B1', 'Name');
                    $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

                    $this->excel->getActiveSheet()->setCellValue('C1','F-Name');
                    $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

                    $this->excel->getActiveSheet()->setCellValue('D1', 'College #');
                    $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

                    $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                    $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

                    $this->excel->getActiveSheet()->setCellValue('F1','Batch');
                    $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

                    $this->excel->getActiveSheet()->setCellValue('G1','Program');
                    $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

                    $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
                    $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

                    $this->excel->getActiveSheet()->setCellValue('I1','Section');
                    $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

                    $this->excel->getActiveSheet()->setCellValue('J1','Status');
                    $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                    
                    $this->excel->getActiveSheet()->setCellValue('K1','Admission Alloted in');
                    $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
                    


           for($col = ord('A'); $col <= ord('K'); $col++){
                    //set column dimension
                    $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                     //change the font size
                    $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                    $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }

                $college_no       =  $this->input->post('college_no');
                $form_no       =  $this->input->post('form_no');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $gender_id             =  $this->input->post('gender_id');
                $programe_id            =  $this->input->post('programe_id');
                $sub_pro_id            =  $this->input->post('sub_pro_id');
                $batch               =  $this->input->post('batch');
                $status               =  $this->input->post('status');
                $admission_in              =  $this->input->post('admission_in');
                $section               =  $this->input->post('section');
                $limit               =  $this->input->post('limit');

                //like Array
                $like = '';
                $where = '';
                $this->data['college_no'] = '';
                $this->data['form_no'] = '';
                $this->data['student_name'] = '';
                $this->data['father_name']  = '';
                $this->data['gender_id']  = '';
                $this->data['programe_id']  = '';
                $this->data['sub_pro_id']  = '';
                $this->data['batchId']  = '';
                $this->data['seat_id']  = '';
                $this->data['sectionId']  = '';
                $this->data['statusId']  = '';
                $this->data['limitId']  = '';


                if(!empty($college_no)):
                    $where['student_record.college_no'] = $college_no;
                    $this->data['college_no'] = $college_no;
                endif;
                if(!empty($batch)):
                     $where['student_record.batch_id'] = $batch;
                    $this->data['batchId'] = $batch;
                endif;
               if(!empty($status)):
                     $where['student_status.s_status_id'] = $status;
                    $this->data['statusId'] = $status;
                endif;
               if(!empty($section)):
                     $where['sections.sec_id']  = $section;
                    $this->data['sectionId']    = $section;
                endif;
                if(!empty($form_no)):
                    $where['form_no'] = $form_no;
                    $this->data['form_no'] =$form_no;
                endif;
                if(!empty($student_name)):
                    $like['student_name'] = $student_name;
                    $this->data['student_name'] =$student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name'] = $father_name;
                $this->data['father_name'] =$father_name;
                endif;
                if(!empty($gender_id)):
                    $where['gender.gender_id'] = $gender_id;
                    $this->data['gender_id']  = $gender_id;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id'] = $programe_id;
                    $this->data['programe_id']  = $programe_id;
                endif;
                if(!empty($admission_in)):
                    $where['reserved_seat.rseat_id'] = $admission_in;
                    $this->data['seat_id']  = $admission_in;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                    $this->data['sub_pro_id']  = $sub_pro_id;
                endif;
                $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));

                    if($limitVale):
                        $limitD = $limitVale->limit_value;
                    else:
                        $limitD = 50;
                    endif;
                    $custom['limit']        = $limitD;
                    $custom['start']        = 0;
                    $custom['column']       = 'applicant_edu_detail.percentage';
                    $custom['order']        = 'desc';
                    $this->data['limitId']  = $limit;

                    $this->db->select('
                    student_record.form_no,
                    student_record.student_name,
                    student_record.father_name,
                    student_record.college_no,
                    gender.title as genderName,
                    prospectus_batch.batch_name as batch,
                    sub_programes.name as sub_program,
                    programes_info.programe_name as program,
                    sections.name as section,
                    student_status.name as student_status,
                    reserved_seat.name as seat,
                ');
                $this->db->FROM('student_record');
                $this->db->where($where);
                $this->db->order_by('applicant_edu_detail.percentage','desc');
                $this->db->group_by('student_record.student_id');
                $this->db->limit($custom['start'],$custom['limit']);
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id2', 'left outer');     
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                    $this->db->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer');
                    $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                    $this->db->join('religion','religion.religion_id=student_record.religion_id','left outer');
                $rs =  $this->db->get();
                    $exceldata="";
                    foreach ($rs->result_array() as $row)
                    {
                    $exceldata[] = $row;
                    }      

                    $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                    $filename='StudentList.xls'; 
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="'.$filename.'"');
                    header('Cache-Control: max-age=0'); 
                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                    $objWriter->save('php://output');
                    else:
                        $this->data['college_no'] = '';
                        $this->data['form_no'] = '';
                        $this->data['student_name'] = '';
                        $this->data['father_name']  = '';
                        $this->data['gender_id']  = '';
                        $this->data['sub_pro_id']  = '';
                        $this->data['programe_id']  = '';
                        $this->data['batchId']  = '';
                        $this->data['sectionId']  = '';
                        $this->data['statusId']  = '';
               endif; 
    }
    
    
    public function inter_merit_list_new(){
         
              //dropdown lists
            
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programe_id'=>1));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>1));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['reserved_seat3']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', '  Status ', 's_status_id', 'name',array('s_status_id'=>1));
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['shift']            = $this->CRUDModel->dropDown('shift', 'Select Shift ', 'shift_id', 'name');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('status'=>'On','program_id'=>1));
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
            
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>1));
            
            $college_no                     =  $this->input->post('college_no');
            $shift                          =  $this->input->post('shift');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $reserved_seat3                  =  $this->input->post('reserved_seat3');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
            $limit                          =  $this->input->post('limit');
            $batch                          =  $this->input->post('batch');
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']           = '';
            $this->data['shift_id']             = '';
            $this->data['form_no']              = '';
            $this->data['student_name']         = '';
            $this->data['father_name']          = '';
            $this->data['genderId']             = '';
            $this->data['programId']            = '';
            $this->data['sectionId']            = '';
            $this->data['subprogramId']         = '';
            $this->data['reserved_seatId']      = '';
            $this->data['reserved_seatId3']      = '';
            $this->data['application_statusId'] = '';
            $this->data['pictureId']            = '';
            $this->data['batchId']              = '';
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($reserved_seat3)):
                $where['rseats_id2']           = $reserved_seat3;
                $this->data['reserved_seatId3']   = $reserved_seat3;
            endif;
            if(!empty($shift)):
                $where['shift.shift_id']        = $shift;
                $this->data['shift_id']   = $shift;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']     = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']          = $form_no;
                $this->data['form_no']      = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
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
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;
            
            $where['student_status.s_status_id'] = 5;
 
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
 
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    sections.sec_id,
                    sections.name as sectionName,
                    domicile.name,
                    admission_date,
                    college_no,
                    shift.name as shift_name,
                    ';

                 $this->data['result']     = $this->ReportsModel->grand_report_new($field,'student_record', $where,$like,$custom);
               
                
                
 
             endif;
             
             
             
            if($this->input->post('export')):
                
                
                 $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                 
                $this->excel->getActiveSheet()->setCellValue('A1', 'College No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1','Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('C1', 'Father Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Program');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Section');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                
                 
                $this->excel->getActiveSheet()->setCellValue('G1','Total Marks');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Obtained Marks');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Percentage');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Address');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Mobile');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(12);
                
                 
            
                  
                
       for($col = ord('A'); $col <= ord('K'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }              
            
            $result   = $this->ReportsModel->grand_reportExportNew('student_record',$where,$like,$custom);
                
        foreach ($result as $row){
                $exceldata[] = $row;
                
            }
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='GrandReport_'.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif; 
           
           
            $this->data['ReportName']   = 'Enrolled Student ( FA / FSc )';
            $this->data['page']         = "reports/Inter/general_merilt_list_report";
            $this->data['title']        = 'Enrolled Student ( FA / FSc ) | ECMS';
            $this->load->view('common/common',$this->data); 
 
        }
       public function student_attendance_white_card_print_group(){
            
            $program    = $this->uri->segment(2);
            $sub_program = $this->uri->segment(3);
            $section    = $this->uri->segment(4);
            
            $this->data['program']      = $program;
            $this->data['subProgram']   = $sub_program;
            $this->data['section']      = $section;
            
            
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
            
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            $where['student_status.s_status_id'] = 5;
 
                
                $custom['column']       = 'student_record.college_no';
                $custom['order']        = 'asc';
  
                $this->data['all_result']       = $this->ReportsModel->white_card_group_wise( $where,$custom);
           // echo '<pre>';print_r($this->data['all_result']);die;
            $this->data['page_title']       = 'Student white card | ECMS';
            $this->data['page']             =  'reports/attendance/whiteCardPrintGroup';
            $this->load->view('common/common',$this->data); 
        }
        
       public function student_attendance_white_card_bcs(){
            
    
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>2));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>2));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('program_id'=>2,'status'=>'On'));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>2));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']     = '';
           
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
//                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    student_status.name as studentStatus,
                    college_no,batch_name
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'White Card (BS Computer Science)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/admin/whiteCard";
                $this->data['title']        = 'White Card (BCS) | ECMS';
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
            
            $this->data['ReportName']   = 'White Card (BS Computer Science)';
            $this->data['page']         = "reports/admin/whiteCard";
            $this->data['title']        = 'White Card  (BCS)| ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        } 
       public function student_attendance_white_card_alevel(){
            
    
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>5));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>5));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('program_id'=>5,'status'=>'On'));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>5));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']     = '';
           
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
//                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    student_status.name as studentStatus,
                    college_no,batch_name
                    ';

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'White Card (A Level)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/admin/whiteCard";
                $this->data['title']        = 'White Card (A Level) | ECMS';
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
            
            $this->data['ReportName']   = 'White Card (A Level)';
            $this->data['page']         = "reports/admin/whiteCard";
            $this->data['title']        = 'White Card  (A Level)| ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        } 

public function student_practical_white_card_group()
    {
            $group_id    = $this->uri->segment(2);
            $this->data['group_id']      = $group_id;       
            if(!empty($group_id)):
                 $where['practical_group.prac_group_id']  = $group_id;
                $this->data['group_id']    = $group_id;
            endif;
            $this->data['all_result'] = $this->ReportsModel->practical_white_card_group($where);
            $this->data['page_title']       = 'Students Practical white card | ECMS';
            $this->data['page']             =  'reports/practicalwhiteCardPrintGroup';
            $this->load->view('common/common',$this->data); 
    }
    
    public function student_position_wise_bcs(){
         
                $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>2));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>2));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>2));
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            
      
            $this->data['fromDate']  = date('Y-m-d');
            $this->data['toDate']    = date('Y-m-d');
        
           
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    college_no
                    ';
                $this->data['result']       = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['sectionNames']       = $this->ReportsModel->position_report_std($field,'student_record', array('sections.sec_id'=>$section));
                
                $this->data['ReportName']   = 'Position Marks wise (BCS)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/marksWiseBcs";
                $this->data['title']        = 'Position Marks wise (BCS) | ECMS';
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
            $this->data['ReportName']   = 'Position Marks wise (BCS)';
            $this->data['page']         = "reports/marksWiseBcs";
            $this->data['title']        = 'Position Marks wise (BCS) | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
    
    public function student_position_wise_bs_law(){
         
                $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>9));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>9));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>9));
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            
      
            $this->data['fromDate']  = date('Y-m-d');
            $this->data['toDate']    = date('Y-m-d');
        
           
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    college_no
                    ';
                $this->data['result']       = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['sectionNames']       = $this->ReportsModel->position_report_std($field,'student_record', array('sections.sec_id'=>$section));
                
                $this->data['ReportName']   = 'Position Marks wise (BS-Law)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/marksWiseBs_Law";
                $this->data['title']        = 'Position Marks wise (BS-Law) | ECMS';
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
            $this->data['ReportName']   = 'Position Marks wise (BS-Law)';
            $this->data['page']         = "reports/marksWiseBs_Law";
            $this->data['title']        = 'Position Marks wise (BS-Law) | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
    
    public function student_position_wise_bs_english(){
         
                $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>8));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>8));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>8));
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            
      
            $this->data['fromDate']  = date('Y-m-d');
            $this->data['toDate']    = date('Y-m-d');
        
           
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    college_no
                    ';
                $this->data['result']       = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['sectionNames']       = $this->ReportsModel->position_report_std($field,'student_record', array('sections.sec_id'=>$section));
                
                $this->data['ReportName']   = 'Position Marks wise (BS-English)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/marksWiseBs_English";
                $this->data['title']        = 'Position Marks wise (BS-English) | ECMS';
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
            $this->data['ReportName']   = 'Position Marks wise (BS-English)';
            $this->data['page']         = "reports/marksWiseBs_English";
            $this->data['title']        = 'Position Marks wise (BS-English) | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
    
    public function student_position_wise_a_level(){
         
                $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programes_info.programe_id'=>5));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>5));
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('program_id'=>5,'status'=>'On'));
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
           
            $this->data['fromDate']  = date('Y-m-d');
            $this->data['toDate']    = date('Y-m-d');
        
           
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
            
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $where['student_record.s_status_id'] = 5;
            
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    college_no
                    ';

//                $result       = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['result']           = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['sectionNames']     = $this->ReportsModel->position_report_std($field,'student_record', array('sections.sec_id'=>$section));
                
//                echo '<pre>';print_r($result);die;
                $this->data['ReportName']   = 'Position Marks wise (A-Level)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/marksWise_alevel";
                $this->data['title']        = 'Position Marks wise (A-Level) | ECMS';
                $this->load->view('common/common',$this->data); 
         
                    
            else:
       
            $this->data['studentId']        = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['genderId']         = '';
            $this->data['programId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']          = '';
            $this->data['ReportName']       = 'Position Marks wise (A-Level)';
            $this->data['page']             = "reports/marksWise_alevel";
            $this->data['title']            = 'Position Marks wise (A-Level) | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
        public function student_position_wise_fine_inter(){
         
        $this->data['sectionId']        = '';
        $this->data['sectionId']        = '';
        $this->data['fromDate']         = date('d-m-Y',strtotime('01-09-2018'));;
        $this->data['toDate']           = date('d-m-Y');
         
            $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', '', 'sec_id','name',array('status'=>'On','program_id'=>1));
            
        if($this->input->post('search')):
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
           
            $this->data['fromDate']  = date('d-m-Y');
            $this->data['toDate']    = date('d-m-Y');
        
           
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
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $where['student_record.s_status_id'] = 5;
            
            
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    college_no
                    ';
                $this->data['result']           = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
                $this->data['sectionNames']     = $this->ReportsModel->position_report_std($field,'student_record', array('sections.sec_id'=>$section));
//                echo '<pre>';print_r( $this->data['result']);die;
//                $this->data['ReportName']   = 'Position Marks wise Fine (Inter)';
                $this->data['countResult']  = count($this->data['result']);
//                $this->data['page']         = "reports/Inter/marks_wise_fine_inter_v";
//                $this->data['title']        = 'Position Marks wise (BCS) | ECMS';
//                $this->load->view('common/common',$this->data);      
            endif;
            
            $this->data['ReportName']   = 'Students Absentee Fine (Class Wise)';
            $this->data['page']         = "reports/Inter/student_fine_class_wise_v";
            $this->data['title']        = 'Students Absentee Fine (Class Wise)| ECMS';
            $this->load->view('common/common',$this->data); 
                
           
           
           
           
        }
 
    
    public function student_result_top_ten(){
         
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('programe_id'=>'1'));
            $this->data['sub_program'] = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>'1'));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('programe_id'=>'1'));
            $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            
            $this->data['programe_id']        = '';
            $this->data['sub_pro_id']        = '';
            $this->data['batch_id']        = '';
        
            if($this->input->post()):
            $programe_id =  $this->input->post('programe_id');
            $sub_pro_id =  $this->input->post('sub_pro_id');
            $batch_id   =  $this->input->post('batch_id');
            
            $like = '';
            $where = '';
        
            if(!empty($programe_id)):
                 $where['student_record.programe_id'] = $programe_id;
                 $this->data['programe_id']    = $programe_id;
            endif;
           if(!empty($sub_pro_id)):
                 $where['student_record.sub_pro_id'] = $sub_pro_id;
                 $this->data['sub_pro_id']    = $sub_pro_id;
            endif;
            if(!empty($batch_id)):
                 $where['student_record.batch_id'] = $batch_id;
                 $this->data['batch_id']    = $batch_id;
            endif;
            $custom['column']       = 'student_record.student_id';
            $custom['order']        = 'asc';
            $where['student_record.s_status_id'] = 5;

                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->ReportsModel->position_top_ten_report($field,'student_record', $where,$like,$custom);

                $this->data['ReportName']   = 'Students Result Top Ten ';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/student_result_top_ten";
                $this->data['title']        = 'Students Result Top Ten | ECMS';
                $this->load->view('common/common',$this->data); 
             
            else:
       
            $this->data['programe_id'] = '';
            $this->data['batch_id'] = '';
            $this->data['ReportName']       = 'Students Result Top Ten';
            $this->data['page']             = "reports/student_result_top_ten";
            $this->data['title']            = 'Students Result Top Ten | ECMS';
            $this->load->view('common/common',$this->data);     
           endif; 
        }
    
    public function grand_report_finance(){ 
        
            $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
            $this->data['student_status']   = $this->CRUDModel->dropDown_where_not_in('student_status', ' Status', 's_status_id', 'name','s_status_id',array(1,11,15,17,18));
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Status', 's_status_id', 'name',array('s_status_id !='=>1));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
             $this->data['shift']           = $this->CRUDModel->dropDown('shift', 'Select Shift ', 'shift_id', 'name');
             
            $this->data['ReportName']   = 'Grand Report Finance';
            $this->data['page']         = "reports/admin/grand_report_finance";
            $this->data['title']        = 'Grand Report Finance| ECMS';
            $this->load->view('common/common',$this->data); 
        }
    public function grand_report_bs_programs(){
            $this->data['program']          = $this->dropdownModel->bs_program_dropDown('programes_info', 'BS Programs ', 'programe_id', 'programe_name',array('status'=>'yes','degree_type_id'=>2));
            $this->data['subprogrames']     = $this->dropdownModel->bs_subpro_dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['sections']         = $this->dropdownModel->bs_sec_dropDown('sections', 'Sections', 'sec_id','name',array('sections.status'=>'On'));
            $this->data['student_status']   = $this->ReportsModel->statuss_dropDown('student_status', ' Student Status', 's_status_id', 'name');
            $this->data['batch']            = $this->dropdownModel->bs_batch_dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $batch                          =  $this->input->post('batch');
            $batch                          =  $this->input->post('batch');
            //like Array
            $like = '';
            $where['degree_type_id'] = '2';
            $this->data['college_no']           = '';
            $this->data['student_name']         = '';
            $this->data['father_name']          = '';
            $this->data['programId']            = '';
            $this->data['sectionId']            = '';
            $this->data['subprogramId']         = '';
            $this->data['application_statusId'] = '5';
            $this->data['batchId']              = '';
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
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
            if(!empty($application_status)):
                $where['student_status.s_status_id'] = $application_status;
                $this->data['application_statusId']  = $application_status;
            endif;    
           
            if($this->input->post('search')):
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.form_no,
                    student_record.comment,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name,
                    sections.name as sectionName,
                    ';

                $this->data['result'] = $this->ReportsModel->grand_report_bs_programs($field,'student_record',$where,$like);
 
             endif;
             
            if($this->input->post('export')):
                
                 $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Grand Report BS-Program');
                //set cell A1 content with some text
                
                $this->excel->getActiveSheet()->setCellValue('A1','Colg #');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Father name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Program');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                
                
                $this->excel->getActiveSheet()->setCellValue('E1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Batch no');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('G1','Section');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
               
                $this->excel->getActiveSheet()->setCellValue('H1','Student status');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
               
                
       for($col = ord('A'); $col <= ord('AF1'); $col++){
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }              
            
        $result = $this->ReportsModel->grand_reportExport_finance('student_record',$where,$like);
                
        foreach ($result as $row){
                $exceldata[] = $row;
                
            }
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='GrandReportBs_Program_'.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif; 
           
           
            $this->data['ReportName']   = 'Grand Report Bs Program';
            $this->data['page']         = "reports/grand_report_bs_programs";
            $this->data['title']        = 'Grand Report Finance| ECMS';
            $this->load->view('common/common',$this->data); 
 
        }
    public function grand_report_status(){
            
            $this->data['program']          = $this->dropdownModel->program_dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('status'=>'On'));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
//            $this->data['migration_status'] = array(''=>'Migration Status','1'=>"Yes",'0'=>'No');
            $this->data['college_no']           = '';
            $this->data['student_name']         = '';
            $this->data['father_name']          = '';
            $this->data['programId']            = '';
            $this->data['sectionId']            = '';
            $this->data['subprogramId']         = '';
            $this->data['application_statusId'] = '';
            $this->data['batchId']              = '';
            $this->data['migr_staus']           = '';
            
            
        if($this->input->post('search')):
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $application_status             =  $this->input->post('application_status');
            $section                        =  $this->input->post('sections_name');
            $batch                          =  $this->input->post('batch');
            $migration_status               =  $this->input->post('migration_status');
            //like Array
            $like = '';
            $where = '';
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
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
            if(!empty($application_status)):
                $where['student_record.s_status_id']     = $application_status;
                $this->data['application_statusId']     = $application_status;
            endif;    
            if(!empty($migration_status)):
                $send_value = '';
                if($migration_status == 1):
                    $send_value = '0';
                endif;
                
                if($migration_status == 2):
                    $send_value = '1';
                endif;
                
                $where['migration_status']  = $send_value;
                $this->data['migr_staus']   = $migration_status;
            endif;    
           
         
                
             $this->data['result'] = $this->ReportsModel->grand_report_status($where,$like);
        endif;
         
            $this->data['ReportName']   = 'Migrated Students Report';
            $this->data['page']         = "reports/admin/grand_report_status";
            $this->data['title']        = 'Migrated Students Report| ECMS';
            $this->load->view('common/common',$this->data); 
 
        }
    public function top_ten_students_record(){
         
            $this->data['program'] = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['sub_program'] = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name');
            $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
            $this->data['userId'] = $userInfo->user_id;
            
            $this->data['programe_id']        = '';
            $this->data['sub_pro_id']        = '';
            $this->data['batch_id']        = '';
        
            if($this->input->post()):
           // echo '<pre>';print_r($this->input->post());die;
            $programe_id = $this->input->post('programe_id');
            $sub_pro_id =  $this->input->post('sub_pro_id');
            $batch_id   =  $this->input->post('batch_id');
            
            $like = '';
            $where = '';
        
            if(!empty($programe_id)):
                 $where['student_record.programe_id'] = $programe_id;
                 $this->data['programe_id']    = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['student_record.sub_pro_id'] = $sub_pro_id;
                 $this->data['sub_pro_id']    = $sub_pro_id;
            endif;
            if(!empty($batch_id)):
                 $where['student_record.batch_id'] = $batch_id;
                 $this->data['batch_id']    = $batch_id;
            endif;
            $custom['column']       = 'student_record.student_id';
            $custom['order']        = 'asc';
            $where['student_record.s_status_id'] = 5;
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    ';
                $this->data['result'] = $this->ReportsModel->top_ten_position_report($field,'student_record', $where,$like,$custom);

                $this->data['ReportName']   = 'Top Ten Students Report';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "reports/top_ten_students_record";
                $this->data['title']        = 'Top Ten Students Report | ECMS';
                $this->load->view('common/common',$this->data); 
             
            else:
       
            $this->data['programe_id'] = '';
            $this->data['batch_id'] = '';
            $this->data['ReportName']       = 'Top Ten Students Report';
            $this->data['page']             = "reports/top_ten_students_record";
            $this->data['title']            = 'Top Ten Students Report';
            $this->load->view('common/common',$this->data);     
           endif; 
        }
    public function student_attendance_white_card_print_group_hostel(){
            
            $program        = $this->uri->segment(2);
            $sub_program    = $this->uri->segment(3);
            $section        = $this->uri->segment(4);
            
            $this->data['program']      = $program;
            $this->data['subProgram']   = $sub_program;
            $this->data['section']      = $section;
            
            
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
            
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            $where['student_status.s_status_id'] = 5;
  
  
                $this->data['all_result']       = $this->ReportsModel->white_card_group_wise_hostel( $where);
           // echo '<pre>';print_r($this->data['all_result']);die;
            $this->data['page_title']       = 'Student white card | ECMS';
            $this->data['page']             =  'reports/attendance/whiteCardPrintGroup';
            $this->load->view('common/common',$this->data); 
        }
    public function student_attendance_white_card_grand_hostel(){
            
          
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program', 'programe_id', 'programe_name',array('status'=>'yes','program_type_id'=>1));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes'));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('status'=>'On'));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
          
            $this->data['college_no']       = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
             $this->data['batch_id']         = '';
            
            if($this->input->post('search')):
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            $batch                          =  $this->input->post('prospectus_batch');
       
            //like Array
            $like = '';
            $where['student_record.s_status_id'] = 5;
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id']  = $batch;
                $this->data['batch_id']    = $batch;
            endif;
         
                $this->data['result']       = $this->ReportsModel->grand_report_hostel($where,$like);
//                echo '<pre>';print_r($this->data['result']);die;
//                $this->data['ReportName']   = 'White Card Grand Hostel';
                $this->data['countResult']  = count($this->data['result']);
//                $this->data['page']         = "reports/whiteCard";
//                $this->data['title']        = 'White Card Grand Hostel | ECMS';
//                $this->load->view('common/common',$this->data); 
                
           endif; 
            $this->data['ReportName']   = 'White Card Grand Hostel';
            $this->data['page']         = "reports/white_card_hostel_v";
            $this->data['title']        = 'White Card Grand Hostel| ECMS';
            $this->load->view('common/common',$this->data);
        }
        
    public function student_attendance_white_card_inter_hostel(){
            
          
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programe_id'=>1));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>1));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('status'=>'On','program_id'=>1));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
//            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
          
            $this->data['college_no']       = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            
            
            if($this->input->post('search')):
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where['student_record.s_status_id'] = 5;
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
         
                $this->data['result']       = $this->ReportsModel->grand_report_hostel($where,$like);
//                echo '<pre>';print_r($this->data['result']);die;
//                $this->data['ReportName']   = 'White Card Grand Hostel';
                $this->data['countResult']  = count($this->data['result']);
//                $this->data['page']         = "reports/whiteCard";
//                $this->data['title']        = 'White Card Grand Hostel | ECMS';
//                $this->load->view('common/common',$this->data); 
                
           endif; 
            $this->data['ReportName']   = 'White Card Inter Hostel';
            $this->data['page']         = "reports/white_card_hostel_v";
            $this->data['title']        = 'White Card Grand Hostel| ECMS';
            $this->load->view('common/common',$this->data);
        }  
        
        public function student_attendance_white_card_bs_hostel(){
            
            $where_bs = array(
                'status'=>'yes',
                'degree_type_id'=>2,
                'programe_id !='=>3
                );
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',$where_bs);
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>1));
//            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seat', 'rseat_id', 'name');
//            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
            $this->data['sections']          = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('status'=>'On','program_id'=>1));
//            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id !='=>1));
            
          
            $this->data['college_no']       = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batch_id']     = '';
            
            
            if($this->input->post('search')):
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
       
            //like Array
            $like = '';
            $where['student_record.s_status_id'] = 5;
            
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
         
                $this->data['result']       = $this->ReportsModel->grand_report_hostel($where,$like);
//                echo '<pre>';print_r($this->data['result']);die;
//                $this->data['ReportName']   = 'White Card Grand Hostel';
                $this->data['countResult']  = count($this->data['result']);
//                $this->data['page']         = "reports/whiteCard";
//                $this->data['title']        = 'White Card Grand Hostel | ECMS';
//                $this->load->view('common/common',$this->data); 
                
           endif; 
            $this->data['ReportName']   = 'BS Hostel White Card';
            $this->data['page']         = "reports/white_card_hostel_v";
            $this->data['title']        = 'BS Hostel White Card| ECMS';
            $this->load->view('common/common',$this->data);
        }      
        
   public function bscs_attendance_marks_history()
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
            
            $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
            $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
            $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
            
        endif;  
        
        $this->data['HeaderPage']   = 'Student Attendance History (BS Computer Science)';
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/v_bscs_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
    
        
    public function auto_students_bscs()
     { 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsbBscs('student_record');
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsbBscs('student_record',$like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    
    public function bseng_attendance_marks_history()
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
            
            $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
            $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
            $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
        
        endif;        
        $this->data['HeaderPage']   = 'Student Attendance History (BS English)';
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/v_bseng_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
       
    public function auto_students_bseng()
     { 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsbBsEng('student_record');
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsbBsEng('student_record',$like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    
    
    public function bslaw_attendance_marks_history(){          
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
            
            $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
            $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
            $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
        
        endif;        
        $this->data['HeaderPage']   = 'Student Attendance History (BS Law)';
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/v_bslaw_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
       
    public function auto_students_bslaw(){ 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsbBsLaw('student_record');
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsbBsLaw('student_record',$like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    
    public function alevel_attendance_marks_history()
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
            
        $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
        $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
            $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
        
        endif;        
        $this->data['HeaderPage']   = 'Student Attendance History (A Level)';
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/v_alevel_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
       
    public function auto_students_alevel()
     { 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsbALevel('student_record');
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsbALevel('student_record',$like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    
    public function bba_attendance_marks_history()
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
            
        $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
        $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
            $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
        
        endif;        
        $this->data['HeaderPage']   = 'Student Attendance History (BBA)';
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/v_bba_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
       
    public function auto_students_bba()
     { 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsbBBA('student_record');
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsbBBA('student_record',$like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    
    public function hnd_attendance_marks_history()
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
            
        $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
        $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
        $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
        
        endif;        
        $this->data['HeaderPage']   = 'Student Attendance History (HND)';
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/v_hnd_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
       
    public function auto_students_hnd()
     { 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsbHND('student_record');
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsbHND('student_record',$like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    
    public function inter_attendance_marks_history()
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
            
        $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
        $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
            $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
        
        endif;        
        $this->data['HeaderPage']   = 'Student Attendance History (Inter Level)';
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/v_inter_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
       
    public function auto_students_inter()
     { 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsbInter('student_record');
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsbInter('student_record',$like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    public function group_wise_cumulative_attendance_report()
    {    
        $this->data['programe_id']  = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batchId']      = '';
        $this->data['sec_id']       = '';
        $this->data['college_no']   = '';
        
        $this->data['sub_programs']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name',array('status'=>'on'));
     
        if($this->input->post('search')):
            $college_no     =  $this->input->post('college_no');
            $program        =  $this->input->post('programe_id');
            $sub_program    =  $this->input->post('sub_pro_id');
            $batch          =  $this->input->post('batch');
            $section        =  $this->input->post('section');
            
            $where = '';
            $where1['student_record.s_status_id'] = '5';
            
            if(!empty($college_no)):
              $student_id =   $this->db->get_where('student_record', array('college_no'=>$college_no))->row()->student_id;
                 
                $where['student_record.student_id'] = $student_id;
                $where1['student_comulative_attendance.student_id'] = $student_id;
                $this->data['college_no'] =$college_no;
            endif;
             
            if(!empty($program)):
                $where['student_record.programe_id'] = $program;
                $this->data['programe_id']           = $program;
                else:
                 $this->data['programe_id']  = '';    
            endif;
            
            if(!empty($sub_program)):
                $where['student_record.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id']           = $sub_program;
                else:
                 $this->data['sub_pro_id']  = '';
            endif;
            
            if(!empty($batch)):
                $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
                else:
                 $this->data['batch_id']  = '';
            endif;
//            
            if(!empty($section)):
                $where['student_group_allotment.section_id']    = $section;
                $this->data['section_id']                       = $section;
            endif;
            
            
            
            $this->data['std']          = $this->ReportsModel->student_Datainfo('student_record',$where);
            $this->data['sub_program']  = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
            
//            echo '<pre>'; print_r($this->data['sub_program']); die;
        endif;        
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/view_group_wise_cumulative_attendance_report';
        $this->load->view('common/common',$this->data);
    }
    
    public function class_alloted_log_report(){
        
        if($this->input->post('search_class')):
        
            $EmpId      = $this->input->post('emp_id');
            $SectionId  = $this->input->post('sec_id');
            $SubjectId  = $this->input->post('subject_id');

            $where  = '';
            $wherec  = '';
            $like   = '';
            
            if($EmpId):
               $where['class_alloted_log.emp_id'] = $EmpId;  
               $wherec['class_alloted.emp_id'] = $EmpId;  
            endif;
            if($SectionId):
               $where['class_alloted_log.sec_id'] = $SectionId;  
               $wherec['class_alloted.sec_id'] = $SectionId;  
            endif;
            if($SubjectId):
               $where['class_alloted_log.subject_id'] = $SubjectId;  
               $wherec['class_alloted.subject_id'] = $SubjectId;  
            endif;
               
            $this->data['class_result'] = $this->ReportsModel->class_alloted_record_logs($where,$like,$wherec);

        endif;

        $this->data['HeaderPage']       = 'Class Alloted History';
        $this->data['page_title']       = 'Class Alloted Log Report | ECMS';
        $this->data['page']             = 'reports/class_alloted_history';
        $this->load->view('common/common',$this->data);
    }
    
    public function subject_new_student_report_inter(){
        
        $this->data['form_number']   = ''; 
        $this->data['college_number']   = ''; 
        $this->data['std_name']         = ''; 
        $this->data['std_fname']        = ''; 
        $this->data['sectionpr']        = ''; 
        $this->data['batchId']        = ''; 
        $this->data['subjectId']        = ''; 
        
        if($this->input->post('search_log')):
        
            $form_number    = $this->input->post('form_number');
            $college_number    = $this->input->post('college_number');
            $subject        = $this->input->post('subjects');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');
            $subProgramId   = $this->input->post('sectionpr');
            $batchId        = $this->input->post('batchId');

            $where['student_record.programe_id']= 1;
            $where['student_record.s_status_id']= 5;
            $like = '';
            $this->data['subjectId'] = '';
            
            if($form_number):
               $where['student_record.form_no'] = $form_number;  
               $this->data['form_number']       = $form_number; 
            endif;
            if($college_number):
               $where['student_record.college_no']  = $college_number;  
               $this->data['college_number']        = $college_number; 
            endif;
            if($batchId):
               $where['student_record.batch_id']    = $batchId;  
               $this->data['batchId']               = $batchId;  
            endif;
            if($subProgramId):
               $where['student_record.sub_pro_id']  = $subProgramId;  
               $this->data['sectionpr']             = $subProgramId;  
            endif;
            if($subject):
//                   $where['subject.subject_id'] = $subject;  
               $this->data['subjectId'] = $subject;  
            endif;
           if($std_name):
               $like['student_record.student_name'] = $std_name;  
               $this->data['std_name']              = $std_name;  
            endif;
            if($std_fname):
               $like['student_record.father_name']  = $std_fname;  
               $this->data['std_fname']             = $std_fname;  
            endif;


            $this->data['student_result'] = $this->ReportsModel->new_subject_inter_record($where,$like);

        endif;
 
        if($this->input->post('export_report_single')):

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Subject Report');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No.');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form No.');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Date Time');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Subjects');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            for($col = ord('A'); $col <= ord('H'); $col++){
                     //set column dimension
                     $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                      //change the font size
                     $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                     $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
             }

            $form_number    = $this->input->post('form_number');
            $college_number    = $this->input->post('college_number');
            $subject        = $this->input->post('subjects');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');
            $subProgramId   = $this->input->post('sectionpr');
            $batchId        = $this->input->post('batchId');

            $where['student_record.programe_id']= 1;
            $where['student_record.s_status_id']= 5;
            $like = '';
            $this->data['subjectId'] = '';
            
            if($form_number):
               $where['student_record.form_no'] = $form_number;  
               $this->data['form_number']       = $form_number; 
            endif;
            if($college_number):
               $where['student_record.college_no']  = $college_number;  
               $this->data['college_number']        = $college_number; 
            endif;
            if($batchId):
               $where['student_record.batch_id']    = $batchId;  
               $this->data['batchId']               = $batchId;  
            endif;
            if($subProgramId):
               $where['student_record.sub_pro_id']  = $subProgramId;  
               $this->data['sectionpr']             = $subProgramId;  
            endif;
            if($subject):
//                   $where['subject.subject_id'] = $subject;  
               $this->data['subjectId'] = $subject;  
            endif;
           if($std_name):
               $like['student_record.student_name'] = $std_name;  
               $this->data['std_name']              = $std_name;  
            endif;
            if($std_fname):
               $like['student_record.father_name']  = $std_fname;  
               $this->data['std_fname']             = $std_fname;  
            endif;
//            echo '<pre>'; print_r($where); die;
            $student_result = $this->ReportsModel->new_subject_inter_record($where,$like);
            $return_array = '';
            if(@$student_result):
                $sn= ''; 
                foreach($student_result as $srRow):
                    if(@$subject):

                        $subject_results = $this->ReportsModel->get_subject_new_student_list(array('new_student_subjects.subject_id'=>$subject,'new_student_subjects.student_id'=>$srRow->student_id));
                        $assigned_subjects = $this->ReportsModel->get_subject_new_student_list(array('new_student_subjects.student_id'=>$srRow->student_id));

                        if($subject_results):
                            $subject_array = '';
                            foreach($assigned_subjects as $rowList):
                                $subject_array .= $rowList->subject_name.', ';
                            endforeach;
                            $selected_subject = $this->CRUDModel->get_where_row('subject', array('subject_id'=>$subject));
                            $sn++;
                            $return_array[] = array(
                                'sn'            =>  $sn,
                                'colleg_no'     =>  $srRow->college_no,
                                'form_no'       =>  $srRow->form_no,
                                'student_name'  =>  $srRow->student_name,
                                'father_name'   =>  $srRow->father_name,
                                'sub_pro_name'  =>  $srRow->sub_pro_name,
                                'timestamp'     =>  date('d-m-Y H:i:s',strtotime($srRow->timestamp)),
//                                    'subject_name'  =>  $subject_array,
                                'subject_name'  =>  $selected_subject->title
                            );
                        endif;
                    else:
                        $subject_result = $this->ReportsModel->get_subject_new_student_list(array('new_student_subjects.student_id'=>$srRow->student_id)); 

                        if($subject_result):
                            $subject_array = '';
                            foreach($subject_result as $rowList):
                             $subject_array .= $rowList->subject_name.', ';
                            endforeach;
                            $selected_subject = $this->CRUDModel->get_where_row('subject', array('subject_id'=>$subject));
                            $sn++;
                            $return_array[] = array(
                                'sn'            =>  $sn,
                                'colleg_no'     =>  $srRow->college_no,
                                'form_no'       =>  $srRow->form_no,
                                'student_name'  =>  $srRow->student_name,
                                'father_name'   =>  $srRow->father_name,
                                'sub_pro_name'  =>  $srRow->sub_pro_name,
                                'timestamp'     =>  date('d-m-Y H:i:s',strtotime($srRow->timestamp)),
//                                    'subject_name'  =>  $subject_array,
                                'subject_name'  =>  $selected_subject->title
                            );
                        endif;
                    endif;
                endforeach;
            endif;
//                echo '<pre>'; print_r($return_array); die;
            $exceldata="";
            if($return_array):
                foreach ($return_array as $row) {
                $exceldata[] = $row;
                }      

            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename='Subject_Alloted_Inter_Single_Subject.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output');  
            endif;

        endif;


        if($this->input->post('export_report')):

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Subject Report');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No.');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form No.');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Date Time');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Subjects 1');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','Subjects 2');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','Subjects 3');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','Subjects 4');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Subjects 5');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Subjects 6');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            for($col = ord('A'); $col <= ord('M'); $col++){
                     //set column dimension
                     $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                      //change the font size
                     $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                     $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
             }

            $form_number    = $this->input->post('form_number');
            $college_number    = $this->input->post('college_number');
            $subject        = $this->input->post('subjects');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');
            $subProgramId   = $this->input->post('sectionpr');
            $batchId        = $this->input->post('batchId');

            $where['student_record.programe_id']= 1;
            $where['student_record.s_status_id']= 5;
            $like = '';
            $this->data['subjectId'] = '';
            
            if($form_number):
               $where['student_record.form_no'] = $form_number;  
               $this->data['form_number']       = $form_number; 
            endif;
            if($college_number):
               $where['student_record.college_no']  = $college_number;  
               $this->data['college_number']        = $college_number; 
            endif;
            if($batchId):
               $where['student_record.batch_id']    = $batchId;  
               $this->data['batchId']               = $batchId;  
            endif;
            if($subProgramId):
               $where['student_record.sub_pro_id']  = $subProgramId;  
               $this->data['sectionpr']             = $subProgramId;  
            endif;
            if($subject):
//                   $where['subject.subject_id'] = $subject;  
               $this->data['subjectId'] = $subject;  
            endif;
           if($std_name):
               $like['student_record.student_name'] = $std_name;  
               $this->data['std_name']              = $std_name;  
            endif;
            if($std_fname):
               $like['student_record.father_name']  = $std_fname;  
               $this->data['std_fname']             = $std_fname;  
            endif;

            $student_result = $this->ReportsModel->new_subject_inter_record($where,$like);
            $return_array = '';
            if(@$student_result):
                $sn= ''; 
                foreach($student_result as $srRow):
                    if(@$subject):

                        $subject_results = $this->ReportsModel->get_subject_new_student_list(array('new_student_subjects.subject_id'=>$subject,'new_student_subjects.student_id'=>$srRow->student_id));
                        $assigned_subjects = $this->ReportsModel->get_subject_new_student_list(array('new_student_subjects.student_id'=>$srRow->student_id));

                        if($subject_results):
                            $subject_array = '';
                            foreach($assigned_subjects as $rowList):
                                $subject_array .= $rowList->subject_name.', ';
                            endforeach;

                            if(!empty($assigned_subjects[0])): $s1 = $assigned_subjects[0]->subject_name; else: $s1 = ''; endif;
                            if(!empty($assigned_subjects[1])): $s2 = $assigned_subjects[1]->subject_name; else: $s2 = ''; endif;
                            if(!empty($assigned_subjects[2])): $s3 = $assigned_subjects[2]->subject_name; else: $s3 = ''; endif;
                            if(!empty($assigned_subjects[3])): $s4 = $assigned_subjects[3]->subject_name; else: $s4 = ''; endif;
                            if(!empty($assigned_subjects[4])): $s5 = $assigned_subjects[4]->subject_name; else: $s5 = ''; endif;
                            if(!empty($assigned_subjects[5])): $s6 = $assigned_subjects[5]->subject_name; else: $s6 = ''; endif;

                            $sn++;
                            $return_array[] = array(
                                            'sn'            =>  $sn,
                                            'colleg_no'     =>  $srRow->college_no,
                                            'form_no'       =>  $srRow->form_no,
                                            'student_name'  =>  $srRow->student_name,
                                            'father_name'   =>  $srRow->father_name,
                                            'sub_pro_name'  =>  $srRow->sub_pro_name,
                                            'timestamp'     =>  date('d-m-Y H:i:s',strtotime($srRow->timestamp)),
                                            'subject_1'     =>  $s1,
                                            'subject_2'     =>  $s2,
                                            'subject_3'     =>  $s3,
                                            'subject_4'     =>  $s4,
                                            'subject_5'     =>  $s5,
                                            'subject_6'     =>  $s6
                                            );
                        endif;
                    else:
                        $subject_result = $this->ReportsModel->get_subject_new_student_list(array('new_student_subjects.student_id'=>$srRow->student_id)); 

                        if($subject_result):
                            $subject_array = '';
                            foreach($subject_result as $rowList):
                                $subject_array .= $rowList->subject_name.', ';
                            endforeach;

                            if(!empty($assigned_subjects[0])): $s1 = $assigned_subjects[0]->subject_name; else: $s1 = ''; endif;
                            if(!empty($assigned_subjects[1])): $s2 = $assigned_subjects[1]->subject_name; else: $s2 = ''; endif;
                            if(!empty($assigned_subjects[2])): $s3 = $assigned_subjects[2]->subject_name; else: $s3 = ''; endif;
                            if(!empty($assigned_subjects[3])): $s4 = $assigned_subjects[3]->subject_name; else: $s4 = ''; endif;
                            if(!empty($assigned_subjects[4])): $s5 = $assigned_subjects[4]->subject_name; else: $s5 = ''; endif;
                            if(!empty($assigned_subjects[5])): $s6 = $assigned_subjects[5]->subject_name; else: $s6 = ''; endif;

                            $sn++;
                            $return_array[] = array(
                                            'sn'            =>  $sn,
                                            'colleg_no'     =>  $srRow->college_no,
                                            'form_no'       =>  $srRow->form_no,
                                            'student_name'  =>  $srRow->student_name,
                                            'father_name'   =>  $srRow->father_name,
                                            'sub_pro_name'  =>  $srRow->sub_pro_name,
                                            'timestamp'     =>  date('d-m-Y H:i:s',strtotime($srRow->timestamp)),
                                            'subject_1'     =>  $s1,
                                            'subject_2'     =>  $s2,
                                            'subject_3'     =>  $s3,
                                            'subject_4'     =>  $s4,
                                            'subject_5'     =>  $s5,
                                            'subject_6'     =>  $s6
                                            );
                        endif;
                    endif;
                endforeach;
            endif;
//                echo '<pre>'; print_r($return_array); die;
            $exceldata="";
            if($return_array):
                foreach ($return_array as $row) {
                $exceldata[] = $row;
                }      

            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename='Subject_Alloted_Inter.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output');  
            endif;

        endif;
        $order['column']    = 'batch_name';
        $order['order']     = 'desc';
        $this->data['batchName']      = $this->CRUDModel->dropDown('prospectus_batch', '', 'batch_id', 'batch_name', array('programe_id'=>1), $order);
        $this->data['subPrograme']      = $this->CRUDModel->dropDown_where_in('sub_programes', 'Sub Program', 'sub_pro_id', 'name','sub_pro_id',array(5,27));
        $this->data['subjects']         = $this->CRUDModel->dropDown_where_in('subject', 'Select Subject', 'subject_id', 'title','sub_pro_id',array(4,5,26,27));

        $this->data['HeaderPage']       = 'New Student Arts Subject Alloted Report';
        $this->data['page_title']       = 'Art Subject Report | ECMS';
        $this->data['page']             = 'reports/Inter/student_new_subject_report';
        $this->load->view('common/common',$this->data);
    }
    public function subject_alloted_for_study(){
        
        $this->data['form_number']      = ''; 
        $this->data['college_number']   = ''; 
        $this->data['std_name']         = ''; 
        $this->data['std_fname']        = ''; 
        $this->data['subProgrameId']    = ''; 
        $this->data['batchId']          = ''; 
        $this->data['subjectId']        = ''; 
        $this->data['genderId']         = ''; 
        $order['column']                = 'batch_name';
        $order['order']                 = 'desc';
        $this->data['batchName']        = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name', array('programe_id'=>1), $order);
        $this->data['subPrograme']      = $this->CRUDModel->dropDown_where_in('sub_programes', 'Sub Program', 'sub_pro_id', 'name','sub_pro_id',array(5,27));
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['subjects']         = array(''=>"Select Subject");
        
        
        if($this->input->post('search_log')):
        
            $form_number    = $this->input->post('form_number');
            $college_number = $this->input->post('college_number');
            $subject        = $this->input->post('subjects');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');
            $subProgramId   = $this->input->post('subPrograme');
            $batchId        = $this->input->post('batchId');
            $gender         = $this->input->post('genderId');
             
            $where['student_record.programe_id']    = 1;
            $where['student_record.s_status_id']    = 5;
            $like                                   = '';
            $this->data['subjectId']                = '';
            
            if($form_number):
               $where['student_record.form_no'] = $form_number;  
               $this->data['form_number']       = $form_number; 
            endif;
            if($college_number):
               $where['student_record.college_no']  = $college_number;  
               $this->data['college_number']        = $college_number; 
            endif;
            if($batchId):
               $where['student_record.batch_id']    = $batchId;  
               $this->data['batchId']               = $batchId;  
            endif;
            if($gender):
               $where['student_record.gender_id']    = $gender;  
               $this->data['genderId']               = $gender;  
            endif;
            if($subProgramId):
               $where['student_record.sub_pro_id']  = $subProgramId;  
               $this->data['subProgrameId']         = $subProgramId;
               
            endif;
            if($subject):
                
              $subject_details =  $this->db->get_where('subject',array('subject_id'=>$subject))->row();
               $this->data['subjects']   = array($subject_details->subject_id=>$subject_details->title);  
               $this->data['subjectId'] = $subject;  
            endif;
           if($std_name):
               $like['student_record.student_name'] = $std_name;  
               $this->data['std_name']              = $std_name;  
            endif;
            if($std_fname):
               $like['student_record.father_name']  = $std_fname;  
               $this->data['std_fname']             = $std_fname;  
            endif;


            $this->data['student_result'] = $this->ReportsModel->new_subject_inter_record($where,$like);
        endif;
 
        if($this->input->post('export_report_single')):

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Subject Report');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No.');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form No.');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Std Mobile No#');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
            
            $this->excel->getActiveSheet()->setCellValue('H1','Date Time');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','Subjects');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            for($col = ord('A'); $col <= ord('H'); $col++){
                     //set column dimension
                     $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                      //change the font size
                     $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                     $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
             }

            $form_number    = $this->input->post('form_number');
            $college_number = $this->input->post('college_number');
            $subject        = $this->input->post('subjects');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');
            $subProgramId   = $this->input->post('subPrograme');
            $batchId        = $this->input->post('batchId');
            $gender        = $this->input->post('genderId');

            $where['student_record.programe_id']= 1;
            $where['student_record.s_status_id']= 5;
            $like                               = '';
            $this->data['subjectId'] = '';
            
            if($form_number):
               $where['student_record.form_no'] = $form_number;  
               $this->data['form_number']       = $form_number; 
            endif;
            if($college_number):
               $where['student_record.college_no']  = $college_number;  
               $this->data['college_number']        = $college_number; 
            endif;
            if($gender):
               $where['student_record.gender_id']    = $gender;  
               $this->data['genderId']               = $gender;  
            endif;
            if($batchId):
               $where['student_record.batch_id']    = $batchId;  
               $this->data['batchId']               = $batchId;  
            endif;
            if($subProgramId):
               $where['student_record.sub_pro_id']  = $subProgramId;  
               $this->data['sectionpr']             = $subProgramId;  
            endif;
            if($subject):
//                   $where['subject.subject_id'] = $subject;  
               $this->data['subjectId'] = $subject;  
            endif;
           if($std_name):
               $like['student_record.student_name'] = $std_name;  
               $this->data['std_name']              = $std_name;  
            endif;
            if($std_fname):
               $like['student_record.father_name']  = $std_fname;  
               $this->data['std_fname']             = $std_fname;  
            endif;
            
            $student_result = $this->ReportsModel->new_subject_inter_record($where,$like);
            $return_array = '';
            if(@$student_result):
                $sn= ''; 
                foreach($student_result as $srRow):
                    if(@$subject):

                        $subject_results    = $this->ReportsModel->student_alloted_subjects(array('student_subject_alloted.subject_id'=>$subject,'student_subject_alloted.student_id'=>$srRow->student_id));
                        $assigned_subjects  = $this->ReportsModel->student_alloted_subjects(array('student_subject_alloted.student_id'=>$srRow->student_id));

                        if($subject_results):
                            $subject_array = '';
                            foreach($assigned_subjects as $rowList):
                                $subject_array .= $rowList->subject_name.', ';
                            endforeach;
                            $selected_subject = $this->CRUDModel->get_where_row('subject', array('subject_id'=>$subject));
                            $sn++;
                            $return_array[] = array(
                                'sn'            =>  $sn,
                                'colleg_no'     =>  $srRow->college_no,
                                'form_no'       =>  $srRow->form_no,
                                'student_name'  =>  $srRow->student_name,
                                'father_name'   =>  $srRow->father_name,
                                'sub_pro_name'  =>  $srRow->sub_pro_name,
                                'applicant_mob_no1'  =>  $srRow->applicant_mob_no1,
                                'timestamp'     =>  date('d-m-Y H:i:s',strtotime($srRow->timestamp)),
//                                    'subject_name'  =>  $subject_array,
                                'subject_name'  =>  $selected_subject->title
                            );
                        endif;
                    else:
                        $subject_result         = $this->ReportsModel->student_alloted_subjects(array('student_subject_alloted.student_id'=>$srRow->student_id)); 
                         
                        if($subject_result):
                            $subject_array = '';
                            foreach($subject_result as $rowList):
                             $subject_array .= $rowList->subject_name.', ';
                            endforeach;
                            $selected_subject = $this->CRUDModel->get_where_row('subject', array('subject_id'=>$subject));
                            $sn++;
                            $return_array[] = array(
                                'sn'            =>  $sn,
                                'colleg_no'     =>  $srRow->college_no,
                                'form_no'       =>  $srRow->form_no,
                                'student_name'  =>  $srRow->student_name,
                                'father_name'   =>  $srRow->father_name,
                                'sub_pro_name'  =>  $srRow->sub_pro_name,
                                 'applicant_mob_no1'  =>  $srRow->applicant_mob_no1,
                                'timestamp'     =>  date('d-m-Y H:i:s',strtotime($srRow->timestamp)),
//                                    'subject_name'  =>  $subject_array,
                                'subject_name'  =>  $selected_subject->title
                            );
                        endif;
                    endif;
                endforeach;
            endif;
 
            $exceldata="";
            if($return_array):
                foreach ($return_array as $row) {
                $exceldata[] = $row;
                }      

            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename='Subject_Alloted_Inter_Single_Subject.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output');  
            endif;

        endif;


        if($this->input->post('export_report')):

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Subject Report');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No.');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form No.');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Date Time');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Subjects 1');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','Subjects 2');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','Subjects 3');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','Subjects 4');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Subjects 5');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Subjects 6');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            for($col = ord('A'); $col <= ord('M'); $col++){
                     //set column dimension
                     $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                      //change the font size
                     $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                     $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
             }

            $form_number    = $this->input->post('form_number');
            $college_number    = $this->input->post('college_number');
            $subject        = $this->input->post('subjects');
            $std_name       = $this->input->post('std_name');
            $std_fname      = $this->input->post('std_fname');
            $subProgramId   = $this->input->post('subPrograme');
            $batchId        = $this->input->post('batchId');
            $gender        = $this->input->post('genderId');

            $where['student_record.programe_id'] = 1;
            $where['student_record.s_status_id'] = 5;
            $like                                = '';
             $this->data['subjectId'] = '';
            
            if($form_number):
               $where['student_record.form_no'] = $form_number;  
               $this->data['form_number']       = $form_number; 
            endif;
            if($college_number):
               $where['student_record.college_no']  = $college_number;  
               $this->data['college_number']        = $college_number; 
            endif;
            if($gender):
               $where['student_record.gender_id']    = $gender;  
               $this->data['genderId']               = $gender;  
            endif;
            if($batchId):
               $where['student_record.batch_id']    = $batchId;  
               $this->data['batchId']               = $batchId;  
            endif;
            if($subProgramId):
               $where['student_record.sub_pro_id']  = $subProgramId;  
               $this->data['subProgrameId']         = $subProgramId;  
            endif;
            if($subject):
//                   $where['subject.subject_id'] = $subject;  
               $this->data['subjectId'] = $subject;  
            endif;
           if($std_name):
               $like['student_record.student_name'] = $std_name;  
               $this->data['std_name']              = $std_name;  
            endif;
            if($std_fname):
               $like['student_record.father_name']  = $std_fname;  
               $this->data['std_fname']             = $std_fname;  
            endif;


            $student_result = $this->ReportsModel->new_subject_inter_record($where,$like);
            $return_array   = '';
            if(!empty($student_result)):
                $sn= ''; 
                foreach($student_result as $srRow):
                    if(!empty($subject)):

                        $subject_results        = $this->ReportsModel->student_alloted_subjects(array('subject.subject_id'=>$subject,'student_subject_alloted.student_id'=>$srRow->student_id));
                        $assigned_subjects      = $this->ReportsModel->student_alloted_subjects(array('student_subject_alloted.student_id'=>$srRow->student_id));

                        if($subject_results):
                            $subject_array = '';

                            if(!empty($assigned_subjects[0])): $s1 = $assigned_subjects[0]->subject_name; else: $s1 = ''; endif;
                            if(!empty($assigned_subjects[1])): $s2 = $assigned_subjects[1]->subject_name; else: $s2 = ''; endif;
                            if(!empty($assigned_subjects[2])): $s3 = $assigned_subjects[2]->subject_name; else: $s3 = ''; endif;
                            if(!empty($assigned_subjects[3])): $s4 = $assigned_subjects[3]->subject_name; else: $s4 = ''; endif;
                            if(!empty($assigned_subjects[4])): $s5 = $assigned_subjects[4]->subject_name; else: $s5 = ''; endif;
                            if(!empty($assigned_subjects[5])): $s6 = $assigned_subjects[5]->subject_name; else: $s6 = ''; endif;

                            $sn++;
                            $return_array[] = array(
                                            'sn'            =>  $sn,
                                            'colleg_no'     =>  $srRow->college_no,
                                            'form_no'       =>  $srRow->form_no,
                                            'student_name'  =>  $srRow->student_name,
                                            'father_name'   =>  $srRow->father_name,
                                            'sub_pro_name'  =>  $srRow->sub_pro_name,
                                            'timestamp'     =>  date('d-m-Y H:i:s',strtotime($srRow->timestamp)),
                                            'subject_1'     =>  $s1,
                                            'subject_2'     =>  $s2,
                                            'subject_3'     =>  $s3,
                                            'subject_4'     =>  $s4,
                                            'subject_5'     =>  $s5,
                                            'subject_6'     =>  $s6
                                            );
                        endif;
                    else:
                        $subject_result     = $this->ReportsModel->student_alloted_subjects(array('student_subject_alloted.student_id'=>$srRow->student_id)); 
                         $assigned_subjects = $this->ReportsModel->student_alloted_subjects(array('student_subject_alloted.student_id'=>$srRow->student_id));

                        if($subject_result):
                            if(!empty($assigned_subjects[0])): $s1 = $assigned_subjects[0]->subject_name; else: $s1 = ''; endif;
                            if(!empty($assigned_subjects[1])): $s2 = $assigned_subjects[1]->subject_name; else: $s2 = ''; endif;
                            if(!empty($assigned_subjects[2])): $s3 = $assigned_subjects[2]->subject_name; else: $s3 = ''; endif;
                            if(!empty($assigned_subjects[3])): $s4 = $assigned_subjects[3]->subject_name; else: $s4 = ''; endif;
                            if(!empty($assigned_subjects[4])): $s5 = $assigned_subjects[4]->subject_name; else: $s5 = ''; endif;
                            if(!empty($assigned_subjects[5])): $s6 = $assigned_subjects[5]->subject_name; else: $s6 = ''; endif;

                            $sn++;
                            $return_array[] = array(
                                            'sn'            =>  $sn,
                                            'colleg_no'     =>  $srRow->college_no,
                                            'form_no'       =>  $srRow->form_no,
                                            'student_name'  =>  $srRow->student_name,
                                            'father_name'   =>  $srRow->father_name,
                                            'sub_pro_name'  =>  $srRow->sub_pro_name,
                                            'timestamp'     =>  date('d-m-Y H:i:s',strtotime($srRow->timestamp)),
                                            'subject_1'     =>  $s1,
                                            'subject_2'     =>  $s2,
                                            'subject_3'     =>  $s3,
                                            'subject_4'     =>  $s4,
                                            'subject_5'     =>  $s5,
                                            'subject_6'     =>  $s6
                                            );
                        endif;
                    endif;
                endforeach;
            endif;
//                echo '<pre>'; print_r($return_array); die;
            $exceldata="";
            if($return_array):
                foreach ($return_array as $row) {
                $exceldata[] = $row;
                }      

            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename='Subject_Alloted_Inter.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output');  
            endif;

        endif;
        

        $this->data['HeaderPage']       = 'Subject Alloted Report';
        $this->data['page_title']       = 'Subject Report | ECMS';
        $this->data['page']             = 'reports/Inter/student_subject_alloted_report';
        $this->load->view('common/common',$this->data);
    }
    
    public function sub_program_subject(){
    
        $subProId   =  $this->input->post('subPro'); 
        $result     = $this->CRUDModel->get_where_result('subject',array('sub_pro_id'=>$subProId));
                echo '<option value="">Select Subject</option>';
        foreach($result as $subRow):
            
            echo '<option value="'.$subRow->subject_id.'">'.$subRow->title.'</option>';
        endforeach;
  }
  
    public function admin_attendance_marks_history(){          
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
            
            $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
            $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
            $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
            
        endif;  
        
        $this->data['HeaderPage']   = 'All Student Attendance History';
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/v_admin_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
    
        
    public function auto_students_admin()
     { 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsAdmin('student_record');
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsAdmin('student_record',$like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    
    public function econ_attendance_marks_history()
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
            
        $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
        $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
        $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
        
        endif;        
        $this->data['HeaderPage']   = 'Student Attendance History (BS Economics)';
        $this->data['page_title']   = 'Student Attendance History | ECMS';
        $this->data['page']         = 'reports/attendance/v_econ_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
       
    public function auto_students_econ()
     { 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsbEcon('student_record');
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsbEcon('student_record',$like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
        public function hostel_attandance_marks_details_report(){
        
          
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program', 'programe_id', 'programe_name',array('status'=>'yes','program_type_id'=>1));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('status'=>'On'));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
          
            $this->data['college_no']       = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batch_id']         = '';
            
            
            if($this->input->post('search')):
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            $batch                          =  $this->input->post('prospectus_batch');
       
            //like Array
            $like = '';
            $where['student_record.s_status_id'] = 5;  
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
 
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
       
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                 
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
        
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id']  = $batch;
                $this->data['batch_id']      = $batch;
            endif;
         
                $this->data['result']       = $this->ReportsModel->hostel_student_attandance_marks_details($where,$like);
                $this->data['countResult']  = count($this->data['result']);
            endif; 
            $this->data['ReportName']   = 'Hostel Student Attendance and Marks Report';
            $this->data['page']         = "reports/admin/hostel_attendance_and_marks_report_v";
            $this->data['title']        = 'Hostel Student Attendance and Marks Report | ECMS';
            $this->load->view('common/common',$this->data); 
    }
    
    public function student_strength(){

        $this->data['programe_id']  = '';
        $this->data['sub_pro_id']  = '';
        $this->data['batchId']  = '';
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name',array('status'=>'on'));
        
        if($this->input->post('ExportData')):
            
            $pro_id     = $this->input->post('programe_id');
            $sub_id     = $this->input->post('sub_pro_id');
            $batch_id   = $this->input->post('batch');

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('SectionWiseStrength');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'Program');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Section Name');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Total Students');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
            for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }
        
            $where = '';
            if(!empty($pro_id)):
                $where['sections.program_id'] = $pro_id;
                $where_t['student_record.programe_id'] = $pro_id;
                $this->data['progId'] = $pro_id;
            endif;

            if(!empty($sub_id)):
                $where['sections.sub_pro_id'] = $sub_id;
                $where_t['student_record.sub_pro_id'] = $sub_id;
                $this->data['SProgId'] = $sub_id;
            endif;

            if(!empty($batch_id)):
                $where['sections.batch_id'] = $batch_id;
                $where_t['student_record.batch_id'] = $batch_id;
                $this->data['BtchId'] = $batch_id;
            endif;

            $query_t        = $this->ReportsModel->search_strength('sections', $where);

            $where_t['student_record.s_status_id'] = '6';
            $total_refund   = count($this->CRUDModel->get_where_result('student_record', $where_t));

            $where_t['student_record.s_status_id'] = '13';
            $total_left     = count($this->CRUDModel->get_where_result('student_record', $where_t));

            $where_t['student_record.s_status_id'] = '10';
            $total_migrated = count($this->CRUDModel->get_where_result('student_record', $where_t));

            $where_t['student_record.s_status_id'] = '8';
            $total_struckoff = count($this->CRUDModel->get_where_result('student_record', $where_t));
        
            if($query_t):

                $return_array = '';
                $sn = '';
                $total = '';
                foreach($query_t as $srRow):
                    $sn++;
                    $count_result = count($this->db
                            ->join('student_record', 'student_record.student_id=student_group_allotment.student_id')
                            ->get_where('student_group_allotment', array('student_group_allotment.section_id'=>$srRow->sectionId, 'student_record.s_status_id'=>'5'))
                            ->result());
                    $total+=$count_result;
                
                    $return_array[] = array(
                       'serial_no'     =>  $sn,
                       'program'       =>  $srRow->sub_program,
                       'section_name'  =>  $srRow->section_name,
                       'total_students' =>  $count_result,
                    );
                endforeach;
            
                $return_array[] = array(
                    'serial_no'     =>  '',
                    'program'       =>  '',
                    'section_name'  =>  'ENROLLED STUDENTS',
                    'total_students' =>  $total,
                 );
                 $return_array[] = array(
                    'serial_no'     =>  '',
                    'program'       =>  '',
                    'section_name'  =>  'REFUND STUDENTS',
                    'total_students' =>  $total_refund,
                 );
                 $return_array[] = array(
                    'serial_no'     =>  '',
                    'program'       =>  '',
                    'section_name'  =>  'LEFT',
                    'total_students' =>  $total_left,
                 );
                 $return_array[] = array(
                    'serial_no'     =>  '',
                    'program'       =>  '',
                    'section_name'  =>  'MIGRATED TO OTHER COLLEGE',
                    'total_students' =>  $total_migrated,
                 );
                 $return_array[] = array(
                    'serial_no'     =>  '',
                    'program'       =>  '',
                    'section_name'  =>  'STRUCK OFF',
                    'total_students' =>  $total_struckoff,
                 );
                
            endif;
            $exceldata="";
            foreach ($return_array as $row) {
                $exceldata[] = $row;
            }      

            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename='Student Strength List.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output');
            
        endif;
        
        $this->data['page']         = "reports/strength_report";
        $this->data['page_header']  = 'Students Strength Report';
        $this->data['page_title']   = 'Student Stregnth | ECMS';
        $this->load->view('common/common',$this->data);   
        
    }
    
    public function search_student_strength(){

        $pro_id     = $this->input->post('program');
        $sub_id     = $this->input->post('sub_program');
        $batch_id   = $this->input->post('batch');
        
        $where = '';
        
        if(!empty($pro_id)):
            $where['sections.program_id'] = $pro_id;
            $where_t['student_record.programe_id'] = $pro_id;
            $this->data['progId'] = $pro_id;
        endif;
        
        if(!empty($sub_id)):
            $where['sections.sub_pro_id'] = $sub_id;
            $where_t['student_record.sub_pro_id'] = $sub_id;
            $this->data['SProgId'] = $sub_id;
        endif;
        
        if(!empty($batch_id)):
            $where['sections.batch_id'] = $batch_id;
            $where_t['student_record.batch_id'] = $batch_id;
            $this->data['BtchId'] = $batch_id;
        endif;
        
        $query_t        = $this->ReportsModel->search_strength('sections', $where);
        
        $where_t['student_record.s_status_id'] = '6';
        $total_refund   = count($this->CRUDModel->get_where_result('student_record', $where_t));
        
        $where_t['student_record.s_status_id'] = '13';
        $total_left     = count($this->CRUDModel->get_where_result('student_record', $where_t));
        
        $where_t['student_record.s_status_id'] = '10';
        $total_migrated = count($this->CRUDModel->get_where_result('student_record', $where_t));
        
        $where_t['student_record.s_status_id'] = '8';
        $total_struckoff = count($this->CRUDModel->get_where_result('student_record', $where_t));
        
//        echo '<pre>'; print_r($query_t); die;
        if($query_t):
            $serial = '';
            $total  = '';
                echo '<div class="panel panel-theme">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>S No.</th>
                                    <th>Program</th>
                                    <th>Section Name</th>
                                    <th>Total Students</th>
                                </tr>
                            </thead>
                                <tbody>';
                                foreach($query_t as $wrow):
                                $serial++;
                                    echo '<tr>
                                        <td>'.$serial.'</td>
                                        <td>'.$wrow->sub_program.'</td>
                                        <td>'.$wrow->section_name.'</td>
                                        <td>';
                                        $count_result = count($this->db
                                                ->join('student_record', 'student_record.student_id=student_group_allotment.student_id')
                                                ->get_where('student_group_allotment', array('student_group_allotment.section_id'=>$wrow->sectionId, 'student_record.s_status_id'=>'5'))
                                                ->result());
                                        echo $count_result;
                                        $total+=$count_result;
                                        echo'</td>
                                    </tr>';
                                endforeach;   
                                echo '<tr>
                                    <td colspan="2"></td>
                                    <td><strong>ENROLLED STUDENTS</strong></td>
                                    <td><strong>'.$total.'</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><strong>REFUND STUDENTS</strong></td>
                                    <td><strong>'.$total_refund.'</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><strong>LEFT</strong></td>
                                    <td><strong>'.$total_left.'</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><strong>MIGRATED TO OTHER COLLEGE</strong></td>
                                    <td><strong>'.$total_migrated.'</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><strong>STRUCK OFF</strong></td>
                                    <td><strong>'.$total_struckoff.'</strong></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>';           
        endif;
    }
    
    public function budgeted_student(){
            $this->data['Inter']            = $this->ReportsModel->inter_enrollerd_students();
            $this->data['Bs_Economics']     = $this->ReportsModel->bs_enrollerd_students(array('student_record.programe_id'=>14));
            $this->data['BBA']              = $this->ReportsModel->bs_enrollerd_students(array('student_record.programe_id'=>6));
            $this->data['CS']               = $this->ReportsModel->bs_enrollerd_students(array('student_record.programe_id'=>2));
            $this->data['BSEnglish']        = $this->ReportsModel->bs_enrollerd_students(array('student_record.programe_id'=>8));
            $this->data['BSLaw']            = $this->ReportsModel->bs_enrollerd_students(array('student_record.programe_id'=>9));
            $this->data['HND']              = $this->ReportsModel->bs_enrollerd_students(array('student_record.programe_id'=>3));
            $this->data['EDSML']            = $this->ReportsModel->bs_enrollerd_students(array('student_record.programe_id'=>7));
            $this->data['ALEVEL']           = $this->ReportsModel->alevel_enrollerd_students();
            
            $this->data['ReportName']   = 'Budgeted Student Report';
            $this->data['page']         = "reports/admin/budgeted_student_report_v";
            $this->data['title']        = 'Budgeted Student Report | ECMS';
            $this->load->view('common/common',$this->data); 
    }
      public function student_cumulative_montly(){
         
          $this->data['Result'] = array();  
          $this->data['student_id'] = '';
          if($this->input->post('search')):
               
            $student_id       =  $this->input->post('student_id');
            $like = '';
            $where = '';
           
            if(!empty($student_id)):
                $where['students_cumulative_montly.student_id'] = $student_id;
                $this->data['student_id']           = $student_id;
            endif;
            
            $this->data['Result'] = $this->ReportsModel->student_cumulitive_montly_report($where);
        endif;  
        
        $this->data['HeaderPage']   = 'Student Cumulative Montly';
        $this->data['page_title']   = 'Student Cumulative Montly | ECMS';
        $this->data['page']         = 'reports/admin/admin_cumulative_montly_report_v';
        $this->load->view('common/common',$this->data);
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
            $this->data['page']         = "reports/Inter/student_attendance_percentage_wise_v";
            $this->data['page_title']        = 'Attendance Percentage Report ( Enrolled Students )| ECMS';
            $this->load->view('common/common',$this->data); 
    }
        public function bs_white_cards(){
         
            $this->data['program']          = $this->dropdownModel->bs_program_dropDown('programes_info', 'Select', 'programe_id', 'programe_name',array('status'=>'yes','degree_type_id'=>'2'));
            $this->data['subprogram']       = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>'6'));
            $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Select Sections', 'sec_id', 'name',array('status'=>'On','sub_pro_id'=>'44'));
            $this->data['status']           = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name',array('s_status_id !='=>1));
             
            $this->data['from']             = '';
            $this->data['college_no']       = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['programId']        = '';
            $this->data['batchId']          = '';
            $this->data['subprogramId']     = '';
            $this->data['sectionId']        = '';
            $this->data['statusId']         = '';
            
     
            if($this->input->post('search')):
                $form_no                     =  $this->input->post('from_no');
                $college_no                  =  $this->input->post('college_no');
                $student_name                =  $this->input->post('student_name');
                $father_name                 =  $this->input->post('father_name');
                $program                     =  $this->input->post('program');
                $sub_program                 =  $this->input->post('sub_program');
                $section                     =  $this->input->post('sections_name');
                $student_status              =  $this->input->post('student_status');
                
                $this->data['subprogram']           = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>$program));
                if(!empty($sub_program)):
                    $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Select Sections ', 'sec_id', 'name',array('status'=>'On','sub_pro_id'=>$sub_program));
                else:
                    $this->data['section']          = array(''=>'Select Sections');
                endif;
                
                
                $like = '';
                $where['degree_type_id'] = '2';
                if(!empty($form_no)):
                    $where['form_no']           = $form_no;
                    $this->data['from']         = $form_no;
                endif;
                if(!empty($college_no)):
                    $where['college_no']        = $college_no;
                    $this->data['college_no']   = $college_no;
                endif;
                if(!empty($student_name)):
                    $like['student_name']       = $student_name;
                    $this->data['student_name'] = $student_name;
                endif;
                
                if(!empty($father_name)):
                    $like['father_name']        = $father_name;
                    $this->data['father_name']  = $father_name;
                endif;
                
                if(!empty($program)):
                    $where['student_record.programe_id'] = $program;
                    $this->data['programId']    = $program;
                endif;
                if(!empty($sub_program)):
                    $where['sub_programes.sub_pro_id'] = $sub_program;
                    $this->data['subprogramId']         = $sub_program;  
                endif;
                if(!empty($section)):
                     $where['sections.sec_id']  = $section;
                    $this->data['sectionId']    = $section;
                endif;
                if(!empty($student_status)):
                     $where['student_status.s_status_id']  = $student_status;
                    $this->data['statusId']    = $student_status;
                endif;
                
                $custom['column']       = 'student_record.college_no';
                $custom['order']        = 'asc';
                $where['student_record.s_status_id !='] = 1;
                $where['programes_info.degree_type_id'] = 2;
                 $this->data['result']       = $this->ReportsModel->bs_program_white_card_rpt($where,$like,$custom);
                   
           endif;         
           
            
            
            $this->data['ReportName']   = 'White Card (BS-Program)';
            $this->data['page']         = "reports/bs_department/bs_department_white_card"; 
            $this->data['title']        = 'White Card  (BS-Program)| ECMS';
            $this->load->view('common/common',$this->data); 
          
        }
        
      public function bs_programes_attendance_marks_history(){          
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
            
            $this->data['std'] = $this->ReportsModel->student_Datainfo('student_record',$where);
            $this->data['sub_program'] = $this->ReportsModel->student_subProgram('student_comulative_attendance',$where1);
        
            $sectionId = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            if(!empty($sectionId)):
                $this->data['sectio_id_curr'] = $sectionId->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId->section_id));
                if($CheckStd):
                    $this->data['class_id'] =  $CheckStd->class_id;
                    $this->data['flag']     =  $CheckStd->flag;

                    if($CheckStd->flag==1):  
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$sectionId->section_id)); 
                    else:
                        $this->data['result']   = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$student_id,'student_subject_alloted.section_id'=>$sectionId->section_id)); 
                    endif; 
                endif; 
            endif;
        
        endif;        
        $this->data['HeaderPage']   = 'Attendance & Mark History (BS-Program)';
        $this->data['page_title']   = 'Attendance & Mark History (BS-Program) | ECMS';
        $this->data['page']         = 'reports/bs_department/bs_department_attendance_marks_history';
        $this->load->view('common/common',$this->data);
    }
    public function bs_program_student_search_auto(){ 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->ReportsModel->getStudentsbBsProgram();
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->ReportsModel->getStudentsbBsProgram($like);
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
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    
    public function bslaw_prev_exam_result(){
        $this->data['ReportName']   = 'BS Law Previous Exam Report ';
        $this->data['page_title']   = 'BS Law Previous Exam Report | ECMS';
        $this->data['page']         = 'reports/bs_department/bs_exam_board_report_law_prev';
        $this->load->view('common/common',$this->data);
    }
    public function bslaw_prev_exam_search(){
        
        if($this->input->post()):
            $emp_id         = $this->input->post('TeacherId');
            $test_date      = $this->input->post('TestDate');
            $subject_id     = $this->input->post('SubjId');
            $where['subject.program_id'] = "9";
            $where['exb_class_status'] = "2";
        
        if($emp_id):
            $where['hr_emp_record.emp_id'] = $emp_id;
            $this->data['emp_id'] =$emp_id;
        endif;
         
        if($test_date):
            $where['YEAR(exams_bs.exb_test_date)'] = $test_date;
            $this->data['sec_id'] =$test_date;
        endif;
           
        if($subject_id):
            $where['subject.subject_id'] = $subject_id;
            $this->data['subject_id'] =$subject_id;
        endif;
         
            $this->data['result'] = $this->ReportsModel->bs_program_exam_prev($where);
//            echo '<pre>'; print_r($this->data['result']); die;
        endif;
        
        $this->load->view('reports/bs_department/bs_exam_board_search_prev_js',$this->data);
    }
    
    public function bs_prev_exam_result(){
        $this->data['ReportName']   = 'BS Previous Exam Report ';
        $this->data['page_title']   = 'BS Previous Exam Report | ECMS';
        $this->data['page']         = 'reports/bs_department/bs_exam_board_report_prev';
        $this->load->view('common/common',$this->data);
    }
    public function prev_exam_search(){
        
        if($this->input->post()):
            $emp_id         = $this->input->post('TeacherId');
            $test_date      = $this->input->post('TestDate');
            $subject_id     = $this->input->post('SubjId');
            $where['degree_type_id'] = "2";
            $where['exb_class_status'] = "2";
        
        if($emp_id):
            $where['hr_emp_record.emp_id'] = $emp_id;
            $this->data['emp_id'] =$emp_id;
        endif;
         
        if($test_date):
            $where['YEAR(exams_bs.exb_test_date)'] = $test_date;
            $this->data['sec_id'] =$test_date;
        endif;
           
        if($subject_id):
            $where['subject.subject_id'] = $subject_id;
            $this->data['subject_id'] =$subject_id;
        endif;
         
            $this->data['result'] = $this->ReportsModel->bs_program_exam_prev($where);
//            echo '<pre>'; print_r($this->data['result']); die;
        endif;
        
        $this->load->view('reports/bs_department/bs_exam_board_search_prev_js',$this->data);
    }
    
    public function bs_exame_result_law(){
        $this->data['ReportName']   = 'BS Law Exam Report ';
        $this->data['page_title']   = 'BS Law Exam Report | ECMS';
        $this->data['page']         = 'reports/bs_department/bs_exam_board_report_law';
        $this->load->view('common/common',$this->data);
    }
    
    public function bs_program_search_law(){
        
        if($this->input->post()):
            $emp_id         = $this->input->post('TeacherId');
            $sec_id         = $this->input->post('SectionId');
            $subject_id     = $this->input->post('SubjId');
            $where['sections.program_id'] = "9";
        
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
         
            $this->data['result'] = $this->ReportsModel->bs_program_exame($where);
//            echo '<pre>'; print_r($this->data['result']); die;
        endif;
        
        $this->load->view('reports/bs_department/bs_exam_board_search_js',$this->data);
    }
    
    public function bs_exame_result(){
        $this->data['ReportName']   = 'BS Exame Report ';
        $this->data['page_title']   = 'BS Exame Report | ECMS';
        $this->data['page']         = 'reports/bs_department/bs_exam_board_report';
        $this->load->view('common/common',$this->data);
    }
    
    public function bs_program_search(){
        
        if($this->input->post()):
            $emp_id         = $this->input->post('TeacherId');
            $sec_id         = $this->input->post('SectionId');
            $subject_id     = $this->input->post('SubjId');
            $where['degree_type_id'] = "2";
        
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
         
            $this->data['result'] = $this->ReportsModel->bs_program_exame($where);
//            echo '<pre>'; print_r($this->data['result']); die;
        endif;
        
        $this->load->view('reports/bs_department/bs_exam_board_search_js',$this->data);
    }
    
    public function bslaw_exame_result_print(){
        
        $emp_id     = $this->uri->segment(3);
        $sec_id     = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        
        $where['sections.program_id'] = "9";
         
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
         
        $this->data['result'] = $this->ReportsModel->bs_program_exame($where);
//        echo '<pre>'; print_r($this->data['result']); die;
        
        $this->data['ReportName']   = 'BS Exame Report Print';
        $this->data['page_title']   = 'BS Exame Report | ECMS';
        $this->data['page']         = 'reports/bs_department/bs_exam_board_report_print';
        $this->load->view('common/common',$this->data);
        
//        $this->load->view('reports/bs_department/bs_exam_board_report_print',$this->data);
    }
    
    public function bs_exame_result_print(){
        
        $emp_id     = $this->uri->segment(3);
        $sec_id     = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        
        $where['degree_type_id'] = "2";
        
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
         
        $this->data['result'] = $this->ReportsModel->bs_program_exame($where);
//        echo '<pre>'; print_r($this->data['result']); die;
        
        $this->data['ReportName']   = 'BS Exame Report Print';
        $this->data['page_title']   = 'BS Exame Report | ECMS';
        $this->data['page']         = 'reports/bs_department/bs_exam_board_report_print';
        $this->load->view('common/common',$this->data);
        
//        $this->load->view('reports/bs_department/bs_exam_board_report_print',$this->data);
    }
    
    public function bs_exam_award_list(){
        
        $test_id = $this->uri->segment(2);
        
        $this->data['sec_info'] = $this->ReportsModel->get_test_info(array('exb_test_id'=>$test_id));
        $this->data['result']   = $this->ReportsModel->get_test_detail(array('exbd_test_id'=>$test_id));
//        echo '<pre>'; print_r($this->data['result']); die;
        $this->data['page']     =   "reports/bs_department/bs_award_list";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
        
    }	
    
    public function bs_exam_award_list_prev(){
        
        $test_id = $this->uri->segment(2);
        
        $this->data['sec_info'] = $this->ReportsModel->get_test_info_prev(array('exb_test_id'=>$test_id));
        $this->data['result']   = $this->ReportsModel->get_test_detail(array('exbd_test_id'=>$test_id));
//        echo '<pre>'; print_r($this->data['result']); die;
        $this->data['page']     =   "reports/bs_department/bs_award_list";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
        
    }	
    
    public function aggregate_result(){
        
        $class_id = $this->uri->segment(2);
        
        $this->data['sec_info'] = $this->ReportsModel->get_test_info(array('exb_class_id'=>$class_id));
        $this->data['result']   = $this->ReportsModel->get_test_students(array('class_alloted.class_id'=>$class_id, 'student_record.s_status_id'=>'5'));
//        echo '<pre>'; print_r($this->data['result']); die;
        $this->data['page']     =   "reports/bs_department/aggregate_result";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
        
    }	
    
    public function aggregate_result_prev(){
        
        $class_id = $this->uri->segment(2);
        
        $this->data['sec_info'] = $this->ReportsModel->get_test_info_prev(array('exb_class_id'=>$class_id));
        $this->data['result']   = $this->ReportsModel->get_test_students_prev(array('exams_bs.exb_class_id'=>$class_id, 'student_record.s_status_id'=>'5'));
//        echo '<pre>'; print_r($this->data['result']); die;
        $this->data['page']     =   "reports/bs_department/aggregate_result_prev";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
        
    }	
    
    public function uop_result(){
        
        $class_id = $this->uri->segment(2);
        
        $this->data['sec_info'] = $this->ReportsModel->get_test_info(array('exb_class_id'=>$class_id));
        $this->data['result']   = $this->ReportsModel->get_test_students(array('class_alloted.class_id'=>$class_id, 'student_record.s_status_id'=>'5'), 'student_record.bs_enrollment_no');
//        echo '<pre>'; print_r($this->data['result']); die;
        $this->data['page']     =   "reports/bs_department/uop_result";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
        
    }	
    
    public function uop_result_print(){
        
        $class_id = $this->uri->segment(2);
        
        $this->data['sec_info'] = $this->ReportsModel->get_test_info(array('exb_class_id'=>$class_id));
        $this->data['result']   = $this->ReportsModel->get_test_students(array('class_alloted.class_id'=>$class_id, 'student_record.s_status_id'=>'5'), 'student_record.bs_enrollment_no');
//        echo '<pre>'; print_r($this->data['result']); die;
//        $this->data['page']     =   "reports/bs_department/uop_result_print";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view("reports/bs_department/uop_result_print",$this->data);
        
    }
    
    public function uop_prev_result(){
        
        $class_id = $this->uri->segment(2);
        
        $this->data['sec_info'] = $this->ReportsModel->get_test_info_prev(array('exb_class_id'=>$class_id));
        $this->data['result']   = $this->ReportsModel->get_test_students_prev(array('exams_bs.exb_class_id'=>$class_id, 'student_record.s_status_id'=>'5'), 'student_record.bs_enrollment_no');
//        echo '<pre>'; print_r($this->data['result']); die;
        $this->data['page']     =   "reports/bs_department/uop_result_prev";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
        
    }	
    
    public function uop_prev_result_print(){
        
        $class_id = $this->uri->segment(2);
        
        $this->data['sec_info'] = $this->ReportsModel->get_test_info_prev(array('exb_class_id'=>$class_id));
        $this->data['result']   = $this->ReportsModel->get_test_students_prev(array('exams_bs.exb_class_id'=>$class_id, 'student_record.s_status_id'=>'5'), 'student_record.bs_enrollment_no');
//        echo '<pre>'; print_r($this->data['result']); die;
//        $this->data['page']     =   "reports/bs_department/uop_result_print";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view("reports/bs_department/uop_result_print_prev",$this->data);
        
    }
    
    public function student_shit_wise_report(){
        
        
         $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Select Program', 'programe_id', 'programe_name',array('status'=>'yes'));
         $this->data['subprogram']       = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>'6'));
         $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name',array('s_status_id !='=>1));
         $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
        
         
        $this->data['ReportName']    =   'Shitt Wise Report';
        $this->data['title']    =   'Shift Wise Report | ECMS';
        $this->data['page']     =   "reports/admin/student_shift_wise_report";
        $this->load->view('common/common',$this->data);
    }
    public function student_shit_wise_report_search(){

            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $batch          = $this->input->post("batch_id");
            $s_status_id    = $this->input->post("s_status_id");
            $gender         = $this->input->post("gender_id");
            
            $where = '';
            if($gender):
                $where['gender.gender_id']= $gender;
            endif;
            if($programe_id):
                $where['programes_info.programe_id']= $programe_id;
                $this->data['programe_id']          = $programe_id;
            endif;
            if($programe_id):
                $where['programes_info.programe_id']= $programe_id;
                $this->data['programe_id']          = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
             
            if(!empty($batch)):
                $where['prospectus_batch.batch_id']  = $batch;
                $this->data['batchId']              = $batch;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id']  = $s_status_id;
                $this->data['application_statusId']   = $s_status_id;
            endif;
            $result = $this->ReportsModel->student_shit_wise_report_search($where);
            
            echo json_encode($result);
    }
    public function teacher_attendance_month_wise_report(){

        if($this->input->post('ExportMonthWise')):
           
          $year       = $this->input->post('Year');
          $month      = $this->input->post('Month');
          $heading    = array();
          $days       = cal_days_in_month(CAL_GREGORIAN,$month,$year);
          $i          = '';
          
          $heading['S#']      = 'S.No';
          $heading['Teacher_Name']      = date('F, Y',strtotime('1-'.$month.'-'.$year));
                for($i=1 ;$i<=$days ; $i++):
                  $heading[$i]  = $i;
                endfor;
                $heading['Total']   = 'Total';
                $return_data        = array();
                $return_dataCount   = '0';
                $return_data[$return_dataCount] =  $heading;
                $where  = array(
                      'emp_status_id' => 1,
                      'cat_id'        => 1,
                       // 'user_status'   => 1
                           'emp_id !='        =>'255'
                      );
                          $this->db->join('users','users.user_empId=hr_emp_record.emp_id');
                          $this->db->order_by('emp_name','asc');
                          $this->db->group_by('emp_id');
          $result     =   $this->db->get_where('hr_emp_record',$where)->result(); 
              if($result):
                  $data   = array();
                  foreach($result as $rowEmp):
                      $return_dataCount++;
                      $total_count = '';
                          $data['$#']             = $return_dataCount;
                          $data['Teacher_Name']   = $rowEmp->emp_name;
                          for($i=1 ;$i<=$days ; $i++):
                              $pricital_count = '';
                            //   $id= $this->db->get_where('users',array('user_empId'=>$rowEmp->emp_id))->row();
                              //Normal Class Count ------------------------------------------
                                $where = array(
                                //    'emp_id'            => $rowEmp->emp_id,
                                    'student_attendance.user_id'    => $rowEmp->id,
                                    'attendance_date'               => $year.'-'.$month.'-'.$i,
                                    'ca_merge_id'                   => '0'
                                    // 'timetable.day_id'              => date('N',strtotime($year.'-'.$month.'-'.$i))
                                );
                                      $this->db->select('count(*) as total');  
                                      $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                      // $this->db->join('timetable','timetable.class_id=class_alloted.class_id');
                                      // $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id','left outer'); 
                                      // $this->db->order_by('class_starting_time.class_stime','asc');
                                      // $this->db->group_by('class_starting_time.class_stime');
                              $return_notmerge = $this->db->get_where('student_attendance',$where)->row();
                              $total_att_count ='';
                              if(isset($return_notmerge->total) && !empty($return_notmerge->total)):
                                  $total_att_count  += $return_notmerge->total;
                                  $total_count      += $return_notmerge->total;  
                              endif; 

                              //Merg Class Count ------------------------------------------
                                  $where_mer = array(
                                      'student_attendance.user_id'    => $rowEmp->id,
                                       // 'emp_id'            => $rowEmp->emp_id,
                                      'attendance_date'               => $year.'-'.$month.'-'.$i,
                                      'ca_merge_id !='                => '0'
                                      );    
                                //                   $this->db->select('count(*) as total');   
                                //                   $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                //                   $this->db->group_by('class_alloted.ca_merge_id');
                                //   $return_merge = $this->db->get_where('student_attendance',$where_mer)->row();
                                
                                // if(isset($return_merge) && !empty($return_merge)):
                                //     // $data[$i]       = count($return_merge);
                                //     $total_att_count  += $return_merge->total; 
                                //     $total_count      += $return_merge->total;  
                                // endif; 

                                                    $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                                    $this->db->group_by('class_alloted.ca_merge_id');                                                
                                    $return_merge = $this->db->get_where('student_attendance',$where_mer)->result();
                            
                                    if(isset($return_merge) && !empty($return_merge)):
                                        $total_att_count  += count($return_merge); 
                                        $total_count      += count($return_merge);  
                                    endif; 

                          

                                //Get practical attendance 
                                  $where_pract= array(
                                      'user_id'               =>$rowEmp->id,
                                      //  'emp_id'               =>$rowEmp->emp_id,
                                      'attendance_date'      => $year.'-'.$month.'-'.$i,
                                  );
                                            $this->db->select('count(*) as total');  
                                            $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
                                  $pract =  $this->db->get_where('practical_alloted', $where_pract)->result();
                                  
                                  if(isset($pract->total) && !empty( $pract->total)):
                                      $total_att_count  += $pract->total;
                                      $total_count      += $pract->total; 
                                  endif;
                                  if($total_att_count):
                                      $data[$i] =$total_att_count;
                                  else:
                                      $data[$i] = '';
                                  endif;
                              endfor;
                          $data['Total']                  = $total_count; 
                          $return_data[$return_dataCount] = $data;
                  endforeach; 
              endif;
              $exceldata = $return_data;
                  

              $this->load->library('excel');
              $date = date('d-m-Y H:i:s');
              $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A1');
              $filename='Teacher Attendace Month wise '.$date.'.xls';
              header('Content-Type: application/vnd.ms-excel');
              header('Content-Disposition: attachment;filename="'.$filename.'"'); 
              header('Cache-Control: max-age=0'); 
              $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
              $objWriter->save('php://output');
          redirect('TeacherAtndMonthWise','refresh'); 
       endif;
        if($this->input->post('search')):
           
          $year       = $this->input->post('Year');
          $month      = $this->input->post('Month');
          $heading    = array();
          $days       = cal_days_in_month(CAL_GREGORIAN,$month,$year);
          $i          = '';
          
          $heading['S#']      = 'S.No';
          $heading['Teacher_Name']      = date('F, Y',strtotime('1-'.$month.'-'.$year));
                for($i=1 ;$i<=$days ; $i++):
                  $heading[$i]  = $i;
                endfor;
                $heading['Total']   = 'Total';
                $return_data        = array();
                $return_dataCount   = '0';
                $return_data[$return_dataCount] =  $heading;
                $where  = array(
                      'emp_status_id' => 1,
                      'cat_id'        => 1,
                       // 'user_status'   => 1
                        //    'emp_id'        =>'192'
                        'emp_id !='        =>'255'
                      );
                          $this->db->join('users','users.user_empId=hr_emp_record.emp_id');
                          $this->db->order_by('emp_name','asc');
                          $this->db->group_by('emp_id');
          $result     =   $this->db->get_where('hr_emp_record',$where)->result(); 
              if($result):
                  $data   = array();
                  foreach($result as $rowEmp):
                      $return_dataCount++;
                      $total_count = '';
                          $data['$#']             = $return_dataCount;
                          $data['Teacher_Name']   = $rowEmp->emp_name;
                          for($i=1 ;$i<=$days ; $i++):
                           
                            //   $id= $this->db->get_where('users',array('user_empId'=>$rowEmp->emp_id))->row();
                              //Normal Class Count ------------------------------------------
                                $where = array(
                                //    'emp_id'            => $rowEmp->emp_id,
                                    'student_attendance.user_id'    => $rowEmp->id,
                                    'attendance_date'               => $year.'-'.$month.'-'.$i,
                                    'ca_merge_id'                   => '0'
                                    
                                );
                                      $this->db->select('count(*) as total');  
                                      $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                      
                              $return_notmerge = $this->db->get_where('student_attendance',$where)->row();
                              $total_att_count ='';
                              if(isset($return_notmerge) && !empty($return_notmerge)):
                                  $total_att_count  += $return_notmerge->total;
                                  $total_count      += $return_notmerge->total;  
                              endif; 

                              //Merg Class Count ------------------------------------------
                                  $where_mer = array(
                                      'student_attendance.user_id'    => $rowEmp->id,
                                       // 'emp_id'            => $rowEmp->emp_id,
                                      'attendance_date'               => $year.'-'.$month.'-'.$i,
                                      'ca_merge_id >'                => '0'
                                      );    
                                                  
                                                  $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                                  $this->db->group_by('class_alloted.ca_merge_id');                                                
                                  $return_merge = $this->db->get_where('student_attendance',$where_mer)->result();
                          
                                  if(isset($return_merge) && !empty($return_merge)):
                                      $total_att_count  += count($return_merge); 
                                      $total_count      += count($return_merge);  
                                  endif; 

                                //Get practical attendance 
                                  $where_pract= array(
                                      'user_id'               =>$rowEmp->id,
                                      //  'emp_id'               =>$rowEmp->emp_id,
                                      'attendance_date'      => $year.'-'.$month.'-'.$i,
                                  );
                                            $this->db->select('count(*) as total');  
                                            $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
                                  $pract =  $this->db->get_where('practical_alloted', $where_pract)->result();
                                  
                                  if(isset($pract->total) && !empty( $pract->total)):
                                      $total_att_count  += $pract->total;
                                      $total_count      += $pract->total; 
                                  endif;
                                  if($total_att_count):
                                      $data[$i] =$total_att_count;
                                  else:
                                      $data[$i] = '';
                                  endif;
                              endfor;
                          $data['Total']                  = $total_count; 
                          $return_data[$return_dataCount] = $data;
                  endforeach; 
              endif;
              $this->data['result'] = $return_data;
                  

               
       endif;
       
      $this->data['months']          = $this->CRUDModel->dropDown('month', '', 'mth_num', 'mth_title',array('mth_status'=>'1')); 
      $this->data['year']             = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num',array('yr_status'=>'1')); 
      $this->data['ReportName']       = 'Teacher Attendance ( Month Wise )';
      $this->data['page_title']       = 'Student Attendance ( Month Wise ) | ECMS';
      $this->data['page']             =  'reports/admin/teacher_attendance_month_wise';
      $this->load->view('common/common',$this->data); 
  }
    
  
     public function teacher_attendance_month_wise_report_with_current_date(){
         
         
         if($this->input->post('search')):
             
            $year       = $this->input->post('Year');
            $month      = $this->input->post('Month');
            $heading    = array();
            $days       = cal_days_in_month(CAL_GREGORIAN,$month,$year);
            $i          = '';
            
            $heading['S#']                  = 'S.No';
            $heading['Teacher_Name']        = date('F, Y',strtotime('1-'.$month.'-'.$year));
            for($i=1 ;$i<=$days ; $i++):
                $heading[$i]                = $i;
            endfor;
            
            $heading['Total']               = 'Total';
            $return_data                    = array();
            $return_dataCount               = '0';
            $return_data[$return_dataCount] =  $heading;

            $where      = array('emp_status_id'=>1,'cat_id'=>1,'user_status'=>1);
                            $this->db->join('users','users.user_empId=hr_emp_record.emp_id');
                            $this->db->order_by('emp_name','asc');
                            $this->db->group_by('emp_id');
            $result     = $this->db->get_where('hr_emp_record',$where)->result();
//             echo '<pre>';print_r($result);die;
//             $return_dataCount = '0';
              if($result):
                        $data           = array();
                       foreach($result as $rowEmp):
                           $return_dataCount++;
                            $total_count = ''; 
                            
                            $data['$#']             = $return_dataCount;
                            $data['Teacher_Name']   = $rowEmp->emp_name;
                            
                            for($i=1 ;$i<=$days ; $i++):
                                $id= $this->db->get_where('users',array('user_empId'=>$rowEmp->emp_id))->row();
                                $where = array(
                                //    'emp_id'            => '110',
                                    'student_attendance.user_id'    => @$id->id,
                                    'attendance_date'               => $year.'-'.$month.'-'.$i,
                                    // 'timetable.day_id'              => date('N',strtotime($year.'-'.$month.'-'.$i))
                                );
                                        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                        // $this->db->join('timetable','timetable.class_id=class_alloted.class_id');
                                        // $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id','left outer'); 
                                        // $this->db->order_by('class_starting_time.class_stime','asc');
                                        // $this->db->group_by('class_starting_time.class_stime');

                                        // $this->db->group_by('class_alloted.ca_merge_id');
                            $return = $this->db->get_where('student_attendance',$where)->result();
                             
                            if($return):
                                $data[$i]       = count($return);
                                $total_count    +=count($return);  
                                else:
                                    $data[$i] = '';
                                 endif;  
                                 
                            endfor;
                            $data['Total']                  = $total_count; 
                            $return_data[$return_dataCount] = $data;
                        endforeach; 
                       endif;
                       $exceldata = $return_data;
                  
         endif;
         if($this->input->post('ExportMonthWise')):
             
            $year       = $this->input->post('Year');
            $month      = $this->input->post('Month');
            $heading    = array();
            $days       = cal_days_in_month(CAL_GREGORIAN,$month,$year);
            $i          = '';
            
            $heading['S#']                  = 'S.No';
            $heading['Teacher_Name']        = date('F, Y',strtotime('1-'.$month.'-'.$year));
            for($i=1 ;$i<=$days ; $i++):
                $heading[$i]                = $i;
            endfor;
            
            $heading['Total']               = 'Total';
            $return_data                    = array();
            $return_dataCount               = '0';
            $return_data[$return_dataCount] =  $heading;

            $where      = array('emp_status_id'=>1,'cat_id'=>1,'user_status'=>1);
                            $this->db->join('users','users.user_empId=hr_emp_record.emp_id');
                            $this->db->order_by('emp_name','asc');
                            $this->db->group_by('emp_id');
            $result     = $this->db->get_where('hr_emp_record',$where)->result();
//             echo '<pre>';print_r($result);die;
//             $return_dataCount = '0';
              if($result):
                        $data           = array();
                       foreach($result as $rowEmp):
                           $return_dataCount++;
                            $total_count = ''; 
                            
                            $data['$#']             = $return_dataCount;
                            $data['Teacher_Name']   = $rowEmp->emp_name;
                            
                            for($i=1 ;$i<=$days ; $i++):
                                $id= $this->db->get_where('users',array('user_empId'=>$rowEmp->emp_id))->row();
                                $where = array(
                                //    'emp_id'            => '110',
                                    'student_attendance.user_id'    => @$id->id,
                                    'attendance_date'               => $year.'-'.$month.'-'.$i,
                                    // 'timetable.day_id'              => date('N',strtotime($year.'-'.$month.'-'.$i))
                                );
                                        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                        // $this->db->join('timetable','timetable.class_id=class_alloted.class_id');
                                        // $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id','left outer'); 
                                        // $this->db->order_by('class_starting_time.class_stime','asc');
                                        // $this->db->group_by('class_starting_time.class_stime');

                                        // $this->db->group_by('class_alloted.ca_merge_id');
                            $return = $this->db->get_where('student_attendance',$where)->result();
                             
                            if($return):
                                $data[$i]       = count($return);
                                $total_count    +=count($return);  
                                else:
                                    $data[$i] = '';
                                 endif;  
                                 
                            endfor;
                            $data['Total']                  = $total_count; 
                            $return_data[$return_dataCount] = $data;
                        endforeach; 
                       endif;
                       $exceldata = $return_data;
                    //    echo '<pre>';print_r($return_data);die;
                  $this->load->library('excel');
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A1');
                $filename='Teacher Attendace Month wise '.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
             
              redirect('TeacherAtndMonthWise','refresh'); 
         endif;
         
        $this->data['months']          = $this->CRUDModel->dropDown('month', '', 'mth_num', 'mth_title',array('mth_status'=>'1')); 
        $this->data['year']             = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num',array('yr_status'=>'1')); 
        $this->data['ReportName']       = 'Teacher Attendance ( Month Wise )';
        $this->data['page_title']       = 'Student Attendance ( Month Wise ) | ECMS';
        $this->data['page']             =  'reports/admin/teacher_attendance_month_wise';
        $this->load->view('common/common',$this->data); 
    }
    public function teacher_attendance_month_wise_report_result(){
        if($this->input->post()):
                                        $where = array('emp_status_id'=>1,'cat_id'=>1);
                                        $this->db->join('users','users.user_empId=hr_emp_record.emp_id');    
            $this->data['result']   =   $this->db->get_where('hr_emp_record',$where)->result();
        endif;
     $this->load->view('reports/admin/jQuery_v/teacher_month_wise_js',$this->data); 
    }
   
    public function student_attendance_report_degree_results(){
 
            $student_id = $this->uri->segment(2);
            $section_id = $this->uri->segment(3);
 
            $this->data['student_id'] = $this->uri->segment(2);
            $this->data['section_id'] = $this->uri->segment(3);
            
            
            $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$section_id));
            $this->data['class_id'] =  $CheckStd->class_id;
            $this->data['flag']     =  $CheckStd->flag;
            if($CheckStd->flag==1):
               $this->data['result']           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$section_id)); 
              
            else:
                $this->data['result']           = $this->ReportsModel->get_whiteCard_section(
                        array(
                            'student_subject_alloted.student_id'=>$student_id,
                            'student_subject_alloted.section_id'=>$section_id
                        )); 
            
            endif;
//            echo '<pre>'; print_r($this->data['result']); die;
                          $this->db->select('date_format(student_attendance_details.timestamp, "%M") as attendance_month, date_format(student_attendance_details.timestamp, "%Y-%m") as month_year');
                          $this->db->join('student_attendance', 'student_attendance.attend_id=student_attendance_details.attend_id', 'left outer');
                          $this->db->order_by('student_attendance.attendance_date', 'desc');
                          $this->db->group_by('date_format(student_attendance_details.timestamp, "%M")');
            $this->data['get_month'] = $this->db->get_where('student_attendance_details', array('student_id' => $student_id))->result();
            
//            echo '<pre>'; print_r($this->data['get_month']); die;
            
            $this->data['program']          = 'Degree';
            $this->data['page_title']       = 'Student Attendance Report Degree Result | ECMS';
            $this->data['page']             =  'reports/admin/SARDRI';
            $this->load->view('common/common',$this->data); 
        }    
        public function student_attendance_defaulter_excel(){

        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        
        $this->data['college_no']  = '';
        $this->data['message']      = '';
        $this->data['gender_id']    = '';
        $this->data['status_id']    = '5';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        $this->data['message']      = '';
        $this->data['Percentage']   = '';
        $this->data['dateFrom']     = date('d-m-Y');
        $this->data['dateTo']       = date('d-m-Y');
        
        
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message        = $this->input->post("message");
            $student_status = $this->input->post("student_status");
            $smsPassword    = $this->input->post("smsPassword");
            $dateFrom       = $this->input->post("dateFrom");
            $dateTo         = $this->input->post("dateTo");
            $Percentage     = $this->input->post("Percentage");
            
            $this->data['dateFrom']     = $this->input->post("dateFrom");
            $this->data['dateTo']       = $this->input->post("dateTo");
            
            if(!empty($smsPassword)):
                $this->data['smsPassword']     = $smsPassword;
            endif;
            
            $where['message_flag']      = '1';
            $like       = '';
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['college_no']           = $collegeNo;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;
            
            if(!empty($message)):
                    $this->data['message']     = $message;
            endif;
            if(!empty($Percentage)):
                    $this->data['Percentage']     = $Percentage;
            endif;
        if($this->input->post('search')):
            $this->data['result'] = $this->SmsModel->student_fee_sms_date_wise($where,$like,$dateFrom,$dateTo);
        endif;
        if($this->input->post('Export')):
                
        
             
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Merit list');
                
                $this->excel->getActiveSheet()->setCellValue('A1', 'S.No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('B1', 'College #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Student Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Father Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Section');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('F1','Applicant Mobile #');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('G1','Guardian Mobile #');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(11);
    
                $this->excel->getActiveSheet()->setCellValue('H1','Absent');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Present');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Total');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Percentage');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(11);
            
                
                
       for($col = ord('A'); $col <= ord('K'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }              
            
            $result = $this->SmsModel->student_fee_sms_date_wise($where,$like,$dateFrom,$dateTo);
            $sn = '';
        foreach ($result as $row){
                $sn++;
                $exceldata[] = array(
                    'Serial_No'     => $sn,
                    'college_no'    => $row->college_no,
                    'student_name'  => $row->student_name,
                    'father_name'   => $row->father_name,
                    'sessionName'   => $row->sessionName,
                    'mobile_no'     => $row->mobile_no,
                    'appli_mob_no'  => $row->appli_mob_no,
                    'Present'       => $row->Present,
                    'Absent'        => $row->Absent,
                    'Total'         => $row->Total,
                    'Persantage'    => $row->Persantage.' %',
                );
            }
//            echo '<pre>';print_r($exceldata);die;    
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='Student Defaulter Excel '.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            
           
        redirect('StudentDefaulterExcel',refresh);
        
                
        endif;
        $this->data['page']         = 'reports/admin/student_attendance_defaulter_excel';
        $this->data['page_header']  = 'Student Attendance Defaulter Excel';
        $this->data['page_title']   = 'Student Attendance Defaulter Excel | ECMS';
        $this->load->view('common/common',$this->data); 
    }
    
      public function teacher_attendance_date_wise_report_enter_by(){
        $this->data['ReportName']       = 'Teacher Attendance EB ( Date Wise )';
        $this->data['page_title']       = 'Student Attendance EB ( Date Wise ) | ECMS';
        $this->data['page']             =  'reports/admin/teacher_attendance_date_wise_eb';
        $this->load->view('common/common',$this->data); 
    }
    
    public function teacher_attendance_date_wise_report_enter_by_result(){
        if($this->input->post()):
            $emp_id     = $this->input->post('emp_id');
            $emp_name   = $this->input->post('emp_name');
            $date_from  = date('Y-m-d',strtotime($this->input->post('date_from')));
            $date_to    = date('Y-m-d',strtotime($this->input->post('date_to')));
           $where = '';
            if($emp_id):
                $where = array( 'hr_emp_record.emp_id'  =>$emp_id);
            endif;
            
            
            $date = array('from'=>$date_from,'to'=>$date_to);
            $this->data['result']       = $this->ReportsModel->get_teacher_attendance_date_wise_enter_by($where,$date);
        endif;
     $this->load->view('reports/admin/jQuery_v/teacher_date_wise_eb_js',$this->data); 
    }
    
    public function student_absent_inter(){
        
        
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programe_id'=>'1'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>'1'));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'1'),array('order'=>'asc','column'=>'batch_order'));
             $this->data['sections']         = $this->CRUDModel->dropDown('sections', 'Select', 'sec_id','name',array('status'=>'On','program_id'=>1),array('order'=>'asc','column'=>'name'));
            $this->data['programId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']          = '';

            $this->data['sectionId']        = '';
            $this->data['fromDate']         = date('d-m-Y',strtotime('-8 months'));
            $this->data['toDate']           = date('d-m-Y');
         
            $this->data['userId'] = $this->userInfo->user_id;
            
            
            
            if($this->input->post('search')):
            
            
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $batch                          =  $this->input->post('batch');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
           
            $this->data['fromDate']  = date('d-m-Y');
            $this->data['toDate']    = date('d-m-Y');
            
             if($program):
                $where['programes_info.programe_id']    = $program; 
                $this->data['programId']                = $program;
            endif;
            if($sub_program):
                $where['sub_programes.sub_pro_id']      = $sub_program; 
                $this->data['subprogramId']             = $sub_program;
            endif;
            if($batch):
                $where['prospectus_batch.batch_id']     = $batch; 
                $this->data['batchId']                  = $batch;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
             
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $where['student_record.s_status_id'] = 5;
            
            
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    college_no
                    ';
                $this->data['result']           = $this->ReportsModel->position_report($field,'student_record', $where,$like,$custom);
            endif;
            if($this->input->post('excel')):
            
            
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $batch                          =  $this->input->post('batch');
            $section                        =  $this->input->post('sections_name');
            
            $fromDate                       =  $this->input->post('fromDate');
            $toDate                         =  $this->input->post('toDate');
            
            //like Array
            $like = '';
            $where = '';
           
            $this->data['fromDate']  = date('d-m-Y');
            $this->data['toDate']    = date('d-m-Y');
            
             if($program):
                $where['programes_info.programe_id']    = $program; 
                $this->data['programId']                = $program;
            endif;
            if($sub_program):
                $where['sub_programes.sub_pro_id']      = $sub_program; 
                $this->data['subprogramId']             = $sub_program;
            endif;
            if($batch):
                $where['prospectus_batch.batch_id']     = $batch; 
                $this->data['batchId']                  = $batch;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            
            if($fromDate):
                 $this->data['fromDate']  = $fromDate;
            endif;
            if($toDate):
                 $this->data['toDate']  = $toDate;
            endif;
              
            
        
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $where['student_record.s_status_id'] = 5;
            
            
               
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName,
                    college_no
                    ';
               
                
                
                   $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Student Leave ');
                
                $this->excel->getActiveSheet()->setCellValue('A1', 'S.n');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('B1', 'College #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Student name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Group');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('F1','Total Classes');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(11);
            
                $this->excel->getActiveSheet()->setCellValue('G1','Present');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(11);
    
                $this->excel->getActiveSheet()->setCellValue('H1','Absent');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Persantage');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(11);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Leave Approve');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(11);
                 
                
                
                for($col = ord('A'); $col <= ord('J1'); $col++){
                    $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                    $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                    $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }              
             $result           = $this->ReportsModel->position_report_excel($field,'student_record', $where,$like,$custom);
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($result, null, 'A2');
                $filename='Inter Students Leave '.$date.'.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif;
            
            $this->data['ReportName']   = 'Students Absentee Fine (Inter)';
            $this->data['page']         = "reports/Inter/reports/student_fines_v";
            $this->data['title']        = 'Students Absentee Fine (Inter)| ECMS';
            $this->load->view('common/common',$this->data); 
         }
}
