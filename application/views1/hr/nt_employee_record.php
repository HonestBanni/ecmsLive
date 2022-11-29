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
        <div class="content container">
               <!-- ******BANNER****** -->
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:450px;">
                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
            <div id="div_print">
            <h3 align="center">Non Teaching Staff List</h3>
                    <table class="table table-boxed table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Picture</th>
                            <th>Emp-Name</th>
                            <th>F-Name</th>
                            <th>Designation</th>
                            <th>Academic Details</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$s = 1;                        
foreach($result as $rec)  
{  
  $picture = $rec->picture;  
    ?>
                        <tr class="gradeA">
                    <td><?php echo $s;?></td>
                            <td><?php
                    if($picture == "")
                    {?>
        <img src="assets/images/students/user.png" width="60" height="50">
                    <?php
                    }else
                    {?>
    <img src="assets/images/employee/<?php echo $rec->picture;?>" style="border-radius:10px;" width="60" height="50">
                <?php 
                    }
                    ?></td>
                    <td><?php echo $rec->emp_name;?></td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->cdesignation;?></td>
                    <td><table class="table table-boxed">
                    <thead>
                        <tr>
                            <td><strong>S.N</strong></td>
                            <td><strong>Degree</strong></td>
                            <td><strong>Institute</strong></td>
                            <td><strong>Passing Year</strong></td>
                            <td><strong>%age</strong></td>
                            <td><strong>Division</strong></td>
                        </tr>
                    </thead>
                        <tbody>
                        <?php
                        $where = array('hr_emp_education.emp_id'=>$rec->emp_id);
                        $res = $this->HrModel->hr_edu_record($where);    
                        if($res):
                        $i = 1;
                        foreach($res as $eRow):
                        
                           echo '<tr>';
                                echo '<td>'.$i.'</td>';
                                echo '<td>'.$eRow->Degreetitle.'</td>';
                                echo '<td>'.$eRow->bordTitle.'</td>';
                                echo '<td>'.$eRow->passing_year.'</td>';
                                echo '<td>'.$eRow->percentage.'%</td>';
                                echo '<td>'.$eRow->divisiontitle.'</td>';
                           echo '</tr>';
                        $i++;
                        endforeach;
                        
                        endif;
     
                        ?>   
                        </tbody></table></td>
                            
                        </tr>
<?php
    $s++;
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            
                </div>
                </div><!--//cols-wrapper-->
           
        </div><!--//content-->