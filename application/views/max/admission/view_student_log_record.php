        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Log Report<hr></h2>
            <div class="row cols-wrapper">
                 
        <table class="table table-boxed table-bordered table-striped display">
            <thead>
                <tr>
                <td colspan="11" align="center">
                <strong style="font-size:15px;">Student Current Record</strong>
                </td>
            </tr>
                <tr>
                    <th>Curr. Name</th>
                    <th>Curr. Form #</th>
                    <th>Curr. College #</th>
                    <th>Curr. Sub Program</th>
                    <th>Curr. Batch</th>
                    <th>Curr. Seat</th>
                    <th>Curr. Domicile</th>
                    <th>Curr. Mobile# 1</th>
                    <th>Curr. Mobile# 2</th>
                    <th>User Name</th>
                    <th>Curr. Date &amp; Time</th>
                </tr>
            </thead>
            <tbody>      
            <tr class="gradeA">
                <td><?php echo $result->student_name;?></td>
                <td><?php echo $result->form_no;?></td>
                <td><?php echo $result->college_no;?></td>
                <td><?php echo $result->sub_program;?></td>
                <td><?php echo $result->batch;?></td>
                <td><?php echo $result->seat;?></td>
                <td><?php echo $result->domicile;?></td>
                <td><?php echo $result->mobile_no;?></td>
                <td><?php echo $result->mobile_no2;?></td>
                <td><?php  
                    $where_id = array('id'=>$result->user_id);
                    $res = $this->get_model->get_by_id_User('users',$where_id);
                    echo $res->emp_name;
                    ?></td>
                <td><?php 
                    $date1 = $result->timestamp;
                    $newDate1 = date("d-m-Y H:i:s", strtotime($date1));
                    echo $newDate1;?></td>
            </tr>
            <?php
                if(@$log):
                
            ?>    
            <tr>
                <td colspan="11" align="center">
                <strong style="font-size:15px;">Student Old Log Report</strong>
                </td>
            </tr>
            <tr>
                <th>Old Name</th>
                <th>Old Form #</th>
                <th>Old College #</th>
                <th>Old Sub Program</th>
                <th>Old Batch</th>
                <th>Old Seat</th>
                <th>Old Domicile</th>
                <th>Old Mobile# 1</th>
                <th>Old Mobile# 2</th>
                <th>User Name</th>
                <th>Old Date &amp; Time</th>
            </tr>
         <?php
            foreach($log as $row):
                $student_id = $row->student_id;
                $student_name = $row->student_name;
                $date = $row->timestamp;
                $newDate = date("d-m-Y H:i:s", strtotime($date));
                $id = $row->user_id;
                $where_id = array('id'=>$id);
                $gres = $this->get_model->get_by_id_User('users',$where_id);
            ?>   
            <tr>
                <td><?php echo $student_name;?></td>
                <td><?php echo $row->form_no;?></td>
                <td><?php echo $row->college_no;?></td>
                <td><?php echo $row->sub_program;?></td>
                <td><?php echo $row->batch;?></td>
                <td><?php echo $row->seat;?></td>
                <td><?php echo $row->domicile;?></td>
                <td><?php echo $row->mobile_no;?></td>
                <td><?php echo $row->mobile_no2;?></td>
                <td><?php echo $gres->emp_name;?></td>
                <td><?php echo $newDate;?></td>
            </tr>
                <?php endforeach;
                else:?>
                <tr>
                    <td colspan="11">
                    <strong style="color:red">Student <?php echo $result->student_name;?> Log Report Not Found</strong>
                    </td>
                </tr>
                <?php
                endif;
                ?>
                </tbody>
                </table>
                    
                <hr>
            <h3 align="left">New Academic Record</h3>
              <?php 
                    if($student_records):
                ?>
                <table class="table table-bordered table-striped table-boxed">
                    <thead>
                        <tr>
                            <td colspan="11" align="center">
                            <strong style="font-size:15px;">Current Academic Record</strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Curr. Institute</th>
                            <th>Curr. Total Marks</th>
                            <th>Curr. Obt. Marks</th>
                            <th>Curr. %age</th>
                            <th> User Name</th>
                            <th>Curr. Date &amp; Time</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        foreach($student_records as $rec):
                            $userid = $rec->inserteduser;;
                            $where_id = array('id'=>$userid);
                            $guser = $this->get_model->get_by_id_User('users',$where_id);
                            
                            $date4 = $rec->timestamp;
                            $newDate4 = date("d-m-Y H:i:s", strtotime($date4));
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->inst_id;?></td>
                            <td><?php echo $rec->total_marks;?></td>
                            <td><?php echo $rec->obtained_marks;?></td>
                            <td><?php echo $rec->percentage;?> %</td>
                            <td><?php echo $guser->emp_name;?></td>
                            <td><?php echo $newDate4;?></td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                        <tr>
                <td colspan="8" align="center">
                <strong style="font-size:15px;">Old Academic Log Report</strong>
                </td>
            </tr>
                <?php 
                endif;
                if($student_record_logs):
                ?>
                    <thead>
                        <tr>
                            <th>Old Institute</th>
                            <th>Old Total Marks</th>
                            <th>Old Obtained Marks</th>
                            <th>Old %age</th>
                            <th>User Name</th>
                            <th>Old Date &amp; Time</th>
                        </tr>
                    </thead>
                       <?php
                        foreach($student_record_logs as $recd):
                            $user_id = $recd->user_id;
                            $where_id = array('id'=>$userid);
                            $guser_id = $this->get_model->get_by_id_User('users',$where_id);
                        
                            $date3 = $recd->timestamp;
                            $newDate3 = date("d-m-Y H:i:s", strtotime($date3));
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $recd->inst_id;?></td>
                            <td><?php echo $recd->total_marks;?></td>
                            <td><?php echo $recd->obtained_marks;?></td>
                            <td><?php echo $recd->percentage;?></td>
                            <td><?php echo $guser_id->emp_name;?></td>
                            <td><?php echo $newDate3;?></td>
                        </tr>
                        <?php 
                        endforeach;
                        else:
                        ?>
                    <tr>
                        <td colspan="8">
    <strong style="color:red"><?php echo "Sorry ! Academic Log Report Not Found.";?></strong></td>
                    </tr>
                        <?php   
                endif;?>
                        
                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        