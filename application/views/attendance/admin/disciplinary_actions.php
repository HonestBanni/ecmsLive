<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <div class="col-md-12 col-sm-12">   
            <h2 align="left">Disciplinary Actions 
                <span  style="float:right">
                    <a href="AttendanceController/add_disc_action" class="btn btn-large btn-primary">Add Disciplinary Action</a>
                </span>
                <hr>
            </h2>
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line">Disciplinary Actions Search Form</span>
                </h1>
                <div class="section-content">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <label for="name">Form #</label>
                                <input type="number" name="form_no" value="<?php echo $form_no;?>" class="form-control" placeholder="Form #">            
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="name">College #</label>
                                <input type="text" name="college_no" value="<?php echo $college_no;?>" class="form-control" placeholder="College #">            
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
            <th>Fine Date</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Enter By</th>
            <th>View Details</th>
            <th>Remarks</th>
            <th>Update</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
            $proctor_id = $row->proctor_id;
            $status = $row->student_status;
  
            $dt = $row->date;
            $date = date('d-m-Y', strtotime($dt));
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row->college_no;?></td>
            <td><img src="assets/images/students/<?php echo $row->applicant_image;?>" width="60" height="40"></td>
            <td><?php echo $row->student_name;?></td>
            <td><?php echo $row->father_name;?></td>
            <td><?php echo $row->sub_program;?></td>
            <td><?php echo $row->std_section;?></td>
            <td><?php echo $date;?></td>
            <td><?php echo $row->amount;?></td>
            <td><?php if($row->sst_id == '5'): echo "<span class='badge badge-success'>".$status."<span>"; else: echo "<span class='badge badge-danger'>".$status."<span>"; endif;?></td>
            <td><?php echo $row->emp_name; ?></td>
            <td><a href="ViewDisciplinaryAction/<?php echo $row->proc_id;?>" class="btn btn-theme">View</a></td>   
            <td>
            <?php
            if(!empty($curr_user)):
                if($curr_user == $row->proc_user_id):
                    echo '<a href="EditWhiteCardRemarksDACP/'.$row->proc_id.'" class="btn btn-theme">WC Remarks</a>';
                endif;
            endif;
            ?>
            </td>  
            <td>
            <?php
            if(!empty($curr_user)):
                if($curr_user == $row->proc_user_id):
                    echo '<a href="EditDisciplinaryAction/'.$row->proc_id.'" class="btn btn-primary">Update</a>';
                endif;
            endif;
            ?>
            </td>  
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
