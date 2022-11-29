<script>
function myFunction() {
    alert("You have inserted Student Id: <?php echo $this->uri->segment(3);?>");
}
</script>
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Alumni Academic Record<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AdminDeptController/alumni_academic_record/<?php echo $student_id;?>">
                <input type="hidden" value="<?php echo $student_id;?>" name="student_id"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">Degree / Certificate:</label>
                   <input type="text" name="degree_id" class="form-control" placeholder="Degree Name" id="degree" required>
            	   <input type="hidden" name="degree_id" id="degree_id">   
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Institute:</label>
        <input type="text" name="inst_id" data-original-title="" class="form-control">   
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Board / University:</label>
                  <input type="text" name="bu_id" class="form-control" id="bu" placeholder="Type University">
            	  <input type="hidden" name="bu_id" id="bu_id">
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Roll No.:</label>
                  <input type="text" name="rollno" class="form-control"> 
              </div>
                <div class="form-group col-md-4">
                  <label for="usr">Year of Passing:</label>
                  <input type="text" name="year_of_passing" class="form-control"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Total Marks:</label>
                  <input type="text" name="total_marks" class="form-control"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Obtained Marks:</label>
                  <input type="text" name="obtained_marks" class="form-control"> 
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
                    <option value="">Exam Type</option>
                    <option value="annual">Annual</option>
                    <option value="Supply">Supply</option>
                </select>
              </div>
          </div>
         <div class="form-group">
                    <input style="margin-left:30px;" type="submit" class="btn btn-theme" name="submit" value="Add Record">
              </div> 
        </div>            
                </form>
                <br><p>If Academic Details Completed Then Click on Done Button, Thanks... <a style="float:right; margin-right:550px;" href="<?php echo base_url();?>AdminDeptController/Alumni_record" onclick="myFunction()" class="btn btn-theme">Done</a></p><br>    
            <br>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Degree</th>
                             <th>Passing Year</th>
                             <th>Total Marks</th>
                             <th>Obtained Marks</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($alumni_records):
                        foreach($alumni_records as $empRow):
                           echo '<tr>';
                                echo '<td>'.$empRow->student_name.'</td>';
                                echo '<td>'.$empRow->Degreetitle.'</td>';
                                echo '<td>'.$empRow->year_of_passing.'</td>';
                                echo '<td>'.$empRow->total_marks.'</td>';
                                echo '<td>'.$empRow->obtained_marks.'</td>';
                                echo '<td>'.$empRow->grade_name.'</td>';
                           echo '</tr>';
                        
                        endforeach;
                        
                        endif;
     
                        ?>


                    </tbody>
                </table>
							      
                        </div>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->