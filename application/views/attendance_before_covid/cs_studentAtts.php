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
            <h2 align="left">Attendance Students List Section:<?php echo $rec->section;?>(<?php echo count($result);?>) <hr></h2>
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
           
          <form name="std" method="post" action="AttendanceController/cs_studentsAtts">   
              <input type="hidden" name="class_id" value="<?php echo $this->uri->segment(3);?>">
              <input type="hidden" name="sec_id" value="<?php echo $this->uri->segment(4);?>">
                  
                    <div class="form-group col-md-2">
                        <input type="text" name="attendance_date"  class="form-control" required id="datepicker" value="<?php echo date('d-m-Y')?>" readonly="readonly">       
                          <!--<input type="date" name="attendance_date" class="form-control" required id="txtDate">-->       
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
                            <th>Section</th>
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
                            <td><?php echo $rec->college_no;?></td>
                            <td  style="font-size: 15px;"><?php echo $rec->student;?></td>
                            <td><?php echo $rec->father;?></td>
                            <td><?php echo $rec->section;?></td>
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
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        <script>
        
//        $(function(){
//                var dtToday = new Date();
//
//                var month = dtToday.getMonth() + 1;
//                var day = dtToday.getDate();
//                var year = dtToday.getFullYear();
//                if(month < 10)
//                    month = '0' + month.toString();
//                if(day < 10)
//                    day = '0' + day.toString();
//
//                var maxDate = year + '-' + month + '-' + day;
////                alert(maxDate);
//                $('#txtDate').attr('max', maxDate);
//            });
        jQuery(document).ready(function(){   
               $('#datepicker').datepicker( {
                changeMonth: false,
                changeYear: false,
                stepMonths: false,
                dateFormat: 'dd-mm-yy'
            });
            });
        </script>