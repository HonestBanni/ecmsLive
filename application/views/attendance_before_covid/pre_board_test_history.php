    <!-- ******CONTENT****** --> 
    <div class="content container">
           <!-- ******BANNER****** -->
        <h2 align="left">Pre Board Tests History<hr></h2>
      
    <div class="row cols-wrapper">
        <div class="col-md-12">
             <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
            <?php if(@$result):?>
            <table class="table table-boxed table-bordered table-striped">
            <thead>
        <tr>
            <th>Serial No</th>
            <th>Employee</th>
            <th>Subject</th>
            <th>Section</th>
            <th>Test Date</th>
            <th>View</th>
            <th>Print</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
        foreach($result as $rec)  
        {
            $date = $rec->test_date;
            $newDate = date("d-m-Y", strtotime($date));
            ?>
            <tr class="gradeA">
                <td><?php echo $i;?></td>
                <td><?php echo $rec->emp_name;?></td>
                <td><?php echo $rec->title;?></td>
                <td><?php echo $rec->name;?></td>
                <td><?php echo $newDate;?></td>
                <td><a class="btn btn-primary btn-sm" href="AttendanceController/view_pre_board_test_marks/<?php echo $rec->test_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">
                    View &amp; Update Test Marks List</a></td>
                <td><a class="btn btn-theme btn-sm" href="AttendanceController/print_pre_board_test_marks/<?php echo $rec->test_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">Print</a></td> 
            </tr>
                <?php
                $i++;
                }
                ?>
            </tbody>
        </table>
            <?php
            else:
                echo '<h2 style="color:red">Sorry ! Record Not Found..</h2>';
            endif;
            ?>
        </div><!--//col-md-3-->

    </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   