

<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
            <h2 align="left">Building Block <span  style="float:right"><a href="InventoryController/add_block_area" class="btn btn-large btn-primary">Add New Block </a></span><hr></h2> 
            <form method="post">
                <div class="form-group col-md-2">
                    <input type="text" name="bb_id" placeholder="Block Name" class="form-control" id="block">
                   <input type="hidden" name="bb_id" id="bb_id" value="">
                </div>
                  <div class="form-group col-md-2">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
               </div>
            </form>
            <?php
//             echo '<pre>';print_r($buliding_block);die;
            if(@$buliding_block):
            ?>
<!--            <h3 class="has-divider text-highlight">Result :<?php // echo count(@$buliding_block)?></h3>-->
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                   <th >S.no</th>
                   <th>Title</th>
                   <th>Code</th>
                   <th>Plot Name</th>
                   <th>Total Rooms</th>
                   <th>No Of Seats</th>
                   <th>Total Area</th>
                   <th>Cover Area</th>
                   <th>Uncover Area</th>
                   <th>Comments</th>
                    <th>Manage</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach(@$buliding_block as $urRow):
                    
                      if($urRow->bb_status){$status="<a href='javascript:void(0)' class='groupId' id='".$urRow->bb_status.",".$urRow->bb_status."'><span class='fa fa-unlock text-navy'></span></a>";}else{$status="<a href='javascript:void(0)' class='productstatus' id='".$urRow->bb_status.",".$urRow->bb_status."'><span class='fa fa-unlock-alt text-danger'></span></a>";}
                      echo '<tr>
                                 <td>'.$sn.'</td>
                                <td>'.$urRow->bb_name.'</td>
                                <td>'.$urRow->bb_shortname.'</td>
                                <td>'.$urRow->plot_name.'</td>
                                <td>'.$urRow->no_of_rooms.'</td>
                                <td>'.$urRow->total_seats.'</td>
                                <td>'.$urRow->total_area.'</td>
                                <td>'.$urRow->cover_area.'</td>
                                <td>'.$urRow->remaining_area.'</td>
                                <td>'.$urRow->bb_comments.'</td>
                                <td>
                <a href="inventoryController/update_block_area/'.$urRow->bb_id.'" class="btn btn-theme btn-sm">Update</a> &nbsp;
                                
                                    </td>
                               
                              </tr>';
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
 