        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">A-Level Subjects Allottment<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <form method="post">
                      <div class="form-group col-md-2">
                            <input type="text" name="college_no"  placeholder="College No." class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="student_name"  placeholder="Student Name" class="form-control">
                      </div>
                      <div class="form-group col-md-2">
                            <input type="text" name="father_name"  placeholder="Father Name" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <select class="form-control" name="sub_pro_id">
                            <option value="">Select Program</option> 
                        <?php        
                        foreach($a_level_Students as $sbrec)
                            {
                            ?>
            <option value="<?php echo $sbrec->sub_pro_id;?>"><?php echo $sbrec->name;?></option>
                            <?php
                            }
                            ?>
                        </select>
                      </div>
                        <input type="submit" name="search" class="btn btn-theme" value="Search">
                    </form>
                </div>
                <?php if(@$result):?>
                <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>
            </p>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>College #</th>
                            <th>Sub Program</th>
                            <th>Section</th>
                            <th>Batch</th>
                            <th>Assign Subjects</th>
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
                            <td><?php echo $student_id; ?></td>
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
 <td><span style="font-size:15px;"><?php echo $student_name;?></span>  
                    </td>
                    <td><?php echo $father_name;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $section;?></td>    
                    <td><?php echo $rec->batch;?></td>          
<td>
<?php 
$query = $this->CRUDModel->get_where_row('student_subject_alloted',array('student_id'=>$student_id));
    if($query)
    { 
    ?>
<a class="btn btn-success btn-sm" href="<?php echo base_url();?>admin/a_level_updassign_subjects/<?php echo $student_id;?>/<?php echo $rec->sub_pro_id;?>">Update Subjects</a>      
    <?php
    }
    else{
        ?>
   <a class="btn btn-primary btn-sm" href="<?php echo base_url();?>admin/a_level_assign_subjects/<?php echo $student_id;?>/<?php echo $rec->sub_pro_id;?>">Assign Subjects</a>
<?php
    }            
    ?>    </td>
    </tr>
<?php
}
 ?>         </tbody>
                </table>
<h4><span style="margin-right:30px;color:#208e4c"><?php endif;?></span></h4>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
     