        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Monthly Tests History<hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post" action="AttendanceController/search_employee_test">
                      <div class="form-group col-md-2">
                            <input type="text" name="sec_id" placeholder="Section" class="form-control" id="sec">
                            <input type="hidden" name="sec_id" id="sec_id">
                      </div>
                      <div class="form-group col-md-2">
                            <input type="text" name="subject_id" placeholder="Subject" class="form-control" id="sub">
                            <input type="hidden" name="subject_id" id="subject_id">
                      </div>
                    <div class="form-group col-md-2">
                            <input type="date" name="test_date" class="form-control">
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
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Employee</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Test Date</th>
                            <th>View Test Marks</th>
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
                            <td><a class="btn btn-primary btn-sm" href="AttendanceController/view_test_marks_list/<?php echo $rec->test_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">View &amp; Update Test Marks</a></td>
                            <td><a class="btn btn-theme btn-sm" href="AttendanceController/print_test_marks_list/<?php echo $rec->test_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">print</a></td>
                           
                        </tr>

                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   