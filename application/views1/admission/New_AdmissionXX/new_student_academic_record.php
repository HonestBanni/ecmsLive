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
<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/new_student_academic_record/<?php echo $student_id;?>">
    <div class="form-group col-md-4">
            <label for="usr">Degree / Certificate</label>
            <select type="text" name="degree_id" class="form-control">
               <?php
                $b = $this->db->query("SELECT * FROM degree");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->degree_id;?>"><?php echo $brec->title;?></option>
                <?php 
                }
                ?>
            </select>
       </div>
    <input type="hidden" value="<?php echo $student_id;?>" name="student_id"> 
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
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
            </select>
   </div> 
    <div class="form-group col-md-4">
        <label for="usr">Total Marks:</label>
        <select name="total_marks" class="form-control" id="totalMarks" required>
                <option value="1100">1100</option>
                <option value="1050">1050</option>
                <option value="0">0</option>
            </select>
   </div> 
    <div class="form-group col-md-4">
        <label for="usr">Obtained Marks:</label>
        <input type="text" name="obtained_marks" id="obtainedMarks" class="form-control" required> 
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
    <div class="col-md-6">
        <input type="submit" class="btn btn-theme btn-lg" name="Add_education" value="Add Record">
        <a  href="HostelNewRecord/<?php echo $this->uri->segment(3);?>"  class="btn btn-primary btn-lg">Add Hostel Record</a>
    </div>
    
    
    <div class="col-md-1 pull-right">
         <a  href="admin/new_student_record" onclick="myFunction()" class="btn btn-primary">Done</a>
    </div>
    <div class="col-md-6 pull-right">
    <!--<div class="col-md-6 col-md-offset-1 pull-right">-->
        <p style="color:red; font-weight: 900; font-size:14px">If Academic Details Completed Then Click on Done Button, Thanks... 
             
        </p>
         
    </div>
    
    
    </form>
    
    </div>        
        <?php
            if($student_records):
            ?>
             <table class="table table-bordered table-striped display">
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
                
        
             

            
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
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