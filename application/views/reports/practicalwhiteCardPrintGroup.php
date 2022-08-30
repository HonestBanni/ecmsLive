<script language="javascript">
function printdiv(printpage)
{
var headstr = '<html><head><link rel="stylesheet" type="text/css" href="assets/css/print_style.css" /><title></title></head><body>';
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
            
            <?php
            
            foreach($all_result as $row):
                $college_no = $row->college_no;
                $group_id = $row->prac_group_id;
                $result   = $this->ReportsModel->get_whiteCard_practical(
                        array(
                            'student_prac_group_allottment.college_no'=>$college_no,
                            'student_prac_group_allottment.group_id'=>$group_id
                        )); 
            ?>
            
            <div style="width:100%;">
                
            <div class="col-md-12" style="padding-bottom: 20px !important; padding-top:20px; width:98%;height:320px; border-bottom:1px dashed #000">
                <h4 style="margin-top:8px;text-align:center"><strong>Edwardes College Peshawar Practical White Card</strong></h4>
                    <div class="row cols-wrapper">
                        <div class="table-responsive">                      
                            <table class="table table-bordered">
                               
                                <tbody>
                                    <tr>
                                <td>  
                                    <div class="profilepicture">
                                        <img src="assets/images/logoWhiteCard.png" style=" height:60px;  margin-left: 24px;">
                                    </div>

                                </td>
                                <td align="center">
                                    <strong> 
                                     <br/>
                                    STUDENT NAME :
                                    <?php  echo strtoupper($result->student_name); ?>
                                  </strong> 
                                </td>
                                <td align="center">
                                    <strong>
                                        <br>
                                        COLLEGE # : <?php  echo $result->college_no; ?></strong>  
                                </td>
                                <td align="center">
                                    <br>
                                    <strong>GROUP NAME : <?php  echo strtoupper($result->group_name); ?></strong>
                                    <br/><br/>
                                </td>
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
                                    for($i=1;$i<=7;$i++):
                                            $monthi = '+'.$i.'month';
                                            $month  = date("M-y", strtotime($monthi, $time));                                                 
                                          echo '<th>'.$month.'</th>';
                                    endfor;
                                      ?> 
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
       $classSubjects = $this->ReportsModel->get_practicalSubjects(array('group_id'=>$group_id));
                                            
                                    if($classSubjects):
                                        $netPresent = '';
                                        $netTotal   = '';
                                        foreach($classSubjects as $rowCS):
                                         $GrandTotal = 0;
                                         $granPresent = 0;
                                         
                     echo '<tr><td>'.$rowCS->title.'</td>';

                    for($i=1;$i<=7;$i++):

                            $monthi     = '+'.$i.'month';
                            $month      = date("m", strtotime($monthi, $time));
                            $year       = date("Y", strtotime($monthi, $time));

                        echo '<td>';
                        $where = array(
                            'subject_id'                => $rowCS->subject_id,
                            'group_id'                    => $group_id,
                            'college_no'                =>$result->college_no,
                            'month(attendance_date)'    =>$month,
                            'year(attendance_date)'     =>$year,
                        );
                        $stdAtts = $this->ReportsModel->get_studentPractical_att($where);
                           $p=0;
                            $a=0;
                        foreach($stdAtts as $stdAtt):

                        if($stdAtt->status == 1):
                                        $p++;
                                    else:
                                        $a++;
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
                            for($i=1;$i<=7;$i++):
                                    $monthi     = '+'.$i.'month';
                                    $month      = date("m", strtotime($monthi, $time));
                                    $year       = date("Y", strtotime($monthi, $time));
                                    $wheret = array(
                                            'group_id'                    => $group_id,
                                            'college_no'                =>$result->college_no,
                                            'month(attendance_date)'    =>$month,
                                            'year(attendance_date)'     =>$year,
                                        );
                                $stdAttst = $this->ReportsModel->get_studentPractical_att($wheret);

                                        $tp='';
                                        $ta='';
                                        $pert='';
                                        $montylyPresent = '';

                                $MontlyGrandTotal = '';
                                 foreach($stdAttst as $stdAtt):

                                if($stdAtt->status == 1):
                                          $tp++;
                                        else:
                                          $ta++;
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
                                     $pertGrand = ($netPresent/$netTotal)*100;   
                                   echo '<td><strong>'.$netPresent.'/'.$netTotal.'='.round($pertGrand,2).'</strong></td></tr>';
                                    endif;
                                    ?>
                                </tbody>
                            </table><!--//table-->
                        </div>    
                        </div>  
                    </div>
            
            
          </div> 
           
           <?php
           
             endforeach;
           ?> 
        </div>
            </div>
    