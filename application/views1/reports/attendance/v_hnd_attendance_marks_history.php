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
            <h2 align="left"><?php echo $HeaderPage; ?><hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post">
                      <div class="form-group col-md-2">
            <?php        
                
                if(!empty($student_id)){
                    $empres = $this->AttendanceModel->get_by_id('student_record',array('student_id'=>$student_id));
                    foreach($empres as $emprec)
                    { ?>          
        <input type="text" name="student_id" value="<?php echo $emprec->student_name; ?>" placeholder="Student" class="form-control" id="students_hnd">
                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $emprec->student_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="student_id" placeholder="Student" class="form-control" id="students_hnd">
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
                        if(@$sub_program):  ?>
                        <h3 align="center">Student Previous Attendance and Marks History</h3>
                            <?php   
                        foreach($sub_program as $SubPro):
                        ?>          
        
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
                if($t!=0):
                    $subjectTotal = $p*100/$t;
                endif;
                
                ?>
            <tr class="gradeA">
                <td><?php echo $i;?></td>
                <td><?php echo $rec->section;?></td>
                <td><?php echo $rec->subject;?></td>
                <td><?php echo $rec->a_attend;?></td>
                <td><?php echo $rec->p_attend;?></td>
                <td><?php echo $rec->total_attend;?></td>
                <td><?php if($subjectTotal): echo round($subjectTotal); else: echo '0'; endif; ?>%</td>
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
                        $grandMarks = $count_om*100/$count_tm;    
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
            
            <?php if(@$result): ?>
                <h3 align="center">Student Current Attendance and Marks Details</h3>
                <div class="table-responsive">                      
                    <table class="table table-hover table-boxed table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2">Name: <?php echo $result->student_name; ?></th>
                                <th>F-Name: <?php echo $result->father_name; ?></th>
                                <th>College # <?php echo $result->college_no; ?></th>
                                <th>Program: <?php echo $result->programName; ?></th>
                                <th colspan="2">Class Name: <?php echo $result->sectionsName; ?></th>
                            </tr>
                            <tr>
                                <td colspan="7" align="center" style="color:red"><strong>Student Attendance Comulative</strong></td>
                            </tr>
                        </thead>
                        <thead>
                            <?php
                                $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                                $time = strtotime($fy_id->year_start);
                                for($i=1;$i<=12;$i++):  
                                    $monthi = '+'.$i.'month';
                                    $month  = date("M-y", strtotime($monthi, $time));                 
                                endfor;
                            ?> 
                            <tr>
                                <td><strong>S No.</strong></td>
                                <td><strong>Section Name</strong></td>
                                <td><strong>Subject Name</strong></td>
                                <td><strong>Absent</strong></td>
                                <td><strong>Present</strong></td>
                                <td><strong>Total</strong></td>
                                <td><strong>%age</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                            
                            $check_attendance = $this->db->get_where('student_attendance_details',array('student_id'=>$result->student_id))->row();
                            if(!empty($check_attendance)):
                            
                                $secId = $sectio_id_curr;
                                if($flag ==1):
                                    $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$secId));
                                endif;
                                if($flag == 2):
                                    $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id));
                                endif;
                                if($classSubjects):
                                    $netPresent = '';
                                    $netTotal   = '';
                                    $serail_no = '';
                                    foreach($classSubjects as $rowCS):
                                    $GrandTotal = 0;
                                    $granPresent = 0;
                                    $serail_no++;
                            ?>
                            <tr>
                                <td><?php echo  $serail_no; ?></td>
                                <td><?php echo  strtoupper($result->sectionsName); ?></td>
                                <td><?php echo  strtoupper($rowCS->title); ?></td>
                                <?php 
                                    for($i=1;$i<=12;$i++):
                                        $monthi     = '+'.$i.'month';
                                        $month      = date("m", strtotime($monthi, $time));
                                        $year       = date("Y", strtotime($monthi, $time));
                                        $where = array(
                                            'subject_id'                => $rowCS->subject_id,
                                            'sec_id'                    => $secId,
                                            'student_id'                =>$result->student_id,
                                            'month(attendance_date)'    =>$month,
                                            'year(attendance_date)'     =>$year,
                                        );
                                        $stdAtts = $this->ReportsModel->get_student_att($where);
                                        $p=0;
                                        $a=0;
                                        foreach($stdAtts as $stdAtt):
                                            if($stdAtt->status == 1):
                                                if($stdAtt->ca_classcount ==2):
                                                    $p++;
                                                    $p++;
                                                else:
                                                    $p++;
                                                endif;
                                                else:
                                                    if($stdAtt->ca_classcount ==2):
                                                        $a++;
                                                        $a++;
                                                    else:
                                                        $a++;
                                                endif;
                                            endif;
                                        endforeach;
                                        $total = $a+$p;
                                        if($total):
                                          $p.'/'.$total;
                                        endif;
                                        $granPresent += $p; 
                                        $GrandTotal += $total;
                                        $per =0; 
                                        if($GrandTotal):
                                            $per = ($granPresent/$GrandTotal)*100;
                                        endif;
                                    endfor;
                                    $netPresent += $granPresent;
                                    $netTotal += $GrandTotal;
                                    $grandAbsent = $GrandTotal-$granPresent;
                                ?>
                                <td><?php echo $grandAbsent; ?></td>
                                <td><?php echo $granPresent; ?></td>
                                <td><?php echo $GrandTotal; ?></td>
                                <td><?php echo round($per,1) ?></td>
                            </tr>
                            <?php  endforeach; ?>
                            <tr>
                                <?php 
                                    $montylyPresentGrand    = '';
                                    $montylyApsentGrand     = '';
                                    for($i=1;$i<=12;$i++):
                                        $monthi     = '+'.$i.'month';
                                        $month      = date("m", strtotime($monthi, $time));
                                        $year       = date("Y", strtotime($monthi, $time));
                                        $wheret = array(
                                            'sec_id'                    => $secId,
                                            'student_id'                =>$result->student_id,
                                            'month(attendance_date)'    =>$month,
                                            'year(attendance_date)'     =>$year,
                                        );
                                        $stdAttst = $this->ReportsModel->get_student_att($wheret);
                                        $tp='';
                                        $ta='';
                                        $pert='';
                                        $montylyPresent = '';
                                        $MontlyGrandTotal = '';
                                        foreach($stdAttst as $stdAtt):
                                            if($stdAtt->status == 1):
                                                if($stdAtt->ca_classcount ==2):
                                                    $tp++;
                                                    $tp++;
                                                else:
                                                    $tp++;
                                                endif;
                                            else:
                                                if($stdAtt->ca_classcount ==2):
                                                    $ta++;
                                                    $ta++;
                                                else:
                                                    $ta++;
                                                endif;
                                            endif;
                                        endforeach;
                                        $total = $ta+$tp; 
                                        if($total):    
                                            $tp.'/'.$total;
                                        endif;

                                        $montylyPresentGrand =   $montylyPresent += $tp; 
                                        $montylyApsentGrand =  $MontlyGrandTotal += $total;
                                        $per =0; 
                                    endfor;
                                    if($netPresent):
                                         $pertGrand = ($netPresent/$netTotal)*100; 
                                         $netAbsent = $netTotal-$netPresent;
                                ?>
                                <td colspan="3" align="center"><strong>Total</strong></td>
                                <td><?php echo $netAbsent; ?></td>
                                <td><?php echo $netPresent; ?></td>
                                <td><?php echo $netTotal; ?></td>
                                <?php    
                                    echo '<td><strong>'.round($pertGrand,2).'%</strong></td>';
                                    else:
                                        $pertGrand = 0;
                                        echo '<td><strong>'.$pertGrand.'%</strong></td>';
                                    endif;
                               endif;
                               ?>    
                            </tr> 
                            <?php else: ?>
                                <tr>
                                <td colspan="7" align="center" style="color:red">
                                    <strong>Record Not Found..</strong>
                                </td>
                            </tr>
                                <?php endif;
                                ?>
                            <tr>
                                <td colspan="7" align="center" style="color:red"><strong>Student Monthly Marks Comulative</strong></td>
                            </tr>
                            <tr>
                                <td><strong>S No.</strong></td>
                                <td><strong>Section Name</strong></td>
                                <td><strong>Subject Name</strong></td>
                                <td><strong>Total Tests</strong></td>
                                <td><strong>Obtained Marks</strong></td>
                                <td><strong>Total Marks</strong></td>
                                <td><strong>Total %age</strong></td>
                            </tr>
                            <?php
                            
                            $check_marks = $this->db->get_where('monthly_test_details',array('student_id'=>$result->student_id))->row();
                            if(!empty($check_marks)):
                                
                            
                                 $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                                $time = strtotime($fy_id->year_start);
                                for($i=1;$i<=12;$i++):
                                    $monthi = '+'.$i.'month';
                                    $month = date("M-y", strtotime($monthi,$time));
                                endfor;
                                if($classSubjects):
                                    $month      = date("m", strtotime($monthi, $time));
                                    $year       = date("Y", strtotime($monthi, $time));
                                    $marksSerial = '';
                                    foreach($classSubjects as $rowCS):
                                        $totalOb = '';
                                        $totaltm = '';
                                        $marksSerial++;
                            ?> 
                            <tr>
                                <td><?php echo $marksSerial;?></td>
                                <td><?php echo  strtoupper($result->sectionsName); ?></td>
                                <td><?php echo $rowCS->title;?></td>
                                <?php 
                                $noTest = '';
                                for($i=1;$i<=12;$i++):
                                    $monthi     = '+'.$i.'month';
                                    $month      = date("m", strtotime($monthi,$time));
                                    $year       = date("Y", strtotime($monthi,$time));
                                    $where     = array(
                                        'class_alloted.subject_id'=>$rowCS->subject_id,
                                        'monthly_test_details.student_id'=>$result->student_id,
                                        'month(test_date)'=>$month,
                                        'year(test_date)'=>$year,

                                    );
                                    $testRes1 = $this->ReportsModel->get_test_marks($where);    
                                    if(!empty($testRes1->omarks)):
                                        $totalOb += $testRes1->omarks;
                                        $totaltm += $testRes1->tmarks;
                                        $noTest++;
                                    else:
                                        if(!empty($testRes1->tmarks)):
                                            $totaltm += $testRes1->tmarks; 
                                            $noTest++;
                                        endif;
                                    endif;
                                endfor;
                                if(!empty($totaltm)):
                                    $totalMarksPer = ($totalOb/$totaltm)*100;
                                    $totalOb_show = '';
                                    if($totalOb == 0):
                                        $totalOb_show = 0;
                                    else:
                                        $totalOb_show =$totalOb;
                                    endif;
                                ?>
                                    <td><?php echo $noTest; ?></td>
                                    <td><?php echo $totalOb_show; ?></td>
                                    <td><?php echo $totaltm; ?></td>
                                    <td><?php echo round($totalMarksPer,3); ?></td>
                                <?php
                                else:
                                    echo '<td></td><td></td><td></td><td></td>';
                                endif;
                                ?>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                            <td colspan="3" align="center"><strong>Total</strong></td>
                            <?php
                            $TMOMG  = '';
                            $TMTMG  = '';
                            $NOTT   = '';
                            for($i=1;$i<=12;$i++):
                                $monthi = '+'.$i.'month';
                                $month  = date("m", strtotime($monthi, $time));
                                $year   = date("Y", strtotime($monthi, $time));
                                $where  = array(
                                            'monthly_test_details.student_id'=>$result->student_id,
                                            'month(test_date)'=>$month,
                                            'year(test_date)'=>$year,
                                        );
                                $TMQ = $this->ReportsModel->get_test_marks_result($where);
                                $TMOM = '';
                                $TMTM = '';
                                foreach($TMQ as $TMQRow):
                                     $TMOM +=$TMQRow->omarks;
                                     $TMTM += $TMQRow->tmarks;
                                     $NOTT++;
                                endforeach;
                                if($TMTM):
                                    $per_TM = ($TMOM/$TMTM)*100;
                                endif; 
                                $TMOMG +=   $TMOM ;
                                $TMTMG +=   $TMTM ;
                            endfor; 
                            if($TMTMG):
                                $TMG_PER = ($TMOMG/$TMTMG)*100;
                            ?>
                            <td><?php echo $NOTT; ?></td>
                            <td><?php echo $TMOMG; ?></td>
                            <td><?php echo $TMTMG; ?></td>
                            <td><?php echo round($TMG_PER,1); ?></td> 
                            <?php 
                            else:
                                echo '<td></td><td></td><td></td><td></td>';
                            endif;
                            ?>      
                            </tr>
                            <?php else:
                               
                                endif; 
                                else:
                            ?>
                            <tr>
                                <td colspan="7" align="center" style="color:red">
                                    <strong>Record Not Found..</strong>
                                </td>
                            </tr>
                                <?php
                                    
                            endif;    
                                ?>  
                        </tbody>
                    </table><!--//table-->
                     
                </div>               
                <?php endif; ?>
             <?php echo $print_log;?>
                        </div>    
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
    <script>
    jQuery(document).ready(function(){
        jQuery("#students_hnd").autocomplete({  
        minLength: 0,
        source: "ReportsController/auto_students_hnd/"+$("#students_hnd").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#students_hnd").val(ui.item.contactPerson);
        jQuery("#student_id").val(ui.item.id);
        jQuery("#college_no").val(ui.item.college_no);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
     });
    </script>