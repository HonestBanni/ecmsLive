<?php
   $student_id = $result->student_id;
?>
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Year Head Edit Student<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/year_head_edit_student/<?php echo $student_id;?>">
                <input type="hidden" value="<?php echo $student_id;?>" name="student_id"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-3">
                  <label for="usr">Student:</label>
        <input type="text" value="<?php echo $result->student_name;?>" class="form-control"> 
              </div>
            <div class="form-group col-md-3">
                  <label for="usr">Father Name:</label>
        <input type="text" value="<?php echo $result->father_name;?>" class="form-control"> 
              </div>
            <div class="form-group col-md-3">
                  <label for="usr">College No:</label>
        <input type="text" value="<?php echo $result->college_no;?>" class="form-control"> 
              </div>
      <div class="form-group col-md-3">
          <label for="usr">Section:</label>
        <?php
          $sect = $this->get_model->get_by_id('student_group_allotment',array('student_id'=>$student_id));
                    if($sect){
                        foreach($sect as $srec){ 
                        $sec_id = $srec->section_id;
            $section = $this->db->query("SELECT * FROM sections WHERE sec_id = '$sec_id'");
            foreach($section->result() as $record);                
          ?>
    <input type="text" name="section_id" value="<?php echo $record->name;?>" class="form-control"> 
                 <?php 
                        }     
                    }
                    else
                    {
                        echo '<input type="text" value="" class="form-control">';
                    }    
                    ?> 
      </div>
            <div class="form-group col-md-3">
                <label for="usr">Temporary Status:</label>
                <?php 
                    $status = $result->temporary_yead_head_flag;
                    $statusYes = "";
                    $statusNo = "";
                    if($status == "yes")
                    {
                        $statusYes = "selected='selected'"; 
                        $statusNo = ""; 
                    }else{
                        $statusYes = "";
                        $statusNo = "selected='selected'";
                    }
                ?>
                <select class="form-control" name="temporary_yead_head_flag">
                    <option value="">Select</option>
                    <option <?php echo $statusYes;?> value="yes">Suspended</option>
                    <option <?php echo $statusNo;?> value="no">Restore</option>
                </select> 
              </div>   
            <div class="form-group col-md-9">
                  <label for="usr">Comment:</label>
    <textarea class="form-control notes" name="temporary_yead_head_comment" cols="55" rows="6"><?php echo $result->temporary_yead_head_comment;?></textarea>
              </div>    
         <div class="form-group col-md-8">
                    <input type="submit" class="btn btn-theme" name="submit" value="Update">
              </div> 
        </div>            
                </form>
                      
                        </div>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->