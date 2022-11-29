<?php
                $this->db->order_by('allow_type_name','asc');
$result       = $this->db->get('pr_allowance_types')->result();
if($result):
    
foreach($result as $catRow):
                             $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=pr_pay_scale_allowance.psa_pay_scale');
    $result_bps           =  $this->db->get_where('pr_pay_scale_allowance',array('psa_ps_id'=>$this->input->post('pay_scal_id'),'psa_allowance_type_id'=>$catRow->allow_type_id))->result();
    if(!empty($result_bps)):
        
 
    ?>
 <h2 class="heading-title pull-left"><?php echo $catRow->allow_type_name?></h2>
    <table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th>BPS</th>
            <th>Amount</th>
            <th width="20%" >Manage</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach($result_bps as $rec):
    ?>
    <tr class="gradeA">
        <td><?php echo $rec->scale_name;?></td>
        <td><?php echo $rec->psa_amount;?></td>
        <td>
            <a href="javascript:void(0)" id="<?php echo $rec->psa_id;?>" class="ShowUpdate"  style="color: blue;text-decoration: underline;">Update</a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $rec->psa_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;">Delete</a>
        </td>
       </tr>

    <?php

    endforeach;
       endif;
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
                        'request':'fetch'
                    };
                jQuery.ajax({
                        type    : 'post',
                        url     : 'Pay-Scale-Allowance-Grid',
                        dataType: 'json',
                        data    : send_payload,
                        success :function(response){
                          jQuery('#pk_id').val(response['psa_id']);  
                          jQuery('#pay_type').val(response['psa_allowance_type_id']);  
                          jQuery('#bps').val(response['psa_pay_scale']);  
                          jQuery('#allow_amount').val(response['psa_amount']);  
                          
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
                        url      : 'Pay-Scale-Allowance-Grid',
                        data     : {'request':'delete','pk_id':jQuery(this).attr('id')},
                        success  : function(response){
                          show_grid();
                        }
                    });
             });
           
         function show_grid(){
                 jQuery('#SaveRecord').show();
                 jQuery('#UpdateRecord').hide();
                 jQuery.ajax({
                        type   : 'post',
                        url    : 'Pay-Scale-Allowance-Grid',
                        data    : {'request':'show','pay_scal_id':jQuery('#pay_scale_id').val()},
                        success :function(result){
                            $('#result_show').html(result);
                       }
                   });
             }
           
           
        });
    </script> 