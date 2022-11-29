<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Student Status<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;">
            <?php print_r($this->session->flashdata('insert_msg'));?>
        </h4>
        <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
        </h4>
									</div>
<br />
<form method="post">
    
    <div class="form-group col-md-3">
        <label>Student Name:</label>
       <input type="text" name="student_id" class="form-control" value="<?php echo $result->student_name;?>" id="student_record">
    <input type="hidden" name="student_id" id="student_id" value="<?php echo $result->student_id;?>">
        <input type="hidden" name="hostel_id" value="<?php echo $result->hostel_id;?>">
   </div>
    <div class="form-group col-md-3">
        <label>Student Contact</label>
       <input type="text" name="student_mobile_no" class="form-control phone" value="<?php echo $result->student_mobile_no;?>" placeholder="Student Contact #">
   </div>
    <div class="form-group col-md-3">
        <label>Room Name:</label>
       <input type="text" name="room_id" class="form-control" value="<?php echo $result->room_name;?>" id="room_record">
        <input type="hidden" name="room_id" id="room_id" value="<?php echo $result->room_id;?>">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Student Status:</label>
        <select name="hostel_status_id" class="form-control">
    <option value="<?php echo $result->hostel_status_id;?>"><?php echo $result->status_name;?></option>
    <option value="">Select Status</option>
            <?php 
         $f = $this->db->query("SELECT * FROM hostel_status");
         foreach($f->result() as $row):
         ?>
            <option value="<?php echo $row->hostel_status_id;?>"><?php echo $row->status_name;?></option>
         <?php
         endforeach;
         ?>
        </select> 
   </div>
    <div class="form-group col-md-3">
        <label>Leaving Date:</label>
        <input type="text" name="leaving_date" class="form-control date_format_d_m_yy" required="required">
    </div>
    <div class="form-group col-md-6">
        <label>Reason Behind Leaving:</label>
       <input type="text" name="reason" class="form-control" required="required">
    </div>
    <div class="form-group col-md-4">
        <input type="submit" style="margin-top:23px;" class="btn btn-theme" name="submit" value="Update Record">
    </div>
    
    </form>
    <?php
   
    if($student_log):
//        echo '<pre>';print_r($student_log); 
    ?>
                 
                    <table class="table table-hover" id="table">
                          <thead>
                            <tr>

                                <th>#</th>
                                <th>Student Name</th>
                                <th>Hostel Status </th>
                                <th>Date</th>
                                <th>Reason</th>
                                <th>Update By</th>
                                <th>Date & Time</th>
                                

                            </tr>
                          </thead>
                          <tbody>
                              <?php
                              $sn = '';

                                foreach($student_log as $row):
                                        $sn++;
                                  echo '<tr class=" ">
                                      <td>'.$sn.'</th>
                                      <td>'.$row->student_name.'</td>
                                      <td>'.$row->status_name.'</td>
                                      <td>'.date('d-m-Y',strtotime($row->leave_date)).'</td>
                                      <td>'.$row->reason.'</td>
                                      <td>'.$row->emp_name.'</td>
                                      <td>'.date('d-m-Y H:i:s',strtotime($row->update_timestamp)).'</td>
                                           ';

                                  echo '<td>';
                                 
                                 
 

                                endforeach;      


                              ?>

                          </tbody>
                  </table>
               
 <?php
    
   
        
    endif;
    
    ?>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           