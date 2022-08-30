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
            <h2 align="left">Student Previous Attendance and Marks (HND)<hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post">
                      <div class="form-group col-md-2">
            <?php        
                
                if(!empty($student_id)){
                    $empres = $this->AttendanceModel->get_by_id('student_record',array('student_id'=>$student_id));
                    foreach($empres as $emprec)
                    { ?>          
        <input type="text" name="student_id" value="<?php echo $emprec->student_name; ?>" placeholder="Student" class="form-control" id="std_id">
                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $emprec->student_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="student_id" placeholder="Student" class="form-control" id="std_id">
            <input type="hidden" name="student_id" id="student_id">    
                    <?php
                    }    
                ?>                  
            </div>
            
         <input type="submit" name="search" class="btn btn-theme" value="Search">
                    <button type="button" name="print" class="btn btn-theme" onClick="printdiv('div_print');">Print</button>
                </form>
            </div>
        </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <div id="div_print"> 
                     <?php
                        if(@$sub_program):
                        foreach($sub_program as $SubPro):
                        ?>          
        <h3 align="center">Student Previous Attendance and Marks (HND)</h3>
        
        <table class="table table-hover table-boxed table-bordered">
            <thead>
                <tr>
                    <th colspan="2">Name: <?php echo $std->student_name;?></th>
                    <th>F-Name: <?php echo $std->father_name;?></th>
                    <th>College#: <?php echo $std->college_no;?></th>
                    <th>Programe: <?php echo $std->program;?></th>
                    <th colspan="2">Class Name: <?php echo $SubPro->name;?></th>
                </tr>
            </thead>
                    <thead>
                        <tr>
                        <td colspan="7" align="center" style="color:red">
                            <strong>Student Attendance Comulative</strong></td>
                        </tr>
                        <tr>
                            <td><strong>S.N</strong></td>
                            <td><strong>Section Name</strong></td>
                            <td><strong>Subject Name</strong></td>
                            <td><strong>Absent</strong></td>
                            <td><strong>Present</strong></td>
                            <td><strong>Total</strong></td>
                            <td><strong>% Age</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php  
                $pTotal = '';    
                $aTotal = '';    
                $tTotal = '';    
                $grandTotal = '';    
                $subjectTotal = '';
                        $i= 1;
                    $where = array('student_comulative_attendance.sub_pro_id'=>$SubPro->sub_pro_id,'student_comulative_attendance.student_id'=>$std->student_id);
    $query = $this->AttendanceModel->student_attend_historyn('student_comulative_attendance',$where);
    if($query):                    
            foreach($query as $rec){ 
                $pTotal += $rec->p_attend;
                $aTotal += $rec->a_attend;
                $tTotal += $rec->total_attend;
                $grandTotal = $pTotal*100/$tTotal;
                $p = $rec->p_attend;
                $t = $rec->total_attend;
                if($t>0):
                      $subjectTotal = $p*100/$t;
                else:
                    $subjectTotal = 0;
                endif;
              
                ?>
            <tr class="gradeA">
                <td><?php echo $i;?></td>
                <td><?php echo $rec->section;?></td>
                <td><?php echo $rec->subject;?></td>
                <td><?php echo $rec->a_attend;?></td>
                <td><?php echo $rec->p_attend;?></td>
                <td><?php echo $rec->total_attend;?></td>
                <td><?php echo round($subjectTotal); ?>%</td>
            </tr>
            <?php
                $i++;
                }
            ?>
            <tr>
                    
                    <td colspan="3" align="center"><strong>Total</strong> </td>   
                    <td><strong><?php echo $aTotal; ?></strong></td> 
                    <td><strong><?php echo $pTotal; ?></strong></td> 
                    <td><strong><?php echo $tTotal; ?></strong></td> 
                    <td><strong><?php echo round($grandTotal,2);?>%</strong></td>
                  </tr>
            <?php else:?>        
            <tr>
                <td colspan="7" align="center" style="color:red">
                    <strong>Record Not Found..</strong>
                </td>            
            </tr>
            <?php endif;?>            
                  <tr>
                        <td colspan="7" align="center" style="color:red"><strong>Student Monthly Marks Comulative</strong></td>
                    </tr>
                    <tr>
                            <th>S.N</th>
                            <th>Section Name</th>
                            <th>Subject Name</th>
                            <th>Total Test</th>
                            <th>O.Marks</th>
                            <th>T.Marks</th>
                            <th>Total</th>
                        </tr>
                    <?php 
                        $s = 1;
                        $count_tm = "";
                        $count_om = "";
                        $count_test = "";
                        $grandMarks = "";
                        $wherem = array('student_comulative_monthly_marks.sub_pro_id'=>$SubPro->sub_pro_id,'student_comulative_monthly_marks.student_id'=>$std->student_id);
                $qry = $this->AttendanceModel->student_monthlyMarks_history('student_comulative_monthly_marks',$wherem);
                if($qry):        
                        foreach($qry as $mrow):
                        $count_tm += $mrow->tmarks;        
                        $count_om += $mrow->omarks;    
                        $count_test += $mrow->total_test;  
                        if($count_test>0):
                            $grandMarks = $count_om*100/$count_tm;    
                            else:
                            $grandMarks = 0;    
                        endif;
                        
                        ?> 
                        <tr class="gradeA">
                            <td><?php echo $s;?></td>
                            <td><?php echo $mrow->section;?></td>
                            <td><?php echo $mrow->subject;?></td>
                            <td><?php echo $mrow->total_test;?></td>
                            <td><?php echo $mrow->omarks;?></td>
                            <td><?php echo $mrow->tmarks;?></td>
                            <td><?php if($mrow->omarks == 0 || $mrow->tmarks== 0): echo '0';else:$marksTotal = $mrow->omarks*100/$mrow->tmarks; echo round($marksTotal); endif;?>%</td>
                        </tr>
                        <?php 
                        $s++;
                        endforeach;
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>Total Marks</strong></td>
                            <td><strong><?php echo $count_test;?></strong></td>
                            <td><strong><?php echo $count_om;?></strong></td>
                            <td><strong><?php echo $count_tm;?></strong></td>
                            <td><strong><?php echo round($grandMarks);?>%</strong></td>
                        </tr>        
                        <tr>
                <?php else:?>            
                <td colspan="7" align="center" style="color:red">
                    <strong>Record Not Found..</strong>
                </td>            
            </tr>
            <?php endif;?>
                    </tbody>
                </table> 
            <hr>                             
        <?php
        endforeach;
        endif;
        ?>     
            <?php echo $print_log;?>
                        </div>    
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
   