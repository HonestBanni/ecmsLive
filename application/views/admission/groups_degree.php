        <!-- ******CONTENT****** --> 
        <div class="content container" style="margin-bottom:200px;">
               <!-- ******BANNER****** -->
    <h2 align="left">Year Head All Groups <hr></h2>        
            <div class="row cols-wrapper">
                <div class="row cols-wrapper">
                    <form>
                        <?php
                    $q = $this->db->query("SELECT DISTINCT sections.name as section,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id AND sections.program_id='4'
            AND sections.status LIKE 'On' order by sections.name asc");
                            foreach($q->result() as $row)
                            {
                                $section_id = $row->sec_id;
                            $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$section_id' AND student_record.s_status_id='5'");    
                            ?>
                        <div class="col-md-2">
        <div class="form-group">  
    <a href="admin/view_student_group/<?php echo $section_id;?>">
    <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly></a> 
            </div>
                </div>
                         <?php } ?>
                    </form>
                </div>
                <div class="col-md-12">
                     
                    
                    <form method="post">
                        <div class="form-group col-md-2">
                            <?php 
                                echo form_dropdown('sec_id',$sections,'',  'class="form-control"');
                            ?>    
                        </div>
                        <div class="form-group col-md-2">
                           <input type="text" name="student_name" class="form-control" placeholder="Student Name">    
                        </div>
                        <div class="form-group col-md-2">
                           <input type="text" name="father_name" class="form-control" placeholder="Father Name">    
                        </div>
                        <div class="form-group col-md-2">
                           <input type="text" name="college_no" class="form-control" placeholder="College No">    
                        </div>
                        <input type="submit" name="search" class="btn btn-theme" value="Search">
                    </form>
                </div>
                <?php
                if(@$result):
                ?>
                    <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>
            </p>   
                
                    <table  border="0" class=" table table-boxed table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Student Image</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>College No.</th>
                            <th>Gender</th>
                            <th>Section Name</th>
                            <th>Program</th>
                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php       
                foreach($result as $rec):
                ?>
            <tr class="gradeA">
                 <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                 <td><?php echo $rec->student;?></td>
                 <td><?php echo $rec->father;?></td>
                 <td><?php echo $rec->college_no;?></td>
                 <td><?php echo $rec->gender;?></td>
                <td><?php echo $rec->section;?></td>
                <td><?php echo $rec->sub_program;?></td>
                <td><a class="btn btn-success btn-sm" href="admin/update_student_by_group_degree/<?php echo $rec->serial_no;?>">Update</a></td>
            </tr>

                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
                   <?php endif;?>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
    
   