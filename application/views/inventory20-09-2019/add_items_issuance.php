
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Items Issuance
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
          <li class="current">Items Issuance
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">             
            <form name="postitem" method="post" action="InventoryController/insert_items_issuance">
            <div class="row">
                <div class="col-md-12">
                <div class="form-group col-md-3">
                    <lable>Full Name: </lable>
        <input type="text" name="prepared_by" placeholder="Employee" class="form-control" id="emp_names">
                    <input type="hidden" name="prepared_by" id="prepared_by">
                </div>
                <div class="form-group col-md-3">
            <lable>Department </lable>
            <select class="form-control" name="dept_id">
                <option value="">Select Department</option>
                <?php
                $dp = $this->db->query("SELECT * FROM invt_item_issuance_department");
                foreach($dp->result() as $Urow):    
                ?>
                    <option value="<?php echo $Urow->iss_dept_id;?>"><?php echo $Urow->dept_name;?></option>
                <?php
                endforeach;
                ?>
            </select>          
        </div>      
                <div class="form-group col-md-3">
                   <lable>Date: <small>(DD-MM-YY)</small></lable>
                    <input type="text" name="date" class="form-control date_format_d_m_yy">
                </div>              
                </div>
                <div class="col-md-12">
                 <div class="form-group col-md-3">
    <input type="text" name="item_id" class="form-control" placeholder="Item Name" id="items_category">
                   <input type="hidden" name="item_id" id="item_id" value="">
                     <input type="hidden" name="item_quantity" id="item_quantity" value="">
                </div>
                <div class="form-group col-md-2">
        <input type="number" name="quantity" id="quantity" placeholder="Quantity" class="form-control">
                </div>
                <div class="form-group col-md-2">
            <input type="button" name="submit" id="additemissuance" value="Add Item" class="btn btn-theme">
                </div>
                <div class="form-group col-md-12">
                    <input type="submit" name="submit_item" value="Submit" class="btn btn-theme">
                </div>
        <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis');
                echo md5($rand.$date);

                ?>">            
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
 
 