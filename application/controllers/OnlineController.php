<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
 

class OnlineController extends AdminController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
     public function __construct() {
             parent::__construct();
             $this->load->model('FeeModel');
             $this->load->model('DashboardModel');
             $this->load->model('EdwardesModel');
             $this->load->library("pagination");
             $this->load->library("pdf");
             $this->userInfo        = json_decode(json_encode($this->getUser()), FALSE);
             $this->DefaultFeeBank  = json_decode(json_encode($this->default_fee_bank()), FALSE);
             
        }
     //SiteController Functions
        
         public function show_applicant_profile(){
        
        $stud_id = $this->input->post('std_id');
        
        $st_data      = $this->EdwardesModel->get_applicant_info('student_record', array('student_id'=>$stud_id));
        $st_acad_data = $this->EdwardesModel->get_applicant_education_info('applicant_edu_detail', array('applicant_edu_detail.student_id'=>$stud_id));
//        $st_subj_data = $this->EdwardesModel->get_applicant_subjects('new_student_subjects', array('new_student_subjects.student_id'=>$stud_id));
        if(!empty($st_data)):
            
            $seat2 = $this->CRUDModel->get_where_row('reserved_seat', array('rseat_id'=>$st_data->rseats_id3));
                        
            if(!empty($st_data->resereved_seat)):
                $reser_st = ', '.$st_data->resereved_seat;
            else:
                $reser_st = '';
            endif;
            if(!empty($st_data->rseats_id3)):
                $reser_st2 = ', '.$seat2->name;
            else:
                $reser_st2 = '';
            endif;
            $std_m_net  = $this->CRUDModel->get_where_row('mobile_network', array('net_id'=>$st_data->std_mobile_network));

            echo '<section class="course-finder">
                <div class="col-md-3">
                     <p>&nbsp;</p>';
                    $path = 'assets/images/students/'.$st_data->applicant_image;
                    if(file_exists($path)):
                    echo '<img src="assets/images/students/'.$st_data->applicant_image.'" style="max-width: 200px; max-height: 200px;"/>';    
                        else:
                    echo '<img src="assets/images/students/user.png" style="max-width: 200px; max-height: 200px;"/>';    
                    endif;
                    
                    
                    echo '<p>&nbsp;</p>
                </div>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <h1 class="section-heading text-highlight"><strong><span class="line">Applicant Profile</span></strong></h1>
                            <table width="100%" style="font-size: 16px; border: 1px solid #208e4c;">
                                <tr>
                                    <td width="25%" style="background-color: #208e4c; color:#fff; padding: 5px 10px 3px;">Status: </td>
                                    <td width="30%" style="padding: 5px 10px 3px;"><strong>'.$st_data->curr_status.'</strong></td>
                                    <td width="20%" style="background-color: #208e4c; color:#fff; padding: 5px 10px 3px;">Form No. </td>
                                    <td width="35%" style="padding: 5px 10px 3px;"><strong>'.$st_data->form_no.'</strong></td>
                                </tr>
                            </table>
                        <p style="margin: 0; padding: 0;">&nbsp;</p>
                    </div>';
                    if(!empty($st_data->data_verification_remarks)):
                        @$def = $this->CRUDModel->get_where_row('data_verification_remarks', array('id'=>$st_data->data_verification_remarks));
                        echo '<div class="col-md-12">
                            <table class="table" style="font-size: 15px; background-color: #ffc9c9">
                                <tr>
                                    <td style="text-align:center; background-color: #208e4c; color:#fff;"><h4><strong>College Remarks</strong></h4></td>
                                </tr>
                                <tr>
                                    <td>College Comments: &nbsp;<strong>'.@$def->comments.'</strong></td>
                                </tr>
                            </table>
                        </div>
                        <hr style="border: 1px solid #208e4c;">';
                    endif;
                    echo '<div class="col-md-12">
                        <table class="table" style="font-size: 15px;">
                            <tr>
                                <td colspan="4" style="text-align:center; color: #208e4c;"><h4><strong>Applicant Details</strong></h4></td>
                            </tr>
                            <tr>
                                <td width="18%">Applicant Name: </td>
                                <td width="32%"><strong>'.wordwrap($st_data->student_name, 15, "\n", true).'</strong></td>
                                <td width="18%">Applied for: </td>
                                <td width="32%"><strong>'.$st_data->sub_progam.'</strong></td>
                            </tr>
                            <tr>
                                <td>Applicant Mobile: </td>
                                <td><strong>'.$st_data->applicant_mob_no1.'</strong> ('.$std_m_net->network.')</td>
                                <td>Quota: </td>
                                <td><strong>Open Merit '.$reser_st.$reser_st2.'</strong></td>
                            </tr>
                            <tr>
                                <td>Applicant CNIC: </td>
                                <td><strong>'.$st_data->student_cnic.'</strong></td>
                                <td>Gender: </td>
                                <td><strong>'.$st_data->gender_title.'</strong></td>
                            </tr>
                            <tr>
                                <td>Date of Birth: </td>
                                <td><strong>'.date('d-m-Y', strtotime($st_data->dob)).'</strong></td>
                                <td>Religion: </td>
                                <td><strong>'.$st_data->religion_title.'</strong></td>
                            </tr>
                            <tr>
                                <td>Domicile: </td>
                                <td><strong>'.$st_data->domicile_title.'</strong></td>
                                <td>Applied for Hostel: </td>
                                <td><strong>'.$st_data->hostel_required.'</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4">Last attended school located in FATA? &nbsp;&nbsp;&nbsp;<strong>'.$st_data->fata_school.'</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr style="border: 1px solid #208e4c;">

                <div class="col-md-12">
                    <table class="table" style="font-size: 15px;">
                        <tr>
                            <td colspan="4" style="text-align:center; color: #208e4c;"><h4><strong>Father/Guardian Details</strong></h4></td>
                        </tr>
                        <tr>
                            <td width="18%">Father Name: </td>
                            <td width="32%"><strong>'.wordwrap($st_data->father_name, 15, "\n", true).'</strong></td>
                            <td width="18%">Father CNIC: </td>
                            <td width="32%"><strong>'.$st_data->father_cnic.'</strong></td>
                        </tr>
                        <tr>
                            <td>Landline No. </td>
                            <td><strong>'.$st_data->land_line_no.'</td>
                            <td>Father Mobile No. </td>
                            <td><strong>'.$st_data->mobile_no.'</strong> ('.$st_data->mob_net.')</td>
                        </tr>
                        <tr>
                            <td>Father Occupation: </td>
                            <td><strong>'.$st_data->father_occup.'</strong></td>
                            <td>Annual Income: </td>
                            <td><strong>'.$st_data->annual_income.'</strong></td>
                        </tr>
                        <tr>
                            <td>Postal Address: </td>
                            <td colspan="3"><strong>'.wordwrap($st_data->app_postal_address, 15, "\n", true).'</strong></td>
                        </tr>
                        <tr>
                            <td>Permanent Address: </td>
                            <td colspan="3"><strong>'.wordwrap($st_data->parmanent_address, 15, "\n", true).'</strong></td>
                        </tr>
                        <tr>
                            <td>Guardian Name: </td>
                            <td><strong>'.wordwrap($st_data->guardian_name, 15, "\n", true).'</strong></td>
                            <td>Guardian CNIC: </td>
                            <td><strong>'.$st_data->guardian_cnic.'</strong></td>
                        </tr>
                    </table>
                </div>';
                if(!empty($st_acad_data)):
                echo '<hr style="border: 1px solid #208e4c;">

                <div class="col-md-12" style="overflow:auto">
                    <h4 style="text-align:center; color: #208e4c;"><strong>Academic Information</strong></h4>
                    <table class="table acad_table" border="1" style="font-size: 15px;">
                        <tr>
                            <th width="15%" style="border: 1px solid #000 !important;">Degree</th>
                            <th width="15%" style="border: 1px solid #000 !important;">Board/University</th>
                            <th width="15%" style="border: 1px solid #000 !important;">Exam Session</th>
                            <th width="15%" style="border: 1px solid #000 !important;">Obtained/Total</th>
                            <th width="10%" style="border: 1px solid #000 !important;">%age</th>
                            <th width="15%" style="border: 1px solid #000 !important;">Institute/School</th>
                            <th width="15%" style="border: 1px solid #000 !important;">Remarks</th>
                        </tr>';
                        foreach($st_acad_data as $arow):
                        echo '<tr>
                            <td>'.$arow->degree_title.'</td>
                            <td>'.$arow->bu_title.'</td>
                            <td>'.$arow->year_of_passing.' ('.$arow->exam_type.')</td>';
                            if($arow->aed_degree == 78):
                                echo '<td>'.$arow->obtained_marks_9th.' / '.$arow->total_marks_9th.'</td>
                                <td>'.$arow->percentage_9th.'</td>';
                            else:
                                echo '<td>'.$arow->obtained_marks.' / '.$arow->total_marks.'</td>
                                <td>'.$arow->percentage.'</td>';
                            endif;
                            echo '<td>'.wordwrap($arow->inst_id, 15, "\n", true).'</td>
                            <td>'.wordwrap($arow->academic_comments, 15, "\n", true).'</td>
                        </tr>';
                        endforeach;
                    echo '</table>
                </div>';
                endif;    
            echo '</section>';
        endif;
    }
     public function student_challan_pdf_uri() {
                
        if(!empty($this->uri->segment(2))):
            
            $this->CRUDModel->update('prospectus_challan',array('print_challan_flag'=>1),array('student_id'=>$this->uri->segment(2)));
            $this->data['std_data'] = $this->EdwardesModel->fee_challan_details(array('student_record.student_id'=>$this->uri->segment(2)));
//         echo '<pre>';print_r($this->data['std_data']);die;
//            $html = $this->load->view('Online/Pdf/student_challan_pdf',$this->data);
            $html = $this->load->view('Online/Pdf/student_challan_pdf',$this->data,true);
            $this->pdf->set_paper('A4', 'landscape');
            $this->pdf->loadHtml($html);
            $this->pdf->render();
            $this->pdf->stream($this->data['std_data']->student_name.' Prospectus Challan '.date('d-m-Y H:i:s'), array('Attachment' => 0));
        else:
            redirect('TrackApplication');
        endif;
    }     
    
  public function admission_form_download_uri() {
         if(!empty($this->uri->segment(2))):
            $this->data['st_data']      = $this->EdwardesModel->get_applicant_info('student_record', array('student_id'=>$this->uri->segment(2)));
            $this->data['st_acad_data'] = $this->EdwardesModel->get_applicant_education_info('applicant_edu_detail', array('applicant_edu_detail.student_id'=>$this->uri->segment(2)));
            $this->data['st_subj_data'] = $this->EdwardesModel->get_applicant_subjects('new_student_subjects', array('new_student_subjects.student_id'=>$this->uri->segment(2)));
            
            
            $html = $this->load->view('Online/Pdf/download_admission_form',$this->data, true);
            $this->pdf->set_paper('A4', 'portrait');
            $this->pdf->loadHtml($html);
            $this->pdf->render();
            $this->pdf->stream($this->data['st_data']->form_no);
//            $this->pdf->stream($this->data['st_data']->student_name.' Admission Form '.date('d-m-Y H:i:s'), array('Attachment' => 0));
        else:
            redirect('TrackApplication');
        endif;
    } 

    public function student_fee_verfications(){
            
            $this->data['collegeNo']    = '';
            $this->data['stdName']      = '';
            $this->data['fatherName']   = '';
            $this->data['gender_id']    = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']   = '';
            $this->data['reg_no']       = ''; 
            $this->data['Form']         = ''; 
            $this->data['status_id']    = ''; 
            $this->data['fata_id']      = ''; 
            $this->data['hostel_required_id']     = ''; 
            $default_batch              = $this->CRUDModel->get_where_row('prospectus_batch',array('programe_id'=>1,'inter_default_flag'=>1));
            $this->data['batch_id']     = ''; 
//            $this->data['batch_id']     = $default_batch->batch_id; 
            if($this->input->post()):
                
                $college_no         =  $this->input->post('college_no');
                $Form               =  $this->input->post('Form');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $programe_id        =  $this->input->post('programe_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $s_status           =  $this->input->post('status_id');
                $FataStatus         =  $this->input->post('FataStatus');
                $batch              =  $this->input->post('batch');
                $hostelStatus       =  $this->input->post('hostelStatus');
               
                $like = '';
//                $where['student_record.batch_id']   = $default_batch->batch_id;
                $where['student_record.s_status_id !='] = '17'; 
              
                if(!empty($college_no)):
                    $where['college_no']        = $college_no;
                    $this->data['collegeNo']    = $college_no;
                endif;
                if(!empty($Form)):
                    $where['form_no']           = $Form;
                    $this->data['Form']         = $Form;
                endif;
                if(!empty($student_name)):
                    $like['student_name']       = $student_name;
                    $this->data['stdName']      = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name']        = $father_name;
                $this->data['fatherName']       = $father_name;
                endif;
                if(!empty($s_status)):
                    $where['student_record.s_status_id']            = $s_status;
                    $this->data['status_id']                        = $s_status;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id']                      = $gender;
                    $this->data['gender_id']                        = $gender;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id']            = $programe_id;
                    $this->data['programe_id']                      = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id']              = $sub_pro_id;
                    $this->data['sub_pro_id']                       = $sub_pro_id;
                endif;
                if(!empty($FataStatus)):
                    $where['student_record.fata_school']            = $FataStatus;
                    $this->data['fata_id']                          = $FataStatus;
                endif;
                if(!empty($hostelStatus)):
                    $where['student_record.hostel_required']        = $hostelStatus;
                    $this->data['hostel_required_id']               = $hostelStatus;
                endif;
                if(!empty($batch)):
                    $where['student_record.batch_id']               = $batch;
                    $this->data['batch_id']                         = $batch;
                endif;
                $this->data['result']   = $this->DashboardModel->stduent_data_verifications($where,$like); 
                $this->data['count']   = count($this->data['result']);
        else:
            
          
            //pagination start
            $config['base_url']         = base_url('FeeVerification');
            $config['total_rows']       = count($this->CRUDModel->get_wherein_result('student_record','student_record.s_status_id',array('15','1')));  //echo $config['total_rows']; exit;
//            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('student_record.s_status_id'=> '15')));  //echo $config['total_rows']; exit;
            $config['per_page']         = 50;
            $config["num_links"]        = 6;
            $config['uri_segment']      = 2;
            
            //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the ?Digit?? Link
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            //For PREVIOUS PAGE Setup
            $config['prev_link']        = "<i class='fa fa-angle-left'></i>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
                        
            //For NEXT PAGE Setup
            $config['next_link']        = "<i class='fa fa-angle-right'></i>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            
            //For LAST PAGE Setup
            $config['last_link']        = "<i class='fa fa-angle-double-right'></i>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            
            //For CURRENT page on which you are
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            
            
            
            $this->pagination->initialize($config);
            $page                           = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pagination_links'] = $this->pagination->create_links();
            //pagination start 
             $pagni_where = array(
                 'student_record.s_status_id'   => '15',
//                 'student_record.batch_id'      => $default_batch->batch_id
             );
            $this->data['result']       = $this->DashboardModel->data_verification_pagination($config['per_page'],$page); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
            
            $this->data['sub_program']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
//            $this->data['program']              = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>1));
            $this->data['program']              = $this->CRUDModel->dropDown('programes_info','Select Program', 'programe_id', 'programe_name',array('program_type_id'=>1));
            $this->data['gender']               = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name', array('s_status_id !='=> 17));
            $this->data['FataStatus']           = $this->CRUDModel->dropDown('yesno', 'Fata Status', 'yn_value', 'yn_value');
            $this->data['hostel_required']      = $this->CRUDModel->dropDown('yesno', 'Hostel Required', 'yn_value', 'yn_value');
            $this->data['batch']                = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $this->data['ReportName']           = 'Challan Received';
            $this->data['page_title']           = 'Challan Received | ECP';
            $this->data['page']                 = 'Online/Dashboard/Forms/fee_verifications';
            $this->load->view('common/common',$this->data);
        }
             public function fee_verification_update_date(){
             
           $student_id              = $this->input->post('student_id');
                                      $this->db->join('prospectus_challan','prospectus_challan.student_id=student_record.student_id');  
           $currentStatus           = $this->db->get_where('student_record',array('student_record.student_id'=>$student_id))->row();
//           echo '<pre>';print_r($currentStatus);die;
           $StaffChild              = $this->CRUDModel->dropDown('yesno', '', 'yn_id', 'yn_value');
            
           echo '<div class="modal-body">
                    <h1 style="text-align:center; font-size: 80px; color: #208e4c;"><i class="fa fa-check-circle"></i></h1>
                    <h4 style="text-align:center; color: #208e4c; margin: 0px;"><strong>CHALLAN RECEIVED UPDATE</strong></h4>
                    <p style="margin:0">&nbsp;</p>
                    <p style="margin:0">&nbsp;</p>
                        <section class="course-finder">';
           
             echo ' <table class="table" style="font-size: 15px;">
                        <tbody>
                            <tr><td><input type="hidden" class="form-control" value="'.$student_id.'" id="student_id"></td>
                                <td colspan="4" style="text-align:center; color: #208e4c;"><h4><strong>Applicant Details</strong></h4></td>
                            </tr>
                            <tr>
                                <td width="18%">Applicant Name: </td>
                                 <td width="32%"><strong>'.wordwrap($currentStatus->student_name, 20, "\n", true).'</strong></td>
                                <td width="18%">Father Name: </td>
                                <td width="32%"><strong>'.wordwrap($currentStatus->father_name, 20, "\n", true).'</strong></td>
                            </tr>
                            <tr>
                                <td>Applicant Mobile: </td>
                                <td><strong>'.$currentStatus->applicant_mob_no1.'</strong></td>
                                <td>Father Mobile: </td>
                                <td><strong>'.$currentStatus->mobile_no.'</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:center; color: #208e4c;"><h4><strong>Applicant Challan Details</strong></h4></td>
                            </tr>
                            <tr>
                                <td>Paid Date</td>
                                <td><input type="text" class="form-control datepicker" value="'.date('d-m-Y',strtotime($currentStatus->paid_date)).'" readonly="readonly" name="fee_paid_date" id="fee_paid_date"></td>
                                <td>Comments</td>
                                <td><input type="text" class="form-control" value="'.$currentStatus->challan_comments.'" name="fee_comments" id="fee_comments"></td>
                                
                            </tr>
                            <tr><td>Staff Child</td><td>';
                                    echo form_dropdown('ChildStaff',$StaffChild,$currentStatus->staffChild_flag,  'class="form-control" id="ChildStaff"');
                              
                            echo '</td><td></td>
                                <td></td></tr>
                            </tbody>
                    </table>';
            
 
             echo '
                
                    </section> 
                </div>';
            echo '<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                        <button type="button" class="btn btn-default savePaidDetailsUpdate" >Update</button>
                    </div>';
            
          ?>
              
            <script>
                  jQuery(document).ready(function(){
                   jQuery('.savePaidDetailsUpdate').on('click',function(){
                        
                        var student_id          = jQuery('#student_id').val();
                        var fee_paid_date       = jQuery('#fee_paid_date').val();
                        var fee_comments        = jQuery('#fee_comments').val();
                        var ChildStaff          = jQuery('#ChildStaff').val();
                        


                //        $(').toggle('hide');
                //        $('.Student'.student_id).toggle('hide');
                          jQuery.ajax({
                               type   :'post',
                               url    :'savePaidDetalsUpdate',
                               data   :{'student_id':student_id,'fee_comments':fee_comments,'fee_paid_date':fee_paid_date,'ChildStaff':ChildStaff},
                              success :function(result){
//                                 $('.Student'+student_id).hide(); 
                                  jQuery('#FeeVerficationDateUpdatePopUP').modal('toggle');
                      
                              }
                           });
                    });
                
                $( function() {
                  $( ".datepicker" ).datepicker({
                       changeMonth: true,
                  changeYear: true,
                  dateFormat: 'dd-mm-yy'
                  });
                } );
                
                
                });
                </script> 
              
              
              <?php   
           
        
       }
          public function fee_verification_update(){
             
           $student_id              = $this->input->post('student_id');
                                      $this->db->join('prospectus_challan','prospectus_challan.student_id=student_record.student_id'); 
            $currentStatus           = $this->db->get_where('student_record',array('student_record.student_id'=>$student_id))->row();
           
           $StaffChild              = $this->CRUDModel->dropDown('yesno', '', 'yn_id', 'yn_value');
            
           echo '<div class="modal-body">
                    <h1 style="text-align:center; font-size: 80px; color: #208e4c;"><i class="fa fa-check-circle"></i></h1>
                    <h4 style="text-align:center; color: #208e4c; margin: 0px;"><strong>CHALLAN RECEIVED</strong></h4>
                    <p style="margin:0">&nbsp;</p>
                    <p style="margin:0">&nbsp;</p>
                        <section class="course-finder">';
           
             echo ' <table class="table" style="font-size: 15px;">
                        <tbody>
                            <tr><td><input type="hidden" class="form-control" value="'.$student_id.'" id="student_id"></td>
                                <td colspan="4" style="text-align:center; color: #208e4c;"><h4><strong>Applicant Details</strong></h4></td>
                            </tr>
                            <tr>
                                <td width="18%">Applicant Name: </td>
                                 <td width="32%"><strong>'.wordwrap(@$currentStatus->student_name, 20, "\n", true).'</strong></td>
                                <td width="18%">Father Name: </td>
                                <td width="32%"><strong>'.wordwrap(@$currentStatus->father_name, 20, "\n", true).'</strong></td>
                            </tr>
                            <tr>
                                <td>Applicant Mobile: </td>
                                <td><strong>'.@$currentStatus->applicant_mob_no1.'</strong></td>
                                <td>Father Mobile: </td>
                                <td><strong>'.@$currentStatus->mobile_no.'</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:center; color: #208e4c;"><h4><strong>Applicant Challan Details</strong></h4></td>
                            </tr>
                            <tr>
                                <td>Paid Date</td>
                                <td><input type="text" class="form-control datepicker" value="'.date('d-m-Y').'" readonly="readonly" name="fee_paid_date" id="fee_paid_date"></td>
                                <td>Comments</td>
                                <td><input type="text" class="form-control" name="fee_comments" id="fee_comments"></td>
                                
                            </tr>
                            <tr><td>Staff Child</td><td>';
                                    echo form_dropdown('ChildStaff',$StaffChild,@$currentStatus->staffChild_flag,  'class="form-control" id="ChildStaff"');
                              
                            echo '</td><td></td>
                                <td></td></tr>
                            </tbody>
                    </table>';
            
 
             echo '
                
                    </section> 
                </div>';
            echo '<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                        <button type="button" class="btn btn-default savePaidDetails" >Save</button>
                    </div>';
            
          ?>
              
            <script>
                  jQuery(document).ready(function(){
                   jQuery('.savePaidDetails').on('click',function(){
        
                        var student_id          = jQuery('#student_id').val();
                        var fee_paid_date       = jQuery('#fee_paid_date').val();
                        var fee_comments        = jQuery('#fee_comments').val();
                        var ChildStaff        = jQuery('#ChildStaff').val();
                        


                //        $(').toggle('hide');
                //        $('.Student'.student_id).toggle('hide');
                          jQuery.ajax({
                               type   :'post',
                               url    :'savePaidDetals',
//                               url    :'savePaidDetalsUpdate',
                               data   :{'student_id':student_id,'fee_comments':fee_comments,'fee_paid_date':fee_paid_date,'ChildStaff':ChildStaff},
                              success :function(result){
                                 $('.Student'+student_id).hide(); 
                                  jQuery('#FeeVerficationUpdatePopUp').modal('toggle');
                      
                              }
                           });
                    });
                
                $( function() {
                  $( ".datepicker" ).datepicker({
                       changeMonth: true,
                  changeYear: true,
                  dateFormat: 'dd-mm-yy'
                  });
                } );
                
                
                });
                </script> 
              
              
              <?php   
       }
       public function save_paid_challan_info_update(){
           
           
           $student_id      = $this->input->post('student_id');
           $fee_comments    = $this->input->post('fee_comments');
           $fee_paid_date   = $this->input->post('fee_paid_date');
           $ChildStaff      = $this->input->post('ChildStaff');
           
           
                              $this->db->join('mobile_network','mobile_network.net_id=student_record.std_mobile_network');  
           $currentStatus   = $this->db->get_where('student_record',array('student_id'=>$student_id))->row();
              $data = array(
               'student_id'             => $student_id,
               'old_status_id'          => $currentStatus->s_status_id,
               'update_by'              => $this->userInfo->user_id,
               'udpate_timestamp'       => date('Y-m-d H:i:s') ,
               'change_status_comment'  => 'Update Reocrdm'.date('Y-m-d H:i:s'),
           );
           $this->CRUDModel->insert('student_fee_verification_log',$data);
           
           $fee_details = array(
               'challan_comments'   => $fee_comments,
               'pros_paid_status'   => 2,
               'pros_paid_by'       => $this->userInfo->user_id,
               'staffChild_flag'    => $ChildStaff,
               'paid_date'          => date('Y-m-d H:i:s',strtotime($fee_paid_date)),
           );
           
            $this->CRUDModel->update('prospectus_challan',$fee_details,array('student_id'=>$student_id));
             $wherechec = array(
                's_status_id'    => '15',
                'student_id'     => $student_id
            );

             $get_student_details = $this->CRUDModel->get_where_row('student_record',$wherechec);
              //Update student status to application received if student status is pending
           if(isset($get_student_details) && !empty($get_student_details)):
            
           $set = array(
             's_status_id' =>'1'  
           );
           $where = array(
               'student_id'=>$student_id
           );
           
               $this->CRUDModel->update('student_record',$set,$where);
           endif;
            
         
       }
       public function save_paid_challan_info(){
           
           $student_id      = $this->input->post('student_id');
           $fee_comments    = $this->input->post('fee_comments');
           $fee_paid_date   = $this->input->post('fee_paid_date');
           $ChildStaff      = $this->input->post('ChildStaff');
           
           
           //Update student status to application received if student status is pending
            
                    $wherechec = array(
                        's_status_id'    => '15',
                        'student_id'     => $student_id
                    );
                    $get_student_details = $this->CRUDModel->get_where_row('student_record',$wherechec);
           if(isset($get_student_details) && !empty($get_student_details)):
           
           
                              $this->db->join('mobile_network','mobile_network.net_id=student_record.std_mobile_network');  
           $currentStatus   = $this->db->get_where('student_record',array('student_id'=>$student_id))->row();
           
           
              $data = array(
               'student_id'         => $student_id,
               'old_status_id'      => $currentStatus->s_status_id,
               'update_by'          => $this->userInfo->user_id,
               'udpate_timestamp'   => date('Y-m-d H:i:s'),
           );
           $this->CRUDModel->insert('student_fee_verification_log',$data);
           
           $fee_details = array(
               'challan_comments'  => $fee_comments,
               'staffChild_flag'   => $ChildStaff,
               'pros_paid_by'       => $this->userInfo->user_id,
               'pros_paid_status'   => 2,
               'paid_date'          => date('Y-m-d H:i:s',strtotime($fee_paid_date)),
           );
           
            $this->CRUDModel->update('prospectus_challan',$fee_details,array('student_id'=>$student_id));
           $set = array(
             's_status_id' =>'1'  
           );
           $where = array(
               'student_id'=>$student_id
           );
          
           
               $this->CRUDModel->update('student_record',$set,$where);
           endif;
//            $this->CRUDModel->update('student_record',$set,$where);
           
           //Send SMS
           
          $clearNumber  =  $this->CRUDModel->clean_number($currentStatus->applicant_mob_no1);
          $message      = 'Your application for admission in Edwardes College has been received.';
          
           $sms_info = $this->send_message($clearNumber,$message,$currentStatus->send_format);
//           $sms_info = $this->send_message_bulk($clearNumber,$message,$currentStatus->send_format);
            $return_resp = '';
                if(!empty($sms_info)):
                    $return_resp = $sms_info;
                    else:
                    $return_resp = 'null';
                    endif;     
           $sms_log = array(
                        'student_id'        => $currentStatus->student_id,
                        'program_id'        => $currentStatus->programe_id,
                        'sub_pro_id'        => $currentStatus->sub_pro_id,
                        'batch_id'          => $currentStatus->batch_id,
                        'sms_type'          => 1,
                        'message'           => $message,
                        'network'           => $currentStatus->send_format,
                        'sender_number'     => $this->CRUDModel->clean_number($currentStatus->applicant_mob_no1),
                        'comments'          =>$return_resp,
                        'create_datetime'   => date('Y-m-d H:i:s'),
                        'send_date'         => date('Y-m-d'),  
                        'create_by'         => $this->userInfo->user_id, 
                      );
                 
              $this->CRUDModel->insert('sms_students',$sms_log);
       }
       
       public function student_data_verification(){
            
            $this->data['collegeNo']    = '';
            $this->data['stdName']      = '';
            $this->data['fatherName']   = '';
            $this->data['gender_id']    = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']   = '';
            $this->data['reg_no']       = ''; 
            $this->data['Form']         = ''; 
            $this->data['status_id']    = ''; 
            $this->data['fata_id']      = ''; 
            $this->data['hostel_required_id']     = ''; 
            $default_batch              = $this->CRUDModel->get_where_row('prospectus_batch',array('programe_id'=>1,'inter_default_flag'=>1));
            $this->data['batch_id']     = ''; 
            if($this->input->post()):
                
                $college_no         =  $this->input->post('college_no');
                $Form               =  $this->input->post('Form');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $programe_id        =  $this->input->post('programe_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $s_status           =  $this->input->post('status_id');
                $FataStatus         =  $this->input->post('FataStatus');
                $batch              =  $this->input->post('batch');
                $hostelStatus       =  $this->input->post('hostelStatus');
               
                $like = '';
//                $where['student_record.batch_id']       = $default_batch->batch_id;
                $where['student_record.s_status_id !=']    = '17'; 
                 
              
                if(!empty($college_no)):
                    $where['college_no']        = $college_no;
                    $this->data['collegeNo']    = $college_no;
                endif;
                if(!empty($Form)):
                    $where['form_no']           = $Form;
                    $this->data['Form']         = $Form;
                endif;
                if(!empty($student_name)):
                    $like['student_name']       = $student_name;
                    $this->data['stdName']      = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name']        = $father_name;
                $this->data['fatherName']       = $father_name;
                endif;
                if(!empty($s_status)):
                    $where['student_record.s_status_id']            = $s_status;
                    $this->data['status_id']                        = $s_status;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id']                      = $gender;
                    $this->data['gender_id']                        = $gender;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id']            = $programe_id;
                    $this->data['programe_id']                      = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id']              = $sub_pro_id;
                    $this->data['sub_pro_id']                       = $sub_pro_id;
                endif;
                if(!empty($FataStatus)):
                    $where['student_record.fata_school']            = $FataStatus;
                    $this->data['fata_id']                          = $FataStatus;
                endif;
                if(!empty($hostelStatus)):
                    $where['student_record.hostel_required']        = $hostelStatus;
                    $this->data['hostel_required_id']               = $hostelStatus;
                endif;
                if(!empty($batch)):
                    $where['student_record.batch_id']               = $batch;
                    $this->data['batch_id']                         = $batch;
                endif;
                $this->data['result']   = $this->DashboardModel->stduent_data_verifications($where,$like); 
                $this->data['count']    = count($this->data['result']);
        else:
            
          
            //pagination start
            $config['base_url']         = base_url('DataVerification');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('student_record.s_status_id !='=>'17')));  //echo $config['total_rows']; exit;
            $config['per_page']         = 50;
            $config["num_links"]        = 6;
            $config['uri_segment']      = 2;
            
            //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the ?Digit?? Link
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            //For PREVIOUS PAGE Setup
            $config['prev_link']        = "<i class='fa fa-angle-left'></i>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
                        
            //For NEXT PAGE Setup
            $config['next_link']        = "<i class='fa fa-angle-right'></i>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            
            //For LAST PAGE Setup
            $config['last_link']        = "<i class='fa fa-angle-double-right'></i>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            
            //For CURRENT page on which you are
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            
            
            
            $this->pagination->initialize($config);
            $page                           = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pagination_links'] = $this->pagination->create_links();
            //pagination start 
             $pagni_where = array(
                 'student_record.s_status_id !='   => '17',
//                 'student_record.batch_id'      => $default_batch->batch_id
             );
            $this->data['result']       = $this->DashboardModel->data_verification_pagination($config['per_page'],$page,$pagni_where); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
            
            $this->data['sub_program']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
//            $this->data['program']              = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>1));
            $this->data['program']              = $this->CRUDModel->dropDown('programes_info', 'Select Program', 'programe_id', 'programe_name',array('program_type_id'=>1));
            $this->data['gender']               = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name', array('s_status_id !='=> 17));
//            $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', '', 's_status_id', 'name', array('s_status_id'=> 1));
            $this->data['FataStatus']           = $this->CRUDModel->dropDown('yesno', 'Fata Status', 'yn_value', 'yn_value');
            $this->data['hostel_required']      = $this->CRUDModel->dropDown('yesno', 'Hostel Required', 'yn_value', 'yn_value');
            $this->data['batch']                = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
//            $this->data['batch']                = $this->CRUDModel->dropDown('prospectus_batch', '', 'batch_id', 'batch_name',array('status'=>'on','batch_id'=>$default_batch->batch_id));
             
            
            $this->data['ReportName']       = 'Data Verification';
            $this->data['page_title']       = 'Data Verification | ECP';
            $this->data['page']             = 'Online/Dashboard/Forms/data_verifications';
            $this->load->view('common/common',$this->data);
        }
       public function all_bs_records_online(){
            
            $this->data['collegeNo']    = '';
            $this->data['stdName']      = '';
            $this->data['fatherName']   = '';
            $this->data['gender_id']    = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']   = '';
            $this->data['reg_no']       = ''; 
            $this->data['Form']         = ''; 
            $this->data['status_id']    = ''; 
            $this->data['fata_id']      = ''; 
            $this->data['hostel_required_id']     = ''; 
            $default_batch              = $this->CRUDModel->get_where_row('prospectus_batch',array('programe_id'=>1,'inter_default_flag'=>1));
            $this->data['batch_id']     = ''; 
            if($this->input->post()):
                
                $college_no         =  $this->input->post('college_no');
                $Form               =  $this->input->post('Form');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $programe_id        =  $this->input->post('programe_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $s_status           =  $this->input->post('status_id');
                $FataStatus         =  $this->input->post('FataStatus');
                $batch              =  $this->input->post('batch');
                $hostelStatus       =  $this->input->post('hostelStatus');
               
                $like = '';
                $where['degree_type_id']                    = '2';
                $where['student_record.s_status_id !=']    = '17'; 
                 
              
                if(!empty($college_no)):
                    $where['college_no']        = $college_no;
                    $this->data['collegeNo']    = $college_no;
                endif;
                if(!empty($Form)):
                    $where['form_no']           = $Form;
                    $this->data['Form']         = $Form;
                endif;
                if(!empty($student_name)):
                    $like['student_name']       = $student_name;
                    $this->data['stdName']      = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name']        = $father_name;
                $this->data['fatherName']       = $father_name;
                endif;
                if(!empty($s_status)):
                    $where['student_record.s_status_id']            = $s_status;
                    $this->data['status_id']                        = $s_status;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id']                      = $gender;
                    $this->data['gender_id']                        = $gender;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id']            = $programe_id;
                    $this->data['programe_id']                      = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id']              = $sub_pro_id;
                    $this->data['sub_pro_id']                       = $sub_pro_id;
                endif;
                if(!empty($FataStatus)):
                    $where['student_record.fata_school']            = $FataStatus;
                    $this->data['fata_id']                          = $FataStatus;
                endif;
                if(!empty($hostelStatus)):
                    $where['student_record.hostel_required']        = $hostelStatus;
                    $this->data['hostel_required_id']               = $hostelStatus;
                endif;
                if(!empty($batch)):
                    $where['student_record.batch_id']               = $batch;
                    $this->data['batch_id']                         = $batch;
                endif;
                $this->data['result']   = $this->DashboardModel->stduent_data_verifications($where,$like); 
                $this->data['count']    = count($this->data['result']);
        else:
                   $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id'); 
          $count = $this->db->get_where('student_record',array('student_record.s_status_id !='=>'17','degree_type_id'=>2))->result();
            //pagination start
            $config['base_url']         = base_url('AllBSRecords');
            $config['total_rows']       = count($count);  //echo $config['total_rows']; exit;
            $config['per_page']         = 50;
            $config["num_links"]        = 6;
            $config['uri_segment']      = 2;
            
            //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the ?Digit?? Link
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            //For PREVIOUS PAGE Setup
            $config['prev_link']        = "<i class='fa fa-angle-left'></i>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
                        
            //For NEXT PAGE Setup
            $config['next_link']        = "<i class='fa fa-angle-right'></i>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            
            //For LAST PAGE Setup
            $config['last_link']        = "<i class='fa fa-angle-double-right'></i>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            
            //For CURRENT page on which you are
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            
            
            
            $this->pagination->initialize($config);
            $page                           = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pagination_links'] = $this->pagination->create_links();
            //pagination start 
             $pagni_where = array(
                 'student_record.s_status_id !='    => '17',
                 'degree_type_id'                   => '2'
                );
            $this->data['result']       = $this->DashboardModel->data_verification_pagination($config['per_page'],$page,$pagni_where); //get user data from db
            $this->data['count']        = count($this->data['result']);
            
        endif;
        
            $this->data['sub_program']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
            $this->data['program']              = $this->CRUDModel->dropDown('programes_info', 'Select Program', 'programe_id', 'programe_name',array('degree_type_id'=>2,'status'=>'yes'));
            $this->data['gender']               = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name', array('s_status_id !='=> 17));
            $this->data['FataStatus']           = $this->CRUDModel->dropDown('yesno', 'Fata Status', 'yn_value', 'yn_value');
            $this->data['hostel_required']      = $this->CRUDModel->dropDown('yesno', 'Hostel Required', 'yn_value', 'yn_value');
            $this->data['batch']                = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            $this->data['ReportName']           = 'All BS Records';
            $this->data['page_title']           = 'All BS Records | ECMS';
            $this->data['page']                 = 'Online/Dashboard/Forms/all_bs_records';
            $this->load->view('common/common',$this->data);
        }
        
public function grand_report_v01(){
         
                //dropdown lists
              
              $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('status'=>'yes'));
              $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes'));
              $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
              $this->data['reserved_seat3']   = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
              $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
              $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Gender Status', 'gender_id', 'title');
              $this->data['shift']            = $this->CRUDModel->dropDown('shift', 'Select Shift ', 'shift_id', 'name');
              $this->data['sections']         = $this->CRUDModel->dropDown('sections', ' Sections ', 'sec_id', 'name',array('status'=>'On'));
        //       $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit ', 'limitId', 'limit_value');
              $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
              $this->data['religion']         = $this->CRUDModel->dropDown('religion', 'Religion ', 'religion_id', 'title');
              
              
              
              $college_no                     =  $this->input->post('college_no');
              $shift                          =  $this->input->post('shift');
              $form_no                        =  $this->input->post('form_no');
              $student_name                   =  $this->input->post('student_name');
              $father_name                    =  $this->input->post('father_name');
              $gender                         =  $this->input->post('gender');
              $program                        =  $this->input->post('program');
              $sub_program                    =  $this->input->post('sub_program');
              $reserved_seat                  =  $this->input->post('reserved_seat');
              $reserved_seat3                 =  $this->input->post('reserved_seat3');
              $application_status             =  $this->input->post('application_status');
              $section                        =  $this->input->post('sections_name');
              $picture                        =  $this->input->post('picture');
              $hostel                         =  $this->input->post('hostel');
              $limit                          =  $this->input->post('limit');
              $religion                          =  $this->input->post('religion');
              $batch                          =  $this->input->post('batch');
              $fromDate                       =  $this->input->post('fromDate');
              $toDate                         =  $this->input->post('toDate');
              $hostel_req                     =  $this->input->post('hostel_req');
              //like Array
              $like = '';
              $where = '';
              $this->data['college_no']           = '';
              $this->data['shift_id']             = '';
              $this->data['form_no']              = '';
              $this->data['student_name']         = '';
              $this->data['father_name']          = '';
              $this->data['genderId']             = '';
              $this->data['programId']            = '';
              $this->data['sectionId']            = '';
              $this->data['subprogramId']         = '';
              $this->data['reserved_seatId']      = '';
              $this->data['reserved_seatId3']     = '';
              $this->data['application_statusId'] = '';
              $this->data['pictureId']            = '';
              $this->data['hostelId']             = '';
              $this->data['batchId']              = '';
              $this->data['fromDate']             = '';
              $this->data['religionId']           = '';
              $this->data['hostelIdReq']          = '';
              $this->data['toDate']               = date('d-m-Y');
             
             if($this->input->post('search')):
               $date       = '';
             
             
             
              if(empty($fromDate)):
                  
                      $date['toDate']             = $toDate;
                      $this->data['toDate']       = $toDate;
                       $this->data['fromDate']     = '';
                  else:
                      $this->data['fromDate']     = $fromDate;
                      $this->data['toDate']       = $toDate;
                      $date['fromDate']           = $fromDate;
                      $date['toDate']             = $toDate;
              endif;
             
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
              if(!empty($reserved_seat3)):
                  $where['rseats_id2']           = $reserved_seat3;
                  $this->data['reserved_seatId3']   = $reserved_seat3;
              endif;
              if(!empty($shift)):
                  $where['shift.shift_id']        = $shift;
                  $this->data['shift_id']   = $shift;
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
               if(!empty($religion)):
                   $where['student_record.religion_id']   = $religion;
                  $this->data['religionId']               = $religion;
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
                  $where['student_status.s_status_id'] = $application_status;
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
                  
                  if($hostel == 0):
                      $this->data['hostelId']  = $hostel;    
                      $custom['hostel']           = $hostel;
                  endif;
                  if($hostel == 1):
                      $this->data['hostelId']     = $hostel;    
                      $custom['hostel']           = $hostel;
                  endif;
                  
                  if($hostel == 2):
                      $this->data['hostelId']     = $hostel;    
                      $custom['hostel']           = $hostel;
                  endif;
                  
                  
                  
//                  $hostel_req = '';
                  
            switch ($hostel_req):
                case '':
                    $where['hostel_required'] = '';
                     $this->data['hostelIdReq']          = $hostel_req;
                    break;
                case '1':
                    $where['hostel_required'] = 'Yes'; 
                    $this->data['hostelIdReq']          = $hostel_req;
                    break;
                case '2':
                    $where['hostel_required'] = 'No'; 
                    $this->data['hostelIdReq']          = $hostel_req;
                    break;
            endswitch;
                  
                  
            
            
//                  $custom['column']       = 'percentage_order';
//                  $custom['column']       = 'LENGTH(applicant_edu_detail.percentage)';
                  $custom['column']       = 'applicant_edu_detail.percentage';
                  $custom['order']        = 'desc';
                  
   
                  $this->data['result']       = $this->DashboardModel->admin_grand_report('student_record', $where,$like,$custom,'',$date);
   
              endif;
              if($this->input->post('export')):
                  
                  
                   $date       = '';
              if(empty($fromDate)):
                  
                      $date['toDate']             = $toDate;
                      $this->data['toDate']       = $toDate;
                       $this->data['fromDate']     = '';
                  else:
                      $this->data['fromDate']     = $fromDate;
                      $this->data['toDate']       = $toDate;
                      $date['fromDate']           = $fromDate;
                      $date['toDate']             = $toDate;
              endif;
              if(!empty($religion)):
                   $where['student_record.religion_id']   = $religion;
                  $this->data['religionId']               = $religion;
              endif;
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
              if(!empty($reserved_seat3)):
                  $where['rseats_id2']           = $reserved_seat3;
                  $this->data['reserved_seatId3']   = $reserved_seat3;
              endif;
              if(!empty($shift)):
                  $where['shift.shift_id']        = $shift;
                  $this->data['shift_id']   = $shift;
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
                  $where['student_status.s_status_id'] = $application_status;
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
                  
                  if($hostel == 0):
                      $this->data['hostelId']  = $hostel;    
                      $custom['hostel']           = $hostel;
                  endif;
                  if($hostel == 1):
                      $this->data['hostelId']     = $hostel;    
                      $custom['hostel']           = $hostel;
                  endif;
                  
                  if($hostel == 2):
                      $this->data['hostelId']     = $hostel;    
                      $custom['hostel']           = $hostel;
                  endif;
                  
                  
                    switch ($hostel_req):
                        case '':
                            $where['hostel_required']       = '';
                             $this->data['hostelIdReq']     = $hostel_req;
                            break;
                        case '1':
                            $where['hostel_required']       = 'Yes'; 
                            $this->data['hostelIdReq']      = $hostel_req;
                            break;
                        case '2':
                            $where['hostel_required']       = 'No'; 
                            $this->data['hostelIdReq']      = $hostel_req;
                            break;
                    endswitch;
                  
                  
                  $custom['column']       = 'applicant_edu_detail.percentage';
                  $custom['order']        = 'desc';
                  
                  
                  
                  $this->load->library('excel');
                  $this->excel->setActiveSheetIndex(0);
                  //name the worksheet
                  $this->excel->getActiveSheet()->setTitle('Merit list');
                  //set cell A1 content with some text
                  
                  $this->excel->getActiveSheet()->setCellValue('A1', 'S#');
                  $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                  
                  
                  $this->excel->getActiveSheet()->setCellValue('B1', 'Form #');
                  $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('C1','C#');
                  
                  $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                  
                 
                  $this->excel->getActiveSheet()->setCellValue('D1', 'Student name');
                  $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('E1','Father name');
                  $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('F1','Gender');
                  $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                  
                  
                  $this->excel->getActiveSheet()->setCellValue('G1','Program');
                  $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
                  $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('I1','Open Merit');
                  $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('J1','Reserved Seat 1');
                  $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('K1','Reserved Seat 2');
                  $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('L1','Admission In');
                  $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('M1','Batch no');
                  $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('N1','Section');
                  $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('O1','Fata School');
                  $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('P1','Domicile');
                  $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('Q1','T.Marks');
                  $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('R1','O.Marks');
                  $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('S1','Percentage');
                  $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('T1','LAT Test Marks');
                  $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('U1','LAT Test Date');
                  $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('U1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('V1','Admission Comment');
                  $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('W1','Seat Comment');
                  $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('X1','Application status');
                  $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('Y1','Admission Date');
                  $this->excel->getActiveSheet()->getStyle('Y1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('Y1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('Z1','Religion');
                  $this->excel->getActiveSheet()->getStyle('Z1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('Z1')->getFont()->setSize(12);
              
                  $this->excel->getActiveSheet()->setCellValue('AA1','Address');
                  $this->excel->getActiveSheet()->getStyle('AA1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AA1')->getFont()->setSize(12);
              
                  $this->excel->getActiveSheet()->setCellValue('AB1','Father Mob#');
                  $this->excel->getActiveSheet()->getStyle('AB1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AB1')->getFont()->setSize(12);
              
                  $this->excel->getActiveSheet()->setCellValue('AC1','Blood Group');
                  $this->excel->getActiveSheet()->getStyle('AC1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AC1')->getFont()->setSize(12);
              
                  $this->excel->getActiveSheet()->setCellValue('AD1','Father CNIC');
                  $this->excel->getActiveSheet()->getStyle('AD1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AD1')->getFont()->setSize(12);
              
                  $this->excel->getActiveSheet()->setCellValue('AE1','Last School Address');
                  $this->excel->getActiveSheet()->getStyle('AE1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AE1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('AF1','Remarks 1');
                  $this->excel->getActiveSheet()->getStyle('AF1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AF1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AG1','Remarks 2');
                  $this->excel->getActiveSheet()->getStyle('AG1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AG1')->getFont()->setSize(12);
              
                  $this->excel->getActiveSheet()->setCellValue('AH1','Country');
                  $this->excel->getActiveSheet()->getStyle('AH1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AH1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('AI1','Shift');
                  $this->excel->getActiveSheet()->getStyle('AI1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AI1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('AJ1','Hostel');
                  $this->excel->getActiveSheet()->getStyle('AJ1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AJ1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('AK1','Std Mobile#');
                  $this->excel->getActiveSheet()->getStyle('AK1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AK1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('AL1','Student CNIC');
                  $this->excel->getActiveSheet()->getStyle('AL1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AL1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AM1','Verification Comments');
                  $this->excel->getActiveSheet()->getStyle('AM1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AM1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('AN1','Academic Comments');
                  $this->excel->getActiveSheet()->getStyle('AN1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AN1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('AO1','Entry Date time');
                  $this->excel->getActiveSheet()->getStyle('AO1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AO1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AP1','Challan Download Print Flag');
                  $this->excel->getActiveSheet()->getStyle('AP1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AP1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AQ1','Challan Paid Flag');
                  $this->excel->getActiveSheet()->getStyle('AQ1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AQ1')->getFont()->setSize(12);
                  
                  $this->excel->getActiveSheet()->setCellValue('AR1','DMC Upload Flag');
                  $this->excel->getActiveSheet()->getStyle('AR1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AR1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AS1','Roll No');
                  $this->excel->getActiveSheet()->getStyle('AS1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AS1')->getFont()->setSize(12);
                    
                  $this->excel->getActiveSheet()->setCellValue('AT1','Board Reg No');
                  $this->excel->getActiveSheet()->getStyle('AT1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AT1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AU1','Institute/School Name');
                  $this->excel->getActiveSheet()->getStyle('AU1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AU1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AV1','T.Marks 9th');
                  $this->excel->getActiveSheet()->getStyle('AV1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AV1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AW1','O.Marks 9th');
                  $this->excel->getActiveSheet()->getStyle('AW1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AW1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AX1','9th %');
                  $this->excel->getActiveSheet()->getStyle('AX1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AX1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AY1','Hostel Required');
                  $this->excel->getActiveSheet()->getStyle('AY1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AY1')->getFont()->setSize(12);
                 
                  $this->excel->getActiveSheet()->setCellValue('AZ1','Year of Passing');
                  $this->excel->getActiveSheet()->getStyle('AZ1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('AZ1')->getFont()->setSize(12);
                
                  $this->excel->getActiveSheet()->setCellValue('BA1','Student Email');
                  $this->excel->getActiveSheet()->getStyle('BB1')->getFont()->setBold(true);
                  $this->excel->getActiveSheet()->getStyle('BC1')->getFont()->setSize(12);
                  
                for($col = ord('A'); $col <= ord('Z'); $col++){
                  $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                  $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              }              
    $result   = $this->DashboardModel->admin_grand_report_excel('student_record',$where,$like,$custom,$date);

              
             $exceldata = array();
          foreach ($result as $row){
                  $exceldata[] = $row;
              }
                  $date = date('d-m-Y H:i:s');
                  $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                  $filename='GrandReport_'.$date.'.xls';
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="'.$filename.'"'); 
                  header('Cache-Control: max-age=0'); 
                  $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                  $objWriter->save('php://output');
              endif; 
              
              $this->data['ReportName']   = 'Admin Grand Report';
              $this->data['page']         = "Online/Dashboard/Reports/admin_grand_report_01v";
              $this->data['title']        = 'Admin Grand Report | ECP';
              $this->load->view('common/common', $this->data); 
   
          }
    public function fee_verification_report(){

                
                $this->data['stdName']      = '';
                $this->data['fatherName']   = '';
                $this->data['programe_id']  = '';
                $this->data['sub_pro_id']   = '';
                $this->data['Form']         = ''; 
                $this->data['status_id']    = ''; 
                $this->data['PaidTo']       = date('d-m-Y'); 
                $this->data['PaidFrom']     = date('d-m-Y'); 
                $this->data['batch_id']     = ''; 
                $this->data['paid_by_id']   = ''; 
           
           
            $default_batch                      = $this->CRUDModel->get_where_row('prospectus_batch',array('programe_id'=>1,'inter_default_flag'=>1));
            $this->data['sub_program']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['program']              = $this->CRUDModel->dropDown('programes_info', 'Select Program', 'programe_id', 'programe_name');
            $this->data['gender']               = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', 'Application Status', 's_status_id', 'name');
//            $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', '', 's_status_id', 'name',array('s_status_id'=>1));
            $this->data['FataStatus']           = $this->CRUDModel->dropDown('yesno', 'Fata Status', 'yn_value', 'yn_value');
            $this->data['hostel_required']      = $this->CRUDModel->dropDown('yesno', 'Hostel Required', 'yn_value', 'yn_value');
            $this->data['paid_by']              = $this->DashboardModel->dropDownPaidBy('Select User', 'emp_id', 'emp_name');
            $this->data['batch']                = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
            
            if($this->input->post('studentWise')):
                
                
                $Form               =  $this->input->post('Form');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $programe_id        =  $this->input->post('programe_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $s_status           =  $this->input->post('status_id');
                $batch              =  $this->input->post('batch');
                $paid_from          =  $this->input->post('paid_from');
                $paid_to            =  $this->input->post('paid_to');
                $paid_by            =  $this->input->post('paid_by');
              
                    $like = '';
//                $where= '';
                    $where['prospectus_challan.pros_paid_status']   = '2';
                    $date['PaidTo']             = $paid_to;
                    $date['PaidFrom']           = $paid_from;
                    
                    $this->data['PaidTo']       = $paid_to; 
                    $this->data['PaidFrom']     = $paid_from;
                 if(!empty($Form)):
                    $where['form_no']           = $Form;
                    $this->data['Form']         = $Form;
                endif;
                 if(!empty($paid_by)):
                    $where['emp_id']            = $paid_by;
                    $this->data['paid_by_id']   = $paid_by;
                endif;
                if(!empty($student_name)):
                    $like['student_name']       = $student_name;
                    $this->data['stdName']      = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name']        = $father_name;
                $this->data['fatherName']       = $father_name;
                endif;
                if(!empty($s_status)):
                    $where['student_record.s_status_id']            = $s_status;
                    $this->data['status_id']                        = $s_status;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id']                      = $gender;
                    $this->data['gender_id']                        = $gender;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id']            = $programe_id;
                    $this->data['programe_id']                      = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id']              = $sub_pro_id;
                    $this->data['sub_pro_id']                       = $sub_pro_id;
                endif;
                
                if(!empty($batch)):
                    $where['student_record.batch_id']               = $batch;
                    $this->data['batch_id']                         = $batch;
                endif;
              
                $this->data['result']               = $this->DashboardModel->fee_verification_report($where,$like,$date);
                  
                $this->data['count']                = count($this->data['result']);
                $this->data['report']               = 'StudentWise';
            endif;
            
            if($this->input->post('dateWise')):
                
                
                $Form               =  $this->input->post('Form');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $programe_id        =  $this->input->post('programe_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $s_status           =  $this->input->post('status_id');
                $batch              =  $this->input->post('batch');
                $paid_from          =  $this->input->post('paid_from');
                $paid_to            =  $this->input->post('paid_to');
                $paid_by            =  $this->input->post('paid_by');
              
                $like = '';
//                $where = '';
                $where['prospectus_challan.pros_paid_status']   = '2';
                $where['staffChild_flag']                       = '2';
//                $where['student_record.batch_id']   = $default_batch->batch_id;
                    $date['PaidTo']             = $paid_to;
                    $date['PaidFrom']           = $paid_from;
                    
                    $this->data['PaidTo']       = $paid_to; 
                    $this->data['PaidFrom']     = $paid_from;
                 if(!empty($Form)):
                    $where['form_no']           = $Form;
                    $this->data['Form']         = $Form;
                endif;
                 if(!empty($paid_by)):
                    $where['emp_id']            = $paid_by;
                    $this->data['paid_by_id']   = $paid_by;
                endif;
                if(!empty($student_name)):
                    $like['student_name']       = $student_name;
                    $this->data['stdName']      = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name']        = $father_name;
                $this->data['fatherName']       = $father_name;
                endif;
                if(!empty($s_status)):
                    $where['student_record.s_status_id']            = $s_status;
                    $this->data['status_id']                        = $s_status;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id']                      = $gender;
                    $this->data['gender_id']                        = $gender;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id']            = $programe_id;
                    $this->data['programe_id']                      = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id']              = $sub_pro_id;
                    $this->data['sub_pro_id']                       = $sub_pro_id;
                endif;
                
                if(!empty($batch)):
                    $where['student_record.batch_id']               = $batch;
                    $this->data['batch_id']                         = $batch;
                endif;
              
                $this->data['result']               = $this->DashboardModel->fee_verification_report_date_wise($where,$like,$date);
                $this->data['count']                = count($this->data['result']);
                $this->data['report']               = 'DateWise';
            endif;
            
            
            
            $this->data['ReportName']       = 'Fee Verification Report';
            $this->data['page_title']       = 'Fee Verification Report | ECP';
            $this->data['page']             = 'Online/Dashboard/Reports/fee_verifications_report';
            $this->load->view('common/common',$this->data);
       }
 
         public function applicant_record_admin(){
            
            $this->data['college_no']    = '';
            $this->data['stdName']      = '';
            $this->data['fatherName']   = '';
            $this->data['gender_id']    = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']   = '';
            $this->data['reg_no']       = ''; 
            $this->data['Form']         = ''; 
            $this->data['status_id']    = ''; 
            $this->data['fata_id']      = ''; 
            $this->data['hostel_required_id']     = ''; 
            $this->data['dbuser_id']     = $this->userInfo->user_id; 
            $default_batch = $this->CRUDModel->get_where_row('prospectus_batch',array('programe_id'=>1,'inter_default_flag'=>1));
            $this->data['batch_id']     = ''; 
            if($this->input->post()):
                
                $college_no         =  $this->input->post('college_no');
                $Form               =  $this->input->post('Form');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $programe_id        =  $this->input->post('programe_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $s_status           =  $this->input->post('status_id');
                $FataStatus         =  $this->input->post('FataStatus');
                $batch              =  $this->input->post('batch');
                $hostelStatus       =  $this->input->post('hostelStatus');
               
                $like = '';
                $where= '';
                 
              
                if(!empty($college_no)):
                    $where['college_no']        = $college_no;
                    $this->data['college_no']    = $college_no;
                endif;
                if(!empty($Form)):
                    $where['form_no']           = $Form;
                    $this->data['Form']         = $Form;
                endif;
                if(!empty($student_name)):
                    $like['student_name']       = $student_name;
                    $this->data['stdName']      = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name']        = $father_name;
                $this->data['fatherName']       = $father_name;
                endif;
                if(!empty($s_status)):
                    $where['student_record.s_status_id']            = $s_status;
                    $this->data['status_id']                        = $s_status;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id']                      = $gender;
                    $this->data['gender_id']                        = $gender;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id']            = $programe_id;
                    $this->data['programe_id']                      = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id']              = $sub_pro_id;
                    $this->data['sub_pro_id']                       = $sub_pro_id;
                endif;
                if(!empty($FataStatus)):
                    $where['student_record.fata_school']            = $FataStatus;
                    $this->data['fata_id']                          = $FataStatus;
                endif;
                if(!empty($hostelStatus)):
                    $where['student_record.hostel_required']        = $hostelStatus;
                    $this->data['hostel_required_id']               = $hostelStatus;
                endif;
                if(!empty($batch)):
                    $where['student_record.batch_id']               = $batch;
                    $this->data['batch_id']                         = $batch;
                endif;
                
                $this->data['result']   = $this->DashboardModel->stduent_data_verifications($where,$like); 
                $this->data['count']   = count($this->data['result']);
        else:
            
          
            //pagination start
            $config['base_url']         = base_url('ApplicantRecord');
            $config['total_rows']       = count($this->db->get('student_record')->result());  //echo $config['total_rows']; exit;
            $config['per_page']         = 50;
            $config["num_links"]        = 6;
            $config['uri_segment']      = 2;
            
            //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the ?Digit?? Link
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            //For PREVIOUS PAGE Setup
            $config['prev_link']        = "<i class='fa fa-angle-left'></i>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
                        
            //For NEXT PAGE Setup
            $config['next_link']        = "<i class='fa fa-angle-right'></i>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            
            //For LAST PAGE Setup
            $config['last_link']        = "<i class='fa fa-angle-double-right'></i>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            
            //For CURRENT page on which you are
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            
            
            
            $this->pagination->initialize($config);
            $page                           = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pagination_links'] = $this->pagination->create_links();
            //pagination start 
             $pagni_where = array(
//                 'student_record.batch_id'      => $default_batch->batch_id
             );
            $this->data['result']       = $this->DashboardModel->data_verification_pagination($config['per_page'],$page,$pagni_where); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
            
            $this->data['sub_program']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
//            $this->data['program']              = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>1));
            $this->data['program']              = $this->CRUDModel->dropDown('programes_info', 'Select Program', 'programe_id', 'programe_name',array('program_type_id'=>1));
            $this->data['gender']               = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
            $this->data['FataStatus']           = $this->CRUDModel->dropDown('yesno', 'Fata Status', 'yn_value', 'yn_value');
            $this->data['hostel_required']      = $this->CRUDModel->dropDown('yesno', 'Hostel Required', 'yn_value', 'yn_value');
            $this->data['batch']                = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $this->data['ReportName']           = 'Applicant Record';
            $this->data['page_title']           = 'Applicant Record | ECP';
            $this->data['page']                 = 'Online/Dashboard/Forms/applicant_record_admin';
            $this->load->view('common/common',$this->data);
             
        }  
        public function edit_applicant_picture(){
        
        $AppId = $this->input->post('student_id');
        $cha = $this->db->get_where('student_record',array('student_id'=>$AppId))->row();
//        echo '<pre>'; print_r($cha); die;
        echo '<form action="UpdateApplicantPicture" id="form_app_image" method="POST" role="form" enctype="multipart/form-data">
            <div class="modal-body">';
            echo '<div class="col-md-12" id="image_info_div" style="margin: 10px; text-align:center">
                <img alt="Preview is only available for PDF files. Make your file contains the required information." id="blah1" src="assets/images/students/'.$cha->applicant_image.'" class="" style="max-width:500px; max-height: 500px;">
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12" style="text-align:center">
                <input type="file" id="image_file"  name="file" class="form-control" autocomplete="off">
            </div>
            <p>&nbsp;</p>';
            echo '</div>
            <div class="modal-footer">
                <input type="hidden" name="applicant_picture" value="'.$cha->applicant_image.'">
                <input type="hidden" name="applicant_id" value="'.$AppId.'">';
                echo '<button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Dont Save</button>
                <button type="submit" class="btn btn-lg btn-success">Save Image</button>';
            echo '</div>
        </form> ';
     
        ?><script>
            jQuery(document).ready(function(){
                    
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#blah1').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $("#image_file").change(function() {
                    readURL(this);
                }); 
                
                jQuery("#form_app_image").submit(function(e){
                    e.preventDefault();
                    var formData = new FormData($("#form_app_image")[0]);

                    $.ajax({
                        url : $("#form_app_image").attr('action'),
                        type : 'POST',
                        data : formData,
                        contentType : false,
                        processData : false,
                        success: function(resp) {
                            jQuery('#ChangePictureModal').modal('toggle');
                            location.reload();
                        }
                    });
                });
            });
            
            
            </script><?php
    }
       public function update_applicant_picture(){
    
//        echo '<pre>'; print_r($this->input->post()); die;
        $config['upload_path']      = "assets/images/students";
        $config['allowed_types']    = 'bmp|jpg|png|jpeg|pdf|JPG';
        $config['file_name']        = $this->input->post('applicant_id').'_updated_'.date('ymd');
        $this->load->library('upload',$config);
        
        if($this->upload->do_upload("file")){
            
            $data       = array('upload_data' => $this->upload->data());
            $newPic = $data['upload_data']['file_name'];
            if(!empty($newPic)):
                $this->CRUDModel->update('student_record', array('applicant_image'=>$newPic), array('student_id'=>$this->input->post('applicant_id')));
            endif;
            if(!empty($this->input->post('applicant_picture'))):
                unlink('assets/images/students/'.$this->input->post('applicant_picture'));
            endif;
        }
    }
     
    public function edit_challan_picture(){
        
        $AppId = $this->input->post('student_id');
        $cha = $this->db->get_where('student_documents',array('sd_student_id'=>$AppId, 'sd_flag'=>1))->row();
//        echo '<pre>'; print_r($cha); die;
        echo '<form action="UpdateChallanPicture" id="form_cha_image" method="POST" role="form" enctype="multipart/form-data">
            <div class="modal-body">';
            if(!empty($cha)):
                echo '<div class="col-md-12" id="image_info_div" style="margin: 10px; text-align:center">
                    <img alt="No image uploaded" id="blah" src="assets/images/applicant_docs/'.$cha->sd_image.'" class="" style="max-width:500px; max-height: 500px;">
                </div>'; 
            else:
                echo '<div class="col-md-12" id="image_info_div" style="margin: 10px; text-align:center">
                    <img alt="No image uploaded" id="blah" src="" class="" style="max-width:500px; max-height: 500px;">
                </div>';
            endif;
            echo '<p>&nbsp;</p>
            <div class="col-md-12" style="text-align:center">
                <input type="file" id="image_files"  name="file" class="form-control" autocomplete="off">
            </div>
            <p>&nbsp;</p>';
            echo '</div>
            <div class="modal-footer">
                <input type="hidden" name="applicant_picture" value="'.@$cha->sd_image.'">
                <input type="hidden" name="applicant_id" value="'.$AppId.'">';
                echo '<button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Dont Save</button>
                <button type="submit" class="btn btn-lg btn-success">Save Image</button>';
            echo '</div>
        </form> ';
     
        ?><script>
            jQuery(document).ready(function(){
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#blah').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $("#image_files").change(function() {
                    readURL(this);
                }); 
                
                jQuery("#form_cha_image").submit(function(e){
                    e.preventDefault();
                    var formData = new FormData($("#form_cha_image")[0]);
                    $.ajax({
                        url : $("#form_cha_image").attr('action'),
                        type : 'POST',
                        data : formData,
                        contentType : false,
                        processData : false,
                        success: function(resp) {
                            jQuery('#ChangeChallanModal').modal('toggle');
                            location.reload();
                        }
                    });
                });
            });
                 
            </script><?php
    }
     public function update_challan_picture(){
        
        $app_id     = $this->input->post('applicant_id');
        $old_pic    = $this->input->post('applicant_picture');
        $check_pic  = $this->db->get_where('student_documents',array('sd_student_id'=>$app_id, 'sd_flag'=>1))->row();
//        echo '<pre>'; print_r($this->input->post()); die;
        if(!empty($check_pic)):
            $config['upload_path']      = "assets/images/applicant_docs";
            $config['allowed_types']    = 'bmp|jpg|png|jpeg|pdf|JPG';
            $config['file_name']        = $app_id.'_updated_'.date('ymd');
            $this->load->library('upload',$config);

            if($this->upload->do_upload("file")):

                $data   = array('upload_data' => $this->upload->data());
                $newPic = $data['upload_data']['file_name'];
                 
                if(!empty($newPic)):
                    $this->CRUDModel->update('student_documents', array('sd_image'=>$newPic), array('sd_id'=>$check_pic->sd_id));
                endif;
                if(!empty($old_pic)):
                    unlink('assets/images/applicant_docs/'.$old_pic);
                endif;
            endif;
        else:
            $config['upload_path']      = "assets/images/applicant_docs";
            $config['allowed_types']    = 'bmp|jpg|png|jpeg|pdf|JPG';
            $config['file_name']        = $app_id.'_updated_'.date('ymd');
            $this->load->library('upload',$config);

            if($this->upload->do_upload("file")){

                $data   = array('upload_data' => $this->upload->data());
                $newPic = $data['upload_data']['file_name'];
                 
                if(!empty($newPic)):
                    $ins_arr = array(
                        'sd_student_id' => $app_id,
                        'sd_image' => $newPic,
                        'sd_flag'       => 1,
                        'sd_datetime'   => date('Y-m-d H:i:s'),
                    );
                    $this->CRUDModel->insert('student_documents', $ins_arr);
                endif;
            }
        endif;
        
        
    }
      public function save_applicant_status(){
           
           $student_id  = $this->input->post('student_id');
           $status      = $this->input->post('app_status');
           
           $this->CRUDModel->update('student_record',array('s_status_id'=> $status),array('student_id'=>$student_id));
           
       }
public function edit_applicant_record_admin(){
         
        $stud_id        = $this->uri->segment(2);
        
        $bgOrder['column']          = 'title';
        $bgOrder['order']           = 'asc';
        $nameOrder['column']        = 'name';
        $nameOrder['order']         = 'asc';
        $yno['column']              = 'yn_value';
        $yno['order']               = 'asc';
        $year['column']             = 'yr_num';
        $year['order']              = 'desc';
        $mnet['column']             = 'network';
        $mnet['order']              = 'asc';
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Select', 'programe_id', 'programe_name',array('status'=>'yes'));
//        $this->data['program']      = $this->CRUDModel->dropDown_where_in_asc_title('programes_info', 'Select', 'programe_id', 'programe_name', 'programe_id', array(1,2,3,5,6,7,8,9,14));
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', '', 'sub_pro_id', 'name');
        $this->data['passing_year'] = $this->CRUDModel->dropDownLimit('year', '', 'yr_num', 'yr_num', '', $year, '1');
        $this->data['mobile_network']  = $this->CRUDModel->dropDown('mobile_network', 'Select', 'net_id', 'network', array('net_id !='=>0), $mnet);
        $this->data['countries']    = $this->CRUDModel->dropDown('country', 'Select', 'country_id', 'name', '', $nameOrder);
        $this->data['domicile']     = $this->CRUDModel->dropDown('domicile', 'Select', 'domicile_id', 'name', '', $nameOrder);
        $this->data['district']     = $this->CRUDModel->dropDown('district', 'Select', 'district_id', 'name', '', $nameOrder);
        $this->data['religion']     = $this->CRUDModel->dropDown('religion', 'Select', 'religion_id', 'title');
        $this->data['board_univ']   = $this->CRUDModel->dropDown('board_university', 'Select', 'bu_id', 'title', array('bu_status'=>1), $bgOrder);
        $this->data['father_occ']   = $this->CRUDModel->dropDown('occupation', 'Select', 'occ_id', 'title', '', $bgOrder);
        $this->data['hostelReq']    = $this->CRUDModel->dropDown('yesno', '', 'yn_value', 'yn_value', '', $yno);
        $this->data['bgroup']       = $this->CRUDModel->dropDown('blood_group', 'Select', 'b_group_id', 'title', array('b_group_id !=' => 9), $bgOrder);
        $this->data['degree']       = $this->CRUDModel->dropDown_where_in_desc_id('degree', '', 'degree_id', 'title', 'degree_id', array(36,77,1,2,17,39,77));
        
        $rs_order['column']         = 'name';
        $rs_order['order']          = 'asc';
        $b_order['column']          = 'batch_id';
        $b_order['order']           = 'desc';
        $this->data['reserved_seat']= $this->CRUDModel->get_where_not_in_result_order('reserved_seat', 'rseat_id', array(1,14), $rs_order);
        $this->data['batch']        = $this->CRUDModel->get_where_row_order('prospectus_batch', array('programe_id'=>1, 'inter_default_flag'=>1), $b_order);
        
        $this->data['st_data']        = $this->EdwardesModel->get_applicant_info('student_record', array('student_id'=>$stud_id));
        $this->data['st_acad_data']   = $this->EdwardesModel->get_applicant_education_info('applicant_edu_detail', array('applicant_edu_detail.student_id'=>$stud_id));
        
        $this->data['title']        = 'Edwardes College Peshawar | ECP';
        $this->data['page_title']   = 'Edit Applicant Record';
        $this->data['page']         = 'Online/Dashboard/Forms/edit_applicant_record';
        $this->data['descriptions'] = 'Edwardes College Online Admission Form, Admission Form 2020,Edwardes College Online Admission Form 2020,Form 2020,ECP,Edwardess,Edwardes College, College Admission,Online admission, Online Admission 2020,edwardes college peshawar admission 2020,admission 2020';  
        $this->load->view('common/common',$this->data); 
    }
    
    public function getCheckSubjects(){
        $sub_pro_id = $this->input->post('subId');
        $student_id = $this->input->post('stdId');

         $result    = $this->CRUDModel->get_where_result('subject',array('sub_pro_id'=>$sub_pro_id));
        echo '<div class="form-group col-md-12">
                    <table class="table table-boxed table-hover">
                        <thead>
                            <tr>    
                                <th>F.A Subjects (Choose only one language subject among Pashto, English Adv and Urdu Adv) - <span style="color:#c00;">*Maximum 6 subjects are allowed </span></th>
                            </tr>
                        </thead>
                        <tbody><tr><td>';
                        foreach($result as $resRow):
                            
                            $alloted   = $this->CRUDModel->get_where_row('new_student_subjects',array('student_id'=>$student_id, 'subject_id'=>$resRow->subject_id));
                            if(empty($alloted)):
                                $checked = '';
                            else:
                                $checked = 'checked="checked"';
                            endif;
                            echo '<div class="form-group col-md-3">
                                <input type="checkbox" name="artSubj[]" value="'.$resRow->subject_id.'" id="artSubj" class="artSubj" '.$checked.' autocomplete="off">&nbsp;&nbsp;
                                <span><strong>'.$resRow->title.'</strong></span>
                            </div>';
                        endforeach;
                    echo 
                        '</td></tr></tbody>
                    </table>
            </div>';
        ?><script>
            $(document).ready(function(){
                $('.artSubj').on('change', function() {
                    if($('.artSubj:checked').length > 6) {
                        this.checked = false;
                    }
                 });
            });
        </script><?php
    }
    
    
    public function update_applicant_record(){
         
//        echo '<pre>'; print_r($this->input->post()); die;
        $reser  = $this->input->post('rs_seats');
        $std_id = $this->input->post('std_id');
        
        $seat1 = '0';
        $seat2 = '0';
                
        if(!empty($reser[0])):
            $seat1 = $reser[0];
        endif;
        if(!empty($reser[1])):
            $seat2 = $reser[1];
        endif;
        
        // Update
        $data1 = array(
            'programe_id'       => $this->input->post('programe_id'),
            'sub_pro_id'        => $this->input->post('sub_pro_id'),
            'batch_id'          => $this->input->post('batch'),
            'reg_batch_id'      => $this->input->post('batch'),
            'student_comments'  => strtoupper($this->input->post('comments')),
            'rseats_id'         => $this->input->post('open_merit'),
            'rseats_id1'        => $seat1,
            'rseats_id3'        => $seat2,
            'student_name'      => strtoupper($this->input->post('student_name')),
            'applicant_mob_no1' => $this->input->post('student_mobile'),
            'std_mobile_network' => $this->input->post('student_network'),
            'student_cnic'      => $this->input->post('student_cnic'),
            'gender_id'         => $this->input->post('gender'),
            'dob'               => $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
            'bg_id'             => $this->input->post('bld_group'),
            'domicile_id'       => $this->input->post('domicile'),
            'district_id'       => $this->input->post('district'),
            'religion_id'       => $this->input->post('religion'),
            'hostel_required'   => $this->input->post('hostel'),
            'father_name'       => strtoupper($this->input->post('father_name')),
            'father_cnic'       => $this->input->post('father_cnic'),
            'land_line_no'      => $this->input->post('landline'),
            'mobile_no'         => $this->input->post('father_mobile'),
            'net_id'            => $this->input->post('father_network'),
            'occ_id'            => $this->input->post('occupation'),
            'annual_income'     => $this->input->post('income'),
            'father_email'      => $this->input->post('email'),
            'app_postal_address' => strtoupper($this->input->post('postal')),
            'parmanent_address' => strtoupper($this->input->post('permanent')),
            'guardian_name'     => strtoupper($this->input->post('guardian_name')),
            'guardian_cnic'     => $this->input->post('guardian_cnic'),
            'g_mobile_no'       => $this->input->post('guardian_mobile'),
            'fata_school'       => $this->input->post('fata')
//            'idcc_user_id'      => $this->userInfo->user_roleId,
        );
//        if(!empty($this->input->post('sub_pro_id')) && !empty($this->input->post('student_mobile'))):
//            $check_data = $this->CRUDModel->get_where_row('student_record', array('applicant_mob_no1'=>$this->input->post('student_mobile'), 'sub_pro_id'=>$this->input->post('sub_pro_id')));
//            if(empty($check_data)):
                
                $this->CRUDModel->update('student_record', $data1, array('student_id'=>$std_id));

        //        $reser = '';
        //        if(!empty($this->input->post('rs_seats'))):
        //            $reser = $this->input->post('rs_seats');
        //        endif;

                $acad_data = array(
//                    'student_id'        => $std_id,
                    'degree_id'         => $this->input->post('degree'),
                    'inst_id'           => strtoupper($this->input->post('school')),
                    'bu_id'             => $this->input->post('board_univ'),
                    'year_of_passing'   => $this->input->post('p_year'),
                    'total_marks'       => $this->input->post('total_marks'),
                    'obtained_marks'    => $this->input->post('obt_marks'),
                    'percentage'        => round($this->input->post('percentage'),2),
                    'total_marks_9th'   => $this->input->post('total_marks_9th'),
                    'obtained_marks_9th' => $this->input->post('obt_marks_9th'),
                    'percentage_9th'    => round($this->input->post('percentage_9th'),2),
                    'sub_pro_id '       => $this->input->post('sub_pro_id'),
                    'exam_type'         => $this->input->post('exam'),
                    'rollno'            => $this->input->post('board_roll'),
                    'board_reg_no'      => $this->input->post('board_reg'),
                    'academic_comments' => strtoupper($this->input->post('acad_comments'))
                );

                $this->CRUDModel->update('applicant_edu_detail', $acad_data, array('student_id'=>$std_id));

                if($this->input->post('sub_pro_id') == 5):
                    $ides   = $this->input->post('artSubj');
                    if(!empty($ides)):
                        $this->CRUDModel->deleteid('new_student_subjects', array('student_id'=>$std_id));
                        foreach($ides as $row=>$value):
                            $sub_data = array(
                                 'student_id'   => $std_id,
                                 'subject_id'   => $value,
                                 'sub_prog_id'  => $this->input->post('sub_pro_id'),
            //                     'created_by'   => $this->userInfo->user_id,
                                 'date_time'    => date('Y-m-d H:i:s'),
                                );
                            $this->CRUDModel->insert('new_student_subjects',$sub_data);
                        endforeach;
                    endif;
                else:
                    $this->CRUDModel->deleteid('new_student_subjects', array('student_id'=>$std_id));
                endif;


                //Fee Record Insertion 
//                $head_fee_where = array(
//        //          'program_id'  =>1,
//        //            'batch_id'  =>67,
//                    'status'  =>1,
//                );
//                $fee_heads = $this->CRUDModel->get_where_row('prospectus_fee_head',$head_fee_where);
//                 $due_date = $this->CRUDModel->get_where_row('prospectus_challan_duedate',array('status'=>1));
//                $data = array(
//                    'student_id'        => $std_id,
//                    'pros_fee_id'       => $fee_heads->pros_fee_head_id,
//                    'date'              => date('Y-m-d'),
//                    'due_date'          => date('Y-m-d',strtotime($due_date->due_date)),
//                    'create_datetime'   => date('Y-m-d H:i:s'),
//                );
//                $challan_id = $this->CRUDModel->insert('prospectus_challan',$data);
//                $set = array('form_no'=>$challan_id);
//                $where_data        = array('student_id'=>$std_id);
//                $this->CRUDModel->update('student_record',$set,$where_data);
//
//
//                // Save IP Address Of User
//                  $ip_address = $this->input->ip_address();
////                  $ip = '111.119.188.24';
////                    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
////                    echo '<pre>';print_R($details);die;
////                    echo $details->city;
//                  $data_ip = array(
//                    'ip_address'        => $ip_address,  
//                    'student_id'        => $std_id,  
//                    'date'              => date('Y-m-d'),  
//                    'time'              => date('H:i:s'),  
//                    'create_datetime'   => date('Y-m-d H:i:s'),  
//                  );
//
//                $this->CRUDModel->insert('user_ip_checking',$data_ip);



//                $userData['app_id'] = $std_id;
//                $this->session->set_userdata($userData);
                redirect('ApplicantRecordOnline'); 
//            endif;
//            $userData['app_id'] = $this->session->all_userdata()['app_id'];
//            $this->session->set_userdata($userData);
//            redirect('ApplicantProfile');
//          else:  
//            $check_dataDD = $this->CRUDModel->get_where_row('student_record', array('applicant_mob_no1'=>$this->input->post('student_mobile'), 'sub_pro_id'=>$this->input->post('sub_pro_id')));
////          echo '<Pre>';print_r($check_dataDD);die;
//            $userData['app_id'] = $check_dataDD;
//                $this->session->set_userdata($userData);
//                redirect('ApplicantProfile'); 
        
            
//        endif;
    }
    
    public function edit_applicant_status(){
             
           $student_id              = $this->input->post('student_id');
           $currentStatus           = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
           
            $student_status       = $this->CRUDModel->dropDown_where_in_asc_id('student_status', '', 's_status_id', 'name', 's_status_id', array(1,15,17,18));
            
           echo '<div class="modal-body">
                <section class="course-finder">
                <div class="col-md-12 subject form-group">
                 <p>&nbsp;</p>
                <label style="text-indent: 3px">Applicant Status<span style="color:red">*</span></label>';
                echo form_dropdown('app_status', $student_status, $currentStatus->s_status_id,  'class="form-control" id="app_status" autocomplete="off" '); 
                echo '<input type="hidden" name="student_id" id="student_id" class="form-control" value="'.$student_id.'">
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
                  jQuery(document).ready(function(){
                   jQuery('.saveStatus').on('click',function(){
        
                        var student_id  = jQuery('#student_id').val();
                        var app_status  = jQuery('#app_status').val();
                        
                          jQuery.ajax({
                               type   :'post',
                               url    :'SaveAppStatus',
                               data   :{'student_id':student_id,'app_status':app_status},
                              success :function(result){
                                  jQuery('#ChangeStatusModal').modal('toggle');
                                  location.reload();
                              }
                           });
                    });
                
                });
                </script> 
              
              
              <?php   
           
       }  
    public function fee_challan_new_admission(){
       
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('program_type_id'=>1,'status'=>'Yes'));
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pay_categ']    = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title',array('prospectus_batch.status'=>'on'));
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('category_type'=>1,'bank_id'=>'17'));
        $this->data['default_year_fy'] = $this->db->order_by('id','desc')->get('fee_financial_year')->row()->id;
        $this->data['year']         = $this->CRUDModel->dropDown('fee_financial_year','', 'id', 'year');
        $this->data['batch']        = $this->CRUDModel->DropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('prospectus_batch.status'=>'on'));
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['pc_id']        = '';
        $this->data['sub_pro_id']   = '';
        $this->data['issuDate']     = '';
        $this->data['batch_id']     = '';
        $this->data['Section']      = '';
        
        $this->data['fromDate']      = '';
        $this->data['uptoDate']      = '';
        $this->data['dueDate']       = date('d-m-Y');
        $this->data['issuDate']      = date('d-m-Y');
        
        $this->data['default_bank'] = $this->DefaultFeeBank->bank_id;
        $this->data['gender_id']    = '';
                                        $this->db->order_by('obtained_marks','desc');
                                        $this->db->limit('1','0');
         $max_numbers               =   $this->db->get_where('applicant_edu_detail')->row();
         $this->data['std_no_from'] =   '';
         if(empty($max_numbers)):
             $this->data['std_no_to']   =   0;
             else:
             $this->data['std_no_to']   =   $max_numbers->obtained_marks;
         endif;
         
        
        
        
        if($this->input->post('GenerateChallanNewAdmission')):
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $batch_id        = $this->input->post("batch_id");
            $pc_id          = $this->input->post("pc_id");
            $fromDate       = $this->input->post("fromDate");
            $toDate         = $this->input->post("uptoDate");
            $bank_id        = $this->input->post("bank_id");
            $comment        = $this->input->post("comment");
            $std_no_from    = $this->input->post("std_no_from");
            $std_no_to      = $this->input->post("std_no_to");
            $gender         = $this->input->post("gender");
            $dueDate         = $this->input->post("dueDate");
            $issuDate         = $this->input->post("issuDate");
        
            $where = '';
            if($batch_id):
                $where['prospectus_batch.batch_id'] = $batch_id;
                $this->data['batch_id']             = $batch_id;
            endif;
            if($programe_id):
                $where['programes_info.programe_id']= $programe_id;
                $this->data['programe_id']          = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($pc_id)):
                $this->data['pc_id']               = $pc_id;
            endif;
            if(!empty($gender)):
                $this->data['gender_id']            = $gender;
                $where['gender.gender_id']          = $gender;
            endif;
            $std_no['std_no_from']          = $std_no_from;
            $std_no['std_no_to']            = $std_no_to;
             $this->data['std_no_from']     = $std_no_from;
            $this->data['std_no_to']        = $std_no_to;
            
            $this->data['fromDate']      = $fromDate;
            $this->data['uptoDate']      = $toDate;
            $this->data['dueDate']       = $dueDate;
            $this->data['issuDate']      = $issuDate;
            
            
            $this->data['result']= $this->FeeModel->fee_challan_students_admission($where,$std_no);
            
        endif;
         
        if($this->input->post('fee_save_challan')):
            $userInfo       = json_decode(json_encode($this->getUser()), FALSE);
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $batch_id       = $this->input->post("batch_id");
            $fromDate       = $this->input->post("fromDate");
            $uptoDate       = $this->input->post("uptoDate");
            $dueDate        = $this->input->post("dueDate");
            $issuDate       = $this->input->post("issuDate");
            $bank_id        = $this->input->post("bank_id");
            $year_id        = $this->input->post("year_id");
            $comment        = $this->input->post("challan_comment");
           
            $where = '';
//            $where['student_record.rseats_id !='] = 12;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
                
            endif;
            if(!empty($batch_id)):
                $where['prospectus_batch.batch_id'] = $batch_id;
                $this->data['batch_id']     = $batch_id;
                
            endif;
//           $result = $this->FeeModel->fee_challan_students_fee_generate($where);
             
          
//******************************************************************************************************            
//********************            FEE CHALLAN  GENERATION                             ******************
//******************************************************************************************************
           
            
             //student name challan
             foreach($this->input->post('studentIds') as $row=>$student):
                                $this->db->select('
                                        student_record.college_no,
                                        student_record.form_no,
                                        student_record.batch_id,
                                        student_record.father_cnic,
                                        student_record.student_id,
                                        student_record.sub_pro_id,
                                        student_record.programe_id,
                                        student_record.student_name,
                                        student_record.father_name,
                                        sections.name as sectionsName,
                                        sections.sec_id as section_id,
                                        student_status.name as current_status
                                        ');
                                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
               $studentRow =    $this->db->get_where('student_record',array('student_record.student_id'=>$student))->row();
//               echo '<pre>';print_r($studentRow);die;
//            foreach($result as $studentRow):
                $check_payment_type = $this->db->where(array('pc_id'=>$pc_id,'cat_title_id'=>1))->get('fee_payment_category')->row();
                $fee_challan_exist  = $this->CRUDModel->key_exists('fee_challan',array('fc_student_id'=>$studentRow->student_id,'fc_pay_cat_id'=>$pc_id,'installment_type'=>1));
 
//******************************************************************************************************            
//********************            FEE CHALLAN CHECKING IF EXIST                       ******************
//******************************************************************************************************
                
            if(empty($fee_challan_exist)):
                if(empty($fee_challan_exist->fc_student_id)):
                    $total_balanc_an = $this->CRUDModel->get_where_row('fee_total_anual',array('sub_pro_id'=>$sub_pro_id));
//******************************************************************************************************            
//********************            CHECKING ANNUAL AMOUNT AGISNT SUB PROGRAM           ******************
//****************************************************************************************************** 
  
                    $sectionID = '';
                 if($studentRow->section_id):
                     $sectionID =$studentRow->section_id;
                     else:
                     $sectionID = 0;
                 endif;
                   
//                   echo 'testdsfsd';die;
              //Insert challan info against the student
                   $data = array(
                    'fc_student_id'     => $studentRow->student_id,
                    'fc_student_id'     => $studentRow->student_id,
                    'program_id_paid'   => $studentRow->programe_id,
                    'batch_id_paid'     => $studentRow->batch_id,
                    'sub_pro_id_paid'   => $studentRow->sub_pro_id,
                    'section_id_paid'   => $sectionID,

                       
                    'fc_ch_status_id'   => 1, //Challan status not paid
                    'fc_paid_form'      => date_format(date_create($fromDate),"Y-m-d"), 
                    'fc_paid_upto'      => date_format(date_create($uptoDate),"Y-m-d"), 
                    'fc_dueDate'        => date_format(date_create($dueDate),"Y-m-d"), 
                    'fc_issue_date'     => date_format(date_create($issuDate),"Y-m-d"), 
                    'fc_pay_cat_id'     => $pc_id, 
                    'fc_bank_id'        => $bank_id, 
                    'challan_id_lock'   => 0, 
                    'financial_id'      => $year_id, 
                    'fc_comments'       => $comment, 
                    'fc_timestamp'      => date('Y-m-d H:i:s'), 
                    'fc_userId'         => $userInfo->user_id
                    );
                       
                        $challan_id = $this->CRUDModel->insert('fee_challan',$data);
                         //Search info about installement detials and insert to fee_challan_detail table
                        
                       $fee_setups = $this->CRUDModel->get_where_result('fee_class_setups',array('pc_id'=>$pc_id,'sub_pro_id'=>$sub_pro_id));
                    
//                       echo '<pre>';print_r($fee_setups);die;
                       
                        $this->RQ($challan_id,'assets/RQ/challan_rq/');
                        $this->CRUDModel->update('fee_challan',array('fc_challan_rq'=>$challan_id.'.png'),array('fc_challan_id'=>$challan_id));
                        //Check old balance amount 
                        $old_balance = array(
//                            'fc_student_id'   =>'7096',  
                                'fc_student_id'     => $studentRow->student_id,  
                                'balance >'         => 0,
                                'delete_head_flag' =>1,  
                        );
//                                            $this->db->select('student_name,fee_challan.fc_challan_id,fee_actual_challan_detail.balance,');
                                             $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                        $old_balane_amount = $this->db->get_where('fee_challan',$old_balance)->result();
                       
                      if(!empty($old_balane_amount)):
                         foreach($old_balane_amount as $OLBA):
                          
                      
                          $pc_cat  = '';
                                if(empty($OLBA->fc_pay_cat_id)):
                              $pc_cat = '25';
                              else:
                             $pc_cat = $OLBA->fc_pay_cat_id; 
                          endif;
                          
                            $datafs = array(
                                'challan_id'        => $challan_id,
                                'fee_id'            => $OLBA->fee_id,
                                'actual_amount'     => $OLBA->balance,
                                'paid_amount'       => $OLBA->balance,
                                'balance'           => $OLBA->balance,
                                'comment'           => $OLBA->comment,
                                'old_balance_pc_id' => $pc_cat,
                                'challan_status'    => 1,
                                'add_new_heads_flag'=> 1,
                                'timestamp'         => date('Y-m-d H:i:s'),
                                'useId'             => $userInfo->user_id
                            );
                            $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                          
                            // add old challan id into New challan 
                            $this->CRUDModel->update('fee_challan',array('old_balance_challan_id'=>$OLBA->fc_challan_id),array('fc_challan_id'=>$challan_id));
                           //Lock Old challan 
                            $this->CRUDModel->update('fee_challan',array('challan_id_lock'=>1),array('fc_challan_id'=>$OLBA->fc_challan_id));
                          
                            //Remove balance from old challan table
                            $this->CRUDModel->update('fee_actual_challan_detail',array('balance'=>0),array('challan_detail_id'=>$OLBA->challan_detail_id));
                          
                        endforeach;
                        
                            
                      endif;
                        
                        
                        $student_balance = 0;
                       foreach($fee_setups as $fsRow):
                    $datafs = array(
                                'challan_id'    => $challan_id,
                                'fee_id'        => $fsRow->fcs_id,
                                'actual_amount' => $fsRow->fcs_amount,
                                'paid_amount'   => $fsRow->fcs_amount,
                                'balance'       => $fsRow->fcs_amount,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
//                            $student_balance +=$fsRow->fcs_amount;
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                       endforeach;
                       
                       
//                       die;
                    //insert Extra Head againt the challan 
                        
                  $fee_setups_heads = $this->CRUDModel->get_where_result('fee_extra_heads',array('student_id'=>$studentRow->student_id,'apply_status'=>1));
                   if($fee_setups_heads):
                      foreach($fee_setups_heads as $fsRow):
                           
                        $fine_setups = array(
                            'fh_Id'            =>$fsRow->fh_id,
                            'fcs_amount'       =>$fsRow->amount,
                            'fcs_timestamp'    => date('Y-m-d H:i:s'), 
                            'fcs_userId'       => $userInfo->user_id
                        );
             
                    $actual_chal_head = $this->CRUDModel->insert('fee_class_setups',$fine_setups);
                                
                    $datafs = array(
                                'challan_id'    => $challan_id,
                                'fee_id'        => $actual_chal_head,
                                'actual_amount' => $fsRow->amount,
                                'paid_amount'   => $fsRow->amount,
                                'balance'       => $fsRow->amount,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                           
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                       endforeach;
                       
                      $fee_setups_heads = $this->CRUDModel->update('fee_extra_heads',array('apply_status'=>2),array('student_id'=>$studentRow->student_id)); 
                      endif;   
                       //End new Heads
                       $where_fee_balance = array(
                         'challan_id'=>$challan_id  
                       );
                                                      $this->db->select('sum(balance) as balance');  
                                                      $this->db->group_by('challan_id');
                    $challan_installment_balance =    $this->db->get_where('fee_actual_challan_detail',$where_fee_balance)->row();
                       
                    //Insert All Current balance against the Payment Category 
                    //1st Payment,2nd Payments....
                    $student_current_balance = array(
                                'student_id'    => $studentRow->student_id,
                                'pay_cat_id'    => $pc_id,
                                'r_amount'      => $challan_installment_balance ->balance,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'userId'        => $userInfo->user_id  
                            );
                    $this->CRUDModel->insert('fee_balance',$student_current_balance);
                    //Fee Challan Details
                        $student_balance_insert = array(
                                'challan_id'    =>$challan_id,
                                'student_id'    =>$studentRow->student_id,
                                'ch_status_id'  =>1,
                                'date'          =>date_format(date_create($fromDate),"Y-m-d"),
                                'timestamp'     =>date('Y-m-d H:i:s'),
                                'userId'        => $userInfo->user_id

                                );
                        $this->CRUDModel->insert('fee_challan_history',$student_balance_insert);
//                   echo 'challan not Exist';
                endif;
                if(!empty($challan_id)):
                    
                        //Generate PDF
                        $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$studentRow->student_id));
                        $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$challan_id));
                        $where                      = array(
                                            'fc_student_id '=> $this->data['feeComments']->fc_student_id,
                                            'fc_paid_form <='=> $this->data['feeComments']->fc_paid_form
                                     );
                        $this->data['FeeHeads']     = $this->FeeModel->feeDetails_head_print($where);
                               
//                        $this->data['std_data'] = $this->FeeModel->fee_admission_challan_details(array('student_record.student_id'=>$studentRow->student_id));
                        $html = $this->load->view('Online/Fee/fee_admisssion_challan_pdf',$this->data,true);
//                        $html = $this->load->view('Fee/Forms/fee_admisssion_challan_pdf',$this->data,true);

                        $dompdf = new PDF();
                        $dompdf->load_html($html);
                        $dompdf->set_paper('A4', 'landscape');
                        $dompdf->render();
                        $dompdf->get_canvas()->get_cpdf()->setEncryption('', 'n.*7&4%i:[}', array('print'));
                        $output = $dompdf->output();
                        $data = file_put_contents('student_challan/'.str_replace("-", "", $studentRow->form_no).'.pdf', $output);
                        unset($dompdf);
                        unset($data);
                    
                        //End PDF
                 
                
                endif;
                endif;
                
                $balance_CREDIT = 0;
                $credit_amount =  $this->db->get_where('fee_challan',array('fc_student_id'=>$studentRow->student_id,'credit_flag'=>1,'fc_challan_credit_amount >'=>0))->row();
                    if(!empty($credit_amount)):
                        $challan_comments = $credit_amount->fc_comments.' Credit apply in challan#'.$challan_id;

                                                $this->db->join('fee_class_setups','fee_class_setups.pc_id=fee_payment_category.pc_id');
                        $check_payment_type =   $this->db->where(array('fee_payment_category.pc_id'=>$pc_id,'fh_Id'=>24))->get('fee_payment_category')->row();


                        $WHERE = array(
                               'challan_id'            => $challan_id,
                               'fee_id'                => $check_payment_type->fcs_id,   
                               'old_balance_pc_id'     => 0
                        );
                       $credit_row     =   $this->db->get_where('fee_actual_challan_detail',$WHERE)->row();

                       $SET_CREDIT     = array(
                           'old_credit_amount'=>$credit_amount->fc_challan_credit_amount 
                        );
                        //Update New Challan Details balance
                        $this->CRUDModel->update('fee_actual_challan_detail',$SET_CREDIT,array('challan_detail_id'=>$credit_row->challan_detail_id));
                        //Update old credit challan for apply credit to new challan
                        $this->CRUDModel->update('fee_challan',array('credit_flag'=>2,'fc_comments'=>$challan_comments),array('fc_challan_id'=>$credit_amount->fc_challan_id));
                    
                        $this->db->order_by('balance_id','desc');     
                        $this->db->limit('0','1');     
                        $current_challan_balance = $this->db->get_where('fee_balance',array('student_id'=>$studentRow->student_id))->row();

                        $balance_CREDIT = $current_challan_balance->r_amount-$credit_amount->fc_challan_credit_amount;  
                        //Update Remove CREDIT from fee Balance table
                        $this->CRUDModel->update('fee_balance',array('r_amount'=>$balance_CREDIT,'comments'=>'Credit Adujst Rs:'.$credit_amount->fc_challan_credit_amount.'/'),array('balance_id'=>$current_challan_balance->balance_id));
                        endif;
                        
            endforeach;
            
            
            if($section):
                    redirect('PrintClassWise/'.$programe_id.'/'.$sub_pro_id.'/'.$section.'/'.$pc_id);
                else:
                    redirect('FeeChallanNewAdmission');
            endif;
            
//            redirect('feeChallan');
        endif;
        
        $this->data['page']         = 'Online/Fee/fee_challan_new_admission';
        $this->data['page_header']  = 'Fee Challan Generate ( New Admission )';
        $this->data['page_title']   = 'Fee Challan Generate ( New Admission ) | ECMS';
        $this->load->view('common/common',$this->data);
        
    }      
       
        public function student_pdf_verify(){
            
            $this->data['collegeNo']    = '';
            $this->data['stdName']      = '';
            $this->data['fatherName']   = '';
            $this->data['gender_id']    = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']   = '';
            $this->data['reg_no']       = ''; 
            $this->data['Form']         = ''; 
            $this->data['status_id']    = ''; 
            $this->data['fata_id']      = ''; 
            $this->data['hostel_required_id']     = ''; 
            $default_batch              = $this->CRUDModel->get_where_row('prospectus_batch',array('programe_id'=>1,'inter_default_flag'=>1));
            $this->data['batch_id']     = ''; 
//            $this->data['batch_id']     = $default_batch->batch_id; 
            if($this->input->post()):
                
                $college_no         =  $this->input->post('college_no');
                $Form               =  $this->input->post('Form');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $programe_id        =  $this->input->post('programe_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $s_status           =  $this->input->post('status_id');
                $FataStatus         =  $this->input->post('FataStatus');
                $batch              =  $this->input->post('batch');
                $hostelStatus       =  $this->input->post('hostelStatus');
               
                $like = '';
//                $where['student_record.batch_id']   = $default_batch->batch_id;
                $where['student_record.s_status_id !='] = '17'; 
              
                if(!empty($college_no)):
                    $where['college_no']        = $college_no;
                    $this->data['collegeNo']    = $college_no;
                endif;
                if(!empty($Form)):
                    $where['form_no']           = $Form;
                    $this->data['Form']         = $Form;
                endif;
                if(!empty($student_name)):
                    $like['student_name']       = $student_name;
                    $this->data['stdName']      = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name']        = $father_name;
                $this->data['fatherName']       = $father_name;
                endif;
                if(!empty($s_status)):
                    $where['student_record.s_status_id']            = $s_status;
                    $this->data['status_id']                        = $s_status;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id']                      = $gender;
                    $this->data['gender_id']                        = $gender;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id']            = $programe_id;
                    $this->data['programe_id']                      = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id']              = $sub_pro_id;
                    $this->data['sub_pro_id']                       = $sub_pro_id;
                endif;
                if(!empty($FataStatus)):
                    $where['student_record.fata_school']            = $FataStatus;
                    $this->data['fata_id']                          = $FataStatus;
                endif;
                if(!empty($hostelStatus)):
                    $where['student_record.hostel_required']        = $hostelStatus;
                    $this->data['hostel_required_id']               = $hostelStatus;
                endif;
                if(!empty($batch)):
                    $where['student_record.batch_id']               = $batch;
                    $this->data['batch_id']                         = $batch;
                endif;
                $this->data['result']   = $this->DashboardModel->stduent_data_verifications($where,$like); 
                $this->data['count']   = count($this->data['result']);
        else:
            
          
            //pagination start
            $config['base_url']         = base_url('VerifyPDF');
            $config['total_rows']       = count($this->CRUDModel->get_wherein_result('student_record','student_record.s_status_id',array('15','1')));  //echo $config['total_rows']; exit;
//            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('student_record.s_status_id'=> '15')));  //echo $config['total_rows']; exit;
            $config['per_page']         = 50;
            $config["num_links"]        = 6;
            $config['uri_segment']      = 2;
            
            //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the ?Digit?? Link
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            //For PREVIOUS PAGE Setup
            $config['prev_link']        = "<i class='fa fa-angle-left'></i>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
                        
            //For NEXT PAGE Setup
            $config['next_link']        = "<i class='fa fa-angle-right'></i>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            
            //For LAST PAGE Setup
            $config['last_link']        = "<i class='fa fa-angle-double-right'></i>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            
            //For CURRENT page on which you are
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            
            
            
            $this->pagination->initialize($config);
            $page                           = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pagination_links'] = $this->pagination->create_links();
            //pagination start 
             $pagni_where = array(
                 'student_record.s_status_id'   => '15',
//                 'student_record.batch_id'      => $default_batch->batch_id
             );
            $this->data['result']       = $this->DashboardModel->data_verification_pagination($config['per_page'],$page); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
            
            $this->data['sub_program']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
//            $this->data['program']              = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>1));
            $this->data['program']              = $this->CRUDModel->dropDown('programes_info','Select Program', 'programe_id', 'programe_name',array('program_type_id'=>1));
            $this->data['gender']               = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name', array('s_status_id !='=> 17));
            $this->data['FataStatus']           = $this->CRUDModel->dropDown('yesno', 'Fata Status', 'yn_value', 'yn_value');
            $this->data['hostel_required']      = $this->CRUDModel->dropDown('yesno', 'Hostel Required', 'yn_value', 'yn_value');
            $this->data['batch']                = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on'));
            
            $this->data['ReportName']           = 'Student PDF Verify';
            $this->data['page_title']           = 'Student PDF Verify | ECP';
            $this->data['page']                 = 'Online/Pdf/student_pdf_verify';
            $this->load->view('common/common',$this->data);
        }
    public function generate_singale_pdf(){
             
             $student_id = $this->uri->segment(2);    
             
                           $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id'); 
             $studentRow = $this->db->get_where('student_record',array('student_id'=>$student_id))->row();
              
//             $challan_id = $this->uri->segment(2);       
                        //Generate PDF
                        $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$studentRow->student_id));
                        $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$studentRow->fc_challan_id));
                        $where                      = array(
                                            'fc_student_id '=> $this->data['feeComments']->fc_student_id,
                                            'fc_paid_form <='=> $this->data['feeComments']->fc_paid_form
                                     );
                        $this->data['FeeHeads']     = $this->FeeModel->feeDetails_head_print($where);
                               
//                        $this->data['std_data'] = $this->FeeModel->fee_admission_challan_details(array('student_record.student_id'=>$studentRow->student_id));
                        $html = $this->load->view('Online/Fee/fee_admisssion_challan_pdf',$this->data,true);
//                        $html = $this->load->view('Fee/Forms/fee_admisssion_challan_pdf',$this->data,true);

                        $dompdf = new PDF();
                        $dompdf->load_html($html);
                        $dompdf->set_paper('A4', 'landscape');
                        $dompdf->render();
                        $dompdf->get_canvas()->get_cpdf()->setEncryption('', 'n.*7&4%i:[}', array('print'));
                        $output = $dompdf->output();
//                        $data = file_put_contents('student_challan/'.str_replace("-", "", $studentRow->form_no).'.pdf', $output);
                        $data = file_put_contents('challan_gen/'.str_replace("-", "", $studentRow->form_no).'.pdf', $output);
                        unset($dompdf);
                        unset($data);
                    
                        //End PDF
                 
                redirect('VerifyPDF');
}   

    
    public function online_bs_admission_form(){
      
        $bgOrder['column']  = 'title';
        $bgOrder['order']   = 'asc';
        $nameOrder['column']  = 'name';
        $nameOrder['order']   = 'asc';
        $yno['column']  = 'yn_value';
        $yno['order']   = 'asc';
        $year['column']  = 'yr_num';
        $year['order']   = 'desc';
        $mnet['column']  = 'network';
        $mnet['order']   = 'asc';
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['program']      = $this->CRUDModel->dropDown_where_in_asc_title('programes_info', 'Select', 'programe_id', 'programe_name', 'programe_id', array(2,3,6,7,8,9,14,17));
        $this->data['passing_year'] = $this->CRUDModel->dropDownLimit('year', '', 'yr_num', 'yr_num', '', $year, '2');
        $this->data['mobile_network']  = $this->CRUDModel->dropDown('mobile_network', 'Select', 'net_id', 'network', array('net_id !='=>0), $mnet);
        $this->data['countries']    = $this->CRUDModel->dropDown('country', 'Select', 'country_id', 'name', '', $nameOrder);
        $this->data['domicile']     = $this->CRUDModel->dropDown('domicile', 'Select', 'domicile_id', 'name');
        $this->data['district']     = $this->CRUDModel->dropDown('district', 'Select', 'district_id', 'name');
        $this->data['religion']     = $this->CRUDModel->dropDown('religion', 'Select', 'religion_id', 'title');
        $this->data['board_univ']   = $this->CRUDModel->dropDown('board_university', 'Select', 'bu_id', 'title');
        $this->data['father_occ']   = $this->CRUDModel->dropDown('occupation', 'Select', 'occ_id', 'title', '', $bgOrder);
        $this->data['hostelReq']    = $this->CRUDModel->dropDown('yesno', '', 'yn_value', 'yn_value', '', $yno);
        $this->data['bgroup']       = $this->CRUDModel->dropDown('blood_group', 'Select', 'b_group_id', 'title', array('b_group_id !=' => 9), $bgOrder);
        $this->data['degree']       = $this->CRUDModel->dropDown_where_in_asc_id('degree', 'Select', 'degree_id', 'title', 'degree_id', array(2,12,17,39,77));
        
        $rs_order['column'] = 'name';
        $rs_order['order'] = 'asc';
//        $this->data['reserved_seat'] = $this->CRUDModel->get_where_not_in_result_order('reserved_seat', 'rseat_id', array(1,3,4,5,6,7,8,9,11,13), $rs_order);
        $this->data['reserved_seat'] = $this->CRUDModel->get_where_result_order('reserved_seat', array('rseat_id!='=>1), $rs_order);
        
        $this->data['title']        = 'Edwardes College Peshawar | ECP';
        $this->data['page_title']   = 'Online Admission Form';
        $this->data['page']         = 'Online/Dashboard/Forms/online_bs_admission_form';
        $this->data['descriptions'] = 'Edwardes College Online Admission Form, Admission Form 2020,Edwardes College Online Admission Form 2020,Form 2020,ECP,Edwardess,Edwardes College, College Admission,Online admission, Online Admission 2020,edwardes college peshawar admission 2020,admission 2020'; 
        $this->load->view('common/common',$this->data);    
    }
    
    public function getSubProgram(){
        
        $program_id = $this->input->post('programId');
        if($program_id == '1'):
            $limit['limit'] = '4';
            $limit['start'] = '0';
            $resultf = $this->CRUDModel->get_where_result_limit('sub_programes',array('programe_id' => $program_id), $limit);
            foreach($resultf as $far):
                echo '<option value="'.$far->sub_pro_id.'">'.$far->name.'</option>';
            endforeach;
        elseif($program_id == '5'):
            $resulta = $this->CRUDModel->get_wherein_result('sub_programes', 'sub_pro_id', array(15,37));
            foreach($resulta as $ar):
                echo '<option value="'.$ar->sub_pro_id.'">'.$ar->name.'</option>';
            endforeach;
        else:
            $result = $this->CRUDModel->get_where_row('sub_programes',array('programe_id' => $program_id));
            echo '<option value="'.$result->sub_pro_id.'">'.$result->name.'</option>';
        endif;
        
    }
    
    public function getBatchId(){
        
        $order['column']    = 'batch_id';
        $order['order']     = 'desc';
        $result = $this->CRUDModel->get_where_row_order('prospectus_batch', array('programe_id'=>$this->input->post('programId')), $order);
        echo $result->batch_id;
        
    }
    
    public function getBatchName(){
        
        $order['column']    = 'batch_id';
        $order['order']     = 'desc';
        $result = $this->CRUDModel->get_where_row_order('prospectus_batch', array('programe_id'=>$this->input->post('programId')), $order);
        echo $result->batch_name;
        
    }
    
    
    public function save_online_admission_form(){
         
//        echo '<pre>'; print_r($this->input->post()); die;
        $image      = $this->CRUDModel->do_resize('image_file','assets/images/new_students/');
        $file_name  = $image['file_name'];
        
        
        $reser = $this->input->post('rs_seats');
        
        $seat1 = '0';
        $seat2 = '0';
                
        if(!empty($reser[0])):
            $seat1 = $reser[0];
        endif;
        if(!empty($reser[1])):
            $seat2 = $reser[1];
        endif;
        
        $subProg = '';
        switch ($this->input->post('programe_id')):
            case "2":   $subProg = 6;   break;
            case "3":   $subProg = 10;  break;
            case "6":   $subProg = 44;  break;
            case "7":   $subProg = 46;  break;
            case "8":   $subProg = 34;  break;
            case "9":   $subProg = 55;  break;
            case "14":  $subProg = 82;  break;
            case "17":  $subProg = 104; break;
            default:    $subProg = $this->input->post('sub_pro_id');
        endswitch;
        
        // 9th Class Marks Calculation
//        $tm9 = $this->input->post('total_marks_9th');
//        $om9 = $this->input->post('obt_marks_9th');
//        $pa9 = $this->input->post('percentage_9th');
//        
//        $tm10 = $tm9*2;
//        $om10 = $om9*2;
//        $incr = $om9*0.03;
//        $gomk = $incr+$om10;
//        $pa10 = $gomk/$tm10*100;
        
//        echo $om9.'/'.$tm9.' '.$pa9.'<br>';
//        echo $gomk.'/'.$tm10.' '.$pa10; die;
        // Insert
        $data1 = array(
            'batch_id'          => $this->input->post('batch'),
            'reg_batch_id'      => $this->input->post('batch'),
            'programe_id'       => $this->input->post('programe_id'),
            'sub_pro_id'        => $subProg,
            'student_comments'  => strtoupper($this->input->post('comments')),
            'rseats_id'         => $this->input->post('open_merit'),
            'rseats_id1'        => $seat1,
            'rseats_id3'        => $seat2,
            'student_name'      => strtoupper($this->input->post('student_name')),
            'applicant_mob_no1' => $this->input->post('student_mobile'),
            'std_mobile_network' => $this->input->post('student_network'),
            'student_cnic'      => $this->input->post('student_cnic'),
            'gender_id'         => $this->input->post('gender'),
            'dob'               => $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
            'bg_id'             => $this->input->post('bld_group'),
            'country_id'        => 1,
            'domicile_id'       => $this->input->post('domicile'),
            'district_id'       => $this->input->post('district'),
            'religion_id'       => $this->input->post('religion'),
            'hostel_required'   => $this->input->post('hostel'),
            'father_name'       => strtoupper($this->input->post('father_name')),
            'father_cnic'       => $this->input->post('father_cnic'),
            'land_line_no'      => $this->input->post('landline'),
            'mobile_no'         => $this->input->post('father_mobile'),
            'net_id'            => $this->input->post('father_network'),
            'occ_id'            => $this->input->post('occupation'),
            'annual_income'     => $this->input->post('income'),
            'father_email'      => $this->input->post('email'),
            'app_postal_address' => strtoupper($this->input->post('postal')),
            'parmanent_address' => strtoupper($this->input->post('permanent')),
            'guardian_name'     => strtoupper($this->input->post('guardian_name')),
            'guardian_cnic'     => $this->input->post('guardian_cnic'),
            'g_mobile_no'       => $this->input->post('guardian_mobile'),
            'fata_school'       => $this->input->post('fata'),
            's_status_id'       => 15,
            'applicant_image'   => $file_name,
            'timestamp'         => date('Y-m-d H:i:s'),
            'user_id'           => $this->userInfo->user_id,
        );
//        if(!empty($this->input->post('sub_pro_id')) && !empty($this->input->post('student_mobile'))):
            $check_data = $this->CRUDModel->get_where_row('student_record', array('applicant_mob_no1'=>$this->input->post('student_mobile'), 'sub_pro_id'=>$this->input->post('sub_pro_id')));
//            if(empty($check_data)):
                
                $std_id = $this->CRUDModel->insert('student_record', $data1);

        //        $reser = '';
        //        if(!empty($this->input->post('rs_seats'))):
        //            $reser = $this->input->post('rs_seats');
        //        endif;

                $acad_data = array(
                    'student_id'        => $std_id,
                    'degree_id'         => $this->input->post('degree'),
                    'inst_id'           => strtoupper($this->input->post('school')),
                    'bu_id'             => $this->input->post('board_univ'),
                    'year_of_passing'   => $this->input->post('p_year'),
                    'total_marks'       => $this->input->post('total_marks'),
                    'obtained_marks'    => $this->input->post('obt_marks'),
                    'percentage'        => round($this->input->post('percentage'),2),
                    'total_marks_9th'   => $this->input->post('total_marks_9th'),
                    'obtained_marks_9th' => $this->input->post('obt_marks_9th'),
                    'percentage_9th'    => $this->input->post('percentage_9th'),
                    'sub_pro_id '       => $this->input->post('sub_pro_id'),
                    'lat_marks'         => $this->input->post('lat_marks'),
                    'lat_date'          => $this->input->post('lat_date'),
                    'exam_type'         => $this->input->post('exam'),
                    'rollno'            => $this->input->post('board_roll'),
                    'board_reg_no'      => $this->input->post('board_reg'),
                    'academic_comments' => strtoupper($this->input->post('acad_comments')),
                    'timestamp'         => date('Y-m-d H:i:s'),
                );

                $this->CRUDModel->insert('applicant_edu_detail', $acad_data);

//                $ides   = $this->input->post('artSubj');
//                if(!empty($ides)):
//                    foreach($ides as $row=>$value):
//                        $sub_data = array(
//                             'student_id'   => $std_id,
//                             'subject_id'   => $value,
//                             'sub_prog_id'  => $this->input->post('sub_pro_id'),
//        //                     'created_by'   => $this->userInfo->user_id,
//                             'date_time'    => date('Y-m-d H:i:s'),
//                            );
//                        $this->CRUDModel->insert('new_student_subjects',$sub_data);
//                    endforeach;
//                endif;
//


                //Fee Record Insertion 
                $head_fee_where = array(
        //          'program_id'  =>1,
        //            'batch_id'  =>67,
                    'status'  =>1,
                );
                $fee_heads = $this->CRUDModel->get_where_row('prospectus_fee_head',$head_fee_where);
                $due_date = $this->CRUDModel->get_where_row('prospectus_challan_duedate',array('status'=>1,'program_id'=>$this->input->post('programe_id')));
                 
                 
                $data = array(
                    'student_id'        => $std_id,
                    'pros_amount'       => $fee_heads->amount,
                    'pros_fee_id'       => $fee_heads->pros_fee_head_id,
                    'date'              => date('Y-m-d'),
                    'due_date'          => date('Y-m-d',strtotime($due_date->due_date)),
                    'create_datetime'   => date('Y-m-d H:i:s'),
                );
                $challan_id = $this->CRUDModel->insert('prospectus_challan',$data);
                $set = array('form_no'=>$challan_id);
                $where_data        = array('student_id'=>$std_id);
                $this->CRUDModel->update('student_record',$set,$where_data);

                redirect('AllBSRecords');
                
//                $landing = $this->CRUDModel->get_where_row('student_record', array('student_id'=>$std_id));
//                
//                switch ($landing->programe_id):
//                    case "2": redirect('admin/cs_student_record');
//                    case "3": redirect('StudentRecordHND');
//                    case "6": redirect('StudentRecordBBA');
//                    case "7": redirect('StudentRecordEDSML');
//                    case "8": redirect('Admin/bs_english_student_record');
//                    case "9": redirect('admin/law_student_record');
//                    case "14": redirect('admin/economics_student_record');
//                    case "17": redirect('admin/admin_home');
//                endswitch;
                
    }
public function online_parent_general_message(){
    
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']  = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        $this->data['shift']            = $this->CRUDModel->dropDown('shift', ' Select Shift', 'shift_id', 'name');
        $this->data['DMCUpload']        = $this->CRUDModel->dropDown('yesno', ' Select Challan', 'yn_id', 'yn_value');
        $this->data['ChallanUpload']    = $this->CRUDModel->dropDown('yesno', ' Select Option', 'yn_id', 'yn_value');
         $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', ' Select Status', 'hostel_status_id', 'status_name');
        
        $this->data['college_no']  = '';
        $this->data['message']      = '';
        $this->data['gender_id']    = '';
        $this->data['status_id']        = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        $this->data['smsPassword']  = '';
        $this->data['pictureId']    = '';
        $this->data['shift_id']         = '';
        $this->data['dmc_up_id']        = '';
        $this->data['hostelIdReq']      = '';
        $this->data['challan_up_id']    = '';
        $this->data['verify_marks_id']  = '';
        $this->data['entry_date_from']  = '';
        $this->data['entry_date_to'] = date('d-m-Y');
        $this->data['hostel_status_id']         = '';
        
                        $this->db->order_by('obtained_marks','desc');
                        $this->db->limit('1','0');
         $max_numbers = $this->db->get_where('applicant_edu_detail')->row();
         $this->data['std_no_from'] = '';
         $this->data['std_no_to']   = $max_numbers->obtained_marks;
         
                        $this->db->order_by('obtained_marks_9th','desc');
                        $this->db->limit('1','0');
         $max_numbers9th = $this->db->get_where('applicant_edu_detail')->row();
         $this->data['std_no_from_9th'] = '';
         $this->data['std_no_to_9th']   = $max_numbers9th->obtained_marks_9th;
        
        if($this->input->post('search')):
            
            $collegeNo      = $this->input->post("collegeNo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message        = $this->input->post("message");
            $student_status = $this->input->post("student_status");
            $smsPassword    = $this->input->post("smsPassword");
            $picture        = $this->input->post("picture");
            $shift          = $this->input->post("shift");
            $hostel_status  = $this->input->post("hostel_status");
            
            $std_no_from    = $this->input->post("std_no_from");
            $std_no_to      = $this->input->post("std_no_to");
            
            $std_no_from_9th    = $this->input->post("std_no_from_9th");
            $std_no_to_9th      = $this->input->post("std_no_to_9th");
            
            
            $entry_date_from    = $this->input->post("entry_date_from");
            $entry_date_to      = $this->input->post("entry_date_to");
            
            $upload_challan      = $this->input->post("upload_challan");
            $upload_dmc          = $this->input->post("upload_dmc");
            
            $verify_marks       = $this->input->post("verify_marks");
             $hostel_req        = $this->input->post("hostel_req");
            
            
            $where      = '';
            $like       = '';
            $date       = '';
            $document       = '';
            
            
             
              switch ($hostel_req):
                case '':
                     $where['hostel_required'] = '';
                     $this->data['hostelIdReq']          = $hostel_req;
                    break;
                case '1':
                    $where['hostel_required'] = 'Yes'; 
                    $this->data['hostelIdReq']          = $hostel_req;
                    break;
                case '2':
                    $where['hostel_required'] = 'No'; 
                    $this->data['hostelIdReq']          = $hostel_req;
                    break;
            endswitch;
            
            $this->data['challan_up_id']        = $upload_challan;
            $document['challan_upload']         = $upload_challan;
             if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;  
            if($verify_marks):
                    $this->data['verify_marks_id']     = $verify_marks;
                    $where['app_verify_flag']        = $verify_marks;
                     
            endif;
            if(empty($entry_date_from)):
                
                $date['entry_date_to']      = $entry_date_to;
                $this->data['entry_date_to']    = $entry_date_to;
                
            else:
                $date['entry_date_from']    = $entry_date_from;
                $date['entry_date_to']      = $entry_date_to;
                
                $this->data['entry_date_from']  = $entry_date_from;
                $this->data['entry_date_to']    = $entry_date_to;
            endif;
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_status_id'] = $hostel_status;
            endif;
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($shift):
                $where['student_record.shift_id']   = $shift;
                $this->data['shift_id']             = $shift;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['college_no']          = $collegeNo;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;
            if(!empty($message)):
            
                $this->data['message']      = $message;
            endif;
            if(!empty($smsPassword)):
                $this->data['smsPassword']  = $smsPassword;
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
            
            
            $std_no['std_no_from']  =$std_no_from;
            $std_no['std_no_to']    =$std_no_to;
            
            $this->data['std_no_from'] = $std_no_from;
            $this->data['std_no_to']   = $std_no_to;
            
            $std_no['std_no_from_9th']  =$std_no_from_9th;
            $std_no['std_no_to_9th']    =$std_no_to_9th;
            
            $this->data['std_no_from_9th'] = $std_no_from_9th;
            $this->data['std_no_to_9th']   = $std_no_to_9th;
            
            
            $this->data['result'] = $this->DashboardModel->student_fee_sms_parent($where,$like,$std_no,$date,$document);
            
        endif;
         if($this->input->post('sendSMS')):
              
        $chunk_arrray = array_chunk($this->input->post("checked"), 100);
          
            foreach($chunk_arrray as $chunkRow):
                
                $message        = $this->input->post("message");
                $formCode       = $this->input->post("formCode");
                $sn = '';
                $sender_number  = '';
                $sender_number_check  = '';
                foreach($chunkRow as $key=>$student_id):
               
                    $student_info   = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));
               
                     $section = '';
                    if($student_info):
                        $sn++; 
                       if($student_info->section_id):
                            $section = $student_info->section_id;
                            else:
                            $section = 0;
                        endif;
                        
                        $std_network = $this->db->get_where('mobile_network',array('net_id'=>$student_info->net_id))->row();
                        
                        if(empty($student_info->net_id) && $student_info->net_id === '0'):
                
                                $sender_number_check .= $this->CRUDModel->clean_number($student_info->mobile_no).',';  
                            else:
                                $sender_number_check .= $this->CRUDModel->clean_number($student_info->mobile_no).$std_network->send_format.',';  
                
                        endif; 
                     $data = array(
                        'student_id'        => $student_info->student_id,
                        'program_id'        => $student_info->programe_id,
                        'formCode'          => $formCode,
                        'sub_pro_id'        => $student_info->sub_pro_id,
                        'sec_id'            => $section,
                        'batch_id'          => $student_info->batch_id,
                        'sms_type'          => 1,
                        'message'           => $message,
                        'network'           => $student_info->mobile_network,
                        'sender_number'     => $this->CRUDModel->clean_number($student_info->mobile_no),
                        'create_datetime'   => date('Y-m-d H:i:s'),
                        'send_date'         => date('Y-m-d'),  
                        'create_by'         => $this->userInfo->user_id, 
                      );
                       
               $this->CRUDModel->insert('sms_students',$data);
                     
             endif;
            endforeach;
        
           $chec_last = substr($sender_number_check,'-1');
           
           if($chec_last == ','):
            $sender_number =    substr($sender_number_check,0,'-1');
               else:
             $sender_number =   $sender_number;
           endif;
               
            $return_message = '';
          
             if($sn >1): //Multiple msg
             
                $return         =   $this->send_message_bulk($sender_number,$message);
                $decode_res     =   json_decode($return,true);
//                 echo '<pre>';print_r($return);die;
              if(!empty($decode_res['numbers'])):
                   foreach($decode_res['numbers'] as $row):
                    $status     = '';
                    if($row['status']):
                        $status = $row['status'];
                    else:
                        $return_message[]   =  'Mobile#'.$sender_number.'  ERROR#'.$status;
                        $status             =  $row['status'];
                    endif;
                    if($status ==  'OK'):
                        $update_data = array(
                            'delevery_status'   => 1,
                            'comments'          => json_encode($row),
                            'message_status'    => $status);
                        
                        $where_up = array(
                            'sender_number'   => $this->CRUDModel->clean_number($row['number']),
                            'send_date'       => date('Y-m-d'),
                            'formCode'        => $formCode,  
                          );   
                    else:
                        $update_data = array(
                            'delevery_status'   => 2,
                            'comments'          => json_encode($row),
                            'message_status'    => $status);
                    
                    $where_up = array(
                        'sender_number'   => $this->CRUDModel->clean_number($row['number']),
                        'send_date'       => date('Y-m-d'),
                        'formCode'        => $formCode,  
                      );
                    endif;
                    $this->CRUDModel->update('sms_students',$update_data,$where_up);
                endforeach;
                else:
                    $update_data = array(
                      'comments'    => $return  
                    );
                    $where_up = array(
                            'send_date'       => date('Y-m-d'),
                            'formCode'        => $formCode,  
                          ); 
                    $this->CRUDModel->update('sms_students',$update_data,$where_up);
                 
              endif;
 
                else: // Singal Message
                   
                    $chec_last = substr($sender_number_check,'-1');
           
                    if($chec_last == ','):
                     $sender_number =    substr($sender_number_check,0,'-1');
                        else:
                      $sender_number =   $sender_number;
                    endif;
                
                    $number_sendxtz = explode(',',$sender_number);
                    $return         = $this->send_message($number_sendxtz[0],$message); 
                    $result         = json_decode($return,true);
                
                    if($result):
                        
                        if(@$result['status'] ==  'ACCEPTED'):
                             $update_data = array(
                                'delevery_status'   => 1,
                                'message_status'    => $result['status'],
                                'comments'          => $return,
                            );
                        $where_up = array(
                            'sender_number'     =>  $this->CRUDModel->clean_number($sender_number),
                              'send_date'       =>  date('Y-m-d'),
                              'formCode'        =>  $formCode,

                          );     
                         $this->CRUDModel->update('sms_students',$update_data,$where_up); 
                        
                        else:
                            $update_data = array(
                                    'delevery_status'   => 2,
                                    'message_status'    => $result['numbers'][0]['status'],
                                    'comments'          => $return,
                            );
                        $where_up = array(
                                'sender_number'   =>  $this->CRUDModel->clean_number($student_info->mobile_no),
                                'send_date'       =>  date('Y-m-d'),
                                'formCode'        =>  $formCode,

                          );     
                         $this->CRUDModel->update('sms_students',$update_data,$where_up); 
                         
                        endif;
                    endif;
              endif;
                
           endforeach;
     
           if(empty($return_message)):
                     
              $this->session->set_flashdata('success_return', 'Messages send successfully.....'); 
           else:
               $this->session->set_flashdata('error_return', $return_message);
           endif;
           redirect('OnlineParentMsg');
         endif;
         
        $this->data['page']         = 'Online/sms/guardian_message';
        $this->data['page_header']  = 'Student Guardian Message';
        $this->data['page_title']   = 'Student Guardian | ECMS';
        $this->load->view('common/common',$this->data);
    }    
        public function online_student_general_message(){

        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        $this->data['shift']            = $this->CRUDModel->dropDown('shift', ' Select Shift', 'shift_id', 'name');
        $this->data['DMCUpload']        = $this->CRUDModel->dropDown('yesno', ' Select Challan', 'yn_id', 'yn_value');
        $this->data['ChallanUpload']    = $this->CRUDModel->dropDown('yesno', ' Select Option', 'yn_id', 'yn_value');
        $this->data['reserved_seat1']   = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
        $this->data['reserved_seat2']   = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', ' Select Status', 'hostel_status_id', 'status_name');
                        
        $this->data['hostelIdReq']  = '';
        $this->data['message']      = '';
        $this->data['gender_id']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        $this->data['smsPassword']  = '';
        $this->data['pictureId']    = '';
        $this->data['shift_id']     = '';
        $this->data['reserved_seat_id1']        = '';
        $this->data['reserved_seat_id2']        = '';
        $this->data['dmc_up_id']                = '';
        $this->data['challan_up_id']            = '';
        $this->data['verify_marks_id']          = '';
        $this->data['hostelIdReq']              = '';
        $this->data['hostel_status_id']         = '';
        
        $this->data['entry_date_from']= '';
        $this->data['entry_date_to'] = date('d-m-Y');
        
                        $this->db->order_by('obtained_marks','desc');
                        $this->db->limit('1','0');
         $max_numbers = $this->db->get_where('applicant_edu_detail')->row();
         $this->data['std_no_from'] = '';
         $this->data['std_no_to']   = $max_numbers->obtained_marks;
         
                        $this->db->order_by('obtained_marks_9th','desc');
                        $this->db->limit('1','0');
         $max_numbers9th = $this->db->get_where('applicant_edu_detail')->row();
         $this->data['std_no_from_9th'] = '';
         $this->data['std_no_to_9th']   = $max_numbers9th->obtained_marks_9th;
        
                       
                        $this->db->order_by('college_no','desc');
                        $this->db->limit('1','0');
         $max_collegeNo = $this->db->get_where('student_record',array('college_no >'=>'1','s_status_id'=>5))->row();
//         echo '<pre>';print_r($max_collegeNo);die;
         $this->data['college_no_from']      = '';
         $this->data['college_no_to']        = $max_collegeNo->college_no;
         
        if($this->input->post('search')):
            
            $collegeNoFrom  = $this->input->post("collegeNoFrom");
            $collegeNoTo    = $this->input->post("collegeNoTo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message        = $this->input->post("message");
            $student_status = $this->input->post("student_status");
            $smsPassword    = $this->input->post("smsPassword");
            $picture        = $this->input->post("picture");
            $shift          = $this->input->post("shift");
            $hostel_status  = $this->input->post("hostel_status");
            $hostel_req     = $this->input->post("hostel_req");
            
            $std_no_from    = $this->input->post("std_no_from");
            $std_no_to      = $this->input->post("std_no_to");
            
            $std_no_from_9th    = $this->input->post("std_no_from_9th");
            $std_no_to_9th      = $this->input->post("std_no_to_9th");
            
            
            $entry_date_from    = $this->input->post("entry_date_from");
            $entry_date_to      = $this->input->post("entry_date_to");
            
            $upload_challan     = $this->input->post("upload_challan");
            $upload_dmc         = $this->input->post("upload_dmc");
            
            $verify_marks       = $this->input->post("verify_marks");
            $reserved_seat1     = $this->input->post("reserved_seat1");
            $reserved_seat2     = $this->input->post("reserved_seat2");
            
            
            $where      = array();
            $like       = array();
            $date       = array();
            $document   = '';
            
            switch ($hostel_req):
                case '':
                     $where['hostel_required'] = '';
                     $this->data['hostelIdReq']          = $hostel_req;
                    break;
                case '1':
                    $where['hostel_required'] = 'Yes'; 
                    $this->data['hostelIdReq']          = $hostel_req;
                    break;
                case '2':
                    $where['hostel_required'] = 'No'; 
                    $this->data['hostelIdReq']          = $hostel_req;
                    break;
            endswitch;
            $this->data['challan_up_id']     = $upload_challan;
            $document['challan_upload']      = $upload_challan;
            if($verify_marks):
                $this->data['verify_marks_id']     = $verify_marks;
                $where['app_verify_flag']        = $verify_marks;
                
            endif;
            if(empty($entry_date_from)):
                $date['entry_date_to']          = $entry_date_to;
                $this->data['entry_date_to']    = $entry_date_to;
                
                else:
                $date['entry_date_from']    = $entry_date_from;
                $date['entry_date_to']      = $entry_date_to;
                
                $this->data['entry_date_from']  = $entry_date_from;
                $this->data['entry_date_to']    = $entry_date_to;
                    
            endif;
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_status_id'] = $hostel_status;
            endif;
            if($reserved_seat1):
                $where['student_record.rseats_id1']         = $reserved_seat1;
                $this->data['reserved_seat_id1']            = $reserved_seat1;
            endif;
            if($reserved_seat2):
                $where['student_record.rseats_id3']     = $reserved_seat2;
                $this->data['reserved_seat_id2']        = $reserved_seat2;
            endif;
            if($gender):
                $where['student_record.gender_id']  = $gender;
                $this->data['gender_id']            = $gender;
            endif;
            if($shift):
                $where['student_record.shift_id']   = $shift;
                $this->data['shift_id']             = $shift;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;
            if(!empty($message)):
            
                $this->data['message']      = $message;
            endif;
            if(!empty($smsPassword)):
                $this->data['smsPassword']  = $smsPassword;
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
            
            
            $std_no['std_no_from']      = $std_no_from;
            $std_no['std_no_to']        = $std_no_to;
            
            $this->data['std_no_from']  = $std_no_from;
            $this->data['std_no_to']    = $std_no_to;
            
            $std_no['std_no_from_9th']  = $std_no_from_9th;
            $std_no['std_no_to_9th']    = $std_no_to_9th;
            
            $this->data['std_no_from_9th'] = $std_no_from_9th;
            $this->data['std_no_to_9th']   = $std_no_to_9th;
            
            
             $this->data['college_no_from']      = $collegeNoFrom;
             $this->data['college_no_to']        = $collegeNoTo;
             
             $document['college_no_from']        = $collegeNoFrom;
             $document['college_no_to']          = $collegeNoTo;
            
            $this->data['result'] = $this->DashboardModel->student_fee_sms($where,$like,$std_no,$date,$document);
            
        endif;
         if($this->input->post('sendSMS')):
              
        $chunk_arrray = array_chunk($this->input->post("checked"), 100);
          
            foreach($chunk_arrray as $chunkRow):
                
                $message                = $this->input->post("message");
                $formCode               = $this->input->post("formCode");
                $sn                     = '';
                $sender_number          = '';
                $sender_number_check    = '';
                foreach($chunkRow as $key=>$student_id):
               
                    $student_info   = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));
               
                     $section = '';
                    if($student_info):
                        $sn++; 
                       if($student_info->section_id):
                            $section = $student_info->section_id;
                            else:
                            $section = 0;
                        endif;
                        
                        if(!empty($student_info->applicant_mob_no1)):
                            
                            
                            $std_network = $this->db->get_where('mobile_network',array('net_id'=>$student_info->std_mobile_network))->row();
                          if(empty($student_info->std_mobile_network) && $student_info->std_mobile_network === '0'):
                                    $sender_number_check .= $this->CRUDModel->clean_number($student_info->applicant_mob_no1).',';
                                else:
                                    $sender_number_check .= $this->CRUDModel->clean_number($student_info->applicant_mob_no1).$std_network->send_format.',';
                            endif;

                     $data = array(
                        'student_id'        => $student_info->student_id,
                        'program_id'        => $student_info->programe_id,
                        'formCode'          => $formCode,
                        'sub_pro_id'        => $student_info->sub_pro_id,
                        'sec_id'            => $section,
                        'batch_id'          => $student_info->batch_id,
                        'sms_type'          => 1,
                        'message'           => $message,
                        'network'           => $std_network->send_format,
                        'sender_number'     => $this->CRUDModel->clean_number($student_info->applicant_mob_no1),
                        'create_datetime'   => date('Y-m-d H:i:s'),
                        'send_date'         => date('Y-m-d'),  
                        'create_by'         => $this->userInfo->user_id, 
                      );
                        
              $this->CRUDModel->insert('sms_students',$data);
                endif;     
             endif;
            endforeach;
           
           $chec_last = substr($sender_number_check,'-1');
           
           if($chec_last == ','):
            $sender_number =    substr($sender_number_check,0,'-1');
               else:
             $sender_number =   $sender_number;
           endif;
             
            $return_message = '';
          
            if($sn >1): //Multiple msg
                 
                $return         =   $this->send_message_bulk($sender_number,$message);
                $decode_res     =   json_decode($return,true);
                
              
              if(!empty($decode_res['numbers'])):
                   foreach($decode_res['numbers'] as $row):
                    $status     = '';
                    if($row['status']):
                        $status = $row['status'];
                    else:
                        $return_message[]   =  'Mobile#'.$sender_number.'  ERROR#'.$status;
                        $status             =  $decode_res['status'];
                    endif;
                    if($status ==  'OK'):
                        $update_data = array(
                            'delevery_status'   => 1,
                            'message_status'    => $status);
                        
                        $where_up = array(
                            'sender_number'   => $this->CRUDModel->clean_number($row['number']),
                            'send_date'       => date('Y-m-d'),
                            'formCode'        => $formCode,  
                          );   
                    else:
                        $update_data = array(
                            'delevery_status'   => 2,
                            'message_status'    => $status
                            );
                    
                    $where_up = array(
                        'sender_number'   => $this->CRUDModel->clean_number(substr($row['number'],0,'-1')),
                        'send_date'       => date('Y-m-d'),
                        'formCode'        => $formCode,  
                      );
                    endif;
                    $this->CRUDModel->update('sms_students',$update_data,$where_up);
                endforeach;
                else:
                    $update_data = array(
                      'comments'    => $return  
                    );
                    $where_up = array(
                            'send_date'       => date('Y-m-d'),
                            'formCode'        => $formCode,  
                          ); 
                    $this->CRUDModel->update('sms_students',$update_data,$where_up);
                 $return_message[] = 'ERROR';
              endif;
 
                else: // Singal Message
                   
                    $chec_last = substr($sender_number_check,'-1');
           
                    if($chec_last == ','):
                     $sender_number =    substr($sender_number_check,0,'-1');
                        else:
                      $sender_number =   $sender_number;
                    endif;
                    
                    $number_sendxtz = explode(',',$sender_number);
                    $return         = $this->send_message($number_sendxtz[0],$message); 
                    $result         = json_decode($return,true);
                    
                    if($result):
                        
                        if(@$result['status'] ==  'ACCEPTED'):
                             $update_data = array(
                                'delevery_status'   => 1,
                                'message_status'    => $result['status'],
                                'comments'          => $return,
                            );
                        $where_up = array(
                            'sender_number'     =>  $this->CRUDModel->clean_number($sender_number),
                              'send_date'       =>  date('Y-m-d'),
                              'formCode'        =>  $formCode,

                          );     
                         $this->CRUDModel->update('sms_students',$update_data,$where_up); 
                        
                        else:
                            $update_data = array(
                                    'delevery_status'   => 2,
                                    'message_status'    => $result['numbers'][0]['status'],
                                    'comments'          => $return,
                            );
                        $where_up = array(
                                'sender_number'   =>  $this->CRUDModel->clean_number($student_info->applicant_mob_no1),
                                'send_date'       =>  date('Y-m-d'),
                                'formCode'        =>  $formCode,

                          );     
                         $this->CRUDModel->update('sms_students',$update_data,$where_up); 
                         
                        endif;
                        
                      
                    endif;
              endif;
            endforeach;
     
           if(empty($return_message)):
                     
              $this->session->set_flashdata('success_return', 'Messages send successfully.....'); 
           else:
               $this->session->set_flashdata('error_return', $return_message);
           endif;
           redirect('OnlineGeneralMsg');
         endif;
        
        $this->data['page']         = 'Online/sms/student_message';
        $this->data['page_header']  = 'Student Message ';
        $this->data['page_title']   = 'Student Message | ECMS';
        $this->load->view('common/common',$this->data);
    } 
        public function online_student_general_message_language(){

        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('program_type_id'=>2));
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', ' Select Status ', 's_status_id', 'name');
        $this->data['shift']            = $this->CRUDModel->dropDown('shift', ' Select Shift', 'shift_id', 'name');
        $this->data['DMCUpload']        = $this->CRUDModel->dropDown('yesno', ' Select Challan', 'yn_id', 'yn_value');
        $this->data['ChallanUpload']    = $this->CRUDModel->dropDown('yesno', ' Select Option', 'yn_id', 'yn_value');
        $this->data['reserved_seat1']   = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
        $this->data['reserved_seat2']   = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seat ', 'rseat_id', 'name');
                        
        $this->data['hostelIdReq']          = '';
        $this->data['message']      = '';
        $this->data['gender_id']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['batch_id']     = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        $this->data['smsPassword']  = '';
        $this->data['pictureId']    = '';
        $this->data['shift_id']     = '';
        $this->data['reserved_seat_id1']        = '';
        $this->data['reserved_seat_id2']        = '';
        $this->data['dmc_up_id']                = '';
        $this->data['challan_up_id']            = '';
        $this->data['verify_marks_id']          = '';
        $this->data['hostelIdReq']              = '';
        
        $this->data['entry_date_from']= '';
        $this->data['entry_date_to'] = date('d-m-Y');
        $this->data['college_no']          = '';
         
        if($this->input->post('search')):
            
            $collegeNoFrom  = $this->input->post("collegeNoFrom");
            $collegeNoTo    = $this->input->post("collegeNoTo");
            $batch          = $this->input->post("batch");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $gender         = $this->input->post("gender");
            $message        = $this->input->post("message");
            $student_status = $this->input->post("student_status");
            $smsPassword    = $this->input->post("smsPassword");
            $picture        = $this->input->post("picture");
            $shift          = $this->input->post("shift");
            $hostel_status  = $this->input->post("hostel_status");
            $hostel_req     = $this->input->post("hostel_req");
            
            $std_no_from    = $this->input->post("std_no_from");
            $std_no_to      = $this->input->post("std_no_to");
            
            $std_no_from_9th    = $this->input->post("std_no_from_9th");
            $std_no_to_9th      = $this->input->post("std_no_to_9th");
            
            
            $entry_date_from    = $this->input->post("entry_date_from");
            $entry_date_to      = $this->input->post("entry_date_to");
            
            $upload_challan     = $this->input->post("upload_challan");
            $upload_dmc         = $this->input->post("upload_dmc");
            
            $verify_marks       = $this->input->post("verify_marks");
            $reserved_seat1     = $this->input->post("reserved_seat1");
            $reserved_seat2     = $this->input->post("reserved_seat2");
            
            
            $where      = '';
            $like       = '';
            $date       = '';
            $document   = '';
            
            switch ($hostel_req):
                case '':
                     $where['hostel_required'] = '';
                     $this->data['hostelIdReq']          = $hostel_req;
                    break;
                case '1':
                    $where['hostel_required'] = 'Yes'; 
                    $this->data['hostelIdReq']          = $hostel_req;
                    break;
                case '2':
                    $where['hostel_required'] = 'No'; 
                    $this->data['hostelIdReq']          = $hostel_req;
                    break;
            endswitch;
            $this->data['challan_up_id']     = $upload_challan;
            $document['challan_upload']      = $upload_challan;
            if($verify_marks):
                $this->data['verify_marks_id']     = $verify_marks;
                $where['app_verify_flag']        = $verify_marks;
                
            endif;
            if(empty($entry_date_from)):
                $date['entry_date_to']          = $entry_date_to;
                $this->data['entry_date_to']    = $entry_date_to;
                
                else:
                $date['entry_date_from']    = $entry_date_from;
                $date['entry_date_to']      = $entry_date_to;
                
                $this->data['entry_date_from']  = $entry_date_from;
                $this->data['entry_date_to']    = $entry_date_to;
                    
            endif;
            if($hostel_status):
                $where['hostel_student_record.hostel_status_id'] = $hostel_status;
                $this->data['hostel_id'] = $hostel_status;
            endif;
            if($reserved_seat1):
                $where['student_record.rseats_id1']         = $reserved_seat1;
                $this->data['reserved_seat_id1']            = $reserved_seat1;
            endif;
            if($reserved_seat2):
                $where['student_record.rseats_id3']     = $reserved_seat2;
                $this->data['reserved_seat_id2']        = $reserved_seat2;
            endif;
            if($gender):
                $where['student_record.gender_id']  = $gender;
                $this->data['gender_id']            = $gender;
            endif;
            if($shift):
                $where['student_record.shift_id']   = $shift;
                $this->data['shift_id']             = $shift;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batch_id']           = $batch;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            if(!empty($student_status)):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['status_id']     = $student_status;
            endif;
            if(!empty($message)):
            
                $this->data['message']      = $message;
            endif;
            if(!empty($smsPassword)):
                $this->data['smsPassword']  = $smsPassword;
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
                
            
            $this->data['result'] = $this->DashboardModel->student_fee_sms_language($where,$like,'',$date,$document);
            
        endif;
         if($this->input->post('sendSMS')):
              
        $chunk_arrray = array_chunk($this->input->post("checked"), 100);
          
            foreach($chunk_arrray as $chunkRow):
                
                $message        = $this->input->post("message");
                $formCode       = $this->input->post("formCode");
                $sn = '';
                $sender_number  = '';
                $sender_number_check  = '';
                foreach($chunkRow as $key=>$student_id):
               
                    $student_info   = $this->CRUDModel->student_all_details(array('student_record.student_id'=>$student_id));
               
                     $section = '';
                    if($student_info):
                        $sn++; 
                       if($student_info->section_id):
                            $section = $student_info->section_id;
                            else:
                            $section = 0;
                        endif;
                        
                        if(!empty($student_info->applicant_mob_no1)):
                            
                            
                            $std_network = $this->db->get_where('mobile_network',array('net_id'=>$student_info->std_mobile_network))->row();
                          if(empty($student_info->std_mobile_network) && $student_info->std_mobile_network === '0'):
                                    $sender_number_check .= $this->CRUDModel->clean_number($student_info->applicant_mob_no1).',';
                                else:
                                    $sender_number_check .= $this->CRUDModel->clean_number($student_info->applicant_mob_no1).$std_network->send_format.',';
                            endif;

                     $data = array(
                        'student_id'        => $student_info->student_id,
                        'program_id'        => $student_info->programe_id,
                        'formCode'          => $formCode,
                        'sub_pro_id'        => $student_info->sub_pro_id,
                        'sec_id'            => $section,
                        'batch_id'          => $student_info->batch_id,
                        'sms_type'          => 1,
                        'message'           => $message,
                        'network'           => $std_network->send_format,
                        'sender_number'     => $this->CRUDModel->clean_number($student_info->applicant_mob_no1),
                        'create_datetime'   => date('Y-m-d H:i:s'),
                        'send_date'         => date('Y-m-d'),  
                        'create_by'         => $this->userInfo->user_id, 
                      );
                        
              $this->CRUDModel->insert('sms_students',$data);
                endif;     
             endif;
            endforeach;
           
           $chec_last = substr($sender_number_check,'-1');
           
           if($chec_last == ','):
            $sender_number =    substr($sender_number_check,0,'-1');
               else:
             $sender_number =   $sender_number;
           endif;
             
            $return_message = '';
          
            if($sn >1): //Multiple msg
                 
                $return         =   $this->send_message_bulk($sender_number,$message);
                $decode_res     =   json_decode($return,true);
              if(!empty($decode_res['numbers'])):
                   foreach($decode_res['numbers'] as $row):
                    $status     = '';
                    if($row['status']):
                        $status = $row['status'];
                    else:
                        $return_message[]   =  'Mobile#'.$sender_number.'  ERROR#'.$status;
                        $status             =  $decode_res['status'];
                    endif;
                    if($status ==  'OK'):
                        $update_data = array(
                            'delevery_status'   => 1,
                            'message_status'    => $status);
                        
                        $where_up = array(
                            'sender_number'   => $this->CRUDModel->clean_number($row['number']),
                            'send_date'       => date('Y-m-d'),
                            'formCode'        => $formCode,  
                          );   
                    else:
                        $update_data = array(
                            'delevery_status'   => 2,
                            'message_status'    => $status);
                    
                    $where_up = array(
                        'sender_number'   => $this->CRUDModel->clean_number(substr($row['number'],0,'-1')),
                        'send_date'       => date('Y-m-d'),
                        'formCode'        => $formCode,  
                      );
                    endif;
                    $this->CRUDModel->update('sms_students',$update_data,$where_up);
                endforeach;
              endif;
 
                else: // Singal Message
                   
                    $chec_last = substr($sender_number_check,'-1');
           
                    if($chec_last == ','):
                     $sender_number =    substr($sender_number_check,0,'-1');
                        else:
                      $sender_number =   $sender_number;
                    endif;
                    
                    $number_sendxtz = explode(',',$sender_number);
                    $return         = $this->send_message($number_sendxtz[0],$message); 
                    $result         = json_decode($return,true);
                    
                    if($result):
                        
                        if(@$result['status'] ==  'ACCEPTED'):
                             $update_data = array(
                                'delevery_status'   => 1,
                                'message_status'    => $result['status'],
                                'comments'          => $return,
                            );
                        $where_up = array(
                            'sender_number'     =>  $this->CRUDModel->clean_number($sender_number),
                              'send_date'       =>  date('Y-m-d'),
                              'formCode'        =>  $formCode,

                          );     
                         $this->CRUDModel->update('sms_students',$update_data,$where_up); 
                        
                        else:
                            $update_data = array(
                                    'delevery_status'   => 2,
                                    'message_status'    => $result['numbers'][0]['status'],
                                    'comments'          => $return,
                            );
                        $where_up = array(
                                'sender_number'   =>  $this->CRUDModel->clean_number($result['numbers'][0]['number']),
                                'send_date'       =>  date('Y-m-d'),
                                'formCode'        =>  $formCode,

                          );     
                         $this->CRUDModel->update('sms_students',$update_data,$where_up); 
                
                            
                        endif;
                        
                      
                    endif;
              endif;
           endforeach;
     
           if(empty($return_message)):
                     
              $this->session->set_flashdata('success_return', 'Messages send successfully.....'); 
           else:
               $this->session->set_flashdata('error_return', $return_message);
           endif;
           redirect('StudentMessageLanguage');
         endif;
        
        $this->data['page']         = 'Online/sms/student_message_language';
        $this->data['page_header']  = 'Student Message Languages';
        $this->data['page_title']   = 'Student Message Languages | ECMS';
        $this->load->view('common/common',$this->data);
    } 
public function generate_pdf_only(){
       
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('program_type_id'=>1,'status'=>'Yes'));
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pay_categ']    = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title',array('prospectus_batch.status'=>'on'));
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));
        $this->data['default_year_fy'] = $this->db->order_by('id','desc')->get('fee_financial_year')->row()->id;
        $this->data['year']         = $this->CRUDModel->dropDown('fee_financial_year','', 'id', 'year');
        $this->data['batch']        = $this->CRUDModel->DropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('prospectus_batch.status'=>'on'));
        $this->data['gender']               = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', ' Application Status ', 's_status_id', 'name');
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['pc_id']        = '';
        $this->data['sub_pro_id']   = '';
        $this->data['issuDate']     = '';
        $this->data['batch_id']     = '';
        $this->data['Section']      = '';
        $this->data['gender_id']    = '';
        
        $this->data['entry_date_from']= '';
        $this->data['entry_date_to']  = date('d-m-Y');
        
        $this->data['student_status_id']    = '';
                                       $this->db->order_by('obtained_marks','desc');
                                        $this->db->limit('1','0');
         $max_numbers               =   $this->db->get_where('applicant_edu_detail')->row();
         $this->data['std_no_from'] =   '';
         if(empty($max_numbers)):
             $this->data['std_no_to']   =   0;
             else:
             $this->data['std_no_to']   =   $max_numbers->obtained_marks;
         endif;
         
        
        
        
        if($this->input->post('search_students')):
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $batch_id        = $this->input->post("batch_id");
            $pc_id          = $this->input->post("pc_id");
            $fromDate       = $this->input->post("fromDate");
            $toDate         = $this->input->post("uptoDate");
            $bank_id        = $this->input->post("bank_id");
            $comment        = $this->input->post("comment");
            $std_no_from    = $this->input->post("std_no_from");
            $std_no_to      = $this->input->post("std_no_to");
            $gender         = $this->input->post("gender");
            $student_status = $this->input->post("student_status");
            
            
            $entry_date_from    = $this->input->post("entry_date_from");
            $entry_date_to      = $this->input->post("entry_date_to");
        
            $where  = array();
            $date   = array();
            if($batch_id):
                $where['prospectus_batch.batch_id'] = $batch_id;
                $this->data['batch_id']             = $batch_id;
            endif;
            if($student_status):
                $where['student_record.s_status_id'] = $student_status;
                $this->data['student_status_id']     = $student_status;
            endif;
            if($programe_id):
                $where['programes_info.programe_id']= $programe_id;
                $this->data['programe_id']          = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
                
            if(!empty($gender)):
                $this->data['gender_id']            = $gender;
                $where['gender.gender_id']          = $gender;
            endif;
            $std_no['std_no_from']          = $std_no_from;
            $std_no['std_no_to']            = $std_no_to;
             $this->data['std_no_from']     = $std_no_from;
            $this->data['std_no_to']        = $std_no_to;
            
             if(empty($entry_date_from)):
                $date['entry_date_to']          = $entry_date_to;
                $this->data['entry_date_to']    = $entry_date_to;
                
                else:
                $date['entry_date_from']    = $entry_date_from;
                $date['entry_date_to']      = $entry_date_to;
                
                $this->data['entry_date_from']  = $entry_date_from;
                $this->data['entry_date_to']    = $entry_date_to;
                    
            endif;
            
            $this->data['result']= $this->FeeModel->fee_challan_generate_pdf_only($where,$std_no,$date);
            
        endif;
         
        if($this->input->post('generate_pdf')):
            
            $pc_id          = $this->input->post("pc_id");
       
//******************************************************************************************************            
//********************            FEE CHALLAN  GENERATION                             ******************
//******************************************************************************************************
          
             //student name challan
             foreach($this->input->post('studentIds') as $row=>$student):
         
                
//******************************************************************************************************            
//********************            FEE CHALLAN CHECKING IF EXIST                       ******************
//******************************************************************************************************
                            $this->db->join('fee_challan','fee_challan.fc_student_id=student_record.student_id'); 
            $studentRow =   $this->db->get_where('student_record',array('student_id'=>$student))->row();
            if(!empty($studentRow)): 
                
                        

//             $challan_id = $this->uri->segment(2);       
                       //Generate PDF
                       $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$studentRow->student_id));
                       $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$studentRow->fc_challan_id));
                       $where                      = array(
                                           'fc_student_id '=> $this->data['feeComments']->fc_student_id,
                                           'fc_paid_form <='=> $this->data['feeComments']->fc_paid_form
                                    );
                       $this->data['FeeHeads']     = $this->FeeModel->feeDetails_head_print($where);

//                        $this->data['std_data'] = $this->FeeModel->fee_admission_challan_details(array('student_record.student_id'=>$studentRow->student_id));
                       $html = $this->load->view('Online/Fee/fee_admisssion_challan_pdf',$this->data,true);
//                        $html = $this->load->view('Fee/Forms/fee_admisssion_challan_pdf',$this->data,true);
                       
                       $filename = 'challan_gen/'.str_replace("-", "", $studentRow->form_no).'.pdf';
                       
                       if (!file_exists($filename)):
                            $dompdf = new PDF();
                            $dompdf->load_html($html);
                            $dompdf->set_paper('A4', 'landscape');
                            $dompdf->render();
                            $dompdf->get_canvas()->get_cpdf()->setEncryption('', 'n.*7&4%i:[}', array('print'));
                            $output = $dompdf->output();
     //                        $data = file_put_contents('student_challan/'.str_replace("-", "", $studentRow->form_no).'.pdf', $output);
                            $data = file_put_contents('challan_gen/'.str_replace("-", "", $studentRow->form_no).'.pdf', $output);
                            unset($dompdf);
                            unset($data);
                       endif;
                       
                      
            endif;
                
                        
            endforeach;
                
//            redirect('GeneratePDFOnly');
            
        endif;
        
        $this->data['page']         = 'Online/Fee/fee_challan_generate_pdf_only';
        $this->data['page_header']  = 'Fee Challan Generate (Only PDF)';
        $this->data['page_title']   = 'Fee Challan Generate (Only PDF) | ECMS';
        $this->load->view('common/common',$this->data);
        
    }    
public function update_students_shift(){
    
                
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('program_type_id'=>1,'status'=>'Yes'));
        $this->data['batch']        = $this->CRUDModel->DropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('prospectus_batch.status'=>'on'));
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['shift']        = $this->CRUDModel->dropDown('shift', 'Select Shift', 'shift_id', 'name');
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['pc_id']        = '';
        $this->data['sub_pro_id']   = '';
        $this->data['issuDate']     = '';
        $this->data['batch_id']     = '';
        $this->data['Section']      = '';
        $this->data['gender_id']    = '';
                                       $this->db->order_by('obtained_marks','desc');
                                        $this->db->limit('1','0');
         $max_numbers               =   $this->db->get_where('applicant_edu_detail')->row();
         $this->data['std_no_from'] =   '';
         if(empty($max_numbers)):
             $this->data['std_no_to']   =   0;
             else:
             $this->data['std_no_to']   =   $max_numbers->obtained_marks;
         endif;
         
        
        
        
        if($this->input->post('GenerateChallanNewAdmission')):
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $batch_id        = $this->input->post("batch_id");
            $pc_id          = $this->input->post("pc_id");
            $fromDate       = $this->input->post("fromDate");
            $toDate         = $this->input->post("uptoDate");
            $bank_id        = $this->input->post("bank_id");
            $comment        = $this->input->post("comment");
            $std_no_from    = $this->input->post("std_no_from");
            $std_no_to      = $this->input->post("std_no_to");
            $gender         = $this->input->post("gender");
        
            $where = '';
            if($batch_id):
                $where['prospectus_batch.batch_id'] = $batch_id;
                $this->data['batch_id']             = $batch_id;
            endif;
            if($programe_id):
                $where['programes_info.programe_id']= $programe_id;
                $this->data['programe_id']          = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
                
            if(!empty($gender)):
                $this->data['gender_id']            = $gender;
                $where['gender.gender_id']          = $gender;
            endif;
            $std_no['std_no_from']          = $std_no_from;
            $std_no['std_no_to']            = $std_no_to;
             $this->data['std_no_from']     = $std_no_from;
            $this->data['std_no_to']        = $std_no_to;
            $this->data['result']= $this->FeeModel->student_update_sift($where,$std_no);
            
        endif;
         
        if($this->input->post('update_shift')):
                
            foreach($this->input->post('studentIds') as $row=>$student):
                if($this->input->post('student_shift')):
                    $this->CRUDModel->update('student_record',array('shift_id'=>$this->input->post('student_shift')),array('student_id'=>$student));
                endif;
                 
            endforeach;
                redirect('UpdateShift');
            
        endif;
        
        $this->data['page']         = 'Online/Fee/student_shift_change';
        $this->data['page_header']  = 'Change student shift';
        $this->data['page_title']   = 'Change student shift | ECMS';
        $this->load->view('common/common',$this->data);
        
    }    
}
