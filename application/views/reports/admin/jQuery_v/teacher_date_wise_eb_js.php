            <div class="table-responsive">
                <h5>Timetable Report Teacher Name : <strong><?php echo $this->input->post('emp_name')?> </strong>  Date From :  <strong><?php echo $this->input->post('date_from')?> </strong> Date To :  <strong><?php echo $this->input->post('date_to')?> </strong></h5>
                <table class="table table-hover table-boxed" id="table" style="font-size:10px;">
                    <thead>
                        <tr>
                            <th width="10"> S.no</th>
                            <th width="160">Date</th>
                            <th>Attendance Details</th>
                            <th width="10">Total</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if(@$result):
                            $sn ='';
                            $G_class_count ='';
                    foreach($result as $rec):
                        $sn++;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $sn;?></td>
                            <td><?php echo date('d-m-Y',strtotime($rec->attendance_date));?> (<strong><?php echo date('l',strtotime($rec->attendance_date));?></strong>)</td>
                            <td><?php 
                                $where = array(
                                        'student_attendance.user_id'    => $this->db->get_where('users',array('user_empId'=>$rec->employeeId))->row()->id,
                                        'attendance_date'               => date('Y-m-d',strtotime($rec->attendance_date)),
                                        'timetable.day_id'              => date('N',strtotime($rec->attendance_date))
                                        );
                                        
                                        $this->db->select('student_attendance.timestamp as timestamp, sections.name,subject.title,class_starting_time.class_stime,class_ending_time.class_etime,subject.subject_id');
                                        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                        $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
                                        $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
                                        $this->db->join('timetable','timetable.class_id=class_alloted.class_id');
                                        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id','left outer');
                                        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id','left outer');
                                        $this->db->order_by('class_starting_time.class_stime','asc');
                                        $this->db->group_by('class_starting_time.class_stime');
//                                        $this->db->group_by('second(student_attendance.timestamp)');
//                                        $this->db->group_by('MINUTE(student_attendance.timestamp)');
                        $ClassDetails = $this->db->get_where('student_attendance',$where)->result();
                            
//                            echo '<pre>';print_r($ClassDetails);die;
                            
                            $class_count = ''; 
                            
                          if($ClassDetails):
                            $count_dubt = '';
                            $arr_count = count($ClassDetails);
                            $coma_count = '';
                            foreach($ClassDetails as $rowSec): 
                                        $class_count++;
                                        $coma_count++;
                                        echo '<label>';
//                                        echo $rowSec->name.' ( '.$rowSec->timestamp.')';
                                        echo $rowSec->name.' ( '.$rowSec->class_stime.'-'.$rowSec->class_etime.')';
                                        if($arr_count ==$coma_count):
                                            echo '</label>';
                                        else:
                                            echo '</label>,';
                                        endif;
                                        
                                    
                                
                              endforeach;
                               endif; ?>
                                
                                </td>
                            <td><?php echo $class_count; ?></td>
                           
                        </tr>
                        <?php
                        $G_class_count +=$class_count;
                            endforeach; 
                            echo  '<tr>';
                            echo   '<td></td>';
                            echo   '<td></td>';
                            
                            echo   '<td>G.Total</td>';
                            echo   '<td>'.$G_class_count.'</td>';
                            echo   '</tr>';
                            
                            endif;
                            ?>
                    </tbody>
                </table>
                        <?php echo $print_log;?>
                    </div>