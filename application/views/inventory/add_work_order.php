
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Add Work Order
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
          <li class="current">Add Work Order
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">             
            <form name="postitem" method="post">
            <div class="row">
                <div class="col-md-12">
                <div class="form-group col-md-3">
                    <lable>Financial Year</lable>
                    <select name="year" class="form-control">
                        <?php
                            $lab = $this->db->query("SELECT * FROM financial_year WHERE status = '1' AND fn_account_type_id = '1'");
                            foreach($lab->result() as $labs){
                        ?>
                        <option value="<?php echo $labs->id?>"><?php echo $labs->year?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <lable>Order Date (<small>dd-mm-yy</small>):</lable>
                <input type="text" name="order_date" class="form-control date_format_d_m_yy">
                </div>
                <div class="form-group col-md-3">
                    <lable>Issued By</lable>
                    <select name="issued_by" class="form-control">
                        <?php
                            $lab = $this->db->query("SELECT * FROM invt_issued_by");
                            foreach($lab->result() as $labs){
                        ?>
                        <option value="<?php echo $labs->id?>"><?php echo $labs->issued_title;?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <lable>Issued to</lable>
                   <input type="text" name="issued_to" class="form-control" id="issuedto" required>
                   <input type="hidden" name="issued_to" id="issued_to" value="">
                </div>
                <div class="form-group col-md-3">
                    <lable>Ship to</lable>
                    <select name="ship_to" class="form-control">
                        <?php
                            $lab = $this->db->query("SELECT * FROM invt_ship_to order by ship_name asc");
                            foreach($lab->result() as $labs){
                        ?>
                        <option value="<?php echo $labs->ship_id?>"><?php echo $labs->ship_name?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div> 
                <div class="form-group col-md-3">
                    <lable>Prepared By</lable>
                    <select name="prepared_by" class="form-control">
                        <?php
                $prep = $this->db->query("SELECT * FROM hr_emp_record WHERE emp_name LIKE '%kamran%'");
                foreach($prep->result() as $preps){
                        ?>
    <option value="<?php echo $preps->emp_id?>"><?php echo $preps->emp_name?> (Superintendent)</option>
                        <?php
                            }
                        ?>
                    </select>
                </div> 
                <div class="form-group col-md-3">
                    <lable>Authorized By</lable>
                    <select name="authorized_by" class="form-control">
                   <?php
      $prep = $this->db->query("SELECT * FROM hr_emp_record WHERE emp_name LIKE '%Shah Mahmood Khan%'");
                foreach($prep->result() as $preps){
                        ?>
    <option value="<?php echo $preps->emp_id?>"><?php echo $preps->emp_name?> (Administrative Officer)</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                </div>
        <div class="col-md-12">
            <div class="form-group col-md-3">
            <input type="text" name="item_name" class="form-control" id="item_name" placeholder="Item Name">
            </div>
            <div class="form-group col-md-2">
            <input type="text" name="days" class="form-control" id="days" placeholder="Days">
            </div>
            <div class="form-group col-md-2">
            <input type="text" name="quantity" id="quantity" value="1" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <input type="text" name="price" id="price" placeholder="Price" class="form-control">
            </div>
                <div class="form-group col-md-2">
                    <input type="button" name="submit" id="work_order" value="Add Item" class="btn btn-theme">
                </div>
                <div class="form-group col-md-4">
        <input type="submit" name="submit_order" value="Submit Work Order" class="btn btn-theme">
                </div>
        <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis');
                echo md5($rand.$date);

                ?>">            
                </div>
           </div>
                </form>
            </article>
          <article class="contact-form col-md-12 col-sm-7">
            <div id="purchaseOrder">
              
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
 
 