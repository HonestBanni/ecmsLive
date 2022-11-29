<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
             <?php
            if(@$result):
                foreach($result as $rec);
            ?>
            <h2 align="left">Students List Subject: <?php echo $rec->subject;?>(<?php echo count($result);?>) <hr></h2>
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
           
          <form name="std" method="post" action="AttendanceController/studentsSubjectsAtts">   
              <input type="hidden" id="class_id" name="class_id" value="<?php echo $this->uri->segment(3);?>">
              <input type="hidden" id="sec_id" name="sec_id" value="<?php echo $this->uri->segment(4);?>">
              <input type="hidden" name="subject_id" value="<?php echo $this->uri->segment(5);?>">
                  
                    <div class="form-group col-md-2">
                          <input type="date" id="attendance_date" name="attendance_date" class="form-control" required>       
                         
                    </div>
              <div class="form-group col-md-6">
                               
                                 <?php 
                                 
                                 
                                    $current_teacher=    $this->db->get_where('class_alloted',array('class_id'=>$this->uri->segment(3)))->row();
                                 echo form_dropdown('teacher_id', $teachingEmp,$current_teacher->emp_id,  'class="form-control required="required"');
                                ?>

                            </div>
                    <div class="form-group col-md-2">
                         
                        <a href="AttendanceController/admin_subject_wise_print/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5);?>" target="_blank" class="btn btn-success" ><i class="fa fa-print">  &nbsp;Print Attendance Sheet</i></a>
                    </div>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Serial No</th>
                            <th>Picture</th>
                            <th>College No</th>
                            <th>Student</th>
                            <th>Father</th>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $i = 1;
                    foreach($result as $rec)  
                    {
                    ?>
                        <tr class="gradeA">
        <td><input type="checkbox" name="checked[]" value="<?php echo $rec->student_id;?>" id="checkItem" checked>
            <input type="hidden" name="student_id"  value="0" id="student_id">
        </td>
        <td><?php echo $i;?></td>                    
        <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                            <td style="font-size: 15px;"><strong><?php echo $rec->college_no;?></strong></td>
                            <td style="font-size: 15px;"><strong><?php echo $rec->student;?></strong></td>
                            <td><?php echo $rec->father;?></td>
                            <td><?php echo $rec->subject;?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
                   <div class="form-group col-md-2">
                      <input type="submit" name="submit" value="Submit" class="btn btn-theme">
                    </div>  
                </div><!--//col-md-3-->
                </form>  
            <?php
                else:
                echo '<h2>Sorry! Students are Not Found for this Subject..</h2>';
                endif;
                ?>    
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
         <script type="text/javascript">
        jQuery(document).ready(function(){
            
            
            jQuery('#attendance_date').on('change',function(){
                var class_id        = jQuery('#class_id').val();
                var sec_id          = jQuery('#sec_id').val();
                var attendance_date = jQuery('#attendance_date').val();
                var data            = {'class_id':class_id,'sec_id':'sec_id','attendance_date':attendance_date }
                
             $.ajax({
                type   : 'post',
                url    : 'AttendanceController/check_alloted_date',
                data   : data,
                success :function(result){
                    
                    if(result == 1){
                        confirm('Are you sure to submit back date attendace') 
                    }
                    
                    } 
                    
              
            
                });
            });
     });
        
        
        </script>