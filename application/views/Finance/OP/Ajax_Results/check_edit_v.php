    <?php echo form_open('',array('class'=>'course-finder-form','id'=>'CheckUpdate'))?>
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"  style="text-align: center;" id="myModalLabel">Bank Cheque Edit</h4>
                </div>
                <div class="modal-body">
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">  <span class="line">Bank Cheque  Form</span>  </h1>
                        <div class="section-content">
                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                        <label for="name">Check Print Date</label>
                                    <?php

     
                                       echo form_input(array(
                                                'id'            => 'dateup',
                                                'name'          => 'dateup',
                                                'class'         => 'form-control datepickeredit',
                                                'placeholder'   => 'Check Date',
                                                'value'         => date('d-m-Y',strtotime($BankEdit->check_date)) ,
                                                'type'          => 'text',
                                                'required'         => 'required',
                                                ));
                                       echo form_input(array(
                                                'id'            => 'gl_bcd_id',
                                                'name'          => 'gl_bcd_id',
                                                'class'         => 'form-control',
                                                'value'         => $BankEdit->gl_bcd_id ,
                                                'type'          => 'hidden',
                                                ));
                                       echo form_input(array(
                                                'id'            => 'gl_id',
                                                'name'          => 'gl_id',
                                                'class'         => 'form-control',
                                                'value'         => $BankEdit->gl_id ,
                                                'type'          => 'hidden',
                                                ));
                                       echo form_input(array(
                                                'id'            => 'gl_bc_id',
                                                'name'          => 'gl_bc_id',
                                                'class'         => 'form-control',
                                                'value'         => $BankEdit->gl_bc_id ,
                                                'type'          => 'hidden',
                                                ));
                                            ?> 
                                    </div>

                                <div class="col-md-8 col-sm-5">
                                             <label for="name">Pay to  :</label>
                                               <?php
                                                        $this->db->join('fn_supplier','fn_supplier.fn_supp_id=gl_amount_transition.supplier_id','left outer'); 
                                              $result = $this->db->get_where('gl_amount_transition',array('gl_at_id'=>$BankEdit->gl_id))->row();
                                              $paye = array(
                                                  $result->gl_at_payeeId    => 'Payee : '.$result->gl_at_payeeId,
                                                  $result->company_name     => 'Company Name : '.$result->company_name,
                                              );
                                                 echo form_dropdown('payeeup',$paye,$BankEdit->payee,  'class="form-control" ');  


                                              ?>

                                         </div>
                                        <div class="col-md-4 col-sm-5">
                                                <label for="name">Bank For Check</label>
                                                  <?php     echo form_dropdown('bank_nameup',$bank_COA,$BankEdit->bank_id,  'class="form-control" required="required" id="bank_coa_up" '); 
                                               ?>

                                        </div>
                                         <div class="col-md-4 col-sm-5">
                                              <label for="name">Cheque No.</label>
                                              <?php
                                                echo form_input(array(
                                                'name'          => 'cheque_noup',
                                                'id'            => 'cheque_noup',
                                                'value'         => $BankEdit->check_no,
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Cheque No.',
                                                'type'          => 'text',
                                                ));
                                            ?>
                                         </div>
                                      <div class="col-md-4 col-sm-5">
                                              <label for="name">Cheque Amount</label>
                                              <?php
                                                echo form_input(array(
                                                'name'          => 'cheque_amountup',
                                                'id'            => 'cheque_amountup',
                                                'value'         => $BankEdit->check_amount,
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Cheque Amount',
                                                'type'          => 'text',
                                                'readonly'      => 'readonly',
                                                ));
                                            ?>
                                         </div>
                                        <div class="col-md-4 col-sm-5">
                                              <label for="name">Cheque Type</label>

                                              <?php echo form_dropdown('cheque_typeup',$cheque_type,$BankEdit->check_type,  'class="form-control" ');  ?>
                                         </div>
                                        <div class="col-md-4 col-sm-5">
                                              <label for="name">Cheque Status</label>

                                              <?php echo form_dropdown('cheque_statusup',$cheque_status,$BankEdit->checque_status,  'class="form-control" ');  ?>
                                         </div>
                                         <div class="col-md-12">
                                         <label for="name"  style="padding-top: 20px;" >Cheque Signature By :</label>
                                     </div>
                                        <div class="col-md-12">
                                              <?php
                                               if($gl_sign_list):
                                                    foreach($gl_sign_list as $va_row):
                                                        $checkSign = $this->db->get_where('gl_cheque_sign_by',array('emp_id'=>$va_row->gl_cs_id,'gl_bcd_id'=>$BankEdit->gl_bcd_id))->row();
                                                        echo    '<div class="col-md-4 col-sm-5">';
                                                        if(empty($checkSign)):
                                                        echo    '<label  style="font-size: 20px;"><input style="zoom: 1.8;" type="checkbox" name="SignaturePersonsup[]"  value="'.$va_row->gl_cs_id.'">&nbsp;&nbsp;&nbsp;'.$va_row->emp_name.'</label>';
                                                            else:
                                                            echo    '<label  style="font-size: 20px;"><input style="zoom: 1.8;" type="checkbox" checked="checked" name="SignaturePersonsup[]"  value="'.$va_row->gl_cs_id.'">&nbsp;&nbsp;&nbsp;'.$va_row->emp_name.'</label>';
                                                        endif;

                                                        echo    '</div>';

                                                    endforeach;
                                                endif;

                                                ?>
                                         </div>


                            </div>
                        </div>
                    </section>
                    <div id="error_message" class="alert alert-danger fade in alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Danger!</strong><span id="resp_text"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="update_check_data" class="btn btn-theme">Update</button>
                    <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                </div>
     <?php echo form_close()?>
        </div>
 <script type="text/javascript">
        $(function() {
            $('.datepickeredit').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
        
        
        jQuery(document).ready(function(){
            jQuery('#error_message').hide();
            jQuery('#update_check_data').on('click',function(){
               var form = $('#CheckUpdate');
              jQuery.ajax({
                type        : 'post',
                url         : 'ChequeUpdate',
                dataType    : 'json',
                data        : form.serialize(),
                success     : function(response){
                
                 if(response['e_status'] == false){
                      jQuery('#error_message').show();
                        //$('#resp_icon').html(response['e_icon']);
                        //$('#resp_type').html(response['e_type']);
                        $('#resp_text').html(response['e_text']);
                        
                        
//                        $('#entry_validation').modal('toggle');
                    }
                    else {
                        $('#resp_text').html(response['e_text']);
                         jQuery('#error_message').show();
                         window.location.reload();
//                    jQuery.ajax({
//                        type    : 'post',
//                        url     : 'SaveChequeResult',
//                        data    : {'gl_id':jQuery('#gl_id').val()},
//                        success : function(result){
//                        jQuery('#PreivewCheque').html(result);
//                        }
//                    });
                      
                    }
                
                
                }
            });
            
             
            
            });
             jQuery('#bank_coa_up').on('change',function(){
        
                    jQuery.ajax({
                             type        : 'post',
                             url         : 'BankCoAmount',
                             dataType    : 'json',
                             data        : {'coa_id':jQuery(this).val(),'gl_d_id':jQuery('#gl_id').val()},
                             success     : function(response){

                             if(response['e_status'] == false){
                                     jQuery('#error_message').show();
                                     $('#resp_text').html(response['e_text']);
                                 }
                                 else {
                                      jQuery('#cheque_amountup').val(response['e_amount']);


                                 }

                             }
                         });

                }); 
            
        });
        
    </script>