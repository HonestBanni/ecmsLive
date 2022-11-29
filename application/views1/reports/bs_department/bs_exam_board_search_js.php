   
               <!-- ******BANNER****** -->
             
             
                <?php
                if(!empty($result)):
                ?>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
                       <table class="table table-hover table-boxed" id="table">
                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th>Employee Name</th>
                            <th>Section Name</th>
                            <th>Subject Name</th>
                            <th>Sub Program</th>
                            <?php
                            $test = $this->CRUDModel->getResults('exam_types');
                            foreach($test as $row):
                                echo '<th>'.$row->xt_title.'</th>';
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
                                    echo '<td><a href="BSExamAwardList/'.$test_result->exb_test_id.'"><i class="fa fa-check text-success fa-2x"></i></a></td>';
                                else:
                                    echo '<td><i class="fa fa-close text-danger fa-2x"></i></td>';
                                endif;
                            endfor;
                            $count_test = $this->CRUDModel->get_where_result('exams_bs', array('exb_class_id'=>$rec->class_id, 'exb_test_type !='=>1));
                            if(count($count_test) != 0):
                                echo '<td><a href="AggregateResult/'.$rec->class_id.'"><button class="btn btn-primary btn-sm">Internal</button></a></td>';
                                echo '<td><a href="UOPResult/'.$rec->class_id.'"><button class="btn btn-theme btn-sm">UOP</button></a></td>';
                            else:
                                echo '<td><button class="btn btn-primary btn-sm disabled">Internal</button></td>';
                                echo '<td><button class="btn btn-theme btn-sm disabled">UOP</button></td>';
                            endif;
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
 
           
 
  
        
         