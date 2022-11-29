        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Attendance (Languages)<hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post">
                      <div class="form-group col-md-3">
                          <select type="text" name="batch_id" class="form-control">
                <?php
            $gres = $this->AttendanceModel->get_by_id('prospectus_batch',array('batch_id'=>$batch_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->batch_id;?>"><?php echo $grec->batch_name;?></option>
                 <?php 
                    }     
                }
            ?>
                              
                              <option value="">Select Batch</option>
                <?php
                $b = $this->db->query("SELECT * FROM prospectus_batch WHERE `programe_id` in(10,11,12)");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->batch_id;?>"><?php echo $brec->batch_name;?></option>
                <?php 
                }
                ?>
                              
            </select>
                      </div>
                      <div class="form-group col-md-3">
                        <select type="text" name="programe_id" class="form-control">
                <?php
            $gres = $this->AttendanceModel->get_by_id('programes_info',array('programe_id'=>$programe_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->programe_id;?>"><?php echo $grec->programe_name;?></option>
                 <?php 
                    }     
                }
                    ?>        
                            <option value="">Select Language</option>
                <?php
        $b = $this->db->query("SELECT * FROM programes_info WHERE `programe_id` in(10,11,12)");
                foreach($b->result() as $brec)
                {
                ?>
    <option value="<?php echo $brec->programe_id;?>"><?php echo $brec->programe_name;?></option>
                <?php 
                }
                
                ?>
            </select>    
                      </div>
                    <div class="form-group col-md-2">
                            <input type="date" name="attendance_date" class="form-control">
                      </div>
                         <input type="submit" name="search" class="btn btn-theme" value="Search">
                </form>
            </div>
        </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                     <p><button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?></button></p>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Language</th>
                            <th>Batch</th>
                            <th>Present / Leave / Absent</th>
                            <th>Attendance Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                    $attend_id = $rec->attend_id;        
                    $present = $this->db->query("SELECT * FROM student_attendance_lang_details WHERE attend_id = '$attend_id' AND status=1");
    $leave = $this->db->query("SELECT * FROM student_attendance_lang_details WHERE attend_id = '$attend_id' AND status=2");
    $absent = $this->db->query("SELECT * FROM student_attendance_lang_details WHERE attend_id = '$attend_id' AND status=0");
    $total = $this->db->query("SELECT * FROM student_attendance_lang_details WHERE attend_id = '$attend_id'");    
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->programe_name;?></td>
                            <td><?php echo $rec->batch_name;?></td>
                        <td>
        <span class="badge badge-success">P-<?php echo $present->num_rows();?></span>
        <span class="badge badge-primary">L-<?php echo $leave->num_rows();?></span>
        <span class="badge badge-danger">A-<?php echo $absent->num_rows();?></span>
        <span class="badge badge-warning">Total-<?php echo $total->num_rows();?></span></td>
                            <td><?php echo $rec->attendance_date;?></td>
                            <td><a href="AttendanceController/view_language_attendance/<?php echo $rec->attend_id;?>/<?php echo $rec->programe_id;?>/<?php echo $rec->batch_id;?>">View Attendance</a></td>
                           
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   