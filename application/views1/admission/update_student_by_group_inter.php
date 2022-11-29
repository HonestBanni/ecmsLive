<?php
 $section_id = $result->section_id;
   $student_id = $result->student_id;
   $sub_pro_id = $result->sub_pro_id;
   $serial_no = $result->serial_no;
?>
<div class="content container">
            <h2 align="left">Update Student by Group<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="admin/update_student_by_group_inter/<?php echo $serial_no;?>">
                <input type="hidden" value="<?php echo $serial_no;?>" name="serial_no"> 
                <input type="hidden" value="<?php echo $student_id;?>" name="student_id"> 
                <input type="hidden" value="<?php echo $sub_pro_id;?>" name="sub_pro_id"> 
                <input type="hidden" value="<?php echo $section_id;?>" name="old_section_id">
            <div class="row">
            <div class="col-md-12">
              <div class="form-group col-md-4">
                  
                  <label for="usr">Student:</label>
                  <?php
                  $gres = $this->get_model->get_by_id('student_record',array('student_id'=>$student_id));
                            if($gres){
                                foreach($gres as $grec){ ?>
                    <input type="text" name="student_name" value="<?php echo $grec->student_name;?>" class="form-control"> 
                 <?php 
                        }     
                    }else{
                echo '<input type="text" value="" class="form-control">';
                        }    
                    ?> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Section:</label>
                 
                <select type="text" name="section_id" class="form-control">
                         <?php
                        $gres = $this->get_model->get_by_id('sections',array('sec_id'=>$section_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->sec_id;?>"><?php echo $grec->name;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value="" class="form-control"></option>';
                                }    
                            ?>
                        <option value="">&larr; Assign Section &rarr;</option>
                            <?php
                            $b = $this->db->query("SELECT * FROM sections WHERE program_id=1 AND status LIKE 'On'");
                            foreach($b->result() as $brec)
                            {
                            ?>
                                <option value="<?php echo $brec->sec_id;?>"><?php echo $brec->name;?></option>
                            <?php 
                           }
                            ?>
                    </select>  
              </div>
         <div class="form-group col-md-8">
                    <input type="submit" class="btn btn-theme" name="submit" value="Update Group">
              </div> 
        </div>            
                </form>
                      
                        </div>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->