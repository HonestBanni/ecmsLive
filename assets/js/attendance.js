jQuery(document).ready(function(){
  jQuery('#sub_program_inter').on('change',function(){
      var subPro = jQuery('#sub_program_inter').val();
     jQuery.ajax({
         type:'post',
         url : 'AttendanceController/sub_program_inter',
         data:{'subPro':subPro},
         success:function(result){
            jQuery('#section_dropdown').html(result);
         }
         
     });
  });
 

jQuery(document).ready(function(){
     jQuery('#sub_program_a_level').on('change',function(){
      var subPro = jQuery('#sub_program_a_level').val();
     jQuery.ajax({
         type:'post',
         url : 'AttendanceController/sub_program_alevel',
         data:{'subPro':subPro},
         success:function(result){
            jQuery('#a_level_dropdown').html(result);
         }
         
     });
  });
});

jQuery("#std_id").autocomplete({  
    minLength: 0,
    source: "AttendanceController/auto_std_hnd/"+$("#std_id").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#std_id").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.id);
    jQuery("#college_no").val(ui.item.college_no);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });     
    
jQuery('#sub_program_alevel').on('change',function(){
      var subPro = jQuery('#sub_program_alevel').val();
     jQuery.ajax({
         type:'post',
         url : 'AttendanceController/sub_program_a_level',
         data:{'subPro':subPro},
         success:function(result){
            jQuery('#section_alevel_dropdown').html(result);
         }
         
     });
  });    
    
  jQuery('#sub_program_degree').on('change',function(){
      var subPro = jQuery('#sub_program_degree').val();
   
     jQuery.ajax({
         type:'post',
         url : 'AttendanceController/get_session_degree',
         data:{'subPro':subPro},
         success:function(result){
            jQuery('#sub_program_degreedropdown').html(result);
         }
         
     });
  });
    
    jQuery('.prac_timetable_details').on('click',function(){
     
     var practical_class_id = this.id;
      jQuery.ajax({
         type:'post',
         url : 'AttendanceController/get_teacher_practimetable',
         data:{'practical_class_id':practical_class_id},
         success:function(result){
            jQuery('#prac_timetable_info').html(result);
         }
     });
     
 });
//    
//    jQuery('.timetable_details').on('click',function(){
//     
//     var class_id = this.id;
//      jQuery.ajax({
//         type:'post',
//         url : 'AttendanceController/get_teacher_sectimetable',
//         data:{'class_id':class_id},
//         success:function(result){
//            jQuery('#timetable_details_info').html(result);
//         }
//     });
//     
// });
    
    jQuery('.ttable_update').on('click',function(){
     var timetable_id = this.id;
      jQuery.ajax({
         type:'post',
         url : 'AttendanceController/get_classtimetable',
         data:{'timetable_id':timetable_id},
         success:function(result){
            jQuery('#timetable_update_info').html(result);
         }
     });
     
 });
    
 jQuery('.ptable_update').on('click',function(){
     var ptimetable_id = this.id;
      jQuery.ajax({
         type:'post',
         url : 'AttendanceController/get_pracTimeTable',
         data:{'ptimetable_id':ptimetable_id},
         success:function(result){
            jQuery('#ptimetable_update_info').html(result);
         }
     });
     
 });    
    
      jQuery("#subjectName").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_subject_program/"+$("#subjectName").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#subjectName").val(ui.item.contactPerson);
        jQuery("#subjectNameId").val(ui.item.code);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });    
    
    
    jQuery("#subjectNameDegree").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_subject_program_degree/"+$("#subjectNameDegree").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#subjectNameDegree").val(ui.item.contactPerson);
        jQuery("#subjectNameDegreeId").val(ui.item.code);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });    

      
        
    jQuery(function () {
        $("input[id*='txtQty']").keydown(function (event) {
            if (event.shiftKey === true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });
    });
      
      jQuery('.checkINput').keyup(function(){
       var tmarks = parseInt(jQuery('#tmarks').val());
       var obmarks = jQuery(this).val();
        if(obmarks > tmarks){
           alert('value is greater then total marks');
           jQuery(this).val('');
           jQuery(this).focus();
           return false;
       }      
        else if(obmarks < 0){
            alert('value is less than zero');
           jQuery(this).val('');
           jQuery(this).focus();
           return false;
        }     
    });
    
    jQuery('.checkBoard').keyup(function(){
      var tmarks = parseInt(jQuery('#tmarks').val());
       var obmarks = jQuery(this).val();
        if(obmarks > tmarks){
           alert('value is greater then total marks');
           jQuery(this).val('');
           jQuery(this).focus();
           return false;
       }
               
    });
    
jQuery('#pracPrint').on('click',function(){
            var group_id     = jQuery('#group_id').val();
        if(group_id == ''){
            alert('Please Select Group Name');
            jQuery('#group_id').focus();
            return false;
        }
        window.open('PrintGroupWisePractical/'+group_id,'_blank');
    });
    
});
