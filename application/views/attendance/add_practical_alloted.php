 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="center" style="border-bottom:1px solid #ccc;">Add Practical Allotted </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
    <form name="student" method="post" action="AttendanceController/add_practical_alloted">       
        <div class="form-group col-md-3">
            <lable>Employee</lable>
           <input type="text" name="emp_id" class="form-control" id="emp">
            <input type="hidden" name="emp_id" id="emp_id">
        </div>
         <div class="form-group col-md-3">
            <lable>Group</lable>
            <input type="text" name="group_id" class="form-control" id="groupName">
            <input type="hidden" name="group_id" id="group_id">
        </div>
        <div class="form-group col-md-3">
            <lable>Subject</lable>
           <select name="subject_id" id="subject_id" class="form-control">
                <option value="">Select Subject</option>
                <?php
                    $pract = $this->db->query("SELECT * FROM practical_subject order by title asc");
                    foreach($pract->result() as $subs){
                ?>
                <option value="<?php echo $subs->prac_subject_id?>"><?php echo $subs->title?></option>
                <?php
                    }
                ?>
            </select>
        </div> </div>     
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
                            $this->db->order_by('order_stime', 'asc');
                        $d = $this->db->get('class_starting_time')->result();
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
                        
                            $this->db->order_by('order_etime', 'asc');
                        $d = $this->db->get('class_ending_time')->result();
                        foreach($d as $rec):
                        ?>
                        <option value="<?php echo $rec->etime_id;?>"><?php echo $rec->class_etime;?></option>
                        <?php endforeach;?>
                    </select>
                </div> 
                <div class="form-group col-md-2">
                    <input type="button" name="submit" id="addPractical" value="Add" class="btn btn-theme">
                </div>
                 <div class="form-group col-md-6">
            <input type="submit" class="btn btn-theme" name="submit_timetable" value="Add Practical Allotted">
        </div>
        <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis');
                echo md5($rand.$date);
                ?>">            
                </div>
                </div>
    </form> 
            <article class="contact-form col-md-12 col-sm-7">
                    <div id="prac_timeTable">

                    </div>
                  </article> 
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->