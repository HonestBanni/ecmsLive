
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Inventory Depreciation Update Value 
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
          <li class="current">Inventory Depreciation Update Value
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        <div class="row">
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line"><?php 
                    echo 'Emp Name : <strong>'.$result->emp_name.'</strong>';
                    echo ' / Code :<strong>'.$result->bb_shortname.'-'.$result->rm_shortname.'-'.$result->itm_shortname.'-'.$result->fid_code.'</strong>';
                    echo ' / Block: <strong>'.$result->bb_name.'</strong></br>';
                    echo 'Room : <strong>'.$result->rm_name.'</strong>';
                    echo ' / Item Name: <strong>'.$result->itm_name.'</strong>';
                    
                    ?>
                    
                    </span>
                </h1>
                <div class="section-content" >
                    <div class="row">
                        <?php echo form_open('',array('class'=>'course-finder-form','name'=>'reportForm'));   ?>
                        <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-4 col-sm-5">
                                <label for="name">Purchase Price</label>
                                <input type=""hidden name="log_purchasePrice" value="<?php echo $result->fid_pur_price; ?>">
                            <?php
                                echo form_input(array(
                                    'name'          => 'purchasePrice',
                                    'id'            => 'purchasePrice',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Purchase Price',
                                    'type'          => 'text',
                                    'value'         => $result->fid_pur_price,
                                    ));
                              
                                ?>
                            </div>
                            <div class="col-md-4 col-sm-5">
                            <label for="name">Purchase Date</label>
                            <input type=""hidden name="log_PurchaseDate" value="<?php echo $result->fid_pur_date; ?>">
                            <?php
                         
                                      echo form_input(array(
                                      'name'          => 'PurchaseDate',
                                      'id'            => 'PurchaseDate',
                                      'value'         => $result->fid_pur_date,
                                      'class'         => 'form-control',
                                      'placeholder'   => 'Purchase Date',
                                      'type'          => 'text',
                                      ));
 
                                  ?>
                            </div>
                             <div class="col-md-4 col-sm-5">
                            <label for="name">Supplier</label>
                            <input type=""hidden name="log_supplierId" value="<?php echo $result->fid_supplierId; ?>">
                               <?php
                             
                                echo form_dropdown('supplierId', $supplier, $result->fid_supplierId,  'class="form-control" id="my_id"');
                
//                                      echo form_input(array(
//                                      'name'          => 'supplier',
//                                      'id'            => 'supplier',
//                                      'value'         => '',
//                                      'class'         => 'form-control',
//                                      'placeholder'   => 'Supplier name',
//                                      'type'          => 'text',
//                                      ));
//
//                                      echo form_input(array(
//                                      'name'          => 'supplierId',
//                                      'id'            => 'supplierId',
//                                      'value'         => $result->fid_supplierId,
//                                      'class'         => 'form-control',
//                                     'type'          => 'hidden',
//                                      ));
                                      echo form_input(array(
                                      'name'          => 'fid_id',
                                      'id'            => 'fid_id',
                                      'value'         => $result->fid_id,
                                      'class'         => 'form-control',
                                     'type'          => 'hidden',
                                      ));
                                  ?>
                            </div>   
                            </div>
                              <br/>
                            <div class="row">
                            
                                <div class="col-md-4 col-sm-5">
                                    <label for="name">Depreciation Rate</label>
                                    <input type=""hidden name="log_dept_rate" value="<?php echo $result->fid_dept_rate; ?>">
                                      <?php
                                        echo form_input(array(
                                        'name'          => 'dept_rate',
                                        'id'            => 'dept_rate',
                                        'value'         => $result->fid_dept_rate,
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Dept Amount %',
                                        'type'          => 'text',
                                        ));
 
                                    ?>
                                </div>
                                <div class="col-md-4 col-sm-5">
                                    <label for="name">Depreciation Amount</label>
                                      <?php
                                        echo form_input(array(
                                        'name'          => 'dept_amount',
                                        'id'            => 'dept_amount',
                                        'value'         => $result->fid_dept_amount,
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Dept Amount',
                                        'type'          => 'text',
                                        'readonly'          => 'readonly',
                                        ));
 
                                    ?>
                                </div>
                                <div class="col-md-4 col-sm-5">
                                    <label for="name">Accumulated Depreciation</label>
                                      <?php
                                        echo form_input(array(
                                        'name'          => 'accum_depr',
                                        'id'            => 'accum_depr',
                                        'value'         => $result->fid_accum_depr,
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Accumulated Depreciation',
                                        'type'          => 'text',
                                        'readonly'          => 'readonly',
                                        ));
 
                                    ?>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                            
                                <div class="col-md-4 col-sm-5">
                                    <label for="name">Write Down Value (W.D.V)</label>
                                      <?php
                                        echo form_input(array(
                                        'name'          => 'wdv',
                                        'id'            => 'wdv',
                                        'value'         => $result->fid_wdv,
                                        'class'         => 'form-control',
                                        'placeholder'   => 'W.D.V',
                                        'type'          => 'text',
                                        'readonly'          => 'readonly',
                                            ));
 
                                    ?>
                                </div>
                         
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-5 col-sm-5">
                                    <button type="submit" name="update" value="update"  class="btn btn-theme"><i class="fa fa-save"></i> Update </button>
                                </div>
                               
                            </div>
                            
                              
                        
                        </div>  
                        <?php
                            echo form_close();
                        ?>
                        </div>
                 </div><!--//section-content-->
           </section>
                                  
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
    jQuery( function() {
        
    jQuery( "#PurchaseDate" ).datepicker({dateFormat: 'yy-mm-dd'});
  

    } );
     </script>