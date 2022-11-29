
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Inventory Items Report
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
          <li class="current">Inventory Items Report
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
            <?php
            $gres = $this->InventoryModel->get_by_ids('invt_items',array('itm_id'=>@$item_id));
            if($gres){
                foreach($gres as $grec)
                { ?> 
        <div class="form-group col-md-3">            
        <input type="text" name="item_id" class="form-control" value="<?php echo $grec->itm_name;?>" id="items">
        <input type="hidden" name="item_id" id="item_id" value="<?php echo $grec->itm_id; ?>">
                    </div>
                <?php 
                }      
            }else { ?>        
        <div class="form-group col-md-3">
           <input type="text" name="item_id" class="form-control" placeholder="Item Name" id="items">
           <input type="hidden" name="item_id" id="item_id">
        </div>
            <?php } ?>        
                <div class="form-group col-md-3">
            <input type="submit" name="submit" value="Search" class="btn btn-theme">
            <input type="submit" name="export" value="Export" class="btn btn-theme">
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
                    <th>S.no</th>
                    <th>Item Name</th>
                    <th>Item Short name</th>
                    <th>Quantity</th>
                    <th>Category Name</th>
                    <th>Type</th>
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
                    <td><?php
                    $str = strlen($urRow->itm_name);
                    if($str > 60):
                        echo substr($urRow->itm_name,0,60). '<span style="color:red"> ...</span>';
                    else:
                        echo $urRow->itm_name;
                    endif;
                ?></td>
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
                    <!--<td><a href="items/<?php echo $urRow->itm_id; ?>" class="productstatus"><span class="fa fa-book text-navy"></span></a></td>-->
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
 
 