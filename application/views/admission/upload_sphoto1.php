<?php
$this->load->helper('form');
$id = $result->student_id;
$student_name = $result->student_name;
$batch_id = $result->batch_id;
$programe_id = $result->programe_id;
$sub_pro_id = $result->sub_pro_id;
$form_no = $result->form_no;
$college_no = $result->college_no;
$rseat_id = $result->rseats_id;
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
            <h4 align="left">Upload Student Picture</h4>
        <div class="row cols-wrapper">
        <div class="col-md-12">
<?php
if($applicant_image == "")
{?>
<img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/students/user.png" width="100" height="100">
<?php
}else
{?>
<img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/students/<?php echo $applicant_image;?>" width="100" height="100">
<?php 
}
?>
            <h4 align="center">Student: <?php echo $student_name;?> S/D of <?php echo $father;?></h4>
        </div>
    </div><br>
            <div class="row cols-wrapper">
                <div style="min-height:400px;" class="col-md-12">
                    <div class="tab-content">
                <form name="student" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/upload_sphoto/<?php echo $id;?>">
Batch Name:<span style="margin-left:290px;">Program: </span><span style="margin-left:300px;">Sub Program: </span><br>
                <?php 
                    $b = $this->db->query("SELECT * FROM prospectus_batch WHERE batch_id='$batch_id'");
                    foreach($b->result() as $brec);
                ?>
                <input style="width:33%; height:30px;" type="text" value="<?php echo $brec->batch_name;?>">
                <?php
                    $p = $this->db->query("SELECT * FROM programes_info WHERE programe_id='$programe_id'");
                    foreach($p->result() as $prec);?>
                <input style="width:33%; height:30px;" type="text" value="<?php echo $prec->programe_name;?>">
                <?php
                    $sp = $this->db->query("SELECT * FROM sub_programes WHERE sub_pro_id='$sub_pro_id'");
                    foreach($sp->result() as $sprec);?>             
                <input style="width:33%; height:30px;" type="text" value="<?php echo $sprec->name;?>"><br><br>
                   <div class="control-group">
                      
                        <label class="control-label" for="basicinput">Upload Picture</label>
                        <div class="controls">
                        <input style="margin-left:300px" type="file" name="photo" data-original-title="" class="span8 tip" required>
                        </div>
                    </div>
                    <div class="control-group">
            <div class="controls">
             <input type="submit" class="submit" name="submit" value="Upload Photo">
            </div>
                    </div>
                    </form>
                    </div>    
           </div>
</div><!--/.container-->
</div><!--/.wrapper-->