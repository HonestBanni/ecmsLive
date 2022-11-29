<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class PayrollController extends AdminController {

     public function __construct() {
             parent::__construct();
            $this->load->model('HrModel');
            $this->load->model('PayrollModel');
    }
   
    public function financial_year(){
            $this->data['status']       = $this->CRUDModel->dropDown('common_status', '', 'cs_id', 'cs_title','',array('order'=>'asc','column'=>'cs_status_order'));            
            $this->data['page_headr']   = 'Financial Year';
            $this->data['page_title']   = 'Payroll Category | ECMS';
            $this->data['page']         = 'Payroll/setups/financial_year_v';
            $this->load->view('common/common',$this->data);
        }
      public function financial_year_grid(){
        if($this->input->post('request')    == 'ShowRecords'):
            $this->data['result']           =  $this->PayrollModel->get_finincial_year('financial_year');
            $this->load->view('Payroll/setups/jquery_results/finincial_year_grid',$this->data);
        endif;
        
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('fy_year','','required|is_unique[financial_year.fy_year]', array('required'=>'1','is_unique'=>'2'));
            
            $this->form_validation->set_rules('fy_start_day', '', 'required', array('required'=>'3'));
            $this->form_validation->set_rules('fy_start_month', '', 'required', array('required'=>'3'));
            $this->form_validation->set_rules('fy_start_year', '', 'required', array('required'=>'3'));
            
            $this->form_validation->set_rules('fy_end_day', '', 'required', array('required'=>'4'));
            $this->form_validation->set_rules('fy_end_month', '', 'required', array('required'=>'4'));
            $this->form_validation->set_rules('fy_end_year', '', 'required', array('required'=>'4'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Financial year is required.'; break;
                    case 2: $return_json['e_text'] = 'Financial year already exist.'; break;
                    case 3: $return_json['e_text'] = 'Financial year start date is required'; break;
                    case 4: $return_json['e_text'] = 'Financial year end date already exist.'; break;
                endswitch;
        else:
            if($this->input->post('category_status') == 1):
                $this->CRUDModel->update('financial_year',array('fy_default_active'=>0),array('fy_status'=>1));
            endif;
            
            
            $data = array(
                'fy_year'               => $this->input->post('fy_year'),
                'fy_year_start'         => $this->input->post('fy_start_year').'-'.$this->input->post('fy_start_month').'-'.$this->input->post('fy_start_day'),
                'fy_year_end'           => $this->input->post('fy_end_year').'-'.$this->input->post('fy_end_month').'-'.$this->input->post('fy_end_day'),
                'fy_default_active'     => $this->input->post('category_status'),
                'fy_create_by'          => $this->UserInfo->user_id,
                'fy_date_time'          => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('financial_year',$data);
             $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'ShowRecord'):
            echo  json_encode($this->CRUDModel->get_where_row('financial_year',array('fy_id'=>$this->input->post('pk_id'))));
        endif;
//       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $pk_id          = $this->input->post('pk_id');
            $fy_year        = $this->input->post('fy_year');
            
            $this->form_validation->set_rules('fy_year', '', 'required|edit_unique[financial_year,fy_year,'.$fy_year.',fy_id,'.$pk_id.']', array('required'=>'1','edit_unique'=>'2'));
            
            $this->form_validation->set_rules('fy_start_day', '', 'required', array('required'=>'3'));
            $this->form_validation->set_rules('fy_start_month', '', 'required', array('required'=>'3'));
            $this->form_validation->set_rules('fy_start_year', '', 'required', array('required'=>'3'));
            
            $this->form_validation->set_rules('fy_end_day', '', 'required', array('required'=>'4'));
            $this->form_validation->set_rules('fy_end_month', '', 'required', array('required'=>'4'));
            $this->form_validation->set_rules('fy_end_year', '', 'required', array('required'=>'4'));
            
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Financial year is required.'; break;
                    case 2: $return_json['e_text'] = 'Financial year already exist.'; break;
                    case 3: $return_json['e_text'] = 'Financial year start date is required'; break;
                    case 4: $return_json['e_text'] = 'Financial year end date already exist.'; break;
                endswitch;
        else:
            
            if($this->input->post('category_status') == 1):
                $this->CRUDModel->update('financial_year',array('fy_default_active'=>0),array('fy_status'=>1));
            endif;
            
            $data = array(
                'fy_year'               => $this->input->post('fy_year'),
                'fy_year_start'         => $this->input->post('fy_start_year').'-'.$this->input->post('fy_start_month').'-'.$this->input->post('fy_start_day'),
                'fy_year_end'           => $this->input->post('fy_end_year').'-'.$this->input->post('fy_end_month').'-'.$this->input->post('fy_end_day'),
                'fy_default_active'     => $this->input->post('category_status'),
             );
             $this->CRUDModel->update('financial_year',$data,array('fy_id'=>$pk_id));
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record update successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'DeleteRecord'):
            $where      = array('fy_id'=>$this->input->post('pk_id'));
            $this->CRUDModel->deleteid('financial_year',$where);
        endif;
    } 
    public function payroll_category(){
            $this->data['status']       = $this->CRUDModel->dropDown('common_status', '', 'cs_id', 'cs_title','',array('order'=>'asc','column'=>'cs_status_order'));            
            $this->data['page_headr']   = 'Allowance Category';
            $this->data['page_title']   = 'Allowance Category | ECMS';
            $this->data['page']         = 'Payroll/setups/payroll_categories_v';
            $this->load->view('common/common',$this->data);
        }
 
    public function payroll_category_grid(){
        if($this->input->post('request')    == 'ShowRecords'):
            $this->data['result']           =  $this->PayrollModel->get_payroll_categories();
            $this->load->view('Payroll/setups/jquery_results/payroll_categories_grid',$this->data);
        endif;
        
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('category_code','','required|is_unique[pr_allowance.pr_allow_code]', array('required'=>'1','is_unique'=>'2'));
            $this->form_validation->set_rules('category_name','','required|is_unique[pr_allowance.pr_allow_name]', array('required'=>'3','is_unique'=>'4'));
                    
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category code is required.'; break;
                    case 2: $return_json['e_text'] = 'Category code already exist.'; break;
                    case 3: $return_json['e_text'] = 'Category name is required.'; break;
                    case 4: $return_json['e_text'] = 'Category name already exist.'; break;
                endswitch;
        else:
            $data = array(
                'pr_allow_code'        => $this->input->post('category_code'),
                'pr_allow_name'        => strtoupper($this->input->post('category_name')),
                'pr_allow_status'      => $this->input->post('category_status'),
                'pr_allow_create_by'   => $this->UserInfo->user_id,
                'pr_allow_time_stamp'  => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('pr_allowance',$data);
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'ShowRecord'):
            echo  json_encode($this->CRUDModel->get_where_row('pr_allowance',array('pr_allow_id'=>$this->input->post('pk_id'))));
        endif;
//       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $category_id            = $this->input->post('pk_id');
            $category_code          = $this->input->post('category_code');
            $category_name          = strtoupper($this->input->post('category_name'));
            $category_status        = $this->input->post('category_status');
            
            
            $this->form_validation->set_rules('category_code', '', 'required|edit_unique[pr_allowance,pr_allow_code,'.$category_code.',pr_allow_id,'.$category_id.']', array('required'=>'1','edit_unique'=>'2'));
            $this->form_validation->set_rules('category_name', '', 'required|edit_unique[pr_allowance,pr_allow_name,'.$category_name.',pr_allow_id,'.$category_id.']', array('required'=>'3','edit_unique'=>'4'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category code is required.'; break;
                    case 2: $return_json['e_text'] = 'Category code already exist.'; break;
                    case 3: $return_json['e_text'] = 'Category name is required.'; break;
                    case 4: $return_json['e_text'] = 'Category name already exist.'; break;
                endswitch;
        else:

            $data = array(
                'pr_allow_code'        => $category_code,
                'pr_allow_name'        => $category_name,
                'pr_allow_status'      => $category_status,
             );
             $this->CRUDModel->update('pr_allowance',$data,array('pr_allow_id'=>$category_id));
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record update successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'DeleteRecord'):
            $where      = array('pr_allow_id'=>$this->input->post('pk_id'));
            $this->CRUDModel->deleteid('pr_allowance',$where);
        endif;
    } 
    public function payroll_categories_type(){
         $this->data['status']       = $this->CRUDModel->dropDown('common_status', '', 'cs_id', 'cs_title','',array('order'=>'asc','column'=>'cs_status_order'));            
         $this->data['Category']     = $this->CRUDModel->DropDown_Code('pr_allowance', 'CATEGORY', 'pr_allow_id', 'pr_allow_name','pr_allow_code');            
         $this->data['page_headr']   = 'Allowance Type';
         $this->data['page_title']   = 'Allowance Type | ECMS';
         $this->data['page']         = 'Payroll/setups/payroll_categories_type_v';
         $this->load->view('common/common',$this->data);
     }                
    public function payroll_category_type_grid(){
        if($this->input->post('request')    == 'ShowRecords'):
            
            $this->load->view('Payroll/setups/jquery_results/payroll_categories_type_grid',$this->data);
        endif;
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $category                   = $this->input->post('category');
            $category_type_code         = $this->input->post('category_type_code');
            $category_type_name         = strtoupper($this->input->post('category_type_name'));
            
            $this->form_validation->set_rules('category','','required', array('required'=>'1'));
            $this->form_validation->set_rules('category_type_code', '', 'required', array('required'=>'2'));
            $this->form_validation->set_rules('category_type_name', '', 'required', array('required'=>'3'));

            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category is required.'; break;
                    case 2: $return_json['e_text'] = 'Category type code is required.'; break;
                    case 3: $return_json['e_text'] = 'Category type name required.'; break;
                endswitch;
        else:
            $where_code_chk = array(
                'allow_type_code'           => $category_type_code,
                'allow_type_category_id'    => $category,
            );
            $check_type_code = $this->CRUDModel->get_where_row('pr_allowance_types',$where_code_chk);
            $where_name_chk = array(
                'allow_type_name'           => $category_type_name,
                'allow_type_category_id'    => $category,
            );
            $check_type_name = $this->CRUDModel->get_where_row('pr_allowance_types',$where_name_chk);
            if(!empty($check_type_code)):
                 $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Category type code already exist.'
                    );
            elseif($check_type_name):
               $return_json = array(
                        'e_status'  => false,
                        'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                        'e_type'    => 'WARNING',
                        'e_text'    => 'Category type name already exist.'
                        );
            else:
                $data = array(
                'allow_type_category_id'    => $category,
                'allow_type_code'           => $category_type_code,
                'allow_type_name'           => $category_type_name,
                'allow_type_status'         => $this->input->post('category_status'),
                'allow_type_create_by'      => $this->UserInfo->user_id,
                'allow_type_time_stamp'     => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('pr_allowance_types',$data);
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
            
            
            
            
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'ShowRecord'):
            echo  json_encode($this->CRUDModel->get_where_row('pr_allowance_types',array('allow_type_id'=>$this->input->post('pk_id'))));
        endif;
//       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $category_type_id           = $this->input->post('pk_id');
            $category                   = $this->input->post('category');
            $category_type_code         = $this->input->post('category_type_code');
            $category_type_name         = strtoupper($this->input->post('category_type_name'));
            
            $this->form_validation->set_rules('category','','required', array('required'=>'1'));
            $this->form_validation->set_rules('category_type_code', '', 'required', array('required'=>'2'));
            $this->form_validation->set_rules('category_type_name', '', 'required', array('required'=>'3'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category is required.'; break;
                    case 2: $return_json['e_text'] = 'Category type code is required.'; break;
                    case 3: $return_json['e_text'] = 'Category type name required.'; break;
                endswitch;
        else:
            
            
             $where_code_chk = array(
                'allow_type_code'           => $category_type_code,
                'allow_type_category_id'    => $category,
                'allow_type_id !='          => $category_type_id,
            );
            $check_type_code = $this->CRUDModel->get_where_row('pr_allowance_types',$where_code_chk);
            $where_name_chk = array(
                'allow_type_name'           => $category_type_name,
                'allow_type_category_id'    => $category,
                'allow_type_id !='          => $category_type_id,
            );
            $check_type_name = $this->CRUDModel->get_where_row('pr_allowance_types',$where_name_chk);
            if(!empty($check_type_code)):
                 $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Category type code already exist.'
                    );
            elseif($check_type_name):
               $return_json = array(
                        'e_status'  => false,
                        'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                        'e_type'    => 'WARNING',
                        'e_text'    => 'Category type name already exist.'
                        );
            else:
                $data = array(
                'allow_type_category_id'    => $category,
                'allow_type_code'           => $category_type_code,
                'allow_type_name'           => $category_type_name,
                'allow_type_status'         => $this->input->post('category_status'),
                'allow_type_create_by'      => $this->UserInfo->user_id,
                'allow_type_time_stamp'     => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->update('pr_allowance_types',$data,array('allow_type_id'=>$category_type_id));
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record update successfully.'
                );
            endif;
            
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'DeleteRecord'):
            $where      = array('allow_type_id'=>$this->input->post('pk_id'));
            $this->CRUDModel->deleteid('pr_allowance_types',$where);
        endif;
    }               
   public function employee_salary(){
       $this->data['emp_name']         = '';
            $this->data['father_name']      = '';
            $this->data['gender_id']        = '';
            $this->data['department_id']    = '';
            $this->data['designation_id']   = '';
            $this->data['scale_id']         = '';
            $this->data['category_id']      = '';
            $this->data['contract_id']      = '';
            $this->data['status_id']        = '';
            $this->data['payroll_code']     = '';
            
               //Dropdowns 
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
            $this->data['department']   = $this->CRUDModel->dropDown('hr_emp_departments', 'Department', 'emp_deprt_id', 'emp_deprt_name','',array('column'=>'emp_deprt_name','order'=>'asc'));
            $this->data['designation']  = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'emp_desg_name','',array('column'=>'emp_desg_name','order'=>'asc'));
            $this->data['scale']        = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'scale_name','',array('column'=>'scale_order','order'=>'asc'));
            $this->data['category']     = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'category_id', 'category_name');
            $this->data['contract_tp']  = $this->CRUDModel->dropDown('hr_emp_category_type', 'Contract Type', 'category_type_id', 'ctgy_type_name');
            $this->data['status']       = $this->CRUDModel->dropDown('hr_emp_status', 'Status', 'emp_status_id', 'emp_status_name');
        
            
        if($this->input->post()):
                $emp_name               =  $this->input->post('emp_name');
                $father_name            =  $this->input->post('father_name');
                $gender_id              =  $this->input->post('gender_id');
                $department_id          =  $this->input->post('department_id');
                $current_designation    =  $this->input->post('current_designation');
                $c_emp_scale_id         =  $this->input->post('c_emp_scale_id');
                $category               =  $this->input->post('hr_category');
                $contract               =  $this->input->post('hr_contract');
                $emp_status_id          =  $this->input->post('status');
                $payroll_code           =  $this->input->post('payroll_code');
                
                
                
                //like Array
                $like   = array();
                $where  = array();
                    if(!empty($payroll_code)):
                        $like['emp_personal_no']    = $payroll_code;
                        $this->data['payroll_code'] = $payroll_code;
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
                        $this->data['gender_id']   = $gender_id;
                    endif;
                    if(!empty($department_id)):
                        $where['department.department_id']  = $department_id;
                        $this->data['department_id']        = $department_id;
                    endif;
                    if(!empty($current_designation)):
                        $where['hr_emp_designation.emp_desg_id'] = $current_designation;
                        $this->data['designation_id']  = $current_designation;
                    endif;
                    if(!empty($c_emp_scale_id)):
                        $where['hr_emp_scale.emp_scale_id'] = $c_emp_scale_id;
                        $this->data['scale_id']  = $c_emp_scale_id;
                    endif;
                    if(!empty($category)):
                        $where['hr_emp_category.cat_id']    = $category;
                        $this->data['category_id']               = $category;
                    endif;
                    if(!empty($contract)):
                        $where['hr_emp_contract_type.contract_type_id'] = $contract;
                        $this->data['contract_id']                 = $contract;
                    endif;
                    if(!empty($emp_status_id)):
                        $where['hr_emp_record.emp_status_id'] = $emp_status_id;
                        $this->data['status_id']  = $emp_status_id;
                    endif;
                     
                    $this->data['result']   = $this->HrModel->get_employee_detail_record($where,$like,NULL);
        endif;
            
            $this->data['breadcrumbs'] = 'Employee Salery';
            $this->data['page_title']   = 'Employee Salery | ECMS';
            $this->data['page']         = 'Payroll/Forms/employee_salary_v';
            $this->load->view('common/common',$this->data); 
   }
   public function payroll_steps() {
       
        $this->data['breadcrumbs'] = 'Salery Steps';
        $this->data['page_title']   = 'Salery Steps | ECMS';
        $this->data['page']         = 'Payroll/setups/steps_v';
        $this->load->view('common/common',$this->data); 
   }
   
    public function payroll_steps_grid(){
        if($this->input->post('request')    == 'ShowRecords'):
            $this->data['result']           =  $this->CRUDModel->getResults('hr_emp_steps');
            $this->load->view('Payroll/setups/jquery_results/steps_grid',$this->data);
        endif;
        
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('step','','required|is_unique[hr_emp_steps.steps_name]', array('required'=>'1','is_unique'=>'2'));
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Step is required.'; break;
                    case 2: $return_json['e_text'] = 'Step already exist.'; break;
                    
                endswitch;
        else:
            $data = array(
                'steps_name'        => strtoupper($this->input->post('step')),
                'steps_create_by'   => $this->UserInfo->user_id,
                'steps_date_time'   => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('hr_emp_steps',$data);
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'ShowRecord'):
            echo  json_encode($this->CRUDModel->get_where_row('hr_emp_steps',array('emp_steps_id'=>$this->input->post('pk_id'))));
        endif;
//       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $pk_id            = $this->input->post('pk_id');
            $step          = strtoupper($this->input->post('step'));
            
            $this->form_validation->set_rules('step', '', 'required|edit_unique[hr_emp_steps,steps_name,'.$step.',emp_steps_id,'.$pk_id.']', array('required'=>'1','edit_unique'=>'2'));
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Step is required.'; break;
                    case 2: $return_json['e_text'] = 'Step already exist.'; break;
                    
                endswitch;
        else:

            $data = array(
               'steps_name'        =>strtoupper($this->input->post('step')),
             );
             $this->CRUDModel->update('hr_emp_steps',$data,array('emp_steps_id'=>$pk_id));
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record update successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'DeleteRecord'):
            $where      = array('emp_steps_id'=>$this->input->post('pk_id'));
            $this->CRUDModel->deleteid('hr_emp_steps',$where);
        endif;
    }
    public function pay_scale() {
        $this->data['Fy']       = $this->CRUDModel->dropDown('financial_year', 'Select Financial Year', 'fy_id', 'fy_year','',array('column'=>'fy_year','order'=>'desc'));   
        $this->data['BPS']      = $this->CRUDModel->dropDown('hr_emp_scale', 'SCALE', 'emp_scale_id', 'scale_name','',array('column'=>'scale_order','order'=>'asc'));   
        $this->data['status']   = $this->CRUDModel->dropDown('common_status', '', 'cs_id', 'cs_title','',array('order'=>'asc','column'=>'cs_status_order'));            
        
        $this->data['breadcrumbs'] = 'Salary Scale';
        $this->data['page_title']   = 'Salary Scale | ECMS';
        $this->data['page']         = 'Payroll/setups/pay_scale_v';
        $this->load->view('common/common',$this->data); 
   }
    public function pay_scale_details(){
        if($this->input->post('request')    == 'ShowRecordsDemo'):
            $this->data['result']           =  $this->PayrollModel->get_pay_scale_demo(array('form_code'=>$this->input->post('formCode')));
            $this->load->view('Payroll/setups/jquery_results/pay_scale_grid_demo',$this->data);
        endif;
        if($this->input->post('request')    == 'ShowPayscaleGrid'):
            $this->data['result']           =  $this->PayrollModel->get_pay_scale();
            $this->load->view('Payroll/setups/jquery_results/pay_scale_grid',$this->data);
        endif;
        if($this->input->post('request')    == 'PayScallDetails'):
            $this->data['result']           =  $this->PayrollModel->get_pay_scale_popup($this->input->post('pk_id'));
//              echo '<pre>';print_r( $this->data['result']);die;      
            $this->load->view('Payroll/setups/jquery_results/pay_scale_popup',$this->data);
        endif;
        
        if($this->input->post('request') == 'PayScaleDetailsDemo'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('bps','','required', array('required'=>'1'));
            $this->form_validation->set_rules('minimum','','required', array('required'=>'2'));
            $this->form_validation->set_rules('roi','','required', array('required'=>'3'));
            $this->form_validation->set_rules('maximum','','required', array('required'=>'4'));
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Pay Scale is required.'; break;
                    case 2: $return_json['e_text'] = 'Minimum is required.'; break;
                    case 3: $return_json['e_text'] = 'Rate of Increase is required.'; break;
                    case 4: $return_json['e_text'] = 'Maximum is required.'; break;
                    
                endswitch;
        else:
            
            $minimum    = $this->input->post('minimum');
            $roi        = $this->input->post('roi');
            $maximum    = $this->input->post('maximum');
            $bps        = $this->input->post('bps');
            $formCode   = $this->input->post('formCode');
                    
            $steps  = 0;
            $step_wise_basic_pay  = '';
            
            while($minimum < $maximum):
              $step_wise_basic_pay =  $minimum+=$roi;
                $steps++;
            endwhile;
            $where_chk = array(
                'form_code'      => $formCode,
                'psd_pay_scale'  => $bps,
            );
           $chk_bps =  $this->CRUDModel->get_where_row('pr_pay_scale_details_demo',$where_chk);
        if($chk_bps):
            $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Pay Scale already exist.'
                    );
         elseif($maximum != $step_wise_basic_pay):
              $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Please Check Minimum,RoI and Maximum values'
                    );
            else:
               $data = array(
                    'psd_pay_scale'  => $bps,
                    'psd_roi'        => $roi,
                    'psd_min'        => $this->input->post('minimum'),
                    'psd_max'        => $this->input->post('maximum'),
                    'psd_max_steps'  => $steps,
                    'form_code'      => $formCode,
                );
            $this->CRUDModel->insert('pr_pay_scale_details_demo',$data); 
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
        endif;
            
            
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'SavePayScale'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
                    
            
             $this->form_validation->set_rules('Fy','','required', array('required'=>'1'));
             $this->form_validation->set_rules('ps_day','','required', array('required'=>'2'));
             $this->form_validation->set_rules('ps_month','','required', array('required'=>'2'));
             $this->form_validation->set_rules('ps_year','','required', array('required'=>'2'));
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Financial Year is required.'; break;
                    case 2: $return_json['e_text'] = 'Date is required'; break;
                endswitch;
        else:
            
            if($this->input->post('status') == 1):
                $check_status = $this->CRUDModel->update('pr_pay_scale',array('ps_status'=>0),array('ps_status'=>1));
            endif;
            $get_record = $this->CRUDModel->get_where_result('pr_pay_scale_details_demo',array('form_code'=>$this->input->post('formCode')));
            
                $data = array(
                    'ps_date'           => $this->input->post('ps_year').'-'.$this->input->post('ps_month').'-'.$this->input->post('ps_day'),
                    'ps_fy_id'          => $this->input->post('Fy'),
                    'ps_status'         => $this->input->post('status'),
                    'ps_remarks'        => $this->input->post('remarks'),
                    'ps_create_by'      => $this->UserInfo->user_id,
                    'ps_time_stamp'     => date("Y-m-d H:i:s"),
                    
                );
            $getid = $this->CRUDModel->insert('pr_pay_scale',$data); 
            
            if($get_record):
                foreach($get_record as $row):
                $data_dd = array(
                        'psd_ps_id'      => $getid,
                        'psd_pay_scale'  => $row->psd_pay_scale,
                        'psd_roi'        => $row->psd_roi,
                        'psd_min'        => $row->psd_min,
                        'psd_max'        => $row->psd_max,
                        'psd_max_steps'  => $row->psd_max_steps,
                        'psd_create_by'   => $this->UserInfo->user_id,
                        'psd_date_time'  => date("Y-m-d H:i:s"),
                    );
                $this->CRUDModel->insert('pr_pay_scale_details',$data_dd);
                endforeach;
            $this->CRUDModel->deleteid('pr_pay_scale_details_demo',array('form_code'=>$this->input->post('formCode')));
            endif;
            
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record update successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'DeleteRecordDemo'):
            $where      = array('psd_id'=>$this->input->post('pk_id'));
            $this->CRUDModel->deleteid('pr_pay_scale_details_demo',$where);
        endif;
        if($this->input->post('request') == 'DeleteRecord'):
            $this->CRUDModel->deleteid('pr_pay_scale_details',array('psd_ps_id'=>$this->input->post('pk_id')));
            $this->CRUDModel->deleteid('pr_pay_scale',array('ps_id'=>$this->input->post('pk_id')));
        endif;
    }  
    public function pay_scale_print(){
        $this->data['result']       =  $this->PayrollModel->get_pay_scale_popup($this->uri->segment(2));
        $this->data['breadcrumbs']  = 'Revised pay scale view / print';
        $this->data['page_title']   = 'Revised pay scale view / print | ECMS';
        $this->data['page']         = 'Payroll/Prints/pay_scale_view_print';
        $this->load->view('common/common',$this->data);
            
    }
  
    public function pay_scale_edit(){
        $this->data['Fy']       = $this->CRUDModel->dropDown('financial_year', 'Select Financial Year', 'fy_id', 'fy_year','',array('column'=>'fy_year','order'=>'desc'));   
        $this->data['BPS']      = $this->CRUDModel->dropDown('hr_emp_scale', 'SCALE', 'emp_scale_id', 'scale_name',array('scale_flag'=>1),array('column'=>'scale_order','order'=>'asc'));   
        $this->data['status']   = $this->CRUDModel->dropDown('common_status', '', 'cs_id', 'cs_title','',array('order'=>'asc','column'=>'cs_status_order')); 
        
        $this->data['result']           =  $this->CRUDModel->get_where_row('pr_pay_scale',array('ps_id'=>$this->uri->segment(2)));
        
//        echo '<pre>';print_r($this->data['result']);die;
        $this->data['breadcrumbs']  = 'Revised pay scale edit';
        $this->data['page_title']   = 'Revised pay scale edit | ECMS';
        $this->data['page']         = 'Payroll/setups/pay_scale_edit_v';
        $this->load->view('common/common',$this->data);
            
    }
      public function pay_scale_details_edit(){
         if($this->input->post('request')    == 'showEditGrid'):
            $this->data['result']           =  $this->PayrollModel->get_pay_edit_grid(array('psd_ps_id'=>$this->input->post('pk_id')));
            $this->load->view('Payroll/setups/jquery_results/pay_scale_edit_grid',$this->data);
        endif;
        if($this->input->post('request') == 'DeleteRecordEdit'):
            $where      = array('psd_id'=>$this->input->post('pk_id'));
            $this->CRUDModel->deleteid('pr_pay_scale_details',$where);
        endif;
        if($this->input->post('request') == 'getRecordEdit'):
            echo  json_encode($this->CRUDModel->get_where_row('pr_pay_scale_details',array('psd_id'=>$this->input->post('pk_id'))));
        endif;
        if($this->input->post('request') == 'PayScaleDetails'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('bps','','required', array('required'=>'1'));
            $this->form_validation->set_rules('minimum','','required', array('required'=>'2'));
            $this->form_validation->set_rules('roi','','required', array('required'=>'3'));
            $this->form_validation->set_rules('maximum','','required', array('required'=>'4'));
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Pay Scale is required.'; break;
                    case 2: $return_json['e_text'] = 'Minimum is required.'; break;
                    case 3: $return_json['e_text'] = 'Rate of Increase is required.'; break;
                    case 4: $return_json['e_text'] = 'Maximum is required.'; break;
                    
                endswitch;
        else:
            
            $minimum    = $this->input->post('minimum');
            $roi        = $this->input->post('roi');
            $maximum    = $this->input->post('maximum');
            $bps        = $this->input->post('bps');
            $pk_id   = $this->input->post('pk_id');
                    
            $steps  = 0;
            $step_wise_basic_pay  = '';
            
            while($minimum < $maximum):
              $step_wise_basic_pay =  $minimum+=$roi;
                $steps++;
            endwhile;
            $where_chk = array(
                'psd_ps_id'      => $pk_id,
                'psd_pay_scale'  => $bps,
            );
           $chk_bps =  $this->CRUDModel->get_where_row('pr_pay_scale_details',$where_chk);
        if($chk_bps):
            $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Pay Scale already exist.'
                    );
         elseif($maximum != $step_wise_basic_pay):
              $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Please Check Minimum,RoI and Maximum values'
                    );
            else:
               $data = array(
                    'psd_ps_id'      => $pk_id,
                    'psd_pay_scale'  => $bps,
                    'psd_roi'        => $roi,
                    'psd_min'        => $this->input->post('minimum'),
                    'psd_max'        => $this->input->post('maximum'),
                    'psd_max_steps'  => $steps,
                );
            $this->CRUDModel->insert('pr_pay_scale_details',$data); 
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
        endif;
            
            
             echo json_encode($return_json); 
        endif;
         if($this->input->post('request') == 'SavePayScale'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
                    
            
             $this->form_validation->set_rules('Fy','','required', array('required'=>'1'));
             $this->form_validation->set_rules('ps_day','','required', array('required'=>'2'));
             $this->form_validation->set_rules('ps_month','','required', array('required'=>'2'));
             $this->form_validation->set_rules('ps_year','','required', array('required'=>'2'));
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Financial Year is required.'; break;
                    case 2: $return_json['e_text'] = 'Date is required'; break;
                endswitch;
        else:
            if($this->input->post('status') == 1):
                $check_status = $this->CRUDModel->update('pr_pay_scale',array('ps_status'=>0),array('ps_status'=>1));
            endif;
            
            
             $data = array(
                    'ps_date'           => $this->input->post('ps_year').'-'.$this->input->post('ps_month').'-'.$this->input->post('ps_day'),
                    'ps_fy_id'          => $this->input->post('Fy'),
                    'ps_status'         => $this->input->post('status'),
                    'ps_remarks'        => $this->input->post('remarks'),
               );
            $this->CRUDModel->update('pr_pay_scale',$data,array('ps_id'=>$this->input->post('pk_id'))); 
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record update successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'PayScaleDetailsUpdate'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('bps','','required', array('required'=>'1'));
            $this->form_validation->set_rules('minimum','','required', array('required'=>'2'));
            $this->form_validation->set_rules('roi','','required', array('required'=>'3'));
            $this->form_validation->set_rules('maximum','','required', array('required'=>'4'));
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Pay Scale is required.'; break;
                    case 2: $return_json['e_text'] = 'Minimum is required.'; break;
                    case 3: $return_json['e_text'] = 'Rate of Increase is required.'; break;
                    case 4: $return_json['e_text'] = 'Maximum is required.'; break;
                    
                endswitch;
        else:
            
            $minimum    = $this->input->post('minimum');
            $roi        = $this->input->post('roi');
            $maximum    = $this->input->post('maximum');
            $bps        = $this->input->post('bps');
            $pk_id      = $this->input->post('pk_id');
            $pk_sd_id   = $this->input->post('pk_sd_id');
                    
            $steps  = 0;
            $step_wise_basic_pay  = '';
            
            while($minimum < $maximum):
              $step_wise_basic_pay =  $minimum+=$roi;
                $steps++;
            endwhile;
            $where_chk = array(
                'psd_ps_id'      => $pk_id,
                'psd_id !='      => $pk_sd_id,
                'psd_pay_scale'  => $bps,
                
            );
           $chk_bps =  $this->CRUDModel->get_where_row('pr_pay_scale_details',$where_chk);
        if($chk_bps):
            $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Pay Scale already exist.'
                    );
         elseif($maximum != $step_wise_basic_pay):
              $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Please Check Minimum,RoI and Maximum values'
                    );
            else:
               $data = array(
                    'psd_pay_scale'  => $bps,
                    'psd_roi'        => $roi,
                    'psd_min'        => $this->input->post('minimum'),
                    'psd_max'        => $this->input->post('maximum'),
                    'psd_max_steps'  => $steps,
                    
                );
            $this->CRUDModel->update('pr_pay_scale_details',$data,array('psd_id'=> $pk_sd_id,)); 
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
        endif;
            
            
             echo json_encode($return_json); 
        endif;
    }
   public function pay_scale_allowance() {
       
        $fy                             = $this->CRUDModel->get_where_row('pr_pay_scale',array('ps_id'=>$this->uri->segment(2)));
        $this->data['pay_type']         = $this->CRUDModel->dropDown('pr_allowance_types', 'ALLOWANCE TYPE', 'allow_type_id', 'allow_type_name',array('allow_type_category_id'=>1),array('order'=>'asc','column'=>'allow_type_name'));
        $this->data['BPS']              = $this->CRUDModel->dropDown('hr_emp_scale', 'SELECT BPS', 'emp_scale_id', 'scale_name',array('scale_flag'=>1),array('column'=>'scale_order','order'=>'asc'));
        $this->data['Fy']               = $this->CRUDModel->dropDown('financial_year', '', 'fy_id', 'fy_year',array('fy_id'=>$fy->ps_fy_id),array('column'=>'fy_year','order'=>'desc')); 
        $this->data['breadcrumbs']      = 'Pay scale Allowance';
        $this->data['page_title']       = 'Pay scale Allowance | ECMS';
        $this->data['page']             = 'Payroll/setups/payroll_payscale_allowance_v';
        $this->load->view('common/common',$this->data); 
   }
   public function pay_scale_allowance_grid() {
        if($this->input->post('request')    == 'show'):
            $this->load->view('Payroll/setups/jquery_results/pay_scale_allowance_grid',$this->data);
        endif;
        if($this->input->post('request')    == 'create'):
             $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('pay_type','','required', array('required'=>'1'));
            $this->form_validation->set_rules('bps','','required', array('required'=>'2'));
            $this->form_validation->set_rules('amount','','required', array('required'=>'3'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Allowance type is required.'; break;
                    case 2: $return_json['e_text'] = 'BPS is required.'; break;
                    case 3: $return_json['e_text'] = 'Amount is required.'; break;
                endswitch;
        else:
            
            $pay_alownc_id  = $this->input->post('pay_scale_id');
            $pay_type       = $this->input->post('pay_type');
            $bps        = $this->input->post('bps');
            $amount     = $this->input->post('amount');
                    
            
             $where_chk = array(
                'psa_ps_id'         => $pay_alownc_id,
                'psa_pay_scale'     => $bps,
                'psa_allowance_type_id'  => $pay_type,
            );
           $chk_bps =  $this->CRUDModel->get_where_row('pr_pay_scale_allowance',$where_chk);
        if($chk_bps):
            $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Alowance head already exist.'
                    );
        else:
               $data = array(
                    'psa_ps_id'                 => $pay_alownc_id,
                    'psa_pay_scale'             => $bps,
                    'psa_allowance_type_id'     => $pay_type,
                    'psa_amount'                => $amount,
                    'psa_create_by'             => $this->UserInfo->user_id,
                    'psa_time_date'             => date("Y-m-d H:i:s"),
                );
            $this->CRUDModel->insert('pr_pay_scale_allowance',$data); 
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
        endif;
           echo json_encode($return_json); 
        endif;
        if($this->input->post('request')    == 'update'):
             $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('pay_type','','required', array('required'=>'1'));
            $this->form_validation->set_rules('bps','','required', array('required'=>'2'));
            $this->form_validation->set_rules('amount','','required', array('required'=>'3'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Allowance type is required.'; break;
                    case 2: $return_json['e_text'] = 'BPS is required.'; break;
                    case 3: $return_json['e_text'] = 'Amount is required.'; break;
                endswitch;
        else:
            
            $pay_alownc_id  = $this->input->post('pay_scale_id');
            $pay_type       = $this->input->post('pay_type');
            $bps            = $this->input->post('bps');
            $amount         = $this->input->post('amount');
            $pk_id          = $this->input->post('pk_id');
                    
            
             $where_chk = array(
                'psa_ps_id'              => $pay_alownc_id,
                'psa_pay_scale'          => $bps,
                'psa_allowance_type_id'  => $pay_type,
                'psa_id !='              => $pk_id,
            );
           $chk_bps =  $this->CRUDModel->get_where_row('pr_pay_scale_allowance',$where_chk);
        if($chk_bps):
            $return_json = array(
                    'e_status'  => false,
                    'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                    'e_type'    => 'WARNING',
                    'e_text'    => 'Alowance head already exist.'
                    );
        else:
               $data = array(
                    'psa_ps_id'                 => $pay_alownc_id,
                    'psa_pay_scale'             => $bps,
                    'psa_allowance_type_id'     => $pay_type,
                    'psa_amount'                => $amount,
                    
                );
            $this->CRUDModel->update('pr_pay_scale_allowance',$data,array('psa_id'=>$pk_id)); 
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record update successfully.'
                );
            endif;
        endif;
           echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'delete'):
            $where      = array('psa_id'=>$this->input->post('pk_id'));
            $this->CRUDModel->deleteid('pr_pay_scale_allowance',$where);
        endif;
        if($this->input->post('request') == 'fetch'):
            echo  json_encode($this->CRUDModel->get_where_row('pr_pay_scale_allowance',array('psa_id'=>$this->input->post('pk_id'))));
        endif;
        
   }
   public function employee_salary_setting() {
        
        $this->data['breadcrumbs'] = 'Salery Setting';
        $this->data['page_title']   = 'Salery Setting | ECMS';
        $this->data['page']         = 'Payroll/Forms/salary_setting_v';
        $this->load->view('common/common',$this->data); 
   }
}
 