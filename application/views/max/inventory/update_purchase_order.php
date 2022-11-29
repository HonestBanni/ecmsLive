
<div class="content container">
  <div class="page-wrapper">
      <div class="page-content">
      <div class="row">
     <h2 align="left"></h2>
        <div id="div_print"> 
            <div class="table-responsive">
                
                <h2 align="center">Purchase / Work Order</h2>
                <article class="contact-form col-md-12 col-sm-12">
                     <?php
                if(@$purchase_order):
                    foreach($purchase_order as $row):
                        ?>
    <div style="width:100%; height:45px;">
        <div style="width:32%; height:45px; float:left">
            <strong>PO ID:</strong> <?php echo $row->year;?>/<?php echo $row->po_id;?>
        </div>
        <div style="width:22%; height:45px;float:left">
            <?php
                $date = $row->order_date;
                $newDate = date("d-m-Y", strtotime($date));
                ?>
            <strong>Date:</strong> <?php echo $newDate;?>
        </div>
        <div style="width:42%; height:45px;float:right">
            <strong>Issued By:</strong> <?php echo $row->issued_title;?>
        </div>
    </div>  
    <div style="width:100%; height:45px;">
        <div style="width:32%; height:45px; float:left">
            <strong>Issued To:</strong> <?php echo $row->sp_name;?>
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
        <form name="postitem" method="post" action="InventoryController/update_purchase_order_item">
            <div class="row">
                <div class="col-md-12">
                 <div class="form-group col-md-3">
                     <input type="text" name="item_id" class="form-control" id="items" placeholder="Item Name">
                   <input type="hidden" name="item_id" id="item_id" value="">
                   <input type="hidden" name="po_id" value="<?php echo $row->po_id;?>">
                </div>
                <div class="form-group col-md-3">
        <input type="text" name="brand_id" class="form-control" id="brand_id" placeholder="Item Brand">
                </div> 
                <div class="form-group col-md-2">
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" name="price" id="price" placeholder="Price" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <input type="submit" name="add_value" value="Add Item" class="btn btn-theme">
                    <input type="submit" name="save" value="Save" class="btn btn-theme">
                </div>
        <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis');
                echo md5($rand.$date);

                ?>">            
                </div>
           </div>
                </form>
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display">
              <thead>
                <tr align="center">
                    <td><strong>Item #</strong></td>
                    <td><strong>Item Name</strong></td>
                    <td>Brand</td>
                    <td>Quantity</td>
                    <td>Unit Cost</td>
                    <td>Total Cost</td>
                    <td>Delete</td>
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
                    <td><?php echo $urRow->total_price; ?></td><td><a class="btn btn-danger btn-sm" href="InventoryController/delete_purchase_order_item/<?php echo $urRow->purchase_order_id;?>/<?php echo $row->po_id;?>" onclick="return confirm('Are You Want To Delete this...?')">Delete</a></td>    
                  </tr>
              <?php
              $i++;
               $grandTotal += $urRow->total_price;
              endforeach;
              
            ?>   
                   <tr style="color:green; font-size:16px"  align="center">
                     
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Grand Total </td>
                    <td><?php echo $grandTotal; ?></td> 
                    <td></td>   
                  </tr>
          </tbody>
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
 
 