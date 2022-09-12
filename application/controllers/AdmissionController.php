<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class AdmissionController extends AdminController {
	function __construct(){
		parent::__construct();
                $this->load->model('AdmissionModel');
                $this->load->model('dropdownModel');
                $this->load->model('get_model');
                $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
	}
        public function inter_new_admissions(){
             $this->data['collegeNo']       = '';
            $this->data['stdName']          = '';
            $this->data['fatherName']       = '';
            $this->data['gender_id']        = '';
            $this->data['admis_status_id']  = '';
            $this->data['sub_pro_id']       = '';
            $this->data['form_no']          = ''; 
            $this->data['reserved_seat_id'] = ''; 
            $inter_last_batch = $this->AdmissionModel->get_last_batch();
            $where_batch = '';
            if($inter_last_batch == 51):
                $where_batch = 34;
                else:
                $where_batch =$inter_last_batch;
            endif;
            if($this->input->post()):
                
                $college_no         =  $this->input->post('college_no');
                $student_name       =  $this->input->post('student_name');
                $form_no            =  $this->input->post('form_no');
                $father_name        =  $this->input->post('father_name');
                $reserved_seat      =  $this->input->post('reserved_seat');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $admis_status       =  $this->input->post('admis_status');
                $like = '';
                $where['student_record.batch_id'] = $where_batch;
                
                 
                 if(!empty($college_no)):
                    $where['college_no'] = $college_no;
                    $this->data['collegeNo'] =$college_no;
                endif;
                if(!empty($form_no)):
                    $like['form_no'] = $form_no;
                    $this->data['form_no'] =$form_no;
                endif;
                if(!empty($student_name)):
                    $like['student_name'] = $student_name;
                    $this->data['stdName'] =$student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name'] = $father_name;
                $this->data['fatherName'] =$father_name;
                endif;
                if(!empty($reserved_seat)):
                    $where['reserved_seat.rseat_id']    = $reserved_seat;
                    $this->data['rseats_id']            = $reserved_seat;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id'] = $gender;
                    $this->data['gender_id'] =$gender;
                endif;
                if(!empty($admis_status)):
                    $where['student_status.s_status_id'] = $admis_status;
                    $this->data['s_status_id']           = $admis_status;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                    $this->data['sub_pro_id']  = $sub_pro_id;
                endif;
                 
                $this->data['result']   = $this->AdmissionModel->inter_new_students_record_search($where,$like); 
                $this->data['count']   = count($this->data['result']);
        else:

            $where = array('student_record.batch_id'=>$where_batch,'student_record.programe_id'=>'1');
            //pagination start
            $config['base_url']         = base_url('InterNewAdmissoins');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  //echo $config['total_rows']; exit;
            $config['per_page']         = 10;
            $config["num_links"]        = 5;
            $config['uri_segment']      = 2;
            
            //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the “Digit�? Link
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
             
            $this->data['result']       = $this->AdmissionModel->inter_new_students_record($config['per_page'],$page,$where); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
            $this->data['admis_status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name'); 
//            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            
            $this->data['page_header']  = 'New Record (Inter Level)';
            $this->data['page_title']   = 'New Record (Inter Level) | ECMS';
            $this->data['page']         = 'admission/Inter_Admission/Forms/new_admission_inter_v';
            $this->load->view('common/common',$this->data);
        }
        public function inter_absent_fine(){
             $this->data['collegeNo']       = '';
            $this->data['stdName']          = '';
            $this->data['fatherName']       = '';
            $this->data['gender_id']        = '';
            $this->data['admis_status_id']  = '';
            $this->data['sub_pro_id']       = '';
            $this->data['form_no']          = ''; 
            $this->data['reserved_seat_id'] = ''; 
            $inter_last_batch = $this->AdmissionModel->get_last_batch();
            $where_batch = '';
            if($inter_last_batch == 51):
                $where_batch        = 34;
                else:
                $where_batch =$inter_last_batch;
            endif;
            if($this->input->post()):
                
                $college_no         =  $this->input->post('college_no');
                $student_name       =  $this->input->post('student_name');
                $form_no            =  $this->input->post('form_no');
                $father_name        =  $this->input->post('father_name');
                $reserved_seat      =  $this->input->post('reserved_seat');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $admis_status       =  $this->input->post('admis_status');
                $like = '';
                
                $where['student_record.s_status_id'] = 5;
                $where['student_record.programe_id'] = 1;
//                $where['student_record.s_status_id'] = $where_batch;
                
                 
                 if(!empty($college_no)):
                    $where['college_no'] = $college_no;
                    $this->data['collegeNo'] =$college_no;
                endif;
                if(!empty($form_no)):
                    $like['form_no'] = $form_no;
                    $this->data['form_no'] =$form_no;
                endif;
                if(!empty($student_name)):
                    $like['student_name'] = $student_name;
                    $this->data['stdName'] =$student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name'] = $father_name;
                $this->data['fatherName'] =$father_name;
                endif;
                if(!empty($reserved_seat)):
                    $where['reserved_seat.rseat_id']    = $reserved_seat;
                    $this->data['rseats_id']            = $reserved_seat;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id'] = $gender;
                    $this->data['gender_id'] =$gender;
                endif;
                if(!empty($admis_status)):
                    $where['student_status.s_status_id'] = $admis_status;
                    $this->data['s_status_id']           = $admis_status;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                    $this->data['sub_pro_id']  = $sub_pro_id;
                endif;
                 
                $this->data['result']   = $this->AdmissionModel->inter_new_students_record_search($where,$like); 
                $this->data['count']   = count($this->data['result']);
        else:

            $where = array('student_record.s_status_id'=>5,'student_record.programe_id'=>'1');
            //pagination start
            $config['base_url']         = base_url('InterAbsentFine');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  //echo $config['total_rows']; exit;
            $config['per_page']         = 10;
            $config["num_links"]        = 5;
            $config['uri_segment']      = 2;
            
            //Encapsulate whole pagination 
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            
            
            //First link of pagination
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            
            //Customizing the “Digit�? Link
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
             
            $this->data['result']       = $this->AdmissionModel->inter_new_students_record($config['per_page'],$page,$where); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
            $this->data['admis_status']    = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name'); 
//            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            
            $this->data['page_header']  = 'Absent Fine (Inter Level)';
            $this->data['page_title']   = 'Absent Fine (Inter Level) | ECMS';
            $this->data['page']         = 'admission/Inter_Absent_Fine/Forms/absent_fine_v';
            $this->load->view('common/common',$this->data);
        }
        public function show_fine_student_record(){
            
           
            $student_id = $this->input->post('student_id');
            $student_info = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
             echo '<form action="" class="form-horizontal" method="post" id="addFineForm">
                    <div class="modal-body">
                         <div class="row">
                          <div class="col-md-12">
                               <div class="row">
                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">College No</label>
                                      <input type="text" value="'.$student_info->college_no.'" id="title" class="form-control" readonly>
                                  </div>
                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">Student Name</label>
                                      <input type="text" name="student_name"  value="'.$student_info->student_name.'" id="title" class="form-control" readonly>
                                  </div>
                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">Father Name</label>
                                      <input type="text" name="student_name"    value="'.$student_info->father_name.'" id="title" class="form-control" readonly>
                                      <input type="hidden" name="student_id"    value="'.$student_info->student_id.'" id="title" class="form-control">
                                      </div>
                                  </div>

                          <div class="row">

                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">Date</label>
                                      <input type="text" name="leave_date" value="'.date('d-m-Y').'" id="news_date" class="form-control datepicker">
                                  </div>
                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">Total Classess</label>
                                      <input type="number" name="total_classess" id="news_date" class="form-control">
                                  </div>


                                  <div class="col-md-9 col-sm-5">
                                      <label for="name">Description</label>
                                      <textarea name="description" cols="60" rows="2" id="description" class="form-control"></textarea>

                                  </div>

                              </div>
                               <div class="col-md-6 offset-md-4" id="error_message">
                                        <strong class="text-danger"><div id="show_error_msg">sdsds</div></strong>
                               </div>
                          </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                          <button type="button" id="AddFine" name="AddFine" value="AddFine" class="btn btn-theme"> <i class="fa fa-plus"></i> Save</button>
                          <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>

                    </div>
                    
                      </form>';
             ?>
                 <script>
                    $( function() {
                      $( ".datepicker" ).datepicker({
                           changeMonth: true,
                      changeYear: true,
                      dateFormat: 'dd-mm-yy'
                      });
                    } );
                    
                    
                    jQuery(document).ready(function(){
                         jQuery('#error_message').hide();
                        
                        jQuery('#AddFine').on('click',function(){
                           
                            jQuery.ajax({
                                type    : 'post',
                                url     : 'AddStudentFine',
                                data    : jQuery('#addFineForm').serialize(),
                                success : function(result){
                                    if(result == true){
                                        alert('Record Update Successfully...');
                                        jQuery('#finePopup').modal('toggle');
                                    }else{
                                        jQuery('#show_error_msg').html(result);
                                        jQuery('#error_message').show();  
                                    }
//                                    
                                }
                        });
                        });
                        
                    });
                    </script>  
                 <?php
        }
        public function add_student_fine(){
            
                    $this->form_validation->set_rules('leave_date', 'Date', 'required');
                    $this->form_validation->set_rules('total_classess', 'Total Class', 'required');
                    
                      if ($this->form_validation->run()):
                          
                         
            
            
             $data = array(
                     'student_id'       =>  $this->input->post('student_id'),
                     'leave_date'       =>  date('Y-m-d',strtotime($this->input->post('leave_date'))),
                     'total_classess'   =>  $this->input->post('total_classess'),
                     'description'      =>  $this->input->post('description'),
                     'create_by'        =>  $this->userInfo->user_id,
                     'create_datetime'  =>  date('Y-m-d H:i:s'),
                 );
                 
                 $this->CRUDModel->insert('student_fine',$data);
                  echo  true;
                  else:
                    $this->form_validation->set_error_delimiters('<div class="danger">', '</div>'); 
                      echo   validation_errors();
                      endif;
             }
        public function show_all_fines(){
            
                $student_id = $this->input->post('student_id');
                        $this->db->select('
                                 student_record.student_id,   
                                 student_record.college_no,   
                                 student_record.student_name,   
                                 student_record.father_name,   
                                 student_fine.leave_date,   
                                 student_fine.id,   
                                 student_fine.total_classess,   
                                 student_fine.description,   
                                ');
                        $this->db->join('student_record','student_record.student_id=student_fine.student_id');
                        $this->db->order_by('student_fine.id','desc');
              $result = $this->db->get_where('student_fine',array('student_fine.student_id'=>$student_id))->result();
             if($result):
                 echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>College #</th>
                            <th>Student</th>
                            <th>Leave Date</th>
                            <th>Total Leaves</th>
                            <th>Description</th>
                            <th>Update</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>';
                    
                 foreach($result as $row):
                        
                        echo '<tr class="gradeA">';
                        echo '<td>'.$row->college_no.'</td>';
                        echo '<td>'.$row->student_name.'</td>';
                        echo '<td>'.date('d-m-Y',strtotime($row->leave_date)).'</td>';
                        echo '<td>'.$row->total_classess.'</td>';
                        echo '<td>'.$row->description.'</td>';
                        echo '<td><a class="btn btn-theme btn-sm student_update_fine" id="'.$row->id.' data-dismiss="modal" data-toggle="modal" data-target="#fineUpdatePopup"><i class="fa fa-book"></i>  <b>Update Fine</b></a></td>';
//                        echo '<td><a class="btn btn-theme btn-sm student_update_fine" id="'.$row->id.','.$row->student_id.'" data-dismiss="modal" data-toggle="modal" data-target="#fineUpdatePopup"><i class="fa fa-book"></i>  <b>Update</b></a></td>';
                       

                        
                        echo '</tr>';
                 
                 endforeach;       
                    echo '</tbody>
                </table>';
             else:
                echo '<p><h3>No Record Found</h3></p>';
             endif;
               ?>
            <script>
            
            jQuery(document).ready(function(){
             
            jQuery('.student_update_fine').on('click',function(){
                    var update_ids = this.id;
                    
                     
                        jQuery.ajax({
                        type    : 'post',
                        url     : 'UpdateFine',
                        data    : {'update_ids':update_ids},
                        success : function(result){
    //                         jQuery(this).closest("tr").hide();
                                jQuery('#fineShowPopup').modal('toggle');
                            jQuery('#show_update_record').html(result);
                        }
 
                     

                });
            
            });
            });
            
            </script>    
                 
                 
                 
        <?php
             }
             
    public function update_fine(){
                 
                 $update_ids = $this->input->post('update_ids');
                  
                 
                 
            $this->db->select('
                                 student_record.student_id,   
                                 student_record.college_no,   
                                 student_record.student_name,   
                                 student_record.father_name,   
                                 student_fine.leave_date,   
                                 student_fine.id,   
                                 student_fine.total_classess,   
                                 student_fine.description,   
                                ');
                        $this->db->join('student_record','student_record.student_id=student_fine.student_id');
                        $this->db->order_by('student_fine.id','desc');
              $result = $this->db->get_where('student_fine',array('student_fine.id'=>$update_ids))->row();
            
              if($result):
                  
           
             echo '<form action="" class="form-horizontal" method="post" id="updateFineForm">
                    <div class="modal-body">
                         <div class="row">
                          <div class="col-md-12">
                               <div class="row">
                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">College No</label>
                                      <input type="text" value="'.$result->college_no.'" id="title" class="form-control" readonly>
                                  </div>
                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">Student Name</label>
                                      <input type="text" name="student_name"  value="'.$result->student_name.'" id="title" class="form-control" readonly>
                                  </div>
                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">Father Name</label>
                                      <input type="text" name="student_name"    value="'.$result->father_name.'" id="title" class="form-control" readonly>
                                      <input type="hidden" name="student_id"    value="'.$result->student_id.'" id="title" class="form-control">
                                      <input type="hidden" name="fine_id"    value="'.$result->id.'" id="title" class="form-control">
                                      </div>
                                  </div>

                          <div class="row">

                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">Date</label>
                                      <input type="text" name="leave_date" value="'.date('d-m-Y',strtotime($result->leave_date)).'" id="news_date" class="form-control datepicker">
                                  </div>
                                  <div class="col-md-4 col-sm-5">
                                      <label for="name">Total Classess</label>
                                      <input type="number" name="total_classess" value="'.$result->total_classess.'" id="news_date" class="form-control">
                                  </div>


                                  <div class="col-md-9 col-sm-5">
                                      <label for="name">Description</label>
                                      <textarea name="description" cols="60" rows="2" id="description" class="form-control">'.$result->description.'</textarea>

                                  </div>

                              </div>
                               <div class="col-md-6 offset-md-4" id="error_message">
                                        <strong class="text-danger"><div id="show_error_msg"></div></strong>
                               </div>
                          </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                          <button type="button" id="updateFineRecord" class="btn btn-theme"> <i class="fa fa-plus"></i> Update</button>
                          <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>

                    </div>
                    
                      </form>';
                 endif;
                 
                        ?>
            <script>
            
            jQuery(document).ready(function(){
             
            jQuery('#updateFineRecord').on('click',function(){
                    
                     jQuery.ajax({
                                type    : 'post',
                                url     : 'UpdateStudentFine',
                                data    : jQuery('#updateFineForm').serialize(),
                                success : function(result){
                                    
                                    if(result == true){
                                        alert('Record Update Successfully...');
//                                        jQuery('#fineShowPopup').modal('toggle');
                                        jQuery('#fineUpdatePopup').modal('toggle');
                                    }else{
                                        jQuery('#show_error_msg').html(result);
                                        jQuery('#error_message').show();  
                                    }
//                                    
                                }
                        });
            
            });
            });
            
            </script>    
                 
                 
                 
        <?php
                 
    }
            public function update_student_fine(){
            
                
                
                    $this->form_validation->set_rules('leave_date', 'Date', 'required');
                    $this->form_validation->set_rules('total_classess', 'Total Class', 'required');
                    
                if ($this->form_validation->run()):
                          
                         
            
            
             $data = array(
                     
                     'leave_date'       =>  date('Y-m-d',strtotime($this->input->post('leave_date'))),
                     'total_classess'   =>  $this->input->post('total_classess'),
                     'description'      =>  $this->input->post('description'),
                     'update_by'        =>  $this->userInfo->user_id,
                     'update_datetime'  =>  date('Y-m-d H:i:s'),
                 );
                 $where = array(
                   'id'=>$this->input->Post('fine_id')  
                 );
                 $this->CRUDModel->update('student_fine',$data,$where);
                  echo  true;
                  else:
                    $this->form_validation->set_error_delimiters('<div class="danger">', '</div>'); 
                      echo   validation_errors();
                      endif;
             }
    public function controller_method( )
        {
            try
            {
                echo 'sfsd';
                // normal flow
            }
            catch( Exception $e )
            {
                log_message( 'error', $e->getMessage( ) . ' in ' . $e->getFile() . ':' . $e->getLine() );
                // on error
            }
        }
        
    public function admin_picture_log_report(){
        
            $this->data['college_number']   = ''; 
            $this->data['std_name']         = ''; 
            $this->data['std_fname']        = ''; 
            $this->data['Shift']        = ''; 
            $this->data['Gender']        = ''; 
        
        if($this->input->post('search_log')):
        
            $college_number = $this->input->post('college_number');
            $shift          = $this->input->post('shift');
            $quota          = $this->input->post('rseats');

            
            $where = '';
                if($college_number):
                   $where['student_record.college_no'] = $college_number;  
                   $this->data['college_number'] = $college_number; 
                endif;
                if($quota):
                   $where['student_record.rseats_id'] = $quota;  
                   $this->data['Quota'] = $quota;  
                endif;
               
                if($shift):
                   $where['student_record.shift_id'] = $shift;  
                   $this->data['Shift'] = $shift;  
                endif;
               
                    $this->data['student_record'] = $this->AdmissionModel->admin_picture_record_logs($where);
//                    echo '<pre>'; print_r($this->data['student_record']); die;
              
            endif;
         
            
            $this->data['Shift']          = $this->CRUDModel->dropDown('shift', ' Select Shift ', 'shift_id', 'name');
            $this->data['Quota']          = $this->CRUDModel->dropDown('reserved_seat', ' Quota ', 'rseat_id', 'name');
           
            $this->data['HeaderPage']       = 'Admin Picture Upload History';
            $this->data['page_title']       = 'Admin Picture Log | ECMS';
            $this->data['page']             = 'admission/admin_picture_log_report_v';
            $this->load->view('common/common',$this->data);
    }
     
    public function student_picture_log_record()
    {
        $student_id = $this->uri->segment(3);
        
        if($student_id):
            $where  = array('student_id'=>$student_id);       
            $where1  = array('std_id'=>$student_id);       
            
            $this->data['result']               = $this->AdmissionModel->student_picture_curr_record($where);
            $this->data['log']                  = $this->AdmissionModel->student_picture_log_record($where1);
            
//            echo '<pre>'; print_r($this->data['log']); die;
        endif;
        
        $this->data['page_title'] = 'View Student Logs Record | ECMS';
        $this->data['page']       = 'admission/view_student_picture_log_report';
        $this->load->view('common/common',$this->data);
    }
    
    public function new_student_admission_search(){       
        $whereSub_pro                   = array('programe_id'=>1);
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', 'Admission Alloted in', 'rseat_id', 'name');  
        $this->data['status']           = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            
        
            $college_no                 =  $this->input->post('college_no');
            $form_no                    =  $this->input->post('form_no');
            $student_name               =  $this->input->post('student_name');
            $father_name                =  $this->input->post('father_name');
            $gender_id                  =  $this->input->post('gender_id');
            $sub_pro_id                 =  $this->input->post('sub_pro_id');
            $rseats_id                  =  $this->input->post('rseats_id');
            $s_status_id                =  $this->input->post('s_status_id');
            $limit                      =  $this->input->post('limit');
          
            $like = '';
            $where = '';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['s_status_id']  = '';
            $this->data['limitId']  = '';
        if($this->input->post('search')):
            
            $where['student_record.programe_id'] = 1;
            $where['student_record.batch_id'] = 62;
        
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
            $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
              
                if($limitVale):
                    $limitD = $limitVale->limit_value;
                else:
                    $limitD = 50;
                endif;
                $custom['limit']        = $limitD;
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $this->data['limitId']  = $limit;
        
           $this->data['result']   = $this->get_model->get_stdData('student_record',$where,$like,$custom);
           else:
           $where = array('student_record.batch_id'=>'62','student_record.programe_id'=>'1');
            //pagination start
            $config['base_url']         = base_url('NewAdmissonInterSearch');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',$where));  
            $config['per_page']         = 20;
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
            $this->data['result']       = $this->get_model->new_stds_pagination($config['per_page'], $page,$where,$custom);
            $this->data['count']        = $config['total_rows'];
        endif;
           $this->data['page_title']    = 'New Admission Record (Inter) | ECMS';
           $this->data['page_header']   = 'New Admission Record (Inter) ';
           $this->data['page']          = 'admission/New_Admission/new_student_record_search';
           $this->load->view('common/common',$this->data);
    }
    
    public function add_new_student_record2(){	
          
         $this->data['batch_id']   = '';
          $this->data['prospectus_batch']   = $this->CRUDModel->dropDown('prospectus_batch', '', 'batch_id', 'batch_name',array('batch_id'=>62));    
        
        if($this->input->post()):	
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $last_school        = ucwords(strtolower(ucwords($this->input->post('last_school_address'))));
            $current_datetime   = date('Y-m-d H:i:s');
            
            $this->load->helper('string');
            $length     = "4"; 
            $char       = "0123456789"; 
            $password   = substr(str_shuffle($char), 0, $length);
            $checked    = array(
                            'batch_id'=>$this->input->post('batch_id'),
                            'form_no'=>$this->input->post('form_no')
                            );
            
            $qry    = $this->CRUDModel->get_where_row('student_record',$checked);
            if($qry):
                $this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
                redirect('AddNewAdmissonInter');       
            else:
                $data   = array(
                        'batch_id'          => $this->input->post('batch_id'),
                        'reg_batch_id'      => $this->input->post('batch_id'),
                        'programe_id'       => $this->input->post('programe_id'),
                        'sub_pro_id'        => $this->input->post('sub_pro_id'),
                        'form_no'           => $this->input->post('form_no'),
                        'rseats_id'         => $this->input->post('rseats_id'),
                        'rseats_id1'        => $this->input->post('rseats_id1'),
                        'rseats_id3'        => $this->input->post('rseats_id3'),
                        'comment'           => $this->input->post('comment'),
                        'fata_school'       => $this->input->post('fata_school'),
                        'student_name'      => $student,
                        'gender_id'         => $this->input->post('gender_id'),
                        'country_id'        => $this->input->post('country_id'),
                        'domicile_id'       => $this->input->post('domicile_id'),
                        'religion_id'       => $this->input->post('religion_id'),
//                        'hostel_required'   => $this->input->post('hostel_required'),
                        'father_name'       => $father,
                        'land_line_no'      => $this->input->post('land_line_no'),
                        'mobile_no'         => $this->input->post('mobile_no'),
                        'applicant_mob_no1' => $this->input->post('applicant_mobile_no1'),
                        'last_school_address' => $last_school,
                        'remarks'           => $this->input->post('remarks1'),
                        'remarks2'          => $this->input->post('remarks2'),
                        's_status_id'       => 1,
                        'student_password'  => $password,
                        'timestamp'         => $current_datetime,
                        'user_id'           => $this->userInfo->user_id
                        );
                $sp_id = $this->input->post('sub_pro_id');
                $id     = $this->CRUDModel->insert('student_record',$data);
                if(!empty($sp_id)):
                    $ides   = $this->input->post('checked');
                    foreach($ides as $row=>$value):
                        $sub_data = array(
                             'student_id'   => $id,
                             'subject_id'   => $value,
                             'sub_prog_id'  => $sp_id,
                             'created_by'   => $this->userInfo->user_id,
                             'date_time'    => date('Y-m-d H:i:s'),
                         );
                        $this->CRUDModel->insert('new_student_subjects',$sub_data);
                    endforeach;
                endif;
                redirect('NewAdmissionAcademic/'.$id);
            endif;
        endif;
        
            $this->data['page_title']   = 'Add New Admission (Inter Level) | ECMS';
            $this->data['page_header']  = 'Add New Admission (Inter Level)';
            $this->data['page']         = 'admission/New_Admission/add_new_student_record';
            $this->load->view('common/common',$this->data);
            
	}
        public function add_new_student_record(){	
          
         $this->data['batch_id']            = '';
         $this->data['programe_id']         = '';
         $this->data['sub_pro_id']          = '';
         $this->data['reserved_seat_id']    = '';
         $this->data['reserved_seat_id2']   = '';
         $this->data['reserved_seat_id3']   = '';
         $this->data['gender_id']           = '';
         $this->data['country_id']          = '';
         $this->data['religion_id']         = '';
         
          $this->data['prospectus_batch']       = $this->CRUDModel->dropDown('prospectus_batch', '', 'batch_id', 'batch_name',array('batch_id'=>62));    
          $this->data['programe_name']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>1));    
          $this->data['sub_pro_name']           = $this->CRUDModel->dropDown('sub_programes', '', 'sub_pro_id', 'name',array('programe_id'=>1));    
          $this->data['reserved_seat']          = $this->CRUDModel->dropDown('reserved_seat', '', 'rseat_id', 'name');    
          $this->data['reserved_seat2']         = $this->CRUDModel->dropDown('reserved_seat', 'Select Quota 2', 'rseat_id', 'name');    
          $this->data['reserved_seat3']         = $this->CRUDModel->dropDown('reserved_seat', 'Select Quota 3', 'rseat_id', 'name');    
          $this->data['gender']                 = $this->CRUDModel->dropDown('gender', '', 'gender_id', 'title');    
          $this->data['country']                = $this->CRUDModel->dropDown('country', '', 'country_id', 'name');    
          $this->data['religion']               = $this->CRUDModel->dropDown('religion', '', 'religion_id', 'title');    
        
        if($this->input->post()):	
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $last_school        = ucwords(strtolower(ucwords($this->input->post('last_school_address'))));
            $current_datetime   = date('Y-m-d H:i:s');
            
            $this->load->helper('string');
            $length     = "4"; 
            $char       = "0123456789"; 
            $password   = substr(str_shuffle($char), 0, $length);
            $checked    = array(
                            'batch_id'=>$this->input->post('batch_id'),
                            'form_no'=>$this->input->post('form_no')
                            );
           
            
            
            $qry    = $this->CRUDModel->get_where_row('student_record',$checked);
            if($qry):
                 
                $this->session->set_flashdata('msg', 'Sorry! Batch Name and Form are Already Exist');
                redirect('AddNewAdmissonInter');       
            else:
                
                
                $this->form_validation->set_rules('form_no', 'Form no#', 'required');
                    $this->form_validation->set_rules('student_name', 'Please Enter Student Name', 'required');
                    $this->form_validation->set_rules('father_name', 'Please Enter Student Father', 'required');
                    $this->form_validation->set_rules('last_school_address', 'Enter Last School Address', 'required');
                    $this->form_validation->set_rules('mobile_no', 'Enter Father No', 'required');
                    $this->form_validation->set_rules('domicile_id', 'Enter Domicile ', 'required');
                    
                 if ($this->form_validation->run()):
                     
  
                $data   = array(
                        'batch_id'          => $this->input->post('batch_id'),
                        'reg_batch_id'      => $this->input->post('batch_id'),
                        'programe_id'       => $this->input->post('programe_id'),
                        'sub_pro_id'        => $this->input->post('sub_pro_id'),
                        'form_no'           => $this->input->post('form_no'),
                        'rseats_id'         => $this->input->post('rseats_id'),
                        'rseats_id1'        => $this->input->post('rseats_id1'),
                        'rseats_id3'        => $this->input->post('rseats_id3'),
                        'comment'           => $this->input->post('comment'),
                        'fata_school'       => $this->input->post('fata_school'),
                        'student_name'      => $student,
                        'gender_id'         => $this->input->post('gender_id'),
                        'country_id'        => $this->input->post('country_id'),
                        'domicile_id'       => $this->input->post('domicile_id'),
                        'religion_id'       => $this->input->post('religion_id'),
 
                        'father_name'       => $father,
                        'land_line_no'      => $this->input->post('land_line_no'),
                        'mobile_no'         => $this->input->post('mobile_no'),
                        'applicant_mob_no1' => $this->input->post('applicant_mobile_no1'),
                        'last_school_address' => $last_school,
                        'remarks'           => $this->input->post('remarks1'),
                        'remarks2'          => $this->input->post('remarks2'),
                        's_status_id'       => 1,
                        'student_password'  => $password,
                        'timestamp'         => $current_datetime,
                        'user_id'           => $this->userInfo->user_id
                        );
                $sp_id = $this->input->post('sub_pro_id');
                $id     = $this->CRUDModel->insert('student_record',$data);
                if(!empty($sp_id)):
                    $ides   = $this->input->post('checked');
                    foreach($ides as $row=>$value):
                        $sub_data = array(
                             'student_id'   => $id,
                             'subject_id'   => $value,
                             'sub_prog_id'  => $sp_id,
                             'created_by'   => $this->userInfo->user_id,
                             'date_time'    => date('Y-m-d H:i:s'),
                         );
                        $this->CRUDModel->insert('new_student_subjects',$sub_data);
                    endforeach;
                endif;
                redirect('NewAdmissionAcademic/'.$id);
           
                
            else:    
                     
                $this->data['sub_pro_id']          = set_value('sub_pro_id');
                $this->data['reserved_seat_id']    = set_value('reserved_seat_id');
                $this->data['reserved_seat_id2']   = set_value('reserved_seat_id2');
                $this->data['reserved_seat_id3']   = set_value('reserved_seat_id3');
                $this->data['gender_id']           = set_value('gender_id');
                $this->data['country_id']          = set_value('country_id');
                $this->data['religion_id']         = set_value('religion_id');
                
                
                
                    $this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>
                                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                           <strong>", '</strong></div>');
                  endif;
                   
        endif;
        endif;
        
                $this->data['page_title']   = 'Add New Admission (Inter Level) | ECMS';
                $this->data['page_header']  = 'Add New Admission (Inter Level)';
                $this->data['page']         = 'admission/New_Admission/add_new_student_record';
                $this->load->view('common/common',$this->data);   
	}
    public function new_student_academic_record(){		
        
        
        $id                         = $this->uri->segment(2);
        $this->data['student_id']   = $id;
        $session                    = $this->session->all_userdata();
        $user_id                    = $session['userData']['user_id'];
        if($this->input->post('Add_education')):
       
            $TotMarks       = $this->input->post('total_marks');
            $ObtMarks       = $this->input->post('obtained_marks');
            
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
                $Percent = $ObtMarks/$TotMarks*100;
                $percent = round($Percent,3);
            endif;

                    $whereEDCheck = array(
                       'student_id'=>$this->input->post('student_id'),
                        'degree_id'=>$this->input->post('degree_id')
                    );
                    $query = $this->CRUDModel->get_where_row('applicant_edu_detail',$whereEDCheck);
            if($query):
                    $this->session->set_flashdata('msg', 'This Academic Record Already Exist');
                    redirect('NewAdmissionAcademic/'.$this->input->post('student_id'));

            else:
                $inst_id = ucwords(strtolower(ucwords($this->input->post('inst_id'))));
                $data = array
                    (	
                        'student_id'=>$this->input->post('student_id'),
                        'degree_id'=>$this->input->post('degree_id'),
                        'inst_id'=>$inst_id,
                        'bu_id'=>$this->input->post('bu_id'),
                        'year_of_passing'=>$this->input->post('year_of_passing'),
                        'total_marks'=>$this->input->post('total_marks'),
                        'obtained_marks'=>$this->input->post('obtained_marks'),
                        'year_of_passing'=>$this->input->post('year_of_passing'),
                        'cgpa'=>$this->input->post('cgpa'),
                        'percentage'=>$percent,
                        'exam_type'=>$this->input->post('exam_type'),
                        'inserteduser'=>$user_id
                    );
                    $this->CRUDModel->insert('applicant_edu_detail',$data);
                    redirect('NewAdmissionAcademic/'.$this->input->post('student_id'));
            endif;
        endif;
            $this->data['degree']               = $this->CRUDModel->dropDown('degree', ' Select degree  ', 'degree_id', 'title');
            $this->data['board_university']     = $this->CRUDModel->dropDown('board_university', ' Select Board  ', 'bu_id', 'title');
            $where                              = array('applicant_edu_detail.student_id'=>$this->uri->segment(2));
            $where1                             = array('student_grades.student_id'=>$this->uri->segment(2));
            $this->data['student_records']      = $this->get_model->student_edu_record($where);
            $this->data['grade']                = $this->get_model->getstudents_grade($where1);
            
            $this->data['page_title']   = 'Academic Record of Students  | ECMS';
            $this->data['page']         = 'admission/New_Admission/new_student_academic_record';
            $this->load->view('common/common',$this->data);
      }
    public function update_new_admission_academic(){
        
        $id                     = $this->uri->segment(2);
        $this->data['result']   = $this->get_model->academicData($id);
        $student_id = $this->input->post('old_student_id');
        if($this->input->post()){
            $TotMarks = $this->input->post('total_marks');
            $ObtMarks = $this->input->post('obtained_marks');
            if($ObtMarks==0 && $TotMarks==0):
               $percent = 0;
            else: 
            $Percent = $ObtMarks/$TotMarks*100;
            $percent = round($Percent,3);
            endif;
            $data_post = array(
                'degree_id'         => $this->input->post('degree_id'),
                'inst_id'           => $this->input->post('inst_id'),
                'bu_id'             => $this->input->post('bu_id'),
                'year_of_passing'   => $this->input->post('year_of_passing'),
                'total_marks'       => $this->input->post('total_marks'),
                'obtained_marks'    => $this->input->post('obtained_marks'),
                'year_of_passing'   => $this->input->post('year_of_passing'),
                'cgpa'              => $this->input->post('cgpa'),
                'grade_id'          => $this->input->post('grade_id'),
                'percentage'        => $percent,
                'exam_type'         => $this->input->post('exam_type')
            );
            $this->get_model->updateacademic($data_post,$id);
            $this->session->set_flashdata('upd_msg', 'Record Updated Successfully');
            redirect('NewAdmissionAcademic/'.$student_id);
        }
            $this->data['page_title']   = 'Update New Admission Academic | ECMS';
            $this->data['page_header']  = 'Update New Admission Academic';
            $this->data['page']         = 'admission/New_Admission/update_new_academic_record';
            $this->load->view('common/common',$this->data);
		
	}
        
    public function update_new_admission_record(){	
        $uri                = $this->uri->segment(2);
        $sub_program_id     = $this->uri->segment(3);
        $session            = $this->session->all_userdata();
        $user_id            = $session['userData']['user_id'];
        $this->data['result']  = $this->get_model->studentData($uri);
        $this->data['sub_program_id'] = $sub_program_id;
        
        $where_sub  = array('student_id'        => $uri);
        $this->data['selectsubjects']           = $this->AdmissionModel->new_student_subject_get($where_sub);
        $this->data['allSubjects']              = $this->CRUDModel->get_where_result('subject',array('sub_pro_id'=>$sub_program_id));
        $this->data['guardian_of_relation']     = $this->CRUDModel->dropDown('relation', ' Relation ', 'relation_id', 'title');
        
        if($this->input->post()){
             
            
            $student            = ucwords(strtolower(ucwords($this->input->post('student_name'))));
            $father             = ucwords(strtolower(ucwords($this->input->post('father_name'))));
            $guardian           = ucwords(strtolower(ucwords($this->input->post('guardian_name'))));
            $emargency_person   = ucwords(strtolower(ucwords($this->input->post('emargency_person_name'))));
            $current_datetime   = date('Y-m-d H:i:s');
            $dob                =  $this->input->post('dob'); 
            $StudentPK          =  $this->input->post('PK_student_id'); 
            $FK_student_id      =  $this->input->post('sub_pro_id'); 
            $admission_date     =  $this->input->post('admission_date'); 
            $date1              = date('Y-m-d', strtotime($dob));
            $date2              = date('Y-m-d', strtotime($admission_date));
             
              $hostelInfo = $this->db->get_where('hostel_student_record',array('student_id'=>$StudentPK))->row();
            
            if(!empty($hostelInfo)):
                
                $data = array(
                  'guardian_of_hostel'      => $this->input->post('guardian_of_hostel'),  
                  'guardian_hostel_relation'=> $this->input->post('guardian_of_relation'),  
                  'student_mobile_no'       => $this->input->post('student_mobile_no_hostel1'),  
                  'student_mobile_no2'      => $this->input->post('student_mobile_no_hostel2'),  
                  'city'                    => $this->input->post('city'),  
                );
                
            
                $this->CRUDModel->update('hostel_student_record',$data,array('student_id'=> $StudentPK ));
            endif;  
            
            
            $data_post = array(
                'batch_id'          => $this->input->post('batch_id'),
                'programe_id'       => $this->input->post('programe_id'),
                'sub_pro_id'        => $this->input->post('sub_pro_id'),
                'form_no'           => $this->input->post('form_no'),
                'rseats_id'         => $this->input->post('rseats_id'),
                'rseats_id1'        => $this->input->post('rseats_id1'),
                 'rseats_id3'        => $this->input->post('rseats_id3'),
//                'rseats_id2'        => $this->input->post('rseat_id2'),
                'comment'           => $this->input->post('comment'),
                'shift_id'          => $this->input->post('shift_id'),
                'college_no'        => $this->input->post('college_no'),
                'fata_school'       => $this->input->post('fata_school'),
                'student_name'      => $student,
                'student_cnic'      => $this->input->post('student_cnic'),
                'gender_id'         => $this->input->post('gender_id'),
                'marital_id'        => $this->input->post('marital_id'),
                'dob'               => $date1,
                'place_of_birth'    => $this->input->post('place_of_birth'),
                'bg_id'             => $this->input->post('bg_id'),
                'country_id'        => $this->input->post('country_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'district_id'       => $this->input->post('district_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'hostel_required'   => $this->input->post('hostel_required'),
                'migration_status'  => $this->input->post('migration_status'),
                'migrated_remarks'  => $this->input->post('migrated_remarks'),
                'father_name'       => $father,
                'father_cnic'       => $this->input->post('father_cnic'),
                'land_line_no'      => $this->input->post('land_line_no'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'applicant_mob_no1' => $this->input->post('applicant_mob_no1'),
                'applicant_mob_no2' => $this->input->post('applicant_mob_no2'),
                'occ_id'            => $this->input->post('occ_id'),
                'annual_income'     => $this->input->post('annual_income'),
                'app_postal_address' => $this->input->post('app_postal_address'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'last_school_address' => $this->input->post('last_school_address'),
                'father_email'      => $this->input->post('father_email'),
                'guardian_name'     => $guardian,
                'guardian_cnic'     => $this->input->post('guardian_cnic'),
                'relation_with_guardian' => $this->input->post('relation_with_guardian'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'g_annual_income'   => $this->input->post('g_annual_income'),
                'g_land_no'         => $this->input->post('g_land_no'),
                'g_mobile_no'       => $this->input->post('g_mobile_no'),
                'g_postal_address'  => $this->input->post('g_postal_address'),
                'g_email'           => $this->input->post('g_email'),
                'physical_status_id' => $this->input->post('physical_status_id'),
                'emargency_person_name' => $emargency_person,
                'e_person_relation' => $this->input->post('e_person_relation'),
                'e_person_contact1' => $this->input->post('e_person_contact1'),
                'e_person_contact2' => $this->input->post('e_person_contact2'),
                's_status_id'       => $this->input->post('s_status_id'),
                'bank_receipt_no'   => $this->input->post('bank_receipt_no'),
//                'admission_date'    => $date2,
                'admission_comment' => $this->input->post('admission_comment'),
                'updated_by_user'   => $user_id,
                'updated_datetime'  => $current_datetime,
                'remarks'           => $this->input->post('remarks1'),
                'remarks2'          => $this->input->post('remarks2')
            ); 
             
             
            $college_no = $this->input->post('college_no');
            $where = array('college_no'=>$college_no,'s_status_id !='=>'9','student_id !='=>$StudentPK ,'college_no !='=>'');
            $query = $this->CRUDModel->get_where_row('student_record',$where);
            
            if(empty($query)):
                
                $new_subjects       = $this->input->post('checked');
                $checked_log        = $this->input->post('check_log');
//                echo '<pre>'; print_r($new_subjects); die;
                $checked_log = $this->CRUDModel->get_where_result('new_student_subjects', array('student_id'=>$StudentPK ));
//                echo '<pre>'; print_r($new_subjects); die;
                foreach($checked_log as $log_row){
                    $data =  array(
                            'student_id' =>$StudentPK,
                            'subject_id' =>$log_row->subject_id,
                            'sub_prog_id' =>$log_row->sub_prog_id,
                            'created_by' =>$log_row->created_by,
                            'date_time' =>$log_row->date_time,
                            'updated_by' =>$user_id,
                            'update_date_time' =>date('Y-m-d H:i:s'),
                             );
                $this->CRUDModel->insert('new_student_subjects_log',$data );
                }
                $this->CRUDModel->deleteid('new_student_subjects', array('student_id'=>$StudentPK));
                if(!empty($new_subjects)):
                    foreach($new_subjects as $row=>$value):
                    $dataa =  array(
                           'subject_id' =>$value,
                           'student_id' =>$StudentPK,
                           'sub_prog_id' =>$this->input->post('sub_pro_id'),
                           'updated_by' =>$user_id,
                           'update_date_time' =>date('Y-m-d H:i:s'),
                     );
                 
                if($FK_student_id == 5 || $FK_student_id == 4 || $FK_student_id == 26 || $FK_student_id == 27 ):
                    $this->CRUDModel->insert('new_student_subjects',$dataa);
                endif;
                
                endforeach; 
            endif;
                
                
                
                $this->get_model->updatestudent($data_post,$StudentPK);
                
                $rollno     = $this->input->post('rollno');
                $udata      = array('rollno'=>$rollno);    
                $this->CRUDModel->update('applicant_edu_detail',$udata,array('student_id'=>$StudentPK));     

                $batch_id           = $this->input->post('batch_id');
                $programe_id        = $this->input->post('programe_id');
                $sub_pro_id         = $this->input->post('sub_pro_id');
                $student_name       = $this->input->post('student_name');
                $form_no            = $this->input->post('form_no');
                $college_no         = $this->input->post('college_no');
                $shift_id           = $this->input->post('shift_id');
                $rseats_id          = $this->input->post('rseats_id');
                $rseats_id2         = $this->input->post('rseat_id2');
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
                $old_shift_id       = $this->input->post('old_shift_id');
                $old_rseats_id      = $this->input->post('old_rseats_id');
                $old_rseats_id2     = $this->input->post('old_rseats_id2');
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
                if($rseats_id2 != $old_rseats_id2):
                    $old_rs2 = $old_rseats_id2;
                else:
                    $old_rs2 = 'NULL';	
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
                if($shift_id != $old_shift_id):
                    $old_sf = $old_shift_id;
                else:
                    $old_sf = 'NULL';	
                endif;
                    if($old_b == 'NULL' && $old_p == 'NULL' && $old_sp == 'NULL' && $old_f == 'NULL' && $old_sf == 'NULL' && $old_c == 'NULL' && $old_r == 'NULL' && $old_rs2 == 'NULL' && 
                    $old_sn == 'NULL' && $old_dm == 'NULL' && $old_m == 'NULL' && $old_mb == 'NULL'):
                        redirect('NewAdmissonInterSearch');
                    else:
                        $data_log = array
                            (
                                'student_id'=>$StudentPK,
                                'batch_id'=>$old_b,
                                'programe_id'=>$old_p,
                                'sub_pro_id'=>$old_sp,
                                'form_no'=>$old_f,
                                'shift_id'=>$old_sf,
                                'college_no'=>$old_c,
                                'rseats_id'=>$old_r,
                                'rseats_id2'=>$old_rs2,
                                'student_name'=>$old_sn,
                                'domicile_id'=>$old_dm,
                                'mobile_no'=>$old_m,
                                'mobile_no2'=>$old_mb,
                                'user_id'=>$user_id,
                                'date'=>date('Y-m-d'),
                                'timestamp'=>date('Y-m-d H:i:')
                            );
                        $this->CRUDModel->insert('student_record_logs',$data_log);
                        redirect('NewAdmissonInterSearch');
                    endif;
                    else:
                        $this->session->set_flashdata('msg', 'College No. Already Exist');
                         redirect('UpdateNewAdmissionInter/'.$StudentPK.'/'.$sub_program_id);
                    endif;
                }
              
                $this->data['page_title']       = 'Update New Admission (Inter) Record | ECMS';
                $this->data['page_header']      = 'Update New Admission (Inter) Record';
                $this->data['page']             = "admission/New_Admission/update_new_admission_record";
                $this->load->view('common/common',$this->data);
            }
       
    public function update_new_admission_picture(){
//        $session = $this->session->all_userdata();
//        $this->userInfo->user_id =$session['userData']['user_id']; 
        $id = $this->uri->segment(2);
        
        if($this->input->post()):
            $image      = $this->CRUDModel->do_resize('applicant_image','assets/images/students');
            $file_name  = $image['file_name'];
            
            if($file_name == "_thumb"):
                $shift_id       = $this->input->post('shift_id');
                $rseat_id2      = $this->input->post('rseat_id2');
                $college_no     = $this->input->post('college_no');
                $admission_date = $this->input->post('admission_date');
                $date           = date('Y-m-d', strtotime($admission_date));
                
                        
                $log_data = array(
                    'college_no'    => $college_no,
                    'admission_date'=> $date,
                    'shift_id'      => $shift_id,
                    'reserved_seat' => $rseat_id2,
                    'user_id'       => $this->userInfo->user_id,
                );
                
                $data = array(
                    'rseats_id2'    =>$rseat_id2,
                    'shift_id'      =>$shift_id,
                    'college_no'    =>$college_no,
                    'admission_date'=>$date
                );
                $where = array('student_id'=>$id); 
                
                $this->CRUDModel->update('student_record',$data,$where);
                $this->CRUDModel->insert('student_add_picture_log',$log_data);
                
                else: 
                    $shift_id       = $this->input->post('shift_id');
                    $rseats_id2     = $this->input->post('rseat_id2');
                    $college_no     = $this->input->post('college_no');
                    $admission_date = $this->input->post('admission_date');
                    $date           = date('Y-m-d', strtotime($admission_date));
                    
                    $log_data = array(
                        'college_no'    => $college_no,
                        'admission_date'=> $date,
                        'shift_id'      => $shift_id,
                        'reserved_seat' => $rseats_id2,
                        'picture'       => $file_name,
                        'user_id'       => $this->userInfo->user_id,
                        'entry_date'    => date('Y-m-d H:i:s'),
                    );
                    
                    $data = array(
                        'rseats_id2'    => $rseats_id2,
                        'shift_id'      => $shift_id,
                        'applicant_image' => $file_name,
//		'applicant_image'=>$date('YmdHis').$file_name,
                        'college_no'    => $college_no,
                        'admission_date' => $date
                    );
                    $where = array('student_id'=>$id); 
                    
                    $this->CRUDModel->update('student_record',$data,$where);
                    $this->CRUDModel->insert('student_add_picture_log',$log_data);
            endif;
            redirect('NewAdmissonInterSearch'); 
        endif;
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->get_model->get_student_statusdata('student_record',$where);

            $this->data['page_title']       = 'Upload Student Picture | ECMS';
            $this->data['page_header']      = 'Upload Student Picture';
            $this->data['page']             =  'admission/New_Admission/new_admission_picture_v';
            $this->load->view('common/common',$this->data);
        endif;
    }
    public function update_college_no_search(){
        
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name',array('degree_type_id !='=>3));
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
         $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>1));
//        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name', array('programe_id'=>1)); 
        $this->data['status']       = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $program_id         =  $this->input->post('program');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $batch_id           =  $this->input->post('batch');
            $s_status_id        =  $this->input->post('s_status_id');
          
            $like  = '';
           
            $this->data['college_no']   = '';
            $this->data['form_no']      = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']    = '';
            $this->data['program_id']   = '';
            $this->data['sub_pro_id']   = '';
            $this->data['s_status_id']  = '';
            $this->data['batch_id']     = '';
            $def_where = array(
//                'student_record.programe_id'=>'1', 
                 'programes_info.degree_type_id !=' => '3', 
                'student_record.s_status_id'        => '5', 
                'college_no'                        => ''
            );
            $this->data['result']   = $this->AdmissionModel->new_admission_college_no_search('student_record', $def_where);
            
        if($this->input->post('search')):
             $where['programes_info.degree_type_id !='] = '3';
//             $where['student_record.batch_id'] = '74';
//             $where['student_record.programe_id'] = '1';
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no']           = $college_no;
            endif;
            if(!empty($form_no)):
                $like['form_no']        = $form_no;
                $this->data['form_no']  =$form_no;
            endif;
            if(!empty($program_id)):
                $like['programes_info.programe_id'] = $program_id;
                $this->data['program_id'] =$program_id;
            endif;
            if(!empty($batch_id)):
                $like['prospectus_batch.batch_id']  = $batch_id;
                $this->data['batch_id']             = $batch_id;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
//            if(!empty($s_status_id)):
//                $where['student_status.s_status_id'] = $s_status_id;
//                $this->data['s_status_id']  = $s_status_id;
//            endif;
                $this->data['result']   = $this->AdmissionModel->new_admission_college_no_search('student_record',$where,$like);
            endif;
           $this->data['page_title']   = 'All Student Records | ECMS';
            $this->data['page']        = 'admission/New_Admission/update_new_admission_college_no_search';
           $this->load->view('common/common',$this->data);
        
    }
    
    public function update_college_no(){
       
        $id = $this->uri->segment(2); 
         $this->data['shift']               = $this->CRUDModel->dropDown('shift', '', 'shift_id', 'name');
         $this->data['reserved_seat']        = $this->CRUDModel->dropDown('reserved_seat', '', 'rseat_id', 'name');
        if($this->input->post()):
//            echo '<pre>';print_r($this->input->post());
            $student_id = $this->input->post('student_id');
            $college_no = $this->input->post('college_no');
        $data = array( 'college_no' => $college_no, );
        $where = array('student_id'=>$student_id);
            $this->CRUDModel->update('student_record',$data,$where);
        redirect('UpdateCollegeNoSearch');
        endif;
        
        if($id):
        $where = array('student_record.student_id'=>$id);
        $this->data['result'] = $this->AdmissionModel->update_college_no('student_record',$where);
        $this->data['page_title']  = 'Update College no and Password | ECMS';
        $this->data['page']        = 'admission/New_Admission/update_new_admission_college_no';
        $this->load->view('common/common',$this->data); 
        endif;
    }
    
        public function upload_picture_search(){       
           $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', ' Select Limit  ', 'limitId', 'limit_value');
            $config['base_url']         = base_url('UploadPictureSearch');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>5)));  
            $config['per_page']         = 50; 
            $config["num_links"]        = 3;
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
            $custom['column']    ='student_id';
            $custom['order']     ='desc';          
            $this->data['result']    = $this->get_model->admin_stdData($config['per_page'], $page,$custom);
            $this->data['count']     =$config['total_rows']; 
           $this->data['page_title']   = 'Update Student Picture| ECMS';
           $this->data['page']         = 'admission/New_Admission/student_picture_upload';
           $this->load->view('common/common',$this->data);
       
    }
    public function upload_picture_search_result(){
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
        $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
        
        if($this->input->post('search')):
            $college_no       =  $this->input->post('college_no');
            $form_no       =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id             =  $this->input->post('gender_id');
            $programe_id            =  $this->input->post('programe_id');
            $sub_pro_id            =  $this->input->post('sub_pro_id');
            $rseats_id        =  $this->input->post('rseats_id');
            $limit              =  $this->input->post('limit');
          
            //like Array
            $like = '';
            $where['student_record.s_status_id'] = '5';
            $this->data['college_no'] = '';
            $this->data['form_no'] = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']  = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']  = '';
            $this->data['rseats_id']  = '';
            $this->data['limitId']  = '';
            
        
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
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($programe_id)):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id']  = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            $limitVale = $this->CRUDModel->get_where_row('show_limit',array('limitId'=>$limit));
              
                if($limitVale):
                    $limitD = $limitVale->limit_value;
                else:
                    $limitD = 50;
                endif;
                $custom['limit']        = $limitD;
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $this->data['limitId']  = $limit;
        
                $this->data['result']   = $this->get_model->get_admin_stdData('student_record',$where,$like,$custom);    
                $this->data['page']     = "admission/New_Admission/search_adding_picture_student_v";
                $this->data['title']    = 'Student Upload Picture| ECMS';
                $this->load->view('common/common',$this->data);
                else:
                    redirect('UploadPictureSearch');
        endif;
    }
    
    public function upload_picture(){
        $id = $this->uri->segment(2);
        if($id):
            $where = array('student_id'=>$id);
            $this->data['result'] = $this->get_model->get_student_statusdata('student_record',$where);

            $this->data['page_title']        = 'Upload Student Picture | ECMS';
            $this->data['page']        =  'admission/New_Admission/student_picture_upload_fresh';
            $this->load->view('common/common',$this->data);
        endif;
    }
    public function upload_picture_update(){
       
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id']; 
//        $id = $this->uri->segment(2);
        
//         echo '<pre>';print_r($this->input->post());
        if($this->input->post('UploadPicture')):
          
            $image      = $this->CRUDModel->do_resize('applicant_image','assets/images/students/');
            $file_name  = $image['file_name'];
            $where = array('student_id'=>$this->input->post('student_id'));
            
            $check_img = $this->CRUDModel->get_where_row('student_record',$where);
            
//            if(!empty($check_img->applicant_image)):
//                unlink('assets/images/students/'.$check_img->applicant_image);
//            endif;
            
            $log_data = array(
                    'std_id'        =>$this->input->post('student_id'),
                    'user_id'       => $user_id,
                    'entry_date'    => date('Y-m-d H:i:s'),
                    'picture'       => $check_img->applicant_image,
                    );
                    
                    $data = array(
                        'applicant_image' => $file_name,
                    );
                     
                    
                    $this->CRUDModel->update('student_record',$data,$where);
                    $this->CRUDModel->insert('student_add_picture_log',$log_data);
                redirect('StudentsForIDCards'); 
                else:
                 redirect('StudentsForIDCards');      
        endif;
    }
    public function  student_record_bba(){
        
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programe_id'=>6));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>6));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'6'));

            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
            $this->data['status']           = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
       
            $like                           = '';
            $where                          = '';
            $this->data['student_id']       = '';
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['gender_id']        = '';
            $this->data['rseats_id']        = '';
            $this->data['s_status_id']      = '';
            $this->data['limitId']          = '';
            $this->data['programId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']          = '';
	   
            if($this->input->post('search')):
            
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('program');
            $sub_program        =  $this->input->post('sub_program');
            $batch              =  $this->input->post('batch');
            
            $where['student_record.programe_id'] = '6';
            
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
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $where['form_no'] = $form_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                
                $this->data['result']   = $this->get_model->get_hndstdData('student_record',$where,$like,$custom);
              
            else:
            $where               = array('student_record.programe_id'=>'6','student_record.s_status_id'=>'5');
            //pagination start
            $config['base_url']         = base_url('StudentRecordBBA');
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
            $this->data['result']       = $this->get_model->stds_hnd_pagination($config['per_page'], $page,$where,$custom);
            $this->data['count']        = $config['total_rows']; 
            endif;
            
            if($this->input->post('export')):
             
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record BBA');
             $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('C1','Form No');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Gender');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Seat');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Shift');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Section');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Student status');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Mobile No#');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Domicle');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('T'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
           
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('program');
            $sub_program        =  $this->input->post('sub_program');
            $batch              =  $this->input->post('batch');
            
           
            $where = '';
            if(!empty($program)):
                 $where['student_record.programe_id'] = $program;
                $this->data['programId']    = $program;
            endif;
            if(!empty($sub_program)):
                 $where['student_record.sub_pro_id'] = $sub_program;
                $this->data['subprogramId']         = $sub_program;
            endif;
             if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
            endif;
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $where['form_no'] = $form_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                 
                $result = $this->get_model->get_Export('student_record',$where,$like);
                
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_BBA.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
            endif;
           $this->data['page_title']    = 'BBA Student Records | ECMS';
           $this->data['title']         = 'BBA  Student Records';
           $this->data['page']          = 'admission/bba/form/bba_student_record_search';
           $this->load->view('common/common',$this->data);
    }
    public function  student_record_hnd(){
        
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programe_id'=>3));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>3));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'3'));

            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
            $this->data['status']           = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Admission Status', 's_status_id', 'name');
       
            $like                           = '';
            $where                          = '';
            $this->data['student_id']       = '';
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['gender_id']        = '';
            $this->data['rseats_id']        = '';
            $this->data['s_status_id']      = '';
            $this->data['limitId']          = '';
            $this->data['programId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']          = '';
	   
            if($this->input->post('search')):
            
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('program');
            $sub_program        =  $this->input->post('sub_program');
            $batch              =  $this->input->post('batch');
            
            $where = ''; 
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
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $where['form_no'] = $form_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id']    = $s_status_id;
                $this->data['s_status_id']              = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $this->data['result']   = $this->get_model->get_hndstdData('student_record',$where,$like,$custom);
            else:
            $where               = array('student_record.programe_id'=>'3','student_record.s_status_id'=>'5');
            //pagination start
            $config['base_url']         = base_url('StudentRecordHND');
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
            $this->data['result']       = $this->get_model->stds_hnd_pagination($config['per_page'], $page,$where,$custom);
            $this->data['count']        = $config['total_rows']; 
            endif;
            if($this->input->post('export')):
                  
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Students Record HND');
                 $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('C1','Form No');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('F1','Gender');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('G1','Seat');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('K1','%Age');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('L1','Shift');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('M1','Section');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('N1','Student status');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('O1','Mobile No#');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('R1','Domicle');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('S1','Religion');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);


           for($col = ord('A'); $col <= ord('T'); $col++){
                    //set column dimension
                    $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                     //change the font size
                    $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                    $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }


                $student_id         =  $this->input->post('student_id');
                $college_no         =  $this->input->post('college_no');
                $form_no            =  $this->input->post('form_no');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $gender_id          =  $this->input->post('gender_id');
                $rseats_id          =  $this->input->post('rseats_id');
                $s_status_id        =  $this->input->post('s_status_id');
                $program            =  $this->input->post('program');
                $sub_program        =  $this->input->post('sub_program');
                $batch              =  $this->input->post('batch');


                $where = '';
                if(!empty($program)):
                     $where['student_record.programe_id'] = $program;
                    $this->data['programId']    = $program;
                endif;
                if(!empty($sub_program)):
                     $where['student_record.sub_pro_id'] = $sub_program;
                    $this->data['subprogramId']         = $sub_program;
                endif;
                 if(!empty($batch)):
                     $where['student_record.batch_id'] = $batch;
                    $this->data['batchId'] = $batch;
                endif;
                if(!empty($student_id)):
                    $where['student_record.student_id'] = $student_id;
                    $this->data['student_id'] =$student_id;
                endif;
                if(!empty($form_no)):
                    $where['form_no'] = $form_no;
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
                if(!empty($rseats_id)):
                    $where['reserved_seat.rseat_id'] = $rseats_id;
                    $this->data['rseats_id']  = $rseats_id;
                endif;
                if(!empty($s_status_id)):
                    $where['student_status.s_status_id'] = $s_status_id;
                    $this->data['s_status_id']  = $s_status_id;
                endif;

                    $result = $this->get_model->get_Export('student_record',$where,$like);

            foreach ($result as $row)
            {
            $exceldata[] = $row;
            }      

            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename='StudentsRecord_HND.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output');  
            endif;
           $this->data['page_title']    = 'HND Student Records | ECMS';
           $this->data['title']         = 'HND  Student Records';
           $this->data['page']          = 'admission/hnd/form/hnd_student_record_search';
           $this->load->view('common/common',$this->data);
    }
    public function  student_record_edsml(){
        
            $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('status'=>'yes','programe_id'=>7));
            $this->data['subprogrames']     = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>7));
            $this->data['batch']            = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>'7'));

            $this->data['gender']           = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', ' Reserved Seats ', 'rseat_id', 'name');  
            $this->data['status']           = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');  
            $this->data['limit']            = $this->CRUDModel->dropDown('show_limit', 'Select Limit', 'limitId', 'limit_value');
            $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Admission Status', 's_status_id', 'name');
            $like                           = '';
            $where                          = '';
            $this->data['student_id']       = '';
            $this->data['college_no']       = '';
            $this->data['form_no']          = '';
            $this->data['student_name']     = '';
            $this->data['father_name']      = '';
            $this->data['gender_id']        = '';
            $this->data['rseats_id']        = '';
            $this->data['s_status_id']      = '';
            $this->data['limitId']          = '';
            $this->data['programId']        = '';
            $this->data['subprogramId']     = '';
            $this->data['batchId']          = '';
	   
            if($this->input->post('search')):
            
            $student_id         =  $this->input->post('student_id');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $program            =  $this->input->post('program');
            $sub_program        =  $this->input->post('sub_program');
            $batch              =  $this->input->post('batch');
            
             $where = '';
            
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
            if(!empty($student_id)):
                $where['student_record.student_id'] = $student_id;
                $this->data['student_id'] =$student_id;
            endif;
            if(!empty($form_no)):
                $where['form_no'] = $form_no;
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
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
                
                $custom['start']        = 0;
                $custom['column']       = 'applicant_edu_detail.percentage';
                $custom['order']        = 'desc';
                $this->data['result']   = $this->get_model->get_hndstdData('student_record',$where,$like,$custom);
            else:
            $where                      = array('student_record.programe_id'=>'7','student_record.s_status_id'=>'5');
            //pagination start
            $config['base_url']         = base_url('StudentRecordEDSML');
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
            $this->data['result']       = $this->get_model->stds_hnd_pagination($config['per_page'], $page,$where,$custom);
            
            $this->data['count']        = $config['total_rows']; 
            endif;
            if($this->input->post('export')):
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Students Record EDSML');
                 $this->excel->getActiveSheet()->setCellValue('A1', 'Serial No');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('B1', 'College No');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('C1','Form No');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('D1', 'Student Name');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('E1','Father Name');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('F1','Gender');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('G1','Seat');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('K1','%Age');
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('L1','Shift');
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('M1','Section');
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('N1','Student status');
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('O1','Mobile No#');
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('R1','Domicle');
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

                $this->excel->getActiveSheet()->setCellValue('S1','Religion');
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);


           for($col = ord('A'); $col <= ord('T'); $col++){
                    //set column dimension
                    $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                     //change the font size
                    $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                    $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }


                $student_id         =  $this->input->post('student_id');
                $college_no         =  $this->input->post('college_no');
                $form_no            =  $this->input->post('form_no');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $gender_id          =  $this->input->post('gender_id');
                $rseats_id          =  $this->input->post('rseats_id');
                $s_status_id        =  $this->input->post('s_status_id');
                $program            =  $this->input->post('program');
                $sub_program        =  $this->input->post('sub_program');
                $batch              =  $this->input->post('batch');


                $where = '';
                if(!empty($program)):
                     $where['student_record.programe_id'] = $program;
                    $this->data['programId']    = $program;
                endif;
                if(!empty($sub_program)):
                     $where['student_record.sub_pro_id'] = $sub_program;
                    $this->data['subprogramId']         = $sub_program;
                endif;
                 if(!empty($batch)):
                     $where['student_record.batch_id'] = $batch;
                    $this->data['batchId'] = $batch;
                endif;
                if(!empty($student_id)):
                    $where['student_record.student_id'] = $student_id;
                    $this->data['student_id'] =$student_id;
                endif;
                if(!empty($form_no)):
                    $where['form_no'] = $form_no;
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
                if(!empty($rseats_id)):
                    $where['reserved_seat.rseat_id'] = $rseats_id;
                    $this->data['rseats_id']  = $rseats_id;
                endif;
                if(!empty($s_status_id)):
                    $where['student_status.s_status_id'] = $s_status_id;
                    $this->data['s_status_id']  = $s_status_id;
                endif;

                    $result = $this->get_model->get_Export('student_record',$where,$like);

            foreach ($result as $row)
            {
            $exceldata[] = $row;
            }      

            $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
            $filename='StudentsRecord_EDSML.xls'; 
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0'); 
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            $objWriter->save('php://output'); 
            endif;
           $this->data['page_title']    = 'EDSML Student Records | ECMS';
           $this->data['title']         = 'EDSML  Student Records';
           $this->data['page']          = 'admission/edsml/form/edsml_student_record_search';
           $this->load->view('common/common',$this->data);
    }
     public function student_delete_by_status(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', ' Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', '', 's_status_id', 'name',array('s_status_id'=>1));
        $this->data['shift']            = $this->CRUDModel->dropDown('shift', ' Select Shift', 'shift_id', 'name');
        $this->data['hostel_status']    = $this->CRUDModel->dropDown('hostel_status', ' Hostel Status', 'hostel_status_id', 'status_name');
        
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
         $this->data['pictureId']   = '';
         $this->data['shift_id']   = '';
         $this->data['hostel_id']   = '';
        
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
            $student_status = $this->input->post("student_status");
            $shift          = $this->input->post("shift");
           
            
            $where['student_record.s_status_id']      = '1';
            $like       = '';
             
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['college_no']          = $collegeNo;
            endif;
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($shift):
                $where['student_record.shift_id']   = $shift;
                $this->data['shift_id']             = $shift;
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
             $this->data['result'] = $this->AdmissionModel->inter_new_students_record_search($where,$like);
        endif;
        if($this->input->post('DeleteRecord')):
           $student_id = $this->input->post('checked');
        
            foreach($student_id as $row=>$key):
                    $this->CRUDModel->deleteid('applicant_edu_detail',array('student_id'=>$key));
                    $this->CRUDModel->deleteid('student_record',array('student_id'=>$key));
                 
            endforeach;
        endif;
         
        $this->data['page']         = 'admission/admin/form/student_delete_by_status_v';
        $this->data['page_header']  = 'Student Delete ';
        $this->data['page_title']   = 'Student Delete | ECMS';
        $this->load->view('common/common',$this->data); 
    }
    
        public function a_level_records(){
            
            $this->data['collegeNo']    = '';
            $this->data['stdName']      = '';
            $this->data['fatherName']   = '';
            $this->data['gender_id']    = '';
            $this->data['sub_pro_id']   = '';
            $this->data['reg_no']       = ''; 
            $this->data['Form']         = ''; 
            $this->data['status_id']    = ''; 
            $this->data['batch_id']     = ''; 
            if($this->input->post()):
                
                $college_no         =  $this->input->post('college_no');
                $Form               =  $this->input->post('Form');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $s_status           =  $this->input->post('status_id');
                $batch              =  $this->input->post('batch');
                
               
                $like = '';
//                $where['student_record.batch_id']       = $default_batch->batch_id;
                $where['student_record.programe_id']    = '5'; 
                 
              
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
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id']              = $sub_pro_id;
                    $this->data['sub_pro_id']                       = $sub_pro_id;
                endif;
                if(!empty($batch)):
                    $where['student_record.batch_id']               = $batch;
                    $this->data['batch_id']                         = $batch;
                endif;
                $this->data['result']   = $this->AdmissionModel->stduent_data_verifications($where,$like); 
                $this->data['count']    = count($this->data['result']);
        else:
            
          
            //pagination start
            $config['base_url']         = base_url('ALevelRecords');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('student_record.programe_id'=>5)));  //echo $config['total_rows']; exit;
            $config['per_page']         = 25;
            $config["num_links"]        = 5;
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
                 'student_record.programe_id'=>5

             );
            $this->data['result']       = $this->AdmissionModel->data_verification_pagination($config['per_page'],$page,$pagni_where); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
             
            $this->data['sub_program']          = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>5));
            $this->data['gender']               = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['student_status']       = $this->CRUDModel->dropDown('student_status', 'Select Status', 's_status_id', 'name', array('s_status_id !='=> 17));
            $this->data['batch']                = $this->CRUDModel->dropDown('prospectus_batch','Select Batch', 'batch_id', 'batch_name',array('status'=>'on','programe_id'=>5));
            $this->data['ReportName']           = 'A Level Records';
            $this->data['page_title']           = 'A Level Records | ECMS';
            $this->data['page']                 = 'admission/Alevel/Forms/alevel_record_v';
            $this->load->view('common/common',$this->data);
        }
        public function student_record_inter_view(){
        $whereSub_pro = array('programe_id'=>1);
        
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name',$whereSub_pro);
        $this->data['reserved_seat'] = $this->CRUDModel->dropDown('reserved_seat', 'Admission Alloted in', 'rseat_id', 'name');  
        $this->data['status']       = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
        $this->data['shift']        = $this->CRUDModel->dropDown('shift', 'Select Shift', 'shift_id', 'name');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name',$whereSub_pro);
        
        $like = '';
        $where = '';
        $this->data['batchId']      = '';
        $this->data['college_no']   = '';
        $this->data['form_no']      = '';
        $this->data['student_name'] = '';
        $this->data['father_name']  = '';
        $this->data['gender_id']    = '';
        $this->data['sub_pro_id']   = '';
        $this->data['rseats_id']    = '';
        $this->data['s_status_id']  = '';
        $this->data['shft_id']      = '';
            
        if($this->input->post('search')):
            $college_no     =  $this->input->post('college_no');
            $form_no        =  $this->input->post('form_no');
            $student_name   =  $this->input->post('student_name');
            $father_name    =  $this->input->post('father_name');
            $gender_id      =  $this->input->post('gender_id');
            $sub_pro_id     =  $this->input->post('sub_pro_id');
            $rseats_id      =  $this->input->post('rseats_id');
            $s_status_id    =  $this->input->post('s_status_id');
            $batch          =  $this->input->post('batch');
            $shift          =  $this->input->post('shift');
            $limit          =  $this->input->post('limit');
          
            
            
            $where['student_record.programe_id'] = 1;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($shift)):
                $where['shift.shift_id'] = $shift;
                $this->data['shft_id']  = $shift;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
           
        $this->data['result'] = $this->get_model->get_stdData('student_record',$where,$like);
        else:
        $where = array('student_record.programe_id'=>1);
        $config['base_url']   = base_url('InterStdView');
        $config['total_rows'] = count($this->CRUDModel->get_where_result('student_record',$where));  
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
        $page = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
        $this->data['pages']        = $this->pagination->create_links();          
        $this->data['result']    = $this->get_model->stds_pagination($config['per_page'], $page,$where);
        $this->data['count']     =$config['total_rows']; 
        endif;
        $this->data['page_title']   = 'Students Record (Inter Level View) | ECMS';
        $this->data['page']         = 'admission/inter/form/student_record_inter_view';
        $this->load->view('common/common',$this->data);
        
        if($this->input->post('export')):    
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Students Record Inter Level');
            //set cell A1 content with some text

            $this->excel->getActiveSheet()->setCellValue('A1', 'S No.');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
            
            $this->excel->getActiveSheet()->setCellValue('B1', 'Clg No.');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
            
            $this->excel->getActiveSheet()->setCellValue('C1', 'Form No.');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('D1','Student Name');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('E1', 'Father Name');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('F1','Gender');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('G1','Admission Alloted in');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('H1','Sub Program');
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('I1','T.Marks');
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('J1','O.Marks');
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('K1','%Age');
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('L1','Shift');
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('M1','Section');
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('N1','Student status');
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('O1','Mobile Number');
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('P1','Permanent Address');
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('Q1','Postal Address');
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('R1','Domicile');
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(16);

            $this->excel->getActiveSheet()->setCellValue('S1','Religion');
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setSize(16);
    
                
       for($col = ord('A'); $col <= ord('S'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                  
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $rseats_id          =  $this->input->post('rseats_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $batch              =  $this->input->post('batch');
            $shift              =  $this->input->post('shift');
           $like = '';
            $where = '';
          $where['student_record.programe_id'] = 1;
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
            if(!empty($batch)):
                 $where['student_record.batch_id'] = $batch;
                $this->data['batchId'] = $batch;
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
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($shift)):
                $where['shift.shift_id'] = $shift;
                $this->data['shft_id']  = $shift;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']  = $sub_pro_id;
            endif;
            if(!empty($s_status_id)):
                $where['student_status.s_status_id'] = $s_status_id;
                $this->data['s_status_id']  = $s_status_id;
            endif;
        $result = $this->get_model->get_Export('student_record',$where,$like);
        $exceldata="";
        foreach ($result as $row)
        {
        $exceldata[] = $row;
        }      

        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='StudentsRecord_InterLevel.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
        endif;
    }
        public function bs_enrollment_no_search(){
        
            
            
            
            
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', ' Gender ', 'gender_id', 'title');
//        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name'); 
//        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Program ', 'sub_pro_id', 'name', array('programe_id'=>1)); 
        $this->data['status']       = $this->CRUDModel->dropDown('student_status', ' Admission Status ', 's_status_id', 'name');
            $college_no         =  $this->input->post('college_no');
            $form_no            =  $this->input->post('form_no');
            $student_name       =  $this->input->post('student_name');
            $father_name        =  $this->input->post('father_name');
            $gender_id          =  $this->input->post('gender_id');
            $program_id         =  $this->input->post('program');
            $sub_pro_id         =  $this->input->post('sub_pro_id');
            $s_status_id        =  $this->input->post('s_status_id');
            $enrollement_no     =  $this->input->post('enrollement_no');
          
            $like  = '';
           
            $this->data['college_no']   = '';
            $this->data['form_no']      = '';
            $this->data['student_name'] = '';
            $this->data['father_name']  = '';
            $this->data['gender_id']    = '';
            $this->data['sub_pro_id']   = '';
            $this->data['s_status_id']  = '';
            $this->data['program_id']  = '';
            $this->data['enrollement_no']  = '';
            $def_where = array(
                'student_record.s_status_id'    => '5', 
                'degree_type_id'                => '2',
                
            );
            $this->data['result']   = $this->AdmissionModel->bs_enrollment_no_search('student_record', $def_where);
            
        if($this->input->post('search')):
             $where['degree_type_id'] = '2';
//             $where['student_record.batch_id'] = '74';
//             $where['student_record.programe_id'] = '1';
            if(!empty($college_no)):
                $where['student_record.college_no'] = $college_no;
                $this->data['college_no'] = $college_no;
            endif;
            if(!empty($enrollement_no)):
                $where['bs_enrollment_no'] = $enrollement_no;
                $this->data['enrollement_no'] =$enrollement_no;
            endif;
            if(!empty($form_no)):
                $like['form_no'] = $form_no;
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
            if(!empty($gender_id)):
                $where['gender.gender_id'] = $gender_id;
                $this->data['gender_id']  = $gender_id;
            endif;
            if(!empty($rseats_id)):
                $where['reserved_seat.rseat_id'] = $rseats_id;
                $this->data['rseats_id']  = $rseats_id;
            endif;
            if(!empty($program_id)):
                $where['programes_info.programe_id'] = $program_id;
                $this->data['program_id']  = $program_id;
            endif;
            if(!empty($sub_pro_id)):
                $where['sub_programes.sub_pro_id']  = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
 
                $this->data['result']   = $this->AdmissionModel->new_admission_college_no_search('student_record',$where,$like);
            endif;
            
            $this->data['program']          = $this->dropdownModel->bs_program_dropDown('programes_info', 'Select', 'programe_id', 'programe_name',array('status'=>'yes','degree_type_id'=>'2'));
            
            if($program_id):
                $this->data['sub_program']       = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>$program_id));
                else:
                $this->data['sub_program']       = $this->CRUDModel->dropDown('sub_programes', ' Sub Program ', 'sub_pro_id', 'name',array('status'=>'yes','programe_id'=>'6'));
            endif;
            
            
            
           $this->data['page_header']   = 'Bs Enrollment No';
           $this->data['page_title']   = 'Bs Enrollment No | ECMS';
            $this->data['page']        = 'admission/New_Admission/bs_enrollment_no_v';
           $this->load->view('common/common',$this->data);
    }
        public function bs_enrollment_no_update(){
            $id                             = $this->uri->segment(2); 
            $this->data['shift']            = $this->CRUDModel->dropDown('shift', '', 'shift_id', 'name');
            $this->data['reserved_seat']    = $this->CRUDModel->dropDown('reserved_seat', '', 'rseat_id', 'name');
        
            if($this->input->post()):
                $student_id         = $this->input->post('student_id');
                $enrollment_no      = $this->input->post('enrollment_no');
                $data               = array( 'bs_enrollment_no' => $enrollment_no );
                $where              = array('student_id'=>$student_id);
                $this->CRUDModel->update('student_record',$data,$where);
            redirect('BsEnrollmentNo');
        endif;
        
        if($id):
        $where = array('student_record.student_id'=>$id);
        $this->data['result'] = $this->AdmissionModel->update_college_no('student_record',$where);
        $this->data['page_header']  = 'Update Bs Enrollment No';
        $this->data['page_title']  = 'Update Bs Enrollment No | ECMS';
        $this->data['page']        = 'admission/New_Admission/bs_enrollment_no_update_v';
        $this->load->view('common/common',$this->data); 
        endif;
    }
    public function group_allotment_inter_no_wise(){
            
        $this->data['program']      =  $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>1));
        $this->data['batch']        =  $this->CRUDModel->dropDown('prospectus_batch', 'Select Batch ', 'batch_id', 'batch_name',array('status'=>'On','programe_id'=>1),array('column'=>'batch_order','order'=>'asc'));
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Select Sub Program ', 'sub_pro_id', 'name',array('programe_id'=>1));
        $this->data['gender']       =  $this->CRUDModel->dropDown('gender', 'Select Gender ', 'gender_id', 'title');
        $this->data['section']      =  $this->CRUDModel->dropDown('sections', 'Select Section ', 'sec_id', 'name',array('status'=>'On','program_id'=>1),array('column'=>'name','order'=>'asc'));
        $this->data['shift']            = $this->CRUDModel->dropDown('shift', 'Select Shift ', 'shift_id', 'name');
            
            
            if($this->input->post('save')):
            
            $ides = $this->input->post('checked');
            $sec_id = $this->input->post('sec_id');
        
            foreach($ides as $row=>$value):
            
                
                $this->CRUDModel->update('student_record',array('flag'=>1),array('student_id'=>$value));
                $this->CRUDModel->insert('
                student_group_allotment',
                 array(
                     'student_id'=>$value,
                       'section_id'=>$sec_id,
                        'timestamp'=>date('Y-m-d H:i:'),
                       'user_id'=>$this->userInfo->user_id
                 ));
            endforeach;
            endif;
        
            $this->data['page']         = "admission/inter/form/group_allotment_inter_no_wise";
            $this->data['page_header']  = 'Group Allotment All ( Inter )';
            $this->data['page_title']   = 'Group Allotment All ( Inter ) | ECMS';
            $this->load->view('common/common',$this->data);        
        
    }
    
    public function search_group_allotment_inter(){
             
            $student_name               =  $this->input->post('student_name');
            $father_name                =  $this->input->post('father_name');
            $college_no                 =  $this->input->post('college_no');
            $batch_id                   =  $this->input->post('batch_id');
            $sub_pro_id                 =  $this->input->post('sub_pro_id');
            $programe_id                =  $this->input->post('programe_id');
            $gender_id                  =  $this->input->post('gender_id');
            $number_from                =  $this->input->post('number_from');
            $number_to                  =  $this->input->post('number_to');
            $shift                      =  $this->input->post('shift');
            
     
            if($this->input->post('Search')):
                      
                                $this->db->order_by('obtained_marks','desc');
                                $this->db->limit('1','0');
                $max_numbers = $this->db->get_where('applicant_edu_detail')->row();
                $where = '';
                $like = '';
                $where['student_record.s_status_id'] = 5;
                $where['student_record.flag'] = 0;
                if(empty($number_to)):
                   $std_no['std_no_to']   = $max_numbers->obtained_marks;
                else:
                    $std_no['std_no_to']   = $number_to;
                endif;
                $std_no['std_no_from']   = $number_from;
                   
                if(!empty($student_name)):
                    $like['student_record.student_name'] = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['student_record.father_name'] = $father_name;
                endif;
                if(!empty($college_no)):
                    $where['student_record.college_no'] = $college_no;
                endif;
                if(!empty($batch_id)):
                    $where['prospectus_batch.batch_id'] = $batch_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id'] = $programe_id;
                endif;
                if(!empty($gender_id)):
                    $where['gender.gender_id'] = $gender_id;
                endif;
                if(!empty($shift)):
                    $where['shift.shift_id']        = $shift;
                endif;
//                $result   = $this->AdmissionModel->search_student_group($where,$like,$std_no);
                $this->data['result']   = $this->AdmissionModel->search_student_group($where,$like,$std_no);
                
                $this->load->view('admission/inter/jQuery_Results/show_allotment_result',$this->data);
            endif;
            
            if($this->input->post('Save')):
                
                $ides = $this->input->post('checked');
                $sec_id = $this->input->post('sec_id');
                                    $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
            $user_details   =   $this->db->get_where('users',array('id'=>$this->userInfo->user_id))->row()->emp_name;
                
                
                foreach($ides as $row=>$value):


                    $this->CRUDModel->update('student_record',array('flag'=>1),array('student_id'=>$value));
                    $this->CRUDModel->insert('
                    student_group_allotment',
                     array(
                         'student_id'=>$value,
                           'section_id'=>$sec_id,
                            'timestamp'=>date('Y-m-d H:i:'),
                            'comment'      => 'First Time Alloted By '.$user_details.' Id :'.$this->userInfo->user_id,
                           'user_id'=>$this->userInfo->user_id
                     ));
                endforeach;
                
                
            endif;
    }
}
