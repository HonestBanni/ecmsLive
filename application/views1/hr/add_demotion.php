<div class="content container">
        <div class="row cols-wrapper">
        <div class="col-md-12">

    <h4 align="center">Add Demotion</h4>
        </div>
    </div><hr>
            <div class="row cols-wrapper">
                <form name="student" enctype="multipart/form-data" method="post">
                <div class="col-md-12">
                  <div class="form-group col-md-9">
                    <label for="usr">Employee Name:</label>
                      <input class="form-control" type="text" name="emp_id" id="employee_data">
                    <input type="hidden" id="emp_id" name="emp_id"> 
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Letter #:</label>
                      <input class="form-control" type="text" name="letter_no">
                  </div>
                <div class="form-group col-md-3">
                    <label for="usr">Date:</label>
                      <input class="form-control date_format_d_m_yy" type="text" name="date">
                  </div>
                 <div class="form-group col-md-3">
                    <label for="usr">From Scale:</label>
                      <select type="text" name="from_scale_id" class="form-control">
                            <option value=""> Select Scale</option>     
                                <?php
                            $b = $this->db->query("SELECT * FROM hr_emp_scale order by title asc");
                            foreach($b->result() as $brec)
                            {
                            ?>
                        <option value="<?php echo $brec->emp_scale_id;?>"><?php echo $brec->title;?></option>
                            <?php 
                            }
                            ?>
                        </select> 
                  </div>
                <div class="form-group col-md-3">
                    <label for="usr">To Scale:</label>
                      <select type="text" name="to_scale_id" class="form-control">
                            <option value=""> Select Scale</option>     
                                <?php
                            $b = $this->db->query("SELECT * FROM hr_emp_scale order by title asc");
                            foreach($b->result() as $brec)
                            {
                            ?>
                        <option value="<?php echo $brec->emp_scale_id;?>"><?php echo $brec->title;?></option>
                            <?php 
                            }
                            ?>
                        </select>
                  </div>
                <div class="form-group col-md-3">
                    <label for="usr">From Designation:</label>
                      <select type="text" name="from_desg_id" class="form-control">
                        <option value="">Select Designation</option>     
                            <?php
                        $d = $this->db->query("SELECT * FROM hr_emp_designation");
                        foreach($d->result() as $brec)
                        {
                        ?>
                        <option value="<?php echo $brec->emp_desg_id;?>"><?php echo $brec->title;?></option>
                        <?php 
                        }
                        ?>
                        </select> 
                  </div>
                <div class="form-group col-md-3">
                    <label for="usr">To Designation:</label>
                      <select type="text" name="to_desg_id" class="form-control">
                        <option value="">Select Designation</option>     
                            <?php
                        $d = $this->db->query("SELECT * FROM hr_emp_designation");
                        foreach($d->result() as $brec)
                        {
                        ?>
                        <option value="<?php echo $brec->emp_desg_id;?>"><?php echo $brec->title;?></option>
                        <?php 
                        }
                        ?>
                        </select>
                  </div>
                <div class="form-group col-md-3">
                    <label for="usr">From:</label>
                      <input class="form-control" type="text" name="from_p">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="usr">Remarks:</label>
                      <input class="form-control" type="text" name="remarks">
                  </div>
                    <div class="form-group col-md-3">
                    <label for="usr">Image:</label>
                      <input class="form-control" type="file" name="file">
                  </div>
                <div class="form-group col-md-12">
                    <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Add Demotion">              </div>     
                </div>
                
                </div>
                    </form>
                
</div><!--/.container-->
</div><!--/.wrapper-->