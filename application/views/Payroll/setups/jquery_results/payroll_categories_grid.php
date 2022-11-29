

<table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th>Category Code</th>
            <th>Category</th>
            <th>Status</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    foreach($result as $rec):
        
    ?>
    <tr class="gradeA">
        <td><?php echo $rec->pr_allow_code;?></td>
        <td><?php echo $rec->pr_allow_name;?></td>
        <td><?php echo $rec->cs_title;?></td>
        <td>
            <a href="javascript:void(0)" id="<?php echo $rec->pr_allow_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $rec->pr_allow_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
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
                 jQuery('#UpdateRecord').show();
                var send_payload = {
                        'pk_id':jQuery(this).attr('id'),
                        'request':'ShowRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Payroll-Categories-Grid',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                          jQuery('#pk_id').val(response['pr_allow_id']);  
                          jQuery('#category_code').val(response['pr_allow_code']);  
                          jQuery('#category_name').val(response['pr_allow_name']);  
                          jQuery('#category_status').val(response['pr_allow_status']); 
                          window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                              });
                       }
                   });
            });
            jQuery('.DeleteRecord').on('click',function(){
                 
                 if (!confirm("Are you sure to delete this..?")){
                    return false;
                  }
                 
                    $.ajax({
                        type     : "POST",
                        url      : 'Payroll-Categories-Grid',
                        data     : {'request':'DeleteRecord','pk_id':jQuery(this).attr('id')},
                        success  : function(response){
                          show_categories();
                        }
                    });
             });
           
           function show_categories(){
                 jQuery('#SaveRecord').show();
                 jQuery('#UpdateRecord').hide();
                 jQuery.ajax({
                        type   : 'post',
                        url    : 'Payroll-Categories-Grid',
                        data   : {'request':'ShowRecords'},
                        success :function(result){
                            $('#result_show').html(result);
                       }
                   });
             }
           
           
        });
    </script> 