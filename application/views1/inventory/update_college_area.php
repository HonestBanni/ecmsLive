 			 <!-- ******CONTENT****** --> 
    <div class="content container">
               <!-- ******BANNER****** -->
        <h2 align="left">Update College Area <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
            <br />
                <form class="form-horizontal row-fluid" method="post">
                    <div class="form-group name">
                        <label for="name">Name</label>
                            <input style="width:50%;" id="name" type="text" class="form-control" name="col_name" value="<?php echo $result->col_name;?>">
                            <input type="hidden" value="<?php echo $result->col_id?>" name="id">
                    </div>
                    <div class="form-group name">
                        <label for="name">Total Area</label>
                            <input style="width:50%;" id="name" type="text" class="form-control" name="col_total_area" value="<?php echo $result->col_total_area;?>">
                    </div>
                    <div class="form-group name">
                        <label for="name">Covered Area</label>
                            <input style="width:50%;" id="name" type="text" class="form-control" name="col_cover_area" value="<?php echo $result->col_cover_area;?>">
                    </div>
                    <div class="form-group name">
                        <label for="name">Uncovered Area</label>
                            <input style="width:50%;" id="name" type="text" class="form-control" name="col_remaining_area" value="<?php echo $result->col_remaining_area;?>">
                    </div>
                    <div class="form-group name">
                        <label for="name">Comments</label>
                            <input style="width:50%;" id="name" type="text" class="form-control" name="comments" value="<?php echo $result->comments;?>">
                    </div>
                    <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
                </form>
	</div><!--//col-md-3-->
                
    </div><!--//cols-wrapper-->
           
         