<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class AttendanceModel extends CI_Model
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
    
    public function get_student_attendance_present($where=NULL){
      
            $this->db->from('class_alloted');
            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
            $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
            $this->db->where('student_attendance_details.status','1');
            $this->db->where($where);
        return  $this->db->get()->result();               
        }
    
    public function get_student_attendance_absent($where=NULL){
      
            $this->db->from('class_alloted');
            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
            $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
            $this->db->where('student_attendance_details.status','0');
            $this->db->where($where);
        return  $this->db->get()->result();               
        }
    
    public function get_stdsecurityrecord($table,$from_date=NULL,$to_date=NULL)
    {
     $this->db->select('
             student_record.student_name,
             student_record.applicant_image,
             student_record.college_no,
             student_record.student_id,
             sections.name as sectionName,
             student_security.*,
             prospectus_batch.batch_name,
             sub_programes.name as sub_program,
             programes_info.programe_name')
        ->FROM($table)   
    ->join('student_record','student_record.student_id=student_security.student_id', 'left outer') 
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer')
    ->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer')
    ->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer')
    ->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer')
    ->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
    if($from_date !="" && $to_date !=""):
        $this->db->where('student_security.date BETWEEN "'.$from_date.'" and "'.$to_date.'"');
    endif;   
     return $this->db->get()->result();
    }
    public function get_stdsecurityExport($table,$from_date=NULL,$to_date=NULL)
    {
     $this->db->select('
            student_record.college_no,
            student_record.student_name,
            sub_programes.name as sub_program,
            sections.name as sectionName,
            student_security.general_security,
            student_security.hostel_security,
            student_security.exam_fee,
            student_security.fines,
            student_security.others,
            student_security.deduction,
            student_security.total_refund,
            student_security.comments,
            ')
        ->FROM($table)     
    ->join('student_record','student_record.student_id=student_security.student_id', 'left outer')
    ->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer')      
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer')
    ->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer')         
    ->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer')
    ->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
    if($from_date !="" && $to_date !=""):
        $this->db->where('student_security.date BETWEEN "'.$from_date.'" and "'.$to_date.'"');
    endif;   
     return $this->db->get()->result_array();
    }
    public function getTimeTableDemo($table,$where=NULL){

        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=timetable_demo.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable_demo.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable_demo.etime_id', 'left outer');
        $this->db->join('invt_building_block','invt_building_block.bb_id=timetable_demo.building_block_id', 'left outer');
        $this->db->join('invt_rooms','invt_rooms.rm_id=timetable_demo.room_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
     public function getTimeTableDemo_before_bulding_block($table){
       
            $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=timetable_demo.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable_demo.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable_demo.etime_id', 'left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
    public function getPracDaym($table,$where)
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
    
    public function getPracDaytu($table,$where)
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
    public function getPracDayw($table,$where)
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
    public function getPracDayth($table,$where)
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
    public function getPracDayf($table,$where)
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
    
    public function getPract_TimeTableDemo($table,$where){
       
            $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=practical_timetable_demo.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=practical_timetable_demo.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=practical_timetable_demo.etime_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
    public function getPrac_TimeTablerow($table,$where){
       
            $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('practical_timetable','practical_timetable.practical_class_id=practical_alloted.practical_class_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
   }
    
    public function getclassPracTimeTable($table,$where){
       
            $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=practical_timetable.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=practical_timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=practical_timetable.etime_id', 'left outer');
         $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
    public function pracgroup_Timetable($table,$where){
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=practical_timetable.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=practical_timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=practical_timetable.etime_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
    public function getpracEmp_Data($table,$where)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
            $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function getclassTimeTable($table,$where){
       
         
            $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=timetable.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id', 'left outer');
        $this->db->join('invt_building_block','invt_building_block.bb_id=timetable.building_block_id', 'left outer');
        $this->db->join('invt_rooms','invt_rooms.rm_id=timetable.room_id', 'left outer');
         $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
    public function class_timetablerow($table,$where){
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=timetable.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
   }
    
    public function section_Timetable_before_log($table,$where){
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=timetable.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
      public function section_Timetable($where){
        
        $this->db->join('days','days.day_id=timetable.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id', 'left outer');
        $this->db->join('invt_building_block','invt_building_block.bb_id=timetable.building_block_id', 'left outer');
        $this->db->join('invt_rooms','invt_rooms.rm_id=timetable.room_id', 'left outer');
        $this->db->where($where);
        return  $this->db->get('timetable')->result();
        
   }
    public function getTimeTableWhere($table,$where){
       
            $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=timetable.day_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
    public function getemp_timetable($table,$where){
       
            $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('timetable','timetable.class_id=class_alloted.class_id', 'left outer');
        $this->db->join('days','days.day_id=timetable.day_id', 'left outer');
        $this->db->where($where);
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
    
    public function getTimeTablerow($table,$where){
       
            $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('timetable','timetable.class_id=class_alloted.class_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
   }
    
    public function practical_history_comulative($table,$where=NULL){
       
            $this->db->SELECT('
            practical_alloted.practical_class_id as class_id,
            practical_alloted.timestamp as timestamp,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            practical_group.group_name as section,
            practical_group.prac_group_id as sec_id,
            practical_subject.title as subject,
            practical_subject.prac_subject_id as subject_id,
            ');
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
       $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function admin_test_historyn($table,$where=NULL){
       
            $this->db->SELECT('
            class_alloted.class_id as class_id,
            class_alloted.flag as flag,
            class_alloted.timestamp as timestamp,
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
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function view_langues_attendance($table,$where){
        $this->db->select('
        student_record.student_id,
        student_record.student_name,
        student_record.form_no,
        student_attendance_lang_details.status,
        student_attendance_lang_details.serial_no,
        student_attendance_lang_details.attend_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_attendance_lang_details.student_id', 'left outer');
        $this->db->where($where);
        $this->db->order_by('student_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function student_lan_attendance($table,$where=NULL)
    {
       $this->db->select('
        student_attendance_languages.*,
        programes_info.*,
        prospectus_batch.*
       '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=student_attendance_languages.programe_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_attendance_languages.batch_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;    
        $this->db->order_by('student_attendance_languages.attend_id','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function student_languageattendance($table)
    {
       $this->db->select('
        student_attendance_languages.*,
        programes_info.*,
        prospectus_batch.*
       '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=student_attendance_languages.programe_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_attendance_languages.batch_id', 'left outer');
        $this->db->order_by('student_attendance_languages.attend_id','desc');
        $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_studentsLangAtts($table,$where){
        $this->db->select('
        student_record.student_id,
        student_record.student_name,
        student_record.form_no,
        programes_info.programe_id,
        programes_info.programe_name,
        prospectus_batch.batch_id,
        prospectus_batch.batch_name,
        sub_programes.name
       '); 
        $this->db->FROM($table);
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->order_by('student_id','asc');
        $this->db->where($where);
        $this->db->where('student_record.s_status_id','5');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function get_language_students($where=NULL){
       
         $this->db->select(
                '
                student_record.student_id,
                student_record.student_name,
                student_record.form_no,
                programes_info.programe_name,
                prospectus_batch.batch_name,
                ');
            $this->db->from('student_record');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
         if($where):
               $this->db->where($where);
         endif;
        $this->db->where('student_record.s_status_id','5');
        $this->db->order_by('student_id','asc');
         return $this->db->get()->result();
         
   }
    
    public function get_lang_attendance_row($where=NULL){
      
            $this->db->select('student_attendance_lang_details.*,programes_info.programe_name,prospectus_batch.batch_name');
            $this->db->from('student_attendance_lang_details');
            $this->db->join('student_attendance_languages','student_attendance_languages.attend_id=student_attendance_lang_details.attend_id');
            $this->db->join('programes_info','programes_info.programe_id=student_attendance_languages.programe_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_attendance_languages.batch_id');
            $this->db->where($where);
            return  $this->db->get()->row();
                      
}
    
    public function get_alloted_languages($table){
        $this->db->select('
        programes_info.programe_id,
        programes_info.programe_name,
        prospectus_batch.batch_id,
        prospectus_batch.batch_name,
       '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=prospectus_batch.programe_id', 'left outer');
        $this->db->where('prospectus_batch.status','on');
        $this->db->where_in('prospectus_batch.programe_id',array(10,11,12,13));
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function getemployee_Data($table,$like=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as emp_name,
        hr_emp_designation.title as designation,
        hr_emp_scale.title as scale,
        hr_emp_category.title as category,
        department.title as department,
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer');
        if($like):
        $this->db->like($like);
        endif;
        $this->db->order_by('hr_emp_record.emp_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    } 
    
    public function getsubject_alloted($table,$where=NULL)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_studentbcs_att($where,$from_date=NULL,$todate=NULL){
           
          $this->db->from('class_alloted');
          $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
          $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
            if($where):
               $this->db->where($where);
            endif;
        if($from_date !="" && $todate !=""):
       $this->db->where('DATE(student_attendance.attendance_date) BETWEEN "'.$from_date.'" and "'.$todate.'"');
        endif;     
         return $this->db->get()->result();
        }
    
    public function position_report($field,$table,$where=NULL,$like=NULL){
  
                $this->db->select($field);    
                $this->db->from($table);
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
            if($like):
                 $this->db->like($like);
            endif;
            $this->db->group_by('student_record.college_no');
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
    public function student_status_change_inter($table,$where=NULL)
    {
        $this->db->select('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status
                ');    
        $this->db->from($table);  
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where('student_record.s_status_id',5);
        $this->db->where('student_record.programe_id',1);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function student_status_change_degree($table,$where=NULL)
    {
        $this->db->select('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status
                ');    
        $this->db->from($table);  
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where('student_record.s_status_id',5);
        $this->db->where('student_record.programe_id',4);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function student_status_change_bcs($table,$where=NULL)
    {
        $this->db->select('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status
                ');    
        $this->db->from($table);  
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where('student_record.s_status_id',5);
        $this->db->where('student_record.programe_id',2);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function student_status_change_hnd($table,$where=NULL)
    {
        $this->db->select('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status
                ');    
        $this->db->from($table);  
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where('student_record.s_status_id',5);
        $this->db->where('student_record.programe_id',3);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
  
    public function getslots()
    {
        $pro = $this->db->get("class_slots");
        return $pro->result();
    }
    
    public function getdesig($table,$like=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as emp_name,
        hr_emp_designation.title as designation,
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        if($like):
        $this->db->like($like);
        endif;
        $this->db->where(array('hr_emp_record.cat_id'=>1,'emp_status_id'=>1));
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    } 
    
    public function getempnames($table,$like=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as emp_name,
        hr_emp_designation.title as designation,
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        if($like):
        $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getsubj($table,$like=NULL)
    {
       $this->db->select('
        subject.subject_id as subject_id,
        subject.title as title,
        sub_programes.name as sub_program,
       '); 
        $this->db->FROM('subject');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
        $this->db->order_by('subject.title','asc');
        if($like):
        $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getsubj1($table,$like=NULL)
    {
       $this->db->select('
        subject.subject_id as subject_id,
        subject.title as title,
        programes_info.programe_name as program,
       '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        if($like):
        $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getsub($table,$like=NULL)
    {
       $this->db->select('
        subject.subject_id as subject_id,
        subject.title as title,
        sub_programes.name as sub_program,
        sub_programes.flag,
       '); 
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'right outer');
        if($like):
        $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getsubBs($table,$like=NULL)
    {
       $this->db->select('
        subject.subject_id as subject_id,
        subject.title as title,
        sub_programes.name as sub_program,
        sub_programes.flag,
       '); 
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'right outer');
        if($like):
        $this->db->like($like);
        endif;
        $this->db->where_in('sub_programes.programe_id',array(2,8,9,14,17));
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getsubjects($table,$where=Null)
    {
       $this->db->select('
        subject.subject_id as subject_id,
        subject.title as subject,
        programes_info.programe_name as program,
        sub_programes.name as sub_program,
       '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
           if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function adminstudent_attendance($table)
    {
       $this->db->select('
        student_attendance.attend_id,
        student_attendance.attendance_date,
        student_attendance.timestamp as tdate,
        sections.*,
        programes_info.programe_name,
        class_alloted.*,
        student_attendance.*,
        subject.*,
        hr_emp_record.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=sections.program_id', 'left outer');
        $this->db->order_by('student_attendance.attend_id','desc');
        $this->db->order_by('student_attendance.attendance_date','desc');
        $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getstudent_attendance($table,$where=NULL)
    {
       $this->db->select('
        student_attendance.attend_id as attend_id,
        student_attendance.attendance_date as attendance_date,
        sections.*,
        class_alloted.*,
        student_attendance.*,
        subject.*,
        hr_emp_record.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->order_by('student_attendance.attend_id','desc');
        $this->db->order_by('student_attendance.attendance_date','desc');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
     public function getallotedsections($table){
        $this->db->select('
        class_alloted.class_id as class_id,
        subject.title as subject,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function view_attendance($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
        student_record.student_name as student_name,
        student_record.father_name as father_name,
        student_record.college_no as college_no,
        student_record.applicant_image as applicant_image,
        student_attendance_details.status as status,
        student_attendance_details.serial_no as serial_no,
        student_attendance_details.attend_id as attend_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_attendance_details.student_id', 'left outer');
        $this->db->where($where);
        $this->db->order_by('college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function view_pre_board_test_marks($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
        student_record.student_name as student_name,
        student_record.father_name as father_name,
        student_record.college_no as college_no,
        student_record.applicant_image as applicant_image,
        pre_board_test_details.omarks as omarks,
        pre_board_test_details.tmarks as tmarks,
        pre_board_test_details.serial_no as serial_no,
        pre_board_test_details.test_id as test_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=pre_board_test_details.student_id', 'left outer');
        $this->db->where($where);
        $this->db->order_by('college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function view_test_marks_list($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
        student_record.student_name as student_name,
        student_record.father_name as father_name,
        student_record.college_no as college_no,
        student_record.applicant_image as applicant_image,
        monthly_test_details.omarks as omarks,
        monthly_test_details.tmarks as tmarks,
        monthly_test_details.serial_no as serial_no,
        monthly_test_details.test_id as test_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=monthly_test_details.student_id', 'left outer');
        $this->db->where($where);
        $this->db->order_by('college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function employee_search_test($table,$where=NULL){
       
            $this->db->SELECT('
            monthly_test.test_date as test_date,
            monthly_test.test_id as test_id,
            class_alloted.class_id as class_id,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            sections.name as section,
            sections.sec_id as sec_id,
            subject.title as subject,
            subject.subject_id as subject_id,
            ');
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=monthly_test.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
       $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function getpreboard_test($table,$where=NULL)
    {
       $this->db->select('
        pre_board_test.test_id as test_id,
        pre_board_test.test_date as test_date,
        sections.*,
        class_alloted.*,
        pre_board_test.*,
        subject.*,
        hr_emp_record.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=pre_board_test.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->order_by('pre_board_test.test_id','desc');
        $this->db->order_by('pre_board_test.test_date','desc');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getstudent_test($table,$where=NULL)
    {
       $this->db->select('
        monthly_test.test_id as test_id,
        monthly_test.test_date as test_date,
        sections.*,
        class_alloted.*,
        monthly_test.*,
        subject.*,
        hr_emp_record.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=monthly_test.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->order_by('monthly_test.test_id','desc');
        $this->db->order_by('monthly_test.test_date','desc');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function admin_getstudent_test($table)
    {
       $this->db->select('
        monthly_test.test_id as test_id,
        monthly_test.test_date as test_date,
        sections.*,
        class_alloted.*,
        monthly_test.*,
        subject.*,
        hr_emp_record.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=monthly_test.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->order_by('monthly_test.test_id','desc');
        $this->db->order_by('monthly_test.test_date','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_alloted_subjects($table,$subwhere){
        $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.flag as flag,
        class_alloted.ca_merge_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        subject.programe_id as programe_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        class_alloted_merge_groups.camg_name
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
        $this->db->where($subwhere);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function get_alloted_merged($table,$subwhere){
        $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.flag as flag,
        class_alloted.ca_merge_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        subject.programe_id as programe_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        class_alloted_merge_groups.camg_name
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
        $this->db->where($subwhere);
        $this->db->order_by('sections.name');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function get_alloted_merged_group_by($table,$subwhere){
        $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.flag as flag,
        class_alloted.ca_merge_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        subject.programe_id as programe_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        class_alloted_merge_groups.camg_name
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
        $this->db->where($subwhere);
        $this->db->group_by('class_alloted.ca_merge_id');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function get_students_subjectAtts($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
        student_record.student_name as student,
        student_record.father_name as father,
        student_record.applicant_mob_no1 as student_number,
        student_record.mobile_no as father_number,
        student_record.applicant_image as applicant_image,
        student_record.college_no as college_no,
        subject.title as subject,
        subject.subject_id as subject_id,
        subject.sub_pro_id as sub_pro_id,
        sections.name as section
       ');  
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id', 'left outer');
        $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id', 'left outer');    
        $this->db->join('sections','sections.sec_id=student_subject_alloted.section_id', 'left outer');    
        $this->db->order_by('college_no','asc');
        $this->db->where($where);  
        $this->db->where('student_record.s_status_id','5');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }   
    
   public function get_alloted_subjectss($table,$where2){
        $this->db->select('
        class_alloted.class_id as class_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        subject.programe_id as programe_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->where($where2);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
   
    public function get_alloted_sections($table,$where){
        $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.flag as flag,
        class_alloted.ca_merge_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        class_alloted_merge_groups.camg_name
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
  public function admin_sections_list($table)
  {
        $this->db->select('
        class_alloted.class_id as class_id,
        subject.title as subject,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
       // $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function admin_subjects_list($table,$subwhere)
  {
         $this->db->select('
        class_alloted.class_id as class_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        subject.programe_id as programe_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->where($subwhere);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function admin_getsections_list($table,$where=NULL){
       
            $this->db->SELECT('
                class_alloted.class_id as class_id,
                subject.title as subject,
                subject.subject_id as subject_id,
                hr_emp_record.emp_name as employee,
                hr_emp_record.emp_id as emp_id,
                sections.name as section,
                sections.sec_id as sec_id
                ');
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function admin_search_historyn($table,$where=NULL){
            $this->db->SELECT('
            class_alloted.class_id as class_id,
            class_alloted.flag as flag,
            class_alloted.timestamp as timestamp,
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
            if($where):
                $this->db->where($where);
            endif;  
            $this->db->order_by('class_id','asc');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function student_Datainfo($table,$where=NULL)
    {
       $this->db->select('
        student_record.student_id,
        student_record.student_name,
        student_record.father_name,
        student_record.college_no,
        sub_programes.name as sub_program,
        programes_info.programe_name as program,
       '); 
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function student_attend_historyn($table,$where=NULL)
    {
       $this->db->select('
        student_comulative_attendance.*,
        student_record.student_name,
        subject.title as subject,
        sections.name as section,
        sub_programes.name as sub_program,
        programes_info.programe_name as program,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_comulative_attendance.student_id', 'left outer');
        $this->db->join('subject','subject.subject_id=student_comulative_attendance.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_comulative_attendance.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function student_monthlyMarks_history($table,$where=NULL)
    {
       $this->db->select('
        student_comulative_monthly_marks.*,
        student_record.student_name,
        subject.title as subject,
        sections.name as section,
        sub_programes.name as sub_program,
        programes_info.programe_name as program,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_comulative_monthly_marks.student_id', 'left outer');
        $this->db->join('subject','subject.subject_id=student_comulative_monthly_marks.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_comulative_monthly_marks.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function admin_search_history($table,$where=NULL){
       
            $this->db->SELECT('
            student_attendance.attendance_date as attendance_date,
            student_attendance.attend_id as attend_id,
            class_alloted.class_id as class_id,
            class_alloted.flag as flag,
            class_alloted.timestamp as timestamp,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            sections.name as section,
            sections.sec_id as sec_id,
            subject.title as subject,
            subject.subject_id as subject_id,
            ');
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
       $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
//   public function admin_search_history_new($table,$where=NULL){
//       
//            $this->db->SELECT('
//            student_attendance.attendance_date as attendance_date,
//            student_attendance.attend_id as attend_id,
//            class_alloted.class_id as class_id,
//            class_alloted.flag as flag,
//            class_alloted.timestamp as timestamp,
//            hr_emp_record.emp_name as employee,
//            hr_emp_record.emp_id as emp_id,
//            sections.name as section,
//            sections.sec_id as sec_id,
//            subject.title as subject,
//            subject.subject_id as subject_id,
//            ');
//        $this->db->FROM($table);
//        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
//        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
//        $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
//       $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
//            if($where):
//                $this->db->where($where);
//            endif;  
//            $query =  $this->db->get();
////            echo '<pre>'; print_r($query->result()); die;
//            if($query):
//                return $query->result();
//            endif;
//   }
    public function admin_search_history_new($table,$where=NULL,$from_date=NULL,$to_date=NULL){
       
            $this->db->SELECT('
            student_attendance.attendance_date as attendance_date,
            student_attendance.attend_id as attend_id,
            class_alloted.class_id as class_id,
            class_alloted.flag as flag,
            class_alloted.timestamp as timestamp,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            sections.name as section,
            sections.sec_id as sec_id,
            subject.title as subject,
            subject.subject_id as subject_id,
            student_attendance.timestamp as attendance_timestamp
            ');
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
       $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
       $this->db->order_by('sections.name','asc');
        if($from_date !="" && $to_date !=""):
                $this->db->where('student_attendance.attendance_date BETWEEN "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'"');
        endif;
       
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
   
    public function admin_search_history_bs($table,$where=NULL,$from_date=NULL,$to_date=NULL){
       
            $this->db->SELECT('
            student_attendance.attendance_date as attendance_date,
            student_attendance.attend_id as attend_id,
            class_alloted.class_id as class_id,
            class_alloted.flag as flag,
            class_alloted.timestamp as timestamp,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            sections.name as section,
            sections.sec_id as sec_id,
            subject.title as subject,
            subject.subject_id as subject_id,
            ');
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
       $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
       $this->db->order_by('sections.name','asc');
        if($from_date !="" && $to_date !=""):
                $this->db->where('student_attendance.attendance_date BETWEEN "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'"');
        endif;
       
            if($where):
                $this->db->where($where);
            endif;  
            $this->db->where_in('sections.program_id',array(2,8,9,14,17));
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
   
    public function teacher_base_subject_allotted($table,$where=NULL)
    {
       $this->db->select('
        class_alloted.class_id as class_id,
        subject.title as subject,
        hr_emp_record.emp_name as employee,
        sections.name as section,
        sub_programes.name as sub_program,
        programes_info.programe_name as program,
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function student_attend_history($table,$where=NULL)
    {
       $this->db->select('
        student_comulative_attendance.*,
        student_record.student_name,
        subject.title as subject,
        sections.name as section,
        sub_programes.name as sub_program,
        programes_info.programe_name as program,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_comulative_attendance.student_id', 'left outer');
        $this->db->join('subject','subject.subject_id=student_comulative_attendance.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_comulative_attendance.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
      //  $this->db->where('student_record.programe_id','1');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function student_attend_history_excel($table,$where=NULL)
    {
       $this->db->select('
        student_record.student_name,
        programes_info.programe_name as program,
        sub_programes.name as sub_program,
        sections.name as section,
        subject.title as subject,
        student_comulative_attendance.total_attend,
        student_comulative_attendance.p_attend,
        student_comulative_attendance.a_attend
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_comulative_attendance.student_id', 'left outer');
        $this->db->join('subject','subject.subject_id=student_comulative_attendance.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_comulative_attendance.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $this->db->where('student_record.programe_id','1');
        $query =  $this->db->get();
        if($query):
            return $query->result_array();
        endif;
    }
    
    public function degree_student_attend_history($table,$where=NULL)
    {
       $this->db->select('
        student_comulative_attendance.*,
        student_record.student_name,
        subject.title as subject,
        sections.name as section,
        sub_programes.name as sub_program,
        programes_info.programe_name as program,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_comulative_attendance.student_id', 'left outer');
        $this->db->join('subject','subject.subject_id=student_comulative_attendance.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_comulative_attendance.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $this->db->where('student_record.programe_id','4');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function degree_student_attend_history_excel($table,$where=NULL)
    {
       $this->db->select('
        student_record.student_name,
        programes_info.programe_name as program,
        sub_programes.name as sub_program,
        sections.name as section,
        subject.title as subject,
        student_comulative_attendance.total_attend,
        student_comulative_attendance.p_attend,
        student_comulative_attendance.a_attend
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_comulative_attendance.student_id', 'left outer');
        $this->db->join('subject','subject.subject_id=student_comulative_attendance.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_comulative_attendance.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $this->db->where('student_record.programe_id','4');
        $query =  $this->db->get();
        if($query):
            return $query->result_array();
        endif;
    }
    
    public function teacher_base_subject_excel($table,$where=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_name as employee,
        programes_info.programe_name as program,
        sub_programes.name as sub_program,
        sections.name as section,
        subject.title as subject,
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result_array();
        endif;
    }
    
    public function get_studentsAtts($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
        student_record.student_name as student,
        student_record.father_name as father,
         student_record.applicant_mob_no1 as student_number,
        student_record.mobile_no as father_number,
        student_record.applicant_image as applicant_image,
        student_record.college_no as college_no,
        sections.name as section,
        sections.sec_id as sec_id,
        sections.sub_pro_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->order_by('college_no','asc');
        $this->db->where($where);
        $this->db->where('student_record.s_status_id','5');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }    
    public function get_studentsAttsAll($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
//    public function get_employee_subject($table,$where){
//        $this->db->select('
//        hr_emp_record.emp_name as emp_name,
//        subject.title as title,
//        sections.name as section,
//       '); 
//        $this->db->FROM($table);
//        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
//        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
//        $this->db->where($where);
//        $query =  $this->db->get();
//        if($query):
//            return $query->result();
//        endif; 
//   }
    
    public function dailyAttendence($class_id, $attendance_date){
	$this->db->select("student_record.*, student_attendance_details.student_id as attendent_id");
	$this->db->join('student_attendance_details', 'student_attendance_details.student_id = student_record.student_id', 'left outer');
	$this->db->join('student_attendance', 'student_attendance.attend_id = student_attendance_details.attend_id', 'left outer');
	$this->db->where('student_attendance.class_id', '$class_id');
	$this->db->where('student_attendance.attendance_date', '$attendance_date');
	$q = $this->db->get('student_record');
	return $q->result();
}
    
    public function getclass_alloted($table,$where=NULL)
    {
       $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.ca_merge_id,
        class_alloted.timestamp,
        subject.title as subject,
        subject.subject_id as subject_id,
        sub_programes.name,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        class_alloted_merge_groups.camg_name
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getclass_alloted_merge($table,$where=NULL)
    {
       $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.ca_merge_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        sub_programes.name,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        class_alloted_merge_groups.camg_name
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $this->db->group_by('class_alloted_merge_groups.camg_id');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getsecEmp_Data($table,$where)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
            $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function class_alloted_excel($table,$where=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_name,
        sections.name,
        subject.title
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result_array();
        endif;
    }
    
    public function getclass_byid($table,$where)
    {
       $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.flag as flag,
        subject.subject_id as subject_id,
        subject.title as subject,
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as employee,
        sections.name as section,
        sections.sec_id as sec_id
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
    
    public function get_classData($where=NULL,$like=NULL)
    {
        $this->db->select('*'); 
        $this->db->FROM('student_group_allotment');
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $this->db->where('student_record.s_status_id','5');
        $this->db->order_by('student_record.college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_student_pre_board_test($where){
           
             $this->db->from('pre_board_test');
          $this->db->join('class_alloted','class_alloted.class_id=pre_board_test.class_id');
          $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
          $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
         $this->db->join('pre_board_test_details','pre_board_test_details.test_id=pre_board_test.test_id');
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }
    
    
    public function get_year_head_result($where=NULL,$like=NULL){
            $this->db->select(
                    '
                    student_record.student_id,
                    student_record.sub_pro_id,
                    student_name,
                    father_name,
                    college_no,
                    applicant_image,
                    sections.name as sections_name,
                    sections.sec_id
                    '
                    );
            $this->db->from('student_group_allotment');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
            $this->db->order_by('college_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            if($like):
                $this->db->like($like);
            endif;
            
            return $this->db->get()->result();
        }
        
                public function dropDown_yearHead($table, $option, $value,$show,$where=NULL){
		$this->db->select('*');
                 $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
                if($where):
                    $this->db->where($where);
                endif;
            
                $query = $this->db->get($table);
		 
		if($query->num_rows() > 0) 
		{
			$data[''] = $option;
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show.' - '.$row->name;
			}
			return $data;
		}
	}
    
    public function admin_search_practical_history($table,$where=NULL){
       
            $this->db->SELECT('
            practical_attendance.attendance_date as attendance_date,
            practical_attendance.attend_id as attend_id,
            practical_alloted.practical_class_id as class_id,
            practical_alloted.timestamp as timestamp,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            practical_group.group_name as section,
            practical_group.prac_group_id as sec_id,
            practical_subject.title as subject,
            practical_subject.prac_subject_id as subject_id,
            ');
        $this->db->FROM($table);
        $this->db->join('practical_alloted','practical_alloted.practical_class_id=practical_attendance.prac_class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
       $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function subject_inter_record($where=NULL,$like=NULL){
            
            $this->db->select(
                    ' 
                       student_record.student_name,
                       student_record.father_name,
                       student_record.college_no,
                       student_record.student_id,
                       sections.name as section_name,
                    ');
            $this->db->from('student_group_allotment');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
            if($like):
             $this->db->like($like);   
            endif;
 
             $this->db->where($where);
            $this->db->order_by('student_record.college_no','asc');
 
            return $this->db->get()->result();
        }
        public function get_subject_list($table,$where){
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('subject','subject.subject_id='.$table.'.subject_id');
            $this->db->where($where);
            return $this->db->get()->result();
 
        }
        public function get_students_studentAtts($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
        student_record.student_name as student,
        student_record.father_name as father,
        student_record.applicant_image as applicant_image,
        student_record.college_no as college_no,
        subject.subject_id as subject_id,
        subject.title as title,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id', 'left outer');
        $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->where('student_record.s_status_id','5');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    public function get_program_subject($table,$where,$like=NULL)
    {
       $this->db->select('
        subject.subject_id as subject_id,
        subject.title as title,
        programes_info.programe_name as program,
        sub_programes.name as sub_program,
       '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=subject.programe_id');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
        if($like):
        $this->db->like($like);
        endif;
        if($where):
        $this->db->where($where);
        endif;
        $this->db->order_by('program','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }    
//    
//    public function get_subject_results($table,$where=NULL){
//         $this->db->select('*');
//            $this->db->from($table);
//             $this->db->join('subject','subject.subject_id='.$table.'.subject_id');
//             $this->db->join('student_record','student_record.student_id='.$table.'.student_id');
//            $this->db->where($where);
//            return $this->db->get()->result();
//    }
//        public function get_subject_resultsExcel($table,$where=NULL){
//         $this->db->select(
//                 'college_no,
//                  student_name,
//                  father_name,
//                  title
//                   '
//                 );
//            $this->db->from($table);
//             $this->db->join('subject','subject.subject_id='.$table.'.subject_id');
//             $this->db->join('student_record','student_record.student_id='.$table.'.student_id');
//            $this->db->where($where);
//            return $this->db->get()->result_array();
//    }
    
    public function cs_alloted_sections($table,$where){
        $this->db->select('
        class_alloted.class_id as class_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        hr_emp_record.emp_name as employee,
        department.title as department,
        department.department_id as department_id,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->where($where);
       $this->db->where('department.department_id','1');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
   
   public function cs_alloted_subjects($table,$subwhere){
        $this->db->select('
        class_alloted.class_id as class_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        subject.programe_id as programe_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        department.title as department,
        hr_emp_record.department_id as department_id,
        sections.name as section,
        sections.sec_id as sec_id
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->where($subwhere);
        $this->db->where('hr_emp_record.department_id','1');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
   
   public function csstudent_attendance($table)
    {
       $this->db->select('
        student_attendance.attend_id as attend_id,
        student_attendance.attendance_date as attendance_date,
        sections.*,
        class_alloted.*,
        student_attendance.*,
        subject.*,
        hr_emp_record.*,
        department.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->order_by('student_attendance.attend_id','desc');
        $this->db->order_by('student_attendance.attendance_date','desc');  
        $this->db->where('hr_emp_record.department_id','1');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function cs_getsections_list($table,$where=NULL){

        $this->db->SELECT('
            class_alloted.class_id as class_id,
            subject.title as subject,
            subject.subject_id as subject_id,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            department.department_id as department_id,
            sections.name as section,
            sections.sec_id as sec_id
            ');
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->where('hr_emp_record.department_id','1');
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
   
    public function cs_alloted_subjectss($table,$where2){
        $this->db->select('
        class_alloted.class_id as class_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        subject.programe_id as programe_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        department.department_id as department_id,
        sections.name as section,
        sections.sec_id as sec_id
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->where($where2);
        $this->db->where('hr_emp_record.department_id','1');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
 
    public function student_subProgram($table,$where=NULL)
    {
       $this->db->select('student_comulative_attendance.sub_pro_id,sub_programes.name'); 
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_comulative_attendance.sub_pro_id', 'left outer');
         if($where):
            $this->db->where($where);
            $this->db->group_by('student_comulative_attendance.sub_pro_id');
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
       
    public function get_subject_results($where=NULL){
 
         $this->db->select(
                 '
                     subject.title,
                     hr_emp_record.emp_name,
                     sections.name,
                     subject.subject_id,
                     sections.sec_id,
                     class_alloted.flag,
                '
                 );
            $this->db->from('class_alloted');
              $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
              $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
//                $this->db->join('student_subject_alloted','student_subject_alloted.subject_id=subject.subject_id');
              $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
             // $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
             $this->db->where($where);
            return $this->db->get()->result();
    }
    public function get_subject_resultsExcel($table,$where=NULL){
         $this->db->select(
                 'college_no,
                  student_name,
                  father_name,
                  title
                   '
                 );
            $this->db->from($table);
             $this->db->join('subject','subject.subject_id='.$table.'.subject_id');
             $this->db->join('student_record','student_record.student_id='.$table.'.student_id');
            $this->db->where($where);
            return $this->db->get()->result_array();
    }
    
    public function sub_report_inter_subject($where){
           $this->db->select(
                '
                student_record.college_no,
                student_record.student_name,
                student_record.father_name,
                sections.name,
                '
                );
        $this->db->from('student_subject_alloted');
        $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
        $this->db->join('sections','sections.sec_id=student_subject_alloted.section_id');
        $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id');
        $this->db->where($where);
        return $this->db->get()->result();
    }
    public function sub_report_inter_subjectExcel($where){
           $this->db->select(
                '
                student_record.college_no,
                student_record.student_name,
                student_record.father_name,
                sections.name,
                 '
                );
        $this->db->from('student_subject_alloted');
        $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
        $this->db->join('sections','sections.sec_id=student_subject_alloted.section_id');
        $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id');
        $this->db->where($where);
        return $this->db->get()->result_array();
    }
    public function sub_report_inter_session($where){
           $this->db->select(
                '
                student_record.college_no,
                student_record.student_name,
                student_record.father_name,
                sections.name,
                '
                );
        $this->db->from('student_group_allotment');
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
         $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
        //$this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id','left outer');
        $this->db->where($where);
        return $this->db->get()->result();
    }
    public function sub_report_inter_sessionExcel($where){
           $this->db->select(
                '
                student_record.college_no,
                student_record.student_name,
                student_record.father_name,
                sections.name,
                '
                );
        $this->db->from('student_group_allotment');
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
         $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
        //$this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id','left outer');
        $this->db->where($where);
        return $this->db->get()->result_array();
    }
    
    public function getsub_pro_program($table,$like=NULL)
    {
       $this->db->select('
        sub_programes.sub_pro_id as sub_pro_id,
        sub_programes.name as name,
        programes_info.programe_name as program
       '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id', 'right outer');
        if($like):
        $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getlabs()
    {
        $pro = $this->db->get("labs");
        return $pro->result();
    }
    
     public function getpracticalgroups($table, $where=NULL)
    {
        $this->db->select('*');
        $this->db->FROM($table);
        $this->db->join('labs','labs.lab_id=practical_group.lab_id','left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_group.subject_id','left outer');
        if($where):
            $this->db->where($where);
        endif;
      
        $pro = $this->db->get();
        return $pro->result();
    }
    
    public function getpractical_group_allottment()
    {
        $this->db->select('*');
        $this->db->FROM('student_prac_group_allottment');
        $this->db->join('student_record','student_record.student_id=student_prac_group_allottment.student_id','left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id','left outer');
        $pro = $this->db->get();
        return $pro->result();
    }
    
    public function getpractical_alloted($table,$where=NULL)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getsubjecs($table,$like=NULL)
    {
       $this->db->select('
        subject.subject_id as subject_id,
        subject.title as title,
        sub_programes.name as sub_program,
        sub_programes.sub_pro_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'right outer');
        if($like):
        $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function search_student_group($table,$where=NULL,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
   
   public function getgroup_byid($table,$where)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('labs','labs.lab_id=practical_group.lab_id','left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_group.subject_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function prac_studentsAtts($table,$where){
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id', 'left outer');
        $this->db->join('student_record','student_record.college_no=student_prac_group_allottment.college_no', 'left outer');
        $this->db->order_by('student_prac_group_allottment.college_no','asc');
        $this->db->where($where);
        $this->db->where('student_record.s_status_id','5');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
   
   public function getallotedgroups($table){
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
   
   public function get_alloted_groups($table,$where){
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
$this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
   
   public function getpractical_attendance($table,$where=NULL)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('practical_alloted','practical_alloted.practical_class_id=practical_attendance.prac_class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->order_by('practical_attendance.attend_id','desc');
        $this->db->order_by('practical_attendance.attendance_date','desc');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function view_prac_attendance($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('student_prac_group_allottment','student_prac_group_allottment.college_no=practical_attendance_details.college_no', 'left outer');
        $this->db->where($where);
        $this->db->order_by('student_prac_group_allottment.college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
   
  public function adminget_alloted_groups($table,$where=NULL){
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
$this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
   
   public function get_adminpractical_attendance($table)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('practical_alloted','practical_alloted.practical_class_id=practical_attendance.prac_class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
$this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $this->db->order_by('practical_attendance.attend_id','desc');
        $this->db->order_by('practical_attendance.attendance_date','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function admin_practical_attendance_history($table,$where=NULL)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('practical_alloted','practical_alloted.practical_class_id=practical_attendance.prac_class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function admin_practical_attendance_history_new($table,$where=NULL,$from_date=NULL,$to_date=NULL)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('practical_alloted','practical_alloted.practical_class_id=practical_attendance.prac_class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($from_date !="" && $to_date !=""):
                $this->db->where('practical_attendance.attendance_date BETWEEN "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'"');
        endif;
       $this->db->order_by('practical_group.group_name','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getpracticalstudents($table,$where){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('practical_group','practical_group.subject_id=practical_subject.prac_subject_id');
        $this->db->join('student_prac_group_allottment','student_prac_group_allottment.group_id=practical_group.prac_group_id');
    $this->db->join('student_record','student_record.student_id=student_prac_group_allottment.student_id');
    $this->db->join('gender','gender.gender_id=student_record.gender_id');
    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->where($where);
        return $this->db->get()->result();
    }
    
    public function admin_test_history($table,$where=NULL){
       
            $this->db->SELECT('
            monthly_test.test_date as test_date,
            monthly_test.test_id as test_id,
            class_alloted.class_id as class_id,
            class_alloted.flag as flag,
            class_alloted.timestamp as timestamp,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            sections.name as section,
            sections.sec_id as sec_id,
            sections.sub_pro_id as sub_pro_id,
            subject.title as subject,
            subject.subject_id as subject_id
            ');
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=monthly_test.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
       $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
   
   public function getupd_student_attendance_Before_COVID_Split($table,$where=NULL)
    {
        $this->db->select('
        student_attendance.attend_id as attend_id,
        student_attendance.attendance_date as attendance_date,
        sections.*,
        class_alloted.*,
        student_attendance.*,
        subject.*,
        hr_emp_record.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->order_by('student_attendance.attend_id','desc');
        $this->db->order_by('student_attendance.attendance_date','desc');
        $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
      public function getupd_student_attendance($table,$where=NULL){
       $current_date    = date('Y-m-d');
       $p_days_date     = date('Y-m-d', strtotime('-7 days'));
       
        $this->db->select('
        student_attendance.attend_id as attend_id,
        student_attendance.attendance_date as attendance_date,
        sections.*,
        class_alloted.*,
        student_attendance.*,
        subject.*,
        hr_emp_record.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->order_by('student_attendance.attend_id','desc');
        $this->db->order_by('student_attendance.attendance_date','desc');
        
        $this->db->where('attendance_date BETWEEN "'.$p_days_date.'" and "'.$current_date.'"');
//        $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    public function getemp_name($table,$like=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as emp_name,
        hr_emp_designation.title as designation,
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        if($like):
        $this->db->like($like);
        endif;
        $this->db->where('hr_emp_record.cat_id',2);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    } 
    
    public function get_SectionsList($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
            $this->db->like($like);  
        endif;
        $this->db->where('status','On');
         $query = $this->db->get();
        return $query->result();
    }
    
     public function get_practicalData($where=NULL,$like=NULL)
    {
        $this->db->select('*'); 
        $this->db->FROM('student_prac_group_allottment');
        $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id', 'left outer');
        $this->db->join('student_record','student_record.college_no=student_prac_group_allottment.college_no'); 
        $this->db->where('s_status_id',5);
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
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
    
    public function get_practicalData_excel($where=NULL,$like=NULL)
    {
        $this->db->select('student_prac_group_allottment.college_no,'); 
        $this->db->select('student_prac_group_allottment.student_name,'); 
        $this->db->select('practical_group.group_name,'); 
        $this->db->FROM('student_prac_group_allottment');
        $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result_array();
        endif;
    }
    
    public function get_PracDataRow($where)
    {
        $this->db->select('*'); 
        $this->db->FROM('student_prac_group_allottment');
        $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id', 'left outer');
            $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function getprac_class_byid($table,$where)
    {
       $this->db->select('
        practical_alloted.practical_class_id,
        practical_subject.prac_subject_id as subject_id,
        practical_subject.title as subject,
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as employee,
        practical_group.group_name as section,
        practical_group.prac_group_id as sec_id
       '); 
    $this->db->FROM($table);
    $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
    $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
    $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function practical_timetablerow($table,$where){
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('days','days.day_id=practical_timetable.day_id', 'left outer');
        $this->db->join('class_starting_time','class_starting_time.stime_id=practical_timetable.stime_id', 'left outer');
        $this->db->join('class_ending_time','class_ending_time.etime_id=practical_timetable.etime_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
   }
    
    public function getpracticalchange_attendance($table,$where=NULL)
    {
       $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('practical_alloted','practical_alloted.practical_class_id=practical_attendance.prac_class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id', 'left outer');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id', 'left outer');
        $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id', 'left outer');
        $this->db->order_by('practical_attendance.attend_id','desc');
        $this->db->order_by('practical_attendance.attendance_date','desc');
        $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function view_change_prac_attendance($table,$where){
        $this->db->select('student_prac_group_allottment.college_no,student_prac_group_allottment.student_name,practical_attendance_details.*'); 
        $this->db->FROM($table);
        $this->db->join('student_prac_group_allottment','student_prac_group_allottment.college_no=practical_attendance_details.college_no', 'left outer');
        $this->db->where($where);
        $this->db->order_by('student_prac_group_allottment.college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }

public function get_teacher_subjects_student_degree_section($where=NULL){
       
         $this->db->select(
                '
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                student_record.college_no,
                sections.name as sectionName,
               
                ');
            $this->db->from('student_group_allotment');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
 
         if($where):
               $this->db->where($where);
         endif;
$this->db->where('student_record.s_status_id','5');
         return $this->db->get()->result();
         
   }
    
    public function get_teacher_subjects_student_degree_subjects($where=NULL){
       
         $this->db->select(
                '
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                student_record.college_no,
                sections.name as sectionName,
                ');
              $this->db->from('student_subject_alloted');
             $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id');
             $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
             $this->db->join('sections','sections.sec_id=student_subject_alloted.section_id');
         if($where):
               $this->db->where($where);
         endif;
$this->db->where('student_record.s_status_id','5');
         return $this->db->get()->result();
         
   }
    
    public function get_student_attendance_row($where=NULL){
      
            $this->db->from('class_alloted');
            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
            $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
            $this->db->where($where);
    return  $this->db->get()->row();
                      
}

    public function law_student_attendance($table)
    {
       $this->db->select('
        student_attendance.attend_id as attend_id,
        student_attendance.attendance_date as attendance_date,
        sections.*,
        class_alloted.*,
        student_attendance.*,
        subject.*,
        hr_emp_record.*,
        department.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->order_by('student_attendance.attend_id','desc');
       // $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $this->db->where('attendance_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 DAY) AND NOW()');
        $this->db->where('sections.program_id','9');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function present_daily_students()
    {
       $this->db->select('
        student_attendance_details.*,
        student_attendance.*,
        '); 
        $this->db->FROM('student_attendance_details');
        $this->db->join('student_attendance','student_attendance.attend_id=student_attendance_details.attend_id');
        $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $this->db->where('student_attendance_details.status','1');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function absent_daily_students()
    {
       $this->db->select('
        student_attendance_details.*,
        student_attendance.*,
        '); 
        $this->db->FROM('student_attendance_details');
        $this->db->join('student_attendance','student_attendance.attend_id=student_attendance_details.attend_id');
        $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $this->db->where('student_attendance_details.status','0');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function total_daily_students()
    {
       $this->db->select('
        student_attendance_details.*,
        student_attendance.*,
        '); 
        $this->db->FROM('student_attendance_details');
        $this->db->join('student_attendance','student_attendance.attend_id=student_attendance_details.attend_id');
        $this->db->where('attendance_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function admin_getpre_board_test($table)
    {
       $this->db->select('
        sections.*,
        class_alloted.*,
        pre_board_test.*,
        subject.*,
        hr_emp_record.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=pre_board_test.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->order_by('pre_board_test.test_date','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function admin_pre_board_test_history($table,$where=NULL){
       
            $this->db->SELECT('
            pre_board_test.test_date as test_date,
            pre_board_test.test_id as test_id,
            class_alloted.class_id as class_id,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            sections.name as section,
            sections.sec_id as sec_id,
            subject.title as subject,
            subject.subject_id as subject_id,
            ');
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=pre_board_test.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
       $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;  
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function view_pre_board_test_marks_list($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
        student_record.student_name as student_name,
        student_record.father_name as father_name,
        student_record.college_no as college_no,
        student_record.applicant_image as applicant_image,
        pre_board_test_details.omarks as omarks,
        pre_board_test_details.tmarks as tmarks,
        pre_board_test_details.serial_no as serial_no,
        pre_board_test_details.test_id as test_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=pre_board_test_details.student_id', 'left outer');
        $this->db->where($where);
        $this->db->order_by('college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function hod_test_history($table,$where=NULL){
       
            $this->db->SELECT('
            monthly_test.test_date as test_date,
            monthly_test.test_id as test_id,
            class_alloted.class_id as class_id,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            sections.name as section,
            sections.sec_id as sec_id,
            subject.title as subject,
            subject.subject_id as subject_id,
            subject.programe_id as programe_id,
            ');
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=monthly_test.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
       $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('subject.programe_id','1');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function hod_pre_board_test_history($table,$where=NULL){
       
            $this->db->SELECT('
            pre_board_test.test_date as test_date,
            pre_board_test.test_id as test_id,
            class_alloted.class_id as class_id,
            hr_emp_record.emp_name as employee,
            hr_emp_record.emp_id as emp_id,
            sections.name as section,
            sections.sec_id as sec_id,
            subject.title as subject,
            subject.subject_id as subject_id,
            subject.programe_id as programe_id,
            ');
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=pre_board_test.class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
       $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('subject.programe_id','1');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function getStdhnd($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->where('programe_id','3'); 
        if($like):
            $this->db->like('student_name',$like);    
            $this->db->or_like('college_no',$like);    
        endif;   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function get_SectionInterList($table,$like=NULL){
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
            $this->db->like($like);  
        endif;
        $this->db->where('status','On');
        $this->db->where('program_id','1');
         $query = $this->db->get();
        return $query->result();
    }
    public function get_SectionListBS($table,$like=NULL){
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
            $this->db->like($like);  
        endif;
        $this->db->where('status','On');
        $this->db->where_in('program_id',array(2,8,9,14,17));
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_SectionList($table,$like=NULL){
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
            $this->db->like($like);  
        endif;
        $this->db->where('status','On');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function subject_inter_record_logs($where=NULL,$like=NULL){
            
            $this->db->select(
                    ' 
                       student_record.student_name,
                       student_record.father_name,
                       student_record.college_no,
                       student_record.student_id,
                       sections.name as section_name,
                       student_record.user_id,
                    ');
            $this->db->from('student_group_allotment');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
            if($like):
             $this->db->like($like);   
            endif;
 
             $this->db->where($where);
            $this->db->order_by('student_record.college_no','asc');
 
            return $this->db->get()->result();
        }
        
        public function subject_a_level_record_logs($where=NULL,$like=NULL){
            
            $this->db->select(
                    ' 
                       student_record.student_name,
                       student_record.father_name,
                       student_record.college_no,
                       student_record.student_id,
                       sections.name as section_name,
                       student_record.user_id,
                    ');
            $this->db->from('student_group_allotment');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
            if($like):
             $this->db->like($like);   
            endif;
 
             $this->db->where($where);
            $this->db->order_by('student_record.college_no','asc');
 
            return $this->db->get()->result();
        }
        
        public function get_subject_group_list($table,$where=NULL){
             
            $this->db->join('users','users.id='.$table.'.user_id');
            $this->db->where($where);
            $this->db->group_by('timestamp');
            return $this->db->get($table)->result();
        }
        
         public function getPromotionHistory($table){
        $this->db->select('
        student_promotions_date_history.serial_no,
        programes_info.programe_name as pro_title,
        sub_programes.name as sub_pro_title,
        student_promotions_date_history.date,
        student_promotions_date_history.comments,
       '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=student_promotions_date_history.programme', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_promotions_date_history.sub_program', 'left outer');
        $this->db->order_by('student_promotions_date_history.serial_no','desc');
        $this->db->order_by('student_promotions_date_history.date','desc');
        
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
       public function full_defaulter_attendance($where=Null,$amount=NULL,$like=NULL){
     
         
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        prospectus_batch.batch_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                    '
                    );
            
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
             $this->db->order_by('sub_programes.sub_pro_id','asc');
            if($where):
                    $this->db->where($where);
            endif;
                if($like):
                    $this->db->like($like);
                endif; 
                       $this->db->order_by('student_record.college_no','asc');
            $result =  $this->db->get('student_record')->result();
//             echo '<pre>';print_r($result);die;  
            $balance_array = '';
            foreach($result as $students):
                
        //**************************************
        //Fee Balance 
        //**************************************
                                $this->db->select('fc_challan_id,balance,old_credit_amount,actual_amount');    
                                $this->db->order_by('fc_challan_id','asc');
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id))->result();
             
              $fee_balance          = '';
              $old_credit_amount    = '';
               
              
                foreach($challan_info as $blc):
                        
                      
                      $fee_balance          +=$blc->balance;  
                      $old_credit_amount    +=$blc->old_credit_amount;  
                    
                endforeach;
               if($fee_balance>0):
                   $show_balance = $fee_balance;
                  $data_fee = array(
                  'student_id'      => $students->student_id,  
                  'balance'         => $show_balance,  
                  'default_type'    => 1,  
                  'userId'          => $this->userInfo->user_id,  
                  'timestamp'       => date('Y-m-d H:i:s'),  
                   
                );
                $this->CRUDModel->insert('fee_defaulter',$data_fee);
               
               endif; 
              
                //**************************************
                //Hostel Balance 
                //**************************************
                                    $this->db->select('hostel_student_bill.id,balance,hostel_student_record.student_id');
                                    $this->db->order_by('hostel_student_bill_info.id','asc');
                                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                $hostel_record =   $this->db->get_where('hostel_student_record',array('student_id'=>$students->student_id,'head_type'=>1))->result();
                if(!empty($hostel_record)):
                    $hostel_balance = '';
                    foreach($hostel_record as $hos_bal):
                        
                        $hostel_balance +=$hos_bal->balance;
                    
                    endforeach;
                    
                    if($hostel_balance>0):
                            $data_hostel = array(
                            'student_id'      => $students->student_id,  
                            'balance'         => $hostel_balance,  
                            'default_type'    => 1,  
                            'userId'            => $this->userInfo->user_id,  
                            'timestamp'         => date('Y-m-d H:i:s'),    
                          );
                       $this->CRUDModel->insert('fee_defaulter',$data_hostel);

                        
                        
                    endif;
                  endif;
                //**************************************
                //Mess Balance 
                //**************************************
                                    $this->db->select('hostel_student_bill.id,balance,hostel_student_record.student_id');
                                    $this->db->order_by('hostel_student_bill_info.id','asc');
                                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                $mess_record =      $this->db->get_where('hostel_student_record',array('student_id'=>$students->student_id,'head_type'=>2))->result();
               
                if(!empty($mess_record)):
                   
                    $mess_balance = '';
                    foreach($mess_record as $mess_bal):
                        
                        $mess_balance +=$mess_bal->balance;
                    
                    endforeach;
                    
                    if($mess_balance>0):
                        
                            $data_mess = array(
                            'student_id'      => $students->student_id,  
                            'balance'         => $mess_balance,  
                            'default_type'    => 1,  
                            'userId'       => $this->userInfo->user_id,
                            'timestamp'    => date('Y-m-d H:i:s'),

                          );
                       $this->CRUDModel->insert('fee_defaulter',$data_mess);

                        
                        
                    endif;
                  endif;
                                    $this->db->select_sum('balance');
                                    if($amount):
                                        $this->db->where('balance >=',$amount);
                                    endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>1,'userId'=>$this->userInfo->user_id))->row();
                  
                  if($balance_result->balance > 0):
                      $attendance = $this->CRUDModel->get_student_attendance($students->student_id,$students->sec_id);
                        $marks = $this->CRUDModel->get_student_montly_marks($students->student_id,$students->sec_id);
        $balance_array = array(
            
             
                   'sub_pro_id'     => $students->sub_pro_id,
                   'programe_id'     => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'student_id'     => $students->student_id,
                   'prospectus_batch'=> $students->batch_name,
                   'form_no'        => $students->form_no,
                   'sub_program'     => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'student_status' => $students->student_status,
                   'balance'        => $balance_result->balance,
                   'attendance'     => $attendance,
                    'marks'         => $marks,
                 );
                  endif;
                 
                  
                  
            endforeach;
            
//       echo '<pre>';print_r($balance_array);
       return   json_decode(json_encode($balance_array), FALSE);
}
public function practical_group_chart(){
            $this->db->select('
                    practical_group.group_name,
                    practical_group.prac_group_id,
                    count(student_prac_group_allottment.college_no) as counts
                    ');
            $this->db->join('student_record','student_record.college_no=student_prac_group_allottment.college_no');
            $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id');
            $this->db->group_by('practical_group.prac_group_id');
   return   $this->db->get_where('student_prac_group_allottment',array('s_status_id'=>5))->result();
    
}

    public function sectionwise_cumulative_result($where)
    {
        $this->db->SELECT('
            student_comulative_attendance.*,
            student_record.college_no,
            student_record.student_name,
            student_record.father_name,
            sections.name as sectionName,
            ');
        $this->db->FROM('student_comulative_attendance');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=student_comulative_attendance.emp_id', 'left outer');
        $this->db->join('student_record','student_record.student_id=student_comulative_attendance.student_id', 'left outer');
        $this->db->join('subject','subject.subject_id=student_comulative_attendance.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_comulative_attendance.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.programe_id=programes_info.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_comulative_attendance.sec_id', 'left outer');
        $this->db->where($where);
//        $this->db->group_by('student_comulative_attendance.student_id');
//        $this->db->order_by('practical_timetable.stime_id','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }

    public function get_title_cumulative($where){
        $this->db->select('
                sections.name as section_name,
                sub_programes.name as sub_progamme,
                programes_info.programe_name,
                prospectus_batch.batch_name
            ');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=sections.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=sections.program_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=sections.batch_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif; 
        $query =  $this->db->get('sections')->row();
        if($query):
            return $query;
        endif;
    }

    public function getDBUser($table,$like=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as emp_name,
        users.id as dbuser_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->where(array('users.user_status'=>1, 'hr_emp_record.cat_id'=>1,'emp_status_id'=>1));
        if($like):
        $this->db->like($like);
        endif;
        
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    } 
    
    public function getDBUserWhere($table,$where=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as emp_name,
        users.id as dbuser_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        if($where):
        $this->db->where($where);
        endif;
        $this->db->where(array('users.user_status'=>1, 'hr_emp_record.cat_id'=>1));
        $query =  $this->db->get()->row();
        if($query):
            return $query;
        endif;
    } 
    
    public function getstudent_exam($table,$where=NULL)
    {
       $this->db->select('
        exams_bs.*,
        sections.*,
        class_alloted.*,
        subject.subject_id as sbj_id,
        subject.title as subject_name,
        hr_emp_record.*,
        exam_types.*
       '); 
        $this->db->FROM($table);
        $this->db->join('class_alloted','class_alloted.class_id=exams_bs.exb_class_id', 'left outer');
        $this->db->join('exam_types','exam_types.xt_id=exams_bs.exb_test_type', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
//        $this->db->order_by('exams_bs.exb_test_id','desc');
        $this->db->order_by('exams_bs.exb_test_date','desc');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
     
    public function view_exam_marks_list($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
        student_record.student_name as student_name,
        student_record.father_name as father_name,
        student_record.college_no as college_no,
        student_record.applicant_image as applicant_image,
        exams_bs_details.exbd_omarks as omarks,
        exams_bs.exb_test_marks as tmarks,
        exams_bs_details.exbd_serial_no as serial_no,
        exams_bs_details.exbd_test_id as test_id,
        subject.subject_id as sbj_id,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=exams_bs_details.exbd_student_id', 'left outer');
        $this->db->join('exams_bs','exams_bs.exb_test_id=exams_bs_details.exbd_test_id', 'left outer');
        $this->db->join('class_alloted','class_alloted.class_id=exams_bs.exb_class_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->where($where);
        $this->db->order_by('college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
     
    public function get_omarks_update($table,$where){
        $this->db->select('
        student_record.student_id as student_id,
        student_record.student_name as student_name,
        student_record.father_name as father_name,
        student_record.college_no as college_no,
        student_record.applicant_image as applicant_image,
        exams_bs_details.*,
        exams_bs.*,
       '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=exams_bs_details.exbd_student_id', 'left outer');
        $this->db->join('exams_bs','exams_bs.exb_test_id=exams_bs_details.exbd_test_id', 'left outer');
        $this->db->where($where);
        $this->db->order_by('college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif; 
   }

    public function get_alloted_sections_bs($table,$where){
        $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.flag as flag,
        class_alloted.ca_merge_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        class_alloted_merge_groups.camg_name
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
        $this->db->where($where);
        $this->db->where_in('subject.programe_id',array(2,6,8,9,14,17));
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
    
    public function get_alloted_subjects_bs($table,$subwhere){
        $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.flag as flag,
        class_alloted.ca_merge_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        subject.programe_id as programe_id,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id as emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        class_alloted_merge_groups.camg_name
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
        $this->db->where($subwhere);
        $this->db->where_in('subject.programe_id',array(2,6,8,9,14,17));
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif; 
   }
     
    public function get_def_disc_actions($table)
    {
       $query = $this->db->select('
       proctorial_fine.*,
       proctorial_fine_type.*,
       proctorial_fine_status.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,           
       student_record.form_no,           
       student_record.s_status_id as sst_id,           
       student_status.name as student_status,           
       student_record.applicant_image,
       programes_info.programe_name as program,
        sections.name as std_section,
       sub_programes.name as sub_program,
            hr_emp_record.emp_name
        ')
    ->from($table)
    ->join('student_record','student_record.student_id=proctorial_fine.student_id','left outer')  
    ->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer')  
    ->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer')  
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
    ->join('proctorial_fine_type','proctorial_fine_type.proc_type_id=proctorial_fine.proc_type_id','left outer')
    ->join('proctorial_fine_status','proctorial_fine_status.proc_status_id=proctorial_fine.proc_status_id','left outer')
    ->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer')
    ->join('sections','sections.sec_id=student_group_allotment.section_id','left outer')
    ->join('users','users.id=proctorial_fine.proc_user_id','left outer')
    ->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId','left outer')
    ->order_by('proc_id','desc')
    ->where(array('student_record.s_status_id'=>5))
     ->get();
        return $query->result();  
    }
    
    public function get_single_disc_action($where=NULL)
    {
        $this->db->select('
            proctorial_fine.*,
            proctorial_fine_type.*,
            proctorial_fine_status.*,
            student_record.student_name,           
            student_record.father_name,           
            student_record.college_no,            
            student_record.form_no,  
            student_record.applicant_mob_no1,  
            student_record.mobile_no, 
            student_record.applicant_image,  
            student_record.s_status_id as sst_id,    
            student_status.name as student_status,          
            student_record.applicant_image,
            programes_info.programe_name as program,
            sections.name as std_section,
            student_status.name as std_status,
            sub_programes.name as sub_program,
            hr_emp_record.emp_name
        ');
        $this->db->FROM('proctorial_fine');
        $this->db->join('student_record','student_record.student_id=proctorial_fine.student_id','left outer');  
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer') ; 
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $this->db->join('proctorial_fine_type','proctorial_fine_type.proc_type_id=proctorial_fine.proc_type_id','left outer');
        $this->db->join('proctorial_fine_status','proctorial_fine_status.proc_status_id=proctorial_fine.proc_status_id','left outer');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
        $this->db->join('users','users.id=proctorial_fine.proc_user_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId','left outer');
     if($where):   
       $this->db->where($where);
     endif;       
     $query = $this->db->get();
        return $query->row();  
    }
      
    
    public function search_def_disc_actions($table, $where=NULL, $like=NULL)
    {
        $this->db->select('
        proctorial_fine.*,
        proctorial_fine_type.*,
        proctorial_fine_status.*,
        student_record.student_name,           
        student_record.father_name,           
        student_record.college_no,            
        student_record.form_no,  
        student_record.applicant_mob_no1,  
        student_record.mobile_no,   
        student_record.s_status_id as sst_id,    
        student_status.name as student_status,          
        student_record.applicant_image,
        programes_info.programe_name as program,
        sections.name as std_section,
        sub_programes.name as sub_program,
        hr_emp_record.emp_name
        ');
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=proctorial_fine.student_id','left outer');  
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer') ; 
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $this->db->join('proctorial_fine_type','proctorial_fine_type.proc_type_id=proctorial_fine.proc_type_id','left outer');
        $this->db->join('proctorial_fine_status','proctorial_fine_status.proc_status_id=proctorial_fine.proc_status_id','left outer');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
        $this->db->join('users','users.id=proctorial_fine.proc_user_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId','left outer');
     if($where):   
       $this->db->where($where);
     endif;    
     if($like):   
       $this->db->like($like);
     endif;    
     $query = $this->db->get();
        return $query->result();  
    }
      
    public function get_students_disc($table,$like=NULL)
    {
        $this->db->SELECT('
        student_record.*,
        sub_programes.name as sub_program,
        student_status.name as std_status,
        sections.name as std_section,
        ');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where_in('student_record.s_status_id',array(5));   
//        $this->db->where('programe_id =','2');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function get_single_std_disc($where=NULL)
    {
        $this->db->SELECT('
        student_record.*,
        sub_programes.name as sub_program,
        student_status.name as std_status,
        sections.name as std_section,
        ');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
        $this->db->FROM('student_record');
        if($where):
            $this->db->where($where);
        endif;   
         $query = $this->db->get();
        return $query->row();
        
    }
    
}
