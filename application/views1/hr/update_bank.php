 			 <!-- ******CONTENT****** --> 
    <div class="content container">
               <!-- ******BANNER****** -->
        <h2 align="left">Update Bank <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
            <br />
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group name">
                        <label for="name">Bank Name</label>
    <input style="width:50%;" id="name" type="text" class="form-control" name="name" value="<?php echo $result->name;?>">
                            <input type="hidden" value="<?php echo $result->bank_id;?>" name="bank_id">
                    </div>
                    <div class="form-group name">
                        <label for="name">Account No</label>
    <input style="width:50%;" id="account_no" type="text" class="form-control" name="account_no" value="<?php echo $result->account_no;?>">
                            
                    </div>
                    <div class="form-group name">
                        <label for="name">Branch Code</label>
    <input style="width:50%;" id="name" type="text" class="form-control" name="branch_code" value="<?php echo $result->branch_code;?>">
                    </div>
                    <div class="form-group name">
                        <label for="name">Address</label>
    <input style="width:50%;" id="name" type="text" class="form-control" name="address" value="<?php echo $result->address;?>">
                    </div>
                    <div class="form-group name">
                        <label for="name">Comment</label>
<textarea style="width:50%;" type="text" class="form-control" name="comment"><?php echo $result->comment;?></textarea>
                    </div>
                    <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
                </form>
	</div><!--//col-md-3-->          
    </div><!--//cols-wrapper-->
           
         