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

<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
      <div class="page-content">
      <div class="row">
     <h2 align="left"><span  style="float:right">
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
              </span></h2>
        <div id="div_print"> 
            <div class="table-responsive">
                <h2 align="center"><strong>Student Issued Books</strong><hr></h2>
        <?php if(@$result):?>    
        <article class="contact-form col-md-12 col-sm-12"> 
        
        <div style="width:100%; height:110px;margin-bottom:50px;">
            <div style="width:48%; height:110px; float:left">
                <img style="border-radius:5px;margin-left:50px;" width="100" height="100" class='img-responsive' src='assets/RQ/library_rq/<?php echo $std_rq->rq_image;?>'>
            </div>
            <div style="width:48%; height:110px;float:left">
                <img style="border-radius:5px;margin-left:50px;" width="80" height="60" class='img-responsive' src='assets/images/students/<?php echo $student_data->applicant_image;?>'>
            </div>
        </div>
        <div style="width:100%; height:50px;">
            <div style="width:48%; height:45px; float:left"><strong style="font-size:15px">Full Name: <?php echo $student_data->student_name;?></strong></div>
            <div style="width:48%; height:45px;float:left"><strong style="font-size:15px">Father Name: <?php echo $student_data->father_name;?></strong></div>
        </div>
        <div style="width:100%; height:50px;">    
            <div style="width:48%; height:45px;float:left"><strong style="font-size:15px">College No: <?php echo $student_data->college_no;?></strong></div>
            <div style="width:48%; height:45px;float:left"><strong style="font-size:15px">Sub Program: <?php echo $student_data->name;?></strong></div>
        </div>
    <p style="font-size:18px; text-align:center"><u>Books Reminder</u></p>
            <table class="table table-boxed table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S#</th>
                        <th>Book Name</th>
                        <th>Acccession #</th>
                        <th>Issued Date</th>
                        <th>Due Date </th>
                        <th>Over Due Book</th>
                        <th>Fine</th>
                    </tr>
                </thead>
                <tbody>
                <?php
              $i = 1;
               foreach($result as $urRow): 
                $status_id = $urRow->availability_status_id;    
                $issued_date = $urRow->issued_date; 
                $due_date = $urRow->due_date; 
                $issuedDate = date("d-m-Y", strtotime($issued_date));
                $dueDate = date("d-m-Y", strtotime($due_date));
                    
                $date1 = new DateTime($due_date);
                $date2 = new DateTime(date('Y-m-d'));    
                    
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $urRow->book_title; ?></td>
                    <td><?php echo $urRow->accession_no; ?></td>
                    <td><?php echo $issuedDate; ?></td>
                    <td><?php echo $dueDate; ?></td>
                    <td style="color:red"><?php 
                        if($date2 > $date1):
                            $interval = $date2->diff($date1);
                            echo $interval->d." days ";
                        else: echo '----';
                        endif;    
                        ?>
                    </td>
                    <td>
                        <?php
                        if($date2 > $date1):
                            $interval = $date2->diff($date1);
                            $days_fine = $interval->d * 5;
                            echo "Rs.".$days_fine;
                        else: echo ' ---- ';
                        endif; ?>
                    </td>
                </tr>
                <?php
              $i++;
              endforeach;
            ?> 
                    </tbody>
            </table>
            </article>
                <?php 
            else: echo '<strong style="color:red;font-size:18px;">Sorry ! Result not Found.. </strong>'; endif;?>
            </div>
          </div>
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 