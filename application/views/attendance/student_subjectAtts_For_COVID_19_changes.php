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
              <input type="hidden" name="class_id" value="<?php echo $this->uri->segment(3);?>">
              <input type="hidden" name="sec_id" value="<?php echo $this->uri->segment(4);?>">
              <input type="hidden" name="subject_id" value="<?php echo $this->uri->segment(5);?>">
                  
                    <div class="form-group col-md-2">
                         <label for="name">Attendance Date</label>
                        <select class="form-control" name="attendance_date">
                         <?php
                            $m= date("m");
                            $de= date("d");
                            $y= date("Y");

                                for($i=0; $i<=7; $i++){

                                $date_is = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 
                                echo '<option value="'.$date_is.'">'.$date_is.'</option>';

                                }
                            ?>
                             </select>
                          <!--<input type="text" name="attendance_date" value="<?php echo date('Y-m-d');?>" class="form-control">-->       
                    </div>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>College No</th>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>Father</th>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $s = 1;
                    foreach($result as $rec)  
                    {
                    ?>
                        <tr class="gradeA">
            <td><input type="checkbox" name="checked[]" value="<?php echo $rec->student_id;?>" id="checkItem" checked>
            <input type="hidden" name="student_id"  value="0" id="student_id">
                            </td>                            
                            <td  style="font-size: 15px;"><strong><?php echo $rec->college_no;?></strong></td>
                            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>

                            <td  style="font-size: 15px;"><strong><?php echo $rec->student;?></strong></td>
                            <td><?php echo $rec->father;?></td>
                            <td><?php echo $rec->subject;?></td>
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
            <?php
                else:
                echo '<h2>Sorry! Students are Not Found for this Subject..</h2>';
                endif;
                ?>    
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
       