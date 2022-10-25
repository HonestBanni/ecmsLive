<div class="content container">
    <h2 align="left">Student Practical Groups Inter Level<span  style="float:right"><a href="AttendanceController/add_prac_group_1st" class="btn btn-large btn-primary">Add New Student</a></span><hr></h2>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <article class="contact-form col-md-12 col-sm-7">   
                    <form method="post">
                        <div class="form-group col-md-2">
                            <input type="text" name="college_no" value="<?php if($college_no): echo $college_no; endif;?>"  placeholder="College No." class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="student_name" value="<?php if($student_name): echo $student_name; endif;?>"  placeholder="Student Name" class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                        <?php
                        if(!empty($group_id)){
                            $secres = $this->AttendanceModel->get_by_id('practical_group',array('prac_group_id'=>$group_id));
                            foreach($secres as $secrec){ 
                        ?>          
                            <input type="text" name="group_id" value="<?php echo $secrec->group_name; ?>" placeholder="Section" class="form-control" id="pracGroupName">
                            <input type="hidden" name="group_id" id="group_id" value="<?php echo $secrec->prac_group_id; ?>">      
                        <?php }     
                        }else{?>
                            <input type="text" name="group_id" class="form-control" placeholder="Group Name" id="pracGroupName">
                            <input type="hidden" name="group_id" id="group_id">
                        <?php } ?>     
                        </div>        
                        <div class="form-group col-md-6"> 
                            <input type="submit" name="search" class="btn btn-theme" value="Search">
                            <input type="submit" name="export" class="btn btn-theme" value="Export">
                        </div>    
                    </form>
                    
                    <?php if(@$result):?> 
                    <p>
                        <button type="button" class="btn btn-success">
                            <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
                        </button>
                    </p>
                    <table class="table table-boxed table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>College #</th>
                                <th>Student Name</th>
                                <th>Group Name</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        <?php 
                            $s =1;
                            foreach($result as $pRow):    
                        ?>    
                        <tr>
                            <td><?php echo $s;?></td>
                            <td><?php echo $pRow->college_no;?></td>
                            <td><?php echo $pRow->student_name;?></td>
                            <td><?php echo $pRow->group_name;?></td>
                            <td><a class="btn btn-theme btn-sm" href="AttendanceController/update_prac_group_1st/<?php echo $pRow->serial_no;?>">Update</a></td>
                            <td><a class="btn btn-danger btn-sm" href="AttendanceController/delete_prac_group_1st/<?php echo $pRow->serial_no;?>">Delete</a></td>
                        </tr>
                        <?php 
                            $s++;
                            endforeach;
                        ?>    
                        </thead>
                        <tbody></tbody>
                    </table>
                    <?php endif; ?>
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
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
    
    });
</script>