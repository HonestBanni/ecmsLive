 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="center" style="border-bottom:1px solid #ccc;"><?php echo $page_header?></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <?php 
                        echo validation_errors(); 
                        echo form_open(''); 
                    ?>
                        <h3 align="left">Student Admission Information<hr></h3> 
                            <div class="form-group col-md-3">
                                <label for="usr">Batch Name:</label>
                                <?php
                                    echo form_dropdown('batch_id', $prospectus_batch,$batch_id,  'class="form-control" id="batch_id"');
                                ?>
 
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Program Name:</label>
                                <?php
                                    echo form_dropdown('programe_id', $programe_name,$programe_id,  'class="form-control"');
                                ?>
 
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Program Name:</label>
                                <?php
                                    echo form_dropdown('sub_pro_id', $sub_pro_name,$sub_pro_id,  'class="form-control" id="subject_changer"');
                                ?>
                            </div>
          
                            <div class="form-group col-md-3">
                                <label for="usr">Form No.:</label>
                                 <?php
                                    echo form_input(array(
                                            'name'          => 'form_no',
                                            'required'      => 'required',
                                            'value'         => set_value('form_no'),
                                            'id'            => 'form_Check',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'form no e.g 222', ));
                                 ?>
                             </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Reserved Seats 1:</label>
                                 
                                    <?php
                                        echo form_dropdown('rseats_id', $reserved_seat,$reserved_seat_id,'class="form-control" ');
                                    ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Reserved Seats 2:</label>
                                 
                                    <?php
                                        echo form_dropdown('rseats_id1', $reserved_seat2,$reserved_seat_id2,'class="form-control" ');
                                    ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Reserved Seats 2:</label>
                                 
                                    <?php
                                        echo form_dropdown('rseats_id3', $reserved_seat3,$reserved_seat_id3,'class="form-control" ');
                                    ?>
                            </div>
                            
                             
                            <div class="form-group col-md-3">
                                <label for="usr">Comment:</label>
                                <?php
                                    echo form_input(array(
                                            'name'          => 'comment',
                                            'value'         => set_value('comment'),
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Remarks'));
                                 ?>
                             </div>
                            <div class="form-group col-md-12">
                                <h3 align="left">Student Information<hr></h3>
                            </div>        
                            <div class="form-group col-md-3">
                                <label for="usr">Student Name:</label>
                                <input type="text" placeholder="Student Name" name="student_name" value="<?php echo set_value('student_name')?>" class="form-control" required="required">        
                            </div>
                            <div class="form-group col-md-3">
                            <label for="usr">Father Name:</label>
                            <input type="text" placeholder="Father Name" name="father_name"class="form-control" value="<?php echo set_value('father_name')?>" required="required"> 
                            </div>
                             <div class="form-group col-md-3">
                            <label for="usr">Father Mobile No (SMS) :</label>
                            <input type="text" placeholder="Father Mobile No (SMS)" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" title="Follow request format 0000-0000000"  value="<?php echo set_value('mobile_no')?>"  name="mobile_no" class="form-control phone" required="required"> 
                            </div>
                            <div class="form-group col-md-3">
                            <label for="usr">Applicant Mobile No (SMS):</label>
                            <input type="text" placeholder="Applicant Mobile No" placeholder="Applicant Mobile No" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" title="Follow request format 0000-0000000"  value="<?php echo set_value('applicant_mobile_no1')?>"  name="applicant_mobile_no1" class="form-control phone">        
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Gender:</label>
                                         <?php
                                            echo form_dropdown('gender_id', $gender,$gender_id,'class="form-control" ');
                                        ?>
                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Nationality:</label>
                                
                                    <?php
                                            echo form_dropdown('country_id', $country,$country_id,'class="form-control" required="required" ');
                                        ?>
 
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Domicile:</label>
                                <input type="text" name="domicile_id" class="form-control" id="domicile" required="required"> 
                                <input type="hidden" name="domicile_id" id="domicile_id" value="<?php echo set_value('domicile_id')?>">
                            </div> 
                            <div class="form-group col-md-3">
                                <label for="usr">Religion</label>
                                 
                                   <?php
                                         echo form_dropdown('religion_id', $religion,$religion_id,'class="form-control" require="required" ');
                                    ?>
                                
                            </div>
                            <div class="form-group col-md-3">
                            <label for="usr">PTCL No.:</label>
                            <input type="text" placeholder="PTCL No." name="land_line_no" value="<?php echo set_value('land_line_no')?>" class="form-control">        
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
                                <input type="text" placeholder="Last School Address" value="<?php echo set_value('last_school_address')?>"  name="last_school_address" id="last_school" required="required"  class="form-control">      
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="usr">Remarks <small>For Missing Documents</small>:</label>
                                    <input type="text" placeholder="Remarks" name="remarks1"  value="<?php echo set_value('remarks1')?>"  class="form-control">        
                            </div>
                            <div class="form-group col-md-6">
                                <label for="usr">General Remarks:</label>
                                <input type="text" placeholder="Remarks" name="remarks2" value="<?php echo set_value('remarks2')?>"  class="form-control">        
                            </div> 
                            <div class="form-group col-md-2">
                                <input type="submit" style="margin-top:23px;" class="btn btn-theme" name="submit" value="Add Student">
                            </div>
                <?php echo form_close(); ?>
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