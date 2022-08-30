jQuery(document).ready(function(){
     
   
    jQuery("#room_record").autocomplete({  
    minLength: 0,
    source: "HostelController/auto_hostelrooms/"+$("#room_record").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#room_record").val(ui.item.contactPerson);
    jQuery("#room_id").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
   
//    jQuery("#h_student_name").autocomplete({  
//    minLength: 0,
//    source: "HostelController/auto_hostel_head/"+$("#h_student_name").val(),
//    autoFocus: true,
//    scroll: true,
//    dataType: 'jsonp',
//    select: function(event, ui){
//    jQuery("#h_student_name").val(ui.item.contactPerson);
//    jQuery("#h_student_id").val(ui.item.code);
//    }
//    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
//    
   
    
});
