<div class="content container">
        <h3>Update Research Paper<hr></h3>
            <div class="row cols-wrapper">
                <form name="student" method="post">
                <div class="col-md-12">
                  <div class="form-group col-md-12">
                    <label for="usr">Author Name:</label>
            <input class="form-control" type="text" name="author" value="<?php echo $result->author;?>">
                    <input type="hidden" value="<?php echo $result->rp_id;?>" name="rp_id"> 
                  </div>
                  <div class="form-group col-md-12">
                    <label for="usr">Paper Title:</label>
                      <input class="form-control" type="text" value="<?php echo $result->title;?>" name="title">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Journal:</label>
                      <input class="form-control" type="text" value="<?php echo $result->journal;?>" name="journal">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Volume:</label>
                      <input class="form-control" type="text" value="<?php echo $result->volume;?>" name="volume">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Pages:</label>
                      <input class="form-control" type="text" name="pages" value="<?php echo $result->pages;?>">
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
                    <label for="usr">Year:</label>
                      <input class="form-control" type="text" value="<?php echo $result->year;?>" name="year">
                  </div>
                    <div class="form-group col-md-3">
                    <label for="usr">ISSN:</label>
                      <input class="form-control" type="text" value="<?php echo $result->issn;?>" name="issn">
                  </div>
                <div class="form-group col-md-6">
                    <label for="usr">Remarks:</label>
                      <input class="form-control" type="text" value="<?php echo $result->remarks;?>" name="remarks">
                  </div> 
                <div class="form-group col-md-3">
                    <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Update Research Paper">              </div>     
                </div>
                
                </div>
                    </form>
                
</div><!--/.container-->
</div><!--/.wrapper-->