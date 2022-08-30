 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="center" style="border-bottom:1px solid #ccc;">Add New Group </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
    <form name="student" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AttendanceController/add_practical_group">       
        <div class="form-group col-md-3">
            <lable>Group Name</lable>
           <input type="text" name="group_name" class="form-control">
        </div>
         <div class="form-group col-md-3">
            <lable>Lab Name</lable>
            <select name="lab_id" class="form-control">
                <option value="">Select Lab</option>
                <?php
                    $lab = $this->db->query("SELECT * FROM labs");
                    foreach($lab->result() as $labs){
                ?>
                <option value="<?php echo $labs->lab_id?>"><?php echo $labs->lab_name?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <lable>Subject</lable>
            <select name="subject_id" class="form-control">
                <option value="">Select Subject</option>
                <?php
                    $pract = $this->db->query("SELECT * FROM practical_subject");
                    foreach($pract->result() as $subs){
                ?>
                <option value="<?php echo $subs->prac_subject_id?>"><?php echo $subs->title?></option>
                <?php
                    }
                ?>
            </select>
        </div>             
        <div class="form-group col-md-4">
            <input type="submit" class="btn btn-theme" name="submit" value="Add Record">
        </div>
                        </div>
                    </div>
    </form> 
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->