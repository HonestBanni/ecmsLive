<div class="content container">
    <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
            <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <form method="post">       
                <div class="form-group col-md-3">
                    <lable>College #</lable>
                    <input type="text" name="college_no" placeholder="College No." class="form-control" id="collegeNo">
                </div>
                 <div class="form-group col-md-3">
                    <lable>Student Name </lable>
                    <input type="text" name="student_name" placeholder="Student Name" class="form-control" id="studentName">
                </div>
                <div class="form-group col-md-3">
                    <lable>Group Name</lable>
                    <input type="text" name="group_id" class="form-control" id="pracGroupName">
                    <input type="hidden" name="group_id" id="group_id">
                </div>
                <div class="form-group col-md-8">
                    <input type="submit" class="btn btn-theme" name="submit" value="Add Record">
                </div>
            </form> 
        </div><!--//col-md-3-->
                
    </div><!--//cols-wrapper-->
           
</div><!--//content-->
        
        
<script>

    $(document).ready(function(){
        
        $("#pracGroupName").autocomplete({  
            minLength: 0,
            source: "AttendanceController/auto_practicalgroup_1st/"+$("#pracGroupName").val(),
            autoFocus: true,
            scroll: true,
            dataType: 'jsonp',
            select: function(event, ui){
                $("#pracGroupName").val(ui.item.contactPerson);
                $("#group_id").val(ui.item.prcId);
            }
        }).focus(function() {  $(this).autocomplete("search", "");  }); 
        
        $('#collegeNo').on('change', function(){
            //get sub program
            $.ajax({
                type   : 'post',
                url    : 'AttendanceController/getStudentName',
                data   : { 'college_no' : $('#collegeNo').val() },
                success :function(result){
                    $('#studentName').val(result);
                }
            });
        });
    });

</script>