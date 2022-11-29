        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
               <h2 align="left">Update Employee Scales <span style="float:right"></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <form class="form-horizontal row-fluid" method="post" >
                        <div class="col-md-6">
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Scale </label>
                                <div class="controls">
                                    <input type="text"  name="title" data-original-title="" value="<?php echo $result->title?>" class="span8 tip form-control">
                                    <input type="hidden"  name="emp_scale_id" data-original-title="" value="<?php echo $result->emp_scale_id?>" class="span8 tip form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="control-group">
                                <div class="controls">
                                    <label class="control-label" for="basicinput" style="visibility: hidden">Scalsdfasfe </label>
                                    <input type="submit" name="submit" value="Update Record" class="btn btn-primary pull-center">
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   
  <div class="modal fade" id="adding" role="dialog" style="z-index:9999">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Scale</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>HrController/add_employee_scale">

                    <div class="control-group">
                        <label class="control-label" for="basicinput">Scale </label>
                        <div class="controls">
                            <input type="text"  name="title" data-original-title="" class="span8 tip form-control">
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