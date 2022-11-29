      <style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style>
          <div class="content container">
        	<div class="page-wrapper">
            <header class="page-heading clearfix">
                  <h1 class="heading-title pull-left">Update Students Attendance</h1>
                </header>
            </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
             <h4><strong>Teacher: <?php echo $empRecord->emp_name;?>, Section: <?php echo $section->name;?>   
                    </strong>
                    </h4>
                    <p>
                    <span class="badge badge-warning">Attendance Date: <?php echo $attend->attendance_date; ?></span>
                    <span class="badge badge-success">Present-<?php echo $present; ?></span>
                    <span class="badge badge-primary">Leave-<?php echo $leave; ?></span>
                    <span class="badge badge-danger">Absent-<?php echo $Absent; ?></span>
                    </p>
                    <form name="std" method="post" action="AttendanceController/update_studentsAtts">   
              <input type="hidden" name="attend_id" value="<?php echo $attend->attend_id;?>">
              <input type="hidden" name="sec_id" value="<?php echo $section->sec_id;?>">
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>S/No</th>
                            <th>Student Picture</th>
                            <th>College No</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $s = 1;    
            foreach($result as $resRow): 
                $status = $resRow->status;        
            ?>
            <tr>            
            <td>
            <?php if($resRow->status == 1):?>    
            <input type="checkbox" name="checked[]" value="<?php echo $resRow->student_id; ?>" id="checkItem" checked>
            <input type="hidden" name="student_id">
            <?php else: ?>
            <input type="checkbox" name="checked[]" value="<?php echo $resRow->student_id;?>" id="checkItem">
            <input type="hidden" name="student_id" id="student_id">
            <?php endif;?>
            </td>           
            <td><?php echo $s; ?></td>
            <td><img src="assets/images/students/<?php echo $resRow->applicant_image; ?>" width="60" height="40"></td>
            <td><?php echo $resRow->college_no; ?></td>
            <td><?php echo $resRow->student_name; ?></td>
            <td><?php echo $resRow->father_name; ?></td>
            <td>
                <?php 
                        if($status == 1)
                        {
                            echo '<p><span class="label label-success">Present</span></p>';
                        }
                        elseif($status == 2)
                        {
                            echo '<p><span class="label label-info"> Leave </span></p>';
                        }
                        else
                        {    
                            echo '<p><span class="label label-danger">Absent</span></p>';
                        }
                ?>
            </td> 
          </tr>
            <?php
                $s++;
                endforeach;
                ?>
            </tbody>
        </table>
        <div class="form-group col-md-2">
            <input type="submit" name="submit" value="Submit" class="btn btn-theme">
        </div>
        </form>            
        </div><!--//col-md-3-->        
        </div><!--//cols-wrapper-->   
        </div><!--//content-->
   