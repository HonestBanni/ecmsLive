 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="center" style="border-bottom:1px solid #ccc;"><?php echo $page_header?></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" >       
                            <h3 align="left">Student Admission Information<hr></h3> 
    
        <div class="form-group col-md-3">
            <label for="usr">Batch Name:</label>
             <?php
                    echo form_dropdown('batch_id', $prospectus_batch,$batch_id,  'class="form-control" id="batch_id"');
                ?>
            
<!--            <select type="text" name="batch_id" id="batch_id" class="form-control">
                <?php
//                $b = $this->db->query("SELECT * FROM prospectus_batch WHERE  `batch_name` LIKE  '%FSc%' order by batch_id desc");
//                foreach($b->result() as $brec)
//                {
                ?>
                    <option value="<?php echo $brec->batch_id;?>"><?php echo $brec->batch_name;?></option>
                <?php 
//                }
                ?>
            </select>-->
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Program Name:</label>
            <select type="text" name="programe_id" class="form-control">
                <?php
                $b = $this->db->query("SELECT * FROM programes_info WHERE  `programe_name` LIKE  '%FSc%'");
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
                $b = $this->db->query("SELECT * FROM sub_programes WHERE programe_id=1");
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
            <input type="text" name="form_no" required="required" id="form_Check" placeholder="form no e.g 222" class="form-control">        
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
                <option value=""> Select Quota 2</option>
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
            <label for="usr">Reserved Seats 3:</label>
            <select type="text" name="rseats_id3" class="form-control">
                <option value=""> Select Quota 3</option>
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
                            
       
                        

        <div class="form-group col-md-12">
            <h3 align="left">Student Information<hr></h3>
        </div>        
        <div class="form-group col-md-3">
            <label for="usr">Student Name:</label>
            <input type="text" placeholder="Student Name" name="student_name" class="form-control" required="required">        
        </div>
        <div class="form-group col-md-3">
        <label for="usr">Father Name:</label>
        <input type="text" placeholder="Father Name" name="father_name" class="form-control" required="required"> 
        </div>
         <div class="form-group col-md-3">
        <label for="usr">Father Mobile No (SMS) :</label>
        <input type="text" placeholder="Father Mobile No (SMS)" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" title="Follow request format 0000-0000000" name="mobile_no" class="form-control phone" required="required"> 
        </div>
        <div class="form-group col-md-3">
        <label for="usr">Applicant Mobile No (SMS):</label>
        <input type="text" placeholder="Applicant Mobile No" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" title="Follow request format 0000-0000000"  name="applicant_mobile_no1" class="form-control phone">        
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
            <label for="usr">Nationality:</label>
            <select type="text" name="country_id" class="form-control" required="required">
                <?php
                $b = $this->db->query("SELECT * FROM country");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->country_id;?>"><?php echo $brec->name;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Domicile:</label>
            <input type="text" name="domicile_id" class="form-control" id="domicile" required="required"> 
            <input type="hidden" name="domicile_id" id="domicile_id" required="required">
        </div> 
        <div class="form-group col-md-3">
            <label for="usr">Religion</label>
            <select type="text" name="religion_id" class="form-control" required="required">
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
        <label for="usr">PTCL No.:</label>
        <input type="text" placeholder="PTCL No." name="land_line_no" class="form-control">        
    </div>
       
         <div class="form-group col-md-3">
                <label for="usr">FATA School:</label>
               <select class="form-control" type="text" name="fata_school" required>
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
            </select>     
        </div>
        
        <div class="form-group col-md-6">
            <label for="usr">Address of Institute Last Attended:</label>
            <input type="text" placeholder="Last School Address" name="last_school_address" id="last_school" required="required"  class="form-control">      
        </div>
        <div class="form-group col-md-6">
            <label for="usr">Remarks <small>For Missing Documents</small>:</label>
            <input type="text" placeholder="Remarks" name="remarks1" class="form-control">        
        </div>
        <div class="form-group col-md-6">
            <label for="usr">General Remarks:</label>
            <input type="text" placeholder="Remarks" name="remarks2" class="form-control">        
        </div> 
        <div class="form-group col-md-2">
            <input type="submit" style="margin-top:23px;" class="btn btn-theme" name="submit" value="Add Student">
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
        if(subProId == 5 || subProId == 27){
//        if(subProId == 4 || subProId == 5 || subProId == 26 || subProId == 27){
            
    
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