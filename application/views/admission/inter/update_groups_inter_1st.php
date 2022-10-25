<!-- ******CONTENT****** --> 
<div class="content container" style="margin-bottom:200px;">
    <!-- ******BANNER****** -->
    <h2 align="left">Update Groups Inter (1st Year) <hr></h2>
    
    
    <div class="row cols-wrapper">
        <div class="col-md-12">
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line">Student Search Panel</span>
                </h1>
                <div class="section-content"> 
                    <form method="post">
                        <div class="row">
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Section</label>
                                <div class="input-group" id="adv-search">
                                    <?php echo form_dropdown('sec_id',$sections,'',  'class="form-control"'); ?> 
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Student Name</label>
                                <div class="input-group" id="adv-search">
                                    <input type="text" name="student_name" class="form-control" placeholder="Student Name"> 
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Father Name</label>
                                <div class="input-group" id="adv-search">
                                    <input type="text" name="father_name" class="form-control" placeholder="Father Name">  
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">College #</label>
                                <div class="input-group" id="adv-search">
                                    <input type="text" name="college_no" class="form-control" placeholder="College No"> 
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label for="name" style="visibility: hidden">Father</label>
                                <input type="submit" name="search" class="btn btn-theme" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </section>
    
            <?php if(@$result): ?>
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
                    echo '<tr class="gradeA">
                         <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                         <td>'.$rec->student.'</td>
                         <td>'.$rec->father.'</td>
                         <td>'.$rec->college_no.'</td>
                         <td>'.$rec->gender.'</td>
                        <td>'.$rec->section.'</td>
                        <td>'.$rec->sub_program.'</td>
                        <td><a class="btn btn-success btn-sm" href="UpdateStudentGroupSingle1st/'.$rec->serial_no.'">Update</a></td>
                    </tr>';
                endforeach;
                ?>
                </tbody>
            </table>
            <?php endif;?>
   
        </div>
        
        <div class="row cols-wrapper">
            <form>
                <div class="col-md-12">
                    <?php
                    $q = $this->db->query("SELECT DISTINCT sections.name as section,sections.sec_id as sec_id,sections.status,sections.program_id 
                        from sections,student_group_allotment 
                        where student_group_allotment.section_id = sections.sec_id AND sections.program_id='1' AND sections.status='On' AND sections.sub_pro_id IN ('1','2','4','5') 
                        order by sections.name asc");
                    foreach($q->result() as $row):
                        $sec_id = $row->sec_id;
                        $s = $this->db->query("SELECT `student_record`.`student_name`
                        FROM `student_record`,`student_group_allotment` 
                        WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    

                        echo '<div class="col-md-3">
                            <div class="form-group">  
                                <a href="admin/view_student_group/'.$sec_id.'" class="btn btn-lg btn-primary form-control" style="padding:5px;">
                                    '.$row->section.' (Total: '.$s->num_rows().')
                                </a> 
                            </div>
                        </div>';
                    endforeach; ?>
                </div>
            </form>  
        </div>
    </div><!--//col-md-3-->

</div><!--//cols-wrapper-->
           
    
   