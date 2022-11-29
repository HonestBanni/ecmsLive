<?php
		
		$id = $result->sec_id;
		$name = $result->name;
		$status = $result->status;
        $seats = $result->seats_allowed;
        $program_id = $result->program_id;
		
		?>
				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Section <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
									
										<h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
									</div>

									<br />

									<form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="admin/update_section/<?php echo $id;?>">
				<div class="control-group">
                        <label class="control-label" for="basicinput">Section Name</label>
                        <div class="controls">
                            <input style="width:50%;" type="text"  name="name" value="<?php echo $name;?>" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>    
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Sub Program</label>
                        <div class="controls">
                            <select style="width:50%;" name="sub_pro_id" class="form-control span8 tip" required>
                        <option value="<?php echo $result->sub_pro_id;?>"><?php echo $result->sub_program;?></option>        
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
                        <label class="control-label" for="basicinput">Allowed Seats</label>
                        <div class="controls">
    <input style="width:50%;" id="name" type="text" value="<?php echo $seats;?>" name="seats_allowed" class="span8 tip form-control">                
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Allowed Seats</label>
                        <div class="controls">
    <select style="width:50%;" name="status" class=" form-control span8 tip">
                    <option value="<?php echo $result->status;?>"><?php echo $result->status;?></option>
                                <option>&larr; Status &rarr;</option>
                                <option value="On">On</option>
                                <option value="Off">Off</option>
                            </select>              
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Batch Name</label>
                        <div class="controls">
     <select style="width:50%;" name="batch_id" class="form-control span8 tip" required>
         <option value="<?php echo $result->batch_id;?>"><?php echo $result->batch_name;?></option>
                                <option>&larr; Batch Name &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM prospectus_batch");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->batch_id;?>"><?php echo $pr->batch_name;?></option>
                        <?php
                            }
                            ?>    
                            </select>             
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Program Name</label>
                        <div class="controls">
     <select style="width:50%;" name="program_id" class="form-control span8 tip" required>
         <option value="<?php echo $result->programe_id;?>"><?php echo $result->programe_name;?></option>
                                <option>&larr; Program Name &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM programes_info");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->programe_id;?>"><?php echo $pr->programe_name;?></option>
                        <?php
                            }
                            ?>    
                            </select>             
                        </div>
                    </div>                    
                    <br>
                <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           