

<table class="table table-boxed table-hover">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Program</th>
            <th>Sub Program</th>
            <th>Batch</th>
            <th>Gender</th>
            <th>Shift</th>
            <th>Marks From</th>
            <th>Marks To</th>
            <th>Status</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if($grid):
            $sn = '';
           foreach($grid as $row):
            $sn++;
        ?>
        <tr>
            <td><?php echo $sn?></td>
            <td><?php echo $row->programe_name?></td>
            <td><?php echo $row->sp_title?></td>
            <td><?php echo $row->batch_name?></td>
            <td><?php echo $row->title?></td>
            <td><?php echo $row->name?></td>
            <td><?php echo $row->start?></td>
            <td><?php echo $row->end?></td>
            <td><?php if($row->status =='1'): echo 'Active'; else: echo 'De-active'; endif;?></td>
            <td> 
                <input type="button" id="<?php echo $row->id?>"  class="btn btn-primary btn-sm Edit" value="Edit">
            </td>
        </tr>
        <?php 
        endforeach; 
        
        endif; ?>
    </tbody>
</table>
<script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.EditQuotaBtnzz').on('click',function(){
            });
        });
    
</script>
<script>
  jQuery(document).ready(function(){
      
      jQuery('.Edit').on('click',function(){
          
          jQuery('#update_grid').show();
          jQuery('#save').hide();
            $.ajax({
                type     : "POST",
                url      : 'Fee/Admisson/MertiList/Marks/ChangeShif/Grid',
                dataType : 'json',
                data     : {'request':'edit','edit_id':jQuery(this).attr('id')},
                success  : function(response){
                $('#pk_id').val(response['id']);
                $('#feeProgrameId').val(response['program']);
                $('#showFeeSubPro').val(response['sub_program']);
                $('#batch_id').val(response['batch_id']);
                $('#gender').val(response['gender']);
                $('#shift').val(response['shift']);
                $('#status').val(response['status']);
                $('#start').val(response['start']);
                $('#end').val(response['end']);
                $('#Remarks').val(response['remarks']);
                }
            });

        });
   
        
  });
</script>