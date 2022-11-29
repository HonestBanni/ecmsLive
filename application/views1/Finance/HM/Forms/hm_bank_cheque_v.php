
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
    
    </header> 
    
        
        
        
        <div class="page-content">
            <div class="col-md-12">
                <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header;?>  Form</span>
                    </h1>
                    <div class="section-content" >
                        <div class="row">
                               <?php echo form_open('',array('class'=>'course-finder-form','id'=>'SaveChequeForm'))?>
                                   <div class="col-md-3 col-sm-5">
                                        <label for="name">Check Print Date</label>
                                    <?php
                                       $payment_date = date('d-m-Y'); 
                                       echo form_input(array(
                                                'id'            => 'date',
                                                'name'          => 'date',
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Check Date',
                                                'value'         => $payment_date ,
                                                'type'          => 'text',
                                                'readonly'      => 'readonly',
                                                'required'         => 'required',
                                                ));
                                            ?> 
                                    </div>
                                   <div class="col-md-9 col-sm-5">
                                         <label for="name">Pay to  :</label>
                                           
                                          <?php
                                          
                                          $paye = array(
                                              ''                        => 'Please Select Payee',
                                              $result->gl_at_payeeId    => 'Payee : '.$result->gl_at_payeeId,
                                              $result->company_name     => 'Company Name : '.$result->company_name,
                                          );
                                             echo  form_dropdown('payee',$paye,'',  'class="form-control" ');  
//                                              echo form_input(array(
//                                                  'name'        => 'payee',
//                                                  'id'          => 'payee',
//                                                  'class'       => 'form-control',
//                                                  'type'        => 'text',
//                                                  'value'       => $result->gl_at_payeeId.' , '.$result->company_name,
//                                                  ));
                                              echo form_input(array(
                                                  'name'        => 'gl_id',
                                                  'id'          => 'gl_id',
                                                  'type'        => 'hidden',
                                                  'value'       => $result->gl_at_id,
                                                  ));
                                              
                                          ?>
                                         
                                     </div>
                                    
                                    <div class="col-md-3 col-sm-5">
                                            <label for="name">Bank For Check</label>
                                              <?php    
                                               
                                              echo form_dropdown('bank_name',$bank_COA,'',  'class="form-control" required="required" id="bank_coa" '); 
                                           ?>

                                    </div>
                                  <div class="col-md-3 col-sm-5">
                                          <label for="name">Cheque No.</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'cheque_no',
                                            'id'            => 'cheque_no',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Cheque No.',
                                            'type'          => 'text',
                                            ));
                                        ?>
                                     </div>
                                  <div class="col-md-3 col-sm-5">
                                          <label for="name">Cheque Amount</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'cheque_amount',
                                            'id'            => 'cheque_amount',
                                            
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Cheque Amount',
                                             'readonly'      => 'readonly',   
                                            'type'          => 'text',
                                            ));
                                        ?>
                                     </div>
                                  <div class="col-md-3 col-sm-5">
                                          <label for="name">Cheque Type</label>
                                              
                                          <?php
                                           
                                             echo form_dropdown('cheque_type',$cheque_type,'',  'class="form-control" ');  
                                             
                                              
                                          ?>
                                     </div>
                                 <div class="col-md-12">
                                     <label for="name"  style="padding-top: 20px;" >Cheque Signature By :</label>
                                 </div>
                                    
                                    <div class="col-md-12">
                                          <?php
                                           if($gl_sign_list):
                                                foreach($gl_sign_list as $va_row):
                                                echo   '<div class="col-md-3 col-sm-5">';
                                                  
                                                  echo     '<label  style="font-size: 20px;"><input style="zoom: 1.8;" type="checkbox" name="SignaturePersons[]" '.$va_row->selected_status.'  value="'.$va_row->gl_cs_id.'">&nbsp;&nbsp;&nbsp;'.$va_row->emp_name.'</label>';
                                                 echo  '</div>';

                                                endforeach;
                                            endif;

                                            ?>
                                     </div>
                                 
                                  
                                       <div class="col-md-12">
                                           
                                       
                                        <div style="padding-top: 2%;padding-left: 2%;">
                                        <div class="col-md-2 pull-right">
                                            <!--<button type="button"   class="btn btn-theme"  id="preview" name="preview"><i class="fa fa-search"></i> Save</button>-->
                                            <button type="button" class="btn btn-theme"  id="SaveCheque" name="SaveCheque"><i class="fa fa-save"></i> Save</button>
 

                                        </div>
                                    </div>
                                           </div>
                                     
                                <?php echo form_close()?>
                        </div>
                    </div>
                </section>
                 
                    <div id="PreivewCheque">


                        </div>
                    <div id="showTransitionRecord">


                        </div>
                
                 <div class="modal fade" id="entry_validation" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #c00;" id="resp_icon"></h1>
                                    <h4 style="text-align:center; color: #c00; margin: 0px;"><strong id="resp_type"></strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong id="resp_text"></strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="entry_success" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1 style="text-align:center; font-size: 80px; color: #0e7a44;" id="succ_icon"></h1>
                                    <h4 style="text-align:center; color: #0e7a44; margin: 0px;"><strong id="succ_type"></strong></h4>
                                    <p style="margin:0">&nbsp;</p>
                                    <h4 style="text-align:center"><strong id="succ_text"></strong></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                                </div>
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
 
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>
  
  <script>
      jQuery(document).ready(function(){
          trans_details();
          SaveChequeResult();
          jQuery('#SaveCheque').on('click',function(){
              
              var form = $('#SaveChequeForm');
              jQuery.ajax({
                type        : 'post',
                url         : 'SaveCheque',
                dataType    : 'json',
                data        : form.serialize(),
                success     : function(response){
                
                 if(response['e_status'] == false){
                        $('#resp_icon').html(response['e_icon']);
                        $('#resp_type').html(response['e_type']);
                        $('#resp_text').html(response['e_text']);
                        $('#entry_validation').modal('toggle');
                    }
                    else {
                        $('#succ_icon').html(response['e_icon']);
                        $('#succ_type').html(response['e_type']);
                        $('#succ_text').html(response['e_text']);
                        $('#entry_success').modal('toggle');
                        SaveChequeResult();
                   
                    }
                
                
                }
            });
          });

   jQuery('#bank_coa').on('change',function(){
       
       
       jQuery.ajax({
                type        : 'post',
                url         : 'BankCoAmount',
                dataType    : 'json',
                data        : {'coa_id':jQuery(this).val(),'gl_d_id':jQuery('#gl_id').val()},
                success     : function(response){
                 
                if(response['e_status'] == false){
                        $('#resp_icon').html(response['e_icon']);
                        $('#resp_type').html(response['e_type']);
                        $('#resp_text').html(response['e_text']);
                        $('#entry_validation').modal('toggle');
                    }
                    else {
                         jQuery('#cheque_amount').val(response['e_amount']);
                       
                   
                    }
                
                }
            });
       
   });  
            

 function SaveChequeResult(){
     //Save Check Results
      jQuery.ajax({
            type    : 'post',
            url     : 'SaveChequeResult',
            data    : {'gl_id':jQuery('#gl_id').val()},
            success : function(result){
            jQuery('#PreivewCheque').html(result);
            }
        });
 }
 function trans_details(){
     //Transition Result
     jQuery.ajax({
        type    : 'post',
        url     : 'trans_details',
        data    : {'amd':jQuery('#gl_id').val()},
        success : function(result){
        jQuery('#showTransitionRecord').html(result);
        }
    });
 }
      });
      </script>