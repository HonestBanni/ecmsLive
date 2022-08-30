 <div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Add New Proctor
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
          <li class="current">Add Proctor
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
             <form method="post">
        <article class="contact-form col-md-12 col-sm-7"> 
         
          <div class="col-md-12" style="margin-bottom:10px;">
                 
          </div>
  
            <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-3">
        <input type="text" name="student_id" class="form-control" placeholder="Student Name" id="student_record">
            <input type="hidden" name="student_id" id="student_id">  
            </div>
            <div class="form-group col-md-3">
                <select class="form-control" name="status">
                    <option value="1">Active</option>    
                    <option value="2">Deactive</option>    
                </select> 
            </div>
            <div class="form-group col-md-2">
            <input type="submit" name="submit" value="Add Proctor" class="btn btn-theme">
                </div>             
        </div>
           </div>      
            </article> 
          <article class="contact-form col-md-12 col-sm-7">
              <?php 
              if(@$result):
              ?>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Picture</th>
                    <th>Proctor Name</th>
                    <th>Father Name</th>
                    <th>College #</th>
                    <th>Program</th>
                    <th>Sub Program</th>
                    <th>Section</th>
                    <th>Update</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td><img src="assets/images/students/<?php echo $result->applicant_image;?>" height="40" width="70"></td>
                    <td><?php echo $result->student_name;?></td>
                    <td><?php echo $result->father_name;?></td>
                    <td><?php echo $result->college_no;?></td>
                    <td><?php echo $result->program;?></td>
                    <td><?php echo $result->sub_program;?></td>
                    <td><?php echo $result->section;?></td>
                    <td><a href="SecurityController/add_to_proctor/<?php echo $result->student_id;?>" class="btn btn-theme" onclick="return confirm('Are you Want to Add This Student in Proctor List..?')">Add to Proctors List</a></td>
                </tr>
              </tbody>
            </table>
              <?php
              endif;
              ?>
          </article>  
            </form>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 