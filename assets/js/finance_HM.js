jQuery(document).ready(function(){
  

    
     
    jQuery('#hmadd_fy_bgt').on('click',function(){
    
    var fy_year     = jQuery('#fy_year').val();
    var code_id     = jQuery('#hmcode_id').val();
    var budget      = jQuery('#budget').val();
    var formCode    = jQuery('#formCode').val();
    var comments    = jQuery('#comments').val();
    
  
    
       if(code_id == ''){
         alert('Please select amount head');
         jQuery('#hmcode_id').focus();
         return false;
     }
       if(budget == ''){
         alert('Please select Budget amount');
         jQuery('#budget').focus();
         return false;
     }
    
    var data = {
        'fy_year'   :fy_year,
        'code_id'   :code_id,
        'budget'    :budget,
        'comments'  :comments,
        'formCode'  :formCode 
    };
    
     console.log();
    jQuery.ajax({
        type    : 'post',
        url     : 'AddFyBudget',
        data    : data ,
        success : function(result){
           jQuery('#showFyBudget').html(result);
        }
    });
});


 jQuery('#update_vocher_hm').on('click',function(){
   
   var invoice_date     = jQuery('#invoice_date').val();
    var fy              = jQuery('#fy').val();
   
           jQuery.ajax({
            type    : 'post',
            url     : 'HmCheckDateRange',
            data    : {'invoice_date':invoice_date,'fy':fy},
            success : function(result){
                 if(result == 1){
                     alert('Process date is incorrect');
                      jQuery('#invoice_date').focus();
                     return false;
                 }else{
                     
                     
                    
                    
   
    var cheque          = jQuery('#cheque').val();
    var amountdate      = jQuery('#amountdate').val();
    var propertier_name = jQuery('#propertier_name').val();
    var payee_id_2      = jQuery('#payee_id_2').val();
    var payee_type      = jQuery('#payee_type').val();
    var voucher         = jQuery('#voucher').val();
    var description     = jQuery('#description').val();
    var costCenter      = jQuery('#costCenter').val();
    var supplier        = jQuery('#supplier').val();
    var amount          = jQuery('#hmamount').val();
    var amountId        = jQuery('#hmamountId').val();
    var code_id         = jQuery('#hmcode_id').val();
    var debit           = jQuery('#debit').val();
    var credit          = jQuery('#credit').val();
    var formCode        = jQuery('#formCode').val();
     
    
    
     if(propertier_name == ''){
         alert('Please select Supplier Or Employee ');
         jQuery('#supplier').focus();
         return false;
     }
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
         'payee_id_2'   :payee_id_2,
         'payee_type'   :payee_type,
         'amountdate'   :amountdate,
         'voucher'      :voucher,
         'propertier_name':propertier_name,
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
            url     : 'VoucherUpdate',
            data    : data,
            success : function(result){
                jQuery('#showTransitionRecord').html(result);
              var total = jQuery('#Fntotal').val();
            
              if(total == 0){
                  
                  //jQuery("input[name='saveTranst']").attr("disabled","");
                  jQuery('#save_vocher').prop('disabled',false);
              }
               if(total != 0){
                  jQuery('#save_vocher').prop('disabled',true);
              }
                
                var amount         = jQuery('#hmamount').val('');
                var amountId       = jQuery('#hmamountId').val('');
                var debit          = jQuery('#debit').val('');
                var credit         = jQuery('#credit').val('');
                
                
            }
        });
                    
                    
                     
                 }
            }
        });
 });
  jQuery("#HmRecordFrom").autocomplete({
      
        minLength: 0,
        source: "HmAutocompleteAmount/"+$("#HmRecordFrom").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#HmRecordFrom").val(ui.item.value);
            jQuery("#HmRrecordFromCode").val(ui.item.subPk);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });  

    jQuery('#result_show_brs').hide();
//    jQuery('#up_checks_hm').hide();
    jQuery('#save_checks_hm').hide();
    jQuery('#unpresent_print').hide();
    jQuery('#unpresented_checks').hide();
    jQuery('#add_unpresent_amount_hm').hide();
    
 jQuery('#search_hm_brs').on('click',function(){
//    var dateFrom        = jQuery('#dateFrom').val();
    var dateto          = jQuery('#dateto').val();
    var recordFromCode  = jQuery('#HmRrecordFromCode').val();
    var formCode        = jQuery('#formCode').val();
 
    
    jQuery.ajax({
        type:'post',
        url:'FNHostelMessController/hm_brs_month_check',
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
        url     : 'FNHostelMessController/hm_search_bank_reconciliation_statement',
        data    : data,
        complete : function(result){
            
            jQuery.ajax({
                type    : 'post',
                url     : 'FNHostelMessController/hm_show_result_bank_reconciliation_statument',
                data    : {'formCode':formCode},
                success  : function(result){
                   
                    jQuery('#unpresented_checks').show('slow');
                    jQuery('#up_checks_hm').show();
                    jQuery('#result_show_brs').show();
                    jQuery('#add_unpresent_amount_hm').show();
                    jQuery('#result_show_brs').html(result); 
                }
                
            });
        },error: function (error) {
            
            console.log(eval(error));
//            alert('error; ' + eval(error));
}
    }); 
          }
            
        },
    });
    
       
}); 

 

jQuery('#up_checks_hm').on('click',function(){
 
    jQuery('#search_brs').hide();
    
    var voch_no         = jQuery('#voch_no_hm').val();
    var unrep_date      = jQuery('#unrep_date').val();
    var chq_no          = jQuery('#chq_no').val();
    var formCode        = jQuery('#formCode').val();
    var unpres_amount   = jQuery('#unpres_amount').val();
    var payee_name      = jQuery('#payee_name').val();
    var un_rep_desc     = jQuery('#un_rep_desc').val();
     
    
       
       if(voch_no == ''){
         alert('Please enter to voucher#');
         jQuery('#voch_no').focus();
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
         
         'voch_no':         voch_no,
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
                     jQuery('#save_checks_hm').show();
                    jQuery('#result_show_brs').html(result); 
                    
                    var voch_no         = jQuery('#voch_no_hm').val('');
                    var unrep_date      = jQuery('#unrep_date').val('');
                    var chq_no          = jQuery('#chq_no').val('');
                    var unpres_amount   = jQuery('#unpres_amount').val('');
                    var payee_name      = jQuery('#payee_name').val('');
                    var un_rep_desc     = jQuery('#un_rep_desc').val('');
                     
                }
                
            });
            
        },error: function (error) {
            
            alert('error; ' + eval(error));
}
    });
});   

 jQuery('#add_unpresent_amount_hm').on('click',function(){
 
    jQuery('#search_brs').hide();
    
    var tran_type           = jQuery('#tran_type').val();
    var add_unpres_amount   = jQuery('#add_unpres_amount').val();
    var formCode            = jQuery('#formCode').val();
    var desc                = jQuery('#add_unpr_amount_desc').val();
    
     
    
       
       if(tran_type == ''){
         alert('Please Select Type#');
         jQuery('#tran_type').focus();
         return false;
     }
       if(add_unpres_amount == ''){
         alert('Please enter Amount');
         jQuery('#add_unpres_amount').focus();
         return false;
     }
   

     var data = {
         
         'tran_type':         tran_type,
         'add_unpres_amount': add_unpres_amount,
          'formCode':        formCode,
          'desc':           desc,
         
     };
    
    jQuery.ajax({
        type    : 'post',
        url     : 'FNHostelMessController/insert_unpresent_tran_amount_hm',
        data    : data,
        complete : function(result){
            
            jQuery.ajax({
                type    : 'post',
                url     : 'FNHostelMessController/hm_show_result_bank_reconciliation_statument',
                data    : {'formCode':formCode},
                success  : function(result){
                    
                    
                    
                    jQuery('#result_show_brs').show();
                     jQuery('#save_checks_hm').show();
                    jQuery('#result_show_brs').html(result); 
                   
                    var tran_type           = jQuery('#tran_type').val('');
                    var add_unpres_amount   = jQuery('#add_unpres_amount').val('');
                    var desc                = jQuery('#add_unpr_amount_desc').val('');
                     
                }
                
            });
            
        },error: function (error) {
            alert('error; ' + eval(error));
}
    });
});



jQuery('#save_checks_hm').on('click',function(){
        
    var dateto          = jQuery('#dateto').val();
    var formCode        = jQuery('#formCode').val();
    var recordFromCode  = jQuery('#HmRrecordFromCode').val();

    var data = {
        'dateto' : dateto,
        'formCode' : formCode,
        'recordFromCode' : recordFromCode,
    };
    
    jQuery.ajax({
        type    : 'post',
        url     : 'FNHostelMessController/hm_bank_reconciliation_statement_save',
        data    : data,
        success : function(result){
            
            // if (confirm("Are you sure to print this report !")) {
            //    jQuery('#unpresent_print').show();
            //    jQuery('#save_checks').hide();
              
            // } else {
            //     location.reload();
            // }
            location.reload(); 
           
        },error: function (error) {
            
            console.log(eval(error));
           alert('error; ' + eval(error));
}
    }); 



    
});



jQuery('#HmSearchTB').on('click',function(){
    jQuery('#trailBalance').hide();
    var dateFrom            = jQuery('#dateFrom').val();
    var todate              = jQuery('#todate').val();
    var recordFromCode      = jQuery('#recordFromCode').val();
    var recordToCode        = jQuery('#recordToCode').val();
    jQuery.ajax({
        type    : 'post',
        url     : 'HmTBDetail',
        data    : {
            'dateFrom'      : dateFrom,
            'todate'        : todate,
            'recordTo'      : recordToCode,
            'recordFrom'    : recordFromCode},
        success : function(result){
            jQuery('#trailBalance').show();
           jQuery('#trailBalance').html(result);
        }
    });
});


 jQuery("#recordFromHM").autocomplete({
      
        minLength: 0,
        source: "HmAutocompleteAmount/"+$("#recordFromHM").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#recordFromHM").val(ui.item.value);
            jQuery("#recordFromCodeHM").val(ui.item.mc_id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
 jQuery("#recordToHM").autocomplete({
      
        minLength: 0,
        source: "HmAutocompleteAmount/"+$("#recordToHM").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            
            jQuery("#recordToHM").val(ui.item.value);
            jQuery("#recordToCodeHM").val(ui.item.mc_id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });

//Report RecordFrom
   jQuery('#table .recordFrom3rdHM').dblclick(function () {
       
       var  mcId = this.id;
       var  mcClass = jQuery(this).prop("classList");
      
       var  array = mcId.split(',');
       
        jQuery('#RecordFromTog').modal('toggle');
//        jQuery('#myModal').modal('toggle');
        jQuery('#recordFromHM').val(array[0]);
        jQuery('#recordFromCodeHM').val(array[1]);
 
});
 //Report RecordTo
   jQuery('#table .recordTo3rdHM').dblclick(function () {
       
       var  mcId = this.id;
       var  mcClass = jQuery(this).prop("classList");
      
       var  array = mcId.split(',');
       
        jQuery('#RecordToTog').modal('toggle');
//        jQuery('#myModal').modal('toggle');
        jQuery('#recordToHM').val(array[0]);
    
        jQuery('#recordToCodeHM').val(array[1]);
 
});

});

 
