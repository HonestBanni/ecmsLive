<?php
foreach($result as $row)
{
    
}
?>
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Update Items
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
          <li class="current">Update Items
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">             
            <form name="postitem" method="post" action="InventoryController/update_item/<?php echo $row->itm_id;?>">
            <div class="row">
                <div class="col-md-12">
                <div class="form-group col-md-3">
                    <lable>Item Name</lable>
                    <input type="text" name="itm_name" value="<?php echo $row->itm_name;?>" class="form-control">
                    <input type="hidden" name="itm_id" value="<?php echo $row->itm_id;?>">
                    <input type="hidden" name="log_itm_name" value="<?php echo $row->itm_name;?>">
                </div>
                <div class="form-group col-md-3">
                    <lable>Item Short Name</lable>
                   <input type="text" name="itm_shortname" value="<?php echo $row->itm_shortname;?>" class="form-control">
                   <input type="hidden" name="log_itm_shortname" value="<?php echo $row->itm_shortname;?>">
                </div>   
                 <div class="form-group col-md-3">
                    <lable>Category</lable>
                    <input type="hidden" name="log_itm_catId" value="<?php echo $row->at_id;?>">
                    <select name="itm_catId" class="form-control">
                        <option value="<?php echo $row->at_id;?>"><?php echo $row->at_name;?></option>
                        <option value="">Select Category</option>
                        <?php
                            $lab = $this->db->query("SELECT * FROM invt_assets_type");
                            foreach($lab->result() as $labs){
                        ?>
                        <option value="<?php echo $labs->at_id?>"><?php echo $labs->at_name?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <lable>Asset</lable>
                    <input type="hidden" name="log_itm_asstId" value="<?php echo $row->cat_id;?>">
                    <select name="itm_asstId" class="form-control">
                        <option value="<?php echo $row->cat_id;?>"><?php echo $row->cat_name;?></option>
                        <option value="">Select Asset</option>
                        <?php
                            $lab = $this->db->query("SELECT * FROM invt_category");
                            foreach($lab->result() as $labs){
                        ?>
                        <option value="<?php echo $labs->cat_id?>"><?php echo $labs->cat_name?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div> 
                <div class="form-group col-md-3">
                    <lable>Item Quantity</lable>
                    <input type="hidden" name="log_item_quantity" value="<?php echo $row->item_quantity;?>">
                    <input type="text" name="item_quantity" value="<?php echo $row->item_quantity;?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <lable>Item Details</lable>
                    <input type="text" name="itm_details" value="<?php echo $row->itm_details;?>" class="form-control">
                    <input type="hidden" name="log_itm_details" value="<?php echo $row->itm_details;?>">
                </div>    
                <div class="form-group col-md-3">
                    <lable>Item Comment</lable>
                    <input type="text" name="itm_comments" value="<?php echo $row->itm_comments;?>" class="form-control">
                    <input type="hidden" name="log_itm_comments" value="<?php echo $row->itm_comments;?>">
                    <input type="hidden" name="log_time" value="<?php echo $row->itm_timestamp;?>">
                    <input type="hidden" name="log_user_id" value="<?php echo $row->itm_userId;?>">
                </div> 
                <div class="form-group col-md-3">
            <input type="submit" name="submit" value="Update" class="btn btn-theme">
                </div>    
                </div>
           </div>
                </form>
       
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
 
 