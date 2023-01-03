jQuery(document).ready(function(){
   //Hostel Student 
    jQuery("#h_student_name").autocomplete({  
        minLength: 0,
        source: "DropdownController/hostel_students/"+$("#h_student_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            
        jQuery("#h_student_name").val(ui.item.contactPerson);
        jQuery("#h_student_id").val(ui.item.code);
        jQuery("#batch_id").val(ui.item.batch_id);
        
        var type                = '1';
        var installment_types   = jQuery('#installmentNo').val();
        var batch_id            = ui.item.batch_id;
        jQuery('#fromDate').val('');
        jQuery('#toDate').val('');
        
          jQuery.ajax({
                type   :'post',
                url    :'hostelController/hostel_challan_setup_dates',
                data   :{'batch_id':batch_id,'installment_types':installment_types,'type':type},
                dataType    : 'json',
               success :function(result){
                   console.log(result);
                    jQuery('#fromDate').val(result['fromDate']);
                    jQuery('#toDate').val(result['toDate']);
               }
            });
        
        
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
   jQuery('#installmentNo').on('change',function(){
       
       var batch_id             =  jQuery("#batch_id").val();
       var installment_types    =  jQuery("#installmentNo").val();
       var type                 =  '1';
       
        jQuery('#fromDate').val('');
        jQuery('#toDate').val('');
        jQuery.ajax({
                type   :'post',
                url    :'hostelController/hostel_challan_setup_dates',
                data   :{'batch_id':batch_id,'installment_types':installment_types,'type':type},
                dataType    : 'json',
               success :function(result){
                    console.log(result);
                    jQuery('#fromDate').val(result['fromDate']);
                    jQuery('#toDate').val(result['toDate']);
               }
            });
       
   });
   
    //Change Program
   jQuery('#program-id').on('click',function(){
       
          var program_id = jQuery('#program-id').val();
          //Get Batch 
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getBatch',
                data   :{'programId':program_id},
               success :function(result){
                   console.log(result);
                  jQuery('#batch-id').html(result);
               }
            });
   });
   
        
    //Change Batch
   jQuery('#batch-id').on('click',function(){
        var program_id = jQuery('#program-id').val();
          //Get Sub Program 
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getSubProgram',
                data   :{'programId':program_id},
               success :function(result){
                  
                  jQuery('#sub-pro-name').html(result);
               }
            });
   });
    //Change Sub Program
   jQuery('#sub-pro-name').on('click',function(){
        var sub_program_id = jQuery('#sub-pro-name').val();
          //Get Sub Program 
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getPaymentCategory',
                data   :{'sub_program_id':sub_program_id},
               success :function(result){
                jQuery('#payment-challan').html(result);
               }
            });
   });
    //Change Sections
   jQuery('#sub-pro-name').on('click',function(){
        var sub_pro_id = jQuery('#sub-pro-name').val();
          //Get Sub Program 
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getSection',
                data   :{'sub_pro_id':sub_pro_id},
               success :function(result){
                  
                  jQuery('#fetch-section').html(result);
               }
            });
   });
jQuery("#add_new_head_students").autocomplete({  
    minLength: 0,
    source: "DropdownController/autoComplete_student_info/"+$("#add_new_head_students").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#add_new_head_students").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.code);
    jQuery("#stdName").val(ui.item.name);
    jQuery("#stdName").val(ui.item.name);
    jQuery("#fName").val(ui.item.f_name);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });

    
    



//Search by Voucher no 
    jQuery("#voch_no").autocomplete({  
        minLength: 0,
        source: "DropdownController/get_voucher_info/"+$("#voch_no").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#voch_no").val(ui.item.contactPerson);
        jQuery("#unrep_date").val(ui.item.date);
        jQuery("#chq_no").val(ui.item.cheque);
        jQuery("#payee_name").val(ui.item.payee);
        jQuery("#un_rep_desc").val(ui.item.desc);
        jQuery("#unpres_amount").val(ui.item.amount);
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
jQuery("#voch_no_hm").autocomplete({  
        minLength: 0,
        source: "DropdownController/get_voucher_info_hm/"+$("#voch_no_hm").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#voch_no_hm").val(ui.item.contactPerson);
        jQuery("#unrep_date").val(ui.item.date);
        jQuery("#chq_no").val(ui.item.cheque);
        jQuery("#payee_name").val(ui.item.payee);
        jQuery("#un_rep_desc").val(ui.item.desc);
        jQuery("#unpres_amount").val(ui.item.amount);
         
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  
    
});
    
     
jQuery("#fee_head_name_add").autocomplete({  
        
    minLength: 0,
    source: "DropdownController/hostel_fee_title/"+$("#fee_head_name_add").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#fee_head_name_add").val(ui.item.contactPerson);
    jQuery("#fee_head_id_add").val(ui.item.id);
//    jQuery("#type").val(ui.item.type);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });    
    
jQuery("#feehead").autocomplete({  
        
    minLength: 0,
    source: "DropdownController/hostel_fee_title/"+$("#feehead").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#feehead").val(ui.item.contactPerson);
    jQuery("#feehead_id").val(ui.item.id);
    jQuery("#type").val(ui.item.type);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });  

    
jQuery("#mess_add_heads").autocomplete({  
        
    minLength: 0,
    source: "DropdownController/mess_fee_title/"+$("#mess_add_heads").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#mess_add_heads").val(ui.item.contactPerson);
    jQuery("#mess_add_heads_id").val(ui.item.id);
//    jQuery("#type").val(ui.item.type);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });       
    
jQuery("#batch_feehead").autocomplete({  
        
    minLength: 0,
    source: "DropdownController/get_batch_hostel_fee_heads_auto/"+$("#batch_feehead").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#batch_feehead").val(ui.item.label);
    jQuery("#batch_feehead_id").val(ui.item.id);
//    jQuery("#type").val(ui.item.type);
    } 
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });  
    
    
jQuery("#hmamount").autocomplete({
      
        minLength: 0,
        source: "HmAutocompleteAmount/"+$("#hmamount").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#hmamount").val(ui.item.value);
            jQuery("#hmamountId").val(ui.item.code);
            jQuery("#hmcode_id").val(ui.item.subPk);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
    
    //Employee with Designation AutoComplete
    jQuery("#EmployeeNameAtuo").autocomplete({  
        minLength: 0,
        source: "EmployeeNameAtuo/"+$("#EmployeeNameAtuo").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#EmployeeNameAtuo").val(ui.item.value);
        jQuery("#EmployeeNameAtuoId").val(ui.item.code);
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });

    //Program Info AutoComplete
    jQuery("#program_info_auto").autocomplete({  
        minLength: 0,
        source: "ProgramInfoAuto/"+$("#program_info_auto").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
             
        jQuery("#program_info_auto").val(ui.item.contactPerson);
        jQuery("#program_id").val(ui.item.id);
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
   //Program Info AutoComplete
    jQuery("#sub_program_name_auto").autocomplete({  
        minLength: 0,
        source: "SubProgramAuto/"+$("#sub_program_name_auto").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sub_program_name_auto").val(ui.item.contactPerson);
        jQuery("#sub_program_id").val(ui.item.id);
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
     //Employee with Designation and Subjects AutoComplete
    jQuery("#EmployeeNameWithSubjectAuto").autocomplete({  
        minLength: 0,
        source: "EmployeeNameWithSubjectAtuo/"+$("#EmployeeNameWithSubjectAuto").val(),
//        source: "EmployeeNameAtuo/"+$("#EmployeeNameAtuo").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#EmployeeNameWithSubjectAuto").val(ui.item.label);
        jQuery("#EmployeeNameAutoId").val(ui.item.id);
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#sec_bs_exam_history").autocomplete({  
        minLength: 0,
        source: "DropdownController/sec_bs_exame_history/"+$("#sec_bs_exam_history").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sec_bs_exam_history").val(ui.item.contactPerson);
        jQuery("#sec_id").val(ui.item.sec_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
 
    jQuery("#sub_bs_exam_history").autocomplete({  
        minLength: 0,
        source: "DropdownController/subj_bs_exame_history/"+$("#sub_bs_exam_history").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sub_bs_exam_history").val(ui.item.contactPerson);
        jQuery("#subject_id").val(ui.item.subject_id);
        jQuery("#subject_flag").val(ui.item.flag);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    jQuery("#std_sec_allotment_alevel").autocomplete({  
        minLength: 0,
        source: "DropdownController/std_sec_allotment_alevel/"+$("#std_sec_allotment_alevel").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#std_sec_allotment_alevel").val(ui.item.contactPerson);
        jQuery("#student_id").val(ui.item.id);
        jQuery("#college_no").val(ui.item.college_no);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
 
 
      //Employee Autocomplete
      
//          $( "#ServingTeachersX" ).autocomplete({
//                minLength   : 0,
//                source: function( request, response ) {
//                  // Fetch data
//                  $.ajax({
//                    url: "DropdownController/auto_serving_teacher",
//                    type: 'post',
//                    dataType: "json",
//                    data: {
//                      term: request.term
//                    },
//                    success: function( data ) {
//                      response( data );
//                    }
//                  });
//                },
//                select: function (event, ui) {
//                  // Set selection
//                  $('#ServingTeachers').val(ui.item.label); // display the selected text
//                  $('#ServingTeachersID').val(ui.item.value); // save selected id to input
//                  return false;
//                }
//              });
//
//             
//      
//      
//      
        jQuery("#ServingTeachers").autocomplete({  
            source      :function( request, response ) {
                jQuery.ajax({
                url         : "AutoComplete/Employee/Teacher/Serving",
                type        : 'post',
                dataType    : "json",
                data        : { 
                                employee_name        : request.term,
                                ActiveSectionsID     :jQuery('#ActiveSectionsID').val()
                              },
                success     : function( data ) {response( data );}
                });
            },
            minLength   : 0,
            autoFocus   : true,
            scroll      : true,
            select      : function(event, ui){
            jQuery("#ServingTeacher").val(ui.item.contactPerson);
            jQuery("#ServingTeacherID").val(ui.item.emp_id);
            }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#ActiveSections").autocomplete({  
       
        source      :function( request, response ) {
                jQuery.ajax({
                url         : "AutoComplete/Sections",
                type        : 'post',
                dataType    : "json",
                data        : { 
                                sections        : request.term,
                              },
                success     : function( data ) {response( data );}
                });
            },
        minLength: 0,
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#ActiveSections").val(ui.item.contactPerson);
        jQuery("#ActiveSectionsID").val(ui.item.sec_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    
});
 