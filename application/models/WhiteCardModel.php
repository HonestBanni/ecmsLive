<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class WhiteCardModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    public function StudentWhiteCard($studentId){
        
        // $student_informations = $this->white_card_student_informations(array('student_record.student_id'=>$studentId));

        $return = array( 
            'student_informations'  => $this->white_card_student_informations(array('student_record.student_id'=>$studentId)),
            'montly_attendance'     => $this->white_card_montly_attendance($studentId),
            'montly_exame'          => $this->white_card_montly_marks_details($studentId),
        );
        // echo '<pre>';print_r($return);
        return $return;
        
        
    }
    public function white_card_montly_marks_details($studentId){
        $fy_id          = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
        // Create Array for Months $month_array
        $return_array   = array();
        $montts_array   = array();
        $time           = strtotime($fy_id->year_start);

        
        $group_allotment = $this->db->get_where('student_group_allotment',array('student_id'=>$studentId))->row(); 
        if(isset($group_allotment) && !empty($group_allotment)):

            $montts_array[] = 'Subjects';
                for($i=1;$i<=12;$i++):
                    $monthi = '+'.$i.'month';
                    $month  = date("M-y", strtotime($monthi, $time));
                    $montts_array[] = $month;
                endfor;
            $montts_array[] = 'Total';    
            $montts_array[] = 'Pre Board';  

            $return_array[] = $montts_array;
        

                $sectionId       = $group_allotment->section_id;
                $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId));
                // Get student subjects 
                if($CheckStd->flag ==1):
                    $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$sectionId)); //Class wise ( Medical , Engi CS , all BS)
                endif;
                if($CheckStd->flag == 2):
                    $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$studentId)); // Subject Wise (Arts ,A-level)
                endif;
                $month      = date("m", strtotime($monthi, $time));
                $year       = date("Y", strtotime($monthi, $time));
                
                $ttl_obt_pb = '';
                $ttl_tm_pb  = '';
                $subject_array_fn = array();
                foreach($classSubjects as $rowCS):
                    $totalOb = '';
                    $totaltm = '';
                    $subject_array      = array();
                    
                    $subject_array[]    = substr($rowCS->title,0,17);
                    for($i=1;$i<=12;$i++):
                        $monthi     = '+'.$i.'month';
                        $month      = date("m", strtotime($monthi,$time));
                        $year       = date("Y", strtotime($monthi,$time));
                        $where     = array(
                            'class_alloted.subject_id'          => $rowCS->subject_id,
                            'monthly_test_details.student_id'   => $studentId,
                            'month(test_date)'                  => $month,
                            'year(test_date)'                   => $year,
                            );
                        $testRes1 = $this->ReportsModel->get_test_marks($where);
                                
                            if(!empty($testRes1->omarks)):
                                
                                $subject_array[] = @$testRes1->omarks.'/'.@$testRes1->tmarks;
                                $totalOb += $testRes1->omarks;
                                $totaltm += $testRes1->tmarks;
                            else:
                                
                                if(!empty($testRes1->tmarks)):
                                    $totaltm += $testRes1->tmarks; 
                                    $subject_array[] = @$testRes1->omarks.'/'.@$testRes1->tmarks;
                                else:
                                    $subject_array[] = '';
                                endif;
                            endif;
                        endfor;
                    if(!empty($totaltm)):
                        $totalMarksPer = ($totalOb/$totaltm)*100;
                        $totalOb_show = '';
                        if($totalOb == 0):
                            $totalOb_show = 0;
                        else:
                            $totalOb_show =$totalOb;
                        endif;
                            $subject_array[] =$totalOb_show.'/'.$totaltm.'='.round($totalMarksPer,3);
                    else:
                                
                            $subject_array[] = '';
                    endif;
                    // Pre Board Marks
                            $this->db->select('
                                pre_board_test_details.omarks,
                                pre_board_test_details.tmarks
                            ');
                            $this->db->join('pre_board_test', 'pre_board_test.test_id=pre_board_test_details.test_id', 'left outer');
                            $this->db->join('class_alloted', 'class_alloted.class_id=pre_board_test.class_id', 'left outer');
                            $this->db->where(array('class_alloted.subject_id' => $rowCS->subject_id, 'pre_board_test_details.student_id' => $studentId));
                    $pb_marks = $this->db->get('pre_board_test_details')->row();
                
                    
                    if(!empty($pb_marks)):
                        $subject_array[] =  $pb_marks->omarks.'/'.$pb_marks->tmarks;
                        $ttl_obt_pb     += $pb_marks->omarks;
                        $ttl_tm_pb      += $pb_marks->tmarks;
                    else:
                        $subject_array[] = '';
                    endif;
                    $return_array[] =   $subject_array;
                endforeach;

                // Final Calucation 
                $Final_array[] = '% age';
                $Final_Result  = '';
                $Final_Result_OM   = '';
                $Final_Result_TM   = '';
                
                for($i=1;$i<=12;$i++):
                    $Final_ObMarks  = '';
                    $Final_TtMarks  = '';
                    $monthi     = '+'.$i.'month';
                    $month      = date("m", strtotime($monthi,$time));
                    $year       = date("Y", strtotime($monthi,$time));
                    foreach($classSubjects as $rowFT):
                        $where     = array(
                            'class_alloted.subject_id'          => $rowFT->subject_id,
                            'monthly_test_details.student_id'   => $studentId,
                            'month(test_date)'                  => $month,
                            'year(test_date)'                   => $year,
                            );
                        $testRes1 = $this->ReportsModel->get_test_marks($where);
                        if(isset($testRes1) && !empty($testRes1)):
                            $Final_ObMarks  += $testRes1->omarks;
                            $Final_TtMarks  += $testRes1->tmarks;
                        endif;
                    endforeach;

                    $Final_Result = $Final_ObMarks+$Final_TtMarks;

                    if(isset($Final_Result) && !empty($Final_Result)):
                        if($Final_ObMarks == 0):
                            $Final_array[] = $Final_ObMarks.'/'.$Final_TtMarks.' = 0 '; 
                        else:
                            $Final_array[] = $Final_ObMarks.'/'.$Final_TtMarks.' =  '.round(($Final_ObMarks/$Final_TtMarks)*100,2);
                        endif;
                    else:
                        $Final_array[] = '';
                    endif;
                    $Final_Result_OM   += $Final_ObMarks;
                    $Final_Result_TM   += $Final_TtMarks;

                endfor;
                if(isset($Final_Result_OM) && !empty($Final_Result_OM)):

                    $Final_array[] = $Final_Result_OM.'/'.$Final_Result_TM.' = '.round(($Final_Result_OM/$Final_Result_TM)*100,2);
                else:
                    $Final_array[] = $Final_Result_OM.'/'.$Final_Result_TM;
                endif;
                
                
                    //Pre Board Marks Total
                    if($ttl_tm_pb == 0):
                        $Final_array[] = '';
                    else:
                        $pb_age = $ttl_obt_pb / $ttl_tm_pb * 100;
                        $Final_array[] =$ttl_obt_pb.'/'.$ttl_tm_pb.'= '.$ttl_obt_pb.'/'.$ttl_tm_pb;
                    endif;
                $return_array[] =  $Final_array; 
        endif;
        return $return_array;

    } 
    public function white_card_montly_attendance($studentId){
        $group_allotment = $this->db->get_where('student_group_allotment',array('student_id'=>$studentId))->row();
        $return_array = array(); // final return array
        if(!empty($group_allotment) && !empty($group_allotment)):
            $sectionId       = $group_allotment->section_id;
            $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId));
            if(isset($CheckStd) && !empty($CheckStd)):
                //flag == 1 group_allot
                //flag == 2 subject allot
                $fy_id          = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                // Create Array for Months $month_array
                $montts_array   = array();
                $time           = strtotime($fy_id->year_start);
                $montts_array[] = 'Subjects';
                    for($i=1;$i<=12;$i++):
                        $monthi = '+'.$i.'month';
                        $month  = date("M-y", strtotime($monthi, $time));
                        $montts_array[] = $month;
                    endfor;
                $montts_array[] = 'Total';    
                $return_array[] = $montts_array; 
                // Get student subjects 
                if($CheckStd->flag ==1):
                    $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$sectionId)); //Class wise ( Medical , Engi CS , all BS)
                endif;
                if($CheckStd->flag == 2):
                    $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$studentId)); // Subject Wise (Arts ,A-level)
                endif;
                if(isset($classSubjects) && !empty($classSubjects)):
                    $netPresent = '';
                    $netTotal   = '';
                    // Create Subject Array $subject_array  with attendance
                    foreach($classSubjects as $rowCS):
                        $GrandTotal     = 0;
                        $granPresent    = 0;
                        $subject_array  = array();
                        $subject_array[] = substr($rowCS->title,0,20); // Subject Name.
                        for($i=1;$i<=12;$i++):
                            $monthi     = '+'.$i.'month';
                            $month      = date("m", strtotime($monthi, $time));
                            $year       = date("Y", strtotime($monthi, $time));
                            $where      = array(
                                'subject_id'                => $rowCS->subject_id,
                                'student_id'                => $studentId,
                                'month(attendance_date)'    => $month,
                                'year(attendance_date)'     => $year,
                            );
                            $stdAtts = $this->get_students_attendance_details($where);
                            if(isset($stdAtts ) && !empty($stdAtts)):
                                // echo '<pre>';print_r($stdAtts);
                           
                                    
                                    $p=0;
                                    $a=0;
                            // Each Subject Attendance count, Absent and Present
                                    // foreach($stdAtts as $stdAtt):
                                    //     if($stdAtt->status == 1):
                                    //         if($stdAtt->ca_classcount ==2):
                                    //             $p++; $p++;
                                    //         else:
                                    //             $p++;
                                    //         endif;
                                    //     else:
                                    //         if($stdAtt->ca_classcount ==2):
                                    //             $a++; $a++;
                                    //         else:
                                    //             $a++;
                                    //         endif;
                                    //     endif;
                                    // endforeach;
                       
                                    $total = $stdAtts->a+$stdAtts->p;
                                    if($total):
                                        $subject_array[]    = $stdAtts->p.'/'.$total;
                                        $granPresent        += $stdAtts->p; 
                                        $GrandTotal         += $total;
                                    else:
                                        $subject_array[]   = '';
                                    endif;
                                    
                                    $per             = 0; 
                                    if(isset($GrandTotal) && !empty($GrandTotal)):
                                    $per = ($granPresent/$GrandTotal)*100;
                                    endif;
                                endif;
                        endfor;
                        $netPresent += $granPresent;
                        $netTotal   += $GrandTotal;

                        $subject_array[]    = $granPresent.'/'.$GrandTotal.'='.round($per,1)  ;
                        $return_array[]     = $subject_array;
                    endforeach;
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
                                    'student_id'                => $studentId,
                                    'month(attendance_date)'    => $month,
                                    'year(attendance_date)'     => $year,
                                );
                                
                                $QueryTotal = $this->get_students_attendance_details($where_ta);
                                
                                if(isset($QueryTotal) && !empty($QueryTotal)):
                                    $tp=0;
                                    $ta=0;
                                    
                                    // foreach($QueryTotal as $TTRow):
                                    //     if($TTRow->status == 1):
                                    //         if($TTRow->ca_classcount ==2):
                                    //             $tp++;
                                    //             $tp++;
                                    //         else:
                                    //             $tp++;
                                    //         endif;
                                    //     else:
                                    //         if($TTRow->ca_classcount ==2):
                                    //             $ta++;
                                    //             $ta++;
                                    //         else:
                                    //             $ta++;
                                    //         endif;
                                    //     endif;
                                    // endforeach;
                                    $foter_p += $QueryTotal->p;
                                    $foter_a += $QueryTotal->a;
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
        endif;
        return $return_array;

    }
    public function get_students_attendance_details($where){
        // count(case Position when 'Manager' then 1 else null end)
         $this->db->select('COUNT(case status when "1" then 1 else null end) as p,COUNT(case status when "0" then 1 else null end) as a');
         $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
         $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
         
       if($where):
          $this->db->where($where);
       endif;
    return $this->db->get('class_alloted')->row();
   } 
    public function white_card_student_informations($where){
        $this->db->select('
                prospectus_batch.batch_name,
                student_record.student_id,
                student_record.student_name,
                student_record.father_name,
                student_record.college_no,
                student_record.gender_id,
                sections.name as sectionsName,
                student_record.admission_date,
                student_record.applicant_image,
                student_record.migrated_remarks,
                student_record.mobile_no,
                applicant_edu_detail.year_of_passing,
                applicant_edu_detail.exam_type,
                student_record.programe_id,
        ');
        // $this->db->select(
        //     '   student_record.college_no,
        //         student_record.student_id,
        //         student_record.student_name,
        //         student_record.father_name,
        //         student_record.father_name,
        //         student_record.gender_id,
        //         student_record.mobile_no,
        //         student_record.mobile_no2,
        //         student_record.admission_date,
        //         student_record.migrated_remarks,
        //         student_record.applicant_image,
        //         student_record.programe_id,
        //         student_record.sub_pro_id,
              
        //         sections.name as sectionsName,
        //         sections.sec_id,
        //         occupation.title as occupationTitle,
        //         prospectus_batch.batch_name,
        //         degree.title as degreeName,
        //         programes_info.programe_name as programName,
              
        //         applicant_edu_detail.year_of_passing,
        //         applicant_edu_detail.exam_type,
        //         applicant_edu_detail.rollno,
        //         applicant_edu_detail.obtained_marks,
        //         applicant_edu_detail.inst_id,
        //         applicant_edu_detail.total_marks,
                 
        //         ');
            //  $this->db->from('student_group_allotment');
            //   $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id','left outer');
            //   $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            //   $this->db->join('occupation','occupation.occ_id=student_record.occ_id','left outer');
            //   $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            //   $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
            //   $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
            //   $this->db->join('degree','applicant_edu_detail.degree_id=degree.degree_id','left outer');
            //   $this->db->join('grade','applicant_edu_detail.grade_id=grade.grade_id','left outer');
             
            // $this->db->get('')
            $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id');
            $this->db->join('student_group_allotment','student_record.student_id=student_group_allotment.student_id','left outer');
            $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
            $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id');
         if($where):
               $this->db->where($where);
         endif;
         return $this->db->get('student_record')->row();
        
    } 
   

    }
