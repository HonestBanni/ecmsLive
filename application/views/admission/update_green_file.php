<?php
    $batch_id = $result->batch_id; 
    $programe_id = $result->programe_id; 
    $sub_pro_id = $result->sub_pro_id;
    $admitted_to = $result->admitted_to;  
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
            <h3 align="left">Update Green File<hr></h3>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="Admin/update_green_file/<?php echo $student_id;?>">
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
            $gres = $this->get_model->get_by_id('occupation',array('occ_id'=>$occ_id));
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
                        $gres = $this->get_model->get_by_id('religion',array('religion_id'=>$religion_id));
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
                     <?php
            $gres = $this->get_model->get_by_id('domicile',array('domicile_id'=>$domicile_id));
           
            if($gres){
                foreach($gres as $grec)
                { ?>          
                <input type="text" required="required" name="domicile_id" value="<?php echo $grec->name; ?>" placeholder="Domicile" class="form-control" id="domicile">
                <input type="hidden" name="domicile_id" id="domicile_id" value="<?php echo $grec->domicile_id; ?>">      
                <?php 
                }     
            }else{?>
    <input type="text" name="domicile_id" placeholder="Domicile" class="form-control" id="domicile" required="required">
                    <input type="hidden" name="domicile_id" id="domicile_id">    
                <?php
                }    
            ?>  
              </div>
              <div class="form-group col-md-3">
                  <label for="usr">Date of Birth <small>(DD-MM-YYYY)</small>:</label>
                  <?php
                $dob = $result->dob;
                if($dob === '0000-00-00' || $dob == '1970-01-01'){
                    $dob = '';
                    } else {
                    $dob = date("d-m-Y", strtotime($dob));
                    }
            ?>
                    <input type="text" class="form-control date_format_d_m_yy" value="<?php echo $dob;?>" name="dob"> 
              </div>
              <div class="form-group col-md-6">
                    <label for="usr">Postal Address:</label>
            <input type="text" class="form-control" value="<?php echo $result->app_postal_address;?>" name="postal_address"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Sports:</label>
                    <select type="text" name="sports_id" class="form-control">
                        <?php
                        $gres = $this->get_model->get_by_id('sports',array('sports_id'=>$sports_id));
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
                    <input type="text" class="form-control" value="<?php echo $result->mobile_no;?>" name="mobile_no"> 
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Phone No 2:</label>
                    <input type="text" class="form-control" value="<?php echo $result->mobile_no2;?>" name="mobile_no2"> 
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
                        $gres = $this->get_model->get_by_id('degree',array('degree_id'=>$degree_id));
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
                  <label for="usr">Current Status:</label>               
                   <?php
            $gres = $this->get_model->get_by_id('sub_programes',array('sub_pro_id'=>$sub_pro_id));
                if($gres){
                    foreach($gres as $grec){ ?>        
    <input type="text" name="<?php echo $grec->sub_pro_id;?>" value="<?php echo $grec->name;?>" class="form-control" readonly>             
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>    
              </div>
              <div class="form-group col-md-3">
                  <label for="usr">Admitted To the:</label>               
            <select class="form-control" type="text" name="admitted_to">
                   <?php
            $gres = $this->get_model->get_by_id('sub_programes',array('sub_pro_id'=>$admitted_to));
                  $proName = $this->CRUDModel->get_where_row('programes_info',array('programe_id'=>$gres[0]->programe_id));
                
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->sub_pro_id;?>"><?php echo $grec->name;?>
                =><?php echo $proName->programe_name;?>
                </option>
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>
                    <option value="">&larr; Select &rarr;</option>
                   <?php
                        $this->db->select('*');
                        $this->db->from('sub_programes');
                        $this->db->order_by('name','asc');
                        $b = $this->db->get();
                    foreach($b->result() as $brec)
                    {
                        $prog = $brec->programe_id;
                        $pro = $this->db->query("SELECT * FROM programes_info WHERE programe_id = '$prog'");
                        foreach($pro->result() as $pr);
                    ?>
                        <option value="<?php echo $brec->sub_pro_id;?>"><?php echo $brec->name;?> =><?php echo $pr->programe_name;?></option>
                    <?php 
                    }
                    ?>
                </select>      
              </div>
            <div class="form-group col-md-3">
                    <label for="usr">Total Marks:</label>
                    <input type="text" class="form-control" value="<?php echo $rec->total_marks;?>" name="total_marks"> 
    <input type="hidden" class="form-control" name="serial_no" value="<?php echo $rec->serial_no;?>" > 
              </div>    
            <div class="form-group col-md-3">
                    <label for="usr">Obtained Marks:</label>
                    <input type="text" class="form-control" value="<?php echo $rec->obtained_marks;?>" name="obtained_marks"> 
              </div>
            <div class="form-group col-md-3">
                    <label for="usr">Grade:</label>
                   <select type="text" name="grade_id" class="form-control">
                       <?php
                        $gres = $this->get_model->get_by_id('grade',array('grade_id'=>$grade_id));
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
                        $gres = $this->get_model->get_by_id('student_character',array('char_id'=>$char_id));
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
                    <label for="usr">Admission Date <small>(DD-MM-YYYY)</small>:</label>
                    <?php
                $date = $result->admission_date;
                if($date === '0000-00-00' || $date == '1970-01-01'){
                    $date = '';
                    } else {
                    $date = date("d-m-Y", strtotime($date));
                    }
            ?>
    <input type="text" name="admission_date" value="<?php echo $date;?>" class="form-control date_format_d_m_yy"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Certificate Issue Date <small>(DD-MM-YYYY)</small>:</label>
                    <?php
                $date_issue = $result->certificate_issue_date;
                if($date_issue === '0000-00-00' || $date_issue == '1970-01-01'){
                    $date_issue = '';
                    } else {
                    $date_issue = date("d-m-Y", strtotime($date_issue));
                    }
            ?>
                    <input type="text" class="form-control date_format_d_m_yy" value="<?php echo $date_issue;?>" name="certificate_issue_date" > 
              </div>
             <div class="form-group col-md-3">
                    <label for="usr">Dues if Any:</label>
                    <input type="number" class="form-control" name="dues_any" value="<?php echo $result->dues_any;?>"> 
              </div>
              <div class="form-group col-md-6">
                    <label for="usr">Remarks 1:</label>
    <textarea type="text" class="form-control notes" rows="5" name="remarks"><?php echo $result->remarks;?></textarea>
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Remarks 2:</label>
    <textarea type="text" class="form-control notes" rows="5" name="remarks2"><?php echo $result->remarks2;?></textarea> 
              </div>    
              </div>
              
             
              <!--//form-group-->
               
            </div>
    <h3>Education Details<hr></h3>    
    <div class="form-group col-md-3">
            <input type="text" class="form-control" id="sub_pro_program">
            <input type="hidden" id="sub_programId">
    </div>
    <input type="hidden" value="<?php echo $student_id;?>" id="student_id" name="student_id"> 
    <div class="form-group col-md-3">
            <input type="text" id="rollno" placeholder="Roll No" class="form-control"> 
   </div> 
    <div class="form-group col-md-3">
        <select class="form-control" id="year_of_passing">
            
             <option value="2018">2018</option>
            <option value="2017">2017</option>
             <option value="2018">2019</option>
           
        </select>
   </div>
    <div class="form-group col-md-3">
        <select class="form-control" id="total_marks">
            <option value="550">550</option>
            <option value="1100">1100</option>
        </select>
   </div> 
    <div class="form-group col-md-3">
            <input type="text" id="obtained_marks" placeholder="Obtained Marks" class="form-control"> 
   </div> 
    <div class="form-group col-md-3">
        <select id="grade_id" class="form-control">
            <option value="">Select Grade</option>
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
    <div class="form-group col-md-2">
        <input type="button" id="submitAc" class="btn btn-theme" name="submit" value="Add Record">
    </div>
    <div class="form-group col-md-2">
        <input type="submit" class="btn btn-theme" name="submit" value="Update Green File">
    </div>
    </form>         
            <div id="acdemicResult">
            </div>
                    
                           
                        </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->