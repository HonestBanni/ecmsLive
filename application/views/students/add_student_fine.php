<div class="grid-form">
    <div class="grid-form1">
 		<h2 id="forms-example" class="">Add Student Fine</h2>
 		<form method="post">
           <div class="form-group col-md-4">
            <label>Student Name</label>
            <input type="text" name="student_id" class="form-control" placeholder="Student Name" id="std_record">
            <input type="hidden" name="student_id" id="student_id">
           </div>
            <div class="form-group col-md-4">
            <label>Fine Type</label>
            <select class="form-control" name="proc_type_id">
                <option value="">Select Fine Type</option>
                <?php
                    $f = $this->db->query("SELECT * FROM proctorial_fine_type"); 
                foreach($f->result() as $rec):
                ?>
                <option value="<?php echo $rec->proc_type_id;?>"><?php echo $rec->proc_type_title;?></option>
                <?php endforeach;?>
            </select>
          </div>
            <div class="form-group col-md-4">
            <label>Date</label>
            <input type="text" name="date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy">
          </div>
         <div class="form-group col-md-12">
            <label>Recovered Assets</label>
            <input type="text" name="recover_assets" class="form-control" placeholder="Recovered Assets">
          </div>
         <div class="form-group col-md-12">
            <label>Remarks</label>
            <input type="text" name="remarks" class="form-control" placeholder="Remarks">
          </div>
		<div class="row">
			<div class="col-sm-8 col-offset-2">
				<input type="submit" name="submit" class="btn-primary btn">
			</div>
	 </div>        
</form>
    </div>
</div>    