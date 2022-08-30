<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class HostelController extends AdminController {
    
     public function __construct() 
        {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('HostelModel');
             $this->load->library("pagination");
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
    
    public function add_hostel_student()
	{
        $student_id = $this->uri->segment(3);
		$session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $student_id     = $this->input->post('student_id');
            $student_mobile_no = $this->input->post('student_mobile_no');
            $room_id     = $this->input->post('room_id');
            $allotted_date     = $this->input->post('allotted_date');
            $hostel_status_id     = $this->input->post('hostel_status_id');
            $date1 = date('Y-m-d', strtotime($allotted_date));
            $checked = array
            (
                'student_id' =>$student_id
            );
            $qry = $this->CRUDModel->get_where_row('hostel_student_record',$checked);
            if($qry):
            $this->session->set_flashdata('msg', 'Sorry! Student Already Exist');
            redirect('HostelController/hostel_student_record');
            else:
                $data  = array(
                    'student_id' =>$student_id,
                    'student_mobile_no' =>$student_mobile_no,
                    'allotted_date' =>$date1,
                    'room_id' =>$room_id,
                    'hostel_status_id' =>$hostel_status_id,
                    'user_id' =>$user_id,
                );        
                $this->CRUDModel->insert('hostel_student_record',$data);
                redirect('HostelController/hostel_student_record');
            endif;
            endif;
            if($student_id):
                $this->data['result'] = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            endif;
            $this->data['page_title']  = 'Add Hostel Student| ECMS';
            $this->data['page'] = 'hostel/add_hostel_student';
            $this->load->view('common/common',$this->data);
	}
    
    public function update_hostel_student()
	{
        $id = $this->uri->segment(3);
		$session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $student_id     = $this->input->post('student_id');
            $student_mobile_no  = $this->input->post('student_mobile_no');
            $hostel_id     = $this->input->post('hostel_id');
            $room_id     = $this->input->post('room_id');
            $hostel_status_id     = $this->input->post('hostel_status_id');
            $where = array('hostel_student_record.hostel_id'=>$hostel_id);
            $data  = array(
                'student_id' =>$student_id,
                'student_mobile_no' =>$student_mobile_no,
                'room_id' =>$room_id,
                'hostel_status_id' =>$hostel_status_id,
                'updated_user_id' =>$user_id,
            );        
            $this->CRUDModel->update('hostel_student_record',$data,$where);
            redirect('HostelController/hostel_student_record');
            endif;
            if($id):
            $where = array('hostel_student_record.hostel_id'=>$id);
            $this->data['result'] = $this->HostelModel->gethostel_Std('hostel_student_record',$where);
            $this->data['page_title']  = 'Update Hostel Student| ECMS';
            $this->data['page'] = 'hostel/update_hostel_student';
            $this->load->view('common/common',$this->data);
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
            $where = "";
        
            $this->data['student_id'] = ""; 
            $this->data['hostel_status_id'] = ""; 
            $this->data['room_id'] = ""; 
            $this->data['college_no'] = "";
        if($this->input->post('search')): 
            $student_id  = $this->input->post('student_id');
            $room_id  = $this->input->post('room_id');
            $hostel_status_id  = $this->input->post('hostel_status_id');
            $college_no  = $this->input->post('college_no');
        
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
        
            for($col = ord('A'); $col <= ord('I'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
            $student_id  = $this->input->post('student_id');
            $room_id  = $this->input->post('room_id');
            $hostel_status_id  = $this->input->post('hostel_status_id');
            $college_no  = $this->input->post('college_no');
            $where = "";
            $this->data['student_id'] = ""; 
            $this->data['hostel_status_id'] = ""; 
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
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            $result = $this->HostelModel->HostelData_excel('hostel_student_record',$where);
          //  echo '<pre>';print_r($result);die;
                $exceldata="";
                foreach ($result as $row)
                {
                $exceldata[] = $row;
                }      
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Hostel_Students_List2017.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
    }
    
    public function search_student()
    {
         $this->data['status'] = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status ', 'hostel_status_id', 'status_name'); 
        $like = '';
        $where = '';
        $this->data['hostel_status_id'] = "";
        
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
             
             $userInfo      = $this->getUser();
            if($this->input->post()):
               
                $h_studetn_id   = $this->input->post('h_student_id');
                $date_from      = $this->input->post('date_from');
                $date_to        = $this->input->post('date_to');
                $issue_date        = $this->input->post('issue_date');
                $bank           = $this->input->post('bank');
                
               
                $data = array(
                  'hostel_std_id'   => $h_studetn_id,  
                  'date_to'         => date('Y-m-d',strtotime($date_to)),  
                  'date_from'       => date('Y-m-d',strtotime($date_from)),  
                  'issue_date'      => date('Y-m-d',strtotime($issue_date)),  
                  'bank_id'         => $bank,
                  'challan_status'  => 1,
                  'hostel_status_id'=> 1,
                  'head_type'       => 1, 
                  'timestamp'       => date('Y-m-d H:i:s'),  
                  'user_id'         => $userInfo['user_id'],  
                );
                
                            $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id');
                $std_info = $this->db->where('hostel_student_record.hostel_id',$h_studetn_id)->get('hostel_student_record')->row();
         
                $hostel_fee_id  =  $this->CRUDModel->insert('hostel_student_bill',$data);
                $hostel_fee     = $this->CRUDModel->get_where_result('hostel_heads',array('status'=>1,'head_type'=>1,'batch_id'=>$std_info->batch_id));
                 
                $this->RQ($hostel_fee_id, 'assets/RQ/hostel_rq/');
                
                foreach($hostel_fee as $feeRow):
                    $data = array(
                        'hostel_bill_id'    =>$hostel_fee_id,
                        'hostel_head_id'    =>$feeRow->id,
                        'amount'            =>$feeRow->amount,
                        'timestamp'         => date('Y-m-d H:i:s'),  
                        'user_id'           => $userInfo['user_id'],
                    );
                  $this->CRUDModel->insert('hostel_student_bill_info',$data);
                endforeach;
                
               redirect('hostelPrintChallan/'.$h_studetn_id.'/'.$hostel_fee_id);
            endif;
            
            
            $this->data['page_title']   = 'Hostel Fee | ECMS';
            $this->data['page_header']  = 'Hostel Fee';
            $this->data['page']         = 'hostel/hostel_fee';
            $this->load->view('common/common',$this->data);
    }
//      public function hostel_fee(){
//            
//            $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));  
//             
//             $userInfo      = $this->getUser();
//            if($this->input->post()):
//               
//                $h_studetn_id   = $this->input->post('h_student_id');
//                $date_from      = $this->input->post('date_from');
//                $date_to        = $this->input->post('date_to');
//                $issue_date        = $this->input->post('issue_date');
//                $bank           = $this->input->post('bank');
//                
//               
//                $data = array(
//                  'hostel_std_id'   => $h_studetn_id,  
//                  'date_to'         => date('Y-m-d',strtotime($date_to)),  
//                  'date_from'       => date('Y-m-d',strtotime($date_from)),  
//                  'issue_date'      => date('Y-m-d',strtotime($issue_date)),  
//                  'bank_id'         => $bank,
//                  'challan_status'  => 1,
//                  'hostel_status_id'=> 1,
//                  'head_type'       => 1, 
//                  'timestamp'       => date('Y-m-d H:i:s'),  
//                  'user_id'         => $userInfo['user_id'],  
//                );
//                $hostel_fee_id  =  $this->CRUDModel->insert('hostel_student_bill',$data);
//                $hostel_fee     = $this->CRUDModel->get_where_result('hostel_heads',array('status'=>1,'head_type'=>1));
//                
//                $this->RQ($hostel_fee_id, 'assets/RQ/hostel_rq/');
//                
//                foreach($hostel_fee as $feeRow):
//                    $data = array(
//                        'hostel_bill_id'    =>$hostel_fee_id,
//                        'hostel_head_id'    =>$feeRow->id,
//                        'amount'            =>$feeRow->amount,
//                        'timestamp'         => date('Y-m-d H:i:s'),  
//                        'user_id'           => $userInfo['user_id'],
//                    );
//                  $this->CRUDModel->insert('hostel_student_bill_info',$data);
//                endforeach;
//                
//               redirect('hostelPrintChallan/'.$h_studetn_id.'/'.$hostel_fee_id);
//            endif;
//            
//            
//            $this->data['page_title']   = 'Hostel Fee | ECMS';
//            $this->data['page_header']  = 'Hostel Fee';
//            $this->data['page']         = 'hostel/hostel_fee';
//            $this->load->view('common/common',$this->data);
//    }
    public function mess_fee(){
            
            $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>16));  
            $this->data['per_day']      = $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
             $userInfo      = $this->getUser();
            if($this->input->post()):
               
                $h_studetn_id   = $this->input->post('h_student_id');
                $issue_date     = $this->input->post('issue_date');
                $per_day        = $this->input->post('per_day');
                $per_day_id     = $this->input->post('per_day_id');
                $total_amount   = $this->input->post('total_amount');
                $total_days     = $this->input->post('total_days');
                $bank           = $this->input->post('bank');
                
               
                $data = array(
                    'hostel_std_id'     => $h_studetn_id,  
                    'issue_date'        => date('Y-m-d',strtotime($issue_date)),  
                    'challan_status'    => 1,
                    'hostel_status_id'  => 1,
                    'head_type'         => 2,  
                    'bank_id'           => $bank,  
                    'timestamp'         => date('Y-m-d H:i:s'),  
                    'user_id'           => $userInfo['user_id'],  
                );
                $hostel_fee_id  =  $this->CRUDModel->insert('hostel_student_bill',$data);
//                $hostel_fee     = $this->CRUDModel->get_where_result('hostel_heads',array('status'=>1,'head_type'=>2));
                
                $this->RQ($hostel_fee_id, 'assets/RQ/hostel_rq/');
                
                
                    $data_info = array(
                        'hostel_bill_id'    =>$hostel_fee_id,
                        'hostel_head_id'    =>$per_day_id,
                        'amount'            =>$total_amount,
                        'per_day'            =>$per_day,
                        'total_days'        =>$total_days,
                        'timestamp'         => date('Y-m-d H:i:s'),  
                        'user_id'           => $userInfo['user_id'],
                    );
                  $this->CRUDModel->insert('hostel_student_bill_info',$data_info);
                redirect('hostelPrintChallan/'.$h_studetn_id.'/'.$hostel_fee_id);
            endif;
            
            
            $this->data['page_title']   = 'Mess Fee | ECMS';
            $this->data['page_header']  = 'Mess Fee';
            $this->data['page']         = 'hostel/mess_fee';
            $this->load->view('common/common',$this->data);
    }
     public function hostel_challan_print(){
            
        
             $hostel_id = $this->uri->segment(2);
             $bill_id = $this->uri->segment(3);
             
             
            $this->data['studentInfo']  = $this->HostelModel->hostel_fee_challan(array('hostel_student_record.hostel_id'=>$hostel_id));

            $this->data['challan_info'] = $this->HostelModel->hostel_challan_info(array('hostel_student_bill.id'=>$bill_id));
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
            $this->data['page_title']  = 'Hostel and Mess | ECMS';
            $this->data['page_header']  = 'Hostel and Mess';
            $this->data['page'] = 'hostel/hostel_mess';
            $this->load->view('common/common',$this->data);
    }
   
    public function hostel_mess_heads(){
         
            $this->data['feehead'] = '';
            $this->data['amount'] = '';
            $this->data['id'] = '';
            $this->data['head_typeId'] = 1;
            
            $this->data['head_type']         = $this->CRUDModel->dropDown('hostel_head_type','', 'id', 'title',array('status'=>1));
            
    if($this->input->post()):
         //Insert Code 
         $feehead           = $this->input->post('feehead');
         $amount            = $this->input->post('amount');
         $status            = $this->input->post('status');
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
             );

             $where = array('id'=>$id);
             $this->CRUDModel->update('hostel_heads',$data,$where);
             redirect('hostelMessHeads');
             else:
                 
                 $data = array(
                   'head_type'  =>$head_type,
                    'title'     =>$feehead,
                    'amount'    =>$amount,
                    'timestamp' =>$currnetDate,
                    'user_id'   =>$userInfo['user_id'],
                    );
                $this->CRUDModel->insert('hostel_heads',$data);
                 redirect('hostelMessHeads');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $row                        = $this->CRUDModel->get_where_row('hostel_heads',array('id'=>$id));
            $this->data['feehead']      = $row->title;
            $this->data['status']       = $row->status;
            $this->data['amount']       = $row->amount;
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
        redirect('hostelMessHeads');
        
    }
    
    public function hostel_mess_payment(){
        
        $this->data['challan_id'] = '';
        
        if($this->input->post('search')):
            
            $challan_id = $this->input->post('challan_no');
            $where = array('hostel_student_bill.id'=>$challan_id);
            $this->data['std_info'] = $this->HostelModel->student_info($where);
            
            
            $this->data['challan_id'] = $challan_id;
            
            $this->data['challan_info'] = $this->HostelModel->challan_info($where);
            
        endif;
        $userInfo      = $this->getUser();
        if($this->input->post('save')):
           $challan_id      = $this->input->post('challan_no'); 
           $payment_date    = $this->input->post('payment_date'); 
           
           $data = array(
                'payment_date' => date('Y-m-d',strtotime($payment_date)), 
                'challan_status' => 2,
                'up_timestamp'         => date('Y-m-d H:i:s'),  
                'up_user_id'           => $userInfo['user_id'],
           );
           $where = array(
              'id' => $challan_id
           );
           $this->CRUDModel->update('hostel_student_bill',$data,$where);
           
           
            $where_ch_info = array('hostel_bill_id'=>$challan_id);
           
           $challan_info = $this->HostelModel->challan_info($where_ch_info);
           
          
           foreach($challan_info as $chRow):
            $data_info = array(
               'paid_amount' =>$chRow->amount
           );
           $where_info = array(
              'id' => $chRow->id
           );
           $this->CRUDModel->update('hostel_student_bill_info',$data_info,$where_info);
               
           endforeach;
           
           
         
          redirect('HMPayments'); 
           
           
        endif;
        
        $this->data['page_title']   = 'Payment | ECMS';
        $this->data['page_header']  = 'Payment';
        $this->data['page']         = 'hostel/hostel_mess_payment';
        $this->load->view('common/common',$this->data);
    }
     public function hostel_payment_report(){
        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name');
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', 'Hostel Status', 'hostel_status_id', 'status_name');
        $this->data['hoste_p_status']    = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_head_type'] = $this->CRUDModel->dropDown('hostel_head_type', '', 'id', 'title');
        
        $this->data['collegeNo']    = '';
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
        
            $date = array(
                'from'=>$from,
                'to'=>$to,
            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
            $where = '';
//            $where['hostel_student_record.hostel_status_id'] = 1;
            
            $like = '';
           
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
                $where['fee_challan.fc_challan_id'] = $challan_no;
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
                
                if($this->input->post('hostel_head_wise')):
                    
                    $this->data['result']       = $this->HostelModel->hostel_head_wise_group_wise($where,$like,$date);
                    $this->data['report_type']  = 'hostel_head_wise';
                     
                    
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
                    
                    $this->data['result']       = $this->HostelModel->hostel_head_wise_student_wise($where,$like,$date);
                    $this->data['report_type']  = 'hostel_head_wise';
                     
                    
                    $report_head = '';
                    $report_name = '';
                    
                    if($hostel_head_type == 1):
                        $report_head = 'Hostel';
                        $report_name  = 'Hostel Heads Wise Student Wise Report';
                        else:
                        $report_name  = 'Mess Heads Wise Student Wise Report';
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
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name');
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', 'Hostel Status', 'hostel_status_id', 'status_name');
        $this->data['hoste_p_status']    = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['hostel_head_type'] = $this->CRUDModel->dropDown('hostel_head_type', '', 'id', 'title');
        
        $this->data['collegeNo']    = '';
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
           
//            $date = array(
//                'from'=>$from,
//                'to'=>$to,
//            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
            $where['hostel_student_record.hostel_status_id'] = 1;
            
            $like = '';
           
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
                $where['fee_challan.fc_challan_id'] = $challan_no;
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
                    $this->data['report_name']  = 'Hostel Student Wise';
                endif;
            endif;
        
        
        
        $this->data['page_title']   = 'Hostel Student Search| ECMS';
        $this->data['page_header']  = 'Hostel Student Search';
        $this->data['page']         = 'hostel/hostel_challan_search';
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
               $data = array(
                    'hostel_refund_id'  =>  $hoste_refund,
                    'hostel_head_id'    =>  $row,
                    'amount'            =>  $key,
                    'timestamp'         => date('Y-m-d H:i:s'),
                    'user_id'           => $userInfo['user_id'],
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
    
}   