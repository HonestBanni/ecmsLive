        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Departments Head<span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add Head of Department</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Comment</th>
                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
foreach($result as $rec)  
{
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->employee;?></td>
                            <td><?php echo $rec->department;?></td>
                            <td><?php echo $rec->date;?></td>
                            <td><?php echo $rec->comment;?></td>
                            <td><a href="<?php echo base_url();?>HrController/update_head_of_dept/<?php echo $rec->serial_no;?>"><i class="icon-edit"></i><b> Update</b></a></td>
                            <td><a href="<?php echo base_url();?>HrController/delete_head_of_dept/<?php echo $rec->serial_no;?>" 
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
                <h4 class="modal-title">Add Head of Department</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="HrController/add_head_of_dept">

                    <div class="control-group">
                        <label class="control-label" for="basicinput">Departments</label>
                        <div class="controls">
                            <select name="department_id" class="span8 tip form-control">
                                <?php 
                                $d = $this->db->query("SELECT * FROM department");
                                foreach($d->result() as $rec)
                                {
                                ?>
                                    <option value="<?php echo $rec->department_id;?>"><?php echo $rec->title;?></option>    
                                <?php
                                }
                                ?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Employee</label>
                        <div class="controls">
                            <select name="emp_id" class="span8 tip form-control">
                                <?php 
                                $d = $this->db->query("SELECT * FROM hr_emp_record");
                                foreach($d->result() as $rec)
                                {
                                ?>
                                    <option value="<?php echo $rec->emp_id;?>"><?php echo $rec->emp_name;?></option>    
                                <?php
                                }
                                ?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Date</label>
                        <div class="controls">
                            <input type="text" name="date" class="span8 tip form-control date">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Comment</label>
                        <div class="controls">
                            <textarea type="text" name="comment" class="span8 tip form-control"></textarea>
                        </div>
                    </div><br>
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