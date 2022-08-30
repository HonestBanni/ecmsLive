        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Programes <span style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New Programe</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Programe Name</th>
                            <th>Degree Type</th>
                            <th>Status</th>
                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
foreach($result as $rec)  
{
    $degree_type_id = $rec->degree_type_id;
    $p = $this->db->query("SELECT * FROM degree_type WHERE degree_type_id='$degree_type_id'");
    foreach($p->result() as $prec); 
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->programe_name;?></td>
                            <td><?php echo $prec->name;?></td>
                            <td><?php echo $rec->status;?></td>
                            <td><a href="<?php echo base_url();?>admin/update_programe/<?php echo $rec->programe_id;?>"><i class="icon-edit"></i><b> Update</b></a></td>
                            <td><a href="<?php echo base_url();?>admin/delete_programe/<?php echo $rec->programe_id;?>" 
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
                <h4 class="modal-title">Add New Program</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/add_programe">

                    <div class="control-group">
                        <label class="control-label" for="basicinput">Program Name</label>
                        <div class="controls">
                            <input type="text"  name="programe_name" placeholder="Type Required" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Degree Type</label>
                        <div class="controls">
                           <select name="degree_type_id" class="form-control span8 tip" required>
                                <option>&larr; Degree Type &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM degree_type");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->degree_type_id;?>"><?php echo $pr->name;?></option>
                        <?php
                            }
                            ?>    
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Status</label>
                        <div class="controls">
                            <select name="status" class="form-control span8 tip">
                                <option>&larr; Status &rarr;</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
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