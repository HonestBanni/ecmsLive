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
                $this->db->join('fee_coa_master_sub_child','fee_coa_master_sub_child.fn_coa_mc_id=fee_heads.fn_coa_mc_id');
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
                $this->db->join('fn_coa_master_sub_child','fee_heads.fn_coa_mc_id=fn_coa_master_sub_child.fn_coa_mc_id');
                if($where):
                    $this->db->where($where);
                endif;
                return  $this->db->get('fee_heads')->row();
    }
    public function get_class_setup($where=NULL){
               
                
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
                             student_record.student_name,
                             student_record.father_name,
                             sections.name as sectionsName,
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
                $this->db->where_in('student_status.s_status_id',array('5','12'));
//                 $this->db->where('student_status.s_status_id',5);
//                 $this->db->where('student_status.s_status_id',12);
                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->group_by('student_record.college_no');
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
                        fee_challan.fc_pay_cat_id,
                        fee_challan.fc_issue_date,
                        fee_challan.fc_challan_credit_amount as credit_amount,
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
              'challan_id'=>$row->fc_challan_id  
            );
                        $this->db->select('sum(actual_amount)as actualAmount,sum(paid_amount) as paidAmount,sum(balance) as balance,old_credit_amount');
            $payments = $this->db->get_where('fee_actual_challan_detail',$where)->row();
            
               $where_curr = array(
                  'challan_id'  => $row->fc_challan_id,  
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
               's_status_id'        => $row->s_status_id,
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
               'credit_amount'      => $row->credit_amount,
               'fee_installment'    => $row->fee_installment,
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
    
      public function fee_bank_reconcilition($where=Null,$like=NULL,$date){
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
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('fc_challan_id','asc');
                $this->db->order_by('fee_challan.fc_paiddate','asc');
                $this->db->order_by('fee_challan.fc_challan_id','asc');
                $this->db->order_by('student_record.form_no','asc');
           
         $result =  $this->db->get('student_record')->result();
         
         
         $array = '';
         foreach($result as $row):
             $this->db->select(
                     '
                        sum(fee_actual_challan_detail.paid_amount)      as paid_total_sum,
                        sum(fee_actual_challan_detail.actual_amount)    as actual_total_sum, 
                     ');   
            $amount = $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$row->fc_challan_id))->row();
           
            
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
                    'sessionName'               => $row->sessionName,
                    'challan_paid_date'         => $row->challan_paid_date,
                    'fc_challan_credit_amount'  => $row->fc_challan_credit_amount,
                    'fc_pay_cat_id'             => $row->fc_pay_cat_id,
                    'student_status'            => $row->student_status,
                    'Concession_amount'         => $row->Concession_amount,
                    'payment_title'             => $row->payment_title,
                    'paid_total_sum'            => $amount->paid_total_sum,
                    'actual_total_sum'          => $amount->actual_total_sum,
                  
                    );
        endforeach;
        
         return   json_decode(json_encode($array), FALSE);
    }
 
//    public function fee_bank_reconcilition_count($where=Null,$like=NULL,$date){
//            $this->db->select(
//                    '   
//                        fee_challan.fc_challan_id,
//                        fee_challan.fc_challan_credit_amount,
//                        student_record.college_no,
//                        student_record.student_name,
//                        student_record.batch_id,
//                        student_record.student_id,
//                        student_record.form_no,
//                        programes_info.programe_name,
//                        sub_programes.name as sub_program_name,
//                        sub_programes.sub_pro_id,
//                        prospectus_batch.batch_name,
//                        sum(fee_actual_challan_detail.paid_amount) as paid_total_sum,
//                        sum(fee_actual_challan_detail.actual_amount) as actual_total_sum,
//                        sections.name as sessionName, 
//                        fee_challan.fc_paiddate as challan_paid_date,
//                        fee_challan.fc_challan_credit_amount,
//                        fee_challan.fc_pay_cat_id as fc_pay_cat_id,
//                        fee_challan.fc_comments as fc_comments,
//                        student_status.name as student_status,
//                        fee_concession_detail.concession_amount as Concession_amount,
//                        fee_category_titles.title as payment_title,
//                        
//                      ');
//            
//                $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id');
//                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
//                $this->db->join('fee_concession_challan','fee_concession_challan.challan_id=fee_challan.fc_challan_id','left outer');
//                //Concession Amount
//                $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id','left outer');
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                // Payment Category 
//                $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left outer');
//                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left outer');
//                
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
//                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
//                $this->db->where_not_in('fee_challan.fc_ch_status_id',array(1,4));
// 
//                if($date['from'] == ''):
//                   $this->db->where('fc_paiddate <=',date('Y-m-d', strtotime($date['to'])));
//                else:
//                     $this->db->where('fc_paiddate BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
//                endif;
//                if($where):
//                    $this->db->where($where);
//                endif;
//                if($like):
//                    $this->db->like($like);
//                endif;
//               
//                $this->db->group_by('fc_challan_id','asc');
//                $this->db->order_by('fee_challan.fc_challan_id','asc');
//                $this->db->order_by('student_record.form_no','asc');
//                $this->db->order_by('fee_challan.fc_paiddate','asc');
//        return  $this->db->get('student_record')->result(); 
//    }
    
    public function fee_bank_reconcilition_date_wise($where=NULL,$date){
 
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
              $crdit  = $this->fee_bank_reconcilition_date_wise_credit($where,$date2);
               
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
                $this->db->group_by('fee_heads.fh_Id');
                $this->db->order_by('fee_heads.fh_head','asc');
                 
         return $this->db->get('fee_challan')->result();
//          $fee_heads =   $this->db->get('fee_challan')->result();
//         $array = '';
//         foreach($fee_heads as $hd_row):
//         
//             
//            $head_details  =  $this->fee_bank_reconcilition_head_wise_section($where,$where_head,$date);
//             $details_record = '';
//             foreach($head_details as $row):
//                 $details_record[] = array(
//                     'Program_info' => $row->programe_name.' '.$row->sessionName.''.$row->batch_name.'',
//                 );
//             endforeach;
//             
//             $array[] = array(
//                 'fh_head'=>$hd_row->fh_head,
//                 'details'=>$details_record
//                 
//             );
//         endforeach;
//         echo '<pre>';print_r($array);die;
         return   json_decode(json_encode($array), FALSE);
//        echo '<pre>';print_r($this->db->get('fee_challan')->result());die;
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
                student_status.name as student_status,
                ');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $this->db->order_by('form_no','asc');
        $this->db->join("sub_programes","sub_programes.sub_pro_id=student_record.sub_pro_id");
        $this->db->join("reserved_seat","reserved_seat.rseat_id=student_record.rseats_id",'left outer');
        $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
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
                       fee_challan.fc_ch_status_id
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
     
     public function fee_defaulter_new($where=Null,$whereAmount=NULL,$like=NULL){
     
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        fee_challan.fc_challan_id,
                        fee_challan.fc_pay_cat_id, 
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                    '
                    );
            $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
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
                    
         $result =  $this->db->get_where('fee_challan',array('fee_challan.challan_id_lock'=>0))->result();
        $balance_array = '';
         foreach($result as $row):
               
           
                             $this->db->where(array('pay_cat_id'=>$row->fc_pay_cat_id,'student_id'=>$row->student_id));
            $balance =  $this->db->get_where('fee_balance',$whereAmount)->row();
              if(!empty($balance)):
            $balance_array[] = array(
                'college_no'        => $row->college_no,
                'student_id'        => $row->student_id,
                'form_no'           => $row->form_no,
                'student_name'      => $row->student_name,
                'father_name'       => $row->father_name,
                'applicant_image'   => $row->applicant_image,
                'fc_challan_id'     => $row->fc_challan_id,
                'student_status'    => $row->student_status,
                'challan_balance'   => $balance->r_amount,
                'sub_program'       => $row->sub_program,
                'Group'             => $row->Group,
                    
            );
            
             endif;
         
         
             
         endforeach;
         
       return   json_decode(json_encode($balance_array), FALSE);
  
    } 
    
     public function full_defaulter($where=Null,$amount=NULL,$like=NULL){
     
            $this->db->select(
                    '
                        student_record.college_no,
                        student_record.student_id,
                        student_record.batch_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.applicant_image,
                        fee_challan.fc_challan_id,
                        fee_challan.fc_pay_cat_id, 
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        sections.name as Group,
                    '
                    );
            $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
            $this->db->where(array('fee_challan.challan_id_lock'=>0));
            
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif; 
                       $this->db->order_by('fc_pay_cat_id'); 
            $result =  $this->db->get('fee_challan')->result();
        
            $balance_array = '';
          
            $whereAmount = '';
            foreach($result as $row):
                  if($amount == 0):
                    $whereAmount['fee_balance.r_amount >'] = $amount;
                     
                    else:
                    $whereAmount['fee_balance.r_amount >='] = $amount;
                    
                endif;
                
                
                //Fee balance 
                $this->db->where(array('fee_challan.challan_id_lock'=>0));
                $this->db->where(array('pay_cat_id'=>$row->fc_pay_cat_id,'student_id'=>$row->student_id));
                                $this->db->join('fee_challan','fee_challan.fc_student_id=fee_balance.student_id');
                $fee_balance =  $this->db->get_where('fee_balance',$whereAmount)->row();
                  
         
                //Hostel & Mess Balance 
                            $this->db->select('hostel_student_bill.id,hostel_student_record.student_id, sum(balance) as hostelBalance');  
                            $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.	hostel_bill_id=hostel_student_bill.id');
                            $this->db->group_by('hostel_student_record.student_id'); 
                            $this->db->having('hostelBalance >=',$amount);
                             
            $hostel_record =   $this->db->get_where('hostel_student_record',array('student_id'=>$row->student_id,'challan_lock'=>0))->row();
       
                if(!empty($fee_balance) || !empty($hostel_record)):
                    $fee = '';
                    $hoste_mess = '';
                    if(!empty($fee_balance)):
                        $fee           = $fee_balance->r_amount;  
                    endif;
                   if(!empty($hostel_record)):
                        $hoste_mess    = $hostel_record->hostelBalance;
                   endif;
                    
                   //  echo $fee.'</br/>'.$hoste_mess;
//                 $total_balance = $fee_balance->r_amount + $hostel_record->hostelBalance;
               
            $balance_array[] = array(
                    'college_no'        => $row->college_no,
                    'student_id'        => $row->student_id,
                    'form_no'           => $row->form_no,
                    'student_name'      => $row->student_name,
                    'father_name'       => $row->father_name,
                    'applicant_image'   => $row->applicant_image,
                    'fc_challan_id'     => $row->fc_challan_id,
                    'student_status'    => $row->student_status,
                    'challan_balance'   => intval($fee) + intval($hoste_mess),
                    'sub_program'       => $row->sub_program,
                    'Group'             => $row->Group
                    );
                endif;
               
            endforeach;
         
       return   json_decode(json_encode($balance_array), FALSE);
 
    
}

    public function fee_challan_student($where=Null){
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
                       
                            $this->db->order_by('fc_challan_id','asc');
                            $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=fee_challan.fc_ch_status_id','left');  
                            $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id','left');  
                            $this->db->join('fee_extra_heads_status','fee_extra_heads_status.id=fee_challan.credit_flag');  
                            $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id','left');  
        $challan_infos  =   $this->db->where(array('fc_student_id'=>$student_id))->get('fee_challan')->result();
        
       
        $array  = '';
        foreach ($challan_infos as $challan_info):
                                 
                $this->db->select(' 
                       fee_heads.fh_head,
                       fee_actual_challan_detail.fee_id,
                       fee_actual_challan_detail.actual_amount,
                       fee_actual_challan_detail.paid_amount,
                       fee_actual_challan_detail.balance,
                       fee_actual_challan_detail.old_balance_pc_id,
                       fee_actual_challan_detail.challan_status,
                       fee_actual_challan_detail.old_balance_pc_id,
                       fee_actual_challan_detail.old_credit_amount,
                       fee_actual_challan_detail.comment as head_comments,
                      '); 
                       
              $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');  
              $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');  

                $payment_detail = $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$challan_info->fc_challan_id))->result();
               $payment_detail_result= '';
                foreach($payment_detail as $row):
                    
                    
                    $current_amount = '';
                    $arrears_amount = '';
                
                    if($row->old_balance_pc_id == 0):
                        $current_amount = $row->actual_amount;
                        else:
                        $arrears_amount = $row->actual_amount;
                    endif;
                    
                    
                    $payment_detail_result[] = array(
                    'fh_head'               => $row->fh_head,    
                    'fee_id'                => $row->fee_id,    
                    'old_balance_pc_id'     => $row->old_balance_pc_id,    
                    'actual_amount'         => $row->actual_amount,    
                    'current_amount'        => $current_amount,    
                    'arrears_amount'        => $arrears_amount,    
                    'paid_amount'           => $row->paid_amount,
                    'old_credit_amount'     => $row->old_credit_amount,
                    'head_comments'         => $row->head_comments,    
                    );
                endforeach;
                
                
                
                $array[]  = array(
                     'challan_id'       =>$challan_info->fc_challan_id,
                     'credit_amount'    =>$challan_info->fc_challan_credit_amount,
                     'fine_title'       =>$challan_info->fine_title,
                     'pc_name'          =>$challan_info->title,
                     'challan_id_lock'  =>$challan_info->challan_id_lock,
                     'ch_status_id'     =>$challan_info->ch_status_id,
                     'fc_paid_form'     =>$challan_info->fc_paid_form,
                     'fc_paid_upto'     =>$challan_info->fc_paid_upto,
                     'fc_dueDate'       =>$challan_info->fc_dueDate,
                     'fc_issue_date'    =>$challan_info->fc_issue_date,
                     'fc_comments'      =>$challan_info->fc_comments,
                     'fc_paiddate'      =>$challan_info->fc_paiddate,
                     'challan_status'   =>$challan_info->fcs_title,
                     'payment_details'   =>json_decode(json_encode($payment_detail_result), FALSE),
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
                                    hostel_student_bill_info.old_challan_id,
                                    ');
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
                                    hostel_student_bill_info.old_challan_id,
                                    hostel_student_bill_info.per_day,
                                    hostel_student_bill_info.total_days,
                                    ');
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
                        student_status.name as student_status,
                        fee_challan.fc_ch_status_id
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
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->group_by('student_record.student_id');
//                $this->db->order_by('fee_challan.fc_challan_id','asc');
               
       $student_record =   $this->db->get('student_record')->result();
        
       $return_array = '';
       
        foreach($student_record as $row):
//             echo '<pre>';print_r($row);
                            $this->db->join('fee_payment_category','fee_payment_category.pc_id=fee_challan.fc_pay_cat_id');
                            $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                             $this->db->order_by('fee_challan.fc_challan_id','asc');
            $fee_challans = $this->db->get_where('fee_challan',array('fc_student_id'=>$row->student_id))->result();
           
//            echo '<pre>';print_r($fee_challans);die;
            
            $fee_challans_info  = '';
            foreach($fee_challans as $challRow):
                 
            //Fee Details 
            $where = array(
              'challan_id'   => $challRow->fc_challan_id,  
            );
            
                            $this->db->select('sum(actual_amount)as actualAmount,sum(paid_amount) as paidAmount,sum(balance) as balance');
            $payments = $this->db->get_where('fee_actual_challan_detail',$where)->row();
           
            
            //current Details  
               $where_curr = array(
                  'challan_id'=>$challRow->fc_challan_id,  
                  'old_balance_pc_id '=>0  
                );
                        $this->db->select('sum(actual_amount)as current_amount');
            $payments_crrent = $this->db->get_where('fee_actual_challan_detail',$where_curr)->row();
            
           //arrears Details
            $where_arre = array(
                  'challan_id'=>$challRow->fc_challan_id,  
                  'old_balance_pc_id !='=>0  
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
               'credit_amount'      => $challRow->fc_challan_credit_amount,
               'fee_installment'    => $challRow->title,
               
               'current'            => $payments_crrent->current_amount,
               'arrears'            => $payments_arrears->arrears_amount,
               
                'total_upPaid'      => $payments->actualAmount,
               'total_Paid'         => $payments->paidAmount,
               'total_balance'      => $payments->balance,
               'concession'         => $concession->concession_amount,
 
                      
           );
            
            
            endforeach;
            
           if($fee_challans_info):
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
            
             
             
        endforeach;
          
        return   json_decode(json_encode($return_array), FALSE);
    }
}
