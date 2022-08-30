<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class GreenfileModel extends CI_Model{
 
    public function __construct(){
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
        
                 
    }
    public function green_file_pagination($SPP,$page){
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
                student_record.uni_regno,
                student_status.name as status,
                applicant_edu_detail.percentage, 
                programes_info.programe_name, 
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        
        $this->db->limit($SPP,$page);
        $this->db->order_by('student_id','desc');    
        $this->db->where('student_record.s_status_id','9');
        $this->db->group_by('student_record.student_id');
        return $this->db->get()->result();
   }
   public function green_file_pagination_search($where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                student_record.board_regno,
                student_record.uni_regno,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                applicant_edu_detail.percentage,
                 programes_info.programe_name,
                ');
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
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
//            $this->db->where('student_record.s_status_id','9');
            $this->db->order_by('student_record.student_id','desc');
            $this->db->group_by('student_record.student_id');
    return $this->db->get('student_record')->result();
}
 public function green_file_student_education_record($where){
         $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            student_record.batch_id,
            student_record.programe_id,
            degree.title as Degreetitle,
            degree.degree_id as degree_id,
            grade.grade_name as grade_name,
            grade.grade_id as grade_id,
            student_character.char_name as character,
            board_university.title as boardTitle,
            board_university.bu_id as bu_id,
            applicant_edu_detail.serial_no,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.cgpa,
            applicant_edu_detail.rollno,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.percentage,
        ');
                 $this->db->from('applicant_edu_detail');
                 $this->db->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer');  
                 $this->db->join('student_character','student_character.char_id=student_record.char_id','left outer');  
                 $this->db->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer');  
                 $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
                 $this->db->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer');   
                 $this->db->order_by('applicant_edu_detail.serial_no','asc');
                 $this->db->limit(1);
                 $this->db->where($where);
                 $q = $this->db->get();
                return $q->row();
    }
    
     public function get_grrenfile_education_record($where)
    {
         $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            board_university.title as bordTitle,
            grade.grade_name as grade,
            applicant_edu_detail.sub_pro_id,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.cgpa,
            applicant_edu_detail.rollno,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.percentage,
            sub_programes.name as sub_program,
            sub_programes.sp_title
        ');
//         $this->db->from('');
            $this->db->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer');  
            $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
            $this->db->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer');
            $this->db->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=applicant_edu_detail.sub_pro_id','left outer');    
            $this->db->order_by('applicant_edu_detail.serial_no','desc');
 return  $this->db->get_where('applicant_edu_detail',$where)->result();

    }
    
    public function greend_file_student_record($where){
               $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer'); 
        return $this->db->get_where('student_record',$where)->row();
    }
       public function get_grrenfile_education_record_add($where){
         $this->db->select('
            applicant_edu_detail_demo.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            grade.grade_name as grade,
            applicant_edu_detail_demo.sub_pro_id,
            applicant_edu_detail_demo.year_of_passing,
            applicant_edu_detail_demo.total_marks,
            applicant_edu_detail_demo.obtained_marks,
            applicant_edu_detail_demo.rollno,
            applicant_edu_detail_demo.inst_id,
            applicant_edu_detail_demo.percentage,
            sub_programes.name as sub_program
        ');

            $this->db->join('student_record','student_record.student_id=applicant_edu_detail_demo.student_id','left outer');  
            $this->db->join('degree','degree.degree_id=applicant_edu_detail_demo.degree_id','left outer');
            $this->db->join('grade','grade.grade_id=applicant_edu_detail_demo.grade_id','left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=applicant_edu_detail_demo.sub_pro_id','left outer');    
return      $this->db->get_where('applicant_edu_detail_demo',$where)->result();

    }
}
