<!-- ******CONTENT****** --> 
<div class="content container">
    <h2 align="left">Student Practical White Card Inter<hr></h2>
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
            <article class="contact-form col-md-12 col-sm-7">   
         <form method="post">
            <div class="form-group col-md-2">
            <input type="text" name="college_no" value="<?php if($college_no): echo $college_no; endif;?>"  placeholder="College No." class="form-control">
            </div>
            <div class="form-group col-md-2">
            <input type="text" name="student_name" value="<?php if($student_name): echo $student_name; endif;?>"  placeholder="Student Name" class="form-control">
            </div>
            <div class="form-group col-md-2">
            <input type="text" name="group_id" class="form-control" placeholder="Group Name" id="groupName">
            <input type="hidden" name="group_id" id="group_id">
            </div>        
            <div class="form-group col-md-6"> 
            <input type="submit" name="search" class="btn btn-theme" value="Search">
          <button type="button" name="Print" value="Print" id="pracPrint" class="btn btn-theme">
                <i class="fa fa-print">
              </i> Print
            </button>
            </div>    
        </form>
            <?php if(@$result):?> 
                <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>
            </p>
        <table class="table table-boxed table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>College #</th>
                <th>Student Name</th>
                <th>Group Name</th>
                <th>Update</th>
            </tr>
        <?php 
            $s =1;
            foreach($result as $pRow):    
        ?>    
        <tr>
            <td><?php echo $s;?></td>
            <td><?php echo $pRow->college_no;?></td>
            <td><?php echo $pRow->student_name;?></td>
            <td><?php echo $pRow->group_name;?></td>
            <td><a class="btn btn-theme btn-sm" href="AttendanceController/practical_attendance_white_card/<?php echo $pRow->college_no;?>/<?php echo $pRow->group_id;?>">View Practical White Card</a></td>
        </tr>
        <?php 
            $s++;
            endforeach;
        ?>    
        </thead>
        <tbody>

        </tbody>
    </table>
                <?php endif; ?>
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 