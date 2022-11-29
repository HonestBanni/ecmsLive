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
                <div class="col-md-12">
                    <h4 align="center">EDWARDES COLLEGE PESHAWAR</h4>
                    <h4 align="center"><?php echo $sec_info->sub_pro_name.' &nbsp; '.$sec_info->batch_name;?></h4>
                    <h4 align="center"><?php echo $sec_info->xt_title;?></h4>
                </div>    
                <table style="width:100%; padding: 0px;">
                    <tr>
                        <td><h4>Subject: <?php echo $sec_info->subject_name;?></h4></td>
                        <td><h4 align="right">Credit Hours : 3</h4></td>
                    </tr>
                    <tr>
                        <td><h4>Teacher: <?php echo $sec_info->employee_name;?></h4></td>
                        <td><h4 align="right">Total Marks: <?php echo $sec_info->exb_test_marks;?></h4></td>
                    </tr>
                </table>
                <div class="row cols-wrapper">
                    <div class="col-md-12">

                        <table class="table table-boxed table-bordered">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>College No</th>
                                <th>Enrollment No.</th>
                                <th>Student Name</th>
                                <th>Obtained Marks</th>
                                <th>In Words</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                        $s = 1;
                        foreach($result as $rec){
                        ?>
                            <tr class="gradeA">
                                <td><?php echo $s;?></td>
                                <td><?php echo $rec->college_no;?></td>
                                <td><?php echo $rec->bs_enrollment_no; ?></td>
                                <td><?php echo $rec->student_name;?></td>
                                <td><?php echo $rec->exbd_omarks; ?></td>
                                <td><?php echo $this->CRUDModel->numtowords($rec->exbd_omarks); ?></td>
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
   