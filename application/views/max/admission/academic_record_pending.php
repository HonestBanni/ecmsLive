<?php
		$this->load->helper('form');
		
		?>

				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Academic Record (Inter Level)<hr></h2>
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
<form method="post" enctype="multipart/form-data" action="admin/student_academic_record/<?php echo $student_id;?>">
    <div class="form-group col-md-4">
            <label for="usr">Degree / Certificate</label>
            <input type="text" name="degree_id" class="form-control" id="degree" required>
            <input type="hidden" name="degree_id" id="degree_id">
       </div>
    <input type="hidden" value="<?php echo $student_id;?>" name="student_id"> 
    <div class="form-group col-md-4">
            <label for="usr">Institute:</label>
            <input type="text" name="inst_id" class="form-control"> 
   </div>
    <div class="form-group col-md-4">
            <label for="usr">Board/University</label>
            <input type="text" name="bu_id" class="form-control" id="bu">
            <input type="hidden" name="bu_id" id="bu_id">
        </div>
    <div class="form-group col-md-4">
            <label for="usr">Year of Passing:</label>
               <?php 
                    echo form_dropdown('year_of_passing', $year, '',  'class="form-control"');
            ?> 
   </div> 
    <div class="form-group col-md-4">
            <label for="usr">Total Marks:</label>
            <input type="number" name="total_marks" id="totalMarks" class="form-control" required> 
   </div> 
    <div class="form-group col-md-4">
            <label for="usr">Obtained Marks:</label>
            <input type="number" name="obtained_marks" id="obtainedMarks" class="form-control" required> 
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
    
    
    <div class="form-group col-md-6">
        <div class="form-group col-md-3">
            <input type="submit" class="btn btn-theme" name="submit" value="Add Record">  
        </div>
        <div class="form-group col-md-2">
            <a href="<?php echo base_url();?>admin/student_record" onclick="myFunction()" class="btn btn-primary">Save Student Record</a>
        </div>
    </div>
    
    </form>
<div class="form-group col-md-12">
    <p style="color:red;">If Academic Details Completed Then Click on 'Save Student Record' Button, Thanks... </p>   
</div>
               
            <br>
             <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Degree</th>
                            <th>Board/University</th>
                            <th>Institute</th>
                            <th>Year</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>%age</th>
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
                            <td><?php echo $rec->year_of_passing;?></td>
                            <td><?php echo $rec->total_marks;?></td>
                            <td><?php echo $rec->obtained_marks;?></td>
                            <td><?php echo $rec->percentage;?> %</td>
                            <td><?php echo $rec->cgpa;?></td>
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
        
<script>
    jQuery(document).ready(function(){
        jQuery("#obtainedMarks").on('change',function(){
            var om = parseInt(jQuery('#obtainedMarks').val());
            var tm = parseInt(jQuery('#totalMarks').val());
            if (om >= tm){
                alert('Obtained Marks should not be greater than Total Marks.');
                jQuery('#obtainedMarks').val("").focus();
                return false;
            }
        });
    });
</script>  