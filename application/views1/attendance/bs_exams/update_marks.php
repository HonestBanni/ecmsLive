<?php
   $student_id = $result->exbd_student_id;
   $omarks = $result->exbd_omarks;
   $serial_no = $result->exbd_serial_no;
  
?>
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Student Marks<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AttendanceController/update_exam_marks/<?php echo $serial_no;?>/<?php echo $ex_id;?>/<?php echo $emp_id;?>/<?php echo $subject_id;?>/<?php echo $sec_id;?>">
            <input type="hidden" value="<?php echo $serial_no;?>" name="serial_no"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">Student:</label>
                  <?php
                  $gres = $this->AttendanceModel->get_by_id('student_record',array('student_id'=>$student_id));
                            if($gres){
                                foreach($gres as $grec){ ?>
                    <input type="text" name="student_id" value="<?php echo $grec->student_name;?>" class="form-control"> 
                         <?php 
                                }     
                            }else{
                        echo '<input type="text" value="" class="form-control">';
                                }    
                            ?> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Obtained Marks:</label>
                  <input type="text" name="omarks" value="<?php echo $omarks;?>" required="required" class="form-control checkINput"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Total Marks:</label>
                  <input type="text" name="tmarks" id="tmarks" readonly="readonly" value="<?php echo $result->exb_test_marks;?>" class="form-control"> 
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