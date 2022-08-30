        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <?php
                if($result):
                foreach($result as $rec);
            ?>
        <h2 align="left"> <strong style="color:green"><?php echo $rec->employee;?></strong>: Pre Board Test<hr></h2>
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
                                <a class="OliveDrab" href="AttendanceController/pre_board_sectionbasetest/<?php echo $row->class_id;?>/<?php echo $row->sec_id;?>">
                                   
                                    <span class="desc"><?php echo $row->section;?>
                                        <span class="off">(<?php 
            echo count($this->CRUDModel->get_where_result('student_group_allotment',array('section_id'=>$row->sec_id))) 
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
                                <a class="OliveDrab" href="AttendanceController/pre_board_subjectbasetest/<?php echo $row->class_id;?>/<?php echo $row->sec_id;?>/<?php echo $row->subject_id;?>">
                                   
                                    <span class="desc"><?php echo $row->section;?>
                                        <span class="off">(<?php 
            echo count($this->CRUDModel->get_where_result('student_subject_alloted',array('subject_id'=>$row->subject_id,'section_id'=>$row->sec_id))) 
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
   