<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class PromotionModel extends CI_Model
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
    
//    public function grand_report($field,$table,$where=NULL,$like=NULL){
//  
//                $this->db->select($field);    
//                $this->db->from($table);  
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
//                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
//                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
//                if($like):
//                     $this->db->like($like);
//                endif;
//                  $this->db->group_by('student_record.college_no');
//                $this->db->order_by('college_no','asc');
//            if($where):
//                $this->db->where($where);
//            endif;
//            $query =  $this->db->get();
//            if($query):
//                return $query->result();
//            endif;
//    }
//    
    
    public function grand_report($field,$table,$where=NULL,$like=NULL){
  
                $this->db->select($field);    
                $this->db->from($table); 
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer'); 
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
    
    public function getVisitorsList()
    {
     $this->db->select('security_visitors.*,hr_emp_record.emp_name,relation.title');
        $this->db->FROM('security_visitors');   
    $this->db->join('hr_emp_record','hr_emp_record.emp_id=security_visitors.meeting_person', 'left outer');
    $this->db->join('relation','relation.relation_id=security_visitors.relation_id', 'left outer');
    $this->db->order_by('serial_no','desc');
    $this->db->where('visiting_date', date('Y-m-d', strtotime(date('d-m-Y'))));     
       $query =   $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getVisitors_List($where=NULL,$like=NULL,$visiting_date=NULL,$visiting_dateto=NULL)
    {
        $this->db->select('security_visitors.*,hr_emp_record.emp_name,relation.title');
        $this->db->FROM('security_visitors');   
    $this->db->join('hr_emp_record','hr_emp_record.emp_id=security_visitors.meeting_person', 'left outer');
        $this->db->join('relation','relation.relation_id=security_visitors.relation_id', 'left outer');
    if($where):
        $this->db->where($where);
    endif;    
    if($like):
        $this->db->like($like);     
    endif;
    if($visiting_date !="" && $visiting_dateto !=""):
           $this->db->where('visiting_date BETWEEN "'.$visiting_date.'" and "'.$visiting_dateto.'"');
    endif;     
       $query =   $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getVisitors_Listexcel($where=NULL,$like=NULL,$visiting_date=NULL,$visiting_dateto=NULL)
    {
     $this->db->select('
     security_visitors.visiting_card_no,
     security_visitors.visitor_name,
     security_visitors.father_name,
     security_visitors.cnic,
     security_visitors.contact,
     security_visitors.address,
     hr_emp_record.emp_name,
     relation.title,
     security_visitors.purpose_of_meeting,
     security_visitors.collected_document,
     security_visitors.visiting_date
     ');
        $this->db->FROM('security_visitors');   
    $this->db->join('hr_emp_record','hr_emp_record.emp_id=security_visitors.meeting_person', 'left outer');
    $this->db->join('relation','relation.relation_id=security_visitors.relation_id', 'left outer');
    if($where):
        $this->db->where($where);
    endif;
    if($like):
        $this->db->like($like);     
    endif;
    if($visiting_date !="" && $visiting_dateto !=""):
           $this->db->where('visiting_date BETWEEN "'.$visiting_date.'" and "'.$visiting_dateto.'"');
    endif;        
       $query =   $this->db->get();
        if($query):
            return $query->result_array();
        endif;
    }
    
    public function visitorDetails($where)
    {
     $this->db->select('security_visitors.*,hr_emp_record.emp_name,relation.title');
        $this->db->FROM('security_visitors');   
    $this->db->join('hr_emp_record','hr_emp_record.emp_id=security_visitors.meeting_person', 'left outer');
    $this->db->join('relation','relation.relation_id=security_visitors.relation_id', 'left outer');
       $this->db->where($where);
        $query =   $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_TourRecord($table,$wheredata)
    {
     $query = $this->db->select('*')
        ->FROM($table)   
    ->join('hr_emp_record','hr_emp_record.emp_id=tours.emp_id', 'left outer')
->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')         
         ->where($wheredata)
         ->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function students_details($table,$where)
    {
     $query = $this->db->select('*')
        ->FROM($table)   
   ->join('student_record','student_record.student_id=tour_details.student_id','left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=tour_details.sub_pro_id','left outer')     
         ->where($where)
         ->get();
        if($query):
            return $query->result();
        endif;
    }
  public function getclass_alloted($where=NULL){
       $this->db->select('
        class_alloted.class_id as class_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        sub_programes.name,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        sub_programes.name,
       '); 
        
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('sections.name','asc');
        $this->db->order_by('hr_emp_record.emp_name','asc');
        return $this->db->get('class_alloted')->result();
        
    }   
}

