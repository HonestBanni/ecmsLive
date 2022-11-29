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
                
                <h2 align="center">Purchase / Work Order</h2>
                <article class="contact-form col-md-12 col-sm-12">
                     <?php
                if(@$purchase_order):
                    foreach($purchase_order as $row):
                    $date = $row->order_date;
            $newDate = date("d-m-Y", strtotime($date));
                        ?>
    <div style="width:100%; height:45px;">
        <div style="width:32%; height:45px; float:left">
            <strong><strong>PO ID:</strong> <?php echo $row->year;?>/<?php echo $row->po_id;?>
        </div>
        <div style="width:22%; height:45px;float:left">
            <strong>Date:</strong> <?php echo $newDate;?>
        </div>
        <div style="width:42%; height:45px;float:right">
            <strong>Issued By:</strong> <?php echo $row->issued_title;?>
        </div>
    </div>  
    <div style="width:100%; height:45px;">
        <div style="width:32%; height:45px; float:left">
            <strong><strong>Issued To:</strong> <?php echo $row->sp_name;?>
        </div>
        <div style="width:32%; height:45px;float:left">
            <strong>Address:</strong> <?php echo $row->address;?>
        </div>
        <div style="width:32%; height:45px;float:right">
            <strong>Phone:</strong> <?php echo $row->phone;?>
        </div>
    </div>  
    <div style="width:100%; height:45px;">
        <div style="width:32%; height:45px; float:left">
            <strong>Ship To:</strong> <?php echo $row->ship_name;?>
        </div>
        <div style="width:64%; height:45px;float:left">
            <strong>Additional Terms &amp; Conditions:</strong> The Items Should be in Accordance with the Specifications.
        </div>
    </div>    
 
                <?php
                    endforeach;
                endif;
                ?>
            <table width="95%" border="1" align="center" style="margin-bottom:10px;">
              <thead>
                <tr align="center">
                    <td><strong>Item #</strong></td>
                    <td><strong>Item Name</strong></td>
                    <td>Brand</td>
                    <td>Quantity</td>
                    <td>Unit Cost</td>
                    <td>Total Cost</td>
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
              $grandTotal = '';
               foreach($result as $urRow):
                $status = $urRow->status;               
                ?>
                  <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $urRow->itm_name; ?></td>
                    <td><?php echo $urRow->brand_id; ?></td>
                    <td><?php echo $urRow->quantity; ?></td>
                    <td><?php echo $urRow->price; ?></td>
                    <td><?php echo $urRow->total_price; ?></td>    
                  </tr>
              <?php
              $i++;
               $grandTotal += $urRow->total_price;
              endforeach;
              
            ?>   
                   <tr style="color:green; font-size:16px"  align="center">
                    <td colspan="5">Grand Total </td>
                    <td><?php echo round($grandTotal,1); ?></td>    
                  </tr>
          </tbody>
            </table>
    <div style="width:100%; height:80px;">
        <div style="width:96%; height:80px; float:left">
            <strong><u>Prepared By:</u></strong><br> 
                <strong>Name:</strong> <?php echo $row->emp_name;?><br>
                <strong>Position:</strong><?php echo $row->title;?><br><br>
                <strong>Signature: ..........................</strong>
        </div>
    </div>
    <div style="width:100%; height:40px;">
        <div style="width:35%; height:40px; float:left">
        </div>
        <div style="width:32%; height:40px; float:left">
            <u><strong>Authorized By</strong></u><br>
        </div>
        <div style="width:20%; height:40px; float:left">
        </div>
    </div>
    <div style="width:100%; height:80px;">
        <div style="width:58%; height:80px; float:left">
            <?php
         $authorized_by = $row->authorized_by;
        $gres = $this->InventoryModel->get_by_id('hr_emp_record',array('emp_id'=>$authorized_by));
        if($gres){
            foreach($gres as $grec){ 
             $authorized =  $grec->emp_name;  
                $desg =  $grec->title;  
            ?> 
                <strong>Name:</strong> <?php echo $authorized;?><br>
                <strong>Position:</strong> <?php echo $desg;?><br><br>
                <strong>Signature: ..........................</strong>
              <?php 
            }
        }
        
        
            ?>
        </div>
        <div style="width:38%; height:80px; float:left">
                <strong>Name:</strong> <?php echo $DirectorFinance?><br>
                <strong>Position:</strong>Director Finance<br><br>
                <strong>Signature: ..........................</strong>
        </div>
    </div> 
    <div style="width:100%; height:80px;">
        <div style="width:96%; height:80px; float:left"> 
                <strong>Name:</strong><?php echo $VpAdmin?><br>
            <strong>Position:</strong>Vice Principal-2 (<small>Convener Purchase Committee</small>)<br><br>
                <strong>Signature: ..........................</strong>
        </div>
    </div> <?php   $print_log;?>   
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
 
 