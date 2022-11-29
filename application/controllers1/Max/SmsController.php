<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
class SmsController extends AdminController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/roufee_new_headtes.php, it's displayed at http://example.com/
	 *
	 * So any fee_extra_headsother public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
      
    public $userInfo = '';         
    public function __construct() {
             parent::__construct();
             $this->load->model('FeeModel');
             $this->load->model('HrModel');
             $this->load->model('SmsModel');
             $this->load->model('ReportsModel');
             $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
             
          }
          
          
          
        public function guardian_message(){
//        public function general_message(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        $this->data['shift']        = $this->CRUDModel->dropDown('shift', ' Select Shift', 'shift_id', 'name');
        $this->data['hostel_status']= $this->CRUDModel->dropDown('hostel_status', ' Hostel Status', 'hostel_status_id', 'status_name');
        
        $this->data['college_no']  = '';
        $this->data['message']      = '';
        $this->data['gender_id']    = '';
        $this->data['status_id']        = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        $this->data['smsPassword']  = '';
         $this->data['pictureId']   = '';
         $this->data['shift_id']    = '';
         $this->data['hostel_id']   = '';
                                        $this->db->order_by('obtained_marks','desc');
                                        $this->db->limit('1','0');
         $max_numbers               =   $this->db->get_where('applicant_edu_detail')->row();
         $this->data['std_no_from'] =   '';
         $this->data['std_no_to']   =   $max_numbers->obtained_marks;
        
        if($this->input->post('search')):
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message        = $this->input->post("message");
            $student_status = $this->input->post("student_status");
            $smsPassword    = $this->input->post("smsPassword");
            $picture        = $this->input->post("picture");
            $shift          = $this->input->post("shift");
            $hostel_status  = $this->input->post("hostel_status");
            $std_no_from    = $this->input->post("std_no_from");
            $std_no_to      = $this->input->post("std_no_to");
            
            $where      = '';
            $like       = '';
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_id'] = $hostel_status;
            endif;
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($shift):
                $where['student_record.shift_id']   = $shift;
                $this->data['shift_id']             = $shift;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['college_no']          = $collegeNo;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;
            if(!empty($message)):
            
                $this->data['message']     = $message;
            endif;
            if(!empty($smsPassword)):
                $this->data['smsPassword']     = $smsPassword;
            endif;
            if($picture == 0):
                     $where['student_record.applicant_image ='] = '';
                     $this->data['pictureId']  = $picture;
                endif;
                if($picture == 1):
                     $where['student_record.applicant_image !='] = '';
                     $this->data['pictureId']  = $picture;    
                endif;
                if($picture == 2):
                    $this->data['pictureId']  = $picture;    
                endif;
            
            
            $std_no['std_no_from']  =$std_no_from;
            $std_no['std_no_to']    =$std_no_to;
            
            $this->data['std_no_from'] = $std_no_from;
            $this->data['std_no_to']   = $std_no_to;
            $this->data['result'] = $this->SmsModel->student_fee_sms($where,$like,$std_no);
//            $this->data['count'] = $this->SmsModel->student_fee_sms($where,$like);
         
        endif;
         if($this->input->post('sendSMS')):
             
             
              
        $chunk_arrray = array_chunk($this->input->post("checked"), 100);
          
            foreach($chunk_arrray as $chunkRow):
                
                $message        = $this->input->post("message");
                $formCode       = $this->input->post("formCode");
                $sn = '';
                $sender_number  = '';
                $sender_number_check  = '';
                foreach($chunkRow as $key=>$student_id):
                    
                    
               
                    $student_info   = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));
                
//               $check_date = $this->db->get_where('sms_students',array('student_id'=>$student_id,'send_date'=>date('Y-m-d')))->row();
//               if(empty($check_date)):
//                   
//               endif;
                     $section = '';
                    if($student_info):
                        $sn++; 
                       if($student_info->section_id):
                            $section = $student_info->section_id;
                            else:
                            $section = 0;
                        endif;
                        
                        if($student_info->net_id == 0):
                            $sender_number_check .= $student_info->mobile_no.',';
                        else:
                            $sender_number_check .= $student_info->mobile_no.$student_info->mobile_network.',';
                        endif;
                    
                        
                    $data = array(
                        'student_id'        => $student_info->student_id,
                        'program_id'        => $student_info->programe_id,
                        'formCode'          => $formCode,
                        'sub_pro_id'        => $student_info->sub_pro_id,
                        'sec_id'            => $section,
                        'batch_id'          => $student_info->batch_id,
                        'sms_type'          => 1,
                        'message'           => $message,
                        'sender_number'     => $this->CRUDModel->clean_number($student_info->mobile_no),
                        'create_datetime'   => date('Y-m-d H:i:s'),
                        'send_date'         => date('Y-m-d'),  
                        'create_by'         => $this->userInfo->user_id, 
                      );
                       
              $this->CRUDModel->insert('sms_students',$data);
                     
             endif;
            endforeach;
           
           $chec_last = substr($sender_number_check,'-1');
           
           if($chec_last == ','):
            $sender_number =    substr($sender_number_check,0,'-1');
               else:
             $sender_number =   $sender_number;
           endif;
             
            $return_message = '';
          
            if($sn >1): 
               
                $return         =   $this->send_message_bulk($sender_number,$message);
               
            
                $decode_res     = json_decode($return,true);
              if(!empty($decode_res['numbers'])):
                   foreach($decode_res['numbers'] as $row):
                       
                    $status     = '';
                    if($row['status']):
                        $status = $row['status'];
                        else:
                        $return_message[] =  'Mobile#'.$sender_number.'  ERROR#'.$status;
                        $status = '';
                    endif;
                       
                $update_data = array(
                    'delevery_status'=>1,
                    'message_status'=>$status,
                );
                
                $where_up = array(
                  'sender_number'=>$row['number'],
                  'send_date'=>date('Y-m-d'),
                );
                
                $this->CRUDModel->update('sms_students',$update_data,$where_up);
                endforeach;
              endif;
 
                else:
                   
                    $chec_last = substr($sender_number_check,'-1');
           
                    if($chec_last == ','):
                     $sender_number =    substr($sender_number_check,0,'-1');
                        else:
                      $sender_number =   $sender_number;
                    endif;
                    
                    
                    
                    $number_sendxtz = explode(',', $sender_number);
                    $return         = $this->send_message($number_sendxtz[0],$message); 
                    $result         = json_decode($return,true);

                    $status     = '';
                    if(@$result['numbers'][0]['status']):
                        $status = $result['numbers'][0]['status'];
                        else:
                            $return_message[] =  'Mobile#'.$sender_number.'  ERROR# '.$status;
                        $status = '';
                    endif;
                  $update_data = array(
                    'delevery_status'=>1,
                    'message_status'=>$status,
                );
                $where_up = array(
                  'sender_number'=>$this->CRUDModel->clean_number($sender_number),
                    'send_date'=>date('Y-m-d'),
                );   
                    
                $this->CRUDModel->update('sms_students',$update_data,$where_up);     
                
                
            endif;
           endforeach;
     
           if(empty($return_message)):
                     
              $this->session->set_flashdata('success_return', 'Messages send successfully.....'); 
           else:
               $this->session->set_flashdata('error_return', $return_message);
           endif;
           redirect('admin/admin_home');
         endif;
         
        $this->data['page']         = 'sms/guardian_message';
        $this->data['page_header']  = 'Student Guardian Message';
        $this->data['page_title']   = 'Student Guardian Message | ECMS';
        $this->load->view('common/common',$this->data); 
    }   
        public function student_general_Message(){
 
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        $this->data['shift']        = $this->CRUDModel->dropDown('shift', ' Select Shift', 'shift_id', 'name');
        $this->data['hostel_status']= $this->CRUDModel->dropDown('hostel_status', ' Hostel Status', 'hostel_status_id', 'status_name');
        
        $this->data['college_no']  = '';
        $this->data['message']      = '';
        $this->data['gender_id']    = '';
        $this->data['status_id']        = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        $this->data['smsPassword']  = '';
        $this->data['pictureId']   = '';
        $this->data['shift_id']    = '';
        $this->data['hostel_id']   = '';
        
                        $this->db->order_by('obtained_marks','desc');
                        $this->db->limit('1','0');
         $max_numbers = $this->db->get_where('applicant_edu_detail')->row();
         $this->data['std_no_from'] = '';
         $this->data['std_no_to']   = $max_numbers->obtained_marks;
        
        if($this->input->post('search')):
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message        = $this->input->post("message");
            $student_status = $this->input->post("student_status");
            $smsPassword    = $this->input->post("smsPassword");
            $picture        = $this->input->post("picture");
            $shift          = $this->input->post("shift");
            $hostel_status  = $this->input->post("hostel_status");
            
            $std_no_from    = $this->input->post("std_no_from");
            $std_no_to      = $this->input->post("std_no_to");
            
            $where      = '';
            $like       = '';
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_id'] = $hostel_status;
            endif;
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($shift):
                $where['student_record.shift_id']   = $shift;
                $this->data['shift_id']             = $shift;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['college_no']          = $collegeNo;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;
            if(!empty($message)):
            
                $this->data['message']      = $message;
            endif;
            if(!empty($smsPassword)):
                $this->data['smsPassword']  = $smsPassword;
            endif;
            if($picture == 0):
                     $where['student_record.applicant_image ='] = '';
                     $this->data['pictureId']  = $picture;
                endif;
                if($picture == 1):
                     $where['student_record.applicant_image !='] = '';
                     $this->data['pictureId']  = $picture;    
                endif;
                if($picture == 2):
                    $this->data['pictureId']  = $picture;    
                endif;
            
            
            $std_no['std_no_from']  =$std_no_from;
            $std_no['std_no_to']    =$std_no_to;
            
            $this->data['std_no_from'] = $std_no_from;
            $this->data['std_no_to']   = $std_no_to;
            
            
            $this->data['result'] = $this->SmsModel->student_fee_sms($where,$like,$std_no);
        endif;
         if($this->input->post('sendSMS')):
              
        $chunk_arrray = array_chunk($this->input->post("checked"), 100);
          
            foreach($chunk_arrray as $chunkRow):
                
                $message        = $this->input->post("message");
                $formCode       = $this->input->post("formCode");
                $sn = '';
                $sender_number  = '';
                $sender_number_check  = '';
                foreach($chunkRow as $key=>$student_id):
               
                    $student_info   = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));
               
                     $section = '';
                    if($student_info):
                        $sn++; 
                       if($student_info->section_id):
                            $section = $student_info->section_id;
                            else:
                            $section = 0;
                        endif;
                        
                        if(!empty($student_info->applicant_mob_no1)):
                           $sender_number_check .= $student_info->applicant_mob_no1.','; 
                       
                         
//                        if($student_info->net_id == 0):
//                            $sender_number_check .= $student_info->applicant_mob_no1.',';
////                        else:
////                            $sender_number_check .= $student_info->applicant_mob_no1.$student_info->mobile_network.',';
//                        endif;
                    
                        
                    $data = array(
                        'student_id'        => $student_info->student_id,
                        'program_id'        => $student_info->programe_id,
                        'formCode'          => $formCode,
                        'sub_pro_id'        => $student_info->sub_pro_id,
                        'sec_id'            => $section,
                        'batch_id'          => $student_info->batch_id,
                        'sms_type'          => 1,
                        'message'           => $message,
                        'sender_number'     => $this->CRUDModel->clean_number($student_info->applicant_mob_no1),
                        'create_datetime'   => date('Y-m-d H:i:s'),
                        'send_date'         => date('Y-m-d'),  
                        'create_by'         => $this->userInfo->user_id, 
                      );
                       
              $this->CRUDModel->insert('sms_students',$data);
                endif;     
             endif;
            endforeach;
           
           $chec_last = substr($sender_number_check,'-1');
           
           if($chec_last == ','):
            $sender_number =    substr($sender_number_check,0,'-1');
               else:
             $sender_number =   $sender_number;
           endif;
             
            $return_message = '';
          
            if($sn >1): 
               
                $return         =   $this->send_message_bulk($sender_number,$message);
                $decode_res     = json_decode($return,true);
              if(!empty($decode_res['numbers'])):
                   foreach($decode_res['numbers'] as $row):
                       
                    $status     = '';
                    if($row['status']):
                        $status = $row['status'];
                        else:
                        $return_message[] =  'Mobile#'.$sender_number.'  ERROR#'.$status;
                        $status = '';
                    endif;
                       
                $update_data = array(
                    'delevery_status'=>1,
                    'message_status'=>$status,
                );
                
                $where_up = array(
                  'sender_number'=>$row['number'],
                  'send_date'=>date('Y-m-d'),
                );
                
                $this->CRUDModel->update('sms_students',$update_data,$where_up);
                endforeach;
              endif;
 
                else:
                   
                    $chec_last = substr($sender_number_check,'-1');
           
                    if($chec_last == ','):
                     $sender_number =    substr($sender_number_check,0,'-1');
                        else:
                      $sender_number =   $sender_number;
                    endif;
                    
                    
                    
                    $number_sendxtz = explode(',', $sender_number);
                    $return         = $this->send_message($number_sendxtz[0],$message); 
                    $result         = json_decode($return,true);

                    $status     = '';
                    if(@$result['numbers'][0]['status']):
                        $status = $result['numbers'][0]['status'];
                        else:
                            $return_message[] =  'Mobile#'.$sender_number.'  ERROR# '.$status;
                        $status = '';
                    endif;
                  $update_data = array(
                    'delevery_status'=>1,
                    'message_status'=>$status,
                );
                $where_up = array(
                  'sender_number'=>$this->CRUDModel->clean_number($sender_number),
                    'send_date'=>date('Y-m-d'),
                );   
                    
                $this->CRUDModel->update('sms_students',$update_data,$where_up);     
                
                
            endif;
           endforeach;
     
           if(empty($return_message)):
                     
              $this->session->set_flashdata('success_return', 'Messages send successfully.....'); 
           else:
               $this->session->set_flashdata('error_return', $return_message);
           endif;
           redirect('admin/admin_home');
         endif;
         
        $this->data['page']         = 'sms/student_message';
        $this->data['page_header']  = 'Student Message';
        $this->data['page_title']   = 'Student Message | ECMS';
        $this->load->view('common/common',$this->data); 
    }   
        public function applicant_message(){
        
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
            $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
            $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
            $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');

            $this->data['college_no']  = '';
            $this->data['message']      = '';
            $this->data['gender_id']    = '';
            $this->data['status_id']        = '';
            $this->data['fatherName']   = '';
            $this->data['stdName']      = '';
            $this->data['programe_id']  = '';
            $this->data['sec_id']       = '';
            $this->data['sub_pro_id']   = '';
            $this->data['batch_id']     = '';
            $this->data['form_no']      = '';
            $this->data['challan_no']   = '';
            $this->data['from']         = '';
            $this->data['to']           = '';
            $this->data['smsPassword']  = '';

            if($this->input->post('search')):

                $collegeNo      = $this->input->post("collegeNo");
                $batch          = $this->input->post("batch");
                $form_no        = $this->input->post("form_no");
                $stdName        = $this->input->post("stdName");
                $fatherName     = $this->input->post("fatherName");
                $programe_id    = $this->input->post("programe_id");
                $sub_pro_id     = $this->input->post("sub_pro_id");
                $section        = $this->input->post("section");
                $gender         = $this->input->post("gender");
                $message        = $this->input->post("message");
                $student_status = $this->input->post("student_status");
                $smsPassword    = $this->input->post("smsPassword");
                $std_no_from    = $this->input->post("std_no_from");
                $std_no_to      = $this->input->post("std_no_to");
                $where          = '';
                $like           = '';
                if(!empty($smsPassword)):
                    $this->data['smsPassword']     = $smsPassword;
                endif;
                if($gender):
                    $where['student_record.gender_id'] = $gender;
                    $this->data['gender_id'] = $gender;
                endif;
                if($collegeNo):
                    $where['student_record.college_no'] = $collegeNo;
                    $this->data['college_no']          = $collegeNo;
                endif;
                if($form_no):
                    $where['student_record.form_no'] = $form_no;
                    $this->data['form_no'] = $form_no;
                endif;
                if(!empty($stdName)):
                    $like['student_record.student_name'] = $stdName;
                    $this->data['stdName']           = $stdName;
                endif;
                if(!empty($fatherName)):
                    $like['student_record.father_name'] = $fatherName;
                    $this->data['fatherName']           = $fatherName;
                endif;
                if($programe_id):
                    $where['programes_info.programe_id'] = $programe_id;
                    $this->data['programe_id'] = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                     $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                    $this->data['sub_pro_id']           = $sub_pro_id;
                endif;
                if(!empty($batch)):
                     $where['student_record.batch_id'] = $batch;
                    $this->data['batch_id']           = $batch;
                endif;
                if(!empty($section)):
                    $where['sections.sec_id'] = $section;
                    $this->data['sec_id']     = $section;
                endif;
                if(!empty($student_status)):
                    $where['student_record.s_status_id'] = $student_status;
                    $this->data['status_id']     = $student_status;
                endif;
                $std_no['std_no_from']  =$std_no_from;
                    $std_no['std_no_to']    =$std_no_to;

                    $this->data['std_no_from'] = $std_no_from;
                    $this->data['std_no_to']   = $std_no_to;
                if(!empty($message)):

                    $this->data['message']     = $message;
                endif;
                $this->data['result'] = $this->SmsModel->student_fee_sms($where,$like,$std_no);
    //            $this->data['count'] = $this->SmsModel->student_fee_sms($where,$like);

            endif;
             if($this->input->post('sendSMS')):

            $chunk_arrray = array_chunk($this->input->post("checked"), 100);

                foreach($chunk_arrray as $chunkRow):

                    $message        = $this->input->post("message");
                    $formCode       = $this->input->post("formCode");
                    $sn = '';
                    $sender_number  = '';
                    foreach($chunkRow as $key=>$student_id):

                        $student_info   = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));

                        $section = '';
                        if($student_info):
                            $sn++; 
                           if($student_info->section_id):
                                $section = $student_info->section_id;
                                else:
                                $section = 0;
                            endif;
                            if(!empty($student_info->applicant_mob_no1)):


                                 if(empty($sender_number)):
                                     $sender_number .= $student_info->applicant_mob_no1;
                                     else:
                                     $sender_number .= $student_info->applicant_mob_no1.',';
                                 endif;

                                    $data = array(
                                        'student_id'        => $student_info->student_id,
                                        'program_id'        => $student_info->programe_id,
                                        'formCode'          => $formCode,
                                        'sub_pro_id'        => $student_info->sub_pro_id,
                                        'sec_id'            => $section,
                                        'batch_id'          => $student_info->batch_id,
                                        'sms_type'          => 3,
                                        'message'           => $message,
                                        'sender_number'     => $this->CRUDModel->clean_number($student_info->applicant_mob_no1),
                                        'create_datetime'   => date('Y-m-d H:i:s'),
                                        'send_date'         => date('Y-m-d'),  
                                        'create_by'         => $this->userInfo->user_id, 
                                      );
                            $this->CRUDModel->insert('sms_students',$data);
                  endif;
                 endif;
                endforeach;

                $return_message = '';
                if(!empty($sender_number)):


                if($sn >1): 

                    $return         =   $this->send_message_bulk($sender_number,$message);
                    $decode_res     = json_decode($return,true);


                  if(!empty($decode_res['numbers'])):
                       foreach($decode_res['numbers'] as $row):

                        $status     = '';
                        if($row['status']):
                            $status = $row['status'];
                            else:
                            $return_message[] =  'Mobile#'.$sender_number.'  ERROR#'.$status;
                            $status = '';
                        endif;

                    $update_data = array(
                        'delevery_status'=>1,
                        'message_status'=>$status,
                    );

                    $where_up = array(
                      'sender_number'=>$row['number']
                    );

                    $this->CRUDModel->update('sms_students',$update_data,$where_up);
                    endforeach;
                  endif;

                    else:



                       $return =   $this->send_message($sender_number,$message); 

                    $result = json_decode($return,true);

                        $status     = '';
                        if(@$result['status']):
                            $status = $result['status'];
                            else:
                                $return_message[] =  'Mobile#'.$sender_number.'  ERROR# '.$status;
                            $status = '';
                        endif;
                      $update_data = array(
                        'delevery_status'=>1,
                        'message_status'=>$status,
                    );
                    $where_up = array(
                      'sender_number'=>$this->CRUDModel->clean_number($sender_number)
                    );   

                    $this->CRUDModel->update('sms_students',$update_data,$where_up);     
                endif;
                else:
                    $return_message[] =  'Mobile number not found......';
                    endif;
               endforeach;

               if(empty($return_message)):

                  $this->session->set_flashdata('success_return', 'Messages send successfully.....'); 
               else:
                   $this->session->set_flashdata('error_return', $return_message);
               endif;
               redirect('admin/admin_home'); 
            endif;
            $this->data['page']         = 'sms/applicant_message';
            $this->data['page_header']  = 'Applicant Message ';
            $this->data['page_title']   = 'Applicant Message | ECMS';
            $this->load->view('common/common',$this->data); 
        }  
        public function attendance_message(){

        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        
        $this->data['college_no']  = '';
        $this->data['message']      = '';
        $this->data['gender_id']    = '';
        $this->data['status_id']        = '5';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        $this->data['smsPassword']  = '';
        
        if($this->input->post('search')):
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message        = $this->input->post("message");
            $student_status = $this->input->post("student_status");
            $smsPassword    = $this->input->post("smsPassword");
            
            if(!empty($smsPassword)):
                $this->data['smsPassword']     = $smsPassword;
            endif;
            
            $where['message_flag']      = '1';
            $like       = '';
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['college_no']           = $collegeNo;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;
            
            if(!empty($message)):
            
                $this->data['message']     = $message;
            endif;
            $this->data['result'] = $this->SmsModel->student_fee_sms_general($where,$like);
//            $this->data['count'] = $this->SmsModel->student_fee_sms($where,$like);

        endif;
          if($this->input->post('sendSMS')):
                $checked = $this->input->post("checked");
                foreach($checked as $key=>$student_id):
                   
                            $student_info       = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));
                        if($student_info):
                             $message           = $this->CRUDModel->attendance_details($student_info->student_id,$student_info->section_id,$student_info->student_name);
                                
//                            echo '<pre>';print_r($student_info);die;
                        if($message !='null'):
                            $formCode       = $this->input->post("formCode");
                            $Check_where    = array(
                                'student_id'    => $student_info->student_id,
                                'formCode'      => $formCode,
                                );
                            $check_double_msg = $this->CRUDModel->get_where_row('sms_students',$Check_where);
                            
                            if(empty($check_double_msg)):
                                if($student_info->net_id == 0):
//                                     $result = array('status'=>$student_info->student_id);
                                    $return     = $this->send_message($student_info->mobile_no,$message);
                                else:
//                                    $result = array('status'=>$student_info->student_id);
                                        $return     = $this->send_message($student_info->mobile_no,$message,$student_info->mobile_network);
                                endif;
//                                   echo '<pre>';print_r($return);die;
                               $result     = json_decode($return,true);
                                $status     = '';
                                if($result['status']):
                                    $status = $result['status'];
                                    else:
                                    $status = '';
                                endif;
                                $return_resp = '';
                                if(@$return):
                                    $return_resp = $return;
                                    else:
                                    $return_resp = 'null';
                                    endif;
                                   $section = ''; 
                                if($student_info->section_id):
                                    $section = $student_info->section_id;
                                    else:
                                    $section = 0;
                                endif;
                                $send_message = '';
                                if(empty($message)):
                                    $send_message = ''; 
                                    else:
                                     $send_message = $message;
                                endif;
                   
                                
                       
                                $data = array(
                                'student_id'        => $student_info->student_id,
                                'program_id'        => $student_info->programe_id,
                                'formCode'          => $formCode,
                                'sub_pro_id'        => $student_info->sub_pro_id,
                                'sec_id'            => $section,
                                'batch_id'          => $student_info->batch_id,
                                'sms_type'          => 2,
                                'message'           => $send_message,
                                'message_status'    => $status,
                                'comments'          => $return_resp,
                                'network'           => $student_info->mobile_network,
                                'sender_number'     => $this->CRUDModel->clean_number($student_info->mobile_no),
                                'create_datetime'   => date('Y-m-d H:i:s'),
                                    'send_date'     => date('Y-m-d'),  
                                'create_by'         => $this->userInfo->user_id, 
                              );
                             $this->CRUDModel->insert('sms_students',$data);
                            endif;
                        endif;
                      endif;
            endforeach;
            redirect('admin/admin_home');
        endif;
        $this->data['page']         = 'sms/attendance_student_message';
        $this->data['page_header']  = 'College SMS Attendance ';
        $this->data['page_title']   = 'College SMS Attendance | ECMS';
        $this->load->view('common/common',$this->data); 
    }
        public function hostel_message(){
                
                $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
                $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
                $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
                $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
                $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
                $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
                $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
                $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');

                $this->data['college_no']  = '';
                $this->data['message']      = '';
                $this->data['gender_id']    = '';
                $this->data['status_id']        = '';
                $this->data['fatherName']   = '';
                $this->data['stdName']      = '';
                $this->data['programe_id']  = '';
                $this->data['sec_id']       = '';
                $this->data['sub_pro_id']   = '';
                $this->data['batch_id']     = '';
                $this->data['form_no']      = '';
                $this->data['challan_no']   = '';
                $this->data['from']         = '';
                $this->data['to']           = '';
                $this->data['smsPassword']  = '';

                if($this->input->post('search')):

                    $collegeNo      = $this->input->post("collegeNo");
                    $batch          = $this->input->post("batch");
                    $form_no        = $this->input->post("form_no");
                    $stdName        = $this->input->post("stdName");
                    $fatherName     = $this->input->post("fatherName");
                    $programe_id    = $this->input->post("programe_id");
                    $sub_pro_id     = $this->input->post("sub_pro_id");
                    $section        = $this->input->post("section");
                    $gender         = $this->input->post("gender");
                    $message        = $this->input->post("message");
                    $student_status = $this->input->post("student_status");
                    $student_status = $this->input->post("hostel_student_status");
                    $smsPassword    = $this->input->post("smsPassword");

                    $where      = '';
                    $like       = '';
                    if(!empty($smsPassword)):
                        $this->data['smsPassword']     = $smsPassword;
                    endif;
                    if($gender):
                        $where['student_record.gender_id'] = $gender;
                        $this->data['gender_id'] = $gender;
                    endif;
                    if($collegeNo):
                        $where['student_record.college_no'] = $collegeNo;
                        $this->data['college_no']          = $collegeNo;
                    endif;
                    if($form_no):
                        $where['student_record.form_no'] = $form_no;
                        $this->data['form_no'] = $form_no;
                    endif;
                    if(!empty($stdName)):
                        $like['student_record.student_name'] = $stdName;
                        $this->data['stdName']           = $stdName;
                    endif;
                    if(!empty($fatherName)):
                        $like['student_record.father_name'] = $fatherName;
                        $this->data['fatherName']           = $fatherName;
                    endif;
                    if($programe_id):
                        $where['programes_info.programe_id'] = $programe_id;
                        $this->data['programe_id'] = $programe_id;
                    endif;
                    if(!empty($sub_pro_id)):
                         $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                        $this->data['sub_pro_id']           = $sub_pro_id;
                    endif;
                    if(!empty($batch)):
                         $where['student_record.batch_id'] = $batch;
                        $this->data['batch_id']           = $batch;
                    endif;
                    if(!empty($section)):
                        $where['sections.sec_id'] = $section;
                        $this->data['sec_id']     = $section;
                    endif;
                    if(!empty($student_status)):
                        $where['student_record.s_status_id'] = $student_status;
                        $this->data['hostel_status_id']     = $student_status;
                    endif;

                    if(!empty($message)):

                        $this->data['message']     = $message;
                    endif;
                    $this->data['result'] = $this->SmsModel->hostel_student_sms($where,$like);
        //            echo '<pre>';print_r($this->data['result']);die;
        //            $this->data['count'] = $this->SmsModel->student_fee_sms($where,$like);

                endif;
                 if($this->input->post('sendSMS')):

                $chunk_arrray = array_chunk($this->input->post("checked"), 100);

                    foreach($chunk_arrray as $chunkRow):

                        $message        = $this->input->post("message");
                        $formCode       = $this->input->post("formCode");
                        $sn = '';
                        $sender_number  = '';
                        foreach($chunkRow as $key=>$student_id):

                            $student_info   = $this->SmsModel->hostel_students_details(array('student_record.student_id'=>$student_id));
        //                      echo '<pre>';print_R($student_info);die;
                            $section = '';
                            if($student_info):
                                $sn++; 
                               if($student_info->section_id):
                                    $section = $student_info->section_id;
                                    else:
                                    $section = 0;
                                endif;
                                if(!empty($student_info->student_mobile_no)):


                                     if(empty($sender_number)):
                                         $sender_number .= $student_info->student_mobile_no;
                                         else:
                                         $sender_number .= $student_info->student_mobile_no.',';
                                     endif;

                                        $data = array(
                                            'student_id'        => $student_info->student_id,
                                            'program_id'        => $student_info->programe_id,
                                            'formCode'          => $formCode,
                                            'sub_pro_id'        => $student_info->sub_pro_id,
                                            'sec_id'            => $section,
                                            'batch_id'          => $student_info->batch_id,
                                            'sms_type'          => 4,
                                            'message'           => $message,
                                            'sender_number'     => $this->CRUDModel->clean_number($student_info->student_mobile_no),
                                            'create_datetime'   => date('Y-m-d H:i:s'),
                                            'send_date'         => date('Y-m-d'),  
                                            'create_by'         => $this->userInfo->user_id, 
                                          );
                                $this->CRUDModel->insert('sms_students',$data);
                      endif;
                     endif;
                    endforeach;

                    $return_message = '';
                    if(!empty($sender_number)):


                    if($sn >1): 

                        $return         =   $this->send_message_bulk($sender_number,$message);
                        $decode_res     = json_decode($return,true);


                      if(!empty($decode_res['numbers'])):
                           foreach($decode_res['numbers'] as $row):

                            $status     = '';
                            if($row['status']):
                                $status = $row['status'];
                                else:
                                $return_message[] =  'Mobile#'.$sender_number.'  ERROR#'.$status;
                                $status = '';
                            endif;

                        $update_data = array(
                            'delevery_status'=>1,
                            'message_status'=>$status,
                        );

                        $where_up = array(
                          'sender_number'=>$row['number']
                        );

                        $this->CRUDModel->update('sms_students',$update_data,$where_up);
                        endforeach;
                      endif;

                        else:



                           $return =   $this->send_message($sender_number,$message); 

                        $result = json_decode($return,true);

                            $status     = '';
                            if(@$result['status']):
                                $status = $result['status'];
                                else:
                                    $return_message[] =  'Mobile#'.$sender_number.'  ERROR# '.$status;
                                $status = '';
                            endif;
                          $update_data = array(
                            'delevery_status'=>1,
                            'message_status'=>$status,
                        );
                        $where_up = array(
                          'sender_number'=>$this->CRUDModel->clean_number($sender_number)
                        );   

                        $this->CRUDModel->update('sms_students',$update_data,$where_up);     
                    endif;
                    else:
                        $return_message[] =  'Mobile number not found......';
                        endif;
                   endforeach;

                   if(empty($return_message)):

                      $this->session->set_flashdata('success_return', 'Messages send successfully.....'); 
                   else:
                       $this->session->set_flashdata('error_return', $return_message);
                   endif;


                    redirect('admin/admin_home');

                 endif;
                $this->data['page']         = 'sms/hostel_message';
                $this->data['page_header']  = 'Hostel Students Message ';
                $this->data['page_title']   = 'Hostel Students Message | ECMS';
                $this->load->view('common/common',$this->data); 
            }  
   
 
      public function staff_message(){
 
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        $this->data['department']   = $this->CRUDModel->dropDown('department', 'Department', 'department_id', 'title');
        $this->data['designation']  = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'title');
        $this->data['emp_scale']    = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'title');
        $this->data['category']     = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'cat_id', 'title');
        $this->data['subject']      = $this->CRUDModel->dropDown('subject', 'Subjects', 'subject_id', 'title');
        $this->data['status']       = $this->CRUDModel->dropDown('hr_emp_status', 'Status', 'emp_status_id', 'title');
        
         
        
        $this->data['employee_name']    = '';
        $this->data['fatherName']       = '';
        $this->data['gender_id']        = '';
        $this->data['department_id']    = '';
        $this->data['department_id']    = '';
        $this->data['message']          = '';
        $this->data['designation_id']   = '';
        $this->data['emp_scale_id']     = '';
        $this->data['category_id']      = '';
        $this->data['subject_id']       = '';
        $this->data['status_id']        = '';
        $this->data['smsPassword']      = '';
   
        
        if($this->input->post('search')):
            
            $employee_name      = $this->input->post("employee_name");
            $fatherName         = $this->input->post("fatherName");
            $gender             = $this->input->post("gender");
            $designation        = $this->input->post("designation");
            $department         = $this->input->post("department");
            $emp_scale          = $this->input->post("emp_scale");
            $category           = $this->input->post("category");
            $subject            = $this->input->post("subject");
            $status             = $this->input->post("status");
            $smsPassword        = $this->input->post("smsPassword");
            
            $where      = '';
            $like       = '';
            if(!empty($smsPassword)):
                $this->data['smsPassword']     = $smsPassword;
            endif;
            if($employee_name):
                $like['emp_name']               = $employee_name;
                $this->data['employee_name']    = $employee_name;
            endif;
            if($fatherName):
                $like['father_name']            = $fatherName;
                $this->data['fatherName']       = $fatherName;
            endif;
            if($gender):
                $where['gender.gender_id']      = $gender;
                $this->data['gender_id']        = $gender;
            endif;
            if($designation):
                $where['hr_emp_designation.emp_desg_id']    = $designation;
                $this->data['designation_id']               = $designation;
            endif;
            if($department):
                $where['department.department_id']    = $department;
                $this->data['department_id']          = $department;
            endif;
            if($emp_scale):
                $where['emp_scale_id']          = $emp_scale;
                $this->data['emp_scale_id']     = $emp_scale;
            endif;
            if($category):
                $where['hr_emp_category.cat_id']    = $category;
                $this->data['category_id']          = $category;
            endif;
            if($subject):
                $where['subject.subject_id']        = $subject;
                $this->data['subject_id']           = $subject;
            endif;
            if($status):
                $where['hr_emp_record.emp_status_id']= $status;
                $this->data['status_id']            = $status;
            endif;
             
            
            $this->data['result']  = $this->SmsModel->staff_sms($where,$like);
           
        endif;
         if($this->input->post('sendSMS')):

            $checked            = $this->input->post("checked");
            $message            = $this->input->post("message");
            
            foreach($checked as $key=>$emp_id):
                
                            $this->db->join('mobile_network','hr_emp_record.net_id=mobile_network.net_id');
                $emp_info = $this->db->get_where('hr_emp_record',array('hr_emp_record.emp_id'=>$emp_id))->row();
            
            if(!empty($emp_info->contact1)):
                if(empty($emp_info->net_id) && $emp_info->net_id === '0'):
                     $message_status = $this->send_message($this->CRUDModel->clean_number($emp_info->contact1),$message);
                    else:
                     $message_status = $this->send_message($this->CRUDModel->clean_number($emp_info->contact1),$message,$emp_info->send_format);
                endif;
               
//                $message_status = $this->send_message('03369462909',$message,'tenenor');
//                $message_info = explode('"', $message_status);
//                echo '<pre>';print_r($message_info);die;
//                $messResponse = '';
//                if(!empty($message_info)):
//                    $messResponse = $message_info[3];
//                endif;
               
              
                $data = array(
                        'emp_id'            => @$emp_info->emp_id,
                        'sms_type'          => 1,
                        'message'           => @$message,
                        'sender_number'     => @$emp_info->contact1,
//                        'message_status'    => $messResponse,
                        'comments'          => @$message_status,
                        'create_datetime'   => date('Y-m-d H:i:s'),
                        'send_date'         => date('Y-m-d'),  
                        'create_by'         => @$this->userInfo->user_id, 
                      );
            $this->CRUDModel->insert('sms_staff',$data);
            
            endif;
                  
         
            endforeach;
             
            redirect('admin/admin_home','refresh');
           
         endif;
        $this->data['page']         = 'sms/staff_sms';
        $this->data['page_header']  = 'Staff SMS';
        $this->data['page_title']   = 'Staff SMS | ECMS';
        $this->load->view('common/common',$this->data); 
    }        
    public function student_fee_sms(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        
        $this->data['collegeNo']    = '';
        $this->data['message']    = '';
        $this->data['gender_id']    = '';
        $this->data['pc_id']        = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']   = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        
        if($this->input->post('search')):
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message         = $this->input->post("message");
            
            $where      = '';
            $like       = '';
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            
            if(!empty($message)):
            
                $this->data['message']     = $message;
            endif;
            
       
            
            $this->data['result'] = $this->SmsModel->student_fee_sms($where,$like);
//            $this->data['count'] = $this->SmsModel->student_fee_sms($where,$like);

        endif;
         if($this->input->post('sendSMS')):
//              echo '<pre>';print_r($this->input->post());die;
            $checked            = $this->input->post("checked");
            $student_id         = $this->input->post("student_id");
            $message            = $this->input->post("message");
            
            echo '<pre>';print_r($checked);die;
            foreach($checked as $key=>$value):
            $data = array(
              'student_id'             =>$value,
              'student_msg_type'    =>1,
              'message'             =>$message,
              'msg_send_code'       =>0,
              'status'             =>1,
            );
            $this->CRUDModel->insert('student_sms',$data);
            
            endforeach;
            redirect('admin/admin_home','refresh');
           
         endif;
        $this->data['page']         = 'sms/student_fee_sms';
        $this->data['page_header']  = 'Student Fee SMS';
        $this->data['page_title']   = 'Student Fee SMS | ECMS';
        $this->load->view('common/common',$this->data); 
    }      
    public function student_sms_report(){
       
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['sms_type']     = $this->CRUDModel->dropDown('sms_type', 'SmS Type', 'id', 'title',array('status'=>'1'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        
        $this->data['collegeNo']    = '';
        $this->data['batchId']      = '';
        $this->data['gender_id']    = '';
        $this->data['pc_id']        = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['sms_type_id']  = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['sms_type_id']  = '';
        $this->data['from']         = '';
        $this->data['status_id'] = '';
        $this->data['to']           = date('d-m-Y');
        
        if($this->input->post('search')):
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch              = $this->input->post("batch");
            $challan_no      = $this->input->post("challan_no");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $challan_status = $this->input->post("challan_status");
            $gender         = $this->input->post("gender");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $sms_type       = $this->input->post("sms_type");
            $student_status       = $this->input->post("student_status");
  
            if($from == ''):
                $date['from']       = ''; 
                $date['to']         = $to;
                $this->data['from'] = '';
                $this->data['to']   = $to;
                else:
                
                $date['from']       = $from;
                $date['to']         = $to;
                $this->data['from'] = $from;
                $this->data['to']   = $to;
            endif;
            
            $where      = '';
            $like       = '';
            if($student_status):
                $where['student_record.s_status_id']    = $student_status;
                $this->data['status_id']         = $student_status;
            endif;
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($batch):
                $where['prospectus_batch.batch_id'] = $batch;
                $this->data['batchId']        =   $batch;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if($challan_no):
                $where['fee_challan.fc_challan_id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status):
                $where['fee_challan_status.ch_status_id'] = $challan_status;
                $this->data['challan_id'] = $challan_status;
            endif;
            
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            
            if(!empty($pc_id)):
                $like['fee_challan.fc_pay_cat_id'] = $pc_id;
                $this->data['pc_id']           = $pc_id;
            endif;
            
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            
            
            
            $this->data['result'] = $this->SmsModel->student_sms_report($where,$like,$date);
           
        endif;
        
        $this->data['page']         = 'sms/reports/student_sms_report';
        $this->data['page_header']  = 'Student SMS Report';
        $this->data['page_title']   = 'Student SMS Report | ECMS';
        $this->load->view('common/common',$this->data);
    }  
    public function student_sms_report_inter(){
       
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name', array('programe_id' => 1));
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On', 'program_id' => 1));
        $this->data['sms_type']     = $this->CRUDModel->dropDown('sms_type', 'SmS Type', 'id', 'title',array('status'=>'1'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name',array('status'=>'on', 'programe_id' => 1));
        $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        
        $this->data['collegeNo']    = '';
        $this->data['batchId']      = '';
        $this->data['gender_id']    = '';
        $this->data['pc_id']        = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['sms_type_id']  = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['sms_type_id']  = '';
        $this->data['from']         = '';
        $this->data['status_id'] = '';
        $this->data['to']           = date('d-m-Y');
        
        if($this->input->post('search')):
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch              = $this->input->post("batch");
            $challan_no      = $this->input->post("challan_no");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $challan_status = $this->input->post("challan_status");
            $gender         = $this->input->post("gender");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $sms_type       = $this->input->post("sms_type");
            $student_status       = $this->input->post("student_status");
  
            if($from == ''):
                $date['from']       = ''; 
                $date['to']         = $to;
                $this->data['from'] = '';
                $this->data['to']   = $to;
                else:
                
                $date['from']       = $from;
                $date['to']         = $to;
                $this->data['from'] = $from;
                $this->data['to']   = $to;
            endif;
            
            $where      = '';
            $like       = '';
            if($student_status):
                $where['student_record.s_status_id']    = $student_status;
                $this->data['status_id']         = $student_status;
            endif;
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($batch):
                $where['prospectus_batch.batch_id'] = $batch;
                $this->data['batchId']        =   $batch;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if($challan_no):
                $where['fee_challan.fc_challan_id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status):
                $where['fee_challan_status.ch_status_id'] = $challan_status;
                $this->data['challan_id'] = $challan_status;
            endif;
            
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            
            if(!empty($pc_id)):
                $like['fee_challan.fc_pay_cat_id'] = $pc_id;
                $this->data['pc_id']           = $pc_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            
            $where['programes_info.programe_id'] = 1;
            
            
            
            $this->data['result'] = $this->SmsModel->student_sms_report($where,$like,$date);
           
        endif;
        
        $this->data['page']         = 'sms/reports/student_sms_report_inter';
        $this->data['page_header']  = 'Student SMS Report';
        $this->data['page_title']   = 'Student SMS Report | ECMS';
        $this->load->view('common/common',$this->data);
    }  
    public function employee_sms_report(){
        
        
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title'); 
        $this->data['hr_dept']          = $this->CRUDModel->dropDown('department', 'Department Status', 'department_id', 'title'); 
        $this->data['designation']      = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation Status', 'emp_desg_id', 'title'); 
        $this->data['hr_scale']         = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale Status', 'emp_scale_id', 'title'); 
        $this->data['category']         = $this->CRUDModel->dropDown('hr_emp_category', 'Category Status', 'cat_id', 'title'); 
        $this->data['contract_type']    = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Contract Status', 'contract_type_id', 'title'); 
        $this->data['hr_emp_status']    = $this->CRUDModel->dropDown('hr_emp_status', 'Employee Status', 'emp_status_id', 'title'); 
        
        $this->data['emp_name']         = '';
        $this->data['fatherName']       = '';
        $this->data['gender_id']        = '';
        $this->data['dep_id']           = '';
        $this->data['desig_id']         = '';
        $this->data['scale_id']         = '';
        $this->data['category_id']      = '';
        $this->data['cont_type_id']     = '';
        $this->data['emp_status_id']    = '';
        $this->data['from']             = '';
        $this->data['to']               = date('d-m-Y');
        
        
        if($this->input->post('search')):
           
              
            
            $emp_name               =  $this->input->post('emp_name');
            $father_name            =  $this->input->post('father_name');
            $gender_id              =  $this->input->post('gender');
            $department_id          =  $this->input->post('department');
            $current_designation    =  $this->input->post('designation');
            $c_emp_scale_id         =  $this->input->post('hr_scale');
            $emp_status_id          =  $this->input->post('hr_emp_status');
            $cat_id                 =  $this->input->post('category');
            $contract_type_id       =  $this->input->post('contract_type');
            $from                   =  $this->input->post('from');
            $to                     =  $this->input->post('to');
            
            $where      = '';
            $like       = '';
              if($from == ''):
                $date['from']       = ''; 
                $date['to']         = $to;
                $this->data['from'] = '';
                $this->data['to']   = $to;
                else:
                
                $date['from']       = $from;
                $date['to']         = $to;
                $this->data['from'] = $from;
                $this->data['to']   = $to;
            endif;
            
            if(!empty($emp_name)):
                $like['emp_name']           = $emp_name;
                $this->data['emp_name']     = $emp_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
            $this->data['father_name']      = $father_name;
            endif;
            
            //where array 
            if(!empty($gender_id)):
                $where['hr_emp_record.gender_id']  = $gender_id;
                $this->data['gender_id']            = $gender_id;
            endif;
            if(!empty($department_id)):
                $where['department.department_id']  = $department_id;
                $this->data['dep_id']        = $department_id;
            endif;
            if(!empty($current_designation)):
                $where['hr_emp_designation.emp_desg_id']    = $current_designation;
                $this->data['desig_id']          = $current_designation;
            endif;
            if(!empty($emp_status_id)):
                $where['hr_emp_record.emp_status_id']       = $emp_status_id;
                $this->data['emp_status_id']                = $emp_status_id;
            endif;
            if(!empty($c_emp_scale_id)):
                $where['hr_emp_record.j_emp_scale_id']         = $c_emp_scale_id;
                $this->data['scale_id']               = $c_emp_scale_id;
            endif;
            if(!empty($cat_id)):
                $where['hr_emp_category.cat_id']            = $cat_id;
                $this->data['category_id']                 = $cat_id;
            endif;
            if(!empty($contract_type_id)):
                $where['hr_emp_contract_type.contract_type_id'] = $contract_type_id;
                $this->data['contract_type_id']                 = $contract_type_id;
            endif; 
            
            
            $this->data['result'] = $this->SmsModel->employee_sms_report($where,$like,$date);
            
//            echo '<pre>';print_r($this->data['result']);die;
        endif;
        $this->data['page']         = 'sms/reports/employee_sms_report';
        $this->data['page_header']  = 'Employee SMS Report';
        $this->data['page_title']   = 'Employee SMS Report | ECMS';
        $this->load->view('common/common',$this->data); 
    }
        public function check_sms_password(){
            $password = $this->input->post('password');
            
            $check_password = $this->db->get_where('sms_password',array('password'=>$password))->row();
         
            if(empty($check_password)):
                echo  1;
                else:
                echo  2;
                
            endif;
            
        }
    public function attendance_message_date_wise(){

        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        
        $this->data['college_no']  = '';
        $this->data['message']      = '';
        $this->data['gender_id']    = '';
        $this->data['status_id']    = '5';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        $this->data['smsPassword']  = '';
        $this->data['dateFrom']     = date('d-m-Y');
        $this->data['dateTo']       = date('d-m-Y');
        
        if($this->input->post('search')):
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message        = $this->input->post("message");
            $student_status = $this->input->post("student_status");
            $smsPassword    = $this->input->post("smsPassword");
            $dateFrom       = $this->input->post("dateFrom");
            $dateTo         = $this->input->post("dateTo");
            
            $this->data['dateFrom']     = $this->input->post("dateFrom");
            $this->data['dateTo']       = $this->input->post("dateTo");
            
            if(!empty($smsPassword)):
                $this->data['smsPassword']     = $smsPassword;
            endif;
            
            $where['message_flag']      = '1';
            $like       = '';
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['college_no']           = $collegeNo;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;
            
            if(!empty($message)):
            
                $this->data['message']     = $message;
            endif;
            $this->data['result'] = $this->SmsModel->student_fee_sms_date_wise($where,$like,$dateFrom,$dateTo);
//            $this->data['count'] = $this->SmsModel->student_fee_sms($where,$like);
//            echo '<pre>';print_r($this->data['result']);die;
        endif;
          if($this->input->post('sendSMS')):
                $checked = $this->input->post("checked");
                $message = $this->input->post("message");
               
                
                foreach($checked as $key=>$student_id):
                    $messageSend = '';
                    $student_info       = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));
                    if($student_info):
                        $messageSend           = $message[$key];
                        if($message !='null'):
                            $formCode       = $this->input->post("formCode");
                            $Check_where    = array(
                                'student_id'    => $student_info->student_id,
                                'formCode'      => $formCode,
                                );
                            $check_double_msg = $this->CRUDModel->get_where_row('sms_students',$Check_where);
                          
                            if(empty($check_double_msg)):
                                if($student_info->net_id == 0):
 
                                    $return     = $this->send_message($student_info->mobile_no,$messageSend);
                                else:
                                    $return     = $this->send_message($student_info->mobile_no,$messageSend,$student_info->mobile_network);
                                endif;
 
                               $result     = json_decode($return,true);
                                $status     = '';
                                if($result['status']):
                                    $status = $result['status'];
                                    else:
                                    $status = '';
                                endif;
                                $return_resp = '';
                                if(@$return):
                                    $return_resp = $return;
                                    else:
                                    $return_resp = 'null';
                                    endif;
                                   $section = ''; 
                                if($student_info->section_id):
                                    $section = $student_info->section_id;
                                    else:
                                    $section = 0;
                                endif;
                                $send_message = '';
                                if(empty($message)):
                                    $send_message = ''; 
                                    else:
                                     $send_message = $messageSend;
                                endif;
                   
                                
                       
                                $data = array(
                                'student_id'        => $student_info->student_id,
                                'program_id'        => $student_info->programe_id,
                                'formCode'          => $formCode,
                                'sub_pro_id'        => $student_info->sub_pro_id,
                                'sec_id'            => $section,
                                'batch_id'          => $student_info->batch_id,
                                'sms_type'          => 2,
                                'message'           => $messageSend,
                                'message_status'    => $status,
                                'comments'          => $return_resp,
                                'sender_number'     => $this->CRUDModel->clean_number($student_info->mobile_no),
                                'create_datetime'   => date('Y-m-d H:i:s'),
                                    'send_date'     => date('Y-m-d'),  
                                'create_by'         => $this->userInfo->user_id, 
                              );
                             $this->CRUDModel->insert('sms_students',$data);
                            endif;
                        endif;
                      endif;
                     
                     
                    
            endforeach;
            redirect('admin/admin_home');
        endif;
        $this->data['page']         = 'sms/forms/student_attendance_message_date_wise_v';
        $this->data['page_header']  = 'Student Attendance Message Date Wise';
        $this->data['page_title']   = 'Student Attendance Message Date Wise | ECMS';
        $this->load->view('common/common',$this->data); 
    }
    
    public function student_attendance_defaulter_message(){

        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        
        $this->data['college_no']  = '';
        $this->data['message']      = '';
        $this->data['gender_id']    = '';
        $this->data['status_id']    = '5';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        $this->data['message']      = '';
        $this->data['Percentage']   = '';
        $this->data['dateFrom']     = date('d-m-Y');
        $this->data['dateTo']       = date('d-m-Y');
        
        if($this->input->post('search')):
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message        = $this->input->post("message");
            $student_status = $this->input->post("student_status");
            $smsPassword    = $this->input->post("smsPassword");
            $dateFrom       = $this->input->post("dateFrom");
            $dateTo         = $this->input->post("dateTo");
            $Percentage     = $this->input->post("Percentage");
            
            $this->data['dateFrom']     = $this->input->post("dateFrom");
            $this->data['dateTo']       = $this->input->post("dateTo");
            
            if(!empty($smsPassword)):
                $this->data['smsPassword']     = $smsPassword;
            endif;
            
            $where['message_flag']      = '1';
            $like       = '';
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['college_no']           = $collegeNo;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;
            
            if(!empty($message)):
                    $this->data['message']     = $message;
            endif;
            if(!empty($Percentage)):
                    $this->data['Percentage']     = $Percentage;
            endif;
            $this->data['result'] = $this->SmsModel->student_fee_sms_date_wise($where,$like,$dateFrom,$dateTo);
//            $this->data['count'] = $this->SmsModel->student_fee_sms($where,$like);
//            echo '<pre>';print_r($this->data['result']);die;
        endif;
          if($this->input->post('sendSMS')):
                $checked = $this->input->post("checked");
                $message = $this->input->post("message");
               
                if($message):
               
                foreach($checked as $key=>$student_id):
                    $messageSend = '';
                    $student_info               = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));
                    if($student_info):
                        $messageSend            = $message;
                        if($message !='null'):
                            $formCode       = $this->input->post("formCode");
                            $Check_where    = array(
                                'student_id'    => $student_info->student_id,
                                'formCode'      => $formCode,
                                );
                            $check_double_msg = $this->CRUDModel->get_where_row('sms_students',$Check_where);
                            $network_chk = '';
                            if(empty($check_double_msg)):
                                if($student_info->net_id == 0):
                                    $network_chk = '';
                                    $return     = $this->send_message($student_info->mobile_no,$messageSend);
                                else:
                                    $return     = $this->send_message($student_info->mobile_no,$messageSend,$student_info->mobile_network);
                                $network_chk = $student_info->mobile_network;
                                endif;
                                $result     = json_decode($return,true);
                                $status     = '';
                                if(@$result['status']):
                                    $status = $result['status'];
                                    else:
                                    $status = '';
                                endif;
                                $return_resp = '';
                                if(@$return):
                                    $return_resp = $return;
                                    else:
                                    $return_resp = 'null';
                                    endif;
                                   $section = ''; 
                                if($student_info->section_id):
                                    $section = $student_info->section_id;
                                    else:
                                    $section = 0;
                                endif;
                                $send_message = '';
                                if(empty($message)):
                                    $send_message = ''; 
                                    else:
                                     $send_message = $messageSend;
                                endif;
                   
                                
                       
                                $data = array(
                                'student_id'        => $student_info->student_id,
                                'program_id'        => $student_info->programe_id,
                                'formCode'          => $formCode,
                                'sub_pro_id'        => $student_info->sub_pro_id,
                                'sec_id'            => $section,
                                'batch_id'          => $student_info->batch_id,
                                'sms_type'          => 2,
                                'network'           => $network_chk,
                                'message'           => $messageSend,
                                'message_status'    => $status,
//                                'comments'          => $return_resp,
                                'sender_number'     => $this->CRUDModel->clean_number($student_info->mobile_no),
                                'create_datetime'   => date('Y-m-d H:i:s'),
                                    'send_date'     => date('Y-m-d'),  
                                'create_by'         => $this->userInfo->user_id, 
                              );
                             $this->CRUDModel->insert('sms_students',$data);
                            endif;
                        endif;
                      endif;
                     
                     
                    
            endforeach;
                 
                endif;
            redirect('AttendanceDefMsg');
        endif;
        $this->data['page']         = 'sms/forms/student_attendance_defaulter_message';
        $this->data['page_header']  = 'Student Attendance Defaulter';
        $this->data['page_title']   = 'Student Attendance Defaulter | ECMS';
        $this->load->view('common/common',$this->data); 
    }
}

?>