<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Room<hr></h2>
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
<form method="post" action="HostelController/add_room">
    <div class="form-group col-md-4">
            <label for="usr">Room Name:</label>
            <input type="text" name="room_name" class="form-control"> 
   </div>
<div class="form-group col-md-4">
    <label for="usr">Block Name:</label>
     <select name="block_id" class="form-control">
         <option value="">Select Block</option>
         <?php 
         $f = $this->db->query("SELECT * FROM hostel_blocks");
         foreach($f->result() as $row):
         ?>
            <option value="<?php echo $row->block_id;?>"><?php echo $row->block_name;?></option>
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
           