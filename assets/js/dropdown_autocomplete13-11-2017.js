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
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
   
    
});
