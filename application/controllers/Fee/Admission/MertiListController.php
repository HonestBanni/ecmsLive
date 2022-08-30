<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class   FeeAdmissionSetupController extends AdminController {
	function __construct()
	{
            parent::__construct();
            $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
	}

 
    public function student_group_chart_political(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $this->data['page']     =   "admission/student_group_chart_political_science"; 
        $this->data['title']    =   'Student Group| ECMS';
        $this->load->view('common/common',$this->data);       
        
    }
    
    
}

 