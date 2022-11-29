

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Allowance</th>
            <th>Amount</th>
            <th>Date</th>
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
            <td><?php echo $row->ha_name?></td>
            <td><?php echo $row->ha_amount?></td>
            <td><?php echo $this->CRUDModel->date_convert($row->hsa_date);?></td>
            <td><?php echo $row->yn_value?></td>
            <td><?php echo $row->hsa_remarks?></td>
            <td>
                <button id="<?php echo $row->hsa_id?>"  class="btn btn-primary btn-sm EditAllowance">Edit</button>
                <button id="<?php echo $row->hsa_id?>"  class="btn btn-danger btn-sm DeleteAllowance">Delete</button>
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>

<script>
  jQuery(document).ready(function(){
      jQuery('.DeleteAllowance').on('click',function(){
            if (!confirm("Are you sure to delete this..?")){ return false;} 
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                data     : {'request':'allowance_delete','allowance_id':jQuery(this).attr('id')},
                success  : function(response){
                   Allowance_Grid();
                }
            });

        });
      jQuery('.EditAllowance').on('click',function(){
         
          jQuery('#updateAllowance').show();
          jQuery('#saveAllowance').hide();
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                dataType : 'json',
                data     : {'request':'allowance_update','allowance_id':jQuery(this).attr('id')},
                success  : function(response){
                $('.allowance_id').val(response['hsa_id']);
                $('#allowance').val(response['hsa_allowanc_id']);
                
                      var exp_from = response['hsa_date'];
                    var sp_exp_from = exp_from.split("-");
                $('#allowance_year').val(Number(sp_exp_from[0]).toString()); 
                $('#allowance_month').val(Number(sp_exp_from[1]).toString()); 
                $('#allowance_day').val(sp_exp_from[2]);
                
                $('#default_allowance').val(response['hsa_default_allowanc']);
                $('.allowance_remarks').val(response['hsa_remarks']);
                }
            });

        });
         function Allowance_Grid(){
                    jQuery('.allowance_id').val('');
                   if(jQuery('.allowance_id').val() == ''){
                        jQuery('#updateAllowance').hide();
                        jQuery('#saveAllowance').show();
                    }else{
                       jQuery('#updateAllowance').show();
                       jQuery('#saveAllowance').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'allowance_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#AllowanceGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'allowance','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Allowance-tab').css('color','red');
                                 }else{
                                     jQuery('#Allowance-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
        
  });
</script>