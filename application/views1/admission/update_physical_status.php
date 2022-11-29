<?php
		$this->load->helper('form');
		
		foreach($result as $row);
		$id = $row->ps_id;
		$title = $row->title;
		
		?>
				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Physical Status <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
									
										<h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
									</div>

									<br />

									<form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_physical_status/<?php echo $id;?>">
				<div class="form-group name">
                        <label for="name">Status Name</label>
                        <input style="width:50%;" id="name" type="text" class="form-control" name="title" value="<?php echo $title;?>">
                 </div>
                <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->