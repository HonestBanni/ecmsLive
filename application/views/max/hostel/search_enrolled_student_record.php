<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script> 
        <div class="content container">
               <!-- ******BANNER****** -->
   <h3 align="left">All Students Record <hr></h3>          
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
    <form method="post" action="HostelController/search_enrolled_student">
            <div class="form-group col-md-2">
                <input type="text" name="college_no"  placeholder="College No." value="<?php if($college_no): echo $college_no;endif; ?>" class="form-control">
          </div>
            <div class="form-group col-md-2">
                <input type="text" name="form_no" value="<?php if($form_no): echo $form_no;endif; ?>"  placeholder="Form No." class="form-control">
          </div>
            <div class="form-group col-md-2">
                <input type="text" name="student_name" value="<?php if($student_name): echo $student_name;endif; ?>"  placeholder="Student Name" class="form-control">
          </div>
            <div class="form-group col-md-2">
                <input type="text" name="father_name" value="<?php if($father_name): echo $father_name;endif; ?>" placeholder="Father Name" class="form-control">
          </div>
        
          
        <div class="form-group col-md-2">
                <?php 
                    echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="feeProgrameId"');
                ?>
            </div>

            <div class="form-group col-md-2">
                <?php 
                    echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                ?>
          </div>  

            <div class="form-group col-md-2">
                <?php  
                    echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="batch_id"');
                ?>
          </div>

        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('section', $section,$sectionId,  'class="form-control section" id="showSections"');    
             ?>
            </div>
            
                    <div class="form-group col-md-2">
                        <?php 
                            echo form_dropdown('shift', $shift,$shft_id,  'class="form-control"');    
                         ?>
                    </div>
                   
        <div class="form-group col-md-2">
                <?php 
                    echo form_dropdown('gender_id', $gender, $gender_id,  'class="form-control" id="my_id"');
              ?>
          </div> 
<!--    <div class="form-group col-md-2">
        <?php 
        //echo form_dropdown('status', $status, $statusId,  'class="form-control" id="my_id"');
        ?>
      </div>-->
      
        <div class="form-group col-md-2">        
            
            <?php 
                echo form_dropdown('admission_in', $seat, $seat_id,  'class="form-control"');    
             ?>
            
          </div>
        
        <div class="form-group col-md-2" style="float:right;">
        
                        <input type="submit" name="search" class="btn btn-theme" value="Search">       
    </div> 
    </form>
                    </div>
         <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
                <div id="div_print">
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Picture</th>
                            <th>Student Name</th>
                            <th>F-Name</th>
                            <th>Form #</th>
                            <th>College No.</th>
                            <th>Program</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Section</th>
                            <!--<th>Status</th>-->
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
                        $i = 1;
foreach($result as $rec)  
{
    $student_id = $rec->student_id;
    $applicant_image = $rec->applicant_image;         
        $section = $rec->section;                           
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $i;?></td>
                            <td>
                            <?php
                    if($applicant_image == "")
                 {?>
        <img src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="40">
                    <?php
                    }else
                    {?>
  <img src="<?php echo base_url();?>assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="40">
                <?php 
                   }
                    ?>
</td>
<td><span style="font-size:15px;"><a href="admin/student_profile/<?php echo $student_id;?>"><?php echo $rec->student_name;?></a></span></td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->form_no;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->program;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php 
                    if($section == '')
                    {
                        echo '';
                    }else
                    {?>
                    <?php echo $section;?>   
                <?php 
                    }
                    ?></td>
        <!--<td><span class="label label-success"><?php echo $rec->student_status;?></span></td>-->
        <?php 
        $hostel_info = $this->CRUDModel->get_where_row('hostel_student_record', array('student_id' => $rec->student_id));
        if(empty($hostel_info)):
            echo '<td><a class="btn btn-theme btn-sm" href="HostelNewRecordAdminFee/'.$rec->student_id.'"><b>Add Hostel</b></a></td>';
        else:
            echo '<td>Hostel already added</td>';
        endif;
        ?>
                        </tr>
<?php
    $i++;
}
 ?>

                    </tbody>
                </table>
                </div>    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           