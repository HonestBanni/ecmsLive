<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class HrSetupsController extends AdminController {

     public function __construct() {
        parent::__construct();
       $this->load->model('HrModel');
    }
   
    public function staff_categories(){
        
        $this->data['page_headr']   = 'Categories';
        $this->data['page_title']   = 'Categories | ECP';
        $this->data['page']         = 'HR/setups/categories_v';
        $this->load->view('common/common',$this->data);
    }
    public function staff_categories_results(){
        if($this->input->post('request') == 'showRecords'):
            $this->data['result']       = $this->HrModel->getcategory();
            $this->load->view('HR/setups/jquery_results/categories_results_js',$this->data);
        endif;
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('category_code', 'Category Code', 'required|is_unique[hr_emp_category.category_code]', array('required'=>'1','is_unique'=>'2'));
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|is_unique[hr_emp_category.category_name]', array('required'=>'3','is_unique'=>'4'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category code is required.'; break;
                    case 2: $return_json['e_text'] = 'Category code already exist.'; break;
                    case 3: $return_json['e_text'] = 'Category name is required.'; break;
                    case 4: $return_json['e_text'] = 'Category name already exist'; break;
                endswitch;
        else:
            $data = array(
                'category_code'        => $this->input->post('category_code'),
                'category_name'        => strtoupper($this->input->post('category_name')),
                'category_create_by'   => $this->UserInfo->user_id,
                'category_date_time'   => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('hr_emp_category',$data);
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
            echo  json_encode($this->CRUDModel->get_where_row('hr_emp_category',array('category_id'=>$this->input->post('category_id'))));
        endif;
       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $category_id                = $this->input->post('category_id');
            $category_code              = $this->input->post('category_code');
            $category_name              = strtoupper($this->input->post('category_name'));
            
                    
            $this->form_validation->set_rules('category_code', 'Category Code', 'required|edit_unique[hr_emp_category,category_code,'.$category_code.',category_id,'.$category_id.']', array('required'=>'1','edit_unique'=>'2'));
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|edit_unique[hr_emp_category,category_name,'.$category_name.',category_id,'.$category_id.']', array('required'=>'3','edit_unique'=>'4'));

          
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category code is required.'; break;
                    case 2: $return_json['e_text'] = 'Category code already exist.'; break;
                    case 2: $return_json['e_text'] = 'Category name is required.'; break;
                    case 4: $return_json['e_text'] = 'Category name already exist.'; break;
                endswitch;
        else:

            $data = array(
                'category_code'        => $category_code,
                'category_name'        => $category_name,
             );
             $this->CRUDModel->update('hr_emp_category',$data,array('category_id'=>$category_id));
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'deleteRecord'):
            $where      = array('category_id'=>$this->input->post('category_id'));
            $this->CRUDModel->deleteid('hr_emp_category',$where);
        endif;
    }
   
    public function staff_categories_type(){
        $this->data['Category']     = $this->CRUDModel->DropDown_Code('hr_emp_category', 'CATEGORY', 'category_id', 'category_name','category_code');
        $this->data['result']       = $this->HrModel->getcategory();
        $this->data['page_headr']   = 'Staff Categories Type';
        $this->data['page_title']   = 'Staff Categories Type| ECP';
        $this->data['page']         = 'HR/setups/categories_type_v';
        $this->load->view('common/common',$this->data);
    }
     public function staff_categories_type_result(){
        if($this->input->post('request') == 'showRecords'):
            $this->load->view('HR/setups/jquery_results/categories_type_results_js',$this->data);
        endif;
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            $this->form_validation->set_rules('category_id', 'Category Name', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('category_type_code', 'Category Type Code', 'required|is_unique[hr_emp_category_type.ctgy_type_code]', array('required'=>'2','is_unique'=>'3'));
            $this->form_validation->set_rules('category_type_name', 'Category Type Name', 'required', array('required'=>'4'));
            
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category name already exist.'; break;
                    case 2: $return_json['e_text'] = 'Category Type code is required.'; break;
                    case 3: $return_json['e_text'] = 'Category Type code already exist.'; break;
                    case 4: $return_json['e_text'] = 'Category Type name is required.'; break;
                    
                endswitch;
        else:
            $category_type_code = $this->input->post('category_type_code');
            $category_type_name = strtoupper($this->input->post('category_type_name'));
            $category_id        = $this->input->post('category_id');
            //Check Unique validation 
            
            $where_name_chk = array(
                'ctgy_type_name'    => $category_type_name,
                'ctgy_type_cat_id'  => $category_id,
            );
            $check_type_name = $this->CRUDModel->get_where_row('hr_emp_category_type',$where_name_chk);
            if(!empty($check_type_name)):
                $return_json = array(
                'e_status'  => false,
                'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                'e_type'    => 'WARNING',
                'e_text'    => 'Category Type already exist.'
                );
            else:
                 $data = array(
                'ctgy_type_code'        => $category_type_code,
                'ctgy_type_name'        => $category_type_name,
                'ctgy_type_cat_id'      => $category_id,
                'ctgy_type_create_by'   => $this->UserInfo->user_id,
                'ctgy_type_date_time'   => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('hr_emp_category_type',$data);
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
            echo  json_encode($this->CRUDModel->get_where_row('hr_emp_category_type',array('category_type_id'=>$this->input->post('category_type_id'))));
        endif;
       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $category_id               = $this->input->post('category_id');
            $category_type_id          = $this->input->post('category_type_id');
            $category_type_code        = $this->input->post('category_type_code');
            $category_type_name        = strtoupper($this->input->post('category_type_name'));
            
            $this->form_validation->set_rules('category_id', 'Category', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('category_type_code', 'Category type Code', 'required|is_unique[hr_emp_category_type.ctgy_type_code]', array('required'=>'2','is_unique'=>'3'));
            $this->form_validation->set_rules('category_type_name', 'Category type Name', 'required', array('required'=>'4'));
            
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category is required.'; break;
                    case 2: $return_json['e_text'] = 'Category type code is required.'; break;
                    case 3: $return_json['e_text'] = 'Category type code already exist.'; break;
                    case 4: $return_json['e_text'] = 'Category type name is required.'; break;
                    
                    
                endswitch;
            else:
            
            $where_name_chk = array(
                'ctgy_type_name'        => $category_type_name,
                'ctgy_type_cat_id'      => $category_id,
                'category_type_id !='   => $category_type_id,
            );
            $check_type_name = $this->CRUDModel->get_where_row('hr_emp_category_type',$where_name_chk);
                
                if(!empty($check_type_name)):
                    $return_json = array(
                        'e_status'  => false,
                        'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                        'e_type'    => 'WARNING',
                        'e_text'    => 'Category Type name already exist.'
                        );
                else:
                    $data = array(
                    'ctgy_type_code'                => $category_type_code,
                    'ctgy_type_name'                => $category_type_name,
                    'ctgy_type_cat_id'              => $category_id,
                    
                 );
                 $this->CRUDModel->update('hr_emp_category_type`',$data,array('category_type_id'=>$category_type_id));
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
        if($this->input->post('request') == 'deleteRecord'):
            $where      = array('category_type_id'=>$this->input->post('category_type_id'));
            $this->CRUDModel->deleteid('hr_emp_category_type',$where);
        endif;
    } 
    public function staff_categories_designations(){
        $this->data['Category']     = $this->CRUDModel->DropDown_Code('hr_emp_category', 'CATEGORY', 'category_id', 'category_name','category_code');
        $this->data['CategoryType'] = $this->CRUDModel->DropDown_Code('hr_emp_category_type', 'CATEGORY TYPE', 'category_type_id', 'ctgy_type_name','ctgy_type_code');
        $this->data['page_headr']   = 'Staff Categories Desginations';
        $this->data['page_title']   = 'Staff Categories Desginations| ECP';
        $this->data['page']         = 'HR/setups/categories_designations_v';
        $this->load->view('common/common',$this->data);
    }
     public function staff_categories_designations_result(){
        if($this->input->post('request') == 'showRecords'):
//            $this->data['result']       = $this->HrModel->get_designations();
            $this->load->view('HR/setups/jquery_results/designation_results_js',$this->data);
        endif;
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('category_id', 'Category Name', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('category_type_id', 'Category Type', 'required', array('required'=>'2'));
            $this->form_validation->set_rules('designation_code', 'Designation Code', 'required|is_unique[hr_emp_designation.emp_desg_code]', array('required'=>'3','is_unique'=>'4'));
            $this->form_validation->set_rules('designation_name', 'Designation Name', 'required', array('required'=>'5'));

            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category Name is required.'; break;
                    case 2: $return_json['e_text'] = 'Designation Name is required.'; break;
                    case 3: $return_json['e_text'] = 'Designation Code is required.'; break;
                    case 4: $return_json['e_text'] = 'Designation Code already exist.'; break;
                    case 5: $return_json['e_text'] = 'Designation name is required.'; break;
                    
                endswitch;
        else:
            $designation_code   = $this->input->post('designation_code');
            $designation_name   = strtoupper($this->input->post('designation_name'));
            $category_id        = $this->input->post('category_id');
            $category_type_id   = $this->input->post('category_type_id');
            //Check Unique validation 
            
            $where_name_chk = array(
                'emp_desg_name'             => $designation_name,
                'emp_desg_cat_id'           => $category_id,
                'emp_desg_cat_type_id'      => $category_type_id,
            );
            $check_type_name = $this->CRUDModel->get_where_row('hr_emp_designation',$where_name_chk);
            if(!empty($check_type_name)):
                $return_json = array(
                'e_status'  => false,
                'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                'e_type'    => 'WARNING',
                'e_text'    => 'Designation name already exist.'
                );
            else:
                 $data = array(
                'emp_desg_code'             => $designation_code,
                'emp_desg_name'             => $designation_name,
                'emp_desg_cat_id'           => $category_id,
                'emp_desg_cat_type_id'      => $category_type_id,
                'emp_desg_create_by'        => $this->UserInfo->user_id,
                'emp_desg_create_date_time' => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('hr_emp_designation',$data);
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
            echo  json_encode($this->CRUDModel->get_where_row('hr_emp_designation',array('emp_desg_id'=>$this->input->post('category_type_id'))));
        endif;
       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $designation_code           = $this->input->post('designation_code');
            $designation_name           = strtoupper($this->input->post('designation_name'));
            $category_id                = $this->input->post('category_id');
            $category_type_id           = $this->input->post('category_type_id');
            $designation_code_id        = $this->input->post('designation_code_id');
            
            $this->form_validation->set_rules('category_id', 'Category', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('category_type_id', 'Category Type', 'required', array('required'=>'2'));
            $this->form_validation->set_rules('designation_code', 'Category type Code', 'required', array('required'=>'3'));
            $this->form_validation->set_rules('designation_name', 'Category type Name', 'required', array('required'=>'4'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category name is required.'; break;
                    case 2: $return_json['e_text'] = 'Category type is required.'; break;
                    case 3: $return_json['e_text'] = 'Designation code is required.'; break;
                    case 4: $return_json['e_text'] = 'Designation name is required'; break;
//                    case 5: $return_json['e_text'] = 'Designation name already exist.'; break;
                    
                    
                endswitch;
            else:
            
           //check designation code 
            $where_code_chk = array(
                'emp_desg_code'             => $designation_code,
                'emp_desg_cat_id'           => $category_id,
                'emp_desg_cat_type_id'      => $category_type_id,
                'emp_desg_id !='            => $designation_code_id,
            );
            $check_type_code = $this->CRUDModel->get_where_row('hr_emp_designation',$where_code_chk);
            
              
            $where_name_chk = array(
                'emp_desg_name'             => $designation_name,
                'emp_desg_cat_id'           => $category_id,
                'emp_desg_cat_type_id'      => $category_type_id,
                'emp_desg_id !='            => $designation_code_id,
            );
            $check_type_name = $this->CRUDModel->get_where_row('hr_emp_designation',$where_name_chk);
            
            
           if(!empty($check_type_code)):
               $return_json = array(
                        'e_status'  => false,
                        'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                        'e_type'    => 'WARNING',
                        'e_text'    => 'Designation code already exist.'
                        );
           elseif($check_type_name):
               $return_json = array(
                        'e_status'  => false,
                        'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                        'e_type'    => 'WARNING',
                        'e_text'    => 'Designation name already exist.'
                        );
           else:
               $data = array(
                    'emp_desg_code'             => $designation_code,
                    'emp_desg_name'             => $designation_name,
                    'emp_desg_cat_id'           => $category_id,
                    'emp_desg_cat_type_id'      => $category_type_id,
                   
                 );
                 $this->CRUDModel->update('hr_emp_designation`',$data,array('emp_desg_id'=>$designation_code_id));
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
        if($this->input->post('request') == 'deleteRecord'):
            $where      = array('emp_desg_id'=>$this->input->post('designation_id'));
            $this->CRUDModel->deleteid('hr_emp_designation',$where);
        endif;
    } 
    public function staff_departments(){
        $this->data['Category']     = $this->CRUDModel->DropDown_Code('hr_emp_category', 'CATEGORY', 'category_id', 'category_name','category_code');
        $this->data['page_headr']   = 'Staff Departments';
        $this->data['page_title']   = 'Staff Departments | ECP';
        $this->data['page']         = 'HR/setups/departments_v';
        $this->load->view('common/common',$this->data);
    }
     public function staff_departments_result(){
        if($this->input->post('request') == 'showRecords'):
//            $this->data['result']       = $this->HrModel->get_department();
            $this->load->view('HR/setups/jquery_results/department_results_js',$this->data);
        endif;
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('category_id', 'Category Name', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('department_name', 'Department Name', 'required', array('required'=>'2'));

            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category name is required.'; break;
                    case 2: $return_json['e_text'] = 'Department name already exist'; break;
                endswitch;
        else:
            
            $department_name   = strtoupper($this->input->post('department_name'));
            $category_id        = $this->input->post('category_id');
            $category_type_id   = $this->input->post('category_type_id');
            //Check Unique validation 
            
            $where_name_chk = array(
                'emp_deprt_name'             => $department_name,
                'emp_deprt_cat_id'           => $category_id,
            );
            $check_type_name = $this->CRUDModel->get_where_row('hr_emp_departments',$where_name_chk);
            if(!empty($check_type_name)):
                $return_json = array(
                'e_status'  => false,
                'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                'e_type'    => 'WARNING',
                'e_text'    => 'Department name is already exist.'
                );
            else:
                 $data = array(
                'emp_deprt_name'             => $department_name,
                'emp_deprt_cat_id'           => $category_id,
                'emp_deprt_create_by'        => $this->UserInfo->user_id,
                'emp_deprt_create_date_time' => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('hr_emp_departments',$data);
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
            echo  json_encode($this->CRUDModel->get_where_row('hr_emp_departments',array('emp_deprt_id'=>$this->input->post('department_id'))));
        endif;
       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $department_name    = strtoupper($this->input->post('department_name'));
            $category_id        = $this->input->post('category_id');
            $department_id       = $this->input->post('department_id');
            
            $this->form_validation->set_rules('category_id', 'Category Name', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('department_name', 'Department Name', 'required', array('required'=>'2'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Category name is required.'; break;
                    case 2: $return_json['e_text'] = 'Department required.'; break;
                endswitch;
            else:
            
            $where_chk = array(
                'emp_deprt_name'    => $department_name,
                'emp_deprt_cat_id' => $category_id,
                'emp_deprt_id !='   => $department_id,
            );
            $check = $this->CRUDModel->get_where_row('hr_emp_departments',$where_chk);
                
                if(!empty($check)):
                    $return_json = array(
                        'e_status'  => false,
                        'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                        'e_type'    => 'WARNING',
                        'e_text'    => 'Department name already exist.'
                        );
                else:
                    $data = array(
                    'emp_deprt_name'             => $department_name,
                    'emp_deprt_cat_id'           => $category_id,
                   
                 );
                 $this->CRUDModel->update('hr_emp_departments`',$data,array('emp_deprt_id'=>$department_id));
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
        if($this->input->post('request') == 'deleteRecord'):
            $where      = array('emp_deprt_id'=>$this->input->post('department_id'));
            $this->CRUDModel->deleteid('hr_emp_departments',$where);
        endif;
    }
  public function staff_bank(){
        $this->data['page_headr']   = 'Bank';
        $this->data['page_title']   = 'Bank | ECP';
        $this->data['page']         = 'HR/setups/bank_v';
        $this->load->view('common/common',$this->data);
    }
     public function staff_bank_result(){
        if($this->input->post('request') == 'showRecords'):
            $this->data['result']       = $this->HrModel->get_bank();
            $this->load->view('HR/setups/jquery_results/bank_results_js',$this->data);
        endif;
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'required|is_unique[bank.bank_name]', array('required'=>'1','is_unique'=>'2'));
            $this->form_validation->set_rules('bank_short_name', 'Bank Short Name', 'required|is_unique[bank.bank_short_name]', array('required'=>'3','is_unique'=>'4'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Bank name is required.'; break;
                    case 2: $return_json['e_text'] = 'Bank name already exist.'; break;
                    case 3: $return_json['e_text'] = 'Bank short name is required.'; break;
                    case 4: $return_json['e_text'] = 'Bank short name already exist'; break;
                endswitch;
        else:
            $data = array(
                
                'bank_name'             => strtoupper($this->input->post('bank_name')),
                'bank_short_name'       => strtoupper($this->input->post('bank_short_name')),
                'bank_create_by'        => $this->UserInfo->user_id,
                'bank_create_datetime'  => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('bank',$data);
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
            echo  json_encode($this->CRUDModel->get_where_row('bank',array('bank_id'=>$this->input->post('bank_id'))));
        endif;
       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $bank_id                = $this->input->post('bank_id');
            $bank_name              = strtoupper($this->input->post('bank_name'));
            $bank_short_name        = strtoupper($this->input->post('bank_short_name'));
            
                    
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'required|edit_unique[bank,bank_name,'.$bank_name.',bank_id,'.$bank_id.']', array('required'=>'1','edit_unique'=>'2'));
            $this->form_validation->set_rules('bank_short_name', 'Bank Short Name', 'required|edit_unique[bank,bank_short_name,'.$bank_short_name.',bank_id,'.$bank_id.']', array('required'=>'3','edit_unique'=>'4'));

          
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Bank name is required.'; break;
                    case 2: $return_json['e_text'] = 'Bank name already exist.'; break;
                    case 2: $return_json['e_text'] = 'Bank short name is required.'; break;
                    case 4: $return_json['e_text'] = 'Bank short name already exist.'; break;
                endswitch;
        else:

            $data = array(
                'bank_name'        => $bank_name,
                'bank_short_name'        => $bank_short_name,
             );
             $this->CRUDModel->update('bank',$data,array('bank_id'=>$bank_id));
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record update successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'deleteRecord'):
            $where      = array('bank_id'=>$this->input->post('bank_id'));
            $this->CRUDModel->deleteid('bank',$where);
        endif;
    }   
    public function staff_bank_branch(){
        $this->data['bank']     = $this->CRUDModel->DropDown_Code('bank', 'BANK', 'bank_id', 'bank_name','bank_short_name');
        $this->data['result']       = $this->HrModel->getcategory();
        $this->data['page_headr']   = 'Bank Branch';
        $this->data['page_title']   = 'Bank Branch | ECP';
        $this->data['page']         = 'HR/setups/bank_branch_v';
        $this->load->view('common/common',$this->data);
    }
     public function staff_bank_branch_result(){
        if($this->input->post('request') == 'showRecords'):
            $this->data['result']       = $this->HrModel->get_branch();
            $this->load->view('HR/setups/jquery_results/branch_results_js',$this->data);
        endif;
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('bank', 'Bank', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('branch_name', 'Branch Name', 'required', array('required'=>'2')); 
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Bank is required.'; break;
                    case 2: $return_json['e_text'] = 'Branch is required.'; break;
                endswitch;
        else:
            $bank           = $this->input->post('bank');
            $branch_name    = strtoupper($this->input->post('branch_name'));
            //Check Unique validation 
            
            $where_name_chk = array(
                'branch_bank_id'   => $bank,
                'branch_name'       => $branch_name,
            );
            $check_type_name = $this->CRUDModel->get_where_row('hr_bank_branch',$where_name_chk);
            if(!empty($check_type_name)):
                $return_json = array(
                'e_status'  => false,
                'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                'e_type'    => 'WARNING',
                'e_text'    => 'Branch already exist.'
                );
            else:
                 $data = array(
                'branch_bank_id'     => $bank,
                'branch_name'        => $branch_name,
                'branch_create_by'   => $this->UserInfo->user_id,
                'branch_create_datetime'   => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('hr_bank_branch',$data);
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
            echo  json_encode($this->CRUDModel->get_where_row('hr_bank_branch',array('branch_id'=>$this->input->post('branch_id'))));
        endif;
       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
             $bank          = $this->input->post('bank');
            $branch_name    = strtoupper($this->input->post('branch_name'));
            $branch_id      = $this->input->post('branch_id');
            
            $this->form_validation->set_rules('bank', 'Bank', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('branch_name', 'Branch Name', 'required', array('required'=>'2'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Bank is required.'; break;
                    case 2: $return_json['e_text'] = 'Branch is required.'; break;
                    
                endswitch;
            else:
            
            $where_name_chk = array(
                'branch_bank_id' => $bank,
                'branch_name'    => $branch_name,
                'branch_id !='   => $branch_id,
            );
            $check_type_name = $this->CRUDModel->get_where_row('hr_bank_branch',$where_name_chk);
                
                if(!empty($check_type_name)):
                    $return_json = array(
                        'e_status'  => false,
                        'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                        'e_type'    => 'WARNING',
                        'e_text'    => 'Branch already exist.'
                        );
                else:
                    $data = array(
                    'branch_bank_id'     => $bank,
                    'branch_name'        => $branch_name,
                 );
                 $this->CRUDModel->update('hr_bank_branch`',$data,array('branch_id'=>$branch_id));
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
        if($this->input->post('request') == 'deleteRecord'):
            $where      = array('branch_id'=>$this->input->post('branch_id'));
            $this->CRUDModel->deleteid('hr_bank_branch',$where);
        endif;
    } 
      public function staff_scale(){
        
        $this->data['page_headr']   = 'Scale';
        $this->data['page_title']   = 'Scale | ECP';
        $this->data['page']         = 'HR/setups/scale_v';
        $this->load->view('common/common',$this->data);
    }
    public function staff_scale_result(){
        if($this->input->post('request') == 'showRecords'):
            $this->data['result']       = $this->HrModel->get_scale();
            $this->load->view('HR/setups/jquery_results/scale_results_js',$this->data);
        endif;
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('scale_name', 'Scale', 'required|is_unique[hr_emp_scale.scale_name]', array('required'=>'1','is_unique'=>'2'));
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Scale is required.'; break;
                    case 2: $return_json['e_text'] = 'Scale  already exist.'; break;
                endswitch;
        else:
            $data = array(
                'scale_name'                => $this->input->post('scale_name'),
                'scale_create_by'           => $this->UserInfo->user_id,
                'scale_create_date_time'    => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('hr_emp_scale',$data);
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
            echo  json_encode($this->CRUDModel->get_where_row('hr_emp_scale',array('emp_scale_id'=>$this->input->post('scale_id'))));
        endif;
       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $scale_id              = $this->input->post('scale_id');
            $scale_name              = strtoupper($this->input->post('scale_name'));
            
                    
            $this->form_validation->set_rules('scale_name', 'Scale name', 'required|edit_unique[hr_emp_scale,scale_name,'.$scale_name.',emp_scale_id,'.$scale_id.']', array('required'=>'1','edit_unique'=>'2'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Scale is required.'; break;
                    case 2: $return_json['e_text'] = 'Scale already exist.'; break;
                  
                endswitch;
        else:

            $data = array(
                'scale_name'        => $scale_name,
                
             );
             $this->CRUDModel->update('hr_emp_scale',$data,array('emp_scale_id'=>$scale_id));
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'deleteRecord'):
            $where      = array('emp_scale_id'=>$this->input->post('scale_id'));
            $this->CRUDModel->deleteid('hr_emp_scale',$where);
        endif;
    }
      public function staff_status(){
        
        $this->data['page_headr']   = 'Employee Status';
        $this->data['page_title']   = 'Employee Status | ECP';
        $this->data['page']         = 'HR/setups/employee_status_v';
        $this->load->view('common/common',$this->data);
    }
    public function staff_status_result(){
        if($this->input->post('request') == 'showRecords'):
            $this->data['result']       = $this->HrModel->get_status();
            $this->load->view('HR/setups/jquery_results/employee_status_results_js',$this->data);
        endif;
        if($this->input->post('request') == 'SaveRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $this->form_validation->set_rules('scale_name', 'Scale', 'required|is_unique[hr_emp_scale.scale_name]', array('required'=>'1','is_unique'=>'2'));
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Scale is required.'; break;
                    case 2: $return_json['e_text'] = 'Scale  already exist.'; break;
                endswitch;
        else:
            $data = array(
                'scale_name'                => $this->input->post('scale_name'),
                'scale_create_by'           => $this->UserInfo->user_id,
                'scale_create_date_time'    => date("Y-m-d H:i:s"),
             );
            $this->CRUDModel->insert('hr_emp_scale',$data);
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
            echo  json_encode($this->CRUDModel->get_where_row('hr_emp_scale',array('emp_scale_id'=>$this->input->post('scale_id'))));
        endif;
       
        if($this->input->post('request') == 'UpdateRecord'):
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';
            
            $scale_id              = $this->input->post('scale_id');
            $scale_name              = strtoupper($this->input->post('scale_name'));
            
                    
            $this->form_validation->set_rules('scale_name', 'Scale name', 'required|edit_unique[hr_emp_scale,scale_name,'.$scale_name.',emp_scale_id,'.$scale_id.']', array('required'=>'1','edit_unique'=>'2'));
            
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('','');
                $fve =  validation_errors();
                    
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Scale is required.'; break;
                    case 2: $return_json['e_text'] = 'Scale already exist.'; break;
                  
                endswitch;
        else:

            $data = array(
                'scale_name'        => $scale_name,
                
             );
             $this->CRUDModel->update('hr_emp_scale',$data,array('emp_scale_id'=>$scale_id));
            $return_json = array(
                'e_status'  => true,
                'e_icon'    => '<i class="fa fa-check-circle"></i>',
                'e_type'    => 'SUCCESS',
                'e_text'    => 'Record saved successfully.'
                );
            endif;
             echo json_encode($return_json); 
        endif;
        if($this->input->post('request') == 'deleteRecord'):
            $where      = array('emp_scale_id'=>$this->input->post('scale_id'));
            $this->CRUDModel->deleteid('hr_emp_scale',$where);
        endif;
    }
}
 