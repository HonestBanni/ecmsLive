        <!-- ******CONTENT****** --> 
        <div class="content container">
            
               <!-- ******BANNER****** -->
             <h2 align="left"><?php if($page_title): echo $page_title; endif;?><hr></h2>
             
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     
                    <form method="post">
                        <div class="form-group col-md-2">
                            <input type="text" name="college_no"  placeholder="College No." value="<?php if($college_no): echo $college_no;endif; ?>" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="form_no" value="<?php if($form_no): echo $form_no;endif; ?>"  placeholder="Form No." class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="student_name" value="<?php if($student_name): echo $student_name;endif; ?>"  placeholder="Student Name" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="father_name" value="<?php if($father_name): echo $father_name;endif; ?>" placeholder="Father Name" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="board_regno" value="<?php if($boardregno): echo $boardregno;endif; ?>" placeholder="Board Reg No" class="form-control">
                      </div>
                      <div class="form-group col-md-2">
                            <?php 
                            echo form_dropdown('gender_id', $gender, $gender_id,  'class="form-control" id="my_id"');
                          ?>
                      </div>
                <div class="form-group col-md-2">
                    <?php
                     echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'class="form-control" id="my_id"');
                    ?>
                      </div>
                        
                    <div class="form-group col-md-2">
                        <?php 
                        echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="my_id"');
                        ?>
                    </div>
                        
                    <div class="form-group col-md-2">
                        <?php 
                        echo form_dropdown('shift', $shift, $shft_id,  'class="form-control"');
                        ?>
                    </div>
                        
                        <div class="form-group col-md-2">
                          <?php
                            echo form_dropdown('rseats_id', $reserved_seat, $rseats_id,  'class="form-control" id="my_id"');                
                            ?>
                      </div>
                    <div class="form-group col-md-2">
                          <?php
                            echo form_dropdown('s_status_id', $status, $s_status_id,  'class="form-control" id="my_id"');                
                            ?>
                      </div>
            <input type="submit" name="search" class="btn btn-theme" value="Search">
            <input type="submit" name="export" class="btn btn-theme" value="Export">
        </form>
                </div>    
                    <p>
                        
           <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: 
                <?php if(@$count): echo $count; else: echo count($result);endif;?>
            </button>
            </p>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>Reg No</th>
                            <th>DoB</th>
                            <th>Form #</th>
                            <th>College #</th>
                            <th>Hostel</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Section</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
<?php
$i = 1;
    foreach($result as $rec)  
    {
        
    $student_id = $rec->student_id;
    $subProgram_id = $rec->sub_id;
    $student_name = $rec->student_name;
    $father_name = $rec->father_name;
    $applicant_image = $rec->applicant_image;           
    $section = $rec->section;
    $status = $rec->status;    
    ?>
    <tr class="gradeA">
        <td><?php 
    $query = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$student_id));
    $query1 = $this->CRUDModel->get_where_row('student_grades',array('student_id'=>$student_id));
        if($query){
            echo '<i>'.$student_id.'</i>';
        }elseif($query1){
            echo '<i>'.$student_id.'</i>';
        }
        else{
            echo '<i style="color:red;">'.$student_id.'</i>';
        }            
        ?></td>
                            <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="assets/images/students/user.png" width="50" height="40">
                    <?php
                    }else
                    {?>
    <img src="assets/images/students/<?php echo $applicant_image;?>" style="border-radius:3px;" width="50" height="40">
                <?php 
                    }
                    ?></td>
 <td><a href="admin/student_profile/<?php echo $student_id;?>"><span style="font-size:15px;"><?php echo $student_name;?></span></a>    
                    </td>
                <td><?php echo $father_name;?></td>
                <td><?php echo $rec->board_regno;?></td>
                <td><?php if(!empty($rec->dob)): echo date('d-m-Y',strtotime($rec->dob)); endif;?></td>
                <td><?php echo $rec->form_no;?></td>
                <td><?php echo $rec->college_no;?></td>
                <td>
                    <?php
                            $this->db->join('hostel_status','hostel_status.hostel_status_id=hostel_student_record.hostel_status_id','left outer');
                    $host = $this->db->get_where('hostel_student_record', array('hostel_student_record.student_id'=>$student_id,'hostel_student_record.hostel_status_id'=>1))->row();
                    if(!empty($host)):
                        echo '<strong style="color:green;">Yes</strong>';
                    else:
                        echo '<strong style="color:red;">No</strong>';
                    endif;
                    ?>
                </td>
                <td><?php echo $rec->sub_program;?></td>
                <td><?php echo $rec->batch;?></td>
                <td><?php echo $section;?></td>            
                <td><span class="btn btn-success btn-sm"><?php echo $rec->status;?></span></td>
                
     
    </tr>
<?php
}
 ?>

                    </tbody>
                </table>
<h4><span style="margin-right:30px;color:#208e4c"><?php if(@$pages): echo $pages;endif;?></span></h4>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        