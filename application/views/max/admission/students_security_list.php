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
            <h2 align="left">Students Security List<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
            <form method="post">
              <div class="form-group col-md-2">
            <input name="college_no" value="<?php if($college_no): echo $college_no;endif; ?>"type="text" class="form-control" placeholder="College No">
              </div>
              <div class="form-group" class="col-md-3">
                <button type="submit" name="search" value="search" class="btn btn-theme">
                    <i class="fa fa-search">
                  </i> Search
                </button>
              </div>    
            </form>
            <?php if(@$std_search):?>        
            <table class="table table-bordered table-striped display">
            <thead>
                 <tr>
                  <th>#</th>
                  <th>Picture</th>
                  <th>College #</th>
                  <th>Name</th>
                  <th>Father name</th>
                  <th>Sub program</th>
                  <th>section</th>
                  <th>Status</th>
                  <th>Add Security</th>
                </tr>
              </thead>
              <tbody>
                  <?php
          $sn = 1;
           foreach($std_search as $resRow):
            $s_status_id = $resRow->s_status_id; 
            $applicant_image = $resRow->applicant_image;      
              echo '<tr>
                        <td>'.$sn.'</td>';?>
                        <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="assets/images/students/user.png" width="60" height="60">
                    <?php
                    }else
                    {?>
    <img src="assets/images/students/<?php echo $applicant_image;?>" style="border-radius:10px;" width="60" height="60">
                <?php 
                    }
                    ?></td>
                    <?php echo '<td>'.$resRow->college_no.'</td>
                        <td>'.$resRow->student_name.'</td>
                        <td>'.$resRow->father_name.'</td>
                        <td>'.$resRow->subprogram.'</td>
                        <td>'.$resRow->sectionName.'</td>';
                  if($s_status_id == 5):      
                  echo '<td><span class="btn btn-theme btn-sm">'.$resRow->statusName.'<span></td>';
                    else:
                echo '<td><span class="btn btn-danger btn-sm">'.$resRow->statusName.'<span></td>';
                endif;
    $query = $this->CRUDModel->get_where_row('student_security',array('student_id'=>$resRow->student_id));
    if($query):              
        ?>
    <td><a class="btn btn-primary btn-sm disabled">Add Security</a></td>
    <?php else:?>
    <td><a class="btn btn-primary btn-sm" href="admin/add_student_security/<?php echo $resRow->student_id;?>">Add Security</a></td>              
                   <?php
                  endif;
                    echo '</tr>';
                   $sn++;
                  endforeach;
                ?>
            <?php
                endif;  
                  ?>
        <?php
            if(@$security):
        ?>
          
                 <?php
                        foreach($security as $rec):
                            $date = $rec->date;
                            $newDate = date("d-m-Y", strtotime($date));
                        ?>
                        <tr class="gradeA">
                            <td colspan="10" style="color:red">
                <span style="margin-right:10px;">Name: <?php echo $rec->student_name;?> (<?php echo $rec->college_no;?>),</span>
                <span style="margin-right:10px;">Gen. Security: <?php echo $rec->general_security;?>,</span>
                <span style="margin-right:10px;">Hostel Security: <?php echo $rec->hostel_security;?>,</span>
                <span style="margin-right:10px;">Exam Fee: <?php echo $rec->exam_fee;?>,</span>
                <span style="margin-right:10px;">Fines: <?php echo $rec->fines;?>,</span>
                <span style="margin-right:10px;">Others: <?php echo $rec->others;?>,</span>
                <span style="margin-right:10px;">Deductions: <?php echo $rec->deduction;?>,</span>
                <span style="margin-right:10px;">Refund: <?php echo $rec->total_refund;?>,</span>
                <span style="margin-right:10px;"> Date: <?php echo $newDate;?>,</span>
                <span style="margin-right:10px;"> Comments: <?php echo $rec->comments;?>.</span></td>
                        </tr>
                        <?php
                        endforeach;
                     endif; 
                  ?>
                  
              </tbody>
                </table>     
                  
                  <?php
            if(@$total_security):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records:<?php echo count($total_security)?>
            </button>
            </p>    
            <div id="div_print">
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Picture</th>
                  <th>Clg #</th>
                  <th>Name</th>
                  <th>Sub program</th>
                  <th>G.Security</th>
                  <th>H.Security</th>
                  <th>Exam Fee</th>
                  <th>Fines</th>
                  <th>Others</th>
                  <th>Deduction</th>
                  <th>Refund</th>
                  <th>Date</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($total_security as $resRow):
                        $applicant_image = $resRow->applicant_image; 
                        $date = $resRow->date;
                        $newDate = date("d-m-Y", strtotime($date));
                      echo '<tr>
                                <td>'.$sn.'</td>';?>
                        <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="assets/images/students/user.png" width="60" height="45">
                    <?php
                    }else
                    {?>
    <img src="assets/images/students/<?php echo $applicant_image;?>" style="border-radius:10px;" width="60" height="45">
                <?php 
                    }
                    ?></td>
                    <?php echo '<td>'.$resRow->college_no.'</td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->sub_program.'</td>
                                <td>'.$resRow->general_security.'</td>
                                <td>'.$resRow->hostel_security.'</td>
                                <td>'.$resRow->exam_fee.'</td>
                                <td>'.$resRow->fines.'</td>
                                <td>'.$resRow->others.'</td>
                                <td>'.$resRow->deduction.'</td>
                                <td><strong>'.$resRow->total_refund.'</strong></td>
                                <td>'.$newDate.'</td>';?>
                  <td><a class="btn btn-primary btn-sm" href="admin/update_student_security/<?php echo $resRow->security_id;?>">Edit</a></td>
                  <?php  echo '</tr>';
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
 
 