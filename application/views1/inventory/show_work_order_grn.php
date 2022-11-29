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
            
                <h2 align="center">Work Order Received Note<hr></h2>
        <article class="contact-form col-md-12 col-sm-12">
                <?php
                if(@$grn_order):
                    foreach($grn_order as $row):
                     $date = $row->grn_date;
                $newDate = date("d-m-Y", strtotime($date));
                ?>
    <div class="table-responsive">
        <table width="100%">
          <tbody>
            <tr style="height:44px;">
                <td colspan="2"><strong>GRN#:</strong> 0<?php echo $row->grn_id;?></td>  
    <td colspan="2"><strong>Work Order ID:</strong> <?php echo $row->year;?>/<?php echo $row->work_id;?></td>
                <td colspan="2"><strong>Date:</strong> <?php echo $newDate;?></td>  
            </tr>
            <tr style="height:44px;">
                <td colspan="2"><strong>Delivery Location:</strong> <?php echo $row->issued_title;?></td>  
                <td colspan="2"><strong>Supplie Name:</strong> <?php echo $row->sp_name;?></td>
                <td colspan="2"><strong>Supplier Address:</strong> <?php echo $row->address;?></td>  
            </tr>
            <tr style="height:44px;">
                <td colspan="2"><strong>Supplier Contact#:</strong> <?php echo $row->phone;?></td>  
            <td colspan="2"><strong>This Delivery:</strong> <?php echo $row->del_status;?></td>  
            </tr>  
          </tbody>  
        </table>
       <br>
               
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Item #</th>
                    <th>Item Description</th>
                    <th>Days</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Total Cost</th>
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
              $grandTotal = '';
              $grn_id = $row->grn_id;
              $this->db->select('*'); 
              $this->db->FROM('invt_work_order_grn_details');
        $this->db->where('invt_work_order_grn_details.grn_id',$grn_id);
        $query =  $this->db->get();
               foreach($query->result() as $urRow):      
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $urRow->item_name; ?></td>
                    <td><?php echo $urRow->days; ?></td>
                    <td><?php echo $urRow->quantity; ?></td>
                    <td><?php echo $urRow->price; ?></td>
                    <td><?php echo $urRow->total_price; ?></td>    
                  </tr>
              <?php
              $i++;
             $grandTotal += $urRow->total_price;
              endforeach;
              
            ?>   
                   <tr style="color:green; font-size:16px">
                      <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Grand Total </td>
                    <td><?php echo $grandTotal; ?></td>    
                  </tr>         
          </tbody>
            </table><br>
        <table width="80%">
            <tbody>
                <tr style="margin-right:20px;">
                    <td colspan="2"><u><strong>Received and Delivered By</strong></u><br>
                    (Name): <?php echo $row->emp_name;?> <br>
                    (Title):      <?php echo $row->title;?><br><br>
                    Signature: ..........................</td>
                    <td>
        <?php
        $received_by = $row->received_by;            
        $gres = $this->InventoryModel->get_by_id('hr_emp_record',array('emp_id'=>$received_by));
if($gres){
foreach($gres as $grec){ 
     $received =  $grec->emp_name;  
        $desg =  $grec->title;
        ?>
                    <u><strong>Delivered By</strong></u><br>
                    (Name): <?php echo $received;?><br>
                    (Title):      <?php echo $desg;?><br><br>
                    Signature: ..........................
                    <?php
}
}
                    ?></td>
                    <td>
        <?php
        $final_received_by = $row->final_received_by;            
        $gres = $this->InventoryModel->get_by_id('hr_emp_record',array('emp_id'=>$final_received_by));
if($gres){
foreach($gres as $grec){ 
     $fineal_received =  $grec->emp_name;  
        $final_desg =  $grec->title;
        ?>
                    <u><strong>Received By</strong></u><br>
                    (Name): <?php echo $fineal_received;?><br>
                    (Title):      <?php echo $final_desg;?><br><br>
                    Signature: ..........................
                    <?php
}
}
                    ?></td>
                </tr>
            </tbody>
        </table> 
            <br>
            <div class="form-group col-md-8 col-sm-8">
                <p style="text-align:center"><strong>Note:</strong> Separate Delivery Reports must be Prepared for Individual Suppliers or Orders.</p>
            </div>
            </article>
          <?php
                    endforeach;
                endif;
                ?>
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
 
 