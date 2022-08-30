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
$s_status_id = $result->s_status_id;
$applicant_image = $result->applicant_image;
    $date = $result->admission_date;
    if($date === '0000-00-00'){
        $date = '';
        } else {
        $date = date("d-m-Y", strtotime($date));
        }
?>
<div class="content container">
            <h4 align="left">Upload Student Picture</h4>
        <div class="row cols-wrapper">
        <div class="col-md-12">
<?php
if($applicant_image == "")
{?>
<img style="float:right; border-radius:10px;" src="assets/images/students/user.png" width="100" height="100">
<?php
}else
{?>
<img style="float:right; border-radius:10px;" src="assets/images/students/<?php echo $applicant_image;?>" width="100" height="100">
<?php 
}
?>
    <h4 align="center">Student: <?php echo $student_name;?> S/D of <?php echo $father;?></h4>
        </div>
    </div><br>
            <div class="row cols-wrapper">
                <div style="min-height:400px;" class="col-md-12">
                <form method="post" enctype="multipart/form-data" action="admin/upload_law_sphoto/<?php echo $id;?>">
                    
                <?php 
                    $b = $this->db->query("SELECT * FROM prospectus_batch WHERE batch_id='$batch_id'");
                    foreach($b->result() as $brec);
                ?>
                <div class="form-group col-md-4">
                    <label>Batch Name</label>
                    <input type="text" value="<?php echo $brec->batch_name;?>" class="form-control">
              </div>    
                <?php
                    $p = $this->db->query("SELECT * FROM programes_info WHERE programe_id='$programe_id'");
                    foreach($p->result() as $prec);?>
                    <div class="form-group col-md-4">
                    <label>Program Name</label>
                    <input type="text" value="<?php echo $prec->programe_name;?>" class="form-control">
                    </div>
                <?php
                    $sp = $this->db->query("SELECT * FROM sub_programes WHERE sub_pro_id='$sub_pro_id'");
                    foreach($sp->result() as $sprec);?>  
                    <div class="form-group col-md-4">
                    <label>Sub Program</label>
                    <input type="text" value="<?php echo $sprec->name;?>" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Picture</label>
                            <input type="file" name="applicant_image" class="form-control">
                      </div>
                    <div class="form-group col-md-4">
                        <label>College Number</label>
                            <input type="text" name="college_no" id="checking_college_no"  placeholder="College No." value="<?php if($college_no): echo $college_no; endif;?>" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Admission Date</label>
                            <input type="text" name="admission_date" value="<?php if($date): echo $date; endif;?>" class="form-control date_format_d_m_yy">
                      </div>
                  
            
            <div class="form-group col-md-12">
                    <input type="submit" name="submit" value="Upload Photo" class="btn btn-theme">
            </div>
            </form> 
           </div>
</div><!--/.container-->
</div><!--/.wrapper-->