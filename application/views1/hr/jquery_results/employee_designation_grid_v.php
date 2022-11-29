

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Category</th>
            <!--<th>Category Type</th>-->
            <!--<th>Designation</th>-->
            <th>Department</th>
            <th>Remarks</th>
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
            <td>[ <?php echo $row->category_code?> ] <?php echo $row->category_name?></td>
<!--            <td>[ <?php  echo $row->ctgy_type_code?> ] <?php echo $row->ctgy_type_name?></td>-->
            <!--<td>[ <?php // echo $row->emp_desg_code?>  ] <?php //echo  $row->emp_desg_name?></td>-->
            <td><?php echo $row->emp_deprt_name?></td>
            <td><?php echo $row->emp_staff_remarks?></td>
            
            <td>
                <button id="<?php echo $row->emp_staff_design_id?>"  class="btn btn-primary btn-sm EditDesignation">Edit</button>
                <button id="<?php echo $row->emp_staff_design_id?>"  class="btn btn-danger btn-sm DeleteDesignation">Delete</button>
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>

<script>
  jQuery(document).ready(function(){
      jQuery('.DeleteDesignation').on('click',function(){
            if (!confirm("Are you sure to delete this..?")){ return false;} 
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                data     : {'request':'designation_delete','designation_id':jQuery(this).attr('id')},
                success  : function(response){
                   Designation_Grid();
                }
            });

        });
      jQuery('.EditDesignation').on('click',function(){
         
          jQuery('#updateDesignation').show();
          jQuery('#saveDesignation').hide();
         
         
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                dataType : 'json',
                data     : {'request':'designation_update','designation_id':jQuery(this).attr('id')},
                success  : function(response){
                $('.emp_staff_design_id').val(response['emp_staff_design_id']);
                $('#category_id').val(response['category_id']);
//                $('#category_type_id').val(response['category_type_id']);
//                $('#designation_id').val(response['emp_desg_id']);
                $('#department_id').val(response['emp_deprt_id']);
                $('#department_id').val(response['emp_deprt_id']);
                $('.dep_remarks').val(response['emp_staff_remarks']);
               
                }
            });

        });
        
         function Designation_Grid(){
                    
                    var designation_id = jQuery('.emp_staff_design_id').val();
                    
                    if(designation_id == ''){
                        
                        jQuery('#updateDesignation').hide();
                        jQuery('#saveDesignation').show();
                    }else{
                       jQuery('#updateDesignation').show();
                       jQuery('#saveDesignation').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'designation_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#DesignationGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'department','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Department-tab').css('color','red');
                                 }else{
                                     jQuery('#Department-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
        
  });
</script>