        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Students Record<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4>
                        <span style="margin-right:30px;color:#208e4c"><?php echo $pages;?></span>
                    </h4>
                    <form method="post" action="HostelController/search_enrolled_student">
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
                            <?php 
                                echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="feeProgrameId"');
                            ?>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <?php 
                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                            ?>
                      </div>  
                        
                        <div class="form-group col-md-2">
                            <?php  
                                echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="batch_id"');
                            ?>
                      </div>
                        
                    <div class="form-group col-md-2">
                        <?php 
                            echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');    
                         ?>
                    </div>
                        
                    <div class="form-group col-md-2">
                        <?php 
                            echo form_dropdown('shift', $shift,$shft_id,  'class="form-control"');    
                         ?>
                    </div>
                        
               <div class="form-group col-md-2">
                    <select class="form-control" name="gender_id">
                    <option value="">Select Gender</option>
                    <?php 
                    $g = $this->CRUDModel->getResults('gender');
                    foreach($g as $grec)
                    {
                    ?>
                        <option value="<?php echo $grec->gender_id;?>"><?php echo $grec->title;?></option>
                    <?php
                    }
                    ?>
                </select>
              </div>
                        
<!--        <div class="form-group col-md-2">        
            
            <?php 
               // echo form_dropdown('status', $s_status, $st_status_id,  'class="form-control"');    
             ?>
            
          </div>-->
                        
        <div class="form-group col-md-2">        
            
            <?php 
                echo form_dropdown('admission_in', $seat, $seat_id,  'class="form-control"');    
             ?>
            
          </div>
                        
        <div class="form-group col-md-2" style="float:right;">
        <input type="submit" name="search" class="btn btn-theme" value="Search">
        </div>
                    </form>
                    </div>
                    <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo $count;?>
            </button>
            </p>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>Form #</th>
                            <th>College #</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Section</th>
                            <!--<th>Status</th>-->
                            <th></th>
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
                            <td><?php echo $i; ?></td>
                            <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="40">
                    <?php
                    }else
                    {?>
    <img src="<?php echo base_url();?>assets/images/students/<?php echo $applicant_image;?>"  width="60" height="40">
                <?php 
                    }
                    ?></td>
        <td>
            <span style="font-size:15px;"><a href="admin/student_profile/<?php echo $student_id;?>"><?php echo $student_name;?></a></span>    
        </td>
        <td><?php echo $father_name;?></td>
        <td><?php echo $rec->form_no;?></td>
        <td><?php echo $rec->college_no;?></td>
        <td><?php echo $rec->sub_program;?></td>
        <td><?php echo $rec->batch;?></td>
        <td><?php echo $section;?></td>
        <!--<td><span class="label label-success"><?php echo $rec->status;?></span></td>-->
        <?php 
        $hostel_info = $this->CRUDModel->get_where_row('hostel_student_record', array('student_id' => $rec->student_id));
        if(empty($hostel_info)):
            echo '<td><a class="btn btn-theme btn-sm" href="HostelNewRecordAdminFee/'.$rec->student_id.'"><b>Add Hostel</b></a></td>';
        else:
            echo '<td>Hostel already added</td>';
        endif;
        ?>
    </tr>
<?php
$i++;        
}
 ?>

                    </tbody>
                </table>
<h4><span style="margin-right:30px;color:#208e4c"><?php echo $pages;?></span></h4>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           