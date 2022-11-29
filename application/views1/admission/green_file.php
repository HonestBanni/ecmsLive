        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Green File<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">
                    <h4>
                        <span style="margin-right:30px;color:#208e4c"><?php echo $pages;?></span> 
                        <span style="margin-left:120px; color:#208e4c">Total Records: <?php echo $count;?> </span>
                    </h4>
                     <form method="post" action="admin/search_green_file_student">
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
                            <option value="">Sub Program</option>
                            <?php 
                            $sb = $this->db->query("SELECT * FROM sub_programes");
                            foreach($sb->result() as $sbrec)
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
                            <th width="110">Student</th>
                            <th width="110">F-Name</th>
                            <th width="80">College #</th>
                            <th width="110">Sub Program</th>
                            <th>Batch</th>
                            <th>Status</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
                            <th><i class="icon-print"></i><b> Print</b></th>
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
        <img src="assets/images/students/user.png" width="50" height="40">
                    <?php
                    }else
                    {?>
    <img src="assets/images/students/<?php echo $applicant_image;?>" style="border-radius:10px;" width="50" height="40">
                <?php 
                    }
                    ?></td>
 <td><a href="<?php echo base_url();?>admin/student_profile/<?php echo $student_id;?>"><?php echo $student_name;?></a>    
                    </td>
                    <td><?php echo $father_name;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                            <td><span class="label label-success btn-sm"><?php echo $rec->status;?></span></td>
    <td><a class="btn btn-primary btn-sm" href="admin/update_green_file/<?php echo $rec->student_id;?>"><i class="fa fa-edit"></i>  <b>Edit</b></a></td>
                            <td><a class="btn btn-theme btn-sm" href="AdminDeptController/print_green_file/<?php echo $rec->student_id;?>"><i class="fa fa-print"></i> <b>Print</b></a></td>        
    </tr>
<?php
}
 ?>

                    </tbody>
                </table>
<h4><span style="margin-right:30px;color:#208e4c"><?php echo $pages;?></span></h4>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->