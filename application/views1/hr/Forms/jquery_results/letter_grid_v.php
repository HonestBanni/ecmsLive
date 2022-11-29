

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Letter#</th>
            <th>Letter Date</th>
            <th>Date From</th>
            <th>Date To</th>
            <th>Designation</th>
            <th>Scale</th>
            <th>Contract Type</th>
            <th>Details</th>
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
            <td><?php echo $row->c_renwal_letter_no?></td>
            <td><?php echo $this->CRUDModel->date_convert($row->c_renwal_contract_date)?></td>
            <td><?php echo $this->CRUDModel->date_convert($row->c_renwal_from_date)?></td>
            <td><?php echo $this->CRUDModel->date_convert($row->c_renwal_to_date)?></td>
            <td>[ <?php echo $row->emp_desg_code?> ]<?php echo $row->emp_desg_name?></td>
            <td><?php echo $row->scale_name?></td>
            <td><?php echo $row->contract_status_title?></td>
            <td><?php echo $row->c_renwal_details?></td>
            <td><?php echo $row->c_renwal_remarks?></td>
            <td>
                <button id="<?php echo $row->contract_id?>"  class="btn btn-primary btn-sm EditLetter">Edit</button>
                <button id="<?php echo $row->contract_id?>"  class="btn btn-danger btn-sm DeleteLetter">Delete</button>
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>

<script>
  jQuery(document).ready(function(){
      jQuery('.DeleteLetter').on('click',function(){
            if (!confirm("Are you sure to delete this..?")){ return false;} 
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                data     : {'request':'letter_delete','letter_id':jQuery(this).attr('id')},
                success  : function(response){
                   Letter_Grid();
                }
            });

        });
    
      jQuery('.EditLetter').on('click',function(){
         
          jQuery('#updateLetter').show();
          jQuery('#saveLetter').hide();
//         jQuery('.DeleteFile').show();
          jQuery('.image_div').show();
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                dataType : 'json',
                data     : {'request':'letter_update','letter_id':jQuery(this).attr('id')},
                success  : function(response){
                $('.Letter_id').val(response['contract_id']);
                $('input:text[name=c_renwal_letter_no]').val(response['c_renwal_letter_no']);
                
                    var exp_from = response['c_renwal_contract_date'];
                    var sp_exp_from = exp_from.split("-");
                $('#letter_year').val(Number(sp_exp_from[0]).toString()); 
                $('#letter_month').val(Number(sp_exp_from[1]).toString()); 
                $('#letter_day').val(sp_exp_from[2]);
                
                    var exp_from = response['c_renwal_from_date'];
                    var sp_exp_from = exp_from.split("-");
                $('#c_f_year').val(Number(sp_exp_from[0]).toString()); 
                $('#c_f_month').val(Number(sp_exp_from[1]).toString()); 
                $('#c_f_day').val(sp_exp_from[2]);
                               
                    var exp_from = response['c_renwal_to_date'];
                    var sp_exp_from = exp_from.split("-");
                $('#c_t_year').val(Number(sp_exp_from[0]).toString()); 
                $('#c_t_month').val(Number(sp_exp_from[1]).toString()); 
                $('#c_t_day').val(sp_exp_from[2]);
                
                $('#ltr_category_id').val(response['c_renwal_category_id']);
                $('#ltr_category_type_id').val(response['c_renwal_category_type_id']);
                $('#ltr_designation_id').val(response['c_renewal_designation_id']);
                $('#scale_id').val(response['c_renwal_scale']);
                $('#contract_status').val(response['c_renewal_contract_status_id']);
                $('#renewal_details').val(response['c_renwal_details']);
                $('#renewal_remarks').val(response['c_renwal_remarks']);
                $('.old_image').val(response['c_renwal_image']);
               
               if(response['c_renwal_image'] != ''){
                    var img = document.createElement("img");
                    img.src = 'assets/images/employee/contract_files/'+response['c_renwal_image'];
                    img.style = 'max-height: 800px; max-width: 500px; border:1px solid #333';
                    $('#image').html(img);
                    }else{
                      jQuery('.image_div').hide() 
                    }
               
                       
               }
            });

        });
         function Letter_Grid(){
                    
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'letter_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#LetterGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'letter','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Letter-tab').css('color','red');
                                 }else{
                                     jQuery('#Letter-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
        
  });
</script>