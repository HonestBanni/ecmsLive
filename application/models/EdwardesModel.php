<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class EdwardesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
 
    public function get_where_news($table,$where){
        
        $query = $this->db->select('*')
                ->from($table)
                ->join('news_images','news_images.newsId=news.news_id')
                ->where($where)
                ->get();
        if($query){
            return $query->row();
        }
    }
    public function get_notice($table,$where){
        
        $query = $this->db->select('*')
                ->from($table)
                ->join('departments','departments.dep_id=quicklinks.ql_department')
                ->where($where)
                ->get();
        if($query){
            return $query->row();
        }
    }
    
    
    
    public function get_notifications($table,$SPP,$page,$where=NULL,$order=NULL){
            $this->db->select('*');
                $this->db->FROM($table);
                $this->db->limit($SPP,$page);
                $this->db->join('departments','departments.dep_id=quicklinks.ql_department');
                if($order):
                $this->db->order_by($order['column'],$order['order']);    
                endif;
                if($where):
                    $this->db->where($where);
                endif;
           $query =      $this->db->get();
        return $query->result();
   }
  public function get_applicant_info($table,$where=NULL){
        $this->db->select('
            student_record.student_id,
            student_record.programe_id,
            student_record.sub_pro_id,
            student_record.batch_id,
            student_record.comment,
            student_record.form_no,
            student_record.college_no,
            student_record.applicant_mob_no1,
            student_record.fata_school,
            student_record.student_name,
            student_record.student_cnic,
            student_record.gender_id,
            student_record.dob,
            student_record.bg_id,
            student_record.country_id,
            student_record.domicile_id,
            student_record.district_id,
            student_record.religion_id,
            student_record.hostel_required,
            student_record.rseats_id1,
            student_record.rseats_id3,
            student_record.father_name,
            student_record.father_cnic,
            student_record.land_line_no,
            student_record.mobile_no,
            student_record.net_id,
            student_record.occ_id,
            student_record.annual_income,
            student_record.app_postal_address,
            student_record.parmanent_address,
            student_record.father_email,
            student_record.guardian_name,
            student_record.guardian_cnic,
            student_record.g_mobile_no,
            student_record.s_status_id,
            student_record.applicant_image,
            student_record.std_mobile_network,
            student_record.deficiency_flag,
            student_record.eligibility_hostel,
            student_record.data_verification_remarks,
            student_record.admission_date,
            mobile_network.network as mob_net,
            prospectus_batch.batch_name,
            programes_info.programe_name,
            sub_programes.name as sub_progam,
            reserved_seat.name as resereved_seat,
            gender.title as gender_title,
            country.name as country_title,
            district.name as district_title,
            domicile.name as domicile_title,
            blood_group.title as bld_group,
            occupation.title as father_occup,
            student_status.name as curr_status,
            religion.title as religion_title,
        ');
            $this->db->FROM($table);
            $this->db->join('mobile_network','mobile_network.net_id=student_record.net_id','left outer');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
            $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id1','left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
            $this->db->join('country','country.country_id=student_record.country_id','left outer');
            $this->db->join('district','district.district_id=student_record.district_id','left outer');
            $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
            $this->db->join('religion','religion.religion_id=student_record.religion_id','left outer');
            $this->db->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer');
            $this->db->join('occupation','occupation.occ_id=student_record.occ_id','left outer');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//            $this->db->join('yesno','yesno.yn_id=student_record.hostel_required','left outer');

            if($where):
                $this->db->where($where);
            endif;
        $query =      $this->db->get();
        return $query->row();
   }
public function get_applicant_education_info($table,$where=NULL){
        $this->db->select('
            applicant_edu_detail.total_marks,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.percentage,
            applicant_edu_detail.total_marks_9th,
            applicant_edu_detail.obtained_marks_9th,
            applicant_edu_detail.percentage_9th,
            applicant_edu_detail.app_verify_flag,
            applicant_edu_detail.degree_id as aed_degree,
            applicant_edu_detail.inst_id,
            applicant_edu_detail.bu_id as board_id,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.academic_comments,
            applicant_edu_detail.rollno,
            applicant_edu_detail.board_reg_no,
            applicant_edu_detail.lat_marks,
            applicant_edu_detail.lat_date,
            degree.title as degree_title,
            board_university.title as bu_title,
        ');
            $this->db->FROM($table);
            $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
            $this->db->join('board_university','board_university.bu_id=applicant_edu_detail.bu_id','left outer');

            if($where):
                $this->db->where($where);
            endif;
        $query =      $this->db->get();
        return $query->result();
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
 
      public function fee_challan_details($where = NULL){
              $this->db->select('
                        student_record.student_id,
                        student_record.student_name,
                        student_record.father_name,
                        student_record.form_no,
                        programes_info.programe_name,
                        sub_programes.name as sub_progam,
                        applicant_edu_detail.total_marks,
                        applicant_edu_detail.obtained_marks,
                        applicant_edu_detail.app_verify_flag,
                        applicant_edu_detail.total_marks_9th,
                        applicant_edu_detail.obtained_marks_9th,
                        applicant_edu_detail.percentage_9th,
                        prospectus_batch.batch_name,
                        programes_info.programe_id,
                        prospectus_challan.pros_challan_id,
                        prospectus_challan.due_date,
                        prospectus_fee_head.title,
                        prospectus_fee_head.amount,
                    ');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
              $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
              $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
              $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
              $this->db->join('prospectus_challan','prospectus_challan.student_id=student_record.student_id');
              
              $this->db->join('prospectus_fee_head','prospectus_fee_head.pros_fee_head_id=prospectus_challan.pros_fee_id','left outer');
              
       return $this->db->get_where('student_record',$where)->row();
       
       
   }
public function student_fee_sms($where=Null,$like=NULL,$std_no=NULL,$date=NULL,$document=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.mobile_no,
                        student_record.applicant_mob_no1,
                        student_record.student_name,
                        student_record.s_status_id,
                        student_record.applicant_image,
                        student_record.father_name,
                        student_record.timestamp ,
                        sections.name as sessionName, 
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                       applicant_edu_detail.percentage,
                       applicant_edu_detail.obtained_marks,
                       applicant_edu_detail.total_marks,
                       applicant_edu_detail.app_verify_flag,
                       applicant_edu_detail.total_marks_9th,
                       applicant_edu_detail.obtained_marks_9th,
                        prospectus_batch.batch_name, 
                        degree.title as DegreeTitle, 
                    ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');     
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                $this->db->join("shift","shift.shift_id=student_record.shift_id",'left outer'); 
//                $this->db->join("student_documents","student_documents.sd_student_id=student_record.student_id",'left outer'); 
                if($std_no['std_no_from'] == ''):
                   $this->db->where('applicant_edu_detail.obtained_marks <=',$std_no['std_no_to']);
                    else:
                     $this->db->where('applicant_edu_detail.obtained_marks BETWEEN "'.$std_no['std_no_from'].'" AND "'.$std_no['std_no_to'].'"');   
                endif;
                
                if($std_no['std_no_from_9th'] == ''):
                   $this->db->where('applicant_edu_detail.obtained_marks_9th <=',$std_no['std_no_to_9th']);
                    else:
                     $this->db->where('applicant_edu_detail.obtained_marks_9th BETWEEN "'.$std_no['std_no_from_9th'].'" AND "'.$std_no['std_no_to_9th'].'"');   
                endif;
                
                if($date['entry_date_from'] == ''):
                   $this->db->where('date_format(student_record.timestamp,"%Y-%m-%d") <=',date('Y-m-d',strtotime($date['entry_date_to'])));
                    else:
                     $this->db->where('date_format(student_record.timestamp,"%Y-%m-%d") BETWEEN "'.date('Y-m-d',strtotime($date['entry_date_from'])).'" AND "'.date('Y-m-d',strtotime($date['entry_date_to'])).'"');   
                endif;
               if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('percentage','desc');
                $this->db->order_by('student_record.student_name','asc');
                 $this->db->order_by('form_no','asc');
                 
//       return $this->db->get('student_record')->result();
       $result =  $this->db->get('student_record')->result();
       
       
       if($result):
           $return_array = '';
        foreach($result as $row):
                 $challan_paid_flag = $this->db->get_where('student_documents',array('sd_student_id'=>$row->student_id,'sd_flag'=>1))->row();
               switch ($document['challan_upload']):
                     case "":
                         $return_array[] = array(
                                'student_id'           =>$row->student_id,  
                                'student_name'         =>$row->student_name, 
                                'college_no'           =>$row->college_no, 
                                'form_no'              =>$row->form_no, 
                                'father_name'          =>$row->father_name, 
                                'applicant_mob_no1'    =>$row->applicant_mob_no1, 
                                'mobile_no'            =>$row->mobile_no, 
                                'obtained_marks_9th'   =>$row->obtained_marks_9th, 
                                'total_marks_9th'      =>$row->total_marks_9th, 
                                'obtained_marks'       =>$row->obtained_marks, 
                                'total_marks'          =>$row->total_marks, 
                                'percentage'           =>$row->percentage, 
                                'timestamp'            =>$row->timestamp, 
                                'app_verify_flag'      =>$row->app_verify_flag, 
                                'applicant_image'      =>$row->applicant_image, 
                                'DegreeTitle'           =>$row->DegreeTitle, 

                              );
                             
                        break;
                     case "1": //yes
                         if(!empty($challan_paid_flag)):
                             
                            $return_array[] = array(
                                'student_id'           =>$row->student_id,  
                                'student_name'         =>$row->student_name, 
                                'college_no'           =>$row->college_no, 
                                'form_no'              =>$row->form_no, 
                                'father_name'          =>$row->father_name, 
                                'applicant_mob_no1'    =>$row->applicant_mob_no1, 
                                'mobile_no'            =>$row->mobile_no, 
                                'obtained_marks_9th'   =>$row->obtained_marks_9th, 
                                'total_marks_9th'      =>$row->total_marks_9th, 
                                'obtained_marks'       =>$row->obtained_marks, 
                                'total_marks'          =>$row->total_marks, 
                                'percentage'           =>$row->percentage, 
                                'timestamp'            =>$row->timestamp, 
                                'app_verify_flag'      =>$row->app_verify_flag, 
                                'applicant_image'      =>$row->applicant_image,
                                'DegreeTitle'           =>$row->DegreeTitle, 

                              );
                        endif;
                        break;
                     case "2": //No
                         if(empty($challan_paid_flag)):
                             
                            $return_array[] = array(
                                'student_id'           =>$row->student_id,  
                                'student_name'         =>$row->student_name, 
                                'college_no'           =>$row->college_no, 
                                'form_no'              =>$row->form_no, 
                                'father_name'          =>$row->father_name, 
                                'applicant_mob_no1'    =>$row->applicant_mob_no1, 
                                'mobile_no'            =>$row->mobile_no, 
                                'obtained_marks_9th'   =>$row->obtained_marks_9th, 
                                'total_marks_9th'      =>$row->total_marks_9th, 
                                'obtained_marks'       =>$row->obtained_marks, 
                                'total_marks'          =>$row->total_marks, 
                                'percentage'           =>$row->percentage, 
                                'timestamp'            =>$row->timestamp, 
                                'app_verify_flag'      =>$row->app_verify_flag, 
                                'applicant_image'      =>$row->applicant_image,
                                'DegreeTitle'           =>$row->DegreeTitle, 

                              );
                        endif;
                        break;
                     
               endswitch;
        endforeach;
           
           return  json_decode(json_encode($return_array), FALSE);

       endif;
         
    }    

}
