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
            <h2 align="left">Student Previous Attendance History<hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post">
                      <div class="form-group col-md-2">
            <?php        
                
                if(!empty($student_id)){
                    $empres = $this->AttendanceModel->get_by_id('student_record',array('student_id'=>$student_id));
                    foreach($empres as $emprec)
                    { ?>          
        <input type="text" name="student_id" value="<?php echo $emprec->student_name; ?>" placeholder="Student" class="form-control" id="student_names">
                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $emprec->student_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="student_id" placeholder="Student" class="form-control" id="student_names">
            <input type="hidden" name="student_id" id="student_id">    
                    <?php
                    }    
                ?>                  
            </div>
           
         <input type="submit" name="search" class="btn btn-theme" value="Search">
         <input type="submit" name="export" class="btn btn-theme" value="Export">
                    <button type="button" name="print" class="btn btn-theme" onClick="printdiv('div_print');">Print</button>
                </form>
            </div>
        </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                     <?php
                        if(!empty($result)):
                        ?> 
            <p>
                <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
                <div id="div_print"> 
                    <h2>Comulative Attendance Report</h2>
                <table class="table table-hover table-boxed" id="table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Program Name</th>
                            <th>Sub Programe</th>
                            <th>Section Name</th>
                            <th>Subject Name</th>
                            <th>Total Attendance</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>% Age</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php 
                $pTotal = '';    
                $tTotal = '';    
                $grandTotal = '';    
                $subjectTotal = '';    
                foreach($result as $rec)
                {
                        $pTotal += $rec->p_attend;
                        $tTotal += $rec->total_attend;
                        $grandTotal = $pTotal*100/$tTotal;
                        $p = $rec->p_attend;
                        $t = $rec->total_attend;
                        $subjectTotal = $p*100/$t;
                        ?>
            <tr class="gradeA">
                <td><?php echo $rec->student_name;?></td>
                <td><?php echo $rec->program;?></td>
                <td><?php echo $rec->sub_program;?></td>
                <td><?php echo $rec->section;?></td>
                <td><?php echo $rec->subject;?></td>
                <td><?php echo $rec->total_attend;?></td>
                <td><?php echo $rec->p_attend;?></td>
                <td><?php echo $rec->a_attend;?></td>
                <td><?php echo round($subjectTotal); ?>%</td>
            </tr>
            <?php
                
                }
            ?>
            <tr>
                     
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total </td>   
                    <td><?php echo $pTotal; ?>/<?php echo $tTotal; ?></td> 
                    <td><?php echo round($grandTotal,2);?>%</td>    
                    <td></td>    
                    <td></td>    
                  </tr>     
                    </tbody>
                </table> 
                        </div>    
                        <?php endif;?>
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
   