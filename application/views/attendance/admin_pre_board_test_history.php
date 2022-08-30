        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Admin Pre Board Tests History<hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post" action="AttendanceController/search_admin_pre_board_test">
                      <div class="form-group col-md-2">
                            <input type="text" name="emp_id" placeholder="Employee" class="form-control" id="emp">
                                <input type="hidden" name="emp_id" id="emp_id">
                      </div>
                      <div class="form-group col-md-2">
                            <input type="text" name="sec_id" placeholder="Section" class="form-control" id="sec">
                            <input type="hidden" name="sec_id" id="sec_id">
                      </div>
                      <div class="form-group col-md-2">
                            <input type="text" name="subject_id" placeholder="Subject" class="form-control" id="sub">
                            <input type="hidden" name="subject_id" id="subject_id">
                      </div>
                         <input type="submit" name="search" class="btn btn-theme" value="Search">
                </form>
            </div>
        </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
              
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   