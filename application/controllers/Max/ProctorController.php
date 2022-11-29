<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminStudentController.php');

class ProctorController extends AdminStudentController {
	function __construct()
	{
		parent::__construct(); 
        $this->load->model('CRUDModel');
        $this->load->model('StudentModel');
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where);
	}
    
    public function proctor()
    {
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('proctorial_fine.proctor_id'=>$student_id);
        $where = array('student_id'=>$student_id);
        $q = $this->CRUDModel->get_where_row('proctors',$where);
        $proctor_id = $q->proctor_id;
        $where2 = array('proctorial_fine.proctor_id'=>$proctor_id);
        $this->data['result'] = $this->StudentModel->get_proctorData('proctorial_fine',$where2);
        $this->data['page_title']  = 'Proctor | ECMS';
        $this->data['page']        =  'students/proctor_area';
        $this->load->view('common/proctor_common_2',$this->data); 
    }
    
    public function add_student_fine()
    {
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $q = $this->CRUDModel->get_where_row('proctors',$where);
        $proctor_id = $q->proctor_id;
        if($this->input->post()):
            $student_id = $this->input->post('student_id');
            $proc_type_id = $this->input->post('proc_type_id');
            $recover_assets = $this->input->post('recover_assets');
            $date = $this->input->post('date');
            $date1 = date('Y-m-d', strtotime($date));
            $remarks = $this->input->post('remarks');
        $data = array
            (
                'student_id'=>$student_id,
                'proc_type_id'=>$proc_type_id,
                'date'=>$date1,
                'recover_assets'=>$recover_assets,
                'remarks'=>$remarks,
                'proctor_id'=>$proctor_id
            );
        
        $this->CRUDModel->insert('proctorial_fine',$data);
        redirect('ProctorController/proctor');
        endif;
        $this->data['page_title']  = 'Add Student Fine | ECMS';
        $this->data['page']        =  'students/add_student_fine';
        $this->load->view('common/proctor_common_2',$this->data); 
    }
    
    public function auto_std_record()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->StudentModel->getStds('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no,
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
            
            $result_set             = $this->StudentModel->getStds('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no,
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
    
    public function auto_proctor_record()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set    = $this->StudentModel->getProctors('proctors');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->proctor_id,
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
            
            $result_set             = $this->StudentModel->getProctors('proctors',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->proctor_id,
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