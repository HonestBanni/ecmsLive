

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Responsibility</th>
            <th>Date From</th>
            <th>Date To</th>
            <th>Duration</th>
            <th>Status</th>
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
           
            
                $d1         = new DateTime($row->resp_from_date); 
                $d2         = new DateTime($row->resp_to_date);                                  
                $Months     = $d2->diff($d1); 
                
                $totalExp   = $Months->y.' Years '.$Months->m.' Months and '.$Months->d.' Days';
           
        ?>
        <tr>
            <td><?php echo $sn?></td>
            <td><?php echo $row->resp_details?></td>
            <td><?php echo $this->CRUDModel->date_convert($row->resp_from_date)?></td>
            <td><?php echo $this->CRUDModel->date_convert($row->resp_to_date)?></td>
            <td><?php echo $totalExp?></td>
            <td><?php echo $row->cs_title?></td>
            <td><?php echo $row->resp_remarks?></td>
            <td>
                <button id="<?php echo $row->resp_id?>"  class="btn btn-primary btn-sm EditRespon">Edit</button>
                <button id="<?php echo $row->resp_id?>"  class="btn btn-danger btn-sm DeleteRespon">Delete</button>
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>

<script>
  jQuery(document).ready(function(){
      jQuery('.DeleteRespon').on('click',function(){
            if (!confirm("Are you sure to delete this..?")){ return false;} 
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                data     : {'request':'respon_delete','respon_id':jQuery(this).attr('id')},
                success  : function(response){
                   Responsibility_Grid();
                }
            });

        });
      jQuery('.EditRespon').on('click',function(){
         
            jQuery('#updateResponsibility').show();
            jQuery('#saveResponsibility').hide(); 
         
         
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                dataType : 'json',
                data     : {'request':'respon_update','respon_id':jQuery(this).attr('id')},
                success  : function(response){
                $('.Resp_id').val(response['resp_id']);
                $('.responsibility').val(response['resp_details']);
                
                 var exp_from = response['resp_from_date'];
                    var sp_exp_from = exp_from.split("-");
                $('#Resp_from_year').val(Number(sp_exp_from[0]).toString()); 
                $('#Resp_from_month').val(Number(sp_exp_from[1]).toString()); 
                $('#Resp_from_day').val(sp_exp_from[2]); 
                  
                    var exp_to = response['resp_to_date'];
                    var sp_exp_to = exp_to.split("-");
                $('#Resp_to_year').val(Number(sp_exp_to[0]).toString()); 
                $('#Resp_to_month').val(Number(sp_exp_to[1]).toString()); 
                $('#Resp_to_day').val(sp_exp_to[2]); 
                
                
                $('#Resp_status').val(response['resp_status']);
                $('.Resp_remarks').val(response['Resp_remarks']);
                }
            });

        });
         function Responsibility_Grid(){
             $.ajax({
                 type     : "POST",
                 url      : 'PersonalInformation',
                 data     : {'request':'responsibility_grid','employee_id':jQuery('#employee_id').val()},
                 success  : function(response){
                    jQuery("#ResponsibilityGrid").html(response); 
                 },
                  complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'responsibility','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Responsibility-tab').css('color','red');
                                 }else{
                                     jQuery('#Responsibility-tab').css('color','black');
                                 }
                            }
                        });
                        }
             });

        };
        
  });
</script>