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
                  <div class="form-group col-md-12">
                    <label for="usr">Author Name:</label>
                      <input class="form-control" type="text" name="author">
                    <input type="hidden" value="<?php echo $result->emp_id;?>" name="emp_id"> 
                  </div>
                  <div class="form-group col-md-12">
                    <label for="usr">Paper Title:</label>
                      <input class="form-control" type="text" name="title">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Journal:</label>
                      <input class="form-control" type="text" name="journal">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Volume:</label>
                      <input class="form-control" type="text" name="volume">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Pages:</label>
                      <input class="form-control" type="text" name="pages">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Date:</label>
                      <input class="form-control date_format_d_m_yy" type="text" name="date">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Year:</label>
                      <input class="form-control" type="text" name="year">
                  </div>
                    <div class="form-group col-md-3">
                    <label for="usr">ISSN:</label>
                      <input class="form-control" type="text" name="issn">
                  </div>
                <div class="form-group col-md-6">
                    <label for="usr">Remarks:</label>
                      <input class="form-control" type="text" name="remarks">
                  </div> 
                <div class="form-group col-md-3">
                    <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Add Research Paper">              </div>     
                </div>
                <div class="form-group col-md-9">
                    <span>If Research Papers Detail Completed Then Click on Done Button, Thanks... <a href="HrController/employee_reocrd" class="btn btn-theme">Done</a></span>
                </div>
                </div>
                    </form>
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Author Name</th>
                            <th>Title</th>
                            <th>Journal</th>
                            <th>Date</th>
                             <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($research):
                      //  echo '<pre>';print_r($research);die;
                        foreach($research as $empRow):
                            $date = $empRow->date;
                            $newDate = date("d-m-Y", strtotime($date));
                           echo '<tr>';
                                echo '<td>'.$empRow->author.'</td>';
                                echo '<td>'.$empRow->title.'</td>';
                                echo '<td>'.$empRow->journal.'</td>';
                                echo '<td>'.$newDate.'</td>';
                                echo '<td>'.$empRow->year.'</td>';
                           echo '</tr>';
                        
                        endforeach;
                        
                        endif;
     
                        ?>


                    </tbody>
                </table>
                </div>
                
</div><!--/.container-->
</div><!--/.wrapper-->