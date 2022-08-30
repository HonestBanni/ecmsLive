        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">ACR <span  style="float:right"><a href="HrController/add_acr" class="btn btn-large btn-primary">Add New ACR</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="80">Employee</th>
                            <th width="80">Submitted Date</th>
                            <th width="80">Image 1</th>
                            <th width="80">Image 2</th>
                            <th width="80">Image 3</th>
                            <th width="80">Image 4</th>
                            <th width="80">Image 5</th>
                            <th width="80">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                        $date = $rec->submitted_date;
                        $newDate = date("d-m-Y", strtotime($date));
                        ?>
            <tr class="gradeA">
                <td><?php echo $rec->emp_name;?></td>
                <td><?php echo $newDate;?></td>
                <td><img src="assets/images/acr/<?php echo $rec->image_1;?>" width="80" height="50"></td>
                <td><img src="assets/images/acr/<?php echo $rec->image_2;?>"  width="80" height="50"></td>
                <td><img src="assets/images/acr/<?php echo $rec->image_3;?>"  width="80" height="50"></td>
                <td><img src="assets/images/acr/<?php echo $rec->image_4;?>"  width="80" height="50"></td>
                <td><img src="assets/images/acr/<?php echo $rec->image_5;?>"  width="80" height="50"></td>
                <td><a href="HrController/delete_acr/<?php echo $rec->acr_id;?>" 
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
   
  