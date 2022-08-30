<?php
foreach($result as $row);
    
?>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     
    <form name="student" method="post" action="AttendanceController/update_class_alloted/<?php echo $row->class_id;?>">       
        <div class="form-group col-md-3">
            <lable>Employee</lable>
            <?php if($row->emp_id): ?>
        <input type="text" name="emp_id" value="<?php echo $row->employee;?>" class="form-control" id="emp">
            <input type="hidden" name="emp_id" value="<?php echo $row->emp_id;?>" id="emp_id">
            <?php else:?>
            <input type="text" name="emp_id" class="form-control" id="emp">
            <input type="hidden" name="emp_id" id="emp_id">
            <?php endif;?>
            <input type="hidden" name="class_id">
        </div>
        <div class="form-group col-md-3">
            <lable>Section</lable>
            <?php if($row->sec_id): ?>
        <input type="text" name="sec_id" value="<?php echo $row->section;?>" class="form-control" id="sec">
            <input type="hidden" name="sec_id" value="<?php echo $row->sec_id;?>" id="sec_id">
            <?php else:?>
            <input type="text" name="sec_id" class="form-control" id="sec">
            <input type="hidden" name="sec_id" id="sec_id">
            <?php endif;?>
        </div>
        <div class="form-group col-md-3">
            <lable>Subject</lable>
            <?php if($row->subject_id): ?>   
            <input type="text" name="subject_id" value="<?php echo $row->subject;?>" class="form-control" id="sub">
            <input type="hidden" name="subject_id" value="<?php echo $row->subject_id;?>" id="subject_id">
            <input type="hidden" name="subject_flag" id="subject_flag" value="<?php echo $row->flag;?>">
            <?php else:?>
            <input type="text" name="subject_id" class="form-control" id="sub">
            <input type="hidden" name="subject_id" id="subject_id">
            <input type="hidden" name="subject_flag" id="subject_flag">
            <?php endif;?>
                
        </div>
                      
        <div class="form-group col-md-2">
            <input style="margin-top:19px;" type="submit" class="btn btn-theme" name="submit" value="Update">
        </div>
                </form> 
               </div><!--//col-md-3-->
                <?php if(@$ttable):?>
                <div class="col-md-12">
                    <h4 style="color:red; text-align:left;margin-left:20px">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <div class="col-md-8">
                    <table class="table table-hover table-boxed">
                        <thead>
                            <tr>
                                <th>Day Name</th>
                                <th>Starting Time</th>
                                <th>Ending Time</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ttable as $tRow):?>
                            <tr>
                                <td><?php echo $tRow->day_name;?></td>
                                <td><?php echo $tRow->class_stime;?></td>
                                <td><?php echo $tRow->class_etime;?></td>
                                <td><a href="javascript:valid(0)" id="<?php echo $tRow->timetable_id.','.$row->class_id;?>" class="ttable_update"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Update</button></a></td>
                                <td><a class="btn btn-danger btn-sm" href="AttendanceController/deletetimetable/<?php echo $tRow->timetable_id.'/'.$row->class_id;?>" onclick="return confirm('Are You Want to Delete this..?')">Delete</a></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                        </table></div>
                </div><?php endif;?>
                
        <div class="col-md-12">
            <strong style="margin-left:20px">If you want to Add More day wise Classes then click on Add Button.</strong>
            <form method="post" action="AttendanceController/addTimeTable/<?php echo $row->class_id;?>">
                 <div class="form-group col-md-2">
                    <select class="form-control" name="day_id" id="day_id" required>
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
                <select class="form-control" name="stime_id" id="stime_id" required>
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
                    <input type="submit" name="submit" value="Add" class="btn btn-theme">
                </div>
                  </form>      
                </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Time Table Update</h4>
      </div>
      <div class="modal-body">
          <div id="timetable_update_info">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>