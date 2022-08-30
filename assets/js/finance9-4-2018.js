jQuery(document).ready(function(){
  
    jQuery('#fn_coa_code').on('change',function(){
        var fn_coa_code = jQuery('#fn_coa_code').val();
        
            jQuery.ajax({
                type:'post',
                url : 'check_coa_parent',
                data:{'fn_coa_code':fn_coa_code},
                success:function(result){
               if(result ==1){
                   alert('Code already exist');
                   jQuery('#fn_coa_code').val('');
                   jQuery('#fn_coa_code').focus();
                   return false;
               }else{
                   //alert(result);
               }
            }

        });
     
 });  
    jQuery('#fn_coa_master_code').on('change',function(){
        var fn_coa_master_code = jQuery('#fn_coa_master_code').val();
        var coa_id = jQuery('#coa_id').val();
        jQuery.ajax({
                type:'post',
                url : 'check_coa_master',
                data:{'fn_coa_master_code':fn_coa_master_code,'coa_id':coa_id},
                success:function(result){
               if(result ==1){
                   alert('Code already exist');
                   jQuery('#fn_coa_master_code').val('');
                   jQuery('#fn_coa_master_code').focus();
                   return false;
               }else{
                   //alert(result);
               }
            }

        });
 });
 
 jQuery('#coa_parent_id').on('change',function(){
     
     var coa_parent_id = jQuery('#coa_parent_id').val();
     
     jQuery.ajax({
         type   :'post',
         url    :'get_master_record',
         data   :{'coa_parent_id':coa_parent_id},
         success:function(coa_p_record){
            jQuery('.coa_master_child_result').html(coa_p_record);
            jQuery('#default_master_child').hide();
         }
         
     });
     
 });
 jQuery('#master_subChild_code').on('change',function(){
     
     var coa_parent_id          = jQuery('#coa_parent_id').val();
     var master_child           = jQuery('#master_child').val();
     var master_subChild_code   = jQuery('#master_subChild_code').val();
     jQuery.ajax({
         type   :'post',
         url    :'check_master_subChild',
         data   :{'coa_parent_id':coa_parent_id,'master_child':master_child,'master_subChild_code':master_subChild_code},
         success:function(coa_p_record){
              if(coa_p_record ==1){
                   alert('Code already exist');
                   jQuery('#master_subChild_code').val('');
                   jQuery('#master_subChild_code').focus();
                 
                   return false;
               }else{
                   //alert(result);
               }
         }
         
     });
     
 });
 
 
 jQuery("#amount").autocomplete({
      
        minLength: 0,
        source: "autocompleteAmount/"+$("#amount").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#amount").val(ui.item.value);
            jQuery("#amountId").val(ui.item.code);
            jQuery("#code_id").val(ui.item.subPk);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
 
 jQuery("#payee").autocomplete({
      
        minLength: 0,
        source: "autocompleteEmp/"+$("#payee").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#empId").val(ui.item.emptId);
            jQuery("#payee").val(ui.item.person);
         
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
 
 jQuery('#update').on('click',function(){
  
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
                jQuery('#showTransitionRecord').html(result);
              var total = jQuery('#Fntotal').val();
            
              if(total == 0){
                  
                  //jQuery("input[name='saveTranst']").attr("disabled","");
                  jQuery('#saveTranst').prop('disabled',false);
              }
               if(total != 0){
                  jQuery('#saveTranst').prop('disabled',true);
              }
                
                var amount         = jQuery('#amount').val('');
                var amountId       = jQuery('#amountId').val('');
                var debit          = jQuery('#debit').val('');
                var credit         = jQuery('#credit').val('');
                
                
            }
        });
 });

 
 jQuery('#voucher').on('change',function(){
      
     var voucher     = jQuery('#voucher').val();
     var jbJv        = jQuery('#jbJv').val();
     
     jQuery.ajax({
         type   : 'post',
         url    : 'check_vocher',
         data   : {'vocher':voucher,'jbJv':jbJv},
         success: function(result){
             
            
             if(result == 1){
                 alert('Vocher No :'+voucher+' already Exist');
                 jQuery('#voucher').val('');
                 jQuery('#voucher').focus();
                 return false;
             }
         }
     });
 });
 jQuery('#jbJv').on('change',function(){
      
     var voucher     = jQuery('#voucher').val();
     var jbJv        = jQuery('#jbJv').val();
  
     jQuery.ajax({
         type   : 'post',
         url    : 'check_vocher_number',
         data   : {'vocher':voucher,'jbJv':jbJv},
         success: function(result){
            
            jQuery('#voucher').val(result);
            
//            
//             if(result == 1){
//                 alert('Vocher No :'+voucher+' already Exist');
//                 jQuery('#voucher').val('');
//                 jQuery('#voucher').focus();
//          
         }
     });
 });
 jQuery('#saveTranst').on('click',function(){
     
        var cheque         = jQuery('#cheque').val();
        var financial         = jQuery('#financial').val();
        var amountdate     = jQuery('#amountdate').val();
        var empId          = jQuery('#empId').val();
        var voucher        = jQuery('#voucher').val();
        var description    = jQuery('#description').val();
        var costCenter    = jQuery('#costCenter').val();
        var jbJv          = jQuery('#jbJv').val();
        var formCode         = jQuery('#formCode').val();
 
     
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
        'financial'    :financial,
        'voucher'      :voucher,
        'empId'        :empId,
        'description'  :description,
        'jbJv'         :jbJv,
        'costCenter'   :costCenter,
        'formCode'     :formCode
         
     }
        jQuery.ajax({
            type    : 'post',
            url     : 'saveAmount',
            data    : data,
            success : function(result){
              
                 var data = jQuery.parseJSON(result);
                 
                 if(data.status ==1){
                    alert(data.msg); 
                 }
                  if(data.status ==2){
                     
                     window.location.reload(); 
                 }
 
            }
        });
 });

 


 jQuery("#recordFrom").autocomplete({
      
        minLength: 0,
        source: "gl_autocomplete/"+$("#recordFrom").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#recordFrom").val(ui.item.value);
            jQuery("#recordFromCode").val(ui.item.mc_id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
 jQuery("#recordTo").autocomplete({
      
        minLength: 0,
        source: "gl_autocomplete/"+$("#recordTo").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            
            jQuery("#recordTo").val(ui.item.value);
            jQuery("#recordToCode").val(ui.item.mc_id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });

 //amount transtion
   jQuery('#table .3rd').dblclick(function () {
       
       var  mcId = this.id;
       var  mcClass = jQuery(this).prop("classList");
      
       var  array = mcId.split(',');
       
        jQuery('#myModal').modal('toggle');
        jQuery('#amount').val(array[0]);
        jQuery('#amountId').val(array[2]);
        jQuery('#code_id').val(array[1]);
 
});
 //Report RecordFrom
   jQuery('#table .recordFrom3rd').dblclick(function () {
       
       var  mcId = this.id;
       var  mcClass = jQuery(this).prop("classList");
      
       var  array = mcId.split(',');
       
        jQuery('#RecordFromTog').modal('toggle');
//        jQuery('#myModal').modal('toggle');
        jQuery('#recordFrom').val(array[0]);
        jQuery('#recordFromCode').val(array[1]);
 
});
 //Report RecordTo
   jQuery('#table .recordTo3rd').dblclick(function () {
       
       var  mcId = this.id;
       var  mcClass = jQuery(this).prop("classList");
      
       var  array = mcId.split(',');
       
        jQuery('#RecordToTog').modal('toggle');
//        jQuery('#myModal').modal('toggle');
        jQuery('#recordTo').val(array[0]);
    
        jQuery('#recordToCode').val(array[1]);
 
});



//trialBlance

jQuery('#searchTB').on('click',function(){
    var dateFrom            = jQuery('#dateFrom').val();
    var todate              = jQuery('#todate').val();
    var recordFromCode      = jQuery('#recordFromCode').val();
    var recordToCode        = jQuery('#recordToCode').val();
    jQuery.ajax({
        type    : 'post',
        url     : 'TBDetail',
        data    : {'dateFrom':dateFrom,'todate':todate,'recordTo':recordToCode,'recordFrom':recordFromCode},
        success : function(result){
           jQuery('#trailBalance').html(result);
        }
    });
});

//trialBlance Old

jQuery('#searchTBOld').on('click',function(){
    
    var dateFrom            = jQuery('#dateFrom').val();
    var todate              = jQuery('#todate').val();
    var recordFromCode      = jQuery('#recordFromCode').val();
    var recordToCode        = jQuery('#recordToCode').val();
    jQuery.ajax({
        type    : 'post',
        url     : 'TBDetailOld',
        data    : {
            'dateFrom'      : dateFrom,
            'todate'        : todate,
            'recordTo'      : recordToCode,
            'recordFrom'    : recordFromCode},
        success : function(result){
           jQuery('#trailBalance').html(result);
        }
    });
});




jQuery('#printLeader').on('click',function(){
    
    var dateFrom            = jQuery('#dateFrom').val();
    var dateto              = jQuery('#dateto').val();
    var recordFromCode      = jQuery('#recordFromCode').val();
    var recordToCode        = jQuery('#recordToCode').val();

    window.open('FinanceController/print_general_ledger/'+dateFrom+'/'+dateto+'/'+recordFromCode+'/'+recordToCode, '_blank');
});



jQuery('.amount_tran_details').on('click',function(){
    
    var amd = this.id;
    
    jQuery.ajax({
        type    : 'post',
        url     : 'trans_details',
        data    : {'amd':amd},
        success : function(result){
        
            jQuery('#transitionDetails').html(result);
        }
    });
    
});
 
 });


 jQuery('#update_vocher').on('click',function(){
   
   var invoice_date = jQuery('#invoice_date').val();
   
           jQuery.ajax({
            type    : 'post',
            url     : 'checkDateRange',
            data    : {'invoice_date':invoice_date},
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
    var amount          = jQuery('#amount').val();
    var amountId        = jQuery('#amountId').val();
    var code_id         = jQuery('#code_id').val();
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
         'payee_id_2'       :payee_id_2,
         'payee_type'       :payee_type,
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
                
                var amount         = jQuery('#amount').val('');
                var amountId       = jQuery('#amountId').val('');
                var debit          = jQuery('#debit').val('');
                var credit         = jQuery('#credit').val('');
                
                
            }
        });
                    
                    
                     
                 }
            }
        });
   
   
   
 });

//not used 
// jQuery('#xsave_vocher').on('click',function(){
//      
//         var invoice_date   = jQuery('#invoice_date').val();
//        var financial       = jQuery('#financial').val();
//        var voucherType     = jQuery('#voucherType').val();
//        var empId           = jQuery('#empId').val();
////        var voucher        = jQuery('#voucher').val();
//        var description    = jQuery('#description').val();
//        var costCenter    = jQuery('#costCenter').val();
////        var jbJv          = jQuery('#jbJv').val();
//        var formCode         = jQuery('#formCode').val();
// 
//        var attachment = $('input[type="checkbox"]:checked').map(function() {
//            return this.value;
//        }).get();
//  
////     if(cheque == ''){
////         alert('Please enter check number');
////         jQuery('#cheque').focus();
////         return false;
////     }
////     
////     if(voucher == ''){
////         alert('Please enter a valid voucher number');
////         jQuery('#voucher').focus();
////         return false;
////     }
//     var data = {
//        'invoice_date'       :invoice_date,
//         'attachment'   :attachment,
////        'financial'    :financial,
////        'voucher'      :voucher,
//        'empId'        :empId,
//        'description'  :description,
////        'jbJv'         :jbJv,
//        'costCenter'   :costCenter,
//        'formCode'     :formCode
//         
//     };
//        jQuery.ajax({
//            type    : 'post',
//            url     : 'VoucherSave',
//            data    : data,
//            success : function(result){
//              
//                 var data = jQuery.parseJSON(result);
//                 
//                 if(data.status ==1){
//                    alert(data.msg); 
//                 }
//                  if(data.status ==2){
//                   alert('record save');  
////                     window.location.reload(); 
//                 }
// 
//            }
//        });
// });



 jQuery("#fnEmployee").autocomplete({
      
        minLength: 0,
        source: "FnEmployee/"+$("#fnEmployee").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#fnEmployee").val(ui.item.value);
            jQuery("#fnEmployeeId").val(ui.item.code);
            jQuery("#propertier_name").val(ui.item.label);
            jQuery("#employee_id").val(ui.item.code);
          
            
//            jQuery("#fnSupplierName").val('');
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
 jQuery("#fnSupplierName").autocomplete({
      
        minLength: 0,
        source: "FnSupplierAuto/"+$("#fnSupplierName").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#fnSupplierName").val(ui.item.value);
            jQuery("#fnSupplierId").val(ui.item.code);
           
           
           var payee = jQuery('#propertier_name').val();
            
            jQuery("#propertier_name").val(payee+' '+ui.item.name+'');
            jQuery("#supplier_id").val(ui.item.code);
  
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });

jQuery('#add_fy_bgt').on('click',function(){
    
    var fy_year          = jQuery('#fy_year').val();
    var code_id     = jQuery('#code_id').val();
    var budget      = jQuery('#budget').val();
    var formCode    = jQuery('#formCode').val();
    var comments    = jQuery('#comments').val();
    
       if(code_id == ''){
         alert('Please select amount head');
         jQuery('#code_id').focus();
         return false;
     }
       if(budget == ''){
         alert('Please select Budget amount');
         jQuery('#budget').focus();
         return false;
     }
    
    jQuery.ajax({
        type    : 'post',
        url     : 'AddFyBudget',
        data    : {'fy_year':fy_year,'code_id':code_id,'budget':budget,'comments':comments,'formCode':formCode },
        success : function(result){
           jQuery('#showFyBudget').html(result);
        }
    });
});


