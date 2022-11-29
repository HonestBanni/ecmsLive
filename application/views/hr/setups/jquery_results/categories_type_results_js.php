<?php
                $this->db->order_by('category_code','asc');
$result       = $this->db->get('hr_emp_category')->result();
if($result):
    
foreach($result as $catRow):
    

                    $this->db->order_by('ctgy_type_code','asc');
$cat_details    =   $this->db->get_where('hr_emp_category_type',array('ctgy_type_cat_id'=>$catRow->category_id))->result();
    if($cat_details):
        ?>
            <h2 class="heading-title pull-left"><?php echo $catRow->category_name?> [ <?php echo $catRow->category_code?> ]</h2>
                    <table class="datatable-1 table table-boxed table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Category Type Code</th>
                                <th>Category Type Name</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($cat_details as $rec):

                        ?>
                        <tr class="gradeA">
                             <td><?php echo $rec->ctgy_type_code;?></td>
                            <td><?php echo $rec->ctgy_type_name;?></td>

                            <td>
                                <a href="javascript:void(0)" id="<?php echo $rec->category_type_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
                                <a href="javascript:void(0)" id="<?php echo $rec->category_type_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
                            </td>
                          </tr>

                        <?php

                        endforeach;
                    ?>


                    </tbody>
                    </table>
<?php
 endif;
endforeach;
endif;
?>
 

 <script type="text/javascript">
        jQuery(document).ready(function(){
            
            //Update Record
            jQuery('.ShowUpdate').on('click',function(){
                jQuery('#SaveRecord').hide();
                jQuery('#SaveUpdate').show();
                var send_payload = {
                        'category_type_id':jQuery(this).attr('id'),
                        'request':'ShowRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Staff-Categories-Type-Rst',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                            console.log(response);
                            
                          jQuery('#category_type_id').val(response['category_type_id']);  
                          jQuery('#category_id').val(response['ctgy_type_cat_id']);  
                          jQuery('#category_type_code').val(response['ctgy_type_code']);  
                          jQuery('#category_type_name').val(response['ctgy_type_name']);  
                       }
                   });
            });
            jQuery('.DeleteRecord').on('click',function(){
                 
                 if (!confirm("Are you sure to delete this..?")){
                    return false;
                  }
                 
                var send_payload = {
                        'category_type_id'  : jQuery(this).attr('id'),
                        'request'           : 'deleteRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Staff-Categories-Type-Rst',
                        data    : send_payload,
                        success :function(response){
                           jQuery.ajax({
                            type   : 'post',
                            url    : 'Staff-Categories-Type-Rst',
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