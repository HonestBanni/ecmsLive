<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class HrController extends AdminController {

     public function __construct() {
             parent::__construct();
            $this->load->model('HrModel');
    }
   
    public function employee_form(){
        //Employee Registration
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
        $this->data['network']      = $this->CRUDModel->dropDown('mobile_network', 'Select', 'net_id', 'network',array('net_id !='=>'0'));
        $this->data['religion']     = $this->CRUDModel->dropDown('religion', 'Select', 'religion_id', 'title');
        $this->data['m_status']     = $this->CRUDModel->dropDown('marital_status', 'Select', 'marital_status_id', 'title');
        $this->data['status']       = $this->CRUDModel->dropDown('hr_emp_status', '', 'emp_status_id', 'emp_status_name',array('emp_status_id'=>1));
         //Adacdemics
        $this->data['division']         = $this->CRUDModel->dropDown('hr_emp_division', 'Select Division', 'devision_id', 'division_name');
        
        $this->data['department']       = $this->CRUDModel->dropDown('hr_emp_departments', 'Department', 'emp_deprt_id', 'emp_deprt_name','',array('column'=>'emp_deprt_name','order'=>'asc'));
            $this->data['designation']  = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'emp_desg_name','',array('column'=>'emp_desg_name','order'=>'asc'));
            $this->data['scale']        = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'scale_name','',array('column'=>'scale_order','order'=>'asc'));
            $this->data['category']     = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'category_id', 'category_name');
            $this->data['contract_tp']  = $this->CRUDModel->dropDown('hr_emp_category_type', 'Contract Type', 'category_type_id', 'ctgy_type_name');
            
            $this->data['breadcrumbs']  = 'Register Employee';
            $this->data['page_title']   = 'Register Employee | ECP';
            $this->data['page']         = 'HR/Forms/register_employee_form_v';
            $this->load->view('common/common',$this->data);
        }
    
    public function register_employee(){
                        
        if($this->input->post('RegEmployee') =='RegEmployee'):
                        
                        
                $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']     = 'WARNING';
                
                $this->form_validation->set_rules('emp_name', 'Employee Name', 'required', array('required'=>'1'));
//                $this->form_validation->set_rules('father_name', 'Father Name', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('emp_cnic', 'CNIC', 'required|min_length[15]', array('required'=>'3','min_length'=>'4'));
                $this->form_validation->set_rules('gender_id', 'Gender', 'required', array('required'=>'5'));       
                $this->form_validation->set_rules('dob_day', 'DoB Day', 'required', array('required'=>'6'));
                $this->form_validation->set_rules('dob_month', 'DoB Month', 'required', array('required'=>'6'));
                $this->form_validation->set_rules('dob_year', 'DoB Year', 'required', array('required'=>'6'));
//                $this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required', array('required'=>'7'));
//                $this->form_validation->set_rules('district_id', 'District', 'required', array('required'=>'8'));
//                $this->form_validation->set_rules('country_id', 'Country', 'required', array('required'=>'9'));
//                $this->form_validation->set_rules('contact1', 'Contact No', 'required|min_length[11]', array('required'=>'10','min_length'=>'11'));
//                $this->form_validation->set_rules('net_id', 'Network', 'required', array('required'=>'12'));
//                $this->form_validation->set_rules('religion_id', 'Religion', 'required', array('required'=>'13'));
//                $this->form_validation->set_rules('email', 'Email', 'required', array('required'=>'14'));
//                $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required'=>'14','valid_email'=>'15'));
//                $this->form_validation->set_rules('department_id', 'Department', 'required', array('required'=>'16'));
//                $this->form_validation->set_rules('shift_id', 'Shift', 'required', array('required'=>'17'));
//                $this->form_validation->set_rules('bank_id', 'Bank', 'required', array('required'=>'18'));
//                $this->form_validation->set_rules('account_no', 'Account No', 'required', array('required'=>'19'));
//                $this->form_validation->set_rules('cat_id', 'Employee Category', 'required', array('required'=>'20'));
//                $this->form_validation->set_rules('contract_type_id', 'Employee Type', 'required', array('required'=>'21'));
//                $this->form_validation->set_rules('emp_status_id', 'Employee Type', 'required', array('required'=>'22'));
                
                
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Employee name is required.'; break;
//                        case 2: $return_json['e_text'] = 'Father name is required.'; break;
//                        case 3: $return_json['e_text'] = 'CNIC is required.'; break;
//                        case 4: $return_json['e_text'] = 'Enter valid CINC.'; break;
                        case 5: $return_json['e_text'] = 'Gender is required.'; break;
                        case 6: $return_json['e_text'] = 'Date of birth is required.'; break;
//                        case 7: $return_json['e_text'] = 'Permanent address isrequired.'; break;
//                        case 8: $return_json['e_text'] = 'District is required.'; break;
//                        case 9: $return_json['e_text'] = 'Country is required.'; break;
//                        case 10: $return_json['e_text'] = 'Contact no is required.'; break;
//                        case 11: $return_json['e_text'] = 'Enter valid number 0000-0000000'; break;
//                        case 12: $return_json['e_text'] = 'Network is required.'; break;
//                        case 13: $return_json['e_text'] = 'Religion is required.'; break;
//                        case 14: $return_json['e_text'] = 'Email is required.'; break;
//                        case 15: $return_json['e_text'] = 'Enter valid email'; break;
//                        case 16: $return_json['e_text'] = 'Department is required.'; break;
//                        case 17: $return_json['e_text'] = 'Shift is required.'; break;
//                        case 18: $return_json['e_text'] = 'Bank is required'; break;
//                        case 19: $return_json['e_text'] = 'Account no is required'; break;
//                        case 20: $return_json['e_text'] = 'Employee category is required'; break;
//                        case 21: $return_json['e_text'] = 'Employee type is required'; break;
//                        case 22: $return_json['e_text'] = 'Employee status is required'; break;
                    endswitch;
            else:

                 $dob_Y         = $this->input->post('dob_year');
                 $dob_M         = $this->input->post('dob_month');
                 $dob_D         = $this->input->post('dob_day');
                $retur_year     = $dob_Y+'60';
                        
            $file_name = '';
            if($_FILES['file']['name']):
                 $image      = $this->CRUDModel->do_resize('file','assets/images/employee');
                 $file_name  = $image['file_name'];
            endif;
            
            $data = array(
                'emp_name'              => strtoupper($this->input->post('emp_name')),
                'father_name'           => strtoupper($this->input->post('father_name')),
                'emp_husband_name'      => strtoupper($this->input->post('emp_husband_name')),
                'nic'                   => $this->input->post('emp_cnic'),
                'gender_id'             => $this->input->post('gender_id'),
                'dob'                   => $dob_Y.'-'.$dob_M.'-'.$dob_D,
                'postal_address'        => $this->input->post('postal_address'),
                'permanent_address'     => $this->input->post('permanent_address'),
                'district_id'           => $this->input->post('district_id'),
                'post_office'           => $this->input->post('post_office'),
                'country_id'            => $this->input->post('country_id'),
                'ptcl_number'           => $this->input->post('ptcl_number'),
                'contact1'              => $this->input->post('contact1'),
                'net_id'                => $this->input->post('net_id'),
                'religion_id'           => $this->input->post('religion_id'),
                'marital_status_id'     => $this->input->post('marital_status_id'),
                'email'                 => $this->input->post('email'),
                'emp_status_id'         => $this->input->post('emp_status_id'),
                'comment'               => $this->input->post('emp_remarks'),
                'picture'               => $file_name,
                'retirement_date'       => $retur_year.'-'.$dob_M.'-'.$dob_D,
                'hr_emp_create_date_time'=> date('Y-m-d H:i:s'),
                'hr_emp_create_by'      => $this->UserInfo->user_id
                    );
                $EmpId                  = $this->CRUDModel->insert('hr_emp_record',$data);
           
                $return_json = array(
                    'e_status'  => true,
                    'emp_id'    => $EmpId,
                    'e_icon'    => '<i class="fa fa-check-circle"></i>',
                    'e_type'    => 'SUCCESS',
                    'e_text'    => 'Employee record saved successfully.'
                );    
                endif;
            echo json_encode($return_json); 
        endif;
        if($this->input->post('UpdateEmployee') =='UpdateEmployee'):
                        
                $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']     = 'WARNING';
                
                $this->form_validation->set_rules('emp_name', 'Employee Name', 'required', array('required'=>'1'));
//                $this->form_validation->set_rules('father_name', 'Father Name', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('emp_cnic', 'CNIC', 'required|min_length[15]', array('required'=>'3','min_length'=>'4'));
                $this->form_validation->set_rules('gender_id', 'Gender', 'required', array('required'=>'5'));       
                $this->form_validation->set_rules('dob_day', 'DoB Day', 'required', array('required'=>'6'));
                $this->form_validation->set_rules('dob_month', 'DoB Month', 'required', array('required'=>'6'));
                $this->form_validation->set_rules('dob_year', 'DoB Year', 'required', array('required'=>'6'));
//                $this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required', array('required'=>'7'));
//                $this->form_validation->set_rules('district_id', 'District', 'required', array('required'=>'8'));
//                $this->form_validation->set_rules('country_id', 'Country', 'required', array('required'=>'9'));
//                $this->form_validation->set_rules('contact1', 'Contact No', 'required|min_length[11]', array('required'=>'10','min_length'=>'11'));
//                $this->form_validation->set_rules('net_id', 'Network', 'required', array('required'=>'12'));
//                $this->form_validation->set_rules('religion_id', 'Religion', 'required', array('required'=>'13'));
//                $this->form_validation->set_rules('email', 'Email', 'required', array('required'=>'14'));
//                $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required'=>'14','valid_email'=>'15'));
//                $this->form_validation->set_rules('department_id', 'Department', 'required', array('required'=>'16'));
//                $this->form_validation->set_rules('shift_id', 'Shift', 'required', array('required'=>'17'));
//                $this->form_validation->set_rules('bank_id', 'Bank', 'required', array('required'=>'18'));
//                $this->form_validation->set_rules('account_no', 'Account No', 'required', array('required'=>'19'));
//                $this->form_validation->set_rules('cat_id', 'Employee Category', 'required', array('required'=>'20'));
//                $this->form_validation->set_rules('contract_type_id', 'Employee Type', 'required', array('required'=>'21'));
                $this->form_validation->set_rules('emp_status_id', 'Employee Type', 'required', array('required'=>'22'));
                
                
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Employee name is required.'; break;
//                        case 2: $return_json['e_text'] = 'Father name is required.'; break;
//                        case 3: $return_json['e_text'] = 'CNIC is required.'; break;
//                        case 4: $return_json['e_text'] = 'Enter valid CINC.'; break;
                        case 5: $return_json['e_text'] = 'Gender is required.'; break;
                        case 6: $return_json['e_text'] = 'Date of birth is required.'; break;
//                        case 7: $return_json['e_text'] = 'Permanent address isrequired.'; break;
//                        case 8: $return_json['e_text'] = 'District is required.'; break;
//                        case 9: $return_json['e_text'] = 'Country is required.'; break;
//                        case 10: $return_json['e_text'] = 'Contact no is required.'; break;
//                        case 11: $return_json['e_text'] = 'Enter valid number 0000-0000000'; break;
//                        case 12: $return_json['e_text'] = 'Network is required.'; break;
//                        case 13: $return_json['e_text'] = 'Religion is required.'; break;
//                        case 14: $return_json['e_text'] = 'Email is required.'; break;
//                        case 15: $return_json['e_text'] = 'Enter valid email'; break;
//                        case 16: $return_json['e_text'] = 'Department is required.'; break;
//                        case 17: $return_json['e_text'] = 'Shift is required.'; break;
//                        case 18: $return_json['e_text'] = 'Bank is required'; break;
//                        case 19: $return_json['e_text'] = 'Account no is required'; break;
//                        case 20: $return_json['e_text'] = 'Employee category is required'; break;
//                        case 21: $return_json['e_text'] = 'Employee type is required'; break;
//                        case 22: $return_json['e_text'] = 'Employee status is required'; break;
                    endswitch;
            else:

                 $dob_Y         = $this->input->post('dob_year');
                 $dob_M         = $this->input->post('dob_month');
                 $dob_D         = $this->input->post('dob_day');
                $retur_year     = $dob_Y+'60';
                        
            $file_name = '';
          
            
            if($_FILES['file']['name']):
                 $image      = $this->CRUDModel->do_resize('file','assets/images/employee');
                 $file_name  = $image['file_name'];
                        
            else:
                $file_name = $this->input->post('old_picture');     
                        
            endif;
                        
            $data = array(
                'emp_name'              => strtoupper($this->input->post('emp_name')),
                'father_name'           => strtoupper($this->input->post('father_name')),
                'emp_husband_name'      => strtoupper($this->input->post('emp_husband_name')),
                'nic'                   => $this->input->post('emp_cnic'),
                'gender_id'             => $this->input->post('gender_id'),
                'dob'                   => $dob_Y.'-'.$dob_M.'-'.$dob_D,
                'postal_address'        => $this->input->post('postal_address'),
                'permanent_address'     => $this->input->post('permanent_address'),
                'district_id'           => $this->input->post('district_id'),
                'post_office'           => $this->input->post('post_office'),
                'country_id'            => $this->input->post('country_id'),
                'ptcl_number'           => $this->input->post('ptcl_number'),
                'contact1'              => $this->input->post('contact1'),
                'net_id'                => $this->input->post('net_id'),
                'religion_id'           => $this->input->post('religion_id'),
                'marital_status_id'     => $this->input->post('marital_status_id'),
                'email'                 => $this->input->post('email'),
                'emp_status_id'         => $this->input->post('emp_status_id'),
                'comment'               => $this->input->post('emp_remarks'),
                'picture'               => $file_name,
                'retirement_date'       => $retur_year.'-'.$dob_M.'-'.$dob_D,
                );
               $this->CRUDModel->update('hr_emp_record',$data,array('emp_id'=>$this->input->post('employee_id')));
           
                $return_json = array(
                    'e_status'  => true,
                    'emp_id'    => $this->input->post('employee_id'),
                    'e_icon'    => '<i class="fa fa-check-circle"></i>',
                    'e_type'    => 'SUCCESS',
                    'e_text'    => 'Employee record update successfully.'
                );    
                endif;
            echo json_encode($return_json); 
        endif;
        if($this->input->post('SaveAcademic') =='SaveAcademic'):
                $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                
                $employee_id                = $this->input->post('employee_id');
                $degree_id                  = $this->input->post('degree_id');
                $board_university_id        = $this->input->post('board_university_id');
                

                $this->form_validation->set_rules('degree_id', 'Degree', 'required|is_where_unique[hr_emp_education,edu_degree_id,'.$degree_id.',edu_emp_id,'.$employee_id.']', array('required'=>'1','is_where_unique'=>'2'));
//                $this->form_validation->set_rules('board_university_id', 'Board', 'required', array('required'=>'3'));
//                $this->form_validation->set_rules('passing_year', 'Board', 'required', array('required'=>'4'));
//                $this->form_validation->set_rules('cgpa', 'GPA', 'required', array('required'=>'5'));
//                $this->form_validation->set_rules('div_id', 'Division', 'required', array('required'=>'6'));
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Degree / Certificate is required.'; break;
                        case 2: $return_json['e_text'] = 'Degree / Certificate is already exist.'; break;
//                        case 3: $return_json['e_text'] = 'Board / University is required.'; break;
//                        case 4: $return_json['e_text'] = 'Year of Passing is required.'; break;
//                        case 5: $return_json['e_text'] = 'GPA is required.'; break;
//                        case 6: $return_json['e_text'] = 'Division is required.'; break;
                    endswitch;
            else:
                
                $where = array(
                  'edu_emp_id'          => $employee_id,  
                  'edu_degree_id'       => $degree_id,  
                  'edu_bu_id'           => $board_university_id,  
                );
                $check_univer = $this->CRUDModel->get_where_row('hr_emp_education',$where);
                if($check_univer):
                    $return_json['e_status']    = false;
                    $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                    $return_json['e_text']      = 'Board / University is already exist';
                    $return_json['e_type']      = 'WARNING';
                    else:
                     $data = array(
                        'edu_emp_id'          => $employee_id,  
                        'edu_degree_id'       => $degree_id,  
                        'edu_bu_id'           => $board_university_id,  
                        'edu_passing_year'    => $this->input->post('passing_year'),  
                        'edu_cgpa'            => $this->input->post('cgpa'),  
                        'edu_div_id'          => $this->input->post('div_id'),  
                        'edu_hec_verified'    => $this->input->post('hec_verified'),  
                        'edu_remarks'         => $this->input->post('edu_remarks'),  
                        'edu_create_by'       => $this->UserInfo->user_id,  
                        'edu_create_date_time'=> date('Y-m-d H:i:s'),  
                      );
                   $this->CRUDModel->insert('hr_emp_education',$data);
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      ); 
                endif;
                
//               $this->UserInfo->user_id
            
                endif;
            echo json_encode($return_json); 
        endif;
        if($this->input->post('UpdateAcademic') =='UpdateAcademic'):
                $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                
                $employee_id                = $this->input->post('employee_id');
                $degree_id                  = $this->input->post('degree_id');
                $board_university_id        = $this->input->post('board_university_id');
                

                $this->form_validation->set_rules('degree_id', 'Degree', 'required|callback_education_degree_check', array('required'=>'1','education_degree_check'=>'2'));
//                $this->form_validation->set_rules('board_university_id', 'Board', 'required', array('required'=>'3'));
//                $this->form_validation->set_rules('passing_year', 'Board', 'required', array('required'=>'4'));
//                $this->form_validation->set_rules('cgpa', 'GPA', 'required', array('required'=>'5'));
//                $this->form_validation->set_rules('div_id', 'Division', 'required', array('required'=>'6'));
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Degree / Certificate is required.'; break;
                        case 2: $return_json['e_text'] = 'Degree / Certificate is already exist.'; break;
//                        case 3: $return_json['e_text'] = 'Board / University is required.'; break;
//                        case 4: $return_json['e_text'] = 'Year of Passing is required.'; break;
//                        case 5: $return_json['e_text'] = 'GPA is required.'; break;
//                        case 6: $return_json['e_text'] = 'Division is required.'; break;
                    endswitch;
            else:
                        
//                $where = array(
//                  'edu_emp_id'          => $employee_id,  
//                  'edu_degree_id'       => $degree_id,  
//                  'edu_bu_id'           => $board_university_id,
//                  'emp_edu_id !='       =>$this->input->post('emp_edu_id')
//                );
//                $check_univer = $this->CRUDModel->get_where_row('hr_emp_education',$where);
//                if($check_univer):
//                    $return_json['e_status']    = false;
//                    $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
//                    $return_json['e_text']      = 'Board / University is already exist';
//                    $return_json['e_type']      = 'WARNING';
//                    else:
                     $data = array(
//                        'edu_emp_id'          => $employee_id,  
                        'edu_degree_id'       => $degree_id,  
                        'edu_bu_id'           => $board_university_id,  
                        'edu_passing_year'    => $this->input->post('passing_year'),  
                        'edu_cgpa'            => $this->input->post('cgpa'),  
                        'edu_div_id'          => $this->input->post('div_id'),
                         'edu_remarks'         => $this->input->post('edu_remarks'),  
                        'edu_hec_verified'    => $this->input->post('hec_verified')  
                      );
                   $this->CRUDModel->update('hr_emp_education',$data,array('emp_edu_id'=>$this->input->post('emp_academic_id')));
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record update successfully.'
                      ); 
//                endif;
                endif;
            echo json_encode($return_json); 
        endif;
        if($this->input->post('saveExperience') =='saveExperience'):
                $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                
                $employee_id                = $this->input->post('employee_id');
                $degree_id                  = $this->input->post('degree_id');
                $board_university_id        = $this->input->post('board_university_id');
                
                $this->form_validation->set_rules('Department', 'Department', 'required', array('required'=>'1'));
                $this->form_validation->set_rules('jb_title', 'Department', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('from_exp_day', 'from_exp_day', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('from_exp_month', 'from_exp_month', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('from_exp_year', 'from_exp_year', 'required', array('required'=>'3'));
                
                $this->form_validation->set_rules('to_exp_day', 'from_exp_day', 'required', array('required'=>'4'));
                $this->form_validation->set_rules('to_exp_month', 'from_exp_month', 'required', array('required'=>'4'));
                $this->form_validation->set_rules('to_exp_year', 'from_exp_year', 'required', array('required'=>'4'));
//                $this->form_validation->set_rules('remarks', 'remarks', 'required', array('required'=>'4'));
                        
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Department is required.'; break;
                        case 2: $return_json['e_text'] = 'Job title is required.'; break;
                        case 3: $return_json['e_text'] = 'Experince From is required'; break;
                        case 4: $return_json['e_text'] = 'Experince To is required'; break;
//                        case 4: $return_json['e_text'] = 'Remarks required'; break;
                        
                    endswitch;
            else:
                $from_date =  $this->input->post('from_exp_year').'-'.$this->input->post('from_exp_month').'-'.$this->input->post('from_exp_day');    
                $to_date    = $this->input->post('to_exp_year').'-'.$this->input->post('to_exp_month').'-'.$this->input->post('to_exp_day');    
                $d1         = new DateTime($from_date); 
                $d2         = new DateTime($to_date);                                  
                $Months     = $d2->diff($d1); 
                
                $totalExp   = $Months->y.' Years '.$Months->m.' Months and '.$Months->d.' Days';
                $data = array(
                        'exp_emp_id'            => $this->input->post('employee_id'),  
                        'exp_emp_department'    => $this->input->post('Department'),  
                        'exp_emp_remarks'       => $this->input->post('exp_remarks'),  
                        'exp_emp_job_title'     => $this->input->post('jb_title'),  
                        'exp_from'              => $from_date,  
                        'exp_to'                => $to_date,  
                        'exp_total'             => $totalExp,  
                        'exp_create_by'         => $this->UserInfo->user_id,  
                        'exp_create_datetime'   => date('Y-m-d H:i:s'),
                      );
                   $this->CRUDModel->insert('hr_emp_experience',$data);
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      ); 
                endif;
            echo json_encode($return_json); 
        endif;
        if($this->input->post('updateExperience') =='updateExperience'):
                $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                
                $employee_id                = $this->input->post('employee_id');
                $degree_id                  = $this->input->post('degree_id');
                $board_university_id        = $this->input->post('board_university_id');
                
                 $this->form_validation->set_rules('Department', 'Department', 'required', array('required'=>'1'));
                $this->form_validation->set_rules('jb_title', 'Department', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('from_exp_day', 'from_exp_day', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('from_exp_month', 'from_exp_month', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('from_exp_year', 'from_exp_year', 'required', array('required'=>'3'));
                
                $this->form_validation->set_rules('to_exp_day', 'from_exp_day', 'required', array('required'=>'4'));
                $this->form_validation->set_rules('to_exp_month', 'from_exp_month', 'required', array('required'=>'4'));
                $this->form_validation->set_rules('to_exp_year', 'from_exp_year', 'required', array('required'=>'4'));
//                $this->form_validation->set_rules('remarks', 'remarks', 'required', array('required'=>'4'));
                        
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Department is required.'; break;
                        case 2: $return_json['e_text'] = 'Job title is required.'; break;
                        case 3: $return_json['e_text'] = 'Experince From is required'; break;
                        case 4: $return_json['e_text'] = 'Experince To is required'; break;
                    endswitch;
            else:
                $from_date =  $this->input->post('from_exp_year').'-'.$this->input->post('from_exp_month').'-'.$this->input->post('from_exp_day');    
                $to_date    = $this->input->post('to_exp_year').'-'.$this->input->post('to_exp_month').'-'.$this->input->post('to_exp_day');    
                $d1         = new DateTime($from_date); 
                $d2         = new DateTime($to_date);                                  
                $Months     = $d2->diff($d1); 
                
                $totalExp   = $Months->y.' Years '.$Months->m.' Months and '.$Months->d.' Days';
                $data = array(
                        'exp_emp_department'    => $this->input->post('Department'),  
                        'exp_emp_remarks'       => $this->input->post('exp_remarks'),
                        'exp_emp_job_title'     => $this->input->post('jb_title'),
                        'exp_from'              => $from_date,  
                        'exp_to'                => $to_date,  
                        'exp_total'             => $totalExp,  
                      );
                    $this->CRUDModel->update('hr_emp_experience',$data,array('exp_id'=>$this->input->post('experience_id')));
                    $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record update successfully.'
                      ); 
                endif;
            echo json_encode($return_json); 
        endif;
        if($this->input->post('saveDesignation') =='saveDesignation'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                        
                
                $this->form_validation->set_rules('category_id', 'Category', 'required', array('required'=>'1'));
//                $this->form_validation->set_rules('category_type_id', 'Category Type', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('designation_id', 'Designation', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('department_id', 'Department', 'required', array('required'=>'4'));
                        
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Category is required.'; break;
//                        case 2: $return_json['e_text'] = 'Category Type is required'; break;
//                        case 3: $return_json['e_text'] = 'Designation is required'; break;
                        case 4: $return_json['e_text'] = 'Department is required'; break;
                    endswitch;
            else:
                        
                
                        
                $data = array(
                        'emp_staff_emp_id'           => $this->input->post('employee_id'),  
//                        'emp_staff_designation_id'  => $this->input->post('designation_id'),
                        'emp_staff_category_id' => $this->input->post('category_id'),  
//                        'emp_staff_category_type_id' => $this->input->post('category_type_id'),  
                    
                        'emp_staff_department_id'    => $this->input->post('department_id'),  
                        
                        'emp_staff_remarks'          => $this->input->post('dep_remarks'),  
                        'emp_staff_create_by'        => $this->UserInfo->user_id,  
                        'emp_staff_create_datetime' => date('Y-m-d H:i:s'),
                      );
                   $this->CRUDModel->insert('hr_emp_staff_designation',$data);
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      );          
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('updateDesignation') =='updateDesignation'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                        
                
                $this->form_validation->set_rules('category_id', 'Category', 'required', array('required'=>'1'));
//                $this->form_validation->set_rules('category_type_id', 'Category Type', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('designation_id', 'Designation', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('department_id', 'Department', 'required', array('required'=>'4'));
                        
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Category is required.'; break;
//                        case 2: $return_json['e_text'] = 'Category Type is required'; break;
//                        case 3: $return_json['e_text'] = 'Designation is required'; break;
                        case 4: $return_json['e_text'] = 'Department is required'; break;
                    endswitch;
            else:
                $data = array( 
                        'emp_staff_department_id'   => $this->input->post('department_id'),
                        'emp_staff_category_id'     => $this->input->post('category_id'),  
//                        'emp_staff_category_type_id'=> $this->input->post('category_type_id'),
                        'emp_staff_remarks'         => $this->input->post('dep_remarks'));
                        
                   $this->CRUDModel->update('hr_emp_staff_designation',$data,array('emp_staff_design_id'=>$this->input->post('emp_staff_design_id')));
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      );          
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('saveFund') =='saveFund'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                $this->form_validation->set_rules('fund', 'Fund', 'required', array('required'=>'1'));
                $this->form_validation->set_rules('fund_day', 'Fund Day', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('fund_month', 'Fund Month', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('fund_year', 'Fund Year', 'required', array('required'=>'2'));
               
                    if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Fund is required.'; break;
                        case 2: $return_json['e_text'] = 'Fund date is required.'; break;
                    endswitch;
            else:
                $data = array(
                        'emf_emp_id'        => $this->input->post('employee_id'),  
                        'emf_date'          => $from_date =  $this->input->post('fund_year').'-'.$this->input->post('fund_month').'-'.$this->input->post('fund_day'),  
                        'emf_emp_fund_id'   => $this->input->post('fund'),  
                        'emf_remarks'   => $this->input->post('fund_remarks'),  
                        'emf_create_by'     => $this->UserInfo->user_id,  
                        'emf_date_time'     => date('Y-m-d H:i:s'),
                      );
                   $this->CRUDModel->insert('hr_emp_staff_fund_status',$data);
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      );          
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('updateFund') =='updateFund'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                $this->form_validation->set_rules('fund', 'Fund', 'required', array('required'=>'1'));
                $this->form_validation->set_rules('fund_day', 'Fund Day', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('fund_month', 'Fund Month', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('fund_year', 'Fund Year', 'required', array('required'=>'2'));
               
                    if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Fund is required.'; break;
                        case 2: $return_json['e_text'] = 'Fund date is required.'; break;
                    endswitch;
            else:
                $data = array(
                        'emf_date'          => $from_date =  $this->input->post('fund_year').'-'.$this->input->post('fund_month').'-'.$this->input->post('fund_day'),  
                        'emf_emp_fund_id'   => $this->input->post('fund'),
                        'emf_remarks'       => $this->input->post('fund_remarks'),  
                      );
                   $this->CRUDModel->update('hr_emp_staff_fund_status',$data,array('emf_id'=>$this->input->post('fund_pk_id')));
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record update successfully.'
                      );          
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('saveShift') =='saveShift'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                $this->form_validation->set_rules('shift', 'Shift', 'required', array('required'=>'1'));
                $this->form_validation->set_rules('shift_day', 'Shift Day', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('shift_month', 'Shift Month', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('shift_year', 'Shift Year', 'required', array('required'=>'2'));
               
                    if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Shift is required.'; break;
                        case 2: $return_json['e_text'] = 'Shift date is required.'; break;
                    endswitch;
            else:
                $data = array(
                        'ess_emp_id'        => $this->input->post('employee_id'),  
                        'ess_date'          => $from_date =  $this->input->post('shift_year').'-'.$this->input->post('shift_month').'-'.$this->input->post('shift_day'),  
                        'ess_shift_id'      => $this->input->post('shift'), 
                        'ess_remarks'       => $this->input->post('shif_remarks'),
                        'ess_create_by'     => $this->UserInfo->user_id,  
                        'ess_date_time'     => date('Y-m-d H:i:s'),
                      );
                   $this->CRUDModel->insert('hr_emp_staff_shift',$data);
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      );          
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('updateShift') =='updateShift'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                $this->form_validation->set_rules('shift', 'Shift', 'required', array('required'=>'1'));
//                $this->form_validation->set_rules('shift_day', 'Shift Day', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('shift_month', 'Shift Month', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('shift_year', 'Shift Year', 'required', array('required'=>'2'));
               
                    if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Fund is required.'; break;
//                        case 2: $return_json['e_text'] = 'Fund date is required.'; break;
                    endswitch;
            else:
                $data = array(
                        'ess_date'       => $from_date =  $this->input->post('shift_year').'-'.$this->input->post('shift_month').'-'.$this->input->post('shift_day'),  
                        'ess_shift_id'   => $this->input->post('shift'),
                        'ess_remarks'       => $this->input->post('shif_remarks'),
                        
                      );
                   $this->CRUDModel->update('hr_emp_staff_shift',$data,array('ess_id'=>$this->input->post('shift_pk_id')));
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record update successfully.'
                      );          
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('saveBank') =='saveBank'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                $this->form_validation->set_rules('bank', 'bank', 'required', array('required'=>'1'));
                $this->form_validation->set_rules('branch', 'branch', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('account_no', '', 'required', array('required'=>'3'));
                
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Bank is required.'; break;
                        case 2: $return_json['e_text'] = 'Branch is required.'; break;
                        case 2: $return_json['e_text'] = 'Account # is required.'; break;
                    endswitch;
            else:
                $where_chk = array(
                    'heb_bank_id'           => $this->input->post('bank'), 
                    'heb_account_no'        => $this->input->post('account_no'),  
                );
                
                $query_chk = $this->CRUDModel->get_where_row('hr_emp_bank',$where_chk);
                if(empty($query_chk)):
                    
                     if($this->input->post('default_acct') == '1'):
                         $this->CRUDModel->update('hr_emp_bank',array('heb_default_account'=>2),array('heb_emp_id'=> $this->input->post('employee_id')));
                    endif;
                    
                    
                    $data = array(
                        'heb_emp_id'            => $this->input->post('employee_id'),  
//                        'ess_date'          => $from_date =  $this->input->post('shift_year').'-'.$this->input->post('shift_month').'-'.$this->input->post('shift_day'),  
                        'heb_bank_id'           => $this->input->post('bank'), 
                        'heb_branch_id'         => $this->input->post('branch'),
                        'heb_account_no'        => $this->input->post('account_no'),
                        'heb_default_account'   => $this->input->post('default_acct'),
                        'heb_remarks'           => $this->input->post('bank_remarks'),
                        'heb_create_by'         => $this->UserInfo->user_id,  
                        'heb_datetime'         => date('Y-m-d H:i:s'),
                      );
                   $this->CRUDModel->insert('hr_emp_bank',$data);
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      );
                else:
                    $return_json = array(
                          'e_status'  => false,
                          'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                          'e_type'    => 'WARNING',
                          'e_text'    => 'Account # already exist'
                      );
                endif;
                          
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('updateBank') =='updateBank'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                $this->form_validation->set_rules('bank', 'bank', 'required', array('required'=>'1'));
                $this->form_validation->set_rules('branch', 'branch', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('account_no', '', 'required', array('required'=>'3'));
               
                    if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Bank is required.'; break;
                        case 2: $return_json['e_text'] = 'Branch is required.'; break;
                        case 2: $return_json['e_text'] = 'Account # is required.'; break;
                    endswitch;
            else:
                
                 $where_chk = array(
                    'heb_bank_id'           => $this->input->post('bank'), 
                    'heb_account_no'        => $this->input->post('account_no'),
                    'heb_id !='             => $this->input->post('bank_emp_id')
                );
                
                $query_chk = $this->CRUDModel->get_where_row('hr_emp_bank',$where_chk);
                
                if(empty($query_chk)):
                    
                     if($this->input->post('default_acct') == '1'):
                         $this->CRUDModel->update('hr_emp_bank',array('heb_default_account'=>2),array('heb_emp_id'=> $this->input->post('employee_id')));
                    endif;
                    
                    
                    $data = array(
                        'heb_bank_id'           => $this->input->post('bank'), 
                        'heb_branch_id'         => $this->input->post('branch'),
                        'heb_account_no'        => $this->input->post('account_no'),
                        'heb_default_account'   => $this->input->post('default_acct'),
                        'heb_remarks'           => $this->input->post('bank_remarks'),
                        
                      );
                   $this->CRUDModel->update('hr_emp_bank',$data,array('heb_id'=>$this->input->post('bank_emp_id')));
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record update successfully.'
                      ); 
                    else:
                     $return_json = array(
                          'e_status'  => false,
                          'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                          'e_type'    => 'WARNING',
                          'e_text'    => 'Account # already exist'
                      );
                endif;
                         
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('saveAllowance') =='saveAllowance'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
               
                $this->form_validation->set_rules('allowance', 'allowance', 'required', array('required'=>'1'));
//                $this->form_validation->set_rules('allowance_day', 'branch', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('allowance_month', 'branch', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('allowance_year', 'branch', 'required', array('required'=>'2'));
                
                
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Allowance is required.'; break;
//                        case 2: $return_json['e_text'] = 'Allowance date is required.'; break;
                        
                    endswitch;
            else:
                $where_chk = array(
                    'hsa_emp_id'           => $this->input->post('employee_id'), 
                    'hsa_allowanc_id'      => $this->input->post('allowance'), 
                    
                );
                $query_chk = $this->CRUDModel->get_where_row(' hr_staff_allowance',$where_chk);
                if(empty($query_chk)):
                     $data = array(
                        'hsa_emp_id'            => $this->input->post('employee_id'), 
                        'hsa_allowanc_id'       => $this->input->post('allowance'),  
                        'hsa_date'              => $this->input->post('allowance_year').'-'.$this->input->post('allowance_month').'-'.$this->input->post('allowance_day'),  
                        'hsa_remarks'           => $this->input->post('allowance_remarks'),
                        'hsa_default_allowanc'  => $this->input->post('default_allowance'),
                        'hsa_create_by'         => $this->UserInfo->user_id,  
                        'hsa_datetime'          => date('Y-m-d H:i:s'),
                      );
                   $this->CRUDModel->insert('hr_staff_allowance',$data);
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      );
                else:
                    $return_json = array(
                          'e_status'  => false,
                          'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                          'e_type'    => 'WARNING',
                          'e_text'    => 'Allowance already exist'
                      );
                endif;
                          
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('updateAllownance') =='updateAllownance'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                
                $this->form_validation->set_rules('allowance', 'allowance', 'required', array('required'=>'1'));
//                $this->form_validation->set_rules('allowance_day', 'branch', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('allowance_month', 'branch', 'required', array('required'=>'2'));
//                $this->form_validation->set_rules('allowance_year', 'branch', 'required', array('required'=>'2'));
               
                    if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Allowance is required.'; break;
//                        case 2: $return_json['e_text'] = 'Allowance date is required.'; break;
                    endswitch;
            else:
                
                 $where_chk = array(
                    'hsa_emp_id'           => $this->input->post('employee_id'), 
                    'hsa_allowanc_id'      => $this->input->post('allowance'),
                    'hsa_id !='           => $this->input->post('allowance_id'));
                $query_chk = $this->CRUDModel->get_where_row('hr_staff_allowance',$where_chk);
                
                if(empty($query_chk)):
                    $data = array(
                        'hsa_allowanc_id'       => $this->input->post('allowance'),  
                        'hsa_date'              => $this->input->post('allowance_year').'-'.$this->input->post('allowance_month').'-'.$this->input->post('allowance_day'),  
                        'hsa_remarks'           => $this->input->post('allowance_remarks'),
                        'hsa_default_allowanc'  => $this->input->post('default_allowance'));
                   $this->CRUDModel->update('hr_staff_allowance',$data,array('hsa_id'=>$this->input->post('allowance_id')));
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record update successfully.'
                      ); 
                    else:
                     $return_json = array(
                          'e_status'  => false,
                          'e_icon'    => '<i class="fa fa-exclamation-triangle"></i>',
                          'e_type'    => 'WARNING',
                          'e_text'    => 'Account # already exist'
                      );
                endif;
                         
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('saveResponsibility') =='saveResponsibility'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
               
                $this->form_validation->set_rules('responsibility', '', 'required', array('required'=>'1'));
                
                $this->form_validation->set_rules('Resp_from_day', '', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('Resp_from_month', '', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('Resp_from_year', '', 'required', array('required'=>'2'));
                
                $this->form_validation->set_rules('Resp_to_day', '', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('Resp_to_month', '', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('Resp_to_year', '', 'required', array('required'=>'3'));
                
                
                
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Responsibility is required.'; break;
                        case 2: $return_json['e_text'] = 'Responsibility from date is required.'; break;
                        case 3: $return_json['e_text'] = 'Responsibility to date is required.'; break;
                        
                    endswitch;
            else:
                
                     $data = array(
                        'resp_emp_id'           => $this->input->post('employee_id'), 
                        'resp_details'          => $this->input->post('responsibility'),  
                        'resp_from_date'        => $this->input->post('Resp_from_year').'-'.$this->input->post('Resp_from_month').'-'.$this->input->post('Resp_from_day'),  
                        'resp_to_date'          => $this->input->post('Resp_to_year').'-'.$this->input->post('Resp_to_month').'-'.$this->input->post('Resp_to_day'),  
                        'resp_remarks'          => $this->input->post('Resp_remarks'),
                        'resp_status'           => $this->input->post('Resp_status'),
                        'resp_create_by'        => $this->UserInfo->user_id,  
                        'resp_date_time'        => date('Y-m-d H:i:s'),
                      );
                   $this->CRUDModel->insert('hr_emp_responsibility',$data);
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      );
                        
                          
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('updateResponsibility') =='updateResponsibility'):
                $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
                
                $this->form_validation->set_rules('responsibility', '', 'required', array('required'=>'1'));
                
                $this->form_validation->set_rules('Resp_from_day', '', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('Resp_from_month', '', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('Resp_from_year', '', 'required', array('required'=>'2'));
                
                $this->form_validation->set_rules('Resp_to_day', '', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('Resp_to_month', '', 'required', array('required'=>'3'));
                $this->form_validation->set_rules('Resp_to_year', '', 'required', array('required'=>'3'));
               
                    if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        
                    switch ($fve):
                        case 1: $return_json['e_text'] = 'Responsibility is required.'; break;
                        case 2: $return_json['e_text'] = 'Responsibility from date is required.'; break;
                        case 3: $return_json['e_text'] = 'Responsibility to date is required.'; break;
                    endswitch;
            else:
                
                        
                    $data = array(
                        'resp_details'          => $this->input->post('responsibility'),  
                        'resp_from_date'        => $this->input->post('Resp_from_year').'-'.$this->input->post('Resp_from_month').'-'.$this->input->post('Resp_from_day'),  
                        'resp_to_date'          => $this->input->post('Resp_to_year').'-'.$this->input->post('Resp_to_month').'-'.$this->input->post('Resp_to_day'),  
                        'resp_remarks'          => $this->input->post('Resp_remarks'),
                        'resp_status'           => $this->input->post('Resp_status')
                    );
                   $this->CRUDModel->update('hr_emp_responsibility',$data,array('resp_id'=>$this->input->post('Resp_id')));
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record update successfully.'
                      ); 
                        
                         
             endif;           
            echo json_encode($return_json); 
        endif;
        if($this->input->post('saveLetter') =='saveLetter'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
               
//                 $this->form_validation->set_rules('c_renwal_letter_no', '', 'required', array('required'=>'1'));
                
                $this->form_validation->set_rules('letter_day', '', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('letter_month', '', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('letter_year', '', 'required', array('required'=>'2'));
//                
//                $this->form_validation->set_rules('c_f_day', '', 'required', array('required'=>'3'));
//                $this->form_validation->set_rules('c_f_month', '', 'required', array('required'=>'3'));
//                $this->form_validation->set_rules('c_f_year', '', 'required', array('required'=>'3'));
//                
//                $this->form_validation->set_rules('c_t_day', '', 'required', array('required'=>'4'));
//                $this->form_validation->set_rules('c_t_month', '', 'required', array('required'=>'4'));
//                $this->form_validation->set_rules('c_t_year', '', 'required', array('required'=>'4'));
                
                $this->form_validation->set_rules('ltr_category_id', '', 'required', array('required'=>'5'));
                $this->form_validation->set_rules('ltr_category_type_id', '', 'required', array('required'=>'6'));
                $this->form_validation->set_rules('ltr_designation_id', '', 'required', array('required'=>'7'));
                $this->form_validation->set_rules('scale_id', '', 'required', array('required'=>'8'));
                $this->form_validation->set_rules('contract_status', '', 'required', array('required'=>'9'));
                
                
                
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('','');
                    $fve =  validation_errors();
                        
                    switch ($fve):
//                        case 1: $return_json['e_text'] = 'Letter No is required.'; break;
                        case 2: $return_json['e_text'] = 'Letter date is required.'; break;
//                        case 3: $return_json['e_text'] = 'Contrate from date is required.'; break;
//                        case 4: $return_json['e_text'] = 'Contrate to date is required.'; break;
                        case 5: $return_json['e_text'] = 'Category is required.'; break;
                        case 6: $return_json['e_text'] = 'Category type is required.'; break;
                        case 7: $return_json['e_text'] = 'Designation is required.'; break;
                        case 8: $return_json['e_text'] = 'Scale is required.'; break;
                        case 9: $return_json['e_text'] = 'Contract status is required.'; break;
                        
                    endswitch;
            else:
                
                    $emp_info = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$this->input->post('employee_id')));
                    $file_name          = '';
                    if(!empty($_FILES['file']['name'])):
                       $image       = $this->CRUDModel->uploadDirectory('file','assets/images/employee/contract_files');
                        $file_name  = $image['file_name'];
                    endif;
            
            
                     $data = array(
                        'c_renwal_emp_id'           => $this->input->post('employee_id'), 
                        'c_renwal_letter_no'        => $this->input->post('c_renwal_letter_no'),  
                        'c_renwal_contract_date'    => $this->input->post('letter_year').'-'.$this->input->post('letter_month').'-'.$this->input->post('letter_day'),  
                        'c_renwal_from_date'        => $this->input->post('c_f_year').'-'.$this->input->post('c_f_month').'-'.$this->input->post('c_f_day'),  
                        'c_renwal_to_date'          => $this->input->post('c_t_year').'-'.$this->input->post('c_t_month').'-'.$this->input->post('c_t_day'),  
                        'c_renwal_category_id'      => $this->input->post('ltr_category_id'),
                        'c_renwal_category_type_id' => $this->input->post('ltr_category_type_id'),
                        'c_renewal_designation_id'  => $this->input->post('ltr_designation_id'),
                        'c_renwal_scale'            => $this->input->post('scale_id'),
                        'c_renwal_emp_status'       => $emp_info->emp_status_id,
                        'c_renewal_contract_status_id'  => $this->input->post('contract_status'),
                        'c_renwal_image'            => $file_name,
                        'c_renwal_details'          => $this->input->post('renewal_details'),
                        'c_renwal_remarks'          => $this->input->post('renewal_remarks'),
                        'c_renwal_create_by'        => $this->UserInfo->user_id,  
                        'c_renwal_create_datetime'  => date('Y-m-d H:i:s'),
                      );
                   $this->CRUDModel->insert('hr_contract_reneval',$data);
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record saved successfully.'
                      );
                        
                          
             endif;           
            echo json_encode($return_json); 
        endif;                
        if($this->input->post('updateLetter') =='updateLetter'):
               $return_json['e_status']    = false;
                $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                $return_json['e_type']      = 'WARNING';
               
//                 $this->form_validation->set_rules('c_renwal_letter_no', '', 'required', array('required'=>'1'));
                
                $this->form_validation->set_rules('letter_day', '', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('letter_month', '', 'required', array('required'=>'2'));
                $this->form_validation->set_rules('letter_year', '', 'required', array('required'=>'2'));
                
//                $this->form_validation->set_rules('c_f_day', '', 'required', array('required'=>'3'));
//                $this->form_validation->set_rules('c_f_month', '', 'required', array('required'=>'3'));
//                $this->form_validation->set_rules('c_f_year', '', 'required', array('required'=>'3'));
//                
//                $this->form_validation->set_rules('c_t_day', '', 'required', array('required'=>'4'));
//                $this->form_validation->set_rules('c_t_month', '', 'required', array('required'=>'4'));
//                $this->form_validation->set_rules('c_t_year', '', 'required', array('required'=>'4'));
                
                $this->form_validation->set_rules('ltr_category_id', '', 'required', array('required'=>'5'));
                $this->form_validation->set_rules('ltr_category_type_id', '', 'required', array('required'=>'6'));
                $this->form_validation->set_rules('ltr_designation_id', '', 'required', array('required'=>'7'));
                $this->form_validation->set_rules('scale_id', '', 'required', array('required'=>'8'));
                $this->form_validation->set_rules('contract_status', '', 'required', array('required'=>'9'));
                
                
                
                if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('','');
                    $fve =  validation_errors();
                        
                    switch ($fve):
//                        case 1: $return_json['e_text'] = 'Letter No is required.'; break;
                        case 2: $return_json['e_text'] = 'Letter date is required.'; break;
//                        case 3: $return_json['e_text'] = 'Contrate from date is required.'; break;
//                        case 4: $return_json['e_text'] = 'Contrate to date is required.'; break;
                        case 5: $return_json['e_text'] = 'Category is required.'; break;
                        case 6: $return_json['e_text'] = 'Category type is required.'; break;
                        case 7: $return_json['e_text'] = 'Designation is required.'; break;
                        case 8: $return_json['e_text'] = 'Scale is required.'; break;
                        case 9: $return_json['e_text'] = 'Contract status is required.'; break;
                        
                    endswitch;
            else:
                
                    $emp_info = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$this->input->post('employee_id')));
                    $file_name          = '';
                    if(!empty($_FILES['file']['name'])):
                       $image      = $this->CRUDModel->uploadDirectory('file','assets/images/employee/contract_files');
                        $file_name  = $image['file_name'];
                        $path = 'assets/images/employee/contract_files/'.$this->input->post('old_image');
                        @unlink($path);
                    else:
                         $file_name  = $this->input->post('old_image');   
                    endif;
            
            
                     $data = array(
                        'c_renwal_letter_no'        => $this->input->post('c_renwal_letter_no'),  
                        'c_renwal_contract_date'    => $this->input->post('letter_year').'-'.$this->input->post('letter_month').'-'.$this->input->post('letter_day'),  
                        'c_renwal_from_date'        => $this->input->post('c_f_year').'-'.$this->input->post('c_f_month').'-'.$this->input->post('c_f_day'),  
                        'c_renwal_to_date'          => $this->input->post('c_t_year').'-'.$this->input->post('c_t_month').'-'.$this->input->post('c_t_day'),  
                        'c_renwal_category_id'      => $this->input->post('ltr_category_id'),
                        'c_renwal_category_type_id' => $this->input->post('ltr_category_type_id'),
                        'c_renewal_designation_id'  => $this->input->post('ltr_designation_id'),
                        'c_renwal_scale'            => $this->input->post('scale_id'),
                        'c_renwal_emp_status'       => $emp_info->emp_status_id,
                        'c_renewal_contract_status_id'  => $this->input->post('contract_status'),
                        'c_renwal_image'            => $file_name,
                        'c_renwal_details'          => $this->input->post('renewal_details'),
                        'c_renwal_remarks'          => $this->input->post('renewal_remarks'),
                        
                      );
                   $this->CRUDModel->update('hr_contract_reneval',$data,array('contract_id'=>$this->input->post('Letter_id')));
                   $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'    => 'SUCCESS',
                          'e_text'    => 'Record update successfully.'
                      );
                        
                          
             endif;           
            echo json_encode($return_json); 
        endif;                
        }
    
    public function check_tab(){
        
            if($this->input->post('request')== 'academic'):
                if(empty($this->CRUDModel->get_where_row('hr_emp_education',array('edu_emp_id'=>$this->input->post('employee_id'))))):
                    echo  1;
                else:
                    echo  0;
                endif;
            endif;
            if($this->input->post('request')== 'experience'):
                if(empty($this->CRUDModel->get_where_row('hr_emp_experience',array('exp_emp_id'=>$this->input->post('employee_id'))))):
                    echo  1;
                else:
                    echo  0;
                endif;
            endif;
            if($this->input->post('request')== 'department'):
                if(empty($this->CRUDModel->get_where_row('hr_emp_staff_designation',array('emp_staff_emp_id'=>$this->input->post('employee_id'))))):
                    echo  1;
                else:
                    echo  0;
                endif;
            endif;
            if($this->input->post('request')== 'fund'):
                if(empty($this->CRUDModel->get_where_row('hr_emp_staff_fund_status',array('emf_emp_id'=>$this->input->post('employee_id'))))):
                    echo  1;
                else:
                    echo  0;
                endif;
            endif;
            if($this->input->post('request')== 'shift'):
                if(empty($this->CRUDModel->get_where_row('hr_emp_staff_shift',array('ess_emp_id'=>$this->input->post('employee_id'))))):
                    echo  1;
                else:
                    echo  0;
                endif;
            endif;
            if($this->input->post('request')== 'bank'):
                if(empty($this->CRUDModel->get_where_row('hr_emp_bank',array('heb_emp_id'=>$this->input->post('employee_id'))))):
                    echo  1;
                else:
                    echo  0;
                endif;
            endif;
            if($this->input->post('request')== 'allowance'):
                if(empty($this->CRUDModel->get_where_row('hr_staff_allowance',array('hsa_emp_id'=>$this->input->post('employee_id'))))):
                    echo  1;
                else:
                    echo  0;
                endif;
            endif;
            if($this->input->post('request')== 'responsibility'):
                if(empty($this->CRUDModel->get_where_row('hr_emp_responsibility',array('resp_emp_id'=>$this->input->post('employee_id'))))):
                    echo  1;
                else:
                    echo  0;
                endif;
            endif;
            if($this->input->post('request')== 'letter'):
                if(empty($this->CRUDModel->get_where_row('hr_contract_reneval',array('c_renwal_emp_id'=>$this->input->post('employee_id'))))):
                    echo  1;
                else:
                    echo  0;
                endif;
            endif;
                        
    }
    public function employee_information_details(){
        if($this->input->post('request') == 'wedget_PersonalInfo'):
            $this->data['result'] = $this->HrModel->get_employee_details(array('emp_id'=>$this->input->post('employee_id')));
            $this->load->view('HR/hr_wedgets/employee_details_v',$this->data);
        endif;
        if($this->input->post('request') == 'basic_Info'):
                echo json_encode($this->HrModel->employee_basic_info(array('emp_id'=>$this->input->post('employee_id'))));
        endif;
        if($this->input->post('request') == 'academic_grid'):
            $this->data['result'] = $this->HrModel->get_employee_academics(array('hr_emp_record.emp_id'=>$this->input->post('employee_id')));
                        
            if(!empty($this->data['result'])):
                $this->load->view('HR/Forms/jquery_results/academic_grid_v',$this->data);
            endif;
        endif;
        if($this->input->post('request') == 'academic_delete'):
            $where      = array('emp_edu_id'=>$this->input->post('academic_id'));
            $this->CRUDModel->deleteid('hr_emp_education',$where);
        endif;
        if($this->input->post('request') == 'academic_update'):
            echo json_encode($this->HrModel->get_employee_academic(array('emp_edu_id'=>$this->input->post('academic_id'))));
        endif;
        if($this->input->post('request') == 'experience_grid'):
            $this->data['result'] = $this->CRUDModel->get_where_result('hr_emp_experience',array('exp_emp_id'=>$this->input->post('employee_id')));
            if(!empty($this->data['result'])):
                $this->load->view('HR/Forms/jquery_results/experience_grid_v',$this->data);
            endif;
        endif;
        if($this->input->post('request') == 'experienc_update'):
            echo json_encode($this->CRUDModel->get_where_row('hr_emp_experience',array('exp_id'=>$this->input->post('experienc_id'))));
        endif;
        if($this->input->post('request') == 'experienc_delete'):
            $where      = array('exp_id'=>$this->input->post('experienc_id'));
            $this->CRUDModel->deleteid('hr_emp_experience',$where);
        endif;
        if($this->input->post('request') == 'designation_grid'):
            $this->data['result'] = $this->HrModel->get_employee_designations(array('emp_staff_emp_id'=>$this->input->post('employee_id')));
//            echo '<pre>';print_r($this->data['result']);
            if(!empty($this->data['result'])):
                $this->load->view('HR/Forms/jquery_results/employee_designation_grid_v',$this->data);
            endif;
        endif;
        if($this->input->post('request') == 'designation_update'):
            echo json_encode($this->HrModel->get_employee_designation(array('emp_staff_design_id'=>$this->input->post('designation_id'))));
        endif;
        if($this->input->post('request') == 'designation_delete'):
            $where      = array('emp_staff_design_id'=>$this->input->post('designation_id'));
            $this->CRUDModel->deleteid('hr_emp_staff_designation',$where);
        endif;
        if($this->input->post('request') == 'fund_grid'):
            $this->data['result'] = $this->HrModel->get_employee_fund(array('emf_emp_id'=>$this->input->post('employee_id')));
            if(!empty($this->data['result'])):
                $this->load->view('HR/Forms/jquery_results/fund_grid_v',$this->data);
            endif;
        endif;
         if($this->input->post('request') == 'fund_delete'):
            $where      = array('emf_id'=>$this->input->post('fund_id'));
            $this->CRUDModel->deleteid('hr_emp_staff_fund_status',$where);
        endif;
        if($this->input->post('request') == 'fund_update'):
            echo json_encode($this->CRUDModel->get_where_row('hr_emp_staff_fund_status',array('emf_id'=>$this->input->post('fund_id'))));
        endif;
        if($this->input->post('request') == 'shift_grid'):
            $this->data['result'] = $this->HrModel->get_employee_shifts(array('ess_emp_id'=>$this->input->post('employee_id')));
            if(!empty($this->data['result'])):
                $this->load->view('HR/Forms/jquery_results/shift_grid_v',$this->data);
            endif;
        endif;
        if($this->input->post('request') == 'shift_update'):
            echo json_encode($this->HrModel->get_employee_shift(array('ess_id'=>$this->input->post('fund_id'))));
        endif;
          if($this->input->post('request') == 'shift_delete'):
            $where      = array('ess_id'=>$this->input->post('shift_id'));
            $this->CRUDModel->deleteid('hr_emp_staff_shift',$where);
        endif;
        if($this->input->post('request') == 'bank_grid'):
            $this->data['result'] = $this->HrModel->get_employee_banks(array('heb_emp_id'=>$this->input->post('employee_id')));
            if(!empty($this->data['result'])):
                $this->load->view('HR/Forms/jquery_results/bank_grid_v',$this->data);
            endif;
        endif;
        if($this->input->post('request') == 'bank_update'):
            echo json_encode($this->HrModel->get_employee_bank(array('heb_id'=>$this->input->post('bank_id'))));
        endif;
         if($this->input->post('request') == 'bank_delete'):
            $where      = array('heb_id'=>$this->input->post('bank_id'));
            $this->CRUDModel->deleteid('hr_emp_bank',$where);
        endif;
       if($this->input->post('request') == 'allowance_grid'):
            $this->data['result'] = $this->HrModel->get_employee_allowances(array('hsa_emp_id'=>$this->input->post('employee_id')));
            if(!empty($this->data['result'])):
                $this->load->view('HR/Forms/jquery_results/allowamce_grid_v',$this->data);
            endif;
        endif;
        if($this->input->post('request') == 'allowance_update'):
            echo json_encode($this->CRUDModel->get_where_row('hr_staff_allowance',array('hsa_id'=>$this->input->post('allowance_id'))));
        endif;
        if($this->input->post('request') == 'allowance_delete'):
            $where      = array('hsa_id'=>$this->input->post('allowance_id'));
            $this->CRUDModel->deleteid('hr_staff_allowance',$where);
        endif;
        if($this->input->post('request') == 'responsibility_grid'):
            $this->data['result'] = $this->HrModel->get_employee_responsibilities(array('resp_emp_id'=>$this->input->post('employee_id')));
            if(!empty($this->data['result'])):
                $this->load->view('HR/Forms/jquery_results/responsibility_grid_v',$this->data);
            endif;
        endif;
        if($this->input->post('request') == 'respon_update'):
            echo json_encode($this->CRUDModel->get_where_row('hr_emp_responsibility',array('resp_id'=>$this->input->post('respon_id'))));
        endif;
        if($this->input->post('request') == 'respon_delete'):
            $where      = array('resp_id'=>$this->input->post('respon_id'));
            $this->CRUDModel->deleteid('hr_emp_responsibility',$where);
        endif;
        if($this->input->post('request') == 'letter_grid'):
            $this->data['result'] = $this->HrModel->get_employee_letters(array('c_renwal_emp_id'=>$this->input->post('employee_id')));
            if(!empty($this->data['result'])):
                $this->load->view('HR/Forms/jquery_results/letter_grid_v',$this->data);
            endif;
        endif;
        if($this->input->post('request') == 'letter_update'):
            echo json_encode($this->CRUDModel->get_where_row('hr_contract_reneval',array('contract_id'=>$this->input->post('letter_id'))));
        endif;
         if($this->input->post('request') == 'letter_delete'):
            $where      = array('contract_id'=>$this->input->post('letter_id'));
            $this->CRUDModel->deleteid('hr_contract_reneval',$where);
        endif;
         if($this->input->post('request') == 'letter_file_delete'):
            $data = array(
              'c_renwal_image' =>''  
            );
            $this->CRUDModel->update('hr_contract_reneval',$data,array('contract_id'=>$this->input->post('Letter_id')));
            $path = 'assets/images/employee/contract_files/'.$this->input->post('old_image');
            @unlink($path);
        endif;
    }
    public function update_employee(){
              //Employee Registration
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
        $this->data['network']      = $this->CRUDModel->dropDown('mobile_network', 'Select', 'net_id', 'network',array('net_id !='=>'0'));
        $this->data['religion']     = $this->CRUDModel->dropDown('religion', 'Select', 'religion_id', 'title');
        $this->data['m_status']     = $this->CRUDModel->dropDown('marital_status', 'Select', 'marital_status_id', 'title');
        $this->data['status']       = $this->CRUDModel->dropDown('hr_emp_status', '', 'emp_status_id', 'emp_status_name',array('emp_status_id'=>1));
         //Adacdemics
        $this->data['division']             = $this->CRUDModel->dropDown('hr_emp_division', 'Select Division', 'devision_id', 'division_name');
        //Staff Department
         $this->data['Category']    = $this->CRUDModel->DropDown_Code('hr_emp_category', 'CATEGORY', 'category_id', 'category_name','category_code');
        $this->data['CategoryType'] = $this->CRUDModel->DropDown_Code('hr_emp_category_type', 'CATEGORY TYPE', 'category_type_id', 'ctgy_type_name','ctgy_type_code');
        $this->data['Designation']  = $this->CRUDModel->DropDown_Code('hr_emp_designation', 'DESIGNATION', 'emp_desg_id', 'emp_desg_name','emp_desg_code');
        $this->data['department']     = $this->CRUDModel->dropDown('hr_emp_departments', 'DEPARTMENT', 'emp_deprt_id', 'emp_deprt_name','',array('column'=>'emp_deprt_name','order'=>'asc'));
        //Staff Funds
        $this->data['funds']        = $this->CRUDModel->dropDown('hr_emp_fund_status', 'Select Fund', 'fund_status_id', 'fund_status_name','',array('column'=>'fund_status_name','order'=>'asc'));
        //Staff Shift 
        $this->data['Shift']        = $this->CRUDModel->dropDown('shift', 'Shift', 'shift_id', 'shift_name','',array('column'=>'shift_name','order'=>'asc'));
            
        //Staff Bank 
        $this->data['bank']         = $this->CRUDModel->dropDown('bank', 'SELECT BANK', 'bank_id', 'bank_name','',array('column'=>'bank_name','order'=>'asc'));
        $this->data['branch']       = $this->CRUDModel->dropDown('hr_bank_branch', 'SELECT BRANCH', 'branch_id', 'branch_name','',array('column'=>'branch_name','order'=>'asc'));
        $this->data['commonStatus'] = $this->CRUDModel->dropDown('yesno', '', 'yn_id', 'yn_value','',array('column'=>'yn_id','order'=>'asc'));
        //Staff Allowance    
        $this->data['allowance']    = $this->CRUDModel->dropDown('hr_allowance', 'SELECT ALLOWANCE', 'ha_id', 'ha_name','',array('column'=>'ha_id','order'=>'asc'));
        // Responsibility     
        $this->data['RespStatus']   = $this->CRUDModel->dropDown('common_status', '', 'cs_id', 'cs_title','',array('column'=>'cs_status_order','order'=>'asc'));    
        //Add Letter
        $this->data['scale']            = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'scale_name','',array('column'=>'scale_order','order'=>'asc')); 
        $this->data['contract_status']  = $this->CRUDModel->dropDown('hr_contract_status','Select', 'contract_status_id', 'contract_status_title');
            $this->data['breadcrumbs']  = 'Employee Information';
            $this->data['employee_id']  = $this->uri->segment(2);
            $this->data['page_title']   = 'Employee Information | ECP';
            $this->data['page']         = 'HR/Forms/employee_update_v';
            $this->load->view('common/common',$this->data);             
	}
    public function education_degree_check(){
        $datawhr = array(
            'edu_emp_id'    => $this->input->post('employee_id'),
            'emp_edu_id !=' => $this->input->post('emp_academic_id'),
            'edu_degree_id' => $this->input->post('degree_id'),
        );
        $query = $this->CRUDModel->get_where_result('hr_emp_education',$datawhr);       
        if(empty($query)):
            return true;
        else:
            return false;
        endif;
    }    
                    
    public function all_employee_reocrd(){
        
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
//                    echo '<pre>';print_r( $this->data['result']);die;
            
        endif;
            
            $this->data['page_heading'] = 'All Employees Record';
            $this->data['page_title']   = 'All Employees Record | ECMS';
            $this->data['page']         = 'HR/Forms/all_employee_record_v';
            $this->load->view('common/common',$this->data);  
    }
    public function contract_popup_details(){

        $this->data['contract_info'] = $this->HrModel->get_employee_letter(array('contract_id'=>$this->input->post('contract_id')));
       $this->load->view('HR/Forms/jquery_results/contract_details_popup_v',$this->data);
        
    }
//    public function employee_profile(){
//        $id = $this->uri->segment(2);
//        $this->data['emp_id'] = $id;
//        $where = array('hr_emp_record.emp_id'=>$id);
//        $this->data['result']       = $this->HrModel->profileEmployee($where);
//        $this->data['bank_dtl']         = $this->HrModel->employee_bank_details(array('heb_emp_id'=>$id));
//        $this->data['page_title']   = 'Employees Profile  | ECP';
//        $this->data['page']         = 'HR/Report/employee_profile_v';
//        $this->load->view('common/common',$this->data);
//    }
//    public function update_employee_x(){		
//            $id = $this->uri->segment(3);
//            $this->data['result']       = $this->CRUDModel->get_where_row('hr_emp_record',array('hr_emp_record.emp_id'=>$id));
//            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
//            $this->data['department']   = $this->CRUDModel->dropDown('department', 'Department', 'department_id', 'title','',array('column'=>'title','order'=>'asc'));
//            $this->data['designation']  = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'title','',array('column'=>'title','order'=>'asc'));
//            $this->data['scale']        = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'title','',array('column'=>'hr_scl_order','order'=>'asc'));
//            $this->data['category']     = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'cat_id', 'title');
//            $this->data['status']       = $this->CRUDModel->dropDown('hr_emp_status', 'Status', 'emp_status_id', 'title');
//            $this->data['district']     = $this->CRUDModel->dropDown('district', 'Select', 'district_id', 'name');
//            $this->data['country']      = $this->CRUDModel->dropDown('country', 'Select', 'country_id', 'name');
//            $this->data['network']      = $this->CRUDModel->dropDown('mobile_network', 'Select', 'net_id', 'network',array('net_id !='=>'0'));
//            $this->data['religion']     = $this->CRUDModel->dropDown('religion', 'Select', 'religion_id', 'title');
//            $this->data['m_status']     = $this->CRUDModel->dropDown('marital_status', 'Select', 'marital_status_id', 'title');
//            $this->data['shift']        = $this->CRUDModel->dropDown('shift', 'Shift', 'shift_id', 'name');
////            $this->data['bank']         = $this->CRUDModel->dropDown('bank', 'Selecrt Bank', 'bank_id', 'name');
//            $this->data['contract_tp']  = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Contract Type', 'contract_type_id', 'title',array('hr_category_fk'=> $this->data['result']->cat_id));
//        
//        if($this->input->post()):
//                        
////            $ret_date = '';
////            if(empty($this->CRUDModel->date_convert($this->input->post('retirement_date'),'Y-m-d'))):
//                $dob_Y       = $this->input->post('dob_year');
//                $dob_M       = $this->input->post('dob_month');
//                $dob_D       = $this->input->post('dob_day');
//                $retur_year  = $dob_Y+'60';
//                $ret_date = $retur_year.'-'.$dob_M.'-'.$dob_D;
////            else:
////                $ret_date = $this->CRUDModel->date_convert($this->input->post('retirement_date'),'Y-m-d');
////            endif;
//            
//            $data       = array(
//                'emp_name'          => strtoupper($this->input->post('emp_name')),
//                'father_name'       => strtoupper($this->input->post('father_name')),
//                'emp_husband_name'  => strtoupper($this->input->post('emp_husband_name')),
//                'gender_id'         => $this->input->post('gender_id'),
//                'dob'               => $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
//                'nic'               => $this->input->post('nic'),
//                'postal_address'    => $this->input->post('postal_address'),
//                'permanent_address' => $this->input->post('permanent_address'),
//                'district_id'       => $this->input->post('district_id'),
//                'post_office'       => $this->input->post('post_office'),
//                'country_id'        => $this->input->post('country_id'),
//                'ptcl_number'       => $this->input->post('ptcl_number'),
//                'contact1'          => $this->input->post('contact1'),
//                'net_id'            => $this->input->post('net_id'),
//                'contact2'          => $this->input->post('contact2'),
//                'religion_id'       => $this->input->post('religion_id'),
//                'marital_status_id' => $this->input->post('marital_status_id'),
//                'emp_personal_no'   => $this->input->post('emp_personal_no'),
//                'email'             => $this->input->post('email'),
//                'j_emp_scale_id'    => $this->input->post('j_emp_scale_id'),
//                'retirement_date'   => $ret_date,
//                'cat_id'            => $this->input->post('cat_id'),
//                'c_emp_scale_id'    => $this->input->post('c_emp_scale_id'),
//                'department_id'     => $this->input->post('department_id'),
//                'shift_id'          => $this->input->post('shift_id'),
//                'emp_status_id'     => $this->input->post('emp_status_id'),
//                'comment'           => $this->input->post('comment'),
//                'joining_designation'       => $this->input->post('joining_designation'),
//                'current_designation'       => $this->input->post('current_designation'),
//            );
//              $where = array('emp_id'=>$id);
//              $this->CRUDModel->update('hr_emp_record',$data,$where);
//              redirect('EmployeeRecords'); 
//           endif;
//        if($id):
//            
//            $this->data['employee_records']     = $this->HrModel->hr_edu_record(array('hr_emp_record.emp_id'=>$id));
//            $this->data['page_title']           = 'Update Employee Record | ECMS';
//            $this->data['page']                 = 'HR/Forms/employee_update_v';
//            $this->load->view('common/common',$this->data);
//        endif;
//    } 
//    public function update_emp_edu(){
//       $id      = $this->uri->segment(3);
//       $emp_id = $this->uri->segment(4);
//        if($this->input->post()):
//             
//            $data       = array(
////                'emp_id'        => $this->input->post('emp_id'),
//                'degree_id'     => $this->input->post('degree_id'),
//                'bu_id'         => $this->input->post('bu_id'),
//                'passing_year'  => $this->input->post('passing_year'),
//                'cgpa'          => $this->input->post('cgpa'),
//                'div_id'        => $this->input->post('div_id'),
//                'hec_verified'  => $this->input->post('hec_verified')    
//            );
//            $this->CRUDModel->update('hr_emp_education',$data,array('emp_edu_id'=>$id));
//            redirect('HrController/update_employee/'.$this->uri->segment(4)); 
//           endif;
//        if($id):
//            
//            $this->data['result']       = $this->CRUDModel->get_where_row('hr_emp_education',array('emp_edu_id'=>$id));
//            $this->data['page_title']   = 'Update Employee Qualification | ECP';
//            $this->data['page']         =  'HR/Forms/employee_update_academic_v';
//            $this->load->view('common/common',$this->data);
//        else:
//        redirect('/');
//        endif; 
//    }
//    public function delete_emp_edu(){	    
//        $id         = $this->uri->segment(3);
//        $emp_id     = $this->uri->segment(4);
//        $where      = array('emp_edu_id'=>$id);
//        $this->CRUDModel->deleteid('hr_emp_education',$where);
//        redirect('HrController/update_employee/'.$emp_id);
//	} 
//    public function employee_academic_record(){		
//       
//        $this->data['emp_id'] = $this->uri->segment(3);
//        if($this->input->post()):
//                $data = array(
//                    'emp_id'        => $this->input->post('emp_id'),
//                    'degree_id'     => $this->input->post('degree_id'),
//                    'bu_id'         => $this->input->post('bu_id'),
//                    'cgpa'          => $this->input->post('cgpa'),
//                    'div_id'        => $this->input->post('div_id'),
//                    'hec_verified'  =>$this->input->post('hec_verified'),
//                    'passing_year'  => $this->input->post('passing_year'),
//                );
//            $this->CRUDModel->insert('hr_emp_education',$data);
//            redirect('HrController/employee_academic_record/'.$this->input->post('emp_id'));
//        endif;
//            $this->data['degree']               = $this->CRUDModel->dropDown('degree', ' Select degree', 'degree_id', 'title');
//            $this->data['board_university']     = $this->CRUDModel->dropDown('board_university', 'Select Board', 'bu_id', 'title');
//            $this->data['division']             = $this->CRUDModel->dropDown('hr_emp_division', 'Select Division', 'devision_id', 'name');
//        
//            $where = array('hr_emp_education.emp_id'=>$this->uri->segment(3));
//            $this->data['employee_records'] =$this->HrModel->hr_edu_record($where);
//            $this->data['page_title']   = 'Employee Academic Record | ECP';
//            $this->data['page']         = 'HR/Forms/employee_add_academic_v';
//            $this->load->view('common/common',$this->data); 
//	}
//    public function upload_employee_picture(){
//        $id = $this->uri->segment(2);
//        if($this->input->post()):
//            $image      = $this->CRUDModel->do_resize('file','assets/images/employee');
//            $file_name  = $image['file_name'];
//            $data       = array('picture'=>$file_name);
//            $where      = array('emp_id'=>$id); 
//            $this->CRUDModel->update('hr_emp_record',$data,$where);
//            
//            if($this->input->post('old_image')):
//                unlink('assets/images/employee/'.$this->input->post('old_image'));
//            endif;
//            
//            redirect('EmployeeRecords'); 
//        endif;
//       
//        if($id):
//            
//            $this->data['result']   = $this->HrModel->get_employee_details(array('emp_id'=>$id));
//            $this->data['breadcrumbs']       = 'Upload & Update  Employee Picture';
//            $this->data['page_title']        = 'Update & Upload Employee Picture | ECP';
//            $this->data['page']        =  'HR/Forms/employee_picture_v';
//            $this->load->view('common/common',$this->data);
//        else:
//        redirect('EmployeeRecords');
//        endif;
//    }
//    public function contract_details(){
//        
//        $id = $this->uri->segment(2);
//        
//        $this->data['emp_info']     = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$id));
//        $this->data['category']     = $this->CRUDModel->dropDown('hr_emp_category','','cat_id', 'title',array('cat_id'=>$this->data['emp_info']->cat_id));
//        $this->data['designation']  = $this->CRUDModel->dropDown('hr_emp_designation','Select Designation', 'emp_desg_id', 'title','',array('column'=>'title','order'=>'asc'));
//        $this->data['scale']        = $this->CRUDModel->dropDown('hr_emp_scale','','emp_scale_id', 'title','',array('column'=>'hr_scl_order','order'=>'asc'));
//        $this->data['contract_tp']  = $this->CRUDModel->dropDown('hr_emp_contract_type','', 'contract_type_id', 'title',array('hr_category_fk'=>$this->data['emp_info']->cat_id));
//        $this->data['contract_status']  = $this->CRUDModel->dropDown('hr_contract_status','Select', 'contract_status_id', 'contract_status_title');
//        
//        if($this->input->post()):
//           
//            $letter_no          = strtoupper($this->input->post('c_renwal_letter_no'));
//            $renewal_date       = $this->input->post('letter_day').'-'.$this->input->post('letter_month').'-'.$this->input->post('letter_year');
//            $emp_id             = $this->input->post('emp_id');
//            $contract_from_date = $this->input->post('c_f_day').'-'.$this->input->post('c_f_month').'-'.$this->input->post('c_f_year');
//            $contract_to_date   = $this->input->post('c_t_day').'-'.$this->input->post('c_t_month').'-'.$this->input->post('c_t_year');
//            $designation        = $this->input->post('designation');
//            $scale_id           = $this->input->post('scale_id');
//            $contract_type      = $this->input->post('contract_type_id');
//            $renewal_details    = $this->input->post('renewal_details');
//            $renewal_remarks    = $this->input->post('renewal_remarks');
//            $emp_status_id      = $this->input->post('emp_status_id');
//            $contract_status    = $this->input->post('contract_status');
//            $file_name          = '';
//            if(!empty($_FILES['file']['name'])):
//               $image      = $this->CRUDModel->uploadDirectory('file','assets/images/employee/contract_files');
//                $file_name  = $image['file_name'];
//            endif;
//            
//            $check_rcd = $this->CRUDModel->get_where_row('hr_contract_reneval',array('c_renwal_emp_id'=>$emp_id));
//            
//            if(empty($check_rcd)):
//                $set = array(
//                    'joining_date'          => $this->CRUDModel->date_convert($renewal_date,'Y-m-d'),
//                    'joining_designation'   => $designation, 
//                    'j_emp_scale_id'        => $scale_id, 
//                );
//                $where = array('emp_id'=>$emp_id);
//                $this->CRUDModel->update('hr_emp_record',$set,$where);
//            endif;
//                        
//            $data   = array(
//                'c_renwal_emp_id'               =>  $emp_id,
//                'c_renwal_letter_no'            =>  $letter_no,
//                'c_renwal_from_date'            =>  $this->CRUDModel->date_convert($contract_from_date,'Y-m-d'),
//                'c_renwal_to_date'              =>  $this->CRUDModel->date_convert($contract_to_date,'Y-m-d'),
//                'c_renwal_current_contract_type'=>  $contract_type,
//                'c_renwal_contract_date'        =>  $this->CRUDModel->date_convert($renewal_date,'Y-m-d'),
//                'c_renwal_current_scale'        =>  $scale_id,
//                'c_renewal_designation'         =>  $designation,
//                'c_renwal_current_emp_status'   =>   $emp_status_id,
//                'c_renwal_details'              =>  $renewal_details,
//                'c_renwal_remarks'              =>  $renewal_remarks,
//                'c_renewal_contract_status_id'  =>  $contract_status,
//                'c_renwal_image'                =>  $file_name,
//                'c_renwal_create_by'            =>  $this->UserInfo->user_id,
//                'c_renwal_create_datetime'      =>  date('Y-m-d H:i:s'),
//                
//                    );
//                       
//            $this->CRUDModel->insert('hr_contract_reneval',$data);
//                        
//              $set_c = array(
//                    'current_designation'   => $designation, 
//                    'c_emp_scale_id'        => $scale_id,
//                    'contract_type_id'      => $contract_type,
//                );
//            $this->CRUDModel->update('hr_emp_record',$set_c,array('emp_id'=>$emp_id));
//            redirect('ContractDetails/'.$emp_id);
//        endif;
//       
//        if($id):
//            $this->data['breadcrumbs']       = 'Contract Renewal Details';
//            $this->data['page_title']        = 'Contract Renewal Details | ECP';
//            $this->data['page']              =  'HR/Forms/employee_contract_details_v';
//            $this->load->view('common/common',$this->data);
//        else:
//        redirect('EmployeeRecords');
//        endif;
//    }
//    public function delete_contract_file(){
//        if($this->input->post('request') == 'DeleteFile'):
//           $path    = 'assets/images/employee/contract_files/'.$this->input->post('image_name');
//           unlink($path);
//           $this->CRUDModel->update('hr_contract_reneval',array('c_renwal_image'=>''),array('contract_id'=>$this->input->post('cont_id')));
//        endif;
//    }

//    public function edit_contract(){
//        
//        if($this->input->post('request') == 'fethRcd'):
//            
//                                        $this->db->select('hr_emp_record.cat_id,hr_contract_reneval.*,hr_emp_contract_type.title as c_title,hr_emp_status.title as emp_status,hr_emp_scale.title as current_scale,hr_emp_designation.title as des_title');    
//                                        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_contract_reneval.c_renwal_current_contract_type');    
//                                        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_contract_reneval.c_renwal_current_emp_status');    
//                                        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_contract_reneval.c_renwal_current_scale');    
//                                        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_contract_reneval.c_renewal_designation');
//                                        $this->db->join('hr_emp_record','hr_emp_record.emp_id=hr_contract_reneval.c_renwal_emp_id');
//                                        $this->db->order_by('contract_id','asc');
//          $this->data['contract_info'] = $this->db->get_where('hr_contract_reneval',array('contract_id'=>$this->input->post('contract_id')))->row();
//        
////        $this->data['category']     = $this->CRUDModel->dropDown('hr_emp_category','','cat_id', 'title',array('cat_id'=>$this->data['emp_info']->cat_id));
//        $this->data['designation']  = $this->CRUDModel->dropDown('hr_emp_designation','', 'emp_desg_id', 'title','',array('column'=>'title','order'=>'asc'));
//        $this->data['scale']        = $this->CRUDModel->dropDown('hr_emp_scale','','emp_scale_id', 'title','',array('column'=>'hr_scl_order','order'=>'asc'));
//        $this->data['contract_tp']  = $this->CRUDModel->dropDown('hr_emp_contract_type','', 'contract_type_id', 'title',array('hr_category_fk'=>$this->data['contract_info']->cat_id));
//        $this->data['contract_status']  = $this->CRUDModel->dropDown('hr_contract_status','Select', 'contract_status_id', 'contract_status_title');
//        $this->load->view('HR/Forms/jquery_results/edit_contract_v',$this->data);
//        endif;
//        if($this->input->post('request') == 'update'):
//           
//            $letter_no          = strtoupper($this->input->post('c_renwal_letter_no'));
//            $renewal_date       = $this->input->post('renewal_date');
//            $emp_id             = $this->input->post('emp_id');
//            $contract_from_date = $this->input->post('contract_from_date');
//            $contract_to_date   = $this->input->post('contract_to_date');
//            $designation        = $this->input->post('designation');
//            $scale_id           = $this->input->post('scale_id');
//            $contract_type      = $this->input->post('contract_type_id');
//            $renewal_details    = $this->input->post('renewal_details');
//            $renewal_remarks    = $this->input->post('renewal_remarks');
//            $emp_status_id      = $this->input->post('emp_status_id');
//            $contract_status      = $this->input->post('contract_status');
//            $contract_old_image      = $this->input->post('contract_old_image');
//            
//            
//            $file_name          = '';
//            if(!empty($_FILES['file']['name'])):
//               $image      = $this->CRUDModel->uploadDirectory('file','assets/images/employee/contract_files');
//                $file_name  = $image['file_name'];
//                $path = 'assets/images/employee/contract_files/'.$contract_old_image;
//                @unlink($path);
//                else:
//                    
//                $file_name =$contract_old_image;
//            endif;
//            $data   = array(
//                'c_renwal_emp_id'               =>  $emp_id,
//                'c_renwal_letter_no'            =>  $letter_no,
//                'c_renwal_from_date'            =>  date('Y-m-d',strtotime($contract_from_date)),
//                'c_renwal_to_date'              =>  date('Y-m-d',strtotime($contract_to_date)),
//                'c_renwal_current_contract_type'=>  $contract_type,
//                'c_renwal_contract_date'        =>  date('Y-m-d',strtotime($renewal_date)),
//                'c_renwal_current_scale'        =>  $scale_id,
//                'c_renewal_designation'         =>  $designation,
//                'c_renwal_current_emp_status'   =>   $emp_status_id,
//                'c_renwal_details'              =>  $renewal_details,
//                'c_renwal_remarks'              =>  $renewal_remarks,
//                'c_renwal_image'                =>  $file_name,
//                'c_renewal_contract_status_id'  =>  $contract_status,
//                'c_renwal_create_by'            =>  $this->UserInfo->user_id,
//                'c_renwal_create_datetime'      =>  date('Y-m-d H:i:s'),
//                
//                    );
//            
//            $this->CRUDModel->update('hr_contract_reneval',$data,array('contract_id'=>$this->input->post('cont_id')));
//            redirect('EmployeeRecords','refresh');
//        endif;
//     
//        
//        
//    }
//    public function employee_bank_info(){
//        if($this->input->post('request') == 'getRecord'):
//             $this->data['emp_id']       = $this->input->post('emp_id');
//             $this->data['bank']         = $this->CRUDModel->dropDown('bank', 'Selecrt Bank', 'bank_id', 'bank_name',array('bank_status'=>1),array('order'=>'asc','column'=>'bank_name'));
//             $this->data['status']       = $this->CRUDModel->dropDown('common_status', 'Select Default Account', 'cs_id', 'cs_title',array('cs_status'=>1),array('order'=>'asc','column'=>'cs_title'));
//             $this->load->view('HR/Forms/jquery_results/employee_bank_details_v',$this->data);
//        endif;
//        if($this->input->post('request') == 'EditBankRecord'):
//            $query =   $this->db->get_where('hr_emp_bank',array('heb_id'=>$this->input->post('emp_bank_id')))->row();     
//             echo  json_encode($query);
//        endif;
//        if($this->input->post('request') == 'DataGride'):
//            $this->data['result']         = $this->HrModel->employee_bank_details(array('heb_emp_id'=>$this->input->post('emp_id')));
//            $this->load->view('HR/Forms/jquery_results/employee_bank_result_v',$this->data);
//        endif;
//       
//        if($this->input->post('request') == 'saveRecord'):
//           $emp_id          = $this->input->post('emp_id');
//           $bank            = $this->input->post('bank');
////           $branch_code     = $this->input->post('branch_code');
//           $account_no      = $this->input->post('account_no');
//           $branch          = $this->input->post('branch');
//           $Remarks         = $this->input->post('Remarks');
//           $status          = $this->input->post('status');
//           if($status == '1'):
//               $this->CRUDModel->update('hr_emp_bank',array('heb_status'=>'0'),array('heb_emp_id'=>$emp_id));
//           endif;
//           
//           $data = array(
//             'heb_emp_id'       => $emp_id,  
//             'heb_bank_id'      => $bank,  
////             'heb_branch_code'  => $branch_code,  
//             'heb_account_no'   => $account_no,  
//             'heb_bank_branch'  => $branch,  
//             'heb_remarks'      => $Remarks,  
//             'heb_status'       => $status,  
//             'heb_date'         => date('Y-m-d'),
//             'heb_create_by'    => $this->UserInfo->user_id,  
//             'heb_create_datetime'  => date('Y-m-d H:i:s'),  
//           );
//           $this->CRUDModel->insert('hr_emp_bank',$data);
//        endif;
//        if($this->input->post('request') == 'upateRecord'):
//           
//           $emp_id          = $this->input->post('emp_id');
//           $emp_bank_id     = $this->input->post('emp_bank_id');
//           $bank            = $this->input->post('bank');
//           $account_no      = $this->input->post('account_no');
//           $branch          = $this->input->post('branch');
//           $Remarks         = $this->input->post('Remarks');
//           $status          = $this->input->post('status');
//           
//           if($status == '1'):
//               $this->CRUDModel->update('hr_emp_bank',array('heb_status'=>'0'),array('heb_emp_id'=>$emp_id));
//           endif;
//           
//           $data = array(
//               
//             'heb_bank_id'      => $bank,  
//             'heb_account_no'   => $account_no,  
//             'heb_bank_branch'  => $branch,  
//             'heb_remarks'      => $Remarks,
//             'heb_status'       => $status,  
//             'heb_update_by'    => $this->UserInfo->user_id,  
//             'hed_update_datetime'  => date('Y-m-d H:i:s'),  
//           );
//           $this->CRUDModel->update('hr_emp_bank',$data,array('heb_id'=>$emp_bank_id));
//        endif;
//    }
                        
  
                        
                        
}
 