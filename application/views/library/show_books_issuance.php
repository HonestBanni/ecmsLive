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
                <h2 align="center">Student Books Issuance<hr></h2>
            
        <article class="contact-form col-md-12 col-sm-12">
                <?php
                if(@$book_issuance):
                    foreach($book_issuance as $row):
                    $issued_date = $row->issued_date;
                  $due_date = $row->due_date;
            $issuedDate = date("d-m-Y", strtotime($issued_date));
            $dueDate = date("d-m-Y", strtotime($due_date));
                ?>
    <div style="width:100%; height:50px;">
        <div style="width:32%; height:45px; float:left"><strong>Full Name: </strong> <?php echo $row->student_name;?></div>
        <div style="width:32%; height:45px;float:left"><strong>Father Name: </strong> <?php echo $row->father_name;?></div>
        <div style="width:32%; height:45px;float:right"><strong>College No: </strong> <?php echo $row->college_no;?></div>
    </div>
    <div style="width:100%; height:50px;">
    <div style="width:32%; height:45px; float:left"><strong>Issued Date: </strong> <?php echo $issuedDate;?></div>
        <div style="width:32%; height:45px; float:left"><strong>Due Date: </strong> <?php echo $dueDate;?></div>
        <div style="width:32%; height:45px; float:right"></div>  
            
    </div>    
                <?php
                    endforeach;
                endif;
                ?>
            <p style="font-size:18px; text-align:center"><u>Books Detail</u></p>
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display">
                <tr>
                    <td>Serial#</td>
                    <td>Book Name</td>
                    <td>Acccession #</td>
                    <td>Status</td>
                </tr>
                <?php
              $i = 1;
               foreach($result as $urRow):             
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $urRow->book_title; ?></td>
                    <td><?php echo $urRow->accession_no; ?></td>
                    <td><?php echo $urRow->title; ?></td>
                </tr>
                <?php
              $i++;
              endforeach;
            ?> 
            </table>
              
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
 
 