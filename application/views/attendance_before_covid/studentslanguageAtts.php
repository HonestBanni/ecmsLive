<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
             <?php
                foreach($result as $rec);
            ?>
            <h3 align="left">Language: <?php echo @$program->programe_name;?>,  Batch:<?php echo @$batch->batch_name;?>(<?php echo count($result);?>) <hr></h3>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg1'));?>
                    </h4>
                    <h4 style="color:green; text-align:center;">
                        <?php print_r($this->session->flashdata('success'));?>
                    </h4>
           
          <form name="std" method="post" action="AttendanceController/studentslanguageAtts">   
              <input type="hidden" name="programe_id" value="<?php echo $this->uri->segment(3);?>">
              <input type="hidden" name="batch_id" value="<?php echo $this->uri->segment(4);?>">
                  
                    <div class="form-group col-md-2">
                          <input type="text" name="attendance_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy">       
                    </div>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th> 
                            <th>Serial No</th>
                            <th>Form No</th>
                            <th>Student Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $s = 1;
                    foreach($result as $rec)  
                    {
                    ?>
                        <tr class="gradeA">
                    <td><input type="checkbox" name="checked[]" value="<?php echo $rec->student_id;?>" id="checkItem" checked>
                        
                                <input type="hidden" name="student_id"  value="0" id="student_id"></td>
                            <td><?php echo $s;?></td>
                            <td  style="font-size: 15px;"><strong><?php echo $rec->form_no;?></strong></td>
                            <td  style="font-size: 15px;"><strong><?php echo $rec->student_name;?></strong></td>
                            <td  style="font-size: 15px;"><strong><?php echo $rec->name;?></strong></td>
                        </tr>
                    <?php
                        $s++;
                    }
                    ?>
                    </tbody>
                </table>
                   <div class="form-group col-md-2">
                      <input type="submit" name="submit" value="Submit" class="btn btn-theme">
                    </div>  
                </div><!--//col-md-3-->
                </form>  
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   