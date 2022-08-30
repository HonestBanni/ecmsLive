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
                <h3 align="center">Class / Section: <?php echo $sec->name;?></h3>
            </div>    
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">S#</th>
                            <th width="6%">Picture</th>
                            <th width="5%">Clg #</th>
                            <th width="17%">Student Name</th>
                            <th width="17%">Father Name</th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                            <th width="10%"></th>
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
                            <td><?php echo $rec->college_no;?></td>
                            <td><?php echo $rec->student_name;?></td>
                            <td><strong><?php echo $rec->father_name;?></strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
   