        <div class="content container">
            <h2 align="left">Update Student Password<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
									
                    <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>

                <br />
        <form  method="post" action="StudentController/student_update_password">
            <div class="form-group col-md-4">
                    <input  id="name" type="text" class="form-control" value="<?php echo $result->student_name;?>" readonly>
                    <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>">
             </div>
            <div class="form-group col-md-4">
                    <input  id="name" type="text" class="form-control" value="<?php echo $result->college_no;?>" readonly>
             </div>
                <div class="form-group col-md-4">
                        <input type="password" class="form-control" name="password" value="<?php echo $result->student_password;?>">
                 </div>
                                        
                <input type="submit" name="submit" value="Change Password" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           