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
//            $this->db->where('s_status_id','5');
//            $this->db->where('s_status_id','1');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
    public function get_HostelData($table)
    {
        $this->db->SELECT('
       hostel_student_record.*,
       hostel_batch.*,
       hostel_status.*,
       hostel_rooms.*,
       student_record.student_name,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program,
       prospectus_batch.batch_name as batch 
        ');
    $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id','left outer');
    $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id','left outer');
    $this->db->join('hostel_batch','hostel_batch.h_batch_id=hostel_student_record.hostel_batch_id','left outer');
    $this->db->join('hostel_rooms','hostel_rooms.room_id=hostel_student_record.room_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
    $this->db->order_by('student_record.college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
   public function gethostel_Std($table,$where)
    {
        $this->db->SELECT('
       hostel_student_record.*,
       hostel_batch.*,
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
    $this->db->join('hostel_batch','hostel_batch.h_batch_id=hostel_student_record.hostel_batch_id','left outer');    
    $this->db->join('hostel_rooms','hostel_rooms.room_id=hostel_student_record.room_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    
    public function HostelDataSearch123($table,$where=NULL){
    $this->db->SELECT('
       hostel_student_record.hostel_id,
       hostel_status.*,
       student_status.*,
       shift.*,
       hostel_rooms.*,
       student_record.student_name,           
       reserved_seat.name,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       programes_info.programe_name as program,
       sub_programes.name as sub_program,
       prospectus_batch.batch_name as batch,
       applicant_edu_detail.obtained_marks,
       applicant_edu_detail.total_marks,
        ');
   
    $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id','left outer');
    $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
    $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id','left outer');
    $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
    $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer');    
    $this->db->join('hostel_rooms','hostel_rooms.room_id=hostel_student_record.room_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
    $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id2','left outer');
    $this->db->order_by('applicant_edu_detail.obtained_marks','asc');
    $this->db->order_by('student_record.college_no','asc');
    
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get($table);
        if($query):
            return $query->result();
        endif;
    }
    
    public function HostelDataSearch($table,$where=NULL){
    $this->db->SELECT('
       hostel_student_record.*,
       hostel_status.*,
       student_status.*,
       shift.name as shift_name,
       hostel_rooms.*,
       student_record.student_name,           
       reserved_seat.name,           
       student_record.father_name,           
       student_record.college_no,          
       student_record.mobile_no,           
       student_record.applicant_image,
       hostel_form_approval.title as approval_by,
       invt_rooms.rm_name,
       invt_building_block.bb_name as block_name,
       programes_info.programe_name as program,
       sub_programes.name as sub_program,
       prospectus_batch.batch_name as batch,
       applicant_edu_detail.obtained_marks,
       applicant_edu_detail.total_marks,
       sections.name as sessionName,
        '); 
   
    $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id','left outer');
    $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
    $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id','left outer');
    $this->db->join('hostel_form_approval','hostel_form_approval.id=hostel_student_record.approved_by','left outer');
    $this->db->join('invt_rooms','invt_rooms.rm_id=hostel_student_record.room_id','left outer');
    $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId','left outer');
    $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
    $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer');    
    $this->db->join('hostel_rooms','hostel_rooms.room_id=hostel_student_record.room_id','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
    $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id2','left outer');
//    $this->db->order_by('applicant_edu_detail.obtained_marks','asc');
    $this->db->order_by('student_record.college_no','asc');
    $this->db->group_by('student_record.student_id');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get($table);
        if($query):
            return $query->result();
        endif;
    }
    
   public function HostelData_excel($table,$where=NULL){
        $this->db->SELECT('
       student_record.college_no,
       student_record.form_no,
       student_record.student_name,
       student_record.father_name,
       student_record.mobile_no,
       prospectus_batch.batch_name,
       sub_programes.name as sub_program,
        sections.name as sessionName,
       hostel_student_record.allotted_date,
       invt_rooms.rm_name,
       invt_building_block.bb_name as block_name,
       applicant_edu_detail.obtained_marks,
       applicant_edu_detail.total_marks,
       shift.name as shift_name, 
       reserved_seat.name,  
       hostel_form_approval.title as approval_by,
      
    ');
    
    $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id','left outer');
    $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id','left outer');
    $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
    $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
    $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer');   
    $this->db->join('hostel_batch','hostel_batch.h_batch_id=hostel_student_record.hostel_batch_id','left outer');
    $this->db->join('hostel_form_approval','hostel_form_approval.id=hostel_student_record.approved_by','left outer');
    $this->db->join('invt_rooms','invt_rooms.rm_id=hostel_student_record.room_id','left outer');
    $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId','left outer');
    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer'); 
    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer'); 
    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
    $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id2','left outer');
     $this->db->order_by('applicant_edu_detail.obtained_marks','asc');
     $this->db->order_by('student_record.college_no','asc');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get($table);
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
                            prospectus_batch.batch_name,
                          '
                        );
                
                $this->db->join("student_record",'student_record.student_id=hostel_student_record.student_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
//                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_id=hostel_student_record.hostel_id');
                return  $this->db->where($where)->get('hostel_student_record')->row();
    }
   public function hostel_challan_info($where){
              $this->db->select('
                      hostel_student_bill_info.id,
                      hostel_heads.title,
                      hostel_student_bill_info.amount,
                      hostel_student_bill_info.total_days
                      ');
              $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
              $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
       return $this->db->where($where)->get('hostel_student_bill')->result();
   } 
  
   public function extra_info($where){
               $this->db->select('
                       hostel_student_bill.head_type,
                       hostel_student_bill.issue_date,
                       hostel_student_bill.date_from,
                       hostel_student_bill.date_to,
                       hostel_student_bill.valid_date,
                       hostel_student_bill.comments,
                       hostel_student_bill.challan_status,
                       hostel_student_bill.installment_flag,
                       hostel_student_bill.id as challan_id,
                       bank.name as bank_name,
                       bank.account_no,
                       bank.address');
              $this->db->join('bank','bank.bank_id=hostel_student_bill.bank_id');

       return $this->db->where($where)->get('hostel_student_bill')->row();
   } 
    public function hoste_fee_heads($where=NULL){
            $this->db->select(
                        '
                            hostel_heads.id,
                            hostel_heads.title as hostel_title,
                            hostel_heads.amount,
                            hostel_heads.status,
                            hostel_heads.fromDate,
                            hostel_heads.toDate,
                            hostel_head_type.title as head_title,
                            prospectus_batch.batch_name as batch_name,
                            fee_category_titles.title as category_title,
                            
                          '
                        );
            
            $this->db->join('hostel_head_type','hostel_head_type.id=hostel_heads.head_type');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=hostel_heads.batch_id');
            $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=hostel_heads.cat_title_id');
             $this->db->order_by('fee_category_titles.cat_order','asc');
            $this->db->order_by('prospectus_batch.batch_id','desc');
            $this->db->order_by('fee_category_titles.cat_title_id','desc');
            $this->db->where('prospectus_batch.status','on');
              if($where):
                $this->db->where($where);
            endif;
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
                            hostel_student_bill.head_type,
                            hostel_student_bill.hostel_std_id,
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
                         hostel_student_bill_info.balance,
                         hostel_student_bill_info.paid_amount,
                         hostel_student_bill_info.old_challan_id,
                         hostel_student_bill_info.id as ChlnDetailId,
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
                        prospectus_batch.batch_name,
                        sum(hostel_student_bill_info.paid_amount) as paid_amount
                        
                         
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
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('hostel_student_bill.id','asc');
                $this->db->order_by('hostel_student_bill.payment_date','desc');
                $this->db->order_by('hostel_student_bill.id','asc');
        return  $this->db->get('student_record')->result();
    }

    public function hostel_date_wise($where,$like,$date){
         
        
        $this->db->select('
               
                hostel_student_bill.payment_date,
                sum(hostel_student_bill_info.paid_amount) as paid_amount
                 ');
            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
            $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
            $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
            $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
            $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
            $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
            $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
 
        
        $this->db->order_by(' hostel_student_bill.payment_date','asc');
        $this->db->group_by(' hostel_student_bill.payment_date');
        
         if(empty($date['from'])):
                $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
           else:
                 $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');

           endif;
       
        if($where):
            $this->db->where($where);
        endif;
        
        if($like):
            $this->db->like($like);
        endif;
       return $this->db->get('student_record')->result();
         
         
    } 
   
   
//     public function hostel_payments($where=Null,$like=NULL,$date=NULL){
//           $this->db->select(
//                    '  
//                        student_record.college_no,
//                        student_record.student_id,
//                        student_record.form_no,
//                        student_record.student_name,
//                        programes_info.programe_name,
//                        sub_programes.name as sub_program_name,
//                        prospectus_batch.batch_name,
//                        sections.name as sessionName, 
//                        hostel_student_bill.id as challan_id,
//                        hostel_head_type.title as hotel_type,
//                        hostel_student_bill.payment_date,
//                        hostel_status.status_name,
//                        sum(hostel_student_bill_info.paid_amount) as paid_amount
//                        
//                         
//                      ');
//
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
//                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
////                
//                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
//                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
//                $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
//                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
//                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
//                $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
////                
//                
//                if(empty($date['from'])):
//                     $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
//                else:
//                      $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
//                endif;
//                
//              
//                if($where):
//                    $this->db->where($where);
//                endif;
//                if($like):
//                    $this->db->like($like);
//                endif;
//               
//                $this->db->group_by('hostel_student_bill.id','asc');
//                $this->db->order_by('hostel_student_bill.payment_date','desc');
//                $this->db->order_by('hostel_student_bill.id','asc');
//        return  $this->db->get('student_record')->result();
//    }
//
//    public function hostel_date_wise($where,$like,$date){
//         
//        
//        $this->db->select('
//               
//                hostel_student_bill.payment_date,
//                sum(hostel_student_bill_info.paid_amount) as paid_amount
//                 ');
//            $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
//            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
//            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//            $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
//            $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
//            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
//            $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
//            $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
//            $this->db->where_in('hostel_student_bill.challan_status',array('2','3'));
// 
//        
//        $this->db->order_by(' hostel_student_bill.payment_date','asc');
//        $this->db->group_by(' hostel_student_bill.payment_date');
//        
//         if(empty($date['from'])):
//                $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
//           else:
//                 $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
//
//           endif;
//       
//        if($where):
//            $this->db->where($where);
//        endif;
//        
//        if($like):
//            $this->db->like($like);
//        endif;
//       return $this->db->get('student_record')->result();
//         
//         
//    } 
public function hostel_head_wise_group_wise($where,$like,$date){
         
//        echo '<pre>';print_r($where);die;
        $this->db->select('
                hostel_heads.id as head_id,
                hostel_head_title.title,
                hostel_head_title.id,
                student_record.student_id,
                programes_info.programe_name
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
        
        
       // $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
         if(empty($date['from'])):
                $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
           else:
                 $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');

           endif;
//        
        
        if($where):
            $this->db->where($where);
        endif;
        
        if($like):
            $this->db->like($like);
        endif;
                
                $this->db->order_by('hostel_head_title.title','asc');
                $this->db->group_by('hostel_head_title.id');
                    
        $result =   $this->db->get('student_record')->result();
        
         
        
        $return_array = '';
        foreach($result as $row):
                     
                    $this->db->select(
                            '
                            programes_info.programe_name,
                            prospectus_batch.batch_name,
                            sum(hostel_student_bill_info.paid_amount) as total_amount
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
                             $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');

                       endif;  
                       $this->db->group_by('prospectus_batch.batch_id');
                       $this->db->order_by('prospectus_batch.batch_name','asc');
                    $where_heads = array(
                            'hostel_head_title.id'=>$row->id,

                        );
                       if($where):
                        $this->db->where($where);
                    endif;
 
             $group          = $this->db->where($where_heads)->get('student_record')->result();
            $return_array[] = array(
                'head_name'         => $row->title,
                'head_id'           => $row->head_id,
                'group'             => $group,
            );
            
        endforeach;
    return   json_decode(json_encode($return_array), FALSE);
    }
     public function hostel_challan_search($where=Null,$like=NULL){
           $this->db->select(
                    '  
                        student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sections.name as sessionName, 
                        hostel_student_bill.id as challan_id,
                        hostel_student_bill.challan_lock,
                        hostel_student_bill.date_from,
                        hostel_student_bill.date_to,
                        hostel_head_type.title as hotel_type,
                        hostel_student_bill.payment_date,
                        hostel_status.status_name,
                        fee_challan_status.fcs_title,
                        fee_challan_status.ch_status_id,
                        hostel_student_record.hostel_id,
                        fee_category_titles.title as Category_title,
                        student_status.name as student_status,
                        prospectus_batch.batch_name,
                       
                      ');

                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
                  $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=hostel_student_bill.challan_status');
               $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=hostel_student_bill.cat_title_id');
               
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
//                $this->db->group_by('hostel_student_bill.id');
                $this->db->order_by('student_record.college_no','asc');
                $this->db->order_by('hostel_student_bill.id','asc');
                $this->db->order_by('hostel_student_bill.issue_date','desc');
                 
  $result = $this->db->get('student_record')->result();
        $return_array = '';
        foreach($result as $row):
             
            
            //Current Bill  
            $where_current  = array(
              'hostel_student_bill.id'                      => $row->challan_id, 
              'hostel_student_bill_info.old_challan_id'     => 0, 
            );
            $field_current = 'sum(amount) as current_bill';
            $current = $this->get_Hostel_mess_bill_details($field_current,$where_current);
            
            //arrears Bill  
            $where_arrears  = array(
              'hostel_student_bill.id'                      => $row->challan_id, 
              'hostel_student_bill_info.old_challan_id >'     => 0, 
            );
            $field_arrears = 'sum(amount) as arrears_bill';
            $arrears = $this->get_Hostel_mess_bill_details($field_arrears,$where_arrears);
            
            //paid Bill  
            $where_paid  = array(
              'hostel_student_bill.id'                      => $row->challan_id, 
            );
            $field_paid = 'sum(paid_amount) as paid_amount';
            $paid = $this->get_Hostel_mess_bill_details($field_paid,$where_paid);
 
            $return_array[] = array(
              'form_no'             => $row->form_no,  
              'college_no'          => $row->college_no,  
              'student_id'          => $row->student_id,  
              'student_name'        => $row->student_name,  
              'father_name'         => $row->father_name,  
              'sessionName'         => $row->sessionName,  
              'student_status'      => $row->student_status,  
              'student_name'        => $row->student_name,  
              'sub_program_name'    => $row->sub_program_name,  
              'fcs_title'           => $row->fcs_title,  
              'Category_title'      => $row->Category_title,  
              'date_from'           => $row->date_from,  
              'date_to'             => $row->date_to,  
              'hostel_id'           => $row->hostel_id,  
              'batch_name'          => $row->batch_name,  
              'challan_id'          => $row->challan_id,  
              'payment_date'        => $row->payment_date,  
              'ch_status_id'        => $row->ch_status_id,  
              'challan_lock'        => $row->challan_lock,  
              'status_name'        => $row->status_name,  
              'current'             => $current->current_bill,  
              'arrears'             => $arrears->arrears_bill,  
              'paid'                => $paid->paid_amount,  
              'balance'             => $current->current_bill+$arrears->arrears_bill-$paid->paid_amount,  
  );
            
        endforeach;
     return   json_decode(json_encode($return_array), FALSE);
    } 
 
    public function get_Hostel_mess_bill_details($field,$where){
                $this->db->select($field);
                $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');    
        return  $this->db->where($where)->get('hostel_student_bill')->row();   
    }
//    public function hostel_challan_search($where=Null,$like=NULL){
//           $this->db->select(
//                    '  
//                        student_record.college_no,
//                        student_record.student_id,
//                        student_record.form_no,
//                        student_record.student_name,
//                        student_record.father_name,
//                        programes_info.programe_name,
//                        sub_programes.name as sub_program_name,
//                        prospectus_batch.batch_name,
//                        sections.name as sessionName, 
//                        hostel_student_bill.id as challan_id,
//                        hostel_student_bill.date_from,
//                        hostel_student_bill.date_to,
//                        hostel_head_type.title as hotel_type,
//                        hostel_student_bill.payment_date,
//                        hostel_status.status_name,
//                        fee_challan_status.fcs_title,
//                        fee_challan_status.ch_status_id,
//                        hostel_student_record.hostel_id,
//                        fee_category_titles.title as Category_title,
//                       student_status.name as student_status,
//                       
//                      ');
////                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
//                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//                
//                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
//                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
//                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
//                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
//                  $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
//                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=hostel_student_bill.challan_status');
//               $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=hostel_student_bill.cat_title_id');
//               
//                
//                
////                $this->db->where('hostel_student_bill.issue_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
////                
//                if($where):
//                    $this->db->where($where);
//                endif;
//                if($like):
//                    $this->db->like($like);
//                endif;
//               
////                $this->db->group_by('hostel_student_bill.id');
//                $this->db->order_by('student_record.college_no','asc');
//                $this->db->order_by('hostel_student_bill.id','asc');
//                $this->db->order_by('hostel_student_bill.issue_date','desc');
//                
//                
//        return  $this->db->get('student_record')->result();
//    } 
 
    
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
                        hostel_refund.refund_date
                         
                       
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
                if(empty($date['from'])):
                        $this->db->where('hostel_refund.refund_date <=',date('Y-m-d', strtotime($date['to'])));
                   else:
                         $this->db->where('hostel_refund.refund_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');

                   endif;
                
                
                //$this->db->where('hostel_refund.refund_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
//                
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('student_record.student_id','asc');
                $this->db->order_by('hostel_refund.refund_date','asc');
        return  $this->db->get('student_record')->result();
    } 

   public function get_hotel_amount($where){

                $this->db->select('hostel_student_bill.id,sum(paid_amount) as total_paid,sum(amount) as actual_amount,balance');
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
                       hostel_student_record.hostel_status_id,
                       student_record.migration_status,
                       '); 
               $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id'); 
               $this->db->where_in('student_record.s_status_id',array(5,12,21,22)); //5 = Enrolled, 12 = Suspend (Fee),21 = Suspend (General), 22= Suspend (Migration)
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
                       hostel_student_bill.date_from,
                       hostel_student_bill.date_to,
                       hostel_student_bill.issue_date,
                       hostel_student_bill.valid_date,
                       bank.name as bank_name,
                       bank.account_no,
                       bank.address,
                       sub_programes.name as Group,
                       hostel_student_bill.comments,
                       prospectus_batch.batch_name,
                       '); 
               $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id'); 
               $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
               $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
               $this->db->join('bank','bank.bank_id=hostel_student_bill.bank_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
        return $this->db->where($where)->get('hostel_student_record')->result();
    }    
    public function hostel_student_info($where){
               $this->db->select('
                            student_record.college_no,
                            student_record.student_name,
                            sub_programes.name as sub_proram,
                            prospectus_batch.batch_name,
                            prospectus_batch.batch_id,
                            hostel_student_bill.date_to,
                            hostel_student_bill.challan_status,
                            hostel_student_bill.date_from,
                            hostel_student_bill.comments,
                            hostel_student_bill.issue_date,
                            hostel_student_bill.valid_date,
                            hostel_student_bill.head_type,
                            ');
                    $this->db->join('hostel_student_record','hostel_student_record.hostel_id=hostel_student_bill.hostel_std_id');
                    $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
        return   $this->db->get_where('hostel_student_bill',$where)->row();

    }
    public function hoste_student_fee_info($where){
            $this->db->select(
                    '
                    hostel_head_title.title,
                    hostel_student_bill_info.amount,
                    hostel_student_bill_info.paid_amount,
                    hostel_student_bill_info.old_challan_id,
                    hostel_student_bill_info.id as info_pk,
                    hostel_student_bill_info.comments,
                    hostel_student_bill_info.adjust_flag
                    ');    
                        $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                        $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                         $this->db->order_by('hostel_student_bill_info.id','asc');
                        return  $this->db->get_where('hostel_student_bill_info',$where)->result();

    }
     public function hostel_challan_info_new($where){
        $this->db->select('
                      hostel_student_bill_info.id,
                      hostel_student_bill_info.amount,
                      hostel_student_bill_info.total_days,
                      hostel_student_bill_info.hostel_head_id,
                      hostel_head_title.id as head_id,
                      hostel_head_title.title,
                      hostel_student_bill.installment_flag,
                       
                      ');
              $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
              $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
              $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
              $this->db->group_by('hostel_head_title.id');
              $this->db->order_by('hostel_head_title.title');
              return $this->db->where($where)->get('hostel_student_bill')->result();
   } 
   public function hostel_challan_info_row($where){
   $this->db->select('
                      hostel_student_bill_info.id,
                      sum(hostel_student_bill_info.amount) as amount,
                      sum(hostel_student_bill_info.paid_amount) as paid_amount,
                      sum(hostel_student_bill_info.balance) as balance,
                      hostel_student_bill_info.total_days,
                      hostel_student_bill_info.hostel_head_id,
                      hostel_head_title.id as head_id,
                      hostel_head_title.title,
                       
                      ');
              $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
              $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
              $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
              $this->db->group_by('hostel_head_title.id');
              $this->db->order_by('hostel_head_title.title');
              return $this->db->where($where)->get('hostel_student_bill')->row();
   } 
     public function hostel_and_mess_defaulter($where=Null,$whereAmount=NULL,$like=NULL){
         
                      $this->db->select(
                    '   student_record.college_no,
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
        
//                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
//                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=student_record.student_id');
//                    
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
     $result =     $this->db->get('student_record')->result();
     
   
     
     //ALL students 
     
     $defaulter_list = '';
     foreach($result as $allRow):
         
         //Hostel & Mess Balance 
                        $this->db->select('
                                hostel_student_bill.id,
                                hostel_student_record.student_id, 
                                sum(balance) as hostelBalance
                                ');  
                        $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                        $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                        $this->db->group_by('hostel_student_record.student_id'); 
                        $this->db->having('hostelBalance >=',$whereAmount);
//                        $this->db->where('challan_status',2);
         $hostel_record = $this->db->get_where('hostel_student_record',array('student_id'=>$allRow->student_id,'challan_lock'=>0))->row();
         $hostel_balance = '';
         
          
         if(!empty($hostel_record)):
             $hostel_balance = $hostel_record->hostelBalance;
         
              $defaulter_list[] = array(
               'college_no'         => $allRow->college_no,  
               'student_id'         => $allRow->student_id,  
               'challan_balance'    => $hostel_balance,
                'form_no'           => $allRow->form_no,
                'student_name'      => $allRow->student_name,
                'father_name'       => $allRow->father_name,
                'applicant_image'   => $allRow->applicant_image,
                'fc_challan_id'     => $hostel_record->id,
                'student_status'     => $allRow->student_status,
                'sub_program'       => $allRow->sub_program,
                'Group'             => $allRow->Group,
               );
              
              
         endif;
         
         
         
     endforeach;
     
//      echo '<pre>';print_r($result);die; 
     return   json_decode(json_encode($defaulter_list), FALSE);
      
    }
    
    public function hostel_defaulter($where=Null,$whereAmount=NULL,$like=NULL){
         
                      $this->db->select(
                    '   student_record.college_no,
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
        
//                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
//                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=student_record.student_id');
//                    
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
                   
     $result =     $this->db->get('student_record')->result();
     
     //ALL students 
     
     $defaulter_list = '';
     foreach($result as $allRow):
         
         //Hostel & Mess Balance 
                        $this->db->select('hostel_student_bill.id,hostel_student_record.student_id, sum(balance) as hostelBalance');  
                        $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                        $this->db->join('hostel_student_bill_info','hostel_student_bill_info.	hostel_bill_id=hostel_student_bill.id');
                        $this->db->group_by('hostel_student_record.student_id'); 
                        $this->db->having('hostelBalance >=',$whereAmount);
                        $this->db->where('head_type',1);
//                        $this->db->where('challan_status',2);
         $hostel_record = $this->db->get_where('hostel_student_record',array('student_id'=>$allRow->student_id,'challan_lock'=>0))->row();
         $hostel_balance = '';
         
          
         if(!empty($hostel_record)):
             $hostel_balance = $hostel_record->hostelBalance;
         
              $defaulter_list[] = array(
               'college_no'     => $allRow->college_no,  
               'student_id'     => $allRow->student_id,  
               'challan_balance'=> $hostel_balance,
                'form_no'       => $allRow->form_no,
                'student_name'      => $allRow->student_name,
                'father_name'       => $allRow->father_name,
                'applicant_image'   => $allRow->applicant_image,
                'fc_challan_id'     => $hostel_record->id,
                'student_status'     => $allRow->student_status,
                'sub_program'     => $allRow->sub_program,
                'Group'         => $allRow->Group,
               );
              
              
         endif;
         
         
         
     endforeach;
     
     
     return   json_decode(json_encode($defaulter_list), FALSE);
      
    }
    public function mess_defaulter($where=Null,$whereAmount=NULL,$like=NULL){
         
                      $this->db->select(
                    '   student_record.college_no,
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
        
//                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
//                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=student_record.student_id');
//                    
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
                   
     $result =     $this->db->get('student_record')->result();
     
     //ALL students 
     
     $defaulter_list = '';
     foreach($result as $allRow):
         
         //Hostel & Mess Balance 
                        $this->db->select('hostel_student_bill.id,hostel_student_record.student_id, sum(balance) as hostelBalance');  
                        $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                        $this->db->join('hostel_student_bill_info','hostel_student_bill_info.	hostel_bill_id=hostel_student_bill.id');
                        $this->db->group_by('hostel_student_record.student_id'); 
                        $this->db->having('hostelBalance >=',$whereAmount);
                        $this->db->where('head_type',2);
//                        $this->db->where('challan_status',2);
         $hostel_record = $this->db->get_where('hostel_student_record',array('student_id'=>$allRow->student_id,'challan_lock'=>0))->row();
         $hostel_balance = '';
         
          
         if(!empty($hostel_record)):
             $hostel_balance = $hostel_record->hostelBalance;
         
              $defaulter_list[] = array(
               'college_no'     => $allRow->college_no,  
               'student_id'     => $allRow->student_id,  
               'challan_balance'=> $hostel_balance,
                'form_no'       => $allRow->form_no,
                'student_name'      => $allRow->student_name,
                'father_name'       => $allRow->father_name,
                'applicant_image'   => $allRow->applicant_image,
                'fc_challan_id'     => $hostel_record->id,
                'student_status'     => $allRow->student_status,
                'sub_program'     => $allRow->sub_program,
                'Group'         => $allRow->Group,
               );
              
              
         endif;
         
         
         
     endforeach;
     
     
     return   json_decode(json_encode($defaulter_list), FALSE);
      
    }
    public function get_batch_wise_student($where=NULL){
    
          $this->db->select(
                    '   student_record.college_no,
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
$this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');		
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id'); 
                    $this->db->where_in('student_status.s_status_id',array('5','12'));
                    $this->db->order_by('sub_programes.sub_pro_id','asc');
                    if($where):
                        $this->db->where($where);
                    endif;
                   
                   
  return $this->db->get('student_record')->result();
    
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
      public function get_Student_feeDetails_search($where){
                 $this->db->select('hostel_heads.title,hostel_student_bill_info.amount,paid_amount,balance');
                 $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                 $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
//                
       return $this->db->where($where)->get('hostel_student_bill_info')->result();
    }
    
     function dropDown_pre_challan($table, $option=NULL,$value,$show,$where=NULL){
		 
                if($where):
                    $this->db->where($where);
                endif;
            
                    $this->db->order_by($show,'asc');
                
//                         $this->db->join('');   
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = '  Challan # '.$row->$show;
			}
			return $data;
		}
	}
    public function hostel_ledger($where=Null,$like=NULL,$type){
           $this->db->select(
                    '  
                        student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.father_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_program_name,
                        prospectus_batch.batch_name,
                        sections.name as sessionName, 
                        student_status.name as student_status,
                        hostel_student_record.hostel_id,
                        hostel_status.status_name as hostel_status,
                         
                       
                      ');

                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
                
                 $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
//                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
//                $this->db->join('hostel_head_type','hostel_head_type.id=hostel_student_bill.head_type');
                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
//                
//                $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=hostel_student_bill.challan_status');
//                $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=hostel_student_bill.cat_title_id');
                $this->db->where('hostel_student_record.hostel_status_id !=',5); 
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
               
//                $this->db->group_by('hostel_student_bill.id');
                $this->db->order_by('student_record.college_no','asc');
//                $this->db->order_by('hostel_student_bill.id','asc');
//                $this->db->order_by('hostel_student_bill.issue_date','desc');
                
                
        $result =   $this->db->get('student_record')->result();
        
        $return = '';
        foreach($result as $row):
            
//                            $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
//                            $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.head_title_id');
                            $this->db->join('fee_challan_status','fee_challan_status.ch_status_id=hostel_student_bill.challan_status');    
                            $this->db->where($type);
                            $this->db->order_by('hostel_student_bill.id');
            $hoste_mess =   $this->db->get_where('hostel_student_bill',array('hostel_std_id'=>$row->hostel_id))->result();
            $details_array = '';
            $arrears   = '';
            $current    = '';
            foreach($hoste_mess as $htlRow):
                
                            $this->db->select('sum(amount) as tAmount,sum(paid_amount) as tPaid,sum(balance) as tbalance');
                $challan_det =  $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$htlRow->id))->row();
                
//                    
                            $this->db->select('sum(amount) as tAmount,sum(paid_amount) as tPaid,sum(balance) as tbalance');
                $current =  $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$htlRow->id,'old_challan_id'=>0))->row();
                            
                            $this->db->select('sum(amount) as tAmount,sum(paid_amount) as tPaid,sum(balance) as tbalance');
                $arrears =  $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$htlRow->id,'old_challan_id >'=>0))->row();
                $challan_date = '';
                
                if($htlRow->challan_status == 2):
                    $challan_date = date('d-m-Y',strtotime($htlRow->payment_date));
                    else:
                    $challan_date = '';
                endif;
                $details_array[] = array(
                    'challan_id'        => $htlRow->id,
                    'sessionName'       => $row->sessionName,
                    'student_status'    => $row->student_status,
                    'date_from'         => $htlRow->date_from,
                    'date_to'           => $htlRow->date_to,
                    'Status'            => $htlRow->fcs_title,
                    'Actual'            => $challan_det->tAmount,
                    'Payable'           => $current->tAmount,
                    'Arrears'           => $arrears->tAmount,
                    'Net_Payable'       => $arrears->tAmount+$current->tAmount,
                    'total_paid'        => $challan_det->tPaid,
                    'Balance'           => $challan_det->tAmount-$challan_det->tPaid,
                    'payment_date'      => $challan_date,
                    'comments'          => $htlRow->comments,
                     
                );
                
            endforeach;
            $return[] = array(
              'college_no'      => $row->college_no,  
              'student_name'    => $row->student_name,  
              'student_id'      => $row->student_id,  
              'hostel_id'       => $row->hostel_id,  
              'hostel_status'   => $row->hostel_status,  
              'student_details' => $details_array,  
            ); 
        endforeach;
        return   json_decode(json_encode($return), FALSE);
    }
    
        public function student_status_log($where){
               $this->db->select('hostel_status_log.*,student_record.student_name,hostel_status.status_name,hr_emp_record.emp_name');
               $this->db->join('hostel_student_record','hostel_student_record.hostel_id=hostel_status_log.student_hostel_id'); 
               $this->db->join('student_record','student_record.student_id=hostel_student_record.student_id'); 
               $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_status_log.hostel_status_id'); 
               $this->db->join('users','users.id=hostel_status_log.update_by'); 
               $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId'); 
               $this->db->order_by('hostel_status_log.id','desc');
        return $this->db->get_where('hostel_status_log',$where)->result();
    }
    public function hostel_std_wise_group($where,$like,$date){
         
//        echo '<pre>';print_r($where);die;
        $this->db->select('
                hostel_heads.id as head_id,
                hostel_head_title.title,
                hostel_head_title.id,
                student_record.student_id,
                programes_info.programe_name
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
        
        
       // $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');
         if(empty($date['from'])):
                $this->db->where('hostel_student_bill.payment_date <=',date('Y-m-d', strtotime($date['to'])));
           else:
                 $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');

           endif;
//        
        
        if($where):
            $this->db->where($where);
        endif;
        
        if($like):
            $this->db->like($like);
        endif;
                
                $this->db->order_by('hostel_head_title.title','asc');
                $this->db->group_by('hostel_head_title.id');
                    
        $result =   $this->db->get('student_record')->result();
        
         
        
        $return_array = '';
        foreach($result as $row):
                     
                    $this->db->select(
                            '
                            student_record.student_name,
                            student_record.father_name,
                            student_record.college_no,
                            sections.name,
                            programes_info.programe_name,
                            prospectus_batch.batch_name,
                            sum(hostel_student_bill_info.paid_amount) as total_amount
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
                             $this->db->where('hostel_student_bill.payment_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');

                       endif;  
                       $this->db->group_by('student_record.student_id');
                       $this->db->order_by('prospectus_batch.batch_name','asc');
                    $where_heads = array(
                            'hostel_head_title.id'=>$row->id,

                        );
                       if($where):
                        $this->db->where($where);
                    endif;
 
             $group          = $this->db->where($where_heads)->get('student_record')->result();
            $return_array[] = array(
                'head_name'         => $row->title,
                'head_id'           => $row->head_id,
                'group'             => $group,
            );
            
        endforeach;
    return   json_decode(json_encode($return_array), FALSE);
    }
    
    public function hostel_refunds_head_wise_report($where=Null,$like=NULL,$date=NULL){

           $this->db->select(
                    '  
                     student_record.college_no,
                      hostel_student_bill.head_type,
                     hostel_student_bill.id,
                     hostel_refund.id as refund_id,  
                     sum(hostel_refund_detail.amount) as total_refund,  
                     hostel_refund_detail.hostel_head_id,  
                     hostel_head_title.title,  
                    
                      ');
                      
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id');
                
                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                $this->db->join('hostel_refund','hostel_refund.h_challan_id=hostel_student_bill.id');
                $this->db->join('hostel_refund_detail','hostel_refund_detail.hostel_refund_id=hostel_refund.id');
                $this->db->join('hostel_heads','hostel_heads.id=hostel_refund_detail.hostel_head_id');
                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                
                if(empty($date['from'])):
                        $this->db->where('hostel_refund.refund_date <=',date('Y-m-d', strtotime($date['to'])));
                   else:
                         $this->db->where('hostel_refund.refund_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" and "'.date('Y-m-d', strtotime($date['to'])).'"');

                   endif;
                if($where):

                    $this->db->where($where);
                endif;
               
                if($like):
                    $this->db->like($like);
                endif;
               
                $this->db->group_by('hostel_head_title.id');
                $this->db->order_by('hostel_refund.refund_date','asc');
        return  $this->db->get('student_record')->result();
   }
       public function get_lock_dates($from,$to){

          $this->db->where('lock_date BETWEEN "'.date('Y-m-d', strtotime($from)).'" AND "'.date('Y-m-d', strtotime($to)).'"');   
       return $this->db->get('hostel_brr_lock')->result();
  }
  public function hostel_new_record($where){
      
                $this->db->select('
                        student_record.student_id,
                        student_record.guardian_name,
                        student_record.applicant_mob_no1,
                        student_record.mobile_no,
                        student_record.relation_with_guardian,
                        student_record.student_name,
                        student_record.father_name,
                        applicant_edu_detail.obtained_marks,
                        applicant_edu_detail.total_marks,
                        domicile.name,
                        ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
//                $this->db->join('district','district.district_id=student_record.district_id','left outer');
                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                $this->db->order_by('applicant_edu_detail.student_id','asc');
                $this->db->limit(1,0);
        return $this->db->get_where('student_record',$where)->row();
  }
      public function NewRegisterStudentRecord($table,$where=NULL,$like=NULL){
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
        $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
        $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
        $this->db->group_by('student_record.student_id');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
//            $this->db->where('s_status_id','5');
//            $this->db->where('s_status_id','1');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    public function hostel_mess_paid_challan_change_date($where=Null,$amount=NULL,$like=NULL){
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
                        hostel_student_record.hostel_id,
                    '
                    );
            
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id');
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif; 
                $result =  $this->db->get('student_record')->result();
       
                
            
            $balance_array = array();
            foreach($result as $students):
                
                       $where_hm = array(
                            'hostel_std_id'         =>$students->hostel_id,
                            'balance >'             =>0,
                            'head_type'             =>$this->input->post("hostel_head_type"),
                            );
           
                                    $this->db->select('hostel_student_bill.id as fc_challan_id,sum(balance) as balance, valid_date as fc_dueDate');
                                    $this->db->order_by('hostel_student_bill_info.id','asc');

                                    $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                $challan_info =   $this->db->get_where('hostel_student_bill',$where_hm)->row();
                
//                $where_fee = array(
//                            'fc_student_id'         => $students->student_id,
//                            'balance >'             =>0,
//                            'delete_head_flag'      => 1
//                            );
//           
//                                $this->db->select('fc_challan_id,sum(balance) as balance,fc_dueDate');    
//                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
//                                $this->db->group_by('fc_challan_id');
//                                $this->db->order_by('fc_student_id','desc');
//            $challan_info =     $this->db->get_where('fee_challan',$where_fee)->row();
               
              if($challan_info->balance > 0):
                 
                    if($amount):
                        if($challan_info->balance>$amount):
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

