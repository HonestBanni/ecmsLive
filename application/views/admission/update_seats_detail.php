<?php
		$this->load->helper('form');
		
		foreach($result as $row);
		$id = $row->serial_no;
		$rseat_id = $row->rseat_id;
		$sub_pro_id = $row->sub_pro_id;
		$shift_id = $row->shift_id;
		$status = $row->status;
        $seats = $row->seats_allowed;
        $comment = $row->comment;
		?>
				 <!-- ******CONTENT****** --> 
        <div class="content container" style="margin-bottom:200px;">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Reserved Seat Detail<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">			
      <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
									<br />

									<form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_seat_detail/<?php echo $id;?>">
				<div class="control-group">
                        <label class="control-label" for="basicinput">Seat Reserved</label>
                        <div class="controls">
                <select style="width:50%;" name="rseat_id" class="span8 tip form-control" required>
                    <option>&larr; Reserved Seat &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM reserved_seat");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->rseat_id;?>"><?php echo $pr->name;?></option>
                        <?php
                            }
                            ?>    
                            </select>
                        </div>
                    </div> 
                     <div class="control-group">
                        <label class="control-label" for="basicinput">Sub Programe</label>
                        <div class="controls">
                            <select style="width:50%;" name="sub_pro_id" class="span8 tip form-control" required>
                                <option>&larr; Sub Programe &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM sub_programes");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->sub_pro_id;?>"><?php echo $pr->name;?></option>
                        <?php
                            }
                            ?>    
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Seats Allowed</label>
                        <div class="controls">
                            <input style="width:50%;" type="text" name="seats_allowed" value="<?php echo $seats;?>" class="span8 tip form-control" required>
                        </div>
                    </div> 
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Status</label>
                        <div class="controls">
                            <select style="width:50%;" name="status" class="span8 tip form-control">
                                <option>&larr; Status &rarr;</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Shift Name</label>
                        <div class="controls">
                            <select style="width:50%;" name="shift_id" class="span8 tip form-control" required>
                                <option>&larr; Shifts &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM shift");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->shift_id;?>"><?php echo $pr->name;?></option>
                        <?php
                            }
                            ?>    
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Comment</label>
                        <div class="controls">
                            <textarea style="width:50%;" type="text" name="comment" data-original-title="" class="span8 tip form-control" required><?php echo $comment;?></textarea>
                        </div>
                    </div>        
                   
                    <br>
                <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->