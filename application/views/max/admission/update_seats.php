<?php
		$this->load->helper('form');
		
		foreach($result as $row);
		$id = $row->rseat_id;
		$name = $row->name;
		$status = $row->status;
        $seats = $row->seats_allowed
		?>
				 <!-- ******CONTENT****** --> 
        <div class="content container" style="margin-bottom:200px;">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Reserved Seat <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">			
      <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
									<br />

									<form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_seat/<?php echo $id;?>">
				<div class="control-group">
                        <label class="control-label" for="basicinput">Seat Reserved Name</label>
                        <div class="controls">
                            <input style="width:50%;" type="text"  name="name" value="<?php echo $name;?>" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>    
                   
                    <br>
                <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->