<?php
//		$this->load->helper('form');
//		foreach($result as $row);
//		$id = $row->id;
//		$password = $row->password;
		
		?>
				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update User <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
									
										<h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
									</div>

									<br />
									<form  method="post" enctype="multipart/form-data" action="admin/update_user">
				<div class="form-group col-md-4">
                        <input  id="name" type="text" class="form-control" name="email" value="<?php echo $result->email;?>" readonly>
                 </div>
                <div class="form-group col-md-4">
                        <input  id="name" type="password" class="form-control" name="password" value="<?php echo $result->password;?>">
                 </div>
                                        
                <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->