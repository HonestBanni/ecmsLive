<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class HrModel extends CI_Model
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
    
    public function hr_grant_in_add($where){
        $query = $this->db->select('hr_emp_grant_in_aid.*,hr_emp_record.emp_id,hr_emp_record.emp_name,department.title as dept,degree.title as degree,hr_emp_status_bond.*')
                 ->from('hr_emp_grant_in_aid')
                 ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_grant_in_aid.emp_id','left outer')  
                 ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
                 ->join('degree','degree.degree_id=hr_emp_grant_in_aid.degree_id','left outer')     
                 ->join('hr_emp_status_bond','hr_emp_status_bond.status_bond_id=hr_emp_grant_in_aid.status_bond_id','left outer')     
                 ->where($where)
                 ->order_by('amount_coll_date','asc')
                 ->get();
        return $query->result();
    }
    
    public function hr_grant_in_add_row($where){
        $query = $this->db->select('hr_emp_grant_in_aid.*,hr_emp_record.emp_id,hr_emp_record.emp_name,department.title as dept,degree.title as degree,hr_emp_status_bond.*')
         ->from('hr_emp_grant_in_aid')
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_grant_in_aid.emp_id','left outer')  
         ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
         ->join('degree','degree.degree_id=hr_emp_grant_in_aid.degree_id','left outer')     
         ->join('hr_emp_status_bond','hr_emp_status_bond.status_bond_id=hr_emp_grant_in_aid.status_bond_id','left outer')     
         ->where($where)
         ->order_by('amount_coll_date','asc')
         ->get();
        return $query->row();
    }
    
    public function getTEmployee($table,$where=NULL)
    {
        $query = $this->db->select('
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            hr_emp_record.dob,
            hr_emp_record.joining_date,
            hr_emp_record.retirement_date,
            department.title as department,
            hr_emp_designation.title as cdesignation,
            hr_emp_scale.title as cscale
        ');
         $this->db->from($table);
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
         $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer'); 
         $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id','left outer'); 
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where('hr_emp_record.emp_status_id','1');
       // $this->db->where('hr_emp_record.c_emp_scale_id','23');
        $this->db->order_by('joining_date','asc');
        $this->db->order_by('dob','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function hr_edu_record($where){
        $query = $this->db->select('
            hr_emp_education.emp_edu_id,
            hr_emp_record.emp_name,
            degree.title as Degreetitle,
            board_university.title as bordTitle,
            hr_emp_education.passing_year,
            hr_emp_education.percentage,
            hr_emp_education.cgpa,
            hr_emp_division.name as divisiontitle,
            hr_emp_education.hec_verified,
        ')
                 ->from('hr_emp_education')
                 ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_education.emp_id','left outer')  
                 ->join('degree','degree.degree_id=hr_emp_education.degree_id','left outer')  
                 ->join('board_university','board_university.bu_id=hr_emp_education.bu_id','left outer')  
                 ->join('hr_emp_division','hr_emp_division.devision_id=hr_emp_education.div_id','left outer')   
                 ->where($where)
                 ->order_by('passing_year','desc')
                 ->get();
        return $query->result();
    }
    
    public function gethead_of_dept(){
        $query = $this->db->select('
                department.title as department,
                hr_emp_record.emp_name as employee,
                hr_head_department.date as date,
                hr_head_department.comment as comment,
                hr_head_department.serial_no as serial_no
                    ')
                ->from('hr_head_department')
                ->join('department','department.department_id=hr_head_department.department_id')
                ->join('hr_emp_record','hr_emp_record.emp_id=hr_head_department.emp_id')
                ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getbank()
    {
        $pro = $this->db->get("bank");
        return $pro->result();
    }
    
    public function getdepartment()
    {
        $pro = $this->db->get("department");
        return $pro->result();
    }
    
    public function profileEmployee($where)
    {
       $query = $this->db->select('
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            hr_emp_record.emp_husband_name,
            hr_emp_record.nic,
            hr_emp_record.dob,
            hr_emp_record.postal_address,
            hr_emp_record.permanent_address,
            hr_emp_record.post_office,
            hr_emp_record.ptcl_number,
            hr_emp_record.contact1,
            hr_emp_record.contact2,
            hr_emp_record.emp_personal_no,
            hr_emp_record.gp_fund_no,
            hr_emp_record.email,
            hr_emp_record.joining_date,
            hr_emp_record.account_no,
            hr_emp_record.comment,
            hr_emp_record.additional_responsibilty,
            hr_emp_record.c_emp_scale_id,
            hr_emp_record.current_designation,
            department.title as department,
            gender.title as genderTitle,
            subject.title as subjectTitle,
            hr_emp_category.title as categorytitle,
            district.name as district,
            country.name as country,
            blood_group.title as blood,
            religion.title as religion,
            marital_status.title as marital,
            hr_emp_contract_type.title as contract,
            hr_emp_scale.title as joiningscale,
            hr_emp_designation.title as jdesignation,
            shift.name as shiftname,
            bank.name as bankname,
            hr_emp_status.title as statustitle,
        ')
    ->from('hr_emp_record')
    ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
    ->join('subject','subject.subject_id=hr_emp_record.subject_id','left outer')  
    ->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer')
    ->join('gender','gender.gender_id=hr_emp_record.gender_id','left outer')
    ->join('district','district.district_id=hr_emp_record.district_id','left outer')
    ->join('country','country.country_id=hr_emp_record.country_id','left outer')
    ->join('blood_group','blood_group.b_group_id=hr_emp_record.bg_id','left outer')
    ->join('religion','religion.religion_id=hr_emp_record.religion_id','left outer')
    ->join('marital_status','marital_status.marital_status_id=hr_emp_record.marital_status_id','left outer')
    ->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer')
    ->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.j_emp_scale_id','left outer')
    ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.joining_designation','left outer')
    ->join('shift','shift.shift_id=hr_emp_record.shift_id','left outer')
    ->join('bank','bank.bank_id=hr_emp_record.bank_id','left outer')
    ->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id','left outer')
     ->where($where)
     ->get();
        return $query->result();  
    }
    
    public function getEmployee()
    {
            $query = $this->db->select('
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            department.title as departmentTitle,
            subject.title as subjectTitle,
            hr_emp_designation.title as cdesignation,
            hr_emp_contract_type.title as contracttitle,
            hr_emp_category.title as categorytitle,
        ')
 ->from('hr_emp_record')
 ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
 ->join('subject','subject.subject_id=hr_emp_record.subject_id','left outer')  
 ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')  
    ->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer')
    ->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer')           
                 ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getEmployeeRetire()
    {
            $query = $this->db->select('
            hr_emp_retire.*,
            hr_retire_status.*,
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            department.title as departmentTitle,
            subject.title as subjectTitle,
            hr_emp_designation.title as cdesignation,
            hr_emp_contract_type.title as contracttitle,
            hr_emp_category.title as categorytitle,
        ')
         ->from('hr_emp_retire')
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_retire.emp_id','left outer')  
         ->join('hr_retire_status','hr_retire_status.retire_status_id=hr_emp_retire.retire_status_id','left outer')  
         ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
         ->join('subject','subject.subject_id=hr_emp_record.subject_id','left outer')  
         ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')  
    ->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer')
    ->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer')
    ->where('emp_status_id','2')           
                 ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getEmployeePg($SPP,$page)
    {
            $query = $this->db->select('
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            department.title as departmentTitle,
            subject.title as subjectTitle,
            hr_emp_designation.title as cdesignation,
            hr_emp_contract_type.title as contracttitle,
            hr_emp_category.title as categorytitle,
            hr_emp_status.title
        ')
         ->from('hr_emp_record')
         ->limit($SPP,$page)
         ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
         ->join('subject','subject.subject_id=hr_emp_record.subject_id','left outer')  
         ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')
        ->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer')        
    ->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer')
    ->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer')    
                 ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getEmployeeRetired($SPP,$page)
    {
            $query = $this->db->select('
            hr_emp_retire.*,
            hr_retire_status.*,
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            department.title as departmentTitle,
            subject.title as subjectTitle,
            hr_emp_designation.title as cdesignation,
            hr_emp_contract_type.title as contracttitle,
            hr_emp_category.title as categorytitle,
        ')
         ->from('hr_emp_retire')
         ->limit($SPP,$page)
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_retire.emp_id','left outer')  
         ->join('hr_retire_status','hr_retire_status.retire_status_id=hr_emp_retire.retire_status_id','left outer')  
         ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
         ->join('subject','subject.subject_id=hr_emp_record.subject_id','left outer')  
         ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')  
    ->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer')
    ->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer')
    ->where('emp_status_id','2')
    ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getEmployeePromoted($SPP,$page)
    {
            $query = $this->db->select('
            hr_promotion_demotion.*,
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            department.title as departmentTitle,
            hr_emp_designation.title as cdesignation,
            hr_emp_contract_type.title as contracttitle,
            hr_emp_category.title as categorytitle,
            hr_emp_scale.title as scale,
        ')
         ->from('hr_promotion_demotion')
         ->limit($SPP,$page)
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_promotion_demotion.emp_id','left outer')  
         ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
         ->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_promotion_demotion.pro_scale_id','left outer')  
     ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_promotion_demotion.pro_desig_id','left outer')  
    ->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer')
    ->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer')
    ->where('emp_status_id','1')
    ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getEmployeePromote()
    {
            $query = $this->db->select('
            hr_promotion_demotion.*,
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            department.title as departmentTitle,
            subject.title as subjectTitle,
            hr_emp_designation.title as cdesignation,
            hr_emp_contract_type.title as contracttitle,
            hr_emp_category.title as categorytitle,
            hr_emp_scale.title as scale,
        ')
         ->from('hr_promotion_demotion')
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_promotion_demotion.emp_id','left outer')  
         ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
         ->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_promotion_demotion.pro_scale_id','left outer')  
         ->join('subject','subject.subject_id=hr_emp_record.subject_id','left outer')  
     ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_promotion_demotion.pro_desig_id','left outer')  
    ->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer')
    ->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer')
    ->where('emp_status_id','1')
    ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getcategory()
    {
        $pro = $this->db->get("hr_emp_category");
        return $pro->result();
    }
    
    public function getdesignation()
    {
        $pro = $this->db->get("hr_emp_designation");
        return $pro->result();
    }
    
    public function getdivision()
    {
        $pro = $this->db->get("hr_emp_division");
        return $pro->result();
    }
    
    public function getscale()
    {
        $this->db->order_by("hr_emp_scale.title","asc");
        $pro = $this->db->get("hr_emp_scale");
        return $pro->result();
    }
    
    public function getemp_status()
    {
        $pro = $this->db->get("hr_emp_status");
        return $pro->result();
    }
    
    public function getemp_contract()
    {
        $pro = $this->db->get("hr_emp_contract_type");
        return $pro->result();
    }
    
    public function emp_acr(){
        $query = $this->db->select('
            hr_emp_acr.*,
            hr_emp_record.emp_name,
            hr_emp_designation.title,
        ')
         ->from('hr_emp_acr')
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_acr.emp_id','left outer')  
         ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')  
         ->get();
        return $query->result();
    }
    
    public function get_empData($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                hr_emp_record.emp_id,
                hr_emp_record.emp_name,
                hr_emp_record.picture,
                gender.title as genderName,
                department.title as department,
                hr_emp_designation.title as designation,
                hr_emp_category.title as category,
                hr_emp_scale.title as scale,
                hr_emp_contract_type.title as contract,
                subject.title as subject,
                hr_emp_record.father_name,
                hr_emp_status.title
                ');
        
            $this->db->FROM($table);
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('subject','subject.subject_id=hr_emp_record.subject_id', 'left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id', 'left outer');
        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
      //  $this->db->where('emp_status_id','1');
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
    
    public function get_empretireData($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                hr_emp_record.emp_id,
                hr_emp_record.emp_name,
                hr_emp_record.picture,
                gender.title as genderName,
                department.title as department,
                hr_emp_designation.title as designation,
                hr_emp_category.title as category,
                hr_emp_scale.title as scale,
                hr_emp_contract_type.title as contract,
                subject.title as subject,
                hr_emp_record.father_name,
                ');
        
            $this->db->FROM($table);
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('subject','subject.subject_id=hr_emp_record.subject_id', 'left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id', 'left outer');
        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
        $this->db->where('emp_status_id','1');
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
    
    public function get_empexportData($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                hr_emp_record.emp_id,
                hr_emp_record.emp_name,
                gender.title as genderName,
                department.title as department,
                hr_emp_designation.title as designation,
                hr_emp_category.title as category,
                hr_emp_scale.title as scale,
                hr_emp_contract_type.title as contract,
                subject.title as subject,
                hr_emp_record.father_name,
                ');
        
            $this->db->FROM($table);
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('subject','subject.subject_id=hr_emp_record.subject_id', 'left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id', 'left outer');
        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
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
    
    public function getemp_rec(){
        $query = $this->db->select('
            hr_explanation_letter.*,
            hr_emp_record.emp_name,
            hr_emp_designation.title,
        ')
         ->from('hr_explanation_letter')
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_explanation_letter.emp_id','left outer')  
         ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')  
         ->get();
        return $query->result();
    }
    
    public function emp_contract_reneval(){
        $query = $this->db->select('
            hr_contract_reneval.*,
            hr_emp_record.emp_name,
            hr_emp_designation.title,
        ')
         ->from('hr_contract_reneval')
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_contract_reneval.emp_id','left outer')  
         ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')  
         ->get();
        return $query->result();
    }
    
    public function getemp_show_cause(){
        $query = $this->db->select('
            hr_show_cause.*,
            hr_emp_record.emp_name,
            hr_emp_designation.title,
        ')
         ->from('hr_show_cause')
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_show_cause.emp_id','left outer')  
         ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')  
         ->get();
        return $query->result();
    }
    
    public function getemp_promotion(){
        $query = $this->db->select('
            hr_emp_promotion.*,
            hr_emp_record.emp_name,
            hr_emp_designation.title as designation,
            hr_emp_scale.title as scale
        ')
         ->from('hr_emp_promotion')
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_promotion.emp_id','left outer')  
         ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_promotion.from_desg_id','left outer')  
         ->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_promotion.from_scale_id','left outer')  
         ->get();
        return $query->result();
    }
    
    public function getemp_demotion(){
        $query = $this->db->select('
            hr_emp_demotion.*,
            hr_emp_record.emp_name,
            hr_emp_designation.title as designation,
            hr_emp_scale.title as scale
        ')
         ->from('hr_emp_demotion')
         ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_demotion.emp_id','left outer')  
         ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_demotion.from_desg_id','left outer')  
         ->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_demotion.from_scale_id','left outer')  
         ->get();
        return $query->result();
    }
    
    
}
