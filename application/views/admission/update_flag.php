<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
    
.blink_text { 

        -webkit-animation-name: blinker;
 -webkit-animation-duration: 1s;
 -webkit-animation-timing-function: linear;
 -webkit-animation-iteration-count: infinite;

 -moz-animation-name: blinker;
 -moz-animation-duration: 1s;
 -moz-animation-timing-function: linear;
 -moz-animation-iteration-count: infinite;
 animation-name: blinker;
 animation-duration: 2s;
 animation-timing-function: linear; 
    animation-iteration-count: infinite; color: red; 
} 

@-moz-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
} 

@keyframes blinker {  
    0% { opacity: 1.0; } 
    50% { opacity: 0.0; }      
    100% { opacity: 1.0; } 
} 
</style> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="center">Admin Student Flag Change<hr></h3>
        <div class="row cols-wrapper">
        <div class="col-md-12">
             <?php
            $applicant_image = $result->applicant_image;
                    if($applicant_image == "")
                    {?>
                    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="60">
                    <?php
                    }else
                    {?>
    <img style="float:right; border-radius:5px;" src="<?php echo base_url();?>assets/images/students/<?php echo $applicant_image;?>" width="60" height="60">
                <?php 
                    }
                    ?>
            <h4 align="center">Student: <?php echo $result->student_name;?> S/D of <?php echo $result->father_name;?></h4>
        </div>
    </div><br>
            <div class="row cols-wrapper">
            <form name="student_status" method="post"> 
                <div class="col-md-12">              
        <div class="form-group col-md-3">
            <label>Batch Name:</label>
            <input type="text" value="<?php echo $result->batch_name;?>" class="form-control">
            <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>">
        </div> 
        <div class="form-group col-md-3">
            <label>Program:</label>
            <input type="text" value="<?php echo $result->programe_name;?>" class="form-control">
        </div> 
        <div class="form-group col-md-3">
            <label>Sub Program:</label>
            <input type="text" value="<?php echo $result->name;?>" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>College No:</label>
            <input type="text" value="<?php echo $result->college_no;?>" class="form-control">
        </div> 
        <div class="form-group col-md-3">
            <label>Flag Status:</label>
            <select class="form-control" name="flag">
        <option value="<?php echo $result->flag;?>"><?php echo $result->flag;?></option>
                <option value="">-- Select Status --</option>
               <option value="1">1</option>
               <option value="0">0</option>
            </select>
        </div>                     
        <div class="form-group col-md-2">            
            <input style="margin-top:23px;" type="submit" class="btn btn-theme" name="submit" value="Update Status">
        </div>    
                        </div>
                       
                    </form> 
                <br>
        <?php  
            $flag = $result->flag;    
            if($flag == 1):
            if(@$result_flag):    
        ?>
    <div class="col-md-12" style="margin:20px 0px;">
        <strong style="font-size:16px;color:red; margin:20px 0px;" class="blink_text">
            First Delete Allotted Group in case of changing Flag Status= '0'
        </strong>
    </div>
                <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Student Name</th>
                            <th>Section</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $i = 1;
                    foreach($result_flag as $rec)  
                    {
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $i?></td>
                            <td><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->name;?></td>
                            <td><a href="admin/delete_group_of_flag/<?php echo $rec->serial_no;?>/<?php echo $rec->student_id;?>" 
                            onclick="return confirm('Are You Sure to Delete This..?')" class="btn btn-danger btn-sm"> Delete</a></td>
                        </tr>

                        <?php
    $i++;

}
                        ?>


                    </tbody>
                </table>
        <?php        
            endif;
            endif;
        ?>
               
</div><!--/.span9-->
</div>