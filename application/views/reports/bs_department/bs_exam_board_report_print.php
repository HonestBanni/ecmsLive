<script language="javascript">
function printdiv(printpage){
        var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' alt=''></p>";
        var footstr = "</body>";
        var newstr = document.all.item(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr+newstr+footstr;
        window.print();
        document.body.innerHTML = oldstr;
        return false;
}
</script>

        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">
                <?php echo $ReportName; ?> 
                 
                <hr>
            </h2>
            <div class="row cols-wrapper">
                      <div class="col-md-12">    
                      <div class="col-md-12">    
                          <p>
                        <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme" style="float: right"><i class="fa fa-print"></i> Print </button>
                          </p>
                         </div><!--//section-content-->
                         </div><!--//section-content-->
                        
                    </div>
               <div id="div_print">
                
                   
                   
                   <?php
//                echo '<pre>'; print_r($result); die;
                if(!empty($result)):
                ?>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <p>
                        <button type="button" class="btn btn-success">
                            <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
                        </button>
                        </p>
                        <table class="table table-hover table-boxed" id="table" style="font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle">S#</th>
                            <th style="vertical-align: middle">Employee Name</th>
                            <th style="vertical-align: middle">Section</th>
                            <th style="vertical-align: middle">Subject</th>
                            <th style="vertical-align: middle">Sub Program</th>
                            <?php
                            $test = $this->CRUDModel->getResults('exam_types');
                            foreach($test as $row):
                                echo '<th style="vertical-align: middle">'.$row->xt_title.'</th>';
                            endforeach;
                            ?>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    foreach($result as $rec):
                        echo '<tr class="gradeA">
                            <td>'.$i.'</td>
                            <td style="font-size:14px;">'.$rec->employee.'</td>
                            <td>'.$rec->section.'</td>
                            <td>'.$rec->subject.'</td>
                            <td>'.$rec->name.'</td>';
                            for($ex_id=1;$ex_id<=count($test);$ex_id++):
//                                $test_result = '';
                                $test_result = $this->CRUDModel->get_where_row('exams_bs', array('exb_class_id'=>$rec->class_id, 'exb_test_type'=>$ex_id));
                                if(!empty($test_result)):
                                    echo '<td><i class="fa fa-check text-success fa-2x"></i></td>';
                                else:
                                    echo '<td><i class="fa fa-close text-danger fa-2x"></i></td>';
                                endif;
                            endfor;
                        echo '</tr>';

                        $i++;
                    endforeach;
                    ?>
                    </tbody>
                </table> 
                    </div> 
                </div><!--//col-md-3-->
                <?php
                endif;
                ?>
                   
                   
                   
               </div>
        
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        