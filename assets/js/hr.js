jQuery(document).ready(function(){
 jQuery('#emp_cnic').focusout(function(){
 
     var emp_cnic = jQuery('#emp_cnic').val();
        
     jQuery.ajax({
         type   :'post',
         url    :'HrController/checkCnic',
         data   :{'emp_cnic':emp_cnic},
        success :function(result){
           if(result ==1){
              
               alert('CNIC already Exist '+emp_cnic);
                jQuery('#emp_cnic').val('');
                jQuery('#emp_cnic').focus();
               return false;
               
                
               
           }
        }
     });
 }); 
 });

