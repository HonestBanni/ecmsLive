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
                
                <input type="hidden" value="<?php echo $this->uri->segment(2)?>" name="session_id"  >
                <input type="submit" name="export" class="btn btn-theme" value="Export">
                    
                <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                <a href="PracticalAttendanceSheet/<?php echo $this->uri->segment(2)?>" class="btn btn-theme" target="_blank">Print Attendance Sheet</a>
            </form>
              
                
            <div id="div_print">
            <h2 align="left">Students List<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            
                            <th>College No</th>
                            <th>Student</th>
                            <th>Section</th>
                            <th>Practical Group</th>
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
                             
                            <td><strong><?php echo $rec->college_no;?></strong></td>
                            <td><strong><?php echo $rec->student_name;?></strong></td>
                            <td><strong><?php echo $rec->section;?></strong></td>
                            <td><strong><?php echo $rec->group_name;?></strong></td>
                             
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
   