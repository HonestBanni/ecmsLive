<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class PromotionController extends AdminController {
    
     public function __construct() 
        {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('PromotionModel');
             $this->load->library("pagination");
       }
    
    public function promotion_grand_report()
    {
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['newsubprogrames']  = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender Status ', 'gender_id', 'title');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('status'=>'on'));
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
            
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $college_no                     =  $this->input->post('college_no');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
            $limit                          =  $this->input->post('limit');
            $batch                          =  $this->input->post('batch');
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['genderId']         = '';
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['pictureId']          = '';
            $this->data['batchId']          = '';
            $where['student_record.s_status_id'] = 5;
           // $where['student_record.promotion_flag'] = 1;
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
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']     = $gender;
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
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if($this->input->post('search')):          
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.father_name,
                    student_record.form_no,
                    sub_programes.flag,
                    student_status.name as student_statusName,
                    student_status.s_status_id as s_status_id,
                    programes_info.programe_name,
                    sub_programes.sub_pro_id as sub_pro_id,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name,
                    sections.sec_id,
                    sections.name as sectionName
                    ';

        $this->data['result'] = $this->PromotionModel->grand_report($field,'student_record', $where,$like);
            endif;
        $session = $this->session->all_userdata();
        $user_id = $session['userData']['user_id'];
            
        if($this->input->post('promote')):    
            $ides               = $this->input->post('checked');
            $sub_pro_id         = $this->input->post('newsub_program');
            $sec_id             = $this->input->post('new_sections');
            $flag            = $this->input->post('flag');
            $sec_id_old         = $this->input->post('sec_id_old');
            $sub_pro_id_old     = $this->input->post('sub_pro_id_old');
            
            $promoted_check     = $this->input->post('promoted_check');
            $promoted_date      = $this->input->post('promoted_date');
            $comment            = $this->input->post('comment');
             
            if(!empty($ides)):
                foreach($ides as $row=>$value):
                
                $this->CRUDModel->update(
                        'student_record',
                        array('promotion_flag'=>2,'sub_pro_id'=>$sub_pro_id),
                        array('student_id'=>$value)
                   );
                $this->CRUDModel->update(
                        'student_group_allotment',
                        array('promotion_flag'=>2,'section_id'=>$sec_id),
                        array('student_id'=>$value)
                   );
                $this->CRUDModel->insert('
                student_promotion_details',
                 array(
                   'student_id'=>$value,
                   'sub_pro_id'=>$sub_pro_id_old,
                   'sec_id'=>$sec_id_old,
                   'promoted_check'=>$promoted_check,
                   'promoted_date'=>$promoted_date,
                   'comments'=>$comment,
                   'user_id'=>$user_id
                 ));
            if($flag == 2):
                $where = array('student_id'=>$value,'section_id'=>$sec_id_old); 
                $this->CRUDModel->deleteid('student_subject_alloted',$where);
            endif;
            endforeach;  
           redirect('PromotionController/promotion_sections/'.$sec_id_old);
            endif;
        endif;                
                $this->data['ReportName']   = 'Promotion Grand Report';
                $this->data['page']         = "promotion/promotion_grand_report";
                $this->data['title']        = 'Grand Report | ECMS';
                $this->load->view('common/common',$this->data);
    }
    
    public function promotion_sections(){
        if($this->input->post()):
            
            
            $sections_name      = $this->input->post('sections_name');
            $sections_status    = $this->input->post('sections_status');
         
            
                    $this->CRUDModel->update(
                        'sections',
                            array('status'=>$sections_status),
                            array('sec_id'=>$sections_name)
                        );
                 $section_info = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sections_name));   
            $new_sections    = $this->input->post('new_sections');
            $batch_id    = $this->input->post('batch_id');
                    $this->CRUDModel->insert(
                        'sections',
                            array(
                                'name'          => $new_sections,
                                'sub_pro_id'    => $section_info->sub_pro_id,
                                'status'        => 'On',
                                'batch_id'      => $batch_id,
                                'program_id'    => $section_info->program_id,
                                'shift_id'      => 1,
                                'timestamp'      => date('Y-m-d H:i:s'),
                                )
                        );
            redirect('PromotionController/promotion_grand_report');
            else:
            $section_id = $this->uri->segment(3);
        $this->data['sectionId']        =$section_id;    
        $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('sec_id'=>$section_id));
        $this->data['SectionName']      = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$section_id));
        $this->data['old_batch']        = $this->CRUDModel->dropDown('prospectus_batch', '', 'batch_id', 'batch_name',array('status'=>'on','batch_id'=>$this->data['SectionName']->batch_id));
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch ', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>$this->data['SectionName']->program_id));
        endif;
        
        
        $this->data['ReportName']       = 'Promotion Sections';
        $this->data['page']             = "promotion/promotion_sections";
        $this->data['title']            = 'Promotion Sections | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    
    public function promotion_to_alumni()
    {
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['newsubprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            
            $college_no                     =  $this->input->post('college_no');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $section                        =  $this->input->post('sections_name');
            
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['programId']        = '';
            $this->data['subprogramId']     = '';
            $where['student_record.s_status_id'] = 5;
        
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
            if($this->input->post('search')):          
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    gender.title as genderName,
                    student_record.father_name,
                    student_record.form_no,
                    sub_programes.flag,
                    student_status.name as student_statusName,
                    student_status.s_status_id as s_status_id,
                    programes_info.programe_name,
                    sub_programes.sub_pro_id as sub_pro_id,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name,
                    sections.sec_id,
                    sections.name as sectionName
                    ';

        $this->data['result'] = $this->PromotionModel->grand_report($field,'student_record', $where,$like);
            endif;
        $session = $this->session->all_userdata();
        $user_id = $session['userData']['user_id'];
            
        if($this->input->post('promote')):    
            
            
            $ides               = $this->input->post('checked');
            $program            = $this->input->post('program');
            $flag               = $this->input->post('flag');
            $sub_program        = $this->input->post('sub_program');
            $s_status_id        = $this->input->post('s_status_id');
            $s_status_id_old    = $this->input->post('s_status_id_old');
            $promoted_check     = $this->input->post('promoted_check');
            $promoted_date      = $this->input->post('promoted_date');
            $date1              = date('Y-m-d', strtotime($promoted_date));
            $comment            = $this->input->post('comment');
            if(!empty($ides)):
                $All_sections = '';
                foreach($ides as $row=>$value):
                 $where     = array('student_id'=>$value);
                 $qry       = $this->CRUDModel->get_where_row('student_record',$where);
                 $query      = $this->CRUDModel->get_where_row('student_group_allotment',$where);
//                
                $this->CRUDModel->update(
                    'student_record',
                     array('s_status_id'=>$s_status_id),
                    array('student_id'=>$value)
                   );
                $this->CRUDModel->update(
                    'hostel_student_record',
                     array('hostel_status_id'=>4),
                    array('student_id'=>$value)
                   );
                $this->CRUDModel->insert('
                student_promotion_alumni_details',
                 array(
                   'student_id'=>$value,
                   'sub_pro_id'=>$qry->sub_pro_id,
                   'sec_id'=>$query->section_id,
                   's_status_id'=>$s_status_id_old,
                   'promoted_date'=>$date1,
                   'comments'=>$comment,
                   'user_id'=>$user_id
                 ));
               $where = array('student_id'=>$value,'section_id'=>$query->section_id); 
               $this->CRUDModel->deleteid('student_group_allotment',$where);
               if($flag == 2):
                $where = array('student_id'=>$value,'section_id'=>$query->section_id); 
                $this->CRUDModel->deleteid('student_subject_alloted',$where);
                endif;
               $All_sections[] = $query->section_id;
            endforeach;
            $result = array_unique($All_sections);
            $flash_message = array(
                'all_sections'  => $result,
                'program'       => $program,
                'sub_program'   => $sub_program,
            );
            $this->session->set_flashdata($flash_message);
            
            redirect('PromotionController/promotion_sections_alumni');
            
            endif;
        endif;
        $this->data['ReportName']   = 'Promotion to Alumni';
        $this->data['page']         = "promotion/promotion_to_alumni";
        $this->data['title']        = 'Promotion to Alumni | ECMS';
        $this->load->view('common/common',$this->data);  
    }
    
    
     public function promotion_sections_alumni(){
        if($this->input->post()):
            $off_sections_ids = $this->input->post('off_sections_ids');
            $sections_status = $this->input->post('sections_status');
            
            foreach($off_sections_ids as $key=>$value):

                $this->CRUDModel->update(
                        'sections',
                            array('status'=>$sections_status),
                            array('sec_id'=>$value)
                        );
            endforeach;
            
            $new_sections = $this->input->post('new_sections');
            $batch_new_id = $this->input->post('batch_new_id');
            $program_name = $this->input->post('program_name');
            $sub_program = $this->input->post('sub_program');
            foreach($new_sections as $key=>$value):

                $this->CRUDModel->insert(
                        'sections',
                            array(
                                
                                'name'          => $value,
                                'sub_pro_id'    => $sub_program,
                                'status'        => 'On',
                                'batch_id'      => $batch_new_id,
                                'program_id'    => $program_name,
                                'shift_id'      => 1,
                                'timestamp'      => date('Y-m-d H:i:s'),
                                )
                        );
            endforeach;
            
            redirect('PromotionController/promotion_to_alumni');
            
            else:
            $flash_message              = $this->session->flashdata();
            $this->data['all_sections'] = $flash_message['all_sections'];
            $this->data['program']      = $flash_message['program'];
            $this->data['sub_program']  = $flash_message['sub_program'];
            $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch ', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>$this->data['program']));
   
        endif;
        
        $this->data['ReportName']       = 'Promotion Sections';
        $this->data['page']             = "promotion/promotion_sections_alumni";
        $this->data['title']            = 'Promotion Sections | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    public function auto_relation()
     { 
        $term = trim(strip_tags($_GET['term']));
            if( $term == ''){
            $result_set             = $this->CRUDModel->getResults('relation');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'id'=>$row_set->relation_id,
                    'value'=>$row_set->title,
                    'label'=>$row_set->title
                );  
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('title'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('relation',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                   'id'=>$row_set->relation_id,
                    'value'=>$row_set->title,
                    'label'=>$row_set->title
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    public function class_alloted_delet11(){          
        
        $this->data['emp_id']           = "";
        $this->data['sec_id']           = "";
        $this->data['subject_id']       = "";
        $this->data['program_id']       = "";
        $this->data['sub_pro_id']       = "";
        
        if($this->input->post()):
            $emp_id         = $this->input->post('emp_id');
            $sec_id         = $this->input->post('sec_id');
            $subject_id     = $this->input->post('subject_id');
            $program_id     = $this->input->post('program_id');
            $sub_program_id     = $this->input->post('sub_program_id');
            $where = "";
            if($emp_id):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if($sec_id):
                $where['sections.sec_id'] = $sec_id;
                $this->data['sec_id'] =$sec_id;
            endif;
            if($subject_id):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if($program_id):
                $where['sub_programes.programe_id'] = $program_id;
                $this->data['program_id']           = $program_id;
            endif;
            if($sub_program_id):
                $where['sub_programes.sub_pro_id']  = $sub_program_id;
                $this->data['sub_pro_id']           = $sub_program_id;
            endif;
        $this->data['result'] = $this->PromotionModel->getclass_alloted($where);
        endif;
        if($this->input->post('delete')):
            
            $ides       = $this->input->post('checked');
            $class_id = $this->input->post('class_id');
         if(!empty($ides)):
             
            foreach($ides as $row=>$value):
                $this->CRUDModel->deleteid('class_alloted',array('class_id'=>$value));
            endforeach;   
         endif;
         $this->session->set_flashdata('del_msg', 'Successfully Deleted');
         redirect('ClassAllotedDelete');
         endif;
        $this->data['page_header']   = 'Class Alloted Delete';
        $this->data['page_title']   = 'Class Alloted Delete| ECMS';
        $this->data['page']         = 'promotion/class_alloted_delete';
        $this->load->view('common/common',$this->data);
    }
       public function class_alloted_delete(){          
        
        $this->data['emp_id']           = "";
        $this->data['sec_id']           = "";
        $this->data['subject_id']       = "";
        $this->data['program_id']       = "";
        $this->data['sub_pro_id']       = "";
        
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
        $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
        $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('status'=>'on'));
        
        
        
        if($this->input->post()):
            $emp_id         = $this->input->post('emp_id');
            $sec_id         = $this->input->post('sec_id');
            $subject_id     = $this->input->post('subject_id');
            $program_id     = $this->input->post('program_id');
            $sub_program_id = $this->input->post('sub_program_id');
//            echo '<pre>';print_r($this->input->post());die;
            $where = "";
            if($emp_id):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if($sec_id):
                $where['sections.sec_id']   = $sec_id;
                $this->data['sec_id']       = $sec_id;
            endif;
            if($subject_id):
                $where['subject.subject_id'] = $subject_id;
                $this->data['subject_id'] =$subject_id;
            endif;
            if($program_id):
                $where['sub_programes.programe_id'] = $program_id;
                $this->data['program_id']           = $program_id;
            endif;
            if($sub_program_id):
                $where['sub_programes.sub_pro_id']  = $sub_program_id;
                $this->data['sub_pro_id']           = $sub_program_id;
            endif;
            
//            echo '<pre>';print_r($this->data);die;
        $this->data['result'] = $this->PromotionModel->getclass_alloted($where);
        endif;
        if($this->input->post('delete')):
            
            $ides       = $this->input->post('checked');
            $class_id = $this->input->post('class_id');
         if(!empty($ides)):
             
            foreach($ides as $row=>$value):
             
                $where_exm = array('exb_class_id' => $value);
                $where_cls = array('class_id' => $value);
                
                $ch_bsx = $this->CRUDModel->get_where_row('exams_bs', $where_exm);
                if(!empty($ch_bsx)):
                    $this->CRUDModel->update('exams_bs', array('exb_class_status' => 2), $where_exm);
                endif;
                
                $ch_log = $this->CRUDModel->get_where_row('class_alloted_log', $where_cls);
                if(!empty($ch_log)):
                    $this->CRUDModel->deleteid('class_alloted_log', $where_cls);
                endif;
                
                $this->CRUDModel->deleteid('class_alloted', $where_cls);
            endforeach;   
         endif;
         $this->session->set_flashdata('del_msg', 'Successfully Deleted');
         redirect('ClassAllotedDelete');
         endif;
        $this->data['page_header']   = 'Class Alloted Delete';
        $this->data['page_title']   = 'Class Alloted Delete| ECMS';
        $this->data['page']         = 'promotion/class_alloted_delete';
        $this->load->view('common/common',$this->data);
    }
   
    
}   