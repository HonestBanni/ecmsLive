<?php
   $student_id = $result->student_id;
   $status = $result->status;
   $serial_no = $result->serial_no;
  
?>
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Student Attendance<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AttendanceController/update_students_attendance/<?php echo $serial_no;?>">
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
                  <label for="usr">Status:</label>
                <select type="text" name="status" class="form-control">
                  <option value="<?php echo $status;?>"><?php if($status == 1){
                      echo "Present";
                    }elseif($status == 2){
                echo "Leave ";
                    }else
                    {
                        echo "Absent";
                    }
                      ?></option>
                        <option value="">&larr; Select Status &rarr;</option>
                            <option value="1">Present</option>
                            <option value="2">Leave</option>
                            <option value="0">Absent</option>
                    </select>  
              </div>
         <div class="form-group col-md-8">
                    <input type="submit" class="btn btn-theme" name="submit" value="Update Record">
              </div> 
        </div>            
                </form>
                      
                        </div>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->