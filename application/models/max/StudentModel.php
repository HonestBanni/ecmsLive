<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class StudentModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    
    public function get_by_id($table,$id){
        $query = $this->db->select('*')
            ->from($table)
            ->where($id)
            ->get();
      return $query->result();
    }
    
    public function getClassData($table,$where)
    {
         $this->db->SELECT('
        class_alloted.class_id as class_id,
        class_alloted.flag as flag,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        sections.sub_pro_id as sub_pro_id,
        subject.title as subject,
        subject.subject_id as subject_id
            ');
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getgroupDaym($table,$where)
    {
        $this->db->SELECT('
                practical_alloted.practical_class_id,
                practical_alloted.group_id,
                practical_group.group_name,
                practical_subject.title,
                hr_emp_record.emp_name,
                practical_timetable.practical_class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('practical_timetable','practical_timetable.practical_class_id=practical_alloted.practical_class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=practical_timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=practical_timetable.etime_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('practical_timetable.day_id','1');
        $this->db->order_by('practical_timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getgroupDaytu($table,$where)
    {
        $this->db->SELECT('
                practical_alloted.practical_class_id,
                practical_alloted.group_id,
                practical_group.group_name,
                practical_subject.title,
                hr_emp_record.emp_name,
                practical_timetable.practical_class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('practical_timetable','practical_timetable.practical_class_id=practical_alloted.practical_class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=practical_timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=practical_timetable.etime_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('practical_timetable.day_id','2');
        $this->db->order_by('practical_timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getgroupDayw($table,$where)
    {
        $this->db->SELECT('
                practical_alloted.practical_class_id,
                practical_alloted.group_id,
                practical_group.group_name,
                practical_subject.title,
                hr_emp_record.emp_name,
                practical_timetable.practical_class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('practical_timetable','practical_timetable.practical_class_id=practical_alloted.practical_class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=practical_timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=practical_timetable.etime_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('practical_timetable.day_id','3');
        $this->db->order_by('practical_timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getgroupDayth($table,$where)
    {
        $this->db->SELECT('
                practical_alloted.practical_class_id,
                practical_alloted.group_id,
                practical_group.group_name,
                practical_subject.title,
                hr_emp_record.emp_name,
                practical_timetable.practical_class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('practical_timetable','practical_timetable.practical_class_id=practical_alloted.practical_class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=practical_timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=practical_timetable.etime_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('practical_timetable.day_id','4');
        $this->db->order_by('practical_timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getgroupDayf($table,$where)
    {
        $this->db->SELECT('
                practical_alloted.practical_class_id,
                practical_alloted.group_id,
                practical_group.group_name,
                practical_subject.title,
                hr_emp_record.emp_name,
                practical_timetable.practical_class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('practical_timetable','practical_timetable.practical_class_id=practical_alloted.practical_class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=practical_timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=practical_timetable.etime_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('practical_timetable.day_id','5');
        $this->db->order_by('practical_timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getClassDaym($table,$where)
    {
        $this->db->SELECT('
                class_alloted.class_id,
                class_alloted.sec_id,
                sections.name,
                subject.title,
                hr_emp_record.emp_name,
                timetable.class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('timetable','timetable.class_id=class_alloted.class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('timetable.day_id','1');
        $this->db->order_by('timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getClassDaytu($table,$where)
    {
        $this->db->SELECT('
                class_alloted.class_id,
                class_alloted.sec_id,
                subject.title,
                sections.name,
                hr_emp_record.emp_name,
                timetable.class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('timetable','timetable.class_id=class_alloted.class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('timetable.day_id','2');
        $this->db->order_by('timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    public function getClassDayw($table,$where)
    {
        $this->db->SELECT('
                class_alloted.class_id,
                class_alloted.sec_id,
                subject.title,
                sections.name,
                hr_emp_record.emp_name,
                timetable.class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('timetable','timetable.class_id=class_alloted.class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('timetable.day_id','3');
        $this->db->order_by('timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    public function getClassDayth($table,$where)
    {
        $this->db->SELECT('
                class_alloted.class_id,
                class_alloted.sec_id,
                subject.title,
                sections.name,
                hr_emp_record.emp_name,
                timetable.class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('timetable','timetable.class_id=class_alloted.class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('timetable.day_id','4');
        $this->db->order_by('timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    public function getClassDayf($table,$where)
    {
        $this->db->SELECT('
                class_alloted.class_id,
                class_alloted.sec_id,
                subject.title,
                sections.name,
                hr_emp_record.emp_name,
                timetable.class_id,
                class_starting_time.class_stime,
                class_ending_time.class_etime
            ');
        $this->db->FROM($table);
        $this->db->join('timetable','timetable.class_id=class_alloted.class_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('timetable.day_id','5');
        $this->db->order_by('timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function issuance_Books_details($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('lib_book_issuance_details','lib_book_issuance_details.issuance_id=lib_book_issuance.issuance_id','left outer');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_issuance_details.book_id','left outer');
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_issuance_details.availablity_status_id','left outer');
        $this->db->where('lib_book_issuance_details.availablity_status_id','1');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_practicalSubjects($where){
           
             $this->db->from('practical_alloted');
              $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id');
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }
    
    public function get_studentPractical_att($where){
           
             $this->db->from('practical_alloted');
          $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
          $this->db->join('practical_attendance_details','practical_attendance_details.attend_id=practical_attendance.attend_id');
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }
    
    public function get_whiteCard_practical($where=NULL){
       
         $this->db->select(
            '   student_prac_group_allottment.college_no,
                student_prac_group_allottment.student_name,
                practical_group.prac_group_id,
                practical_group.group_name
                ');
             $this->db->from('student_prac_group_allottment');
        $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id');
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get()->row();
   }
    
    public function grand_report($field,$table,$where=NULL,$like=NULL){
  
                $this->db->select($field);    
                $this->db->from($table);  
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
                if($like):
                     $this->db->like($like);
                endif;
                  $this->db->group_by('student_record.college_no');
                $this->db->order_by('college_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
    public function get_studentData($table,$where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                ');
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $query = $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function profileDataStudent($table,$where)
    {
       $query = $this->db->select('
            student_record.applicant_image,
            student_record.student_name,
            student_record.father_name,
            student_record.college_no,
            prospectus_batch.batch_name as batch,
            programes_info.programe_name as program,
            sub_programes.name as sub_program,            
            sub_programes.sub_pro_id as sub_pro_id,            
            sub_programes.flag as sub_pro_flag,           
            student_record.student_type,           
            student_record.mobile_no,           
        ')
    ->from($table)
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer')  
    ->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer')  
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
     ->where($where)
     ->get();
        return $query->row();  
    }
    
    public function get_where_sec($table,$where)
    {
       $query = $this->db->select('*')
    ->from($table)
    ->join('sections','sections.sec_id=student_group_allotment.section_id','left outer')  
     ->where($where)
     ->get();
        return $query->row();  
    }
    
    public function get_course_details($table,$where)
    {
       $query = $this->db->select('*')
       ->from($table)
       ->join('subject','subject.subject_id=student_subject_alloted.subject_id','left outer') 
       ->join('programes_info','programes_info.programe_id=subject.programe_id','left outer')  
       ->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id','left outer')   
       ->where($where)
       ->get();
        return $query->result();  
    }
    
    public function get_books_details($table,$where)
    {
       $query = $this->db->select('*')
       ->from($table)
       ->join('lib_book_issuance_details','lib_book_issuance_details.issuance_id=lib_book_issuance.issuance_id','left outer') 
       ->join('lib_books_record','lib_books_record.book_id=lib_book_issuance_details.book_id','left outer')  
       ->where($where)
       ->get();
        return $query->result();  
    }
    
    public function pending_books_details($table,$where)
    {
       $query = $this->db->select('*')
       ->from($table)
       ->join('lib_book_issuance_details','lib_book_issuance_details.issuance_id=lib_book_issuance.issuance_id','left outer') 
       ->join('lib_books_record','lib_books_record.book_id=lib_book_issuance_details.book_id','left outer')     
       ->where($where)  
       ->get();
        return $query->result();  
    }
    
     public function getprocData($table,$id){
        $query = $this->db->select('student_record.student_name')
            ->from($table)
           ->join('student_record','student_record.student_id=proctors.student_id','left outer')
            ->where($id)
            ->get();
      return $query->row();
    }
    
    public function get_fine($table,$where)
    {
        $query = $this->db->select('
       proctorial_fine.*,
       proctorial_fine_type.*,
       proctorial_fine_status.*       
        ')
    ->from($table)
    ->join('student_record','student_record.student_id=proctorial_fine.student_id','left outer')
    ->join('proctorial_fine_type','proctorial_fine_type.proc_type_id=proctorial_fine.proc_type_id','left outer')
    ->join('proctorial_fine_status','proctorial_fine_status.proc_status_id=proctorial_fine.proc_status_id','left outer')
    ->where($where)        
     ->get();
        return $query->result();   
    }
    
    public function get_monthly_test_marks($table,$where)
    {
       $query = $this->db->select('*')
        ->from($table)
        ->join('monthly_test','monthly_test.test_id=monthly_test_details.test_id','left outer')  
        ->join('class_alloted','class_alloted.class_id=monthly_test.class_id','left outer')  
        ->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id','left outer')  
        ->join('subject','subject.subject_id=class_alloted.subject_id','left outer')  
        ->join('sections','sections.sec_id=class_alloted.sec_id','left outer')  
        ->join('student_record','student_record.student_id=monthly_test_details.student_id','left outer')  
     ->where($where)
     ->get();
        return $query->result();  
    }
    
    public function get_proctorData($table,$where2)
    {
       $query = $this->db->select('
       proctorial_fine.*,
       proctorial_fine_type.*,
       proctorial_fine_status.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,           
       student_record.applicant_image           
        ')
    ->from($table)
    ->join('student_record','student_record.student_id=proctorial_fine.student_id','left outer')
    ->join('proctorial_fine_type','proctorial_fine_type.proc_type_id=proctorial_fine.proc_type_id','left outer')
    ->join('proctorial_fine_status','proctorial_fine_status.proc_status_id=proctorial_fine.proc_status_id','left outer')       
    ->order_by('proc_id','desc')       
     ->where($where2)
     ->get();
        return $query->result();  
    }
    
    public function getStds($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
            $this->db->like('student_name',$like);    
            $this->db->or_like('college_no',$like);    
        endif;
         $this->db->where('s_status_id','5');
         $query = $this->db->get();
        return $query->result();
    }
    
    public function getProctors($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=proctors.student_id', 'left outer');
        if($like):
            $this->db->like('student_record.student_name',$like);    
            $this->db->or_like('student_record.college_no',$like);    
        endif;
         $this->db->where('proctors.status','1');
         $query = $this->db->get();
        return $query->result();
    }
    
        
public function student_fee_details($student_id=Null){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.s_status_id,
                        student_record.father_name,
                        fee_challan.fc_challan_id,
                        sections.name as sessionName, 
                        fee_challan_status.fcs_title,
                        fee_challan_status.ch_status_id,
                        fee_challan.fc_pay_cat_id,
                        fee_challan.fc_issue_date,
                        fee_challan.fc_challan_credit_amount as credit_amount,
                        fee_challan.challan_id_lock,
                        fee_challan.fc_paiddate,
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                        fee_category_titles.title as fee_installment,
                        student_status.name as student_status,
                        prospectus_batch.batch_name,
                    ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
               // $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left outer');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left outer');
                
                    $this->db->where('student_record.student_id',$student_id);
                 
                 
                $this->db->group_by('fee_challan.fc_challan_id');
                $this->db->order_by('college_no','asc');
                $this->db->order_by('fc_challan_id','asc');
       $result =   $this->db->get('student_record')->result();
    
        $return_array = '';
        foreach($result as $row):
            //Fee Details 
            $where = array(
              'challan_id'=>$row->fc_challan_id,  
              'delete_head_flag'=>1,  
            );
                        $this->db->select(
                                'sum(actual_amount)as actualAmount,
                                 sum(paid_amount) as paidAmount,
                                 sum(balance) as balance,
                                 sum(old_credit_amount) as old_credit_amount');
            $payments = $this->db->get_where('fee_actual_challan_detail',$where)->row();
            
             
            
               $where_curr = array(
                  'challan_id'  => $row->fc_challan_id,  
                  'old_balance_pc_id '=>0,
                   'delete_head_flag'=>1, 
                );
                        $this->db->select('sum(actual_amount)as current_amount');
            $payments_crrent = $this->db->get_where('fee_actual_challan_detail',$where_curr)->row();
            
               $where_arre = array(
                  'challan_id'=>$row->fc_challan_id,  
                  'old_balance_pc_id !='=>0,
                  'delete_head_flag'=>1, 
                );
                        $this->db->select('sum(actual_amount)as arrears_amount');
            $payments_arrears = $this->db->get_where('fee_actual_challan_detail',$where_arre)->row();
            
             //Concession Details 
            
            $where_con = array(
              'fee_concession_challan.challan_id'=>$row->fc_challan_id  
            );
                        $this->db->select('
                                sum(concession_amount)as concession_amount,
                                ');
                              $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id');  
                $concession = $this->db->get_where('fee_concession_challan',$where_con)->row();
            
           $return_array[] = array(
               'college_no'         => $row->college_no,
               'challan_id_lock'    => $row->challan_id_lock,
               'student_id'         => $row->student_id,
               's_status_id'        => $row->s_status_id,
               'sub_pro_id'         => $row->sub_pro_id,
               'student_status'     => $row->student_status,
               'sessionName'        => $row->sessionName,
               'form_no'            => $row->form_no,
               'batch_id'           => $row->batch_id,
               'student_name'       => $row->student_name,
               'father_name'        => $row->father_name,
               'fc_challan_id'      => $row->fc_challan_id,
               'fcs_title'          => $row->fcs_title,
               'ch_status_id'       => $row->ch_status_id,
               'fc_pay_cat_id'      => $row->fc_pay_cat_id,
               'fc_issue_date'      => $row->fc_issue_date,
               'fc_paiddate'        => $row->fc_paiddate,
               'credit_amount'      => $row->credit_amount,
               'fee_installment'    => $row->fee_installment,
               'batch_name'         => $row->batch_name,
               'current'            => $payments_crrent->current_amount,
               'arrears'            => $payments_arrears->arrears_amount,
               'total_upPaid'       => $payments->actualAmount,
               'total_Paid'         => $payments->paidAmount,
               'old_credit'         => $payments->old_credit_amount,
               'total_balance'      => $payments->balance,
               'concession'         => $concession->concession_amount,
               'credit'             => $concession->concession_amount,
            );
        endforeach;
 
         
        return   json_decode(json_encode($return_array), FALSE);
    }
    
     public function hostel_challan_search_details($where=Null,$like=NULL){
           $this->db->select(
                    '  
                        student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sections.name as sessionName, 
                        hostel_student_bill.id as challan_id,
                        hostel_student_bill.challan_lock,
                        hostel_student_bill.date_from,
                        hostel_student_bill.date_to,
                        hostel_head_type.title as hotel_type,
                        hostel_student_bill.payment_date,
                        hostel_status.status_name,
                        fee_challan_status.fcs_title,
                        fee_challan_status.ch_status_id,
                        hostel_student_record.hostel_id,
                        fee_category_titles.title as Category_title,
                        student_status.name as student_status,
                        prospectus_batch.batch_name,
                       
                      ');

                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
                  $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=hostel_student_bill.challan_status');
               $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=hostel_student_bill.cat_title_id');
               
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
//                $this->db->group_by('hostel_student_bill.id');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('hostel_student_bill.id','asc');
                $this->db->order_by('hostel_student_bill.issue_date','desc');
                 
  $result = $this->db->get('student_record')->result();
        $return_array = '';
        foreach($result as $row):
             
            
            //Current Bill  
            $where_current  = array(
              'hostel_student_bill.id'                      => $row->challan_id, 
              'hostel_student_bill_info.old_challan_id'     => 0, 
            );
            $field_current = 'sum(amount) as current_bill';
            $current = $this->get_Hostel_mess_bill_details($field_current,$where_current);
            
            //arrears Bill  
            $where_arrears  = array(
              'hostel_student_bill.id'                      => $row->challan_id, 
              'hostel_student_bill_info.old_challan_id >'     => 0, 
            );
            $field_arrears = 'sum(amount) as arrears_bill';
            $arrears = $this->get_Hostel_mess_bill_details($field_arrears,$where_arrears);
            
            //paid Bill  
            $where_paid  = array(
              'hostel_student_bill.id'                      => $row->challan_id, 
            );
            $field_paid = 'sum(paid_amount) as paid_amount';
            $paid = $this->get_Hostel_mess_bill_details($field_paid,$where_paid);
 
            $return_array[] = array(
              'form_no'             => $row->form_no,  
              'college_no'          => $row->college_no,  
              'student_id'          => $row->student_id,  
              'student_name'        => $row->student_name,  
              'father_name'         => $row->father_name,  
              'sessionName'         => $row->sessionName,  
              'student_status'      => $row->student_status,  
              'student_name'        => $row->student_name,  
              'sub_program_name'    => $row->sub_program_name,  
              'fcs_title'           => $row->fcs_title,  
              'Category_title'      => $row->Category_title,  
              'date_from'           => $row->date_from,  
              'date_to'             => $row->date_to,  
              'hostel_id'           => $row->hostel_id,  
              'batch_name'          => $row->batch_name,  
              'challan_id'          => $row->challan_id,  
              'payment_date'        => $row->payment_date,  
              'ch_status_id'        => $row->ch_status_id,  
              'challan_lock'        => $row->challan_lock,  
              'status_name'        => $row->status_name,  
              'current'             => $current->current_bill,  
              'arrears'             => $arrears->arrears_bill,  
              'paid'                => $paid->paid_amount,  
              'balance'             => $current->current_bill+$arrears->arrears_bill-$paid->paid_amount,  
  );
            
        endforeach;
     return   json_decode(json_encode($return_array), FALSE);
    } 
     public function get_Hostel_mess_bill_details($field,$where){
                $this->db->select($field);
                $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');    
        return  $this->db->where($where)->get('hostel_student_bill')->row();   
    }
    
}

