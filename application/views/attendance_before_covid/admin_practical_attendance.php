        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
<h2 align="left"> Teachers Practical Attendance <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                   <form method="post">
                      <div class="col-md-12">
                    <div class="form-group col-md-3">
                       <input type="text" name="emp_id" class="form-control" id="emp">
                        <input type="hidden" name="emp_id" id="emp_id">
                    </div>
                     <div class="form-group col-md-3">
                        <input type="text" name="group_id" class="form-control" id="groupName">
                        <input type="hidden" name="group_id" id="group_id">
                    </div>
                    <div class="form-group col-md-3">
                       <select name="subject_id" class="form-control">
                            <option value="">Select Subject</option>
                            <?php
                                $pract = $this->db->query("SELECT * FROM practical_subject");
                                foreach($pract->result() as $subs){
                            ?>
                            <option value="<?php echo $subs->prac_subject_id?>"><?php echo $subs->title?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                            <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                            <i class="fa fa-search"></i> Search </button>
                     </div>
             </div>
                </form> 
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           <div class="row cols-wrapper">
                <div class="col-md-12">
                    <?php
                    if(@$result):
                    ?>
                    <div class="row box">
                    <?php   
                    foreach($result as $row)
                    {     
               ?>               
            <div class="col-md-2 col-xm-4">
                <p class="promo-badge">
                    <a class="RedDamask" href="AttendanceController/admin_practical_studentsAtts/<?php echo $row->practical_class_id;?>/<?php echo $row->prac_group_id;?>">
                       <span class="desc"><?php echo $row->emp_name;?></span><br>
                        <span class="desc"><?php echo $row->group_name;?>
                            <span class="off">(<?php 
    $where = array('group_id'=>$row->prac_group_id);                    
    echo count($this->AttendanceModel->prac_studentsAtts('student_prac_group_allottment                              ',$where)); 
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
               ?>   
                    </div>
                    <?php
                    else:
                        
                    endif;
               ?>   
               </div>
            </div>   
        </div><!--//content-->
   