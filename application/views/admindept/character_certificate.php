        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
   <h3 align="left">Character Certificates Record<hr></h3>          
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
                    <?php
                     echo form_dropdown('batch', $batch, $batchId,  'class="form-control"');
                    ?>
                </div>        
                <div class="form-group col-md-2">
                    <?php
                     echo form_dropdown('programe_id', $program, $programe_id,  'class="form-control" id="my_id"');
                    ?>
                </div>        
                <div class="form-group col-md-2">
                    <?php
                     echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'class="form-control" id="my_id"');
                    ?>
                </div> 
                <div class="form-group col-md-2">
                    <?php
                     echo form_dropdown('status', $status, $statusId,  'class="form-control"');
                    ?>
                </div>
                <div class="form-group col-md-2">
                            <?php 
        echo form_dropdown('gender_id', $gender, $gender_id,  'class="form-control" id="my_id"');
                          ?>
                </div>        
                
                <input type="submit" name="search" class="btn btn-theme" value="Search">
            </form>
        </div>
    <?php if(@$result):?>
         <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
        <thead>
            <tr>
                <th>PK</th>
                <th>Picture</th>
                <th>Student Name</th>
                <th>F-Name</th>
                <th>College No.</th>
                <th>Program</th>
                <th>Sub Program</th>
                <th>Batch</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
<?php
foreach($result as $rec)  
{
    $student_id = $rec->student_id;
    $applicant_image = $rec->applicant_image;         
        $section = $rec->section;                           
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
                            <td>
                            <?php
                    if($applicant_image == "")
                 {?>
        <img src="<?php echo base_url();?>assets/images/students/user.png" width="80" height="80">
                    <?php
                    }else
                    {?>
  <img src="<?php echo base_url();?>assets/images/students/<?php echo $rec->applicant_image;?>" style="border-radius:10px;" width="80" height="80">
                <?php 
                   }
                    ?>
</td>
                            <td><a href="<?php echo base_url();?>admin/student_profile/<?php echo $rec->student_id;?>" style="text-transform:capitalize;"><?php echo $rec->student_name;?></a>    
                    </td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->program;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php echo $rec->student_status;?></td>
    
            <?php 
    $query = $this->CRUDModel->get_where_row('student_character_issued',array('student_id'=>$rec->student_id));
    if($query):?>                
    <!--<td><a class="btn btn-primary btn-sm disabled">Update</a></td>-->
                    <td><a class="btn btn-primary btn-sm" href="AdminDeptController/update_student_certficate/<?php echo $rec->student_id;?>">Update</a></td>
    <?php else:?>
     <td><a class="btn btn-primary btn-sm" href="AdminDeptController/update_student_certficate/<?php echo $rec->student_id;?>">Update</a></td>
    <?php endif;?>                        
                        </tr>
<?php
}
            endif;
            ?>
    
       
            </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           