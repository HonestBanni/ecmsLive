<script type="text/javascript">
    function lookup(inputString) 
    {
        if(inputString.length == 0) {
            $('#suggestions').hide();
        } else {
            $.post("<?php echo base_url() ?>AdminDeptController/autocomplete/"+inputString, function(data){
                if(data.length > 0) {
                    $('#suggestions').show();
                    $('#autoSuggestionsList').html(data);
                }
            });
        }
    }

    function fill(thisValue) 
    {
        $('#id_input').val(thisValue);
        setTimeout("$('#suggestions').hide();", 200);
    }
</script>
<div class="content container">
            <h2 align="center">Add Alumni Record<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="AdminDeptController/add_alumni">
            <div class="row">
            <div class="col-md-12"> 
                <div class="form-group col-md-3">
                    <label for="usr">College No.:</label>
                    <input type="text" name="college_no" id="college_no" class="form-control">        
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Board Reg No.:</label>
                    <input type="text" name="board_regno" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Uni Reg No.:</label>
                    <input type="text" name="uni_regno" class="form-control">
                </div>
                 <div class="form-group col-md-3">
                        <label for="usr">Student Name:</label>
                        <input type="text" name="student_name" class="form-control" required>        
                  </div>
                <div class="form-group col-md-3">
                    <label for="usr">Father Name:</label>
                    <input type="text" name="father_name" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Occupation:</label>
                    <select type="text" name="occ_id" class="form-control">
                        <option value="">&larr; Select &rarr;</option>
                        <?php
                        $b = $this->db->query("SELECT * FROM occupation");
                        foreach($b->result() as $brec)
                        {
                        ?>
                            <option value="<?php echo $brec->occ_id;?>"><?php echo $brec->title;?></option>
                        <?php 
                        }
                        ?>
                    </select>  
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Religion:</label>
                    <select class="form-control" type="text" name="religion_id">
                        <option value="">&larr; Select &rarr;</option>
                        <?php
                        $b = $this->db->query("SELECT * FROM religion");
                        foreach($b->result() as $brec)
                        {
                        ?>
                            <option value="<?php echo $brec->religion_id;?>"><?php echo $brec->title;?></option>
                        <?php 
                        }
                        ?>
                    </select>        
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Domicile:</label>
                    <select type="text" name="domicile_id" class="form-control">
                        <option value="">&larr; Select &rarr;</option>
                        <?php
                        $b = $this->db->query("SELECT * FROM domicile");
                        foreach($b->result() as $brec)
                        {
                        ?>
                            <option value="<?php echo $brec->domicile_id;?>"><?php echo $brec->name;?></option>
                        <?php 
                        }
                        ?>
                    </select>
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Date of Birth (<smal>M-D-Y</smal>):</label>
                    <input type="date" class="form-control" name="dob"> 
                </div>   
              <div class="form-group col-md-6">
                    <label for="usr">Permanent Address:</label>
                    <input type="text" class="form-control" name="parmanent_address"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Sports:</label>
                    <select type="text" name="sports_id" class="form-control">
                        <option value="">&larr; Select &rarr;</option>
                            <?php
                            $b = $this->db->query("SELECT * FROM sports");
                            foreach($b->result() as $brec)
                            {
                            ?>
                                <option value="<?php echo $brec->sports_id;?>"><?php echo $brec->sports_name;?></option>
                            <?php 
                            }
                            ?>
                    </select>
              </div> 
              <div class="form-group col-md-3">
                    <label for="usr">Phone No 1.:</label>
                    <input type="text" class="form-control phone" name="mobile_no"> 
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Phone No 2:</label>
                    <input type="text" class="form-control phone" name="mobile_no2"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Hostel/Day Scholar :</label>
                    <select type="text" name="hostel_required" class="form-control">
                        <option value="">Select </option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>   
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Previous Institute:</label>
                    <input type="text" class="form-control" name="inst_id"> 
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Exam Passed:</label>
                    <select type="text" name="degree_id" class="form-control">
                        <option value="">&larr; Select &rarr;</option>
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
                <div class="form-group col-md-3">
                    <label for="usr">Year:</label>
                    <input type="text" class="form-control" name="year_of_passing"> 
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Roll No:</label>
                    <input type="text" class="form-control" name="rollno"> 
                </div>
            <div class="form-group col-md-3">
                  <label for="usr">Admitted to the:</label>
               <select class="form-control" type="text" id="showAlumiSubPro" name="sub_pro_id">
                   <?php
                    $b = $this->db->query("SELECT * FROM sub_programes");
                    foreach($b->result() as $brec)
                    {
                    ?>
                        <option value="<?php echo $brec->sub_pro_id;?>"><?php echo $brec->name;?></option>
                    <?php 
                    }
                    ?>
                </select>
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Admission Date (<smal>M-D-Y</smal>):</label>
                    <input type="date" class="form-control" name="admission_date"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Total Marks:</label>
                    <input type="text" class="form-control" name="total_marks"> 
              </div>    
            <div class="form-group col-md-3">
                    <label for="usr">Obtained Marks:</label>
                    <input type="text" class="form-control" name="obtained_marks"> 
              </div>
            <div class="form-group col-md-3">
                    <label for="usr">Grade:</label>
                   <select type="text" name="grade_id" class="form-control">
                        <option value="">&larr; Select &rarr;</option>
                            <?php
                            $b = $this->db->query("SELECT * FROM grade");
                            foreach($b->result() as $brec)
                            {
                            ?>
                                <option value="<?php echo $brec->grade_id;?>"><?php echo $brec->grade_name;?></option>
                            <?php 
                           }
                            ?>
                    </select> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Character:</label>
                    <select type="text" name="char_id" class="form-control">
                        <option value="">&larr; Select &rarr;</option>
                            <?php
                            $b = $this->db->query("SELECT * FROM student_character");
                            foreach($b->result() as $brec)
                            {
                            ?>
                                <option value="<?php echo $brec->char_id;?>"><?php echo $brec->char_name;?></option>
                            <?php 
                           }
                            ?>
                    </select>
              </div>    
             <div class="form-group col-md-3">
                 <label for="usr">Certificate Issue Date (<smal>M-D-Y</smal>):</label>
                    <input type="date" class="form-control" name="certificate_issue_date" > 
              </div>
               <div class="form-group col-md-3">
                    <label for="usr">Student CNIC:</label>
                    <input type="text" name="student_cnic" class="form-control nic">
                </div>  
             <div class="form-group col-md-3">
                    <label for="usr">Dues if Any:</label>
                    <input type="number" class="form-control" name="dues_any" > 
              </div>
              <div class="form-group col-md-6">
                    <label for="usr">Remarks 1:</label>
                    <input type="text" class="form-control" name="remarks" > 
              </div>
              <div class="form-group col-md-6">
                    <label for="usr">Remarks 2:</label>
                    <input type="text" class="form-control" name="remarks2" > 
              </div>
             
              </div>
              <div class="form-group">
                    <input style="margin-left:30px;" type="submit" class="btn btn-theme" name="submit" value="Add Alumni Record">
              </div>
             
              <!--//form-group-->
               
            </div>
              </form>
        
                           
                        </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->