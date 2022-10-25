        <div class="content container">
               <!-- ******BANNER****** -->
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" action="AttendanceController/update_prac_group_2nd/<?php echo $result->serial_no;?>">       
        <div class="form-group col-md-3">
            <lable>College #</lable>
            <?php if($result->college_no): ?>
        <input type="text" name="college_no" value="<?php echo $result->college_no;?>" class="form-control">
            <?php else:?>
            <input type="text" name="college_no" placeholder="College No." class="form-control">
            <?php endif;?>
        </div>
        <input type="hidden" name="serial_no" value="<?php echo $result->serial_no;?>">
         <div class="form-group col-md-3">
            <lable>Student Name </lable>
            <?php if($result->student_name): ?>
        <input type="text" name="student_name" value="<?php echo $result->student_name;?>" class="form-control">
            <?php else:?>
            <input type="text" name="student_name" placeholder="Student Name" class="form-control">
            <?php endif;?>
        </div>
        <div class="form-group col-md-3">
            <lable>Group Name</lable>
            <input type="text" name="group_id" value="<?php echo $result->group_name;?>" class="form-control" id="pracGroupName">
            <input type="hidden" name="group_id" value="<?php echo $result->prac_group_id;?>" id="group_id">
        </div>
        <div class="form-group col-md-8">
            <input type="submit" class="btn btn-theme" name="submit" value="Update Record">
        </div>
                </form> 
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
           
<script>

    $(document).ready(function(){
        
        $("#pracGroupName").autocomplete({  
            minLength: 0,
            source: "AttendanceController/auto_practicalgroup_2nd/"+$("#pracGroupName").val(),
            autoFocus: true,
            scroll: true,
            dataType: 'jsonp',
            select: function(event, ui){
                $("#pracGroupName").val(ui.item.contactPerson);
                $("#group_id").val(ui.item.prcId);
            }
        }).focus(function() {  $(this).autocomplete("search", "");  }); 
        
    });

</script>