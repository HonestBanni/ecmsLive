			 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
<?php
        
    $emp_edu_id = $result->emp_edu_id;    
    $emp_id = $result->emp_id;    
    $bu_id = $result->bu_id;
    $degree_id = $result->degree_id;
    $passing_year = $result->passing_year;
    $cgpa = $result->cgpa;
    $div_id = $result->div_id;
    $hec_status = $result->hec_verified;
    $gres = $this->HrModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id)); 
    foreach($gres as $grec);        
?>
<h2 align="left">Update Employee Academic ( <?php echo $grec->emp_name; ?> )<hr></h2>
    <div class="col-md-12">
    <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 

                        </div>
                        <br />
<form method="post" enctype="multipart/form-data" action="">    
 <div class="control-group col-md-4">
    <label>Degree / Certificate</label>
    <?php
$gres = $this->HrModel->get_by_id('degree',array('degree_id'=>$degree_id));
    if($gres){
        foreach($gres as $grec){ ?>  
    <input type="text" name="degree_id" class="form-control" value="<?php echo $grec->title;?>" id="degree" required>
    <input type="hidden" name="degree_id" value="<?php echo $grec->degree_id;?>" id="degree_id">
     <?php 
        }     
    }else{  
    ?>
    <input type="text" name="degree_id" class="form-control" placeholder="Type Degree" id="degree" required>
           	 <input type="hidden" name="degree_id" id="degree_id">
    <?php 
    }
    ?> 
<input type="hidden" value="<?php echo $result->emp_edu_id;?>" name="emp_edu_id">
<input type="hidden" value="<?php echo $emp_id;?>" name="emp_id">
        
                        </div>
                    <div class="control-group col-md-4">
                        <label>Board/University</label>
    <?php
$gres = $this->HrModel->get_by_id('board_university',array('bu_id'=>$bu_id));
    if($gres){
        foreach($gres as $grec){ ?>   
    <input type="text" name="bu_id" value="<?php echo $grec->title;?>" class="form-control" placeholder="Type University" id="bord_univty">
    <input type="hidden" name="bu_id" value="<?php echo $grec->bu_id;?>" id="bord_univty_id">
     <?php 
        }     
    }else{
?>
    <input type="text" name="bu_id" class="form-control" placeholder="Type University" id="bord_univty">
        <input type="hidden" name="bu_id" id="bord_univty_id">
    <?php
        }    
    ?>
                        </div>
                    <div class="control-group col-md-4">
                        <label>Year of Passing</label>
            <input type="text" name="passing_year" value="<?php echo $passing_year;?>" class="form-control">
                    </div>
                    <div class="control-group col-md-4">
                        <label>CGPA</label>
            <input type="text" name="cgpa" value="<?php echo $cgpa;?>" data-original-title="" class="form-control">
            </div>
                    <div class="control-group col-md-4">
                        <label>Division</label>
               <select type="text" class="form-control" name="div_id">
    <?php
$gres = $this->HrModel->get_by_id('hr_emp_division',array('devision_id'=>$div_id));
    if($gres){
        foreach($gres as $grec){ ?>                   
<option type="text" value="<?php echo $grec->devision_id;?>"><?php echo $grec->name;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option> Select Division </option>
    <?php
    $g = $this->db->query("SELECT * FROM hr_emp_division");
    foreach($g->result() as $grec)
    {
    ?>
    <option value="<?php echo $grec->devision_id;?>"><?php echo $grec->name;?></option>
    <?php 
    }
    ?>
</select>            
           </div>
    <div class="form-group col-md-4">
          <label for="usr">HEC Verified:</label>
          <select name="hec_verified" class="form-control">
              <?php if($hec_status):?>
              <option value="<?php echo $hec_status;?>"><?php echo $hec_status;?></option>
              <?php endif;?>
                <option value="">Hec Verified Status</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
          </select>    
      </div> 
                    <div class="control-group col-md-4">
                            <input type="submit" name="submit" value="Update Record" class="btn btn-primary">
                    </div>
                </form>  
							 </div><!--//col-md-3-->
                
           
