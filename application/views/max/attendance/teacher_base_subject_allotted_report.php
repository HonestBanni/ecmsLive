 <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Teacher Base Subject Allotted Report <hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post">
                      <div class="form-group col-md-2">
            <?php        
                
                if(!empty($emp_id)){
                    $empres = $this->AttendanceModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id));
                    foreach($empres as $emprec)
                    { ?>          
        <input type="text" name="emp_id" value="<?php echo $emprec->emp_name; ?>" placeholder="Employee" class="form-control" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $emprec->emp_id; ?>">      
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
                    
                    if(!empty($sec_id)){
                        $secres = $this->AttendanceModel->get_by_id('sections',array('sec_id'=>$sec_id));
                        foreach($secres as $secrec)
                        { ?>          
            <input type="text" name="sec_id" value="<?php echo $secrec->name; ?>" placeholder="Section" class="form-control" id="sec">
                        <input type="hidden" name="sec_id" id="sec_id" value="<?php echo $secrec->sec_id; ?>">      
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
                if(!empty($subject_id)){
                    $subres = $this->AttendanceModel->get_by_id('subject',array('subject_id'=>$subject_id));
                   
                        foreach($subres as $subrec)
                        { ?>          
            <input type="text" name="subject_id" value="<?php echo $subrec->title; ?>" placeholder="Subject" class="form-control" id="sub">
                        <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $subrec->subject_id; ?>">      
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
         <input type="submit" name="export" class="btn btn-theme" value="Export">
                </form>
            </div>
        </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                     <?php
                        if(!empty($result)):
                        ?> 
            <p>
                <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
                       <table class="table table-hover table-boxed" id="table">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Program Name</th>
                            <th>Sub Programe Name</th>
                            <th>Section Name</th>
                            <th>Subject Name</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php 
                    foreach($result as $rec){
                        ?>
            <tr class="gradeA">
                <td><?php echo $rec->employee;?></td>
                <td><?php echo $rec->program;?></td>
                <td><?php echo $rec->sub_program;?></td>
                <td><?php echo $rec->section;?></td>
                <td><?php echo $rec->subject;?></td>  
            </tr>

                        <?php
                        }
                    
                        ?>
                    </tbody>
                </table> 
                        <?php endif;?>
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   