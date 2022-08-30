
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Edit Purchase Price 
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
          <li class="current">Edit Purchase Price
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        <div class="row">
        <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Edit Purchase Price Panel</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                      <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                                     
                                    <div class="col-md-12">
                                        <div class="col-md-2 col-sm-5">
                                            <div class="form-group ">
                                                <label for="name">Employee Name</label>
                                                <?php
                                                    
                                                
                                                     echo form_dropdown('emp_id',$employee_details,$faxItems->emp_id,  'class="form-control" id="my_id"');
                                                
//                                                echo form_input(array(
//                                                    'name'          => 'emp_id',
//                                                    'name'          => 'emp_id',
//                                                    
//                                                    'value'         => $faxItems->emp_name,
//                                                    'class'         => 'form-control',
//                                                    'placeholder'   => 'Room',
//                                                    'type'          => 'text',
//                                                    ));

                                                   
                                                ?>
                                            </div>
                                          
                                        </div>
                                        <div class="col-md-6 "></div>
                                          
                                          
                                         
                                        
                                         
                                         
                                        
                                         
                                    </div>  
                                    <div class="col-md-12">
                                         
                                        
                                        <div class="col-md-2 col-sm-5">
                                            <div class="form-group ">
                                                <label for="name">Block</label>
                                             <?php
                                                    echo form_input(array(
                                                    'name'          => 'roomname',
                                                    
                                                    'value'         => $faxItems->bb_name,
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Room',
                                                    'type'          => 'text',
                                                    ));

                                                   
                                                ?>
                                            </div>
                                          
                                        </div>
                                          <div class="col-md-1 "></div>
                                        <div class="col-md-2 col-sm-5">
                                            <div class="form-group ">
                                                <label for="name">Room</label>
                                             <?php
                                                    echo form_input(array(
                                                    'name'          => 'roomname',
                                                    
                                                    'value'         => $faxItems->rm_name,
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Room',
                                                    'type'          => 'text',
                                                    ));

                                                   
                                                ?>
                                            </div>
                                          
                                        </div>
                                          <div class="col-md-1 "></div>
                                        <div class="col-md-2 col-sm-5">
                                            <div class="form-group ">
                                                <label for="name">Item Name</label>
                                             <?php
                                                    echo form_input(array(
                                                    'name'          => 'roomname',
                                                    
                                                    'value'         => $faxItems->itm_name,
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Room',
                                                    'type'          => 'text',
                                                    ));

                                                   
                                                ?>
                                            </div>
                                          
                                        </div>
                                        
                                         
                                         
                                        
                                         
                                    </div>  
                                    <div class="col-md-12">
                                        <div class="col-md-2 col-sm-5">
                                            <div class="form-group ">
                                                <label for="name">Purchase Date</label>
                                                <?php
                                                    echo form_input(array(
                                                    'name'          => 'purchase_date',
                                                    'value'         => date('d-m-Y', strtotime($faxItems->fid_pur_date)),
                                                    'class'         =>  'form-control datepicker',
                                                    'placeholder'   => 'Purchase Date',
                                                    'type'          => 'text',
                                                    ));
                                                    echo form_input(array(
                                                    'name'          => 'purc_item_id',
                                                    'value'         => $faxItems->fid_id,
                                                    
                                                    
                                                    'type'          => 'hidden',
                                                    ));
                                                    echo form_input(array(
                                                    'name'          => 'fii_id',
                                                    'value'         => $faxItems->fii_id,
                                                    
                                                    
                                                    'type'          => 'hidden',
                                                    ));

                                                   
                                                ?>
                                            </div>
                                          
                                        </div>
                                        <div class="col-md-1 "></div>
                                        <div class="col-md-2 col-sm-5">
                                            <div class="form-group ">
                                                <label for="name">Purchase Price</label>
                                             <?php
                                                    echo form_input(array(
                                                    'name'          => 'pur_price',
                                                     'value'         => $faxItems->fid_pur_price,
                                                    'class'         => 'form-control ',
                                                    'placeholder'   => 'Purchase Price',
                                                    'type'          => 'text',
                                                    ));

                                                   
                                                ?>
                                            </div>
                                          
                                        </div>
                                         <div class="col-md-1 "></div>
                                        <div class="col-md-2 col-sm-5">
                                            <div class="form-group ">
                                                <label for="name">Comments</label>
                                             <?php
                                                    echo form_input(array(
                                                    'name'          => 'fid_comments',
                                                     'value'         => $faxItems->fid_comments,
                                                    'class'         => 'form-control ',
                                                    'placeholder'   => 'Remarks',
                                                    'type'          => 'text',
                                                    ));

                                                   
                                                ?>
                                            </div>
                                          
                                        </div>
                                          <div class="col-md-1 "></div>
                                          <div class="col-md-2 col-sm-5" style="padding-top: 2%;padding-left: 2%;">
                                                         
                               
                                            <div class="form-group ">
                                                <button type="submit" class="btn btn-theme" name="updateItem"><i class="fa fa-plus"></i> Update</button>
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
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  </script> 