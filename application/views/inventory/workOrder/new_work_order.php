
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
            <form name="wo_form" id="wo_form" method="post">
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
                    <?php echo form_dropdown('po_supplier', $supplier, $qd_supplier_id,  'class="form-control" id="poSupplier"'); ?>
<!--                   <input type="text" name="issued_to" class="form-control" id="issuedto" required>
                   <input type="hidden" name="issued_to" id="issued_to" value="">-->
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
                    <input type="text" class="form-control" id="prepared_by_name" value="<?php echo $superdnt->emp_name.' (Superintendent)'; ?>">
                    <input type="hidden" class="form-control" name="prepared_by" id="prepared_by" value="<?php echo $superdnt->emp_id; ?>">
                </div> 
                <div class="form-group col-md-3">
                    <lable>Authorized By</lable>
                    <input type="text" class="form-control" id="authorized_by" value="<?php echo $adminOff->emp_name.' (Admin Officer)'; ?>">
                    <input type="hidden" class="form-control" name="authorized_by" id="authorized_by" value="<?php echo $adminOff->emp_id; ?>">
                </div>
                </div>
                <div class="panel-body">
                    <div id="ItemsGrid"></div>  
                </div>
                
        <div class="col-md-12">
            <div class="form-group col-md-4">
                <input type="button" name="submit_order" id="submit_order" value="Submit Work Order" class="btn btn-theme">
            </div>
                <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date); ?>">  
                <input type="hidden" name="qt_id" id="qt_id" value="<?php echo $quoteId; ?>">            
                <input type="hidden" name="cs_id" id="cs_id" value="<?php echo $csId; ?>"> 
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
 
 <script>
  
    jQuery(document).ready(function(){
        var data = {
            'qtid' : jQuery('#qt_id').val(),
            'posp' : jQuery('#poSupplier').val()
        };
        jQuery.ajax({
            type        : 'post',
            url         : 'WorkOrderItems',
            data        : data,
            success: function(result){
               jQuery('#ItemsGrid').html(result);
            }
        });
        
        jQuery('#poSupplier').on('change', function(){
            var data = {
                'qtid' : jQuery('#qt_id').val(),
                'posp' : jQuery(this).val()
            };
            jQuery.ajax({
                type        : 'post',
                url         : 'WorkOrderItems',
                data        : data,
                success: function(result){
                   jQuery('#ItemsGrid').html(result);
                }
            });
        });
             
        jQuery('#submit_order').on('click', function(){
            $("#table_body tr").each(function() {
                if(jQuery('#q_qty'+this.id).val() === ''){
                    jQuery('#q_qty'+this.id).focus();
                    alert('Please add item details');
                    return false;
                }
            });
            jQuery.ajax({
                type    :'post',
                url     :'SaveWorkOrderRecord',
                data    : jQuery('#wo_form').serialize(),
                success : function(result){
                    alert('Work Order added Successfully');
                    window.location.href = 'InventoryController/work_order';
                }
            });
        });
                
    });
  
</script>