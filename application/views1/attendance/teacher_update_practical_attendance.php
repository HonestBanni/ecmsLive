<?php
   $college_no = $result->college_no;
   $status = $result->status;
   $serial_no = $result->serial_no;
  
?>
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Student Practical Attendance<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="AttendanceController/teacher_update_prac_attendance/<?php echo $serial_no;?>">
            <input type="hidden" value="<?php echo $serial_no;?>" name="serial_no"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">Student:</label>
                  <?php
                  $gres = $this->AttendanceModel->get_by_id('student_prac_group_allottment',array('college_no'=>$college_no));
                // echo '<pre>'; print_r($gres);die;
                            if($gres){
                                foreach($gres as $grec){ ?>
                    <input type="text" name="college_no" value="<?php echo $grec->student_name;?>" class="form-control"> 
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
                    }else
                    {
                        echo "Absent";
                    }
                      ?></option>
                        <option value="">&larr; Select Status &rarr;</option>
                            <option value="1">Present</option>
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