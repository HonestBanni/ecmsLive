<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class FeeModel extends CI_Model
{
 
    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
 
    public function get_feeHead(){
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=fee_heads.fn_coa_mc_id');
                 $this->db->order_by('fh_Id','desc');
        return  $this->db->get('fee_heads')->result();
    }
    public function get_Payment_Category($where=NULL){
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id','left outer');
                $this->db->join('programes_info','sub_programes.programe_id=programes_info.programe_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=fee_payment_category.batch_id');
//                $this->db->order_by('pc_id','desc');
                $this->db->order_by('pc_id','desc');
                 if($where):
                     $this->db->where($where);
                 endif;
        return  $this->db->get('fee_payment_category')->result();
    }
    public function get_Payment_Category_auto($like=NULL){
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id'); 
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id','left outer');
                 $this->db->order_by('pc_id','desc');
                 $this->db->order_by('name','asc');
                 if($like):
                    $this->db->like('name',$like);
                    $this->db->or_like('title',$like);
                 endif;
        return  $this->db->get('fee_payment_category')->result();
    }
      function dropDown_fee_head($table, $option=NULL,$value,$show,$where=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
                     $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
//                    $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                   $this->db->order_by($show,'asc');
                   $this->db->group_by($show);
                
                
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	} 
      function payment_Cat_DropDown($table, $option=NULL,$value,$show,$where=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                    $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                    $this->db->order_by($value,'asc');
                
                
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show.' ('.$row->name.')';
			}
			return $data;
		}
	} 
    public function get_fee_heads(){
                return $this->db->where('fn_coa_status','1')->where_in('fn_coaId',array('1','4'))->get('fn_coa_parent')->result();
    }

    public function get_fee_coa_heads($table,$like=NULL){
         
            $this->db->where_in('fn_coa_pId',array('1','4'))->where('fn_coa_mc_status',1);
            if($like):
               $this->db->like('fn_coa_mc_title',$like);
               $this->db->or_like('fn_coa_mc_code',$like);   
            endif;
    return   $this->db->order_by('fn_coa_mc_code','asc')->limit(7,0)->get($table)->result();
    }   
    public function get_feeHead_up($where=NULL){
                $this->db->join('fn_coa_master_sub_child','fee_heads.fn_coa_mc_id=fn_coa_master_sub_child.fn_coa_mc_id');
                if($where):
                    $this->db->where($where);
                endif;
                return  $this->db->get('fee_heads')->row();
    }
    public function get_class_setup($where=NULL){
                $this->db->select('
                        fcs_id,
                        fh_head,
                        programe_name,
                        name,
                        fcs_amount,
                        title,
                        fcs_comments
                        '
                       );
                
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_class_setups.sub_pro_id');
                $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_class_setups.pc_id');
                $this->db->join('fee_heads','fee_heads.fh_id=fee_class_setups.fh_id');
                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                $this->db->order_by('fcs_id','desc');
                if($where):
                    $this->db->where($where);
                endif;
        return  $this->db->get('fee_class_setups')->result();
    }
    
    public function get_fee_setup_head($where){
                $this->db->where($where);
                 $this->db->join('fee_heads','fee_heads.fh_id=fee_class_setups_demo.fh_id');
         return $this->db->get('fee_class_setups_demo')->result();
    }
 
    public function get_class_setup_update($where){
                $this->db->select('
                        fee_class_setups.fh_id,
                        fcs_id,
                        fh_head,
                        fee_payment_category.pc_id,
                        programe_name,
                        name,
                        fee_class_setups.sub_pro_id,
                        fcs_amount,
                        title,
                        fcs_comments,
                        fee_class_setups.batch_id,
                        fee_class_setups.shift_id
                        '
                       );
                $this->db->where($where);
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_class_setups.sub_pro_id');
                $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_class_setups.pc_id');
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                $this->db->join('fee_heads','fee_heads.fh_id=fee_class_setups.fh_id');
        return  $this->db->get('fee_class_setups')->row();
    }

    
    function sub_proDropDown($table, $option=NULL,$value,$show,$where=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
                    $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
                    $this->db->order_by($show,'asc');
                
                
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show.' ('.$row->programe_name.')';
			}
			return $data;
		}
	} 
    public function getsub_pro_programDropdown1($table,$like=NULL)
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
    
    public function fee_category_wise($where=NULL){
                $this->db->select('
                        fee_catetory_wise.fcw_id,
                        programes_info.programe_name,
                        sub_programes.name,
                        fee_catetory_wise.fcw_amount,
                        title,
                        fee_catetory_wise.fcw_comments,
                        prospectus_batch.batch_name,
                        fee_shift.name as shift_name'
                       );
                
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_catetory_wise.sub_pro_id');
                $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_catetory_wise.pc_id');
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                $this->db->join('fee_shift','fee_shift.shiftId=fee_catetory_wise.shift_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=fee_catetory_wise.batch_id');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->order_by('fcw_Id','DESC');
        return  $this->db->get('fee_catetory_wise')->result();
    }
    public function fee_total_year_wise($where=NULL){
                $this->db->select('
                        fee_total_anual.total_anual_id,
                        programes_info.programe_name,
                        sub_programes.name,
                        fee_total_anual.total_amount,
                        fee_total_anual.comments,
                        prospectus_batch.batch_name,
                        fee_shift.name as shift_name,
                       '
                       );
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_total_anual.sub_pro_id');
                $this->db->join('programes_info','programes_info.programe_id=fee_total_anual.program_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=fee_total_anual.batch_id');
                $this->db->join('fee_shift','fee_shift.shiftId=fee_total_anual.shift_id');
                if($where):
                    $this->db->where($where);
                endif;
                 $this->db->order_by('fee_total_anual.total_anual_id','DESC');
        return  $this->db->get('fee_total_anual')->result();
    }
    public function fee_category_wise_update($where){
        return  $this->db->where($where)->get('fee_catetory_wise')->row();
    }
    public function getSections($where){
        return  $this->db->where($where)->get('sections')->result();
    }
    public function fee_challan_students($where=Null){
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                             student_record.batch_id,
                             student_record.student_id,
                             student_record.sub_pro_id,
                             student_record.student_name,
                             student_record.father_name,
                             sections.name as sectionsName,
                         ');
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
                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->group_by('student_record.college_no');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->result();
    }
    public function fee_challan_student($where=Null){
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                             student_record.student_id,
                             student_record.student_name,
                             student_record.sub_pro_id,
                             student_record.father_name,
                             sections.name as sectionsName,
                             sub_programes.name as sub_proram,
                             programes_info.programe_name as programe_name,
                             prospectus_batch.batch_name,
                         ');
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
                if($where):
                    $this->db->where($where);
                endif;
       
                $this->db->group_by('student_record.college_no');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->row();
    }
    
    public function fee_challan_filters($where=Null,$like=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.student_name,
                        student_record.father_name,
                        fee_challan.fc_challan_id,
                        fee_challan_status.fcs_title,
                        fee_challan_status.ch_status_id
                    ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');

                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->order_by('college_no','asc');
                $this->db->order_by('fc_challan_id','asc');
        return  $this->db->get('student_record')->result();
    }
    public function fee_concession_form($where=Null,$like=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.student_name,
                        student_record.father_name,
                    ');
            
                
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');

                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->order_by('college_no','asc');
                
        return  $this->db->get('student_record')->result();
    }
    public function fee_bank_reconcilition($where=Null,$like=NULL,$date){
            $this->db->select(
                    '   fee_challan.fc_challan_id,
                        student_record.college_no,
                        student_record.student_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sum(fee_actual_challan_detail.paid_amount) as total_sum,
                        sections.name as sessionName, 
                        fee_challan.fc_paiddate as challan_paid_date,
                        fee_challan.fc_comments as fc_comments,
                      ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                
                $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('fc_challan_id','asc');
                $this->db->order_by('student_record.college_no','asc');
        return  $this->db->get('student_record')->result();
    }
    public function fee_bank_reconcilition_date_wise($where=NULL,$date){
            $this->db->select(
                    '   fee_challan.fc_challan_id,
                        student_record.college_no,
                        student_record.student_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sum(fee_actual_challan_detail.paid_amount) as total_sum,
                        sections.name as sessionName, 
                        fee_challan.fc_paiddate as challan_paid_date,
                        fee_challan.fc_comments as fc_comments,
                      ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                $this->db->group_by('fee_challan.fc_paiddate');
                $this->db->order_by('fee_challan.fc_paiddate','asc');
        return  $this->db->get('student_record')->result();
    }
    public function fee_bank_reconcilition_head_wise($where=NULL,$date){
          
        
                
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                 if($where):
                    $this->db->where($where);
                endif;
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
        return  $this->db->get('fee_challan')->result();
    }
    
    public function fee_bank_reconcilition_head_wise_section($where,$date){
 
                $this->db->select(
                 '
                  sections.name as sessionName,
                  student_record.student_name as studentName,
                  programes_info.programe_name,
                  prospectus_batch.batch_name,
                  sum(fee_actual_challan_detail.paid_amount) as paid_amount
                 ');
                
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                
                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                 $this->db->group_by('sections.sec_id');
                 $this->db->order_by('sections.name','asc');
        return  $this->db->get('fee_challan')->result();
    }
    public function fee_bank_reconcilition_head_wise_student($where=Null,$like=NULL,$date){
 
                $this->db->select(
                 '
                  sections.name as sessionName,
                  student_record.college_no,
                  student_record.student_name,
                  student_record.student_name as studentName,
                  programes_info.programe_name,
                  prospectus_batch.batch_name,
                  sum(fee_actual_challan_detail.paid_amount) as paid_amount
                 ');
                
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                 $this->db->group_by('student_record.student_id');
                 $this->db->order_by('sections.name','asc');
        return  $this->db->get('fee_challan')->result();
    }
    public function fee_challan_filters_classWise($where=Null,$like=NULL){
            $this->db->select(
                        '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.student_name,
                        student_record.father_name,
                        fee_challan.fc_challan_id,
                        fee_challan.fc_paid_form,
                        fee_challan.fc_paid_upto,
                        fee_challan.fc_comments,
                        fee_challan.fc_challan_rq,
                        fc_challan_type,
                        sections.name as sectionName,
                        sub_programes.name as subProName,
                        bank.name as BankName,
                        bank.account_no as Bank_account_no,
                    ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('bank','bank.bank_id=fee_challan.fc_bank_id');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');

                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                return  $this->db->get('student_record')->result();
    }
    
    public function get_Student_feeDetails_search($where){
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
       return $this->db->where($where)->get('fee_actual_challan_detail')->result();
    }
    public function feeDetails_head_print($where){
             
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');                         
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                $this->db->where($where);
                $this->db->group_by('fee_heads.fh_Id'); 
       return   $this->db->get('fee_challan')->result();
    }
    public function feeDetails_arrears_print($where){
               $this->db->select('fc_challan_id,balance,sum(balance) as arrears_balance,sum(actual_amount) as sum_actual_amount,sum(paid_amount) as sum_paid_amount');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');                         
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
        
                $this->db->where($where);
//                $this->db->group_by('fee_heads.fh_Id'); 
       return   $this->db->get('fee_challan')->row();
    }
    public function get_Student_feeDetails2($where){
               
                $this->db->join('fee_challan_detail','fee_challan_detail.challan_id=fee_actual_challan_detail.challan_id','left outer');
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
        
       return $this->db->where($where)->get('fee_actual_challan_detail')->result();
    }
    public function get_Student_feeDetails($where){
                $this->db->select(
                        '
                         fee_actual_challan_detail.actual_amount as actual_amount,   
                         fee_actual_challan_detail.paid_amount as paid_amount,   
                         fee_actual_challan_detail.balance,   
                         fee_actual_challan_detail.challan_status,   
                         fee_actual_challan_detail.challan_id,   
                         fee_heads.fh_head as fh_head,   
                         fee_actual_challan_detail.fee_id as fee_id,   
                        ');

                    $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                    $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
       return $this->db->where($where)->get('fee_actual_challan_detail')->result();
    }
    public function get_challan_payment($where){
                $this->db->select(
                        '
                        fee_heads.fh_head,
                        fee_class_setups.amount,
                        
                        '
                        );
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
       return $this->db->where($where)->get('fee_actual_challan_detail')->result();
    }
    public function get_challan_detail($where){
        $this->db->join('bank','bank.bank_id=fee_challan.fc_bank_id');
      return $this->db->where($where)->get('fee_challan')->row();  
    }
    public function get_apply_student($where=NULL,$like=NULL){
        $this->db->select('reserved_seat.name as Seat_name,sub_programes.*,student_record.*');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $this->db->join("sub_programes","sub_programes.sub_pro_id=student_record.sub_pro_id");
        $this->db->join("reserved_seat","reserved_seat.rseat_id=student_record.rseats_id");
        return $this->db->get('student_record')->result();
    }
    
    public function admission_challan_gen($where=NULL){
        
                $this->db->join("fee_class_setups","fee_class_setups.pc_id=fee_payment_category.pc_id");
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
        return  $this->db->where($where)->get('fee_payment_category')->result();
    }
    
     public function fee_concession($where=Null,$like=NULL,$date){
            $this->db->select(
                    '   fee_challan.fc_challan_id,
                        student_record.college_no,
                        student_record.student_id,
                        student_record.student_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sections.name as sessionName, 
                        fee_challan.fc_paiddate as challan_paid_date,
                        fee_challan.fc_comments as fc_comments,
                      ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                $this->db->join('fee_concession_challan','fee_concession_challan.challan_id=fee_challan.fc_challan_id');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                
                $this->db->where('fee_concession_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('student_record.college_no','asc');
                $this->db->order_by('student_record.college_no','asc');
        return  $this->db->get('student_record')->result();
    }
 
    
    public function get_all_concession_std_wise($where){

              $this->db->select('
                      fee_challan.fc_challan_id,
                      sum(fee_concession_detail.concession_amount) as concession_amount,
                    
                      fee_challan.fc_paid_upto,
                      fee_challan_status.fcs_title,
                      fee_challan.fc_paid_form,
                      '
                      );
              
//                    $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                    $this->db->join('fee_concession_challan','fee_concession_challan.challan_id=fee_challan.fc_challan_id');
                    $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                    $this->db->join('fee_concession_detail','fee_concession_detail.challan_id=fee_concession_challan.challan_id');
                    $this->db->group_by('fee_challan.fc_challan_id');
                    $this->db->order_by('fee_challan.fc_challan_id','asc');
                    
        return  $this->db->where($where)->get('fee_challan')->result();     
                
    }
    public function get_all_concession_head_wise($where){
                    $this->db->join('fee_concession_challan','fee_concession_challan.challan_id=fee_challan.fc_challan_id');
                    $this->db->join('fee_concession_detail','fee_concession_detail.challan_id=fee_concession_challan.challan_id');
                    $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                    $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_concession_detail.fee_id');
                    $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
         return     $this->db->where($where)->get('fee_challan')->result();     
                
    }
    
    public function get_student_info($where){
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('occupation','occupation.occ_id=student_record.guardian_occupation','left outer');
        return  $this->db->where($where)->get('student_record')->row();
    }
}
