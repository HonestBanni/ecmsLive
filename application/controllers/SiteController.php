<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'core/PublicController.php');
require_once(APPPATH.'core/MY_Controller.php');
 

class SiteController extends PublicController {

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
                $this->load->model('EdwardesModel');
                $this->load->model('ActivitesModel');
                $this->load->library("pagination");
             
        }
	public function index()
	{
            $where               = array('news_status'=>'1');
            //lastst news
            $custom['limit']     = 3;
            $custom['start']     = 0;
            $custom['column']    = 'news_id';
            $custom['order']     = 'desc';
            $this->data['activeNews']       = $this->CRUDModel->get_where_result_limit('news',$where,$custom); 
            
            $custom['limit']     = 200;
            $custom['start']     = 3;
            $custom['column']    = 'news_id';
            $custom['order']     = 'desc';
            $this->data['news']       = $this->CRUDModel->get_where_result_limit('news',$where,$custom); 
            
            //events
            $whereEvent = array('evt_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'evt_id';
            $custom['order']     = 'desc';
            $this->data['events']       = $this->CRUDModel->get_where_result_limit('events',$whereEvent,$custom); 
             
            //Qucik links
            $whereql = array('ql_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ql_id';
            $custom['order']     = 'desc';
            $this->data['quickLinks']       = $this->CRUDModel->get_where_result_limit('quicklinks',$whereql,$custom);
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            
            $this->data['title']        = 'Edwardes College Peshawar | ECP';
            $this->data['page']       =  'site/index';
            $this->load->view('common/common',$this->data);
            
             
	}
        
        public function events(){
            $where               = array('evt_status'=>'1');
            //pagination start
            $config['base_url']         = base_url('events');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('events',$where));  //echo $config['total_rows']; exit;
            $config['per_page']         = 2;
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
                       
            $this->data['events']    = $this->CRUDModel->pagination('events',$config['per_page'], $page,$where); //get user data from db
             
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Get jobs
            $where                      = array('news_status'=>'1');
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    ='news_id';
            $custom['order']     ='desc';
            $this->data['news']         =$this->CRUDModel->get_where_result_limit('news',$where,$custom);
            
            $this->data['title']        = 'events | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/events', $this->data);
            $this->load->view('common/footer'); 
        }
        public function event(){
            
            $eventId = $this->uri->segment(2);
            if($eventId):
                
                   //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Get jobs
            $where                      = array('news_status'=>'1');
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    ='news_id';
            $custom['order']     ='desc';
            $this->data['news']         =$this->CRUDModel->get_where_result_limit('news',$where,$custom);
                
                $whereVideo = array('evt_status'=>1,'evt_id'=>$eventId);
                $this->data['event']   = $this->CRUDModel->get_where_row('events',$whereVideo);
                
                 $this->data['title']        = $this->data['event']->evt_title.' | ECP';
                $this->load->view('common/header', $this->data);
                $this->load->view('common/nav');
                $this->load->view('site/event', $this->data);
                $this->load->view('common/footer'); 
            
            else:
                redirect('/');
            endif;
           
        }
        public function finincialAid(){
            $this->data['title']        = 'Finincial Aid and Scholarships | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/finincialAid', $this->data);
            $this->load->view('common/footer'); 
        }
        
        public function jobs(){
            
            $whereSoc               = array('job_status'=>'1');
            //pagination start
            $config['base_url']         = base_url('jobs');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('jobs',$whereSoc));  //echo $config['total_rows']; exit;
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
            $where = array('job_status'=>1);
            $order['column']    = 'job_id';
            $order['order']     = 'desc';
            
            $this->data['jobs']    = $this->CRUDModel->pagination('jobs',$config['per_page'], $page,$where,$order); //get user data from db
            
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/jobs', $this->data);
            $this->load->view('common/footer'); 
        }
        public function awards(){
            $this->data['title']        = 'awardes | ECP';
            $where = array('award_status'=>1);
            $this->data['awards']      = $this->CRUDModel->get_where_result('awards',$where);
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/awards', $this->data);
            $this->load->view('common/footer'); 
        }
        public function aboutEdwardes(){
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            $this->data['title']        = 'About | ECP';
            
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/about', $this->data);
            $this->load->view('common/footer'); 
        }
        public function whyEdwardes(){
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
          
            $this->data['title']        = 'Why Edwardes | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/whyEdwardes', $this->data);
            $this->load->view('common/footer'); 
        }
        public function aboutCampus(){
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);

            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);


            $this->data['title']        = 'About Campus | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/campus', $this->data);
            $this->load->view('common/footer'); 
        }
        public function BOGEdwardes(){
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            // news widget
            $where                      = array('news_status'=>'1');
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    ='news_id';
            $custom['order']     ='desc';
            $this->data['news']         =$this->CRUDModel->get_where_result_limit('news',$where,$custom);
            
            
            
            $whereSoc               = array('bog_status',1);
            //pagination start
            $config['base_url']         = base_url('BOG');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('bog',$whereSoc));  //echo $config['total_rows']; exit;
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
           
            $order['column']    = 'bog_order';
            $order['order']     = 'asc';
            
            $this->data['BOG']    = $this->CRUDModel->pagination('bog',$config['per_page'], $page,$whereSoc,$order); //get user data from db
            
//            
//            
//            $where = array('bog_status',1);
//            $custom['column'] = 'bog_order';
//            $custom['order']  = 'asc';  
//            $this->data['BOG']          =$this->CRUDModel->get_where_result_order('bog',$where,$custom);
//            
            
            
            $this->data['title']        = 'Board Of Governors | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/BOGEdwardes', $this->data);
            $this->load->view('common/footer'); 
        }
        public function missionVision(){
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);

            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            $this->data['title']        = 'Mission | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/missionVision', $this->data);
            $this->load->view('common/footer'); 
        }
        public function learning(){
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            
            
            
            $this->data['title']        = 'Learning | ECP';
            
            $this->data['title']        = 'Single | ECP';
            $this->data['page']       =  'site/learning';
            $this->load->view('common/common',$this->data);
            
            
//            $this->load->view('common/header', $this->data);
//            $this->load->view('common/nav');
//            $this->load->view('site/learning', $this->data);
//            $this->load->view('common/footer'); 
        }
        public function livingECP(){
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);

            $this->data['title']        = 'Living | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/livingECP', $this->data);
            $this->load->view('common/footer'); 
        }
        public function departments(){
            
             $whereSoc               = array('dep_status'=>'1');
            //pagination start
            $config['base_url']         = base_url('departments');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('departments',$whereSoc));  //echo $config['total_rows']; exit;
            $config['per_page']         = 10;
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
            $where = array('dep_status'=>1);
            $order['column']    = 'dep_id';
            $order['order']     = 'asc';
            
            $this->data['departments']    = $this->CRUDModel->pagination('departments',$config['per_page'], $page,$where,$order); //get user data from db
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            
            $this->data['title']        = 'Department & Faculty | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/teaching/departments', $this->data);
            $this->load->view('common/footer'); 
        }
        public function department(){
            $deptId = $this->uri->segment(2);
            $whereDwd = array('dep_status'=>1,'dep_id'=>$deptId);
            $this->data['department']   = $this->CRUDModel->get_where_row('departments',$whereDwd);
            
            $wherefly = array('fly_status'=>1,'deptId'=>$deptId);
            $custom['limit']     = 500;
            $custom['start']     = 0;
            $custom['column']    ='fly_order';
            $custom['order']     ='asc';
            $this->data['faculty']         =$this->CRUDModel->get_where_result_limit('faculty',$wherefly,$custom);
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            
            $this->data['title']        = $this->data['department']->dep_title.'| ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/teaching/department', $this->data);
            $this->load->view('common/footer'); 
        }
        public function financeDepertment(){
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Finance Depertment | ECP';
            $this->data['page']       =  'site/nonTeaching/financeDepartment';
            $this->load->view('common/common',$this->data);
             
        }
        public function ITDepertment(){
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'IT Depertment | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/nonTeaching/ITDepartment', $this->data);
            $this->load->view('common/footer'); 
        }        
        public function adminDepertment(){
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Admin Depertment | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/nonTeaching/adminDepartment', $this->data);
            $this->load->view('common/footer'); 
        }        
        
        public function estateDepertment(){
            
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Estate Depertment | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/nonTeaching/estateDepartment', $this->data);
            $this->load->view('common/footer'); 
        }        
        public function labStaff(){
             //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            
            $this->data['title']        = 'Lab Staff | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/nonTeaching/labStaff', $this->data);
            $this->load->view('common/footer'); 
        }        
        
        public function notifications(){
            $where                      = array('ql_status'=>1);
            //pagination start
            $config['base_url']         = base_url('notifications');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('quicklinks',$where));  //echo $config['total_rows']; exit;
            $config['per_page']         = 15;
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
            $this->data['quickLinks']    = $this->EdwardesModel->get_notifications('quicklinks',$config['per_page'], $page); //get user data from db
            
            
            $where = array('ql_status'=>1);
            //$this->data['quickLinks'] = $this->EdwardesModel->get_notifications('quicklinks',$where);
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['widget']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
            $this->data['title']        = 'Quick Links | ECP';
            $this->data['page']       =  'site/notifications';
            $this->load->view('common/common',$this->data);
            
           
        }
        public function notice(){
            
            $qlId = $this->uri->segment(2);
               //Video Link
                $whereVideo = array('video_status'=>1);
                $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);

                //Online Admission Link
                $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
                $this->data['widget']   = $this->CRUDModel->get_where_row('widget',$whereoa);
                
                $whereDwd = array('ql_status'=>1,'ql_id'=>$qlId);
                $this->data['quicklinks']   = $this->EdwardesModel->get_notice('quicklinks',$whereDwd);
                
                
                $this->data['title']        = $this->data['quicklinks']->ql_title.' | ECP';
                $this->data['page']       =  'site/notice';
                $this->load->view('common/common',$this->data);
                 
            
        }   
        public function news(){
            $where                      = array('news_status'=>'1');
            //pagination start
            $config['base_url']         = base_url('news');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('news',$where));  //echo $config['total_rows']; exit;
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
            $this->data['news']    = $this->CRUDModel->pagination('news',$config['per_page'], $page); //get user data from db
            
           
            //download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'News | ECP';
            $this->data['page']       =  'site/news';
            $this->load->view('common/common',$this->data);
             
        }
        public function newsSingle(){
             
            $newsID = $this->uri->segment(2);
            $where                      = array('news_status'=>'1','news_id'=>$newsID);
            $this->data['news'] = $this->CRUDModel->get_where_row('news',$where);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            
            //echo '<pre>';print_r($this->data['news']);die;
            $this->data['title']        = $this->data['news']->news_title.' | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/newsSingle', $this->data);
            $this->load->view('common/footer'); 
        }
        public function principal(){
            
            //Video Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            $this->data['title']        = 'Principal Message | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/principal', $this->data);
            $this->load->view('common/footer'); 
        }
        
        public function intermediate(){
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Intermediate Program | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/programes/intermediate', $this->data);
            $this->load->view('common/footer'); 
        }
        
        public function degree(){
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Degree Program | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/programes/degree', $this->data);
            $this->load->view('common/footer'); 
        }
        public function alevels(){
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'A Levels Program | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/programes/alevels', $this->data);
            $this->load->view('common/footer'); 
        }
        public function BSCS(){
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'BS in Computer Science | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/programes/BSCS', $this->data);
            $this->load->view('common/footer'); 
        }
        public function HND(){
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'HND Higher National Diploma | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/programes/HND', $this->data);
            $this->load->view('common/footer'); 
        }
        public function outline(){
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Course Outline | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/programes/courseOutLine', $this->data);
            $this->load->view('common/footer'); 
        }
        
        public function specialCourse(){
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Special Course | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/programes/specialCourse', $this->data);
            $this->load->view('common/footer'); 
        }
        public function financialRules(){
            
            //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            
            $this->data['title']        = 'Financial Rules | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/programes/financialRules', $this->data);
            $this->load->view('common/footer'); 
        }
        public function feeStructure(){
            
             //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Fee Structure | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/fee/feeStructure', $this->data);
            $this->load->view('common/footer'); 
        }
        public function feeRefunds(){
            
             //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Fee Refunds | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/fee/feeRefunds', $this->data);
            $this->load->view('common/footer'); 
        }
        public function collegePolicy(){
             //Download Link
            $whereDwd = array('dwd_status'=>1,'dwd_type'=>'prospectus');
            $this->data['download']   = $this->CRUDModel->get_where_row('download',$whereDwd);
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            
            $this->data['title']        = 'College Policy | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/programes/collegePolicy', $this->data);
            $this->load->view('common/footer'); 
        }
        
      
        
        Public function interPolicy(){
            
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            
            $this->data['title']        = 'Intermediate Admission Policy | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/admission/interPolicy', $this->data);
            $this->load->view('common/footer'); 
        }
        Public function alevelPolicy(){
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            $this->data['title']        = 'A Level Admission Policy | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/admission/alevelPolicy', $this->data);
            $this->load->view('common/footer'); 
        }
        Public function degreePolicy(){
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            $this->data['title']        = 'Degree Admission Policy | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/admission/degreePolicy', $this->data);
            $this->load->view('common/footer'); 
        }
        
        Public function BCSPolicy(){
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            $this->data['title']        = 'BCS Admission Policy | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/admission/BCSPolicy', $this->data);
            $this->load->view('common/footer'); 
        }
        Public function BTEC_HNDPlicy(){
            
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            $this->data['title']        = 'BTEC (HND), MBA Courses Policy | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/admission/BTEC_HNDPlicy', $this->data);
            $this->load->view('common/footer'); 
        }
        Public function generalPolicy(){
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            $this->data['title']        = 'General Admisssion Policy | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/admission/generalPolicy', $this->data);
            $this->load->view('common/footer'); 
        }
       
        
        public function meritListResult(){
             
             $fnumber =  $this->input->post('formNo');
             
             $where = array('form_no'=>$fnumber);
             $resutl = $this->CRUDModel->get_where_row('selected_students',$where);
             
//             echo  print_r($resutl);die;
             if($resutl){
               echo '<h3 class="has-divider text-highlight">Result </h3>
                            <div class="table-responsive">                      
                                    <table class="table table-boxed">
                                        <thead>
                                            <tr>
                                                <th>Form No</th>
                                                <th>Admission In</th>
                                                <th>Student Name</th>
                                                <th>Gender</th>
                                                <th>Father Name</th>
                                                <th>Total Marks</th>
                                                <th>Obtained Marks</th>
                                                <th>Percentage</th>
                                                <th>Applied Quota</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>'.$resutl->form_no.'</th>
                                                <th>'.$resutl->Admission_in.'</th>
                                                <th>'.$resutl->student_name.'</th>
                                                <th>'.$resutl->gender.'</th>
                                                <th>'.$resutl->father_name.'</th>
                                               
                                                <th>'.$resutl->total_marks.'</th>
                                                <th>'.$resutl->obtained_marks.'</th>
                                                <th>'.$resutl->percentage.'</th>
                                                <th>'.$resutl->applied_quota.'</th>    
                                                   
                                                <td><span class="label label-success result">'.$resutl->status.'</span></td>
                                                
                                            </tr>
                                            
                                           
                                        </tbody>
                                    </table><!--//table-->
                                    <blockquote class="highlight-border boxy ">
                                        <p><em>Short listed student: Admission will be given on the basis of interview marks</em></p>
                                        <p><em>Waiting student: Admission of students on a waiting list is depend on the availability of seats.</em></p>
                                        <small>Admission committee</small>
                                    </blockquote>
                                </div>';
             }else{
                 echo '<h3 class="has-divider text-highlight">Result </h3>
                     <div class="alert alert-danger">
                                            <strong>Oh !</strong> No result Found......
                                        </div>';
             }
        }
        public function meritListResult2016(){
             
             $fnumber =  $this->input->post('formNo');
             $program =  $this->input->post('program');
             
             $where = array('form_no'=>$fnumber);
             $resutl = $this->CRUDModel->get_where_row('selected_students',$where);
              
             if($resutl){
                 
                 echo '<button type="button" class="close" id="close" ><span aria-hidden="true" style=" padding-right: 10px;">×</span></button>
                        <h1 class="section-heading text-highlight"><span class="line">'.$resutl->student_name.'<br/>'.$resutl->father_name.'</span> <small>('.$resutl->Admission_in.')</small></h1>
                        <div class="section-content">
                        <div class="panel panel-theme ">
             
                       
                    <div class="table-responsive"> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>F/ No</th>
                                <th>T.Marks</th>
                                <th>O. Marks</th>
                                <th>%</th>
                                <th>A.Quota</th>
                                <th>Status</th>
                                 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>'.$resutl->form_no.'</td>
                                <td>'.$resutl->total_marks.'</td>
                                <td>'.$resutl->obtained_marks.'</td>
                                <td>'.$resutl->percentage.'%</td>
                                <td>'.$resutl->applied_quota.'</td>
                                <td><span class="label label-success result">'.$resutl->status.'</span></td>
                               
                            </tr>
                             
                        </tbody>
                    </table><!--//table-->
                </div><!--//table-responsive-->
                <br>
                      
<!--                            <a class="read-more" href="courses.html">View all our courses<i class="fa fa-chevron-right"></i></a>-->
                        </div><!--//section-content-->
                        <div class="paddingList">
                    <blockquote class="highlight-border boxy ">
                        <p><em>Short listed student: Admission will be given on the basis of interview marks</em></p>
                        <p><em>Waiting student: Admission of students on a waiting list is depend on the availability of seats.</em></p>
                        <small>Admission committee</small>
                    </blockquote>
                    </div>
                        </div>';
                }else{
                 echo '<div class="paddingList"><h3 class="has-divider text-highlight">Result </h3>
                     <div class="alert alert-danger">
                                            <strong>Oh !</strong> No result Found......
                                        </div></div>';
             }
        }
        public function meritListResults2016(){
             
             
             $student_name  =  $this->input->post('student_name');
             $std_fname     =  $this->input->post('std_fname');
             $program       =  $this->input->post('program');
             
             $where = array('student_name'=>$student_name,'father_name'=>$std_fname);
             $this->data['resutl2016'] = $this->CRUDModel->get_where_result_like('selected_students',$where);
              
            $this->data['title']        = 'Intermediat Merit List 2016 | ECP';
             $this->data['page']       =  'site/meritlist/intermediateMeritList';
            $this->load->view('common/common',$this->data);
      
        }
        Public function migrationPolicy(){
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
            //Stories links
            $whereql = array('ss_status'=>1);
            $custom['limit']     = 4;
            $custom['start']     = 0;
            $custom['column']    = 'ss_order';
            $custom['order']     = 'asc';
            $this->data['stories']       = $this->CRUDModel->get_where_result_limit('student_stories',$whereql,$custom);
            
            $this->data['title']        = 'Migration Policy | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/admission/migrationPolicy', $this->data);
            $this->load->view('common/footer'); 
        }
        public function meritList(){
              
            $this->data['title']        = 'Intermediate merit list 2016 | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/meritlist/intermediate', $this->data);
            $this->load->view('common/footer'); 
        }
        Public function Publication(){
        
            $whereSS               = array('pub_status'=>'1');
            //pagination start
            $config['base_url']         = base_url('publication');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('publication',$whereSS));  //echo $config['total_rows']; exit;
            $config['per_page']         = 2;
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
            $where = array('pub_status'=>1);
            $order['column']    = 'pub_id';
            $order['order']     = 'desc';
            
            $this->data['publication']    = $this->CRUDModel->pagination('publication',$config['per_page'], $page,$where,$order); //get user data from db
            
             //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            //Contact Link
            $whereCont = array('cont_status'=>1,'cont_type'=>'contact');
            $this->data['contact']   = $this->CRUDModel->get_where_row('contact_address',$whereCont);
            
            $this->data['title']        = 'Publication | ECP';
            $this->data['page']       =  'site/activities/publication';
            $this->load->view('common/common',$this->data);
             
        }
        Public function studentStories(){
            
            $whereSS               = array('ss_status'=>'1');
            //pagination start
            $config['base_url']         = base_url('stories');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_stories',$whereSS));  //echo $config['total_rows']; exit;
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
            $where = array('ss_status'=>1);
            $order['column']    = 'ss_order';
            $order['order']     = 'asc';
            
            $this->data['stories']    = $this->CRUDModel->pagination('student_stories',$config['per_page'], $page,$where,$order); //get user data from db
            
            
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
            
              //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            
            
            $this->data['title']        = 'Students Stories | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/activities/studentStories', $this->data);
            $this->load->view('common/footer'); 
        }
        Public function societies(){
            
           $whereSoc               = array('soc_status'=>'1');
            //pagination start
            $config['base_url']         = base_url('societies');
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
            
            //Online Admission Link
            $whereoa = array('widget_status'=>1,'widget_type'=>'onlineAdmission');
            $this->data['onlineAdmission']   = $this->CRUDModel->get_where_row('widget',$whereoa); 
          
             
            //Video Link
            $whereVideo = array('video_status'=>1);
            $this->data['videos']   = $this->CRUDModel->get_where_result('video_links',$whereVideo);
            $this->data['title']        = 'Students Societies | ECP';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('site/activities/societies', $this->data);
            $this->load->view('common/footer'); 
        }
        Public function gallery(){
            
            //Get Albums
            $where               = array('alb_status'=>'1');
            $custom['column']    ='alb_order';
            $custom['order']     ='asc';
            $this->data['albums']         =$this->CRUDModel->get_where_result_order('albums',$where,$custom);
            
            $this->data['title']        = 'Gallery | ECP';
            $this->data['page']       =  'site/activities/gallery';
            $this->load->view('common/common',$this->data);
            
        }
        Public function galleryType(){
            
            $galleryType = $this->uri->segment(2);
            $where                      = array('alb_status'=>'1','alb_id'=>$galleryType);
            $this->data['album']        = $this->CRUDModel->get_where_row('albums',$where);
            //Get Albums images
            $whereimg                   = array('albimg_status'=>'1','albimg_typeId'=>$galleryType);
            $custom['column']           = 'albimg_id';
            $custom['order']            = 'desc';
            $this->data['albumImages']  = $this->CRUDModel->get_where_result_order('album_images',$whereimg,$custom);
            
            $this->data['title']        = 'Sport Gallery | ECP';
            $this->data['page']         = 'site/activities/galleryType';
            $this->load->view('common/common',$this->data);
            
        }
        Public function library(){
            $this->data['title']        = 'Library| ECP';
            $this->data['page']       =  'site/facilities/collegeLibrary';
            $this->load->view('common/common',$this->data);
            
        }
        Public function laboratories(){
            $this->data['title']        = 'HEC Digital Laboratories | ECP';
            $this->data['page']       =  'site/facilities/laboratories';
            $this->load->view('common/common',$this->data);
            
        }
        Public function boardingHostel(){
            $this->data['title']        = 'Boarding and Hostel | ECP';
            $this->data['page']       =  'site/facilities/boardingHostel';
            $this->load->view('common/common',$this->data);
            
        }
        Public function womenCenter(){
            $this->data['title']        = 'Women Centre | ECP';
            $this->data['page']       =  'site/facilities/womenCenter';
            $this->load->view('common/common',$this->data);
            
        }
        Public function transport(){
            $this->data['title']        = 'Transport | ECP';
            $this->data['page']       =  'site/facilities/transport';
            $this->load->view('common/common',$this->data);
            
        }
        Public function Counseling(){
            $this->data['title']        = 'Counseling | ECP';
            $this->data['page']       =  'site/facilities/counseling';
            $this->load->view('common/common',$this->data);
            
        }
        Public function healthService(){
            $this->data['title']        = 'Health Service | ECP';
            $this->data['page']       =  'site/facilities/healthService';
            $this->load->view('common/common',$this->data);
            
        }
        Public function CCCLab(){
            $this->data['title']        = 'CCC-Central Lab| ECP';
            $this->data['page']       =  'site/facilities/CCCLab';
            $this->load->view('common/common',$this->data);
            
        }
        Public function greenShop(){
            $this->data['title']        = 'Green Shop| ECP';
            $this->data['page']       =  'site/facilities/greenShop';
            $this->load->view('common/common',$this->data);
            
        }
        Public function contact(){
            $this->data['title']        = 'Contact | ECP';
            $this->data['page']       =  'site/contact';
            $this->load->view('common/common',$this->data);
            
        }
        Public function contactInfo(){
            $this->data['title']        = 'Contact Information | ECP';
            $this->data['page']       =  'site/contactInfo';
            $this->load->view('common/common',$this->data);
            
        }
        Public function blogPost(){
            $this->data['title']        = 'Blog | ECP';
            $this->data['page']       =  'site/blog';
            $this->load->view('common/common',$this->data);
        }
        Public function blogSignle(){
            $this->data['title']        = 'Single | ECP';
            $this->data['page']       =  'site/blogSignle';
            $this->load->view('common/common',$this->data);
        }
     
        
}

