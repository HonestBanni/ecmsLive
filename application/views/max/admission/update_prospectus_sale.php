<?php
		$this->load->helper('form');
		
		foreach($result as $row);
		$id = $row->serial_no;
		$date = $row->date;
		$amount = $row->total_amount;
		$total_pros_issue = $row->total_pros_issue;
        $batch_id = $row->batch_id;
		?>
				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Prospectus Sale <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
									
										<h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
									</div>

									<br />

									<form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_p_sale/<?php echo $id;?>">
				 <div class="control-group">
                        <label class="control-label" for="basicinput">Date</label>
                        <div class="controls">
                            <input style="width:50%;" type="text"  name="date" value="<?php echo $date;?>" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Prospectus Issued</label>
                        <div class="controls">
                            <input style="width:50%;" type="text"  name="total_pros_issue" value="<?php echo $total_pros_issue;?>" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>    
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Total Amount </label>
                        <div class="controls">
    <input style="width:50%;" id="name" type="text" value="<?php echo $amount;?>" name="total_amount" class="span8 tip form-control">                
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Batch Name</label>
                        <div class="controls">
     <select style="width:50%;" name="batch_id" class="form-control span8 tip" required>
        <?php
                $p = $this->db->query("SELECT * FROM prospectus_batch WHERE batch_id='$batch_id'");
                foreach($p->result() as $pr);
         ?>
         <option value="<?php echo $pr->batch_id;?>"><?php echo $pr->batch_name;?></option>
                                <option>&larr; Batch &rarr;</option>
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
                    <br>
                <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->