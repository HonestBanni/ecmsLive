<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class IDCardModel extends CI_Model{

    public function __construct(){
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    
    // Fetch student records
    public function student_records_result($rowno, $rowperpage, $where=NULL, $like=NULL) {
 
        $this->db->select('
            student_record.*,
            programes_info.programe_name,
            sub_programes.name as sub_pro_name,
            sub_programes.sp_title,
            prospectus_batch.batch_name,
            gender.title as gender_title,
            student_status.name as status_title
        ');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');  
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');  
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');  
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');  
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');  
        $this->db->order_by('student_record.student_id','desc');
        $this->db->limit($rowperpage,$rowno);
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        
        return $this->db->get('student_record')->result(); 
    }
  
    // Select total records
    public function student_records_count($where=NULL, $like=NULL) {

        $this->db->select('count(*) as allcount');
        $this->db->from('student_record');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0]['allcount'];
    }
    
    public function get_student_data($where=NULL) {
 
        $this->db->select('
            student_record.*,
            programes_info.programe_name,
            sub_programes.name as sub_pro_name,
            sub_programes.sp_title,
            sub_programes.title_for_idcards,
            prospectus_batch.batch_name,
            gender.title as gender_title,
            student_status.name as status_title
        ');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');  
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');  
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');  
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');  
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');  
        $this->db->order_by('student_record.student_id','desc');
        if($where):
            $this->db->where($where);
        endif;
        
        return $this->db->get('student_record')->row(); 
    }
  
    public function get_idcard_print_data($where=NULL) {
 
        $this->db->select('
            idcard_print_details.*,
            blood_group.*,
            hr_emp_record.emp_name,
        ');
        $this->db->join('blood_group','blood_group.b_group_id=idcard_print_details.idc_bg_id', 'left outer');  
        $this->db->join('users','users.id=idcard_print_details.idc_user_id', 'left outer');    
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer'); 
        $this->db->order_by('idcard_print_details.idc_print_date','desc');
        if($where):
            $this->db->where($where);
        endif;
        
        return $this->db->get('idcard_print_details')->result(); 
    }
  
    public function get_single_idcard_data($where=NULL) {
 
        $this->db->select('
            idcard_print_details.*,
            blood_group.*,
        ');
        $this->db->join('blood_group','blood_group.b_group_id=idcard_print_details.idc_bg_id', 'left outer');  
        $this->db->join('users','users.id=idcard_print_details.idc_user_id', 'left outer');    
        if($where):
            $this->db->where($where);
        endif;
        
        return $this->db->get('idcard_print_details')->row(); 
    }
  
    public function student_idcard_result($where=NULL, $like=NULL, $start=NULL, $end=NULL) {
 
        $this->db->select('
            idcard_print_details.*,
            student_record.*,
            programes_info.programe_name,
            sub_programes.name as sub_pro_name,
            sub_programes.sp_title,
            prospectus_batch.batch_name,
            gender.title as gender_title,
            student_status.name as status_title
        ');
        $this->db->join('student_record','student_record.student_id=idcard_print_details.idc_student_id', 'left outer');  
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');  
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');  
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');  
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');  
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');  
        $this->db->order_by('idcard_print_details.idc_print_date','desc');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        if(!empty($start) || !empty($end)):
            $this->db->where('idcard_print_details.idc_print_date BETWEEN "'.date('Y-m-d', strtotime($start)).'" AND "'.date('Y-m-d', strtotime($end)).'"');
        endif;
        return $this->db->get('idcard_print_details')->result(); 
    }
    
    // Fetch student records
    public function employ_records_result($rowno, $rowperpage, $where=NULL, $like=NULL) {
 
        $this->db->select('
            hr_emp_record.*,
            gender.title as genderName,
            department.title as department,
            hr_emp_designation.title as designation,
            hr_emp_category.title as category,
            hr_emp_contract_type.title as contract,
            hr_emp_status.title as emp_status
        ');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
        $this->db->limit($rowperpage,$rowno);
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        
        return $this->db->get('hr_emp_record')->result(); 
    }
  
    // Select total records
    public function employ_records_count($where=NULL, $like=NULL) {

        $this->db->select('count(*) as allcount');
        $this->db->from('hr_emp_record');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0]['allcount'];
    }
    
    public function single_employ_data($where=NULL) {
 
        $this->db->select('
            hr_emp_record.*,
            gender.title as genderName,
            department.title as department,
            hr_emp_designation.title as designation,
            hr_emp_category.title as category,
            hr_emp_contract_type.title as contract,
            hr_emp_status.title as emp_status
        ');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        
        return $this->db->get('hr_emp_record')->row(); 
    }
    
    public function get_emp_idcard_print_data($where=NULL) {
 
        $this->db->select('
            idcard_emp_print_details.*,
            blood_group.*,
            hr_emp_record.emp_name,
        ');
        $this->db->join('blood_group','blood_group.b_group_id=idcard_emp_print_details.idce_bg_id', 'left outer');  
        $this->db->join('users','users.id=idcard_emp_print_details.idce_user_id', 'left outer');    
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer'); 
        $this->db->order_by('idcard_emp_print_details.idce_print_date','desc');
        if($where):
            $this->db->where($where);
        endif;
        
        return $this->db->get('idcard_emp_print_details')->result(); 
    }
    
    public function get_single_employ_idcard($where=NULL) {
 
        $this->db->select('
            idcard_emp_print_details.*,
            blood_group.*,
        ');
        $this->db->join('blood_group','blood_group.b_group_id=idcard_emp_print_details.idce_bg_id', 'left outer');  
        $this->db->join('users','users.id=idcard_emp_print_details.idce_user_id', 'left outer');    
        if($where):
            $this->db->where($where);
        endif;
        
        return $this->db->get('idcard_emp_print_details')->row(); 
    }
  
    public function get_employ_idcard_print($where=NULL) {
 
        $this->db->select('
            idcard_emp_print_details.*,
            blood_group.*,
            hr_emp_record.emp_name,
        ');
        $this->db->join('blood_group','blood_group.b_group_id=idcard_emp_print_details.idce_bg_id', 'left outer');  
        $this->db->join('users','users.id=idcard_emp_print_details.idce_user_id', 'left outer');    
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer'); 
        $this->db->order_by('idcard_emp_print_details.idce_print_date','desc');
        if($where):
            $this->db->where($where);
        endif;
        
        return $this->db->get('idcard_emp_print_details')->result(); 
    }
  
    public function employ_idcard_result($where=NULL, $like=NULL, $start=NULL, $end=NULL) {
 
        $this->db->select('
            idcard_emp_print_details.*,
            hr_emp_record.*,
            gender.title as gender_title,
            department.title as department,
            hr_emp_designation.title as designation,
            hr_emp_status.title as status_title,
        ');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=idcard_emp_print_details.idce_emp_id', 'left outer');  
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer'); 
        $this->db->order_by('idcard_emp_print_details.idce_print_date','desc');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        if(!empty($start) || !empty($end)):
            $this->db->where('idcard_emp_print_details.idce_print_date BETWEEN "'.date('Y-m-d', strtotime($start)).'" AND "'.date('Y-m-d', strtotime($end)).'"');
        endif;
        return $this->db->get('idcard_emp_print_details')->result(); 
    }
    
}
