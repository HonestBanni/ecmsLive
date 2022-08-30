<div class="content container">
        <div class="row cols-wrapper">
        <div class="col-md-12">
    <h4 align="center">Update Professional Education</h4>
        </div>
    </div><hr>
            <div class="row cols-wrapper">
                <form name="student" method="post">
                <div class="col-md-12">
                  <div class="form-group col-md-3">
                    <label for="usr">Title:</label>
                      <input class="form-control" type="text" name="title" value="<?php echo $result->title;?>">
                    <input type="hidden" value="<?php echo $result->fe_id;?>" name="fe_id"> 
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Affiliated Institute:</label>
                      <input class="form-control" type="text" value="<?php echo $result->aff_institute;?>" name="aff_institute">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Country:</label>
                      <?php if($result->country_id):
                      $c = $this->HrModel->get_by_id('country',array('country_id'=>$result->country_id));
                      foreach($c as $crec):
                      ?>
                    <input type="text" name="country_id" class="form-control" value="<?php echo $crec->name;?>" id="country">
                    <input type="hidden" name="country_id" value="<?php echo $crec->country_id;?>" id="country_id">
            <?php 
                endforeach;
                else:
            ?>
            <input type="text" name="country_id" class="form-control" id="country">
            <input type="hidden" name="country_id" id="country_id">
            <?php endif;?>
                      
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Date:</label>
                      <?php
                        $date = $result->date;
                        $newDate = date("d-m-Y", strtotime($date));
                      ?>
                      <input class="form-control date_format_d_m_yy" value="<?php echo $newDate;?>" type="text" name="date">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Duration:</label>
                      <input class="form-control" type="text" value="<?php echo $result->duration;?>" name="duration">
                  </div>
                <div class="form-group col-md-6">
                    <label for="usr">Remarks:</label>
                      <input class="form-control" type="text" name="remarks" value="<?php echo $result->remarks;?>">
                  </div> 
                <div class="form-group col-md-3">
                    <div class="form-group">
            <input type="submit" style="margin-top:23px;" class="btn btn-primary" name="submit" value="Update Professional Education">              </div>     
                </div>
                </div>
                    </form>
                
</div><!--/.container-->
</div><!--/.wrapper-->