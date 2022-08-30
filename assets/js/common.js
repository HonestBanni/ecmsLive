jQuery(document).ready(function(){
//    var winFeature =
//        'location=no,toolbar=no,menubar=no,scrollbars=yes,resizable=yes';
//        window.open('Result.html','null',winFeature);
// 
 var check;
jQuery("#form_no_chk").on("click", function(){
    check = jQuery("#mycheckbox").is(":checked");
    if(check) {
        jQuery('#form_noCheck').val('');
    } else {
        jQuery('#form_noCheck').val('1');
    }
}); 
 
 
 jQuery('#form-Checking').on('change',function(){
     var formId     = jQuery('#form-Checking').val();
     var batch_id   = jQuery('#batch_id').val();
  
     jQuery.ajax({
         type:'post',
         url : 'admin/form_no_Checking',
         data:{'formId':formId,'batch_id':batch_id},
         success:function(result){
            if(result ==1){
                alert('Record already exist');
                jQuery('#form-Checking').val('');
                jQuery('#form-Checking').focus();
                return false;
            }else{
                //alert(result);
            }
         }
         
     });
     
 });
 jQuery('#college_no').on('change',function(){
     var college_no     = jQuery('#college_no').val();
     jQuery.ajax({
         type:'post',
         url : 'admin/college_no_Checking',
         data:{'college_no':college_no},
         success:function(result){
            if(result ==1){
                alert('Record already exist');
                jQuery('#college_no').val('');
                jQuery('#college_no').focus();
                return false;
            }else{
                
            }
         }
         
     });
     
 });

 $('.checkbox').change(function(){ //".checkbox" change 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(this.checked == false){ //if this item is unchecked
        $("#select_all")[0].checked = false; //change "select all" checked status to false
    }
    
    //check "select all" if all checkbox items are checked
    if ($('.checkbox:checked').length == $('.checkbox').length ){ 
        $("#select_all")[0].checked = true; //change "select all" checked status to true
    }
});

 
 });

