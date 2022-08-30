jQuery(document).ready(function(){
     
   
     
   //Hostel Student 
    jQuery("#h_student_name").autocomplete({  
        minLength: 0,
        source: "DropdownController/hostel_student/"+$("#h_student_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#h_student_name").val(ui.item.contactPerson);
        jQuery("#h_student_id").val(ui.item.code);
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
   
   
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

jQuery("#mess_add_heads").autocomplete({  
        
    minLength: 0,
    source: "DropdownController/mess_fee_title/"+$("#fee_head_name_add").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#mess_add_heads").val(ui.item.contactPerson);
    jQuery("#mess_add_heads_id").val(ui.item.id);
//    jQuery("#type").val(ui.item.type);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
 
