<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body><p></p>";
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
                <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
            </form>
            <div id="div_print">
            <div style="width:100%">
                <div style="width:48%;float:left">
                    <h4 align="Left">Students Award list</h4>
                    <h4 align="Left">Section Name: <?php echo $sec->name;?></h4>
                </div>
                <div style="width:48%;float:right">
                    <h4 align="center">Teacher Name: ......................................</h4>
                    <h4 align="center">Subject Name: ......................................</h4>
                    <h4 align="center">&nbsp;&nbsp;&nbsp;Total Marks: ......................................</h4>
                </div>
            </div>    
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S#</th>
                            <th>College No</th>
                            <th>Enrollment No</th>
                            <th>Student</th>
                            <th>Obt.Marks</th>
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
                            <td><?php echo $rec->college_no;?></td>
                            <td><?php echo $rec->bs_enrollment_no;?></td>
                            <td><?php echo $rec->student_name;?></td>
                            <td></td>
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
   