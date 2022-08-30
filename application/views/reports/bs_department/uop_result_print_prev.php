<script language="javascript">
//function printdiv(printpage)
//{
//var headstr = "<html><head><title></title></head><body><p></p>";
//var footstr = "</body>";
//var newstr = document.all.item(printpage).innerHTML;
//var oldstr = document.body.innerHTML;
//document.body.innerHTML = headstr+newstr+footstr;
window.print();
//window.onafterprint = window.close();
//document.body.innerHTML = oldstr;
//return false;
//}
//$(document).ready(function(){
//    window.print();
//});
</script>

<style>
    body {
  margin: 0;
  padding: 0;
  /*background-color: #FAFAFA;*/
  font: 12pt "Calibri";
}

* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.page {
  width: 21cm;
  min-height: 29.7cm;
  padding: 0cm 0.5cm;
  margin: 10px auto;
/*  border: 1px #D3D3D3 solid;
  border-radius: 5px;*/
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.subpage {
  padding: 0cm 0.5cm;
  /*border: 5px red solid;*/
  height: 256mm;
  /*outline: 2cm #FFEAEA solid;*/
}

.btable {
    border: 1px solid #000;
    border-collapse: collapse;
}

.btable tr td {
    border: 1px solid #000;
    border-collapse: collapse;
    padding: 5px;
}

.btable tr th {
    border: 1px solid #000;
    border-collapse: collapse;
    padding: 5px;
    text-align: left;
}

footer p {
  text-align: right;
  font-size: 16px;
}

@page {
  size: A4;
  margin: 1cm 0cm 2cm;
}

@media print {
  .page {
/*    margin-bottom: 100px;
    padding-bottom: 100px;*/
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    /*page-break-after: always;*/
    page-break-before: auto;
  }
  .footer-repeat {
    display: table-footer-group;
   }
/*  .footer {
        z-index: 1;
        position: fixed;
        left: 0;
        bottom: 0;
        text-align: left;
        left: 0;
        width:100%;
        display:block;
    } */
}
</style>

<!-- ******CONTENT****** --> 
        <div id="div_print">
            <div class="page">
                <div class="subpage">
                    <h3 align="center" style="margin: auto 0px; padding-bottom: 0px;"><?php echo $sec_info->sub_pro_name.' &nbsp; '.$sec_info->batch_name;?></h3>
                    <h3 align="center" style="margin: auto 0px; padding-top: 0px;">EDWARDES COLLEGE PESHAWAR</h3>  
                    <p>&nbsp;</p>
                    <table style="width:100%; padding: 0px;">
                        <tr>
                            <td><h3><?php echo $sec_info->subject_name;?></h3></td>
                            <td><h3 align="right">Credit Hours : 3</h3></td>
                        </tr>
                    </table>

                    <table  style="width:100%; padding: 0px;">
                        <thead>
                            <tr>
                                <td width="15%"><strong style="font-size: 17px;">Enrollment</strong></td>
                                <td width="40%"><strong style="font-size: 17px;">Student Name</strong></td>
                                <td width="20%"><strong style="font-size: 17px;">Internal Marks</strong></td>
                                <td width="25%"><strong style="font-size: 17px;">In Words</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($result as $rec){
                        ?>
                            <tr class="gradeA">
                                <td><?php echo $rec->bs_enrollment_no; ?></td>
                                <td><?php echo $rec->student_name;?></td>
                                <td>
                                <?php
                                $mid = $this->ReportsModel->get_midterm_students_prev(array('exbd_student_id'=>$rec->student_id, 'exb_class_id'=>$rec->exb_class_id, 'exb_test_type'=>1), 'row');
                                if(!empty($mid)):
                                    $mid_obt = $mid->exbd_omarks;
                                    $mid_ttl = $mid->exb_test_marks;
                                    $mid_aggr = $mid_obt / $mid_ttl * 25;
//                                    echo round($mid_aggr).' / 25';
                                else:
                                    $mid_obt = 0;
                                    $mid_ttl  = 25;
                                endif;
                                
                                $all = $this->ReportsModel->get_midterm_students_prev(array('exbd_student_id'=>$rec->student_id, 'exb_class_id'=>$rec->exb_class_id, 'exb_test_type !='=>1), 'result');
                                if(!empty($all)):
                                    $total_obt = 0;
                                    $grd_total = 0;
                                    foreach($all as $all_row):
                                        $total_obt += $all_row->exbd_omarks;
                                        $grd_total += $all_row->exb_test_marks;
                                    endforeach;
//                                    echo $total_obt.'/'.$grd_total.' ';
                                    $aggregate_total = $total_obt / $grd_total * 15;
//                                    echo round($aggregate_total).' / 15';
//                                    echo '<pre>'; print_r($all); echo '</pre>';
                                endif;
                                
                                $internal_obt = $total_obt + $mid_obt;
                                $internal_ttl = $grd_total + $mid_ttl;
                                $internal_aggr = $internal_obt / $internal_ttl * 40;
                                
                                echo round($internal_aggr);
                                ?>
                                </td>
                                <td><?php echo $this->CRUDModel->numtowords(round($internal_aggr)); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                        <tfoot class="footer-repeat">
                            <!-- add repeated tfoot for extra space -->
                            <tr class="no-border">
                                <td colspan="4"><p style="text-align: right; padding-top: 50px;">Signature: _____________________</p></td>
                            </tr>
                         </tfoot>
                    </table>
                        
                    
                </div>
            </div>
<!--            <footer style="display: block;">
                <p style="text-align: right">Signature: _____________________</p>
            </footer>-->
        </div><!--//content-->