
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
            <th width="15%">Delete</th>
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
            <a href="javascript:void(0)" id="<?php echo $rec->psd_id;?>"  class="EditRecord" ><button type="button" class="btn btn-theme btn-sm"><i class="fa fa-book"></i> Update</button></a>
            <a href="javascript:void(0)" id="<?php echo $rec->psd_id;?>"  class="DeleteRecord" ><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-recycle"></i> Delete</button></a>
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
                        url      : 'Pay-Scale-Details-Edit',
                        data     : {'request':'DeleteRecordEdit','pk_id':jQuery(this).attr('id')},
                        success  : function(response){
                          show_record_grid();
                        }
                    });
             });
            jQuery('.EditRecord').on('click',function(){
                jQuery('#PayScaleDetails').hide();
                jQuery('#PayScaleDetailsEdit').show();
                
                  
                    $.ajax({
                        type     : "POST",
                        url      : 'Pay-Scale-Details-Edit',
                        dataType: 'json',
                        data     : {'request':'getRecordEdit','pk_id':jQuery(this).attr('id')},
                        success  : function(response){
                            jQuery('#pk_sd_id').val(response['psd_id']);  
                            jQuery('#bps').val(response['psd_pay_scale']);  
                            jQuery('#minimum').val(response['psd_min']);  
                            jQuery('#roi').val(response['psd_roi']);  
                            jQuery('#maximum').val(response['psd_max']);  
//                          show_record_grid();
                        }
                    });
             });
             
             jQuery('#PayScaleDetailsEdit').on('click',function(){
                 var    formData = new FormData($("#RecordForm")[0]);
                        formData.set("request", 'PayScaleDetailsUpdate');
                jQuery.ajax({
                            type        : "POST",
                            url         : 'Pay-Scale-Details-Edit',
                            data        : formData,
                            dataType    : 'json',
                            contentType : false,
                            processData : false,
       
                        success :function(response){
                           if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }else {
                                
                                $('#RecordForm')[0].reset();
                               show_record_grid();
                               
                            }
                           
                       }
                   });
            });
             
           
             function show_record_grid(){
                 if(jQuery('#pk_sd_id').val() == ''){
                     jQuery('#PayScaleDetailsEdit').show();
                     jQuery('#PayScaleDetails').hide();
                 }else{
                     
                     jQuery('#PayScaleDetailsEdit').hide();
                     jQuery('#PayScaleDetails').show();
                 }
                 jQuery('#entry_success').hide();
                    jQuery.ajax({
                        type   : 'POST',
                        url    : 'Pay-Scale-Details-Edit',
                        data    : {'request':'showEditGrid',"pk_id": jQuery('#pk_id').val()},
                        success :function(result){
                            $('#result_show_demo').html(result);
                       }
                   });
             }
           
           
        });
    </script> 