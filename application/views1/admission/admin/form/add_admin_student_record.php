 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="center" style="border-bottom:1px solid #ccc;">Add Student Record Admin</h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/add_admin_student_record">       
                            <h3 align="left">Student Admission Information<hr></h3> 
    
        <div class="form-group col-md-3">
            <label for="usr">Batch Name:</label>
            <select type="text" name="batch_id" id="batch_id" class="form-control">
                <?php
                $b = $this->db->query("SELECT * FROM prospectus_batch order by batch_name asc");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->batch_id;?>"><?php echo $brec->batch_name;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Program Name:</label>
            <select type="text" name="programe_id" class="form-control">
                <?php
                $b = $this->db->query("SELECT * FROM programes_info");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->programe_id;?>"><?php echo $brec->programe_name;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Sub Program Name:</label>
            <select type="text" name="sub_pro_id" class="form-control" id="subject_changer">
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
            <label for="usr">Form No.:</label>
            <input type="number" name="form_no" id="form-Checking" placeholder="form no e.g 222" class="form-control">        
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Reserved Seats 1:</label>
            <select type="text" name="rseats_id" class="form-control">
                <?php
                $b = $this->db->query("SELECT * FROM reserved_seat");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->rseat_id;?>"><?php echo $brec->name;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Reserved Seats 2:</label>
            <select type="text" name="rseats_id1" class="form-control">
                <?php
                $b = $this->db->query("SELECT * FROM reserved_seat");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->rseat_id;?>"><?php echo $brec->name;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Comment:</label>
            <input type="text" name="comment" placeholder="Remarks.." class="form-control">        
        </div>
        <div class="form-group col-md-3">
                <label for="usr">FATA School:</label>
               <select class="form-control" type="text" name="fata_school">
                    <option value="">-- Select --</option>
                    <option value="yes">Yes</option>
                    <option value="no">N0</option>
            </select>     
            </div>
                            <div class="form-group col-md-3">
                <label for="usr">Migration Status</label>
                <select class="form-control" name="migration_status">
                    <option value="">Select </option>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <h3 align="left">Student Information<hr></h3>
            </div>        
        <div class="form-group col-md-3">
            <label for="usr">Student Name:</label>
            <input type="text" placeholder="Student Name" name="student_name" class="form-control" required>        
        </div>
        <div class="form-group col-md-3">
            <label for="usr">CNIC:</label>
            <input type="text" placeholder="CNIC/Form B No." name="student_cnic" class="form-control nic">        
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Gender:</label>
            <select type="text" name="gender_id" class="form-control">
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
            <label for="usr">Father Name:</label>
            <input type="text" placeholder="Father Name" name="father_name" class="form-control" required>        
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
            <label for="usr">Mobile No 1:</label>
            <input type="text" placeholder="Mobile No." name="mobile_no" class="form-control phone">        
        </div>
        <div class="form-group col-md-3">
            <label>Mobile Network</label>
                <select name="net_id" class="form-control">
            <option value="">Select Network</option>
            <?php
            $n = $this->CRUDModel->getResults('mobile_network');
            foreach($n as $rows):
            ?>
                <option value="<?php echo $rows->net_id;?>"><?php echo $rows->network;?></option>
            <?php
            endforeach;
            ?>
                </select>
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
        <div class="form-group col-md-4">
            <label for="usr">Address of Institute Last Attended:</label>
            <input type="text" placeholder="Last School Address" name="last_school_address" id="last_school" class="form-control">      
        </div> 
        <div class="form-group col-md-4">
            <label for="usr">Remarks <small>For Missing Documents</small>:</label>
            <input type="text" placeholder="Remarks" name="remarks1" class="form-control">        
        </div>
        <div class="form-group col-md-4">
            <label for="usr">General Remarks:</label>
            <input type="text" placeholder="General Remarks" name="remarks2" class="form-control">   
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
                <option value="">Select</option>
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
                            
        <div id="artsubjectlist"> </div>                    
        
                        </div>
                    </div>
                </form> 
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
<script>
jQuery(document).ready(function(){
      jQuery('#subject_changer').on('change',function(){
    
     var subProId = jQuery('#subject_changer').val();
        if(subProId == 4 || subProId == 5 || subProId == 26 || subProId == 27){
            
    
     jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getCheckSubjects',
         data   :{'subId':subProId},
        success :function(result){
            jQuery('#artsubjectlist').show();
            jQuery('#artsubjectlist').html(result);
        }
        
     });
 }
 else{
     jQuery('#artsubjectlist').hide();
 }
 });
 });
</script>