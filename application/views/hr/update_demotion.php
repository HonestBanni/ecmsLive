<div class="content container">
        <div class="row cols-wrapper">
        <div class="col-md-12">

    <h3 align="center">Update Demotion</h3>
        </div>
    </div><hr>
            <div class="row cols-wrapper">
                <form name="student" method="post">
                <div class="col-md-12">
                  <div class="form-group col-md-3">
                      <input type="hidden" name="dem_id" value="<?php echo $result->dem_id;?>">
                    <label for="usr">Employee Name:</label>
                      <?php
    $gres = $this->HrModel->get_by_id('hr_emp_record',array('emp_id'=>$result->emp_id));
        if($gres){
            foreach($gres as $grec){ ?>                   
    <input class="form-control" type="text" name="emp_id" value="<?php echo $grec->emp_name;?>" id="empname">
    <input type="hidden" id="emp_id" value="<?php echo $grec->emp_id;?>" name="emp_id">
         <?php 
            }     
        }else{
    ?>
    <input class="form-control" type="text" name="emp_id" id="empname">
            <input type="hidden" id="emp_id" name="emp_id">                   
        <?php
            }    
        ?>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Letter #:</label>
                      <input class="form-control" type="text" value="<?php echo $result->letter_no;?>" name="letter_no">
                  </div>
                <div class="form-group col-md-3">
                    <label for="usr">Date:</label>
                      <?php
                    $date = $result->dem_date;
                    if($date === '0000-00-00' || $date == '' || $date == '01-01-1970'){
                        $date = '';
                    } else {
                        $date = date("d-m-Y", strtotime($date));
                    }
                    ?>
        <input class="form-control date_format_d_m_yy" value="<?php echo $date;?>" type="text" name="date">
                  </div>
                 <div class="form-group col-md-3">
                    <label for="usr">From Scale:</label>
                      <select type="text" name="from_scale_id" class="form-control">
                          <?php
                    $res = $this->HrModel->get_by_id('hr_emp_scale',array('emp_scale_id'=>$result->from_scale_id));
                        if($res){
                            foreach($res as $crec){ ?>                   
                    <option type="text" value="<?php echo $crec->emp_scale_id;?>"><?php echo $crec->title;?></option>
                         <?php 
                            }     
                        }else{
                    echo '<option type="text" value="" class="form-control"></option>';
                            }    
    ?>
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
                          <?php
                    $res = $this->HrModel->get_by_id('hr_emp_scale',array('emp_scale_id'=>$result->to_scale_id));
                        if($res){
                            foreach($res as $crec){ ?>                   
                    <option type="text" value="<?php echo $crec->emp_scale_id;?>"><?php echo $crec->title;?></option>
                         <?php 
                            }     
                        }else{
                    echo '<option type="text" value="" class="form-control"></option>';
                            }    
    ?>
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
                        <?php
                    $res = $this->HrModel->get_by_id('hr_emp_designation',array('emp_desg_id'=>$result->from_desg_id));
                        if($res){
                            foreach($res as $crec){ ?>                   
                    <option type="text" value="<?php echo $crec->emp_desg_id;?>"><?php echo $crec->title;?></option>
                         <?php 
                            }     
                        }else{
                    echo '<option type="text" value="" class="form-control"></option>';
                            }    
    ?>  
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
                        <?php
                    $res = $this->HrModel->get_by_id('hr_emp_designation',array('emp_desg_id'=>$result->to_desg_id));
                        if($res){
                            foreach($res as $crec){ ?>                   
                    <option type="text" value="<?php echo $crec->emp_desg_id;?>"><?php echo $crec->title;?></option>
                         <?php 
                            }     
                        }else{
                    echo '<option type="text" value="" class="form-control"></option>';
                            }    
    ?>    
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
                      <input class="form-control" type="text" value="<?php echo $result->from_p;?>" name="from_p">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="usr">Remarks:</label>
                      <input class="form-control" type="text" value="<?php echo $result->remarks;?>" name="remarks">
                  </div>
                <div class="form-group col-md-12">
                    <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Update Demotion">              </div>     
                </div>
                
                </div>
                    </form>
                
</div><!--/.container-->
</div><!--/.wrapper-->