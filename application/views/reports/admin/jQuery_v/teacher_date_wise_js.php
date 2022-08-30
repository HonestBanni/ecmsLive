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
                                    'emp_id'          => $rec->employeeId,
                                    'attendance_date' => date('Y-m-d',strtotime($rec->attendance_date)),
                                    'timetable.day_id'=> date('N',strtotime($rec->attendance_date))
                                );
                                        
                                        $this->db->select('sections.name,subject.title,class_starting_time.class_stime,class_ending_time.class_etime,subject.subject_id');
                                        $this->db->join('class_alloted','class_alloted.class_id=student_attendance.class_id');
                                        $this->db->join('sections','sections.sec_id=class_alloted.sec_id');
                                        $this->db->join('subject','subject.subject_id=class_alloted.subject_id');
                                        $this->db->join('timetable','timetable.class_id=class_alloted.class_id');
                                        $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id','left outer');
                                        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id','left outer');
//                                        $this->db->order_by('sections.name','asc');
                                        $this->db->order_by('class_starting_time.class_stime','asc');
                                        $this->db->group_by('class_starting_time.class_stime');
                            $ClassDetails = $this->db->get_where('student_attendance',$where)->result();
                            
//                            echo '<pre>';print_r($sctions);die;
                            
                            $class_count = ''; 
                            
                          if($ClassDetails):
                            $count_dubt = '';
                            $arr_count = count($ClassDetails);
                            $coma_count = '';
                            foreach($ClassDetails as $rowSec): 
                                        $class_count++;
                                        $coma_count++;
                                        echo '<label>';
                                        echo $rowSec->name.' ( '.$rowSec->class_stime.'-'.$rowSec->class_etime.' )';
                                        if($arr_count ==$coma_count):
                                            echo '</label>';
                                            else:
                                            echo '</label>, ';
                                        endif;
                                        
                                    
                                
                              endforeach;
                               endif;
//                              $where_pra = array(
//                                    'emp_id'          => $rec->employeeId,
//                                    'attendance_date' => date('Y-m-d',strtotime($rec->attendance_date)),
//                                );
//                                                $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
//                                                $this->db->join('practical_group','practical_group.prac_group_id=practical_alloted.group_id');
//                           $practical_alloted = $this->db->get_where('practical_alloted',$where_pra)->result();   
//                            
//                             if ($practical_alloted):
//                                 
//                               
//                            foreach($practical_alloted as $rowPrtl):
//                                $class_count++;
//                                echo '<button class="btn btn-primary btn-sm">';
//                                echo $rowPrtl->group_name;
//                                echo '</button> &nbsp;';
//                              endforeach;
//                           endif;
                       
                            ?>
                                
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