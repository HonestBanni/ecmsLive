        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <!--<h2 align="left"><?php echo $title;?><span  style="float:right"><a href="admin/add_edsml_student_record" class="btn btn-large btn-primary">Add New Student</a></span><hr></h2>-->
            <h2 align="left">
                <?php echo $title;?>
                <!--<span  style="float:right"><a href="BSAdmissionForm" class="btn btn-large btn-primary">Add New Student</a></span>-->
                <hr>
            </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4>
            <span style="margin-right:30px;color:#208e4c"><?php if(@$pages): echo $pages; endif;?></span> 
                    </h4>
                    <form method="post">
                         <div class="form-group col-md-2">
                             <input type="text" name="college_no" value="<?php echo $college_no;?>"  placeholder="college no" class="form-control"> 
                       </div>
                        <div class="form-group col-md-2">
                                <input type="text" name="form_no" value="<?php echo $form_no?>" placeholder="Form No." class="form-control"> 
                       </div>
                        <div class="form-group col-md-2">
                                <input type="text" name="student_name" value="<?php echo $student_name;?>" placeholder="Student Name" class="form-control"> 
                       </div>
                        <div class="form-group col-md-2">
                                <input type="text" name="father_name" value="<?php echo $father_name;?>" placeholder="Father Name" class="form-control"> 
                       </div>
                       <div class="form-group col-md-2">
                          <?php 
                                //$slctdCategory = (isset($product->category) ? $product->category : '');
                                echo form_dropdown('gender_id', $gender, $gender_id,  'class="form-control" ');
                            ?> 
                            
                       </div>
                        <div class="form-group col-md-2">
                <?php 
                    //$slctdCategory = (isset($product->category) ? $product->category : '');
                    echo form_dropdown('program', $program, $programId,  'class="form-control" id="alumiProgrameId" required="required"');
                ?>
              </div>
              <!--//form-group-->
              <div class="form-group col-md-2">
                <?php 
                echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" id="showAlumiSubPro"');
                ?>
              </div>
              <div class="form-group col-md-2">
                <?php 
                echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="my_id"');
                ?>
              </div>   
                <div class="form-group col-md-2">
                <select name="rseats_id" class="form-control">
                    <option value="">Reserved Seat</option>
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
                <div class="form-group col-md-2">
                       <?php 
                        echo form_dropdown('s_status_id', $student_status, $s_status_id,  'class="form-control" ');
                    ?> 
                </div>        
                <input type="submit" name="search" value="Search" class="btn btn-theme">
                <input type="submit" name="export" value="Export" class="btn btn-theme">
                    </form>
                </div>
                <p>
            <button type="button" class="btn btn-success">
        <i class="fa fa-check-circle"></i>Total Records: <?php if(@$result): echo count($result); endif;?>
            </button>       
            </p>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>Form #</th>
                            <th>College #</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Section</th>
                            <th>Status</th>
                            <th>Download</th>
                            <th>Update</th>
                            <!--<th>Add Pic</th>-->
                        </tr>
                    </thead>
                    <tbody>
<?php
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
        <img src="<?php echo base_url();?>assets/images/students/user.png" width="50" height="40">
                    <?php
                    }else
                    {?>
    <img src="assets/images/students/<?php echo $applicant_image;?>" style="border-radius:3px;" width="50" height="40">
                <?php 
                    }
                    ?></td>
 <td><a href="admin/student_profile/<?php echo $student_id;?>">
     <span style="font-size:15px;"><?php echo $student_name;?></span></a>    
                    </td>
                    <td><?php echo $father_name;?></td>
                    <td><?php echo $rec->form_no;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php echo $section;?></td>
                    <td><span class="btn btn-success btn-sm"><?php echo $rec->status;?></span></td>
                    <td><a class="btn btn-primary btn-sm" href="AdmissionFormDownloadu/<?php echo $rec->student_id;?>"><b>Download</b></a></td>
    <td><a class="btn btn-primary btn-sm" href="admin/update_edsml_student_record/<?php echo $rec->student_id;?>"><b>Edit</b></a></td>
    
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           