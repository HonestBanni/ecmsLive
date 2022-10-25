<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class SubjectAllottmentController extends AdminController {
	function __construct(){
		parent::__construct();
                $this->load->model('SubjectAllottmentModel');
                $this->load->model('AttendanceModel');
                $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
	}
        
        
        public function arts_students(){
            
            $this->data['collegeNo']        = '';
            $this->data['stdName']          = '';
            $this->data['fatherName']       = '';
            $this->data['gender_id']        = '';
            $this->data['programe_id']      = '';
            $this->data['sub_pro_id']       = '';
            $this->data['reg_no']           = ''; 
            $this->data['form_no']          = ''; 
            $this->data['batch_id']          = ''; 
          
            if($this->input->post('search')):
                
                $college_no         =  $this->input->post('college_no');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $programe_id        =  $this->input->post('programe_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $reg_no             =  $this->input->post('reg_no');
                $form_no             =  $this->input->post('form_no');
                $batch             =  $this->input->post('batch');
               
                $like = '';
                $where['student_record.s_status_id'] = '5';
                
                 
                 if(!empty($batch)):
                    $where['prospectus_batch.batch_id'] = $batch;
                    $this->data['batch'] =$batch;
                endif;
                 if(!empty($college_no)):
                    $where['college_no'] = $college_no;
                    $this->data['collegeNo'] =$college_no;
                endif;
                 if(!empty($form_no)):
                    $where['form_no'] = $form_no;
                    $this->data['form_no'] =$form_no;
                endif;
                if(!empty($student_name)):
                    $like['student_name'] = $student_name;
                    $this->data['stdName'] =$student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name'] = $father_name;
                $this->data['fatherName'] =$father_name;
                endif;
                if(!empty($reg_no)):
                    $like['board_regno'] = $reg_no;
                    $this->data['reg_no'] = $reg_no;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id'] = $gender;
                    $this->data['gender_id'] =$gender;
                endif;
                if(!empty($programe_id)):
                    $where['student_record.programe_id'] = $programe_id;
                    $this->data['programe_id']  = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                    $this->data['sub_pro_id']  = $sub_pro_id;
                endif;
                 
                $this->data['result']   = $this->SubjectAllottmentModel->art_subject_search($where,$like,'sub_programes.sub_pro_id',array(5,27)); //get user data from db 
                $this->data['count']   = count($this->data['result']);
                
//                echo '<pre>';print_r($this->data['result']);die;
           
            else:

          
            //pagination start
            $Where                      = array('student_record.s_status_id'=>'5');
            $config['base_url']         = base_url('ArtSubject');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$Where,'sub_pro_id',array(5,27)));  //echo $config['total_rows']; exit;
            $config['per_page']         = 50;
            $config["num_links"]        = 6;
            $config['uri_segment']      = 2;
            
            //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the â€œDigitï¿½? Link
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            //For PREVIOUS PAGE Setup
            $config['prev_link']        = "<i class='fa fa-angle-left'></i>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
                        
            //For NEXT PAGE Setup
            $config['next_link']        = "<i class='fa fa-angle-right'></i>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            
            //For LAST PAGE Setup
            $config['last_link']        = "<i class='fa fa-angle-double-right'></i>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            
            //For CURRENT page on which you are
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            
            
            
            $this->pagination->initialize($config);
            $page                           = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pagination_links'] = $this->pagination->create_links();
            //pagination start 
             
            $this->data['result']       = $this->SubjectAllottmentModel->art_subject_pagination($config['per_page'],$page,$Where,'sub_programes.sub_pro_id',array(5,27)); //get user data from db
            $this->data['count']        = $config['total_rows'];
             endif;
         
        
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['sub_program']  = $this->CRUDModel->dropDown_where_in('sub_programes', 'Sub Program ', 'sub_pro_id', 'name','sub_pro_id',array(5,27));
            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>1));
            $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('programe_id'=>1),array('order'=>'asc','column'=>'batch_order'));
            
            $this->data['page_header']  = 'Inter Subject Allottment (Arts)';
            $this->data['page_title']   = 'Inter Subject Allottment (Arts)| ECMS';
            $this->data['page']         = 'admission/Subject_Allottment/Forms/arts_students';
            $this->load->view('common/common',$this->data);
             
        }
        
        public function year_head_subjects(){

        $this->data['collegeNo']        = '';
        $this->data['stdName']          = '';
        $this->data['fatherName']       = '';
        $this->data['gender_id']        = '';
        $this->data['programe_id']      = '';
        $this->data['sub_pro_id']       = '';
        $this->data['section_id']       = ''; 
        $this->data['count']            = '0'; 
        $this->data['sub_program']      = $this->CRUDModel->dropDown_where_in('sub_programes', 'Sub Program ', 'sub_pro_id', 'name','sub_pro_id',array(4,5,26,27));
        $where_section                  = array('status'=>'On');
        $this->data['section']          = $this->CRUDModel->dropDown_where_in('sections', 'Sections', 'sec_id', 'name','sub_pro_id',array(4,5,26,27),$where_section);


    if($this->input->post('save_record')):

 
        $checked        = $this->input->post('checked');
        $sec_id         = $this->input->post('session_id');
        $formCode       = $this->input->post('formCode');

        $userIndo =$this->getUser();
        $message = '';
        foreach($checked as $strId=>$key):
            $subjects = $this->CRUDModel->get_where_result('student_subject_alloted_demo',array('form_code'=>$formCode));
                if($subjects):
                    foreach($subjects as $row):
                        $subject_id = $row->subject_id;

                    $where = array(
                        'student_record.student_id' => $key,
                        'subject.subject_id'        => $subject_id,

                    );
                         $this->db->select('student_name,college_no,subject.title');
                         $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id');
                         $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
               $id =     $this->db->get_where('student_subject_alloted',$where)->row();

                   if($id):
                         $message[]= '<strong>Warning Record not Update..! </strong> <a href="#" class="alert-link"> Student '.$id->student_name.'('.$id->college_no.') already exist in : '.$id->title.' Subject  </a>';   
    //                    $this->session->set_flashdata('subject_msg', '<strong>Warning</strong> <a href="#" class="alert-link"> Subject Already Exist.</a>');

                    else:
                     
                                $data = array(
                        'student_id'    =>$key,
                        'subject_id'    =>$subject_id,
                        'section_id'    =>$sec_id,
                        'user_id'       =>$userIndo['user_id'],
                        'timestamp'       =>date('Y-m-d H:i:s')

                        );
                    $this->CRUDModel->insert('student_subject_alloted',$data);
                   endif; 
                    endforeach;
                endif;
        endforeach;
        $this->CRUDModel->deleteid('student_subject_alloted_demo',array('form_code'=>$formCode));
        $this->session->set_flashdata('subject_msg',$message); 
        redirect('ScienceSubject');
//            redirect('Admin/year_head_subjects');
    endif;
    if($this->input->post('search')):

        $college_no     = $this->input->post('college_no');
        $student_name   = $this->input->post('student_name');
        $father_name    = $this->input->post('father_name');
        $sub_proId      = $this->input->post('sub_pro_id');
        $session_id     = $this->input->post('session_id');

        $where['student_record.s_status_id']    = '5';
        $where['sections.status']               = 'On';
        $like = '';

        if($college_no):
          $where['student_record.college_no']   = $college_no;
            $this->data['collegeNo']            = $college_no;
        endif;

        if($sub_proId):
          $where['student_record.sub_pro_id']   = $sub_proId;
        $this->data['sub_pro_id']               = $sub_proId;
        endif;

        if($session_id):
          $where['sec_id']                      = $session_id;   
          $this->data['section_id']             = $session_id;   
        endif;

        if($student_name):
          $like['student_name']                 = $student_name;
          $this->data['stdName']                = $student_name;
        endif;

        if($father_name):
            $like['father_name']        = $father_name;
            $this->data['fatherName']   = $father_name;
        endif;
//            echo '<pre>';print_r($where);die;
         $this->data['searchResult'] = $this->SubjectAllottmentModel->science_subject_search($where,$like,'sub_programes.sub_pro_id',array(4,5,26,27));
         $this->data['count']        =count($this->SubjectAllottmentModel->science_subject_search($where,$like,'sub_programes.sub_pro_id',array(4,5,26,27)));
//             $this->data['searchResult'] = $this->AttendanceModel->get_year_head_result($where,$like);

//              echo '<pre>';print_r($this->data['searchResult']);die;

//             echo '<pre>';print_r($this->data['section'] );die;
    endif;


//        $wheresPrg                      = array('status'=>'yes','programe_id'=>1);
//        $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name',$wheresPrg);  
//        $wheresSec                      = array('status'=>'On','program_id'=>1);
//        $this->data['sections']         = $this->CRUDModel->dropDown('sections', 'Sections', 'sec_id', 'name',$wheresSec);  
    $wheresSub                      = array('subject.programe_id'=>1);
    $this->data['subject']          = $this->AttendanceModel->dropDown_yearHead('subject', 'subject', 'subject_id', 'title',$wheresSub);  
    $this->data['page_header']       = 'Year Head Subject Allotments';
    $this->data['page_title']       = 'Year Head Subject Allotments | ECMS';
    $this->data['page']             =  'admission/Subject_Allottment/Forms/science_students';
    $this->load->view('common/common',$this->data); 
}
public function group_alloted_demo_js(){

        $subject_id = $this->input->post('subject_id');
        $form_code  = $this->input->post('form_code');
        $sub_proId  = $this->input->post('sub_proId');

        $check_sub_pro_subjects         = $this->db->get_where('subject',array('subject_id'=>$subject_id,'sub_pro_id'=>$sub_proId))->row();

        $check_show_subject_details =   $this->db->get_where('sub_programes',array('sub_programes.sub_pro_id'=>$sub_proId))->row();
//             echo '<pre>';print_r($check_show_subject_details);die;
        if(empty($check_sub_pro_subjects)):

            echo '<div class="alert alert-danger alert-dismissable center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Please Select Correct Sub Program : <strong>'.$check_show_subject_details->name.'</strong> Subjects  
                </div>';


        else:
                                         $this->db->join('subject','subject.subject_id=student_subject_alloted_demo.subject_id');
                                         $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
           $check_dublicate_subjects =   $this->db->get_where('student_subject_alloted_demo',array('subject.subject_id'=>$subject_id,'form_code'=> $form_code))->row();  
            if($check_dublicate_subjects):
                  echo '<div class="alert alert-danger alert-dismissable center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Subject : <strong>'.$check_dublicate_subjects->title.'</strong> for Sub Program : <strong>'.$check_dublicate_subjects->name.'</strong> already added to following list. 
                </div>';
                else:
                 $data = array(
                'form_code'     => $form_code,
                'subject_id'    => $subject_id,
                'create_by'     => $this->userInfo->user_id,
                'create_time'       => date('Y-m-d H:i:s')
            );

            $this->CRUDModel->insert('student_subject_alloted_demo',$data);
            endif;

        endif;
                 $this->db->join('subject','subject.subject_id=student_subject_alloted_demo.subject_id');
                 $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
       $result = $this->db->get_where('student_subject_alloted_demo',array('form_code'=> $form_code))->result(); 

       if($result):
           echo '
                            <table class="table table-hover table-boxed" id="table">
                               <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Subject Name</th>
                                        <th>Sub Program</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>  
                                <tbody>';
            $sn = '';
            foreach($result as $row):
                $sn++;
             echo '<tr>
                        <td>'.$sn.'</td>
                       <td>'.$row->title.'</td>
                       <td>'.$row->name.'</td>
                       <td><a href="javascript:void(0)"  id="'.$row->id.'" class="btn btn-danger btn-xs deleteAllottedSubj"><span class="fa fa-trash text-danger"></span> Delete </a></td>
                    </tr>';
           endforeach;

                                echo '</tbody>
                            </table> 
                        </div>
                    </div>';


    ?>
    <script>
            jQuery(document).ready(function(){
                jQuery('.deleteAllottedSubj').on('click',function(){


                    var delete_id = this.id;
                    var form_code = jQuery('#formCode').val();

                     jQuery.ajax({
                        type : 'post',
                        url  : 'GroupAllotedDemoDelete_js',
                        data :   {'delete_id':delete_id,'form_code':form_code},
                        success: function(result){

                            jQuery('#alloted_subject_show').html(result);

                        }
                    });

                });

                 });
    </script>            
        <?php
     endif;  
    }
public function group_alloted_demo_subject_delete_js(){

        $delete_id = $this->input->post('delete_id');

        $this->CRUDModel->deleteid('student_subject_alloted_demo',array('id'=>$delete_id));
        $form_code  = $this->input->post('form_code');

                 $this->db->join('subject','subject.subject_id=student_subject_alloted_demo.subject_id');
                 $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
       $result = $this->db->get_where('student_subject_alloted_demo',array('form_code'=> $form_code))->result(); 

       if($result):
           echo '
                            <table class="table table-hover table-boxed" id="table">
                               <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Subject Name</th>
                                        <th>Sub Program</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>  
                                <tbody>';
            $sn = '';
            foreach($result as $row):
                $sn++;
             echo '<tr>
                        <td>'.$sn.'</td>
                       <td>'.$row->title.'</td>
                       <td>'.$row->name.'</td>
                       <td><a href="javascript:void(0)"  id="'.$row->id.'" class="btn btn-danger btn-xs deleteAllottedSubj"><span class="fa fa-trash text-danger"></span> Delete </a></td>
                    </tr>';
           endforeach;

                                echo '</tbody>
                            </table> 
                        </div>
                    </div>';
     ?>
    <script>
            jQuery(document).ready(function(){
                jQuery('.deleteAllottedSubj').on('click',function(){


                    var delete_id = this.id;
                    var form_code = jQuery('#formCode').val();

                     jQuery.ajax({
                        type : 'post',
                        url  : 'GroupAllotedDemoDelete_js',
                        data :   {'delete_id':delete_id,'form_code':form_code},
                        success: function(result){

                            jQuery('#alloted_subject_show').html(result);

                        }
                    });

                });

                 });
    </script>            
        <?php
     endif;  
    }
         
    public function arts_subjects_shifting(){
        
                    $this->db->select('
                        student_record.student_id,
                        student_record.student_name,
                        student_record.college_no,
                        student_group_allotment.section_id,
                        sections.name as section_name,
                    ');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->data['get_std'] = $this->db->get_where('student_record', array('student_record.sub_pro_id' => 5, 's_status_id'=>5))->result();
        
        $this->data['page_header']  = 'Arts Subject Allotment for New Students Only';
        $this->data['page_title']   = 'Arts Subject Allotment for New Students Only| ECMS';
        $this->data['page']         = 'admission/Subject_Allottment/Forms/arts_subject_shifting';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function arts_subjects_allotment_new_students(){
                    $this->db->select('
                        student_record.student_id,
                        student_group_allotment.section_id,
                    ');
                    $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
        $get_std = $this->db->get_where('student_group_allotment', array('sub_pro_id' => 5, 's_status_id'=>5))->result();
//        echo '<pre>'; prin_r(); die;
        $serial = '';
        if(!empty($get_std)):
            foreach($get_std as $srow):
                $check_subj = $this->CRUDModel->get_where_row('student_subject_alloted', array('student_id'=> $srow->student_id ));
                if(empty($check_subj)):
                    $get_new = $this->CRUDModel->get_where_result('new_student_subjects', array('student_id' => $srow->student_id));
                    foreach($get_new as $gnr):
                        $ins_arr = array(
                            'student_id' => $srow->student_id,
                            'subject_id' => $gnr->subject_id,
                            'section_id' => $srow->section_id,
                        );
                        $this->CRUDModel->insert('student_subject_alloted', $ins_arr);
                    endforeach;
                endif;
            endforeach;
        endif;
        redirect('ArtSubjectShift');
    }
    
    public function arts_students_1st(){
            
            $this->data['collegeNo']        = '';
            $this->data['stdName']          = '';
            $this->data['fatherName']       = '';
            $this->data['gender_id']        = '';
            $this->data['programe_id']      = '';
            $this->data['sub_pro_id']       = '';
            $this->data['reg_no']           = ''; 
            $this->data['form_no']          = ''; 
            $this->data['batch_id']          = ''; 
          
            if($this->input->post('search')):
                
                $college_no     =  $this->input->post('college_no');
                $student_name   =  $this->input->post('student_name');
                $father_name    =  $this->input->post('father_name');
                $gender         =  $this->input->post('gender');
                $reg_no         =  $this->input->post('reg_no');
                $form_no        =  $this->input->post('form_no');
               
                $like = array();
                $where['student_record.s_status_id']    = '5';
                $where['student_record.sub_pro_id']     = '5';
                
                 if(!empty($college_no)):
                    $where['college_no'] = $college_no;
                    $this->data['collegeNo'] =$college_no;
                endif;
                 if(!empty($form_no)):
                    $where['form_no'] = $form_no;
                    $this->data['form_no'] =$form_no;
                endif;
                if(!empty($student_name)):
                    $like['student_name'] = $student_name;
                    $this->data['stdName'] =$student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name'] = $father_name;
                $this->data['fatherName'] =$father_name;
                endif;
                if(!empty($reg_no)):
                    $like['board_regno'] = $reg_no;
                    $this->data['reg_no'] = $reg_no;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id'] = $gender;
                    $this->data['gender_id'] =$gender;
                endif;
                 
                $this->data['result']   = $this->SubjectAllottmentModel->art_subject_search_yr($where,$like); //get user data from db 
                $this->data['count']    = count($this->data['result']);
                
//                echo '<pre>';print_r($this->data['result']);die;
           
            else:
                
                $where['student_record.s_status_id']    = '5';
                $where['student_record.sub_pro_id']     = '5';
                
                $this->data['result']   = $this->SubjectAllottmentModel->art_subject_search_yr($where); //get user data from db 
                $this->data['count']    = count($this->data['result']);
          
             endif;
         
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            
            $this->data['page_header']  = 'Inter Subject Allottment (Arts)';
            $this->data['page_title']   = 'Inter Subject Allottment (Arts)| ECMS';
            $this->data['page']         = 'admission/Subject_Allottment/Forms/arts_students_1st';
            $this->load->view('common/common',$this->data);
             
        }
    
        public function assign_arts_subjects_1st(){
            $id                 = $this->uri->segment(2);
            $sub_pro_id         = $this->uri->segment(3);
            $where              = array('student_id'=>$id);
            $subpro_where       = array('sub_pro_id'=>$sub_pro_id);
            
            $this->data['result']           = $this->CRUDModel->get_where_row('student_record', $where);
            $this->data['section']          = $this->CRUDModel->get_where_row('student_group_allotment', $where);
            $this->data['selectsubjects']   = $this->CRUDModel->get_where_result('student_subject_alloted', $where);
            $this->data['subjects']         = $this->CRUDModel->get_where_result('subject', $subpro_where);

//            echo '<pre>'; print_r($this->data['subjects']); die;
            
            $this->data['page_title']   = 'Student Assign Subjects  | ECMS';
           $this->data['page']          = 'admission/Subject_Allottment/Forms/assign_arts_subjects_1st';
           $this->load->view('common/common',$this->data);
        }
	
    }
