
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
<!--        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Amount Transition</h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current">Voucher Form</li>
                    </ul>
                </div>
      //breadcrumbs
    </header> -->
    
        
        
        
        <div class="page-content">
            <div class="col-md-12">
                <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header;?>  Form</span>
                    </h1>
                    <div class="section-content" >
                        <div class="row">
                               <?=form_open('HmVoucherSave',array('class'=>'course-finder-form'))?>
                                 <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                    <div class="col-md-2 col-sm-5">
                                        <label for="name">Process Date</label>
                                    <?php
                                       $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );
                                    
                                        echo form_input(array(
                                                'id'            => 'invoice_date',
                                                'name'          => 'invoice_date',
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Invoice Date',
                                                'value'         =>  date('d-m-Y'),
                                                'type'          => 'text',
                                                'required'         => 'required',
                                                ));
                                            ?> 
                                    </div>
                                   <div class="col-md-3 col-sm-5">
                                         <label for="name">Payee :</label>
                                           
                                          <?php
                                              echo form_input(array(
                                                  'name'        => 'payee',
                                                  'id'          => 'propertier_name',
                                                  'type'        => 'text',
                                                  'value'       => '',
                                                  'required'    => 'required',
//                                                  'readonly'    => 'readonly',
                                                  'class'       =>'form-control',
                                                  'placeholder' =>'Payee ',
                                                  ));
                                              echo form_input(array(
                                                  'name'        => 'supplier_id',
                                                  'id'          => 'supplier_id',
                                                  'type'          => 'hidden',
                                                  ));
                                              echo form_input(array(
                                                  'name'        => 'employee_id',
                                                  'id'          => 'employee_id',
                                                  'type'          => 'hidden',
                                                  ));
                                          ?>
                                         
                                     </div>
                                    <div class="col-md-2 col-sm-5">
                                            <label for="name">Financial Year</label>
                                              <?php 

                                                   echo form_dropdown('financial',$financialYear,'',  'class="form-control" required="required" id="fy" ');

                                           ?>

                                    </div>
                                  <div class="col-md-2 col-sm-5">
                                          <label for="name">Voucher</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'voucher',
                                            'id'            => 'voucher',
                                            'value'         => $vocherId,
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Voucher',
                                            'type'          => 'text',
                                            ));
                                        ?>
                                     </div>
                                  <div class="col-md-1 col-sm-5">
                                          <label for="name">Need Vhr</label>
                                          <?php
                                          $voucherNeed = array(
                                              '1'    =>'Yes',
                                              '0'    =>'No',
                                          );
                                           echo form_dropdown('voch_need',$voucherNeed,'0',  'class="form-control" required="required" id="voch_need"  ');
                                        ?>
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                         <label for="name">Voucher Type</label>
                                           <?php 
                                             
                                                echo form_dropdown('voucherType',$voucherType,'',  'class="form-control" required="required" id="voucherType"  ');
                                                
                                        ?>
                                        
                                     </div>
                                 <div class="row">
                                     <div class="col-md-12 col-sm-5">
                                      <div class="col-md-2 col-sm-5">
                                          <label for="name">Employee</label>
                                          <?php
                                           echo form_input(array(
                                            'name'          => 'employee',
                                            'id'            => 'fnEmployee',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Employee',
                                            'type'          => 'text',
                                            )); 
                                           echo form_input(array(
                                            'name'          => 'fnEmployeeId',
                                            'id'            => 'fnEmployeeId',
                                            
                                            'type'          => 'hidden',
                                            )); 
                                          
                                          ?>
                                     </div>
                                      <div class="col-md-3 col-sm-5">
                                          <label for="name">Supplier</label>
                                          <?php
                                           echo form_input(array(
                                            'name'          => 'supplier',
                                            'id'            => 'fnSupplierName',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Supplier',
                                            'type'          => 'text',
                                            )); 
                                           echo form_input(array(
                                            'name'          => 'fnSupplierId',
                                            'id'            => 'fnSupplierId',
                                            'type'          => 'hidden',
                                            )); 
                                          
                                          ?>
                                     </div>
                                      <div class="col-md-3 col-sm-5">
                                          <label for="name">Cheque#</label>
                                          <?php
                                           echo form_input(array(
                                            'name'          => 'cheque',
                                            'id'            => 'cheque',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Cheque',
                                            'type'          => 'text',
                                            )); 
                                           
                                          
                                          ?>
                                     </div>
                                      <div class="col-md-2 col-sm-5">
                                          <label for="name">Payment Date</label>
                                          <?php
                                            echo form_input(array(
                                                'id'            => 'payment_date',
                                                'name'          => 'payment_date',
                                               
//                                                'class'         => 'form-control',
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Payment Date',
                                                 
                                                'type'          => 'text',
                                               
                                                ));
                                           
                                          
                                          ?>
                                     </div>
                                      <div class="col-md-2 col-sm-5">
                                          <label for="name">Voucher Status</label>
                                          <?php
                                          echo form_dropdown('voucher_status',$voucher_status,'1',  'class="form-control" '); 
                                           
                                          
                                          ?>
                                     </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                          <div class="col-md-9 col-sm-5 ">
                                          <label for="name">Description #</label>
                                          <textarea class="form-control" rows="3" required="required" name="description" id="description" ></textarea>
                                            
                                       
                                     </div>  
                                     </div>
                                   
                                 </div>
                                 <br/> 
                                 <div class="row">
                                     <div class="col-md-12">
                                          <?php
                                            if($voucher_attach):
                                                foreach($voucher_attach as $va_row):
                                                echo   '<div class="col-md-4 col-sm-5">';
                                                  
                                                  echo     '<label><input type="checkbox" name="voucher_att[]"  value="'.$va_row->id.'">    '.$va_row->attach_name.'</label>';
                                                 echo  '</div>';

                                                endforeach;
                                            endif;

                                            ?>
                                     </div>
                                   
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                         
                                  <?php
                                        echo form_input(array(
                                        'name'          => 'costCenter',
                                        'id'            => 'costCenter',
                                        'value'         => 'Admin',
                                        'class'         =>'form-control inputSize',
                                        'placeholder'   =>'Cost Center',
                                         'type'         =>'hidden',
                                        'readonly'   =>'readonly',
                                        ));
                                    ?>
                                
<!--                                        <div class="col-md-2 col-sm-5">
                                            <label for="name">Supplier :</label>

                                          <?php
                                                echo form_input(array(
                                                'name'          => 'Supplier',
                                                'id'            => 'supplier',
                                                'value'         => '',
                                                'class'         =>'form-control inputSize',
                                                'placeholder'   =>'Supplier',
                                                'readonly'   =>'readonly',
                                                ));
                                            ?>



                                        </div>-->
                                        <div class="col-md-4 col-sm-5">
                                                 <label for="name">Account :</label>

                                                     <div class="input-group" id="adv-search">
                                                        <?php
                                                            echo    form_input(
                                                                     array(
                                                                             'name'          => 'amountName',
                                                                             'value'         => '',
                                                                             'id'            => 'hmamount',
                                                                             'class'         => 'form-control inputSize',
                                                                             'placeholder'   => 'Account',
                                                                             'style'        => 'z-index: 1',
                                                                         )
                                                                     );
                                                              ?>
                                                         <?php
                                                            echo form_input(
                                                                  array(
                                                                          'name'          => 'amount',
                                                                          'value'         => '',
                                                                          'id'            => 'hmamountId',
                                                                          'type'          => 'hidden',
                                                                          'class'         => 'form-control inputSize',
                                                                          'placeholder'   => 'Account',
                                                                          )
                                                                  );
                                                          ?>
                                                         <?php
                                                            echo form_input(
                                                                  array(
                                                                          'name'          => 'code_id',
                                                                          'id'            => 'hmcode_id',
                                                                          'type'          => 'hidden',
                                                                          'class'         => 'form-control inputSize',
                                                                          'placeholder'   => 'Account',
                                                                          )
                                                                  );
                                                          ?>

                                                        <div class="input-group-btn">
                                                            <div class="btn-group" role="group">
                                                                <div class="dropdown dropdown-lg">

                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target="#myModal" aria-expanded="false"><span class="caret"></span></button>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="myModal" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                         
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Chart Of Account</h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                    <div class="table-responsive">  

                                                                            <table  id="table" class="table table-hover">


                                                                                    <?php

                                                                                    if($COAP):
                                                                                        foreach($COAP as $coapRow):

                                                                                            echo '<tr class="first ">
                                                                                                 <td>&nbsp;</td>
                                                                                                    <td>'.$coapRow->fn_coa_code.'</td>
                                                                                                    <td>'.$coapRow->fn_coa_title.'</td>

                                                                                                </tr>';
                                                                                                    $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                                                                    foreach($coac as $coacRow):
                                                                                                      $k = array_rand($class); 
                                                                                                         echo '<tr class="2nd">
                                                                                                              <td>&nbsp;</td>
                                                                                                                <td> '.$coacRow->fn_coa_m_code.'</td>

                                                                                                                <td> &nbsp;&nbsp; &nbsp; &nbsp;'.$coacRow->fn_coa_m_title.'</td>


                                                                                                            </tr>';
                                                                                                    $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_trash'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));

                                                                                                            foreach($coacs as $coacsRow):

                                                                                                                 echo ' <tr class="3rdhm '.$class[$k].'" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
                                                                                                                            <td>&nbsp;</td>
                                                                                                                            <td>'.$coacsRow->fn_coa_mc_code.'</td>

                                                                                                                            <td>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;'.$coacsRow->fn_coa_mc_title.'</td>


                                                                                                                        </tr>';

                                                                                                            endforeach;
                                                                                                    endforeach;
                                                                                                endforeach;
                                                                                    endif;
                                                                                    ?>

                                                                            </table>
                                                                        </div>
                                                                <ul class="job-list custom-list-style">
                                                              <?php 
                                                                if($COAP ==1):
                                                                    foreach($COAP as $coapRow):
                                                                        echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coapRow->fn_coa_code.'">'.$coapRow->fn_coa_title.'</a></li>';
                                                                            $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                                            echo '<ul class="job-list custom-list-style">';
                                                                                foreach($coac as $coacRow):
                                                                                     echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacRow->fn_coa_m_code.'">'.$coacRow->fn_coa_m_title.'</a></li>';
                                                                                        $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));
                                                                                        echo '<ul class="job-list custom-list-style">';
                                                                                            foreach($coacs as $coacsRow):
                                                                                                 echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacsRow->fn_coa_mc_code.'">'.$coacsRow->fn_coa_mc_title.'</a></li>';
                                                                                            endforeach;
                                                                                    echo ' </ul>';
                                                                                endforeach;
                                                                            echo ' </ul>';
                                                                    endforeach;
                                                                endif;

                                                              ?>
                                                                    </ul>



                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                          </div>

                                                        </div>
                                                    </div>






                                    </div>

                                        <div class="col-md-2 col-sm-5">
                                                 <label for="name">Debit :</label>
                                          <?php
                                        echo form_input(array(
                                        'name'          => 'Debit',
                                        'id'            => 'debit',
                                        'type'          => 'number',
                                        'value'         => '',
                                        'class'         =>'form-control inputSize',
                                        'placeholder'   =>'Debit',
                                        ));
                                    ?>


                                        </div>
                                        <div class="col-md-2 col-sm-5">
                                                  <label for="name">Credit :</label>

                                            <?php
                                        echo form_input(array(
                                        'name'          => 'Credit',
                                        'id'            => 'credit',
                                        'type'          => 'number',
                                        'value'         => '',
                                        'class'         =>'form-control inputSize',
                                        'placeholder'   =>'Credit',
                                        ));
                                    ?>
                                      </div>

                                    </div> 
                                   <div class="row">
                                       <div class="col-md-12">
                                           
                                       
                                        <div style="padding-top: 2%;padding-left: 2%;">
                                        <div class="col-md-4 pull-right">

                                                <button type="button" class="btn btn-theme" name="update_vocher" id="update_vocher_hm"  value="update" ><i class="fa fa-plus"></i> Update</button>

                                                <button type="submit" class="btn btn-theme"  id="save_vocher"><i class="fa fa-refresh"></i> Save</button>

                                                <button type="button" class="btn btn-theme"><i class="fa fa-crop"></i> Cancel</button>

                                        </div>
                                    </div>
                                           </div>
                                       </div>
                                     
                                    <div class="col-md-2 col-sm-5">
                                                  

                                            <?php
                                        echo form_input(array(
                                        'name'          => 'print_value2',
                                        'id'            => 'print_value2',
                                        'type'          => 'hidden',
                                        'value'         => '',
                                        'class'         =>'form-control inputSize',
                                  
                                        ));
                                    ?>
                                      </div> 
                                     
                          </div>
                                <?=form_close()?>
                        </div>
                    </div>
                </section>
                <div class="panel panel-theme">
                    <div class="panel-heading">
                        <h3 class="panel-title">Transitions</h3>
                    </div>
                    <div class="panel-body">
                           <div id="showTransitionRecord">


                        </div> 

                    </div>
                </div>
                
                
                   
            </div>
        </div>
        
         
          </div>
          
      
      </div>
 
 
  <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
    changeYear: true,
    dateFormat: 'dd-mm-yy'
            });
        });
    </script>
<!--    <style>
    .ui-datepicker-calendar {
        /*display: none;*/
    }
    </style>-->
 
<!--     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  </script>-->
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>
  
    <script>
  
     jQuery('#table .3rdhm').dblclick(function () {
       
       var  mcId = this.id;
       var  mcClass = jQuery(this).prop("classList");
      
       var  array = mcId.split(',');
       
        jQuery('#myModal').modal('toggle');
        jQuery('#hmamount').val(array[0]);
        jQuery('#hmamountId').val(array[2]);
        jQuery('#hmcode_id').val(array[1]);
 
});
  
  
  </script>