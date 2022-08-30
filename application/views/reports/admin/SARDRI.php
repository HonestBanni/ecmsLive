        </script><script language="javascript">
function printdiv(printpage)
{
//var headstr = "<html><head><title></title></head><p></p><body>";

  //  var headstr = "<html><head><title></title></head><body>";
    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' alt='Edwardes College Peshawar'></p>";

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
    
    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button> 
        <div id="div_print">
            <div class="col-md-12">
                <h4 style="margin-top: 8px;margin-bottom: -21px;">
                    <strong>Edwardes College Peshawar <?php 
                    if(!empty($result)):
                        
                    echo $result->batch_name; ?> 
                     
                    </strong><hr></h4>
                    <div class="row cols-wrapper">
                        <div class="table-responsive">                      
                            <table class="table table-bordered">
                               
                                <tbody>
                                    <tr>
                                        <td >  
                                            <div class="profilepicture">
                                                <img src="assets/images/logoWhiteCard.png" style=" height: 117px;  margin-left: 24px;">
                                            </div>
                                        
                                        </td>
                                        <td colspan="2">
                                            <strong> 
                                             <br/>
                                            <?php  
                                          echo  strtoupper($result->student_name);
                                            
                                               ?>
                                            <br/>  <br/>
                                             <?php  if($result->gender_id ==1):
                                            echo 'S/O';
                                            else:
                                            echo 'D/O';
                                        endif; ?>
                                            <br/>  <br/>
                                            <?php  echo strtoupper($result->father_name); ?>
                                          </strong>  
                                        </td>
                                     
                                   
                                        <td colspan="3">
                                            <br/>
                                                <strong>College # <?php  echo $result->college_no; ?></strong>
                                            <br/><br/>
                                                <strong>Group : <?php  echo $result->sectionsName; ?></strong>
                                            <br/><br/>
                                        </td>
                                        <td colspan="2">
                                           <div class="profilepicture">
                                                <img src="assets/images/students/<?php 
                                                $image = '';
                                                if($result->applicant_image):
                                                    $image= $result->applicant_image;
                                                else:
                                                    $image = 'user.png';
                                                endif;
                                                echo $image?>" style=" height: 117px;  margin-left: 24px;">
                                            </div>
                                        </td>
                                     
                                    </tr>
                                     
                                    <tr>
                                      
                                        <td><strong>Date Of Admission</strong></td>
                                        <td><?php 
                                        
                                        
                                         if($result->admission_date == '1970-01-01'):
                                            echo '';
                                            else:
                                             echo date('d-m-Y', strtotime($result->admission_date)); 
                                        endif;
                                        
                                        
                                        ?></td>
<!--                                        <td><strong>Mobile</strong></td>
                                        <td><?php //echo  $result->mobile_no; ?></td>-->
                                         <td><strong>Migration</strong></td>
                                        <td><?php echo     $result->migrated_remarks; ?></td>
                                         <td><strong>In the year</strong></td>
                                        <td><?php echo  $result->year_of_passing; ?>(<?php echo $result->exam_type; ?>)</td>
                                    </tr>
                                     
                                   
                                
                                </tbody>
                            </table><!--//table-->
                        </div>
                        <?php 
                        if($get_month):
                            foreach($get_month as $mnth):
                        
                        ?>
                        <h3 class="has-divider text-highlight" style="margin-top: -10px; margin-bottom: 2px;"><strong>Attendance for <?php echo $mnth->attendance_month; ?></strong></h3>
                        <div class="table-responsive">                      
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <?php
                                        for($i=1;$i<=31;$i++):
                                            echo '  <th>'.$i.'</th>';
                                        endfor;
                                        ?>
                                        <th>%</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
//                                    $flag = $this->CRUDModel->get_where_row('class_alloted',array('class_alloted.sec_id'=> $section_id));
                                    if($flag == '1'):
                                        $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$section_id));
//                                                 $classSubjects = $this->ReportsModel->get_section_list('student_group_allotment',array('student_id'=>$result->student_id));
//                                                  echo '<pre>';print_r($classSubjects);die;
                                    endif;
                                    if($flag == '2'):
                                        $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$student_id));
//                                           echo '<pre>';print_r($classSubjects);die;
                                    endif;
                                    
                                    $grand_total = '';
                                    $grand_p     = '';
                                    $grand_a     = '';
                                    
                                    foreach($classSubjects as $subject):
                                        echo '<tr>
                                            <td>'.$subject->title.'</td>';
                                        $p = '';
                                        $a = '';
                                        for($i=1;$i<=31;$i++):
                                        echo '<td>';
                                            $where['attendance_date']= $mnth->month_year.'-'.$i;
                                            $where['class_alloted.subject_id']= $subject->subject_id;
                                            $where['student_id']= $student_id;
                                            $result = $this->ReportsModel->get_student_attendance_row($where);
                                            $flag = $this->CRUDModel->get_where_row('class_alloted',array('class_alloted.subject_id'=>$subject->subject_id));
                                            
                                            if(!empty($result)):
                                                if($result->status == 1):
                                                    if($flag->ca_classcount == 2):
                                                        $p++;
                                                        $p++;
                                                        echo '2P'; 
                                                    else:
                                                        $p++;
                                                        echo 'P'; 
                                                    endif;
                                                endif;
                                                if($result->status == 0):
                                                    if($flag->ca_classcount == 2):
                                                        $a++;
                                                        $a++;
                                                        echo '2A';
                                                    else:
                                                        $a++;
                                                        echo 'A';
                                                    endif;
                                                endif;
                                                if($result->status == 2):
                                                    if($flag->ca_classcount == 2):
                                                        $a++;
                                                        $a++;
                                                        echo '2L';
                                                    else:
                                                        $a++;
                                                        echo 'L';
                                                    endif;
                                                endif;
                                            endif;
                                        echo '</td>';    
                                        endfor;
                                        
                                        $total = $p+$a;
                                        $grand_total += $total;
                                        $grand_p     += $p;
                                        $grand_a     += $a;
                                        
                                        if(!empty($total)):
                                            $per = ($p/$total)*100;  
                                            echo '<td>'.round(@$per,2).'</td>';
                                        else:
                                            echo '<td></td>';
                                        endif;
                                   
                                        if($p ==0):
                                            $p= 0;
                                        endif;
                                        if($a ==0):
                                            $a= 0;
                                        endif;
                                        echo '<td>'.$p.'/'.$a.'='.$total.'</td>'; 
                                    echo '</tr>';
                                    endforeach;
                                    echo '<tr>
                                        <td colspan="32"></td>';
                                        
                                        if(!empty($grand_total)):
                                            $tper = ($grand_p/$grand_total)*100;  
                                            echo '<td>'.round(@$tper,2).'</td>';
                                        else:
                                            echo '<td></td>';
                                        endif;

                                        echo '<td>'.$grand_p.'/'.$grand_a.'='.$grand_total.'</td>
                                    </tr>';
                                    ?>
                                </tbody>
                            </table><!--//table-->
                        </div>
                        <?php 
                                    endforeach;
                                endif;
                        ?>
                        </div>  
                
                
                <?php
                
                endif;
                ?>
                    </div>
                </div>
            </div>
    </div>