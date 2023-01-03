            <div class="table-responsive">
                <h5> Teacher Monthly Attendance Report  ( <?php
                        $year = $this->input->post('Year');
                        $month = $this->input->post('Month');
                      echo   date('F, Y',strtotime('1-'.$month.'-'.$year));
                ?> )</h5>
                <table class="table table-hover table-boxed" id="table" style="font-size:10px;">
                    <thead>
                 
                        <?php
                        
                        $days =   cal_days_in_month(CAL_GREGORIAN,$month,$year);
                        $i= '';
                         echo '<tr>';
                         echo '<th>S.No</th>';
                         echo '<th>Teacher Name</th>';
                            for($i=1 ;$i<=$days ; $i++):
                               echo '<th>'.$i.'</th>';
                            endfor;
                        echo '<th> Total</th>';
                        echo '</tr>';
                        ?>
                       
                    </thead>
                    <tbody>
                       <?php
                       
                       if($result):
                        $sn = ''; 
                       foreach($result as $rowEmp):
                           $sn++;
                            echo '<tr>';
                            echo '<td>'.$sn.'</td>';
                            echo '<td>'.$rowEmp->emp_name.'</td>';
                             $total_count = ''; 
                            for($i=1 ;$i<=$days ; $i++):
//                                $id= $this->db->get_where('users',array('user_empId'=>$rowEmp->emp_id))->row();
                                 $where = array(
//                                    'emp_id'            => $rowEmp->emp_id,
                                     'student_attendance.user_id'    => $rowEmp->id,
                                    'attendance_date'   => $year.'-'.$month.'-'.$i,
                                     'timetable.day_id'=> date('N',strtotime($year.'-'.$month.'-'.$i))
                                );


                                        $this->db->select('sections.name,subject.title,class_starting_time.class_stime,class_ending_time.class_etime,subject.subject_id');
                                        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                        $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
                                        $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
                                        $this->db->join('timetable','timetable.class_id=class_alloted.class_id');
                                        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id','left outer');
                                        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id','left outer');
                                        $this->db->order_by('class_starting_time.class_stime','asc');
                                        $this->db->group_by('class_starting_time.class_stime');
                            $return = $this->db->get_where('student_attendance',$where)->result();
                           
                           
                            echo '<td>';                   
                            if($return):
                                echo count($return);
                                   $total_count +=count($return);
                                 endif;  
                            echo '</td>';  
                          
                            endfor;
                            
                            echo '<td>'.$total_count.'</td>'; 
                            
                        echo '</tr>';
                        endforeach; 
                       endif;
  
                        ?>
                       
                    </tbody>
                </table>
                        <?php echo $print_log;?>
                    </div>