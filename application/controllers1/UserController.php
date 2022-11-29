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
        }
	 
        public function index(){
            
            $this->data['page_header']  = 'Payroll Management System (ECP)';
            $this->data['page_title']   = 'Payroll Management System | ECP';
            
            $this->load->view('common/headerlogin',$this->data);
            $this->load->view('user/login',$this->data);
        }
     public function logout(){
            
            $session = $this->session->all_userdata();
            if(!empty($session)){
                $this->session->unset_userdata($this->config->config['session_name']);
                redirect('Login');
            }else{
                redirect('Login');
            }
        }
     public function login_authentication(){
              
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
                    $userData[$this->config->config['session_name']] = 
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
                      
                            redirect('Dashboard');
                          
                    }else{
                        $this->session->set_flashdata('message', 'User Name or Password is not valid');
                        print_r($this->session->flashdata('message'));
                        redirect('Login');
                    }
                    
                }
            }else{
                
                redirect('Login');
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
}
