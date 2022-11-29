<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>

<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $ReportName?>
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
          <li class="current"><?php echo $ReportName?>
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7  page-row">                            
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12">
              
<!--              <div class="form-group">
                <?php
                    $student_id = array(
                    'name'	=> 'college_no',
                    'value'	=> $college_no,
                    'class'     =>'form-control',
                    'placeholder'=>'College No'
                    );
                    echo form_input($college_no);
                    ?>
              </div>-->
              <!--//form-group-->
              <div class="form-group">
                  <input name="college_no" value="<?php if($college_no): echo $college_no;endif; ?>" type="number" class="form-control" placeholder="College No">
              </div>
              <!--//form-group-->     
              <div class="form-group">
                  <input name="student_name" type="text" value="<?php if($student_name): echo $student_name;endif; ?>" class="form-control" placeholder="Name">
              </div>
              <!--//form-group-->
              <div class="form-group">
                <input name="father_name" type="text" value="<?php if($father_name): echo $father_name;endif; ?>"  class="form-control" placeholder="Father name">
              </div>
              <!--//form-group-->
          <div class="form-group">
            <?php 
                echo form_dropdown('program', $program, $programId,  'class="form-control" id="SProgrameId"');
            ?>
          </div>
              <!--//form-group-->
          <div class="form-group">
           <select class="form-control" name="sub_program" id="showingSubPro">
            <option value="">Sub Program</option>  
            </select>
          </div>
          <div class="form-group">
              <select class="form-control" name="sections_name" id="showingSections">
            <option value="">Section</option>  
            </select>
          </div>
        <div class="form-group">
            <select class="form-control" name="batch" id="showingbatch_id">
            <option value="">Batch Name</option>  
            </select>
          </div>        
        <div class="form-group">
            <button type="submit" name="search" value="search" class="btn btn-theme">
                <i class="fa fa-search">
              </i> Search
            </button>
          </div>
               
            </div>
          </div>
            
           
            <?php
            if(@$result):
            ?>
           <div class="form-group">    
                <select name="login_status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="2">Deactive</option>
                </select>    
           </div>
            <div class="form-group">
            <input type="submit" name="lock_unlock" value="Change Status" class="btn btn-theme">
          </div>
            <p><button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result)?>
            </button></p>
            
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                 <th><input type="checkbox" id="checkAll"></th>    
                  <th>#</th>
                  <th>Img</th>
                  <th>College #</th>
                  <th>Student Name</th>
                  <th>Father name</th>
                  <th>Gender</th>
                  <th>Program</th>
                  <th>Sub program</th>
                  <th>section</th>
                  <th>Batch </th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                         $timestamp = strtotime($resRow->admission_date);
                          $admission_date = date('d-m-y', $timestamp);
                ?>
              <tr>
                <td><input type="checkbox" name="checked[]" value="<?php echo $resRow->student_id; ?>" id="checkItem">
                    <input type="hidden" name="student_id">
                </td>  
                <td><?php echo $sn; ?></td>
                <td><img src="assets/images/students/<?php echo $resRow->applicant_image; ?>" style="height: 50px;"></td>
                <td><?php echo $resRow->college_no; ?></td>
                <td><?php echo $resRow->student_name; ?></td>
                <td><?php echo $resRow->father_name; ?></td>
                <td><?php echo $resRow->genderName; ?></td>
                <td><?php echo $resRow->programe_name; ?></td>
                <td><?php echo $resRow->subprogram; ?></td>
                <td><?php echo @$resRow->sectionName; ?></td>
                <td><?php echo $resRow->batch_name; ?></td>
          </tr>
                  <?php
                   $sn++;
                  endforeach;
                ?>
              </tbody>
            </table>    
             <?php echo form_close();
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
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
 
 