        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Picture Log Report<hr></h2>
            <div class="row cols-wrapper">
                 
        <table class="table table-boxed table-bordered table-striped display">
            <thead>
                <tr>
                <td colspan="7" align="center">
                <strong style="font-size:15px;">Student Current Record</strong>
                </td>
            </tr>
                <tr>
                    
                    <th>Curr. College #</th>
                    <th>Curr. Picture #</th>
                    <th>Curr. Shift</th>
                    <th>Curr. Admission Date</th>
                    <th>Curr. Seat</th>
                    <th>User Name</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>      
            <tr class="gradeA">
                <td><?php echo $result->college_no;?></td>
                <td>
                    <?php
                    if($result->applicant_image == "")
                    { ?>
                    <img src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="60">
                    <?php } else
                    { ?>
                    <img src="<?php echo base_url();?>assets/images/students/<?php echo $result->applicant_image;?>" style="border-radius:10px;" width="60" height="60">
                    <?php } ?>
                </td>
                <td><?php echo $result->shift_name;?></td>
                <td><?php echo $result->admission_date;?></td>
                <td><?php echo $result->reserved_seat;?></td>
                <td><?php echo $result->username;?></td>
                
                <td><?php 
                    
                    $newDate1 = date("d-m-Y H:i:s", strtotime($result->timestamp));
                    echo $newDate1;?></td>
            </tr>
            <?php
                if(@$log):
                
            ?>    
            <tr>
                <td colspan="7" align="center">
                <strong style="font-size:15px;">Student Old Log Report</strong>
                </td>
            </tr>
            <tr>
                <th>Old College #</th>
                <th>Old Picture</th>
                <th>Old Shift</th>
                <th>Old Admission Date</th>
                <th>Old Seat</th>
                <th>User Name</th>
                <th>Date of Change</th>
            </tr>
         <?php
//            echo '<pre>'; print_r($log); die;
            foreach($log as $row):
            ?>   
            <tr>
                <td><?php echo $row->college_no;?></td>
                <td>
                    <?php
                    if($row->picture == "")
                    { ?>
                    <img src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="60">
                    <?php } else
                    { ?>
                    <img src="<?php echo base_url();?>assets/images/students/<?php echo $row->picture;?>" style="border-radius:10px;" width="60" height="60">
                    <?php } ?>
                </td>
                <td><?php echo $row->shift_name;?></td>
                <td><?php echo $row->admission_date;?></td>
                <td><?php echo $row->reserved_seat;?></td>
                <td><?php echo $row->username;?></td>
                <td><?php echo $row->entry_date;?></td>
            </tr>
                <?php endforeach;
                else:?>
                <tr>
                    <td colspan="7">
                    <strong style="color:red">Student <?php echo @$result->std_id;?> Log Report Not Found</strong>
                    </td>
                </tr>
                <?php
                endif;
                ?>
                </tbody>
                </table>
                    
                <hr>
            
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        