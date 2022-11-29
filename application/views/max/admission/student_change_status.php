        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Students Change Status<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4>
                        <span style="margin-right:30px;color:#208e4c"><?php if(@$pages): echo $pages; endif;?></span>
                    </h4>
        <form method="post">
            <div class="form-group col-md-2">
                    <input type="text" name="college_no" placeholder="College No." value="<?php if($college_no): echo $college_no;endif; ?>" class="form-control">
              </div>
                <div class="form-group col-md-2">
                    <input type="text" name="student_name" value="<?php if($student_name): echo $student_name;endif; ?>" placeholder="Student Name" class="form-control">
              </div>
                <div class="form-group col-md-2">
                    <input type="text" name="father_name" value="<?php if($father_name): echo $father_name;endif; ?>" placeholder="Father Name" class="form-control">
              </div>
                <div class="form-group col-md-2">
                    <input type="text" name="form_no" value="<?php if($form_no): echo $form_no;endif; ?>" placeholder="Form No." class="form-control">
              </div>    
           <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('program', $program, $programId,  'class="form-control" id="SProgrameId"');
            ?>
          </div>
        <div class="form-group col-md-2">
           <select class="form-control" name="sub_program" id="showingSubPro">
            <option value="">Sub Program</option>  
            </select>
          </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="batch" id="showingbatch_id">
            <option value="">Batch Name</option>  
            </select>
          </div> 
        <div class="form-group col-md-2">
            <select class="form-control" name="s_status_id">
            <option value="">Student Status </option>
            <?php 
            $sb = $this->db->query("SELECT * FROM student_status");
            foreach($sb->result() as $sbrec)
            {
            ?>
                <option value="<?php echo $sbrec->s_status_id;?>"><?php echo $sbrec->name;?></option>
            <?php
            }
            ?>
        </select>
      </div>
     <input type="submit" name="search" class="btn btn-theme" value="Search">
                    </form>
                    </div>
            <?php if(@$count): ?>    
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo $count;?>
            </button>
            </p>
            <?php else: ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
                <?php
                    endif;
                ?>    
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>College #</th>
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
    $student_name = $rec->student_name;
    $father_name = $rec->father_name;
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
                            <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="60">
                    <?php
                    }else
                    {?>
    <img src="<?php echo base_url();?>assets/images/students/<?php echo $applicant_image;?>" style="border-radius:10px;" width="60" height="60">
                <?php 
                    }
                    ?></td>
 <td><a href="<?php echo base_url();?>admin/student_profile/<?php echo $student_id;?>">
     <span style="font-size:15px;"><?php echo $student_name;?></span></a>    
                    </td>
                    <td><?php echo $father_name;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php echo $section;?></td>
            <td>
        <a class="btn btn-primary btn-sm" href="<?php echo base_url();?>admin/update_studentstatus/<?php echo $rec->student_id;?>"><?php echo $rec->status;?></a>
            </td>    
    </tr>
<?php
}
 ?>

                    </tbody>
                </table>
<h4><span style="margin-right:30px;color:#208e4c"><?php if(@$pages): echo $pages; endif;?></span></h4>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           