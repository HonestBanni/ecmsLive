<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class SmsModel extends CI_Model
{
 
    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    
    public function student_fee_sms($where=Null,$like=NULL,$std_no=NULL){
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
                        sections.name as sessionName, 
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                       applicant_edu_detail.percentage,
                       applicant_edu_detail.obtained_marks,
                       applicant_edu_detail.total_marks,
                       applicant_edu_detail.total_marks_9th,
                       applicant_edu_detail.obtained_marks_9th,
                        prospectus_batch.batch_name,
                    ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');     
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                $this->db->join("shift","shift.shift_id=student_record.shift_id",'left outer');
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id','left outer');
                if($std_no['std_no_from'] == ''):
                   $this->db->where('applicant_edu_detail.obtained_marks <=',$std_no['std_no_to']);
                    else:
                     $this->db->where('applicant_edu_detail.obtained_marks BETWEEN "'.$std_no['std_no_from'].'" AND "'.$std_no['std_no_to'].'"');   
                endif;
               if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('percentage','desc');
                $this->db->order_by('sections.name','asc');
                 $this->db->order_by('college_no','asc');
                 
       return $this->db->get('student_record')->result();
   }
    public function student_fee_sms_general($where=Null,$like=NULL){
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
                        sections.sec_id, 
                        sections.name as sessionName, 
                        programes_info.programe_id, 
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                        applicant_edu_detail.percentage,
                        applicant_edu_detail.obtained_marks,
                        applicant_edu_detail.total_marks,
                        applicant_edu_detail.total_marks_9th,
                        applicant_edu_detail.obtained_marks_9th,
                        prospectus_batch.batch_name,
                        student_status.name as student_status,
                        sub_programes.name as sub_program,
                        prospectus_batch.batch_name as prospectus_batch,
                    ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');     
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                $this->db->join("shift","shift.shift_id=student_record.shift_id",'left outer');
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id','left outer');
//                if($std_no['std_no_from'] == ''):
//                   $this->db->where('applicant_edu_detail.obtained_marks <=',$std_no['std_no_to']);
//                    else:
//                     $this->db->where('applicant_edu_detail.obtained_marks BETWEEN "'.$std_no['std_no_from'].'" AND "'.$std_no['std_no_to'].'"');   
//                endif;
               if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('percentage','desc');
                $this->db->order_by('sections.name','asc');
                 $this->db->order_by('college_no','asc');
                 
       return $this->db->get('student_record')->result();

  
    }
        public function hostel_students_details($where=NULL){
         $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                             student_record.batch_id,
                             student_record.student_id,
                             student_record.mobile_no,
                             student_record.applicant_mob_no1,
                             hostel_student_record.student_mobile_no,
                             student_record.sub_pro_id,
                             student_record.programe_id,
                             student_record.student_name,
                             student_record.father_name,
                             sections.name as sectionsName,
                             sections.sec_id as section_id,
                             prospectus_batch.batch_name as current_batch,
                             student_status.name as current_status,
                             mobile_network.send_format as mobile_network,
                             mobile_network.net_id
                             
                         ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
                $this->db->join('mobile_network','student_record.net_id=mobile_network.net_id','left outer') ;
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                $this->db->where('hostel_student_record.hostel_status_id',1);

                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.student_id','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->row();
    }
      public function hostel_student_sms($where=Null,$like=NULL){
                $this->db->select(
                        '   student_record.college_no,
                            student_record.student_id,
                            student_record.form_no,
                            hostel_student_record.student_mobile_no,
                            student_record.applicant_mob_no1,
                            student_record.student_name,
                            student_record.s_status_id,
                            student_record.father_name,
                            sections.name as sessionName, 
                            sub_programes.sub_pro_id,
                            prospectus_batch.batch_id,
                           prospectus_batch.batch_name,
                        ');

                    $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                    $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                    $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                    $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                    $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                    $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');
                    $this->db->where('hostel_student_record.hostel_status_id',1);
                   if($where):
                        $this->db->where($where);
                    endif;
                    if($like):
                        $this->db->like($like);
                    endif;
                    $this->db->order_by('sections.name','asc');
                     $this->db->order_by('college_no','asc');

           return $this->db->get('student_record')->result();


        }
    public function staff_sms($where=NULL,$like=NULL){
       
            $this->db->SELECT('
                hr_emp_record.emp_id,
                hr_emp_record.emp_name,
                hr_emp_record.picture,
                hr_emp_record.contact1,
                gender.title as genderName,
                department.title as department,
                hr_emp_designation.title as designation,
                hr_emp_category.title as category,
                hr_emp_scale.title as scale,
                hr_emp_contract_type.title as contract,
                subject.title as subject,
                hr_emp_record.father_name,
                hr_emp_status.title
                ');
        
        
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('gender','gender.gender_id=hr_emp_record.gender_id', 'left outer');
        $this->db->join('subject','subject.subject_id=hr_emp_record.subject_id', 'left outer');
        $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id', 'left outer');
        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
      
            if($like):
                $this->db->like($like);
            endif;
        
            if($where):
                $this->db->where($where);
            endif;
            
            return $this->db->get('hr_emp_record')->result();
   }
     public function student_sms_report($where=Null,$like=NULL,$date=NULL){
            $this->db->select(
                    '   student_record.college_no,
                        student_record.student_id,
                        student_record.form_no,
                        student_record.student_name,
                        student_record.s_status_id,
                        student_record.father_name,
                        sections.name as sessionName, 
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                        student_status.name as student_status,
                        prospectus_batch.batch_name,
                        
                        sms_students.message,
                        sms_students.sender_number,
                        sms_students.message_status,
                        sms_students.send_date,
                        sms_type.title as sms_type_title,
                    ');
            
                $this->db->join('sms_students','sms_students.student_id=student_record.student_id');
                $this->db->join('sms_type','sms_type.id=sms_students.sms_type');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                
                
                if($date['from'] == ''):
                   $this->db->where('sms_students.send_date <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('sms_students.send_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                
                $this->db->order_by('college_no','asc');
               
      return $this->db->get('student_record')->result();
  }
      public function employee_sms_report($where=Null,$like=NULL,$date=NULL){
           $this->db->select('
            hr_emp_record.emp_id,
            hr_emp_record.picture,
            hr_emp_record.emp_name,
            hr_emp_record.father_name,
            department.title as departmentTitle,
            subject.title as subjectTitle,
            hr_emp_designation.title as cdesignation,
            hr_emp_contract_type.title as contracttitle,
            hr_emp_category.title as categorytitle,
            hr_emp_status.title,
            sms_staff.message,
            sms_staff.sender_number,
            sms_staff.send_date,
        ');
            $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer')
                        ->join('subject','subject.subject_id=hr_emp_record.subject_id','left outer')
                        ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')
                        ->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer')        
                        ->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer')
                        ->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id','left outer')
                        ->join('sms_staff','sms_staff.emp_id=hr_emp_record.emp_id');
               
                
                
                if($date['from'] == ''):
                   $this->db->where('sms_staff.send_date <=',date('Y-m-d', strtotime($date['to'])));
                    else:
                     $this->db->where('sms_staff.send_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                endif;
                if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                
                $this->db->order_by('department.department_id','asc');
                $this->db->order_by('hr_emp_record.emp_name','asc');
               
      return $this->db->get('hr_emp_record')->result();
    }
    public function student_fee_sms_date_wise($where=Null,$like=NULL,$date_from=NULL,$date_to=NULL){
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
                        sections.name as sessionName, 
                        sections.sec_id as section_id, 
                        sub_programes.sub_pro_id,
                        prospectus_batch.batch_id,
                        applicant_edu_detail.percentage,
                        applicant_edu_detail.obtained_marks,
                        applicant_edu_detail.total_marks,
                        prospectus_batch.batch_name,
                    ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');     
                // $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
                $this->db->join("student_status","student_status.s_status_id=student_record.s_status_id");
                $this->db->join("shift","shift.shift_id=student_record.shift_id",'left outer');
                $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id','left outer');
               if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('percentage','desc');
                $this->db->order_by('sections.name','asc');
                 $this->db->order_by('college_no','asc');
                 
       $result =  $this->db->get('student_record')->result();
       
       if(!empty($result)):
                $return_array    = '';
       $sn = '';
           foreach($result as $stdRow):
               
                $gPresent       = '';
                $gAbsent        = '';
                $netTotal       = '';
                $Persantage     = '';
                
                             $this->db->join("sections",'sections.sec_id=class_alloted.sec_id');
            $CheckStd = $this->db->get_where('class_alloted',array('sections.sec_id'=>$stdRow->section_id,'sections.status'=>'On'))->row();
               
            if(!empty($CheckStd)):
              
            $class_id   =  $CheckStd->class_id;
            $flag       =  $CheckStd->flag;
         
            //flag == 1 group_allot
            //flag == 2 subject allot
            if($CheckStd->flag==1):
               $result           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$stdRow->student_id,'student_group_allotment.section_id'=>$stdRow->section_id)); 
                else:
                    
                $result           = $this->ReportsModel->get_whiteCard_section(
                        array(
                            'student_subject_alloted.student_id'=>$stdRow->student_id,
                            'student_subject_alloted.section_id'=>$stdRow->section_id
                        )); 
            endif;
            if($flag ==1):
                    $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$stdRow->section_id));
            endif;
             if($flag == 2):
                 $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id));
            endif;
            
                
                $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                $time = strtotime($fy_id->year_start);
                    if($classSubjects):
                        $netPresent     = '';
                        $netTotal       = '';
                        foreach($classSubjects as $rowCS):
                         $GrandTotal = 0;
                         $granPresent = 0;

                        for($i=1;$i<=12;$i++):

                                $monthi     = '+'.$i.'month';
                                $month      = date("m", strtotime($monthi, $time));
                                $year       = date("Y", strtotime($monthi, $time));


                                    $where = array(
                                        'subject_id'                => $rowCS->subject_id,
                                        // 'sec_id'                    => $stdRow->section_id,
                                        'student_id'                =>$result->student_id,
                                        'month(attendance_date)'    =>$month,
                                        'year(attendance_date)'     =>$year,
                                    );
                            $stdAtts = $this->student_attendance_date_wise($where,$date_from,$date_to);

                               $p=0;
                                $a=0;
                            foreach($stdAtts as $stdAtt):

                            if($stdAtt->status == 1):
                                if($stdAtt->ca_classcount ==2):
                                        $p++;
                                        $p++;
                                    else:
                                        $p++;
                                endif;
                                else:
                                   if($stdAtt->ca_classcount ==2):
                                        $a++;
                                        $a++;
                                    else:
                                        $a++;
                                endif;

                            endif;
                          endforeach;

                           $total = $a+$p;

                        $granPresent += $p; 
                         $GrandTotal += $total;
                        $per =0; 
                         if($GrandTotal):
                          $per = ($granPresent/$GrandTotal)*100;

                         endif;
                        endfor;
                            $netPresent += $granPresent;
                            $netTotal += $GrandTotal;

                        endforeach;
                    if($netTotal):


                        $gPresent       = $netPresent;
                        $Persantage       = ($netPresent/$netTotal)*100;
                        $gAbsent        =   $netTotal-$netPresent;

                       else:
                        $gPresent       = '0';
                        $gAbsent        = '0';
                        $netTotal       = '0';
                       endif;
                   endif;
            else:
            $gPresent       = '0';
            $gAbsent        = '0';
            $netTotal       = '0';
            endif;
//            echo '<pre>';print_r($stdRow);die;
          if(!empty($this->input->post("Percentage"))):
              
            if($Persantage < $this->input->post("Percentage")):
                
                $return_array[] = array(
                    'student_id'    => $stdRow->student_id,
                    'college_no'    => $stdRow->college_no,
                    'father_name'   => $stdRow->father_name,
                    'student_name'  => $stdRow->student_name,
                    'sessionName'   => $stdRow->sessionName,
                    'mobile_no'     => $stdRow->mobile_no,
                    'appli_mob_no'  => $stdRow->applicant_mob_no1,
                    'Present'       => $gPresent,
                    'Absent'        => $gAbsent,
                    'Total'         => $netTotal,
                    'Persantage'    => round($Persantage,2),
                );
            endif;
            else:
              $return_array[] = array(
                   
                    'student_id'    => $stdRow->student_id,
                    'college_no'    => $stdRow->college_no,
                    'father_name'   => $stdRow->father_name,
                    'student_name'  => $stdRow->student_name,
                    'sessionName'   => $stdRow->sessionName,
                    'mobile_no'     => $stdRow->mobile_no,
                    'appli_mob_no'  => $stdRow->applicant_mob_no1,
                    'Present'       => $gPresent,
                    'Absent'        => $gAbsent,
                    'Total'         => $netTotal,
                    'Persantage'    => round($Persantage,2),
                );
          endif;
            
            
           endforeach;
       endif;
        if(!empty($return_array)):
                $keys   = array_column($return_array, 'Persantage');
                array_multisort($keys, SORT_ASC, $return_array);
        return  json_decode(json_encode($return_array), FALSE);
    else:
        return false;
        endif;
    }
    public function student_attendance_date_wise($where,$date_from=NULL,$date_to=NULL){
           
            $this->db->from('class_alloted');
            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
            $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
             if(!empty($date_from) && !empty($date_to)):
                  $this->db->where('student_attendance.attendance_date BETWEEN "'.date('Y-m-d', strtotime($date_from)).'" AND "'.date('Y-m-d', strtotime($date_to)).'"'); 
              endif;  
            if($where):
               $this->db->where($where);
            endif;
         return $this->db->get()->result();
        }
   }
