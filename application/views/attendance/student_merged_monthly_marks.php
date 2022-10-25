<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
     .ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span{
          display: none;
      }
      .ui-datepicker .ui-datepicker-prev-hover{
          display: none;
      }
      .ui-datepicker .ui-datepicker-next-hover{
         display: none; 
      }

.blink_text { 

        -webkit-animation-name: blinker;
 -webkit-animation-duration: 1s;
 -webkit-animation-timing-function: linear;
 -webkit-animation-iteration-count: infinite;

 -moz-animation-name: blinker;
 -moz-animation-duration: 1s;
 -moz-animation-timing-function: linear;
 -moz-animation-iteration-count: infinite;
 animation-name: blinker;
 animation-duration: 2s;
 animation-timing-function: linear; 
    animation-iteration-count: infinite; color: red; 
} 

@-moz-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
} 

@keyframes blinker {  
    0% { opacity: 1.0; } 
    50% { opacity: 0.0; }      
    100% { opacity: 1.0; } 
} 
</style>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students List for Subject : <?php echo $this->CRUDModel->get_where_row('subject', array('subject_id'=>$subj_id))->title;?> <hr></h2>
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
           <strong style="color:red;margin-left:60px;font-size:20px;">
                        <i class="fa fa-arrow-down fa-2x blink_text" aria-hidden="true"></i>  Please Select Correct "Test Month" from the Month List Pointed by Blinking Arrow.</strong>
          <form name="std" method="post" action="AttendanceController/students_merged_monthly_marks">   
                <input type="hidden" name="mergeId"  value="<?php echo $this->uri->segment(3)?>" id="student_id">
                  <?php 
                    $merged_groups = $this->CRUDModel->get_where_result('class_alloted', array('ca_merge_id'=>$merged_id));
                  ?>
                  
           <div class="form-group col-md-2">
                <label>Month</label>
                
                 <?php 
                    echo form_dropdown('month', $month, '',  'class="form-control" required="required"');
                ?>  </div>
            <div class="form-group col-md-2">
                <label>Year</label>
                
                 <?php 
                    echo form_dropdown('year', $year, $yearId,  'class="form-control" readonly="readonly" required="required"');
                ?>
                       
            </div>
            <div class="form-group col-md-2">
                <label>Total Marks</label>
                <select name="tmarks" id="tmarks" class="form-control">
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <option value="35">35</option>
                    <option value="40">40</option>
                </select>  
             </div>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Picture</th>
                            <th>College No</th>
                            <th>Student</th>
                            <th>Obtained Marks</th>
                            <th>Father</th>
                            <!--<th>Subject</th>-->
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
                    foreach($result as $rec)  
                    {
                    ?>
        <tr class="gradeA">
            <td><?php echo $s;?></td>
            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
            <td   style="font-size: 15px;"><strong><?php echo $rec->college_no;?></strong></td>
            <td  style="font-size: 15px;"><strong><?php echo $rec->student;?></strong>
         <input type="hidden" name="student_id[]"  value="<?php echo $rec->student_id;?>" id="student_id">
         <input type="hidden" name="cls_id[]"  value="<?php echo $mgrow->class_id;?>" id="student_id">
            </td>
            <td>
            <input type="text" name="omarks[]" placeholder="Obtained Marks" class="form-control checkINput"></td>
            <td><?php echo $rec->father;?></td>
            <!--<td><?php// echo $rec->subject;?></td>-->
            <td><?php echo @$rec->section;?></td>
        </tr>
                    <?php
                        $s++;
                    }
                    endforeach;
                    ?>
                    </tbody>
                </table>
                   <div class="form-group col-md-2">
                      <input type="submit" name="submit" value="Submit" class="btn btn-theme">
                    </div>  
                </form> 
                </div><!--//col-md-3--> 
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
    