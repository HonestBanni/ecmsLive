<?php
$this->load->helper('form');
foreach($result as $row);
$id = $row->student_id;
$student_name = $row->student_name;
$batch_id = $row->batch_id;
$programe_id = $row->programe_id;
$sub_pro_id = $row->sub_pro_id;
$form_no = $row->form_no;
$college_no = $row->college_no;
$rseat_id = $row->rseats_id;
$comment = $row->comment;
$gender_id = $row->gender_id;
$student_name = $row->student_name;
$father = $row->father_name;
$adate = $row->admission_date;
$admission_comment = $row->admission_comment;
$s_status_id = $row->s_status_id;
$applicant_image = $row->applicant_image;
?>
 <div class="content container">
               <!-- ******BANNER****** -->
            <h4 align="left">Update Admission Status (HND)</h4>
        <div class="row cols-wrapper">
        <div class="col-md-12">
             <?php
                    if($applicant_image == "")
                    {?>
                    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/students/user.png" width="120" height="70">
                    <?php
                    }else
                    {?>
    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/students/<?php echo $applicant_image;?>" width="120" height="70">
                <?php 
                    }
                    ?>
            <h4 align="center">Student: <?php echo $student_name;?> S/D of <?php echo $father;?></h4>
        </div>
    </div><br>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <form name="student" method="post" enctype="multipart/form-data">       
                        <div class="tab-content">
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
                            Form No:<span style="margin-left:310px;">Reserved Seats: </span><span style="margin-left:255px;">College No: </span><br>
                            <input style="width:33%; height:30px;" type="text" placeholder="Form No. " name="form_no" value="<?php echo $form_no;?>">
                    <?php
                    $rs = $this->db->query("SELECT * FROM reserved_seat WHERE rseat_id='$rseat_id'");
                    foreach($rs->result() as $rsrec);?>             
                <input style="width:33%; height:30px;" type="text" value="<?php echo $rsrec->name;?>">
    <input style="width:33%; height:30px;" type="text" placeholder="College No." name="college_no" value="<?php echo $college_no;?>">                        
                            <br><br>
     Student Status:<span style="margin-left:275px;"> Admission Date: </span><span style="margin-left:275px;"> Admission Comment: </span><br>                    
    <select style="width:33%; height:30px;" type="text" name="s_status_id" required>
                                <?php
                                $b = $this->db->query("SELECT * FROM student_status where s_status_id='$s_status_id'");
                                foreach($b->result() as $brec);?>
                                <option value="<?php echo $brec->s_status_id;?>"><?php echo $brec->name;?></option>
                                <option>&larr; Admission Status &rarr;</option>
                                <?php
                                $b = $this->db->query("SELECT * FROM student_status");
                                foreach($b->result() as $brec)
                                {
                                ?>
                                <option value="<?php echo $brec->s_status_id;?>"><?php echo $brec->name;?></option>
                                <?php 
                                }
                                ?>
    </select>
    <input style="width:33%; height:30px;" type="date" value="<?php echo $adate;?>"  name="admission_date" required>
<input style="width:33%; height:30px;" type="text" value="<?php echo $admission_comment;?>"  name="admission_comment">                            
                            
                            <br><br>

                            <input type="submit" class="btn btn-primary" name="submit" value="Update Status">
                        </div>
                        </div>
                    </form> 
               
</div><!--/.span9-->
</div>
</div><!--/.container-->
</div><!--/.wrapper-->