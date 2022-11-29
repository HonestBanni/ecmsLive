
<?php
if($result):
    

?>
<table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>BPS</th>
            <th>Minimum</th>
            <th>Rate of Increase</th>
            <th>Maximum</th>
            <th>Maximum Steps</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sn = '1';
    foreach($result as $rec):
        
    ?>
    <tr class="gradeA">
        <td><?php echo $sn++?></td>
        <td><?php echo $rec->scale_name;?></td>
        <td><?php echo $rec->psd_min;?></td>
        <td><?php echo $rec->psd_roi;?></td>
        <td><?php echo $rec->psd_max;?></td>
        <td><?php echo $rec->psd_max_steps;?></td>
        <td>
            <a href="javascript:void(0)" id="<?php echo $rec->psd_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
        </td>
       </tr>

    <?php

    endforeach;
  
?>


</tbody>
</table>
<?php
  endif;
?>
 <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.DeleteRecord').on('click',function(){
                 
                 if (!confirm("Are you sure to delete this..?")){
                    return false;
                  }
                 
                    $.ajax({
                        type     : "POST",
                        url         : 'Pay-Scale-Details',
                        data     : {'request':'DeleteRecordDemo','pk_id':jQuery(this).attr('id')},
                        success  : function(response){
                          show_demo_grid();
                        }
                    });
             });
           
            //Show Categoryies Function 
             function show_demo_grid(){
                    jQuery.ajax({
                        type   : 'post',
                        url    : 'Pay-Scale-Details',
                        data    : {'request':'ShowRecordsDemo',"formCode": jQuery('#formCode').val()},
                        success :function(result){
                            $('#result_show_demo').html(result);
                       }
                   });
             }
           
           
        });
    </script> 