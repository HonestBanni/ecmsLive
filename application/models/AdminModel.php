<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class AdminModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
       
    }
    
     public function get_by_id($table,$id)
     {
        $query = $this->db->select('*')
        ->from($table)
        ->where($id)
        ->get();
      return $query->result();
    }
    
    public function getStdProvisional($table,$where)
     {
        $query = $this->db->select('student_provisional_issued.*,student_record.student_name,hr_emp_record.emp_name')
        ->from($table)   
        ->join('student_record','student_record.student_id=student_provisional_issued.student_id', 'left outer')    
        ->join('users','users.id=student_provisional_issued.user_id', 'left outer')    
        ->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer')    
        ->where($where)
        ->get();
      return $query->result();
    }
    
    public function getStdCharater($table,$where)
     {
        $query = $this->db->select('student_character_issued.*,student_record.student_name,hr_emp_record.emp_name')
        ->from($table)   
        ->join('student_record','student_record.student_id=student_character_issued.student_id', 'left outer')    
        ->join('users','users.id=student_character_issued.user_id', 'left outer')    
        ->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer')    
        ->where($where)
        ->get();
      return $query->result();
    }
    
    public function get_vehicleData($table)
     {
        $query = $this->db->select('*')
        ->from($table)   
        ->join('vehicle_status','vehicle_status.veh_status_id=vehicle.veh_status_id', 'left outer')    
        ->get();
      return $query->result();
    }
    
    public function get_vehicleRow($table,$where)
     {
        $query = $this->db->select('*')
        ->from($table)   
        ->join('vehicle_status','vehicle_status.veh_status_id=vehicle.veh_status_id', 'left outer')    
        ->where($where)
        ->get();
      return $query->row();
    }
    
    public function getAcademicRec($table,$where)
     {
        $query = $this->db->select('*')
        ->from($table)
        ->join('grade','grade.grade_id=applicant_edu_detail.grade_id', 'left outer')    
        ->join('student_division','student_division.div_id=applicant_edu_detail.div_id', 'left outer')    
        ->where($where)
        ->order_by('serial_no','desc')
        ->limit(1)    
        ->get();
      return $query->row();
    }
    
    public function studentEdu($where)
    {
         $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_id,
            student_record.student_name,
            degree.title as Degreetitle,
            board_university.title as bordTitle,
            grade.grade_name as grade,
            student_division.div_title as division,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.cgpa,
            applicant_edu_detail.rollno,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.percentage,
            sub_programes.name as sub_program
        ');
        $this->db->from('applicant_edu_detail');
        $this->db->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer');  
        $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
        $this->db->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer');
        $this->db->join('student_division','student_division.div_id=applicant_edu_detail.div_id','left outer');
        $this->db->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=applicant_edu_detail.sub_pro_id','left outer');   
        $this->db->order_by('applicant_edu_detail.serial_no','desc'); 
         $this->db->where($where);
         $q = $this->db->get();
         return $q->result();
    }
    
    public function get_admin_stdData($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.college_no,
                student_record.student_name,
                student_record.applicant_image,
                gender.title as genderName,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as student_status,
                student_record.father_name,
                sections.name as section,
                ');
        
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.s_status_id','9');
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_companies($title)
    {
        $this->db->like('title', $title, 'after'); 
        $query = $this->db->get('board_university');
        $companies = array();
        $i = 0;
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $companies[$i]['bu_id'] = $row->bu_id;
                $companies[$i]['title'] = $row->title;
                $i++;
            }
        }
        return $companies;
    }
    
    public function alumni_edu_record($where)
    {
        $query = $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            board_university.title as bordTitle,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.percentage,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.rollno,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.exam_type,
            grade.grade_name as grade_name,
        ')
                 ->from('applicant_edu_detail')
                 ->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer')  
                 ->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer')  
                 ->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer')  
                 ->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer')  
                 ->where($where)
                 ->get();
        return $query->result();
    }
    
    public function getAlumni($where)
    {
            $query = $this->db->select('
            student_record.student_id,
            student_record.applicant_image,
            student_record.student_name,
            student_record.father_name,
            sub_programes.name as subprogram,
            prospectus_batch.batch_name as batch,
            student_status.name as studentstatus,
        ')
         ->from('student_record')
         ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')  
         ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer')  
         ->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer')
        ->where($where)
        ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function alumni_student_profile($where)
    {
       $query = $this->db->select('
            student_record.student_id,
            student_record.student_name,
            student_record.father_name,
            student_record.college_no,
            student_record.board_regno,
            student_record.uni_regno,
            student_record.student_cnic,
            student_record.dob,
            student_record.hostel_required,
            student_record.mobile_no,
            student_record.mobile_no2,
            student_record.parmanent_address,
            student_record.admission_date,
            student_record.certificate_issue_date,
            student_record.dues_any,
            student_record.remarks,
            student_record.app_postal_address,
            student_record.remarks2,
            occupation.title as occupation,
            prospectus_batch.batch_name as batch,
            sports.sports_name as sports,
            programes_info.programe_name as program,
            sub_programes.name as sub_program,
            domicile.name as domicile,
            religion.title as religion,
            student_status.name as student_status,
        ')
    ->from('student_record')
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer')  
    ->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer')  
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
    ->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer')
    ->join('religion','religion.religion_id=student_record.religion_id','left outer')
    ->join('occupation','occupation.occ_id=student_record.occ_id','left outer')
    ->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer')
    ->join('sports','sports.sports_id=student_record.sports_id','left outer')
     ->where($where)
     ->get();
        return $query->result();  
    }
    
     public function get_stdData($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                student_record.college_no,
                student_record.student_id,
                student_record.student_name,
                student_record.applicant_image,
                gender.title as genderName,
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                applicant_edu_detail.percentage,
                prospectus_batch.batch_name as batch,
                student_status.name as student_status,
                student_record.father_name,
                ');
        
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function student_edu_record($where)
    {
         $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            board_university.title as bordTitle,
            grade.grade_name as grade,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.cgpa,
            applicant_edu_detail.rollno,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.percentage,
            sub_programes.name as sub_program
        ');
        $this->db->from('applicant_edu_detail');
        $this->db->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer');  
        $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
        $this->db->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer');
        $this->db->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=applicant_edu_detail.sub_pro_id','left outer');   
        $this->db->order_by('applicant_edu_detail.serial_no','asc'); 
        $this->db->limit(10,1);
                 $this->db->where($where);
                 $q = $this->db->get();
                return $q->result();
    }
    
//    public function student_edu_record($where)
//    {
//         $this->db->select('
//            applicant_edu_detail.serial_no,
//            student_record.student_name,
//            degree.title as Degreetitle,
//            board_university.title as bordTitle,
//            grade.grade_name as grade,
//            applicant_edu_detail.year_of_passing,
//            applicant_edu_detail.total_marks,
//            applicant_edu_detail.obtained_marks,
//            applicant_edu_detail.cgpa,
//            applicant_edu_detail.exam_type,
//            applicant_edu_detail.inst_id,
//            applicant_edu_detail.percentage,
//        ');
//                 $this->db->from('applicant_edu_detail');
//                 $this->db->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer');  
//                 $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
//                 $this->db->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer');
//                 $this->db->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer');   
//               //  $this->db->limit();
//                 $this->db->where($where);
//                 $q = $this->db->get();
//                return $q->result();
//    }
    
    public function student_edu_record_limit($where){
         $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            degree.degree_id as degree_id,
            grade.grade_name as grade_name,
            grade.grade_id as grade_id,
            student_character.char_name as character,
            board_university.title as boardTitle,
            board_university.bu_id as bu_id,
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
                 $this->db->limit(1);
                 $this->db->where($where);
                 $q = $this->db->get();
                return $q->result();
    }
    public function student_edu_record_limit_record($where){
         $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            degree.degree_id as degree_id,
            grade.grade_name as grade_name,
            grade.grade_id as grade_id,
            student_character.char_name as character,
            board_university.title as boardTitle,
            board_university.bu_id as bu_id,
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
//                 $this->db->order_by('applicant_edu_detail.serial_no','asc');
                 $this->db->where($where);
                 $q = $this->db->get();
                return $q->result();
    }
    
   //get results requ: tableName,where
    public function get_meritlist($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_record.student_id,
                student_record.student_name,
                gender.title as genderName,
                reserved_seat.name as reservedName,
                student_record.admission_comment,
                student_record.hostel_required,
                student_record.comment,
                student_record.father_name,
                student_record.form_no,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                board_university.title as bu_title,
                prospectus_batch.batch_name,
                applicant_edu_detail.percentage,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                student_status.name as student_statusName
                
                ');
         
           // $this->db->select('*');
            $this->db->FROM($table);
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('gender','gender.gender_id=student_record.gender_id');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
            $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
            if($like):
                $this->db->like($like);
            endif;
            
            $this->db->limit($custom['limit'],$custom['start']);
            $this->db->order_by($custom['column'],$custom['order']);
            
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
            
   }
    
    public function get_meritlistExport($table,$where=NULL,$like=NULL,$custom=NULL)
        {
       
            $this->db->SELECT('
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as reservedName,
                prospectus_batch.batch_name,
                student_record.hostel_required,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.admission_comment,
                student_record.comment,

                student_status.name as student_statusName
                 
                ');
                             //board_university.title as bu_title,
           // $this->db->select('*');
            $this->db->FROM($table);
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('gender','gender.gender_id=student_record.gender_id');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
            $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
            $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id');
            if($like):
                $this->db->like($like);
            endif;
            
            $this->db->limit($custom['limit'],$custom['start']);
            $this->db->order_by($custom['column'],$custom['order']);
            
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result_array();
            endif;
            
   }
   
      Public function leaving_certificate_print($where){
             $this->db->select('
                         student_record.student_name,
                         student_record.father_name,
                         student_record.college_no,
                         DATE_FORMAT(student_record.admission_date,"%d-%m-%Y") AS admission_date,
                         DATE_FORMAT(student_record.leaving_date,"%d-%m-%Y") AS leaving_date,
                         DATE_FORMAT(student_record.dob,"%d-%m-%Y") AS dob_figure,
                         DATE_FORMAT(student_record.dob,"%d %M %Y") AS dob_in_word,
                         student_record.board_regno,
                         sub_programes.name as sub_program , ,
                         
                     ');
             $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
      return $this->db->get_where('student_record',$where)->row();
  }  
    public function get_admin_leaving_certificate($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.college_no,
                student_record.student_name,
                student_record.applicant_image,
                gender.title as genderName,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as student_status,
                student_record.father_name,
                sections.name as section,
                ');
        
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
//            $this->db->where('student_record.s_status_id','9');
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
       public function discipline_action_pagination_search($where=NULL,$like=NULL){
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
                gender.title as gender,
                student_status.name as status,
                applicant_edu_detail.percentage 
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
            $this->db->where('student_record.s_status_id','5');
            $this->db->order_by('student_record.student_id','asc');
            $this->db->group_by('student_record.student_id');
    return $this->db->get('student_record')->result();
}
public function discipline_action_pagination($SPP,$page){
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
                applicant_edu_detail.percentage 
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
        
        $this->db->limit($SPP,$page);
        $this->db->order_by('student_id','desc');    
        $this->db->where('student_record.s_status_id','5');
        $this->db->group_by('student_record.student_id');
        return $this->db->get()->result();
   }
  
}
