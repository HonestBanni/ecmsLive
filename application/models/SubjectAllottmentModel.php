<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class SubjectAllottmentModel extends CI_Model{
 
    public function __construct(){
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
        
                 
    }
 public function art_subject_pagination($SPP,$page,$where=NULL,$column=NULL,$array=NULL){
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
//        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        
        $this->db->limit($SPP,$page);
        $this->db->order_by('student_id','desc');    
        if($where):
            $this->db->where($where);
        endif;
        if($column):
            $this->db->where_in($column,$array);
        endif;
        $this->db->group_by('student_record.student_id');
        return $this->db->get()->result();
   }
 public function art_subject_search($where=NULL,$like,$column=NULL,$array=NULL){
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
//        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
         
        $this->db->order_by('student_record.college_no','asc');    
        if($like):
            $this->db->like($like);
        endif;
        if($where):
            $this->db->where($where);
        endif;
        if($column):
            $this->db->where_in($column,$array);
        endif;
        $this->db->group_by('student_record.student_id');
        return $this->db->get()->result();
   }
   public function science_subject_search($where=Null,$like=Null,$column=NULL,$array=NULL){
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.sub_pro_id,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as sections_name,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_record.board_regno,
                student_status.name as status,
                ');
        
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
//        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
//        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        
        if($column):
            $this->db->where_in($column,$array);
        endif; 
            
        if($like):
            $this->db->like($like);
        endif;
        if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('student_id','desc');
//        $this->db->group_by('student_record.student_id');
        return $this->db->get('student_record')->result();
   } 
   
   
   public function get_arts_students_new($where=Null){
            $this->db->SELECT('
                student_record.college_no,
                student_record.student_id,
                student_record.student_name,
                ');
        
        $this->db->join('student_subject_alloted','student_subject_alloted.student_id=student_record.student_id', 'left outer');
        
        if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('college_no','asc');
//        $this->db->group_by('student_record.student_id');
        return $this->db->get('student_record')->result();
   } 
   
   public function get_arts_subjects_in_admission($where=Null){
            $this->db->SELECT('
                new_student_subjects.subject_id,
                subject.title,
                ');
        
        $this->db->join('subject','subject.subject_id=new_student_subjects.subject_id', 'left outer');
        
        if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('new_student_subjects.subject_id','asc');
//        $this->db->group_by('student_record.student_id');
        return $this->db->get('new_student_subjects')->result();
   } 
   
   public function get_arts_subjects_alloted($where=Null){
            $this->db->SELECT('
                student_subject_alloted.subject_id,
                subject.title,
                ');
        
        $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id', 'left outer');
        
        if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('student_subject_alloted.subject_id','asc');
//        $this->db->group_by('student_record.student_id');
        return $this->db->get('student_subject_alloted')->result();
   } 
   
    public function art_subject_search_yr($where=NULL,$like=NULL,$column=NULL,$array=NULL){
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
//        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
         
        $this->db->order_by('student_record.college_no','asc');    
        if($like):
            $this->db->like($like);
        endif;
        if($where):
            $this->db->where($where);
        endif;
        if($column):
            $this->db->where_in($column,$array);
        endif;
        $this->db->group_by('student_record.student_id');
        return $this->db->get()->result();
   }
   
}
