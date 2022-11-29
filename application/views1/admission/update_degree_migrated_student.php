<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Student Status<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;">
            <?php print_r($this->session->flashdata('insert_msg'));?>
        </h4>
        <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
        </h4>
									</div>
<br />
<form method="post">
    <div class="form-group col-md-3">
        <label>Student Name:</label>
            <?php        
                $student_id = $result->student_id;
                $bu_id = $result->migrated_board;
                if(!empty($student_id)){
                    $empres = $this->get_model->get_by_id('student_record',array('student_id'=>$student_id));
                    foreach($empres as $emprec)
                    { ?>          
        <input type="text" name="student_id" value="<?php echo $emprec->student_name; ?>" placeholder="Student Name" class="form-control" id="std_namess">
                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $emprec->student_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="student_id" class="form-control" placeholder="Student Name" id="std_namess">
        <input type="hidden" name="student_id" id="student_id">
                    <?php
                    }    
                ?>                  
            </div>
    <div class="form-group col-md-6">
        <label>Migrated Institute</label>
       <input type="text" name="migrated_institute" value="<?php echo $result->migrated_institute;?>" class="form-control" placeholder="Migrated Institute Name">
   </div>
    <div class="form-group col-md-3">
        <label>Board Name:</label>
            <?php        
                $bu_id = $result->migrated_board;
                if(!empty($bu_id)){
                    $empre = $this->get_model->get_by_id('board_university',array('bu_id'=>$bu_id));
                    foreach($empre as $empre)
                    { ?>          
        <input type="text" name="bu_id" value="<?php echo $empre->title; ?>" placeholder="Board Name" class="form-control" id="bu">
                    <input type="hidden" name="bu_id" id="bu_id" value="<?php echo $empre->bu_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="bu_id" class="form-control" placeholder="Board Name" id="bu">
        <input type="hidden" name="bu_id" id="bu_id">
                    <?php
                    }    
                ?>                  
            </div> 
    <div class="form-group col-md-3">
        <label>Migration Date</label>
        <?php 
        $date1 = date('d-m-Y', strtotime($result->migration_date));?>
        <input type="text" name="migration_date" value="<?php echo $date1;?>" class="form-control date_format_d_m_yy">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Student Status:</label>
        <select name="s_status_id" class="form-control">
    <option value="<?php echo $result->s_status_id;?>"><?php echo $result->name;?></option>
    <option value="">Select Status</option>
            <?php 
         $f = $this->db->query("SELECT * FROM student_status");
         foreach($f->result() as $row):
         ?>
            <option value="<?php echo $row->s_status_id;?>"><?php echo $row->name;?></option>
         <?php
         endforeach;
         ?>
        </select> 
   </div>
    <div class="form-group col-md-4">
        <input type="submit" style="margin-top:23px;" class="btn btn-theme" name="submit" value="Update Record">
    </div>
    
    </form>
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           