<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
             <?php
                foreach($result as $rec);
            ?>
            <h2 align="left">Attendance Students List Group:<?php echo @$rec->group_name;?>(<?php echo count($result);?>) <hr></h2>
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
           
          <form name="std" method="post" action="AttendanceController/admin_practical_studentsAtts">   
              <input type="hidden" name="prac_class_id" value="<?php echo $this->uri->segment(3);?>">
              <input type="hidden" name="group_id" value="<?php echo $this->uri->segment(4);?>">
                  
                    <div class="form-group col-md-2">
                          <input type="date" name="attendance_date" class="form-control">       
                    </div>
              
              <div class="form-group col-md-6">
                               
                                 <?php 
                                 $current_teacher=    $this->db->get_where('practical_alloted',array('practical_class_id'=>$this->uri->segment(3)))->row();
                                 echo form_dropdown('teacher_id', $teachingEmp,$current_teacher->emp_id,  'class="form-control required="required"');
                                ?>

                            </div>
                    <a href="AttendanceController/admin_practical_attendance_sheet/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>" target="_blank" class="btn btn-success"><i class="fa fa-print">  &nbsp;Print Attendance Sheet</i></a>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th> 
                            <th>Serial No</th>
                            <th>College No</th>
                            <th>Student</th>
                            <th>Group</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $s = 1;
                    foreach($result as $rec)  
                    {
                    ?>
                        <tr class="gradeA">
    <td>
        <input type="checkbox" name="checked[]" value="<?php echo $rec->college_no;?>" id="checkItem" checked>
            <input type="hidden" name="college_no"  value="0" id="college_no">
            <input type="hidden" name="student_name"  value="0" id="student_name"></td>
            <td><?php echo $s;?></td>
            <td  style="font-size: 15px;"><strong><?php echo $rec->college_no;?></strong></td>
            <td  style="font-size: 15px;"><strong><?php echo $rec->student_name;?></strong></td>
            <td><?php echo $rec->group_name;?></td>
                        </tr>
                    <?php
                        $s++;
                    }
                    ?>
                    </tbody>
                </table>
                   <div class="form-group col-md-2">
                      <input type="submit" name="submit" value="Submit" class="btn btn-theme">
                    </div>  
                </div><!--//col-md-3-->
                </form>  
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   