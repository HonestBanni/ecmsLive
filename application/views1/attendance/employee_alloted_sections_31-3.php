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
                        ?>
                    </div>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   