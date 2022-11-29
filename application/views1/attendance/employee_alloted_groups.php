        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <?php         
                if($result):
                foreach($result as $rec);
            ?>
        <h2 align="left"> <strong style="color:green"><?php echo $rec->emp_name;?></strong>:  Attendance Profile<hr></h2>
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
                                <a class="Mojo" href="AttendanceController/practical_studentsAtts/<?php echo $row->practical_class_id;?>/<?php echo $row->prac_group_id;?>">
                                   
                                    <span class="desc"><?php echo $row->group_name;?>
                                        <span class="off">(<?php 
                                                $where = array('group_id'=>$row->prac_group_id);                    
                                                echo count($this->AttendanceModel->prac_studentsAtts('student_prac_group_allottment',$where)); 
                                ?>)
                                        </span>
                                    </span> 
                                    <br>
                                    <span class="desc"><?php echo $row->title;?></span>                  
                                </a>
                            </p>
                         </div>
                        <?php
                        }
                        else:
                        echo "<h3 style='color:red'>Sorry, Records Not Found..!</h3>";
                      endif;    
               ?>   
                    </div>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   