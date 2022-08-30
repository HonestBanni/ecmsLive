<!-- ******CONTENT****** --> 
<div class="content container">
    <!-- ******BANNER****** -->
    <h2 align="left">Update Total Marks <hr></h2>
    <div class="row cols-wrapper">
        <?php if($test_result): ?>
        <form name="std" method="post" action="AttendanceController/update_exam_total_marks">  
            <div class="col-md-12"> 
                <div class="form-group col-md-2">
                    <label>Exam/Test Type</label>
                    <input class="form-control" type="text" name="test_type" value="<?php echo $test_type->xt_title; ?>" readonly="readonly">
                    <input type="hidden" name="testId" value="<?php echo $test_result->exb_test_id; ?>">
                </div>
                <div class="form-group col-md-2">
                    <label>Date</label>
                    <input  class="form-control" type="text" name="test_date" value="<?php echo date('d-m-Y');?>" readonly="readonly">
                </div>
                <div class="form-group col-md-2">
                    <label>Total Marks</label>
                    <select name="tmarks" id="tmarks" class="form-control">
                        <?php for($j=5; $j<=50; $j+=5):
                            if($test_result->exb_test_marks == $j): $slcted = 'selected="selected"'; else: $slcted = ''; endif;
                            echo '<option '.$slcted.' value="'.$j.'">'.$j.'</option>';
                        endfor; ?>
                    </select>  
                </div>
                <div class="form-group col-md-2">
                    <label style="visibility:hidden">Total Exam Marks</label>
                    <input type="submit" name="submit" value="Submit" class="btn btn-theme">
                </div>  
            </div><!--//col-md-3-->
        </form>  
        <?php endif; ?>
    </div><!--//cols-wrapper-->
</div><!--//content-->
   