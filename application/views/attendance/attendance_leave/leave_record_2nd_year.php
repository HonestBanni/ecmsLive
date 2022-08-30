<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <div class="col-md-12 col-sm-12">   
            <h2 align="left">Leave Record (1st Year) 
                <span  style="float:right">
                    <a href="AttendanceController/add_leave_record_first_year" class="btn btn-large btn-primary">Add Leave Record</a>
                </span>
                <hr>
            </h2>
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line">Leave Search Form</span>
                </h1>
                <div class="section-content">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <label for="name">College #</label>
                                <input type="text" name="college_no" value="<?php echo $college_no;?>" class="form-control" placeholder="College #">            
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="name">Application #</label>
                                <input type="text" name="app_no" value="<?php echo $app_no;?>" class="form-control" placeholder="Application #">            
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="name">Student Name</label>
                                <input type="text" name="student_name" value="<?php echo $std_name;?>" class="form-control" placeholder="Student Name">            
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="name">Farther Name</label>
                                <input type="text" name="father_name" value="<?php echo $fth_name;?>" class="form-control" placeholder="Student Name">            
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="name" style="visibility: hidden">Farther Name</label>
                                <input type="submit" class="btn btn-theme" name="search" value="Search">            
                            </div>
                        </div>
                    </form>
                </div> 
            </section>
        </div>
          
        <div class="col-md-12 col-sm-12">  
            <?php
            if(@$result):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
    <table class="table table-boxed">
        <thead>
            <tr>
            <th>S#</th>
            <th>College#</th>
            <th>Picture</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Sub Program</th>
            <th>Section</th>
            <!--<th>Status</th>-->
            <th>App #</th>
            <th>App Date</th>
            <th>Leave Duration</th>
            <th>Update</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
            $status = $row->student_status;
  
//            $dt = $row->date;
//            $date = date('d-m-Y', strtotime($dt));
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row->college_no;?></td>
            <td><img src="assets/images/students/<?php echo $row->applicant_image;?>" width="60" height="40"></td>
            <td><?php echo $row->student_name;?></td>
            <td><?php echo $row->father_name;?></td>
            <td><?php echo $row->sub_program;?></td>
            <td><?php echo $row->std_section;?></td>
            <!--<td><?php //if($row->sst_id == '5'): echo "<span class='badge badge-success'>".$status."<span>"; else: echo "<span class='badge badge-danger'>".$status."<span>"; endif;?></td>-->
            <td><?php echo $row->salr_application_id;?></td>
            <td><?php echo date('d-m-Y', strtotime($row->salr_application_date));?></td>
            <td><?php echo date('d-m-Y', strtotime($row->salr_leave_from_date)).' to '.date('d-m-Y', strtotime($row->salr_leave_to_date));?></td>
            <td><a href="AttendanceController/edit_leave_record_1st_year/<?php echo $row->salr_id;?>" class="btn btn-theme">Update</a></td>   
        </tr>
            <?php 
            $i++;
                endforeach;
            ?>
        </tbody>
    </table>
            <?php
            else:
                echo "Records Not Found..";
            endif;
                ?>
</div>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
