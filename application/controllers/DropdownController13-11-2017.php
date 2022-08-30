<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
 

class DropdownController extends AdminController {

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
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
      
          
    public function __construct() {
             parent::__construct();
             
 
          }
          
          //Hostel Student Auto compelete
           public function hostel_students(){
        
 
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->DropdownModel->hostel_students(array('hostel_status_id'=>1));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->student_name.' S/D '.$row_set->father_name.' ,Form# '.$row_set->form_no.' ', 
                            'code'     =>$row_set->hostel_id, 
                            'value'     =>$row_set->student_name, 
                              
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->hostel_students(array('hostel_status_id'=>1),$like);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                          'label'     =>$row_set->student_name.' S/D '.$row_set->father_name.' ,Form# '.$row_set->form_no.' ', 
                            'code'     =>$row_set->hostel_id, 
                            'value'     =>$row_set->student_name,
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                   
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }  
          
    }

