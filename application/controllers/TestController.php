<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
class TestController extends AdminController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/roufee_new_headtes.php, it's displayed at http://example.com/
	 *
	 * So any fee_extra_headsother public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
      
          
    public function __construct() {
             parent::__construct();
            
             $this->load->model('CRUDModel');
          }
          public function student_education(){
//                          $this->db->join('student_record','student_record.student_id=applicant_edu_detail.student_id');
//              $result =   $this->db->get_where('applicant_edu_detail')->result();
//               $sn = '';
//              foreach($result as $row):
//                  
//                   $result =   $this->db->get_where('student_record',array('student_id'=>$row->student_id))->row();
//                  
//                   if(empty($result)):
////                       echo '<pre>';print_r($row);
//                        $sn++;
//                         $this->CRUDModel->deleteid('applicant_edu_detail',array('serial_no'=>$row->serial_no));
//                   endif;
//              
////                  $this->CRUDModel->deleteid('sms_students',array('sms_students.id'=>$row->id));
//              endforeach;
//              echo $sn;die;
//              echo '<pre>';print_r($result);die;
          }
          public function student_alumni(){
                          $this->db->join('student_attendance_details','student_attendance_details.student_id=student_record.student_id');  
              $result =   $this->db->get_where('student_record',array('s_status_id'=>'9'))->result();
              echo '<pre>';print_r($result);die;
                  foreach($result as $row):
                  $this->CRUDModel->deleteid('student_attendance_details',array('serial_no'=>$row->serial_no));
              endforeach;
//              foreach($result)
          }
          public function sms_delete(){
//                          $this->db->select('sms_students.id,student_record.student_id');
//                          $this->db->join('sms_students','sms_students.student_id=student_record.student_id');  
//              $result =   $this->db->get_where('student_record',array('s_status_id'=>'9'))->result();
////               echo '<pre>';print_r($result);die;
//              foreach($result as $row):
//                  $this->CRUDModel->deleteid('sms_students',array('sms_students.id'=>$row->id));
//              endforeach;
//              echo '<pre>';print_r($result);die;
          }
    public function lat_date(){
//        $late_marks = $this->db->get_where('late_date',array('status'=>1))->result();
//        
//        foreach($late_marks as $row):
//            $search_std = $this->db->get_where('student_record',array(
//                'form_no'           =>$row->form_no,
//                'student_name'      =>$row->student_name,
//                'father_name'       =>$row->father_name,
//            ))->row();
//            
//            echo '<pre>';print_r($search_std);
//            echo '<pre>';print_r($row);
//            $set = array(
//               'lat_date'   =>date('Y-m-d',strtotime($row->late_date ))
//            );
//            $where = array(
//              'student_id'  =>$search_std->student_id
//            );
//            $this->CRUDModel->update('applicant_edu_detail',$set,$where);
//             $this->CRUDModel->update('late_date',array('status'=>2),array(
//                 'form_no'           =>$row->form_no,
//                'student_name'      =>$row->student_name,
//                'father_name'       =>$row->father_name,
//             ));
////            echo '<pre>';print_r($row);die;
//        endforeach;
//        die;
    }      
//    public function update_picture(){
//                $this->db->select('student_name,student_id,college_no,applicant_image');
//    $result =   $this->db->get_where('student_record',array('s_status_id'=>'5','batch_id'=>'92'))->result();
//    
//    foreach($result as $row):
//        
//        
//        if(!empty($row->applicant_image)):
//            $filename = 'assets/images/students/'.$row->applicant_image;
////            echo $filename;die;
//            if (file_exists($filename)) {
//                  
//                    " The file exists <br/>";
//                     '<pre>';print_r($row);
//            } else {
//                echo base_url().$filename;
//                echo    " The file does not exist <br/>";
//                echo '<pre>';print_r($row);
//                $this->CRUDModel->update('student_record',array('applicant_image'=>''),array('student_id'=>$row->student_id));
//                 
//            }
//        endif;
//       
//    endforeach;
//    
//    die;
//    echo '<pre>';print_r($result);die;
//        
//    }
        



//          public  function index(){
////                            $this->db->join('student_record','hostel_student_record.student_id=student_record.student_id');
//              $result =     $this->db->get_where('hostel_student_record',
////              $result =     $this->db->get_where('student_records',
//                    array(
//                        'hostel_student_record.hostel_status_id'=>5,
////                        'student_record.s_status_id'=>1,
//                        ))->result();
//              $sn= '';
//                foreach ($result as $row):
////                   $this->CRUDModel->update('hostel_student_record',array('hostel_status_id'=>6),array('hostel_id'=>$row->hostel_id));
//                    
//                //$this->CRUDModel->update('hostel_student_record',array('hostel_status_id'=>6),array('hostel_id'=>$row->hostel_id));
//                 //   $record =  $this->db->get_where('student_record',array('student_record.s_status_id'=>9,'student_id'=>$row->student_id))->row();
//              //  if($record):
////                    echo $record->college_no.'<br/>';
////                    echo $sn++;
//              //  $this->CRUDModel->update('fee_challan',array('hostel_status_id'=>6),array('hostel_id'=>$row->hostel_id));
////                $this->CRUDModel->deleteid('hostel_student_record',array('hostel_id'=>$row->hostel_id));
//               // endif;
//                
//                endforeach;
//                die;
//              echo '<pre>';print_r($result);die;
//          }
    public function student_due_date(){
              
//              
        $where = array(
                        'student_record.s_status_id !='=>1,    // R.A
                        'student_record.programe_id'=>1,    //Inter 
//                        'student_record.batch_id'=>92,      // batch 2021-23 = 92
                        );
        
        
//        $where = array(
//                        'student_record.s_status_id'=>1,    // R.A
//                        'student_record.programe_id'=>6,    //BBA
//                        'student_record.batch_id'=>86,      // BBA 2021-25 = 86
//                          
//                        );
//        $where = array(
//                        'student_record.s_status_id'=>1,    // R.A
//                        'student_record.programe_id'=>8,    //BS English
//                        'student_record.batch_id'=>87,      // BS English( 2021-25) = 87
//                          
//                        );

//        $where = array(
//                        'student_record.s_status_id'=>1,    // R.A
//                        'student_record.programe_id'=>17,    //BS P.S
//                        'student_record.batch_id'=>89,      // BS Pol-Sc (2021-25) = 89
//                          
//                        );
//        $where = array(
//                        'student_record.s_status_id'=>1,    // R.A
//                        'student_record.programe_id'=>2,    //BS P.S
//                        'student_record.batch_id'=>88,      // BS Pol-Sc (2021-25) = 89
//                          
//                        );
        
        
        
            $result =     $this->db->get_where('student_record',$where)->result();
              $count = '';
              foreach($result as $std):
                  $count++;
                    $wherebl = array(
                        'fee_challan.fc_ch_status_id'   => 1,
                        'fc_student_id'                 => $std->student_id,
                        'balance  >'                    => 0,
//                        'fc_issue_date'                 => '2021-10-03'
                      );
                                 $this->db->select('fc_challan_id,fc_student_id,fc_dueDate');
                                 $this->db->order_by('fc_challan_id','desc');
                                 $this->db->limit(0,1);
                                 $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                  $lastChallan = $this->db->get_where('fee_challan',$wherebl)->row();
                   
                  if(!empty($lastChallan)):
//                       echo '<pre>';print_r($lastChallan); 
                  $dueDate = array(
                      'fc_dueDate'=>'2022-06-03'
                  );
                  $where = array(
                      'fc_challan_id'=>$lastChallan->fc_challan_id
                  );
                  
                  $this->CRUDModel->update('fee_challan',$dueDate,$where);
//                   die;
                  endif;
//                    echo '<pre>';print_r($lastChallan); 
                 
              endforeach;
              die;
//               
          }
    public function student_hostel_due_date(){
              
//              
        $where = array(
                          'student_record.s_status_id'=>5,    // R.A
                          'student_record.programe_id'=>1,    //Inter 
//                        'student_record.batch_id'=>92,      // batch 2021-23 = 92
                        );
        
        
//        $where = array(
//                        'student_record.s_status_id'=>1,    // R.A
//                        'student_record.programe_id'=>6,    //BBA
//                        'student_record.batch_id'=>86,      // BBA 2021-25 = 86
//                          
//                        );
//        $where = array(
//                        'student_record.s_status_id'=>1,    // R.A
//                        'student_record.programe_id'=>8,    //BS English
//                        'student_record.batch_id'=>87,      // BS English( 2021-25) = 87
//                          
//                        );

//        $where = array(
//                        'student_record.s_status_id'=>1,    // R.A
//                        'student_record.programe_id'=>17,    //BS P.S
//                        'student_record.batch_id'=>89,      // BS Pol-Sc (2021-25) = 89
//                          
//                        );
//        $where = array(
//                        'student_record.s_status_id'=>1,    // R.A
//                        'student_record.programe_id'=>2,    //BS P.S
//                        'student_record.batch_id'=>88,      // BS Pol-Sc (2021-25) = 89
//                          
//                        );
        
//                            $this->db->select('student_record.student_id,hostel_student_record.hostel_id');
//                            $this->db->join('hostel_student_record','hostel_student_record.student_id=student_record.student_id');  
            $result =       $this->db->get_where('student_record',$where)->result();
           
              $count = '';
              foreach($result as $std):
                    $wherebl = array(
//                        'hostel_student_bill.hostel_status_id'  => 1,
                        'hostel_student_record.student_id'    => $std->student_id,
                        'balance>'                            => 0,
                        'valid_date !='                 => '2022-06-03'
                      );
                 
                                 $this->db->select('hostel_student_bill.*');
                                 $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                 $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
                                 $this->db->order_by('hostel_student_bill.id','desc');
                                 $this->db->limit(1);
                  $lastChallan = $this->db->get_where('hostel_student_record',$wherebl)->row();
                
                  if($lastChallan):
                        echo '<pre>';print_r($lastChallan);
                      $dueDate = array(
                      'valid_date'=>'2022-06-03'
                        );
                        $where = array(
                            'id'=>$lastChallan->id
                        );
                  
                  $this->CRUDModel->update('hostel_student_bill',$dueDate,$where); 
                      
                  endif;
//                   
//                   
//                   $count++;
//                    $wherebl = array(
//                        'hostel_student_bill.hostel_status_id'  => 1,
//                        'hostel_student_bill.hostel_std_id'        => $std->hostel_id,
//                        'balance>'                            => 0,
////                        'fc_issue_date'                 => '2021-10-03'
//                      );
//                                 $this->db->select('
//                                            hostel_student_bill.id as hostel_challan,
//                                            valid_date
//                                            ');
//                                 $this->db->order_by('hostel_student_bill.id','desc');
//                                 $this->db->limit(0,1);
//                                 $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id');
//                  $lastChallan = $this->db->get_where('hostel_student_bill',$wherebl)->row();
//                  
//                   
//                  if(!empty($lastChallan)):
//                       echo '<pre>';print_r($lastChallan); 
//                  $dueDate = array(
//                      'valid_date'=>'2022-06-03'
//                  );
//                  $where = array(
//                      'id'=>$lastChallan->hostel_challan
//                  );
//                  
//                  $this->CRUDModel->update('hostel_student_bill',$dueDate,$where);
                 
//                  endif;
//                    echo '<pre>';print_r($lastChallan); 
                 
              endforeach;
              echo 'done';
              die;
//               
          }
//
//
//          public function indexx(){
//              
////            $this->db->select('student_record.student_id,
////                        student_record.college_no,
////                        student_record.student_name,
////                        student_status.name as student_statusName,
////                        student_record.father_name,
////                        sub_programes.name as subprogram,
////                        prospectus_batch.batch_name,
////                        sections.name as sectionName,
////                        gender.title as genderName,
////                        shift.name as shiftName,
////                        student_group_allotment.section_id,
////                    ');    
////                $this->db->from('student_record');
////                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
////                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
////                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
////                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
////                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
////                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
////                 $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
////                 $this->db->join('shift','shift.shift_id=student_record.shift_id','left outer') ;  
//////            if($where):
////                 
////                $this->db->where(array('student_status.s_status_id'=>5));
////                $this->db->where_in('student_group_allotment.section_id', array(434,435,436,437,438,422,417));
//////            endif;
////            $query =  $this->db->get()->result();
////            
//////            echo '<pre>'; print_r($query); die;
////            
////            foreach($query as $row):
////                $this->CRUDModel->update('student_record', array('shift_id'=>2), array('student_id'=>$row->student_id));
////            endforeach;
//            
//          }
//          
//          
          public function excel_challan_generated(){
              
               $this->db->select('
                   student_record.form_no,
                   student_record.student_name,
                   student_record.father_name,
                   student_record.form_no,
                   fee_challan.fc_challan_id,
                   sub_programes.name as subprogram,
                   prospectus_batch.batch_name,
                   programes_info.programe_name,
                   applicant_edu_detail.total_marks,
                   applicant_edu_detail.obtained_marks,
                   applicant_edu_detail.percentage,
                   
                    ');    
                $this->db->from('student_record1');
                $this->db->join('fee_challan', 'fee_challan.fc_student_id=student_record.student_id');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
//            if($where):
                 
//                $this->db->where(array(
//                    'student_record.s_status_id' => 1,
//                    'student_record.programe_id' => 1,
//                    'student_record.sub_pro_id' => 4,
//                    'student_record.batch_id' => 92,
//                ));
                $this->db->order_by('student_record.programe_id', 'asc');
                $this->db->order_by('student_record.sub_pro_id', 'asc');
                $this->db->order_by('applicant_edu_detail.percentage', 'desc');
                $this->db->where_in('student_record.batch_id', array(94,92,91,89,88,87,86));
//            endif;
            $query =  $this->db->get()->result();
            
//            echo '<pre>'; print_r($query); die;
            echo '<table border="1">
            <tr>
                <td>S#</td>
                <td>Form No</td>
                <td>Challan No</td>
                <td>Name</td>
                <td>Father Name</td>
                <td>Batch</td>
                <td>Program</td>
                <td>Sub Program</td>
                <td>T.Marks</td>
                <td>O.Marks</td>
                <td>%age</td>
            </tr>';
            $serial = '';
            foreach($query as $row):
                $serial++;
                echo '<tr>
                <td>'.$serial.'</td>
                <td>'.$row->form_no.'</td>
                <td>'.$row->fc_challan_id.'</td>
                <td>'.$row->student_name.'</td>
                <td>'.$row->father_name.'</td>
                <td>'.$row->batch_name.'</td>
                <td>'.$row->programe_name.'</td>
                <td>'.$row->subprogram.'</td>
                <td>'.$row->total_marks.'</td>
                <td>'.$row->obtained_marks.'</td>
                <td>'.$row->percentage.'</td>
                </tr>';
            endforeach; 
            echo '</table>';
          }
          
    public function library_update(){
//        $get = $this->CRUDModel->getResults('lib_staff_book_issuance');
//        foreach($get as $row):
//            $arr = array(
//                'due_date'    => date('Y-m-d', strtotime($row->issued_date. '+ 15 days')),
//            );
//            $this->CRUDModel->update('lib_staff_book_issuance', $arr, array('iss_id'=>$row->iss_id));
//        endforeach;
    }
    
    public function class_alloted_setting(){
        
        $old = $this->CRUDModel->getResults('class_alloted_old');
        foreach($old as $row):
            $new = $this->CRUDModel->get_where_row('class_alloted', array('class_id' => $row->class_id));
            if(empty($new)):
                $ch_ex = $this->CRUDModel->get_where_row('exams_bs', array('exb_class_id' => $row->class_id));
                if(!empty($ch_ex)):
                    $upd = array(
                        'exb_class_id'=>0, 
                        'exb_employ_id' => $row->emp_id, 
                        'exb_section_id' => $row->sec_id, 
                        'exb_subject_id' => $row->subject_id
                    );
                    $this->CRUDModel->update('exams_bs', $upd, array('exb_class_id' => $row->class_id));
                endif;
            endif;
        endforeach;
//        echo '<pre>'; print_r($array); die;
    }
    
    public function update_shift_according_to_sections(){
        
        $where = array(
            'student_record.sub_pro_id'   => 5,
//            'gender_id'     => 1,
            's_status_id'   => 5,
            'student_record.batch_id' => 92,
//            'student_record.shift_id' => 2
        );
        $this->db->select('student_record.student_id, student_name, college_no, programe_id, student_record.batch_id, s_status_id, gender_id, section_id, student_record.shift_id, name');
                  
                  $this->db->where($where);
//                  $this->db->where_in('section_id', array(539,541,545,546,547,549,550,551,555,556,557,558,559,560));
                  $this->db->join('student_group_allotment', 'student_group_allotment.student_id=student_record.student_id');
                  $this->db->join('sections', 'sections.sec_id=student_group_allotment.section_id');
        $result = $this->db->get('student_record')->result();
        
//        foreach($result as $row):
//            $this->CRUDModel->update('student_record', array('shift_id'=>1), array('student_id'=> $row->student_id));
//        endforeach;
        
        echo '<pre>'; print_r($result); die;
        
    }
    
    public function fisrt_year_total_attendance(){
                  
//                  $this->db->where($where);
                  $this->db->where_in('student_record.sub_pro_id', array(1,2,4,5));
                  $this->db->join('student_record', 'student_record.student_id=student_attendance_details.student_id', 'left outer');
        $result = $this->db->get('student_attendance_details')->result();
        
//        foreach($result as $row):
//            $this->CRUDModel->update('student_record', array('shift_id'=>1), array('student_id'=> $row->student_id));
//        endforeach;
        
        echo '<pre>'; print_r($result); die;
        
    }
    
}
?>