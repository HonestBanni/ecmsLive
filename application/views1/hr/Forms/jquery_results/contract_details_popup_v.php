<div class="modal-body">

<section class="course-finder" style="padding-bottom: 2%;">
    <h1 class="section-heading text-highlight"><span class="line">Contract Information</span></h1>
    <div class="section-content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label" for="basicinput">Letter #</label>
                    <input type="text" placeholder="Employee Name" disabled="disabled" value="<?php echo $contract_info->c_renwal_letter_no?>" class="form-control">

                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Designation</label>
                        <input type="text" placeholder="Employee Name" disabled="disabled" value="<?php echo $contract_info->emp_desg_name?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Contract Type</label>
                        <input type="text" placeholder="Employee Name" disabled="disabled" value="<?php echo $contract_info->ctgy_type_name?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Scale</label>
                        <input type="text" placeholder="Employee Name" disabled="disabled" value="<?php echo $contract_info->scale_name?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Contract Date</label>
                        <input type="text" placeholder="Contract Date" disabled="disabled" value="<?php echo $this->CRUDModel->date_convert($contract_info->c_renwal_contract_date);?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Contract From</label>
                        <input type="text" placeholder="Contract From Date" disabled="disabled" value="<?php echo $this->CRUDModel->date_convert($contract_info->c_renwal_from_date);?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput">Contract Expiry</label>
                        <input type="text" placeholder="Contract To Date" disabled="disabled" value="<?php echo $this->CRUDModel->date_convert($contract_info->c_renwal_to_date);?>" class="form-control">
                    </div>
                    
                    <div class="col-md-12">
                        <label for="name">Renewal Remarks</label>
                       <textarea name="renewal_remarks" cols="40" rows="2" disabled="disabled" class="form-control" placeholder="Renewal Remarks" ><?php echo $contract_info->c_renwal_remarks?></textarea>
                   </div>
                    <div class="col-md-12">
                        <label for="name">Renewal Details</label>
                       <textarea name="renewal_remarks" cols="40" rows="2" disabled="disabled" class="form-control" placeholder="Renewal Remarks" ><?php echo $contract_info->c_renwal_details?></textarea>
                   </div>
                 
            </div>
             
        </div>
    </div>
</section>
<div class="col-md-12" style="text-align: center;">
    <div>
        <?php if(!empty($contract_info->c_renwal_image)):?>
            <img id="ImageLarge" src="assets/images/employee/contract_files/<?php echo $contract_info->c_renwal_image?>"  style="max-height: 400px;">
          <?php endif;?>
    </div>
</div>
</div>

<div class="modal-footer">
    <?php if(!empty($contract_info->c_renwal_image)):?>
    <a href='assets/images/employee/contract_files/<?php echo $contract_info->c_renwal_image?>' target="_new" class="btn btn-theme" >Download File</a>
    <?php endif;?>
<button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>

</div>

<script>
      jQuery(document).ready(function(){
          jQuery("#ImageLarge").dblclick(function(){
              var link = jQuery(this).attr('src');
             window.open(link);
//             window.location.href = link;
          });
      });
//ImageLarge
</script>