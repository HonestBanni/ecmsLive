 			 <!-- ******CONTENT****** --> 
    <div class="content container">
               <!-- ******BANNER****** -->
        <h2 align="left">UPdate Message <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
            <br />
                <form class="course-finder-form row-fluid" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group name">
                        <label for="name">Message Details</label>
                        <textarea id="name" type="text" class="form-control" name="details"><?php echo $result->details;?></textarea>
                            <input type="hidden" value="<?php echo $result->message_id?>" name="message_id">
                    </div>
                    <div class="form-group">
                        <label for="name">Teaching Category</label>
                     
                                <?php echo form_dropdown('message_category',$message_category,$result->message_category,array('class'=>'form-control'));?>
                        
                    </div>
                    <br/>
                    <div class="form-group name" >
                        <label for="name">Message Status</label>
                        
                        <?php
                        if($result->status == 0):
                            ?>
                                 <select class="form-control" name="status">
                                    <option value="1">On</option>
                                    <option selected="selected" value="0">Off</option>
                                </select>
                                <?php
                            else:
                            ?>
                                <select class="form-control" name="status">
                                    <option selected="selected" value="1">On</option>
                                    <option  value="0">Off</option>
                                </select>
                                
                                <?php
                        endif;
                        
                        ?>
                       
                    </div>
                    <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
                </form>
	</div><!--//col-md-3-->
                
    </div><!--//cols-wrapper-->
           
         