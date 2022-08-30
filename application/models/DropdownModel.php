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
//                   $this->db->group_by($show);
                
                
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
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like('student_name',$like);
            $this->db->or_like('form_no',$like);
            $this->db->or_like('college_no',$like);
        endif;
               $this->db->join('hostel_student_record','student_record.student_id=hostel_student_record.student_id'); 
       return  $this->db->get('student_record')->result();
    }
    // Hostel student autocomplete    
    public function hostel_students($where,$like=NULL){
             if($like):
            $this->db->like('student_name',$like);
            $this->db->or_like('form_no',$like);
            $this->db->or_like('college_no',$like);
        endif;
               $this->db->join('hostel_student_record','student_record.student_id=hostel_student_record.student_id'); 
       return  $this->db->where($where)->get('student_record')->result();
    }
        public function add_extra_heads($where_in,$like=NULL){
             if($like):
            $this->db->like('student_name',$like);
            $this->db->or_like('form_no',$like);
            $this->db->or_like('college_no',$like);
        endif;
                   $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id'); 
                   $this->db->order_by('student_record.student_id','desc');
       return  $this->db->where_in('student_record.s_status_id',$where_in)->get('student_record')->result();
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
//                $this->db->where_not_in('programe_id',array(10,11));
                 $this->db->order_by('show_order','asc');
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
        
        public function get_voucher_info($like=NULL,$where=NULl){
            
                    $this->db->join('financial_year','financial_year.id=gl_amount_transition.gl_fy_id');    
                    if($like):
                        $this->db->like('gl_at_vocher',$like);
                    endif;
                    if($where):
                        $this->db->where($where);
                    endif;
                    $this->db->order_by('gl_at_vocher','asc');
                    $this->db->order_by('financial_year.id','desc');
//           return   $this->db->get_where('gl_amount_transition')->result();
           return   $this->db->get_where('gl_amount_transition',array('vocher_status'=>2))->result();
        }
        
    public function autocomplete_amount($table,$like=NULL,$where=NULL){
               $this->db->SELECT('*');
                   $this->db->FROM($table);
                   if($where):
                       $this->db->where($where);
                   endif;
                   
               if($like):
                   $this->db->like('fn_coa_mc_title',$like);
                   $this->db->or_like('fn_coa_mc_code',$like);   
               endif;

               $this->db->order_by('fn_coa_mc_code','asc');
               $this->db->limit(7,0);
                $query =$this->db->get();
               return $query->result();
      }
    
    public function bs_program_dropDown($table, $option=NULL, $value,$show,$where=NULL)
	{
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
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
    
    public function bs_subpro_dropDown($table, $option=NULL, $value,$show,$where=NULL)
	{
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where_in('programe_id',array(2,4,6,8,9,14));
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
    
    public function bs_sec_dropDown($table, $option=NULL, $value,$show,$where=NULL)
	{
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->join('programes_info','programes_info.programe_id=sections.program_id');
                $this->db->where('degree_type_id','2');
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
    
    public function bs_batch_dropDown($table, $option=NULL, $value,$show,$where=NULL)
	{
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where_in('programe_id',array(2,4,6,8,9,14));
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
        public function show_subjct_allottment_auto($like=NULL){
        
               
                if($like):
                    $this->db->like('subject.title',$like);
                endif;
                $this->db->order_by('subject.title','asc');
               $this->db->order_by('sub_programes.name','asc');
               $this->db->where('sub_programes.programe_id',1);
               $this->db->where_in('sub_programes.sub_pro_id',array(4,5,26,27));
               $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
        return $this->db->get_where('subject')->result();
    }
    public function employee_name_with_designation_auto($like=NULL){
       $this->db->select('
                hr_emp_record.emp_id as emp_id,
                hr_emp_record.emp_name as emp_name,
                hr_emp_designation.title as designation,
       '); 
            $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        if($like):
            $this->db->like('hr_emp_record.emp_name',$like);
        endif;
        $this->db->order_by('hr_emp_record.emp_name','asc');
    return $this->db->get('hr_emp_record')->result();
         
    }
     public function program_info_auto($like=Null){
        if($like):
           $this->db->like('programe_name',$like);
        endif;
       return $this->db->get_where('programes_info')->result();
    }
    public function sub_prgoram_auto($like=Null){
        if($like):
           $this->db->like('name',$like);
        endif;
        $this->db->order_by('name','asc');
       return $this->db->get_where('sub_programes')->result();
    }
    public function employee_name_with_designation_and_subjects_auto($like=NULL){
       $this->db->select('
            hr_emp_record.emp_id as emp_id,
            hr_emp_record.emp_name as emp_name,
            hr_emp_designation.title as designation,
            subject.title as subject_title,
       '); 
        
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('subject','subject.subject_id=hr_emp_record.subject_id');
        if($like):
        $this->db->like('hr_emp_record.emp_name',$like);
        endif;
        $this->db->order_by('hr_emp_record.emp_name','asc');
        $this->db->where(array('hr_emp_record.cat_id'=>1,'emp_status_id'=>1));
        return $this->db->get('hr_emp_record')->result();
         
    }
     public function student_transfer_to_record($like=Null){
        if($like):
           $this->db->like('fc_challan_id',$like);
        endif;
        $this->db->order_by('fc_challan_id','desc');
        $this->db->order_by('student_record.s_status_id','asc');
                $this->db->select(
                        '   fee_challan.fc_challan_id as challan_id,
                            student_record.college_no,
                            student_record.student_id,
                            student_record.student_name,
                            student_record.father_name,
                            student_status.name as studentStatus,
                            prospectus_batch.batch_name,
                            programes_info.programe_name as programe_name,
                            sub_programes.name as sub_proram,
                            programes_info.programe_name,
                        ');
                $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
                $this->db->where_in('student_record.s_status_id',array(1,5));
        return  $this->db->get_where('fee_challan',array('fc_ch_status_id'=>1,'challan_id_lock'=>0))->result();
    }
    public function hnd_alevel_dropDown($table, $option=NULL, $value,$show,$where=NULL){
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where_in('program_id',array(2,3,4,5,6,7,8,9,14));
//                 $this->db->where_in('program_id',array(3,5));
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
        
    public function getSections($where){

        $this->db->select('
            sections.sec_id as sec_id,
            sections.name as sectionName,
            prospectus_batch.batch_name
                ');
        $this->db->join('prospectus_batch', 'prospectus_batch.batch_id=sections.batch_id', 'left outer');

    return  $this->db->where($where)->get('sections')->result();
    }
    public function employee_designation_dropdown($value,$show){
    
               $this->db->select('emp_name,emp_id,hr_emp_designation.title,department.title as title_dep'); 
               $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation'); 
               $this->db->join('department','department.department_id=hr_emp_record.department_id');
               $this->db->order_by('emp_name');
               $this->db->order_by('department.title');
     $query =  $this->db->get_where('hr_emp_record',array('cat_id'=>1,'emp_status_id'=>1));
     
      foreach($query->result() as $row):
       
            $data[$row->$value] = $row->$show.'( '.$row->title.' , '.$row->title_dep.' )';
        endforeach;
       
        return $data;
    }
    public function dropDown_coa_chk_print($table, $option=NULL, $value,$show,$where=NULL){
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
//                 $this->db->order_by($show,'asc');
                $query = $this->db->get($table);
		if($query->num_rows() > 0){
                    if($option):
                        $data[''] = $option;
                    endif;
			foreach($query->result() as $row) {
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
        
	}
 
    public function test_type_dropdown($title, $value, $show, $user_id, $class_id){
     
//               $this->db->join('exam_types','exam_types.xt_id=exams_bs.exb_test_type', 'right outer');
//               $this->db->join('exams_bs','exams_bs.exb_test_type=exam_types.xt_id');
               $this->db->order_by('exam_types.xt_title','asc');
     $query =  $this->db->get('exam_types');
     
     $data[''] = $title;
      foreach($query->result() as $row):
          
          $check = $this->CRUDModel->get_where_row('exams_bs', array('exb_test_type'=>$row->xt_id, 'exb_user_id'=>$user_id, 'exb_class_id'=>$class_id));
          if(empty($check)):
              $data[$row->$value] = $row->$show;
          endif;
            
        endforeach;
       
        return $data;
    }
       public function bs_subject_alloted_teachers($where,$like=NULL){
         
            $this->db->select('
                    hr_emp_record.emp_name,
                    hr_emp_record.emp_id,
                    ');
            if($where):
                $this->db->where($where);
            endif;
            if($like):
                $this->db->like('hr_emp_record.emp_name',$like);
            endif;
                $this->db->join('class_alloted','class_alloted.emp_id=hr_emp_record.emp_id','left outer');
                $this->db->join('sections','sections.sec_id=class_alloted.sec_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=sections.program_id','left outer');
                $this->db->group_by('hr_emp_record.emp_id');
       return   $this->db->get('hr_emp_record')->result();
//       return  $this->db->get('hr_emp_record')->result();
    }
     public function bs_alloted_sections($where,$like=NULL){
         
            if($where):
                $this->db->where($where);
            endif;
            if($like):
                $this->db->like('sections.name',$like);
            endif;
                $this->db->join('programes_info','programes_info.programe_id=sections.program_id');
                $this->db->order_by('name','asc');
                $this->db->group_by('sections.sec_id');
       return   $this->db->get('sections')->result();
    }
     public function bs_alloted_subjects($where,$like=NULL){
         
            if($where):
                $this->db->where($where);
            endif;
            if($like):
                $this->db->like('subject.title',$like);
            endif;
                $this->db->join('programes_info','programes_info.programe_id=subject.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
                $this->db->order_by('subject.title','asc');
                $this->db->group_by('subject.subject_id');
       return   $this->db->get('subject')->result();
    }      
     public function get_sec_bs_exame_history($userId,$like=NULL){
        
         
        if($like):
            $this->db->like($like);  
        endif;
        
        $this->db->where(array(
                'sections.status'   => 'On',
                'degree_type_id'    => '2',
                'users.id'            => $userId
                ));
        $this->db->order_by('name','asc');
        $this->db->order_by('programes_info.programe_name','asc');
        $this->db->join('programes_info','programes_info.programe_id=sections.program_id');
        $this->db->join('class_alloted','class_alloted.sec_id=sections.sec_id');
        $this->db->join('users','users.user_empId=class_alloted.emp_id');
        return $this->db->get('sections')->result();
        
    }
     public function get_subj_bs_exame_history($userId,$like=NULL){
        if($like):
            $this->db->like($like);  
        endif;
        
        $this->db->where(array(
//                'sections.status'   => 'On',
                'degree_type_id'    => '2',
                'users.id'            => $userId
                ));
        $this->db->order_by('title','asc');
        $this->db->group_by('subject.subject_id');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
        $this->db->join('class_alloted','class_alloted.subject_id=subject.subject_id');
        $this->db->join('users','users.user_empId=class_alloted.emp_id');
        return $this->db->get('subject')->result();
        
    }
public function std_sec_allotment_alevel($table,$like=NULL){
            if($like):
                $this->db->like('college_no',$like);       
            endif;   
            $this->db->where('s_status_id',5);
            $this->db->where('flag',0);
            $this->db->where('student_record.programe_id',5);
            $query = $this->db->get($table);
        return $query->result();
        
    }
 public function group_allotment_inter($like=NULL){
        if($like):
            $this->db->like('college_no',$like);       
            $this->db->or_like('student_name',$like);       
        endif;   
        $this->db->where(array(
            's_status_id'=>5,
            'flag'=>0,
            'programe_id'=>1,
            ));
        
        return $this->db->get('student_record')->result();
        
        
    }    
}
