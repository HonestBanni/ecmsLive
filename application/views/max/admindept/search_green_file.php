        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
   <h3 align="left">Search Students Record<hr></h3>          
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">
                    
                    <h4><span style="margin-right:0px;"><?php // echo $pages;?></span> <span style="margin-left:0px; color:#208e4c">Total Records: <?php echo count($result);?> </span></h4>
                    <form method="post" action="Admin/search_green_file_student">
            <div class="form-group col-md-2">
    <input type="text" name="college_no" class="form-control" value="<?php if($college_no): echo $college_no;endif; ?>">    
                        </div>      
            <div class="form-group col-md-2">
    <input type="text" name="student_name" class="form-control"  value="<?php if($student_name): echo $student_name;endif; ?>" >    
                        </div>
                        <div class="form-group col-md-2">
    <input type="text" name="father_name" class="form-control" value="<?php if($father_name): echo $father_name;endif; ?>">    
                        </div>            
           <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'class="form-control"');
            ?>    
          </div>
       <input type="submit" name="submit" class="btn btn-theme" value="Search">             
                    </form>
                    <br>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Student Name</th>
                            <th>F-Name</th>
                            <th>College No.</th>
                            <th>Sub Program</th>
                            <th>Status</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
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
                            <td><?php 
                $query = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$student_id));
                    if($query){
                        echo '<i>'.$student_id.'</i>';
                    }else{
                        echo '<i style="color:red;">'.$student_id.'</i>';
                    }            
                                
                                ?></td>
    
                            <td><a href="<?php echo base_url();?>admin/student_profile/<?php echo $rec->student_id;?>" style="text-transform:capitalize;"><?php echo $rec->student_name;?></a>    
                    </td>
                    <td style="text-transform:capitalize;"><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->college_no;?></td>
                            <td><?php echo $rec->sub_program;?></td>
                            <td><?php echo $rec->student_status;?></td>
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