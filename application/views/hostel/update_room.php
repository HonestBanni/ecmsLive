 			 <!-- ******CONTENT****** --> 
    <div class="content container">
               <!-- ******BANNER****** -->
        <h2 align="left">Update Room <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
            <br />
        <form method="post" action="HostelController/update_room/<?php echo $result->room_id;?>">
        <div class="form-group col-md-3">
            <label for="usr">Room Name:</label>
    <input type="text" class="form-control" name="room_name" value="<?php echo $result->room_name;?>">
    <input type="hidden" value="<?php echo $result->room_id;?>" name="room_id">
        </div>
        <div class="form-group col-md-3">
            <label for="name">Floor Name</label>
            <select name="block_id" class="form-control">
        <option value="<?php echo $result->block_id;?>"><?php echo $result->block_name;?></option>
         <option value="">Select New Block</option>
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
        <input type="submit" style="margin-top:23px;" name="submit" value="Update Room" class="btn btn-theme">
                </form>
	</div><!--//col-md-3-->          
    </div><!--//cols-wrapper-->
           
         