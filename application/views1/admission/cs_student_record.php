        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <!--<h2 align="left">Students Record (BCS) <span  style="float:right"><a href="admin/add_cs_student" class="btn btn-large btn-primary">Add New Student</a></span><hr></h2>-->
            <h2 align="left">Students Record (BCS) 
                <!--<span  style="float:right"><a href="BSAdmissionForm" class="btn btn-large btn-primary">Add New Student</a></span>-->
                <hr>
            </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4>
                        <span style="margin-right:30px;color:#208e4c"><?php if(@$pages): echo $pages;endif;?></span> 
                    </h4>
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
             echo form_dropdown('rseats_id', $reserved_seat, $rseats_id,  'class="form-control" id="my_id"');                
                            ?>
                      </div>
                    <div class="form-group col-md-2">
                          <?php
             echo form_dropdown('s_status_id', $status, $s_status_id,  'class="form-control" id="my_id"');                
                            ?>
                      </div>
            <input type="submit" name="search" class="btn btn-theme" value="Search">
            <input type="submit" name="export" class="btn btn-theme" value="export">
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
                            <th>Form #</th>
                            <th>College #</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Section</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Add Pic</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$i = 1;
    foreach($result as $rec)  
    {
        $student_id = $rec->student_id;
        $student_name = $rec->student_name;
        $father_name = $rec->father_name;
        $applicant_image = $rec->applicant_image;     
                        ?>
                        <tr class="gradeA">
                            <td><?php 
                $query = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$student_id));
                    if($query){
                        echo '<i>'.$student_id.'</i>';
                    }else{
                        echo '<i style="color:red;">'.$student_id.'</i>';
                    }            
                                
                                ?></td>
                            <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="<?php echo base_url();?>assets/images/students/user.png" width="50" height="40">
                    <?php
                    }else
                    {?>
    <img src="assets/images/students/<?php echo $applicant_image;?>" style="border-radius:3px;" width="50" height="40">
                <?php 
                    }
                    ?></td>
 <td><a href="admin/student_profile/<?php echo $student_id;?>">
     <span style="font-size:15px;"><?php echo $student_name;?></span></a>    
                    </td>
                <td><?php echo $father_name;?></td>
                <td><?php echo $rec->form_no;?></td>
                <td><?php echo $rec->college_no;?></td>
                <td><?php echo $rec->sub_program;?></td>
                <td><?php echo $rec->batch;?></td>
                <td><?php echo $rec->section;?></td>
                <td><span class="btn btn-success btn-sm"><?php echo $rec->status;?></span></td>
    <td><a class="btn btn-primary btn-sm" href="admin/cs_update_student/<?php echo $student_id;?>"><b>Edit</b></a></td>
    <td><a class="btn btn-danger btn-sm" href="admin/upload_bcs_sphoto/<?php echo $student_id;?>"><b>Add Pic</b></a></td>
                            
                    </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           