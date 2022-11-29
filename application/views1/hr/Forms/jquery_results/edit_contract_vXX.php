<div class="modal-body">

<section class="course-finder" style="padding-bottom: 2%;">
    <h1 class="section-heading text-highlight"><span class="line">Edit Contract Information</span></h1>
    <div class="section-content">
        <div class="row">
            <form action="EditContract" enctype="multipart/form-data" class="course-finder-form" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label" for="basicinput">Letter #</label>
                    <input type="text" name="c_renwal_letter_no" value="<?php echo $contract_info->c_renwal_letter_no?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Designation</label>
                        <input type="hidden" name="cont_id" id="cont_id" required="required"  value="<?php echo $contract_info->contract_id?>">
                        <input type="hidden" name="emp_id" required="required"  value="<?php echo $contract_info->c_renwal_emp_id?>">
                        <input type="hidden" name="emp_status_id" required="required"  value="<?php echo $contract_info->c_renwal_current_emp_status?>">
                        <input type="hidden" name="contract_old_image" id="contract_old_image" required="required"  value="<?php echo $contract_info->c_renwal_image?>">
                        <?php echo form_dropdown('designation',$designation,$contract_info->c_renewal_designation,array('class'=>'form-control'))?>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Contract Type</label>
                        <?php echo form_dropdown('contract_type_id',$contract_tp,$contract_info->c_renwal_current_contract_type,array('class'=>'form-control'))?> 
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Scale</label>
                        <?php echo form_dropdown('scale_id',$scale,$contract_info->c_renwal_current_scale,array('class'=>'form-control'))?> 
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Contract Date</label>
                        <input type="text"  name="renewal_date" value="<?php echo $this->CRUDModel->date_convert($contract_info->c_renwal_contract_date);?>" class="form-control datepicker_update">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Contract From</label>
                        <input type="text" name="contract_from_date"  value="<?php echo $this->CRUDModel->date_convert($contract_info->c_renwal_from_date);?>" class="form-control datepicker_update">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Contract Expiry</label>
                        <input type="text" name="contract_to_date"  value="<?php echo  $this->CRUDModel->date_convert($contract_info->c_renwal_to_date);?>" class="form-control datepicker_update">
                    </div>
                <div class="form-group col-md-3">
                        <label for="usr">Contract Status</label>
                        <?php echo form_dropdown('contract_status',$contract_status,$contract_info->c_renewal_contract_status_id,array('class'=>'form-control'))?> 
                    </div>
                    <div class="col-md-12">
                        <label for="name">Renewal Remarks</label>
                       <textarea name="renewal_remarks" cols="40" rows="2"  class="form-control" placeholder="Renewal Remarks" ><?php echo $contract_info->c_renwal_remarks?></textarea>
                   </div>
                    <div class="col-md-12">
                        <label for="name">Renewal Details</label>
                       <textarea name="renewal_details" cols="40" rows="2"  class="form-control" placeholder="Renewal Remarks" ><?php echo $contract_info->c_renwal_details?></textarea>
                   </div>
                   <div class="col-md-4 ">
                        <label class="control-label" for="basicinput">Contract Picture</label>
                        <input type="file" name="file"  class="form-control">
                    </div> 
                   <div class="col-md-3 ">
                        <label class="control-label" for="basicinput"  style="visibility: hidden">Contract Picture</label>
                        <button type="submit" class="btn btn-theme" name="request" id="update" value="update"><i class="fa fa-book"></i> Update</button>
                       
                    </div> 
                 
            </div>
           </form>  
        </div>
    </div>
</section>
<div class="col-md-12" style="text-align: center;">
    <?php if(!empty($contract_info->c_renwal_image)):?>
    <div>
        <img src="<?php echo base_url()?>assets/images/employee/contract_files/<?php echo $contract_info->c_renwal_image?>"  style="max-height: 400px;">
    </div>
      <?php endif;?>
    
</div>
</div>

<div class="modal-footer">
    <?php if(!empty($contract_info->c_renwal_image)):?>
    <button type="button" class="btn btn-danger deleteFle" name="deleteFle" id="deleteFle" value="deleteFle"><i class="fa fa-remove"></i> Delete Attachment</button>   
    <?php endif;?>
    <button type="button" class="btn btn-theme" id="btn-close" data-dismiss="modal">Close</button>

</div>

<script>
jQuery(document).ready(function(){
    jQuery('.deleteFle').on('click',function(){
        var cont_id     = jQuery('#cont_id').val();
        var image_name  = jQuery('#contract_old_image').val();
         
       jQuery.ajax({
                type        : 'post',
                url         : 'HrController/delete_contract_file',
                data        : { 'cont_id': cont_id,'image_name':image_name,'request':'DeleteFile'},
                success :function(result){
                    
                    jQuery('#btn-close').trigger('click');
                     
                 }
           });
    });
    });
</script>
<script>
  $( function() {
       var d = new Date();
d.setMonth(1); 
    $( ".datepicker_update" ).datepicker({
        changeMonth: true,
        changeYear: true,
         dateFormat: 'dd-mm-yy'
    });
  } );

</script>