<?php
class Get_model extends CI_Model{
    
      public function __construct()
    {
        parent::__construct();
        $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    
    public function lastschoolData($table,$like=NULL){
            $this->db->SELECT('student_id,last_school_address');
        $this->db->FROM($table);
        if($like):
        $this->db->like($like);
        endif;
        $this->db->group_by('student_record.last_school_address');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
    public function fee_clearnace_inter($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.college_no,
                student_record.student_name,
                student_record.applicant_image,
                gender.title as genderName,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as student_status,
                student_record.father_name,
                sections.name as section,
                ');
        
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.college_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where_in('student_record.s_status_id',array('5','9'));
            $this->db->where('student_record.programe_id','1');
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    
    public function print_student_group($table,$where)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->where($where);
        $this->db->where('student_record.s_status_id','5');
        $this->db->order_by('student_record.college_no','asc');
        $this->db->group_by('student_record.student_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_college_no_password($table,$where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.mobile_no,
                student_record.applicant_image,
                student_record.student_password,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as status,
                ');
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.student_id','desc');
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_college_passwordRow($table,$where=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.mobile_no,
                student_record.college_no,
                student_record.applicant_mob_no1,
                student_record.applicant_image,
                student_record.student_password,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as status,
                mobile_network.net_id,
                mobile_network.network,
                ');
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('mobile_network','mobile_network.net_id=student_record.net_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
   }
    
    public function new_stds_pagination($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.college_no as college_no,
                student_record.form_no as form_no,
                student_record.sub_pro_id as sub_id,
                student_record.s_status_id,
                student_record.applicant_image as applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer'); 
        $this->db->limit($SPP,$page);
        $this->db->where($where);
        $this->db->where('student_record.programe_id','1');
        $this->db->where('student_record.batch_id','62');
        if($order):
        $this->db->order_by($order['column'],$order['order']);    
        endif;   
            $query =  $this->db->get();
            return $query->result();
   }
    

    public function stds_hnd_pagination($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.form_no,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                sections.sec_id as sec_id,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer'); 
                $this->db->limit($SPP,$page);
                $this->db->where($where);
//                $this->db->where('student_record.programe_id','3');
                $this->db->order_by('student_record.college_no','asc');            
                if($order):
                    $this->db->order_by($order['column'],$order['order']);    
                endif;
            $query =      $this->db->get();
            return $query->result();
   }
    
    public function get_stdData($table,$where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.dob,
                student_record.board_regno,
                student_record.applicant_image,
                student_record.s_status_id,
                student_record.sub_pro_id as sub_id,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                shift.name as shift_name,
                student_status.name as status,
                applicant_edu_detail.percentage 
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id2', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('shift','shift.shift_id=student_record.shift_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->order_by('student_record.student_id','asc');
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    
public function student_status_change($field,$table,$where=NULL,$like=NULL)
    {
        $this->db->select($field);    
        $this->db->from($table);  
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        if($like):
             $this->db->like($like);
        endif;
        
        $this->db->group_by('student_record.student_id');
        $this->db->order_by('college_no','asc');
       // $this->db->where('student_record.s_status_id !=','9');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
public function student_status_change_fee($field,$table,$where=NULL,$like=NULL)
    {
        $this->db->select($field);    
        $this->db->from($table);  
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        if($like):
             $this->db->like($like);
        endif;
        
        $this->db->group_by('student_record.student_id');
        $this->db->order_by('college_no','asc');
        
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where_in('student_record.s_status_id',array('5','6','7','8','10','12','13','20'));
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
     public function get_student_statusdata($table,$where)
    {
     $query =  $this->db->select('student_record.*,prospectus_batch.*,programes_info.*,sub_programes.*,student_status.name as status, student_status.s_status_id')
        ->FROM($table)   
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer')
    ->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer')         
    ->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer')         
         ->where($where)
         ->get();
        if($query):
           return  $query->row();
        endif;
    }
    
    public function admin_stdData($SPP,$page,$order=NULL){
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                student_record.s_status_id as statusId,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                applicant_edu_detail.percentage 
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
                $this->db->limit($SPP,$page);
                if($order):
                $this->db->order_by($order['column'],$order['order']);    
                
                endif; 
            $this->db->group_by('student_record.student_id');
            $this->db->where('student_record.s_status_id',5);
            $query =  $this->db->get();
//            $this->db->where('s_status_id',5);
            if($query):
                return $query->result();
            endif;
   }
    
public function get_stdData1($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.college_no,
                student_record.student_name,
                student_record.applicant_image,
                gender.title as genderName,
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                applicant_edu_detail.percentage,
                prospectus_batch.batch_name as batch,
                student_status.name as student_status,
                student_record.father_name,
                ');
        
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
          //  $this->db->limit($custom['limit'],$custom['start']);
           $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('student_record.form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_admin_stdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.college_no,
                student_record.student_name,
                student_record.applicant_image,
                gender.title as genderName,
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as student_status,
                student_record.father_name,
                sections.name as section,
                ');
        
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_bs_stdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.college_no,
                student_record.student_name,
                student_record.father_name,
                student_record.applicant_image,
                gender.title as genderName,
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as student_status,
                student_record.father_name,
                sections.name as section,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.percentage,
                ');
        
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.college_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where_in('student_record.programe_id',array(2,6,8,9,14,17));
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_bs_stdData_excel($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.college_no,
                student_record.student_name,
                student_record.father_name,
                student_record.applicant_image,
                gender.title as genderName,
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                student_status.name as student_status,
                student_record.father_name,
                sections.name as section,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.percentage,
                ');
        
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.college_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where_in('student_record.programe_id',array(2,6,8,9,14,17));
            $this->db->group_by('student_record.student_id');
            $result = $this->db->get()->result();
        $return_arr = '';
        $serial = '';
        foreach($result as $rrow):
            $serial++;
            $return_arr[] = array(
                'serial_no'     => $serial,
                'form_no'       => $rrow->form_no,
                'college_no'    => $rrow->college_no,
                'student_name'  => $rrow->student_name,
                'father_name'   => $rrow->father_name,
                'sub_programe'  => $rrow->sub_program,
                'batch'         => $rrow->batch,
                'section'       => $rrow->section,
                'status'        => $rrow->student_status,
            );
        endforeach;
        return $return_arr;
   }
    
    public function get_hndstdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                sections.name as section,
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
           // $this->db->limit($custom['limit'],$custom['start']);
            $this->db->order_by('student_record.form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }    
    
    public function get_csstdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as student_status,
                ');
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_by_group_student($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                student_record.student_name as student,
                student_record.father_name as father,
                student_record.applicant_image as applicant_image,
                student_record.college_no as college_no,
                sections.name as section,
                gender.title as gender,
                sub_programes.name as sub_program,
                student_group_allotment.serial_no
                ');
        $this->db->FROM($table);
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;
            if($like):
                $this->db->like($like);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function search_student_group($table,$where=NULL,$like=NULL, $limit)
    {
        $this->db->SELECT('
            student_record.student_id,
            student_record.student_name,
            student_record.applicant_image,
            sub_programes.name as sub_program,
            programes_info.programe_name as program,
            prospectus_batch.batch_name as batch,
            gender.title as gender,
            student_record.father_name,      
            student_record.college_no,
            shift.name as shift_name
            ');
            $this->db->FROM($table);
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            $this->db->join('shift','shift.shift_id=student_record.shift_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        if($limit):
            $this->db->limit($limit,'1');
        endif;
       // $this->db->order_by('applicant_edu_detail.percentage','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
    public function search_student_group1($table,$where=NULL,$like=NULL, $limit)
    {
        $this->db->SELECT('
            student_record.student_id,
            student_record.student_name,
            student_record.applicant_image,
            sub_programes.name as sub_program,
            programes_info.programe_name as program,
            prospectus_batch.batch_name as batch,
            gender.title as gender,
            student_record.father_name,
            applicant_edu_detail.obtained_marks as omarks,
            applicant_edu_detail.total_marks as tmarks,
            applicant_edu_detail.percentage as percentage,
            
            ');
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        if($limit):
            $this->db->limit($limit,'1');
        endif;
        $this->db->order_by('applicant_edu_detail.percentage','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
public function search_group_student($table,$where=NULL,$like=NULL,$custom=NULL)
    {
        $this->db->SELECT('
            student_record.form_no,
            student_record.student_id,
            student_record.student_name,
            student_record.applicant_image,
            reserved_seat.name as seat,
            sub_programes.name as sub_program,
            programes_info.programe_name as program,
            applicant_edu_detail.percentage,
            prospectus_batch.batch_name as batch,
            student_status.name as student_status,
            student_record.father_name,
            ');
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        if($like):
            $this->db->like($like);
        endif;
        $this->db->order_by($custom['column'],$custom['order']);
        $this->db->order_by('student_record.form_no','asc');
        if($where):
            $this->db->where($where);
        endif;

        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
    public function getsection(){
       
            $this->db->SELECT('
                sections.sec_id,
                sections.name,
                sections.seats_allowed,
                sections.status,
                sub_programes.name as sub_program,
                programes_info.programe_name as program,
                prospectus_batch.batch_name as batch,
                ');
        $this->db->FROM('sections');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=sections.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=sections.program_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=sections.batch_id', 'left outer');
        $this->db->order_by('programes_info.programe_id','asc');
        $this->db->order_by('prospectus_batch.batch_id','desc');
        $this->db->order_by('sub_programes.sub_pro_id','asc');
        $this->db->order_by('sections.sec_id','asc');
        $this->db->order_by('sections.status','asc');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }

     public function pagination($SPP,$page,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_name as student,
                student_record.father_name as father,
                student_record.college_no as college_no,
                student_record.applicant_image as applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                gender.title as gender,
                sections.sec_id as sec_id,
                ');
        $this->db->FROM('student_group_allotment');
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
                $this->db->limit($SPP,$page);
                if($order):
                $this->db->order_by($order['column'],$order['order']);    
                endif;
           $query =      $this->db->get();
        return $query->result();
   }
    
    public function get_Export($table,$where=NULL,$like=NULL){
        $this->db->SELECT('
                student_record.college_no,
                student_record.form_no,
                student_record.student_name,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                reserved_seat.name as seat,
                sub_programes.name as sub_program,
                applicant_edu_detail.rollno,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.board_regno,
                shift.name as shift_name,
                sections.name as section,
                student_status.name as student_status,
                student_record.mobile_no as mobile_no,
                student_record.parmanent_address as parmanent_address,
                student_record.app_postal_address as postal_address,
                domicile.name as domicile,
                religion.title as religion,
                ');
                $this->db->from($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('shift','shift.shift_id=student_record.shift_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id2', 'left outer');     
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
        $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
        $this->db->join('religion','religion.religion_id=student_record.religion_id','left outer');  
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->order_by('applicant_edu_detail.obtained_marks','desc');
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get()->result();
            if($query):
                $return_array = '';
                $sn = '';
                foreach($query as $drow):
                    $sn++;
                   $return_array[] = array(
                       'SerialNo'       => $sn,
                       'college_no'     => $drow->college_no,
                       'form_no'        => $drow->form_no,
                       'student_name'   => $drow->student_name,
                       'father_name'    => $drow->father_name,
                       'genderName'     => $drow->genderName,
                       'seat'           => $drow->seat,
                       'sub_program'    => $drow->sub_program,
                       'total_marks'    => $drow->total_marks,
                       'obtained_marks' => $drow->obtained_marks,
                       'percentage'     => $drow->percentage,
                       'board_regno'   => $drow->board_regno,
                       'shift_name'     => $drow->shift_name,
                       'section'        => $drow->section,
                       'student_status' => $drow->student_status,
                       'mobile_no'      => $drow->mobile_no,
                       'parmanent_address' => $drow->parmanent_address,
                       'postal_address' => $drow->postal_address,
                       'domicile'       => $drow->domicile,
                       'religion'       => $drow->religion,
                       'rollno'       => $drow->rollno,
                   ); 
                endforeach;
                return $return_array;
            endif;
               
   }
    
    
    public function stds_pagination($SPP,$page,$where){
         $this->db->SELECT('
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.board_regno,
                student_record.form_no,
                student_record.applicant_image,
                student_record.sub_pro_id as sub_id,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_record.dob,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer'); 
        $this->db->limit($SPP,$page);
        $this->db->where($where);
        $this->db->order_by('student_record.student_id','desc');       
        $query =      $this->db->get();
        return $query->result();
   }
   
public function stds_arts_pagination($SPP,$page,$where,$order=NULL){
             $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.college_no as college_no,
                student_record.applicant_image as applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                sections.sec_id as sec_id,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer'); 
                $this->db->limit($SPP,$page);
                $this->db->where($where);
 
                if($order):
                $this->db->order_by('student_record.college_no','asc');
     
                endif;   
            $query =      $this->db->get();
            return $query->result();
 
   }
  
   
      public function get_artsstdData($table,$where=NULL,$like=NULL,$custom=NULL){
           
        
        $fields = ' student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                applicant_edu_detail.percentage ';
        
        $this->db->SELECT($fields);
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
         
            $this->db->order_by('student_record.college_no','asc');
            if($where):
                $this->db->where($where);
                
            endif;
 
            return $this->db->get()->result();
           
           
   }
    
public function get_where_pagination($table){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->get();
            return $query->result();
   }  
    
    public function get_where_data($table, $where)
    {
        $this->db->where($where);
        $query = $this->db->get($table);
    }
    
    public function stds_arabic_pagin($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.comment as comment,
                student_record.form_no as form_no,
                student_record.applicant_image as applicant_image,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->limit($SPP,$page);
        $this->db->where($where);
        $this->db->where('student_record.programe_id','15');
        $this->db->order_by('student_record.student_id','desc');            
        if($order):
            $this->db->order_by($order['column'],$order['order']);    
        endif;
        $query = $this->db->get();
        return $query->result();
   }
    
    public function student_edu_record($where){
        $query = $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            board_university.title as bordTitle,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.inserteduser,
            applicant_edu_detail.timestamp,
            applicant_edu_detail.cgpa,
            applicant_edu_detail.lat_marks,
            grade.grade_name as grade,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.percentage,
        ')
     ->from('applicant_edu_detail')
     ->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer')  
     ->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer')
     ->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer')  
     ->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer')   
     ->where($where)
     ->get();
        return $query->result();
    }
    
    public function profileStudent($where)
    {
       $query = $this->db->select('
            student_record.student_id,
            student_record.applicant_image,
            student_record.student_name,
            student_record.father_name,
            student_record.form_no,
            student_record.comment,
            student_record.college_no,
            student_record.board_regno,
            student_record.uni_regno,
            student_record.fata_school,
            student_record.shift_id,
            student_record.student_cnic,
            student_record.father_cnic,
            student_record.dob,
            student_record.place_of_birth,
            student_record.hostel_required,
            student_record.hostel_applied,
            student_record.land_line_no,
            student_record.mobile_no,
            student_record.mobile_no2,
            student_record.annual_income,
            student_record.app_postal_address,
            student_record.parmanent_address,
            student_record.last_school_address,
            student_record.father_email,
            student_record.guardian_name,
            student_record.guardian_cnic,
            student_record.g_annual_income,
            student_record.g_land_no,
            student_record.g_mobile_no,
            student_record.g_postal_address,
            student_record.g_email,
            student_record.emargency_person_name,
            student_record.e_person_relation,
            student_record.e_person_contact1,
            student_record.e_person_contact2,
            student_record.bank_receipt_no,
            student_record.admission_date,
            student_record.admission_comment,
            student_record.bu_number,
            student_record.remarks,
            student_record.remarks2,
            student_record.applicant_image,
            student_record.father_image,
            student_record.guardian_occupation,
            student_record.e_person_relation,
            student_record.student_email,
            student_record.std_mobile_network,
            student_record.sub_pro_id as subpro_id,
            prospectus_batch.batch_name as batch,
            programes_info.programe_name as program,
            sub_programes.name as sub_program,
            reserved_seat.name as seat,
            reserved_seat.rseat_id as rseat_id,
            student_record.rseats_id1 as rseats_id1,
            student_record.rseats_id3,
            student_record.rseats_id2,
            blood_group.title as blood,
            gender.title as genderTitle,
            district.name as district,
            domicile.name as domicile,
            country.name as country,
            religion.title as religion,
            marital_status.title as marital,
            occupation.title as occupation,
            relation.title as relation,
            physical_status.title as physical_status,
            student_status.name as student_status,
            student_record.user_id,
            student_record.timestamp,
            student_migration_status.migration_status as migration_status,
            student_record.migrated_remarks,
            student_record.applicant_mob_no1,
            student_record.bs_enrollment_no,
            student_record.applicant_mob_no2,
            mobile_network.network as mobileNetwork,
            shift.name as shift_name,
        ')
                ->from('student_record')
                ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer')  
                ->join('mobile_network','mobile_network.net_id=student_record.net_id','left outer')  
                ->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer')  
                ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
                ->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id2','left outer')
                ->join('gender','gender.gender_id=student_record.gender_id','left outer')
                ->join('district','district.district_id=student_record.district_id','left outer')
                ->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer')
                ->join('country','country.country_id=student_record.country_id','left outer')
                ->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer')
                ->join('religion','religion.religion_id=student_record.religion_id','left outer')
                ->join('marital_status','marital_status.marital_status_id=student_record.marital_id','left outer')
                ->join('occupation','occupation.occ_id=student_record.occ_id','left outer')
                ->join('relation','relation.relation_id=student_record.relation_with_guardian','left outer')
                ->join('physical_status','physical_status.ps_id=student_record.physical_status_id','left outer')
                ->join('shift','shift.shift_id=student_record.shift_id','left outer')
                ->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer')
                ->join('student_migration_status','student_migration_status.id=student_record.migration_status','left outer')
                 ->where($where)
                 ->get();
        return $query->result();  
    }
    
    public function delete_std($id)
	{
		$qry = $this->db->where('student_id',$id);
		$this->db->delete('student_record');
	}
    
    public function delete_academic($id)
	{
		$qry = $this->db->where('serial_no',$id);
		$this->db->delete('applicant_edu_detail');
	}
    
    public function studentData($id)
	{
		$this->db->select()->from('student_record')->where('student_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatestudent($data,$id)
	{
		$this->db->where('student_id',$id);
		$this->db->update('student_record', $data);
	}
    
    public function instituteData($id)
	{
		$this->db->select()->from('institute')->where('inst_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updateinstitute($data,$id)
	{
		$this->db->where('inst_id',$id);
		$this->db->update('institute', $data);
	}
    
    public function seatData($id)
	{
		$this->db->select()->from('reserved_seat')->where('rseat_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updateseat($data,$id)
	{
		$this->db->where('rseat_id',$id);
		$this->db->update('reserved_seat', $data);
	}
    
    public function seatdetailData($id)
	{
		$this->db->select()->from('reserved_seats_details')->where('serial_no', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updateseatdetail($data,$id)
	{
		$this->db->where('serial_no',$id);
		$this->db->update('reserved_seats_details', $data);
	}
    
    public function sectionData($table,$where)
	{
		$this->db->select('sections.*,prospectus_batch.batch_name,prospectus_batch.batch_id,programes_info.programe_id,programes_info.programe_name,sub_programes.name as sub_program,sub_programes.sub_pro_id');
        $this->db->from($table);
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=sections.batch_id','left outer');
        $this->db->join('programes_info','programes_info.programe_id=sections.program_id','left outer');  
        $this->db->join('sub_programes','sub_programes.sub_pro_id=sections.sub_pro_id','left outer');
        $this->db->where($where);
		$dq = $this->db->get();
		return $dq->row();
	}
    
    public function p_saleData($id)
	{
		$this->db->select()->from('prospectus_sale')->where('serial_no', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatep_sale($data,$id)
	{
		$this->db->where('serial_no',$id);
		$this->db->update('prospectus_sale', $data);
	}
    
    public function p_batchData($id)
	{
		$this->db->select()->from('prospectus_batch')->where('batch_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatep_batch($data,$id)
	{
		$this->db->where('batch_id',$id);
		$this->db->update('prospectus_batch', $data);
	}
    
    public function s_statusData($id)
	{
		$this->db->select()->from('student_status')->where('s_status_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updates_status($data,$id)
	{
		$this->db->where('s_status_id',$id);
		$this->db->update('student_status', $data);
	}
    
    public function shiftData($id)
	{
		$this->db->select()->from('shift')->where('shift_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updateshift($data,$id)
	{
		$this->db->where('shift_id',$id);
		$this->db->update('shift', $data);
	}
    
    public function religionData($id)
	{
		$this->db->select()->from('religion')->where('religion_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatereligion($data,$id)
	{
		$this->db->where('religion_id',$id);
		$this->db->update('religion', $data);
	}
    
    public function programeData($id)
	{
		$this->db->select()->from('programes_info')->where('programe_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updateprograme($data,$id)
	{
		$this->db->where('programe_id',$id);
		$this->db->update('programes_info', $data);
	}
    
    public function sub_programeData($id)
	{
		$this->db->select()->from('sub_programes')->where('sub_pro_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatesub_programe($data,$id)
	{
		$this->db->where('sub_pro_id',$id);
		$this->db->update('sub_programes', $data);
	}
    
    public function degreeData($id)
	{
		$this->db->select()->from('degree')->where('degree_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatedegree($data,$id)
	{
		$this->db->where('degree_id',$id);
		$this->db->update('degree', $data);
	}
    
    public function subjectData($id)
	{
		$this->db->select()->from('subject')->where('subject_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatesubject($data,$id)
	{
		$this->db->where('subject_id',$id);
		$this->db->update('subject', $data);
	}
    
    public function academicData($id)
	{
		$this->db->select()->from('applicant_edu_detail')->where('serial_no', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updateacademic($data,$id)
	{
		$this->db->where('serial_no',$id);
		$this->db->update('applicant_edu_detail', $data);
	}
    
    public function physical_statusData($id)
	{
		$this->db->select()->from('physical_status')->where('ps_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function upload_spic($data,$id)
	{
		$query =  $this->db->query("select * from `student_record` where `student_id` = '$id'");
		foreach($query->result() as $rec)
		{
			$pic = $rec->applicant_image;
			if($pic != '')
			{
				unlink('assets/images/students/'.$pic);
			}
		}
		
		$this->db->where('student_id',$id);
		$this->db->update('student_record', $data);
		
	}
    
    public function upload_fpic($data,$id)
	{
		$query =  $this->db->query("select * from `student_record` where `student_id` = '$id'");
		foreach($query->result() as $rec)
		{
			$pic = $rec->picture;
			if($pic != '')
			{
				unlink('images/fathers/'.$pic);
			}
		}
		
		$this->db->where('student_id',$id);
		$this->db->update('student_record', $data);
		
	}
    
    public function updatephysical_status($data,$id)
	{
		$this->db->where('ps_id',$id);
		$this->db->update('physical_status', $data);
	}
    
    public function relationData($id)
	{
		$this->db->select()->from('relation')->where('relation_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updaterelation($data,$id)
	{
		$this->db->where('relation_id',$id);
		$this->db->update('relation', $data);
	}
    
    public function occupationData($id)
	{
		$this->db->select()->from('occupation')->where('occ_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updateoccupation($data,$id)
	{
		$this->db->where('occ_id',$id);
		$this->db->update('occupation', $data);
	}
    
    public function districtData($id)
	{
		$this->db->select()->from('district')->where('district_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatedistrict($data,$id)
	{
		$this->db->where('district_id',$id);
		$this->db->update('district', $data);
	}
    
    public function domicileData($id)
	{
		$this->db->select()->from('domicile')->where('domicile_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatedomicile($data,$id)
	{
		$this->db->where('domicile_id',$id);
		$this->db->update('domicile', $data);
	}
    
    public function countryData($id)
	{
		$this->db->select()->from('country')->where('country_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatecountry($data,$id)
	{
		$this->db->where('country_id',$id);
		$this->db->update('country', $data);
	}
    
    public function degree_typeData($id)
	{
		$this->db->select()->from('degree_type')->where('degree_type_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatedegree_type($data,$id)
	{
		$this->db->where('degree_type_id',$id);
		$this->db->update('degree_type', $data);
	}
    
    public function buData($id)
	{
		$this->db->select()->from('board_university')->where('bu_id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updatebu($data,$id)
	{
		$this->db->where('bu_id',$id);
		$this->db->update('board_university', $data);
	}
 
    public function getuser()
    {
        $this->db->order_by("id", "desc");
        $pro = $this->db->get("users");
        return $pro->result();
    }
    
     public function userData($id)
	{
		$this->db->select()->from('users')->where('id', $id);
		$dq = $this->db->get();
		return $dq->result();
	}
    
    public function updateUser($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('users', $data);
	}
    public function get_by_id($table,$id){
    $query = $this->db->select('*')
            ->from($table)
            ->where($id)
            ->get();
      return $query->result();
    }
    public function get_by_id_withPro($table,$id){
    $query = $this->db->select('*')
            ->from($table)
            ->join('programes_info','sub_programes.programe_id=programes_info.programe_id')
            ->where($id)
            ->get();
      return $query->row();
    }
    
    public function get_by_id_User($table,$where_id){
    $query = $this->db->select('users.*,hr_emp_record.emp_name')
            ->from($table)
            ->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId')
            ->where($where_id)
            ->get();
      return $query->row();
    }
    
  public function get_count_pagination($table,$where){
    
            
   $this->db->select('*');
           
             $this->db->FROM('student_record');
            $this->db->where_in(
            'student_record.sub_pro_id','5',
            'student_record.sub_pro_id','27'
            );
          
             return $this->db->get()->result();
    
    
 }
    
    public function get_degreestdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                sections.name as section,
                ');
        $this->db->FROM($table);
$this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function degree_stds_pagination($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.college_no as college_no,
                student_record.applicant_image as applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                sections.sec_id as sec_id,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer'); 
                $this->db->limit($SPP,$page);
                $this->db->where($where);
        $this->db->order_by('student_record.college_no','asc');            
    if($order):
                $this->db->order_by($order['column'],$order['order']);    
                endif;
            $query =      $this->db->get();
            return $query->result();
   }
    
    public function get_degree_stdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as student_status,
                sections.name as section,
                ');
        $this->db->FROM($table);
$this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
           // $this->db->limit($custom['limit'],$custom['start']);
            $this->db->order_by('student_record.form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
        public function dropDown_yearHead($table, $option, $value,$show,$where=NULL){
		$this->db->select('*');
                 $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id');
                if($where):
                    $this->db->where($where);
                endif;
            
                $query = $this->db->get($table);
		 
		if($query->num_rows() > 0) 
		{
			$data[''] = $option;
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show.'?'.$row->name;
			}
			return $data;
		}
	}
        
        public function greenFile($SPP,$page,$order=NULL){
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                applicant_edu_detail.percentage 
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            $this->db->limit($SPP,$page);
            if($order):
            $this->db->order_by($order['column'],$order['order']);    
            endif;
            $this->db->where('student_record.s_status_id','9');
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
   
   public function student_edu_record_limit($where){
         $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            degree.degree_id as degree_id,
            grade.grade_name as grade_name,
            grade.grade_id as grade_id,
            student_character.char_name as character,
            board_university.title as boardTitle,
            board_university.bu_id as bu_id,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.cgpa,
            applicant_edu_detail.rollno,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.percentage,
        ');
                 $this->db->from('applicant_edu_detail');
                 $this->db->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer');  
                 $this->db->join('student_character','student_character.char_id=student_record.char_id','left outer');  
                 $this->db->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer');  
                 $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
                 $this->db->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer');   
             //    $this->db->limit(1);
                 $this->db->where($where);
                 $q = $this->db->get();
                return $q->result();
    }
   public function student_edu_record_limit_record($where){
         $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            degree.degree_id as degree_id,
            grade.grade_name as grade_name,
            grade.grade_id as grade_id,
            student_character.char_name as character,
            board_university.title as boardTitle,
            board_university.bu_id as bu_id,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.cgpa,
            applicant_edu_detail.rollno,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.percentage,
        ');
                 $this->db->from('applicant_edu_detail');
                 $this->db->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer');  
                 $this->db->join('student_character','student_character.char_id=student_record.char_id','left outer');  
                 $this->db->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer');  
                 $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
                 $this->db->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer');   
                 $this->db->order_by('applicant_edu_detail.serial_no','asc');
                 $this->db->limit(1);
                 $this->db->where($where);
                 $q = $this->db->get();
                return $q->result();
    }
    
    public function student_edu_record1($where)
    {
         $this->db->select('
            applicant_edu_detail.serial_no,
            student_record.student_name,
            degree.title as Degreetitle,
            board_university.title as bordTitle,
            grade.grade_name as grade,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.cgpa,
            applicant_edu_detail.rollno,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.percentage,
            sub_programes.name as sub_program
        ');
         $this->db->from('applicant_edu_detail');
         $this->db->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer');  
         $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
         $this->db->join('grade','grade.grade_id=applicant_edu_detail.grade_id','left outer');
         $this->db->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=applicant_edu_detail.sub_pro_id','left outer');    
             //    $this->db->limit(10,1);
                 $this->db->where($where);
                 $q = $this->db->get();
                return $q->result();
    }
    
   public function get_edu_log($where)
    {
       $query = $this->db->select
        ('
            applicant_edu_detail_logs.*,
            applicant_edu_detail.inst_id,
        ')
    ->from('applicant_edu_detail_logs')
->join('applicant_edu_detail','applicant_edu_detail.serial_no=applicant_edu_detail_logs.edu_id','left outer')
    
    ->where($where)
     ->get();
        return $query->result();  
    }
    
//    public function student_edu_record($where){
//        $query = $this->db->select('
//            applicant_edu_detail.serial_no,
//            student_record.student_name,
//            student_record.student_id,
//            degree.title as Degreetitle,
//            board_university.title as bordTitle,
//            applicant_edu_detail.year_of_passing,
//            applicant_edu_detail.total_marks,
//            applicant_edu_detail.obtained_marks,
//            applicant_edu_detail.cgpa,
//            applicant_edu_detail.exam_type,
//            applicant_edu_detail.inst_id,
//            applicant_edu_detail.percentage,
//        ')
//                 ->from('applicant_edu_detail')
//                 ->join('student_record','student_record.student_id=applicant_edu_detail.student_id','left outer')  
//                 ->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer')  
//                 ->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer')   
//                 ->where($where)
//                 ->get();
//        return $query->result();
//    }
    
    
    public function get_logData($table,$where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                ');
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $query = $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function view_student_group($table,$where)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->where($where);
        $this->db->where('student_record.s_status_id','5');
        $this->db->order_by('student_record.college_no','asc');
        $this->db->group_by('student_record.student_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getstudent_assign_group($where)
    {
        $this->db->select('*'); 
        $this->db->FROM('student_group_allotment_demo');
        $this->db->join('student_record','student_record.student_id=student_group_allotment_demo.student_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $this->db->order_by('student_group_allotment_demo.serial_no','desc');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function student_curr_record($where)
    {
    $query = $this->db->select('
        student_record.student_id,
        student_record.student_name,
        student_record.father_name,
        student_record.form_no,  
        student_record.college_no,  
        sub_programes.name as sub_program,
        reserved_seat.name as seat,
        student_record.mobile_no,
        student_record.mobile_no2,
        student_record.timestamp,
        prospectus_batch.batch_name as batch,
        domicile.name as domicile,
        student_record.user_id
    ')
    ->from('student_record')
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer')  
    ->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer')  
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
    ->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer')
    ->join('gender','gender.gender_id=student_record.gender_id','left outer')
    ->join('district','district.district_id=student_record.district_id','left outer')
    ->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer')
    ->join('country','country.country_id=student_record.country_id','left outer')
    ->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer')
    ->join('religion','religion.religion_id=student_record.religion_id','left outer')
    ->join('marital_status','marital_status.marital_status_id=student_record.marital_id','left outer')
    ->join('occupation','occupation.occ_id=student_record.occ_id','left outer')
    ->join('relation','relation.relation_id=student_record.relation_with_guardian','left outer')
    ->join('physical_status','physical_status.ps_id=student_record.physical_status_id','left outer')
    ->join('shift','shift.shift_id=student_record.shift_id','left outer')
    ->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer')  
    ->where($where)
     ->get();
        return $query->row();
    }
    
    public function get_log($where)
    {
       $query = $this->db->select
        ('
            student_record_logs.*,
            prospectus_batch.batch_name as batch,
            programes_info.programe_name as program,
            sub_programes.name as sub_program,
            domicile.name as domicile,
            reserved_seat.name as seat,
            hr_emp_record.emp_name,
        ')
    ->from('student_record_logs')
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record_logs.batch_id','left outer')  
    ->join('programes_info','programes_info.programe_id=student_record_logs.programe_id','left outer')  
    ->join('domicile','domicile.domicile_id=student_record_logs.domicile_id','left outer')  
    ->join('sub_programes','sub_programes.sub_pro_id=student_record_logs.sub_pro_id','left outer')
    ->join('reserved_seat','reserved_seat.rseat_id=student_record_logs.rseats_id','left outer')
    ->join('hr_emp_record','hr_emp_record.emp_id=student_record_logs.user_id','left outer')
    ->where($where)
    ->order_by('student_record_logs.serial_no','desc')       
    ->get();
    return $query->result();  
    }
    
     public function migratedDataSearch($table,$where=NULL)
    {
        $this->db->SELECT('
       student_migration.*,
       student_status.*,
       board_university.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=student_migration.student_id','left outer');
    $this->db->join('board_university','board_university.bu_id=student_migration.migrated_board','left outer');
    $this->db->join('student_status','student_status.s_status_id=student_migration.s_status_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_migratedData($table)
    {
        $this->db->SELECT('
       student_migration.*,
       student_status.*,
       board_university.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=student_migration.student_id','left outer');
    $this->db->join('board_university','board_university.bu_id=student_migration.migrated_board','left outer');
    $this->db->join('student_status','student_status.s_status_id=student_migration.s_status_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getmigrated_Std($table,$where)
    {
        $this->db->SELECT('
       student_migration.*,
       student_status.*,
       board_university.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=student_migration.student_id','left outer');
    $this->db->join('board_university','board_university.bu_id=student_migration.migrated_board','left outer');
    $this->db->join('student_status','student_status.s_status_id=student_migration.s_status_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_migrated_stdData($table,$where=NULL,$like=NULL){
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                applicant_edu_detail.percentage 
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.programe_id','1');
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function getstudents_grade($where1)
    {
        $this->db->select('*'); 
        $this->db->FROM('student_grades');
 $this->db->join('student_record','student_record.student_id=student_grades.student_id','left outer');
        $this->db->join('subjects_olevel','subjects_olevel.ol_subject_id=student_grades.ol_subject_id','left outer');
        $this->db->join('grade','grade.grade_id=student_grades.grade_id','left outer');
        $this->db->where($where1);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    function batch_dropDown($table, $option=NULL, $value,$show,$where=NULL)
	{
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where_in('programe_id',array(3,6,7));
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
    
    function degree_dropDown_section($table, $option=NULL, $value,$show,$where=NULL)
	{
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where_in('program_id',array(4,8));
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
    
    function degree_dropDown($table, $option=NULL, $value,$show,$where=NULL)
	{
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where_in('programe_id',array(4,8));
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
    
    public function getstudent_prac_assign_group($where)
    {
        $this->db->select('*'); 
        $this->db->FROM('student_prac_group_allottment_demo');
        $this->db->join('student_record','student_record.student_id=student_prac_group_allottment_demo.student_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_degree_migrated_stdData($table,$where=NULL,$like=NULL){
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                applicant_edu_detail.percentage 
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.programe_id','4');
            $this->db->group_by('student_record.student_id');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function degree_get_migratedData($table)
    {
        $this->db->SELECT('
       student_migration.*,
       student_status.*,
       board_university.*,
       student_record.student_name,           
       student_record.programe_id,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=student_migration.student_id','left outer');
    $this->db->join('board_university','board_university.bu_id=student_migration.migrated_board','left outer');
    $this->db->join('student_status','student_status.s_status_id=student_migration.s_status_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
    $this->db->where('student_record.programe_id','4');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function degree_migratedDataSearch($table,$where=NULL)
    {
        $this->db->SELECT('
       student_migration.*,
       student_status.*,
       board_university.*,
       student_record.student_name,
       student_record.programe_id,          
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=student_migration.student_id','left outer');
    $this->db->join('board_university','board_university.bu_id=student_migration.migrated_board','left outer');
    $this->db->join('student_status','student_status.s_status_id=student_migration.s_status_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
    $this->db->where('student_record.programe_id','4');    
    if($where):
        $this->db->where($where);
    endif;
    $query =  $this->db->get();
    if($query):
        return $query->result();
    endif;
    }
    
    public function search_degree_student_group($table,$where=NULL,$like=NULL, $limit)
    {
        $this->db->SELECT('
            student_record.student_id,
            student_record.student_name,
            student_record.applicant_image,
            sub_programes.name as sub_program,
            programes_info.programe_name as program,
            prospectus_batch.batch_name as batch,
            gender.title as gender,
            student_record.father_name,      
            student_record.college_no,      
            ');
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        if($limit):
            $this->db->limit($limit,'1');
        endif;
        $this->db->where('student_record.programe_id','4');
        $this->db->where('student_record.flag','0');
        $this->db->where('student_record.s_status_id','5');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }
    
public function get_by_group_degree_student($table,$where=NULL,$like=NULL)
    {
        $this->db->SELECT('
        student_record.student_name as student,
        student_record.father_name as father,
        student_record.applicant_image as applicant_image,
        student_record.college_no as college_no,
        sections.name as section,
        gender.title as gender,
        sub_programes.name as sub_program,
        student_group_allotment.serial_no
        ');
        $this->db->FROM($table);
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.programe_id','4');
            $this->db->where('student_record.s_status_id','5');
            if($like):
                $this->db->like($like);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_meritlistExport($fields,$table,$where=NULL,$like=NULL,$custom=NULL){
        $this->db->SELECT($fields);
                $this->db->from($table);
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ; 
                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ;  
                $this->db->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer') ;  
            
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('applicant_edu_detail.percentage','desc');
            $this->db->group_by('student_record.student_id');
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result_array();
            endif;      
   }
    
    public function a_level_subject_allot($where=NULL,$like=NULL){
             $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.college_no as college_no,
                student_record.applicant_image as applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                sections.sec_id as sec_id,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer'); 
        $this->db->where('student_record.programe_id','5');
        $this->db->where('student_record.s_status_id','5');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $query = $this->db->get();
        return $query->result();
 
   }
    
    public function get_lawstdData($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                sections.name as section,
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->order_by('student_record.college_no','asc');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function stds_law_pagination($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.college_no as college_no,
                student_record.applicant_image as applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                sections.sec_id as sec_id,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer'); 
        $this->db->limit($SPP,$page);
        $this->db->where($where);
       // $this->db->where('student_record.s_status_id','5');
        $this->db->where('student_record.programe_id','9');
        $this->db->order_by('student_record.college_no','asc');            
        if($order):
            $this->db->order_by($order['column'],$order['order']);    
        endif;
        $query = $this->db->get();
        return $query->result();
   }
    
    public function stds_economics_pagination($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.college_no as college_no,
                student_record.applicant_image as applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                sections.sec_id as sec_id,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer'); 
        $this->db->limit($SPP,$page);
        $this->db->where($where);
       // $this->db->where('student_record.s_status_id','5');
        $this->db->where('student_record.programe_id','14');
        $this->db->order_by('student_record.college_no','asc');            
        if($order):
            $this->db->order_by($order['column'],$order['order']);    
        endif;
        $query = $this->db->get();
        return $query->result();
   }
    
   public function get_Studentgroup_row($table,$where)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_student_flagData($table,$where)
    {
     $query =  $this->db->select('student_record.*,prospectus_batch.batch_name,programes_info.programe_name,sub_programes.name,student_status.name as status')
        ->FROM($table)   
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer')
    ->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer')         
    ->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer')
    ->where($where)
    ->get();
    if($query):
        return  $query->row();
    endif;
    }

public function get_student_group_row($table,$where)
    {
     $query =  $this->db->select('student_record.student_name,student_record.student_id,sections.name,student_group_allotment.*')
        ->FROM($table)   
    ->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer')
    ->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer')
    ->where($where)
    ->get();
    if($query):
        return  $query->result();
    endif;
    }

public function get_statusData($table,$where)
    {
     $query = $this->db->select('student_record.student_name,student_status.name,student_status_detail.*,hr_emp_record.emp_name')
    ->FROM($table)   
    ->join('student_record','student_record.student_id=student_status_detail.student_id', 'left outer')
    ->join('student_status','student_status.s_status_id=student_status_detail.changed_status', 'left outer')
    ->join('users','users.id=student_status_detail.user_id', 'left outer')
    ->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId')     
    ->where($where)
    ->get();
    if($query):
        return  $query->result();
    endif;
    }
    
    public function get_langstdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.comment,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.student_id','desc');
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }  
    
    public function stds_lang_pagination($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.comment as comment,
                student_record.form_no as form_no,
                student_record.applicant_image as applicant_image,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->limit($SPP,$page);
        $this->db->where($where);
        $this->db->where('student_record.programe_id','10');
        $this->db->order_by('student_record.student_id','desc');            
        if($order):
            $this->db->order_by($order['column'],$order['order']);    
        endif;
        $query = $this->db->get();
        return $query->result();
   }
    
    public function stds_english_pagin($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.comment as comment,
                student_record.form_no as form_no,
                student_record.applicant_image as applicant_image,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->limit($SPP,$page);
        $this->db->where($where);
        $this->db->where('student_record.programe_id','13');
        $this->db->order_by('student_record.student_id','desc');            
        if($order):
            $this->db->order_by($order['column'],$order['order']);    
        endif;
        $query = $this->db->get();
        return $query->result();
   }
    
    public function get_meritlistlanguage($table,$where=NULL,$like=NULL,$custom=NULL){
        $this->db->SELECT(' 
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                prospectus_batch.batch_name,
                student_record.comment,
                student_record.hostel_required,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.admission_comment,
                reserved_seat.name as reservedName,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                religion.title as religion,
                student_record.parmanent_address as Address,
                blood_group.title,
                student_status_lang.name as lang_status,
                ');
                $this->db->from($table);
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer'); 
                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ;  
                $this->db->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer'); 
                $this->db->join('student_status_lang','student_status_lang.lang_status_id=student_record.lang_status_id','left outer');  
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->group_by('student_record.student_id');
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result_array();
            endif;        
   }
    
    public function getBatches($table)
    {
        $this->db->SELECT('prospectus_batch.*,programes_info.programe_name,sub_programes.name');
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=prospectus_batch.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=prospectus_batch.lang_spro_id', 'left outer');
        $this->db->order_by('programes_info.programe_id','asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function stds_german_pagination($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.college_no as college_no,
                student_record.comment as comment,
                student_record.form_no as form_no,
                student_record.applicant_image as applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                sections.sec_id as sec_id,
                student_status.name as status,
                student_status_lang.name as lang_status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status_lang','student_status_lang.lang_status_id=student_record.lang_status_id', 'left outer');
        $this->db->limit($SPP,$page);
        $this->db->where($where);
        $this->db->where('student_record.programe_id','11');
        $this->db->order_by('student_record.student_id','desc');            
        if($order):
            $this->db->order_by($order['column'],$order['order']);    
        endif;
        $query = $this->db->get();
        return $query->result();
   }
    
    public function get_germanstdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.comment,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                sections.name as section,
                student_status_lang.name as lang_status,
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('student_status_lang','student_status_lang.lang_status_id=student_record.lang_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.student_id','desc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.programe_id','11');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function stds_bs_eng_pagination($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.college_no as college_no,
                student_record.applicant_image as applicant_image,
                sections.name as section,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                sections.sec_id as sec_id,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer'); 
        $this->db->limit($SPP,$page);
        $this->db->where($where);
        $this->db->where('student_record.programe_id','8');
        $this->db->order_by('student_record.college_no','asc');            
        if($order):
            $this->db->order_by($order['column'],$order['order']);    
        endif;
        $query = $this->db->get();
        return $query->result();
   }
    
    public function get_bsEngstdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                sections.name as section,
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.programe_id','8');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_pashtostdData($table,$where=NULL,$like=NULL,$custom=NULL){
       
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.comment,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                ');
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by('student_record.student_id','desc');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.programe_id','12');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   } 
    
    public function stds_pashto_pagination($SPP,$page,$where,$order=NULL){
         $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.student_id as student_id,
                student_record.student_name as student_name,
                student_record.father_name as father_name,
                student_record.comment as comment,
                student_record.form_no as form_no,
                student_record.applicant_image as applicant_image,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->limit($SPP,$page);
        $this->db->where($where);
        $this->db->where('student_record.programe_id','12');
        $this->db->order_by('student_record.student_id','desc');            
        if($order):
            $this->db->order_by($order['column'],$order['order']);    
        endif;
        $query = $this->db->get();
        return $query->result();
   }
    
    public function bs_program_data($field,$table,$where=NULL,$like=NULL,$custom=NULL){
                $this->db->select($field);    
                $this->db->from($table);
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');   
                if($like):
                     $this->db->like($like);
                endif;
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('form_no','asc');
                $this->db->group_by('student_record.student_id');
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
    public function bs_program_export($field,$table,$where=NULL,$like=NULL){
                $this->db->select($field);    
                $this->db->from($table);
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');   
                if($like):
                     $this->db->like($like);
                endif;
                $this->db->order_by('college_no','asc');
                $this->db->group_by('student_record.student_id');
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result_array();
            endif;
    }
    
    public function get_std_security($table,$where)
    {
     $query =  $this->db->select('student_record.student_name,student_record.college_no,student_record.student_id,student_security.*')
        ->FROM($table)   
    ->join('student_record','student_record.student_id=student_security.student_id', 'left outer')    
         ->where($where)
         ->get();
        if($query):
           return  $query->result();
        endif;
    }
    
    public function get_stdsecurityList($table,$where=NULL,$like=NULL)
    {
     $this->db->select('student_record.student_name,student_record.college_no,student_record.student_id,student_security.*,prospectus_batch.batch_name,sub_programes.name as sub_program,programes_info.programe_name')
        ->FROM($table)   
    ->join('student_record','student_record.student_id=student_security.student_id', 'left outer') 
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer')
    ->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer')         
    ->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
    if($where):
        $this->db->where($where);
    endif;
    if($like):
        $this->db->like($like);
    endif;   
     return $this->db->get()->result();
    }
    
    public function stdsecurityList($table)
    {
     $query =  $this->db->select('student_record.student_name,student_record.applicant_image,student_record.college_no,student_record.student_id,student_security.*,prospectus_batch.batch_name,sub_programes.name as sub_program,programes_info.programe_name')
        ->FROM($table)   
    ->join('student_record','student_record.student_id=student_security.student_id', 'left outer') 
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer')
    ->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer')         
    ->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer')
    ->order_by('security_id','desc') 
    ->get();
    if($query):
       return  $query->result();
    endif;
    }
    
    public function get_stdsecurityExport($table,$from_date=NULL,$to_date=NULL)
    {
     $this->db->select('
            student_security.general_security,
            student_security.hostel_security,
            student_security.exam_fee,
            student_security.fines,
            student_security.others,
            student_security.deduction,
            student_security.total_refund,
            student_security.comments,
            ')
        ->FROM($table)     
    ->join('student_record','student_record.student_id=student_security.student_id', 'left outer')
    ->join('student_group_allotment_new','student_group_allotment_new.student_id=student_record.student_id', 'left outer')      
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer')
    ->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer')         
    ->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer')
    ->join('sections','sections.sec_id=student_group_allotment_new.section_id', 'left outer');
    if($from_date !="" && $to_date !=""):
        $this->db->where('student_security.date BETWEEN "'.$from_date.'" and "'.$to_date.'"');
    endif;   
     return $this->db->get()->result_array();
    }
    
    public function get_stdsecurityrecord($table,$from_date=NULL,$to_date=NULL)
    {
     $this->db->select('student_record.student_name,student_record.applicant_image,student_record.college_no,student_record.student_id,student_security.*,prospectus_batch.batch_name,sub_programes.name as sub_program,programes_info.programe_name')
        ->FROM($table)   
    ->join('student_record','student_record.student_id=student_security.student_id', 'left outer') 
    ->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer')
    ->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer')
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer')         
    ->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
    if($from_date !="" && $to_date !=""):
        $this->db->where('student_security.date BETWEEN "'.$from_date.'" and "'.$to_date.'"');
    endif;   
     return $this->db->get()->result();
    }
    
    public function get_std_security_row($table,$where)
    {
     $query =  $this->db->select('student_record.student_name,student_record.college_no,student_record.student_id,student_security.*')
        ->FROM($table)   
    ->join('student_record','student_record.student_id=student_security.student_id', 'left outer')    
         ->where($where)
         ->get();
        if($query):
           return  $query->row();
        endif;
    }
    
    
    public function get_applicant_subjects($table,$where=NULL){
        $this->db->select('
            subject.title as subject_title,
        ');
            $this->db->FROM($table);
            $this->db->join('subject','subject.subject_id=new_student_subjects.subject_id','left outer');

            if($where):
                $this->db->where($where);
            endif;
        $query =      $this->db->get();
        return $query->result();
   }
 
    public function get_art_student_subjects($table,$where=NULL){
        $this->db->select('
            subject.title as subject_title,
        ');
            $this->db->FROM($table);
            $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id','left outer');

            if($where):
                $this->db->where($where);
            endif;
        $query =      $this->db->get();
        return $query->result();
   }
 
        
}

?>