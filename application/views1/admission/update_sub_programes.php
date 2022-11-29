<?php
		$this->load->helper('form');
		
		foreach($result as $row);
		$id = $row->sub_pro_id;
		$name = $row->name;
		$status = $row->status;
		$flag = $row->flag;
        $degree_type_id = $row->programe_id;
		
		?>
				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Sub Program <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
									
										<h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
									</div>

									<br />

									<form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_sub_programe/<?php echo $id;?>">
				
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Sub Programe Name</label>
                        <div class="controls">
                            <input style="width:50%" type="text"  name="name" value="<?php echo $name;?>"  data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Program</label>
                        <div class="controls">
                           <select style="width:50%" name="programe_id" class="form-control span8 tip" required>
                                <option>&larr; Programe &rarr;</option>
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
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Status</label>
                        <div class="controls">
                            <select style="width:50%" name="status" class="form-control span8 tip" required>
                                <option value="">Status</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="basicinput">Section/Subject</label>
                        <div class="controls">
                            <select style="width:50%" name="flag" class="form-control span8 tip">
                        <option value="<?php echo $flag;?>"><?php if($flag == 1)
                        {
                            echo 'Section Base';
                        }else{
                            echo 'Subject Base';
                        }?> </option>
                                <option value="">Select</option>
                                <option value="1">Section Base</option>
                                <option value="2">Subject Base</option>
                            </select>
                        </div>
                    </div>                
                        <br>
                <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
											
									</form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->