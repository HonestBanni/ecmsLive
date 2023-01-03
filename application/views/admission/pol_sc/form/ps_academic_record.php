<?php
		$this->load->helper('form');
		
		?>

				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Student Academic (Law)<hr></h2>
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

        <form method="post" action="admin/economics_student_academic_record/<?php echo $student_id;?>">
                      <div class="form-group col-md-4">
            <label for="usr">Degree / Certificate</label>
            <select type="text" name="degree_id" class="form-control" required>
                <option value="">Select</option>
               <?php
                $b = $this->db->query("SELECT * FROM degree WHERE degree_id IN(2,17,39)");
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
            <input type="text" name="bu_id" class="form-control" id="bu">
            <input type="hidden" name="bu_id" id="bu_id">
        </div>
    <div class="form-group col-md-4">
            <label for="usr">Year of Passing:</label>
            <select name="year_of_passing" class="form-control">
                <option value="2018">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
            </select>
   </div> 
    <div class="form-group col-md-4">
            <label for="usr">Total Marks:</label>
            <select name="total_marks" class="form-control">
                <option value="1100">1100</option>
                <option value="550">550</option>
            </select>
   </div> 
    <div class="form-group col-md-4">
            <label for="usr">Obtained Marks:</label>
            <input type="text" name="obtained_marks" class="form-control" required> 
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
            <div class="form-group col-md-12">    
                <br><p>If Academic Details Completed Then Click on Done Button, Thanks... <a style="float:right; margin-right:600px;" href="admin/economics_student_record" onclick="myFunction()" class="btn btn-primary">Done</a></p><br>    
            <br>
                </div>    
                <?php if($student_records): ?>
             <table class="table table-bordered table-striped">
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