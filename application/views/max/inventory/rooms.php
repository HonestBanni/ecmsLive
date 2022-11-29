
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                            
            <h2 align="left">Rooms List <span  style="float:right"><a href="InventoryController/add_room" class="btn btn-large btn-primary">Add New Room </a></span><hr></h2>
            <form method="post">
                <div class="form-group col-md-2">
                    <input type="text" name="bb_id" placeholder="Block Name" class="form-control" id="block">
                   <input type="hidden" name="bb_id" id="bb_id" value="">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" name="rm_id" placeholder="Room Name" class="form-control" id="room">
                   <input type="hidden" name="rm_id" id="rm_id" value="">
                </div>
                  <div class="form-group col-md-2">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
               </div>
            </form>
            <?php
            if(@invt_room):
            ?>
<!--            <h3 class="has-divider text-highlight">Result :<?php // echo count(@$invt_room)?></h3>-->
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>S.no</th>
                    <th>Room Name</th>
                    <th>Short Name</th>
                    <th>Total Area</th>
                    <th>Block Name</th>
                    <th>Comments</th>
                    <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach(@$invt_room as $urRow):
                    
                      if($urRow->rm_status){$status="<a href='javascript:void(0)' class='groupId' id='".$urRow->rm_status.",".$urRow->rm_status."'><span class='fa fa-unlock text-navy'></span></a>";}else{$status="<a href='javascript:void(0)' class='productstatus' ><span class='fa fa-unlock-alt text-danger'></span></a>";}
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->rm_name.'</td>
                                <td>'.$urRow->rm_shortname.'</td>
                                <td>'.$urRow->room_total_area.'</td>
                                <td>'.$urRow->bb_name.'</td>
                                <td>'.$urRow->rm_comments.'</td>
                                <td>
                                <a href="InventoryController/update_room/'.$urRow->rm_id.'" class="btn btn-theme btn-sm">Update</a> &nbsp;
                                
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