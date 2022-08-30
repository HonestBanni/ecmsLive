jQuery(document).ready(function(){
  
  
     jQuery('#coa_fee_parent_id').on('change',function(){
     
    
     var coa_parent_id = jQuery('#coa_fee_parent_id').val();
     
     jQuery.ajax({
         type   :'post',
         url    :'feeMasterRecord',
         data   :{'coa_parent_id':coa_parent_id},
         success:function(coa_p_record){
            jQuery('.fee_coa_master_child_result').html(coa_p_record);
            jQuery('#default_master_child').hide();
         }
         
     });
     
 });
 
   jQuery("#get_fee_heads").autocomplete({
      
        minLength: 0,
        source: "feeHeadCOA/"+$("#get_fee_heads").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#get_fee_heads").val(ui.item.value);
            jQuery("#get_fee_heads_code").val(ui.item.mc_id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
  
  
     jQuery('#table .get_fee_heads3rd').dblclick(function () {
       
       var  mcId = this.id;
       var  mcClass = jQuery(this).prop("classList");
      
       var  array = mcId.split(',');
       console.log(array);
        jQuery('#RecordFromTog').modal('toggle');
//        jQuery('#myModal').modal('toggle');
        jQuery('#get_fee_heads').val(array[0]);
        jQuery('#get_fee_heads_code').val(array[1]);
 
});
  
  
    jQuery('#feeProgrameId').on('click',function(){
    
     var programId = jQuery('#feeProgrameId').val();
     
        //get sub program
        jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getSubProgram',
         data   :{'programId':programId},
         success :function(result){
            jQuery('#showFeeSubPro').html(result);
        },
        complete:function(){
           
             var sub_program_id = jQuery('#showFeeSubPro').val();
             var programId = jQuery('#feeProgrameId').val();
            // get Section 
            jQuery.ajax({
                type   :'post',
                url    :'feeController/getSections',
                data   :{'sub_program_id':sub_program_id,'programId':programId},
               success :function(result){
                   console.log(result);
                  jQuery('#showSections').html(result);
               }
            });
             
            //payment category 
            
            jQuery.ajax({
                type   :'post',
                url    :'feeController/getPaymentCategory',
                data   :{'sub_program_id':sub_program_id},
                success :function(result){
                   console.log(result);
                  jQuery('.payment_cat').html(result);
               },
               complete:function(){
                   var pc_id = jQuery('#pc_id').val();
                     jQuery.ajax({
                            type   :'post',
                            url    :'feeController/get_payment_date',
                            data   :{'pc_id':pc_id},
                            success :function(result){
                               var date = JSON.stringify(result);
//                               var date = jQuery.parseJSON(result);
                               
                               
                                jQuery('#fromDate').val(date.fee_from);
                                jQuery('#uptoDate').val(date.fee_to); 
                                jQuery('#dueDate').val(date.valid_till); 
                            }
                        });
                    
                    
               }
            });
            
            //Get Batch 
            jQuery.ajax({
                type   :'post',
                url    :'feeController/getBatch',
                data   :{'programId':programId},
               success :function(result){
                   console.log(result);
                  jQuery('#batch_id').html(result);
               }
            });
            
              
        }
        
     });
     
 });
jQuery('#showFeeSubPro').on('change',function(){
        
  
     var programId = jQuery('#feeProgrameId').val();
  
     jQuery.ajax({
         type   :'post',
         url    :'feeController/getBatch',
         data   :{'programId':programId},
        success :function(result){
            console.log(result);
           jQuery('#batch_id').html(result);
        }
     });
     
     
     
     
 });
jQuery('#showFeeSubPro').on('change',function(){
    
    var sub_program_id= jQuery('#showFeeSubPro').val();
     var programId = jQuery('#feeProgrameId').val();
     jQuery.ajax({
         type   :'post',
         url    :'feeController/getSections',
         data   :{'sub_program_id':sub_program_id,'programId':programId},
        success :function(result){
            console.log(result);
           jQuery('#showSections').html(result);
        }
     });
 });
jQuery('#showFeeSubPro').on('change',function(){
    
    var sub_program_id= jQuery('#showFeeSubPro').val();
     jQuery.ajax({
         type   :'post',
         url    :'feeController/getPaymentCategory',
         data   :{'sub_program_id':sub_program_id},
        success :function(result){
            console.log(result);
           jQuery('.payment_cat').html(result);
        }
     });
 });
jQuery('#showFeeSubPro').on('change',function(){
    
     var sub_program_id= jQuery('#showFeeSubPro').val();
     var programId      = jQuery('#feeProgrameId').val();
     jQuery.ajax({
         type   :'post',
         url    :'feeController/getSections',
         data   :{'sub_program_id':sub_program_id,'programId':programId},
        success :function(result){
            console.log(result);
           jQuery('#showSections').html(result);
        }
     });
 });
 
 jQuery('#fee_save_challan').hide();
 
 jQuery('#fee_challan_search').on('click',function(){
      
        var data = {
            'programe_id'   :jQuery('.programe_id').val(),
            'sub_pro_id'    :jQuery('#showFeeSubPro').val(), 
            'batch_id'      :jQuery('#batch_id').val(),
            'section'       :jQuery('.section').val(),
            'pc_id'         :jQuery('#pc_id').val(),
            'fromDate'      :jQuery('#fromDate').val(),
            'uptoDate'      :jQuery('#uptoDate').val(),
            'printDate'     :jQuery('#printDate').val(),
            'bank_id'       :jQuery('#bank_id').val(),
            'comment'       :jQuery('#comment').val()
        };
//        console.log(data);
       jQuery.ajax({
         type   :'post',
         url    :'feeController/fee_challan_search',
         data   :data,
         success :function(result){
//            console.log(result);
            jQuery('#fee_save_challan').show();
            jQuery('#show_fee_students').html(result);
        }
     });
     
 });
 
 jQuery('#printChallan').on('click',function(){
    
    var feeProgrameId   = jQuery('#feeProgrameId').val();
    var showFeeSubPro   = jQuery('#showFeeSubPro').val();
    var showSections    = jQuery('#showSections').val();
    var pc_id           = jQuery('#pc_id').val();
   
    if(feeProgrameId == ''){
        alert('Please Select Program');
        jQuery('#feeProgrameId').focus();
         return false();
    }
    if(showFeeSubPro == ''){
       alert('Please Select Sub Program');
        jQuery('#showFeeSubPro').focus();
         return false(); 
    }
    
    if(pc_id == ''){
       alert('Please Select Payment');
        jQuery('#pc_id').focus();
         return false();   
    }
    
    if(showSections == ''){
        window.open('PrintLanguages/'+feeProgrameId+'/'+showFeeSubPro+'/'+pc_id, '_blank');  
    }else{
        
      window.open('PrintClassWise/'+feeProgrameId+'/'+showFeeSubPro+'/'+showSections+'/'+pc_id, '_blank');  
    }


      
      
});
 
 
 
//jQuery('#printChallan').on('click',function(){
//    
//    var feeProgrameId   = jQuery('#feeProgrameId').val();
//    var showFeeSubPro   = jQuery('#showFeeSubPro').val();
//    var showSections    = jQuery('#showSections').val();
//    var pc_id           = jQuery('#pc_id').val();
//   
//    if(feeProgrameId == ''){
//        alert('Please Select Program');
//        jQuery('#feeProgrameId').focus();
//         return false();
//    }
//    if(showFeeSubPro == ''){
//       alert('Please Select Sub Program');
//        jQuery('#showFeeSubPro').focus();
//         return false(); 
//    }
//    if(showSections == ''){
//        alert('Please Select Section');
//        jQuery('#showSections').focus();
//         return false();  
//    }
//    if(pc_id == ''){
//        
//    }
//
//      window.open('PrintClassWise/'+feeProgrameId+'/'+showFeeSubPro+'/'+showSections+'/'+pc_id, '_blank');
//});
    
jQuery('#paymentCategory_id').focus(function(){
    
});


jQuery("#pc_id_name").autocomplete({
      
        minLength: 0,
        source: "payment_autocomplete/"+$("#pc_id_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#pc_id_name").val(ui.item.contactPerson);
        jQuery("#pc_id_code").val(ui.item.code);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });

  jQuery('#payment_Add').on('click',function(){
  
      var fee_head = jQuery('#fee_head').val();
      if(fee_head == ''){
         alert('Select Fee Head');
         jQuery('#fee_head').focus();
         return false;
      }
      var amount = jQuery('#fee_head_amount').val();
      if(amount == ''){
         alert('Enter Head Amount');
         jQuery('#fee_head_amount').focus();
         return false;
      }
        var data = {
            'fee_head'  :fee_head,
            'amount'    :amount,
            'formCode'  :jQuery('#formCode').val()
         
        };
     
        jQuery.ajax({
         type   :'post',
         url    :'feeController/class_setup_dublicate_check',
         data   :data,
         success :function(result){
            
            if(result == 1){
               
                alert('Record exist');
                jQuery('#fee_head').val('');
                jQuery('#fee_head_amount').val('');
                jQuery('#fee_head_name').val('');
                jQuery('#fee_head_name').focus();
                return false;
            }
            
             
             if(result == 0){
                 
                 
                   jQuery.ajax({
                    type   :'post',
                    url    :'feeController/add_class_setup_demo',
                    data   :data,
                    success :function(result){
                        jQuery('#fee_head').val('');
                        jQuery('#fee_head_name').val('');
                        jQuery('#fee_head_amount').val('');
                        jQuery('#class_setup').html(result);
                            }
                         });
            }
        }
     });
   
     
 });



  jQuery("#fee_head_name").autocomplete({
      
        minLength: 0,
        source: "feeController/fee_head_auto/"+$("#fee_head_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#fee_head_name").val(ui.item.value);
            jQuery("#fee_head").val(ui.item.fh_Id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });







  jQuery("#batch_id_name").autocomplete({
      
        minLength: 0,
        source: "feeController/batch_auto_complete/"+$("#batch_id_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#batch_id_name").val(ui.item.value);
            jQuery("#batch_id_name_code").val(ui.item.pk_id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
  jQuery("#shift_name").autocomplete({
      
        minLength: 0,
        source: "feeController/shift_auto_complete/"+$("#shift_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#shift_name").val(ui.item.value);
            jQuery("#shift_name_code").val(ui.item.id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
  jQuery("#challan_comment").autocomplete({
      
        minLength: 0,
        source: "feeController/comment_auto/"+$("#challan_comment").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#challan_comment").val(ui.item.value);
            jQuery("#shift_name_code").val(ui.item.id);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
    
    
    jQuery('#pc_id').on('change',function(){
        var pc_id = jQuery('#pc_id').val();
        
            jQuery.ajax({
                            type   :'post',
                            url    :'feeController/get_payment_date',
                            data   :{'pc_id':pc_id},
                            success :function(result){
                               var date = jQuery.parseJSON(result);
                               
                               
                                jQuery('#fromDate').val(date.fee_from);
                                jQuery('#uptoDate').val(date.fee_to); 
                                jQuery('#dueDate').val(date.valid_till); 
                            }
                        });
        
    });
      
    jQuery('#stdPrint').on('click',function(){
          
            var program     = jQuery('#program').val();
            var subProgram  = jQuery('#subProgram').val();
            var section    = jQuery('#section').val();
        
        if(program == ''){
            alert('Please Select Program');
            jQuery('#program').focus();
            return false;
        }
        if(subProgram == ''){
            alert('Please Select Sub Program');
            jQuery('#subProgram').focus();
            return false;
        }
        if(section == ''){
            alert('Please Select Section');
            jQuery('#section').focus();
            return false;
        }
        
        window.open('PrintClassWiseGroup/'+program+'/'+subProgram+'/'+section, '_blank');
//        window.open('PrintClassWise/'+feeProgrameId+'/'+showFeeSubPro+'/'+showSections+'/'+pc_id, '_blank');
    });
    
    jQuery('#bs_stdPrint').on('click',function(){
          
            var program     = jQuery('#feeProgrameId').val();
            var subProgram  = jQuery('#showFeeSubPro').val();
            var section    = jQuery('#showSections').val();
        
        if(program == ''){
            alert('Please Select Program');
            jQuery('#program').focus();
            return false;
        }
        if(subProgram == ''){
            alert('Please Select Sub Program');
            jQuery('#subProgram').focus();
            return false;
        }
        if(section == ''){
            alert('Please Select Section');
            jQuery('#section').focus();
            return false;
        }
        
        window.open('PrintClassWiseGroup/'+program+'/'+subProgram+'/'+section, '_blank');
//        window.open('PrintClassWise/'+feeProgrameId+'/'+showFeeSubPro+'/'+showSections+'/'+pc_id, '_blank');
    });

    
  jQuery('#showFeeSubPro').on('change',function(){
     
        jQuery('#search_record').hide();
            var programId = jQuery('#feeProgrameId').val();
            var sub_program_id = jQuery('#showFeeSubPro').val();
              jQuery.ajax({
                     type   :'post',
                     url    :'paymentCategorySearch',
                     data   :{'program_id':programId,'sub_program_id':sub_program_id},
                     success :function(result){
                         jQuery('#all_record').hide();
                        jQuery('#search_record').show();
                        
                        jQuery('#search_record').html(result);
                    }
                 });
      
  });  
    
//jQuery('#showFeeSubPro').on('change',function(){
//      jQuery('#class_fee_setup_all').hide();
//    jQuery('#class_fee_setup_search').hide();
//    
//    
//    var program_id      = jQuery('#feeProgrameId').val();
//    var sub_program_id  = jQuery('#showFeeSubPro').val();
// 
//    var data = {
//            'program_id'        :program_id,
//            'sub_program_id'    :sub_program_id
//         };
//  jQuery.ajax({
//         type   :'post',
//         url    :'feeCategoryWiseSearch',
//         data   :data,
//         success :function(result){
//            jQuery('#class_fee_setup_search').show();
//        
//            jQuery('#class_fee_setup_search').html(result);
//        }
//     });
//});
  jQuery('#print_batch').on('click',function(){
  
   var feeProgrameId   = jQuery('#feeProgrameId').val();
    var showFeeSubPro   = jQuery('#showFeeSubPro').val();
    var batch_id        = jQuery('#batch_id').val();
    var showSections    = jQuery('#showSections').val();
 
   
    if(feeProgrameId == ''){
        alert('Please Select Program');
        jQuery('#feeProgrameId').focus();
         return false();
    }
    if(showFeeSubPro == ''){
        alert('Please Select Sub Program');
        jQuery('#showFeeSubPro').focus();
         return false();
    }
    if(batch_id == ''){
        alert('Please Select Batch');
        jQuery('#batch_id').focus();
         return false();
    }
    if(showSections == ''){
        alert('Please Select Section');
        jQuery('#showSections').focus();
         return false();
    }
   
        

      window.open('PrintBatch/'+feeProgrameId+'/'+showFeeSubPro+'/'+batch_id+'/'+showSections, '_blank');
     
});  
 jQuery('#add_paymentCategory_id').on('change',function(){
     
            var programId       = jQuery('#feeProgrameId').val();
            var batch_id       = jQuery('#batch_id').val();
            var showFeeSubPro  = jQuery('#showFeeSubPro').val();
            var pc_id           = jQuery('#add_paymentCategory_id').val();
            
            var data = {
             'batch_id'         : batch_id,
             'showFeeSubPro'   : showFeeSubPro,   
             'pc_id'            : pc_id,   
            }
              jQuery.ajax({
                     type   :'post',
                     url    :'paymentCategoryCheck',
                     data   :data,
                     success :function(result){
                     if(result == 1){
                         
                          jQuery.ajax({
                               type   :'post',
                               url    :'paymentCategorySearch',
                               data   :{'program_id':programId,'sub_program_id':showFeeSubPro,'pc_id':pc_id},
                               success :function(result){
                                   jQuery('#all_record').hide();
                                  jQuery('#search_record').show();
                                  jQuery('#search_record').html(result);
                              }
                           });
                         
                        alert('Installment Already Exist..');
                        jQuery('#batch_id').val('');
                        jQuery('#showFeeSubPro').val('');
                        
                        jQuery('#feeProgrameId').val('');
                        jQuery('#feeProgrameId').focus();
                        return false;
                     }
                        
                         
                    }
                 });
      
  }); 
    jQuery('#print_hostel_whitecard').on('click',function(){
          
            var program     = jQuery('#feeProgrameId').val();
            var subProgram  = jQuery('#showFeeSubPro').val();
            var section     = jQuery('#showSections').val();
        
        if(program == ''){
            alert('Please Select Program');
            jQuery('#program').focus();
            return false;
        }
        if(subProgram == ''){
            alert('Please Select Sub Program');
            jQuery('#subProgram').focus();
            return false;
        }
        if(section == ''){
            alert('Please Select Section');
            jQuery('#section').focus();
            return false;
        }
        
        window.open('PrintClassWiseGroupHostel/'+program+'/'+subProgram+'/'+section, '_blank');
//        window.open('PrintClassWise/'+feeProgrameId+'/'+showFeeSubPro+'/'+showSections+'/'+pc_id, '_blank');
    });    
});
