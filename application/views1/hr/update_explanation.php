<div class="content container">
        <div class="row cols-wrapper">
        <div class="col-md-12">

    <h4 align="center">Update Explanation Letter</h4>
        </div>
    </div><hr>
            <div class="row cols-wrapper">
                <form name="student" method="post">
                <div class="col-md-12">
                  <div class="form-group col-md-3">
        <input type="hidden" name="exp_id" value="<?php echo $result->exp_id;?>">
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
                      <input class="form-control" value="<?php echo $result->letter_no;?>" type="text" name="letter_no">
                  </div>
                <div class="form-group col-md-3">
                    <label for="usr">Date:</label>
                    <?php
                    $date = $result->date;
        if($date === '0000-00-00' || $date == '' || $date == '01-01-1970'){
            $date = '';
        } else {
            $date = date("d-m-Y", strtotime($date));
        }
                    ?>
        <input class="form-control date_format_d_m_yy" value="<?php echo $date;?>" type="text" name="date">
                  </div>
                 <div class="form-group col-md-3">
                    <label for="usr">From:</label>
                      <input class="form-control" value="<?php echo $result->from_p;?>" type="text" name="from_p">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="usr">Description:</label>
                      <textarea class="form-control" type="text" name="details">
                          <?php echo $result->details;?></textarea>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Remarks:</label>
                      <input class="form-control" value="<?php echo $result->remarks;?>" type="text" name="remarks">
                  </div>
                <div class="form-group col-md-12">
                    <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Update Explanation Letter">              </div>     
                </div>
                
                </div>
                    </form>
                
</div><!--/.container-->
</div><!--/.wrapper-->