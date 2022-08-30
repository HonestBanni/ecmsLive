jQuery(document).ready(function(){
     
   
    jQuery("#std_record").autocomplete({  
    minLength: 0,
    source: "ProctorController/auto_std_record/"+$("#std_record").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#std_record").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#college_no").val(ui.item.college_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#proctor_record").autocomplete({  
    minLength: 0,
    source: "ProctorController/auto_proctor_record/"+$("#proctor_record").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#proctor_record").val(ui.item.contactPerson);
    jQuery("#proctor_id").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
});
