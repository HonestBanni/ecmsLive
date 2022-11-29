

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
            <td><?php echo $row->fund_status_name?></td>
            <td><?php echo date('d-m-Y',strtotime($row->emf_date))?></td>
            <td><?php echo $row->emf_remarks?></td>
            <td>
                <button id="<?php echo $row->emf_id?>"  class="btn btn-primary btn-sm EditFund">Edit</button>
                <button id="<?php echo $row->emf_id?>"  class="btn btn-danger btn-sm DeleteFund">Delete</button>
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>

<script>
  jQuery(document).ready(function(){
      jQuery('.DeleteFund').on('click',function(){
            if (!confirm("Are you sure to delete this..?")){ return false;} 
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                data     : {'request':'fund_delete','fund_id':jQuery(this).attr('id')},
                success  : function(response){
                   Fund_Grid();
                }
            });

        });
      jQuery('.EditFund').on('click',function(){
         
          jQuery('#updateFund').show();
          jQuery('#saveFund').hide();
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                dataType : 'json',
                data     : {'request':'fund_update','fund_id':jQuery(this).attr('id')},
                success  : function(response){
                $('.fund_pk_id').val(response['emf_id']);
                $('#fund').val(response['emf_emp_fund_id']);
                $('#fund_remarks').val(response['emf_remarks']);
                    
                    var exp_from = response['emf_date'];
                    var sp_exp_from = exp_from.split("-");
                $('#fund_year').val(Number(sp_exp_from[0]).toString()); 
                $('#fund_month').val(Number(sp_exp_from[1]).toString()); 
                $('#fund_day').val(sp_exp_from[2]); 
                  
                }
            });

        });
        
         function Fund_Grid(){
                   if(jQuery('.fund_pk_id').val() == ''){
                        
                        jQuery('#updateFund').hide();
                        jQuery('#saveFund').show();
                    }else{
                       jQuery('#updateFund').show();
                       jQuery('#saveFund').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'fund_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#FundGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'fund','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Fund-tab').css('color','red');
                                 }else{
                                     jQuery('#Fund-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
        
  });
</script>