<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
//require_once APPPATH."third_party\PHPExcel.php"; 

class GuiController extends AdminController 
{

     public function __construct() 
     {
         parent::__construct();
         $this->load->model('CRUDModel');
         $this->load->model('GuiModel');
         $this->load->model('ReportsModel');
         $this->load->model('AttendanceModel');
         $this->load->library("pagination");     
    }
    
    
     public function teachers_attendance(){ 
         
        $this->data['teachers_attend'] = $this->GuiModel->empAttendanceDatas();
//        echo '<pre>';print_r($this->data['teachers_attend']);die;
        $p_attend = $this->GuiModel->empAttendanceData();
        $p_absent = $this->GuiModel->empAbsentData();
//        
        if(!empty($p_attend)):
            $this->data['difference'] = array_diff($p_absent,$p_attend);
        endif;
        
        $this->data['in_date']  = '';
        
        if($this->input->post('search')):
            $in_date =  $this->input->post('in_date');
            if(!empty($in_date)):
                $where['teacher_attendance.in_date'] = $in_date;
                $this->data['in_date'] =$in_date;
            endif;
            $this->data['teachers_attend'] = $this->GuiModel->empAttendanceDataWhere($where);
//        echo '<pre>';print_r($this->data['teachers_attend']);die;
            $p_attend = $this->GuiModel->empAttenDataWhere($where);
            $p_absent = $this->GuiModel->empAbsentDataWhere();
            if(!empty($p_attend)):
                $this->data['difference'] = array_diff($p_absent,$p_attend);
            endif;
        endif;
        
        $this->data['page_title']   = 'Teachers Attendance Report | ECMS';
        $this->data['page']         = 'Gui/teachers_attendance';
        $this->load->view('commonGui/commonGui',$this->data);    
    }
    
    public function employee_details(){
        $id = $this->uri->segment(2);
        $this->data['emp_id'] = $id;
        $where = array('hr_emp_record.emp_id'=>$id);
        $where1 = array('emp_id'=>$id);
        $this->data['result']           = $this->GuiModel->profileEmployee($where);
        $this->data['employee_records'] = $this->GuiModel->hr_edu_record($where);
        $this->data['research'] = $this->CRUDModel->get_where_result('hr_research_paper',$where1);
        $this->data['professional'] = $this->CRUDModel->get_where_result('hr_professional_edu',$where1);
        $this->data['page_title']       = 'Employee Details | ECMS';
        $this->data['page']             = 'Gui/employee_details';
        $this->load->view('commonGui/commonGui',$this->data);
    }
    
    public function faculty_report(){
        
        $this->data['category']    = $this->CRUDModel->dropDown('hr_emp_category', 'Staff Category', 'cat_id', 'title');
        $this->data['contract'] = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Select Type', 'contract_type_id', 'title');       
        
        $this->data['cat_id']  = '';
        $this->data['contract_type_id']  = '';
        
        if($this->input->post('search')):
        $cat_id      =  $this->input->post('cat_id');
        $contract_type_id =  $this->input->post('contract_type_id');
        //like Array
        $like = '';
        $where = '';
            
        if(!empty($contract_type_id)):
            $where['hr_emp_record.contract_type_id'] = $contract_type_id;
            $this->data['contract_type_id']  = $contract_type_id;
        endif;
        if(!empty($cat_id)):
            $where['hr_emp_record.cat_id'] = $cat_id;
            $this->data['cat_id']  = $cat_id;
        endif;                                                     
        $this->data['result'] = $this->GuiModel->getTEmployee('hr_emp_record',$where);  
        endif;
        $this->data['page_title'] = 'Teaching & Non Teaching Staff Report | ECMS';
        $this->data['page']       = 'Gui/employee_report';
        $this->load->view('commonGui/commonGui',$this->data);    
    }
    
    public function view_research_paper()
    {
       $id = $this->uri->segment(3);
       if($id):
            $where = array('rp_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_research_paper',$where);
            $this->data['page_title'] = 'View Research Paper | ECMS';
            $this->data['page']       = 'Gui/view_research_paper';
            $this->load->view('commonGui/commonGui',$this->data);
        endif; 
    }
    
    public function view_professional_edu()
    {
       $id = $this->uri->segment(3);
       if($id):
            $where = array('fe_id'=>$id);
            $this->data['result'] = $this->CRUDModel->get_where_row('hr_professional_edu',$where);
            $this->data['page_title'] = 'View Professional Education | ECMS';
            $this->data['page']       = 'Gui/view_professional_edu';
            $this->load->view('commonGui/commonGui',$this->data);
        endif; 
    }
    
    
    public function faculty_members()
    {
        $this->data['department']    = $this->CRUDModel->dropDown('department', 'Department', 'department_id', 'title');
        $this->data['gender']    = $this->CRUDModel->dropDown('gender', 'Gender', 'gender_id', 'title');
        $this->data['scale']    = $this->CRUDModel->dropDown('hr_emp_scale', 'Scale', 'emp_scale_id', 'title');
        $this->data['designation']    = $this->CRUDModel->dropDown('hr_emp_designation', 'Designation', 'emp_desg_id', 'title');
        $this->data['contract']    = $this->CRUDModel->dropDown('hr_emp_contract_type', 'Contract Type', 'contract_type_id', 'title');
        $this->data['status']    = $this->CRUDModel->dropDown('hr_emp_status', 'Status', 'emp_status_id', 'title');
        $this->data['category']    = $this->CRUDModel->dropDown('hr_emp_category', 'Category', 'cat_id', 'title');
        
        $this->data['emp_name'] = '';
        $this->data['father_name']  = '';
        $this->data['gender_id']  = '';
        $this->data['department_id']  = '';
        $this->data['current_designation']  = '';
        $this->data['c_emp_scale_id']  = '';
        $this->data['contract_type_id']  = '';
        $this->data['emp_status_id']  = '';
        $this->data['cat_id']  = '';
        
        if($this->input->post('search')):
        $emp_name            =  $this->input->post('emp_name');
        $father_name         =  $this->input->post('father_name');
        $gender_id           =  $this->input->post('gender_id');
        $department_id       =  $this->input->post('department_id');
        $current_designation =  $this->input->post('current_designation');
        $c_emp_scale_id      =  $this->input->post('c_emp_scale_id');
        $emp_status_id       =  $this->input->post('emp_status_id');
        $cat_id              =  $this->input->post('cat_id');
        $contract_type_id    =  $this->input->post('contract_type_id');
        //like Array
        $like = '';
        $where = '';
        
            if(!empty($emp_name)):
                $like['emp_name'] = $emp_name;
                $this->data['emp_name'] =$emp_name;
            endif;
            if(!empty($father_name)):
                $like['father_name'] = $father_name;
            $this->data['father_name'] =$father_name;
            endif;
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($department_id)):
                $where['department.department_id'] = $department_id;
                $this->data['department_id']  = $department_id;
            endif;
            if(!empty($current_designation)):
                $where['hr_emp_designation.emp_desg_id'] = $current_designation;
                $this->data['current_designation']  = $current_designation;
            endif;
            if(!empty($emp_status_id)):
                $where['hr_emp_record.emp_status_id'] = $emp_status_id;
                $this->data['emp_status_id']  = $emp_status_id;
            endif;
            if(!empty($cat_id)):
                $where['hr_emp_record.cat_id'] = $cat_id;
                $this->data['cat_id']  = $cat_id;
            endif;
            if(!empty($c_emp_scale_id)):
                $where['hr_emp_scale.emp_scale_id'] = $c_emp_scale_id;
                $this->data['c_emp_scale_id']  = $c_emp_scale_id;
            endif;
            if(!empty($contract_type_id)):
                $where['hr_emp_record.contract_type_id'] = $contract_type_id;
                $this->data['contract_type_id']  = $contract_type_id;
            endif;
                $this->data['faculty_members'] = $this->GuiModel->get_empData('hr_emp_record',$where,$like);
        else:
         $where = array('hr_emp_record.emp_status_id'=>1);
        $this->data['faculty_members'] = $this->GuiModel->teaching_staff($where);
        endif;
        $this->data['page_title']   = 'Faculty Members Record | ECMS';
        $this->data['page']         = 'Gui/faculty_members';
        $this->load->view('commonGui/commonGui',$this->data);    
    }
    
    public function gui_dashobard(){
     
        
        //Fa/Fsc_part I Morning
        $whereGenderI['student_record.programe_id']      = 1;
        $whereGenderI['student_status.s_status_id']      = 5;
        $where_in_first = array(1,2,4,5);
        $this->data['gender_1st_year_mor'] = $this->GuiModel->year_wise_gender_report($whereGenderI,$where_in_first);
        //Fa/Fsc_part I Evening
        $whereGenderI['student_record.batch_id']        = 34;
        $whereGenderI['student_record.programe_id']     = 1;
        $whereGenderI['student_status.s_status_id']     = 5;
        $whereGenderI['sections.shift_id']              = 2;
        $this->data['gender_1st_year_eve'] = $this->GuiModel->year_wise_gender_report($whereGenderI);
        //Fa/Fsc_part II Morning
        $whereGenderII['student_record.programe_id']    = 1;
        $whereGenderII['student_status.s_status_id']    = 5;
        $where_in_second = array(24,25,26,27);
        
        $this->data['gender_2nd_year_mor'] = $this->GuiModel->year_wise_gender_report($whereGenderII,$where_in_second);
        //Fa/Fsc_part II Evening
        $whereGenderII['student_record.batch_id']       = 19;
        $whereGenderII['student_record.programe_id']    = 1;
        $whereGenderII['student_status.s_status_id']    = 5;
         $whereGenderII['sections.shift_id']            = 2;
        $this->data['gender_2nd_year_eve'] = $this->GuiModel->year_wise_gender_report($whereGenderII);
        
    //BSC 3rd Year 
        $whereGenderBSC_3rd_m['student_record.batch_id']    = 24;
        $whereGenderBSC_3rd_m['student_record.programe_id'] = 4;
        $whereGenderBSC_3rd_m['student_status.s_status_id'] = 5;
        $where_in_3rd = array(30,31);
        $this->data['BSC_3rd'] = $this->GuiModel->year_wise_gender_report($whereGenderBSC_3rd_m,$where_in_3rd);
        
    //BSC 4rd Year 
        $whereGenderBSC_4th_m['student_record.programe_id'] = 4;
        $whereGenderBSC_4th_m['student_status.s_status_id'] = 5;
        $where_in_4th = array(29,35,36);
        $this->data['BSC_4th'] = $this->GuiModel->year_wise_gender_report($whereGenderBSC_4th_m,$where_in_4th);
        
    //BA 3rd Year 
        $whereBA_3rd['student_record.batch_id']     = 24;
        $whereBA_3rd['student_record.programe_id']  = 4;
        $whereBA_3rd['student_status.s_status_id']  = 5;
        $where_in_3rd_ba = array(28);
        $this->data['Ba_3rd'] = $this->GuiModel->year_wise_gender_report($whereBA_3rd,$where_in_3rd_ba);
        
    //BA 4th Year 
        $whereBA_4th['student_record.batch_id']     = 14;
        $whereBA_4th['student_record.programe_id']  = 4;
        $whereBA_4th['student_status.s_status_id']  = 5;
        $where_in_4th_ba = array(29);
        $this->data['Ba_4th'] = $this->GuiModel->year_wise_gender_report($whereBA_4th,$where_in_4th_ba);
    //BS (CS) 
        $whereGenderBSCS_m['student_record.programe_id']    = 2;
        $whereGenderBSCS_m['student_status.s_status_id']    = 5;
        $this->data['Bscs_gender_m'] = $this->GuiModel->year_wise_gender_report($whereGenderBSCS_m);
        
        //HND 
//        $whereHND['student_record.batch_id']     = 4;
        $whereHND['student_record.programe_id']  = 3;
        $whereHND['student_record.s_status_id']  = 5;
//        $where_id_HND = array(10,21,22,23);
        $this->data['HND_gender'] = $this->GuiModel->year_wise_gender_report($whereHND);
       //DSMAL
        $whereDSMAL['student_record.programe_id']  = 7;
        $whereDSMAL['student_record.s_status_id']  = 5;
//        $where_id_DSMAL = array(69);
        $this->data['DSMAL_gender'] = $this->GuiModel->year_wise_gender_report($whereDSMAL);
       //BS-English
        $whereBSE['student_record.programe_id']  = 8;
        $whereBSE['student_status.s_status_id']  = 5;
        $where_id_BSE = array(34,42,43,50,51,52,53,54);
        $this->data['BSE_gender'] = $this->GuiModel->year_wise_gender_report($whereBSE,$where_id_BSE);
     //BS-Law   
        $whereBSLAW['student_record.programe_id']  = 9;
        $whereBSLAW['student_status.s_status_id']  = 5;
        $where_id_BSLAW = array(55,56,80,81,91,92,93,94,101,102);
        $this->data['BSLAW_gender'] = $this->GuiModel->year_wise_gender_report($whereBSLAW,$where_id_BSLAW);
        
        //BAA
        $whereBBA['student_record.programe_id']  = 6;
        $whereBBA['student_record.s_status_id']  = 5;
        $where_id_BBA = array(44,45,72,73,74,88,89,90);
        $this->data['BBA_gender'] = $this->GuiModel->year_wise_gender_report($whereBBA,$where_id_BBA);
        
        //BS-Economics
        
        $whereBSEC['student_record.programe_id']  = 14;
        $whereBSEC['student_record.s_status_id']  = 5;
        $where_id_BSEC = array(82,83,95,96,97,98,99,100);
        $this->data['BSECO_gender'] = $this->GuiModel->year_wise_gender_report($whereBSEC,$where_id_BSEC);
        
        $whereAL['student_record.programe_id']  = 5;
        $whereAL['student_status.s_status_id']  = 5;
        $where_id_AL = array(15,16,37,38);
        $this->data['A_Level'] = $this->GuiModel->year_wise_gender_report($whereAL,$where_id_AL);
        
        $whereHSK['student_record.programe_id']  = 10;
        $whereHSK['student_status.s_status_id']  = 5;
        
        $whereGRM['student_record.programe_id']  = 11;
        $whereGRM['student_status.s_status_id']  = 5;
        
        $wherePST['student_record.programe_id']  = 12;
        $wherePST['student_status.s_status_id']  = 5;
        
        $whereENG['student_record.programe_id']  = 13;
        $whereENG['student_status.s_status_id']  = 5;
        
        $where_id_HSK = array(57,58,59,60,61,75);
        $where_id_GRM = array(62,63,64,65,66);
        $where_id_PST = array(67,68,69,70,71);
        $where_id_ENG = array(76,77,78,79);
        
        $this->data['Chinese'] = $this->GuiModel->year_wise_Chines_report($whereHSK,$where_id_HSK);
        $this->data['German'] = $this->GuiModel->year_wise_Chines_report($whereGRM,$where_id_GRM);
        $this->data['Pashto'] = $this->GuiModel->year_wise_Chines_report($wherePST,$where_id_PST);
        $this->data['english'] = $this->GuiModel->year_wise_Chines_report($whereENG,$where_id_ENG);
       
      $this->db->join('sub_programes','sub_programes.programe_id=programes_info.programe_id');
      $this->db->join('prospectus_batch','prospectus_batch.programe_id=programes_info.programe_id');
      $this->db->group_by('batch_id');
      $this->db->order_by('sub_programes.name','asc');
                  $this->db->where_in('programes_info.programe_id',array(5,6,9));
        $alevel = $this->db->get_where('programes_info')->result();
         $result_alevel = array(); 
        foreach($alevel as $al_row):
             
            $whereAL_1['student_record.programe_id']    = $al_row->programe_id;
            $whereAL_1['student_status.s_status_id']    = 5;
            $whereAL_1['student_record.batch_id']       = $al_row->batch_id;
    //        $where_id_AL_1 = array(34,42);
            $ALdetails =$this->GuiModel->year_wise_gender_report($whereAL_1);
            
            $gender_total   = 0;
            $male           = 0;
            $female         = 0;
            foreach($ALdetails as $ALd_row):
                if($ALd_row->gender_id == 1):
                    $male ++;
                else:
                    $female ++;   
                endif;
            $gender_total =$male+$female;
                
                  
            endforeach;
            
            if($gender_total !=''):
                $result_alevel[]    = array(
                        'al_title'      => $al_row->batch_name,
                        'male'          => $male,
                        'female'        => $female,
                        'gender_total'  => $gender_total,
                        
                    ); 
            endif;
             
             endforeach;
            
        $this->data['A_level_record'] = json_decode(json_encode($result_alevel));
        
        //A-level 1st-Year
        $whereAL_1['student_record.programe_id']    = 5;
        $whereAL_1['student_status.s_status_id']    = 5;
        $whereAL_1['student_record.batch_id']       = 25;
 
        $this->data['AL_1_gender'] = $this->GuiModel->year_wise_gender_report($whereAL_1);
        //A-level 2nd-Year
        $whereAL_2['student_record.programe_id']    = 5;
        $whereAL_2['student_status.s_status_id']    = 5;
        $whereAL_2['student_record.batch_id']       = 5;
 
        $this->data['AL_2_gender'] = $this->GuiModel->year_wise_gender_report($whereAL_2);
        
        //BBA 
        $wherebba['student_record.programe_id']    = 6;
        $wherebba['student_status.s_status_id']    = 5;
//        $wherebba['student_record.batch_id']       = 5;
 
        $this->data['bba'] = $this->GuiModel->year_wise_gender_report($wherebba);
 
        //BBA 
        $wherelaw['student_record.programe_id']    = 9;
        $wherelaw['student_status.s_status_id']    = 5;
        
        $whereChina['student_record.programe_id']    = 10;
        $whereChina['student_status.s_status_id']    = 5;
        
        $whereGRMn['student_record.programe_id']    = 11;
        $whereGRMn['student_status.s_status_id']    = 5;
        
        $wherePasht['student_record.programe_id']    = 12;
        $wherePasht['student_status.s_status_id']    = 5;
        
        $whereECO['student_record.programe_id']    = 14;
        $whereECO['student_status.s_status_id']    = 5;
 
        $this->data['law'] = $this->GuiModel->year_wise_gender_report($wherelaw);
        $this->data['economics'] = $this->GuiModel->year_wise_gender_report($whereECO);
        $this->data['China'] = $this->GuiModel->year_wise_Chines_report($whereChina);
        $this->data['Germn'] = $this->GuiModel->year_wise_Chines_report($whereGRMn);
        $this->data['Pasht'] = $this->GuiModel->year_wise_Chines_report($wherePasht);
       
        $this->data['gernal_report'] = $this->GuiModel->student_general_report();
  
        $this->data['all_students']             = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5)));
        $this->data['all_male_student']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>1)));
        $this->data['all_female_student']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>2)));
        
        $this->data['open']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>1)));
        $this->data['Minority']     = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>2)));
        $this->data['O_level']      = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>3)));
        $this->data['HEQ']          = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>4)));
        $this->data['disable']      = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>5)));
        $this->data['es']           = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>6)));
        $this->data['fata']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>7)));
        $this->data['os']           = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>8)));
        $this->data['sport']        = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>9)));
        $this->data['girls']        = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>11)));
        $this->data['SC']           = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>12)));
        $this->data['Blc']          = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>13)));
      
        
        $this->data['fa_fsc']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>1)));
        $this->data['bscs']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>2)));
        $this->data['hnd']          = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>3)));
        $this->data['degree']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>4)));
        $this->data['alevel']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>5)));
        $this->data['law_llb']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>9)));
        $this->data['bs_eng']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>8)));
        $this->data['bba_hnr']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>6)));
        $this->data['edcml']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>7)));
        $this->data['HSKN']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>10)));
        $this->data['GRMN']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>11)));
        $this->data['PSTN']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>12)));
        $this->data['ENGL']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>13)));
        
        //Fa/Fsc_part I
       // $whereInter_Part1['sections.batch_id']              = 19;
        $whereInter_Part1['student_record.programe_id']     = 1;
        $whereInter_Part1['student_record.s_status_id']     = 5;
         
        $field_part = 'sections.name as sectionName,count(sections.sec_id) as student_count';
        $where_in_fsub = array(1,2,4,5);
        $where_in_ssub = array(24,25,26,27);
    
        $this->data['fa_fsc_part_1']    = $this->GuiModel->count_grand_report($field_part,$whereInter_Part1,$where_in_fsub);
        
        $whereInter_Part2['student_record.programe_id']     = 1;
        $whereInter_Part2['student_record.s_status_id']     = 5;
        
     
        $this->data['fa_fsc_part_2']     = $this->GuiModel->count_grand_reports($field_part,$whereInter_Part2,$where_in_ssub);
       
        $wherebscs['student_record.programe_id']        = 2;
        $wherebscs['student_record.s_status_id']        = 5;
        
        //BSCS 
        $this->data['bscs_clases']       = $this->GuiModel->count_grand_report($field_part,$wherebscs);
       
        //HND
        $whereHND['student_record.programe_id']     = 3;
        $whereHND['student_record.s_status_id']     = 5;
     
        $this->data['HND']            = $this->GuiModel->count_grand_report($field_part,$whereHND);
        
        $whereBBA['student_record.programe_id']     = 6;
        $whereBBA['student_record.s_status_id']     = 5;
     
        $this->data['BBA'] = $this->GuiModel->count_grand_report($field_part,$whereBBA);
        
        $whereEC['student_record.programe_id']     = 14;
        $whereEC['student_record.s_status_id']     = 5;
     
        $this->data['Economics'] = $this->GuiModel->count_grand_report($field_part,$whereEC);
        
        $whereEDSML['student_record.programe_id']     = 7;
        $whereEDSML['student_record.s_status_id']     = 5;
     
        $this->data['EDSML'] = $this->GuiModel->count_grand_report($field_part,$whereEDSML);
        
//        echo '<pre>';print_r($this->data['EDSML']);die;
        $whereEnglish['student_record.programe_id']     = 8;
        $whereEnglish['student_record.s_status_id']     = 5;
     
        $this->data['BSEnglish'] = $this->GuiModel->count_grand_report($field_part,$whereEnglish);
        
        $whereLAW['student_record.programe_id']     = 9;
        $whereLAW['student_record.s_status_id']     = 5;
     
        $this->data['LAW'] = $this->GuiModel->count_grand_report($field_part,$whereLAW);
     
        //Degree
        $whereDegree['student_record.programe_id']    = 4;
        $whereDegree['student_record.s_status_id']    = 5;
     
        $this->data['Degree']            = $this->GuiModel->count_grand_report($field_part,$whereDegree);
        
        //A-level
        $whereAlevel['student_record.programe_id']    = 5;
        $whereAlevel['student_record.s_status_id']    = 5;
 
        $this->data['Alevel']            = $this->GuiModel->count_grand_report($field_part,$whereAlevel);
  
        
        $this->data['male']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>1)));
        $this->data['female']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>2)));
        $this->data['all_employee']               =  $this->CRUDModel->get_where_result('hr_emp_record',array('emp_status_id'=>1));
  
        $this->data['religion_base'] = $this->GuiModel->religion_base();
        
        $this->data['page_title']   = 'GUI Dashboard | ECMS';
        $this->data['page']         = 'Gui/dashboard';
//            echo '<pre>';print_r($this->data['religion_base'] );die;
        $this->load->view('commonGui/commonGui',$this->data);   
    }   
    
    public function gui_dashobard_auditor(){
     
        //Fa/Fsc_part I Morning
        $whereGenderI['student_record.programe_id']      = 1;
        $whereGenderI['student_status.s_status_id']      = 5;
        $where_in_first = array(1,2,4,5);
        $this->data['gender_1st_year_mor'] = $this->GuiModel->year_wise_gender_report($whereGenderI,$where_in_first);
        //Fa/Fsc_part I Evening
        $whereGenderI['student_record.batch_id']        = 34;
        $whereGenderI['student_record.programe_id']     = 1;
        $whereGenderI['student_status.s_status_id']     = 5;
        $whereGenderI['sections.shift_id']              = 2;
        $this->data['gender_1st_year_eve'] = $this->GuiModel->year_wise_gender_report($whereGenderI);
        //Fa/Fsc_part II Morning
        $whereGenderII['student_record.programe_id']    = 1;
        $whereGenderII['student_status.s_status_id']    = 5;
        $where_in_second = array(24,25,26,27);
        
        $this->data['gender_2nd_year_mor'] = $this->GuiModel->year_wise_gender_report($whereGenderII,$where_in_second);
        //Fa/Fsc_part II Evening
        $whereGenderII['student_record.batch_id']       = 19;
        $whereGenderII['student_record.programe_id']    = 1;
        $whereGenderII['student_status.s_status_id']    = 5;
         $whereGenderII['sections.shift_id']            = 2;
        $this->data['gender_2nd_year_eve'] = $this->GuiModel->year_wise_gender_report($whereGenderII);
        
    //BSC 3rd Year 
        $whereGenderBSC_3rd_m['student_record.batch_id']    = 24;
        $whereGenderBSC_3rd_m['student_record.programe_id'] = 4;
        $whereGenderBSC_3rd_m['student_status.s_status_id'] = 5;
        $where_in_3rd = array(30,31);
        $this->data['BSC_3rd'] = $this->GuiModel->year_wise_gender_report($whereGenderBSC_3rd_m,$where_in_3rd);
        
    //BSC 4rd Year 
        $whereGenderBSC_4th_m['student_record.programe_id'] = 4;
        $whereGenderBSC_4th_m['student_status.s_status_id'] = 5;
        $where_in_4th = array(29,35,36);
        $this->data['BSC_4th'] = $this->GuiModel->year_wise_gender_report($whereGenderBSC_4th_m,$where_in_4th);
        
    //BA 3rd Year 
        $whereBA_3rd['student_record.batch_id']     = 24;
        $whereBA_3rd['student_record.programe_id']  = 4;
        $whereBA_3rd['student_status.s_status_id']  = 5;
        $where_in_3rd_ba = array(28);
        $this->data['Ba_3rd'] = $this->GuiModel->year_wise_gender_report($whereBA_3rd,$where_in_3rd_ba);
        
    //BA 4th Year 
        $whereBA_4th['student_record.batch_id']     = 14;
        $whereBA_4th['student_record.programe_id']  = 4;
        $whereBA_4th['student_status.s_status_id']  = 5;
        $where_in_4th_ba = array(29);
        $this->data['Ba_4th'] = $this->GuiModel->year_wise_gender_report($whereBA_4th,$where_in_4th_ba);
    //BS (CS) 
        $whereGenderBSCS_m['student_record.programe_id']    = 2;
        $whereGenderBSCS_m['student_status.s_status_id']    = 5;
        $this->data['Bscs_gender_m'] = $this->GuiModel->year_wise_gender_report($whereGenderBSCS_m);
        
        //HND 
//        $whereHND['student_record.batch_id']     = 4;
        $whereHND['student_record.programe_id']  = 3;
        $whereHND['student_record.s_status_id']  = 5;
//        $where_id_HND = array(10,21,22,23);
        $this->data['HND_gender'] = $this->GuiModel->year_wise_gender_report($whereHND);
       //DSMAL
        $whereDSMAL['student_record.programe_id']  = 7;
        $whereDSMAL['student_record.s_status_id']  = 5;
//        $where_id_DSMAL = array(69);
        $this->data['DSMAL_gender'] = $this->GuiModel->year_wise_gender_report($whereDSMAL);
       //BS-English
        $whereBSE['student_record.programe_id']  = 8;
        $whereBSE['student_status.s_status_id']  = 5;
        $where_id_BSE = array(34,42,43,50,51);
        $this->data['BSE_gender'] = $this->GuiModel->year_wise_gender_report($whereBSE,$where_id_BSE);
        
        $whereBSLAW['student_record.programe_id']  = 9;
        $whereBSLAW['student_status.s_status_id']  = 5;
        $where_id_BSLAW = array(55,56,80,81,91,92,93,94);
        $this->data['BSLAW_gender'] = $this->GuiModel->year_wise_gender_report($whereBSLAW,$where_id_BSLAW);
        
        //BAA
        $whereBBA['student_record.programe_id']  = 6;
        $whereBBA['student_record.s_status_id']  = 5;
        $where_id_BBA = array(44,45,72,73,74,88,89,90);
        $this->data['BBA_gender'] = $this->GuiModel->year_wise_gender_report($whereBBA,$where_id_BBA);
        
        //BS-Economics
        $whereBSEC['student_record.programe_id']  = 14;
        $whereBSEC['student_record.s_status_id']  = 5;
        $where_id_BSEC = array(82,83,95,96,97,98,99,100);
        $this->data['BSECO_gender'] = $this->GuiModel->year_wise_gender_report($whereBSEC,$where_id_BSEC);
        
        //BS-Political Science
        $whereBSEC['student_record.programe_id']  = 17;
        $whereBSEC['student_record.s_status_id']  = 5;
        $where_id_BSEC = array(104,105,106,107,108,109,110,111);
        $this->data['BSPOL_gender'] = $this->GuiModel->year_wise_gender_report($whereBSEC,$where_id_BSEC);
        
        $whereAL['student_record.programe_id']  = 5;
        $whereAL['student_status.s_status_id']  = 5;
        $where_id_AL = array(15,16,37,38);
        $this->data['A_Level'] = $this->GuiModel->year_wise_gender_report($whereAL,$where_id_AL);
        
        $whereHSK['student_record.programe_id']  = 10;
        $whereHSK['student_status.s_status_id']  = 5;
        
        $whereGRM['student_record.programe_id']  = 11;
        $whereGRM['student_status.s_status_id']  = 5;
        
        $wherePST['student_record.programe_id']  = 12;
        $wherePST['student_status.s_status_id']  = 5;
        
        $whereENG['student_record.programe_id']  = 13;
        $whereENG['student_status.s_status_id']  = 5;
        
        $where_id_HSK = array(57,58,59,60,61,75);
        $where_id_GRM = array(62,63,64,65,66);
        $where_id_PST = array(67,68,69,70,71);
        $where_id_ENG = array(76,77,78,79);
        
        $this->data['Chinese'] = $this->GuiModel->year_wise_Chines_report($whereHSK,$where_id_HSK);
        $this->data['German'] = $this->GuiModel->year_wise_Chines_report($whereGRM,$where_id_GRM);
        $this->data['Pashto'] = $this->GuiModel->year_wise_Chines_report($wherePST,$where_id_PST);
        $this->data['english'] = $this->GuiModel->year_wise_Chines_report($whereENG,$where_id_ENG);
       
      $this->db->join('sub_programes','sub_programes.programe_id=programes_info.programe_id');
      $this->db->join('prospectus_batch','prospectus_batch.programe_id=programes_info.programe_id');
      $this->db->group_by('batch_id');
      $this->db->order_by('sub_programes.name','asc');
                  $this->db->where_in('programes_info.programe_id',array(5,6,9));
        $alevel = $this->db->get_where('programes_info')->result();
         $result_alevel = array(); 
        foreach($alevel as $al_row):
             
            $whereAL_1['student_record.programe_id']    = $al_row->programe_id;
            $whereAL_1['student_status.s_status_id']    = 5;
            $whereAL_1['student_record.batch_id']       = $al_row->batch_id;
    //        $where_id_AL_1 = array(34,42);
            $ALdetails =$this->GuiModel->year_wise_gender_report($whereAL_1);
            
            $gender_total   = 0;
            $male           = 0;
            $female         = 0;
            foreach($ALdetails as $ALd_row):
            
                    
               
                 if($ALd_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;
                  $gender_total =$male+$female;
                
                  
            endforeach;
            
            if($gender_total !=''):
                $result_alevel[]    = array(
                        'al_title'      => $al_row->batch_name,
                        'male'          => $male,
                        'female'        => $female,
                        'gender_total'  => $gender_total,
                        
                    ); 
            endif;
             
             endforeach;
            
        $this->data['A_level_record'] = json_decode(json_encode($result_alevel));
        
        //A-level 1st-Year
        $whereAL_1['student_record.programe_id']    = 5;
        $whereAL_1['student_status.s_status_id']    = 5;
        $whereAL_1['student_record.batch_id']       = 25;
 
        $this->data['AL_1_gender'] = $this->GuiModel->year_wise_gender_report($whereAL_1);
        //A-level 2nd-Year
        $whereAL_2['student_record.programe_id']    = 5;
        $whereAL_2['student_status.s_status_id']    = 5;
        $whereAL_2['student_record.batch_id']       = 5;
 
        $this->data['AL_2_gender'] = $this->GuiModel->year_wise_gender_report($whereAL_2);
        
        //BBA 
        $wherebba['student_record.programe_id']    = 6;
        $wherebba['student_status.s_status_id']    = 5;
//        $wherebba['student_record.batch_id']       = 5;
 
        $this->data['bba'] = $this->GuiModel->year_wise_gender_report($wherebba);
 
        //BBA 
        $wherelaw['student_record.programe_id']    = 9;
        $wherelaw['student_status.s_status_id']    = 5;
        
        $whereChina['student_record.programe_id']    = 10;
        $whereChina['student_status.s_status_id']    = 5;
        
        $whereGRMn['student_record.programe_id']    = 11;
        $whereGRMn['student_status.s_status_id']    = 5;
        
        $wherePasht['student_record.programe_id']    = 12;
        $wherePasht['student_status.s_status_id']    = 5;
        
        $whereECO['student_record.programe_id']    = 14;
        $whereECO['student_status.s_status_id']    = 5;
        
        $wherePOL['student_record.programe_id']    = 17;
        $wherePOL['student_status.s_status_id']    = 5;
 
        $this->data['law'] = $this->GuiModel->year_wise_gender_report($wherelaw);
        $this->data['economics'] = $this->GuiModel->year_wise_gender_report($whereECO);
        $this->data['pol_science'] = $this->GuiModel->year_wise_gender_report($wherePOL);
        $this->data['China'] = $this->GuiModel->year_wise_Chines_report($whereChina);
        $this->data['Germn'] = $this->GuiModel->year_wise_Chines_report($whereGRMn);
        $this->data['Pasht'] = $this->GuiModel->year_wise_Chines_report($wherePasht);
       
        $this->data['gernal_report'] = $this->GuiModel->student_general_report();
  
        $this->data['all_students']             = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5)));
        $this->data['all_male_student']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>1)));
        $this->data['all_female_student']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>2)));
        
        $this->data['open']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>1)));
        $this->data['Minority']     = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>2)));
        $this->data['O_level']      = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>3)));
        $this->data['HEQ']          = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>4)));
        $this->data['disable']      = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>5)));
        $this->data['es']           = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>6)));
        $this->data['fata']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>7)));
        $this->data['os']           = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>8)));
        $this->data['sport']        = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>9)));
        $this->data['girls']        = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>11)));
        $this->data['SC']           = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>12)));
        $this->data['Blc']          = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'rseats_id2'=>13)));
      
        
        $this->data['fa_fsc']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>1)));
        $this->data['bscs']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>2)));
        $this->data['hnd']          = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>3)));
        $this->data['degree']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>4)));
        $this->data['alevel']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>5)));
        $this->data['law_llb']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>9)));
        $this->data['bs_eng']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>8)));
        $this->data['bs_eco']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>14)));
        $this->data['bs_pol']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>17)));
        $this->data['bba_hnr']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>6)));
        $this->data['edcml']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>7)));
        $this->data['HSKN']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>10)));
        $this->data['GRMN']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>11)));
        $this->data['PSTN']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>12)));
        $this->data['ENGL']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'programe_id'=>13)));
        
        //Fa/Fsc_part I
       // $whereInter_Part1['sections.batch_id']              = 19;
        $whereInter_Part1['student_record.programe_id']     = 1;
        $whereInter_Part1['student_record.s_status_id']     = 5;
         
        $field_part = 'sections.name as sectionName,count(sections.sec_id) as student_count';
        $where_in_fsub = array(1,2,4,5);
        $where_in_ssub = array(24,25,26,27);
    
        $this->data['fa_fsc_part_1']    = $this->GuiModel->count_grand_report($field_part,$whereInter_Part1,$where_in_fsub);
        
        $whereInter_Part2['student_record.programe_id']     = 1;
        $whereInter_Part2['student_record.s_status_id']     = 5;
        
     
        $this->data['fa_fsc_part_2']     = $this->GuiModel->count_grand_reports($field_part,$whereInter_Part2,$where_in_ssub);
       
        $wherebscs['student_record.programe_id']        = 2;
        $wherebscs['student_record.s_status_id']        = 5;
        
        //BSCS 
        $this->data['bscs_clases']       = $this->GuiModel->count_grand_report($field_part,$wherebscs);
       
        //HND
        $whereHND['student_record.programe_id']     = 3;
        $whereHND['student_record.s_status_id']     = 5;
     
        $this->data['HND']            = $this->GuiModel->count_grand_report($field_part,$whereHND);
        
        $whereBBA['student_record.programe_id']     = 6;
        $whereBBA['student_record.s_status_id']     = 5;
     
        $this->data['BBA'] = $this->GuiModel->count_grand_report($field_part,$whereBBA);
        
        $whereEC['student_record.programe_id']     = 14;
        $whereEC['student_record.s_status_id']     = 5;
     
        $this->data['Economics'] = $this->GuiModel->count_grand_report($field_part,$whereEC);
        
        $wherePL['student_record.programe_id']     = 17;
        $wherePL['student_record.s_status_id']     = 5;
     
        $this->data['PolScience'] = $this->GuiModel->count_grand_report($field_part,$wherePL);
        
        $whereEDSML['student_record.programe_id']     = 7;
        $whereEDSML['student_record.s_status_id']     = 5;
     
        $this->data['EDSML'] = $this->GuiModel->count_grand_report($field_part,$whereEDSML);
        
        $whereEnglish['student_record.programe_id']     = 8;
        $whereEnglish['student_record.s_status_id']     = 5;
     
        $this->data['BSEnglish'] = $this->GuiModel->count_grand_report($field_part,$whereEnglish);
        
        $whereLAW['student_record.programe_id']     = 9;
        $whereLAW['student_record.s_status_id']     = 5;
     
        $this->data['LAW'] = $this->GuiModel->count_grand_report($field_part,$whereLAW);
     
        //Degree
        $whereDegree['student_record.programe_id']    = 4;
        $whereDegree['student_record.s_status_id']    = 5;
     
        $this->data['Degree']            = $this->GuiModel->count_grand_report($field_part,$whereDegree);
        
        //A-level
        $whereAlevel['student_record.programe_id']    = 5;
        $whereAlevel['student_record.s_status_id']    = 5;
 
        $this->data['Alevel']            = $this->GuiModel->count_grand_report($field_part,$whereAlevel);
  
        
        $this->data['male']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>1)));
        $this->data['female']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>2)));
        $this->data['all_employee']               =  $this->CRUDModel->get_where_result('hr_emp_record',array('emp_status_id'=>1));
  
        $this->data['religion_base'] = $this->GuiModel->religion_base();
        
        $this->data['page_title']   = 'GUI Dashboard | ECMS';
        $this->data['page']         = 'Gui/dashboard';
//        $this->data['page']         = 'Gui/dashboard_auditor';
        $this->load->view('commonGui/commonGuiAuditor',$this->data);   
    } 
    
    public function studetn_gui_dashobard(){
       
        $this->data['studetn_quta_wise']        = $this->GuiModel->studetn_quta_wise();
        $this->data['studetn_religious_wise']   = $this->GuiModel->religion_base();
     
        $this->data['program_wise']     = $this->GuiModel->program_wise();
        $this->data['Distract_wise']    = $this->GuiModel->district_wise();
        
        
        $this->data['all_students']             = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5)));
        $this->data['all_male_student']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>1)));
        $this->data['all_female_student']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>2)));
        
        
//         echo '<pre>';print_r($this->data['studetn_religious_wise'] );die;
        
     
        //Fa/Fsc_part I
        $whereInter_Part1['sections.batch_id']              = 19;
        $whereInter_Part1['student_record.programe_id']     = 1;
        $whereInter_Part1['student_record.s_status_id']     = 5;
         
        $field_part                     = 'sections.name as sectionName,count(sections.sec_id) as student_count';
        $this->data['fa_fsc_part_1']    = $this->GuiModel->count_grand_report($field_part,$whereInter_Part1);
        
 
        //Fa/Fsc_part II
        $whereInter_Part2['sections.batch_id']              = 1;
        $whereInter_Part2['student_record.programe_id']     = 1;
        $whereInter_Part2['student_record.s_status_id']     = 5;
     
        $this->data['fa_fsc_part_2']     = $this->GuiModel->count_grand_report($field_part,$whereInter_Part2);
       
        $wherebscs['student_record.programe_id']        = 2;
        $wherebscs['student_record.s_status_id']        = 5;
        
        //BSCS 
        $this->data['bscs_clases']       = $this->GuiModel->count_grand_report($field_part,$wherebscs);
//       echo '<pre>';print_r($this->data['bscs_clases'] );die;
        //HND
        $whereHND['student_record.programe_id']     = 3;
        $whereHND['student_record.s_status_id']     = 5;
     
        $this->data['HND']            = $this->GuiModel->count_grand_report($field_part,$whereHND);
     
        //Degree
        $whereDegree['student_record.programe_id']    = 4;
        $whereDegree['student_record.s_status_id']    = 5;
     
        $this->data['Degree']            = $this->GuiModel->count_grand_report($field_part,$whereDegree);
        
        //A-level
        $whereAlevel['student_record.programe_id']    = 5;
        $whereAlevel['student_record.s_status_id']    = 5;
 
        $this->data['Alevel']            = $this->GuiModel->count_grand_report($field_part,$whereAlevel);
  
        $this->data['religion_base'] = $this->GuiModel->religion_base();
 
        $this->data['page_title']   = 'GUI Dashboard | ECMS';
        $this->data['page']         = 'Gui/student_gui_dashboard';
//            echo '<pre>';print_r($this->data['religion_base'] );die;
        $this->load->view('commonGui/commonGui',$this->data);   
    }    
    public function gui_hr(){
        
        $where = array(
             'emp_status_id'=>1,
             'cat_id'=>1,
             );
        $this->data['teacher_perf'] = $this->GuiModel->teacher_allocted_subject($where);
        $this->data['page_title']   = 'Student Attendance | ECMS';
        $this->data['page']         = 'Gui/gui_hrs';
        $this->load->view('commonGui/commonGui',$this->data); 
    }    
    public function gui_invenotry(){
        $this->data['invt_main_cat']    = $this->GuiModel->get_main_cat_itesm();
        $this->data['invt_fix_mov']     = $this->GuiModel->get_invt_nature();
        $this->data['invt_block_wise']  = $this->GuiModel->invt_block_wise();
        $this->data['invt_stock']       = $this->GuiModel->invt_stock();
        $this->data['invt_stock_deprt'] = $this->GuiModel->invt_stock_deprt();
        $this->data['dep_wise_issue']     = $this->GuiModel->dep_wise_issue();
        
        
//       echo '<pre>';print_r($this->data['dep_wise_issue']);die;
 
        $this->data['page_title']   = 'GUI Inventory | ECMS';
        $this->data['page']         = 'Gui/Invenotry';

        $this->load->view('commonGui/commonGui',$this->data);   
    }
    public function deprt_issue_detail(){
        $dep_id     = $this->uri->segment(2);
        $where      = array( 'dept_id'=>$dep_id);
//          $last_week = ;
//        $last_week = date("Y-m-d",strtotime("- 7 day"));
//        $current_week = array(
//            'from_date' =>$last_week,
//            'to_date'   =>date('Y-m-d'),
//        );
//        $this->data['current_week'] = $this->GuiModel->current_datewise_issue($where,$current_week);
//        
//        //Current Month
//        $last_month = date("Y-m-d",strtotime("- 1 month"));
//        
//        $current_month = array(
//            'from_date' =>$last_month,
//            'to_date'   =>date('Y-m-d'),
//        );
//         $this->data['current_month'] = $this->GuiModel->current_datewise_issue($where,$current_month);
//        
         $financial_year = $this->CRUDModel->get_where_row('financial_year',array('status'=>1));

        //Current year
        $current_year = array(
            'from_date' =>$financial_year->year_start,
            'to_date'   =>$financial_year->year_end,
        );
         $this->data['current_year'] = $this->GuiModel->current_datewise_issue($where,$current_year);
         
        $this->data['page_title']   = 'GUI Inventory | ECMS';
        $this->data['dep_name']     = $this->CRUDModel->get_where_row('invt_item_issuance_department',array('iss_dept_id'=>$dep_id));
        $this->data['financial_year']   = $financial_year;
        $this->load->view('commonGui/header');
        $this->load->view('Gui/Inventory_issue_dep_wise',$this->data);
        $this->load->view('commonGui/footer');
         
     
    }
    public function inventory_details(){
        $where = array(
           'bb_id' =>$this->uri->segment(2) 
        );
        $this->data['bb_items']             = $this->CRUDModel->get_where_row('invt_building_block',$where);
        $this->data['invt_block_details']   = $this->GuiModel->invt_block_details($where);
       
        
        $this->data['page_title']           = 'GUI Inventory Details | ECMS';
        $this->data['page']                 = 'Gui/Invenotry_details';
        $this->load->view('commonGui/commonGui',$this->data);   
    }    
    public function student_attence(){
         
       
         $where = array(
 
             'emp_status_id'=>1,
             'cat_id'=>1,
             );
  
        $this->data['teacher_perf'] = $this->GuiModel->teacher_allocted_subject($where);
        $this->data['page_title']   = 'Student Attendance | ECMS';
        $this->data['page']         = 'Gui/std_attandance';
//              echo '<pre>';print_r($this->data['subjectPerformance'] );die;
        $this->load->view('commonGui/commonGui',$this->data);    
    }
    
    public function student_per_subject_alloted()
    {
        $where_subj = array(
             'cat_id'                       => 1, 
             'flag'                         => 2,
             'hr_emp_record.emp_status_id'  => 1,
             'status'                       => 'On',
             );
        $this->data['subj_flag'] = $this->GuiModel->subject_assigned();
        $where_group = array(
             'cat_id'                       => 1,
             'flag'                         => 1,
             'hr_emp_record.emp_status_id'  => 1,
             'status'                       => 'On', 
             );
        $this->data['result_group'] = $this->GuiModel->subject_wise_perfor($where_group);
        
        $this->data['page_title']   = 'Student Per Subject Alloted| ECMS';
        $this->data['page']         = 'Gui/per_subject';
        $this->load->view('commonGui/commonGui',$this->data);
    }
    
     public function student_per_subject_alloted1(){
         $where_subj = array(
//             'hr_emp_record.emp_id'         => 16, //employee id
             'cat_id'                       => 1, 
             'flag'                         => 2,// subject wise = 2 and group_wise = 1
             'hr_emp_record.emp_status_id'  => 1, // Employee status
             'status'                       => 'On', //Active section
             );
         
         $result_subj  = $this->GuiModel->subject_wise_perfor($where_subj);
            
         $array = '';
         //Subject wise 
         foreach($result_subj as $row):
                      $this->db->select('count(student_subject_alloted.student_id) as count');
                              $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');  
                              $this->db->where_in('student_record.s_status_id',array(5,12)); //Student status enrolled=5,syspend = 12
                             $this->db->where(array('subject_id'=>$row->subject_id,'section_id'=>$row->sec_id));
                    $count = $this->db->get('student_subject_alloted')->row();
             $array[] = array(
                 'emp_name' =>$row->emp_name,
                 'title'    =>$row->title,
                 'name'     =>$row->name,
                 'count'    =>$count->count,
             );
         endforeach;

         //Group wise 
         $where_group = array(
//             'hr_emp_record.emp_id'         => 16,//employee id
             'cat_id'                       => 1,
             'flag'                         => 1, // subject wise = 2 and group_wise = 1
             'hr_emp_record.emp_status_id'  => 1, // Employee status
             'status'                       => 'On', //Active section
             );
          $result_group  = $this->GuiModel->subject_wise_perfor($where_group);
//           echo '<pre>';print_r($result_group);die
         foreach($result_group as $row):
                    $this->db->select('count(student_group_allotment.student_id) as count');
                    $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');  
                    $this->db->where_in('student_record.s_status_id',array(5,12)); //Student status enrolled=5,syspend = 12
                    $this->db->where(array('section_id'=>$row->sec_id)); 
             $count = $this->db->get('student_group_allotment')->row();
             $array[] = array(
                 'emp_name' =>$row->emp_name,
                 'title'    =>$row->title,
                 'name'     =>$row->name,
                 'count'    =>$count->count,
             );
         endforeach;
         
                foreach ($array as $key => $row):
                    $items[$key]  = $row['count'];
                endforeach;
         array_multisort($items, SORT_ASC, $array);
        $this->data['subjectPerformance'] = json_decode(json_encode($array), FALSE);
        $this->data['page_title']   = 'Student Per Subject Alloted| ECMS';
        $this->data['page']         = 'Gui/per_subject';
        $this->load->view('commonGui/commonGui',$this->data);    
    }
    public function teacher_class_wise_report(){
         
       
         $where = array(
//             'attendance_date'=>date('Y-m-d'),
             'emp_status_id'=>1,
             'cat_id'=>1,
             );
   
         
         $this->data['teacher_perf'] = $this->GuiModel->teacher_allocted_subject($where);
         $this->data['page_title']   = 'Student Attendance | ECMS';
        $this->data['page']         = 'Gui/teacher_class_wise';
//           echo '<pre>';print_r($this->data['subjectPerformance'] );die;
        $this->load->view('commonGui/commonGui',$this->data);    
    }
    public function teacher_attendance_Monthly_wise(){
        
        $date                               = '1-'.$this->uri->segment(2); 
        
        $month                              =  date("m",strtotime($date));
        $year                               =  date("Y",strtotime($date));

        $where['month(attendance_date)']    =  $month;  
        $where['year(attendance_date)']    =  $year;
        $where['emp_status_id']            =  1;
        $where['cat_id']                    =  1;
 
        $this->data['teacher_perf'] = $this->GuiModel->teacher_allocted_subject($where);
        $this->data['page_title']   = 'Teacher Attendance Monthly | ECMS';
        $this->data['page']         = 'Gui/teacher_attendance_monthly';
//              echo '<pre>';print_r($this->data['teacher_perf'] );die;
        $this->load->view('commonGui/commonGui',$this->data);    
    }
    public function teacher_montly_wise(){
        
         
        
        
        $where['emp_status_id']     =  1;
        $where['cat_id']            =  1;
    
        $this->data['teacher_perf'] = $this->GuiModel->get_all_emp($where);
      
        $this->data['page_title']   = 'Teacher Attendance Monthly | ECMS';
        $this->data['page']         = 'Gui/teacher_montly_wise';
//              echo '<pre>';print_r($this->data['subjectPerformance'] );die;
        $this->load->view('commonGui/commonGui',$this->data);    
    }
    
    public function gui_attandance(){
        $where = array(
             'attendance_date'=>date('Y-m-d'),
             'emp_status_id'=>1,
             'cat_id'=>1,
             );
         $this->data['teacher_perf'] = $this->GuiModel->teacher_performance_report($where);
         $this->data['religion_base'] = $this->GuiModel->religion_base();
 
        $this->data['page_title']   = 'GUI Dashboard | ECMS';
        $this->data['page']         = 'Gui/attandance';
//            echo '<pre>';print_r($this->data['religion_base'] );die;
        $this->load->view('commonGui/commonGui',$this->data);   
    }    
    public function teacher_curriculum(){
        
        
        
        $this->data['page_title']           = 'Teacher Curriculum| ECMS';
        $this->data['page']                 = 'Gui/teacher_curriculum';
        $this->load->view('commonGui/commonGui',$this->data); 
    }
    public function gui_reports(){
        
        $this->data['page_title']   = 'GUI Dashboard | ECMS';
        $this->data['page']         = 'Gui/reports';
        $this->data['male']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>1)));
        $this->data['female']         = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5,'gender_id'=>2)));
        $this->data['employee']         = count($this->CRUDModel->get_where_result('hr_emp_record',array('emp_status_id'=>1)));
//        echo '<pre>';print_r($this->data['male'] );die;
        $this->load->view('commonGui/commonGui',$this->data);   
    }
    public function grand_report_gui(){
         
              //dropdown lists
            
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', ' Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
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
            $application_status             =  $this->input->post('application_status');
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
            if(!empty($application_status)):
//                $where['student_status.s_status_id'] = $application_status;
                $where['student_status.s_status_id'] = 5;
                $this->data['application_statusId']  = $application_status;
            endif;
            
                 if($picture == 0):
                     $where['student_record.applicant_image ='] = '';
                     $this->data['pictureId']  = $picture;
                endif;
                if($picture == 1):
                     $where['student_record.applicant_image !='] = '';
                     $this->data['pictureId']  = $picture;    
                endif;
                if($picture == 2):
                    $this->data['pictureId']  = $picture;    
                endif;
                
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
 
            
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

                $this->data['result']       = $this->ReportsModel->grand_report($field,'student_record', $where,$like,$custom);
                $this->data['ReportName']   = 'Grand Report Gui';
                $this->data['countResult']  = count($this->data['result']);
                $this->data['page']         = "Gui/grand_report_gui";
                $this->data['title']        = 'Grand Report | ECMS';
                $this->load->view('common/common',$this->data); 
             
            elseif($this->input->post('export')):
                
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Student.ID');
                
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'F.No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Name');
                
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
                
                $this->excel->getActiveSheet()->setCellValue('H1','Reserved Seats');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('I1','Batch no');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('J1','Section');
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
                
                $this->excel->getActiveSheet()->setCellValue('Q1','Remarks 2');
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
               
                $this->excel->getActiveSheet()->setCellValue('W1','Mobile');
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('X1','Blood Group');
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(16);
               
                
       for($col = ord('A'); $col <= ord('X'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }


                
        $field = ' 
                student_record.student_id,
                student_record.form_no,
                student_record.student_name,
                student_record.father_name,
                gender.title as genderName,
                programes_info.programe_name,
                sub_programes.name as subprogram,
                reserved_seat.name as reservedName,
                prospectus_batch.batch_name,
                sections.name,
                student_record.fata_school,
                domicile.name as domicileName,
                applicant_edu_detail.total_marks,
                applicant_edu_detail.obtained_marks,
                applicant_edu_detail.percentage,
                student_record.admission_comment,
                student_record.comment,
                student_status.name as student_statusName,
                student_record.admission_date,
                student_record.college_no,
                religion.title as religion,
                student_record.parmanent_address as Address,
                student_record.mobile_no as Mobile,
                 blood_group.title,
                ';
        
            //$result       = $this->ReportsModel->get_meritlist($field,'student_record', $where,$like,$custom);
            
            $result   = $this->ReportsModel->grand_reportExport($field,'student_record',$where,$like,$custom);
                
               // echo '<pre>';print_r($result);die;
                
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
        
                $date = date('d-m-Y H:i:s');
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                  
                $filename='GrandReport_'.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
           
                    
            else:
       
            $this->data['studentId'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['genderId']       = '';
            $this->data['programId']  = '';
            $this->data['subprogramId']  = '';
            $this->data['reserved_seatId']  = '';
            $this->data['application_statusId']  = '';
            $this->data['limitId']  = '';
            
            $this->data['ReportName']   = 'Grand Report Gui';
            $this->data['page']         = "Gui/grand_report_gui";
            $this->data['title']        = 'Grand Report | ECMS';
            $this->load->view('common/common',$this->data); 
                
           endif; 
 
        }    
    public function get_teacher_attend_class(){
            
                
            $emp_id = $this->input->post('emp_id');
                        $where = array(
                                   'hr_emp_record.emp_id'=>$emp_id, 
                                 );
            
                            $result = $this->GuiModel->get_teacherBaseClass($where);
 
            
            if($result):
                  echo '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Class Name</th>
                    <th>Section</th>
                    <th>Attendance Status</th>
                  </tr>
                </thead>
                <tbody>';
            $sn = '';
             foreach($result as $row):
             $sn++;
                
                $subject =   $this->CRUDModel->get_where_row('subject',array('subject_id'=>$row->subject_id));
                 echo '<tr>
                        <td>'.$sn.'</td>
                        <td>'.$subject->title.'</td>
                        <td>'.$row->sectionName.'</td>
                        <td>';
                     
                            $attent_class = $this->CRUDModel->get_where_row('student_attendance',array('class_id'=>$row->class_id,'attendance_date'=>date('Y-m-d')));
                        
              
            
                            if($attent_class):
                            echo ' <span style="color:red; font-weight: bold;">Attend</span>';
                           
                                else:
                                 echo ' <span style="color:green; font-weight: bold;">Not Attend</span>';
                                       
                                endif;
             
             
             
                     
                     echo '</td>
                        
                    </tr>';    
            endforeach;
                    
                    
                echo '</tbody>
              </table>';
            endif;
          
            
        }
        
        
//    public function teacher_performance_subject_wise(){
//        
//        $where['emp_status_id']     =  1;
//        $where['cat_id']            =  1;
// 
//        $this->data['teacher_perf'] = $this->GuiModel->subject_wise_perfor($where);
//        
//        $this->data['page_title']   = 'Teacher Attendance Monthly | ECMS';
//        $this->data['page']         = 'Gui/teacher_montly_wise';
//              echo '<pre>';print_r($this->data['teacher_perf'] );die;
//        $this->load->view('commonGui/commonGui',$this->data);    
//    }
        
public function student_attendance_detail(){
    
    $this->data['result']       = $this->AttendanceModel->adminstudent_attendance('student_attendance');
    $this->data['present'] = $this->AttendanceModel->present_daily_students();
    $this->data['absent'] = $this->AttendanceModel->absent_daily_students();
    $this->data['total'] = $this->AttendanceModel->total_daily_students();
    
    
   $this->data['page_title']           = 'Student Attendance Detail| ECMS';
    $this->data['page']                = 'Gui/student_attendance_detail';
    $this->load->view('commonGui/commonGui',$this->data); 
}        
public function student_attendance_view(){
  
        $id = $this->uri->segment(3);
        $emp_id = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id = $this->uri->segment(6);
        $where = array('student_attendance_details.attend_id'=>$id);
        $this->data['empRecord'] = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
        $this->data['subject'] = $this->CRUDModel->get_where_row('subject',array('subject_id'=>$subject_id));
        $this->data['section'] = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sec_id));
        
        $this->data['result']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
        $wherePrsent = array('student_attendance_details.attend_id'=>$id,'status'=>1);
        $whereLeave = array('student_attendance_details.attend_id'=>$id,'status'=>2);
        $whereAbsent = array('student_attendance_details.attend_id'=>$id,'status'=>0);
        $this->data['present']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$wherePrsent));
        $this->data['leave']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereLeave));
        $this->data['Absent']       = count($this->AttendanceModel->view_attendance('student_attendance_details',$whereAbsent));
        
        $this->data['count']       = $this->AttendanceModel->view_attendance('student_attendance_details',$where);
    
    
    $this->data['page_title']           = 'Student Attendance View | ECMS';
    $this->data['page']                = 'Gui/student_attendance_view';
    $this->load->view('commonGui/commonGui',$this->data); 
    
}
    
public function get_teacher_attend_prac(){
           $emp_id = $this->input->post('emp_id');
            $where = array('hr_emp_record.emp_id'=>$emp_id);
            $result = $this->GuiModel->get_teacherBaseprac($where);
            if($result):
                  echo '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Group</th>
                    <th>Attendance Status</th>
                  </tr>
                </thead>
                <tbody>';
            $sn = '';
             foreach($result as $row):
             $sn++;    
            $subject =   $this->CRUDModel->get_where_row('practical_subject',array('prac_subject_id'=>$row->subject_id));
             echo '<tr>
                    <td>'.$sn.'</td>
                    <td>'.$subject->title.'</td>
                    <td>'.$row->group_name.'</td>
                    <td>';
            $attent_class = $this->CRUDModel->get_where_row('practical_attendance',array('prac_class_id'=>$row->practical_class_id,'attendance_date'=>date('Y-m-d')));
            if($attent_class):
                echo ' <span style="color:red; font-weight: bold;">Attended</span>';
                else:
                 echo ' <span style="color:green; font-weight: bold;">Not Attended</span>';
                endif;
                echo '</td>
                        
                    </tr>';    
            endforeach;
                echo '</tbody>
              </table>';
            else:
                 echo '<strong style="color:red;font-size:20px;">Sorry, Record not Found..!</strong>';
            endif;   
        }    
    
    
}
