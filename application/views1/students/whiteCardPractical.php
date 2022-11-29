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
            <style>
    #background{
        position:absolute;
        z-index:0;
        background:white;
        display:block;
        min-height:50%; 
        min-width:50%;
        color:yellow;
        margin-top: 50px;
        margin-left: 200px;
    }
    #content{
        position:absolute;
        z-index:1;
    }
    #bg-text
    {
        color:lightgrey;
        font-size:100px;
        transform:rotate(300deg);
        -webkit-transform:rotate(300deg);
    }
</style> 
    <div id="background">
                <p id="bg-text">E-Print</p>
            </div>        
            <div class="col-md-12">
                <h4 style="margin-top: 8px;margin-bottom: -21px;"><strong>Edwardes College Peshawar Practical White Card 
                    <span style="margin-left:130px">E-Portal Print</span></strong><hr></h4>
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
                                            STUDENT NAME:
                                            <br/>  <br/>
                                            <?php  echo strtoupper($result->student_name); ?>
                                          </strong>  
                                        </td>
                                     
                                   
                                        <td colspan="3">
                                            <br/>
                                                <strong>College # <?php  echo $result->college_no; ?></strong>
                                            <br/><br/>
                                                <strong>Group : <?php  echo $result->group_name; ?></strong>
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
                                
                                        
                                        $time = strtotime("2017-08-01");
                                            for($i=1;$i<=7;$i++):

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
                                  
        $group_id = $this->uri->segment(3);
       $classSubjects = $this->StudentModel->get_practicalSubjects(array('group_id'=>$group_id));
                                            
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
                        $stdAtts = $this->StudentModel->get_studentPractical_att($where);
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
                                $stdAttst = $this->StudentModel->get_studentPractical_att($wheret);

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
            </div>