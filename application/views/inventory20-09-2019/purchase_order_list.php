
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Purchase / Work Order List
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Purchase Order List
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
          <h2 align="right"><a href="<?php echo base_url();?>InventoryController/purchase_order" class="btn btn-large btn-primary">Add Purchase Order</a></h2>
        <article class="contact-form col-md-12 col-sm-7">
            <form method="post">
                <div class="form-group col-md-2">
                    <label>PO Number</label>
            <input type="text" name="po_id" value="<?php if(@$po_id): echo $po_id;endif; ?>" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Issued To</label>
                    <input type="text" name="issued_to" class="form-control" id="issuedto">
                   <input type="hidden" name="issued_to" id="issued_to" value="">
                </div>
                <div class="form-group col-md-2">
                    <label>Purchase order Date</label>
                   <input type="date" name="order_date" value="<?php if(@$order_date): echo $order_date;endif; ?>" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Status</label>
                   <select class="form-control" name="status">
                        <option value="">Select Status</option> 
                        <option value="1">Issued</option> 
                        <option value="2">Received</option> 
                   </select>
                </div>
                  <div class="form-group col-md-2">
                    <input style="margin-top:20px;" type="submit" name="search" class="btn btn-theme" value="Search">
               </div>
            </form>
            <table class="table table-boxed table-hover table-bordered">
              <thead>
                <tr>
                    <th>S #</th>
                    <th width="90">PO No</th>
                    <th width="80">Order Date</th>
                    <th  width="100">Issued To</th>
                    <th>Order Items List</th>
                    <th>Status</th>
                    <th>GRN</th>
                    <th>View</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
              </thead>
          <tbody>
              <?php
               $i = 1;
               foreach($result as $urRow):
                $status = $urRow->order_status;
             
              $date = $urRow->order_date;;
            $newDate = date("d-m-Y", strtotime($date)); 
                ?>
                  <tr>
                      <td><span class="label label-success label-icon-only"><?php echo $i; ?></span></td>
                    <td><?php echo $urRow->year; ?>/<?php echo $urRow->po_id; ?></td>
                    <td><?php echo $newDate; ?></td>
                    <td><?php echo $urRow->sp_name; ?></td>
                    <td><?php 
                $po_id = $urRow->po_id;
                $where = array('invt_purchase_order_details.order_id'=>$po_id);
                $item = $this->InventoryModel->get_po_items('invt_purchase_order_details', $where);
                $c = count($item);        
                $s = "";        
                $sn = 1;        
                foreach($item as $rRow):
                $s ++;
                if($c == $s):        
                    echo '<span style="color:red">'.$sn.')</span> ' .$rRow->itm_name;
                else:
                    echo '<span style="color:red">'.$sn.')</span> ' .$rRow->itm_name . ' , ';
                endif;
                $sn++;        
                endforeach;                
                  ?></td>  
                    <td><?php 
                            if($status == 1)
                            {    
                                echo "Issued";
                            }
                            else
                            {
                                echo "Received";
                            }
                        ?>
                      </td>
                      <td>
                          <?php
                            if($status == 2){
                        ?>
                <a class="btn btn-theme btn-sm" href="InventoryController/show_grn_items/<?php echo $urRow->po_id;?>">View GRN</a>
                        <?php   
                            }else{
                          ?>
            <a class="btn btn-info btn-sm" href="InventoryController/grn/<?php echo $urRow->po_id;?>">Add GRN</a>
                      <?php
                            }
                          ?>
                      </td>
            <td><a class="btn btn-primary btn-sm" href="InventoryController/show_po_items/<?php echo $urRow->po_id;?>">View PO</a></td>
            <td>
                <?php
                 if($status == 1){
                        ?>
                <a class="btn btn-warning btn-sm" href="InventoryController/update_purchase_order/<?php echo $urRow->po_id;?>">Update</a>
                       <?php
                            }else{
                          ?>
                 <a class="btn btn-warning disabled btn-sm" href="">Update</a>
                <?php
                 }
                ?>
                      </td>          
            <td>
                <?php
                 if($status == 1){
                        ?>
                <a class="btn btn-danger btn-sm" href="InventoryController/delete_purchase_order/<?php echo $urRow->po_id;?>" onclick="return confirm('Are You Want to Delete...?')">Delete</a>
                       <?php
                            }else{
                          ?>
                 <a class="btn btn-danger disabled btn-sm" href="" onclick="return confirm('Are You Want to Delete...?')">Delete</a>
                <?php
                 }
                ?>
                      </td>
                  </tr>
              <?php
              $i++;
              endforeach;
            ?>           
          </tbody>
            </table>
            </article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 