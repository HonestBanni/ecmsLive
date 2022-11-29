<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class SecurityController extends AdminController {
    
     public function __construct() 
        {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('SecurityModel');
             $this->load->library("pagination");
       }
    
    public function add_visitor()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()): 
           $visitor_name = ucwords(strtolower(ucwords($this->input->post('visitor_name'))));
           $father_name = ucwords(strtolower(ucwords($this->input->post('father_name'))));
           $cnic   = $this->input->post('cnic');   
           $contact   = $this->input->post('contact');   
           $address   = $this->input->post('address');   
           $meeting_person   = $this->input->post('emp_id');   
           $relation_id   = $this->input->post('relation_id');     
           $purpose_of_meeting   = $this->input->post('purpose_of_meeting');   
           $collected_document   = $this->input->post('collected_document'); 
           $visiting_card_no  = $this->input->post('visiting_card_no'); 
           $remarks  = $this->input->post('remarks'); 
           $visiting_date  = date('Y-m-d'); 
           $data = array(
                'visitor_name' => $visitor_name,
                'father_name' => $father_name,
                'cnic' => $cnic,
                'contact' => $contact,
                'address' => $address,
                'meeting_person' => $meeting_person,
                'relation_id' => $relation_id,
                'purpose_of_meeting' => $purpose_of_meeting,
                'collected_document' => $collected_document,
                'visiting_card_no' => $visiting_card_no,
                'visiting_date' => $visiting_date,
                'remarks' => $remarks,
                'user_id' =>$user_id,
                'timestamp' =>date('Y-m-d H:i:s'),
            );
            $id = $this->CRUDModel->insert('security_visitors',$data);
            redirect('SecurityController/visitors');
            endif;
        $this->data['page_title']   = 'Add New Visitor Record | ECMS';
        $this->data['page']         = 'security/add_visitor';
        $this->load->view('common/common',$this->data);  
    }
    
    public function proctors()
    {
        $this->data['result'] =  $this->SecurityModel->get_stdsData('proctors');
        $this->data['page_title']   = 'Proctors List | ECMS';
        $this->data['page']         = 'security/proctors';
        $this->load->view('common/common',$this->data); 
    }
    
    public function proctorial_fines()
    {
        if($this->input->post('search')): 
            $student_id  = $this->input->post('student_id');
            $proctor_id  = $this->input->post('proctor_id');
            $college_no  = $this->input->post('college_no');
        
            $where = "";
            $this->data['student_id'] = ""; 
            $this->data['proctor_id'] = ""; 
            $this->data['college_no'] = "";

        if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
        endif;
        if(!empty($proctor_id)):
            $where['proctorial_fine.proctor_id'] = $proctor_id;
            $this->data['proctor_id'] =$proctor_id;
        endif;
        if(!empty($college_no)):
            $where['college_no'] = $college_no;
            $this->data['college_no'] =$college_no;
        endif;
            $this->data['result'] = $this->SecurityModel->proctorialSearch('proctorial_fine',$where);
        else:
        $this->data['result'] = $this->SecurityModel->get_proctorialData('proctorial_fine');
        endif;
        $this->data['page_title']  = 'Proctorial Fines List| ECMS';
        $this->data['page']        =  'security/proctorial_fines';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_student_fine()
    {
        if($this->input->post()):
            $student_id = $this->input->post('student_id');
            $proctor_id = $this->input->post('proctor_id');
            $proc_type_id = $this->input->post('proc_type_id');
            $amount = $this->input->post('amount');
            $recover_assets = $this->input->post('recover_assets');
            $date = $this->input->post('date');
            $date1 = date('Y-m-d', strtotime($date));
            $remarks = $this->input->post('remarks');
      //  echo '<pre>';print_r($this->input->post());die;
        $data = array
            (
                'student_id'=>$student_id,
                'proc_type_id'=>$proc_type_id,
                'date'=>$date1,
                'amount'=>$amount,
                'recover_assets'=>$recover_assets,
                'remarks'=>$remarks,
                'proctor_id'=>$proctor_id
            );
        $this->CRUDModel->insert('proctorial_fine',$data);
        redirect('SecurityController/proctorial_fines');
        endif;
        $this->data['page_title']  = 'Add Student Fine | ECMS';
        $this->data['page']        =  'security/add_student_fine';
        $this->load->view('common/common',$this->data); 
    }
    
    public function view_proctorial_fine()
    {
        $proc_id = $this->uri->segment(3);
        $where = array('proctorial_fine.proc_id'=>$proc_id);
        $this->data['result'] = $this->SecurityModel->get_proctorialRow('proctorial_fine',$where);
        $this->data['page_title']  = 'View Proctorial Fines| ECMS';
        $this->data['page']        =  'security/view_proctorial_fine';
        $this->load->view('common/common',$this->data); 
    }
    
    public function update_proctorial_fine()
    {
        $proc_id = $this->uri->segment(3);
        if($this->input->post()):
            $proc_id     = $this->input->post('proc_id');
            $amount      = $this->input->post('amount');
            $amount_old      = $this->input->post('amount_old');
            $proc_status_id      = $this->input->post('proc_status_id');
            $proc_status_id_old      = $this->input->post('proc_status_id_old');
            $remarks      = $this->input->post('remarks');
            $remarks_old      = $this->input->post('remarks_old');
            $data       = array(
                'amount' =>$amount,
                'proc_status_id' =>$proc_status_id,
                'remarks' =>$remarks,
            );
            $where = array('proc_id'=>$proc_id);
            $this->CRUDModel->update('proctorial_fine',$data, $where);
            $data_log = array(
                'proc_id' =>$proc_id,
                'amount' =>$amount_old,
                'date' =>date('Y-m-d'),
                'proc_status_id' =>$proc_status_id_old,
                'remarks' =>$remarks_old, 
                );
            $this->CRUDModel->insert('proctorial_fine_log',$data_log);
            redirect('SecurityController/proctorial_fines');
        endif;
        if($proc_id):
        $where = array('proctorial_fine.proc_id'=>$proc_id);
        $this->data['result'] = $this->SecurityModel->get_proctorialRow('proctorial_fine',$where);
        $this->data['page_title']  = 'Update Proctorial Fines| ECMS';
        $this->data['page']        =  'security/update_proctorial_fine';
        $this->load->view('common/common',$this->data); 
        endif;
    }
    
    public function update_proctor()
    {
        $proctor_id = $this->uri->segment(3);
        if($this->input->post()):
            $status = $this->input->post('status');
            $where = array('proctor_id'=>$proctor_id);
            $data = array
                (
                    'status' => $status
                );
           $this->CRUDModel->update('proctors',$data,$where);
            if($status == 1):
               $where = array('proctor_id'=>$proctor_id);
               $q = $this->CRUDModel->get_where_row('proctors',$where);
               $whered = array('student_id'=>$q->student_id);
               $datastd = array('student_type'=>2);
               $this->CRUDModel->update('student_record',$datastd,$whered);
            else:
                $where = array('proctor_id'=>$proctor_id);
               $q = $this->CRUDModel->get_where_row('proctors',$where);
               $whered = array('student_id'=>$q->student_id);
               $datastd = array('student_type'=>1);
               $this->CRUDModel->update('student_record',$datastd,$whered);
            endif;
           redirect('SecurityController/proctors');
        endif;
        if($proctor_id):
            $where = array('proctor_id'=>$proctor_id);    
            $this->data['result'] = $this->SecurityModel->get_stdsData_row('proctors',$where);
            $this->data['page_title']  = 'Update Proctor| ECMS';
            $this->data['page']        =  'security/update_proctor';
            $this->load->view('common/common',$this->data); 
        endif;
    }
    
    public function add_to_proctor()
    {
        $student_id = $this->uri->segment(3);
        $where = array('student_id'=>$student_id);
        $data = array
            (
                'student_type' => 2
            );
       $this->CRUDModel->update('student_record',$data,$where);
       redirect('SecurityController/proctors');
    }
    
   public function add_proctor()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student_id = $this->input->post('student_id');
            $status = $this->input->post('status');
            $checked = array(
               'student_id'=>$student_id,
               'status'=>$status
            );
        $qry = $this->CRUDModel->get_where_row('proctors',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! This Students Already Exist');
        redirect('SecurityController/proctors');       
        else:
            $data = array(
                'student_id'=>$student_id,
                'status'=>$status,
                'user_id'=>$user_id
                );
        $this->CRUDModel->insert('proctors',$data);
        $where = array('student_id'=>$student_id);
        $this->load->helper('string');
        $passcode = random_string('alnum',5);
        $datastd = array
            (
                'student_type' => 2,
                'student_password' =>$passcode
            );
       $this->CRUDModel->update('student_record',$datastd,$where);
        $this->session->set_flashdata('msg1', 'Suceessfully Added in Proctors List');
        redirect('SecurityController/proctors');
        endif;
        endif;
        $this->data['page_title']   = 'Add Proctor | ECMS';
        $this->data['page']         = 'security/add_proctors';
        $this->load->view('common/common',$this->data);  
    } 
        
    public function update_visitor()
    {	    
        $serial_no         = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $where      = array('serial_no'=>$serial_no);
        $data = array
            (
                'flag' => 2,
                'update_timestamp' => date('Y-m-d H:i:s'),
                'update_user_id' => $user_id
            );
       $this->CRUDModel->update('security_visitors',$data,$where);
       redirect('SecurityController/visitors');
	}
    
    public function visitors()
    {
        if($this->input->post('search')): 
            $visiting_date = date('Y-m-d', strtotime($this->input->post('visiting_date')));
            $visiting_dateto = date('Y-m-d', strtotime($this->input->post('visiting_dateto')));
            $cnic  = $this->input->post('cnic');
            $visiting_card_no  = $this->input->post('visiting_card_no');
            $visitor_name  = $this->input->post('visitor_name');
        
            $where = "";
            $like = "";
            $this->data['visiting_date'] = ""; 
            $this->data['visiting_dateto'] = ""; 
            $this->data['visitor_name'] = ""; 
            $this->data['visiting_card_no'] = ""; 
            $this->data['cnic'] = ""; 
   
        if(!empty($visitor_name)):
            $like['visitor_name'] = $visitor_name;
            $this->data['visitor_name'] =$visitor_name;
        endif;
        if(!empty($visiting_card_no)):
            $where['visiting_card_no'] = $visiting_card_no;
            $this->data['visiting_card_no'] =$visiting_card_no;
        endif;
        if(!empty($cnic)):
            $where['cnic'] = $cnic;
            $this->data['cnic'] =$cnic;
        endif;
        if(!empty($visiting_date)):
               // $where['visiting_date'] = $visiting_date;
                $this->data['visiting_date'] =$visiting_date;
        endif;
        if(!empty($visiting_dateto)):
               // $where['visiting_date'] = $visiting_dateto;
                $this->data['visiting_dateto'] =$visiting_dateto;
        endif;
            $this->data['result'] = $this->SecurityModel->getVisitors_List($where,$like,$this->data['visiting_date'],$this->data['visiting_dateto']);
        else:
        $this->data['result'] = $this->SecurityModel->getVisitorsList();
        endif;
        if($this->input->post('export')):
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Visitors Record');
               
                $this->excel->getActiveSheet()->setCellValue('A1', 'Visiting Card#');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('B1', 'Visitor Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('C1', 'Visitor Father Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('D1', 'Visitor CNIC#');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1', 'Visitor Contact#');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('F1', 'Visitor Address');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1', 'Meeting Person');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('H1', 'Relation');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('I1', 'Purpose of Meeting');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('J1', 'Collected Document');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('K1', 'Visiting Date');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
        
        
            for($col = ord('A'); $col <= ord('K'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
            
        $visiting_date = date('Y-m-d', strtotime($this->input->post('visiting_dateto')));
        $visiting_dateto = date('Y-m-d', strtotime($this->input->post('visiting_dateto')));
        $cnic  = $this->input->post('cnic');
        $visiting_card_no  = $this->input->post('visiting_card_no');
        $visitor_name  = $this->input->post('visitor_name');
        $where = "";
        $like = "";
        $this->data['visiting_date'] = ""; 
        $this->data['visiting_dateto'] = ""; 
        $this->data['visitor_name'] = ""; 
        $this->data['visiting_card_no'] = ""; 
        $this->data['cnic'] = ""; 
   
        if(!empty($visitor_name)):
            $like['visitor_name'] = $visitor_name;
            $this->data['visitor_name'] =$visitor_name;
        endif;
        if(!empty($visiting_card_no)):
            $where['visiting_card_no'] = $visiting_card_no;
            $this->data['visiting_card_no'] =$visiting_card_no;
        endif;
        if(!empty($cnic)):
            $where['cnic'] = $cnic;
            $this->data['cnic'] =$cnic;
        endif;
        if(!empty($visiting_date)):
             //   $where['visiting_date'] = $visiting_date;
                $this->data['visiting_date'] =$visiting_date;
        endif;
        if(!empty($visiting_dateto)):
             //   $where['visiting_date'] = $visiting_date;
                $this->data['visiting_dateto'] =$visiting_dateto;
        endif;
          $result = $this->SecurityModel->getVisitors_Listexcel($where,$like,$this->data['visiting_date'],$this->data['visiting_dateto']);
          //  echo '<pre>';print_r($result);die;
                $exceldata="";
                foreach ($result as $row)
                {
                $exceldata[] = $row;
                }      
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='VisitorsList2017.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
        $this->data['page_title']   = 'Security Visitors | ECMS';
        $this->data['page']         = 'security/visitors';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function auto_relation()
     { 
        $term = trim(strip_tags($_GET['term']));
            if( $term == ''){
            $result_set             = $this->CRUDModel->getResults('relation');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'id'=>$row_set->relation_id,
                    'value'=>$row_set->title,
                    'label'=>$row_set->title
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
            $like   = array('title'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('relation',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                   'id'=>$row_set->relation_id,
                    'value'=>$row_set->title,
                    'label'=>$row_set->title
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
    
    public function auto_students()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->SecurityModel->getStds('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
        'value'=>$row_set->student_name.' s/d of '. $row_set->father_name .' ('.$row_set->college_no.')',
        'label'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->college_no.')',
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
            
            $result_set             = $this->SecurityModel->getStds('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
        'value'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->college_no.')',
        'label'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->college_no.')',
        'id'=>$row_set->student_id,
        'college_no'=>$row_set->college_no
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
    
    public function auto_studentss()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->SecurityModel->getStdss('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                                'value'=>$row_set->student_name.' s/d of '. $row_set->father_name .' ('.$row_set->form_no.')',
                                'label'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->form_no.')',
                                'id'=>$row_set->student_id,
                                'college_no'=>$row_set->form_no
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
            
            $result_set             = $this->SecurityModel->getStdss('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
        'value'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->form_no.')',
        'label'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->form_no.')',
        'id'=>$row_set->student_id,
        'form_no'=>$row_set->form_no
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
    
    public function auto_students_sec()
    { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->SecurityModel->getStds_sec('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
        'value'=>$row_set->student_name.' s/d of '. $row_set->father_name .' ('.$row_set->college_no.')',
        'label'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->college_no.')',
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
            
            $result_set = $this->SecurityModel->getStds_sec('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
        'value'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->college_no.')',
        'label'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->college_no.')',
        'id'=>$row_set->student_id,
        'college_no'=>$row_set->college_no
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
    
    public function auto_students_group()
    { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->SecurityModel->getStds_group('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
        'value'=>$row_set->student_name.' s/d of '. $row_set->father_name .' ('.$row_set->college_no.')',
        'label'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->college_no.')',
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
            
            $result_set = $this->SecurityModel->getStds_group('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
        'value'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->college_no.')',
        'label'=>$row_set->student_name.' s/d of '. $row_set->father_name . ' ('.$row_set->college_no.')',
        'id'=>$row_set->student_id,
        'college_no'=>$row_set->college_no
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
    
    
    
}   