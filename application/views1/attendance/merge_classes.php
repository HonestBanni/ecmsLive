<!-- ******CONTENT****** --> 
<div class="content container">
    <!-- ******BANNER****** -->
    <h2 align="left">Classes Alloted List <hr></h2>
    <div class="row cols-wrapper">
        <div class="col-md-12">    
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight"><span class="line">Merge Classes</span></h1>
                <div class="section-content" >      
                    <div class="row">
                        <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                        <div class="col-md-12">
                            <div class="form-group">
                            <?php        
                            if(!empty($emp_id)){
                                $rooms = $this->AttendanceModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id));
                                foreach($rooms as $roomrec)
                                { ?>          
                                <input type="text" name="emp_id" value="<?php echo $roomrec->emp_name; ?>" placeholder="Employee Name" class="form-control" id="emp">
                                <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $roomrec->emp_id; ?>">      
                            <?php 
                            }     
                            }else{?>
                                <input type="text" name="emp_id" class="form-control" placeholder="Employee Name" id="emp">
                                <input type="hidden" name="emp_id" id="emp_id">
                            <?php } ?>                  
                            </div>
                              
                            <div class="form-group">
                                <input type="submit" name="search_submit" value="Search" class="btn btn-theme">
                            </div>
                        </div>  
                        <?php echo form_close(); ?>
                    </div>
                </div><!--//section-content-->
            </section>
        </div>
        <?php
        if(!empty($result)):
        ?>
        <div class="col-md-12">
            <div class="table-responsive">
                <p><button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?></button></p>
                <table class="table table-hover table-boxed" id="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>S/No</th>
                            <th>Employee Name</th>
                            <th>Section Name</th>
                            <th>Subject Name</th>
                            <th>Sub Program</th>
                            <th>Merged Group</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'mergeForm'));
                    $i=1;
                    foreach($result as $rec):
                        
                        echo '<tr class="gradeA">
                            <td><input type="checkbox" name="checked[]" value="'.$rec->class_id.'" id="checkItem"></td>
                            <td>'.$i.'</td>
                            <td style="font-size:14px;"><a href="AttendanceController/employee_timetable/'.$rec->emp_id.'" target="_blank">'.$rec->employee.'</a></td>
                            <td><a style="font-size:15px;text-decoration: underline;" href="AttendanceController/section_base_timetable/'.$rec->sec_id.'" target="_blank">'.$rec->section.'</a></td>
                            <td>'.$rec->subject.'</td>
                            <td>'.$rec->name.'</td>
                            <td>'.$rec->camg_name.'</td>
                            <td> <button type="button" id="'.$rec->class_id.'" class="btn btn-primary btn-sm timetable_details" data-toggle="modal" data-target="#viewTimeTable"> View Details </button></td>
                        </tr>';
                    $i++;
                    endforeach;
                    
                    echo '<tr class="gradeA">
                        <td colspan="4"> ';
                            echo form_dropdown('mca_id', $merge_grp, $merge_id, 'class="form-control" id="mca_id" required="required"');
                        echo '</td>
                        <td colspan="4">
                            <input type="submit" name="merge_submit" value="Update Merging" class="btn btn-theme">
                        </td>
                    </tr>';
                    echo form_close();
                    ?>
                    </tbody>
                </table> 
            </div> 
        </div><!--//col-md-3-->
        <?php
        endif;
        ?>
        
        <?php
        if(!empty($merge_result)):
            echo '<div class="col-md-12">
                <h1 class="section-heading text-highlight center">Merge Classes</h1>
                <div class="table-responsive">
                    <table class="table table-hover table-boxed" id="table">
                        <thead>
                            <tr>
                                <th>Merged Group</th>
                                <th>Employee Name</th>
                                <th>Subject Name</th>
                                <th>Merged Groups</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
                            foreach($merge_result as $res):
                                echo '<tr class="gradeA">
                                    <td>'.$res->camg_name.'</td>
                                    <td>'.$res->employee.'</td>
                                    <td>'.$res->subject.'</td>
                                    <td><strong>';
                                        $groups = $this->AttendanceModel->getclass_alloted('class_alloted', array('class_alloted.emp_id'=> $res->emp_id, 'ca_merge_id' => $res->ca_merge_id));
                                        foreach($groups as $mg):
                                            echo $mg->section.', ';
                                        endforeach;
                                    echo '</strong></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" href="AttendanceController/remove_class_merging/'.$res->ca_merge_id.'" onclick="return confirm('.'Are You Sure to Remove Merging?'.')">Remove Class Merging</a>
                                    </td>
                                </tr>';
                            endforeach;
                        echo '</tbody>
                    </table>
                </div>
            </div>';
//            echo '<pre>'; print_r($merge_result); die;
        endif;
        ?>
        
        
    </div><!--//cols-wrapper-->   
</div><!--//content-->
<div class="modal fade" id="viewTimeTable" tabindex="-1" role="dialog" aria-labelledby="viewTimeTable">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Time Table Details</h4>
            </div>
            <div class="modal-body">
                <div id="timetable_details_info"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
       jQuery('.timetable_details').on('click',function(){

            var class_id = this.id;
             jQuery.ajax({
                type:'post',
                url : 'TeacherSectionTimeTable',
                data:{'class_id':class_id},
                success:function(result){
                   jQuery('#timetable_details_info').html(result);
                }
            });

        });
    });

</script>