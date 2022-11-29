<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
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
          
            <div class="content container">
            <div class="row cols-wrapper">
                <div class="col-md-12">
            <form method="post">

              <div class="form-group col-md-2">
                  <input name="college_no" value="<?php if($college_no): echo $college_no;endif; ?>"type="number" class="form-control" placeholder="College No">
              </div>
              
              <!--//form-group-->     
              <div class="form-group col-md-2">
                  <input name="student_name" type="text" value="<?php if($student_name): echo $student_name;endif; ?>" class="form-control" placeholder="Name">
              </div>
              <!--//form-group-->
              <div class="form-group col-md-2">
                <input name="father_name" type="text" value="<?php if($father_name): echo $father_name;endif; ?>"  class="form-control" placeholder="Father name">
              </div>
              <!--//form-group-->
              
              <div class="form-group col-md-2">
                <?php 
                    echo form_dropdown('program', $program, $programId,  'class="form-control feeProgrameId" id="feeProgrameId"');
                ?>
              </div>
              <!--//form-group-->
              <div class="form-group col-md-2">
                <?php 
                echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" id="showFeeSubPro"');
                ?>
              </div>
              
              <div class="form-group col-md-2">
                <?php 
                echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="showSections"');
                ?>
              </div>
            <div class="form-group col-md-2">
                <?php 
                echo form_dropdown('s_status_id', $status, $s_status_id,  'class="form-control"');
                ?>
              </div>
             <div class="form-group" class="col-md-3">
                <button type="submit" name="search" value="search" class="btn btn-theme">
                    <i class="fa fa-search">
                  </i> Search
                </button>
              </div>
            </div>
          </div>
         <?php echo form_close(); ?>     
            <?php
            if(@$result):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo $countResult?></h3>
            <div id="div_print">
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>College #</th>
                  <th>Name</th>
                  <th>Father name</th>
                  <th>Batch</th>
                  <th>Program</th>
                  <th>Sub program</th>
                  <th>section</th>
                  <th>Status</th>
                  <th>Add Amount</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                         $s_status_id = $resRow->s_status_id; 
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$resRow->college_no.'</td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->father_name.'</td>
                                <td>'.$resRow->batch.'</td>
                                <td>'.$resRow->programe_name.'</td>
                                <td>'.$resRow->subprogram.'</td>
                                <td>'.$resRow->sectionName.'</td>';
                          if($s_status_id == 5):      
                          echo '<td><span class="btn btn-theme btn-sm">'.$resRow->statusName.'<span></td>';
                            else:
                        echo '<td><span class="btn btn-danger btn-sm">'.$resRow->statusName.'<span></td>';
                        endif;
                  ?>
    <td><a class="btn btn-primary btn-sm" href="admin/add_student_security/<?php echo $resRow->student_id;?>">Add Security</a></td>
                   <?php
                    echo '</tr>';
                   $sn++;
                  endforeach;
                ?>
                
              </tbody>
</table></div>
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 