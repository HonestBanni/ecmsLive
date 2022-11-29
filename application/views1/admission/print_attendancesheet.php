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
                <div style="width:98%;float:left">
                    <h4 align="center">Attendance Sheet (<?php echo $sec->name;?>)</h4>
                </div>
            </div>    
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table style="width:100%;" border="1" id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <td width="35" align="center"><strong style="font-weight:bold;font-size:14px">S#</strong></td>
                            <td width="50" align="center"><strong style="font-weight:bold;font-size:14px">Colg #</strong></td>
                            <td width="220"><strong style="font-weight:bold;font-size:14px">Student</strong></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $s = 1;
                    foreach($result as $rec)  
                    {
                    ?>
                        <tr>
                            <td align="center"><?php echo $s;?></td>
                            <td align="center"><?php echo $rec->college_no;?></td>
                            <td><?php echo $rec->student_name;?></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
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
   