        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Practical Group Allottment <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <form method="post" action="AttendanceController/practical_group_allottment">
                        <div class="form-group col-md-2">
                            <input type="text" name="college_no" value="<?php if($college_no): echo $college_no;endif; ?>" placeholder="College No." class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="student_name" value="<?php if($student_name): echo $student_name;endif; ?>" placeholder="Student Name" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="father_name" value="<?php if($father_name): echo $father_name;endif; ?>" placeholder="Father Name" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                        <select class="form-control">
                            <option value="">Select</option>
                                <?php 
                        foreach($practStudents as $sbrec)
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
            </div>    
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <?php 
                    if(@$result): ?>
                   <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
                    <?php 
                    else:
                    echo "";
                    endif;
                    ?>
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Picture</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>College No</th>
                            <th>Sub Program</th>
                            <th>Program</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Edit</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if(@$result):    
                    $i = 1;   
                    foreach($result as $rec)  
                    {
                        $student_id = $rec->student_id;
                        ?>
        <tr class="gradeA">
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
            <td><?php echo $rec->student_name;?></td> 
            <td><?php echo $rec->father_name;?></td> 
            <td><?php echo $rec->college_no;?></td>
            <td><?php echo $rec->name;?></td>
            <td><?php echo $rec->programe_name;?></td>
            <td>
<?php 
$query = $this->CRUDModel->get_where_row('student_prac_group_allottment',array('student_id'=>$student_id));
    if($query)
    { 
    ?>
<a class="btn btn-primary btn-sm" href="<?php echo base_url();?>AttendanceController/update_assign_practical_groups/<?php echo $student_id;?>/<?php echo $rec->sub_pro_id;?>">Update Groups</a>      
    <?php
    }
    else{
        ?>
   <a class="btn btn-success btn-sm" href="<?php echo base_url();?>AttendanceController/assign_practical_groups/<?php echo $student_id;?>/<?php echo $rec->sub_pro_id;?>">Assign Groups</a>
<?php
    }            
    ?>  </td>          
        </tr>
                        <?php
                        $i++;
                        }
                    else:
                echo '<h3 class="has-divider text-highlight"></h3>';
                    endif;    
                        ?>


                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   