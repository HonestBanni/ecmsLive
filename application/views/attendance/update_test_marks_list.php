        <!-- ******CONTENT****** --> 
        <div class="content container">
            <div class="page-wrapper">
            <header class="page-heading clearfix">
                  <h1 class="heading-title pull-left">Update Test Marks List</h1>
                </header>
            </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">  
                     <?php $id = $this->uri->segment(3)?>   
                        
            <?php $test_id = $this->uri->segment(3);
            $total = $this->db->query("SELECT * FROM monthly_test_details WHERE test_id = '$test_id'");?>
                    <h4><strong>Teacher: <?php echo $empRecord->emp_name;?>, Section: <?php echo $section->name;?>   
                    </strong>, [<strong>Total Students: <?php  echo $total->num_rows(); ?></strong>]</h4>
                    <form method="post">   
            <div class="form-group col-md-2">
                <select name="tmarks" id ="tmarks" class="form-control">
                    <option value="20">20</option>
                </select>  
            </div>   
              <input type="hidden" name="test_id" value="<?php echo $this->uri->segment(3);?>">
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Student Picture</th>
                            <th>College No</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Obt-Marks</th>
                            <th>T-Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                    foreach($result as $rec)  
                    {
                        ?>
                        <tr class="gradeA">
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                <td><?php echo $rec->college_no;?></td>
                <td><?php echo $rec->student_name; ?>
                <input type="hidden" name="student_id[]" value="<?php echo $rec->student_id; ?>"></td>
                <td><?php echo $rec->father_name;?></td>
                <td><input type="text" name="omarks[]" value="<?php echo $rec->omarks ?>" class="form-control checkINput"></td>
                <td><?php echo $rec->tmarks; ?></td>      
                        </tr>
                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table> 
                    <div class="form-group col-md-2">
                      <input type="submit" name="update" value="Update" class="btn btn-theme">
                    </div>
                </form>      
                </div><!--//col-md-3-->   
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   