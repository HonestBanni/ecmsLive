

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Department</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Total Experience</th>
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
            <td><?php echo $row->exp_emp_department?></td>
            <td><?php echo date('d-M-Y',strtotime($row->exp_from))?></td>
            <td><?php echo date('d-M-Y',strtotime($row->exp_to))?></td>
            <td><?php echo $row->exp_total?></td>
            <td><?php echo $row->exp_emp_remarks?></td>
            <td>
                <button id="<?php echo $row->exp_id?>"  class="btn btn-primary btn-sm EditExperienc">Edit</button>
                <button id="<?php echo $row->exp_id?>"  class="btn btn-danger btn-sm DeleteExperienc">Delete</button>
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>

<script>
  jQuery(document).ready(function(){
      jQuery('.DeleteExperienc').on('click',function(){
            if (!confirm("Are you sure to delete this..?")){ return false;} 
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                data     : {'request':'experienc_delete','experienc_id':jQuery(this).attr('id')},
                success  : function(response){
                   Experience_Grid();
                }
            });

        });
      jQuery('.EditExperienc').on('click',function(){
         
          jQuery('#updateExperience').show();
          jQuery('#saveExperience').hide();
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                dataType : 'json',
                data     : {'request':'experienc_update','experienc_id':jQuery(this).attr('id')},
                success  : function(response){
                $('.experience_id').val(response['exp_id']);
                $('input:text[name=Department]').val(response['exp_emp_department']);
                $('.exp_remarks').val(response['exp_emp_remarks']);
                  
                    var exp_from = response['exp_from'];
                    var sp_exp_from = exp_from.split("-");
                $('#from_exp_year').val(Number(sp_exp_from[0]).toString()); 
                $('#from_exp_month').val(Number(sp_exp_from[1]).toString()); 
                $('#from_exp_day').val(sp_exp_from[2]); 
                  
                    var exp_to = response['exp_to'];
                    var sp_exp_to = exp_to.split("-");
                $('#to_exp_year').val(Number(sp_exp_to[0]).toString()); 
                $('#to_exp_month').val(Number(sp_exp_to[1]).toString()); 
                $('#to_exp_day').val(sp_exp_to[2]); 
//                  
                  
                }
            });

        });
        
          function Experience_Grid(){
                     
                    var emp_edu_id = jQuery('#emp_edu_id').val();
                    
                    if(emp_edu_id == ''){
                        jQuery('#updateExperience').hide();
                        jQuery('#saveExperience').show();
                    }else{
                       jQuery('#updateExperience').show();
                       jQuery('#saveExperience').hide(); 
                    }
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'experience_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#ExperienceGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'experience','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Experience-tab').css('color','red');
                                 }else{
                                     jQuery('#Experience-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
        
  });
</script>