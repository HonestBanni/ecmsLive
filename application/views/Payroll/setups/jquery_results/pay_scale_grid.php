
<?php
if($result):
    

?>
<h4 class="modal-title" style="text-align: center; text-transform: uppercase; padding: 2% " id="myModalLabel">Pay scale Results</h4>
<table class="datatable-1 table table-boxed table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th> Financial Year</th>
            <th>Date</th>
            <th>Status</th>
            <th>Remarks</th>
            <th width="32%">Manage</th>
             
            
            
            
        </tr>
    </thead>
    <tbody>
    <?php
    $sn = '1';
    foreach($result as $rec):
        
    ?>
    <tr class="gradeA">
        <td><?php echo $sn++?></td>
        <td><?php echo $rec->fy_year;?></td>
        <td><?php echo $this->CRUDModel->date_convert($rec->ps_date)?></td>
         
         <!--<td><a href="javascript:void(0)" id="<?php echo $rec->ps_id;?>"  data-toggle="modal" data-target="#PayScaleDetailsPopup" class="PayScaleDetails"  style="color: blue;text-decoration: underline;">Edit</a></td>-->
        <td><?php echo $rec->cs_title;?></td>
        <td><?php echo $rec->ps_remarks;?></td>
        <td>
            <a href="Pay-Scale-Print/<?php echo $rec->ps_id;?>" target="_blank"><button type="reset" class="btn btn-theme btn-sm" ><i class="fa fa-print"></i> Print</button></a> &nbsp;
            <a href="Pay-Scale-Allowance/<?php echo $rec->ps_id;?>" ><button type="reset" class="btn btn-theme btn-sm" ><i class="fa fa-area-chart"></i> Allowances</button></a> &nbsp;
            <a href="Pay-Scale-Edit/<?php echo $rec->ps_id;?>" ><button type="reset" class="btn btn-theme btn-sm" ><i class="fa fa-book"></i> Update</button></a> &nbsp;
            <a href="javascript:void(0)" id="<?php echo $rec->ps_id;?>"  class="DeleteRecord"  style="color: red;text-decoration: underline;"><button type="reset" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i> Delete</button></a>
        </td>
       </tr>

    <?php

    endforeach;
  
?>


</tbody>
</table>
 <div class="modal fade " id="PayScaleDetailsPopup" tabindex="-1" role="dialog" aria-labelledby="PayScaleDetails">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div id="pay_scale_popup_result">
        </div>
    </div>
  </div>
</div>


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
                        data     : {'request':'DeleteRecord','pk_id':jQuery(this).attr('id')},
                        success  : function(response){
                          show_pay_scale_grid();
                        }
                    });
             });
            jQuery('.PayScaleDetails').on('click',function(){
                  
                    $.ajax({
                        type     : "POST",
                        url         : 'Pay-Scale-Details',
                        data     : {'request':'PayScallDetails','pk_id':jQuery(this).attr('id')},
                        success  : function(response){
                           jQuery("#pay_scale_popup_result").html(response);
                        }
                    });
             });
           
            //Show Categoryies Function 
               function show_pay_scale_grid(){
                    jQuery('#entry_success').hide();
                    jQuery.ajax({
                        type   : 'post',
                        url    : 'Pay-Scale-Details',
                        data    : {'request':'ShowPayscaleGrid'},
                        success :function(result){
                            $('#result_show').html(result);
                       }
                   });
             }
           
           
        });
    </script> 