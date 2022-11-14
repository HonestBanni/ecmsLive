<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class DashboardModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    public function admin_grand_report($table,$where=NULL,$like=NULL,$custom=NULL,$where_in=NULL,$date){
        
                 $this->db->select('
                      student_record.student_id,
                      student_record.college_no,
                      student_record.applicant_image,
                      student_record.student_name,
                      reserved_seat.name as Open_Merit,
                      student_record.rseats_id1 as R_Seat1,
                      student_record.rseats_id2 as Admission_In,
                      student_record.rseats_id3 as R_Seat2,
                      student_status.name as student_statusName,
                      gender.title as genderName,
                      student_record.admission_comment,
                      student_record.hostel_required,
                      student_record.comment,
                      student_record.father_name,
                      student_record.form_no,
                      student_record.timestamp,
                      student_record.challan_print_flag,
                      programes_info.programe_name,
                      sub_programes.name as subprogram,
                      board_university.title as bu_title,
                      prospectus_batch.batch_name,
                      applicant_edu_detail.total_marks,
                      applicant_edu_detail.obtained_marks,
                      applicant_edu_detail.academic_comments,
                      applicant_edu_detail.percentage,
                      sections.sec_id,
                      sections.name as sectionName,
                      domicile.name,
                      admission_date,
                      college_no,
                      shift.name as shift_name,
                      hostel_student_record.hostel_id as hostelRecord,
                      data_verification_remarks.comments,
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
        $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;
        $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id','left outer');
        $this->db->join('data_verification_remarks','data_verification_remarks.id=student_record.data_verification_remarks','left outer');
         
        
        if($like):
             $this->db->like($like);
        endif;
        $this->db->group_by('student_record.student_id');
        $this->db->order_by($custom['column'],$custom['order']);
        $this->db->order_by('form_no','asc');
//                $this->db->where('applicant_edu_detail.sub_pro_id','0');
    if($where_in):
        $this->db->where_in('year_of_passing',array('2018','0'));
    endif;
    if($where):
        $this->db->where($where);
        //$this->db->where('student_record.applicant_image !=','');
    endif;
    
    if(empty($date['fromDate'])):
           $this->db->where('student_record.admission_date <=',date('Y-m-d', strtotime($date['toDate'])));
            else:
             $this->db->where('student_record.admission_date BETWEEN "'.date('Y-m-d', strtotime($date['fromDate'])).'" AND "'.date('Y-m-d', strtotime($date['toDate'])).'"');   
    endif;
    
    $result =  $this->db->get($table)->result();
//            echo '<pre>';print_r($result);die;
    $return_array = '';
    if($result):
        foreach($result as $row):
        
        
        $hsote_recrd = $this->db->get_where('hostel_student_record',array('hostel_student_record.student_id'=>$row->student_id,'new_admission_flag'=>1))->row();
        $hoste_status = '';
        
        
       if($custom['hostel'] == 0):
            if(empty($hsote_recrd)):
                $hoste_status = 'No';
                else:
                $hoste_status = 'Yes';
            endif;
            $return_array[] = array(
                'student_id'        => $row->student_id,  
                'sectionName'       => $row->sectionName,  
                'college_no'        => $row->college_no,  
                'applicant_image'   => $row->applicant_image,  
                'student_name'      => $row->student_name,  
                'Open_Merit'        => $row->Open_Merit,
                'R_Seat1'           => $row->R_Seat1,  
                'R_Seat2'           => $row->R_Seat2,  
                'Admission_In'      => $row->Admission_In,  
                'student_statusName'=> $row->student_statusName,  
                'genderName'        => $row->genderName,  
                'admission_comment' => $row->admission_comment,  
                'hostel_required'   => $row->hostel_required,  
                'father_name'       => $row->father_name,  
                'form_no'           => $row->form_no,  
                'programe_name'     => $row->programe_name,  
                'subprogram'        => $row->subprogram,  
                'bu_title'          => $row->bu_title,  
                'batch_name'        => $row->batch_name,  
                'total_marks'       => $row->total_marks,  
                'obtained_marks'    => $row->obtained_marks,  
                'percentage'        => $row->percentage,  
                'sec_id'            => $row->sec_id,  
                'shift_name'        => $row->shift_name,  
                'admission_date'    => $row->admission_date,  
                'comments'          => $row->comments,  
                'academic_comments' => $row->academic_comments,  
                'challan_print_flag' => $row->challan_print_flag,  
                'hostelRecord'      => $hoste_status,
                 'timestamp'         => date('d-m-Y H:i:s',strtotime($row->timestamp)),
               );
           
       endif; 
       if($custom['hostel'] == 1):
            if(!empty($hsote_recrd)):
                $hoste_status = 'Yes';
            
           
            $return_array[] = array(
                'student_id'        => $row->student_id,  
                'college_no'        => $row->college_no,  
                'applicant_image'   => $row->applicant_image,  
                'student_name'      => $row->student_name,  
                'Open_Merit'        => $row->Open_Merit,
                'R_Seat1'           => $row->R_Seat1,  
                'R_Seat2'           => $row->R_Seat2,  
                'Admission_In'      => $row->Admission_In,
                'student_statusName'=> $row->student_statusName,  
                'genderName'        => $row->genderName,  
                'admission_comment' => $row->admission_comment,  
                'hostel_required'   => $row->hostel_required,  
                'father_name'       => $row->father_name,  
                'form_no'           => $row->form_no,  
                'programe_name'     => $row->programe_name,  
                'subprogram'        => $row->subprogram,  
                'bu_title'          => $row->bu_title,  
                'batch_name'        => $row->batch_name,  
                'total_marks'       => $row->total_marks,  
                'obtained_marks'    => $row->obtained_marks,  
                'percentage'        => $row->percentage,  
                'sec_id'            => $row->sec_id,  
                'shift_name'        => $row->shift_name,  
                'admission_date'    => $row->admission_date,  
                'hostelRecord'      => $hoste_status,
                'sectionName'       => $row->sectionName,
                'challan_print_flag'=> $row->challan_print_flag,
                'comments'          => $row->comments,  
                'academic_comments' => $row->academic_comments,
                 'timestamp'         => date('d-m-Y H:i:s',strtotime($row->timestamp)),
               );
           
       endif; 
        endif; 
       if($custom['hostel'] == 2):
            if(empty($hsote_recrd)):
                $hoste_status = 'No';
            
           
            $return_array[] = array(
                'student_id'        => $row->student_id,  
                'college_no'        => $row->college_no,  
                'applicant_image'   => $row->applicant_image,  
                'student_name'      => $row->student_name,  
                'Open_Merit'        => $row->Open_Merit,
                'R_Seat1'           => $row->R_Seat1,  
                'R_Seat2'           => $row->R_Seat2,  
                'Admission_In'      => $row->Admission_In,
                'student_statusName'=> $row->student_statusName,  
                'genderName'        => $row->genderName,  
                'admission_comment' => $row->admission_comment,  
                'hostel_required'   => $row->hostel_required,  
                'father_name'       => $row->father_name,  
                'form_no'           => $row->form_no,  
                'programe_name'     => $row->programe_name,  
                'subprogram'        => $row->subprogram,  
                'bu_title'          => $row->bu_title,  
                'batch_name'        => $row->batch_name,  
                'total_marks'       => $row->total_marks,  
                'obtained_marks'    => $row->obtained_marks,  
                'percentage'        => $row->percentage,  
                'sec_id'            => $row->sec_id,  
                'shift_name'        => $row->shift_name,  
                'admission_date'    => $row->admission_date,  
                'hostelRecord'      => $hoste_status, 
                'sectionName'       => $row->sectionName,
                'comments'          => $row->comments,
                'challan_print_flag'=> $row->challan_print_flag,
                'academic_comments' => $row->academic_comments,
                 'timestamp'         => date('d-m-Y H:i:s',strtotime($row->timestamp)),
               );
           
       endif; 
        endif; 
        
      
        endforeach;
        
        
             if(!empty($return_array)):
                    $keys   = array_column($return_array, 'percentage');
                    array_multisort($keys, SORT_DESC, $return_array);
                    return      json_decode(json_encode($return_array), FALSE);
            else:
                    return false;
            endif;
        
        
        
//        return  json_decode(json_encode($return_array), FALSE);
    endif;
    
}
       public function admin_grand_report_excel($table,$where=NULL,$like=NULL,$custom=NULL,$date){
        
           
        $this->db->SELECT('
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as OpenMerit,
                student_record.rseats_id1 as R_Seat1,
                student_record.rseats_id3 as R_Seat2,
                student_record.rseats_id2 as Admission_In,
                prospectus_batch.batch_name,
                sections.name,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                applicant_edu_detail.lat_marks,
                applicant_edu_detail.lat_date,
                student_record.admission_comment,
                student_record.comment,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                student_record.applicant_mob_no1,
                student_record.challan_print_flag,
                student_record.timestamp,
                religion.title as religion,
                student_record.app_postal_address as Address,
                student_record.mobile_no as Mobile,
                blood_group.title,
                student_record.father_cnic,
                last_school_address,
                remarks,
                remarks2,
                country.name as countryName,
                shift.name as ShiftName,
                student_record.student_cnic, 
                data_verification_remarks.comments,
                applicant_edu_detail.academic_comments,
                applicant_edu_detail.inst_id as school_name,
                applicant_edu_detail.rollno,
                applicant_edu_detail.board_reg_no,
                applicant_edu_detail.total_marks_9th,
                applicant_edu_detail.obtained_marks_9th,
                applicant_edu_detail.percentage_9th,
                student_record.hostel_required,
                applicant_edu_detail.year_of_passing,
                student_record.student_email,
                 ');
                $this->db->from($table);
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
                $this->db->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer') ; 
                $this->db->join('country','country.country_id=student_record.country_id','left outer') ; 
                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;
                $this->db->join('data_verification_remarks','data_verification_remarks.id=student_record.data_verification_remarks','left outer');
          
            if($like):
                $this->db->like($like);
            endif;
              if(empty($date['fromDate'])):
                   $this->db->where('student_record.admission_date <=',date('Y-m-d', strtotime($date['toDate'])));
                    else:
                     $this->db->where('student_record.admission_date BETWEEN "'.date('Y-m-d', strtotime($date['fromDate'])).'" AND "'.date('Y-m-d', strtotime($date['toDate'])).'"');   
            endif;
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('admission_date','desc');
            $this->db->group_by('student_record.student_id');
//            $this->db->where('applicant_edu_detail.sub_pro_id','0');
            
            if($where):
                $this->db->where($where);
            endif;
          
            $result =  $this->db->get()->result();
            $return_array = array();
            $sn = '';
            foreach($result as $row):
                $sn++;
            $R_Seat1   = "";  
            if(!empty($row->R_Seat1)):
                $check_Seat1    = $this->db->select('name as R_Seat1')->where(array('rseat_id'=>$row->R_Seat1))->get('reserved_seat')->row();
                $R_Seat1        = $check_Seat1->R_Seat1;
            endif;
            $R_Seat2   = "";  
            if(!empty($row->R_Seat2)):
                $check_Seat2    = $this->db->select('name as R_Seat2')->where(array('rseat_id'=>$row->R_Seat2))->get('reserved_seat')->row();
                $R_Seat2        = $check_Seat2->R_Seat2;
            endif;
            
            $Admission_In   = ""; 
            if(!empty($row->Admission_In)):
                $check2         = $this->db->select('name as Admission_In')->where(array('rseat_id'=>$row->Admission_In))->get('reserved_seat')->row();
                $Admission_In   = $check2->Admission_In;
            endif;
            $hsote_recrd = $this->db->get_where('hostel_student_record',array('hostel_student_record.student_id'=>$row->student_id,'new_admission_flag'=>1))->row();
                $hoste_status = '';
                $print_flag = '';
               if($row->challan_print_flag == 1):
                   $print_flag = 'Yes';
                   else:
                   $print_flag = 'No';
               endif; 
                
               if($custom['hostel'] == 0):
                    if(empty($hsote_recrd)):
                        $hoste_status = 'No';
                        else:
                        $hoste_status = 'Yes';
                    endif;
            $challan_paid_flag = $this->db->get_where('student_documents',array('sd_student_id'=>$row->student_id,'sd_flag'=>1))->row(); 
            $challanPaidFlag = 'No';
            if(!empty($challan_paid_flag)):
                $challanPaidFlag = 'Yes';
            endif;
            $DMCFlag    = $this->db->get_where('student_documents',array('sd_student_id'=>$row->student_id,'sd_flag'=>2))->row(); 
            $DMC_Flag = 'No';
            if(!empty($DMCFlag)):
                $DMC_Flag = 'Yes';
            endif;
            $return_array[] = array(
                'student_id'        => $sn,
                'form_no'           => $row->form_no,
                'college_no'        => $row->college_no,
                'student_name'      => $row->student_name,
                'father_name'       => $row->father_name,
                'genderName'        => $row->genderName,
                'programe_name'     => $row->programe_name,
                'subprogram'        => $row->subprogram,
                'OpenMerit'         => $row->OpenMerit,
                'R_Seat1'           => $R_Seat1,
                'R_Seat2'           => $R_Seat2,
                'Admission_In'      => $Admission_In,
                'batch_name'        => $row->batch_name,
                'name'              => $row->name,
                'fata_school'       => $row->fata_school,
                'domicileName'      => $row->domicileName,
                'total_marks'       => $row->total_marks,
                'obtained_marks'    => $row->obtained_marks,
                'percentage'        => $row->percentage,
                'lat_marks'         => $row->lat_marks,
                'lat_date'          => date('d-m-Y',strtotime($row->lat_date)),
                'admission_comment' => $row->admission_comment,
                'comment'           => $row->comment,
                'student_statusName'=> $row->student_statusName,
                'admission_date'    => $row->admission_date,
                'religion'          => $row->religion,
                'Address'           => $row->Address,
                'Mobile'            => $row->Mobile,
                'title'             => $row->title,
                'father_cnic'      => $row->father_cnic,
                'last_school_address' => $row->last_school_address,
                'remarks'           => $row->remarks,
                'remarks2'          => $row->remarks2,
                'countryName'       => $row->countryName,
                'ShiftName'         => $row->ShiftName,
                'hoste_status'      => $hoste_status,
                'applicant_mob_no1' => $row->applicant_mob_no1,
                'student_record'    => $row->student_cnic,
                'comments'          => $row->comments,
                'academic_comments' => $row->academic_comments,
                'timestamp'         => date('d-m-Y H:i:s',strtotime($row->timestamp)),
                'challan_print_flag'=> $print_flag,
                'paid_challan'      => $challanPaidFlag,
                'DMC_Flag'          => $DMC_Flag,
                'rollno'            => $row->rollno,
                'board_reg_no'      => $row->board_reg_no,
                'school_name'       => $row->school_name,     
                'total_marks_9th'       => $row->total_marks_9th,     
                'obtained_marks_9th'       => $row->obtained_marks_9th,     
                'percentage_9th'       => $row->percentage_9th,     
                'hostel_required'       => $row->hostel_required,     
                'year_of_passing'       => $row->year_of_passing,     
                'student_email'       => $row->student_email,     
                 );
               endif;
               if($custom['hostel'] == 1):
                    if(!empty($hsote_recrd)):
                        $hoste_status = 'Yes';
                        $return_array[] = array(
                                'student_id'        => $sn,
                                'form_no'           => $row->form_no,
                                'college_no'        => $row->college_no,
                                'student_name'      => $row->student_name,
                                'father_name'       => $row->father_name,
                                'genderName'        => $row->genderName,
                                'programe_name'     => $row->programe_name,
                                'subprogram'        => $row->subprogram,
                                'OpenMerit'         => $row->OpenMerit,
                                'R_Seat1'           => $R_Seat1,
                                'R_Seat2'           => $R_Seat2,
                                'Admission_In'      => $Admission_In,
                                'batch_name'        => $row->batch_name,
                                'name'              => $row->name,
                                'fata_school'       => $row->fata_school,
                                'domicileName'      => $row->domicileName,
                                'total_marks'       => $row->total_marks,
                                'obtained_marks'    => $row->obtained_marks,
                                'percentage'        => $row->percentage,
                                'lat_marks'         => $row->lat_marks,
                                'lat_date'          => date('d-m-Y',strtotime($row->lat_date)),
                                'admission_comment' => $row->admission_comment,
                                'comment'           => $row->comment,
                                'student_statusName'=> $row->student_statusName,
                                'admission_date'    => $row->admission_date,
                                'religion'          => $row->religion,
                                'Address'           => $row->Address,
                                'Mobile'            => $row->Mobile,
                                'title'             => $row->title,
                                'father_cnic'       => $row->father_cnic,
                                'last_school_address' => $row->last_school_address,
                                'remarks'           => $row->remarks,
                                'remarks2'          => $row->remarks2,
                                'countryName'       => $row->countryName,
                                'ShiftName'         => $row->ShiftName,
                                'hoste_status'      => $hoste_status,
                                'applicant_mob_no1' => $row->applicant_mob_no1,
                                'student_record'    => $row->student_cnic,
                                'comments'          => $row->comments,
                                'academic_comments' => $row->academic_comments,
                                'timestamp'         => date('d-m-Y H:i:s',strtotime($row->timestamp)),
                                'challan_print_flag'=> $print_flag,
                                'paid_challan'      => $challanPaidFlag,
                                'DMC_Flag'          => $DMC_Flag,
                                'rollno'            => $row->rollno,
                                'board_reg_no'      => $row->board_reg_no,
                                'school_name'       => $row->school_name,
                                'total_marks_9th'       => $row->total_marks_9th,     
                                'obtained_marks_9th'       => $row->obtained_marks_9th,     
                                'percentage_9th'       => $row->percentage_9th,  
                                'hostel_required'       => $row->hostel_required,
                                'year_of_passing'       => $row->year_of_passing,
                                'student_email'       => $row->student_email,
                            
                            
                                 );
                    endif;
               endif;
               if($custom['hostel'] == 2):
                    if(empty($hsote_recrd)):
                        $hoste_status = 'No';
                        $return_array[] = array(
                                'student_id'        => $sn,
                                'form_no'           => $row->form_no,
                                'college_no'        => $row->college_no,
                                'student_name'      => $row->student_name,
                                'father_name'       => $row->father_name,
                                'genderName'        => $row->genderName,
                                'programe_name'     => $row->programe_name,
                                'subprogram'        => $row->subprogram,
                                'OpenMerit'         => $row->OpenMerit,
                                'R_Seat1'           => $R_Seat1,
                                'R_Seat2'           => $R_Seat2,
                                'Admission_In'      => $Admission_In,
                                'batch_name'        => $row->batch_name,
                                'name'              => $row->name,
                                'fata_school'       => $row->fata_school,
                                'domicileName'      => $row->domicileName,
                                'total_marks'       => $row->total_marks,
                                'obtained_marks'    => $row->obtained_marks,
                                'percentage'        => $row->percentage,
                                'lat_marks'         => $row->lat_marks,
                                'lat_date'          => date('d-m-Y',strtotime($row->lat_date)),
                                'admission_comment' => $row->admission_comment,
                                'comment'           => $row->comment,
                                'student_statusName'=> $row->student_statusName,
                                'admission_date'    => $row->admission_date,
                                'religion'          => $row->religion,
                                'Address'           => $row->Address,
                                'Mobile'            => $row->Mobile,
                                'title'             => $row->title,
                                'father_cnic'       => $row->father_cnic,
                                'last_school_address' => $row->last_school_address,
                                'remarks'           => $row->remarks,
                                'remarks2'          => $row->remarks2,
                                'countryName'       => $row->countryName,
                                'ShiftName'         => $row->ShiftName,
                                'hoste_status'      => $hoste_status,
                                'applicant_mob_no1' => $row->applicant_mob_no1,
                                'student_record'    => $row->student_cnic,
                                'comments'          => $row->comments,
                                'academic_comments' => $row->academic_comments,
                                'timestamp'         => date('d-m-Y H:i:s',strtotime($row->timestamp)),
                                'challan_print_flag'=> $print_flag,
                                'paid_challan'      => $challanPaidFlag,
                                'DMC_Flag'          => $DMC_Flag,
                                'rollno'            => $row->rollno,
                                'board_reg_no'      => $row->board_reg_no,
                                'school_name'       => $row->school_name,
                                'total_marks_9th'   => $row->total_marks_9th,     
                                'obtained_marks_9th'=> $row->obtained_marks_9th,     
                                'percentage_9th'    => $row->percentage_9th,
                                'hostel_required'   => $row->hostel_required,
                                'year_of_passing'   => $row->year_of_passing,
                                'student_email'       => $row->student_email,
                                 );
                    endif;
               endif;
       // echo '<pre>';print_r($return_array);die;
        endforeach;
        
        
             if(!empty($return_array)):
                    $keys   = array_column($return_array, 'percentage');
                    array_multisort($keys, SORT_DESC, $return_array);
                    return $return_array;
//                    return      json_decode(json_encode($return_array), FALSE);
            else:
                    return false;
            endif;
        
        
        
//        
      // return  json_decode(json_encode($return_array), FALSE);
       }
        public function stduent_data_verifications($where=NULL,$like=NULL){
            $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.fata_school,
                student_record.hostel_required,
                student_record.father_name,
                student_record.college_no,
                student_record.s_status_id,
                student_record.applicant_image,
                student_record.board_regno,
                student_record.uni_regno,
                student_record.timestamp,
                programes_info.programe_name as program_name,
                sub_programes.name as sub_program,
                sub_programes.sub_pro_id as sub_pro_id,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_status.name as status,
                applicant_edu_detail.percentage 
                ');
            
            $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
            $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
            $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.timestamp >= date_sub(now(),interval 4 month)');
            $this->db->order_by('student_record.student_id','desc');
            $this->db->group_by('student_record.student_id');
    return $this->db->get('student_record')->result();
       }
       
    public function data_verification_pagination($SPP,$page,$where=NULL){
            $this->db->SELECT('
                student_group_allotment.serial_no,
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.fata_school,
                student_record.hostel_required,
                student_record.father_name,
                student_record.sub_pro_id,
                student_record.s_status_id,
                student_record.college_no,
                student_record.applicant_image,
                student_record.timestamp,
                sections.name as section,
                programes_info.programe_name as program_name,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                gender.title as gender,
                student_record.board_regno,
                student_record.uni_regno,
                student_status.name as status,
                applicant_edu_detail.percentage 
                ');
        $this->db->FROM('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        
        $this->db->limit($SPP,$page);
        $this->db->order_by('student_id','desc');    
        $this->db->where_in('student_record.s_status_id',array('15','1'));
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where('student_record.timestamp >= date_sub(now(),interval 4 month)');
        $this->db->group_by('student_record.student_id');
        return $this->db->get()->result();
   }
                     
      public function fee_verification_report($where=NULL,$like,$date){
        $this->db->SELECT('
                student_record.form_no,
                student_record.student_id,
                student_record.student_name,
                student_record.fata_school,
                student_record.hostel_required,
                student_record.father_name,
                student_record.sub_pro_id,
                student_record.s_status_id,
                student_record.college_no,
                student_record.applicant_image,
                sub_programes.name as sub_program,
                prospectus_batch.batch_name as batch,
                student_record.board_regno,
                student_record.uni_regno,
                student_status.name as status,
                prospectus_challan.paid_date, 
                prospectus_challan.staffChild_flag, 
                prospectus_challan.pros_amount, 
                prospectus_challan.pros_paid_by, 
                hr_emp_record.emp_name, 
                ');
//        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
//        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('prospectus_challan','prospectus_challan.student_id=student_record.student_id');
        $this->db->join('users','users.id=prospectus_challan.pros_paid_by');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
        
          
        $this->db->where('prospectus_challan.paid_date BETWEEN "'.date('Y-m-d', strtotime($date['PaidFrom'])).'" AND "'.date('Y-m-d', strtotime($date['PaidTo'])).'"');   
        $this->db->order_by('form_no','asc');    
        if($where):
            $this->db->where($where);
        endif;
        $this->db->group_by('student_record.student_id');
        return $this->db->get('student_record')->result();
   }
      public function fee_verification_report_date_wise($where=NULL,$like,$date){
          
 
        $this->db->SELECT('
                
                prospectus_challan.paid_date as paid_date,
                sum(pros_amount) as Amount,
                count(student_record.student_id) as TotalStudents,
                ');

                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
                $this->db->join('prospectus_challan','prospectus_challan.student_id=student_record.student_id');
                $this->db->join('users','users.id=prospectus_challan.pros_paid_by');
                $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                
                $this->db->where('prospectus_challan.paid_date BETWEEN"'.date('Y-m-d', strtotime($date['PaidFrom'])).'" AND "'.date('Y-m-d', strtotime($date['PaidTo'])).'"');   
                $this->db->order_by('prospectus_challan.paid_date','asc');    
                if($where):
                    $this->db->where($where);
                endif;

                $this->db->group_by('prospectus_challan.paid_date');
                return $this->db->get('student_record')->result();
                     
        
   }
   function dropDownPaidBy($option=NULL, $value,$show,$where=NULL){
 
                        $this->db->join('users','users.id=prospectus_challan.pros_paid_by');
                        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');   
            $query =    $this->db->get('prospectus_challan');

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
    
    public function get_merit_list($table, $where=NULL){
        
        $this->db->SELECT('
            student_record.form_no,
            student_record.student_id,
            reserved_seat.name as open_merit,
            student_record.student_name,
            student_record.father_name,
            student_record.father_cnic,
            student_record.batch_id as st_batch_id,
            student_record.rseats_id1,
            student_record.rseats_id3,
            student_record.hostel_required,
            gender.title as gender_title,
            sub_programes.name as sub_program,
            prospectus_batch.batch_name as batch,
            applicant_edu_detail.obtained_marks,
            applicant_edu_detail.total_marks,
            applicant_edu_detail.percentage,
        ');
        
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id', 'left outer');
        
        $this->db->order_by('applicant_edu_detail.obtained_marks', 'desc');
        
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
        
   }
   
   public function get_final_merit_list($table, $where=NULL, $limit=NULL){
        
        $this->db->SELECT('*');
        $this->db->FROM($table);
        
        $this->db->order_by('serial_in_merit_list', 'asc');
        
        if($where):
            $this->db->where($where);
        endif;
        if(!empty($limit)):
            $this->db->limit(@$limit['limit'],@$limit['start']);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
        
   }
   
   public function get_hostel_merit_list($table, $where=NULL){
        
        $this->db->SELECT('
            form_no,
            student_name,
            father_name,
            applied_for,
            ml_batch_id,
            gender,
            obtained_marks,
            total_marks,
            percentage,
            interview_date,
            interview_time
        ');
        $this->db->FROM($table);
        
        $this->db->order_by('serial_in_merit_list', 'asc');
        
        if($where):
            $this->db->where($where);
        endif;
        
        $query          =  $this->db->get()->result();
        $return_array   = array();
        
        if($query):
            $serail = 0;
            foreach($query as $qrw):
                $serail++;
                $return_array[] = array(
                    'serial_no'         => $serail,
                    'form_no'           => $qrw->form_no,
                    'student_name'      => $qrw->student_name,
                    'father_name'       => $qrw->father_name,
                    'gender'            => $qrw->gender,
                    'applied_for'       => $qrw->applied_for,
                    'obtained_marks'    => $qrw->obtained_marks,
                    'total_marks'       => $qrw->total_marks,
                    'percentage'        => $qrw->percentage,
                    'interview_date'    => $qrw->interview_date,
                    'interview_time'    => $qrw->interview_time,
                );
            endforeach;
            return $return_array;
        endif;
        
   }
   
   public function get_quota_merit_list($table, $where=NULL, $limit=NULL){
        
        $this->db->SELECT('
            serial_in_merit_list,
            form_no,
            student_name,
            father_name,
            applied_for,
            ml_batch_id,
            gender,
            obtained_marks,
            total_marks,
            percentage,
            reserved_seat1,
            interview_date,
            interview_time
        ');
        $this->db->FROM($table);
        
        $this->db->order_by('serial_in_merit_list', 'asc');
        
        if($where):
            $this->db->where($where);
        endif;
        if(!empty($limit)):
            $this->db->limit(@$limit['limit'],@$limit['start']);
        endif;
        
        $query          =  $this->db->get()->result();
        $return_array   = array();
        
        if($query):
            foreach($query as $qrw):
                $return_array[] = array(
                    'serial_no'         => $qrw->serial_in_merit_list,
                    'form_no'           => $qrw->form_no,
                    'student_name'      => $qrw->student_name,
                    'father_name'       => $qrw->father_name,
                    'gender'            => $qrw->gender,
                    'applied_for'       => $qrw->applied_for,
                    'obtained_marks'    => $qrw->obtained_marks,
                    'total_marks'       => $qrw->total_marks,
                    'percentage'        => $qrw->percentage,
                    'reserved_seat1'    => $qrw->reserved_seat1,
                    'interview_date'    => $qrw->interview_date,
                    'interview_time'    => $qrw->interview_time,
                );
            endforeach;
            return $return_array;
        endif;
        
   }
      public function get_applicant_info($table,$where=NULL){
        $this->db->select('
            student_record.student_id,
            student_record.sub_pro_id,
            student_record.comment,
            student_record.form_no,
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
            applicant_edu_detail.inst_id,
            applicant_edu_detail.exam_type,
            applicant_edu_detail.year_of_passing,
            applicant_edu_detail.academic_comments,
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
                        student_record.student_name,
                        student_record.father_name,
                        programes_info.programe_name,
                        sub_programes.name as sub_progam,
                        applicant_edu_detail.total_marks,
                        applicant_edu_detail.obtained_marks,
                        prospectus_batch.batch_name,
                        prospectus_challan.pros_challan_id,
                        prospectus_challan.due_date,
                        prospectus_fee_head.title,
                        prospectus_fee_head.amount,
                    ');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
              $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
              $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
              $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
              $this->db->join('prospectus_challan','prospectus_challan.student_id=student_record.student_id','left outer');
              
              $this->db->join('prospectus_fee_head','prospectus_fee_head.pros_fee_head_id=prospectus_challan.pros_fee_id','left outer');
              
       return $this->db->get_where('student_record',$where)->row();
       
       
   }
   public function student_fee_sms($where=Null,$like=NULL,$std_no=NULL,$date=NULL,$custom=NULL){
       
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
                        sub_programes.name as subprogram,
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
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id','left outer');
//                $this->db->join("student_documents","student_documents.sd_student_id=student_record.student_id",'left outer'); 
                
                if($custom['college_no_from'] == ''  && $custom['college_no_to'] != ''): //if college no from is empty then less then to number
                    $this->db->where('student_record.college_no <=',$custom['college_no_to']); 
                endif;
                if($custom['college_no_from'] != '' && $custom['college_no_to'] != ''):
                    $this->db->where('student_record.college_no BETWEEN "'.$custom['college_no_from'].'" AND "'.$custom['college_no_to'].'"');
                endif;
                
                     
                
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
                if(empty($date['entry_date_from'])):
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
                 
       $balance_array = $this->db->get('student_record')->result();
       
       
            if(!empty($balance_array)):
                    $keys   = array_column($balance_array, 'percentage');
                    array_multisort($keys, SORT_DESC, $balance_array);
                    return      json_decode(json_encode($balance_array), FALSE);
                    else:
                    return false;
            endif;
         
    }   
   public function student_fee_sms_language($where=Null,$like=NULL,$std_no=NULL,$date=NULL,$custom=NULL){
       
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
                $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id','left outer');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                $this->db->join("shift","shift.shift_id=student_record.shift_id",'left outer'); 
                if(empty($date['entry_date_from'])):
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
                 
       return $this->db->get('student_record')->result();
         
    }   
                     
    public function student_fee_sms_parent($where=Null,$like=NULL,$std_no=NULL,$date=NULL,$document=NULL){
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
                         sub_programes.name as subprogram,
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
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id','left outer');
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
                
                if(empty($date['entry_date_from'])):
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
                                'subprogram'           =>$row->subprogram, 
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
                                'subprogram'           =>$row->subprogram, 
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
                                'subprogram'           =>$row->subprogram, 
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
           
            if(!empty($return_array)):
                $keys   = array_column($return_array, 'percentage');
                array_multisort($keys, SORT_DESC, $return_array);
                return      json_decode(json_encode($return_array), FALSE);
                else:
                return false;
            endif;
        
        
//           return  json_decode(json_encode($return_array), FALSE);
         endif;
    }  
}



         
//          $result = $this->db->get_where('prospectus_challan',array('prospectus_challan.paid_date !='=>'0000-00-00'))->result();
//          foreach($result as $dd):
//              
//              $where = array(
//                  'student_id'=>$dd->student_id
//              );
//                           $this->db->order_by('change_status_id','desc'); 
//              $getPaidby = $this->db->get_where('student_fee_verification_log',$where)->row();
//              $this->db->where(array('pros_challan_id'=>$dd->pros_challan_id));
//              $this->db->update('prospectus_challan',array('pros_paid_by'=>$getPaidby->update_by));
//          endforeach;
//          echo '<pre>';print_r($result);die;
//          
          