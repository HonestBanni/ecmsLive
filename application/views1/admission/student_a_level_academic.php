<?php
		$this->load->helper('form');
		
		?>

				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Academic Record (A Level)<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;">
            <?php print_r($this->session->flashdata('insert_msg'));?>
        </h4>
        <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
        </h4>
									</div>
<script>
function myFunction() {
    alert("You have inserted Student Id: <?php echo $this->uri->segment(3);?>");
}
</script>
<br />
<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/student_a_level_academic/<?php echo $student_id;?>">
    <div class="form-group col-md-4">
            <label for="usr">Degree / Certificate:</label>
            <select type="text" name="degree_id" class="form-control" required>
               <?php
                $b = $this->db->query("SELECT * FROM degree WHERE degree_id=36");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->degree_id;?>"><?php echo $brec->title;?></option>
                <?php 
                }
                ?>
            </select>
       <input type="hidden" value="<?php echo $student_id;?>" name="student_id"> 
   </div>
    <div class="form-group col-md-4">
            <?php 
            $where = array('student_id'=>$student_id);
            $std = $this->CRUDModel->get_where_row('student_record',$where);
        ?>
            <label for="usr">Institute:</label>
            <input type="text" name="inst_id" value="<?php echo $std->last_school_address;?>" class="form-control">
   </div>
    <div class="form-group col-md-4">
            <label for="usr">Board/University</label>
        <select type="text" name="bu_id" class="form-control" required>
               <?php
                $b = $this->db->query("SELECT * FROM board_university WHERE bu_id=30");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->bu_id;?>"><?php echo $brec->title;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
    <div class="form-group col-md-4">
            <label for="usr">Year of Passing:</label>
            <select name="year_of_passing" class="form-control">
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
            </select>
   </div>
    <div class="form-group col-md-4">
            <label for="usr">Total Marks:</label>
            <input type="number" name="total_marks" class="form-control" required> 
   </div> 
    <div class="form-group col-md-4">
            <label for="usr">Obtained Marks:</label>
            <input type="number" name="obtained_marks" class="form-control" required> 
   </div>
    <div class="form-group col-md-4">
            <label for="usr">Grade:</label>
        <select name="grade_id" class="form-control">
            <option value="">Select Grade</option>
            <?php
            $qry = $this->CRUDModel->getResults('grade');
            foreach($qry as $grec):
            ?>
                <option value="<?php echo $grec->grade_id;?>"><?php echo $grec->grade_name;?></option>
            <?php
            endforeach;
            ?>
        </select>
   </div>
    <div class="form-group col-md-4">
            <label for="usr">CGPA:</label>
            <input type="text" name="cgpa" class="form-control"> 
   </div> 
    <div class="form-group col-md-4">
    <label for="usr">Exam Type:</label>
     <select name="exam_type" class="form-control">
            <option value="annual">Annual</option>
            <option value="supply">Supply</option>
        </select> 
   </div>
    <div class="form-group col-md-4">
    <label for="usr"></label>
            <input type="hidden" class="form-control"> 
   </div>
    <div class="form-group col-md-4">
        <input type="submit" class="btn btn-theme" name="submit" value="Add Record">
    </div>
    
    </form>
                  
            <br>
             <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Degree</th>
                            <th>Board/University</th>
                            <th>Institute</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>%age</th>
                            <th>Grade</th>
                            <th>CGPA</th>
                            <th>Exam Type</th>
                        </tr>
                    </thead>
                    <tbody>
                 <?php
                        if($student_records):
                        foreach($student_records as $rec):
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->Degreetitle;?></td>
                            <td><?php echo $rec->bordTitle;?></td>
                            <td><?php echo $rec->inst_id;?></td>
                            <td><?php echo $rec->total_marks;?></td>
                            <td><?php echo $rec->obtained_marks;?></td>
                            <td><?php echo $rec->percentage;?> %</td>
                            <td><?php echo $rec->grade;?></td>
                            <td><?php echo $rec->cgpa;?></td>
                            <td><?php echo $rec->exam_type;?></td>
                        </tr>
                        <?php
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>

            <div class="alert alert-info col-md-12">
           <strong>For O Level Students : </strong>,&nbsp;&nbsp;&nbsp;  
            <strong> Enter Subject Wise Grade </strong>
        </div>
        <form method="post">
            <div class="row">
        <div class="col-md-12">
        <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id;?>">
                <div class="form-group col-md-3">
                    <select name="ol_subject_id" id="ol_subject_id" class="form-control">
                        <option value="">Select Subject</option>
                        <?php 
                        $gr = $this->CRUDModel->getResults('subjects_olevel');
                        foreach($gr as $row):
                        ?>
            <option value="<?php echo $row->ol_subject_id;?>"><?php echo $row->ol_subject_name;?></option>
                        <?php endforeach;?>
                    </select>    
                </div>
                <div class="form-group col-md-3">
                    <select name="grade_id" id="grade_id" class="form-control">
                        <option value="">Select Grade</option>
                        <?php 
                        $gr = $this->CRUDModel->getResults('grade');
                        foreach($gr as $row):
                        ?>
            <option value="<?php echo $row->grade_id;?>"><?php echo $row->grade_name;?></option>
                        <?php endforeach;?>
                    </select>    
                </div>
                <div class="form-group col-md-2">
            <input type="button" name="add_grade" id="addgrade" value="Add Subject Grade" class="btn btn-theme">
                </div>
         </div>
           </div>
                </form> 
            <br>
    </div>
                <h4 style="color:red; text-align:center;">
                    <?php print_r($this->session->flashdata('ms'));?>
                </h4>
            <div id="grade_record">
                
            </div>
            <div id="result_record">
                 <?php
                        if(@$grade):
                ?>
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($grade as $eRow): ?>
                        <tr>
                            <td><?php echo $eRow->student_name; ?></td>
                            <td><?php echo $eRow->ol_subject_name; ?></td>                       
                            <td><?php echo $eRow->grade_name; ?></td>                          
                            <td><a href="admin/delete_student_grade/<?php echo $eRow->id;?>" onclick="return confirm('Are You Want to Delete..?')">Delete</a></td>
                           </tr>                      
                        <?php
                        endforeach;  ?>                     
                    </tbody>
                </table>
              <?php
                endif; ?>
            </div>
        <div class="form-group col-md-12">
        <p style="margin-left:200px; color:red">If Academic Details Completed Then Click on Done Button, Thanks... <a style="float:right; margin-right:450px;" href="admin/a_level_student_record" onclick="myFunction()" class="btn btn-primary">Done</a></p><br>    
            <br>
    </div>        
        
             

            
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           