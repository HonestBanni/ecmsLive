
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">GRN Items List
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
          <li class="current">GRN Items List
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
            <form method="post" action="InventoryController/add_grn">
                <?php
                if(@$purchase_order):
                    foreach($purchase_order as $row):
                    $authorized_by = $row->authorized_by;
                $q = $this->db->query("SELECT * FROM hr_emp_record WHERE emp_id = '$authorized_by'");
                foreach($q->result() as $rec);
                ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group col-md-3">
                    <lable>Purchase Order ID</lable>
                    <input value="<?php echo $row->year;?>/0<?php echo $row->po_id;?>" class="form-control" readonly>
                    <input type="hidden" name="po_id" value="<?php echo $row->po_id;?>">
                    <input type="hidden" name="year" value="<?php echo $row->year;?>">
                </div>
                <div class="form-group col-md-3">
                    <lable>GRN No.</lable>
                    <?php
                        $grn_no = $this->db->query("SELECT * FROM invt_grn");
                        $a = $grn_no->num_rows();
                        $b = 1;
                        $total = $a+$b;
                        
                    ?>
                    <input value="#0<?php echo $total; ?>" class="form-control" readonly>
                </div>
                <div class="form-group col-md-3">
                    <lable>Purchase Order Date</lable>
                    <?php
                    $date = $row->order_date;
                $newDate = date("d-m-Y", strtotime($date));
                ?>
            <input name="order_date" value="<?php echo $newDate;?>" class="form-control" readonly>
                </div>
                <div class="form-group col-md-3">
                    <lable>Issued By</lable>
                    <input name="issued_by" value="<?php echo $row->issued_title;?>" class="form-control" readonly>
                </div>
                <div class="form-group col-md-3">
                    <lable>Supplier</lable>
                    <input name="issued_to" value="<?php echo $row->sp_name;?>" class="form-control" readonly>
                    <input type="hidden" name="sp_id" value="<?php echo $row->sp_id;?>">
                </div>
                <div class="form-group col-md-3">
                    <lable>Ship To</lable>
                    <input name="ship_to" value="<?php echo $row->ship_name;?>" class="form-control" readonly>
                </div>
                <div class="form-group col-md-3">
                    <lable>Prepared By</lable>
                    <input name="prepared_by" value="<?php echo $row->emp_name;?>" class="form-control" readonly>
                </div>
                <div class="form-group col-md-3">
                    <lable>Authorized By</lable>
                    <input name="authorized_by" value="<?php echo $rec->emp_name;?>" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-3">
                    <lable>Delivered Date</lable>
            <input type="text" name="grn_date" class="form-control date_format_d_m_yy" required>
                </div>
                <div class="form-group col-md-3">
                    <lable>This Delivery</lable>
                    <select class="form-control" name="delivery_status">
                        <?php
                        $st = $this->db->query("SELECT * FROM invt_delivery_status");
                        foreach($st->result() as $srow){
                        ?>
                            <option value="<?php echo $srow->id;?>"><?php echo $srow->del_status;?></option>
                        <?php 
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <lable>Goods Received &amp; Delivered By </lable>
                    <select name="goods_rec_del_by" class="form-control">
                   <?php
          $prep = $this->db->query("SELECT * FROM hr_emp_record WHERE emp_name LIKE '%Shah Mahmood Khan%'");
                    foreach($prep->result() as $preps){
                            ?>
                            <option value="<?php echo $preps->emp_id?>"><?php echo $preps->emp_name?> (Administrative Officer)</option>
                            <?php
                                }
                        ?>
                    </select>
                </div> 
                <div class="form-group col-md-3">
                    <lable>Delivered By</lable>
                    <select name="received_by" class="form-control">
                        <?php
                $prep = $this->db->query("SELECT * FROM hr_emp_record WHERE emp_name LIKE '%kamran%'");
                foreach($prep->result() as $preps){
                        ?>
    <option value="<?php echo $preps->emp_id?>"><?php echo $preps->emp_name?> (Superintendent)</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <lable>Received By</lable>
    <input type="text" name="final_received_by" id="final_receive" placeholder="Received By" class="form-control" required>
    <input type="hidden" name="final_received_by" id="final_received_by">
                </div>
            </div>
        </div>
                <?php
                    endforeach;
                endif;
                ?>
            
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Brand</th>
                    <th>Price/Quantity</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>GRN Details:</th>
                    <th>Item Name</th>
                    <th>Price/Quantity</th>
                    <th>Total Quantity</th>
                </tr>
              </thead>
          <tbody>
              <?php
               foreach($result as $urRow):
                $status = $urRow->status;                
                ?>
                  <tr>
                    <td><?php echo $urRow->itm_name; ?></td>
                    <td><?php echo $urRow->brand_id; ?></td>
                    <td><?php echo $urRow->price; ?></td>
                    <td><?php echo $urRow->quantity; ?></td>
                    <td><?php echo $urRow->total_price; ?></td>
                    <td></td>
                    <td><input type="text" value="<?php echo $urRow->itm_name; ?>">
                        <input type="hidden" name="item_id[]" value="<?php echo $urRow->itm_id; ?>">
                      </td>
                    <td><input type="text" name="price[]" value="<?php echo $urRow->price; ?>"></td>
                    <td><input type="text" name="quantity[]" value="<?php echo $urRow->quantity; ?>"></td>
                  </tr>
              <?php
              endforeach;
            ?>           
          </tbody>
            </table>
                <div class="form-group col-md-3">
                    <input type="submit" name="submit" value="Add GRN" class="btn btn-theme">
                </div>
                </form>
            </article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 