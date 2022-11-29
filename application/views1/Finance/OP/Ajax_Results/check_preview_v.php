<?php

if($result):
    


?>
    <table class="table table-boxed table-hover" id="table">
              <thead>
                <tr>
                   <th>#</th>
                    <th>Date</th>
                    <th>Payee</th>
                    <th>Bank Name</th>
                    <th>Cheque #</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th colspan="2">Print</th>
                    <th>Edit</th>
                    
                   
                </tr>
              </thead>
              <tbody>
              <?php
                $sn = '';
                foreach($result as $row):
                    $sn ++;
                    echo '<tr>';
                        echo '<th>'.$sn.'</th>';
                        echo '<th>'.date('d-M-y',strtotime($row->check_date)).'</th>';
                        echo '<th>'.$row->payee.'</th>';
                        echo '<th>'.$row->fn_coa_mc_title.'</th>';
                        echo '<th>'.$row->check_no.'</th>';
                        echo '<th>'.$row->check_amount.'</th>';
                        echo '<th>'.$row->gl_ct_title.'</th>';
                        echo '<th>'.$row->gl_bcs_title.'</th>';
                        echo '<th><button id="'.$row->gl_bcd_id.'" class="btn btn-theme btn-sm btn_printF"><i class="fa fa-print"></i>Print-New</button></th>';
                        echo '<th><button id="'.$row->gl_bcd_id.'" class="btn btn-theme btn-sm btn_print"><i class="fa fa-print"></i>Print</button></th>';
                        echo '<th><button id="'.$row->gl_bcd_id.'" gl_id="'.$row->gl_id.'" class="btn btn-theme btn-sm btn_edit"><i class="fa fa-book"></i>Edit</button></th>';
                    echo '</tr>';
                endforeach;

                ?>
               
                  </tbody>
            </table>

<?php
  
endif;

?>
    <div class="modal fade" id="edit_check_info_view" role="dialog" style="z-index:9999">
        <div class="modal-dialog modal-lg">
            
            <div id="edit_check_info_data">
                
                
            </div>
            
            
            
                     
                
            </div>
        </div>
    
<script>
    
     jQuery(document).ready(function(){
        
        jQuery('.btn_edit').on('click',function(){
                   $('#edit_check_info_view').modal('toggle');
              
              jQuery.ajax({
                type        : 'post',
                url         : 'SaveChequeEdit',
//                dataType    : 'json',
                data        : {'gl_bc_id': jQuery(this).attr('id'),'gl_id':jQuery(this).attr('gl_id')},
                success     : function(response){
                    jQuery('#edit_check_info_data').html(response);
                }
            });
          });
        jQuery('.btn_print').on('click',function(){
               
               var bcd_id = jQuery(this).attr('id');
//               window.location.replace("ChequePrintSetting/"+bcd_id);
                window.open('ChequePrintSetting/'+bcd_id,'_blank');
          });
        jQuery('.btn_printF').on('click',function(){
               
               var bcd_id = jQuery(this).attr('id');
//               window.location.replace("ChequePrintSetting/"+bcd_id);
                window.open('ChequePrintSettingFonts/'+bcd_id,'_blank');
          });
    });
    
    </script>