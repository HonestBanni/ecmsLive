

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Bank Name</th>
            <th>Branch Name</th>
            <th>Account#</th>
            <th>Default Account</th>
            <th>Remarks</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if($result):
            $sn = '';
           foreach($result as $row):
            $sn++;
        ?>
        <tr>
            <td><?php echo $sn?></td>
            <td><?php echo $row->bank_name?></td>
            <td><?php echo $row->branch_name?></td>
            <td><?php echo $row->heb_account_no?></td>
            <td><?php echo $row->yn_value?></td>
            <td><?php echo $row->heb_remarks?></td>
             
            <td>
                <button id="<?php echo $row->heb_id?>"  class="btn btn-primary btn-sm EditBank">Edit</button>
                <button id="<?php echo $row->heb_id?>"  class="btn btn-danger btn-sm DeleteBank">Delete</button>
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>

<script>
  jQuery(document).ready(function(){
      jQuery('.DeleteBank').on('click',function(){
            if (!confirm("Are you sure to delete this..?")){ return false;} 
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                data     : {'request':'bank_delete','bank_id':jQuery(this).attr('id')},
                success  : function(response){
                   Bank_Grid();
                }
            });

        });
      jQuery('.EditBank').on('click',function(){
         
          jQuery('#updateBank').show();
          jQuery('#saveBank').hide();
         
         
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                dataType : 'json',
                data     : {'request':'bank_update','bank_id':jQuery(this).attr('id')},
                success  : function(response){
                $('.bank_emp_id').val(response['heb_id']);
                $('#bank').val(response['bank_id']);
                $('#branch').val(response['branch_id']);
                $('#default_acct').val(response['heb_default_account']);
                $('input:text[name=account_no]').val(response['heb_account_no']);
                $('.shif_remarks').val(response['heb_remarks']);
                }
            });

        });
          function Bank_Grid(){
                    jQuery('.bank_emp_id').val('');
                   if(jQuery('.bank_emp_id').val() == ''){
                        
                        jQuery('#updateBank').hide();
                        jQuery('#saveBank').show();
                    }else{
                       jQuery('#updateBank').show();
                       jQuery('#saveBank').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'bank_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#BankGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'bank','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Bank-tab').css('color','red');
                                 }else{
                                     jQuery('#Bank-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
        
  });
</script>