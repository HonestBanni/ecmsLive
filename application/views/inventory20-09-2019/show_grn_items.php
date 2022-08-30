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
              </span>
    </h2>
        <div id="div_print"> 
            <div class="table-responsive">
                <h2 align="center">Goods Received Note<hr></h2>
                <article class="contact-form col-md-12 col-sm-12">
                     <?php
               if(@$grn_order):
                    foreach($grn_order as $row):
                    $date = $row->grn_date;
            $newDate = date("d-m-Y", strtotime($date));
                        ?>
    <div style="width:100%; height:45px;">
        <div style="width:32%;height:45px;float:left;">
            <strong>GRN ID:</strong>  0<?php echo $row->grn_id;?>
        </div>
        <div style="width:26%; height:45px;float:left">
            <strong>PO ID:</strong> <?php echo $row->year;?>/<?php echo $row->po_id;?>
        </div>
        <div style="width:41%; height:45px;float:right">
            <strong>Date:</strong> <?php echo $newDate;?>
        </div>
    </div>  
    <div style="width:100%; height:45px;">
        <div style="width:32%; height:45px; float:left">
            <strong>Delivery Location:</strong> <?php echo $row->issued_title;?>
        </div>
        <div style="width:26%; height:45px;float:left">
            <strong>Supplier Name:</strong> <?php echo $row->sp_name;?>
        </div>
        <div style="width:41%; height:45px;float:right">
            <strong>Supplier Address:</strong> <?php echo $row->address;?>
        </div>
    </div>  
    <div style="width:100%; height:45px;">
        <div style="width:32%; height:45px; float:left">
            <strong>Supplier Contact#:</strong> <?php echo $row->phone;?>
        </div>
        <div style="width:64%; height:45px;float:left">
            <strong>This Delivery:</strong> <?php echo $row->del_status;?>
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
                    <td><strong>Brand</strong></td>
                    <td><strong>Quantity</strong></td>
                    <td><strong>Unit Cost</strong></td>
                    <td><strong>Total Cost</strong></td>
                </tr>
              </thead>
          <tbody>
             <?php
              $i = 1;
              $grandTotal = '';
              $grn_id = $row->grn_id;
                $this->db->select('*'); 
                $this->db->FROM('invt_grn_details');
                $this->db->join('invt_items','invt_items.itm_id=invt_grn_details.item_id','left outer');
                $this->db->where('invt_grn_details.grn_id',$grn_id);
        $query =  $this->db->get();
               foreach($query->result() as $urRow):      
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
                   <tr style="color:green; font-size:16px" align="center">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Grand Total </td>
                    <td><?php echo round($grandTotal,1); ?></td>    
                  </tr>
          </tbody>
            </table><br>
        <div style="width:100%; height:80px;">
            <div style="width:33%; height:100px; float:left;padding-left:30px;">
                    <strong><u>Received and Delivered By</u></strong><br>
                    <strong>(Name):</strong> <?php echo $row->emp_name;?><br>
                    <strong>(Title):</strong> <?php echo $row->title;?><br><br>
                    <strong>Signature: .......................................</strong>
            </div>
            <div style="width:33%; height:100px; float:left;padding-left:30px;">
                <?php
        $received_by = $row->received_by;            
        $gres = $this->InventoryModel->get_by_id('hr_emp_record',array('emp_id'=>$received_by));
            if($gres){
            foreach($gres as $grec){ 
                $received =  $grec->emp_name;  
                $desg =  $grec->title;
                ?>
                    <strong><u>Delivered By</u></strong><br>
                    <strong>(Name:) </strong> <?php echo $received;?><br>
                    <strong>(Title) :</strong> <?php echo $desg;?><br><br>
                    <strong>Signature: .......................................</strong>
            <?php        
                }
            }
           ?>    
            </div>
            <div style="width:33%; height:80px; float:left;padding-left:30px;">
                    <?php
                        $final_received_by = $row->final_received_by;            
                        $gres = $this->InventoryModel->get_by_id('hr_emp_record',array('emp_id'=>$final_received_by));
                if($gres){
                foreach($gres as $grec){ 
                     $fineal_received =  $grec->emp_name;  
                        $final_desg =  $grec->title;
        ?>
                    <strong><u>Received By</u></strong><br>
                    <strong>(Name): </strong><?php echo $fineal_received;?><br>
                    <strong>(Title) :</strong><?php echo $final_desg;?><br><br>
                    <strong>Signature: .......................................</strong>
                        <?php
                        }
                    }
                    ?>
            </div>
        </div><br><br>
        <div style="width:100%">
        <p style="float:left;margin-left:120px;"><strong>Note:</strong> Separate Delivery Reports must be Prepared for Individual Suppliers or Orders.</p>
         
        </div>  <br/><?php echo $print_log;?>          
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
 
 