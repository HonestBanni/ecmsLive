
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Items Issuance List
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
          <li class="current">Items Issuance List
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
           <form method="post">
                <div class="form-group col-md-2">
                    <label>Employee Name</label>
                    <input type="text" name="prepared_by" class="form-control" id="emp_names">
                   <input type="hidden" name="prepared_by" id="prepared_by" value="">
                </div>
                <div class="form-group col-md-2">
                    <label>Issuance Date</label>
                   <input type="date" name="issuance_date" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <input style="margin-top:20px;" type="submit" name="search" class="btn btn-theme" value="Search">
               </div>
            </form>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Employee</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Issuance Date</th>
                    <th>Issuance Department</th>
                    <th>View Issued Items</th>
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
              foreach($result as $row):
              $date = $row->issuance_date;
            $newDate = date("d-m-Y", strtotime($date));
              $ass_id = $row->ass_id;
              ?>
              <tr>
                    <td><span class="label label-success label-icon-only"><?php echo $i; ?></span></td>
                    <td><?php echo $row->emp_name;?></td>
                    <td><?php echo $row->desg;?></td>
                    <td><?php echo $row->department;?></td>
                    <td><?php echo $newDate;?></td>
                    <td><?php echo $row->dept_name;?></td>
                    <td><a class="btn btn-theme btn-sm" href="InventoryController/view_items_issuance/<?php echo $row->ass_id;?>">View Issued Items</a></td>
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
 
 