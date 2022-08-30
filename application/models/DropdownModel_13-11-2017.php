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
    public function hostel_students($where,$like=NULL){
        if($like):
            $this->db->like('student_name',$like);
            $this->db->or_like('form_no',$like);
            $this->db->or_like('college_no',$like);
        endif;
               $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id'); 
       return  $this->db->where($where)->get('hostel_student_record')->result();
    }
}
