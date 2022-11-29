
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_header?>
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
          <li class="current"><?php echo $page_header?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
          
        <div class="panel panel-theme">
            <div class="panel-heading">
                <h3 class="panel-title">Items</h3>
            </div>
            <div class="panel-body">
                <div id="showQuotationItems">
         <?php           
                echo form_open('',array('id'=>'add_quotation_form'));
            echo '<div class="table-responsive">                      
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">';
                    $sn = '';  
                    
                    foreach($query as $qRow):
                        $sn++;
                        echo '<tr id="'.$qRow->item_id.'">
                           <th>'.$sn.'</th>
                            <th>'.$qRow->itm_name.'<input type="hidden" name="q_itm_id[]" id="q_itm_id" value="'.$qRow->item_id.'"></th>
                            <th><input type="number" name="q_qty[]" id="qty'.$qRow->item_id.'" class="q_qty"></th>
                            <th><input type="number" name="q_unit[]" id="unit'.$qRow->item_id.'" class="q_unit"></th>
                            <th><input type="number" name="q_total[]" id="total'.$qRow->item_id.'" class="q_total" readonly></th>
                        </tr>'; 
                    endforeach;
                    echo '</tbody>
                </table>
             </div>
             <div class="row"> 
                <div class="col-md-4 col-sm-5">';
                    echo form_input(array(
                       'name'          => 'supplier',
                       'id'            => 'issuedto',
                       'class'         => 'form-control',
                       'placeholder'   => 'Supplier',
                       'type'          => 'text'
                    )); 
                    echo form_input(array(
                       'name'          => 'supplierId',
                       'id'            => 'issued_to',
                       'type'          => 'hidden',
                       'class'         =>'form-control',
                    ));
                    echo form_input(array(
                       'name'          => 'quoteId',
                       'id'            => 'quoteId',
                       'type'          => 'hidden',
                       'value'         => $qid,
                       'class'         =>'form-control',
                    ));
                echo '</div>
                <div class="col-md-4 col-sm-5">
                    <button type="button" class="btn btn-theme"  id="addNewQuotation"><i class="fa fa-plus"></i>Add Quoation</button>
                    <a href="QuotationsRecord"><button type="button" class="btn btn-theme"  id="addNewQuotation"><i class="fa fa-save"></i>Save</button></a>
                </div>
            </div>';
            echo form_close();
            ?>  
                    
                    
                </div>  
            </div>

        </div>

        <div class="panel panel-theme">
            <div class="panel-body">
                <div id="QuotationGrid"></div>  
            </div>
        </div>
          
          
          
       
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
                
                var quotation_id = jQuery('#quoteId').val();
                    jQuery.ajax({
                        type : 'post',
                        url : 'QuotationsGrid',
                        data : { 'quotation_id' : quotation_id},
                        success : function(response){
                            jQuery('#QuotationGrid').html(response);
                        }
                    }); 
                
                jQuery('.q_qty').on('change', function(){
                    var rowId   = $(this).parent().parent().attr('id');
                    var qty     = jQuery(this).val();
                    var unit    = jQuery('#unit'+rowId).val();
                    var total = isNaN(parseInt(qty) * parseInt(unit)) ? 0 :(qty * unit);
                    jQuery('#total'+rowId).val(total);
                });
                
                jQuery('.q_unit').on('change', function(){
                    var rowId   = $(this).parent().parent().attr('id');
                    var qty     = jQuery(this).val();
                    var unit    = jQuery('#qty'+rowId).val();
                    var total = isNaN(parseInt(qty) * parseInt(unit)) ? 0 :(qty * unit);
                    jQuery('#total'+rowId).val(total);
                });
                
                jQuery("#issuedto").autocomplete({  
                    minLength: 0,
                    source: "InventoryController/auto_issued_to/"+$("#issuedto").val(),
                    autoFocus: true,
                    scroll: true,
                    dataType: 'jsonp',
                    select: function(event, ui){
                        jQuery("#issuedto").val(ui.item.contactPerson);
                        jQuery("#issued_to").val(ui.item.id);
                    }
                }).focus(function(){  
                    jQuery(this).autocomplete("search", "");  
                });
                
                jQuery('#addNewQuotation').on('click', function(){
                    $("#table_body tr").each(function() {
                        if(jQuery('#q_qty'+this.id).val() === ''){
                            jQuery('#q_qty'+this.id).focus();
                            alert('Please add item details');
                            return false;
                        }
                        if(jQuery('#unit'+this.id).val() === ''){
                            jQuery('#unit'+this.id).focus();
                            alert('Please add item details');
                            return false;
                        }
                      });
                    if(jQuery('#issuedto').val() === ''){
                        jQuery('#issuedto').focus();
                        alert('Please add a Supplier');
                        return false;
                    }
                    jQuery.ajax({
                        type    :'post',
                        url     :'SaveQuotationRecord',
                        datatype: 'json',
                        data    : jQuery('#add_quotation_form').serialize(),
                        success : function(result){
                            if(result['save'] === false){
                                alert('Supplier already exist')
                            }
                            else {
                                var quotation_id = jQuery('#quoteId').val();
                                jQuery.ajax({
                                    type : 'post',
                                    url : 'QuotationsGrid',
                                    data : { 'quotation_id' : quotation_id},
                                    success : function(response){
                                        jQuery('#QuotationGrid').html(response);
                                        jQuery('.q_qty, .q_unit, .q_total').val('');
                                        jQuery('#issuedto, #issued_to').val('');
                                        alert('Quoatation Saved Successfully');
                                    }
                                }); 
                            }
                        }
                    });
                });
                
            });
            
            </script>  