

<table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th>Bank Name</th>
            <th>Short Name</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    foreach($result as $rec):
        
    ?>
    <tr class="gradeA">
        <td><?php echo $rec->bank_name;?></td>
        <td><?php echo $rec->bank_short_name;?></td>
        <td>
            <a href="javascript:void(0)" id="<?php echo $rec->bank_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $rec->bank_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
        </td>
       </tr>

    <?php

    endforeach;
?>


</tbody>
</table>

 <script type="text/javascript">
        jQuery(document).ready(function(){
            
            //Update Record
            jQuery('.ShowUpdate').on('click',function(){
                jQuery('#SaveRecord').hide();
                jQuery('#SaveUpdate').show();
                var send_payload = {
                        'bank_id':jQuery(this).attr('id'),
                        'request':'ShowRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Bank-Rst',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                            console.log(response);
                            
                          jQuery('#bank_id').val(response['bank_id']);  
                          jQuery('#bank_name').val(response['bank_name']);  
                          jQuery('#bank_short_name').val(response['bank_short_name']);  
                       }
                   });
            });
            jQuery('.DeleteRecord').on('click',function(){
                 
                 if (!confirm("Are you sure to delete this..?")){
                    return false;
                  }
                 
                var send_payload = {
                        'bank_id':jQuery(this).attr('id'),
                        'request':'deleteRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Bank-Rst',
                        data    : send_payload,
                        success :function(response){
                           jQuery.ajax({
                            type   : 'post',
                            url    : 'Bank-Rst',
                            data    : {'request':'showRecords'},
                            success :function(result){
                                $('#categories_result_show').html(result);
                           }
                       }); 
                       }
                   });
            });
            
        });
    </script> 