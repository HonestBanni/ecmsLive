<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style>
				 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Assign Arts Subject <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;">
            <?php print_r($this->session->flashdata('insert_msg'));?>
        </h4>
        <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
        </h4>
									</div>

<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/assigning_subject">
    <div class="form-group col-md-3">
            <label for="usr">Student Name</label>
       <input type="text" value="<?php echo $result->student_name;?>" class="form-control"> 
       <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>" class="form-control"> 
   </div>
    <div class="form-group col-md-3">
            <label for="usr">Father Name:</label>
            <input type="text" value="<?php echo $result->father_name;?>" class="form-control"> 
   </div>
    <div class="form-group col-md-3">
            <label for="usr">College No</label>
        <input type="text" value="<?php echo $result->college_no;?>" class="form-control">
    </div>
<!--    <div class="form-group col-md-3">
        <label for="usr">Section:</label>
            <?php
             echo form_dropdown('sec_id', $sectionsName, $sectionsId,  'class="form-control"');
              
            ?>
             
        </div>-->
   <div class="form-group col-md-6"> 
    <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkAll"></th>    
                  <th>Arts Subjects</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                   foreach($subjects as $resRow):
                       
                       if($resRow->subject_id == '59' || $resRow->subject_id == '60' || $resRow->subject_id == '73'):
                           echo '<tr>   
                            <td><input checked="checked" type="checkbox" name="checked[]" value="'.$resRow->subject_id.'" id="checkItem">
                            <input type="hidden" name="subject_id" >
                            </td>
                            <td>'.$resRow->title.'</td>
                        </tr>';
                            else:
                           echo '<tr>   
                            <td><input type="checkbox" name="checked[]" value="'.$resRow->subject_id.'" id="checkItem">
                            <input type="hidden" name="subject_id" >
                            </td>
                            <td>'.$resRow->title.'</td>
                        </tr>';
                       endif;
                    
                   
                  endforeach;
                ?>
                
              </tbody>
            </table>
       
            
    </div>
    <div class="form-group col-md-12">
        <input type="submit" class="btn btn-theme" name="submit" value="Add Record">
    </div>
    </form>
            
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->