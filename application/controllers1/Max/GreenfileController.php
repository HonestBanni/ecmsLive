<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class GreenfileController extends AdminController {
	function __construct(){
		parent::__construct();
                $this->load->model('GreenfileModel');
                $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
	}
        
        
    Public function green_file_student(){
            
            $this->data['collegeNo']    = '';
            $this->data['stdName']      = '';
            $this->data['fatherName']   = '';
            $this->data['gender_id']    = '';
            $this->data['programe_id']  = '';
            $this->data['sub_pro_id']   = '';
            $this->data['reg_no']       = ''; 
            $this->data['batch_id']     = ''; 
          
            if($this->input->post()):
                
                $college_no         =  $this->input->post('college_no');
                $student_name       =  $this->input->post('student_name');
                $father_name        =  $this->input->post('father_name');
                $programe_id        =  $this->input->post('programe_id');
                $sub_pro_id         =  $this->input->post('sub_pro_id');
                $gender             =  $this->input->post('gender');
                $reg_no             =  $this->input->post('reg_no');
                $batch              =  $this->input->post('batch_id');
               
                $like = '';
                $where = '';
                
                 
                 if(!empty($batch)):
                    $where['student_record.batch_id'] = $batch;
                    $this->data['batch_id'] =$batch;
                endif;
                 if(!empty($college_no)):
                    $where['college_no']    = $college_no;
                    $this->data['collegeNo']= $college_no;
                endif;
                if(!empty($student_name)):
                    $like['student_name']   = $student_name;
                    $this->data['stdName']  = $student_name;
                endif;
                if(!empty($father_name)):
                    $like['father_name']    = $father_name;
                $this->data['fatherName']   = $father_name;
                endif;
                if(!empty($reg_no)):
                    $like['board_regno']    = $reg_no;
                    $this->data['reg_no']   = $reg_no;
                endif;
                if(!empty($gender)):
                    $where['gender.gender_id']  = $gender;
                    $this->data['gender_id']    = $gender;
                endif;
                if(!empty($programe_id)):
                    $where['programes_info.programe_id'] = $programe_id;
                    $this->data['programe_id']  = $programe_id;
                endif;
                if(!empty($sub_pro_id)):
                    $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                    $this->data['sub_pro_id']  = $sub_pro_id;
                endif;
                 
                $this->data['result']   = $this->GreenfileModel->green_file_pagination_search($where,$like); 
                $this->data['count']   = count($this->data['result']);
        else:

          
            //pagination start
            $config['base_url']         = base_url('GreenFileStudent');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('student_record',array('s_status_id'=>9)));  //echo $config['total_rows']; exit;
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
            
            //Customizing the “Digit?? Link
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
             
            $this->data['result']       = $this->GreenfileModel->green_file_pagination($config['per_page'],$page); //get user data from db
            $this->data['count']        = $config['total_rows'];
            
        endif;
        
            $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
            $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
            $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
            $this->data['batch']        = $this->CRUDModel->DropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name');
           
            $this->data['page_header']  = 'Students Green File';
            $this->data['page_title']   = 'Students Green File| ECMS';
            $this->data['page']         = 'AdminOffice/GreenFile/Forms/green_file_v';
            $this->load->view('common/common',$this->data);
             
        }
    public function green_file_update(){
$id         = $this->uri->segment(2); 
        
         if($this->input->post()):
            $data                   = array(
                'admitted_to'       => $this->input->post('std_admitted_to'),
                'college_no'        => $this->input->post('college_no'),
                'programe_id'       => $this->input->post('program_std'),
                'board_regno'       => $this->input->post('board_regno'),
                'uni_regno'         => $this->input->post('uni_regno'),
                'student_name'      => $this->input->post('student_name'),
//                'student_name'      => ucwords(strtolower(ucwords($this->input->post('student_name')))),
                'student_cnic'      => $this->input->post('student_cnic'),
                'father_name'       => $this->input->post('father_name'),
                'occ_id'            => $this->input->post('occ_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'dob'               => date('Y-m-d', strtotime($this->input->post('dob'))),
                'sports_id'         => $this->input->post('sports_id'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'app_postal_address'=> $this->input->post('app_postal_address'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'hostel_required'   => $this->input->post('hostel_required'),
                'char_id'           => $this->input->post('std_char_id'),
                'admission_date'    => date('Y-m-d', strtotime($this->input->post('admission_date'))),
                'certificate_issue_date'=>date('Y-m-d', strtotime($this->input->post('certificate_issue_date'))),
                'dues_any'          => $this->input->post('dues_any'),
                'remarks'           => $this->input->post('remarks'),
                'remarks2'          => $this->input->post('remarks2'),
                'updated_by_user'   => $this->userInfo->user_id,
                'bg_id'             =>$this->input->post('blood_group')
            );
            $where                  = array(
                'student_id'        => $this->input->post('student_id')
            );
              $this->CRUDModel->update('student_record',$data,$where);
              
                 $academic_data     = array(
                    'student_id'        => $id,
                    'degree_id'         => $this->input->post('std_degree_id'),
                    'inst_id'           => $this->input->post('std_inst_id'),
//                    'bu_id'             => $this->input->post('bu_id'),
                    'year_of_passing'   => $this->input->post('std_year_of_passing'),
                    'total_marks'       => $this->input->post('std_total_marks'),
                    'obtained_marks'    => $this->input->post('std_obtained_marks'),
//                    'year_of_passing'   => $this->input->post('year_of_passing'),
                    'grade_id'          => $this->input->post('std_grade_id'),
                    'rollno'            => $this->input->post('std_rollno'),
                    'inserteduser'      => $this->userInfo->user_id
                );
              $query                  = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$id,'serial_no'=>$this->input->post('serial_no')));
               
//              echo '<pre>';print_r($query);die;
              
              if($query):
                    $this->CRUDModel->update('applicant_edu_detail',$academic_data,array('student_id'=>$id,'serial_no'=>$this->input->post('serial_no')));
                 
                endif;
              redirect('GreenFileStudent'); 
           endif;
                    
            if($id):
                $where                          = array('student_record.student_id'=>$id);
                $this->data['result']           = $this->GreenfileModel->greend_file_student_record($where);
                $this->data['domicile']         = $this->CRUDModel->get_where_result('domicile',array('domicile_id'=>$this->data['result']->domicile_id) ); 
//                 echo '<pre>';print_r($this->data['result']);die;
                $order['column'] = 'yr_num';
                $order['order'] = 'desc';
                $this->data['year_of_passing']  = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num','',$order);
                $this->data['occupation']       = $this->CRUDModel->dropDown('occupation', 'Select occupation', 'occ_id', 'title');
                $this->data['religion']         = $this->CRUDModel->dropDown('religion', 'Select Religion', 'religion_id', 'title');
                $this->data['sports']           = $this->CRUDModel->dropDown('sports', 'Select Sports', 'sports_id', 'sports_name');
                $this->data['degree']           = $this->CRUDModel->dropDown('degree', 'Select Degree', 'degree_id', 'title');
                $this->data['grade']            = $this->CRUDModel->dropDown('grade', 'Select Grade', 'grade_id', 'grade_name');
                $this->data['character']        = $this->CRUDModel->dropDown('student_character', 'Select Character', 'char_id', 'char_name');
                $this->data['year']             = $this->CRUDModel->dropDown('student_character', 'Select Character', 'char_id', 'char_name');
                $this->data['blood_group']      = $this->CRUDModel->dropDown('blood_group', 'Blood Group', 'b_group_id', 'title');
                 $this->data['program_std']         = $this->CRUDModel->dropDown_where_in('programes_info', 'Program', 'programe_id', 'programe_name','programe_id',array(1,2,3,4,5,7,16));
                $this->data['admitted']         = $this->CRUDModel->sub_proDropDown('sub_programes', 'Admitted To ', 'sub_pro_id', 'name',array('program_type_id'=>1));
                $ordermarks['column']           = 'marks_order';
                $ordermarks['order']            = 'asc';
                $this->data['totalMarks']       = $this->CRUDModel->dropDown('total_education_marks', 'Select Marks', 'marks', 'marks',array('status'=>1),$ordermarks);
                
                $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Select Sub Program', 'sub_pro_id', 'name',array('programe_id'=>$this->data['result']->programe_id));
                $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>$this->data['result']->programe_id));
                 
                 
                $this->data['student_record']   = $this->GreenfileModel->green_file_student_education_record($where);


                $this->data['page_title']       = 'Update Green File Record | ECMS';
                $this->data['page_header']      = 'Student Education Record';
                $this->data['page']             =  'AdminOffice/GreenFile/Forms/green_file_update_v';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
        }
        
        
    public function greenfile_update_educations(){
       if($this->input->post()):
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $student_id         = $this->input->post('student_id');
            $rollno             = $this->input->post('rollno');
            $year_of_passing    = $this->input->post('year_of_passing');
            $total_marks        = $this->input->post('total_marks');
            $obtained_marks     = $this->input->post('obtained_marks');
            $grade_id           = $this->input->post('grade_id');
            $data       = array(
                'student_id' => $student_id,
                'sub_pro_id' =>$sub_pro_id,
                'rollno' =>$rollno,
                'year_of_passing' =>$year_of_passing,
                'total_marks' =>$total_marks,
                'obtained_marks' =>$obtained_marks,
                'grade_id' =>$grade_id,
            );
      $this->CRUDModel->insert('applicant_edu_detail',$data);
   
         echo true;
      
        endif; 
    } 
    public function greenfile_show_educations(){
            
       if($this->input->post()):
            $student_id = $this->input->post('student_id');
            $result = $this->GreenfileModel->get_grrenfile_education_record(array('student_record.student_id'=>$student_id));
            
//            echo '<pre>';print_R($result);die;
       echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Roll No</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>Passing Year</th>
                            <th>Grade</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                        if($result):
                        foreach($result as $eRow):
                            $sub_programx = '';
                            if($eRow->sub_pro_id == 0):
                                $sub_programx = $eRow->Degreetitle;
                                else:
                                 $sub_programx = $eRow->sub_program;
                            endif;
                            
                            echo '<tr>
                                <td>'.$sub_programx.'</td>
                                <td>'.$eRow->rollno.'</td>
                                <td>'.$eRow->total_marks.'</td>
                                <td>'.$eRow->obtained_marks.'</td>
                                <td>'.$eRow->year_of_passing.'</td>
                                <td>'.$eRow->grade.'</td>
                                <td><button type="button" id="'.$eRow->serial_no.'" class="btn btn-success updateGreenFileEducation" data-toggle="modal" data-target="#updateGreenFile"   >Update</button>                            
                                <button type="button" id="'.$eRow->serial_no.'" class="btn btn-danger deleteGreenFileEducation">Delete</button></td>                            
                           </tr>'; 
                       
                                             
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
                    ?>
                    <script>
                        jQuery(document).ready(function(){
                            
                            jQuery('.deleteGreenFileEducation').on('click',function(){
                                
                                var ser_no = this.id;
                                
                                 if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                                  
                                  jQuery.ajax({
                                      type:'post',
                                      url:'GreenFileDeleteEdu',
                                      data:{'education_id':ser_no},
                                      success:function(result){
                                       alert('Record Delete Successfully....');   
                                       jQuery.ajax({
                                                type     : "POST",
                                                url      : "GreenFileShowEdu",
                                                data     :  {'student_id'   : jQuery('#student_id').val()},
                                                success  : function(result){
                                                jQuery('#acdemicResult').html(result);
                                                }
                                            });
                                      }
                                  });
                                
                            });
                            
                            
                             jQuery('.updateGreenFileEducation').on('click',function(){
                
                                var student_id      = jQuery('#student_id').val();
                                var education_id    = this.id;
                                jQuery.ajax({
                                    type    :'post',
                                    url     :'GreenFileUpdateData',
                                    data     :  {'student_id'   : student_id,'education_id':education_id},
                                    success :function(result){
                                        jQuery('#show_greenfile_std_education').html(result);
                                    }
                                });
                            });
                          
                            
                        });
                    </script>
                        
                        <?php
        endif; 
    } 
    public function green_file_edu_delete(){
        
        $education_id = $this->input->post('education_id');
        
        $this->CRUDModel->deleteid('applicant_edu_detail',array('serial_no'=>$education_id));
        
    }     
    public function green_file_edu_update_data(){
        
        $education_id   = $this->input->post('education_id');
        $student_id     = $this->input->post('student_id');
        $student_details = $this->db->get_where('student_record',array('student_id'=>$student_id))->row();
        $education_details = $this->db->get_where('applicant_edu_detail',array('serial_no'=>$education_id))->row();
//        $where                          = array('student_record.student_id'=>$student_id);
//                $result           = $this->GreenfileModel->greend_file_student_record($where);
                $order['column'] = 'yr_num';
                $order['order'] = 'desc';
                $year_of_passing  = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num','',$order);
                $sub_program      = $this->CRUDModel->dropDown('sub_programes', 'Select Sub Program', 'sub_pro_id', 'name',array('programe_id'=>$student_details->programe_id));
                $program          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>$student_details->programe_id));
                $totalMarks       = $this->CRUDModel->dropDown('total_education_marks', 'Select Marks', 'marks', 'marks',array('status'=>1)); 
                $grade            = $this->CRUDModel->dropDown('grade', 'Select Grade', 'grade_id', 'grade_name');
           
            echo '<form action="adminGallery" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="modal-body">
           <div class="row">
            <div class="col-md-12">';
                    echo '<div class="col-md-4 col-sm-5">
                            <label for="name">Program</label>';
                    echo    form_dropdown('program', $program,'',  'class="form-control"  ');
                    echo '</div>';
                    
                    echo '<div class="col-md-4 col-sm-5">
                            <label for="name">Program</label>';
                    echo    form_dropdown('sub_programes', $sub_program,'',  'class="form-control" id="sub_programesu"');
                    echo '</div>';
                    
                    echo '<div class="col-md-4 col-sm-5">
                            <label for="name">Roll No</label>';
                    echo    '<input type="text" id="rollnou" value="'.$education_details->rollno.'" placeholder="Roll No" class="form-control">';
                    echo '</div>';
                    
                    echo '<div class="col-md-4 col-sm-5">
                            <label for="name">Year Of Passing</label>';
                    echo form_dropdown('year_of_passing', $year_of_passing,$education_details->year_of_passing,  'class="form-control" id="year_of_passingu"');
                    echo '</div>';
                    echo '<div class="col-md-4 col-sm-5">
                            <label for="name">Total Marks</label>';
                    echo form_dropdown('total_marks', $totalMarks,$education_details->total_marks,  'class="form-control" id="total_marksu"');
                    echo '</div>';
                    echo '<div class="col-md-4 col-sm-5">
                            <label for="name">Obtained Marks</label>';
                    echo '<input type="text" id="obtained_marksu" value="'.$education_details->obtained_marks.'" placeholder="Total Marks" class="form-control">';
                    echo '<input type="hidden" id="educatn_id" value="'.$education_id.'" class="form-control">';
                    echo '<input type="hidden" id="student_id" value="'.$student_id.'" class="form-control">';
                    echo '</div>';
                     
                    echo '<div class="col-md-4 col-sm-5">
                            <label for="name">Grade</label>';
                    echo form_dropdown('grade', $grade,$education_details->grade_id,  'class="form-control" id="grade_idu"');
                    
                    echo '</div>';
                    
                        
            echo '</div>
            
          </div>

     
      </div>
      <div class="modal-footer">
            <button type="button" name="saveGreenFileUpdaeEducation" id="saveGreenFileUpdaeEducation" class="btn btn-theme"> <i class="fa fa-plus"></i> Update</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        </form>';
            ?>
                
                    <script>
                        jQuery(document).ready(function(){
                           jQuery('#saveGreenFileUpdaeEducation').on('click',function(){
                
                                
                                var  educatn_id= jQuery('#educatn_id').val();
                                var  sub_programId = jQuery('#sub_programesu').val();
                               if(sub_programId == '')
                                    {
                                       alert('Please select Prorgram name ');
                                       jQuery('#sub_pro_programu').focus();
                                       return false;
                                    }

                               var  rollno = jQuery('#rollnou').val();
                               if(rollno == '')
                                    {
                                       alert('Please select Roll No');
                                       jQuery('#rollnou').focus();
                                       return false;
                                    }

                               var  year_of_passing = jQuery('#year_of_passingu').val();
                               if(year_of_passing == '')
                                    {
                                       alert('Please Enter Passing Year');
                                       jQuery('#year_of_passingu').focus();
                                       return false;
                                    }

                               var  total_marks = parseInt(jQuery('#total_marksu').val());;
                               if(total_marks == '')
                                    {
                                       alert('Please Enter Total Marks');
                                       jQuery('#total_marksu').focus();
                                       return false;
                                    }

                               var  obtained_marks = parseInt(jQuery('#obtained_marksu').val());
                               if(obtained_marks == '')
                                    {
                                       alert('Please Enter Obtained Marks');
                                       jQuery('#obtained_marksu').focus();
                                       return false;
                                    }
                                    if(obtained_marks>total_marks){
                                        alert('Obtained Marks is Not Grater then Total Marks');
                                            jQuery('#obtained_marksu').val('');
                                            jQuery('#obtained_marksu').focus();
                                            return false;
                                    }
                                    if(obtained_marks<0){
                                        alert('Obtained Marks is Not Less then Zero');
                                            jQuery('#obtained_marksu').val('');
                                            jQuery('#obtained_marksu').focus();
                                            return false;
                                    }
                               var  grade_id = jQuery('#grade_idu').val();
                                
                                
                                
                                jQuery.ajax({
                                    type    :'post',
                                    url     :'GreenFileUpdateSave',
                                     data :  {
                                                'education_id'      : educatn_id,
                                                'sub_pro_id'        : sub_programId,
                                                'rollno'            : rollno,
                                                'year_of_passing'   : year_of_passing,
                                                'total_marks'       : total_marks,
                                                'obtained_marks'    : obtained_marks,
                                                'grade_id'          : grade_id
                                            },
                                    success :function(result){
                                            alert('Education Record Update Successfully....');
                                         jQuery.ajax({
                                                type     : "POST",
                                                url      : "GreenFileShowEdu",
                                                data     :  {'student_id'   : jQuery('#student_id').val()},
                                                success  : function(result){
                                                    jQuery('#acdemicResult').html(result);
                                                }
                                              });
                                            jQuery('#updateGreenFile').modal('toggle');
                                    }
                                });
                            });
});                        
                    </script>
                
                <?php
        
    }  
    
       public function green_file_edu_update_save(){
       if($this->input->post()):
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $education_id       = $this->input->post('education_id');
            $rollno             = $this->input->post('rollno');
            $year_of_passing    = $this->input->post('year_of_passing');
            $total_marks        = $this->input->post('total_marks');
            $obtained_marks     = $this->input->post('obtained_marks');
            $grade_id           = $this->input->post('grade_id');
            $data       = array(
                
                'sub_pro_id' =>$sub_pro_id,
                'rollno' =>$rollno,
                'year_of_passing' =>$year_of_passing,
                'total_marks' =>$total_marks,
                'obtained_marks' =>$obtained_marks,
                'grade_id' =>$grade_id,
            );
            $where = array(
                'serial_no'=>$education_id
            );
      $this->CRUDModel->update('applicant_edu_detail',$data,$where);
   
         echo true;
      
        endif; 
    }
  
    
    public function add_green_file_student(){
        
        
         if($this->input->post()):
            $Std_program = $this->db->get_where('sub_programes',array('sub_pro_id'=>$this->input->post('std_admitted_to')))->row();
            $data                   = array(

                'programe_id'       => $Std_program->programe_id,
                'sub_pro_id'        => $this->input->post('std_admitted_to'),
                'batch_id'          => '81',
                's_status_id'       => '9',
                'college_no'        => $this->input->post('college_no'),
                'board_regno'       => $this->input->post('board_regno'),
                'uni_regno'         => $this->input->post('uni_regno'),
                'student_name'      => ucwords(strtolower(ucwords($this->input->post('student_name')))),
                'father_name'       => ucwords(strtolower(ucwords($this->input->post('father_name')))),
                'occ_id'            => $this->input->post('occ_id'),
                'religion_id'       => $this->input->post('religion_id'),
                'domicile_id'       => $this->input->post('domicile_id'),
                'dob'               => date('Y-m-d', strtotime($this->input->post('dob'))),
                'mobile_no'         => $this->input->post('mobile_no'),
                'mobile_no2'        => $this->input->post('mobile_no2'),
                'sports_id'         => $this->input->post('sports_id'),
                'parmanent_address' => $this->input->post('parmanent_address'),
                'app_postal_address'=> $this->input->post('app_postal_address'),
                'student_type'      => $this->input->post('studentType'),
                'guardian_name'     => $this->input->post('guardian'),
                'last_school_address'=> $this->input->post('std_inst_name'),
                'admitted_to'       => $this->input->post('std_admitted_to'),
                'char_id'           => $this->input->post('std_char_id'),
                'admission_date'    => date('Y-m-d', strtotime($this->input->post('admission_date'))),
                'certificate_issue_date'=>date('Y-m-d', strtotime($this->input->post('certificate_issue_date'))),
                'dues_any'          => $this->input->post('dues_any'),
                'remarks'           => $this->input->post('remarks'),
                'remarks2'          => $this->input->post('remarks2'),
                'user_id'           => $this->userInfo->user_id,
                'timestamp'         => date('Y-m-d H:i:s'),
                
            );
                $std_year_of_passing        = $this->input->post('std_year_of_passing');
                $check_year                 = $this->db->get_where('year',array('yr_num'=>$std_year_of_passing))->row();
                if(!empty($std_year_of_passing)):
                     if(empty($check_year)):
                        $this->CRUDModel->insert('year',array(
                        'yr_num'    => $std_year_of_passing,
                        'yr_title'  => $std_year_of_passing,
                        'yr_status' => 0,
                        ));
                    endif;
                endif;
               
            $student_id = $this->CRUDModel->insert('student_record',$data);
                    $pers = '';
                if(!empty($this->input->post('std_obtained_marks')) && !empty($this->input->post('std_obtained_marks'))):
                    $pers = ($this->input->post('std_obtained_marks')/$this->input->post('std_total_marks'))*100;
                  endif;
              
                 $academic_data     = array(
                    'student_id'        => $student_id,
                    'degree_id'         => $this->input->post('std_degree_id'),
                    'inst_id'           => $this->input->post('std_inst_name'),
                    'div_id'            => $this->input->post('std_grade_id'),
                    'year_of_passing'   => $std_year_of_passing,
                    'total_marks'       => $this->input->post('std_total_marks'),
                    'obtained_marks'    => $this->input->post('std_obtained_marks'),
                    'grade_id'          => $this->input->post('std_grade_id'),
                    'rollno'            => $this->input->post('std_rollno'),
                    'percentage'        => $pers,
                    'inserteduser'      => $this->userInfo->user_id
                );
                  $this->CRUDModel->insert('applicant_edu_detail',$academic_data);
                  
                  $education = $this->db->get_where('applicant_edu_detail_demo',array('formCode'=>$this->input->post('formCode')))->result();
                  if($education):
                      foreach($education as $edRow):
                            $academic_edu_in     = array(
                                'student_id'        => $student_id,
                                'degree_id'         => $edRow->degree_id,
                                'sub_pro_id'         => $edRow->sub_pro_id,
                                'inst_id'           => $edRow->inst_id,
                                'year_of_passing'   => $edRow->year_of_passing,
                                'total_marks'       => $edRow->total_marks,
                                'obtained_marks'    => $edRow->obtained_marks,
                                'grade_id'          => $edRow->grade_id,
                                'rollno'            => $edRow->rollno,
                                'updateduser'       => $this->userInfo->user_id
                            );
                  $this->CRUDModel->insert('applicant_edu_detail',$academic_edu_in);
                      endforeach;
                  endif;
                redirect('GreenFileStudent'); 
           endif;
            
//                $where                          = array('student_record.student_id'=>$id);
//                $this->data['result']           = $this->GreenfileModel->greend_file_student_record($where);
//                $this->data['domicile']         = $this->CRUDModel->get_where_result('domicile',array('domicile_id'=>$this->data['result']->domicile_id) ); 

                $order['column']                = 'yr_num';
                $order['order']                 = 'desc';
                $this->data['year_of_passing']  = $this->CRUDModel->dropDown('year', '', 'yr_num', 'yr_num','',$order);
                $this->data['occupation']       = $this->CRUDModel->dropDown('occupation', 'Select occupation', 'occ_id', 'title');
                $this->data['religion']         = $this->CRUDModel->dropDown('religion', 'Select Religion', 'religion_id', 'title');
                $this->data['sports']           = $this->CRUDModel->dropDown('sports', 'Select Sports', 'sports_id', 'sports_name');
                $this->data['degree']           = $this->CRUDModel->dropDown_where_in('degree', 'Select Degree', 'degree_id', 'title','degree_id',array(1,2));
                $this->data['grade']            = $this->CRUDModel->dropDown('grade', 'Select Grade', 'grade_id', 'grade_name');
                $this->data['character']        = $this->CRUDModel->dropDown('student_character', 'Select Character', 'char_id', 'char_name');
                $this->data['year']             = $this->CRUDModel->dropDown('student_character', 'Select Character', 'char_id', 'char_name');
//                $this->data['blood_group']      = $this->CRUDModel->dropDown('blood_group', 'Blood Group', 'b_group_id', 'title');
                $this->data['admitted']         = $this->CRUDModel->sub_proDropDown('sub_programes', 'Admitted To ', 'sub_pro_id', 'name',array('program_type_id'=>1),'programes_info.programe_id',array(1,2,3,4,5,7,16));
                $ordermarks['column']           = 'marks_order';
                $ordermarks['order']            = 'asc';
                $this->data['totalMarks']       = $this->CRUDModel->dropDown('total_education_marks', 'Select Marks', 'marks', 'marks',array('status'=>1),$ordermarks);
                
                $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Select Sub Program', 'sub_pro_id', 'name',array('programe_id'=>1));
                $this->data['program']          = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('program_type_id'=>1));
                $this->data['studentType']      = $this->CRUDModel->dropDown('student_type', '', 'std_type_id', 'title');
                $this->data['page_title']       = 'Add Green File Record | ECMS';
                $this->data['page_header']      = 'Add Green File Record';
                $this->data['page']             =  'AdminOffice/GreenFile/Forms/green_file_add_v';
                $this->load->view('common/common',$this->data);
            
        }    
    public function greenfile_add_educations(){
       if($this->input->post()):
            $sub_pro_id         = $this->input->post('sub_pro_id');
            $student_id         = $this->input->post('student_id');
            $rollno             = $this->input->post('rollno');
            $year_of_passing    = $this->input->post('year_of_passing');
            $total_marks        = $this->input->post('total_marks');
            $obtained_marks     = $this->input->post('obtained_marks');
            $grade_id           = $this->input->post('grade_id');
            $formCode           = $this->input->post('formCode');
            $college_ed         = $this->input->post('college_ed');
            $percentage         = ($obtained_marks/$total_marks)*100;
            $data       = array(
                
                'sub_pro_id'    => $sub_pro_id,
                'formCode'      => $formCode,
                'rollno'        => $rollno,
                'year_of_passing'=>$year_of_passing,
                'total_marks'   => $total_marks,
                'obtained_marks'=> $obtained_marks,
                'grade_id'      => $grade_id,
                'percentage'    => $percentage,
                'inst_id'       => $college_ed,
            );
      $this->CRUDModel->insert('applicant_edu_detail_demo',$data);
   
         echo true;
      
        endif; 
    } 
    public function green_file_edu_delete_add(){
        $education_id = $this->input->post('education_id');
        $this->CRUDModel->deleteid('applicant_edu_detail_demo',array('serial_no'=>$education_id));
    }  
     public function greenfile_show_educations_add(){
//            echo '<pre>';print_R($this->db->get('applicant_edu_detail_demo')->result());
       if($this->input->post()):
            $student_id = $this->input->post('formCode');
            $result = $this->GreenfileModel->get_grrenfile_education_record_add(array('applicant_edu_detail_demo.formCode'=>$student_id));
       echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Roll No</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>Passing Year</th>
                            <th>Grade</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                        if($result):
                        foreach($result as $eRow):
                            $sub_programx = '';
                            if($eRow->sub_pro_id == 0):
                                $sub_programx = $eRow->Degreetitle;
                                else:
                                 $sub_programx = $eRow->sub_program;
                            endif;
                            
                            echo '<tr>
                                <td>'.$sub_programx.'</td>
                                <td>'.$eRow->rollno.'</td>
                                <td>'.$eRow->total_marks.'</td>
                                <td>'.$eRow->obtained_marks.'</td>
                                <td>'.$eRow->year_of_passing.'</td>
                                <td>'.$eRow->grade.'</td>
                                <td><button type="button" id="'.$eRow->serial_no.'" class="btn btn-danger deleteGreenFileEducation">Delete</button></td>                            
                           </tr>'; 
                       
                                             
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
                    ?>
                    <script>
                        jQuery(document).ready(function(){
                            
                            jQuery('.deleteGreenFileEducation').on('click',function(){
                                
                                var ser_no = this.id;
                                
                                 if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                                  
                                  jQuery.ajax({
                                      type:'post',
                                      url:'GreenFileDeleteEduAdd',
                                      data:{'education_id':ser_no},
                                      success:function(result){
                                       alert('Record Delete Successfully....');   
                                       jQuery.ajax({
                                                type     : "POST",
                                                url      : "GreenFileShowEduAdd",
                                                data     :  {'formCode'   : jQuery('#formCode').val()},
                                                success  : function(result){
                                                jQuery('#acdemicResult').html(result);
                                                }
                                            });
                                      }
                                  });
                                
                            });
                         
                          
                            
                        });
                    </script>
                        
                        <?php
        endif; 
    } 
    
}
