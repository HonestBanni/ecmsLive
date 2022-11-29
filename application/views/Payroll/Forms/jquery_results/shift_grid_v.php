

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Fund Status</th>
            <th>Date</th>
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
            <td><?php echo $row->shift_name?></td>
            <td><?php echo date('d-m-Y',strtotime($row->ess_date))?></td>
            <td><?php echo $row->ess_remarks?></td>
            <td>
                <button id="<?php echo $row->ess_id?>"  class="btn btn-primary btn-sm EditShift">Edit</button>
                <button id="<?php echo $row->ess_id?>"  class="btn btn-danger btn-sm DeleteShift">Delete</button>
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>

<script>
  jQuery(document).ready(function(){
      jQuery('.DeleteShift').on('click',function(){
            if (!confirm("Are you sure to delete this..?")){ return false;} 
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                data     : {'request':'shift_delete','shift_id':jQuery(this).attr('id')},
                success  : function(response){
                   Fund_Grid();
                }
            });

        });
      jQuery('.EditShift').on('click',function(){
         
          jQuery('#updateShift').show();
          jQuery('#saveShift').hide();
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                dataType : 'json',
                data     : {'request':'shift_update','fund_id':jQuery(this).attr('id')},
                success  : function(response){
                $('.shift_pk_id').val(response['ess_id']);
                
                $('#fund').val(response['emf_emp_fund_id']);
                $('#shift').val(response['ess_shift_id']);
                    
                    var exp_from = response['ess_date'];
                    var sp_exp_from = exp_from.split("-");
                $('#shift_year').val(Number(sp_exp_from[0]).toString()); 
                $('#shift_month').val(Number(sp_exp_from[1]).toString()); 
                $('#shift_day').val(sp_exp_from[2]); 
                $('.shif_remarks').val(response['ess_remarks']);
                }
            });

        });
        
         function Fund_Grid(){
                  
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'shift_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#ShiftGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'shift','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Shift-tab').css('color','red');
                                 }else{
                                     jQuery('#Shift-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
        
  });
</script>