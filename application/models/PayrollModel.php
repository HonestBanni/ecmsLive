<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class PayrollModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    public function get_finincial_year(){
 
               $this->db->join('common_status','common_status.cs_id=financial_year.fy_default_active','left outer');
               $this->db->order_by('fy_id','desc');
     return    $this->db->get_where('financial_year')->result();
    }
    public function get_payroll_categories(){
 
               $this->db->join('common_status','common_status.cs_id=pr_allowance.pr_allow_status','left outer');
     return    $this->db->get_where('pr_allowance')->result();
    }
 
    public function get_payroll_categories_type($where){
            $this->db->join('common_status','common_status.cs_id=pr_allowance_types.allow_type_status','left outer');
            $this->db->order_by('allow_type_code','asc');
     return $this->db->get_where('pr_allowance_types',$where)->result();
    }
    public function get_pay_scale_demo($where){
            $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=pr_pay_scale_details_demo.psd_pay_scale');
            $this->db->order_by('psd_id','asc');
     return $this->db->get_where('pr_pay_scale_details_demo',$where)->result();
    }
 
    public function get_pay_scale(){
            $this->db->join('financial_year','financial_year.fy_id=pr_pay_scale.ps_fy_id');
            $this->db->join('common_status','common_status.cs_id=pr_pay_scale.ps_status');
            $this->db->order_by('ps_id','desc');
     return $this->db->get_where('pr_pay_scale')->result();
    }
    public function get_pay_scale_popup($pk_id){
        
                $return_array = array();
                                            $this->db->join('financial_year','financial_year.fy_id=pr_pay_scale.ps_fy_id');
                $return_array['titles'] =   $this->db->get_where('pr_pay_scale',array('ps_id'=>$pk_id))->row();

                                            $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=pr_pay_scale_details.psd_pay_scale');
                                            $this->db->order_by('scale_order','asc');
                $return_array['PayScaleDetails'] =   $this->db->get_where('pr_pay_scale_details',array('psd_ps_id'=>$pk_id))->result();

                                                $this->db->join('pr_allowance_types','pr_allowance_types.allow_type_id=pr_pay_scale_allowance.psa_allowance_type_id');
                                                $this->db->order_by('allow_type_name','asc');
                                                $this->db->group_by('allow_type_id');
                $return_array['Allowances'] =   $this->db->get_where('pr_pay_scale_allowance',array('psa_ps_id'=>$pk_id))->result();
     return $return_array;
    }
    public function get_pay_edit_grid($where){
            $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=pr_pay_scale_details.psd_pay_scale');
            $this->db->order_by('psd_id','asc');
     return $this->db->get_where('pr_pay_scale_details',$where)->result();
    }
    public function pay_scale_allowance_grid($where){
                
//               $this->db->join('common_status','common_status.cs_id=financial_year.fy_default_active','left outer');
               $this->db->order_by('fy_id','desc');
     return    $this->db->get_where('pr_pay_scale_allowance',$where)->result();
    }
}
  