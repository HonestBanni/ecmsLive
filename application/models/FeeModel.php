<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class FeeModel extends CI_Model
{
 
    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
         $this->load->model('ReportsModel');
                 
    }
 
    public function fee_coa_master($table,$where){
        
          return        $this->db->join('fee_coa_parent','fee_coa_parent.fn_coaId=fee_coa_master_child.fn_coa_m_pId')
                        ->order_by('fn_coa_m_code','asc')
                        ->where($where)->get($table)->result();
//        return $query->result();
    }
      public function coa_master_subChild($table,$where){
        
          $query =      $this->db->select('*')
                        ->join('fee_coa_master_child','fee_coa_master_child.fn_coa_m_cId=fee_coa_master_sub_child.fn_coa_mc_mId')
                        ->join('fee_coa_parent','fee_coa_parent.fn_coaId=fee_coa_master_child.fn_coa_m_pId')
                        ->where($where)
                        ->order_by('fn_coa_mc_code','asc')
                        
                        ->get($table);
        return $query->result();
    }
    public function coa_master_subChildRow($table,$where){
        
          $query =      $this->db->select('*')
                        ->join('fee_coa_master_child','fee_coa_master_child.fn_coa_m_cId=fee_coa_master_sub_child.fn_coa_mc_mId')
                        ->join('fee_coa_parent','fee_coa_parent.fn_coaId=fee_coa_master_child.fn_coa_m_pId')
                        ->order_by('fn_coa_mc_code','asc')
                        ->where($where)
                        ->get($table);
        return $query->row();
    }
    
    public function get_feeHead(){
//                $this->db->join('fee_coa_master_sub_child','fee_coa_master_sub_child.fn_coa_mc_id=fee_heads.fn_coa_mc_id');
                 $this->db->order_by('fh_Id','desc');
        return  $this->db->get('fee_heads')->result();
    }
    public function get_Payment_Category($where=NULL){
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id','left outer');
                $this->db->join('programes_info','sub_programes.programe_id=programes_info.programe_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=fee_payment_category.batch_id');
                $this->db->where('prospectus_batch.status','on');
//                $this->db->order_by('pc_id','desc');
                $this->db->order_by('pc_id','asc');
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
		$this->db->select('
                    fee_heads.fh_head,
                    fee_heads.fh_Id,
                        ');
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
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=fee_payment_category.batch_id');
                    $this->db->order_by('prospectus_batch.batch_name','asc');
                    $this->db->order_by('name','asc');
                
                
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show.' ('.$row->name.')'.'-'.$row->batch_name;
			}
			return $data;
		}
	} 
    public function get_fee_heads(){
//                return $this->db->where('fn_coa_status','1')->get('fee_coa_parent')->result();
                return $this->db->where('fn_coa_status','1')->where_in('fn_coaId',array('1','4'))->get('fee_coa_parent')->result();
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
//                $this->db->join('fn_coa_master_sub_child','fee_heads.fn_coa_mc_id=fn_coa_master_sub_child.fn_coa_mc_id');
                if($where):
                    $this->db->where($where);
                endif;
                return  $this->db->get('fee_heads')->row();
    }
    public function get_class_setup($where=NULL){
               
                
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_class_setups.sub_pro_id');
                $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=fee_class_setups.batch_id');
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_class_setups.pc_id');
                $this->db->join('fee_heads','fee_heads.fh_id=fee_class_setups.fh_id');
                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                $this->db->order_by('fcs_id','desc');
                $this->db->where('prospectus_batch.status','on');
//                $this->db->order_by('batch_name','asc');
                if($where):
                    $this->db->where($where);
                endif;
                
       return $this->db->get('fee_class_setups')->result();
        
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
                        fee_class_setups.fee_to,
                        fee_class_setups.fee_from,
                        fee_class_setups.valid_till,
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
                        shift.name as shift_name'
                       );
                
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_catetory_wise.sub_pro_id');
                $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_catetory_wise.pc_id');
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                $this->db->join('shift','shift.shift_id=fee_catetory_wise.shift_id');
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
                        shift.name as shift_name,
                       '
                       );
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_total_anual.sub_pro_id');
                $this->db->join('programes_info','programes_info.programe_id=fee_total_anual.program_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=fee_total_anual.batch_id');
                $this->db->join('shift','shift.shift_id=fee_total_anual.shift_id');
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
                 $this->db->join('prospectus_batch','prospectus_batch.batch_id=sections.batch_id','left outer');    
        return  $this->db->where($where)->get('sections')->result();
    }
     public function fee_challan_students_fee_generate($where=Null){
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                             student_record.batch_id,
                             student_record.student_id,
                             student_record.sub_pro_id,
                             student_record.programe_id,
                             student_record.student_name,
                             student_record.father_name,
                             sections.name as sectionsName,
                             sections.sec_id as section_id,
                             student_status.name as current_status
                             
                             
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
                $this->db->where_in('student_status.s_status_id',array('5','12')); // 5 = Enrolled, 12 = Suspended
//                 $this->db->where('student_status.s_status_id',5);
//                 $this->db->where('student_status.s_status_id',12);
                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.student_id','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->result();
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
                             student_record.migration_status,
                             student_record.father_name,
                             sections.name as sectionsName,
                             student_status.name as current_status,
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
                $this->db->where_in('student_status.s_status_id',array('5','12'));
                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.student_id','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->result();
    }
 
       public function fee_challan_filters_count($where=Null,$like=NULL,$date=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.s_status_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        fee_challan.fc_challan_id,
                        fee_challan_status.fcs_title,
                        fee_challan.fc_edit_challan_id,
                        fee_challan.challan_id_lock,
                        fee_challan_status.ch_status_id,
                        fee_challan.fc_pay_cat_id,
                        sub_programes.sub_pro_id,
                        gender.title as gender_title,
                        fee_challan.fc_issue_date,
                        fee_challan.fc_paiddate,
                        fee_challan.fc_pay_cat_id,
                    ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
               // $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('gender','gender.gender_id=student_record.gender_id');
                
                if($date['from'] == ''):
                   $this->db->where('fee_challan.fc_issue_date <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fee_challan.fc_issue_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
               
               
                if($where):
                    $this->db->where($where);
                endif;
 
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('college_no','asc');
                $this->db->order_by('fc_challan_id','asc');
        return  $this->db->get('student_record')->result();
    } 
    
     public function fee_challan_filters($where=Null,$like=NULL,$date=NULL){
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
                        fee_challan.section_id_paid,
                        fee_challan.fc_pay_cat_id,
                        fee_challan.batch_id_paid,
                        fee_challan.fc_issue_date,
                        fee_challan.fc_challan_credit_amount as credit_amount,
                        fee_challan.challan_id_lock,
                        fee_challan.fc_paiddate,
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                        fee_category_titles.title as fee_installment,
                        student_status.name as student_status,
                        prospectus_batch.batch_name,
                        fee_challan.fc_challan_type,
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
                
                if($date['from'] == ''):
                   $this->db->where('fee_challan.fc_issue_date <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fee_challan.fc_issue_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
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
                  'challan_id'          => $row->fc_challan_id,  
                  'old_balance_pc_id '  => 0,
                  'delete_head_flag'    => 1, 
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
               'section_id_paid'    => $row->section_id_paid,
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
               'batch_id_paid'      => $row->batch_id_paid,
               'fc_challan_id'      => $row->fc_challan_id,
               'fcs_title'          => $row->fcs_title,
               'ch_status_id'       => $row->ch_status_id,
               'fc_pay_cat_id'      => $row->fc_pay_cat_id,
               'fc_issue_date'      => $row->fc_issue_date,
               'fc_paiddate'        => $row->fc_paiddate,
               'credit_amount'      => $row->credit_amount,
               'fee_installment'    => $row->fee_installment,
               'batch_name'         => $row->batch_name,
               'fc_challan_type'    => $row->fc_challan_type,
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
       public function fee_challan_filters2($where=Null,$like=NULL,$date=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        fee_challan.fc_challan_id,
                        sections.name as sessionName, 
                        fee_challan_status.fcs_title,
                        fee_challan_status.ch_status_id,
                        fee_challan.fc_pay_cat_id,
                        fee_challan.fc_issue_date,
                         fee_challan.challan_id_lock,
                        fee_challan.fc_paiddate,
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                        fee_category_titles.title as fee_installment,
                        student_status.name as student_status
                    ');
            
                    $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                    $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
               // $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id');
                    $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                    $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                
                if($date['from'] == ''):
                   $this->db->where('fee_challan.fc_issue_date <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fee_challan.fc_issue_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->group_by('fee_challan.fc_challan_id');
                $this->db->order_by('college_no','asc');
                $this->db->order_by('fc_challan_id','asc');
       $result =   $this->db->get('student_record')->result();
//       echo '<pre>';print_r($result);die;
        $return_array = '';
        foreach($result as $row):
            
            //Fee Details 
            $where = array(
              'challan_id'=>$row->fc_challan_id  
            );
                        $this->db->select('sum(actual_amount)as actualAmount,sum(paid_amount) as paidAmount,sum(balance) as balance');
            $payments = $this->db->get_where('fee_actual_challan_detail',$where)->row();
            
               $where_curr = array(
                  'challan_id'=>$row->fc_challan_id,  
                  'old_balance_pc_id '=>0  
                );
                        $this->db->select('sum(actual_amount)as current_amount');
            $payments_crrent = $this->db->get_where('fee_actual_challan_detail',$where_curr)->row();
            
               $where_arre = array(
                  'challan_id'=>$row->fc_challan_id,  
                  'old_balance_pc_id !='=>0  
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
               'fee_installment'    => $row->fee_installment,
               'current'            => $payments_crrent->current_amount,
               'arrears'            => $payments_arrears->arrears_amount,
               'total_upPaid'       => $payments->actualAmount,
               'total_Paid'         => $payments->paidAmount,
               'total_balance'      => $payments->balance,
               'concession'         => $concession->concession_amount,
//               'old_balance_pc_id'  => $payments->old_balance_pc_id,
                      
           );
        endforeach;
//                echo '<pre>';print_r($return_array);die;
        
               return   json_decode(json_encode($return_array), FALSE);
        
 
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
    
    public function fee_bank_reconcilition($where=Null,$like=NULL,$date,$heads=NULL){
            $this->db->select(
                    '   student_record.form_no,
                        student_record.college_no,
                        student_record.student_name,
                        student_record.batch_id,
                        prospectus_batch.batch_name,
                        sections.name as sessionName,
                        student_status.name as student_status,
                        fee_category_titles.title as payment_title,
                        fee_challan.fc_challan_id,
                        fee_concession_detail.concession_amount as Concession_amount,
                        fee_challan.fc_challan_credit_amount,
                        fee_challan.fc_paiddate as challan_paid_date,
                        student_record.student_id,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        sub_programes.sub_pro_id,
                        fee_challan.fc_challan_credit_amount,
                        fee_challan.section_id_paid,
                        fee_challan.fc_pay_cat_id as fc_pay_cat_id,
                       ');
            
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_concession_challan','fee_concession_challan.challan_id=fee_challan.fc_challan_id','left outer');
                //Concession Amount
                $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                // Payment Category 
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left outer');
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));//1= not paid,4 = cancel
                
 
                if($date['from'] == ''):
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('fc_challan_id','asc');
                $this->db->order_by('fee_challan.fc_paiddate','asc');
                $this->db->order_by('fee_challan.fc_challan_id','asc');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('student_record.form_no','asc');
           
         $result =  $this->db->get('student_record')->result();
         
         
         $array = '';
         foreach($result as $row):
             
             $fee_section =  $this->db->get_where('sections',array('sec_id'=>$row->section_id_paid))->row();
                $paid_secstion = '';
            if($fee_section):
                $paid_secstion = $fee_section->name;
                else:
                $paid_secstion = $row->sessionName;
            endif;
             
             
             $this->db->select(
                     '
                        sum(fee_actual_challan_detail.paid_amount)      as paid_total_sum,
                        sum(fee_actual_challan_detail.actual_amount)    as actual_total_sum,
                        
                     ');
                        $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id'); 
                        $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id'); 
                        $this->db->where('delete_head_flag','1');
                       if($heads):
                           $this->db->where($heads); 
                       endif;
                       
            $amount =   $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$row->fc_challan_id))->row();
           if($amount->paid_total_sum > 0):
               $array[] = array(
                    
                    'fc_challan_id'             => $row->fc_challan_id,
                    'fc_challan_credit_amount'  => $row->fc_challan_credit_amount,
                    'college_no'                => $row->college_no,
                    'student_name'              => $row->student_name,
                    'batch_id'                  => $row->batch_id,
                    'student_id'                => $row->student_id,
                    'form_no'                   => $row->form_no,
                    'programe_name'             => $row->programe_name,
                    'sub_program_name'          => $row->sub_program_name,
                    'sub_pro_id'                => $row->sub_pro_id,
                    'batch_name'                => $row->batch_name,
                    'sessionName'               => $paid_secstion,
//                    'sessionName'               => $row->sessionName,
                    'challan_paid_date'         => $row->challan_paid_date,
                    'fc_challan_credit_amount'  => $row->fc_challan_credit_amount,
                    'fc_pay_cat_id'             => $row->fc_pay_cat_id,
                    'student_status'            => $row->student_status,
                    'Concession_amount'         => $row->Concession_amount,
                    'payment_title'             => $row->payment_title,
                    'paid_total_sum'            => $amount->paid_total_sum,
                    'actual_total_sum'          => $amount->actual_total_sum,
                  
                    );
           endif;
            
            
        endforeach;
     
//        array_filter($array)
        
         return   json_decode(json_encode($array), FALSE);
    }
  
    
    public function fee_bank_reconcilition_date_wise($where=NULL,$date,$head=NULL){
 
        $this->db->select(
                    '    
                        fee_challan.fc_challan_id,
                        student_record.college_no,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sum(fee_actual_challan_detail.paid_amount) as total_sum,
                        fee_challan.fc_paiddate as challan_paid_date,
                        fee_challan.fc_comments as fc_comments,
                        fee_challan.fc_challan_credit_amount,
                        
                      ');
            
                        $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                        $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                        $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                        $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                        // Payment Category 
                        $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left outer');
                        $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left outer');
                        
                        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                        $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                        $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
                        $this->db->where('delete_head_flag','1');
 
                if($where):
                    $this->db->where($where);
                    
                endif;
                if($head):
                    $this->db->where($head);
                endif;
                //$this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                if($date['from'] == ''):
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                $this->db->group_by('fee_challan.fc_paiddate');
                $this->db->order_by('fee_challan.fc_paiddate','asc');
        $result = $this->db->get('student_record')->result();
       
        $array  = '';
          
          foreach($result as $row):
              
  
              $date2['from'] = $row->challan_paid_date;
              $date2['to']   = $row->challan_paid_date;
              $crdit         = $this->fee_bank_reconcilition_date_wise_credit($where,$date2);
               
              $array[] = array(
                'total_sum'         =>$row->total_sum,  
                'challan_paid_date' =>$row->challan_paid_date,  
                'credit'            =>$crdit->fc_challan_credit_amount,  
              );
              
          endforeach;
       
        return   json_decode(json_encode($array), FALSE);
          
    }
    public function fee_bank_reconcilition_date_wise_credit($where=NULL,$date=NULL){
 
        $this->db->select(
                    '    
                        fee_challan.fc_challan_id,
                        student_record.college_no,
                        sum(fee_challan.fc_challan_credit_amount) as fc_challan_credit_amount,
                        fee_challan.fc_paiddate as challan_paid_date,
                        
                        
                      ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
//                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
//                $this->db->join('fee_concession_challan','fee_concession_challan.challan_id=fee_challan.fc_challan_id','left outer');
                //Concession Amount
//                $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                // Payment Category 
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left outer');
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left outer');
                
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
                
                
                if($where):
                    $this->db->where($where);
                endif;
                
                //$this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                if(empty($date['from'])):
                  
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
//                $this->db->group_by('fee_challan.fc_paiddate');
                $this->db->order_by('fee_challan.fc_paiddate','asc');
//          echo "<pre>";print_R($this->db->get('student_record')->row());
          return $this->db->get('student_record')->row();
 
    }
    public function fee_bank_reconcilition_head_wise($where=NULL,$where_head=NULL,$date=NULL){
          
//                $this->db->select('
//                    fh_head
//                        ');
                
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
                
                   if(empty($date['from'])):
                  
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                if($where_head):
                    $this->db->where($where_head);
                endif;
                $this->db->where('delete_head_flag','1'); 
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
                 
         return $this->db->get('fee_challan')->result();

//         return   json_decode(json_encode($array), FALSE);
////        echo '<pre>';print_r($this->db->get('fee_challan')->result());die;
    }
    
   public function fee_bank_reconcilition_head_wise_section1($where,$where_head=NULL,$date){
             
        
                $this->db->select(
                 '
                  sections.name as sessionName,
                  student_record.student_name as studentName,
                  programes_info.programe_name,
                  prospectus_batch.batch_name,
                  programes_info.programe_id,
                  
                  sum(fee_actual_challan_detail.paid_amount) as paid_amount
                 ');
                
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('sections','sections.sec_id=fee_challan.section_id_paid','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));  
                $this->db->where('delete_head_flag','1');
                if($where):
                    $this->db->where($where);
                endif;
                if($where_head):
                    $this->db->where($where_head);
                endif;
               if($date['from'] == ''):
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                //$this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                 $this->db->group_by('sections.sec_id');
                 $this->db->order_by('sections.name','asc');
        return  $this->db->get('fee_challan')->result();
    }
    public function fee_bank_reconcilition_head_wise_section($where,$where_head=NULL,$date){
             
        
                $this->db->select(
                 '
                  sections.name as sessionName,
                  student_record.student_name as studentName,
                  programes_info.programe_name,
                  prospectus_batch.batch_name,
                  programes_info.programe_id,
                  sum(fee_actual_challan_detail.paid_amount) as paid_amount
                 ');
                
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));  
                $this->db->where('delete_head_flag','1');
                if($where):
                    $this->db->where($where);
                endif;
                if($where_head):
                    $this->db->where($where_head);
                endif;
               if($date['from'] == ''):
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                //$this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                 $this->db->group_by('sections.sec_id');
                 $this->db->order_by('sections.name','asc');
        return  $this->db->get('fee_challan')->result();
    }
    public function fee_bank_reconcilition_head_wise_student($where=Null,$like=NULL,$date=NULL){
 
                $this->db->select(
                 '
                  sections.name as sessionName,
                  student_record.college_no,
                  student_record.student_id,
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
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
                $this->db->where('delete_head_flag','1');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               if($date['from'] == ''):
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
               // $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                 $this->db->group_by('student_record.student_id');
                 $this->db->order_by('sections.name','asc');
        return  $this->db->get('fee_challan')->result();
    }
    public function fee_bank_reconcilition_head_wise_student_credit($where=Null,$like=NULL,$date=NULL){
 
                $this->db->select(
                 '
                  sections.name as sessionName,
                  student_record.college_no,
                  student_record.student_name,
                  student_record.student_name as studentName,
                  programes_info.programe_name,
                  prospectus_batch.batch_name,
                  sum(fee_challan.fc_challan_credit_amount) as fc_challan_credit_amount
                  
                 ');
                
//                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
//                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
//                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  
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
               if($date['from'] == ''):
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                //$this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                 
                 
        return  $this->db->get('fee_challan')->row();
    }
    public function fee_challan_filters_classWise_new($where=Null){
            $this->db->select(
                        '
                        student_record.college_no,
                        student_record.form_no,
                        student_record.student_id,
                        student_record.student_name,
                        student_record.father_name,
                        fee_challan.fc_challan_id,
                        fee_challan.fc_paid_form,
                        fee_challan.fc_paid_upto,
                        fee_challan.fc_issue_date,
                        fee_challan.fc_dueDate,
                        fee_challan.fc_comments,
                        fee_challan.fc_pay_cat_id,
                        fee_challan.fc_challan_rq,
                        fc_challan_type,
                        sections.name as sectionName,
                        sub_programes.name as subProName,
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                        prospectus_batch.batch_name,
                        bank.name as BankName,
                        bank.account_no as Bank_account_no,
                    ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('bank','bank.bank_id=fee_challan.fc_bank_id');
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                  $this->db->where_in('student_record.s_status_id',array('5','12'));
                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->order_by('student_record.college_no');
                return  $this->db->get('student_record')->result();
    }
    public function fee_challan_filters_classWise($where=Null,$like=NULL){
            $this->db->select(
                        '
                        student_record.college_no,
                        student_record.form_no,
                        student_record.student_id,
                        student_record.student_name,
                        student_record.father_name,
                        fee_challan.fc_challan_id,
                        fee_challan.fc_paid_form,
                        fee_challan.fc_paid_upto,
                        fee_challan.fc_issue_date,
                        fee_challan.fc_dueDate,
                        fee_challan.fc_comments,
                        fee_challan.fc_pay_cat_id,
                        fee_challan.fc_challan_rq,
                        fc_challan_type,
                        sections.name as sectionName,
                        sub_programes.name as subProName,
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
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
                $this->db->order_by('student_record.college_no');
                return  $this->db->get('student_record')->result();
    }
    
    public function get_Student_feeDetails_search($where){
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
       return $this->db->where($where)->get('fee_actual_challan_detail')->result();
    }
    public function feeDetails_head_print($where){
                $this->db->select(
                        '   fee_class_setups.fh_Id,
                            fee_heads.fh_head,
                            fee_actual_challan_detail.paid_amount,
                            fee_actual_challan_detail.old_credit_amount
                        ');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');                         
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                $this->db->where($where);
                $this->db->group_by('fee_heads.fh_Id'); 
                $this->db->order_by('fh_head','asc');
       return   $this->db->get('fee_challan')->result();
    }
    public function feeDetails_arrears_print($where){
               $this->db->select(
                       'fc_challan_id,
                       balance,
                       sum(balance) as arrears_balance,
                       sum(actual_amount) as sum_actual_amount,
                       sum(paid_amount) as sum_paid_amount');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');                         
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
        
                $this->db->where($where);
           return $this->db->get('fee_challan')->row();
//           echo '<pre>';print_r($this->db->last_query());
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
                         fee_actual_challan_detail.comment,   
                         fee_actual_challan_detail.challan_status,   
                         fee_actual_challan_detail.old_balance_pc_id,   
                         fee_actual_challan_detail.challan_id,   
                         fee_heads.fh_head as fh_head,   
                         fee_actual_challan_detail.fee_id as fee_id,   
                         fee_actual_challan_detail.challan_detail_id,
                         fee_actual_challan_detail.add_new_heads_flag
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
        $this->db->select(
                'reserved_seat.name as Seat_name,
                sub_programes.name,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                
                student_record.programe_id,
                student_record.sub_pro_id,
                student_record.shift_id,
                
                student_status.s_status_id as StudentStatusId,
                student_status.name as student_status,
                ');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $this->db->where('timestamp >= date_sub(now(),interval 5 month)');
        $this->db->order_by('form_no','asc');
        $this->db->join("sub_programes","sub_programes.sub_pro_id=student_record.sub_pro_id");
        $this->db->join("reserved_seat","reserved_seat.rseat_id=student_record.rseats_id",'left outer');
        $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
        $this->db->where_in('student_status.s_status_id',array('1','15'));
        return $this->db->get('student_record')->result();
    }
    
    public function get_apply_student_merit($where=NULL,$like=NULL){
        $this->db->select(
                'reserved_seat.name as Seat_name,
                sub_programes.name,
                student_record.form_no,
                student_record.student_name,
                student_record.gender_id,
                student_record.father_name,
                student_record.student_id,
                student_record.programe_id,
                student_record.sub_pro_id,
                student_record.shift_id,
                shift.name as ShiftName,
                gender.title as GenderName,
                student_status.s_status_id as StudentStatusId,
                student_status.name as student_status,
                ');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $this->db->where('timestamp >= date_sub(now(),interval 2 month)');
         
        $this->db->order_by('form_no','asc');
        $this->db->join("sub_programes","sub_programes.sub_pro_id=student_record.sub_pro_id");
        $this->db->join("reserved_seat","reserved_seat.rseat_id=student_record.rseats_id",'left outer');
        $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
        $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
        $this->db->where_in('student_status.s_status_id',array('1','15'));
        return $this->db->get('student_record')->result();
    }
    
    public function admission_challan_gen($where=NULL){
        
                $this->db->join("fee_class_setups","fee_class_setups.pc_id=fee_payment_category.pc_id");
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
        return  $this->db->where($where)->get('fee_payment_category')->result();
    }
    public function full_payment_info($where=NULL){
                    
                    $this->db->select(
                            '
                               fee_heads.fh_head, 
                               fee_actual_challan_detail.actual_amount,
                               fee_actual_challan_detail.old_balance_pc_id,
                               fee_class_setups.fcs_id, 
                            ');
                    
                  $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                  $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                    $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
        return  $this->db->where($where)->get('fee_challan')->result();
    }
    
     public function fee_concession($where=Null,$like=NULL,$date){
            $this->db->select(
                    '   fee_challan.fc_challan_id,
                        student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sections.name as sessionName, 
                        fee_challan.fc_paiddate as challan_paid_date,
                        fee_challan.fc_comments as fc_comments,
                        fee_challan.fc_challan_id,
                        fee_challan_status.fcs_title,
                        fee_concession_type.title as concession_type,
                      ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                $this->db->join('fee_concession_challan','fee_concession_challan.challan_id=fee_challan.fc_challan_id');
                $this->db->join('fee_concession_type','fee_concession_type.concess_type_id=fee_concession_challan.concess_type_id');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                
                if(empty($date['from'])):
                     $this->db->where('fee_challan.fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                      $this->db->where('fee_challan.fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
             
                endif;
                
                
//                $this->db->where('fee_challan.fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('student_record.student_id','asc');
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
                       fee_challan.fc_ch_status_id,
                      fee_challan.fc_paiddate as challan_paid_date,
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
    
    
      public function fee_refund($where=Null,$like=NULL,$date){
            $this->db->select(
                    '   
                        student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sections.name as sessionName,
                        fee_challan.fc_challan_id,
                        fee_challan.fc_paiddate,
                        fee_refund_challan.comments as Reasons,
                        fee_refund_challan.date as refund_date,
                        applicant_edu_detail.obtained_marks,
                        applicant_edu_detail.total_marks,
                      ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                
                $this->db->join('fee_refund_challan','fee_refund_challan.challan_id=fee_challan.fc_challan_id');
                $this->db->join('fee_refund_detail','fee_refund_detail.refund_id=fee_refund_challan.refund_id');

                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                
                
                 if(empty($date['from'])):
                     $this->db->where('fee_refund_challan.date <=',date('Y-m-d', strtotime($date['to'])));
                else:
                      $this->db->where('fee_refund_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                endif;
              //  $this->db->where('fee_refund_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('student_record.student_id','asc');
                $this->db->order_by('fee_refund_challan.date','desc');
                $this->db->order_by('student_record.college_no','asc');
        return  $this->db->get('student_record')->result();
    }
     public function fee_refund_head_wise($where=Null,$like=Null,$date=Null){
        
                $this->db->select(
                    '   
                        fee_heads.fh_head,
                        sum(fee_refund_detail.refund_amount) as total_refund
                      ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                
                $this->db->join('fee_refund_challan','fee_refund_challan.challan_id=fee_challan.fc_challan_id');
                $this->db->join('fee_refund_detail','fee_refund_detail.refund_id=fee_refund_challan.refund_id');
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_refund_detail.fh_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');

//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                
                
                 if(empty($date['from'])):
                     $this->db->where('fee_refund_challan.date <=',date('Y-m-d', strtotime($date['to'])));
                else:
                      $this->db->where('fee_refund_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                endif;
              //  $this->db->where('fee_refund_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               

                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('fee_challan.fc_challan_id','asc');
        return  $this->db->get('student_record')->result();  
                
    }
        public function fee_refund_head_wise_student($where=Null,$like=Null,$date=Null){
            
                $this->db->select('   
                        fee_heads.fh_Id,
                        fee_heads.fh_head,
                        ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                
                $this->db->join('fee_refund_challan','fee_refund_challan.challan_id=fee_challan.fc_challan_id');
                $this->db->join('fee_refund_detail','fee_refund_detail.refund_id=fee_refund_challan.refund_id');
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_refund_detail.fh_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');

//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                
                
                 if(empty($date['from'])):
                     $this->db->where('fee_refund_challan.date <=',date('Y-m-d', strtotime($date['to'])));
                else:
                      $this->db->where('fee_refund_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                endif;
              //  $this->db->where('fee_refund_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               

                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('fee_challan.fc_challan_id','asc');
        $result =   $this->db->get('student_record')->result();  
        
        foreach($result as $row):
            $this->db->select(
                    '   
                        student_record.student_name,
                        student_record.college_no,
                        student_record.father_name,
                        fee_refund_detail.refund_amount,
                        
                        
                      ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                
                $this->db->join('fee_refund_challan','fee_refund_challan.challan_id=fee_challan.fc_challan_id');
                $this->db->join('fee_refund_detail','fee_refund_detail.refund_id=fee_refund_challan.refund_id');
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_refund_detail.fh_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                
                
                 if(empty($date['from'])):
                     $this->db->where('fee_refund_challan.date <=',date('Y-m-d', strtotime($date['to'])));
                else:
                      $this->db->where('fee_refund_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                endif;
              //  $this->db->where('fee_refund_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->where('fee_heads.fh_Id',$row->fh_Id);
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('fee_challan.fc_challan_id','asc');
    $result_student =   $this->db->get('student_record')->result(); 
        $return_array[] = array(
          'fh_Id'=>$row->fh_Id,
          'fh_head'=>$row->fh_head,
           'student_det'=>  $result_student            
        );
    endforeach;
        
        if(!empty($return_array)):
             return   json_decode(json_encode($return_array), FALSE);
        endif;
        
            
                
    }
    public function fee_refund_degree($where=Null,$like=NULL,$date){
            $this->db->select(
                    '   
                        student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sections.name as sessionName,
                        fee_challan.fc_challan_id,
                        fee_challan.fc_paiddate,
                        fee_refund_challan.date as refund_date,                        
                      ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                
                $this->db->join('fee_refund_challan','fee_refund_challan.challan_id=fee_challan.fc_challan_id');
                $this->db->join('fee_refund_detail','fee_refund_detail.refund_id=fee_refund_challan.refund_id');

                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                $this->db->where_in('programes_info.programe_id',array(2,4,6,8,9,14));
                
                 if(empty($date['from'])):
                     $this->db->where('fee_refund_challan.date <=',date('Y-m-d', strtotime($date['to'])));
                else:
                      $this->db->where('fee_refund_challan.date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                endif;
              if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('student_record.student_id','asc');
                $this->db->order_by('student_record.college_no','asc');
        return  $this->db->get('student_record')->result();
    }
     public function refund_std_wise($where){

              $this->db->select('
                      fee_challan.fc_challan_id,
                      fee_challan_status.fcs_title,
                      sum(fee_refund_detail.refund_amount) as total_refund_amount,
                      '
                      );
                    $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                    $this->db->join('fee_refund_challan','fee_refund_challan.challan_id=fee_challan.fc_challan_id');
                    $this->db->join('fee_refund_detail','fee_refund_detail.refund_id=fee_refund_challan.refund_id');
                      
                
                    
        return  $this->db->where($where)->get('fee_challan')->row();     
                
    }
    
      public function search_other_payment($where=NULL,$like=NULL){
        $this->db->select(
                'reserved_seat.name as Seat_name,
                 sub_programes.name,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                student_status.name as student_status,
                 
                ');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        
        $this->db->join("sub_programes","sub_programes.sub_pro_id=student_record.sub_pro_id");
        $this->db->join("reserved_seat","reserved_seat.rseat_id=student_record.rseats_id");
         $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
        //$this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
        //$this->db->join("fee_payment_category",'fee_payment_category.pc_id=fee_challan.fc_pay_cat_id');
        //$this->db->join("fee_category_titles",'fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
        //$this->db->join("fee_challan_status",'fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
        
//        $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
        $this->db->order_by('form_no','asc');
//        $this->db->group_by('fee_challan.fc_challan_id','asc');
        
        return $this->db->get('student_record')->result();
    } 
    
        public function student_fine_search($where=Null,$like=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                         sub_programes.sub_pro_id,
                         
                    ');
            
//                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
//                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id');
                
               
                if($where):
                    $this->db->where($where);
                endif;
//                 if($date):
//                  
//                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->order_by('college_no','asc');
//                $this->db->order_by('fc_challan_id','asc');
        return  $this->db->get('student_record')->result();
    }
    
      public function get_fined_student_info($where){
          
                $this->db->select('
                        student_record.student_id,
                        student_record.college_no,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        sections.name as sectionName,
                        programes_info.programe_name as Program, 
                        sub_programes.name as subProgram, 
                        prospectus_batch.batch_name, 
                        '
                        );
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('occupation','occupation.occ_id=student_record.guardian_occupation','left outer');
        return  $this->db->where($where)->get('student_record')->row();
    }

    public function student_fine_info($where){
                $this->db->select(
                        '
                  
                        fee_extra_heads.fine_date,
                        fee_extra_heads.fine_comments,
                        fee_extra_heads.apply_status,
                        fee_extra_heads.amount,
                        fee_extra_heads.fh_id,
                        fee_heads.fh_head,
                        fee_extra_heads_status.fine_title,
                        fee_extra_heads.id as fee_id
                        '
                        );
                 $this->db->join('fee_extra_heads_status','fee_extra_heads_status.id=fee_extra_heads.apply_status');
                 $this->db->join('fee_heads','fee_heads.fh_Id=fee_extra_heads.fh_Id');
                 $this->db->order_by('fee_extra_heads.id','desc');
         return  $this->db->where($where)->get('fee_extra_heads')->result();
    }
 public function fee_defaulter($where=Null,$like=NULL,$date=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        fee_challan.fc_challan_id,
                        fee_challan_status.fcs_title,
                        fee_challan.fc_edit_challan_id,
                        fee_challan_status.ch_status_id,
                        fee_challan.fc_pay_cat_id,
                        sub_programes.sub_pro_id,
                        
                        fee_challan.fc_issue_date,
                        fee_challan.fc_paiddate,
                        fee_category_titles.title as installment_name,
                        fee_balance.r_amount as challan_balance,
                        sections.name as Group,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                    ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_balance','fee_balance.student_id=student_record.student_id');
//                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                
                
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id');
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id');
               // $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                 
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
                
                if($date['from'] == ''):
                   $this->db->where('fee_challan.fc_issue_date <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fee_challan.fc_issue_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
               
               
                if($where):
                    $this->db->where($where);
                endif;
//                 if($date):
//                  
//                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->group_by('fee_balance.pay_cat_id');
                $this->db->order_by('sub_program','asc');
                $this->db->order_by('Group','asc');
                $this->db->order_by('fc_challan_id','asc');
        return  $this->db->get('student_record')->result();
    } 
     
      
    public function full_defaulter($where=Null,$amount=NULL,$like=NULL){
     
         
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
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
              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'delete_head_flag'=>1))->result();
             
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
                                        $this->db->having('balance >=',$amount);
                                    endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>1,'userId'=>$this->userInfo->user_id))->row();
                   if(!empty($balance_result)):
                  if($balance_result->balance > 0):
                      $attendance = $this->CRUDModel->get_student_attendance($students->student_id,$students->sec_id);
                        $marks = $this->CRUDModel->get_student_montly_marks($students->student_id,$students->sec_id);
        $balance_array[] = array(
            
             
                   'sub_pro_id'     => $students->sub_pro_id,
                   'programe_id'    => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
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
                endif;
                 
                  
                  
            endforeach;
                if(!empty($balance_array)):
                    $keys   = array_column($balance_array, 'attendance');
                    array_multisort($keys, SORT_ASC, $balance_array);
                    return      json_decode(json_encode($balance_array), FALSE);
                    else:
                    return false;
            endif;
       
 
    
}
    public function fee_defaulter_head($where=Null,$amount=NULL,$fee_head=NULL){
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
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
            ; 
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
                //**************************************
                //Fee Balance 
                //**************************************
                                $this->db->select('fc_challan_id,balance,fh_Id');    
                                $this->db->order_by('fc_challan_id','asc');
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
//              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'delete_head_flag'=>1))->result();
              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'delete_head_flag'=>1,'balance>'=>'0'))->result();
                
              $fee_balance  = '';
              $fee_head_array     = array();
               foreach($challan_info as $blc):
                    
                        $fee_balance       +=$blc->balance;  
                        $fee_head_array[]  = $blc->fh_Id;  
                   
                endforeach;
                
                if(in_array($fee_head, $fee_head_array)):
                        if($fee_balance>0):
                            $show_balance   = $fee_balance;
                            $data_fee       = array(
                            'sub_pro_id'          => $students->sub_pro_id,
          //                   'programe_id'        => $students->programe_id,
                             'college_no'         => $students->college_no,
                             'StudentMobile'      => $students->applicant_mob_no1,
                             'FatherMobile'       => $students->mobile_no,
                             'student_id'         => $students->student_id,
                             'prospectus_batch'   => $students->batch_name,
                             'form_no'            => $students->form_no,
                             'sub_program'        => $students->sub_program,
                             'group_name'         => $students->Group,
                             'student_name'       => $students->student_name,
                             'father_name'        => $students->father_name,
                             'student_status'     => $students->student_status, 
                            'student_id'          => $students->student_id,  
                            'balance'             => $show_balance,  
                            'default_type'        => 1,  
                            'userId'              => $this->userInfo->user_id,  
                            'timestamp'           => date('Y-m-d H:i:s'),  

                          );
                    $this->CRUDModel->insert('fee_defaulter',$data_fee);
               
                    endif; 
                endif;
            endforeach;
             
                    $this->db->order_by('balance','desc');   
                    $this->db->where('balance >',$amount);
             return $this->db->get_where('fee_defaulter',array('default_type'=>1,'userId'=>$this->userInfo->user_id))->result();
             
//            if(!empty($balance_array)):
//                       $keys   = array_column($balance_array, 'balance');
//                array_multisort($keys, SORT_DESC, $balance_array);
//             return      json_decode(json_encode($balance_array), FALSE);
//            endif;
     
 
    }
    public function Feedefaulter($where=Null,$amount=NULL,$like=NULL){
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
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
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
                //**************************************
                //Fee Balance 
                //**************************************
                                $this->db->select('fc_challan_id,balance');    
                                $this->db->order_by('fc_challan_id','asc');
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'delete_head_flag'=>1))->result();
                
              $fee_balance = '';
              
                foreach($challan_info as $blc):
                        
                      $fee_balance +=$blc->balance;  
                    
                endforeach;
               if($fee_balance>0):
                  $data_fee = array(
                  'student_id'      => $students->student_id,  
                  'balance'         => $fee_balance,  
                  'default_type'    => 2,  
                  'userId'          => $this->userInfo->user_id,  
                  'timestamp'       => date('Y-m-d H:i:s'),  
                   
                );
                $this->CRUDModel->insert('fee_defaulter',$data_fee);
               
               endif; 
                 
                                $this->db->select_sum('balance');
                                if($amount):
                                    $this->db->where('balance >=',$amount);
                                endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>2,'userId'=>$this->userInfo->user_id))->row();
                  if(!empty($balance_result)):
                      if($balance_result->balance > 0):
                        $attendance     = $this->CRUDModel->get_student_attendance($students->student_id,$students->sec_id);
                        $marks          = $this->CRUDModel->get_student_montly_marks($students->student_id,$students->sec_id);
                    $balance_array[] = array(
            
             
                   'sub_pro_id'     => $students->sub_pro_id,
                   'programe_id'     => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
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
                 endif;
                  
                  
            endforeach;
            
            if(!empty($balance_array)):
                       $keys   = array_column($balance_array, 'attendance');
                array_multisort($keys, SORT_ASC, $balance_array);
             return      json_decode(json_encode($balance_array), FALSE);
            endif;
     
 
    }
    public function hostel_and_mess_defaulter($where=Null,$amount=NULL,$like=NULL){
     
         
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        programes_info.programe_id,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
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
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
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
                            'default_type'    => 3,  
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
                            'default_type'    => 3,  
                            'userId'       => $this->userInfo->user_id,
                            'timestamp'    => date('Y-m-d H:i:s'),

                          );
                       $this->CRUDModel->insert('fee_defaulter',$data_mess);

                        
                        
                    endif;
                  endif;
                                    $this->db->select_sum('balance');
                                    if($amount):
                                        $this->db->having('balance >=',$amount);
                                    endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>3,'userId'=>$this->userInfo->user_id))->row();
                  if(!empty($balance_result)):
                     if($balance_result->balance > 0):
                   $attendance = $this->CRUDModel->get_student_attendance($students->student_id,$students->sec_id);
                     $marks = $this->CRUDModel->get_student_montly_marks($students->student_id,$students->sec_id);
                    $balance_array[] = array(
            
             
                   'sub_pro_id'     => $students->sub_pro_id,
                   'programe_id'     => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
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
                 endif;
                  
                  
            endforeach;
         if(!empty($balance_array)):
                       $keys   = array_column($balance_array, 'attendance');
                array_multisort($keys, SORT_ASC, $balance_array);
             return      json_decode(json_encode($balance_array), FALSE);
            endif;
 }
    public function hostel_defaulter($where=Null,$amount=NULL,$like=NULL){
     
         
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
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
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
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
                            'default_type'    => 4,  
                            'userId'            => $this->userInfo->user_id,  
                            'timestamp'         => date('Y-m-d H:i:s'),    
                          );
                       $this->CRUDModel->insert('fee_defaulter',$data_hostel);

                        
                        
                    endif;
                  endif;

                                    $this->db->select_sum('balance');
                                    if($amount):
                                        $this->db->where('balance >=',$amount);
                                    endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>4,'userId'=>$this->userInfo->user_id))->row();
                  if(!empty($balance_result)):
                if($balance_result->balance > 0):
                      $attendance = $this->CRUDModel->get_student_attendance($students->student_id,$students->sec_id);
                        $marks = $this->CRUDModel->get_student_montly_marks($students->student_id,$students->sec_id);
                    $balance_array[] = array(
            
             
                   'sub_pro_id'     => $students->sub_pro_id,
                   'programe_id'     => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'student_id'     => $students->student_id,
                    'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
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
                  endif;
                 
                  
                  
            endforeach;
          if(!empty($balance_array)):
                       $keys   = array_column($balance_array, 'attendance');
                array_multisort($keys, SORT_ASC, $balance_array);
             return      json_decode(json_encode($balance_array), FALSE);
            endif;
 }
    public function mess_defaulter($where=Null,$amount=NULL,$like=NULL){
     
         
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        student_record.batch_id,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
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
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
                 
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
                            'default_type'    => 5,  
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
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>5,'userId'=>$this->userInfo->user_id))->row();
                  
                       if($balance_result->balance > 0):
                      $attendance = $this->CRUDModel->get_student_attendance($students->student_id,$students->sec_id);
                        $marks = $this->CRUDModel->get_student_montly_marks($students->student_id,$students->sec_id);
                    $balance_array[] = array(
            
             
                   'sub_pro_id'     => $students->sub_pro_id,
                   'programe_id'     => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
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
       if(!empty($balance_array)):
                       $keys   = array_column($balance_array, 'attendance');
                array_multisort($keys, SORT_ASC, $balance_array);
             return      json_decode(json_encode($balance_array), FALSE);
    endif;
 }
     public function fee_challan_student($where=Null){
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.mobile_no,
                             student_record.applicant_mob_no1,
                             student_record.father_cnic,
                             student_record.app_postal_address,
                             student_record.form_no,
                              student_record.admission_comment,
                             student_record.student_id,
                             student_record.shift_id,
                             student_record.student_name,
                             student_record.sub_pro_id,
                             student_record.programe_id,
                             student_record.father_name,
                             sections.name as sectionsName,
                             sections.sec_id as sectionsId,
                             sub_programes.name as sub_proram,
                             programes_info.programe_name as programe_name,
                             prospectus_batch.batch_name,
                             prospectus_batch.batch_id,
                             programes_info.degree_type_id,
                             student_status.name as studentStatus,
                             student_record.migration_status,
                             student_record.s_status_id,
                             applicant_edu_detail.obtained_marks,
                             applicant_edu_detail.total_marks,
                             applicant_edu_detail.percentage,
                         ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
                if($where):
                    $this->db->where($where);
                endif;
                
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('sec_id','asc');
                $this->db->order_by('applicant_edu_detail.serial_no','desc');
        return  $this->db->get('student_record')->row();
    }
     public function fee_challan_student_paid($where=Null){
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.mobile_no,
                             student_record.applicant_mob_no1,
                             student_record.app_postal_address,
                             student_record.form_no,
                              student_record.admission_comment,
                             student_record.student_id,
                             student_record.student_name,
                             student_record.sub_pro_id,
                             student_record.programe_id,
                             student_record.father_name,
                             sections.name as sectionsName,
                             sub_programes.name as sub_proram,
                             programes_info.programe_name as programe_name,
                             prospectus_batch.batch_name,
                             prospectus_batch.batch_id,
                             student_status.name as studentStatus,
                             student_record.migration_status,
                             student_record.s_status_id,
                         ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where('student_record.s_status_id != ','15');
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->row();
    }
    public function fee_challan_student_before_transfer_update_20_03_2019($where=Null){
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                              student_record.admission_comment,
                             student_record.student_id,
                             student_record.student_name,
                             student_record.sub_pro_id,
                             student_record.programe_id,
                             student_record.father_name,
                             sections.name as sectionsName,
                             sub_programes.name as sub_proram,
                             programes_info.programe_name as programe_name,
                             prospectus_batch.batch_name,
                             prospectus_batch.batch_id,
                             student_status.name as studentStatus,
                              student_record.migration_status,
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
       
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->row();
    }
            public function student_fee_details($student_id){
                   
                            $this->db->select(
                                    '
                                     
                                     fee_challan.fc_challan_id,   
                                     fee_challan.section_id_paid,   
                                     fee_challan.fc_paid_form,   
                                     fee_challan.fc_paid_upto,   
                                     fee_challan.fc_paid_upto,   
                                     fee_challan.fc_dueDate,   
                                     fee_challan.fc_issue_date,   
                                     fee_challan.fc_paiddate,   
                                     fee_challan.fc_comments,   
                                     fee_challan.fc_ch_status_id,   
                                     fee_challan.fc_challan_credit_amount,   
                                     fee_challan_status.fcs_title as challan_status,   
                                     fee_category_titles.title as payment_number,   
                                     fee_installment_type.installment_title as challan_type,   
                                     fee_extra_heads_status.fine_title,
                                     fee_extra_heads_status.id as fine_id,
                                      
                                      
                                       
                                    ');
                            $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id','left');  
                            $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left');  
                            $this->db->join('fee_extra_heads_status','fee_extra_heads_status.id=fee_challan.credit_flag');  
                            $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left');  
                            $this->db->join('fee_installment_type','fee_installment_type.id=fee_challan.fc_challan_type');  
                            $this->db->order_by('fc_challan_id','asc');
        $challan_infos  =   $this->db->where(array('fc_student_id'=>$student_id))->get('fee_challan')->result();
        
        
        $array  = '';
         foreach ($challan_infos as $challan_info):
                                    $this->db->order_by('old_balance_pc_id','asc');
                                    $this->db->order_by('fee_id','asc');
                                    $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');  
                                    $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  
                $payment_detail =   $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$challan_info->fc_challan_id))->result();
                
                $py_details_array = '';
                $arrears = '';
                $current = '';
                
                //For total 
                $tActual        = '';
                $tCredit        = '';
                $tArrears       = '';
                $tCurrent       = '';
                $tConcession    = '';
                $tPaid          = '';
                $tBalance       = '';
                foreach($payment_detail as $payment_det):
                    ///Current Amount Or Arrears
                    if($payment_det->old_balance_pc_id == 0):
                            $arrears = '';
                            $current = $payment_det->actual_amount;
                        else:
                            $arrears = $payment_det->actual_amount;
                            $current = '';
                    endif;
                     //Show Concession Amount
                     
                        $chall_con_where  = array(
                                  'fee_concession_challan.challan_id'  => $challan_info->fc_challan_id,    
                                   'fee_concession_detail.fh_id'       => $payment_det->fee_id,    
                              );

                                  $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id');
            $ch_consn =   $this->db->where($chall_con_where)->get('fee_concession_challan')->row();
//              
                     
                $con_amount = '';
                if($ch_consn == ''):
                   $con_amount = '';
               else:
                 $con_amount =   $ch_consn->concession_amount;
               endif;    
            
            //Challan Balance
               $paidAmount = '';
              
              if($challan_info->fc_ch_status_id == 2):
                  $paidAmount = $payment_det->paid_amount;
                
              elseif($challan_info->fc_ch_status_id == 3):
                  $paidAmount = $payment_det->paid_amount;
                else:
                 $paidAmount = 0;   
              endif; 
              
               $balance = $payment_det->actual_amount-$paidAmount - $con_amount;
               
               if($current > 0):
                  $balance = $balance - $payment_det->old_credit_amount;
                endif;
               
                $py_details_array[] = array(
                        'Fee_details_id'    => $payment_det->challan_detail_id,
                        'Fee_heads'      => $payment_det->fh_head, 
                        'Actual_Amount'  => $payment_det->actual_amount, 
                        'Credit_Amount'  => $payment_det->old_credit_amount,
                        'credit_adjust_flag'=> $payment_det->credit_adjust_flag,
                        'Current_Amount' => $current, 
                        'Arrears_Amount' => $arrears, 
                        'Concession'     => $con_amount, 
                        'Paid_Amount'    => $paidAmount, 
                        'Balance'        => $balance, 
                        'delete_head'    => $payment_det->delete_head_flag,  
                        'head_comments'  => $payment_det->comment, 
                     );
                 
                endforeach;
                 
                
            
             $array[]  = array(
                        'challan_id'       => $challan_info->fc_challan_id,
                        'section_id'       => $challan_info->section_id_paid,
                        'credit_amount'    => $challan_info->fc_challan_credit_amount,
                        'fine_title'       => $challan_info->fine_title,
                        'fine_id'           => $challan_info->fine_id,
                        'installment_no'   => $challan_info->payment_number,
                        'challan_type'     => $challan_info->challan_type,
                         'fc_ch_status_id' => $challan_info->fc_ch_status_id,
                        'fc_paid_form'     => $challan_info->fc_paid_form,
                        'fc_paid_upto'     => $challan_info->fc_paid_upto,
                        'fc_dueDate'       => $challan_info->fc_dueDate,
                        'fc_issue_date'    => $challan_info->fc_issue_date,
                        'fc_comments'      => $challan_info->fc_comments,
                        'fc_paiddate'      => $challan_info->fc_paiddate,
                        'challan_status'   => $challan_info->challan_status,
                        'payment_details'  => $py_details_array,
                        
                 );
           
  
       endforeach;
    
    return   json_decode(json_encode($array), FALSE);
     }
        public function student_fee_details_before_transfer_updat_20_03_2019($student_id){
                   
                            $this->db->select(
                                    '
                                     
                                     fee_challan.fc_challan_id,   
                                     fee_challan.section_id_paid,   
                                     fee_challan.fc_paid_form,   
                                     fee_challan.fc_paid_upto,   
                                     fee_challan.fc_paid_upto,   
                                     fee_challan.fc_dueDate,   
                                     fee_challan.fc_issue_date,   
                                     fee_challan.fc_paiddate,   
                                     fee_challan.fc_comments,   
                                     fee_challan.fc_ch_status_id,   
                                     fee_challan.fc_challan_credit_amount,   
                                     fee_challan_status.fcs_title as challan_status,   
                                     fee_category_titles.title as payment_number,   
                                     fee_installment_type.installment_title as challan_type,   
                                     fee_extra_heads_status.fine_title,
                                     fee_extra_heads_status.id as fine_id,
                                      
                                      
                                       
                                    ');
                            $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id','left');  
                            $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left');  
                            $this->db->join('fee_extra_heads_status','fee_extra_heads_status.id=fee_challan.credit_flag');  
                            $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left');  
                            $this->db->join('fee_installment_type','fee_installment_type.id=fee_challan.fc_challan_type');  
                            $this->db->order_by('fc_challan_id','asc');
        $challan_infos  =   $this->db->where(array('fc_student_id'=>$student_id))->get('fee_challan')->result();
        
        
        $array  = '';
         foreach ($challan_infos as $challan_info):
                                    $this->db->order_by('old_balance_pc_id','asc');
                                    $this->db->order_by('fee_id','asc');
                                    $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');  
                                    $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  
                $payment_detail =   $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$challan_info->fc_challan_id))->result();
                
                $py_details_array = '';
                $arrears = '';
                $current = '';
                
                //For total 
                $tActual        = '';
                $tCredit        = '';
                $tArrears       = '';
                $tCurrent       = '';
                $tConcession    = '';
                $tPaid          = '';
                $tBalance       = '';
                foreach($payment_detail as $payment_det):
                    ///Current Amount Or Arrears
                    if($payment_det->old_balance_pc_id == 0):
                            $arrears = '';
                            $current = $payment_det->actual_amount;
                        else:
                            $arrears = $payment_det->actual_amount;
                            $current = '';
                    endif;
                     //Show Concession Amount
                     
                        $chall_con_where  = array(
                                  'fee_concession_challan.challan_id'  => $challan_info->fc_challan_id,    
                                   'fee_concession_detail.fh_id'       => $payment_det->fee_id,    
                              );

                                  $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id');
            $ch_consn =   $this->db->where($chall_con_where)->get('fee_concession_challan')->row();
//              
                     
                $con_amount = '';
                if($ch_consn == ''):
                   $con_amount = '';
               else:
                 $con_amount =   $ch_consn->concession_amount;
               endif;    
            
            //Challan Balance
               $paidAmount = '';
              
              if($challan_info->fc_ch_status_id == 2):
                  $paidAmount = $payment_det->paid_amount;
                
              elseif($challan_info->fc_ch_status_id == 3):
                  $paidAmount = $payment_det->paid_amount;
                else:
                 $paidAmount = 0;   
              endif; 
              
               $balance = $payment_det->actual_amount-$paidAmount - $con_amount;
               
               if($current > 0):
                  $balance = $balance - $payment_det->old_credit_amount;
                endif;
               
                $py_details_array[] = array(
                        'Fee_heads'      => $payment_det->fh_head, 
                        'Actual_Amount'  => $payment_det->actual_amount, 
                        'Credit_Amount'  => $payment_det->old_credit_amount,
                        'credit_adjust_flag'=> $payment_det->credit_adjust_flag,
                        'Current_Amount' => $current, 
                        'Arrears_Amount' => $arrears, 
                        'Concession'     => $con_amount, 
                        'Paid_Amount'    => $paidAmount, 
                        'Balance'        => $balance, 
                        'delete_head'    => $payment_det->delete_head_flag,  
                        'head_comments'  => $payment_det->comment, 
                     );
                 
                endforeach;
                 
                
            
             $array[]  = array(
                        'challan_id'       => $challan_info->fc_challan_id,
                        'section_id'       => $challan_info->section_id_paid,
                        'credit_amount'    => $challan_info->fc_challan_credit_amount,
                        'fine_title'       => $challan_info->fine_title,
                        'fine_id'           => $challan_info->fine_id,
                        'installment_no'   => $challan_info->payment_number,
                        'challan_type'     => $challan_info->challan_type,
                         'fc_ch_status_id' => $challan_info->fc_ch_status_id,
                        'fc_paid_form'     => $challan_info->fc_paid_form,
                        'fc_paid_upto'     => $challan_info->fc_paid_upto,
                        'fc_dueDate'       => $challan_info->fc_dueDate,
                        'fc_issue_date'    => $challan_info->fc_issue_date,
                        'fc_comments'      => $challan_info->fc_comments,
                        'fc_paiddate'      => $challan_info->fc_paiddate,
                        'challan_status'   => $challan_info->challan_status,
                        'payment_details'  => $py_details_array,
                        
                 );
           
  
       endforeach;
    
    return   json_decode(json_encode($array), FALSE);
     }
    
    
    public function student_hostel_details($where){
        
       
                     $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
//                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.id=hostel_student_record.hostel_id');
        $std_info = $this->db->where('hostel_student_record.student_id',$where)->get('hostel_student_record')->row();
           
        if($std_info):
                    $this->db->select('
                            hostel_student_bill.date_from,
                            hostel_student_bill.challan_status,
                            hostel_student_bill.date_to,
                            hostel_student_bill.issue_date,
                            hostel_student_bill.payment_date,
                            hostel_student_bill.comments,
                            hostel_student_bill.id,
                            fee_challan_status.fcs_title,
                            hostel_status.status_name,
                        ');
                        $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=hostel_student_bill.challan_status'); 
                        $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_bill.hostel_status_id'); 
                        $this->db->order_by('id','asc');
            $hostel_bill = $this->db->where(array('head_type'=>1,'hostel_student_bill.hostel_std_id'=>$std_info->hostel_id))->get('hostel_student_bill')->result();
     
         
         $return_array = '';
         
        foreach($hostel_bill as $bill_info):
                    
                             $this->db->select(
                                    '
                                    hostel_heads.title,
                                    hostel_student_bill_info.amount,
                                    hostel_student_bill_info.per_day,
                                    hostel_student_bill_info.comments,
                                    hostel_student_bill_info.total_days,
                                    hostel_student_bill_info.paid_amount,
                                    hostel_student_bill_info.balance,
                                    hostel_student_bill_info.adjust_flag,
                                    hostel_student_bill_info.old_challan_id,
                                    ');
                                    $this->db->order_by('old_challan_id','asc');
                            $this->db->join("hostel_heads",'hostel_heads.id=hostel_student_bill_info.hostel_head_id');
            $bill_detatils_ar =$this->db->where('hostel_bill_id',$bill_info->id)->get('hostel_student_bill_info')->result();
       
            $bill_detatils = '';
            foreach($bill_detatils_ar as $row):
                
                $current_amount = '';
                $arrears_amount = '';
                
                if($row->old_challan_id == 0):
                    $current_amount = $row->amount;
                    else:
                    $arrears_amount = $row->amount;
                endif;
                
                $bill_detatils[] = array(
                 'amount'       => $row->amount,   
                 'current_amt'  => $current_amount,   
                 'arrears_amt'  => $arrears_amount,   
                 'paid_amount'  => $row->paid_amount,   
                 'balance'      => $row->balance,
                 'adjust_flag'  => $row->adjust_flag,   
                 'title'        => $row->title,   
                 'head_comments'=> $row->comments,   
                );
                
            endforeach;
            
            
            
            $return_array[] = array(
              'hostel_bill_id'      =>$bill_info->id, 
              'challan_status'      =>$bill_info->fcs_title, 
              'challan_status_id'   =>$bill_info->challan_status, 
              'date_from'           =>$bill_info->date_from, 
              'date_to'             =>$bill_info->date_to, 
              'issue_date'          =>$bill_info->issue_date, 
              'payment_date'        =>$bill_info->payment_date,
              'hostel_status'       =>$bill_info->status_name,
              'hostel_comments'     =>$bill_info->comments,
              'bill_details'        =>$bill_detatils,
                
                
            );
              
        endforeach;
        
       return   json_decode(json_encode($return_array), FALSE);
       endif;
       
    }
     public function student_mess_details($where){
                        
        
                    
                     $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
//                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.id=hostel_student_record.hostel_id');
        $std_info = $this->db->where('hostel_student_record.student_id',$where)->get('hostel_student_record')->row();
           
        if($std_info):
                        $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=hostel_student_bill.challan_status'); 
                        $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_bill.hostel_status_id'); 
                        $this->db->order_by('id','asc');
            $hostel_bill = $this->db->where(array('head_type'=>2,'hostel_student_bill.hostel_std_id'=>$std_info->hostel_id))->get('hostel_student_bill')->result();
     
          
         $return_array = '';
         
        foreach($hostel_bill as $bill_info):
                            $this->db->select(
                                    '
                                    hostel_heads.title,
                                    hostel_student_bill_info.amount,
                                    hostel_student_bill_info.balance,
                                    hostel_student_bill_info.per_day,
                                    hostel_student_bill_info.total_days,
                                    hostel_student_bill_info.comments,
                                    hostel_student_bill_info.paid_amount,
                                    hostel_student_bill_info.adjust_flag,
                                    hostel_student_bill_info.old_challan_id,
                                    hostel_student_bill_info.per_day,
                                    hostel_student_bill_info.total_days,
                                    ');
                            $this->db->order_by('old_challan_id','asc');
                            $this->db->join("hostel_heads",'hostel_heads.id=hostel_student_bill_info.hostel_head_id');
            $bill_detatils_ar =$this->db->where('hostel_bill_id',$bill_info->id)->get('hostel_student_bill_info')->result();
       
            
            $bill_detatils = '';
            foreach($bill_detatils_ar as $row):
                
                $current_amount = '';
                $arrears_amount = '';
                
                if($row->old_challan_id == 0):
                    $current_amount = $row->amount;
                    else:
                    $arrears_amount = $row->amount;
                endif;
                
                $bill_detatils[] = array(
                 'amount'           => $row->amount,   
                 'balance'          => $row->balance,   
                 'current_amt'      => $current_amount,
                     'adjust_flag'      => $row->adjust_flag,
                 'arrears_amt'      => $arrears_amount,
                'challan_status_id' =>$bill_info->challan_status, 
                'date_from'         =>$bill_info->date_from, 
                'date_to'           =>$bill_info->date_to, 
                 'paid_amount'      => $row->paid_amount,   
                 'per_day'          => $row->per_day,   
                 'total_days'       => $row->total_days,   
                 'title'            => $row->title,   
                 'head_comments'    => $row->comments,   
                );
                
            endforeach;
            
            
            
            $return_array[] = array(
              'hostel_bill_id'  =>$bill_info->id, 
              'challan_status'  =>$bill_info->fcs_title, 
              'date_from'       =>$bill_info->date_from, 
              'date_to'         =>$bill_info->date_to, 
              'issue_date'      =>$bill_info->issue_date, 
              'payment_date'    =>$bill_info->payment_date,
              'mess_status'     =>$bill_info->status_name,
              'mess_comments'   =>$bill_info->comments,
              'bill_details'    =>$bill_detatils,
                
                
            );
              
        endforeach;
        
       return   json_decode(json_encode($return_array), FALSE);
       endif;
       
    }
 public function fee_redger_report($where=Null,$like=NULL,$date=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.student_name,
                        student_record.father_name,
                        sections.name as sessionName, 
                        sections.sec_id as sessionId, 
                        student_status.name as student_status,
                        fee_challan.fc_ch_status_id,
                        fee_challan.section_id_paid,
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
                
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where('student_record.s_status_id !=','1');
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->order_by('student_record.college_no','asc');
                $this->db->group_by('student_record.student_id');
                
               
       $student_record =   $this->db->get('student_record')->result();
        
       $return_array = '';
       
        foreach($student_record as $row):

                            $this->db->order_by('fee_challan.fc_challan_id','asc');
            $fee_challans = $this->db->get_where('fee_challan',array('fc_student_id'=>$row->student_id))->result();
           
//            echo '<pre>';print_r($fee_challans);die;
            
            $fee_challans_info  = '';
            foreach($fee_challans as $challRow):
                 
            //Fee Details 
            $where = array(
              'challan_id'   => $challRow->fc_challan_id,
              'delete_head_flag'=>1,  
            );
            
                            $this->db->select('sum(actual_amount)as actualAmount,sum(paid_amount) as paidAmount,sum(balance) as balance,sum(old_credit_amount) as credit_amount');
            $payments = $this->db->get_where('fee_actual_challan_detail',$where)->row();
           
            
            //current Details  
               $where_curr = array(
                  'challan_id'=>$challRow->fc_challan_id,  
                  'old_balance_pc_id '=>0,
                   'delete_head_flag'=>1,
                );
                        $this->db->select('sum(actual_amount)as current_amount');
            $payments_crrent = $this->db->get_where('fee_actual_challan_detail',$where_curr)->row();
            
           //arrears Details
            $where_arre = array(
                  'challan_id'=>$challRow->fc_challan_id,  
                  'old_balance_pc_id !='=>0,
                'delete_head_flag'=>1,
                );
                        $this->db->select('sum(actual_amount)as arrears_amount');
            $payments_arrears = $this->db->get_where('fee_actual_challan_detail',$where_arre)->row();
            
             //Concession Details 
            
            $where_con = array(
              'fee_concession_challan.challan_id'=>$challRow->fc_challan_id  
            );
                        $this->db->select('
                                sum(concession_amount)as concession_amount,
                                ');
                              $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id');  
            $concession = $this->db->get_where('fee_concession_challan',$where_con)->row();
           
            
            
             $section_id = $this->db->get_where('sections',array('sec_id'=>$challRow->section_id_paid))->row();
            $section_fee_gen = '';
            
            if(empty($section_id)):
                $section_fee_gen = '';
                else:
                $section_fee_gen = $section_id->name;
            endif;
            
            
            
            
            $fee_challans_info[] = array(
                'challan_id_lock'    => $challRow->challan_id_lock,
                'fc_challan_id'      => $challRow->fc_challan_id,
                'ch_status_id'      => $challRow->fc_ch_status_id,
                'fc_pay_cat_id'      => $challRow->fc_pay_cat_id,
                'fc_issue_date'      => $challRow->fc_issue_date,
                'fc_paiddate'        => $challRow->fc_paiddate,
                'fc_paid_form'       => $challRow->fc_paid_form,
                'fc_paid_upto'       => $challRow->fc_paid_upto,
                'fc_comments'        => $challRow->fc_comments,
                'fee_generate_sec'   => $section_fee_gen,
                'credit_amount'      => $payments->credit_amount,
                'current'            => $payments_crrent->current_amount,
                'arrears'            => $payments_arrears->arrears_amount,
                'total_upPaid'       => $payments->actualAmount,
                'total_Paid'         => $payments->paidAmount,
                'total_balance'      => $payments->balance,
                'concession'         => $concession->concession_amount,
 
                      
           );
            
            
            endforeach;
            
           
           if($fee_challans_info):
               
               $nullSection = $this->input->post('nullSection');
              
           if($nullSection ==1):
               
                $return_array[] = array(
                'college_no'         => $row->college_no,
                'student_id'         => $row->student_id,
                'student_status'     => $row->student_status,
                'sessionName'        => $row->sessionName,
                'student_name'       => $row->student_name,
                'father_name'        => $row->father_name,
                'fee_details'        => $fee_challans_info,
            );
               
           endif; 
           if($nullSection ==2):
               
               if(empty($row->sessionName)):
                   $return_array[] = array(
                'college_no'         => $row->college_no,
                'student_id'         => $row->student_id,
                'student_status'     => $row->student_status,
                'sessionName'        => $row->sessionName,
                'student_name'       => $row->student_name,
                'father_name'        => $row->father_name,
                'fee_details'        => $fee_challans_info,
            );
               endif;
                
               
           endif; 
           
           endif; 
            
             
             
        endforeach;
          
        return   json_decode(json_encode($return_array), FALSE);
    }
 public function fee_redger_report_excel($where=Null,$like=NULL,$date=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.student_name,
                        student_record.father_name,
                        sections.name as sessionName, 
                        sections.sec_id as sessionId, 
                        student_status.name as student_status,
                        fee_challan.fc_ch_status_id,
                        fee_challan.section_id_paid,
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
                
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where('student_record.s_status_id !=','1');
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->order_by('student_record.college_no','asc');
                $this->db->group_by('student_record.student_id');
                
               
       $student_record =   $this->db->get('student_record')->result();
        
       $return_array = '';
       
        foreach($student_record as $row):

                            $this->db->order_by('fee_challan.fc_challan_id','asc');
            $fee_challans = $this->db->get_where('fee_challan',array('fc_student_id'=>$row->student_id))->result();
           
            
              
               $nullSection = $this->input->post('nullSection');
              
           if($nullSection ==1):
               
                $return_array[] = array(
                        'Student_Details'   => $row->college_no.'-'.$row->student_name, 
                        'Ch_From'           => '', 
                        'Ch_To'             => '', 
                        'Ch_No'             => '', 
                        'Payable'           => '', 
                        'Credit'            => '', 
                        'Arrears'           => '', 
                        'Net_Payable'       => '', 
                        'Consession'        => '', 
                        'Total Dues'        => '', 
                        'Paid'              => '', 
                        'Balance'           => '', 
                        'Pay_Date'          => '', 
                        'Comments'          => '', 
                );
               
           endif; 
           if($nullSection ==2):
            if(empty($row->sessionName)):
                $return_array[] = array(
                        'Student_Details'   => $row->college_no.'-'.$row->student_name, 
                        'Ch_From'           => '', 
                        'Ch_To'             => '', 
                        'Ch_No'             => '', 
                        'Payable'           => '', 
                        'Credit'            => '', 
                        'Arrears'           => '', 
                        'Net_Payable'       => '', 
                        'Consession'        => '', 
                        'Total Dues'        => '', 
                        'Paid'              => '', 
                        'Balance'           => '', 
                        'Pay_Date'          => '', 
                        'Comments'          => '', 
                );
               endif;
                
               
           endif;
        
            
            $fee_challans_info  = '';
            
             $paymentTotal          = '';
             $credit_amount         = '';
             $concessionAmount      = '';
             $totalDues             = '';
             $totalAmount           = '';
             $totalBalance          = '';
            
            foreach($fee_challans as $challRow):
                 
            //Fee Details 
            $where = array(
              'challan_id'   => $challRow->fc_challan_id,
              'delete_head_flag'=>1,  
            );
            
                            $this->db->select('sum(actual_amount)as actualAmount,sum(paid_amount) as paidAmount,sum(balance) as balance,sum(old_credit_amount) as credit_amount');
            $payments = $this->db->get_where('fee_actual_challan_detail',$where)->row();
           
            
            //current Details  
               $where_curr = array(
                  'challan_id'=>$challRow->fc_challan_id,  
                  'old_balance_pc_id '=>0,
                   'delete_head_flag'=>1,
                );
                        $this->db->select('sum(actual_amount)as current_amount');
            $payments_crrent = $this->db->get_where('fee_actual_challan_detail',$where_curr)->row();
            
           //arrears Details
            $where_arre = array(
                  'challan_id'=>$challRow->fc_challan_id,  
                  'old_balance_pc_id !='=>0,
                'delete_head_flag'=>1,
                );
                        $this->db->select('sum(actual_amount)as arrears_amount');
            $payments_arrears = $this->db->get_where('fee_actual_challan_detail',$where_arre)->row();
            
             //Concession Details 
            
            $where_con = array(
              'fee_concession_challan.challan_id'=>$challRow->fc_challan_id  
            );
                        $this->db->select('
                                sum(concession_amount)as concession_amount,
                                ');
                              $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id');  
            $concession = $this->db->get_where('fee_concession_challan',$where_con)->row();
           
            
            
             $section_id = $this->db->get_where('sections',array('sec_id'=>$challRow->section_id_paid))->row();
            $section_fee_gen = '';
            
            if(empty($section_id)):
                $section_fee_gen = '';
                else:
                $section_fee_gen = $section_id->name;
            endif;
            
            $totalpaid = '';
            
            if($challRow->fc_ch_status_id == 2 || $challRow->fc_ch_status_id == 3):
                $totalpaid = $payments->paidAmount;

                else:
                  $totalpaid = '';
            endif;
//                
            
                $gBalance               =   $payments->actualAmount-$totalpaid-$concession->concession_amount-$payments->credit_amount;
                
                $total_payable          =   $payments_crrent->current_amount+$payments_arrears->arrears_amount-$payments->credit_amount;
                $totalPaid1             =   $total_payable-$concession->concession_amount;
            
                
                $paid_date = '';
                if($challRow->fc_paiddate == '0000-00-00'):
                $paid_date = '';    
                    else:
                  $paid_date = date('d-M-y',strtotime($challRow->fc_paiddate));   
                endif;
                
                  $return_array[] = array(
                        'Student_Details'   => $section_fee_gen.'-'.$row->student_status, 
                        'Ch_From'           => date('d-M-y',  strtotime($challRow->fc_paid_form)), 
                        'Ch_To'             => date('d-M-y',  strtotime($challRow->fc_paid_upto)), 
                        'Ch_No'             => $challRow->fc_challan_id, 
                        'Payable'           => $payments_crrent->current_amount, 
                        'Credit'            => $payments->credit_amount, 
                        'Arrears'           => $payments_arrears->arrears_amount, 
                        'Net_Payable'       => $total_payable, 
                        'Consession'        => $concession->concession_amount, 
                        'Total_Dues'        => $totalPaid1, 
                        'Paid'              => $totalpaid, 
                        'Balance'           => $gBalance, 
                        'Pay_Date'          => $paid_date, 
                        'Comments'          => $challRow->fc_comments, 
                );
            
             $paymentTotal         += $payments_crrent->current_amount;
             $credit_amount        += $payments->credit_amount;
             $concessionAmount     += $concession->concession_amount;
             $totalDues            += $totalpaid;
 
            
            endforeach;
             $gBalances       = $paymentTotal -$concessionAmount -$totalDues-$credit_amount;
             
            $return_array[] = array(
                        'Total'   => '', 
                        'Ch_From'           => '', 
                        'Ch_To'             => '', 
                        'Ch_No'             => '', 
                        'Payable'           => $paymentTotal, 
                        'Credit'            => $credit_amount, 
                        'Arrears'           => '', 
                        'Net_Payable'       => '', 
                        'Consession'        => $concessionAmount, 
                        'Total_Dues'        => '', 
                        'Paid'              => $totalDues, 
                        'Balance'           => $gBalances, 
                        'Pay_Date'          => '', 
                        'Comments'          => '', 
                );
           endforeach;
          
        return   $return_array;
    }
    public function fee_student_transfar($where=Null){
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                              student_record.admission_comment,
                             student_record.student_id,
                             student_record.student_name,
                             student_record.sub_pro_id,
                             student_record.programe_id,
                             student_record.father_name,
                             sections.name as sectionsName,
                             sections.sec_id as section_id,
                             sub_programes.name as sub_proram,
                             programes_info.programe_name as programe_name,
                             prospectus_batch.batch_name,
                             prospectus_batch.batch_id,
                             student_status.name as studentStatus,
                             student_record.migration_status,
                             sub_programes.name as sub_program,
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
       
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->row();
    }
    public function get_lock_dates($from,$to){
        
            $this->db->where('lock_date BETWEEN "'.date('Y-m-d', strtotime($from)).'" AND "'.date('Y-m-d', strtotime($to)).'"');   
         return $this->db->get('fee_brr_lock')->result();
    }
    public function get_prospectus_lock_dates($from,$to){
        
            $this->db->where('lock_date BETWEEN "'.date('Y-m-d', strtotime($from)).'" AND "'.date('Y-m-d', strtotime($to)).'"');   
         return $this->db->get('fee_prospectus_lock')->result();
    }
   public  function dropDown_fee_head_paid($table, $option=NULL,$value,$show,$where=NULL){
		$this->db->select('
                    fee_heads.fh_head,
                    fee_heads.fh_Id,
                        ');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
                     $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');

                   $this->db->order_by($value,'asc');
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
                        
                        $hostel = $this->db->get_where('hostel_head_title',array('status'=>1))->result();
                  
                        $data[] = '------Hoste && Mess Heads-----';
                         
                        foreach($hostel as $row2) 
			{
				$data[$row2->id] = $row2->title;
			}
                        
			return $data;
		}
                
                
	} 
        
public function fee_paid_amount_report_Programwise($where=Null,$date){
 
          $program = $this->input->post('programe_id');
          if(!empty($program)):
               $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
            else:
               
                  $programe_result = $this->db->get('programes_info')->result();
          endif;
         $array = '';  
      foreach($programe_result as $pro_row):
          
 
          
          $this->db->select(
                    '   student_record.form_no,
                        student_record.college_no,
                        student_record.student_name,
                        student_record.batch_id,
                        prospectus_batch.batch_name,
                        sections.name as sessionName,
                        student_status.name as student_status,
                        fee_category_titles.title as payment_title,
                        fee_challan.fc_challan_id,
                        fee_concession_detail.concession_amount as Concession_amount,
                        fee_challan.fc_challan_credit_amount,
                        fee_challan.fc_paiddate as challan_paid_date,
                        student_record.student_id,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        sub_programes.sub_pro_id,
                        fee_challan.fc_challan_credit_amount,
                        fee_challan.fc_pay_cat_id as fc_pay_cat_id,
                       ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_concession_challan','fee_concession_challan.challan_id=fee_challan.fc_challan_id','left outer');
                //Concession Amount
                $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                // Payment Category 
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left outer');
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));//1= not paid,4 = cancel
 
                if($date['from'] == ''):
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                 
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fc_challan_id','asc');
                $this->db->order_by('fee_challan.fc_paiddate','asc');
                $this->db->order_by('fee_challan.fc_challan_id','asc');
                $this->db->order_by('student_record.form_no','asc');
           
         $result =  $this->db->get('student_record')->result();
         
         $paid_total_sum = '';
         foreach($result as $row):
             $this->db->select(
                     '
                        sum(fee_actual_challan_detail.paid_amount)      as paid_total_sum,
                        sum(fee_actual_challan_detail.actual_amount)    as actual_total_sum,
                        
                     ');
                        $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id'); 
                        $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id'); 
                        $this->db->where('delete_head_flag',1);
                       
            $amount =   $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$row->fc_challan_id))->row();
            if(!empty($amount)):
                $paid_total_sum  += $amount->paid_total_sum + $row->fc_challan_credit_amount;
            endif;
            
            
        endforeach;
        
        if(!empty($paid_total_sum)):
            $array['college_fee'][] = array(
             'paid_amount'          =>$paid_total_sum,
             'program_name'         =>$pro_row->programe_name,
             
         );
        endif;
         
        
        $this->db->select(
                    '  
                        student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sections.name as sessionName, 
                        hostel_student_bill.id as challan_id,
                        hostel_head_type.title as hotel_type,
                        hostel_student_bill.payment_date,
                        hostel_status.status_name,
                        sum(hostel_student_bill_info.paid_amount) as paid_amount,
                        hostel_student_bill.head_type
                        
                         
                      ');

                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
                $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
//                
                
                if(empty($date['from'])):
                     $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
                else:
                      $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                endif;
                
              
                if($where):
                    $this->db->where($where);
                endif;
                 
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                 $this->db->group_by('hostel_student_bill.id','asc');
                 $this->db->order_by('hostel_student_bill.payment_date','desc');
                 $this->db->order_by('hostel_student_bill.id','asc');
        $result_hostel =   $this->db->get('student_record')->result();
        
        $hostel_amount  = '';
        $mess_amount    = '';
        foreach($result_hostel as $hoste_row):
            
            
            if($hoste_row->head_type == 1):
                $hostel_amount += $hoste_row->paid_amount;
                    else:
                $mess_amount   += $hoste_row->paid_amount;
            endif;
            
          
            
            
        endforeach;
        
        if(!empty($hostel_amount)):
          $array['hostel_fee'][] = array(
                    'hostel_amount' =>$hostel_amount
                    );  
        endif;
        
        if(!empty($hostel_amount)):
           $array['mess_fee'][] = array(
                    'mess_amount' =>$mess_amount
                    );
        endif;
        
      
        
    endforeach;
    if(!empty($array)):
         return   json_decode(json_encode(array_filter($array)), FALSE);
        else:
         return   false;
    endif;
 
       
    }
public function fee_paid_amount_report_programwise_split($where=Null,$date){
 
           $program = $this->input->post('programe_id');
           
          if(!empty($program)):
               
                $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
              else:
               
                  $programe_result = $this->db->get('programes_info')->result();
          endif;
        $array = '';  
      foreach($programe_result as $pro_row):
          
 
          
          $this->db->select(
                    '   student_record.form_no,
                        student_record.college_no,
                        student_record.student_name,
                        student_record.batch_id,
                        prospectus_batch.batch_name,
                        sections.name as sessionName,
                        student_status.name as student_status,
                        fee_category_titles.title as payment_title,
                        fee_challan.fc_challan_id,
                        fee_concession_detail.concession_amount as Concession_amount,
                        fee_challan.fc_challan_credit_amount,
                        fee_challan.fc_paiddate as challan_paid_date,
                        student_record.student_id,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        sub_programes.sub_pro_id,
                        fee_challan.fc_challan_credit_amount,
                        fee_challan.fc_pay_cat_id as fc_pay_cat_id,
                       ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('fee_concession_challan','fee_concession_challan.challan_id=fee_challan.fc_challan_id','left outer');
                //Concession Amount
                $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                // Payment Category 
                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left outer');
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));//1= not paid,4 = cancel
 
                if($date['from'] == ''):
                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fc_challan_id','asc');
                $this->db->order_by('fee_challan.fc_paiddate','asc');
                $this->db->order_by('fee_challan.fc_challan_id','asc');
                $this->db->order_by('student_record.form_no','asc');
           
         $result =  $this->db->get('student_record')->result();
         
         $paid_total_sum = '';
         foreach($result as $row):
             $this->db->select(
                     '
                        sum(fee_actual_challan_detail.paid_amount)      as paid_total_sum,
                        sum(fee_actual_challan_detail.actual_amount)    as actual_total_sum,
                        
                     ');
                        $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id'); 
                        $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id'); 
                        $this->db->where('delete_head_flag',1);
                       
            $amount =   $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$row->fc_challan_id))->row();
            if(!empty($amount)):
                $paid_total_sum  += $amount->paid_total_sum + $row->fc_challan_credit_amount;
            endif;
            
            
        endforeach;
         
        $this->db->select(
                    '  
                        student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sections.name as sessionName, 
                        hostel_student_bill.id as challan_id,
                        hostel_head_type.title as hotel_type,
                        hostel_student_bill.payment_date,
                        hostel_status.status_name,
                        sum(hostel_student_bill_info.paid_amount) as paid_amount,
                        hostel_student_bill.head_type
                        
                         
                      ');

                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
                $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
//                
                
                if(empty($date['from'])):
                    $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
                else:
                    $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                endif;
                
              
                if($where):
                    $this->db->where($where);
                endif;
                    
                    $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                    $this->db->group_by('hostel_student_bill.id','asc');
                    $this->db->order_by('hostel_student_bill.payment_date','desc');
                    $this->db->order_by('hostel_student_bill.id','asc');
        $result_hostel =   $this->db->get('student_record')->result();
        
        $hostel_amount  = '';
        $mess_amount    = '';
       foreach($result_hostel as $hoste_row):
            
           
            if($hoste_row->head_type == 1):
                $hostel_amount += $hoste_row->paid_amount;
                    else:
                $mess_amount   += $hoste_row->paid_amount;
            endif;
            
          
            
            
        endforeach;
        
        $total_amount = $mess_amount+$mess_amount+$paid_total_sum;
          if($total_amount>0):
              
            $array[] = array(
             
             'program_name' => $pro_row->programe_name,
             'college_fee'  => $paid_total_sum,   
             'hostel_fee'   => $hostel_amount,   
             'mess_fee'     => $mess_amount,   
                 
             
         );  
              
          endif;
        
 
        
    endforeach;
     if(!empty($array)):
         return   json_decode(json_encode(array_filter($array)), FALSE);
        else:
         return   false;
    endif; 
    }  
public function fee_paid_amount_report_head_wise($where=NULL,$where_head=NULL,$date=NULL){
          
                $program = $this->input->post('programe_id');
            if(!empty($program)):
                $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
                      else:
                $programe_result = $this->db->get('programes_info')->result();
            endif;
                $array= '';
          foreach($programe_result as $pro_row):
               
                $this->db->select('fee_heads.fh_head,sum(fee_actual_challan_detail.paid_amount) as paid_amount');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where('delete_head_flag',1);
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
                
            if(empty($date['from'])):
                    $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
            endif;
            if($where):
                    $this->db->where($where);
            endif;
                
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
$result_details=$this->db->get('fee_challan')->result();
           
//Fee Details Head wise Credit
                $this->db->select('fc_challan_id,sum(fc_challan_credit_amount) as credit_amount');
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
            if(empty($date['from'])):
                $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                 $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
            endif;
            if($where):
                $this->db->where($where);
            endif;
                $this->db->group_by('fc_challan_credit_amount');
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
    $result_credit =   $this->db->get('fee_challan')->result();
         
    //Fee Details Head wise Hostel Mess
         
         $this->db->select('
                hostel_heads.id as head_id,
                hostel_head_title.title as fh_head,
                hostel_head_title.id,
                student_record.student_id,
                hostel_student_bill.head_type,
                sum(hostel_student_bill_info.paid_amount) as paid_amount
                 ');
        
                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer'); 
                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                    $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
                    if(empty($date['from'])):
                            $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
                        else:
                             $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                    endif;
                    if($where):
                            $this->db->where($where);
                    endif;
       
                    $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                    $this->db->order_by('hostel_head_title.title','asc');
                    $this->db->group_by('hostel_head_title.id');
 
                    
    $hostel=   $this->db->get('student_record')->result();
   
   
     
         if(!empty($result_details)):
            $array[] = array(
             'program_name' => $pro_row->programe_name,
             'head_details' => $result_details ,
             'credit'       => $result_credit,
             'hostel'       => $hostel,
              
         );
         endif;
         
          endforeach;
      
         return   json_decode(json_encode($array), FALSE);

    }
public function fee_paid_amount_report_head_wise_college($where=NULL,$where_head=NULL,$date=NULL){
          
                $program = $this->input->post('programe_id');
            if(!empty($program)):
                $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
                      else:
                $programe_result = $this->db->get('programes_info')->result();
            endif;
                $array= '';
          foreach($programe_result as $pro_row):
               
                $this->db->select('fee_heads.fh_head,sum(fee_actual_challan_detail.paid_amount) as paid_amount');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
            if(empty($date['from'])):
                    $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
            endif;
            if($where):
                    $this->db->where($where);
            endif;
            $this->db->where('delete_head_flag',1);
            if(!empty($where_head)):
//                $this->db->where('fee_heads.fh_Id <=',$where_head['head_to']);
//              else:
                $this->db->where('fee_heads.fh_Id BETWEEN "'.$where_head['head_from'].'" AND "'.$where_head['head_to'].'"');   
            endif;
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
$result_details=$this->db->get('fee_challan')->result();
           
//Fee Details Head wise Credit
                $this->db->select('fc_challan_id,sum(fc_challan_credit_amount) as credit_amount');
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
            if(empty($date['from'])):
                $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                 $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
            endif;
            if($where):
                $this->db->where($where);
            endif;
                $this->db->group_by('fc_challan_credit_amount');
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
    $result_credit =   $this->db->get('fee_challan')->result();
         
    
     
         if(!empty($result_details)):
            $array[] = array(
             'program_name' => $pro_row->programe_name,
             'head_details' => $result_details ,
             'credit'       => $result_credit,
             'hostel'       => '',
              
         );
         endif;
         
          endforeach;
      
         return   json_decode(json_encode($array), FALSE);

    }
public function fee_paid_amount_report_head_wise_hostel($where=NULL,$where_head=NULL,$date=NULL){
          
             
                $program = $this->input->post('programe_id');
            if(!empty($program)):
                $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
                      else:
                $programe_result = $this->db->get('programes_info')->result();
            endif;
                $array= '';
          foreach($programe_result as $pro_row):
               
                $this->db->select('fee_heads.fh_head,sum(fee_actual_challan_detail.paid_amount) as paid_amount');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
            if(empty($date['from'])):
                    $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
            endif;
            if($where):
                    $this->db->where($where);
            endif;
 
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
$result_details=$this->db->get('fee_challan')->result();
           
//Fee Details Head wise Credit
                $this->db->select('fc_challan_id,sum(fc_challan_credit_amount) as credit_amount');
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
            if(empty($date['from'])):
                $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
                else:
                 $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
            endif;
            if($where):
                $this->db->where($where);
            endif;
                $this->db->group_by('fc_challan_credit_amount');
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
    $result_credit =   $this->db->get('fee_challan')->result();
         
    //Fee Details Head wise Hostel Mess
         
         $this->db->select('
                hostel_heads.id as head_id,
                hostel_head_title.title as fh_head,
                hostel_head_title.id,
                student_record.student_id,
                hostel_student_bill.head_type,
                sum(hostel_student_bill_info.paid_amount) as paid_amount
                 ');
        
                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer'); 
                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                    $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
                    if(empty($date['from'])):
                            $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
                        else:
                             $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                    endif;
                    if($where):
                            $this->db->where($where);
                    endif;
       
                    $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                    $this->db->order_by('hostel_head_title.title','asc');
                    $this->db->group_by('hostel_head_title.id');
 
                    
    $hostel=   $this->db->get('student_record')->result();
   
   
     
         if(!empty($result_details)):
            $array[] = array(
             'program_name' => $pro_row->programe_name,
             'head_details' => $result_details ,
             'credit'       => $result_credit,
             'hostel'       => $hostel,
              
         );
         endif;
         
          endforeach;
      
         return   json_decode(json_encode($array), FALSE);

    }
    public function fee_challan_filters_programWise($where=Null){
            $this->db->select(
                        '
                        student_record.college_no,
                        student_record.form_no,
                        student_record.student_id,
                        student_record.student_name,
                        student_record.father_name,
                        fee_challan.fc_challan_id,
                        fee_challan.fc_paid_form,
                        fee_challan.fc_paid_upto,
                        fee_challan.fc_issue_date,
                        fee_challan.fc_dueDate,
                        fee_challan.fc_comments,
                        fee_challan.fc_pay_cat_id,
                        fee_challan.fc_challan_rq,
                        fc_challan_type,
                        sections.name as sectionName,
                        sub_programes.name as subProName,
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                        prospectus_batch.batch_name,
                        bank.name as BankName,
                        bank.account_no as Bank_account_no,
                    ');
            
                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('bank','bank.bank_id=fee_challan.fc_bank_id');
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                  $this->db->where_in('student_record.s_status_id',array('5','12'));
                if($where):
                    $this->db->where($where);
                endif;
              
                $this->db->order_by('student_record.college_no');
                return  $this->db->get('student_record')->result();
    }
  public function net_receivable($where=Null,$amount=NULL,$like=NULL){
     
     $this->db->select(
                        '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                    '
                    );
            
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
            
            if($where):
                    $this->db->where($where);
            endif;
                if($like):
                    $this->db->like($like);
                endif; 
            $result =  $this->db->get('student_record')->result();
           
            $return_array = '';
            foreach($result as $students):
                
                //**************************************
                //Fee Balance 
                //**************************************

                                $this->db->select('fc_challan_id as head_id,sum(balance) as balance,fh_head as Head_title');    
                                $this->db->order_by('fc_challan_id','asc');
                                $this->db->group_by('fee_heads.fh_Id');
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'fee_actual_challan_detail.delete_head_flag'=>1))->result();
              $Head_details = '';
               $balance_array = '';
              foreach($challan_info as $row):
                if($row->balance >0 ):
                  $Head_details[] = array(
                     
                      'balance'     => $row->balance,
                      'Head_title'  => $row->Head_title,
                );    
                $balance_array +=$row->balance;
                endif;
              endforeach;
                
                //**************************************
                //Hostel & Mess Balance 
                //**************************************

                                    $this->db->select('
                                            hostel_head_title.title as Head_title,
                                            sum(balance) as balance,
                                            ');
                                    $this->db->order_by('hostel_student_bill_info.id','asc');
                                    $this->db->group_by('hostel_head_title.id');
                                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                     
                $hostel_record =   $this->db->get_where('hostel_student_record',array('student_id'=>$students->student_id))->result();
                foreach($hostel_record as $row):
                if($row->balance >0 ):
                  $Head_details[] = array(
                      'balance'     => $row->balance,
                      'Head_title'  => $row->Head_title,
                );   
                 $balance_array +=$row->balance;
                endif;
              endforeach;
 
                if($balance_array > 0):
                    $return_array[] = array(
                   'college_no'     => $students->college_no,
                   'student_id'     => $students->student_id,
                   'form_no'        => $students->form_no,
                   'sub_program'     => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'student_status' => $students->student_status,
                   'Head_details'   => json_decode(json_encode($Head_details), FALSE),
                   
                 );
                endif;
                    

                endforeach;
                 
       return   json_decode(json_encode($return_array), FALSE);
 }
    public function net_receivable_college_hostel($where=Null,$amount=NULL,$like=NULL){
     
     $this->db->select(
                        '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                    '
                    );
            
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
            
            if($where):
                    $this->db->where($where);
            endif;
                if($like):
                    $this->db->like($like);
                endif; 
            $result =  $this->db->get('student_record')->result();
           
            $return_array = '';
            foreach($result as $students):
                
                //**************************************
                //Fee Balance 
                //**************************************

                                $this->db->select('fc_challan_id as head_id,sum(balance) as balance,fh_head as Head_title');    
                                $this->db->order_by('fc_challan_id','asc');
                                $this->db->group_by('fee_heads.fh_Id');
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'fee_actual_challan_detail.delete_head_flag'=>1))->result();
              $Head_details = '';
               $balance_array = '';
              foreach($challan_info as $row):
                if($row->balance >0 ):
                  $Head_details[] = array(
                     
                      'balance'     => $row->balance,
                      'Head_title'  => $row->Head_title,
                );    
                $balance_array +=$row->balance;
                endif;
              endforeach;
                
                //**************************************
                //Hostel Balance 
                //**************************************

                                    $this->db->select('
                                            hostel_head_title.title as Head_title,
                                            sum(balance) as balance,
                                            ');
                                    $this->db->order_by('hostel_student_bill_info.id','asc');
                                    $this->db->group_by('hostel_head_title.id');
                                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                     
                 $hostel_record =   $this->db->get_where('hostel_student_record',array('student_id'=>$students->student_id,'hostel_student_bill.head_type'=>1))->result();
                foreach($hostel_record as $row):
                if($row->balance >0 ):
                  $Head_details[] = array(
                      'balance'     => $row->balance,
                      'Head_title'  => $row->Head_title,
                );   
                 $balance_array +=$row->balance;
                endif;
              endforeach;
 
                if($balance_array > 0):
                    $return_array[] = array(
                   'college_no'     => $students->college_no,
                   'student_id'     => $students->student_id,
                   'form_no'        => $students->form_no,
                   'sub_program'     => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'student_status' => $students->student_status,
                   'Head_details'   => json_decode(json_encode($Head_details), FALSE),
                   
                 );
                endif;
                    

                endforeach;
                 
       return   json_decode(json_encode($return_array), FALSE);
 
    
}
   public function net_receivable_mess($where=Null,$amount=NULL,$like=NULL){
     
     $this->db->select(
                        '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                    '
                    );
            
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
            
            if($where):
                    $this->db->where($where);
            endif;
                if($like):
                    $this->db->like($like);
                endif; 
            $result =  $this->db->get('student_record')->result();
           
            $return_array = '';
            foreach($result as $students):
                
                
                
                //**************************************
                //Mess Balance 
                //**************************************

                                    $this->db->select('
                                            hostel_head_title.title as Head_title,
                                            sum(balance) as balance,
                                            ');
                                    $this->db->order_by('hostel_student_bill_info.id','asc');
                                    $this->db->group_by('hostel_head_title.id');
                                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                     
                 $hostel_record =   $this->db->get_where('hostel_student_record',array('student_id'=>$students->student_id,'hostel_student_bill.head_type'=>2))->result();
//                 echo '<pre>';print_r($hostel_record);die;
               $balance_array = '';
               $Head_details = '';
                 foreach($hostel_record as $row):
                if($row->balance >0 ):
                  $Head_details[] = array(
                      'balance'     => $row->balance,
                      'Head_title'  => $row->Head_title,
                );   
                 $balance_array +=$row->balance;
                endif;
              endforeach;
 
                if($balance_array > 0):
                    $return_array[] = array(
                   'college_no'     => $students->college_no,
                   'student_id'     => $students->student_id,
                   'form_no'        => $students->form_no,
                   'sub_program'     => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'student_status' => $students->student_status,
                   'Head_details'   => json_decode(json_encode($Head_details), FALSE),
                   
                 );
                endif;
                    

                endforeach;
                 
       return   json_decode(json_encode($return_array), FALSE);
 }
     public function net_receivable_program_wise($where,$like){
     
     
            $program = $this->input->post('programe_id');
            if(!empty($program)):
                $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
                      else:
                $programe_result = $this->db->get('programes_info')->result();
            endif;
                $array= '';
          foreach($programe_result as $pro_row):
               
                $this->db->select('fee_heads.fh_head,sum(fee_actual_challan_detail.balance) as balance');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
//           
            if($where):
                    $this->db->where($where);
            endif;
            if($like):
                $this->db->like($like);
            endif;
 
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
            
            $result_details=$this->db->get('fee_challan')->result();
                    $return_array = '';
                    $total_balance = '';
                     foreach($result_details as $row):
                         if($row->balance > 0):
                            $return_array[] = array(
                              'Fee_head'    => $row->fh_head,  
                              'balance'     => $row->balance,  
                            ); 
                         endif;
                         $total_balance+=$row->balance;
                     endforeach; 


         $this->db->select('
                hostel_heads.id as head_id,
                hostel_head_title.title as fh_head,
                hostel_head_title.id,
                student_record.student_id,
                hostel_student_bill.head_type,
                sum(hostel_student_bill_info.balance) as balance
                 ');
        
                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer'); 
                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
//                    $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
//                    if(empty($date['from'])):
//                            $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
//                        else:
//                             $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
//                    endif;
                    if($where):
                            $this->db->where($where);
                    endif;
                    if($like):
                        $this->db->like($like);
                    endif;
       
                    $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                    $this->db->order_by('hostel_head_title.title','asc');
                    $this->db->group_by('hostel_head_title.id');
 
                    
    $hostel =   $this->db->get('student_record')->result();
 
      $total_balance = '';
        foreach($hostel as $row):
            if($row->balance > 0):
               $return_array[] = array(
                 'Fee_head'    => $row->fh_head,  
                 'balance'     => $row->balance,  
               ); 
            endif;
            $total_balance+=$row->balance;
        endforeach; 
   
     
         if(!empty($result_details)):
             if($total_balance>0):
                  $array[] = array(
             'program_name' => $pro_row->programe_name,
             'Fee_details'  => json_decode(json_encode($return_array), FALSE) ,
//             'credit'       => $result_credit,
//             'hostel'       => array_filter($hostel),
              
         );
             endif;
           
         endif;
         
          endforeach;
      
         return   json_decode(json_encode($array), FALSE);
    
}  


         public function net_receivable_program_wise_all($where,$like){
     
     
            $program = $this->input->post('programe_id');
            if(!empty($program)):
                $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
                      else:
                $programe_result = $this->db->get('programes_info')->result();
            endif;
                $array= '';
          foreach($programe_result as $pro_row):
               
                $this->db->select('fee_heads.fh_head,sum(fee_actual_challan_detail.balance) as balance');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
//           
            if($where):
                    $this->db->where($where);
            endif;
 
            if($like):
                    $this->db->like($like);
            endif;
                $this->db->where(array('fee_actual_challan_detail.delete_head_flag'=>1));
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
            
            $result_details=$this->db->get('fee_challan')->result();
                    $return_array = '';
                    $total_balance = '';
                     foreach($result_details as $row):
                         if($row->balance > 0):
                            $return_array[] = array(
                              'Fee_head'    => $row->fh_head,  
                              'balance'     => $row->balance,  
                            ); 
                         endif;
                         $total_balance+=$row->balance;
                     endforeach; 


         $this->db->select('
                hostel_heads.id as head_id,
                hostel_head_title.title as fh_head,
                hostel_head_title.id,
                student_record.student_id,
                hostel_student_bill.head_type,
                sum(hostel_student_bill_info.balance) as balance
                 ');
        
                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer'); 
                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
//                    $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
//                    if(empty($date['from'])):
//                            $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
//                        else:
//                             $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
//                    endif;
                    if($where):
                         $this->db->where($where);
                    endif;
                    if($like):
                        $this->db->like($like);
                    endif;
                    
                    $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                    $this->db->order_by('hostel_head_title.title','asc');
                    $this->db->group_by('hostel_head_title.id');
 
                    
    $hostel =   $this->db->get('student_record')->result();
 
      
        foreach($hostel as $row):
            if($row->balance > 0):
               $return_array[] = array(
                 'Fee_head'    => $row->fh_head,  
                 'balance'     => $row->balance,  
               ); 
            endif;
            $total_balance+=$row->balance;
        endforeach; 
   
     
         if(!empty($result_details)):
             if($total_balance>0):
                  $array[] = array(
             'program_name' => $pro_row->programe_name,
             'Fee_details'  => json_decode(json_encode($return_array), FALSE) ,
//             'credit'       => $result_credit,
//             'hostel'       => array_filter($hostel),
              
         );
             endif;
           
         endif;
         
          endforeach;
      
         return   json_decode(json_encode($array), FALSE);
    
}  
     public function net_receivable_program_wise_college($where,$like){
     
     
            $program = $this->input->post('programe_id');
            if(!empty($program)):
                $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
                      else:
                $programe_result = $this->db->get('programes_info')->result();
            endif;
                $array= '';
          foreach($programe_result as $pro_row):
               
                $this->db->select('fee_heads.fh_head,sum(fee_actual_challan_detail.balance) as balance');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
//           
            if($where):
                    $this->db->where($where);
            endif;
 
            if($like):
                    $this->db->like($like);
            endif;
                $this->db->where(array('fee_actual_challan_detail.delete_head_flag'=>1));
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
            
            $result_details=$this->db->get('fee_challan')->result();
                    $return_array = '';
                    $total_balance = '';
                     foreach($result_details as $row):
                         if($row->balance > 0):
                            $return_array[] = array(
                              'Fee_head'    => $row->fh_head,  
                              'balance'     => $row->balance,  
                            ); 
                         endif;
                         $total_balance+=$row->balance;
                     endforeach; 


         $this->db->select('
                hostel_heads.id as head_id,
                hostel_head_title.title as fh_head,
                hostel_head_title.id,
                student_record.student_id,
                hostel_student_bill.head_type,
                sum(hostel_student_bill_info.balance) as balance
                 ');
        
                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer'); 
                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
//                    $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
//                    if(empty($date['from'])):
//                            $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
//                        else:
//                             $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
//                    endif;
                    if($where):
                         $this->db->where($where);
                    endif;
                    if($like):
                        $this->db->like($like);
                    endif;
                    
                    $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                    $this->db->order_by('hostel_head_title.title','asc');
                    $this->db->group_by('hostel_head_title.id');
 
                    
    $hostel =   $this->db->get('student_record')->result();
 
//      $total_balance = '';
//        foreach($hostel as $row):
//            if($row->balance > 0):
//               $return_array[] = array(
//                 'Fee_head'    => $row->fh_head,  
//                 'balance'     => $row->balance,  
//               ); 
//            endif;
//            $total_balance+=$row->balance;
//        endforeach; 
   
     
         if(!empty($result_details)):
             if($total_balance>0):
                  $array[] = array(
             'program_name' => $pro_row->programe_name,
             'Fee_details'  => json_decode(json_encode($return_array), FALSE) ,
//             'credit'       => $result_credit,
//             'hostel'       => array_filter($hostel),
              
         );
             endif;
           
         endif;
         
          endforeach;
      
         return   json_decode(json_encode($array), FALSE);
    
}  

     public function net_receivable_program_wise_hostel($where,$like){
     
     
            $program = $this->input->post('programe_id');
            if(!empty($program)):
                $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
                      else:
                $programe_result = $this->db->get('programes_info')->result();
            endif;
                $array= '';
          foreach($programe_result as $pro_row):
               
                $this->db->select('fee_heads.fh_head,sum(fee_actual_challan_detail.balance) as balance');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
//           
            if($where):
                    $this->db->where($where);
            endif;
 
            if($like):
                    $this->db->like($like);
            endif;
                $this->db->where(array('fee_actual_challan_detail.delete_head_flag'=>1));
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
            
            $result_details=$this->db->get('fee_challan')->result();
                    $return_array = '';
//                    $total_balance = '';
//                     foreach($result_details as $row):
//                         if($row->balance > 0):
//                            $return_array[] = array(
//                              'Fee_head'    => $row->fh_head,  
//                              'balance'     => $row->balance,  
//                            ); 
//                         endif;
//                         $total_balance+=$row->balance;
//                     endforeach; 


         $this->db->select('
                hostel_heads.id as head_id,
                hostel_head_title.title as fh_head,
                hostel_head_title.id,
                student_record.student_id,
                hostel_student_bill.head_type,
                sum(hostel_student_bill_info.balance) as balance
                 ');
        
                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer'); 
                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                    $this->db->where('hostel_student_bill.head_type','1');
//                    $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
//                    if(empty($date['from'])):
//                            $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
//                        else:
//                             $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
//                    endif;
                    if($where):
                         $this->db->where($where);
                    endif;
                    if($like):
                        $this->db->like($like);
                    endif;
                    
                    $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                    $this->db->order_by('hostel_head_title.title','asc');
                    $this->db->group_by('hostel_head_title.id');
 
                    
    $hostel =   $this->db->get('student_record')->result();
 
      $total_balance = '';
        foreach($hostel as $row):
            if($row->balance > 0):
               $return_array[] = array(
                 'Fee_head'    => $row->fh_head,  
                 'balance'     => $row->balance,  
               ); 
            endif;
            $total_balance+=$row->balance;
        endforeach; 
   
     
         if(!empty($result_details)):
             if($total_balance>0):
                  $array[] = array(
             'program_name' => $pro_row->programe_name,
             'Fee_details'  => json_decode(json_encode($return_array), FALSE) ,
//             'credit'       => $result_credit,
//             'hostel'       => array_filter($hostel),
              
         );
             endif;
           
         endif;
         
          endforeach;
      
         return   json_decode(json_encode($array), FALSE);
    
}  
     public function net_receivable_program_wise_mess($where,$like){
     
     
            $program = $this->input->post('programe_id');
            if(!empty($program)):
                $programe_result = $this->db->get_where('programes_info',array('programes_info.programe_id'=>$program))->result();
                      else:
                $programe_result = $this->db->get('programes_info')->result();
            endif;
                $array= '';
          foreach($programe_result as $pro_row):
               
                $this->db->select('fee_heads.fh_head,sum(fee_actual_challan_detail.balance) as balance');
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
//           
            if($where):
                    $this->db->where($where);
            endif;
 
            if($like):
                    $this->db->like($like);
            endif;
                $this->db->where(array('fee_actual_challan_detail.delete_head_flag'=>1));
                $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
            
            $result_details=$this->db->get('fee_challan')->result();
                    $return_array = '';
//                    $total_balance = '';
//                     foreach($result_details as $row):
//                         if($row->balance > 0):
//                            $return_array[] = array(
//                              'Fee_head'    => $row->fh_head,  
//                              'balance'     => $row->balance,  
//                            ); 
//                         endif;
//                         $total_balance+=$row->balance;
//                     endforeach; 


         $this->db->select('
                hostel_heads.id as head_id,
                hostel_head_title.title as fh_head,
                hostel_head_title.id,
                student_record.student_id,
                hostel_student_bill.head_type,
                sum(hostel_student_bill_info.balance) as balance
                 ');
        
                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer'); 
                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                    $this->db->where('hostel_student_bill.head_type','2');
//                    $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
//                    if(empty($date['from'])):
//                            $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
//                        else:
//                             $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
//                    endif;
                    if($where):
                         $this->db->where($where);
                    endif;
                    if($like):
                        $this->db->like($like);
                    endif;
                    
                    $this->db->where('programes_info.programe_id',$pro_row->programe_id);
                    $this->db->order_by('hostel_head_title.title','asc');
                    $this->db->group_by('hostel_head_title.id');
 
                    
    $hostel =   $this->db->get('student_record')->result();
 
      $total_balance = '';
        foreach($hostel as $row):
            if($row->balance > 0):
               $return_array[] = array(
                 'Fee_head'    => $row->fh_head,  
                 'balance'     => $row->balance,  
               ); 
            endif;
            $total_balance+=$row->balance;
        endforeach; 
   
     
         if(!empty($result_details)):
             if($total_balance>0):
                  $array[] = array(
             'program_name' => $pro_row->programe_name,
             'Fee_details'  => json_decode(json_encode($return_array), FALSE) ,
//             'credit'       => $result_credit,
//             'hostel'       => array_filter($hostel),
              
         );
             endif;
           
         endif;
         
          endforeach;
      
         return   json_decode(json_encode($array), FALSE);
    
}  
    public function net_receivable_excel($where=Null,$amount=NULL,$like=NULL){
     
     $this->db->select(
                        '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                    '
                    );
            
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
            if($where):
                $this->db->where($where);
            endif;
            if($like):
                $this->db->like($like);
            endif; 
            $this->db->order_by('sections.name','asc');
            $this->db->order_by('student_record.college_no','asc');
$result =   $this->db->get('student_record')->result();
                        $this->db->select('fee_heads.fh_Id,fh_head');    
                        $this->db->join('fee_class_setups','fee_class_setups.fh_Id=fee_heads.fh_id');
                        $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.fee_id=fee_class_setups.fcs_id');
                        $this->db->group_by('fee_heads.fh_id');
                        $this->db->order_by('fee_heads.fh_id','asc');
//                        $this->db->where(array('fee_actual_challan_detail.delete_head_flag'=>1));
    $fee_heads_result = $this->db->get_where('fee_heads',array('fee_actual_challan_detail.delete_head_flag'=>1))->result();
          
           //Top College Fee Head Titles
           
                $fee_heads[]    = 'COLLEGE NO';
                $fee_heads[]    = 'STUDENT NAME';
                $fee_heads[]    = 'CLASS';
            foreach($fee_heads_result as $feeRow):
                $fee_heads[]    = strtoupper($feeRow->fh_head);
            endforeach;
            
            //Top Mess & Hostel Head Titles
                                  $this->db->order_by('title');  
            $mess_hostel_result = $this->db->get_where('hostel_head_title')->result();
            
            foreach($mess_hostel_result as $feeMS):
                $fee_heads[]    = strtoupper($feeMS->title);
            endforeach;
            
          
                $fee_heads[]    = 'NET RECEIVABLE';
                $fee_heads[]    = 'REMARKS';
           
              $student_fee_details = '';  
              $gtotal_payment = '';
           foreach($result as $students):
                
                $total_payment = '';
                $student_fee_info = '';
                $arra_1 = '';
                $arra_2 = '';
            foreach($fee_heads_result as $feeRow):
               
                //**************************************
                //Fee Balance 
                //**************************************

                                $this->db->select('fc_challan_id as head_id,sum(balance) as balance,fh_head as Head_title');    
                                $this->db->order_by('fc_challan_id','asc');
                                $this->db->group_by('fee_heads.fh_Id');
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');

              $fee_balance =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'fee_heads.fh_Id'=>$feeRow->fh_Id,'fee_actual_challan_detail.delete_head_flag'=>1))->row();
               if(!empty($fee_balance)):
                   $student_fee_info[] = $fee_balance->balance;
                  
//                   $student_fee_info[] = $fee_balance->balance;
               $total_payment +=$fee_balance->balance;
                    else:
                    $student_fee_info[] = 0;
               endif; 
            endforeach;
              foreach($mess_hostel_result as $HMfeeRow):
                //**************************************
                //Hostel & Mess Balance 
                //**************************************

                                    $this->db->select('
                                            hostel_head_title.title as Head_title,
                                            sum(balance) as balance,
                                            ');
                                    $this->db->order_by('hostel_student_bill_info.id','asc');
                                    $this->db->group_by('hostel_head_title.id');
                                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                     
                $hostel_record =   $this->db->get_where('hostel_student_record',array('student_id'=>$students->student_id,'hostel_head_title.id'=>$HMfeeRow->id))->row();
              
                 if(!empty($hostel_record)):
                    $student_fee_info[]  = $hostel_record->balance;
                    $total_payment      += $hostel_record->balance;
                else:
                    $student_fee_info[] = 0;
                endif;
            endforeach;
            $gtotal_payment +=$total_payment;
                if($total_payment):
                     
                    $arra_1[]    = $students->college_no;
                    $arra_1[]    = $students->student_name;
                    $arra_1[]    = $students->Group;
                    
                    $arra_2[]    = $total_payment;
                    $arra_2[]    = '';
                    
                    $student_fee_details1 = array_merge($arra_1,$student_fee_info);
                    $student_fee_details[] = array_merge($student_fee_details1,$arra_2);
                    
                    
                    
                    
                endif;
                
             
           endforeach;
 return array_merge(array('0'=>$fee_heads),$student_fee_details);

 }
public function full_defaulter_notice_report($where=Null,$amount=NULL,$like=NULL,$date){
     
         
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
                        student_denotice.amount,
                        student_denotice.print_date,
                        student_denotice.print_date,
                        student_denotice.due_date,
                        '
                    );
            
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
            $this->db->join('student_denotice','student_denotice.student_id=student_record.student_id');
            $this->db->order_by('sub_programes.sub_pro_id','asc');
             
             if(empty($date['fromDate'])):
                   $this->db->where('student_denotice.due_date <=',date('Y-m-d', strtotime($date['toDate'])));
                    else:
                     $this->db->where('student_denotice.due_date BETWEEN "'.date('Y-m-d', strtotime($date['fromDate'])).'" AND "'.date('Y-m-d', strtotime($date['toDate'])).'"');   
            endif; 
             
             
            if($where):
                    $this->db->where($where);
            endif;
                if($like):
                    $this->db->like($like);
                endif; 
                       $this->db->order_by('student_record.college_no','asc');
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
        //**************************************
        //Fee Balance 
        //**************************************
                                $this->db->select('fc_challan_id,balance,old_credit_amount,actual_amount');    
                                $this->db->order_by('fc_challan_id','asc');
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'delete_head_flag'=>1))->result();
//              
//                                $this->db->select('fc_challan_id,sum(balance) as balance,sum(old_credit_amount) as old_credit_amount,sum(actual_amount) as actual_amount');    
//                                $this->db->order_by('fc_challan_id','asc');
//                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
//              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'delete_head_flag'=>1))->row();
//             echo '<pre>';print_r($challan_info);die;
              $fee_balance          = '';
              $old_credit_amount    = '';
//               
//              
                foreach($challan_info as $blc):
                      $fee_balance          +=$blc->balance;  
                      $old_credit_amount    +=$blc->old_credit_amount;  
                endforeach;
                
               if($fee_balance>0):
                   $show_balance = $fee_balance;
//               if($challan_info->balance>0):
//                   $show_balance = $challan_info->balance;
                  $data_fee = array(
                  'student_id'      => $students->student_id,  
                  'balance'         => $show_balance,  
                  'default_type'    => 1,  
                  'userId'          => $this->userInfo->user_id,  
                  'timestamp'       => date('Y-m-d H:i:s'),  
                   
                );
//                  echo '<pre>';print_r($data_fee);die;
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
                                        $this->db->having('balance >=',$amount);
                                    endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>1,'userId'=>$this->userInfo->user_id))->row();
                   if(!empty($balance_result)):
//                  if($balance_result->balance > 0):
                      $attendance = $this->CRUDModel->get_student_attendance($students->student_id,$students->sec_id);
                        $marks = $this->CRUDModel->get_student_montly_marks($students->student_id,$students->sec_id);
        $balance_array[] = array(
            
             
                   'sub_pro_id'     => $students->sub_pro_id,
                   'programe_id'    => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'student_id'     => $students->student_id,
                   'prospectus_batch'=> $students->batch_name,
                   'form_no'        => $students->form_no,
                   'sub_program'    => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'noticeAmount'   => $students->amount,
                   'print_date'   => $students->print_date,
                   'due_date'   => $students->due_date,
                   'student_status' => $students->student_status,
                   'balance'        => $balance_result->balance,
                   'attendance'     => $attendance,
                   'marks'         => $marks,
                 );
                  endif;
//                endif;
                 
                  
                  
            endforeach;
                if(!empty($balance_array)):
                    $keys   = array_column($balance_array, 'attendance');
                    array_multisort($keys, SORT_ASC, $balance_array);
                    return      json_decode(json_encode($balance_array), FALSE);
                    else:
                    return false;
            endif;
       
 
    
}
  public function fee_challan_students_admission($where=Null,$std_no=NULL){
 
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                             student_record.batch_id,
                             student_record.student_id,
                             student_record.sub_pro_id,
                             student_record.student_name,
                             student_record.migration_status,
                             student_record.father_name,
                             sections.name as sectionsName,
                             student_status.name as current_status,
                             prospectus_batch.batch_name,
                             applicant_edu_detail.obtained_marks,
                             applicant_edu_detail.total_marks,
                             
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
                $this->db->where_in('student_status.s_status_id',array('1'));
                if($std_no['std_no_from'] == ''):
                   $this->db->where('applicant_edu_detail.obtained_marks <=',$std_no['std_no_to']);
                    else:
                     $this->db->where('applicant_edu_detail.obtained_marks BETWEEN "'.$std_no['std_no_from'].'" AND "'.$std_no['std_no_to'].'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('applicant_edu_detail.obtained_marks','desc');
//                $this->db->order_by('student_record.student_id','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->result();
    }
  public function fee_defaulter_head_wise_student($where=NULL,$where_head=NULL,$date=NULL){
          
//                $this->db->select('
//                    fh_head
//                        ');
                
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
                
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->where('fee_challan.fc_ch_status_id',1);
//                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
                
                   if(empty($date['from'])):
                  
                   $this->db->where('fc_dueDate <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fc_dueDate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                if($where_head):
                    $this->db->where($where_head);
                endif;
                $this->db->where('delete_head_flag','1'); 
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
                 
         return $this->db->get('fee_challan')->result();

//         return   json_decode(json_encode($array), FALSE);
////        echo '<pre>';print_r($this->db->get('fee_challan')->result());die;
    }
     public function fee_defaulter_details_head_wise_student($where=Null,$like=NULL,$date=NULL){
 
                $this->db->select(
                 '
                  sections.name as sessionName,
                  student_record.college_no,
                  student_record.student_id,
                  student_record.student_name,
                  student_record.student_name as studentName,
                  programes_info.programe_name,
                  prospectus_batch.batch_name,
                  sum(fee_actual_challan_detail.actual_amount) as actual_amount,
                  sum(fee_actual_challan_detail.paid_amount) as paid_amount,
                  sum(fee_actual_challan_detail.balance) as balance,
                 ');
                
                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->where('fee_challan.fc_ch_status_id',1);
//                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
                $this->db->where('delete_head_flag','1');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               if($date['from'] == ''):
                   $this->db->where('fc_dueDate <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('fc_dueDate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
               // $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                 $this->db->group_by('student_record.student_id');
                 $this->db->order_by('sections.name','asc');
        return  $this->db->get('fee_challan')->result();
    }
      public function fee_challan_generate_pdf_only($where=Null,$std_no=NULL,$date=NULL){
 
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                             student_record.batch_id,
                             student_record.student_id,
                             student_record.sub_pro_id,
                             student_record.student_name,
                             student_record.migration_status,
                             student_record.father_name,
                             sections.name as sectionsName,
                             student_status.name as current_status,
                             prospectus_batch.batch_name,
                             applicant_edu_detail.obtained_marks,
                             applicant_edu_detail.total_marks,
                             
                         ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
                
                if($std_no['std_no_from'] == ''):
                   $this->db->where('applicant_edu_detail.obtained_marks <=',$std_no['std_no_to']);
                    else:
                     $this->db->where('applicant_edu_detail.obtained_marks BETWEEN "'.$std_no['std_no_from'].'" AND "'.$std_no['std_no_to'].'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                
                 if(empty($date['entry_date_from'])):
                   $this->db->where('date_format(student_record.timestamp,"%Y-%m-%d") <=',date('Y-m-d',strtotime($date['entry_date_to'])));
                else:
                     $this->db->where('date_format(student_record.timestamp,"%Y-%m-%d") BETWEEN "'.date('Y-m-d',strtotime($date['entry_date_from'])).'" AND "'.date('Y-m-d',strtotime($date['entry_date_to'])).'"');   
                endif;
                
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('applicant_edu_detail.obtained_marks','desc');
//                $this->db->order_by('student_record.student_id','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->result();
    }
      public function student_update_sift($where=Null,$std_no=NULL){
 
            $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                             student_record.batch_id,
                             student_record.student_id,
                             student_record.sub_pro_id,
                             student_record.student_name,
                             student_record.migration_status,
                             student_record.father_name,
                             shift.name as StudentShift, 
                             student_status.name as current_status,
                             prospectus_batch.batch_name,
                             applicant_edu_detail.obtained_marks,
                             applicant_edu_detail.total_marks,
                             programes_info.programe_name,
                             sub_programes.name as SubProgram,
                             
                         ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
//                $this->db->where_in('student_status.s_status_id',array('1'));
                if($std_no['std_no_from'] == ''):
                   $this->db->where('applicant_edu_detail.obtained_marks <=',$std_no['std_no_to']);
                    else:
                     $this->db->where('applicant_edu_detail.obtained_marks BETWEEN "'.$std_no['std_no_from'].'" AND "'.$std_no['std_no_to'].'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('applicant_edu_detail.obtained_marks','desc');
                $this->db->order_by('student_record.student_name','asc');
//                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->result();
    }
    
    public function full_defaulter_msg($where=Null,$amount=NULL,$like=NULL){
     
         
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
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
              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'delete_head_flag'=>1))->result();
             
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
                                        $this->db->having('balance >=',$amount);
                                    endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>1,'userId'=>$this->userInfo->user_id))->row();
                   if(!empty($balance_result)):
                  if($balance_result->balance > 0):
                  
        $balance_array[] = array(
            
             
                    
                   'sec_id'         => $students->sec_id,
                   'programe_id'    => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
                   'student_id'     => $students->student_id,
                    'batch_id'       => $students->batch_id,
                   'sub_pro_id'       => $students->sub_pro_id,
                   'prospectus_batch'=> $students->batch_name,
                   'form_no'        => $students->form_no,
                   'sub_program'     => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'student_status' => $students->student_status,
                   'balance'        => $balance_result->balance,
                   'attendance'     => 0,
                    'marks'         => 0,
                 );
                  endif;
                endif;
                 
                  
                  
            endforeach;
                if(!empty($balance_array)):
                    $keys   = array_column($balance_array, 'attendance');
                    array_multisort($keys, SORT_ASC, $balance_array);
                    return      json_decode(json_encode($balance_array), FALSE);
                    else:
                    return false;
            endif;
    }
    public function Feedefaulter_msg($where=Null,$amount=NULL,$like=NULL){
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
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
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
                //**************************************
                //Fee Balance 
                //**************************************
                                $this->db->select('fc_challan_id,balance');    
                                $this->db->order_by('fc_challan_id','asc');
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
              $challan_info =   $this->db->get_where('fee_challan',array('fc_student_id'=>$students->student_id,'delete_head_flag'=>1))->result();
                
              $fee_balance = '';
              
                foreach($challan_info as $blc):
                        
                      $fee_balance +=$blc->balance;  
                    
                endforeach;
               if($fee_balance>0):
                  $data_fee = array(
                  'student_id'      => $students->student_id,  
                  'balance'         => $fee_balance,  
                  'default_type'    => 2,  
                  'userId'          => $this->userInfo->user_id,  
                  'timestamp'       => date('Y-m-d H:i:s'),  
                   
                );
                $this->CRUDModel->insert('fee_defaulter',$data_fee);
               
               endif; 
                 
                                $this->db->select_sum('balance');
                                if($amount):
                                    $this->db->where('balance >=',$amount);
                                endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>2,'userId'=>$this->userInfo->user_id))->row();
                  if(!empty($balance_result)):
                      if($balance_result->balance > 0):
                       
                    $balance_array[] = array(
            
                        
                   'sec_id'         => $students->sec_id,
                   'programe_id'     => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
                   'student_id'     => $students->student_id,
                   'prospectus_batch'=> $students->batch_name,
                   'batch_id'       => $students->batch_id,
                   'sub_pro_id'       => $students->sub_pro_id,
                   'form_no'        => $students->form_no,
                   'sub_program'     => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'student_status' => $students->student_status,
                   'balance'        => $balance_result->balance,
                   'attendance'     => 0,
                    'marks'         => 0,
                 );
                  endif;
                 endif;
                  
                  
            endforeach;
            
            if(!empty($balance_array)):
                       $keys   = array_column($balance_array, 'attendance');
                array_multisort($keys, SORT_ASC, $balance_array);
             return      json_decode(json_encode($balance_array), FALSE);
            endif;
    }
    public function hostel_and_mess_defaulter_msg($where=Null,$amount=NULL,$like=NULL){
     
         
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        programes_info.programe_id,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
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
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
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
                            'default_type'    => 3,  
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
                            'default_type'    => 3,  
                            'userId'       => $this->userInfo->user_id,
                            'timestamp'    => date('Y-m-d H:i:s'),

                          );
                       $this->CRUDModel->insert('fee_defaulter',$data_mess);

                        
                        
                    endif;
                  endif;
                                    $this->db->select_sum('balance');
                                    if($amount):
                                        $this->db->having('balance >=',$amount);
                                    endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>3,'userId'=>$this->userInfo->user_id))->row();
                  if(!empty($balance_result)):
                     if($balance_result->balance > 0):
                   
                    $balance_array[] = array(
            
             
                   'sec_id'         => $students->sec_id,
                   'programe_id'     => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
                   'student_id'     => $students->student_id,
                   'batch_id'       => $students->batch_id,
                   'sub_pro_id'       => $students->sub_pro_id,
                   'prospectus_batch'=> $students->batch_name,
                   'form_no'        => $students->form_no,
                   'sub_program'     => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'student_status' => $students->student_status,
                   'balance'        => $balance_result->balance,
                   'attendance'     => 0,
                    'marks'         => 0,
                 );
                  endif;
                 endif;
                  
                  
            endforeach;
         if(!empty($balance_array)):
                       $keys   = array_column($balance_array, 'attendance');
                array_multisort($keys, SORT_ASC, $balance_array);
             return      json_decode(json_encode($balance_array), FALSE);
            endif;
 }
    public function hostel_defaulter_msg($where=Null,$amount=NULL,$like=NULL){
     
         
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
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
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
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
                            'default_type'    => 4,  
                            'userId'            => $this->userInfo->user_id,  
                            'timestamp'         => date('Y-m-d H:i:s'),    
                          );
                       $this->CRUDModel->insert('fee_defaulter',$data_hostel);

                        
                        
                    endif;
                  endif;

                                    $this->db->select_sum('balance');
                                    if($amount):
                                        $this->db->where('balance >=',$amount);
                                    endif;
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>4,'userId'=>$this->userInfo->user_id))->row();
                  if(!empty($balance_result)):
                if($balance_result->balance > 0):
                    
                    $balance_array[] = array(
            
             
                   'sec_id'         => $students->sec_id,
                   'programe_id'     => $students->programe_id,
                   'college_no'     => $students->college_no,
                   'student_id'     => $students->student_id,
                    'batch_id'       => $students->batch_id,
                   'sub_pro_id'       => $students->sub_pro_id,
                    'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
                   'prospectus_batch'=> $students->batch_name,
                   'form_no'        => $students->form_no,
                   'sub_program'     => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'student_status' => $students->student_status,
                   'balance'        => $balance_result->balance,
                   'attendance'     => 0,
                    'marks'         => 0,
                 );
                  endif;
                  endif;
                 
                  
                  
            endforeach;
          if(!empty($balance_array)):
                       $keys   = array_column($balance_array, 'attendance');
                array_multisort($keys, SORT_ASC, $balance_array);
             return      json_decode(json_encode($balance_array), FALSE);
            endif;
 }
    public function mess_defaulter_msg($where=Null,$amount=NULL,$like=NULL){
     
         
            $this->CRUDModel->deleteid('fee_defaulter',array('userId'=>$this->userInfo->user_id));
         
         
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        student_record.batch_id,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
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
            $result =  $this->db->get('student_record')->result();
            $balance_array = '';
            foreach($result as $students):
                
                 
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
                            'default_type'    => 5,  
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
                  $balance_result = $this->db->get_where('fee_defaulter',array('student_id'=>$students->student_id,'default_type'=>5,'userId'=>$this->userInfo->user_id))->row();
                  
                       if($balance_result->balance > 0):
                      
                    $balance_array[] = array(
            
             
                   'sec_id'         => $students->sec_id,
                   'programe_id'     => $students->programe_id,
                   'college_no'     => $students->college_no,
                    'batch_id'       => $students->batch_id,
                   'sub_pro_id'       => $students->sub_pro_id,
                   'StudentMobile'  => $students->applicant_mob_no1,
                   'FatherMobile'   => $students->mobile_no,
                   'student_id'     => $students->student_id,
                   'prospectus_batch'=> $students->batch_name,
                   'form_no'        => $students->form_no,
                   'sub_program'     => $students->sub_program,
                   'Group'          => $students->Group,
                   'student_name'   => $students->student_name,
                   'father_name'    => $students->father_name,
                   'student_status' => $students->student_status,
                   'balance'        => $balance_result->balance,
                   'attendance'     => '0',
                    'marks'         => '0',
                 );
                  endif;
                 
                  
                  
            endforeach;
       if(!empty($balance_array)):
                       $keys   = array_column($balance_array, 'attendance');
                array_multisort($keys, SORT_ASC, $balance_array);
             return      json_decode(json_encode($balance_array), FALSE);
    endif;
 }
  public function fee_message_report($where=NULL,$like=NULL,$date){
     
                    $this->db->join('fee_message_details','fee_message_details.fee_msgd_msg_id=fee_message.fee_msg_id');
                    $this->db->join('fee_message_stage','fee_message_stage.fee_stag_id=fee_message.fee_msg_stage_id');
//                    $this->db->join('fee_defaulter_type','fee_defaulter_type.id=fee_message.fee_msg_defltr_type');
                    
                    $this->db->join('student_record','student_record.student_id=fee_message_details.fee_msgd_std_id');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                    $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
                    
                    if($where):
                    $this->db->where($where);
                    endif;
                    if($like):
                        $this->db->like($like);
                    endif;
                    
                if($date['date_from'] == ''):
                   $this->db->where('DATE_FORMAT(fee_message.fee_msg_date_time,"%Y-%m-%d") <=',date('Y-m-d', strtotime($date['date_to'])));
                    else:
                     $this->db->where('DATE_FORMAT(fee_message.fee_msg_date_time,"%Y-%m-%d") BETWEEN "'.date('Y-m-d', strtotime($date['date_from'])).'" AND "'.date('Y-m-d', strtotime($date['date_to'])).'"');   
                endif;
                $this->db->order_by('fee_msg_date_time','desc');    
                    
            return  $this->db->get('fee_message')->result();
 }
 
    public function fee_challan_change_date($where=Null,$amount=NULL,$like=NULL){
           $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        programes_info.programe_id,
                        sub_programes.sub_pro_id,
                        student_record.form_no,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                        sections.sec_id,
                        prospectus_batch.batch_name,
                    '
                    );
            
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif; 
                $result =  $this->db->get('student_record')->result();
            
                
            
            $balance_array = array();
            foreach($result as $students):
                $where_fee = array(
                            'fc_student_id'         => $students->student_id,
                            'balance >'             =>0,
                            'delete_head_flag'      => 1
                            );
           
                                $this->db->select('fc_challan_id,sum(balance) as balance,fc_dueDate');    
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                                $this->db->group_by('fc_challan_id');
                                $this->db->order_by('fc_student_id','desc');
            $challan_info =     $this->db->get_where('fee_challan',$where_fee)->row();
               
              if($challan_info):
                  
                    if($amount):
                        if($fee_balance>$amount):
                            $balance_array[] = array(
                                'sec_id'         => $students->sec_id,
                                'programe_id'     => $students->programe_id,
                                'college_no'     => $students->college_no,
                                'StudentMobile'  => $students->applicant_mob_no1,
                                'FatherMobile'   => $students->mobile_no,
                                'student_id'     => $students->student_id,
                                'prospectus_batch'=> $students->batch_name,
                                'batch_id'       => $students->batch_id,
                                'sub_pro_id'       => $students->sub_pro_id,
                                'form_no'        => $students->form_no,
                                'sub_program'     => $students->sub_program,
                                'Group'          => $students->Group,
                                'student_name'   => $students->student_name,
                                'father_name'    => $students->father_name,
                                'student_status' => $students->student_status,
                                'balance'        => $challan_info->balance,
                                'challan_id'     => $challan_info->fc_challan_id,
                                'due_date'      => $challan_info->fc_dueDate,
                            );
                        endif;
                    else:
                        $balance_array[] = array(
                            'sec_id'         => $students->sec_id,
                            'programe_id'    => $students->programe_id,
                            'college_no'     => $students->college_no,
                            'StudentMobile'  => $students->applicant_mob_no1,
                            'FatherMobile'   => $students->mobile_no,
                            'student_id'     => $students->student_id,
                            'prospectus_batch'=> $students->batch_name,
                            'batch_id'       => $students->batch_id,
                            'sub_pro_id'     => $students->sub_pro_id,
                            'form_no'        => $students->form_no,
                            'sub_program'    => $students->sub_program,
                            'Group'          => $students->Group,
                            'student_name'   => $students->student_name,
                            'father_name'    => $students->father_name,
                            'student_status' => $students->student_status,
                            'balance'        => $challan_info->balance,
                            'challan_id'     => $challan_info->fc_challan_id,
                            'due_date'      => $challan_info->fc_dueDate,
                        );
                   endif;
                  
                  
              endif;
            endforeach;
            
            if(!empty($balance_array)):
                       $keys   = array_column($balance_array, 'challan_id');
                array_multisort($keys, SORT_ASC, $balance_array);
             return      json_decode(json_encode($balance_array), FALSE);
            endif;
    }
}
