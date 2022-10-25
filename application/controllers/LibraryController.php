<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class LibraryController extends AdminController {
    
     public function __construct() {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('LibraryModel');
             $this->load->library("pagination");
              $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
       }
    
    public function std_sec_allotment()
     { 
        $term = $this->input->get('term');
            if( $term == ''){   
            $result_set = $this->LibraryModel->std_sec_allotment('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
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
            $result_set = $this->LibraryModel->std_sec_allotment('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
                    );
            }
            $matches = array();
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
    
    
    public function auto_students_all()
     { 
        $term = $this->input->get('term');
        
            if( $term == ''){
                
            $result_set             = $this->LibraryModel->getStudentsall('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
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
            
            $result_set             = $this->LibraryModel->getStudentsall('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
                    );
            }
            $matches = array();
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
    
    
    
    public function staff_book_issuance_search()
    {
        if($this->input->post()):
            $emp_id   =  $this->input->post('emp_id'); 
            $deptt_id   =  $this->input->post('department_id'); 
            $contract_type_id   =  $this->input->post('contract_type_id');      
            $issuance_date =  $this->input->post('issuance_date');  
            $where = '';
            $like = '';
            $this->data['emp_id'] = '';  
            $this->data['contract_type_id'] = '';   
            $this->data['issuance_date'] = '';
            $this->data['department_id'] = '';
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($deptt_id)):
                $where['hr_emp_record.department_id'] = $deptt_id;
                $this->data['department_id'] =$deptt_id;
            endif;
            if(!empty($contract_type_id)):
                $where['hr_emp_record.contract_type_id'] = $contract_type_id;
                $this->data['contract_type_id'] =$contract_type_id;
            endif;
            if(!empty($issuance_date)):
                $where['lib_staff_book_issuance.issued_date'] = $issuance_date;
                $this->data['issuance_date'] =$issuance_date;
            endif;
        $this->data['books'] = $this->LibraryModel->getStaff_Books('lib_staff_book_issuance',$where);
        endif;
        $this->data['page_title']   = 'Staff Book Issuance List | ECMS';
        $this->data['page']         = 'library/staff_book_issuance_search';
        $this->load->view('common/common',$this->data); 
    }
    
    
    public function books_record_limit(){
           if($this->input->post()):
                $this->data['old_accession']       = $this->input->post('old_accession');
                $this->data['old_accessionto']       = $this->input->post('old_accessionto');
                $this->data['accession_from']       = $this->input->post('accession_from');
                $this->data['accession_to']         = $this->input->post('accession_to');
                
               $this->data['book_accession'] = $this->LibraryModel->search_accession_limit('lib_book_code',$this->data['accession_from'], $this->data['accession_to'],$this->data['old_accession'], $this->data['old_accessionto']);
            endif;
        
            $this->data['page']         = "library/books_record_limit";
            $this->data['title']        = 'Library Books Record Limit | ECMS';
            $this->load->view('common/common',$this->data);
    }
    
    public function issued_books_record()
    {
           $where = '';
            $like = '';
            $this->data['book_id'] = '';   
            $this->data['author_name'] = '';
            $this->data['subject_name'] = '';
            $this->data['accession_from'] = '';
            $this->data['old_accession'] = '';
        if($this->input->post()):
            $book_id   =  $this->input->post('book_id');      
            $author_name =  $this->input->post('author_name');   
            $subject_name =  $this->input->post('subject_name');   
            $accession_from =  $this->input->post('accession_from');   
            $old_accession =  $this->input->post('old_accession'); 
        
            if(!empty($book_id)):
                $where['lib_books_record.book_id'] = $book_id;
                $this->data['book_id'] = $book_id;
            endif;
            if(!empty($author_name)):
                $like['lib_books_record.author_name'] = $author_name;
                $this->data['author_name'] = $author_name;
            endif;
            if(!empty($author_name)):
                $like['lib_books_record.author_name'] = $author_name;
                $this->data['author_name'] = $author_name;
            endif;
           if(!empty($subject_name)):
                $like['lib_books_record.subject_name'] = $subject_name;
                $this->data['subject_name'] = $subject_name;
            endif;
            if(!empty($accession_from)):
                $where['lib_book_code.accession_number'] = $accession_from;
                $this->data['accession_from'] =$accession_from;
            endif;
            if(!empty($old_accession)):
                $where['lib_book_code.old_accession_number'] = $old_accession;
                $this->data['old_accession'] =$old_accession;
            endif;
        $this->data['books'] = $this->LibraryModel->searchIssuedbooks('lib_book_code',$where,$like);
        endif;
        $this->data['page_title']   = 'Issued Books Record | ECMS';
        $this->data['page']         = 'library/issued_books_record';
        $this->load->view('common/common',$this->data);
    }    
   
    
    public function count_books_record()
    {     
            $like = '';
            $this->data['subject_name'] = '';
            $this->data['from_date'] = ""; 
            $this->data['to_date'] = "";
        if($this->input->post('search')): 
            
            $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
            $to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
            $subject_name =  $this->input->post('subject_name');  
            
            if(!empty($from_date)):
                $this->data['from_date'] =$from_date;
            endif;
            if(!empty($to_date)):
                $this->data['to_date'] =$to_date;
            endif;
        
           if(!empty($subject_name)):
                $like['lib_books_record.subject_name'] = $subject_name;
                $this->data['subject_name'] = $subject_name;
            endif;
            
            $this->data['result'] = $this->LibraryModel->countBooksRcd('lib_book_code',$like,$this->data['from_date'],$this->data['to_date']);
            endif;
        $this->data['page_title']   = 'Count Books Record | ECMS';
        $this->data['page']         = 'library/count_books_record';
        $this->load->view('common/common',$this->data);
    }
    
    public function get_Deptbook_issued(){
           $dept_id = $this->input->post('dept_id');
            $where = array('dept_id'=>$dept_id);
            $result = $this->LibraryModel->deptissuance_Books_details('lib_dept_books_issuance',$where);
            if($result):
        echo '<table class="table table-striped table-bordered">
                    <thead>
                          <tr>
                            <th>S#</th>
                            <th>Book Title</th>
                            <th>Acc#</th>
                            <th>Issued Date</th>
                            <th>Issued Dept</th>
                          </tr>
                    </thead>
                <tbody>';
            $sn = '';
             foreach($result as $urRow):  
                $issued_date = $urRow->issued_date; 
                $issuedDate = date("d-m-Y", strtotime($issued_date));
                
             $sn++;    
             echo '<tr>
                    <td>'.$sn.'</td>
                    <td>'.$urRow->book_title.'</td>
                    <td>'.$urRow->accession_no.'</td>
                    <td>'.$issuedDate.'</td>
                    <td><strong style="color:red">'.$urRow->title.'</strong></td>';
                    echo '</tr>';    
            endforeach;
                echo '</tbody>
              </table>';
            else:
                 echo '<strong style="color:red;font-size:20px;">Sorry, Record not Found..!</strong>';
            endif;   
        }
    
     public function insert_dept_books_issuance()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('submit_item')):  
           $emp_id   = $this->input->post('prepared_by');   
           $dept_id   = $this->input->post('department_id');   
           $issued_date   = $this->input->post('issuance_date'); 
           $form_Code  = $this->input->post('form_Code');
            $where = array('department_id'=>$dept_id);
           $q = $this->CRUDModel->get_where_row('department',$where);
           $std_data = $q->title;
           $this->RQ($std_data,'assets/RQ/library_rq/dept_rq/');
           $data1 = array(
                'emp_id' => $emp_id,
                'dept_id' => $dept_id,
                'issued_date' =>$issued_date,
                'rq_image' =>$std_data.'.png',
                'user_id' =>$user_id,
            );
            $id = $this->CRUDModel->insert('lib_dept_books_issuance',$data1);
            $where = array(
            'user_id'=>$user_id,
            'form_Code'=>$form_Code,
            'date' => date('Y-m-d')    
                ); 
       $res =  $this->CRUDModel->get_where_result('lib_dept_books_issuance_details_demo', $where);
       foreach($res as $isRow):
        $data = array(   
            'book_id'     =>$isRow->book_id,
            'dept_iss_id' =>$id,
            'accession_no'=>$isRow->accession_no,
            'availablity_status_id' =>1,
            'form_Code'   =>$isRow->form_Code,
            'date'        =>$isRow->date,
            'user_id'     =>$isRow->user_id,
          );
        $this->CRUDModel->insert('lib_dept_books_issuance_details',$data);
        $where = array('book_id'=>$isRow->book_id, 'accession_number'=>$isRow->accession_no);
        $book_data = array
            (
                'book_availablity_status_id'=>1
            );
            $this->CRUDModel->update('lib_book_code',$book_data, $where);
        
           $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('lib_dept_books_issuance_details_demo',$whereDelete);
        endforeach; 
            redirect('LibraryController/departmental_books_issuance');
            endif;
    }
    
    public function add_dept_books_issuance()
    {
        $this->data['page_title']   = 'Add Department Issuance Book | ECMS';
        $this->data['page']         = 'library/add_dept_books_issuance';
        $this->load->view('common/common',$this->data); 
    }
    public function add_dept_issuance_book()
    {    
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $book_id   = $this->input->post('book_id');
            $accession_no  = $this->input->post('accession_no');
            $form_Code  = $this->input->post('form_Code');
        
            $msg ='';
            $checked = array(
                'book_id' => $book_id,
                'accession_no' =>$accession_no,
                );
                 $qry = $this->CRUDModel->get_where_row('lib_dept_books_issuance_details_demo',$checked);
                    if($qry):
                         $msg = '<p style="color:red">Sorry! This Book Already Exist in List..<p/>'; 
                        else:  
                        $data  = array(
                            'book_id' => $book_id,
                            'accession_no' =>$accession_no,
                            'form_Code' =>$form_Code,
                            'date' => date('Y-m-d'),
                            'user_id' => $user_id
                            );
                        $this->CRUDModel->insert('lib_dept_books_issuance_details_demo',$data);
                    endif;
    $where = array('form_Code' =>$form_Code,'date' => date('Y-m-d'),'lib_dept_books_issuance_details_demo.user_id' => $user_id);        
    $result = $this->LibraryModel->getdeptbooks_issuance($where);    
    if($result):
    echo $msg;    
        echo '<table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Accesson Number</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';        
                        foreach($result as $eRow):
                        echo '<tr id="'.$eRow->serial_no.'Delete">
                                <td>'.$eRow->book_title.'</td>
                                <td>'.$eRow->accession_no.'</td>                          
                                <td><a href="javascript:void(0)" id="'.$eRow->serial_no.'" class="deletedeptIssu"><i class="fa fa-trash"></i></a></td>                          
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        endif;
    ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deletedeptIssu').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'LibraryController/delete_deptissu_book',
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
    
    public function delete_deptissu_book()
    {
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('lib_dept_books_issuance_details_demo',array('serial_no'=>$deletId));
   }
    
    public function departmental_books_issuance()
    {
       if($this->input->post()):
            $dept_id   =  $this->input->post('department_id');     
            $emp_id   =  $this->input->post('prepared_by');     
            $issuance_date =  $this->input->post('issuance_date');  
            $where = '';
            $like = '';
            $this->data['dept_id'] = '';    
            $this->data['emp_id'] = '';    
            $this->data['issuance_date'] = '';
        
            if(!empty($dept_id)):
                $where['department.department_id'] = $dept_id;
                $this->data['dept_id'] =$dept_id;
            endif;
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($issuance_date)):
                $where['lib_dept_books_issuance.issued_date'] = $issuance_date;
                $this->data['issuance_date'] =$issuance_date;
            endif;
        $this->data['books'] = $this->LibraryModel->getDept_Books('lib_dept_books_issuance',$where);
        else:
        $this->data['books'] = $this->LibraryModel->getdeptBooksIssuance();
        endif;
        $this->data['page_title']   = 'Departmental Books Issuance List | ECMS';
        $this->data['page']         = 'library/departmental_books_issuance';
        $this->load->view('common/common',$this->data); 
    }
    
    public function dept_books_issuance_print()
    {
        $dept_id = $this->uri->segment(3);
        $where = array('department_id'=>$dept_id);
        $wheredata = array('lib_dept_books_issuance.dept_id'=>$dept_id);
        $this->data['dept_data'] = $this->CRUDModel->get_where_row('department',$where);
        $this->data['std_rq'] = $this->CRUDModel->get_where_row('lib_dept_books_issuance',$wheredata);
        $this->data['result'] = $this->LibraryModel->deptissuance_Books_details('lib_dept_books_issuance',$wheredata);
        $this->data['page_title']   = 'Departmental Print Books| ECMS';
        $this->data['page']         = 'library/dept_books_issuance_print';
        $this->load->view('common/common',$this->data); 
    }
    
    public function print_spine_label_identity()
    {
       $where = '';
        $like = '';
        $this->data['author_name'] = '';
        $this->data['subject_name'] = '';
        $this->data['accession_from'] = '';
        $this->data['old_accession'] = '';
        $this->data['accession_number'] = '';
        $this->data['old_accession_number'] = '';
        if($this->input->post('search')):
            $book_id   =  $this->input->post('book_id');      
            $author_name =  $this->input->post('author_name');   
            $subject_name =  $this->input->post('subject_name');   
            $accession_number =  $this->input->post('accession_number');   
            $old_accession =  $this->input->post('old_accession'); 
            $old_accession_number =  $this->input->post('old_accession_number'); 
            $d = explode(",",$old_accession_number);
            $array_return = '';
            $array_retrn = '';
            if(!empty($old_accession_number)):
            foreach($d as $row=>$key):
                $array_return[] = $key.',';
            endforeach;
                $this->data['old_accession_number'] = $old_accession_number;
            endif;
            $n = explode(",",$accession_number);
            $array_retrn = '';
            if(!empty($accession_number)):
            foreach($n as $row=>$key):
                $array_retrn[] = $key.',';
            endforeach;
                $this->data['accession_number'] = $accession_number;
            endif;
            if(!empty($book_id)):
                $where['lib_books_record.book_id'] = $book_id;
                $this->data['book_id'] = $book_id;
            endif;
            if(!empty($author_name)):
                $like['lib_books_record.author_name'] = $author_name;
                $this->data['author_name'] = $author_name;
            endif;
           if(!empty($subject_name)):
                $like['lib_books_record.subject_name'] = $subject_name;
                $this->data['subject_name'] = $subject_name;
            endif;
            if(!empty($accession_from)):
                $where['lib_book_code.accession_number'] = $accession_from;
                $this->data['accession_number'] =$accession_from;
            endif;
            if(!empty($old_accession)):
                $where['lib_book_code.old_accession_number'] = $old_accession;
                $this->data['old_accession'] = $old_accession;
            endif;
            $this->data['print_books'] = $this->LibraryModel->printbooksResults('lib_book_code',$where,$like,$array_return,$array_retrn);
            endif;
        $this->data['page_title']   = 'Print Spine Label and Identity List | ECMS';
        $this->data['page']         = 'library/print_spine_label_identity';
        $this->load->view('common/common',$this->data);
    }
    
public function daily_performance_report()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        
        $department_id = array('department_id'=>11, 'emp_status_id'=>1);
        $this->data['emp'] = $this->CRUDModel->dropDown('hr_emp_record', ' Select Employee ', 'emp_id', 'emp_name',$department_id);
        
        $this->data['emp_id'] = ""; 
        $this->data['from_date'] = ""; 
        $this->data['to_date'] = "";
        
        if($this->input->post('search')): 
            $emp_id = $this->input->post('emp_id');
            $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
            $to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
            
        $where = "";
        
        if(!empty($emp_id)):
                $where['emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
        endif;
        if(!empty($from_date)):
                $this->data['from_date'] =$from_date;
        endif;
        if(!empty($to_date)):
                $this->data['to_date'] =$to_date;
        endif;
        
            $this->data['result'] = $this->LibraryModel->getBooks_List($where,$this->data['from_date'],$this->data['to_date']);
        else:
            $this->data['result'] = $this->LibraryModel->getbookRecord($user_id);
        endif;
        
        $this->data['page_title']   = 'Daily Performance Report | ECMS';
        $this->data['page']         = 'library/daily_performance_report';
        $this->load->view('common/common',$this->data);
    }
    
        public function authors()
        {
            $this->data['authors']       = $this->CRUDModel->getResults('lib_authors');
            $this->data['page_title']   = 'Authors List | ECMS';
            $this->data['page']         = 'library/authors';
            $this->load->view('common/common',$this->data); 
        }
    
        public function supliers()
        {
            $this->data['supliers']       = $this->CRUDModel->getResults('lib_supliers');
            $this->data['page_title']   = 'Supliers List | ECMS';
            $this->data['page']         = 'library/supliers';
            $this->load->view('common/common',$this->data); 
        }
    
    public function publishers()
        {
            $this->data['publishers']       = $this->CRUDModel->getResults('lib_publishers');
            $this->data['page_title']   = 'Publishers List | ECMS';
            $this->data['page']         = 'library/publishers';
            $this->load->view('common/common',$this->data); 
        }
    
    public function add_publisher()
        {
            if($this->input->post()):
                $pub_name = ucwords(strtolower(ucwords($this->input->post('pub_name'))));
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $email = $this->input->post('email');
                $fax = $this->input->post('fax');
                $data = array
                (
                    'pub_name'=>$pub_name,
                    'phone'=>$phone,
                    'address'=>$address,
                    'email'=>$email,
                    'fax'=>$fax
                );
                $this->CRUDModel->insert('lib_publishers', $data);
                redirect('LibraryController/publishers');
            endif;
            $this->data['page_title']   = 'Publishers List | ECMS';
            $this->data['page']         = 'library/publishers';
            $this->load->view('common/common',$this->data); 
        }
    
    public function add_suplier()
        {
            if($this->input->post()):
                $sup_name = ucwords(strtolower(ucwords($this->input->post('sup_name'))));
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $email = $this->input->post('email');
                $fax = $this->input->post('fax');
                $data = array
                (
                    'sup_name'=>$sup_name,
                    'phone'=>$phone,
                    'address'=>$address,
                    'email'=>$email,
                    'fax'=>$fax
                );
                $this->CRUDModel->insert('lib_supliers', $data);
                redirect('LibraryController/supliers');
            endif;
            $this->data['page_title']   = 'Supliers List | ECMS';
            $this->data['page']         = 'library/supliers';
            $this->load->view('common/common',$this->data); 
        }
    
    public function add_author()
        {
            if($this->input->post()):
                $author_name = ucwords(strtolower(ucwords($this->input->post('author_name'))));
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $email = $this->input->post('email');
                $fax = $this->input->post('fax');
                $author_mark = $this->input->post('author_mark');
                $str = strtoupper($author_mark);
                $status = $this->input->post('status');
                $comments = $this->input->post('comments');
                $data = array
                (
                    'author_name'=>$author_name,
                    'phone'=>$phone,
                    'address'=>$address,
                    'email'=>$email,
                    'fax'=>$fax,
                    'author_mark'=>$str,
                    'status'=>$status,
                    'comments'=>$comments
                );
                $this->CRUDModel->insert('lib_authors', $data);
                redirect('LibraryController/authors');
            endif;
            $this->data['page_title']   = 'Authors List | ECMS';
            $this->data['page']         = 'library/authors';
            $this->load->view('common/common',$this->data); 
        }
    
        public function delete_publisher()
        {
            $id         = $this->uri->segment(3);
            $where      = array('pub_id'=>$id);
            $this->CRUDModel->deleteid('lib_publishers',$where);
            redirect('LibraryController/publishers');
        }
    
    public function delete_author()
        {
            $id         = $this->uri->segment(3);
            $where      = array('author_id'=>$id);
            $this->CRUDModel->deleteid('lib_authors',$where);
            redirect('LibraryController/authors');
        }
    
    public function delete_suplier()
        {
            $id         = $this->uri->segment(3);
            $where      = array('sup_id'=>$id);
            $this->CRUDModel->deleteid('lib_supliers',$where);
            redirect('LibraryController/supliers');
        }
    
        public function update_author($id)
        {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $author_name = ucwords(strtolower(ucwords($this->input->post('author_name'))));
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $email = $this->input->post('email');
                $fax = $this->input->post('fax');
                $author_mark = $this->input->post('author_mark');
                $str = strtoupper($author_mark);
                $status = $this->input->post('status');
                $comments = $this->input->post('comments');
                $data = array
                (
                    'author_name'=>$author_name,
                    'phone'=>$phone,
                    'address'=>$address,
                    'email'=>$email,
                    'fax'=>$fax,
                    'author_mark'=>$str,
                    'status'=>$status,
                    'comments'=>$comments
                );
            $where = array('author_id'=>$id);
            $this->CRUDModel->update('lib_authors',$data, $where);
            redirect('LibraryController/authors');
        endif;
        if($id):
                $where = array('lib_authors.author_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('lib_authors',$where);
                $this->data['page_title']        = 'Update Author | ECMS';
                $this->data['page']        =  'library/update_author';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
        }
    
    public function update_publisher($id)
        {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
        $pub_name = ucwords(strtolower(ucwords($this->input->post('pub_name'))));
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $email = $this->input->post('email');
                $fax = $this->input->post('fax');
                $data = array
                (
                    'pub_name'=>$pub_name,
                    'phone'=>$phone,
                    'address'=>$address,
                    'email'=>$email,
                    'fax'=>$fax
                );
            $where = array('pub_id'=>$id);
            $this->CRUDModel->update('lib_publishers',$data, $where);
            redirect('LibraryController/publishers');
        endif;
        if($id):
                $where = array('lib_publishers.pub_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('lib_publishers',$where);
                $this->data['page_title']        = 'Update Publisher | ECMS';
                $this->data['page']        =  'library/update_publisher';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
        }
    
    public function update_suplier($id)
        {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $sup_name = ucwords(strtolower(ucwords($this->input->post('sup_name'))));
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $email = $this->input->post('email');
                $fax = $this->input->post('fax');
                $data = array
                (
                    'sup_name'=>$sup_name,
                    'phone'=>$phone,
                    'address'=>$address,
                    'email'=>$email,
                    'fax'=>$fax
                );
            $where = array('sup_id'=>$id);
            $this->CRUDModel->update('lib_supliers',$data,$where);
            redirect('LibraryController/supliers');
        endif;
        if($id):
                $where = array('lib_supliers.sup_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('lib_supliers',$where);
                $this->data['page_title']        = 'Update suplier | ECMS';
                $this->data['page']        =  'library/update_suplier';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
        }
   
    public function subjects()
    {       
    
        $this->data['result']       = $this->CRUDModel->getResults('lib_book_category');
        $this->data['page_title']   = 'Subjects List | ECMS';
        $this->data['page']         = 'library/subjects';
        $this->load->view('common/common',$this->data);
    }
    
    public function delete_subject()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('subject_id'=>$id);
        $this->CRUDModel->deleteid('lib_book_category',$where);
        redirect('LibraryController/subjects');
	}
    
    public function add_subject()
    {       
        if($this->input->post()):
            $subject_name      = $this->input->post('subject_name');
            $checked = array
            (
               'subject_name' =>$subject_name
            );
            $qry = $this->CRUDModel->get_where_row('lib_book_category',$checked);
            if($qry):
            $this->session->set_flashdata('msg', 'Sorry! Subject Name Already Exist');
            redirect('LibraryController/subjects');
            else:
            $data       = array(
                'subject_name' =>$subject_name
            );
            endif;
            endif;
            $this->CRUDModel->insert('lib_book_category',$data);
            redirect('LibraryController/subjects');
            $this->data['page_title']   = 'Subjects List | ECMS';
            $this->data['page']         = 'library/subjects';
            $this->load->view('common/common',$this->data);
         
    }
    
    public function update_subject($id)
    {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $subject_name      = $this->input->post('subject_name');
            $data       = array(
                'subject_name' =>$subject_name
            );
            $where = array('subject_id'=>$id);
            $this->CRUDModel->update('lib_book_category',$data, $where);
            redirect('LibraryController/subjects');
        endif;
        if($id):
                $where = array('lib_book_category.subject_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('lib_book_category',$where);
                $this->data['page_title']        = 'Update Subject | ECP';
                $this->data['page']        =  'library/update_subject';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
//    public function books_record()
//    {
//        if($this->input->post('search')):
//            $book_id       =  $this->input->post('book_id');      
//            $author_id       =  $this->input->post('author_id');      
//            $publisher_id       =  $this->input->post('publisher_id');      
//            $suplier_id       =  $this->input->post('suplier_id');      
//            $subject_id       =  $this->input->post('subject_id');     
//        
//            $where = '';
//            $this->data['book_id'] = '';   
//            $this->data['author_id'] = '';   
//            $this->data['publisher_id'] = '';   
//            $this->data['suplier_id'] = '';   
//            $this->data['subject_id'] = '';   
//        
//            if(!empty($book_id)):
//                $where['lib_books_record.book_id'] = $book_id;
//                $this->data['book_id'] =$book_id;
//            endif;
//            if(!empty($author_id)):
//                $where['lib_authors.author_id'] = $author_id;
//                $this->data['author_id'] =$author_id;
//            endif;
//            if(!empty($publisher_id)):
//                $where['lib_publishers.publisher_id'] = $publisher_id;
//                $this->data['publisher_id'] =$publisher_id;
//            endif;
//            if(!empty($suplier_id)):
//                $where['lib_supliers.suplier_id'] = $suplier_id;
//                $this->data['suplier_id'] =$suplier_id;
//            endif;
//            if(!empty($subject_id)):
//                $where['lib_book_category.subject_id'] = $subject_id;
//                $this->data['subject_id'] =$subject_id;
//            endif;
//            $this->data['books'] = $this->LibraryModel->searchbooksResults('lib_books_record',$where);
//            else:
//            $config['base_url']         = base_url('LibraryController/books_record');
//            $config['total_rows']       = count($this->LibraryModel->getBooks());  
//            $config['per_page']         = 50;
//            $config["num_links"]        = 2;
//            $config['uri_segment']      = 3;
//            $config['full_tag_open']    = "<ul class='pagination'>";
//            $config['full_tag_close']   = "</ul>";
//            $config['num_tag_open']     = '<li>';
//            $config['num_tag_close']    = '</li>';
//            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
//            $config['cur_tag_close']    = "</a></li>";
//            $config['next_tag_open']    = "<li>";
//            $config['next_tag_close']   = "</li>";
//            $config['prev_tag_open']    = "<li>";
//            $config['prev_tag_close']   = "</li>";
//            $config['first_tag_open']   = "<li>";
//            $config['first_tag_close']  = "</li>";
//            $config['last_tag_open']    = "<li>";
//            $config['last_tag_close']   = "</li>";
//            $config['first_link']       = "<i class='fa fa-angle-left'></i>";
//            $config['last_link']        = "<i class='fa fa-angle-right'></i>";
//
//
//            $this->pagination->initialize($config);
//            $page                       = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
//            $this->data['pages']        = $this->pagination->create_links();
//            $custom['column']    ='emp_id';
//            $custom['order']     ='desc';          
//        $this->data['books']=$this->LibraryModel->getBookPg($config['per_page'], $page,null,$custom);
//            $this->data['count']     =$config['total_rows']; 
//            endif;
//        $this->data['page_title']   = 'Books List | ECMS';
//        $this->data['page']         = 'library/books_record';
//        $this->load->view('common/common',$this->data);
//    }
    
    public function books_record(){
        $where  = array();
        $like   = array();
        $this->data['book_id']      = '';   
        $this->data['author_name']  = '';
        $this->data['subject_name'] = '';
        $this->data['accession_from'] = '';
        $this->data['old_accession'] = '';
        $this->data['book_category'] = '';
        
        $this->data['book_status'] = $this->CRUDModel->dropDown('lib_book_availability_status', 'Book Status', 'availability_status_id', 'title', '', array('column'=>'title','order'=>'asc'));
        
        if($this->input->post()):
            $book_id        =  $this->input->post('book_id');      
            $author_name    =  $this->input->post('author_name');   
            $subject_name   =  $this->input->post('subject_name');   
            $accession_from =  $this->input->post('accession_from');   
            $old_accession  =  $this->input->post('old_accession'); 
            $book_category  =  $this->input->post('book_category_id'); 
            $verify_status  =  $this->input->post('verified_status'); 
            $book_status    =  $this->input->post('book_status'); 
            
            if(!empty($book_id)):
                $where['lib_books_record.book_id'] = $book_id;
                $this->data['book_id'] = $book_id;
            endif;
            if(!empty($book_category)):
                $where['lib_books_record.lib_book_cagegory'] = $book_category;
                $this->data['book_category'] = $book_category;
            endif;
            if(!empty($author_name)):
                $like['lib_books_record.author_name'] = $author_name;
                $this->data['author_name'] = $author_name;
            endif;
            if(!empty($author_name)):
                $like['lib_books_record.author_name'] = $author_name;
                $this->data['author_name'] = $author_name;
            endif;
           if(!empty($subject_name)):
                $like['lib_books_record.subject_name'] = $subject_name;
                $this->data['subject_name'] = $subject_name;
            endif;
            if(!empty($accession_from)):
                $where['lib_book_code.accession_number'] = $accession_from;
                $this->data['accession_from'] =$accession_from;
            endif;
            if(!empty($old_accession)):
                $where['lib_book_code.old_accession_number'] = $old_accession;
                $this->data['old_accession'] =$old_accession;
            endif;
            if(!empty($verify_status)):
                $where['lib_books_record.book_verified'] = $verify_status;
            endif;
            if(!empty($book_status)):
                $where['lib_book_code.book_availablity_status_id'] = $book_status;
            endif;
            $this->data['books'] = $this->LibraryModel->searchbooksResults('lib_book_code',$where,$like);
        else:
            $config['base_url']         = base_url('LibraryController/books_record');
            $config['total_rows']       = count($this->LibraryModel->view_bookRecord());  
            $config['per_page']         = 50;
            $config["num_links"]        = 2;
            $config['uri_segment']      = 3;
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            $config['first_link']       = "<i class='fa fa-angle-left'></i>";
            $config['last_link']        = "<i class='fa fa-angle-right'></i>";


            $this->pagination->initialize($config);
            $page                       = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) :  0;
            $this->data['pages']        = $this->pagination->create_links();
            $custom['column']    ='emp_id';
            $custom['order']     ='desc';          
            $this->data['books']=$this->LibraryModel->viewBookPg($config['per_page'], $page,null,$custom);
            $this->data['count']     =$config['total_rows']; 
        endif;
        
        if($this->input->post('export')):
            
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle('Library Books Record');

            $this->excel->getActiveSheet()->setCellValue('A1', 'New Accession #');          
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1','Old Accession #');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1', 'Book Title');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Sub Book Title');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1', 'ISBN #');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1', 'Author Name');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1', 'Book Status');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
    
            for($col = ord('A'); $col <= ord('G'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);               
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }
                
                    
            $book_id   =  $this->input->post('book_id');      
            $author_name =  $this->input->post('author_name');    
            $subject_name =  $this->input->post('subject_name'); 
            $accession_from =  $this->input->post('accession_from');   
            $old_accession =  $this->input->post('old_accession'); 
            $book_category =  $this->input->post('book_category_id'); 
            $verify_status  =  $this->input->post('verified_status'); 
            $book_status    =  $this->input->post('book_status'); 
            
            $where = array();
            $like = array();
            $this->data['book_id'] = '';   
            $this->data['author_name'] = '';
            $this->data['subject_name'] = '';
            $this->data['accession_from'] = '';
            $this->data['old_accession'] = '';
            if(!empty($book_category)):
                $where['lib_books_record.lib_book_cagegory'] = $book_category;
                $this->data['book_category'] = $book_category;
            endif;
            if(!empty($book_id)):
                $where['lib_books_record.book_id'] = $book_id;
                $this->data['book_id'] = $book_id;
            endif;
            if(!empty($author_name)):
                $like['lib_books_record.author_name'] = $author_name;
                $this->data['author_name'] =$author_name;
            endif;
           if(!empty($subject_name)):
                $like['lib_books_record.subject_name'] = $subject_name;
                $this->data['subject_name'] = $subject_name;
            endif;
            if(!empty($accession_from)):
                $where['lib_book_code.accession_number'] = $accession_from;
                $this->data['accession_from'] =$accession_from;
            endif;
            if(!empty($old_accession)):
                $where['lib_book_code.old_accession_number'] = $old_accession;
                $this->data['old_accession'] =$old_accession;
            endif;
            if(!empty($verify_status)):
                $where['lib_books_record.book_verified'] = $verify_status;
            endif;
            if(!empty($book_status)):
                $where['lib_book_code.book_availablity_status_id'] = $book_status;
            endif;
            $result = $this->LibraryModel->booksResults_excel('lib_book_code',$where,$like);
            $exceldata="";
            foreach ($result as $row)
            {
                $exceldata[] = $row;
            }              
            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename='Library_books_record.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output');
        endif;
        $this->data['page_title']   = 'Books List | ECMS';
        $this->data['page']         = 'library/books_record';
        $this->load->view('common/common',$this->data);
    }    
    
    public function view_book()
    {
        $id = $this->uri->segment(3);
        $serial_no = $this->uri->segment(4);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $book_name = $this->input->post('book_name');
            $sub_book_name = $this->input->post('sub_book');
            $author_name = $this->input->post('author_name');
            $joint_author = $this->input->post('joint_author');
            $publish_by = $this->input->post('publish_by');
            $source = $this->input->post('source');
            $subject_name = $this->input->post('subject_name');
            $sub_subject = $this->input->post('sub_subject_name');
            $author_status      = $this->input->post('author_status');
            $author_mark      = $this->input->post('author_mark');
            $str = strtoupper($author_mark);
            $book_isbn      = $this->input->post('book_isbn');
            $publisher_address      = $this->input->post('publisher_address');
            $language_id    = $this->input->post('language_id');
            $book_copies    = $this->input->post('book_copies');
            $dvdemil      = $this->input->post('dvdecmil');
            $pub_year      = $this->input->post('pub_year');
            $edition      = $this->input->post('edition');
            $volum      = $this->input->post('volume');
            $purchase_date      = $this->input->post('purchase_date');
            $price      = $this->input->post('price');
            $series      = $this->input->post('series');
            $location_id      = $this->input->post('location_id');
            $pages      = $this->input->post('pages');
            $remarks      = $this->input->post('remarks');
            $material      = $this->input->post('material');
            $old_accession_number      = $this->input->post('old_accession_number');
            $book_category      = $this->input->post('book_category');
            $data       = array(
                'book_title' =>$book_name,
                'lib_book_cagegory' =>$book_category,
                'sub_book_title' =>$sub_book_name,
                'book_isbn' =>$book_isbn,
                'author_name' =>$author_name,
                'author_mark' =>$str,
                'author_status' =>$author_status,
                'joint_author_name' =>$joint_author,
                'publish_by' =>$publish_by,
                'publisher_address' =>$publisher_address,
                'source' =>$source,
                'subject_name' =>$subject_name,
                'sub_subject_name' =>$sub_subject,
                'language_id' =>$language_id,
                'book_copies' =>$book_copies,
                'dvdecmil' =>$dvdemil,
                'pub_year' =>$pub_year,
                'edition' =>$edition,
                'volume' =>$volum,
                'purchase_date' =>$purchase_date,
                'price' =>$price,
                'series' =>$series,
                'location_id' =>$location_id,
                'pages' =>$pages,
                'remarks' =>$remarks,
                'material' =>$material,
                'user_id'=>$user_id
            );
            $where = array('book_id'=>$id);
            $this->CRUDModel->update('lib_books_record',$data, $where);
            
            $where1 = array('serial_no'=>$serial_no);
            $checked = array
            (
               'old_accession_number' =>$old_accession_number
            );
            $qry = $this->CRUDModel->get_where_row('lib_book_code',$checked);
            if($qry):
            $this->session->set_flashdata('msg', 'Sorry! Old Accession No. Already Exist');
            redirect('LibraryController/books_record');
            else:
            $data1 = array('old_accession_number' => $old_accession_number);
            $this->LibraryModel->updateCopy('lib_book_code',$data1, $where1);
            redirect('LibraryController/books_record');
        endif;
        endif;
        $where = array('lib_books_record.book_id'=>$id);
        $where1 = array('lib_book_code.serial_no'=>$serial_no);
        $this->data['books']       = $this->LibraryModel->view_book('lib_books_record',$where);
        $this->data['book_code']   = $this->LibraryModel->view_bookCopy('lib_book_code',$where1);
        $this->data['page_title']   = 'View Book | ECMS';
        $this->data['page']         = 'library/view_book';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function verify_books(){
        
//        echo '<pre>'; print_r($this->input->post()); die;
        $book_id = $this->input->post('book_id');
        $status  = $this->input->post('status');
        
        if($status == 1): $v_slc = 'selected="selected"'; $u_slc = ''; else: $v_slc = ''; $u_slc = 'selected="selected"'; endif;
        
        echo '<div class="modal-body">
            <section class="course-finder">
                <div class="col-md-12 subject form-group">
                    <p>&nbsp;</p>
                    <label style="text-indent: 3px">Applicant Status<span style="color:red">*</span></label>
                    <select class="form-control" name="status_val" id="status_val">
                        <option '.$u_slc.' value="0">Unverified</option>
                        <option '.$v_slc.' value="1">Verified</option>
                    </select>
                    <input type="hidden" name="bk_id" id="bk_id" class="form-control" value="'.$book_id.'">
                    <br>
               </div>
            </section> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
            <button type="button" class="btn btn-success saveStatus" >Save</button>
        </div>';
        
        ?>
        <script>
            $(document).ready(function(){
                $('.saveStatus').on('click', function(){
                    $.ajax({
                        'type'  : 'post',
                        'url'   : 'LibraryController/verify_book_status',
                        data    : { 'id' : $('#bk_id').val(), 'st' : $('#status_val').val() },
                        success : function(response){
                            console.log(response);
                            window.location.reload();
                        }
                    });
                });
            });
        </script>
        <?php
        
    }
    
    public function verify_book_status(){
//        echo '<pre>'; print_r($this->input->post()); die;
        $this->CRUDModel->update('lib_books_record', array('book_verified' => $this->input->post('st')), array('book_id' => $this->input->post('id')));
    }
    
    public function search_old_accession()
    {
        if($this->input->post()):
            $accession_number       = $this->input->post('accession_number');
            $old_accession_number   = $this->input->post('old_accession_number');
            $isbn_number            = $this->input->post('isbn_number');
            $where = '';
            $this->data['lib_book_code.old_accession_number'] = '';
            $this->data['lib_book_code.accession_number'] = '';
            if(!empty($accession_number)):
                $where['accession_number'] = $accession_number;
                $this->data['accession_number'] =$accession_number;
            endif;
            if(!empty($old_accession_number)):
                $where['old_accession_number'] = $old_accession_number;
                $this->data['old_accession_number'] =$old_accession_number;
            endif;
            if(!empty($isbn_number)):
                $where['book_isbn'] = $isbn_number;
                $this->data['isbn_number'] =$isbn_number;
            endif;
        $this->data['books'] = $this->LibraryModel->searchOldaccession('lib_book_code',$where);    
            endif;
            $this->data['page_title']   = 'Add New Book | ECMS';
            $this->data['page']         = 'library/add_book';
            $this->load->view('common/common',$this->data);
    }
    
    public function auto_students()
     { 
        $term = $this->input->get('term');
//        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->LibraryModel->getStudents('student_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
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
            
            $result_set             = $this->LibraryModel->getStudents('student_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'label'=>$row_set->student_name.'('.$row_set->college_no.')',
                    'id'=>$row_set->student_id,
                    'college_no'=>$row_set->college_no
                    );
            }
            $matches = array();
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
    
    public function auto_books_accession()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->LibraryModel->getBooksaccession('lib_book_code');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->book_title.'('.$row_set->accession_number.')',
                    'label'=>$row_set->book_title.'('.$row_set->accession_number.')',
                    'id'=>$row_set->book_id,
                    'accession_no'=>$row_set->accession_number
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
            
            $result_set             = $this->LibraryModel->getBooksaccession('lib_book_code',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->book_title.'('.$row_set->accession_number.')',
                    'label'=>$row_set->book_title.'('.$row_set->accession_number.')',
                    'id'=>$row_set->book_id,
                    'accession_no'=>$row_set->accession_number
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
    
    public function add_book_issuance()
    {
        $this->data['page_title']   = 'Issuance Book | ECMS';
        $this->data['page']         = 'library/add_books_issuance';
        $this->load->view('common/common',$this->data);  
    }
    
    public function get_due_date(){
        $issue_date     = $this->input->post('issue_date');
        echo date('Y-m-d', strtotime($issue_date. '+ 15 days')); 
//        echo $due_date; die;
    }
    
    public function insert_books_issuance()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('submit_item')):  
           $student_id   = $this->input->post('student_id');   
           $college_no   = $this->input->post('college_no');   
           $issued_date   = $this->input->post('issuance_date'); 
           $due_date   = $this->input->post('due_date'); 
           $form_Code  = $this->input->post('form_Code');
            $where = array('student_id'=>$student_id);
           $q = $this->LibraryModel->getStdData('student_record',$where);
           $std_data = $q->student_name. ', '.$q->name. ', ' . $q->college_no;
           // echo '<pre>';print_r($std_data);die;
           // $dd = 'Irfan Ullah Dilawar Said College Number 16439';
           $this->RQ($std_data,'assets/RQ/library_rq/');
           $data1 = array(
                'student_id' => $student_id,
                'college_no' => $college_no,
                'issued_date' =>$issued_date,
                'due_date' =>$due_date,
                'rq_image' =>$std_data.'.png',
                'user_id' =>$user_id,
            );
            $id = $this->CRUDModel->insert('lib_book_issuance',$data1);
            $where = array(
            'user_id'=>$user_id,
            'form_Code'=>$form_Code,
            'date' => date('Y-m-d')    
                ); 
       $res =  $this->CRUDModel->get_where_result('lib_book_issuance_details_demo', $where);
       foreach($res as $isRow):
        $data = array(   
            'book_id'     =>$isRow->book_id,
            'issuance_id' =>$id,
            'accession_no'=>$isRow->accession_no,
            'availablity_status_id' =>1,
            'form_Code'   =>$isRow->form_Code,
            'date'        =>$isRow->date,
            'user_id'     =>$isRow->user_id,
          );
        $this->CRUDModel->insert('lib_book_issuance_details',$data);
        $where = array('book_id'=>$isRow->book_id, 'accession_number'=>$isRow->accession_no);
        $book_data = array
            (
                'book_availablity_status_id'=>1
            );
            $this->CRUDModel->update('lib_book_code',$book_data, $where);
        
           $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('lib_book_issuance_details_demo',$whereDelete);
        endforeach; 
            redirect('LibraryController/book_issuance');
            endif;
    }
    
    public function update_book_issu_status()
    {
        $session        = $this->session->all_userdata();
        $user_id        = $session['userData']['user_id'];
        $student_id = $this->uri->segment(3);
        if($this->input->post()):
                $availability_status_id = $this->input->post('availability_status_id');
                $student_id = $this->input->post('student_id');
                $return_date = $this->input->post('return_date');
                $date1 = date('Y-m-d', strtotime($return_date));
                $accession_no = $this->input->post('accession_no');
                $ides       = $this->input->post('checked');
        if(!empty($ides)):      
            foreach($ides as $row=>$value):
                $data =  array('book_availablity_status_id'=>$availability_status_id);
                $where = array('accession_number'=>$value);
                $this->CRUDModel->update('lib_book_code',$data,$where);
                $data1 =  array('availablity_status_id'=>$availability_status_id,'flag'=>1);
                $where1 = array('accession_no'=>$value);
                $this->LibraryModel->updateIssuanceBook('lib_book_issuance_details',$data1,$where1);
                $q = $this->CRUDModel->get_where_row('lib_book_code',$where);
                $insData = array(
                    'student_id' => $student_id,
                    'book_id' =>$q->book_id,
                    'accession_no'=>$value,
                    'date'=>date('Y-m-d'),
                    'user_id'=>$user_id
                            );
                $this->CRUDModel->insert('lib_book_received_books',$insData);
            endforeach;   
         endif;   
        redirect('LibraryController/book_issuance');
        endif;
        $student_id = $this->uri->segment(3);
        $where = array('student_id'=>$student_id);
        $wheredata = array('lib_book_issuance.student_id'=>$student_id);
        $this->data['student_data'] = $this->CRUDModel->get_where_row('student_record', $where);
        $this->data['result'] = $this->LibraryModel->return_Books_details('lib_book_issuance',$wheredata);
        $this->data['page_title']   = 'Update Books Issuance Status | ECMS';
        $this->data['page']         = 'library/update_book_iss_status';
        $this->load->view('common/common',$this->data); 
    }
    
    public function books_issuance_print()
    {
        $student_id = $this->uri->segment(3);
        $where = array('student_id'=>$student_id);
        $wheredata = array('lib_book_issuance.student_id'=>$student_id);
        $this->data['student_data'] = $this->LibraryModel->getStdData('student_record',$where);
        $this->data['std_rq'] = $this->CRUDModel->get_where_row('lib_book_issuance',$wheredata);
        $this->data['result'] = $this->LibraryModel->issuance_Books_details('lib_book_issuance',$wheredata);
        $this->data['page_title']   = 'Print Books Issuance | ECMS';
        $this->data['page']         = 'library/books_issuance_print';
        $this->load->view('common/common',$this->data); 
    }
    
        public function print_book_card()
    {
        $student_id = $this->uri->segment(3);
        $where = array('student_id'=>$student_id);
        $wheredata = array('lib_book_issuance.student_id'=>$student_id);
        $this->data['student_data'] = $this->CRUDModel->get_where_row('student_record',$where);
        $this->data['std_rq'] = $this->CRUDModel->get_where_row('lib_book_issuance',$wheredata);
        $this->data['result'] = $this->LibraryModel->issuance_Books_details('lib_book_issuance',$wheredata);
        $this->data['page_title']   = 'Student Library Card | ECMS';
        $this->data['page']         = 'library/print_book_card';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_issuance_book(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        
        if($this->input->post()):
            $student_id     = $this->input->post('student_id');
            $book_id        = $this->input->post('book_id');
            $accession_no   = $this->input->post('accession_no');
            $form_Code      = $this->input->post('form_Code');
            $where_check    = array('student_id'=>$student_id);
            
            $check_std = $this->CRUDModel->get_wherein_row_order('lib_book_issuance_details', array('accession_no'=>$accession_no), 'availablity_status_id', array(1,3,4,6), 'serial_no', 'desc');
            $check_stf = $this->CRUDModel->get_wherein_row_order('lib_book_staff_issuance_details', array('accession_no'=>$accession_no), 'availablity_status_id', array(1,3,4,6), 'serial_no', 'desc');
            
            if(empty($check_std) && empty($check_stf)):
                $q = $this->CRUDModel->get_where_row('student_record',$where_check);
                $book_rec = $this->LibraryModel->count_books('lib_book_issuance',array('student_record.student_id'=>$student_id,'lib_book_issuance_details.availablity_status_id'=>1));
                $book_recdemo = $this->LibraryModel->countdemo_books('lib_book_issuance_details_demo',array('form_Code'=>$form_Code));

                $total      = "";
                $total_demo = "";
                $gTotal     = "";
                $msg_n      = "";
                $msg        = '';
                
                if(!empty($book_rec)):
                    $total = $book_rec->total_books;
                endif;

                if(!empty($book_recdemo)):
                    $total_demo = count($book_recdemo);
                endif;
                
                 $gTotal = $total + $total_demo;
                 
                if($q->programe_id == 1):
                    if($gTotal >= 2):
                        $msg_n = '<p style="color:red">Just Two Books are Allowed for FA/FSc Level<p/>';     
                    else:
                   // echo 'insert ';
                        $checked = array(
                            'book_id' => $book_id,
                            'accession_no' =>$accession_no,
                        );
                        $qry = $this->CRUDModel->get_where_row('lib_book_issuance_details_demo',$checked);
                        
                        if($qry):
                            $msg = '<p style="color:red">Sorry! This Book Already Exist in List..<p/>'; 
                        else:  
                            $data  = array(
                                'book_id' => $book_id,
                                'accession_no' =>$accession_no,
                                'form_Code' =>$form_Code,
                                'date' => date('Y-m-d'),
                                'user_id' => $user_id
                            );
                            $this->CRUDModel->insert('lib_book_issuance_details_demo',$data);
                        endif;
                        
                    endif;
                endif;
                
                if($q->programe_id != 1):
                    if($gTotal >= 3):
                        $msg_n = '<p style="color:red">Just Three Books are Allowed for Degree / BS(Hons) Level<p/>';
                    else:
                   // echo 'insert ';
                        $checked = array(
                            'book_id' => $book_id,
                            'accession_no' =>$accession_no,
                        );
                        $qry = $this->CRUDModel->get_where_row('lib_book_issuance_details_demo',$checked);
                        if($qry):
                             $msg = '<p style="color:red">Sorry! This Book Already Exist in List..<p/>'; 
                        else:  
                            $data  = array(
                                'book_id' => $book_id,
                                'accession_no' =>$accession_no,
                                'form_Code' =>$form_Code,
                                'date' => date('Y-m-d'),
                                'user_id' => $user_id
                            );
                            $this->CRUDModel->insert('lib_book_issuance_details_demo',$data);
                        endif;
                    endif;
                endif;
            else:
                    
                $this->db->join('lib_book_issuance', 'lib_book_issuance.issuance_id=lib_book_issuance_details.issuance_id');
                $this->db->join('student_record', 'student_record.student_id=lib_book_issuance.student_id');
                $this->db->join('sub_programes', 'sub_programes.sub_pro_id=student_record.sub_pro_id');
                $this->db->SELECT('
                    student_record.college_no,
                    student_record.student_name,
                    lib_book_issuance.issued_date,
                    lib_book_issuance_details.availablity_status_id,
                    sub_programes.name,
                ');
                $this->db->order_by('serial_no', 'desc');
                $get_std_iss = $this->db->get_where('lib_book_issuance_details', array('accession_no'=>$accession_no))->row();
                    
                if(!empty($get_std_iss)):
                    if($get_std_iss->availablity_status_id == '1'):
                        echo '<div class="col-md-12">
                            <p style="color:#d00;">This book is already issued.</p>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display">
                                <tr>
                                    <th>College No</th>
                                    <th>Student Nama</th>
                                    <th>Program</th>
                                    <th>Issued Date No</th>
                                </tr>
                                <tr>
                                    <td>'.$get_std_iss->college_no.'</td>
                                    <td>'.$get_std_iss->student_name.'</td>
                                    <td>'.$get_std_iss->name.'</td>
                                    <td>'.date('d-m-Y', strtotime($get_stf_iss->issued_date)).'</td>
                                </tr>
                            </table>
                        </div>';
                    else:
                        $bk_status = $this->CRUDModel->get_where_row('lib_book_availability_status', array('availability_status_id'=> $get_std_iss->availablity_status_id));
                        echo '<div class="col-md-12">
                            <p style="color:#d00;">This book is '.$bk_status->title.'.</p>
                        </div>';
                    endif;
                endif;
                        
                    
                $this->db->join('lib_staff_book_issuance', 'lib_staff_book_issuance.iss_id=lib_book_staff_issuance_details.iss_id');
                $this->db->join('hr_emp_record', 'hr_emp_record.emp_id=lib_staff_book_issuance.emp_id');
                $this->db->join('department', 'department.department_id=hr_emp_record.department_id');
                $this->db->SELECT('
                    hr_emp_record.emp_name,
                    lib_staff_book_issuance.issued_date,
                    lib_book_staff_issuance_details.availablity_status_id,
                    department.title,
                ');
                $this->db->order_by('serial_no', 'desc');
                $get_stf_iss = $this->db->get_where('lib_book_staff_issuance_details', array('accession_no'=>$accession_no))->row();
                
                if(!empty($get_stf_iss)):
                    if($get_stf_iss->availablity_status_id == '1'):
                        echo '<div class="col-md-12">
                            <p style="color:#d00;">This book is already issued.</p>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display">
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Issued Date</th>
                                </tr>
                                <tr>
                                    <td>'.$get_stf_iss->emp_name.'</td>
                                    <td>'.$get_stf_iss->title.'</td>
                                    <td>'.date('d-m-Y', strtotime($get_stf_iss->issued_date)).'</td>
                                </tr>
                            </table>
                        </div>';
                    else:
                        $bk_status = $this->CRUDModel->get_where_row('lib_book_availability_status', array('availability_status_id'=> $get_stf_iss->availablity_status_id));
                        echo '<div class="col-md-12">
                            <p style="color:#d00;">This book is '.$bk_status->title.'.</p>
                        </div>';
                    endif;
                endif;
                        
            endif;
            
        $where = array('form_Code' =>$form_Code,'date' => date('Y-m-d'),'lib_book_issuance_details_demo.user_id' => $user_id);        
        $result = $this->LibraryModel->getbooks_issuance($where);  
        if($result):
            echo $msg.$msg_n;    
            echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Accesson Number</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>';        
                    foreach($result as $eRow):
                    echo '<tr id="'.$eRow->serial_no.'Delete">
                            <td>'.$eRow->book_title.'</td>
                            <td>'.$eRow->accession_no.'</td>                          
                            <td><a href="javascript:void(0)" id="'.$eRow->serial_no.'" class="deleteIssu"><i class="fa fa-trash"></i></a></td>                          
                       </tr>';                      
                    endforeach;                        
                    endif;                      
                echo '</tbody>
            </table> ';
        endif;
    ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deleteIssu').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'LibraryController/delete_issu_book',
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
    
    public function delete_issu_book()
    {
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('lib_book_issuance_details_demo',array('serial_no'=>$deletId));
   }  
    
   public function book_issuance()
    {
        if($this->input->post()):
            $student_id   =  $this->input->post('student_id');      
            $college_no =  $this->input->post('college_no');   
            $issuance_date =  $this->input->post('issuance_date');   
            $due_date =  $this->input->post('due_date');   
            $availability_status_id =  $this->input->post('availability_status_id');   
            // echo '<pre>';print_r($this->input->post());die;
            $where = '';
            $like = '';
            $this->data['student_id'] = '';   
            $this->data['college_no'] = '';
            $this->data['issuance_date'] = '';
            $this->data['due_date'] = '';
            $this->data['availability_status_id'] = '';
        
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            if(!empty($issuance_date)):
                $where['lib_book_issuance.issued_date'] = $issuance_date;
                $this->data['issuance_date'] =$issuance_date;
            endif;
            if(!empty($due_date)):
                $where['lib_book_issuance.due_date'] = $due_date;
                $this->data['due_date'] =$due_date;
            endif;
            if(!empty($availability_status_id)):
                $where['lib_book_availability_status.availability_status_id'] = $availability_status_id;
                $this->data['availability_status_id'] =$availability_status_id;
            endif;
        $this->data['books'] = $this->LibraryModel->searchBooksIssuance('lib_book_issuance',$where);
        else:
        $this->data['books'] = $this->LibraryModel->getBooksIssuance();
        endif;
        $this->data['page_title']   = 'Students Book Issuance List | ECMS';
        $this->data['page']         = 'library/books_issuance';
        $this->load->view('common/common',$this->data); 
    }
    
    public function view_book_issuance()
    {
        $ass_id = $this->uri->segment(3);
        $where = array('lib_book_issuance_details.issuance_id'=>$ass_id);
        $wheredata = array('lib_book_issuance.issuance_id'=>$ass_id);
        $this->data['book_issuance'] = $this->LibraryModel->get_Booksissuance('lib_book_issuance', $wheredata);
        $this->data['result'] = $this->LibraryModel->issuance_Books_details('lib_book_issuance_details', $where);
        $this->data['page_title']   = 'Books Issuance | ECMS';
        $this->data['page']         = 'library/show_books_issuance';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_book()
    {    
//        $session = $this->session->all_userdata();
//        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $book_name          = ucwords(strtolower(ucwords($this->input->post('book_name'))));
            $sub_book_name      = ucwords(strtolower(ucwords($this->input->post('sub_book'))));
            $author_name        = ucwords(strtolower(ucwords($this->input->post('author_name'))));
            $joint_author       = ucwords(strtolower(ucwords($this->input->post('joint_author'))));
            $publish_by         = ucwords(strtolower(ucwords($this->input->post('publish_by'))));
            $source             = ucwords(strtolower(ucwords($this->input->post('source'))));
            $subject_name       = ucwords(strtolower(ucwords($this->input->post('subject_name'))));
            $sub_subject        = ucwords(strtolower(ucwords($this->input->post('sub_subject_name'))));
            $author_status      = $this->input->post('author_status');
            $author_mark        = $this->input->post('author_mark');
            $str                = strtoupper($author_mark);
            $book_isbn          = $this->input->post('book_isbn');
            $publisher_address  = $this->input->post('publisher_address');
            $language_id        = $this->input->post('language_id');
            $book_copies        = $this->input->post('book_copies');
            $dvdemil            = $this->input->post('dvdecmil');
            $pub_year           = $this->input->post('pub_year');
            $edition            = $this->input->post('edition');
            $volum              = $this->input->post('volume');
            $purchase_date      = $this->input->post('purchase_date');
            $price              = $this->input->post('price');
            $series             = $this->input->post('series');
            $location_id        = $this->input->post('location_id');
            $pages              = $this->input->post('pages');
            $remarks            = $this->input->post('remarks');
            $material           = $this->input->post('material');
            $book_category      = $this->input->post('book_category');
            
            $data               = array(
            'book_title'        =>$book_name,
            'sub_book_title'    =>$sub_book_name,
            'book_isbn'         =>$book_isbn,
            'author_name'       =>$author_name,
            'author_mark'       =>$str,
            'lib_book_cagegory' =>$book_category,
            'author_status'     =>$author_status,
            'joint_author_name' =>$joint_author,
            'publish_by'        =>$publish_by,
            'publisher_address' =>$publisher_address,
            'source'            =>$source,
            'subject_name'      =>$subject_name,
            'sub_subject_name'  =>$sub_subject,
            'language_id'       =>$language_id,
            'book_copies'       =>$book_copies,
            'dvdecmil'          =>$dvdemil,
            'pub_year'          =>$pub_year,
            'edition'           =>$edition,
            'volume'            =>$volum,
            'purchase_date'     =>$purchase_date,
            'price'             =>$price,
            'series'            =>$series,
            'location_id'       =>$location_id,
            'pages'             =>$pages,
            'remarks'           =>$remarks,
            'material'          =>$material,
            'user_id'           =>$this->userInfo->user_id
//            'user_id'           =>$user_id
            );
            $book_id            = $this->CRUDModel->insert('lib_books_record',$data);
            $num                = $this->CRUDModel->get_max_valueCode('accession_number','lib_book_code');
            $Num                = $num->accession_number;
            $enum               = $Num+1;
            for($i=0; $i<$book_copies; $i++):
              $datacode = array(   
            'book_id'                   => $book_id,
            'accession_number'          => $enum+$i,
            'book_availablity_status_id'=> 5
                  );    
           $lastrecord          = $this->CRUDModel->insert('lib_book_code',$datacode);
            $id                 = $this->CRUDModel->get_where_row('lib_book_code',array('serial_no'=>$lastrecord));
        
            $this->RQ($id->accession_number,'assets/RQ/library_rq/');
            $data =  array('barcode_image'=>$id->accession_number.'.png');
        
            $where = array('serial_no'=>$id->serial_no);
            $this->CRUDModel->update('lib_book_code',$data, $where);
            endfor;
                redirect('LibraryController/books_record');
            endif;
            $this->data['page_title']   = 'Add New Book | ECMS';
            $this->data['page']         = 'library/add_book';
            $this->load->view('common/common',$this->data);    
    }
    
     public function add_book_copy()
    {
           if($this->input->post()):
                $book_id = $this->input->post('book_id');
                $book_copy = $this->input->post('book_copy');
                $where = array('book_id' =>$book_id);
                $result = $this->CRUDModel->get_where_row('lib_books_record',$where);
                $total_copies = $result->book_copies + $book_copy;
                $data = array('book_copies'=>$total_copies);
                $this->CRUDModel->update('lib_books_record',$data, $where);
                $num = $this->CRUDModel->get_max_valueCode('accession_number','lib_book_code');
                $Num = $num->accession_number;
                $enum = $Num+1;
                for($i=0; $i<$book_copy; $i++):
              $datacode = array(   
                    'book_id'          =>$book_id,
                    'accession_number'=>$enum+$i,
                    'book_availablity_status_id'=>5
                  );    
           $lastrecord = $this->CRUDModel->insert('lib_book_code',$datacode);
            $id = $this->CRUDModel->get_where_row('lib_book_code',array('serial_no'=>$lastrecord));
        
            $this->RQ($id->accession_number,'assets/RQ/library_rq/');
            $data =  array('barcode_image'=>$id->accession_number.'.png');
        
            $where2 = array('serial_no'=>$id->serial_no);
            $this->CRUDModel->update('lib_book_code',$data, $where2);
            endfor;
                redirect('LibraryController/add_book_copy');
              //  echo '<pre>';print_r($result);die;
            endif;
        
            $this->data['page']         = "library/add_book_copy";
            $this->data['title']        = 'Add Book Copy| ECMS';
            $this->load->view('common/common',$this->data);
    }
    
    public function delete_book()
    {	    
        $id = $this->uri->segment(3);
        $where = array('book_id'=>$id);
        $this->CRUDModel->deleteid('lib_books_record',$where);
        $this->CRUDModel->deleteid('lib_book_code',$where);
        $this->session->set_flashdata('msg', 'Book Has Successfully Been Deleted');
        redirect('LibraryController/books_record');
	}
    
    public function library_transaction_report()
    {
        if($this->input->post()):  
            $accession_from =  $this->input->post('accession_from');   
            $availability_status_id =  $this->input->post('availability_status_id');   
            $where = '';
            $this->data['accession_from'] = '';
            $this->data['issued_date']       = $this->input->post('issued_date');
            $this->data['due_date']         = $this->input->post('due_date');
            $this->data['availability_status_id'] = '';
        
            if(!empty($accession_from)):
                $where['lib_book_code.accession_number'] = $accession_from;
                $this->data['accession_from'] = $accession_from;
            endif;
            if(!empty($issued_date)):
                $where['issued_date'] = $issued_date;
                $this->data['issued_date'] =$issued_date;
            endif;
            if(!empty($due_date)):
                $where['due_date'] = $due_date;
                $this->data['due_date'] =$due_date;
            endif;
            if(!empty($availability_status_id)):
                $where['lib_book_availability_status.availability_status_id'] = $availability_status_id;
                $this->data['availability_status_id'] =$availability_status_id;
            endif;
            $this->data['books'] = $this->LibraryModel->searchTransactionReport('lib_book_code',$this->data['issued_date'],$this->data['due_date'],$where);
            else:
            $this->data['books'] = $this->LibraryModel->libraryTransactionReport();
           // echo '<pre>'; print_r($this->data['books']);die;
        endif;
        if($this->input->post('export')):
            $accession_from =  $this->input->post('accession_from');   
            $availability_status_id =  $this->input->post('availability_status_id');   
            $where = '';
            $this->data['accession_from'] = '';
            $this->data['issued_date']       = $this->input->post('issued_date');
            $this->data['due_date']         = $this->input->post('due_date');
            $this->data['availability_status_id'] = '';
            if(!empty($accession_from)):
                $where['lib_book_code.accession_number'] = $accession_from;
                $this->data['accession_from'] = $accession_from;
            endif;
            if(!empty($issued_date)):
                $where['issued_date'] = $issued_date;
                $this->data['issued_date'] =$issued_date;
            endif;
            if(!empty($due_date)):
                $where['due_date'] = $due_date;
                $this->data['due_date'] =$due_date;
            endif;
            if(!empty($availability_status_id)):
                $where['lib_book_availability_status.availability_status_id'] = $availability_status_id;
                $this->data['availability_status_id'] =$availability_status_id;
            endif;
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Library Transaction Report');
                $this->excel->getActiveSheet()->setCellValue('A1', 'Accession No');          
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1','Book Title');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                           
                $this->excel->getActiveSheet()->setCellValue('C1', 'Book Status');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Student Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1','College No');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('F1','Issued Date');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('G1','Due Date');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
    
            for($col = ord('A'); $col <= ord('G'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);               
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        $rs = $this->data['books'] = $this->LibraryModel->transactionReportaxcel('lib_book_code',$this->data['issued_date'],$this->data['due_date'],$where);    
        $exceldata="";
        foreach ($rs as $row)
        {
            $exceldata[] = $row;
        }              
        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='LibraryTransactionReport.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output'); 
        
            $this->data['accession_from'] = '';
            $this->data['issued_date']       = $this->input->post('issued_date');
            $this->data['due_date']         = $this->input->post('due_date');
            $this->data['availability_status_id'] = '';
        endif;
        $this->data['page_title']   = 'Library Transaction Report | ECMS';
        $this->data['page']         = 'library/library_transaction_report';
        $this->load->view('common/common',$this->data);
    }
    
    public function auto_books()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('lib_books_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->book_title,
                    'label'=>$row_set->book_title,
                    'id'=>$row_set->book_id
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
            $like   = array('book_title'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('lib_books_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->book_title,
                    'label'=>$row_set->book_title,
                    'id'=>$row_set->book_id
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
    
public function auto_authors()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('lib_authors');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->author_name,
                    'label'=>$row_set->author_name,
                    'id'=>$row_set->author_id
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
            $like   = array('author_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('lib_authors',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->author_name,
                    'label'=>$row_set->author_name,
                    'id'=>$row_set->author_id
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
    
public function auto_publishers()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('lib_publishers');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->pub_name,
                    'label'=>$row_set->pub_name,
                    'id'=>$row_set->pub_id
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
            $like   = array('pub_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('lib_publishers',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->pub_name,
                    'label'=>$row_set->pub_name,
                    'id'=>$row_set->pub_id
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
    
public function auto_supliers()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('lib_supliers');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->sup_name,
                    'label'=>$row_set->sup_name,
                    'id'=>$row_set->sup_id
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
            $like   = array('sup_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('lib_supliers',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->sup_name,
                    'label'=>$row_set->sup_name,
                    'id'=>$row_set->sup_id
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
    
public function auto_subjects()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('lib_book_category');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->subject_name,
                    'label'=>$row_set->subject_name,
                    'id'=>$row_set->subject_id
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
            $like   = array('subject_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('lib_book_category',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->subject_name,
                    'label'=>$row_set->subject_name,
                    'id'=>$row_set->subject_id
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
    
  public function update_book_copy($id)
        {   
        $id = $this->uri->segment(3);
        $book_id = $this->uri->segment(4);
        if($this->input->post()):
                $availability_status_id = $this->input->post('availability_status_id');
                $status_remarks = $this->input->post('status_remarks');
                $data = array
                (
                    'book_availablity_status_id'=>$availability_status_id,
                    'status_remarks'=>$status_remarks
                );
            $where = array('serial_no'=>$id);
            $this->CRUDModel->update('lib_book_code',$data, $where);
            redirect('LibraryController/books_record');
        endif;
        if($id):
                $where = array('lib_book_code.serial_no'=>$id);
                $this->data['books'] = $this->LibraryModel->get_book_copy('lib_book_code',$where);
                $this->data['page_title']        = 'Update Book Copy | ECMS';
                $this->data['page']        =  'library/update_book_copy';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
        }
    
    public function delete_book_copy()
        {
            $id         = $this->uri->segment(3);
            $book_id         = $this->uri->segment(4);
            $where      = array('serial_no'=>$id);
            $wherebookid      = array('book_id'=>$book_id);
            $this->CRUDModel->deleteid('lib_book_code',$where);
            $res =  $this->LibraryModel->get_where_book('lib_books_record', $wherebookid);
            // echo '<pre>';print_r($res);die;
            $book_copies = $res->book_copies;
            $total_copy = $book_copies-1;
            $data = array
                (
                    'book_copies'=>$total_copy
                );
            $where2 = array('book_id'=>$book_id);
            $this->LibraryModel->update('lib_books_record',$data, $where2);
            redirect('LibraryController/books_record');
        }
    
    public function report(){
           if($this->input->post()):
                $this->data['accession_from']       = $this->input->post('accession_from');
                $this->data['accession_to']         = $this->input->post('accession_to');
                
               $this->data['book_accession'] = $this->LibraryModel->search_accession('lib_book_code',$this->data['accession_from'], $this->data['accession_to']);
            endif;
        
            $this->data['page']         = "library/report";
            $this->data['title']        = 'Library Report | ECMS';
            $this->load->view('common/common',$this->data);
    }
    
    public function book_identity_print()
    {
           if($this->input->post()):
                $this->data['accession_from']       = $this->input->post('accession_from');
                $this->data['accession_to']         = $this->input->post('accession_to');
                
               $this->data['book_accession'] = $this->LibraryModel->search_accession('lib_book_code',$this->data['accession_from'], $this->data['accession_to']);
            endif;
        
            $this->data['page']         = "library/book_identity_print";
            $this->data['title']        = 'Book Identity Print | ECMS';
            $this->load->view('common/common',$this->data);
    }
    
    public function auto_accession_number()
     { 
        $term = trim(strip_tags($_GET['term']));
            if( $term == ''){
            $result_set             = $this->CRUDModel->getResults('lib_book_code');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->accession_number,
                    'label'=>$row_set->accession_number,
                    'id'=>$row_set->accession_number
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
            $like   = array('accession_number'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('lib_book_code',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->accession_number,
                    'label'=>$row_set->accession_number,
                    'id'=>$row_set->accession_number
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
    
    public function auto_old_accession(){ 
        $term = trim(strip_tags($_GET['term']));
            if( $term == ''){
            $result_set             = $this->LibraryModel->getOldAccession();
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->old_accession_number,
                    'label'=>$row_set->old_accession_number,
                    'id'=>$row_set->old_accession_number
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
            $like   = array('old_accession_number'=>$term);
            
            $result_set             = $this->LibraryModel->getOldAccession($term);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->old_accession_number,
                    'label'=>$row_set->old_accession_number,
                    'id'=>$row_set->old_accession_number
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
    
    public function update_ex(){
        
        $result = $this->db->where('barcode_image','')->get('lib_book_code')->result();
//       echo '<pre>';print_r($result);die;
        
        foreach($result as $row):
                $data =  array('barcode_image'=>$this->barcode($row->accession_number));
                $where = array('serial_no'=>$row->serial_no);
             $this->CRUDModel->update('lib_book_code',$data, $where);
        endforeach;
    }
    
    public function staff_book_issuance()
    {
        if($this->input->post()):
            $emp_id   =  $this->input->post('emp_id');     
            $issuance_date =  $this->input->post('issuance_date');  
            $where = '';
            $like = '';
            $this->data['emp_id'] = '';    
            $this->data['issuance_date'] = '';
        
            if(!empty($emp_id)):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] =$emp_id;
            endif;
            if(!empty($issuance_date)):
                $where['lib_staff_book_issuance.issued_date'] = $issuance_date;
                $this->data['issuance_date'] =$issuance_date;
            endif;
        $this->data['books'] = $this->LibraryModel->getStaff_Books('lib_staff_book_issuance',$where);
        else:
        $this->data['books'] = $this->LibraryModel->getStaffBooksIssuance();
        endif;
        $this->data['page_title']   = 'Staff Book Issuance List | ECMS';
        $this->data['page']         = 'library/staff_books_issuance';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_staff_book_issuance()
    {
        $this->data['page_title']   = 'Add Staff Issuance Book | ECMS';
        $this->data['page']         = 'library/add_staff_book_issuance';
        $this->load->view('common/common',$this->data);  
    }
    
    public function add_staff_issuance_book()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $book_id   = $this->input->post('book_id');
            $accession_no  = $this->input->post('accession_no');
            $form_Code  = $this->input->post('form_Code');
        
            
            $check_std = $this->CRUDModel->get_wherein_row_order('lib_book_issuance_details', array('accession_no'=>$accession_no), 'availablity_status_id', array(1,3,4,6), 'serial_no', 'desc');
            $check_stf = $this->CRUDModel->get_wherein_row_order('lib_book_staff_issuance_details', array('accession_no'=>$accession_no), 'availablity_status_id', array(1,3,4,6), 'serial_no', 'desc');
            if(empty($check_std) && empty($check_stf)):
            
            $msg ='';
            $checked = array(
                'book_id' => $book_id,
                'accession_no' =>$accession_no,
                );
                 $qry = $this->CRUDModel->get_where_row('lib_book_staff_issuance_details_demo',$checked);
                    if($qry):
                         $msg = '<p style="color:red">Sorry! This Book Already Exist in List..<p/>'; 
                        else:  
                        $data  = array(
                            'book_id' => $book_id,
                            'accession_no' =>$accession_no,
                            'form_Code' =>$form_Code,
                            'date' => date('Y-m-d'),
                            'user_id' => $user_id
                            );
                        $this->CRUDModel->insert('lib_book_staff_issuance_details_demo',$data);
                    endif; 
                    
            else:
                
                $this->db->join('lib_book_issuance', 'lib_book_issuance.issuance_id=lib_book_issuance_details.issuance_id');
                    $this->db->join('student_record', 'student_record.student_id=lib_book_issuance.student_id');
                    $this->db->join('sub_programes', 'sub_programes.sub_pro_id=student_record.sub_pro_id');
                    $this->db->SELECT('
                        student_record.college_no,
                        student_record.student_name,
                        lib_book_issuance.issued_date,
                        lib_book_issuance_details.availablity_status_id,
                        sub_programes.name,
                    ');
                    $this->db->order_by('serial_no', 'desc');
                    $get_std_iss = $this->db->get_where('lib_book_issuance_details', array('accession_no'=>$accession_no))->row();
                    if(!empty($get_std_iss)):
                        if($get_std_iss->availablity_status_id == '1'):
                            echo '<div class="col-md-12">
                                <p style="color:#d00;">This book is already issued.</p>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display">
                                    <tr>
                                        <th>College No</th>
                                        <th>Student Nama</th>
                                        <th>Program</th>
                                        <th>Issued Date No</th>
                                    </tr>
                                    <tr>
                                        <td>'.$get_std_iss->college_no.'</td>
                                        <td>'.$get_std_iss->student_name.'</td>
                                        <td>'.$get_std_iss->name.'</td>
                                        <td>'.date('d-m-Y', strtotime($get_stf_iss->issued_date)).'</td>
                                    </tr>
                                </table>
                            </div>';
                        else:
                            $bk_status = $this->CRUDModel->get_where_row('lib_book_availability_status', array('availability_status_id'=> $get_std_iss->availablity_status_id));
                            echo '<div class="col-md-12">
                                <p style="color:#d00;">This book is '.$bk_status->title.'.</p>
                            </div>';
                        endif;
                    endif;
                        
                    
                    $this->db->join('lib_staff_book_issuance', 'lib_staff_book_issuance.iss_id=lib_book_staff_issuance_details.iss_id');
                    $this->db->join('hr_emp_record', 'hr_emp_record.emp_id=lib_staff_book_issuance.emp_id');
                    $this->db->join('department', 'department.department_id=hr_emp_record.department_id');
                    $this->db->SELECT('
                        hr_emp_record.emp_name,
                        lib_staff_book_issuance.issued_date,
                        lib_book_staff_issuance_details.availablity_status_id,
                        department.title,
                    ');
                    $this->db->order_by('serial_no', 'desc');
                    $get_stf_iss = $this->db->get_where('lib_book_staff_issuance_details', array('accession_no'=>$accession_no))->row();
                    if(!empty($get_stf_iss)):
                        if($get_stf_iss->availablity_status_id == '1'):
                            echo '<div class="col-md-12">
                                <p style="color:#d00;">This book is already issued.</p>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display">
                                    <tr>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Issued Date</th>
                                    </tr>
                                    <tr>
                                        <td>'.$get_stf_iss->emp_name.'</td>
                                        <td>'.$get_stf_iss->title.'</td>
                                        <td>'.date('d-m-Y', strtotime($get_stf_iss->issued_date)).'</td>
                                    </tr>
                                </table>
                            </div>';
                        else:
                            $bk_status = $this->CRUDModel->get_where_row('lib_book_availability_status', array('availability_status_id'=> $get_stf_iss->availablity_status_id));
                            echo '<div class="col-md-12">
                                <p style="color:#d00;">This book is '.$bk_status->title.'.</p>
                            </div>';
                        endif;
                    endif;
                
            endif;        
                    
                    
    $where = array('form_Code' =>$form_Code,'date' => date('Y-m-d'),'lib_book_staff_issuance_details_demo.user_id' => $user_id);        
    $result = $this->LibraryModel->getstaffbooks_issuance($where);    
    if($result):
    echo $msg;    
        echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Accesson Number</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';        
                        foreach($result as $eRow):
                        echo '<tr id="'.$eRow->serial_no.'Delete">
                                <td>'.$eRow->book_title.'</td>
                                <td>'.$eRow->accession_no.'</td>                          
                                <td><a href="javascript:void(0)" id="'.$eRow->serial_no.'" class="deleteIssu"><i class="fa fa-trash"></i></a></td>                          
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        endif;
    ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deleteIssu').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'LibraryController/delete_staffissu_book',
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
    
    public function delete_staffissu_book()
    {
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('lib_book_staff_issuance_details_demo',array('serial_no'=>$deletId));
   }
    
    public function update_staff_books_status()
    {
        $session        = $this->session->all_userdata();
        $user_id        = $session['userData']['user_id'];
        $student_id = $this->uri->segment(3);
        if($this->input->post()):
                $availability_status_id = $this->input->post('availability_status_id');
                $emp_id = $this->input->post('emp_id');
                $return_date = $this->input->post('return_date');
                $date1 = date('Y-m-d', strtotime($return_date));
                $accession_no = $this->input->post('accession_no');
                $ides       = $this->input->post('checked');
        if(!empty($ides)):      
            foreach($ides as $row=>$value):
                $data =  array('book_availablity_status_id'=>$availability_status_id);
                $where = array('accession_number'=>$value);
                $this->CRUDModel->update('lib_book_code',$data,$where);
                $data1 =  array('availablity_status_id'=>$availability_status_id,'flag'=>1);
                $where1 = array('accession_no'=>$value);
                $this->LibraryModel->updateIssuanceBook('lib_book_staff_issuance_details',$data1,$where1);
                $q = $this->CRUDModel->get_where_row('lib_book_code',$where);
                $insData = array(
                    'emp_id' => $emp_id,
                    'book_id' =>$q->book_id,
                    'accession_no'=>$value,
                    'date'=>date('Y-m-d'),
                    'user_id'=>$user_id
                            );
                $this->CRUDModel->insert('lib_book_staff_received_books',$insData);
            endforeach;   
         endif;   
        redirect('LibraryController/staff_book_issuance');
        endif;
        $emp_id = $this->uri->segment(3);
        $where = array('emp_id'=>$emp_id);
        $wheredata = array('lib_staff_book_issuance.emp_id'=>$emp_id);
        $this->data['emp_data'] = $this->LibraryModel->getStaffData('hr_emp_record', $where);
        $this->data['result'] = $this->LibraryModel->return_staffBooks_details('lib_staff_book_issuance',$wheredata);
        $this->data['page_title']   = 'Update Staff Books Issuance Status | ECMS';
        $this->data['page']         = 'library/update_staff_book_status';
        $this->load->view('common/common',$this->data); 
    }
    
public function get_Studentsbook_issued(){
           $student_id = $this->input->post('student_id');
            $where = array('student_id'=>$student_id);
            $result = $this->LibraryModel->issuance_Books_details('lib_book_issuance',$where);
            if($result):
        echo '<table class="table table-striped table-bordered">
                    <thead>
                          <tr>
                            <th>S#</th>
                            <th>Book Title</th>
                            <th>Acc#</th>
                            <th>Issued Date</th>
                            <th>Due Date</th>
                            <th>Over Due Book</th>
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
                
                $earlier = new DateTime($urRow->due_date);
                $later = new DateTime(date("Y-m-d"));
                $abs_diff = $later->diff($earlier)->format("%a"); //3die;
                $fine = $abs_diff*5;
                    
             $sn++;    
             echo '<tr>
                    <td>'.$sn.'</td>
                    <td>'.$urRow->book_title.'</td>
                    <td>'.$urRow->accession_no.'</td>
                    <td>'.$issuedDate.'</td>
                    <td>'.$dueDate.'</td>
                    <td>';
                        if($fine != 0):
                            echo "<strong style='color:red'>".$abs_diff." Days ("."Rs.".$fine. ")</strong>";
                        else: 
                            echo '';
                        endif; 
                echo '</td>';
                    echo '</tr>';    
            endforeach;
                echo '</tbody>
              </table>';
            else:
                 echo '<strong style="color:red;font-size:20px;">Sorry, Record not Found..!</strong>';
            endif;   
        } 
    
    public function get_Staffbook_issued(){
           $emp_id = $this->input->post('emp_id');
            $where = array('emp_id'=>$emp_id);
            $result = $this->LibraryModel->staffissuance_Books_details('lib_staff_book_issuance',$where);
            if($result):
        echo '<table class="table table-striped table-bordered">
                    <thead>
                          <tr>
                            <th>S#</th>
                            <th>Book Title</th>
                            <th>Acc#</th>
                            <th>Issued Date</th>
                            <th>Due Date</th>
                            <th>Fine</th>
                          </tr>
                    </thead>
                <tbody>';
            $sn = '';
             foreach($result as $urRow):  
                $issued_date = $urRow->issued_date; 
                $issuedDate = date("d-m-Y", strtotime($issued_date));
                
                $sn++;    
                echo '<tr>
                       <td>'.$sn.'</td>
                       <td>'.$urRow->book_title.'</td>
                       <td>'.$urRow->accession_no.'</td>
                       <td>'.$issuedDate.'</td>
                       <td>'.date("d-m-Y", strtotime($urRow->due_date)).'</td>
                       <td>';
                       $earlier = new DateTime($urRow->due_date);
                       $later = new DateTime(date("Y-m-d"));
                       $abs_diff = $later->diff($earlier)->format("%a"); //3die;
                       $fine = $abs_diff*5;
                       echo '<strong style="color:red">'.$abs_diff.' days (Rs.'.$fine. ')</strong>';
                       echo '</td>';
                   echo '</tr>';    
               endforeach;
                echo '</tbody>
              </table>';
            else:
                 echo '<strong style="color:red;font-size:20px;">Sorry, Record not Found..!</strong>';
            endif;   
        }
    
    public function insert_staff_books_issuance()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('submit_item')):  
           $emp_id   = $this->input->post('emp_id');   
           $dept_id   = $this->input->post('department_id');   
           $issued_date   = $this->input->post('issuance_date'); 
           $due_date   = $this->input->post('due_date'); 
           $form_Code  = $this->input->post('form_Code');
            $where = array('emp_id'=>$emp_id);
           $q = $this->LibraryModel->getEmpData('hr_emp_record',$where);
           $std_data = $q->emp_name. ', '.$q->designation. ', ' . $q->department;
           // echo '<pre>';print_r($std_data);die;
           // $dd = 'Irfan Ullah Dilawar Said College Number 16439';
           $this->RQ($std_data,'assets/RQ/library_rq/emp_rq/');
           $data1 = array(
                'emp_id' => $emp_id,
                'dept_id' => $dept_id,
                'issued_date' =>$issued_date,
                'due_date' =>$due_date,
                'rq_image' =>$std_data.'.png',
                'user_id' =>$user_id,
            );
            $id = $this->CRUDModel->insert('lib_staff_book_issuance',$data1);
            $where = array(
            'user_id'=>$user_id,
            'form_Code'=>$form_Code,
            'date' => date('Y-m-d')    
                ); 
       $res =  $this->CRUDModel->get_where_result('lib_book_staff_issuance_details_demo', $where);
       foreach($res as $isRow):
        $data = array(   
            'book_id'     =>$isRow->book_id,
            'iss_id' =>$id,
            'accession_no'=>$isRow->accession_no,
            'availablity_status_id' =>1,
            'form_Code'   =>$isRow->form_Code,
            'date'        =>$isRow->date,
            'user_id'     =>$isRow->user_id,
          );
        $this->CRUDModel->insert('lib_book_staff_issuance_details',$data);
        $where = array('book_id'=>$isRow->book_id, 'accession_number'=>$isRow->accession_no);
        $book_data = array
            (
                'book_availablity_status_id'=>1
            );
            $this->CRUDModel->update('lib_book_code',$book_data, $where);
        
           $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('lib_book_staff_issuance_details_demo',$whereDelete);
        endforeach; 
            redirect('LibraryController/staff_book_issuance');
            endif;
    }
    
    public function staff_books_issuance_print()
    {
        $emp_id = $this->uri->segment(3);
        $where = array('emp_id'=>$emp_id);
        $wheredata = array('lib_staff_book_issuance.emp_id'=>$emp_id);
        $this->data['comnts'] = $this->LibraryModel->staffCommnts('lib_staff_comments',$where);
        $this->data['emp_data'] = $this->LibraryModel->getStaffData('hr_emp_record',$where);
        $this->data['std_rq'] = $this->CRUDModel->get_where_row('lib_staff_book_issuance',$wheredata);
        $this->data['result'] = $this->LibraryModel->staffissuance_Books_details('lib_staff_book_issuance',$wheredata);
        $this->data['page_title']   = 'Staff Print Books Issuance | ECMS';
        $this->data['page']         = 'library/staff_books_issuance_print';
        $this->load->view('common/common',$this->data); 
    }
    
       public function update_staff_books()
    {
        $emp_id = $this->uri->segment(3);
        $where = array('lib_staff_book_issuance.emp_id'=>$emp_id);
        $this->data['result'] = $this->LibraryModel->updateStaffBooksIssuance('lib_staff_book_issuance',$where);
        $this->data['page_title']   = 'Update Staff Books | ECMS';
        $this->data['page']         = 'library/update_staff_books';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_staff_comment()
    {     
        $id = $this->uri->segment(3);
        if($this->input->post()): 
           $emp_id =  $this->input->post('emp_id');  
           $comments =  $this->input->post('comments');  
           $data = array(
           'emp_id'=>$emp_id,
           'comments'=>$comments,
            'date'=>date('Y-m-d')
           ); 
        $this->CRUDModel->insert('lib_staff_comments',$data);
        redirect('LibraryController/add_staff_comment/'.$id);
        endif;
        if($id):
    $this->data['result']=$this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$id));
    $this->data['commts']=$this->CRUDModel->get_where_result('lib_staff_comments',array('emp_id'=>$id));
        endif;
        $this->data['page_title']   = 'Add Comment | ECMS';
        $this->data['page']         = 'library/add_staff_comment';
        $this->load->view('common/common',$this->data);
    }
    
    public function get_staffisuedBooks()
    {    
            $iss_id = $this->input->post('iss_id');
            $class = explode(',',$iss_id);
            
                $where = array(
                   'iss_id'=>$class[0], 
                 );
            $result = $this->LibraryModel->staff_issuanceRow('lib_staff_book_issuance',$where);
            if($result):
            echo '<form class="form-horizontal row-fluid" method="post" action="LibraryController/update_staffRow/'.$class[0].'/'.$class[1].'">
                <div class="control-group">
                        <label class="control-label" for="basicinput">Employee Name</label>
                        <div class="controls">
                        <select name="emp_id" class=" form-control span6 tip">
                                <option value="'.$result->emp_id.'">'.$result->emp_name.'</option>
                                <option>Select Employee</option>';
        $d = $this->CRUDModel->getResults('hr_emp_record');
        foreach($d as $rec):
        echo '<option value="'.$rec->emp_id.'">'.$rec->emp_name.'</option>';
        endforeach;
        echo '</select>                          
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Issued Date</label>
                        <div class="controls">
                        <input name="issued_date" type="date" value="'.$result->issued_date.'" class="form-control span6 tip">    
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" value="Update" class="btn btn-primary pull-center">
                        </div>
                    </div>
                </form>';
            endif;
        }
    
    public function update_staffRow($iss_id,$emp_id)
    {
        $where = array('iss_id'=>$iss_id);
        $upd_data = array(
        'emp_id' => $this->input->post('emp_id'),
        'issued_date' => $this->input->post('issued_date')
        );
        $this->CRUDModel->update('lib_staff_book_issuance',$upd_data,$where);
        redirect('LibraryController/update_staff_books/'.$emp_id);
    }
   
    
   public function auto_emp_data()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->LibraryModel->getemp_data('hr_emp_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->emp_name.'('.$row_set->designation.', '.$row_set->contract.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.', '.$row_set->contract.')',
                    'id'=>$row_set->emp_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('emp_name'=>$term);
            
            $result_set             = $this->LibraryModel->getemp_data('hr_emp_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->emp_name.'('.$row_set->designation.', '.$row_set->contract.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.', '.$row_set->contract.')',
                    'id'=>$row_set->emp_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['emp_id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function book_issuance_report(){
        
        $this->data['page']         = "library/book_issuance_report";
        $this->data['ReportName']   = "Book Record";
        $this->data['title']        = 'Library Books Record Limit | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    public function search_book_issuance_report(){
        
        $from   = date('Y-m-d', strtotime($this->input->post('from_date')));
        $to     = date('Y-m-d', strtotime($this->input->post('to_date')));
        $subj   = $this->input->post('subject');
        
        $like   = '';
        $where  = array('lib_book_staff_issuance_details.availablity_status_id' => 1);
        $where1 = array('lib_book_issuance_details.availablity_status_id' => 1);
        
        if(!empty($subj)):
            $like['lib_books_record.subject_name'] = $subj;
//            $like['lib_books_record.sub_subject_name'] = $subj;
        endif;
        
        $result_staff   = $this->LibraryModel->get_all_issuance_staff('lib_staff_book_issuance', $where, $like, $from, $to);
        $result_student = $this->LibraryModel->get_all_issuance_student('lib_book_issuance', $where1, $like, $from, $to);
        $total = count($result_staff) + count($result_student);
//        echo '<pre>'; print_r($result_student); die;
        echo '<div class="col-md-12" style="margin-bottom: 15px;">
            <button type="button" class="btn btn-success" id="" >Total Book Records: '.$total.'</button> 
            <button type="button" class="btn btn-success" id="" >Staff: '.count($result_staff).'</button> 
            <button type="button" class="btn btn-success" id="" >Students: '.count($result_student).'</button> 
        </div>';
        if($result_staff):
            $sno = '';
            echo '<hr><h3 align="center">List of Books Issued to Staff</h3>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th style="vertical-align: middle;">S #</th>
                        <th style="vertical-align: middle;">Employee Name</th>
                        <th style="vertical-align: middle;">Department</th>
                        <th style="vertical-align: middle;" >Emp Status</th>
                        <th style="vertical-align: middle;" >Book Name</th>
                        <th style="vertical-align: middle;" >Subject</th>
                        <th style="vertical-align: middle;" >Accs #</th>
                        <th style="vertical-align: middle;" >Status</th>
                        <th style="vertical-align: middle;" >Issued on</th>
                        <th style="vertical-align: middle;" >Due Date</th>
                        <th style="vertical-align: middle;" >Fine</th>
                    </tr>
                </thead>
                <tbody>';
            
                foreach($result_staff as $e_row):
                    $sno++;
                    echo '<tr>
                        <td>'.$sno.'</td>
                        <td>'.$e_row->emp_name.'</td>
                        <td>'.$e_row->deptt_title.'</td>
                        <td>'.$e_row->emp_status.'</td>
                        <td>'.$e_row->book_title.'</td>
                        <td>';
                            echo $e_row->subject_name;
                            if(!empty($e_row->sub_subject_name)): echo ' ('.$e_row->sub_subject_name.')'; endif;
                        echo '</td>
                        <td>'.$e_row->accession_no.'</td>
                        <td>'.$e_row->status_title.'</td>
                        <td>';
                            if($e_row->issued_date != '0000-00-00'): echo date('d-m-Y', strtotime($e_row->issued_date)); endif;
                        echo '</td>
                        <td>';
                            if($e_row->due_date != '0000-00-00'): echo date('d-m-Y', strtotime($e_row->due_date)); endif;
                        echo '</td>
                        <td>';
                            $ttl_fine = 0;
                            $earlier = new DateTime($e_row->due_date);
                            $later = new DateTime(date("Y-m-d"));
                            $abs_diff = $later->diff($earlier)->format("%a"); //3die;
                            $fine = $abs_diff*5;
                            $ttl_fine += $fine;
                            echo '<strong style="color:red">'.$abs_diff.' days (Rs.'.$fine. ')</strong>';
                        echo '</td>
                    </tr>';
                endforeach;
                echo '</tbody>
            </table>';
        endif;
        
        if($result_student):
            $so = '';
            echo '<hr><h3 align="center">List of Books Issued to Students</h3>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th style="vertical-align: middle;" >S #</th>
                        <th style="vertical-align: middle;" >Student Name</th>
                        <th style="vertical-align: middle;" >Clg #</th>
                        <th style="vertical-align: middle;">Section</th>
                        <th style="vertical-align: middle;">Std Status</th>
                        <th style="vertical-align: middle;" >Book Name</th>
                        <th style="vertical-align: middle;" >Subject</th>
                        <th style="vertical-align: middle;" >Accs #</th>
                        <th style="vertical-align: middle;" >Status</th>
                        <th style="vertical-align: middle;" >Issued on</th>
                        <th style="vertical-align: middle;" >Due Date</th>
                        <th style="vertical-align: middle;" >Fine</th>
                    </tr>
                </thead>
                <tbody>';
            
                foreach($result_student as $s_row):
                    $so++;
                    echo '<tr>
                        <td>'.$so.'</td>
                        <td>'.$s_row->student_name.'</td>
                        <td>'.$s_row->college_no.'</td>
                        <td>'.$s_row->section_name.'</td>
                        <td>'.$s_row->student_status.'</td>
                        <td>'.$s_row->book_title.'</td>
                        <td>';
                            echo $s_row->subject_name;
                            if(!empty($s_row->sub_subject_name)): echo ' ('.$s_row->sub_subject_name.')'; endif;
                        echo '</td>
                        <td>'.$s_row->accession_no.'</td>
                        <td>'.$s_row->status_title.'</td>
                        <td>';
                            if($s_row->issued_date != '0000-00-00'): echo date('d-m-Y', strtotime($s_row->issued_date)); endif;
                        echo '</td>
                        <td>';
                            if($s_row->due_date != '0000-00-00'): echo date('d-m-Y', strtotime($s_row->due_date)); endif;
                        echo '</td>
                        <td>';
                            $ttl_fine = 0;
                            $earlier = new DateTime($s_row->due_date);
                            $later = new DateTime(date("Y-m-d"));
                            $abs_diff = $later->diff($earlier)->format("%a"); //3die;
                            $fine = $abs_diff*5;
                            $ttl_fine += $fine;
                            echo '<strong style="color:red">'.$abs_diff.' days (Rs.'.$fine. ')</strong>';
                        echo '</td>
                    </tr>';
                endforeach;
                echo '</tbody>
            </table>';
        endif;
        
    }
     public function book_category(){ 
        $term = trim(strip_tags($_GET['term']));
            if( $term == ''){
            $result_set             = $this->db->get_where('lib_book_category')->result();
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->subject_name,
                    'label'=>$row_set->subject_name,
                    'id'=>$row_set->subject_id
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
            
                                      $this->db->like('subject_name',$term);  
            $result_set             = $this->db->get_where('lib_book_category')->result();
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                    'value'=>$row_set->subject_name,
                    'label'=>$row_set->subject_name,
                    'id'=>$row_set->subject_id
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
     public function book_category_setup(){
        $this->data['category_name']    = '';
        $this->data['results']          = $this->CRUDModel->get_where_result_order('lib_book_category',array('book_cat_status'=>1),array('order'=>'desc','column'=>'subject_id'));
        
        if($this->input->post('save')):
        $category_name  = $this->input->post('category_name');
        $check          = $this->CRUDModel->get_where_row('lib_book_category',array('subject_name'=>$category_name));
        if(empty($check)):
            $this->CRUDModel->insert('lib_book_category',array('subject_name'=>$category_name));
        endif;
            redirect('BookCategorySetup','refresh');
        endif;
        if($this->input->post('search')):
            
                                     $this->db->like(array('subject_name'=>$this->input->post('category_name')));
         $this->data['results'] =    $this->db->get('lib_book_category')->result();
          $this->data['category_name']    =  $this->input->post('category_name');
        endif;
        if($this->input->post('UpdateCategory')):
             
            $this->CRUDModel->update('lib_book_category',array('subject_name'=>$this->input->post('category_name')),array('subject_id'=>$this->input->post('category_id')));
            redirect('BookCategorySetup','refresh');
        endif;
      
        
        $this->data['page_header']   = 'Book Categories ';
        $this->data['page_title']   = 'Book Categories | ECMS';
        $this->data['page']         = 'library/library_setups/book_category_v';
        $this->load->view('common/common',$this->data);
    }
    
    public function book_category_get_record(){
        if($this->input->post('getRecord')):
                $check = $this->CRUDModel->get_where_row('lib_book_category',array('subject_id'=>$this->input->post('subjId'))); 
        
                echo form_open('BookCategorySetup',array('class'=>'course-finder-form','id'=>'print_wise_formxtz'));
                echo '  <div class="modal-body">
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-6 col-sm-5">
                                        <label for="name">Category Name</label>';
                                        echo '<input type="text"  name="category_name" value="'.$check->subject_name.'" id="category_nameup" class="form-control" required="required" placeholder="Category Name">';
                                        echo '<input type="text"  name="category_id"   value="'.$check->subject_id.'"   id="category_idup"   class="form-control">';
                
                            echo '  </div>
                                </div>
                            </div>
                        </div>';
                echo ' <div class="modal-footer">
                            <button type="submit" name="UpdateCategory" value="UpdateCategory" id="UpdateCategory" class="btn btn-theme" >update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>';
                
               
            
                echo form_close();
            
        endif;
    }
    
    
}   