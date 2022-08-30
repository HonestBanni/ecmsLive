<script language="javascript">
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
       
        <?php
        if(@$result):
            
        
        
        ?>
    
    <div id="div_print">
            <div class="col-md-12">
                <h4 style="margin-top: 8px;margin-bottom: -21px;"><strong>Edwardes College Peshawar <?php  echo $result->batch_name; ?> </strong><hr></h4>
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
                                        <th>Subjects</th>
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
                                            endif;
                                            if($flag == 2):
                                                $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id));

                                            endif;
                                         
                                    if($classSubjects):
                                        $netPresent = '';
                                        $netTotal   = '';
                                        foreach($classSubjects as $rowCS):
                                         $GrandTotal = 0;
                                         $granPresent = 0;
                                         
                                         echo '<tr><td>'.substr($rowCS->title,0,20).'</td>';
                                       
                                        for($i=1;$i<=12;$i++):

                                                $monthi     = '+'.$i.'month';
                                                $month      = date("m", strtotime($monthi, $time));
                                                $year       = date("Y", strtotime($monthi, $time));
                                                      
                                            echo '<td>';
                                                    $where = array(
                                                        'subject_id'                => $rowCS->subject_id,
//                                                        'sec_id'                    => $secId,
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
//                                                        'sec_id'                    => $secId,
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
                                                if($flag == 2):
                                                     $whereChck = array(
                                                'subject_id'=>$stdAtt->subject_id,
                                                'student_id'=>$stdAtt->student_id,
                                                );
                                                
                                             $checkEnrolledSubjects = $this->db->get_where('student_subject_alloted',$whereChck)->row(); 
                                             if(!empty($checkEnrolledSubjects)):
                                                  
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
                                              endif;
                                                else:
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
                        
                        
                         <?php if($result->programe_id == 1 || $result->programe_id == 5):?>
                        
                        <h5 class="has-divider text-highlight" style="margin-top: -10px; margin-bottom: 2px;"><strong><i>Monthly Test Record</i></strong></h5>
                        <div class="table-responsive">                      
                            <table class="table table-bordered">
                                 <thead>
                                    <tr>
                                        <th>Subjects</th>
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
                                        <th>Pre Board</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                  
                                    if($classSubjects):
                                        $month      = date("m", strtotime($monthi, $time));
                                        $year       = date("Y", strtotime($monthi, $time));
                                        
                                        $ttl_obt_pb = '';
                                        $ttl_tm_pb  = '';
                                        
                                        foreach($classSubjects as $rowCS):
                                            $totalOb = '';
                                            $totaltm = '';
                                         echo '<tr>
                                        <td>'.substr($rowCS->title,0,17).'</td>
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
                                                                 $totaltm += $testRes1->tmarks; 
                                                             
                                                                 echo  '<td>'.@$testRes1->omarks.'/'.@$testRes1->tmarks.'</td>';
                                                                 else:
                                                                     
                                                                 echo '<td></td>';
                                                                 
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
                                             echo '<td>'.$totalOb_show.'/'.$totaltm.'='.round($totalMarksPer,3).'</td>';
                                             else:
                                                      
                                                 echo '<td></td>';
                                         endif;
                                         
                                         
                                         
                                        // Pre Board Marks
                                                    $this->db->select('
                                                        pre_board_test_details.omarks,
                                                        pre_board_test_details.tmarks
                                                    ');
                                                    $this->db->join('pre_board_test', 'pre_board_test.test_id=pre_board_test_details.test_id', 'left outer');
                                                    $this->db->join('class_alloted', 'class_alloted.class_id=pre_board_test.class_id', 'left outer');
                                                    $this->db->where(array('class_alloted.subject_id' => $rowCS->subject_id, 'pre_board_test_details.student_id' => $result->student_id));
                                        $pb_marks = $this->db->get('pre_board_test_details')->row();
                                        
                                        echo '<td>';
                                        if(!empty($pb_marks)):
                                            echo $pb_marks->omarks.'/'.$pb_marks->tmarks;
                                            $ttl_obt_pb += $pb_marks->omarks;
                                            $ttl_tm_pb  += $pb_marks->tmarks;
                                        endif;
                                        echo '</td>';
                                         
                                         
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
                                       
                                        //Pre Board Marks Total
                                       if($ttl_tm_pb == 0):
                                            $pb_age = '';
                                            echo '<td></td>';
                                       else:
                                            $pb_age = $ttl_obt_pb / $ttl_tm_pb * 100;
                                            echo '<td>'.$ttl_obt_pb.'/'.$ttl_tm_pb.' ('.round($pb_age,1).'%)</td>';
                                       endif;
                                       
                                   echo '</tr>';
                                        
                                        
                                    endif;
                                    ?>
                                </tbody>
                                
                            </table>
                        </div>
                        
                        <?php 
                        else:
                        
                            echo '<h5 class="has-divider text-highlight" style="margin-top: -10px; margin-bottom: 2px;"><strong><i>BS Exam Record</i></strong></h5>';
                        ?>
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Subjects</th>
                                      <?php
                                        $test = $this->CRUDModel->getResults('exam_types');
                                        foreach($test as $row):
                                            echo '<th>'.$row->xt_title.'</th>';
                                        endforeach;
                                        ?>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $secId = $this->uri->segment(3);
                                  
                                        //flag == 1 group_allot
                                        //flag == 2 subject allot
                                    
                                    $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$secId));
                                         
                                    if($classSubjects):
                                        foreach($classSubjects as $rowCS):
                                            echo '<tr>
                                                <td>'.$rowCS->title.'</td>';
                                                $t_ob = '';
                                                $t_mr = '';
                                                for($ex_id=1;$ex_id<=count($test);$ex_id++):
                                                    
                                                                    $this->db->join('exams_bs', 'exams_bs.exb_test_id=exams_bs_details.exbd_test_id', 'left outer');
                                                    $test_result = $this->db->get_where('exams_bs_details', array('exbd_student_id'=>$result->student_id, 'exb_test_type'=>$ex_id, 'exb_subject_id'=>$rowCS->subject_id, 'exb_class_status'=>1))->row();
                                                    if(!empty($test_result)):
                                                        echo '<td>'.$test_result->exbd_omarks.' / '.$test_result->exb_test_marks.'</td>';
                                                        $t_ob += $test_result->exbd_omarks;
                                                        $t_mr += $test_result->exb_test_marks;
                                                    else:
                                                        echo '<td></td>';
                                                    endif;
                                                endfor;
                                                if($t_mr > 0):
                                                    $prcntage = $t_ob / $t_mr * 100;
                                                    echo '<td>'.$t_ob.' / '.$t_mr.' ('.round($prcntage, 2).'%)</td>';
                                                else:
                                                    echo '<td></td>';
                                                endif;
                                                
                                            echo'</tr>';
                                        endforeach;
                                    endif; 
                                    ?>
                                    
                                </tbody>
                        </table>
                        <?php
//                            echo '<pre>'; print_r(); echo'</pre>';
                        
                        endif;
                        ?>
                        
                        
                        
                             <div class="table-responsive"> 
                                 <h5 class="has-divider text-highlight" style="margin-top: -1px; margin-bottom: 2px;"><strong><i>Discipline Action (If Any) and Remarks</i></strong></h5>
                                    <table class="table table-bordered">
                                       
                                        <tbody>
                                            <?php
//                                                        $this->db->order_by('id','asc');
//                                            $d_action = $this->db->get_where('student_discipline_actions',array('student_id'=>$result->student_id,'status'=>1))->result();
//                                             if($d_action):
//                                                 $sn = '';
//                                                 foreach($d_action as $daRow):
//                                                     
//                                                               $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId'); 
//                                                 $userInfo  =  $this->db->get_where('users',array('id'=>$daRow->create_by))->row();
//                                                 $sn++;
//                                                 echo '<tr>';
//                                                 echo '<td width="10">'.$sn.'</td>';
//                                                 echo '<td>'.substr($daRow->d_action_details,0,140).'.. : By ( <strong>'.$userInfo->emp_name.' </strong>) On <strong>'.date('d-D-Y',strtotime($daRow->d_action_date)).'</strong></td>';
//                                                 
//                                                 echo '</tr>';
//                                                 endforeach;
//                                                 else:
//                                                 echo '<tr><td width="5">1 </td><td> </td></tr>';
//                                             endif;
                                            
                                            $wc_remarks = $this->CRUDModel->get_where_result('proctorial_fine', array('student_id'=>$result->student_id, 'other_remarks !='=> ''));
                                            if($wc_remarks):
                                                $srl = '';
                                                foreach($wc_remarks as $wcr):
                                                    $srl++;
                                                    echo '<tr>
                                                        <td width="5%">'.$srl.'</td>
                                                        <td width="95%">'.$wcr->other_remarks.'</td>
                                                    </tr>';
                                                endforeach;
                                            else:    
                                                echo '<tr>
                                                    <td width="5%">1</td>
                                                    <td width="95%"></td>
                                                </tr>';
                                            endif;
                                            ?>
                                            
                                        </tbody>
                                    </table><!--//table-->
                                </div>
                            
                            <p>Year Head / Tutor / Proctorial Staff / Class Teacher Comments: __________________________________________
                             <br/><br/>Principal's Comments : ___________________________________________________________________________</p>
                            <?php echo $print_log;?>
                          
                            <!--//table-->
                        <!--</div>-->
 
                        </div>  
                    </div>
                </div>
     <?php
       else:
          ?>
    
      <div id="div_print">
            <div class="col-md-12">
                <h4 style="margin-top: 8px;margin-bottom: -21px;"><strong>No Record Found</h4>
            </div>
          
    <?php
            
        endif;
        
        ?>
            </div>
