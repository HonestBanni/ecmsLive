        <!-- ******CONTENT****** --> 
        <div class="content container" style="margin-bottom:250px;">
               <!-- ******BANNER****** -->
            <h2 align="left">All Prospectus Sales <span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New Prospectus Record</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Batch Name</th>
                            <th>Date Issuance</th>
                            <th>Total Prospectus</th>
                            <th>Total Amount</th>
                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
foreach($result as $rec)  
{
    $batch_id = $rec->batch_id;
    $p = $this->db->query("SELECT * FROM prospectus_batch WHERE batch_id='$batch_id'");
    foreach($p->result() as $prec); 
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $prec->batch_name;?></td>
                            <td><?php echo $rec->date;?></td>
                            <td><?php echo $rec->total_pros_issue;?></td>
                            <td><?php echo $rec->total_amount;?></td>
                            <td><a href="<?php echo base_url();?>admin/update_p_sale/<?php echo $rec->serial_no;?>"><i class="icon-edit"></i><b> Update</b></a></td>
                            <td><a href="<?php echo base_url();?>admin/delete_p_sale/<?php echo $rec->serial_no;?>" 
                                   onclick="return confirm('Are You Sure to Delete This..?')"><i class="icon-trash" style="color:#87a938"></i><b> Delete</b></a></td>
                        </tr>

                        <?php
}
                        ?>


                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   
  <div class="modal fade" id="adding" role="dialog" style="z-index:9999">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Prospectus Record</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/add_prospectus_sale">
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Date</label>
                        <div class="controls">
                            <input type="text" name="date" placeholder="Date Required" data-original-title="" class="span8 tip form-control date">
                        </div>
                    </div>    
                    <div class="control-group">
                        <label class="control-label" for="basicinput">total prospectus issue</label>
                        <div class="controls">
    <input id="name" type="text" placeholder="Prospectus Total Issued Required" name="total_pros_issue" class="span8 tip form-control">                
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">total Amount</label>
                        <div class="controls">
    <input id="name" type="text" placeholder="Prospectus Issue Amount Required" name="total_amount" class="span8 tip form-control">                
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Batch Name</label>
                        <div class="controls">
     <select name="batch_id" class="form-control span8 tip" required>
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
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" value="Add Record" class="btn btn-primary pull-center">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>