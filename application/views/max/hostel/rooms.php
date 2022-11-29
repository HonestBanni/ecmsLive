        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Rooms <span style="float:right"><a href="HostelController/add_room" class="btn btn-large btn-primary">Add New Room</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Block Name</th>
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
                    <td><?php echo $rec->room_name;?></td>
                    <td><?php echo $rec->block_name;?></td>
            <td><a class="btn btn-theme btn-sm" href="HostelController/update_room/<?php echo $rec->room_id;?>"><i class="icon-edit"></i><b> Update</b></a></td>
            <td><a class="btn btn-danger btn-sm" href="HostelController/delete_room/<?php echo $rec->room_id;?>" 
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