 <?php
// error_reporting(0);
 ?>
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
                                             
        
        
      <div class="row">
           <?php echo form_open('',array('class'=>'course-finder-form')); ?>
          <div class="col-md-12">
              
                                    
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                               <div class="col-md-3">
                                    <label for="name">Form#</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'form_no',
                                                'id'            => 'form_no',
                                                'value'         => $form_no,
                                                'placeholder'   => 'Enter Form No',
                                                'class'         => 'form-control',
                                                ));
                                         
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Student Name</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'student_name',
                                                'id'            => 'student_name',
                                                'value'         => $student_name,
                                                'placeholder'   => 'Enter Student Name',
                                                'class'         => 'form-control',
                                                ));
                                           
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Father Name</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'value'         => $father_name,
                                                'placeholder'   => 'Father Name',
                                                'class'         => 'form-control',
                                                ));
                                           
                                         ?>
                                    </div>
                              
                                <div class="col-md-2 pull-right">
                                    <label for="name" style="visibility: hidden">Studen asdsda</label>
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                    </div>
                             </div>       
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
           <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                     
                                        
                                        if(!empty($result)): ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Result: <?php echo  count($result)?> </h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                           
                                                          <th>Form No</th>
                                                          <th>Name</th>
                                                          <th>Gender</th>
                                                          <th>Father Name</th>
                                                          <th>Sub Program</th>
                                                          <th>Shift</th>
                                                          <th>Reserved Seat</th>
                                                          <th>9th Marks</th>
                                                          <th>Status</th>
                                                          <th>Challan</th>
                                                         
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
//                                                      echo '<pre>';print_r($result); 
                                                        $sn='';
                                                          foreach($result as $row):
                                                              
                                                              
                                                                          $this->db->order_by('serial_no','desc'); 
                                                                          $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id');  
                                                              $ss_marks = $this->db->get_where('applicant_edu_detail',array('student_id'=>$row->student_id))->row();
                                                              $ssMarks  = '';
                                                              if(isset($ss_marks->obtained_marks) && !empty($ss_marks->obtained_marks)):
                                                                  $ssMarks = $ss_marks->obtained_marks.' ( '.$ss_marks->title.' )';
                                                              endif;
                                                              
                                                              $challan_checking = $this->CRUDModel->get_where_row('fee_challan',array('fc_student_id'=>$row->student_id));
                                                              $chkFee           = $this->db->get_where('prospectus_challan',array('student_id'=>$row->student_id))->row();
                                                              $wher_chk = array(
                                                                  'program'     => $row->programe_id,
                                                                  'sub_program' => $row->sub_pro_id,
                                                                  'shift'       => $row->shift_id,
                                                                  'gender'      => $row->gender_id,
                                                                  'status'      => '1',
                                                                );
                                                              $check_marks = $this->db->get_where('merit_list_conditions',$wher_chk)->row();
//                                                              echo '<pre>';print_r($check_marks);
                                                                
//                                                               
                                                                
                                                               echo '<tr>
                                                                        <td>'.$row->form_no.'</td>
                                                                        <td>'.$row->student_name.'</td>
                                                                        <td>'.$row->GenderName.'</td>
                                                                        <td>'.$row->father_name.'</td>
                                                                        <td>'.$row->name.'</td>
                                                                        <td>'.$row->ShiftName.'</td>
                                                                        <td>'.$row->Seat_name.'</td>
                                                                        <td>'.$ssMarks.'</td>
                                                                        <td><button type="button" class="btn btn-success btn-xs">'.$row->student_status.'</button></td>
                                                                    ';
                                                              
                                                              
                                                               
                                                                if(isset($check_marks) && !empty($check_marks)): //Merti List checking students if
                                                                    if($ss_marks->obtained_marks >= $check_marks->start && $ss_marks->obtained_marks <= $check_marks->end): //Check Marks wise Condition
  //                                                                  echo 'show';

                                                                        if(empty($challan_checking)):
                                                                         
                                                                              echo '<td><a href="Fee/Admission/Challan/Generate/'.$row->student_id.'"  class="productstatus"><button type="button" class="btn btn-info btn-xs"> Generate Challan </button></a> &nbsp;&nbsp;&nbsp;';
                                                                        else:
                                                                             echo    '<td><a href="feeChallanPrintAdmission/'.$challan_checking->fc_challan_id.'/'.$row->student_id.'"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"><i class="fa fa-print"></i> Print </button></a></td>';
                                                                         endif;
                                                                    else:
                                                                        echo '<td>Waiting list</td>';
                                                                    endif;
                                                                else: //Merti List checking students else:
                                                                    echo '<td>Merit not define</td>';
                                                                endif; //Merti List checking students if end
                                                                
                                                                
                                                                echo '</tr>';
                                                            endforeach;      
                                                
                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
                                          
                                      endif;
                                    ?> 
                                    </div>
                                        
                                    </div>
                                  
                                </div>
                             
                    <?php
                                    echo form_close();
                                    ?>                 
                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
 
   
  
 