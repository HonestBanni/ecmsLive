        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Labs List <span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New Lab</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Labs Name</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Edit</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $i = 1;   
                    foreach($result as $rec)  
                    {
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $i;?></td>
                            <td><?php echo $rec->lab_name;?></td>
                <td><a href="<?php echo base_url();?>AttendanceController/delete_lab/<?php echo $rec->lab_id;?>" 
                                   onclick="return confirm('Are You Sure to Delete This..?')"><i class="icon-trash" style="color:#87a938"></i><b> Delete</b></a></td>
    <td><a href="<?php echo base_url();?>AttendanceController/update_lab/<?php echo $rec->lab_id;?>">
        <i class="icon-edit" style="color:#87a938"></i><b> Edit</b></a></td>
                        </tr>

                        <?php
                        $i++;
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
                <h4 class="modal-title">Add New Lab</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AttendanceController/add_lab">

                    <div class="control-group">
                        <label class="control-label" for="basicinput">Lab Name</label>
                        <div class="controls">
                            <input type="text"  name="lab_name" data-original-title="" class="span8 tip form-control">
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