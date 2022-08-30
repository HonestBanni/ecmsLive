        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Seats Detail List <span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New Reserved Seat</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:400px;">
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Seats </th>
                            <th>Program </th>
                            <th>Allowed Seats </th>
                            <th>Shift </th>
                            <th>Status </th>
                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
foreach($result as $rec)  
{
    $sub_pro_id = $rec->sub_pro_id;
    $rseat_id = $rec->rseat_id;
    $shift_id = $rec->shift_id;
    $rs = $this->db->query("SELECT * FROM reserved_seat WHERE rseat_id='$rseat_id'");
    $b = $this->db->query("SELECT * FROM shift WHERE shift_id='$shift_id'");
    $s = $this->db->query("SELECT * FROM sub_programes WHERE sub_pro_id='$sub_pro_id'");
    foreach($rs->result() as $rsrec); 
    foreach($b->result() as $brec); 
    foreach($s->result() as $srec);
                        ?>
                        <tr class="gradeA">
                           <td><?php echo $rsrec->name;?></td>
                            <td><?php echo $srec->name;?></td>
                            <td><?php echo $rec->seats_allowed;?></td>
                            <td><?php echo $brec->name;?></td>
                            <td><?php echo $rec->status;?></td>
                            <td><a href="<?php echo base_url();?>admin/update_seat_detail/<?php echo $rec->serial_no;?>"><i class="icon-edit"></i><b> Update</b></a></td>
                            <td><a href="<?php echo base_url();?>admin/delete_seat_detail/<?php echo $rec->serial_no;?>" 
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
                <h4 class="modal-title">Add New Seat Detail</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/add_seat_detail">
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Seat Reserved</label>
                        <div class="controls">
                            <select name="rseat_id" class="span8 tip form-control" required>
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
                            <select name="sub_pro_id" class="span8 tip form-control" required>
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
                            <input type="text" name="seats_allowed" placeholder="seats allowed" data-original-title="" class="span8 tip form-control" required>
                        </div>
                    </div> 
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Status</label>
                        <div class="controls">
                            <select name="status" class="span8 tip form-control">
                                <option>&larr; Status &rarr;</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Shift Name</label>
                        <div class="controls">
                            <select name="shift_id" class="span8 tip form-control" required>
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
                            <textarea type="text" name="comment" placeholder="Details" data-original-title="" class="span8 tip form-control" required></textarea>
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