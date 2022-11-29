 			 <!-- ******CONTENT****** --> 
    <div class="content container">
               <!-- ******BANNER****** -->
        <h2 align="left">Update Room <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
            <br />
                <form class="form-horizontal row-fluid" method="post">
            <div class="form-group name">
                <label for="name">Room Name</label>
                    <input style="width:50%;" type="text" class="form-control" name="rm_name" value="<?php echo $result->rm_name;?>">
                    <input type="hidden" value="<?php echo $result->rm_id?>" name="rm_id">
                    <input type="hidden" value="<?php echo $result->rm_name?>" name="log_rm_name">
            </div>
            <div class="form-group name">
                <label for="name">Room Short Name</label>
                    <input style="width:50%;" type="text" class="form-control" name="rm_shortname" value="<?php echo $result->rm_shortname;?>">
                    <input type="hidden" value="<?php echo $result->rm_shortname?>" name="log_rm_shortname">
            </div>
            <div class="form-group name">
                <label for="name">Block Name</label>
                <input type="hidden" value="<?php echo $result->bb_id?>" name="log_rm_bbId">
                    <select style="width:50%;" class="form-control" name="rm_bbId">
                    <option value="<?php echo $result->bb_id;?>"><?php echo $result->bb_name;?></option>
                        <option value="">Select Block Name</option>
                    <?php
                    $col = $this->db->query("SELECT * FROM invt_building_block");
                    foreach($col->result() as $row){
                    ?>
                        <option value="<?php echo $row->bb_id;?>"><?php echo $row->bb_name;?></option>
                    <?php
                    }
                    ?>
                </select>    
            </div>
                    
            <div class="form-group name">
                <label for="name">Total Seats : </label>
                    <input style="width:50%;" type="text" class="form-control" name="rm_total_seats" value="<?php echo $result->rm_total_seats;?>">
                    <input type="hidden" value="<?php echo $result->rm_total_seats?>" name="log_rm_total_seats">
            </div>
            <div class="form-group name">
                <label for="name">Total Area</label>
                    <input style="width:50%;" type="text" class="form-control" name="room_total_area" value="<?php echo $result->room_total_area;?>">
                    <input type="hidden" value="<?php echo $result->room_total_area?>" name="log_room_total_area">
            </div>
            <div class="form-group name">
                <label for="name">Comments</label>
                    <input style="width:50%;" type="text" class="form-control" name="rm_comments" value="<?php echo $result->rm_comments;?>">
                    <input type="hidden" value="<?php echo $result->rm_comments?>" name="log_rm_comments">
                    <input type="hidden" value="<?php echo date('d-m-Y H:i:s', strtotime($result->rm_timestamp));?>" name="log_timestamp">
                    <input type="hidden" value="<?php echo $result->rm_userId?>" name="log_user_id">
            </div>
                    <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
                </form>
	</div><!--//col-md-3-->
                
    </div><!--//cols-wrapper-->
           
         