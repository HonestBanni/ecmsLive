<?php
    $subject_id = $result->subject_id;  
    
    ?>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h4 align="left">Update Subject <hr></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="LibraryController/update_subject/<?php echo $subject_id;?>">
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->

                <div class="form-group col-md-3">
                    <label for="usr">Subject Name:</label>
             <input type="text" name="subject_name" value="<?php echo $result->subject_name;?>" class="form-control">
                </div>
               <div class="form-group col-md-12">
             <input type="submit" name="submit"  class="btn btn-theme" value="Update">
                </div> 
                        </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->