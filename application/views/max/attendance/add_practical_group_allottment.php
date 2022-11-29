 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="center" style="border-bottom:1px solid #ccc;">Add New Record </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
    <form name="student" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AttendanceController/add_practical_group_allottment">       
        <div class="form-group col-md-3">
            <lable>Student</lable>
           <input type="text" name="student_id" class="form-control" id="student">
            <input type="hidden" name="student_id" id="student_id">
        </div>
         <div class="form-group col-md-3">
            <lable>Group</lable>
            <input type="text" name="group_id" class="form-control" id="group">
            <input type="hidden" name="group_id" id="group_id">
        </div>          
        <div class="form-group col-md-4">
            <input type="submit" class="btn btn-theme" name="submit" value="Add Record">
        </div>
                        </div>
                    </div>
    </form> 
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->