<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
             <?php
//            if(@$result):
//                foreach($result as $rec);
            ?>
            <h2 align="left">Students List Subject: <?php echo $this->CRUDModel->get_where_row('subject', array('subject_id'=>$subj_id))->title;?><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg1'));?>
                    </h4>
                    <h4 style="color:green; text-align:center;">
                        <?php print_r($this->session->flashdata('success'));?>
                    </h4>
           
                <form name="std" method="post" action="AttendanceController/students_merged_atts">   
                    <input type="hidden" name="mergeId"  value="<?php echo $this->uri->segment(3)?>" id="student_id">
                  <?php 
                    $merged_groups = $this->CRUDModel->get_where_result('class_alloted', array('ca_merge_id'=>$merged_id));
                  ?>
                    <div class="form-group col-md-2">
                          <input type="text" name="attendance_date" value="<?php echo date('Y-m-d');?>" class="form-control" readonly>       
                    </div>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>College No</th>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>Father</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($merged_groups as $mgrow):
                        if($mgrow->flag == 2):
                            $where  = array('student_subject_alloted.subject_id'=>$mgrow->subject_id,'student_subject_alloted.section_id'=>$mgrow->sec_id);
                            $result = $this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where);
                        else:
                            $where      = array('student_group_allotment.section_id'=>$mgrow->sec_id);
                            $result = $this->AttendanceModel->get_studentsAtts('student_group_allotment',$where);
                        endif;
                        
                        $s = 1;
                        
                        foreach($result as $rec):
                        ?>
                            <tr class="gradeA">
                                <td>
                                    <input type="checkbox" name="checked[]" value="<?php echo $rec->student_id.','.$mgrow->class_id.','.$mgrow->sec_id.','.$mgrow->subject_id;?>" id="checkItem" checked>
                                    <!--<input type="hidden" name="student_id"  value="0" id="student_id">-->
                                     
                                </td>                            
                                <td  style="font-size: 15px;"><strong><?php echo $rec->college_no;?></strong></td>
                                <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>

                                <td  style="font-size: 15px;"><strong><?php echo $rec->student;?></strong></td>
                                <td><?php echo $rec->father;?></td>
                                <td><?php echo @$rec->section;?></td>
                            </tr>
                        <?php
                            $s++;
                        endforeach;
                    endforeach;
                    ?>
                    </tbody>
                </table>
                   
                <div class="form-group col-md-2">
                      <input type="submit" name="submit" value="Submit" class="btn btn-theme">
                    </div> 
            </form>  
                </div><!--//col-md-3-->

            <?php
//                else:
//                echo '<h2>Sorry! Students are Not Found for this Subject..</h2>';
//                endif;
                ?>    
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   