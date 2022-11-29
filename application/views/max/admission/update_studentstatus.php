 <div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="center">Students Change Status<hr></h3>
        <div class="row cols-wrapper">
        <div class="col-md-12">
             <?php
            $applicant_image = $result->applicant_image;
                    if($applicant_image == "")
                    {?>
                    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="60">
                    <?php
                    }else
                    {?>
    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/students/<?php echo $applicant_image;?>" width="60" height="60">
                <?php 
                    }
                    ?>
            <h4 align="center">Student: <?php echo $result->student_name;?> S/D of <?php echo $result->father_name;?></h4>
        </div>
    </div><br>
            <div class="row cols-wrapper">
            <form name="student_status" method="post"> 
                <div class="col-md-12">              
        <div class="form-group col-md-3">
            <label>Batch Name:</label>
            <input type="text" value="<?php echo $result->batch_name;?>" class="form-control">
            <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>">
            <input type="hidden" name="old_s_status_id" value="<?php echo $result->s_status_id;?>">
        </div> 
        <div class="form-group col-md-3">
            <label>Program:</label>
            <input type="text" value="<?php echo $result->programe_name;?>" class="form-control">
        </div> 
        <div class="form-group col-md-3">
            <label>Sub Program:</label>
            <input type="text" value="<?php echo $result->name;?>" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>College No:</label>
            <input type="text" value="<?php echo $result->college_no;?>" class="form-control">
        </div> 
        <div class="form-group col-md-3">
            <label>Student Status:</label>
            <select class="form-control" name="s_status_id">
        <option value="<?php echo $result->s_status_id;?>"><?php echo $result->status;?></option>
                <option value="">-- Select Status --</option>
            <?php
            $b = $this->db->query("SELECT * FROM student_status WHERE s_status_id in(5,6,7,8,10,12,13,14,9,1)");
            foreach($b->result() as $brec)
            {
            ?>
               <option value="<?php echo $brec->s_status_id;?>"><?php echo $brec->name;?></option>
            <?php 
            }
            ?>
            </select>
        </div>                     
        <div class="form-group col-md-3">
            <label>Status Date (<small>dd-mm-yy</small>):</label>
            <input type="text" name="admission_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy">
        </div>
        <div class="form-group col-md-6">
            <label>Status Comment:</label>
            <input type="text" name="admission_comment" class="form-control">
        </div>
        <div class="form-group col-md-2">            
            <input type="submit" class="btn btn-theme" name="submit" value="Update Status">
        </div>    
                        </div>
                       
                    </form> 
               <br>
        <?php  
            if(@$result_status):    
        ?>
    <div class="col-md-12" style="margin:20px 0px;">
        <strong style="font-size:16px;color:red; margin:20px 0px;" class="blink_text">
            Student change Status Logs
        </strong>
    </div>
                <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Student Name</th>
                            <th>Old Status</th>
                            <th>Transaction Date</th>
                            <th>Comments</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $i = 1;
                    foreach($result_status as $rec)  
                    {
                        $date = $rec->date;
            $newDate = date("d-m-Y", strtotime($date));
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $i?></td>
                            <td><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->name;?></td>
                            <td><?php echo $newDate;?></td>
                            <td><?php echo $rec->comment;?></td>
                            <td><?php echo $rec->emp_name;?></td>
                        </tr>

                        <?php
    $i++;

}
                        ?>


                    </tbody>
                </table>
        <?php
            else:  
        ?>
        <div class="col-md-12">
            <strong style="color:red">No Entry Available about this Student in Status Change Table</strong>        
        </div>        
        <?php  
            endif;
        ?>        
</div><!--/.span9-->
</div>