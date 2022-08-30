        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Promotion <span  style="float:right"><a href="HrController/add_promotion" class="btn btn-large btn-primary">Add New Promotion</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="100">Picture </th>
                            <th width="50">Letter #</th>
                            <th width="80">Employee</th>
                            <th width="80">From Scale</th>
                            <th width="80">To Scale</th>
                            <th width="80">From Designation</th>
                            <th width="80">To Designation</th>
                            <th width="80">Promotion Date</th>
                            <th width="80">Update</th>
                            <th width="80">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                        $s = $this->CRUDModel->get_where_row('hr_emp_scale',array('emp_scale_id'=>$rec->to_scale_id));
                        $d = $this->CRUDModel->get_where_row('hr_emp_designation',array('emp_desg_id'=>$rec->to_desg_id));
                        $date = $rec->pro_date;
                        $newDate = date("d-m-Y", strtotime($date));
                        ?>
                        <tr class="gradeA">
                            <td><img src="assets/images/promotion/<?php echo $rec->image;?>" width="100" height="70"></td>
                            <td><?php echo $rec->letter_no;?></td>
                            <td><?php echo $rec->emp_name;?></td>
                            <td><?php echo $rec->scale;?></td>
                            <td><?php echo $s->title;?></td>
                            <td><?php echo $rec->designation;?></td>
                            <td><?php echo $d->title;?></td>
                            <td><?php echo $newDate;?></td>
                            <td><a href="HrController/update_promotion/<?php echo $rec->pro_id;?>" class="btn btn-theme btn-sm">Update</a></td>
                            <td><a href="HrController/delete_promotion/<?php echo $rec->pro_id;?>" 
                                   onclick="return confirm('Are You Sure to Delete This..?')" class="btn btn-danger btn-sm">Delete</a></td>
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
                <h4 class="modal-title">Add New Department</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>HrController/add_department">

                    <div class="control-group">
                        <label class="control-label" for="basicinput">Department Name</label>
                        <div class="controls">
                            <input type="text"  name="title" placeholder="Name Required" data-original-title="" class="span8 tip form-control">
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