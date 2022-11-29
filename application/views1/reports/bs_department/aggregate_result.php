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
                </div>    
                <table style="width:100%; padding: 0px;">
                    <tr>
                        <td><h4>Subject: <?php echo $sec_info->subject_name;?></h4></td>
                        <td><h4 align="right">Credit Hours : 3</h4></td>
                    </tr>
                    <tr>
                        <td><h4>Teacher: <?php echo $sec_info->employee_name;?></h4></td>
                        <td></td>
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
                                <th>Mid Term Marks</th>
                                <th>Test/Assignments</th>
                                <th>Internal Marks</th>
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
                                <td>
                                <?php
                                $mid = $this->ReportsModel->get_midterm_students(array('exbd_student_id'=>$rec->student_id, 'exb_class_id'=>$rec->class_id, 'exb_test_type'=>1), 'row');
                                if(!empty($mid)):
                                    $mid_obt = $mid->exbd_omarks;
                                    $mid_ttl = $mid->exb_test_marks;
                                    $mid_aggr = $mid_obt / $mid_ttl * 25;
                                    echo round($mid_aggr).' / 25';
                                else:
                                    $mid_obt = 0;
                                    $mid_ttl  = 25;
                                endif;
                                ?>
                                </td>
                                <td>
                                <?php
                                $all = $this->ReportsModel->get_midterm_students(array('exbd_student_id'=>$rec->student_id, 'exb_class_id'=>$rec->class_id, 'exb_test_type !='=>1), 'result');
                                if(!empty($all)):
                                    $total_obt = 0;
                                    $grd_total = 0;
                                    foreach($all as $all_row):
                                        $total_obt += $all_row->exbd_omarks;
                                        $grd_total += $all_row->exb_test_marks;
                                    endforeach;
//                                    echo $total_obt.'/'.$grd_total.' ';
                                    $aggregate_total = $total_obt / $grd_total * 15;
                                    echo round($aggregate_total).' / 15';
//                                    echo '<pre>'; print_r($all); echo '</pre>';
                                endif;
                                ?>
                                </td>
                                <td>
                                <?php
                                $internal_obt = $total_obt + $mid_obt;
                                $internal_ttl = $grd_total + $mid_ttl;
                                $internal_aggr = $internal_obt / $internal_ttl * 40;
                                
                                echo round($internal_aggr).' / 40';
                                ?>
                                </td>
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
   