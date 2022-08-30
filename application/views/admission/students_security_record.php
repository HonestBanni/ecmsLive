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
              <div class="form-group col-md-3">
            <label for="usr">From Date:</label>
            <input type="text" name="from_date" value="<?php echo $from_date?>" class="form-control date_format_d_m_yy"> 
            </div>
            <div class="form-group col-md-3">
            <label for="usr">To Date:</label>
            <input type="text" name="to_date" value="<?php echo $to_date?>" class="form-control date_format_d_m_yy"> 
            </div>
              <div class="form-group" class="col-md-6">
                <button style="margin-top:23px;" type="submit" name="search" value="search" class="btn btn-theme">
                    <i class="fa fa-search">
                  </i> Search
                </button>
                <button style="margin-top:23px;" type="submit" name="export" value="export" class="btn btn-theme">
                    <i class="fa fa-print">
                  </i> Export
                </button>  
              </div>
               
            </form>
                </div>  
                  <?php
            if(@$result):
            ?>
            <div class="col-md-12">    
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
                  <th>Picture</th>
                  <th>College #</th>
                  <th>Name</th>
                  <th>Sub Program</th>
                  <th>Section</th>
                  <th>G.Security</th>
                  <th>H.Security</th>
                  <th>Exam Fee</th>
                  <th>Fines</th>
                  <th>Other</th>
                  <th>Deduction</th>
                  <th>Refund</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                        $applicant_image = $resRow->applicant_image; 
                        $date = $resRow->date;
                        $newDate = date("d-m-Y", strtotime($date));
                      echo '<tr>
                                <td>'.$sn.'</td>';?>
                        <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="assets/images/students/user.png" width="60" height="40">
                    <?php
                    }else
                    {?>
    <img src="assets/images/students/<?php echo $applicant_image;?>" style="border-radius:10px;" width="60" height="40">
                <?php 
                    }
                    ?></td>
                    <?php echo '<td>'.$resRow->college_no.'</td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->sub_program.'</td>
                                <td>'.$resRow->sectionName.'</td>
                                <td>'.$resRow->general_security.'</td>
                                <td>'.$resRow->hostel_security.'</td>
                                <td>'.$resRow->exam_fee.'</td>
                                <td>'.$resRow->fines.'</td>
                                <td>'.$resRow->others.'</td>
                                <td>'.$resRow->deduction.'</td>
                                <td>'.$resRow->total_refund.'</td>
                                <td>'.$newDate.'</td>';?>
                  <?php  echo '</tr>';
                   $sn++;
                  endforeach;
                ?>
                
              </tbody>
</table></div>
            <?php
            else:
                echo '<h4 class="has-divider text-highlight">No query found..</h4>';
            endif;
            ?>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
  <!--//content-->
 
 