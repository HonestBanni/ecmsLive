<div class="content container">
    <h2 align="left">Admin Pre Board Test History<hr></h2>
        <div class="row cols-wrapper">
            <div class="col-md-12">
                <form method="post" action="AttendanceController/search_admin_pre_board_test">
                    <div class="form-group col-md-2">
            <?php
                $gres = $this->AttendanceModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id));
                if($gres){
                    foreach($gres as $grec)
                    { ?>          
        <input type="text" name="emp_id" value="<?php echo $grec->emp_name; ?>" placeholder="Employee" class="form-control" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $grec->emp_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="emp_id" placeholder="Employee" class="form-control" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id">    
                    <?php
                    }    
                ?>                  
            </div>
                    
            <div class="form-group col-md-2">
                <?php
                    $gres = $this->AttendanceModel->get_by_id('sections',array('sec_id'=>$sec_id));
                    if($gres){
                        foreach($gres as $grec)
                        { ?>          
            <input type="text" name="sec_id" value="<?php echo $grec->name; ?>" placeholder="Section" class="form-control" id="sec">
                        <input type="hidden" name="sec_id" id="sec_id" value="<?php echo $grec->sec_id; ?>">      
                        <?php 
                        }     
                    }else{?>
                    <input type="text" name="sec_id" placeholder="Section" class="form-control" id="sec">
                            <input type="hidden" name="sec_id" id="sec_id">    
                        <?php
                        }    
                    ?>                  
            </div>
                    
            <div class="form-group col-md-2">
                <?php
                    $gres = $this->AttendanceModel->get_by_id('subject',array('subject_id'=>$subject_id));
                    if($gres){
                        foreach($gres as $grec)
                        { ?>          
            <input type="text" name="subject_id" value="<?php echo $grec->title; ?>" placeholder="Subject" class="form-control" id="sub">
                        <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $grec->subject_id; ?>">      
                        <?php 
                        }     
                    }else{?>
                   <input type="text" name="subject_id" placeholder="Subject" class="form-control" id="sub">
                            <input type="hidden" name="subject_id" id="subject_id">   
                        <?php
                        }    
                    ?>                  
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
                            <th>Employee</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Attendance Date</th>
                            <th>View</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                        $date = $rec->test_date;
            $newDate = date("d-m-Y", strtotime($date));
                         
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->employee;?></td>
                            <td><?php echo $rec->subject;?></td>
                            <td><?php echo $rec->section;?></td>
                            <td><?php echo $newDate;?></td>
                            <td><a href="AttendanceController/admin_view_pre_board_test_marks/<?php echo $rec->test_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">View Pre Board Test Marks</a></td>
                            <td><a class="btn btn-primary btn-sm" href="AttendanceController/admin_print_pre_board_test_marks/<?php echo $rec->test_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">Print</a></td>
                           
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->  
        </div><!--//content-->
   