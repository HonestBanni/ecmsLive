
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
               
                 $mesg = $this->session->flashdata('voucher_exist');
                if(!empty($mesg)):
                    
                  echo   '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Voucher ERROR !<br/>'.$this->session->flashdata('voucher_exist').'</strong> 
                                </div>'; 
                endif;
                
 
                    ?>
                                
                                  
                            </div>
                           
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
                                            $cheque = '';
                                            $payment_date = '';
                                            if($update_records->vocher_status == 1):
                                                $cheque        = '';
                                                $payment_date  = '';
                                                else:
                                                $cheque         = $update_records->gl_at_cheque;
                                                $payment_date  = date('d-m-Y',strtotime($update_records->payment_date));
                                            endif;
                                                echo form_input(array(
                                                    'name'          => 'cheque',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Cheque *',
                                                     
                                                    'value'         => $cheque,
                                                    'type'          => 'text',
//                                                    'readonly'          => 'readonly',
                                                    'required'          => 'required'
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Payment Date</label>
                                        <?php
 
                                            echo form_input(array(
                                                'name'          => 'payment_date',
                                                
                                                'type'          => 'text',
                                                'value'         =>  $payment_date,
                                                'class'         =>'form-control datepicker',
                                                   'readonly'      => 'readonly',
                                                'required'       => 'required'   
                                                ));
                                            echo form_input(array(
                                                'name'          => 'trans_id',
                                                'value'          => $update_records->gl_at_id,
                                                'type'          => 'hidden',
                                                  
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Voucher</label>
                                          <?php
                                          $voucher_no='';
                                          if($update_records->gl_at_vocher == 0):
                                              $query1 = $this->db->where(array('status'=>'1','fn_account_type_id'=>1))->get('financial_year')->row();
                                                $where = array(
                                                     'gl_fy_id'=>$query1->id);
                                              
                                                   $this->db->order_by('gl_at_vocher','desc');  
                                                  $this->db->limit('0','1');  
                               $max_voucher_no =  $this->db->get_where('gl_amount_transition',$where)->row();
//                                        echo '<pre>';print_R($query1);die;   
                                               
                                             $voucher_no =  $max_voucher_no->gl_at_vocher +1;
                                          else:
                                               $voucher_no=  $update_records->gl_at_vocher;
                                          endif;
                                          
                                          
                                            echo form_input(array(
                                            'name'          => 'voucher_no',
                                            
                                             'value'         => $voucher_no,
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Voucher',
                                          
                                               
                                            ));
                                        ?>
                                        
                                         
                                        
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Voucher Status</label>
                                           <?php 
                                                
 
                                                echo form_dropdown('voucher_status',$voucher_status,$update_records->vocher_status,  'class="form-control" id="jbJv"');
                                                
                                        ?>
                                        
                                     </div>
                                     
 
                                    
 
                                    <div class="col-md-3 col-sm-5">
                                   
                                    
                        
                                </div>
                                     
                                </div>
                          
                                   
                                
 
                            <div style="padding-top: 2%;padding-left: 2%;">
                                <div class="col-md-2 pull-right">
                                    <button type="submit" class="btn btn-theme"  id="saveTranstUpdateXX"><i class="fa fa-refresh"></i> Save</button>
                                </div>
                            </div>
                             <?php
                                    echo form_close();
                                    ?>
                         </div>
                        
                        
                    </section>
            
           
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
    // var debit          = jQuery('#debit').val();
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
//        'financial'      :financial,
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
                     
                     window.location.href="AmountTransReport"; 
                 }
 
            }
        });
 });
    
    
    
        
    });
    </script> 
 
        <script>
  $( function() {
    $( ".datepicker" ).datepicker({
         changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
 