
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    
    <div class="page-content">
      <div class="row">
          <h2 align="left">Add Block<hr></h2> 
        <article class="contact-form col-md-12 col-sm-7">             
            <form name="postitem" method="post" action="InventoryController/add_block_area">
            <div class="row">
                <div class="col-md-12">
                <div class="form-group col-md-3">
                    <lable>Block Name: </lable>
        <input type="text" name="bb_name" placeholder="Block Name" class="form-control">
                </div>
            <div class="form-group col-md-3">
                    <lable>Block Short Name: </lable>
        <input type="text" name="bb_shortname" id="bb_shortname" placeholder="Short Name Required" class="form-control">
                </div>
        <div class="form-group col-md-3">
            <lable>Plot Name </lable>
            <select class="form-control" name="plot_id">
                <option value="">Select Plot</option>
               <?php
                    $col = $this->db->query("SELECT * FROM invt_plot_area");
                    foreach($col->result() as $row){
                    ?>
                        <option value="<?php echo $row->plot_id;?>"><?php echo $row->plot_name;?></option>
                    <?php
                    }
                    ?>
            </select>          
        </div>      
        <div class="form-group col-md-3">
            <lable>Total Area: </lable>
            <input type="text" name="total_area" placeholder="Total Area" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <lable>Covered Area: </lable>
            <input type="text" name="cover_area" placeholder="Covered Area" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <lable>Uncovered Area: </lable>
            <input type="text" name="remaining_area" placeholder="Uncovered Area" class="form-control">
        </div> 
        <div class="form-group col-md-3">
            <lable>Comments: </lable>
            <input type="text" name="comments" placeholder="Comments" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <input type="submit" name="submit" class="btn btn-theme">
        </div>             
                </div>
           </div>
                </form>
            </article>
          <article class="contact-form col-md-12 col-sm-7">
            <div id="itemsIssuance">
              
            </div>
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
 
 