
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Items
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
          <li class="current">Items
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
    
         <?php
                
                $messge = $this->session->flashdata('items_name');
             
                if(!empty($messge)):
                echo     '    <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                '.$messge.'
               
            </div>'; 
                endif;
 
                    ?>
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                            
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12">
                
                <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'name',
                    'id'            => 'item_name',
                    'class'         => 'form-control',
                    'value'         => $itemName,
                    'placeholder'   => 'Items Name',
                    ));
                    ?>
                </div>
                
                <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'srtname',
                    'id'            => 'srtnameId',
                    'class'         => 'form-control',
                    'value'         => $shortName,
                    'placeholder'   => 'Item short Name',
                    ));
                    ?>
                </div>
                
                <div class="form-group">
                   <?php 
                   echo form_dropdown('cat_id', $invt_category, $categoryId,  'class="form-control" id="cat_id"');
                   ?>
                 </div>
                <div class="form-group">
                   <?php 
                   echo form_dropdown('asst_type_id', $asst_type, $itemType,  'class="form-control" id="asst_type_id"');
                   ?>
                 </div>
                     <div class="form-group">
                   <?php 
                   echo form_dropdown('catm_id', $invt_main_category, $mainCategoryId,  'class="form-control" id="cat_id"');
                   ?>
                 </div>
           
                <?php 
                if(@$result):
                     
                echo '<div class="form-group">';
                $statusArray = array(
                    '0'=>'Lock',
                    '1'=>'UnLock'
                    );
                echo form_dropdown('status',$statusArray, $itemStatus,  'class="form-control" id="my_id"');
                echo '</div>';
                endif;
            
                ?>
              
              <!--//form-group-->
              <div class="form-group">
                  <button type="submit" name="Search" value="Search" class="btn btn-theme">
                    <i class="fa fa-search"></i> Search
                </button>
              </div>
              <!--//form-group-->
              <div class="form-group">
                  <button type="button" class="btn btn-primary" name="add" id="Additm" value="Add" data-toggle="modal" data-target="#addItem" ><i class="fa fa-plus"></i> Add Item</button>
              </div>
            </div>
          </div>

         <?php echo form_close(); ?>     
            <?php
            if(@items):
                if(@$pages):
                    echo @$pages;
                else:
                    echo '<h3 class="has-divider text-highlight">Result : '.count(@$items).'</h3>';
                endif;
            ?>

            <?php  ?>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th width="5%">S No.</th>
                    <th width="25%">Item Name</th>
                    <th width="10%">Item Short name</th>
                    <th width="10%">Main Category</th>
                    <th width="10%">Category Name</th>
                    <th width="10%">Type</th>
                    <th width="10%">Comments</th>
                    <th width="5%">Status</th>
                    <th width="5%">Manage</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                 
                   foreach(@$items as $urRow):
                    
                      if($urRow->itm_status){$status="<a href='javascript:void(0)' class='groupId' id='".$urRow->itm_status.",".$urRow->itm_status."'><span class='fa fa-unlock text-navy'></span></a>";}else{$status="<a href='javascript:void(0)' class='productstatus'><span class='fa fa-unlock-alt text-danger'></span></a>";}
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->itm_name.'</td>
                                <td>'.$urRow->itm_shortname.'</td>
                                <td>'.$urRow->main_cat_name.'</td>  
                                <td>'.$urRow->category_name.'</td>
                                <td>'.$urRow->asset_type.'</td>  
                                <td>'.$urRow->itm_comments.'</td>
                                <td>'.$status.'</td>';
                      
                                $check_cid = $this->db->get_where('invt_consumable_item_details', array('cid_itemId'=>$urRow->itm_id))->row();
                                $check_fid = $this->db->get_where('invt_fixed_item_details', array('fid_itemId'=>$urRow->itm_id))->row();
                                $check_grn = $this->db->get_where('invt_grn_details', array('item_id'=>$urRow->itm_id))->row();
                                $check_iad = $this->db->get_where('invt_items_assuance_details', array('item_id'=>$urRow->itm_id))->row();
//                                if($check_cid || $check_fid || $check_grn || $check_iad):
//                                    echo '<td>Item in-use</td>';
//                                else:
                                    echo '<td><a id="'.$urRow->itm_id.'" class="btn btn-primary btn-sm updateItem" data-toggle="modal" data-target="#updateItem">EDIT</a>
                                        </td>';
//                                endif;
                            echo '</tr>';
                   $sn++;
                  
                  endforeach;
                ?>
                  
              </tbody>
            </table>
            <?php
            echo @$pages; 
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
 
 <!--Insert Database Users updateUsers -->
 
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="Database Users">
        <div class="modal-dialog" role="document">
            <?php echo form_open('',array('class'=>'course-finder-form','id'=>'add_item_form'));?>    
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New Item</h4>
          </div>

          <div class="modal-body">


              <div class="row">
                  <div class="col-md-12">
                      <div class="col-md-12 col-sm-5 form-group">
                          <label for="name">Item Name</label>
                          <input type="text" name="item_name" value="" id="name" class="form-control">

                      </div>

                      <div class="col-md-12 col-sm-5 form-group">
                          <label for="short_name">Short Name</label>
                          <input type="text" name="short_name"  id="short_name" class="form-control">
                      </div>


                      <div class="col-md-12 col-sm-5 form-group">
                          <label for="name">Main Category</label>
                          <?php echo form_dropdown('main_category', $invt_main_category, '', array('class'=>'form-control', 'id'=>'main_category')); ?>
                      </div>

                      <div class="col-md-12 col-sm-5 form-group">
                          <label for="name">Item Category</label>
                          <?php echo form_dropdown('item_category', $invt_category, '', array('class'=>'form-control', 'id'=>'item_category')); ?>
                      </div>

                      <div class="col-md-12 col-sm-5 form-group">
                          <label for="name">Asset Type</label>
                          <?php echo form_dropdown('item_asset_type', $asst_type, '', array('class'=>'form-control', 'id'=>'item_asset_type')); ?>
                      </div>

                  </div>
                  <div class="col-md-8" style="margin-left: 21px;">
                      <div id="error_message" >

                      </div>
                  </div>
              </div>


              </div>
              <div class="modal-footer">
              <button type="button" name="insert_item" value="insert_item" id="insert_item" class="btn btn-theme" >Save User</button>
              <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
              </div>

            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
 
 
 <!--Update user database-->
                <div class="modal fade" id="updateItem" tabindex="-1" role="dialog" aria-labelledby="Database Users">
                    <div class="modal-dialog" role="document">
                          <?php echo form_open('UserUpdate',array('class'=>'course-finder-form','id'=>'update_item_form'));?>    
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Update Items</h4>
                        </div>
                          
                        <div class="modal-body">
                            <div id="itemUpdateShow">
                                
                            </div>

                        </div>
                        <div class="modal-footer">
                        <button type="button" name="update_item"    value="update_item" id="update_item" class="btn btn-theme" >Update</button>
                        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                        </div>
                          
                      </div>
                         <?php echo form_close(); ?>
                    </div>
                  </div>

<script type="text/javascript">

    jQuery(document).ready(function(){
        jQuery('#insert_item').on('click',function(){
            jQuery.ajax({
                type:'post',
                url : 'InventoryController/insert_inventory_item',
                data: jQuery('#add_item_form').serialize(),
                success:function(result){
                    if(result == true){
                        window.location.reload();
                    }
                    else{
                        jQuery('#error_message').show();
                        jQuery('#error_message').html(result);
                    }
                }
            });      
        });
      
        jQuery('#update_item').on('click',function(){
           jQuery.ajax({
                type:'post',
                url : 'InventoryController/invt_item_update',
                data: jQuery('#update_item_form').serialize(),
                success:function(result){
                    jQuery('#up_error_message').html(result);
                    window.location.reload();
                }
            });
        });
        
        jQuery('.updateItem').on('click',function(){
            var item_id = this.id;
             jQuery.ajax({
                type:'post',
                url : 'InventoryController/get_item_update_info',
                data: {'item_id':item_id},
                success:function(result){
//                    jQuery('#error_message').show();
                    jQuery('#itemUpdateShow').html(result);
                }
            });
        });
    });
  
  </script>