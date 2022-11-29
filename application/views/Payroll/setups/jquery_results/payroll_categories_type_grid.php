<?php
                $this->db->order_by('pr_allow_name','asc');
$result       = $this->db->get('pr_allowance')->result();
if($result):
    
foreach($result as $catRow):
    ?>
 <h2 class="heading-title pull-left"><?php echo $catRow->pr_allow_name?> [ <?php echo $catRow->pr_allow_code?> ]</h2>
    <table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            
            <th>Allowance Type Code</th>
            <th>Allowance Type</th>
            <th>Status</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $result_type           =  $this->PayrollModel->get_payroll_categories_type(array('allow_type_category_id'=>$catRow->pr_allow_id));
    foreach($result_type as $rec):
        
    ?>
    <tr class="gradeA">
        <td><?php echo $rec->allow_type_code;?></td>
        <td><?php echo $rec->allow_type_name;?></td>
        <td><?php echo $rec->cs_title;?></td>
        <td>
            <a href="javascript:void(0)" id="<?php echo $rec->allow_type_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $rec->allow_type_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
        </td>
       </tr>

    <?php

    endforeach;
?>


</tbody>
</table>

    <?php
endforeach;
endif;
?>


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
                        url     : 'Payroll-Categories-Type-Grid',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                          jQuery('#pk_id').val(response['allow_type_id']);  
                          jQuery('#category').val(response['allow_type_category_id']);  
                          jQuery('#category_type_code').val(response['allow_type_code']);  
                          jQuery('#category_type_name').val(response['allow_type_name']);  
                          jQuery('#category_status').val(response['allow_type_status']); 
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
                        url      : 'Payroll-Categories-Type-Grid',
                        data     : {'request':'DeleteRecord','pk_id':jQuery(this).attr('id')},
                        success  : function(response){
                          show_categories_type();
                        }
                    });
             });
           
         function show_categories_type(){
                 jQuery('#SaveRecord').show();
                 jQuery('#UpdateRecord').hide();
                 jQuery.ajax({
                        type   : 'post',
                        url    : 'Payroll-Categories-Type-Grid',
                        data    : {'request':'ShowRecords'},
                        success :function(result){
                            $('#result_show').html(result);
                       }
                   });
             }
           
           
        });
    </script> 