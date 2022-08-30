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
            <input type="text" name="reg_no" class="form-control" value="<?php echo $result->registration_no;?>">
            <input type="hidden" name="vehicle_id" value="<?php echo $this->uri->segment(3);?>">
            </div>
            <div class="form-group col-md-3">
            <label>Chassis #</label>
            <input type="text" name="chassis_no" class="form-control" value="<?php echo $result->chassis_no;?>">
            </div>
             
            <div class="form-group col-md-3">
            <label>Engine #</label>
            <input type="text" name="engine_no" class="form-control" value="<?php echo $result->engine_no;?>">
            </div>
            <div class="form-group col-md-3">
            <label>Color</label>
            <input type="text" name="color" class="form-control" value="<?php echo $result->color;?>">
            </div>
            <div class="form-group col-md-3">
            <label>Model</label>
            <input type="text" name="model" class="form-control"  value="<?php echo $result->model;?>">
            </div>
            <div class="form-group col-md-3">
            <label>Vehicle Status</label>
            <select class="form-control" name="veh_status_id">
                <option value="<?php echo $result->veh_status_id;?>"><?php echo $result->status_name;?></option>
                <option value="">Select New Status</option>
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
            <input type="text" name="make_maker" class="form-control" value="<?php echo $result->make_and_maker;?>">
          </div>
        <div class="form-group col-md-3">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="<?php echo $result->price;?>">
          </div>
        <div class="form-group col-md-3">
            <label>Under Used</label>
            <input type="text" name="under_used" class="form-control" value="<?php echo $result->under_used;?>">
          </div>
          <div class="form-group col-md-6">
            <label>Comments</label>
            <input type="text" name="comments" class="form-control" value="<?php echo $result->comments;?>">
          </div>
          <div class="form-group col-md-3">
            <input style="margin-top:23px" type="submit" value="Update" name="submit" class="btn-primary btn">
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
