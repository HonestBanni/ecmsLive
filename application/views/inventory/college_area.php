
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
            <h2 align="left">College Total Area<span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add Area</a></span><hr></h2>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Serial No. </th>
                    <th>Name</th>
                    <th>Total Area</th>
                    <th>Covered Area</th>
                    <th>Uncovered Area</th>
                    <th>Update</th>
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
               foreach($result as $urRow):      
                ?>
                  <tr>
                    <td><span class="label label-success label-icon-only"><?php echo $i; ?></span></td>   
                    <td><?php echo $urRow->col_name; ?></td>   
                    <td><?php echo $urRow->col_total_area; ?></td>   
                    <td><?php echo $urRow->col_cover_area; ?></td>   
                    <td><?php echo $urRow->col_remaining_area; ?></td>  
                    <td><a class="btn btn-theme btn-sm" href="inventoryController/update_college_area/<?php echo $urRow->col_id; ?>">Update</a></td>      
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
                <h4 class="modal-title">Add Area</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>InventoryController/add_college_area">

                    <div class="control-group">
                        <label class="control-label" for="basicinput">Name</label>
                        <div class="controls">
                            <input type="text"  name="col_name" placeholder="Name Required" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Total Area</label>
                        <div class="controls">
                            <input type="text"  name="col_total_area" placeholder="Total Area" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Covered Area</label>
                        <div class="controls">
                            <input type="text"  name="col_cover_area" placeholder="Covered Area" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Covered Area</label>
                        <div class="controls">
                            <input type="text"  name="col_remaining_area" placeholder="Remaining Area" data-original-title="" class="span8 tip form-control">
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
 