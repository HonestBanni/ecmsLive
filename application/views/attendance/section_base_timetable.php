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
                   <h4 align="center">Section Base Time Table: <?php 
                       $where = array('sec_id'=>$this->uri->segment(3));
                       $t = $this->CRUDModel->get_where_row('sections',$where);
                       echo $t->name;?></h4>     
                        
            <table class="table table-hover table-boxed table-bordered">
                    <tbody>
            <?php        
                if(@$result_mon):?>            
            <tr style="font-size:12px">
                <td width="80"  align="center"><strong>Monday</strong></td>
                <?php foreach($result_mon as $daym):?>
                <td width="80"  align="center"><?php echo $daym->class_stime;?> - <?php echo $daym->class_etime;?><br>
                    <?php echo $daym->title;?>
                    <br>
                     (<?php echo $daym->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <?php 
                endif;        
                if(@$result_tue):?>            
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Tuesday</strong></td>
                <?php foreach($result_tue as $daytu):?>
                <td width="80"  align="center"><?php echo $daytu->class_stime;?> - <?php echo $daytu->class_etime;?><br>
                    <?php echo $daytu->title;?>
                    <br>
                     (<?php echo $daytu->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <?php 
                endif;        
                if(@$result_wed):?>            
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Wednesday</strong></td>
                <?php foreach($result_wed as $dayw):?>
                <td width="80"  align="center"><?php echo $dayw->class_stime;?> - <?php echo $dayw->class_etime;?><br>
                    <?php echo $dayw->title;?>
                    <br>
                     (<?php echo $dayw->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <?php 
                endif;        
                if(@$result_thu):?>            
            <tr  style="font-size:12px">
                <td width="80" align="center"><strong>Thursday</strong></td>
                <?php foreach($result_thu as $dayth):?>
                <td width="80"  align="center"><?php echo $dayth->class_stime;?> - <?php echo $dayth->class_etime;?><br>
                    <?php echo $dayth->title;?>
                    <br>
                     (<?php echo $dayth->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <?php 
                endif;        
                if(@$result_fri):?>            
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Friday</strong></td>
                <?php foreach($result_fri as $dayf):?>
                <td width="80"  align="center"><?php echo $dayf->class_stime;?> - <?php echo $dayf->class_etime;?><br>
                    <?php echo $dayf->title;?>
                    <br>
                    (<?php echo $dayf->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <?php endif;    
                if(@$result_sat):?>            
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Saturday</strong></td>
                <?php foreach($result_sat as $daysat):?>
                <td width="80"  align="center"><?php echo $daysat->class_stime;?> - <?php echo $daysat->class_etime;?><br>
                    <?php echo $daysat->title;?>
                    <br>
                    (<?php echo $daysat->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <?php endif;?>  
            
                    </tbody>
                </table> 
                      </div>
                </div><!--//col-md-3-->
               
            </div><!--//cols-wrapper-->
           
            </div><!--//content-->
   