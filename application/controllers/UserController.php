<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/PublicController.php');
 

class UserController extends PublicController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
        public function __construct() {
             parent::__construct();
                $this->load->model('CRUDModel');
             
        }
	public function inde3x()
	{
               $session = $this->session->all_userdata();
     
                if(!empty($session['userData']['loginStatus'])){
                   redirect('Admin/admin_home');
                }
            
            $this->load->view('user/login');
	}
           public function index(){
        
            $session = $this->session->all_userdata();
     
                if(!empty($session['userData']['loginStatus'])){
                   redirect('Admin/admin_home');
                }
            
           
            $this->data['page_header']  = 'Edwardes College Management System (ECMS)';
            $this->data['page_title']   = 'Edwardes College Management System  | ECMS';
            
            $this->load->view('common/headerlogin',$this->data);
            $this->load->view('user/login',$this->data);

//            $this->load->view('common/footer',$this->data);
             
    }
    
    public function student_login()
	{
           
        $this->load->view('user/student_login');
	}
    
    public function proctor_login()
	{
           
        $this->load->view('user/proctor_login');
	}
        
         public function loginAuthentication(){
              
            if($this->input->post()){
                $userEmail      = $this->input->post('useremail');
                $userPassword   = $this->input->post('password');
                $userinputs     = array(
                    'email'     => $userEmail,
                    'password'  => $userPassword
                        );
                
            //Clear by XSS security 
                $data = $this->security->xss_clean($userinputs);
                
                if($data){
                  
                    $where = array(
                        'email'         => $userEmail,
                        'password'      => md5($userPassword),
                        'user_status'   => 1
                    );
                  
                    
                    $result_set = $this->CRUDModel->get_where_row('users',$where);
                    $emp = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$result_set->user_empId,'emp_status_id'=>1));
                    if(($emp)){
                    $userData['userData'] = 
                              array(    'user_id'       => $result_set->id,
                                        'Email'         => $result_set->email,
                                        'emp_id'         => $result_set->user_empId,
                                        'user_roleId'   => $result_set->user_roleId,
                                        'loginStatus'   => TRUE,
                                        'is_logged_in'  =>1
                                    );
                    //
                    
                    $id = $this->input->ip_address();
                    $data = array(
                      'employee_id'=>$result_set->user_empId,  
                      'login_user_id'=>$result_set->id,  
                      'ip_address'=>$id,  
                      'login_date_time'=>date('Y-m-d H:i:s'),  
                    );
                    $this->CRUDModel->insert('employee_login_details',$data);
                    $this->session->set_userdata($userData);
                      
                            redirect('Admin/admin_home');
                          
                    }else{
                        $this->session->set_flashdata('message', 'User Name or Password is not valid');
                        print_r($this->session->flashdata('message'));
                        redirect('/');
                    }
                    
                }
            }else{
                
                redirect('/');
            }
   
        }
    
         public function proctorAuthentication(){
              
            if($this->input->post()){
                $college_no = $this->input->post('college_no');
                $Password = $this->input->post('password');
                $inputs = array(
                    'college_no' =>$college_no,
                    'student_password'   =>$Password
                        );
                $data = $this->security->xss_clean($inputs);
                if($data){
                    $where = array(
                        'college_no' =>$college_no,
                        'student_password'=>$Password,
                        's_status_id'  => 5,
                        'student_type'=>2,
                        'login_status' => 1
                    );
        $result_set = $this->CRUDModel->get_where_row('student_record',$where);
                    if(($result_set)){
                    $studentData['studentData'] = 
                              array(    'student_id'       => $result_set->student_id,
                                        'student_name'     => $result_set->student_name,
                                        'loginStatus'   => TRUE,
                                        'is_logged_in'  =>1
                                    );
                       // echo '<pre>';print_r($studentData);die;
                       $this->session->set_userdata($studentData);
                            redirect('StudentController/proctor_home');
                          
                    }else{
                        $this->session->set_flashdata('message', 'User Email or Password is not valid <br/> Contact to Database Administrator.');
                        //print_r($this->session->flashdata('message'));die;
                        redirect('proctor');
                    }
                    
                }
            }else
            {
                
                redirect('/');
            }
   
        }
    
    public function proctor_logout(){
            
            $session = $this->session->all_userdata();
            if(!empty($session)){
                $this->session->unset_userdata('userData');
                redirect('proctor');
            }else{
                redirect('proctor');
            }
        }
    
         public function studentloginAuthentication(){
              
            if($this->input->post()){
                $college_no = $this->input->post('college_no');
                $Password = $this->input->post('password');
                $inputs = array(
                    'college_no' =>$college_no,
                    'student_password'   =>$Password
                        );
                $data = $this->security->xss_clean($inputs);
                if($data){
                    $where = array(
                        'college_no' =>$college_no,
                        'student_password'=>$Password,
                        's_status_id'  => 5,
                        'student_type'=>1,
                        'login_status' => 1
                    );
        $result_set = $this->CRUDModel->get_where_row('student_record',$where);
                    if(($result_set)){
                    $studentData['studentData'] = 
                              array(    'student_id'       => $result_set->student_id,
                                        'student_name'     => $result_set->student_name,
                                        'loginStatus'   => TRUE,
                                        'is_logged_in'  =>1
                                    );
                       // echo '<pre>';print_r($studentData);die;
                       $this->session->set_userdata($studentData);
                            redirect('StudentController/student_home');
                          
                    }else{
                        $this->session->set_flashdata('message', 'User Email or Password is not valid <br/> Contact to Database Administrator.');
                        //print_r($this->session->flashdata('message'));die;
                        redirect('p-portal');
                    }
                    
                }
            }else
            {
                redirect('/');
            }
   
        }
    
         public function loginAuthenticationNew(){
           if($this->input->post()){
                $userEmail = $this->input->post('useremail');
                $userPassword = $this->input->post('password');
                $userinputs = array(
                    'userName' =>$userEmail,
                    'password' =>$userPassword
                        );
            //Clear by XSS security 
                $data = $this->security->xss_clean($userinputs);
                if($data){
                    $where = array(
                        'userEmail'     =>$userEmail,
                        'userPassword'  => $userPassword
                    );
                    
                    
                    $result_set = $this->CRUDModel->get_where_row('user',$where);
                    
                   
                    if(($result_set)){
                        
                    $dbPassword = $result_set->userPassword; 
                    $decodePassword =  $this->encrypt->decode($dbPassword);
 
                    if($dbPassword == $decodePassword){
                            
                      $userData['userData'] = 
                              array(    'user_id'       => $result_set->userId,
                                        'FirstName'     => $result_set->firstName,
                                        'Email'         => $result_set->userEmail,
                                        'loginStatus'   => TRUE
                                    );
                       $this->session->set_userdata($userData);
                            redirect('Dashboard');
                        }else{
                        $this->session->set_flashdata('message', 'User password is not correct');
                        //print_r($this->session->flashdata('item'));die;
                        redirect('login');  
                    } 
                        
                    
                        
                    }else{
                        $this->session->set_flashdata('message', 'User Email not exist...');
                        //print_r($this->session->flashdata('item'));die;
                        redirect('login');
                    }
                    
                }
            }else{
                
                redirect('/');
            }
   
        }
        public function logout(){
            
            $session = $this->session->all_userdata();
            if(!empty($session)){
                $this->session->unset_userdata('userData');
                redirect('login');
            }else{
                redirect('login');
            }
        }
    
        public function student_logout(){
            
            $session = $this->session->all_userdata();
            if(!empty($session)){
                $this->session->unset_userdata('userData');
                redirect('p-portal');
            }else{
                redirect('p-portal');
            }
        }
        
        public function encryptKey(){
             
        $str = '12345';
        $key = 'wUwDPglyJu9LOnkBAf4vxSpQgQZltcz7LWwEquhdm5kSQIkQlZtfxtSTsmawq6gVH8SimlC3W6TDOhhL2FdgvdIC7sDv7G1Z7pCNzFLp0lgB9ACm8r5RZOBiN5ske9cBVjlVfgmQ9VpFzSwzLLODhCU7/2THg2iDrW3NGQZfz3SSWviwCe7GmNIvp5jEkGPCGcla4Fgdp/xuyewPk6NDlBewftLtHJVf=PAb3';
            $encrypted = $this->encrypt->encode($str, $key);

            echo $this->encrypt->decode($encrypted, $key);
  
        }
        
        
    public function backup(){
       $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
        
        $this->load->dbutil();
        $db_format=array('format'=>'zip','filename'=>'ecms.sql');
        $backup=$this->dbutil->backup($db_format);
        $dbname='backup-on-'.date('Y-m-d').'.zip';
        $save=base_url('d:/'.$dbname);
        write_file($save,$backup);
        force_download($dbname,$backup);
       
} 
 public function enroller_bs_students(){
      $where = array(
          's_status_id'=>'5',
      );
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->where_in('programes_info.degree_type_id',array(2,4));
      $result = $this->db->get_where('student_record',$where)->result();
     
      $this->json_output($result);
 
}


function json_output($response)
	{
		$ci =& get_instance();
		$ci->output->set_content_type('application/json');
//		$ci->output->set_status_header($statusHeader);
		$ci->output->set_output(json_encode($response));
	}
}
