
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
                            <span class="line"><?php echo $page_header?> Edit Form</span>
                        </h1>
                  <?php
                    echo form_open('HmSaveAmountUpdate',array('class'=>'course-finder-form'));
                  ?>
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
                                                    'value'         =>  date('d-m-Y',strtotime($update_records->gl_at_date)),
                                                    'type'          => 'text',
                                                    'required'         => 'required',
                                                    ));
                                                ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-5">
                                         <label for="name">Payee :</label>
                                           
                                           <?php
                                              echo form_input(array(
                                                  'name'        => 'payee',
                                                  'id'          => 'propertier_name',
                                                  'type'        => 'text',
                                                  'value'       => '',
                                                  'required'    => 'required',
                                                  'value'         =>$update_records->gl_at_payeeId,  
                                                  'class'       =>'form-control',
                                                  'placeholder' =>'Payee ',
                                                  ));
                                            
                                          ?>
                                      </div>
                                    <div class="col-md-2 col-sm-5">
                                            <label for="name">Financial Year</label>
                                              <?php 

                                                   echo form_dropdown('financial',$financialYear,$update_records->gl_fy_id,  'class="form-control" required="required" id="fy" ');

                                           ?>

                                    </div>
                                     <div class="col-md-2 col-sm-5">
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
<!--                                    <div class="col-md-1 col-sm-5">
                                          <label for="name">Need Vhr</label>
                                          <?php
                                          $voucherNeed = array(
                                              '1'    =>'Yes',
                                              '0'    =>'No',
                                          );
                                           echo form_dropdown('voch_need',$voucherNeed,'0',  'class="form-control" required="required" id="voch_need"  ');
                                        ?>
                                     </div>-->
                                    <div class="col-md-2 col-sm-5">
                                         <label for="name">Voucher Type</label>
                                           <?php 
                                             
                                                echo form_dropdown('voucherType',$voucherType,$update_records->vocher_type,  'class="form-control" required="required" id="voucherType"  ');
                                                
                                        ?>
                                        
                                     </div>
                                     <div class="row">
                                     <div class="col-md-12 col-sm-5">
                                      <div class="col-md-3 col-sm-5">
                                          <label for="name">Employee</label>
                                          <?php
                                          
                                          
                                            echo form_dropdown('employee_id',$employee_drop,$update_records->employee_id,  'class="form-control"  id="employee_id"  ');
                                                
                                           
                                           
                                          ?>
                                     </div>
                                      <div class="col-md-3 col-sm-5">
                                          <label for="name">Supplier</label>
                                         
                                           <?php
                                          
                                          
                                            echo form_dropdown('supplier_id',$supplier_drop,$update_records->supplier_id,  'class="form-control" id="supplier_id"  ');
                                                
                                           
                                           
                                          
                                          
                                          ?>
                                     </div>
                                      <div class="col-md-2 col-sm-5">
                                          <label for="name">Cheque#</label>
                                          <?php
                                           echo form_input(array(
                                            'name'          => 'cheque',
                                            'id'            => 'cheque',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Cheque',
                                            'type'          => 'text',
                                            'value'         => $update_records->gl_at_cheque,
                                            )); 
                                           
                                          
                                          ?>
                                     </div>
                                      <div class="col-md-2 col-sm-5">
                                          <label for="name">Payment Date</label>
                                          <?php
                                          if($update_records->vocher_status == 2):
                                              if($update_records->payment_date == '0000-00-00'):
                                                   $payment_date = '';
                                                  else:
                                                  $payment_date = date('d-m-Y',strtotime($update_records->payment_date));
                                              endif;
                                              
                                              else:
                                              $payment_date = '';
                                          endif;
                                            echo form_input(array(
                                                'id'            => 'payment_date',
                                                'name'          => 'payment_date',
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Payment Date',
                                                'value'         => $payment_date,
                                                'type'          => 'text',
                                               
                                                ));
                                           
                                          
                                          ?>
                                     </div>
                                      <div class="col-md-2 col-sm-5">
                                          <label for="name">Voucher Status</label>
                                          <?php
                                          echo form_dropdown('voucher_status',$voucher_status,$update_records->vocher_status,  'class="form-control" id="voucher_status" '); 
                                           
                                          
                                          ?>
                                     </div>
                                     </div>
                                 </div>
                                  
                                    
                                    <div class="row">
                                     <div class="col-md-12">
                                          <div class="col-md-9 col-sm-5 ">
                                          <label for="name">Description #</label>
                                          <textarea class="form-control" rows="3" required="required" name="description" id="description" ><?php 
                                          
//                                          echo '<pre>';print_r($update_records);die;
                                          
                                          echo $update_records->gl_at_description?></textarea>
                                            
                                       
                                     </div>  
                                     </div>
                                   
                                 </div>
                                    
                                <div class="row">
                                     <div class="col-md-12">
                                          <?php
                                            if($voucher_attach):
                                                foreach($voucher_attach as $va_row):
                                                echo   '<div class="col-md-4 col-sm-5">';
                                                  
                                                $key_where = array(
                                                        'attach_id'=>$va_row->id,
                                                        'amount_tra_id'=>$this->uri->segment(2),
                                                    );

                                            $key = $this->CRUDModel->get_where_row('fn_voucher_attachment',$key_where);
                                            if($key):
                                                 echo     '<label><input type="checkbox" checked="checked" name="voucher_att[]"  value="'.$va_row->id.'">    '.$va_row->attach_name.'</label>';
                                                else:
                                                 echo     '<label><input type="checkbox"  name="voucher_att[]"  value="'.$va_row->id.'">    '.$va_row->attach_name.'</label>';
                                            endif;
                                           
                                               
                                                  echo  '</div>';

                                                endforeach;
                                            endif;

                                            ?>
                                     </div>
                                   
                                 </div>
                                    
                                    
                                    
                                   
                                         <input type="hidden" id="account_id" value="<?php echo $update_records->gl_at_id?>" name="account_id">
                                         <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                          
                                 
                                   
                                      
                                      
                                     
                                     
                                    
                                     
                                     
 
                                 
                                     
                                </div>
                          
                                   
                                
                            <div class="row">
                                 
                                
                                 
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
                                                                  'value'         => $update_records->print_cheque_value,
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
                            <div style="padding-top: 2%;padding-left: 2%;">
                                <div class="col-md-4 pull-right">
                                  
                                        <button type="button" class="btn btn-theme" name="update_record" id="update_record"  value="update_record" ><i class="fa fa-plus"></i> Update</button>
                                   
                                        <button type="submit" class="btn btn-theme"  id="saveTranstUpdateXX"><i class="fa fa-refresh"></i> Save</button>
                                    
                                        <button type="button" class="btn btn-theme"><i class="fa fa-crop"></i> Cancel</button>
                                    
                                </div>
                            </div>
                         </div><!--//section-content-->
                         <?php
                                    echo form_close();
                                    ?>
                        
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
        
        
        
    jQuery('#employee_id').on('change',function(){
         
         var employee_id =  jQuery('#employee_id').val();
         
          jQuery.ajax({
            type : 'post',
            url  : 'fnEmployeeInfo',
            data  : {'employee_id':employee_id},
            success: function(result){
                jQuery('#propertier_name').val(result);

            }
        });
         
         
         
     });
    jQuery('#supplier_id').on('change',function(){
         
         var supplier_id =  jQuery('#supplier_id').val();
         
          jQuery.ajax({
            type : 'post',
            url  : 'fnSupplierInfo',
            data  : {'supplier_id':supplier_id},
            success: function(result){
                
                
//                 jQuery('#propertier_name').val(result);
                jQuery('#propertier_name').val(jQuery('#propertier_name').val()+' '+result);

            }
        });
         
         
         
     });
        
        
        
        
jQuery('#update_record').on('click',function(){
     
        jQuery('#print_value2').val(jQuery('#credittAmount').val());
  
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
        
    
    
    
        
    });
    </script> 
 
    <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker( {
            changeMonth: true,
    changeYear: true,
    dateFormat: 'dd-mm-yy'
           
            });
        });
//        $(function() {
//            $('.datepickerd').datepicker( {
//            changeMonth: true,
//            changeYear: true,
//            showButtonPanel: true,
//            dateFormat: 'd-mm-yy',
//            
//            });
//        });
    </script>
 