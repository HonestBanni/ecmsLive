 <!-- ******CONTENT****** --> 
        <div class="content container">
        <form name="search" method="post" action="Admin/search_arabic_student">    
            <div class="col-md-3">
                         <div class="form-group">                 
            <?php            
                if(!empty($result->student_id)){ ?>         
        <input type="text" name="student_id" value="<?php echo $result->student_name; ?>" placeholder="Student Name" class="form-control" id="student_record">
                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $result->student_id; ?>">      
                    <?php      
                    }else{?>
        <input type="text" class="form-control" name="student_id" id="student_record" placeholder="Student Name">
    <input type="hidden" name="student_id" id="student_id">
                    <?php
                    }    
                ?>
                        </div>
                     </div>
                     <div class="col-md-3">
                    <div class="form-group">
                      <input type="submit" name="submit" value="Search" class="btn btn-theme">
                        </div>  
                     </div>
            </form>    
            <h3 align="left" style="border-bottom:1px solid #ccc;">Add New Student (Arabic Language)</h3>
       
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
    <form name="student" method="post" action="admin/add_arabic_student">        
    <h3 align="left">Student Admission Information<hr></h3>
        <div class="form-group col-md-4">
            <label for="usr">Batch Name:</label>
            <select type="text" name="batch_id" class="form-control">
                <?php
                $b = $this->db->query("SELECT * FROM prospectus_batch WHERE programe_id=15 order by batch_id desc");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->batch_id;?>"><?php echo $brec->batch_name;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="usr">Program Name:</label>
            <select type="text" name="programe_id" class="form-control">
                <?php
        $b = $this->db->query("SELECT * FROM programes_info WHERE programe_id=15");
                foreach($b->result() as $brec)
                {
                ?>
    <option value="<?php echo $brec->programe_id;?>"><?php echo $brec->programe_name;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Sub Program</label>
           <select class="form-control" name="sub_pro_id" id="lang_subpro_id" required>
               <option value="">Select Sub Program</option>
           <?php
        $c = $this->db->query("SELECT * FROM sub_programes WHERE programe_id=15");
                foreach($c->result() as $crec)
                {
                ?>
            <option value="<?php echo $crec->sub_pro_id;?>"><?php echo $crec->name;?></option>
                <?php 
                }
                ?>
            </select>
          </div>
        <?php
        
        ?>
        <div class="form-group col-md-4">
            <label for="usr">Student Name:</label>
            <input type="text" placeholder="Student Name" name="student_name" value="<?php if(!empty($result->student_name)): echo $result->student_name;endif; ?>" class="form-control" required>        
        </div>
        <div class="form-group col-md-4">
            <label for="usr">Father Name:</label>
            <input type="text" placeholder="Father Name" name="father_name" value="<?php if(!empty($result->father_name)): echo $result->father_name; endif;?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
        <label for="usr">College #:</label>
        <input type="text" placeholder="College No." name="college_no" value="<?php if(!empty($result->college_no)): echo $result->college_no; endif;?>" class="form-control"> 
        </div>
        <div class="form-group col-md-4">
        <label for="usr">Mobile No 1:</label>
        <input type="text" placeholder="Mobile No." name="mobile_no" value="<?php if(!empty($result->mobile_no)): echo $result->mobile_no; endif; ?>" class="form-control phone" required> 
        </div>
        <div class="form-group col-md-6">
            <label for="usr">Comment:</label>
            <input type="text" name="comment" placeholder="Remarks.." class="form-control">        
        </div>
        <div class="form-group col-md-2">
            <input style="margin-top:23px;" type="submit" class="btn btn-theme" name="submit" value="Add Student">
        </div>
        <div class="form-group col-md-12">
                <h3 align="left">Student Information<hr></h3>
        </div>        
        
        <div class="form-group col-md-3">
            <label for="usr">CNIC:</label>
            <input type="text" placeholder="CNIC/Form B No." name="student_cnic" class="form-control nic">        
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Gender:</label>
            <select type="text" name="gender_id" class="form-control">
                <option value="">Select Gender</option>
                <?php
                $b = $this->db->query("SELECT * FROM gender");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->gender_id;?>"><?php echo $brec->title;?></option>
                <?php 
                }
                ?>
            </select>
        </div>     
        <div class="form-group col-md-3">
            <label for="usr">Marital Status:</label>
            <select type="text" name="marital_id" class="form-control">
                <?php
            $b = $this->db->query("SELECT * FROM marital_status");
            foreach($b->result() as $brec)
            {
            ?>
                <option value="<?php echo $brec->marital_status_id;?>"><?php echo $brec->title;?></option>
            <?php 
            }
            ?>
            </select>
        </div>                
        <div class="form-group col-md-3">
            <label for="usr">Date of Birth (<small>dd-mm-yy</small>):</label>
            <input type="text" name="dob" class="form-control date_format_d_m_yy">        
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Place of Birth:</label>
            <input type="text" placeholder="Place of Birth" name="place_of_birth" class="form-control">        
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Blood Group</label>
            <select type="text" name="bg_id" class="form-control">
                <option value="">Select</option>
               <?php
                $b = $this->db->query("SELECT * FROM blood_group");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->b_group_id;?>"><?php echo $brec->title;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Country:</label>
           <input type="text" name="country_id" class="form-control" id="country">
            <input type="hidden" name="country_id" id="country_id">
        </div>
         <div class="form-group col-md-3">
            <label for="usr">Domicile:</label>
            <input type="text" name="domicile_id" class="form-control" id="domicile">
            <input type="hidden" name="domicile_id" id="domicile_id">
        </div>
        <div class="form-group col-md-3">
            <label for="usr">District:</label>
           <input type="text" name="district_id" class="form-control" id="district">
            <input type="hidden" name="district_id" id="district_id">
        </div>  
        <div class="form-group col-md-3">
            <label for="usr">religion</label>
            <select type="text" name="religion_id" class="form-control">
               <option value="">&larr; religion &rarr;</option> 
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
            <label for="usr">Hostel Required</label>
            <select type="text" name="hostel_required" class="form-control">
               <option value="">&larr; Hostel Required &rarr;</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <h3 align="left">Student's Father Information<hr></h3>
        </div> 
    <div class="form-group col-md-3">
        <label for="usr">Father NIC:</label>
        <input type="text" placeholder="Father CNIC" name="father_cnic" class="form-control nic">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Land Line No:</label>
        <input type="text" placeholder="Landline No." name="land_line_no" class="form-control">        
    </div>
    
    <div class="form-group col-md-3">
        <label for="usr">Mobile No 2:</label>
        <input type="text" placeholder="Mobile No. 2" name="mobile_no2" class="form-control phone">        
    </div>    
    <div class="form-group col-md-3">
            <label for="usr">Father Occupation</label>
            <select type="text" name="occ_id" class="form-control">
                <option value="">Select</option>
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
            <label for="usr">Annual Income:</label>
            <input type="number" placeholder="Income" name="annual_income" class="form-control">        
        </div> 
        <div class="form-group col-md-3">
            <label for="usr">Father Email:</label>
            <input type="text" placeholder="Email" name="father_email" class="form-control">      
        </div> 
        <div class="form-group col-md-6">
            <label for="usr">Postal Address:</label>
            <input type="text" placeholder="Applicant Postal Address" name="app_postal_address" class="form-control">      
        </div>
        <div class="form-group col-md-6">
            <label for="usr">Permanent Address:</label>
            <input type="text" placeholder="Permanent Address" name="parmanent_address" class="form-control">      
        </div>
                             
      <div class="form-group col-md-12">
            <h3 align="left">Student's Guardian Information<hr></h3>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Guardian Name:</label>
            <input type="text" placeholder="Guardian Name" name="guardian_name" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Guardian CNIC:</label>
            <input type="text" placeholder="Guardian CNIC" name="guardian_cnic" class="form-control nic">      
        </div>    
        <div class="form-group col-md-3">
            <label for="usr">Guardian Relation</label>
            <select type="text" name="relation_with_guardian" class="form-control">
              <option value="">&larr; Guadian Relation &rarr;</option> 
                <?php
                $b = $this->db->query("SELECT * FROM relation");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->relation_id;?>"><?php echo $brec->title;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Guardian Occupation</label>
            <select type="text" name="guardian_occupation" class="form-control">
              <option value="">&larr; Guardian Occupation &rarr;</option> 
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
            <label for="usr">Guardian Income:</label>
            <input type="text" placeholder="Guardian Annual Income" name="g_annual_income" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Guardian Landline no.:</label>
            <input type="text" placeholder="Guardian Landline No" name="g_land_no" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Guardian Mobile no.:</label>
            <input type="text" placeholder="Guardian MObile No" name="g_mobile_no" class="form-control phone">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Guardian Postal Address :</label>
            <input type="text" placeholder="Guardian Postal Address" name="g_postal_address" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Guardian Email :</label>
            <input type="text" placeholder="Guardian Email" name="g_email" class="form-control">      
        </div>                
        <div class="form-group col-md-3">
            <label for="usr">Physical Status</label>
            <select type="text" name="physical_status_id" class="form-control">
               <?php
            $b = $this->db->query("SELECT * FROM physical_status");
            foreach($b->result() as $brec)
            {
            ?>
                <option value="<?php echo $brec->ps_id;?>"><?php echo $brec->title;?></option>
            <?php 
            }
            ?>
            </select>
        </div>
       <div class="form-group col-md-12">
            <h3 align="left">Emergency Person Information<hr></h3>
       </div>
       <div class="form-group col-md-4">
            <label for="usr">Emergency Person Name :</label>
            <input type="text" placeholder="Emargency Person Name"  name="emargency_person_name" class="form-control">      
        </div>
        <div class="form-group col-md-4">
            <label for="usr">Relation</label>
            <select type="text" name="e_person_relation" class="form-control">
               <?php
            $b = $this->db->query("SELECT * FROM relation");
            foreach($b->result() as $brec)
            {
            ?>
                <option value="<?php echo $brec->relation_id;?>"><?php echo $brec->title;?></option>
            <?php 
            }
            ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="usr">Emergency Phone No. :</label>
         <input type="text" placeholder="Emargency Person phone"  name="e_person_contact1" class="form-control phone">      
        </div>
        <div class="form-group col-md-4">
            <label for="usr">Emergency Phone No.2 :</label>
         <input type="text" placeholder="Emargency Person phone 2"  name="e_person_contact2" class="form-control phone">    
        </div>
        <div class="form-group col-md-4">
            <label for="usr">Student Status</label>
            <select type="text" name="s_status_id" class="form-control">
                <?php
                    $b = $this->db->query("SELECT * FROM  `student_status` WHERE  `name` LIKE  '%rec%'");
                    foreach($b->result() as $brec)
                    {
                    ?>
                        <option value="<?php echo $brec->s_status_id;?>"><?php echo $brec->name;?></option>
                    <?php 
                    }
                    ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="usr">Admission Comment :</label>
         <input type="text" placeholder="Admission Comment"  name="admission_comment" class="form-control phone">    
        </div>
               
        <div class="form-group col-md-4">
            <input type="submit" class="btn btn-theme" name="submit" value="Add Student">
        </div>
                    </form>
                        </div>
                    </div>
               </div>
                    