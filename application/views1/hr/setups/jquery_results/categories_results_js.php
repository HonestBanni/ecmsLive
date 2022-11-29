

<table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th>Category Code</th>
            <th>Category Name</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    foreach($result as $rec):
        
    ?>
    <tr class="gradeA">
        
        <td><?php echo $rec->category_code;?></td>
        <td><?php echo $rec->category_name;?></td>
        <td>
            <a href="javascript:void(0)" id="<?php echo $rec->category_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $rec->category_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
        </td>
        
        
<!--        <button id="<?php echo base_url();?>HrController/delete_category/<?php echo $rec->cat_id;?>"onclick="return confirm('Are You Sure to Delete This..?')"><i class="icon-trash" style="color:#87a938"></i><b> Delete</b></button>
        <a href="<?php echo base_url();?>HrController/delete_category/<?php echo $rec->cat_id;?>"onclick="return confirm('Are You Sure to Delete This..?')"><i class="icon-trash" style="color:#87a938"></i><b> Delete</b></a></td>-->
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
                        'category_id':jQuery(this).attr('id'),
                        'request':'ShowRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Stafft-CategoriesRst',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                            console.log(response);
                            
                          jQuery('#category_id').val(response['category_id']);  
                          jQuery('#category_code').val(response['category_code']);  
                          jQuery('#category_name').val(response['category_name']); 
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
                 
                var send_payload = {
                        'category_id':jQuery(this).attr('id'),
                        'request':'deleteRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Stafft-CategoriesRst',
                        data    : send_payload,
                        success :function(response){
                           jQuery.ajax({
                            type   : 'post',
                            url    : 'Stafft-CategoriesRst',
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