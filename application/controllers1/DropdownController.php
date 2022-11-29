<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
 

class DropdownController extends AdminController {

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
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
      
          
    public function __construct() {
             parent::__construct();
             $this->userInfo = json_decode(json_encode($this->check_login_status()), FALSE);
 
          }
          
          //Hostel Student Auto compelete 
           public function hostel_student(){
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->DropdownModel->hostel_student(array('hostel_status_id'=>1));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->student_name.' S/D '.$row_set->father_name.' ,Form# '.$row_set->form_no.' ', 
                            'code'     =>$row_set->hostel_id, 
                            'value'     =>$row_set->student_name, 
                              
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 20);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->hostel_student(array('hostel_status_id'=>1),$like);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                          'label'     =>$row_set->student_name.' S/D '.$row_set->father_name.' ,Form# '.$row_set->form_no.' ', 
                            'code'     =>$row_set->hostel_id, 
                            'value'     =>$row_set->student_name,
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                   
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 20);
            echo  json_encode($matches); 
            }
        }
    public function hostel_students(){
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->DropdownModel->hostel_students(array('hostel_status_id'=>1,'new_admission_flag'=>1));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->student_name.' S/D '.$row_set->father_name.' ,Form# '.$row_set->form_no.' ', 
                            'code'     =>$row_set->hostel_id, 
                            'value'     =>$row_set->student_name, 
                              
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 20);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->hostel_students(array('hostel_status_id'=>1,'new_admission_flag'=>1),$like);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                          'label'     =>$row_set->student_name.' S/D '.$row_set->father_name.' ,Form# '.$row_set->form_no.' ', 
                            'code'     =>$row_set->hostel_id, 
                            'value'     =>$row_set->student_name,
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                   
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 20);
            echo  json_encode($matches); 
            }
        }
        
      
        
    public function getBatch(){
        $programId = $this->input->post('programId');
        $where = array('programe_id'=>$programId);
        $getbatchs = $this->CRUDModel->get_where_result('prospectus_batch',$where);
         echo '<option value="">Select</option>';
        foreach($getbatchs as $secRow):
               echo '<option value="'.$secRow->batch_id.'">'.$secRow->batch_name.'</option>';
        endforeach;
    }
    
       public function getSubProgram(){
      $proId = $this->input->post('programId');
      
      $result = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>$proId));
      echo '<option value="">Select</option>';
      foreach($result as $subRow):
          echo '<option value="'.$subRow->sub_pro_id.'">'.$subRow->name.'</option>';
      endforeach;
    
    }
public function getSection(){
      $sub_pro_id = $this->input->post('sub_pro_id');
      
      $result = $this->CRUDModel->get_where_result('sections',array('sub_pro_id'=>$sub_pro_id,'status'=>'On'));
      echo '<option value="">Select</option>';
      foreach($result as $subRow):
          echo '<option value="'.$subRow->sec_id.'">'.$subRow->name.'</option>';
      endforeach;
    
    }
    public function getPaymentCategory(){
        $sectionId = $this->input->post('sub_program_id');
        $where = array('sub_programes.sub_pro_id'=>$sectionId);
        $getResult = $this->DropdownModel->get_Payment_Category($where);
       echo '<option value="">Select</option>';
        foreach($getResult as $secRow):
               echo '<option value="'.$secRow->pc_id.'">'.$secRow->title.'('.$secRow->name.' '.$secRow->batch_name.')</option>';
        endforeach;
    }
          //Hostel Student Auto compelete
    public function autoComplete_student_info(){
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->DropdownModel->add_extra_heads(array(5,9,7,8,12,13));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        
                        if($row_set->s_status_id != 18):
                             $labels[]       = array( 

                                    'label'     =>$row_set->college_no.','.$row_set->student_name.' ,Form# '.$row_set->form_no.' ,'.$row_set->name.'', 
                                    'code'      =>$row_set->student_id, 
                                    'value'     =>$row_set->college_no, 
                                    'name'      =>$row_set->student_name, 
                                    'f_name'    =>$row_set->father_name, 

                            );
                        endif;
                        
                       
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['label']     = $label['label']; 
                    $label['code']      = $label['code'];
                    $label['value']     = $label['value'];
                    $label['name']      = $label['name'];
                    $label['f_name']    = $label['f_name'];
                    
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 20);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->add_extra_heads(array(5,9,7,8,12,13),$like);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                         if($row_set->s_status_id != 18):
                             $labels[]           = array( 
                           'label'     =>$row_set->college_no.','.$row_set->student_name.' ,Form# '.$row_set->form_no.' ,'.$row_set->name.'', 
                            'code'      =>$row_set->student_id, 
                            'value'     =>$row_set->college_no, 
                            'name'      =>$row_set->student_name, 
                            'f_name'    =>$row_set->father_name,
                    );
                         endif;
                    
             }
            $matches                = array();
            foreach($labels as $label){
                    $label['label']     = $label['label']; 
                    $label['code']      = $label['code'];
                    $label['value']     = $label['value'];
                    $label['name']      = $label['name'];
                    $label['f_name']    = $label['f_name']; 
                   
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 20);
            echo  json_encode($matches); 
            }
        }
//    public function autoComplete_student_info(){
//            $term = trim(strip_tags($this->input->get('term')));
//            if( $term == ''){
//                $like           = $term;
//                $result_set     = $this->DropdownModel->add_extra_heads(array('s_status_id'=>5));
//                $labels         = array();
//                    foreach ($result_set as $row_set) {
//                        $labels[]       = array( 
//                            
//                            'label'     =>$row_set->college_no.','.$row_set->student_name.' ,Form# '.$row_set->form_no.' ', 
//                            'code'      =>$row_set->student_id, 
//                            'value'     =>$row_set->college_no, 
//                            'name'      =>$row_set->student_name, 
//                            'f_name'    =>$row_set->father_name, 
//                              
//                    );
//                }
//            $matches    = array();
//                foreach($labels as $label){
//                    $label['label']     = $label['label']; 
//                    $label['code']      = $label['code'];
//                    $label['value']     = $label['value'];
//                    $label['name']      = $label['name'];
//                    $label['f_name']    = $label['f_name'];
//                    
//                    
//                    $matches[]          = $label;
//            }
//            $matches                    = array_slice($matches, 0, 10);
//                echo  json_encode($matches); 
//            }else if($term != ''){
//                $like                   = $term;
//                $result_set             = $this->DropdownModel->add_extra_heads(array('s_status_id'=>5),$like);
//                $labels                 = array();
//                    foreach ($result_set as $row_set) {
//                    $labels[]           = array( 
//                           'label'     =>$row_set->college_no.','.$row_set->student_name.' ,Form# '.$row_set->form_no.' ', 
//                            'code'      =>$row_set->student_id, 
//                            'value'     =>$row_set->college_no, 
//                            'name'      =>$row_set->student_name, 
//                            'f_name'    =>$row_set->father_name,
//                    );
//             }
//            $matches                = array();
//            foreach($labels as $label){
//                    $label['label']     = $label['label']; 
//                    $label['code']      = $label['code'];
//                    $label['value']     = $label['value'];
//                    $label['name']      = $label['name'];
//                    $label['f_name']    = $label['f_name']; 
//                   
//                    $matches[]          = $label;
//            }
//                $matches                = array_slice($matches, 0, 10);
//            echo  json_encode($matches); 
//            }
//        }
    
        
        
 
        
        public function employee_name_with_designation_auto(){
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''):
                $like           = $term;
                $result_set     = $this->DropdownModel->employee_name_with_designation_auto();
                $labels         = array();
                    foreach ($result_set as $row_set):
                        $labels[]       = array( 
                            'value'         => $row_set->emp_name,
                            'label'         => $row_set->emp_name,
                            'id'            => $row_set->emp_id
                    );
                    endforeach;
                    $matches= array_slice($labels, 0,20);
                    echo  json_encode($matches); 
            else:
               
                $like                   = $term;
                $result_set             = $this->DropdownModel->employee_name_with_designation_auto($like);
                $labels                 = array();
                    foreach ($result_set as $row_set):
                    $labels[]           = array( 
                            'value'         => $row_set->emp_name,
                            'label'         => $row_set->emp_name,
                            'id'            => $row_set->emp_id
                    );
                    endforeach;
                $matches    = array_slice($labels, 0, 20);
                echo  json_encode($matches); 
            endif;
        }
         public function program_info_auto(){
            $term = trim(strip_tags($this->input->get('term')));
            
            if( $term == ''):
                $like           = $term;
                $result_set     = $this->DropdownModel->program_info_auto();
                $labels         = array();
                    foreach ($result_set as $row_set):
                        $labels[]       = array( 
                            'value'         => $row_set->programe_name,
                            'label'         => $row_set->programe_name,
                            'id'            => $row_set->programe_id
                    );
                    endforeach;
                    $matches= array_slice($labels, 0, 20);
                    echo  json_encode($matches); 
            else:
               
                $like                   = $term;
                $result_set             = $this->DropdownModel->program_info_auto($like);
                $labels                 = array();
                    foreach ($result_set as $row_set):
                    $labels[]           = array( 
                            'value'         => $row_set->programe_name,
                            'label'         => $row_set->programe_name,
                            'id'            => $row_set->programe_id
                    );
                    endforeach;
                $matches    = array_slice($labels, 0, 20);
                echo  json_encode($matches); 
            endif;
        }
    public function sub_prgoram_auto(){
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''):
                $like           = $term;
                $result_set     = $this->DropdownModel->sub_prgoram_auto();
                $labels         = array();
                    foreach ($result_set as $row_set):
                        $labels[]       = array( 
                            'value'         => $row_set->name,
                            'label'         => $row_set->name,
                            'id'            => $row_set->sub_pro_id
                    );
                    endforeach;
                    $matches= array_slice($labels, 0, 20);
                    echo  json_encode($matches); 
            else:
               
                $like                   = $term;
                $result_set             = $this->DropdownModel->sub_prgoram_auto($like);
                $labels                 = array();
                    foreach ($result_set as $row_set):
                    $labels[]           = array( 
                            'value'         => $row_set->name,
                            'label'         => $row_set->name,
                            'id'            => $row_set->sub_pro_id
                    );
                    endforeach;
                $matches    = array_slice($labels, 0, 20);
                echo  json_encode($matches); 
            endif;
        }
        
    public function get_invt_rooms(){
            $building_block     =  $this->input->post('building_block'); 
            $order['column']    = 'rm_name';
            $order['order']     = 'desc';
            $result             =  $this->CRUDModel->get_where_result_order('invt_rooms',array('rm_bbId'=>$building_block,'rm_status'=>'1'),$order);
          foreach($result as $subRow):
              echo '<option value="'.$subRow->rm_id.'">'.$subRow->rm_name.'</option>';
          endforeach;
      }
    public function employee_name_with_designation_and_subjects_auto(){
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''):
                $like           = $term;
                $result_set     = $this->DropdownModel->employee_name_with_designation_and_subjects_auto();
                $labels         = array();
                    foreach ($result_set as $row_set):
                        $labels[]       = array( 
                            'value'         => $row_set->emp_name,
                            'label'         => $row_set->emp_name.' ( '.$row_set->designation.','.$row_set->subject_title.')',
                            'id'            => $row_set->emp_id
                    );
                    endforeach;
                    $matches= array_slice($labels, 0, 20);
                    echo  json_encode($matches); 
            else:
               
                $like                   = $term;
                $result_set             = $this->DropdownModel->employee_name_with_designation_and_subjects_auto($like);
                $labels                 = array();
                    foreach ($result_set as $row_set):
                    $labels[]           = array( 
                            'value'         => $row_set->emp_name,
                            'label'         => $row_set->emp_name.' ( '.$row_set->designation.','.$row_set->subject_title.')',
                            'id'            => $row_set->emp_id
                    );
                    endforeach;
                $matches    = array_slice($labels, 0, 20);
                echo  json_encode($matches); 
            endif;
        }
      
    public function auto_transfer_to_student(){
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->DropdownModel->student_transfer_to_record();
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            
                            'label'         => $row_set->challan_id.', College #'.$row_set->college_no.', '.$row_set->student_name.' ,'.$row_set->studentStatus, 
                            'code'          => $row_set->student_id, 
                            'value'         => $row_set->challan_id, 
                            'college_no'    => $row_set->college_no, 
                            'student_name'  => $row_set->student_name, 
                            'father_name'   => $row_set->father_name,
                            'studentStatus' => $row_set->studentStatus,
                            'program_name'  => $row_set->programe_name,
                            'sub_proram'    => $row_set->sub_proram,
                            'batch_name'    => $row_set->batch_name,
                              
                    );
                }
             
            $matches                    = array_slice($labels, 0, 20);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->student_transfer_to_record($like);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                           'label'         => $row_set->challan_id.', College #'.$row_set->college_no.', '.$row_set->student_name.' ,'.$row_set->studentStatus, 
                            'code'          => $row_set->student_id, 
                            'value'         => $row_set->challan_id, 
                            'college_no'    => $row_set->college_no, 
                            'student_name'  => $row_set->student_name, 
                            'father_name'   => $row_set->father_name,
                            'studentStatus' => $row_set->studentStatus,
                            'program_name'  => $row_set->programe_name,
                            'sub_proram'    => $row_set->sub_proram,
                            'batch_name'    => $row_set->batch_name,
                    );
             }
             
                $matches                = array_slice($labels, 0, 20);
            echo  json_encode($matches); 
            }
        }
        
    public function getCumSubProgram(){
        $proId = $this->input->post('programId');
        $result = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>$proId));
        echo '<option value="">Sub Program</option>';
        foreach($result as $subRow):
            echo '<option value="'.$subRow->sub_pro_id.'">'.$subRow->name.'</option>';
        endforeach;
    }
        
    public function getCumSections(){
        $sectionId      = $this->input->post('sub_program_id');
        $programId      = $this->input->post('programId');
        $program_info   = $this->db->get_where('programes_info',array('programe_id'=>$programId))->row();
        echo '<option value="">Select Section</option>';
        if(!empty($program_info)):
            $where = array('sub_pro_id'=>$sectionId);
            $getSections = $this->DropdownModel->getSections($where);
            foreach($getSections as $secRow):
                   echo '<option value="'.$secRow->sec_id.'">'.$secRow->sectionName.', '.$secRow->batch_name.'</option>';
            endforeach;
        endif;
    }
    
    public function getCumBatch(){
        $programId = $this->input->post('programId');
        $where = array('programe_id'=>$programId,'status'=>'on');
        $this->db->order_by('batch_order','asc');   
        $getbatchs = $this->db->get_where('prospectus_batch',$where)->result();
        echo '<option value="">Select Batch</option>';
        foreach($getbatchs as $secRow):
               echo '<option value="'.$secRow->batch_id.'">'.$secRow->batch_name.'</option>';
        endforeach;
    }
        
    
    public function sub_programs_dropdown(){
        $proId  = $this->input->post('programId');
        $result = $this->CRUDModel->get_where_result('sub_programes',array('programe_id'=>$proId));
        echo '<option value="">Sub Program</option>';
        if($result):
            foreach($result as $subRow):
                echo '<option value="'.$subRow->sub_pro_id.'">'.$subRow->name.'</option>';
            endforeach;
        endif;
    } 
           public function batch_dropdown(){
        $programId = $this->input->post('programId');
        $where = array('programe_id'=>$programId,'status'=>'on');
                     $this->db->order_by('batch_order','asc');   
        $getbatchs = $this->db->get_where('prospectus_batch',$where)->result();
         echo '<option value="">Select Batch</option>';
        foreach($getbatchs as $secRow):
               echo '<option value="'.$secRow->batch_id.'">'.$secRow->batch_name.'</option>';
        endforeach;
    }
    public function sections_dropdown(){
        $sectionId      = $this->input->post('sub_program_id');
        $programId      = $this->input->post('programId');
        $program_info   = $this->db->get_where('programes_info',array('programe_id'=>$programId))->row();
        
       echo '<option value="">Select Section</option>';
     if(!empty($program_info)):
         
      
    if($program_info==1):
           $where = array('sub_pro_id'=>$sectionId,'sections.status'=>'On');
        $getSections = $this->db->get_where('sections',$where)->result();
        foreach($getSections as $secRow):
               echo '<option value="'.$secRow->sec_id.'">'.$secRow->name.'</option>';
        endforeach;
     endif;
      endif;
    } 
 public function passing_year(){
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''):
                $like           = $term;
                                  $this->db->order_by('yr_num','asc');  
                $result_set     = $this->db->get_where('year')->result();
                $labels         = array();
                    foreach ($result_set as $row_set):
                        $labels[]       = array( 
                            'value'         => $row_set->yr_num,
                            'label'         => $row_set->yr_num,
                            'id'            => $row_set->yr_num
                    );
                    endforeach;
                    $matches= array_slice($labels, 0, 20);
                    echo  json_encode($matches); 
            else:
               
                $like                   = $term;
                                          $this->db->order_by('yr_num','asc');    
                $result_set             = $this->db->like('yr_num',$like)->get('year')->result();
                $labels                 = array();
                    foreach ($result_set as $row_set):
                    $labels[]           = array( 
                            'value'         => $row_set->yr_num,
                            'label'         => $row_set->yr_num,
                            'id'            => $row_set->yr_num
                    );
                    endforeach;
                $matches    = array_slice($labels, 0, 20);
                echo  json_encode($matches); 
            endif;
        }    
       public function auto_emp_bs_programs(){ 
            
            $term = trim(strip_tags($this->input->get('term')));
            if(!empty($term)):
                $where = array(
                    'degree_type_id'    => 2,//1 = Fa/Fsc,2 = BS, 3 =Languages
                    'cat_id'            => 1,
                    'emp_status_id'     => 1
                );
                  $result_set             = $this->DropdownModel->bs_subject_alloted_teachers($where,$term);
            
                $labels                 = array();
                        foreach ($result_set as $row_set) {
                        $labels[]           = array( 
                            'label'     => $row_set->emp_name, 
                            'code'      => $row_set->emp_name, 
                            'value'     => $row_set->emp_name,
                            'emp_id'     => $row_set->emp_id,
                        );
                 }
                $matches                = array();
                foreach($labels as $label){
                         $label['value']    = $label['value'];
                        $label['code']      = $label['code'];
                        $label['label']     = $label['label']; 

                        $matches[]          = $label;
                }
                    $matches                = array_slice($matches, 0, 20);
                echo  json_encode($matches);  
            endif;
         
            
             
    }
    public function auto_sec_bs_programs(){ 
            
            $term = trim(strip_tags($this->input->get('term')));
            if(!empty($term)):
                $where = array(
                    'degree_type_id'    => 2,//1 = Fa/Fsc,2 = BS, 3 =Languages
                    'sections.status'   => 'On',
                    
                );
                  $result_set             = $this->DropdownModel->bs_alloted_sections($where,$term);
            
                $labels                 = array();
                        foreach ($result_set as $row_set) {
                        $labels[]           = array( 
                            'label'     => $row_set->name, 
                            'code'      => $row_set->name, 
                            'value'     => $row_set->name,
                            'sec_id'     => $row_set->sec_id,
                        );
                 }
                $matches                = array();
                foreach($labels as $label){
                         $label['value']    = $label['value'];
                        $label['code']      = $label['code'];
                        $label['label']     = $label['label']; 

                        $matches[]          = $label;
                }
                    $matches                = array_slice($matches, 0, 20);
                echo  json_encode($matches);  
            endif;
    }
    public function auto_subj_bs_programs(){ 
            
            $term = trim(strip_tags($this->input->get('term')));
            if(!empty($term)):
                $where = array(
                    'degree_type_id'    => 2,//1 = Fa/Fsc,2 = BS, 3 =Languages
                );
                  $result_set             = $this->DropdownModel->bs_alloted_subjects($where,$term);
            
                $labels                 = array();
                        foreach ($result_set as $row_set) {
                        $labels[]           = array( 
                            'label'     => $row_set->title.' ( '.$row_set->name.' ) ', 
                            'code'      => $row_set->title, 
                            'value'     => $row_set->title,
                            'sub_id'     => $row_set->subject_id,
                        );
                 }
                $matches                = array();
                foreach($labels as $label){
                         $label['value']    = $label['value'];
                        $label['code']      = $label['code'];
                        $label['label']     = $label['label']; 

                        $matches[]          = $label;
                }
                    $matches                = array_slice($matches, 0, 20);
                echo  json_encode($matches);  
            endif;
    } 
   
    
     public function sec_bs_exame_history(){
            $term = trim(strip_tags($this->input->get('term')));
            $userId = $this->userInfo->user_id;
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->DropdownModel->get_sec_bs_exame_history($userId);
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     => $row_set->name, 
                            'code'      => $row_set->name, 
                            'id'     => $row_set->sec_id, 
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['sec_id']     = $label['id'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 20);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->get_sec_bs_exame_history($userId,array('name'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                        'label'     => $row_set->name, 
                        'code'      => $row_set->name, 
                        'id'        => $row_set->sec_id, 
//                        'value'     => $row_set->sec_id, 
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['sec_id']    = $label['id'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                   $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 20);
            echo  json_encode($matches); 
            }
        }
     public function subj_bs_exame_history(){
            $term = trim(strip_tags($this->input->get('term')));
            $userId = $this->userInfo->user_id;
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->DropdownModel->get_subj_bs_exame_history($userId);
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'code'      => $row_set->title.'('.$row_set->name.')',
                            'label'     => $row_set->title.'('.$row_set->name.')',
                            'id'        => $row_set->subject_id,
                            'flag'      => $row_set->flag
                            
                            
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['subject_id']    = $label['id'];
                    $label['code']          = $label['code'];
                    $label['label']         = $label['label']; 
                    $matches[]              = $label;
            }
            $matches                    = array_slice($matches, 0, 20);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->get_sec_bs_exame_history($userId,array('subject.title'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array(
                        'code'      => $row_set->title.'('.$row_set->name.')',
                        'label'     => $row_set->title.'('.$row_set->name.')',
                        'id'        => $row_set->subject_id,
                        'flag'      => $row_set->flag
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['subject_id']    = $label['id'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                   $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 20);
            echo  json_encode($matches); 
            }
        }
     public function auto_sub()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->AttendanceModel->getsub('subject');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->title.'('.$row_set->sub_program.')',
                    'label'=>$row_set->title.'('.$row_set->sub_program.')',
                    'id'=>$row_set->subject_id,
                    'flag'=>$row_set->flag
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['subject_id']  = $makkah_hotel['id'];
            $makkah_hotel['flag']  = $makkah_hotel['flag'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 30);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('title'=>$term);
            
            $result_set             = $this->AttendanceModel->getsub('subject',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->title.'('.$row_set->sub_program.')',
                    'label'=>$row_set->title.'('.$row_set->sub_program.')',
                    'id'=>$row_set->subject_id,
                    'flag'=>$row_set->flag
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['subject_id']  = $makkah_hotel['id'];
            $makkah_hotel['flag']  = $makkah_hotel['flag'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 30);
            echo  json_encode($matches); 
            }
        }
     public function std_sec_allotment_alevel()
     { 
        $term = $this->input->get('term');
            if( $term == ''){   
            $result_set = $this->DropdownModel->std_sec_allotment_alevel('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
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
            $like   = $term;
            $result_set = $this->DropdownModel->std_sec_allotment_alevel('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
                    );
            }
            $matches = array();
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
    
     public function group_allotment_inter()
     { 
        $term = $this->input->get('term');
            if( $term == ''){   
            $result_set = $this->DropdownModel->group_allotment_inter();
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
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
            $like   = $term;
            $result_set = $this->DropdownModel->group_allotment_inter($like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
                    );
            }
            $matches = array();
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
    
    
     public function hr_contract_type(){
        
        $where = array('hr_category_fk'=>$this->input->post('hr_category'));
        $Query = $this->CRUDModel->get_where_result('hr_emp_contract_type',$where,array('column'=>'title','order'=>'asc'));
         echo '<option value="">Select Type</option>';
        foreach($Query as $secRow):
               echo '<option value="'.$secRow->contract_type_id.'">'.$secRow->title.'</option>';
        endforeach;
    }
    
    
    public function employee_degree(){ 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('degree');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->degree_name,
                    'label'=>$row_set->degree_name,
                    'id'=>$row_set->degree_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['degree_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('degree_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('degree',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->degree_name,
                    'label'=>$row_set->degree_name,
                    'id'=>$row_set->degree_id
                    );
            
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['degree_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
      public function auto_board_university(){ 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('board_university');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->bu_title,
                    'label'=>$row_set->bu_title,
                    'id'=>$row_set->bu_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['bu_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('bu_title'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('board_university',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->bu_title,
                    'label'=>$row_set->bu_title,
                    'id'=>$row_set->bu_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['bu_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
 public function auto_district(){ 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('district');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->district_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['district_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('district',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->district_id
                    );
            
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['district_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    public function auto_country(){ 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('country');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->country_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['country_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('country',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->name,
                    'label'=>$row_set->name,
                    'id'=>$row_set->country_id
                    );
            
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['country_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
     public function get_parent_menu(){
        $menu2ID = $this->input->post('menu1_id');
        $result  = $this->CRUDModel->get_where_result('menul2',array('m2_m1Id'=>$menu2ID));
        foreach($result as $row):
            echo '<option value='.$row->m2_id.'>'.$row->m2_name.'</option>';
        endforeach;
        
    }
     public function get_category_type(){
        $category_id = $this->input->post('category_id');
       // echo '<option value="">SELECT TYPE</option>';
        if(!empty($category_id)):
            $result  = $this->CRUDModel->get_where_result('hr_emp_category_type',array('ctgy_type_cat_id'=>$category_id),array('order'=>'asc','column'=>'ctgy_type_code'));
            foreach($result as $row):
                echo '<option value='.$row->category_type_id.'>['.$row->ctgy_type_code.'] '.$row->ctgy_type_name.'</option>';
            endforeach;
        else:
            echo '<option value="">CATEGORY TYPE</option>';
        endif;
    }
     public function get_department(){
        $category_id = $this->input->post('category_id');
         echo '<option value="">DEPARTMENT</option>';
            $result  = $this->CRUDModel->get_where_result('hr_emp_departments',array('emp_deprt_cat_id'=>$category_id),array('order'=>'asc','column'=>'emp_deprt_name'));
            foreach($result as $row):
                echo '<option value='.$row->emp_deprt_id.'>'.$row->emp_deprt_name.'</option>';
            endforeach;
        
    }
     public function get_designation_type(){
        $category_type_id = $this->input->post('category_type_id');
//        echo '<option value="">SELECT TYPE</option>';
        if(!empty($category_type_id)):
            $result  = $this->CRUDModel->get_where_result('hr_emp_designation',array('emp_desg_cat_type_id'=>$category_type_id),array('order'=>'asc','column'=>'emp_desg_code'));
            if($result):
                foreach($result as $row):
                    echo '<option value='.$row->emp_desg_id.'>['.$row->emp_desg_code.'] '.$row->emp_desg_name.'</option>';
                endforeach;
            else:
                echo '<option value="">SELECT DESIGNATION</option>';
            endif;
           
        else:
            echo '<option value="">SELECT DESIGNATION</option>';
        endif;
    }
    public function auto_year(){
           $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                                  $this->db->order_by('yr_title','desc');  
                $result_set     = $this->db->get_where('year')->result();
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->yr_title, 
                            'code'     =>$row_set->yr_title, 
                            'value'     =>$row_set->yr_title, 
                              
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                                          $this->db->like('yr_title',$like); 
                                          $this->db->order_by('yr_title','desc');
                $result_set             = $this->db->get_where('year')->result();
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                         'label'     =>$row_set->yr_title, 
                        'code'     =>$row_set->yr_title, 
                        'value'     =>$row_set->yr_title, 
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                   
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
        
        }
        
        public function get_branch(){
        $id = $this->input->post('bank');
//        echo '<option value="">SELECT TYPE</option>';
        if(!empty($id)):
            $result  = $this->CRUDModel->get_where_result('hr_bank_branch',array('branch_bank_id'=>$id),array('order'=>'asc','column'=>'branch_name'));
            if($result):
                foreach($result as $row):
                    echo '<option value='.$row->branch_id.'> '.$row->branch_name.'</option>';
                endforeach;
            else:
                echo '<option value="">SELECT BRANCH</option>';
            endif;
           
        else:
            echo '<option value="">SELECT BRANCH</option>';
        endif;
    }
    }


    