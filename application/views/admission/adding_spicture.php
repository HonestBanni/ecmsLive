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
            <h3 align="center">Adding Student Picture<hr></h3>
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
                <form name="student" method="post" enctype="multipart/form-data" action="admin/adding_spicture/<?php echo $id;?>">
                    
                    <div class="form-group col-md-4">
                        <label for="usr">College No.:</label>
                        <?php
                    if(!empty($college_no)):?>
                        <input type="text" name="college_no" value="<?php echo $college_no;?>" class="form-control" readonly> 
                        <?php else: ?>
                        <input type="text" name="college_no" class="form-control" id="checking_college_no" required>
                        <?php endif;?>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Admission Date</label>
                            <input type="text" name="admission_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy" required>
                      </div>
        <div class="form-group col-md-4">
                <label>Shift</label>
            <select name="shift_id" class="form-control" required>
                <?php
            $shift = $this->get_model->get_by_id('shift',array('shift_id'=>$shift_id));
            if($shift){
                foreach($shift as $shiftrec){ ?>                   
        <option type="text" value="<?php echo $shiftrec->shift_id;?>"><?php echo $shiftrec->name;?></option>
             <?php 
                }     
            }?>
                <?php
//                $this->db->order_by('shift_id','desc');
//                $q = $this->db->get("shift")->result();
                $q = $this->CRUDModel->getResults("shift");
                foreach($q as $Srow):
                ?>
                <option value="<?php echo $Srow->shift_id;?>"><?php echo $Srow->name;?></option>
                <?php endforeach;?>
            </select>
        </div>
			  <div class="form-group col-md-4">
                <label>Admission Alotted On</label>
            <select name="rseat_id2" class="form-control" required>
                <?php
            if(!empty($rseat_id2)):    
            $rseat = $this->get_model->get_by_id('reserved_seat',array('rseat_id'=>$rseat_id2));
                foreach($rseat as $rec): ?>                   
        <option type="text" value="<?php echo $rec->rseat_id;?>"><?php echo $rec->name;?></option>
             <?php 
                endforeach;     
                endif;
                ?>
                <option value="">&larr; Select New Seat &rarr;</option>
                <?php
                $q = $this->CRUDModel->getResults("reserved_seat");
                foreach($q as $Srow):
                ?>
                <option value="<?php echo $Srow->rseat_id;?>"><?php echo $Srow->name;?></option>
                <?php endforeach;
                ?>
            </select>
              </div> 
            <div class="form-group col-md-4">
                    <label>Picture</label>
                    <input type="file" name="applicant_image" class="form-control" required>
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
                            <input type="submit" name="submit" value="Add Picture" class="btn btn-theme">
                      </div>
                    </form> 
           </div>
</div><!--/.container-->
</div><!--/.wrapper-->