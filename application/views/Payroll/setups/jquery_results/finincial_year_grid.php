

<table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th>Financial Year</th>
            <th>Financial Year Start</th>
            <th>Financial Year End</th>
            <th>Default </th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    foreach($result as $rec):
        
    ?>
    <tr class="gradeA">
        <td><strong><?php echo $rec->fy_year;?></strong></td>
        <td><?php echo $this->CRUDModel->date_convert($rec->fy_year_start);?></td>
        <td><?php echo $this->CRUDModel->date_convert($rec->fy_year_end);?></td>
        
        <td><?php echo $rec->cs_title;?></td>
        <td>
            <a href="javascript:void(0)" id="<?php echo $rec->fy_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $rec->fy_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
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
                        url     : 'Financial-Year-Grid',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                          jQuery('#pk_id').val(response['fy_id']);   
                          jQuery('#fy_year').val(response['fy_year']);   
                            
                            var exp_from = response['fy_year_start'];
                            var sp_exp_from = exp_from.split("-");
                        $('#fy_start_year').val(Number(sp_exp_from[0]).toString()); 
                        $('#fy_start_month').val(Number(sp_exp_from[1]).toString()); 
                        $('#fy_start_day').val(sp_exp_from[2]);
                            
                            var exp_from = response['fy_year_end'];
                            var sp_exp_from = exp_from.split("-");
                        $('#fy_end_year').val(Number(sp_exp_from[0]).toString()); 
                        $('#fy_end_month').val(Number(sp_exp_from[1]).toString()); 
                        $('#fy_end_day').val(sp_exp_from[2]);
                          
                        jQuery('#category_status').val(response['fy_default_active']); 
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
                        url         : 'Financial-Year-Grid',
                        data     : {'request':'DeleteRecord','pk_id':jQuery(this).attr('id')},
                        success  : function(response){
                          show_grid_result();
                        }
                    });
             });
           
          function show_grid_result(){
                 jQuery('#SaveRecord').show();
                 jQuery('#UpdateRecord').hide();
                 jQuery.ajax({
                        type   : 'post',
                        url    : 'Financial-Year-Grid',
                        data    : {'request':'ShowRecords'},
                        success :function(result){
                            $('#result_show').html(result);
                       }
                   });
             }
           
           
        });
    </script> 