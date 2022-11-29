        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Demotion <span  style="float:right"><a href="HrController/add_demotion" class="btn btn-large btn-primary">Add New Demotion</a></span><hr></h2>
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
                            <th width="80">Demotion Date</th>
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
                        $date = $rec->dem_date;
                        $newDate = date("d-m-Y", strtotime($date));
                        ?>
                        <tr class="gradeA">
                            <td><img src="assets/images/demotion/<?php echo $rec->image;?>" width="100" height="70"></td>
                            <td><?php echo $rec->letter_no;?></td>
                            <td><?php echo $rec->emp_name;?></td>
                            <td><?php echo $rec->scale;?></td>
                            <td><?php echo $s->title;?></td>
                            <td><?php echo $rec->designation;?></td>
                            <td><?php echo $d->title;?></td>
                            <td><?php echo $newDate;?></td>
                            <td><a href="HrController/update_demotion/<?php echo $rec->dem_id;?>" class="btn btn-theme btn-sm">Update</a></td>
                            <td><a href="HrController/delete_demotion/<?php echo $rec->dem_id;?>" 
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
   
  