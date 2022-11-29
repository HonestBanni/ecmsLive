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
                <h2 align="center">Tour/Event Students List<hr></h2>
            
        <article class="contact-form col-md-12 col-sm-12">
                <?php
                $start_date = $tour->start_date;
                $back_date = $tour->back_date;
                $startDate = date("d-m-Y", strtotime($start_date));
                $backDate = date("d-m-Y", strtotime($back_date));
                ?>
    <div style="width:100%; height:50px;">
        <div style="width:32%; height:45px; float:left">
            <strong>T/E Title: </strong> <?php echo $tour->tour_title;?></div>
        <div style="width:32%; height:45px;float:left">
            <strong>T/E Location: </strong> <?php echo $tour->location;?></div>
        <div style="width:32%; height:45px;float:right">
            <strong>Staff Incharge: </strong> <?php echo $tour->emp_name;?> (<?php echo $tour->title;?>)
        </div>
    </div>
    <div style="width:100%; height:50px;">
        <div style="width:32%; height:45px; float:left">
            <strong>T/E Date From: </strong> <?php echo $startDate;?>
        </div> 
        <div style="width:32%; height:45px; float:left">
            <strong>T/E Date To: </strong> <?php echo $backDate;?>
        </div>
        <div style="width:32%; height:45px; float:left">
            <strong>T/E Total Days: </strong> <?php echo $tour->tdays;;?>
        </div>       
    </div>    
               
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display">
                <tr>
                    <td>Serial#</td>
                    <td>Student Picture</td>
                    <td>Student Name</td>
                    <td>Father Name</td>
                    <td>College #</td>
                    <td>Program</td>
                    <td>Sub Program</td>
                    <td>T/E Date From</td>
                    <td>T/E Date To</td>
                    <td>T/E Total Days</td>
                </tr>
                <?php
              $i = 1;
               foreach($result as $urRow):
                    $datef = $urRow->datefrom;
                    $datet = $urRow->dateto;
                    $stDate = date("d-m-Y", strtotime($datef));
                    $bkDate = date("d-m-Y", strtotime($datet));
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="assets/images/students/<?php echo $urRow->applicant_image; ?>" width="50" height="30"></td>
                    <td><?php echo $urRow->student_name; ?></td>
                    <td><?php echo $urRow->father_name; ?></td>
                    <td><?php echo $urRow->college_no; ?></td>
                    <td><?php echo $urRow->programe_name; ?></td>
                    <td><?php echo $urRow->name; ?></td>
                    <td><?php echo $stDate;?></td>
                    <td><?php echo $bkDate;?></td>
                    <td><?php echo $urRow->tsdays;?></td>
                </tr>
                <?php
              $i++;
              endforeach;
            ?> 
            </table>
             <?php echo $print_log;?>    
<!--
        <p> 
            <span style="margin-left:30px; float:left">
                <strong>Signature: ...............................................</strong>
            </span>
            <span style="margin-right:30px; float:right">
                <strong>Admin Officer: ...............................................</strong>
            </span>
        </p>    
-->
            </article>
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
 
 