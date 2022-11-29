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
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   
            <?php
            if(@$result):
            ?>
            <p>
            <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
            </p>
     
        <div id="div_print">       
            
              <h2 align="center">Vehicles List<hr></h2>
    <table class="table table-boxed">
        <thead>
            <tr>
            <th>S/No</th>
            <th>Registration #</th>
            <th>Chassis #</th>
            <th>Model</th>
            <th>Color</th>
            <th>Engine #</th>
            <th>Make &amp; Maker</th>
            <th>Price</th>
            <th>Status</th>
            <th>Under Used</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
            $status_name = $row->status_name;
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row->registration_no;?></td>
            <td><?php echo $row->chassis_no;?></td>
            <td><?php echo $row->model;?></td>
            <td><?php echo $row->color;?></td>
            <td><?php echo $row->engine_no;?></td>
            <td><?php echo $row->make_and_maker;?></td>
            <td><?php echo $row->price;?></td> 
            <td><?php echo $status_name;?></td>       
             <td><?php echo $row->under_used;?></td> 
        </tr>
            <?php 
            $i++;
                endforeach;
            ?>
        </tbody>
    </table>
            <?php
             echo $print_log;
            else:
                echo "Records Not Found..";
            endif;
           
                ?>
            </div>
</article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
