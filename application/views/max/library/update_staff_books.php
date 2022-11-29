<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              <h2 align="left">Staff Books Issuance List<hr></h2>
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
            <?php
            if(@$result):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
            
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>S#</th>
                    <th>Picture</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Issued Date</th>
                    <th>Update</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
                  foreach($result as $row):
                  $iss_id = $row->iss_id;
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
        <td><img src="assets/images/employee/<?php echo $row->picture;?>" width="50" height="40"></td>
                    <td><?php echo $row->emp_name;?></td>
                    <td><?php echo $row->designation;?></td>
                    <td><?php echo $row->issued_date;?></td>   
                <td><a href="javascript:valid(0)" id="<?php echo $row->iss_id.','.$row->emp_id;?>" class="staff_update"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Update</button></a></td>
                </tr>  
                  <?php
                  $i++;
                  endforeach;
                  ?>
              </tbody>
            </table>
            <?php
            else:
                echo '<strong style="color:red;font-size:18px;">Sorry ! Result not Found.. </strong>';
            endif;
                ?>
            </article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Staff Issuance Details Update</h4>
      </div>
      <div class="modal-body">
          <div id="staff_update_info">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>