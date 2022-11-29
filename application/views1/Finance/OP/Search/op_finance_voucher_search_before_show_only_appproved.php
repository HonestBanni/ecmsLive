 
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
                                      
                                     <div class="col-md-2 col-sm-5">
                                         <label for="name">Process Date From</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'from_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Process From Date',
                                                     'value'        => $from_date
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                         <label for="name">Process Date To</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'to_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Process To Date',
                                                     'value'        => $to_date
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                         <label for="name">Process Number</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'process_no',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Enter Process Number',
                                                     'value'        => $process_no
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                         <label for="name">Voucher No</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'voucher_id',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Voucher Number',
                                                     'value'        => $voucehr_no
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Payee</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'payee',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Enter Payee ',
                                                     'value'        => $Payee
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                   </div>
                                <div class="row">   
                                      <div class="col-md-2 col-sm-5">
                                         <label for="name">Payment Date From</label>
                                         <?php

                                                 echo  form_input(array(
                                                    'name'          => 'payfrom_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Payment From Date',
                                                     'value'        => $pfrom_date
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                         <label for="name">Payment Date To</label>
                                         <?php

                                                 echo  form_input(array(
                                                    'name'          => 'payto_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Payment To Date',
                                                     'value'        => $pto_date
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                         <label for="name">Amount</label>
                                         <?php

                                                  echo form_input(array(
                                                    'name'          => 'amount',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Enter Amount',
                                                     'value'        => $amount
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                         <label for="name">Voucher Type</label>
                                         <?php

                                                echo   form_dropdown('voucher_status',$voucher_status,$statusid,  'class="form-control"');
                                            ?>
                                     
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Description</label>
                                         <?php

                                                 echo  form_input(array(
                                                    'name'          => 'desc',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Enter Description',
                                                     'value'        => $desc
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                      
                                    
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
                                              <table class="table table-hover" id="table" style="font-size:11px">
                                                    <thead>
                                                      <tr>

                                                          
                                                         
                                                            <th>Process Date</th>
                                                            <th>Process No</th>
                                                            <th>Voucher</th>
                                                            <th>Payee</th> 
                                                            <th>Description</th> 
                                                            <th>Payment Date</th>
                                                            <th>Amount</th>
                                                            <th>Detail</th>
                                                            <th>Update</th>
                                                            <th>Print</th>
                                                            <th>Voucher Approval</th>                                                           

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                          foreach($result as $row):
                                                              $k = array_rand($class);
                                                           $sn++;
                                                            echo '<tr class="'.$class[$k].'">
                                                                 
                                                                
                                                                <th>'.date('d-m-Y', strtotime($row->gl_at_date)).'</th>
                                                                <th>'.$row->gl_at_id.'</th>
                                                                <th>'.$row->gl_at_vocher.'</th>
                                                                <th>'.substr($row->gl_at_payeeId, 0, 30).'</th>
                                                                <th>'.substr($row->gl_at_description, 0, 50).'</th>
                                                                
                                                                <th>';
                                                                if($row->vocher_status == 2):
                                                                    if($row->payment_date == '0000-00-00' || $row->payment_date =='1970-01-01'):
                                                                        
                                                                        else:
                                                                        echo date('d-m-Y', strtotime($row->payment_date));
                                                                    endif;
                                                                     
                                                                endif;
                                                            echo '</th>
                                                                <th>'.number_format($row->print_cheque_value, 0, ',', ',').'</th>
                                                               
                                                              
                                                                  <td><a href="javascript:valid(0)" id="'.$row->gl_at_id.'" class="amount_tran_details"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal"> Details</button></a></td>';
                                                                        ?>
                                                    <td>  <a href="BankVoucherEdit/<?php echo $row->gl_at_id;?>"  target="_new" class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Update</button></a>
                                                                  </td> 
                                                                    <td>  
                                                                        
                                                                        
                                                                        
                                                                        <a href="VoucherPrint/<?php echo $row->gl_at_id;?>" target="_new"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Print</button></a>
                                                                  </td> 
                                                                    <td>  <a href="voucherApproval/<?php echo $row->gl_at_id;?>" target="_new" class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Voucher Approval</button></a>
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
 
    
    
    <!--// Record From Tog--> 
  
        <!--// Record To Tog--> 
   
     
       
  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Account Details</h4>
      </div>
      <div class="modal-body">
          <div id="transitionDetails">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
        
                    <script>
  $( function() {
    $( ".datepicker" ).datepicker({
         changeMonth: true,
    changeYear: true,
    dateFormat: 'dd-mm-yy'
    });
  } );
  </script>   