<script>
function myFunction() {
    window.print();
}
</script>
<?php
    if($result):
    foreach($result as $alumniRow):  
        ?> 
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $alumniRow->student_name; ?> Alumni Record 
<!--                <button class="btn btn-theme" onclick="myFunction()">Print Student Profile</button>-->
            <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post">                     
            <div class="form-group col-md-3">
              <label for="usr">College No.:</label>
              <input type="text" value="<?php echo $alumniRow->college_no; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Board Reg No.:</label>
              <input type="text" value="<?php echo $alumniRow->board_regno; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Uni Reg No.:</label>
              <input type="text" value="<?php echo $alumniRow->uni_regno; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Student Name:</label>
              <input type="text" value="<?php echo $alumniRow->student_name; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Student CNIC:</label>
              <input type="text" value="<?php echo $alumniRow->student_cnic; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Father Name:</label>
              <input type="text" value="<?php echo $alumniRow->father_name; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Father Occupation:</label>
              <input type="text" value="<?php echo $alumniRow->occupation; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Religion:</label>
              <input type="text" value="<?php echo $alumniRow->religion; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Domicile:</label>
              <input type="text" value="<?php echo $alumniRow->domicile; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Date of Birth:</label>
              <input type="text" value="<?php echo $alumniRow->dob; ?>" class="form-control"> 
            </div>                         
            <div class="form-group col-md-6">
              <label for="usr">Permanent Address:</label>
              <input type="text" value="<?php echo $alumniRow->parmanent_address; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Sports:</label>
              <input type="text" value="<?php echo $alumniRow->sports; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Mobile NO 1:</label>
              <input type="text" value="<?php echo $alumniRow->mobile_no; ?>" class="form-control"> 
            </div>                         
            <div class="form-group col-md-3">
              <label for="usr">Mobile No 2:</label>
              <input type="text" value="<?php echo $alumniRow->mobile_no2; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Hostel Scholar:</label>
              <input type="text" value="<?php echo $alumniRow->hostel_required; ?>" class="form-control"> 
            </div>
            <?php
            if($limit_records):
            foreach($limit_records as $slimitRow):  
            ?>
            <div class="form-group col-md-3">
              <label for="usr">Previous Institute:</label>
              <input type="text" value="<?php echo $slimitRow->inst_id; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Exam Passed:</label>
              <input type="text" value="<?php echo $slimitRow->Degreetitle; ?>" class="form-control"> 
            </div>                         
            <div class="form-group col-md-3">
              <label for="usr">Year of Passing:</label>
              <input type="text" value="<?php echo $slimitRow->year_of_passing; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Roll No:</label>
              <input type="text" value="<?php echo $slimitRow->rollno; ?>" class="form-control"> 
            </div>                         
            <div class="form-group col-md-3">
              <label for="usr">Admission In Program:</label>
              <input type="text" value="<?php echo $alumniRow->sub_program; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Admission Date:</label>
              <input type="text" value="<?php echo $alumniRow->admission_date; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Total Marks:</label>
              <input type="text" value="<?php echo $slimitRow->total_marks; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Obtained Marks:</label>
              <input type="text" value="<?php echo $slimitRow->obtained_marks; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Grade:</label>
              <input type="text" value="<?php echo $slimitRow->grade_name; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Grade:</label>
              <input type="text" value="<?php echo $slimitRow->character; ?>" class="form-control"> 
            </div> 
            <div class="form-group col-md-3">
              <label for="usr">Certificate Issue Date:</label>
              <input type="text" value="<?php echo $alumniRow->certificate_issue_date; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-3">
              <label for="usr">Dues Any:</label>
              <input type="text" value="<?php echo $alumniRow->dues_any; ?>" class="form-control"> 
            </div> 
            <div class="form-group col-md-6">
              <label for="usr">Remarks 1:</label>
              <input type="text" value="<?php echo $alumniRow->remarks; ?>" class="form-control"> 
            </div>
            <div class="form-group col-md-6">
              <label for="usr">Remarks 2:</label>
              <input type="text" value="<?php echo $alumniRow->remarks2; ?>" class="form-control"> 
            </div> 
    </form>
</div>
<?php
  endforeach;
   endif;
        ?>                         
<br><br>
   <?php
          endforeach;
           endif;
                        ?>                          
                        </div>
                    
                </form> 
            <br>
    <h2 align="left"><?php echo $alumniRow->student_name; ?> Academic Record<hr></h2>        
 <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Program</th>
                            <th>Exam Type</th>
                            <th>Year</th>
                            <th>Marks</th>
                            <th>Grade</th>
                            <th>CGPA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($student_records):
                        foreach($student_records as $eRow):
                        ?>
                           <tr>
                                <td><?php echo $eRow->Degreetitle; ?></td>
                                <td><?php echo $eRow->exam_type; ?></td>
                                <td><?php echo $eRow->year_of_passing; ?></td>
                                <td><?php echo $eRow->obtained_marks;?>/<?php echo $eRow->total_marks; ?></td>
                                <td><?php echo $eRow->grade; ?></td>
                                <td><?php echo $eRow->cgpa; ?></td>
                           </tr>
                      <?php
                        endforeach;
                        
                        endif;
     
                        ?>


                    </tbody>
                </table>            
               </div><!--//col-md-3-->
              </div>  
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->