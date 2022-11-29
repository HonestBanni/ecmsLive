        <!-- ******CONTENT****** --> 
        <div class="content container" style="margin-bottom:200px;">
               <!-- ******BANNER****** -->
            <h2 align="left">All Sections <span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New Section</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table id="testing123" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Program</th>
                            <th>Batch</th>
                            <th>Sub Program</th>
                            <th>Section Name</th>
                            <th>Seat Allowed</th>
                            <th>Status</th>
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
                            <td><?php echo $rec->program;?></td> 
                            <td><?php echo $rec->batch;?></td>
                            <td><?php echo $rec->sub_program;?></td>
                            <td><?php echo $rec->name;?></td>
                            <td><?php echo $rec->seats_allowed;?></td>
                            <td><?php echo $rec->status;?></td>
                            <td><a href="<?php echo base_url();?>admin/update_section/<?php echo $rec->sec_id;?>"><i class="icon-edit"></i><b> Update</b></a></td>
                            <td><a href="<?php echo base_url();?>admin/delete_section/<?php echo $rec->sec_id;?>" 
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
                <h4 class="modal-title">Add New Section</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/add_section">
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Section Name</label>
                        <div class="controls">
                            <input type="text"  name="name" placeholder="Name Required" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>    
                    
                    <div class="control-group">
                        <label for="name">Program Name</label>
                        <div class="input-group" id="adv-search">
                            <?php
                            echo form_dropdown('program_id', $program,'',  'class="form-control programe_id" id="feeProgrameId"');
                                  ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="name">Batch</label>
                        <div class="input-group" id="adv-search">
                            <?php
                            echo form_dropdown('batch_id', $batch,'',  'class="form-control" id="batch_id"');
                                  ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="name">Sub Program</label>
                        <div class="input-group" id="adv-search">
                            <?php
                            echo form_dropdown('sub_pro_id', $subprogrames,'',  'class="form-control sub_pro_id" id="showFeeSubPro"');
                                  ?>
                        </div>
                    </div>
                     <div class="control-group">
                        <label class="control-label" for="basicinput">Allowed Seats</label>
                        <div class="controls">
                            <input id="name" type="text" placeholder="Allowed Seats Required" name="seats_allowed" class="span8 tip form-control">                
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Allowed Seats</label>
                        <div class="controls">
                        <select name="status" class=" form-control span8 tip">
                                <option>&larr; Status &rarr;</option>
                                <option value="On">On</option>
                                <option value="Off">Off</option>
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