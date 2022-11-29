

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Degree / Certificate</th>
            <th>Board / University</th>
            <th>Year of Passing</th>
            <th>CPA</th>
            <th>Division</th>
            <th>HEC Verified</th>
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
            <td><?php echo $row->degree_name?></td>
            <td><?php echo $row->bu_title?></td>
            <td><?php echo $row->edu_passing_year?></td>
            <td><?php echo $row->edu_cgpa?></td>
            <td><?php echo $row->division_name?></td>
            <td><?php echo $row->edu_hec_verified?></td>
            <td><?php echo $row->edu_remarks?></td>
            <td>
                <button id="<?php echo $row->emp_edu_id?>"  class="btn btn-primary btn-sm EditAcademic">Edit</button>
                <button id="<?php echo $row->emp_edu_id?>"  class="btn btn-danger btn-sm DeleteAcademic">Delete</button>
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>

<script>
  jQuery(document).ready(function(){
      jQuery('.DeleteAcademic').on('click',function(){
            if (!confirm("Are you sure to delete this..?")){ return false;} 
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                data     : {'request':'academic_delete','academic_id':jQuery(this).attr('id')},
                success  : function(response){
                   Academic_Grid();
                }
            });

        });
      jQuery('.EditAcademic').on('click',function(){
         
          jQuery('#updateAcademic').show();
          jQuery('#saveAcademic').hide();
         
         
            $.ajax({
                type     : "POST",
                url      : 'PersonalInformation',
                dataType : 'json',
                data     : {'request':'academic_update','academic_id':jQuery(this).attr('id')},
                success  : function(response){
                $('.emp_academic_id').val(response['emp_edu_id']);
                $('input:text[name=degree]').val(response['degree_name']);
                $('.degree_id').val(response['degree_id']);
                $('input:text[name=board_university_id]').val(response['bu_id']);
                $('input:text[name=board_university]').val(response['bu_title']);
                $('input:text[name=passing_year]').val(response['edu_passing_year']);
                $('input:text[name=cgpa]').val(response['edu_cgpa']);
                $('#div_id').val(response['edu_div_id']);
                $('#hec_verified').val(response['edu_hec_verified']);
                $('#edu_remarks').val(response['edu_remarks']);
                }
            });

        });
        function Academic_Grid(){
                     
                    $.ajax({
                        type     : "POST",
                        url      : 'PersonalInformation',
                        data     : {'request':'academic_grid','employee_id':jQuery('#employee_id').val()},
                        success  : function(response){
                           jQuery("#AcademicGrid").html(response); 
                        },
                        complete : function(){
                        $.ajax({
                            type     : "POST",
                            url      : 'CheckTab',
                            dataType : 'json',
                            data     : {'request':'academic','employee_id':jQuery('#employee_id').val()},
                            success  : function(check_resp){
                                 if(check_resp == '1'){
                                     jQuery('#Academic-tab').css('color','red');
                                 }else{
                                     jQuery('#Academic-tab').css('color','black');
                                 }
                            }
                        });
                        }
                    });
                     
               };
        
  });
</script>