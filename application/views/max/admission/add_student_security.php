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
<form method="post" action="admin/add_student_security/<?php echo $student_id;?>">
    
    <input type="hidden" value="<?php echo $student_id;?>" name="student_id"> 
    <div class="form-group col-md-4">
            <label for="usr">Student Name:</label>
            <input type="text" value="<?php echo $student->student_name;?>" class="form-control" readonly> 
    </div>
    <div class="form-group col-md-4">
            <label for="usr">Father Name:</label>
            <input type="text" value="<?php echo $student->father_name;?>" class="form-control" readonly> 
    </div>
    <div class="form-group col-md-4">
            <label for="usr">College No:</label>
            <input type="text" value="<?php echo $student->college_no;?>" class="form-control" readonly> 
    </div>
    
    <div class="form-group col-md-2">
            <label for="usr">General Security:</label>
            <input type="text" name="general_security" class="form-control"> 
    </div>
    <div class="form-group col-md-2">
            <label for="usr">Hostel Security:</label>
            <input type="text" name="hostel_security" class="form-control"> 
    </div>
    <div class="form-group col-md-2">
            <label for="usr">Exam Fee:</label>
            <input type="text" name="exam_fee" class="form-control"> 
    </div>
    <div class="form-group col-md-2">
            <label for="usr">Fines:</label>
            <input type="text" name="fines" class="form-control"> 
    </div>
    <div class="form-group col-md-2">
            <label for="usr">Others:</label>
            <input type="text" name="others" class="form-control"> 
    </div>
    <div class="form-group col-md-2">
            <label for="usr">Date:</label>
            <input type="text" name="date" value="<?php echo date('d-m-Y')?>" class="form-control date_format_d_m_yy"> 
    </div>
    <div class="form-group col-md-12">
            <label for="usr">Remarks:</label>
            <input type="text" name="comments" class="form-control"> 
    </div>
    <div class="form-group col-md-6">
        <input type="submit" class="btn btn-theme" name="submit" value="Add Security">
    </div>
    
    </form>
    
    </div>        
       
							 </div><!--//col-md-3-->
                
           