<?php

$id = $result->student_id;
$student_name = $result->student_name;
$batch_id = $result->batch_id;
$shift_id = $result->shift_id;
$programe_id = $result->programe_id;
$sub_pro_id = $result->sub_pro_id;
$form_no = $result->form_no;
$college_no = $result->college_no;
$rseat_id = $result->rseats_id;
$rseat_id2 = $result->rseats_id2;
$comment = $result->comment;
$gender_id = $result->gender_id;
$student_name = $result->student_name;
$father = $result->father_name;
$adate = $result->admission_date;
$s_status_id = $result->s_status_id;
$applicant_image = $result->applicant_image;
?>
<div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="center">Upload Student Picture<hr></h3>
        <div class="row cols-wrapper">
            
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable">
                <strong style="font-size:16px;">
                    <span style="margin-right:30px;">Student: <?php echo $student_name;?>,</span>
                    <span style="margin-right:30px;">Father: <?php echo $father;?>,</span>
                    <span style="margin-right:30px;">Form #: <?php echo $result->form_no;?>,</span>
                    <span style="margin-right:30px;">Class #: <?php echo $result->name;?></span>
                </strong>
            </div>
            </div>
        
    </div><br>
            <div class="row cols-wrapper">
                <div style="min-height:400px;" class="col-md-12">
                <form name="student" method="post" enctype="multipart/form-data" action="UploadPictureUpdate">
                     
             
             
            <div class="form-group col-md-4">
                    <label>Picture:</label>
                    <input type="file" name="applicant_image" class="form-control" required="required">
                    <input type="hidden" name="student_id" value="<?php echo $this->uri->segment(2)?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                    <?php
                    if($applicant_image == "")
                    {?>
                    <img style="float:right; border-radius:10px;" src="assets/images/students/user.png" width="80" height="70">
                    <?php
                    }else
                    {?>
                    <img style="float:right; border-radius:10px;" src="assets/images/students/<?php echo $applicant_image;?>" width="80" height="70">
                    <?php 
                    }
                    ?>   
            </div>    
                    
                    <div class="form-group col-md-8">
                        <!--<button type="submit" name="UploadPicture" value="UploadPicture" class="btn btn-theme">Upload Picture</button>-->
                            <input type="submit" name="UploadPicture" value="Upload" class="btn btn-theme">
                      </div>
                    </form> 
           </div>
</div><!--/.container-->
</div><!--/.wrapper-->