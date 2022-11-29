<div class="modal-body">
<?php $this->load->view('hr/hr_wedgets/employee_details_popup_v');?>
<section class="course-finder" style="padding-bottom: 2%;" id="emp_bank_form">
    <h1 class="section-heading text-highlight"><span class="line">Employee Bank Details</span></h1>
    <div class="section-content">
        <div class="row">
            <form action="" id="EditContractForm" name="EditContractForm" class="course-finder-form" method="post" accept-charset="utf-8">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Bank Name</label>
                        <input type="hidden" id="emp_id" required="required"  value="<?php echo $emp_id?>">
                        <input type="hidden" id="emp_bank_id"  required="required"  value="">
                        <?php echo form_dropdown('bank',$bank,'',array('class'=>'form-control','id'=>'bank'))?>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Default Account</label>
                       <?php echo form_dropdown('status',$status,'',array('class'=>'form-control','id'=>'status'))?>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Account No</label>
                        <input type="text" id="account_no" class="form-control account_no" placeholder="Account No">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Branch</label>
                        <input type="text" id="branch" class="form-control" placeholder="Branch">
                    </div>
<!--                    <div class="col-md-12">
                        <label class="control-label" for="basicinput">Bank Address</label>
                        <textarea id="bank_address" cols="40" rows="2" class="form-control" placeholder="Bank Address"></textarea>
                    </div>-->
                    <div class="col-md-12">
                        <label class="control-label" for="basicinput">Remarks</label>
                        <textarea id="Remarks" cols="40" rows="2" class="form-control" placeholder="Remarks"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="basicinput"  style="visibility: hidden">Contract sdfsdfasdPicture</label>
                        <button type="button" class="btn btn-theme" name="save" id="save" value="save"><i class="fa fa-plus"></i> Save Record</button>
                        <button type="button" class="btn btn-theme" name="update" id="update" value="update"><i class="fa fa-book"></i> Update Record</button>
                        <button type="button" class="btn btn-theme" name="Reset" id="Reset" value="Reset"><i class="fa fa-refresh"></i> Reset</button>
                    </div> 
                </div>
           </form>  
        </div>
    </div>
</section>
<div id="employee_bank_detals_show"></div>
</div>

<div class="modal-footer">
     
<button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>

</div>


<script>
jQuery(document).ready(function(){

        employee_details_show()
        
    jQuery('#save').on('click',function(){
        var bank        = jQuery('#bank').val();
        var account_no  = jQuery('#account_no').val();
        
        if(bank == ''){ alert('Please Select Bank ');  jQuery('#bank').focus(); return false; };
        if(account_no == ''){ alert('Please Enter Account No');  jQuery('#account_no').focus(); return false; };
        
           var data = {
               'emp_id'         : jQuery('#emp_id').val(),
               'bank'           : bank,
                'account_no'     : account_no,
               'branch'         : jQuery('#branch').val(),
               'Remarks'        : jQuery('#Remarks').val(),
               'status'         : jQuery('#status').val(),
               'request'        : 'saveRecord',
                
           };
            jQuery.ajax({
                type   : 'post',
                url    : 'EmployeeBank',
                data   : data,
                success :function(result){
                    
                    employee_details_show();
                    
                    jQuery('#emp_id').val('');
                    jQuery('#bank').val('');
                    jQuery('#account_no').val('');
                    jQuery('#branch').val('');
                    jQuery('#Remarks').val('');
                    jQuery('#status').val('');
                    
                }
           });

       });
    jQuery('#Reset').on('click',function(){
        $('#EditContractForm')[0].reset();
         employee_details_show();
         
    });
    jQuery('#update').on('click',function(){
          
            var data = {
               'emp_id'         : jQuery('#emp_id').val(),
               'emp_bank_id'    : jQuery('#emp_bank_id').val(),
               'bank'           : jQuery('#bank').val(),
               'account_no'     : jQuery('#account_no').val(),
               'branch'         : jQuery('#branch').val(),
               'Remarks'        : jQuery('#Remarks').val(),
                'status'        : jQuery('#status').val(),
               'request'        : 'upateRecord',
                
           };
            jQuery.ajax({
                type        : 'post',
                url         : 'EmployeeBank',
                data        : data,
                success :function(result){
                     $('#EditContractForm')[0].reset();
                    employee_details_show();
                 }
           });

       });
 function employee_details_show(){
     jQuery('#update').hide();
     jQuery('#save').show();
    var  emp_id = jQuery('#emp_id').val();
      jQuery.ajax({
                type   : 'post',
                url    : 'EmployeeBank',
                data   : {'emp_id':emp_id,'request':'DataGride'},
                success :function(result){
                    $('#employee_bank_detals_show').html(result);
               }
           });
     
 }      
       jQuery(function() {
               jQuery('.account_no').mask('9999-9999999999');
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