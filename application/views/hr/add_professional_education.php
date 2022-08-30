<?php
$emp_id = $result->emp_id;
$emp_name = $result->emp_name;
$father_name = $result->father_name;
$applicant_image = $result->picture;
?>
<div class="content container">
        <div class="row cols-wrapper">
        <div class="col-md-12">
<?php
if($applicant_image == "")
{?>
<img style="float:right; border-radius:10px;" src="assets/images/employee/user.png" width="100" height="100">
<?php
}else
{?>
<img style="float:right; border-radius:10px;" src="assets/images/employee/<?php echo $applicant_image;?>" width="100" height="100">
<?php 
}
?>
    <h4 align="center">Employee: <?php echo $emp_name;?> S/O <?php echo $father_name;?></h4>
        </div>
    </div><hr>
            <div class="row cols-wrapper">
                <form name="student" method="post">
                <div class="col-md-12">
                  <div class="form-group col-md-3">
                    <label for="usr">Title:</label>
                      <input class="form-control" type="text" name="title">
                    <input type="hidden" value="<?php echo $result->emp_id;?>" name="emp_id"> 
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Affiliated Institute:</label>
                      <input class="form-control" type="text" name="aff_institute">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Country:</label>
                      <input type="text" name="country_id" class="form-control" id="country">
                    <input type="hidden" name="country_id" id="country_id">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Date:</label>
                      <input class="form-control date_format_d_m_yy" type="text" name="date">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Duration:</label>
                      <input class="form-control" type="text" name="duration">
                  </div>
                <div class="form-group col-md-6">
                    <label for="usr">Remarks:</label>
                      <input class="form-control" type="text" name="remarks">
                  </div> 
                <div class="form-group col-md-3">
                    <div class="form-group">
            <input type="submit" style="margin-top:23px;" class="btn btn-primary" name="submit" value="Add Professional Education">              </div>     
                </div>
                <div class="form-group col-md-8">
                    <span>If Professional Educations Detail Completed Then Click on Done Button, Thanks... <a href="HrController/employee_reocrd" class="btn btn-theme">Done</a></span>
                </div>
                </div>
                    </form>
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Affiliated Institute</th>
                            <th>Date</th>
                             <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($professionl_edu):
                        foreach($professionl_edu as $prof):
                            $date = $prof->date;
                            $newDate = date("d-m-Y", strtotime($date));
                           echo '<tr>';
                                echo '<td>'.$prof->title.'</td>';
                                echo '<td>'.$prof->aff_institute.'</td>';
                                echo '<td>'.$newDate.'</td>';
                                echo '<td>'.$prof->duration.'</td>';
                           echo '</tr>';
                        
                        endforeach;
                        
                        endif;
     
                        ?>


                    </tbody>
                </table>
                </div>
                
</div><!--/.container-->
</div><!--/.wrapper-->