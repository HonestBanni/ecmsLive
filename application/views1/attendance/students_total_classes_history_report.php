        <div class="content container">
               <!-- ******BANNER****** -->
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
               
    <div class="row cols-wrapper">
        <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
        <div id="div_print">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h4 class="has-divider text-highlight">Teacher: <?php echo $empyee_name->emp_name?>, Section: <?php echo $sections->name?>, Subject: <?php echo $subject->title?></h4>
                   <table class="table table-hover table-boxed">
                    <thead>
                    <tr>
                      <th>#</th>
                       <th>Clg#</th>
                        <th>Name</th>
                       <th>Present</th>
                       <th>Absent</th>
                       <th>Total</th>
                       <th>%Age</th>
                    </tr>
                </thead>
                    <tbody>
                        
                        <?php
                             
                            if($result):
                               
                               $sn = '0';
                                
                                foreach($result as $row):
                                    $sn++;
                                    $where['student_id']                = $row->student_id;
                                    $where['class_alloted.sec_id']      = $this->uri->segment(2);
                                    $where['class_alloted.subject_id']  = $this->uri->segment(3);
                                    $where['class_alloted.emp_id']      = $this->uri->segment(4);
                                
                                
                                    echo '<tr>';
                                        echo '<td>'.$sn.'</td>';    
                                        echo '<td>'.$row->college_no.'</td>';    
                                        echo '<td>'.$row->student_name.'</td>'; 
                                        echo '<td>';
                                $p = '';
                                $gp = '';
                                $total = '';
                                $presult = $this->AttendanceModel->get_student_attendance_present($where);
                                if(!empty($presult)):
                                    foreach($presult as $pRow):
                                        $p = $pRow->status;
                                            $gp += $p;
                                    endforeach;
                                        echo $gp;
                                endif;
                                echo '</td>';
                                echo '<td>';
                                $a = '';
                                $ga = '';
                                $aresult = $this->AttendanceModel->get_student_attendance_absent($where);
                                if(!empty($aresult)):
                                    foreach($aresult as $aRow):
                                        $a = $aRow->status;
                                            $a++;
                                            $ga += $a;
                                    endforeach;
                                        echo $ga;
                                 endif;
                                        echo '</td>';    
                                        echo '<td>';
                                         $total = $ga + $gp;
                                        echo $total;
                                        echo '</td>'; 
                                        $total = $ga + $gp;
                                      if(!empty($total)):
                                           $per = ($gp/$total)*100;  
                                         echo '<td>'.round(@$per,2).'%</td>';
                                         else:
                                             echo '<td></td>';
                                      endif;
                                    echo '</tr>';
                                  endforeach;
                            endif;
                         ?> 
                    </tbody>
                </table> 
                    </div>
                   
                    
                </div><!--//col-md-3-->
                </div> 
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   