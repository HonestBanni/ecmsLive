<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <form method="post">
                <!--<button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>-->
                <a target="_blank" href="UOPResultPrint/<?php echo $sec_info->exb_class_id ?>" class="btn btn-theme"><i class="fa fa-print"></i> Print</a>
            </form>
            <div id="div_print">
                <div class="col-md-12">
                    <h4 align="center"><?php echo $sec_info->sub_pro_name.' &nbsp; '.$sec_info->batch_name;?></h4>
                    <h4 align="center">EDWARDES COLLEGE PESHAWAR</h4>    
                <table style="width:100%; padding: 0px;">
                    <tr>
                        <td><h4><?php echo $sec_info->subject_name;?></h4></td>
                        <td><h4 align="right">Credit Hours : 3</h4></td>
                    </tr>
                </table>
                <div class="row cols-wrapper">
                    <div class="col-md-12">

                        <table class="table table-boxed table-bordered">
                        <thead>
                            <tr>
                                <th>Enrollment No.</th>
                                <th>Student Name</th>
                                <th>Internal Marks</th>
                                <th>In Words</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($result as $rec){
                        ?>
                            <tr class="gradeA">
                                <td><?php echo $rec->bs_enrollment_no; ?></td>
                                <td><?php echo $rec->student_name;?></td>
                                <td>
                                <?php
                                $mid = $this->ReportsModel->get_midterm_students(array('exbd_student_id'=>$rec->student_id, 'exb_class_id'=>$rec->class_id, 'exb_test_type'=>1), 'row');
                                if(!empty($mid)):
                                    $mid_obt = $mid->exbd_omarks;
                                    $mid_ttl = $mid->exb_test_marks;
                                    $mid_aggr = $mid_obt / $mid_ttl * 25;
//                                    echo round($mid_aggr).' / 25';
                                else:
                                    $mid_obt = 0;
                                    $mid_ttl  = 25;
                                endif;
                                
                                $all = $this->ReportsModel->get_midterm_students(array('exbd_student_id'=>$rec->student_id, 'exb_class_id'=>$rec->class_id, 'exb_test_type !='=>1), 'result');
                                    $total_obt = 0;
                                    $grd_total = 0;
                                if(!empty($all)):
                                    foreach($all as $all_row):
                                        $total_obt += $all_row->exbd_omarks;
                                        $grd_total += $all_row->exb_test_marks;
                                    endforeach;
//                                    echo $total_obt.'/'.$grd_total.' ';
                                    $aggregate_total = $total_obt / $grd_total * 15;
//                                    echo round($aggregate_total).' / 15';
//                                    echo '<pre>'; print_r($all); echo '</pre>';
                                endif;
                                
                                $internal_obt = $total_obt + $mid_obt;
                                $internal_ttl = $grd_total + $mid_ttl;
                                $internal_aggr = $internal_obt / $internal_ttl * 40;
                                
                                echo round($internal_aggr);
                                ?>
                                </td>
                                <td><?php echo $this->CRUDModel->numtowords(round($internal_aggr)); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                        
                    </div>
                </div><!--//cols-wrapper-->
                </div>
            </div>
             
        </div><!--//content-->
   