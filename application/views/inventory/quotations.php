
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
           <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form')); ?>
                                <div class="row"> 
                                     <div class="col-md-4 col-sm-5">
                                         <label for="name">Quotation Title</label>
                                         <?php
                                            echo form_input(array(
                                                'name'          => 'q_title',
                                                'id'            => 'q_title',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Quotation Title',
                                                'type'          => 'text'
                                                ));
                                            ?>
                                     </div>
                                    <div class="col-md-4 col-sm-5">
                                    <label for="name">Quotation Date (dd-mm-yyyy)</label>
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'q_date',
                                                'id'            => 'q_date',
                                                'type'          => 'text',
                                                'value'         => date('d-m-Y'),
                                                'class'         =>'form-control datepicker',
                                                ));
                                        ?>
                                     </div>
                                </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                      <label for="name">Item name</label>
                                      <?php
                                        echo form_input(array(
                                        'name'          => 'itemname',
                                        'id'            => 'itemname',
                                        'value'         => '',
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Item name',
                                        'type'          => 'text',
                                        ));

                                        echo form_input(array(
                                        'name'          => 'itemnameCode',
                                        'id'            => 'itemnameCode',
                                        'value'         => '',
                                        'class'         => 'form-control',
                                       'type'          => 'hidden',
                                        ));
                                        
                                        echo form_input(array(
                                        'name'          => 'q_hidden_id',
                                        'id'            => 'q_hidden_id',
                                        'value'         => '',
                                        'class'         => 'form-control',
                                       'type'          => 'hidden',
                                        ));
                                    ?>
                                 </div>
                                
                                <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date); ?>">
                                <div class="col-md-4 ">
                                    <p style="margin:0; margin-top: 5px;">&nbsp;</p>
                                    <button type="button" class="btn btn-theme" name="addQuoteItem" id="addQuoteItem"  value="addQuoteItem" ><i class="fa fa-plus"></i>Add Item</button>
                                    <button type="button" class="btn btn-theme"  id="saveDemoItems"><i class="fa fa-save"></i>Save Items</button>
                                    <!--<button type="submit" name="remove_trash" value="remove_trash" class="btn btn-theme"><i class="fa fa-trash"></i> Remove Trash</button>-->
                                </div>
                                
                                  </div>
                                
                            <?php echo form_close(); ?>
                         </div><!--//section-content-->
                    </section>
                <div class="panel panel-theme">
                    <div class="panel-heading">
                        <h3 class="panel-title">Items</h3>
                    </div>
                    <div class="panel-body">
                        <div id="showQuotationItems"></div>  
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
  $( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'd-m-yy'
    });
  } );
  
  jQuery(document).ready(function(){
     
        jQuery("#itemNameCons").autocomplete({
      
        minLength: 0,
        source: "autocompleteItemsCons/"+$("#itemNameCons").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#itemnameCode").val(ui.item.code);
            var item_id =jQuery("#itemnameCode").val();
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
      
     
    jQuery('#addQuoteItem').on('click',function(){
       
        var data = {
            'qTitle'     : jQuery('#q_title').val(),
            'qDate'      : jQuery('#q_date').val(),
            'itemName'   : jQuery('#itemname').val(),
            'itemCode'   : jQuery('#itemnameCode').val(),
            'hiddenId'   : jQuery('#q_hidden_id').val()
        };
        if(jQuery('#q_title').val() === ''){
            alert('Please Insert Title of Quotation');
            jQuery('#q_title').focus();
            return false;
        }
        if(jQuery('#itemname').val() === ''){
            alert('Please select Item name');
            jQuery('#itemname').focus();
            return false;
        }
        jQuery.ajax({
            type        : 'post',
            url         : 'AddQuotationItem',
            dataType    : 'json',
            data        : data,
            success: function(result){
                if(result['item'] === false){
                    alert('Item already exist');
                }
                else {
                    jQuery('#q_hidden_id').val(result['qid']);
                    var newdata = { 'quotID' : result['qid']};
                    jQuery.ajax({
                        type : 'post',
                        url : 'DemoQuotationItem',
                        data : newdata,
                        success : function(response){
                            jQuery('#showQuotationItems').html(response);
                            jQuery('#q_title,#q_date').attr('readonly', 'readonly');
                            jQuery('#itemname,#itemnameCode').val('');
                        }
                    }); 
                }
            }
        });
       
   });
    
   //Save All Items 
   jQuery('#saveDemoItems').on('click',function(){
      
       var hiddenId   = jQuery('#q_hidden_id').val();
       
       var data = { 'quot_id' : hiddenId };
       
        jQuery.ajax({
            type        : 'post',
            url         : 'SaveQuotationItems',
            dataType    : 'json',
            data        : data,
            success: function(result){
                if(result['save'] === true){
                    var newdata = { 'quoteId' : result['qid']};
                    jQuery.ajax({
                        type : 'post',
                        url : 'QuotationItemGrid',
                        data : newdata,
                        success : function(response){
                            jQuery('#showQuotationItems').html(response);
                            jQuery('#saveDemoItems, #addQuoteItem').addClass('disabled');
                            jQuery('#itemname').attr('readonly', 'readonly');
                        }
                    }); 
                }
                else{
                    alert('Add atleast one item ...');
                }
            }
        });
       
   }); 
   
    
    
      
  });
  
  
  </script>