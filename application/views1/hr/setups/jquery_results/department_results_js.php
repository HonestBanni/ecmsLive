
<?php
                $this->db->order_by('category_code','asc');
$result       = $this->db->get('hr_emp_category')->result();
if($result):
    
foreach($result as $catRow):
    

                    $this->db->order_by('emp_deprt_name','asc');
$cat_details    =   $this->db->get_where('hr_emp_departments',array('emp_deprt_cat_id'=>$catRow->category_id))->result();
    if($cat_details):
        ?>
            <h2 class="heading-title pull-left"><?php echo $catRow->category_name?> [ <?php echo $catRow->category_code?> ]</h2>
                    <table class="datatable-1 table table-boxed table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($cat_details as $rec):

                        ?>
                        <tr class="gradeA">
                             <td><?php echo $rec->emp_deprt_name;?></td>
                            <td>
                                <a href="javascript:void(0)" id="<?php echo $rec->emp_deprt_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
                                <a href="javascript:void(0)" id="<?php echo $rec->emp_deprt_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
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
                        'department_id':jQuery(this).attr('id'),
                        'request':'ShowRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Departments-Rst',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                            
                            jQuery.ajax({
                                type        : 'post',
                                url         : 'Departments-Rst',
                                data        : {'category_id':response['emp_desg_cat_id']},
                                success     :function(response){
                                  $('#category_type_id').html(response);
                               }
                           });
                            console.log(response);
                            jQuery('#category_id').val(response['emp_deprt_cat_id']);   
                            jQuery('#department_name').val(response['emp_deprt_name']);  
                            jQuery('#department_id').val(response['emp_deprt_id']);  
                       }
                   });
            });
            jQuery('.DeleteRecord').on('click',function(){
                 
                 if (!confirm("Are you sure to delete this..?")){
                    return false;
                  }
                 
                var send_payload = {
                        'department_id'  : jQuery(this).attr('id'),
                        'request'           : 'deleteRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Departments-Rst',
                        data    : send_payload,
                        success :function(response){
                           jQuery.ajax({
                            type   : 'post',
                            url    : 'Departments-Rst',
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