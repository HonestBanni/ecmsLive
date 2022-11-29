<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class TourController extends AdminController {
    
     public function __construct() 
        {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('TourModel');
             $this->load->library("pagination");
       }
    
    public function add_tour()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('submit_item')):  
           $tour_title   = $this->input->post('tour_title');   
           $location   = $this->input->post('location');   
           $emp_id   = $this->input->post('emp_id');   
           $start_date  = $this->input->post('start_date');   
           $back_date  = $this->input->post('back_date'); 
           $form_Code  = $this->input->post('form_Code');
            $date_1 = date('Y-m-d', strtotime($start_date));
            $date_2 = date('Y-m-d', strtotime($back_date));
            $date1 = new DateTime($date_1);
            $date2 = new DateTime($date_2);
            $interval = $date1->diff($date2);
            $days = $interval->d + 1;
        
           $data = array(
                'tour_title' => $tour_title,
                'location' => $location,
                'emp_id' => $emp_id,
                'start_date' => $date_1,
                'days'=> $days,
                'back_date' => $date_2,
                'user_id' =>$user_id,
            );
            $id = $this->CRUDModel->insert('tours',$data);
            $where = array(
            'user_id'=>$user_id,
            'form_Code'=>$form_Code,
            'date' => date('Y-m-d')    
        ); 
       $res =  $this->CRUDModel->get_where_result('tour_details_demo', $where);
       foreach($res as $isRow):
        $data = array(   
            'student_id'       =>$isRow->student_id,
            'tour_id'      =>$id,
            'college_no'      =>$isRow->college_no,
            'sub_pro_id'      =>$isRow->sub_pro_id,
            'datefrom'      =>$date_1,
            'dateto'      =>$date_2,
            'days'      =>$days,
            'form_Code'     =>$isRow->form_Code,
            'date'          =>$isRow->date,
            'user_id'       =>$isRow->user_id,
          );
        $this->CRUDModel->insert('tour_details',$data);
        
           $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('tour_details_demo',$whereDelete);
        endforeach; 
            redirect('TourController/tours');
            endif;
        $this->data['page_title']   = 'Add New Tour Record | ECMS';
        $this->data['page']         = 'tour/add_tour';
        $this->load->view('common/common',$this->data);  
    }
    
    public function view_students()
    {
        $tour_id = $this->uri->segment(3);
        $where = array('tour_details.tour_id'=>$tour_id);
        $wheredata = array('tours.tour_id'=>$tour_id);
        $this->data['tour'] = $this->TourModel->get_TourRecord('tours', $wheredata);
        $this->data['result'] = $this->TourModel->students_details('tour_details', $where);
        $this->data['page_title']   = 'View Tour Students | ECMS';
        $this->data['page']         = 'tour/view_students';
        $this->load->view('common/common',$this->data); 
    }
    
    public function delete_students()
    {
        $serial_no = $this->uri->segment(3);
        $tour_id = $this->uri->segment(4);
        $where = array('serial_no'=>$serial_no);
        $this->CRUDModel->deleteid('tour_details',$where);
        redirect('TourController/update_students/'.$tour_id);
    }
    
    public function update_student_date()
    {
        $serial_no = $this->uri->segment(3);
        $tour_id = $this->uri->segment(4);
        if($this->input->post()):
            $serial_no   = $this->input->post('serial_no');
            $datefrom   = $this->input->post('datefrom');
            $dateto   = $this->input->post('dateto');
        
            $date_1 = date('Y-m-d', strtotime($datefrom));
            $date_2 = date('Y-m-d', strtotime($dateto));
            $date1 = new DateTime($date_1);
            $date2 = new DateTime($date_2);
            $interval = $date1->diff($date2);
            $days = $interval->d + 1;
        
            $data       = array(
                'serial_no' => $serial_no,
                'datefrom' => $date_1,
                'dateto' =>$date_2,
                'days' => $days
            );
        $where = array('serial_no'=>$serial_no);
        $this->CRUDModel->update('tour_details',$data,$where);
        redirect('TourController/update_students/'.$tour_id);
        endif;
        if($serial_no):
            $where = array('tour_details.serial_no'=>$serial_no);
            $this->data['result'] = $this->TourModel->get_student_date('tour_details',$where);
            $this->data['page_title']   = 'Update Tour Students Date | ECMS';
            $this->data['page']         = 'tour/update_student_date';
            $this->load->view('common/common',$this->data);
        endif;
    }
    
    public function update_students()
    {
        $tour_id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('add_student')):
            $tour_id   = $this->input->post('tour_id');
            $student_id   = $this->input->post('student_id');
            $college_no  = $this->input->post('college_no');
            $sub_pro_id  = $this->input->post('sub_pro_id');
            $checked = array
            (
                'tour_id' => $tour_id,
                'student_id' => $student_id,
                'college_no' =>$college_no,
                'sub_pro_id' =>$sub_pro_id,
                'date' => date('Y-m-d')
            );
        $qry = $this->CRUDModel->get_where_row('tour_details',$checked);
        if($qry):
        $this->session->set_flashdata('msg', 'Sorry! This Students Already Exist');
        redirect('TourController/update_students/'.$tour_id);       
        else:
            $data       = array(
                'tour_id' => $tour_id,
                'student_id' => $student_id,
                'college_no' =>$college_no,
                'sub_pro_id' =>$sub_pro_id,            
                'date' => date('Y-m-d'),
                'user_id' => $user_id
            );
        $this->CRUDModel->insert('tour_details',$data);
        endif;
        endif;
        $where = array('tour_details.tour_id'=>$tour_id);
        $wheredata = array('tours.tour_id'=>$tour_id);
        $this->data['tour'] = $this->TourModel->get_TourRecord('tours', $wheredata);
        $this->data['result'] = $this->TourModel->students_details('tour_details', $where);
        $this->data['page_title']   = 'Update Tour Students | ECMS';
        $this->data['page']         = 'tour/update_students';
        $this->load->view('common/common',$this->data); 
    }
    
    public function delete_tour()
    {
        $tour_id = $this->uri->segment(3);
        $where = array('tour_id'=>$tour_id);
        $this->CRUDModel->deleteid('tours',$where);
        $this->CRUDModel->deleteid('tour_details',$where);
        redirect('TourController/tours');
    }
    
    public function add_student_record()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $student_id   = $this->input->post('student_id');
            $college_no  = $this->input->post('college_no');
            $sub_pro_id  = $this->input->post('sub_pro_id');
            $form_Code  = $this->input->post('form_Code');
            $checked = array(
                'student_id' => $student_id,
                'college_no' =>$college_no,
                'sub_pro_id' =>$sub_pro_id);
        
        $qry = $this->CRUDModel->get_where_row('tour_details',$checked);
        $msg ='';
        $msg1 ='';
         $qrydemo = $this->CRUDModel->get_where_row('tour_details_demo',$checked);
        if($qry):
         $msg = '<p>Sorry! This Student Second Time Not Allowed for Tour in Year<p/>';
        elseif($qrydemo):
        $msg1 = '<p>Sorry! This Student Already Exist in List..<p/>'; 
        else:
            $data       = array(
                'student_id' => $student_id,
                'college_no' =>$college_no,
                'sub_pro_id' =>$sub_pro_id,
                'form_Code' =>$form_Code,
                'date' => date('Y-m-d'),
                'user_id' => $user_id
            );
    $this->CRUDModel->insert('tour_details_demo',$data);
        endif;  
    $result = $this->TourModel->getstudents_record();
        if($result):
        echo $msg.$msg1;
        echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>College Number</th>
                            <th>Program</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                       
                        foreach($result as $eRow):
                        echo '<tr id="'.$eRow->serial_no.'Delete">
                                <td>'.$eRow->student_name.'</td>
                                <td>'.$eRow->college_no.'</td>                          
                                <td>'.$eRow->name.'</td>                          
                                <td><a href="javascript:void(0)" id="'.$eRow->serial_no.'" class="deleteStudent"><i class="fa fa-trash"></i></a></td>                          
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        
        endif;
    ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deleteStudent').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'TourController/delete_student',
                     data: {'deletId':deletId},
                     success : function(result){
                        var del = deletId+'Delete';
                        jQuery('#'+del).hide(); 
                     }
                 });

             });

            });

            </script>
<?php
}
    
    public function delete_student()
    {
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('tour_details_demo',array('serial_no'=>$deletId));
   }  

    public function tours()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $where = array('tours.user_id'=>$user_id);
        $this->data['tours'] = $this->TourModel->getToursList($where);

        $this->data['page_title']   = 'College Tours List | ECMS';
        $this->data['page']         = 'tour/tours';
        $this->load->view('common/common',$this->data); 
    }
    
    public function admin_tours()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $where = array('tours.user_id'=>$user_id);
        $this->data['tours'] = $this->TourModel->getadminToursList();

        $this->data['page_title']   = 'College Tours List | ECMS';
        $this->data['page']         = 'tour/tours';
        $this->load->view('common/common',$this->data); 
    }
    
    public function auto_emp_record()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->TourModel->getEmployees('hr_emp_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->emp_name.'('.$row_set->title.')',
                    'label'=>$row_set->emp_name.'('.$row_set->title.')',
                    'id'=>$row_set->emp_id,
                    'current_designation'=>$row_set->current_designation
                );  
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->TourModel->getEmployees('hr_emp_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->emp_name.'('.$row_set->title.')',
                    'label'=>$row_set->emp_name.'('.$row_set->title.')',
                    'id'=>$row_set->emp_id,
                    'current_designation'=>$row_set->current_designation
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_students_record()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->TourModel->getStudents('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no,
                    'sub_pro_id'=>$row_set->sub_pro_id,
                );  
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = $term;
            
            $result_set             = $this->TourModel->getStudents('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no,
                    'sub_pro_id'=>$row_set->sub_pro_id,
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function add_student_grade()
    {
        if($this->input->post()):
            $student_id   = $this->input->post('student_id');
            $grade_id  = $this->input->post('grade_id');
            $ol_subject_id  = $this->input->post('ol_subject_id');
            $checked = array
                (
                'student_id' => $student_id,
                'ol_subject_id' =>$ol_subject_id,
                'grade_id' =>$grade_id
                );
        
        $qry = $this->CRUDModel->get_where_row('student_grades',$checked);
        $ms ='';
        if($qry):
         $ms = '<p>Sorry! This Record Already Exist in List..<p/>';
        else:
            $data       = array(
                'student_id' => $student_id,
                'ol_subject_id' =>$ol_subject_id,
                'grade_id' =>$grade_id
            );
    $this->CRUDModel->insert('student_grades',$data);
        endif; 
        $where1 = array('student_grades.student_id'=>$student_id);
       $result = $this->TourModel->getstudents_grade($where1);
        if($result):
        echo $ms;
        echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                       
                        foreach($result as $eRow):
                        echo '<tr id="'.$eRow->id.'Delete">
                                <td>'.$eRow->student_name.'</td>
                                <td>'.$eRow->ol_subject_name.'</td>                          
                                <td>'.$eRow->grade_name.'</td>                          
                                <td><a href="javascript:void(0)" id="'.$eRow->id.'" class="deleteStudent_grade">Delete</a></td>                          
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        
        endif;
    ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deleteStudent_grade').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'TourController/delete_student_grade',
                     data: {'deletId':deletId},
                     success : function(result){
                        var del = deletId+'Delete';
                        jQuery('#'+del).hide(); 
                     }
                 });

             });

            });

            </script>
<?php
}
    
    public function delete_student_grade()
    {
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('student_grades',array('id'=>$deletId));
   }     
    
    
}   