        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Students <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">
                   
                    <form method="post" action="admin/search_group_student">
                        <div class="form-group col-md-3">
                            <label for="usr">Batch Name</label>
                            <select type="text" name="batch_id" class="form-control">
                                <option value="">Select Batch</option>
                                <?php 
                                $sb = $this->db->query("SELECT * FROM prospectus_batch");
                                foreach($sb->result() as $sbrec)
                                {
                                ?>
                            <option value="<?php echo $sbrec->batch_id;?>"><?php echo $sbrec->batch_name;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="usr">Program Name</label>
                            <select type="text" name="programe_id" class="form-control">
                                <option value="">Select Program</option>
                            <?php 
                            $sb = $this->db->query("SELECT * FROM programes_info");
                            foreach($sb->result() as $sbrec)
                            {
                            ?>
                        <option value="<?php echo $sbrec->programe_id;?>"><?php echo $sbrec->programe_name;?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="usr">Sub Program Name</label>
                            <select type="text" name="sub_pro_id" class="form-control">
                                 <option value="">Select Sub Program</option>
                            <?php 
                            $sb = $this->db->query("SELECT * FROM sub_programes WHERE programe_id=1");
                            foreach($sb->result() as $sbrec)
                            {
                            ?>
                                <option value="<?php echo $sbrec->sub_pro_id;?>"><?php echo $sbrec->name;?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="usr">Limit</label>
                            <input type="text" name="limit" class="form-control" placeholder="Limit e.g 40 ">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="submit" class="btn btn-theme" name="search" value="Search">
                        </div>
                    </form>
                    <br>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->