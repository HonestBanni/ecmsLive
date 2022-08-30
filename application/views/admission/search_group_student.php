        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
   <h3 align="left">All Students<hr></h3>          
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">
                    
                    <h4><span style="margin-right:0px;"><?php // echo $pages;?></span> <span style="margin-left:0px; color:#208e4c">Total Records: <?php echo count($result);?> </span></h4>
                    <form method="post" action="admin/search_group_student">
        <?php 
        echo form_dropdown('batch_id', $batch, $batch_id,  'style="height:27px;" id="my_id"');
                        
        echo form_dropdown('programe_id', $program, $programe_id,  'style="height:27px;" id="my_id"');
       
        echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'style="height:27px;" id="my_id"');
 
        ?>
        <input style="width:100px;" type="text" name="limit" value="<?php if($limit): echo $limit;endif; ?>" placeholder="Limit e.g 40 ">                 
        <input type="submit" name="search" value="Search">               
                    </form>
                    <br>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="sec_id"></th>
                            <th>PK</th>
                            <th>Picture</th>
                            <th width="110">Student Name</th>
                            <th width="110">F-Name</th>
                            <th width="110">Sub Program</th>
                            <th>Batch</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
foreach($result as $rec)  
{
    $student_id = $rec->student_id;
    $applicant_image = $rec->applicant_image;               
                        ?>
                        <tr class="gradeA">
                            <td><input type="checkbox" name="sec_id"></td>
                            <td><?php 
                $query = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$student_id));
                    if($query){
                        echo '<i>'.$student_id.'</i>';
                    }else{
                        echo '<i style="color:red;">'.$student_id.'</i>';
                    }            
                                
                                ?></td>
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
                            <td><a href="<?php echo base_url();?>admin/student_profile/<?php echo $rec->student_id;?>" style="text-transform:capitalize;"><?php echo $rec->student_name;?></a>    
                    </td>
                    <td style="text-transform:capitalize;"><?php echo $rec->father_name;?></td>
                            <td><?php echo $rec->sub_program;?></td>
                            <td><?php echo $rec->batch;?></td>
                    <td><a href="<?php echo base_url();?>admin/update_studentstatus/<?php echo $rec->student_id;?>"><?php echo $rec->student_status;?></a></td>
    <td><a href="<?php echo base_url();?>admin/update_student/<?php echo $rec->student_id;?>"><b>Edit</b></a></td>
    <td><a href="<?php echo base_url();?>admin/upload_sphoto/<?php echo $rec->student_id;?>"><b>Add Pic</b></a></td>
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->