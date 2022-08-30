 <script>
function myFunction() {
    alert("You have inserted Student Id: <?php echo $this->uri->segment(3);?>");
}
</script>
<?php
   $degree_id = $result->degree_id;
   $inst_id = $result->inst_id;
   $bu_id = $result->bu_id;
   $grade_id = $result->grade_id;
    $serial_no = $result->serial_no;
?>
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Alumni Academic Record<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AdminDeptController/update_alumni_academic/<?php echo $serial_no;?>">
                <input type="hidden" value="<?php echo $serial_no;?>" name="student_id"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">Degree / Certificate:</label>
                   <select type="text" name="degree_id" class="form-control" required>
                         <?php
                        $gres = $this->AdminModel->get_by_id('degree',array('degree_id'=>$degree_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->degree_id;?>"><?php echo $grec->title;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value=""></option>';
                                }    
                            ?>
                        <option value="">&larr; Select &rarr;</option>
                            <?php
                            $b = $this->db->query("SELECT * FROM degree");
                            foreach($b->result() as $brec)
                            {
                            ?>
                                <option value="<?php echo $brec->degree_id;?>"><?php echo $brec->title;?></option>
                            <?php 
                           }
                            ?>
                    </select>    
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Institute:</label>
        <input type="text" name="inst_id" value="<?php echo $inst_id;?>" class="form-control">   
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Board / University:</label>
                 
                <select type="text" name="bu_id" class="form-control">
                         <?php
                        $gres = $this->AdminModel->get_by_id('board_university',array('bu_id'=>$bu_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->bu_id;?>"><?php echo $grec->title;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value=""></option>';
                                }    
                            ?>
                        <option value="">&larr; Select &rarr;</option>
                            <?php
                            $b = $this->db->query("SELECT * FROM board_university");
                            foreach($b->result() as $brec)
                            {
                            ?>
                                <option value="<?php echo $brec->bu_id;?>"><?php echo $brec->title;?></option>
                            <?php 
                           }
                            ?>
                    </select>  
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Roll No.:</label>
                  <input type="text" name="rollno" value="<?php echo $result->rollno;?>" class="form-control"> 
              </div>
                <div class="form-group col-md-4">
                  <label for="usr">Year of Passing:</label>
                  <input type="text" name="year_of_passing" value="<?php echo $result->year_of_passing;?>" class="form-control"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Total Marks:</label>
                  <input type="text" name="total_marks" value="<?php echo $result->total_marks;?>" class="form-control"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Obtained Marks:</label>
                  <input type="text" name="obtained_marks" value="<?php echo $result->obtained_marks;?>" class="form-control"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">CGPA:</label>
                  <input type="text" name="cgpa" value="<?php echo $result->cgpa;?>" class="form-control"> 
              </div> 
              <div class="form-group col-md-4">
                  <label for="usr">Grade:</label>
                <select type="text" name="grade_id" class="form-control">
                         <?php
                        $gres = $this->AdminModel->get_by_id('grade',array('grade_id'=>$grade_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->grade_id;?>"><?php echo $grec->grade_name;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value=""></option>';
                                }    
                            ?>
                        <option value="">&larr; Select &rarr;</option>
                            <?php
                            $b = $this->db->query("SELECT * FROM grade");
                            foreach($b->result() as $brec)
                            {
                            ?>
                                <option value="<?php echo $brec->grade_id;?>"><?php echo $brec->grade_name;?></option>
                            <?php 
                           }
                            ?>
                    </select> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Exam Type:</label>
                <select name="exam_type" class="form-control">
                    <option value="<?php echo $result->exam_type;?>"><?php echo $result->exam_type;?></option>
                    <option value="">Exam Type</option>
                    <option value="annual">Annual</option>
                    <option value="Supply">Supply</option>
                </select>
              </div>
          </div>
         <div class="form-group">
                    <input style="margin-left:30px;" type="submit" class="btn btn-theme" name="submit" value="Update Record">
              </div> 
        </div>            
                </form>
                      
                        </div>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->