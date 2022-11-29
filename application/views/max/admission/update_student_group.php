<?php
   $section_id = $result->section_id;
   $student_id = $result->student_id;
   $serial_no = $result->serial_no;
?>
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Student by Group<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_student_group/<?php echo $serial_no;?>">
                <input type="hidden" value="<?php echo $serial_no;?>" name="serial_no"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">Student:</label>
                  <?php
                  $gres = $this->get_model->get_by_id('student_record',array('student_id'=>$student_id));
                            if($gres){
                                foreach($gres as $grec){ ?>
                    <input type="text" name="student_id" value="<?php echo $grec->student_name;?>" class="form-control"> 
                         <?php 
                                }     
                            }else{
                        echo '<input type="text" value="" class="form-control">';
                                }    
                            ?> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Section:</label>
                 
                <select type="text" name="section_id" class="form-control"  required="required">
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
                            $b = $this->db->query("SELECT * FROM sections");
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
                    <input type="submit" class="btn btn-theme" name="submit" value="Update Record">
              </div> 
        </div>            
                </form>
                      
                        </div>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->