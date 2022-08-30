

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>s.no</th>
            <th>Date</th>
            <th>Allotted Messages</th>
            <th>Send Messages</th>
            <th>Remaining Messages</th>
            <th>Remarks</th>
            <th>Department</th>
            <th>Status</th>
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
            <td><?php echo date('d-m-Y',strtotime($row->fee_msgq_date))?></td>
            <td><?php echo $row->fee_msgq_total_msg?></td>
            <td><?php echo $row->fee_msgq_send_msg?></td>
            <td><?php echo $row->fee_msgq_remaining?></td>
            <td><?php echo $row->fee_msgq_remarks?></td>
            <td><?php echo $row->fee_msgq_type_title?></td>
            <td><?php echo $row->fee_msgq_status?></td>
            <td>
                <input type="button" id="<?php echo $row->fee_msgq_id?>"  class="btn btn-primary btn-sm EditQuotaBtn" value="Edit">
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>
<script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.EditQuotaBtnzz').on('click',function(){
            });
        });
    
</script>
<script>
  jQuery(document).ready(function(){
      
      jQuery('.EditQuotaBtn').on('click',function(){
          
          jQuery('#update').show();
          jQuery('#save').hide();
            $.ajax({
                type     : "POST",
                url      : 'Fee-Message-Quota-Details',
                dataType : 'json',
                data     : {'request':'quota_update','quota_id':jQuery(this).attr('id')},
                success  : function(response){
                $('#fee_msgq_id').val(response['fee_msgq_id']);
                $('#quota_date').val(formatDate(response['fee_msgq_date']));
                $('#number_of_sms').val(response['fee_msgq_total_msg']);
                $('#Remarks').val(response['fee_msgq_remarks']);
                $('#Status').val(response['fee_msgq_status']);
                $('#quota_dept').val(response['fee_message_dept_id']);
                $('#send_message').val(response['fee_msgq_send_msg']);
                $('#r_message').val(response['fee_msgq_remaining']);
                }
            });

        });
        function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [day,month, year].join('-');
    }
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