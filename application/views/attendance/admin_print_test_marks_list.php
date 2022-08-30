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
                  <h1 class="heading-title pull-left">Print Test Marks List</h1>
                </header>
            </div>
            <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
            <div id="div_print">
            <div class="row cols-wrapper">
                <div class="col-md-12">  
                    <h4><strong>Teacher: <?php echo $empRecord->emp_name;?>, Section: <?php echo $section->name;?>, Subject: <?php echo $subject->title;?>   
                    </strong>
                    </h4>
            <?php $test_id = $this->uri->segment(3);
            $total = $this->db->query("SELECT * FROM monthly_test_details WHERE test_id = '$test_id'");?>
                    <table class="datatable-1 table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>College No</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Obt-Marks</th>
                        <th>T-Marks</th>
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
                <td><?php echo $rec->college_no;?></td>
                <td><?php echo $rec->student_name;?></td>
                <td><?php echo $rec->father_name;?></td>
                <td><?php echo $rec->omarks;?></td>
                <td><?php echo $rec->tmarks;?></td> 
            </tr>
                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
                  <?php echo $print_log;?>  
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
            </div>
        </div><!--//content-->
   