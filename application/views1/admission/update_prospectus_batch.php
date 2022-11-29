<?php
		$this->load->helper('form');
		
		foreach($result as $row);
		$id = $row->batch_id;
		$batch = $row->batch_name;
		$amount = $row->prospectus_amount;
		$status = $row->status;
		$date = $row->date_of_issuance;
        $programe_id = $row->programe_id;
		?>
				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Prospectus Batch <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
									
										<h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
									</div>

									<br />

									<form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_p_batch/<?php echo $id;?>">
				 <div class="control-group">
                        <label class="control-label" for="basicinput">Batch Name</label>
                        <div class="controls">
                            <input style="width:50%;" type="text"  name="batch_name" value="<?php echo $batch;?>" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Prospectus Amount</label>
                        <div class="controls">
                            <input style="width:50%;" type="text"  name="prospectus_amount" value="<?php echo $amount;?>" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>    
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Status</label>
                        <div class="controls">
                            <?php $flag_result = $this->CRUDModel->get_where_row('prospectus_batch', array('batch_id' => $id)); ?>
                            <select style="width:50%;" name="status" class=" form-control span8 tip">
                                <?php 
                                    if($flag_result->status == 'on'):
                                        echo '<option value="on">On</option>';
                                    endif;
                                    if($flag_result->status == 'off'):
                                        echo '<option value="off">Off</option>';
                                    endif;
                                ?>
                                <option>&larr; Status &rarr;</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>              
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Current Batch Status</label>
                        <div class="controls">
                            <select style="width:50%;" name="s_flag" class=" form-control span8 tip">
                                <?php 
                                    if($flag_result->status_flag == 1):
                                        echo '<option value="1">On</option>';
                                    endif;
                                    if($flag_result->status_flag == 0):
                                        echo '<option value="0">Off</option>';
                                    endif;
                                ?>
                                <option>&larr; Batch Status &rarr;</option>
                                <option value="1">On</option>
                                <option value="0">Off</option>
                            </select>  
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Issuance Date </label>
                        <div class="controls">
    <input style="width:50%;" id="name" type="text" value="<?php echo $date;?>" name="date_of_issuance" class="span8 tip form-control">                
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Program Name</label>
                        <div class="controls">
                            
                            <?php 
                                            $this->db->join('programes_info', 'programes_info.programe_id=prospectus_batch.programe_id', 'left outer');
                                $p_result = $this->db->get_where('prospectus_batch', array('batch_id' => $id))->row(); 
//                                echo '<pre>'; print_r($p_result); die;
                            ?>
                            <select style="width:50%;" name="programe_id" class=" form-control span8 tip">
                                <?php echo '<option value="'.$p_result->programe_id.'">'.$p_result->programe_name.'</option>'; ?>
                                <option>&larr; Status &rarr;</option>
                                <?php
                                    $p = $this->db->query("SELECT * FROM programes_info");
                                    foreach($p->result() as $pr)
                                        {        
                                ?>        
                                <option value="<?php echo $pr->programe_id;?>"><?php echo $pr->programe_name;?></option>
                                <?php } ?> 
                            </select> 
                            
                        </div>
                    </div>
                    <br>
                <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        <p>&nbsp;</p>