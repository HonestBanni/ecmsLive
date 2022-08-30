
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"> Work Orders List
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
          <li class="current">Work Order List
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
            <form method="post">
                <div class="form-group col-md-2">
            <input type="text" name="work_id" value="<?php if(@$work_id): echo $work_id;endif; ?>" placeholder="Work Order No." class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" name="issued_to" class="form-control" placeholder="Issued To" id="issuedto">
                   <input type="hidden" name="issued_to" id="issued_to" value="">
                </div>
                <div class="form-group col-md-2">
                   <input type="date" name="order_date" value="<?php if(@$order_date): echo $order_date;endif; ?>" class="form-control">
                </div>
                <div class="form-group col-md-2">
                   <select class="form-control" name="status">
                        <option value="">Select Status</option> 
                        <option value="1">Issued</option> 
                        <option value="2">Received</option> 
                   </select>
                </div>
                
                <div class="form-group col-md-2">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
               </div>
            </form>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Serial#</th>
                    <th>Work Order No</th>
                    <th>Order Date</th>
                    <th>Issued To</th>
                    <th>Status</th>
                    <th>GRN</th>
                    <th>View</th>
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
               foreach($result as $urRow):
                $status = $urRow->order_status;
                 
            $date = $urRow->order_date;
            $newDate = date("d-m-Y", strtotime($date)); 
                ?>
                  <tr>
                    <td><span class="label label-success label-icon-only"><?php echo $i; ?></span></td>
                    <td><?php echo $urRow->year; ?>/0<?php echo $urRow->work_id; ?></td>
                    <td><?php echo $newDate; ?></td>
                    <td><?php echo $urRow->sp_name; ?></td>
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
                <a class="btn btn-theme btn-sm" href="InventoryController/show_work_order_grn/<?php echo $urRow->work_id;?>">View GRN</a>
                        <?php   
                            }else{
                          ?>
            <a class="btn btn-info disabled btn-sm" href="#">Add GRN</a>
                      <?php
                            }
                          ?>
                      </td>
            <td><a class="btn btn-primary btn-sm" href="InventoryController/show_work_order/<?php echo $urRow->work_id;?>">View Work Order</a></td>

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
 
 