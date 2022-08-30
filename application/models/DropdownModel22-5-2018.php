<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class DropdownModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    // Hostel student Dropdown 
    public function bank_dropDown($table, $option=NULL,$value,$show,$where=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
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
				$data[$row->$value] = $row->$show.' ('.$row->account_no.')';
			}
			return $data;
		}
	}
    // Hostel student autocomplete    
    public function hostel_student($where,$like=NULL){
             if($like):
            $this->db->like('student_name',$like);
            $this->db->or_like('form_no',$like);
            $this->db->or_like('college_no',$like);
        endif;
               $this->db->join('hostel_student_record','student_record.student_id=hostel_student_record.student_id'); 
       return  $this->db->where($where)->get('student_record')->result();
    }
    // Hostel student autocomplete    
    public function hostel_students($where,$like=NULL){
             if($like):
            $this->db->like('student_name',$like);
            $this->db->or_like('form_no',$like);
            $this->db->or_like('college_no',$like);
        endif;
//               $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id'); 
       return  $this->db->where($where)->get('student_record')->result();
    }
    public function get_Payment_Category($where=NULL){
                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id','left outer');
                $this->db->join('programes_info','sub_programes.programe_id=programes_info.programe_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=fee_payment_category.batch_id');
//                $this->db->order_by('pc_id','desc');
                $this->db->order_by('title','asc');
                 if($where):
                     $this->db->where($where);
                 endif;
        return  $this->db->get('fee_payment_category')->result();
    }
    
    public function program_dropDown($table, $option=NULL, $value,$show,$where=NULL)
	{
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where_not_in('programe_id',array(10,11));
                 $this->db->order_by($show,'asc');
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
        
        public function get_voucher_info($like=NULL){
                    $this->db->join('financial_year','financial_year.id=gl_amount_transition.gl_fy_id');    
                    if($like):
                        $this->db->like('gl_at_vocher',$like);
                    endif;
                    $this->db->order_by('gl_at_vocher','asc');
                    $this->db->order_by('financial_year.id','desc');
           return   $this->db->get_where('gl_amount_transition',array('vocher_status'=>2))->result();
        }
}
