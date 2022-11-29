<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              <h2 align="left">Publishers  List<span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add Publisher</a></span><hr></h2>
            <?php
            if(@$publishers):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$publishers);?>
            </button>
            </p>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Publisher Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Fax</th>
                    <th>Address</th>
                    <th colspan="2">Manage</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  foreach($publishers as $row):
                  ?>
                <tr>
                    <td><?php echo $row->pub_name;?></td>
                    <td><?php echo $row->phone;?></td>
                    <td><?php echo $row->email;?></td>
                    <td><?php echo $row->fax;?></td>
                    <td><?php echo $row->address;?></td>
            <td><a href="LibraryController/update_publisher/<?php echo $row->pub_id;?>">Update</a></td>
            <td><a href="LibraryController/delete_publisher/<?php echo $row->pub_id;?>" onclick="return confirm('Are you Want to Delete..?')">Delete</a></td>
                </tr>
                  <?php
                  endforeach;
                  ?>
              </tbody>
            </table>
            <?php
            else:
                echo "Records Not Found..";
            endif;
                ?>
            </article>
          </article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
 <div class="modal fade" id="adding" role="dialog" style="z-index:9999">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Publisher</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>LibraryController/add_publisher">

    <div class="control-group">
        <label class="control-label" for="basicinput">Publisher Name</label>
        <div class="controls">
            <input type="text"  name="pub_name" placeholder="Name Required" data-original-title="" class="span8 tip form-control" required>
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
    <div class="control-group">
        <label class="control-label" for="basicinput">Email</label>
        <div class="controls">
            <input type="text"  name="email" placeholder="Email" data-original-title="" class="span8 tip form-control">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="basicinput">Fax #</label>
        <div class="controls">
            <input type="text"  name="fax" placeholder="Fax" data-original-title="" class="span8 tip form-control">
        </div>
    </div>
    <br>
    <div class="control-group">
        <div class="controls">
            <input type="submit" name="submit" value="Add Publisher" class="btn btn-primary pull-center">
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
 