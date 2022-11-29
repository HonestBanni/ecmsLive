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
               <!-- ******BANNER****** -->
            <h2 align="left">Students Security List<span  style="float:right"><a href="studentSecurity" class="btn btn-large btn-primary">Add Student Security</a></span><hr></h2>
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
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records:<?php echo count($result)?>
            </button>
            </p>    
            <div id="div_print">
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>College #</th>
                  <th>Name</th>
                  <th>Batch</th>
                  <th>Sub program</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Comments</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                        $date = $resRow->date;
                        $newDate = date("d-m-Y", strtotime($date));
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$resRow->college_no.'</td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->batch_name.'</td>
                                <td>'.$resRow->sub_program.'</td>
                                <td>'.$resRow->amount.'</td>
                                <td>'.$newDate.'</td>
                                <td>'.$resRow->comments.'</td>';
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
 
 