<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
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
                    <strong>Edwardes College Peshawar <?php echo $result->batch_name; ?> 
                    <span style="margin-left:130px">E-Portal Print</span>
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
                                        <td><strong>Mobile</strong></td>
                                        <td><?php echo  $result->mobile_no; ?></td>
                                         <td><strong>Migration</strong></td>
                                        <td><?php echo     $result->migrated_remarks; ?></td>
                                         <td><strong>In the year</strong></td>
                                        <td><?php echo  $result->year_of_passing; ?>(<?php echo $result->exam_type; ?>)</td>
                                    </tr>
                                     
                                   
                                
                                </tbody>
                            </table><!--//table-->
                        </div>
                        <h5 class="has-divider text-highlight" style="margin-top: -10px; margin-bottom: 2px;"><strong><i>Monthly Attendance Record</i></strong></h5>
                        <div class="table-responsive">                      
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="padding: 5px;">Subjects</th>
                                      <?php
                                
                                        
                                      $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                                      
                                      
                                      
                                        $time = strtotime($fy_id->year_start);
//                                        $time = strtotime("2016-08-01");
                                            for($i=1;$i<=12;$i++):

                                                    $monthi = '+'.$i.'month';
                                                    $month  = date("M-y", strtotime($monthi, $time));
//                                                  
                                                  echo '<th>'.$month.'</th>';
                                            endfor;
                                      
                                      ?> 
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                  
                                    $secId = $this->uri->segment(3);
                                  
                                        //flag == 1 group_allot
                                        //flag == 2 subject allot
                                    
                                            if($flag ==1):
                                               $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$secId));
//                                                 $classSubjects = $this->ReportsModel->get_section_list('student_group_allotment',array('student_id'=>$result->student_id));
//                                                  echo '<pre>';print_r($result);die;
                                            endif;
                                            if($flag == 2):
                                                $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id));
//                                            echo '<pre>';print_r($classSubjects);die;
                                            endif;
            
                                    if($classSubjects):
                                        $netPresent = '';
                                        $netTotal   = '';
                                        foreach($classSubjects as $rowCS):
                                         $GrandTotal = 0;
                                         $granPresent = 0;
                                         
                                         echo '<tr><td>'.$rowCS->title.'</td>';
                                       
                                        for($i=1;$i<=12;$i++):

                                                $monthi     = '+'.$i.'month';
                                                $month      = date("m", strtotime($monthi, $time));
                                                $year       = date("Y", strtotime($monthi, $time));
                                                      
                                            echo '<td>';
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
                                             echo $p.'/'.$total;
                                          endif;
                                        $granPresent += $p; 
                                         $GrandTotal += $total;
                                        $per =0; 
                                         if($GrandTotal):
                                          $per = ($granPresent/$GrandTotal)*100;
                                             
                                         endif;
                                         
                                    echo '</td>';
                                             
                                            endfor;
                                            $netPresent += $granPresent;
                                            $netTotal += $GrandTotal;
                                      echo  '<td>'.$granPresent.'/'.$GrandTotal.'='.round($per,1).'</td>
                                    </tr>';
                                        endforeach;
                                        
                                        echo '<tr>
                                    <td>% age</td>';
                                        $montylyPresentGrand    = '';
                                        $montylyApsentGrand     = '';
                                        for($i=1;$i<=12;$i++):
                                                $monthi     = '+'.$i.'month';
                                                $month      = date("m", strtotime($monthi, $time));
                                                $year       = date("Y", strtotime($monthi, $time));
                                                $wheret = array(
//                                                        'subject_id'                => $rowCS->subject_id,
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
                                    if($MontlyGrandTotal):
                                         $pert = ($montylyPresent/$MontlyGrandTotal)*100;

                                        endif;
                                        if($pert):
                                               echo ' <td>'.round($pert,3).'</td>';   
                                            else:
                                                   echo ' <td></td>';   
                                        endif; 
                                    endfor;
                                       if($netPresent):
                                                     $pertGrand = ($netPresent/$netTotal)*100;
                                                    echo '<td><strong>'.$netPresent.'/'.$netTotal.'='.round($pertGrand,2).'</strong></td></tr>';
                                 
                                           else:
                                                     $pertGrand = 0;
                                          
                                                    echo '<td><strong>'.$netPresent.'/'.$netTotal.'='.$pertGrand.'</strong></td></tr>';

                                       endif;
                                   endif;
                                    ?>
                                
                                </tbody>
                            </table><!--//table-->
                        </div>
                        <h5 class="has-divider text-highlight" style="margin-top: -10px; margin-bottom: 2px;"><strong><i>Monthly Test Record</i></strong> <?php echo $print_log;?></h5>
                        <div class="table-responsive">                      
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="padding: 5px;">Subjects</th>
                                    <?php
                                      
                                        $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                                      
                                          $time = strtotime($fy_id->year_start);
                                            for($i=1;$i<=12;$i++):

                                                  $monthi = '+'.$i.'month';
                                                      $month = date("M-y", strtotime($monthi,$time));
//                                                  echo '-'.$year = date("Y", strtotime($monthi, $time));
                                                  echo '<th>'.$month.'</th>';
                                            endfor;
                                      
                                      ?> 
                                        <th style="padding: 5px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                  
                                    if($classSubjects):
                                        $month      = date("m", strtotime($monthi, $time));
                                        $year       = date("Y", strtotime($monthi, $time));
                                        
                                        foreach($classSubjects as $rowCS):
                                            $totalOb = '';
                                            $totaltm = '';
                                         echo '<tr>
                                        <td>'.$rowCS->title.'</td>
                                                ';
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
                                                      
                                                     echo  '<td>'.@$testRes1->omarks.'/'.@$testRes1->tmarks.'</td>';
                                                        $totalOb += $testRes1->omarks;
                                                        $totaltm += $testRes1->tmarks;
                                                      else:
                                                        
                                                             if(!empty($testRes1->tmarks)):
                                                                 
                                                                 echo  '<td>'.@$testRes1->omarks.'/'.@$testRes1->tmarks.'</td>';
                                                                 else:
                                                                     
                                                                 echo '<td></td>';
                                                                 
                                                             endif;
                                                          
                                                          
                                                          
                                                  endif;
                                                    
                                             
                                         endfor;
                                        
                                        
                                         if(!empty($totaltm)):
                                              $totalMarksPer = ($totalOb/$totaltm)*100;
                                             echo '    <td>'.$totalOb.'/'.$totaltm.'='.round($totalMarksPer,3).'</td>';
                                             else:
                                                      
                                                 echo '<td></td>';
                                         endif;
                                        echo '
                                        
                                       
                                     
                                    </tr>';
                                        endforeach;
                                        
                                         
                                        echo '<tr>
                                    <td>% age</td>';
                                            $TMOMG = '';
                                            $TMTMG = '';
                                        for($i=1;$i<=12;$i++):
                                                $monthi     = '+'.$i.'month';
                                                $month      = date("m", strtotime($monthi, $time));
                                                $year       = date("Y", strtotime($monthi, $time));
                                                $where     = array(
//                                                    'class_alloted.subject_id'=>$rowCS->subject_id,
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
                                                 endforeach;
                                          if($TMTM):
                                              $per_TM = ($TMOM/$TMTM)*100;
                                               echo ' <td>'.$TMOM.'/'.$TMTM.'='.round($per_TM,1).'</td>';   
                                            else:
                                                   echo ' <td></td>';   
                                        endif; 
                                                     $TMOMG +=   $TMOM ;
                                                     $TMTMG +=   $TMTM ;

                                       endfor;
                                       
                                       if($TMTMG):
                                               $TMG_PER = ($TMOMG/$TMTMG)*100;       
                                                echo '<td><strong>'.$TMOMG.'/'.$TMTMG.'='.round($TMG_PER,1).'</strong></td>';
                                    
                                           else:
                                           echo '<td></td>';
                                       endif;
                                  
                                   echo '</tr>';
                                        
                                        
                                    endif;
                                    ?>
                                </tbody>
                                
                            </table>
                             <div class="table-responsive"> 
                                 <h5 class="has-divider text-highlight" style="margin-top: -1px; margin-bottom: 2px;"><strong><i>Discipline Action (If Any) and Remarks</i></strong></h5>
                                    <table class="table table-bordered">
                                       
                                        <tbody>
                                            <tr>
                                                 
                                                <td>1 </td>
                                                <td> </td>
                                                
                                            </tr>
                                            <tr>
                                               
                                                <td> 2</td>
                                                <td> </td>
                                              
                                            </tr>
                                            <tr>
                                               
                                                <td> 3</td>
                                                <td> </td>
                                                 
                                            </tr>
                                        </tbody>
                                    </table><!--//table-->
                                </div>
                            
                            <p>Year Head / Tutor / Proctorial Staff / Class Teacher Comments: __________________________________________
                             <br/><br/>Principal's Comments : ___________________________________________________________________________</p>
                            
                          
                            <!--//table-->
                        </div>
 
                        </div>  
                    </div>
           
                </div>
            </div>
   