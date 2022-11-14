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
       
  
    
    <div id="div_print">
            <div class="col-md-12">
            <?php  if(isset($student_informations) && !empty($student_informations)):?>
                <h4 style="margin-top: 8px;margin-bottom: -21px;"><strong>Edwardes College Peshawar <?php  echo $student_informations->batch_name; ?> </strong><hr></h4>
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
                                          echo  strtoupper($student_informations->student_name);
                                            
                                               ?>
                                            <br/>  <br/>
                                             <?php  if($student_informations->gender_id ==1):
                                            echo 'S/O';
                                            else:
                                            echo 'D/O';
                                        endif; ?>
                                            <br/>  <br/>
                                            <?php  echo strtoupper($student_informations->father_name); ?>
                                          </strong>  
                                        </td>
                                     
                                   
                                        <td colspan="3">
                                            <br/>
                                                <strong>College # <?php  echo $student_informations->college_no; ?></strong>
                                            <br/><br/>
                                                <strong>Group : <?php  echo $student_informations->sectionsName; ?></strong>
                                            <br/><br/>
                                        </td>
                                        <td colspan="2">
                                           <div class="profilepicture">
                                                <img src="assets/images/students/<?php 
                                                $image = '';
                                                if($student_informations->applicant_image):
                                                    $image= $student_informations->applicant_image;
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
                                            echo $this->CRUDModel->date_convert($student_informations->admission_date);
                                        ?></td>
                                        <td><strong>Mobile</strong></td>
                                        <td><?php echo  $student_informations->mobile_no; ?></td>
                                         <td><strong>Migration</strong></td>
                                        <td><?php echo     $student_informations->migrated_remarks; ?></td>
                                         <td><strong>In the year</strong></td>
                                        <td><?php echo  $student_informations->year_of_passing; ?>(<?php echo $student_informations->exam_type; ?>)</td>
                                    </tr>
                                     
                                   
                                
                                </tbody>
                            </table><!--//table-->
                        </div>
                        <?php 
                        endif;
                        if(isset($montly_attendance) && !empty($montly_attendance)):
                        ?>
                        <h5 class="has-divider text-highlight" style="margin-top: -10px; margin-bottom: 2px;"><strong><i>Monthly Attendance Record</i></strong></h5>
                        <div class="table-responsive">                      
                            <table class="table table-bordered">
                                <?php
                                
                                
                                    $sn = '';
                                    foreach($montly_attendance as $row=>$key):
                                        $sn ++;
                                        if($sn == 1): // for heading 
                                            echo '<thead> <tr>';
                                            if(isset($key) && !empty($key)):
                                                foreach($key as $row1=>$keyData):
                                                    echo '<th>'.$keyData.'</th>';
                                                endforeach;
                                            endif;
                                            echo '</tr></thead> ';
                                        else:
                                            echo '<tr>';
                                            if(isset($key) && !empty($key)):
                                                foreach($key as $row1=>$keyData):
                                                    echo '<td>'.$keyData.'</td>';
                                                endforeach;
                                            endif;
                                            echo '</tr>';

                                        endif;    
                                        
                                        
                                    endforeach;
                             
                                ?>
                                 
                                 
                            </table><!--//table-->
                        </div>

                        
                        
                         <?php
                            endif;
                         if( $student_informations->programe_id == 1 || $student_informations->programe_id == 5):
                            if(isset($montly_exame) && !empty($montly_exame)):
                         ?>
                        
                        <h5 class="has-divider text-highlight" style="margin-top: -10px; margin-bottom: 2px;"><strong><i>Monthly Test Record</i></strong></h5>
                        <div class="table-responsive">                      
                            <table class="table table-bordered">
                                    <?php
                                        
                                            $sn = '';
                                            foreach($montly_exame as $erow=>$ekey):
                                                $sn ++;
                                                if($sn == 1): // for heading 
                                                    echo '<thead> <tr>';
                                                    if(isset($ekey) && !empty($ekey)):
                                                        
                                                        foreach($ekey as $erow1=>$ekeyData):
                                                            echo '<th>'.$ekeyData.'</th>';
                                                        endforeach;
                                                    endif;
                                                    echo '</tr></thead> ';
                                                else:
                                                    echo '<tr>';
                                                    if(isset($ekey) && !empty($ekey)):
                                                        foreach($ekey as $erow1=>$ekeyData):
                                                            echo '<td>'.$ekeyData.'</td>';
                                                        endforeach;
                                                    endif;
                                                    echo '</tr>';
        
                                                endif;    
                                                
                                                
                                            endforeach;
                                        
                                    
                                    
                                    ?>
 
                                
                                
                            </table>
                        </div>
                        
                        <?php 
                        endif;
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
                                                    $test_result = $this->db->get_where('exams_bs_details', array('exbd_student_id'=>$student_informations->student_id, 'exb_test_type'=>$ex_id, 'exb_subject_id'=>$rowCS->subject_id, 'exb_class_status'=>1))->row();
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
                                            
                                            $wc_remarks = $this->CRUDModel->get_where_result('proctorial_fine', array('student_id'=>$student_informations->student_id, 'other_remarks !='=> ''));
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
                            <?php if(isset($print_log) && !empty($print_log)): echo $print_log; endif;  ;?>
                          
                            <!--//table-->
                        <!--</div>-->
 
                        </div>  
                    </div>
                </div>
     <?php
       
          ?>
    
      <div id="div_print1">
            <div class="col-md-12">
                <h4 style="margin-top: 8px;margin-bottom: -21px;"><strong><?php // $error;?></h4>
            </div>
          
    <?php
            
        // endif;
        
        ?>
            </div>
