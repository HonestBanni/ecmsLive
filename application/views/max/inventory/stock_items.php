
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Stock Items Adjustment
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
          <li class="current">Stock Items Adjustment
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7"> 
            <form name="postitem" method="post">
            <div class="row">
                <div class="col-md-12">
                <div class="form-group col-md-3">
                   <input type="text" name="itm_name" placeholder="Item Name" class="form-control">
                </div>   
                <div class="form-group col-md-3">
            <input type="submit" name="search" value="Search" class="btn btn-theme">
                </div>    
                </div>
           </div>
                </form>
            <?php
            if(@items):
            ?>
            <p><button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$items)?></button></p>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th width="5%">S.no</th>
                    <th width="40%">Item Name</th>
                    <th width="10%">Item Short name</th>
                    <th width="10%">Quantity</th>
                    <th width="10%">Category Name</th>
                    <th width="10%">Type</th>
                    <th width="10%">Item details</th>
                    <th width="5%">Manage</th>
                </tr>
              </thead>
          <tbody>
              <?php
              $sn = 1;
               foreach(@$items as $urRow):
                $quantity = $urRow->item_quantity;
                ?>
                  <tr>
                    <td><span class="label label-success label-icon-only"><?php echo $sn; ?></span></td>
                    <td><?php echo $urRow->itm_name; ?></td>
                    <td><?php echo $urRow->itm_shortname; ?></td>
                      <td><?php 
                        if($quantity == 0)
                        {
                            echo '<span style="color:red">'.$quantity.'</span>'; 
                        }else
                        echo $quantity;
                        ?></td> 
                      <td><?php echo $urRow->at_name; ?></td>
                    <td><?php echo $urRow->cat_name; ?></td>
                      
                    <td><?php echo $urRow->itm_details; ?></td> 
            <td><a class="btn btn-info btn-sm" href="InventoryController/update_item/<?php echo $urRow->itm_id; ?>">Edit Item</a></td> 
                  </tr>
              <?php
               $sn++;
              endforeach;
            ?>           
          </tbody>
            </table>
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 