<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body><p></p>";
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
      <div class="page-content">
      <div class="row">
     <h2 align="left"><span  style="float:right">
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
              </span></h2>
        <div id="div_print"> 
            <div class="table-responsive">
                
        <?php if(@$result):?>    
        <article class="contact-form col-md-12 col-sm-12"> 
        
        <div style="width:100%; height:110px;margin-bottom:2px;">
            <div style="width:48%; height:110px; float:left">
                <img style="border-radius:5px;margin-left:50px;" width="260" height="110" class='img-responsive' src='assets/images/logo.png'>
            </div>
        </div>   
    <p style="font-size:18px; text-align:center"><u>Department: <?php echo $dept_data->title;?></u></p>
            <table class="table table-boxed table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S#</th>
                        <th>Book Name</th>
                        <th>Acc #</th>
                        <th>Issued Date</th>
                        <th>Issued Department</th>
                    </tr>
                </thead>
                <tbody>
                <?php
              $i = 1;
               foreach($result as $urRow): 
                $issued_date = $urRow->issued_date; 
                $issuedDate = date("d-m-Y", strtotime($issued_date));
                $date2 = new DateTime(date('Y-m-d'));    
                    
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $urRow->book_title; ?></td>
                    <td><?php echo $urRow->accession_no; ?></td>
                    <td><?php echo $issuedDate; ?></td>
                    <td><?php echo $urRow->title; ?></td>
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
 
 