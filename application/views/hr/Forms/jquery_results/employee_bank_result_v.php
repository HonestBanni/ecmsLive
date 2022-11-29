 
<div class="modal fade" id="EditEmpBankDetails" tabindex="-1" role="dialog" aria-labelledby="EmpBankDetails">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

           <div id="edit_emp_bank_details_show">

            </div>


      </div>
    </div>
</div>
<div class="col-md-12">
     
  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
      <?php if($result): ?> 
      <thead>
            <tr>
                <th>S.No</th>
                <th>Bank Name </th>
                <th>Account No</th>
                <th>Branch</th>
                <th>Status</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php $sn = '';
                foreach($result as $row):
                    $sn++;
                echo '<tr>
                        <td>'.$sn.'</td>
                        <td>'.$row->bank_name.'</td>
                        <td>'.$row->heb_account_no.'</td>
                        <td>'.$row->heb_bank_branch.'</td>
                        <td>'.$row->cs_title.'</td>
                        <td><a href="javascript:void(0)" class="employee_bank_edit"  id="'.$row->heb_id.'">Edit</a></td>
                    </tr>';
                endforeach;
            ?>
             
        </tbody>
        <?php endif; ?>
    </table>
    
</div>
 
<script>
jQuery(document).ready(function(){
    jQuery('.employee_bank_edit').on('click',function(){
            var emp_bank_id = jQuery(this).attr('id');
            
            jQuery.ajax({
                type        : 'post',
                url         : 'EmployeeBank',
                dataType    : "json",
                data        : { 'emp_bank_id': emp_bank_id,'request':'EditBankRecord'},
                success :function(result){
                    jQuery('#emp_bank_id').val(result['heb_id']);
                    jQuery('#bank').val(result['heb_bank_id']);
                    jQuery('#branch_code').val(result['heb_branch_code']);
                    jQuery('#account_no').val(result['heb_account_no']);
                    jQuery('#branch').val(result['heb_bank_branch']);
                    jQuery('#Remarks').val(result['heb_remarks']);
                    jQuery('#status').val(result['heb_status']);
                    
                    jQuery('#save').hide();
                    jQuery('#update').show();
                 }
           });

       });
 
       });
</script>