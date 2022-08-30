<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class HrController extends AdminController {

     public function __construct() {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('HrModel');
             $this->load->library("pagination");     
        }
    
    public function get_by_id($table,$id){
    $query = $this->db->select('*')
            ->from($table)
            ->where($id)
            ->get();
      return $query->result();
    }
    
     public function bank()
    {       
        $this->data['result']       = $this->HrModel->getbank();
        $this->data['page_title']   = 'Banks | ECP';
        $this->data['page']         = 'hr/bank';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_research_paper()
    {
       $id = $this->uri->segment(3);
        if($this->input->post()):
            $author = $this->input->post('author');
            $title = $this->input->post('title');
            $journal = $this->input->post('journal');
            $volume = $this->input->post('volume');
            $pages = $this->input->post('pages');
            $date = $this->input->post('date');
            $date1 = date('Y-m-d', strtotime($date));
            $issn = $this->input->post('issn');
            $remarks = $this->input->post('remarks');
            $year = $this->input->post('year');
            $data = array(
                'author'=>$author,
                'title'=>$title,
                'journal'=>$journal,
                'volume'=>$volume,
                'pages'=>$pages,
                'date'=>$date1,
                'year'=>$year,
                'issn'=>$issn,
                'remarks'=>$remarks
            );
            $where = array('rp_id'=>$id); 
            $this->CRUDModel->update('hr_research_paper',$data,$where);
              redirect('HrController/employee_reocrd'); 
           endif;
        if($id):
            $where = array('rp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_research_paper',$where);

            $this->data['page_title']        = 'Update Research Paper | ECMS';
            $this->data['page']        =  'hr/update_research_paper';
            $this->load->view('common/common',$this->data);
        endif; 
    }
    
    public function view_research_paper()
    {
       $id = $this->uri->segment(3);
       if($id):
            $where = array('rp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_research_paper',$where);
            $this->data['page_title']        = 'View Research Paper | ECMS';
            $this->data['page']        =  'hr/view_research_paper';
            $this->load->view('common/common',$this->data);
        endif; 
    }
    
    public function update_professional_edu()
    {
       $id = $this->uri->segment(3);
        if($this->input->post()):
            $title = $this->input->post('title');
            $aff_institute = $this->input->post('aff_institute');
            $country_id = $this->input->post('country_id');
            $date = $this->input->post('date');
            $date1 = date('Y-m-d', strtotime($date));
            $remarks = $this->input->post('remarks');
            $duration = $this->input->post('duration');
            $data = array(
                'emp_id'=>$id,
                'title'=>$title,
                'aff_institute'=>$aff_institute,
                'country_id'=>$country_id,
                'date'=>$date1,
                'duration'=>$duration,
                'remarks'=>$remarks
            );
            $where = array('fe_id'=>$id); 
            $this->CRUDModel->update('hr_professional_edu',$data,$where);
              redirect('HrController/employee_reocrd'); 
           endif;
        if($id):
            $where = array('fe_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_professional_edu',$where);

            $this->data['page_title']        = 'Update Professional Education | ECMS';
            $this->data['page']        =  'hr/update_professional_edu';
            $this->load->view('common/common',$this->data);
        endif; 
    }
    
    public function view_professional_edu()
    {
       $id = $this->uri->segment(3);
       if($id):
            $where = array('fe_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_professional_edu',$where);
            $this->data['page_title']        = 'View Professional Education | ECMS';
            $this->data['page']        =  'hr/view_professional_edu';
            $this->load->view('common/common',$this->data);
        endif; 
    }
    
    public function delete_professional_edu()
    {	    
        $id    = $this->uri->segment(3);
        $where = array('fe_id'=>$id);
        $this->CRUDModel->deleteid('hr_professional_edu',$where);
        redirect('HrController/employee_reocrd');
	}
    
    public function delete_research_paper()
    {	    
        $id    = $this->uri->segment(3);
        $where = array('rp_id'=>$id);
        $this->CRUDModel->deleteid('hr_research_paper',$where);
        redirect('HrController/employee_reocrd');
	}
    
    public function add_research_paper()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $author = $this->input->post('author');
            $title = $this->input->post('title');
            $journal = $this->input->post('journal');
            $volume = $this->input->post('volume');
            $pages = $this->input->post('pages');
            $date = $this->input->post('date');
            $date1 = date('Y-m-d', strtotime($date));
            $issn = $this->input->post('issn');
            $remarks = $this->input->post('remarks');
            $year = $this->input->post('year');
            $data = array(
                'emp_id'=>$id,
                'author'=>$author,
                'title'=>$title,
                'journal'=>$journal,
                'volume'=>$volume,
                'pages'=>$pages,
                'date'=>$date1,
                'year'=>$year,
                'issn'=>$issn,
                'remarks'=>$remarks
            );
            $this->CRUDModel->insert('hr_research_paper',$data);
            redirect('HrController/add_research_paper/'.$id); 
        endif;
        if($id):
            $where = array('emp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_record',$where);
            $this->data['research'] = $this->CRUDModel->get_where_result('hr_research_paper',$where);
            $this->data['page_title']        = 'Add Research Paper | ECMS';
            $this->data['page']        =  'hr/add_research_paper';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function add_professional_education()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $title = $this->input->post('title');
            $aff_institute = $this->input->post('aff_institute');
            $country_id = $this->input->post('country_id');
            $date = $this->input->post('date');
            $date1 = date('Y-m-d', strtotime($date));
            $remarks = $this->input->post('remarks');
            $duration = $this->input->post('duration');
            $data = array(
                'emp_id'=>$id,
                'title'=>$title,
                'aff_institute'=>$aff_institute,
                'country_id'=>$country_id,
                'date'=>$date1,
                'duration'=>$duration,
                'remarks'=>$remarks
            );
            $this->CRUDModel->insert('hr_professional_edu',$data);
            redirect('HrController/add_professional_education/'.$id); 
        endif;
        if($id):
            $where = array('emp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_record',$where);
            $this->data['professionl_edu'] = $this->CRUDModel->get_where_result('hr_professional_edu',$where);
            $this->data['page_title']        = 'Add Professional Education | ECMS';
            $this->data['page']        =  'hr/add_professional_education';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function t_employee_report()
    {
       $this->data['category']    = $this->CRUDModel->dropDown('hr_emp_category', 'Staff Category', 'cat_id', 'title');
        $this->data['contract'] = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Select Type', 'contract_type_id', 'title');       
        
        $this->data['emp_status_id']  = '';
        $this->data['cat_id']  = '';
        $this->data['contract_type_id']  = '';
        
        if($this->input->post('search')):
        $emp_status_id    =  $this->input->post('emp_status_id');
        $cat_id      =  $this->input->post('cat_id');
        $contract_type_id =  $this->input->post('contract_type_id');
        //like Array
        $like = '';
        $where = '';
            
        if(!empty($emp_status_id)):
            $where['hr_emp_record.emp_status_id'] = $emp_status_id;
            $this->data['emp_status_id']  = $emp_status_id;
        endif;
        if(!empty($contract_type_id)):
            $where['hr_emp_record.contract_type_id'] = $contract_type_id;
            $this->data['contract_type_id']  = $contract_type_id;
        endif;
        if(!empty($cat_id)):
            $where['hr_emp_record.cat_id'] = $cat_id;
            $this->data['cat_id']  = $cat_id;
        endif;                                     	
        $this->data['cat'] = $this->CRUDModel->get_where_row('hr_emp_category', array('cat_id'=>$cat_id));  
        $this->data['cont'] = $this->CRUDModel->get_where_row('hr_emp_contract_type', array('contract_type_id'=>$contract_type_id));                                                     
        $this->data['result'] = $this->HrModel->getTEmployee('hr_emp_record',$where);  
        endif;
       $this->data['page_title']   = 'Teaching Staff | ECMS';
       $this->data['page']         = 'hr/t_employee_record';
       $this->load->view('common/common',$this->data);  
    }
    
    public function nt_employee_report()
    {
       $where = array('emp_status_id'=>1,'cat_id'=>2);
       $this->data['result']=$this->HrModel->getTEmployee('hr_emp_record',$where);
       $this->data['page_title']   = 'Non Teaching Staff | ECMS';
       $this->data['page']         = 'hr/nt_employee_record';
       $this->load->view('common/common',$this->data);  
    }
    
    public function add_bank()
    {	  	
        if($this->input->post()):
            $name           = $this->input->post('name');
            $account_no     = $this->input->post('account_no');
            $branch_code      = $this->input->post('branch_code');
            $address      = $this->input->post('address');
            $comment      = $this->input->post('comment');
            $data       = array(
                'name'      =>$name,
                'branch_code' =>$branch_code,
                'account_no' =>$account_no,
                'address' =>$address,
                'comment' =>$comment
            );
            $this->CRUDModel->insert('bank',$data);
            $this->data['page_title']   = 'Banks | ECP';
            $this->data['page']         = 'hr/bank';
            $this->load->view('common/common',$this->data);
            redirect('HrController/bank');
          else:
              redirect('/');
        endif;	 
	} 
    
    
    public function add_head_of_dept()
    {	  	
        if($this->input->post()):
            $department_id      = $this->input->post('department_id');
            $emp_id      = $this->input->post('emp_id');
            $date      = $this->input->post('date');
            $comment      = $this->input->post('comment');
            $data       = array(
                'department_id' =>$department_id,
                'emp_id' =>$emp_id,
                'date' =>$date,
                'comment' =>$comment
            );
            $this->CRUDModel->insert('hr_head_department',$data);
            $this->data['page_title']   = 'Head of Department | ECP';
            $this->data['page']         = 'hr/head_of_department';
            $this->load->view('common/common',$this->data);
            redirect('HrController/head_of_dept');
          else:
              redirect('/');
        endif;	 
	} 
    
    public function update_bank()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $name               = $this->input->post('name');
            $branch_code        = $this->input->post('branch_code');
            $address            = $this->input->post('address');
            $comment            = $this->input->post('comment');
            $account_no         = $this->input->post('account_no');
            $bank_id =$this->input->post('bank_id');
              $data = array(
                'name' =>$name,
                'branch_code' =>$branch_code,
                'account_no' =>$account_no,
                'address' =>$address,
                'comment' =>$comment
                  );
              $where = array('bank_id'=>$bank_id); 
              $this->CRUDModel->update('bank',$data,$where);
              redirect('HrController/bank'); 
           endif;
        if($id):
            $where = array('bank_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('bank',$where);

            $this->data['page_title']        = 'Updae bank | ECP';
            $this->data['page']        =  'hr/update_bank';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function update_head_of_dept()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $department_id      = $this->input->post('department_id');
            $emp_id      = $this->input->post('emp_id');
            $date      = $this->input->post('date');
            $comment      = $this->input->post('comment');
            $data       = array(
                'department_id' =>$department_id,
                'emp_id' =>$emp_id,
                'date' =>$date,
                'comment' =>$comment
            );
              $where = array('serial_no'=>$id); 
              $this->CRUDModel->update('hr_head_department',$data,$where);
              redirect('HrController/head_of_dept'); 
           endif;
        if($id):
            $where = array('serial_no'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_head_department',$where);

            $this->data['page_title']        = 'Updae Head of Department | ECP';
            $this->data['page']        =  'hr/update_head_of_dept';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    public function delete_bank()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('bank_id'=>$id);
        $this->CRUDModel->deleteid('bank',$where);
        redirect('HrController/bank');
	} 
    
    public function delete_head_of_dept()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('serial_no'=>$id);
        $this->CRUDModel->deleteid('hr_head_department',$where);
        redirect('HrController/head_of_dept');
	} 
    
    public function department()
    {       
        $this->data['result']       = $this->HrModel->getdepartment();
        $this->data['page_title']   = 'Departments | ECP';
        $this->data['page']         = 'hr/department';
        $this->load->view('common/common',$this->data);
    }
    
    public function add_department()
    {	  	
        if($this->input->post()):
            $name      = $this->input->post('title');
            $comment      = $this->input->post('comment');
            $data       = array(
                'title' =>$name,
                'comment' =>$comment
            );
            $this->CRUDModel->insert('department',$data);
            $this->data['page_title']   = 'departments | ECP';
            $this->data['page']         = 'hr/department';
            $this->load->view('common/common',$this->data);
            redirect('HrController/department');
          else:
              redirect('/');
        endif;	 
	} 
    
    public function update_department()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $name      = $this->input->post('title');
            $comment    = $this->input->post('comment');
            $department_id =$this->input->post('department_id');
              $data = array(
                'title' =>$name,
                'comment' =>$comment
                  );
              $where = array('department_id'=>$department_id); 
              $this->CRUDModel->update('department',$data,$where);
              redirect('HrController/department'); 
           endif;
        if($id):
            $where = array('department_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('department',$where);

            $this->data['page_title']        = 'Updae department | ECP';
            $this->data['page']        =  'hr/update_department';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    public function delete_department()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('department_id'=>$id);
        $this->CRUDModel->deleteid('department',$where);
        redirect('HrController/department');
	}
    
    public function employee_reocrd($start=0)
    {
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
            $config['base_url']         = base_url('HrController/employee_reocrd');
            $config['total_rows']       = count($this->HrModel->getEmployee());  
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
            $custom['column']    ='emp_id';
            $custom['order']     ='desc';          
        $this->data['result']=$this->HrModel->getEmployeePg($config['per_page'], $page,null,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Employees Record | ECMS';
           $this->data['page']         = 'hr/employee_record';
           $this->load->view('common/common',$this->data);  
    }
    
    public function retired_employee_reocrd($start=0)
    {
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
            $config['base_url']         = base_url('HrController/retired_employee_reocrd');
            $config['total_rows']       = count($this->HrModel->getEmployeeRetire());  
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
            $custom['column']    ='emp_id';
            $custom['order']     ='desc';          
        $this->data['result']=$this->HrModel->getEmployeeRetired($config['per_page'], $page,null,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Retired Employees | ECMS';
           $this->data['page']         = 'hr/retired_employee_reocrd';
           $this->load->view('common/common',$this->data);  
    }
    
    public function employee_promotion_demotion($start=0)
    {
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
            $config['base_url']         = base_url('HrController/employee_promotion_demotion');
            $config['total_rows']       = count($this->HrModel->getEmployeePromote());  
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
            $custom['column']    ='emp_id';
            $custom['order']     ='desc';          
        $this->data['result']=$this->HrModel->getEmployeePromoted($config['per_page'], $page,null,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Promotion/Demotion Employees Record | ECMS';
           $this->data['page']         = 'hr/employee_promotion_demotion';
           $this->load->view('common/common',$this->data);  
    }
        
    public function add_employee_record()
	{	
       $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $employee = ucwords(strtolower(ucwords($this->input->post('emp_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $husband = ucwords(strtolower(ucwords($this->input->post('emp_husband_name'))));
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($joining_date));
            $date3 = date('Y-m-d', strtotime($retirement_date));
            $data = array(
                'emp_name'=>$employee,
                'father_name'=>$father,
                'emp_husband_name'=>$husband,
                'gender_id'=>$this->input->post('gender_id'),
                'dob'=>$date1,
                'nic'=>$this->input->post('nic'),
                'postal_address'=>$this->input->post('postal_address'),
                'permanent_address'=>$this->input->post('permanent_address'),
                'district_id'=>$this->input->post('district_id'),
                'post_office'=>$this->input->post('post_office'),
                'country_id'=>$this->input->post('country_id'),
                'bg_id'=>$this->input->post('bg_id'),
                'ptcl_number'=>$this->input->post('ptcl_number'),
                'contact1'=>$this->input->post('contact1'),
                'contact2'=>$this->input->post('contact2'),
                'religion_id'=>$this->input->post('religion_id'),
                'marital_status_id'=>$this->input->post('marital_status_id'),
                'emp_personal_no'=>$this->input->post('emp_personal_no'),
                'gp_fund_no'=>$this->input->post('gp_fund_no'),
                'email'=>$this->input->post('email'),
                'contract_type_id'=>$this->input->post('contract_type_id'),
                'j_emp_scale_id'=>$this->input->post('j_emp_scale_id'),
                'joining_designation'=>$this->input->post('joining_designation'),
                'joining_date'=>$date2,
                'retirement_date'=>$date3,
                'cat_id'=>$this->input->post('cat_id'),
                'c_emp_scale_id'=>$this->input->post('c_emp_scale_id'),
                'current_designation'=>$this->input->post('current_designation'),
                'department_id'=>$this->input->post('department_id'),
                'subject_id'=>$this->input->post('subject_id'),
                'shift_id'=>$this->input->post('shift_id'),
                'bank_id'=>$this->input->post('bank_id'),
                'account_no'=>$this->input->post('account_no'),
                'emp_status_id'=>$this->input->post('emp_status_id'),
                'comment'=>$this->input->post('comment'),
                'additional_responsibilty'=>$this->input->post('additional_responsibilty'),
                'user_id'=>$user_id

            );
            $id = $this->CRUDModel->insert('hr_emp_record',$data);
          
            redirect('HrController/employee_academic_record/'.$id);
          else:
            $this->data['page_title']   = 'Add New Employee | ECP';
            $this->data['page']         = 'hr/add_employee_record';
            $this->load->view('common/common',$this->data);
        endif;
	}
    
    public function employee_academic_record()
	{		
        $id = $this->uri->segment(3);
        $this->data['emp_id'] = $id;
        
       if($this->input->post()):
                $data = array
                (
                    'emp_id'=>$this->input->post('emp_id'),
                    'degree_id'=>$this->input->post('degree_id'),
                    'bu_id'=>$this->input->post('bu_id'),
                    'passing_year'=>$this->input->post('passing_year'),
                    'cgpa'=>$this->input->post('cgpa'),
                    'div_id'=>$this->input->post('div_id'),
                );
            $this->CRUDModel->insert('hr_emp_education',$data);
            redirect('HrController/employee_academic_record/'.$this->input->post('emp_id'));
        endif;
            $this->data['degree']  = $this->CRUDModel->dropDown('degree', 'â†? Select degree  â†’', 'degree_id', 'title');
            $this->data['board_university']  = $this->CRUDModel->dropDown('board_university', 'â†? Select Board  â†’', 'bu_id', 'title');
$this->data['division']  = $this->CRUDModel->dropDown('hr_emp_division', 'â†? Select Division  â†’', 'devision_id', 'name');
        
            $where = array('hr_emp_education.emp_id'=>$this->uri->segment(3));
            $this->data['employee_records'] =$this->HrModel->hr_edu_record($where);
            $this->data['page_title']   = 'Employee Academic Record | ECP';
            $this->data['page']         = 'hr/employee_academic_record';
            $this->load->view('common/common',$this->data); 
	}
    
    public function employee_profile()
    {
        $id = $this->uri->segment(3);
        $this->data['emp_id'] = $id;
        $where = array('hr_emp_record.emp_id'=>$id);
        $this->data['result']       = $this->HrModel->profileEmployee($where);
        $this->data['employee_records'] =$this->HrModel->hr_edu_record($where);
        $this->data['page_title']   = 'Employees Profile  | ECP';
        $this->data['page']         = 'hr/employee_profile';
        $this->load->view('common/common',$this->data);
    }
    
    public function update_employee()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $employee = ucwords(strtolower(ucwords($this->input->post('emp_name'))));
            $father = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $husband = ucwords(strtolower(ucwords($this->input->post('emp_husband_name'))));
            $dob = $this->input->post('dob'); 
            $joining_date = $this->input->post('joining_date'); 
            $retirement_date = $this->input->post('retirement_date'); 
            $date1 = date('Y-m-d', strtotime($dob));
            $date2 = date('Y-m-d', strtotime($joining_date));
            $date3 = date('Y-m-d', strtotime($retirement_date));
            $data       = array(
                'emp_name'=>$employee,
                'father_name'=>$father,
                'emp_husband_name'=>$husband,
                'gender_id'=>$this->input->post('gender_id'),
                'dob'=>$date1,
                'nic'=>$this->input->post('nic'),
                'postal_address'=>$this->input->post('postal_address'),
                'permanent_address'=>$this->input->post('permanent_address'),
                'district_id'=>$this->input->post('district_id'),
                'post_office'=>$this->input->post('post_office'),
                'country_id'=>$this->input->post('country_id'),
                'bg_id'=>$this->input->post('bg_id'),
                'ptcl_number'=>$this->input->post('ptcl_number'),
                'contact1'=>$this->input->post('contact1'),
                'contact2'=>$this->input->post('contact2'),
                'religion_id'=>$this->input->post('religion_id'),
                'marital_status_id'=>$this->input->post('marital_status_id'),
                'emp_personal_no'=>$this->input->post('emp_personal_no'),
                'gp_fund_no'=>$this->input->post('gp_fund_no'),
                'email'=>$this->input->post('email'),
                'contract_type_id'=>$this->input->post('contract_type_id'),
                'j_emp_scale_id'=>$this->input->post('j_emp_scale_id'),
                'joining_designation'=>$this->input->post('joining_designation'),
                'joining_date'=>$date2,
                'retirement_date'=>$date3,
                'cat_id'=>$this->input->post('cat_id'),
                'c_emp_scale_id'=>$this->input->post('c_emp_scale_id'),
                'current_designation'=>$this->input->post('current_designation'),
                'department_id'=>$this->input->post('department_id'),
                'subject_id'=>$this->input->post('subject_id'),
                'shift_id'=>$this->input->post('shift_id'),
                'bank_id'=>$this->input->post('bank_id'),
                'account_no'=>$this->input->post('account_no'),
                'emp_status_id'=>$this->input->post('emp_status_id'),
                'comment'=>$this->input->post('comment'),
                'additional_responsibilty'=>$this->input->post('additional_responsibilty')
            );
              $where = array('emp_id'=>$id);
              $this->CRUDModel->update('hr_emp_record',$data,$where);
              redirect('HrController/employee_reocrd'); 
           endif;
        if($id):
            $where = array('hr_emp_record.emp_id'=>$id);
            $where1 = array('emp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_record',$where);
            
            $this->data['employee_records'] =$this->HrModel->hr_edu_record($where);
            $this->data['research'] = $this->CRUDModel->get_where_result('hr_research_paper',$where1);
            $this->data['professional'] = $this->CRUDModel->get_where_result('hr_professional_edu',$where1);
            $this->data['page_title']        = 'Update Employee Record | ECMS';
            $this->data['page']        =  'hr/update_employee';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function update_employee_status()
    {		
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $date = $this->input->post('date'); 
            $date1 = date('Y-m-d', strtotime($date));
            $image = $this->CRUDModel->hr_do_resize('file','assets/images/employee');
            $file_name = $image['file_name'];
            $data       = array(
                'emp_status_id'=>2,
                'retire_flag'=>2,
            );
              $where = array('emp_id'=>$id);
              $this->CRUDModel->update('hr_emp_record',$data,$where);
              $retire_data = array(
                'emp_id'=>$this->input->post('emp_id'),
                'retire_status_id'=>$this->input->post('retire_status_id'),
                'date'=>$date1,
                'remarks'=>$this->input->post('remarks'),
                'attach_file'=>$file_name,
                'user_id'=>$user_id,
              );  
            $this->CRUDModel->insert('hr_emp_retire',$retire_data);    
              redirect('HrController/retired_employee_reocrd'); 
           endif;
        if($id):
            $where = array('hr_emp_record.emp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_record',$where);
            
            $this->data['employee_records'] =$this->HrModel->hr_edu_record($where);
            
            $this->data['page_title']        = 'Updae Employee Status | ECMS';
            $this->data['page']        =  'hr/update_employee_status';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function staff_promotion_demotion()
    {		
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $old_desig_id = $this->input->post('old_desig_id'); 
            $old_scale_id = $this->input->post('old_scale_id'); 
            $pro_scale_id = $this->input->post('pro_scale_id'); 
            $pro_desig_id = $this->input->post('pro_desig_id'); 
            $remarks = $this->input->post('remarks'); 
            $emp_id = $this->input->post('emp_id'); 
            $date = $this->input->post('promotion_date'); 
            $promotion_type = $this->input->post('promotion_type'); 
            $date1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'current_designation'=>$pro_desig_id,
                'c_emp_scale_id'=>$pro_scale_id,
            );
              $where = array('emp_id'=>$emp_id);
              $this->CRUDModel->update('hr_emp_record',$data,$where);
              $promotion_data = array(
                'emp_id'=>$emp_id,
                'promotion_type'=>$promotion_type,
                'promotion_date'=>$date1,
                'old_desig_id'=>$this->input->post('old_desig_id'),
                'old_scale_id'=>$this->input->post('old_scale_id'),
                'pro_desig_id'=>$this->input->post('pro_desig_id'),
                'pro_scale_id'=>$this->input->post('pro_scale_id'),
                'remarks'=>$this->input->post('remarks'),
                'user_id'=>$user_id,
              );  
            $this->CRUDModel->insert('hr_promotion_demotion',$promotion_data);    
              redirect('HrController/employee_promotion_demotion'); 
           endif;
        if($id):
            $where = array('hr_emp_record.emp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_record',$where);
            
            $this->data['page_title']        = 'staff promotion demotion | ECMS';
            $this->data['page']        =  'hr/staff_promotion_demotion';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function update_emp_edu()
    {
       $id = $this->uri->segment(3);
       $emp_id = $this->uri->segment(4);
        if($this->input->post()):
            $emp_id      = $this->input->post('emp_id');
            $degree_id      = $this->input->post('degree_id');
            $bu_id      = $this->input->post('bu_id');
            $passing_year      = $this->input->post('passing_year');
            $cgpa      = $this->input->post('cgpa');
            $div_id      = $this->input->post('div_id');
            $data       = array(
                'emp_id' =>$emp_id,
                'degree_id' =>$degree_id,
                'bu_id' =>$bu_id,
                'passing_year' =>$passing_year,
                'percentage' =>$percentage,
                'cgpa' =>$cgpa,
                'div_id' =>$div_id    
            );
              $where = array('emp_edu_id'=>$id); 
              $this->CRUDModel->update('hr_emp_education',$data,$where);
              redirect('HrController/update_employee/'.$emp_id); 
           endif;
        if($id):
            $where = array('emp_edu_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_education',$where);

            $this->data['page_title']        = 'Update Employee Qualification | ECP';
            $this->data['page']        =  'hr/update_emp_academic';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif; 
    }
    
    public function delete_emp_edu()
    {	    
        $id         = $this->uri->segment(3);
        $emp_id         = $this->uri->segment(4);
        $where      = array('emp_edu_id'=>$id);
        $this->CRUDModel->deleteid('hr_emp_education',$where);
        redirect('HrController/update_employee/'.$emp_id);
	} 
    
    public function upload_employee_pic()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('file','assets/images/employee');
            $file_name = $image['file_name'];
            $data = array('picture'=>$file_name);
            $where = array('emp_id'=>$id); 
            $this->CRUDModel->update('hr_emp_record',$data,$where);
            redirect('HrController/employee_reocrd'); 
        endif;
        if($id):
            $where = array('emp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_record',$where);

            $this->data['page_title']        = 'Upload Employee Picture | ECP';
            $this->data['page']        =  'hr/upload_employee_pic';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function head_of_dept(){
        
         $this->data['result']       = $this->HrModel->gethead_of_dept();
        $this->data['page_title']   = 'head of deparment | ECP';
        $this->data['page']         = 'hr/head_of_department';
        $this->load->view('common/common',$this->data);
    }
    
    public function category()
    {
        $this->data['result']       = $this->HrModel->getcategory();
        $this->data['page_title']   = 'HR Category | ECP';
        $this->data['page']         = 'hr/hr_category';
        $this->load->view('common/common',$this->data);
    }
    
    public function delete_category()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('cat_id'=>$id);
        $this->CRUDModel->deleteid('hr_emp_category',$where);
        redirect('admin/category');
	}
    
    public function designation()
    {
        $this->data['result']       = $this->HrModel->getdesignation();
        $this->data['page_title']   = 'HR Designation | ECP';
        $this->data['page']         = 'hr/designation';
        $this->load->view('common/common',$this->data);
    }
    
    public function add_designation()
    {	  	
        if($this->input->post()):
            $name      = $this->input->post('title');
            $data       = array(
                'title' =>$name,
            );
            $this->CRUDModel->insert('hr_emp_designation',$data);
            $this->data['page_title']   = 'Designation | ECP';
            $this->data['page']         = 'hr/designation';
            $this->load->view('common/common',$this->data);
            redirect('HrController/designation');
          else:
              redirect('/');
        endif;	 
	} 
    
    public function update_designation()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $name      = $this->input->post('title');
            $department_id =$this->input->post('emp_desg_id');
              $data = array(
                'title' =>$name,
                  );
              $where = array('emp_desg_id'=>$department_id); 
              $this->CRUDModel->update('hr_emp_designation',$data,$where);
              redirect('HrController/designation'); 
           endif;
        if($id):
            $where = array('emp_desg_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_designation',$where);

            $this->data['page_title']        = 'Updae Designation | ECP';
            $this->data['page']        =  'hr/update_designation';
            $this->load->view('common/common',$this->data);
        else:
        redirect('/');
        endif;
    }
    
    public function delete_designation()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('emp_desg_id'=>$id);
        $this->CRUDModel->deleteid('hr_emp_designation',$where);
        redirect('HrController/designation');
	}
    
    public function division()
    {
        $this->data['result']       = $this->HrModel->getdivision();
        $this->data['page_title']   = 'HR Division | ECP';
        $this->data['page']         = 'hr/division';
        $this->load->view('common/common',$this->data);
    }
    
    public function add_division()
    {	  	
        if($this->input->post()):
            $name      = $this->input->post('name');
            $data       = array(
                'name' =>$name,
            );
            $this->CRUDModel->insert('hr_emp_division',$data);
            $this->data['page_title']   = 'Division | ECP';
            $this->data['page']         = 'hr/division';
            $this->load->view('common/common',$this->data);
            redirect('HrController/division');
          else:
              redirect('/');
        endif;	 
	}
    
    public function delete_division()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('devision_id'=>$id);
        $this->CRUDModel->deleteid('hr_emp_division',$where);
        redirect('HrController/division');
	}
    
    public function employee_scale()
    {
        $this->data['result']       = $this->HrModel->getscale();
        $this->data['page_title']   = 'HR Employee Scale | ECP';
        $this->data['page']         = 'hr/employee_scale';
        $this->load->view('common/common',$this->data);
    }
    
    public function add_employee_scale()
    {	  	
        if($this->input->post()):
            $name      = $this->input->post('title');
            $data       = array(
                'title' =>$name,
            );
            $this->CRUDModel->insert('hr_emp_scale',$data);
            $this->data['page_title']   = 'HR Employee Scale | ECP';
            $this->data['page']         = 'hr/employee_scale';
            $this->load->view('common/common',$this->data);
            redirect('HrController/employee_scale');
          else:
              redirect('/');
        endif;	 
	}
    
    public function delete_scale()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('emp_scale_id'=>$id);
        $this->CRUDModel->deleteid('hr_emp_scale',$where);
        redirect('HrController/employee_scale');
	}
    
    public function employee_status()
    {
        $this->data['result']       = $this->HrModel->getemp_status();
        $this->data['page_title']   = 'HR Employee Status | ECP';
        $this->data['page']         = 'hr/employee_status';
        $this->load->view('common/common',$this->data);
    }
    
    public function delete_emp_status()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('emp_status_id'=>$id);
        $this->CRUDModel->deleteid('hr_emp_status',$where);
        redirect('admin/employee_status');
	} 
    
    public function contract_type()
    {
        $this->data['result']       = $this->HrModel->getemp_contract();
        $this->data['page_title']   = 'HR Employee Contract | ECP';
        $this->data['page']         = 'hr/contract_type';
        $this->load->view('common/common',$this->data);
    }
    
    public function delete_contract_type()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('contract_type_id'=>$id);
        $this->CRUDModel->deleteid(' hr_emp_contract_type',$where);
        redirect('admin/contract_type');
	} 
    
    Public function search_employee_records(){
$this->data['department']    = $this->CRUDModel->dropDown('department', 'Department', 'department_id', 'title');
$this->data['gender']    = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
$this->data['subject']    = $this->CRUDModel->dropDown('subject', 'Subject', 'subject_id', 'title');
$this->data['scale']    = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'title');
$this->data['status']    = $this->CRUDModel->dropDown('hr_emp_status', 'Status', 'emp_status_id', 'title');
$this->data['designation']    = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'title');
$this->data['contract']    = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Contract', 'contract_type_id', 'title');
$this->data['category']    = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'cat_id', 'title');
$this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');        
        
        if($this->input->post('search')):
        $emp_name       =  $this->input->post('emp_name');
        $father_name        =  $this->input->post('father_name');
        $gender_id             =  $this->input->post('gender_id');
        $department_id            =  $this->input->post('department_id');
        $current_designation        =  $this->input->post('current_designation');
        $c_emp_scale_id      =  $this->input->post('c_emp_scale_id');
        $emp_status_id      =  $this->input->post('emp_status_id');
        $cat_id      =  $this->input->post('cat_id');
        $subject_id      =  $this->input->post('subject_id');
        $contract_type_id      =  $this->input->post('contract_type_id');
        $limit              =  $this->input->post('limit');  
        //like Array
        $like = '';
        $where = '';
        $this->data['emp_name'] = '';
        $this->data['father_name']  = '';
        $this->data['gender_id']  = '';
        $this->data['department_id']  = '';
        $this->data['current_designation']  = '';
        $this->data['c_emp_scale_id']  = '';
        $this->data['emp_status_id']  = '';
        $this->data['cat_id']  = '';
        $this->data['subject_id']  = '';
        $this->data['contract_type_id']  = '';
        $this->data['limitId']  = ''; 
        
            if(!empty($emp_name)):
                $like['emp_name'] = $emp_name;
                $this->data['emp_name'] =$emp_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            
            //where array 
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($department_id)):
                $where['department.department_id'] = $department_id;
                $this->data['department_id']  = $department_id;
            endif;
            if(!empty($current_designation)):
                $where['hr_emp_designation.emp_desg_id'] = $current_designation;
                $this->data['current_designation']  = $current_designation;
            endif;
            if(!empty($emp_status_id)):
                $where['hr_emp_record.emp_status_id'] = $emp_status_id;
                $this->data['emp_status_id']  = $emp_status_id;
            endif;
            if(!empty($c_emp_scale_id)):
                $where['hr_emp_scale.emp_scale_id'] = $c_emp_scale_id;
                $this->data['c_emp_scale_id']  = $c_emp_scale_id;
            endif;
        if(!empty($cat_id)):
                $where['hr_emp_category.cat_id'] = $cat_id;
                $this->data['cat_id']  = $cat_id;
            endif;
            if(!empty($contract_type_id)):
                $where['hr_emp_contract.contract_type_id'] = $contract_type_id;
                $this->data['contract_type_id']  = $contract_type_id;
            endif;
        if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id']  = $subject_id;
            endif;
                $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
              
                if($limitVale):
                    $limitD = $limitVale->limit_value;
                else:
                    $limitD = 50;
                endif;
                $custom['limit']        = $limitD;
                $custom['start']        = 0;
                $custom['column']       = '';
                $custom['order']        = 'desc';
                $this->data['limitId']  = $limit;
                $this->data['result']   = $this->HrModel->get_empData('hr_emp_record',$where,$like,NULL);
                $this->data['page']     = "hr/employee_record_list";
                $this->data['title']    = 'Employee List 2016 | ECP';
                $this->load->view('common/common',$this->data); 
        
            elseif($this->input->post('export')):    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Employees List');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Employee Name');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
            
                $this->excel->getActiveSheet()->setCellValue('B1', 'Father Name');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'CNIC #');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Postal Address'); 
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Permanent Address');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
        
                $this->excel->getActiveSheet()->setCellValue('F1','Post Office');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);                
        
                $this->excel->getActiveSheet()->setCellValue('G1','District');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Designation');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                
                $this->excel->getActiveSheet()->setCellValue('I1','Gender');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('J1','Department');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Scale');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('L1','Category');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('M1','Contract');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('N1','Additional Responsibility');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('O1','Status');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('P1','Contact 1');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('Q1','Contact 2');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
                
       for($col = ord('A'); $col <= ord('Q'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
        $emp_id      =  $this->input->post('emp_id');
        $emp_name       =  $this->input->post('emp_name');
        $father_name        =  $this->input->post('father_name');
        $gender_id             =  $this->input->post('gender_id');
        $department_id            =  $this->input->post('department_id');
        $current_designation        =  $this->input->post('current_designation');
        $c_emp_scale_id      =  $this->input->post('c_emp_scale_id');
        $emp_status_id      =  $this->input->post('emp_status_id');
        $cat_id      =  $this->input->post('cat_id');
        $subject_id      =  $this->input->post('subject_id');
        $contract_type_id      =  $this->input->post('contract_type_id');
        $limit              =  $this->input->post('limit'); 
          
        $like = '';
        $where = '';
        $this->data['emp_id'] = '';
        $this->data['emp_name'] = '';
        $this->data['father_name']  = '';
        $this->data['gender_id']  = '';
        $this->data['department_id']  = '';
        $this->data['current_designation']  = '';
        $this->data['c_emp_scale_id']  = '';
        $this->data['emp_status_id']  = '';
        $this->data['cat_id']  = '';
        $this->data['subject_id']  = '';
        $this->data['contract_type_id']  = '';
        $this->data['limitId']  = '';
            
           if(!empty($emp_id)):
                $like['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($emp_name)):
                $like['emp_name'] = $emp_name;
                $this->data['emp_name'] =$emp_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            
            //where array 
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($department_id)):
                $where['department.department_id'] = $department_id;
                $this->data['department_id']  = $department_id;
            endif;
            if(!empty($current_designation)):
                $where['hr_emp_designation.emp_desg_id'] = $current_designation;
                $this->data['current_designation']  = $current_designation;
            endif;
            if(!empty($c_emp_scale_id)):
                $where['hr_emp_scale.emp_scale_id'] = $c_emp_scale_id;
                $this->data['c_emp_scale_id']  = $c_emp_scale_id;
            endif;
        if(!empty($emp_status_id)):
                $where['hr_emp_record.emp_status_id'] = $emp_status_id;
                $this->data['emp_status_id']  = $emp_status_id;
            endif;
        if(!empty($cat_id)):
                $where['hr_emp_category.cat_id'] = $cat_id;
                $this->data['cat_id']  = $cat_id;
            endif;
            if(!empty($contract_type_id)):
                $where['hr_emp_contract.contract_type_id'] = $contract_type_id;
                $this->data['contract_type_id']  = $contract_type_id;
            endif;
        if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id']  = $subject_id;
            endif;
            $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
              
                if($limitVale):
                    $limitD = $limitVale->limit_value;
                else:
                    $limitD = 50;
                endif;
                $custom['limit']        = $limitD;
                $custom['start']        = 0;
               // $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $this->data['limitId']  = $limit;
            
                $this->db->select('
                hr_emp_record.emp_name,
                hr_emp_record.father_name,
                hr_emp_record.nic,
                hr_emp_record.postal_address,
                hr_emp_record.permanent_address,
                hr_emp_record.post_office,
                district.name as district,
                hr_emp_designation.title as designation,
                gender.title as genderName,
                department.title as department,
                hr_emp_scale.title as scale,
                hr_emp_category.title as category,
                hr_emp_contract_type.title as contract,
                hr_emp_record.additional_responsibilty,
                hr_emp_status.title,
                hr_emp_record.contact1,
                hr_emp_record.contact2,
                ');
                $this->db->FROM('hr_emp_record');
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->order_by('hr_emp_record.emp_id','asc');
                $this->db->limit($custom['start'],$custom['limit']);
     
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('district','district.district_id=hr_emp_record.district_id', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('subject','subject.subject_id=hr_emp_record.subject_id', 'left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id', 'left outer');
        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
                $rs =  $this->db->get();
        
                $exceldata="";
                foreach ($rs->result_array() as $row)
                {
                $exceldata[] = $row;
                }      
        
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Employee_List.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
                else:

                $this->data['emp_id'] = '';
                $this->data['emp_name'] = '';
                $this->data['father_name']  = '';
                $this->data['gender_id']  = '';
                $this->data['department_id']  = '';
                $this->data['current_designation']  = '';
                $this->data['c_emp_scale_id']  = '';
                $this->data['cat_id']  = '';
                $this->data['subject_id']  = '';
                $this->data['contract_type_id']  = '';
                $this->data['limitId']  = '';
        
           endif; 
        }
    
    Public function search_retire_employee(){
$this->data['department']    = $this->CRUDModel->dropDown('department', 'Department', 'department_id', 'title');
$this->data['gender']    = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
$this->data['subject']    = $this->CRUDModel->dropDown('subject', 'Subject', 'subject_id', 'title');
$this->data['scale']    = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'title');
$this->data['designation']    = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'title');
$this->data['contract']    = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Contract', 'contract_type_id', 'title');
$this->data['category']    = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'cat_id', 'title');
$this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');        
        
        if($this->input->post('search')):
        $emp_name       =  $this->input->post('emp_name');
        $father_name        =  $this->input->post('father_name');
        $gender_id             =  $this->input->post('gender_id');
        $department_id            =  $this->input->post('department_id');
        $current_designation        =  $this->input->post('current_designation');
        $c_emp_scale_id      =  $this->input->post('c_emp_scale_id');
        $cat_id      =  $this->input->post('cat_id');
        $subject_id      =  $this->input->post('subject_id');
        $contract_type_id      =  $this->input->post('contract_type_id');
        $limit              =  $this->input->post('limit');  
        //like Array
        $like = '';
        $where = '';
        $this->data['emp_name'] = '';
        $this->data['father_name']  = '';
        $this->data['gender_id']  = '';
        $this->data['department_id']  = '';
        $this->data['current_designation']  = '';
        $this->data['c_emp_scale_id']  = '';
        $this->data['cat_id']  = '';
        $this->data['subject_id']  = '';
        $this->data['contract_type_id']  = '';
        $this->data['limitId']  = ''; 
        
            if(!empty($emp_name)):
                $like['emp_name'] = $emp_name;
                $this->data['emp_name'] =$emp_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            
            //where array 
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($department_id)):
                $where['department.department_id'] = $department_id;
                $this->data['department_id']  = $department_id;
            endif;
            if(!empty($current_designation)):
                $where['hr_emp_designation.emp_desg_id'] = $current_designation;
                $this->data['current_designation']  = $current_designation;
            endif;
            if(!empty($c_emp_scale_id)):
                $where['hr_emp_scale.emp_scale_id'] = $c_emp_scale_id;
                $this->data['c_emp_scale_id']  = $c_emp_scale_id;
            endif;
        if(!empty($cat_id)):
                $where['hr_emp_category.cat_id'] = $cat_id;
                $this->data['cat_id']  = $cat_id;
            endif;
            if(!empty($contract_type_id)):
                $where['hr_emp_contract.contract_type_id'] = $contract_type_id;
                $this->data['contract_type_id']  = $contract_type_id;
            endif;
        if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id']  = $subject_id;
            endif;
                $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
              
                if($limitVale):
                    $limitD = $limitVale->limit_value;
                else:
                    $limitD = 50;
                endif;
                $custom['limit']        = $limitD;
                $custom['start']        = 0;
                $custom['column']       = '';
                $custom['order']        = 'desc';
                $this->data['limitId']  = $limit;
                $this->data['result']   = $this->HrModel->get_empretireData('hr_emp_record',$where,$like,NULL);
                $this->data['page']     = "hr/retire_employee_record_list";
                $this->data['title']    = 'Employee List 2016 | ECMS';
                $this->load->view('common/common',$this->data); 
        endif;
        }
    
    Public function search_promotion_employee(){
$this->data['department']    = $this->CRUDModel->dropDown('department', 'Department', 'department_id', 'title');
$this->data['gender']    = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
$this->data['subject']    = $this->CRUDModel->dropDown('subject', 'Subject', 'subject_id', 'title');
$this->data['scale']    = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'title');
$this->data['designation']    = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'title');
$this->data['contract']    = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Contract', 'contract_type_id', 'title');
$this->data['category']    = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'cat_id', 'title');
$this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');        
        
        if($this->input->post('search')):
        $emp_name       =  $this->input->post('emp_name');
        $father_name        =  $this->input->post('father_name');
        $gender_id             =  $this->input->post('gender_id');
        $department_id            =  $this->input->post('department_id');
        $current_designation        =  $this->input->post('current_designation');
        $c_emp_scale_id      =  $this->input->post('c_emp_scale_id');
        $cat_id      =  $this->input->post('cat_id');
        $subject_id      =  $this->input->post('subject_id');
        $contract_type_id      =  $this->input->post('contract_type_id');
        $limit              =  $this->input->post('limit');  
        //like Array
        $like = '';
        $where = '';
        $this->data['emp_name'] = '';
        $this->data['father_name']  = '';
        $this->data['gender_id']  = '';
        $this->data['department_id']  = '';
        $this->data['current_designation']  = '';
        $this->data['c_emp_scale_id']  = '';
        $this->data['cat_id']  = '';
        $this->data['subject_id']  = '';
        $this->data['contract_type_id']  = '';
        $this->data['limitId']  = ''; 
        
            if(!empty($emp_name)):
                $like['emp_name'] = $emp_name;
                $this->data['emp_name'] =$emp_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            
            //where array 
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($department_id)):
                $where['department.department_id'] = $department_id;
                $this->data['department_id']  = $department_id;
            endif;
            if(!empty($current_designation)):
                $where['hr_emp_designation.emp_desg_id'] = $current_designation;
                $this->data['current_designation']  = $current_designation;
            endif;
            if(!empty($c_emp_scale_id)):
                $where['hr_emp_scale.emp_scale_id'] = $c_emp_scale_id;
                $this->data['c_emp_scale_id']  = $c_emp_scale_id;
            endif;
        if(!empty($cat_id)):
                $where['hr_emp_category.cat_id'] = $cat_id;
                $this->data['cat_id']  = $cat_id;
            endif;
            if(!empty($contract_type_id)):
                $where['hr_emp_contract.contract_type_id'] = $contract_type_id;
                $this->data['contract_type_id']  = $contract_type_id;
            endif;
        if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id']  = $subject_id;
            endif;
                $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
              
                if($limitVale):
                    $limitD = $limitVale->limit_value;
                else:
                    $limitD = 50;
                endif;
                $custom['limit']        = $limitD;
                $custom['start']        = 0;
                $custom['column']       = '';
                $custom['order']        = 'desc';
                $this->data['limitId']  = $limit;
                $this->data['result']   = $this->HrModel->get_empretireData('hr_emp_record',$where,$like,NULL);
                $this->data['page']     = "hr/search_promotion_employee";
                $this->data['title']    = 'Promotion/Demotion Employees List | ECMS';
                $this->load->view('common/common',$this->data); 
        endif;
        }
        
        public function checkCnic(){
           
            $query = $this->CRUDModel->get_where_row('hr_emp_record',array('nic'=>$this->input->post('emp_cnic')));
            if($query):
                echo true;
                else:
                echo false;
            endif;
        }
    
    public function add_employee_picture($start=0)
    {
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'â†? Select Limit  â†’', 'limitId', 'limit_value');
            $config['base_url']         = base_url('HrController/add_employee_picture');
            $config['total_rows']       = count($this->HrModel->getEmployee());  
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
            $custom['column']    ='emp_id';
            $custom['order']     ='desc';          
            $this->data['result']=$this->HrModel->getEmployeePg($config['per_page'], $page,null,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'All Employees Record | ECMS';
           $this->data['page']         = 'hr/add_employee_picture';
           $this->load->view('common/common',$this->data);  
    }
    
    Public function search_add_employee_pic(){
$this->data['department']    = $this->CRUDModel->dropDown('department', 'Department', 'department_id', 'title');
$this->data['gender']    = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
$this->data['subject']    = $this->CRUDModel->dropDown('subject', 'Subject', 'subject_id', 'title');
$this->data['scale']    = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'title');
$this->data['status']    = $this->CRUDModel->dropDown('hr_emp_status', 'Status', 'emp_status_id', 'title');
$this->data['designation']    = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'title');
$this->data['contract']    = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Contract', 'contract_type_id', 'title');
$this->data['category']    = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'cat_id', 'title');
$this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');        
        
        if($this->input->post('search')):
        $emp_name       =  $this->input->post('emp_name');
        $father_name        =  $this->input->post('father_name');
        $gender_id             =  $this->input->post('gender_id');
        $department_id            =  $this->input->post('department_id');
        $current_designation        =  $this->input->post('current_designation');
        $c_emp_scale_id      =  $this->input->post('c_emp_scale_id');
        $emp_status_id      =  $this->input->post('emp_status_id');
        $cat_id      =  $this->input->post('cat_id');
        $subject_id      =  $this->input->post('subject_id');
        $contract_type_id      =  $this->input->post('contract_type_id');
        $limit              =  $this->input->post('limit');  
        //like Array
        $like = '';
        $where = '';
        $this->data['emp_name'] = '';
        $this->data['father_name']  = '';
        $this->data['gender_id']  = '';
        $this->data['department_id']  = '';
        $this->data['current_designation']  = '';
        $this->data['c_emp_scale_id']  = '';
        $this->data['emp_status_id']  = '';
        $this->data['cat_id']  = '';
        $this->data['subject_id']  = '';
        $this->data['contract_type_id']  = '';
        $this->data['limitId']  = ''; 
        
            if(!empty($emp_name)):
                $like['emp_name'] = $emp_name;
                $this->data['emp_name'] =$emp_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            
            //where array 
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($department_id)):
                $where['department.department_id'] = $department_id;
                $this->data['department_id']  = $department_id;
            endif;
            if(!empty($current_designation)):
                $where['hr_emp_designation.emp_desg_id'] = $current_designation;
                $this->data['current_designation']  = $current_designation;
            endif;
            if(!empty($emp_status_id)):
                $where['hr_emp_record.emp_status_id'] = $emp_status_id;
                $this->data['emp_status_id']  = $emp_status_id;
            endif;
            if(!empty($c_emp_scale_id)):
                $where['hr_emp_scale.emp_scale_id'] = $c_emp_scale_id;
                $this->data['c_emp_scale_id']  = $c_emp_scale_id;
            endif;
        if(!empty($cat_id)):
                $where['hr_emp_category.cat_id'] = $cat_id;
                $this->data['cat_id']  = $cat_id;
            endif;
            if(!empty($contract_type_id)):
                $where['hr_emp_contract.contract_type_id'] = $contract_type_id;
                $this->data['contract_type_id']  = $contract_type_id;
            endif;
        if(!empty($subject_id)):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id']  = $subject_id;
            endif;
                $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
              
                if($limitVale):
                    $limitD = $limitVale->limit_value;
                else:
                    $limitD = 50;
                endif;
                $custom['limit']        = $limitD;
                $custom['start']        = 0;
                $custom['column']       = '';
                $custom['order']        = 'desc';
                $this->data['limitId']  = $limit;
                $this->data['result']   = $this->HrModel->get_empData('hr_emp_record',$where,$like,NULL);
                $this->data['page']     = "hr/search_add_employee_pic";
                $this->data['title']    = 'Employee List | ECMS';
                $this->load->view('common/common',$this->data); 
            endif;
        }
    
    public function add_employee_pic()
    {
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize('file','assets/images/employee');
            $file_name = $image['file_name'];
            $data = array('picture'=>$file_name);
            $where = array('emp_id'=>$id); 
            $this->CRUDModel->update('hr_emp_record',$data,$where);
            redirect('HrController/add_employee_picture'); 
        endif;
        if($id):
            $where = array('emp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_record',$where);

            $this->data['page_title']        = 'Upload Employee Picture | ECP';
            $this->data['page']        =  'hr/add_employee_pic';
            $this->load->view('common/common',$this->data);
        endif;
    }
	
	
	public function explanation_letter()
    {       
        $this->data['result']       = $this->HrModel->getemp_rec();
        $this->data['page_title']   = 'Explanation Letter | ECMS';
        $this->data['page']         = 'hr/explanation_letter';
        $this->load->view('common/common',$this->data);
    }
    
    public function show_cause()
    {       
        $this->data['result']       = $this->HrModel->getemp_show_cause();
        $this->data['page_title']   = 'Show Cause| ECMS';
        $this->data['page']         = 'hr/show_cause';
        $this->load->view('common/common',$this->data);
    }
    
    public function promotion()
    {       
        $this->data['result']       = $this->HrModel->getemp_promotion();
        $this->data['page_title']   = 'Promotion | ECMS';
        $this->data['page']         = 'hr/promotion';
        $this->load->view('common/common',$this->data);
    }
    
    public function demotion()
    {       
        $this->data['result']       = $this->HrModel->getemp_demotion();
        $this->data['page_title']   = 'Demotion | ECMS';
        $this->data['page']         = 'hr/demotion';
        $this->load->view('common/common',$this->data);
    }
    
    public function contract_reneval()
    {       
        $this->data['result']       = $this->HrModel->emp_contract_reneval();
        $this->data['page_title']   = 'Contract Reneval | ECMS';
        $this->data['page']         = 'hr/contract_reneval';
        $this->load->view('common/common',$this->data);
    }
	
	public function update_demotion()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $dem_id         = $this->input->post('dem_id');
            $emp_id         = $this->input->post('emp_id');
            $from_scale_id  = $this->input->post('from_scale_id');
            $to_scale_id    = $this->input->post('to_scale_id');
            $from_desg_id   = $this->input->post('from_desg_id');
            $to_desg_id     = $this->input->post('to_desg_id');
            $date           = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $from_p         = $this->input->post('from_p');
            $remarks        = $this->input->post('remarks');
            $date_1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'letter_no' =>$letter_no,
                'from_scale_id' =>$from_scale_id,
                'to_scale_id' =>$to_scale_id,
                'from_desg_id' =>$from_desg_id,
                'to_desg_id' =>$to_desg_id,
                'from_p' =>$from_p,
                'dem_date' =>$date_1,
                'remarks' =>$remarks
            );
              $where = array('dem_id'=>$dem_id); 
              $this->CRUDModel->update('hr_emp_demotion',$data,$where);
              redirect('HrController/demotion'); 
           endif;
        if($id):
            $where = array('dem_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_demotion',$where);

            $this->data['page_title']  = 'Update Demotion | ECMS';
            $this->data['page']        =  'hr/update_demotion';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function update_contract_reneval()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $contract_id         = $this->input->post('contract_id');
            $emp_id      = $this->input->post('emp_id');
            $from_date      = $this->input->post('fromdate');
            $to_date      = $this->input->post('todate');
            $date      = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $details      = $this->input->post('details');
            $from_p      = $this->input->post('from_p');
            $remarks      = $this->input->post('remarks');
            $date_f = date('Y-m-d', strtotime($from_date));
            $date_t = date('Y-m-d', strtotime($to_date));
            $date_1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'letter_no' =>$letter_no,
                'from_date' =>$date_f,
                'to_date' =>$date_t,
                'from_p' =>$from_p,
                'contract_date' =>$date_1,
                'details' =>$details,
                'image' =>$file_name,
                'remarks' =>$remarks
            );
              $where = array('contract_id'=>$contract_id); 
              $this->CRUDModel->update('hr_contract_reneval',$data,$where);
              redirect('HrController/contract_reneval'); 
           endif;
        if($id):
            $where = array('contract_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_contract_reneval',$where);

            $this->data['page_title']  = 'Update Contract Reneval | ECMS';
            $this->data['page']        =  'hr/update_contract_reneval';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function update_promotion()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $pro_id         = $this->input->post('pro_id');
            $emp_id         = $this->input->post('emp_id');
            $from_scale_id  = $this->input->post('from_scale_id');
            $to_scale_id    = $this->input->post('to_scale_id');
            $from_desg_id   = $this->input->post('from_desg_id');
            $to_desg_id     = $this->input->post('to_desg_id');
            $date           = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $from_p         = $this->input->post('from_p');
            $remarks        = $this->input->post('remarks');
            $date_1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'letter_no' =>$letter_no,
                'from_scale_id' =>$from_scale_id,
                'to_scale_id' =>$to_scale_id,
                'from_desg_id' =>$from_desg_id,
                'to_desg_id' =>$to_desg_id,
                'from_p' =>$from_p,
                'pro_date' =>$date_1,
                'remarks' =>$remarks
            );
              $where = array('pro_id'=>$pro_id); 
              $this->CRUDModel->update('hr_emp_promotion',$data,$where);
              redirect('HrController/promotion'); 
           endif;
        if($id):
            $where = array('pro_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_emp_promotion',$where);

            $this->data['page_title']  = 'Update Promotion | ECMS';
            $this->data['page']        =  'hr/update_promotion';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function update_explanation()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $file_name = $image['file_name'];
            $exp_id      = $this->input->post('exp_id');
            $emp_id      = $this->input->post('emp_id');
            $date      = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $from_p      = $this->input->post('from_p');
            $details      = $this->input->post('details');
            $remarks      = $this->input->post('remarks');
            $comment      = $this->input->post('comment');
            $date_1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'date' =>$date_1,
                'letter_no' =>$letter_no,
                'from_p' =>$from_p,
                'details' =>$details,
                'remarks' =>$remarks
            );
              $where = array('exp_id'=>$exp_id); 
              $this->CRUDModel->update('hr_explanation_letter',$data,$where);
              redirect('HrController/explanation_letter'); 
           endif;
        if($id):
            $where = array('exp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_explanation_letter',$where);

            $this->data['page_title']  = 'Update Explanation Letter | ECMS';
            $this->data['page']        =  'hr/update_explanation';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function update_show_cause()
    {		
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $file_name = $image['file_name'];
            $sc_id      = $this->input->post('sc_id');
            $emp_id      = $this->input->post('emp_id');
            $date      = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $from_p      = $this->input->post('from_p');
            $details      = $this->input->post('details');
            $remarks      = $this->input->post('remarks');
            $comment      = $this->input->post('comment');
            $date_1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'date' =>$date_1,
                'letter_no' =>$letter_no,
                'from_p' =>$from_p,
                'details' =>$details,
                'remarks' =>$remarks
            );
              $where = array('sc_id'=>$exp_id); 
              $this->CRUDModel->update('hr_show_cause',$data,$where);
              redirect('HrController/show_cause'); 
           endif;
        if($id):
            $where = array('sc_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_show_cause',$where);

            $this->data['page_title']  = 'Update Explanation Letter | ECMS';
            $this->data['page']        =  'hr/update_show_cause';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function add_contract_reneval()
    {	  	
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize_letter('file','assets/images/contract_reneval');
            $file_name = $image['file_name'];
            $emp_id      = $this->input->post('emp_id');
            $from_date      = $this->input->post('fromdate');
            $to_date      = $this->input->post('todate');
            $date      = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $details      = $this->input->post('details');
            $from_p      = $this->input->post('from_p');
            $remarks      = $this->input->post('remarks');
            $date_f = date('Y-m-d', strtotime($date));
            $date_t = date('Y-m-d', strtotime($date));
            $date_1 = date('Y-m-d');
            $data       = array(
                'emp_id' =>$emp_id,
                'letter_no' =>$letter_no,
                'from_date' =>$date_f,
                'to_date' =>$date_t,
                'from_p' =>$from_p,
                'contract_date' =>$date_1,
                'details' =>$details,
                'image' =>$file_name,
                'remarks' =>$remarks
            );
            $this->CRUDModel->insert('hr_contract_reneval',$data);
            redirect('HrController/contract_reneval');
           endif;	 
            $this->data['page_title']   = 'Add Contract Reneval | ECMS';
            $this->data['page']         = 'hr/add_contract_reneval';
            $this->load->view('common/common',$this->data);
	}
    
    public function add_demotion()
    {	  	
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize_letter('file','assets/images/demotion');
            $file_name = $image['file_name'];
            $emp_id      = $this->input->post('emp_id');
            $from_scale_id      = $this->input->post('from_scale_id');
            $to_scale_id      = $this->input->post('to_scale_id');
            $from_desg_id      = $this->input->post('from_desg_id');
            $to_desg_id      = $this->input->post('to_desg_id');
            $date      = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $from_p      = $this->input->post('from_p');
            $remarks      = $this->input->post('remarks');
            $date_1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'letter_no' =>$letter_no,
                'from_scale_id' =>$from_scale_id,
                'to_scale_id' =>$to_scale_id,
                'from_desg_id' =>$from_desg_id,
                'to_desg_id' =>$to_desg_id,
                'from_p' =>$from_p,
                'dem_date' =>$date_1,
                'image' =>$file_name,
                'remarks' =>$remarks
            );
            $this->CRUDModel->insert('hr_emp_demotion',$data);
            redirect('HrController/demotion');
           endif;	 
            $this->data['page_title']   = 'Add Demotion | ECMS';
            $this->data['page']         = 'hr/add_demotion';
            $this->load->view('common/common',$this->data);
	}
    
    public function add_promotion()
    {	  	
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize_letter('file','assets/images/promotion');
            $file_name = $image['file_name'];
            $emp_id      = $this->input->post('emp_id');
            $from_scale_id      = $this->input->post('from_scale_id');
            $to_scale_id      = $this->input->post('to_scale_id');
            $from_desg_id      = $this->input->post('from_desg_id');
            $to_desg_id      = $this->input->post('to_desg_id');
            $date      = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $from_p      = $this->input->post('from_p');
            $remarks      = $this->input->post('remarks');
            $date_1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'letter_no' =>$letter_no,
                'from_scale_id' =>$from_scale_id,
                'to_scale_id' =>$to_scale_id,
                'from_desg_id' =>$from_desg_id,
                'to_desg_id' =>$to_desg_id,
                'from_p' =>$from_p,
                'pro_date' =>$date_1,
                'image' =>$file_name,
                'remarks' =>$remarks
            );
            $this->CRUDModel->insert('hr_emp_promotion',$data);
            redirect('HrController/promotion');
        endif;	 
            $this->data['page_title']   = 'Add Promotion | ECMS';
            $this->data['page']         = 'hr/add_promotion';
            $this->load->view('common/common',$this->data);
	}
    
    public function add_explanation()
    {	  	
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize_letter('file','assets/images/explanation_letters');
            $file_name = $image['file_name'];
            $emp_id      = $this->input->post('emp_id');
            $date      = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $from_p      = $this->input->post('from_p');
            $details      = $this->input->post('details');
            $remarks      = $this->input->post('remarks');
            $comment      = $this->input->post('comment');
            $date_1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'date' =>$date_1,
                'letter_no' =>$letter_no,
                'from_p' =>$from_p,
                'details' =>$details,
                'image' =>$file_name,
                'remarks' =>$remarks
            );
            $this->CRUDModel->insert('hr_explanation_letter',$data);
            redirect('HrController/explanation_letter');
        endif;	 
            $this->data['page_title']   = 'Add Explanation | ECMS';
            $this->data['page']         = 'hr/add_explanation_letter';
            $this->load->view('common/common',$this->data);
	}
    
    public function add_show_cause()
    {	  	
        if($this->input->post()):
            $image = $this->CRUDModel->do_resize_letter('file','assets/images/show_cause');
            $file_name = $image['file_name'];
            $emp_id      = $this->input->post('emp_id');
            $date      = $this->input->post('date');
            $letter_no      = $this->input->post('letter_no');
            $from_p      = $this->input->post('from_p');
            $details      = $this->input->post('details');
            $remarks      = $this->input->post('remarks');
            $comment      = $this->input->post('comment');
            $date_1 = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'date' =>$date_1,
                'letter_no' =>$letter_no,
                'from_p' =>$from_p,
                'details' =>$details,
                'image' =>$file_name,
                'remarks' =>$remarks
            );
            $this->CRUDModel->insert('hr_show_cause',$data);
            redirect('HrController/show_cause');
        endif;	 
            $this->data['page_title']   = 'Add Show Cause | ECMS';
            $this->data['page']         = 'hr/add_show_cause';
            $this->load->view('common/common',$this->data);
	}
	
	public function delete_acr()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('acr_id'=>$id);
        $this->CRUDModel->deleteid('hr_emp_acr',$where);
        redirect('HrController/acr');
	}
	
	public function acr()
    {       
        $this->data['result']       = $this->HrModel->emp_acr();
        $this->data['page_title']   = 'ACR | ECMS';
        $this->data['page']         = 'hr/acr';
        $this->load->view('common/common',$this->data);
    }
	
	public function add_acr()
    {	  	
        if($this->input->post()):
            $image1 = $this->CRUDModel->do_resize_letter('file_1','assets/images/acr');
            $image2 = $this->CRUDModel->do_resize_letter('file_2','assets/images/acr');
            $image3 = $this->CRUDModel->do_resize_letter('file_3','assets/images/acr');
            $image4 = $this->CRUDModel->do_resize_letter('file_4','assets/images/acr');
            $image5 = $this->CRUDModel->do_resize_letter('file_5','assets/images/acr');
            $file_name1 = $image1['file_name'];
            $file_name2 = $image2['file_name'];
            $file_name3 = $image3['file_name'];
            $file_name4 = $image4['file_name'];
            $file_name5 = $image5['file_name'];
            $emp_id      = $this->input->post('emp_id');
            $date      = $this->input->post('submitted_date');
            $date = date('Y-m-d', strtotime($date));
            $data       = array(
                'emp_id' =>$emp_id,
                'submitted_date' =>$date,
                'image_1' =>$file_name1,
                'image_2' =>$file_name2,
                'image_3' =>$file_name3,
                'image_4' =>$file_name4,
                'image_5' =>$file_name5
            );
            $this->CRUDModel->insert('hr_emp_acr',$data);
            redirect('HrController/acr');
           endif;	 
            $this->data['page_title']   = 'Add New ACR | ECMS';
            $this->data['page']         = 'hr/add_acr';
            $this->load->view('common/common',$this->data);
	}
	
}
