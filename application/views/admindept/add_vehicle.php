<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Add New Vehicle
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
          <li class="current">Add New Vehicle
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
 		<form method="post">
           <div class="form-group col-md-3">
            <label>Registration #</label>
            <input type="text" name="reg_no" class="form-control" placeholder="Registration #">
            </div>
            <div class="form-group col-md-3">
            <label>Chassis #</label>
            <input type="text" name="chassis_no" class="form-control" placeholder="Chassis #">
            </div>
            <div class="form-group col-md-3">
            <label>Model</label>
            <input type="text" name="model" class="form-control" placeholder="Model">
            </div>
            <div class="form-group col-md-3">
            <label>Color</label>
            <input type="text" name="color" class="form-control" placeholder="Color">
            </div> 
            <div class="form-group col-md-3">
            <label>Engine #</label>
            <input type="text" name="engine_no" class="form-control" placeholder="Engine #">
            </div>    
            <div class="form-group col-md-3">
            <label>Vehicle Status</label>
            <select class="form-control" name="veh_status_id">
                <?php
                    $f = $this->db->query("SELECT * FROM vehicle_status"); 
                foreach($f->result() as $rec):
                ?>
                <option value="<?php echo $rec->veh_status_id;?>"><?php echo $rec->status_name;?></option>
                <?php endforeach;?>
            </select>
          </div>
 
          <div class="form-group col-md-6">
            <label>Make &amp; Maker</label>
            <input type="text" name="make_maker" class="form-control" placeholder="Make and Maker">
          </div>
        <div class="form-group col-md-3">
            <label>Price</label>
            <input type="text" name="price" class="form-control" placeholder="Price">
          </div>
        <div class="form-group col-md-3">
            <label>Under Used</label>
            <input type="text" name="under_used" class="form-control" placeholder="Under Used">
          </div>
        <div class="form-group col-md-6">
            <label>Comments</label>
            <input type="text" name="comments" class="form-control" placeholder="comments">
          </div>
          <div class="form-group col-md-3">
            <input style="margin-top:23px" type="submit" name="submit" class="btn-primary btn">
          </div>        
</form>
   </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
