 
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_headers?>
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
          <li class="current"><?php echo $page_headers?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_headers?></span>
                        </h1>
                        <div class="section-content" >
                           
                               
                                      <?php echo form_open('',array('class'=>'course-finder-form','name'=>'reportForm'));   ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="name">Price</label>
                                                <div class="form-group ">  
                                                    <?php
                                                    echo form_input(array(
                                                        'name'          => 'item_purchase_price',
                                                        'value'         => $result->fid_pur_price,
                                                        'class'         => 'form-control',
                                                        'placeholder'   => 'Enter Purchase Price',
                                                        'type'          => 'text'
                                                        ));
                                                    echo form_input(array(
                                                        'name'          => 'fid_id',
                                                        'value'         => $result->fid_id,
                                                        
                                                        'type'          => 'hidden'
                                                        ));
                                                   ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="name">Purchase Date</label>
                                                <div class="form-group ">  
                                                    <?php
                                                    
                                                    $purchase_date = '';
                                                    if($result->fid_pur_date == '0000-00-00' || $result->fid_pur_date == '01-01-1970'):
                                                        $purchase_date = '';
                                                        else:
                                                        $purchase_date = date('d-m-Y',strtotime($result->fid_pur_date));
                                                    endif; 
                                                    
                                                    
                                                    echo form_input(array(
                                                        'name'          => 'item_purchase_date',
                                                        'value'         => $purchase_date,
                                                        'class'         => 'form-control datepicker',
                                                        'placeholder'   => 'Purchase Date',
                                                        'type'          => 'text'
                                                        ));
                                                   ?>
                                                </div>
                                                <input type="hidden" name="log_price" value="<?php echo $result->fid_pur_price; ?>">
                                                <input type="hidden" name="log_date" value="<?php echo $result->fid_pur_date; ?>">
                                            </div>
                                        </div> 
                                        
                                          
                                        <div class="form-group">
                                          <button type="submit" name="submit" value="submit" id="submit" class="btn btn-theme"><i class="fa fa-book"></i> Update</button>
                                          
                                         
                                      </div>
                                   
                                     
                                </div>
                            
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                             
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
  $( function() {
      
      
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
 
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
  </style> 