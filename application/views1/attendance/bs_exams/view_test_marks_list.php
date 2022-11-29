<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
        <div class="content container">
            <div class="page-wrapper">
            <header class="page-heading clearfix">
                  <h1 class="heading-title pull-left">View Test Marks List</h1>
                </header>
            </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">  
                     <?php $id = $this->uri->segment(3)?>   
<!--
                <form method="post" action="AttendanceController/view_test_marks_list/<?php echo $id;?>">  
            <input type="submit" name="export" value="export In Excel" class="btn btn-theme">
            <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>            
                </form>        
-->
    <?php 
        $ex_id      = $this->uri->segment(3);
        $emp_id     = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id     = $this->uri->segment(6);
        
         $total = $this->db->query("SELECT * FROM exams_bs_details WHERE exbd_test_id = '$ex_id'");?>
                    <div id="div_print">
                        <h4><strong>Teacher: <?php echo $empRecord->emp_name;?>,&nbsp; Section: <?php echo $section->name;?>,&nbsp; Subject: <?php echo $subject->title;?>  ,&nbsp; Exam Type: <?php echo $test->xt_title;?>   
                    </strong>, [<strong>Total Student: <?php  echo $total->num_rows(); ?></strong>]</h4>    
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Student Picture</th>
                            <th>College No</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Obt-Marks</th>
                            <th>T-Marks</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $i = 1;
                    foreach($result as $rec)  
                    {
                        ?>
                        <tr class="gradeA">
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                <td><?php echo $rec->college_no;?></td>
                <td><?php echo $rec->student_name;?></td>
                <td><?php echo $rec->father_name;?></td>
                <td><?php echo $rec->omarks;?></td>
                <td><?php echo $rec->tmarks;?></td>   
                <td><a href="AttendanceController/update_exam_marks/<?php echo $rec->serial_no; ?>/<?php echo $ex_id; ?>/<?php echo $emp_id; ?>/<?php echo $subject_id; ?>/<?php echo $sec_id; ?>" class="btn btn-theme btn-sm">Update</a></td>   
                        </tr>
                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
                    </div>  
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   