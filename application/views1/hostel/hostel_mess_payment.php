 
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
                                         <label for="name">Challan no </label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'challan_no',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Challan No',
                                                    'type'          => 'text',
                                                    'value'         =>$challan_id,
                                                    'required'      => 'required',
                                                ));
          
                                             
                                            ?>
                                     
                                     </div>
                                   <?php
                                   if(@$std_info):
                                       ?>
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Payment Date</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'payment_date',
                                                    'id'            => 'total_amount',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Payment Date',
                                                    'type'          => 'text',
                                                    'value'         => date('d-m-Y'),
                                                    'required'      => 'required',
                                                    
                                                            
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     </div>
                                    
                                        
                                    <div class="row">
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Name</label>
                                         <?php

                                                echo form_input(array(
                                                     
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Studetn Name',
                                                    'value'         => $std_info->student_name,
                                                    'type'          => 'text',
                                                    'readonly'      => 'readonly'
//                                                    'value'         => $amount,
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Father Name</label>
                                         <?php

                                                echo form_input(array(
                                                     
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Studetn Name',
                                                    'value'         => $std_info->father_name,
                                                    'type'          => 'text',
                                                    'readonly'      => 'readonly'
//                                                    'value'         => $amount,
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Group</label>
                                         <?php

                                                echo form_input(array(
                                                     
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Studetn Name',
                                                    'value'         => $std_info->name,
                                                    'type'          => 'text',
                                                    'readonly'      => 'readonly'
//                                                    'value'         => $amount,
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                    <?php
                                   endif;
                                   
                                   ?>
                                      
                                     
                                      
                                   
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search Bill</button>
                                   
                                    <?php
                                    if(@$std_info->challan_status == 1):
                                        echo '<button type="submit" class="btn btn-theme" name="save" id="save"  value="save" ><i class="fa fa-plus"></i>  Paid</button>';
                                    endif;    
                                     
                                    ?>
                                    
                                    
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
              <?php
               if(!empty($error_msg)):
                        echo '<div class="alert alert-danger alert-dismissable center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Sorry! Date is Reconcile '.date('d-m-Y',strtotime($error_msg['date'])).' ! This date is locked </strong> </div>';
              endif; 
               
              
              ?>
              
              <div class="col-md-8 col-md-offset-2">
                                                                            
                                        <?php
                                         if(@$challan_info):
                                        ?>
                                        <h3 class="has-divider text-highlight">Challan Details </h3>
                                        <div class="table-responsive">
                                             <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                     
                                                          <th>Amount</th>
                                                           
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                        <?php
                                                       
                                                            $amount = '';
                                                            $sn = '';
                                                            foreach($challan_info as $row):
                                                                $sn++;
                                                                echo ' <tr>
                                                                <td>'.$sn.'</td> 
                                                                <td>'.$row->title.'</td> 
                                                                <td>'.$row->amount.'</td></tr> ';
                                                                $amount +=$row->amount;
                                                            endforeach;
                                                            echo '
                                                                <tr>
                                                            <td></td>
                                                            <td>Total</td>
                                                            <td>'.$amount.'</td>
                                                        </tr>';
                                                         
//                                                           
                                                        endif;
                                                        
                                                         if(@$std_info->challan_status == 2):
                                        echo '<div class="alert alert-danger alert-dismissable center">
                                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <strong>Sorry! Challan already Paid on Date '.date('d-M-Y',strtotime($std_info->payment_date)).'</strong> </div>';
                                    endif;  
                                                        ?>
                                                    
                                                        
                                                    </tbody>
                                            </table>
                                        </div>
                                           
                                
                                    </div>
                        
                             
 
          </div>
          
      
      </div>
                 </div>
    
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
     
   
     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
 
  </script>        
   