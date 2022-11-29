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
            <div class="row cols-wrapper">
            <div class="col-md-12">
                   
                    <form method="post">
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
        echo form_dropdown('gender_id', $gender, $gender_id,  'class="form-control" id="my_id"');
                          ?>
                      </div>
                <div class="form-group col-md-2">
                    <?php
                     echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'class="form-control" id="my_id"');
                    ?>
                      </div>
            <div class="form-group col-md-2">
                <?php 
                echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="my_id"');
                ?>
              </div>      
                        <div class="form-group col-md-2">
                          <?php
             echo form_dropdown('rseats_id', $reserved_seat, $rseats_id,  'class="form-control" id="my_id"');                
                            ?>
                      </div>
                    <div class="form-group col-md-2">
                          <?php
             echo form_dropdown('s_status_id', $status, $s_status_id,  'class="form-control" id="my_id"');                
                            ?>
                      </div>
            <input type="submit" name="search" class="btn btn-theme" value="Search">
            <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>            
        </form>
                </div>    
                <div id="div_print">
                    <h3 align="center">BS-Law Students Record<hr></h3>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Student</th>
                            <th>Form #</th>
                            <th>College #</th>
                            <th>Semester</th>
                            <th>Batch</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$i = 1;
foreach($result as $rec)  
    {
        $student_id = $rec->student_id;
        $student_name = $rec->student_name;
        $father_name = $rec->father_name;
        $applicant_image = $rec->applicant_image;         
        $section = $rec->section;                            
        ?>
                        <tr class="gradeA">
                    <td><?php echo $i;?></td>
                    <td><?php echo $student_name;?></td>
                    <td><?php echo $rec->form_no;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><span class="label label-theme"><?php echo $rec->status;?></span></td>

                            
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
           