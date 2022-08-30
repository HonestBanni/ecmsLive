<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class AdmissionController extends AdminController {
	function __construct(){
		parent::__construct();
                $this->load->model('AdmissionModel');
//                $this->load->model('AttendanceModel');
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
    
             
    }
