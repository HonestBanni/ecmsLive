        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
   <h3 align="left">Year Head Comment<hr></h3>          
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">
                    
                    <h4><span style="margin-right:0px;"><?php // echo $pages;?></span> <span style="margin-left:0px; color:#208e4c">Total Records: <?php echo count($result);?> </span></h4>
                    <form method="post" action="admin/search_year_head_student">
                        <div class="form-group col-md-2">
                            <input type="text" name="college_no"  placeholder="College No." value="<?php if($college_no): echo $college_no;endif; ?>" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="student_name" value="<?php if($student_name): echo $student_name;endif; ?>"  placeholder="Student Name" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="father_name" value="<?php if($father_name): echo $father_name;endif; ?>" placeholder="Father Name" class="form-control">
                      </div>
                <div class="form-group col-md-2">
                            <select class="form-control" name="sub_pro_id">
                            <option value="">Select Program</option>
                            <?php 
                        foreach($artStudents as $sbrec)
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
                    <br>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Picture</th>
                            <th width="110">Student Name</th>
                            <th width="110">F-Name</th>
                            <th width="110">College No.</th>
                            <th width="110">Sub Program</th>
                            <th>Batch</th>
                            <th>Section</th>
                            <th>Edit</th>
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
                            <td><?php echo $student_id; ?></td>
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
                            <td><a href="<?php echo base_url();?>admin/student_profile/<?php echo $rec->student_id;?>"><?php echo $rec->student_name;?></a>    
                    </td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php echo $section;?></td> 
                            
<td><a href="<?php echo base_url();?>admin/year_head_edit_student/<?php echo $student_id;?>">Edit</a> 
</td> 
    </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->