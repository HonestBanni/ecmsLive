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
                $this->load->library("pagination");
                $this->load->model("AttendanceModel");
                
	}

	/**************Admin Login Starts******************/
	public function index()
	{
		$this->admin_home();
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
	/*****************Main Home Page Ends*********************/
	
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
   
        
     public function add_Message()
    {	  	
        if($this->input->post()):
            $details     = $this->input->post('details');
            $data       = array(
                'details' =>$details
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
    
    public function update_message()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
              $details =$this->input->post('details');
              $status =$this->input->post('status');
              $message_id =$this->input->post('message_id');
              $data = array(
                      'details'=>$details,
                      'status'=>$status
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
        $this->data['result']       = $this->CRUDModel->getResults('board_university');
        $this->data['page_title']   = 'Board University | ECP';
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
            $this->data['page_title']   = 'Board University | ECP';
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

            $this->data['page_title']        = 'Updae board University | ECP';
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
       $this->data['result']       = $this->CRUDModel->getResults('institute');
       $this->data['page_title']   = 'All Institutes | ECP';
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
            $this->data['page_title']   = 'All Institutes | ECP';
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
       $this->data['result']       = $this->CRUDModel->getResults('district');
       $this->data['page_title']   = 'All Districts | ECP';
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
            $this->data['page_title']   = 'All Districts | ECP';
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
       $this->data['result']       = $this->CRUDModel->getResults('domicile');
       $this->data['page_title']   = 'All Domiciles | ECP';
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
            $this->data['page_title']   = 'All Domiciles | ECP';
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
       $this->data['page_title']   = 'All Countries | ECP';
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
            $this->data['page_title']   = 'All Countries | ECP';
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
       $this->data['result']       = $this->CRUDModel->getResults('degree');
       $this->data['page_title']   = 'All Degrees | ECP';
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
            $this->data['page_title']   = 'All degrees | ECP';
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
       $this->data['page_title']   = 'All Degree Types | ECP';
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
            $this->data['page_title']   = 'All degree Types | ECP';
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
       $this->data['page_title']   = 'All Relations | ECP';
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
            $this->data['page_title']   = 'All Relations | ECP';
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
       $this->data['page_title']   = 'All Occupations | ECP';
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
            $this->data['page_title']   = 'All Occupations | ECP';
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
       $this->data['page_title']   = 'All Programs | ECP';
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
            $this->data['page_title']   = 'All Programs | ECP';
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
        
//       $this->data['result']       = $this->CRUDModel->getResults('sub_programes');
       $this->data['result'] = $this->db->order_by('name','asc')->order_by('programe_id','asc')->get("sub_programes")->result();
       $this->data['page_title']   = 'All Sub Programs | ECP';
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
            $this->data['page_title']   = 'All Sub Programs | ECP';
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
       $this->data['page_title']   = 'All Physical Statuses| ECP';
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
            $this->data['page_title']   = 'All Physical Status | ECP';
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

                $this->data['page_title']        = 'Update Student By Group | ECP';
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
       $this->data['page_title']   = 'All Religions| ECP';
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
            $this->data['page_title']   = 'All Religions | ECP';
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
    
    public function section()
    {
       $this->data['result']       = $this->get_model->getsection();
       $this->data['page_title']   = 'All Sections| ECP';
       $this->data['page']         = 'admission/section';
       $this->load->view('common/common',$this->data); 
    }
    
    public function groups()
    {
            $this->data['sections']    = $this->CRUDModel->dropDown('sections', 'Select Section', 'sec_id', 'name');
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
           $this->data['page_title']   = 'All Groups | ECP';
           $this->data['page']         = 'admission/groups';
           $this->load->view('common/common',$this->data);    
      // $this->data['result']       = $this->get_model->getgroups();
    }
    
    public function search_by_group_student(){
        $this->data['sections']    = $this->CRUDModel->dropDown('sections', 'Select Section ', 'sec_id', 'name');
       
        if($this->input->post('search')):
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
                $this->data['title']        = 'Student List | ECP';
        
                 
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
                $this->data['page_title']   = 'Asign Group to Student| ECP';
                $this->data['page']         =  'admission/adding_student_by_group';
                $this->load->view('common/common',$this->data);
        else:
            redirect('/');
            endif;
    }
    
    public function update_student_by_group()
    {
        $id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $data = array(
                'section_id'=>$this->input->post('section_id'),
                'up_user_id'=>$user_id
            );
              $where = array('serial_no'=>$id);
              $this->CRUDModel->update('student_group_allotment',$data,$where);
              redirect('admin/groups'); 
              endif;
            if($id):
                $where = array('student_group_allotment.serial_no'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('student_group_allotment',$where);

                $this->data['page_title']        = 'Update Student By Group | ECP';
                $this->data['page']        =  'admission/update_student_by_group';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
//    
//     public function update_degreestudent_by_group(){
//        $id         = $this->uri->segment(3);
//        $session    = $this->session->all_userdata();
//        $user_id    =$session['userData']['user_id'];
//        if($this->input->post()):
//            
//            $student_id = $this->input->post('student_id');
//        
//            $data       = array(
//            'section_id'    =>$this->input->post('section_id'),
//            'up_user_id'   =>$user_id
//            );
//              $where    = array('serial_no'=>$id);
//              $this->CRUDModel->update('student_group_allotment',$data,$where);
//              
////              $student_group_allotment = $this->CRUDModel->get_where_result('student_group_allotment',array('student_id'=>$student_id));
////              echo '<pre>';print_r($student_group_allotment);
//              
//                $whereUpDate = array('section_id'=>$this->input->post('section_id'));
//                $UpDate = array('student_id'=>$student_id);
//                
////                echo '<pre>';print_r($whereUpDate);
////                echo '<pre>';print_r($UpDate);
////                die;
//                $this->CRUDModel->update('student_group_allotment',$UpDate,$whereUpDate);
//                
//              redirect('admin/degree_students'); 
//              endif;
//            if($id):
//                $where = array('student_group_allotment.serial_no'=>$id);
//                $this->data['result'] = $this->CRUDModel->get_where_row('student_group_allotment',$where);
//
//                $this->data['page_title']        = 'Update Degree Student By Group | ECMS';
//                $this->data['page']        =  'admission/update_degreestudent_by_group';
//                $this->load->view('common/common',$this->data);
//            else:
//            redirect('/');
//            endif;
//    }  
     
    public function update_degreestudent_by_group(){
        $id         = $this->uri->segment(3);
        $session    = $this->session->all_userdata();
        $user_id    =$session['userData']['user_id'];
        if($this->input->post()):
            
            $student_id = $this->input->post('student_id');
        
            $data       = array(
            'section_id'    =>$this->input->post('section_id'),
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
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
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
           $this->data['page_title']   = 'All Student Records | ECP';
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
            $this->data['page_title']   = 'All Sections | ECP';
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
       $this->data['page_title']   = 'All Reserved Seats| ECP';
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
            $this->data['page_title']   = 'All Reserved Seats | ECP';
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
       $this->data['page_title']   = 'All Reserved Seats Detail| ECP';
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
            $this->data['page_title']   = 'All Reserved Seats Detail | ECP';
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
       $this->data['result']       = $this->CRUDModel->getResults('prospectus_batch');
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
            $data       = array(
                'batch_name' =>$batch_name,
                'prospectus_amount' =>$prospectus_amount,
                'status'=>$status,
                'date_of_issuance'=>$date_of_issuance,
                'programe_id'=>$programe_id
            );
            $this->CRUDModel->insert('prospectus_batch',$data);
            $this->data['page_title']   = 'All Batch Prospectuses | ECP';
            $this->data['page']         = 'admission/prospectus_batch';
            $this->load->view('common/common',$this->data);
            redirect('admin/prospectus_batch');
          else:
              redirect('/');
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
       $this->data['page_title']   = 'All Prospectus Sales| ECP';
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
            $this->data['page_title']   = 'All Prospectus Sales | ECP';
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
       $this->data['page_title']   = 'All Subjects| ECP';
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
            $this->data['page_title']   = 'All Subjects | ECP';
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
       $this->data['page_title']   = 'All Shifts| ECP';
       $this->data['page']         = 'admission/shift';
       $this->load->view('common/common',$this->data);  
    }
    
    public function s_status()
    {
       $this->data['result']       = $this->get_model->gets_status();
       $this->data['page_title']   = 'All Student Status| ECP';
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
            $this->data['page_title']   = 'All Student Status | ECP';
            $this->data['page']         = 'admission/student_status';
            $this->load->view('common/common',$this->data);
            redirect('admin/student_status');
          else:
              redirect('/');
        endif;
	}
    
    public function student_record()
    {       
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
            $where                          = array('        student_record.programe_id'=>'1');
           // $where               = array('s_status_id'=>'5');
            //pagination start
            $config['base_url']         = base_url('admin/student_record');
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
            $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Student Records | ECP';
           $this->data['page']         = 'admission/student_record';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function all_student_record()
    {       
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
            $config['base_url']         = base_url('Admin/all_student_record');
            $config['total_rows']       = count($this->CRUDModel->getResults('student_record'));  
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
           $this->data['page_title']   = 'All Students Record | ECP';
           $this->data['page']         = 'admission/all_student_record';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function adding_picture()
    {       
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
            $config['base_url']         = base_url('Admin/adding_picture');
            $config['total_rows']       = count($this->CRUDModel->getResults('student_record'));  
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
           $this->data['page_title']   = 'Adding Pictures | ECP';
           $this->data['page']         = 'admission/adding_picture';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function a_level_student_record()
    {       
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
            $where               = array('student_record.programe_id'=>'5');
            $config['base_url']         = base_url('admin/a_level_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 20;
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
            $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where,$custom);
          //  $this->data['result']    = $this->CRUDModel->pagination('student_record',$config['per_page'], $page,$where,$custom);
           $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All A-Level Students | ECP';
           $this->data['page']         = 'admission/a_level_student_record';
           $this->load->view('common/common',$this->data);
       
    }
  
    
    public function eng_medical_students()
    {       
            $this->data['limit'] = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
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
           $this->data['page_title']   = 'All Engineering/Medical Students | ECP';
           $this->data['page']         = 'admission/eng_medical_student_record';
           $this->load->view('common/common',$this->data); 
    }
    
    public function degree_students()
    {       
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
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
           $this->data['page_title']   = 'All Degree Students | ECP';
           $this->data['page']         = 'admission/degreestudent_record';
           $this->load->view('common/common',$this->data); 
    }
    
//    public function student_assign_subjects()
//    {
//        $id                         = $this->uri->segment(3);
//        $sub_pro_id                 = $this->uri->segment(4);
//        $where                      = array('student_id'=>$id);
//        $subpro_where               = array('sub_pro_id'=>$sub_pro_id);
//        $this->data['result']       = $this->CRUDModel->get_where_row('student_record', $where);
//        $this->data['subjects']     = $this->CRUDModel->get_where_result('subject', $subpro_where);
//        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
//     
//        $this->data['page_title']   = 'Student Assign Subjects | ECP';
//       $this->data['page']          = 'admission/student_assign_subjects';
//       $this->load->view('common/common',$this->data);
//    }
        public function student_assign_subjects(){
        $id                         = $this->uri->segment(3);
        $sub_pro_id                 = $this->uri->segment(4);
        $where                      = array('student_id'=>$id);
        $subpro_where               = array('sub_pro_id'=>$sub_pro_id);
        $this->data['result']       = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['subjects']     = $this->CRUDModel->get_where_result('subject', $subpro_where);
       
         $this->data['sectionsName']    = $this->CRUDModel->dropDown('sections', 'Select section ', 'sec_id', 'name',array('program_id'=>1));


        //        $this->data['sections']     = $this->CRUDModel->get_where_result('sections',array('program_id'=>1));
        
        
        $this->data['section'] = $this->CRUDModel->get_where_row('student_group_allotment', $where);
        $this->data['sectionsId'] = '';
        if($this->data['section']):
            $this->data['sectionsId'] =$this->data['section']->section_id; 
            endif;
     
        $this->data['page_title']   = 'Student Assign Subjects | ECP';
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
        $this->data['page_title']   = 'Eng/Med Student Assign Subjects | ECP';
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
        
        $this->data['page_title']   = 'Student Assign Subjects | ECP';
       $this->data['page']         = 'admission/student_updassign_subjects';
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
        $this->data['page_title']   = 'Update Student Assign Subjects | ECP';
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
//        $this->data['page_title']   = 'Update Degree Student Assigned Subjects | ECP';
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
        $this->data['page_title']   = 'Update Degree Student Assigned Subjects | ECP';
       $this->data['page']         = 'admission/degree_std_updassign_subjects';
       $this->load->view('common/common',$this->data);
    }
    public function hnd_student_record()
    {       
            $where               = array('student_record.programe_id'=>'3');
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
            $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where,$custom);
           // $this->data['result']    = $this->CRUDModel->pagination('student_record',$config['per_page'], $page,$where,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Student Records | ECP';
           $this->data['page']         = 'admission/student_hnd_record';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function cs_student_record()
    {       
            $where               = array('student_record.programe_id'=>'2');
            //pagination start
            $config['base_url']         = base_url('admin/cs_student_record');
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
            $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where,$custom);
           // $this->data['result']    = $this->CRUDModel->pagination('student_record',$config['per_page'], $page,$where,$custom);
           $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All CS Student Records | ECP';
           $this->data['page']         = 'admission/cs_student_record';
           $this->load->view('common/common',$this->data);
       
    }
    
    public function student_group()
    {
            $session = $this->session->all_userdata();
            $user_id =$session['userData']['user_id'];
             $this->data['sub_program']    = $this->CRUDModel->dropDown('sub_programes', 'Select Sub Program ', 'sub_pro_id', 'name');
             $this->data['program']    = $this->CRUDModel->dropDown('programes_info', 'Select Program ', 'programe_id', 'programe_name');
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', 'Select Gender ', 'gender_id', 'title');
        $this->data['batch']    = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch ', 'batch_id', 'batch_name');
        $this->data['section']    = $this->CRUDModel->dropDown('sections', 'Select Section ', 'sec_id', 'name');
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
                       'user_id'=>$user_id
                 ));
            endforeach;
            endif;
        
            $this->data['page']     =   "admission/student_group";
            $this->data['title']    =   'Student Group| ECMS';
            $this->load->view('common/common',$this->data);        
        
    }
    
    
    public function assigning_subject()
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
//         echo 'test';
//                echo '<pre>';print_r($getId);die;
//            
        
         endif;
        redirect('admin/arts_students');
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
    
    public function updateassigning_subject()
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
            redirect('admin/arts_students');
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
           // $where['student_record.s_status_id'] = 5;
        
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
        
                $this->data['result']   = $this->get_model->get_stdData('student_record',$where,$like,$custom);    
                $this->data['page']     = "admission/search_student_record";
                $this->data['title']    = 'Student List | ECP';
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
                $filename='StudentList2016.xls'; 
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
                $this->data['title']    = 'Student List | ECP';
                $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function admin_search_student()
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
                $this->data['page']     = "admission/admin_search_student_record";
                $this->data['title']    = 'Student List | ECP';
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

                $this->data['college_no'] = '';
                $this->data['form_no'] = '';
                $this->data['student_name'] = '';
                $this->data['father_name']  = '';
                $this->data['gender_id']  = '';
                $this->data['sub_pro_id']  = '';
                $this->data['programe_id']  = '';
                $this->data['rseats_id']  = '';
                $this->data['limitId']  = '';

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
        $this->data['page_title']   = 'All Arts Students | ECP';
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
                $this->data['title']    = 'Arts Student List | ECP';
                $this->load->view('common/common',$this->data);
        endif;
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
                $this->data['title']    = 'Student List | ECP';
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
//                $this->data['title']    = 'Arts Student List | ECP';
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
                $this->data['title']    = 'Eng/Medical Student List | ECP';
                $this->load->view('common/common',$this->data);
        endif;
     }
    
    public function search_a_level_student()
    {
        $whereSub_pro = array('programe_id'=>5);
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
            
            $where['student_record.programe_id'] = 5;
        
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
        
                $this->data['result']   = $this->get_model->get_stdData('student_record',$where,$like,$custom);    
                $this->data['page']     = "admission/search_a_level_student";
                $this->data['title']    = 'Student List | ECP';
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
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
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
            $this->data['limitId']  = '';
            
            $where['student_record.programe_id'] = 5;
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
    
    public function search_hnd_student()
    {
        $whereSub_pro = array('programe_id'=>3);
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
        
                $this->data['result']   = $this->get_model->get_hndstdData('student_record',$where,$like,$custom);
            
                $this->data['page']     = "admission/search_hnd_student";
                $this->data['title']    = 'HND Student List 2016 | ECP';
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

        $whereSub_pro = array('programe_id'=>2);
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
            
            $where['student_record.programe_id'] = 2;
        
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
        
                $this->data['result']   = $this->get_model->get_csstdData('student_record',$where,$like,$custom);
            $this->data['page']     = "admission/cs_search_student_record";
            $this->data['title']    = 'Student List 2016 | ECP';
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
            
            $where['student_record.programe_id'] = 2;
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
            $this->data['title']    = 'Degree Students List | ECP';
            $this->load->view('common/common',$this->data);
            endif;
    }
    
    public function search_degree_student()
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
        
            $this->data['result']   = $this->get_model->get_degreestdData('student_record',$where,$like,$custom);
            $this->data['page']     = "admission/search_degree_student";
            $this->data['title']    = 'Students List | ECP';
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
    
    public function add_student_record()
	{	
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime = date('Y-m-d H:i:s');
            $dob = $_POST['dob']; 
            $date1 = date('Y-m-d', strtotime($dob));
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
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
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id
            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/student_academic_record/'.$id);
          else:
            $this->data['page_title']   = 'Add New Student (Inter Level) | ECP';
            $this->data['page']         = 'admission/add_student_record';
            $this->load->view('common/common',$this->data);
        endif;
	}
    
    public function add_admin_student_record()
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
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id
            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/admin_student_academic_record/'.$id);
          else:
            $this->data['page_title']   = 'Add New Student | ECP';
            $this->data['page']         = 'admission/add_admin_student_record';
            $this->load->view('common/common',$this->data);
        endif;
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
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
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
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id
            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/student_a_level_academic/'.$id);
          else:
            $this->data['page_title']   = 'Add New Student (Inter Level) | ECP';
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
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'â†? Select degree  â†’', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'â†? Select Board  â†’', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students | ECP';
            $this->data['page']         = 'admission/academic_record';
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
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'â†? Select degree  â†’', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'â†? Select Board  â†’', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students | ECP';
            $this->data['page']         = 'admission/admin_academic_record';
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
                'exam_type'=>$this->input->post('exam_type'),
                'inserteduser'=>$user_id
            );
            $this->CRUDModel->insert('applicant_edu_detail',$data);
            redirect('admin/student_a_level_academic/'.$this->input->post('student_id'));
        
        endif;
        endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'â†? Select degree  â†’', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'â†? Select Board  â†’', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students | ECP';
            $this->data['page']         = 'admission/student_a_level_academic';
            $this->load->view('common/common',$this->data);
    }

    public function add_cs_student()
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
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id     
				);
                $id = $this->CRUDModel->insert('student_record',$data);
                redirect('admin/cs_student_academic_record/'.$id);
                else:
                $this->data['page_title']   = 'Add New BS(CS) Student | ECP';
                $this->data['page']         = 'admission/add_cs_student_record';
                $this->load->view('common/common',$this->data);
                endif;
	}
    
    public function cs_student_academic_record($id)
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
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'â†? Select degree  â†’', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'â†? Select Board  â†’', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students BS(CS) | ECP';
            $this->data['page']         = 'admission/cs_academic_record';
            $this->load->view('common/common',$this->data);
	}

    public function add_hnd_student()
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
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('student_record',$data);
            redirect('admin/hnd_student_academic_record/'.$id);
            else:
            $this->data['page_title']   = 'Add New HND Student | ECP';
            $this->data['page']         = 'admission/add_hnd_student';
            $this->load->view('common/common',$this->data);
            endif;
	}
    
    public function hnd_student_academic_record($id)
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
                'percentage'=>$percent,
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
            $this->data['page_title']   = 'Academic Record of Students (HND) | ECP';
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
        redirect('admin/student_record');	
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
   
    	public function update_student()
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
                'comment'=>$this->input->post('comment'),
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
            );     
            $this->get_model->updatestudent($data_post,$uri);
             $old_programe_id = $this->input->post('old_programe_id');
             $old_sub_pro_id = $this->input->post('old_sub_pro_id');
             $old_batch_id = $this->input->post('old_batch_id');
             $old_student_name = $this->input->post('old_student_name');
             $old_form_no = $this->input->post('old_form_no');
             $old_college_no = $this->input->post('old_college_no');
             $old_rseats_id = $this->input->post('old_rseats_id');
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
                   'student_name'=>$old_student_name,
                   'mobile_no'=>$old_mobile_no,
                   'mobile_no2'=>$old_mobile_no2,
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
            redirect('admin/student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_student_record", $prodata);
       $this->load->view("common/footer");
	}
    
    public function admin_update_student()
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
            $old_programe_id = $this->input->post('old_programe_id');
             $old_sub_pro_id = $this->input->post('old_sub_pro_id');
             $old_batch_id = $this->input->post('old_batch_id');
             $old_student_name = $this->input->post('old_student_name');
             $old_form_no = $this->input->post('old_form_no');
             $old_college_no = $this->input->post('old_college_no');
             $old_rseats_id = $this->input->post('old_rseats_id');
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
                   'student_name'=>$old_student_name,
                   'mobile_no'=>$old_mobile_no,
                   'mobile_no2'=>$old_mobile_no2,
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
            redirect('admin/all_student_record');
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
            $old_programe_id = $this->input->post('old_programe_id');
             $old_sub_pro_id = $this->input->post('old_sub_pro_id');
             $old_batch_id = $this->input->post('old_batch_id');
             $old_student_name = $this->input->post('old_student_name');
             $old_form_no = $this->input->post('old_form_no');
             $old_college_no = $this->input->post('old_college_no');
             $old_rseats_id = $this->input->post('old_rseats_id');
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
                   'student_name'=>$old_student_name,
                   'mobile_no'=>$old_mobile_no,
                   'mobile_no2'=>$old_mobile_no2,
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
            redirect('admin/a_level_student_record');
        }
       $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_a_level_student", $prodata);
       $this->load->view("common/footer");
	}
    
    	public function update_hnd_student()
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
            $old_programe_id = $this->input->post('old_programe_id');
             $old_sub_pro_id = $this->input->post('old_sub_pro_id');
             $old_batch_id = $this->input->post('old_batch_id');
             $old_student_name = $this->input->post('old_student_name');
             $old_form_no = $this->input->post('old_form_no');
             $old_college_no = $this->input->post('old_college_no');
             $old_rseats_id = $this->input->post('old_rseats_id');
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
                   'student_name'=>$old_student_name,
                   'mobile_no'=>$old_mobile_no,
                   'mobile_no2'=>$old_mobile_no2,
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
            redirect('admin/hnd_student_record');
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
                'exam_type'=>$_POST['exam_type']
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('admin/hnd_student_record');
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
            $data = array('applicant_image'=>$file_name);
            $where = array('student_id'=>$id); 
            $this->CRUDModel->update('student_record',$data,$where);
            redirect('admin/student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload Student Picture | ECP';
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
            $data = array('applicant_image'=>$file_name);
            $where = array('student_id'=>$id); 
            $this->CRUDModel->update('student_record',$data,$where);
            redirect('admin/a_level_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload A Level Student Picture | ECP';
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
            $data = array('applicant_image'=>$file_name);
            $where = array('student_id'=>$id); 
            $this->CRUDModel->update('student_record',$data,$where);
            redirect('admin/cs_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload BCS Student Picture | ECP';
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
            $data = array('applicant_image'=>$file_name);
            $where = array('student_id'=>$id); 
            $this->CRUDModel->update('student_record',$data,$where);
            redirect('admin/hnd_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload HND Student Picture | ECP';
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
            $data = array('applicant_image'=>$file_name);
            $where = array('student_id'=>$id); 
            $this->CRUDModel->update('student_record',$data,$where);
            redirect('admin/degree_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Upload Degree Student Picture | ECP';
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
            $data = array('applicant_image'=>$file_name);
            $where = array('student_id'=>$id); 
            $this->CRUDModel->update('student_record',$data,$where);
            redirect('admin/all_student_record'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);

            $this->data['page_title']        = 'Admin Upload Student Picture | ECP';
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

            $this->data['page_title']        = 'Upload Student Picture | ECP';
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
    
    public function student_profile($id)
	{	
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $where = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->get_model->profileStudent($where);
        $this->data['student_records'] =$this->get_model->student_edu_record($where);
        $this->data['page_title']   = 'Student Profile  | ECP';
        $this->data['page']         = 'admission/student_profile';
        $this->load->view('common/common',$this->data);
	}
    
    public function admin_student_profile($id)
	{	
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $where = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->get_model->profileStudent($where);
        $this->data['student_records'] =$this->get_model->student_edu_record($where);
        $this->data['page_title']   = 'Student Profile  | ECP';
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
        $this->data['page_title']   = 'Student Profile  | ECP';
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
        $this->data['page_title']   = 'Student Profile  | ECP';
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
                'batch_name'=>$_POST['batch_name'],
                'prospectus_amount'=>$_POST['prospectus_amount'],
                'status'=>$_POST['status'],
                'date_of_issuance'=>$_POST['date_of_issuance'],
                'programe_id'=>$_POST['programe_id']
            );
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
            $where               = array('student_record.programe_id'=>'4');
            //pagination start
            $config['base_url']         = base_url('admin/degree_student_record');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            //echo $config['total_rows']; exit;
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
            $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where,$custom);           
           $this->data['count']     =$config['total_rows'];
           $this->data['page_title']   = 'All Students Record(Degree Level)| ECP';
           $this->data['page']         = 'admission/degree_student_record';
           $this->load->view('common/common',$this->data);
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
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
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
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>$current_datetime,
                'user_id'=>$user_id     
				);
                $id = $this->CRUDModel->insert('student_record',$data);
                redirect('admin/degree_student_academic_record/'.$id);
                else:
                $this->data['page_title']   = 'Add New Degree Student | ECP';
                $this->data['page']         = 'admission/add_degree_student';
                $this->load->view('common/common',$this->data);
                endif;
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
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'â†? Select degree  â†’', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'â†? Select Board  â†’', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Degree Academic Record of Student | ECP';
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
            $old_programe_id = $this->input->post('old_programe_id');
             $old_sub_pro_id = $this->input->post('old_sub_pro_id');
             $old_batch_id = $this->input->post('old_batch_id');
             $old_student_name = $this->input->post('old_student_name');
             $old_form_no = $this->input->post('old_form_no');
             $old_college_no = $this->input->post('old_college_no');
             $old_rseats_id = $this->input->post('old_rseats_id');
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
                   'student_name'=>$old_student_name,
                   'mobile_no'=>$old_mobile_no,
                   'mobile_no2'=>$old_mobile_no2,
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
            redirect('admin/degree_student_record');
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
        $this->data['page_title']   = 'Student Profile  | ECP';
        $this->data['page']         = 'admission/cs_student_profile';
        $this->load->view('common/common',$this->data); 
	}
    
    	public function cs_update_student()
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
            $old_programe_id = $this->input->post('old_programe_id');
             $old_sub_pro_id = $this->input->post('old_sub_pro_id');
             $old_batch_id = $this->input->post('old_batch_id');
             $old_student_name = $this->input->post('old_student_name');
             $old_form_no = $this->input->post('old_form_no');
             $old_college_no = $this->input->post('old_college_no');
             $old_rseats_id = $this->input->post('old_rseats_id');
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
                   'student_name'=>$old_student_name,
                   'mobile_no'=>$old_mobile_no,
                   'mobile_no2'=>$old_mobile_no2,
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
            redirect('admin/cs_student_record');
        }
        $this->load->view("common/header");
       $this->load->view("common/nav");
       $this->load->view("admission/update_cs_student", $prodata);
       $this->load->view("common/footer");
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
        $this->data['page_title']   = 'Student Profile  | ECP';
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
        $wheresSec                      = array('status'=>'On','program_id'=>1);
        $this->data['sections']         = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id', 'name',$wheresSec);  
        $wheresSub                      = array('subject.programe_id'=>1);
        $this->data['subject']          = $this->AttendanceModel->dropDown_yearHead('subject', 'subject', 'subject_id', 'title',$wheresSub);  
        $this->data['page_title']       = 'Year Head Subjects | ECMS';
        $this->data['page']             =  'attendance/year_head_subjects';
        $this->load->view('common/common',$this->data); 
    }
    public function get_session_name(){
        
        $subProId =  $this->input->post('subProId');
        
      $result = $this->CRUDModel->get_where_result('sections',array('sub_pro_id'=>$subProId));
      
      foreach($result as $subRow):
          echo '<option value="'.$subRow->sec_id.'">'.$subRow->name.'</option>';
      endforeach;
    }
    
    public function green_file()
    {       
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $config['base_url']         = base_url('Admin/green_file');
            $config['total_rows']       = count($this->CRUDModel->getResults('student_record'));  
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
           $this->data['page_title']   = 'Students Green File| ECP';
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
                'dob'=>$this->input->post('dob'),
                'sports_id'=>$this->input->post('sports_id'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'mobile_no'=>$this->input->post('mobile_no'),
                'mobile_no2'=>$this->input->post('mobile_no2'),
                'hostel_required'=>$_POST['hostel_required'],
                'char_id'=>$_POST['char_id'],
                'admission_date'=>$_POST['admission_date'],
                'certificate_issue_date'=>$this->input->post('certificate_issue_date'),
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
            $config['base_url']         = base_url('Admin/student_change_status');
            $config['total_rows']       = count($this->CRUDModel->getResults('student_record'));  
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
    
    public function update_studentstatus()
	{
        $student_id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student_id   = $this->input->post('student_id');
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
           $data_post = array
            (
                'student_id'=>$student_id,
                's_status_id'=>$s_status_id,
                'date'=>$date1,
                'comment'=>$admission_comment,
                'timestamp'=>$date,
                'user_id'=>$user_id
            );
        $this->CRUDModel->insert('student_status_detail',$data_post);
        redirect('admin/student_change_status');
        endif;
        if($student_id):
            $where = array('student_record.student_id'=>$student_id);
            $this->data['result'] = $this->get_model->get_student_statusdata('student_record',$where);
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
        $where1 = array('student_record.student_id'=>$student_id);    
        $this->data['result'] = $this->get_model->profileStudent($where);
        $this->data['log'] = $this->get_model->get_log($where);
        $this->data['student_records'] = $this->get_model->student_edu_record($where1);
        $this->data['student_record_logs'] = $this->get_model->get_edu_log($where);
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
            $where['student_record.batch_id'] = 19;
        
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
           $where = array('student_record.batch_id'=>'19','student_record.programe_id'=>'1');
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
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):	
            $student = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $current_datetime = date('Y-m-d H:i:s');
			$this->load->helper('string');
            $password = random_string('alnum',6);
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
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$this->input->post('form_no'),
                'rseats_id'=>$this->input->post('rseats_id'),
                'rseats_id1'=>$this->input->post('rseats_id1'),
                'rseats_id2'=>$this->input->post('rseats_id'),
                'comment'=>$this->input->post('comment'),
                'fata_school'=>$_POST['fata_school'],
                'student_name'=>$student,
                'gender_id'=>$this->input->post('gender_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'mobile_no'=>$this->input->post('mobile_no'),
                'occ_id'=>$this->input->post('occ_id'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'last_school_address'=>$this->input->post('last_school_address'),
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
	
	   public function new_student_profile($id)
	{	
        $id = $this->uri->segment(3);
        $this->data['student_id'] = $id;
        $where = array('student_record.student_id'=>$id);
        $this->data['result']       = $this->get_model->profileStudent($where);
        $this->data['student_records'] =$this->get_model->student_edu_record($where);
        $this->data['page_title']   = 'Student Profile  | ECP';
        $this->data['page']         = 'admission/new_student_profile';
        $this->load->view('common/common',$this->data);
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
                'hostel_applied'=>$this->input->post('hostel_applied'),
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
                   'student_name'=>$old_student_name,
                   'mobile_no'=>$old_mobile_no,
                   'mobile_no2'=>$old_mobile_no2,
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
            $old_student_id = $this->input->post('old_student_id');
            $data_log = array
                (
                   'student_id'=>$old_student_id,
                    'edu_id'=>$id,
                   'obtained_marks'=>$old_obtained_marks,
                   'total_marks'=>$old_total_marks,
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
	
	public function new_student_academic_record($id)
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
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'â†? Select degree  â†’', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'â†? Select Board  â†’', 'bu_id', 'title');
            $where = array('applicant_edu_detail.student_id'=>$this->uri->segment(3));
            $this->data['student_records'] =$this->get_model->student_edu_record($where);
            $this->data['page_title']   = 'Academic Record of Students | ECP';
            $this->data['page']         = 'admission/new_student_academic_record';
            $this->load->view('common/common',$this->data);
    }
	
	//public function new_upload_sphoto()
   // {
    //    $id = $this->uri->segment(3);
    //    if($this->input->post()):
     //       $image = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
     //       $file_name = $image['file_name'];
     //       $data = array('applicant_image'=>$file_name);
     //       $where = array('student_id'=>$id); 
     //       $this->CRUDModel->update('student_record',$data,$where);
     //       redirect('admin/new_student_record'); 
     //   endif;
    //    if($id):
     //       $where = array('student_id'=>$id);
     //       $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
//
     //       $this->data['page_title']        = 'Upload Student Picture | ECMS';
     //       $this->data['page']        =  'admission/new_upload_sphoto';
      //      $this->load->view('common/common',$this->data);
     //   else:
     //   redirect('/');
     //   endif;
   // }
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
        else:
        redirect('/');
        endif;
    }
   
	public function student_group_inter()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('save_students')):   
           $form_Code  = $this->input->post('form_Code');
           $sec_id  = $this->input->post('sec_id');
            $where = array(
            'user_id'=>$user_id,
            'form_Code'=>$form_Code,
            'date' => date('Y-m-d')    
        ); 
       $res =  $this->CRUDModel->get_where_result('student_group_allotment_demo', $where);
       foreach($res as $isRow):
        $data = array(   
            'student_id' =>$isRow->student_id,
            'section_id'      =>$sec_id,
            'form_Code'     =>$isRow->form_Code,
            'date'          =>$isRow->date,
            'user_id'       =>$isRow->user_id,
          );
        $this->CRUDModel->insert('student_group_allotment',$data);
        
           $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('student_group_allotment_demo',$whereDelete);
        endforeach; 
            redirect('admin/student_group_inter');
            endif;
            $this->data['page']     =   "admission/student_group_inter";
            $this->data['title']    =   'Student Group Inter Level| ECMS';
            $this->load->view('common/common',$this->data);        
        
    }
	
	public function view_student_group()
	{
		$id = $this->uri->segment(3);
		$where = array('sections.sec_id'=>$id);
		$this->data['result']  = $this->get_model->view_student_group('student_group_allotment',$where);
		$this->data['page']     =   "admission/view_student_group";
        $this->data['title']    =   'Student Group Inter Level| ECMS';
        $this->load->view('common/common',$this->data);
		
		if($this->input->post('export')):    
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
				
				$this->excel->getActiveSheet()->setCellValue('H1', 'Total Marks');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
				
				$this->excel->getActiveSheet()->setCellValue('I1', 'Obtained Marks');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
				
				$this->excel->getActiveSheet()->setCellValue('J1', 'Percentage');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
       for($col = ord('A'); $col <= ord('J'); $col++)
       {
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
			$where = array('sections.sec_id'=>$id);
            $this->db->SELECT('
            student_record.form_no as form_no,
            student_record.student_name as student,
            student_record.father_name as father,
            student_record.college_no as college_no,
            sub_programes.name as sub_program,
            sections.name as section,
            gender.title as gender,
			applicant_edu_detail.total_marks,
			applicant_edu_detail.obtained_marks,
			applicant_edu_detail.percentage
            ');
            $this->db->FROM('student_group_allotment');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
			$this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->where($where);
			$this->db->group_by('student_record.student_id');
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
         endif; 
	}	
	
	public function students_assign_group()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student_id   = $this->input->post('student_id');
            $form_Code  = $this->input->post('form_Code');
            $checked = array(
                'student_id' => $student_id,
				);
        $qry = $this->CRUDModel->get_where_row('student_group_allotment',$checked);
        $msg ='';
        $msg1 ='';
         $qrydemo = $this->CRUDModel->get_where_row('student_group_allotment_demo',$checked);
        if($qry):
         $msg = '<p style="color:red">Sorry! Section has been Assigned to this Student. <p/>';
        elseif($qrydemo):
        $msg1 = '<p style="color:red">Sorry! This Student Already Exist in List..<p/>'; 
        else:
            $data       = array(
                'student_id' => $student_id,
                'form_Code' =>$form_Code,
                'date' => date('Y-m-d'),
                'user_id' => $user_id
            );
    $this->CRUDModel->insert('student_group_allotment_demo',$data);
        endif;  
    $result = $this->get_model->getstudent_assign_group();
        if($result):
        echo $msg.$msg1;
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
                                <td><a href="javascript:void(0)" id="'.$eRow->serial_no.'" class="delete_assignStudent"><i class="fa fa-trash"></i></a></td>                          
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
    
}
