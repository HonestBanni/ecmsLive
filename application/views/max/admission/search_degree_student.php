        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
    <h3 align="left">All Students (Degree Level)<span  style="float:right"><a href="<?php echo base_url();?>admin/add_degree_student" class="btn btn-large btn-primary">Add New Student</a></span><hr></h3>        
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <form method="post" action="admin/search_degree_student">
                <div class="form-group col-md-2">
                                <input type="text" name="college_no"  value="<?php if($college_no): echo $college_no;endif; ?>"   placeholder="college no" class="form-control"> 
                       </div>
                        <div class="form-group col-md-2">
                                <input type="text" name="form_no" value="<?php if($form_no): echo $form_no;endif; ?>" placeholder="Form No." class="form-control"> 
                       </div>
                        <div class="form-group col-md-2">
                                <input type="text" name="student_name" value="<?php if($student_name): echo $student_name;endif; ?>" placeholder="Student Name" class="form-control"> 
                       </div>
                        <div class="form-group col-md-2">
                                <input type="text" name="father_name" value="<?php if($father_name): echo $father_name;endif; ?>" placeholder="Father Name" class="form-control"> 
                       </div>
                       <div class="form-group col-md-2">
                       <?php
                           echo form_dropdown('gender_id', $gender, $gender_id, 'class="form-control"');
                           ?>
                       </div>
                        <div class="form-group col-md-2">
                       <?php
                          echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id, 'class="form-control"');
                           ?>
                       </div>
                        <div class="form-group col-md-2">
                       <?php
                          echo form_dropdown('rseats_id', $reserved_seat, $rseats_id, 'class="form-control"');
                           ?>
                       </div>
                        <div class="form-group col-md-2">
                       <?php
                          echo form_dropdown('s_status_id', $status, $s_status_id, 'class="form-control"');
                           ?>
                       </div>  
                       
            <input type="submit" name="search" value="Search" class="btn btn-theme">
            <input type="submit" name="export" value="export" class="btn btn-theme">
            </form>
                    </div>
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
                            <th>College #</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Status</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
                            <th><i class="icon-plus" style="color:#fff"></i><b> Add Pic</b></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$i = 1;
foreach($result as $rec)  
{
    $student_id = $rec->student_id;
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
                            <td><a href="<?php echo base_url();?>admin/degree_student_profile/<?php echo $rec->student_id;?>" style="text-transform:capitalize;"><?php echo $rec->student_name;?></a>    
                    </td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->college_no;?></td>
                            <td><?php echo $rec->sub_program;?></td>
                            <td><?php echo $rec->batch;?></td>
                            
                            <td><?php echo $rec->student_status;?></td>
    <td><a class="btn btn-primary btn-sm" href="<?php echo base_url();?>admin/update_degree_student/<?php echo $rec->student_id;?>"><b>Edit</b></a></td>
    <td><a class="btn btn-danger btn-sm" href="<?php echo base_url();?>admin/upload_degree_sphoto/<?php echo $rec->student_id;?>"><b>Add Pic</b></a></td>
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->