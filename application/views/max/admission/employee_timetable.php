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
               <!-- ******BANNER****** -->
            <h2 align="left">View Time Table <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button><hr></h2>
            <div class="row cols-wrapper">
                  <div class="col-md-12">  
                      <div id="div_print">
                   <h4 align="center">Teacher Name: <?php 
                       $where = array('emp_id'=>$this->uri->segment(3));
                       $t = $this->CRUDModel->get_where_row('hr_emp_record',$where);
                       echo $t->emp_name;?></h4>     
                        
            <table class="table table-hover table-boxed table-bordered">
                    <tbody>
            <tr style="font-size:12px">
                <td width="80"  align="center"><strong>Monday</strong></td>
                <?php foreach($result_mon as $daym):?>
                <td width="80"  align="center"><?php echo $daym->class_stime;?> - <?php echo $daym->class_etime;?><br>
                     (<?php echo $daym->name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Tuesday</strong></td>
                <?php foreach($result_tue as $daytu):?>
                <td width="80"  align="center"><?php echo $daytu->class_stime;?> - <?php echo $daytu->class_etime;?><br>
                     (<?php echo $daytu->name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Wednesday</strong></td>
                <?php foreach($result_wed as $dayw):?>
                <td width="80"  align="center"><?php echo $dayw->class_stime;?> - <?php echo $dayw->class_etime;?><br>
                     (<?php echo $dayw->name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80" align="center"><strong>Thursday</strong></td>
                <?php foreach($result_thu as $dayth):?>
                <td width="80"  align="center"><?php echo $dayth->class_stime;?> - <?php echo $dayth->class_etime;?><br>
                     (<?php echo $dayth->name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Friday</strong></td>
                <?php foreach($result_fri as $dayf):?>
                <td width="80"  align="center"><?php echo $dayf->class_stime;?> - <?php echo $dayf->class_etime;?><br>
                    (<?php echo $dayf->name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
                    </tbody>
                </table> 
                      </div>
                </div><!--//col-md-3-->
               
            </div><!--//cols-wrapper-->
           
            </div><!--//content-->
   