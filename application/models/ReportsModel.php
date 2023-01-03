<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class ReportsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
//        $this->db->query('
//                 UPDATE user SET max_questions = 0 WHERE user = "ecmslive2233";
//                    FLUSH PRIVILEGES;
//               
//                ');
        $this->db->query('SET SQL_BIG_SELECTS=1;');
//        $this->db->query('SET OPTION SQL_BIG_SELECTS = 1;');
        $this->load->model('CRUDModel');
    }
    
    public function get_by_id($table,$id){
        $query = $this->db->select('*')
            ->from($table)
            ->where($id)
            ->get();
      return $query->result();
    }
    
public function grand_finance_report($where=NULL,$like=NULL,$date=NULL){
               
                $this->db->select('student_record.student_id,
                        student_record.college_no,
                        student_record.applicant_image,
                        student_record.student_name,
                        student_record.form_no,
                        student_record.comment,
                        student_record.rseats_id1,
                        student_record.rseats_id2,
                        student_status.name as student_status,
                        student_record.father_name,
                        programes_info.programe_name,
                        sub_programes.name as subprogram,
                        prospectus_batch.batch_name,
                        sections.name as sectionName,
                        gender.title as genderName,
                        shift.name as shiftName,
                        applicant_edu_detail.total_marks,
                        applicant_edu_detail.obtained_marks,
                        applicant_edu_detail.percentage,
                        DATE_FORMAT(student_record.admission_date,"%d-%m-%Y") as admission_date,
                    ');    
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                 $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                 $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            if(empty($date['fromDate'])):
                   $this->db->where('student_record.admission_date <=',date('Y-m-d', strtotime($date['toDate'])));
                    else:
                     $this->db->where('student_record.admission_date BETWEEN "'.date('Y-m-d', strtotime($date['fromDate'])).'" AND "'.date('Y-m-d', strtotime($date['toDate'])).'"');   
            endif;
            $this->db->where_not_in('student_record.s_status_id',array(1,11,15,17,18));
            $this->db->group_by('student_record.student_id');
            $this->db->order_by('student_record.college_no','asc');
            $this->db->order_by('student_record.form_no','asc');
            $query =  $this->db->get('student_record');
            if($query):
                return $query->result();
            endif;
    }
public function grand_finance_report_excel($where=NULL,$like=NULL,$date=NULL){
               
                $this->db->select('
                        student_record.form_no,
                        student_record.college_no,
                        student_record.student_name,
                        student_record.father_name,
                        gender.title as genderName,
                        shift.name as shiftName,
                        prospectus_batch.batch_name,
                        sub_programes.name as subprogram,
                        sections.name as sectionName,
                        applicant_edu_detail.obtained_marks,
                        applicant_edu_detail.total_marks,
                        applicant_edu_detail.percentage,
                        DATE_FORMAT(student_record.admission_date,"%d-%m-%Y") as admission_date,
                        student_status.name as student_status,
                    '); 
//                DATE_FORMAT(student_record.admission_date,"%d-%m-%Y") as admission_date,
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                 $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                 $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            if(empty($date['fromDate'])):
                   $this->db->where('student_record.admission_date <=',date('Y-m-d', strtotime($date['toDate'])));
                    else:
                     $this->db->where('student_record.admission_date BETWEEN "'.date('Y-m-d', strtotime($date['fromDate'])).'" AND "'.date('Y-m-d', strtotime($date['toDate'])).'"');   
            endif;
//            $this->db->where('student_record.s_status_id !=','1');
            $this->db->where_not_in('student_record.s_status_id',array(1,11,15,17,18));
            $this->db->group_by('student_record.student_id');
            $this->db->order_by('student_record.college_no','asc');
            $this->db->order_by('student_record.form_no','asc');
            $query =  $this->db->get('student_record');
            if($query):
                return $query->result_array();
            endif;
    }
    
    public function grand_reportExportn($table,$where=NULL,$like=NULL,$custom=NULL,$where_in=NULL){
        $this->db->SELECT('
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                reserved_seat.name as reservedName,
                student_record.rseats_id1,
                student_record.rseats_id2,
                student_record.rseats_id3,
                student_record.comment,
                gender.title as genderName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.fata_school,
                shift.name as shiftName,
                sub_programes.name as subprogram,
                applicant_edu_detail.year_of_passing,
                student_record.remarks,
                student_record.remarks2,
                religion.title as religion,
                student_record.last_school_address,
                student_record.mobile_no as Mobile,
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
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('admission_date','desc');
            $this->db->group_by('student_record.student_id');
            if($where_in):
                $this->db->where_in('year_of_passing',array('2018','0'));
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $result =  $this->db->get()->result();
            $return_array = array();
            $s = 1;
            foreach($result as $row):
            $reserve1  = ""; 
            if(empty($row->rseats_id1)):
                 $reserve1 = "";
            else:
                $where = array(
                    'rseat_id'=>$row->rseats_id1
                );
                $check      = $this->db->select('name as reservedName1')->where($where)->get('reserved_seat')->row();
                $reserve1   = $check->reservedName1;
            endif;
            $reserve2   = ""; 
            if(empty($row->rseats_id2)):
                 $reserve2 = "";
            else:
                $where = array(
                    'rseat_id'=>$row->rseats_id2
                );
                $check2      = $this->db->select('name as reservedName2')->where($where)->get('reserved_seat')->row();
                $reserve2   = $check2->reservedName2;
            endif;
            $reserve3   = ""; 
            if(empty($row->rseats_id3)):
                 $reserve3 = "";
            else:
                $where = array(
                    'rseat_id'=>$row->rseats_id3
                );
                $check2      = $this->db->select('name as reservedName3')->where($where)->get('reserved_seat')->row();
                $reserve3   = $check2->reservedName3;
            endif;
            $return_array[] = array(
                's#'                => $s,
                'form_no'           => $row->form_no,
                'student_name'      => $row->student_name,
                'father_name'       => $row->father_name,
                'reservedName'      => $row->reservedName,
                'reservedName1'     => $reserve1,
                'reservedName3'     => $reserve3,
                'reservedName2'     => $reserve2,
                'comment'           => $row->comment,
                'genderName'        => $row->genderName,
                'total_marks'       => $row->total_marks,
                'obtained_marks'    => $row->obtained_marks,
                'percentage'        => $row->percentage,
                'fata_school'       => $row->fata_school,
                'shift'            => $row->shiftName,
                'subprogram'        => $row->subprogram,
                'year_of_passing'        => $row->year_of_passing,
                'remarks'           => $row->remarks,
                'remarks2'          => $row->remarks2,
                'religion'          => $row->religion,
                'last_school_address' => $row->last_school_address,
                'Mobile'            => $row->Mobile,
                 );
        $s++;
        endforeach;
        return $return_array;
   }
    
    public function getPositionResults($table){
        $this->db->select('
            college_no,
            std_name,
            sectionName,
            total_month_present,
            total_month_absent,
            (total_month_present + total_month_absent) as grand_total,
            (total_month_absent * 5) as total_fine
            ');
        $this->db->FROM($table);
        $this->db->order_by('college_no','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result_array();
        endif;
    }
    
    public function grand_report_status($where=NULL,$like=NULL){
       
                $this->db->select('
                     student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    student_record.comment,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name,
                    sections.name as sectionName,
                        ');    
                
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');  
                if($like):
                     $this->db->like($like);
                endif;
            if($where):
                $this->db->where($where);
            endif;
//            $this->db->where('student_record.s_status_id','5');
                    $this->db->group_by('student_record.student_id');
                    $this->db->order_by('student_record.college_no');
            return  $this->db->get('student_record')->result();
            
    }
    
//    public function grand_report_statuss($field,$table,$where=NULL,$like=NULL){
//  
//                $this->db->select($field);    
//                $this->db->from($table);
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
//                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
//                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');  
//                if($like):
//                     $this->db->like($like);
//                endif;
//            if($where):
//                $this->db->where($where);
//            endif;
//           $this->db->where_in('student_record.s_status_id',array(6,13,7,8,10,11,12));
//            $this->db->group_by('student_record.student_id');
//            $this->db->order_by('student_record.college_no');
//            $query =  $this->db->get();
//            if($query):
//                return $query->result();
//            endif;
//    }
//     
    
    public function test(){
        $query =$this->db->select('student_id,admission_date')
                ->from('student_record')
//                ->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer')
//                ->order_by('percentage','desc')
                ->order_by('form_no','asc')
                
                ->where('s_status_id','5')
                 ->limit('6','0')
                ->get();
        return $query->result();
    }
    
    public function get_studentsQuota($table,$where=NULL)
    {
         $this->db->select('
        student_record.*,
        student_status.name as status,
        student_status.s_status_id,
        sub_programes.name as sub_program,
        sub_programes.sub_pro_id as sub_pro_id,
        prospectus_batch.*,
        programes_info.*
        ');
        $this->db->FROM($table);   
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
        $this->db->group_by('sub_programes.sub_pro_id');
        if($where):
            $this->db->where($where);
        endif;
       $query = $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
   //get results requ: tableName,where
    public function get_meritlist($field,$table,$where=NULL,$like=NULL){
 
        
                
                $this->db->select($field);    
                $this->db->from($table);
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('sections','sub_programes.sub_pro_id=sections.sub_pro_id','left outer');
                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ;    
               
                if($like):
                    $this->db->like($like);
                endif;
            
//                $this->db->limit($custom['limit'],$custom['start']);
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('applicant_edu_detail.percentage','desc');
                $this->db->order_by('student_record.college_no','asc');
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
    public function get_meritlistExport($fields,$table,$where=NULL,$like=NULL,$custom=NULL){
        $this->db->SELECT($fields);
//            $this->db->SELECT('
//                student_record.student_id,
//                student_record.form_no,
//                 
//                student_record.student_name,
//                student_record.father_name,
//                gender.title as genderName,
//                programes_info.programe_name,
//                sub_programes.name as subprogram,
//                reserved_seat.name as reservedName,
//                prospectus_batch.batch_name,
//                student_record.hostel_required,
//                student_record.fata_school,
//                domicile.name as domicileName,
//                applicant_edu_detail.total_marks,
//                applicant_edu_detail.obtained_marks,
//                applicant_edu_detail.percentage,
//                student_record.admission_comment,
//                student_record.comment,
//                student_status.name as student_statusName,
//                student_record.admission_date
//                 
//                ');
       
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
            
            $this->db->limit($custom['limit'],$custom['start']);
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('admission_date','desc');
//            $this->db->group_by('student_record.college_no');
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result_array();
            endif;
            
   }
   
 
 
    public function datewise($table,$where){
//       $Query  = $this->db->select('admission_date,form_no,student_name')
       $Query  = $this->db->select('form_no')
//       $Query  = $this->db->select('admission_date,form_no,student_name,sub_programes.name as programName,student_status.name as status')
                        ->from($table)
                        //->where($where)
                         ->where('student_status.s_status_id','5')
//                        ->where('student_record.sub_pro_id','4')
                         ->where('admission_date','29-07-2016')
                        ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
                         ->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer')
               
                         //->distinct('admission_date')
                         // ->group_by('admission_date')
                         ->order_by('form_no','asc')
                        ->get();
       return $Query->result();
   }
   
      
    public function grand_report_new($field,$table,$where=NULL,$like=NULL,$custom=NULL,$where_in=NULL){
  
                $this->db->select($field);    
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
                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
                if($like):
                     $this->db->like($like);
                endif;
                $this->db->group_by('student_record.student_id');
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('form_no','asc');
            if($where_in):
                $this->db->where_in('year_of_passing',array('2018','0'));
            endif;
            if($where):
                $this->db->where($where);
                //$this->db->where('student_record.applicant_image !=','');
            endif;
            $return_array =  $this->db->get()->result();
             
                if(!empty($return_array)):
                    $keys   = array_column($return_array, 'percentage');
                    array_multisort($keys, SORT_DESC, $return_array);
                     return  json_decode(json_encode($return_array), FALSE);
                    else:
                     return false;
            endif;
             
    }
    public function inter_report_new($field,$table,$where=NULL,$like=NULL,$custom=NULL){
  
                $this->db->select($field);    
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
                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
                
                
                if($like):
                     $this->db->like($like);
                endif;

                //$this->db->limit(50,0);
                $this->db->group_by('student_record.student_id');
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('form_no','asc');
            
            if($where):
               
                $this->db->where($where);
                //$this->db->where('student_record.applicant_image !=','');
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    public function grand_report($field,$table,$where=NULL,$like=NULL,$custom=NULL){
  
                $this->db->select($field);    
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
                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
                
                
                if($like):
                     $this->db->like($like);
                endif;
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('form_no','asc');
                $this->db->where_in('student_record.s_status_id', array(5,6,7,8,9,12,13,14,19,20,21,22));
                $this->db->group_by('student_record.student_id');
            
            if($where):
               
                $this->db->where($where);
                //$this->db->where('student_record.applicant_image !=','');
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
     public function bs_program_white_card_rpt($where=NULL,$like=NULL,$custom=NULL){
  
                $this->db->select('student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    student_status.name as studentstatus,
                    prospectus_batch.batch_name,
                    sections.name as sectionName');    
                 
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
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
                //$this->db->where('student_record.applicant_image !=','');
            endif;
//            $this->db->where_in('student_record.programe_id', $where_id);
            $query =  $this->db->get('student_record');
            if($query):
                return $query->result();
            endif;
    }
    
    public function admin_grand_report($field,$table,$where=NULL,$like=NULL,$custom=NULL){
  
                $this->db->select($field);    
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
                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('form_no','asc');
                $this->db->group_by('student_record.student_id');
                if($where):
                    $this->db->where($where);
                    //$this->db->where('student_record.applicant_image !=','');
                endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
    
    
     public function grand_reportExportNew($table,$where=NULL,$like=NULL,$custom=NULL){
        $this->db->SELECT('
                
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                
                programes_info.programe_name,
                sub_programes.name as subprogram,
                
                sections.name,
                
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                
                student_record.app_postal_address as Address,
                student_record.mobile_no as Mobile,
                
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
          
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('admission_date','desc');
//            $this->db->group_by('student_record.college_no');
            
            if($where):
                $this->db->where($where);
            endif;
           $return_array = $this->db->get()->result_array();
           
           
           if(!empty($return_array)):
                    $keys   = array_column($return_array, 'percentage');
                    array_multisort($keys, SORT_DESC, $return_array);
                     return  $return_array;
                    else:
                     return false;
            endif;
           
           
           
           
      // return  json_decode(json_encode($return_array), FALSE);
   }
    public function grand_reportExport_new($table,$where=NULL,$like=NULL,$custom=NULL){
        $this->db->SELECT('
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as reservedName,
                student_record.rseats_id1,
                student_record.rseats_id2,
                prospectus_batch.batch_name,
                sections.name,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                applicant_edu_detail.lat_marks,
                student_record.admission_comment,
                student_record.comment,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                religion.title as religion,
                student_record.app_postal_address as Address,
                student_record.mobile_no as Mobile,
                blood_group.title,
                student_record.student_cnic,
                last_school_address,
                remarks,
                remarks2,
                country.name as countryName,
                shift.name as ShiftName,
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
          
            if($like):
                $this->db->like($like);
            endif;
            
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('admission_date','desc');
            $this->db->group_by('student_record.student_id');
            
            if($where):
                $this->db->where($where);
            endif;
            $result =  $this->db->get()->result();
           // echo '<pre>';print_r($result);die;
            $return_array = array();
            foreach($result as $row):
            $reserve2   = ""; 
          
            if(empty($row->rseats_id1)):
                 $reserve2 = "";
            else:
                $where = array(
                    'rseat_id'=>$row->rseats_id1
                );
                $check      = $this->db->select('name as reservedName2')->where($where)->get('reserved_seat')->row();
                $reserve2   = $check->reservedName2;
            endif;
            $reserve3   = ""; 
            if(empty($row->rseats_id2)):
                 $reserve3 = "";
            else:
                $where = array(
                    'rseat_id'=>$row->rseats_id2
                );
                $check2      = $this->db->select('name as reservedName3')->where($where)->get('reserved_seat')->row();
                $reserve3   = $check2->reservedName3;
            endif;
            $return_array[] = array(
                'student_id'        => $row->student_id,
                'form_no'           => $row->form_no,
                'college_no'        => $row->college_no,
                'student_name'      => $row->student_name,
                'father_name'       => $row->father_name,
                'genderName'        => $row->genderName,
                'programe_name'     => $row->programe_name,
                'subprogram'        => $row->subprogram,
                'reservedName'      => $row->reservedName,
                'reservedName2'     => $reserve2,
                'reservedName3'     => $reserve3,
                'batch_name'        => $row->batch_name,
                'name'              => $row->name,
                'fata_school'       => $row->fata_school,
                'domicileName'      => $row->domicileName,
                'total_marks'       => $row->total_marks,
                'obtained_marks'    => $row->obtained_marks,
                'percentage'        => $row->percentage,
                'lat_marks'        => $row->lat_marks,
                'admission_comment' => $row->admission_comment,
                'comment'           => $row->comment,
                'student_statusName'=> $row->student_statusName,
                'admission_date'    => $row->admission_date,
                
                'religion'          => $row->religion,
                'Address'           => $row->Address,
                'Mobile'            => $row->Mobile,
                'title'             => $row->title,
                'student_cnic'      => $row->student_cnic,
                'last_school_address' => $row->last_school_address,
                'remarks'           => $row->remarks,
                'remarks2'          => $row->remarks2,
                'countryName'       => $row->countryName,
                'ShiftName'         => $row->ShiftName,
                 );
       // echo '<pre>';print_r($return_array);die;
        endforeach;
        return $return_array;
      // return  json_decode(json_encode($return_array), FALSE);
   }
    public function grand_reportExportNew1($table,$where=NULL,$like=NULL,$custom=NULL){
        $this->db->SELECT('
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as reservedName,
                student_record.rseats_id1,
                student_record.rseats_id2,
                prospectus_batch.batch_name,
                sections.name,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.admission_comment,
                student_record.comment,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                religion.title as religion,
                student_record.app_postal_address as Address,
                student_record.mobile_no as Mobile,
                blood_group.title,
                student_record.student_cnic,
                last_school_address,
                remarks,
                remarks2,
                country.name as countryName,
                shift.name as ShiftName,
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
          
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('admission_date','desc');
//            $this->db->group_by('student_record.college_no');
            
            if($where):
                $this->db->where($where);
            endif;
            $result =  $this->db->get()->result();
           // echo '<pre>';print_r($result);die;
            $return_array = array();
            foreach($result as $row):
            $reserve2   = ""; 
          
            if(empty($row->rseats_id1)):
                 $reserve2 = "";
            else:
                $where = array(
                    'rseat_id'=>$row->rseats_id1
                );
                $check      = $this->db->select('name as reservedName2')->where($where)->get('reserved_seat')->row();
                $reserve2   = $check->reservedName2;
            endif;
            $reserve3   = ""; 
            if(empty($row->rseats_id2)):
                 $reserve3 = "";
            else:
                $where = array(
                    'rseat_id'=>$row->rseats_id2
                );
                $check2      = $this->db->select('name as reservedName3')->where($where)->get('reserved_seat')->row();
                $reserve3   = $check2->reservedName3;
            endif;
            $return_array[] = array(
                'student_id'        => $row->student_id,
                'form_no'           => $row->form_no,
                'college_no'        => $row->college_no,
                'student_name'      => $row->student_name,
                'father_name'       => $row->father_name,
                'genderName'        => $row->genderName,
                'programe_name'     => $row->programe_name,
                'subprogram'        => $row->subprogram,
                'reservedName'      => $row->reservedName,
                'reservedName2'     => $reserve2,
                'reservedName3'     => $reserve3,
                'batch_name'        => $row->batch_name,
                'name'              => $row->name,
                'fata_school'       => $row->fata_school,
                'domicileName'      => $row->domicileName,
                'total_marks'       => $row->total_marks,
                'obtained_marks'    => $row->obtained_marks,
                'percentage'        => $row->percentage,
                'admission_comment' => $row->admission_comment,
                'comment'           => $row->comment,
                'student_statusName'=> $row->student_statusName,
                'admission_date'    => $row->admission_date,
                
                'religion'          => $row->religion,
                'Address'           => $row->Address,
                'Mobile'            => $row->Mobile,
                'title'             => $row->title,
                'student_cnic'      => $row->student_cnic,
                'last_school_address' => $row->last_school_address,
                'remarks'           => $row->remarks,
                'remarks2'          => $row->remarks2,
                'countryName'       => $row->countryName,
                'ShiftName'         => $row->ShiftName,
                 );
       // echo '<pre>';print_r($return_array);die;
        endforeach;
        return $return_array;
      // return  json_decode(json_encode($return_array), FALSE);
   }
    public function grand_reportExport($table,$where=NULL,$like=NULL,$custom=NULL){
        $this->db->SELECT('
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as reservedName,
                student_record.rseats_id1,
                student_record.rseats_id2,
                prospectus_batch.batch_name,
                sections.name,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.admission_comment,
                student_record.comment,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                religion.title as religion,
                student_record.parmanent_address as Address,
                student_record.mobile_no as Mobile,
                blood_group.title,
                student_record.student_cnic,
                last_school_address,
                remarks,
                remarks2,
                country.name as countryName,
                
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
                  
          
            if($like):
                $this->db->like($like);
            endif;
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('admission_date','desc');
//            $this->db->group_by('student_record.college_no');
            
            if($where):
                $this->db->where($where);
            endif;
            $result =  $this->db->get()->result();
           // echo '<pre>';print_r($result);die;
            $return_array = array();
            foreach($result as $row):
            $reserve2 = ""; 
            if(empty($row->rseats_id1)):
                 $reserve2 = "";
                    else:
                
                $where = array(
                    'rseat_id'=>$row->rseats_id1
                );
            $check = $this->db->select('name as reservedName2')->where($where)->get('reserved_seat')->row();
                 $reserve2 = $check->reservedName2;
                    endif;
            
            $reserve3   = ""; 
            if(empty($row->rseats_id2)):
                 $reserve3 = "";
            else:
                $where2 = array(
                    'rseat_id'=>$row->rseats_id2
                );
                $check2      = $this->db->select('name as reservedName3')->where($where2)->get('reserved_seat')->row();
                $reserve3    = $check2->reservedName3;
            endif;        
                    
            $return_array[] = array(
                'student_id'        => $row->student_id,
                'form_no'           => $row->form_no,
                'student_name'      => $row->student_name,
                'father_name'       => $row->father_name,
                'genderName'        => $row->genderName,
                'programe_name'     => $row->programe_name,
                'subprogram'        => $row->subprogram,
                'reservedName'      => $row->reservedName,
                'reservedName2'     => $reserve2,
                'reservedName3'     => $reserve3,
                'batch_name'        => $row->batch_name,
                'name'              => $row->name,
                'fata_school'       => $row->fata_school,
                'domicileName'      => $row->domicileName,
                'total_marks'       => $row->total_marks,
                'obtained_marks'    => $row->obtained_marks,
                'percentage'        => $row->percentage,
                'admission_comment' => $row->admission_comment,
                'comment'           => $row->comment,
                'student_statusName'=> $row->student_statusName,
                'admission_date'    => $row->admission_date,
                'college_no'        => $row->college_no,
                'religion'          => $row->religion,
                'Address'           => $row->Address,
                'Mobile'            => $row->Mobile,
                'title'             => $row->title,
                'student_cnic'      => $row->student_cnic,
                'last_school_address' => $row->last_school_address,
                'remarks'           => $row->remarks,
                'remarks2'          => $row->remarks2,
                'countryName'       => $row->countryName,
                
                 );
       // echo '<pre>';print_r($return_array);die;
        endforeach;
        return $return_array;
      // return  json_decode(json_encode($return_array), FALSE);
   }
//   
//    public function grand_report($field,$table,$where=NULL,$like=NULL,$custom=NULL){
//  
//                $this->db->select($field);    
//                $this->db->from($table);
//                
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
//                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
//                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
//                //$this->db->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer') ;  
//                
//                
//                if($like):
//                     $this->db->like($like);
//                endif;
//
//                //$this->db->limit(50,0);
//                $this->db->order_by($custom['column'],$custom['order']);
//                $this->db->order_by('form_no','asc');
//            
//            if($where):
//               
//                $this->db->where($where);
//                //$this->db->where('student_record.applicant_image !=','');
//            endif;
//            
//            $query =  $this->db->get();
//            if($query):
//                return $query->result();
//            endif;
//    }
//       public function grand_report_new($field,$table,$where=NULL,$like=NULL,$custom=NULL){
//  
//                $this->db->select($field);    
//                $this->db->from($table);
//                
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
//                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
//                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
//                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
//                
//                
//                if($like):
//                     $this->db->like($like);
//                endif;
//
//                //$this->db->limit(50,0);
//                $this->db->order_by($custom['column'],$custom['order']);
//                $this->db->order_by('form_no','asc');
//            
//            if($where):
//               
//                $this->db->where($where);
//                //$this->db->where('student_record.applicant_image !=','');
//            endif;
//            
//            $query =  $this->db->get();
//            if($query):
//                return $query->result();
//            endif;
//    }
//    public function grand_reportExport($table,$where=NULL,$like=NULL,$custom=NULL){
//        $this->db->SELECT('
//                student_record.student_id,
//                student_record.form_no,
//                student_record.student_name,
//                student_record.father_name,
//                gender.title as genderName,
//                programes_info.programe_name,
//                sub_programes.name as subprogram,
//                reserved_seat.name as reservedName,
//                student_record.rseats_id1,
//                prospectus_batch.batch_name,
//                sections.name,
//                student_record.fata_school,
//                domicile.name as domicileName,
//                applicant_edu_detail.total_marks,
//                applicant_edu_detail.obtained_marks,
//                applicant_edu_detail.percentage,
//                student_record.admission_comment,
//                student_record.comment,
//                student_status.name as student_statusName,
//                student_record.admission_date,
//                student_record.college_no,
//                religion.title as religion,
//                student_record.parmanent_address as Address,
//                student_record.mobile_no as Mobile,
//                blood_group.title,
//                student_record.student_cnic,
//                last_school_address,
//                remarks,
//                remarks2,
//                country.name as countryName,
//                 ');
//                $this->db->from($table);
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
//                
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//                
//                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
//                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
//                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
//                 $this->db->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer') ; 
//                 $this->db->join('country','country.country_id=student_record.country_id','left outer') ; 
//          
//            if($like):
//                $this->db->like($like);
//            endif;
//            $this->db->order_by($custom['column'],$custom['order']);
//            $this->db->order_by('admission_date','desc');
////            $this->db->group_by('student_record.college_no');
//            
//            if($where):
//                $this->db->where($where);
//            endif;
//            $result =  $this->db->get()->result();
//           // echo '<pre>';print_r($result);die;
//            $return_array = array();
//            foreach($result as $row):
//            $reserve2 = ""; 
//            if(empty($row->rseats_id1)):
//                 $reserve2 = "";
//                    else:
//                
//                $where = array(
//                    'rseat_id'=>$row->rseats_id1
//                );
//            $check = $this->db->select('name as reservedName2')->where($where)->get('reserved_seat')->row();
//                 $reserve2 = $check->reservedName2;
//                    endif;
//            $return_array[] = array(
//                'student_id' => $row->student_id,
//                'form_no' => $row->form_no,
//                'student_name' => $row->student_name,
//                'father_name' => $row->father_name,
//                'genderName' => $row->genderName,
//                'programe_name' => $row->programe_name,
//                'subprogram' => $row->subprogram,
//                'reservedName' => $row->reservedName,
//                'reservedName2' => $reserve2,
//                'batch_name' => $row->batch_name,
//                'name' => $row->name,
//                'fata_school' => $row->fata_school,
//                'domicileName' => $row->domicileName,
//                'total_marks' => $row->total_marks,
//                'obtained_marks' => $row->obtained_marks,
//                'percentage' => $row->percentage,
//                'admission_comment' => $row->admission_comment,
//                'comment' => $row->comment,
//                'student_statusName' => $row->student_statusName,
//                'admission_date' => $row->admission_date,
//                'college_no' => $row->college_no,
//                'religion' => $row->religion,
//                'Address' => $row->Address,
//                'Mobile' => $row->Mobile,
//                'title' => $row->title,
//                'student_cnic' => $row->student_cnic,
//                'last_school_address' => $row->last_school_address,
//                'remarks' => $row->remarks,
//                'remarks2' => $row->remarks2,
//                'countryName' => $row->countryName,
//                 );
//       // echo '<pre>';print_r($return_array);die;
//        endforeach;
//        return $return_array;
//      // return  json_decode(json_encode($return_array), FALSE);
//   }
//    public function grand_reportExportNew($table,$where=NULL,$like=NULL,$custom=NULL){
//        $this->db->SELECT('
//                student_record.student_id,
//                student_record.form_no,
//                student_record.student_name,
//                student_record.father_name,
//                gender.title as genderName,
//                programes_info.programe_name,
//                sub_programes.name as subprogram,
//                reserved_seat.name as reservedName,
//                student_record.rseats_id1,
//                prospectus_batch.batch_name,
//                sections.name,
//                student_record.fata_school,
//                domicile.name as domicileName,
//                applicant_edu_detail.total_marks,
//                applicant_edu_detail.obtained_marks,
//                applicant_edu_detail.percentage,
//                student_record.admission_comment,
//                student_record.comment,
//                student_status.name as student_statusName,
//                student_record.admission_date,
//                student_record.college_no,
//                religion.title as religion,
//                student_record.parmanent_address as Address,
//                student_record.mobile_no as Mobile,
//                blood_group.title,
//                student_record.student_cnic,
//                last_school_address,
//                remarks,
//                remarks2,
//                country.name as countryName,
//                shift.name as ShiftName,
//                 ');
//                $this->db->from($table);
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
//                
//                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
//                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
//                
//                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
//                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
//                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
//                 $this->db->join('blood_group','blood_group.b_group_id=student_record.bg_id','left outer') ; 
//                 $this->db->join('country','country.country_id=student_record.country_id','left outer') ; 
//                 $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ; 
//          
//            if($like):
//                $this->db->like($like);
//            endif;
//            $this->db->order_by($custom['column'],$custom['order']);
//            $this->db->order_by('admission_date','desc');
////            $this->db->group_by('student_record.college_no');
//            
//            if($where):
//                $this->db->where($where);
//            endif;
//            $result =  $this->db->get()->result();
//           // echo '<pre>';print_r($result);die;
//            $return_array = array();
//            foreach($result as $row):
//            $reserve2   = ""; 
//            if(empty($row->rseats_id1)):
//                 $reserve2 = "";
//            else:
//                $where = array(
//                    'rseat_id'=>$row->rseats_id1
//                );
//                $check      = $this->db->select('name as reservedName2')->where($where)->get('reserved_seat')->row();
//                $reserve2   = $check->reservedName2;
//                    endif;
//            $return_array[] = array(
//                'student_id'        => $row->student_id,
//                'form_no'           => $row->form_no,
//                'student_name'      => $row->student_name,
//                'father_name'       => $row->father_name,
//                'genderName'        => $row->genderName,
//                'programe_name'     => $row->programe_name,
//                'subprogram'        => $row->subprogram,
//                'reservedName'      => $row->reservedName,
//                'reservedName2'     => $reserve2,
//                'batch_name'        => $row->batch_name,
//                'name'              => $row->name,
//                'fata_school'       => $row->fata_school,
//                'domicileName'      => $row->domicileName,
//                'total_marks'       => $row->total_marks,
//                'obtained_marks'    => $row->obtained_marks,
//                'percentage'        => $row->percentage,
//                'admission_comment' => $row->admission_comment,
//                'comment'           => $row->comment,
//                'student_statusName'=> $row->student_statusName,
//                'admission_date'    => $row->admission_date,
//                'college_no'        => $row->college_no,
//                'religion'          => $row->religion,
//                'Address'           => $row->Address,
//                'Mobile'            => $row->Mobile,
//                'title'             => $row->title,
//                'student_cnic'      => $row->student_cnic,
//                'last_school_address' => $row->last_school_address,
//                'remarks'           => $row->remarks,
//                'remarks2'          => $row->remarks2,
//                'countryName'       => $row->countryName,
//                'ShiftName'         => $row->ShiftName,
//                 );
//       // echo '<pre>';print_r($return_array);die;
//        endforeach;
//        return $return_array;
//      // return  json_decode(json_encode($return_array), FALSE);
//   }
    
   public function get_teacher_subjects($where=NULL){
       
         $this->db->select(
                '
                hr_emp_record.emp_name as employeename,
                hr_emp_record.emp_id as employeeId,
                sections.name as sectionname,
                sections.sec_id as sectionId,
                subject.title as subjectname,
                subject.subject_id,
                class_alloted.flag,
                class_alloted.sec_id as CA_section,
                class_alloted.class_id,
                '
                 );
         $this->db->from('class_alloted');
         $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
         $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
         $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
//           $this->db->where('attendance_date BETWEEN "'.$fromdate.'" and "'.$todate.'"');
         if($where):
             $this->db->where($where);
         endif;
         return $this->db->get()->result();
         
   }
    
    public function get_intteacher_subjects($where=NULL){
       
         $this->db->select(
                '
                hr_emp_record.emp_name as employeename,
                hr_emp_record.emp_id as employeeId,
                sections.name as sectionname,
                sections.sec_id as sectionId,
                subject.title as subjectname,
                subject.subject_id,
                class_alloted.flag,
                class_alloted.sec_id as CA_section,
                class_alloted.class_id,
                '
                 );
         $this->db->from('class_alloted');
         $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
         $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
         $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
         if($where):
             $this->db->where($where);
         endif;
         $this->db->order_by('hr_emp_record.emp_id','asc');
         return $this->db->get()->result();
         
   }
    
    public function get_teacher_pracsubjects($where=NULL){
       
         $this->db->select(
                '
                hr_emp_record.emp_name as employeename,
                hr_emp_record.emp_id as employeeId,
                practical_group.group_name,
                practical_group.prac_group_id,
                practical_subject.title as subjectname,
                practical_subject.prac_subject_id,
                practical_alloted.*
                '
                 );
         $this->db->from('practical_alloted');
         $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id');
         $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id');
         $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id');
         if($where):
             $this->db->where($where);
         endif;
         return $this->db->get()->result();
   }
    
   public function get_teacher_subjects_student_degree($where=NULL){
       
         $this->db->select(
                '
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                student_record.college_no,
                sections.name as sectionName,
                ');
//          $this->db->from('student_group_allotment');
//          $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
//           $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');

            $this->db->from('student_subject_alloted');
             $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id');
             $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
             $this->db->join('sections','sections.sec_id=student_subject_alloted.section_id');
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get()->result();
         
   }
   public function get_student_attendance($where=NULL){
      
    
            $this->db->from('class_alloted');
            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
            $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
////         $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
         if($where):
               $this->db->where($where);
         endif;
        
         return $this->db->get()->result();
}
public function get_student_attendance_row($where=NULL){
      
            $this->db->from('class_alloted');
            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
            $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
            $this->db->where($where);
    return  $this->db->get()->row();
                      
}
    
public function get_student_pracattendance_row($where=NULL){
      
            $this->db->from('practical_alloted');
            $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
            $this->db->join('practical_attendance_details','practical_attendance_details.attend_id=practical_attendance.attend_id');
            $this->db->where($where);
    return  $this->db->get()->row();
                      
}

    public function get_teacher_subjects_student_degree_section($where=NULL){
       
         $this->db->select(
                '
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                student_record.college_no,
                sections.name as sectionName,
               
                ');
            $this->db->from('student_group_allotment');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
 
         if($where):
               $this->db->where($where);
         endif;
        $this->db->order_by('student_record.college_no','asc');
         return $this->db->get()->result();
         
   }
    
    public function get_teacher_subjects_student_practical($where=NULL){
       
         $this->db->select(
                '
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                student_record.college_no,
                practical_group.group_name as sectionName,
               
                ');
            $this->db->from('student_prac_group_allottment');
    $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id');
            $this->db->join('student_record','student_record.college_no=student_prac_group_allottment.college_no');
 
         if($where):
               $this->db->where($where);
         endif;
        $this->db->order_by('student_record.college_no','asc');
         return $this->db->get()->result();
         
   }
    public function get_teacher_subjects_student_degree_subjects($where=NULL){
       
         $this->db->select(
                '
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                student_record.college_no,
                sections.name as sectionName,
                ');
              $this->db->from('student_subject_alloted');
             $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id');
             $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
             $this->db->join('sections','sections.sec_id=student_subject_alloted.section_id');
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get()->result();
         
   }
   
 
   public function get_whiteCard_subject($where=NULL){
       
         $this->db->select(
            '   student_record.college_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.father_name,
                student_record.gender_id,
                student_record.mobile_no,
                student_record.mobile_no2,
                student_record.admission_date,
                student_record.migrated_remarks,
                student_record.applicant_image,
                student_record.programe_id,
                student_record.sub_pro_id,
              
                sections.name as sectionsName,
                sections.sec_id,
                occupation.title as occupationTitle,
                prospectus_batch.batch_name,
                degree.title as degreeName,
                programes_info.programe_name as programName,
              
                applicant_edu_detail.year_of_passing,
                applicant_edu_detail.exam_type,
                applicant_edu_detail.rollno,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.inst_id,
                applicant_edu_detail.total_marks,
                 
                
                grade.grade_name,
                ');
             $this->db->from('student_group_allotment');
              $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
              $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
              $this->db->join('occupation','occupation.occ_id=student_record.occ_id','left outer');
              $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
              $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
              $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
              $this->db->join('degree','applicant_edu_detail.degree_id=degree.degree_id','left outer');
              $this->db->join('grade','applicant_edu_detail.grade_id=grade.grade_id','left outer');
             
          
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get()->row();
   }
     public function get_whiteCard_section($where=NULL){
       
         $this->db->select(
            '   student_record.college_no,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.father_name,
                student_record.gender_id,
                student_record.mobile_no,
                student_record.mobile_no2,
                student_record.admission_date,
                student_record.migrated_remarks,
                student_record.applicant_image,
                student_record.programe_id,
                student_record.sub_pro_id,
              
                sections.name as sectionsName,
                occupation.title as occupationTitle,
                prospectus_batch.batch_name,
                degree.title as degreeName,
                programes_info.programe_name as programName,
              
                applicant_edu_detail.year_of_passing,
                applicant_edu_detail.exam_type,
                applicant_edu_detail.rollno,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.inst_id,
                applicant_edu_detail.total_marks,
                 
                
                grade.grade_name,
                ');
            $this->db->from('student_subject_alloted');
            $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_subject_alloted.section_id','left outer');
            $this->db->join('occupation','occupation.occ_id=student_record.occ_id','left outer');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
            $this->db->join('degree','applicant_edu_detail.degree_id=degree.degree_id','left outer');
            $this->db->join('grade','applicant_edu_detail.grade_id=grade.grade_id','left outer');
             
          
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get()->row();
   }
//   public function get_whiteCard_section($where=NULL){
//       
//         $this->db->select(
//            '   student_record.college_no,
//                student_record.student_id,
//                student_record.student_name,
//                student_record.father_name,
//                student_record.father_name,
//                student_record.gender_id,
//                student_record.mobile_no,
//                student_record.mobile_no2,
//                student_record.admission_date,
//                student_record.migrated_remarks,
//                student_record.applicant_image,
//              
//                sections.name as sectionsName,
//                occupation.title as occupationTitle,
//                prospectus_batch.batch_name,
//                degree.title as degreeName,
//              
//                applicant_edu_detail.year_of_passing,
//                applicant_edu_detail.exam_type,
//                applicant_edu_detail.rollno,
//                applicant_edu_detail.obtained_marks,
//                applicant_edu_detail.inst_id,
//                applicant_edu_detail.total_marks,
//                 
//                
//                grade.grade_name,
//                ');
//              $this->db->from('student_subject_alloted');
//              $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
//              $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
//              $this->db->join('occupation','occupation.occ_id=student_record.occ_id','left outer');
//              $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
//              $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
//              $this->db->join('degree','applicant_edu_detail.degree_id=degree.degree_id');
//              $this->db->join('grade','applicant_edu_detail.grade_id=grade.grade_id','left outer');
//             
//          
//         if($where):
//               $this->db->where($where);
//         endif;
//         return $this->db->get()->row();
//   }
   
        public function get_classSubjects($where){
           
             $this->db->from('class_alloted');
              $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }
        
        public function get_test_marks($where){
           
                $this->db->from('monthly_test_details');
                $this->db->join('monthly_test','monthly_test.test_id=monthly_test_details.test_id');
                $this->db->join('class_alloted','class_alloted.class_id=monthly_test.class_id');
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->row();
        }
        public function get_test_marks_result($where){
           
                $this->db->from('monthly_test_details');
                $this->db->join('monthly_test','monthly_test.test_id=monthly_test_details.test_id');
                $this->db->join('class_alloted','class_alloted.class_id=monthly_test.class_id');
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }
          public function get_student_att($where){
           
             $this->db->from('class_alloted');
              $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
              $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
              
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }
        
        public function get_subject_list($table,$where){

        $this->db->from($table);
        $this->db->join('subject','subject.subject_id='.$table.'.subject_id');
        $this->db->where($where);
        return $this->db->get()->result();

    }
    public function get_classSubjects_rep($where){
        
           $this->db->select('class_alloted.sec_id as section_id,class_alloted.subject_id');
//        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
//        $this->db->join('subject','subject.sub_pro_id=sections.sub_pro_id');
        $this->db->where($where);
        return $this->db->get('class_alloted')->result();

    }
    public function get_subject_list_report($table,$where){

        $this->db->from($table);
        $this->db->join('subject','subject.subject_id='.$table.'.subject_id');
        $this->db->where($where);
        return $this->db->get()->result();

    }
 
    public function get_student_attendance_date($where=NULL,$date=NULL){
      
    
            $this->db->from('class_alloted');
            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
            $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
        if($where):
               $this->db->where($where);
        endif;
        if($date):
              $this->db->where('attendance_date BETWEEN "'.$date['start'].'"and "'.$date['end'].'"');
        endif;
        
         return $this->db->get()->result();
         }
    public function get_test_marks_result_monthwise($where,$date){
           
            
                $this->db->from('monthly_test_details');
                $this->db->join('monthly_test','monthly_test.test_id=monthly_test_details.test_id');
                $this->db->join('class_alloted','class_alloted.class_id=monthly_test.class_id');
            if($where):
               $this->db->where($where);
            endif;
             if($date):
              $this->db->where('test_date BETWEEN "'.$date['start'].'"and "'.$date['end'].'"');
         endif;
         return $this->db->get()->result();
        }
        
          public function section_wise_students($where=NULL){
       
         $this->db->select(
                '
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                student_record.college_no,
                sections.name as sectionName,
               
                ');
            $this->db->from('student_group_allotment');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
            $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');
 
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get()->result();
         
   }
    public function subject_wise_students($where=NULL){
       
         $this->db->select(
                '
                student_record.student_name,
                student_record.father_name,
                student_record.student_id,
                student_record.college_no,
                sections.name as sectionName,
                ');
              $this->db->from('student_subject_alloted');
             $this->db->join('subject','subject.subject_id=student_subject_alloted.subject_id');
             $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
             $this->db->join('sections','sections.sec_id=student_subject_alloted.section_id');
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get()->result();
         
   }
   
   public function get_student_result_month_wise($where){
      
              $this->db->from('monthly_test');
              $this->db->join('monthly_test_details','monthly_test_details.test_id=monthly_test.test_id');
//             $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
//             $this->db->join('sections','sections.sec_id=student_subject_alloted.section_id');
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get()->row();
   }
   public function position_report($field,$table,$where=NULL,$like=NULL,$custom=NULL){
  
                $this->db->select($field);    
                $this->db->from($table);
                
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                if($like):
                     $this->db->like($like);
                endif;
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('form_no','asc');
                $this->db->group_by('student_record.college_no');
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }    
    public function position_report_std($field,$table,$where=NULL){
  
                $this->db->select($field);    
                $this->db->from($table);
                
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
 
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->group_by('student_record.college_no');
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
    public function get_olevel_meritlist($field,$table,$where=NULL,$like=NULL,$custom=NULL){
                
                $this->db->select($field);    
                $this->db->from($table);
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('sections','sub_programes.sub_pro_id=sections.sub_pro_id','left outer');
                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ;    
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->limit($custom['limit'],$custom['start']);
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('form_no','asc');
                $this->db->group_by('student_record.student_id');
            if($where):
                $this->db->where($where);
            endif;
           // $this->db->where('applicant_edu_detail.degree_id','36');
            $this->db->where('student_record.rseats_id','3');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
    public function get_where_grades($table,$where){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
            ->join('student_record','student_record.student_id=student_grades.student_id','left outer')
            ->join('grade','grade.grade_id=student_grades.grade_id','left outer')
            ->join('subjects_olevel','subjects_olevel.ol_subject_id=student_grades.ol_subject_id','left outer')
                         ->where($where)
                         ->get();
            return $query->result();
   }
    
    public function get_olevel_meritlistExport($table,$where=NULL,$like=NULL,$custom=NULL){
        $this->db->SELECT(' 
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as reservedName,
                prospectus_batch.batch_name,
                student_record.hostel_required,
                student_record.fata_school,
                domicile.name as domicileName,
                student_record.admission_comment,
                student_record.comment,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                religion.title as religion,
                student_record.parmanent_address as Address,
                grade.grade_value
                ');
                $this->db->from($table);
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_grades','student_grades.student_id=student_record.student_id','left outer');
                $this->db->join('grade','grade.grade_id=student_grades.grade_id','left outer');
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
            
            $this->db->limit($custom['limit'],$custom['start']);
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('admission_date','desc');
            $this->db->group_by('student_record.student_id');
            $this->db->where('student_record.rseats_id','3');
            if($where):
                $this->db->where($where);
            endif;
            $result =  $this->db->get()->result();
           // echo '<pre>';print_r($result);die;
            $return_array = "";
            foreach($result as $row):
            
            $where = array(
                'student_grades.student_id'=>$row->student_id
                );
            $check = $this->db->select('
            subjects_olevel.ol_subject_name,
            grade.grade_name,
            grade.grade_value
            ');
            $this->db->from('student_grades');
            $this->db->join('student_record','student_record.student_id=student_grades.student_id','left outer');
            $this->db->join('grade','grade.grade_id=student_grades.grade_id','left outer');
            $this->db->join('subjects_olevel','subjects_olevel.ol_subject_id=student_grades.ol_subject_id','left outer');    
            $this->db->where($where);   
            $result2 =  $this->db->get()->result();
            $count = count($result2)*100;
            $grade = "";
            $values = "";
            foreach($result2 as $row2):
                $subject_name = $row2->ol_subject_name;
                $grade_name = $row2->grade_name;
                $grade_value = $row2->grade_value;
            
            $grade += $row2->grade_value;
            $values .= $subject_name.'('.$grade_name.'),';
            endforeach;
           // echo $values;die;
//            $res = ($grade/$count)*100;
//            $res = round($res,3);
            $res = "";
            if(empty($grade)):
                $res = 0;
                else:
                $res = ($grade/$count)*100;
                $res = round($res,3);
            endif;
            
            $return_array[] = array(
                'student_id' => $row->student_id,
                'form_no' => $row->form_no,
                'student_name' => $row->student_name,
                'father_name' => $row->father_name,
                'genderName' => $row->genderName,
                'programe_name' => $row->programe_name,
                'subprogram' => $row->subprogram,
                'reservedName' => $row->reservedName,
                'batch_name' => $row->batch_name,
                'fata_school' => $row->fata_school,
                'domicileName' => $row->domicileName,
                'admission_comment' => $row->admission_comment,
                'comment' => $row->comment,
                'student_statusName' => $row->student_statusName,
                'religion' => $row->religion,
                'Address' => $row->Address,
                'subjectGrade' =>$values,
                'Grade' =>$res
                 );
      //  echo '<pre>';print_r($return_array);die;
        endforeach;
        return $return_array;
            
   }
    
    public function get_Degree_Export($fields,$table,$where=NULL,$like=NULL,$custom=NULL){
        $this->db->SELECT($fields);
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
    
    public function admin_stdData($SPP,$page,$order=NULL){
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
        $this->db->where('student_record.s_status_id','5');        
        $this->db->group_by('student_record.student_id');              
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
   }  
    
public function get_admin_stdData($table,$where=NULL,$like=NULL){
       
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
                shift.name as shift_name,
                ');
        
        $this->db->FROM($table);
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id2', 'left outer');
        $this->db->join('gender','gender.gender_id=student_record.gender_id', 'left outer');
        $this->db->join('shift','shift.shift_id=student_record.shift_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->group_by('student_record.student_id');
            $this->db->order_by('student_record.college_no','asc');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
   }
    
  public function white_card_group_wise($where=NULL,$custom=NULL){
  
                $this->db->select('
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    sections.sec_id,
                    sections.name as sectionName,
                    domicile.name,
                    admission_date,
                    shift.name as shift_name,
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
                $this->db->group_by('student_record.student_id');
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('form_no','asc');
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get('student_record');
            if($query):
                return $query->result();
            endif;
    }

  public function get_whiteCard_practical($where=NULL){
       
         $this->db->select(
            '   student_prac_group_allottment.college_no,
                student_prac_group_allottment.student_name,
                practical_group.prac_group_id,
                practical_group.group_name
                ');
             $this->db->from('student_prac_group_allottment');
        $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id');
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get()->row();
   }
    
    public function get_studentPractical_att($where){
           
             $this->db->from('practical_alloted');
          $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
          $this->db->join('practical_attendance_details','practical_attendance_details.attend_id=practical_attendance.attend_id');
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }
    
    
    public function get_practicalSubjects($where){
           
             $this->db->from('practical_alloted');
              $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_alloted.subject_id');
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }

public function practical_white_card_group($where)
    {
        $this->db->select
        ('
            student_prac_group_allottment.college_no,
            student_prac_group_allottment.student_name,
            practical_group.prac_group_id,
            practical_group.group_name
        ');   
        $this->db->join('practical_group','practical_group.prac_group_id=student_prac_group_allottment.group_id','left outer'); 
        $this->db->order_by('student_prac_group_allottment.college_no','asc');
            $this->db->where($where);
        $query =  $this->db->get('student_prac_group_allottment');
        if($query):
            return $query->result();
        endif;
    }
    
    public function position_top_ten_report($field,$table,$where=NULL,$like=NULL,$custom=NULL){
  
                $this->db->select($field);    
                $this->db->from($table);
                
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                if($like):
                     $this->db->like($like);
                endif;
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->group_by('student_record.college_no');
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
    public function get_student_att_result($where){
           
             $this->db->from('class_alloted');
              $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
              $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }
    
    public function get_pre_board_marks_result($where)
    { 
        $this->db->from('pre_board_test_details');
        $this->db->join('pre_board_test','pre_board_test.test_id=pre_board_test_details.test_id');
        $this->db->join('class_alloted','class_alloted.class_id=pre_board_test.class_id');
        $this->db->where($where);
        return $this->db->get()->result();
    }
    
    public function grand_reportExport_finance($table,$where=NULL,$like=NULL){
        $this->db->SELECT('
                student_record.college_no,
                student_record.student_name,
                student_record.father_name,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                prospectus_batch.batch_name,
                sections.name,
                student_status.name as student_statusName
                 ');
                $this->db->from($table);
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer'); 
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.s_status_id !=','1');
            $this->db->group_by('student_record.student_id');
            $this->db->order_by('student_record.college_no','asc');
             $query =  $this->db->get();
            if($query):
                return $query->result_array();
            endif;
   }
    
        function statuss_dropDown($table, $option=NULL, $value,$show,$where=NULL)
	{
		$this->db->select('*');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->where_not_in('s_status_id',array(1));
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
    
    public function grand_report_finance($field,$table,$where=NULL,$like=NULL){
  
                $this->db->select($field);    
                $this->db->from($table);
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');  
                if($like):
                     $this->db->like($like);
                endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_record.s_status_id !=','1');
            $this->db->group_by('student_record.student_id');
            $this->db->order_by('student_record.college_no');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
    public function grand_report_bs_programs($field,$table,$where=NULL,$like=NULL){
  
                $this->db->select($field);    
                $this->db->from($table);
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');  
                if($like):
                     $this->db->like($like);
                endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->group_by('student_record.student_id');
            $this->db->order_by('student_record.college_no');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
    public function grand_reportBsPrograms($table){
  
                $this->db->select('
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.form_no,
                    student_record.comment,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_status.name as student_statusName,
                    student_record.father_name,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name,
                    sections.name as sectionName');    
                $this->db->from($table);
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');  
            $this->db->where_in('student_record.programe_id',array(2,4,6,8,9));
            $this->db->where('student_record.s_status_id','5');
            $this->db->group_by('student_record.student_id');
            $this->db->order_by('student_record.college_no');
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;
    }
    
//    function status_dropDown($table, $option=NULL, $value,$show,$where=NULL)
//	{
//		$this->db->select('*');
//                if($where):
//                    $this->db->where($where);
//                endif;
//                $this->db->where_in('s_status_id',array(5,13));
//                 $this->db->order_by($show,'asc');
//                $query = $this->db->get($table);
//		if($query->num_rows() > 0) 
//		{
//                    if($option):
//                        $data[''] = $option;
//                    endif;
//			foreach($query->result() as $row) 
//			{
//				$data[$row->$value] = $row->$show;
//			}
//			return $data;
//		}
//        
//	}
    
    public function top_ten_position_report($field,$table,$where=NULL,$like=NULL,$custom=NULL){
  
                $this->db->select($field);    
                $this->db->from($table);
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
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
                return $query->result();
            endif;
    }
    
    public function get_top_ten_marks_result($where)
    { 
        $this->db->from('monthly_test_details');
        $this->db->join('monthly_test','monthly_test.test_id=monthly_test_details.test_id');
        $this->db->join('class_alloted','class_alloted.class_id=monthly_test.class_id');
        $this->db->where($where);
        return $this->db->get()->result();
    }
    
      public function white_card_group_wise_hostel($where=NULL,$custom=NULL){
  
                $this->db->select('
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.rseats_id1,
                    student_record.rseats_id2,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    sections.sec_id,
                    sections.name as sectionName,
                    domicile.name,
                    admission_date,
                    shift.name as shift_name,
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
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id'); 
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.college_no','asc');
//                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('student_record.student_name','asc');
            if($where):
                $this->db->where($where);
            endif;
            
            $query =  $this->db->get('student_record');
            if($query):
                return $query->result();
            endif;
    }        
    public function grand_report_hostel($where=NULL,$like=NULL){
  
                $this->db->select('
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName
                    ');    
                
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
//                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer');  
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');  
                 $where['hostel_student_record.hostel_status_id'] = 1;
                if($where):
               
                    $this->db->where($where);
                    //$this->db->where('student_record.applicant_image !=','');
                endif;
                
                if($like):
                     $this->db->like($like);
                endif;
               $this->db->order_by('student_record.college_no','asc');
                $this->db->group_by('student_record.student_id');
            $query =  $this->db->get('student_record');
            if($query):
                return $query->result();
            endif;
    }
        
    public function getStudentsbBscs($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
        $this->db->where('programe_id =','2');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getStudentsbBsEng($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
        $this->db->where('programe_id =','8');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getStudentsbBsLaw($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
        $this->db->where('programe_id =','9');   
         $query = $this->db->get();
        return $query->result();
        
    }
    public function getStudentsbBsProgram($like=NULL)
    { 
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
        $this->db->where_in('programe_id',array(2,3,4,6,8,9,14,17));   
         $query = $this->db->get('student_record');
        return $query->result();
        
    }
    
    public function getStudentsbALevel($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
        $this->db->where('programe_id =','5');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getStudentsbBBA($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
        $this->db->where('programe_id =','6');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getStudentsbHND($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
        $this->db->where('programe_id =','3');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getStudentsbInter($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
        $this->db->where('programe_id =','1');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function student_Datainfo($table,$where=NULL)
    {
       $this->db->select('
        student_record.student_id,
        student_record.student_name,
        student_record.father_name,
        student_record.college_no,
        sub_programes.name as sub_program,
        programes_info.programe_name as program,
        prospectus_batch.batch_name as batch_name
       '); 
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function student_subProgram($table,$where=NULL)
    {
       $this->db->select('student_comulative_attendance.sub_pro_id,sub_programes.name, sec_id, student_record.s_status_id'); 
        $this->db->FROM($table);
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_comulative_attendance.sub_pro_id', 'left outer');
        $this->db->join('student_record','student_record.student_id=student_comulative_attendance.student_id', 'left outer');
    
        
         if($where):
            $this->db->where($where);
            $this->db->group_by('student_comulative_attendance.sub_pro_id');
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
     
    public function class_alloted_record_logs($where=NULL,$like=NULL,$wherec=NULL){
            
            $return_array = '';
            $this->db->select(
                    ' 
                       class_alloted_log.class_id,
                       hr_emp_record.emp_name,
                       sections.name as section_name,
                       subject.title as subject_name,
                       class_alloted_log.log_time,
                       class_alloted_log.log_user_id,
                       class_alloted_log.comments
                    ');
            $this->db->from('class_alloted_log');
            $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted_log.emp_id');
            $this->db->join('subject','subject.subject_id=class_alloted_log.subject_id','left outer');
            $this->db->join('sections','sections.sec_id=class_alloted_log.sec_id', 'left outer');
            if($like):
             $this->db->like($like);   
            endif;
            if($where):
             $this->db->where($where);
            endif;
//            $this->db->order_by('hr_emp_record.emp_id','asc');
 
            $result = $this->db->get()->result();
//             echo '<pre>'; print_r($result); die;
            
            if($result):
                $serial_no = '';
                foreach($result as $drow):
                
                            $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                $emp_log =  $this->db->get_where('users',array('user_id'=>$drow->log_user_id))->row();

                
                                    $this->db->select('
                                         days.day_name,
                                         class_starting_time.class_stime,
                                         class_ending_time.class_etime,
                                         invt_building_block.bb_name,
                                         invt_rooms.rm_name,
                                         timetable_log.log_datetime,
                                         hr_emp_record.emp_name,
                                         timetable_log.comments'
                                         );
                                    $this->db->join('days','days.day_id=timetable_log.day_id', 'left outer');
                                    $this->db->join('class_starting_time','class_starting_time.stime_id=timetable_log.stime_id', 'left outer');
                                    $this->db->join('class_ending_time','class_ending_time.etime_id=timetable_log.etime_id', 'left outer');
                                    $this->db->join('invt_building_block','invt_building_block.bb_id=timetable_log.building_block_id', 'left outer');
                                    $this->db->join('invt_rooms','invt_rooms.rm_id=timetable_log.room_id', 'left outer');
                                    $this->db->join('users','users.id=timetable_log.log_user_id', 'left outer');
                                    $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
                $time_table_log =   $this->db->get_where('timetable_log',array('timetable_log.class_id'=>$drow->class_id))->result();

    //                       echo '<pre>'; print_r($time_table_log); die;
                                    $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
                                    $this->db->join('subject','subject.subject_id=class_alloted.subject_id','left outer');
                                    $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
                 $result_currt =    $this->db->get_where('class_alloted',array('class_alloted.class_id'=>$drow->class_id))->row();
             
            
             
                                    $this->db->select('
                                         days.day_name,
                                         class_starting_time.class_stime,
                                         class_ending_time.class_etime,
                                         invt_building_block.bb_name,
                                         invt_rooms.rm_name,
                                         timetable.date as log_datetime,
                                         hr_emp_record.emp_name,
                                         CONCAT("Current Record") as comments,
                                         '
                                         );
                                    $this->db->join('days','days.day_id=timetable.day_id');
                                    $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id');
                                    $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id');
                                    $this->db->join('invt_building_block','invt_building_block.bb_id=timetable.building_block_id', 'left outer');
                                    $this->db->join('invt_rooms','invt_rooms.rm_id=timetable.room_id', 'left outer');
                                    $this->db->join('users','users.id=timetable.user_id');
                                    $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                $time_table_c   =   $this->db->get_where('timetable',array('class_id'=>$drow->class_id))->result();
                $serial_no++;
                if(!empty($result_currt)):
                    $return_array[] = array(
                    'tab_title'         => 'CURRENT RECORD',
                    'serial_no'         => $serial_no,
                    'class_id'          => $result_currt->class_id,
                    'emp_name'          => $result_currt->emp_name,
                    'section_name'      => $result_currt->name,
                    'subject_name'      => $result_currt->title,
                    'DateTime'          => $result_currt->timestamp,
                    'emp_name_log'      => '',
                    'comments'          => 'Current',
                    'timetable_record'  => $time_table_c,
                );
                endif;
                
                $return_array[] = array(
                    'tab_title'         => 'LOG RECORD',
                    'serial_no'         => $serial_no,
                    'class_id'          => $drow->class_id,
                    'emp_name'          => $drow->emp_name,
                    'section_name'      => $drow->section_name,
                    'subject_name'      => $drow->subject_name,
                    'DateTime'          => $drow->log_time,
                    'emp_name_log'      => $emp_log->emp_name,
                    'comments'          => $drow->comments,
                    'timetable_record'  => $time_table_log,
                );

               endforeach; 
 
               
            endif;
//                echo '<pre>'; print_r($return_array); die;

//            return $return_array;
            return  json_decode(json_encode($return_array), FALSE);
        }
 
    public function new_subject_inter_record($where=NULL,$like=NULL){
            
        $this->db->select(
                'student_record.student_name,
                student_record.father_name,
                student_record.form_no,
                student_record.college_no,
                student_record.applicant_mob_no1,
                student_record.timestamp,
                student_record.student_id,
                sub_programes.name as sub_pro_name,
                sections.name as section_name,
                hr_emp_record.emp_name as user_name');
        $this->db->from('student_record');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id', 'left outer');
        $this->db->join('users','users.id=student_record.user_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        if($like):
            $this->db->like($like);   
        endif;
//        $this->db->where_in('student_record.sub_pro_id',array(4,5));
        $this->db->where($where);
        $this->db->order_by('sections.name', 'acs');
        $this->db->order_by('student_record.college_no', 'acs');
        return $this->db->get()->result();
        }
        
   public function get_subject_new_student_list($where=NULL){
             
        $this->db->select(
                  'subject.title as subject_name,
                  new_student_subjects.subject_id,
                  new_student_subjects.student_id'
                  );
        $this->db->from('new_student_subjects');
        $this->db->join('subject','subject.subject_id=new_student_subjects.subject_id');

        $this->db->where($where);
        return $this->db->get()->result();
        }
        
   public function student_alloted_subjects($where=NULL){
             
        $this->db->select(
                  'subject.title as subject_name,
                  student_subject_alloted.subject_id,
                  student_subject_alloted.student_id'
                  );
        $this->db->join('student_subject_alloted','student_subject_alloted.subject_id=subject.subject_id');
        return $this->db->get_where('subject',$where)->result();
        }
        
    public function getStudentsAdmin($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
//        $this->db->where('programe_id =','2');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getStudentsbEcon($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
        $this->db->where('programe_id =','14');   
         $query = $this->db->get();
        return $query->result();
        
    }
     public function grand_report_new_hostel_check($field,$table,$where=NULL,$like=NULL,$custom=NULL,$where_in=NULL,$date){
          
                $this->db->select($field);    
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
                        'rseats_id1'        => $row->rseats_id1,  
                        'rseats_id2'        => $row->rseats_id2,  
                        'student_statusName'=> $row->student_statusName,  
                        'genderName'        => $row->genderName,  
                        'reservedName'      => $row->reservedName,  
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
                        'rseats_id1'        => $row->rseats_id1,  
                        'rseats_id2'        => $row->rseats_id2,  
                        'student_statusName'=> $row->student_statusName,  
                        'genderName'        => $row->genderName,  
                        'reservedName'      => $row->reservedName,  
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
                        'rseats_id1'        => $row->rseats_id1,  
                        'rseats_id2'        => $row->rseats_id2,  
                        'student_statusName'=> $row->student_statusName,  
                        'genderName'        => $row->genderName,  
                        'reservedName'      => $row->reservedName,  
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
                       );
                   
               endif; 
                endif; 
                
              
                endforeach;
                return  json_decode(json_encode($return_array), FALSE);
            endif;
            
    }   
    public function grand_reportExport_new_hostel_check($table,$where=NULL,$like=NULL,$custom=NULL,$date){
        
//         echo '<pre>';print_r($date);die;
        $this->db->SELECT('
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as reservedName,
                student_record.rseats_id1,
                student_record.rseats_id2,
                prospectus_batch.batch_name,
                sections.name,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                applicant_edu_detail.lat_marks,
                student_record.admission_comment,
                student_record.comment,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                student_record.applicant_mob_no1,
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
          
            if($like):
                $this->db->like($like);
            endif;
            
            $this->db->order_by($custom['column'],$custom['order']);
            $this->db->order_by('admission_date','desc');
            $this->db->group_by('student_record.student_id');
            $this->db->where('applicant_edu_detail.sub_pro_id','0');
            
            if($where):
                $this->db->where($where);
            endif;
            if(empty($date['fromDate'])):
                   $this->db->where('student_record.admission_date <=',date('Y-m-d', strtotime($date['toDate'])));
                    else:
                     $this->db->where('student_record.admission_date BETWEEN "'.date('Y-m-d', strtotime($date['fromDate'])).'" AND "'.date('Y-m-d', strtotime($date['toDate'])).'"');   
            endif;
            $result =  $this->db->get()->result();
           // echo '<pre>';print_r($result);die;
            $return_array = array();
            foreach($result as $row):
            $reserve2   = ""; 
          
            if(empty($row->rseats_id1)):
                 $reserve2 = "";
            else:
                $where = array(
                    'rseat_id'=>$row->rseats_id1
                );
                $check      = $this->db->select('name as reservedName2')->where($where)->get('reserved_seat')->row();
                $reserve2   = $check->reservedName2;
            endif;
            $reserve3   = ""; 
            if(empty($row->rseats_id2)):
                 $reserve3 = "";
            else:
                $where = array(
                    'rseat_id'=>$row->rseats_id2
                );
                $check2      = $this->db->select('name as reservedName3')->where($where)->get('reserved_seat')->row();
                $reserve3   = $check2->reservedName3;
            endif;
            
            
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
                'form_no'           => $row->form_no,
                'college_no'        => $row->college_no,
                'student_name'      => $row->student_name,
                'father_name'       => $row->father_name,
                'genderName'        => $row->genderName,
                'programe_name'     => $row->programe_name,
                'subprogram'        => $row->subprogram,
                'reservedName'      => $row->reservedName,
                'reservedName2'     => $reserve2,
                'reservedName3'     => $reserve3,
                'batch_name'        => $row->batch_name,
                'name'              => $row->name,
                'fata_school'       => $row->fata_school,
                'domicileName'      => $row->domicileName,
                'total_marks'       => $row->total_marks,
                'obtained_marks'    => $row->obtained_marks,
                'percentage'        => $row->percentage,
                'lat_marks'         => $row->lat_marks,
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
                 );
               endif;
               if($custom['hostel'] == 1):
                    if(!empty($hsote_recrd)):
                        $hoste_status = 'Yes';
                        $return_array[] = array(
                                'student_id'        => $row->student_id,
                                'form_no'           => $row->form_no,
                                'college_no'        => $row->college_no,
                                'student_name'      => $row->student_name,
                                'father_name'       => $row->father_name,
                                'genderName'        => $row->genderName,
                                'programe_name'     => $row->programe_name,
                                'subprogram'        => $row->subprogram,
                                'reservedName'      => $row->reservedName,
                                'reservedName2'     => $reserve2,
                                'reservedName3'     => $reserve3,
                                'batch_name'        => $row->batch_name,
                                'name'              => $row->name,
                                'fata_school'       => $row->fata_school,
                                'domicileName'      => $row->domicileName,
                                'total_marks'       => $row->total_marks,
                                'obtained_marks'    => $row->obtained_marks,
                                'percentage'        => $row->percentage,
                                'lat_marks'         => $row->lat_marks,
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
                                 );
                    endif;
               endif;
               if($custom['hostel'] == 2):
                    if(empty($hsote_recrd)):
                        $hoste_status = 'No';
                        $return_array[] = array(
                                'student_id'        => $row->student_id,
                                'form_no'           => $row->form_no,
                                'college_no'        => $row->college_no,
                                'student_name'      => $row->student_name,
                                'father_name'       => $row->father_name,
                                'genderName'        => $row->genderName,
                                'programe_name'     => $row->programe_name,
                                'subprogram'        => $row->subprogram,
                                'reservedName'      => $row->reservedName,
                                'reservedName2'     => $reserve2,
                                'reservedName3'     => $reserve3,
                                'batch_name'        => $row->batch_name,
                                'name'              => $row->name,
                                'fata_school'       => $row->fata_school,
                                'domicileName'      => $row->domicileName,
                                'total_marks'       => $row->total_marks,
                                'obtained_marks'    => $row->obtained_marks,
                                'percentage'        => $row->percentage,
                                'lat_marks'         => $row->lat_marks,
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
                                 );
                    endif;
               endif;
       // echo '<pre>';print_r($return_array);die;
        endforeach;
        return $return_array;
      // return  json_decode(json_encode($return_array), FALSE);
   }
     public function hostel_student_attandance_marks_details($where=NULL,$like=NULL){
  
                $this->db->select('
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    sections.sec_id,
                    sections.name as sectionName
                    ');    
                
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');  
                $where['hostel_student_record.hostel_status_id'] = 1;
                if($where):
               
                    $this->db->where($where);
                 
                endif;
                
                if($like):
                     $this->db->like($like);
                endif;
               $this->db->order_by('student_record.college_no','asc');
                $this->db->group_by('student_record.student_id');
            
           
            
            $query =  $this->db->get('student_record')->result();
            $return_array = '';
            foreach($query as $row):
                
                        $attendance = $this->CRUDModel->get_student_attendance_details($row->student_id,$row->sec_id);
                        $marks      = $this->CRUDModel->get_student_montly_marks_details($row->student_id,$row->sec_id);
                
                 
                $return_array[] = array(
                    'student_id'        => $row->student_id,
                    'college_no'        => $row->college_no,
                    'applicant_image'   => $row->applicant_image,
                    'student_name'      => $row->student_name,
                    'father_name'       => $row->father_name,
                    'form_no'           => $row->form_no,
                    'subprogram'        => $row->subprogram,
                    'programe_name'     => $row->programe_name,
                    'sec_id'            => $row->sec_id,
                    'sectionName'       => $row->sectionName,
                    'Present'           => $attendance->Present,
                    'Absent'            => $attendance->Absent,
                    'Persantage'        => $attendance->Persantage,
                    'PercentageMarks'   => $marks->Percentage,
                );
                
            endforeach;
            if(!empty($return_array)):
                          $keys   = array_column($return_array, 'Persantage');
                array_multisort($keys, SORT_DESC, $return_array);
    return      json_decode(json_encode($return_array), FALSE); 
                else:
             return      json_decode(json_encode($return_array), FALSE);   
            endif;
      
    }       
   
    public function search_strength($table,$where=NULL)
    {
       $this->db->select('
            sub_programes.name as sub_program,
            sections.sec_id as sectionId,
            sections.name as section_name,
            shift.name as shift_name,
            '); 
        $this->db->FROM($table);
        $this->db->join('programes_info','programes_info.programe_id=sections.program_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=sections.sub_pro_id', 'left outer');
        $this->db->join('shift','shift.shift_id=sections.shift_id', 'left outer');
    
        $this->db->like('sections.status', 'On');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
 public function inter_enrollerd_students(){
             $where = array(
              'student_record.programe_id'=>1,  
              'student_record.s_status_id'=>5,  
              'prospectus_batch.status'=>'on',  

            );
            
        
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
        if($where):
                $this->db->where($where);
            endif;
            
              $result =  $this->db->get('student_record')->result();
              
              
              if($result):
                  $return_array = '';
                  $PreMedical_1_M = $PreMedical_1_E =  $PreEngineering_1_M = $PreEngineering_1_E = $CS_1_E = $CS_1_M = $ARTS_1_M = $ARTS_1_E ='0'; //First Year Variables 
                  
                  $PreMedical_2_M = $PreMedical_2_E =  $PreEngineering_2_M = $PreEngineering_2_E = $CS_2_E = $CS_2_M = $ARTS_2_M = $ARTS_2_E = '0'; //First Year Variables 
                  $shift_no_aloted  = '';
                  $count            = '';
                    
                  
                    foreach($result as $row):
                            //***********************************************************************************************                 
                            //********************************MEDICAL 1st Year and 2nd Year *********************************                  
                            //***********************************************************************************************          
                         if($row->shift_id == 0):
                                   $shift_no_aloted .= $row->college_no.'<br/>';
                                   $count ++;
                                endif;
                        if($row->inter_default_flag == 1):      // First Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 2):          // First Year Medical Students
                                if($row->shift_id == 1):
                                    $PreMedical_1_M ++;         // Morning Students 
                                endif;
                                if($row->shift_id == 2):
                                    $PreMedical_1_E ++;         // Evening Students 
                                endif;
                            endif;
                        endif;
                        
                        if($row->inter_default_flag == 2):      // 2nd Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 25):          // 2nd Year Medical Students
                                if($row->shift_id == 1):
                                    $PreMedical_2_M ++;         // Morning Students 
                                endif;
                                if($row->shift_id == 2):
                                    $PreMedical_2_E ++;         // Evening Students 
                                endif;
                            endif;
                        endif;
                            //***********************************************************************************************                 
                            //********************************ENGINNERING 1st Year and 2nd Year *********************************                  
                            //***********************************************************************************************          

                        if($row->inter_default_flag == 1):      // First Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 1):          // First Year ENGINNERING Students
                                if($row->shift_id == 1):
                                    $PreEngineering_1_M ++;         // Morning Students 
                                endif;
                                if($row->shift_id == 2):
                                    $PreEngineering_1_E ++;         // Evening Students 
                                endif;
                            endif;
                        endif;
                        
                        if($row->inter_default_flag == 2):      // 2nd Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 24):          // 2nd Year ENGINNERING Students
                                if($row->shift_id == 1):
                                    $PreEngineering_2_M ++;         // Morning Students 
                                endif;
                                if($row->shift_id == 2):
                                    $PreEngineering_2_E ++;         // Evening Students 
                                endif;
                            endif;
                        endif;
                            //***********************************************************************************************                 
                            //********************************COMPUTER SCIENCE 1st Year and 2nd Year *********************************                  
                            //***********************************************************************************************          

                        if($row->inter_default_flag == 1):      // First Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 4):          // First Year COMPUTER SCIENCE Students
                                if($row->shift_id == 1):
                                    $CS_1_M ++;         // Morning Students 
                                endif;
                                if($row->shift_id == 2):
                                    $CS_1_E ++;         // Evening Students 
                                endif;
                            endif;
                        endif;
                        
                        if($row->inter_default_flag == 2):      // 2nd Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 26):          // 2nd Year COMPUTER SCIENCE Students
                                if($row->shift_id == 1):
                                    $CS_2_M ++;         // Morning Students 
                                endif;
                                if($row->shift_id == 2):
                                    $CS_2_E ++;         // Evening Students 
                                endif;
                            endif;
                        endif;
                        
                            //***********************************************************************************************                 
                            //********************************  ARTS 1st Year and 2nd Year *********************************                  
                            //***********************************************************************************************          

                        if($row->inter_default_flag == 1):      // First Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 5):          // First Year ARTS Students
                                if($row->shift_id == 1):
                                    $ARTS_1_M ++;         // Morning Students 
                                endif;
                                if($row->shift_id == 2):
                                    $ARTS_1_E ++;         // Evening Students 
                                endif;
                            endif;
                        endif;
                        
                        if($row->inter_default_flag == 2):      // 2nd Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 27):          // 2nd Year ARTS Students
                                if($row->shift_id == 1):
                                    $ARTS_2_M ++;         // Morning Students 
                                endif;
                                if($row->shift_id == 2):
                                    $ARTS_2_E ++;         // Evening Students 
                                endif;
                            endif;
                        endif;
                        
                        
                    endforeach;
                  
                   
                    $return_array[] = array(
                                        'Title'                 => 'Pre Medical',
                                        'first_Year_Morning'    => $PreMedical_1_M,
                                        'first_Year_Evening'    => $PreMedical_1_E,
                                        'first_Year_Total'      => $PreMedical_1_M+$PreMedical_1_E,
                                        
                                        'secound_Year_Morning'  => $PreMedical_2_M,
                                        'secound_Year_Evening'  => $PreMedical_2_E,
                                        'secound_Year_Total'    => $PreMedical_2_M+$PreMedical_2_E,
                                        
                                        'Total_Moring'          => $PreMedical_1_M+$PreMedical_2_M,
                                        'Total_Evening'         => $PreMedical_1_E+$PreMedical_2_E,
                                        'Grand_Total'           => $PreMedical_1_M+$PreMedical_1_E+$PreMedical_2_M+$PreMedical_2_E,
                                        
                                        ); 
                    $return_array[] = array(
                                        'Title'                 => 'Pre Engineering',
                                        'first_Year_Morning'    => $PreEngineering_1_M,
                                        'first_Year_Evening'    => $PreEngineering_1_E,
                                        'first_Year_Total'      => $PreEngineering_1_M+$PreEngineering_1_E,
                                        
                                        'secound_Year_Morning'  => $PreEngineering_2_M,
                                        'secound_Year_Evening'  => $PreEngineering_2_E,
                                        'secound_Year_Total'    => $PreEngineering_2_M+$PreEngineering_2_E,
                                        
                                        'Total_Moring'          => $PreEngineering_1_M+$PreEngineering_2_M,
                                        'Total_Evening'         => $PreEngineering_2_E+$PreEngineering_2_E,
                                        'Grand_Total'           => $PreEngineering_1_M+$PreEngineering_1_E+$PreEngineering_2_M+$PreEngineering_2_E,
                                        
                  );
                    $return_array[] =array(
                                        'Title'                 => 'Computer Science',
                                        'first_Year_Morning'    => $CS_1_M,
                                        'first_Year_Evening'    => $CS_1_E,
                                        'first_Year_Total'      => $CS_1_M+$CS_1_E,
                                        
                                        'secound_Year_Morning'  => $CS_2_M,
                                        'secound_Year_Evening'  => $CS_2_E,
                                        'secound_Year_Total'    => $CS_2_M+$CS_2_E,
                                        
                                        'Total_Moring'          => $CS_1_M+$CS_2_M,
                                        'Total_Evening'         => $CS_2_M+$CS_2_E,
                                        'Grand_Total'           => $CS_1_M+$CS_1_E+$CS_2_M+$CS_2_E,
                                        
                  );
                    $return_array[] = array(
                                        'Title'                 => 'Arts',
                                        'first_Year_Morning'    => $ARTS_1_M,
                                        'first_Year_Evening'    => $ARTS_1_E,
                                        'first_Year_Total'      => $ARTS_1_M+$ARTS_1_E,
                                        
                                        'secound_Year_Morning'  => $ARTS_2_M,
                                        'secound_Year_Evening'  => $ARTS_2_E,
                                        'secound_Year_Total'    => $ARTS_2_M+$ARTS_2_E,
                                        
                                        'Total_Moring'          => $ARTS_1_M+$ARTS_2_M,
                                        'Total_Evening'         => $ARTS_2_M+$ARTS_2_E,
                                        'Grand_Total'           => $ARTS_1_M+$ARTS_1_E+$ARTS_2_M+$ARTS_2_E,
                                        
                  );
                    $return_array[] = array(
                                        'Title'                 => 'Shift Not Alloted',
                                        'first_Year_Morning'    => '',
                                        'first_Year_Evening'    => '',
                                        'first_Year_Total'      => '',
                                        
                                        'secound_Year_Morning'  => '',
                                        'secound_Year_Evening'  => '',
                                        'secound_Year_Total'    => '',
                                        
                                        'Total_Moring'          => 'error',
                                        'Total_Evening'         => $shift_no_aloted,
                                        'Grand_Total'           => $count,
                                        
                  );
                
              endif;
              
              return json_decode(json_encode($return_array));
              
    }
    public function bs_enrollerd_students($where){
             
            
                $this->db->select('prospectus_batch.batch_name,count(student_record.student_id) as Total,sub_programes.name');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->group_by('prospectus_batch.batch_id');
                $this->db->order_by('prospectus_batch.batch_id','asc');
                $this->db->where(array('student_record.s_status_id'=>5,'prospectus_batch.status'=>'on'));
            if($where):
                    $this->db->where($where);
            endif;
            return $this->db->get('student_record')->result();
    }
      public function alevel_enrollerd_students(){
             $where = array(
              'student_record.programe_id'=>5,  
              'student_record.s_status_id'=>5,  
              'prospectus_batch.status'=>'on',  

            );
            
        
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
        if($where):
                $this->db->where($where);
            endif;
            
              $result =  $this->db->get('student_record')->result();
              if($result):
                  $return_array = '';
                    $first_Year_science     =  $first_Year_arts         = '0'; //First Year Variables 
                    $secound_Year_science   = $secound_Year_arts        = '0'; //First Year Variables 
                  
                  
                    foreach($result as $row):
                            //***********************************************************************************************                 
                            //********************************ALEVE 1st Year and 2nd Year *********************************                  
                            //***********************************************************************************************          
                     
                        if($row->inter_default_flag == 1):      // First Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 15):          // First Year Medical Students
                                    $first_Year_science ++;         // Evening Students 
                            endif;
                            if($row->sub_pro_id == 37):          // First Year Medical Students
                                    $first_Year_arts ++;         // Evening Students 
                            endif;
                        endif;
                        
                        if($row->inter_default_flag == 2):      // 2nd Year Student prospectus_batch.inter_default_flag == 1 First Year Batch.
                            if($row->sub_pro_id == 16):          // First Year Medical Students
                                    $secound_Year_science ++;         // Evening Students 
                            endif;
                            if($row->sub_pro_id == 38):          // First Year Medical Students
                                    $secound_Year_arts ++;         // Evening Students 
                            endif; 
                        endif;
                       
                        
                    endforeach;
                  
                   
                    $return_array[] = array(
                                        'Title'         => 'Science',
                                        'first_Year'    => $first_Year_science,
                                        
                                        
                                        'secound_Year'  => $secound_Year_science,
                                        'Total'         => $first_Year_science+$secound_Year_science,
                                        
                                        ); 
                    $return_array[] = array(
                                        'Title'         => 'Arts',
                                        'first_Year'    => $first_Year_arts,
                                        'secound_Year'  => $secound_Year_arts,
                                        'Total'         => $first_Year_arts+$secound_Year_arts,
                                        
                                        ); 
              endif;
              
              return json_decode(json_encode($return_array));
              
    }    
     public function student_cumulitive_montly_report($where=NULL){
       $this->db->select('
            student_record.student_id,
            student_record.gender_id,
            student_record.applicant_image,
            student_record.admission_date,
            student_record.mobile_no,
            student_record.migrated_remarks,
            student_record.admission_date,
            student_record.student_name,
            student_record.father_name,
            student_record.college_no,
            sub_programes.name as sub_program,
            programes_info.programe_name as program,
            programes_info.programe_id,
            sub_programes.sub_pro_id,
            prospectus_batch.batch_name as batch_name,
            sections.name as section_name,
       '); 

            
            $this->db->join('student_record','student_record.student_id=students_cumulative_montly.student_id', 'left outer');
            $this->db->join('sub_programes','sub_programes.sub_pro_id=students_cumulative_montly.sub_pro_id', 'left outer');
            $this->db->join('programes_info','programes_info.programe_id=students_cumulative_montly.program_id', 'left outer');
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=students_cumulative_montly.batch_id', 'left outer');
            $this->db->join('sections','sections.sec_id=students_cumulative_montly.sec_id', 'left outer');
            $this->db->order_by('students_cumulative_montly.sec_id','asc');   
            $this->db->group_by('students_cumulative_montly.sub_pro_id');   
            if($where):
               $this->db->where($where);
            endif;
           return  $this->db->get('students_cumulative_montly')->result();
 }
     
        public function student_attendance_percentage_wise($where=NULL,$like=NULL,$date=NULL,$att_between=NULL){
  
                $this->db->select('
                    student_record.student_id,
                    student_record.college_no,
                    student_record.student_name,
                    student_record.father_name,
                    student_record.mobile_no,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    sections.sec_id,
                    sections.name as sectionName,
                    admission_date,
                    college_no,
                    student_status.name as status,
                    ');    
                
                
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
//                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
                
                if($like):
                     $this->db->like($like);
                endif;
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('form_no','asc');
            
            if($where):
                $this->db->where($where);
            endif;
            $result =  $this->db->get('student_record')->result();
            if(!empty($result)):
                $return_array = array();
                foreach($result as $row):
                                $this->db->select("
                                      count(*) as Total_Classes,
                                      count(if(status = '0', 1, NULL)) AS Absent,
                                      (count(*) - count(if(status = '0', 1, NULL))) as Present,
                                        ROUND(((count(*) - count(if(status = '0', 1, NULL)))/ count(*))*100,2) as Percentage
                                  ");
                                  
                                  if(empty($att_between['per_from'])):
                                    $this->db->having('Percentage <=',$att_between['per_to']);
                                else:
                                    $this->db->having('Percentage BETWEEN "'.$att_between['per_from'].'" AND "'.$att_between['per_to'].'"');   
                                endif;
                                 
                                if(empty($date['fromDate'])):
                                    $this->db->where('student_attendance.attendance_date <=',date('Y-m-d', strtotime($date['toDate'])));
                                else:
                                    $this->db->where('student_attendance.attendance_date BETWEEN "'.date('Y-m-d', strtotime($date['fromDate'])).'" AND "'.date('Y-m-d', strtotime($date['toDate'])).'"');   
                                endif;
                                $this->db->join('student_attendance','student_attendance.attend_id=student_attendance_details.attend_id'); 
                    
                $att_details  = $this->db->get_where('student_attendance_details',array('student_id'=>$row->student_id))->row();
                    if(!empty($att_details)):
                        $marks      = $this->CRUDModel->get_student_montly_marks_details(
                            $row->student_id,
                            $row->sec_id);
                            $std_marks_per = '0';
                        if(isset($marks) && !empty($marks)):
                            $std_marks_per = $marks->Percentage;
                        endif;
                        
                        $return_array[] = array(
                        'college_no'    => $row->college_no,
                        'student_name'  => $row->student_name,
                        'father_name'   => $row->father_name,
                        'mobile_no'     => $row->mobile_no,
                        'status'        => $row->status,
                        'marks'         =>$std_marks_per ,
                        'sectionName'   => $row->sectionName,
                        'Total_Classes' => $att_details->Absent.' + '.$att_details->Present.' = '.$att_details->Total_Classes,
                        'Absent'        => $att_details->Absent,
                        'Present'       => $att_details->Present,
                        'Total'         => $att_details->Total_Classes,
                        'Percentage'    => $att_details->Percentage,
                    );  
                    endif;
                   
                endforeach;
                
                        $keys   = array_column($return_array, 'Percentage');
                        array_multisort($keys, SORT_DESC, $return_array);
                return  json_decode(json_encode($return_array), FALSE); 
           
            
            endif;
           
    }
      
    public function bs_program_exam_prev($where=NULL){
        
       $this->db->select('
        exams_bs.*,
        subject.title as subject,
        subject.subject_id as subject_id,
        sub_programes.name,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
       '); 
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=exams_bs.exb_employ_id', 'left outer');
        $this->db->join('subject','subject.subject_id=exams_bs.exb_subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=exams_bs.exb_section_id', 'left outer');
//        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
         if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('sections.name', 'asc');
        $this->db->group_by('exb_class_id');
        $query =  $this->db->get('exams_bs');
        if($query):
            return $query->result();
        endif;
        
    }
     
    public function bs_program_exame($where=NULL){
        
       $this->db->select('
        class_alloted.class_id as class_id,
        class_alloted.ca_merge_id,
        subject.title as subject,
        subject.subject_id as subject_id,
        sub_programes.name,
        hr_emp_record.emp_name as employee,
        hr_emp_record.emp_id,
        sections.name as section,
        sections.sec_id as sec_id,
        class_alloted_merge_groups.camg_name
       '); 
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('class_alloted_merge_groups','class_alloted_merge_groups.camg_id=class_alloted.ca_merge_id', 'left outer');
        $this->db->order_by('sub_programes.name', 'asc');
         if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get('class_alloted');
        if($query):
            return $query->result();
        endif;
        
    }
    
    public function get_test_info($where=NULL){
        
        $this->db->select('
            exams_bs.*,
            sections.name as section_name,
            subject.title as subject_name,
            hr_emp_record.emp_name as employee_name,
            sub_programes.sp_title as sub_pro_name,
            prospectus_batch.batch_name,
            exam_types.xt_title
       '); 
        $this->db->join('exam_types','exam_types.xt_id=exams_bs.exb_test_type', 'left outer');
        $this->db->join('class_alloted','class_alloted.class_id=exams_bs.exb_class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=sections.batch_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get('exams_bs');
        if($query):
            return $query->row();
        endif;
        
    }
    
    public function get_test_info_prev($where=NULL){
        
        $this->db->select('
            exams_bs.*,
            sections.name as section_name,
            subject.title as subject_name,
            hr_emp_record.emp_name as employee_name,
            sub_programes.sp_title as sub_pro_name,
            prospectus_batch.batch_name,
            exam_types.xt_title
       '); 
        $this->db->join('exam_types','exam_types.xt_id=exams_bs.exb_test_type', 'left outer');
//        $this->db->join('class_alloted','class_alloted.class_id=exams_bs.exb_class_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=exams_bs.exb_employ_id', 'left outer');
        $this->db->join('subject','subject.subject_id=exams_bs.exb_subject_id', 'left outer');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=subject.sub_pro_id', 'left outer');
        $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id', 'left outer');
        $this->db->join('sections','sections.sec_id=exams_bs.exb_section_id', 'left outer');
        $this->db->join('prospectus_batch','prospectus_batch.batch_id=sections.batch_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get('exams_bs');
        if($query):
            return $query->row();
        endif;
        
    }
    
    public function get_test_detail($where=NULL){
        
        $this->db->select('
            exams_bs_details.*,
            exams_bs.*,
            student_record.college_no,
            student_record.student_name,
            student_record.bs_enrollment_no,
       '); 
        $this->db->join('exams_bs','exams_bs.exb_test_id=exams_bs_details.exbd_test_id', 'left outer');
        $this->db->join('student_record','student_record.student_id=exams_bs_details.exbd_student_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get('exams_bs_details');
        if($query):
            return $query->result();
        endif;
        
    }
    
    public function get_test_students($where=NULL){
        
        $this->db->select('
            student_group_allotment.*,
            student_record.college_no,
            student_record.student_name,
            student_record.bs_enrollment_no,
            student_record.student_id,
            class_alloted.class_id,
       '); 
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('class_alloted','class_alloted.sec_id=sections.sec_id', 'left outer');
        $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get('student_group_allotment');
        if($query):
            return $query->result();
        endif;
        
    }
    
    public function get_test_students_prev($where=NULL){
        
        $this->db->select('
            exams_bs_details.*,
            exams_bs.*,
            student_record.college_no,
            student_record.student_name,
            student_record.bs_enrollment_no,
            student_record.student_id,
       '); 
        $this->db->join('exams_bs','exams_bs.exb_test_id=exams_bs_details.exbd_test_id', 'left outer');
        $this->db->join('sections','sections.sec_id=exams_bs.exb_section_id', 'left outer');
        $this->db->join('student_record','student_record.student_id=exams_bs_details.exbd_student_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->group_by('exbd_student_id');
        $query =  $this->db->get('exams_bs_details');
        if($query):
            return $query->result();
        endif;
        
    }
    
    public function get_midterm_students($where=NULL, $type){
        
        $this->db->select('
            exams_bs_details.*,
            exams_bs.*,
       '); 
        $this->db->join('exams_bs','exams_bs.exb_test_id=exams_bs_details.exbd_test_id', 'left outer');
        $this->db->join('exam_types','exam_types.xt_id=exams_bs.exb_test_type', 'left outer');
        $this->db->join('class_alloted','class_alloted.class_id=exams_bs.exb_class_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get('exams_bs_details');
        if($query):
            return $query->$type();
        endif;
        
    }
    
    public function get_midterm_students_prev($where=NULL, $type){
        
        $this->db->select('
            exams_bs_details.*,
            exams_bs.*,
       '); 
        $this->db->join('exams_bs','exams_bs.exb_test_id=exams_bs_details.exbd_test_id', 'left outer');
        $this->db->join('exam_types','exam_types.xt_id=exams_bs.exb_test_type', 'left outer');
//        $this->db->join('class_alloted','class_alloted.class_id=exams_bs.exb_class_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get('exams_bs_details');
        if($query):
            return $query->$type();
        endif;
        
    }
    
    public function student_shit_wise_report_search($where=NULL){
                
        
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
           
            if($where):
                $this->db->where($where);
            endif;
            $this->db->group_by('sub_programes.sub_pro_id');
            $this->db->order_by('sub_programes.sp_title','desc');
            $result =     $this->db->get('student_record')->result();
            $return_array = array();
            $M1 = '';
            $M2 = '';
            
            if($result):
                foreach($result as $row):
                    $where_program_ws   = $where;
                    $where_program_ws['sub_programes.sub_pro_id']  = $row->sub_pro_id;    
                    $morning_one                    = $where_program_ws;
                    $morning_one['shift.shift_id']  = '1';
                    $morning_two                    = $where_program_ws;
                    $morning_two['shift.shift_id']  = '2';
                $return_array[] = array(
                     'Program'              => $row->sp_title,  
                     'Morning_one'          => count($this->student_shift_details($morning_one)),  
                     'Morning_two'          => count($this->student_shift_details($morning_two)),  
                     'Total'                => count($this->student_shift_details($morning_one))+count($this->student_shift_details($morning_two)),  
                   ); 
                $M1 += count($this->student_shift_details($morning_one));
                $M2 += count($this->student_shift_details($morning_two));
                endforeach;
                $return_array[] = array(
                     'Program'              => 'Total',  
                     'Morning_one'          => $M1,  
                     'Morning_two'          => $M2,  
                     'Total'                => $M1+$M2,  
                   ); 
               
            endif;
            
            
                   $no_shift                   = $where;
                    $no_shift['student_record.shift_id'] = '0';
                $no_shif_query = $this->student_shift_details($no_shift);
                $sn = '';
                if($no_shif_query):
                    
                $return_array[] = array(
                     'Program'              => '<strong>Shift Not Alloed</strong>',  
                     'Morning_one'          => '',  
                     'Morning_two'          => '',  
                     'Total'                => '',  
                   ); 
                $return_array[] = array(
                     'Program'              => '<strong>Form#</strong>',  
                     'Morning_one'          => '<strong>College #</strong>',  
                     'Morning_two'          => '<strong>Name</strong>',  
                     'Total'                => '<strong>Group</strong>',  
                   );
                    
                    
                    foreach($no_shif_query as $row_shift):
                        $return_array[] = array(
                            'Program'              => $row_shift->form_no,  
                            'Morning_one'          => $row_shift->college_no,  
                            'Morning_two'          => $row_shift->student_name,  
                            'Total'                => $row_shift->sp_title,  
                        ); 
                endforeach;
            endif;
            return  json_decode(json_encode($return_array), FALSE); 
//            return $return_array;
    }
    public function student_shift_details($where){
            $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
           
            if($where):
                $this->db->where($where);
            endif;
            $this->db->group_by('student_record.student_id');
            $this->db->order_by('sp_title');
            return    $this->db->get('student_record')->result();
            
            
    }
 
// public function get_teacher_attendance_date_wise($where=NULL,$date){
//       
//            $this->db->select('
//                hr_emp_record.emp_name as employeename,
//                hr_emp_record.emp_id as employeeId,
//                student_attendance.attendance_date,
//                '
//                 );
//         
//            $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id','left outer');
//            $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id','left outer');
//            if($where):
//                $this->db->where($where);
//            endif;
//            $this->db->where('student_attendance.attendance_date BETWEEN "'.$date['from'].'" and "'.$date['to'].'"');
//            $this->db->group_by('student_attendance.attendance_date');
//            $this->db->order_by('student_attendance.attendance_date','asc');
//         return $this->db->get('student_attendance')->result();
//         
//   } 
 public function get_teacher_attendance_date_wise_enter_by($where=NULL,$date){
       
            $this->db->select('
                    hr_emp_record.emp_name as employeename,
                    hr_emp_record.emp_id as employeeId,
                    student_attendance.attendance_date,
                '
                 );
         
//            $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id','left outer');
//            $this->db->join('hr_emp_record','hr_emp_record.emp_id=student_attendance.user_id','left outer');
            $this->db->join('users','users.id=student_attendance.user_id');
             $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
            if($where):
                $this->db->where($where);
            endif;
            $this->db->where('student_attendance.attendance_date BETWEEN "'.$date['from'].'" and "'.$date['to'].'"');
            $this->db->group_by('student_attendance.attendance_date');
            $this->db->order_by('student_attendance.attendance_date','asc');
         return $this->db->get('student_attendance')->result();
         
   } 
  
   public function get_disciplinary_actions($where=NULL){
       
        $this->db->select('
            proctorial_fine.*,
            proctorial_fine_type.proc_type_title,
            proctorial_fine_status.status_name,
        ');

        $this->db->join('proctorial_fine_type','proctorial_fine_type.proc_type_id=proctorial_fine.proc_type_id','left outer');
        $this->db->join('proctorial_fine_status','proctorial_fine_status.proc_status_id=proctorial_fine.proc_status_id','left outer');
        
        if($where):
            $this->db->where($where);
        endif;
        
        $this->db->order_by('proctorial_fine.date','desc');
        return $this->db->get('proctorial_fine')->result();
       
   }

      public function position_report_excel($field,$table,$where=NULL,$like=NULL,$custom=NULL){
  
                $this->db->select($field);    
                $this->db->from($table);
                
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                if($like):
                     $this->db->like($like);
                endif;
                $this->db->order_by($custom['column'],$custom['order']);
                $this->db->order_by('form_no','asc');
                $this->db->group_by('student_record.college_no');
            if($where):
                $this->db->where($where);
            endif;
            
            $result =  $this->db->get()->result();
            
            $startDate  =  date("Y-m", strtotime($this->input->post('fromDate')));
            $endDate    =  date("Y-m", strtotime($this->input->post('toDate')));
             if($result):
                    $this->db->truncate('student_position');
                    $sn = 1;
                    foreach($result as $resRow):
                        $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$resRow->sec_id));
                        if(@$CheckStd->flag ==1):
                            $classSubjects = $this->ReportsModel->get_classSubjects_rep(array('sec_id'=>$resRow->sec_id));
                        endif;
                        if(@$CheckStd->flag == 2):
                            $classSubjects = $this->ReportsModel->get_subject_list_report('student_subject_alloted',array('student_id'=>$resRow->student_id));
                        endif;

                        $month      = date("m", strtotime($startDate));
                        $year       = date("Y", strtotime($startDate));
                        $fmp     = 0;
                        $fma     = 0;
                        $fmtotal = 0;

                        $tdp=0;
                        $tda=0;
                        $total=0;
                        foreach($classSubjects as $CS):
                            $where = array(
                                'subject_id'                => $CS->subject_id,
                                'sec_id'                    => $CS->section_id,
                                'student_id'                => $resRow->student_id,
                                'month(attendance_date)'    => $month,
                                'year(attendance_date)'     => $year,
                            );
                            $from_Month_record = $this->ReportsModel->get_student_att($where);

                            foreach($from_Month_record as $stdAtt):
                                if($stdAtt->status == 1):
                                    if($stdAtt->ca_classcount ==2):
                                            $fmp++;
                                            $fmp++;
                                        else:
                                            $fmp++;
                                        endif;
                                    else:
                                       if($stdAtt->ca_classcount ==2):
                                            $fma++;
                                            $fma++;
                                        else:
                                            $fma++;
                                        endif;
                                    endif;
                                    $fmtotal = $fma+$fmp;
                            endforeach;
                            $wheretotal = array(
                                'sec_id'                    => $CS->section_id,
                                'class_alloted.subject_id'      => $CS->subject_id,
                                'student_id'                    => $resRow->student_id,
                            );

                            $data['start']  = date("Y", strtotime($startDate)).'-'.date("m", strtotime($startDate)).'-01';
                            $data['end']    = date("Y", strtotime($endDate)).'-'.date("m", strtotime($endDate)).'-31';
                            $to_date = $this->ReportsModel->get_student_attendance_date($wheretotal,$data);
                            foreach($to_date as $tstdAtt):
                               if($tstdAtt->status == 1):
                                   if($tstdAtt->ca_classcount ==2):
                                           $tdp++;
                                           $tdp++;
                                       else:
                                           $tdp++;
                                   endif;
                                   else:
                                      if($tstdAtt->ca_classcount ==2):
                                           $tda++;
                                           $tda++;
                                       else:
                                           $tda++;
                                   endif;
                               endif;
                            endforeach;
                        endforeach; 
                        $perstage  = '';
                        $total_classes = $tdp+$tda;
                        if($total_classes):
                            $perstage = $tdp/$total_classes *100;
                        endif;
                        $data = array(
                            'college_no'            => $resRow->college_no,
                            'student_id'            => $resRow->student_id,
                            'std_name'              => $resRow->student_name,
                            'father_name'           => $resRow->father_name,
                            'from_month_present'    => $fmp,
                            'from_month_absent'     => $fma,
                            'total_month_present'   => $tdp,
                            'total_month_absent'    => $tda,
                            'total_classes'         => $total_classes,
                            'sectionName'           => $resRow->sectionName,
                            'perstage'              => round($perstage,2),
                            'user_id'               => $this->userInfo->user_id
                        );
                        $this->CRUDModel->insert('student_position',$data);
                        $sn++;
                    endforeach;
                endif;
                                $this->db->order_by('perstage','desc');
                $posion1     =   $this->db->get_where('student_position',array('user_id'=>$this->userInfo->user_id,'perstage '=>'100'))->result();
                                $this->db->order_by('perstage','desc');
                $posion2     =   $this->db->get_where('student_position',array('user_id'=>$this->userInfo->user_id,'perstage !='=>'100'))->result();
            $sn = 1;
          $defaulter = '';
          $gDifference = '';
          $return_array = array();
           foreach(array_merge($posion1,$posion2) as $stRow):
                        $this->db->select('sum(total_classess) as total_leaves');
                        $this->db->where('leave_date BETWEEN "'.date("Y", strtotime($startDate)).'-'.date("m", strtotime($startDate)).'-01'.'"and "'.date("Y", strtotime($endDate)).'-'.date("m", strtotime($endDate)).'-31'.'"');
                        $this->db->group_by('student_id');    
              $leaeve = $this->db->get_where('student_fine',array('student_id'=>$stRow->student_id))->row();
              $gLeave = '';
              if($leaeve):
                  $gLeave =$leaeve->total_leaves;
                   
              endif;
              
              $return_array[] = array(
                  'sn'              =>$sn,
                  'college_no'      => $stRow->college_no,
                  'std_name'        => strtoupper($stRow->std_name),
                  'father_name'     => strtoupper($stRow->father_name),
                  'sectionName'     => $stRow->sectionName,
                  'total_classes'   => $stRow->total_classes,
                  'tmp'             => $stRow->total_month_present,
                  'month_absent'    => $stRow->total_month_absent,
                  'perstage'        => $stRow->perstage,
                  'ap-leave'        => $gLeave,
              );
               
              $sn++;
          endforeach;
                
                
                
          return $return_array;
            
            
    } 
      public function attendance_group_percentage_subject_report($where=NULL,$like=NULL,$date=NULL,$att_between=NULL){
  
                $this->db->select('
                    student_record.student_id,
                    student_record.college_no,
                    student_record.student_name,
                    student_record.father_name,
                    student_record.form_no,
                    student_record.mobile_no,
                    programes_info.programe_name,
                    sub_programes.name as subprogram,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    sections.sec_id,
                    sections.name as sectionName,
                    admission_date,
                    college_no,
                    student_status.name as status,
                    ');    
                
                
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('student_subject_alloted','student_subject_alloted.student_id=student_record.student_id');
                 
                
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');

                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                
                if($like):
                     $this->db->like($like);
                endif;
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('form_no','asc');
            
            if($where):
                $this->db->where($where);
            endif;
            $result =  $this->db->get('student_record')->result();
            if(!empty($result)):
                $return_array = array();
                foreach($result as $row):
                                $this->db->select("
                                      count(*) as Total_Classes,
                                      count(if(status = '0', 1, NULL)) AS Absent,
                                      (count(*) - count(if(status = '0', 1, NULL))) as Present,
                                        ROUND(((count(*) - count(if(status = '0', 1, NULL)))/ count(*))*100,2) as Percentage
                                  ");
                                  
                                  if(empty($att_between['per_from'])):
                                    $this->db->having('Percentage <=',$att_between['per_to']);
                                else:
                                    $this->db->having('Percentage BETWEEN "'.$att_between['per_from'].'" AND "'.$att_between['per_to'].'"');   
                                endif;
                                 
                                if(empty($date['fromDate'])):
                                    $this->db->where('student_attendance.attendance_date <=',date('Y-m-d', strtotime($date['toDate'])));
                                else:
                                    $this->db->where('student_attendance.attendance_date BETWEEN "'.date('Y-m-d', strtotime($date['fromDate'])).'" AND "'.date('Y-m-d', strtotime($date['toDate'])).'"');   
                                endif;
                                $this->db->join('student_attendance','student_attendance.attend_id=student_attendance_details.attend_id'); 
                    
                $att_details  = $this->db->get_where('student_attendance_details',array('student_id'=>$row->student_id))->row();
                    if(!empty($att_details)):
                        $marks      = $this->CRUDModel->get_student_montly_marks_details($row->student_id,$row->sec_id);
                        
                        $return_array[] = array(
                        'college_no'    => $row->college_no,
                        'student_name'  => $row->student_name,
                        'father_name'   => $row->father_name,
                        'status'        => $row->status,
                        'sectionName'   => $row->sectionName,
                        'mobile_no'     => $row->mobile_no,
                        'marks'         => $marks->Percentage,
                        'Total_Classes' => $att_details->Absent.' + '.$att_details->Present.' = '.$att_details->Total_Classes,
                        'Absent'        =>$att_details->Absent,
                        'Present'       =>$att_details->Present,
                        'Total'         =>$att_details->Total_Classes,
                        'Percentage'    => $att_details->Percentage,
                    );  
                    endif;
                   
                endforeach;
                
                        $keys   = array_column($return_array, 'Percentage');
                        array_multisort($keys, SORT_DESC, $return_array);
                return  json_decode(json_encode($return_array), FALSE); 
           
            
            endif;
           
    }
   

    public function student_white_card($studentId){
        
        $group_allotment = $this->db->get_where('student_group_allotment',array('student_id'=>$studentId))->row();
        $error = '';
        if(!empty($group_allotment) && !empty($group_allotment)):        
            $sectionId       = $group_allotment->section_id;

            $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId));
            if(isset($CheckStd) && !empty($CheckStd)):
                //flag == 1 group_allot
                //flag == 2 subject allot
                if($CheckStd->flag==1):
                        $result           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$studentId,'student_group_allotment.section_id'=>$sectionId)); 
                else:
                        $result           = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$studentId,'student_subject_alloted.section_id'=>$sectionId)); 
                endif;
                $return_array = array(); // final return array
                if(isset($result) && !empty($result)):
                    $fy_id          = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
            // Create Array for Months $month_array
                    $montts_array   = array();
                    $time           = strtotime($fy_id->year_start);
                        $montts_array[] = 'Subject';
                            for($i=1;$i<=12;$i++):
                                $monthi = '+'.$i.'month';
                                $month  = date("M-y", strtotime($monthi, $time));
                                $montts_array[] = $month;
                            endfor;
                        $montts_array[] = 'Total';    
                        $return_array[] = $montts_array;    

            // Get student subjects 
                    if($CheckStd->flag ==1):
                        $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$result->sec_id)); //Class wise ( Medical , Engi CS , all BS)
                    endif;
                    if($CheckStd->flag == 2):
                        $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id)); // Subject Wise (Arts ,A-level)
                    endif;
                    if(isset($classSubjects) && !empty($classSubjects)):
                        $netPresent = '';
                        $netTotal   = '';// Create Subject Array $subject_array  with attendance
                        foreach($classSubjects as $rowCS):
                            $GrandTotal = 0;
                            $granPresent = 0;
                            $subject_array = array();
                            $subject_array[] = substr($rowCS->title,0,20); // Subject Name.
                            for($i=1;$i<=12;$i++):
                                $monthi     = '+'.$i.'month';
                                $month      = date("m", strtotime($monthi, $time));
                                $year       = date("Y", strtotime($monthi, $time));
                                $where      = array(
                                    'subject_id'                => $rowCS->subject_id,
                                    'student_id'                =>$result->student_id,
                                    'month(attendance_date)'    =>$month,
                                    'year(attendance_date)'     =>$year,
                                );
                                $stdAtts = $this->ReportsModel->get_student_att($where);
                                $p=0;
                                $a=0;
                            // Each Subject Attendance count, Absent and Present
                                foreach($stdAtts as $stdAtt):
                                    if($stdAtt->status == 1):
                                        if($stdAtt->ca_classcount ==2):
                                            $p++; $p++;
                                        else:
                                            $p++;
                                        endif;
                                    else:
                                        if($stdAtt->ca_classcount ==2):
                                            $a++; $a++;
                                        else:
                                            $a++;
                                        endif;
                                    endif;
                                endforeach;
                                $total = $a+$p;
                                if($total):
                                    $subject_array[]    = $p.'/'.$total;
                                    $granPresent        += $p; 
                                    $GrandTotal         += $total;
                                else:
                                    $subject_array[]   = '';
                                endif;
                                
                                $per             = 0; 
                                 if(isset($GrandTotal) && !empty($GrandTotal)):
                                  $per = ($granPresent/$GrandTotal)*100;
                                 endif;
 
                            endfor;
                            $netPresent += $granPresent;
                            $netTotal   += $GrandTotal;
 
                            $subject_array[]    = $granPresent.'/'.$GrandTotal.'='.round($per,1)  ;
                            $return_array[]     = $subject_array;
                        endforeach;
            
                        
                    endif;
            // Create Final Array for Each Month and Grand Total 

                    $total_array[]     = '% age';
                    $final_total       = 0;
                    $final_total_a     = 0;
                    $final_total_p     = 0;

                    for($ti=1;$ti<=12;$ti++):
                        $monthti     = '+'.$ti.'month';
                        $month      = date("m", strtotime($monthti, $time));
                        $year       = date("Y", strtotime($monthti, $time));
                        $gfoter_total  = 0 ; 
                        if(isset($classSubjects) && !empty($classSubjects)):
                            $foter_p = 0;
                            $foter_a = 0;
                            $foter_total = 0;
                            foreach($classSubjects as $ta_row):
                                $where_ta= array(
                                    'subject_id'                => $ta_row->subject_id,
                                    'student_id'                =>$result->student_id,
                                    'month(attendance_date)'    =>$month,
                                    'year(attendance_date)'     =>$year,
                                );
                                
                                $QueryTotal = $this->ReportsModel->get_student_att($where_ta);
                                
                                if(isset($QueryTotal) && !empty($QueryTotal)):
                                    $tp=0;
                                    $ta=0;
                                    
                                    foreach($QueryTotal as $TTRow):
                                        if($TTRow->status == 1):
                                            if($TTRow->ca_classcount ==2):
                                                $tp++;
                                                $tp++;
                                            else:
                                                $tp++;
                                            endif;
                                        else:
                                            if($TTRow->ca_classcount ==2):
                                                $ta++;
                                                $ta++;
                                            else:
                                                $ta++;
                                            endif;
                                        endif;
                                    endforeach;
                                    $foter_p += $tp;
                                    $foter_a += $ta;
                                endif;
                            endforeach;
                            $foter_total = $foter_a+$foter_p;                           //Each Month Total
                            if(isset($foter_total) && !empty($foter_total)):            
                                $gfoter_total = round(($foter_p/$foter_total)*100,1).' %';   //Each Month Per%
                            else:
                                $gfoter_total = '';
                            endif;
                            $final_total_a     += $foter_a;
                            $final_total_p     += $foter_p;
                        endif;  
                        $total_array[]     = $gfoter_total;
                    endfor;
                    $final_total = $final_total_a+$final_total_p;                       //Final Total 
                    if(isset($final_total) && !empty($final_total)):
                        $total_array[]     = $final_total_p.'/'.$final_total.' = '.round(($final_total_p/$final_total)*100,1).' %'; // Final Total Result
                    else:
                        $total_array[]     = ''; 
                    endif;
                    $return_array[] = $total_array;
                endif;
            endif;
        else:
            $error = 'Student Section not alloted';
        endif;
        return array(
            'result'        => @$result,
            'Attendance'    => @$return_array,
            'classSubjects' => @$classSubjects,
            'error'         => @$error,
        );
    }
   
}
//