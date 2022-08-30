
<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><div><p style='padding-left: 70%;'><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p><p style='text-align: center;'>EDWARDES COLLEGE PESHAWAR <br/> BANK RECONCILIATION STATEMENT</p></div><body>";
//    var headstr = "<html><head><title></title></head><body><p ><img  style='text-align: right;' class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    location.reload();
    return false;
  }
</script>


 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"> <?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"> <?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Search</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                      if(@$GeneralLeader):
                                            $dateFrom           = $dateFrom;  
                                            $dateTo             = $toDate;
                                             $recordTo          = $recordTo;
                                            $recordFrom         = $recordFrom;
                                            
//                                            $recordFromCode   = $recordFromCode;
//                                            $recordToCode     = $recordToCode;

                                            else:
                                            $dateFrom           = date('d-m-Y');
                                            $dateTo             = date('d-m-Y');
                                            $SubmName           = 'AddCOA';   
                                            $recordFrom         = '';
                                            $recordFromCode     = '';
                                             
                                            $recordTo           = '';
                                            $recordToCode       = '';
                                            $btn                = 'Add';
                                            $status             = '';
                                            $icon               = 'plus';

                                        endif;
                                     ?>
                                <div class="row">
                                      
                                      
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">To</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'dateto',
                                                'id'            => 'dateto',
                                                'type'          => 'text ',
                                                'value'         => $dateTo,
                                                'class'         => 'form-control datepicker',
                                                   'readonly'      => 'readonly',
                                                'placeholder'   => 'Date to',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                    
                                    <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Record Form</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo    form_input(
                                                             array(
                                                                'name'          => 'recordFrom',
                                                                'id'            => 'recordFromGA',
                                                                'value'         => $recordFrom,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Record From',
                                                                 )
                                                             );
                                                      ?>
                                                
                                                 <?php
                                                    echo form_input(
                                                          array(
                                                                  'name'          => 'recordFromCode',
                                                                  'id'            => 'recordFromCode',
                                                                  'value'         => $recordFromCode,
                                                                  'type'          => 'hidden',
                                                                  'class'         => 'form-control',
                                                                  'placeholder'   => 'Account',
                                                                  )
                                                          );
                                                  ?>
                                                 
                                                <div class="input-group-btn">
                                                    <div class="btn-group" role="group">
                                                        <div class="dropdown dropdown-lg">
                                                           
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target="#RecordFromTog" aria-expanded="false"><span class="caret"></span></button>
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                                  
                                          
                                            </div>
                                       
                                            
                                     </div>
                                    
                                     <div class="col-md-3 col-sm-5">
                                         <div style="padding-top:9.5%;">
                                             <button type="button" class="btn btn-theme" name="search_brs_qa" id="search_brs_qa"  value="search_brs_qa" ><i class="fa fa-search"></i> Search COA</button>
                                         </div>
                                         
                                       
                                        
                                     </div>
                                      
                                </div>
                            <div id="unpresented_checks">
                            <hr/>
                                <div class="row">
                                      
                                      
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Voucher#</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'voch_no_ga',
                                                'id'            => 'voch_no_ga',
                                                'type'          => 'text',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Voucher#',    
                                                ));
                                        ?>
                                      </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Date</label>
                                          <?php

                                            echo form_input(array(
                                                'name'          => 'date',
                                                'id'            => 'unrep_date',
                                                'type'          => 'text ',
                                                   'readonly'      => 'readonly', 
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Date',    
                                                ));
                                        ?>
                                        
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Chq#</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'chq_no',
                                                'id'            => 'chq_no',
                                                'type'          => 'text ',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Cheque #',    
                                                ));
                                        ?>
                                      </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Amount</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'unpres_amount',
                                                'id'            => 'unpres_amount',
                                                'type'          => 'number',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Amount',    
                                                ));
                                        ?>
                                      </div>
                                    
                                    
                                      
                                    
                                      
                                      
                                </div>
                                <div class="row">
                                      
                                      
                                     <div class="col-md-6 col-sm-5 ">
                                          <label for="name">Payee #</label>
                                          <textarea class="form-control" rows="2" name="payee_name" id="payee_name" ></textarea>
                                            
                                       
                                     </div>
                                      
                                     <div class="col-md-6 col-sm-5 ">
                                          <label for="name">Description #</label>
                                          <textarea class="form-control" rows="2"  name="description" id="un_rep_desc" ></textarea>
                                            
                                       
                                     </div>
                                  </div>
                            <div style="padding-top:1%;">
                                <div class="col-md-6 pull-right">
                                    <button type="button" class="btn btn-theme" name="up_checks_ga" id="up_checks_ga"  value="up_checks_ga" ><i class="fa fa-plus"></i> Add Vouchers</button>
                                  </div>
                            </div>
                            <hr/>
                            
                            <div class="row">
                                      
                                      
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Type</label>
                                          <?php 
                                        echo form_dropdown('tran_type', $tran_type, '',  'class="form-control" id="tran_type"');
                                        ?>
                                      </div>
                                     <div class="col-md-6 col-sm-5">
                                          <label for="name">Descriptions</label>
                                          <?php

                                            echo form_input(array(
                                                'name'          => 'add_unpr_amount_desc',
                                                'id'            => 'add_unpr_amount_desc',
                                                'type'          => 'text ',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Descriptions',    
                                                ));
                                        ?>
                                        
                                     </div>
                                    
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Amount</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'add_unpres_amount',
                                                'id'            => 'add_unpres_amount',
                                                'type'          => 'number',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Amount',    
                                                ));
                                        ?>
                                      </div>
                                 </div>
                            
                            
                                
                            </div>
                            <div style="padding-top:1%;">
                                <div class="col-md-6 pull-right">
                                    
                                    <!--<button type="button" class="btn btn-theme" name="search_brs" id="search_brs"  value="search_brs" ><i class="fa fa-search"></i> Search COA</button>-->
                                    <button type="button" class="btn btn-theme" name="add_unpresent_amount" id="add_unpresent_amount"  value="add_unpresent_amount" ><i class="fa fa-plus"></i> Update Amount</button>
                                    <button type="button" class="btn btn-theme" name="save_checks_ga" id="save_checks_ga"  value="save_checks_ga" ><i class="fa fa-book"></i> Save</button>
                                    <button type="button" name="print" value="print" id="unpresent_print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                               </div>
                            </div>
                            
                            
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
              <div id="div_print">
<!--                  <div class="panel panel-theme">
                    <div class="panel-heading">
                        <h3 class="panel-title">Transitions</h3>
                    </div>
                    <div class="panel-body">
                           <div id="result_show_brs">


                        </div> 

                    </div>
                </div>      
                  
                  
             -->
                  
                    <div id="result_show_brs" style="margin-left:80px">
                    </div> 

                            
      
                </div>
              
<!--             Query time: {elapsed_time}-->
          </div>
          
      
      </div>
                 </div>
 
      </div>
  
    </div>
 
 
    
    
    <!--// Record From Tog--> 
  <div id="RecordFromTog" class="modal fade" role="dialog">
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
//                                 $COAP =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
                                if($COAP):
                                    foreach($COAP as $coapRow):
                                    
                                        echo '<tr class="first">
                                             <td>&nbsp;</td>
                                                <td>'.$coapRow->fn_coa_code.'</td>
                                                <td>'.$coapRow->fn_coa_title.'</td>

                                            </tr>';
                                                $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                foreach($coac as $coacRow):
                                                    
                                                     echo '<tr class="2nd">
                                                          <td>&nbsp;</td>
                                                            <td> '.$coacRow->fn_coa_m_code.'</td>

                                                            <td> &nbsp;&nbsp; &nbsp; &nbsp;'.$coacRow->fn_coa_m_title.'</td>


                                                        </tr>';
                                                $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));

                                                        foreach($coacs as $coacsRow):
                                                            
                                                             echo ' <tr class="recordFrom3rdga" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
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
          <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
</div>  
 
 
        
        
     <script>
jQuery(document).ready(function(){
    jQuery('#save_checks_ga').hide();
     //Report RecordFrom
   jQuery('#table .recordFrom3rdga').dblclick(function () {
       
       var  mcId = this.id;
       var  mcClass = jQuery(this).prop("classList");
      
       var  array = mcId.split(',');
       
        jQuery('#RecordFromTog').modal('toggle');
//        jQuery('#myModal').modal('toggle');
        jQuery('#recordFromGA').val(array[0]);
        jQuery('#recordFromCode').val(array[1]);
 
});
    
    
    jQuery('#search_brs_qa').on('click',function(){
   
        var dateto          = jQuery('#dateto').val();
        var recordFromCode  = jQuery('#recordFromCode').val();
        var formCode        = jQuery('#formCode').val();
   
    
    jQuery.ajax({
        type:'post',
        url:'FinanceController/brs_month_check',
        data:{'dateto':dateto,'coa':recordFromCode},
        success:function(result){
            if(result == '1'){
                alert('This month already Reconcile or conect to Finance Officer');
            return false;
                }else{
            if(dateto == ''){
                alert('Please enter to Date');
                jQuery('#dateto').focus();
            return false;
            }
            if(recordFromCode == ''){
                alert('Please enter from code');
                jQuery('#recordFromCode').focus();
             return false;
            }
     
     var data = {
         
         'dateto':          dateto,
         'recordFromCode':  recordFromCode,
         'formCode':        formCode
     };
    
    jQuery.ajax({
        type    : 'post',
        url     : 'FinanceController/search_bank_reconciliation_statement',
        data    : data,
        complete : function(result){
            
            jQuery.ajax({
                type    : 'post',
                url     : 'FinanceController/show_result_bank_reconciliation_statument',
                data    : {'formCode':formCode},
                success  : function(result){
                   
                    jQuery('#unpresented_checks').show('slow');
                    jQuery('#up_checks_ga').show();
                    jQuery('#result_show_brs').show();
                    jQuery('#add_unpresent_amount').show();
                    jQuery('#result_show_brs').html(result); 
                }
                
            });
        },error: function (error) {
            
            console.log(eval(error));}
                }); 
                }
            },
    });
    
       
});
jQuery('#up_checks_ga').on('click',function(){
 
    jQuery('#search_brs_ga').hide();
    
    var voch_no_ga      = jQuery('#voch_no_ga').val();
    var unrep_date      = jQuery('#unrep_date').val();
    var chq_no          = jQuery('#chq_no').val();
    var formCode        = jQuery('#formCode').val();
    var unpres_amount   = jQuery('#unpres_amount').val();
    var payee_name      = jQuery('#payee_name').val();
    var un_rep_desc     = jQuery('#un_rep_desc').val();
     
    
       
       if(voch_no_ga == ''){
         alert('Please enter to voucher#');
         jQuery('#voch_no_ga').focus();
         return false;
     }
       if(unrep_date == ''){
         alert('Please enter Date');
         jQuery('#unrep_date').focus();
         return false;
     }
       if(chq_no == ''){
         alert('Please enter Cheque#');
         jQuery('#chq_no').focus();
         return false;
     }
       if(unpres_amount == ''){
         alert('Please enter Amount');
         jQuery('#unpres_amount').focus();
         return false;
     }
       if(payee_name == ''){
         alert('Please enter Payee');
         jQuery('#payee_name').focus();
         return false;
     }

     var data = {
         
         'voch_no':      voch_no_ga,
         'unrep_date':      unrep_date,
         'chq_no':          chq_no,
         'formCode':        formCode,
         'unpres_amount':   unpres_amount,
         'payee_name':      payee_name,
         'un_rep_desc':     un_rep_desc,
     };
    
    jQuery.ajax({
        type    : 'post',
        url     : 'FinanceController/insert_unpresent_check',
        data    : data,
        complete : function(result){
            
            jQuery.ajax({
                type    : 'post',
                url     : 'FinanceController/show_result_bank_reconciliation_statument',
                data    : {'formCode':formCode},
                success  : function(result){
                    
                    jQuery('#result_show_brs').show();
                    jQuery('#save_checks_ga').show();
                    jQuery('#result_show_brs').html(result); 
                    
                    var voch_no_ga      = jQuery('#voch_no_ga').val('');
                    var unrep_date      = jQuery('#unrep_date').val('');
                    var chq_no          = jQuery('#chq_no').val('');
                    var unpres_amount   = jQuery('#unpres_amount').val('');
                    var payee_name      = jQuery('#payee_name').val('');
                    var un_rep_desc     = jQuery('#un_rep_desc').val('');
                     
                }
                
            });
            
        },error: function (error) {
            
            alert('error; Please Check Console log' + eval(error));
}
    });
});
 



//Search by Voucher no 
    jQuery("#voch_no_ga").autocomplete({  
        minLength: 0,
        source: "FnBRSVoucherAutoGA/"+$("#voch_no_ga").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#voch_no_ga").val(ui.item.contactPerson);
        jQuery("#unrep_date").val(ui.item.date);
        jQuery("#chq_no").val(ui.item.cheque);
        jQuery("#payee_name").val(ui.item.payee);
        jQuery("#un_rep_desc").val(ui.item.desc);
        jQuery("#unpres_amount").val(ui.item.amount);
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
//Search GA COA
 jQuery("#recordFromGA").autocomplete({
      
        minLength: 0,
        source: "FnBRSAutoCompleteGA/"+$("#recordFromGA").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#recordFromGA").val(ui.item.value);
            jQuery("#recordFromCode").val(ui.item.mc_id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
    
    
    
 jQuery('#save_checks_ga').on('click',function(){
   
    var dateto          = jQuery('#dateto').val();
    var formCode        = jQuery('#formCode').val();
    var recordFromCode  = jQuery('#recordFromCode').val();

    var data = {
        'dateto'            : dateto,
        'formCode'          : formCode,
        'recordFromCode'    : recordFromCode,
    };
    
    jQuery.ajax({
        type    : 'post',
        url     : 'BRSSaveGA',
        data    : data,
        success : function(result){
           
            location.reload(); 
           
        },error: function (error) {
            
            console.log(eval(error));
           alert('error; ' + eval(error));
}
    }); 



    
});   

    
});         
         
         
         
         
  $( function() {
    $( ".datepicker" ).datepicker({
         changeMonth: true,
    changeYear: true,
    dateFormat: 'dd-mm-yy'
    });
  } );
  
  
  
  </script>        
  

 