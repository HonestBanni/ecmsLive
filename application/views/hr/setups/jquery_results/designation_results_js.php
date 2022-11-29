<?php
                $this->db->order_by('category_code','asc');
$result       = $this->db->get('hr_emp_category')->result();
if($result):
    foreach($result as $catRow):
  
?>
<h2 class="heading-title pull-left" style=" font-weight: bold; "><?php echo $catRow->category_name?> [ <?php echo $catRow->category_code?> ]</h2>
<table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th colspan="4">CATEGORY</th>
        </tr>
    </thead>
    <tbody>
    <?php
                        $this->db->order_by('ctgy_type_code','asc');
    $cat_type_details    =   $this->db->get_where('hr_emp_category_type',array('ctgy_type_cat_id'=>$catRow->category_id))->result();
    foreach($cat_type_details as $ct_ty_rec):
                                     $this->db->order_by('emp_desg_code','asc');
    $designation_details    =   $this->db->get_where('hr_emp_designation',array('emp_desg_cat_id'=>$catRow->category_id,'emp_desg_cat_type_id'=>$ct_ty_rec->category_type_id))->result();
    if($designation_details):
        
        
    ?>
    <tr class="gradeA">
        <td colspan="4"><h4 style=" font-weight: bold; ">[<?php echo $ct_ty_rec->ctgy_type_code;?>] <?php echo $ct_ty_rec->ctgy_type_name;?></h4></td>
        
        
      </tr>
      <thead>
        <tr>
            <th></th>
            <th>Designation Code</th>
            <th>Designation Name</th>
            <th>Manage</th>
            
        </tr>
    </thead>
    <tbody>
    <?php
   
        foreach($designation_details as $row_design):
         ?>
        <tr class="gradeA">
            <td></td>
            <td>[<?php echo $row_design->emp_desg_code;?>]</td>
            <td><?php echo $row_design->emp_desg_name;?></td>
            <td><a href="javascript:void(0)" id="<?php echo $row_design->emp_desg_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $row_design->emp_desg_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
        </td>
      </tr>
        <?php
        endforeach;
    endif;
   
    endforeach;
?>


</tbody>
</table>
<?php

 
    endforeach;
endif

?>
 <td>
<!--            <a href="javascript:void(0)" id="<?php echo $ct_ty_rec->ctgy_type_code;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $ct_ty_rec->ctgy_type_code;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
        </td>-->

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
                        url     : 'Staff-Categories-Design-Rst',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                            
                            jQuery.ajax({
                                type        : 'post',
                                url         : 'Get-Category-Type',
                                data        : {'category_id':response['emp_desg_cat_id']},
                                success     :function(response){
                                  $('#category_type_id').html(response);
                               }
                           });
                            console.log(response);
                            jQuery('#category_id').val(response['emp_desg_cat_id']);   
                            jQuery('#category_type_id').val(response['emp_desg_cat_type_id']); 
                            jQuery('#designation_code').val(response['emp_desg_code']);  
                            jQuery('#designation_name').val(response['emp_desg_name']);  
                            jQuery('#designation_code_id').val(response['emp_desg_id']);  
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
                        'designation_id'  : jQuery(this).attr('id'),
                        'request'           : 'deleteRecord'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Staff-Categories-Design-Rst',
                        data    : send_payload,
                        success :function(response){
                           jQuery.ajax({
                            type   : 'post',
                            url    : 'Staff-Categories-Design-Rst',
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