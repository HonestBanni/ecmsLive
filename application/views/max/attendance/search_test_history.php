<div class="content container">
    <h2 align="left">Sections List<hr></h2>
        <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post" action="AttendanceController/search_test_history">
        <div class="form-group col-md-2">
            <?php
                $gres = $this->AttendanceModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id));
                if($gres){
                    foreach($gres as $grec)
                    { ?>          
        <input type="text" name="emp_id" value="<?php echo $grec->emp_name; ?>" placeholder="Employee" class="form-control" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $grec->emp_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="emp_id" placeholder="Employee" class="form-control" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id">    
                    <?php
                    }    
                ?>                  
            </div>
                    
            <div class="form-group col-md-2">
                <?php
                    $gres = $this->AttendanceModel->get_by_id('sections',array('sec_id'=>$sec_id));
                    if($gres){
                        foreach($gres as $grec)
                        { ?>          
            <input type="text" name="sec_id" value="<?php echo $grec->name; ?>" placeholder="Section" class="form-control" id="sec">
                        <input type="hidden" name="sec_id" id="sec_id" value="<?php echo $grec->sec_id; ?>">      
                        <?php 
                        }     
                    }else{?>
                    <input type="text" name="sec_id" placeholder="Section" class="form-control" id="sec">
                            <input type="hidden" name="sec_id" id="sec_id">    
                        <?php
                        }    
                    ?>                  
            </div>
                    
            <div class="form-group col-md-2">
                <?php
                    $gres = $this->AttendanceModel->get_by_id('subject',array('subject_id'=>$subject_id));
                    if($gres){
                        foreach($gres as $grec)
                        { ?>          
            <input type="text" name="subject_id" value="<?php echo $grec->title; ?>" placeholder="Subject" class="form-control" id="sub">
                        <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $grec->subject_id; ?>">      
                        <?php 
                        }     
                    }else{?>
                   <input type="text" name="subject_id" placeholder="Subject" class="form-control" id="sub">
                            <input type="hidden" name="subject_id" id="subject_id">   
                        <?php
                        }    
                    ?>                  
            </div>
                    
                         <input type="submit" name="search" class="btn btn-theme" value="Search">
                </form>
            </div>
        </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <div class="row box">
                    <?php
                    foreach($result as $row)
                    {
                        $subject = $row->subject;
                    ?>     
                        <div class="col-md-2 col-xm-4">
                            <p class="promo-badge">
                                <a class="OliveDrab" href="AttendanceController/admin_sectionbasetest/<?php echo $row->class_id;?>/<?php echo $row->sec_id;?>">
                                   
                                    <span class="desc"><?php echo $row->employee;?></span><br>
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
                        foreach($subjectbase as $row)
                    {     
               ?>               
                        <div class="col-md-2 col-xm-4">
                            <p class="promo-badge">
                                <a class="OliveDrab" href="AttendanceController/admin_subjectbasetest/<?php echo $row->class_id;?>/<?php echo $row->sec_id;?>/<?php echo $row->subject_id;?>">
                                   
                                    <span class="desc"><?php echo $row->employee;?></span><br>
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
                        
                        ?>
                    </div>
                </div><!--//col-md-3-->    
            </div><!--//cols-wrapper-->   
        </div><!--//content-->
   