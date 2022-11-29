 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                             
                                     ?>
                                <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Session </label>
                                         <?php

                                           echo form_dropdown('batch',$batch,'',  'class="form-control" required="required"');
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Installment Type </label>
                                         <?php

                                           echo form_dropdown('installment_type',$installment_type,'',  'class="form-control" required="required"');
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Challan Type</label>
                                         <?php

                                           echo form_dropdown('challan_type',$challan_type,'',  'class="form-control" required="required" id="hostel_type"');
                                             
                                            ?>
                                     
                                     </div>
                                </div>
                            <div class="row">
                                <div id="type">
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Total Days</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'total_days',
                                                    'id'          => 'total_days',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Total Days',
                                                    'type'          => 'number',
                                                    
//                                                    'value'         => $amount,
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Per Day</label>
                                         <?php
                                          $per_day =  $this->CRUDModel->get_where_row('hostel_heads',array('status'=>'1','head_type'=>2));
                                         
                                                echo form_input(array(
                                                    'name'          => 'per_day',
                                                    'id'          => 'per_day',
                                                    'class'         => 'form-control',
                                                    'value'         => $per_day->amount,
                                                    'type'          => 'text',
                                                    'readonly'      =>'readonly'    
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'per_day_id',
                                                    'id'            => 'per_day_id',
                                                    'class'         => 'form-control',
                                                    'value'         => $per_day->id,
                                                    'type'          => 'hidden',
                                                      
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Total Amount</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'total_amount',
                                                    'id'          => 'total_amount',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Total Amount',
                                                    'type'          => 'text',
                                                    'readonly'      => 'readonly',
                                                            
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     
                                </div>
                            </div>
                            <div class="row">
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date From</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'date_from',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From Date',
                                                    'type'          => 'text',
                                                    'value'         => date('d-m-Y'),
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date To</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'date_to',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From To',
                                                    'type'          => 'text',
                                                   'value'         => date('d-m-Y'),
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Issue Date</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'issue_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Issue Date',
                                                    'type'          => 'text',
                                                    'value'         => date('d-m-Y'),
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                
                            </div><div class="row">
                                     <div class="col-md-4 col-sm-5">
                                         <label for="name">Bank</label>
                                         <?php

                                               echo form_dropdown('bank', $bank,8,  'class="form-control"');
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                
                                     
                                      
                                     
                                
                                      
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="add" id="add"  value="add" ><i class="fa fa-plus"></i> Generate Bill</button>
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                            <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );
                                
                                      if(!empty($result)):
                                          
                                    
                                        ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Head </th>
                                                          <th>Amount</th>
                                                          <th>Status</th>
                                                          <th>Edit</th>
                                                          <th>Delete</th>

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                       
                                                          foreach($result as $row):
                                                              
                                                              $k = array_rand($class);
                                                           $sn++;
                                                            echo '<tr class="'.$class[$k].'">
                                                                <td>'.$sn.'</th>
                                                                <td>'.$row->title.'</td>
                                                                <td>'.$row->amount.'</td>
                                                                     <td>'; 
                                                            if($row->status == 1):
                                                                  echo '<button class="btn btn-success btn-xs">Active</button>';
                                                                  else:
                                                                  echo '<button class="btn btn-info btn-xs">Deactive</button>';
                                                              endif;
                                                            
                                                            echo '</td>
                                                                 ';
                                                                       ?>
                                                                    <td>  <a href="hostelMessHeads/<?php echo $row->id;?>"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Edit </button></a>
                                                                  </td> 
                                                                  <td> 
                                                                   <a href="HMDelete/<?php echo $row->id;?>"  onclick="return confirm('Are You Sure to Delete This..?')"  class="productstatus"><button type="button" class="btn btn-danger btn-xs"> Delete</button></a>
                                                                   </td>  
                                                                <?php
                                                                    
                                                            echo '</tr>';
                                                         
                                                          endforeach;      
                                               

                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
                                      endif;
                                    ?> 
                                    </div>
                                    </div>
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
     
   
     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'dd-mm-yy'
    });
  } );
    jQuery('#total_days').keyup(function(){
      var total_days    = jQuery('#total_days').val();
      var per_day       = jQuery('#per_day').val();
      jQuery('#total_amount').val(total_days*per_day);
  });
  
  
  
  </script>        
   