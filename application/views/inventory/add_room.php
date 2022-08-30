
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    
    <div class="page-content">
      <div class="row">
          <h2 align="left">Add Room<hr></h2> 
        <article class="contact-form col-md-12 col-sm-7">             
            <form name="postitem" method="post" action="InventoryController/add_room">
            <div class="row">
                <div class="col-md-12">
                <div class="form-group col-md-3">
                    <lable>Room Name: </lable>
        <input type="text" name="rm_name" placeholder="Name Required" class="form-control">
                </div>
            <div class="form-group col-md-3">
                    <lable>Room Short Name: </lable>
        <input type="text" name="rm_shortname" placeholder="Short Name Required" id="rm_shortname" class="form-control">
                </div>
        <div class="form-group col-md-3">
            <lable>Block Name </lable>
            <select class="form-control" name="rm_bbId">
                <option value="">Select Block</option>
               <?php
                    $col = $this->db->query("SELECT * FROM invt_building_block");
                    foreach($col->result() as $row){
                    ?>
                        <option value="<?php echo $row->bb_id;?>"><?php echo $row->bb_name;?></option>
                    <?php
                    }
                    ?>
            </select>          
        </div>      
        <div class="form-group col-md-3">
            <lable>Room Total Area: </lable>
            <input type="text" name="room_total_area" placeholder="Total Area" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <lable>Comments: </lable>
            <input type="text" name="rm_comments" placeholder="Comments" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <input style="margin-top:19px;" type="submit" name="submit" class="btn btn-theme">
        </div>             
                </div>
           </div>
                </form>
            </article>
          <article class="contact-form col-md-12 col-sm-7">
            
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
 
 