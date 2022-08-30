        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
   <h3 align="left">All Students <hr></h3>          
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">
                    
                    <h4><span style="margin-right:0px;"><?php // echo $pages;?></span> <span style="margin-left:0px; color:#208e4c">Total Records: <?php echo count($result);?> </span></h4>
                    <form method="post" action="admin/search_adding_picture_student">
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
                     echo form_dropdown('programe_id', $program, $programe_id,  'class="form-control" id="my_id"');
                    ?>
                </select>
                      </div>        
                <div class="form-group col-md-2">
                    <?php
                     echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'class="form-control" id="my_id"');
                    ?>
                </select>
                        </div>
                        <div class="form-group col-md-2">
                          <?php
             echo form_dropdown('rseats_id', $reserved_seat, $rseats_id,  'class="form-control" id="my_id"');                
                            ?>
                      </div>
                    <div class="form-group col-md-2">
                          <?php
             echo form_dropdown('limit',$limit,$limitId, 'class="form-control" id="my_id"');                
                            ?>
                      </div>
                        <input type="submit" name="search" class="btn btn-theme" value="Search">
                        <input type="submit" name="export" class="btn btn-theme" value="export">                
                    </form>
                    <br>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Picture</th>
                            <th width="110">Student Name</th>
                            <th width="110">F-Name</th>
                            <th width="110">College No.</th>
                            <th width="110">Program</th>
                            <th width="110">Sub Program</th>
                            <th>Batch</th>
                            <th>Status</th>
                            <th><i class="icon-plus" style="color:#fff"></i><b> Add Pic</b></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
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
                            <td><a href="<?php echo base_url();?>admin/student_profile/<?php echo $rec->student_id;?>" style="text-transform:capitalize;"><?php echo $rec->student_name;?></a>    
                    </td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->program;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php echo $rec->student_status;?></td>
    <td><a class="btn btn-danger btn-sm" href="admin/new_upload_sphoto/<?php echo $rec->student_id;?>"><b>Add Picture</b></a></td>
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->