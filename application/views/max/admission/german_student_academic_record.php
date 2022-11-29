<?php
		$this->load->helper('form');
		
		?>

				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Student Academic (Language)<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
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

        <form method="post" action="admin/german_student_academic_record/<?php echo $student_id;?>">
                      <div class="form-group col-md-4">
            <label for="usr">Degree / Certificate</label>
            <input type="text" name="degree_id" class="form-control" id="degree" required>
            <input type="hidden" name="degree_id" id="degree_id">
        <input type="hidden" value="<?php echo $student_id;?>" name="student_id"> 
   </div>
    <div class="form-group col-md-4">
            <label for="usr">Institute:</label>
            <input type="text" name="inst_id" class="form-control"> 
            <div id="suggestions">
              <div class="autoSuggestionsList_l" id="autoSuggestionsList"></div>
            </div>
   </div>
    <div class="form-group col-md-4">
            <label for="usr">Board/University</label>
            <input type="text" name="bu_id" class="form-control" id="bu">
            <input type="hidden" name="bu_id" id="bu_id">
        </div>
    <div class="form-group col-md-4">
            <label for="usr">Year of Passing:</label>
            <input type="number" name="year_of_passing" class="form-control"> 
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
            <label for="usr">CGPA:</label>
            <input type="text" name="cgpa" class="form-control"> 
   </div>
    <div class="form-group col-md-4">
      <label for="usr">Grade:</label>
    <?php 
    echo form_dropdown('grade_id', $grade, '',  'class="form-control" id="my_id"');
    ?> 
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
                <br><p>If Academic Details Completed Then Click on Done Button, Thanks... <a style="float:right; margin-right:550px;" href="admin/german_student_record" onclick="myFunction()" class="btn btn-primary">Done</a></p><br>    
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
                            <th>CGPA</th>
                            <th>Grade</th>
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
                            <td><?php echo $rec->cgpa;?></td>
                            <td><?php echo $rec->grade;?></td>
                            <td><?php echo $rec->exam_type;?></td>
                        </tr>
                        <?php
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>

            
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->