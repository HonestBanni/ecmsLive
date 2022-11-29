 <div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="center">Return Item<hr></h3>
            <div class="row cols-wrapper">
            <form method="post"> 
                <div class="col-md-12">              
        <div class="form-group col-md-3">
            <label>Item Name:</label>
            <input type="text" value="<?php echo $result->itm_name;?>" class="form-control" readonly="readonly">
            <input type="hidden" name="fid_id" value="<?php echo $result->fid_id;?>">
             <input type="hidden" name="itm_id" value="<?php echo $result->itm_id;?>">
        </div> 
        <div class="form-group col-md-3">
            <label>Tag Details:</label>
            <input type="text" value="<?php echo $result->fid_tag_no;?>" class="form-control" readonly="readonly">
        </div> 
        <div class="form-group col-md-3">
            <label>Department:</label>
            <input type="text" value="<?php echo $result->deptt_name;?>" class="form-control" readonly="readonly">
        </div> 
        <div class="form-group col-md-3">
            <label>Room Name:</label>
            <input type="text" value="<?php echo $result->rm_name;?>" class="form-control" readonly="readonly">
        </div> 
        <div class="form-group col-md-3">
            <label>Block Name:</label>
            <input type="text" value="<?php echo $result->bb_name;?>" class="form-control" readonly="readonly">
        </div>
        <div class="form-group col-md-3">
            <label>Receiving Date:</label>
            <input type="text" value="<?php echo date('d-m-Y');?>" name="receiving_date" class="form-control date_format_d_m_yy" readonly="readonly">
        </div> 
        <div class="form-group col-md-3">
            <label>Item Status:</label>
            <select class="form-control" name="is_id">
                <option value="<?php echo $result->is_id;?>"><?php echo $result->is_name;?></option>
                <option value="">-- Select Status --</option>
                <?php
                $b = $this->CRUDModel->getResults("invt_items_status");
                foreach($b as $brec)
                {
                ?>
                   <option value="<?php echo $brec->is_id;?>"><?php echo $brec->is_name;?></option>
                <?php 
                }
                ?>
            </select>
            <input type="hidden" value="<?php echo $result->is_id;?>" name="is_id_old" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>Issued Item Status:</label>
            <select class="form-control" name="iis_id">
                <option value="<?php echo $result->iis_id;?>"><?php echo $result->iis_status;?></option>
                <option value="">-- Select Status --</option>
                <?php
                $c = $this->CRUDModel->getResults("invt_issuance_status");
                foreach($c as $crec)
                {
                ?>
                   <option value="<?php echo $crec->iis_id;?>"><?php echo $crec->iis_status;?></option>
                <?php 
                }
                ?>
            </select>
            <input type="hidden" value="<?php echo $result->iis_id;?>" name="iis_id_old" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label>Status Comment:</label>
            <input type="text" name="comments" class="form-control" required="required">
        </div>
        <div class="form-group col-md-12">
            <input type="submit" class="btn btn-theme" name="update" value="Update Status">
        </div>    
                        </div>
                       
                    </form> 
               
</div><!--/.span9-->
</div>