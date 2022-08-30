<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class HostelController extends AdminController {
    
     public function __construct() 
        {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('HostelModel');
             $this->load->model('FeeModel');
             $this->load->library("pagination");
             $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
       }
    
    public function blocks()
    {       
        $this->data['result']       = $this->CRUDModel->getResults('hostel_blocks');
        $this->data['page_title']   = 'Blocks List | ECMS';
        $this->data['page']         = 'hostel/blocks';
        $this->load->view('common/common',$this->data);
    }
    
    public function add_block()
	{	
	   if($this->input->post()):
            $block_name      = $this->input->post('block_name');
            $data       = array(
                'block_name' =>$block_name
            );
            $this->CRUDModel->insert('hostel_blocks',$data);
            $this->data['page_title']   = 'All Blocks | ECMS';
            $this->data['page']         = 'hostel/blocks';
            $this->load->view('common/common',$this->data);
            redirect('HostelController/blocks');
          else:
              redirect('/');
        endif;
	}
    
    public function rooms()
    {       
        $this->data['result']       = $this->HostelModel->getRooms();
        $this->data['page_title']   = 'Rooms List | ECMS';
        $this->data['page']         = 'hostel/rooms';
        $this->load->view('common/common',$this->data);    
    }
    
    public function delete_room()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('room_id'=>$id);
        $this->CRUDModel->deleteid('hostel_rooms',$where);
        redirect('HostelController/rooms');
	}
    
    public function delete_block()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('block_id'=>$id);
        $this->CRUDModel->deleteid('hostel_blocks',$where);
        redirect('HostelController/blocks');
	}
    
       
    public function add_hostel_student(){
        
        $student_id                     = $this->uri->segment(3);
        $this->data['hostel_batch']     = $this->CRUDModel->dropDown('hostel_batch', ' Select Hostel Session ', 'h_batch_id', 'h_batch_name');  
        $this->data['Building_block']   = $this->CRUDModel->dropDown('invt_building_block', 'Select Hostel Block', 'bb_id', 'bb_name',array('hostel_block_flag'=>1));  
//        $this->data['hostel_rooms']     = $this->CRUDModel->dropDown('invt_rooms', ' Hostel Room', 'rm_id', 'rm_name',array('rm_status'=>1));  
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status', 'hostel_status_id', 'status_name');  
        
        if($this->input->post()):
            $student_id         = $this->input->post('student_id');
            $student_mobile_no  = $this->input->post('student_mobile_no');
            $room_id            = $this->input->post('room_id');
            $allotted_date      = $this->input->post('allotted_date');
            $hostel_status_id   = $this->input->post('hostel_status_id');
            $date1              = date('Y-m-d', strtotime($allotted_date));
            $checked            = array( 'student_id' =>$student_id );
            
            $qry = $this->CRUDModel->get_where_row('hostel_student_record',$checked);
            if($qry):
                    $this->session->set_flashdata('msg', 'Sorry! Student Already Exist');
                    redirect('hostelMess');
            else:
                    $data  = array(
                        'student_id'        => $student_id,
                        'student_mobile_no' => $student_mobile_no,
                        'allotted_date'     => $date1,
                        'room_id'           => $room_id,
                        'room_alloted'      => 1,
                        'hostel_status_id'  => 1,
                        'hostel_status_id'  => $hostel_status_id,
                        'user_id'           => $this->userInfo->user_id,
                    );        
                $this->CRUDModel->insert('hostel_student_record',$data);
                redirect('hostelMess');
            endif;
            endif;
            if($student_id):                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->data['result']   =   $this->db->get_where('student_record',array('student_record.student_id'=>$student_id))->row();
            endif;
            
            $this->data['page_title']  = 'Add Hostel Student| ECMS';
            $this->data['page_header']  = 'Add Hostel Student';
            $this->data['page'] = 'hostel/Forms/add_hostel_student_v';
            $this->load->view('common/common',$this->data); 
	}
    
    public function update_hostel_student(){
        $id         = $this->uri->segment(3);
//        $session    = $this->session->all_userdata();
//        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $student_id             = $this->input->post('student_id');
//            $student_mobile_no    = $this->input->post('student_mobile_no');
            $leaving_date           = $this->input->post('leaving_date');
            $reason                 = $this->input->post('reason');
            $hostel_id              = $this->input->post('hostel_id');
//            $room_id              = $this->input->post('room_id');
            $hostel_status_id       = $this->input->post('hostel_status_id');
            $where = array('hostel_student_record.hostel_id'=>$hostel_id);
            $date1 = date('Y-m-d', strtotime($leaving_date));
            $data  = array(
                'student_id'            => $student_id,
//              'student_mobile_no'     => $student_mobile_no,
//              'room_id'               => $room_id,
                'hostel_status_id'      => $hostel_status_id,
                'leaved_date'           => $date1,
                'reason'                => $reason,
                'updated_user_id'       => $this->userInfo->user_id
);        
            $this->CRUDModel->update('hostel_student_record',$data,$where);
                 //Student Log 
            if($reason != '' && $date1 !=''):
                $data_log  = array(
                    'student_hostel_id' => $hostel_id,
                    'hostel_status_id'  => $hostel_status_id,
                    'leave_date'        => $date1,
                    'reason'            => $reason,
                    'update_by'         => $this->userInfo->user_id,
                    'update_timestamp'  => date('Y-m-d H:i:s')
            ); 
             
            $this->CRUDModel->insert('hostel_status_log',$data_log); 
             endif;
//            redirect('HostelController/hostel_student_record');
            redirect('HostelController/hostel_student_change_status');
//            redirect('HostelController/print_hostel_student');
            endif;
            if($id):
            $where                          = array('hostel_student_record.hostel_id'=>$id);
            $this->data['result']           = $this->HostelModel->gethostel_Std('hostel_student_record',$where);
            $this->data['student_log']      = $this->HostelModel->student_status_log(array('student_hostel_id'=>$id));
              
            $this->data['page_title']   = 'Update Hostel Student| ECMS';
            $this->data['page'] = 'hostel/Forms/update_hostel_student_status_v';
//            $this->data['page'] = 'hostel/update_hostel_student';
            $this->load->view('common/common',$this->data);
            endif;
	}
    
//    public function print_hostel_student(){
//        $this->data['status']           = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status ', 'hostel_status_id', 'status_name');    
//        $this->data['statuss']           = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name');    
//        $this->data['shift']           = $this->CRUDModel->dropDown('shift', ' Shift ', 'shift_id', 'name');    
//        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name');
//        $this->data['hostel_batch']     = $this->CRUDModel->dropDown('hostel_batch', ' Hostel Session ', 'h_batch_id', 'h_batch_name'); 
//        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
//        $this->data['batch_name']       = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name');
//            $where = "";
//        
//        $this->data['student_id']       = ""; 
//        $this->data['shift_id']       = ""; 
//        $this->data['hostel_status_id'] = ""; 
//        $this->data['s_status_id'] = ""; 
//        $this->data['programe_id']      = ""; 
//        $this->data['sub_pro_id']       = ""; 
//        $this->data['batch_id']         = ""; 
//        $this->data['h_batch_id']       = ""; 
//        $this->data['room_id']          = ""; 
//        $this->data['college_no']       = "";
//        
//        if($this->input->post('search')): 
//            $shift_id         = $this->input->post('shift_id');
//            $student_id         = $this->input->post('student_id');
//            $room_id            = $this->input->post('room_id');
//            $hostel_status_id   = $this->input->post('hostel_status_id');
//            $s_status_id   = $this->input->post('s_status_id');
//            $programe_id        = $this->input->post('programe_id');
//            $sub_pro_id         = $this->input->post('sub_pro_id');
//            $batch_id           = $this->input->post('batch_id');
//            $h_batch_id         = $this->input->post('h_batch_id');
//            $college_no         = $this->input->post('college_no');
//        
//        if(!empty($student_id)):
//            $where['student_record.student_id'] = $student_id;
//            $this->data['student_id'] =$student_id;
//        endif;
//        if(!empty($hostel_status_id)):
//            $where['hostel_status.hostel_status_id'] = $hostel_status_id;
//            $this->data['hostel_status_id'] =$hostel_status_id;
//        endif;
//        if(!empty($shift_id)):
//            $where['shift.shift_id'] = $shift_id;
//            $this->data['shift_id'] =$shift_id;
//        endif;
//        if(!empty($s_status_id)):
//            $where['student_status.s_status_id'] = $s_status_id;
//            $this->data['s_status_id'] =$s_status_id;
//        endif;
//        if(!empty($programe_id)):
//            $where['student_record.programe_id'] = $programe_id;
//            $this->data['programe_id'] =$programe_id;
//        endif;
//        if(!empty($sub_pro_id)):
//            $where['student_record.sub_pro_id'] = $sub_pro_id;
//            $this->data['sub_pro_id'] =$sub_pro_id;
//        endif;
//        if(!empty($batch_id)):
//            $where['student_record.batch_id'] = $batch_id;
//            $this->data['batch_id'] =$batch_id;
//        endif;
////        if(!empty($h_batch_id)):
////            $where['hostel_batch.h_batch_id'] = $h_batch_id;
////            $this->data['h_batch_id'] =$h_batch_id;
////        endif;
//        if(!empty($room_id)):
//            $where['hostel_rooms.room_id'] = $room_id;
//            $this->data['room_id'] =$room_id;
//        endif;
//        if(!empty($college_no)):
//            $where['college_no'] = $college_no;
//            $this->data['college_no'] =$college_no;
//        endif;
//            $this->data['result'] = $this->HostelModel->HostelDataSearch('hostel_student_record',$where);
//      //  else:
////        $this->data['result'] = $this->HostelModel->get_HostelData('hostel_student_record');
//        endif;
//        $this->data['page_title']  = 'Hostel Students Record| ECMS';
//        $this->data['page']        =  'hostel/print_hostel_student';
//        $this->load->view('common/common',$this->data);
//        
//        if($this->input->post('export')):
//                $this->load->library('excel');
//                $this->excel->setActiveSheetIndex(0);
//                $this->excel->getActiveSheet()->setTitle('Hostel Students Record');
//               
//                $this->excel->getActiveSheet()->setCellValue('A1', 'College #');
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('C1', 'Student Name');
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('D1', 'Father Name');
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('E1', 'Mobile #');
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('F1', 'Program');
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('G1', 'Allotted Date');
//                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('H1', 'O.Marks');
//                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('I1', 'T.Marks');
//                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('J1', 'Shift');
//                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('K1', 'Session');
//                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
//        
//        
//            for($col = ord('A'); $col <= ord('K'); $col++){
//                //set column dimension
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
//                 //change the font size
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
//                  
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//        }
//            $this->data['student_id']       = ""; 
//        $this->data['shift_id']       = ""; 
//        $this->data['hostel_status_id'] = ""; 
//        $this->data['s_status_id'] = ""; 
//        $this->data['programe_id']      = ""; 
//        $this->data['sub_pro_id']       = ""; 
//        $this->data['batch_id']         = ""; 
//        $this->data['h_batch_id']       = ""; 
//        $this->data['room_id']          = ""; 
//        $this->data['college_no']       = "";
//        
//            $shift_id         = $this->input->post('shift_id');
//            $student_id         = $this->input->post('student_id');
//            $room_id            = $this->input->post('room_id');
//            $hostel_status_id   = $this->input->post('hostel_status_id');
//            $s_status_id   = $this->input->post('s_status_id');
//            $programe_id        = $this->input->post('programe_id');
//            $sub_pro_id         = $this->input->post('sub_pro_id');
//            $batch_id           = $this->input->post('batch_id');
//            $h_batch_id         = $this->input->post('h_batch_id');
//            $college_no         = $this->input->post('college_no');
//        
//        if(!empty($student_id)):
//            $where['student_record.student_id'] = $student_id;
//            $this->data['student_id'] =$student_id;
//        endif;
//        if(!empty($hostel_status_id)):
//            $where['hostel_status.hostel_status_id'] = $hostel_status_id;
//            $this->data['hostel_status_id'] =$hostel_status_id;
//        endif;
//        if(!empty($shift_id)):
//            $where['shift.shift_id'] = $shift_id;
//            $this->data['shift_id'] =$shift_id;
//        endif;
//        if(!empty($s_status_id)):
//            $where['student_status.s_status_id'] = $s_status_id;
//            $this->data['s_status_id'] =$s_status_id;
//        endif;
//        if(!empty($programe_id)):
//            $where['student_record.programe_id'] = $programe_id;
//            $this->data['programe_id'] =$programe_id;
//        endif;
//        if(!empty($sub_pro_id)):
//            $where['student_record.sub_pro_id'] = $sub_pro_id;
//            $this->data['sub_pro_id'] =$sub_pro_id;
//        endif;
//        if(!empty($batch_id)):
//            $where['student_record.batch_id'] = $batch_id;
//            $this->data['batch_id'] =$batch_id;
//        endif;
//        if(!empty($room_id)):
//            $where['hostel_rooms.room_id'] = $room_id;
//            $this->data['room_id'] =$room_id;
//        endif;
//        if(!empty($college_no)):
//            $where['college_no'] = $college_no;
//            $this->data['college_no'] =$college_no;
//        endif;
//            $result = $this->HostelModel->HostelData_excel('hostel_student_record',$where);
//                $exceldata="";
//                foreach ($result as $row)
//                {
//                $exceldata[] = $row;
//                }      
//                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
//                $filename='Hostel_Students_List.xls'; 
//                header('Content-Type: application/vnd.ms-excel');
//                header('Content-Disposition: attachment;filename="'.$filename.'"');
//                header('Cache-Control: max-age=0'); 
//                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//                $objWriter->save('php://output');
//        endif;
//    }
    public function hostel_student_change_status(){
        $this->data['status']           = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status ', 'hostel_status_id', 'status_name');    
        $this->data['statuss']          = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name');    
        $this->data['shift']            = $this->CRUDModel->dropDown('shift', ' Shift ', 'shift_id', 'name');    
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name');
        $this->data['hostel_batch']     = $this->CRUDModel->dropDown('hostel_batch', ' Hostel Session ', 'h_batch_id', 'h_batch_name'); 
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['batch_name']       = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name');
            $where = "";
        
        $this->data['student_id']       = ""; 
        $this->data['shift_id']       = ""; 
        $this->data['hostel_status_id'] = ""; 
        $this->data['s_status_id'] = ""; 
        $this->data['programe_id']      = ""; 
        $this->data['sub_pro_id']       = ""; 
        $this->data['batch_id']         = ""; 
        $this->data['h_batch_id']       = ""; 
        $this->data['room_id']          = ""; 
        $this->data['college_no']       = "";
        
        if($this->input->post('search')): 
            $shift_id         = $this->input->post('shift_id');
            $student_id         = $this->input->post('student_id');
            $room_id            = $this->input->post('room_id');
            $hostel_status_id   = $this->input->post('hostel_status_id');
            $s_status_id        = $this->input->post('s_status_id');
            $programe_id        = $this->input->post('programe_id');
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $batch_id           = $this->input->post('batch_id');
            $h_batch_id         = $this->input->post('h_batch_id');
            $college_no         = $this->input->post('college_no');
        
        if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
        endif;
        if(!empty($hostel_status_id)):
            $where['hostel_status.hostel_status_id'] = $hostel_status_id;
            $this->data['hostel_status_id'] =$hostel_status_id;
        endif;
        if(!empty($shift_id)):
            $where['shift.shift_id'] = $shift_id;
            $this->data['shift_id'] =$shift_id;
        endif;
        if(!empty($s_status_id)):
            $where['student_status.s_status_id'] = $s_status_id;
            $this->data['s_status_id'] =$s_status_id;
        endif;
        if(!empty($programe_id)):
            $where['student_record.programe_id'] = $programe_id;
            $this->data['programe_id'] =$programe_id;
        endif;
        if(!empty($sub_pro_id)):
            $where['student_record.sub_pro_id'] = $sub_pro_id;
            $this->data['sub_pro_id'] =$sub_pro_id;
        endif;
        if(!empty($batch_id)):
            $where['student_record.batch_id'] = $batch_id;
            $this->data['batch_id'] =$batch_id;
        endif;
//        if(!empty($h_batch_id)):
//            $where['hostel_batch.h_batch_id'] = $h_batch_id;
//            $this->data['h_batch_id'] =$h_batch_id;
//        endif;
        if(!empty($room_id)):
            $where['hostel_rooms.room_id'] = $room_id;
            $this->data['room_id'] =$room_id;
        endif;
        if(!empty($college_no)):
            $where['college_no'] = $college_no;
            $this->data['college_no'] =$college_no;
        endif;
            $this->data['result'] = $this->HostelModel->HostelDataSearch('hostel_student_record',$where);
      //  else:
//        $this->data['result'] = $this->HostelModel->get_HostelData('hostel_student_record');
        endif;
        $this->data['page_header']  = 'Hostel Students Record Status';
        $this->data['page_title']  = 'Hostel Students Record| ECMS';
//        $this->data['page']        =  'hostel/print_hostel_student';
        $this->data['page']        =  'hostel/Forms/hostel_mess_stusent_change_status_v';
        $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Hostel Students Record');
               
                $this->excel->getActiveSheet()->setCellValue('A1', 'College #');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('C1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1', 'Mobile #');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('F1', 'Batch');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1', 'Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('H1', 'Allotted Date');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('I1', 'Room Name');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('J1', 'Block No');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('K1', 'O.Marks');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('L1', 'T.Marks');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('M1', 'Shift');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('N1', 'Reserved Seat');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('O1', 'approval_by');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
        
        
            for($col = ord('A'); $col <= ord('O'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
            $this->data['student_id']       = ""; 
        $this->data['shift_id']       = ""; 
        $this->data['hostel_status_id'] = ""; 
        $this->data['s_status_id'] = ""; 
        $this->data['programe_id']      = ""; 
        $this->data['sub_pro_id']       = ""; 
        $this->data['batch_id']         = ""; 
        $this->data['h_batch_id']       = ""; 
        $this->data['room_id']          = ""; 
        $this->data['college_no']       = "";
        
            $shift_id         = $this->input->post('shift_id');
            $student_id         = $this->input->post('student_id');
            $room_id            = $this->input->post('room_id');
            $hostel_status_id   = $this->input->post('hostel_status_id');
            $s_status_id   = $this->input->post('s_status_id');
            $programe_id        = $this->input->post('programe_id');
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $batch_id           = $this->input->post('batch_id');
            $h_batch_id         = $this->input->post('h_batch_id');
            $college_no         = $this->input->post('college_no');
        
        if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
        endif;
        if(!empty($hostel_status_id)):
            $where['hostel_status.hostel_status_id'] = $hostel_status_id;
            $this->data['hostel_status_id'] =$hostel_status_id;
        endif;
        if(!empty($shift_id)):
            $where['shift.shift_id'] = $shift_id;
            $this->data['shift_id'] =$shift_id;
        endif;
        if(!empty($s_status_id)):
            $where['student_status.s_status_id'] = $s_status_id;
            $this->data['s_status_id'] =$s_status_id;
        endif;
        if(!empty($programe_id)):
            $where['student_record.programe_id'] = $programe_id;
            $this->data['programe_id'] =$programe_id;
        endif;
        if(!empty($sub_pro_id)):
            $where['student_record.sub_pro_id'] = $sub_pro_id;
            $this->data['sub_pro_id'] =$sub_pro_id;
        endif;
        if(!empty($batch_id)):
            $where['student_record.batch_id'] = $batch_id;
            $this->data['batch_id'] =$batch_id;
        endif;
        if(!empty($room_id)):
            $where['hostel_rooms.room_id'] = $room_id;
            $this->data['room_id'] =$room_id;
        endif;
        if(!empty($college_no)):
            $where['college_no'] = $college_no;
            $this->data['college_no'] =$college_no;
        endif;
            $result = $this->HostelModel->HostelData_excel('hostel_student_record',$where);
                $exceldata="";
                foreach ($result as $row)
                {
                $exceldata[] = $row;
                }      
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Hostel_Students_List.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
    }
    
    public function add_room()
	{
		if($this->input->post()):
            $room_name     = $this->input->post('room_name');
            $block_id     = $this->input->post('block_id');
            $checked = array
            (
                'room_name' =>$room_name,
                'block_id' =>$block_id,
            );
            $qry = $this->CRUDModel->get_where_row('hostel_rooms',$checked);
            if($qry):
            $this->session->set_flashdata('msg', 'Sorry! Room Already Exist');
            redirect('HostelController/rooms');
            else:
            $data  = array(
                'room_name' =>$room_name,
                'block_id' =>$block_id,
            );        
            $this->CRUDModel->insert('hostel_rooms',$data);
            redirect('HostelController/rooms');
            endif;
            endif;
            $this->data['page_title']  = 'Add Room| ECMS';
            $this->data['page'] = 'hostel/add_room';
            $this->load->view('common/common',$this->data);
	}
    
    public function update_room()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $room_id     = $this->input->post('room_id');
            $room_name     = $this->input->post('room_name');
            $block_id     = $this->input->post('block_id');
            $data = array
            (
                'room_name' =>$room_name,
                'block_id' =>$block_id,
            );
              $where = array('room_id'=>$room_id); 
              $this->CRUDModel->update('hostel_rooms',$data,$where);
              redirect('HostelController/rooms'); 
           endif;
        if($id):
            $where = array('room_id'=>$id);
            $this->data['result'] = $this->HostelModel->getRoom('hostel_rooms',$where);

            $this->data['page_title']        = 'Updae Room | ECMS';
            $this->data['page']        =  'hostel/update_room';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
//    public function hostel_student_record()
//    {
//        $this->data['status'] = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status ', 'hostel_status_id', 'status_name');    
//        $where = "";
//            $this->data['student_id'] = ""; 
//            $this->data['hostel_status_id'] = ""; 
//            $this->data['room_id'] = ""; 
//            $this->data['college_no'] = "";
//        if($this->input->post('search')): 
//            $student_id  = $this->input->post('student_id');
//            $room_id  = $this->input->post('room_id');
//            $hostel_status_id  = $this->input->post('hostel_status_id');
//            $college_no  = $this->input->post('college_no');
//        
//        if(!empty($student_id)):
//            $where['student_record.student_id'] = $student_id;
//            $this->data['student_id'] =$student_id;
//        endif;
//        if(!empty($hostel_status_id)):
//            $where['hostel_status.hostel_status_id'] = $hostel_status_id;
//            $this->data['hostel_status_id'] =$hostel_status_id;
//        endif;
//        if(!empty($room_id)):
//            $where['hostel_rooms.room_id'] = $room_id;
//            $this->data['room_id'] =$room_id;
//        endif;
//        if(!empty($college_no)):
//            $where['college_no'] = $college_no;
//            $this->data['college_no'] =$college_no;
//        endif;
//            $this->data['result'] = $this->HostelModel->HostelDataSearch('hostel_student_record',$where);
//        else:
//        $this->data['result'] = $this->HostelModel->get_HostelData('hostel_student_record');
//        endif;
//
//        $this->data['page_title']  = 'Hostel Students Record| ECMS';
//        $this->data['page']        =  'hostel/hostel_student_record';
//        $this->load->view('common/common',$this->data);
//        if($this->input->post('export')):
//                $this->load->library('excel');
//                $this->excel->setActiveSheetIndex(0);
//                $this->excel->getActiveSheet()->setTitle('Hostel Students Record');
//               
//                $this->excel->getActiveSheet()->setCellValue('A1', 'College #');
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('C1', 'Student Name');
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('D1', 'Father Name');
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('E1', 'Mobile #');
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('F1', 'Program');
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('G1', 'Room Name');
//                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('H1', 'Block Name');
//                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
//        
//                $this->excel->getActiveSheet()->setCellValue('I1', 'Hostel Allotted Date');
//                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
//        
//            for($col = ord('A'); $col <= ord('I'); $col++){
//                //set column dimension
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
//                 //change the font size
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
//                  
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//        }
//            $student_id  = $this->input->post('student_id');
//            $room_id  = $this->input->post('room_id');
//            $hostel_status_id  = $this->input->post('hostel_status_id');
//            $college_no  = $this->input->post('college_no');
//            $where = "";
//            $this->data['student_id'] = ""; 
//            $this->data['hostel_status_id'] = ""; 
//            $this->data['room_id'] = ""; 
//            $this->data['college_no'] = "";
//            if(!empty($student_id)):
//            $where['student_record.student_id'] = $student_id;
//            $this->data['student_id'] =$student_id;
//            endif;
//            if(!empty($hostel_status_id)):
//                $where['hostel_status.hostel_status_id'] = $hostel_status_id;
//                $this->data['hostel_status_id'] =$hostel_status_id;
//            endif;
//            if(!empty($room_id)):
//                $where['hostel_rooms.room_id'] = $room_id;
//                $this->data['room_id'] =$room_id;
//            endif;
//            if(!empty($college_no)):
//                $where['college_no'] = $college_no;
//                $this->data['college_no'] =$college_no;
//            endif;
//            $result = $this->HostelModel->HostelData_excel('hostel_student_record',$where);
//          //  echo '<pre>';print_r($result);die;
//                $exceldata="";
//                foreach ($result as $row)
//                {
//                $exceldata[] = $row;
//                }      
//                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
//                $filename='Hostel_Students_List2017.xls'; 
//                header('Content-Type: application/vnd.ms-excel');
//                header('Content-Disposition: attachment;filename="'.$filename.'"');
//                header('Cache-Control: max-age=0'); 
//                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//                $objWriter->save('php://output');
//        endif;
//    }
    
    public function hostel_student_record()
    {
        $this->data['status'] = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status ', 'hostel_status_id', 'status_name');    
        $this->data['program'] = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name');
        $this->data['hostel_batch'] = $this->CRUDModel->dropDown('hostel_batch', ' Hostel Session ', 'h_batch_id', 'h_batch_name');
            $where = "";
        
            $this->data['student_id']           = ""; 
            $this->data['hostel_status_id']     = ""; 
            $this->data['programe_id']          = ""; 
            $this->data['sub_pro_id']           = ""; 
            $this->data['batch_id']             = ""; 
            $this->data['h_batch_id']           = ""; 
            $this->data['room_id']              = ""; 
            $this->data['college_no']           = "";
        if($this->input->post('search')):
            
            $student_id         = $this->input->post('student_id');
            $room_id            = $this->input->post('room_id');
            $hostel_status_id   = $this->input->post('hostel_status_id');
            $programe_id        = $this->input->post('programe_id');
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $batch_id           = $this->input->post('batch_id');
            $h_batch_id         = $this->input->post('h_batch_id');
            $college_no         = $this->input->post('college_no');
        
        if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
        endif;
        if(!empty($hostel_status_id)):
            $where['hostel_status.hostel_status_id'] = $hostel_status_id;
            $this->data['hostel_status_id'] =$hostel_status_id;
        endif;
        if(!empty($programe_id)):
            $where['student_record.programe_id'] = $programe_id;
            $this->data['programe_id'] =$programe_id;
        endif;
        if(!empty($sub_pro_id)):
            $where['student_record.sub_pro_id'] = $sub_pro_id;
            $this->data['sub_pro_id'] =$sub_pro_id;
        endif;
        if(!empty($batch_id)):
            $where['student_record.batch_id'] = $batch_id;
            $this->data['batch_id'] =$batch_id;
        endif;
        if(!empty($h_batch_id)):
            $where['hostel_batch.h_batch_id'] = $h_batch_id;
            $this->data['h_batch_id'] =$h_batch_id;
        endif;
        if(!empty($room_id)):
            $where['hostel_rooms.room_id'] = $room_id;
            $this->data['room_id'] =$room_id;
        endif;
        if(!empty($college_no)):
            $where['college_no'] = $college_no;
            $this->data['college_no'] =$college_no;
        endif;
            $this->data['result'] = $this->HostelModel->HostelDataSearch('hostel_student_record',$where);
        else:
        $this->data['result'] = $this->HostelModel->get_HostelData('hostel_student_record');
        endif;
        $this->data['page_title']  = 'Hostel Students Record| ECMS';
        $this->data['page']        =  'hostel/hostel_student_record';
        $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Hostel Students Record');
               
                $this->excel->getActiveSheet()->setCellValue('A1', 'College #');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('C1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1', 'Mobile #');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('F1', 'Program');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1', 'Room Name');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('H1', 'Block Name');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('I1', 'Hostel Allotted Date');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('J1', 'Session');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
        
            for($col = ord('A'); $col <= ord('J'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
            $student_id  = $this->input->post('student_id');
            $room_id  = $this->input->post('room_id');
            $hostel_status_id  = $this->input->post('hostel_status_id');
            $programe_id  = $this->input->post('programe_id');
            $sub_pro_id  = $this->input->post('sub_pro_id');
            $batch_id  = $this->input->post('batch_id');
            $h_batch_id  = $this->input->post('h_batch_id');
            $college_no  = $this->input->post('college_no');
            $where = "";
            $this->data['student_id'] = ""; 
            $this->data['hostel_status_id'] = ""; 
            $this->data['programe_id'] = ""; 
            $this->data['sub_pro_id'] = ""; 
            $this->data['batch_id'] = ""; 
            $this->data['h_batch_id'] = ""; 
            $this->data['room_id'] = ""; 
            $this->data['college_no'] = "";
        
            if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
            endif;
            if(!empty($hostel_status_id)):
                $where['hostel_status.hostel_status_id'] = $hostel_status_id;
                $this->data['hostel_status_id'] =$hostel_status_id;
            endif;
            if(!empty($room_id)):
                $where['hostel_rooms.room_id'] = $room_id;
                $this->data['room_id'] =$room_id;
            endif;
            if(!empty($programe_id)):
            $where['student_record.programe_id'] = $programe_id;
            $this->data['programe_id'] =$programe_id;
            endif;
            if(!empty($sub_pro_id)):
            $where['student_record.sub_pro_id'] = $sub_pro_id;
            $this->data['sub_pro_id'] =$sub_pro_id;
            endif;
            if(!empty($batch_id)):
                $where['student_record.batch_id'] = $batch_id;
                $this->data['batch_id'] =$batch_id;
            endif;
            if(!empty($h_batch_id)):
            $where['hostel_batch.h_batch_id'] = $h_batch_id;
            $this->data['h_batch_id'] =$h_batch_id;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            $result = $this->HostelModel->HostelData_excel('hostel_student_record',$where);
                $exceldata="";
                foreach ($result as $row)
                {
                $exceldata[] = $row;
                }      
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Hostel_Students_List.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
    }
    
    public function search_student()
    {
        $this->data['status']           = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status ', 'hostel_status_id', 'status_name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name');
        $this->data['hostel_batch']     = $this->CRUDModel->dropDown('hostel_batch', ' Hostel Session ', 'h_batch_id', 'h_batch_name');   
        $like = '';
        $where = '';
        $this->data['h_batch_id']       = "";
        $this->data['hostel_status_id'] = "";
        $this->data['programe_id']      = "";
        
        if($this->input->post()):
            $college_no   =  $this->input->post('college_no');
            $form_no      =  $this->input->post('form_no');
            $student_name =  $this->input->post('student_name');
            $father_name  =  $this->input->post('father_name');
            
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
           $this->data['student'] = $this->HostelModel->get_stdData('student_record',$where,$like);
        endif;
        $this->data['page_title']  = 'Hostel Students Record| ECMS';
        $this->data['page']        =  'hostel/hostel_student_record';
        $this->load->view('common/common',$this->data);
    }
    
    
    public function auto_hostelrooms()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->HostelModel->getRooms('hostel_rooms');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
        'value'=>$row_set->room_name.' ('. $row_set->block_name.')',
        'label'=>$row_set->room_name.' ('. $row_set->block_name.')',
        'id'=>$row_set->room_id
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
            
            $result_set             = $this->HostelModel->getRooms('hostel_rooms',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
        'value'=>$row_set->room_name.' ('. $row_set->block_name.')',
        'label'=>$row_set->room_name.' ('. $row_set->block_name.')',
        'id'=>$row_set->room_id,
                    );
            }
            $matches                = array();
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
       public function hostel_fee(){
            
            $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));  
             $this->data['inst_type']   = $this->CRUDModel->dropDown('fee_category_titles','Installment Type', 'cat_title_id', 'title',array('cat_title_status'=>'1'),array('column'=>'cat_order','order'=>'asc')); 
             $userInfo                  = $this->getUser();
            $this->data['default_date'] = $this->db->get_where('hostel_defaults_dates',array('status'=>1))->row();
             if($this->input->post()):
               
                $h_studetn_id   = $this->input->post('h_student_id');
                $date_from      = $this->input->post('date_from');
                $date_to        = $this->input->post('date_to');
                $valid_date     = $this->input->post('valid_date');
                $issue_date     = $this->input->post('issue_date');
                $bank           = $this->input->post('bank');
                $inst_type      = $this->input->post('inst_type');
                $comments       = $this->input->post('comments');
                
                $check_instalment = $this->db->get_where('hostel_student_bill',array('hostel_std_id'=>$h_studetn_id,'head_type'=>1,'cat_title_id'=>$inst_type))->row();
               
                if(empty($check_instalment)):
                    
                    
                $data = array(
                  'hostel_std_id'   => $h_studetn_id,  
                  'date_to'         => date('Y-m-d',strtotime($date_to)),  
                  'date_from'       => date('Y-m-d',strtotime($date_from)),  
                  'valid_date'      => date('Y-m-d',strtotime($valid_date)),  
                  'issue_date'      => date('Y-m-d',strtotime($issue_date)),  
                  'bank_id'         => $bank,
                  'cat_title_id'    => $inst_type,
                  'comments'        => $comments,
                  'challan_status'  => 1,
                  'hostel_status_id'=> 1,
                  'head_type'       => 1, 
                  'timestamp'       => date('Y-m-d H:i:s'),  
                  'user_id'         => $userInfo['user_id'],  
                );
                
                            $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id');
                $std_info = $this->db->where('hostel_student_record.hostel_id',$h_studetn_id)->get('hostel_student_record')->row();
         
                $hostel_fee_id  =  $this->CRUDModel->insert('hostel_student_bill',$data);
               
                 
                $this->RQ($hostel_fee_id, 'assets/RQ/hostel_rq/');
                
                 $old_balance_where= array(
//                                            'hostel_std_id'     => 12,
                                'hostel_std_id'         => $h_studetn_id,
                                'head_type'             => 1,
                                'challan_lock'          => 0,
                                '(hostel_student_bill_info.amount - hostel_student_bill_info.paid_amount) >'  => 0,
                                );
                                $this->db->select('
                                        hostel_student_bill.id as bill_id,
                                        hostel_student_bill_info.id as bill_detail_id,
                                       (hostel_student_bill_info.amount - hostel_student_bill_info.paid_amount) as balance,
                                        amount,
                                        hostel_head_id');
                                $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                 $old_balance = $this->db->get_where('hostel_student_bill',$old_balance_where)->result();
//                 echo '<pre>';print_r($old_balance);die;


                             if(!empty($old_balance)):
                                   foreach($old_balance as $row):
                                    $data = array(
                                        'hostel_bill_id'    =>$hostel_fee_id,
                                        'hostel_head_id'    =>$row->hostel_head_id,
                                        'amount'            =>$row->amount,
                                        'balance'           =>$row->amount,
                                        'old_challan_id'    =>$row->bill_id,
                                        'timestamp'         => date('Y-m-d H:i:s'),  
                                        'user_id'           => $userInfo['user_id'],
                                    );
                                $this->CRUDModel->insert('hostel_student_bill_info',$data);
                                $this->CRUDModel->update('hostel_student_bill_info',array('balance'=>0),array('id'=>$row->bill_detail_id));
                                endforeach;

                                $data_new = array(

                                    'old_challan_id'    => $row->bill_id,
                                    'rq_file'           => $hostel_fee_id.'.png'

                                );
                                $where_new = array(
                                    'id'=>$hostel_fee_id
                                );

                                $data_old = array(
                                    'challan_lock'  => 1,
                                 );
                                $where_old = array(
                                    'id'=>$row->bill_id
                                );


                                $this->CRUDModel->update('hostel_student_bill',$data_new,$where_new);
                                $this->CRUDModel->update('hostel_student_bill',$data_old,$where_old);

                                endif;
                             
                
                
                 $hostel_fee     = $this->CRUDModel->get_where_result('hostel_heads',array('status'=>1,'head_type'=>1,'batch_id'=>$std_info->batch_id,'cat_title_id'=>$inst_type));
                
                foreach($hostel_fee as $feeRow):
                    $data = array(
                        'hostel_bill_id'    =>$hostel_fee_id,
                        'hostel_head_id'    =>$feeRow->id,
                        'amount'            =>$feeRow->amount,
                        'balance'            =>$feeRow->amount,
                        'timestamp'         => date('Y-m-d H:i:s'),  
                        'user_id'           => $userInfo['user_id'],
                    );
                  $this->CRUDModel->insert('hostel_student_bill_info',$data);
                endforeach;
                
                  redirect('hostelPrintChallan/'.$h_studetn_id.'/'.$hostel_fee_id);
                  else:
                      
                     redirect('hostelPrintChallan/'.$h_studetn_id.'/'.$check_instalment->id);   
                 
                  endif;
              endif;
            
            
            $this->data['page_title']   = 'Hostel Fee | ECMS';
            $this->data['page_header']  = 'Hostel Fee';
            $this->data['page']         = 'hostel/hostel_fee';
            $this->load->view('common/common',$this->data);
    }
  
    public function mess_fee(){
            
            $this->data['bank']                 = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>16));  
            $this->data['per_day']              = $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
             $this->data['installment_type']    = $this->CRUDModel->dropDown('fee_category_titles','Select Installment', 'cat_title_id', 'title',array('cat_title_status'=>1),array('column'=>'cat_order','order'=>'asc'));
              $this->data['default_date']       = $this->db->get_where('hostel_defaults_dates',array('status'=>1))->row();
            $userInfo      = $this->getUser();
            if($this->input->post()):
               
                $h_studetn_id   = $this->input->post('h_student_id');
                $date_from      = $this->input->post('date_from');
                $date_to        = $this->input->post('date_to');
                $valid_date     = $this->input->post('valid_date');
                $issue_date     = $this->input->post('issue_date');
                $per_day        = $this->input->post('per_day');
                $per_day_id     = $this->input->post('per_day_id');
                $total_amount   = $this->input->post('total_amount');
                $total_days     = $this->input->post('total_days');
                $instal_type    = $this->input->post('installment_type');
                $bank           = $this->input->post('bank');
                $comments       = $this->input->post('comments');
                
               $check_instalment = $this->db->get_where('hostel_student_bill',array('hostel_std_id'=>$h_studetn_id,'head_type'=>2,'cat_title_id'=>$instal_type))->row();
              
//               echo '<pre>';print_r($check_instalment);die;
               if(empty($check_instalment)):
                
                 
               $data = array(
                    'hostel_std_id'     => $h_studetn_id,  
                    'date_from'         => date('Y-m-d',strtotime($date_from)),  
                    'date_to'           => date('Y-m-d',strtotime($date_to)),  
                    'issue_date'        => date('Y-m-d',strtotime($issue_date)),  
                    'valid_date'        => date('Y-m-d',strtotime($valid_date)),  
                    'challan_status'    => 1,
                    'cat_title_id'      => $instal_type,
                    'hostel_status_id'  => 1,
                    'head_type'         => 2,  
                    'bank_id'           => $bank,  
                    'comments'          => $comments,  
                    'timestamp'         => date('Y-m-d H:i:s'),  
                    'user_id'           => $userInfo['user_id'],  
                );
                
//                echo '<pre>';print_r($data);die;
                $hostel_fee_id  =  $this->CRUDModel->insert('hostel_student_bill',$data);
//                $hostel_fee     = $this->CRUDModel->get_where_result('hostel_heads',array('status'=>1,'head_type'=>2));
                
                $this->RQ($hostel_fee_id, 'assets/RQ/hostel_rq/');
                    $old_balance_where= array(
//                                            'hostel_std_id'     => 12,
                                            'hostel_std_id'         => $h_studetn_id,
                                            'head_type'             => 2,
                                            'challan_lock'          => 0,
                                            '(hostel_student_bill_info.amount - hostel_student_bill_info.paid_amount) >'       => 0,
                                            );
                                            $this->db->select('
                                                    hostel_student_bill.id as bill_id,
                                                    hostel_student_bill_info.id as bill_detail_id,
                                                    hostel_student_bill_info.per_day,
                                                    hostel_student_bill_info.total_days,
                                                   (hostel_student_bill_info.amount - hostel_student_bill_info.paid_amount) as balance,
                                                    amount,
                                                    hostel_student_bill_info.hostel_head_id');
                                            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                             $old_balance = $this->db->get_where('hostel_student_bill',$old_balance_where)->result();
                          
                      
                             if(!empty($old_balance)):
                                   foreach($old_balance as $row):
                                    $data = array(
                                        'hostel_bill_id'    => $hostel_fee_id,
                                        'hostel_head_id'    => $row->hostel_head_id,
                                        'amount'            => $row->balance,
                                        'balance'           => $row->balance,
                                        'total_days'        => $row->total_days,
                                        'per_day'           => $row->per_day,
                                        'old_challan_id'    =>$row->bill_id,
                                        'timestamp'         => date('Y-m-d H:i:s'),  
                                        'user_id'           => $userInfo['user_id'],
                                    );
                                  $this->CRUDModel->insert('hostel_student_bill_info',$data);
                               
                                  $this->CRUDModel->update('hostel_student_bill_info',array('balance'=>0),array('id'=>$row->bill_detail_id));
                                endforeach;
                                 
                                $data_new = array(
                                    
                                    'old_challan_id'    => $row->bill_id,
                                    'rq_file'           => $hostel_fee_id.'.png'
                                
                                );
                                $where_new = array(
                                    'id'=>$hostel_fee_id
                                );
                                
                                $data_old = array(
                                    'challan_lock'      => 1,
                                 );
                                $where_old = array(
                                    'id'=>$row->bill_id
                                );
                                
                                
                                $this->CRUDModel->update('hostel_student_bill',$data_new,$where_new);
                                $this->CRUDModel->update('hostel_student_bill',$data_old,$where_old);
                                
                                endif;
                 $data_info = array(
                        'hostel_bill_id'    =>$hostel_fee_id,
                        'hostel_head_id'    =>$per_day_id,
                        'amount'            =>$total_amount,
                        'balance'            =>$total_amount,
                        'per_day'            =>$per_day,
                        'total_days'        =>$total_days,
                        'timestamp'         => date('Y-m-d H:i:s'),  
                        'user_id'           => $userInfo['user_id'],
                    );
                  $this->CRUDModel->insert('hostel_student_bill_info',$data_info);
                redirect('hostelPrintChallan/'.$h_studetn_id.'/'.$hostel_fee_id);
                  else:
                   redirect('hostelPrintChallan/'.$h_studetn_id.'/'.$check_instalment->id);
               endif;
            endif;
            
            
            $this->data['page_title']   = 'Mess Fee | ECMS';
            $this->data['page_header']  = 'Mess Fee';
            $this->data['page']         = 'hostel/mess_fee';
            $this->load->view('common/common',$this->data);
    }
    
     public function hostel_challan_print_new(){
            
        
             $hostel_id = $this->uri->segment(2);
             $bill_id = $this->uri->segment(3);
             $inst_type = $this->uri->segment(4);
             
             
            $this->data['studentInfo']  = $this->HostelModel->hostel_fee_challan(array('hostel_student_record.hostel_id'=>$hostel_id));

            $this->data['challan_info'] = $this->HostelModel->hostel_challan_info(array('hostel_student_bill.id'=>$bill_id,'hostel_student_bill.cat_title_id'=>$inst_type));
            $this->data['extra_info']   = $this->HostelModel->extra_info(array('hostel_student_bill.id'=>$bill_id,'hostel_student_bill.cat_title_id'=>$inst_type));

//            $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$this->uri->segment(2)));
//               echo '<pre>';print_r($this->data['studentInfo']);
//               echo '<pre>';print_r($this->data['challan_info']);
//               echo '<pre>';print_r($this->data['extra_info']);die;
//            
            $this->data['page_title']   = 'Hostel Fee | ECMS';
            $this->data['page_header']  = 'Hostel Fee';
            $this->data['page']         = 'hostel/print/hostel_challan_print';
            $this->load->view('common/common',$this->data);
    }
     public function hostel_challan_print(){
            
        
             $hostel_id = $this->uri->segment(2);
             $bill_id = $this->uri->segment(3);
            // $inst_type = $this->uri->segment(4);
             
             
            $this->data['studentInfo']  = $this->HostelModel->hostel_fee_challan(array('hostel_student_record.hostel_id'=>$hostel_id));

            $this->data['challan_info'] = $this->HostelModel->hostel_challan_info_new(array('hostel_student_bill.id'=>$bill_id));
            $this->data['extra_info']   = $this->HostelModel->extra_info(array('hostel_student_bill.id'=>$bill_id));

//            $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$this->uri->segment(2)));
//               echo '<pre>';print_r($this->data['studentInfo']);
//               echo '<pre>';print_r($this->data['challan_info']);
//               echo '<pre>';print_r($this->data['extra_info']);die;
//            
            $this->data['page_title']   = 'Hostel Fee | ECMS';
            $this->data['page_header']  = 'Hostel Fee';
            $this->data['page']         = 'hostel/print/hostel_challan_print';
            $this->load->view('common/common',$this->data);
    }
      public function hostel_mess(){
            $this->data['page_title']   = 'Hostel & Mess Single Challan| ECMS';
            $this->data['page_header']  = 'Hostel & Mess Single Challan';
            $this->data['page'] = 'hostel/Forms/hostel_mess_single_challan_v';
            $this->load->view('common/common',$this->data);
    }
    public function hostel_mess_heads_new(){
         
             $this->data['head_type']        = $this->CRUDModel->dropDown('hostel_head_type','', 'id', 'title',array('status'=>1,'id'=>1));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch','Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['installment_type'] = $this->CRUDModel->dropDown('fee_category_titles','Installment Type', 'cat_title_id', 'title',array('cat_title_status'=>'1'));
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            
    
            $this->data['programe_id']      = '';
            $this->data['int_type_id']      = '';
            
            
            
            $this->data['feehead']          = '';
            $this->data['amount']           = '';
            $this->data['id']               = '';
            $this->data['batch_id']         = '';
            $this->data['instal_type_id']   = '';
            $this->data['head_typeId']      = 1;
            
    if($this->input->post()):
         //Insert Code 
            $installment_type   = $this->input->post('installment_type');
            $head_type          = $this->input->post('head_type');
            $batch              = $this->input->post('batch_id');
            $fromDate              = $this->input->post('fromDate');
            $dateTo              = $this->input->post('dateTo');
            $formCode           = $this->input->post('formCode');
//         $status            = $this->input->post('status');
         
//         $head_type         = $this->input->post('head_type');
//         $id                = $this->input->post('id');
         
          
         $userInfo      = $this->getUser();
          $where_demo = array(
                  'user_id'  =>$userInfo['user_id'],
                  'formCode' =>$formCode,
                  );
         $result = $this->CRUDModel->get_where_result('hostel_heads_demo',$where_demo);

            
         foreach($result as $row):
             $data = array(
                    'head_type'     =>$head_type,
                    'title'         =>$row->title,
                    'cat_title_id'  =>$installment_type,
                    'head_title_id' =>$row->head_title_id,
                    'head_type'     =>$row->hostel_type_id,
                    'amount'        =>$row->amount,
                    'fromDate'      =>date('Y-m-d',strtotime($fromDate)),
                    'toDate'      =>date('Y-m-d',strtotime($dateTo)),
                    'batch_id'      =>$batch,
                    'timestamp'     =>date('Y-m-d H:i:s'),
                    'user_id'       =>$userInfo['user_id'],
                    );
                $this->CRUDModel->insert('hostel_heads',$data);
         endforeach;        
          redirect('hostelMessHeadsNew');
              

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $row                        = $this->CRUDModel->get_where_row('hostel_heads',array('id'=>$id));
            $this->data['feehead']      = $row->title;
            $this->data['status']       = $row->status;
            $this->data['amount']       = $row->amount;
            $this->data['batch_id']     = $row->batch_id;
            $this->data['id']           = $row->id;
            $this->data['head_typeId']  = $row->head_type;
        
        
        endif;

//            $this->data['result']              = $this->HostelModel->hoste_fee_heads();
//            echo '<pre>';print_r($this->data['result']);die;
            $this->data['page_title']  = 'Hostel and Mess Heads | ECMS';
            $this->data['page_header']  = 'Hoste and Mess';
            $this->data['page'] = 'hostel/setups/hostel_mess_heads_new';
            $this->load->view('common/common',$this->data);
    }
    public function hostel_mess_heads_new_admin(){
         
             $this->data['head_type']       = $this->CRUDModel->dropDown('hostel_head_type','', 'id', 'title',array('status'=>1));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch','Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['installment_type'] = $this->CRUDModel->payment_cat_dropdown('fee_category_titles','Installment Type', 'cat_title_id', 'title',array('cat_title_status'=>'1'));
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            
    
            $this->data['programe_id']      = '';
            $this->data['int_type_id']      = '';
            
            
            
            $this->data['feehead']          = '';
            $this->data['amount']           = '';
            $this->data['id']               = '';
            $this->data['batch_id']         = '';
            $this->data['instal_type_id']   = '';
            $this->data['head_typeId']      = 1;
            
    if($this->input->post()):
         //Insert Code 
            $installment_type   = $this->input->post('installment_type');
            $head_type          = $this->input->post('head_type');
            $batch              = $this->input->post('batch_id');
            $fromDate              = $this->input->post('fromDate');
            $dateTo              = $this->input->post('dateTo');
            $formCode           = $this->input->post('formCode');
//         $status            = $this->input->post('status');
         
//         $head_type         = $this->input->post('head_type');
//         $id                = $this->input->post('id');
         
          
         $userInfo      = $this->getUser();
          $where_demo = array(
                  'user_id'  =>$userInfo['user_id'],
                  'formCode' =>$formCode,
                  );
         $result = $this->CRUDModel->get_where_result('hostel_heads_demo',$where_demo);

            
         foreach($result as $row):
             $data = array(
                    'head_type'     =>$head_type,
                    'title'         =>$row->title,
                    'cat_title_id'  =>$installment_type,
                    'head_title_id' =>$row->head_title_id,
                    'head_type'     =>$row->hostel_type_id,
                    'amount'        =>$row->amount,
                    'fromDate'      =>date('Y-m-d',strtotime($fromDate)),
                    'toDate'      =>date('Y-m-d',strtotime($dateTo)),
                    'batch_id'      =>$batch,
                    'timestamp'     =>date('Y-m-d H:i:s'),
                    'user_id'       =>$userInfo['user_id'],
                    );
                $this->CRUDModel->insert('hostel_heads',$data);
         endforeach;        
          redirect('hostelMessHeadsNew');
              

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $row                        = $this->CRUDModel->get_where_row('hostel_heads',array('id'=>$id));
            $this->data['feehead']      = $row->title;
            $this->data['status']       = $row->status;
            $this->data['amount']       = $row->amount;
            $this->data['batch_id']     = $row->batch_id;
            $this->data['id']           = $row->id;
            $this->data['head_typeId']  = $row->head_type;
        
        
        endif;

//            $this->data['result']              = $this->HostelModel->hoste_fee_heads();
//            echo '<pre>';print_r($this->data['result']);die;
            $this->data['page_title']  = 'Hostel and Mess Heads | ECMS';
            $this->data['page_header']  = 'Hoste and Mess';
            $this->data['page'] = 'hostel/setups/hostel_mess_heads_new';
            $this->load->view('common/common',$this->data);
    }
           public function search_hotel_setups_info(){
           
                $payment_id     = $this->input->post('payment_id');
                $batch_id       = $this->input->post('batch_id');
                $instal_type    = $this->input->post('instal_type');
                $where = '';
                
                if($batch_id):
                    $where['prospectus_batch.batch_id'] =$batch_id; 
                endif;
                if($instal_type):
                    $where['fee_category_titles.cat_title_id'] =$instal_type; 
                endif;
             
           $result              = $this->HostelModel->hoste_fee_heads($where);
            echo '<div class="row">
                    <div class="col-md-12">';
                                 
                            if(!empty($result)):
                                          
                                echo '<h3 class="has-divider text-highlight">Result :'.count($result).'</h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:10px">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Head </th>
                                                          <th>Batch</th>
                                                          <th>From</th>
                                                          <th>To</th>
                                                          <th>Installments</th>
                                                          <th>Amount</th>
                                                          
                                                          <th>Head Type</th>
                                                          
                                                          
                                                          <th>Status</th>
                                                          <th>Edit</th>
                                                          <th>Delete</th>

                                                      </tr>
                                                    </thead>
                                                    <tbod>';
                                                        
                                                        $sn = '';
                                                       
                                                          foreach($result as $row):
//                                                               
                                                           $sn++;
                                                            echo '<tr class="">
                                                                <td>'.$sn.'</th>
                                                                <td>'.$row->hostel_title.'</td>
                                                                <td>'.$row->batch_name.'</td>
                                                               <td>'.date('d-m-Y',strtotime($row->fromDate)).'</td>
                                                                <td>'.date('d-m-Y',strtotime($row->toDate)).'</td>     
                                                                <td>'.$row->category_title.'</td>
                                                                        <td>'.$row->amount.'</td>
                                                                
                                                                
                                                                <td>'.$row->head_title.'</td>
                                                                
                                                                
                                                                     ';
                                                             
                                                            echo '<td>';
                                                            if($row->status == 1):
                                                                  echo '<button class="btn btn-success btn-xs">Active</button>';
                                                                  else:
                                                                  echo '<button class="btn btn-info btn-xs">Deactive</button>';
                                                              endif;
                                                              echo '</td>';
                                                              echo '<td><a href="hostelMessHeadsNewEdit/'.$row->id.'" class="productstatus" ><button type="button" class="btn btn-theme btn-xs"> Edit </button></a></td>';
                                                              echo '<td><a href="HMDelete/'.$row->id.'" class="productstatus" ><button type="button" class="btn btn-theme btn-xs"> Delete </button></a></td>';
                                                             echo '</tr>';
                                                         
                                                          endforeach;      
                                               echo '
                                                    </tbody>
                                            </table>
                                        </div>';
 
                                      endif;
                                    
                                  
                                   echo '</div>
                                  
                                </div>';
       } 
       public function hostel_mess_heads(){
         
            $this->data['feehead'] = '';
            $this->data['amount'] = '';
            $this->data['id'] = '';
            $this->data['batch_id'] = '';
            $this->data['head_typeId'] = 1;
            
            $this->data['head_type']         = $this->CRUDModel->dropDown('hostel_head_type','', 'id', 'title',array('status'=>1,'id'=>1));
            $this->data['batch']          = $this->CRUDModel->dropDown('prospectus_batch','', 'batch_id', 'batch_name',array('status'=>'on'));
            
    if($this->input->post()):
         //Insert Code 
         $feehead           = $this->input->post('feehead');
         $amount            = $this->input->post('amount');
         $status            = $this->input->post('status');
         $batch            = $this->input->post('batch');
         $head_type            = $this->input->post('head_type');
         $id                = $this->input->post('id');
         
         $currnetDate   =  date('Y-m-d H:i:s');
         $userInfo      = $this->getUser();
 
         if($id):

             $data = array(
             'title'     =>$feehead,
             'amount'     =>$amount,
             'status'     =>$status,
             'head_type'     =>$head_type,
             'batch_id'     =>$batch,
             );

             $where = array('id'=>$id);
             $this->CRUDModel->update('hostel_heads',$data,$where);
             redirect('hostelMessHeadsNew');
             else:
                 
                 $data = array(
                   'head_type'  =>$head_type,
                    'title'     =>$feehead,
                    'amount'    =>$amount,
                    'timestamp' =>$currnetDate,
                    'user_id'   =>$userInfo['user_id'],
                     'batch_id'     =>$batch,
                    );
                $this->CRUDModel->insert('hostel_heads',$data);
                 redirect('hostelMessHeadsNew');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $row                        = $this->CRUDModel->get_where_row('hostel_heads',array('id'=>$id));
            $this->data['feehead']      = $row->title;
            $this->data['status']       = $row->status;
            $this->data['amount']       = $row->amount;
            $this->data['batch_id']     = $row->batch_id;
            $this->data['id']           = $row->id;
            $this->data['head_typeId']  = $row->head_type;
        
        
        endif;

            $this->data['result']              = $this->HostelModel->hoste_fee_heads();
//            echo '<pre>';print_r($this->data['result']);die;
            $this->data['page_title']  = 'Hostel and Mess Heads | ECMS';
            $this->data['page_header']  = 'Hoste and Mess';
            $this->data['page'] = 'hostel/setups/hostel_mess_heads';
            $this->load->view('common/common',$this->data);
    }
   
 
      public function hostel_mess_heads_delete(){
        $id = $this->uri->segment(2);
        $this->CRUDModel->deleteid('hostel_heads',array('Id'=>$id));
        redirect('hostelMessHeadsNew');
        
    }
    public function hostel_mess_payment(){
        
        $this->data['challan_id'] = '';
        
        if($this->input->post('search')):
            
            $challan_id                 = $this->input->post('challan_no');
            $where                      = array('hostel_student_bill.id'=>$challan_id);
            $this->data['std_info']     = $this->HostelModel->student_info($where);
            $this->data['challan_id']   = $challan_id;
            $this->data['challan_info'] = $this->HostelModel->challan_info($where);
            
        endif;
        
        if($this->input->post('save')):
            
           $challan_id      = $this->input->post('challan_no'); 
           $payment_date    = $this->input->post('payment_date'); 
           $check_lock = $this->db->get_where('hostel_student_bill',array('id'=>$challan_id))->row();
           
           
           //Check Hostel Date is locked or Open
           
           $check_date = $this->db->get_where('hostel_brr_lock',array('lock_date'=>date('Y-m-d',strtotime($payment_date)),'status'=>1))->row();
           if(empty($check_date)):
               
          
           //check for Hostel old challan information   
           if($check_lock->challan_lock == 1 && $check_lock->head_type == 1):
 
                $current_bill_heads     =  $this->db->get_where(' hostel_student_bill_info',array('hostel_bill_id'=>$challan_id))->result();
                $where_search = array(
                    'id >'              => $check_lock->id, //515
                    'hostel_std_id'     => $check_lock->hostel_std_id, //student hostel id 
                    'head_type'         => $check_lock->head_type,     // hostel type hosetl =1 , mess = 2
                );
              $remove_from_otherBill    =  $this->db->get_where('hostel_student_bill',$where_search)->result();
 
              foreach($remove_from_otherBill as $row):
                  
                   $current_paid_bill = $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$row->id))->result();
                  foreach($current_bill_heads as $rowCurrent):
                     
                      $delete_items = array(
                          'hostel_bill_id'=>$row->id,
                          'hostel_head_id'=>$rowCurrent->hostel_head_id,
                      );
                      $this->CRUDModel->deleteid('hostel_student_bill_info',$delete_items);
                   endforeach;
                endforeach;
            endif;
           //check for Mess old challan information   
           if($check_lock->challan_lock == 1 && $check_lock->head_type == 2):
 
               
                $where_search = array(
                    'hostel_student_bill.id >'  => $check_lock->id, //515
                    'hostel_std_id'             => $check_lock->hostel_std_id, //student hostel id 
                    'head_type'                 => $check_lock->head_type,     // hostel type hosetl =1 , mess = 2
                 );
 
                $remove_from_otherBill    = $this->db->get_where('hostel_student_bill',$where_search)->result();
                foreach($remove_from_otherBill as $row):
                    $current_bill_count     =  $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$challan_id));
                     $rowcount = $current_bill_count->num_rows();
                        $where_ids = array(
                          
                          'hostel_student_bill.id'                      => $row->id,
                          'hostel_student_bill_info.old_challan_id !='  => 0
                          
                          );
                                            $this->db->select('
                                                    hostel_student_bill.id as challan_id,
                                                    hostel_student_bill_info.id as info_id,
                                                    hostel_student_bill_info.hostel_head_id,
                                                    hostel_student_bill_info.amount,
                                                    '); 
                                            $this->db->limit($rowcount,'0');
                                            $this->db->order_by('hostel_student_bill_info.id','asc');   
                                            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                $remove_ids    = $this->db->get_where('hostel_student_bill',$where_ids)->result();
                    foreach($remove_ids as $rowCurrent):
                     
                      $delete_items = array(
                        'id'=>$rowCurrent->info_id,
                      );
                      $this->CRUDModel->deleteid('hostel_student_bill_info',$delete_items);
                   endforeach;
                endforeach;
            endif;
       
         
           $SET = array(
                'payment_date'      => date('Y-m-d',strtotime($payment_date)), 
                'challan_status'    => 2,
                'up_timestamp'      => date('Y-m-d H:i:s'),  
                'up_user_id'        => $this->userInfo->user_id,
           );
            $where = array(
                'id'                => $challan_id
            );
           $this->CRUDModel->update('hostel_student_bill',$SET,$where);
           $where_ch_info           = array('hostel_bill_id'=>$challan_id);
           $challan_info            = $this->HostelModel->challan_info($where_ch_info);
            foreach($challan_info as $chRow):
                $balance            = $chRow->amount - $chRow->paid_amount;
             
           $data_info = array(
                    'paid_amount'   => $chRow->amount,
                    'balance'       => 0
           );
           $where_info = array(
              'id' => $chRow->id
           );
           $this->CRUDModel->update('hostel_student_bill_info',$data_info,$where_info);
               
           endforeach;
                                    $this->db->join('hostel_student_record','hostel_student_record.hostel_id=hostel_student_bill.hostel_std_id');  
            $student_hotel_recr =   $this->db->get_where('hostel_student_bill',array('id'=>$challan_id))->row();
            
            if($student_hotel_recr->hostel_status_id == 5):
                $set_enrolled    = array(
                        'hostel_status_id'       => 1,
                        'allotted_date'          => date('Y-m-d',strtotime($payment_date)));
                $where_enrolled  = array(
                        'hostel_id'=>$student_hotel_recr->hostel_id
                    );
           $this->CRUDModel->update('hostel_student_record',$set_enrolled,$where_enrolled);
            
           endif;
           
           redirect('HMPayments'); 
              else:
              
            $this->data['error_msg'] = array(
                    'date'      => $check_date->lock_date                   
                );
                  
            $challan_id                 = $this->input->post('challan_no');
            $where                      = array('hostel_student_bill.id'=>$challan_id);
            $this->data['std_info']     = $this->HostelModel->student_info($where);
            $this->data['challan_id']   = $challan_id;
            $this->data['challan_info'] = $this->HostelModel->challan_info($where);
           endif;  
           
        endif;
        
        $this->data['page_title']   = 'Hostel & Mess Payment | ECMS';
        $this->data['page_header']  = 'Hostel & Mess Payment';
        $this->data['page']         = 'hostel/hostel_mess_payment';
        $this->load->view('common/common',$this->data);
    }
    public function hostel_mess_installment(){
        
        $this->data['challan_id'] = '';
        
        if($this->input->post('search')):
            
            $challan_id                 = $this->input->post('challan_no');
            $where                      = array('hostel_student_bill.id'=>$challan_id);
            $this->data['std_info']     = $this->HostelModel->student_info($where);
            $this->data['challan_id']   = $challan_id;
            $this->data['challan_info'] = $this->HostelModel->challan_info($where);
            
        endif;
        
        if($this->input->post('save')):
            
           $challan_id      = $this->input->post('challan_no'); 
           $payment_date    = $this->input->post('payment_date'); 
           $check_lock = $this->db->get_where('hostel_student_bill',array('id'=>$challan_id))->row();
           
           
           //Check Hostel Date is locked or Open
           
           $check_date = $this->db->get_where('hostel_brr_lock',array('lock_date'=>date('Y-m-d',strtotime($payment_date)),'status'=>1))->row();
           if(empty($check_date)):
               
          
           //check for Hostel old challan information   
           if($check_lock->challan_lock == 1 && $check_lock->head_type == 1):
 
                $current_bill_heads     =  $this->db->get_where(' hostel_student_bill_info',array('hostel_bill_id'=>$challan_id))->result();
                $where_search = array(
                    'id >'              => $check_lock->id, //515
                    'hostel_std_id'     => $check_lock->hostel_std_id, //student hostel id 
                    'head_type'         => $check_lock->head_type,     // hostel type hosetl =1 , mess = 2
                );
              $remove_from_otherBill    =  $this->db->get_where('hostel_student_bill',$where_search)->result();
 
              foreach($remove_from_otherBill as $row):
                  
                   $current_paid_bill = $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$row->id))->result();
                  foreach($current_bill_heads as $rowCurrent):
                     
                      $delete_items = array(
                          'hostel_bill_id'=>$row->id,
                          'hostel_head_id'=>$rowCurrent->hostel_head_id,
                      );
                      $this->CRUDModel->deleteid('hostel_student_bill_info',$delete_items);
                   endforeach;
                endforeach;
            endif;
           //check for Mess old challan information   
           if($check_lock->challan_lock == 1 && $check_lock->head_type == 2):
 
               
                $where_search = array(
                    'hostel_student_bill.id >'  => $check_lock->id, //515
                    'hostel_std_id'             => $check_lock->hostel_std_id, //student hostel id 
                    'head_type'                 => $check_lock->head_type,     // hostel type hosetl =1 , mess = 2
                 );
 
                $remove_from_otherBill    = $this->db->get_where('hostel_student_bill',$where_search)->result();
                foreach($remove_from_otherBill as $row):
                    $current_bill_count     =  $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$challan_id));
                     $rowcount = $current_bill_count->num_rows();
                        $where_ids = array(
                          
                          'hostel_student_bill.id'                      => $row->id,
                          'hostel_student_bill_info.old_challan_id !='  => 0
                          
                          );
                                            $this->db->select('
                                                    hostel_student_bill.id as challan_id,
                                                    hostel_student_bill_info.id as info_id,
                                                    hostel_student_bill_info.hostel_head_id,
                                                    hostel_student_bill_info.amount,
                                                    '); 
                                            $this->db->limit($rowcount,'0');
                                            $this->db->order_by('hostel_student_bill_info.id','asc');   
                                            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                $remove_ids    = $this->db->get_where('hostel_student_bill',$where_ids)->result();
                    foreach($remove_ids as $rowCurrent):
                     
                      $delete_items = array(
                        'id'=>$rowCurrent->info_id,
                      );
                      $this->CRUDModel->deleteid('hostel_student_bill_info',$delete_items);
                   endforeach;
                endforeach;
            endif;
       
         
           $SET = array(
                'payment_date'      => date('Y-m-d',strtotime($payment_date)), 
                'challan_status'    => 2,
                'up_timestamp'      => date('Y-m-d H:i:s'),  
                'up_user_id'        => $this->userInfo->user_id,
           );
            $where = array(
                'id'                => $challan_id
            );
           $this->CRUDModel->update('hostel_student_bill',$SET,$where);
           $where_ch_info           = array('hostel_bill_id'=>$challan_id);
           $challan_info            = $this->HostelModel->challan_info($where_ch_info);
            foreach($challan_info as $chRow):
                $balance            = $chRow->amount - $chRow->paid_amount;
             
           $data_info = array(
                    'paid_amount'   => $chRow->amount,
                    'balance'       => 0
           );
           $where_info = array(
              'id' => $chRow->id
           );
           $this->CRUDModel->update('hostel_student_bill_info',$data_info,$where_info);
               
           endforeach;
                                    $this->db->join('hostel_student_record','hostel_student_record.hostel_id=hostel_student_bill.hostel_std_id');  
            $student_hotel_recr =   $this->db->get_where('hostel_student_bill',array('id'=>$challan_id))->row();
            
            if($student_hotel_recr->hostel_status_id == 5):
                $set_enrolled    = array(
                        'hostel_status_id'       => 1,
                        'allotted_date'          => date('Y-m-d',strtotime($payment_date)));
                $where_enrolled  = array(
                        'hostel_id'=>$student_hotel_recr->hostel_id
                    );
           $this->CRUDModel->update('hostel_student_record',$set_enrolled,$where_enrolled);
            
           endif;
           
           redirect('HMPayments'); 
              else:
              
            $this->data['error_msg'] = array(
                    'date'      => $check_date->lock_date                   
                );
                  
            $challan_id                 = $this->input->post('challan_no');
            $where                      = array('hostel_student_bill.id'=>$challan_id);
            $this->data['std_info']     = $this->HostelModel->student_info($where);
            $this->data['challan_id']   = $challan_id;
            $this->data['challan_info'] = $this->HostelModel->challan_info($where);
           endif;  
           
        endif;
        
        $this->data['page_title']   = 'Hostel & Mess Installment | ECMS';
        $this->data['page_header']  = 'Hostel & Mess Installment';
        $this->data['page']         = 'hostel/hostel_mess_installment';
        $this->load->view('common/common',$this->data);
    }
        public function hostel_mess_payment1(){
        
        $this->data['challan_id'] = '';
        
        if($this->input->post('search')):
            
            $challan_id                 = $this->input->post('challan_no');
            $where                      = array('hostel_student_bill.id'=>$challan_id);
            $this->data['std_info']     = $this->HostelModel->student_info($where);
            $this->data['challan_id']   = $challan_id;
            $this->data['challan_info'] = $this->HostelModel->challan_info($where);
            
        endif;
        
        if($this->input->post('save')):
            
           $challan_id      = $this->input->post('challan_no'); 
           $payment_date    = $this->input->post('payment_date'); 
           
           $check_lock = $this->db->get_where('hostel_student_bill',array('id'=>$challan_id))->row();
           
           //check for Hostel old challan information   
           if($check_lock->challan_lock == 1 && $check_lock->head_type == 1):
 
                $current_bill_heads     =  $this->db->get_where(' hostel_student_bill_info',array('hostel_bill_id'=>$challan_id))->result();
                $where_search = array(
                    'id >'              => $check_lock->id, //515
                    'hostel_std_id'     => $check_lock->hostel_std_id, //student hostel id 
                    'head_type'         => $check_lock->head_type,     // hostel type hosetl =1 , mess = 2
                );
              $remove_from_otherBill    =  $this->db->get_where('hostel_student_bill',$where_search)->result();
 
              foreach($remove_from_otherBill as $row):
                  
                   $current_paid_bill = $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$row->id))->result();
                  foreach($current_bill_heads as $rowCurrent):
                     
                      $delete_items = array(
                          'hostel_bill_id'=>$row->id,
                          'hostel_head_id'=>$rowCurrent->hostel_head_id,
                      );
                      $this->CRUDModel->deleteid('hostel_student_bill_info',$delete_items);
                   endforeach;
                endforeach;
            endif;
           //check for Mess old challan information   
           if($check_lock->challan_lock == 1 && $check_lock->head_type == 2):
 
               
                $where_search = array(
                    'hostel_student_bill.id >'  => $check_lock->id, //515
                    'hostel_std_id'             => $check_lock->hostel_std_id, //student hostel id 
                    'head_type'                 => $check_lock->head_type,     // hostel type hosetl =1 , mess = 2
                 );
 
                $remove_from_otherBill    = $this->db->get_where('hostel_student_bill',$where_search)->result();
                foreach($remove_from_otherBill as $row):
                    $current_bill_count     =  $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$challan_id));
                     $rowcount = $current_bill_count->num_rows();
                        $where_ids = array(
                          
                          'hostel_student_bill.id'                      => $row->id,
                          'hostel_student_bill_info.old_challan_id !='  => 0
                          
                          );
                                            $this->db->select('
                                                    hostel_student_bill.id as challan_id,
                                                    hostel_student_bill_info.id as info_id,
                                                    hostel_student_bill_info.hostel_head_id,
                                                    hostel_student_bill_info.amount,
                                                    '); 
                                            $this->db->limit($rowcount,'0');
                                            $this->db->order_by('hostel_student_bill_info.id','asc');   
                                            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                $remove_ids    = $this->db->get_where('hostel_student_bill',$where_ids)->result();
                    foreach($remove_ids as $rowCurrent):
                     
                      $delete_items = array(
                        'id'=>$rowCurrent->info_id,
                      );
                      $this->CRUDModel->deleteid('hostel_student_bill_info',$delete_items);
                   endforeach;
                endforeach;
            endif;
       
         
           $SET = array(
                'payment_date'      => date('Y-m-d',strtotime($payment_date)), 
                'challan_status'    => 2,
                'up_timestamp'      => date('Y-m-d H:i:s'),  
                'up_user_id'        => $this->userInfo->user_id,
           );
            $where = array(
                'id'                => $challan_id
            );
           $this->CRUDModel->update('hostel_student_bill',$SET,$where);
           $where_ch_info           = array('hostel_bill_id'=>$challan_id);
           $challan_info            = $this->HostelModel->challan_info($where_ch_info);
            foreach($challan_info as $chRow):
                $balance            = $chRow->amount - $chRow->paid_amount;
             
           $data_info = array(
                    'paid_amount'   => $chRow->amount,
                    'balance'       => 0
           );
           $where_info = array(
              'id' => $chRow->id
           );
           $this->CRUDModel->update('hostel_student_bill_info',$data_info,$where_info);
               
           endforeach;
            
           redirect('HMPayments'); 
           
           
        endif;
        
        $this->data['page_title']   = 'Hostel & Mess Payment | ECMS';
        $this->data['page_header']  = 'Hostel & Mess Payment';
        $this->data['page']         = 'hostel/hostel_mess_payment';
        $this->load->view('common/common',$this->data);
    }
           public function hostel_mess_challan_change_status(){
        
        $this->data['challan_id'] = '';
        
        if($this->input->post('search')):
            
            $challan_id                 = $this->input->post('challan_no');
            $where                      = array('hostel_student_bill.id'=>$challan_id);
            $this->data['std_info']     = $this->HostelModel->student_info($where);
            $this->data['challan_id']   = $challan_id;
            
                                    $this->db->order_by('id','desc');
                $check_challan =    $this->db->get_where('hostel_student_bill',array('hostel_std_id'=>$this->data['std_info']->hostel_id,'head_type'=>$this->data['std_info']->head_type))->row();

                if($check_challan->id == $challan_id):
                    $this->data['last_challan'] = 1;
                    else:
                    $this->data['last_challan'] = 0;
                endif;
            $this->data['challan_info'] = $this->HostelModel->challan_info($where);
            
        endif;
        
        if($this->input->post('update')):
        
           $challan_id      = $this->input->post('challan_no'); 


           $SET = array(
                'payment_date'      => '0000-00-00', 
                'challan_status'    => 1,
                'up_timestamp'      => date('Y-m-d H:i:s'),  
                'up_user_id'        => $this->userInfo->user_id,
           );
            $where = array(
                'id'                => $challan_id
            );
           $this->CRUDModel->update('hostel_student_bill',$SET,$where);
           
           $where_ch_info           = array('hostel_bill_id'=>$challan_id);
           $challan_info            = $this->HostelModel->challan_info($where_ch_info);
            foreach($challan_info as $chRow):
                $balance            = $chRow->amount - $chRow->paid_amount;
             
           $data_info = array(
                    'paid_amount'       => 0,
                    'balance'           => $chRow->paid_amount,
                    'update_datetime'   => date('Y-m-d H:i:s'),  
                    'update_by'         => $this->userInfo->user_id,
           );
           $where_info = array(
              'id' => $chRow->id
           );
           $this->CRUDModel->update('hostel_student_bill_info',$data_info,$where_info);
               
           endforeach;
            
           redirect('changeChallanStatus'); 
           
           
        endif;
        
        $this->data['page_title']   = 'Change Challan Status | ECMS';
        $this->data['page_header']  = 'Change Challan Status';
        $this->data['page']         = 'hostel/hostel_mess_change_challan_status';
        $this->load->view('common/common',$this->data);
    }
      public function hostel_payment_report(){
        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name');
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', 'Hostel Status', 'hostel_status_id', 'status_name');
        $this->data['hoste_p_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_head_type'] = $this->CRUDModel->dropDown('hostel_head_type', '', 'id', 'title');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
        
        $this->data['collegeNo']    = '';
        $this->data['challan_status_id']    = '';
        $this->data['status_id']    = '';
        $this->data['batch_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['hoste_p_status_id']   = '';
        $this->data['hotel_type_id']   = 1;
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = '';
        $this->data['to']           = date('d-m-Y');
        
        
           if($this->input->post()):
             $collegeNo      = $this->input->post("collegeNo");
             $challan_no    = $this->input->post("challan_no");
             $form_no       = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $batch          = $this->input->post("batch");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $hostel_head_type = $this->input->post("hostel_head_type");
            $challan_status1 = $this->input->post("challan_status");
            $hostel_status = $this->input->post("hostel_status");
            $hoste_p_status = $this->input->post("hoste_p_status");
        
            $date = array(
                'from'=>$from,
                'to'=>$to,
            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
            $where = '';
//            $where['hostel_student_bill.challan_status'] = 2;
            
            $like = '';
           
            if($batch):
                $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if($hoste_p_status):
                $where['hostel_student_bill.challan_status'] = $hoste_p_status;
                $this->data['hoste_p_status_id'] = $hoste_p_status;
            endif;
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_status_id'] = $hostel_status;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status1):
                $where['hostel_student_bill.challan_status'] = $challan_status1;
                $this->data['challan_status_id'] = $challan_status1;
            endif;
            if($hostel_head_type):
                   
                $where['hostel_student_bill.head_type'] = $hostel_head_type;
                $this->data['hotel_type_id'] = $hostel_head_type;
            endif;
            if($challan_no):
                 $where['hostel_student_bill.id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
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
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            
                if($this->input->post('hostel_std_wise')):
                    
                    $this->data['result']       = $this->HostelModel->hostel_payments($where,$like,$date);
                
//                    echo '<pre>';print_r($this->data['result']);die;
                    $this->data['report_type']  = 'hostel_std_wise';
                     
                    $report_head = '';
                    $report_name = '';
                    
                    if($hostel_head_type == 1):
                        $report_head = 'Hostel';
                        $report_name  = 'Hostel Student Wise Report';
                        else:
                        $report_name  = 'Mess Student Wise Report';
                            $report_head = 'Mess';
                    endif;
                    $this->data['report_head']  = $report_head;
                    $this->data['report_name'] =  $report_name;   
                endif;
                
               
                if($this->input->post('hostel_date_wise')):
                    
                    $this->data['result']       = $this->HostelModel->hostel_date_wise($where,$like,$date);
                    $this->data['report_type']  = 'hostel_date_wise';
                     
                    
                      $report_head = '';
                    $report_name = '';
                    
                    if($hostel_head_type == 1):
                        $report_head = 'Hostel';
                        $report_name  = 'Hostel Date Report';
                        else:
                        $report_name  = 'Mess Date Report';
                            $report_head = 'Mess';
                    endif;
                    $this->data['report_head']  = $report_head;
                    $this->data['report_name'] =  $report_name; 
                
                endif;
               if($this->input->post('hostel_head_wise')):
                   
                    
                    $this->data['result']       = $this->HostelModel->hostel_head_wise_group_wise($where,$like,$date);
                    $this->data['report_type']  = 'hostel_head_wise';
//                     echo '<pre>';print_r($this->data['result'] );die;
                    
                      $report_head = '';
                    $report_name = '';
                    
                    if($hostel_head_type == 1):
                        $report_head = 'Hostel';
                        $report_name  = 'Hostel Group Wise Report';
                        else:
                        $report_name  = 'Mess Group Wise Report';
                            $report_head = 'Mess';
                    endif;
                    $this->data['report_head']  = $report_head;
                    $this->data['report_name'] =  $report_name; 
                
                endif;
                   if($this->input->post('hostel_std_wise_group')):
                   
                    
                    $this->data['result']       = $this->HostelModel->hostel_std_wise_group($where,$like,$date);
                    $this->data['report_type']  = 'hostel_std_wise_group';
//                     echo '<pre>';print_r($this->data['result'] );die;
                    
                      $report_head = '';
                    $report_name = '';
                    
                    if($hostel_head_type == 1):
                        $report_head = 'Hostel';
                        $report_name  = 'Hostel Group Student Wise Report';
                        else:
                        $report_name  = 'Mess Group Student  Wise Report';
                            $report_head = 'Mess';
                    endif;
                    $this->data['report_head']  = $report_head;
                    $this->data['report_name'] =  $report_name; 
                
                endif;
                
              
        endif;
         
        $this->data['page_title']   = 'Hostel Payment Report| ECMS';
        $this->data['page_header']  = 'Hostel Payment';
        $this->data['page']         = 'hostel/report/hostel_payment_report';
        $this->load->view('common/common',$this->data); 
    }
       public function hostel_challan_search(){
        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', 'Hostel Status', 'hostel_status_id', 'status_name');
        $this->data['hoste_p_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_head_type'] = $this->CRUDModel->dropDown('hostel_head_type', '', 'id', 'title');
        $this->data['installment_type'] = $this->CRUDModel->dropDown('fee_category_titles', 'Installment Type', 'cat_title_id', 'title');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
        
        $this->data['collegeNo']    = '';
        $this->data['int_type_id']  = '';
        $this->data['batch_id']     = '';
        $this->data['challan_status_id']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['hoste_p_status_id']   = '';
        $this->data['hotel_type_id']   = 1;
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = date('d-m-Y');
        $this->data['to']           = date('d-m-Y');
        
        
        if($this->input->post()):
             $collegeNo      = $this->input->post("collegeNo");
             $challan_no    = $this->input->post("challan_no");
             $form_no       = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $hostel_head_type = $this->input->post("hostel_head_type");
            $challan_status1 = $this->input->post("challan_status");
            $hostel_status = $this->input->post("hostel_status");
            $hoste_p_status = $this->input->post("hoste_p_status");
            $installment_type = $this->input->post("installment_type");
            $batch          = $this->input->post("batch");
           
//            $date = array(
//                'from'=>$from,
//                'to'=>$to,
//            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
            $where = '';
//            $where['hostel_student_record.hostel_status_id'] = 1;
            
            $like = '';
           
            if($batch):
                $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if($installment_type):
                $where['hostel_student_bill.cat_title_id'] = $installment_type;
                $this->data['int_type_id'] = $installment_type;
            endif;
            if($hoste_p_status):
                $where['hostel_student_bill.challan_status'] = $hoste_p_status;
                $this->data['hoste_p_status_id'] = $hoste_p_status;
            endif;
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_status_id'] = $hostel_status;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status1):
                $where['hostel_student_bill.challan_status'] = $challan_status1;
                $this->data['challan_status_id'] = $challan_status1;
            endif;
            if($hostel_head_type):
                $where['hostel_student_bill.head_type'] = $hostel_head_type;
                $this->data['hotel_type_id'] = $hostel_head_type;
            endif;
            if($challan_no):
                $where['hostel_student_bill.id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
           
//            if($challan_status):
//                $this->data['where'] = array('fee_challan_status.ch_status_id' => $challan_status);
//                $where['fee_challan.fc_ch_status_id'] = $challan_status;
//                $this->data['status_id'] = $challan_status;
//            endif;
         
            
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
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
          
                if($this->input->post('search')):
                    $this->data['result']       = $this->HostelModel->hostel_challan_search($where,$like);
                    $this->data['report_type']  = 'hostel_std_search';
                    
                    if($hostel_head_type == 1):
                        $this->data['report_name']  = 'Hostel Student Wise';
                        else:
                        $this->data['report_name']  = 'Mess Student Wise';
                    endif;
                    
                    
                endif;
            endif;
        
        
        
        $this->data['page_title']   = 'Hostel Student Search| ECMS';
        $this->data['page_header']  = 'Hostel Student Search';
        $this->data['page']         = 'hostel/Forms/hostel_challan_search';
//        $this->data['page']         = 'hostel/hostel_challan_search';
        $this->load->view('common/common',$this->data); 
    }
       public function hostel_admin_challan_search(){
        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', 'Hostel Status', 'hostel_status_id', 'status_name');
        $this->data['hoste_p_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_head_type'] = $this->CRUDModel->dropDown('hostel_head_type', '', 'id', 'title');
        $this->data['installment_type'] = $this->CRUDModel->dropDown('fee_category_titles', 'Installment Type', 'cat_title_id', 'title');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
        
        $this->data['collegeNo']    = '';
        $this->data['int_type_id']  = '';
        $this->data['batch_id']     = '';
        $this->data['challan_status_id']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['hoste_p_status_id']   = '';
        $this->data['hotel_type_id']   = 1;
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = date('d-m-Y');
        $this->data['to']           = date('d-m-Y');
        
        
        if($this->input->post()):
             $collegeNo      = $this->input->post("collegeNo");
             $challan_no    = $this->input->post("challan_no");
             $form_no       = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $hostel_head_type = $this->input->post("hostel_head_type");
            $challan_status1 = $this->input->post("challan_status");
            $hostel_status = $this->input->post("hostel_status");
            $hoste_p_status = $this->input->post("hoste_p_status");
            $installment_type = $this->input->post("installment_type");
            $batch          = $this->input->post("batch");
           
//            $date = array(
//                'from'=>$from,
//                'to'=>$to,
//            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
            $where = '';
//            $where['hostel_student_record.hostel_status_id'] = 1;
            
            $like = '';
           
            if($batch):
                $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if($installment_type):
                $where['hostel_student_bill.cat_title_id'] = $installment_type;
                $this->data['int_type_id'] = $installment_type;
            endif;
            if($hoste_p_status):
                $where['hostel_student_bill.challan_status'] = $hoste_p_status;
                $this->data['hoste_p_status_id'] = $hoste_p_status;
            endif;
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_status_id'] = $hostel_status;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status1):
                $where['hostel_student_bill.challan_status'] = $challan_status1;
                $this->data['challan_status_id'] = $challan_status1;
            endif;
            if($hostel_head_type):
                $where['hostel_student_bill.head_type'] = $hostel_head_type;
                $this->data['hotel_type_id'] = $hostel_head_type;
            endif;
            if($challan_no):
                $where['hostel_student_bill.id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
           
//            if($challan_status):
//                $this->data['where'] = array('fee_challan_status.ch_status_id' => $challan_status);
//                $where['fee_challan.fc_ch_status_id'] = $challan_status;
//                $this->data['status_id'] = $challan_status;
//            endif;
         
            
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
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
          
                if($this->input->post('search')):
                    $this->data['result']       = $this->HostelModel->hostel_challan_search($where,$like);
                    $this->data['report_type']  = 'hostel_std_search';
                    
                    if($hostel_head_type == 1):
                        $this->data['report_name']  = 'Hostel Student Wise';
                        else:
                        $this->data['report_name']  = 'Mess Student Wise';
                    endif;
                    
                    
                endif;
            endif;
        
        
        
        $this->data['page_title']   = 'Hostel Student Search| ECMS';
        $this->data['page_header']  = 'Hostel Student Search';
        $this->data['page']         = 'hostel/hostel_admin_challan_search';
        $this->load->view('common/common',$this->data); 
    }
 
  public function hostel_mess_refund(){
        
        $this->data['challan_id'] = '';
        
        if($this->input->post('search')):
            
            $challan_id = $this->input->post('challan_no');
            $where = array(
                'hostel_student_bill.id'=>$challan_id,
                'hostel_student_bill.challan_status'=>2,
                );
            $this->data['std_info'] = $this->HostelModel->student_info_refund($where);
             $this->data['challan_id'] = $challan_id;
            $this->data['challan_info'] = $this->HostelModel->challan_info($where);
            
//            echo '<pre>';print_r($where);die;
//            echo '<pre>';print_r($this->data['std_info']);die;
//            echo '<pre>';print_r($this->input->post());die;
        endif;
        
        if($this->input->post('save')):
            
            $userInfo      = $this->getUser();
//            echo '<pre>';print_r($this->input->post());die;
           $challan_id      = $this->input->post('challan_no'); 
           $hostel_id      = $this->input->post('hostel_id'); 
           $refund_id       = $this->input->post('refund_id'); 
           $refund_amount   = $this->input->post('refund_amount'); 
           $refund_date    = $this->input->post('refund_date'); 
           
           $data_refund = array(
             'hostel_id'        => $hostel_id,
             'h_challan_id'     => $challan_id,
             'refund_date'      => date('Y-m-d',strtotime($refund_date)),
             'timestamp'        => date('Y-m-d H:i:s'),
             'user_id'          => $userInfo['user_id'],
           );
           
          $hoste_refund =  $this->CRUDModel->insert('hostel_refund',$data_refund);
           
           $combine = array_combine($refund_id, $refund_amount);
            
           foreach($combine as $row => $key):
               $head_id =  $this->db->get_where('hostel_student_bill_info',array('id'=>$row))->row()->hostel_head_id;
               $data = array(
                    'hostel_refund_id'  =>  $hoste_refund,
                    'hostel_head_id'    =>  $head_id,
                    'amount'            =>  $key,
                    'timestamp'         =>  date('Y-m-d H:i:s'),
                    'user_id'           =>  $userInfo['user_id'],
               );
               
               $this->CRUDModel->insert('hostel_refund_detail',$data);
           endforeach;
           
           $data_bil = array(
               'challan_status'=>3
           );
           $where_bil = array(
               'id'  => $challan_id,
                
           );
           $this->CRUDModel->update('hostel_student_bill',$data_bil,$where_bil);
           
           
          $challan_type = $this->CRUDModel->get_where_row('hostel_student_bill',array('id'=>$challan_id));  
         
          if($challan_type->head_type == 1):
               $data = array(
                'hostel_status_id'=>3,
                'updated_user_id'    => $userInfo['user_id'],
                'leaved_date'        => date('Y-m-d',strtotime($refund_date)),
           );
           $where = array(
               'hostel_id'=>$hostel_id
           );
           $this->CRUDModel->update('hostel_student_record',$data,$where);
           
          endif;
           
            redirect('HMRefund'); 
        endif;
        $this->data['page_title']   = 'Hostel Mess Refund | ECMS';
        $this->data['page_header']  = 'Hostel Mess Refund';
        $this->data['page']         = 'hostel/hostel_mess_refund';
        $this->load->view('common/common',$this->data);
    }
     public function hostel_refund_repor2t(){
        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name');
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_status']   = $this->CRUDModel->dropDown('hostel_status', 'Hostel Status', 'hostel_status_id', 'status_name');
        $this->data['hostel_head_type']   = $this->CRUDModel->dropDown('hostel_head_type', '', 'id', 'title');
        
        $this->data['collegeNo']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['hostel_status_id']   = '';
        $this->data['hotel_type_id']   = 1;
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = '';
        $this->data['to']           = date('d-m-Y');
        
        
           if($this->input->post()):
             $collegeNo      = $this->input->post("collegeNo");
             $challan_no    = $this->input->post("challan_no");
             $form_no       = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $hostel_head_type = $this->input->post("hostel_head_type");
            $challan_status = $this->input->post("challan_status");
            $hostel_status = $this->input->post("hostel_status");
           
            $date = array(
                'from'=>$from,
                'to'=>$to,
            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
            $where['hostel_student_record.hostel_status_id']    = 3;
            $where['hostel_student_bill.challan_status']        = 3;
            
            $like = '';
           
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_status_id'] = $hostel_status;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($hostel_head_type):
                $where['hostel_student_bill.head_type'] = $hostel_head_type;
                $this->data['hotel_type_id'] = $hostel_head_type;
            endif;
            if($challan_no):
                $where['fee_challan.fc_challan_id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
           
            if($challan_status):
                $this->data['where'] = array('fee_challan_status.ch_status_id' => $challan_status);
                $where['fee_challan.fc_ch_status_id'] = $challan_status;
                $this->data['status_id'] = $challan_status;
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
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
//             echo '<pre>';print_r($where );die;
                if($this->input->post('search')):
                    $this->data['result']       = $this->HostelModel->hostel_refunds_report($where,$like,$date);
                    $this->data['report_type']  = 'conce_std_wise';
                    $this->data['report_name']  = 'Hostel & Mess Refund Report';
                     
                endif;
              
        endif;
        
        
        
        $this->data['page_title']   = 'Hostel & Mess Refund Report| ECMS';
        $this->data['page_header']  = 'Hostel & Mess Refund Report';
        $this->data['page']         = 'hostel/report/hostel_refund_report';
        $this->load->view('common/common',$this->data); 
    }
        public function hostel_refund_report(){
        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name');
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_status']   = $this->CRUDModel->dropDown('hostel_status', 'Hostel Status', 'hostel_status_id', 'status_name');
        $this->data['hostel_head_type']   = $this->CRUDModel->dropDown('hostel_head_type', '', 'id', 'title');
        
        $this->data['collegeNo']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['hostel_status_id']   = '';
        $this->data['hotel_type_id']   = 1;
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = '';
        $this->data['to']           = date('d-m-Y');
        
        
           if($this->input->post()):
             $collegeNo      = $this->input->post("collegeNo");
             $challan_no    = $this->input->post("challan_no");
             $form_no       = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $hostel_head_type = $this->input->post("hostel_head_type");
            $challan_status = $this->input->post("challan_status");
            $hostel_status = $this->input->post("hostel_status");
          
            $date = array(
                'from'=>$from,
                'to'=>$to,
            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
            $where['hostel_student_record.hostel_status_id']    = 3;
            $where['hostel_student_bill.challan_status']        = 3;
            
            $like = '';
           
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_status_id'] = $hostel_status;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($hostel_head_type):
                $where['hostel_student_bill.head_type'] = $hostel_head_type;
                $this->data['hotel_type_id'] = $hostel_head_type;
            endif;
            if($challan_no):
                $where['fee_challan.fc_challan_id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
           
            if($challan_status):
                $this->data['where'] = array('fee_challan_status.ch_status_id' => $challan_status);
                $where['fee_challan.fc_ch_status_id'] = $challan_status;
                $this->data['status_id'] = $challan_status;
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
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
         
   
                if($this->input->post('refund_std_wise')):
                    
                    $this->data['result']       = $this->HostelModel->hostel_refunds_report($where,$like,$date);
//                echo '<pre>';print_r(    $this->data['result']  );die;
                    $this->data['report_type']  = 'refund_std_wise';
                    $this->data['report_name']  = 'Hostel & Mess Refund Studetn Wise Report';
                     
                endif;
                if($this->input->post('refund_head_wise')):
                      
                    $this->data['result']       = $this->HostelModel->hostel_refunds_head_wise_report($where,$like,$date);
//                echo '<pre>';print_r(    $this->data['result']  );die;
                    $this->data['report_type']  = 'refund_head_wise';
                    $this->data['report_name']  = 'Hostel & Mess Refund Head Wise Report';
                     
                endif;
              
        endif;
        
        
        
        $this->data['page_title']   = 'Hostel & Mess Refund Report| ECMS';
        $this->data['page_header']  = 'Hostel & Mess Refund Report';
        $this->data['page']         = 'hostel/report/hostel_refund_report';
        $this->load->view('common/common',$this->data); 
    }
 
    
   public function add_hostel_head_demo(){
         $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
       $feehead         = $this->input->post('feehead');
       $hostel_amount   = $this->input->post('hostel_amount');
       $feed_id         = $this->input->post('feed_id');
       $formCode        = $this->input->post('formCode');
       $type            = $this->input->post('type');
       
       
       $data = array(
           'head_title_id'  =>$feed_id,
           'amount'         =>$hostel_amount,
           'title'          =>$feehead,
           'formCode'       =>$formCode,
           'hostel_type_id' =>$type,
            'user_id'       => $userInfo->user_id,
            'timestamp'     => date('Y-m-d H:i:s'),
       );
       $this->CRUDModel->insert('hostel_heads_demo',$data);
       
       
       $where = array(
         'user_id'      => $userInfo->user_id,  
         'formCode'     =>$formCode,  
       );
       $result = $this->CRUDModel->get_where_result('hostel_heads_demo',$where);
       
      
           echo '<div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Head </th>
                                                          <th>Amount</th>
                                                       </tr>
                                                    </thead>
                                                    <tbody>';
                        $sn = '';
                            foreach($result as $row):
                                $sn++;
                                echo '<tr class="">
                                        <td>'.$sn.'</td>
                                            <td>'.$row->title.'</td>
                                            <td>'.$row->amount.'</td>
                                         </tr>'; 
                            endforeach; 
                            echo '</tbody>
                    </table>
                </div>';
      
   } 
   
     public function hostel_mess_heads_new_edit(){
         
            
            $this->data['head_type']         = $this->CRUDModel->dropDown('hostel_head_type','', 'id', 'title',array('status'=>1));
            $this->data['batch']             = $this->CRUDModel->dropDown('prospectus_batch','Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['installment_type']  = $this->CRUDModel->dropDown('fee_category_titles','Installment Type', 'cat_title_id', 'title',array('cat_title_status'=>'1'));
            $this->data['hostel_head_title'] = $this->CRUDModel->dropDown('hostel_head_title','Heads Title', 'id', 'title',array('status'=>'1'));
        if($this->input->post()):
         //Insert Code 
            $installment_type   = $this->input->post('installment_type');
            $batch              = $this->input->post('batch');
            $pk_head_id         = $this->input->post('pk_head_id');
            $amount             = $this->input->post('amount');
            $status             = $this->input->post('status');
            $fromDate           = $this->input->post('fromDate');
            $toDate             = $this->input->post('dateTo');
            $feehead_id         = $this->input->post('feehead_id');
            $userInfo           = $this->getUser();
           
           $fee_head_info       = $this->CRUDModel->get_where_row('hostel_head_title',array('id'=>$feehead_id));
//           echo '<pre>';print_r($fee_head_info);/
            $where  = array(
            'id'    => $pk_head_id,
                 );

                    $data = array(
                          
                            'title'         => $fee_head_info->title,
                            'amount'        => $amount,
                            'fromDate'      => date('Y-m-d',strtotime($fromDate)),
                            'toDate'      => date('Y-m-d',strtotime($toDate)),
                            
                            'head_title_id' => $fee_head_info->id,
                            'batch_id'      => $batch,
                            'status'        => $status,
                           'cat_title_id'   => $installment_type,
                            'head_type'     => $fee_head_info->hostel_type_id,
                           'timestamp'      => date('Y-m-d H:i:s'),
                           'user_id'        => $userInfo['user_id'],
                           );
                       $this->CRUDModel->update('hostel_heads',$data,$where);
              
          redirect('hostelMessHeadsNew');
            
        endif;

        $id = $this->uri->segment(2);
        if($id):
            $row                                    = $this->CRUDModel->get_where_row('hostel_heads',array('id'=>$id));
            $this->data['feehead']                  = $row->title;
            $this->data['status']                   = $row->status;
            $this->data['amount']                   = $row->amount;
            $this->data['fromDate']                 = $row->fromDate;
            $this->data['toDate']                   = $row->toDate;
            $this->data['batch_id']                 = $row->batch_id;
            $this->data['instal_type_id']           = $row->cat_title_id;
            $this->data['head_id']                  = $row->id;
            $this->data['head_typeId']              = $row->head_type;
            $this->data['hostel_head_title_id']     = $row->head_title_id;
        
        
        endif;

            $this->data['result']              = $this->HostelModel->hoste_fee_heads();
               
            $this->data['page_title']  = 'Hostel and Mess Heads | ECMS';
            $this->data['page_header']  = 'Hoste and Mess';
            $this->data['page'] = 'hostel/setups/hostel_mess_heads_new_edit';
            $this->load->view('common/common',$this->data);
    }
      public function hostel_fee_group(){
            $this->data['bank_hostel']           = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));  
            $this->data['bank_mess']             = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>16));  
            $this->data['batch']            = $this->CRUDModel->batch_dropdown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));  
            $this->data['installment_type'] = $this->CRUDModel->dropDown('fee_category_titles','Select Installment', 'cat_title_id', 'title',array('cat_title_status'=>1));  
            $this->data['challan_type']     = $this->CRUDModel->dropDown('hostel_head_type','Challan Type', 'id', 'title',array('status'=>1));  
             
             $userInfo      = $this->getUser();
            if($this->input->post()):
               
                $batch              = $this->input->post('batch');
                $installment_type   = $this->input->post('installment_type');
                $date_from          = $this->input->post('date_from');
                $date_to            = $this->input->post('date_to');
                $issue_date         = $this->input->post('issue_date');
                $valid_date         = $this->input->post('valid_date');
                $bank_hostel        = $this->input->post('bank_hostel');
                $bank_mess          = $this->input->post('bank_mess');
                $challan_type       = $this->input->post('challan_type');
                $total_days         = $this->input->post('total_days');
                $per_day_id         = $this->input->post('per_day_id');
                $per_day         = $this->input->post('per_day');
//                $total_amount       = $this->input->post('total_amount');
               
               
                
                
                 if($challan_type == 1):
                     
                    $where = array(
                        'batch_id'                                  => $batch,
                        'hostel_student_record.hostel_status_id'    => 1,
                       
                    );
                    $result = $this->HostelModel->group_wise_student($where);
                        foreach($result as $row):
                            
                            $where_exits_array = array(
                                'cat_title_id'  => $installment_type,
                                'hostel_std_id' => $row->hostel_id,
                                'head_type'     => 1,
                                );
                            $exist_challan = $this->CRUDModel->get_where_row('hostel_student_bill',$where_exits_array);

                            
                            
                            if(empty($exist_challan)):
                                
                                $data = array(
                                    'hostel_std_id'   => $row->hostel_id,  
                                    'date_to'         => date('Y-m-d',strtotime($date_to)),  
                                    'date_from'       => date('Y-m-d',strtotime($date_from)),  
                                    'issue_date'      => date('Y-m-d',strtotime($issue_date)),  
                                    'valid_date'      => date('Y-m-d',strtotime($valid_date)),  
                                    'bank_id'         => $bank_hostel,
                                    'challan_status'  => 1,
                                    'hostel_status_id'=> $row->hostel_status_id,
                                    //hostel or mess 
                                    'head_type'       => 1,
                                     'cat_title_id'     =>$installment_type,
                                    'timestamp'       => date('Y-m-d H:i:s'),  
                                    'user_id'         => $userInfo['user_id'],  
                                  );
                                $hostel_fee_id  =  $this->CRUDModel->insert('hostel_student_bill',$data);
                                 $this->RQ($hostel_fee_id, 'assets/RQ/hostel_rq/');
                                  
                                $old_balance_where= array(
//                                            'hostel_std_id'     => 12,
                                            'hostel_std_id'     => $row->hostel_id,
                                            'head_type'         => 1,
                                            'challan_lock'         => 0,
                                            '(hostel_student_bill_info.amount - hostel_student_bill_info.paid_amount) >'       => 0,
                                            );
                                            $this->db->select('
                                                    hostel_student_bill.id as bill_id,
                                                    hostel_student_bill_info.id as bill_detail_id,
                                                   (hostel_student_bill_info.amount - hostel_student_bill_info.paid_amount) as balance,
                                                    amount,
                                                    hostel_head_id');
                                            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                             $old_balance = $this->db->get_where('hostel_student_bill',$old_balance_where)->result();
                             
                          
                              
                             if(!empty($old_balance)):
                                   foreach($old_balance as $row):
                                    $data = array(
                                        'hostel_bill_id'    =>$hostel_fee_id,
                                        'hostel_head_id'    =>$row->hostel_head_id,
                                        'amount'            =>$row->balance,
                                        'balance'            =>$row->balance,
                                        'old_challan_id'    =>$row->bill_id,
                                        'timestamp'         => date('Y-m-d H:i:s'),  
                                        'user_id'           => $userInfo['user_id'],
                                    );
                                  $this->CRUDModel->insert('hostel_student_bill_info',$data);
                                $this->CRUDModel->update('hostel_student_bill_info',array('balance'=>0),array('id'=>$row->bill_detail_id));
                                endforeach;
                                
                                $data_new = array(
                                    
                                    'old_challan_id'    => $row->bill_id,
                                    'rq_file'           => $hostel_fee_id.'.png'
                                
                                );
                                $where_new = array(
                                    'id'=>$hostel_fee_id
                                );
                                
                                $data_old = array(
                                    'challan_lock'      => 1,
                                 );
                                $where_old = array(
                                    'id'=>$row->bill_id
                                );
                                
                                
                                $this->CRUDModel->update('hostel_student_bill',$data_new,$where_new);
                                $this->CRUDModel->update('hostel_student_bill',$data_old,$where_old);
                                
                                endif;
                             
                            
                                 
                                 
                        $hostel_fee     = $this->CRUDModel->get_where_result('hostel_heads',array('status'=>1,'head_type'=>1,'batch_id'=>$batch,'cat_title_id'=>$installment_type));
                               
                                 foreach($hostel_fee as $feeRow):
                                    $data = array(
                                        'hostel_bill_id'    =>$hostel_fee_id,
                                        'hostel_head_id'    =>$feeRow->id,
                                        'amount'            =>$feeRow->amount,
                                        'balance'            =>$feeRow->amount,
                                        'timestamp'         => date('Y-m-d H:i:s'),  
                                        'user_id'           => $userInfo['user_id'],
                                    );
                                  $this->CRUDModel->insert('hostel_student_bill_info',$data);
                                endforeach;
                            endif;
                        endforeach;
          
                redirect('hostelPrintChallanGroup/'.$batch.'/'.$installment_type.'/'.$challan_type);    
                endif;
                
                 if($challan_type == 2):
                    $where = array(
                    'batch_id'                                  => $batch,
                    'hostel_student_record.hostel_status_id'    => 1,
                );
                $result = $this->HostelModel->group_wise_student($where);
                    foreach($result as $row):
                        $where_exits_array  = array(
                            'cat_title_id'      =>$installment_type,
                            'hostel_std_id'     =>$row->hostel_id,
                            'head_type'         =>2,
                            );
                        $exist_challan = $this->CRUDModel->get_where_row('hostel_student_bill',$where_exits_array);

                        if(empty($exist_challan)):


                            $data = array(
                                'hostel_std_id'   => $row->hostel_id,  
                                'date_to'         => date('Y-m-d',strtotime($date_to)),  
                                'date_from'       => date('Y-m-d',strtotime($date_from)),  
                                'issue_date'      => date('Y-m-d',strtotime($issue_date)),
                                 'valid_date'      => date('Y-m-d',strtotime($valid_date)), 
                                'bank_id'         => $bank_mess,
                                'challan_status'  => 1,
                                'hostel_status_id'=> $row->hostel_status_id,
                                //hostel or mess 
                                'head_type'       => 2,
                                 'cat_title_id'     =>$installment_type,
                                'timestamp'       => date('Y-m-d H:i:s'),  
                                'user_id'         => $userInfo['user_id'],  
                              );
                            $hostel_fee_id  =  $this->CRUDModel->insert('hostel_student_bill',$data);

                            $hostel_fee     = $this->CRUDModel->get_where_result('hostel_heads',array('status'=>1,'head_type'=>2));

                            $this->RQ($hostel_fee_id, 'assets/RQ/hostel_rq/');
                            
                            
                                $old_balance_where= array(
//                                            'hostel_std_id'     => 12,
                                            'hostel_std_id'         => $row->hostel_id,
                                            'head_type'             => 2,
                                            'challan_lock'          => 0,
                                            '(hostel_student_bill_info.amount - hostel_student_bill_info.paid_amount) >'       => 0,
                                            );
                                            $this->db->select('
                                                    hostel_student_bill.id as bill_id,
                                                    hostel_student_bill_info.id as bill_detail_id,
                                                    hostel_student_bill_info.per_day,
                                                    hostel_student_bill_info.total_days,
                                                   (hostel_student_bill_info.amount - hostel_student_bill_info.paid_amount) as balance,
                                                    amount,
                                                    hostel_student_bill_info.hostel_head_id');
                                            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                             $old_balance = $this->db->get_where('hostel_student_bill',$old_balance_where)->result();
                          
                      
                             if(!empty($old_balance)):
                                   foreach($old_balance as $row):
                                    $data = array(
                                        'hostel_bill_id'    => $hostel_fee_id,
                                        'hostel_head_id'    => $row->hostel_head_id,
                                        'amount'            => $row->balance,
                                        'balance'           => $row->balance,
                                        'total_days'        => $row->total_days,
                                        'per_day'           => $row->per_day,
                                        'old_challan_id'    => $row->bill_id,
                                        'timestamp'         => date('Y-m-d H:i:s'),  
                                        'user_id'           => $userInfo['user_id'],
                                    );
                                  $this->CRUDModel->insert('hostel_student_bill_info',$data);
                               
                                  $this->CRUDModel->update('hostel_student_bill_info',array('balance'=>0),array('id'=>$row->bill_detail_id));
                                endforeach;
                                 
                                $data_new = array(
                                    
                                    'old_challan_id'    => $row->bill_id,
                                    'rq_file'           => $hostel_fee_id.'.png'
                                
                                );
                                $where_new = array(
                                    'id'=>$hostel_fee_id
                                );
                                
                                $data_old = array(
                                    'challan_lock'      => 1,
                                 );
                                $where_old = array(
                                    'id'=>$row->bill_id
                                );
                                
                                
                                $this->CRUDModel->update('hostel_student_bill',$data_new,$where_new);
                                $this->CRUDModel->update('hostel_student_bill',$data_old,$where_old);
                                
                                endif;
                             
                            
                             foreach($hostel_fee as $feeRow):

                                $data = array(
                                    'hostel_bill_id'    =>$hostel_fee_id,
                                    'hostel_head_id'    =>$feeRow->id,
                                    'total_days'        => $total_days,
                                    'per_day'           => $per_day,
                                    'amount'            =>$total_days * $per_day,
                                    'balance'            =>$total_days * $per_day,
                                    'timestamp'         => date('Y-m-d H:i:s'),  
                                    'user_id'           => $userInfo['user_id'],
                                );
                              $this->CRUDModel->insert('hostel_student_bill_info',$data);
                            endforeach;

                        endif;


                    endforeach;
          
               redirect('hostelPrintChallanGroup/'.$batch.'/'.$installment_type.'/'.$challan_type); 
                 endif;
                 
             endif;
            
            
            $this->data['page_title']   = 'Hostel Fee Group Challan | ECMS';
            $this->data['page_header']  = 'Hostel Fee Group Challan';
            $this->data['page']         = 'hostel/hostel_fee_group_challan';
            $this->load->view('common/common',$this->data);
    }
      public function hostel_challan_print_group(){
            
        
             $batch_id      = $this->uri->segment(2);
             $install_type  = $this->uri->segment(3);
             $challan_type  = $this->uri->segment(4);
       
             $where = array(
               'student_record.batch_id'            =>$batch_id,  
               'hostel_student_bill.cat_title_id'   =>$install_type,  
               'hostel_student_bill.challan_status' =>1,  
               'hostel_student_bill.head_type'      =>$challan_type,  
             );
             
             $this->data['hostel_info'] = $this->HostelModel->Hostel_print_group($where);
            
            $this->data['page_title']   = 'Hostel Fee | ECMS';
            $this->data['page_header']  = 'Hostel Fee';
            $this->data['page']         = 'hostel/print/hostel_challan_print_group';
            $this->load->view('common/common',$this->data);
    }
         public function hostel_add_head(){
        
        
        $hostel_id                      = $this->uri->segment(2);
        $challan_id                     = $this->uri->segment(3);
        $this->data['pre_challan']      = $this->HostelModel->dropDown_pre_challan('hostel_student_bill', ' Pre Challan', 'id', 'id',array('hostel_std_id'=>$hostel_id,'head_type'=>1));    
        $this->data['balance_type']     = $this->CRUDModel->dropDown('fee_balance_type', '', 'id', 'type');   
//        echo '<pre>';die;
        if($this->input->post()):
            
            $challan_id         = $this->input->post('challan_id');
            $hostel_id          = $this->input->post('hostel_id');
            $fee_head_id        = $this->input->post('fee_head_id');
            $fee_head_amount    = $this->input->post('amount');
            $pre_challan        = $this->input->post('pre_challan');
            $batch_id           = $this->input->post('batch_id');
            $fee_head_name      = $this->input->post('fee_head_name');
            $balance_type       = $this->input->post('balance_type');
            $comments           = $this->input->post('comments');
            $total_days         = $this->input->post('total_days');
            $per_day            = $this->input->post('per_day');
            $hostel_challan_type= $this->input->post('hostel_challan_type');
            $challan_status     = $this->input->post('challan_status');
            $userInfo           = $this->getUser();
        
            
            $data = array(
                'title'         => $fee_head_name,  
                'amount'        => $fee_head_amount,
                'head_title_id' => $fee_head_id,
                'timestamp'     => date('Y-m-d H:i:s'),
                'user_id'       => $userInfo['user_id'],
               
           );
            $hostel_bill_id = $this->CRUDModel->insert('hostel_heads',$data);
            
            
            
                if($hostel_challan_type == 1):  //Hostel Challan
                     
                $data_challan = array(
                    'hostel_bill_id'     => $challan_id,  
                    'hostel_head_id'     => $hostel_bill_id,  
                     'amount'            => $fee_head_amount,
                     'balance'           => $fee_head_amount,
                     'comments'          => $comments,
                     'paid_amount'       => 0,
                     'timestamp'         => date('Y-m-d H:i:s'),
                     'user_id'           => $userInfo['user_id'],
                     'old_challan_id'    => $balance_type,
                );
                
                else: //Mess Challan
                    
                     $data_challan = array(
                    'hostel_bill_id'    => $challan_id,  
                    'hostel_head_id'    => $hostel_bill_id,  
                     'amount'           => $fee_head_amount,
                     'balance'          => $fee_head_amount,
                     'comments'         => $comments,
                     'total_days'       => $total_days,
                     'per_day'         => $per_day,
                     'paid_amount'      => 0,
                     'timestamp'        => date('Y-m-d H:i:s'),
                     'user_id'          => $userInfo['user_id'],
                     'old_challan_id'   => $balance_type,
                );   
                
            endif;
                
            
            
            
           
            
            
            
            $this->CRUDModel->insert('hostel_student_bill_info',$data_challan);
            redirect('hostelAddHead/'.$hostel_id.'/'.$challan_id);
        endif;
        
        
        $where = array(
          'hostel_student_bill.hostel_std_id'=>$hostel_id,  
          'hostel_student_bill.id'=>$challan_id,  
        );
             
        
        $this->data['per_day']      = $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
        $this->data['studentInfo']  =   $this->HostelModel->hostel_student_info($where);
        $this->data['result']       =   $this->HostelModel->hoste_student_fee_info(array('hostel_bill_id'=>$this->uri->segment(3)));

//        echo '<pre>';print_r($this->data['studentInfo']);die;
       $this->data['page_title']   = 'Hostel & Mess New Head| ECMS';
        $this->data['page_header']  = 'Hostel & Mess New Head';
        $this->data['page']         = 'hostel/hostel_add_new_heads';
        $this->load->view('common/common',$this->data); 
    }
      public function hostel_head_update(){
        
        
        $hostel_id          = $this->uri->segment(2);
        $challan_id         = $this->uri->segment(3);
        $challan_info_id    = $this->uri->segment(4);
        $this->data['pre_challan']  = $this->HostelModel->dropDown_pre_challan('hostel_student_bill', ' Pre Challan', 'id', 'id',array('hostel_std_id'=>$hostel_id,'head_type'=>1));    
        $this->data['balance_type']  = $this->CRUDModel->dropDown('fee_balance_type', '', 'id', 'type');   
                                           
                                           $this->db->select('hostel_head_title.title,hostel_student_bill_info.*'); 
                                           $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id'); 
                                           $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id'); 
        $this->data['challan_head_info'] = $this->db->get_where('hostel_student_bill_info',array('hostel_student_bill_info.id'=>$challan_info_id))->row();
        
        if($this->input->post()):
            
            $challan_id         = $this->input->post('challan_id');
            $hostel_id          = $this->input->post('hostel_id');
            $fee_head_id        = $this->input->post('fee_head_id');
            $fee_head_amount    = $this->input->post('amount');
            $pre_challan        = $this->input->post('pre_challan');
            $batch_id           = $this->input->post('batch_id');
            $fee_head_name          = $this->input->post('fee_head_name');
            $balance_type           = $this->input->post('balance_type');
            $comments               = $this->input->post('comments');
            $hostel_challan_type    = $this->input->post('hostel_challan_type');
            $hostel_info_id         = $this->input->post('hostel_info_id');
            $total_days             = $this->input->post('total_days');
            $per_day                = $this->input->post('per_day');
            $userInfo               = $this->getUser();
        
             $where = array(
              'id'  =>$hostel_info_id
            );
             
             $challan_info = $this->db->get_where('hostel_student_bill',array('id'=>$challan_id))->row();
//             echo '<pre>';print_r($challan_info);die;
             //1= Hostel ,2 = Mess
             if($hostel_challan_type == 1):
                 
                 if($challan_info->challan_lock == 1):
                    
                        $set_hostel_log = array(
                            'hostel_info_id'    => $hostel_info_id,
                            'hostel_bill_id'    => $challan_id,
                            'hostel_head_id'    => $fee_head_id,
                            'amount'            => $fee_head_amount,
                            'paid_amount'       => 0,      
                            'old_challan_id'    => $balance_type,     
                            'comments'          => $comments,
                            'up_timestamp'      => date('Y-m-d H:i:s'),
                            'up_userid'         => $userInfo['user_id'],
                           
                        );

                        $set_hostel = array(
                            'amount'        => $fee_head_amount,
                            'comments'      => $comments,
                            'paid_amount'       => 0,
                        );

                     
                     else:
                     
                     
                        $set_hostel_log = array(
                            'hostel_info_id'    => $hostel_info_id,
                            'hostel_bill_id'    => $challan_id,
                            'hostel_head_id'    => $fee_head_id,
                            'amount'            => $fee_head_amount,
                            'balance'           => $fee_head_amount,
                            'paid_amount'       => 0,      
                            'old_challan_id'    => $balance_type,     
                            'comments'          => $comments,
                            'up_timestamp'      => date('Y-m-d H:i:s'),
                            'up_userid'         => $userInfo['user_id'],
                        );

                         $set_hostel = array(
                            'amount'        => $fee_head_amount,
                            'balance'       => $fee_head_amount,
                            'comments'      => $comments,
                            'paid_amount'       => 0,
                             'old_challan_id'    => $balance_type, 
                            );
                     
                     
                 endif;
                 
                
                 else:
                     
                     if($challan_info->challan_lock == 1):
                         
                           $set_hostel_log = array(
                                'total_days'    => $total_days,
                                'per_day'       => $per_day,
                                'hostel_info_id'    => $hostel_info_id,
                                'hostel_bill_id'    => $challan_id,
                                'hostel_head_id'    => $fee_head_id,
                                'amount'            => $fee_head_amount,
                                
                                'old_challan_id'    => $balance_type,     
                                'comments'          => $comments,
                                'up_timestamp'      => date('Y-m-d H:i:s'),
                                'up_userid'         => $userInfo['user_id'],
                                'old_challan_id'    => $balance_type, 
                            );    

                             $set_hostel = array(
                                    'total_days'    => $total_days,
                                    'per_day'       => $per_day,
                                    'amount'        => $fee_head_amount,
                                    
                                    'comments'      => $comments,
                           );
                         
                         
                         else:
                        
                           $set_hostel_log = array(
                                'total_days'    => $total_days,
                                'per_day'       => $per_day,
                                'hostel_info_id'    => $hostel_info_id,
                                'hostel_bill_id'    => $challan_id,
                                'hostel_head_id'    => $fee_head_id,
                                'amount'            => $fee_head_amount,
                                'balance'           => $fee_head_amount,
                                'old_challan_id'    => $balance_type,     
                                'comments'          => $comments,
                                'up_timestamp'      => date('Y-m-d H:i:s'),
                                'up_userid'         => $userInfo['user_id'],
                            );    

                             $set_hostel = array(
                                    'total_days'    => $total_days,
                                    'per_day'       => $per_day,
                                    'amount'        => $fee_head_amount,
                                    'balance'       => $fee_head_amount,
                                    'comments'      => $comments,
                                    'old_challan_id'    => $balance_type, 
                           );
                     endif;
                     
                     
               
            endif;
             
            
            $this->CRUDModel->update('hostel_student_bill_info',$set_hostel,$where);
            $this->CRUDModel->insert('hostel_student_bill_info_update_log',$set_hostel_log);
            redirect('hostelAddHead/'.$hostel_id.'/'.$challan_id);
        endif;
        
        
        $where = array(
          'hostel_student_bill.hostel_std_id'   => $hostel_id,  
          'hostel_student_bill.id'              => $challan_id,  
        );
             
        
        $this->data['per_day']      = $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
        $this->data['studentInfo']  =   $this->HostelModel->hostel_student_info($where);
//        $this->data['result']       =   $this->HostelModel->hoste_student_fee_info(array('hostel_bill_id'=>$this->uri->segment(3)));
        
//        echo '<pre>';print_r($this->data['challan_head_info']);die;
       $this->data['page_title']   = 'Hostel & Mess Update Head| ECMS';
        $this->data['page_header']  = 'Hostel & Mess Update Head';
        $this->data['page']         = 'hostel/hostel_update_new_heads';
        $this->load->view('common/common',$this->data); 
    }
//     public function hostel_add_head(){
//        
//        
//        $hostel_id                  = $this->uri->segment(2);
//        $challan_id                 = $this->uri->segment(3);
//        $this->data['pre_challan']  = $this->HostelModel->dropDown_pre_challan('hostel_student_bill', ' Pre Challan', 'id', 'id',array('hostel_std_id'=>$hostel_id,'head_type'=>1));    
////        echo '<pre>';die;
//        if($this->input->post()):
//            
//            $challan_id         = $this->input->post('challan_id');
//            $hostel_id          = $this->input->post('hostel_id');
//            $fee_head_id        = $this->input->post('fee_head_id');
//            $fee_head_amount    = $this->input->post('amount');
//            $pre_challan        = $this->input->post('pre_challan');
//            $batch_id           = $this->input->post('batch_id');
//            $fee_head_name           = $this->input->post('fee_head_name');
//            $comments           = $this->input->post('comments');
//             $userInfo      = $this->getUser();
//        
//            
//            $data = array(
//                'title'         => $fee_head_name,  
//                'amount'        => $fee_head_amount,
//                'head_title_id' => $fee_head_id,
//                'timestamp'     => date('Y-m-d H:i:s'),
//                'user_id'       => $userInfo['user_id'],
//           );
//            
//            $hostel_bill_id = $this->CRUDModel->insert('hostel_heads',$data);
//            $data_challan = array(
//               'hostel_bill_id' => $challan_id,  
//               'hostel_head_id' => $hostel_bill_id,  
//                'amount'        => $fee_head_amount,
//                'balance'       => $fee_head_amount,
//                 'comments'      => $comments,
////                'old_challan_id'   => $pre_challan,
//                'paid_amount'   => 0,
//                'timestamp'     => date('Y-m-d H:i:s'),
//                'user_id'      => $userInfo['user_id'],  
//            );
//            $this->CRUDModel->insert('hostel_student_bill_info',$data_challan);
//            redirect('hostelAddHead/'.$hostel_id.'/'.$challan_id);
//        endif;
//        
//        
//        $where = array(
//          'hostel_student_bill.hostel_std_id'=>$hostel_id,  
//          'hostel_student_bill.id'=>$challan_id,  
//        );
//             
//        
//        $this->data['per_day']      = $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
//        $this->data['studentInfo']  =   $this->HostelModel->hostel_student_info($where);
//        $this->data['result']       =   $this->HostelModel->hoste_student_fee_info(array('hostel_bill_id'=>$this->uri->segment(3)));
//
////        echo '<pre>';print_r($this->data['result']);die;
//       $this->data['page_title']   = 'Hostel & Mess New Head| ECMS';
//        $this->data['page_header']  = 'Hostel & Mess New Head';
//        $this->data['page']         = 'hostel/hostel_add_new_heads';
//        $this->load->view('common/common',$this->data); 
//    }
     public function hostel_challan_update(){
        
        
        $hostel_id          = $this->uri->segment(2);
        $challan_id         = $this->uri->segment(3);
        
        if($this->input->post()):
            
            $challan_id         = $this->input->post('challan_id');
            $hostel_id          = $this->input->post('hostel_id');
            $fee_head_id        = $this->input->post('fee_head_id');
            $fee_head_amount    = $this->input->post('amount');
            $batch_id           = $this->input->post('batch_id');
            $date_from          = $this->input->post('date_from');
            $date_to            = $this->input->post('date_to');
            $valid_date         = $this->input->post('valid_date');
            $issue_date         = $this->input->post('issue_date');
            $comments           = $this->input->post('comments');
             $userInfo          = $this->getUser();
        
            
            $data = array(
                'date_from'     => date('Y-m-d',strtotime($date_from)),  
                'date_to'       => date('Y-m-d',strtotime($date_to)),  
                'valid_date'    => date('Y-m-d',strtotime($valid_date)),  
                'issue_date'    => date('Y-m-d',strtotime($issue_date)),  
                'timestamp'     => date('Y-m-d H:i:s'),
                'comments'      => $comments,
                'user_id'       => $userInfo['user_id'],
           );
            $where = array(
                'hostel_std_id'=>$hostel_id,
                'id'=>$challan_id,
            );
           $this->CRUDModel->update('hostel_student_bill',$data,$where);
            
            redirect('hostelPrintChallan/'.$hostel_id.'/'.$challan_id);
        endif;
        
        
        $where = array(
          'hostel_student_bill.hostel_std_id'=>$hostel_id,  
          'hostel_student_bill.id'=>$challan_id,  
        );
             
        
        
        $this->data['studentInfo']  =   $this->HostelModel->hostel_student_info($where);
        $this->data['result']       =   $this->HostelModel->hoste_student_fee_info(array('hostel_bill_id'=>$this->uri->segment(3)));

//        echo '<pre>';print_r($this->data['result']);die;
       $this->data['page_title']   = 'Hostel & Mess Update| ECMS';
        $this->data['page_header']  = 'Hostel & Mess Update';
        $this->data['page']         = 'hostel/hostel_challan_update';
        $this->load->view('common/common',$this->data); 
    }
    public function hostel_head_delete(){
        $id2         = $this->uri->segment(2);
        $id3         = $this->uri->segment(3);
        $id         = $this->uri->segment(4);
        
        $where      = array('hostel_student_bill_info.id'=>$id);
        $this->CRUDModel->deleteid('hostel_student_bill_info',$where);
        redirect('hostelAddHead/'.$id2.'/'.$id3);
    }
    public function hostel_head_delete_adjust(){
        $id         = $this->input->post('delteAjust');
        
        $where      = array('hostel_student_bill_info.id'=>$id);
        $this->CRUDModel->deleteid('hostel_student_bill_infos',$where);
//        redirect('hostelAddHead/'.$id2.'/'.$id3);
    }
        
      public function hostel_challan_cancel(){
        
        $challan_id         = $this->uri->segment(2);
        $hostel_id         = $this->uri->segment(3);
         $this->data['per_day']      = $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
          $where = array(
          'hostel_student_bill.hostel_std_id'=>$hostel_id,  
          'hostel_student_bill.id'=>$challan_id,  
        );
            
         $this->data['studentInfo']  =   $this->HostelModel->hostel_student_info($where);
        $this->data['result']       =   $this->HostelModel->hoste_student_fee_info(array('hostel_bill_id'=>$challan_id));

        
        if($this->input->post()):
            
        $challan_id         = $this->input->post('challan_id');
        $hostel_id          = $this->input->post('hostel_id');
        
        
        $challan = $this->CRUDModel->get_where_row('hostel_student_bill',array('id'=>$challan_id,'hostel_std_id'=>$hostel_id));
       
        
        $userInfo      = $this->getUser();
        
            $challa_data = array(
                  'hostel_challan_id'   => $challan_id,  
                  'hostel_std_id'       => $challan->hostel_std_id,  
                  'date_to'             => date('Y-m-d',strtotime($challan->date_to)),  
                  'date_from'           => date('Y-m-d',strtotime($challan->date_to)),  
                  'issue_date'          => date('Y-m-d',strtotime($challan->issue_date)),  
                  'payment_date'        => date('Y-m-d',strtotime($challan->issue_date)),  
                  'comments'            => $this->input->post('comments'),  
                  'bank_id'             => $challan->bank_id,
                  'challan_status'      => $challan->challan_status,
                  'hostel_status_id'    => $challan->hostel_status_id,
                  'head_type'           => $challan->head_type, 
                  'timestamp'           => date('Y-m-d H:i:s'),  
                  'user_id'             => $userInfo['user_id'],  
                );
                
        $this->CRUDModel->insert('hostel_challan_cancel',$challa_data);
         $challan_details = $this->CRUDModel->get_where_result('hostel_student_bill_info',array('hostel_bill_id'=>$challan_id));
        
         foreach($challan_details as $feeRow):
             $data = array(
                        'hostel_bill_id'    =>$challan_id,
                        'hostel_head_id'    =>$feeRow->id,
                        'amount'            =>$feeRow->amount,
                        'timestamp'         => date('Y-m-d H:i:s'),  
                        'user_id'           => $userInfo['user_id'],
                    );
                  $this->CRUDModel->insert(' hostel_challan_cancel_details',$data);
         endforeach;
         
        
         $this->CRUDModel->deleteid('hostel_student_bill',array('hostel_student_bill.id'=>$challan_id));
         $this->CRUDModel->deleteid('hostel_student_bill_info',array('hostel_student_bill_info.hostel_bill_id'=>$challan_id));
         redirect('hosteChallanSearch');
           endif;
      
       $this->data['page_title']   = 'Hostel & Mess Cancel Challan| ECMS';
        $this->data['page_header']  = 'Hostel & Mess Cancel Challan';
        $this->data['page']         = 'hostel/hostel_cancel_challan';
        $this->load->view('common/common',$this->data); 
           
           
    }
    
    public function get_batch_wise_students(){
        
        
        $batch_id = $this->input->post('batch_id');
//        $result = $this->HostelModel->get_batch_wise_student(array('student_record.batch_id'=>$batch_id));
        $result = $this->HostelModel->get_batch_wise_student(array('student_record.batch_id'=>$batch_id,'hostel_student_record.hostel_status_id'=>1,'student_record.s_status_id'=>5));
     
        
        if($result):
             echo '<div class="table-responsive">';
            echo '<h3 class="has-divider text-highlight">Result :'.count($result).'</h3>
                <table class="table table-hover" id="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Form#</th>
                        <th>College#</th>
                        <th>Name</th>
                        <th>Sub Program</th>
                        <th>Group</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>';
            $sn = '';
            foreach($result as $row):
           $sn++;
            
            echo    '<tr>
                        <td>'.$sn.'</td>
                        <td>'.$row->form_no.'</td>
                        <td>'.$row->college_no.'</td>
                        <td>'.$row->student_name.'</td>
                        <td>'.$row->sub_program.'</td>
                        <td>'.$row->Group.'</td>
                        <td>'.$row->student_status.'</td>
                    </tr>';
            
            endforeach;
            
     
           
            echo '</tbody>
                </table>';
            
            echo '</div>';
        endif;
        
 }
      public function hoste_mess_change_date(){
         $this->data['challandId'] = '';
         
         
        if($this->input->post('payment_challan_search')):
            $challandId = $this->input->post('challan_no');
            
            $this->data['challandId'] = $challandId;
                                          $this->db->join('hostel_student_record','hostel_student_record.hostel_id=hostel_student_bill.hostel_std_id');
            $challan_details            = $this->db->get_where('hostel_student_bill',array('id'=>$challandId,'challan_status'=>2))->row();
           
            
            $this->data['challan_paid_date'] = $challan_details->payment_date;
            $this->data['studentInfo']  = $this->HostelModel->fee_challan_student(array('student_record.s_status_id' => 5,'student_record.student_id'=>$challan_details->student_id));
       
            $this->data['result']       = $this->HostelModel->get_Student_feeDetails_search(array('hostel_student_bill_info.hostel_bill_id'=>$challandId));
//             echo '<pre>';print_r($this->data['result']);die;
        endif;
        
        if($this->input->post('change_date')):
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            $challandId         = $this->input->post('challan_no');
            $challan_new_paid   = date('Y-m-d',strtotime($this->input->post('challan_new_paid')));
            $challan_old_paid   = $this->input->post('challan_old_paid');
            $comment            = $this->input->post('change_date_challan_comment');
            
            
            
            if($challan_new_paid != $challan_old_paid):
            $date_change = array(
               'challan_id' =>$challandId,
               'comment'    =>$comment,
               'old_date'    =>$challan_old_paid,
               'new_date'    =>$challan_new_paid,
               'timestamp'     =>date('Y-m-d H:i:s'),
               'userId'       => $userInfo->user_id,
                
            );
            $this->CRUDModel->insert('hostel_mess_date_change',$date_change);
            
            $this->CRUDModel->update('hostel_student_bill',array('payment_date'=>date('Y-m-d',strtotime($challan_new_paid))),array('id'=>$challandId));
           
            endif;
           
            
        endif;
         
        $this->data['page']         = 'hostel/challan_date_change';
        $this->data['page_header']  = 'Hostel/Mess Challan Change Date';
        $this->data['page_title']   = 'Hostel/Mess Challan Change Date | ECMS';
        $this->load->view('common/common',$this->data);
 
         
    }
    public function get_installment_type(){
        $batch_id       = $this->input->post('batch_id');
        
                            
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=hostel_heads.cat_title_id');  
                $this->db->group_by('fee_category_titles.cat_title_id');    
    $result =   $this->db->get_where('hostel_heads',array('batch_id'=>$batch_id))->result();
            echo '<option>Select Batch</option>';
        foreach($result as $row):
           
            if($row->fromDate === '0000-00-00' || $row->fromDate==='01-01-1970'):
                 echo '<option value="'.$row->cat_title_id.'">'.$row->title.'</option>';
                else:
                echo '<option value="'.$row->cat_title_id.'">'.$row->title.' ('.date('d-m-Y',strtotime($row->fromDate)).')/ ('.date('d-m-Y',strtotime($row->toDate)).')</option>'; 
            endif;
        endforeach;
 }
  public function hostel_ledger_report(){
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', 'Hostel Status', 'hostel_status_id', 'status_name');
        $this->data['hoste_p_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_head_type'] = $this->CRUDModel->dropDown('hostel_head_type', '', 'id', 'title');
        $this->data['installment_type'] = $this->CRUDModel->dropDown('fee_category_titles', 'Installment Type', 'cat_title_id', 'title');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
        
        $this->data['collegeNo']    = '';
        $this->data['int_type_id']  = '';
        $this->data['batch_id']     = '';
        $this->data['challan_status_id']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['hoste_p_status_id']   = '';
        $this->data['hotel_type_id']   = 1;
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = date('d-m-Y');
        $this->data['to']           = date('d-m-Y');
        
        
           if($this->input->post()):
             $collegeNo      = $this->input->post("collegeNo");
             $challan_no    = $this->input->post("challan_no");
             $form_no       = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $from               = $this->input->post("from");
            $to                 = $this->input->post("to");
            $hostel_head_type   = $this->input->post("hostel_head_type");
            $challan_status1    = $this->input->post("challan_status");
            $hostel_status      = $this->input->post("hostel_status");
            $hoste_p_status     = $this->input->post("hoste_p_status");
            $installment_type   = $this->input->post("installment_type");
            $batch              = $this->input->post("batch");
           
 
            $this->data['from'] = $from;
            $this->data['to']   = $to;
//            $where['hostel_student_record.hostel_status_id'] = 1;
            $where = '';
//            $where['hostel_student_record.student_id'] = 340;
            
            $like = '';
           
            if($batch):
                $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if($installment_type):
                $where['hostel_student_bill.cat_title_id'] = $installment_type;
                $this->data['int_type_id'] = $installment_type;
            endif;
            if($hoste_p_status):
                $type['hostel_student_bill.challan_status'] = $hoste_p_status;
                $this->data['hoste_p_status_id'] = $hoste_p_status;
            endif;
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_status_id'] = $hostel_status;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status1):
                $type['hostel_student_bill.challan_status'] = $challan_status1;
                $this->data['challan_status_id'] = $challan_status1;
            endif;
            if($hostel_head_type):
                $type['hostel_student_bill.head_type'] = $hostel_head_type;
                $this->data['hotel_type_id'] = $hostel_head_type;
            endif;
            if($challan_no):
                $type['hostel_student_bill.id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
           
//            if($challan_status):
//                $this->data['where'] = array('fee_challan_status.ch_status_id' => $challan_status);
//                $where['fee_challan.fc_ch_status_id'] = $challan_status;
//                $this->data['status_id'] = $challan_status;
//            endif;
         
            
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
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
          
                if($this->input->post('search')):
                    $this->data['result']       = $this->HostelModel->hostel_ledger($where,$like,$type);
                    $this->data['report_type']  = 'hostel_std_search';
                endif;
            endif;
        
        
        
        $this->data['page_title']   = 'Hostel Ledger Report | ECMS';
        $this->data['page_header']  = 'Hostel Ledger Report';
        $this->data['page']         = 'hostel/report/hostel_ledger_report';
        $this->load->view('common/common',$this->data);    
        
    }
  public function audit_hostel_ledger_report(){
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', 'Hostel Status', 'hostel_status_id', 'status_name');
        $this->data['hoste_p_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_head_type'] = $this->CRUDModel->dropDown('hostel_head_type', '', 'id', 'title');
        $this->data['installment_type'] = $this->CRUDModel->dropDown('fee_category_titles', 'Installment Type', 'cat_title_id', 'title');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
        
        $this->data['collegeNo']    = '';
        $this->data['int_type_id']  = '';
        $this->data['batch_id']     = '';
        $this->data['challan_status_id']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['hoste_p_status_id']   = '';
        $this->data['hotel_type_id']   = 1;
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = date('d-m-Y');
        $this->data['to']           = date('d-m-Y');
        
        
           if($this->input->post()):
             $collegeNo      = $this->input->post("collegeNo");
             $challan_no    = $this->input->post("challan_no");
             $form_no       = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $from               = $this->input->post("from");
            $to                 = $this->input->post("to");
            $hostel_head_type   = $this->input->post("hostel_head_type");
            $challan_status1    = $this->input->post("challan_status");
            $hostel_status      = $this->input->post("hostel_status");
            $hoste_p_status     = $this->input->post("hoste_p_status");
            $installment_type   = $this->input->post("installment_type");
            $batch              = $this->input->post("batch");
           
 
            $this->data['from'] = $from;
            $this->data['to']   = $to;
//            $where['hostel_student_record.hostel_status_id'] = 1;
            $where = '';
//            $where['hostel_student_record.student_id'] = 340;
            
            $like = '';
           
            if($batch):
                $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if($installment_type):
                $where['hostel_student_bill.cat_title_id'] = $installment_type;
                $this->data['int_type_id'] = $installment_type;
            endif;
            if($hoste_p_status):
                $type['hostel_student_bill.challan_status'] = $hoste_p_status;
                $this->data['hoste_p_status_id'] = $hoste_p_status;
            endif;
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_status_id'] = $hostel_status;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status1):
                $type['hostel_student_bill.challan_status'] = $challan_status1;
                $this->data['challan_status_id'] = $challan_status1;
            endif;
            if($hostel_head_type):
                $type['hostel_student_bill.head_type'] = $hostel_head_type;
                $this->data['hotel_type_id'] = $hostel_head_type;
            endif;
            if($challan_no):
                $type['hostel_student_bill.id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
           
//            if($challan_status):
//                $this->data['where'] = array('fee_challan_status.ch_status_id' => $challan_status);
//                $where['fee_challan.fc_ch_status_id'] = $challan_status;
//                $this->data['status_id'] = $challan_status;
//            endif;
         
            
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
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
          
                if($this->input->post('search')):
                    $this->data['result']       = $this->HostelModel->hostel_ledger($where,$like,$type);
                    $this->data['report_type']  = 'hostel_std_search';
                endif;
            endif;
        
        
        
        $this->data['page_title']   = 'Hostel Ledger Report | ECMS';
        $this->data['page_header']  = 'Hostel Ledger Report';
        $this->data['page']         = 'hostel/report/hostel_ledger_report';
        $this->load->view('common/common',$this->data);    
        
    }
    
    public function hostel_heads_check(){
        
         $payment_id    = $this->input->post("payment_id");
         $type          = $this->input->post("type");
         $batch_id      = $this->input->post("batch_id");
         
         $where = array(
            'cat_title_id'  => $payment_id,
            'head_type'     => $type,
            'batch_id'      => $batch_id,
         );
        
         $result = $this->db->get_where('hostel_heads',$where)->row();
         if(empty($result)):
             echo '0';
             else:
             echo '1';
         endif;
    }
    public function hm_extra_amount_adjust(){
        
        $this->data['challan_no']       = '';
        $this->data['hostel_id']       = '';
        
        if($this->input->post('search')):
             
            $challan_id                     = $this->input->post('challan_no');
           $where = array(
                'hostel_student_bill.id'                => $challan_id,  
                'hostel_student_bill.challan_status'  => 2,  
              );
            $this->data['studentInfo']      = $this->HostelModel->hostel_student_info($where);  
            
            $this->data['challan_no'] =$challan_id;
            $this->data['hostel_id'] = @$this->data['studentInfo']->hostel_std_id;
            
            $this->data['per_day']          = $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
            $this->data['result']           = $this->HostelModel->hoste_student_fee_info(array('hostel_bill_id'=>$challan_id));
            $this->data['balance_type']     = $this->CRUDModel->dropDown('fee_balance_type', '', 'id', 'type');   
             
        endif;
        if($this->input->post('add')):
             
             $challan_id                     = $this->input->post('challan_no');
             
            
            
            $challan_no         = $this->input->post('challan_id');
            $hostel_id          = $this->input->post('hostel_id');
            $fee_head_id        = $this->input->post('fee_head_id');
            $fee_head_amount    = $this->input->post('amount');
            $pre_challan        = $this->input->post('pre_challan');
            $batch_id           = $this->input->post('batch_id');
            $fee_head_name      = $this->input->post('fee_head_name');
            $balance_type       = $this->input->post('balance_type');
            $comments           = $this->input->post('comments');
            $total_days         = $this->input->post('total_days');
            $per_day            = $this->input->post('per_day');
            $hostel_challan_type= $this->input->post('hostel_challan_type');
            $challan_status     = $this->input->post('challan_status');
            $userInfo           = $this->getUser();
        
            
            $data = array(
                'title'         => $fee_head_name,  
                'amount'        => $fee_head_amount,
                'head_title_id' => $fee_head_id,
                'timestamp'     => date('Y-m-d H:i:s'),
                'user_id'       => $userInfo['user_id'],
               
           );
            $hostel_bill_id = $this->CRUDModel->insert('hostel_heads',$data);
            
            
            
                if($hostel_challan_type == 1):  //Hostel Challan
                     
                $data_challan = array(
                    'hostel_bill_id'     => $challan_no,  
                    'hostel_head_id'     => $hostel_bill_id,  
                     'amount'            => $fee_head_amount,
                     'paid_amount'       => $fee_head_amount,
                     'comments'          => $comments,
                     'timestamp'         => date('Y-m-d H:i:s'),
                     'user_id'           => $userInfo['user_id'],
                     'old_challan_id'    => $balance_type,
                     'adjust_flag'      => 1,
                );
                
                else: //Mess Challan
                    
                     $data_challan = array(
                    'hostel_bill_id'    => $challan_no,  
                    'hostel_head_id'    => $hostel_bill_id,  
                     'amount'           => $fee_head_amount,
                     'paid_amount'      => $fee_head_amount,
                     'comments'         => $comments,
                     'total_days'       => $total_days,
                     'adjust_flag'      => 1,
                     'per_day'         => $per_day,
                     
                     'timestamp'        => date('Y-m-d H:i:s'),
                     'user_id'          => $userInfo['user_id'],
                     'old_challan_id'   => $balance_type,
                );   
                
            endif;
            
           $this->CRUDModel->insert('hostel_student_bill_info',$data_challan);
           
           $where = array(
                'hostel_student_bill.id'                => $challan_id,  
                'hostel_student_bill.hostel_status_id'  => 1,  
              );
            $this->data['studentInfo']      = $this->HostelModel->hostel_student_info($where);  
            
            $this->data['challan_no']   =   $challan_id;
            $this->data['hostel_id']    =   @$this->data['studentInfo']->hostel_std_id;
            
            $this->data['per_day']          = $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
            $this->data['result']           = $this->HostelModel->hoste_student_fee_info(array('hostel_bill_id'=>$challan_id));
            $this->data['balance_type']     = $this->CRUDModel->dropDown('fee_balance_type', '', 'id', 'type');
           
           
           
           
        endif;
        
        
       
        
       $this->data['page_title']   = 'Hostel & Mess Adjust Amount| ECMS';
        $this->data['page_header']  = 'Hostel & Mess Adjust Amount';
        $this->data['page']         = 'hostel/hostel_mess_adjust_amount';
        $this->load->view('common/common',$this->data); 
    }
    
        public function show_hostel_mess_result_js(){
         $challan_id = $this->input->post('challan_number');
         $hostel_id = $this->input->post('challan_number');
          
        $result           = $this->HostelModel->hoste_student_fee_info(array('hostel_bill_id'=>$challan_id));
        
        if($result):
            echo '  
                                <table class="table table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th></th>
                                            <th>Balance</th>
                                            <th>Comments</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                <tbody>';
            
                            $sn             = "";
                            $total_amount   = '';
                            foreach($result as $row):
                                   $sn++;
                                $status = '';
                                if(!empty($row->old_challan_id)):
                                    $status = 'Arrears';
                                else:
                                     $status = 'Current Bill';
                                endif;
                          echo '<tr id="'.$row->info_pk.'">
                                  <td>'.$sn.'</td>
                                  <td>'.$row->title.'</td>
                                  <td>'.$status.'</td>
                                  <td>'.$row->amount.'</td>
                                  <td>'.$row->comments.'</td>';
                                  if($row->adjust_flag ==1):
                                      echo '<td><button class="btn btn-danger btn-xs delteAjust" id="'.$row->info_pk.'" >Delete</a></td>';
                                       '<td><a href="deleteHostelHeadAdjust/'.$hostel_id.'/'.$challan_id.'/'.$row->info_pk.'" class="btn btn-danger btn-xs">Delete</a></td>';

                                      else:
                                     echo '<td></td>'; 
                                  endif;


                                   echo '</tr>';

                          $total_amount +=$row->amount;
                            endforeach;      


                    echo '<tr>
                           <td> </td>
                           <td> </td>

                           <td>Total</td>

                           <td>'.$total_amount.'</td>

                           <td> </td>
                           <td> </td>

                          </tr></tbody> </table>';

                      endif;
                      ?>
                    <script>
                            jQuery('.delteAjust').on('click',function(){
      
                            var delteAjust = this.id;
                           
                              jQuery.ajax({
                               type   :'post',
                               url    :'deleteHostelMessResut',
                               data   :{'delteAjust':delteAjust},
                               success:function(result){
                                    jQuery.ajax({
                                      type   :'post',
                                      url    :'showHostelMessResut',
                                      data   :{'challan_number':jQuery('#challan_number').val(),'hostel_id':jQuery('#hostel_id').val()},
                                      success:function(result){
                                         jQuery('#show_hostel_mess_details').html(result);
                                      }

                           });
                               }

                           });


                        });  
                    </script>   
                        <?php
    }
    
    public function delete_hostel_mess_result_js(){
        
        $delteAjust = $this->input->post('delteAjust');
        
        $this->CRUDModel->deleteid('hostel_student_bill_info',array('id'=>$delteAjust));
    }
    
            public function bank_reconciliation_report_lock_hostel(){
       
        
        $this->data['from'] = date('d-m-Y');
        $this->data['to'] = date('d-m-Y');
        
         if($this->input->post('Search')):
            $this->data['from']             = $this->input->post('from');
            $this->data['to']               = $this->input->post('to');
            $this->data['search_result']    = $this->HostelModel->get_lock_dates($this->data['from'],$this->data['to']);
             
         endif;
     
        
        if($this->input->post('lock')):
        
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            
            $all_dates =    $this->CRUDModel->getDatesFromRange($from,$to);
            $already_exist_date = '';
            foreach($all_dates as $key=>$value):
                
                $data = array(
                  'lock_date'   => $value,  
                  'status'      => 1,  
                  'create_by'   => $this->userInfo->user_id,  
                  'create_date' => date('Y-m-d H:i:s'),  
                );
            
            $check_date = $this->CRUDModel->get_where_row('hostel_brr_lock',array('lock_date'=> $value));
            
            if(!empty($check_date)):
                $already_exist_date[] = array(
                    'date'=>$value
                );
                else:
                $this->CRUDModel->insert('hostel_brr_lock',$data);
            endif;
            
            endforeach;
            
             $this->data['already_exist_date'] = json_decode(json_encode($already_exist_date), FALSE);
        endif;
        
        $this->data['page']         = 'hostel/Forms/BRR_lock_hostel_v';
        $this->data['page_header']  = 'Hosetl & Mess (BRS) Lock ';
        $this->data['page_title']   = 'Hosetl & Mess (BRS) Lock | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    public function bank_reconciliation_report_lock_edit_hostel(){
       
        
        $this->data['from'] = date('d-m-Y');
        $this->data['to'] = date('d-m-Y');
        
        $this->data['update_result']    = $this->CRUDModel->get_where_row('hostel_brr_lock',array('hostel_brr_lock.id'=>$this->uri->segment(2)));
                                           
                                            $this->db->join('users','users.id=hostel_brr_lock_log.create_by');
                                            $this->db->order_by('hostel_brr_lock_log.id','desc');
        $this->data['update_results']    =  $this->db->get_where('hostel_brr_lock_log',array('hostel_brr_lock_log.date_id'=>$this->uri->segment(2)))->result();
        
        if($this->input->post('update')):
            
            $id           = $this->input->post('id');
            $date         = $this->input->post('date');
            $status       = $this->input->post('status');
            $comments     = $this->input->post('comments');
            
            $SETU = array(
                'lock_date'     => date('Y-m-d',strtotime($date)),
                'status'        => $status,
                'comments'      => $comments,
                'update_by'     => $this->userInfo->user_id,  
                'update_date'   => date('Y-m-d H:i:s'),  
            );
            $WHEREU = array(
                'id'=>$id
            );
             $this->CRUDModel->update('hostel_brr_lock',$SETU,$WHEREU);
             
             
            $DATA = array(
                'date_id'       => $id,
                'lock_date'     => date('Y-m-d',strtotime($date)),
                'status'        => $status,
                'comments'      => $comments,
                'create_by'     => $this->userInfo->user_id,  
                'create_date'   => date('Y-m-d H:i:s'),  
            );
            
             $this->CRUDModel->insert('hostel_brr_lock_log',$DATA);
             
            redirect('BRRLockHostel'); 
         endif;
      
      
         
         $this->data['page']         = 'hostel/Forms/BRR_lock_edit_hostel_v';
        $this->data['page_header']  = 'Hostel & Mess (BRS) Lock';
        $this->data['page_title']   = 'Hostel & Mess (BRS) | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    public function hostel_new_record(){
        $student_id                     =   $this->uri->segment(2);
        $this->data['result']           = $this->HostelModel->hostel_new_record(array('student_record.student_id'=>$student_id));
        $this->data['hostel_batch']     =   $this->CRUDModel->dropDown('hostel_batch', ' Hostel Session ', 'h_batch_id', 'h_batch_name');  
        $this->data['relation']         =   $this->CRUDModel->dropDown('relation', ' Relection', 'relation_id', 'title');  
//        echo '<pre>';print_r($this->data['result']);die;
        
        
        if($this->input->post()):
            $student_id         = $this->input->post('student_id');
            $city               = $this->input->post('city');
            $hostel_mobile_no1  = $this->input->post('hostel_mobile_no1');
            $hostel_mobile_no2  = $this->input->post('hostel_mobile_no2');
            $hostelGuardian     = $this->input->post('hostelGuardian');
            $relation           = $this->input->post('relation');
            $cnic               = $this->input->post('cnic');
            
 
                $data  = array(
                    'student_id'                => $student_id,
                    'student_mobile_no'         => $hostel_mobile_no1,
                    'student_mobile_no2'        => $hostel_mobile_no2,
                    'city'                      => $city,
                    'new_admission_flag'        => 1,
                    'guardian_of_hostel'        => $hostelGuardian,
                    'guardian_hostel_relation'  => $relation,
                    'guardian_hostel_cnic'      => $cnic,
                    'user_id'                   => $this->userInfo->user_id,
                );        
                $this->CRUDModel->insert('hostel_student_record',$data);
//                redirect('NewAdmissonInterSearch');
            redirect('NewAdmissionAcademic/'.$student_id);

            endif;
            
            
            $this->data['page_title']   = 'New Hostel Student | ECMS';
            $this->data['page_header']  = 'New Hostel Student';
            $this->data['page'] = 'hostel/Forms/new_hostel_record_v';
            $this->load->view('common/common',$this->data);
	}
        
        public function hostel_new_record_admin(){
        $student_id                     =   $this->uri->segment(2);
        $this->data['result']           = $this->HostelModel->hostel_new_record(array('student_record.student_id'=>$student_id));
        $this->data['hostel_batch']     =   $this->CRUDModel->dropDown('hostel_batch', ' Hostel Session ', 'h_batch_id', 'h_batch_name');  
        $this->data['relation']         =   $this->CRUDModel->dropDown('relation', ' Relection', 'relation_id', 'title');  
//        echo '<pre>';print_r($this->data['result']);die;
        
        
        if($this->input->post()):
            $student_id         = $this->input->post('student_id');
            $city               = $this->input->post('city');
            $hostel_mobile_no1  = $this->input->post('hostel_mobile_no1');
            $hostel_mobile_no2  = $this->input->post('hostel_mobile_no2');
            $hostelGuardian     = $this->input->post('hostelGuardian');
            $relation           = $this->input->post('relation');
            $cnic               = $this->input->post('cnic');
            
 
                $data  = array(
                    'student_id'                => $student_id,
                    'student_mobile_no'         => $hostel_mobile_no1,
                    'student_mobile_no2'        => $hostel_mobile_no2,
                    'city'                      => $city,
                    'new_admission_flag'        => 1,
                    'guardian_of_hostel'        => $hostelGuardian,
                    'guardian_hostel_relation'  => $relation,
                    'guardian_hostel_cnic'      => $cnic,
                    'user_id'                   => $this->userInfo->user_id,
                );        
                $this->CRUDModel->insert('hostel_student_record',$data);
//                redirect('NewAdmissonInterSearch');
            redirect('admin/admin_student_academic_record/'.$student_id);

            endif;
            
            
            $this->data['page_title']   = 'New Hostel Student | ECMS';
            $this->data['page_header']  = 'New Hostel Student';
            $this->data['page'] = 'hostel/Forms/new_hostel_record_admin_v';
            $this->load->view('common/common',$this->data);
	}
        
    public function hostel_new_record_admin_update(){
        $student_id                     =   $this->uri->segment(2);
        $this->data['result']           = $this->HostelModel->hostel_new_record(array('student_record.student_id'=>$student_id));
        $this->data['hostel_batch']     =   $this->CRUDModel->dropDown('hostel_batch', ' Hostel Session ', 'h_batch_id', 'h_batch_name');  
        $this->data['relation']         =   $this->CRUDModel->dropDown('relation', ' Relection', 'relation_id', 'title');  
//        echo '<pre>';print_r($this->data['result']);die;
        
        $program_id = $this->db->get_where('student_record', array('student_id'=>$student_id))->row()->programe_id;
        
        if($this->input->post()):
            $student_id         = $this->input->post('student_id');
            $city               = $this->input->post('city');
            $hostel_mobile_no1  = $this->input->post('hostel_mobile_no1');
            $hostel_mobile_no2  = $this->input->post('hostel_mobile_no2');
            $hostelGuardian     = $this->input->post('hostelGuardian');
            $relation           = $this->input->post('relation');
            $cnic               = $this->input->post('cnic');
            
 
                $data  = array(
                    'student_id'                => $student_id,
                    'student_mobile_no'         => $hostel_mobile_no1,
                    'student_mobile_no2'        => $hostel_mobile_no2,
                    'city'                      => $city,
                    'new_admission_flag'        => 1,
                    'guardian_of_hostel'        => $hostelGuardian,
                    'guardian_hostel_relation'  => $relation,
                    'guardian_hostel_cnic'      => $cnic,
                    'user_id'                   => $this->userInfo->user_id,
                );        
                $this->CRUDModel->insert('hostel_student_record',$data);
//                redirect('NewAdmissonInterSearch');
            redirect('admin/admin_update_student/'.$student_id.'/'.$program_id);

            endif;
            
            
            $this->data['page_title']   = 'New Hostel Student | ECMS';
            $this->data['page_header']  = 'New Hostel Student';
            $this->data['page'] = 'hostel/Forms/new_hostel_record_admin_v';
            $this->load->view('common/common',$this->data);
	}
        
     public function print_hostel_student_report(){
        $this->data['status']           = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status ', 'hostel_status_id', 'status_name');    
        $this->data['statuss']          = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name');    
        $this->data['shift']            = $this->CRUDModel->dropDown('shift', ' Shift ', 'shift_id', 'name');    
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name');
        $this->data['hostel_batch']     = $this->CRUDModel->dropDown('hostel_batch', ' Hostel Session ', 'h_batch_id', 'h_batch_name'); 
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['batch_name']       = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name');
        $this->data['admission_in']     = $this->CRUDModel->dropDown('reserved_seat', 'Admission In', 'rseat_id', 'name');
        
        
        $where                          = "";
        $this->data['student_id']       = ""; 
        $this->data['shift_id']         = ""; 
        $this->data['hostel_status_id'] = ""; 
        $this->data['s_status_id']      = ""; 
        $this->data['programe_id']      = ""; 
        $this->data['sub_pro_id']       = ""; 
        $this->data['batch_id']         = ""; 
        $this->data['h_batch_id']       = ""; 
        $this->data['room_id']          = ""; 
        $this->data['college_no']       = "";
        $this->data['admission_in_id']  = "";
        
        
        if($this->input->post('search')): 
            $shift_id           = $this->input->post('shift_id');
            $student_id         = $this->input->post('student_id');
            $room_id            = $this->input->post('room_id');
            $hostel_status_id   = $this->input->post('hostel_status_id');
            $s_status_id        = $this->input->post('s_status_id');
            $programe_id        = $this->input->post('programe_id');
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $batch_id           = $this->input->post('batch_id');
            $h_batch_id         = $this->input->post('h_batch_id');
            $college_no         = $this->input->post('college_no');
            $admission_in      = $this->input->post('admission_in');
        
            $where['hostel_status.hostel_status_id']    = '1'; 
            $where['student_status.s_status_id']        = '5'; 
            
        if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
        endif;
        if(!empty($programe_id)):
            $where['student_record.programe_id'] = $programe_id;
            $this->data['programe_id'] =$programe_id;
        endif;
        if(!empty($sub_pro_id)):
            $where['student_record.sub_pro_id'] = $sub_pro_id;
            $this->data['sub_pro_id'] =$sub_pro_id;
        endif;
        if(!empty($batch_id)):
            $where['student_record.batch_id'] = $batch_id;
            $this->data['batch_id'] =$batch_id;
        endif;

        if(!empty($room_id)):
            $where['hostel_rooms.room_id'] = $room_id;
            $this->data['room_id'] =$room_id;
        endif;
        if(!empty($college_no)):
            $where['college_no'] = $college_no;
            $this->data['college_no'] =$college_no;
        endif;
        if(!empty($admission_in)):
            $where['reserved_seat.rseat_id'] = $admission_in;
            $this->data['admission_in_id']   = $admission_in;
        endif;
        
            $this->data['result'] = $this->HostelModel->HostelDataSearch('hostel_student_record',$where);
      //  else:
//        $this->data['result'] = $this->HostelModel->get_HostelData('hostel_student_record');
        endif;
        $this->data['page_title']  = 'Hostel Students Record| ECMS';
        $this->data['page']        =  'hostel/report/print_hostel_student_report';
        $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Hostel Students Record');
               
                $this->excel->getActiveSheet()->setCellValue('A1', 'College #');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('C1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1', 'Mobile #');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('F1', 'Batch');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1', 'Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('H1', 'Allotted Date');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('I1', 'Block');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('J1', 'Room');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('K1', 'O.Marks');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('L1', 'T.Marks');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('M1', 'Shift');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('N1', 'Admission In');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('O1', 'Approved By');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
        
        
            for($col = ord('A'); $col <= ord('O'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        $this->data['student_id']       = ""; 
        $this->data['shift_id']       = ""; 
        $this->data['hostel_status_id'] = ""; 
        $this->data['s_status_id'] = ""; 
        $this->data['programe_id']      = ""; 
        $this->data['sub_pro_id']       = ""; 
        $this->data['batch_id']         = ""; 
        $this->data['h_batch_id']       = ""; 
        $this->data['room_id']          = ""; 
        $this->data['college_no']       = "";
        $this->data['admission_in_id']  = "";
        
            $admission_in      = $this->input->post('admission_in');
            $shift_id           = $this->input->post('shift_id');
            $student_id         = $this->input->post('student_id');
            $room_id            = $this->input->post('room_id');
            $hostel_status_id   = $this->input->post('hostel_status_id');
            $s_status_id        = $this->input->post('s_status_id');
            $programe_id        = $this->input->post('programe_id');
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $batch_id           = $this->input->post('batch_id');
            $h_batch_id         = $this->input->post('h_batch_id');
            $college_no         = $this->input->post('college_no');
           $where['hostel_status.hostel_status_id']    = '1'; 
            $where['student_status.s_status_id']        = '5'; 
            
        if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
        endif;
        if(!empty($programe_id)):
            $where['student_record.programe_id'] = $programe_id;
            $this->data['programe_id'] =$programe_id;
        endif;
        if(!empty($sub_pro_id)):
            $where['student_record.sub_pro_id'] = $sub_pro_id;
            $this->data['sub_pro_id'] =$sub_pro_id;
        endif;
        if(!empty($batch_id)):
            $where['student_record.batch_id'] = $batch_id;
            $this->data['batch_id'] =$batch_id;
        endif;

        if(!empty($room_id)):
            $where['hostel_rooms.room_id'] = $room_id;
            $this->data['room_id'] =$room_id;
        endif;
        if(!empty($college_no)):
            $where['college_no'] = $college_no;
            $this->data['college_no'] =$college_no;
        endif;
        if(!empty($admission_in)):
            $where['reserved_seat.rseat_id'] = $admission_in;
            $this->data['admission_in_id']   = $admission_in;
        endif;
            $result = $this->HostelModel->HostelData_excel('hostel_student_record',$where);
                $exceldata="";
                foreach ($result as $row)
                {
                $exceldata[] = $row;
                }      
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Hostel_Students_List.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
    }
    
    public function hostel_room_allotment(){
        $this->data['status']           = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status ', 'hostel_status_id', 'status_name');    
        $this->data['statuss']           = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name');    
        $this->data['shift']           = $this->CRUDModel->dropDown('shift', ' Shift ', 'shift_id', 'name');    
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name');
        $this->data['hostel_batch']     = $this->CRUDModel->dropDown('hostel_batch', ' Hostel Session ', 'h_batch_id', 'h_batch_name'); 
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['batch_name']       = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name');
        
        $where = "";
        
        $this->data['student_id']       = ""; 
        $this->data['shift_id']         = ""; 
        $this->data['hostel_status_id'] = ""; 
        $this->data['s_status_id']      = ""; 
        $this->data['programe_id']      = ""; 
        $this->data['sub_pro_id']       = ""; 
        $this->data['batch_id']         = ""; 
        $this->data['h_batch_id']       = ""; 
        $this->data['room_id']          = ""; 
        
        $this->data['college_no']       = "";
        $this->data['college_noSearch'] = "";
        $this->data['form_no']          = "";
        $this->data['student_name']     = "";
        $this->data['father_name']      = "";
        
         $this->data['father_name_search'] = "";
        $this->data['student_name_search']= "";
        
        if($this->input->post('addRoomSearch')):
            
            $college_no   =  $this->input->post('college_no');
            $form_no      =  $this->input->post('form_no');
            $student_name =  $this->input->post('student_name');
            $father_name  =  $this->input->post('father_name');
            
            $like       = '';
            $where['challan_status']       = '2';
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
           $this->data['student'] = $this->HostelModel->NewRegisterStudentRecord('student_record',$where,$like);
        endif;
           if($this->input->post('SearchResult')):
             $shift_id         = $this->input->post('shift_id');
            $student_id         = $this->input->post('student_id');
            $room_id            = $this->input->post('room_id');
            $hostel_status_id   = $this->input->post('hostel_status_id');
            $s_status_id        = $this->input->post('s_status_id');
            $programe_id        = $this->input->post('programe_id');
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $batch_id           = $this->input->post('batch_id');
            $h_batch_id         = $this->input->post('h_batch_id');
            $college_no         = $this->input->post('college_noSearch');
            $student_name       =  $this->input->post('student_name_search');
            $father_name        =  $this->input->post('father_name_search');
        
            $where['hostel_status.hostel_status_id']    = '1'; 
            $where['student_status.s_status_id']        = '5'; 
            
        if(!empty($student_name)):
            $where['student_record.student_name']   = $student_name;
            $this->data['student_name_search']      = $student_name;
        endif;
        if(!empty($father_name)):
            $where['student_record.father_name']    = $father_name;
            $this->data['father_name_search']       = $father_name;
        endif;
        if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
        endif;
 
        if(!empty($programe_id)):
            $where['student_record.programe_id'] = $programe_id;
            $this->data['programe_id'] =$programe_id;
        endif;
        if(!empty($sub_pro_id)):
            $where['student_record.sub_pro_id'] = $sub_pro_id;
            $this->data['sub_pro_id'] =$sub_pro_id;
        endif;
        if(!empty($batch_id)):
            $where['student_record.batch_id'] = $batch_id;
            $this->data['batch_id'] =$batch_id;
        endif;
//        if(!empty($h_batch_id)):
//            $where['hostel_batch.h_batch_id'] = $h_batch_id;
//            $this->data['h_batch_id'] =$h_batch_id;
//        endif;
        if(!empty($room_id)):
            $where['hostel_rooms.room_id'] = $room_id;
            $this->data['room_id'] =$room_id;
        endif;
        if(!empty($college_no)):
            $where['college_no'] = $college_no;
            $this->data['college_noSearch'] =$college_no;
        endif;
            $this->data['result'] = $this->HostelModel->HostelDataSearch('hostel_student_record',$where);
//            echo '<pre>';print_r( $this->data);die;
        endif;
            
        $this->data['page_title']  = 'Hostel Room Allotment| ECMS';
        $this->data['page_header']  = 'Hostel Room Allotment';
        $this->data['page']        =  'hostel/Forms/hostel_room_allotment_v';
        $this->load->view('common/common',$this->data);
        
        
    } 
        public function get_block_rooms_js(){
        
        $BbId = $this->input->post('BbId');
                        $this->db->order_by('rm_bbId','asc');
            $result =   $this->db->get_where('invt_rooms',array('rm_bbId'=>$BbId))->result();
            
            foreach($result as $row):
                    echo '<option value="'.$row->rm_id.'">'.$row->rm_name.' ('.$row->rm_shortname.')</option>';
                endforeach;
    }
        public function add_student_hostel_js(){
        
        $RId                = $this->input->post('RId');
        $student_mobile_no  = $this->input->post('student_mobile_no');
        $allotted_date      = $this->input->post('allotted_date');
        $hostel_batch       = $this->input->post('hostel_batch');
        $student_id         = $this->input->post('student_id');
        
        $total_room_seats   =   $this->db->get_where('invt_rooms',array('rm_id'=>$RId))->row();       
                                $this->db->select('count(*) as totalRooms');
        $reserved_room_seats =  $this->db->get_where('hostel_student_record',array('room_id'=>$RId))->row(); 
        $return_array = '';
        $seats              = $total_room_seats->rm_total_seats-$reserved_room_seats->totalRooms;
         
        if($seats ==0):
            
            $return_array['message'] = "<div class='alert alert-danger alert-dismissable'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>This room already full</strong></div>";
            $return_array['return'] =false;
            else:
                $studentInfo = $this->CRUDModel->get_where_row('hostel_student_record',array('student_id'=> $student_id));
                 $inserDataLog = array(
                  'student_id'          => $studentInfo->student_id,   
                  'hostel_id'           => $studentInfo->hostel_id,   
                  'room_id'             => $studentInfo->room_id,
                  'hostel_batch_id'     => $studentInfo->hostel_batch_id,
                  'student_mobile_no'   => $studentInfo->student_mobile_no,
                  'allotted_date'       => date('Y-m-d',strtotime($studentInfo->allotted_date)),
                  'update_datetime'     => date('Y-m-d H:i:s'),
                  'updated_user_id'     => $this->userInfo->user_id,   
              );
                
                
               $this->CRUDModel->insert('hostel_student_record_log',$inserDataLog); 
                
              $inserData = array(
                  'room_id'             => $RId,
                  'hostel_batch_id'     => $hostel_batch,
                  'student_mobile_no'   => $student_mobile_no,
                  'allotted_date'       => date('Y-m-d',strtotime($allotted_date)),
                  'update_datetime'     => date('Y-m-d H:i:s'),
                  'updated_user_id'     => $this->userInfo->user_id,
              ); 
                $SET = array(
                  'student_id'          => $student_id,  
                );
             $this->CRUDModel->Update('hostel_student_record',$inserData,$SET); 
            $return_array['message'] = "<div class='alert alert-success alert-dismissable'>
                                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                           <strong>Record Update successfully....</strong></div>";
           $return_array['return'] =true;
        endif;
    echo  json_encode($return_array);
    }
     public function hoste_challan_details_js(){
        $challan_id = $this->input->post('h_challan_id');
        $result     = $this->HostelModel->hoste_student_fee_info(array('hostel_bill_id'=>$challan_id));
          echo  json_encode($result);
    }
    public function hoste_challan_details_save_js(){
        $challan_id     = $this->input->post('h_challan_id');
        $comments       = $this->input->post('comments');
        $current_status = $this->CRUDModel->get_where_row('hostel_student_bill',array('id'=>$challan_id));
        $ChallanInfoData = array(
            'payment_date'      => '0000-00-00',
            'challan_status'    => '1',
            'comments'          => $current_status->comments.', Unpaid '.$comments.'Date : '.date('d-m-Y H:i:s'),
            'up_user_id'        => $this->userInfo->user_id,
            'up_timestamp'      => date('Y-m-d H:i:s'),
        );
        $this->CRUDModel->update('hostel_student_bill',$ChallanInfoData,array('id'=>$challan_id));
        $challan_details = $this->CRUDModel->get_where_result('hostel_student_bill_info',array('hostel_bill_id'=>$challan_id));
         
        foreach($challan_details as $row):
            
                                 $this->db->order_by('id','asc');
                                 $this->db->order_by('1','0');   
        $last = $this->db->get_where('hostel_student_bill',array('hostel_std_id'=>$current_status->hostel_std_id,'head_type'=>$current_status->head_type,'challan_status'=>1))->row();
//       echo $challan_id;
//       echo $last->id;
        if($last->id == $challan_id):
           
            $SET_CURRENT_CHALLAN = array(
                    'paid_amount'       => 0,
                    'balance'           => 0,
                    'update_by'         => $this->userInfo->user_id,
                    'update_datetime'   => date('Y-m-d H:i:s'),
                  );
        
        
                  $this->CRUDModel->update('hostel_student_bill',array('challan_lock'=>1),array('id'=>$challan_id));
        
            else:
            
                    $SET_CURRENT_CHALLAN = array(
                    'paid_amount'       => 0,
                    'balance'           => $row->amount,
                    'update_by'         => $this->userInfo->user_id,
                    'update_datetime'   => date('Y-m-d H:i:s'),
                  );
            endif;
      
             $this->CRUDModel->update('hostel_student_bill_info',$SET_CURRENT_CHALLAN,array('id'=>$row->id));
            
            
                            $this->db->order_by('id','asc');
        $get_all_challans = $this->db->get_where('hostel_student_bill',array('hostel_std_id'=>$current_status->hostel_std_id,'id >'=>$challan_id,'head_type'=>$current_status->head_type,'challan_status'=>1))->result();
                    $totalRows = count($get_all_challans);
                    $sn = '';
                    foreach($get_all_challans as $rowothr):
                        $sn++;
                        if($sn == $totalRows):
                            $SET_CURRENT_CHALLAN1 = array(
                                'hostel_bill_id'    => $rowothr->id,
                                'hostel_head_id'    => $row->hostel_head_id,
                                'per_day'           => $row->per_day,
                                'total_days'        => $row->total_days,
                                'amount'            => $row->amount,
                                'paid_amount'       => 0,
                                'balance'           => $row->amount,
                                'old_challan_id'    => 25,
                                'adjust_flag'       => $row->adjust_flag,
                                'comments'          => $row->comments,
                                'timestamp'         => $row->timestamp,
                                'user_id'           => $row->user_id,
                                'update_by'         => $this->userInfo->user_id,
                                'update_datetime'   => date('Y-m-d H:i:s'),
                              );
                            else:
                            $SET_CURRENT_CHALLAN1 = array(
                               'hostel_bill_id'    => $rowothr->id,
                                'hostel_head_id'    => $row->hostel_head_id,
                                'per_day'           => $row->per_day,
                                'total_days'        => $row->total_days,
                                'amount'            => $row->amount,
                                'paid_amount'       => 0,
                                'balance'           => 0,
                                'old_challan_id'    => 25,
                                'adjust_flag'       => $row->adjust_flag,
                                'comments'          => $row->comments,
                                'timestamp'         => $row->timestamp,
                                'user_id'           => $row->user_id,
                                'update_by'         => $this->userInfo->user_id,
                                'update_datetime'   => date('Y-m-d H:i:s'),
                              );
                        endif;

                            $this->CRUDModel->insert('hostel_student_bill_info',$SET_CURRENT_CHALLAN1);
                        endforeach;
          endforeach;
           echo true;
     }
     public function hostel_installment_info(){
      
         $instalId =  $this->input->post('instalId');
         $h_student_id =  $this->input->post('h_student_id');
         
    }
    public function hostel_student_delete(){
        $std_hostel_id  = $this->uri->segment(2);
        $this->CRUDModel->deleteid('hostel_student_record',array('hostel_id'=>$std_hostel_id));
        redirect('admin/all_student_record','refresh');
    }
}   
