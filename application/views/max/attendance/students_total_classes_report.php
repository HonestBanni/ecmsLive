        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <?php
           
                if($result):
                    
              
                foreach($result as $rec);
            ?>
        <h2 align="left"> <strong style="color:green"><?php echo $rec->employee;?></strong>: Students Total Classes Report<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <div class="row box">
                    <?php       
                    foreach($result as $row)
                    {     
               ?>               
                <div class="col-md-2 col-xm-4">
                    <p class="promo-badge">
                        <a class="OliveDrab" href="STCHR/<?php echo $row->sec_id?>/<?php echo $row->subject_id?>/<?php echo $row->emp_id?>/<?php echo $row->flag?>">
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
                        }
                      endif;
                      if($subjectbase):
                          
                   
                    foreach($subjectbase as $row)
                    {     
               ?>               
                        <div class="col-md-2 col-xm-4">
                            <p class="promo-badge">
                        <a class="OliveDrab" href="STCHR/<?php echo $row->sec_id?>/<?php echo $row->subject_id?>/<?php echo $row->emp_id?>/<?php echo $row->flag?>">   
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
   