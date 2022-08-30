<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
//require_once APPPATH."third_party\PHPExcel.php"; 

class AdminDeptController extends AdminController 
{

     public function __construct() 
     {
         parent::__construct();
         $this->load->model('CRUDModel');
         $this->load->model('AdminModel');
         $this->load->model('AdmissionModel');
         $this->load->model('FeeModel');
         $this->load->library("pagination");     
         $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
    }
    
    public function vehicle_record()
    {
        $this->data['result'] = $this->AdminModel->get_vehicleData('vehicle');
        $this->data['page_title']  = 'Vehicle Record| ECMS';
        $this->data['page']        =  'admindept/vehicle';
        $this->load->view('common/common',$this->data); 
    }
    
    public function character_issued()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $student_id = $this->uri->segment(3);
        $data = array(
        'student_id'=>$student_id,
        'date'=>date('Y-m-d'),
        'user_id'=>$user_id
        );
        $this->CRUDModel->insert('student_character_issued',$data);
        redirect('AdminDeptController/character_certificate');
    }
    
    public function provisional_issued()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $student_id = $this->uri->segment(3);
        $data = array(
        'student_id'=>$student_id,
        'date'=>date('Y-m-d'),
        'user_id'=>$user_id
        );
        $this->CRUDModel->insert('student_provisional_issued',$data);
        redirect('AdminDeptController/provisional_certificate_inter');
    } 
    
    public function print_vehicle()
    {
        $this->data['result'] = $this->AdminModel->get_vehicleData('vehicle');
        $this->data['page_title']  = 'Print Vehicle Record| ECMS';
        $this->data['page']        =  'admindept/print_vehicle';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_vehicle()
    {
        if($this->input->post()):
            $reg_no         = $this->input->post('reg_no');
            $chassis_no     = $this->input->post('chassis_no');
            $model          = $this->input->post('model');
            $engine_no      = $this->input->post('engine_no');
            $color          = $this->input->post('color');
            $price          = $this->input->post('price');
            $make_maker     = $this->input->post('make_maker');
            $veh_status_id  = $this->input->post('veh_status_id');
            $comments       = $this->input->post('comments');
            $under_used       = $this->input->post('under_used');
        $data = array
            (
                'registration_no'=>$reg_no,
                'chassis_no'=>$chassis_no,
                'model'=>$model,
                'color'=>$color,
                'engine_no'=>$engine_no,
                'make_and_maker'=>$make_maker,
                'price'=>$price,
                'veh_status_id'=>$veh_status_id,
                'comments'=>$comments,
                'under_used'=>$under_used
            );
        $this->CRUDModel->insert('vehicle',$data);
        redirect('AdminDeptController/vehicle_record');
        endif;
        $this->data['page_title']  = 'Add New Vehicle | ECMS';
        $this->data['page']        =  'admindept/add_vehicle';
        $this->load->view('common/common',$this->data); 
    }
    
    public function update_vehicle()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $reg_no = $this->input->post('reg_no');
            $vehicle_id = $this->input->post('vehicle_id');
            $chassis_no = $this->input->post('chassis_no');
            $model = $this->input->post('model');
            $engine_no = $this->input->post('engine_no');
            $color = $this->input->post('color');
            $price = $this->input->post('price');
            $make_maker = $this->input->post('make_maker');
            $veh_status_id = $this->input->post('veh_status_id');
            $comments = $this->input->post('comments');
            
            $under_used       = $this->input->post('under_used');
        $data = array
            (
                'registration_no'=>$reg_no,
                'chassis_no'=>$chassis_no,
                'model'=>$model,
                'color'=>$color,
                'engine_no'=>$engine_no,
                'make_and_maker'=>$make_maker,
                'veh_status_id'=>$veh_status_id,
                'price'=>$price,
                'under_used'=>$under_used,
                'comments'=>$comments
            );
        $where = array('vehicle_id'=>$vehicle_id);
        $this->CRUDModel->update('vehicle',$data,$where);
        redirect('AdminDeptController/vehicle_record');
        endif;
        if($id):
        $where = array('vehicle_id'=>$id);
        $this->data['result'] = $this->AdminModel->get_vehicleRow('vehicle',$where);
        $this->data['page_title']  = 'Update Vehicle | ECMS';
        $this->data['page']        =  'admindept/update_vehicle';
        $this->load->view('common/common',$this->data); 
        endif;
    }
    
    public function character_certificate()
    {          
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['program']    = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
		$this->data['batch']   = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
		$this->data['status']   = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name');
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
			$this->data['batchId']          = '';
			$this->data['statusId']          = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['limitId']  = '';
        
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $programe_id            =  $this->input->post('programe_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch');
			$status               =  $this->input->post('status');
            $limit              =  $this->input->post('limit');
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
            endif;
			if(!empty($status)):
                 $where['student_record.s_status_id'] = $status;
                $this->data['statusId'] = $status;
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
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            
            $this->data['result'] = $this->AdminModel->get_admin_stdData('student_record',$where,$like);
            endif;
            $this->data['page_title']   = 'Character Certificate | ECMS';
            $this->data['page']         = 'admindept/character_certificate';
            $this->load->view('common/common',$this->data);   
    }
    
    public function provisional_certificate_inter()
    {          
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['program']    = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('programe_id'=>1));
        $this->data['sub_program'] = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
		$this->data['batch']   = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>1));
		$this->data['status']   = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name');
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
			$this->data['batchId']          = '';
			$this->data['statusId']          = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['limitId']  = '';
        
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $programe_id            =  $this->input->post('programe_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch');
			$status               =  $this->input->post('status');
            $limit              =  $this->input->post('limit');
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
            endif;
			if(!empty($status)):
                 $where['student_record.s_status_id'] = $status;
                $this->data['statusId'] = $status;
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
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            
            $this->data['result'] = $this->AdminModel->get_admin_stdData('student_record',$where,$like);
            endif;
            $this->data['page_title']   = 'Provisional Certificate Certificate | ECMS';
            $this->data['page']         = 'admindept/provisional_certificate_inter';
            $this->load->view('common/common',$this->data);   
    }
    
    public function provisional_certificate_degree()
    {          
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['program']    = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('programe_id'=>4));
        $this->data['sub_program'] = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>4));
		$this->data['batch']   = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>4));
		$this->data['status']   = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name');
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
			$this->data['batchId']          = '';
			$this->data['statusId']          = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['limitId']  = '';
        
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $programe_id            =  $this->input->post('programe_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch');
			$status               =  $this->input->post('status');
            $limit              =  $this->input->post('limit');
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
            endif;
			if(!empty($status)):
                 $where['student_record.s_status_id'] = $status;
                $this->data['statusId'] = $status;
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
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            
            $this->data['result'] = $this->AdminModel->get_admin_stdData('student_record',$where,$like);
            endif;
            $this->data['page_title']   = 'Provisional Certificate Certificate | ECMS';
            $this->data['page']         = 'admindept/provisional_certificate_degree';
            $this->load->view('common/common',$this->data);   
    }
    
    public function update_student_certficate()
    {
        $student_id = $this->uri->segment(3);
        if($this->input->post()):
            $student_id             = $this->input->post('student_id');
            $admission_date         = $this->input->post('admission_date');
            $leaving_date           = $this->input->post('leaving_date');
            $date1                  = date('Y-m-d', strtotime($admission_date));
            $date2                  = date('Y-m-d', strtotime($leaving_date));
        $where                      = array('student_id'=>$student_id); 
        $update_data                = array('admission_date'=>$date1,'leaving_date'=>$date2); 
        $this->CRUDModel->update('student_record',$update_data,$where);
        redirect('AdminDeptController/update_student_certficate/'.$student_id);
        endif;
        $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));  
        $this->data['fee_information']      = $this->FeeModel->student_fee_details($this->uri->segment(3));
        $this->data['hostel_information']   = $this->FeeModel->student_hostel_details($this->uri->segment(3));
        $this->data['mess_information']   = $this->FeeModel->student_mess_details($this->uri->segment(3));
        $where = array('student_id'=>$student_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        $this->data['page_title']   = 'Update Student Character Certificate | ECMS';
        $this->data['page']         = 'admindept/update_student_certificate';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_provisional_certficate()
    {
        
        $student_id = $this->uri->segment(3);
         
        if($this->input->post()):
       
            $TotMarks       = $_POST['total_marks'];
            $ObtMarks       = $_POST['obtained_marks'];
                if($ObtMarks==0 && $TotMarks==0):
                   $percent = 0;
                else: 
                    $Percent = $ObtMarks/$TotMarks*100;
                    $percent = round($Percent,3);
                endif;
                $whereEDCheck = array(
               'student_id' =>$this->input->post('student_id'),
               'degree_id'  =>$this->input->post('degree_id')
            );
            $query = $this->CRUDModel->get_where_row('applicant_edu_detail',$whereEDCheck);
        if($query):
        $this->session->set_flashdata('msg', 'This Academic Record Already Exist');
        redirect('AdminDeptController/update_provisional_certficate/'.$this->input->post('student_id'));
        else:
        $data = array
            (	
                'student_id'        => $this->input->post('student_id'),
                'degree_id'         => $this->input->post('degree_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
                'inst_id'           => $this->input->post('inst_id'),
                'bu_id'             => $this->input->post('bu_id'),
                'year_of_passing'   => $this->input->post('year_of_passing'),
                'rollno'            => $this->input->post('roll_no'),
                'total_marks'       => $this->input->post('total_marks'),
                'obtained_marks'    => $this->input->post('obtained_marks'),
                'year_of_passing'   => $this->input->post('year_of_passing'),
                'grade_id'          => $this->input->post('grade_id'),
                'percentage'        => $percent,
                'exam_type'         => $this->input->post('exam_type'),
                'std_character'     => $this->input->post('std_character'),
                'inserteduser'      => $this->userInfo->user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
//            redirect('AdminDeptController/update_provisional_certficate/'.$this->input->post('student_id'));
        endif;
        endif;
        $order['column'] = 'yr_num';
        $order['order'] = 'desc';
        $this->data['year_of_pass']     = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num','',$order);
        $this->data['studentInfo']      = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));  
        $this->data['fee_information']      = $this->FeeModel->student_fee_details($this->uri->segment(3));
        $this->data['hostel_information']   = $this->FeeModel->student_hostel_details($this->uri->segment(3));
        $this->data['mess_information']   = $this->FeeModel->student_mess_details($this->uri->segment(3));
        $this->data['grade']  = $this->CRUDModel->dropDown('grade', 'Select Grade', 'grade_id', 'grade_name');
        $where = array('student_id'=>$student_id);
        $where1 = array('applicant_edu_detail.student_id'=>$student_id);
        $this->data['student_records'] =$this->AdminModel->studentEdu($where1);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        
        $this->data['program']         = $this->CRUDModel->dropdown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>$this->data['result']->programe_id));
        $this->data['sub_program']     = $this->CRUDModel->dropDown('sub_programes', '', 'sub_pro_id', 'name',array('programe_id'=>$this->data['result']->programe_id));
        
        
        
        $this->data['page_title']   = 'Update Student Provisional Certificate | ECMS';
//        $this->data['page']         = 'admindept/update_provisional_certficate';
         $this->data['page']             =  'AdminOffice/GreenFile/Forms/update_provisional_certficate';
//        $this->data['page']         = 'admindept/update_provisional_certficate';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_provisional_certficate_degree()
    {
        $student_id = $this->uri->segment(3);
         
        if($this->input->post()):
        $TotMarks = $_POST['total_marks'];
        $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
        else: 
        $Percent = $ObtMarks/$TotMarks*100;
        $percent = round($Percent,3);
        endif;
        $whereEDCheck = array(
           'student_id'=>$this->input->post('student_id'),
            'degree_id'=>$this->input->post('degree_id')
        );
        $query = $this->CRUDModel->get_where_row('applicant_edu_detail',$whereEDCheck);
        if($query):
        $this->session->set_flashdata('msg', 'This Academic Record Already Exist');
        redirect('AdminDeptController/update_provisional_certficate_degree/'.$this->input->post('student_id'));
        else:
        $data = array
            (	
                'student_id'        => $this->input->post('student_id'),
                'degree_id'         => $this->input->post('degree_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
                'inst_id'           => $this->input->post('inst_id'),
                'bu_id'             => $this->input->post('bu_id'),
                'year_of_passing'   => $this->input->post('year_of_passing'),
                'rollno'            => $this->input->post('roll_no'),
                'total_marks'       => $this->input->post('total_marks'),
                'obtained_marks'    => $this->input->post('obtained_marks'),
                'year_of_passing'   => $this->input->post('year_of_passing'),
                'div_id'            => $this->input->post('div_id'),
                'percentage'        => $percent,
                'exam_type'         => $this->input->post('exam_type'),
                'inserteduser'      => $this->userInfo->user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('AdminDeptController/update_provisional_certficate_degree/'.$this->input->post('student_id'));
        endif;
        endif;
        
        $order['column'] = 'yr_num';
        $order['order'] = 'desc';
        $this->data['year_of_pass']         = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num','',$order);
        $this->data['studentInfo']          = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));  
        $this->data['fee_information']      = $this->FeeModel->student_fee_details($this->uri->segment(3));
        $this->data['hostel_information']   = $this->FeeModel->student_hostel_details($this->uri->segment(3));
        $this->data['mess_information']     = $this->FeeModel->student_mess_details($this->uri->segment(3));
        $this->data['division']             = $this->CRUDModel->dropDown('student_division', 'Select Division', 'div_id', 'div_title');
        $where                              = array('student_id'=>$student_id);
        $where1                             = array('applicant_edu_detail.student_id'=>$student_id);
        $this->data['student_records']      = $this->AdminModel->studentEdu($where1);
        $this->data['result']               = $this->CRUDModel->get_where_row('student_record',$where);
        $this->data['program']              = $this->CRUDModel->dropdown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>$this->data['result']->programe_id));
        $this->data['sub_program']          = $this->CRUDModel->dropDown('sub_programes', '', 'sub_pro_id', 'name',array('programe_id'=>$this->data['result']->programe_id));
        
        $this->data['page_title']           = 'Update Student Provisional Certificate | ECMS';
        $this->data['page']                 =  'AdminOffice/GreenFile/Forms/update_provisional_certficate_degree';
//        $this->data['page']         = 'admindept/update_provisional_certficate_degree';
        $this->load->view('common/common',$this->data);
    }
    
    public function deleteAcademic()
    {	    
        $id    = $this->uri->segment(3);
        $student_id    = $this->uri->segment(4);
        $where = array('serial_no'=>$id);
        $this->CRUDModel->deleteid('applicant_edu_detail',$where);
        redirect('AdminDeptController/update_provisional_certficate/'.$student_id);
	}
    
    public function deleteAcademicDegree()
    {	    
        $id    = $this->uri->segment(3);
        $student_id    = $this->uri->segment(4);
        $where = array('serial_no'=>$id);
        $this->CRUDModel->deleteid('applicant_edu_detail',$where);
        redirect('AdminDeptController/update_provisional_certficate_degree/'.$student_id);
	}

    
//    public function Print_Character()
//    {
//        $student_id = $this->uri->segment(3);
//        $where = array('student_id'=>$student_id);
//        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
//        $this->data['page_title']   = 'Print Student Character Certificate | ECMS';
//        $this->data['page']         = 'admindept/print_character_certificate';
//        $this->load->view('common/common',$this->data);
//    }
    
    public function Print_Character()
    {
        $student_id = $this->uri->segment(3);
        $where = array('student_id'=>$student_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        $this->data['page_title']   = 'Print Student Character Certificate | ECMS';
        $this->data['page']         = 'admindept/print_character_certificate';
        $this->load->view('common/common',$this->data);
    }
    
    public function Print_provisional_certificate_inter()
    {
        $student_id                     = $this->uri->segment(3);
        $where = array('student_id'     => $student_id);
        $this->data['result']           = $this->CRUDModel->get_where_row('student_record',$where);
        $this->data['academic']         = $this->AdminModel->getAcademicRec('applicant_edu_detail',$where);
        $this->data['page_title']       = 'Student Provisional Certificate Inter| ECMS';
        $this->data['page']             = 'admindept/Print_provisional_certificate_inter';
        $this->load->view('common/common',$this->data);
    }
    
    public function Print_provisional_certificate_degree()
    {
        $student_id = $this->uri->segment(3);
        $where = array('student_id'=>$student_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        $this->data['academic'] = $this->AdminModel->getAcademicRec('applicant_edu_detail',$where);
        $this->data['page_title']   = 'Student Provisional Certificate Degree| ECMS';
        $this->data['page']         = 'admindept/Print_provisional_certificate_degree';
        $this->load->view('common/common',$this->data);
    }
    
    public function Alumni_record()
    {
        $where = array('student_record.s_status_id'=>9);
         $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
            $config['base_url']         = base_url('AdminDeptController/Alumni_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 50;
            $config["num_links"]        = 2;
            $config['uri_segment']      = 3;
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            $config['first_link']       = "<i class='fa fa-angle-left'></i>";
            $config['last_link']        = "<i class='fa fa-angle-right'></i>";


            $this->pagination->initialize($config);
            $page                       = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
            $this->data['pages']        = $this->pagination->create_links();
            $custom['column']    ='student_id';
            $custom['order']     ='desc';          
            $this->data['result']    = $this->CRUDModel->pagination('student_record',$config['per_page'], $page,$where,$custom);
        $this->data['count']     =$config['total_rows']; 
        
        $this->data['page_title']   = 'Alumni Records | ECP';
        $this->data['page']         = 'admindept/alumni_record';
        $this->load->view('common/common',$this->data);      
    }
    
    public function getSubProgram(){
      $proId = $this->input->post('programId');
//                $this->db->order_by('batch_order','asc');
//      $result = $this->db->get_where('sub_programes',array('programe_id'=>$proId))->result();
      $result = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>$proId));
      echo '<option value="">Sub Program</option>';
      foreach($result as $subRow):
          echo '<option value="'.$subRow->sub_pro_id.'">'.$subRow->name.'</option>';
      endforeach;
    
    }
    
	 public function getSections(){
        $sectionId = $this->input->post('sub_program_id');
        $where = array('sub_pro_id'=>$sectionId,'status'=>'On');
        
        $getSections = $this->CRUDModel->get_where_result('sections',$where);
        echo '<option value="">Section</option>';
        foreach($getSections as $secRow):
               echo '<option value="'.$secRow->sec_id.'">'.$secRow->name.'</option>';
        endforeach;
    }
	
	public function getBatch(){
        $programId = $this->input->post('programId');
        $where = array('programe_id'=>$programId);
        $getbatchs = $this->CRUDModel->get_where_result('prospectus_batch',$where);
        echo '<option value="">Batch</option>';
        foreach($getbatchs as $secRow):
               echo '<option value="'.$secRow->batch_id.'">'.$secRow->batch_name.'</option>';
        endforeach;
    }
    
    public function add_alumni()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $data = array
            (
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'college_no'=>$this->input->post('college_no'),
                'board_regno'=>$this->input->post('board_regno'),
                'uni_regno'=>$this->input->post('uni_regno'),
                'uni_regno'=>$this->input->post('uni_regno'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'father_name'=>$father,
                'occ_id'=>$this->input->post('occ_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'dob'=>$this->input->post('dob'),
                'sports_id'=>$this->input->post('sports_id'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'char_id'=>$this->input->post('char_id'),
                'admission_date'=>$this->input->post('admission_date'),
                'certificate_issue_date'=>$this->input->post('certificate_issue_date'),
                'dues_any'=>$this->input->post('dues_any'),
                'remarks'=>$this->input->post('remarks'),
                'remarks2'=>$this->input->post('remarks2'),
                's_status_id'=>9,
                'user_id'=>$user_id
            );
            $id = $this->CRUDModel->insert('student_record',$data);
             $academic_data = array
            (
                'student_id'=>$id,
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'grade_id'=>$this->input->post('grade_id'),
                'rollno'=>$this->input->post('rollno'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$academic_data);
            redirect('AdminDeptController/alumni_academic_record/'.$id);
          else:
            $this->data['page_title']   = 'Add Alumni Student Record | ECP';
            $this->data['page']         = 'admindept/add_alumni_record';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function update_alumni_student($id)
    {
        $id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $data       = array(
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'college_no'=>$this->input->post('college_no'),
                'board_regno'=>$this->input->post('board_regno'),
                'uni_regno'=>$this->input->post('uni_regno'),
                'student_name'=>$student,
                'father_name'=>$father,
                'occ_id'=>$this->input->post('occ_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'dob'=>$this->input->post('dob'),
                'sports_id'=>$this->input->post('sports_id'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'hostel_required'=>$_POST['hostel_required'],
                'admission_date'=>$_POST['admission_date'],
                'certificate_issue_date'=>$this->input->post('certificate_issue_date'),
                'dues_any'=>$this->input->post('dues_any'),
                'remarks'=>$this->input->post('remarks'),
                'remarks2'=>$this->input->post('remarks2'),
                's_status_id'=>9,
                'updated_by_user'=>$user_id
            );
              $where = array('student_id'=>$id);
              $this->CRUDModel->update('student_record',$data,$where);
                
                $TotMarks = $this->input->post('total_marks');
                $ObtMarks = $this->input->post('obtained_marks');
                $Percent = $ObtMarks/$TotMarks*100;
                $percent = round($Percent,3);
                 $academic_data = array
                (
                    'student_id'=>$id,
                    'degree_id'=>$this->input->post('degree_id'),
                    'inst_id'=>$this->input->post('inst_id'),
                    'bu_id'=>$this->input->post('bu_id'),
                    'year_of_passing'=>$this->input->post('year_of_passing'),
                    'total_marks'=>$this->input->post('total_marks'),
                    'obtained_marks'=>$this->input->post('obtained_marks'),
                     'percentage'=>$percent,
                    'year_of_passing'=>$this->input->post('year_of_passing'),
                    'grade_id'=>$this->input->post('grade_id'),
                    'rollno'=>$this->input->post('rollno'),
                    'inserteduser'=>$user_id
                );
                $query = $this->CRUDModel->get_where_row('applicant_edu_detail',$where);
                if($query):
                $this->CRUDModel->update('applicant_edu_detail',$academic_data,$where);
                else:
                 $this->CRUDModel->insert('applicant_edu_detail',$academic_data);
                endif;
              redirect('AdminDeptController/Alumni_record'); 
           endif;
            if($id):
                $where = array('student_record.student_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

                $this->data['student_record'] =$this->AdminModel->student_edu_record_limit($where);
                $this->data['student_records'] =$this->AdminModel->student_edu_record($where);

                $this->data['page_title']        = 'Update Alumni Record | ECP';
                $this->data['page']        =  'admindept/update_alumni_record';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
        }
    
    public function alumni_academic_record()
	{		
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
       if($this->input->post()):
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $whereEDCheck = array(
               'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id')
            );
            $query = $this->CRUDModel->get_where_row('applicant_edu_detail',$whereEDCheck);
            if($query):
            $this->session->set_flashdata('msg', 'This Academic Record Already Exist');
            redirect('AdminDeptController/alumni_academic_record/'.$this->input->post('student_id'));

            else:
            $data = array
            (
                'student_id'=>$id,
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'cgpa'=>$this->input->post('cgpa'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'percentage'=>$percent,
                'grade_id'=>$this->input->post('grade_id'),
                'rollno'=>$this->input->post('rollno'),
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('AdminDeptController/alumni_academic_record/'.$id);
        endif;
        endif;
$this->data['degree']  = $this->CRUDModel->dropDown('degree', '�? Select degree  →', 'degree_id', 'title');
$this->data['board_university']  = $this->CRUDModel->dropDown('board_university', '�? Select Board  →', 'bu_id', 'title');
$this->data['grade']  = $this->CRUDModel->dropDown('grade', '�? Select Grade  →', 'grade_id', 'grade_name');
        
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['alumni_records'] = $this->AdminModel->alumni_edu_record($where);
            $this->data['page_title']   = 'Alumni Academic Record | ECP';
            $this->data['page']         = 'admindept/alumni_academic_record';
            $this->load->view('common/common',$this->data); 
	}
    
    public function alumni_student_profile($id)
	{	
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $where = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->AdminModel->alumni_student_profile($where);
        $this->data['student_records'] =$this->AdminModel->student_edu_record($where);
        $this->data['limit_records'] =$this->AdminModel->student_edu_record_limit($where);
        $this->data['page_title']   = 'Alumni Student Profile  | ECP';
        $this->data['page']         = 'admindept/alumni_student_profile';
        $this->load->view('common/common',$this->data);
	}
    
    public function update_alumni_academic($id)
	{	
        $id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
        $TotMarks = $_POST['total_marks'];
        $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
        else: 
        $Percent = $ObtMarks/$TotMarks*100;
        $percent = round($Percent,3);
        endif;
            $data = array(
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'cgpa'=>$this->input->post('cgpa'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'percentage'=>$percent,
                'grade_id'=>$this->input->post('grade_id'),
                'rollno'=>$this->input->post('rollno'),
                'exam_type'=>$this->input->post('exam_type'),
                'updateduser'=>$user_id
            );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('applicant_edu_detail',$data,$where);
              redirect('AdminDeptController/Alumni_record'); 
              endif;
            if($id):
                $where = array('applicant_edu_detail.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('applicant_edu_detail',$where);

                $this->data['page_title']        = 'Update Academic Record | ECP';
                $this->data['page']        =  'admindept/update_academic_record';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;  
	}
    
    public function delete_academic_record()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('serial_no'=>$id);
        $this->CRUDModel->deleteid('applicant_edu_detail',$where);
        redirect('AdminDeptController/Alumni_record'); 
	}
    
    public function search_student()
    {
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name');  
    $this->data['program']    = $this->CRUDModel->dropDown('programes_info', ' Programs ', 'programe_id', 'programe_name');  
        if($this->input->post('submit')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $programe_id             =  $this->input->post('programe_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $s_status_id        =  $this->input->post('s_status_id');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['programe_id']  = '';
            
            $where['student_record.s_status_id'] = 9;

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
            if(!empty($programe_id)):
                $where['student_status.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
        
                $this->data['result']   = $this->AdminModel->get_stdData('student_record',$where,$like);    
                $this->data['page']     = "admindept/search_student_record";
                $this->data['title']    = 'Student List | ECP';
                $this->load->view('common/common',$this->data);  
            endif;
    }
    
    
     public function auto_occupation()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('occupation');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->occ_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['occ_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('title'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('occupation',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->occ_id
                    );
            
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['occ_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_domicile()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('domicile');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->domicile_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['domicile_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('domicile',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->domicile_id
                    );
            
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['domicile_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_country()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('country');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->country_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['country_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('country',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->country_id
                    );
            
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['country_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_district()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('district');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->district_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['district_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('district',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->district_id
                    );
            
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['district_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_degree()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('degree');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->degree_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['degree_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('title'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('degree',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->degree_id
                    );
            
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['degree_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_bu()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('board_university');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->bu_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['bu_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('title'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('board_university',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->title,
                    'label'=>$row_set->title,
                    'id'=>$row_set->bu_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['bu_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    
    public function college_no_Checking(){ 
       $college_no      = $this->input->post('college_no');
       $where = array('college_no'=>$college_no);
       $query = $this->CRUDModel->get_where_row('student_record',$where);
       if($query):
           echo TRUE;
           else:
           echo FALSE;
       endif;  
    }  
    
    public function board_regno_Checking(){ 
       $board_regno     = $this->input->post('board_regno');
       $where = array('board_regno'=>$board_regno);
       $query = $this->CRUDModel->get_where_row('student_record',$where);
       if($query):
           echo TRUE;
           else:
           echo FALSE;
       endif;  
    } 
    
    public function uni_regno_Checking(){ 
       $uni_regno      = $this->input->post('uni_regno');
       $where = array('uni_regno'=>$uni_regno);
       $query = $this->CRUDModel->get_where_row('student_record',$where);
       if($query):
           echo TRUE;
           else:
           echo FALSE;
       endif;  
    }   
    
    public function print_green_file($id){	
        
        $id                             = $this->uri->segment(3);
        $this->data['student_id']       = $id;
        $where                          = array('student_record.student_id'=>$id);
        $this->data['result']           = $this->AdminModel->alumni_student_profile($where);
        $this->data['student_records']  = $this->AdminModel->student_edu_record($where);
        $this->data['limit_records']    = $this->AdminModel->student_edu_record_limit_record($where);
        $this->data['page_title']       = 'Student Green File  | ECMS';
        $this->data['page']             = 'AdminOffice/GreenFile/Report/print_green_file';
//        $this->data['page']         = 'admindept/print_green_file';
        $this->load->view('common/common',$this->data);
	}
    
    public function get_where_batch(){
      $subproId = $this->input->post('subproId');
      
      $result = $this->CRUDModel->get_where_result('prospectus_batch',array('lang_spro_id'=>$subproId));
      
      foreach($result as $subRow):
          echo '<option value="'.$subRow->batch_id.'">'.$subRow->batch_name.'</option>';
      endforeach;
    }
    
    public function get_form_no(){
      $subproId = $this->input->post('subproId');  
	  $this->db->select('code');
		$this->db->from('languages');
		$this->db->where('lang_pro_id',$subproId);
		$qr = $this->db->get()->row();
		  
			$number = "";
			$form_no = "";
		$this->db->limit(1,0)->order_by('student_id','desc');
		$result = $this->db->get_where('student_record',array('sub_pro_id'=>$subproId))->row();
		if(empty($result)):
				$number = 1;
			else:
			 
				$d = explode("-",$result->form_no);
				$number = $d[1]+1;
			endif;
		$form_no = $qr->code.'-'.$number;
		echo '<input type="text" name="form_no" id="form_no" value="'.$form_no.'" class="form-control">';
			
    }
    
    public function getCheckSubjects(){
        $sub_pro_id = $this->input->post('subId');

         $result = $this->CRUDModel->get_where_result('subject',array('sub_pro_id'=>$sub_pro_id));
        echo '<div class="form-group col-md-12">
                <h3 align="left">Subjects for Arts Students<hr></h3>
                <div class="form-group col-md-12"> 
                    <table class="table table-boxed table-hover">
                        <thead>
                            <tr>    
                                <th>Only for Computer Science / Arts Students</th>
                            </tr>
                        </thead>
                        <tbody><tr><td>';
                        foreach($result as $resRow):
                                echo '<div class="form-group col-md-3">
                                            <input type="checkbox" name="checked[]" value="'.$resRow->subject_id.'" id="subjectItem" style="zoom:2">&nbsp:
                                        <span style="font-size: 15px;"><strong>'.$resRow->title.'</strong></span>
                                    </div>';
                        endforeach;
                    echo 
                        '</td></tr></tbody>
                    </table>
                </div>
            </div>';
    }
    
    public function getUpdateCheckSubjects(){
        $sub_pro_id = $this->input->post('subId');
        $student_id = $this->input->post('stdId');

        $selectsubjects   = $this->AdmissionModel->new_student_subject_get(array('student_id'=>$student_id));
        $allSubjects      = $this->CRUDModel->get_where_result('subject',array('sub_pro_id'=>$sub_pro_id));
        if($allSubjects):
            $ssArray = array();
        
            echo '<div class="form-group col-md-12">
                <h3 align="left">Subjects for Arts Students<hr></h3>
                <div class="form-group col-md-12"> 
                    <table class="table table-boxed table-hover">
                        <thead>
                            <tr>    
                                <th>Computer Science / Arts Subjects</th>
                            </tr>
                        </thead>
                        <tbody><tr><td>';
        
            foreach($selectsubjects as $sRow):
                $ssArray[] = $sRow->subject_id;
            endforeach;
                  
            $ssArray1[0] =0;
            $grandArray = array_merge($ssArray1,$ssArray);
      
            foreach($allSubjects as $resRow):

                if(array_search($resRow->subject_id,$grandArray)):
                    echo '<div class="form-group col-md-3">
                              <input type="checkbox" name="checked[]" checked value="'.$resRow->subject_id.'" id="subjectItem" style="zoom:2">&nbsp:
                              <input type="hidden" name="check_log[]" value="'.$resRow->subject_id.'">
                              <span style="font-size: 15px;"><strong>'.$resRow->title.'</strong></span>
                          </div>';
                else:
                    echo '<div class="form-group col-md-3">
                            <input type="checkbox" name="checked[]" value="'.$resRow->subject_id.'" id="subjectItem" style="zoom:2">&nbsp:
                            <span style="font-size: 15px;"><strong>'.$resRow->title.'</strong></span>
                        </div>';
                endif;
            endforeach;
         
                    echo 
                        '</td></tr></tbody>
                    </table>
                </div>
            </div>';
        endif;
    }
        public function leaving_certificate(){          
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['status']       = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name');
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
			$this->data['batchId']          = '';
			$this->data['statusId']          = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['limitId']  = '';
        
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $programe_id            =  $this->input->post('programe_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch');
			$status               =  $this->input->post('status');
            $limit              =  $this->input->post('limit');
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
            endif;
			if(!empty($status)):
                 $where['student_record.s_status_id'] = $status;
                $this->data['statusId'] = $status;
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
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            
            $this->data['result'] = $this->AdminModel->get_admin_leaving_certificate('student_record',$where,$like);
            endif;
            $this->data['page_title']        = 'Leaving Certificate | ECMS';
            $this->data['page_header']   = 'Leaving Certificate';
            $this->data['page']         = 'AdminOffice/Certificates/leaving_certificate';
            $this->load->view('common/common',$this->data);   
    }
    public function update_leaving_certficate(){
        $student_id = $this->uri->segment(2);
        if($this->input->post()):
            $student_id             = $this->input->post('student_id');
            $admission_date         = $this->input->post('admission_date');
            $leaving_date           = $this->input->post('leaving_date');
            $date1                  = date('Y-m-d', strtotime($admission_date));
            $date2                  = date('Y-m-d', strtotime($leaving_date));
        $where                      = array('student_id'=>$student_id); 
        $update_data                = array('admission_date'=>$date1,'leaving_date'=>$date2); 
        $this->CRUDModel->update('student_record',$update_data,$where);
        redirect('UpdateLeavingCertificate/'.$student_id);
        endif;
        $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(2)));  
        $this->data['fee_information']      = $this->FeeModel->student_fee_details($this->uri->segment(2));
        $this->data['hostel_information']   = $this->FeeModel->student_hostel_details($this->uri->segment(2));
        $this->data['mess_information']   = $this->FeeModel->student_mess_details($this->uri->segment(2));
        $where = array('student_id'=>$student_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        $this->data['page_header']   = 'Update Leaving Certificate';
        $this->data['page_title']   = 'Update Leaving Certificate | ECMS';
        $this->data['page']         = 'AdminOffice/Certificates/update_leaving_certificate';
        $this->load->view('common/common',$this->data);
    }
    public function print_leaving_certificate(){
        $student_id = $this->uri->segment(2);
        $where = array('student_id'=>$student_id);
        $this->data['result'] = $this->AdminModel->leaving_certificate_print($where);
        
//         echo '<pre>';print_r($this->data['result']);die;
        $this->data['page_title']   = 'Print Student Leaving Certificate | ECMS';
        $this->data['page']         = 'AdminOffice/Certificates/print_leaving_certificate';
        $this->load->view('common/common',$this->data);
    }
    public function leaving_issued_certificate() {
        
        $student_id = $this->uri->segment(2);
        $data = array(
        'student_id'    =>$student_id,
        'date'          =>date('Y-m-d'),
        'user_id'       =>$this->userInfo->user_id
        );
        $this->CRUDModel->insert('student_leaving_issued',$data);
        redirect('LeavingCertifcate');
    }
    
    public function discipline_action_vp(){
             
        $this->data['collegeNo']    = '';
        $this->data['stdName']      = '';
        $this->data['fatherName']   = '';
        $this->data['gender_id']    = '';
        $this->data['programe_id']  = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = ''; 
        $this->data['section_id']   = ''; 

        if($this->input->post()):

            $college_no         =  $this->input->post('college_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $programe_id        =  $this->input->post('programe_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $gender             =  $this->input->post('gender');
            $section            =  $this->input->post('section');
            $batch              =  $this->input->post('batch');

            $like = '';
            $where = '';


             if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['collegeNo'] =$college_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['stdName'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['fatherName'] =$father_name;
            endif;
            if(!empty($section)):
                $like['sections.sec_id']    = $section;
                $this->data['section_id']   = $section;
            endif;
            if(!empty($section)):
                $like['sections.sec_id']    = $section;
                $this->data['section_id']   = $section;
            endif;
            if(!empty($batch)):
                $where['prospectus_batch.batch_id'] = $batch;
                $this->data['batch_id'] =$batch;
            endif;
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;

            $this->data['result']   = $this->AdminModel->discipline_action_pagination_search($where,$like); 
            $this->data['count']   = count($this->data['result']);
        else:

            //pagination start
            $config['base_url']         = base_url('DisciplineAction');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5)));  //echo $config['total_rows']; exit;
            $config['per_page']         = 50;
            $config["num_links"]        = 10;
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
            
            $this->pagination->initialize($config);
            $page                           = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pagination_links'] = $this->pagination->create_links();
            //pagination start 
             
            $this->data['result']       = $this->AdminModel->discipline_action_pagination($config['per_page'],$page); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
            
            $this->data['page_header']  = 'Discipline Action ';
            $this->data['page_title']   = 'Discipline Action| ECMS';
            $this->data['page']         = 'admission/admin/Discipline/discipline_action_v';
            $this->load->view('common/common',$this->data);
    }
    
    public function discipline_action(){
             
        $this->data['collegeNo']    = '';
        $this->data['stdName']      = '';
        $this->data['fatherName']   = '';
        $this->data['gender_id']    = '';
        $this->data['programe_id']  = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = ''; 
        $this->data['section_id']   = ''; 

        if($this->input->post()):

            $college_no         =  $this->input->post('college_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $programe_id        =  $this->input->post('programe_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $gender             =  $this->input->post('gender');
            $section            =  $this->input->post('section');
            $batch              =  $this->input->post('batch');

            $like = '';
            $where = '';


             if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['collegeNo'] =$college_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['stdName'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['fatherName'] =$father_name;
            endif;
            if(!empty($section)):
                $like['sections.sec_id']    = $section;
                $this->data['section_id']   = $section;
            endif;
            if(!empty($section)):
                $like['sections.sec_id']    = $section;
                $this->data['section_id']   = $section;
            endif;
            if(!empty($batch)):
                $where['prospectus_batch.batch_id'] = $batch;
                $this->data['batch_id'] =$batch;
            endif;
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;

            $this->data['result']   = $this->AdminModel->discipline_action_pagination_search($where,$like); 
            $this->data['count']   = count($this->data['result']);
        else:

            //pagination start
            $config['base_url']         = base_url('DisciplineAction');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5)));  //echo $config['total_rows']; exit;
            $config['per_page']         = 50;
            $config["num_links"]        = 10;
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
            
            $this->pagination->initialize($config);
            $page                           = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pagination_links'] = $this->pagination->create_links();
            //pagination start 
             
            $this->data['result']       = $this->AdminModel->discipline_action_pagination($config['per_page'],$page); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
            
            $this->data['page_header']  = 'Discipline Action ';
            $this->data['page_title']   = 'Discipline Action| ECMS';
            $this->data['page']         = 'admission/admin/Discipline/discipline_action_v';
            $this->load->view('common/common',$this->data);
    }
    
    public function add_discipline_action(){
        $student_id = $this->uri->segment(2);

                                    $this->db->order_by('id','desc');
                                    $this->db->join('student_record','student_record.student_id=student_discipline_actions.student_id');    
        $this->data['result'] =     $this->db->get_where('student_discipline_actions',array('student_record.student_id'=>$student_id))->result();
        $this->data['student_info'] =     $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));
        
        if($this->input->post()):
            $student_id = $this->input->post('student_id');
            $date       = $this->input->post('date');
            $action     = $this->input->post('action');
            $data = array(
                'student_id'=>$student_id,
                'd_action_date'=>date('Y-m-d',strtotime($date)),
                'd_action_details'=>$action,
                'create_by'=>$this->userInfo->user_id,
                'create_datetime'=>date('Y-m-d H:i:s'),
                
                    );
            $this->CRUDModel->insert('student_discipline_actions',$data);
            redirect('AddDisciplineAction/'.$student_id);
        endif;
        
        $this->data['page_header']  = 'Add Discipline Action ';
        $this->data['page_title']   = 'Add Discipline Action| ECMS';
        $this->data['page']         = 'admission/admin/Discipline/add_discipline_action_v';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_discipline_action(){
        $id         = $this->uri->segment(2);
        $student_id = $this->uri->segment(3);


        $this->data['result'] =     $this->db->get_where('student_discipline_actions',array('id'=>$id))->row();
        
        if($this->input->post()):
            $student_id = $this->input->post('student_id');
            $date       = $this->input->post('date');
            $action     = $this->input->post('action');
            $id         = $this->input->post('action_id');
            $data = array(
                'd_action_date'=>date('Y-m-d',strtotime($date)),
                'd_action_details'=>$action,
                'update_by'=>$this->userInfo->user_id,
                'update_datetime'=>date('Y-m-d H:i:s'),
                
                    );
            $this->CRUDModel->update('student_discipline_actions',$data,array('id' => $id,));
            redirect('AddDisciplineAction/'.$student_id);
        endif;
        
        $this->data['page_header']  = 'Add Discipline Action ';
        $this->data['page_title']   = 'Add Discipline Action| ECMS';
        $this->data['page']         = 'admission/admin/Discipline/update_discipline_action_v';
        $this->load->view('common/common',$this->data);
    }
     
    public function disabled_discipline_action(){
         
        $action_id         = $this->uri->segment(2);
        $student_id        = $this->uri->segment(3);
        $this->CRUDModel->update('student_discipline_actions',array('status'=>0),array('id'=>$action_id));
        redirect('AddDisciplineAction/'.$student_id);
        
    }
    
}
