 			 <!-- ******CONTENT****** --> 
    <div class="content container">
               <!-- ******BANNER****** -->
        <h2 align="left">Update Block <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
            <br />
                <form class="form-horizontal row-fluid" method="post">
            <div class="form-group name">
                <label for="name">Block Name</label>
                    <input style="width:50%;" type="text" class="form-control" name="bb_name" value="<?php echo $result->bb_name;?>">
                    <input type="hidden" value="<?php echo $result->bb_name?>" name="log_bb_name">
                    <input type="hidden" value="<?php echo $result->bb_id?>" name="bb_id">
            </div>
            <div class="form-group name">
                <label for="name">Block Short Name</label>
                    <input style="width:50%;" type="text" class="form-control" name="bb_shortname" value="<?php echo $result->bb_shortname;?>">
                    <input type="hidden" name="log_bb_shortname" value="<?php echo $result->bb_shortname;?>">
            </div>
            <div class="form-group name">
                <label for="name">No of total rooms: </label>
                    <input style="width:50%;" type="text" class="form-control" name="no_of_rooms" value="<?php echo $result->no_of_rooms;?>">
                  
            </div>
            <div class="form-group name">
                <label for="name">No of total seats: </label>
                    
                <input style="width:50%;" type="text" name="total_seats" value="<?php echo $result->total_seats;?>" id="bb_shortname" placeholder="Total Seats" class="form-control">
                 
            </div>
                 
            <div class="form-group name">
                <label for="name">Plot Name</label>
                    <input type="hidden" name="log_plot_id" value="<?php echo $result->plot_id;?>">
                    <select style="width:50%;" class="form-control" name="plot_id">
                    <option value="<?php echo $result->plot_id;?>"><?php echo $result->plot_name;?></option>
                        <option value="">Select Plot Name</option>
                    <?php
                    $col = $this->db->query("SELECT * FROM invt_plot_area");
                    foreach($col->result() as $row){
                    ?>
                        <option value="<?php echo $row->plot_id;?>"><?php echo $row->plot_name;?></option>
                    <?php
                    }
                    ?>    
                </select>    
            </div>
            <div class="form-group name">
                <label for="name">Total Area</label>
                <input style="width:50%;" type="text" class="form-control" name="total_area" value="<?php echo $result->total_area;?>">
                <input type="hidden" name="log_total_area" value="<?php echo $result->total_area;?>">
            </div>
            <div class="form-group name">
                <label for="name">Covered Area</label>
                    <input style="width:50%;" type="text" class="form-control" name="cover_area" value="<?php echo $result->cover_area;?>">
                    <input type="hidden" name="log_cover_area" value="<?php echo $result->cover_area;?>">
            </div>
            <div class="form-group name">
                <label for="name">Uncovered Area</label>
                    <input style="width:50%;" type="text" class="form-control" name="remaining_area" value="<?php echo $result->remaining_area;?>">
                    <input type="hidden" name="log_remaining_area" value="<?php echo $result->remaining_area;?>">
            </div>
            <div class="form-group name">
                <label for="name">Comments</label>
                    <input style="width:50%;" type="text" class="form-control" name="comments" value="<?php echo $result->bb_comments;?>">
                    <input type="hidden" name="log_comments" value="<?php echo $result->bb_comments;?>">
                    <input type="hidden" name="log_timestamp" value="<?php echo date('d-m-Y H:i:s', strtotime($result->bb_timestamp));?>">
                    <input type="hidden" name="log_user_id" value="<?php echo $result->bb_userId;?>">
            </div>
                    <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
                </form>
	</div><!--//col-md-3-->
                
    </div><!--//cols-wrapper-->
           
         