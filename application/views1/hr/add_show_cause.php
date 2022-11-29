<div class="content container">
        <div class="row cols-wrapper">
        <div class="col-md-12">

    <h4 align="center">Add Show Cause</h4>
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
                    <label for="usr">From:</label>
                      <input class="form-control" type="text" name="from_p">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="usr">Description:</label>
                      <textarea class="form-control" type="text" name="details"></textarea>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="usr">Remarks:</label>
                      <input class="form-control" type="text" name="remarks">
                  </div>
                    <div class="form-group col-md-3">
                    <label for="usr">Image:</label>
                      <input class="form-control" type="file" name="file">
                  </div>
                <div class="form-group col-md-12">
                    <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Add Show Cause">              </div>     
                </div>
                
                </div>
                    </form>
                
</div><!--/.container-->
</div><!--/.wrapper-->