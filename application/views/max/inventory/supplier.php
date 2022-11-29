
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
            <h2 align="left">Suppliers  List<span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New supplier</a></span><hr></h2>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Serial No. </th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
               foreach($result as $urRow):      
                ?>
                  <tr>
                    <td><span class="label label-success label-icon-only"><?php echo $i; ?></span></td>   
                    <td><?php echo $urRow->sp_name; ?></td>   
                    <td><?php echo $urRow->phone; ?></td>   
                    <td><?php echo $urRow->address; ?></td>   
                       
                    <?php
                    $check_po = $this->db->get_where('invt_purchase_order', array('issued_to'=>$urRow->sp_id))->row();
                    $check_wo = $this->db->get_where('invt_work_order', array('issued_to'=>$urRow->sp_id))->row();
                    if($check_wo || $check_po):
                    ?>
                        <td><a class="btn btn-info btn-sm">Update</a></td>
                        <td>Supplier in-use</td> 
                        
                        <?php else: ?>
                        <td><a class="btn btn-info btn-sm" href="inventoryController/update_supplier/<?php echo $urRow->sp_id; ?>">Update</a></td>
                        <td><a class="btn btn-danger btn-sm" href="inventoryController/delete_supplier/<?php echo $urRow->sp_id; ?>" onclick="return confirm('Are you Sure to Delete this ?')">Delete</a></td>
                        <?php endif; ?>  
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
 <div class="modal fade" id="adding" role="dialog" style="z-index:9999">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New supplier</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>InventoryController/add_supplier">

                    <div class="control-group">
                        <label class="control-label" for="basicinput">supplier Name</label>
                        <div class="controls">
                            <input type="text"  name="title" placeholder="Name Required" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Phone</label>
                        <div class="controls">
                            <input type="text"  name="phone" placeholder="Phone" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Address</label>
                        <div class="controls">
                            <input type="text"  name="address" placeholder="Address" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" value="Add Record" class="btn btn-primary pull-center">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 