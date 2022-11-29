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
<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <form method="post">
                <input type="submit" name="export" class="btn btn-theme" value="Export">
                <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                <a href="Admin/print_studentGroup/<?php echo $this->uri->segment(3);?>" target="_blank" class="btn btn-theme">Print Award List</a>
                <a href="Admin/print_attendancesheet/<?php echo $this->uri->segment(3);?>" target="_blank" class="btn btn-theme">Print Attendance Sheet</a>
            </form>
            <div id="div_print">
            <h2 align="left">Students List<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Picture</th>
                            <th>College No</th>
                            <th>Form No</th>
                            <th>Student</th>
                            <th>Father</th>
                            <th>Section</th>
                            <th>T.Marks</th>
                            <th>O.Marks</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $s = 1;
                    foreach($result as $rec)  
                    {
                    ?>
                        <tr class="gradeA">
                            <td><?php echo $s;?></td>
                            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                            <td><strong><?php echo $rec->college_no;?></strong></td>
                            <td><strong><?php echo $rec->form_no;?></strong></td>
                            <td><strong><?php echo $rec->student_name;?></strong></td>
                            <td><strong><?php echo $rec->father_name;?></strong></td>
                            <td><strong><?php echo $rec->name;?></strong></td>
                            <td><strong><?php echo $rec->total_marks;?></strong></td>
                            <td><strong><?php echo $rec->obtained_marks;?></strong></td>
                            <td><strong><?php echo substr($rec->percentage,0,6);?></strong></td>
                        </tr>
                    <?php
                        $s++;
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div><!--//cols-wrapper-->
            </div>
        </div><!--//content-->
   