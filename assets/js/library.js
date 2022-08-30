jQuery(document).ready(function(){
 
    
jQuery('#isbn_no').on('change',function(){
     var college_no     = jQuery('#isbn_no').val();
     jQuery.ajax({
         type:'post',
         url : 'LibraryController/isbn_no_checking',
         data:{'isbn_no':isbn_no},
         success:function(result){
            if(result ==1){
                alert('Sorry ! This ISBN Number already exist');
                jQuery('#isbn_no').val('');
                jQuery('#isbn_no').focus();
                return false;
            }else{
                
            }
         }
         
     });
     
 });
    
     jQuery("#std_sec_allotment").autocomplete({  
    minLength: 0,
    source: "LibraryController/std_sec_allotment/"+$("#std_sec_allotment").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#std_sec_allotment").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#college_no").val(ui.item.college_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#students_all").autocomplete({  
    minLength: 0,
    source: "LibraryController/auto_students_all/"+$("#students_all").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#students_all").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#college_no").val(ui.item.college_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });

jQuery("#em_name").autocomplete({  
        minLength: 0,
        source: "LibraryController/auto_emp_data/"+$("#em_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#em_name").val(ui.item.contactPerson);
        jQuery("#emp_id").val(ui.item.id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
jQuery('.dept_books_details').on('click',function(){
     var dept_id = this.id;   
      jQuery.ajax({
         type:'post',
         url : 'LibraryController/get_Deptbook_issued',
         data:{'dept_id':dept_id},
         success:function(result){
            jQuery('#book_details_info').html(result);
         }
     });
 });    
      
   
jQuery('.staff_update').on('click',function(){
     var iss_id = this.id;
      jQuery.ajax({
         type:'post',
         url : 'LibraryController/get_staffisuedBooks',
         data:{'iss_id':iss_id},
         success:function(result){
            jQuery('#staff_update_info').html(result);
         }
     });
     
 });    
    
jQuery('.books_details').on('click',function(){
     var student_id = this.id;
     //   alert(student_id);    
      jQuery.ajax({
         type:'post',
         url : 'LibraryController/get_Studentsbook_issued',
         data:{'student_id':student_id},
         success:function(result){
            jQuery('#book_details_info').html(result);
         }
     });
 });    
    
jQuery('.staff_books_details').on('click',function(){
     var emp_id = this.id;   
      jQuery.ajax({
         type:'post',
         url : 'LibraryController/get_Staffbook_issued',
         data:{'emp_id':emp_id},
         success:function(result){
            jQuery('#book_details_info').html(result);
         }
     });
 });    
    
    
jQuery("#book").autocomplete({  
    minLength: 0,
    source: "LibraryController/auto_books/"+$("#book").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#book").val(ui.item.contactPerson);
    jQuery("#book_id").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#accession_number").autocomplete({  
    minLength: 0,
    source: "LibraryController/auto_accession_number/"+$("#accession_number").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#accession_number").val(ui.item.contactPerson);
    jQuery("#accession_from").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#old_accession_no").autocomplete({  
    minLength: 0,
    source: "LibraryController/auto_old_accession/"+$("#old_accession_no").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#old_accession_no").val(ui.item.contactPerson);
    jQuery("#old_accession").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#old_accessionto_no").autocomplete({  
    minLength: 0,
    source: "LibraryController/auto_old_accession/"+$("#old_accessionto_no").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#old_accessionto_no").val(ui.item.contactPerson);
    jQuery("#old_accessionto").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#accessionto_number").autocomplete({  
    minLength: 0,
    source: "LibraryController/auto_accession_number/"+$("#accessionto_number").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#accessionto_number").val(ui.item.contactPerson);
    jQuery("#accession_to").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });

    jQuery("#student_names").autocomplete({  
    minLength: 0,
    source: "LibraryController/auto_students/"+$("#student_names").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#student_names").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#college_no").val(ui.item.college_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#book_accession").autocomplete({  
    minLength: 0,
    source: "LibraryController/auto_books_accession/"+$("#book_accession").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#book_accession").val(ui.item.contactPerson);
    jQuery("#book_id").val(ui.item.id);
    jQuery("#accession_no").val(ui.item.accession_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#addbooksissuance").on('click',function(){
    var  book_id = jQuery('#book_id').val();
    var  student_id = jQuery('#student_id').val();
       if(book_id == '')
            {
               alert('Please select Book');
               jQuery('#book_id').focus();
               return false;
            }        
        if(student_id == '')
            {
               alert('Please select Student First');
               jQuery('#student_names').focus();
               return false;
            } 
       var  accession_no = jQuery('#accession_no').val();
       
        var  form_Code = jQuery('#form_Code').val();
     jQuery.ajax({
       type: "POST",
       url: "LibraryController/add_issuance_book",
       data:  {
         'book_id': book_id,
         'student_id': student_id,
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
    
jQuery("#staffbooksissuance").on('click',function(){
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
    
jQuery("#deptbooksissuance").on('click',function(){
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
       url: "LibraryController/add_dept_issuance_book",
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
    
});
