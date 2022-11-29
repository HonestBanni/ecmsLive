<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class LanguageController extends AdminController {
	function __construct(){
            parent::__construct();
            $this->load->model('CRUDModel');
            $this->load->model('LanguagesModel');
            $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
	}
    public function english_language_records(){       
            $like = '';
            $where['student_record.programe_id']    = '13';
            
            $this->data['form_no']                  = '';
            $this->data['student_name']             = '';
            $this->data['father_name']              = '';
            $this->data['gender_id']                = '';
            $this->data['program_id']               = '';
            $this->data['sub_pro_id']               = '';
            $this->data['batch_id']                 = '';
            $this->data['s_status_id']              = '';
        if($this->input->post('search')):
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $lang_status_id     =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('programe_id');
            $sub_program        =  $this->input->post('sub_pro_id');
            $batch              =  $this->input->post('batch_id');
            
        if(!empty($program)):
                 $where['student_record.programe_id']   = $program;
                $this->data['program_id']               = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
                $this->data['form_no'] =$form_no;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            if(!empty($gender_id)):
                $where['gender.gender_id']  = $gender_id;
                $this->data['gender_id']    = $gender_id;
            endif;
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
        
                $this->data['result']   = $this->LanguagesModel->language_student_records('student_record',$where,$like,$custom);
            else:
                $where                      = array('student_record.programe_id'=>'13');
                //pagination start
                $config['base_url']         = base_url('EnglishLanguageRecords');
                $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
                $config['per_page']         = 50;
                $config["num_links"]        = 2;
                $config['uri_segment']      = 2;
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
                $page                       = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
                $this->data['pages']        = $this->pagination->create_links();
                $custom['column']           = 'student_id';
                $custom['order']            = 'desc';   
                $this->data['result']       = $this->LanguagesModel->language_pagination($config['per_page'], $page,$where,$custom);
                $this->data['count']     =$config['total_rows']; 
            endif;
            if($this->input->post('export')):
		   
                
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $lang_status_id     =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('programe_id');
            $sub_program        =  $this->input->post('sub_pro_id');
            $batch              =  $this->input->post('batch_id');
            
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
                $this->data['form_no'] =$form_no;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
				
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'ID');
                
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Student Name');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Program');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Batch Name');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Comments');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Hostel');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Fata School');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Domicile');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','T.M');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','O.M');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('O1','%');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('P1','Remarks 1');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Application status');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('S1','Admission Date');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('T1','College no');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('U1','Minority');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('V1','Address');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
              
                $this->excel->getActiveSheet()->setCellValue('W1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
				
				$this->excel->getActiveSheet()->setCellValue('X1','Student Status');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
				
				
       for($col = ord('A'); $col <= ord('X'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
		
            $result   = $this->LanguageModel->export_language_students('student_record',$where,$like,$custom);
          //  echo '<pre>';print_r($result);die;
			foreach($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='English_Language_Students.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif;
           $this->data['gender']        = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title'); 
           $this->data['program']       = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>13));
           $this->data['sub_program']   = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>13));
           $this->data['batch']         = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'13'));
           $this->data['status']        = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
           
           $this->data['page_header']   = 'English Language Students Record';
           $this->data['page_title']   = 'English Language Students Record | ECMS';
           $this->data['page']         = 'Languages/English/english_student_record';
           $this->load->view('common/common',$this->data);
    }
    public function english_language_registration(){	
         
        if($this->input->post('Search')):
            $where = '';
            $like = '';
            $this->data['student_id']  = '';
            $student_id = $this->input->post('student_id');
                if(!empty($student_id)):
                    $where['student_record.student_id'] = $student_id;
                    $this->data['student_id'] = $student_id;
                endif;
            
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        endif;
         if($this->input->post('Save')):	
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
             
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            
            $number = "";
            $form_no = "";
            $code = "ENG";
            $batch_id = $this->input->post('batch_id');
            $this->db->limit(1,0)->order_by('student_id','desc');
            $res = $this->db->get_where('student_record',array('batch_id'=>$batch_id))->row();
            if(empty($res)):
                    $number = 1;
                else:
                    $d = explode("-",$res->form_no);
                    $number = $d[1]+1;
                endif;
            $form_no = $code.'-'.$number;
        
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$form_no,
                'comment'=>$this->input->post('comment'),
                'lang_college_no'=>$this->input->post('college_no'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'applicant_mob_no1'=>$this->input->post('mobile_no'),
                'mobile_no'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>date('Y-m-d H:i:s'),
                'user_id'=>$this->userInfo->user_id

            );
            $this->CRUDModel->insert('student_record',$data);
            redirect('EnglishLanguageRecords');
        endif;
            $this->data['page_header']   = 'Register English Student ';
            $this->data['page_title']   = 'Register English Student | ECMS';
            $this->data['page']         = 'Languages/English/add_english_student';
            $this->load->view('common/common',$this->data);
            
	}
    public function english_language_update(){	
        $uri = $this->uri->segment(2);

        $this->data['result'] = $this->CRUDModel->get_where_result('student_record',array('student_id'=>$uri));
         
        if($this->input->post()){
              
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                = $this->input->post('dob'); 
            $admission_date     = $this->input->post('admission_date'); 
            
            $data_post = array (
                'batch_id'          => $this->input->post('batch_id'),
                'programe_id'       => $this->input->post('programe_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
                'form_no'           => $this->input->post('form_no'),
                'rseats_id'         => $this->input->post('rseats_id'),
                'comment'           => $this->input->post('comment'),
                'college_no'        => $this->input->post('college_no'),
                'fata_school'       => $this->input->post('fata_school'),
                'lang_status_id'    => $this->input->post('lang_status_id'),
                'student_name'      => ucwords(strtolower(ucwords($this->input->post('student_name')))),
                'student_cnic'      => $this->input->post('student_cnic'),
                'gender_id'         => $this->input->post('gender_id'),
                'marital_id'        => $this->input->post('marital_id'),
                'dob'               => date('Y-m-d', strtotime($dob)),
                'place_of_birth'    => $this->input->post('place_of_birth'),
                'bg_id'             => $this->input->post('bg_id'),
                'country_id'        => $this->input->post('country_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'district_id'       => $this->input->post('district_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'hostel_required'   => $this->input->post('hostel_required'),
                'father_name'       => ucwords(strtolower(ucwords($this->input->post('father_name')))),
                'father_cnic'       => $this->input->post('father_cnic'),
                'land_line_no'      => $this->input->post('land_line_no'),
                'applicant_mob_no1' => $this->input->post('applicant_mob_no1'),
                'std_mobile_network'=> $this->input->post('mobile_network_student'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'occ_id'            => $this->input->post('occ_id'),
                'annual_income'     => $this->input->post('annual_income'),
                'app_postal_address'=> $this->input->post('app_postal_address'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'father_email'      => $this->input->post('father_email'),
                'guardian_name'     => ucwords(strtolower(ucwords($this->input->post('guardian_name')))),
                'guardian_cnic'     => $this->input->post('guardian_cnic'),
                'g_annual_income'   => $this->input->post('g_annual_income'),
                'g_land_no'         => $this->input->post('g_land_no'),
                'g_mobile_no'       => $this->input->post('g_mobile_no'),
                'g_postal_address'  => $this->input->post('g_postal_address'),
                'g_email'           => $this->input->post('g_email'),
                'e_person_relation' => $this->input->post('e_person_relation'),
                'e_person_contact1' => $this->input->post('e_person_contact1'),
                'e_person_contact2' => $this->input->post('e_person_contact2'),
                's_status_id'       => $this->input->post('s_status_id'),
                'bank_receipt_no'   => $this->input->post('bank_receipt_no'),
                'admission_date'    => date('Y-m-d', strtotime($admission_date)),
                'admission_comment' => $this->input->post('admission_comment'),
                'updated_by_user'   => $this->userInfo->user_id,
                'updated_datetime'  => date('Y-m-d H:i:s'),
                'physical_status_id'        =>$this->input->post('physical_status_id'),
                'emargency_person_name'     =>ucwords(strtolower(ucwords($this->input->post('emargency_person_name')))),
                'relation_with_guardian'    => $this->input->post('relation_with_guardian'),
                'guardian_occupation'       => $this->input->post('guardian_occupation'),
            );
            $this->CRUDModel->update('student_record',$data_post,array('student_id'=>$uri));
                $batch_id           = $this->input->post('batch_id');
                $programe_id        = $this->input->post('programe_id');
                $sub_pro_id         = $this->input->post('sub_pro_id');
                $student_name       = $this->input->post('student_name');
                $form_no            = $this->input->post('form_no');
                $college_no         = $this->input->post('college_no');
                $rseats_id          = $this->input->post('rseats_id');
                $domicile_id        = $this->input->post('domicile_id');
                $mobile_no          = $this->input->post('mobile_no');
                $mobile_no2         = $this->input->post('mobile_no2');
                $old_programe_id    = $this->input->post('old_programe_id');
                $old_sub_pro_id     = $this->input->post('old_sub_pro_id');
                $old_batch_id       = $this->input->post('old_batch_id');
                $old_domicile_id    = $this->input->post('old_domicile_id');
                $old_student_name   = $this->input->post('old_student_name');
                $old_form_no        = $this->input->post('old_form_no');
                $old_college_no     = $this->input->post('old_college_no');
                $old_rseats_id      = $this->input->post('old_rseats_id');
                $old_mobile_no      = $this->input->post('old_mobile_no');
                $old_mobile_no2     = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
            $data_log = array(
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
                   'user_id'=>$this->userInfo->user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('EnglishLanguageRecords');
        }
        
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>13));
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>13));
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'13'));
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seats ', 'rseat_id', 'name'); 
        $this->data['student_lang']     = $this->CRUDModel->dropDown('student_status_lang', ' Reserved Seats ', 'lang_status_id', 'name'); 
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title'); 
        $this->data['marital']          = $this->CRUDModel->dropDown('marital_status', 'Marital Status', 'marital_status_id', 'title'); 
        $this->data['bloodGroup']       = $this->CRUDModel->dropDown('blood_group', 'Blood Group', 'b_group_id', 'title'); 
        $this->data['country']          = $this->CRUDModel->dropDown('country', 'Country', 'country_id', 'name'); 
        $this->data['domicile']         = $this->CRUDModel->dropDown('domicile', 'Domicile', 'domicile_id', 'name'); 
        $this->data['district']         = $this->CRUDModel->dropDown('district', 'District', 'district_id', 'name'); 
        $this->data['religion']         = $this->CRUDModel->dropDown('religion', 'Religion', 'religion_id', 'title'); 
        $this->data['occupation']       = $this->CRUDModel->dropDown('occupation', 'Occupation', 'occ_id', 'title'); 
        $this->data['relation']         = $this->CRUDModel->dropDown('relation', 'Relation', 'relation_id', 'title'); 
        $this->data['physical_status']  = $this->CRUDModel->dropDown('physical_status', 'Physical Status', 'ps_id', 'title'); 
        
        $this->data['page_header']      = 'Update English Student';
        $this->data['page_title']       = 'Update English Student | ECMS';
        $this->data['page']             = 'Languages/English/update_english_language_student';
        $this->load->view('common/common',$this->data);
    }
    public function chinese_language_records(){       
            $like = '';
            $where['student_record.programe_id']    = '10';
            
            $this->data['form_no']                  = '';
            $this->data['student_name']             = '';
            $this->data['father_name']              = '';
            $this->data['gender_id']                = '';
            $this->data['program_id']               = '';
            $this->data['sub_pro_id']               = '';
            $this->data['batch_id']                 = '';
            $this->data['s_status_id']              = '';
        if($this->input->post('search')):
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $lang_status_id     =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('programe_id');
            $sub_program        =  $this->input->post('sub_pro_id');
            $batch              =  $this->input->post('batch_id');
            
        if(!empty($program)):
                 $where['student_record.programe_id']   = $program;
                $this->data['program_id']               = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
                $this->data['form_no'] =$form_no;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            if(!empty($gender_id)):
                $where['gender.gender_id']  = $gender_id;
                $this->data['gender_id']    = $gender_id;
            endif;
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
        
                $this->data['result']   = $this->LanguagesModel->language_student_records('student_record',$where,$like,$custom);
            else:
                $where                      = array('student_record.programe_id'=>'10');
                //pagination start
                $config['base_url']         = base_url('ChineseLanguageRecords');
                $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
                $config['per_page']         = 50;
                $config["num_links"]        = 2;
                $config['uri_segment']      = 2;
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
                $page                       = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
                $this->data['pages']        = $this->pagination->create_links();
                $custom['column']           = 'student_id';
                $custom['order']            = 'desc';   
                $this->data['result']       = $this->LanguagesModel->language_pagination($config['per_page'], $page,$where,$custom);
                $this->data['count']     =$config['total_rows']; 
            endif;
            if($this->input->post('export')):
		   
                
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $lang_status_id     =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('programe_id');
            $sub_program        =  $this->input->post('sub_pro_id');
            $batch              =  $this->input->post('batch_id');
            
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
                $this->data['form_no'] =$form_no;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
				
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'ID');
                
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Student Name');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Program');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Batch Name');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Comments');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Hostel');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Fata School');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Domicile');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','T.M');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','O.M');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('O1','%');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('P1','Remarks 1');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Application status');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('S1','Admission Date');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('T1','College no');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('U1','Minority');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('V1','Address');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
              
                $this->excel->getActiveSheet()->setCellValue('W1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
				
				$this->excel->getActiveSheet()->setCellValue('X1','Student Status');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
				
				
       for($col = ord('A'); $col <= ord('X'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
		
            $result   = $this->LanguageModel->export_language_students('student_record',$where,$like,$custom);
          //  echo '<pre>';print_r($result);die;
			foreach($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='Chinese_Language_Students.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif;
           $this->data['gender']        = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title'); 
           $this->data['program']       = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>10));
           $this->data['sub_program']   = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>10));
           $this->data['batch']         = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>10));
           $this->data['status']        = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
           
           $this->data['page_header']   = 'Chinese Language Students Record';
           $this->data['page_title']   = 'Chinese Language Students Record | ECMS';
           $this->data['page']         = 'Languages/Chinese/chinese_student_record';
           $this->load->view('common/common',$this->data);
    }
    public function chinese_language_registration(){	
         
        if($this->input->post('Search')):
            $where = '';
            $like = '';
            $this->data['student_id']  = '';
            $student_id = $this->input->post('student_id');
                if(!empty($student_id)):
                    $where['student_record.student_id'] = $student_id;
                    $this->data['student_id'] = $student_id;
                endif;
            
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        endif;
         if($this->input->post('Save')):	
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
             
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            
            $number = "";
            $form_no = "";
            $code = "HSK";
            $batch_id = $this->input->post('batch_id');
            $this->db->limit(1,0)->order_by('student_id','desc');
            $res = $this->db->get_where('student_record',array('batch_id'=>$batch_id))->row();
            if(empty($res)):
                    $number = 1;
                else:
                    $d = explode("-",$res->form_no);
                    $number = $d[1]+1;
                endif;
            $form_no = $code.'-'.$number;
        
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$form_no,
                'comment'=>$this->input->post('comment'),
                'lang_college_no'=>$this->input->post('college_no'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'applicant_mob_no1'=>$this->input->post('mobile_no'),
                'mobile_no'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>date('Y-m-d H:i:s'),
                'user_id'=>$this->userInfo->user_id

            );
            $this->CRUDModel->insert('student_record',$data);
            redirect('ChineseLanguageRecords');
        endif;
            $this->data['page_header']   = 'Register Chinese Student ';
            $this->data['page_title']   = 'Register Chinese Student | ECMS';
            $this->data['page']         = 'Languages/Chinese/add_chinese_student';
            $this->load->view('common/common',$this->data);
            
	}
    public function chinese_language_update(){	
        $uri = $this->uri->segment(2);

        $this->data['result'] = $this->CRUDModel->get_where_result('student_record',array('student_id'=>$uri));
         
        if($this->input->post()){
              
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                = $this->input->post('dob'); 
            $admission_date     = $this->input->post('admission_date'); 
            
            $data_post = array (
                'batch_id'          => $this->input->post('batch_id'),
                'programe_id'       => $this->input->post('programe_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
                'form_no'           => $this->input->post('form_no'),
                'rseats_id'         => $this->input->post('rseats_id'),
                'comment'           => $this->input->post('comment'),
                'college_no'        => $this->input->post('college_no'),
                'fata_school'       => $this->input->post('fata_school'),
                'lang_status_id'    => $this->input->post('lang_status_id'),
                'student_name'      => ucwords(strtolower(ucwords($this->input->post('student_name')))),
                'student_cnic'      => $this->input->post('student_cnic'),
                'gender_id'         => $this->input->post('gender_id'),
                'marital_id'        => $this->input->post('marital_id'),
                'dob'               => date('Y-m-d', strtotime($dob)),
                'place_of_birth'    => $this->input->post('place_of_birth'),
                'bg_id'             => $this->input->post('bg_id'),
                'country_id'        => $this->input->post('country_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'district_id'       => $this->input->post('district_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'hostel_required'   => $this->input->post('hostel_required'),
                'father_name'       => ucwords(strtolower(ucwords($this->input->post('father_name')))),
                'father_cnic'       => $this->input->post('father_cnic'),
                'land_line_no'      => $this->input->post('land_line_no'),
                'applicant_mob_no1' => $this->input->post('applicant_mob_no1'),
                'std_mobile_network'=> $this->input->post('mobile_network_student'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'occ_id'            => $this->input->post('occ_id'),
                'annual_income'     => $this->input->post('annual_income'),
                'app_postal_address'=> $this->input->post('app_postal_address'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'father_email'      => $this->input->post('father_email'),
                'guardian_name'     => ucwords(strtolower(ucwords($this->input->post('guardian_name')))),
                'guardian_cnic'     => $this->input->post('guardian_cnic'),
                'g_annual_income'   => $this->input->post('g_annual_income'),
                'g_land_no'         => $this->input->post('g_land_no'),
                'g_mobile_no'       => $this->input->post('g_mobile_no'),
                'g_postal_address'  => $this->input->post('g_postal_address'),
                'g_email'           => $this->input->post('g_email'),
                'e_person_relation' => $this->input->post('e_person_relation'),
                'e_person_contact1' => $this->input->post('e_person_contact1'),
                'e_person_contact2' => $this->input->post('e_person_contact2'),
                's_status_id'       => $this->input->post('s_status_id'),
                'bank_receipt_no'   => $this->input->post('bank_receipt_no'),
                'admission_date'    => date('Y-m-d', strtotime($admission_date)),
                'admission_comment' => $this->input->post('admission_comment'),
                'updated_by_user'   => $this->userInfo->user_id,
                'updated_datetime'  => date('Y-m-d H:i:s'),
                'physical_status_id'        =>$this->input->post('physical_status_id'),
                'emargency_person_name'     =>ucwords(strtolower(ucwords($this->input->post('emargency_person_name')))),
                'relation_with_guardian'    => $this->input->post('relation_with_guardian'),
                'guardian_occupation'       => $this->input->post('guardian_occupation'),
            );
            $this->CRUDModel->update('student_record',$data_post,array('student_id'=>$uri));
                $batch_id           = $this->input->post('batch_id');
                $programe_id        = $this->input->post('programe_id');
                $sub_pro_id         = $this->input->post('sub_pro_id');
                $student_name       = $this->input->post('student_name');
                $form_no            = $this->input->post('form_no');
                $college_no         = $this->input->post('college_no');
                $rseats_id          = $this->input->post('rseats_id');
                $domicile_id        = $this->input->post('domicile_id');
                $mobile_no          = $this->input->post('mobile_no');
                $mobile_no2         = $this->input->post('mobile_no2');
                $old_programe_id    = $this->input->post('old_programe_id');
                $old_sub_pro_id     = $this->input->post('old_sub_pro_id');
                $old_batch_id       = $this->input->post('old_batch_id');
                $old_domicile_id    = $this->input->post('old_domicile_id');
                $old_student_name   = $this->input->post('old_student_name');
                $old_form_no        = $this->input->post('old_form_no');
                $old_college_no     = $this->input->post('old_college_no');
                $old_rseats_id      = $this->input->post('old_rseats_id');
                $old_mobile_no      = $this->input->post('old_mobile_no');
                $old_mobile_no2     = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
            $data_log = array(
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
                   'user_id'=>$this->userInfo->user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('ChineseLanguageRecords');
        }
        
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>10));
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>10));
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'10'));
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seats ', 'rseat_id', 'name'); 
        $this->data['student_lang']     = $this->CRUDModel->dropDown('student_status_lang', ' Reserved Seats ', 'lang_status_id', 'name'); 
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title'); 
        $this->data['marital']          = $this->CRUDModel->dropDown('marital_status', 'Marital Status', 'marital_status_id', 'title'); 
        $this->data['bloodGroup']       = $this->CRUDModel->dropDown('blood_group', 'Blood Group', 'b_group_id', 'title'); 
        $this->data['country']          = $this->CRUDModel->dropDown('country', 'Country', 'country_id', 'name'); 
        $this->data['domicile']         = $this->CRUDModel->dropDown('domicile', 'Domicile', 'domicile_id', 'name'); 
        $this->data['district']         = $this->CRUDModel->dropDown('district', 'District', 'district_id', 'name'); 
        $this->data['religion']         = $this->CRUDModel->dropDown('religion', 'Religion', 'religion_id', 'title'); 
        $this->data['occupation']       = $this->CRUDModel->dropDown('occupation', 'Occupation', 'occ_id', 'title'); 
        $this->data['relation']         = $this->CRUDModel->dropDown('relation', 'Relation', 'relation_id', 'title'); 
        $this->data['physical_status']  = $this->CRUDModel->dropDown('physical_status', 'Physical Status', 'ps_id', 'title'); 
        
        $this->data['page_header']      = 'Update Chinese Student';
        $this->data['page_title']       = 'Update Chinese Student | ECMS';
        $this->data['page']             = 'Languages/Chinese/update_chinese_language_student';
        $this->load->view('common/common',$this->data);
    }
    
      public function ilets_language_records(){       
            $like = '';
            $where['student_record.programe_id']    = '19';
            
            $this->data['form_no']                  = '';
            $this->data['student_name']             = '';
            $this->data['father_name']              = '';
            $this->data['gender_id']                = '';
            $this->data['program_id']               = '';
            $this->data['sub_pro_id']               = '';
            $this->data['batch_id']                 = '';
            $this->data['s_status_id']              = '';
        if($this->input->post('search')):
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $lang_status_id     =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('programe_id');
            $sub_program        =  $this->input->post('sub_pro_id');
            $batch              =  $this->input->post('batch_id');
            
        if(!empty($program)):
                 $where['student_record.programe_id']   = $program;
                $this->data['program_id']               = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
                $this->data['form_no'] =$form_no;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            if(!empty($gender_id)):
                $where['gender.gender_id']  = $gender_id;
                $this->data['gender_id']    = $gender_id;
            endif;
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
        
                $this->data['result']   = $this->LanguagesModel->language_student_records('student_record',$where,$like,$custom);
            else:
                $where                      = array('student_record.programe_id'=>'19');
                //pagination start
                $config['base_url']         = base_url('IELTSLanguageRecords');
                $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
                $config['per_page']         = 50;
                $config["num_links"]        = 2;
                $config['uri_segment']      = 2;
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
                $page                       = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
                $this->data['pages']        = $this->pagination->create_links();
                $custom['column']           = 'student_id';
                $custom['order']            = 'desc';   
                $this->data['result']       = $this->LanguagesModel->language_pagination($config['per_page'], $page,$where,$custom);
                $this->data['count']     =$config['total_rows']; 
            endif;
            if($this->input->post('export')):
		   
                
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $lang_status_id     =  $this->input->post('lang_status_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('programe_id');
            $sub_program        =  $this->input->post('sub_pro_id');
            $batch              =  $this->input->post('batch_id');
            
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programe_id']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['sub_programes.sub_pro_id'] = $sub_program;
                $this->data['sub_pro_id'] = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
                $this->data['form_no'] =$form_no;
            endif;
            if(!empty($college_no)):
                $where['college_no'] = $college_no;
                $this->data['college_no'] =$college_no;
            endif;
            if(!empty($student_name)):
                $like['student_name'] = $student_name;
                $this->data['student_name'] =$student_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($lang_status_id)):
                $where['student_status_lang.lang_status_id'] = $lang_status_id;
                $this->data['lang_status_id']  = $lang_status_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
				
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'ID');
                
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Student Name');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Father name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('E1','Gender');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Program');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                
                $this->excel->getActiveSheet()->setCellValue('G1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1','Batch Name');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Comments');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Hostel');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('K1','Fata School');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('L1','Domicile');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('M1','T.M');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('N1','O.M');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('O1','%');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('P1','Remarks 1');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('R1','Application status');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('S1','Admission Date');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('T1','College no');
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('U1','Minority');
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(16);
               
                $this->excel->getActiveSheet()->setCellValue('V1','Address');
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(16);
              
                $this->excel->getActiveSheet()->setCellValue('W1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
				
				$this->excel->getActiveSheet()->setCellValue('X1','Student Status');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
				
				
       for($col = ord('A'); $col <= ord('X'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
		
            $result   = $this->LanguageModel->export_language_students('student_record',$where,$like,$custom);
          //  echo '<pre>';print_r($result);die;
			foreach($result as $row)
			{
				$exceldata[] = $row;		
			}
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $filename='Chinese_Language_Students.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif;
           $this->data['gender']        = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title'); 
           $this->data['program']       = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>19));
           $this->data['sub_program']   = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>19));
           $this->data['batch']         = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>19));
           $this->data['status']        = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
           
           $this->data['page_header']  = 'IELTS Language Students Record';
           $this->data['page_title']   = 'IELTS Language Students Record | ECMS';
           $this->data['page']         = 'Languages/IELTS/IELTS_student_record';
           $this->load->view('common/common',$this->data);
    }
       public function ielts_language_registration(){	
         
        if($this->input->post('Search')):
            $where = '';
            $like = '';
            $this->data['student_id']  = '';
            $student_id = $this->input->post('student_id');
                if(!empty($student_id)):
                    $where['student_record.student_id'] = $student_id;
                    $this->data['student_id'] = $student_id;
                endif;
            
            $this->data['result'] = $this->CRUDModel->get_where_row('student_record',$where);
        endif;
         if($this->input->post('Save')):	
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
             
            $dob = $this->input->post('dob'); 
            $date1 = date('Y-m-d', strtotime($dob));
            
            $number = "";
            $form_no = "";
            $code = "IELTS";
            $batch_id = $this->input->post('batch_id');
            $this->db->limit(1,0)->order_by('student_id','desc');
            $res = $this->db->get_where('student_record',array('batch_id'=>$batch_id))->row();
            if(empty($res)):
                    $number = 1;
                else:
                    $d = explode("-",$res->form_no);
                    $number = $d[1]+1;
                endif;
            $form_no = $code.'-'.$number;
        
            $data = array
            (
                'batch_id'=>$this->input->post('batch_id'),
                'programe_id'=>$this->input->post('programe_id'),
                'sub_pro_id'=>$this->input->post('sub_pro_id'),
                'form_no'=>$form_no,
                'comment'=>$this->input->post('comment'),
                'lang_college_no'=>$this->input->post('college_no'),
                'student_name'=>$student,
                'student_cnic'=>$this->input->post('student_cnic'),
                'gender_id'=>$this->input->post('gender_id'),
                'marital_id'=>$this->input->post('marital_id'),
                'dob'=>$date1,
                'place_of_birth'=>$this->input->post('place_of_birth'),
                'bg_id'=>$this->input->post('bg_id'),
                'country_id'=>$this->input->post('country_id'),
                'domicile_id'=>$this->input->post('domicile_id'),
                'district_id'=>$this->input->post('district_id'),
                'religion_id'=>$this->input->post('religion_id'),
                'hostel_required'=>$this->input->post('hostel_required'),
                'father_name'=>$father,
                'father_cnic'=>$this->input->post('father_cnic'),
                'land_line_no'=>$this->input->post('land_line_no'),
                'applicant_mob_no1'=>$this->input->post('mobile_no'),
                'mobile_no'=>$this->input->post('mobile_no2'),
                'occ_id'=>$this->input->post('occ_id'),
                'annual_income'=>$this->input->post('annual_income'),
                'app_postal_address'=>$this->input->post('app_postal_address'),
                'parmanent_address'=>$this->input->post('parmanent_address'),
                'father_email'=>$this->input->post('father_email'),
                'guardian_name'=>$guardian,
                'guardian_cnic'=>$this->input->post('guardian_cnic'),
                'relation_with_guardian'=>$this->input->post('relation_with_guardian'),
                'guardian_occupation'=>$this->input->post('guardian_occupation'),
                'g_annual_income'=>$this->input->post('g_annual_income'),
                'g_land_no'=>$this->input->post('g_land_no'),
                'g_mobile_no'=>$this->input->post('g_mobile_no'),
                'g_postal_address'=>$this->input->post('g_postal_address'),
                'g_email'=>$this->input->post('g_email'),
                'physical_status_id'=>$this->input->post('physical_status_id'),
                'emargency_person_name'=>$emargency_person,
                'e_person_relation'=>$this->input->post('e_person_relation'),
                'e_person_contact1'=>$this->input->post('e_person_contact1'),
                'e_person_contact2'=>$this->input->post('e_person_contact2'),
                's_status_id'=>$this->input->post('s_status_id'),
                'admission_comment'=>$this->input->post('admission_comment'),
                'timestamp'=>date('Y-m-d H:i:s'),
                'user_id'=>$this->userInfo->user_id

            );
            $this->CRUDModel->insert('student_record',$data);
            redirect('IELTSLanguageRecords');
        endif;
            $this->data['page_header']  = 'IELTS Chinese Student ';
            $this->data['page_title']   = 'IELTS Chinese Student | ECMS';
            $this->data['page']         = 'Languages/IELTS/add_IELTS_student';
            $this->load->view('common/common',$this->data);
            
	}
    public function ielts_language_update(){	
        $uri = $this->uri->segment(2);

        $this->data['result'] = $this->CRUDModel->get_where_result('student_record',array('student_id'=>$uri));
         
        if($this->input->post()){
              
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                = $this->input->post('dob'); 
            $admission_date     = $this->input->post('admission_date'); 
            
            $data_post = array (
                'batch_id'          => $this->input->post('batch_id'),
                'programe_id'       => $this->input->post('programe_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
                'form_no'           => $this->input->post('form_no'),
                'rseats_id'         => $this->input->post('rseats_id'),
                'comment'           => $this->input->post('comment'),
                'college_no'        => $this->input->post('college_no'),
                'fata_school'       => $this->input->post('fata_school'),
                'lang_status_id'    => $this->input->post('lang_status_id'),
                'student_name'      => ucwords(strtolower(ucwords($this->input->post('student_name')))),
                'student_cnic'      => $this->input->post('student_cnic'),
                'gender_id'         => $this->input->post('gender_id'),
                'marital_id'        => $this->input->post('marital_id'),
                'dob'               => date('Y-m-d', strtotime($dob)),
                'place_of_birth'    => $this->input->post('place_of_birth'),
                'bg_id'             => $this->input->post('bg_id'),
                'country_id'        => $this->input->post('country_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'district_id'       => $this->input->post('district_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'hostel_required'   => $this->input->post('hostel_required'),
                'father_name'       => ucwords(strtolower(ucwords($this->input->post('father_name')))),
                'father_cnic'       => $this->input->post('father_cnic'),
                'land_line_no'      => $this->input->post('land_line_no'),
                'applicant_mob_no1' => $this->input->post('applicant_mob_no1'),
                'std_mobile_network'=> $this->input->post('mobile_network_student'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'occ_id'            => $this->input->post('occ_id'),
                'annual_income'     => $this->input->post('annual_income'),
                'app_postal_address'=> $this->input->post('app_postal_address'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'father_email'      => $this->input->post('father_email'),
                'guardian_name'     => ucwords(strtolower(ucwords($this->input->post('guardian_name')))),
                'guardian_cnic'     => $this->input->post('guardian_cnic'),
                'g_annual_income'   => $this->input->post('g_annual_income'),
                'g_land_no'         => $this->input->post('g_land_no'),
                'g_mobile_no'       => $this->input->post('g_mobile_no'),
                'g_postal_address'  => $this->input->post('g_postal_address'),
                'g_email'           => $this->input->post('g_email'),
                'e_person_relation' => $this->input->post('e_person_relation'),
                'e_person_contact1' => $this->input->post('e_person_contact1'),
                'e_person_contact2' => $this->input->post('e_person_contact2'),
                's_status_id'       => $this->input->post('s_status_id'),
                'bank_receipt_no'   => $this->input->post('bank_receipt_no'),
                'admission_date'    => date('Y-m-d', strtotime($admission_date)),
                'admission_comment' => $this->input->post('admission_comment'),
                'updated_by_user'   => $this->userInfo->user_id,
                'updated_datetime'  => date('Y-m-d H:i:s'),
                'physical_status_id'        =>$this->input->post('physical_status_id'),
                'emargency_person_name'     =>ucwords(strtolower(ucwords($this->input->post('emargency_person_name')))),
                'relation_with_guardian'    => $this->input->post('relation_with_guardian'),
                'guardian_occupation'       => $this->input->post('guardian_occupation'),
            );
            $this->CRUDModel->update('student_record',$data_post,array('student_id'=>$uri));
                $batch_id           = $this->input->post('batch_id');
                $programe_id        = $this->input->post('programe_id');
                $sub_pro_id         = $this->input->post('sub_pro_id');
                $student_name       = $this->input->post('student_name');
                $form_no            = $this->input->post('form_no');
                $college_no         = $this->input->post('college_no');
                $rseats_id          = $this->input->post('rseats_id');
                $domicile_id        = $this->input->post('domicile_id');
                $mobile_no          = $this->input->post('mobile_no');
                $mobile_no2         = $this->input->post('mobile_no2');
                $old_programe_id    = $this->input->post('old_programe_id');
                $old_sub_pro_id     = $this->input->post('old_sub_pro_id');
                $old_batch_id       = $this->input->post('old_batch_id');
                $old_domicile_id    = $this->input->post('old_domicile_id');
                $old_student_name   = $this->input->post('old_student_name');
                $old_form_no        = $this->input->post('old_form_no');
                $old_college_no     = $this->input->post('old_college_no');
                $old_rseats_id      = $this->input->post('old_rseats_id');
                $old_mobile_no      = $this->input->post('old_mobile_no');
                $old_mobile_no2     = $this->input->post('old_mobile_no2');
			
			if($programe_id != $old_programe_id):
				$old_p = $old_programe_id;
			else:
				$old_p = 'NULL';	
			endif;
			if($batch_id != $old_batch_id):
				$old_b = $old_batch_id;
			else:
				$old_b = 'NULL';	
			endif;
			if($sub_pro_id != $old_sub_pro_id):
				$old_sp = $old_sub_pro_id;
			else:
				$old_sp = 'NULL';	
			endif;
			if($form_no != $old_form_no):
				$old_f = $old_form_no;
			else:
				$old_f = 'NULL';	
			endif;
			if($college_no != $old_college_no):
				$old_c = $old_college_no;
			else:
				$old_c = 'NULL';	
			endif;
			if($rseats_id != $old_rseats_id):
				$old_r = $old_rseats_id;
			else:
				$old_r = 'NULL';	
			endif;
			if($student_name != $old_student_name):
				$old_sn = $old_student_name;
			else:
				$old_sn = 'NULL';	
			endif;
			if($mobile_no != $old_mobile_no):
				$old_m = $old_mobile_no;
			else:
				$old_m = 'NULL';	
			endif;
			if($mobile_no2 != $old_mobile_no2):
				$old_mb = $old_mobile_no2;
			else:
				$old_mb = 'NULL';	
			endif;
			if($domicile_id != $old_domicile_id):
				$old_dm = $old_domicile_id;
			else:
				$old_dm = 'NULL';	
			endif;
            $data_log = array(
                   'student_id'=>$uri,
                   'batch_id'=>$old_b,
                   'programe_id'=>$old_p,
                   'sub_pro_id'=>$old_sp,
                   'form_no'=>$old_f,
                   'college_no'=>$old_c,
                   'rseats_id'=>$old_r,
                   'student_name'=>$old_sn,
                   'domicile_id'=>$old_dm,
                   'mobile_no'=>$old_m,
                   'mobile_no2'=>$old_mb,
                   'user_id'=>$this->userInfo->user_id
                );
            $this->CRUDModel->insert('student_record_logs',$data_log);
            redirect('IELTSLanguageRecords');
        }
        
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>19));
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>19));
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'19'));
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Reserved Seats ', 'rseat_id', 'name'); 
        $this->data['student_lang']     = $this->CRUDModel->dropDown('student_status_lang', ' Reserved Seats ', 'lang_status_id', 'name'); 
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title'); 
        $this->data['marital']          = $this->CRUDModel->dropDown('marital_status', 'Marital Status', 'marital_status_id', 'title'); 
        $this->data['bloodGroup']       = $this->CRUDModel->dropDown('blood_group', 'Blood Group', 'b_group_id', 'title'); 
        $this->data['country']          = $this->CRUDModel->dropDown('country', 'Country', 'country_id', 'name'); 
        $this->data['domicile']         = $this->CRUDModel->dropDown('domicile', 'Domicile', 'domicile_id', 'name'); 
        $this->data['district']         = $this->CRUDModel->dropDown('district', 'District', 'district_id', 'name'); 
        $this->data['religion']         = $this->CRUDModel->dropDown('religion', 'Religion', 'religion_id', 'title'); 
        $this->data['occupation']       = $this->CRUDModel->dropDown('occupation', 'Occupation', 'occ_id', 'title'); 
        $this->data['relation']         = $this->CRUDModel->dropDown('relation', 'Relation', 'relation_id', 'title'); 
        $this->data['physical_status']  = $this->CRUDModel->dropDown('physical_status', 'Physical Status', 'ps_id', 'title'); 
        
        $this->data['page_header']      = 'Update IELTS Student';
        $this->data['page_title']       = 'Update IELTS Student | ECMS';
        $this->data['page']             = 'Languages/IELTS/update_IELTS_language_student';
        $this->load->view('common/common',$this->data);
    }
}

 