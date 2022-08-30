<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class ApiController extends AdminController{
	function __construct(){
		parent::__construct();
                
                $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
                $this->load->model('CRUDModel');
	}
        
        public function live_api_student_info(){
              
            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['AuthCode']     = '';
            $this->data['UserID']       = '';
            $this->data['program_id']   = '';
            $this->data['sub_pro_id']   = '';
            
            if($this->input->post('CreateAuth')):
                    
                           $data = array(
                               "username" => "admin",
                               "password" => "Admin123$"
                               );                                                                    
                  $data_string = json_encode($data);                                                                                   
                  $header = array(
                      'Client-Service:frontend-client',
                      'Auth-Key:simplerestapi',
                      'Content-Typ:application/x-www-form-urlencoded',                                                                                
                                                                                                       
                      'Content-Length:'. strlen($data_string));
                  $ch = curl_init('https://edwardes.edu.pk/API/index.php/auth/login?username=admin&password=Admin123$');                                                                      
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                  
                  $result = curl_exec($ch);
                  
                    if (curl_errno($ch)) {
                    print "Error: " . curl_error($ch);
                    exit();
                    }
                  $json= json_decode($result, true);
                  $this->data['program_id']   = $this->input->post('Program');
                  $this->data['sub_pro_id']   = $this->input->post('sub_pro_id');
                  $this->data['AuthCode']   = $json['token'];
                  $this->data['UserID']     = $json['id'];
                  
//                echo '<pre>';print_r($this->data);die;
                
            endif;
            
            if($this->input->post('SearchRecord')):
                $data = '';
                $program = $this->input->post('Program');
                $sub_pro_id = $this->input->post('sub_pro_id');
                if(!empty($program)):
                  $data['programes_info.programe_id'] =  $program;  
                endif;
                if(!empty($sub_pro_id)):
                  $data['student_record.sub_pro_id'] =  $sub_pro_id;  
                endif;
            
//                $data           = array(
//                    "programes_info.programe_id" => ,
//                    "student_record.sub_pro_id" => $this->input->post('sub_pro_id')
//                    );                                                                    
                $data_string    = json_encode($data);                                                                                   
                  
                  $header = array(
                      'Client-Service:frontend-client',
                      'Auth-Key:simplerestapi',
                      'Content-Typ:application/json',                                                                                
                      'Authorization:'.$this->input->post('AuthCode'),
                      'User-ID:'.$this->input->post('UserID'),                                                                                
                      'Content-Length:'. strlen($data_string));
                  $ch = curl_init('https://edwardes.edu.pk/API/StudentController/student_search_result');                                                                      
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                  $result = curl_exec($ch);
                  
                    if (curl_errno($ch)) {
                    print "Error: " . curl_error($ch);
                    exit();
                    }
                    $this->data['result_search']    = json_decode($result, true);
                    $this->data['program_id']       = $this->input->post('Program');
                    $this->data['AuthCode']         = $this->input->post('AuthCode');
                    $this->data['UserID']           = $this->input->post('UserID');
                    $this->data['sub_pro_id']   = $this->input->post('sub_pro_id');
                  
                 
            endif;
            if($this->input->post('synchronize')):
//                    $data           = array(
//                    "programe_id"               => $this->input->post('Program'),
//                    "student_record.sub_pro_id" => $this->input->post('sub_pro_id')
//                    );
                $data = '';
                    $program = $this->input->post('Program');
                    $sub_pro_id = $this->input->post('sub_pro_id');
                    if(!empty($program)):
                      $data['programe_id'] =  $program;  
                    endif;
                    if(!empty($sub_pro_id)):
                      $data['student_record.sub_pro_id'] =  $sub_pro_id;  
                    endif;
                    $data_string    = json_encode($data);                                                                                   
                  
                    $header         = array(
                                'Client-Service:frontend-client',
                                'Auth-Key:simplerestapi',
                                'Content-Typ:application/json',                                                                                
                                'Authorization:'.$this->input->post('AuthCode'),
                                'User-ID:'.$this->input->post('UserID'),                                                                                
                                'Content-Length:'.strlen($data_string));
                    
                    $ch = curl_init('https://edwardes.edu.pk/API/StudentInformation');                                                                      
//                  $ch = curl_init('https://edwardes.edu.pk/API/StudentController/student_information');                                                                      
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                  $season_data = curl_exec($ch);
//                 echo '<pre>';print_r($season_data);die;
                    if (curl_errno($ch)) {
                    print "Error: " . curl_error($ch);
                    exit();
                    }
                 
                    
                // Show me the result
                curl_close($ch);
                $studentRecord = json_decode($season_data, true);
              
               
            if(!empty($studentRecord)):
                foreach($studentRecord as $row1):
               
                    $row =  json_decode(json_encode($row1), FALSE);
                   
                $student_info = array(
                    'student_live_id'       => $row->Live_student_id,
                    'reg_batch_id'          => $row->reg_batch_id,
                    'batch_id'              => $row->batch_id,
                    'programe_id'           => $row->programe_id,
                    'programe_id'           => $row->programe_id,
                    'sub_pro_id'            => $row->sub_pro_id,
                    'admitted_to'           => $row->admitted_to,
                    'admitted_to'           => $row->admitted_to,
                    'form_no'               => $row->form_no,
                    'rseats_id'             => $row->OpenMerit,
                    'rseats_id1'            => $row->R_Seat1,
                    'rseats_id3'            => $row->R_Seat2,
                    'rseats_id2'            => $row->Admission_In,
                    'shift_id'              => $row->shift_id,
                    'college_no'            => $row->college_no,
                    'applicant_mob_no1'     => $row->applicant_mob_no1,
                    'applicant_mob_no2'     => $row->applicant_mob_no2,
                    'lang_college_no'       => $row->lang_college_no,
                    'fata_school'           => $row->fata_school,
                    'lang_status_id'        => $row->lang_status_id,
                    'student_name'          => $row->student_name,
                    'student_cnic'          => $row->student_cnic,
                    'gender_id'             => $row->gender_id,
                    'marital_id'            => $row->marital_id,
                    'dob'                   => $row->dob,
                    'dob_in_words'          => $row->dob_in_words,
                    'sports_id'             => $row->sports_id,
                    'place_of_birth'        => $row->place_of_birth, 
                    'board_regno'           => $row->board_regno,
                    'bg_id'                 => $row->bg_id,
                    'country_id'            => $row->country_id,
                    'domicile_id'           => $row->domicile_id,
                    'district_id'           => $row->district_id,
                    'religion_id'           => $row->religion_id,
                    'hostel_required'       => $row->hostel_required,
                    'hostel_applied'        => $row->hostel_applied,
                    'migration_status'      => $row->migration_status,
                    'migrated_remarks'      => $row->migrated_remarks,
                    'char_id'               => $row->char_id,
                    'father_name'           => $row->father_name,
                    'father_cnic'           => $row->father_cnic,  
                    'land_line_no'          => $row->land_line_no,
                    'mobile_no'             => $row->mobile_no,
                    'net_id'                => $row->net_id,
                    'mobile_no2'            => $row->mobile_no2,
                    'occ_id'                => $row->occ_id,
                    'annual_income'         => $row->annual_income,
                    'app_postal_address'    => $row->app_postal_address,
                    'parmanent_address'     => $row->parmanent_address,
                    'last_school_address'   => $row->last_school_address,
                    'father_email'          => $row->father_email,
                    'guardian_name'         => $row->guardian_name,
                    'guardian_cnic'         => $row->guardian_cnic,
                    'relation_with_guardian'=> $row->relation_with_guardian,
                    'guardian_occupation'   => $row->guardian_occupation,
                    'g_annual_income'       => $row->g_annual_income,
                    'g_land_no'             => $row->g_land_no,
                    'g_mobile_no'           => $row->g_mobile_no,
                    'g_postal_address'      => $row->g_postal_address,
                    'uni_regno'             => $row->uni_regno,
                    'g_email'               => $row->g_email,
                    'physical_status_id'    => $row->physical_status_id,
                    'emargency_person_name' => $row->emargency_person_name,
                    'e_person_relation'     => $row->e_person_relation,
                    'e_person_contact1'     => $row->e_person_contact1,
                    'e_person_contact2'     => $row->e_person_contact2,
                    's_status_id'           => $row->s_status_id,
                    'bank_receipt_no'       => $row->bank_receipt_no,
                    'admission_date'        => $row->admission_date,
                    'leaving_date'          => $row->leaving_date,
                    'dues_status'           => $row->dues_status,
                    'admission_comment'     => $row->admission_comment,
                    'father_image'          => $row->father_image,
                    'applicant_image'       => $row->applicant_image,
                    'timestamp'             => $row->timestamp,
                    'user_id'               => $row->user_id,
                    'updated_by_user'       => $row->updated_by_user,
                    'updated_datetime'      => $row->updated_datetime,
                    'bu_number'             => $row->bu_number,
                    'flag'                  => $row->flag,
                    'prac_flag'             => $row->prac_flag,
                    'certificate_issue_date'=> $row->certificate_issue_date,
                    'dues_any'              => $row->dues_any,
                    'std_amount'            => $row->std_amount,
                    'std_diary'             => $row->std_diary,
                    'std_dnotice_last_date' => $row->std_dnotice_last_date,
                    'std_dnotice_print_date'=> $row->std_dnotice_print_date,
                    'remarks'               => $row->remarks,
                    'remarks2'              => $row->remarks2,
                    'temporary_yead_head_flag'=> $row->temporary_yead_head_flag,
                    'temporary_yead_head_comment'=> $row->temporary_yead_head_comment,
                    'year_head_user_id'     => $row->year_head_user_id,
                    'promotion_flag'        => $row->promotion_flag,
                    'student_password'      => $row->student_password,
                    'login_status'          => $row->login_status,
                    'student_type'          => $row->student_type,
                    'message_flag'          => $row->message_flag,
                    'student_comments'      => $row->student_comments,
                    'std_mobile_network'    => $row->std_mobile_network,
                    'challan_print_flag'    => $row->challan_print_flag,
                    'deficiency_flag'       => $row->deficiency_flag,
                    'eligibility_hostel'    => $row->eligibility_hostel,
                    'data_verification_remarks' => $row->data_verification_remarks,
                    'student_email'         => $row->student_email,
                );
            
                $student_id = $this->CRUDModel->insert('student_record',$student_info);
//                echo '<pre>';print_R($row);die;
                  //Subject Details Insert  
                if(!empty($row->Student_Sub_Info)):
                   foreach($row->Student_Sub_Info as $SubRow):
                        $SubjectInfo = array(
                          'student_id'      => $student_id,
                          'subject_id'      => $SubRow->subject_id,
                          'sub_prog_id'     => $SubRow->sub_prog_id,
                          'created_by'      => $SubRow->created_by,
                          'date_time'       => $SubRow->date_time,
                          'updated_by'      => $SubRow->updated_by,
                          'update_date_time'=> $SubRow->update_date_time,
                            );
                          $this->CRUDModel->insert('new_student_subjects',$SubjectInfo);  
                   endforeach;
                endif;
                
                 
                if(!empty($row->Student_Edu_Info)):
                    foreach($row->Student_Edu_Info as $edRow):
                        $EducationInfo = array(
                          'student_id'          => $student_id, 
                          'degree_id'           => $edRow->degree_id, 
                          'inst_id'             => $edRow->inst_id, 
                          'bu_id'               => $edRow->bu_id, 
                          'year_of_passing'     => $edRow->year_of_passing, 
                          'total_marks'         => $edRow->total_marks, 
                          'obtained_marks'      => $edRow->obtained_marks, 
                          'div_id'              => $edRow->div_id, 
                          'cgpa'                => $edRow->cgpa, 
                          'lat_marks'           => $edRow->lat_marks, 
                          'percentage'          => $edRow->percentage,
                          'total_marks_9th'     => $edRow->total_marks_9th, 
                          'obtained_marks_9th'  => $edRow->obtained_marks_9th, 
                          'percentage_9th'      => $edRow->percentage_9th,  
                          'grade_id'            => $edRow->grade_id, 
                          'rollno'              => $edRow->rollno, 
                          'board_reg_no'        => $edRow->board_reg_no, 
                          'exam_type'           => $edRow->exam_type, 
                          'sub_pro_id'          => $edRow->sub_pro_id, 
                          'academic_comments'   => $edRow->academic_comments, 
                          'app_verify_flag'     => $edRow->app_verify_flag, 
                          'timestamp'           => $edRow->timestamp, 
                          'inserteduser'        => $edRow->inserteduser, 
                          'updateduser'         => $edRow->updateduser, 
                        );
                         $this->CRUDModel->insert('applicant_edu_detail',$EducationInfo); 
                    endforeach;
                endif;

                   //Education Record Log 
                if(!empty($row->Student_Edu_Logs)):
                    foreach($row->Student_Edu_Logs as $ELog):
                       $Student_Edu_Logs = array(
                         'student_id'          => $student_id,  
                         'hostel_old_status'   => $ELog->hostel_old_status,  
                         'old_ob_marks'        => $ELog->old_ob_marks,  
                         'old_total_marks'     => $ELog->old_total_marks,  
                         'old_comments'        => $ELog->old_comments,  
                         'update_by'           => $ELog->update_by,  
                         'update_datetime'     => $ELog->update_datetime,  
                       );
                       $this->CRUDModel->insert('data_verification_log',$Student_Edu_Logs); 
                    endforeach;
                endif; 
              
                  //Fee Record Details 
                if(!empty($row->Student_Fee_Info)):
                    foreach($row->Student_Fee_Info as $FeeRow):
                        $Fee_Details = array(
                          'student_id'          => $student_id,  
                          'pros_fee_id'         => $FeeRow->pros_fee_id,  
                          'date'                => $FeeRow->date,  
                          'paid_date'           => $FeeRow->paid_date,  
                          'challan_comments'    => $FeeRow->challan_comments,  
                          'due_date'            => $FeeRow->due_date,  
                          'create_datetime'     => $FeeRow->create_datetime,  
                          'status'              => $FeeRow->status,
                          'staffChild_flag'     => $FeeRow->staffChild_flag, 
                        );
                       $this->CRUDModel->insert('prospectus_challan',$Fee_Details);  
                    endforeach;
                endif;
                
                  //Fee Record Log
                 
                if($row->Student_Fee_Logs):
                    foreach($row->Student_Fee_Logs as $FLogRow):
                        $Fee_Log = array(
                            'student_id'            => $student_id,
                            'old_status_id'         => $FLogRow->old_status_id,
                            'change_status_comment' => $FLogRow->change_status_comment,
                            'update_by'             => $FLogRow->update_by,
                            'udpate_timestamp'      => $FLogRow->udpate_timestamp,
                        );
                         $this->CRUDModel->insert('student_fee_verification_log',$Fee_Log);
                    endforeach;
                endif;
                if($row->Student_Doc):
                    foreach($row->Student_Doc as $DocRow):
                        $Student_Doc = array(
//                            'sd_id'         => $DocRow->sd_id,
                            'sd_student_id' => $DocRow->sd_student_id,
                            'sd_image'      => $DocRow->sd_image,
                            'sd_flag'       => $DocRow->sd_flag,
                            'sd_datetime'   => $DocRow->sd_datetime,
                             
                        );
                         $this->CRUDModel->insert('student_documents',$Student_Doc);
                    endforeach;
                endif;
                
                
               //Update Student Syn Flag = 2 
                    $data = array("syn_data_flag" => "2");                                                                    
                  $data_string = json_encode($data);                                                                                   
                  $header = array(
                      'Client-Service:frontend-client', 
                      'Auth-Key:simplerestapi',
                      'Content-Typ:application/json',                                                                                
                      'Authorization:'.$this->input->post('AuthCode'),
                      'User-ID:'.$this->input->post('UserID'),                                                                                
                      'Content-Length:'. strlen($data_string));
                  $ch = curl_init('https://edwardes.edu.pk/API/StudentController/student_update_syn_flag/'.$row->Live_student_id);                                                                      
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                  
                  $result = curl_exec($ch);
                  
                    if (curl_errno($ch)) {
                    print "Error: " . curl_error($ch);
                    exit();
                    }
                  $json= json_decode($result, true);
                endforeach;
                redirect('OnlineAPI','refresh');
            endif;
            endif;
 
        $this->data['page']                 = "API/Forms/data_synchronize";
        $this->data['page_title']           = 'Online Data Synchronize| ECMS';
        $this->data['page_header']          = 'Online Data synchronize';
        $this->load->view('common/common',$this->data);
        }
      
        
 
        
}
