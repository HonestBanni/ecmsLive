 			 <!-- ******CONTENT****** --> 
    <div class="content container">
               <!-- ******BANNER****** -->
        <h2 align="left">Update Record <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
            <br />
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group name">
                        <label for="name">Title</label>
                            <input style="width:50%;" id="name" type="text" class="form-control" name="title" value="<?php echo $result->sp_name;?>">
                            <input type="hidden" value="<?php echo $result->sp_id?>" name="id">
                            <input type="hidden" value="<?php echo $result->sp_name?>" name="log_title">
                    </div>
                    <div class="form-group name">
                        <label for="name">Title</label>
                            <input style="width:50%;" id="name" type="text" class="form-control phone" name="phone" value="<?php echo $result->phone;?>">
                            <input type="hidden" value="<?php echo $result->phone?>" name="log_phone">
                    </div>
                    <div class="form-group name">
                        <label for="name">Title</label>
                            <input style="width:50%;" id="name" type="text" class="form-control" name="address" value="<?php echo $result->address;?>">
                            <input type="hidden" value="<?php echo $result->address?>" name="log_address">
                            <input type="hidden" value="<?php echo $result->sp_status?>" name="log_status">
                    </div>
                    <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
                </form>
	</div><!--//col-md-3-->
                
    </div><!--//cols-wrapper-->
           
         