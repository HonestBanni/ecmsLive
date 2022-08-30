 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="center" style="border-bottom:1px solid #ccc;">Add New Record </h2>
            <div class="row cols-wrapper">
    <form method="post" action="AttendanceController/add_class_alloted">     
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>  
        <div class="form-group col-md-3">
            <lable>Employee</lable>
           <input type="text" name="emp_id" class="form-control" id="emp">
            <input type="hidden" name="emp_id" id="emp_id">
        </div>
         <div class="form-group col-md-3">
            <lable>Section</lable>
            <input type="text" name="sec_id" class="form-control" id="sec">
            <input type="hidden" name="sec_id" id="sec_id">
        </div>
        <div class="form-group col-md-3">
            <lable>Subject</lable>
           <input type="text" name="subject_id" class="form-control" id="sub">
            <input type="hidden" name="subject_id" id="subject_id">
            <input type="hidden" name="subject_flag" id="subject_flag">
        </div>             
        </div>
        <div class="col-md-12">
                 <div class="form-group col-md-2">
                    <select class="form-control" name="day_id" id="day_id">
                        <option value="">Select Day</option>
                        <?php 
                        $d = $this->CRUDModel->getResults('days');
                        foreach($d as $rec):
                        ?>
                        <option value="<?php echo $rec->day_id;?>"><?php echo $rec->day_name;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                <select class="form-control" name="stime_id" id="stime_id">
                        <option value="">Start Time</option>
                        <?php 
                        $d = $this->CRUDModel->getResults('class_starting_time');
                        foreach($d as $rec):
                        ?>
                        <option value="<?php echo $rec->stime_id;?>"><?php echo $rec->class_stime;?></option>
                        <?php endforeach;?>
                    </select>  
                </div>
            <div class="form-group col-md-2">
                <select class="form-control" name="etime_id" id="etime_id">
                        <option value="">End Time</option>
                        <?php 
                        $d = $this->CRUDModel->getResults('class_ending_time');
                        foreach($d as $rec):
                        ?>
                        <option value="<?php echo $rec->etime_id;?>"><?php echo $rec->class_etime;?></option>
                        <?php endforeach;?>
                    </select>
                </div> 
                <div class="form-group col-md-2">
                    <input type="button" name="submit" id="addClass" value="Add" class="btn btn-theme">
                </div>
                 <div class="form-group col-md-6">
            <input type="submit" class="btn btn-theme" name="submit_timetable" value="Add Class Allotted">
        </div>
        <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis');
                echo md5($rand.$date);
                ?>">            
                </div>
        </form> 
                <article class="contact-form col-md-12 col-sm-7">
                    <div id="timeTable">

                    </div>
                  </article> 
                    </div>
    
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->