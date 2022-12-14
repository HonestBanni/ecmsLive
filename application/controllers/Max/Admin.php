<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class Admin extends AdminController {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');       
		$this->load->helper('url'); 
                $this->load->model('model_users');
                $this->load->model('CRUDModel');
                $this->load->model('HrModel');
                $this->load->model('get_model');
                $this->load->model('dropdownModel');
                $this->load->library("pagination");
                $this->load->model("AttendanceModel");
                $this->load->model("AdmissionModel");
                $this->load->model("FeeModel");
                $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
	}

	/**************Admin Login Starts******************/
	public function index()
	{
		$this->admin_home();
	}
    
    public function fee_clearance_inter(){          
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
        
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
            $std = $this->CRUDModel->get_where_row('student_record',$where);
            $this->data['result'] = $this->get_model->fee_clearnace_inter('student_record',$where,$like);
        
        
            if(!empty($std)):
        
            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$std->student_id));  
            $this->data['fee_information'] = $this->FeeModel->student_fee_details($std->student_id);
            $this->data['hostel_information'] = $this->FeeModel->student_hostel_details($std->student_id);
            $this->data['mess_information'] = $this->FeeModel->student_mess_details($std->student_id);
            endif;
            endif;
            $this->data['page_title']   = 'Fee Clearance Inter | ECMS';
            $this->data['page']         = 'admission/fee_clearance_inter';
            $this->load->view('common/common',$this->data);   
    }
    
     public function degree_bs_programs()
    { 
         
            $this->data['batchId']      = '';
         $this->data['batch']       = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name',array('status'=>'on'));
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $programe_id            =  $this->input->post('programe_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $btch_id        =  $this->input->post('batch_id');
            $s_status_id        =  $this->input->post('s_status_id');
          
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['s_status_id']  = '';
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
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
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($btch_id)):
                $where['student_record.batch_id'] = $btch_id;
                $this->data['batchId']  = $btch_id;
            endif;
        $this->data['result'] = $this->get_model->get_bs_stdData('student_record',$where,$like);       
        endif;
        
        if($this->input->post('export_excel')):

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('BS Students');
            //set cell A1 content with some text
            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No.');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'Form No.');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','College No.');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1', 'Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1', 'Sub Program');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1', 'Batch');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1', 'Section');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1', 'Status');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            for($col = ord('A'); $col <= ord('I'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }
		
        
            $college_no     =  $this->input->post('college_no');
            $form_no        =  $this->input->post('form_no');
            $student_name   =  $this->input->post('student_name');
            $father_name    =  $this->input->post('father_name');
            $gender_id      =  $this->input->post('gender_id');
            $programe_id    =  $this->input->post('programe_id');
            $sub_pro_id     =  $this->input->post('sub_pro_id');
            $btch_id        =  $this->input->post('batch_id');
            $s_status_id    =  $this->input->post('s_status_id');
          
            $like = '';
            $where = '';
            $this->data['college_no']   = '';
            $this->data['form_no']      = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']    = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']   = '';
            $this->data['s_status_id']  = '';
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
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
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($btch_id)):
                $where['student_record.batch_id'] = $btch_id;
                $this->data['batchId']  = $btch_id;
            endif;
            $result = $this->get_model->get_bs_stdData_excel('student_record',$where,$like);  
			foreach ($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='StudentReport.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
        
        
        
       $this->data['page_title'] = 'Degree/Bs Programs Students Record | ECMS';
       $this->data['page']       = 'admission/degree_bs_programs';
       $this->load->view('common/common',$this->data);
       
    }
     
    
    public function student_college_no_password()
    {       
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name'); 
        $this->data['status']       = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $s_status_id        =  $this->input->post('s_status_id');
          
            $like  = '';
            $where = '';
            $this->data['college_no']   = '';
            $this->data['form_no']      = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']    = '';
            $this->data['sub_pro_id']   = '';
            $this->data['s_status_id']  = '';
        
        if($this->input->post('search')):
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
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
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                $this->data['result']   = $this->get_model->get_college_no_password('student_record',$where,$like);
            endif;
           $this->data['page_title']   = 'All Student Records | ECMS';
           $this->data['page']         = 'admission/student_college_no_password';
           $this->load->view('common/common',$this->data);
       
    }
    
    
    public function edit_collegeno_and_password()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $student_id         = $this->input->post('student_id');
            $college_no         = $this->input->post('college_no');
            $student_password   = $this->input->post('student_password');
            $mobile_no          = $this->input->post('mobile_no');
            $net_id             = $this->input->post('net_id');
            $applicant_mob_no1  = $this->input->post('applicant_mob_no1');
        
        $data = array(
                'college_no'        => $college_no,
                'applicant_mob_no1' => $applicant_mob_no1,
                'mobile_no'         => $mobile_no,
                'net_id'            => $net_id,
                'student_password'  => $student_password
            );
        $where = array('student_id'=>$student_id);
        $this->CRUDModel->update('student_record',$data,$where);
        redirect('admin/student_college_no_password');
        endif;
        if($id):
        $this->data['mobile_network']          = $this->CRUDModel->dropDown('mobile_network', ' Mobile Network ', 'net_id', 'network');   
        $where                      = array('student_id'=>$id);
        $this->data['result']       = $this->get_model->get_college_passwordRow('student_record',$where);
        $this->data['page_title']   = 'Update College no and Password | ECMS';
        $this->data['page']         = 'admission/edit_collegeno_and_password';
        $this->load->view('common/common',$this->data); 
        endif;
    }
	
	public function login()
	{
		$this->load->view("users/login");
	}
	
	 public function delete_hnd_academic()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('serial_no'=>$id);
        $this->CRUDModel->deleteid('applicant_edu_detail',$where);
        redirect('admin/hnd_student_record');
	}
	
	/*********Admin Main Home Page starts*********/
	public function admin_home()
	{	
            $session        = $this->session->all_userdata();
            $user_id =$session['userData']['user_id'];
            $userEmail      = $session['userData']['Email'];
            $where          = array('email'=>$userEmail);
                        
            $this->data['Showmessage'] = $this->CRUDModel->get_where_result('message',array('status'=>'1'));
            $this->data['userInfo'] = $this->CRUDModel->get_where_row('users',$where);
        
            $this->data['page_title']        = 'Admin Home | ECMS';
            $this->data['page']        =  'admission/home';
            $this->load->view('common/common',$this->data);
	}
    
    public function teacher_attendance()
	{	
        
        $session = $this->session->all_userdata();
        $user_id = $session['userData']['user_id'];
        
        $where = array('id'=>$user_id);
        $q = $this->CRUDModel->get_where_row('users',$where);
        
        $data = array(
        'emp_id'=>$q->user_empId,
        'in_date'=>date('Y-m-d'),   
        'in_time'=>date('h:i:s a'),
        'date_time'=>date('Y-d-m H:i:s')    
        );
        $this->CRUDModel->insert('teacher_attendance',$data);
        redirect('admin/admin_home');    
	}
    
    public function teacher_logout(){
            $t_attend_id = $this->uri->segment(3);
            $where = array('t_attend_id'=>$t_attend_id);
            $data = array(
            'out_date'=>date('Y-m-d'),   
            'out_time'=>date('h:i:s a')
            );
            $this->CRUDModel->update('teacher_attendance',$data,$where);
        
            $session = $this->session->all_userdata();
            if(!empty($session)){
                
                $this->session->unset_userdata('userData');
                redirect('login');
            }else{
                redirect('login');
            }
        }

    
    public function adm_home()
	{	
            $session        = $this->session->all_userdata();
            $user_id =$session['userData']['user_id'];
            $userEmail      = $session['userData']['Email'];
            $where          = array('email'=>$userEmail);
                        
            $this->data['Showmessage'] = $this->CRUDModel->get_where_result('message',array('status'=>'1'));
            $this->data['userInfo'] = $this->CRUDModel->get_where_row('users',$where);
        
            $this->data['page_title']        = 'Admin Home | ECMS';
            $this->data['page']        =  'admission/adm_home';
            $this->load->view('common/common',$this->data);
	}
    
  
	
	public function restricted()
	{
		$this->load->view("restricted");
	}
	
	public function login_validation()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email","Email","required|trim|xss_clean|callback_validate_credentials");
		$this->form_validation->set_rules("password","Password","required|trim|md5");
		if($this->form_validation->run())
		{	
    $thisUser = $this->model_users->userData($this->input->post('id'),$this->input->post('email'), $this->input->post('password'));        
			$data = array(
				'id' => $this->input->post('id'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'is_logged_in' => 1 
			);
			$this->session->set_userdata($data);
            redirect('admin/admin_home');
		}
		else
		{
			$this->login();
		}
	}
	
	public function validate_credentials()
	{
		$this->load->model('model_users');
		
		if($this->model_users->can_log_in())
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('validate_credentials', 'Incorrect Username/Password');
			return false;
		}
	}
	
	public function logout()
	{	
		$this->session->sess_destroy();
		$this->load->view("users/login");
	}
	/**************Admin Login Ends******************/
   
        
     public function add_Message(){
         
        if($this->input->post()):
            $details     = $this->input->post('details');
            $message_category     = $this->input->post('message_category');
            $data       = array(
                'details' =>$details,
                'message_category' =>$message_category
            );
            $this->CRUDModel->insert('message',$data);
            $this->data['page_title']   = 'Add Message| ECMS';
            $this->data['page']         = 'admission/message';
            $this->load->view('common/common',$this->data);
            redirect('admin/message');
          else:
              redirect('/');
        endif;	 
	} 
    
    public function update_message(){
         $this->data['message_category']          = $this->CRUDModel->dropDown('message_category', ' Select Category ', 'message_cat_id', 'cat_title',array('status'=>'1'));
        $id = $this->uri->segment(3);
        if($this->input->post()):
              $details =$this->input->post('details');
              $status =$this->input->post('status');
              $message_id =$this->input->post('message_id');
              $message_category     = $this->input->post('message_category');
              $data = array(
                    'details'=>$details,
                    'status'=>$status,
                    'message_category' =>$message_category
                  );
              $where = array('message_id'=>$message_id); 
              $this->CRUDModel->update('message',$data,$where);
              redirect('admin/message'); 
           endif;
        if($id):
            $where = array('message_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('message',$where);

            $this->data['page_title']        = 'Updae Message | ECMS';
            $this->data['page']        =  'admission/update_message';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function message(){      
        $this->data['message_category']          = $this->CRUDModel->dropDown('message_category', ' Select Category ', 'message_cat_id', 'cat_title',array('status'=>'1'));
        $this->data['result']       = $this->CRUDModel->getResults('message');
        $this->data['page_title']   = 'Message | ECMS';
        $this->data['page']         = 'admission/message';
        $this->load->view('common/common',$this->data);
    }
    
    public function delete_message()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('message_id'=>$id);
        $this->CRUDModel->deleteid('message',$where);
        redirect('admin/message');
	}
        
    public function board_university(){
        $where = '';
        $order['column'] = 'title';
        $order['order']  = 'asc';
        
        $this->data['result']       = $this->CRUDModel->get_where_result_order('board_university', $where, $order);
        $this->data['page_title']   = 'Board University  | ECMS';
        $this->data['page']         = 'admission/board_university';
        $this->load->view('common/common',$this->data);
    }
    
    public function add_board_university()
    {	  	
        if($this->input->post()):
            $title      = $this->input->post('title');
            $data       = array(
                'title' =>$title
            );
            $this->CRUDModel->insert('board_university',$data);
            $this->data['page_title']   = 'Board University  | ECMS';
            $this->data['page']         = 'admission/board_university';
            $this->load->view('common/common',$this->data);
            redirect('admin/board_university');
          else:
              redirect('/');
        endif;	 
	} 
    
    public function update_board_university()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
              $title =$this->input->post('title');
              $bu_id =$this->input->post('bu_id');
              $data = array(
                      'title'=>$title
                  );
              $where = array('bu_id'=>$bu_id); 
              $this->CRUDModel->update('board_university',$data,$where);
              redirect('admin/board_university'); 
           endif;
        if($id):
            $where = array('bu_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('board_university',$where);

            $this->data['page_title']        = 'Updae board University  | ECMS';
            $this->data['page']        =  'admission/update_board_university';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    public function delete_board_university()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('bu_id'=>$id);
        $this->CRUDModel->deleteid('board_university',$where);
        redirect('admin/board_university');
	}
    
    public function institute()
    {      
        $where              = '';
        $order['column']    = 'title';
        $order['order']     = 'asc';
       $this->data['result']       = $this->CRUDModel->get_where_result_order('institute', $where, $order);
       $this->data['page_title']   = 'All Institutes  | ECMS';
       $this->data['page']         = 'admission/institute';
       $this->load->view('common/common',$this->data);
    }
    
    public function add_institute()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('title');
            $data       = array(
                'title' =>$title
            );
            $this->CRUDModel->insert('institute',$data);
            $this->data['page_title']   = 'All Institutes  | ECMS';
            $this->data['page']         = 'admission/institute';
            $this->load->view('common/common',$this->data);
            redirect('admin/institute');
          else:
              redirect('/');
        endif;	
	}
    
    public function delete_institute()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('inst_id'=>$id);
        $this->CRUDModel->deleteid('institute',$where);
        redirect('admin/institute');
	}
    
    public function district()
    {
        $where = '';
        $order['column'] = 'name';
        $order['order'] = 'asc';
        
       $this->data['result']       = $this->CRUDModel->get_where_result_order('district', $where, $order);
       $this->data['page_title']   = 'All Districts  | ECMS';
       $this->data['page']         = 'admission/district';
       $this->load->view('common/common',$this->data);   
    }
    
    public function add_district()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('name');
            $data       = array(
                'name' =>$title
            );
            $this->CRUDModel->insert('district',$data);
            $this->data['page_title']   = 'All Districts  | ECMS';
            $this->data['page']         = 'admission/district';
            $this->load->view('common/common',$this->data);
            redirect('admin/district');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_district()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('district_id'=>$id);
        $this->CRUDModel->deleteid('district',$where);
        redirect('admin/district');
	}
    
    public function domicile()
    {
       $where = '';
        $order['column'] = 'name';
        $order['order']  = 'asc';
        
        $this->data['result']       = $this->CRUDModel->get_where_result_order('domicile', $where, $order);
       $this->data['page_title']   = 'All Domiciles  | ECMS';
       $this->data['page']         = 'admission/domicile';
       $this->load->view('common/common',$this->data);  
    }
    
    public function add_domicile()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('name');
            $data       = array(
                'name' =>$title
            );
            $this->CRUDModel->insert('domicile',$data);
            $this->data['page_title']   = 'All Domiciles  | ECMS';
            $this->data['page']         = 'admission/domicile';
            $this->load->view('common/common',$this->data);
            redirect('admin/domicile');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_domicile()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('domicile_id'=>$id);
        $this->CRUDModel->deleteid('domicile',$where);
        redirect('admin/domicile');
	}
    
    public function country()
    {
       $this->data['result']       = $this->CRUDModel->getResults('country');
       $this->data['page_title']   = 'All Countries  | ECMS';
       $this->data['page']         = 'admission/country';
       $this->load->view('common/common',$this->data); 
    }
    
    public function add_country()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('name');
            $data       = array(
                'name' =>$title
            );
            $this->CRUDModel->insert('country',$data);
            $this->data['page_title']   = 'All Countries  | ECMS';
            $this->data['page']         = 'admission/country';
            $this->load->view('common/common',$this->data);
            redirect('admin/country');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_country()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('country_id'=>$id);
        $this->CRUDModel->deleteid('country',$where);
        redirect('admin/country');
	}
    
    public function degree()
    {
        $where = '';
        $order['column'] = 'title';
        $order['order'] = 'asc';
        
       $this->data['result']       = $this->CRUDModel->get_where_result_order('degree', $where, $order);
       $this->data['page_title']   = 'All Degrees  | ECMS';
       $this->data['page']         = 'admission/degree';
       $this->load->view('common/common',$this->data); 
    }
    
    public function add_degree()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('title');
            $data       = array(
                'title' =>$title
            );
            $this->CRUDModel->insert('degree',$data);
            $this->data['page_title']   = 'All degrees  | ECMS';
            $this->data['page']         = 'admission/degree';
            $this->load->view('common/common',$this->data);
            redirect('admin/degree');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_degree()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('degree_id'=>$id);
        $this->CRUDModel->deleteid('degree',$where);
        redirect('admin/degree');
	}
    
    public function degree_type()
    {
       $this->data['result']       = $this->CRUDModel->getResults('degree_type');
       $this->data['page_title']   = 'All Degree Types  | ECMS';
       $this->data['page']         = 'admission/degree_type';
       $this->load->view('common/common',$this->data);    
    }
    
     public function add_degree_type()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('name');
            $data       = array(
                'name' =>$title
            );
            $this->CRUDModel->insert('degree_type',$data);
            $this->data['page_title']   = 'All degree Types  | ECMS';
            $this->data['page']         = 'admission/degree_type';
            $this->load->view('common/common',$this->data);
            redirect('admin/degree_type');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_degree_type()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('degree_type_id'=>$id);
        $this->CRUDModel->deleteid('degree_type',$where);
        redirect('admin/degree_type');
	}
    
    public function relation()
    {
       $this->data['result']       = $this->CRUDModel->getResults('relation');
       $this->data['page_title']   = 'All Relations  | ECMS';
       $this->data['page']         = 'admission/relation';
       $this->load->view('common/common',$this->data);  
    }
    
    public function add_relation()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('title');
            $data       = array(
                'title' =>$title
            );
            $this->CRUDModel->insert('relation',$data);
            $this->data['page_title']   = 'All Relations  | ECMS';
            $this->data['page']         = 'admission/relation';
            $this->load->view('common/common',$this->data);
            redirect('admin/relation');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_relation()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('relation_id'=>$id);
        $this->CRUDModel->deleteid('relation',$where);
        redirect('admin/relation');
	}
    
    public function occupation()
    {
       $this->data['result']       = $this->CRUDModel->getResults('occupation');
       $this->data['page_title']   = 'All Occupations  | ECMS';
       $this->data['page']         = 'admission/occupation';
       $this->load->view('common/common',$this->data);   
    }
    
    public function add_occupation()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('title');
            $data       = array(
                'title' =>$title
            );
            $this->CRUDModel->insert('occupation',$data);
            $this->data['page_title']   = 'All Occupations  | ECMS';
            $this->data['page']         = 'admission/occupation';
            $this->load->view('common/common',$this->data);
            redirect('admin/occupation');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_occupation()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('occ_id'=>$id);
        $this->CRUDModel->deleteid('occupation',$where);
        redirect('admin/occupation');
	}
    
    public function programes()
    {
       $this->data['result']       = $this->CRUDModel->getResults('programes_info');
       $this->data['page_title']   = 'All Programs  | ECMS';
       $this->data['page']         = 'admission/programes';
       $this->load->view('common/common',$this->data);
    }
    
    public function add_programe()
	{	
	   if($this->input->post()):
            $programe_name      = $this->input->post('programe_name');
            $status      = $this->input->post('status');
            $degree_type_id      = $this->input->post('degree_type_id');
            $data       = array(
                'programe_name' =>$programe_name,
                'degree_type_id' =>$degree_type_id,
                'status' =>$status
            );
            $this->CRUDModel->insert('programes_info',$data);
            $this->data['page_title']   = 'All Programs  | ECMS';
            $this->data['page']         = 'admission/programes';
            $this->load->view('common/common',$this->data);
            redirect('admin/programes');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_programe()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('programe_id'=>$id);
        $this->CRUDModel->deleteid('programes_info',$where);
        redirect('admin/programes');
	}
    
    public function sub_programes()
    {
        
        $this->data['programe_id'] = '';
        $this->data['sub_pro_id'] = '';
        $this->data['sub_result'] = '';
        
        if($this->input->post()):
            
            $program_id     = $this->input->post('programe_id');
            $sub_id         = $this->input->post('sub_proId');
            $type           = $this->input->post('sp_type');
            
            $where = '';
            
            if($program_id):
                $where['sub_programes.programe_id'] = $program_id;
            endif;
            
            if($sub_id):
                $where['sub_programes.sub_pro_id'] = $sub_id;
            endif;
            
            if($type):
                $where['sub_programes.flag'] = $type;
            endif;
            
            $this->data['sub_result']       = $this->AdmissionModel->searchSubProgram('sub_programes',$where);
            else:
                
            $this->data['sub_result']       = $this->AdmissionModel->searchSubProgram('sub_programes');
        endif;
        
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
        $this->data['sub_program']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
        
//       $this->data['result']       = $this->CRUDModel->getResults('sub_programes');
//       $this->data['result'] = $this->db->order_by('name','asc')->order_by('programe_id','asc')->get("sub_programes")->result();
       $this->data['page_title']   = 'All Sub Programs  | ECMS';
       $this->data['page']         = 'admission/sub_programes';
       $this->load->view('common/common',$this->data);   
    }
    
    public function add_sub_programe()
	{	
        if($this->input->post()):
            $name      = $this->input->post('name');
            $status      = $this->input->post('status');
            $programe_id      = $this->input->post('programe_id');
            $flag      = $this->input->post('flag');
            $data       = array(
                'name' =>$name,
                'status' =>$status,
                'programe_id' =>$programe_id,
                'flag' =>$flag
            );
            $this->CRUDModel->insert('sub_programes',$data);
            $this->data['page_title']   = 'All Sub Programs  | ECMS';
            $this->data['page']         = 'admission/sub_programes';
            $this->load->view('common/common',$this->data);
            redirect('admin/sub_programes');
          else:
              redirect('/');
        endif;    
	}
    
    public function delete_sub_programe()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('sub_pro_id'=>$id);
        $this->CRUDModel->deleteid('sub_programes',$where);
        redirect('admin/sub_programes');
	}
    
    public function physical_status()
    {
       $this->data['result']       = $this->CRUDModel->getResults('physical_status');
       $this->data['page_title']   = 'All Physical Statuses | ECMS';
       $this->data['page']         = 'admission/physical_status';
       $this->load->view('common/common',$this->data);   
    }
    
    public function add_physical_status()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('title');
            $data       = array(
                'title' =>$title
            );
            $this->CRUDModel->insert('physical_status',$data);
            $this->data['page_title']   = 'All Physical Status  | ECMS';
            $this->data['page']         = 'admission/physical_status';
            $this->load->view('common/common',$this->data);
            redirect('admin/physical_status');
          else:
              redirect('/');
        endif;
	}
  public function update_student_group(){
        $id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $secId = $this->input->post('section_id');
            if(!empty($secId)):
                 
                $data = array(
                    'section_id'=>$this->input->post('section_id'),
                    'up_user_id'=>$user_id,
                    'up_timestamp'=>date('Y-d-m H:i:s')
                );
                  $where = array('serial_no'=>$id);
                  $this->CRUDModel->update('student_group_allotment',$data,$where);
                  redirect('admin/student_record'); 
                  else:
                    redirect('admin/student_record'); 
            endif;
            
              endif;
            if($id):
                $where = array('student_group_allotment.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('student_group_allotment',$where);

                $this->data['page_title']        = 'Update Student By Group  | ECMS';
                $this->data['page']        =  'admission/update_student_group';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    public function delete_physical_status()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('ps_id'=>$id);
        $this->CRUDModel->deleteid('physical_status',$where);
        redirect('admin/physical_status');
	}
    
    public function religion()
    {
       $this->data['result']       = $this->CRUDModel->getResults('religion');
       $this->data['page_title']   = 'All Religions | ECMS';
       $this->data['page']         = 'admission/religion';
       $this->load->view('common/common',$this->data);
    }
    
    public function add_religion()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('title');
            $data       = array(
                'title' =>$title
            );
            $this->CRUDModel->insert('religion',$data);
            $this->data['page_title']   = 'All Religions  | ECMS';
            $this->data['page']         = 'admission/religion';
            $this->load->view('common/common',$this->data);
            redirect('admin/religion');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_religion()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('religion_id'=>$id);
        $this->CRUDModel->deleteid('religion',$where);
        redirect('admin/religion');
	}
    
    public function section(){
        $this->data['programe_id'] = '';
        $this->data['sub_pro_id'] = '';
        $this->data['sec_id'] = '';
        
        if($this->input->post()):
            
            $section_id     = $this->input->post('section_id');
            $program_id     = $this->input->post('programe_id');
            $sub_id         = $this->input->post('sub_proId');
            $status         = $this->input->post('sec_status');
            
            $where = '';
            
            if($section_id):
                $where['sections.sec_id'] = $section_id;
            endif;
            
            if($program_id):
                $where['programes_info.programe_id'] = $program_id;
            endif;
            
            if($sub_id):
                $where['sub_programes.sub_pro_id'] = $sub_id;
            endif;
            
            if($status):
                $where['sections.status'] = $status;
            endif;
            
            $this->data['result']       = $this->AdmissionModel->searchsections('subject',$where);
            else:
             $this->data['result']       = $this->AdmissionModel->searchsections('subject');
        endif;
        
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
        $this->data['sub_program']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
        $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
        $this->data['section']      = $this->CRUDModel->dropDown('sections', ' Section ', 'sec_id', 'name');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));    
//       $this->data['result']       = $this->get_model->getsection();
       $this->data['page_title']   = 'All Sections| ECMS';
       $this->data['page']         = 'admission/section';
       $this->load->view('common/common',$this->data); 
    }
    
    
    public function groups()
    {
            $where_status = array('status'=>'On');
            $order['column']    = 'program_id';
            $order['order']     = 'asc';
            $this->data['sections']    = $this->CRUDModel->dropDown('sections', 'Select Section', 'sec_id', 'name',$where_status,$order);
            $config['base_url']         = base_url('admin/groups');
            $config['total_rows']       = count($this->get_model->get_where_pagination('student_group_allotment'));  
            $config['per_page']         = 10;
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
            $custom['column']    ='serial_no';
            $custom['order']     ='desc';          
            $this->data['result']    = $this->get_model->pagination($config['per_page'], $page,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Groups  | ECMS';
           $this->data['page']         = 'admission/groups';
           $this->load->view('common/common',$this->data);    
      // $this->data['result']       = $this->get_model->getgroups();
    }
    
	public function groups_inter()
    {
            $where_status = array('status'=>'On','program_id'=>'1');
            $this->data['sections']    = $this->CRUDModel->dropDown('sections', 'Select Section', 'sec_id', 'name',$where_status);
			
            $this->data['sec_id'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name'] = '';
            $this->data['college_no'] = '';
			
            if($this->input->post('search')):
            $sec_id       =  $this->input->post('sec_id');
            $student_name       =  $this->input->post('student_name');
            $father_name       =  $this->input->post('father_name');
            $college_no       =  $this->input->post('college_no');
            $like = '';
            $where = '';
             
            if(!empty($sec_id)):
                $where['sections.sec_id']   = $sec_id;
                $this->data['sec_id']       = $sec_id;
            endif;
            if(!empty($student_name)):
                $like['student_record.student_name']   = $student_name;
                $this->data['student_name']       = $student_name;
            endif;
            if(!empty($father_name)):
                $like['student_record.father_name']   = $father_name;
                $this->data['father_name']       = $father_name;
            endif;
            if(!empty($college_no)):
                $where['student_record.college_no']   = $college_no;
                $this->data['college_no']       = $college_no;
            endif;
                $this->data['result']       = $this->get_model->get_by_group_student('student_group_allotment',$where,$like);   
			endif;	
           $this->data['page_title']   = 'Year Head All Groups | ECMS';
           $this->data['page']         = 'admission/groups_inter';
           $this->load->view('common/common',$this->data);    
    }
	
    public function search_by_group_student(){
        $this->data['sections']    = $this->CRUDModel->dropDown('sections', 'Select Section ', 'sec_id', 'name');
       
        if($this->input->post('search')):
            $sec_id       =  $this->input->post('sec_id');
            $student_name       =  $this->input->post('student_name');
            $father_name       =  $this->input->post('father_name');
            $college_no       =  $this->input->post('college_no');
            
            $like = '';
            $where['s_status_id'] = '5';
            
            $this->data['sec_id'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name'] = '';
            $this->data['college_no'] = '';
             
            if(!empty($sec_id)):
                $where['sections.sec_id']   = $sec_id;
                $this->data['sec_id']       = $sec_id;
            endif;
            if(!empty($student_name)):
                $like['student_record.student_name']   = $student_name;
                $this->data['student_name']       = $student_name;
            endif;
            if(!empty($father_name)):
                $like['student_record.father_name']   = $father_name;
                $this->data['father_name']       = $father_name;
            endif;
            if(!empty($college_no)):
                $where['student_record.college_no']   = $college_no;
                $this->data['college_no']       = $college_no;
            endif;
        
                $this->data['result']       = $this->get_model->get_by_group_student('student_group_allotment',$where,$like);    
                $this->data['page']         = "admission/search_by_group_student";
                $this->data['title']        = 'Student List  | ECMS';
        
                 
                $this->load->view('common/common',$this->data); 
        
        elseif($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Students Group');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Form No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'Father Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('D1', 'College No');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('E1', 'Program');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'Section Name');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('G1', 'Gender');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
       for($col = ord('A'); $col <= ord('G'); $col++)
       {
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $sec_id       =  $this->input->post('sec_id');
            $student_name       =  $this->input->post('student_name');
            $father_name       =  $this->input->post('father_name');
            $college_no       =  $this->input->post('college_no');
            
            $like = '';
            $where = '';
            
            $this->data['sec_id'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name'] = '';
            $this->data['college_no'] = '';
            
        
            if(!empty($sec_id)):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if(!empty($student_name)):
                $like['student_record.student_name']   = $student_name;
                $this->data['student_name']       = $student_name;
            endif;
            if(!empty($father_name)):
                $like['student_record.father_name']   = $father_name;
                $this->data['father_name']       = $father_name;
            endif;
            if(!empty($college_no)):
                $where['student_record.college_no']   = $college_no;
                $this->data['college_no']       = $college_no;
            endif;
        
            $this->db->SELECT('
            student_record.form_no as form_no,
            student_record.student_name as student,
            student_record.father_name as father,
            student_record.college_no as college_no,
            sub_programes.name as sub_program,
            sections.name as section,
            gender.title as gender
            ');
            $this->db->FROM('student_group_allotment');
            $this->db->where($where);

            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $rs =  $this->db->get();
            $exceldata="";
            foreach ($rs->result_array() as $row)
            {
                $exceldata[] = $row;
            }      

            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename='Students_Group_List.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output');
            else:
                $this->data['sec_id'] = '';
            endif; 
        
    }
    
   public function add_student_by_group(){
        $id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
      
        if($this->input->post()):
              
        $student_id = $this->uri->segment(3);
        
        $secId = $this->input->post('section_id');
        
        if(!empty($secId)):
            $data = array(
                'section_id'=>$this->input->post('section_id'),
                'student_id'=>$student_id,
                'user_id'   =>$user_id
            );
            $where = array('student_id'=>$id);
           $this->CRUDModel->insert('student_group_allotment',$data,$where);
              redirect('admin/student_record'); 
              else:
                   redirect('admin/student_record'); 
        endif;
             
              endif;
        if($id):
                $where = array('student_record.student_id'=>$id);
                $this->data['result']       = $this->CRUDModel->get_where_row('student_record',$where);
                $this->data['page_title']   = 'Asign Group to Student | ECMS';
                $this->data['page']         =  'admission/adding_student_by_group';
                $this->load->view('common/common',$this->data);
        else:
            redirect('/');
            endif;
    }
    
    public function update_student_by_group()
    {
        $id = $this->uri->segment(3);
//        $session = $this->session->all_userdata();
//        $user_id =$session['userData']['user_id'];
            if($this->input->post()):
                
                          $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
            $user_details   =   $this->db->get_where('users',array('id'=>$this->userInfo->user_id))->row()->emp_name;

                
                
                $section_id         =  $this->input->post('section_id');
                $old_section_id     =  $this->input->post('old_section_id');
                $student_id         =  $this->input->post('student_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $data               =  array(
                    'section_id'    => $this->input->post('section_id'),
                    'up_timestamp'  => date('Y-m-d H:i:'),
                    'up_user_id'    => $this->userInfo->user_id);
                
                $where = array('serial_no'=>$id);
              
              $this->CRUDModel->update('student_group_allotment',$data,$where);
			  if($section_id != $old_section_id):
				$old_s = $old_section_id;
                            else:
					$old_s = 'NULL';	
				endif;
			$data_log = array(
                   'student_id'=>$id,
                    'comments'            => 'Update By '.$user_details.' Id :'.$this->userInfo->user_id,
                   'section_id'=>$old_s,
                   'date'=>date('Y-m-d'),
                    'timestamp'=>date('Y-m-d H:i:'),
                   'user_id'=>$this->userInfo->user_id
                );
            $this->CRUDModel->insert('student_group_allotment_log',$data_log);
			  $where = array('student_id'=>$student_id);
			  $this->db->where_in('student_record.sub_pro_id',array('4','5','26','27'));
			  $this->db->where($where);
			  $q = $this->db->get('student_record')->row();
			 // echo '<pre>';print_r($q);die;
			  if(empty($q)):
					redirect('admin/groups');
				else:
					redirect('admin/student_updassign_subjects_of_group/'.$student_id.'/'.$sub_pro_id);	
              endif;
         endif;
            if($id):
                $where = array('student_group_allotment.serial_no'=>$id);
                $this->data['result'] = $this->get_model->get_Studentgroup_row('student_group_allotment',$where);
                $this->data['page_title']        = 'Update Student By Group | ECMS';
                $this->data['page']        =  'admission/update_student_by_group';
                $this->load->view('common/common',$this->data);
            endif;
    }
	
	public function update_student_by_group_inter()
    {
        $id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            
             $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
            $user_details   =   $this->db->get_where('users',array('id'=>$this->userInfo->user_id))->row()->emp_name;
            
            
			$section_id = $this->input->post('section_id');
			$old_section_id = $this->input->post('old_section_id');
			$student_id = $this->input->post('student_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
            $data = array(
                'section_id'=>$section_id,
                'up_timestamp'=>date('Y-m-d H:i:'),
                'up_user_id'=>$user_id
            );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('student_group_allotment',$data,$where);
              if($section_id != $old_section_id):
				$old_s = $old_section_id;
				else:
					$old_s = 'NULL';
				endif;
			$data_log = array
                (
                   'student_id'=>$student_id,
                   'section_id'=>$old_s,
                   'date'=>date('Y-m-d'),
                   'comments'      => 'Update From admin/update_student_by_group_inter By '.$user_details.' Id :'.$this->userInfo->user_id,
		   'timestamp'=>date('Y-m-d H:i:'),
                   'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_group_allotment_log',$data_log);

			  $where = array('student_id'=>$student_id);
			  $this->db->where_in('student_record.sub_pro_id',array('5','27'));
//			  $this->db->where_in('student_record.sub_pro_id',array('4','5','26','27'));
			  $this->db->where($where);
			  $q = $this->db->get('student_record')->row();
			  if(empty($q)):
					redirect('admin/student_group_inter');
				else:
					redirect('admin/student_updassign_subjects_of_group/'.$student_id.'/'.$sub_pro_id);	
              endif;
         endif; 
		if($id):
                $where = array('student_group_allotment.serial_no'=>$id);
                $this->data['result'] = $this->get_model->get_Studentgroup_row('student_group_allotment',$where);
                $this->data['page_title']        = 'Update Student By Group | ECMS';
                $this->data['page']        =  'admission/update_student_by_group_inter';
                $this->load->view('common/common',$this->data);
            endif;
    }
    
     
    public function update_degreestudent_by_group(){
        $id         = $this->uri->segment(3);
        $session    = $this->session->all_userdata();
        $user_id    =$session['userData']['user_id'];
        if($this->input->post()):
            
            $student_id = $this->input->post('student_id');
        
            $data       = array(
            'section_id'    =>$this->input->post('section_id'),
			'up_timestamp'  => date('Y-m-d H:i:'),
            'up_user_id'   =>$user_id
            );
              $where    = array('serial_no'=>$id);
              $this->CRUDModel->update('student_group_allotment',$data,$where);
              
                $whereUpDate = array('section_id'=>$this->input->post('section_id'));
                $UpDate = array('student_id'=>$student_id);
                $this->CRUDModel->update('student_group_allotment',$UpDate,$whereUpDate);
                
              redirect('admin/degree_students'); 
              endif;
            if($id):
                $where = array('student_group_allotment.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('student_group_allotment',$where);

                $this->data['page_title']        = 'Update Degree Student By Group | ECMS';
                $this->data['page']        =  'admission/update_degreestudent_by_group';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
    public function group_allotment($start=0)
    {
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit  ', 'limitId', 'limit_value');
            $where               = array('s_status_id'=>'5');
            //pagination start
            $config['base_url']         = base_url('admin/group_allotment');
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
            $this->data['result']    = $this->CRUDModel->pagination($config['per_page'], $page,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Student Records  | ECMS';
           $this->data['page']         = 'admission/group_student_record';
           $this->load->view('common/common',$this->data); 
    }
    
    public function add_section()
	{	
       if($this->input->post()):
            $name      = $this->input->post('name');
            $sub_pro_id      = $this->input->post('sub_pro_id');
            $seats_allowed      = $this->input->post('seats_allowed');
            $status      = $this->input->post('status');
            $batch_id      = $this->input->post('batch_id');
            $program_id      = $this->input->post('program_id');
            $data       = array(
                'name' =>$name,
                'sub_pro_id' =>$sub_pro_id,
                'seats_allowed' =>$seats_allowed,
                'status' =>$status,
                'batch_id' =>$batch_id,
                'program_id' =>$program_id
            );
            $this->CRUDModel->insert('sections',$data);
            $this->data['page_title']   = 'All Sections  | ECMS';
            $this->data['page']         = 'admission/section';
            $this->load->view('common/common',$this->data);
            redirect('admin/section');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_section()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('sec_id'=>$id);
        $this->CRUDModel->deleteid('sections',$where);
        redirect('admin/section');
	}
    
    public function reserved_seats()
    {
       $this->data['result']       = $this->CRUDModel->getResults('reserved_seat');
       $this->data['page_title']   = 'All Reserved Seats | ECMS';
       $this->data['page']         = 'admission/reserved_seats';
       $this->load->view('common/common',$this->data); 
    }
    
    public function add_seat()
	{	
	   if($this->input->post()):
            $name      = $this->input->post('name');
            $data       = array(
                'name' =>$name
            );
            $this->CRUDModel->insert('reserved_seat',$data);
            $this->data['page_title']   = 'All Reserved Seats  | ECMS';
            $this->data['page']         = 'admission/reserved_seats';
            $this->load->view('common/common',$this->data);
            redirect('admin/reserved_seats');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_seat()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('rseat_id'=>$id);
        $this->CRUDModel->deleteid('reserved_seat',$where);
        redirect('admin/reserved_seats');
	}
    
    public function reserved_seats_detail()
    {
       $this->data['result']       = $this->CRUDModel->getResults('reserved_seats_details');
       $this->data['page_title']   = 'All Reserved Seats Detail | ECMS';
       $this->data['page']         = 'admission/reserved_seats_detail';
       $this->load->view('common/common',$this->data);   
    }
    
    public function add_seat_detail()
	{	
	   if($this->input->post()):
            $rseat_id      = $this->input->post('rseat_id');
            $sub_pro_id      = $this->input->post('sub_pro_id');
            $seats_allowed      = $this->input->post('seats_allowed');
            $status      = $this->input->post('status');
            $shift_id      = $this->input->post('shift_id');
            $comment      = $this->input->post('comment');
            $data       = array(
                'rseat_id' =>$rseat_id,
                'sub_pro_id' =>$sub_pro_id,
                'seats_allowed' =>$seats_allowed,
                'status'=>$status,
                'shift_id'=>$shift_id,
                'comment'=>$comment
            );
            $this->CRUDModel->insert('reserved_seats_details',$data);
            $this->data['page_title']   = 'All Reserved Seats Detail  | ECMS';
            $this->data['page']         = 'admission/reserved_seats_detail';
            $this->load->view('common/common',$this->data);
            redirect('admin/reserved_seats_detail');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_seat_detail()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('serial_no'=>$id);
        $this->CRUDModel->deleteid('reserved_seats_details',$where);
        redirect('admin/reserved_seats_detail');
	}
    
    public function prospectus_batch()
    {
         
        if($this->input->post()):
            
            $batch_id     = $this->input->post('ProsBatch');
            $program_id     = $this->input->post('program_id');
              $where = '';
            if($batch_id):
                $where['prospectus_batch.batch_name'] = $batch_id;
            endif;
            
            if($program_id):
                $where['programes_info.programe_id'] = $program_id;
            endif;
            
//            if($sub_id):
//                $where['sub_programes.sub_pro_id'] = $sub_id;
//            endif;
            
            $this->data['result']       = $this->AdmissionModel->searchbatches('prospectus_batch',$where);
            else:
             $this->data['result']       = $this->AdmissionModel->searchbatches('prospectus_batch');
        endif;
        
       $this->data['page_title']   = 'All Prospectus Batches| ECP';
       $this->data['page']         = 'admission/prospectus_batch';
       $this->load->view('common/common',$this->data);
    }
    
    public function add_prospectus_batch()
	{	
	   if($this->input->post()):
            $batch_name      = $this->input->post('batch_name');
            $prospectus_amount      = $this->input->post('prospectus_amount');
            $status      = $this->input->post('status');
            $date_of_issuance      = $this->input->post('date_of_issuance');
            $programe_id      = $this->input->post('programe_id');
            $lang_spro_id      = $this->input->post('lang_spro_id');
            $data = array(
                'batch_name' =>$batch_name,
                'prospectus_amount' =>$prospectus_amount,
                'status'=>$status,
                'date_of_issuance'=>$date_of_issuance,
                'programe_id'=>$programe_id,
                'lang_spro_id'=>$lang_spro_id
            );
            $this->CRUDModel->insert('prospectus_batch',$data);
            $this->data['page_title']   = 'All Batch Prospectuses | ECMS';
            $this->data['page']         = 'admission/prospectus_batch';
            $this->load->view('common/common',$this->data);
            redirect('admin/prospectus_batch');
         
        endif;
	}
    
    public function delete_p_batch()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('batch_id'=>$id);
        $this->CRUDModel->deleteid('prospectus_batch',$where);
        redirect('admin/prospectus_batch');
	}
    
    public function prospectus_sale()
    {   
       $this->data['result']       = $this->CRUDModel->getResults('prospectus_sale');
       $this->data['page_title']   = 'All Prospectus Sales | ECMS';
       $this->data['page']         = 'admission/prospectus_sale';
       $this->load->view('common/common',$this->data);
    }
    
    public function add_prospectus_sale()
	{	
	   if($this->input->post()):
            $date      = $this->input->post('date');
            $total_pros_issue      = $this->input->post('total_pros_issue');
            $total_amount      = $this->input->post('total_amount');
            $batch_id      = $this->input->post('batch_id');
            $data       = array(
                'date' =>$date,
                'total_pros_issue' =>$total_pros_issue,
                'total_amount'=>$total_amount,
                'batch_id'=>$batch_id
            );
            $this->CRUDModel->insert('prospectus_sale',$data);
            $this->data['page_title']   = 'All Prospectus Sales  | ECMS';
            $this->data['page']         = 'admission/prospectus_sale';
            $this->load->view('common/common',$this->data);
            redirect('admin/prospectus_sale');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_p_sale()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('sale_id'=>$id);
        $this->CRUDModel->deleteid('prospectus_sale',$where);
        redirect('admin/prospectus_sale');
	}
    
    public function subject()
    {
       $this->data['result']       = $this->CRUDModel->getResults('subject');
       $this->data['page_title']   = 'All Subjects | ECMS';
       $this->data['page']         = 'admission/subject';
       $this->load->view('common/common',$this->data); 
    }
    
    public function add_subject()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('title');
            $data       = array(
                'title' =>$title
            );
            $this->CRUDModel->insert('subject',$data);
            $this->data['page_title']   = 'All Subjects  | ECMS';
            $this->data['page']         = 'admission/subject';
            $this->load->view('common/common',$this->data);
            redirect('admin/subject');
          else:
              redirect('/');
        endif;
	}
    
    public function delete_subject()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('subject_id'=>$id);
        $this->CRUDModel->deleteid('subject',$where);
        redirect('admin/subject');
	}

    public function shift()
    {
       $this->data['result']       = $this->CRUDModel->getResults('shift');
       $this->data['page_title']   = 'All Shifts | ECMS';
       $this->data['page']         = 'admission/shift';
       $this->load->view('common/common',$this->data);  
    }
    
    public function s_status()
    {
       $this->data['result']       = $this->get_model->gets_status();
       $this->data['page_title']   = 'All Student Status | ECMS';
       $this->data['page']         = 'admission/student_status';
       $this->load->view('common/common',$this->data); 
    } 
    
    public function add_s_status()
	{	
	   if($this->input->post()):
            $title      = $this->input->post('name');
            $data       = array(
                'name' =>$title
            );
            $this->CRUDModel->insert('student_status',$data);
            $this->data['page_title']   = 'All Student Status  | ECMS';
            $this->data['page']         = 'admission/student_status';
            $this->load->view('common/common',$this->data);
            redirect('admin/student_status');
          else:
              redirect('/');
        endif;
	}
    
    public function student_record(){
        $whereSub_pro = array('programe_id'=>1);
        
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
        $this->data['reserved_seat'] = $this->CRUDModel->dropDown('reserved_seat', 'Admission Alloted in', 'rseat_id', 'name');  
        $this->data['status']       = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
        $this->data['shift']        = $this->CRUDModel->dropDown('shift', 'Select Shift', 'shift_id', 'name');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
        $like = '';
        $where = '';
        $this->data['batchId']      = '';
        $this->data['college_no']   = '';
        $this->data['form_no']      = '';
        $this->data['student_name'] = '';
        $this->data['father_name']  = '';
        $this->data['gender_id']    = '';
        $this->data['sub_pro_id']   = '';
        $this->data['rseats_id']    = '';
        $this->data['s_status_id']  = '';
        $this->data['shft_id']      = '';
            
        if($this->input->post('search')):
            $college_no     =  $this->input->post('college_no');
            $form_no        =  $this->input->post('form_no');
            $student_name   =  $this->input->post('student_name');
            $father_name    =  $this->input->post('father_name');
            $gender_id      =  $this->input->post('gender_id');
            $sub_pro_id     =  $this->input->post('sub_pro_id');
            $rseats_id      =  $this->input->post('rseats_id');
            $s_status_id    =  $this->input->post('s_status_id');
            $batch          =  $this->input->post('batch');
            $shift          =  $this->input->post('shift');
            $limit          =  $this->input->post('limit');
          
            
            
            $where['student_record.programe_id'] = 1;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($shift)):
                $where['shift.shift_id'] = $shift;
                $this->data['shft_id']  = $shift;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.programe_id'=>1);
        $config['base_url']   = base_url('admin/student_record');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
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
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
        $this->data['pages']        = $this->pagination->create_links();          
        $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count']     =$config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Students Record (Inter Level) | ECMS';
        $this->data['page']         = 'admission/student_record';
        $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record Inter Level');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'S No.');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
            
            $this->excel->getActiveSheet()->setCellValue('B1', 'Clg No.');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
            
            $this->excel->getActiveSheet()->setCellValue('C1', 'Form No.');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1','Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1', 'Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Gender');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Admission Alloted in');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Board Reg No');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Shift');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Section');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Student status');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Mobile Number');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Domicile');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('T1','Religion');
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('T'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $batch              =  $this->input->post('batch');
            $shift              =  $this->input->post('shift');
           $like = '';
            $where = '';
          $where['student_record.programe_id'] = 1;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($shift)):
                $where['shift.shift_id'] = $shift;
                $this->data['shft_id']  = $shift;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_InterLevel.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
    }
    
    
    public function all_student_record()
    {
        $this->data['gender'] = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['program'] = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['sub_program'] = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['reserved_seat'] = $this->CRUDModel->dropDown('reserved_seat', 'Admission Alloted in', 'rseat_id', 'name');  
        $this->data['status'] = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
        $this->data['batch'] = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name');
        
        $like = '';
            $where = '';
            $this->data['batchId']    = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['programe_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            
        if($this->input->post('search')):
            $college_no    =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name  =  $this->input->post('student_name');
            $father_name   =  $this->input->post('father_name');
            $gender_id     =  $this->input->post('gender_id');
            $sub_pro_id    =  $this->input->post('sub_pro_id');
            $programe_id   =  $this->input->post('programe_id');
            $rseats_id     =  $this->input->post('rseats_id');
            $s_status_id   =  $this->input->post('s_status_id');
            $batch         =  $this->input->post('batch');
          
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.s_status_id'=>5);
        $config['base_url']   = base_url('admin/all_student_record');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
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
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
        $this->data['pages'] = $this->pagination->create_links();          
        $this->data['result'] = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count'] =$config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Admin All Students Record | ECMS';
        $this->data['page']         = 'admission/all_student_record';
        $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Admin All Students Record');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'F.No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Father name');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Clg #');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Gender');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Reserved Seats');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Section');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Student status');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Mobile Number');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Domicile');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Hostel Allotted');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('T1','Fata School');
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('T'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $programe_id         =  $this->input->post('programe_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id          =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
            $like = '';
            $where = '';
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='AdminAll_StudentsRecord.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
    }
    
    public function adding_picture(){       
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit  ', 'limitId', 'limit_value');
            $config['base_url']         = base_url('Admin/adding_picture');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5)));  
            $config['per_page']         = 50;
            $config["num_links"]        = 3;
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
            $this->data['result']    = $this->get_model->admin_stdData($config['per_page'], $page,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'Adding Pictures  | ECMS';
           $this->data['page']         = 'admission/adding_picture';
           $this->load->view('common/common',$this->data);
       
    }
  
    public function a_level_student_record(){
            
            $whereSub_pro                   = array('programe_id'=>5);
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
            $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
            $this->data['status']           = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
            $like                           = '';
            $where                          = '';
            $this->data['batchId']          = '';
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['gender_id']        = '';
            $this->data['sub_pro_id']       = '';
            $this->data['rseats_id']        = '';
            $this->data['s_status_id']      = '';
        if($this->input->post('search')):
            $college_no                     =  $this->input->post('college_no');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender_id                      =  $this->input->post('gender_id');
            $sub_pro_id                     =  $this->input->post('sub_pro_id');
            $rseats_id                      =  $this->input->post('rseats_id');
            $s_status_id                    =  $this->input->post('s_status_id');
            $batch                          =  $this->input->post('batch');
           
            $where['student_record.programe_id'] = 5;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where                      = array('student_record.programe_id'=>5,'student_record.s_status_id'=>5);
        $config['base_url']         = base_url('admin/a_level_student_record');
        $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
        $config['per_page']         = 50;
        $config["num_links"]        = 2;
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

        $this->pagination->initialize($config);
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
        $this->data['pages']        = $this->pagination->create_links();
        $order['column']            = 'student_record.student_id';
        $order['order']             = 'desc';
        $this->data['result']       = $this->get_model->stds_pagination($config['per_page'], $page,$where,$order);
        $this->data['count']        = $config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Students Record (A Level) | ECMS';
        $this->data['page']         = 'admission/a_level_student_record';
        $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record A Level');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No#');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form.No');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1','Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1', 'Father name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Gender');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Reserved Seats');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

//            $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
//            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
//            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Shift');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Section');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Student status');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Mobile Number');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
 
            $this->excel->getActiveSheet()->setCellValue('R1','Domicile');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
 

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
            
    
                
       for($col = ord('A'); $col <= ord('T'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id          =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
            $like = '';
            $where = '';
            $where['student_record.programe_id'] = 5;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_ALevel.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
    } 
    
    public function law_student_record(){
        $whereSub_pro = array('programe_id'=>9);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',$whereSub_pro);
		$this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
		$this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
		$this->data['batch']   = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
        $like = '';
            $where = '';
			$this->data['batchId']          = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
           
            $where['student_record.programe_id'] = 9;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.programe_id'=>9,'student_record.s_status_id'=>5);
        $config['base_url']   = base_url('admin/law_student_record');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
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
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
        $this->data['pages']        = $this->pagination->create_links();          
        $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count']     =$config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Students Record (BS LAW) | ECMS';
        $this->data['page']         = 'admission/law_student_record';
        $this->load->view('common/common',$this->data);
        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record Law');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form No');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'tudent Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Gender');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Seat');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Shift');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Section');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Student status');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Mobile No#');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Domicle');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);

//            $this->excel->getActiveSheet()->setCellValue('T1','Fata School');
//            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
//            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('T'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id          =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
            $like = '';
            $where = '';
            $where['student_record.programe_id'] = 9;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_BSLAW.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
    }
    public function law_student_record_readonly(){
        $whereSub_pro = array('programe_id'=>9);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',$whereSub_pro);
		$this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
		$this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
		$this->data['batch']   = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
        $like = '';
            $where = '';
			$this->data['batchId']          = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
           
            $where['student_record.programe_id'] = 9;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.programe_id'=>9,'student_record.s_status_id'=>5);
        $config['base_url']   = base_url('LawRecordReadOnly');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
        $config['per_page']         = 50;
        $config["num_links"]        = 2;
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
        $page = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
        $this->data['pages']        = $this->pagination->create_links();          
        $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count']     =$config['total_rows']; 
        endif;
   
       
        
        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record Law');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form No');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'tudent Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Gender');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Seat');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Shift');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Section');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Student status');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Mobile No#');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Domicle');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);

//            $this->excel->getActiveSheet()->setCellValue('T1','Fata School');
//            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
//            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('T'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id          =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
            $like = '';
            $where = '';
            $where['student_record.programe_id'] = 9;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_BSLAW.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
        
        $this->data['page_title']       = 'Students Record (BS LAW) ReadOnly | ECMS';
        $this->data['page_header']      = 'Students Record (BS LAW) ReadOnly';
        $this->data['page']             = 'admission/law/law_student_record_readonly';
        $this->load->view('common/common',$this->data);
    }
    
    public function print_law_student_record()
    {
        $whereSub_pro = array('programe_id'=>9);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
		$this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
		$this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
		$this->data['batch']   = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
        $like = '';
            $where = '';
			$this->data['batchId']          = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
           
            $where['student_record.programe_id'] = 9;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.programe_id'=>9,'student_record.s_status_id'=>5);
        $config['base_url']   = base_url('admin/print_law_student_record');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
        $config['per_page']         = 300;
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
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
        $this->data['pages']        = $this->pagination->create_links();          
        $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count']     =$config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Students Record (BS LAW) | ECMS';
        $this->data['page']         = 'admission/print_law_student_record';
        $this->load->view('common/common',$this->data);
    } 
    
    public function bs_english_student_record()
    {
        $whereSub_pro                   = array('programe_id'=>8);
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',$whereSub_pro);
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Admission Alloted ', 'rseat_id', 'name');  
        $this->data['status']           = $this->CRUDModel->dropDown('student_status', ' Admission ', 's_status_id', 'name');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
        $like = '';
            $where = '';
			$this->data['batchId']          = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
           
            $where['student_record.programe_id'] = 8;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.programe_id'=>8,'student_record.s_status_id'=>5);
        $config['base_url']   = base_url('admin/bs_english_student_record');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
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
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
        $this->data['pages']        = $this->pagination->create_links();          
        $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count']     =$config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Students Record (BS English) | ECMS';
        $this->data['page']         = 'admission/bs_english_student_record';
        $this->load->view('common/common',$this->data);
        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record BS English');
            //set cell A1 content with some text
            
             $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form No');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Gender');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Seat');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Shift');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Section');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Student status');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Mobile No#');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Domicle');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
                
       for($col = ord('A'); $col <= ord('T'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id          =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
            $like = '';
            $where = '';
            $where['student_record.programe_id'] = 8;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_BSEnglish.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
    }
    
    public function economics_student_record()
    {
        $whereSub_pro = array('programe_id'=>14);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',$whereSub_pro);
		$this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
		$this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
		$this->data['batch']   = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
        $like = '';
            $where = '';
			$this->data['batchId']          = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
           
            $where['student_record.programe_id'] = 14;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.programe_id'=>14,'student_record.s_status_id'=>5);
        $config['base_url']   = base_url('admin/economics_student_record');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
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
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
        $this->data['pages']        = $this->pagination->create_links();          
        $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count']     =$config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Students Record (BS Economics) | ECMS';
        $this->data['page']         = 'admission/economics/form/economics_student_record';
        $this->load->view('common/common',$this->data);
        if($this->input->post('export')):    
            
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record BS Economics');
             $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form No');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Gender');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Seat');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Shift');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Section');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Student status');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Mobile No#');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Domicle');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('T'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id          =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
            $like = '';
            $where = '';
            $where['student_record.programe_id'] = 14;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_BSEconomics.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
    }
    
    public function eng_medical_students()
    {       
            $this->data['limit'] = $this->CRUDModel->dropDown('show_limit', ' Select Limit  ', 'limitId', 'limit_value');
        $where = array('student_record.programe_id'=>'1');
        $where = array('student_record.s_status_id'=>'5');
            $config['base_url']         = base_url('admin/eng_medical_students');
            $config['total_rows']       = count($this->get_model->gets_count_pagination('student_record',$where));  
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
            $this->data['result']    = $this->get_model->stds_eng_med_pagination($config['per_page'], $page,$where,$custom);
           $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Engineering/Medical Students  | ECMS';
           $this->data['page']         = 'admission/eng_medical_student_record';
           $this->load->view('common/common',$this->data); 
    }
    
    public function degree_students()
    {       
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit  ', 'limitId', 'limit_value');
        $where = array('student_record.programe_id'=>'4','student_record.s_status_id'=>'5');
        
            $config['base_url']         = base_url('admin/degree_students');
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
            $this->data['result']    = $this->get_model->degree_stds_pagination($config['per_page'], $page,$where,$custom);
           $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Degree Students  | ECMS';
           $this->data['page']         = 'admission/degreestudent_record';
           $this->load->view('common/common',$this->data); 
    }
    
 
    public function student_assign_subjects(){
        $id                         = $this->uri->segment(3);
        $sub_pro_id                 = $this->uri->segment(4);
        $where                      = array('student_id'=>$id);
        $subpro_where               = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result']       = $this->CRUDModel->get_where_row('student_record', $where);
        $order['order'] = 'asc';
        $order['column'] = 'title';
        $this->data['subjects']     = $this->CRUDModel->get_where_result_order('subject', $subpro_where,$order);
       
        $this->data['sectionsName']    = $this->CRUDModel->dropDown('sections', 'Select section ', 'sec_id', 'name',array('program_id'=>1,'status'=>'On'));
        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
        $this->data['sectionsId'] = '';
        if($this->data['section']):
            $this->data['sectionsId'] =$this->data['section']->section_id; 
            endif;
     
        $this->data['page_title']   = 'Student Assign Subjects  | ECMS';
       $this->data['page']          = 'admission/student_assign_subjects';
       $this->load->view('common/common',$this->data);
    }
    public function eng_med_assign_subjects()
    {
        $id         = $this->uri->segment(3);
        $sub_pro_id         = $this->uri->segment(4);
        $where      = array('student_id'=>$id);
        $subpro_where      = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['subjects'] = $this->CRUDModel->get_where_result('subject', $subpro_where);
        $this->data['page_title']   = 'Eng/Med Student Assign Subjects  | ECMS';
       $this->data['page']         = 'admission/eng_med_assign_subjects';
       $this->load->view('common/common',$this->data);
    }
    
 
    
    public function degree_std_assign_subjects(){
        $id             = $this->uri->segment(3);
        $sub_pro_id     = $this->uri->segment(4);
        $where      = array('student_id'=>$id);
        $subpro_where      = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
        $this->data['subjects'] = $this->CRUDModel->get_where_result('subject', $subpro_where);
        $this->data['page_title']   = 'Degree Student Assign Subjects | E';
       $this->data['page']         = 'admission/degree_std_assign_subjects';
       $this->load->view('common/common',$this->data);
    }
    
    public function student_updassign_subjects()
    {
        $id                 = $this->uri->segment(3);
        $sub_pro_id         = $this->uri->segment(4);
        $where              = array('student_id'=>$id);
        $subpro_where       = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
        $this->data['selectsubjects'] = $this->CRUDModel->get_where_result('student_subject_alloted', $where);
        $this->data['subjects'] = $this->CRUDModel->get_where_result('subject', $subpro_where);
        
        $this->data['page_title']   = 'Student Assign Subjects  | ECMS';
       $this->data['page']         = 'admission/student_updassing_subjects';
       $this->load->view('common/common',$this->data);
    }
	
	public function student_updassign_subjects_of_group()
    {
        $id                 = $this->uri->segment(3);
        $sub_pro_id         = $this->uri->segment(4);
        $where              = array('student_id'=>$id);
        $subpro_where       = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
        $this->data['selectsubjects'] = $this->CRUDModel->get_where_result('student_subject_alloted', $where);
        $this->data['subjects'] = $this->CRUDModel->get_where_result('subject', $subpro_where);
        $this->data['page_title']   = 'Update Degree Student Assigned Subjects | ECMS';
       $this->data['page']         = 'admission/student_updassign_subjects_of_group';
       $this->load->view('common/common',$this->data);
    }
    
    public function student_assign_update_subjects()
    {
        $id                 = $this->uri->segment(3);
        $sub_pro_id         = $this->uri->segment(4);
        $where              = array('student_id'=>$id);
        $subpro_where       = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['selectsubjects'] = $this->CRUDModel->get_where_result('student_subject_alloted', $where);
        $this->data['subjects'] = $this->CRUDModel->get_where_result('subject', $subpro_where);
        $this->data['page_title']   = 'Update Student Assign Subjects  | ECMS';
       $this->data['page']         = 'admission/student_assign_update_subjects';
       $this->load->view('common/common',$this->data);
    }
    
//    public function degree_std_updassign_subjects()
//    {
//        $id                 = $this->uri->segment(3);
//        $sub_pro_id         = $this->uri->segment(4);
//        $where              = array('student_id'=>$id);
//        $subpro_where       = array('sub_pro_id'=>$sub_pro_id);
//        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
//        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
//        $this->data['selectsubjects'] = $this->CRUDModel->get_where_result('student_subject_alloted', $where);
//        $this->data['subjects'] = $this->CRUDModel->get_where_result('subject', $subpro_where);
//        $this->data['page_title']   = 'Update Degree Student Assigned Subjects  | ECMS';
//       $this->data['page']         = 'admission/degree_std_updassign_subjects';
//       $this->load->view('common/common',$this->data);
//    }
    
      public function degree_std_updassign_subjects()
    {
        $id                 = $this->uri->segment(3);
        $sub_pro_id         = $this->uri->segment(4);
        $where              = array('student_id'=>$id);
        $subpro_where       = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
        $this->data['selectsubjects'] = $this->CRUDModel->get_where_result('student_subject_alloted', $where);
        $this->data['subjects'] = $this->CRUDModel->get_where_result('subject', $subpro_where);
        $this->data['page_title']   = 'Update Degree Student Assigned Subjects | ECMS';
       $this->data['page']         = 'admission/degree_std_updassign_subjects';
       $this->load->view('common/common',$this->data);
    }
	
	public function degree_std_updassign_subjects_of_group()
	{
		$id                 = $this->uri->segment(3);
        $sub_pro_id         = $this->uri->segment(4);
        $where              = array('student_id'=>$id);
        $subpro_where       = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
        $this->data['selectsubjects'] = $this->CRUDModel->get_where_result('student_subject_alloted', $where);
        $this->data['subjects'] = $this->CRUDModel->get_where_result('subject', $subpro_where);
        $this->data['page_title']   = 'Update Degree Student Assigned Subjects | ECMS';
       $this->data['page']         = 'admission/degree_std_updassign_subjects_of_group';
       $this->load->view('common/common',$this->data);
    }
    
	public function hnd_student_record(){       
        
		$this->data['program']          = $this->get_model->batch_dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
                $this->data['subprogrames']     = $this->get_model->batch_dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
		$this->data['batch']            = $this->get_model->batch_dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
     
		$this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
		$this->data['reserved_seat']= $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
		$this->data['status']    	= $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
                $this->data['limit']        = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
       
			$like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
			$this->data['programId']        = '';
			$this->data['subprogramId']     = '';
			$this->data['batchId']          = '';
	   
	   if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('program');
            $sub_program         =  $this->input->post('sub_program');
			$batch               =  $this->input->post('batch');
            
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
        
                $this->data['result']   = $this->get_model->get_hndstdData('student_record',$where,$like,$custom);
			else:
			$where               = array('student_record.programe_id'=>'3','student_record.s_status_id'=>'5');
            //pagination start
            $config['base_url']         = base_url('admin/hnd_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 100;
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
            $this->data['result']    = $this->get_model->stds_hnd_pagination($config['per_page'], $page,$where,$custom);
			 $this->data['count']     =$config['total_rows']; 
			endif;
           if($this->input->post('export')):
                
				 $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('program');
            $sub_program         =  $this->input->post('sub_program');
			$batch               =  $this->input->post('batch');
            
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
                $this->excel->getActiveSheet()->setTitle('Merit list');
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
            $result   = $this->get_model->get_meritlistExport($field,'student_record',$where,$like,$custom);
			foreach ($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='HND_Department_meritList2017.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
			endif;
           $this->data['page_title']   = 'All Student Records | ECMS';
           $this->data['page']         = 'admission/student_hnd_record';
           $this->load->view('common/common',$this->data);
		   
       
    }
    
    public function cs_student_record()
    {
        $whereSub_pro = array('programe_id'=>2);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',$whereSub_pro);
		$this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
		$this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
		$this->data['batch']   = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
        $like = '';
            $where = '';
			$this->data['batchId']          = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
           
            $where['student_record.programe_id'] = 2;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.programe_id'=>2,'student_record.s_status_id'=>5);
        $config['base_url']   = base_url('admin/student_record');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
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
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
        $this->data['pages']        = $this->pagination->create_links();          
        $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count']     =$config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Students Record (BCS) | ECMS';
        $this->data['page']         = 'admission/cs_student_record';
        $this->load->view('common/common',$this->data);
        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record BCS');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'Sn');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form#');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Gender');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Reserved Seats');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Shift');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Section');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Student Status');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Applicant Mobile #');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Parmanent Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Domicile');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);

                
       for($col = ord('A'); $col <= ord('S'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $batch              =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
            $like = '';
            $where = '';
            $where['student_record.programe_id'] = 2;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_BCS.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
    }
    
    public function student_group(){
//            $session = $this->session->all_userdata();
//            $user_id =$session['userData']['user_id']; 
             $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Select Sub Program ', 'sub_pro_id', 'name');
             $this->data['program']     =  $this->CRUDModel->dropDown('programes_info', 'Select Program ', 'programe_id', 'programe_name');
            $this->data['gender']       =  $this->CRUDModel->dropDown('gender', 'Select Gender ', 'gender_id', 'title');
            $order_batch['column']      = 'batch_name';
            $order_batch['order']       = 'asc';
            $this->data['batch']        =  $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch ', 'batch_id', 'batch_name',array('status'=>'On'),$order_batch);
            $order_section['column']    = 'program_id';
            $order_section['order']     = 'asc';
            $this->data['section']      =  $this->CRUDModel->dropDown('sections', 'Select Section ', 'sec_id', 'name',array('status'=>'On'),$order_section);
            $this->data['shift']            = $this->CRUDModel->dropDown('shift', 'Select Shift ', 'shift_id', 'name');
            $student_name               =  $this->input->post('student_name');
            $father_name                =  $this->input->post('father_name');
            $college_no                 =  $this->input->post('college_no');
            $batch_id                   =  $this->input->post('batch_id');
            $sub_pro_id                 =  $this->input->post('sub_pro_id');
            $programe_id                =  $this->input->post('programe_id');
            $gender_id                  =  $this->input->post('gender_id');
            $limit                      =  $this->input->post('limit');
            $shift                      =  $this->input->post('shift');
            
            $where = '';
            $like = '';
            $this->data['student_name']     = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['college_no']       = '';
            $this->data['batch_id']         = '';
            $this->data['sub_pro_id']       = '';
            $this->data['programe_id']      = '';
            $this->data['gender_id']        = '';
            $this->data['shift_id']        = '';
            $this->data['limit']            = '';
            
            $where['student_record.s_status_id'] = 5;
            $where['student_record.flag'] = 0;
            
            if($this->input->post('search')):
                if(!empty($student_name)):
                    $like['student_record.student_name'] = $student_name;
                    $this->data['student_name']  = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['student_record.father_name'] = $father_name;
                    $this->data['father_name']  = $father_name;
                endif;
                if(!empty($college_no)):
                    $where['student_record.college_no'] = $college_no;
                    $this->data['college_no']  = $college_no;
                endif;
                if(!empty($batch_id)):
                    $where['prospectus_batch.batch_id'] = $batch_id;
                    $this->data['batch_id']  = $batch_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                    $this->data['sub_pro_id']  = $sub_pro_id;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id'] = $programe_id;
                    $this->data['programe_id']           = $programe_id;
                endif;
                if(!empty($gender_id)):
                    $where['gender.gender_id'] = $gender_id;
                    $this->data['gender_id']  = $gender_id;
                endif;
                if(!empty($shift)):
                    $where['shift.shift_id']        = $shift;
                    $this->data['shift_id']         = $shift;
                endif;
                
//                echo '<pre>';print_r($this->input->post());die;
                $this->data['result']   = $this->get_model->search_student_group('student_record',$where,$like,$limit);
            endif;
            if($this->input->post('save')):
            
            $ides = $this->input->post('checked');
            $sec_id = $this->input->post('sec_id');
        
            foreach($ides as $row=>$value):
            
                
                $this->CRUDModel->update('student_record',array('flag'=>1),array('student_id'=>$value));
                $this->CRUDModel->insert('
                student_group_allotment',
                 array(
                     'student_id'=>$value,
                       'section_id'=>$sec_id,
                        'timestamp'=>date('Y-m-d H:i:'),
                       'user_id'=>$this->userInfo->user_id
                 ));
            endforeach;
            endif;
        
            $this->data['page']     =   "admission/student_group";
            $this->data['title']    =   'Student Group| ECMS';
            $this->load->view('common/common',$this->data);        
        
    }
    public function student_group_chart(){
            $session = $this->session->all_userdata();
            $user_id =$session['userData']['user_id'];
             $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Select Sub Program ', 'sub_pro_id', 'name');
             $this->data['program']    = $this->CRUDModel->dropDown('programes_info', 'Select Program ', 'programe_id', 'programe_name');
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', 'Select Gender ', 'gender_id', 'title');
        $this->data['batch']    = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch ', 'batch_id', 'batch_name');
        $this->data['section']    = $this->CRUDModel->dropDown('sections', 'Select Section ', 'sec_id', 'name',array('status'=>'On'));
            $student_name            =  $this->input->post('student_name');
            $father_name            =  $this->input->post('father_name');
            $college_no            =  $this->input->post('college_no');
            $batch_id            =  $this->input->post('batch_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $programe_id            =  $this->input->post('programe_id');
            $gender_id            =  $this->input->post('gender_id');
            $limit              =  $this->input->post('limit');
          
            
            $where = '';
            $like = '';
            $this->data['student_name']  = '';
            $this->data['father_name']  = '';
            $this->data['college_no']  = '';
            $this->data['batch_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['programe_id']  = '';
            $this->data['gender_id']  = '';
            $this->data['limit']  = '';
            
            $where['student_record.s_status_id'] = 5;
            $where['student_record.flag'] = 0;
            
//            if($this->input->post('search')):
//                if(!empty($student_name)):
//                    $like['student_record.student_name'] = $student_name;
//                    $this->data['student_name']  = $student_name;
//                endif;
//                if(!empty($father_name)):
//                    $like['student_record.father_name'] = $father_name;
//                    $this->data['father_name']  = $father_name;
//                endif;
//                if(!empty($college_no)):
//                    $where['student_record.college_no'] = $college_no;
//                    $this->data['college_no']  = $college_no;
//                endif;
//                if(!empty($batch_id)):
//                    $where['prospectus_batch.batch_id'] = $batch_id;
//                    $this->data['batch_id']  = $batch_id;
//                endif;
//                if(!empty($sub_pro_id)):
//                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
//                    $this->data['sub_pro_id']  = $sub_pro_id;
//                endif;
//                if(!empty($programe_id)):
//                    $where['programes_info.programe_id'] = $programe_id;
//                    $this->data['programe_id']  = $programe_id;
//                endif;
//                if(!empty($gender_id)):
//                    $where['gender.gender_id'] = $gender_id;
//                    $this->data['gender_id']  = $gender_id;
//                endif;
//            
//                $this->data['result']   = $this->get_model->search_student_group('student_record',$where,$like,$limit);
//            endif;
//            if($this->input->post('save')):
//            
//            $ides = $this->input->post('checked');
//            $sec_id = $this->input->post('sec_id');
//        
//            foreach($ides as $row=>$value):
//            
//                
//                $this->CRUDModel->update('student_record',array('flag'=>1),array('student_id'=>$value));
//                $this->CRUDModel->insert('
//                student_group_allotment',
//                 array(
//                     'student_id'=>$value,
//                       'section_id'=>$sec_id,
//					   'timestamp'=>date('Y-m-d H:i:'),
//                       'user_id'=>$user_id
//                 ));
//            endforeach;
//            endif;
//        
            $this->data['page']     =   "admission/student_group_chart"; 
            $this->data['title']    =   'Student Group| ECMS';
            $this->load->view('common/common',$this->data);        
        
    }
    
    public function student_strength_report(){
        
        
        $section_id =  $this->input->post('sect_id');
        $sub_pro_id =  $this->input->post('sub_pro_id');
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Select Sub Program ', 'sub_pro_id', 'name', array('programe_id'=>1));
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Select Section ', 'sec_id', 'name', array('status'=>'On'));
        
        $this->data['section_id']  = '';
        $this->data['sub_pro_id']  = '';

//        $where['student_record.s_status_id'] = 5;
//        $where['student_record.flag'] = 0;
        $where['programes_info.programe_id'] = 1;
        
        if(!empty($sub_pro_id)):
            $where['sections.sub_pro_id'] = $sub_pro_id;
            $this->data['sub_pro_id']  = $sub_pro_id;
        endif;
        if(!empty($section_id)):
            $where['sections.sec_id'] = $section_id;
            $this->data['section_id']  = $section_id;
        endif;
        
        $like = array(
            'sections.status' => 'On'
        );
        $this->data['result_g'] = $this->AdmissionModel->student_strength_record($where, $like);
//        echo '<pre>'; print_r($result_g); die;
        
        if($this->input->post('export_excel')):

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Group Strength');
            //set cell A1 content with some text
            $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No.');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'Sub Program');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Section');

            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);


            $this->excel->getActiveSheet()->setCellValue('D1', 'Total Students');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            for($col = ord('A'); $col <= ord('D'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }
		
            $where['programes_info.programe_id'] = 1;
        
            if(!empty($sub_pro_id)):
                $where['sections.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($section_id)):
                $where['sections.sec_id'] = $section_id;
                $this->data['section_id']  = $section_id;
            endif;

            $like = array(
                'sections.status' => 'On'
            );
            $result = $this->AdmissionModel->student_strength_record_excel($where, $like);
			foreach ($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='StudentStrengthReport.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
        endif;
        
        
 
        $this->data['page']     =   "admission/student_strength"; 
        $this->data['title']    =   'Student Group| ECMS';
        $this->load->view('common/common',$this->data);        
        
    }
    
    
    public function assigning_subject(){
        
        if($this->input->post()):
            $ides       = $this->input->post('checked');
            $student_id = $this->input->post('student_id');
            $GroupInfo  = $this->CRUDModel->get_where_row('student_group_allotment',array('student_id'=>$student_id));
                
                if(!empty($GroupInfo) && !empty($ides)):
                                        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                    $user_details   =   $this->db->get_where('users',array('id'=>$this->userInfo->user_id))->row()->emp_name;
                        foreach($ides as $row=>$value):
                                $subj_data = array(
                                    'subject_id'    => $value,
                                    'student_id'    => $student_id,
                                    'section_id'    => $GroupInfo->section_id,
                                    'user_id'       => $this->userInfo->user_id,
                                );
                             $this->CRUDModel->insert('student_subject_alloted',$subj_data);
                 // Subject Logs
                 $subj_logs =  array(
                                'subject_id'    => $value,
                                'student_id'    => $student_id,
                                'comment'       => 'First time alloted BY '.$user_details.' Id :'.$this->userInfo->user_id,
                                'user_id'       => $this->userInfo->user_id,
                                'date'          => date('Y-m-d'),
                                'timestamp'     => date('Y-m-d H:i:s'),
                        );
                    $this->CRUDModel->insert('student_subject_alloted_logs',$subj_logs );
                 
                    endforeach;
               endif;
        

            redirect('ArtSubject');
        endif;
    }
    
    public function eng_med_assigning_subject()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $ides = $this->input->post('checked');
            $student_id = $this->input->post('student_id');
        
            foreach($ides as $row=>$value):
                $this->CRUDModel->insert('
                student_subject_alloted',
                 array(
                       'subject_id'=>$value,
                       'student_id'=>$student_id,
                       'user_id'=>$user_id
                 ));
            endforeach;
            redirect('admin/eng_medical_students');
            endif;
    }
    
      public function degree_assigning_subject(){
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            
            $ides = $this->input->post('checked');
            $student_id = $this->input->post('student_id');
            $sec_id = $this->input->post('sec_id');
         if(!empty($ides)):
            foreach($ides as $row=>$value):
                $this->CRUDModel->insert('
                student_subject_alloted',
                 array(
                       'subject_id'=>$value,
                       'student_id'=>$student_id,
                       'section_id'=>$sec_id,
                       'user_id'=>$user_id
                 ));
            endforeach;
           
         endif;
         
         if($sec_id):
        
            $this->CRUDModel->update('student_group_allotment',array('section_id'=>$sec_id,'up_user_id'=>$user_id) ,array('student_id'=>$student_id));
             
             else:
             
        $sec_data = array(
            'student_id'=>$student_id,
            'section_id'=>$sec_id,
            'user_id'=>$user_id
        );
        $this->CRUDModel->insert('student_group_allotment',$sec_data);
         endif;
         
  
       
            redirect('admin/degree_students');
            endif;
    }
    
//      public function degree_assigning_subject(){
//        $session = $this->session->all_userdata();
//        $user_id =$session['userData']['user_id'];
//        if($this->input->post()):
//            
//            $ides = $this->input->post('checked');
//            $student_id = $this->input->post('student_id');
//            $sec_id = $this->input->post('sec_id');
//         if(!empty($ides)):
//            foreach($ides as $row=>$value):
//                $this->CRUDModel->insert('
//                student_subject_alloted',
//                 array(
//                       'subject_id'=>$value,
//                       'student_id'=>$student_id,
//                       'section_id'=>$sec_id,
//                       'user_id'=>$user_id
//                 ));
//            endforeach;
//           
//         endif;
//         
//         if($sec_id):
//        
//            $this->CRUDModel->update('student_group_allotment',array('section_id'=>$sec_id,'up_user_id'=>$user_id) ,array('student_id'=>$student_id));
//             
//             else:
//             
//        $sec_data = array(
//            'student_id'=>$student_id,
//            'section_id'=>$sec_id,
//            'user_id'=>$user_id
//        );
//        $this->CRUDModel->insert('student_group_allotment',$sec_data);
//         endif;
//         
//  
//       
//            redirect('admin/degree_students');
//            endif;
//    }
//  
    
    public function updateassigning_subject(){

        if($this->input->post()):
            $ides           = $this->input->post('checked');
            $student_id     = $this->input->post('student_id');
            $checked_log    = $this->CRUDModel->get_where_result('student_subject_alloted', array('student_id'=>$student_id));
            
                                $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
            $user_details   =   $this->db->get_where('users',array('id'=>$this->userInfo->user_id))->row()->emp_name;
            $GroupInfo      =  $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
            
            if(!empty($GroupInfo)):
                
                if(empty($ides)):
                    foreach($checked_log as $log_row):
                    $data =  array(
                                    'subject_id'    => $log_row->subject_id,
                                    'student_id'    => $student_id,
                                    'comment'       => 'Delete Subjects By '.$user_details.' Id :'.$this->userInfo->user_id,
                                    'user_id'       => $this->userInfo->user_id,
                                    'date'          => date('Y-m-d'),
                                    'timestamp'     => date('Y-m-d H:i:s'),
                             );
                            $this->CRUDModel->insert('student_subject_alloted_logs',$data );
                endforeach;
                $this->CRUDModel->deleteid('student_subject_alloted', array('student_id'=>$student_id));

                else:
                    foreach($checked_log as $log_row):
                    $data =  array(
                                    'subject_id'    => $log_row->subject_id,
                                    'student_id'    => $student_id,
                                    'comment'       => 'Update Subjects By '.$user_details.' Id :'.$this->userInfo->user_id,
                                    'user_id'       => $this->userInfo->user_id,
                                    'date'          => date('Y-m-d'),
                                    'timestamp'     => date('Y-m-d H:i:s'),
                             );
                            $this->CRUDModel->insert('student_subject_alloted_logs',$data );
                endforeach;
                $this->CRUDModel->deleteid('student_subject_alloted', array('student_id'=>$student_id));
                endif;
                
                foreach($ides as $row=>$value):
                    $data =  array(
                        'subject_id' => $value,
                        'student_id' => $student_id,
                        'section_id' => $GroupInfo->section_id,
                        'user_id'    => $this->userInfo->user_id,
                        'timestamp'  => date('Y-m-d H:i:s'),
                         );
                    $this->CRUDModel->insert('student_subject_alloted',$data );
                endforeach;
            endif;
            
            redirect('ArtSubject');
        endif;
    }
    
 
    public function update_degree_assigning_subject(){
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
      
            
            $ides       = $this->input->post('checked');
            $student_id = $this->input->post('student_id');
            $where      = array('student_id'=>$student_id);
            $sec_id     = $this->input->post('sec_id');
            $sec_name   = $this->input->post('sec_name');
             $ids        = $this->CRUDModel->deleteid('student_subject_alloted', array('student_id'=>$student_id));
//            
//              
                if(!empty($ides)):
                    foreach($ides as $row=>$value):
                     $data =  array(
                               'subject_id' =>$value,
                               'student_id' =>$student_id,
                               'section_id' =>$sec_id,
                               'user_id'    =>$user_id
                         );
                    $this->CRUDModel->insert('student_subject_alloted',$data );
                    endforeach;
                endif;
            
                 
               $sectioCheck = $this->CRUDModel->get_where_row('student_group_allotment',array('student_id'=>$student_id));
               
               if(empty($sectioCheck)):
                        $sec_data_insert    = array(
                            'student_id'    =>$student_id,
                            'section_id'    =>$sec_id,
                            'user_id'       =>$user_id
                    );
                   
                $this->CRUDModel->insert('student_group_allotment',$sec_data_insert);
                   
   
                else:
                                  
                   
            $sec_data = array(
                'section_id'=>$sec_id,
                'user_id'=>$user_id
            );
            $this->CRUDModel->update('student_group_allotment',$sec_data,$where);
            
               endif;
     
          
            redirect('admin/degree_students');
            endif;
    } 
    
    
public function search_student()
    {
        $whereSub_pro = array('programe_id'=>1);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
		$this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
		$this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
		$this->data['batch']   = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
			$this->data['batchId']          = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 1;
           // $where['student_record.s_status_id'] = 5;
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
        
                $this->data['result']   = $this->get_model->get_stdData('student_record',$where,$like,$custom);    
                $this->data['page']     = "admission/search_student_record";
                $this->data['title']    = 'Student List Inter Level| ECMS';
                $this->load->view('common/common',$this->data);  
            
                elseif($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Inter Level Students');
                //set cell A1 content with some text
                
                $this->excel->getActiveSheet()->setCellValue('A1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Father name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1', 'College No');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Program');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Total Marks');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Obtained Marks');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Percentage');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('L1','Section');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','Application status');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','PTCL Number');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('O1','Mobile Number');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('S1','Date of Birth');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('T1','Domicile');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('U1','Hostel Allotted');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('V1','Religion');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('W1','Fata School');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('W'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id          =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
			$this->data['batchId']          = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 1;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                sections.name as section,
                student_status.name as student_status,
                student_record.land_line_no as land_line_no,
                student_record.mobile_no as mobile_no,
                student_record.parmanent_address as parmanent_address,
                student_record.app_postal_address as postal_address,
                blood_group.title as blood,
                student_record.dob as dob,
                domicile.name as domicile,
                student_record.hostel_applied as hostel_applied,
                religion.title as religion,
                student_record.fata_school as fata_school,
            ');
            $this->db->FROM('student_record');
            $this->db->where($where);
            $this->db->order_by('applicant_edu_detail.percentage','desc');
            $this->db->order_by('student_record.form_no','asc');
            $this->db->limit($custom['start'],$custom['limit']);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');     
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
                $filename='StudentList2017.xls'; 
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
                $this->data['rseats_id']  = '';
                $this->data['limitId']  = '';

               endif; 
    }
    
    public function search_adding_picture_student()
    {
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['program']    = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
    $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $programe_id            =  $this->input->post('programe_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $limit              =  $this->input->post('limit');
          
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
            $this->data['rseats_id']  = '';
            $this->data['limitId']  = '';
            
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
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
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $this->data['limitId']  = $limit;
        
                $this->data['result']   = $this->get_model->get_admin_stdData('student_record',$where,$like,$custom);    
                $this->data['page']     = "admission/search_adding_picture_student";
                $this->data['title']    = 'Student List  | ECMS';
                $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function arts_students(){              
           $this->data['headerPage']   = 'Inter Subject Allottment';
        $this->data['artStudents']  = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>'1'));  
        $where                      = array('student_record.programe_id'=>'1','student_record.s_status_id'=>'5');
         
        $config['base_url']         = base_url('admin/arts_students');
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
        $custom['column']           = 'student_id';
        $custom['order']            = 'desc';
        $this->data['result']       = $this->get_model->stds_arts_pagination($config['per_page'], $page,$where,$custom);
        $this->data['count']        = $config['total_rows']; 
        $this->data['page_title']   = 'All Arts Students  | ECMS';
        $this->data['page']         = 'admission/arts_student_record';
        $this->load->view('common/common',$this->data); 
    }
public function search_arts_student(){
         $this->data['headerPage']   = 'Inter Subject Allottment(Arts)';
        $where                      = array('student_record.programe_id'=>'1','student_record.s_status_id'=>'5');
        $this->data['artStudents']  = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>'1'));  
       
      
        $whereSub_pro               = array('programe_id'=>1);
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
        $this->data['reserved_seat']= $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
        $this->data['status']       = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']        = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        if($this->input->post('search')):
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 1;
            $where['student_record.s_status_id'] = 5;
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
                $this->data['result']   = $this->get_model->get_artsstdData('student_record',$where,$like,$custom);    
                $this->data['page']     = "admission/search_arts_student";
                $this->data['title']    = 'Arts Student List  | ECMS';
                $this->load->view('common/common',$this->data);
        endif;
     }  
     
  public function search_german_student()
	{	
        $where = '';
        $like = '';
        $this->data['student_id']  = '';
       //  echo '<pre>';print_r($this->input->post());die;
        if($this->input->post()):
            $student_id = $this->input->post('student_id');
           
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] = $student_id;
            endif;
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        endif;
        $this->data['page_title']   = 'Add New German Student | ECMS';
        $this->data['page']         = 'admission/add_german_student';
        $this->load->view('common/common',$this->data);
	}
    
    public function search_green_file_student()
    {
//        echo '<pre>';print_r($this->input->post());die;
        
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name');  
        $this->data['program']    = $this->CRUDModel->dropDown('programes_info', ' Programs ', 'programe_id', 'programe_name');  
        if($this->input->post()):
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
        
                $this->data['result']   = $this->get_model->get_stdData('student_record',$where,$like);    
                $this->data['page']     = "admission/search_green_file";
                $this->data['title']    = 'Student List  | ECMS';
                $this->load->view('common/common',$this->data);  
            endif;
    } 
    
    
//    public function search_arts_student()
//    {
//       
//        $this->data['artStudents']  = $this->CRUDModel->get_where_result_like('sub_programes',array('sub_programes.name'=>'FA')); 
//        $whereSub_pro               = array('programe_id'=>1);
//        $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
//        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
//        $this->data['reserved_seat']= $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
//        $this->data['status']       = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
//        $this->data['limit']        = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
//        if($this->input->post('search')):
//            $college_no         =  $this->input->post('college_no');
//            $form_no            =  $this->input->post('form_no');
//            $student_name       =  $this->input->post('student_name');
//            $father_name        =  $this->input->post('father_name');
//            $gender_id          =  $this->input->post('gender_id');
//            $sub_pro_id         =  $this->input->post('sub_pro_id');
//            $rseats_id          =  $this->input->post('rseats_id');
//            $s_status_id        =  $this->input->post('s_status_id');
//            $limit              =  $this->input->post('limit');
//          
//            //like Array
//            $like = '';
//            $where = '';
//            $this->data['college_no'] = '';
//            $this->data['form_no'] = '';
//            $this->data['student_name'] = '';
//            $this->data['father_name']  = '';
//            $this->data['gender_id']  = '';
//            $this->data['sub_pro_id']  = '';
//            $this->data['rseats_id']  = '';
//            $this->data['s_status_id']  = '';
//            $this->data['limitId']  = '';
//            
//            $where['student_record.programe_id'] = 1;
//            $where['student_record.s_status_id'] = 5;
//        
//            if(!empty($college_no)):
//                $where['student_record.college_no'] = $college_no;
//                $this->data['college_no'] = $college_no;
//            endif;
//            if(!empty($form_no)):
//                $where['form_no'] = $form_no;
//                $this->data['form_no'] =$form_no;
//            endif;
//            if(!empty($student_name)):
//                $like['student_name'] = $student_name;
//                $this->data['student_name'] =$student_name;
//            endif;
//            if(!empty($father_name)):
//                $like['father_name'] = $father_name;
//            $this->data['father_name'] =$father_name;
//            endif;
//            if(!empty($gender_id)):
//                $where['gender.gender_id'] = $gender_id;
//                $this->data['gender_id']  = $gender_id;
//            endif;
//            if(!empty($rseats_id)):
//                $where['reserved_seat.rseat_id'] = $rseats_id;
//                $this->data['rseats_id']  = $rseats_id;
//            endif;
//            if(!empty($sub_pro_id)):
//                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
//                $this->data['sub_pro_id']  = $sub_pro_id;
//            endif;
//            if(!empty($s_status_id)):
//                $where['student_status.s_status_id'] = $s_status_id;
//                $this->data['s_status_id']  = $s_status_id;
//            endif;
//            $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
//              
//                if($limitVale):
//                    $limitD = $limitVale->limit_value;
//                else:
//                    $limitD = 50;
//                endif;
//                $custom['limit']        = $limitD;
//                $custom['start']        = 0;
//                $custom['column']       = 'applicant_edu_detail.percentage';
//                $custom['order']        = 'desc';
//                $this->data['limitId']  = $limit;
//                $this->data['result']   = $this->get_model->get_artsstdData('student_record',$where,$like,$custom);    
//                $this->data['page']     = "admission/search_arts_student";
//                $this->data['title']    = 'Arts Student List  | ECMS';
//                $this->load->view('common/common',$this->data);
//        endif;
//     }
    
public function search_eng_med_student()
    {
        $whereSub_pro = array('programe_id'=>1);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
    $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
    $this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 1;
            $where['student_record.s_status_id'] = 5;
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
                $this->data['result']   = $this->get_model->get_artsstdData('student_record',$where,$like,$custom);    
                $this->data['page']     = "admission/search_eng_medical_student";
                $this->data['title']    = 'Eng/Medical Student List  | ECMS';
                $this->load->view('common/common',$this->data);
        endif;
     }
    
    public function search_hnd_student()
    {
        $whereSub_pro = array('programe_id'=>3);
		$whereSub_pro = array('programe_id'=>6);
		$whereSub_pro = array('programe_id'=>7);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
    $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
    $this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $programe_id            =  $this->input->post('programe_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['programe_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
          
        
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
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
			if(!empty($programe_id)):
                $where['student_record.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
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
        
                $this->data['result']   = $this->get_model->get_hndstdData('student_record',$where,$like,$custom);
            
                $this->data['page']     = "admission/search_hnd_student";
                $this->data['title']    = 'HND Student List 2016  | ECMS';
                $this->load->view('common/common',$this->data); 
                elseif($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('All Students');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Father name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1', 'College No');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Program');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Total Marks');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Obtained Marks');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Percentage');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('L1','Section');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','Application status');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','PTCL Number');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('O1','Mobile Number');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('R1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('S1','Date of Birth');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('T1','Domicile');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('U1','Hostel Allotted');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('V1','Religion');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('W1','Fata School');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('W'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $student_id         =  $this->input->post('student_id');
            $form_no            =  $this->input->post('form_no');
            $college_no            =  $this->input->post('college_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 3;
            $where['student_record.programe_id'] = 6;
            $where['student_record.programe_id'] = 7;
            if(!empty($student_id)):
                $where['student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
             if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                sections.name as section,
                student_status.name as student_status,
                student_record.land_line_no as land_line_no,
                student_record.mobile_no as mobile_no,
                student_record.parmanent_address as parmanent_address,
                student_record.app_postal_address as postal_address,
                blood_group.title as blood,
                student_record.dob as dob,
                domicile.name as domicile,
                student_record.hostel_applied as hostel_applied,
                religion.title as religion,
                student_record.fata_school as fata_school,
            ');
            $this->db->FROM('student_record');
            $this->db->where($where);
            $this->db->order_by('applicant_edu_detail.percentage','desc');
            $this->db->order_by('student_record.form_no','asc');
            $this->db->limit($custom['start'],$custom['limit']);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');     
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
                $filename='StudentList2016.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
                else:

                $this->data['student_id'] = '';
                $this->data['form_no'] = '';
                $this->data['student_name'] = '';
                $this->data['father_name']  = '';
                $this->data['gender_id']  = '';
                $this->data['sub_pro_id']  = '';
                $this->data['rseats_id']  = '';
                $this->data['limitId']  = '';
 
                endif;
    }
    
    public function search_cs_student()
    {

//        $whereSub_pro                   = array('programe_id'=>2);
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',array('programe_id'=>2));
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('programe_id'=>2,'status'=>'on'));
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
        $this->data['status']           = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        if($this->input->post('search')):
            $college_no                 =  $this->input->post('college_no');
            $form_no                    =  $this->input->post('form_no');
            $student_name               =  $this->input->post('student_name');
            $father_name                =  $this->input->post('father_name');
            $gender_id                  =  $this->input->post('gender_id');
            $sub_pro_id                 =  $this->input->post('sub_pro_id');
            $batch                      =  $this->input->post('batch');
            $rseats_id                  =  $this->input->post('rseats_id');
            $s_status_id                =  $this->input->post('s_status_id');
            $limit                      =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
			$this->data['batchId']          = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 2;
        
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            if(!empty($form_no)):
                $where['form_no'] = $form_no;
                $this->data['form_no'] =$form_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
        
                $this->data['result']   = $this->get_model->get_csstdData('student_record',$where,$like,$custom);
            $this->data['page']     = "admission/cs_search_student_record";
            $this->data['title']    = 'Student List 2016 | ECMS';
            $this->load->view('common/common',$this->data);
        
           elseif($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('BCS Students Record');
                //set cell A1 content with some text
                
                $this->excel->getActiveSheet()->setCellValue('A1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Father name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1', 'College No');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Program');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Total Marks');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Obtained Marks');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Percentage');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('L1','Section');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','Application status');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','PTCL Number');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('O1','Mobile Number');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('R1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('S1','Date of Birth');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('T1','Domicile');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('U1','Hostel Allotted');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('V1','Religion');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('W1','Fata School');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('W'); $col++){
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12); 
			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $student_id         =  $this->input->post('student_id');
            $college_no            =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
			$this->data['batchId']    = '';
            $this->data['student_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no']    = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 2;
            if(!empty($student_id)):
                $where['student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
             if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                sections.name as section,
                student_status.name as student_status,
                student_record.land_line_no as land_line_no,
                student_record.mobile_no as mobile_no,
                student_record.parmanent_address as parmanent_address,
                student_record.app_postal_address as postal_address,
                blood_group.title as blood,
                student_record.dob as dob,
                domicile.name as domicile,
                student_record.hostel_applied as hostel_applied,
                religion.title as religion,
                student_record.fata_school as fata_school,
            ');
            $this->db->FROM('student_record');
            $this->db->where($where);
            $this->db->order_by('applicant_edu_detail.percentage','desc');
            $this->db->group_by('student_record.student_id');
            $this->db->limit($custom['start'],$custom['limit']);
			$this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');     
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
                $filename='BCS_StudentList.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
                else:

                $this->data['student_id'] = '';
                $this->data['college_no'] = '';
                $this->data['batchId'] = '';
                $this->data['form_no'] = '';
                $this->data['student_name'] = '';
                $this->data['father_name']  = '';
                $this->data['gender_id']  = '';
                $this->data['sub_pro_id']  = '';
                $this->data['rseats_id']  = '';
                $this->data['limitId']  = '';
               endif; 
    }
    
    public function degree_students_search()
    {
        $whereSub_pro = array('programe_id'=>4);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
    $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
    $this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 4;
            $where['student_record.s_status_id'] = 5;
        
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
        
            $this->data['result']   = $this->get_model->get_degree_stdData('student_record',$where,$like,$custom);
            $this->data['page']     = "admission/degree_search_student";
            $this->data['title']    = 'Degree Students List  | ECMS';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function search_degree_student()
    {
        $whereSub_pro = array('programe_id'=>4);
        $whereSub_pro = array('programe_id'=>8);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
    $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
    $this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $programe_id            =  $this->input->post('programe_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['programe_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
        
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
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
			if(!empty($programe_id)):
                $where['student_record.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
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
        
            $this->data['result']   = $this->get_model->get_degreestdData('student_record',$where,$like,$custom);
            $this->data['page']     = "admission/search_degree_student";
            $this->data['title']    = 'Students List  | ECMS';
            $this->load->view('common/common',$this->data);  
            elseif($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('All Students');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Father name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1', 'College No');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Program');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Total Marks');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Obtained Marks');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Percentage');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('L1','Section');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','Application status');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','PTCL Number');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('O1','Mobile Number');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('R1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('S1','Date of Birth');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('T1','Domicile');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('U1','Hostel Allotted');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
    
                $this->excel->getActiveSheet()->setCellValue('V1','Religion');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('W1','Fata School');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('W'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 4;
            $where['student_record.programe_id'] = 8;
            if(!empty($student_id)):
                $where['student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
             if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                sections.name as section,
                student_status.name as student_status,
                student_record.land_line_no as land_line_no,
                student_record.mobile_no as mobile_no,
                student_record.parmanent_address as parmanent_address,
                student_record.app_postal_address as postal_address,
                blood_group.title as blood,
                student_record.dob as dob,
                domicile.name as domicile,
                student_record.hostel_applied as hostel_applied,
                religion.title as religion,
                student_record.fata_school as fata_school,
            ');
            $this->db->FROM('student_record');
            $this->db->where($where);
            $this->db->order_by('applicant_edu_detail.percentage','desc');
            $this->db->order_by('student_record.form_no','asc');
            $this->db->limit($custom['start'],$custom['limit']);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');     
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
                $date = date('Y-m-d');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Degree_level_list_'.$date.'.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
                else:

                $this->data['student_id'] = '';
                $this->data['form_no'] = '';
                $this->data['student_name'] = '';
                $this->data['father_name']  = '';
                $this->data['gender_id']  = '';
                $this->data['sub_pro_id']  = '';
                $this->data['rseats_id']  = '';
                $this->data['limitId']  = '';

               endif;   
    }
    
public function update_seat_detail($id)
	{	
        $prodata['result'] = $this->get_model->seatdetailData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'rseat_id'=>$_POST['rseat_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'seats_allowed'=>$_POST['seats_allowed'],
                'status'=>$_POST['status'],
                'shift_id'=>$_POST['shift_id'],
                'comment'=>$_POST['comment']
            );
            $this->get_model->updateseatdetail($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/reserved_seats_detail');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_seats_detail", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function add_student_record(){	
        
        if($this->input->post()):	
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                = $this->input->post('dob'); 
            $date1              = date('Y-m-d', strtotime($dob));
            
            $this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
            
            $checked = array(
               'batch_id'   => $this->input->post('batch_id'),
               'form_no'    => $this->input->post('form_no')
            );
            $qry    = $this->CRUDModel->get_where_row('student_record',$checked);
            if($qry):
                $this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
                redirect('admin/add_student_record');       
            else:
            $data = array
            (
                'batch_id'          => $this->input->post('batch_id'),
                'reg_batch_id'      => $this->input->post('batch_id'),
                'programe_id'       => $this->input->post('programe_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
                'form_no'           => $this->input->post('form_no'),
                'rseats_id'         => $this->input->post('rseats_id'),
                'rseats_id1'        => $this->input->post('rseats_id1'),
                'comment'           => $this->input->post('comment'),
                'student_name'      => $student,
                'migration_status'  => $this->input->post('migration_status'),
                'student_cnic'      => $this->input->post('student_cnic'),
                'gender_id'         => $this->input->post('gender_id'),
                'marital_id'        => $this->input->post('marital_id'),
                'dob'               => $date1,
                'place_of_birth'    => $this->input->post('place_of_birth'),
                'bg_id'             => $this->input->post('bg_id'),
                'country_id'        => $this->input->post('country_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'district_id'       => $this->input->post('district_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'applicant_mob_no1' => $this->input->post('std_mobile_no'),
                'father_name'       => $father,
                'father_cnic'       => $this->input->post('father_cnic'),
                'land_line_no'      => $this->input->post('land_line_no'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'occ_id'            => $this->input->post('occ_id'),
                'annual_income'     => $this->input->post('annual_income'),
                'app_postal_address' => $this->input->post('app_postal_address'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'last_school_address' => $this->input->post('last_school_address'),
                'father_email'      => $this->input->post('father_email'),
                'guardian_name'     => $guardian,
                'guardian_cnic'     => $this->input->post('guardian_cnic'),
                'relation_with_guardian' => $this->input->post('relation_with_guardian'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'g_annual_income'   => $this->input->post('g_annual_income'),
                'g_land_no'         => $this->input->post('g_land_no'),
                'g_mobile_no'       => $this->input->post('g_mobile_no'),
                'g_postal_address'  => $this->input->post('g_postal_address'),
                'g_email'           => $this->input->post('g_email'),
                'physical_status_id' => $this->input->post('physical_status_id'),
                'emargency_person_name' => $emargency_person,
                'e_person_relation' => $this->input->post('e_person_relation'),
                'e_person_contact1' => $this->input->post('e_person_contact1'),
                'e_person_contact2' => $this->input->post('e_person_contact2'),
                's_status_id'       => 1,
                'admission_comment' => $this->input->post('admission_comment'),
                'remarks'           => $this->input->post('remarks1'),
                'remarks2'          => $this->input->post('remarks2'),
                'student_password'  => $password,
                'timestamp'         => $current_datetime,
                'user_id'           => $this->userInfo->user_id
                );
            
                $sp_id = $this->input->post('sub_pro_id');
                $id     = $this->CRUDModel->insert('student_record',$data);
                if(!empty($sp_id)):
                    $ides   = $this->input->post('checked');
                    foreach($ides as $row=>$value):
                        $sub_data = array(
                             'student_id'   => $id,
                             'subject_id'   => $value,
                             'sub_prog_id'  => $sp_id,
                             'created_by'   => $this->userInfo->user_id,
                             'date_time'    => date('Y-m-d H:i:s'),
                            );
                        $this->CRUDModel->insert('new_student_subjects',$sub_data);
                    endforeach;
                endif;
                
                redirect('admin/student_academic_record/'.$id);
            endif;
        endif;
            $this->data['page_title']   = 'Add New Student (Inter Level) | ECMS';
            $this->data['page']         = 'admission/add_student_record';
            $this->load->view('common/common',$this->data);
	}
        
    public function add_student_record_pending(){	
        
        if($this->input->post()):	
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                = $this->input->post('dob'); 
            $date1              = date('Y-m-d', strtotime($dob));
            
            $this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
            
            $checked = array(
               'batch_id'   => $this->input->post('batch_id'),
               'form_no'    => $this->input->post('form_no')
            );
            $qry    = $this->CRUDModel->get_where_row('student_record',$checked);
            if($qry):
                $this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
                redirect('admin/add_student_record_pending');       
            else:
            $data = array
            (
                'batch_id'          => $this->input->post('batch_id'),
                'reg_batch_id'      => $this->input->post('batch_id'),
                'programe_id'       => $this->input->post('programe_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
//                'form_no'           => $this->input->post('form_no'),
                'rseats_id'         => $this->input->post('rseats_id'),
                'rseats_id1'        => $this->input->post('rseats_id1'),
                'comment'           => $this->input->post('comment'),
                'student_name'      => $student,
                'migration_status'  => $this->input->post('migration_status'),
                'student_cnic'      => $this->input->post('student_cnic'),
                'gender_id'         => $this->input->post('gender_id'),
                'marital_id'        => $this->input->post('marital_id'),
                'dob'               => $date1,
                'place_of_birth'    => $this->input->post('place_of_birth'),
                'bg_id'             => $this->input->post('bg_id'),
                'country_id'        => $this->input->post('country_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'district_id'       => $this->input->post('district_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'applicant_mob_no1' => $this->input->post('std_mobile_no'),
                'father_name'       => $father,
                'father_cnic'       => $this->input->post('father_cnic'),
                'land_line_no'      => $this->input->post('land_line_no'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'occ_id'            => $this->input->post('occ_id'),
                'annual_income'     => $this->input->post('annual_income'),
                'app_postal_address' => $this->input->post('app_postal_address'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'last_school_address' => $this->input->post('last_school_address'),
                'father_email'      => $this->input->post('father_email'),
                'guardian_name'     => $guardian,
                'guardian_cnic'     => $this->input->post('guardian_cnic'),
                'relation_with_guardian' => $this->input->post('relation_with_guardian'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'g_annual_income'   => $this->input->post('g_annual_income'),
                'g_land_no'         => $this->input->post('g_land_no'),
                'g_mobile_no'       => $this->input->post('g_mobile_no'),
                'g_postal_address'  => $this->input->post('g_postal_address'),
                'g_email'           => $this->input->post('g_email'),
                'physical_status_id' => $this->input->post('physical_status_id'),
                'emargency_person_name' => $emargency_person,
                'e_person_relation' => $this->input->post('e_person_relation'),
                'e_person_contact1' => $this->input->post('e_person_contact1'),
                'e_person_contact2' => $this->input->post('e_person_contact2'),
                's_status_id'       => 15,
                'admission_comment' => $this->input->post('admission_comment'),
                'remarks'           => $this->input->post('remarks1'),
                'remarks2'          => $this->input->post('remarks2'),
                'std_mobile_network' => $this->input->post('app_net_id'),
                'net_id'            => $this->input->post('net_id'),
                'student_email'     => $this->input->post('std_email'),
                'student_password'  => $password,
                'timestamp'         => $current_datetime,
                'user_id'           => $this->userInfo->user_id
                );
            
                $sp_id = $this->input->post('sub_pro_id');
                $id     = $this->CRUDModel->insert('student_record',$data);
                if($sp_id == 5 || $sp_id == 27):
                    $ides   = $this->input->post('checked');
                    foreach($ides as $row=>$value):
                        $sub_data = array(
                             'student_id'   => $id,
                             'subject_id'   => $value,
                             'sub_prog_id'  => $sp_id,
                             'created_by'   => $this->userInfo->user_id,
                             'date_time'    => date('Y-m-d H:i:s'),
                            );
                        $this->CRUDModel->insert('new_student_subjects',$sub_data);
                    endforeach;
                endif;
                
                
                //Fee Record Insertion 
                $head_fee_where = array(
        //          'program_id'  =>1,
        //            'batch_id'  =>67,
                    'status'  => 1,
                );
                $fee_heads = $this->CRUDModel->get_where_row('prospectus_fee_head',$head_fee_where);
                 $due_date = $this->CRUDModel->get_where_row('prospectus_challan_duedate',array('status'=>1));
                  
                $data = array(
                    'student_id'        => $id,
                    'pros_fee_id'       => $fee_heads->pros_fee_head_id,
                    'pros_amount'       => $fee_heads->amount,
                    'date'              => date('Y-m-d'),
                    'due_date'          => date('Y-m-d'),
                    'create_datetime'   => date('Y-m-d H:i:s'),
                );
                $challan_id = $this->CRUDModel->insert('prospectus_challan',$data);
                $set = array('form_no'=>$challan_id);
                $where_data        = array('student_id'=>$id);
                $this->CRUDModel->update('student_record',$set,$where_data);
        
                redirect('admin/student_academic_record_pending/'.$id);
            endif;
        endif;
            $this->data['page_title']   = 'Add New Student (Inter Level) | ECMS';
            $this->data['page']         = 'admission/add_student_record_pending';
            $this->load->view('common/common',$this->data);
	}
            
    
   public function add_admin_student_record(){
        
        if($this->input->post()):	
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                = $this->input->post('dob'); 
            $date1              = date('Y-m-d', strtotime($dob));
            
            $this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
            
            $checked = array(
                        'batch_id'=>$this->input->post('batch_id'),
                        'form_no'=>$this->input->post('form_no')
                        );
            $qry = $this->CRUDModel->get_where_row('student_record',$checked);
            if($qry):
                $this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
                redirect('admin/add_admin_student_record');       
            else:
            $data = array(
                'batch_id'              => $this->input->post('batch_id'),
                'reg_batch_id'          => $this->input->post('batch_id'),
                'programe_id'           => $this->input->post('programe_id'),
                'sub_pro_id'            => $this->input->post('sub_pro_id'),
                'form_no'               => $this->input->post('form_no'),
                'rseats_id'             => $this->input->post('rseats_id'),
                'rseats_id1'            => $this->input->post('rseats_id1'),
                'rseats_id2'            => $this->input->post('rseats_id'),
                'comment'               => $this->input->post('comment'),
                'student_name'          => $student,
                'student_cnic'          => $this->input->post('student_cnic'),
                'gender_id'             => $this->input->post('gender_id'),
                'marital_id'            => $this->input->post('marital_id'),
                'dob'                   => $date1,
                'place_of_birth'        => $this->input->post('place_of_birth'),
                'bg_id'                 => $this->input->post('bg_id'),
                'country_id'            => $this->input->post('country_id'),
                'domicile_id'           => $this->input->post('domicile_id'),
                'district_id'           => $this->input->post('district_id'),
                'religion_id'           => $this->input->post('religion_id'),
                'hostel_required'       => $this->input->post('hostel_required'),
                'father_name'           => $father,
                'father_cnic'           => $this->input->post('father_cnic'),
                'land_line_no'          => $this->input->post('land_line_no'),
                'mobile_no'             => $this->input->post('mobile_no'),
                'net_id'                => $this->input->post('net_id'),
                'mobile_no2'            => $this->input->post('mobile_no2'),
                'occ_id'                => $this->input->post('occ_id'),
                'annual_income'         => $this->input->post('annual_income'),
                'app_postal_address'    => $this->input->post('app_postal_address'),
                'parmanent_address'     => $this->input->post('parmanent_address'),
                'last_school_address'   => $this->input->post('last_school_address'),
                'father_email'          => $this->input->post('father_email'),
                'guardian_name'         => $guardian,
                'guardian_cnic'         => $this->input->post('guardian_cnic'),
                'relation_with_guardian' => $this->input->post('relation_with_guardian'),
                'guardian_occupation'   => $this->input->post('guardian_occupation'),
                'g_annual_income'       => $this->input->post('g_annual_income'),
                'g_land_no'             => $this->input->post('g_land_no'),
                'g_mobile_no'           => $this->input->post('g_mobile_no'),
                'g_postal_address'      => $this->input->post('g_postal_address'),
                'g_email'               => $this->input->post('g_email'),
                'physical_status_id'    => $this->input->post('physical_status_id'),
                'emargency_person_name' => $emargency_person,
                'e_person_relation'     => $this->input->post('e_person_relation'),
                'e_person_contact1'     => $this->input->post('e_person_contact1'),
                'e_person_contact2'     => $this->input->post('e_person_contact2'),
                'remarks'               => $this->input->post('remarks1'),
                'remarks2'              => $this->input->post('remarks2'),
                's_status_id'           => 1,
                'student_password'      => $password,
                'admission_comment'     => $this->input->post('admission_comment'),
                'timestamp'             => $current_datetime,
                'user_id'               => $this->userInfo->user_id
                );
            
                $sp_id = $this->input->post('sub_pro_id');
                $id     = $this->CRUDModel->insert('student_record',$data);
                if(!empty($sp_id)):
                    $ides   = $this->input->post('checked');
                    foreach($ides as $row=>$value):
                        $sub_data = array(
                             'student_id'   => $id,
                             'subject_id'   => $value,
                             'sub_prog_id'  => $sp_id,
                             'created_by'   => $this->userInfo->user_id,
                             'date_time'    => date('Y-m-d H:i:s'),
                            );
                        $this->CRUDModel->insert('new_student_subjects',$sub_data);
                    endforeach;
                endif;
                
                
                redirect('admin/admin_student_academic_record/'.$id);
          endif;
          endif;
            $this->data['page_title']   = 'Admin Add New Student | ECMS';
            $this->data['page']         = 'admission/admin/form/add_admin_student_record';
            $this->load->view('common/common',$this->data);
	}  
        
    public function add_admin_student_record22032019()
	{	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
			$this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_new_student_record');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'rseats_id1'=>$this->input->post('rseats_id1'),
                'rseats_id2'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'migration_status'  => $this->input->post('migration_status'),
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'net_id'=>$this->input->post('net_id'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                'remarks'=>$this->input->post('remarks1'),
                'remarks2'=>$this->input->post('remarks2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id
            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/admin_student_academic_record/'.$id);
          endif;
          endif;
            $this->data['page_title']   = 'Admin Add New Student | ECMS';
            $this->data['page']         = 'admission/add_admin_student_record';
            $this->load->view('common/common',$this->data);
	}
    
    public function add_a_level_student()
	{	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            $this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
//                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>15,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'std_mobile_network' => $this->input->post('app_net_id'),
                'net_id'            => $this->input->post('net_id'),
                'applicant_mob_no1'            => $this->input->post('std_mobile_no'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id
            );
            $id = $this->CRUDModel->insert('student_record',$data);
            
            //Fee Record Insertion 
                $head_fee_where = array(
        //          'program_id'  =>1,
        //            'batch_id'  =>67,
                    'status'  => 1,
                );
                $fee_heads = $this->CRUDModel->get_where_row('prospectus_fee_head',$head_fee_where);
                 $due_date = $this->CRUDModel->get_where_row('prospectus_challan_duedate',array('status'=>1));
                $data = array(
                    'student_id'        => $id,
                    'pros_fee_id'       => $fee_heads->pros_fee_head_id,
                    'pros_amount'       => $fee_heads->amount,
                    'date'              => date('Y-m-d'),
                    'due_date'          => date('Y-m-d'),
                    'create_datetime'   => date('Y-m-d H:i:s'),
                );
                $challan_id = $this->CRUDModel->insert('prospectus_challan',$data);
                $set = array('form_no'=>$challan_id);
                $where_data        = array('student_id'=>$id);
                $this->CRUDModel->update('student_record',$set,$where_data);
        
//                redirect('admin/student_academic_record_pending/'.$id);
            
            redirect('admin/student_a_level_academic/'.$id);
          else:
            $this->data['page_title']   = 'Add New Student (Inter Level)  | ECMS';
            $this->data['page']         = 'admission/add_a_level_student';
            $this->load->view('common/common',$this->data);
        endif;
	}
    
    public function student_academic_record($id)
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
        redirect('admin/student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/student_academic_record/'.$this->input->post('student_id'));
        
        endif;
        endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree  ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', ' Select Board  ', 'bu_id', 'title');
            $order['column'] = 'yr_num';
            $order['order'] = 'desc';
            $this->data['year']                 = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num','',$order);
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students  | ECMS';
            $this->data['page']         = 'admission/academic_record';
            $this->load->view('common/common',$this->data);
    }
    
    public function student_academic_record_pending($id)
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
        redirect('admin/student_academic_record_pending/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/student_academic_record_pending/'.$this->input->post('student_id'));
        
        endif;
        endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree  ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', ' Select Board  ', 'bu_id', 'title');
            $order['column'] = 'yr_num';
            $order['order'] = 'desc';
            $this->data['year']                 = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num','',$order);
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students  | ECMS';
            $this->data['page']         = 'admission/academic_record_pending';
            $this->load->view('common/common',$this->data);
    }
    
    public function admin_student_academic_record($id)
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
        redirect('admin/admin_student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/admin_student_academic_record/'.$this->input->post('student_id'));
        
        endif;
        endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree  ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', ' Select Board  ', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students  | ECMS';
            $this->data['page']         = 'admission/academic_record_admin';
            $this->load->view('common/common',$this->data);
    }
    
    public function student_a_level_academic($id)
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
        redirect('admin/student_a_level_academic/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'grade_id'=>$this->input->post('grade_id'),
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/student_a_level_academic/'.$this->input->post('student_id'));
        
        endif;
        endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', ' Select degree  ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', ' Select Board  ', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students  | ECMS';
            $this->data['page']         = 'admission/student_a_level_academic';
            $this->load->view('common/common',$this->data);
    }
 
    public function add_hnd_student(){	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            $this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_new_student_record');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/hnd_student_academic_record/'.$id);
            endif;
            endif;
            $this->data['page_title']   = 'Add New HND Student  | ECMS';
            $this->data['page']         = 'admission/add_hnd_student';
            $this->load->view('common/common',$this->data);
            
	}
    
    public function hnd_student_academic_record($id){		
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
        redirect('admin/hnd_student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'grade_id'=>$this->input->post('grade_id'),
                'percentage'=>$this->input->post('percentage'),
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/hnd_student_academic_record/'.$this->input->post('student_id'));
            endif;
            endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'Select Board  ', 'bu_id', 'title');
			$this->data['grade']  = $this->CRUDModel->dropDown('grade', ' Select Grade ', 'grade_id', 'grade_name');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students (HND)  | ECMS';
            $this->data['page']         = 'admission/hnd_academic_record';
            $this->load->view('common/common',$this->data);
	}

    public function delete_student($id)
	{	
		$this->load->model('get_model');
        $this->get_model->delete_std($id);
        $this->session->set_flashdata('delete_msg','Student Record has been deleted');
        redirect('admin/student_record');
	}
    
    public function delete_academic_rec($id)
	{	
        $this->load->model('get_model');
        $this->get_model->delete_academic($id);
        $this->session->set_flashdata('delete_msg','Academic Record has been deleted');
        redirect('admin/admin_homecs_student_academic_record');	
	}
    
    public function delete_green_file_std($std_id,$id)
	{	
        $this->load->model('get_model');
        $this->get_model->delete_academic($id);
        $this->session->set_flashdata('delete_msg','Academic Record has been deleted');
        redirect('admin/update_green_file/'.$std_id);	
	}    
        
    public function admin_delete_academic_rec($id)
	{	
        $this->load->model('get_model');
        $this->get_model->delete_academic($id);
        $this->session->set_flashdata('delete_msg','Academic Record has been deleted');
        redirect('admin/all_student_record');	
	}    
        
    public function delete_alevel_cademic_rec($id)
	{	
        $this->load->model('get_model');
        $this->get_model->delete_academic($id);
        $this->session->set_flashdata('delete_msg','Academic Record has been deleted');
        redirect('admin/a_level_student_record');	
	}
   
     public function update_student(){	
        $uri                = $this->uri->segment(3);
        $sub_program_id     = $this->uri->segment(4);
        $session            = $this->session->all_userdata();
        $user_id            = $session['userData']['user_id'];
        $this->data['result']  = $this->get_model->studentData($uri);
        $this->data['sub_program_id'] = $sub_program_id;
        
        $where_sub  = array('student_id'=>$uri);
        $this->data['selectsubjects']   = $this->AdmissionModel->new_student_subject_get($where_sub);
        $this->data['allSubjects']      = $this->CRUDModel->get_where_result('subject',array('sub_pro_id'=>$sub_program_id));
//        echo '<pre>'; print_r($this->data['selectsubjects']); die;
        $this->data['guardian_of_relation']    = $this->CRUDModel->dropDown('relation', ' Relation ', 'relation_id', 'title');
        
         //New Changes In Update Page 
        
        $this->data['StudentInfo']              = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$uri)); 
        $this->data['batch']                    = $this->CRUDModel->dropDown('prospectus_batch', '','batch_id', 'batch_name',array('batch_id'=>$this->data['StudentInfo']->batch_id));
        $this->data['programes_info']           = $this->CRUDModel->dropDown('programes_info', '','programe_id', 'programe_name',array('programe_id'=>$this->data['StudentInfo']->programe_id));
        
        
        $this->data['reserved_seat']        = $this->CRUDModel->dropDown('reserved_seat', '', 'rseat_id', 'name'); 
        $this->data['gender']               = $this->CRUDModel->dropDown('gender', '', 'gender_id', 'title'); 
        $this->data['marital_status']       = $this->CRUDModel->dropDown('marital_status', '', 'marital_status_id', 'title'); 
        $this->data['blood_group']          = $this->CRUDModel->dropDown('blood_group', 'Blood Group', 'b_group_id', 'title'); 
        $this->data['mobile_network']       = $this->CRUDModel->dropDown('mobile_network', 'Mobile Network', 'net_id', 'network'); 
        $this->data['occupation']           = $this->CRUDModel->dropDown('occupation', 'Select Occupation', 'occ_id', 'title'); 
        $this->data['relation']             = $this->CRUDModel->dropDown('relation', 'Select Occupation', 'relation_id', 'title'); 
        
        if($this->input->post()){
             
            
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                =  $this->input->post('dob'); 
            $admission_date     =  $this->input->post('admission_date'); 
            $date1              = date('Y-m-d', strtotime($dob));
            $date2              = date('Y-m-d', strtotime($admission_date));
             
              $hostelInfo = $this->db->get_where('hostel_student_record',array('student_id'=>$uri))->row();
            
            if(!empty($hostelInfo)):
                
                $data = array(
                  'guardian_of_hostel'          => $this->input->post('guardian_of_hostel'),  
                  'guardian_hostel_relation'    => $this->input->post('guardian_of_relation'),  
                  'student_mobile_no'   => $this->input->post('student_mobile_no_hostel1'),  
                  'student_mobile_no2'   => $this->input->post('student_mobile_no_hostel2'),  
                  'city'                        => $this->input->post('city'),  
                );
                
            
                $this->CRUDModel->update('hostel_student_record',$data,array('student_id'=>$uri));
            endif;  
            
            
            $data_post = array
            (
                'batch_id'          => $this->input->post('batch_id'),
                'programe_id'       => $this->input->post('programe_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
                'form_no'           => $this->input->post('form_no'),
                'rseats_id'         => $this->input->post('rseats_id'),
                'rseats_id1'        => $this->input->post('rseats_id1'),
                'rseats_id2'        => $this->input->post('rseat_id2'),
                'comment'           => $this->input->post('comment'),
                'shift_id'          => $this->input->post('shift_id'),
                'college_no'        => $this->input->post('college_no'),
                'fata_school'       => $this->input->post('fata_school'),
                'student_name'      => $student,
                'student_cnic'      => $this->input->post('student_cnic'),
                'gender_id'         => $this->input->post('gender_id'),
                'marital_id'        => $this->input->post('marital_id'),
                'dob'               => $date1,
                'place_of_birth'    => $this->input->post('place_of_birth'),
                'bg_id'             => $this->input->post('bg_id'),
                'country_id'        => $this->input->post('country_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'district_id'       => $this->input->post('district_id'),
                'religion_id'       => $this->input->post('religion_id'),
//                'hostel_required'   => $this->input->post('hostel_required'),
                'migration_status'  => $this->input->post('migration_status'),
                'migrated_remarks'  => $this->input->post('migrated_remarks'),
                'father_name'       => $father,
                'father_cnic'       => $this->input->post('father_cnic'),
                'land_line_no'      => $this->input->post('land_line_no'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'applicant_mob_no1' => $this->input->post('applicant_mob_no1'),
                'applicant_mob_no2' => $this->input->post('applicant_mob_no2'),
                'occ_id'            => $this->input->post('occ_id'),
                'annual_income'     => $this->input->post('annual_income'),
                'app_postal_address' => $this->input->post('app_postal_address'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'last_school_address' => $this->input->post('last_school_address'),
                'father_email'      => $this->input->post('father_email'),
                'guardian_name'     => $guardian,
                'guardian_cnic'     => $this->input->post('guardian_cnic'),
                'relation_with_guardian' => $this->input->post('relation_with_guardian'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'g_annual_income'   => $this->input->post('g_annual_income'),
                'g_land_no'         => $this->input->post('g_land_no'),
                'g_mobile_no'       => $this->input->post('g_mobile_no'),
                'g_postal_address'  => $this->input->post('g_postal_address'),
                'g_email'           => $this->input->post('g_email'),
                'physical_status_id' => $this->input->post('physical_status_id'),
                'emargency_person_name' => $emargency_person,
                'e_person_relation' => $this->input->post('e_person_relation'),
                'e_person_contact1' => $this->input->post('e_person_contact1'),
                'e_person_contact2' => $this->input->post('e_person_contact2'),
                's_status_id'       => $this->input->post('s_status_id'),
                'bank_receipt_no'   => $this->input->post('bank_receipt_no'),
                'admission_date'    => $date2,
                'admission_comment' => $this->input->post('admission_comment'),
                'net_id' => $this->input->post('net_id'),
                'std_mobile_network' => $this->input->post('app_net_id'),
                'updated_by_user'   => $user_id,
                'updated_datetime'  => $current_datetime,
                'remarks'           => $this->input->post('remarks1'),
                'remarks2'          => $this->input->post('remarks2')
            ); 
             
             
            $college_no = $this->input->post('college_no');
            $where = array('college_no'=>$college_no,'s_status_id !='=>'9','student_id !='=>$uri);
            $query = $this->CRUDModel->get_where_row('student_record',$where);
            
            if(empty($query)):
                
                $new_subjects       = $this->input->post('checked');
                $checked_log        = $this->input->post('check_log');
//                echo '<pre>'; print_r($new_subjects); die;
                $checked_log = $this->CRUDModel->get_where_result('new_student_subjects', array('student_id'=>$uri));
//                echo '<pre>'; print_r($new_subjects); die;
                foreach($checked_log as $log_row){
                    $data =  array(
                            'student_id' =>$uri,
                            'subject_id' =>$log_row->subject_id,
                            'sub_prog_id' =>$log_row->sub_prog_id,
                            'created_by' =>$log_row->created_by,
                            'date_time' =>$log_row->date_time,
                            'updated_by' =>$user_id,
                            'update_date_time' =>date('Y-m-d H:i:s'),
                             );
                $this->CRUDModel->insert('new_student_subjects_log',$data );
                }
                $this->CRUDModel->deleteid('new_student_subjects', array('student_id'=>$uri));
                if(!empty($new_subjects)):
                    foreach($new_subjects as $row=>$value):
                    $dataa =  array(
                           'subject_id' =>$value,
                           'student_id' =>$uri,
                           'sub_prog_id' =>$this->input->post('sub_pro_id'),
                           'updated_by' =>$user_id,
                           'update_date_time' =>date('Y-m-d H:i:s'),
                     );
                $this->CRUDModel->insert('new_student_subjects',$dataa);
                endforeach; 
            endif;
                
                
                
                $this->get_model->updatestudent($data_post,$uri);
                
                $rollno     = $this->input->post('rollno');
                $udata      = array('rollno'=>$rollno);    
                $this->CRUDModel->update('applicant_edu_detail',$udata,array('student_id'=>$uri));     

                $batch_id           = $this->input->post('batch_id');
                $programe_id        = $this->input->post('programe_id');
                $sub_pro_id         = $this->input->post('sub_pro_id');
                $student_name       = $this->input->post('student_name');
                $form_no            = $this->input->post('form_no');
                $college_no         = $this->input->post('college_no');
                $shift_id           = $this->input->post('shift_id');
                $rseats_id          = $this->input->post('rseats_id');
                $rseats_id2         = $this->input->post('rseat_id2');
                $domicile_id        = $this->input->post('domicile_id');
                $mobile_no          = $this->input->post('mobile_no');
                $mobile_no2         = $this->input->post('mobile_no2');
                $old_programe_id    = $this->input->post('old_programe_id');
                $old_sub_pro_id     = $this->input->post('old_sub_pro_id');
                $old_batch_id       = $this->input->post('old_batch_id');
                $old_domicile_id    = $this->input->post('old_domicile_id');
                $old_student_name   = $this->input->post('old_student_name');
                $old_form_no        = $this->input->post('old_form_no');
                $old_college_no     = $this->input->post('old_college_no');
                $old_shift_id       = $this->input->post('old_shift_id');
                $old_rseats_id      = $this->input->post('old_rseats_id');
                $old_rseats_id2     = $this->input->post('old_rseats_id2');
                $old_mobile_no      = $this->input->post('old_mobile_no');
                $old_mobile_no2     = $this->input->post('old_mobile_no2');
			
                if($programe_id != $old_programe_id):
                    $old_p = $old_programe_id;
                else:
                    $old_p = 'NULL';	
                endif;
                if($batch_id != $old_batch_id):
                    $old_b = $old_batch_id;
                else:
                    $old_b = 'NULL';	
                endif;
                if($sub_pro_id != $old_sub_pro_id):
                    $old_sp = $old_sub_pro_id;
                else:
                    $old_sp = 'NULL';	
                endif;
                if($form_no != $old_form_no):
                    $old_f = $old_form_no;
                else:
                    $old_f = 'NULL';	
                endif;
                if($college_no != $old_college_no):
                    $old_c = $old_college_no;
                else:
                    $old_c = 'NULL';	
                endif;
                if($rseats_id != $old_rseats_id):
                    $old_r = $old_rseats_id;
                else:
                    $old_r = 'NULL';	
                endif;
                if($rseats_id2 != $old_rseats_id2):
                    $old_rs2 = $old_rseats_id2;
                else:
                    $old_rs2 = 'NULL';	
                endif;
                if($student_name != $old_student_name):
                    $old_sn = $old_student_name;
                else:
                    $old_sn = 'NULL';	
                endif;
                if($mobile_no != $old_mobile_no):
                    $old_m = $old_mobile_no;
                else:
                    $old_m = 'NULL';	
                endif;
                if($mobile_no2 != $old_mobile_no2):
                    $old_mb = $old_mobile_no2;
                else:
                    $old_mb = 'NULL';	
                endif;
                if($domicile_id != $old_domicile_id):
                    $old_dm = $old_domicile_id;
                else:
                    $old_dm = 'NULL';	
                endif;
                if($shift_id != $old_shift_id):
                    $old_sf = $old_shift_id;
                else:
                    $old_sf = 'NULL';	
                endif;
                    if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_sf == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && $old_rs2 == 'NULL' && 
                    $old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
                        redirect('admin/student_record');
                    else:
                        $data_log = array
                            (
                                'student_id'=>$uri,
                                'batch_id'=>$old_b,
                                'programe_id'=>$old_p,
                                'sub_pro_id'=>$old_sp,
                                'form_no'=>$old_f,
                                'shift_id'=>$old_sf,
                                'college_no'=>$old_c,
                                'rseats_id'=>$old_r,
                                'rseats_id2'=>$old_rs2,
                                'student_name'=>$old_sn,
                                'domicile_id'=>$old_dm,
                                'mobile_no'=>$old_m,
                                'mobile_no2'=>$old_mb,
                                'user_id'=>$user_id,
                                'date'=>date('Y-m-d'),
                                'timestamp'=>date('Y-m-d H:i:')
                            );
                        $this->CRUDModel->insert('student_record_logs',$data_log);
                        redirect('admin/student_record');
                    endif;
                    else:
                        $this->session->set_flashdata('msg', 'College No. Already Exist');
                        redirect('admin/update_student/'.$uri);
                    endif;
                }

                $this->data['page']             = "admission/inter/form/update_student_record";
                $this->load->view('common/common',$this->data);
            }
    
    public function admin_update_student(){	
        $uri = $this->uri->segment(3);
        $sub_program_id = $this->uri->segment(4);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['sub_program_id'] = $sub_program_id;
        
        $where_sub                              = array('student_id'=>$uri);
        $this->data['selectsubjects']           = $this->AdmissionModel->new_student_subject_get($where_sub);
        $this->data['allSubjects']              = $this->CRUDModel->get_where_result('subject',array('sub_pro_id'=>$sub_program_id));
        $this->data['guardian_of_relation']     = $this->CRUDModel->dropDown('relation', ' Relation ', 'relation_id', 'title');
        $this->data['hostel_approval']          = $this->CRUDModel->dropDown('hostel_form_approval', '', 'id', 'title'); 
        $this->data['mobile_network']           = $this->CRUDModel->dropDown('mobile_network', 'Mobile Network', 'net_id', 'network'); 
        $this->data['program']                  = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['result'] = $this->get_model->studentData($uri);
       if($this->input->post()){
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
             $data_post = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'std_mobile_network'=>$this->input->post('applicant_network'),
                'applicant_mob_no1'=>$this->input->post('applicant_mobile_no'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'rseats_id1'=>$this->input->post('rseats_id1'),
                'rseats_id2'=>$this->input->post('rseat_id2'),
                'comment'=>$this->input->post('comment'),
                'shift_id'=>$this->input->post('shift_id'),
                'college_no'=>$this->input->post('college_no'),
                'fata_school'=>$this->input->post('fata_school'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'student_email'=>$this->input->post('std_email'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
//                'hostel_required'=>$this->input->post('hostel_required'),
                'migration_status'=>$this->input->post('migration_status'),
                'migrated_remarks'=>$this->input->post('migrated_remarks'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'net_id'=>$this->input->post('net_id'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'bank_receipt_no'=>$this->input->post('bank_receipt_no'),
                'admission_date'=>$date2,
                'admission_comment'=>$this->input->post('admission_comment'),
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
                'remarks'=>$this->input->post('remarks1'),
                'remarks2'=>$this->input->post('remarks2')
            );
             
               $hostelInfo = $this->db->get_where('hostel_student_record',array('student_id'=>$uri))->row();
            
            if(!empty($hostelInfo)):
                
                $data = array(
                  'guardian_of_hostel'          => $this->input->post('guardian_of_hostel'),  
                  'guardian_hostel_relation'    => $this->input->post('guardian_of_relation'),  
                  'student_mobile_no'   => $this->input->post('student_mobile_no_hostel1'),  
                  'student_mobile_no2'   => $this->input->post('student_mobile_no_hostel2'),  
                  'city'                        => $this->input->post('city'),  
                  'approved_by'                        => $this->input->post('hostel_approved_by'),  
                );
                
            
                $this->CRUDModel->update('hostel_student_record',$data,array('student_id'=>$uri));
            endif;  
            
             
             $new_subjects       = $this->input->post('checked');
                $checked_log        = $this->input->post('check_log');
//                echo '<pre>'; print_r($new_subjects); die;
                $checked_log = $this->CRUDModel->get_where_result('new_student_subjects', array('student_id'=>$uri));
//                echo '<pre>'; print_r($new_subjects); die;
                foreach($checked_log as $log_row){
                    $data =  array(
                            'student_id' =>$uri,
                            'subject_id' =>$log_row->subject_id,
                            'sub_prog_id' =>$log_row->sub_prog_id,
                            'created_by' =>$log_row->created_by,
                            'date_time' =>$log_row->date_time,
                            'updated_by' =>$user_id,
                            'update_date_time' =>date('Y-m-d H:i:s'),
                             );
                $this->CRUDModel->insert('new_student_subjects_log',$data );
                }
                $this->CRUDModel->deleteid('new_student_subjects', array('student_id'=>$uri));
                if(!empty($new_subjects)):
                    foreach($new_subjects as $row=>$value):
                    $dataa =  array(
                           'subject_id' =>$value,
                           'student_id' =>$uri,
                           'sub_prog_id' =>$this->input->post('sub_pro_id'),
                           'updated_by' =>$user_id,
                           'update_date_time' =>date('Y-m-d H:i:s'),
                     );
                $this->CRUDModel->insert('new_student_subjects',$dataa);
                endforeach; 
            endif;
             
            
             
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$shift_id = $this->input->post('shift_id');
			$rseats_id = $this->input->post('rseats_id');
			$rseats_id2 = $this->input->post('rseat_id2');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_shift_id = $this->input->post('old_shift_id');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_rseats_id2 = $this->input->post('old_rseats_id2');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($rseats_id2 != $old_rseats_id2):
				$old_rs2 = $old_rseats_id2;
			else:
				$old_rs2 = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($shift_id != $old_shift_id):
				$old_sf = $old_shift_id;
			else:
				$old_sf = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_sf == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && $old_rs2 == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('admin/all_student_record');
			else:
            $data_log = array
                (
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'shift_id'=>$old_sf,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'rseats_id2'=>$old_rs2,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
				   'date'=>date('Y-m-d'),
				   'timestamp'=>date('Y-m-d H:i:'),
                    'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/all_student_record');
			endif;
        }
//       $this->load->view("common/header");
//       $this->load->view("common/nav");
//       $this->load->view("admission/admin_update_student_record", $this->data);
//       $this->load->view("common/footer");
        
       
       $this->data['page']             = "admission/admin_update_student_record";
        $this->load->view('common/common',$this->data);
	}
       
          
        
   public function update_student28032019()
    {	
        $uri        = $this->uri->segment(3);
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post())		
            {
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                = $_POST['dob']; 
            $admission_date     = $_POST['admission_date']; 
            $date1              = date('Y-m-d', strtotime($dob));
            $date2              = date('Y-m-d', strtotime($admission_date));
             $data_post = array
            (
                'batch_id'          => $this->input->post('batch_id'),
                'programe_id'       => $this->input->post('programe_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
                'form_no'           => $this->input->post('form_no'),
                'rseats_id'         => $this->input->post('rseats_id'),
                'rseats_id1'        => $this->input->post('rseats_id1'),
                'rseats_id2'        => $this->input->post('rseat_id2'),
                'comment'           => $this->input->post('comment'),
                'shift_id'          => $this->input->post('shift_id'),
                'college_no'        => $this->input->post('college_no'),
                'fata_school'       => $this->input->post('fata_school'),
                'student_name'      => $student,
                'student_cnic'      => $this->input->post('student_cnic'),
                'gender_id'         => $this->input->post('gender_id'),
                'marital_id'        => $this->input->post('marital_id'),
                'dob'               => $date1,
                'place_of_birth'    => $this->input->post('place_of_birth'),
                'bg_id'             => $this->input->post('bg_id'),
                'country_id'        => $this->input->post('country_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'district_id'       => $this->input->post('district_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'hostel_required'   => $this->input->post('hostel_required'),
                'migration_status'  => $this->input->post('migration_status'),
                'migrated_remarks'  => $this->input->post('migrated_remarks'),
                'father_name'       => $father,
                'father_cnic'       => $this->input->post('father_cnic'),
                'land_line_no'      => $this->input->post('land_line_no'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'occ_id'            => $this->input->post('occ_id'),
                'annual_income'     => $this->input->post('annual_income'),
                'app_postal_address' => $this->input->post('app_postal_address'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'last_school_address' => $this->input->post('last_school_address'),
                'father_email'      => $this->input->post('father_email'),
                'guardian_name'     => $guardian,
                'guardian_cnic'     => $this->input->post('guardian_cnic'),
                'relation_with_guardian' => $this->input->post('relation_with_guardian'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'g_annual_income'   => $this->input->post('g_annual_income'),
                'g_land_no'         => $this->input->post('g_land_no'),
                'g_mobile_no'       => $this->input->post('g_mobile_no'),
                'g_postal_address'  => $this->input->post('g_postal_address'),
                'g_email'           => $this->input->post('g_email'),
                'physical_status_id' => $this->input->post('physical_status_id'),
                'emargency_person_name' => $emargency_person,
                'e_person_relation' => $this->input->post('e_person_relation'),
                'e_person_contact1' => $this->input->post('e_person_contact1'),
                'e_person_contact2' => $this->input->post('e_person_contact2'),
                's_status_id'       => $this->input->post('s_status_id'),
                'bank_receipt_no'   => $this->input->post('bank_receipt_no'),
                'admission_date'    => $date2,
                'admission_comment' => $this->input->post('admission_comment'),
                'updated_by_user'   => $user_id,
                'updated_datetime'  => $current_datetime,
                'remarks'           => $this->input->post('remarks1'),
                'remarks2'          => $this->input->post('remarks2')
            ); 
             
            $college_no = $this->input->post('college_no');
            $where = array('college_no'=>$college_no,'s_status_id !='=>'9');
            $query = $this->CRUDModel->get_where_row('student_record',$where);
            
            if(empty($query)):
                
                $this->get_model->updatestudent($data_post,$uri);
                
                $rollno     = $this->input->post('rollno');
                $udata      = array('rollno'=>$rollno);    
                $this->CRUDModel->update('applicant_edu_detail',$udata,array('student_id'=>$uri));     

                $batch_id           = $this->input->post('batch_id');
                $programe_id        = $this->input->post('programe_id');
                $sub_pro_id         = $this->input->post('sub_pro_id');
                $student_name       = $this->input->post('student_name');
                $form_no            = $this->input->post('form_no');
                $college_no         = $this->input->post('college_no');
                $shift_id           = $this->input->post('shift_id');
                $rseats_id          = $this->input->post('rseats_id');
                $rseats_id2         = $this->input->post('rseat_id2');
                $domicile_id        = $this->input->post('domicile_id');
                $mobile_no          = $this->input->post('mobile_no');
                $mobile_no2         = $this->input->post('mobile_no2');
                $old_programe_id    = $this->input->post('old_programe_id');
                $old_sub_pro_id     = $this->input->post('old_sub_pro_id');
                $old_batch_id       = $this->input->post('old_batch_id');
                $old_domicile_id    = $this->input->post('old_domicile_id');
                $old_student_name   = $this->input->post('old_student_name');
                $old_form_no        = $this->input->post('old_form_no');
                $old_college_no     = $this->input->post('old_college_no');
                $old_shift_id       = $this->input->post('old_shift_id');
                $old_rseats_id      = $this->input->post('old_rseats_id');
                $old_rseats_id2     = $this->input->post('old_rseats_id2');
                $old_mobile_no      = $this->input->post('old_mobile_no');
                $old_mobile_no2     = $this->input->post('old_mobile_no2');
			
                if($programe_id != $old_programe_id):
                    $old_p = $old_programe_id;
                else:
                    $old_p = 'NULL';	
                endif;
                if($batch_id != $old_batch_id):
                    $old_b = $old_batch_id;
                else:
                    $old_b = 'NULL';	
                endif;
                if($sub_pro_id != $old_sub_pro_id):
                    $old_sp = $old_sub_pro_id;
                else:
                    $old_sp = 'NULL';	
                endif;
                if($form_no != $old_form_no):
                    $old_f = $old_form_no;
                else:
                    $old_f = 'NULL';	
                endif;
                if($college_no != $old_college_no):
                    $old_c = $old_college_no;
                else:
                    $old_c = 'NULL';	
                endif;
                if($rseats_id != $old_rseats_id):
                    $old_r = $old_rseats_id;
                else:
                    $old_r = 'NULL';	
                endif;
                if($rseats_id2 != $old_rseats_id2):
                    $old_rs2 = $old_rseats_id2;
                else:
                    $old_rs2 = 'NULL';	
                endif;
                if($student_name != $old_student_name):
                    $old_sn = $old_student_name;
                else:
                    $old_sn = 'NULL';	
                endif;
                if($mobile_no != $old_mobile_no):
                    $old_m = $old_mobile_no;
                else:
                    $old_m = 'NULL';	
                endif;
                if($mobile_no2 != $old_mobile_no2):
                    $old_mb = $old_mobile_no2;
                else:
                    $old_mb = 'NULL';	
                endif;
                if($domicile_id != $old_domicile_id):
                    $old_dm = $old_domicile_id;
                else:
                    $old_dm = 'NULL';	
                endif;
                if($shift_id != $old_shift_id):
                    $old_sf = $old_shift_id;
                else:
                    $old_sf = 'NULL';	
                endif;
                    if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_sf == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && $old_rs2 == 'NULL' && 
                    $old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
                        redirect('admin/student_record');
                    else:
                        $data_log = array
                            (
                                'student_id'=>$uri,
                                'batch_id'=>$old_b,
                                'programe_id'=>$old_p,
                                'sub_pro_id'=>$old_sp,
                                'form_no'=>$old_f,
                                'shift_id'=>$old_sf,
                                'college_no'=>$old_c,
                                'rseats_id'=>$old_r,
                                'rseats_id2'=>$old_rs2,
                                'student_name'=>$old_sn,
                                'domicile_id'=>$old_dm,
                                'mobile_no'=>$old_m,
                                'mobile_no2'=>$old_mb,
                                'user_id'=>$user_id,
                                'date'=>date('Y-m-d'),
                                'timestamp'=>date('Y-m-d H:i:')
                            );
                        $this->CRUDModel->insert('student_record_logs',$data_log);
                        redirect('admin/student_record');
                    endif;
                    else:
                        $this->session->set_flashdata('msg', 'College No. Already Exist');
                        redirect('admin/update_student/'.$uri);
                    endif;
                }
                
                $this->load->view("common/header");
                $this->load->view("common/nav");
                $this->load->view("admission/update_student_record", $prodata);
                $this->load->view("common/footer");
            }
    
    public function admin_update_student28032019()
    {	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
       if($this->input->post())		
            {
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
             $data_post = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'rseats_id1'=>$this->input->post('rseats_id1'),
                'rseats_id2'=>$this->input->post('rseat_id2'),
                'comment'=>$this->input->post('comment'),
                'shift_id'=>$this->input->post('shift_id'),
                'college_no'=>$this->input->post('college_no'),
                'fata_school'=>$this->input->post('fata_school'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'migration_status'=>$this->input->post('migration_status'),
                'migrated_remarks'=>$this->input->post('migrated_remarks'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'net_id'=>$this->input->post('net_id'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'bank_receipt_no'=>$this->input->post('bank_receipt_no'),
                'admission_date'=>$date2,
                'admission_comment'=>$this->input->post('admission_comment'),
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
                'remarks'=>$this->input->post('remarks1'),
                'remarks2'=>$this->input->post('remarks2')
            );
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$shift_id = $this->input->post('shift_id');
			$rseats_id = $this->input->post('rseats_id');
			$rseats_id2 = $this->input->post('rseat_id2');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_shift_id = $this->input->post('old_shift_id');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_rseats_id2 = $this->input->post('old_rseats_id2');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($rseats_id2 != $old_rseats_id2):
				$old_rs2 = $old_rseats_id2;
			else:
				$old_rs2 = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($shift_id != $old_shift_id):
				$old_sf = $old_shift_id;
			else:
				$old_sf = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_sf == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && $old_rs2 == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('admin/all_student_record');
			else:
            $data_log = array
                (
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'shift_id'=>$old_sf,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'rseats_id2'=>$old_rs2,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
				   'date'=>date('Y-m-d'),
				   'timestamp'=>date('Y-m-d H:i:'),
                    'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/all_student_record');
			endif;
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/admin_update_student_record", $prodata);
       $this->load->view("common/footer");
	}
   
   	public function update_a_level_student()
    {	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post())		
            {
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
                'hostel_required'=>$_POST['hostel_required'],
                'migration_status'=>$_POST['migration_status'],
                'migrated_remarks'=>$_POST['migrated_remarks'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'last_school_address'=>$_POST['last_school_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
          
            redirect('admin/a_level_student_record');
			else:
            $data_log = array
                (
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
                   'date'=>date('Y-m-d'),
				   'timestamp'=>date('Y-m-d H:i:'),
                    'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/a_level_student_record');
			endif;
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_a_level_student", $prodata);
       $this->load->view("common/footer");
	}
    
    	public function update_hnd_student(){	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post())			
        {
			$student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'last_school_address'=>$_POST['last_school_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
                        $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('admin/hnd_student_record');
			else:
            $data_log = array
                (
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
                   'date'=>date('Y-m-d'),
				   'timestamp'=>date('Y-m-d H:i:'),
                   'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/hnd_student_record');
			endif;
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_hnd_student", $prodata);
       $this->load->view("common/footer");
	}
    
    public function update_hnd_studentstatus($id)
	{	
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->studentData($id);
        $email = $this->session->userdata('email');
        $user_id = 0;
        $q = $this->db->query("select * from `users` where `email` = '$email'");
        $data["loginDetails"] = $q->result();
        foreach($q->result() as $row)
        {
            $user_id = $row->id;
        }
        if($_POST)		
            {
            $date = date("y:m:d:h:i:a");
            $data_post = array
				(
					'college_no'=>$_POST['college_no'],
					's_status_id'=>$_POST['s_status_id'],
					'admission_date'=>$_POST['admission_date'],
					'updated_datetime'=>$date,
					'admission_comment'=>$_POST['admission_comment'],
                    'updated_by_user'=>$user_id
				);
                $this->db->where('student_id',$id);
		        $this->db->update('student_record', $data_post);
                $this->db->where('student_id',$id);
                $qr = $this->db->get('student_record');
                $row = $qr->row();
                $addData = array
                (
                    'student_id' => $id,
                    's_status_id' => $row->s_status_id,
                    'date' => $row->admission_date,
                    'comment' => $row->admission_comment,
                    'user_id' => $user_id,
                );
            $this->db->insert('student_status_detail', $addData);
            //$this->get_model->updatestudent($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/hnd_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_hnd_studentstatus", $prodata);
       $this->load->view("common/footer");
	}
    
    public function update_academic_record($id)
	{	
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST)		
            {
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array
            (
                'degree_id'=>$_POST['degree_id'],
                'inst_id'=>$_POST['inst_id'],
                'bu_id'=>$_POST['bu_id'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'total_marks'=>$_POST['total_marks'],
                'obtained_marks'=>$_POST['obtained_marks'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'cgpa'=>$_POST['cgpa'],
                'grade_id'=>$_POST['grade_id'],
                'percentage'=>$percent,
                'exam_type'=>$_POST['exam_type'],
                'rollno'=>$_POST['board_no']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/all_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_academic_record", $prodata);
       $this->load->view("common/footer");
		
	}
    
    public function update_alevel_academic($id)
	{	
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST)		
            {
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array
            (
                'degree_id'=>$_POST['degree_id'],
                'inst_id'=>$_POST['inst_id'],
                'bu_id'=>$_POST['bu_id'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'total_marks'=>$_POST['total_marks'],
                'obtained_marks'=>$_POST['obtained_marks'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'cgpa'=>$_POST['cgpa'],
                'percentage'=>$percent,
                'grade_id'=>$_POST['grade_id'],
                'exam_type'=>$_POST['exam_type']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/a_level_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_alevel_academic_record", $prodata);
       $this->load->view("common/footer");
		
	}
    
    public function update_user()
	{	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $where = array('id'=>$user_id);
        $prodata['result'] = $this->CRUDModel->get_where_row('users',$where);
        
        
        
        if($this->input->post()):
        //echo '<pre>';print_r($this->input->post());die;
        
        $data_post = array
            (
                'password'=>md5($this->input->post('password'))
            );
            $this->CRUDModel->update('users',$data_post,$where);
            $this->session->unset_userdata('userData');
                redirect('login');
        endif;
           $this->load->view("common/header");
           $this->load->view("common/nav");
           $this->load->view("admission/update_user", $prodata);
           $this->load->view("common/footer");
		
	}
    
    public function upload_sphoto()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
			if($file_name == "_thumb"):		
//				$data = array(
//					'admission_date'=>$date
//				);
//				$where = array('student_id'=>$id); 
//				$this->CRUDModel->update('student_record',$data,$where);
			else: 
				$data = array(
					'applicant_image'=>$file_name,
//					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			endif;
            redirect('admin/student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload Student Picture  | ECMS';
            $this->data['page']        =  'admission/upload_sphoto';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function upload_a_level_sphoto()
    {
       $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
			if($file_name == "_thumb"):		
				$data = array(
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			else: 
				$data = array(
					'applicant_image'=>$file_name,
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			endif;
            redirect('admin/a_level_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload A Level Student Picture  | ECMS';
            $this->data['page']        =  'admission/upload_a_level_sphoto';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function upload_bcs_sphoto()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
			if($file_name == "_thumb"):		
				$data = array(
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			else: 
				$data = array(
					'applicant_image'=>$file_name,
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			endif;
            redirect('admin/cs_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload BCS Student Picture  | ECMS';
            $this->data['page']        =  'admission/upload_bcs_sphoto';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function upload_hnd_sphoto()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
			if($file_name == "_thumb"):		
				$data = array(
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			else: 
				$data = array(
					'applicant_image'=>$file_name,
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			endif;
            redirect('admin/hnd_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload HND Student Picture  | ECMS';
            $this->data['page']        =  'admission/upload_hnd_sphoto';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function upload_degree_sphoto()
    {
$id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
			if($file_name == "_thumb"):		
				$data = array(
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			else: 
				$data = array(
					'applicant_image'=>$file_name,
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			endif;
            redirect('admin/degree_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload Degree Student Picture  | ECMS';
            $this->data['page']        =  'admission/upload_degree_sphoto';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function admin_upload_sphoto()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
			if($file_name == "_thumb"):		
				$data = array(
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			else: 
				$data = array(
					'applicant_image'=>$file_name,
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			endif;
            redirect('admin/all_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Admin Upload Student Picture  | ECMS';
            $this->data['page']        =  'admission/admin_upload_sphoto';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function upload_sphoto_adding_picture()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
            $data = array('applicant_image'=>$file_name);
            $where = array('student_id'=>$id); 
            $this->CRUDModel->update('student_record',$data,$where);
            redirect('admin/adding_picture'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload Student Picture  | ECMS';
            $this->data['page']        =  'admission/upload_sphoto_adding_picture';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
  
    
    public function upload_fphoto($id)
	{
        $carry['suc'] = '';
        $this->load->model('get_model');
        $this->load->helper('file');

        $config['upload_path']   =   "./assets/images/fathers";  
        $config['allowed_types'] =   "gif|jpg|jpeg|png";   
        $config['max_size']      =   '*';     

        $this->load->library('upload',$config);
        $userfile = 'father_image';

        if($_POST)		
        {
                $this->upload->do_upload($userfile);

                $image_path=$this->upload->data();
                $file_name=$image_path['file_name'];
                $data = array
                (	
                    'father_image' => $file_name,
                );

                $this->get_model->upload_fpic($data, $id);
                $carry['suc'] = 'Picture Successfully Uploaded ';
                redirect('admin/student_record');
        }
        $carry['id'] = $id;	
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
        $this->load->view('upload_fphoto',$carry);	
        $this->load->view('footer');
	}
    
    public function student_profile(){	
        $id                             = $this->uri->segment(3);
        $this->data['student_id']       = $id;
        $where                          = array('student_record.student_id'=>$id);
        $this->data['result']           = $this->get_model->profileStudent($where);
        
        $this->data['student_records']  = $this->get_model->student_edu_record($where);
        $this->data['st_subj_data']     = $this->get_model->get_applicant_subjects('new_student_subjects', array('new_student_subjects.student_id'=>$id));
        $this->data['st_art_sub_data']  = $this->get_model->get_art_student_subjects('student_subject_alloted', array('student_subject_alloted.student_id'=>$id));
        
        $this->data['page_title']       = 'Student Profile   | ECMS';
        $this->data['page']             = 'admission/student_profile';
        $this->load->view('common/common',$this->data);
	}
    
    public function admin_student_profile($id)
	{	
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $where = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->get_model->profileStudent($where);
        $this->data['student_records'] =$this->get_model->student_edu_record($where);
        $this->data['page_title']   = 'Student Profile   | ECMS';
        $this->data['page']         = 'admission/admin_student_profile';
        $this->load->view('common/common',$this->data);
	}
    
    public function a_level_student_profile($id)
	{	
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $where = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->get_model->profileStudent($where);
        $this->data['student_records'] =$this->get_model->student_edu_record($where);
        $this->data['page_title']   = 'Student Profile   | ECMS';
        $this->data['page']         = 'admission/a_level_student_profile';
        $this->load->view('common/common',$this->data);
	}
    
    public function hnd_student_profile($id)
	{	
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $where = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->get_model->profileStudent($where);
        $this->data['student_records'] =$this->get_model->student_edu_record($where);
        $this->data['page_title']   = 'Student Profile   | ECMS';
        $this->data['page']         = 'admission/hnd_student_profile';
        $this->load->view('common/common',$this->data);
	}
    
    public function update_programe($id)
	{	
        $prodata['result'] = $this->get_model->programeData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'programe_name'=>$_POST['programe_name'],
                'status'=>$_POST['status'],
                'degree_type_id'=>$_POST['degree_type_id']
            );
            $this->get_model->updateprograme($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/programes');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_programes", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
	/*
    public function update_section($id)
	{	
        $prodata['result'] = $this->get_model->sectionData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'name'=>$_POST['name'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'seats_allowed'=>$_POST['seats_allowed'],
                'status'=>$_POST['status'],
                'batch_id'=>$_POST['batch_id'],
                'program_id'=>$_POST['program_id']
            );
            $this->get_model->updatesection($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/section');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_section", $prodata);
       $this->load->view("admission/parts/footer");
	}
    */
	
	public function update_section()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $data= array
            (
                'name'=>$this->input->post('name'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'seats_allowed'=>$this->input->post('seats_allowed'),
                'status'=>$this->input->post('status'),
                'batch_id'=>$this->input->post('batch_id'),
                'program_id'=>$this->input->post('program_id')
            );
			$where = array('sec_id'=>$id); 
            $this->CRUDModel->update('sections',$data,$where);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/section');
           endif;
        if($id):
            $where = array('sec_id'=>$id);
            $this->data['result'] = $this->get_model->sectionData('sections',$where);
            $this->data['page_title']        = 'Updae Section | ECMS';
            $this->data['page']        =  'admission/update_section';
            $this->load->view('common/common',$this->data);
        endif;
    }
	
    public function update_seat($id)
	{
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->seatData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'name'=>$_POST['name']
            );
            $this->get_model->updateseat($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/reserved_seats');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_seats", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    
    public function update_sub_programe($id)
	{	
        $prodata['result'] = $this->get_model->sub_programeData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'name'=>$_POST['name'],
                'status'=>$_POST['status'],
                'programe_id'=>$_POST['programe_id'],
                'flag'=>$_POST['flag']
            );
            $this->get_model->updatesub_programe($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/sub_programes');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_sub_programes", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_p_sale($id)
	{	
        $prodata['result'] = $this->get_model->p_saleData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'date'=>$_POST['date'],
                'total_pros_issue'=>$_POST['total_pros_issue'],
                'total_amount'=>$_POST['total_amount'],
                'batch_id'=>$_POST['batch_id']
            );
            $this->get_model->updatep_sale($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/prospectus_sale');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_prospectus_sale", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_p_batch($id)
	{	
        $prodata['result'] = $this->get_model->p_batchData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'batch_name'        => $this->input->post('batch_name'),
                'prospectus_amount' => $this->input->post('prospectus_amount'),
                'status'            => $this->input->post('status'),
                'date_of_issuance'  => $this->input->post('date_of_issuance'),
                'programe_id'       => $this->input->post('programe_id'),
                'status_flag'       => $this->input->post('s_flag')
            );
//            echo '<pre>'; print_r($data_post); die;
            $this->get_model->updatep_batch($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/prospectus_batch');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_prospectus_batch", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_district($id)
	{	
        $prodata['result'] = $this->get_model->districtData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'name'=>$_POST['name']
            );
            $this->get_model->updatedistrict($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/district');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_district", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_domicile($id)
	{	
        $prodata['result'] = $this->get_model->domicileData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'name'=>$_POST['name']
            );
            $this->get_model->updatedomicile($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/domicile');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_domicile", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_country($id)
	{	
        $prodata['result'] = $this->get_model->countryData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'name'=>$_POST['name']
            );
            $this->get_model->updatecountry($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/country');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_country", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_degree_type($id)
	{
        $prodata['result'] = $this->get_model->degree_typeData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'name'=>$_POST['name']
            );
            $this->get_model->updatedegree_type($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/degree_type');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_degree_type", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_shift($id)
	{
        $prodata['result'] = $this->get_model->shiftData($id);
            if($_POST)		
                {
                $data_post = array
                (
                    'name'=>$_POST['name']
                );
                $this->get_model->updateshift($data_post,$id);
                $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
                redirect('admin/shift');
            }
           $this->load->view("admission/parts/header");
           $this->load->view("admission/parts/nav");
           $this->load->view("update_shift", $prodata);
           $this->load->view("admission/parts/footer");
	}
    
    public function update_s_status($id)
	{	
        $prodata['result'] = $this->get_model->s_statusData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'name'=>$_POST['name']
            );
            $this->get_model->updates_status($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/s_status');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("update_student_status", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_institute($id)
	{
        $prodata['result'] = $this->get_model->instituteData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'title'=>$_POST['title']
            );
            $this->get_model->updateinstitute($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/institute');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_institute", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_subject($id)
	{	
        $prodata['result'] = $this->get_model->subjectData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'title'=>$_POST['title']
            );
            $this->get_model->updatesubject($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/subject');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("update_subject", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_degree($id)
	{	
        $prodata['result'] = $this->get_model->degreeData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'title'=>$_POST['title']
            );
            $this->get_model->updatedegree($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/degree');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_degree", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_religion($id)
	{	
        $prodata['result'] = $this->get_model->religionData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'title'=>$_POST['title']
            );
            $this->get_model->updatereligion($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/religion');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_religion", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_physical_status($id)
	{	
		$prodata['result'] = $this->get_model->physical_statusData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'title'=>$_POST['title']
            );
            $this->get_model->updatephysical_status($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/physical_status');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_physical_status", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_relation($id)
	{
        $prodata['result'] = $this->get_model->relationData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'title'=>$_POST['title']
            );
            $this->get_model->updaterelation($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/relation');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_relation", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
    public function update_occupation($id)
	{
        $prodata['result'] = $this->get_model->occupationData($id);
        if($_POST)		
            {
            $data_post = array
            (
                'title'=>$_POST['title']
            );
            $this->get_model->updateoccupation($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/occupation');
        }
       $this->load->view("admission/parts/header");
       $this->load->view("admission/parts/nav");
       $this->load->view("admission/update_occupation", $prodata);
       $this->load->view("admission/parts/footer");
	}
    
   
    public function user()
    {
           $this->load->model("get_model");
           $data['result'] = $this->get_model->getuser();
           $this->load->view("admission/parts/header");
		   $this->load->view("admission/parts/nav");
		   $this->load->view("user", $data);
		   $this->load->view("admission/parts/footer");
       
    }
    
    
        public function uniqueForm(){
                
                    $formNumber = $this->input->post('formNumber');
                    $batch_id = $this->input->post('batch_id');

                    $where = array('form_no'=>$formNumber,'batch_id'=>$batch_id);
                       $Query = $this->CRUDModel->get_where_row('student_record',$where);
                       if($Query):
                           echo 1;
                           else:
                           echo 0;
                       endif;
    }
    
   public function degree_student_record()
    {
        $whereSub_pro                   = array('programe_id'=>4);
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
        $this->data['status']           = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
        $like = '';
            $where = '';
			$this->data['batchId']          = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
           
            $where['student_record.programe_id'] = 4;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.programe_id'=>4,'student_record.s_status_id'=>5);
        $config['base_url']   = base_url('admin/degree_student_record');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
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
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
        $this->data['pages']        = $this->pagination->create_links();          
        $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count']     =$config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Students Record (Degree Level) | ECMS';
        $this->data['page']         = 'admission/degree_student_record';
        $this->load->view('common/common',$this->data);
        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record Degree');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'F.No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Father name');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Clg #');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Gender');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Reserved Seats');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Section');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Student status');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Mobile Number');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Domicile');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Hostel Allotted');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('T1','Fata School');
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('T'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id          =  $this->input->post('s_status_id');
			$batch               =  $this->input->post('batch');
            $limit              =  $this->input->post('limit');
            $like = '';
            $where = '';
            $where['student_record.programe_id'] = 4;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
			if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_Degree.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
    }  
    
    public function add_degree_student()
	{	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            $this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_new_student_record');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id     
				);
                $id = $this->CRUDModel->insert('student_record',$data);
                redirect('admin/degree_student_academic_record/'.$id);
                 endif;
                 endif;
                $this->data['page_title']   = 'Add New Degree Student  | ECMS';
                $this->data['page']         = 'admission/add_degree_student';
                $this->load->view('common/common',$this->data);
               
	}
    
    public function degree_student_academic_record($id)
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
        redirect('admin/degree_student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/degree_student_academic_record/'.$this->input->post('student_id'));
        endif;
        endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', ' Select degree  ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', ' Select Board  ', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Degree Academic Record of Student  | ECMS';
            $this->data['page']         = 'admission/degree_student_academic_record';
            $this->load->view('common/common',$this->data);
	}
    
    	public function update_degree_student()
	{	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post())
        {
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('admin/degree_student_record');
			else:
            $data_log = array
                (
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
                   'date'=>date('Y-m-d'),
				   'timestamp'=>date('Y-m-d H:i:'),
                   'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
			redirect('admin/degree_student_record');
			endif;
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_degree_student", $prodata);
       $this->load->view("common/footer");
	}
    
    public function cs_student_profile($id)
	{	
       $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $where = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->get_model->profileStudent($where);
        $this->data['student_records'] =$this->get_model->student_edu_record($where);
        $this->data['page_title']   = 'Student Profile   | ECMS';
        $this->data['page']         = 'admission/cs_student_profile';
        $this->load->view('common/common',$this->data); 
	}
    

    
    public function update_cs_studentstatus($id)
	{	
        $prodata['result'] = $this->get_model->studentData($id);
        $email = $this->session->userdata('email');
        $user_id = 0;
        $q = $this->db->query("select * from `users` where `email` = '$email'");
        $data["loginDetails"] = $q->result();
        foreach($q->result() as $row)
        {
            $user_id = $row->id;
        }
        if($_POST)		
            {
                $date = date("y:m:d:h:i:a");
            $data_post = array
				(
					'college_no'=>$_POST['college_no'],
					's_status_id'=>$_POST['s_status_id'],
					'admission_date'=>$_POST['admission_date'],
					'updated_datetime'=>$date,
					'admission_comment'=>$_POST['admission_comment'],
                    'updated_by_user'=>$user_id
				);
                $this->db->where('student_id',$id);
		        $this->db->update('student_record', $data_post);
                $this->db->where('student_id',$id);
                $qr = $this->db->get('student_record');
                $row = $qr->row();
                $addData = array
                (
                    'student_id' => $id,
                    's_status_id' => $row->s_status_id,
                    'date' => $row->admission_date,
                    'comment' => $row->admission_comment,
                    'user_id' => $user_id,
                );
            $this->db->insert('student_status_detail', $addData);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/cs_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_cs_studentstatus", $prodata);
       $this->load->view("common/footer");
	}
    
    public function update_degree_studentstatus($id)
	{	
        $prodata['result'] = $this->get_model->studentData($id);
        $email = $this->session->userdata('email');
        $user_id = 0;
        $q = $this->db->query("select * from `users` where `email` = '$email'");
        $data["loginDetails"] = $q->result();
        foreach($q->result() as $row)
        {
            $user_id = $row->id;
        }
        if($_POST)		
            {
                $date = date("y:m:d:h:i:a");
            $data_post = array
            (
                'college_no'=>$_POST['college_no'],
                's_status_id'=>$_POST['s_status_id'],
                'admission_date'=>$_POST['admission_date'],
                'updated_datetime'=>$date,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id
            );
            $this->db->where('student_id',$id);
            $this->db->update('student_record', $data_post);
            $this->db->where('student_id',$id);
            $qr = $this->db->get('student_record');
            $row = $qr->row();
            $addData = array
            (
                'student_id' => $id,
                's_status_id' => $row->s_status_id,
                'date' => $row->admission_date,
                'comment' => $row->admission_comment,
                'user_id' => $user_id,
            );
            $this->db->insert('student_status_detail', $addData);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/degree_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_degree_studentstatus", $prodata);
       $this->load->view("common/footer");
	}
    
    public function degree_student_profile($id)
	{	
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $where = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->get_model->profileStudent($where);
        $this->data['student_records'] =$this->get_model->student_edu_record($where);
        $this->data['page_title']   = 'Student Profile   | ECMS';
        $this->data['page']         = 'admission/degree_student_profile';
        $this->load->view('common/common',$this->data);
	}
    
    public function form_no_Checking(){
        
       $formId      = $this->input->post('formId');
       $batch_id    = $this->input->post('batch_id');
       $where = array('batch_id'=>$batch_id,'form_no'=>$formId);
       $query = $this->CRUDModel->get_where_row('student_record',$where);
       if($query):
           echo TRUE;
           else:
           echo FALSE;
       endif;
       
    }   

	 public function form_no_Check(){
        
       $formId      = $this->input->post('formId');
       $batch_id    = $this->input->post('batch_id');
       $where = array('batch_id'=>$batch_id,'form_no'=>$formId);
       $query = $this->CRUDModel->get_where_row('student_record',$where);
       if($query):
           echo TRUE;
           else:
           echo FALSE;
       endif; 
    } 	
    
   public function college_no_Checking(){ 
       $college_no  = $this->input->post('college_no');
       $where       = array('college_no'=>$college_no);
       $this->db->where('s_status_id',5);
//       $this->db->where_not_in('s_status_id',array(9,14));
       $query = $this->db->get_where('student_record',$where)->row();
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
    
    
    public function year_head_subjects(){
            
        if($this->input->post('saveSearch')):
            $subject_id     = $this->input->post('subject_id');
            $checked        = $this->input->post('checked');
            $sec_id        = $this->input->post('sectionId');
         
            $userIndo =$this->getUser();
            foreach($checked as $strId=>$key):
                $where = array(
                    'student_id'    =>$key,
                    'subject_id'    =>$subject_id,
                    
                );
            
           $id =  $this->CRUDModel->get_where_row('student_subject_alloted',$where);
               if($id):
              $this->session->set_flashdata('subject_msg', '<strong>Warning</strong> <a href="#" class="alert-link"> Subject Already Exist.</a>');
                redirect('admin/year_head_subjects');
                   else:
                            $data = array(
                    'student_id'    =>$key,
                    'subject_id'    =>$subject_id,
                    'section_id'    =>$sec_id,
                    'user_id'       =>$userIndo['user_id'],
                    'timestamp'       =>date('Y-m-d H:i:s')
                    
                );
             $this->CRUDModel->insert('student_subject_alloted',$data);
               endif; 
                
       
            endforeach;
            redirect('Admin/year_head_subjects');
        endif;
        if($this->input->post('search')):
             
            $college_no     = $this->input->post('college_no');
            $student_name   = $this->input->post('student_name');
            $father_name    = $this->input->post('father_name');
            $sub_proId      = $this->input->post('sub_proId');
            $session_id     = $this->input->post('session_id');
            
            $where = '';
            $like = '';
            
            if($college_no):
              $where['student_record.college_no'] = $college_no;   
            endif;
            
            if($sub_proId):
              $where['student_record.sub_pro_id'] = $sub_proId;   
            endif;
            
            if($session_id):
              $where['sec_id'] = $session_id;   
              $this->data['sec_id'] = $session_id;   
            endif;
           
            if($student_name):
              $like['student_name'] = $student_name;   
            endif;
            
            if($father_name):
              $like['father_name'] = $father_name;   
            endif;
            
             $this->data['searchResult'] = $this->AttendanceModel->get_year_head_result($where,$like);
             
          
        endif;
          
          
        $wheresPrg                      = array('status'=>'yes','programe_id'=>1);
        $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',$wheresPrg);  
        $wheresSec    = array('status'=>'On','program_id'=>1);
        $this->data['sections']         = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id', 'name',$wheresSec);  
        $wheresSub                      = array('subject.programe_id'=>1);
        $this->data['subject']          = $this->AttendanceModel->dropDown_yearHead('subject', 'subject', 'subject_id', 'title',$wheresSub);  
        $this->data['page_title']       = 'Year Head Subjects | ECMS';
        $this->data['page']             =  'attendance/year_head_subjects';
        $this->load->view('common/common',$this->data); 
    }
    public function get_session_name(){
        
        $subProId =  $this->input->post('subProId');
        
      $result = $this->CRUDModel->get_where_result('sections',array('sub_pro_id'=>$subProId,'status'=>'On'));
    echo '<option value="">Sections</option>';
      foreach($result as $subRow):
          echo '<option value="'.$subRow->sec_id.'">'.$subRow->name.'</option>';
      endforeach;
    }
    
    public function green_file()
    {       
        
          
           $this->data['limit']         = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $config['base_url']         = base_url('Admin/green_file');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>9)));  
            
            $config['per_page']         = 50;
            $config["num_links"]        = 3;
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
            $this->data['result']    = $this->get_model->greenFile($config['per_page'], $page,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'Students Green File | ECMS';
           $this->data['page']         = 'admission/green_file';
           $this->load->view('common/common',$this->data);
    }
    
    public function update_green_file($id){
        $id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $dob = $this->input->post('dob');
	    $admission_date = $this->input->post('admission_date');
	    $certificate_issue_date = $this->input->post('certificate_issue_date');
	    $dob_date = date('Y-m-d', strtotime($dob));
            $admission_d = date('Y-m-d', strtotime($admission_date));
            $issue_date = date('Y-m-d', strtotime($certificate_issue_date));
            $data       = array(
                'admitted_to'=>$this->input->post('admitted_to'),
                'college_no'=>$this->input->post('college_no'),
                'board_regno'=>$this->input->post('board_regno'),
                'uni_regno'=>$this->input->post('uni_regno'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'father_name'=>$father,
                'occ_id'=>$this->input->post('occ_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'dob'=>$dob_date,
                'sports_id'=>$this->input->post('sports_id'),
                'app_postal_address'=>$this->input->post('postal_address'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'hostel_required'=>$_POST['hostel_required'],
                'char_id'=>$_POST['char_id'],
                'admission_date'=>$admission_d,
                'certificate_issue_date'=>$issue_date,
                'dues_any'=>$this->input->post('dues_any'),
                'remarks'=>$this->input->post('remarks'),
                'remarks2'=>$this->input->post('remarks2'),
                'updated_by_user'=>$user_id
            );
              $where = array('student_id'=>$id);
              $this->CRUDModel->update('student_record',$data,$where);
                 $academic_data = array
                (
                    'student_id'=>$id,
                    'degree_id'=>$this->input->post('degree_id'),
                    'inst_id'=>$this->input->post('inst_id'),
                    'bu_id'=>$this->input->post('bu_id'),
                    'year_of_passing'=>$this->input->post('year_of_passing'),
                    'total_marks'=>$this->input->post('total_marks'),
                    'obtained_marks'=>$this->input->post('obtained_marks'),
                    'year_of_passing'=>$this->input->post('year_of_passing'),
                    'grade_id'=>$this->input->post('grade_id'),
                    'rollno'=>$this->input->post('rollno'),
                    'inserteduser'=>$user_id
                );
                $query = $this->CRUDModel->get_where_row('applicant_edu_detail',$where);
                if($query):
                    $this->CRUDModel->update('applicant_edu_detail',$academic_data,array('student_id'=>$id,'serial_no'=>$this->input->post('serial_no')));
                else:
                endif;
              redirect('Admin/green_file'); 
           endif;
            if($id):
                $where = array('student_record.student_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

                $this->data['student_record'] =$this->get_model->student_edu_record_limit_record($where);
                $this->data['student_records'] =$this->get_model->student_edu_record1($where);

                $this->data['page_title']        = 'Update Green File Record | ECMS';
                $this->data['page']        =  'admission/update_green_file';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
        }
    
    public function insertAcademic()
    {
       if($this->input->post()):
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $student_id         = $this->input->post('student_id');
            $rollno             = $this->input->post('rollno');
            $year_of_passing    = $this->input->post('year_of_passing');
            $total_marks        = $this->input->post('total_marks');
            $obtained_marks     = $this->input->post('obtained_marks');
            $grade_id      = $this->input->post('grade_id');
            $data       = array(
                'student_id' => $student_id,
                'sub_pro_id' =>$sub_pro_id,
                'rollno' =>$rollno,
                'year_of_passing' =>$year_of_passing,
                'total_marks' =>$total_marks,
                'obtained_marks' =>$obtained_marks,
                'grade_id' =>$grade_id,
            );
    $this->CRUDModel->insert('applicant_edu_detail',$data);
    $result = $this->get_model->student_edu_record1(array('student_record.student_id'=>$student_id));
       echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Roll No</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>Passing Year</th>
                            <th>Grade</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                        if($result):
                        foreach($result as $eRow):
                        
                        echo '<tr>
                                <td>'.$eRow->sub_program.'</td>
                                <td>'.$eRow->rollno.'</td>
                                <td>'.$eRow->total_marks.'</td>
                                <td>'.$eRow->obtained_marks.'</td>
                                <td>'.$eRow->year_of_passing.'</td>
                                <td>'.$eRow->grade.'</td>
         <td><a href="admin/delete_green_file_std/'.$student_id.'/'.$eRow->serial_no.'" onclick="return confirm("Are You Want to Delete This..?")">Delete</a></td>                            
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        endif; 
    }    
  /* 
   public function insertAcademic12()
    {
       if($this->input->post()):
             
            $student_id     = $this->input->post('student_id');
 
        $result = $this->get_model->student_edu_record1(array('student_record.student_id'=>$student_id));
       echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Roll No</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>Passing Year</th>
                            <th>Grade</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                        if($result):
                        foreach($result as $eRow):
                        
                        echo '<tr>
                             <td>'.$eRow->sub_program.'</td>
                                <td>'.$eRow->rollno.'</td>
                                <td>'.$eRow->total_marks.'</td>
                                <td>'.$eRow->obtained_marks.'</td>
                                <td>'.$eRow->year_of_passing.'</td>
                                <td>'.$eRow->grade.'</td>
         <td><a href="admin/delete_green_file_std/'.$student_id.'/'.$eRow->serial_no.'" onclick="return confirm("Are You Want to Delete This..?")">Delete</a></td>                            
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        endif; 
    } 
    */
    
    public function year_head_comment(){              
           $this->data['headerPage']   = 'Year Head Comment';
        $this->data['artStudents']  = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>'1'));  
        $where                      = array('student_record.programe_id'=>'1','student_record.s_status_id'=>'5');
         
        $config['base_url']         = base_url('admin/year_head_comment');
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
        $custom['column']           = 'student_id';
        $custom['order']            = 'desc';
        $this->data['result']       = $this->get_model->stds_arts_pagination($config['per_page'], $page,$where,$custom);
        $this->data['count']        = $config['total_rows']; 
        $this->data['page_title']   = 'Year Head Comment | ECMS';
        $this->data['page']         = 'admission/year_head_comment';
        $this->load->view('common/common',$this->data); 
    }
    
public function search_year_head_student(){
         $this->data['headerPage']   = 'Year Head Comment';
        $where                    = array('student_record.programe_id'=>'1','student_record.s_status_id'=>'5');
        $this->data['artStudents']  = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>'1'));  
       
      
        $whereSub_pro  = array('programe_id'=>1);
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
        $this->data['reserved_seat']= $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
        $this->data['status']       = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']        = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        if($this->input->post('search')):
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 1;
            $where['student_record.s_status_id'] = 5;
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
                $this->data['result']   = $this->get_model->get_artsstdData('student_record',$where,$like,$custom);    
                $this->data['page']     = "admission/search_year_head_student";
                $this->data['title']    = 'Year Head Search Student | ECMS';
                $this->load->view('common/common',$this->data);
        endif;
     }  
     
     public function year_head_edit_student(){
        $id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
        $student_id = $this->uri->segment(3);
       
            $data = array(
                'temporary_yead_head_flag'=>$this->input->post('temporary_yead_head_flag'),
                'temporary_yead_head_comment'=>$this->input->post('temporary_yead_head_comment'),
                'student_id'=>$student_id,
                'year_head_user_id'   =>$user_id
            );
            $where = array('student_id'=>$id);
            $this->CRUDModel->update('student_record',$data,$where);
              redirect('admin/year_head_comment'); 
              endif;
        if($id):
                $where = array('student_record.student_id'=>$id);
                $this->data['result']       = $this->CRUDModel->get_where_row('student_record',$where);
                $this->data['page_title']   = 'Year Head Edit Student| ECMS';
                $this->data['page']         =  'admission/year_head_edit_student';
                $this->load->view('common/common',$this->data);
        else:
            redirect('/');
        endif;
    }
    
    public function student_change_status()
    {       
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
        $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));   
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit ', 'limitId', 'limit_value');
        $college_no                     =  $this->input->post('college_no');
        $form_no                        =  $this->input->post('form_no');
        $student_name                   =  $this->input->post('student_name');
        $father_name                    =  $this->input->post('father_name');
        $program                        =  $this->input->post('program');
        $sub_program                    =  $this->input->post('sub_program');
        $batch                          =  $this->input->post('batch');
        $s_status_id                    =  $this->input->post('s_status_id');
        $like = '';
            $where['student_record.s_status_id !='] = 1;
            $where['student_record.s_status_id !='] = 9;
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['programId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']          = '';
            $this->data['s_status_id']          = '';
            
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
             if(!empty($s_status_id)):
                 $where['student_record.s_status_id'] = $s_status_id;
                $this->data['s_status_id'] = $s_status_id;
            endif;
            if($this->input->post('search')):          
                $field = '
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                    ';

        $this->data['result'] = $this->get_model->student_status_change($field,'student_record', $where,$like);
            else:
            $where = array('s_status_id'=>'5');
            $config['base_url']         = base_url('Admin/student_change_status');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 50;
            $config["num_links"]        = 3;
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
            $this->data['result']    = $this->get_model->admin_stdData($config['per_page'], $page,$custom);
            $this->data['count']     =$config['total_rows']; 
            endif;
           $this->data['page_title']   = 'Student Change Status | ECMS';
           $this->data['page']         = 'admission/student_change_status';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function update_studentstatus(){
        
        $student_id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student_id   = $this->input->post('student_id');
            $old_s_status_id   = $this->input->post('old_s_status_id');
            $s_status_id   = $this->input->post('s_status_id');
            $admission_date   = $this->input->post('admission_date');
	    $date1 = date('Y-m-d', strtotime($admission_date));
            $admission_comment   = $this->input->post('admission_comment');
            $date = date("y:m:d:h:i:a");
             
            $data = array
                (
                   's_status_id'=>$s_status_id,      
                   'updated_datetime'=>$date,      
                   'updated_by_user'=>$user_id      
                );
           $where = array('student_id'=>$student_id);
          
           $this->CRUDModel->update('student_record',$data,$where);
           if($s_status_id  != $old_s_status_id):
	      $old_st = $old_s_status_id;
			else:
				$old_st = 'NULL';
			endif;
$data_post = array
            (
                'student_id'=>$student_id,
                's_status_id'=>$old_st ,
                'date'=>$date1,
                'comment'=>$admission_comment,
                'timestamp'=>$date,
                'user_id'=>$user_id
            );	
	$this->CRUDModel->insert('student_status_detail',$data_post);   
             $student_info = $this->CRUDModel->get_where_row('hostel_student_record',array('student_id'=>$student_id));
            if(!empty($student_info)):
                 if(
                         $s_status_id == 13 || 
                         $s_status_id == 7  || 
                         $s_status_id == 6  || 
                         $s_status_id == 8  || 
                         $s_status_id == 10 || 
                        $s_status_id == 13   
                         ):
                     
                        $where_hostel_data = array(
                          'hostel_status_id'=>2
                          );
                      $where_hostel = array(
                          'student_id'=>$student_id
                          );
                      
                      if($student_info->hostel_status_id != '5'):
                          $this->CRUDModel->update('hostel_student_record',$where_hostel_data,$where_hostel);
                      endif;
                    
                endif;
                 if($s_status_id == 9):
                     
                        $where_hostel_data = array(
                          'hostel_status_id'=>4
                          );
                      $where_hostel = array(
                          'student_id'=>$student_id
                          );
                    $this->CRUDModel->update('hostel_student_record',$where_hostel_data,$where_hostel);
                endif;
            endif;
           
           
        redirect('admin/student_change_status');
        endif;
        if($student_id):
            $where = array('student_record.student_id'=>$student_id);
            $this->data['result'] = $this->get_model->get_student_statusdata('student_record',$where);
            $this->data['result_status'] = $this->get_model->get_statusData('student_status_detail',$where);
            $this->data['page_title']   = 'Students Change Status | ECMS';
            $this->data['page']         = 'admission/update_studentstatus';
            $this->load->view('common/common',$this->data);
        endif;
	}  

public function student_record_log()
    {
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
          
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
        if($this->input->post('search')):
           
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
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
            $this->data['result']   = $this->get_model->get_logData('student_record',$where,$like);
           endif;
           $this->data['page_title']   = ' Student Logs Record | ECMS';
           $this->data['page']         = 'admission/student_record_log';
           $this->load->view('common/common',$this->data);
    }
    
    public function student_log_record()
    {
        $student_id = $this->uri->segment(3);
        if($student_id):
        $where = array('student_id'=>$student_id);    
        $where2 = array('applicant_edu_detail_logs.student_id'=>$student_id);    
        $where1 = array('student_record.student_id'=>$student_id);    
        $this->data['result'] = $this->get_model->student_curr_record($where);
        $this->data['log'] = $this->get_model->get_log($where);
        $this->data['student_records'] = $this->get_model->student_edu_record($where1);
        $this->data['student_record_logs'] = $this->get_model->get_edu_log($where2);
        endif;
        $this->data['page_title'] = 'View Student Logs Record | ECMS';
        $this->data['page']       = 'admission/view_student_log_record';
        $this->load->view('common/common',$this->data);
    }
    
	public function new_student_record()
    {       
        $whereSub_pro = array('programe_id'=>1);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
        $this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
        if($this->input->post('search')):
            
            $where['student_record.programe_id'] = 1;
            $where['prospectus_batch.status_flag'] = 1;
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
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
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
        
           $this->data['result']   = $this->get_model->get_stdData('student_record',$where,$like,$custom);
           else:
           $where = array('student_record.batch_id'=>'34','student_record.programe_id'=>'1');
            //pagination start
            $config['base_url']         = base_url('admin/new_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 10;
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
            $this->data['result']    = $this->get_model->new_stds_pagination($config['per_page'], $page,$where,$custom);
            $this->data['count']     =$config['total_rows'];
            endif;
           $this->data['page_title']   = 'All Student Records | ECMS';
           $this->data['page']         = 'admission/new_student_record';
           $this->load->view('common/common',$this->data);
    }
	
    public function add_new_student_record()
	{	
                
        if($this->input->post()):	
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $last_school        = ucwords(strtolower(ucwords($this->input->post('last_school_address'))));
            $current_datetime   = date('Y-m-d H:i:s');
            
            $this->load->helper('string');
            $length     = "4"; 
            $char       = "0123456789"; 
            $password   = substr(str_shuffle($char), 0, $length);
            $checked    = array(
                            'batch_id'=>$this->input->post('batch_id'),
                            'form_no'=>$this->input->post('form_no')
                            );
            
            $qry    = $this->CRUDModel->get_where_row('student_record',$checked);
            if($qry):
                $this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
                redirect('admin/add_new_student_record');       
            else:
                $data   = array(
                        'batch_id'          => $this->input->post('batch_id'),
                        'reg_batch_id'      => $this->input->post('batch_id'),
                        'programe_id'       => $this->input->post('programe_id'),
                        'sub_pro_id'        => $this->input->post('sub_pro_id'),
                        'form_no'           => $this->input->post('form_no'),
                        'rseats_id'         => $this->input->post('rseats_id'),
                        'rseats_id1'        => $this->input->post('rseats_id1'),
                        'rseats_id2'        => $this->input->post('rseats_id'),
                        'rseats_id3'        => $this->input->post('rseats_id3'),
                        'comment'           => $this->input->post('comment'),
                        'fata_school'       => $this->input->post('fata_school'),
                        'student_name'      => $student,
                        'gender_id'         => $this->input->post('gender_id'),
                        'country_id'        => $this->input->post('country_id'),
                        'domicile_id'       => $this->input->post('domicile_id'),
                        'religion_id'       => $this->input->post('religion_id'),
//                        'hostel_required'   => $this->input->post('hostel_required'),
                        'father_name'       => $father,
                        'land_line_no'      => $this->input->post('land_line_no'),
                        'mobile_no'         => $this->input->post('mobile_no'),
//                        'mobile_no2'        => $this->input->post('mobile_no2'),
                        'last_school_address' => $last_school,
                        'remarks'           => $this->input->post('remarks1'),
                        'remarks2'          => $this->input->post('remarks2'),
                        's_status_id'       => 1,
                        'student_password'  => $password,
                        'timestamp'         => $current_datetime,
                        'user_id'           => $this->userInfo->user_id
                        );
                $sp_id = $this->input->post('sub_pro_id');
                $id     = $this->CRUDModel->insert('student_record',$data);
                if(!empty($sp_id)):
                    $ides   = $this->input->post('checked');
                    foreach($ides as $row=>$value):
                        $sub_data = array(
                             'student_id'   => $id,
                             'subject_id'   => $value,
                             'sub_prog_id'  => $sp_id,
                             'created_by'   => $this->userInfo->user_id,
                             'date_time'    => date('Y-m-d H:i:s'),
                         );
                        $this->CRUDModel->insert('new_student_subjects',$sub_data);
                    endforeach;
                endif;
                redirect('admin/new_student_academic_record/'.$id);
            endif;
        endif;
        
            $this->data['page_title']   = 'Add New Student (Inter Level) | ECMS';
            $this->data['page']         = 'admission/New_Admission/add_new_student_record';
            $this->load->view('common/common',$this->data);
            
	}
    
	public function add_new_student_record22032019()
	{	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $last_school = ucwords(strtolower(ucwords($this->input->post('last_school_address'))));
            $current_datetime = date('Y-m-d H:i:s');
			$this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length); 
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_new_student_record');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'rseats_id1'=>$this->input->post('rseats_id1'),
                'rseats_id2'=>$this->input->post('rseats_id'),
                'rseats_id3'=>$this->input->post('rseats_id3'),
                'comment'=>$this->input->post('comment'),
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'gender_id'=>$this->input->post('gender_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'last_school_address'=>$last_school,
                'remarks'=>$this->input->post('remarks1'),
                'remarks2'=>$this->input->post('remarks2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id
            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/new_student_academic_record/'.$id);
         endif;
         endif;
            $this->data['page_title']   = 'Add New Student (Inter Level) | ECMS';
            $this->data['page']         = 'admission/add_new_student_record';
            $this->load->view('common/common',$this->data);
        
	}
	
        public function new_student_profile(){	
        $id                         = $this->uri->segment(3);
        $this->data['student_id']   = $id;
        $where                      = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->get_model->profileStudent($where);
        $this->data['student_records'] =$this->get_model->student_edu_record($where);
         $this->data['guardian_of_relation']     = $this->CRUDModel->dropDown('relation', ' Relation ', 'relation_id', 'title');
        $this->data['page_title']   = 'Student Profile   | ECMS';
        $this->data['page']         = 'admission/new_student_profile';
        $this->load->view('common/common',$this->data);
	}
    
//    public function last_school_auto(){
//                //$term                       = trim(strip_tags($_GET['term']));
//                $term                       = trim(strip_tags($this->input->get('term')));
//                if( $term == ''){
//                    $like                   = $term;
//                    $result_set             = $this->db->get('student_record')->result();
//                    $labels                 = array();
//                        foreach ($result_set as $row_set) {
//                            $labels[]       = array( 
//                                'label'     =>$row_set->last_school_address, 
//                                'id'        =>$row_set->student_id, 
//                                'value'     =>$row_set->last_school_address
//                        );
//                    }
//                $matches    = array();
//                    foreach($labels as $label){
//                        $label['value']     = $label['value'];
//                        $label['id']        = $label['id'];
//                        $label['label']     = $label['label']; 
//                        $matches[]          = $label;
//                }
//                $matches                    = array_slice($matches, 0, 10);
//                    echo  json_encode($matches); 
//                }else if($term != ''){
//                    $like                   = $term;
//                    $result_set             = $this->db->like('last_school_address',$like)->get('student_record')->result();
//                    $labels                 = array();
//                        foreach ($result_set as $row_set) {
//                        $labels[]           = array( 
//                             'label'        =>$row_set->last_school_address, 
//                            'id'            =>$row_set->student_id, 
//                            'value'         =>$row_set->last_school_address 
//                        );
//                 }
//                $matches                    = array();
//                foreach($labels as $label){
//                        $label['value']     = $label['value'];
//                        $label['id']        = $label['id'];
//                         $label['label']    = $label['label']; 
//                        $matches[]          = $label;
//                }
//                    $matches                = array_slice($matches, 0, 10);
//                echo  json_encode($matches); 
//        }
//        }
    
    public function last_school_auto(){
                //$term                       = trim(strip_tags($_GET['term']));
                $term                       = trim(strip_tags($this->input->get('term')));
                if( $term == ''){
                    $like = $term;
    $result_set   = $this->get_model->lastschoolData('student_record');
   // $result_set   = $this->db->group_by('last_school_address')->get('student_record')->result();
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                            $labels[]       = array( 
                                'label'     =>$row_set->last_school_address, 
                                'id'        =>$row_set->student_id, 
                                'value'     =>$row_set->last_school_address
                        );
                    }
                $matches    = array();
                    foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['id']        = $label['id'];
                        $label['label']     = $label['label']; 
                        $matches[]          = $label;
                }
                $matches                    = array_slice($matches, 0, 10);
                    echo  json_encode($matches); 
                }else if($term != ''){
                    $like = array('last_school_address'=>$term);
            $result_set= $this->get_model->lastschoolData('student_record',$like);
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                        $labels[]           = array( 
                             'label'        =>$row_set->last_school_address, 
                            'id'            =>$row_set->student_id, 
                            'value'         =>$row_set->last_school_address 
                        );
                 }
                $matches                    = array();
                foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['id']        = $label['id'];
                         $label['label']    = $label['label']; 
                        $matches[]          = $label;
                }
                    $matches                = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
        }
        }
	
	 public function new_update_student()
    {	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post())		
            {
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $admission_date = $this->input->post('admission_date');
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
             $data_post = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'rseats_id1'=>$this->input->post('rseats_id1'),
                'rseats_id2'=>$this->input->post('rseats_id'),
                'rseats_id3'=>$this->input->post('rseats_id3'),
                'comment'=>$this->input->post('comment'),
                'shift_id'=>$this->input->post('shift_id'),
                'college_no'=>$this->input->post('college_no'),
                'fata_school'=>$this->input->post('fata_school'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'hostel_applied'=>$this->input->post('hostel_applied'),
                'migration_status'=>$this->input->post('migration_status'),
                'migrated_remarks'=>$this->input->post('migrated_remarks'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'), 
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'bank_receipt_no'=>$this->input->post('bank_receipt_no'),
                'admission_date'=>$date2,
                'admission_comment'=>$this->input->post('admission_comment'),
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
                'bu_number'=>$this->input->post('bu_number'),
                'remarks'=>$this->input->post('remarks1'),
                'remarks2'=>$this->input->post('remarks2'),
            );     
            $this->get_model->updatestudent($data_post,$uri);
			 $old_programe_id = $this->input->post('old_programe_id');
             $old_sub_pro_id = $this->input->post('old_sub_pro_id');
             $old_batch_id = $this->input->post('old_batch_id');
             $old_student_name = $this->input->post('old_student_name');
             $old_form_no = $this->input->post('old_form_no');
             $old_college_no = $this->input->post('old_college_no');
             $old_rseats_id = $this->input->post('old_rseats_id');
             $old_rseats_id2 = $this->input->post('old_rseats_id2');
             $old_shift_id = $this->input->post('old_shift_id');
             $old_domicile_id = $this->input->post('old_domicile_id');
             $old_mobile_no = $this->input->post('old_mobile_no');
             $old_mobile_no2 = $this->input->post('old_mobile_no2');
            $data_log = array
                (
                   'student_id'=>$uri,
                   'batch_id'=>$old_batch_id,
                   'programe_id'=>$old_programe_id,
                   'sub_pro_id'=>$old_sub_pro_id,
                   'form_no'=>$old_form_no,
                   'college_no'=>$old_college_no,
                   'rseats_id'=>$old_rseats_id,
                   'rseats_id2'=>$old_rseats_id2,
                   'shift_id'=>$old_shift_id,
                   'student_name'=>$old_student_name,
                   'domicile_id'=>$old_domicile_id,
                   'mobile_no'=>$old_mobile_no,
                   'mobile_no2'=>$old_mobile_no2,
				   'timestamp'=>date('Y-m-d H:i:s'),
                    'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            $cons = $this->input->post('concession');
            $data = array('concession'=>$cons,'student_id'=>$this->uri->segment(3));
            $where = array('student_id'=>$this->uri->segment(3));     
            $query = $this->CRUDModel->get_where_row('finance_concession',$where);
            if($query):
             $this->CRUDModel->update('finance_concession',$data,$where);
            else:
             $this->CRUDModel->insert('finance_concession',$data);
            endif;
            redirect('admin/new_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/new_update_student_record", $prodata);
       $this->load->view("common/footer");
	}
	
	 public function update_new_academic_record($id)
	{
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST)		
            {
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
			$inst_id = ucwords(strtolower(ucwords($this->input->post('inst_id'))));
            $data_post = array
            (
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$inst_id,
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type')
            );
            $this->get_model->updateacademic($data_post,$id);
            $old_obtained_marks = $this->input->post('old_obtained_marks');
            $old_total_marks = $this->input->post('old_total_marks');
            $old_percentage = $this->input->post('old_percentage');
            $old_student_id = $this->input->post('old_student_id');
            $data_log = array
                (
                   'student_id'=>$old_student_id,
                    'edu_id'=>$id,
                   'obtained_marks'=>$old_obtained_marks,
                   'total_marks'=>$old_total_marks,
                   'percentage'=>$old_percentage,
                    'user_id'=>$user_id
                );
            $this->CRUDModel->insert('applicant_edu_detail_logs',$data_log);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/new_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_new_academic_record", $prodata);
       $this->load->view("common/footer");
		
	}
	
	public function update_degree_academic_record($id)
	{
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST)		
            {
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
			$inst_id = ucwords(strtolower(ucwords($this->input->post('inst_id'))));
            $data_post = array
            (
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$inst_id,
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type')
            );
            $this->get_model->updateacademic($data_post,$id);
            $old_obtained_marks = $this->input->post('old_obtained_marks');
            $old_total_marks = $this->input->post('old_total_marks');
            $old_percentage = $this->input->post('old_percentage');
            $old_student_id = $this->input->post('old_student_id');
            $data_log = array
                (
                   'student_id'=>$old_student_id,
                    'edu_id'=>$id,
                   'obtained_marks'=>$old_obtained_marks,
                   'total_marks'=>$old_total_marks,
                   'percentage'=>$old_percentage,
                    'user_id'=>$user_id
                );
            $this->CRUDModel->insert('applicant_edu_detail_logs',$data_log);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/degree_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_degree_academic_record", $prodata);
       $this->load->view("common/footer");
		
	}
	
	public function update_hnd_academic_record($id)
	{
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST)		
            {
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
			$inst_id = ucwords(strtolower(ucwords($this->input->post('inst_id'))));
            $data_post = array
            (
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$inst_id,
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type')
            );
            $this->get_model->updateacademic($data_post,$id);
            $old_obtained_marks = $this->input->post('old_obtained_marks');
            $old_total_marks = $this->input->post('old_total_marks');
            $old_percentage = $this->input->post('old_percentage');
            $old_student_id = $this->input->post('old_student_id');
            $data_log = array
                (
                   'student_id'=>$old_student_id,
                    'edu_id'=>$id,
                   'obtained_marks'=>$old_obtained_marks,
                   'total_marks'=>$old_total_marks,
                   'percentage'=>$old_percentage,
                    'user_id'=>$user_id
                );
            $this->CRUDModel->insert('applicant_edu_detail_logs',$data_log);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/hnd_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_hnd_academic_record", $prodata);
       $this->load->view("common/footer");
		
	}
	public function new_student_academic_record($id)
	{		
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('Add_education')):
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
        redirect('admin/new_student_academic_record/'.$this->input->post('student_id'));
        
        else:
		$inst_id = ucwords(strtolower(ucwords($this->input->post('inst_id'))));
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$inst_id,
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/new_student_academic_record/'.$this->input->post('student_id'));
        
        endif;
        endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', ' Select degree  ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', ' Select Board  ', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $where1 = array('student_grades.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['grade'] = $this->get_model->getstudents_grade($where1);
            $this->data['page_title']   = 'Academic Record of Students  | ECMS';
            $this->data['page']         = 'admission/New_Admission/new_student_academic_record';
            $this->load->view('common/common',$this->data);
    }
   
	/*
	public function new_upload_sphoto()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$shift_id = $this->input->post('shift_id');
			$rseats_id2 = $this->input->post('rseats_id2');
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
            $data = array(
			'rseats_id2'=>$rseats_id2,
			'shift_id'=>$shift_id,
			'applicant_image'=>$file_name,
			'college_no'=>$college_no,
			'admission_date'=>$date
			);
            $where = array('student_id'=>$id); 
            $this->CRUDModel->update('student_record',$data,$where);
            redirect('admin/new_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload Student Picture | ECMS';
            $this->data['page']        =  'admission/new_upload_sphoto';
            $this->load->view('common/common',$this->data);
        endif;
    }
   */
   
    public function new_upload_sphoto(){
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id']; 
        $id = $this->uri->segment(3);
        
        if($this->input->post()):
            $image      = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name  = $image['file_name'];
            
            if($file_name == "_thumb"):
                $shift_id       = $this->input->post('shift_id');
                $rseat_id2      = $this->input->post('rseat_id2');
                $college_no     = $this->input->post('college_no');
                $admission_date = $this->input->post('admission_date');
                $date           = date('Y-m-d', strtotime($admission_date));
                
                        
                $log_data = array(
                    'college_no'    => $college_no,
                    'admission_date'=> $date,
                    'shift_id'      => $shift_id,
                    'reserved_seat' => $rseat_id2,
                    'user_id'       => $user_id,
                );
                
                $data = array(
                    'rseats_id2'    =>$rseat_id2,
                    'shift_id'      =>$shift_id,
                    'college_no'    =>$college_no,
                    'admission_date'=>$date
                );
                $where = array('student_id'=>$id); 
                
                $this->CRUDModel->update('student_record',$data,$where);
                $this->CRUDModel->insert('student_add_picture_log',$log_data);
                
                else: 
                    $shift_id       = $this->input->post('shift_id');
                    $rseats_id2     = $this->input->post('rseat_id2');
                    $college_no     = $this->input->post('college_no');
                    $admission_date = $this->input->post('admission_date');
                    $date           = date('Y-m-d', strtotime($admission_date));
                    
                    $log_data = array(
                        'college_no'    => $college_no,
                        'admission_date'=> $date,
                        'shift_id'      => $shift_id,
                        'reserved_seat' => $rseats_id2,
                        'picture'       => $file_name,
                        'user_id'       => $user_id,
                        'entry_date'    => date('Y-m-d H:i:s'),
                    );
                    
                    $data = array(
                        'rseats_id2'    => $rseats_id2,
                        'shift_id'      => $shift_id,
                        'applicant_image' => $file_name,
//		'applicant_image'=>$date('YmdHis').$file_name,
                        'college_no'    => $college_no,
                        'admission_date' => $date
                    );
                    $where = array('student_id'=>$id); 
                    
                    $this->CRUDModel->update('student_record',$data,$where);
                    $this->CRUDModel->insert('student_add_picture_log',$log_data);
            endif;
            redirect('admin/adding_picture'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->get_model->get_student_statusdata('student_record',$where);

            $this->data['page_title']        = 'Upload Student Picture | ECMS';
            $this->data['page']        =  'admission/new_upload_sphoto';
            $this->load->view('common/common',$this->data);
        endif;
    }
	
	
    public function student_group_inter(){
//        $session = $this->session->all_userdata();
//        $user_id =$session['userData']['user_id'];
//        
        if($this->input->post('save_students')):   
		
           $form_Code   = $this->input->post('form_Code');
           $sec_id      = $this->input->post('sec_id');
            $where      = array( 'users_id'  =>$this->userInfo->user_id,'form_Code' =>$form_Code); 

       $res =  $this->CRUDModel->get_where_result('student_group_allotment_demo', $where);
       foreach($res as $isRow):
           
                                 $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
            $user_details   =   $this->db->get_where('users',array('id'=>$this->userInfo->user_id))->row()->emp_name;

             $data = array(   
                'student_id'    => $isRow->student_id,
                'section_id'    => $sec_id,
                'comment'      => 'First Time Alloted By '.$user_details.' Id :'.$this->userInfo->user_id,
                'date'          => date('Y-m-d'),
                'timestamp'     => date('Y-m-d H:i:s'),
                'user_id'       => $this->userInfo->user_id,
              );
            $this->CRUDModel->insert('student_group_allotment',$data);

            $datalog = array(   
                'student_id'    => $isRow->student_id,
                'section_id'    => $sec_id,
                'comments'      => 'First Time Alloted By '.$user_details.' Id :'.$this->userInfo->user_id,
                'timestamp'     => date('Y-m-d H:i:s'),
                'date'          => date('Y-m-d'),
                'user_id'       => $this->userInfo->user_id,
           );
           $this->CRUDModel->insert('student_group_allotment_log',$datalog); 
//        $data = array(   
//            'student_id'    =>$isRow->student_id,
//            'section_id'    =>$sec_id,
//            'form_Code'     =>$isRow->form_Code,
//            'date'          =>$isRow->date,
//            'user_id'       =>$isRow->users_id,
//          );
//        $this->CRUDModel->insert('student_group_allotment',$data);
        
           $whereDelete = array('users_id'=>$this->userInfo->user_id); 
      		$this->CRUDModel->deleteid('student_group_allotment_demo',$whereDelete);
			$this->CRUDModel->update('student_record',array('flag'=>1),array('student_id'=>$isRow->student_id));
	  endforeach; 
		
            redirect('admin/student_group_inter');
            endif;
            $this->data['page']     =   "admission/student_group_inter";
            $this->data['title']    =   'Student Group Inter Level| ECMS';
            $this->load->view('common/common',$this->data);        
        
    }
	public function student_group_alevel(){
            
//        $session    = $this->session->all_userdata();
//        $user_id    = $session['userData']['user_id'];
//        
            
        if($this->input->post('save_students')):   
            $form_Code  = $this->input->post('form_Code');
            $sec_id     = $this->input->post('sec_id');
            $where      = array(
            'users_id'  => $this->userInfo->user_id,
            'form_Code' => $form_Code
        ); 
       $res =  $this->CRUDModel->get_where_result('student_group_allotment_demo', $where);
       foreach($res as $isRow):
                                $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
            $user_details   =   $this->db->get_where('users',array('id'=>$this->userInfo->user_id))->row()->emp_name;

             $data = array(   
                'student_id'    => $isRow->student_id,
                'section_id'    => $sec_id,
                'comment'      => 'First Time Alloted By '.$user_details.' Id :'.$this->userInfo->user_id,
                'date'          => date('Y-m-d'),
                'timestamp'     => date('Y-m-d H:i:s'),
                'user_id'       => $this->userInfo->user_id,
              );
            $this->CRUDModel->insert('student_group_allotment',$data);

            $datalog = array(   
                'student_id'    => $isRow->student_id,
                'section_id'    => $sec_id,
                'comments'      => 'First Time Alloted By '.$user_details.' Id :'.$this->userInfo->user_id,
                'timestamp'     => date('Y-m-d H:i:s'),
                'date'          => date('Y-m-d'),
                'user_id'       => $this->userInfo->user_id,
              );
            $this->CRUDModel->insert('student_group_allotment_log',$datalog);

                $whereDelete = array('users_id'=>$this->userInfo->users_id); 
                $this->CRUDModel->deleteid('student_group_allotment_demo',$whereDelete);
                $this->CRUDModel->update('student_record',array('flag'=>1),array('student_id'=>$isRow->student_id));
	  endforeach; 
        redirect('admin/student_group_chart_alevel');
            endif;
     
    }
    
    public function print_studentGroup(){
        $id = $this->uri->segment(3);
        $where = array('sections.sec_id'=>$id);
        $this->data['sec']  = $this->CRUDModel->get_where_row('sections',$where);
        $this->data['result']  = $this->get_model->print_student_group('student_group_allotment',$where);
        $this->data['page']     =   "admission/print_studentGroup";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
    }	
    
    public function print_studentGroup_bs(){
        $id = $this->uri->segment(3);
        $where = array('sections.sec_id'=>$id);
        $this->data['sec']  = $this->CRUDModel->get_where_row('sections',$where);
        $this->data['result']  = $this->get_model->print_student_group('student_group_allotment',$where);
        $this->data['page']     =   "admission/print_studentGroup_bs";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
    }	
    
    public function print_attendancesheet()
	{
		$id = $this->uri->segment(3);
		$where = array('sections.sec_id'=>$id);
		$this->data['sec']  = $this->CRUDModel->get_where_row('sections',$where);
		$this->data['result']  = $this->get_model->print_student_group('student_group_allotment',$where);
		$this->data['page']     =   "admission/inter/print/print_attendancesheet_v";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
    }
	
	public function view_student_group()
	{
		$id                         = $this->uri->segment(3);
		$where                      = array('sections.sec_id'=>$id);
		$this->data['result']       = $this->get_model->view_student_group('student_group_allotment',$where);
		$this->data['page']     =   "admission/view_student_group";
                $this->data['title']    =   'Student Group Inter Level| ECMS';
                $this->load->view('common/common',$this->data);
		
                $sectionName = $this->db->get_where('sections',$where)->row();
		if($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Students Group');
                //set cell A1 content with some text
        
                
                $this->excel->getActiveSheet()->setCellValue('A1', 'Clg #');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('B1', 'Enrollment No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('E1', 'Section');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'Total Marks');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('G1', 'Obtained Marks');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
              
                $this->excel->getActiveSheet()->setCellValue('H1', 'Percentage');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('I1', 'Student Mobile #');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
        
                
                
            for($col = ord('A'); $col <= ord('I'); $col++)
            {
                     //set column dimension
                     $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                      //change the font size
                     $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                     $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
             }
                             $where = array('sections.sec_id'=>$id);

                 $this->db->SELECT('
                 student_record.college_no as college_no,
                 student_record.bs_enrollment_no,
                 student_record.student_name as student,
                 student_record.father_name,
                 sections.name as section_name,
                 applicant_edu_detail.total_marks,
                 applicant_edu_detail.obtained_marks,
                 applicant_edu_detail.percentage,
                 student_record.applicant_mob_no1,
                 ');
                $this->db->FROM('student_group_allotment');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
                $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
                $this->db->where($where);
                             $this->db->where('student_record.s_status_id','5');
                 $this->db->order_by('student_record.college_no','asc');
                 $this->db->group_by('student_record.student_id');
                 $rs =  $this->db->get();
                 $exceldata="";
                 foreach ($rs->result_array() as $row)
                 {
                     $exceldata[] = $row;
                 }      

                 $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                 $filename= $sectionName->name.' '.date('d M,Y H:i:s').'.xls'; 
                 header('Content-Type: application/vnd.ms-excel');
                 header('Content-Disposition: attachment;filename="'.$filename.'"');
                 header('Cache-Control: max-age=0'); 
                 $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                 $objWriter->save('php://output');
              endif; 
	}	
	
    public function view_student_group_bs(){
            
        $id                         = $this->uri->segment(3);
        $where                      = array('sections.sec_id'=>$id);
        $this->data['result']       = $this->get_model->view_student_group('student_group_allotment',$where);
        $this->data['page']     =   "admission/view_student_group_bs";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);

        $sectionName = $this->db->get_where('sections',$where)->row();

        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Group');
            //set cell A1 content with some text


            $this->excel->getActiveSheet()->setCellValue('A1', 'Clg #');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'Enrollment No');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Father Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1', 'Section');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1', 'Total Marks');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1', 'Obtained Marks');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1', 'Percentage');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1', 'Student Mobile #');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);



            for($col = ord('A'); $col <= ord('I'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }

            $where = array('sections.sec_id'=>$id);

            $this->db->SELECT('
                student_record.college_no as college_no,
                student_record.bs_enrollment_no,
                student_record.student_name as student,
                student_record.father_name,
                sections.name as section_name,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.applicant_mob_no1,
            ');
            $this->db->FROM('student_group_allotment');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->where($where);
            $this->db->where('student_record.s_status_id','5');
            $this->db->order_by('student_record.college_no','asc');
            $this->db->group_by('student_record.student_id');
            $rs =  $this->db->get();
            $exceldata="";
            foreach ($rs->result_array() as $row){
                 $exceldata[] = $row;
             }      

            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename= $sectionName->name.' '.date('d M,Y H:i:s').'.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output');
        endif; 
    }	
	
	public function students_assign_group()
    {
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        
        if($this->input->post()):
            $student_id     = $this->input->post('student_id');
            $form_Code      = $this->input->post('form_Code');
            $checked        = array( 'student_id' => $student_id);
            $qry            = $this->CRUDModel->get_where_row('student_group_allotment',$checked);
            $msg            = '';
            if($qry):
            $msg = '<p style="color:red">Sorry! Section has been Assigned to this Student. <p/>';  
            else:
            
            $ExistWhere = array(
                'student_id'    => $student_id,
                'form_Code'     => $form_Code,
            );
            $data  = array(
                'student_id'    => $student_id,
                'form_Code'     => $form_Code,
                'date'          => date('Y-m-d'),
                'timestamp'     => date('Y-m-d H:i:s'),
                'users_id'      => $user_id
            );
            $ChkAllotment = $this->CRUDModel->get_where_row('student_group_allotment_demo',$ExistWhere);
            if(empty($ChkAllotment)):
                $this->CRUDModel->insert('student_group_allotment_demo',$data);  
                  
               else:
                $msg = '<p style="color:red">Sorry! Record Exist. <p/>'; 
            endif;
             $where = array('users_id'=>$user_id,'form_Code'=>$form_Code);
            $result = $this->get_model->getstudent_assign_group($where);
       
        echo $msg;
        echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Student Name</th>
                            <th>College Number</th>
                            <th>Program</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                       $sn= '';
                        foreach($result as $eRow):
                            $sn++;
                        echo '<tr id="'.$eRow->serial_no.'Delete">
                                <td>'.$sn.'</td>
                                <td>'.$eRow->student_name.'</td>
                                <td>'.$eRow->college_no.'</td>                          
                                <td>'.$eRow->name.'</td>                          
   <td><a href="javascript:void(0)" id="'.$eRow->serial_no.'" class="delete_assignStudent">Delete</a></td>                          
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        endif;
   ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.delete_assignStudent').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'admin/delete_assign_student',
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
    
    public function delete_assign_student()
    {
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('student_group_allotment_demo',array('serial_no'=>$deletId));
   }  
   
   public function search_migrated_student()
    {
        $this->data['status'] = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name'); 
        $like = '';
        $where = '';
        $this->data['s_status_id'] = "";
        $where['student_record.s_status_id ='] = 5;
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
           $this->data['student'] = $this->get_model->get_migrated_stdData('student_record',$where,$like);
        endif;
        $this->data['page_title']  = 'Migrated Students Record| ECMS';
        $this->data['page']        =  'admission/migrated_student_record';
        $this->load->view('common/common',$this->data);
    }
    
    public function migrated_student_record()
    {
        $this->data['status'] = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name');    
            $where = "";
        
            $this->data['student_id'] = ""; 
            $this->data['s_status_id'] = ""; 
            $this->data['college_no'] = "";
        if($this->input->post('search')): 
            $student_id  = $this->input->post('student_id');
            $s_status_id  = $this->input->post('s_status_id');
            $college_no  = $this->input->post('college_no');
        
        if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
        endif;
        if(!empty($college_no)):
            $where['college_no'] = $college_no;
            $this->data['college_no'] =$college_no;
        endif;
            $this->data['result'] = $this->get_model->migratedDataSearch('student_migration',$where);
        else:
        $this->data['result'] = $this->get_model->get_migratedData('student_migration');
        endif;
        $this->data['page_title']  = 'Migrated Students Record| ECMS';
        $this->data['page']        =  'admission/migrated_student_record';
        $this->load->view('common/common',$this->data);
	}	
	
	public function add_migrated_student()
	{
        $student_id = $this->uri->segment(3);
		$session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $student_id     = $this->input->post('student_id');
            $migrated_institute = $this->input->post('migrated_institute');
            $migrated_board    = $this->input->post('bu_id');
            $migration_date     = $this->input->post('migration_date');
            $s_status_id     = $this->input->post('s_status_id');
            $old_s_status_id   = $this->input->post('old_s_status_id');
            $date1 = date('Y-m-d', strtotime($migration_date));
            $checked = array
            (
                'student_id' =>$student_id
            );
            $qry = $this->CRUDModel->get_where_row('student_migration',$checked);
            if($qry):
            $this->session->set_flashdata('msg', 'Sorry! Student Already Exist');
            redirect('admin/migrated_student_record');
            else:
                $data  = array(
                    'student_id' =>$student_id,
                    'migrated_institute' =>$migrated_institute,
                    'migrated_board' =>$migrated_board,
                    'migration_date' =>$date1,
                    's_status_id' =>$s_status_id,
                    'user_id' =>$user_id,
                );        
                $this->CRUDModel->insert('student_migration',$data);
				$where = array('student_id'=>$student_id);
				$data1 = array('s_status_id'=>$s_status_id);
				$this->CRUDModel->update('student_record',$data1,$where);
                if($s_status_id  != $old_s_status_id):
	           $old_st = $old_s_status_id;
			   else:
				$old_st = 'NULL';
			  endif;
                $data_post = array
                (
                    'student_id'=>$student_id,
                    's_status_id'=>$old_st,
                    'date'=>$date1,
                    'timestamp'=>date('Y-m-d H:i:'),
                    'user_id'=>$user_id
                );	
               $this->CRUDModel->insert('student_status_detail',$data_post);
                redirect('admin/migrated_student_record');
            endif;
            endif;
            if($student_id):
                $this->data['result'] = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            endif;
            $this->data['page_title']  = 'Add Migrated Student| ECMS';
            $this->data['page'] = 'admission/add_migrated_student';
            $this->load->view('common/common',$this->data);
	}
	
	public function update_migrated_student()
	{
        $id = $this->uri->segment(3);
		$session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $student_id     = $this->input->post('student_id');
            $migrated_institute = $this->input->post('migrated_institute');
            $migrated_board    = $this->input->post('bu_id');
            $migration_date     = $this->input->post('migration_date');
            $s_status_id     = $this->input->post('s_status_id');
            $old_s_status_id   = $this->input->post('old_s_status_id');
            $date1 = date('Y-m-d', strtotime($migration_date));
            $where = array('student_migration.migration_id'=>$id);
            $data  = array(
                'student_id' =>$student_id,
				'migrated_institute' =>$migrated_institute,
				'migrated_board' =>$migrated_board,
				'migration_date' =>$date1,
				's_status_id' =>$s_status_id,
				'updated_user_id' =>$user_id,
            );        
            $this->CRUDModel->update('student_migration',$data,$where);
			$where1 = array('student_record.student_id'=>$student_id);
				$data1 = array('s_status_id'=>$s_status_id);
				$this->CRUDModel->update('student_record',$data1,$where1);
            if($s_status_id  != $old_s_status_id):
	           $old_st = $old_s_status_id;
			   else:
				$old_st = 'NULL';
			  endif;
            $data_post = array
            (
                'student_id'=>$student_id,
                's_status_id'=>$old_st,
                'date'=>$date1,
                'timestamp' => date('Y-m-d H:i:'),
                'user_id'=>$user_id
            );	
	       $this->CRUDModel->insert('student_status_detail',$data_post);
            redirect('admin/migrated_student_record');
            endif;
            if($id):
            $where = array('student_migration.migration_id'=>$id);
            $this->data['result'] = $this->get_model->getmigrated_Std('student_migration',$where);
            $this->data['page_title']  = 'Update Migrated Student| ECMS';
            $this->data['page'] = 'admission/update_migrated_student';
            $this->load->view('common/common',$this->data);
            endif;
	}
	
	public function delete_student_grade()
    {
        $serial_no = $this->uri->segment(3);
        $where = array('id'=>$serial_no);
        $this->CRUDModel->deleteid('student_grades',$where);
        redirect('admin/new_student_record');
    }
	
	public function student_group_practical_inter()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('save_students')):   
           $group_id  = $this->input->post('group_id');
            $where = array(
            'users_id'=>$user_id   
        ); 
       $res =  $this->CRUDModel->get_where_result('student_prac_group_allottment_demo', $where);
       foreach($res as $isRow):
        $data = array(   
            'student_id' =>$isRow->student_id,
            'group_id'   =>$group_id,
            'user_id'    =>$isRow->users_id,
          );
        $this->CRUDModel->insert('student_prac_group_allottment',$data);
        
           $whereDelete = array('users_id'=>$user_id); 
      		$this->CRUDModel->deleteid('student_prac_group_allottment_demo',$whereDelete);
		//	$this->CRUDModel->update('student_record',array('prac_flag'=>1),array('student_id'=>$isRow->student_id));
		endforeach; 
            redirect('admin/student_group_practical_inter');
            endif;
            $this->data['page']     =   "admission/student_group_practical_inter";
            $this->data['title']    =   'Students Practical Group Inter Level| ECMS';
            $this->load->view('common/common',$this->data);        
        
    }
	
	public function students_assign_prac_group()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student_id   = $this->input->post('student_id');
           
			  $data  = array(
                'student_id' => $student_id,
                'users_id' => $user_id
            );
    $this->CRUDModel->insert('student_prac_group_allottment_demo',$data);  
	$where = array(
            'users_id'=>$user_id    
        );   
    $result = $this->get_model->getstudent_prac_assign_group($where);
       
      //  echo $msg;
        echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>College Number</th>
                            <th>Program</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                       
                        foreach($result as $eRow):
                        echo '<tr id="'.$eRow->serial_no.'Delete">
                                <td>'.$eRow->student_name.'</td>
                                <td>'.$eRow->college_no.'</td>                          
                                <td>'.$eRow->name.'</td>                          
   <td><a href="javascript:void(0)" id="'.$eRow->serial_no.'" class="delete_assignprac_Student">Delete</a></td>                          
                           </tr>';                      
                        endforeach;                        
                                             
                    echo '</tbody>
                </table> ';
        endif;
   ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.delete_assignprac_Student').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'admin/delete_assign_prac_student',
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
    
    public function delete_assign_prac_student()
    {
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('student_prac_group_allottment_demo',array('serial_no'=>$deletId));
   }

public function update_degree_migrated_student()
	{
        $id = $this->uri->segment(3);
		$session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $student_id     = $this->input->post('student_id');
            $migrated_institute = $this->input->post('migrated_institute');
            $migrated_board    = $this->input->post('bu_id');
            $migration_date     = $this->input->post('migration_date');
            $s_status_id     = $this->input->post('s_status_id');
            $date1 = date('Y-m-d', strtotime($migration_date));
            $where = array('student_migration.migration_id'=>$id);
            $data  = array(
                'student_id' =>$student_id,
				'migrated_institute' =>$migrated_institute,
				'migrated_board' =>$migrated_board,
				'migration_date' =>$date1,
				's_status_id' =>$s_status_id,
				'updated_user_id' =>$user_id,
            );        
            $this->CRUDModel->update('student_migration',$data,$where);
			$where1 = array('student_record.student_id'=>$student_id);
				$data1 = array('s_status_id'=>$s_status_id);
				$this->CRUDModel->update('student_record',$data1,$where1);
            redirect('admin/degree_migrated_student_record');
            endif;
            if($id):
            $where = array('student_migration.migration_id'=>$id);
            $this->data['result'] = $this->get_model->getmigrated_Std('student_migration',$where);
            $this->data['page_title']  = 'Update Degree Migrated Student| ECMS';
            $this->data['page'] = 'admission/update_degree_migrated_student';
            $this->load->view('common/common',$this->data);
            endif;
	}
	
	public function degree_migrated_student_record()
    {
        $this->data['status'] = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name');    
            $where = "";
        
            $this->data['student_id'] = ""; 
            $this->data['s_status_id'] = ""; 
            $this->data['college_no'] = "";
        if($this->input->post('search')): 
            $student_id  = $this->input->post('student_id');
            $s_status_id  = $this->input->post('s_status_id');
            $college_no  = $this->input->post('college_no');
        
        if(!empty($student_id)):
            $where['student_record.student_id'] = $student_id;
            $this->data['student_id'] =$student_id;
        endif;
        if(!empty($college_no)):
            $where['college_no'] = $college_no;
            $this->data['college_no'] =$college_no;
        endif;
            $this->data['result'] = $this->get_model->degree_migratedDataSearch('student_migration',$where);
        else:
			$this->data['result'] = $this->get_model->degree_get_migratedData('student_migration');
        endif;
        $this->data['page_title']  = 'Degree Migrated Students Record| ECMS';
        $this->data['page']        =  'admission/degree_migrated_student_record';
        $this->load->view('common/common',$this->data);
	}
	
	public function search_degree_migrated_student()
    {
        $this->data['status'] = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name'); 
        $like = '';
        $where = '';
        $this->data['s_status_id'] = "";
        
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
           $this->data['student'] = $this->get_model->get_degree_migrated_stdData('student_record',$where,$like);
        endif;
        $this->data['page_title']  = 'Degree Migrated Students Record| ECMS';
        $this->data['page']        =  'admission/degree_migrated_student_record';
        $this->load->view('common/common',$this->data);
    }
	
	public function add_degree_migrated_student()
	{
        $student_id = $this->uri->segment(3);
		$session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];
        if($this->input->post()):
            $student_id     = $this->input->post('student_id');
            $migrated_institute = $this->input->post('migrated_institute');
            $migrated_board    = $this->input->post('bu_id');
            $migration_date     = $this->input->post('migration_date');
            $s_status_id     = $this->input->post('s_status_id');
            $date1 = date('Y-m-d', strtotime($migration_date));
            $checked = array
            (
                'student_id' =>$student_id
            );
            $qry = $this->CRUDModel->get_where_row('student_migration',$checked);
            if($qry):
            $this->session->set_flashdata('msg', 'Sorry! Student Already Exist');
            redirect('admin/degree_migrated_student_record');
            else:
                $data  = array(
                    'student_id' =>$student_id,
                    'migrated_institute' =>$migrated_institute,
                    'migrated_board' =>$migrated_board,
                    'migration_date' =>$date1,
                    's_status_id' =>$s_status_id,
                    'user_id' =>$user_id,
                );        
                $this->CRUDModel->insert('student_migration',$data);
				$where = array('student_id'=>$student_id);
				$data1 = array('s_status_id'=>$s_status_id);
				$this->CRUDModel->update('student_record',$data1,$where);
                redirect('admin/degree_migrated_student_record');
            endif;
            endif;
            if($student_id):
                $this->data['result'] = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            endif;
            $this->data['page_title']  = 'Add Migrated Student| ECMS';
            $this->data['page'] = 'admission/add_degree_migrated_student';
            $this->load->view('common/common',$this->data);
	}
	
	public function groups_degree()
    {
            $where_status = array('status'=>'On','program_id'=>'4');
            $this->data['sections']    = $this->CRUDModel->dropDown('sections', 'Select Section', 'sec_id', 'name',$where_status);
			
            $this->data['sec_id'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name'] = '';
            $this->data['college_no'] = '';
			
            if($this->input->post('search')):
            $sec_id       =  $this->input->post('sec_id');
            $student_name       =  $this->input->post('student_name');
            $father_name       =  $this->input->post('father_name');
            $college_no       =  $this->input->post('college_no');
            $like = '';
            $where = '';
             
            if(!empty($sec_id)):
                $where['sections.sec_id']   = $sec_id;
                $this->data['sec_id']       = $sec_id;
            endif;
            if(!empty($student_name)):
                $like['student_record.student_name']   = $student_name;
                $this->data['student_name']       = $student_name;
            endif;
            if(!empty($father_name)):
                $like['student_record.father_name']   = $father_name;
                $this->data['father_name']       = $father_name;
            endif;
            if(!empty($college_no)):
                $where['student_record.college_no']   = $college_no;
                $this->data['college_no']       = $college_no;
            endif;
                $this->data['result']       = $this->get_model->get_by_group_degree_student('student_group_allotment',$where,$like);   
			endif;	
           $this->data['page_title']   = 'Degree Year Head All Groups | ECMS';
           $this->data['page']         = 'admission/groups_degree';
           $this->load->view('common/common',$this->data);    
    }
	
	public function update_student_by_group_degree()
    {
        $id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
		if($this->input->post()):
			$section_id = $this->input->post('section_id');
			$old_section_id = $this->input->post('old_section_id');
			$student_id = $this->input->post('student_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
            $data = array(
                'section_id'=>$section_id,
                'up_timestamp'=>date('Y-m-d H:i:'),
                'up_user_id'=>$user_id
            );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('student_group_allotment',$data,$where);
              if($section_id != $old_section_id):
				$old_s = $old_section_id;
				else:
					$old_s = 'NULL';	
				endif;
			$data_log = array
                (
                   'student_id'=>$id,
                   'section_id'=>$old_s,
                   'date'=>date('Y-m-d'),
				   'timestamp'=>date('Y-m-d H:i:'),
                   'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_group_allotment_log',$data_log);
              redirect('admin/degree_std_updassign_subjects_of_group/'.$student_id.'/'.$sub_pro_id); 
         endif;
            if($id):
                $where = array('student_group_allotment.serial_no'=>$id);
                $this->data['result'] = $this->get_model->get_Studentgroup_row('student_group_allotment',$where);
                $this->data['page_title']        = 'Update Student By Group | ECMS';
                $this->data['page']        =  'admission/update_student_by_group_degree';
                $this->load->view('common/common',$this->data);
            endif;
    }
	
	public function degree_student_group()
    {
        $session = $this->session->all_userdata();
		$user_id =$session['userData']['user_id'];
		$this->data['sub_program']= $this->get_model->degree_dropDown('sub_programes', 'Select Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
        $this->data['program']    = $this->get_model->degree_dropDown('programes_info', 'Select Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
        $this->data['gender']     = $this->CRUDModel->dropDown('gender', 'Select Gender ', 'gender_id', 'title');
        $this->data['batch']      = $this->get_model->degree_dropDown('prospectus_batch', 'Select Batch ', 'batch_id', 'batch_name');
        $this->data['section']    = $this->get_model->degree_dropDown_section('sections', 'Select Section ', 'sec_id', 'name',array('status'=>'On'));
            $student_name            =  $this->input->post('student_name');
            $father_name            =  $this->input->post('father_name');
            $college_no            =  $this->input->post('college_no');
            $batch_id            =  $this->input->post('batch_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $programe_id            =  $this->input->post('programe_id');
            $gender_id            =  $this->input->post('gender_id');
            $limit              =  $this->input->post('limit');
          
            
            $where = '';
            $like = '';
            $this->data['student_name']  = '';
            $this->data['father_name']  = '';
            $this->data['college_no']  = '';
            $this->data['batch_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['programe_id']  = '';
            $this->data['gender_id']  = '';
            $this->data['limit']  = '';
            
            $where['student_record.s_status_id'] = 5;
            $where['student_record.flag'] = 0;
            
            if($this->input->post('search')):
                if(!empty($student_name)):
                    $like['student_record.student_name'] = $student_name;
                    $this->data['student_name']  = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['student_record.father_name'] = $father_name;
                    $this->data['father_name']  = $father_name;
                endif;
                if(!empty($college_no)):
                    $where['student_record.college_no'] = $college_no;
                    $this->data['college_no']  = $college_no;
                endif;
                if(!empty($batch_id)):
                    $where['prospectus_batch.batch_id'] = $batch_id;
                    $this->data['batch_id']  = $batch_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                    $this->data['sub_pro_id']  = $sub_pro_id;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id'] = $programe_id;
                    $this->data['programe_id']  = $programe_id;
                endif;
                if(!empty($gender_id)):
                    $where['gender.gender_id'] = $gender_id;
                    $this->data['gender_id']  = $gender_id;
                endif;
            
                $this->data['result']   = $this->get_model->search_degree_student_group('student_record',$where,$like,$limit);
            endif;
            if($this->input->post('save')):
            
            $ides = $this->input->post('checked');
            $sec_id = $this->input->post('sec_id');
        
            foreach($ides as $row=>$value):
            
                
                $this->CRUDModel->update('student_record',array('flag'=>1),array('student_id'=>$value));
                $this->CRUDModel->insert('
                student_group_allotment',
                 array(
                       'student_id'=>$value,
                       'section_id'=>$sec_id,
					   'timestamp'=>date('Y-m-d H:i:'),
                       'user_id'=>$user_id
                 ));
            endforeach;
            endif;
        
            $this->data['page']     =   "admission/degree_student_group";
            $this->data['title']    =   'Degree Student Group| ECMS';
            $this->load->view('common/common',$this->data);        
        
    }
	
	public function a_level_subject_allotment()
	{		
		$this->data['a_level_Students']  = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>'5'));	
		if($this->input->post('search')):
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
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
         $this->data['result']       = $this->get_model->a_level_subject_allot($where,$like);
		endif;
        $this->data['page_title']   = 'All A-Level Students | ECMS';
        $this->data['page']         = 'admission/a_level_subject_allotment';
        $this->load->view('common/common',$this->data); 
    }
	
	public function a_level_updassign_subjects()
    {
        $id                 = $this->uri->segment(3);
        $sub_pro_id         = $this->uri->segment(4);
        $where              = array('student_id'=>$id);
        $subpro_where       = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
        $this->data['selectsubjects'] = $this->CRUDModel->get_where_result('student_subject_alloted', $where);
        $this->data['subjects'] = $this->CRUDModel->get_where_result('subject', $subpro_where);
        
        $this->data['page_title']   = 'A Level Student Assign Subjects | ECMS';
       $this->data['page']         = 'admission/a_level_updassign_subjects';
       $this->load->view('common/common',$this->data);
    }
	
	public function a_level_assign_subjects(){
        $id                         = $this->uri->segment(3);
        $sub_pro_id                 = $this->uri->segment(4);
        $where                      = array('student_id'=>$id);
        $subpro_where               = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result']       = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['subjects']     = $this->CRUDModel->get_where_result('subject', $subpro_where);
         $this->data['sectionsName']    = $this->CRUDModel->dropDown('sections', 'Select section ', 'sec_id', 'name',array('program_id'=>5,'status'=>'On'));
        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
        $this->data['sectionsId'] = '';
        if($this->data['section']):
            $this->data['sectionsId'] =$this->data['section']->section_id; 
            endif;
        $this->data['page_title']   = 'Student Assign Subjects A-Level | ECMS';
       $this->data['page']          = 'admission/a_level_assign_subjects';
       $this->load->view('common/common',$this->data);
    }
	
	public function a_level_assigning_subject()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $ides       = $this->input->post('checked');
            $student_id = $this->input->post('student_id');
            $sec_id     = $this->input->post('sec_id');
         if(!empty($ides)):
            foreach($ides as $row=>$value):
                $this->CRUDModel->insert('
                student_subject_alloted',
                 array(
                       'subject_id'=>$value,
                       'student_id'=>$student_id,
                       'section_id'=>$sec_id,
                       'user_id'=>$user_id
                 ));
            endforeach;   
         endif;
         if($sec_id): 
                $getId = $this->CRUDModel->get_where_row('student_group_allotment',array('student_id'=>$student_id));
                if($getId):
                    $this->CRUDModel->update('student_group_allotment',array('section_id'=>$sec_id,'up_user_id'=>$user_id) ,array('student_id'=>$student_id));
                    else:
                    $sec_data = array(
                                'student_id'=>$student_id,
                                'section_id'=>$sec_id,
                                'user_id'=>$user_id
                            );
                    $this->CRUDModel->insert('student_group_allotment',$sec_data);
                endif;
         endif;
        redirect('admin/a_level_subject_allotment');
        endif;
    }
	
	public function update_a_level_assigning_subject22022019()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $ides       = $this->input->post('checked');
            $student_id = $this->input->post('student_id');
            $where      = array('student_id'=>$student_id);
            $sec_id     = $this->input->post('sec_id');
            $sec_name   = $this->input->post('sec_name');
            $ids        = $this->CRUDModel->deleteid('student_subject_alloted', array('student_id'=>$student_id));
			if(!empty($ides)):
				foreach($ides as $row=>$value):
				$data =  array(
						   'subject_id' =>$value,
						   'student_id' =>$student_id,
						   'section_id' =>$sec_id,
						   'user_id'    =>$user_id
					 );
				$this->CRUDModel->insert('student_subject_alloted',$data );
				endforeach;
			endif;
       if(!empty($sec_id)):
             $sec_data = array(
                'section_id'=>$sec_id,
                'user_id'=>$user_id
            );
        $this->CRUDModel->update('student_group_allotment',$sec_data,$where);
       endif;
            redirect('admin/a_level_subject_allotment');
            endif;
    }
	
    public function update_a_level_assigning_subject()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $ides       = $this->input->post('checked');
            $student_id = $this->input->post('student_id');
            $where      = array('student_id'=>$student_id);
            $sec_id     = $this->input->post('sec_id');
            $sec_name   = $this->input->post('sec_name');
            $ids        = $this->CRUDModel->deleteid('student_subject_alloted', array('student_id'=>$student_id));
            
                if(!empty($ides)):
                    foreach($ides as $row=>$value):
                    $data =  array(
                                       'subject_id' =>$value,
                                       'student_id' =>$student_id,
                                       'section_id' =>$sec_id,
                                       'user_id'    =>$user_id
                             );
                    $this->CRUDModel->insert('student_subject_alloted',$data );
                    endforeach;
                endif;
            if(!empty($sec_id)):
                $sec_data = array(
                   'section_id'=>$sec_id,
                   'user_id'=>$user_id
                );
                $this->CRUDModel->update('student_group_allotment',$sec_data,$where);
            endif;
            
            $log_sec_id         = $this->input->post('log_sec_id');
            $checked_log        = $this->input->post('check_log');
            $log_college_no     = $this->input->post('log_college_no');
            
           $old_sec_ids ='';
            if($sec_id != $log_sec_id):
                    $old_sec_ids = $log_sec_id;
            else:
                    $old_sec_ids = 'NULL';	
            endif;
            if($college_no != $log_college_no):
                    $old_clg_no = $log_college_no;
            else:
                    $old_clg_no = 'NULL';	
            endif;
//            echo '<pre>'; print_r($checked_log); die;
            foreach($checked_log as $rows=>$log_row){
                $data =  array(
                               'subject_id' =>$log_row,
                               'student_id' =>$student_id,
                               'section_id' =>$old_sec_ids,
                               'user_id'    =>$user_id
                         );
//                echo '<pre>'; print_r($log_row); die;
            $this->CRUDModel->insert('student_subject_alloted_logs',$data );
            } 
            
            
            
            redirect('admin/a_level_subject_allotment');
        endif;
    }
	
    
	public function add_law_student(){
            $this->data['religion']          = $this->CRUDModel->dropDown('religion', '', 'religion_id', 'title');
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
			$this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_student_record');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
//                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'net_id'=>$this->input->post('net_id'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/law_student_academic_record/'.$id);
            endif;
            endif;
            $this->data['page_title']   = 'Add New Law Student | ECMS';
            $this->data['page']         = 'admission/law/form/add_law_student';
            $this->load->view('common/common',$this->data);
	}
    
    public function add_bs_english_student(){
        
        $batch_order['column'] ='batch_id';
        $batch_order['order'] ='desc';
        $this->data['prospectus_batch']     = $this->CRUDModel->dropDown('prospectus_batch', '', 'batch_id', 'batch_name',array('programe_id'=>8),$batch_order);
        $this->data['programes_info']       = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>8));
        $this->data['sub_programes']        = $this->CRUDModel->dropDown('sub_programes', '', 'sub_pro_id', 'name',array('programe_id'=>8));
        $this->data['reserved_seat']        = $this->CRUDModel->dropDown('reserved_seat', '', 'rseat_id', 'name'); 
        $this->data['gender']               = $this->CRUDModel->dropDown('gender', '', 'gender_id', 'title'); 
        $this->data['marital_status']       = $this->CRUDModel->dropDown('marital_status', '', 'marital_status_id', 'title'); 
        $this->data['blood_group']          = $this->CRUDModel->dropDown('blood_group', 'Blood Group', 'b_group_id', 'title'); 
        $this->data['mobile_network']       = $this->CRUDModel->dropDown('mobile_network', 'Mobile Network', 'net_id', 'network'); 
        $this->data['occupation']           = $this->CRUDModel->dropDown('occupation', 'Select Occupation', 'occ_id', 'title'); 
        $this->data['relation']             = $this->CRUDModel->dropDown('relation', 'Select Occupation', 'relation_id', 'title'); 
        $this->data['religion']          = $this->CRUDModel->dropDown('religion', '', 'religion_id', 'title');
        
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                = $this->input->post('dob'); 
            $date1              = date('Y-m-d', strtotime($dob));
            $this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_bs_english_student');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/bs_english_student_academic_record/'.$id);
            endif;
        endif;
        
            $this->data['page_title']   = 'Add New Bs-English Student | ECMS';
            $this->data['title']        = 'Add New Bs-English Student';
            $this->data['page']         = 'admission/bs_english/form/add_bs_english_student';
            $this->load->view('common/common',$this->data);
	}
    
    public function law_student_academic_record($id){
        
        
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
        redirect('admin/law_student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'lat_marks'=>$this->input->post('lat_marks'),
                'grade_id'=>$this->input->post('grade_id'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/law_student_academic_record/'.$this->input->post('student_id'));
            endif;
            endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'Select Board  ', 'bu_id', 'title');
			$this->data['grade']  = $this->CRUDModel->dropDown('grade', ' Select Grade ', 'grade_id', 'grade_name');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students (Law) | ECMS';
            $this->data['page']         = 'admission/law/form/add_law_academic_record';
            $this->load->view('common/common',$this->data);
	}
    
    public function economics_student_academic_record($id){		
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
        redirect('admin/economics_student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/economics_student_academic_record/'.$this->input->post('student_id'));
            endif;
            endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'Select Board  ', 'bu_id', 'title');
			$this->data['grade']  = $this->CRUDModel->dropDown('grade', ' Select Grade ', 'grade_id', 'grade_name');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Student Academic Record (BS Economics) | ECMS';
            $this->data['page']         = 'admission/economics/form/economics_academic_record';
            $this->load->view('common/common',$this->data);
	}
    public function bs_english_student_academic_record(){		
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
 
        if($this->input->post()):
            $TotMarks = $this->input->post('total_marks');
            $ObtMarks = $this->input->post('obtained_marks');
            
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
                redirect('admin/bs_english_student_academic_record/'.$this->input->post('student_id'));

                else:
                $data = array
                    (	
                        'student_id'        => $this->input->post('student_id'),
                        'degree_id'         => $this->input->post('degree_id'),
                        'inst_id'           => $this->input->post('inst_id'),
                        'bu_id'             => $this->input->post('bu_id'),
                        'year_of_passing'   => $this->input->post('year_of_passing'),
                        'total_marks'       => $this->input->post('total_marks'),
                        'obtained_marks'    => $this->input->post('obtained_marks'),
                        'year_of_passing'   => $this->input->post('year_of_passing'),
                        'cgpa'              => $this->input->post('cgpa'),
                        'grade_id'          => $this->input->post('grade_id'),
                        'percentage'        => $percent,
                        'exam_type'         => $this->input->post('exam_type'),
                        'inserteduser'      => $this->userInfo->user_id
                    );
                    $this->CRUDModel->insert('applicant_edu_detail',$data);
                    redirect('admin/bs_english_student_academic_record/'.$this->input->post('student_id'));
                endif;
        endif;
            $this->data['degree']               = $this->CRUDModel->dropDown('degree', 'Select degree ', 'degree_id', 'title');
             $order['column'] = 'yr_num';
            $order['order'] = 'desc';
            $this->data['year']                 = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num','',$order);
            $this->data['board_university']     = $this->CRUDModel->dropDown('board_university', 'Select Board  ', 'bu_id', 'title');
            $this->data['grade']                = $this->CRUDModel->dropDown('grade', ' Select Grade ', 'grade_id', 'grade_name');
                    
            $where                              = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records']      = $this->get_model->student_edu_record($where);
            $this->data['page_title']           = 'Academic Record of Students (BS-English) | ECMS';
            $this->data['page']                 = 'admission/bs_english/form/bs_english_student_academic_record';
            $this->load->view('common/common',$this->data);
	}
	
	public function upload_law_sphoto()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
			if($file_name == "_thumb"):		
				$data = array(
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			else: 
				$data = array(
					'applicant_image'=>$file_name,
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			endif;
            redirect('admin/law_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
            $this->data['page_title']        = 'Upload Law Student Picture | ECMS';
            $this->data['page']        =  'admission/upload_law_sphoto';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function upload_economics_sphoto()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
			if($file_name == "_thumb"):		
				$data = array(
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			else: 
				$data = array(
					'applicant_image'=>$file_name,
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			endif;
            redirect('admin/economics_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
            $this->data['page_title']        = 'Upload Economics Student Picture | ECMS';
            $this->data['page']        =  'admission/upload_law_sphoto';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function upload_bs_english_sphoto()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			$college_no = $this->input->post('college_no');
			$admission_date = $this->input->post('admission_date');
			$date = date('Y-m-d', strtotime($admission_date));
			if($file_name == "_thumb"):		
				$data = array(
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			else: 
				$data = array(
					'applicant_image'=>$file_name,
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
			endif;
            redirect('admin/bs_english_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
            $this->data['page_title']        = 'Upload BS-English Student Picture | ECMS';
            $this->data['page']        =  'admission/upload_bs_english_sphoto';
            $this->load->view('common/common',$this->data);
        endif;
    }
	


	
	public function admin_student_flag_change(){       
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
        $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));   
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit ', 'limitId', 'limit_value');
        $college_no                     =  $this->input->post('college_no');
        $form_no                        =  $this->input->post('form_no');
        $student_name                   =  $this->input->post('student_name');
        $father_name                    =  $this->input->post('father_name');
        $program                        =  $this->input->post('program');
        $sub_program                    =  $this->input->post('sub_program');
        $batch                          =  $this->input->post('batch');
        $s_status_id                    =  $this->input->post('s_status_id');
        $like = '';
            $where = '';
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['programId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']          = '';
            $this->data['s_status_id']          = '';
            
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
             if(!empty($s_status_id)):
                 $where['student_record.s_status_id'] = $s_status_id;
                $this->data['s_status_id'] = $s_status_id;
            endif;
            if($this->input->post('search')):          
                $field = '
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.flag,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                    ';
        $this->data['result'] = $this->get_model->student_status_change($field,'student_record', $where,$like);
            endif;
           $this->data['page_title']   = 'Admin Student Flag Change | ECMS';
           $this->data['page']         = 'admission/admin_student_flag_change';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function update_flag()
	{
        $student_id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student_id   = $this->input->post('student_id');
            $flag   = $this->input->post('flag');
            $data = array
                (
                   'flag'=>$flag     
                );
           $where = array('student_id'=>$student_id);
		   $this->CRUDModel->update('student_record',$data,$where);
		   redirect('admin/admin_student_flag_change');
        endif;
        if($student_id):
            $where = array('student_record.student_id'=>$student_id);
            $this->data['result'] = $this->get_model->get_student_flagData('student_record',$where);
            $this->data['result_flag'] = $this->get_model->get_student_group_row('student_group_allotment',$where);
            $this->data['page_title']   = 'Admin Student Flag Change  | ECMS';
            $this->data['page']         = 'admission/update_flag';
            $this->load->view('common/common',$this->data);
        endif;
	}  

     public function delete_group_of_flag()
    {	    
        $id         = $this->uri->segment(3);
        $std_id         = $this->uri->segment(4);
        $where      = array('serial_no'=>$id);
        $this->CRUDModel->deleteid('student_group_allotment',$where);
        redirect('admin/update_flag/'.$std_id);
	}
	
    public function languages_student_record(){       
            $like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['lang_status_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
            $this->data['programe_id']        = '';
            $this->data['sub_pro_id']     = '';
            $this->data['batch_id']          = '';
	   
	   if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
        
                $this->data['result']   = $this->get_model->get_langstdData('student_record',$where,$like,$custom);
			else:
			$where               = array('student_record.programe_id'=>'10');
            //pagination start
            $config['base_url']         = base_url('admin/languages_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 100;
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
            $this->data['result']    = $this->get_model->stds_lang_pagination($config['per_page'], $page,$where,$custom);
			 $this->data['count']     =$config['total_rows']; 
			endif;
           if($this->input->post('export')):
		   
                
			$student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
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
                $this->excel->getActiveSheet()->setTitle('Merit list');
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
                
                $this->excel->getActiveSheet()->setCellValue('H1','Batch Name');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Comments');
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
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Reserved Seats');
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
				
				$this->excel->getActiveSheet()->setCellValue('X1','Student Status');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
				
				
       for($col = ord('A'); $col <= ord('X'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
		
            $result   = $this->get_model->get_meritlistlanguage('student_record',$where,$like,$custom);
          //  echo '<pre>';print_r($result);die;
			foreach($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='Language_lab.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
			endif;
           $this->data['page_title']   = 'All Languages Student Records | ECMS';
           $this->data['page']         = 'admission/Languages/Chinese/chinese_languages_student_record';
           $this->load->view('common/common',$this->data);
    }
	
	public function update_language_student(){	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
         
        if($this->input->post()){
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'lang_status_id'=>$_POST['lang_status_id'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'applicant_mob_no1'=>$_POST['applicant_mob_no1'],
                'std_mobile_network'=>$_POST['mobile_network_student'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
             $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
            $data_log = array
                (
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
                   'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/languages_student_record');
        }
        $this->load->view("common/header");
        $this->load->view("common/nav");
        $this->load->view("admission/Languages/English/update_language_student", $prodata);
        $this->load->view("common/footer");
        
        
	}
	
	public function add_language_student(){	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
        
            $number = "";
            $form_no = "";
            $code = "HSK";
            $batch_id = $this->input->post('batch_id');
            $this->db->limit(1,0)->order_by('student_id','desc');
            $res = $this->db->get_where('student_record',array('batch_id'=>$batch_id))->row();
            if(empty($res)):
                    $number = 1;
                else:
                    $d = explode("-",$res->form_no);
                    $number = $d[1]+1;
                endif;
            $form_no = $code.'-'.$number;
            
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$form_no,
                'comment'=>$this->input->post('comment'),
                'lang_college_no'=>$this->input->post('college_no'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'applicant_mob_no1'=>$this->input->post('mobile_no'),
                'std_mobile_network'=>$this->input->post('mobile_network_std'),
                'mobile_no'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/languages_student_record');
            endif;
            $this->data['pages']        = 'Add New Language Student Chinese';
            $this->data['page_title']   = 'Add New Language Student Chinese | ECMS';
            $this->data['page']         = 'admission/Languages/Chinese/add_chinese_language_student';
            $this->load->view('common/common',$this->data);
            
	}
    
    public function search_language_student()
	{	
        $where = '';
        $like = '';
        $this->data['student_id']  = '';
       //  echo '<pre>';print_r($this->input->post());die;
        if($this->input->post()):
            $student_id = $this->input->post('student_id');
           
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] = $student_id;
            endif;
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        endif;
        $this->data['page_title']   = 'Add New Language Student | ECMS';
        $this->data['page']         = 'admission/add_language_student';
        $this->load->view('common/common',$this->data);
	}
    
    public function add_english_student(){	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            
            $number = "";
            $form_no = "";
            $code = "ENG";
            $batch_id = $this->input->post('batch_id');
            $this->db->limit(1,0)->order_by('student_id','desc');
            $res = $this->db->get_where('student_record',array('batch_id'=>$batch_id))->row();
            if(empty($res)):
                    $number = 1;
                else:
                    $d = explode("-",$res->form_no);
                    $number = $d[1]+1;
                endif;
            $form_no = $code.'-'.$number;
        
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$form_no,
                'comment'=>$this->input->post('comment'),
                'lang_college_no'=>$this->input->post('college_no'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'applicant_mob_no1'=>$this->input->post('mobile_no'),
                'mobile_no'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
          //  echo '<pre>';print_r($data);die;
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/english_student_record');
            endif;
            $this->data['page_title']   = 'Add English Student | ECMS';
            $this->data['page']         = 'admission/Languages/English/add_english_student';
            $this->load->view('common/common',$this->data);
            
	}
    
    public function add_arabic_student()
	{	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            
            $number = "";
            $form_no = "";
            $code = "ARB";
            $batch_id = $this->input->post('batch_id');
            $this->db->limit(1,0)->order_by('student_id','desc');
            $res = $this->db->get_where('student_record',array('batch_id'=>$batch_id))->row();
            if(empty($res)):
                    $number = 1;
                else:
                    $d = explode("-",$res->form_no);
                    $number = $d[1]+1;
                endif;
            $form_no = $code.'-'.$number;
        
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$form_no,
                'comment'=>$this->input->post('comment'),
                'lang_college_no'=>$this->input->post('college_no'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'applicant_mob_no1'=>$this->input->post('mobile_no'),
                'mobile_no'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id
            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/arabic_student_record');
            endif;
            $this->data['page_title']   = 'Add Arabic Student | ECMS';
            $this->data['page']         = 'admission/add_arabic_student';
            $this->load->view('common/common',$this->data);
            
	}
    
    public function english_student_record(){       
            $like = '';
            $where['student_record.programe_id'] = '13';
            $this->data['student_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['lang_status_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
			$this->data['programe_id']        = '';
			$this->data['sub_pro_id']     = '';
			$this->data['batch_id']          = '';
	   
	   if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
        
                $this->data['result']   = $this->get_model->get_langstdData('student_record',$where,$like,$custom);
			else:
			$where               = array('student_record.programe_id'=>'13');
            //pagination start
            $config['base_url']         = base_url('admin/english_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 100;
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
            $this->data['result']    = $this->get_model->stds_english_pagin($config['per_page'], $page,$where,$custom);
			 $this->data['count']     =$config['total_rows']; 
			endif;
           if($this->input->post('export')):
		   
                
			$student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
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
                $this->excel->getActiveSheet()->setTitle('Merit list');
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
                
                $this->excel->getActiveSheet()->setCellValue('H1','Batch Name');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Comments');
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
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Reserved Seats');
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
				
				$this->excel->getActiveSheet()->setCellValue('X1','Student Status');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
				
				
       for($col = ord('A'); $col <= ord('X'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
		
            $result   = $this->get_model->get_meritlistlanguage('student_record',$where,$like,$custom);
          //  echo '<pre>';print_r($result);die;
			foreach($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='English_Language_Students.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
			endif;
           $this->data['page_title']   = 'English Language Students Record | ECMS';
           $this->data['page']         = 'admission/Languages/English/english_student_record';
           $this->load->view('common/common',$this->data);
    }
    
    public function arabic_student_record()
    {       
			$like = '';
            $where['student_record.programe_id'] = '15';
            $this->data['student_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['lang_status_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
			$this->data['programe_id']        = '';
			$this->data['sub_pro_id']     = '';
			$this->data['batch_id']          = '';
	   
	   if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
        
                $this->data['result']   = $this->get_model->get_langstdData('student_record',$where,$like,$custom);
			else:
			$where               = array('student_record.programe_id'=>'15');
            //pagination start
            $config['base_url']         = base_url('admin/english_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 100;
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
            $this->data['result']    = $this->get_model->stds_arabic_pagin($config['per_page'], $page,$where,$custom);
			 $this->data['count']     =$config['total_rows']; 
			endif;
           if($this->input->post('export')):
		   
                
			$student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
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
                $this->excel->getActiveSheet()->setTitle('Merit list');
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
                
                $this->excel->getActiveSheet()->setCellValue('H1','Batch Name');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Comments');
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
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Reserved Seats');
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
				
				$this->excel->getActiveSheet()->setCellValue('X1','Student Status');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
				
				
       for($col = ord('A'); $col <= ord('X'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
		
            $result   = $this->get_model->get_meritlistlanguage('student_record',$where,$like,$custom);
          //  echo '<pre>';print_r($result);die;
			foreach($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='English_Language_Students.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
			endif;
           $this->data['page_title']   = 'Arabic Language Students Record | ECMS';
           $this->data['page']         = 'admission/arabic_student_record';
           $this->load->view('common/common',$this->data);
    }
    
    public function search_english_student()
	{	
        $where = '';
        $like = '';
        $this->data['student_id']  = '';
       //  echo '<pre>';print_r($this->input->post());die;
        if($this->input->post()):
            $student_id = $this->input->post('student_id');
           
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] = $student_id;
            endif;
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        endif;
        $this->data['page_title']   = 'Add English Student | ECMS';
        $this->data['page']         = 'admission/Languages/English/add_english_student';
        $this->load->view('common/common',$this->data);
	}
    
    public function search_arabic_student()
	{	
        $where = '';
        $like = '';
        $this->data['student_id']  = '';
        if($this->input->post()):
            $student_id = $this->input->post('student_id');
           
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] = $student_id;
            endif;
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        endif;
        $this->data['page_title']   = 'Add Arabic Student | ECMS';
        $this->data['page']         = 'admission/add_arabic_student';
        $this->load->view('common/common',$this->data);
	}
	
	public function langauge_student_academic_record($id)
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
        redirect('admin/langauge_student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'grade_id'=>$this->input->post('grade_id'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/langauge_student_academic_record/'.$this->input->post('student_id'));
            endif;
            endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'Select Board  ', 'bu_id', 'title');
			$this->data['grade']  = $this->CRUDModel->dropDown('grade', ' Select Grade ', 'grade_id', 'grade_name');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students (Language) | ECMS';
            $this->data['page']         = 'admission/langauge_student_academic_record';
            $this->load->view('common/common',$this->data);
	}
    
    public function german_student_record()
    {       
			$like = '';
            $where = '';
            $this->data['student_id'] = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['lang_status_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
			$this->data['programe_id']        = '';
			$this->data['sub_pro_id']     = '';
			$this->data['batch_id']          = '';
	   
	   if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
        
                $this->data['result'] = $this->get_model->get_germanstdData('student_record',$where,$like,$custom);
			else:
			$where               = array('student_record.programe_id'=>'11');
            //pagination start
            $config['base_url']         = base_url('admin/german_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 100;
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
            $this->data['result']    = $this->get_model->stds_german_pagination($config['per_page'], $page,$where,$custom);
			 $this->data['count']     =$config['total_rows']; 
			endif;
           if($this->input->post('export')):
		   
                
			$student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
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
                $this->excel->getActiveSheet()->setTitle('German Students list');
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
                
                $this->excel->getActiveSheet()->setCellValue('H1','Batch Name');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Comments');
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
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Reserved Seats');
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
				
				$this->excel->getActiveSheet()->setCellValue('X1','Student Status');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
				
				
       for($col = ord('A'); $col <= ord('X'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
            $result   = $this->get_model->get_meritlistlanguage('student_record',$where,$like,$custom);
			foreach($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='Language_lab.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
			endif;
           $this->data['page_title']   = 'All German Students Record | ECMS';
           $this->data['page']         = 'admission/german_student_record';
           $this->load->view('common/common',$this->data);
    }
    
    public function add_german_student()
	{	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
        
            $number = "";
            $form_no = "";
            $code = "GRM";
            $batch_id = $this->input->post('batch_id');
            $this->db->limit(1,0)->order_by('student_id','desc');
            $res = $this->db->get_where('student_record',array('batch_id'=>$batch_id))->row();
            if(empty($res)):
                    $number = 1;
                else:
                    $d = explode("-",$res->form_no);
                    $number = $d[1]+1;
                endif;
            $form_no = $code.'-'.$number; 
        
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$form_no,
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'lang_college_no'=>$this->input->post('college_no'),
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'applicant_mob_no1'=>$this->input->post('mobile_no'),
                'mobile_no'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/german_student_record');
            else:
            $this->data['page_title']   = 'Add New German Language Student | ECMS';
            $this->data['page']         = 'admission/add_german_student';
            $this->load->view('common/common',$this->data);
            endif;
	}
    
    public function update_german_student()
	{	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post())
        {
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'lang_status_id'=>$_POST['lang_status_id'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
             $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
            $data_log = array
                (
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
                   'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/german_student_record');
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_german_student", $prodata);
       $this->load->view("common/footer");
	}
    
    public function update_pashto_student()
	{	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post())
        {
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'lang_status_id'=>$_POST['lang_status_id'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
             $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
            $data_log = array
                (
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
                   'user_id'=>$user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/pashto_student_record');
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_pashto_student", $prodata);
       $this->load->view("common/footer");
	}
    
    public function add_pashto_student()
	{	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'applicant_mob_no1'=>$this->input->post('mobile_no'),
                'mobile_no'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/pashto_student_academic_record/'.$id);
            else:
            $this->data['page_title']   = 'Add New Pashto Student | ECMS';
            $this->data['page']         = 'admission/add_pashto_student';
            $this->load->view('common/common',$this->data);
            endif;
	}
    
    public function pashto_student_academic_record($id)
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
        redirect('admin/pashto_student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'grade_id'=>$this->input->post('grade_id'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/pashto_student_academic_record/'.$this->input->post('student_id'));
            endif;
            endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'Select Board  ', 'bu_id', 'title');
			$this->data['grade']  = $this->CRUDModel->dropDown('grade', ' Select Grade ', 'grade_id', 'grade_name');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Student (Pashto) | ECMS';
            $this->data['page']         = 'admission/pashto_student_academic_record';
            $this->load->view('common/common',$this->data);
	}
    
    public function pashto_student_record()
    {       
			$like = '';
            $where = '';
            $this->data['student_id']  = '';
            $this->data['college_no']  = '';
            $this->data['form_no']     = '';
            $this->data['student_name']= '';
            $this->data['father_name'] = '';
            $this->data['gender_id']   = '';
            $this->data['lang_status_id']  = '';
            $this->data['s_status_id'] = '';
            $this->data['limitId']     = '';
			$this->data['programe_id'] = '';
			$this->data['sub_pro_id']  = '';
			$this->data['batch_id']    = '';
	   
	   if($this->input->post('search')):
            $student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
        
                $this->data['result']   = $this->get_model->get_pashtostdData('student_record',$where,$like,$custom);
			else:
			$where           = array('student_record.programe_id'=>'12');
            //pagination start
            $config['base_url']         = base_url('admin/pashto_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 100;
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
            $this->data['result']    = $this->get_model->stds_pashto_pagination($config['per_page'], $page,$where,$custom);
			 $this->data['count']     =$config['total_rows']; 
			endif;
           if($this->input->post('export')):
		   
                
			$student_id       =  $this->input->post('student_id');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $lang_status_id        =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
			$program             =  $this->input->post('programe_id');
            $sub_program         =  $this->input->post('sub_pro_id');
			$batch               =  $this->input->post('batch_id');
            
			if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
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
                $this->excel->getActiveSheet()->setTitle('Merit list');
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
                
                $this->excel->getActiveSheet()->setCellValue('H1','Batch Name');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Comments');
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
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Reserved Seats');
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
				
				$this->excel->getActiveSheet()->setCellValue('X1','Student Status');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
				
				
       for($col = ord('A'); $col <= ord('X'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
		
            $result   = $this->get_model->get_meritlistlanguage('student_record',$where,$like,$custom);
          //  echo '<pre>';print_r($result);die;
			foreach($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='Pashto_students_record.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
			endif;
           $this->data['page_title']   = 'Pashto Student Records | ECMS';
           $this->data['page']         = 'admission/pashto_student_record';
           $this->load->view('common/common',$this->data);
    }
    
    
    public function bs_students_record(){
            $this->data['program'] = $this->dropdownModel->bs_program_dropDown('programes_info', ' BS Programs ', 'programe_id', 'programe_name',array('programes_info.status'=>'yes'));
            $this->data['subprogrames'] = $this->dropdownModel->bs_subpro_dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('sub_programes.status'=>'yes'));
            $this->data['sections'] = $this->dropdownModel->bs_sec_dropDown('sections', 'Sections', 'sec_id','name',array('sections.status'=>'On'));
            $this->data['status'] = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name');
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            $s_status_id                        =  $this->input->post('s_status_id');
       
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['s_status_id']     = '';
            
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
            if(!empty($s_status_id)):
                 $where['student_status.s_status_id']  = $s_status_id;
                $this->data['s_status_id']    = $s_status_id;
            endif;
            $custom['column']       = 'student_record.college_no';
                $custom['order']        = 'asc';
        
            if($this->input->post('export')):
                $this->load->library('excel');
                
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Students Record Bs-Program');
                $this->excel->getActiveSheet()->setCellValue('A1', 'College #');          
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1','Student Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('C1','Father Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                           
                $this->excel->getActiveSheet()->setCellValue('D1', 'Batch');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1', 'Program');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('F1', 'Sub Program');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1', 'Section');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('H1', 'Status');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
    
            for($col = ord('A'); $col <= ord('H'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);               
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                }
                $field = '
                    student_record.college_no,
                    student_record.student_name,
                    student_record.father_name,
                    prospectus_batch.batch_name,
                    programes_info.programe_name,
                    sub_programes.name as sub_program,
                    sections.name as sectionName,
                    student_status.name as statusName
                    ';
                $result = $this->get_model->bs_program_export($field,'student_record',$where,$like);
                $exceldata="";
                foreach ($result as $row)
                {
                    $exceldata[] = $row;
                }              
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='BsProgram_StudentsRecord.xls'; 
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
                    student_status.name as statusName,
                    student_status.s_status_id as s_status_id,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name as batch,
                    sections.name as sectionName
                    ';

                $this->data['result']       = $this->get_model->bs_program_data($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'Students Record (BS-Programs)';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "admission/bs_students_record";
                $this->data['title']        = 'Students Record (BS-Programs) | ECMS';
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
            
            $this->data['ReportName']   = 'Students Record (BS-Programs)';
            $this->data['page']         = "admission/bs_students_record";
            $this->data['title']        = 'Students Record  (BS-Programs)| ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
        }
    
//    public function add_student_security()
//	{		
//        $id = $this->uri->segment(3);
//        $this->data['student_id'] = $id;
//        $session = $this->session->all_userdata();
//        $user_id =$session['userData']['user_id'];
//        if($this->input->post()):
//        $whereEDCheck = array(
//           'student_id'=>$this->input->post('student_id')
//        );
//        $query = $this->CRUDModel->get_where_row('student_security',$whereEDCheck);
//        if($query):
//        $this->session->set_flashdata('msg', 'This Student Record Already Exist');
//        redirect('admin/add_student_security/'.$this->input->post('student_id'));
//        else:
//        $dt = $this->input->post('date');
//        $date = date('Y-m-d', strtotime($dt));
//        $data = array
//            (	
//                'student_id'=>$this->input->post('student_id'),
//                'amount'=>$this->input->post('amount'),
//                'date'=>$date,
//                'comments'=>$this->input->post('comments'),
//                'user_id'=>$user_id
//            );
//            $this->CRUDModel->insert('student_security',$data);
//            redirect('studentSecurityList');
//        endif;
//        endif;
//            $where = array('student_security.student_id'=>$this->uri->segment(3));
//            $this->data['security'] =$this->get_model->get_std_security('student_security',$where);
//            $this->data['page_title']   = 'Add Student Security | ECMS';
//            $this->data['page']         = 'admission/add_student_security';
//            $this->load->view('common/common',$this->data);
//    }
    
    public function add_student_security()
	{		
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
        $whereEDCheck = array(
           'student_id'=>$this->input->post('student_id')
        );
        $query = $this->CRUDModel->get_where_row('student_security',$whereEDCheck);
        if($query):
        $this->session->set_flashdata('msg', 'This Student Record Already Exist');
        redirect('admin/add_student_security/'.$this->input->post('student_id'));
        else:
        $dt = $this->input->post('date');
        $date = date('Y-m-d', strtotime($dt));
        $gen_sec = $this->input->post('general_security');
        $host_sec = $this->input->post('hostel_security');
        $exam_fee = $this->input->post('exam_fee');
        $fines = $this->input->post('fines');
        $others = $this->input->post('others');
        $gen_host = $gen_sec + $host_sec;
        $deduction = $exam_fee + $fines + $others;
        $total_refund = $gen_host - $deduction;
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'general_security'=>$gen_sec,
                'hostel_security'=>$host_sec,
                'exam_fee'=>$exam_fee,
                'fines'=>$fines,
                'others'=>$others,
                'deduction'=>$deduction,
                'total_refund'=>$total_refund,
                'date'=>$date,
                'comments'=>$this->input->post('comments'),
                'user_id'=>$user_id
            );
            $this->CRUDModel->insert('student_security',$data);
            redirect('studentSecurityList');
        endif;
        endif;
            $where = array('student_security.student_id'=>$this->uri->segment(3));
            $this->data['security'] =$this->get_model->get_std_security('student_security',$where);
            $this->data['student'] = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$this->uri->segment(3)));
            $this->data['page_title']   = 'Add Student Security | ECMS';
            $this->data['page']         = 'admission/add_student_security';
            $this->load->view('common/common',$this->data);
    }
    
    public function student_security(){
            $this->data['program'] = $this->CRUDModel->dropDown('programes_info', ' BS Programs ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames'] = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['sections'] = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id','name',array('status'=>'On'));
            $this->data['status'] = $this->CRUDModel->dropDown('student_status', ' Student Status ', 's_status_id', 'name');
            
            $college_no                     =  $this->input->post('college_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            $s_status_id                        =  $this->input->post('s_status_id');
       
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
          
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['s_status_id']     = '';
            
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
            if(!empty($s_status_id)):
                 $where['student_status.s_status_id']  = $s_status_id;
                $this->data['s_status_id']    = $s_status_id;
            endif;
            $custom['column']       = 'student_record.college_no';
                $custom['order']        = 'asc';
        
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as statusName,
                    student_status.s_status_id as s_status_id,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name as batch,
                    sections.name as sectionName
                    ';
                $this->data['result']       = $this->get_model->bs_program_data($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'Add Student Security';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "admission/students_security";
                $this->data['title']        = 'Add Student Security | ECMS';
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
            
            $this->data['ReportName']   = 'Add Student Security';
            $this->data['page']         = "admission/students_security";
            $this->data['title']        = 'Add Student Security | ECMS';
            $this->load->view('common/common',$this->data); 
           endif; 
        }
    
    public function student_security_list(){
            
            $college_no                     =  $this->input->post('college_no');
            $where = '';
            $this->data['college_no']       = '';
          
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
         
            if($this->input->post('search')):
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as statusName,
                    student_status.s_status_id as s_status_id,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name as batch,
                    sections.name as sectionName
                    ';
        $this->data['std_search'] = $this->get_model->bs_program_data($field,'student_record', $where);
        $this->data['security'] = $this->get_model->get_std_security('student_security',$where);
            endif;
        
            $this->data['total_security']  = $this->get_model->stdsecurityList('student_security');   
            
                $this->data['page']         = "admission/students_security_list";
                $this->data['title']        = 'Students Security List | ECMS';
                $this->load->view('common/common',$this->data);     
        }
    
    public function update_student_security()
	{		
        $security_id = $this->uri->segment(3);
        $this->data['security_id'] = $security_id;
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
        $dt = $this->input->post('date');
        $date = date('Y-m-d', strtotime($dt));
        $gen_sec = $this->input->post('general_security');
        $host_sec = $this->input->post('hostel_security');
        $exam_fee = $this->input->post('exam_fee');
        $fines = $this->input->post('fines');
        $others = $this->input->post('others');
        $gen_host = $gen_sec + $host_sec;
        $deduction = $exam_fee + $fines + $others;
        $total_refund = $gen_host - $deduction;
        $data = array
            (
                'general_security'=>$gen_sec,
                'hostel_security'=>$host_sec,
                'exam_fee'=>$exam_fee,
                'fines'=>$fines,
                'others'=>$others,
                'deduction'=>$deduction,
                'total_refund'=>$total_refund,
                'date'=>$date,
                'comments'=>$this->input->post('comments'),
                'user_id'=>$user_id
            );
            $where = array('security_id'=>$security_id);
            $this->CRUDModel->update('student_security',$data,$where);
            redirect('studentSecurityList');
        endif;
            $where = array('student_security.security_id'=>$this->uri->segment(3));
            $this->data['security'] =$this->get_model->get_std_security_row('student_security',$where);
            $this->data['page_title']   = 'Update Student Security | ECMS';
            $this->data['page']         = 'admission/update_student_security';
            $this->load->view('common/common',$this->data);
    }
    
    public function adding_spicture()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize_test('applicant_image','assets/images/students');
            $file_name = $image['file_name'];
			if($file_name == "_thumb"):
				$shift_id = $this->input->post('shift_id');
				$rseats_id2 = $this->input->post('rseat_id2');
				$college_no = $this->input->post('college_no');
				$admission_date = $this->input->post('admission_date');
				$date = date('Y-m-d', strtotime($admission_date));
				$data = array(
					'rseats_id2'=>$rseats_id2,
					'shift_id'=>$shift_id,
					'college_no'=>$college_no,
					'admission_date'=>$date
				);
				$where = array('student_id'=>$id); 
				$this->CRUDModel->update('student_record',$data,$where);
				else: 
					$shift_id = $this->input->post('shift_id');
					$rseats_id2 = $this->input->post('rseat_id2');
					$college_no = $this->input->post('college_no');
					$admission_date = $this->input->post('admission_date');
					$date = date('Y-m-d', strtotime($admission_date));
					$data = array(
						'rseats_id2'=>$rseats_id2,
						'shift_id'=>$shift_id,
						'applicant_image'=>$file_name,
						'college_no'=>$college_no,
						'admission_date'=>$date
					);
					$where = array('student_id'=>$id); 
					$this->CRUDModel->update('student_record',$data,$where);
				endif;
            redirect('admin/add_picture'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->get_model->get_student_statusdata('student_record',$where);

            $this->data['page_title']        = 'Adding Student Picture | ECMS';
            $this->data['page']        =  'admission/adding_spicture';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function add_picture(){       
        $whereSub_pro = array('programe_id'=>1);
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program'] = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
        $this->data['status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $limit              =  $this->input->post('limit');
          
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
        if($this->input->post('search')):
            
            $where['student_record.programe_id'] = 1;
            $where['student_record.batch_id'] = 34;
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
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
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
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
        
           $this->data['result']   = $this->get_model->get_stdData('student_record',$where,$like,$custom);
           else:
           $where = array('student_record.batch_id'=>'34','student_record.programe_id'=>'1');
            $config['base_url']         = base_url('admin/new_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 10;
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
            $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
            $this->data['pages'] = $this->pagination->create_links();
            $custom['column']    ='student_id';
            $custom['order']     ='desc';          
            $this->data['result']    = $this->get_model->new_stds_pagination($config['per_page'], $page,$where,$custom);
            $this->data['count']     =$config['total_rows'];
            endif;
           $this->data['page_title']   = 'Add Picture | ECMS';
           $this->data['page']         = 'admission/add_picture';
           $this->load->view('common/common',$this->data);
    }
    
    public function auto_batches()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->AdmissionModel->get_auto_batches('prospectus_batch');
            $get_values          = array();
            foreach ($result_set as $row_set) {
                $get_values[]   = array( 
                    'value'=>$row_set->batch_name,
//                    'label'=>$row_set->batch_name.'('.$row_set->program.')',
                    'id'=>$row_set->batch_id,
//                    'flag'=>$row_set->flag
                );  
                
            }
            $matches = array();
            foreach($get_values as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['batch_id']  = $makkah_hotel['id'];
//            $makkah_hotel['flag']  = $makkah_hotel['flag'];
//            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
            else if($term != ''){
            $like   = array('batch_name'=>$term);
            
            $result_set             = $this->AdmissionModel->get_auto_batches('prospectus_batch',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->batch_name.'('.$row_set->program.')',
//                    'label'=>$row_set->batch_name.'('.$row_set->program.')',
                    'id'=>$row_set->batch_id,
//                    'flag'=>$row_set->flag
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['batch_id']  = $makkah_hotel['id'];
//            $makkah_hotel['flag']  = $makkah_hotel['flag'];
//            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 15);
            echo  json_encode($matches); 
            }
    }
    public function update_law_student(){	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post())
        {
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
//                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'applicant_mob_no1'=>$_POST['applicant_mob_no1'],
                'applicant_mob_no2'=>$_POST['applicant_mob_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'last_school_address'=>$_POST['last_school_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('admin/law_student_record');
			else:
            $data_log = array
			(
			   'student_id'=>$uri,
			   'batch_id'=>$old_b,
			   'programe_id'=>$old_p,
			   'sub_pro_id'=>$old_sp,
			   'form_no'=>$old_f,
			   'college_no'=>$old_c,
			   'rseats_id'=>$old_r,
			   'student_name'=>$old_sn,
			   'domicile_id'=>$old_dm,
			   'mobile_no'=>$old_m,
			   'mobile_no2'=>$old_mb,
               'date'=>date('Y-m-d'),
			   'timestamp'=>date('Y-m-d H:i:'),
			   'user_id'=>$user_id
			);
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/law_student_record');
			endif;
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/law/form/update_law_student", $prodata);
       $this->load->view("common/footer");
	}
    public function update_academic_record_law($id){
         
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST){
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array
            (
                'degree_id'=>$_POST['degree_id'],
                'inst_id'=>$_POST['inst_id'],
                'bu_id'=>$_POST['bu_id'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'total_marks'=>$_POST['total_marks'],
                'obtained_marks'=>$_POST['obtained_marks'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'cgpa'=>$_POST['cgpa'],
                'lat_marks'=>$this->input->post('lat_marks'),
                'grade_id'=>$_POST['grade_id'],
                'percentage'=>$percent,
                'exam_type'=>$_POST['exam_type']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/law_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/law/form/update_academic_record_law", $prodata);
       $this->load->view("common/footer");
		
	}
            
    public function update_bs_english_student(){	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post()){
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
//                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'applicant_mob_no1'=>$_POST['applicant_mob_no1'],
                'applicant_mob_no2'=>$_POST['applicant_mob_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('admin/bs_english_student_record');
			else:
            $data_log = array
			(
			   'student_id'=>$uri,
			   'batch_id'=>$old_b,
			   'programe_id'=>$old_p,
			   'sub_pro_id'=>$old_sp,
			   'form_no'=>$old_f,
			   'college_no'=>$old_c,
			   'rseats_id'=>$old_r,
			   'student_name'=>$old_sn,
			   'domicile_id'=>$old_dm,
			   'mobile_no'=>$old_m,
			   'mobile_no2'=>$old_mb,
               'date'=>date('Y-m-d'),
			   'timestamp'=>date('Y-m-d H:i:'),
			   'user_id'=>$user_id
			);
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/bs_english_student_record');
			endif;
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/bs_english/form/update_bs_english_student", $prodata);
       $this->load->view("common/footer");
	}
    public function update_academic_record_english($id){
         
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST){
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array
            (
                'degree_id'=>$_POST['degree_id'],
                'inst_id'=>$_POST['inst_id'],
                'bu_id'=>$_POST['bu_id'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'total_marks'=>$_POST['total_marks'],
                'obtained_marks'=>$_POST['obtained_marks'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'cgpa'=>$_POST['cgpa'],
                'grade_id'=>$_POST['grade_id'],
                'percentage'=>$percent,
                'exam_type'=>$_POST['exam_type']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/bs_english_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/bs_english/form/update_academic_record_english", $prodata);
       $this->load->view("common/footer");
		
	}
    
//BS Computer Sciecne 
        
    public function add_cs_student(){	
	    $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['religion']          = $this->CRUDModel->dropDown('religion', '', 'religion_id', 'title');
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            $this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_cs_student');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
//                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id     
				);
                $id = $this->CRUDModel->insert('student_record',$data);
                redirect('admin/cs_student_academic_record/'.$id);
                endif;
                endif;
        $this->data['page_title']   = 'Add New BS(CS) Student  | ECMS';
        $this->data['title']        = 'Add New BS(CS) Student';
        $this->data['page']         = 'admission/bs_computer/form/add_cs_student_record';
        $this->load->view('common/common',$this->data);
                
	}
    public function cs_update_student(){	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post()){
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
//                'hostel_required'=>$_POST['hostel_required'],
                'migration_status'=>$_POST['migration_status'],
                'migrated_remarks'=>$_POST['migrated_remarks'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'applicant_mob_no1'=>$_POST['applicant_mob_no1'],
                'applicant_mob_no2'=>$_POST['applicant_mob_no2'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'last_school_address'=>$_POST['last_school_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('admin/cs_student_record');
			else:
            $data_log = array
			(
			   'student_id'=>$uri,
			   'batch_id'=>$old_b,
			   'programe_id'=>$old_p,
			   'sub_pro_id'=>$old_sp,
			   'form_no'=>$old_f,
			   'college_no'=>$old_c,
			   'rseats_id'=>$old_r,
			   'student_name'=>$old_sn,
			   'domicile_id'=>$old_dm,
			   'mobile_no'=>$old_m,
			   'mobile_no2'=>$old_mb,
               'date'=>date('Y-m-d'),
			   'timestamp'=>date('Y-m-d H:i:'),
			   'user_id'=>$user_id
			);
            $this->CRUDModel->insert('student_record_logs',$data_log);
			redirect('admin/cs_student_record');
			endif;
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/bs_computer/form/update_cs_student", $prodata);
       $this->load->view("common/footer");
	}
    public function cs_student_academic_record($id){		
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
        redirect('admin/cs_student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'cgpa'=>$this->input->post('cgpa'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/cs_student_academic_record/'.$this->input->post('student_id'));
        endif;
        endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', ' Select degree  ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', ' Select Board  ', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students BS(CS)  | ECMS';
            $this->data['page']         = 'admission/bs_computer/form/cs_academic_record';
            $this->load->view('common/common',$this->data);
	}
        
           public function update_cs_academic_record($id){
         
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST){
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array
            (
                'degree_id'=>$_POST['degree_id'],
                'inst_id'=>$_POST['inst_id'],
                'bu_id'=>$_POST['bu_id'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'total_marks'=>$_POST['total_marks'],
                'obtained_marks'=>$_POST['obtained_marks'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'cgpa'=>$_POST['cgpa'],
                'grade_id'=>$_POST['grade_id'],
                'percentage'=>$percent,
                'exam_type'=>$_POST['exam_type']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/bs_english_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/bs_english/form/update_academic_record_english", $prodata);
       $this->load->view("common/footer");
	}
    public function add_economics_student(){	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
         $this->data['religion']          = $this->CRUDModel->dropDown('religion', '', 'religion_id', 'title');
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
			$this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_economics_student');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
//                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'net_id'=>$this->input->post('net_id'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'applicant_mob_no1'=>$this->input->post('applicant_mob_no1'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/economics_student_academic_record/'.$id);
            endif;
            endif;
            $this->data['title']   = 'Add BS Economics Student';
            $this->data['page_title']   = 'Add BS Economics Student | ECMS';
            $this->data['page']         = 'admission/economics/form/add_economics_student';
           $this->load->view('common/common',$this->data);
	}
        
    public function update_economics_student(){	
        $uri = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post())
        {
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
//                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'applicant_mob_no1'=>$_POST['applicant_mob_no1'],
                'applicant_mob_no2'=>$_POST['applicant_mob_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'last_school_address'=>$_POST['last_school_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('admin/economics_student_record');
			else:
            $data_log = array
			(
			   'student_id'=>$uri,
			   'batch_id'=>$old_b,
			   'programe_id'=>$old_p,
			   'sub_pro_id'=>$old_sp,
			   'form_no'=>$old_f,
			   'college_no'=>$old_c,
			   'rseats_id'=>$old_r,
			   'student_name'=>$old_sn,
			   'domicile_id'=>$old_dm,
			   'mobile_no'=>$old_m,
			   'mobile_no2'=>$old_mb,
               'date'=>date('Y-m-d'),
			   'timestamp'=>date('Y-m-d H:i:'),
			   'user_id'=>$user_id
			);
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('admin/economics_student_record');
			endif;
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/economics/form/update_economics_student", $prodata);
       $this->load->view("common/footer");
	}
    public function update_academic_record_economics($id){
         
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST){
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array
            (
                'degree_id'=>$_POST['degree_id'],
                'inst_id'=>$_POST['inst_id'],
                'bu_id'=>$_POST['bu_id'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'total_marks'=>$_POST['total_marks'],
                'obtained_marks'=>$_POST['obtained_marks'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'cgpa'=>$_POST['cgpa'],
                'grade_id'=>$_POST['grade_id'],
                'percentage'=>$percent,
                'exam_type'=>$_POST['exam_type']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/bs_english_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/bs_english/form/update_academic_record_english", $prodata);
       $this->load->view("common/footer");
		
	}
    public function add_bba_student(){	
            $session                    = $this->session->all_userdata();
            $user_id                    = $session['userData']['user_id'];
            $this->data['religion']     = $this->CRUDModel->dropDown('religion', '', 'religion_id', 'title');
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
			$this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_economics_student');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
//                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'net_id'=>$this->input->post('net_id'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'applicant_mob_no1'=>$this->input->post('applicant_mob_no1'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/bba_student_academic_record/'.$id);
            endif;
            endif;
        $this->data['page_title']   = 'Add BBA Student  | ECMS';
        $this->data['title']        = 'Add BBA Student';
        $this->data['page']         = 'admission/bba/form/add_bba_student_record';
        $this->load->view('common/common',$this->data);
        }
    public function bba_student_academic_record($id){		
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
        redirect('admin/bba_student_academic_record/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/bba_student_academic_record/'.$this->input->post('student_id'));
            
            endif;
            endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'Select Board  ', 'bu_id', 'title');
			$this->data['grade']  = $this->CRUDModel->dropDown('grade', ' Select Grade ', 'grade_id', 'grade_name');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            
            $this->data['page_title']   = 'Student Academic Record (BBA) | ECMS';
            $this->data['title']        = 'Student Academic Record BBA';
            $this->data['page']         = 'admission/bba/form/add_bba_academic_record';
            $this->load->view('common/common',$this->data);
	}
    public function update_bba_student(){	
        $uri        = $this->uri->segment(3);
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post()){
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
//                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'applicant_mob_no1'=>$_POST['applicant_mob_no1'],
                'applicant_mob_no2'=>$_POST['applicant_mob_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'last_school_address'=>$_POST['last_school_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('admin/economics_student_record');
			else:
            $data_log = array
			(
			   'student_id'=>$uri,
			   'batch_id'=>$old_b,
			   'programe_id'=>$old_p,
			   'sub_pro_id'=>$old_sp,
			   'form_no'=>$old_f,
			   'college_no'=>$old_c,
			   'rseats_id'=>$old_r,
			   'student_name'=>$old_sn,
			   'domicile_id'=>$old_dm,
			   'mobile_no'=>$old_m,
			   'mobile_no2'=>$old_mb,
               'date'=>date('Y-m-d'),
			   'timestamp'=>date('Y-m-d H:i:'),
			   'user_id'=>$user_id
			);
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('StudentRecordBBA');
			endif;
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/bba/form/update_bba_student", $prodata);
       $this->load->view("common/footer");
	}
    public function update_bba_student_academic_record($id){
         
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST){
            
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array
            (
                'degree_id'=>$_POST['degree_id'],
                'inst_id'=>$_POST['inst_id'],
                'bu_id'=>$_POST['bu_id'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'total_marks'=>$_POST['total_marks'],
                'obtained_marks'=>$_POST['obtained_marks'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'cgpa'=>$_POST['cgpa'],
                'grade_id'=>$_POST['grade_id'],
                'percentage'=>$percent,
                'exam_type'=>$_POST['exam_type']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('StudentRecordBBA');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/bba/form/update_bba_academic_record", $prodata);
       $this->load->view("common/footer");
		
    }
    public function add_hnd_student_record(){	
       $session                    = $this->session->all_userdata();
            $user_id                    = $session['userData']['user_id'];
            $this->data['religion']     = $this->CRUDModel->dropDown('religion', '', 'religion_id', 'title');
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
			$this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_hnd_student_record');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
//                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'net_id'=>$this->input->post('net_id'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'applicant_mob_no1'=>$this->input->post('applicant_mob_no1'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/hnd_student_academic_records/'.$id);
            endif;
            endif;
            $this->data['page_title']   = 'Add New HND Student | ECMS';
            $this->data['title']        = 'Add New HND Student';
            $this->data['page']         = 'admission/hnd/form/add_hnd_student_record';
            $this->load->view('common/common',$this->data);
        }
    public function hnd_student_academic_records($id){		
        $id                         = $this->uri->segment(3);
        $this->data['student_id']   = $id;
        $session                    = $this->session->all_userdata();
        $user_id                    = $session['userData']['user_id'];
        
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
        redirect('admin/hnd_student_academic_records/'.$this->input->post('student_id'));
        
        else:
        $data = array
            (	
                'student_id'        => $this->input->post('student_id'),
                'degree_id'         => $this->input->post('degree_id'),
                'inst_id'           => $this->input->post('inst_id'),
                'bu_id'             => $this->input->post('bu_id'),
                'year_of_passing'   => $this->input->post('year_of_passing'),
                'total_marks'       => $this->input->post('total_marks'),
                'obtained_marks'    => $this->input->post('obtained_marks'),
                'year_of_passing'   => $this->input->post('year_of_passing'),
                'percentage'        => $percent,
                'exam_type'         => $this->input->post('exam_type'),
                'inserteduser'      => $user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/hnd_student_academic_records/'.$this->input->post('student_id'));
            
            endif;
            endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'Select Board  ', 'bu_id', 'title');
			$this->data['grade']  = $this->CRUDModel->dropDown('grade', ' Select Grade ', 'grade_id', 'grade_name');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            
            $this->data['page_title']   = 'Student Academic Record (HND) | ECMS';
            $this->data['title']        = 'Student Academic Record HND';
            $this->data['page']         = 'admission/hnd/form/add_hnd_academic_records';
            $this->load->view('common/common',$this->data);
	}
    public function update_hnd_student_record(){	
        $uri        = $this->uri->segment(3);
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post()){
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
//                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'applicant_mob_no1'=>$_POST['applicant_mob_no1'],
                'applicant_mob_no2'=>$_POST['applicant_mob_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'last_school_address'=>$_POST['last_school_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('StudentRecordHND');
			else:
            $data_log = array
			(
			   'student_id'=>$uri,
			   'batch_id'=>$old_b,
			   'programe_id'=>$old_p,
			   'sub_pro_id'=>$old_sp,
			   'form_no'=>$old_f,
			   'college_no'=>$old_c,
			   'rseats_id'=>$old_r,
			   'student_name'=>$old_sn,
			   'domicile_id'=>$old_dm,
			   'mobile_no'=>$old_m,
			   'mobile_no2'=>$old_mb,
               'date'=>date('Y-m-d'),
			   'timestamp'=>date('Y-m-d H:i:'),
			   'user_id'=>$user_id
			);
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('StudentRecordHND');
			endif;
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/hnd/form/update_hnd_student_record", $prodata);
       $this->load->view("common/footer");
	}    
    public function update_hnd_academic_student_record($id){
         
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST){
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array
            (
                'degree_id'=>$_POST['degree_id'],
                'inst_id'=>$_POST['inst_id'],
                'bu_id'=>$_POST['bu_id'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'total_marks'=>$_POST['total_marks'],
                'obtained_marks'=>$_POST['obtained_marks'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'cgpa'=>$_POST['cgpa'],
                'grade_id'=>$this->input->post('grade_id'),
                'percentage'=>$percent,
                'exam_type'=>$_POST['exam_type']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('StudentRecordHND');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/hnd/form/update_hnd_academic_student_record", $prodata);
       $this->load->view("common/footer");
		
    }
    
    public function add_edsml_student_record(){	
       $session                    = $this->session->all_userdata();
            $user_id                    = $session['userData']['user_id'];
            $this->data['religion']     = $this->CRUDModel->dropDown('religion', '', 'religion_id', 'title');
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
			$this->load->helper('string');
            $length="4"; 
            $char="0123456789"; 
            $password=substr(str_shuffle($char), 0, $length);
			$checked = array(
               'batch_id'=>$this->input->post('batch_id'),
               'form_no'=>$this->input->post('form_no')
            );
			$qry = $this->CRUDModel->get_where_row('student_record',$checked);
			if($qry):
			$this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
			redirect('admin/add_edsml_student_record');       
			else:
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'reg_batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
//                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'net_id'=>$this->input->post('net_id'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'applicant_mob_no1'=>$this->input->post('applicant_mob_no1'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>1,
                'student_password'=>$password,
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/edsml_student_academic_records/'.$id);
            endif;
            endif;
            $this->data['page_title']   = 'Add EDSML Student | ECMS';
            $this->data['title']        = 'Add EDSML Student';
            $this->data['page']         = 'admission/edsml/form/add_edsml_student_record';
            $this->load->view('common/common',$this->data);
        }
    public function edsml_student_academic_records($id){		
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
        redirect('admin/edsml_student_academic_records/'.$this->input->post('student_id'));
        
        else:
        $data = array(	
                'student_id'=>$this->input->post('student_id'),
                'degree_id'=>$this->input->post('degree_id'),
                'inst_id'=>$this->input->post('inst_id'),
                'bu_id'=>$this->input->post('bu_id'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'total_marks'=>$this->input->post('total_marks'),
                'obtained_marks'=>$this->input->post('obtained_marks'),
                'year_of_passing'=>$this->input->post('year_of_passing'),
                'percentage'=>$percent,
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/edsml_student_academic_records/'.$this->input->post('student_id'));
            
            endif;
            endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'Select degree ', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'Select Board  ', 'bu_id', 'title');
			$this->data['grade']  = $this->CRUDModel->dropDown('grade', ' Select Grade ', 'grade_id', 'grade_name');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            
            $this->data['page_title']   = 'Student Academic Record (EDSML) | ECMS';
            $this->data['title']        = 'Student Academic Record EDSML';
            $this->data['page']         = 'admission/edsml/form/add_edsml_academic_record';
            $this->load->view('common/common',$this->data);
	}
    public function update_edsml_student_record(){	
        $uri        = $this->uri->segment(3);
        $session    = $this->session->all_userdata();
        $user_id    = $session['userData']['user_id'];

        $prodata['result'] = $this->get_model->studentData($uri);
        if($this->input->post()){
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $admission_date = $_POST['admission_date']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($admission_date));
            $data_post = array
            (
                'batch_id'=>$_POST['batch_id'],
                'programe_id'=>$_POST['programe_id'],
                'sub_pro_id'=>$_POST['sub_pro_id'],
                'form_no'=>$_POST['form_no'],
                'rseats_id'=>$_POST['rseats_id'],
                'comment'=>$_POST['comment'],
                'college_no'=>$_POST['college_no'],
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'student_cnic'=>$_POST['student_cnic'],
                'gender_id'=>$_POST['gender_id'],
                'marital_id'=>$_POST['marital_id'],
                'dob'=>$date1,
                'place_of_birth'=>$_POST['place_of_birth'],
                'bg_id'=>$_POST['bg_id'],
                'country_id'=>$_POST['country_id'],
                'domicile_id'=>$_POST['domicile_id'],
                'district_id'=>$_POST['district_id'],
                'religion_id'=>$_POST['religion_id'],
//                'hostel_required'=>$_POST['hostel_required'],
                'father_name'=>$father,
                'father_cnic'=>$_POST['father_cnic'],
                'land_line_no'=>$_POST['land_line_no'],
                'mobile_no'=>$_POST['mobile_no'],
                'mobile_no2'=>$_POST['mobile_no2'],
                'applicant_mob_no1'=>$_POST['applicant_mob_no1'],
                'applicant_mob_no2'=>$_POST['applicant_mob_no2'],
                'occ_id'=>$_POST['occ_id'],
                'annual_income'=>$_POST['annual_income'],
                'app_postal_address'=>$_POST['app_postal_address'],
                'parmanent_address'=>$_POST['parmanent_address'],
                'last_school_address'=>$_POST['last_school_address'],
                'father_email'=>$_POST['father_email'],
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$_POST['guardian_cnic'],
                'relation_with_guardian'=>$_POST['relation_with_guardian'],
                'guardian_occupation'=>$_POST['guardian_occupation'],
                'g_annual_income'=>$_POST['g_annual_income'],
                'g_land_no'=>$_POST['g_land_no'],
                'g_mobile_no'=>$_POST['g_mobile_no'],
                'g_postal_address'=>$_POST['g_postal_address'],
                'g_email'=>$_POST['g_email'],
                'physical_status_id'=>$_POST['physical_status_id'],
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$_POST['e_person_relation'],
                'e_person_contact1'=>$_POST['e_person_contact1'],
                'e_person_contact2'=>$_POST['e_person_contact2'],
                's_status_id'=>$_POST['s_status_id'],
                'bank_receipt_no'=>$_POST['bank_receipt_no'],
                'admission_date'=>$date2,
                'admission_comment'=>$_POST['admission_comment'],
                'updated_by_user'=>$user_id,
                'updated_datetime'=>$current_datetime,
            );
            $this->get_model->updatestudent($data_post,$uri);
            $batch_id = $this->input->post('batch_id');
			$programe_id = $this->input->post('programe_id');
			$sub_pro_id = $this->input->post('sub_pro_id');
			$student_name = $this->input->post('student_name');
			$form_no = $this->input->post('form_no');
			$college_no = $this->input->post('college_no');
			$rseats_id = $this->input->post('rseats_id');
			$domicile_id = $this->input->post('domicile_id');
			$mobile_no = $this->input->post('mobile_no');
			$mobile_no2 = $this->input->post('mobile_no2');
            $old_programe_id = $this->input->post('old_programe_id');
            $old_sub_pro_id = $this->input->post('old_sub_pro_id');
            $old_batch_id = $this->input->post('old_batch_id');
            $old_domicile_id = $this->input->post('old_domicile_id');
            $old_student_name = $this->input->post('old_student_name');
            $old_form_no = $this->input->post('old_form_no');
            $old_college_no = $this->input->post('old_college_no');
            $old_rseats_id = $this->input->post('old_rseats_id');
            $old_mobile_no = $this->input->post('old_mobile_no');
            $old_mobile_no2 = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
			if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && 
			$old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
            redirect('StudentRecordEDSML');
			else:
            $data_log = array
			(
			   'student_id'=>$uri,
			   'batch_id'=>$old_b,
			   'programe_id'=>$old_p,
			   'sub_pro_id'=>$old_sp,
			   'form_no'=>$old_f,
			   'college_no'=>$old_c,
			   'rseats_id'=>$old_r,
			   'student_name'=>$old_sn,
			   'domicile_id'=>$old_dm,
			   'mobile_no'=>$old_m,
			   'mobile_no2'=>$old_mb,
               'date'=>date('Y-m-d'),
			   'timestamp'=>date('Y-m-d H:i:'),
			   'user_id'=>$user_id
			);
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('StudentRecordEDSML');
			endif;
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/edsml/form/update_edsml_student_record", $prodata);
       $this->load->view("common/footer");
	}   
    public function update_edsml_academic_student_record($id){
         
        $this->load->model('get_model');
        $prodata['result'] = $this->get_model->academicData($id);
        if($_POST){
            $TotMarks = $_POST['total_marks'];
            $ObtMarks = $_POST['obtained_marks'];
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array
            (
                'degree_id'=>$_POST['degree_id'],
                'inst_id'=>$_POST['inst_id'],
                'bu_id'=>$_POST['bu_id'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'total_marks'=>$_POST['total_marks'],
                'obtained_marks'=>$_POST['obtained_marks'],
                'year_of_passing'=>$_POST['year_of_passing'],
                'cgpa'=>$_POST['cgpa'],
                'grade_id'=>$_POST['grade_id'],
                'percentage'=>$percent,
                'exam_type'=>$_POST['exam_type']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('StudentRecordEDSML');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/edsml/form/update_edsml_academic_student_record", $prodata);
       $this->load->view("common/footer");
		
    }
    
    public function student_group_chart_inter(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['page']     =   "admission/student_group_chart_inter"; 
        $this->data['title']    =   'Student Group| ECMS';
        $this->load->view('common/common',$this->data);       
        
    }
    
    public function student_group_chart_alevel(){
        
//        $session = $this->session->all_userdata();
//        $user_id =$session['userData']['user_id'];
        
        $this->data['page']         =   "admission/Alevel/Forms/student_group_chart_alevel"; 
        $this->data['title']        =   'Student Group| ECMS';
        $this->data['PageHeader']   =   'Student Group Alevel';
        $this->load->view('common/common',$this->data);       
        
    }
    
    public function student_group_chart_bscs(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['page']     =   "admission/student_group_chart_bscs"; 
        $this->data['title']    =   'Student Group| ECMS';
        $this->load->view('common/common',$this->data);       
        
    }
    
    public function student_group_chart_bseng(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['page']     =   "admission/student_group_chart_bseng"; 
        $this->data['title']    =   'Student Group| ECMS';
        $this->load->view('common/common',$this->data);       
        
    }
    
    public function student_group_chart_econ(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['page']     =   "admission/student_group_chart_econ"; 
        $this->data['title']    =   'Student Group| ECMS';
        $this->load->view('common/common',$this->data);       
        
    }
    
    public function student_group_chart_bslaw(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['page']     =   "admission/student_group_chart_bslaw"; 
        $this->data['title']    =   'Student Group| ECMS';
        $this->load->view('common/common',$this->data);       
        
    }
    
    public function student_group_chart_hnd(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['page']     =   "admission/student_group_chart_hnd"; 
        $this->data['title']    =   'Student Group| ECMS';
        $this->load->view('common/common',$this->data);       
        
    }
    
    public function student_group_chart_political(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['page']     =   "admission/student_group_chart_political_science"; 
        $this->data['title']    =   'Student Group| ECMS';
        $this->load->view('common/common',$this->data);       
        
    }
    
    
}

 