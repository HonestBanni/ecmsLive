<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class TourModel extends CI_Model
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
    
    public function getEmployees($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        if($like):
            $this->db->like('emp_name',$like);    
            $this->db->or_like('current_designation',$like);    
        endif;
         $query = $this->db->get();
        return $query->result();
    }
    
    public function getStudents($table,$like=NULL)
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
    
    public function getstudents_record()
    {
        $this->db->select('*'); 
        $this->db->FROM('tour_details_demo');
 $this->db->join('student_record','student_record.student_id=tour_details_demo.student_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=tour_details_demo.sub_pro_id','left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getToursList($where)
    {
     $query = $this->db->select('*')
        ->FROM('tours')   
    ->join('hr_emp_record','hr_emp_record.emp_id=tours.emp_id', 'left outer')
        ->where($where)
        ->order_by('tour_id','desc')
         ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getadminToursList()
    {
     $query = $this->db->select('*')
        ->FROM('tours')   
    ->join('hr_emp_record','hr_emp_record.emp_id=tours.emp_id', 'left outer')
        ->order_by('tour_id','desc')
         ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_TourRecord($table,$wheredata)
    {
     $query = $this->db->select('     
     tours.tour_id,
     tours.tour_title,
     tours.location,
     tours.start_date,
     tours.back_date,
     tours.days as tdays,
     hr_emp_record.emp_name,
     hr_emp_designation.title
     ')
        ->FROM($table)   
    ->join('hr_emp_record','hr_emp_record.emp_id=tours.emp_id', 'left outer')
->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')         
         ->where($wheredata)
         ->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_student_date($table,$where)
    {
     $query = $this->db->select('*')
        ->FROM($table)   
    ->join('tours','tours.tour_id=tour_details.tour_id', 'left outer')
    ->join('student_record','student_record.student_id=tour_details.student_id', 'left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=tour_details.sub_pro_id', 'left outer')
    ->join('programes_info','programes_info.programe_id=sub_programes.programe_id','left outer')          
         ->where($where)
         ->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function students_details($table,$where)
    {
     $query = $this->db->select('
     tour_details.datefrom,
     tour_details.tour_id,
     tour_details.serial_no,
     tour_details.dateto,
     tour_details.days as tsdays,
     student_record.applicant_image,
     student_record.student_name,
     student_record.father_name,
     student_record.college_no,
     sub_programes.name,
     programes_info.programe_name
     ')
        ->FROM($table)   
   ->join('student_record','student_record.student_id=tour_details.student_id','left outer')
   ->join('tours','tours.tour_id=tour_details.tour_id','left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=tour_details.sub_pro_id','left outer')     
    ->join('programes_info','programes_info.programe_id=sub_programes.programe_id','left outer')     
         ->where($where)
         ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getstudents_grade($where1)
    {
        $this->db->select('*'); 
        $this->db->FROM('student_grades');
 $this->db->join('student_record','student_record.student_id=student_grades.student_id','left outer');
        $this->db->join('subjects_olevel','subjects_olevel.ol_subject_id=student_grades.ol_subject_id','left outer');
        $this->db->join('grade','grade.grade_id=student_grades.grade_id','left outer');
        $this->db->where($where1);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
}

