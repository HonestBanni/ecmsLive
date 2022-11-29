<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
     .ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span{
          display: none;
      }
      .ui-datepicker .ui-datepicker-prev-hover{
          display: none;
      }
      .ui-datepicker .ui-datepicker-next-hover{
         display: none; 
      }

.blink_text { 

        -webkit-animation-name: blinker;
 -webkit-animation-duration: 1s;
 -webkit-animation-timing-function: linear;
 -webkit-animation-iteration-count: infinite;

 -moz-animation-name: blinker;
 -moz-animation-duration: 1s;
 -moz-animation-timing-function: linear;
 -moz-animation-iteration-count: infinite;
 animation-name: blinker;
 animation-duration: 2s;
 animation-timing-function: linear; 
    animation-iteration-count: infinite; color: red; 
} 

@-moz-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
} 

@keyframes blinker {  
    0% { opacity: 1.0; } 
    50% { opacity: 0.0; }      
    100% { opacity: 1.0; } 
} 
</style>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
             <?php
                foreach($result as $rec);
            ?>
            <h2 align="left">Students List Section:<?php echo @$rec->section;?>(<?php echo count($result);?>) <hr></h2>
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
           
          <form name="std" method="post" action="AttendanceController/sectionbase_exam">   
              <input type="hidden" name="class_id" value="<?php echo $this->uri->segment(3);?>">
              <input type="hidden" name="sec_id" value="<?php echo $this->uri->segment(4);?>">
                  
            <div class="form-group col-md-2">
                <label>Month</label>
                
                 <?php 
                    echo form_dropdown('exam', $exam, '',  'class="form-control" required="required"');
                ?>  </div>
            <div class="form-group col-md-2">
                <label>Year</label>
                <input  class="form-control" type="text" name="test_date" value="<?php echo date('d-m-Y');?>" readonly="readonly">
                       
            </div>
            <div class="form-group col-md-2">
                <label>Total Marks</label>
                <select name="tmarks" id="tmarks" class="form-control">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25" selected="selected">25</option>
                    <option value="30">30</option>
                    <option value="35">35</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>  
            </div>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Picture</th>
                            <th>College No</th>
                            <th>Student</th>
                            <th>Obtained Marks</th>
                            <th>Father</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $s = 1;
                    foreach($result as $rec)  
                    {
                    ?>
                        <tr class="gradeA">
                            <td><?php echo $s;?></td>
                            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                            <td   style="font-size: 15px;"><strong><?php echo $rec->college_no;?></strong></td>
                            <td  style="font-size: 15px;"><strong><?php echo $rec->student;?></strong>
                                <input type="hidden" name="student_id[]"   value="<?php echo $rec->student_id;?>" id="student_id">
                            </td>
                            <td><input type="text" name="omarks[]"  placeholder="Obtained Marks" class="form-control checkINput"></td>
                            <td><?php echo $rec->father;?></td>
                            <td><?php echo $rec->section;?></td>
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
   