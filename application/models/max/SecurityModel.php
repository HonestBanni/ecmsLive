<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class SecurityModel extends CI_Model
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
    
    public function get_by_proc_id($table,$id){
        $query = $this->db->select('student_record.student_name')
            ->from($table)
           ->join('student_record','student_record.student_id=proctors.student_id','left outer')
            ->where($id)
            ->get();
      return $query->result();
    }
    
    public function getStds_group($table,$like=NULL)
    {
        $this->db->FROM($table);
        if($like):
            $this->db->like('student_name',$like);    
            $this->db->or_like('college_no',$like);    
        endif;
      //  $this->db->where('prac_flag','0');
        $this->db->where('s_status_id','5');
         $query = $this->db->get();
        return $query->result();
    }
    
    public function getStds_sec($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
            $this->db->like('student_name',$like);    
            $this->db->or_like('college_no',$like);    
        endif;
        $this->db->where('flag','0');
        $this->db->where('s_status_id','5');
         $query = $this->db->get();
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
    
    public function get_stdsData($table){
            $this->db->SELECT('
                proctors.*,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                student_record.student_password,
                sections.name as section,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name
                ');
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=proctors.student_id', 'left outer');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_stdsData_row($table){
            $this->db->SELECT('
                proctors.*,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name
                ');
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=proctors.student_id', 'left outer');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
            $query =  $this->db->get();
            if($query):
                return $query->row();
            endif;
   }
    
    public function getStudentData($table,$where=NULL){
            $this->db->SELECT('
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                programes_info.programe_name as program
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->where('student_type','1');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
   }
    
    public function get_std_row($table){
            $this->db->SELECT('
                proctors.*,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                ');
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=proctors.student_id', 'left outer');
        $this->db->where('type','1');
            $query =  $this->db->get();
            if($query):
                return $query->row();
            endif;
   }
    
    public function getproctors_record()
    {
        $this->db->select('*'); 
        $this->db->FROM('proctor_demo');
 $this->db->join('student_record','student_record.student_id=proctor_demo.student_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
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
    
    public function getStds($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
            $this->db->like('student_name',$like);    
            $this->db->or_like('college_no',$like);    
        endif;
         $query = $this->db->get();
        return $query->result();
    }
    
     public function getStdss($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
            $this->db->like('student_name',$like);    
            $this->db->or_like('form_no',$like);    
            $this->db->or_like('college_no',$like);    
        endif;
         $query = $this->db->get();
        return $query->result();
    }
    
    public function get_proctorialData($table)
    {
       $query = $this->db->select('
       proctorial_fine.*,
       proctorial_fine_type.*,
       proctorial_fine_status.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ')
    ->from($table)
    ->join('student_record','student_record.student_id=proctorial_fine.student_id','left outer')  
    ->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer')  
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
    ->join('proctorial_fine_type','proctorial_fine_type.proc_type_id=proctorial_fine.proc_type_id','left outer')
    ->join('proctorial_fine_status','proctorial_fine_status.proc_status_id=proctorial_fine.proc_status_id','left outer')
    ->order_by('proc_id','desc')
     ->get();
        return $query->result();  
    }
    
    public function proctorialSearch($table,$where=NULL)
    {
        $this->db->select('
       proctorial_fine.*,
       proctorial_fine_type.*,
       proctorial_fine_status.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=proctorial_fine.student_id','left outer');  
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer') ; 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
    $this->db->join('proctorial_fine_type','proctorial_fine_type.proc_type_id=proctorial_fine.proc_type_id','left outer');
    $this->db->join('proctorial_fine_status','proctorial_fine_status.proc_status_id=proctorial_fine.proc_status_id','left outer');
     if($where):   
       $this->db->where($where);
     endif;    
     $query = $this->db->get();
        return $query->result();  
    }
   
    public function get_proctorialRow($table,$where)
    {
       $query = $this->db->select('
       proctorial_fine.*,
       proctorial_fine_type.*,
       proctorial_fine_status.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ')
    ->from($table)
    ->join('student_record','student_record.student_id=proctorial_fine.student_id','left outer')  
    ->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer')  
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
    ->join('proctorial_fine_type','proctorial_fine_type.proc_type_id=proctorial_fine.proc_type_id','left outer')
    ->join('proctorial_fine_status','proctorial_fine_status.proc_status_id=proctorial_fine.proc_status_id','left outer')       
     ->where($where)
     ->get();
        return $query->row();  
    }
    
}

