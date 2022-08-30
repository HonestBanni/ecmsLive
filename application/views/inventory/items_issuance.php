
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
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                
                                     ?>
                                <div class="row">
                                      
                                     <div class="col-md-4 col-sm-5">
                                         <label for="name">Employee name</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'emp_id',
                                                    'id'            => 'emp_id',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Employee name',
                                                    'type'          => 'text'
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'emp_idCode',
                                                    'id'            => 'emp_idCode',
                                                    'class'         => 'form-control',
                                                     
                                                    'type'          => 'hidden'
                                                    ));
                                            ?>
                                     
                                     </div>
                                    <div class="col-md-3 col-sm-5 col-md-offset-4">
                                    <label for="name">Issue Date(dd-mm-yyyy)</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'date',
                                                'id'            => 'issuedate',
                                                'type'          => 'text',
                                                'value'         => date('d-m-Y'),
                                                'class'         =>'form-control datepicker',

                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                </div>
                            <br>
                            <div class="row">
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Item name</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'itemname',
                                            'id'            => 'itemNameCons',
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
                                        ?>
                                        
                                         
                                        
                                     </div>
                                
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Tag No.</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'serial_no',
                                            'id'            => 'serialNo',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Item Serial No.',
                                            'type'          => 'text',
                                            ));
                                           
                                        ?>
                                     </div>
                                
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Department</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'depttname',
                                            'id'            => 'depttname',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Department',
                                            'type'          => 'text',
                                            ));
                                            
                                            echo form_input(array(
                                            'name'          => 'depttnameCode',
                                            'id'            => 'depttnameCode',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Department',
                                            'type'          => 'hidden',
                                            ));
                                        ?>
                                     </div>
                                
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Room</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'roomname',
                                            'id'            => 'roomname',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Room',
                                            'type'          => 'text',
                                            ));
                                            
                                            echo form_input(array(
                                            'name'          => 'roomnameCode',
                                            'id'            => 'roomnameCode',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Room',
                                            'type'          => 'hidden',
                                            ));
                                        ?>
                                        
                                     </div>
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">GRN</label>
                                          
                                          
                                            <?php
                                            $grn = array(
                                                'select' =>'Select GRN'
                                            );
                                            echo form_dropdown('grn_id',$grn,'',array('class'=>'form-control grn_id','id'=>'grn_id'));
                                             
                                        ?>
                                     </div>
                                
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Manual GRN</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'manual_grn',
                                            'id'            => 'manualGRN',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Manual GRN',
                                            'type'          => 'text',
                                            ));
                                        ?>
                                     </div>
                              
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Quantity</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'quantity',
                                            'id'            => 'quantity',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Quantity',
                                            'type'          => 'text',
                                            ));
                                        ?>
                                     </div>
                                 
                                 <div class="col-md-2 col-sm-5">
                                    <label for="name">Purchase Rate</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'item_p_price',
                                                'id'            => 'item_p_price',
                                                'type'          => 'text',
                                                'placeholder'   => 'Purchase Rate',
                                                'class'         =>'form-control',

                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                <div class="col-md-2 col-sm-5 form-group">
                                    <label for="name">Purchase Date</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'item_p_date',
                                                'id'            => 'item_p_date',
                                                'type'          => 'text',
                                                'value'         => '',
                                                'placeholder'   => 'Purchase Date',
                                                'class'         =>'form-control datepicker',

                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                
                                <div class="col-md-6 col-sm-5">
                                    <label for="name">Comments</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'comments',
                                                'id'            => 'comments',
                                                'type'          => 'text',
                                                'placeholder'   => 'Remarks',
                                                'class'         =>'form-control',

                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                
                                  </div>
                            <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis');
                            echo md5($rand.$date);
                            
                            ?>">
                                    
                                
                             
                            <div style="padding-top: 2%;padding-left: 2%;">
                                <div class="col-md-4 pull-right">
                                  
                                        <button type="button" class="btn btn-theme" name="updateInvt" id="updateInvt"  value="updateInvt" ><i class="fa fa-plus"></i> Update</button>
                                   
                                        
                                        <button type="button" class="btn btn-theme"  id="saveIssues"><i class="fa fa-book"></i> Save</button>
                                    
                                        <button type="submit" name="remove_trash" value="remove_trash" class="btn btn-theme"><i class="fa fa-crop"></i> Remove Trash</button>
                                    
                                </div>
                            </div>
                            <?php
                                    echo form_close();
                                    ?>
                         </div><!--//section-content-->
                        
                        
                    </section>
              <div class="panel panel-theme">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Transitions</h3>
                                        </div>
                                        <div class="panel-body">
                                               <div id="showFixItemRecord">
                                                   
                    
                                            </div> 
                                    
                                        </div>
                  
                                    </div>
          
          <?php // echo '<pre>';print_r( $fixedItems);?>
          <div class="table-responsive">
              
          
              <table class="table table-hover" id="table" style="font-size:10px">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Block</th>
                    <th>Room Name</th>
                    <th>Item</th>
                    <th>Emp. Name</th>
                    <th>Date</th>
                     
                </tr>
              </thead>
              <tbody>
                 <?php 
                 $sn = '';
                 if($fixedItems):
                     foreach($fixedItems as $fiRow):
                     $sn++;
                     echo '<tr id="'.$fiRow->fid_id.'ItemRow">
                            <th>'.$sn.'</th>
                            <th>'.$fiRow->bb_shortname.'-'.$fiRow->rm_shortname.'-'.$fiRow->itm_shortname.'-'.$fiRow->fid_code.'</th>
                            <th>'.$fiRow->bb_name.' ('.$fiRow->bb_shortname.')</th>
                            <th>'.$fiRow->rm_name.' ('.$fiRow->rm_shortname.')</th>
                            <th  style="width: 50%;">'.$fiRow->itm_name.' ('.$fiRow->itm_shortname.')</th>
                            <th>'.$fiRow->emp_name.'</th>
                            <th>'.date('d-m-Y', strtotime($fiRow->fid_date)).'</th></tr>';
                     endforeach;
                 endif;
                 
                 ?> 
                                                      
              </tbody>
            </table>
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
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  
  jQuery(document).ready(function(){
     
      jQuery('#grn_id').on('change',function(){
            var grn_id =jQuery("#grn_id").val();
            var itemnameCode =jQuery("#itemnameCode").val();
            
            jQuery.ajax({
                type    : 'post',
                url     : 'itemGRNinfo',
                datatype    : 'json',
                data    : {'grn_id':grn_id,'itemnameCode':itemnameCode},
                success: function(result){

                    var data = JSON.parse(result);

                    var purchase_price  = data['purchase_price'];
                    var purchase_date   = data['purchase_date'];

                    jQuery('#item_p_price').val(purchase_price);
                    jQuery('#item_p_date').val(purchase_date);
                }
            });
        });
        
      jQuery('#quantity').on('keyup',function(){
            var itemnameCode =jQuery("#itemnameCode").val();
            jQuery.ajax({
                type    : 'post',
                url     : 'InventoryController/item_qty_info',
                datatype    : 'json',
                data    : {'itemnameCode':itemnameCode},
                success: function(result){

                    var data = JSON.parse(result);
                    var item_qty  = data['itm_qty'];
                    if(jQuery('#quantity').val() > parseInt(item_qty)){
                        alert('Quantity available in store: '+item_qty);
                        jQuery('#quantity').val('');
                    }
                }
            });
        });
        
        
        jQuery("#itemNameCons").autocomplete({
      
        minLength: 0,
        source: "autocompleteItemsCons/"+$("#itemNameCons").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#itemnameCode").val(ui.item.code);
            
               var item_id =jQuery("#itemnameCode").val();
            
            jQuery.ajax({
            type   : 'post',
            url    : 'itemGRNdate',
            data   : {'item_list':item_id},
            success: function(result){
                
            
                jQuery('#grn_id').html(result);
               
            }
        });
 
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
        
    jQuery("#depttname").autocomplete({
      
        minLength: 0,
        source: "InventoryController/autocomplete_deptt_inventory/"+$("#depttname").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#depttnameCode").val(ui.item.code);
 
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    }); 
      
  });
  
  
  </script>