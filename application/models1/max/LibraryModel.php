<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class LibraryModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    
    public function get_by_id($table,$id){
        $query = $this->db->select('*')
            ->from($table)
            ->where($id)
            ->get();
      return $query->result();
    }
    
    public function std_sec_allotment($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
            $this->db->like('college_no',$like);       
        endif;   
        $this->db->where('s_status_id',5);
        
        $this->db->where('flag',0);
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getStudentsall($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):  
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id !=','1');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function  search_accession_limit($table,$accession_from=NULL,$accession_to=NULL,$old_accession=NULL, $old_accessionto=NULL){

       $this->db->select('*');
       $this->db->from($table);
       $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id', 'left outer');
       $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id', 'left outer');
        if($accession_from !="" && $accession_to !=""):
           $this->db->where('accession_number BETWEEN "'.$accession_from.'" and "'.$accession_to.'"');
                   endif;
        if($old_accession !="" && $old_accessionto !=""):
           $this->db->where('old_accession_number BETWEEN "'.$old_accession.'" and "'.$old_accessionto.'"');
                   endif;
        return $this->db->get()->result();
      
   }
    
    public function getOldAccession($like=NULL){

       $this->db->select('old_accession_number');
       if($like):
            $this->db->like('old_accession_number',$like);   
        endif;    
       $this->db->where('old_accession_number !=','0');    
       $this->db->order_by('old_accession_number','asc');    
        return $this->db->get('lib_book_code')->result();
   }
    
    public function getStaff_Books($table,$where=NULL)
    {
        $this->db->select('
            lib_staff_book_issuance.*,
            hr_emp_record.emp_name,
            hr_emp_record.picture,
            department.title as department,
            hr_emp_designation.title as designation,
            hr_emp_contract_type.title as contract,
            hr_emp_status.title as employ_status, 
        '); 
        $this->db->FROM('lib_staff_book_issuance');
        $this->db->join('lib_book_staff_issuance_details','lib_book_staff_issuance_details.iss_id=lib_staff_book_issuance.iss_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=lib_staff_book_issuance.emp_id','left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id','left outer');
        $this->db->where('lib_book_staff_issuance_details.availablity_status_id','1');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->group_by('hr_emp_record.emp_id');
        $this->db->order_by('hr_emp_record.emp_name');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getemp_data($table,$like=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as emp_name,
        hr_emp_designation.title as designation,
        hr_emp_contract_type.title as contract,
       '); 
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer');
        if($like):
        $this->db->like($like);
        endif;
        $query =  $this->db->get($table);
        if($query):
            return $query->result();
        endif;
    } 
    
    public function getDept_Books($table,$where=NULL)
    {
        $this->db->select('lib_dept_books_issuance.*,department.title as department,hr_emp_record.emp_name'); 
        $this->db->FROM('lib_dept_books_issuance');
        $this->db->join('department','department.department_id=lib_dept_books_issuance.dept_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=lib_dept_books_issuance.emp_id','left outer');
        $this->db->join('lib_dept_books_issuance_details','lib_dept_books_issuance_details.dept_iss_id=lib_dept_books_issuance.dept_iss_id','left outer');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_dept_books_issuance_details.book_id','left outer');
        $this->db->join('lib_book_code','lib_book_code.book_id=lib_books_record.book_id','left outer');
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id','left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->group_by('department.department_id');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function deptBooksIssuance($table,$where=NULL)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
    $this->db->join('department','department.department_id=lib_dept_books_issuance.dept_id','left outer');
    $this->db->join('lib_dept_books_issuance_details','lib_dept_books_issuance_details.dept_iss_id=lib_dept_books_issuance.dept_iss_id','left outer');
    $this->db->join('lib_books_record','lib_books_record.book_id=lib_dept_books_issuance_details.book_id','left outer');
        $this->db->join('lib_book_code','lib_book_code.book_id=lib_books_record.book_id','left outer');
$this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id','left outer');
        $this->db->group_by('department.department_id');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getdeptBooksIssuance()
    {
        $this->db->select('lib_dept_books_issuance.*,department.title as department,hr_emp_record.emp_name'); 
        $this->db->FROM('lib_dept_books_issuance');
        $this->db->join('department','department.department_id=lib_dept_books_issuance.dept_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=lib_dept_books_issuance.emp_id','left outer');
        $this->db->join('lib_dept_books_issuance_details','lib_dept_books_issuance_details.dept_iss_id=lib_dept_books_issuance.dept_iss_id','left outer');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_dept_books_issuance_details.book_id','left outer');
        $this->db->join('lib_book_code','lib_book_code.book_id=lib_books_record.book_id','left outer');
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id','left outer');
        $this->db->group_by('department.department_id');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
   
    public function getdeptbooks_issuance($where)
    {
        $this->db->select('*'); 
        $this->db->FROM('lib_dept_books_issuance_details_demo');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_dept_books_issuance_details_demo.book_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function deptissuance_Books_details($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('lib_dept_books_issuance_details','lib_dept_books_issuance_details.dept_iss_id=lib_dept_books_issuance.dept_iss_id','left outer');
        $this->db->join('department','department.department_id=lib_dept_books_issuance.dept_id','left outer');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_dept_books_issuance_details.book_id','left outer');
        $this->db->where('lib_dept_books_issuance_details.availablity_status_id','1');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function updateStaffBooksIssuance($table,$where)
    {
        $this->db->select('lib_staff_book_issuance.*,hr_emp_record.emp_name,hr_emp_record.picture,department.title as department,hr_emp_designation.title as designation'); 
        $this->db->FROM($table);
        $this->db->join('lib_book_staff_issuance_details','lib_book_staff_issuance_details.iss_id=lib_staff_book_issuance.iss_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=lib_staff_book_issuance.emp_id','left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->where($where);
        $this->db->where('lib_book_staff_issuance_details.availablity_status_id','1');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function staffCommnts($table,$where){
        $query =$this->db->SELECT('*')
             ->FROM($table)
             ->where($where)
             ->order_by('ecom_id','desc')
             ->limit('1')    
             ->get();
        return $query->row();
   }
    
    public function staff_issuanceRow($table,$where){
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=lib_staff_book_issuance.emp_id', 'left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
   }
    
    public function countBooksRcd($table,$like=NULL,$from_date=NULL,$to_date=NULL)
    {
        $this->db->select('*');
        $this->db->FROM($table);
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id');
        if($like):
            $this->db->like($like);
        endif;
        if($from_date !="" && $to_date !=""):
               $this->db->where('DATE(lib_books_record.timestamp) BETWEEN "'.$from_date.'" and "'.$to_date.'"');
        endif;     
       $query = $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
public function printbooksResults($table,$where=NULL,$like=NULL,$array_return=NULL,$array_retrn=NULL)
    {
        $this->db->SELECT('lib_books_record.dvdecmil,lib_books_record.author_mark,lib_book_code.accession_number,lib_book_code.old_accession_number,lib_book_code.barcode_image');
        $this->db->FROM($table);
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id');
        if($array_return):   
            $this->db->where_in('old_accession_number',$array_return);    
        endif;
        if($array_retrn):   
            $this->db->where_in('accession_number',$array_retrn);    
        endif;
        if($where):
            $this->db->where($where);    
        endif;
        if($like):
            $this->db->like($like);    
        endif;    
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getbookRecord($user_id)
    {
        $this->db->select('*');
        $this->db->FROM('lib_book_code');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id', 'left outer');
        $this->db->join('users','users.id=lib_books_record.user_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->where('lib_books_record.user_id',$user_id);
        $this->db->where('DATE(lib_books_record.timestamp)', date('Y-m-d'));
        $query = $this->db->get();
        return $query->result(); 
    }
    
    public function getBooks_List($where=NULL,$from_date=NULL,$to_date=NULL)
    {
        $this->db->select('*');
        $this->db->FROM('lib_book_code');
         $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id');
        $this->db->join('users','users.id=lib_books_record.user_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($from_date !="" && $to_date !=""):
               $this->db->where('DATE(lib_books_record.timestamp) BETWEEN "'.$from_date.'" and "'.$to_date.'"');
        endif;     
       $query = $this->db->get();
        if($query):
            return $query->result();
        endif;
    }

    
    public function libraryTransactionReport()
    {
        $query =$this->db->SELECT('lib_book_code.*, lib_books_record.book_title, lib_book_issuance_details.accession_no,lib_book_issuance_details.issuance_id,lib_book_availability_status.title,lib_book_issuance.*,student_record.student_name,student_record.college_no')
        ->FROM('lib_book_code')
            ->JOIN('lib_books_record','lib_books_record.book_id=lib_book_code.book_id','left outer')
            ->JOIN('lib_book_issuance_details','lib_book_issuance_details.accession_no=lib_book_code.accession_number','left outer')
    ->JOIN('lib_book_issuance','lib_book_issuance.issuance_id=lib_book_issuance_details.issuance_id','left outer')
    ->JOIN('student_record','student_record.student_id=lib_book_issuance.student_id','left outer')
        ->JOIN('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id','left outer')   
       ->order_by('lib_book_code.serial_no','desc')    
         ->get();
        return $query->result();
   }
    
public function searchTransactionReport($table,$issued_date=NULL,$due_date=NULL,$where)
    {
       $this->db->SELECT('lib_book_code.*, lib_books_record.book_title, lib_book_issuance_details.accession_no,lib_book_issuance_details.issuance_id,lib_book_availability_status.title,lib_book_issuance.*,student_record.student_name,student_record.college_no');
        $this->db->FROM($table);
            $this->db->JOIN('lib_books_record','lib_books_record.book_id=lib_book_code.book_id','left outer');
            $this->db->JOIN('lib_book_issuance_details','lib_book_issuance_details.accession_no=lib_book_code.accession_number','left outer');
    $this->db->JOIN('lib_book_issuance','lib_book_issuance.issuance_id=lib_book_issuance_details.issuance_id','left outer');
    $this->db->JOIN('student_record','student_record.student_id=lib_book_issuance.student_id','left outer');
        $this->db->JOIN('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id','left outer');   
       $this->db->order_by('lib_book_code.serial_no','desc');
        if($where):
            $this->db->where($where);
        endif;
        if($issued_date !="" && $due_date !=""):
           $this->db->where('issued_date BETWEEN "'.$issued_date.'" and "'.$due_date.'"');
        endif;
         $query = $this->db->get();
        return $query->result();
   }
    
    public function transactionReportaxcel($table,$issued_date=NULL,$due_date=NULL,$where)
    {
       $this->db->SELECT('
       lib_book_code.accession_number,
        lib_books_record.book_title,
        lib_book_availability_status.title,
        student_record.student_name,
        student_record.college_no,
        lib_book_issuance.issued_date,
        lib_book_issuance.due_date
       ');
        $this->db->FROM($table);
            $this->db->JOIN('lib_books_record','lib_books_record.book_id=lib_book_code.book_id','left outer');
            $this->db->JOIN('lib_book_issuance_details','lib_book_issuance_details.accession_no=lib_book_code.accession_number','left outer');
    $this->db->JOIN('lib_book_issuance','lib_book_issuance.issuance_id=lib_book_issuance_details.issuance_id','left outer');
    $this->db->JOIN('student_record','student_record.student_id=lib_book_issuance.student_id','left outer');
        $this->db->JOIN('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id','left outer');   
       $this->db->order_by('lib_book_code.serial_no','desc');
        if($where):
            $this->db->where($where);
        endif;
        if($issued_date !="" && $due_date !=""):
           $this->db->where('issued_date BETWEEN "'.$issued_date.'" and "'.$due_date.'"');
        endif;
         $query = $this->db->get();
        return $query->result_array();
   }
    
    public function getBooksIssuance()
    {
        $this->db->select('*'); 
        $this->db->FROM('lib_book_issuance');
        $this->db->join('lib_book_issuance_details','lib_book_issuance_details.issuance_id=lib_book_issuance.issuance_id','left outer');
        $this->db->join('student_record','student_record.student_id=lib_book_issuance.student_id','left outer');
        $this->db->where('lib_book_issuance_details.availablity_status_id','1');
        $this->db->group_by('student_record.student_id');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function searchBooksIssuance($table,$where=NULL)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=lib_book_issuance.student_id','left outer');
    $this->db->join('lib_book_issuance_details','lib_book_issuance_details.issuance_id=lib_book_issuance.issuance_id','left outer');
    $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_issuance_details.book_id','left outer');
        $this->db->join('lib_book_code','lib_book_code.book_id=lib_books_record.book_id','left outer');
$this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id','left outer');
        $this->db->group_by('student_record.student_id');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_Booksissuance($table,$wheredata)
    {
        $this->db->select('
        lib_book_issuance.*,
        student_record.*,
        '); 
        $this->db->FROM($table);
        $this->db->join('student_record','student_record.student_id=lib_book_issuance.student_id','left outer');
        $this->db->where($wheredata);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
     public function issuance_Books_details($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('lib_book_issuance_details','lib_book_issuance_details.issuance_id=lib_book_issuance.issuance_id','left outer');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_issuance_details.book_id','left outer');
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_issuance_details.availablity_status_id','left outer');
        $this->db->where('lib_book_issuance_details.availablity_status_id','1');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_issuanceRecord($table,$wheredata){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
    ->join('student_record','student_record.student_id=lib_book_issuance.student_id','left outer')
                         ->where($wheredata)
                         ->get();
            return $query->row();
   }
    
    public function return_Books_details($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('lib_book_issuance_details','lib_book_issuance_details.issuance_id=lib_book_issuance.issuance_id','left outer');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_issuance_details.book_id','left outer');
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_issuance_details.availablity_status_id','left outer');
        $this->db->where('lib_book_issuance_details.availablity_status_id','1');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function updateIssuanceBook($table,$data1,$where1)
    {
        $this->db->where($where1);
        $this->db->update($table,$data1);
    }
    
    public function updatereturndate($table,$data2,$where2)
    {
        $this->db->where($where2);
        $this->db->update($table,$data2);
    }
    
    public function getbooks_issuance($where)
    {
        $this->db->select('*'); 
        $this->db->FROM('lib_book_issuance_details_demo');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_issuance_details_demo.book_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getBooksaccession($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
$this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id');
        $this->db->where('book_availablity_status_id','5');
        if($like):
            $this->db->like('book_title',$like);    
            $this->db->or_like('accession_number',$like);    
        endif;
         $query = $this->db->get();
        return $query->result();
    }
    
    public function countdemo_books($table,$where)
    {
//        $this->db->select('count(book_id) as totald_books'); 
        $this->db->FROM($table);
//        $this->db->group_by('book_id');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function count_books($table,$where=NULL)
    {
        $this->db->select('count(lib_book_issuance_details.book_id) as total_books'); 
        $this->db->FROM($table);
    $this->db->join('student_record','student_record.student_id=lib_book_issuance.student_id','left outer');
    $this->db->join('lib_book_issuance_details','lib_book_issuance_details.issuance_id=lib_book_issuance.issuance_id','left outer');
        $this->db->group_by('student_record.student_id');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
       public function getStudents($table,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        if($like):
         //   $this->db->like('student_name',$like);    
            $this->db->or_like('college_no',$like);    
        endif; 
        $this->db->where('s_status_id','5');   
         $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getStdData($table,$where){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
    ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
                         ->where($where)
                         ->get();
            return $query->row();
   }
    
    public function getBooks()
    {
     $query = $this->db->select('*')
        ->FROM('lib_books_record')
         ->join('lib_book_language','lib_book_language.lang_id=lib_books_record.language_id', 'left outer')    
    ->join('lib_books_location','lib_books_location.location_id=lib_books_record.location_id', 'left outer')
        ->order_by('book_id','desc')
         ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function searchOldaccession($table,$where=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id');
        if($where):
        $this->db->where($where);    
        endif; 
         $query = $this->db->get();
        return $query->result();
    }
    
    public function getBookPg($SPP,$page)
    {
        $query = $this->db->select('*')
        ->FROM('lib_books_record')
         ->limit($SPP,$page)
    ->join('lib_book_language','lib_book_language.lang_id=lib_books_record.language_id', 'left outer')    
    ->join('lib_books_location','lib_books_location.location_id=lib_books_record.location_id', 'left outer')
        ->order_by('book_id','desc')
        ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getbooksResults($table)
    {
        $query = $this->db->select('*')
        ->FROM($table)
        ->join('lib_publishers','lib_publishers.pub_id=lib_books_record.publisher_id', 'left outer')   
        ->join('lib_authors','lib_authors.author_id=lib_books_record.author_id', 'left outer')        
        ->join('lib_book_category','lib_book_category.subject_id=lib_books_record.subject_id', 'left outer')    
        ->join('lib_supliers','lib_supliers.sup_id=lib_books_record.supplier_id', 'left outer')    
        ->join('lib_book_language','lib_book_language.lang_id=lib_books_record.language_id', 'left outer')    
        ->join('lib_books_location','lib_books_location.location_id=lib_books_record.location_id', 'left outer')  
        ->order_by('book_id','desc')    
        ->get();
        return $query->result();
    }
    
    public function searchIssuedbooks($table,$where=NULL,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
$this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id');
        if($where):
            $this->db->where($where);    
        endif;
        $this->db->where('lib_book_code.book_availablity_status_id','1');
        if($like):
        $this->db->like($like);    
        endif;    
         $query = $this->db->get();
        return $query->result();
    }
    
    public function get_IssuanceInfo($where)
    {
        $this->db->select('serial_no,book_id,accession_no,availablity_status_id,student_name,father_name,student_record.college_no,name');
    $this->db->join('lib_book_issuance','lib_book_issuance.issuance_id=lib_book_issuance_details.issuance_id');
        $this->db->join('student_record','student_record.student_id=lib_book_issuance.student_id');
        $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id');
        $this->db->where('availablity_status_id','1');    
        $this->db->where($where);    
         $std = $this->db->get('lib_book_issuance_details')->row(); 
        if(!empty($std)):
           return $std;
        endif;
        $this->db->select('serial_no,book_id,accession_no,availablity_status_id,emp_name,title');
        $this->db->join('lib_staff_book_issuance','lib_staff_book_issuance.iss_id=lib_book_staff_issuance_details.iss_id');    
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=lib_staff_book_issuance.emp_id');    
        $this->db->join('department','department.department_id=hr_emp_record.department_id');    
        $this->db->where('availablity_status_id','1'); 
        $this->db->where($where); 
          $emp = $this->db->get('lib_book_staff_issuance_details')->row();    
        if(!empty($emp)):
           return $emp;
        endif;
        $this->db->select('serial_no,book_id,accession_no,availablity_status_id,hr_emp_record.emp_name as hod,department.title as dept');
        $this->db->join('lib_dept_books_issuance','lib_dept_books_issuance.dept_iss_id=lib_dept_books_issuance_details.dept_iss_id');     
        $this->db->join('department','department.department_id=lib_dept_books_issuance.dept_id');     
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=lib_dept_books_issuance.emp_id');     
        $this->db->where('availablity_status_id','1'); 
        $this->db->where($where); 
          $dept = $this->db->get('lib_dept_books_issuance_details')->row();    
        if(!empty($dept)):
            return $dept;
        endif;    
    }
    
    public function searchbooksResults($table,$where=NULL,$like=NULL)
    {
        $this->db->SELECT('*');
        $this->db->FROM($table);
$this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id');
        if($where):
        $this->db->where($where);    
        endif;
        if($like):
        $this->db->like($like);    
        endif;    
         $query = $this->db->get();
        return $query->result();
    }
    
    public function view_book($table,$where){
        $query =$this->db->SELECT('*')
        ->FROM($table)
        ->join('lib_book_language','lib_book_language.lang_id=lib_books_record.language_id', 'left outer')    
        ->join('lib_books_location','lib_books_location.location_id=lib_books_record.location_id', 'left outer')   
         ->where($where)
         ->get();
        return $query->row();
   }
    
public function view_bookCopy($table,$where1){
        $query =$this->db->SELECT('*')
        ->FROM($table)
       ->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id')
        ->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id') 
         ->where($where1)
         ->get();
        return $query->row();
   }
    
public function view_bookCode($table,$where)
{
        $query =$this->db->SELECT('*')
        ->FROM($table)
        ->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id')
        ->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id') 
         ->where($where)
         ->get();
        return $query->result();
   }
    
public function view_bookRecord()
{
        $query =$this->db->SELECT('*')
        ->FROM('lib_book_code')
->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id')
        ->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id')
        ->order_by('lib_books_record.book_id','desc')    
        ->order_by('lib_book_code.serial_no','desc')    
         ->get();
        return $query->result();
   }
    
    public function viewBookPg($SPP,$page)
    {
        $query = $this->db->select('*')
        ->FROM('lib_book_code')
         ->limit($SPP,$page)
    ->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id')        
    ->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id')
        ->order_by('lib_books_record.book_id','desc')  
        ->order_by('lib_book_code.serial_no','desc')   
        ->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_where_book($table,$wherebookid){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->where($wherebookid)
                         ->get();
            return $query->row();
   }
    
public function update($table,$data,$where2)
    {
        $this->db->where($where2);
        $this->db->update($table,$data);
    }    
    
public function get_book_copy($table,$where){
        $query =$this->db->SELECT('*')
         ->FROM($table)
        ->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id')    
        ->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id')    
         ->where($where)
         ->get();
        return $query->row();
   }
    
    public function search_accession($table,$accession_from=NULL,$accession_to=NULL){

       $this->db->select('*');
       $this->db->from($table);
       $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id', 'left outer');
        if($accession_from !="" && $accession_to !=""):
           $this->db->where('accession_number BETWEEN "'.$accession_from.'" and "'.$accession_to.'"');
                   endif;
        return $this->db->get()->result();
      
   }

public function booksResults_excel($table,$where=NULL,$like=NULL)
    {
        $this->db->SELECT('lib_book_code.accession_number,lib_book_code.old_accession_number,lib_books_record.book_title,lib_books_record.sub_book_title,lib_books_record.book_isbn,lib_books_record.author_name,lib_book_availability_status.title');
        $this->db->FROM($table);
$this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_code.book_availablity_status_id');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_code.book_id');
        if($where):
        $this->db->where($where);    
        endif;
        if($like):
        $this->db->like($like);    
        endif;    
         $query = $this->db->get();
        return $query->result_array();
    }
    
public function updateCopy($table,$data1,$where1)
    {
        $this->db->where($where1);
        $this->db->update($table,$data1);
    }
    
    
    
    public function getStaffBooksIssuance()
    {
        $this->db->select('lib_staff_book_issuance.*,hr_emp_record.emp_name,hr_emp_record.picture,department.title as department,hr_emp_designation.title as designation,hr_emp_contract_type.title as contract,hr_emp_status.title as employ_status'); 
        $this->db->FROM('lib_staff_book_issuance');
        $this->db->join('lib_book_staff_issuance_details','lib_book_staff_issuance_details.iss_id=lib_staff_book_issuance.iss_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=lib_staff_book_issuance.emp_id','left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id','left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id','left outer');
        $this->db->where('lib_book_staff_issuance_details.availablity_status_id','1');
        $this->db->group_by('hr_emp_record.emp_id');
        $this->db->order_by('hr_emp_record.emp_name');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function return_staffBooks_details($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('lib_book_staff_issuance_details','lib_book_staff_issuance_details.iss_id=lib_staff_book_issuance.iss_id','left outer');
        $this->db->join('department','department.department_id=lib_staff_book_issuance.dept_id','left outer');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_staff_issuance_details.book_id','left outer');
        $this->db->where('lib_book_staff_issuance_details.availablity_status_id','1');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getEmpData($table,$where){
        $query =$this->db->SELECT('hr_emp_record.emp_name,department.title as department,hr_emp_designation.title as designation')
                         ->FROM($table)
    ->join('department','department.department_id=hr_emp_record.department_id','left outer')
    ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')
                         ->where($where)
                         ->get();
            return $query->row();
   }
    
    public function staffissuance_Books_details($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('lib_book_staff_issuance_details','lib_book_staff_issuance_details.iss_id=lib_staff_book_issuance.iss_id','left outer');
        $this->db->join('department','department.department_id=lib_staff_book_issuance.dept_id','left outer');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_staff_issuance_details.book_id','left outer');
        $this->db->where('lib_book_staff_issuance_details.availablity_status_id','1');
        $this->db->where($where);
        $this->db->order_by('lib_staff_book_issuance.issued_date','asc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getstaffbooks_issuance($where)
    {
        $this->db->select('*'); 
        $this->db->FROM('lib_book_staff_issuance_details_demo');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_staff_issuance_details_demo.book_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getStaffData($table,$where){
        $query =$this->db->SELECT('hr_emp_record.emp_id,hr_emp_record.emp_name,hr_emp_record.father_name,hr_emp_record.picture,department.title as dept,hr_emp_designation.title as desg')
                         ->FROM($table)
    ->join('department','department.department_id=hr_emp_record.department_id','left outer')
    ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')
                         ->where($where)
                         ->get();
            return $query->row();
   }
    
    public function get_all_issuance_staff($table, $where=NULL, $like=NULL, $from, $to){
       $this->db->select('
            lib_staff_book_issuance.*,
            hr_emp_record.emp_name,
            department.title as deptt_title,
            lib_book_staff_issuance_details.accession_no,
            lib_book_availability_status.title as status_title,
            lib_books_record.book_title,
            lib_books_record.subject_name,
            lib_books_record.sub_subject_name,
            hr_emp_status.title as emp_status,
        ');
        $this->db->from($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=lib_staff_book_issuance.emp_id', 'left outer');
        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_emp_record.emp_status_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('lib_book_staff_issuance_details','lib_book_staff_issuance_details.iss_id=lib_staff_book_issuance.iss_id', 'left outer');
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_staff_issuance_details.availablity_status_id');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_staff_issuance_details.book_id');
        if($like):
            $this->db->like($like);
        endif;
        if($where):
            $this->db->where($where);
        endif;
        if($from !="" && $to !=""):
           $this->db->where('lib_staff_book_issuance.issued_date BETWEEN "'.$from.'" and "'.$to.'"');
        endif;
        $this->db->order_by('lib_staff_book_issuance.issued_date', 'desc');
        return $this->db->get()->result();
    }
    
    public function get_all_issuance_student($table, $where=NULL, $like=NULL, $from, $to){
       $this->db->select('
            lib_book_issuance.*,
            student_record.student_name,
            student_record.college_no,
            sections.name as section_name,
            lib_book_issuance_details.accession_no,
            lib_book_availability_status.title as status_title,
            lib_books_record.book_title,
            lib_books_record.subject_name,
            lib_books_record.sub_subject_name,
            student_status.name as student_status,
        ');
        $this->db->from($table);
        $this->db->join('student_record','student_record.student_id=lib_book_issuance.student_id', 'left outer');
        $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id', 'left outer');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id', 'left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id', 'left outer');
        $this->db->join('lib_book_issuance_details','lib_book_issuance_details.issuance_id=lib_book_issuance.issuance_id', 'left outer');
        $this->db->join('lib_book_availability_status','lib_book_availability_status.availability_status_id=lib_book_issuance_details.availablity_status_id');
        $this->db->join('lib_books_record','lib_books_record.book_id=lib_book_issuance_details.book_id');
        if($like):
            $this->db->like($like);
        endif;
        if($where):
            $this->db->where($where);
        endif;
        if($from !="" && $to !=""):
           $this->db->where('lib_book_issuance.issued_date BETWEEN "'.$from.'" and "'.$to.'"');
        endif;
        $this->db->order_by('lib_book_issuance.issued_date', 'desc');
        return $this->db->get()->result();
    }
    
}

