        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Admin Student Flag Change<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
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
            <?php if(@$result): ?>    
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>College #</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Flag</th>
                            <th>Section</th>
                            <th>Flag Change</th>
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
                    <td><?php echo $student_name;?></td>
                    <td><?php echo $father_name;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php echo $rec->flag;?></td>
        <td><?php echo $section;?></td>
        <td>
            <a class="btn btn-primary btn-sm" href="admin/update_flag/<?php echo $rec->student_id;?>">Update Flag</a>
        </td>    
    </tr>
<?php
}
    endif;
            
 ?>

                    </tbody>
                </table>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           