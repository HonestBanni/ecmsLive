
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Student Marks<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AttendanceController/add_new_enrolled_exam_marks/<?php echo $ex_id;?>/<?php echo $emp_id;?>/<?php echo $subject_id;?>/<?php echo $sec_id;?>/<?php echo $std_id;?>">
            <input type="hidden" value="<?php echo $student_info->student_name;?>" name="serial_no"> 
            <input type="hidden" value="<?php echo $ex_id?>" name="test_id"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">Student:</label>
                  <input type="text" name="student_id" value="<?php echo $student_info->student_name;?>" class="form-control" readonly="readonly"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Obtained Marks:</label>
                  <input type="text" name="omarks" value="" required="required" class="form-control checkINput"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Total Marks:</label>
                  <input type="text" name="tmarks" id="tmarks" readonly="readonly" value="<?php echo $test_info->exb_test_marks;?>" class="form-control"> 
              </div>
         <div class="form-group col-md-8">
                    <input type="submit" class="btn btn-theme" name="submit" value="Update Record">
              </div> 
        </div>       
                      
                        </div>     
                </form>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->