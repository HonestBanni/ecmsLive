<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class GuiModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_by_id($table,$id){
    $query = $this->db->select('*')
            ->from($table)
            ->where($id)
            ->get();
      return $query->result();
    }
    
    public function empAttendanceDataWhere($where){
            $this->db->SELECT('
                teacher_attendance.*,
                hr_emp_record.emp_id,
                hr_emp_record.emp_name,
                hr_emp_record.picture,
                hr_emp_designation.title as designation
                ');
        
            $this->db->FROM('teacher_attendance');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=teacher_attendance.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
        $this->db->where($where);
        $this->db->where('hr_emp_record.cat_id',1);
        $this->db->group_by('hr_emp_record.emp_id');
        $this->db->order_by('teacher_attendance.t_attend_id','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;         
   }
    
    public function empAttenDataWhere($where){
       
            $this->db->SELECT('
                hr_emp_record.emp_id
                ');
        
            $this->db->FROM('teacher_attendance');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=teacher_attendance.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
        $this->db->where('hr_emp_record.cat_id',1);
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            $return_array = '';
            foreach($query->result() as $key=>$value):
                $return_array[] = $value->emp_id;
            endforeach;
        return $return_array;
        endif;      
        
   }
    
    public function empAbsentDataWhere(){
       
            $this->db->SELECT('
                hr_emp_record.emp_id
                ');
            $this->db->FROM('hr_emp_record');
         $this->db->where('cat_id','1');
         $this->db->where('emp_status_id','1');
        $query =  $this->db->get();
         if($query):
            $return_array = '';
            foreach($query->result() as $key=>$value):
                $return_array[] = $value->emp_id;
            endforeach;
        return $return_array;
        endif;       
   }
    
    public function empAttendanceDatas(){
       
            $this->db->SELECT('
                teacher_attendance.*,
                hr_emp_record.emp_id,
                hr_emp_record.emp_name,
                hr_emp_record.picture,
                hr_emp_designation.title as designation
                ');
        
//            $this->db->FROM('');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=teacher_attendance.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
        $this->db->where('in_date', date('Y-m-d'));
//        $this->db->where('in_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $this->db->where('hr_emp_record.cat_id',1);
        $this->db->group_by('hr_emp_record.emp_id');
        $this->db->order_by('teacher_attendance.t_attend_id','desc');
        return $this->db->get('teacher_attendance')->result();
//        if($query):
//            return $query->result();
//        endif;      
        
   }
    
    public function empAttendanceData(){
       
            $this->db->SELECT('
                 
                hr_emp_record.emp_id,
                
                ');
        
            $this->db->FROM('teacher_attendance');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=teacher_attendance.emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
        $this->db->where('in_date', date('Y-m-d'));
        $this->db->where('hr_emp_record.cat_id',1);
        $query =  $this->db->get();
        if($query):
            $return_array = '';
            foreach($query->result() as $key=>$value):
                $return_array[] = $value->emp_id;
        
            endforeach;
        return $return_array;
        endif;      
        
   }
    
    public function empAbsentData(){
       
            $this->db->SELECT('
                hr_emp_record.emp_id
                ');
            $this->db->FROM('hr_emp_record');
      //  $this->db->join('teacher_attendance','teacher_attendance.emp_id=hr_emp_record.emp_id');
         $this->db->where('cat_id','1');
         $this->db->where('emp_status_id','1');
        // $this->db->where('in_date', date('Y-m-d', strtotime(date('d-m-Y'))));
        $query =  $this->db->get();
         if($query):
            $return_array = '';
            foreach($query->result() as $key=>$value):
                $return_array[] = $value->emp_id;
            endforeach;
        return $return_array;
        endif;       
   }
    
    public function year_wise_Chines_report($where=NULL,$where_id=NULL){
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');   
                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
            if($where_id):
                
                $this->db->where_in('student_record.sub_pro_id',$where_id);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            
              return $this->db->get('student_record')->result();
            
    }
    
    public function getTEmployee($table,$where=NULL)
    {
        $query = $this->db->select('
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            hr_emp_record.dob,
            hr_emp_record.joining_date,
            hr_emp_record.retirement_date,
            department.title as department,
            hr_emp_designation.title as cdesignation,
            hr_emp_scale.title as cscale
        ');
         $this->db->from($table);
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
         $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer'); 
         $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id','left outer'); 
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where('hr_emp_record.emp_status_id','1');
        $this->db->order_by('joining_date','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_teacherBaseprac($where){
            $this->db->select(
                    'hr_emp_record.emp_name,
                    hr_emp_record.emp_id,
                    practical_alloted.practical_class_id,
                    practical_alloted.subject_id,
                    practical_group.group_name as group_name
                ');
                $this->db->join('hr_emp_record','hr_emp_record.emp_id=practical_alloted.emp_id');
                $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id');
                $this->db->order_by('hr_emp_record.emp_name','asc');
                $this->db->where('hr_emp_record.emp_status_id',1);
        return $this->db->where($where)->get('practical_alloted')->result();
    }
    
    public function get_empData($table,$where=NULL,$like=NULL){
       
            $this->db->SELECT('
                hr_emp_record.emp_id,
                hr_emp_record.emp_name,
                hr_emp_record.picture,
                gender.title as genderName,
                department.title as department,
                hr_emp_designation.title as designation,
                hr_emp_scale.title as scale,
                hr_emp_contract_type.title as contract,
                hr_emp_status.title as status,
                hr_emp_record.father_name,
                ');
        
            $this->db->FROM($table);
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id', 'left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
            if($like):
                $this->db->like($like);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $query =  $this->db->get();
            if($query):
                return $query->result();
            endif;      
   }
    
    public function teaching_staff($where){
        $this->db->select('hr_emp_record.*,hr_emp_category.title as category,hr_emp_status.title as status,hr_emp_designation.title as designation,hr_emp_scale.title as scale,hr_emp_contract_type.title as contract');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id','left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id','left outer');
        $this->db->group_by('hr_emp_record.emp_id');     
        return $this->db->where($where)->get('hr_emp_record')->result();
    }
    
    public function profileEmployee($where)
    {
       $query = $this->db->select('
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            hr_emp_record.emp_husband_name,
            hr_emp_record.nic,
            hr_emp_record.dob,
            hr_emp_record.postal_address,
            hr_emp_record.permanent_address,
            hr_emp_record.post_office,
            hr_emp_record.ptcl_number,
            hr_emp_record.contact1,
            hr_emp_record.contact2,
            hr_emp_record.emp_personal_no,
            hr_emp_record.gp_fund_no,
            hr_emp_record.email,
            hr_emp_record.joining_date,
            hr_emp_record.account_no,
            hr_emp_record.comment,
            hr_emp_record.additional_responsibilty,
            hr_emp_record.c_emp_scale_id,
            hr_emp_record.current_designation,
            department.title as department,
            gender.title as genderTitle,
            subject.title as subjectTitle,
            hr_emp_category.title as categorytitle,
            district.name as district,
            country.name as country,
            blood_group.title as blood,
            religion.title as religion,
            marital_status.title as marital,
            hr_emp_contract_type.title as contract,
            hr_emp_scale.title as joiningscale,
            hr_emp_designation.title as jdesignation,
            shift.name as shiftname,
            bank.name as bankname,
            hr_emp_status.title as statustitle,
        ')
    ->from('hr_emp_record')
    ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
    ->join('subject','subject.subject_id=hr_emp_record.subject_id','left outer')  
    ->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer')
    ->join('gender','gender.gender_id=hr_emp_record.gender_id','left outer')
    ->join('district','district.district_id=hr_emp_record.district_id','left outer')
    ->join('country','country.country_id=hr_emp_record.country_id','left outer')
    ->join('blood_group','blood_group.b_group_id=hr_emp_record.bg_id','left outer')
    ->join('religion','religion.religion_id=hr_emp_record.religion_id','left outer')
    ->join('marital_status','marital_status.marital_status_id=hr_emp_record.marital_status_id','left outer')
    ->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer')
    ->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.j_emp_scale_id','left outer')
    ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.joining_designation','left outer')
    ->join('shift','shift.shift_id=hr_emp_record.shift_id','left outer')
    ->join('bank','bank.bank_id=hr_emp_record.bank_id','left outer')
    ->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id','left outer')
     ->where($where)
     ->get();
        return $query->result();  
    }
    
    public function hr_grant_in_add($where){
        $query = $this->db->select('hr_emp_grant_in_aid.*,hr_emp_record.emp_id,hr_emp_record.emp_name,department.title as dept,degree.title as degree,hr_emp_status_bond.*')
                 ->from('hr_emp_grant_in_aid')
                 ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_grant_in_aid.emp_id','left outer')  
                 ->join('department','department.department_id=hr_emp_record.department_id','left outer')  
                 ->join('degree','degree.degree_id=hr_emp_grant_in_aid.degree_id','left outer')     
                 ->join('hr_emp_status_bond','hr_emp_status_bond.status_bond_id=hr_emp_grant_in_aid.status_bond_id','left outer')     
                 ->where($where)
                 ->order_by('amount_coll_date','asc')
                 ->get();
        return $query->result();
    }
    
    public function hr_edu_record($where){
        $query = $this->db->select('
            hr_emp_education.emp_edu_id,
            hr_emp_record.emp_name,
            degree.title as Degreetitle,
            board_university.title as bordTitle,
            hr_emp_education.passing_year,
            hr_emp_education.percentage,
            hr_emp_education.cgpa,
            hr_emp_education.hec_verified,
            hr_emp_division.name as divisiontitle,
        ')
                 ->from('hr_emp_education')
                 ->join('hr_emp_record','hr_emp_record.emp_id=hr_emp_education.emp_id','left outer')  
                 ->join('degree','degree.degree_id=hr_emp_education.degree_id','left outer')  
                 ->join('board_university','board_university.bu_id=hr_emp_education.bu_id','left outer')  
                 ->join('hr_emp_division','hr_emp_division.devision_id=hr_emp_education.div_id','left outer')   
                 ->where($where)
                ->order_by('passing_year','desc')
                 ->get();
        return $query->result();
    }
    
    public function teacher_performance_report($where){
       
                $this->db->select('emp_name,father_name,title as emp_design,attendance_date, sections.name as section_name');
                $this->db->from('student_attendance');
                $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
                $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation');
                $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
                $this->db->order_by('attend_id','desc');
                $this->db->where('emp_status_id',1);
                $this->db->where($where);
        return $this->db->get()->result();
    }
    public function teacher_allocted_subject($where){
  
        
                $this->db->select(
                        '   emp_name,hr_emp_record.emp_id,
                            class_alloted.class_id,
                            class_alloted.sec_id,
                            count(attend_id) as countMontly
                        ');
                $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
                $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id','right outer');
                
//                $this->db->where($where1);
                
                $this->db->group_by('hr_emp_record.emp_id');
                $this->db->order_by('countMontly','desc');
                    
        return $this->db->where($where)->get('class_alloted')->result();
    }
    public function get_teacherBaseClass($where){
       
                $this->db->select(
                        '   emp_name,
                            hr_emp_record.emp_id,
                            class_alloted.class_id,
                            class_alloted.subject_id,
                            sections.name as sectionName
                            ');
                $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id');
                $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
                $this->db->order_by('hr_emp_record.emp_name','asc');
                $this->db->where('hr_emp_record.emp_status_id',1);
        return $this->db->where($where)->get('class_alloted')->result();
    }
    public function religion_base(){
       
            $this->db->select('title ,count(student_record.religion_id) as total');
            $this->db->from('student_record');
            $this->db->join('religion','religion.religion_id=student_record.religion_id');
            $this->db->group_by('student_record.religion_id');
            $this->db->order_by('student_record.religion_id','asc');
            $this->db->where('student_record.s_status_id',5);
            return $this->db->get()->result();
    }
 
 
    public function enrolled_gender_report($where=NULL,$where_id=NULL){
//                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
//                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
                $this->db->group_by('student_record.college_no');
            if($where_id):
                
                $this->db->where_in('student_record.sub_pro_id',$where_id);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            
              return $this->db->get('student_record')->result();
            
    }
    public function year_wise_gender_report($where=NULL,$where_id=NULL){
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
                $this->db->group_by('student_record.college_no');
            if($where_id):
                
                $this->db->where_in('student_record.sub_pro_id',$where_id);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            
              return $this->db->get('student_record')->result();
            
    }
 
 
 
  public function count_grand_report($field,$where=NULL,$where_in_fsub=NULL){
             
        $this->db->select($field);    
        $this->db->from('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
        $this->db->group_by('sections.sec_id');
        $this->db->order_by('sections.sec_id','asc');
        $this->db->where($where);
        $this->db->where_in('student_record.sub_pro_id',$where_in_fsub);
  return $this->db->get()->result();
  }
      public function count_grand_reports($field,$where=NULL,$where_in_ssub=NULL){
             
        $this->db->select($field);    
        $this->db->from('student_record');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id');
        $this->db->group_by('sections.sec_id');
        $this->db->order_by('sections.sec_id','asc');
        $this->db->where($where);
        $this->db->where_in('student_record.sub_pro_id',$where_in_ssub);
  return $this->db->get()->result();
 }
 
  public function studetn_quta_wise(){
                $this->db->select('count(student_record.rseats_id) as count , reserved_seat.name');
                $this->db->join('student_record','student_record.rseats_id=reserved_seat.rseat_id');
                $this->db->group_by('reserved_seat.rseat_id');
                $this->db->order_by('reserved_seat.name','asc');
        return $this->db->where('student_record.s_status_id','5')->get('reserved_seat')->result();
   }
  public function program_wise(){
                $this->db->select('count(programes_info.programe_id) as count , programe_name');
                 $this->db->join('student_record','student_record.programe_id=programes_info.programe_id');
                 $this->db->group_by('programes_info.programe_id');
                $this->db->order_by('programes_info.programe_name','asc');
                $this->db->where('student_record.s_status_id','5');
        return $this->db->get('programes_info')->result();
   }
  public function district_wise(){
                $this->db->select('count(district.district_id) as Total , district.name');
                 $this->db->join('student_record','student_record.district_id=district.district_id');
                 $this->db->group_by('district.district_id');
                $this->db->order_by('district.district_id','asc');
                $this->db->where('student_record.s_status_id','5');
        return $this->db->get('district')->result();
   }

    public function category_wise(){
                $this->db->select('title, count(hr_emp_category.cat_id) as total');
                $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id'); 
                $this->db->group_by('hr_emp_category.cat_id');
               $this->db->where('hr_emp_record.emp_status_id',1);
        return  $this->db->get('hr_emp_record')->result();
    }
    public function status_wise(){
                $this->db->select('title, count(hr_emp_status.emp_status_id) as total');
                $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id'); 
                $this->db->group_by('hr_emp_status.emp_status_id');
                $this->db->where('hr_emp_record.emp_status_id',1);
        return  $this->db->get('hr_emp_record')->result();
    }
    public function contract_wise(){
                $this->db->select('title, count(hr_emp_contract_type.contract_type_id) as total');
                $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id'); 
                $this->db->group_by('hr_emp_contract_type.contract_type_id');
                $this->db->where('hr_emp_record.emp_status_id',1);
        return  $this->db->get('hr_emp_record')->result();
    }
    public function designation_wise(){
                $this->db->select('title, count(hr_emp_designation.emp_desg_id) as total');
                $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation'); 
                $this->db->group_by('hr_emp_designation.emp_desg_id');
                $this->db->order_by('hr_emp_designation.title','asc');
                $this->db->where('hr_emp_record.emp_status_id',1);
        return  $this->db->get('hr_emp_record')->result();
    }
    public function scale_wise(){
                $this->db->select('title, count(hr_emp_scale.emp_scale_id) as total');
                $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id'); 
                $this->db->group_by('hr_emp_scale.emp_scale_id');
                $this->db->order_by('hr_emp_scale.title','asc');
                $this->db->where('hr_emp_record.emp_status_id',1);
        return  $this->db->get('hr_emp_record')->result();
    }
    public function get_main_cat_itesm(){
                 $this->db->select('invt_items.catm_id, catm_name,count(invt_items.catm_id) as total , sum(item_quantity) as quantity');
                 $this->db->join('invt_main_category','invt_items.catm_id=invt_main_category.catm_id' ); 
                 $this->db->group_by('invt_items.catm_id');
                 $this->db->order_by('catm_name','asc');
//                $this->db->where('catm_id','1');
        return  $this->db->get('invt_items')->result();
    }
    public function get_invt_nature(){
                $this->db->select('cat_name,count(invt_category.cat_id) as quantity');
                $this->db->join('invt_items','invt_items.itm_catId=invt_category.cat_id' ); 
                $this->db->group_by('invt_category.cat_id');
                $this->db->order_by('cat_name','asc');
              
        return  $this->db->get('invt_category')->result();
    }
    public function dep_wise_issue(){
//                $this->db->select('cat_name,count(invt_category.cat_id) as quantity');
                $this->db->join('invt_items_assuance','invt_items_assuance.dept_id=invt_item_issuance_department.iss_dept_id' ); 
                $this->db->group_by('invt_item_issuance_department.iss_dept_id');
                $this->db->order_by('invt_item_issuance_department.dept_name','asc');
              
        return  $this->db->get('invt_item_issuance_department')->result();
    }
    public function current_datewise_issue($where,$date){
                 $this->db->select('itm_name,count(invt_items_assuance_details.quantity) as quantity');
                $this->db->join('invt_items_assuance_details','invt_items_assuance_details.ass_id=invt_items_assuance.ass_id' ); 
                $this->db->join('invt_items','invt_items.itm_id=invt_items_assuance_details.item_id' ); 
                $this->db->group_by('invt_items.itm_id');    
                $this->db->order_by('invt_items.itm_name','asc');    
                $this->db->where('issuance_date BETWEEN "'.$date['from_date'].'" and "'.$date['to_date'].'"');
                $this->db->where($where);
        return  $this->db->get('invt_items_assuance')->result();
    }
    
    public function invt_block_wise(){

        $result =   $this->db->get('invt_building_block')->result();
        foreach($result as $row):
                
            $this->db->select('rm_name,count(rm_bbId) as quantity');
            $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_roomId=invt_rooms.rm_id' ); 
            $this->db->group_by(' rm_bbId');
             $result_rooms = $this->db->where('rm_bbId',$row->bb_id)->get('invt_rooms')->row();
            
             if(!empty($result_rooms)):
                 $array[] = array(
                   'bb_name' =>$row->bb_name,  
                   'quantity' =>$result_rooms->quantity,  
                 );
             endif;
        endforeach;
        
        return json_decode(json_encode($array));
    }
       public function invt_stock(){

       return $this->db->where('item_quantity >','')->get('invt_items')->result();
     }
       public function invt_stock_deprt(){

//                  $this->db->select('count(bb_id) as count');  
                  $this->db->join('invt_rooms','invt_rooms.rm_bbId=invt_building_block.bb_id');  
                  $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_roomId=invt_rooms.rm_id');  
                  $this->db->group_by('bb_id');
                  $this->db->order_by('bb_name');
          return  $this->db->get('invt_building_block')->result();
 
     }
       public function invt_block_details($where){

            $this->db->select('itm_name,count(itm_id) as Total');
            $this->db->join('invt_rooms','invt_rooms.rm_bbId=invt_building_block.bb_id');  
            $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_roomId=invt_rooms.rm_id');  
            $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.fid_itemId');  
            $this->db->group_by('itm_id');
//            $this->db->order_by('itm_name');
          return  $this->db->where($where)->get('invt_building_block')->result();
 
     }
     public function get_all_emp($where){
               $this->db->where('hr_emp_record.emp_status_id',1);
       return  $this->db->order_by('emp_name','asc')->where($where)->get('hr_emp_record')->result();
     }
    
    public function subject_wise_perfor($where)
    {    
        $this->db->join('class_alloted','class_alloted.emp_id=hr_emp_record.emp_id');
        $this->db->join('subject','subject.subject_id=class_alloted.subject_id');    
        $this->db->join('sections','sections.sec_id=class_alloted.sec_id');  
        $this->db->group_by('subject.subject_id');
        $this->db->group_by('hr_emp_record.emp_id');
        return $this->db->order_by('emp_name','asc')->where($where)->get('hr_emp_record')->result();
     }
    
    public function subject_assigned()
    {
        $pro = $this->db->query("SELECT MAX(class_id),hr_emp_record.emp_id,hr_emp_record.emp_name,subject.subject_id,subject.title,sections.name, GROUP_CONCAT(sections.sec_id SEPARATOR ' , ') sec_id,GROUP_CONCAT(sections.name SEPARATOR ' , ') sec_name FROM class_alloted INNER JOIN `hr_emp_record` ON hr_emp_record.emp_id = class_alloted.emp_id INNER JOIN `subject` ON subject.subject_id = class_alloted.subject_id INNER JOIN `sections` ON sections.sec_id = class_alloted.sec_id WHERE flag=2 GROUP BY `emp_id`, `subject_id`");
        return $pro->result();    
    }
    
    public function subject_wise_perfor1($where){
         
//               $this->db->select('
//                            emp_name,
//                            subject.title as subject_title,
//                            sections.name as section_name
//                       '); 
               $this->db->join('class_alloted','class_alloted.emp_id=hr_emp_record.emp_id');
               $this->db->join('subject','subject.subject_id=class_alloted.subject_id');    
               $this->db->join('sections','sections.sec_id=class_alloted.sec_id');  
               $this->db->order_by('emp_name','asc');
        return $this->db->order_by('emp_name','asc')->where($where)->get('hr_emp_record')->result();
     }
     
//    public function subject_wise_perfor($where){
//         
//          
//               $this->db->join('class_alloted','class_alloted.emp_id=hr_emp_record.emp_id');
//               $this->db->join('subject','subject.subject_id=class_alloted.subject_id');    
//               $this->db->join('sections','sections.sec_id=class_alloted.sec_id');  
//               $this->db->order_by('emp_name','asc');
//               $this->db->where('hr_emp_record.emp_status_id',1);
//               $this->db->where('flag',2);
//               $this->db->group_by('subject.subject_id');
//       return  $this->db->order_by('emp_name','asc')->where($where)->get('hr_emp_record')->result();
//     }
        public function student_general_report(){
                $this->db->select('count(student_record.student_id) as Total , student_status.name');
                $this->db->join('student_record','student_record.s_status_id=student_status.s_status_id');
                $this->db->group_by('student_status.s_status_id');
                $this->db->order_by('student_status.name','asc');
//              
        return $this->db->get('student_status')->result();
    }
}
