<?php
		$this->load->helper('form');
		
		?>

				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Student Security<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;">
            <?php print_r($this->session->flashdata('insert_msg'));?>
        </h4>
        <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
        </h4>
									</div>
<br />
<form method="post" action="admin/update_student_security/<?php echo $security_id;?>">
    
    <input type="hidden" value="<?php echo $security_id;?>" name="security_id"> 
    <div class="form-group col-md-2">
            <label for="usr">General Security:</label>
            <input type="text" name="general_security" value="<?php echo $security->general_security;?>" class="form-control"> 
    </div>
    <div class="form-group col-md-2">
            <label for="usr">Hostel Security:</label>
            <input type="text" name="hostel_security" value="<?php echo $security->hostel_security;?>" class="form-control"> 
    </div>
    <div class="form-group col-md-2">
            <label for="usr">exam Fee:</label>
            <input type="text" name="exam_fee" value="<?php echo $security->exam_fee;?>" class="form-control"> 
    </div>
    <div class="form-group col-md-2">
            <label for="usr">Fines:</label>
            <input type="text" name="fines" value="<?php echo $security->fines;?>" class="form-control"> 
    </div>
    <div class="form-group col-md-2">
            <label for="usr">Others:</label>
            <input type="text" name="others" value="<?php echo $security->others;?>" class="form-control"> 
    </div>

    <div class="form-group col-md-2">
            <label for="usr">Date:</label>
        <?php
            $date = $security->date;
            $newDate = date("d-m-Y", strtotime($date));?>
            <input type="text" name="date" value="<?php echo $newDate;?>" class="form-control date_format_d_m_yy"> 
    </div>
    <div class="form-group col-md-12">
            <label for="usr">Remarks:</label>
            <input type="text" name="comments" value="<?php echo $security->comments;?>" class="form-control"> 
    </div>
    <div class="form-group col-md-6">
        <input type="submit" class="btn btn-theme" name="submit" value="Update Security">
    </div>
    
    </form>
    
    </div>        
        
							 </div><!--//col-md-3-->
                
           