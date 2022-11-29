<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class MinuteSheetModel extends CI_Model
{

    public function __construct(){
        parent::__construct();
        $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    
    public function get_user_info($where=NULL){
        
        $this->db->SELECT('
            hr_emp_record.emp_id,
            hr_emp_record.emp_name,
            department.department_id,
            department.title,
        ');
        $this->db->FROM('users');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_ms_info($where=NULL, $like=NULL){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $this->db->order_by('msr_id', 'desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_ms_info_limit($where=NULL, $like=NULL){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $this->db->order_by('msr_id', 'desc');
        $this->db->limit(25, 0);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_ms_info_where_in($where=NULL, $like=NULL, $column, $array){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where_in($column, $array);
        if($like):
            $this->db->like($like);
        endif;
        $this->db->order_by('msr_id', 'desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_ms_info_where_in_limit($where=NULL, $like=NULL, $column, $array){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where_in($column, $array);
        if($like):
            $this->db->like($like);
        endif;
        $this->db->order_by('msr_id', 'desc');
        $this->db->limit(25, 0);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_ms_info_edit($where=NULL){
        
        $this->db->SELECT('
            min_sheet.*,
            hr_emp_record.emp_name,
            department.title as deptt_name,
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_curr_deptt($where=NULL){
        
        $this->db->SELECT('
            hr_emp_record.department_id as deptt_id,
            department.title as deptt_name,
        ');
        $this->db->FROM('hr_emp_record');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_ms_detail_where_in($where=NULL, $like=NULL, $column, $array){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('min_sheet_details','min_sheet_details.msd_msr_id=min_sheet.msr_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where_in($column, $array);
        if($like):
            $this->db->like($like);
        endif;
        $this->db->order_by('msr_id', 'desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_ms_detail_where_in_limit($where=NULL, $like=NULL, $column, $array){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('min_sheet_details','min_sheet_details.msd_msr_id=min_sheet.msr_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where_in($column, $array);
        if($like):
            $this->db->like($like);
        endif;
        $this->db->group_by('msr_id');
        $this->db->order_by('msr_id', 'desc');
        $this->db->limit(25, 0);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_ms_preview($where=NULL){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('min_sheet_details','min_sheet_details.msd_msr_id=min_sheet.msr_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('msr_id', 'desc');
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_hod_remarks($where=NULL){
        
        $this->db->SELECT('
            min_sheet_details.msd_msr_id,
            min_sheet_details.msd_comments,
            min_sheet_details.msd_status,
            hr_emp_record.emp_name,
            hr_emp_record.hod_ms_signature,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet_details');
        $this->db->join('users','users.id=min_sheet_details.msd_user_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_fno_remarks($where=NULL){
        
        $this->db->SELECT('
            min_sheet_budget.msbg_comments,
            min_sheet_budget.msbg_budget,
            fn_coa_master_sub_child.fn_coa_mc_title,
            fn_coa_master_sub_child.fn_coa_mc_code,
            hr_emp_record.emp_name,
            hr_emp_record.hod_ms_signature,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet_budget');
        $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=min_sheet_budget.msbg_chart_of_account', 'left outer');
        $this->db->join('users','users.id=min_sheet_budget.msbg_user_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_vp_remarks($where=NULL){
        
        $this->db->SELECT('
            min_sheet_details.msd_msr_id,
            min_sheet_details.msd_comments,
            min_sheet_details.msd_status,
            min_sheet_purchase_type.mspt_type,
            hr_emp_record.emp_name,
            hr_emp_record.hod_ms_signature,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet_details');
        $this->db->join('min_sheet','min_sheet.msr_id=min_sheet_details.msd_msr_id', 'left outer');
        $this->db->join('min_sheet_purchase_type','min_sheet_purchase_type.mspt_id=min_sheet.msr_purchase_type', 'left outer');
        $this->db->join('users','users.id=min_sheet_details.msd_user_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_dir_finance_remarks($where=NULL, $wi, $wi_arr){
        
        $this->db->SELECT('
            min_sheet_details.msd_msr_id,
            min_sheet_details.msd_comments,
            min_sheet_details.msd_status,
            min_sheet_status.mss_title,
            hr_emp_record.emp_name,
            hr_emp_record.hod_ms_signature,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet_details');
        $this->db->join('min_sheet_status','min_sheet_status.mss_id=min_sheet_details.msd_status', 'left outer');
        $this->db->join('users','users.id=min_sheet_details.msd_user_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($wi):
            $this->db->where_in($wi, $wi_arr);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_principal_remarks($where=NULL, $wi, $wi_arr){
        
        $this->db->SELECT('
            min_sheet_details.msd_msr_id,
            min_sheet_details.msd_comments,
            min_sheet_details.msd_status,
            min_sheet_status.mss_title,
            min_sheet_purchase_type.mspt_type,
            hr_emp_record.emp_name,
            hr_emp_record.hod_ms_signature,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet_details');
        $this->db->join('min_sheet_status','min_sheet_status.mss_id=min_sheet_details.msd_status', 'left outer');
        $this->db->join('min_sheet','min_sheet.msr_id=min_sheet_details.msd_msr_id', 'left outer');
        $this->db->join('min_sheet_purchase_type','min_sheet_purchase_type.mspt_id=min_sheet.msr_purchase_type', 'left outer');
        $this->db->join('users','users.id=min_sheet_details.msd_user_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($wi):
            $this->db->where_in($wi, $wi_arr);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
}
