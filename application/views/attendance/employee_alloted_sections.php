        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <?php
           
                if($result):
                    foreach($result as $rec);
            ?>
               <h2 align="left"> <strong style="color:green"><?php echo $rec->employee;?></strong>:  Classes for  <strong><?php echo date('l') ?></strong>  Only<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <div class="row box">
                    <?php
                 
                    foreach($result as $row): 
                            $nowDate = date('l');
                         
                        $whereChk = array('class_id' => $row->class_id,
                                        'day_name' => $nowDate
                                );              
                                        $this->db->join('days','days.day_id=timetable.day_id'); 
                        $check_class =  $this->db->get_where('timetable',$whereChk)->result();
                       
                           
                         ?>               
                             <div class="col-md-2 col-xm-4">
                                 <p class="promo-badge">
                                     <a class="RedDamask" href="AttendanceController/studentsAtts/<?php echo $row->class_id;?>/<?php echo $row->sec_id;?>">
                                         <span class="desc"><?php echo $row->section;?>
                                             <span class="off">(<?php 
                                                     $where = array('section_id'=>$row->sec_id);                    
                                                     echo count($this->AttendanceModel->get_studentsAtts('student_group_allotment',$where)); 
                                                 ?>)
                                                 
                                             </span>
                                         </span> 
                                         <br>
                                         <span class="desc"><?php echo $row->subject;?></span>                  
                                     </a>
                                 </p>
                              </div>
                        <?php
                         
                            endforeach;
                      endif;
                      
                      
                      if($subjectbase):
                          
                   
                    foreach($subjectbase as $row){
                          
                               $nowDate = date('l');
                         
                        $whereChks = array('class_id' => $row->class_id,'day_name' => $nowDate );              
                                            $this->db->join('days','days.day_id=timetable.day_id'); 
                        $check_classSub =   $this->db->get_where('timetable',$whereChks)->row();
                       
                           
                          ?>               
                        <div class="col-md-2 col-xm-4">
                            <p class="promo-badge">
                                <a class="RedDamask" href="AttendanceController/studentsSubjectsAtts/<?php echo $row->class_id;?>/<?php echo $row->sec_id;?>/<?php echo $row->subject_id;?>">
                                   
                                    <span class="desc"><?php echo $row->section;?>
                                        <span class="off">(<?php
                                                $where = array('student_subject_alloted.subject_id'=>$row->subject_id,'student_subject_alloted.section_id'=>$row->sec_id);            
                                                echo count($this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where)); 
                                        ?>)
                                        </span>
                                    </span> 
                                    <br>
                                    <span class="desc"><?php echo $row->subject;?></span>                  
                                </a>
                            </p>
                         </div>
                        <?php
                         
                        }
                  endif;
                      if($merged_show):
                          
                   
                    foreach($merged_show as $row){
                          
                               $nowDate = date('l');
                         
                        $whereChks = array('class_id' => $row->class_id,'day_name' => $nowDate );              
                                            $this->db->join('days','days.day_id=timetable.day_id'); 
                        $check_classSub =   $this->db->get_where('timetable',$whereChks)->row();
                      
//                          if($check_classSub):
                            
                            echo '<div class="col-md-2 col-xm-4">
                                <p class="promo-badge">
                                    <a class="RedDamask" href="AttendanceController/students_merged_atts/'.$row->ca_merge_id.'/'.$row->subject_id.'" style="-webkit-border-radius: 10%; -moz-border-radius: 10%; -ms-border-radius: 10%; -o-border-radius: 10%; border-radius: 10%;">';
                                        $merged_grps  = $this->AttendanceModel->get_alloted_merged('class_alloted',array('class_alloted.emp_id' => $row->emp_id, 'class_alloted.ca_merge_id' => $row->ca_merge_id));
                                        foreach($merged_grps as $mrow):
                                            echo '<span class="desc">'.$mrow->section.
                                                '<span class="off"> [';
                                                    if($mrow->flag == 1):
                                                        $where = array('section_id'=>$mrow->sec_id);                    
                                                        echo count($this->AttendanceModel->get_studentsAtts('student_group_allotment',$where));
                                                    else:
                                                        $where = array('student_subject_alloted.subject_id'=>$mrow->subject_id,'student_subject_alloted.section_id'=>$mrow->sec_id);            
                                                        echo count($this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where)); 
                                                    endif;
                                                echo ']
                                                </span>
                                            </span><br>'; 
                                        endforeach;
                                        
                                        echo '<span class="desc" style="font-size: 15px;"><strong>'.$row->subject.'</strong></span>                  
                                    </a>
                                </p>
                             </div>';
//                        else:
//                            echo '<div class="col-md-2 col-xm-4">
//                                <p class="promo-badge">
//                                    <a class="RedDamask" href="AttendanceController/no_class_alloted" style="-webkit-border-radius: 10%; -moz-border-radius: 10%; -ms-border-radius: 10%; -o-border-radius: 10%; border-radius: 10%;">';
//                                        $merged_grps  = $this->AttendanceModel->get_alloted_merged('class_alloted',array('class_alloted.emp_id' => $row->emp_id, 'class_alloted.ca_merge_id' => $row->ca_merge_id));
//                                        foreach($merged_grps as $mrow):
//                                            echo '<span class="desc">'.$mrow->section.
//                                                '<span class="off"> [';
//                                                    if($mrow->flag == 1):
//                                                        $where = array('section_id'=>$mrow->sec_id);                    
//                                                        echo count($this->AttendanceModel->get_studentsAtts('student_group_allotment',$where));
//                                                    else:
//                                                        $where = array('student_subject_alloted.subject_id'=>$mrow->subject_id,'student_subject_alloted.section_id'=>$mrow->sec_id);            
//                                                        echo count($this->AttendanceModel->get_students_subjectAtts('student_subject_alloted',$where)); 
//                                                    endif;
//                                                echo ']
//                                                </span>
//                                            </span><br>'; 
//                                        endforeach;
//                                        echo '<span class="desc" style="font-size: 15px;"><strong>'.$row->subject.'</strong></span>                  
//                                    </a>
//                                </p>
//                             </div>';
//                         endif;
                        }
                  endif;
                        ?>
                    </div>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->