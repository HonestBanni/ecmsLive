<?php
    $lab_id = $result->lab_id; 
    
    ?>
        <div class="content container">
               <!-- ******BANNER****** -->
            <h4 align="left">Update Lab Name<hr></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="AttendanceController/update_lab/<?php echo $lab_id;?>">
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->

                <div class="form-group col-md-3">
                    <label for="usr">Lab Name:</label>
             <input type="text" name="lab_name" value="<?php echo $result->lab_name;?>" class="form-control">
                </div>
               <div class="form-group col-md-12">
             <input type="submit" name="submit"  class="btn btn-theme" value="Update">
                </div> 
                        </div>
            </div>
           
        </div>