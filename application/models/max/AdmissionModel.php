<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class AdmissionModel extends CI_Model{
 
    public function __construct(){
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
             
    }
    public function inter_new_students_record($SPP,$page,$where=NULL){
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.sub_pro_id,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_record.board_regno,
                student_status.name as status
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        
        $this->db->limit($SPP,$page);
        $this->db->order_by('student_id','desc');    
        if($where):
            $this->db->where($where);
        endif;
        $this->db->group_by('student_record.student_id');
        return $this->db->get()->result();
   }
   public function inter_new_students_record_search($where=NULL,$like=NULL){
                $this->db->SELECT('
                    student_record.form_no,
                    student_record.student_id,
                    student_record.student_name,
                    student_record.father_name,
                    student_record.college_no,
                    student_record.applicant_image,
                    sections.name as section,
                    student_record.board_regno,
                    sub_programes.name as sub_program,
                    sub_programes.sub_pro_id as sub_pro_id,
                    prospectus_batch.batch_name as batch,
                    gender.title as gender,
                    student_status.name as status, 
                    sections.name as sessionName
                    ');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
                if($like):
                    $this->db->like($like);
                endif;
                if($where):
                    $this->db->where($where);
                endif;

                $this->db->order_by('student_record.student_id','asc');
                $this->db->group_by('student_record.student_id');
        return $this->db->get('student_record')->result();
    }
    public function get_last_batch(){
               $this->db->order_by('batch_id','desc'); 
               $this->db->limit('1','0'); 
        return $this->db->get_where('prospectus_batch',array('programe_id'=>1))->row()->batch_id;
    }
    
    public function searchbatches($table,$where=Null)
    {
        $this->db->SELECT('prospectus_batch.*,programes_info.programe_name,sub_programes.name');
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=prospectus_batch.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=prospectus_batch.lang_spro_id', 'left outer');
        $this->db->order_by('programes_info.programe_id','asc');;
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_auto_batches($table,$like=NULL)
    {
       $this->db->select('
        prospectus_batch.batch_id,
        prospectus_batch.batch_name,
        programes_info.programe_name as program,
       '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=prospectus_batch.programe_id', 'left outer');
        if($like):
        $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function searchsections($table,$where=Null)
    {
        $this->db->SELECT('
                sections.sec_id,
                sections.name,
                sections.seats_allowed,
                sections.status,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                ');
        $this->db->FROM('sections');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=sections.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=sections.program_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=sections.batch_id', 'left outer');
        $this->db->order_by('programes_info.programe_id','asc');
        $this->db->order_by('prospectus_batch.batch_id','asc');
        $this->db->order_by('sub_programes.sub_pro_id','asc');
        $this->db->order_by('sections.sec_id','desc');
        $this->db->order_by('sections.status','asc');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function searchSubProgram($table,$where=Null)
    {
        $this->db->SELECT('
                sub_programes.sub_pro_id,
                sub_programes.name,
                sub_programes.programe_id,
                programes_info.programe_name as program,
                sub_programes.status,
                sub_programes.flag
                ');
        $this->db->FROM('sub_programes');
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id', 'left outer');
        $this->db->order_by('sub_programes.name','asc');
        $this->db->order_by('programes_info.programe_id','asc');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    
  public function admin_picture_record_logs($where=NULL,$like=NULL){
            
        
            $this->db->select(
                'student_record.college_no,
                student_record.student_id,
                shift.name as shift_name,
                users.email as username,
                student_record.admission_date,
                student_record.rseats_id,
                student_record.applicant_image,
                    ');
            $this->db->from('student_record');
            $this->db->join('shift','shift.shift_id=student_record.shift_id');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id');
            $this->db->join('users','users.id=student_record.user_id');
            if($like):
             $this->db->like($like);   
            endif;
 
             $this->db->where($where);
//            $this->db->order_by('student_record.college_no','asc');
 
            return $this->db->get()->result();
        }
        
    public function student_strength_record($where=NULL,$like=NULL){
        $this->db->select('
            sections.sec_id,
            sections.name as section,
            sections.status,
            sub_programes.name as sub_program,
        ');
        
        $this->db->from('sections');
        $this->db->join('student_group_allotment','student_group_allotment.section_id=sections.sec_id');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=sections.sub_pro_id');
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
        if($like):
         $this->db->like($like);   
        endif;

        if($where):
         $this->db->where($where);   
        endif;
        $this->db->group_by('sections.name');
        
        return $this->db->get()->result();
    }
        
    public function student_strength_record_excel($where=NULL,$like=NULL){
        
        $this->db->select('
            sections.sec_id,
            sections.name as section,
            sections.status,
            sub_programes.name as sub_program,
        ');
        
        $this->db->from('sections');
        $this->db->join('student_group_allotment','student_group_allotment.section_id=sections.sec_id');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=sections.sub_pro_id');
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
        if($like):
         $this->db->like($like);   
        endif;

        if($where):
            $this->db->where($where);   
        endif;
        $this->db->group_by('sections.name');
        
        $result = $this->db->get()->result();
        $return_arr = '';
        $serial = '';
        foreach($result as $rrow):
            $serial++;
            $return_arr[] = array(
                'serial_no'         => $serial,
                'sub_programe'      => $rrow->sub_program,
                'section_title'     => $rrow->section,
                'total_students'    => $this->db->query("SELECT `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='.$rrow->sec_id.' AND student_record.s_status_id='5'")->num_rows(),
            );
        endforeach;
        return $return_arr;
    }
        
   public function student_picture_curr_record($where)
    {
    $query = $this->db->select('
        student_record.college_no,
        student_record.student_id,
        shift.name as shift_name,
        users.email as username,
        student_record.admission_date,
        reserved_seat.name as reserved_seat,
        student_record.applicant_image,
        student_record.timestamp,
    ')
    ->from('student_record')
    
    ->join('shift','shift.shift_id=student_record.shift_id')
    ->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id')
    ->join('users','users.id=student_record.user_id')
    ->where($where)
     ->get();
        return $query->row();
    }
    
    public function student_picture_log_record($where)
    {
    $query = $this->db->select('
        student_add_picture_log.college_no,
        student_add_picture_log.std_id,
        shift.name as shift_name,
        users.email as username,
        student_add_picture_log.admission_date,
        reserved_seat.name as reserved_seat,
        student_add_picture_log.picture,
        student_add_picture_log.entry_date,
    ')
    ->from('student_add_picture_log')
    
    ->join('shift','shift.shift_id=student_add_picture_log.shift_id')
    ->join('reserved_seat','reserved_seat.rseat_id=student_add_picture_log.reserved_seat')
    ->join('users','users.id=student_add_picture_log.user_id')
    ->where($where)
    ->order_by('entry_date', 'desc')
     ->get();
        return $query->result();
    }
    
    public function new_student_subject_get($where=NULL,$like=NULL){
            
        
            $this->db->select(
                'new_student_subjects.student_id,
                new_student_subjects.subject_id,
                subject.title as subject_name,
                    ');
            $this->db->from('new_student_subjects');
            $this->db->join('subject','subject.subject_id=new_student_subjects.subject_id');
            if($like):
             $this->db->like($like);   
            endif;
 
             $this->db->where($where);
//            $this->db->order_by('student_record.college_no','asc');
 
            return $this->db->get()->result();
        }
        public function new_admission_college_no_search($table,$where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.mobile_no,
                student_record.applicant_image,
                student_record.bs_enrollment_no,
                student_record.admission_date,
                student_record.student_password,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as status,
                ');
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.admission_date','asc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where_in('student_record.s_status_id', array(5,6));
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }  
 
   
    public function update_college_no($table,$where=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.shift_id,
                student_record.rseats_id2,
                student_record.applicant_mob_no1,
                student_record.student_name,
                student_record.father_name,
                student_record.mobile_no,
                student_record.dob,
                student_record.bs_enrollment_no,
                student_record.college_no,
                student_record.applicant_image,
                student_record.admission_date,
                student_record.student_password,
                religion.title as religion_name,
                domicile.name as domicile_name,
                shift.name as shift_name,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as status,
                mobile_network.net_id,
                mobile_network.network,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                board_university.title as bu_name,
                ');
        $this->db->FROM($table);
        $this->db->join('religion','religion.religion_id=student_record.religion_id', 'left outer');
        $this->db->join('shift','shift.shift_id=student_record.shift_id', 'left outer');
        $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('mobile_network','mobile_network.net_id=student_record.net_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
        $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ; 
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
   }
     public function data_verification_pagination($SPP,$page,$where=NULL){
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.fata_school,
                student_record.hostel_required,
                student_record.father_name,
                student_record.sub_pro_id,
                student_record.s_status_id,
                student_record.college_no,
                student_record.applicant_image,
                student_record.timestamp,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_record.board_regno,
                student_record.uni_regno,
                student_status.name as status,
                applicant_edu_detail.percentage,
                programes_info.programe_name as programe_name,
                sections.name as section,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        
        
        $this->db->limit($SPP,$page);
        $this->db->order_by('student_id','desc');    
//        $this->db->where_in('student_record.s_status_id',array('15','1'));
        if($where):
            $this->db->where($where);
        endif;
        $this->db->group_by('student_record.student_id');
        return $this->db->get()->result();
   }
public function stduent_data_verifications($where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.fata_school,
                student_record.hostel_required,
                student_record.father_name,
                student_record.college_no,
                student_record.s_status_id,
                student_record.applicant_image,
                student_record.board_regno,
                student_record.uni_regno,
                student_record.timestamp,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                applicant_edu_detail.percentage, 
                programes_info.programe_name as programe_name,
                sections.name as section,
                ');
            
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->order_by('student_record.student_id','desc');
            $this->db->group_by('student_record.student_id');
    return $this->db->get('student_record')->result();
       }
            public function bs_enrollment_no_search($table,$where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.mobile_no,
                student_record.applicant_image,
                student_record.bs_enrollment_no,
                student_record.admission_date,
                student_record.student_password,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as status,
                ');
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.student_id','desc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->limit('50');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   } 
 public function search_student_group($where=NULL,$like=NULL,$std_no){
        $this->db->SELECT('
            student_record.student_id,
            student_record.student_name,
            student_record.applicant_image,
            sub_programes.name as sub_program,
            programes_info.programe_name as program,
            prospectus_batch.batch_name as batch,
            gender.title as gender,
            student_record.father_name,      
            student_record.college_no,
            shift.name as shift_name,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.percentage,
            ');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            $this->db->join('shift','shift.shift_id=student_record.shift_id', 'left outer');
            $this->db->group_by('student_record.student_id');    
            $this->db->order_by('applicant_edu_detail.obtained_marks','desc');    
            if($where):
                $this->db->where($where);
            endif;
            if($like):
                $this->db->like($like);
            endif;
          if($std_no['std_no_from'] == ''):
                $this->db->where('applicant_edu_detail.obtained_marks <=',$std_no['std_no_to']);
                 else:
                  $this->db->where('applicant_edu_detail.obtained_marks BETWEEN "'.$std_no['std_no_from'].'" AND "'.$std_no['std_no_to'].'"');   
             endif;
             $this->db->order_by('student_record.college_no', 'asc');
       $return_array =  $this->db->get('student_record')->result();
       
       if(!empty($return_array)):
                    $keys   = array_column($return_array, 'college_no');
                    array_multisort($keys, SORT_ASC, $return_array);
                     return  json_decode(json_encode($return_array), FALSE);
                    else:
                     return false;
            endif;
       
        
   }
}
