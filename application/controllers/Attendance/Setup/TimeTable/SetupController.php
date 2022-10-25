<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class SetupController extends AdminController {

     public function __construct() {
             parent::__construct();
            $this->load->model('AttendanceModel');
            $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
        }
    public function index(){
        $this->data['emp_id']       = "";
        $this->data['sec_id']       = "";
        $this->data['subject_id']   = "";
        $this->data['m_group_id']   = "";
        $this->data['Teachers']     = $this->CRUDModel->dropDown('hr_emp_record','Select Teacher', 'emp_id', 'emp_name', array('cat_id'=>1,'emp_status_id'=>1));
        $this->data['Sections']     = $this->CRUDModel->dropDown('sections','Select Section', 'sec_id', 'name', array('status'=>'On'));
        $this->data['Sections']     = $this->CRUDModel->dropDown('sections','Select Section', 'sec_id', 'name', array('status'=>'On'));
        
        $this->data['merge_grp']    = $this->CRUDModel->dropDownMG('class_alloted_merge_groups','Select Merging Group', 'camg_id', 'camg_name', array('camg_status'=>1));
//        echo '<pre>';print_r($this->data['Teachers']);
        if($this->input->post()):
       // echo '<pre>';print_r($this->input->post());die;
            $emp_id         = $this->input->post('emp_id');
            $sec_id         = $this->input->post('sec_id');
            $subject_id     = $this->input->post('subject_id');
            $mgrp_id        = $this->input->post('mgrp_id');
            
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
        
        if($mgrp_id):
            $where['class_alloted.ca_merge_id'] = $mgrp_id;
            $this->data['subject_id'] =$mgrp_id;
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
        
        $this->data['title']        = 'Time Table Allotment';
        $this->data['page_title']   = 'Time Table Allotment | ECMS';
        $this->data['page']         = 'attendance/Setup/TimeTable/index';
        $this->load->view('common/common',$this->data);
    }        
        public function create(){
        $session = $this->session->all_userdata();
        $user_id = $session['userData']['user_id'];
        
        $this->data['building_block_id']    = '';
        $this->data['rooms_id']             = '';
        $this->data['building_block']       = $this->CRUDModel->dropDownName('invt_building_block', 'Select Block', 'bb_id', 'bb_name',array('bb_status'=>1,'hostel_block_flag'=>2)); 
        $this->data['rooms']                = $this->CRUDModel->dropDownName('invt_rooms', 'Rooms', 'rm_id', 'rm_name'); 
        
        $this->data['start_time']           = $this->CRUDModel->dropDown_class_start_time('class_starting_time', 'Start Time', 'stime_id', 'class_stime'); 
        $this->data['end_time']             = $this->CRUDModel->dropDown_class_end_time('class_ending_time', 'End Time', 'etime_id', 'class_etime'); 
         
        
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
//            'form_Code'         => $isRow->form_Code,
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
        $this->data['page']         = 'attendance/Setup/TimeTable/create';
        $this->load->view('common/common',$this->data);
    }        
}
