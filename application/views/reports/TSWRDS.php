        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            
            <div class="row cols-wrapper">
                   
                <div class="col-md-12">
                    <div class="table-responsive">
                       <table class="table table-hover table-boxed" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>College No</th>
                            <th>Student Name</th>
                            <th>father Name</th>
                            <th>Section</th>
                            <th>Attendance</th>
                       
                            <th>Total</th>
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         
                        if(@$result):
                            
                    $sn ='';
                    foreach($result as $rec):
                        $sn++;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $sn;?></td>
                            <td><?php echo $rec->college_no;?></td>
                            <td><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->father_name;?></td>
                            <td><?php echo $rec->sectionName;?></td>
                            <td><?php 
                                
                            $where = array(
                                'sec_id'        =>$this->uri->segment(2),
                                'subject_id'    =>$this->uri->segment(3),
                                'emp_id'        =>$this->uri->segment(4),
                                'student_attendance_details.student_id' =>$rec->student_id,
                            );
                            $result = $this->ReportsModel->get_student_attendance($where);
                            $p = 0;
                            $a = 0;
                            foreach($result as $atRow):
                                $date1 = date_create($atRow->attendance_date);
                                $date = date_format($date1,'d-M');
                                if($atRow->status == 1):
                                    $p++;
                                    echo '<span class="label label-success">'.$date.'/P</span>&nbsp;';
                                    else:
                                        $a++;
                                        echo '<span class="label label-danger">'.$date.'/A</span>&nbsp;';
                                endif;
                            endforeach;
                            ?></td>
                            <td><?php echo '<span class="badge badge-success">'.$p.'</span><span class="badge badge-danger">'.$a.'</span>';?></td>
                          
                        </tr>
                        <?php
                            endforeach; 
                            endif;
                            ?>
                    </tbody>
                </table> 
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   