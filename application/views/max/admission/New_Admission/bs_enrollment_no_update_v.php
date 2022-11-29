<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_header?>
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current"><?php echo $page_header?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <form method="post" >
            
            <div class="form-group col-md-3">
             <label>Student Name</label>
                 <input type="text" class="form-control" value="<?php echo $result->student_name;?>" readonly>
                 <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>">
            </div>

            <div class="form-group col-md-3">
                <label>Father Name</label>
                <input type="text" class="form-control" value="<?php echo $result->father_name;?>" readonly>
            </div>

            <div class="form-group col-md-3">
                <label>Program</label>
                <input type="text" class="form-control" value="<?php echo $result->program;?>" readonly>
            </div>

            <div class="form-group col-md-3">
                <label>Sub Program</label>
                <input type="text" class="form-control" value="<?php echo $result->sub_program;?>" readonly>
            </div>

            <div class="form-group col-md-3">
                <label>Date of Birth</label>
                <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($result->dob));?>" readonly>
            </div>

            <div class="form-group col-md-3">
                <label>Religion</label>
                <input type="text" class="form-control" value="<?php echo $result->religion_name;?>" readonly>
            </div>
            
            <div class="form-group col-md-3">
                <label>Domicile</label>
                <input type="text" class="form-control" value="<?php echo $result->domicile_name;?>" readonly>
            </div>
            
            <div class="form-group col-md-3">
                <label>Shift</label>
                <input type="text" class="form-control" value="<?php echo $result->shift_name;?>" readonly>
            </div>
            
            <div class="form-group col-md-3">
                <label>Obtained Marks</label>
                <input type="text" class="form-control" value="<?php echo $result->obtained_marks;?>" readonly>
            </div>
            
            <div class="form-group col-md-3">
                <label>Total Marks</label>
                <input type="text" class="form-control" value="<?php echo $result->total_marks;?>" readonly>
            </div>
            
            <div class="form-group col-md-3">
                <label>Board / University</label>
                <input type="text" class="form-control" value="<?php echo $result->bu_name;?>" readonly>
            </div>
            
            <div class="form-group col-md-3">
                <label>Admission Date</label>
                <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($result->admission_date));?>" readonly>
            </div>
            
            <div class="form-group col-md-3">
                <label>University Enrollment No</label>
                <input type="text" name="enrollment_no" required="required" class="form-control" id="checking_college_no"  value="<?php echo $result->bs_enrollment_no;?>">
            </div>

           <div class="form-group col-md-6">
               <input style="margin-top:23px" type="submit" value="Update" id="updateCollegeNo" name="submit" class="btn-primary btn">
           </div>        
        </form>
   </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
