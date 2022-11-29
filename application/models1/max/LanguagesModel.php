<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class LanguagesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    
      public function language_student_records($table,$where=NULL,$like=NULL,$custom=NULL){
       
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
   
      public function language_pagination($SPP,$page,$where,$order=NULL){
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
        
        $this->db->order_by('student_record.student_id','desc');            
        if($order):
            $this->db->order_by($order['column'],$order['order']);    
        endif;
        $query = $this->db->get();
        return $query->result();
   }
      public function export_language_students($table,$where=NULL,$like=NULL,$custom=NULL){
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
}

