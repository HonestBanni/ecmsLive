<?php
		$this->load->helper('form');
		
		foreach($result as $row);
		$id = $row->programe_id;
		$programe_name = $row->programe_name;
		$status = $row->status;
        $degree_type_id = $row->degree_type_id;
		
		?>
				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Program <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
									
										<h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
									</div>

									<br />

									<form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_programe/<?php echo $id;?>">
				
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Program Name</label>
                        <div class="controls">
                            <input style="width:50%" type="text"  name="programe_name" value="<?php echo $programe_name;?>"  data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Degree Type</label>
                        <div class="controls">
                           <select style="width:50%" name="degree_type_id" class="form-control span8 tip" required>
                                <option>&larr; Degree Type &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM degree_type");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->degree_type_id;?>"><?php echo $pr->name;?></option>
                        <?php
                            }
                            ?>    
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Status</label>
                        <div class="controls">
                            <select style="width:50%" name="status" class="form-control span8 tip" required>
                                <option>&larr; Status &rarr;</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        </div><br>
                <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->