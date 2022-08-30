<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class HostelModel extends CI_Model
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
    
    public function get_stdData($table,$where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.applicant_image,
                programes_info.programe_name as program,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch
                ');
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('s_status_id','5');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_HostelData($table)
    {
        $this->db->SELECT('
       hostel_student_record.*,
       hostel_status.*,
       hostel_rooms.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id','left outer');
    $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id','left outer');
    $this->db->join('hostel_rooms','hostel_rooms.room_id=hostel_student_record.room_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
   public function gethostel_Std($table,$where)
    {
        $this->db->SELECT('
       hostel_student_record.*,
       hostel_status.*,
       hostel_rooms.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id','left outer');
    $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id','left outer');
    $this->db->join('hostel_rooms','hostel_rooms.room_id=hostel_student_record.room_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function HostelDataSearch($table,$where=NULL)
    {
        $this->db->SELECT('
       hostel_student_record.*,
       hostel_status.*,
       hostel_rooms.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id','left outer');
    $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id','left outer');
    $this->db->join('hostel_rooms','hostel_rooms.room_id=hostel_student_record.room_id','left outer');
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
    
   public function HostelData_excel($table,$where=NULL)
    {
        $this->db->SELECT('
       student_record.college_no,
       student_record.form_no,
       student_record.student_name,
       student_record.father_name,
       hostel_student_record.student_mobile_no,
       sub_programes.name,
       hostel_rooms.room_name,       
       hostel_blocks.block_name,       
       hostel_student_record.allotted_date 
    ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id','left outer');
    $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id','left outer');
    $this->db->join('hostel_rooms','hostel_rooms.room_id=hostel_student_record.room_id','left outer');
    $this->db->join('hostel_blocks','hostel_blocks.block_id=hostel_rooms.block_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result_array();
        endif;
    }
    
    public function getRooms()
    {
        $this->db->SELECT('*');
        $this->db->FROM('hostel_rooms');
        $this->db->join('hostel_blocks','hostel_blocks.block_id=hostel_rooms.block_id');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getRoom()
    {
        $this->db->SELECT('*');
        $this->db->FROM('hostel_rooms');
        $this->db->join('hostel_blocks','hostel_blocks.block_id=hostel_rooms.block_id');
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function hostel_fee_challan($where=Null){
                $this->db->select(
                        '
                            student_record.student_name,
                            student_record.father_name,
                            student_record.form_no,
                            student_record.college_no,
                            student_record.batch_id,
                            student_record.sub_pro_id,
                            sub_programes.name,
                          '
                        );
                
                $this->db->join("student_record",'student_record.student_id=hostel_student_record.student_id');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
//                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_id=hostel_student_record.hostel_id');
                return  $this->db->where($where)->get('hostel_student_record')->row();
    }
   public function hostel_challan_info($where){
              $this->db->select('hostel_student_bill_info.id,hostel_heads.title,hostel_student_bill_info.amount,hostel_student_bill_info.total_days');
              $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
              $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
       return $this->db->where($where)->get('hostel_student_bill')->result();
   } 
  
   public function extra_info($where){
               $this->db->select('
                       hostel_student_bill.head_type,
                       hostel_student_bill.issue_date,
                       hostel_student_bill.id as challan_id,
                       bank.name as bank_name,
                       bank.account_no,
                       bank.address');
              $this->db->join('bank','bank.bank_id=hostel_student_bill.bank_id');

       return $this->db->where($where)->get('hostel_student_bill')->row();
   } 
   public function hoste_fee_heads(){
            $this->db->select(
                        '
                            hostel_heads.id,
                            hostel_heads.title as hostel_title,
                            hostel_heads.amount,
                            hostel_heads.status,
                            hostel_head_type.title as head_title,
                            prospectus_batch.batch_name as batch_name,
                            fee_category_titles.title as category_title,
                          '
                        );
            $this->db->join('hostel_head_type','hostel_head_type.id=hostel_heads.head_type');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=hostel_heads.batch_id');
            $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=hostel_heads.cat_title_id');
            return $this->db->get('hostel_heads')->result();
   } 
   public function student_info($where){
            $this->db->select(
                        '
                            challan_status,
                            payment_date,
                            student_record.student_id,
                            student_record.student_name,
                            student_record.father_name,
                            sub_programes.name,
                            hostel_student_record.hostel_id,
                            hostel_student_record.hostel_status_id,
                           '
                        );
             $this->db->join('hostel_student_record','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
             $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id');
             $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
             $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
        
            return $this->db->where($where)->get('hostel_student_bill')->row();
   }
   public function student_info_refund($where){
            $this->db->select(
                        '
                            challan_status,
                            payment_date,
                            student_record.student_id,
                            student_record.student_name,
                            student_record.father_name,
                            sub_programes.name,
                            hostel_student_record.hostel_id,
                            hostel_student_record.hostel_status_id,
                           '
                        );
             $this->db->join('hostel_student_record','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
             $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id');
             $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
             $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
             $this->db->where('hostel_student_bill.challan_status ',2);
            return $this->db->where($where)->get('hostel_student_bill')->row();
   }
   
   public function challan_info($where){
             $this->db->select(
                     '
                         hostel_student_bill_info.id,
                         hostel_heads.title,
                         hostel_student_bill_info.amount,
                     ');
             $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
             $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
      return $this->db->where($where)->get('hostel_student_bill')->result();
   }
 public function hostel_payments($where=Null,$like=NULL,$date=NULL){
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
                       
                      ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
                
                $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
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
   public function hostel_head_wise_group_wise($where,$like,$date){
         
        
        $this->db->select('
                hostel_heads.id as head_id,
                hostel_heads.title,
                hostel_student_record.student_id,
                 ');
        $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
        $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
        $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
        $this->db->order_by('hostel_heads.id','asc');
        $this->db->group_by('hostel_heads.title');
        $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
        if($where):
            $this->db->where($where);
        endif;
        
        if($like):
            $this->db->like($like);
        endif;
        $result = $this->db->get('hostel_student_record')->result();
        
        $return_array = '';
        foreach($result as $row):
                     
            
                     $this->db->select('programe_name,batch_name, sum(hostel_student_bill_info.paid_amount) as paid_amount');
                     $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                     $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                     $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                     $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                     $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                     $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                    
                     $this->db->group_by('hostel_heads.title');   

                     $this->db->group_by('prospectus_batch.batch_id');   
                     $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
                     
                        $where_head = array(
//                         'student_record.student_id'=>$row->student_id,
                         'hostel_heads.title'=>$row->title
                        );
//            $group = $this->db->where($where_head)->get('student_record')->result();
            $group = $this->db->where($where_head)->get('student_record')->result();
           
            $return_array[] = array(
                'head_name' =>$row->title,
                'group' =>$group,
            );
            
        endforeach;
         return   json_decode(json_encode($return_array), FALSE);
    }  
   public function hostel_date_wise($where,$like,$date){
         
        
        $this->db->select('
                hostel_heads.id as head_id,
                hostel_heads.title,
                hostel_student_bill.payment_date,
                sum(hostel_student_bill_info.paid_amount) as paid_amount
                 ');
        $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
        $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
        $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
        $this->db->order_by(' hostel_student_bill.payment_date','asc');
        $this->db->group_by(' hostel_student_bill.payment_date');
        $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
        if($where):
            $this->db->where($where);
        endif;
        
        if($like):
            $this->db->like($like);
        endif;
       return $this->db->get('hostel_student_record')->result();
         
         
    }  
 public function hostel_challan_search($where=Null,$like=NULL){
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
                        fee_challan_status.fcs_title,
                        hostel_student_record.hostel_id,
                       
                      ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
                
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=hostel_student_bill.challan_status');
               
                
                
//                $this->db->where('hostel_student_bill.issue_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('hostel_student_bill.issue_date','desc');
                $this->db->order_by('student_record.college_no','asc');
        return  $this->db->get('student_record')->result();
    } 
 public function hostel_refunds_report($where=Null,$like=NULL,$date=NULL){
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
                         
                       
                      ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->db->join('hostel_refund','hostel_refund.hostel_id=hostel_student_record.hostel_id');
                
                
                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
                
                $this->db->where('hostel_refund.refund_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
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

   public function get_hotel_amount($where){

                $this->db->select('hostel_student_bill.id,sum(paid_amount) as total_paid,sum(amount) as actual_amount');
                $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');    
                $this->db->group_by('hostel_student_bill.id');
        return  $this->db->where($where)->get('hostel_student_bill')->row();     
                
    }    
   public function get_hotel_refund_amount($where){

                $this->db->select('sum(hostel_refund_detail.amount) as refund_amount');
                $this->db->join('hostel_refund_detail','hostel_refund_detail.hostel_refund_id=hostel_refund.id');    
                    
        return  $this->db->where($where)->get('hostel_refund')->row();     
                
    }   
    
    public function group_wise_student($where=NULL){
               $this->db->select('
                       hostel_student_record.hostel_id,
                       hostel_student_record.hostel_status_id
                       '); 
               $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id'); 
//               $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
        return $this->db->where($where)->get('hostel_student_record')->result();
    }
    public function Hostel_print_group($where=NULL){
               $this->db->select('
                       student_record.college_no,
                       student_record.form_no,
                       student_record.student_name,
                       student_record.father_name,
                       hostel_student_bill.id as challan_id,
                       hostel_student_record.hostel_id,
                       hostel_student_record.hostel_status_id,
                       hostel_student_bill.head_type,
                       hostel_student_bill.issue_date,
                       bank.name as bank_name,
                       bank.account_no,
                       bank.address,
                       sub_programes.name as Group,
                       '); 
               $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id'); 
               $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
               $this->db->join('bank','bank.bank_id=hostel_student_bill.bank_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
        return $this->db->where($where)->get('hostel_student_record')->result();
    }
    
}

