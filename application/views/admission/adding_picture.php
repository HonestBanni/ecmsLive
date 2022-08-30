        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Students<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4>
                        <span style="margin-right:30px;color:#208e4c"><?php echo $pages;?></span> 
                    </h4>
                    <form method="post" action="admin/search_adding_picture_student">
                        <div class="form-group col-md-2">
                            <input type="text" name="college_no"  placeholder="College No." class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="form_no"  placeholder="Form No." class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="student_name"  placeholder="Student Name" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="father_name"  placeholder="Father Name" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <select class="form-control" name="programe_id">
                            <option value="">Select Program</option>
                            <?php 
                            $sb = $this->db->query("SELECT * FROM programes_info");
                            foreach($sb->result() as $sbrec)
                            {
                            ?>
                                <option value="<?php echo $sbrec->programe_id;?>"><?php echo $sbrec->programe_name;?></option>
                            <?php
                            }
                            ?>
                        </select>
                      </div>
                        <div class="form-group col-md-2">
                            <select class="form-control" name="gender_id">
                            <option value="">Select Gender</option>
                            <?php 
                            $sb = $this->db->query("SELECT * FROM gender");
                            foreach($sb->result() as $sbrec)
                            {
                            ?>
                                <option value="<?php echo $sbrec->gender_id;?>"><?php echo $sbrec->title;?></option>
                            <?php
                            }
                            ?>
                        </select>
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
                        <div class="form-group col-md-2">
                            <select class="form-control" name="rseats_id">
                            <option value="">Select Quota</option>
                            <?php 
                            $rs = $this->db->query("SELECT * FROM reserved_seat");
                            foreach($rs->result() as $rsrec)
                            {
                            ?>
                                <option value="<?php echo $rsrec->rseat_id;?>"><?php echo $rsrec->name;?></option>
                            <?php
                            }
                            ?>
                        </select>
                      </div>
                        <input type="submit" name="search" class="btn btn-theme" value="Search">
                    </form>
                    </div>
                    <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo $count;?>
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
                            <th>Batch</th>
                            <th>Section</th>
                            <th>Status</th>
                            <th><i class="icon-plus" style="color:#fff"></i><b> Add Pic</b></th>
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
                    <td><?php 
                    if($section == '')
                    {
                        echo '';
                    }else
                    {?>
                    <?php echo $section;?>   
                <?php 
                    }
                    ?><br>
                    <td><?php echo $rec->status;?><br>
    <td><a class="btn btn-danger btn-sm" href="<?php echo base_url();?>admin/new_upload_sphoto/<?php echo $rec->student_id;?>"><b>Add Picture</b></a></td>
    </tr>
<?php
}
 ?>

                    </tbody>
                </table>
<h4><span style="margin-right:30px;color:#208e4c"><?php echo $pages;?></span></h4>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           