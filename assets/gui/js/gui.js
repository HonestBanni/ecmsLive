jQuery(document).ready(function(){
 
 
//    setInterval(function() {
//               
//            jQuery.ajax({
//                        type    :'post',
//                        url     :'GuiController/show_teacher_data',
//                        success :function(result){
//                           jQuery('#show_teacher_data').html(result);
//
//                       }
//                    }); 
//                }, 500000); 
 
  
 
 jQuery('.class_details').on('click',function(){
     
     var emp_id = this.id;
     
     
      jQuery.ajax({
         type:'post',
         url : 'GuiController/get_teacher_attend_class',
         data:{'emp_id':emp_id},
         success:function(result){
            jQuery('#class_details_info').html(result);
         }
         
     });
     
 });
    
jQuery('.prac_details').on('click',function(){
     var emp_id = this.id;
      jQuery.ajax({
         type:'post',
         url : 'GuiController/get_teacher_attend_prac',
         data:{'emp_id':emp_id},
         success:function(result){
            jQuery('#prac_details_info').html(result);
         }
     });
 });    
 
 
});
