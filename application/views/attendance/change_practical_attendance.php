<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style>
        <div class="content container">
        	<div class="page-wrapper">
            <header class="page-heading clearfix">
                  <h1 class="heading-title pull-left">Change Students Practical Attendance</h1>
                </header>
            </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
             <h4><strong>Teacher: <?php echo $empRecord->emp_name;?>, Section: <?php echo $section->group_name;?>   
                    </strong>
                    </h4>
                    <p>
                    <span class="badge badge-warning">Attendance Date: <?php echo $attend->attendance_date; ?></span>
                    <span class="badge badge-success">Present-<?php echo $present; ?></span>
                    <span class="badge badge-danger">Absent-<?php echo $Absent;?></span>
                    <span class="badge badge-primary">Total-<?php echo count($result);?></span>
                    </p>
            <form method="post" action="AttendanceController/update_practical_studentsAtts">
              <input type="hidden" name="attend_id" value="<?php echo $attend->attend_id;?>">
              <input type="hidden" name="group_id" value="<?php echo $section->prac_group_id;?>">        
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>S/No</th>
                            <th>Student Name</th>
                            <th>College No</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                    foreach($result as $rec)  
                    {
                        $status = $rec->status;
                        ?>
            <tr class="gradeA">
                <td>
                <?php if($rec->status == 1):?>    
                <input type="checkbox" name="checked[]" value="<?php echo $rec->college_no; ?>" id="checkItem" checked>
                <input type="hidden" name="college_no">
                <?php else: ?>
                <input type="checkbox" name="checked[]" value="<?php echo $rec->college_no;?>" id="checkItem">
                <input type="hidden" name="college_no" id="college_no">
                <?php endif;?>
                </td> 
                <td  style="font-size: 15px;"><?php echo $i;?></td>
                <td  style="font-size: 15px;"><?php echo $rec->student_name;?></td>
                <td><?php echo $rec->college_no;?></td>
                <td>
                <?php 
                    if($status == 1)
                    {
                        echo '<span class="label label-success">Present</span>';
                    }
                    else
                    {    
                        echo '<span class="label label-danger">Absent</span>';   
                    }
            ?>
            </td>         
            </tr>

                        <?php
                        $i++;
                        }
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
   