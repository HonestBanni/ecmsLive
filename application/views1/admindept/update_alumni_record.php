<?php
    $batch_id = $result->batch_id; 
    $programe_id = $result->programe_id; 
    $sub_pro_id = $result->sub_pro_id; 
    $occ_id = $result->occ_id; 
    $religion_id = $result->religion_id; 
    $domicile_id = $result->domicile_id; 
    $student_id = $result->student_id; 
    $char_id = $result->char_id; 
    $sports_id = $result->sports_id; 
    foreach($student_record as $rec)
    {
        $inst_id = $rec->inst_id; 
        $bu_id = $rec->bu_id; 
        $degree_id = $rec->degree_id; 
        $grade_id = $rec->grade_id; 
    }
    ?>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h4 align="left">Update Alumni Record<hr></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="AdminDeptController/update_alumni_student/<?php echo $student_id;?>">
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->

                <div class="form-group col-md-3">
                    <label for="usr">College No.:</label>
             <input type="text" name="college_no" id="checking_college_no" value="<?php echo $result->college_no;?>" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Board Reg No.:</label>
         <input type="text" name="board_regno" value="<?php echo $result->board_regno;?>" class="form-control" id="checking_board_regno">
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Uni Reg No.:</label>
                    <input type="text" name="uni_regno" value="<?php echo $result->uni_regno;?>" class="form-control">
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Student Name:</label>
                    <input type="text" name="student_name" value="<?php echo $result->student_name;?>" class="form-control" required>        
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Student CNIC:</label>
                    <input type="text" name="student_cnic" value="<?php echo $result->student_cnic;?>" class="form-control nic">        
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Father Name:</label>
                    <input type="text" name="father_name" value="<?php echo $result->father_name;?>" class="form-control">
              </div>
                <div class="form-group col-md-3">
                <label for="usr">Occupation:</label>
                <select class="form-control" type="text" name="occ_id">
                <?php
            $gres = $this->AdminModel->get_by_id('occupation',array('occ_id'=>$occ_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->occ_id;?>"><?php echo $grec->title;?></option>
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>
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
                         <?php
                        $gres = $this->AdminModel->get_by_id('religion',array('religion_id'=>$religion_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->religion_id;?>"><?php echo $grec->title;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value=""></option>';
                                }    
                            ?>
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
                        <?php
                        $gres = $this->AdminModel->get_by_id('domicile',array('domicile_id'=>$domicile_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->domicile_id;?>"><?php echo $grec->name;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value=""></option>';
                                }    
                            ?>
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
                    <label for="usr">Date of Birth:</label>
                    <input type="date" class="form-control" value="<?php echo $result->dob;?>" name="dob"> 
              </div>
              <div class="form-group col-md-6">
                    <label for="usr">Permanent Address:</label>
            <input type="text" class="form-control" value="<?php echo $result->parmanent_address;?>" name="parmanent_address"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Sports:</label>
                    <select type="text" name="sports_id" class="form-control">
                        <?php
                        $gres = $this->AdminModel->get_by_id('sports',array('sports_id'=>$sports_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->sports_id;?>"><?php echo $grec->sports_name;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value=""></option>';
                                }    
                            ?>
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
                    <input type="text" class="form-control phone" value="<?php echo $result->mobile_no;?>" name="mobile_no"> 
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Phone No 2:</label>
                    <input type="text" class="form-control phone" value="<?php echo $result->mobile_no2;?>" name="mobile_no2"> 
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Hostel/Day Scholar :</label>
                    <select type="text" name="hostel_required" class="form-control">
                        <option value="<?php echo $result->hostel_required;?>"><?php echo $result->hostel_required;?></option>
                        <option value="">Select </option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>   
              </div> 
              <div class="form-group col-md-3">
                    <label for="usr">Previous Institute:</label>
                    <input type="text" class="form-control" value="<?php echo $inst_id;?>" name="inst_id"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Exam Passed:</label>
                    <select type="text" name="degree_id" class="form-control">
                        <?php
                        $gres = $this->AdminModel->get_by_id('degree',array('degree_id'=>$degree_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->degree_id;?>"><?php echo $grec->title;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value=""></option>';
                                }    
                            ?>
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
                    <input type="text" class="form-control" value="<?php echo $rec->year_of_passing;?>" name="year_of_passing"> 
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Roll No:</label>
                    <input type="text" class="form-control" value="<?php echo $rec->rollno;?>"name="rollno"> 
              </div>
                
              <div class="form-group col-md-3">
                  <label for="usr">Admitted to the</label>
               <select class="form-control" type="text" id="showAlumiSubPro" name="sub_pro_id" required>
                   <?php
            $gres = $this->AdminModel->get_by_id('sub_programes',array('sub_pro_id'=>$sub_pro_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->sub_pro_id;?>"><?php echo $grec->name;?></option>
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>
                    <option value="">&larr; Select &rarr;</option>
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
                    <label for="usr">Total Marks:</label>
                    <input type="text" class="form-control" value="<?php echo $rec->total_marks;?>" name="total_marks"> 
              </div>    
            <div class="form-group col-md-3">
                    <label for="usr">Obtained Marks:</label>
                    <input type="text" class="form-control" value="<?php echo $rec->obtained_marks;?>" name="obtained_marks"> 
              </div>
            <div class="form-group col-md-3">
                    <label for="usr">Grade:</label>
                   <select type="text" name="grade_id" class="form-control">
                       <?php
                        $gres = $this->AdminModel->get_by_id('grade',array('grade_id'=>$grade_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->grade_id;?>"><?php echo $grec->grade_name;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value=""></option>';
                                }    
                            ?>
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
                         <?php
                        $gres = $this->AdminModel->get_by_id('student_character',array('char_id'=>$char_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->char_id;?>"><?php echo $grec->char_name;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value=""></option>';
                                }    
                            ?>
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
                    <label for="usr">Admission Date:</label>
                    <input type="date" class="form-control" value="<?php echo $result->admission_date;?>" name="admission_date"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Certificate Issue Date:</label>
                    <input type="date" class="form-control" value="<?php echo $result->certificate_issue_date;?>" name="certificate_issue_date" > 
              </div>
             <div class="form-group col-md-3">
                    <label for="usr">Dues if Any:</label>
                    <input type="number" class="form-control" name="dues_any" value="<?php echo $result->dues_any;?>"> 
              </div>
              <div class="form-group col-md-6">
                    <label for="usr">Remarks 1:</label>
                    <input type="text" class="form-control" name="remarks" value="<?php echo $result->remarks;?>"> 
              </div>
              <div class="form-group col-md-6">
                    <label for="usr">Remarks 2:</label>
                    <input type="text" class="form-control" name="remarks2" value="<?php echo $result->remarks2;?>"> 
              </div>    
              </div>
              <div class="form-group">
                    <input style="margin-left:30px;" type="submit" class="btn btn-theme" name="submit" value="Update Record">
              </div>
             
              <!--//form-group-->
               
            </div>
              </form>
           <br><br>
    <h3 align="center">Student Academic Record Details<hr><span style="folat:right"><a href="<?php echo base_url();?>AdminDeptController/alumni_academic_record/<?php echo $student_id;?>" class="btn btn-theme">Add Academic Record</a></span></h3>                
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Degree</th>
                            <th>Institute</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>Passing Year</th>
                            <th>CGPA</th>
                            <th>Grade</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($student_records):
                        foreach($student_records as $eRow):
                        ?>
                           <tr>
                                <td><?php echo $eRow->Degreetitle; ?></td>
                                <td><?php echo $eRow->inst_id; ?></td>
                                <td><?php echo $eRow->total_marks; ?></td>
                                <td><?php echo $eRow->obtained_marks; ?></td>
                                <td><?php echo $eRow->year_of_passing; ?></td>
                                <td><?php echo $eRow->cgpa; ?></td>
                                <td><?php echo $eRow->grade; ?></td>
                        <td><a href="AdminDeptController/update_alumni_academic/<?php echo $eRow->serial_no; ?>">Edit</td>
                        <td><a href="AdminDeptController/delete_academic_record/<?php echo $eRow->serial_no; ?>" onclick="return confirm('Are you Sure to Delete ..?')">Delete</a></td>
                           </tr>
                        <?php
                        endforeach;
                        
                        endif;
     
                        ?>


                    </tbody>
                </table>          
                           
                        </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->