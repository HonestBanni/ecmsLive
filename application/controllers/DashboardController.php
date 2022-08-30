<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
 

class DashboardController extends AdminController {

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
//             $this->load->model('ActivitesModel');
             $this->load->library("pagination");
             
        }
	public function index()
	{

            $data['page']  = "admin/Dashboard";
            $data['title'] = 'Admin';
            $this->load->view('templatesadm/template', $data);
	}
       
        
        public function societiesAdmin(){
            
            $whereSoc               = array('soc_status'=>'1');
            //pagination start
            $config['base_url']         = base_url('societiesAdmin');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('societies',$whereSoc));  //echo $config['total_rows']; exit;
            $config['per_page']         = 5;
            $config["num_links"]        = 3;
            $config['uri_segment']      = 2;
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
            $page                       = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['links']        = $this->pagination->create_links();
            //pagination start 

            $this->data['societies']    = $this->CRUDModel->pagination('societies',$config['per_page'], $page); //get user data from db
            $this->data['page']         = "admin/activities/showSocieties";
            $this->data['title']        = 'Societies Admin | ECP';
            $this->load->view('templatesadm/template',$this->data); 
        }
        

        
      
}
