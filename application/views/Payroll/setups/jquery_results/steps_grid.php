

<table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Step</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sn = '1';
    foreach($result as $rec):
        
    ?>
    <tr class="gradeA">
        <td><?php echo $sn++?></td>
        <td><?php echo $rec->steps_name;?></td>
        <td>
            <a href="javascript:void(0)" id="<?php echo $rec->emp_steps_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $rec->emp_steps_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
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
                        url      : 'Payroll-Steps-Grid',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                          jQuery('#pk_id').val(response['emp_steps_id']);  
                          jQuery('#step').val(response['steps_name']);  
                          
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
                        url         : 'Payroll-Steps-Grid',
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
                        url    : 'Payroll-Steps-Grid',
                        data   : {'request':'ShowRecords'},
                        success :function(result){
                            $('#result_show').html(result);
                       }
                   });
             }
           
           
        });
    </script> 