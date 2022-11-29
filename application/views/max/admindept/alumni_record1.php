        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Students<span  style="float:right"><a href="<?php echo base_url();?>AdminDeptController/add_alumni" class="btn btn-theme">Add Alumni Student</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">
                    <h4>
                        <span style="margin-right:30px;color:#208e4c"><?php echo $pages;?></span> 
                        <span style="margin-left:120px; color:#208e4c">Total Records: <?php echo $count;?> </span>
                    </h4>
                    <form method="post" action="AdminDeptController/search_student">
                        <input style="width:70px" type="text" name="college_no" placeholder="College No.">
                        <input type="text" name="student_name"  placeholder="Student Name">
                        <input type="text" name="father_name" placeholder="Father Name">
                        <select style="height:27px;" name="programe_id" id="alumiProgrameId">
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
                        <select style="height:27px;" name="sub_pro_id" id="showAlumiSubPro">
                            <option value="">Select Program</option>
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
                        <input type="submit" name="submit" value="Search">
                    </form>
                    <br>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Status</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$i = 1;
foreach($result as $rec)  
{
    $batch_id = $rec->batch_id;
    $s_status_id = $rec->s_status_id;
    $sub_pro_id = $rec->sub_pro_id;
     $student_id = $rec->student_id;             
     $applicant_image = $rec->applicant_image;  
     $b = $this->db->query("SELECT * FROM prospectus_batch WHERE batch_id='$batch_id'");
    $p = $this->db->query("SELECT * FROM student_status WHERE s_status_id='$s_status_id'");
    $sp = $this->db->query("SELECT * FROM sub_programes WHERE sub_pro_id='$sub_pro_id'");
    $sed = $this->db->query("SELECT * FROM applicant_edu_detail WHERE student_id='$student_id'");
    foreach($sed->result() as $sedrec);                     
    foreach($b->result() as $brec);                     
    foreach($b->result() as $brec);                     
    foreach($p->result() as $prec);                     
    foreach($sp->result() as $sprec); 
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
                            <td><a href="<?php echo base_url();?>AdminDeptController/alumni_student_profile/<?php echo $rec->student_id;?>" style="text-transform:capitalize;"><?php echo $rec->student_name;?></a>    
                    </td>
                    <td style="text-transform:capitalize;"><?php echo $rec->father_name;?></td>
                            <td><?php echo $sprec->name;?></td>
                            <td><?php echo $brec->batch_name;?></td>
                            <td><?php echo $prec->name;?></td>
    <td><a href="<?php echo base_url();?>AdminDeptController/update_alumni_student/<?php echo $rec->student_id;?>"><b>Edit</b></a></td>
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->