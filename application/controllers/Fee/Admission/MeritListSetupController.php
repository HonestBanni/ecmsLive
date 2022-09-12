<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class   MeritListSetupController extends AdminController {
	function __construct()
	{
            parent::__construct();
            $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
	}

 
    public function ChangeShift(){
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info','Program ','programe_id','programe_name',array('status'=>'yes'));
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes','Sub Program ','sub_pro_id','sp_title',array('status'=>'yes'));
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        $this->data['shift']        = $this->CRUDModel->dropDown('shift', 'Shift', 'shift_id', 'name');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Batch', 'batch_id', 'batch_name');
        $this->data['status']       = array( '1' =>"Active",'2'=>'De-active');
        
        $this->data['page']         = 'Fee/Admission/Setup/Marks/index';
        $this->data['page_header']  = 'Shift Change Marks Wise';
        $this->data['page_title']   = 'Shift Change Marks Wise | ECMS';
        $this->load->view('common/common',$this->data); 
    }
    public function ChangeShiftGrid(){
       
        if($this->input->post('request') == 'show'):
            $this->db->select('
                    programes_info.programe_name,
                    sub_programes.sp_title,
                    gender.*,
                    shift.*,
                    prospectus_batch.*,
                    merit_list_conditions.*,
                    ');
            $this->db->join('programes_info','programes_info.programe_id=merit_list_conditions.program');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=merit_list_conditions.sub_program');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=merit_list_conditions.batch_id');
            $this->db->join('gender','gender.gender_id=merit_list_conditions.gender');
            $this->db->join('shift','shift.shift_id=merit_list_conditions.shift');
            $this->db->order_by('sub_programes.sp_title','asc');
            $this->db->order_by('gender.title','asc');
            $this->data['grid'] =   $this->db->get_where('merit_list_conditions')->result();
            $this->load->view('Fee/Admission/Setup/Marks/show',$this->data); 
        endif;
        if($this->input->post('request') == 'store'):
            
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';

            
            $this->form_validation->set_rules('program','','required',array('required'=>'1'));
            $this->form_validation->set_rules('sub_program','','required',array('required'=>'2'));
            $this->form_validation->set_rules('batch','','required',array('required'=>'3'));
            $this->form_validation->set_rules('shift','','required',array('required'=>'4'));
            $this->form_validation->set_rules('gender','','required',array('required'=>'5'));
            $this->form_validation->set_rules('start','','required',array('required'=>'6'));
            $this->form_validation->set_rules('end','','required',array('required'=>'7'));
            
                if($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        switch ($fve):
                            case 1: $return_json['e_text'] = 'Program is required.'; break;
                            case 2: $return_json['e_text'] = 'Sub Program is required.'; break;
                            case 3: $return_json['e_text'] = 'Batch is required.'; break;
                            case 4: $return_json['e_text'] = 'Shift is required.'; break;
                            case 5: $return_json['e_text'] = 'Gender is required.'; break;
                            case 6: $return_json['e_text'] = 'Marks From is required.'; break;
                            case 7: $return_json['e_text'] = 'Marks End is required.'; break;
                        endswitch;
                    $return_json['e_status']    = false;
                    $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                    $return_json['e_type']      = 'WARNING';
                endif;
                
                $where_dd = array(
                    'program'           => $this->input->post('program'),  
                    'sub_program'       => $this->input->post('sub_program'),  
                    'batch_id'          => $this->input->post('batch'),  
                    'gender'            => $this->input->post('gender'),  
                    'shift'             => $this->input->post('shift'),   
                );
                $error = '';
                $check_duplicate = $this->db->get_where('merit_list_conditions',$where_dd)->row();
                if(isset($check_duplicate) && !empty($check_duplicate)):
                    $return_json['e_text']   = 'Duplicate record not allowed.';  
                    $error                  = '1';
                endif;
               if($this->input->post('start') > $this->input->post('end')):
                    $return_json['e_text']   = 'End marks not grater then start marks';  
                    $error                  = '1';
                endif;
                
                if($this->form_validation->run() == TRUE && $error == ''):
                    $data = array(
                      'program'         => $this->input->post('program'),  
                      'sub_program'     => $this->input->post('sub_program'),  
                      'batch_id'        => $this->input->post('batch'),  
                      'gender'          => $this->input->post('gender'),  
                      'shift'           => $this->input->post('shift'),  
                      'start'           => $this->input->post('start'),  
                      'end'             => $this->input->post('end'),  
                      'status'          => $this->input->post('status'),  
                      'remarks'         => $this->input->post('Remarks'),  
                      'create_by'       => $this->userInfo->user_id,  
                      'create_datetime' => date('Y-m-d H:i:s'),  
                    );
                $search_where = array(
                    'programe_id'                       => $this->input->post('program'),  
                    'student_record.sub_pro_id'         => $this->input->post('sub_program'),  
                    'student_record.batch_id'           => $this->input->post('batch'),  
                    'gender_id'                         => $this->input->post('gender'),  
//                    'shift_id'                          => $this->input->post('shift'), 
                    's_status_id'                       => 1, 
                );
                $this->CRUDModel->insert('merit_list_conditions',$data);
                                $this->db->where('obtained_marks BETWEEN '.$this->input->post('start').' AND '.$this->input->post('end')); 
                                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $student_list = $this->db->get_where('student_record',$search_where)->result();
                if(isset($student_list) && !empty($student_list)):
                    foreach($student_list as $row):
                        $this->CRUDModel->update('student_record',array('shift_id'=>$this->input->post('shift')),array('student_id'=>$row->student_id));
                    endforeach;
                endif;
                $return_json['d_msg']        = 'Record save Successfully'; 
                   $return_json['e_status']     = true; 
                endif;
            echo json_encode($return_json);  
        endif;
        if($this->input->post('request') == 'edit'):
          echo  json_encode($this->db->get_where('merit_list_conditions',array('id'=>$this->input->post('edit_id')))->row());
        endif;
          if($this->input->post('request') == 'update'):
            
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';

            
            $this->form_validation->set_rules('program','','required',array('required'=>'1'));
            $this->form_validation->set_rules('sub_program','','required',array('required'=>'2'));
            $this->form_validation->set_rules('batch','','required',array('required'=>'3'));
            $this->form_validation->set_rules('shift','','required',array('required'=>'4'));
            $this->form_validation->set_rules('gender','','required',array('required'=>'5'));
            $this->form_validation->set_rules('start','','required',array('required'=>'6'));
            $this->form_validation->set_rules('end','','required',array('required'=>'7'));
            
                if($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('', '');
                    $fve =  validation_errors();
                        switch ($fve):
                            case 1: $return_json['e_text'] = 'Program is required.'; break;
                            case 2: $return_json['e_text'] = 'Sub Program is required.'; break;
                            case 3: $return_json['e_text'] = 'Batch is required.'; break;
                            case 4: $return_json['e_text'] = 'Shift is required.'; break;
                            case 5: $return_json['e_text'] = 'Gender is required.'; break;
                            case 6: $return_json['e_text'] = 'Marks From is required.'; break;
                            case 7: $return_json['e_text'] = 'Marks End is required.'; break;
                        endswitch;
                    $return_json['e_status']    = false;
                    $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                    $return_json['e_type']      = 'WARNING';
                endif;
                
                $where_dd = array(
                    'program'           => $this->input->post('program'),  
                    'sub_program'       => $this->input->post('sub_program'),  
                    'batch_id'          => $this->input->post('batch'),  
                    'gender'            => $this->input->post('gender'),  
                    'shift'             => $this->input->post('shift'),   
                    'id !='             => $this->input->post('pk_id'),   
                );
                $error = '';
                $check_duplicate = $this->db->get_where('merit_list_conditions',$where_dd)->row();
                if(isset($check_duplicate) && !empty($check_duplicate)):
                    $return_json['e_text']   = 'Duplicate record not allowed.';  
                    $error                  = '1';
                endif;
               if($this->input->post('start') > $this->input->post('end')):
                    $return_json['e_text']   = 'End marks not grater then start marks';  
                    $error                  = '1';
                endif;
                
                if($this->form_validation->run() == TRUE && $error == ''):
                    $data = array(
                      'program'         => $this->input->post('program'),  
                      'sub_program'     => $this->input->post('sub_program'),  
                      'batch_id'        => $this->input->post('batch'),  
                      'gender'          => $this->input->post('gender'),  
                      'shift'           => $this->input->post('shift'),  
                      'start'           => $this->input->post('start'),  
                      'end'             => $this->input->post('end'),  
                      'status'          => $this->input->post('status'),  
                      'remarks'         => $this->input->post('Remarks'),  
                      'update_by'       => $this->userInfo->user_id,  
                      'update_datetime' => date('Y-m-d H:i:s'),  
                    );
                $search_where = array(
                    'programe_id'                       => $this->input->post('program'),  
                    'student_record.sub_pro_id'         => $this->input->post('sub_program'),  
                    'student_record.batch_id'           => $this->input->post('batch'),  
                    'gender_id'                         => $this->input->post('gender'),  
//                    'shift_id'                          => $this->input->post('shift'), 
                    's_status_id'                       => 1, 
                );
                
                
                $this->CRUDModel->update('merit_list_conditions',$data,array('id'=>$this->input->post('pk_id')));
                                $this->db->where('obtained_marks BETWEEN '.$this->input->post('start').' AND '.$this->input->post('end')); 
                                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $student_list = $this->db->get_where('student_record',$search_where)->result();
                if(isset($student_list) && !empty($student_list)):
                    foreach($student_list as $row):
                        $this->CRUDModel->update('student_record',array('shift_id'=>$this->input->post('shift')),array('student_id'=>$row->student_id));
                    endforeach;
                endif;
                $return_json['d_msg']        = 'Record update Successfully'; 
                   $return_json['e_status']     = true; 
                endif;
            echo json_encode($return_json);  
        endif;
    }
    
    
}

 