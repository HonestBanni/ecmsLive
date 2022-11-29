        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Contract Reneval <span  style="float:right"><a href="HrController/add_contract_reneval" class="btn btn-large btn-primary">Add New Contract Reneval</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="100">Picture </th>
                            <th width="60">Letter #</th>
                            <th width="80">Employee</th>
                            <th width="80">From Date</th>
                            <th width="80">To Date</th>
                            <th width="100">Contract Date</th>
                            <th>Description</th>
                            <th width="80">Update</th>
                            <th width="80">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                        $fromdate = $rec->from_date;
                        $todate = $rec->to_date;
                        $date = $rec->contract_date;
                        $newDate = date("d-m-Y", strtotime($date));
                        $fromDate = date("d-m-Y", strtotime($fromdate));
                        $toDate = date("d-m-Y", strtotime($todate));
                        ?>
                        <tr class="gradeA">
                            <td><img src="assets/images/contract_reneval/<?php echo $rec->image;?>" width="100" height="70"></td>
                            <td><?php echo $rec->letter_no;?></td>
                            <td><?php echo $rec->emp_name;?></td>
                            <td><?php echo $fromDate;?></td>
                            <td><?php echo $toDate;?></td>
                            <td><?php echo $newDate;?></td>
                            <td><?php echo $rec->details;?></td>
                            <td><a href="HrController/update_contract_reneval/<?php echo $rec->contract_id;?>" class="btn btn-theme btn-sm">Update</a></td>
                            <td><a href="HrController/delete_contract_reneval/<?php echo $rec->contract_id;?>" 
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
   
  