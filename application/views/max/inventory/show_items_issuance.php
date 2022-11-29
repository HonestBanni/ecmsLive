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
                <h2 align="center">Items Issuance<hr></h2>
            
        <article class="contact-form col-md-12 col-sm-12">
                <?php
                if(@$item_issuance):
                    foreach($item_issuance as $row):
                    $date = $row->issuance_date;
            $newDate = date("d-m-Y", strtotime($date));
                ?>
    <div style="width:100%; height:50px;">
        <div style="width:32%; height:45px; float:left"><strong>Full Name: </strong> <?php echo $row->emp_name;?></div>
        <div style="width:32%; height:45px;float:left"><strong>Designation: </strong> <?php echo $row->design;?></div>
        <div style="width:32%; height:45px;float:right"><strong>Department: </strong> <?php echo $row->department;?></div>
    </div>
    <div style="width:100%; height:50px;">
        <div style="width:32%; height:45px; float:left"><strong>Dated: </strong> <?php echo $newDate;?></div>
        <div style="width:32%; height:45px; float:left"><strong>Issuance Department: </strong> <?php echo $row->dept_name;?></div>
        <div style="width:32%; height:45px; float:right"></div>  
            
    </div>    
                <?php
                    endforeach;
                endif;
                ?>
            <p style="font-size:18px; text-align:center"><u>Requirements Details</u></p>
            <table width="80%" border="1" align="center" style="margin-bottom:80px;">
                <tr>
                    <td>Serial#</td>
                    <td>Item Name</td>
                    <td>Quantity</td>
                </tr>
                <?php
              $i = 1;
               foreach($result as $urRow):             
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $urRow->itm_name; ?></td>
                    <td><?php echo $urRow->quantity; ?></td>
                </tr>
                <?php
              $i++;
              endforeach;
            ?> 
            </table>
              
        <p> 
            <span style="margin-left:30px; float:left">
                <strong>Signature: ...............................................</strong>
            </span>
            <span style="margin-right:30px; float:right">
                <strong>Admin Officer: ...............................................</strong>
            </span>
            
        </p>   <br/><?php echo $print_log;?> 
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
 
 