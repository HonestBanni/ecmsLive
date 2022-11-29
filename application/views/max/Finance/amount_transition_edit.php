
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
                           
                                <div class="row">
                                      <?php 
                                      
                                $class = array(
                                    'info',
                                    'success',
                                    'danger',
                                    'warning',
                                    'active',
                                );

                                      
                                      echo form_open('',array('class'=>'course-finder-form'));
                                      if(@$update_records):
                                
                                            $SubmName   = 'AddCOA';   
                                            $Code       = '';
                                            $coaId      = '';
                                            $title      = '';
                                            $comments   = '';
                                            $btn        = 'Add';
                                            $status     = '';
                                            $icon       = 'plus';

                                        endif;
                                     ?>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Cheque</label>
                                         <input type="hidden" id="account_id" value="<?php echo $update_records->gl_at_id?>" name="account_name">
                                         <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'cheque',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Cheque *',
                                                    'id'            => 'cheque',
                                                    'value'         => $update_records->gl_at_cheque,
                                                    'type'          => 'text'
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Date</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'date',
                                                'id'            => 'amountdate',
                                                'type'          => 'text',
                                                'value'         =>  date('d-m-Y',strtotime($update_records->gl_at_date)),
                                                'class'         =>'form-control datepicker',
                                                    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Voucher</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'Voucher',
                                            'id'            => 'voucher',
                                             'value'         => $update_records->gl_at_vocher,
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Voucher',
                                            'type'          => 'number',
                                            'disabled'      => 'disabled',    
                                            ));
                                        ?>
                                        
                                         
                                        
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">JB/JV #</label>
                                           <?php 
                                                
 
                                                echo form_dropdown('jbJv',$stt,$update_records->gl_at_cb_jv,  'class="form-control" id="jbJv" disabled="disabled"');
                                                
                                        ?>
                                        
                                     </div>
                                     
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Payee :</label>
                                            <?php
                                                form_input(array(
                                                  'name'          => 'payee',
                                                  'id'            => 'payee',
                                                   'value'         => $update_records->gl_at_payeeId,
                                                  'class'         =>'form-control',
                                                  'placeholder'   =>'Payee ',
                                                  ));
                                          ?>
                                          <?php
                                              echo form_input(array(
                                                  'name'          => 'empId',
                                                  'id'            => 'empId',
                                                  'type'          => 'text',
                                                  'value'         => $update_records->gl_at_payeeId,
                                                  'class'         =>'form-control',
                                                  'placeholder'   =>'Payee ',
                                                  ));
                                          ?>
                                         
                                     </div>
                                    
                                    <div class="col-md-6 col-sm-5">
                                          <label for="name">Description #</label>
                                          <textarea class="form-control" rows="3" name="description" id="description" ><?php echo $update_records->gl_at_description?></textarea>
                                            
                                       
                                     </div>
                                    <div class="col-md-6 col-sm-5">
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
<!--                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Financial Year</label>
                                           <?php 
                                             
                                                  form_dropdown('financial',$financialYear,$update_records->gl_fy_id,  'class="form-control" id="financial"');
                                                
                                        ?>
                                        
                                     </div>-->
                                    <div class="col-md-3 col-sm-5">
                                   
                                    
                        
                                </div>
                                     
                                </div>
                          
                                    <?php
                                    echo form_close();
                                    ?>
                                
                            <div class="row">
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Cost Center :</label>
                                  <?php
                                        echo form_input(array(
                                        'name'          => 'costCenter',
                                        'id'            => 'costCenter',
                                        'value'         => 'Admin',
                                        'class'         =>'form-control inputSize',
                                        'placeholder'   =>'Cost Center',
                                        'readonly'   =>'readonly',
                                        ));
                                    ?>
                                </div>
                                
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Supplier :</label>
                              
                                  <?php
                                        echo form_input(array(
                                        'name'          => 'Supplier',
                                        'id'            => 'supplier',
                                        'value'         => '',
                                        'class'         =>'form-control inputSize',
                                        'placeholder'   =>'Supplier',
                                        'readonly'      =>'readonly',
                                        ));
                                    ?>
                                    
                                   
                        
                                </div>
                                <div class="col-md-4 col-sm-5">
                                         <label for="name">Account :</label>
                                         
                                             <div class="input-group" id="adv-search">
                                                <?php
                                                    echo    form_input(
                                                             array(
                                                                     'name'          => 'amountName',
                                                                     'value'         => $comments,
                                                                     'id'            => 'amount',
                                                                     'class'         => 'form-control inputSize',
                                                                     'placeholder'   => 'Account',
                                                                     'style'           => 'z-index: 1',
                                                                 )
                                                             );
                                                      ?>
                                                 <?php
                                                    echo form_input(
                                                          array(
                                                                  'name'          => 'amount',
                                                                  'value'         => $comments,
                                                                  'id'            => 'amountId',
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
                                                                  'id'            => 'code_id',
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

                                                  <!-- Modal content-->
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
                                                                                 
                                                                                    echo '<tr class="first">
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
                                                                                            $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));
                                                                                                 
                                                                                                    foreach($coacs as $coacsRow):
                                                                                                         
                                                                                                         echo ' <tr class="3rd '.$class[$k].'" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
                                                                                                                    <td>&nbsp;</td>
                                                                                                                    <td>'.$coacsRow->fn_coa_mc_code.'</td>
                                                                                                                  
                                                                                                                    <td>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;'.$coacsRow->fn_coa_mc_title.'</td>
                                                                                                                               
                                                                                                                   
                                                                                                                </tr>';
                                                                                                         
                                                                                                    endforeach;
                                                                                            endforeach;
                                                                                        endforeach;
                                                                            endif;
                                                                            ?>
                                                                       
                                                                    </table><!--//table-->
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
                            <div style="padding-top: 2%;padding-left: 2%;">
                                <div class="col-md-4 pull-right">
                                  
                                        <button type="button" class="btn btn-theme" name="update_record" id="update_record"  value="update_record" ><i class="fa fa-plus"></i> Update</button>
                                   
                                        <button type="button" class="btn btn-theme"  id="saveTranstUpdate"><i class="fa fa-refresh"></i> Save</button>
                                    
                                        <button type="button" class="btn btn-theme"><i class="fa fa-crop"></i> Cancel</button>
                                    
                                </div>
                            </div>
                         </div><!--//section-content-->
                        
                        
                    </section>
             <?php
             $messge = $this->session->flashdata('account_message');
                if(!empty($messge)):
                    '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Login ERROR !</strong> <br/>'.$this->session->flashdata('message').'
                                </div>'; 
                endif;
             ?> 
           
              <div class="panel panel-theme">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Transitions</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div id="transitionDetailsUpdate"></div> 
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
    
    jQuery(document).ready(function(){
        var account_id  = jQuery('#account_id').val();
        var formCode    = jQuery('#formCode').val();
        
        jQuery.ajax({
            type : 'post',
            url  : 'getUpdateTranRecord',
            data  : {'account_id':account_id,'formCode':formCode},
            success: function(result){
                 
                jQuery('#transitionDetailsUpdate').html(result);
            }
        });
        
        
jQuery('#update_record').on('click',function(){
    
  
     var cheque         = jQuery('#cheque').val();
     var amountdate     = jQuery('#amountdate').val();
     var empId          = jQuery('#empId').val();
     var voucher        = jQuery('#voucher').val();
     var description    = jQuery('#description').val();
     var costCenter     = jQuery('#costCenter').val();
     var supplier       = jQuery('#supplier').val();
     var amount         = jQuery('#amount').val();
     var amountId       = jQuery('#amountId').val();
     var code_id        = jQuery('#code_id').val();
     var debit          = jQuery('#debit').val();
     var credit         = jQuery('#credit').val();
     var formCode       = jQuery('#formCode').val();
    
     if(amount == ''){
         alert('Please select any amount head');
         jQuery('#amount').focus();
         return false;
     }
     
     if(debit == '' && credit == ''){
         alert('Please one value from depit or creidt');
         
         jQuery('#debit').focus();
         return false;
     }
     var data = {
         'cheque'       :cheque,
         'amountdate'   :amountdate,
         'voucher'      :voucher,
         'empId'        :empId,
         'description'  :description,
         'amountId'     :amountId,
         'costCenter'   :costCenter,
         'supplier'     :supplier,
         'amount'       :amount,
         'debit'        :debit,
         'coa_sub_chidId':code_id,
         'credit'       :credit,
         'formCode'     :formCode
         
     }
        jQuery.ajax({
            type    : 'post',
            url     : 'updateAmount',
            data    : data,
            success : function(result){
                jQuery('#transitionDetailsUpdate').html(result);
              var total = jQuery('#Fntotal').val();
            
              if(total == 0){
                  
                  //jQuery("input[name='saveTranst']").attr("disabled","");
                  jQuery('#saveTranstUpdate').prop('disabled',false);
              }
               if(total != 0){
                  jQuery('#saveTranstUpdate').prop('disabled',true);
              }
                
                var amount         = jQuery('#amount').val('');
                var amountId       = jQuery('#amountId').val('');
                var debit          = jQuery('#debit').val('');
                var credit         = jQuery('#credit').val('');
                
                
            }
      
            
        });
 });
        
    
     jQuery('#saveTranstUpdate').on('click',function(){
     
        var cheque         = jQuery('#cheque').val();
//        var financial       = jQuery('#financial').val();
        var amountdate     = jQuery('#amountdate').val();
        var empId          = jQuery('#empId').val();
        var voucher        = jQuery('#voucher').val();
        var description    = jQuery('#description').val();
        var costCenter     = jQuery('#costCenter').val();
        var jbJv           = jQuery('#jbJv').val();
        var formCode       = jQuery('#formCode').val();
        var account_id     = jQuery('#account_id').val();
        var print_value2    = jQuery('#print_value2').val();
   //  var credit         = jQuery('#credit').val();
     
     if(cheque == ''){
         alert('Please enter check number');
         jQuery('#cheque').focus();
         return false;
     }
     
     if(voucher == ''){
         alert('Please enter a valid voucher number');
         jQuery('#voucher').focus();
         return false;
     }
     var data = {
        'cheque'       :cheque,
        'amountdate'   :amountdate,
        'voucher'      :voucher,
        'print_value2' :print_value2,
        'empId'        :empId,
        'description'  :description,
        'jbJv'         :jbJv,
        'costCenter'   :costCenter,
        'formCode'     :formCode,
        'account_id'   :account_id
         
     }
        jQuery.ajax({
            type    : 'post',
            url     : 'saveAmountUpdate',
            data    : data,
            success : function(result){
                 
                 var data = jQuery.parseJSON(result);
                 
                 if(data.status ==1){
                    alert(data.msg); 
                 }
                  if(data.status ==2){
                     
                     window.location.href="VoucherPrint/<?php echo $this->uri->segment(2);?>"; 
                 }
 
            }
        });
 });
    
    
    
        
    });
    </script> 
 
        <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  </script>
 