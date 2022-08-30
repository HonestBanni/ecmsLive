<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminStudentController.php');

class StudentController extends AdminStudentController {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');       
		$this->load->helper('url'); 
        $this->load->model('CRUDModel');       
        $this->load->model('StudentModel');    
        $this->load->model('ReportsModel');       
        $this->load->model('FeeModel');       
        $this->load->model('HostelModel');       
  
	}

	public function index()
	{
		$this->student_home();
	}
	
//	public function student_home()
//	{	
//        $this->data['class']  = 'dashboard';
//        $this->data['page_title']  = 'Student Home | ECMS';
//        $this->data['page']        =  'students/student_home';
//        $this->load->view('common/student_common_new',$this->data);
//	}
    
    public function timetable()
    {      
        $sec_id   = $this->uri->segment(4);
        $session     = $this->session->all_userdata();
        $student_id  = $session['studentData']['student_id'];
        $where = array('class_alloted.sec_id'=>$sec_id);
        $this->data['result'] = $this->StudentModel->getClassData('class_alloted',$where);
        $this->data['resultm'] = $this->StudentModel->getClassDaym('class_alloted',$where);
        $this->data['resulttu'] = $this->StudentModel->getClassDaytu('class_alloted',$where);
        $this->data['resultw'] = $this->StudentModel->getClassDayw('class_alloted',$where);
        $this->data['resultth'] = $this->StudentModel->getClassDayth('class_alloted',$where);
        $this->data['resultf'] = $this->StudentModel->getClassDayf('class_alloted',$where);
        $this->data['page_title']   = ' Student Time Table | ECMS';
        $this->data['page']         = 'students/timetable';
        $this->load->view('common/student_common',$this->data);
    }
    
    public function get_Studentsbook_issued(){
           $issuance_id = $this->input->post('issuance_id');
            $where = array('lib_book_issuance_details.issuance_id'=>$issuance_id);
            $result = $this->StudentModel->issuance_Books_details('lib_book_issuance',$where);
            if($result):
        echo '<table id="table">
                    <thead>
                          <tr>
                            <th width="120">Issued Date</th>
                            <th width="120">Due Date</th>
                            <th>Days Over</th>
                            <th>Fine/Day</th>
                            <th>Total Fine</th>
                          </tr>
                    </thead>
                <tbody>';
            $sn = '';
             foreach($result as $urRow):
                $status_id = $urRow->availability_status_id;    
                $issued_date = $urRow->issued_date; 
                $due_date = $urRow->due_date; 
                $issuedDate = date("d-m-Y", strtotime($issued_date));
                $dueDate = date("d-m-Y", strtotime($due_date));
                
                $date1 = new DateTime($due_date);
                $date2 = new DateTime(date('Y-m-d'));    
                    
             $sn++;    
             echo '<tr>
                    <td>'.$issuedDate.'</td>
                    <td>'.$dueDate.'</td>';
                    echo '<td>'; 
                        if($date2 > $date1):
                        $interval = $date2->diff($date1);
                        echo $interval->d;
                        endif;
                    echo '</td>';
                    echo '<td>5</td>';
                    echo '<td>';if($date2 > $date1):
                    $interval = $date2->diff($date1);
                    $days_fine = $interval->d * 5;
                    echo "<strong style='color:red'>".$interval->d." * 5 = ("."Rs.".$days_fine. ")</strong>";
                else: echo '';
                endif; echo '</td>';
                    echo '</tr>';    
            endforeach;
                echo '</tbody>
              </table>';
            else:
                 echo '<strong style="color:red;font-size:20px;">Sorry, Record not Found..!</strong>';
            endif;   
        }
    
    public function practical_attendance_white_card(){
            
            $college_no = $this->uri->segment(2);
            $group_id = $this->uri->segment(3);
            
            $this->data['result']           = $this->StudentModel->get_whiteCard_practical(array('student_prac_group_allottment.college_no'=>$college_no,'student_prac_group_allottment.group_id'=>$group_id)); 
             
            $this->data['program']          = 'Practical White card';
            $this->data['page_title']       = 'Student Practical white card | ECMS';
            $this->data['page']             =  'students/whiteCardPractical';
            $this->load->view('common/student_common_new',$this->data);
        }
    
    public function student_home()
	{	
        $this->data['page_title']  = 'Student Home | ECMS';
        $this->data['page']        =  'students/student_home';
        $this->load->view('common/student_common_2',$this->data);
	}
    
    public function proctor_home()
	{	
        $this->data['page_title']  = 'Proctor Home | ECMS';
        $this->data['page']        =  'students/proctor_home';
        $this->load->view('common/proctor_common_2',$this->data);
	}
    
    public function proctor_profile()
	{	
        $this->data['page_title']  = 'View Profile | ECMS';
        $this->data['page']        =  'students/proctor_profile';
        $this->load->view('common/proctor_common_2',$this->data);
	}
    
    public function view_profile()
	{	
        $this->data['page_title']  = 'View Profile | ECMS';
        $this->data['page']        =  'students/view_profile';
        $this->load->view('common/student_common',$this->data);
	}
    
    public function monthly_test_marks()
	{	
        $session = $this->session->all_userdata();
        $student_id =$session['studentData']['student_id'];
        
        $where = array('student_record.student_id'=>$student_id);
        $this->data['result'] = $this->StudentModel->get_monthly_test_marks('monthly_test_details',$where);
        $this->data['page_title']  = 'View Test Marks | ECMS';
        $this->data['page']        =  'students/monthly_test_marks';
        $this->load->view('common/student_common',$this->data);
	}
    
    public function course_details()
	{	
        $session = $this->session->all_userdata();
        $student_id =$session['studentData']['student_id'];
        
        $where = array('student_subject_alloted.student_id'=>$student_id);
        $this->data['result'] = $this->StudentModel->get_course_details('student_subject_alloted',$where);
        $this->data['page_title']  = 'Course Details | ECMS';
        $this->data['page']        =  'students/course_details';
        $this->load->view('common/student_common',$this->data);
	}
    
    public function course_detail()
	{	
        $session = $this->session->all_userdata();
        $student_id =$session['studentData']['student_id'];
        
        $where = array('student_subject_alloted.student_id'=>$student_id);
        $this->data['result'] = $this->StudentModel->get_course_details('student_subject_alloted',$where);
        $this->data['page_title']  = 'Course Details | ECMS';
        $this->data['page']        =  'students/course_detail';
        $this->load->view('common/student_common',$this->data);
	}
    
    public function update_ppassword()
	{	
        $session = $this->session->all_userdata();
        $student_id =$session['studentData']['student_id'];
        
        $where = array('student_id'=>$student_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        
        if($this->input->post()):
        $data_post = array
            (
                'student_password'=>$this->input->post('password')
            );
            $this->CRUDModel->update('student_record',$data_post,$where);
            $this->session->unset_userdata('userData');
                redirect('proctor');
        endif;
        $this->data['page_title']  = 'Proctor Change Password | ECMS';
        $this->data['page']        =  'students/update_puser';
        $this->load->view('common/proctor_common_2',$this->data);	
	}
    
    public function assignment_And_notes()
	{	
        $session    = $this->session->all_userdata();
        $student_id = $session['studentData']['student_id'];
        
        $where = array('student_subject_alloted.student_id'=>$student_id);
        $this->data['result'] = $this->StudentModel->get_course_details('student_subject_alloted',$where);
        
        $this->data['page_title']  = 'Assignments and Notes | ECMS';
        $this->data['page']        =  'students/assignment_And_notes';
        $this->load->view('common/student_common',$this->data);
	}
    
    public function books_issued_details()
	{	
        $session = $this->session->all_userdata();
        $student_id =$session['studentData']['student_id'];
        
        $where = array('lib_book_issuance.student_id'=>$student_id);
        $this->data['result'] = $this->StudentModel->get_books_details('lib_book_issuance',$where);
        $this->data['page_title']  = 'Issued Books Details | ECMS';
        $this->data['page']        =  'students/books_issued_details';
        $this->load->view('common/student_common',$this->data);
	}
    
    public function pending_books_details()
	{	
        $session = $this->session->all_userdata();
        $student_id =$session['studentData']['student_id'];
        
        $where = array(
            'lib_book_issuance.student_id'=>$student_id,
            'lib_book_issuance.due_date <'=>date('Y-m-d'),
        );
        $this->data['result'] = $this->StudentModel->pending_books_details('lib_book_issuance',$where);
        $this->data['page_title']  = 'Pending Books Details | ECMS';
        $this->data['page']        =  'students/pending_books_details';
        $this->load->view('common/student_common',$this->data);
	}
    
    public function fine(){	
        $session = $this->session->all_userdata();
        $student_id =$session['studentData']['student_id'];
        
        $where = array(
            'proctorial_fine.student_id'=>$student_id,
        );
        $this->data['result'] = $this->StudentModel->get_fine('proctorial_fine',$where);
        $this->data['page_title']  = 'Fine Details | ECMS';
        $this->data['page']        =  'students/fine';
        $this->load->view('common/student_common',$this->data);
	}
    
    public function update_password()
	{	
        $session = $this->session->all_userdata();
        $student_id =$session['studentData']['student_id'];
        
        $where = array('student_id'=>$student_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        
        if($this->input->post()):
        $data_post = array
            (
                'student_password'=>$this->input->post('password')
            );
            $this->CRUDModel->update('student_record',$data_post,$where);
            $this->session->unset_userdata('userData');
                redirect('p-portal');
        endif;
        $this->data['page_title']  = 'Student Change Password | ECMS';
        $this->data['page']        =  'students/update_user';
        $this->load->view('common/student_common',$this->data);
		
	}
    
    public function student_attendance_white_card_show()
    {
        $this->data['class']  = 'white_card';
        $studentId = $this->uri->segment(2);
        $sectionId = $this->uri->segment(3);
            
            $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$sectionId));
            $this->data['class_id'] =  $CheckStd->class_id;
            $this->data['flag']     =  $CheckStd->flag;
            if($CheckStd->flag==1):
               $this->data['result']           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$studentId,'student_group_allotment.section_id'=>$sectionId)); 
                else:
                $this->data['result']           = $this->ReportsModel->get_whiteCard_section(
                        array(
                            'student_subject_alloted.student_id'=>$studentId,
                            'student_subject_alloted.section_id'=>$sectionId
                        )); 
            endif;
            
            $this->data['program']          = 'Show White card';
            $this->data['page_title']       = 'Student white card | ECMS';
            $this->data['page']             =  'reports/whiteCardPrintStd';
            $this->load->view('common/student_common_new',$this->data); 
    }
    
    public function admin_student_lock_unlock()
    {
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
        $this->data['newsubprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender Status ', 'gender_id', 'title');
            $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name');
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
            
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $college_no                     =  $this->input->post('college_no');
            $form_no                        =  $this->input->post('form_no');
            $student_name                   =  $this->input->post('student_name');
            $father_name                    =  $this->input->post('father_name');
            $gender                         =  $this->input->post('gender');
            $program                        =  $this->input->post('program');
            $sub_program                    =  $this->input->post('sub_program');
            $reserved_seat                  =  $this->input->post('reserved_seat');
            $section                        =  $this->input->post('sections_name');
            $picture                        =  $this->input->post('picture');
            $limit                          =  $this->input->post('limit');
            $batch                          =  $this->input->post('batch');
            //like Array
            $like = '';
            $where = '';
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['genderId']         = '';
            $this->data['programId']        = '';
            $this->data['sectionId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['pictureId']          = '';
            $this->data['batchId']          = '';
            $where['student_status.s_status_id'] = 5;
           // $where['student_record.promotion_flag'] = 1;
            if(!empty($student_name)):
                $like['student_name']       = $student_name;
                $this->data['student_name'] = $student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name']        = $father_name;
                $this->data['father_name']  = $father_name;
            endif;
            if(!empty($college_no)):
                $where['college_no']        = $college_no;
                $this->data['college_no']   = $college_no;
            endif;
            if(!empty($gender)):
                $where['student_record.gender_id'] = $gender;
                $this->data['genderId']     = $gender;
            endif;
            
            if(!empty($form_no)):
                 $where['form_no']          = $form_no;
                $this->data['form_no']      = $form_no;
            endif;
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['subprogramId'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
            endif;
            if(!empty($section)):
                 $where['sections.sec_id']  = $section;
                $this->data['sectionId']    = $section;
            endif;
            if(!empty($reserved_seat)):
                 $where['reserved_seat.rseat_id']   = $reserved_seat;
                $this->data['reserved_seatId']      = $reserved_seat;
            endif;
            if($this->input->post('search')):          
                $field = '
                    student_record.student_id,
                    student_record.college_no,
                    student_record.applicant_image,
                    student_record.student_name,
                    student_status.name as student_statusName,
                    gender.title as genderName,
                    reserved_seat.name as reservedName,
                    student_record.admission_comment,
                    student_record.hostel_required,
                    student_record.comment,
                    student_record.father_name,
                    student_record.form_no,
                    programes_info.programe_name,
                    sub_programes.sub_pro_id as sub_pro_id,
                    sub_programes.name as subprogram,
                    board_university.title as bu_title,
                    prospectus_batch.batch_name,
                    applicant_edu_detail.total_marks,
                    applicant_edu_detail.obtained_marks,
                    applicant_edu_detail.percentage,
                    sections.sec_id,
                    sections.name as sectionName,
                    domicile.name,
                    admission_date,
                    college_no
                    ';

        $this->data['result'] = $this->StudentModel->grand_report($field,'student_record', $where,$like);
            endif;
        $session = $this->session->all_userdata();
        $user_id = $session['userData']['user_id'];
            
        if($this->input->post('lock_unlock')):    
            $ides = $this->input->post('checked');
            $login_status = $this->input->post('login_status');
            if(!empty($ides)):
                foreach($ides as $row=>$value):
                $this->CRUDModel->update(
                    'student_record',
                     array('login_status'=>$login_status),
                    array('student_id'=>$value)
                   );
                endforeach;  
            endif;
        endif;
        $this->data['ReportName']   = 'Admin Student Lock Unlock Status';
        $this->data['page']        =  'students/admin_student_lock_unlock';
        $this->data['title']        = 'Admin Student Lock Unlock Status | ECMS';
        $this->load->view('common/common',$this->data);  
    }
    
    public function admin_student_change_password()
    {
            $college_no    =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name  =  $this->input->post('student_name');
            $father_name   =  $this->input->post('father_name');
          
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
        if($this->input->post('search')):
           
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
            if(!empty($form_no)):
                $where['form_no'] = $form_no;
                $this->data['form_no'] =$form_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
    $this->data['result'] = $this->StudentModel->get_studentData('student_record',$where,$like);
           endif;

           $this->data['page_title']   = ' Admin Student Change Password | ECMS';
           $this->data['page']         = 'students/admin_student_change_password';
           $this->load->view('common/common',$this->data);
    }
    
    public function student_update_password()
    {          
        $student_id = $this->uri->segment(3);
        if($this->input->post()):
        $student_id = $this->input->post('student_id');
        $password = $this->input->post('password');
        $where = array('student_id'=>$student_id);
        $data = array
            (
                'student_password'=>$password
            );
            $this->CRUDModel->update('student_record',$data,$where);
            redirect('StudentController/admin_student_change_password');
        endif;
        if($student_id):
        $where = array('student_id'=>$student_id);
        $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        endif;
        $this->data['page_title']  = ' Admin Student Change Password | ECMS';
        $this->data['page']        =  'students/student_update_password';
        $this->load->view('common/common',$this->data);
    }
    
   public function student_fee(){
        
            $session        = $this->session->all_userdata();
            $student_id     =$session['studentData']['student_id'];
            
           
           $this->data['result'] = $this->StudentModel->student_fee_details($student_id);
            
 
        
        $this->data['page']         = 'students/fee_details';
        $this->data['page_header']  = 'Fee Challan Search';
        $this->data['page_title']   = 'Fee Challan Search | ECMS';
        $this->load->view('common/student_common',$this->data);
    }   
    
      public function fee_student_challan_print(){
        
//            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.s_status_id' => 5,'student_record.student_id'=>$this->uri->segment(3)));
            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));
            $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$this->uri->segment(2)));
             $where = array(
                       'fc_student_id '=> $this->data['feeComments'] ->fc_student_id,
                       'fc_paid_form <='=> $this->data['feeComments'] ->fc_paid_form,
                       
                   );
        
             
             
        $this->data['result']       = $this->FeeModel->feeDetails_head_print($where);
        $this->data['page']         = 'students/fee_student_challan_print';
        $this->data['page_header']  = 'Fee Challan Print';
        $this->data['page_title']   = 'Fee Challan Print | ECMS';
        $this->load->view('common/student_common_new',$this->data);
//        $this->load->view('common/common',$this->data);
    }
     public function student_hostel_details(){
       
         $session        = $this->session->all_userdata();
        $student_id     =$session['studentData']['student_id'];
           
           
                $where['student_record.student_id'] = $student_id;
                $where['hostel_student_bill.head_type'] = 1;
          
           
                $this->data['result']       = $this->StudentModel->hostel_challan_search_details($where);
                $this->data['report_type']  = 'hostel_std_search';
                $this->data['report_name']  = 'Hostel Fee Details';
                
        $this->data['page']         = 'students/hostel_fee_details';
        $this->data['page_header']  = 'Hostel Fee Details';
        $this->data['page_title']   = 'Hostel Fee | ECMS';
        $this->load->view('common/student_common',$this->data);
    }   
     public function student_mess_details(){
       
         $session        = $this->session->all_userdata();
        $student_id     =$session['studentData']['student_id'];
           
           
                $where['student_record.student_id'] = $student_id;
                $where['hostel_student_bill.head_type'] = 2;
          
           
                $this->data['result']       = $this->StudentModel->hostel_challan_search_details($where);
                $this->data['report_type']  = 'hostel_std_search';
                $this->data['report_name']  = 'Mess Fee Details';
        $this->data['page']         = 'students/hostel_fee_details';
        $this->data['page_header']  = 'Hostel Fee Details';
        $this->data['page_title']   = 'Hostel Fee | ECMS';
        $this->load->view('common/student_common',$this->data);
    }
     public function hostel_print_challan(){
            
        
             $hostel_id = $this->uri->segment(2);
             $bill_id   = $this->uri->segment(3);
            // $inst_type = $this->uri->segment(4);
             
             
            $this->data['studentInfo']  = $this->HostelModel->hostel_fee_challan(array('hostel_student_record.hostel_id'=>$hostel_id));

            $this->data['challan_info'] = $this->HostelModel->hostel_challan_info_new(array('hostel_student_bill.id'=>$bill_id));
            $this->data['extra_info']   = $this->HostelModel->extra_info(array('hostel_student_bill.id'=>$bill_id));

//            
            $this->data['page_title']   = 'Hostel Fee | ECMS';
            $this->data['page_header']  = 'Hostel Fee';
            $this->data['page']         = 'hostel/print/hostel_challan_print';
            $this->load->view('common/student_common_new',$this->data);
    }
    
}