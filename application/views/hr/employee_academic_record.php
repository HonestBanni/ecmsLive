<script>
function myFunction() {
    alert("You have inserted Employee Id: <?php echo $this->uri->segment(3);?>");
}
</script>
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Employee Academic Record<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>HrController/employee_academic_record/<?php echo $emp_id;?>">
                <input type="hidden" value="<?php echo $emp_id;?>" name="emp_id"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">Degree / Certificate:</label>
                  <input type="text" name="degree_id" class="form-control" placeholder="Type Degree" id="degree" required>
           	 <input type="hidden" name="degree_id" id="degree_id">
                   <?php 
               // echo form_dropdown('degree_id', $degree, '',  'class="form-control" id="my_id"');
                    ?>    
              </div>
              
              <div class="form-group col-md-4">
                  <label for="usr">Board / University:</label>
                  <input type="text" name="bu_id" class="form-control" placeholder="Type University" id="bu">
           		<input type="hidden" name="bu_id" id="bu_id">
                  <?php 
  //  echo form_dropdown('bu_id', $board_university, '',  'class="form-control" id="my_id"');
                ?> 
              </div>
                <div class="form-group col-md-4">
                  <label for="usr">Year of Passing:</label>
                  <input type="text" name="passing_year" class="form-control"> 
              </div>
                <div class="form-group col-md-4">
                  <label for="usr">CGPA:</label>
                  <input type="text" name="cgpa" class="form-control"> 
              </div>
                <div class="form-group col-md-4">
                  <label for="usr">Division</label>
                  <?php 
   echo form_dropdown('div_id', $division, '',  'class="form-control" id="my_id"');
                ?> 
              </div>
            <div class="form-group col-md-4">
                  <label for="usr">HEC Verified:</label>
                  <select name="hec_verified" class="form-control">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                  </select>    
              </div>    
          </div>
         <div class="form-group">
                    <input style="margin-left:30px;" type="submit" class="btn btn-theme" name="submit" value="Add Record">
              </div> 
        </div>            
                </form>
                <br><p>If Academic Details Completed Then Click on Done Button, Thanks... <a style="float:right; margin-right:550px;" href="<?php echo base_url();?>HrController/employee_reocrd" onclick="myFunction()" class="btn btn-theme">Done</a></p><br>    
            <br>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Degree</th>
                            <th>Board/University</th>
                             <th>Passing Year</th>
                             <th>CGPA</th>
                            <th>Division</th>
                            <th>HEC Ver.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        //echo '<pre>';print_r($employee_records);die;
                        if($employee_records):
                        foreach($employee_records as $empRow):
                        
                           echo '<tr>';
                                echo '<td>'.$empRow->emp_name.'</td>';
                                echo '<td>'.$empRow->Degreetitle.'</td>';
                                echo '<td>'.$empRow->bordTitle.'</td>';
                                echo '<td>'.$empRow->passing_year.'</td>';
                                echo '<td>'.$empRow->cgpa.'</td>';
                                echo '<td>'.$empRow->divisiontitle.'</td>';
                                echo '<td>'.$empRow->hec_verified.'</td>';
                           echo '</tr>';
                        
                        endforeach;
                        
                        endif;
     
                        ?>


                    </tbody>
                </table>
							      
                        </div>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
		