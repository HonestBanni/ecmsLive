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
            <h2 align="left">Attendance Students List Group:<?php echo @$rec->group_name;?>(<?php echo count($result);?>) <hr></h2>
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
           
          <form name="std" method="post" action="AttendanceController/practical_studentsAtts">   
              <input type="hidden" name="prac_class_id" value="<?php echo $this->uri->segment(3);?>">
              <input type="hidden" name="group_id" value="<?php echo $this->uri->segment(4);?>">
                  
                    <div class="form-group col-md-2">
                         <select class="form-control" name="attendance_date">
                        <?php
                            $m= date("m");
                            $de= date("d");
                            $y= date("Y");
                            $sec_id =$this->uri->segment(4);
                        
                         
                                for($i=0; $i<=50; $i++){

                                $date_is = date('d-m-Y',mktime(0,0,0,$m,($de-$i),$y)); 
                                echo '<option value="'.$date_is.'">'.$date_is.'</option>';

                                }
                            
 
                        
                            

                                
                            ?>
                           </select>
                          <!--<input type="date" name="attendance_date" value="<?php echo date('Y-m-d');?>" class="form-control">-->       
                    </div>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th> 
                            <th>Serial No</th>
                            <th>College No</th>
                            <th>Student</th>
                            <th>Group</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $s = 1;
                    foreach($result as $rec)  
                    {
                    ?>
                        <tr class="gradeA">
    <td><input type="checkbox" name="checked[]" value="<?php echo $rec->college_no;?>" id="checkItem" checked>
            <input type="hidden" name="college_no"  value="0" id="college_no"></td>
            <td><?php echo $s;?></td>
            <td  style="font-size: 15px;"><strong><?php echo $rec->college_no;?></strong></td>
            <td  style="font-size: 15px;"><strong><?php echo $rec->student_name;?></strong></td>
            <td><?php echo $rec->group_name;?></td>
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
   