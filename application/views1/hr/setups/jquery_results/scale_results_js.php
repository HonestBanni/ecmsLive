

<table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th>Scale Name</th>
            
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    foreach($result as $rec):
        
    ?>
    <tr class="gradeA">
        <td><?php echo $rec->scale_name;?></td>
        <td>
            <a href="javascript:void(0)" id="<?php echo $rec->emp_scale_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $rec->emp_scale_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
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
                        'scale_id':jQuery(this).attr('id'),
                        'request':'ShowRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Scale-Rst',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                            console.log(response);
                            
                          jQuery('#scale_id').val(response['emp_scale_id']);  
                          jQuery('#scale_name').val(response['scale_name']);  
                          
                       }
                   });
            });
            jQuery('.DeleteRecord').on('click',function(){
                 
                 if (!confirm("Are you sure to delete this..?")){
                    return false;
                  }
                 
                var send_payload = {
                        'scale_id':jQuery(this).attr('id'),
                        'request':'deleteRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Scale-Rst',
                        data    : send_payload,
                        success :function(response){
                           jQuery.ajax({
                            type   : 'post',
                            url    : 'Scale-Rst',
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