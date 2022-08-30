
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Stock Balance Report
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
          <li class="current">Stock Balance Report
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
           <form method="post">
               <div class="col-md-12">
                <?php
            $gres = $this->InventoryModel->get_by_ids('invt_items',array('itm_id'=>@$item_id));
            if($gres){
                foreach($gres as $grec)
                { ?> 
        <div class="form-group col-md-3">            
        <input type="text" name="item_id" class="form-control" value="<?php echo $grec->itm_name;?>" id="items">
        <input type="hidden" name="item_id" id="item_id" value="<?php echo $grec->itm_id; ?>">
                    </div>
                <?php 
                }      
            }else { ?>        
        <div class="form-group col-md-3">
           <input type="text" name="item_id" class="form-control" placeholder="Item Name" id="items">
           <input type="hidden" name="item_id" id="item_id">
        </div>
            <?php } ?> 
                <div class="form-group col-md-2">
                   <input type="date" name="issuance_date" value="<?php if(@$issuance_date): echo $issuance_date; endif;?>" class="form-control">
                </div>
                <?php
            $gres = $this->InventoryModel->get_by_ids('hr_emp_record',array('emp_id'=>@$emp_id));
            if($gres){
                foreach($gres as $grec)
                { ?> 
        <div class="form-group col-md-3">            
        <input type="text" name="emp_id" class="form-control" value="<?php echo $grec->emp_name;?>" id="emp_record">
        <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $grec->emp_id; ?>">
                    </div>
                <?php 
                }      
            }else { ?>   
                <div class="form-group col-md-2">
                   <input type="text" name="emp_id" class="form-control" id="emp_record">
                   <input type="hidden" name="emp_id" id="emp_id">
                </div>
                <?php } ?> 
            
                <div class="form-group col-md-2">            
                <?php                     
                 echo form_dropdown('catm_id', $main,$catm_id, 'class="form-control"');
                ?>
                </div>    
                <div class="form-group col-md-2">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
                    <input type="submit" name="export" class="btn btn-theme" value="Export">
                </div>
               </div>       
            </form>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result); ?>
            </button>
            </p>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>S#</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Balance</th>
                    <th>Issuance Date</th>
                    <th>Employee</th>
                    <th>Designation</th>
                    <th>Issuance Department</th>
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
                    <td><?php echo $i;?></td>
                    <td><?php echo $row->itm_name;?></td>
                    <td><?php echo $row->quantity;?></td>
                    <td><?php echo $row->remaining_quantity;?></td>
                    <td><?php echo $newDate;?></td>
                    <td><?php echo $row->emp_name;?></td>
                    <td><?php echo $row->desg;?></td>
                    <td><?php echo $row->dept_name;?></td>
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
 
 