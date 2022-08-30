jQuery(document).ready(function(){
     
   
    jQuery("#student_record").autocomplete({  
    minLength: 0,
    source: "TourController/auto_students_record/"+$("#student_record").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#student_record").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#college_no").val(ui.item.college_no);
    jQuery("#sub_pro_id").val(ui.item.sub_pro_id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#emp_record").autocomplete({  
    minLength: 0,
    source: "TourController/auto_emp_record/"+$("#emp_record").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#emp_record").val(ui.item.contactPerson);
    jQuery("#emp_id").val(ui.item.id);
    jQuery("#current_designation").val(ui.item.current_designation);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#std_namess").autocomplete({  
    minLength: 0,
    source: "SecurityController/auto_studentss/"+$("#std_namess").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#std_namess").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#form_no").val(ui.item.form_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  }); 
    
    jQuery("#std_names").autocomplete({  
    minLength: 0,
    source: "SecurityController/auto_students/"+$("#std_names").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#std_names").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#college_no").val(ui.item.college_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  }); 
    
    jQuery("#addstudent").on('click',function(){
    var  student_id = jQuery('#student_id').val();
       if(student_id == '')
            {
               alert('Please select Student');
               jQuery('#student_id').focus();
               return false;
            } 
       
        var  college_no = jQuery('#college_no').val();
        var  sub_pro_id = jQuery('#sub_pro_id').val();
        var  form_Code = jQuery('#form_Code').val();
     jQuery.ajax({
       type: "POST",
       url: "TourController/add_student_record",
       data:  {
         'student_id': student_id,
         'college_no': college_no,
         'sub_pro_id': sub_pro_id,
         'form_Code': form_Code
     },
       success: function(result)
       {
            jQuery('#student_record').val('');
            jQuery('#student_id').val('');
            jQuery('#college_no').val('');
            jQuery('#sub_pro_id').val('');              
            jQuery('#booksIssuance').html(result);
       }
     });

  });
    
jQuery("#addstaffbooksissuance").on('click',function(){
    var  book_id = jQuery('#book_id').val();
       if(book_id == '')
            {
               alert('Please select Book');
               jQuery('#book_id').focus();
               return false;
            } 
       var  accession_no = jQuery('#accession_no').val();
       
        var  form_Code = jQuery('#form_Code').val();
     jQuery.ajax({
       type: "POST",
       url: "LibraryController/add_staff_issuance_book",
       data:  {
         'book_id': book_id,
         'accession_no': accession_no,
         'form_Code': form_Code
     },
       success: function(result)
       {
            jQuery('#book_id').val('');
            jQuery('#book_accession').val('');
            jQuery('#accession_no').val('');                 
            jQuery('#booksIssuance').html(result);
       }
     });

  });
    
jQuery("#relation").autocomplete({  
    minLength: 0,
    source: "SecurityController/auto_relation/"+$("#relation").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#relation").val(ui.item.contactPerson);
    jQuery("#relation_id").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });   
    
    jQuery("#std_names_sec").autocomplete({  
    minLength: 0,
    source: "SecurityController/auto_students_sec/"+$("#std_names_sec").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#std_names_sec").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#college_no").val(ui.item.college_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#std_names_prac").autocomplete({  
    minLength: 0,
    source: "SecurityController/auto_students_group/"+$("#std_names_prac").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#std_names_prac").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#college_no").val(ui.item.college_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
jQuery("#addgrade").on('click',function(){
     
            jQuery('#result_record').hide();
    var  ol_subject_id = jQuery('#ol_subject_id').val(); 
    if(ol_subject_id == '')
            {
               alert('Please select Subject');
               jQuery('#ol_subject_id').focus();
               return false;
            } 
    var  grade_id = jQuery('#grade_id').val();
       if(grade_id == '')
            {
               alert('Please select Grade');
               jQuery('#grade_id').focus();
               return false;
            }
    var  student_id = jQuery('#student_id').val();
    
     jQuery.ajax({
       type: "POST",
       url: "TourController/add_student_grade",
       data:  {
         'student_id': student_id,
         'grade_id': grade_id,
         'ol_subject_id': ol_subject_id,
     },
       success: function(result)
       {
            jQuery('#ol_subject_id').val('');
            jQuery('#grade_id').val('');    
            jQuery('#grade_record').html(result); 
           
       }
     });

  });    
    
    
jQuery("#add_student_practical").on('click',function(){
    var  student_id = jQuery('#student_id').val();
       if(student_id == '')
            {
               alert('Please select Student');
               jQuery('#student_id').focus();
               return false;
            } 
     jQuery.ajax({
       type: "POST",
       url: "admin/students_assign_prac_group",
       data:  {
         'student_id': student_id
     },
       success: function(result)
       {
            jQuery('#student_id').val('');          
            jQuery('#std_names_prac').val('');          
            jQuery('#student_practical_Record').html(result);
       }
     });

  });    
    
});
