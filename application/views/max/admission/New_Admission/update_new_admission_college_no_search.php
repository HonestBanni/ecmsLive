        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update College no<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                <h4 style="color:red; text-align:center;">
                    <?php print_r($this->session->flashdata('msg'));?>
                </h4>         
            <form method="post" >
                <div class="form-group col-md-2">
                    <input type="text" name="college_no"  placeholder="College No." value="<?php if($college_no): echo $college_no;endif; ?>" class="form-control">
              </div>
                <div class="form-group col-md-2">
                    <input type="text" name="form_no" value="<?php if($form_no): echo $form_no;endif; ?>"  placeholder="Form No." class="form-control">
              </div>
                <div class="form-group col-md-2">
                    <input type="text" name="student_name" value="<?php if($student_name): echo $student_name;endif; ?>"  placeholder="Student Name" class="form-control">
              </div>
             <div class="form-group col-md-2">
                    <input type="text" name="father_name" value="<?php if($father_name): echo $father_name;endif; ?>" placeholder="Father Name" class="form-control">
              </div>
    <div class="form-group col-md-2">
    <?php 
        echo form_dropdown('gender_id', $gender, $gender_id,  'class="form-control" id="my_id"');
     ?>
     </div>
        <div class="form-group col-md-2">
            <?php
             echo form_dropdown('program', $program, $program_id,  'class="form-control" id="feeProgrameId"');
            ?>
        </div>
        
        <div class="form-group col-md-2">
            <?php
//            $sub_program['Sub Program']    = 'Sub Program';
             echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'class="form-control" id="showFeeSubPro"');
            ?>
        </div>
       <div class="form-group col-md-2">
            <?php
//            $batch['Select Batch']    = 'Select Batch';
             echo form_dropdown('batch', $batch, $batch_id,  'class="form-control" id="batch_id"');
            ?>
        </div>
        <!--<div class="form-group col-md-2">-->
              <?php
//                echo form_dropdown('s_status_id', $status, $s_status_id,  'class="form-control" id="my_id"');
            ?>
          <!--</div>-->        
        <input type="submit" name="search" class="btn btn-theme" value="Search">
                    </form>
                </div>
                <p>&nbsp;</p>
            <p>
            <?php  
                if(@$result):    
            ?>    
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>
             
            </p>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>College #</th>
                            <th>Form #</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>Mobile #</th>
                            <th>Program</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Admission Date</th>
                            <th>Status</th>
                            <th>Edit</th>
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
    $status = $rec->status;    
                        ?>
                        <tr class="gradeA">
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
                <td style="color:red;font-size:16px;"><?php echo $rec->college_no;?></td>
                <td><?php echo $rec->form_no;?></td>
                <td><?php echo $student_name;?></td>
                <td><?php echo $father_name;?></td>
                <td><?php echo $rec->mobile_no;?></td>
                <td><?php echo $rec->program;?></td>
                <td><?php echo $rec->sub_program;?></td>
                <td><?php echo $rec->batch;?></td>
                <td><?php echo date('d-m-Y', strtotime($rec->admission_date));?></td>
                <td>
                    <span class="label label-primary"><?php echo $rec->status;?></span><br>
                    <a href="AdmissionFormDownloadu/<?php echo $student_id;?>" target="_blank"><span class="label label-danger">Admission Form</span></a>
                </td>
                <td>
                    <!--<a href="AdmissionFormDownloadu/<?php echo $student_id;?>"><button class="btn btn-danger btn-sm">Admission Form</button></a>-->
                    <a href="UpdateCollegeNo/<?php echo $student_id;?>"><button class="btn btn-theme btn-sm">Edit</button></a>
                </td>
    </tr>
        <?php
        }
         ?>
            </tbody>
                </table>
                 <?php
                endif;
            ?>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        