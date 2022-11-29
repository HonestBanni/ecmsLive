<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Student Migration <hr></h2>
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
<form method="post">
    
    <div class="form-group col-md-3">
        <label>Student Name</label>
       <input type="text" name="student_id" class="form-control" value="<?php echo $result->student_name;?>">
        <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>">
        <input type="hidden" name="old_status_id" value="<?php echo $result->s_status_id;?>">
   </div>
   <div class="form-group col-md-6">
        <label>Migrated Institute</label>
       <input type="text" name="migrated_institute" class="form-control" placeholder="Migrated Institute Name">
   </div>
   <div class="form-group col-md-3">
        <label>Migrated Board Name</label>
       <input type="text" name="bu_id" class="form-control" placeholder="Board Migration Name" id="bu">
        <input type="hidden" name="bu_id" id="bu_id">
   </div>
    <div class="form-group col-md-3">
        <label>Migration Date</label>
        <input type="text" name="migration_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Student Status:</label>
        <select name="s_status_id" class="form-control">
         <?php 
         $f = $this->db->query("SELECT * FROM student_status WHERE s_status_id=10");
         foreach($f->result() as $row):
         ?>
            <option value="<?php echo $row->s_status_id;?>"><?php echo $row->name;?></option>
         <?php
         endforeach;
         ?>
        </select> 
   </div>
    <div class="form-group col-md-4">
        <input type="submit" style="margin-top:23px;" class="btn btn-theme" name="submit" value="Add Record">
    </div>
    
    </form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           